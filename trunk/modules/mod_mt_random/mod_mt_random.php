<?php
/**
* Mosets Tree Random Listing
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

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
$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

$sql = "SELECT l.*, img.filename AS link_image FROM #__mt_links AS l"
	// .	"\n LEFT JOIN #__mt_reviews AS r ON r.link_id=l.link_id "
	.	"\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1"
	.	"\n WHERE link_published='1' && link_approved='1' "
	. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
	. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) ";
if ( $has_image_only ) {
	$sql .= "\n AND img.img_id > 0 ";
}
$sql .= "\n ORDER BY RAND() "
	.	"\n LIMIT 1";
$database->setQuery( $sql );

$links = $database->loadObjectList();
$total = count($links);
$total_reviews = array();
if ( $show_reviews ) {
	$sql = "SELECT COUNT(r.link_id) AS reviews, l.link_id FROM #__mt_links AS l"
		. "\n LEFT JOIN #__mt_reviews AS r ON r.link_id=l.link_id ";
	if( $has_image_only ) {
		$sql .= "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1";
	}
	$sql .= "\n WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) ";
	$sql .= "\n GROUP BY r.link_id ";
	$database->setQuery( $sql );
	$total_reviews = $database->loadObjectList("link_id");
}

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
	echo '<a href="' . sefRelToAbs("index.php?option=com_mtree&amp;task=viewlink&amp;link_id=$l->link_id&amp;Itemid=$mt_itemid") . '" class="'.$listingclass.'">';

	if ( $show_image && $has_image_only <> 0 ) {
		echo '<center><img border="0" vspace="3" src="'.$mtconf->getjconf('live_site').$mtconf->get('relative_path_to_listing_small_image') . $l->link_image . '" alt="'.$l->link_name.'" /></center>';
		echo '<br />';
	}	
	echo $l->link_name . '</a><br />';
	
	if ( $show_rating == 1 ) {
		$star = round($l->link_rating, 0);
		$html = '';
		for( $i=0; $i<$star; $i++) {
			$html .= '<img src="components/com_mtree/img/star_10.gif" width="16" height="16" hspace="1" vspace="3" />';
		}
		
		if( ($l->link_rating-$star) >= 0.5 && $star > 0 ) {
			$html .= '<img src="components/com_mtree/img/star_05.gif" width="16" height="16" hspace="1" vspace="3" />';
			$star += 1;
		}

		// Print blank star
		for( $i=$star; $i<5; $i++) {
			$html .= '<img src="components/com_mtree/img/star_00.gif" width="16" height="16" hspace="1" vspace="3" />';
		}
		echo $html;
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
		if ( !empty($cat->cat_name) ) echo "<br />".$_MT_LANG->CATEGORY.": <a href=\"".sefRelToAbs("index.php?option=com_mtree&amp;task=listcats&amp;cat_id=$cat->cat_id&amp;Itemid=$mt_itemid")."\">".$cat->cat_name."</a>";
	}

	if ( $show_hits == 1 ) {
		echo "<br />".$_MT_LANG->HITS . ": ".$l->link_hits;
	}

	if ( $show_votes == 1 ) {
		echo "<br /><a href=\"".sefRelToAbs("index.php?option=com_mtree&amp;task=rate&amp;link_id=$l->link_id&amp;Itemid=$mt_itemid")."\">".$_MT_LANG->VOTES . ": ".$l->link_votes."</a>";
	}

	if ( $show_reviews == 1 ) {
		echo "<br /><a href=\"".sefRelToAbs("index.php?option=com_mtree&amp;task=writereview&amp;link_id=$l->link_id&amp;Itemid=$mt_itemid")."\">".$_MT_LANG->REVIEWS . ": ";
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
