<?php
/**
* Mosets Tree dTree
*
* @package Mosets Tree 2.0
* @copyright (C) 2005 - 2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php');

# Get params
$root_image = $params->get( 'root_image', 'components/com_mtree/img/dtree/base.gif' );
$cat_image = $params->get( 'cat_image', 'components/com_mtree/img/dtree/folder.gif' );
$show_empty_cat = $params->get( 'show_empty_cat', $mtconf->get('display_empty_cat') );
$show_totalcats = $params->get( 'show_totalcats', 0 );
$show_totallisting = $params->get( 'show_totallisting', 0 );
$closesamelevel = $params->get( 'closesamelevel', 1 );
$root_catid = $params->get( 'root_catid', 0 );
$cat_level = $params->get( 'cat_level', 2 );
$width = $params->get( 'width', 159 );
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

$category_order1 = $params->get( 'category_order1', 'cat_name' );
$category_order2 = $params->get( 'category_order2', 'desc' );
$show_listings = $params->get( 'show_listings', 0 );
$listing_order1 = $params->get( 'listing_order1', 'link_name' );
$listing_order2 = $params->get( 'listing_order2', 'desc' );

if ($show_empty_cat == -1) $show_empty_cat = $mtconf->get('display_empty_cat');

preg_match("/^(http:\/\/)?([^\/]+)/i", $mosConfig_live_site, $matches);
$mt_domain = $matches[2];
$mt_path = substr($mosConfig_live_site,strlen($matches[2])+7);

# Get Itemid, determine if the MT component is published
global $mt_itemid;
if(!isset($mt_itemid)) {
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$mt_itemid = $database->loadResult();
}

# Detect whether cat_id / link_id present
$cat_id = trim( mosGetParam( $_REQUEST, 'cat_id', 0 ) );
$link_id = trim( mosGetParam( $_REQUEST, 'link_id', '' ) );

// Get Link's category
if ( $link_id > 0 && $cat_id == 0 ) {
	$mtLink = new mtLinks( $database );
	$mtLink->load( $link_id );
	$cat_id = $mtLink->cat_id;
}

$cats = mt_getChildren( $root_catid, $cat_level, $mtconf->get('display_empty_cat'), $category_order1, $category_order2 );

# Get all links
if ($show_listings == 1) {
	global $mosConfig_offset;
	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

	$cat_ids = array();
	foreach( $cats AS $cc ) {
		$cat_ids[] = $cc->cat_id;
	}

	$cat_ids[] = $root_catid;

	$database->setQuery( "SELECT l.link_id, l.link_name, cl.cat_id FROM #__mt_links AS l, #__mt_cl AS cl " 
		.	"\n WHERE l.link_published='1' && l.link_approved='1' "
		.	"\n AND ( l.publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		.	"\n AND ( l.publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		.	"\n AND l.link_id = cl.link_id AND cl.cat_id IN ('".implode("','",$cat_ids)."') AND cl.main = '1'"
		.	"\n ORDER BY ".$listing_order1." ".$listing_order2
	);
	$listings = $database->loadObjectList('link_id');
}

?>
	<link rel="StyleSheet" href="components/com_mtree/js/dtree.css" type="text/css" />
	<script type="text/javascript" src="components/com_mtree/js/dtree.js"></script>
	<div style="overflow:hidden;width:<?php echo $width; ?>px;">
	<script type="text/javascript">
		<!--
		fpath = '<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/folder.gif';
		ppath = '<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/page.gif';

		d = new dTree('d');

		d.config.closeSameLevel = <?php echo ($closesamelevel) ? 'true':'false'; ?>; 
		d.config.inOrder = true;
		d.config.domain = '<?php echo $mt_domain; ?>';
		d.config.path = '<?php echo $mt_path; ?>';
		<?php if(defined('JVERSION')) { ?>
		d.icon.root = '<?php echo $mtconf->getjconf('live_site') . ''; ?>/components/com_mtree/img/dtree/base.gif';
		d.icon.folder = '<?php echo $mtconf->getjconf('live_site') . ''; ?>/components/com_mtree/img/dtree/folder.gif';
		d.icon.folderOpen='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/folderopen.gif';
		d.icon.node='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/page.gif';
		d.icon.empty='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/empty.gif';
		d.icon.line='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/line.png';
		d.icon.join='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/join.png';
		d.icon.joinBottom='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/joinbottom.png';
		d.icon.plus = '<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/plus.png';
		d.icon.plusBottom='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/plusbottom.png';
		d.icon.minus='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/minus.gif';
		d.icon.minusBottom='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/minusbottom.gif';
		d.icon.nlPlus='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/nolines_plus.gif';
		d.icon.nlMinus='<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/img/dtree/nolines_minus.gif';
		<?php } 
		
		if ( $root_catid == 0 ) { ?>
		d.add(0,-1, '<?php echo $_MT_LANG->ROOT ?>', '<?php echo sefRelToAbs("index.php?option=com_mtree&Itemid=$mt_itemid"); ?>');
		<?php } else { 
		$database->setQuery( "SELECT cat_name, cat_id FROM #__mt_cats WHERE cat_id ='".$root_catid."'" );
		$database->loadObject($root);
		?>
		d.add(<?php echo $root_catid ?>,-1, '<?php echo $root->cat_name ?>', '<?php echo sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$root_catid&Itemid=$mt_itemid"); ?>');

		<?php
		}

		foreach( $cats AS $cat ) {

			if ( $show_empty_cat == 0 && $cat->cat_links == 0 && $cat->cat_cats == 0 ) {
				// Do Nothing
			} else {
				echo "\n ";
				echo "d.add(";
				echo $cat->cat_id.",";
				echo $cat->cat_parent.",";
				
				// Print Category Name
				echo "'".addslashes(htmlspecialchars($cat->cat_name, ENT_QUOTES ));
				if ( $show_totalcats xor $show_totallisting ) {
					echo " <small>(".(($show_totalcats)? $cat->cat_cats:$cat->cat_links ).")</small>";
				} elseif( $show_totalcats && $show_totallisting ) {
					echo " <small>(".$cat->cat_cats."/".$cat->cat_links.")</small>";
				}
				echo "',";

				echo "'".sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=$cat->cat_id&Itemid=$mt_itemid")."',";
				echo "'', '',";
				echo "fpath";
				echo ");";
			}

		}

		if ( $show_listings == 1 ) {
			foreach( $cats AS $cat ) {

				foreach( $listings AS $cl ) {
					if( $cl->cat_id == $cat->cat_id ) {
						echo "\n ";
						echo "d.add(";
						echo (10000 + $cl->link_id).",";
						echo $cat->cat_id.",";
						
						// Print Listing Name
						echo "'".addslashes(htmlspecialchars($cl->link_name, ENT_QUOTES ))."',";
						echo "'".sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$cl->link_id&Itemid=$mt_itemid")."',";
						echo "'', '',";
						echo "ppath";
						echo ");";
						unset( $listings[$cl->link_id] );
					}
				}
			}
			
			foreach( $listings AS $cl ) {
				echo "\n ";
				echo "d.add(";
				echo (10000 + $cl->link_id).",";
				echo $cl->cat_id.",";
				
				// Print Listing Name
				echo "'".addslashes(htmlspecialchars($cl->link_name, ENT_QUOTES ))."',";
				echo "'".sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$cl->link_id&Itemid=$mt_itemid")."',";
				echo "'', '',";
				echo "ppath";
				echo ");";
				unset( $listings[$cl->link_id] );
			}
		}

		?>
		document.write(d);
		<?php 
		if ( $show_listings == '1' && $link_id > 0 )	{
		?>
		d.openTo(<?php echo (10000 + $link_id) ?>,true);
		<?php
		} else if( $cat_id > 0 ) { ?>
		d.openTo(<?php echo $cat_id ?>,true);
		<?php } ?>

		//-->
	</script>
</div><?php

function mt_getChildren( $cat_id, $cat_level, $mt_display_empty_cat, $category_order1, $category_order2 ) {
	global $database;

	$cat_ids = array();

	if ( $cat_level > 0  ) {

		$sql = "SELECT cat_id, cat_name, cat_parent, cat_cats, cat_links FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ";
		
		if ( !$mt_display_empty_cat ) { 
			$sql .= "&& ( cat_cats > 0 || cat_links > 0 ) ";	
		}

		//$sql .= "\nORDER BY cat_name ASC ";
		//$sql .= "\nORDER BY ordering ASC, cat_name ASC ";
		$sql .= "\nORDER BY $category_order1 $category_order2";

		$database->setQuery( $sql );

		$cat_ids = $database->loadObjectList();

		if ( count($cat_ids) ) {
			foreach( $cat_ids AS $cid ) {
				$children_ids = mt_getChildren( $cid->cat_id, ($cat_level-1), $mt_display_empty_cat, $category_order1, $category_order2 );
				$cat_ids = array_merge( $cat_ids, $children_ids );
			}
		}
	}

	return $cat_ids;

}

?>