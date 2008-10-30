<?php

/**
* Mosets Tree Categories
*
* @package Mambo Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php');

# Get params
$parentclass = $params->get( 'parentclass', 'mainlevel' );
$moduleclass = $params->get( 'moduleclass', 'mainlevel' );
$primary_order = $params->get( 'primary_order', $mt_first_cat_order1 );
$primary_sort = $params->get( 'primary_sort', $mt_first_cat_order2 );
$secondary_order = $params->get( 'secondary_order', $mt_second_cat_order1 );
$secondary_sort = $params->get( 'secondary_sort', $mt_second_cat_order2 );
$show_empty_cat = $params->get( 'show_empty_cat', $mt_display_empty_cat );
$show_totalcats = $params->get( 'show_totalcats', 0 );
$show_totallisting = $params->get( 'show_totallisting', 0 );
$back_symbol = htmlspecialchars($params->get( 'back_symbol', '<<' ));
$show_back = $params->get( 'show_back', '0' );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );

if ($show_empty_cat == -1) $show_empty_cat = $mt_display_empty_cat;
if ($primary_order == -1) $primary_order = $mt_first_cat_order1;
if ($primary_sort == -1) $primary_sort = $mt_first_cat_order2;
if ($secondary_order == -1) $secondary_order = $mt_second_cat_order1;
if ($secondary_sort == -1) $secondary_sort = $mt_second_cat_order2;

# Get Itemid, determine if the HP component is published
$database->setQuery("SELECT id FROM #__menu"
	.	"\nWHERE link='index.php?option=com_mtree'"
	.	"\nAND published='1'"
	.	"\nLIMIT 1");
$Itemid = $database->loadResult();

# Try to retrieve current category
$link_id = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );
$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );

if ( $link_id > 0 && $cat_id == 0 ) {
	$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id ='".$link_id."' && main = '1'" );
	$cat_id = $database->loadResult();
} 

# Retrieve categories
$sql = "SELECT * FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ";
if ( !$mt_display_empty_cat ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
$sql .= "ORDER BY $primary_order $primary_sort, $secondary_order $secondary_sort";

$database->setQuery( $sql );
$cats = $database->loadObjectList();

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php

	if ( $cat_id > 0 ) {
		$mtCat = new mtCats( $database );
		$mtCat->load( $cat_id );

		if ( $show_back || count($cats) <= 0 ) {
			echo '<tr><td><a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=".$mtCat->getParent()."&Itemid=$Itemid").'" class="'.$parentclass.'"> '.$back_symbol.' '.$mtCat->getName($mtCat->getParent());
			echo "</a></td></tr>";
		}
	}

	if ( count($cats) <= 0 ) {

		/*
		$mtCat = new mtCats( $database );
		$mtCat->load( $cat_id );

		echo '<tr><td><a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=".$mtCat->getParent()."&Itemid=$Itemid").'" class="'.$parentclass.'"> '.$back_symbol.' '.$mtCat->getName($mtCat->getParent());
		echo "</a></td></tr>";
		*/
	} else {



		foreach( $cats AS $cat) {
		
			echo '<tr><td><a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$cat->cat_id&Itemid=$Itemid").'" class="'.$moduleclass.'">'.$cat->cat_name;
			if ( $show_totalcats xor $show_totallisting ) {
				echo " <small>(".(($show_totalcats)? $cat->cat_cats:$cat->cat_links ).")</small>";
			} elseif( $show_totalcats && $show_totallisting ) {
				echo " <small>(".$cat->cat_cats."/".$cat->cat_links.")</small>";
			}
			echo "</a></td></tr>";
		
		}

	}
?>
</table>