<?php
/**
* Mosets tree's Searchbot
*
* @package Mosets 2.0
* @copyright (C) 2005 - 2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (defined('JVERSION')) {
	require( JPATH_ADMINISTRATOR . DS.'components'.DS.'com_mtree'.DS.'config.mtree.class.php');
	$database =& JFactory::getDBO();
	$mtconf	= new mtConfig($database);
	require_once( JPATH_SITE.DS.'components'.DS.'com_mtree'.DS.'language'.DS. $mtconf->get('language') . '.php');
	if ( !isset($_MT_LANG) ) {
		$_MT_LANG =& new mtLanguage();	
	}
} else {
	include( $mosConfig_absolute_path . '/components/com_mtree/init.php');
}

$_MAMBOTS->registerFunction( 'onSearch', 'botSearchMtree' );

DEFINE( "_MTREE_TITLE", $_MT_LANG->TITLE );

/**
* Search method
* @param array Named 'text' element is the search term
*/
function botSearchMtree( $text, $phrase='', $ordering='' ) {
	global $database, $mosConfig_absolute_path;
	include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

	$text = trim( $text );
	if ($text == '') {
		return array();
	}

	$database->setQuery("SELECT field_type,published,simple_search FROM #__mt_customfields WHERE iscore = 1");
	$searchable_core_fields = $database->loadObjectList('field_type');
	
	# Determine if there are custom fields that are simple searchable
	$database->setQuery("SELECT COUNT(*) FROM #__mt_customfields WHERE published = 1 AND simple_search = 1 AND iscore = 0");
	$searchable_custom_fields_count = $database->loadResult();
	
	$link_fields = array('link_name', 'link_desc', 'address', 'city', 'postcode', 'state', 'country', 'email', 'website', 'telephone', 'fax' );

	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			foreach( $link_fields AS $lf ) {
				if ( substr($lf, 0, 5) == "link_" && array_key_exists('core'.substr($lf,5),$searchable_core_fields) && $searchable_core_fields['core'.substr($lf,5)]->published == 1 && $searchable_core_fields['core'.substr($lf,5)]->simple_search == 1 ) {
					$wheres2[] = "LOWER(l.$lf) LIKE '%$text%'";
				} elseif(array_key_exists('core'.$lf,$searchable_core_fields) && $searchable_core_fields['core'.$lf]->published == 1 && $searchable_core_fields['core'.$lf]->simple_search == 1) {
					$wheres2[] = "LOWER(l.$lf) LIKE '%$text%'";
				}
			}
			if($searchable_custom_fields_count > 0) {
				$wheres2[] = '(cf.hidden = 0 AND cf.simple_search = 1 AND cf.published = 1 AND LOWER(cfv.value) LIKE \'%' . $text . '%\')';
			}
			$where = '( (' . implode( ') OR (', $wheres2 ) . ') )';

			$wheres3[] = "LOWER(cat_name) LIKE '%$text%'";
			$wheres3[] = "LOWER(cat_desc) LIKE '%$text%'";
			$wheres3[] = "LOWER(metakey) LIKE '%$text%'";
			$wheres3[] = "LOWER(metadesc) LIKE '%$text%'";
			$where_cat = '(' . implode( ') OR (', $wheres3 ) . ')';
			break;
		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
				foreach( $link_fields AS $lf ) {
					if ( substr($lf, 0, 5) == "link_" && array_key_exists('core'.substr($lf,5),$searchable_core_fields) && $searchable_core_fields['core'.substr($lf,5)]->published == 1 && $searchable_core_fields['core'.substr($lf,5)]->simple_search == 1 ) {
						$wheres2[] = "LOWER(l.$lf) LIKE '%$word%'";
					} elseif(array_key_exists('core'.$lf,$searchable_core_fields) && $searchable_core_fields['core'.$lf]->published == 1 && $searchable_core_fields['core'.$lf]->simple_search == 1) {
						$wheres2[] = "LOWER(l.$lf) LIKE '%$word%'";
					}
				}
				if($searchable_custom_fields_count > 0) {
					$wheres2[] = '(cf.hidden = 0 AND cf.simple_search = 1 AND cf.published = 1 AND LOWER(cfv.value) LIKE \'%' . $word . '%\')';
				}
				
				$wheres[] = '(' . implode( ' OR ', $wheres2 ) . ')';
				
				$wheres3 = array();
				$wheres3[] = "LOWER(cat_name) LIKE '%$word%'";
				$wheres3[] = "LOWER(cat_desc) LIKE '%$word%'";
				$wheres3[] = "LOWER(metakey) LIKE '%$word%'";
				$wheres3[] = "LOWER(metadesc) LIKE '%$word%'";
				$wheres_cat[] = implode( ' OR ', $wheres3 );

			}
			if($wheres[0] == '()') {
				$where = '';
			} else {
				$where = "\n(\n" . implode( ($phrase == 'all' ? "\nAND\n" : "\nOR\n"), $wheres ) . "\n)";
			}
			$where_cat = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres_cat ) . ')';
			break;
	}

	switch ($ordering) {
		case 'newest':
		default:
			$order = 'l.link_created DESC';
			$order_cat = 'cat_created DESC';
			break;
		case 'oldest':
			$order = 'l.link_created ASC';
			$order_cat = 'cat_created ASC';
			break;
		case 'popular':
			$order = 'l.link_hits DESC';
			$order_cat = 'cat_name DESC'; // fall to alphabetically sorted since category does not nave hits
			break;
		case 'alpha':
			$order = 'l.link_name ASC';
			$order_cat = 'cat_name DESC';
			break;
		case 'category':
			$order = 'cat_name ASC, l.link_name ASC';
			$order_cat = 'cat_parent DESC';
			break;
	}

	# Retrieve Mosets Tree Itemid
	$database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_mtree' AND published = 1 LIMIT 1");
	$Itemid = $database->loadResult();
	
	# The main search query
	if( !empty($where) ) {
		$sql = "SELECT DISTINCT l.link_id AS id, l.link_created AS created, l.link_name AS title,"
			. "\n	l.link_desc AS text, '0' AS browsernav, "
			. "\n	CONCAT('index.php?option=com_mtree&task=viewlink&link_id=',l.link_id,'&Itemid=" . $Itemid . "') AS href,"
			. "\n	CONCAT_WS('/', '" . $database->getEscaped(_MTREE_TITLE) . "', c.cat_name) AS section"
			. "\nFROM (#__mt_links AS l, #__mt_cl AS cl";
		if($searchable_custom_fields_count > 0) {
			$sql .= ", #__mt_customfields AS cf";
		}
		$sql .= ")";
		if($searchable_custom_fields_count > 0) {
			$sql .= "\n LEFT JOIN #__mt_cfvalues AS cfv ON cfv.link_id = l.link_id AND cfv.cf_id = cf.cf_id";
		}
		$sql .= "\nLEFT JOIN #__mt_cats AS c ON c.cat_id = cl.cat_id " 
			. "\nWHERE " 
			. "\n	link_published='1' AND link_approved='1' AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= NOW()  ) AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= NOW() )"
			. "\n	AND cl.link_id = l.link_id "
			. "\n	AND cl.main = 1 ";
		$sql .= "\n AND ".$where
			.	"\n ORDER BY " . $mtconf->get('first_search_order1') . ' ' . $mtconf->get('first_search_order2') . ', ' . $mtconf->get('second_search_order1') . ' ' . $mtconf->get('second_search_order2');
		$database->setQuery($sql);
		$listings_result = $database->loadObjectList();
	} else {
		$listings_result = array();
	}

	$database->setQuery("SELECT cat_id AS id, cat_created AS created, cat_name AS title,"
	. "\n	cat_desc AS text, '0' AS browsernav, "
	. "\n	CONCAT('index.php?option=com_mtree&task=listcats&cat_id=',cat_id,'&Itemid=" . $Itemid . "') AS href,"
	.	"\n CONCAT_WS('/', '" . $database->getEscaped(_MTREE_TITLE) . "', cat_name) AS section"
	. "\nFROM #__mt_cats"
	. "\nWHERE ($where_cat)"
	.	"\n AND cat_approved = 1 AND cat_id > 0"
	. "\nORDER BY $order_cat"
	);
	$cats_result = $database->loadObjectList();

	return array_merge($listings_result,$cats_result);

}
?>