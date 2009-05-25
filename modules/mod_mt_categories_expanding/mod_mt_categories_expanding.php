<?php
/**
* Mosets Tree Categories Expanding
*
* @package Mosets Tree 2.0
* @copyright (C) 2006-2008 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php');

# Get params
$categoryclass = $params->get( 'categoryclass', 'catlevel_' );
$moduleclass = $params->get( 'moduleclass', 'mainlevel' );
$pad_string = $params->get( 'pad_string', '&nbsp;&nbsp;&nbsp;' );
$output_type = $params->get( 'output_type', 'table' );
$primary_order = $params->get( 'primary_order', $mtconf->get('first_cat_order1') );
$primary_sort = $params->get( 'primary_sort', $mtconf->get('first_cat_order2') );
$secondary_order = $params->get( 'secondary_order', $mtconf->get('second_cat_order1') );
$secondary_sort = $params->get( 'secondary_sort', $mtconf->get('second_cat_order2') );
$show_empty_cat = $params->get( 'show_empty_cat', $mtconf->get('display_empty_cat') );
$show_totalcats = $params->get( 'show_totalcats', 0 );
$show_totallisting = $params->get( 'show_totallisting', 1 );
$hide_active_cat_count = $params->get( 'hide_count', 1 );
$expand_level_1_categories = $params->get( 'expand_level_1_categories', 0 );

if ($show_empty_cat == -1) $show_empty_cat = $mtconf->get('display_empty_cat');
if ($primary_order == -1) $primary_order = $mtconf->get('first_cat_order1');
if ($primary_sort == -1) $primary_sort = $mtconf->get('first_cat_order2');
if ($secondary_order == -1) $secondary_order = $mtconf->get('second_cat_order1');
if ($secondary_sort == -1) $secondary_sort = $mtconf->get('second_cat_order2');

# Get Itemid, determine if the MT component is published
global $mt_itemid;
if(!isset($mt_itemid)) {
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$mt_itemid = $database->loadResult();
}

# Try to retrieve current category
$link_id = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );
$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );

if ( $link_id > 0 && $cat_id == 0 ) {
	$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id ='".$link_id."' && main = '1'" );
	$cat_id = $database->loadResult();
} 

# Get the main categories first
$sql = "SELECT cat_name, cat_id, cat_cats, cat_links FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='0' ";
if ( !$mtconf->get('display_empty_cat') ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
$sql .= "ORDER BY $primary_order $primary_sort, $secondary_order $secondary_sort";

$database->setQuery( $sql );
$cats[0] = $database->loadObjectList();

$pathway_cats = array();
if( $expand_level_1_categories ) {
	foreach($cats[0] AS $cat) {
		$pathway_cats[] = $cat->cat_id;
	}
}

if( !in_array($cat_id,$pathway_cats) ) {
	$pathway = new mtPathWay( $cat_id );
	$pathway_cats = array_merge($pathway->getPathWayWithCurrentCat(),$pathway_cats);
}

foreach( $pathway_cats AS $pathway_cat ) {
	
	$sql = "SELECT cat_name, cat_id, cat_cats, cat_links FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$pathway_cat."' ";
	if ( !$mtconf->get('display_empty_cat') ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
	$sql .= "ORDER BY $primary_order $primary_sort, $secondary_order $secondary_sort";

	$database->setQuery( $sql );
	$cats[$pathway_cat] = $database->loadObjectList();

}

function print_cat_recursive( &$all_categories, $category_id, $show_totalcats, $show_totallisting, $categoryclass, $output_type, $pad_string, $hide_active_cat_count, $mt_itemid ) {
	global $cat_id;
	static $level=0;

	$categories = $all_categories[$category_id];

	if ( $output_type == 'ul' ) {
		echo "<ul>";
	} else {
		echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
	}

	foreach( $categories AS $cat ) {
		
		if ( $output_type == 'ul' ) {
			echo '<li';
		} else {
			echo '<tr><td';
		}

		echo ' class="'.$categoryclass.$level;
		
		if( $cat_id == $cat->cat_id ) {
			echo '_sel';
		} elseif(array_key_exists($cat->cat_id, $all_categories)) {
			echo '_active';
		}

		echo '">';
		
		if ( $output_type == 'table' ) {
			echo str_repeat($pad_string,($level));
		}
		
		echo '<a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$cat->cat_id&Itemid=$mt_itemid").'">'.$cat->cat_name;
		echo "</a>";
		
		if ( $hide_active_cat_count && array_key_exists($cat->cat_id, $all_categories) ) {
			//hide
		} else {
			if ( $show_totalcats xor $show_totallisting ) {
				echo " <small>(".(($show_totalcats)? $cat->cat_cats:$cat->cat_links ).")</small>";
			} elseif( $show_totalcats && $show_totallisting ) {
				echo " <small>(".$cat->cat_cats."/".$cat->cat_links.")</small>";
			}
		}
		
		if(array_key_exists($cat->cat_id, $all_categories))  {
			$level++;
			print_cat_recursive($all_categories, $cat->cat_id, $show_totalcats, $show_totallisting, $categoryclass, $output_type, $pad_string, $hide_active_cat_count, $mt_itemid);
			$level--;
		}

		if ( $output_type == 'ul' ) {
			echo "</li>";
		} else {
			echo "</td></tr>";
		}

	}

	if ( $output_type == 'ul' ) {
		echo "</ul>";
	} else {
		echo "</table>";
	}

	return true;
}

print_cat_recursive($cats, 0, $show_totalcats, $show_totallisting, $categoryclass, $output_type, $pad_string, $hide_active_cat_count, $mt_itemid); 
?>