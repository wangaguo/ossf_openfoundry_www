<?php

/**
* Mosets Tree Random Listing
*
* @package Mambo Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Include the language file. Default is English
if ($mt_language=='') $mt_language='english';
include_once('components/com_mtree/language/'.$mt_language.'.php');
if ( !isset($_MT_LANG) ) $_MT_LANG =& new mosConfig_lang();

# Get params
$listingclass = $params->get( 'listingclass', '' );
$show_image = $params->get( 'show_image', 1 );
$has_image_only = $params->get( 'has_image_only', 1 );
$show_website = $params->get( 'show_website', 1 );
$show_category = $params->get( 'show_category', 1 );
$show_rating = $params->get( 'show_rating', 1 );
$show_hits = $params->get( 'show_hits', 0 );
$show_votes = $params->get( 'show_votes', 0 );
$show_reviews = $params->get( 'show_reviews', 0 );
$show_created = $params->get( 'show_created', 0 );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );

# Get Itemid, determine if the HP component is published
$database->setQuery("SELECT id FROM #__menu"
	.	"\nWHERE link='index.php?option=com_mtree'"
	.	"\nAND published='1'"
	.	"\nLIMIT 1");
$Itemid = $database->loadResult();

# Get Listing
global $mosConfig_offset;
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

$sql = "SELECT l.* FROM #__mt_links AS l"
	.	"\n LEFT JOIN #__mt_reviews AS r ON r.link_id=l.link_id "
	.	"\n WHERE link_published='1' && link_approved='1' "
	. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
	. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) ";
if ( $has_image_only ) {
	$sql .= "\n AND link_image <> '' ";
}
$sql .= "\n ORDER BY RAND() "
	.	"\n LIMIT 1";

$database->setQuery( $sql );

$links = $database->loadObjectList();
$total = count($links);

if ( $show_reviews ) {
	$sql = "SELECT COUNT(r.link_id) AS reviews, l.link_id FROM #__mt_links AS l"
			.	"\n LEFT JOIN #__mt_reviews AS r ON r.link_id=l.link_id "
		.	"\n WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) ";
	if ( $has_image_only ) {
		$sql .= "\n AND link_image <> '' ";
	}
	$sql .= "\n GROUP BY r.link_id ";
}
$database->setQuery( $sql );
$total_reviews = $database->loadObjectList("link_id");

# Select a random number. Select again if the random number returns the same property, user is viewing
global $link_id, $option, $task;
global $displayed_listings_in_mtrandom;

if ( empty($displayed_listings_in_mtrandom) ) {
	$displayed_listings_in_mtrandom = array();
}

if ( $total > 0 ) {
	do {
		# Seed and get the random number
		srand((double)microtime()*88101967);
		$choose = rand(0,($total-1));
	} while ( ($option == "com_mtree" && $task == "viewlink" && $link_id == $links[$choose]->link_id && $total > 1) || ( in_array($links[$choose]->link_id,$displayed_listings_in_mtrandom) && $total > count($displayed_listings_in_mtrandom) ) );

	$l = $links[$choose];
	
	if ( !in_array($l->link_id,$displayed_listings_in_mtrandom) ) {
		$displayed_listings_in_mtrandom[] = $l->link_id;
	}

	unset($links);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0"><?php

	echo '<tr><td>';
	echo '<a href="' . sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$l->link_id&Itemid=$Itemid") . '" class="'.$listingclass.'">';

	if ( $show_image && $has_image_only <> 0 ) {
		echo '<center><img border="0" vspace="3" src="'.$mosConfig_live_site.$mt_listing_image_dir.$l->link_image.'" alt="'.$l->link_name.'" /></center>';
		echo '<br />';
	}	
	echo $l->link_name . '</a>';
	if ( $show_rating == 1 ) {
		$star = round($l->link_rating, 0);
		echo "&nbsp;";
		// Print starts
		for( $i=0; $i<$star; $i++) {
			echo '<img src="images/M_images/rating_star.png" width="9" height="11" />';
		}
		// Print blank star
		for( $i=$star; $i<5; $i++) {
			echo '<img src="images/M_images/rating_star_blank.png" width="9" height="11" />';
		}
	}

	echo "<small>";
	if ( $show_website == 1 && !empty($l->website) ) {
		echo "<br />";
		if ( substr($l->website,-1) == "/" ) $l->website = substr($l->website,0,-1);
		echo "<small><a href=\"".$l->website."\">".str_replace("http://",'',$l->website)."</a></small>";
	}

	if ( $show_category == 1 ) {
		$database->setQuery( "SELECT c.cat_name, c.cat_id FROM #__mt_cats AS c, #__mt_cl AS cl, #__mt_links AS l WHERE cl.cat_id = c.cat_id AND l.link_id = cl.link_id AND l.link_id = $l->link_id" );
		$database->loadObject( $cat );
		if ( !empty($cat->cat_name) ) echo "<br />".$_MT_LANG->CATEGORY.": <a href=\"".sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$cat->cat_id&Itemid=$Itemid")."\">".$cat->cat_name."</a>";
	}

	if ( $show_hits == 1 ) {
		echo "<br />".$_MT_LANG->HITS . ": ".$l->link_hits;
	}

	if ( $show_votes == 1 ) {
		echo "<br /><a href=\"".sefRelToAbs("index.php?option=com_mtree&task=rate&link_id=$l->link_id&Itemid=$Itemid")."\">".$_MT_LANG->VOTES . ": ".$l->link_votes."</a>";
	}

	if ( $show_reviews == 1 ) {
		echo "<br /><a href=\"".sefRelToAbs("index.php?option=com_mtree&task=writereview&link_id=$l->link_id&Itemid=$Itemid")."\">".$_MT_LANG->REVIEWS . ": ";
		if ( isset($total_reviews[$l->link_id]->reviews) ) {
			echo $total_reviews[$l->link_id]->reviews;
		} else {
			echo "0";
		}
		echo "</a>";
	}

	if ( $show_created == 1 ) {
		echo "<br />".$_MT_LANG->CREATED . ": ".date("M j, Y",strtotime($l->link_created));
	}
	echo "</small>";
	echo '<br /><br />';
	echo '</td></tr>';	

?></table>

<?php } ?>
