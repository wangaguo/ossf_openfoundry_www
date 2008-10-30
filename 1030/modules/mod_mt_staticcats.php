<?php

/**
* Mosets Tree Static Categories
*
* @package Mambo Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Get params
$parent_cat_id = $params->get( 'parent_cat_id', 0 );
$class = $params->get( 'class', 'mainlevel' );
$primary_order = $params->get( 'primary_order', $mt_first_cat_order1 );
$primary_sort = $params->get( 'primary_sort', $mt_first_cat_order2 );
$secondary_order = $params->get( 'secondary_order', $mt_second_cat_order1 );
$secondary_sort = $params->get( 'secondary_sort', $mt_second_cat_order2 );
$show_empty_cat = $params->get( 'show_empty_cat', $mt_display_empty_cat );
$show_totalcats = $params->get( 'show_totalcats', 0 );
$show_totallisting = $params->get( 'show_totallisting', 1 );
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx' );

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

# Retrieve categories
$sql = "SELECT * FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$parent_cat_id."' ";
if ( !$mt_display_empty_cat ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
$sql .= "ORDER BY $primary_order $primary_sort, $secondary_order $secondary_sort";

$database->setQuery( $sql );
$cats = $database->loadObjectList();

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php

	if ( count($cats) <= 0 ) {

		// Do Nothing

	} else {

		foreach( $cats AS $cat) {
		
			echo '<tr><td><a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$cat->cat_id&Itemid=$Itemid").'" class="'.$class.'">'.$cat->cat_name;
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