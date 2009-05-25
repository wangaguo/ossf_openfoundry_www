<?php
/**
* Mosets Tree Voted Best
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

# Include admin's class
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php' );

# Retrieve current category
$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );
$link_id = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );
if ( $cat_id == 0 && $link_id > 0 ) {
	$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = $link_id && main = 1 LIMIT 1" );
	$cat_id = $database->loadResult();
}

# Get params
$parent_cat = $params->get( 'parent_cat', '' );
$only_subcats = $params->get( 'only_subcats', 1 );
$count = $params->get( 'count', 5 );
$show_more = $params->get( 'show_more', 1 );
$caption_showmore = $params->get( 'caption_showmore', 'Show more...' );
$caption_rank = $params->get( 'caption_rank', 'Rank' );
$show_header = $params->get( 'show_header', 1 );
$use_alternating_bg = $params->get( 'use_alternating_bg', 0 );
$max_name_char  = $params->get( 'max_name_char', 24 );
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx' );

$order["rank"] = $params->get( 'order_rank', 1 );
$order["name"] = $params->get( 'order_name', 2 );
$order["category"] = $params->get( 'order_category', 0 );
$order["rating"] = $params->get( 'order_rating', 0 );
$order["votes"] = $params->get( 'order_votes', 0 );

# Generate SQL conditional to display category specific listing
$only_subcats_sql = '';
if ( $only_subcats == 1 || $parent_cat > 0 ) {

	if ( $parent_cat > 0 ) {
		$cat_id = $parent_cat;
	}

	$mtCats = new mtCats( $database );
	if ( is_numeric($cat_id) && $cat_id > 0 ) {
		$subcats = $mtCats->getSubCats_Recursive( $cat_id );
		$subcats[] = $cat_id;
	}
	if ( isset($subcats) && count($subcats) > 0 ) {
		$only_subcats_sql = "\n AND c.cat_id IN (" . implode( ", ", $subcats ) . ")";
	}

}

# Get Itemid, determine if the MT component is published
global $mt_itemid;
if(!isset($mt_itemid)) {
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$mt_itemid = $database->loadResult();
}

# Get Listing
global $mosConfig_offset;
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

$database->setQuery( "SELECT l.*, cl.cat_id AS cat_id, c.cat_name AS category FROM #__mt_links AS l, #__mt_cats AS c, #__mt_cl AS cl"
//	. "\n LEFT JOIN #__mt_cats AS c ON c.cat_id = l.cat_id"
	.	"\n WHERE l.link_id = cl.link_id AND c.cat_id = cl.cat_id AND cl.main = 1"
	.	"\n AND link_published='1' && link_approved='1' "
	. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
	. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
	.	( ( $mtconf->get('min_votes_for_toprated') && $mtconf->get('min_votes_for_toprated') >= 1 ) ? "\n AND l.link_votes >= " . $mtconf->get('min_votes_for_toprated') . " " : '' )
	.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
	.	"\n ORDER BY link_rating DESC, link_votes DESC  "
	.	"\n LIMIT $count" );

$listing = $database->loadObjectList();
?>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
<?php if ($show_header) { ?>
<tr>
<?php
	for( $i=1; $i<=count($order); $i++ ) {
		if ( $i == $order["rank"] )	echo '<th width="5%">'.$caption_rank.'</th>';
		if ( $i == $order["name"] )	echo '<th width="35%">'.$_MT_LANG->NAME.'</th>';
		if ( $i == $order["category"] )	echo '<th width="35%">'.$_MT_LANG->CATEGORY.'</th>';
		if ( $i == $order["rating"] )	echo '<th width="12%">'.$_MT_LANG->RATING.'</th>';
		if ( $i == $order["votes"] )	echo '<th width="12%">'.$_MT_LANG->VOTES.'</th>';
	}
?></tr>
<?php
}

$tabclass = array( 'sectiontableentry1', 'sectiontableentry2' );
$rank = 1;
$k=0;
foreach( $listing AS $l ) {

	if ( $use_alternating_bg ) {
		echo '<tr class="'.$tabclass[$k].'">';
	}	else {
		echo '<tr>';
	}

	for( $i=1; $i<=count($order); $i++ ) {
		if ( $i == $order["rank"] )	echo "<td>$rank</td>";
		if ( $i == $order["name"] ) {
			echo '<td nowrap><a href="' . sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$l->link_id&Itemid=$mt_itemid") . '">';
			if ( $max_name_char <= 0 || strlen($l->link_name) <= $max_name_char ) {
				echo $l->link_name;
			} else {
				$link_name = substr($l->link_name, 0, $max_name_char);
				$words = explode(" ", $link_name);
				array_pop($words);
				echo implode(" ", $words)."...";
			}
			echo '</a></td>';
		}
		if ( $i == $order["category"] )	echo '<td nowrap><a href="' . sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$l->cat_id&Itemid=$mt_itemid") . '">'. $l->category . '</a></td>';
		if ( $i == $order["rating"] )	echo "<td>$l->link_rating</td>";
		if ( $i == $order["votes"] )	echo "<td>$l->link_votes</td>";
	}
	echo '</tr>';	
	$rank++;
	$k = 1 - $k;
}

if ( $show_more ) {
	echo '<tr><td colspan="4">';
	echo '<a href="' . sefRelToAbs("index.php?option=com_mtree&task=listtoprated&cat_id=$cat_id&Itemid=$mt_itemid") . '">';
	echo $caption_showmore . '</a></td></tr>';	
}

?></table>