<?php
/**
* Mosets Tree Browse
*
* @package Mosets Tree 2.00
* @copyright (C) 2005-2007 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php');

# Get params
$root_class = $params->get( 'root_class', 'mainlevel' );
$subcat_class = $params->get( 'subcat_class', 'sublevel' );
$currentcat_class = $params->get( 'currentcat_class', 'sublevel' );
$closedcat_class = $params->get( 'closedcat_class', 'sublevel' );
$show_totalcats = $params->get( 'show_totalcats', 0 );
$show_totallisting = $params->get( 'show_totallisting', 0 );
$show_empty_cat = $params->get( 'show_empty_cat', $mtconf->get('display_empty_cat') );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );

if ($show_empty_cat == -1) $show_empty_cat = $mtconf->get('display_empty_cat');

$spacer = '<img src="components/com_mtree/img/dtree/empty.gif" align="left" vspace="0" hspace="0" />';

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
	$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id ='".$link_id."' AND main = 1" );
	$cat_id = $database->loadResult();
} 

# Retrieve categories
$sql = "SELECT cat_id, cat_name, cat_cats, cat_links FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ";
if ( !$mtconf->get('display_empty_cat') ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
$sql .= 'ORDER BY ' . $mtconf->get('first_cat_order1') . ' ' . $mtconf->get('first_cat_order2') . ', ' . $mtconf->get('second_cat_order1') . ' ' . $mtconf->get('second_cat_order2');

$database->setQuery( $sql );
$cats = $database->loadObjectList();

# Get Pathway
$mtPathWay = new mtPathWay( $database );
$pathway = $mtPathWay->getPathWay( $cat_id );
$level = -1;

?>
<table width="90%" border="0" cellpadding="0" cellspacing="0">
<?php

// Print Root
echo '<tr><td>';
echo '<img src="components/com_mtree/img/dtree/base.gif" align="left" vspace="0" hspace="0" />';
echo '<a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=0&Itemid=$mt_itemid").'"> '.$_MT_LANG->ROOT."</a>";
echo "</td></tr>";
$level++;

// Print subcategories
foreach( $pathway AS $cid ) {
	$mtCat = new mtCats( $database );
	$mtCat->load( $cid );

	echo '<tr><td>';
	echo str_repeat($spacer, $level);
	echo '<img src="components/com_mtree/img/dtree/joinbottom.png" border="0" align="left" vspace="0" hspace="0" />';
	echo '<img src="components/com_mtree/img/dtree/folder.gif" align="left" vspace="0" hspace="0" />';
	echo '<a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=".$mtCat->cat_id."&Itemid=$mt_itemid").'" class="'.$currentcat_class.'"> '.$mtCat->cat_name."</a>";
	echo "</td></tr>";
	$level++;
}

// Print Current category
if ( $cat_id > 0 ) {
	$mtCat = new mtCats( $database );
	$mtCat->load( $cat_id );

	echo '<tr><td>';
	echo str_repeat($spacer, $level);
	echo '<img src="components/com_mtree/img/dtree/joinbottom.png" align="left" vspace="0" hspace="0" />';
	echo '<img src="components/com_mtree/img/dtree/folderopen.gif" align="left" vspace="0" hspace="0" />';
	echo '<a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=".$mtCat->cat_id."&Itemid=$mt_itemid").'" class="'.$subcat_class.'"> '.$mtCat->cat_name."</a>";
	echo "</td></tr>";
	$level++;
}

	foreach( $cats AS $cat) {
		echo '<tr><td>';
		echo str_repeat($spacer, $level);
		
		if ( $cat->cat_id == $cats[count($cats)-1]->cat_id ) {
			echo '<img src="components/com_mtree/img/dtree/joinbottom.png" align="left" vspace="0" hspace="0" />';
		} else {
			echo '<img src="components/com_mtree/img/dtree/join.png" align="left" vspace="0" hspace="0" />';
		}
		echo '<img src="components/com_mtree/img/dtree/folder.gif" align="left" vspace="0" hspace="0" />';
		echo '<a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=".$cat->cat_id."&Itemid=$mt_itemid").'" class="'.$subcat_class.'"> '.$cat->cat_name;

		if ( $show_totalcats xor $show_totallisting ) {
			echo " <small>(".(($show_totalcats)? $cat->cat_cats:$cat->cat_links ).")</small>";
		} elseif( $show_totalcats && $show_totallisting ) {
			echo " <small>(".$cat->cat_cats."/".$cat->cat_links.")</small>";
		}

		echo "</a>";
		echo "</td></tr>";
	}
?>
</table>