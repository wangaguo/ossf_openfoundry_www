<?php

/**
* Mosets Tree Listing
*
* @package Mambo Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Include admin's class
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php' );

# Include the language file. Default is English
global $mt_language;
if ($mt_language=='') $mt_language='english';
include_once('components/com_mtree/language/'.$mt_language.'.php');
#if ( !isset($_MT_LANG) ) $_MT_LANG =& new mtLanguage();
if ( !isset($_MT_LANG) ) $_MT_LANG =& new mosConfig_lang(); 
# Retrieve current category
$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );

# Get params
$listingclass = $params->get( 'listingclass', '' );
$type = $params->get( 'type', 1 ); // Default is new listing
$count = $params->get( 'count', 5 );
$show_from_cat_id = $params->get( 'show_from_cat_id', 0 );
$only_subcats = $params->get( 'only_subcats', 0 );
$shuffle_listing = $params->get( 'shuffle_listing', 1 );
$show_more = $params->get( 'show_more', 1 );
$caption_showmore = $params->get( 'caption_showmore', 'Show more...' );
$show_website = $params->get( 'show_website', 1 );
$show_category = $params->get( 'show_category', 1 );
$show_rank = $params->get( 'show_rank', 1 );
$show_rel_data = $params->get( 'show_rel_data', 1 );
$trim_long_names = $params->get( 'trim_long_names', 1 );
$trim_long_urls = $params->get( 'trim_long_urls', 1 );
$max_name_char  = $params->get( 'max_name_char', 24 );
$custom_field  = $params->get( 'custom_field', 1 );
$custom_order  = $params->get( 'custom_order', 'asc' );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );

# Determine which category the listing is retrieve from
$mtCats = new mtCats( $database );
$limit_cat_to = 0;
if( $show_from_cat_id > 0 )  {
	
	if( $only_subcats == 1 ) {
		$mtCats->load( $show_from_cat_id );
		
		if( $mtCats->isChild($cat_id) ) {
			$limit_cat_to = $cat_id;
		} else {
			$limit_cat_to = $show_from_cat_id;
		}

	} else {
		$limit_cat_to = $show_from_cat_id;
	}

} elseif ( $cat_id > 0 && $only_subcats == 1 ) {
	$limit_cat_to = $cat_id;
}

# Get sub_cats queries
if( $limit_cat_to > 0 ) {
	$subcats = $mtCats->getSubCats_Recursive( $limit_cat_to );
	$subcats[] = $limit_cat_to;
	$only_subcats_sql = '';

	if ( count($subcats) > 0 ) {
		$only_subcats_sql = "\n AND cl.cat_id IN (" . implode( ", ", $subcats ) . ")";
	}
}

switch( $type ) {
	case 1: // New listing
		$order = "link_created";
		$sort = "DESC";
		$ltask= "listnew";
		break;
	case 2: // Featured Listing
		$order = "link_featured";
		$sort = "ASC";
		$ltask= "listfeatured";
		break;
	case 3: // Popular Listing
		$order = "link_hits";
		$sort = "DESC";
		$ltask= "listpopular";
		break;
	case 4: // Most Rated Listing
		$order = "link_votes";
		$sort = "DESC";
		$ltask= "listmostrated";
		break;
	case 5: // Top Rated Listing
		$order = "link_rating";
		$sort = "DESC";
		$ltask= "listtoprated";
		break;
	case 6: // Most Reviewed Listing
		$order = "reviews";
		$sort = "DESC";
		$ltask= "listmostreviewed";
		break;
	case 7: // Custom Top List
		$order = "cust_".$custom_field;
		$sort = $custom_order;
		$ltask= '';
		break;

}

# Get Itemid, determine if the HP component is published
$database->setQuery("SELECT id FROM #__menu"
	.	"\nWHERE link='index.php?option=com_mtree'"
	.	"\nAND published='1'"
	.	"\nLIMIT 1");
$Itemid = $database->loadResult();

# Get Listing
global $mosConfig_offset;
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
$listing = array();

// Most Reviewed Listing
if ( $type == 6 ) {

	$database->setQuery( "SELECT l.*, COUNT(r.link_id) AS reviews, c.cat_name, c.cat_id FROM #__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS c"
		.	"\n LEFT JOIN #__mt_reviews AS r ON r.link_id=l.link_id "
		.	"\n WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		. "\n AND l.link_id = cl.link_id "
		. "\n AND c.cat_id = cl.cat_id "
		. "\n AND cl.main = 1 "
		.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
		.	"\n GROUP BY r.link_id "
		.	"\n ORDER BY $order $sort "
		.	"\n LIMIT $count" );
	$listing = $database->loadObjectList();

// Shuffled Featured Listing
} elseif ( $type == 2 && $shuffle_listing ) {

	$database->setQuery( "SELECT l.*, c.cat_name, c.cat_id FROM #__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS c"
		.	"\n WHERE link_published='1' && link_approved='1' && link_featured='1'"
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		. "\n AND l.link_id = cl.link_id "
		. "\n AND c.cat_id = cl.cat_id "
		. "\n AND cl.main = 1 "
		.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
		.	"\n ORDER BY RAND() "
		.	"\n LIMIT $count" 
		);
	
	$listing = $database->loadObjectList();

	shuffle( $listing );
	$listing = array_slice( $listing, 0, $count );

// Custom Top List
} elseif ( $type == 7 ) {

	$database->setQuery( "SELECT l.*, c.cat_name, c.cat_id FROM #__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS c"
		.	"\n WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		. "\n AND l.link_id = cl.link_id "
		. "\n AND c.cat_id = cl.cat_id "
		. "\n AND cl.main = 1 "
		.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
		.	"\n ORDER BY cust_".$custom_field." ".$custom_order
		.	"\n LIMIT $count" );
	
	$listing = $database->loadObjectList();

// Other normal listing
} else {

	$database->setQuery( "SELECT l.*, c.cat_name, c.cat_id FROM #__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS c"
		.	"\n WHERE link_published='1' && link_approved='1' "
		.	( ($type == 2) ? "\n AND link_featured='1'" : '' )
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		. "\n AND l.link_id = cl.link_id "
		. "\n AND c.cat_id = cl.cat_id "
		. "\n AND cl.main = 1 "
		.	( ( $type == 4 && isset($mt_min_votes_for_toprated) && $mt_min_votes_for_toprated >= 1 ) ? "\n AND l.link_votes >= ".$mt_min_votes_for_toprated." " : '' )
		.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
		.	"\n ORDER BY $order $sort "
		. ( ($type == 4 OR $type == 5) ? ( ($type == 4) ? ', link_rating DESC ' : ', link_votes DESC ' ) : '' )
		.	"\n LIMIT $count" );
	
	$listing = $database->loadObjectList();

}

# List Method

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0"><?php
$rank = 1;
if ( is_array($listing) ) {
	foreach( $listing AS $l ) {
		echo '<tr><td>';
		if ( $show_rank == 1 ) echo "<b>".$rank++ . "</b>. ";
		echo '<a href="' . sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$l->link_id&Itemid=$Itemid") . '" class="'.$listingclass.'">';
		if ( !$trim_long_names || strlen($l->link_name) <= $max_name_char ) {
			echo $l->link_name;
		} else {
			$link_name = substr($l->link_name, 0, $max_name_char);
			$words = explode(" ", $link_name);
			array_pop($words);
			echo implode(" ", $words)."...";
		}
		echo  '</a>';
		if ( $show_website == 1 && !empty($l->website) ) {
			echo "<br />";
			if ( $show_rank == 1 ) echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			if ( substr($l->website,-1) == "/" ) $l->website = substr($l->website,0,-1);
			echo "<small><a href=\"".$l->website."\">";
			
			if ( !$trim_long_urls || strlen($l->website) <= $max_name_char ) {
				echo str_replace("http://",'',$l->website);
			} else {
				$url = substr(str_replace("http://",'',$l->website), 0, $max_name_char);
				$words = explode("/", $url);
				if ( count($words) > 1 ) {
					array_pop($words);
					echo implode("/", $words)."...";
				} else {
					echo implode("/", $words);
				}			
			}
			echo "</a></small>";
		}
		if ( $show_category == 1 ) {
			echo "<br />";
			if ( $show_rank == 1 ) echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<small>".$_MT_LANG->CATEGORY.": <a href=\"".sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$l->cat_id&Itemid=$Itemid")."\">".$l->cat_name."</a></small>";
		}
		if ( $show_rel_data == 1 && $type <> 2 ) {
			echo "<br />";
			if ( $show_rank == 1 ) echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<small>";
			switch( $type ) {
				case 1:
					echo $_MT_LANG->CREATED . ": ".date("M j, Y",strtotime($l->link_created));
					break;
				case 3:
					echo $_MT_LANG->HITS . ": ".$l->link_hits;
					break;
				case 4:
					echo $_MT_LANG->VOTES . ": ".$l->link_votes;
					break;
				case 5:
					$star = round($l->link_rating, 0);
					// Print starts
					for( $i=0; $i<$star; $i++) {
						echo '<img src="images/M_images/rating_star.png" width="9" height="11" />';
					}
					// Print blank star
					for( $i=$star; $i<5; $i++) {
						echo '<img src="images/M_images/rating_star_blank.png" width="9" height="11" />';
					}
					break;
				case 6:
					echo $_MT_LANG->REVIEWS . ": ".$l->reviews;
					break;
				case 7:
					$database->setQuery( "SELECT value FROM #__mt_config WHERE name = 'cust_".$custom_field."' LIMIT 1" );
					$custom_caption = $database->loadResult();
					$field_name = "cust_".$custom_field;
					echo $custom_caption . ": ".$l->$field_name;

			}
			echo "</small>";
		}
		echo '</td></tr>';	
	}
}

if ( $show_more ) {
	echo '<tr><td>';
	echo '<a href="';
	echo sefRelToAbs("index.php?option=com_mtree&task=$ltask&" . (($only_subcats) ? "cat_id=$cat_id&" : (($show_from_cat_id) ? "cat_id=$show_from_cat_id&" : "") )."Itemid=$Itemid");
	echo '" class="'.$listingclass.'">';
	echo $caption_showmore . '</a></td></tr>';	
}

?></table>
