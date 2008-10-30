<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Base plugin class.
*/
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

/**
* Mosets Tree 
*
* @package Mosets Tree 0.8
* @copyright (C) 2004 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <cy@mosets.com>
**/


class Savant2_Plugin_mtpath extends Savant2_Plugin {
	
function plugin( $cat_id, $attr = null)	{
	global $Itemid, $mosConfig_absolute_path, $_MT_LANG;

	require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php');

	$mtPathWay = new mtPathWay( $cat_id );
	$cat_ids = $mtPathWay->getPathWay();
	$cat_ids[] = $cat_id;

	$cat_names = array();

	if ( empty($cat_ids[0]) ) {
		$cat_names[] = $_MT_LANG->ROOT;
	}

	foreach( $cat_ids AS $cid ) {
		// Do not add 'Root' name since its done above already
		if ( $cid > 0 ) {
			$cat_names[] = $mtPathWay->getCatName($cid);
		}
	}

	$html = '<a href="';
	$html .= sefRelToAbs('index.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'&Itemid='.$Itemid);
	$html .= '"';
	
	# Insert attributes
	if (is_array($attr)) {
		// from array
		foreach ($attr as $key => $val) {
			$key = htmlspecialchars($key);
			$val = htmlspecialchars($val);
			$html .= " $key=\"$val\"";
		}
	} elseif (! is_null($attr)) {
		// from scalar
		$html .= " $attr";
	}
	
	# set the listing text, close the tag
	$html .= '>' . htmlspecialchars( implode($_MT_LANG->ARROW, $cat_names) ) . '</a> ';

	return $html;

	}
}
?>