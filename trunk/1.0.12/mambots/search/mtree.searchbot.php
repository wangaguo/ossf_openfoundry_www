<?php
/**
* Mosets tree's Searchbot
*
* @package Mosets 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
global $mosConfig_absolute_path;
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Include the language file. Default is English
if ($mt_language=='') {
	$mt_language='english';
}
include_once( $mosConfig_absolute_path.'/components/com_mtree/language/'.$mt_language.'.php');

$_MAMBOTS->registerFunction( 'onSearch', 'botSearchMtree' );

DEFINE( "_MTREE_TITLE", $_MT_LANG->TITLE );

/**
* Search method
* @param array Named 'text' element is the search term
*/
function botSearchMtree( $text, $phrase='', $ordering='' ) {
	global $database;

	$text = trim( $text );
	if ($text == '') {
		return array();
	}

	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			$wheres2[] = "LOWER(p.link_name) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.link_desc) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.address) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.city) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.state) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.country) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.postcode) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.website) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_1) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_2) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_3) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_4) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_5) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_6) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_7) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_8) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_9) LIKE '%$text%'";
			$wheres2[] = "LOWER(p.cust_10) LIKE '%$text%'";
			$where = '(' . implode( ') OR (', $wheres2 ) . ')';

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
				$wheres2[] = "LOWER(p.link_name) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.link_desc) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.address) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.city) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.state) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.country) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.postcode) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.website) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_1) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_2) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_3) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_4) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_5) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_6) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_7) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_8) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_9) LIKE '%$word%'";
				$wheres2[] = "LOWER(p.cust_10) LIKE '%$word%'";
				$wheres[] = implode( ' OR ', $wheres2 );

				$wheres3 = array();
				$wheres3[] = "LOWER(cat_name) LIKE '%$word%'";
				$wheres3[] = "LOWER(cat_desc) LIKE '%$word%'";
				$wheres3[] = "LOWER(metakey) LIKE '%$word%'";
				$wheres3[] = "LOWER(metadesc) LIKE '%$word%'";
				$wheres_cat[] = implode( ' OR ', $wheres3 );

			}
			$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			$where_cat = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres_cat ) . ')';
			break;
	}

	switch ($ordering) {
		case 'newest':
		default:
			$order = 'p.link_created DESC';
			$order_cat = 'cat_created DESC';
			break;
		case 'oldest':
			$order = 'p.link_created ASC';
			$order_cat = 'cat_created ASC';
			break;
		case 'popular':
			$order = 'p.link_hits DESC';
			$order_cat = 'cat_name DESC'; // fall to alphabetically sorted since category does not nave hits
			break;
		case 'alpha':
			$order = 'p.link_name ASC';
			$order_cat = 'cat_name DESC';
			break;
		case 'category':
			$order = 'cat_name ASC, p.link_name ASC';
			$order_cat = 'cat_parent DESC';
			break;
	}

	# The main search query
	$database->setQuery( "SELECT p.link_id AS id, p.link_created AS created, p.link_name AS title,"
	. "\n	p.link_desc AS text, '0' AS browsernav, "
	. "\n	CONCAT('index.php?option=com_mtree&task=viewlink&link_id=',p.link_id) AS href,"
	.	"\n CONCAT_WS('/', '" . _MTREE_TITLE . "', c.cat_name) AS section"
	. "\nFROM (#__mt_links AS p, #__mt_cl AS cl, #__mt_cats AS c)"
	. "\nWHERE ($where)"
	. "\n	AND p.link_id = cl.link_id AND c.cat_id = cl.cat_id"
	.	"\n AND cl.main = 1 "
	. "\n	AND p.link_published='1' AND p.link_approved='1' AND c.cat_published='1' AND c.cat_approved='1' "
	. "\n	AND (p.publish_up = '0000-00-00 00:00:00' OR p.publish_up <= NOW())"
	. "\n	AND (p.publish_down = '0000-00-00 00:00:00' OR p.publish_down >= NOW())"
	. "\nORDER BY $order"
	);

	$listings_result = $database->loadObjectList();

	$database->setQuery("SELECT cat_id AS id, cat_created AS created, cat_name AS title,"
	. "\n	cat_desc AS text, '0' AS browsernav, "
	. "\n	CONCAT('index.php?option=com_mtree&task=listcats&cat_id=',cat_id) AS href,"
	.	"\n CONCAT_WS('/', '" . _MTREE_TITLE . "', cat_name) AS section"
	. "\nFROM #__mt_cats"
	. "\nWHERE ($where_cat)"
	.	"\n AND cat_approved = 1 AND cat_id > 0"
	. "\nORDER BY $order_cat"
	);
	$cats_result = $database->loadObjectList();

	return array_merge($listings_result,$cats_result);

}
?>