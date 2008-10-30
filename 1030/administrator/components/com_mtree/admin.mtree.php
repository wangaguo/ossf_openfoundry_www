<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/admin.mtree.class.php' );
require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/tools.mtree.php' );
require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/config.mtree.php' );

# Categories name cache
$cache_cat_names = array();

# Include the language file. Default is English
include_once( $mosConfig_absolute_path . '/components/com_mtree/language/'.$mt_language.'.php');

/* Cat ID 
 * Categories selected in category list
 */
$cat_id_fromurl = mosGetParam( $_REQUEST, 'cat_id', '' );
if ($cat_id_fromurl == '') {
	$cat_id = mosGetParam( $_POST, 'cid', array(0) );
} else {
	$cat_id = array( $cat_id_fromurl );
}

/* 
 * Link ID 
 * Listings selected in listing list
 */
$link_id_fromurl = mosGetParam( $_REQUEST, 'link_id', '' );
if ($link_id_fromurl == '') {
	$link_id = mosGetParam( $_POST, 'lid', array(0) );
} else {
	$link_id = array( $link_id_fromurl );
}

/* Review ID */
$rev_id = mosGetParam( $_POST, 'rid', array(0) );

$cat_parent = mosGetParam( $_POST, 'cat_parent', '' );
if ( $cat_parent == '' ) {
	$cat_parent = mosGetParam( $_REQUEST, 'cat_parent', 0 );
}

/* Hide menu */
$hide_menu = mosGetParam( $_REQUEST, 'hide', 0 );

/* Start Left Navigation Menu */
if ( !$hide_menu && $task != "upgrade" ) {
	HTML_mtree::print_startmenu( $task );
}

//generate_random_listings( 25000 );

switch ($task) {

	/***
	 * Categories
	 */
	case "listcats":
		listcats( $cat_id[0], $cat_parent, $option );
		break;
	case "newcat":
		editcat( 0, $cat_parent, $option );
		break;
	case "editcat":
		editcat( $cat_id[0], $cat_parent, $option );
		break;
	case "editcat_browse_cat":
		editcat_browse_cat( $option, 0 );
		break;
	case "editcat_add_relcat":
		editcat_browse_cat( $option, 1 );
		break;
	case "editcat_remove_relcat":
		editcat_browse_cat( $option, -1 );
		break;
	case "applycat":
	case "savecat":
		mosCache::cleanCache( 'com_mtree' );
		savecat( $option );
		break;
	case "cat_publish":
		mosCache::cleanCache( 'com_mtree' );
		publishCats( $cat_id, 1, $option );
		break;
	case "cat_unpublish":
		mosCache::cleanCache( 'com_mtree' );
		publishCats( $cat_id, 0, $option );
		break;
	case "cancelcat":
		cancelcat( $cat_parent, $option );
		break;
	case "removecats":
		mosCache::cleanCache( 'com_mtree' );
		removecats( $cat_id, $option );
		break;
	case "removecats2":
		mosCache::cleanCache( 'com_mtree' );
		removecats2( $cat_id, $option );
		break;
	
	case "fastadd_cat":
		mosCache::cleanCache( 'com_mtree' );
		fastadd_cat( $cat_parent, $option );
		break;

	/*
	case "cat_orderup":
		orderCats( $cat_id[0], -1, $option );
		break;
	case "cat_orderdown":
		orderCats( $cat_id[0], 1, $option );
		break;
	*/
	case "cat_featured":
		mosCache::cleanCache( 'com_mtree' );
		featuredCats( $cat_id, 1, $option );
		break;
	case "cat_unfeatured":
		mosCache::cleanCache( 'com_mtree' );
		featuredCats( $cat_id, 0, $option );
		break;
	case "cats_move":
		moveCats( $cat_id, $cat_parent, $option );
		break;
	case "cats_move2":
		mosCache::cleanCache( 'com_mtree' );
		moveCats2( $cat_id, $option );
		break;
	case "cats_copy":
		copyCats( $cat_id, $cat_parent, $option );
		break;
	case "cats_copy2":
		mosCache::cleanCache( 'com_mtree' );
		copyCats2( $cat_id, $option );
		break;
	case "cancelcats_move":
		cancelcats_move( $cat_id[0], $option );
		break;

	/***
	 * Links
	 */
	case "newlink":
		editlink( 0, $cat_parent, false, $option );
		break;
	case "editlink":
		editlink( $link_id[0], $cat_parent, false, $option );
		break;
	case "editlink_for_approval":
		editlink( $link_id[0], $cat_parent, true, $option );
		break;

	case "editlink_browse_cat":
		editlink_browse_cat( $option, 0 );
		break;
	case "editlink_add_cat":
		editlink_browse_cat( $option, 1 );
		break;
	case "editlink_remove_cat":
		editlink_browse_cat( $option, -1 );

	case "spiderurl":
		spiderurl( $option );
		break;
	case "openurl":
		openurl( $option );
		break;
	case "editlink_change_cat":
		editlink_change_cat( $option );
		break;
	case "savelink":
	case "applylink":
		mosCache::cleanCache( 'com_mtree' );
		savelink( $option );
		break;
	case "next_link":
		mosCache::cleanCache( 'com_mtree' );
		prev_next_link( "next", $option );
		break;
	case "prev_link":
		mosCache::cleanCache( 'com_mtree' );
		prev_next_link( "prev", $option );
		break;
	case "link_publish":
		mosCache::cleanCache( 'com_mtree' );
		publishLinks( $link_id, 1, $option );
		break;
	case "link_unpublish":
		mosCache::cleanCache( 'com_mtree' );
		publishLinks( $link_id, 0, $option );
		break;
	case "removelinks":
		mosCache::cleanCache( 'com_mtree' );
		removelinks( $link_id, $option );
		break;
	/*
	case "link_orderup":
		orderLinks( $link_id[0], -1, $option );
		break;
	case "link_orderdown":
		orderLinks( $link_id[0], 1, $option );
		break;
	*/
	case "link_featured":
		mosCache::cleanCache( 'com_mtree' );
		featuredLinks( $link_id, 1, $option );
		break;
	case "link_unfeatured":
		mosCache::cleanCache( 'com_mtree' );
		featuredLinks( $link_id, 0, $option );
		break;
	case "cancellink":
		cancellink( $link_id[0], $option );
		break;
	case "links_move":
		moveLinks( $link_id, $cat_parent, $option );
		break;
	case "links_move2":
		mosCache::cleanCache( 'com_mtree' );
		moveLinks2( $link_id, $option );
		break;
	case "cancellinks_copy":
	case "cancellinks_move":
		cancellinks_move( $link_id[0], $option );
		break;
	case "links_copy":
		copyLinks( $link_id, $cat_parent, $option );
		break;
	case "links_copy2":
		mosCache::cleanCache( 'com_mtree' );
		copyLinks2( $link_id, $option );
		break;

	/***
	* Approval / List Pending
	*/
	case "listpending_cats":
		listpending_cats( $option );
		break;
	case "approve_cats":
		mosCache::cleanCache( 'com_mtree' );
		approve_cats( $cat_id, 0, $option );
		break;
	case "approve_publish_cats":
		mosCache::cleanCache( 'com_mtree' );
		approve_cats( $cat_id, 1, $option );
		break;

	case "listpending_links":
		listpending_links( $option );
		break;
	case "approve_links":
		mosCache::cleanCache( 'com_mtree' );
		approve_links( $link_id, 0, $option );
		break;
	case "approve_publish_links":
		mosCache::cleanCache( 'com_mtree' );
		approve_links( $link_id, 1, $option );
		break;

	case "listpending_reviews":
		listpending_reviews( $option );
		break;
	case "save_pending_reviews":
		save_pending_reviews( $option );
		break;

	case "listpending_reports":
		listpending_reports( $option );
		break;
	case "save_reports":
		save_reports( $option );
		break;

	case "listpending_claims":
		listpending_claims( $option );
		break;
	case "save_claims":
		save_claims( $option );
		break;

	/***
	* Reviews
	*/
	case "reviews_list":
		list_reviews( $link_id[0], $option );
		break;
	case "newreview":
		editreview( 0, $link_id[0], $option );
		break;
	case "editreview":
		editreview( $rev_id[0], $cat_parent, $option );
		break;
	case "savereview":
		mosCache::cleanCache( 'com_mtree' );
		savereview( $option );
		break;
	case "cancelreview":
		cancelreview( $link_id[0], $option );
		break;
	case "removereviews":
		mosCache::cleanCache( 'com_mtree' );
		removereviews( $rev_id, $option );
		break;
	case "backreview":
		backreview( $link_id[0], $option );
		break;

	/***
	* Search
	*/
	case "search":
		search( $option );
		break;
	case "advsearch":
		advsearch( $option );
		break;
	case "advsearch2":
		advsearch2( $option );
		break;

	/***
	* About Mosets Tree
	*/
	case "about":
		HTML_mtree::about( $option );
		break;

	/***
	* Languages
	*/
	case "languages":
		require_once( $mosConfig_absolute_path .'/includes/domit/xml_domit_lite_include.php' );
		$active_language = mosGetParam( $_REQUEST, 'language', '' );
		languages( $active_language, $option );
		break;
	case "save_language":
		mosCache::cleanCache( 'com_mtree' );
		save_language( $option );
		break;
	case "cancel_language":
		cancel_language( $option );
		break;

	/***
	* Tree Templates
	*/
	case "templates":
		require_once( $mosConfig_absolute_path .'/includes/domit/xml_domit_lite_include.php' );
		templates( $option );
		break;
	case "edit_templatepage":
		edit_templatepage( $option );
		break;
	case "save_templatepage":
		mosCache::cleanCache( 'com_mtree' );
		save_templatepage( $option );
		break;
	case "cancel_template":
		cancel_template( $option );
		break;

	/***
	* Configuration
	*/
	case "config":
		config( $option );
		break;
	case "saveconfig":
		mosCache::cleanCache( 'com_mtree' );
		saveconfig( $option );
		break;
	
	/***
	* Custom Fields
	*/
	case "customfields":
		customfields( $option );
		break;
	case "save_customfields":
		mosCache::cleanCache( 'com_mtree' );
		save_customfields( $option );
		break;

	/***
	* License
	*/
	case "license":
		include( "license.mtree.php" );
		break;

	/***
	* CSV Import/Export
	*/
	case "csv":
		csv( $option );
		break;
	case "csv_export":
		csv_export( $option );
		break;

	/***
	* Upgrade routine
	*/
	case "upgrade":
		require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/upgrade.php' );
		break;

	/***
	* Diagnosis
	*/
	case "diagnosis":
		require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/diagnosis.php' );
		startprint( 0 );
		break;

	/***
	* Rebuild Tree
	*/
	case "rebuild_tree":
		$tree = new mtTree();
		$tree->rebuild( 0, 1);

		$database->setQuery( "SELECT MAX(rgt) FROM #__mt_cats" );
		$max_rgt = $database->loadResult();
		$database->setQuery( "UPDATE #__mt_cats SET rgt = ".($max_rgt +1).", lft=1 WHERE cat_id = 0 OR cat_parent = -1" );
		$database->query();
		break;

	/***
	* Global Update
	*/
	case "globalupdate":
		mosCache::cleanCache( 'com_mtree' );
		require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/recount.mtree.php' );
		update_cats_and_links_count( 0, true, true );
		mosRedirect( "index2.php?option=$option&task=listcats&cat_id=0", $_MT_LANG->CAT_AND_LISTING_COUNT_UPDATED );
		break;

	/***
	* Recount
	*/
	case "fullrecount":
		require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/recount.mtree.php' );
		recount( 'full', $cat_id[0] );
		break;
	
	case "fastrecount":
		require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/recount.mtree.php' );
		recount( 'fast', $cat_id[0] );
		break;
		

	/***
	* Default List Category
	*/
	default:
		listcats( $cat_id[0], $cat_parent, $option );
		break;
}

/* End Left Navigation Menu */
if ( !$hide_menu && $task != "upgrade" ) {
	HTML_mtree::print_endmenu();
}


/***
 * Link
 */

function editlink( $link_id, $cat_id, $for_approval=false, $option ) {
	global $database, $my, $mainframe, $_MT_LANG, $mosConfig_absolute_path;
	
	$row = new mtLinks( $database );
	$row->load( $link_id );

	if ($row->link_id == 0) {
		$row->cat_id = $cat_id;
		$row->link_hits = 0;
		$row->link_visited = 0;
		$row->link_votes = 0;
		$row->link_rating = 0.00;
		$row->link_featured = 0;
		$row->link_created = date('Y-m-d H:i:s');
		$row->link_published = 1;
		$row->link_approved = 1;
		$row->user_id = $my->id;
		$row->owner= $my->username;
	} else {
		if ($row->user_id > 0) {
			$database->setQuery("SELECT username FROM #__users WHERE id ='".$row->user_id."'");
			$row->owner = $database->loadResult();
		} else {
			$row->owner= $my->username;
		}
	}

	if ( $cat_id == 0 && $row->cat_id > 0 ) $cat_id = $row->cat_id;

	$lists = array();

	# build the html select list for ordering
	/*
	$order = mosGetOrderingList( "SELECT ordering AS value, link_name AS text"
		. "\nFROM #__mt_links AS l, #__mt_cl AS cl"
		. "\nWHERE cl.cat_id='cat_id' ORDER BY ordering"
	);
	$lists["ordering"] = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"',
		'value', 'text', intval( $row->ordering ) );
	*/

	# Template select list
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', $_MT_LANG->DEFAULT );

	foreach($templateDirs as $templateDir) {
		if ( $templateDir <> "index.html") $templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'link_template', 'class="inputbox" size="1"',
	'value', 'text', $row->link_template );

	# Get other categories
	$database->setQuery( "SELECT cl.cat_id FROM #__mt_cl AS cl WHERE cl.link_id = '$link_id' AND cl.main = '0'");
	$other_cats = $database->loadResultArray();

	# Compile list of categories - Related Categories
	$categories = array();
//	$browse_cat = $row->getParent($cat_parent);
	$browse_cat = $cat_id;
	if ( $browse_cat > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$browse_cat'");
		$browse_cat_parent = $database->loadResult();
		$categories[] = mosHTML::makeOption( $browse_cat_parent, '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	//. "\nWHERE cat_parent='". $row->getParent($cat_parent) ."' ORDER BY ordering" );
	. "\nWHERE cat_parent='". $cat_id ."' ORDER BY cat_name" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['new_other_cat'] = mosHTML::selectList( $categories, 'new_other_cat', 'class="inputbox" size="1"',
	//'value', 'text', ( ($row->cat_id == 0) ? $cat_parent : $row->cat_id ) );
	'value', 'text', $cat_id );
	unset( $categories );

	# Get Pathway
	//$pathWay = new mtPathWay( $cat_id );
	$pathWay = new mtPathWay( $row->getCatID() );

	# Is this approval for modification?
	if ( $row->link_approved < 0 ) {
		$row->original_link_id = (-1 * $row->link_approved);
	} else {
		$row->original_link_id = '';
	}

	# Retrieve the custom field's caption
	$database->setQuery("SELECT name, value FROM #__mt_config WHERE name LIKE 'cust_%' ORDER BY name");
	$custom_fields = $database->loadObjectList('name');

	# Compile list of categories
	$categories = array();
	if ( $cat_id > 0 ) {
		$categories[] = mosHTML::makeOption( '-1', '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='$cat_id' ORDER BY ordering" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['cat_id'] = mosHTML::selectList( $categories, 'new_cat_id', 'class="inputbox" size="1"',
	'value', 'text', $row->getCatID() );

	# Yes/No select list for Approved Link
	$lists['link_approved'] = mosHTML::yesnoRadioList("link_approved", 'class="inputbox"', (($row->link_approved == 1) ? 1 : 0));

	# Yes/No select list for Featured Link
	$lists['link_featured'] = mosHTML::yesnoRadioList("link_featured", 'class="inputbox"', $row->link_featured);

	# Yes/No select list for "Published"
	$lists['link_published'] = mosHTML::yesnoRadioList("link_published", 'class="inputbox"', $row->link_published);

	# Get Return task - Used by listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	# Get params definitions
	$params =& new mosParameters( $row->attribs, "$mosConfig_absolute_path/administrator/components/$option/params/mtree.listing.xml" );

	if ( $row->link_approved <= 0 ) {
		$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_approved <= 0 ORDER BY link_created ASC, link_modified DESC" );
		$links = $database->loadResultArray();
		$number_of_prev = array_search($row->link_id,$links);
		$number_of_next = count($links) - 1 - $number_of_prev;
	} else {
		$number_of_prev = 0;
		$number_of_next = 0;
	}

	HTML_mtree::editlink( $row, $cat_id, $other_cats, $browse_cat, $custom_fields, $lists, $number_of_prev, $number_of_next, $pathWay, $returntask, $params, $option );
}

function editlink_browse_cat( $option, $add=0 ) {
	global $database, $mosConfig_absolute_path, $_MT_LANG;

	$row = new mtLinks( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->owner = mosGetParam( $_POST, 'owner', '' );

	$lists = array();

	# Template select list
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', $_MT_LANG->DEFAULT );

	foreach($templateDirs as $templateDir) {
		if ( $templateDir <> "index.html") $templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'link_template', 'class="inputbox" size="1"',
	'value', 'text', $row->link_template );

	# Other Categories
	$other_cats = mosGetParam( $_POST, 'other_cats', '' );
	if ( $other_cats <> '' ) {
		$other_cats = explode(', ', $other_cats);
	}

	/*
	$new_cat_id = mosGetParam( $_POST, 'new_cat_id', '' );
	if ( $new_cat_id >= 0 ) {
		$row->cat_id = $new_cat_id;
	} elseif ( $new_cat_id == -1 ) {
		// Change directory to parent
		$getparent = new mtCats( $database );
		$getparent->load( $cat_id );
		$row->cat_id = $getparent->getParent();
	}

	*/

	$new_other_cat = intval(mosGetParam( $_POST, 'new_other_cat', 0 ));
	$link_id = intval(mosGetParam( $_POST, 'link_id', 0 ));

	# Adding new other Category
	if ( $add == 1) {

		// Prevent adding own category
		if ( $new_other_cat == $row->cat_id ) {
			echo "<script> alert('".$_MT_LANG->NOT_ALLOWED_TO_ADD_OWN_CAT_AS_OTHERCAT."'); window.history.go(-1); </script>\n";
			exit();
		}

		// Prevent adding "Back"
		/*
		if ( $new_other_cat == 0 ) {
			echo "<script> alert('".$_MT_LANG->CHOOSE_A_CAT_BEFORE_ADDING."'); window.history.go(-1); </script>\n";
			exit();
		}
		*/

		// Prevent same duplicates of other category
		if ( !empty($other_cats) ) {
			if ( in_array($new_other_cat, $other_cats) ) {
				echo "<script> alert('".$_MT_LANG->YOU_HAVE_ALREADY_ADD_THIS_CAT."'); window.history.go(-1); </script>\n";
				exit();
			}
		}

		// If users chooses "Back" and press Add, we assume he's trying to add the parent
		if ( $new_other_cat == 0 ) {
		}

		$other_cats[] = $new_other_cat;
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$new_other_cat'");
		$browse_cat = $database->loadResult();

	# Removing other Category
	}	elseif ( $add == -1 ) {
		$remove_cat = mosGetParam( $_POST, 'remove_cat', array(0) );
		$other_cats = array_diff($other_cats, $remove_cat);
		$browse_cat = $new_other_cat;

	} else {
		$browse_cat = $new_other_cat;
	}

	# Get other categories
	/*
	$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = '$link_id' AND main = '0'");
	$other_cats = $database->loadResultArray();
	*/

	# Compile list of categories - Related Categories
	$categories = array();
	if ( $browse_cat > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$browse_cat'");
		$browse_cat_parent = $database->loadResult();
		$categories[] = mosHTML::makeOption( $browse_cat_parent, '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='". $browse_cat ."' ORDER BY cat_name" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['new_other_cat'] = mosHTML::selectList( $categories, 'new_other_cat', 'class="inputbox" size="1"',	'value', 'text' );
	unset( $categories );

	# Get Pathway
	//$pathWay = new mtPathWay( $cat_id );
	$pathWay = new mtPathWay( $row->getCatID() );

	# Is this approval for modification?
	if ( $row->link_approved < 0 ) {
		$row->original_link_id = (-1 * $row->link_approved);
	} else {
		$row->original_link_id = '';
	}

	# Retrieve the custom field's caption
	$database->setQuery("SELECT name, value FROM #__mt_config WHERE name LIKE 'cust_%' ORDER BY name");
	$custom_fields = $database->loadObjectList('name');

	# Compile list of categories
	$categories[] = mosHTML::makeOption( '-1', '&lt;--Back' );
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='$row->cat_id' ORDER BY ordering" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['cat_id'] = mosHTML::selectList( $categories, 'new_cat_id', 'class="inputbox" size="1"',
	'value', 'text', $row->getCatID() );

	# Yes/No select list for Approved Link
	$lists['link_approved'] = mosHTML::yesnoRadioList("link_approved", 'class="inputbox"', (($row->link_approved == 1) ? 1 : 0));

	# Yes/No select list for Featured Link
	$lists['link_featured'] = mosHTML::yesnoRadioList("link_featured", 'class="inputbox"', $row->link_featured);

	# Yes/No select list for "Published"
	$lists['link_published'] = mosHTML::yesnoRadioList("link_published", 'class="inputbox"', $row->link_published);

	# Get Return task - Used by listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	# Get params definitions
	$params =& new mosParameters( $row->attribs, "$mosConfig_absolute_path/administrator/components/$option/params/mtree.listing.xml" );

	if ( $row->link_approved <= 0 ) {
		$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_approved <= 0 ORDER BY link_modified DESC, link_created DESC" );
		$links = $database->loadResultArray();
		$number_of_prev = array_search($row->link_id,$links);
		$number_of_next = count($links) - 1 - $number_of_prev;
	} else {
		$number_of_prev = 0;
		$number_of_next = 0;
	}

	HTML_mtree::editlink( $row, $row->cat_id, $other_cats, $browse_cat, $custom_fields, $lists, $number_of_prev, $number_of_next, $pathWay, $returntask, $params, $option, 1 );

}

function spiderurl( $option ) {
	global $database, $_MT_LANG;

	$url = mosGetParam( $_REQUEST, 'url', '' );
	$start = mosGetParam( $_REQUEST, 'start', 0 );
	$error = 0;

	if ( substr($url, 0, 7) <> "http://" ) {
		$url = "http://".$url;
	}

	echo '<div style="background-color:#ffffff; border: 1px solid #f5f5f5; font-weight: bold; font-size: 10px;">';
	if ( empty($url) || $start) {
		echo "&nbsp;"; //echo "Spider ready.";
	} else {
		
		//echo "URL - ".$url;
		$metatags = @get_meta_tags( $url ) or $error = 1;

		if ( !$error ) {
			echo '<img src="images/tick.png" width="12" height="12" border="0" />&nbsp;';
			echo '<span style="color:green">';
			
			// Only one meta tags is updated
			if ( !empty($metatags['keywords']) XOR !empty($metatags['description'])) {
				if (!empty($metatags['keywords'])) {
					$found = $_MT_LANG->META_KEYWORDS;
				} else {
					$found = $_MT_LANG->META_DESCRIPTION;
				}
				echo sprintf($_MT_LANG->SPIDER_HAS_BEEN_UPDATED, $found);
			// Both of them is found and updated
			} else {
				echo sprintf($_MT_LANG->SPIDER_HAS_BEEN_UPDATED2, $_MT_LANG->META_DESCRIPTION, $_MT_LANG->META_KEYWORDS);
			}
			echo '</span>';

			echo "<script>";
			if ( !empty($metatags['keywords']) ) echo "window.parent.document.getElementById('spider_metakey').value='".htmlspecialchars($metatags['keywords'], ENT_QUOTES )."'; \n";
			if ( !empty($metatags['description']) ) echo "window.parent.document.getElementById('spider_metadesc').value='".htmlspecialchars($metatags['description'], ENT_QUOTES )."';";
			echo "</script>";
		} else {
			echo '<img src="images/publish_x.png" width="12" height="12" border="0" />&nbsp;';
			echo '<span style="color:red">'.$_MT_LANG->UNABLE_TO_GET_METATAGS.'</span>';
		}

	}
	echo '</div>';

}

function openurl( $option ) {
	global $database;

	$url = mosGetParam( $_REQUEST, 'url', '' );

	if ( substr($url, 0, 7) <> "http://" ) {
		$url = "http://".$url;
	}

	mosRedirect( $url );
}

function editlink_change_cat( $option ) {
	global $database, $my, $mainframe, $mosConfig_absolute_path, $_MT_LANG;

	$row = new mtLinks( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->owner = mosGetParam( $_POST, 'owner', '' );
	$row->original_link_id = mosGetParam( $_POST, 'original_link_id', '' );
	$cat_id = mosGetParam( $_POST, 'cat_id', '' );

	$lists = array();

	# Other Categories
	$other_cats = mosGetParam( $_POST, 'other_cats', '' );
	if ( $other_cats <> '' ) {
		$other_cats = explode(', ', $other_cats);
	}

	# Image handling
	// Check if this listing has an image
	if ( $row->link_id > 0 ) {
		$database->setQuery( "SELECT link_image FROM #__mt_links WHERE link_id = $row->link_id LIMIT 1");
		$link_image = $database->loadResult();
		if ( !empty( $link_image ) ) {
			$row->link_image = $link_image;
		}
	}

	$new_cat_id = mosGetParam( $_POST, 'new_cat_id', '' );
	if ( $new_cat_id >= 0 ) {
		$row->cat_id = $new_cat_id;
	} elseif ( $new_cat_id == -1 ) {
		// Change directory to parent
		$getparent = new mtCats( $database );
		$getparent->load( $cat_id );
		$row->cat_id = $getparent->getParent();
	}

	# build the html select list for ordering
	/*
	$order = mosGetOrderingList( "SELECT ordering AS value, link_name AS text"
		. "\nFROM #__mt_links AS l, #__mt_cl AS cl"
		. "\nWHERE cl.cat_id='$row->cat_id' ORDER BY ordering"
	);
	$lists["ordering"] = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"',
		'value', 'text', intval( $row->ordering ) );
	*/

	# Template select list
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', $_MT_LANG->DEFAULT );

	foreach($templateDirs as $templateDir) {
		$templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'link_template', 'class="inputbox" size="1"',
	'value', 'text', $row->link_template );

	#
	$new_other_cat = intval(mosGetParam( $_POST, 'new_other_cat', 0 ));
	$browse_cat = $new_other_cat;
	# Compile list of categories - Related Categories
	$categories = array();
	if ( $browse_cat > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$browse_cat'");
		$browse_cat_parent = $database->loadResult();
		$categories[] = mosHTML::makeOption( $browse_cat_parent, '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='". $browse_cat ."' ORDER BY cat_name" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['new_other_cat'] = mosHTML::selectList( $categories, 'new_other_cat', 'class="inputbox" size="1"',	'value', 'text' );
	unset( $categories );

	# Yes/No select list for Approved Link
	$lists['link_approved'] = mosHTML::yesnoRadioList("link_approved", 'class="inputbox"', $row->link_approved);

	# Yes/No select list for Featured Link
	$lists['link_featured'] = mosHTML::yesnoRadioList("link_featured", 'class="inputbox"', $row->link_featured);

	# Yes/No select list for "Published"
	$lists['link_published'] = mosHTML::yesnoRadioList("link_published", 'class="inputbox"', $row->link_published);

	# Get Pathway
	$pathWay = new mtPathWay( $new_cat_id );

	# Retrieve the custom field's caption
	$database->setQuery("SELECT name, value FROM #__mt_config WHERE name LIKE 'cust_%'");
	$custom_fields = $database->loadObjectList('name');

	# Compile list of categories
	$categories[] = mosHTML::makeOption( '-1', '&lt;--Back' );
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='$row->cat_id' ORDER BY ordering" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['cat_id'] = mosHTML::selectList( $categories, 'new_cat_id', 'class="inputbox" size="1"',
	'value', 'text', $row->cat_id );

	# Get params definitions
	$params =& new mosParameters( $row->attribs, $mainframe->getPath( 'com_xml', 'com_mtree' ), 'component' );

	# Get Return task - Used by listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	if ( $row->link_approved <= 0 ) {
		$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_approved <= 0 ORDER BY link_modified DESC, link_created DESC" );
		$links = $database->loadResultArray();
		$number_of_prev = array_search($row->link_id,$links);
		$number_of_next = count($links) - 1 - $number_of_prev;
	} else {
		$number_of_prev = 0;
		$number_of_next = 0;
	}

	HTML_mtree::editlink( $row, $row->cat_id, $other_cats, $browse_cat, $custom_fields, $lists, $number_of_prev, $number_of_next, $pathWay, $returntask, $params, $option, 0 );
}

function prev_next_link( $prevnext, $option ) {
	global $database;

	$act = mosGetParam( $_POST, 'act', '' );
	$link_id = mosGetParam( $_POST, 'link_id', '' );

	$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_approved <= 0 ORDER BY link_created ASC, link_modified DESC" );
	$links = $database->loadResultArray();
	if ( array_key_exists((array_search($link_id,$links) + 1),$links) ) {
		$next_link_id = $links[(array_search($link_id,$links) + 1)];
	} else {
		$next_link_id = 0;
	}
	
	//if ( (array_search($link_id,$links) - 1) >= 0 && (array_search($link_id,$links) - 1) < count($links) ) {
	if ( array_key_exists((array_search($link_id,$links) - 1),$links) ) {
		$prev_link_id = $links[(array_search($link_id,$links) - 1)];
	} else {
		$prev_link_id = 0;
	}

	if ( $prevnext == "next" ) {
		if ( $next_link_id > 0 ) {
			$_POST['returntask'] = "editlink&link_id=".$next_link_id;
		} else {
			$_POST['returntask'] = "listpending_links";
		}
	} elseif( $prevnext == "prev" ) {
		if ( $prev_link_id > 0 ) {
			$_POST['returntask'] = "editlink&link_id=".$prev_link_id;
		} else {
			$_POST['returntask'] = "listpending_links";
		}
	}

	switch( $act ) {

		case "ignore":
			savelink( $option );
			/*
			if ( $prevnext == "next" ) {
				mosRedirect( "index2.php?option=com_mtree&task=editlink&link_id=".$next_link_id );
			} elseif( $prevnext == "prev" ) {
				mosRedirect( "index2.php?option=com_mtree&task=editlink&link_id=".$prev_link_id );
			}
			*/
			break;

		case "discard":
			removeLinks( array($link_id), $option );
			break;

		case "approve":
			$_POST['link_approved'] = 1;
			$_POST['link_published'] = 1;
			$_POST['link_created'] = date( "Y-m-d H:i:s" );
			savelink( $option );
			break;
	}

}

function savelink( $option ) {
	global $database, $my, $_MT_LANG;
	global $mosConfig_absolute_path, $mt_listing_image_dir, $mt_resize_method, $mt_resize_listing_size, $mt_resize_quality;
	
	$stored = false;

	$row = new mtLinks( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$owner = mosGetParam( $_POST, 'owner', '' );
	$original_link_id = mosGetParam( $_POST, 'original_link_id', '' );
	$remove_image = mosGetParam( $_REQUEST, 'remove_image', 0 );
	$cat_id = mosGetParam( $_REQUEST, 'cat_id', 0 );
	$link_image = mosGetParam( $_FILES, 'link_image', null );
	$other_cats = explode(', ', mosGetParam( $_POST, 'other_cats', '' ));

	# Is this a new listing?
	$new_link = false;
	$old_image = '';

	// Yes, new listing
	if ($row->link_id == 0) {
		$new_link = true;
		$row->link_created = date( "Y-m-d H:i:s" );

	// No, this listing has been saved to the database 
	// 1) Submission from visitor
	// 2) Modification request from listing owner
	} else {
		# Insert modified date
		$row->link_modified = date('Y-m-d H:i:s');

		# Let's check if this link is on "pending approval" from an existing listing
		$database->setQuery( "SELECT link_image, link_approved FROM #__mt_links WHERE link_id = $row->link_id LIMIT 1" );
		$database->loadObject($thislink); // 1: approved; 0:unapproved/new listing; <-1: pending approval for update
		$link_approved = $thislink->link_approved;
		$old_image = $thislink->link_image;

		if ( $link_approved < 0 && $row->link_approved == 0 ) {
			$row->link_approved = $link_approved;
		}

		if ( !empty( $old_image ) ) {
			$row->link_image = $old_image;
		}

		# If no file is uploaded, check if original listing has an image. If yes, bring it over to this newly
		# modified listing
		if ( $link_image["error"] == 4 && $old_image != "-1" && empty($old_image) ) {

			$database->setQuery( "SELECT link_image FROM #__mt_links WHERE link_id = '".$original_link_id."' LIMIT 1" );
			$row->link_image = $database->loadResult();
			
		}

	}

	# Lookup owner's userid. Return error if does not exists
	if ($owner == '') {
		// If owner field is left blank, assign the link to the current user
		$row->user_id = $my->id;
	} else {
		$database->setQuery("SELECT id FROM #__users WHERE username ='".$owner."'");
		$owner_id = $database->loadResult();
		if ($owner_id > 0) {
			$row->user_id = $owner_id;
		} else {
			echo "<script> alert('".$_MT_LANG->INVALID_OWNER_SELECT_AGAIN."'); window.history.go(-1); </script>\n";
			exit();
		}
	}

	# Save parameters
	$params = mosGetParam( $_POST, 'params', '' );
	if ( is_array( $params ) ) {
		$attribs = array();
		foreach ( $params as $k=>$v) {
			$attribs[] = "$k=$v";
		}
		$row->attribs = implode( "\n", $attribs );
	}

	# Remove previous old image
	if ( $remove_image || ($old_image <> '' && $link_image['tmp_name'] <> '') ) {
		$row->link_image = '';
		if(!@unlink($mosConfig_absolute_path.$mt_listing_image_dir.$old_image)) {
				//echo "<script> alert('".$_MT_LANG->ERROR_DELETING_OLD_IMAGE."'); </script>\n";
				//echo "<script> alert('".$_MT_LANG->ERROR_DELETING_OLD_IMAGE."'); window.history.go(-1); </script>\n";
				//exit();
		}
	}

	# Create Thumbnail
	if ( $link_image['name'] <> '' ) {

		$mtImage = new mtImage( $link_image, $mosConfig_absolute_path.$mt_listing_image_dir );
		$mtImage->setMethod( $mt_resize_method );
		$mtImage->setQuality( $mt_resize_quality );
		$mtImage->setSize( $mt_resize_listing_size );

		if ( $row->link_id > 0 ) {
			if ( $original_link_id > 0 ) {
				$mtImage->setName( $original_link_id."_".$link_image['name'] );
			} else {
				$mtImage->setName( $row->link_id."_".$link_image['name'] );
			}
			$row->link_image = $mtImage->imageName;
		}

		if ( $mtImage->check() ) {
			if ( $mtImage->resize() ) {
				if ( $row->link_id > 0 ) {
					if ( $original_link_id > 0 ) {
						$mtImage->setName( $original_link_id."_".$link_image['name'] );
					} else {
						$mtImage->setName( $row->link_id."_".$link_image['name'] );
					}
					$row->link_image = $mtImage->imageName;
				} else {
					$row->link_image = $link_image['name'];
				}
			}
		} else {
			echo "<script> alert('".$mtImage->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

	}

	# Publish the listing
	if ( $row->link_published && $row->link_id > 0 ) {
			$row->publishLink( 1 );
	}

	# Approve listing and send e-mail notification to the owner and admin
	if ( $row->link_approved == 1 && $row->link_id > 0 ) {
	
		# Get this actual link_approved value from DB
		$database->setQuery( "SELECT link_approved FROM #__mt_links WHERE link_id = '".$row->link_id."'");
		$link_approved = $database->loadResult();

		# This is a modification to the existing listing
		if ( $link_approved <= 0 ) {
				
				$row->updateLinkCount( 1 );
				$row->approveLink();
				//$stored = true;
				
		}

	}

	# Update the Link Counts for all cat_parent(s)

	if ($new_link) {

		$row->updateLinkCount( 1 );
	
	} else {
		// Get old state (approved, published)
		$database->setQuery( "SELECT link_approved, link_published, cl.cat_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND l.link_id ='".$row->link_id."' LIMIT 1" );
		$database->loadObject( $old_state );

		// From approved & published -to-> unapproved/unpublished
		if ( $old_state->link_approved == 1 && $old_state->link_published == 1 ) {
			if ( $row->link_published == 0 || $row->link_approved == 0) {
				$row->updateLinkCount( -1 );
			}

		// From unpublished/unapproved -to-> Published & Approved
		} elseif( $row->link_published == 1 && $row->link_approved == 1) {
			$row->updateLinkCount( 1 );
		}

		// Update link count if changing to a new category
		if ( $old_state->cat_id <> $cat_id && $old_state->link_approved <> 0 ) {
			$oldrow = new mtLinks( $database );
			$oldrow->cat_id = $old_state->cat_id;
			$oldrow->updateLinkCount( -1 );

			$newrow = new mtLinks( $database );
			$newrow->cat_id = $cat_id;
			$newrow->updateLinkCount( 1 );
		}
	
	}

	if (!$stored) {
		# Save to database
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		} else {
		
			# If this is a newlink, rename the photo to listingID_photoName.jpg
			if ( $new_link ) {

				// Get last inserted listing ID
				$mysql_last_insert_cl_id = $database->insertid();

				$database->setQuery( "SELECT link_id FROM #__mt_cl WHERE cl_id = ".$mysql_last_insert_cl_id );
				$mysql_last_insert_id = $database->loadResult();

				if ( $mysql_last_insert_id > 0 ) {

					if ( $link_image['name'] ) {
						if ( rename( $mosConfig_absolute_path.$mt_listing_image_dir.$link_image['name'], $mosConfig_absolute_path.$mt_listing_image_dir.$mysql_last_insert_id."_".$link_image['name'] ) ) {
							
							$database->setQuery( "UPDATE #__mt_links SET link_image = '".$mysql_last_insert_id."_".$link_image['name']."' WHERE link_id = '".$mysql_last_insert_id."' LIMIT 1" );
							$database->query();

						}
					}
				}
			}
		}

	}

	# Update "Also appear in these categories" aka other categories
	$mtCL = new mtCL_main0( $database );
	$mtCL->load( $row->link_id );
	$mtCL->update( $other_cats );

	$returntask = mosGetParam( $_POST, 'returntask', '' );

///*
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {

		$task = mosGetParam( $_POST, 'task', '' );

		if ( $task == "applylink" ) {
			mosRedirect( "index2.php?option=$option&task=editlink&link_id=$row->link_id" );
		} else {
			mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$cat_id" );
		}
	}
//*/
}

function publishLinks( $link_id=null, $publish=1,  $option ) {
	global $database, $my, $_MT_LANG;

	if (!is_array( $link_id ) || count( $link_id ) < 1) {
		$action = $publish ? strtolower($_MT_LANG->PUBLISH) : strtolower($_MT_LANG->UNPUBLISH);
		echo "<script> alert('".sprintf($_MT_LANG->SELECT_AN_ITEM_TO, $action)."'); window.history.go(-1);</script>\n";
		exit;
	}

	$link_ids = implode( ',', $link_id );

	# Verify if these links is unpublished -> published OR published -> unpublished 
	foreach( $link_id AS $lid ) {
		$checklink = new mtLinks( $database );
		$checklink->load( $lid );

		if ( $checklink->link_published XOR $publish ) {
			$checklink->updateLinkCount( ( ($publish) ? 1 : -1 ) );
		}

	}

	# Publish/Unpublish Link
	$database->setQuery( "UPDATE #__mt_links SET link_published='$publish'"
		. "\nWHERE link_id IN ($link_ids)"
	);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row = new mtLinks( $database );
	$row->load( $link_id[0] );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$row->cat_id );
}

function removeLinks( $link_id, $option ) {
	global $database, $_MT_LANG;

	$row = new mtLinks( $database );
	$row->load( $link_id[0] );
	
	if (!is_array( $link_id ) || count( $link_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $link_id )) {
		$link_ids = implode( ',', $link_id );
		
		$total = count( $link_id );

		# Locate all CL mapping and decrease the categories' link count
		foreach( $link_id AS $id ) {
			$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE main = '0' AND link_id = $id" );
			$link_cls = $database->loadResultArray();
			
			if( count($link_cls) > 0 ) {
				foreach( $link_cls AS $link_cl ) {
					$row->updateLinkCount( -1, $link_cl );
				}
			}
		}

		# Delete the main records
		foreach( $link_id AS $id ) {
			$database->setQuery( "SELECT link_approved FROM #__mt_links WHERE link_id = $id" );
			$link_approved = $database->loadResult();
			if ( $link_approved <= 0 ) {
				$total--;
			}
			$row->delLink( $id );
		}
		# Update link count for all category
		if ( $total > 0 ) {
			$row->updateLinkCount( (-1 * $total) );
		}
	}

	$returntask = mosGetParam( $_POST, 'returntask', '' );
	
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask", sprintf($_MT_LANG->LINKS_HAVE_BEEN_DELETED, count($link_id) ) );
	} else {
		mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$row->cat_id );
	}
}

function featuredLinks( $link_id, $featured=1, $option ) {
	global $database;

	$row = new mtLinks( $database );
	
	if (count( $link_id )) {
		foreach($link_id AS $lid) {
			$row->setFeaturedLink( $featured, $lid );
		}
	}
	$row->load( $lid );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$row->cat_id );
}

function orderLinks( $link_id, $inc, $option ) {
	global $database;
	$row = new mtLinks( $database );
	$row->load( $link_id );
	$row->move( $inc, "cat_id = '$row->cat_id'" );
	
	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$row->cat_id );
}

function cancellink( $link_id, $option ) {
	global $database;
	
	# Check return task - used to return to listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );
	
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {
		$link = new mtLinks( $database );
		$link->load( $link_id );

		mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$link->cat_id" );
	}
}

function cancellinks_move( $link_id, $option ) {
	global $database;

	$link = new mtLinks( $database );
	$link->load( $link_id );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$link->cat_id" );
}

function moveLinks( $link_id, $cat_parent, $option ) {
	global $database, $_MT_LANG;

	if (!is_array( $link_id ) || count( $link_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_MOVE."'); window.history.go(-1);</script>\n";
		exit;
	}	

	# Get Pathway
	$pathWay = new mtPathWay( $cat_parent );

	# Get all category under cat_parent
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' ORDER BY cat_name");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), '&lt;--Back' );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	$catList = mosHTML::selectList( $cats, 'cat_parent', 'class="inputbox" size="8" ondblclick="submitbutton(\'links_move\');"', 'value', 'text', null );

	HTML_mtree::move_links( $link_id, $cat_parent, $catList, $pathWay, $option );

}

function moveLinks2( $link_id, $option ) {
	global $database;

	$new_cat_parent = mosGetParam( $_POST, 'new_cat_parent', '' );

	$row = new mtLinks( $database );

	if ( count( $link_id ) > 0 ) {
		foreach( $link_id AS $id ) {
			if ( $row->load( $id ) == true ) {
				if ( !isset($old_cat_parent) ) {
					$old_cat_parent = $row->cat_id;
				}
			} else {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			# Assign new cat_parent
			if ( $new_cat_parent >= 0 ) {
				$row->cat_id = $new_cat_parent;
			}

			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}
		} // End foreach
	} // End if
	
	# Update category, links count and update all ordering
	$result = $row->updateLinkCount( (count($link_id)*-1), $old_cat_parent );
	$result = $row->updateLinkCount( count($link_id), $new_cat_parent );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$new_cat_parent" );
}

function copyLinks( $link_id, $cat_parent, $option ) {
	global $database, $_MT_LANG;

	if (!is_array( $link_id ) || count( $link_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_COPY."'); window.history.go(-1);</script>\n";
		exit;
	}	

	# Get Pathway
	$pathWay = new mtPathWay( $cat_parent );

	# Get all category under cat_parent
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' ORDER BY cat_name");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), '&lt;--Back' );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	# Main Category list
	$lists['catList'] = mosHTML::selectList( $cats, 'cat_parent', 'class="inputbox" size="8" ondblclick="submitbutton(\'links_copy\');"', 'value', 'text', null );

	# Copy Reviews?
	$copy_reviews = mosGetParam( $_POST, 'copy_reviews', 0 );
	$lists['copy_reviews'] = mosHTML::yesnoRadioList("copy_reviews", 'class="inputbox"', $copy_reviews);

	# Reset Hits?
	$reset_hits = mosGetParam( $_POST, 'reset_hits', 1 );
	$lists['reset_hits'] = mosHTML::yesnoRadioList("reset_hits", 'class="inputbox"', $reset_hits);

	# Reset Rating & Votes?
	$reset_rating = mosGetParam( $_POST, 'reset_rating', 1 );
	$lists['reset_rating'] = mosHTML::yesnoRadioList("reset_rating", 'class="inputbox"', $reset_rating);

	HTML_mtree::copy_links( $link_id, $cat_parent, $lists, $pathWay, $option );

}

function copyLinks2( $link_id, $option ) {
	global $database;

	$new_cat_parent = intval( mosGetParam( $_POST, 'new_cat_parent', '' ) );
	$copy_reviews = intval( mosGetParam( $_POST, 'copy_reviews', 0 ) );
	$reset_hits = intval( mosGetParam( $_POST, 'reset_hits', 1 ) );
	$reset_rating = intval( mosGetParam( $_POST, 'reset_rating', 1 ) );

	$row = new mtLinks( $database );

	if ( count( $link_id ) > 0 ) {
		foreach( $link_id AS $id ) {
			$row->copyLink( $id, $new_cat_parent, $reset_hits, $reset_rating, $copy_reviews);
			$row->cat_id = $new_cat_parent;
			$row->updateLinkCount( 1 );
		}
	}

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$new_cat_parent" );
}

/****
 * Category
 */
function listcats( $cat_id, $cat_parent, $option ) {
	global $database, $mainframe;
	global $mt_first_listing_order1, $mt_first_listing_order2, $mt_second_listing_order1, $mt_second_listing_order2, $mt_first_cat_order1, $mt_first_cat_order2, $mt_second_cat_order1, $mt_second_cat_order2;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	if ( $cat_id == 0 && $cat_parent > 0 ) {
		$cat_id = $cat_parent;
	}

	# Creating db connection to #__mt_cats
	$mtCats = new mtCats( $database );
	$mtCats->load( $cat_id );

	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $mtCats->getNumOfLinks_NoRecursive( $cat_id ), $limitstart, $limit );
	
	# Main query - category
	$sql = "SELECT * FROM #__mt_cats"
		. "\nWHERE cat_parent = '".$cat_id."' AND cat_approved = '1'"
		.	"\nORDER BY $mt_first_cat_order1 $mt_first_cat_order2, $mt_second_cat_order1 $mt_second_cat_order2";
	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$cats = $database->loadObjectList();

	# Get Pathway
	$pathWay = new mtPathWay( $cat_id );

	# Get Links for this category
	$sql = "SELECT l.*, COUNT(r.rev_id) AS reviews, cl.main AS main FROM (#__mt_links AS l, #__mt_cl AS cl)"
		."\nLEFT JOIN #__mt_reviews AS r ON (r.link_id = l.link_id)"
		."\nWHERE cl.cat_id = '".$cat_id."' AND link_approved = '1' AND (l.link_id = cl.link_id)"
		."\nGROUP BY l.link_id"
		."\nORDER BY $mt_first_listing_order1 $mt_first_listing_order2, $mt_second_listing_order1 $mt_second_listing_order2 "
		. "\nLIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$links = $database->loadObjectList();
	
	# Get cat_ids for soft listing
	$softlinks = array();
	foreach( $links AS $link ) {
		if ( $link->main == 0 ) {
			$softlinks[] = $link->link_id;
		}
	}
	if ( !empty($softlinks) ) {
		$database->setQuery( "SELECT link_id, cat_id FROM #__mt_cl WHERE link_id IN (".implode(", ",$softlinks).") AND main = '1'" );
		$softlink_cat_ids = $database->loadObjectList( "link_id" );
	}

	HTML_mtree::listcats( $cats, $links, $softlink_cat_ids, $mtCats, $pageNav, $pathWay, $option );
}

function editcat( $cat_id, $cat_parent, $option ) {
	global $database, $mosConfig_absolute_path, $_MT_LANG;

	$row = new mtCats( $database );
	$row->load( $cat_id );

	if ($row->cat_id == 0) {
		$row->cat_name = '';
		$row->cat_parent = $cat_parent;
		$row->cat_links = 0;
		$row->cat_cats = 0;
		$row->cat_featured = 0;
		$row->cat_published = 1;
		$row->cat_approved = 1;
		$row->cat_image = '';
		$row->cat_allow_submission = 1;
	} else {
		$cat_parent = $row->cat_parent;
	}

	$lists = array();

	# build the html select list for ordering
	/*
	$order = mosGetOrderingList( "SELECT ordering AS value, cat_name AS text"
		. "\nFROM #__mt_cats"
		. "\nWHERE cat_parent='$row->cat_parent' ORDER BY ordering"
	);
	$lists['ordering'] = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"',
		'value', 'text', intval( $row->ordering ) );
	*/

	# Template select list
	
	// Decide if parent has a custom template assigned to it. If there is, select this template
	// by default.
	if ( $cat_parent > 0 && $cat_id == 0 ) {
		$database->setQuery( "SELECT cat_template FROM #__mt_cats WHERE cat_id = '".$cat_parent."' LIMIT 1" );
		$parent_template = $database->loadResult();
	}
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', ( (!empty($parent_template)) ? 'Default ('.$parent_template.')' : 'Default' ) );

	foreach($templateDirs as $templateDir) {
		if ( $templateDir <> "index.html") $templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'cat_template', 'class="inputbox" size="1"',
	'value', 'text', $row->cat_template );
	
	# Get related categories
	$database->setQuery( "SELECT rel_id FROM #__mt_relcats WHERE cat_id = '$cat_id'");
	$related_cats = $database->loadResultArray();

	# Compile list of categories - Related Categories
	$categories = array();
	$browse_cat = $row->getParent($cat_parent);
	if ( $browse_cat > 0 ) {
		$categories[] = mosHTML::makeOption( $row->cat_parent, '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='". $row->getParent($cat_parent) ."' ORDER BY ordering" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['new_related_cat'] = mosHTML::selectList( $categories, 'new_related_cat', 'class="inputbox" size="1"',
	'value', 'text', ( ($row->cat_id == 0) ? $cat_parent : $row->cat_id ) );

	# Yes/No select list for Approved Category
	$lists['cat_approved'] = mosHTML::yesnoRadioList("cat_approved", 'class="inputbox"', (($row->cat_approved == 1) ? 1 : 0));

	# Yes/No select list for Featured Category
	$lists['cat_featured'] = mosHTML::yesnoRadioList("cat_featured", 'class="inputbox"', $row->cat_featured);

	# Yes/No select list for "Published"
	$lists['cat_published'] = mosHTML::yesnoRadioList("cat_published", 'class="inputbox"', $row->cat_published);

	# Yes/No select list for "Use Main Index"
	$lists['cat_usemainindex'] = mosHTML::yesnoRadioList("cat_usemainindex", 'class="inputbox"', $row->cat_usemainindex);

	$lists['cat_allow_submission'] = mosHTML::yesnoRadioList("cat_allow_submission", 'class="inputbox"', $row->cat_allow_submission);

	$lists['cat_show_listings'] = mosHTML::yesnoRadioList("cat_show_listings", 'class="inputbox"', $row->cat_show_listings);

	# Get Pathway
	$pathWay = new mtPathWay( $cat_parent );

	# Get Return task - Used by listpending_cats
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	HTML_mtree::editcat( $row, $cat_parent, $related_cats, $browse_cat, $lists, $pathWay, $returntask, $option );
}

function editcat_browse_cat( $option, $add=0 ) {
	global $database, $mosConfig_absolute_path, $_MT_LANG;

	$row = new mtCats( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$lists = array();

	# Related Categories
	$related_cats = mosGetParam( $_POST, 'related_cats', '' );
	if ( $related_cats <> '' ) {
		$related_cats = explode(', ', $related_cats);
	}
	$new_related_cat = intval(mosGetParam( $_POST, 'new_related_cat', 0 ));
	$cat_parent = intval(mosGetParam( $_POST, 'cat_parent', 0 ));

	# Adding new Related Category
	if ( $add == 1) {

		// Prevent adding own category
		if ( $new_related_cat == $row->cat_id ) {
			echo "<script> alert('".$_MT_LANG->NOT_ALLOWED_TO_ADD_OWN_CAT_AS_RELCAT."'); window.history.go(-1); </script>\n";
			exit();
		}

		// Prevent adding "Back"
		if ( $new_related_cat == 0 ) {
			echo "<script> alert('".$_MT_LANG->CHOOSE_A_CAT_BEFORE_ADDING."'); window.history.go(-1); </script>\n";
			exit();
		}

		// Prevent same duplicates of related category
		if ( !empty($related_cats) ) {
			if ( in_array($new_related_cat, $related_cats) ) {
				echo "<script> alert('".$_MT_LANG->YOU_HAVE_ALREADY_ADD_THIS_RELCAT."'); window.history.go(-1); </script>\n";
				exit();
			}
		}

		$related_cats[] = $new_related_cat;
		$browse_cat = $row->getParent($row->cat_parent);

	# Removing Related Category
	}	elseif ( $add == -1 ) {
		//$related_cats[] = $new_related_cat;
		$remove_relcat = mosGetParam( $_POST, 'remove_relcat', array(0) );
		$related_cats = array_diff($related_cats, $remove_relcat);
		$browse_cat = $new_related_cat;

	} else {
		$browse_cat = $new_related_cat;
	}

	# Change all subcats
	$template_all_subcats = mosGetParam( $_POST, 'template_all_subcats', '' );

	# build the html select list for ordering
	/*
	$order = mosGetOrderingList( "SELECT ordering AS value, cat_name AS text"
		. "\nFROM #__mt_cats"
		. "\nWHERE cat_parent='$row->cat_parent' ORDER BY ordering"
	);
	$lists['ordering'] = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"',
		'value', 'text', intval( $row->ordering ) );
	*/
	# Template select list
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', $_MT_LANG->DEFAULT );

	foreach($templateDirs as $templateDir) {
		$templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'cat_template', 'class="inputbox" size="1"',
	'value', 'text', $row->cat_template );

	# Compile list of categories - Related Categories
	$categories = array();
	if ( $browse_cat > 0 ) {
		$categories[] = mosHTML::makeOption( $row->getParent($browse_cat), '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent='". $browse_cat ."' ORDER BY ordering" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$lists['new_related_cat'] = mosHTML::selectList( $categories, 'new_related_cat', 'class="inputbox" size="1"',
	'value', 'text', $browse_cat );

	# Yes/No select list for Approved Category
	$lists['cat_approved'] = mosHTML::yesnoRadioList("cat_approved", 'class="inputbox"', (($row->cat_approved == 1) ? 1 : 0));

	# Yes/No select list for Featured Category
	$lists['cat_featured'] = mosHTML::yesnoRadioList("cat_featured", 'class="inputbox"', $row->cat_featured);

	# Yes/No select list for "Published"
	$lists['cat_published'] = mosHTML::yesnoRadioList("cat_published", 'class="inputbox"', $row->cat_published);

	# Yes/No select list for "Use Main Index"
	$lists['cat_usemainindex'] = mosHTML::yesnoRadioList("cat_usemainindex", 'class="inputbox"', $row->cat_usemainindex);

	$lists['cat_allow_submission'] = mosHTML::yesnoRadioList("cat_allow_submission", 'class="inputbox"', $row->cat_allow_submission);

	# Get Pathway
	$pathWay = new mtPathWay( $row->cat_parent );

	# Get Return task - Used by listpending_cats
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	HTML_mtree::editcat( $row, $cat_parent, $related_cats, $browse_cat, $lists, $pathWay, $returntask, $option, 1, $template_all_subcats );
}

function savecat( $option ) {
	global $database, $my;
	global $mosConfig_absolute_path, $mt_cat_image_dir;
	global $mt_resize_method, $mt_resize_quality, $mt_resize_cat_size, $_MT_LANG;

	$template_all_subcats = mosGetParam( $_POST, 'template_all_subcats', '' );
	$related_cats = explode(', ', mosGetParam( $_POST, 'related_cats', '' ));
	$remove_image = mosGetParam( $_REQUEST, 'remove_image', 0 );
	$cat_image = mosGetParam( $_FILES, 'cat_image', null );

	if ( $related_cats[0] == '' ) {
		$related_cats = array();
	}

	$row = new mtCats( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	# Get the name of the old photo
	if ( $row->cat_id > 0 ) {
		$sql="SELECT cat_image FROM #__mt_cats WHERE cat_id='".$row->cat_id."'";
		$database->setQuery($sql);
		$old_image = $database->loadResult();
	} else {
		$old_image = '';
	}

	# Remove previous old image
	if ( $remove_image || ($old_image <> '' && $cat_image['tmp_name'] <> '') ) {
		$row->cat_image = '';

		if(!unlink($mosConfig_absolute_path.$mt_cat_image_dir.$old_image)) {
				echo "<script> alert('".$_MT_LANG->ERROR_DELETING_OLD_IMAGE."'); </script>\n";
		}
	}

	# Create Thumbnail
	if ( $cat_image['name'] <> '' ) {

		$mtImage = new mtImage( $cat_image, $mosConfig_absolute_path.$mt_cat_image_dir );
		$mtImage->setMethod( $mt_resize_method );
		$mtImage->setQuality( $mt_resize_quality );
		$mtImage->setSize( $mt_resize_cat_size );

		if ( $row->cat_id > 0 ) {
			$mtImage->setName( $row->cat_id."_".$cat_image['name'] );
		}

		if ( $mtImage->check() ) {
			if ( $mtImage->resize() ) {
				if ( $row->cat_id > 0 ) {
					$row->cat_image = $row->cat_id."_".$cat_image['name'];
				} else {
					$row->cat_image = $cat_image['name'];
				}

			}
		}
	
	}

	# Is this a new category?
	// Category created by conventional "Add Category" link
	if ($row->cat_id == 0) {
		$new_cat = true;
		$row->cat_created = date( "Y-m-d H:i:s" );	
	} else {

		$database->setQuery( "SELECT cat_approved FROM #__mt_cats WHERE cat_id = '".$row->cat_id."'");
		$cat_approved = $database->loadResult();
		// Approved new category submitted by users
		if ( $row->cat_approved == 1 && $cat_approved == 0 && $row->lft == 0 && $row->rgt == 0 ) {
			$new_cat = true;
			$row->cat_created = date( "Y-m-d H:i:s" );	
		} else {
			$new_cat = false;
		}
	}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	} else {
		
			# If this is a newlink, rename the photo to listingID_photoName.jpg
			if ( $new_cat ) {

				// Get last inserted listing ID
				$mysql_last_insert_id = mysql_insert_id();

				if ( $mysql_last_insert_id > 0 ) {

					if ( rename( $mosConfig_absolute_path.$mt_cat_image_dir.$cat_image['name'], $mosConfig_absolute_path.$mt_cat_image_dir.$mysql_last_insert_id."_".$cat_image['name'] ) ) {
						
						$database->setQuery( "UPDATE #__mt_cats SET cat_image = '".$mysql_last_insert_id."_".$cat_image['name']."' WHERE cat_id = '".$mysql_last_insert_id."' LIMIT 1" );
						$database->query();

					}
				}
			}
		}
	
	# Change all subcats to use this template
	if ( $template_all_subcats == 1 ) {
		$row->updateSubCatsTemplate();
	}

	# Update the Category Counts for all cat_parent(s)
	if ($new_cat) {
		$row->updateLftRgt();
		$row->updateCatCount( 1 );
	}

	$row->updateOrder( "cat_parent='$row->cat_parent'" );

	# Update the related categories
	$mtRelCats = new mtRelCats( $database );
	$mtRelCats->setcatid( $row->cat_id );
	$mtRelCats->update( $related_cats );

	$returntask = mosGetParam( $_POST, 'returntask', '' );
	
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {
		$task = mosGetParam( $_POST, 'task', '' );

		if ( $task == "applycat" ) {
			mosRedirect( "index2.php?option=$option&task=editcat&cat_id=$row->cat_id" );
		} else {
			mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$row->cat_parent" );
		}
	}

}

function fastadd_cat( $cat_parent, $option ) {
	global $database;

	$cat_names = mosGetParam( $_POST, 'cat_names', '');
	$cat_names = preg_split('/\n/',$cat_names);

	# Default Template
	// Decide if parent has a custom template assigned to it. If there is, use this template.
	if ( $cat_parent > 0 ) {
		$database->setQuery( "SELECT cat_template FROM #__mt_cats WHERE cat_id = '".$cat_parent."' LIMIT 1" );
		$parent_template = $database->loadResult();
	}

	foreach( $cat_names AS $cat_name) {
		$cat_name = trim($cat_name);
		if ( !empty($cat_name) ) {
			
			$row = new mtCats( $database );
			$row->cat_name = stripslashes($cat_name);

			$row->cat_created = date( "Y-m-d H:i:s" );	
			$row->cat_parent = $cat_parent;
			$row->cat_published = 1;
			$row->cat_approved = 1;
			if ( isset($parent_template) ) {
				$row->cat_template = $parent_template;
			}
			
			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			$row->updateLftRgt();
			# Update the Category Counts for all cat_parent(s)
			$row->updateCatCount( 1 );

			unset($row);
		}
	}
	
	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$cat_parent" );

}

function publishCats( $cat_id=null, $publish=1,  $option ) {
	global $database, $my, $_MT_LANG;

	if (!is_array( $cat_id ) || count( $cat_id ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('".sprintf($_MT_LANG->SELECT_AN_ITEM_TO, $action)."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cat_ids = implode( ',', $cat_id );

	$database->setQuery( "UPDATE #__mt_cats SET cat_published='$publish'"
		. "\nWHERE cat_id IN ($cat_ids)"
	);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row = new mtCats( $database );
	$row->load( $cat_id[0] );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$row->getParent() );
}

function removecats( $cat_id, $option ) {
	global $database, $_MT_LANG;

	if (!is_array( $cat_id ) || count( $cat_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}

	$database->setQuery( "SELECT * FROM #__mt_cats WHERE cat_id IN (".implode(", ",$cat_id).")" );
	$categories = $database->loadObjectList();

	$row = new mtCats( $database );
	$row->load( $cat_id[0] );

	HTML_mtree::removecats( $categories, $row->getParent(), $option );
	
}

function removecats2( $cat_id, $option ) {
	global $database, $_MT_LANG;

	$row = new mtCats( $database );
	$row->load( $cat_id[0] );
	
	$cat_parent = $row->getParent();

	if (!is_array( $cat_id ) || count( $cat_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $cat_id )) {
		$totalcats = 0;
		$totallinks = 0;
		foreach($cat_id AS $cid) {
			$row->load( $cid );
			$totalcats += ($row->cat_cats +1);
			$totallinks += $row->cat_links;
			$row->deleteCats( $cid );
		}
		# Update Cat & Link count
		smartCountUpdate( $cat_parent, (($totallinks)*-1), (($totalcats)*-1) );
	}

	$returntask = mosGetParam( $_POST, 'returntask', '' );

	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {
		mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$cat_parent );
	}

}

function featuredCats( $cat_id, $featured=1, $option ) {
	global $database;

	$row = new mtCats( $database );
	
	if (count( $cat_id )) {
		foreach($cat_id AS $cid) {
			$row->setFeaturedCat( $featured, $cid );
		}
	}

	$row->load( $cid );
	
	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=".$row->getParent() );
}

function orderCats( $cat_id, $inc, $option ) {
	global $database;
	$row = new mtCats( $database );
	$row->load( $cat_id );
	$row->move( $inc, "cat_parent = '$row->cat_parent'" );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$row->cat_parent" );
}

function cancelcat( $cat_parent, $option ) {
	
	# Check return task - used to return to listpending_cats
	$returntask = mosGetParam( $_POST, 'returntask', '' );
	
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {
		mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$cat_parent" );
	}

}

function cancelcats_move( $cat_id, $option ) {
	global $database;

	$cat = new mtCats( $database );
	$cat->load( $cat_id );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$cat->cat_parent" );
}

function moveCats( $cat_id, $cat_parent, $option ) {
	global $database, $_MT_LANG;

	if (!is_array( $cat_id ) || count( $cat_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_MOVE."'); window.history.go(-1);</script>\n";
		exit;
	}	

	# Get Pathway
	$pathWay = new mtPathWay( $cat_parent );

	# Get all category under cat_parent except those which is moving
	$cat_ids = 	implode( ',', $cat_id );
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' AND cat_id NOT IN ($cat_ids)");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), '&lt;--Back' );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	$catList = mosHTML::selectList( $cats, 'cat_parent', 'class="inputbox" size="8" ondblclick="submitbutton(\'cats_move\');"', 'value', 'text', null );

	HTML_mtree::move_cats( $cat_id, $cat_parent, $catList, $pathWay, $option );

}

function moveCats2( $cat_id, $option ) {
	global $database;

	$new_cat_parent_id = mosGetParam( $_POST, 'new_cat_parent', '' );

	$database->setQuery( "SELECT cat_id, lft, rgt FROM #__mt_cats WHERE cat_id = $new_cat_parent_id" );
	$database->loadObject($new_cat_parent);

	$row = new mtCats( $database );

	# Loop every moving categories 
	if ( count( $cat_id ) > 0 ) {

		$total_cats = 0;
		$total_links = 0;

		foreach( $cat_id AS $id ) {
			
			$row->load( $id );

			$total_cats++;
			$total_cats += $row->cat_cats;
			$total_links += $row->cat_links;
			
			//$database->setQuery( "SELECT cat_id, lft, rgt FROM #__mt_cats WHERE cat_id = $row->cat_id" );
			//$database->loadObject($old_cat);

			# Assign new cat_parent
			if ( $new_cat_parent->cat_id >= 0 ) {
				$old_cat_parent = $row->cat_parent;
				$row->cat_parent = $new_cat_parent->cat_id;
			}

			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}
			
			$inc = $new_cat_parent->rgt - $row->lft;
			$original_row_lft = $row->lft;
			$original_row_rgt = $row->rgt;
			$subcats = $row->getSubCats_Recursive( $id );

			# Categories are moved to the right
			if ( $row->rgt < $new_cat_parent->rgt ) {

				# (1) Update all category's lft and rgt to the right of this new node to accommodate new categories
				$database->setQuery("UPDATE #__mt_cats SET lft = lft+".(2*count($subcats))." WHERE lft >= $new_cat_parent->rgt");
				$database->query();

				$database->setQuery("UPDATE #__mt_cats SET rgt = rgt+".(2*count($subcats))." WHERE rgt >= $new_cat_parent->rgt");
				$database->query();

				# (2) Update lft & rgt values of moving categories
				$database->setQuery( "UPDATE #__mt_cats SET lft = lft + $inc, rgt = rgt + $inc WHERE lft >= $row->lft AND rgt <= $row->rgt" );
				$database->query();

				# (3) Finally, update all lft & rgt from the old node
				$database->setQuery("UPDATE #__mt_cats SET lft = lft-".(2*count($subcats))." WHERE lft >= $original_row_lft");
				$database->query();

				$database->setQuery("UPDATE #__mt_cats SET rgt = rgt-".(2*count($subcats))." WHERE rgt >= $original_row_rgt");
				$database->query();

			# Categories are moved to the left
			} else {

				# (1) Update all category's lft and rgt to the right of this new node to accommodate new categories
				$database->setQuery("UPDATE #__mt_cats SET lft = lft+".(2*count($subcats))." WHERE lft >= $new_cat_parent->rgt");
				$database->query();

				$database->setQuery("UPDATE #__mt_cats SET rgt = rgt+".(2*count($subcats))." WHERE rgt >= $new_cat_parent->rgt");
				$database->query();

				# (2) Update lft & rgt values of moving categories
				$database->setQuery( "UPDATE #__mt_cats SET lft = lft +($inc - ".(2*count($subcats))."), rgt = rgt +($inc - ".(2*count($subcats)).") WHERE lft >= ($row->lft + ".(2*count($subcats)).") AND rgt <= ($row->rgt + ".(2*count($subcats)).")" );
				$database->query();

				# (3) Finally, update all lft & rgt from the old node
				$database->setQuery("UPDATE #__mt_cats SET lft = lft-".(2*count($subcats))." WHERE lft >= $original_row_lft + ".(2*count($subcats)));
				$database->query();

				$database->setQuery("UPDATE #__mt_cats SET rgt = rgt-".(2*count($subcats))." WHERE rgt >= $original_row_rgt + ".(2*count($subcats)) );
				$database->query();

			}

		} // End foreach

		smartCountUpdate_catMove( $old_cat_parent, $new_cat_parent->cat_id, $total_links, $total_cats );

	} // End if
	
	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$row->cat_parent" );
}

function copyCats( $cat_id, $cat_parent, $option ) {
	global $database, $_MT_LANG;

	if (!is_array( $cat_id ) || count( $cat_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_COPY."'); window.history.go(-1);</script>\n";
		exit;
	}	

	# Get Pathway
	$pathWay = new mtPathWay( $cat_parent );

	# Get all category under cat_parent except those which is moving
	$cat_ids = 	implode( ',', $cat_id );
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' AND cat_id NOT IN ($cat_ids)");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), '&lt;--Back' );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	# Copy Related Cats?
	$copy_relcats = mosGetParam( $_POST, 'copy_relcats', 0 );
	$lists['copy_relcats'] = mosHTML::yesnoRadioList("copy_relcats", 'class="inputbox"', $copy_relcats);

	# Copy subcats?
	$copy_subcats = mosGetParam( $_POST, 'copy_subcats', 1 );
	$lists['copy_subcats'] = mosHTML::yesnoRadioList("copy_subcats", 'class="inputbox"', $copy_subcats);

	# Copy Listings?
	$copy_listings = mosGetParam( $_POST, 'copy_listings', 1 );
	$lists['copy_listings'] = mosHTML::yesnoRadioList("copy_listings", 'class="inputbox"', $copy_listings);

	# Copy Reviews?
	$copy_reviews = mosGetParam( $_POST, 'copy_reviews', 0 );
	$lists['copy_reviews'] = mosHTML::yesnoRadioList("copy_reviews", 'class="inputbox"', $copy_reviews);

	# Reset Hits?
	$reset_hits = mosGetParam( $_POST, 'reset_hits', 1 );
	$lists['reset_hits'] = mosHTML::yesnoRadioList("reset_hits", 'class="inputbox"', $reset_hits);

	# Reset Rating & Votes?
	$reset_rating = mosGetParam( $_POST, 'reset_rating', 1 );
	$lists['reset_rating'] = mosHTML::yesnoRadioList("reset_rating", 'class="inputbox"', $reset_rating);

	# Main Category list
	$lists['catList'] = mosHTML::selectList( $cats, 'cat_parent', 'class="inputbox" size="8" ondblclick="submitbutton(\'cats_copy\');"', 'value', 'text', null );

	HTML_mtree::copy_cats( $cat_id, $cat_parent, $lists, $pathWay, $option );

}

function copyCats2( $cat_id, $option ) {
	global $database;

	$new_cat_parent_id = mosGetParam( $_POST, 'new_cat_parent', '' );

//	$database->setQuery( "SELECT cat_id, lft, rgt FROM #__mt_cats WHERE cat_id = $new_cat_parent_id" );
//	$database->loadObject( $new_cat_parent );

	$copy_subcats = mosGetParam( $_POST, 'copy_subcats', 1 );
	$copy_relcats = mosGetParam( $_POST, 'copy_relcats', 0 );
	$copy_listings = mosGetParam( $_POST, 'copy_listings', 1 );
	$copy_reviews = mosGetParam( $_POST, 'copy_reviews', 0 );
	$reset_hits = mosGetParam( $_POST, 'reset_hits', 1 );
	$reset_rating = mosGetParam( $_POST, 'reset_rating', 1 );

	$total_cats = 0;
	$total_links = 0;

	$row = new mtCats( $database );

	if ( count( $cat_id ) > 0 ) {

		foreach( $cat_id AS $id ) {

			$database->setQuery( "SELECT cat_id, lft, rgt FROM #__mt_cats WHERE cat_id = $new_cat_parent_id" );
			$database->loadObject( $new_cat_parent );

			$copied_cat_ids = $row->copyCategory( $id, $new_cat_parent->cat_id, $copy_subcats, $copy_relcats, $copy_listings, $copy_reviews, $reset_hits, $reset_rating, null );

			// Retrieve category's count
			$database->setQuery( "SELECT cat_cats, cat_links FROM #__mt_cats WHERE cat_id = $id LIMIT 1" );
			$database->loadObject( $total );

			$total_cats++;
			$total_cats += $total->cat_cats;
			$total_links += $total->cat_links;

			//print_r( $copied_cat_ids );

			// Update all category's lft and rgt to the right of this new node to accommodate new categories
			$database->setQuery("UPDATE #__mt_cats SET lft = lft+".(2*count($copied_cat_ids))." WHERE lft >= $new_cat_parent->rgt AND cat_id NOT IN (".implode(",",$copied_cat_ids).")");
			$database->query();

			$database->setQuery("UPDATE #__mt_cats SET rgt = rgt+".(2*count($copied_cat_ids))." WHERE rgt >= $new_cat_parent->rgt AND cat_id NOT IN (".implode(",",$copied_cat_ids).")");
			$database->query();

		} // End foreach
	} // End if
	
	smartCountUpdate( $new_cat_parent_id, $total_links, $total_cats );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$new_cat_parent->cat_id" );
}

/****
 * Approval / Pending
 */

function listpending_links( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	# Limits
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	$database->setQuery("SELECT COUNT(*) FROM #__mt_links WHERE link_approved < '1'");
	$total = $database->loadResult();

	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get all pending links
	$sql = "SELECT * FROM #__mt_links"
		.	"\nWHERE link_approved < '1'"
		.	"\nORDER BY link_created ASC, link_modified DESC"
		. "\nLIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$links = $database->loadObjectList();

	HTML_mtree::listpending_links( $links, $pathWay, $pageNav, $option );
}

function approve_links( $link_id, $publish=0, $option ) {
	global $database, $_MT_LANG;

	$mtLinks = new mtLinks( $database );

	if (!is_array( $link_id ) || count( $link_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_APPROVE."'); window.history.go(-1);</script>\n";
		exit;
	}

	if (count( $link_id )) {
		foreach( $link_id AS $lid ) {
			$mtLinks->load( $lid );
			$mtLinks->publishLink( $publish );

			// Only increase Link count if this is an approval to a new listing
			if ( $mtLinks->link_approved == 0 ) {
				$mtLinks->updateLinkCount( 1 );
			} elseif( $mtLinks->link_approved < 0 ) {
				// Check if there is any category change during modification
				$database->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = ABS(".$mtLinks->link_approved.") AND main = '1'" );
				$ori_cat_id = $database->loadResult();
				if ( $ori_cat_id <> $mtLinks->cat_id ) {
					$mtLinks->updateLinkCount( 1 );
					mtUpdateLinkCount( $ori_cat_id, -1 );
				}			
			}
			$mtLinks->approveLink();
		}
	}

	mosRedirect( "index2.php?option=$option&task=listpending_links",sprintf($_MT_LANG->LINKS_HAVE_BEEN_APRROVED,count( $link_id )) );	
}

function listpending_cats( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	# Limits
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	$database->setQuery("SELECT COUNT(*) FROM #__mt_cats WHERE cat_approved <> '1'");
	$total = $database->loadResult();

	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get all pending cats
	$sql = "SELECT * FROM #__mt_cats"
		.	"\nWHERE cat_approved <> '1'"
		.	"\nORDER BY cat_created DESC"
		. "\nLIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$cats = $database->loadObjectList();

	HTML_mtree::listpending_cats( $cats, $pathWay, $pageNav, $option );
}

function approve_cats( $cat_id, $publish=0, $option ) {
	global $database, $_MT_LANG;

	$mtCats = new mtCats( $database );

	if (!is_array( $cat_id ) || count( $cat_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_APPROVE."'); window.history.go(-1);</script>\n";
		exit;
	}

	if (count( $cat_id )) {
		foreach( $cat_id AS $cid ) {
			$mtCats->load( $cid );
			$mtCats->approveCat();
			$mtCats->publishCat( $publish );
			if( $mtCats->lft == 0 && $mtCats->rgt == 0 ) {
				$mtCats->updateLftRgt();
			}
			$mtCats->updateCatCount( 1 );
		}
	}

	mosRedirect( "index2.php?option=$option&task=listpending_cats",sprintf($_MT_LANG->CATS_HAVE_BEEN_APRROVED,count( $cat_id )) );	
}

function listpending_reviews( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	# Limits
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	$database->setQuery("SELECT COUNT(*) FROM #__mt_reviews WHERE rev_approved <> '1'");
	$total = $database->loadResult();

	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get all pending reviews
	$sql = "SELECT r.*, u.name AS username, u.email AS email, l.link_name FROM #__mt_reviews AS r"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nWHERE r.rev_approved <> '1'"
		.	"\nORDER BY r.rev_date DESC";
		//. "\nLIMIT $pageNav->limitstart,$pageNav->limit";

	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$reviews = $database->loadObjectList();

	HTML_mtree::listpending_reviews( $reviews, $pathWay, $pageNav, $option );
}

function save_pending_reviews( $option ) {
	global $database;

	$mtReviews = new mtReviews( $database );

	$reviews = mosGetParam( $_POST, 'rev', '' );
	$review_titles = mosGetParam( $_POST, 'rev_title', '' );
	$review_texts = mosGetParam( $_POST, 'rev_text', '' );
	$admin_notes = mosGetParam( $_POST, 'admin_note', '' );

	foreach( $reviews AS $review_id => $action ) {
		
		// 1: Approve; 0: Ignore; -1: Reject
		if ( $action == 1 || $action == 0 ) {

			$database->setQuery( "UPDATE #__mt_reviews SET rev_title = '".$review_titles[$review_id]."', rev_text = '".$review_texts[$review_id]."' WHERE rev_id = '".$review_id."'" );
			$database->query();

			if($action == 1) {
				$mtReviews->load( $review_id );
				$mtReviews->approveReview( 1 );
			} else if ($action == 0 && @isset($admin_notes) && @array_key_exists($review_id,$admin_notes) ) {
				$database->setQuery( "UPDATE #__mt_reviews SET admin_note = '".$admin_notes[$review_id]."' WHERE rev_id = '".$review_id."'" );
				$database->query();
			}

		} else {
			$database->setQuery( "DELETE FROM #__mt_reviews WHERE rev_id = '".$review_id."'" );
			$database->query();
		}

	}

	mosRedirect( "index2.php?option=$option&task=listpending_reviews" );

}

function listpending_reports( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	$database->setQuery("SELECT COUNT(*) FROM #__mt_reports");
	$total = $database->loadResult();

	# Get all pending reports
	$sql = "SELECT r.*, u.name AS username, u.email AS email, l.link_name FROM #__mt_reports AS r"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nORDER BY r.created DESC";

	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$reports = $database->loadObjectList();

	HTML_mtree::listpending_reports( $reports, $pathWay, $option );
}

function save_reports( $option ) {
	global $database;

	$reports = mosGetParam( $_POST, 'report', '' );
	$admin_notes = mosGetParam( $_POST, 'admin_note', '' );

	foreach( $reports AS $report_id => $action ) {
		if($action == 1) {
			$database->setQuery( "DELETE FROM #__mt_reports WHERE report_id = '".$report_id."'" );
			$database->query();
		} else {
			if( @isset($admin_notes) && @array_key_exists($report_id,$admin_notes) ) {
				$database->setQuery( "UPDATE #__mt_reports SET admin_note = '".$admin_notes[$report_id]."' WHERE report_id = '".$report_id."'" );
				$database->query();
			}
		}
	}

	mosRedirect( "index2.php?option=$option&task=listpending_reports" );

}

function listpending_claims( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	$database->setQuery("SELECT COUNT(*) FROM #__mt_claims");
	$total = $database->loadResult();

	# Get all pending claims
	$sql = "SELECT r.*, u.username AS username, u.name AS name, u.email AS email, l.link_name FROM #__mt_claims AS r"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nORDER BY r.created DESC";

	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$claims = $database->loadObjectList();

	HTML_mtree::listpending_claims( $claims, $pathWay, $option );
}

function save_claims( $option ) {
	global $database, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $_MT_LANG;

	$claims = mosGetParam( $_POST, 'claim', '' );
	$admin_notes = mosGetParam( $_POST, 'admin_note', '' );

	foreach( $claims AS $claim_id => $user_id ) {
		if($user_id > 0) {
			
			$database->setQuery( "SELECT c.link_id, l.link_name FROM (#__mt_claims AS c, #__mt_links AS l) WHERE claim_id = '".$claim_id."' AND c.link_id = l.link_id");
			$database->loadObject( $link );
			
			$database->setQuery( "SELECT email FROM #__users WHERE id = '".$user_id."'");
			$email = $database->loadResult();

			$database->setQuery( "UPDATE #__mt_links SET user_id = '".$user_id."' WHERE link_id = '".$link->link_id."' LIMIT 1" );
			$database->query();

			$database->setQuery( "DELETE FROM #__mt_claims WHERE claim_id = '".$claim_id."'" );
			$database->query();

			$subject = $_MT_LANG->CLAIM_APPROVED_SUBJECT;
			$body = sprintf($_MT_LANG->CLAIM_APPROVED_MSG, $link->link_name, $mosConfig_live_site."/index.php?option=com_mtree&task=viewlink&link_id=$link->link_id" );

			mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $email, $subject, $body );

		} else if ( $user_id == -1) {
			$database->setQuery( "DELETE FROM #__mt_claims WHERE claim_id = '".$claim_id."'" );
			$database->query();
		} else if ( $user_id == 0 ) {
			if( @isset($admin_notes) && @array_key_exists($claim_id,$admin_notes) ) {
				$database->setQuery( "UPDATE #__mt_claims SET admin_note = '".$admin_notes[$claim_id]."' WHERE claim_id = '".$claim_id."'" );
				$database->query();
			}
		}

	}

	mosRedirect( "index2.php?option=$option&task=listpending_claims" );

}

/****
 * Reviews
 */

function list_reviews( $link_id, $option ) {
	global $database, $mainframe;

	# Get Link's info
	$link = new mtLinks( $database );
	$link->load( $link_id );

	# Get Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Limits
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	$database->setQuery("SELECT COUNT(*) FROM #__mt_reviews WHERE rev_approved=1 && link_id = '".$link_id."'");
	$total = $database->loadResult();

	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get All the reviews
	$sql = "SELECT *, u.name AS username FROM #__mt_reviews AS r"
		."\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		."\nWHERE r.rev_approved=1 && r.link_id = '".$link_id."'"
//		."\nORDER BY l.ordering ASC"
		. "\nLIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$reviews = $database->loadObjectList();

	HTML_mtree::list_reviews( $reviews, $link, $pathWay, $pageNav, $option );

}

function editreview( $rev_id, $link_id, $option ) {
	global $database, $my;

	$row = new mtReviews( $database );
	$row->load( $rev_id );

	if ($row->rev_id == 0) {
		$row->link_id = $link_id;
		$row->owner= $my->username;
		$row->rev_approved=1;
		$row->rev_date = date( "Y-m-d" );
	} else {
		if ($row->user_id > 0) {
			$database->setQuery("SELECT username FROM #__users WHERE id ='".$row->user_id."'");
			$row->owner = $database->loadResult();
			$row->not_registered = 0;
		} else {
			$row->not_registered = 1;
		}
	}

	# Yes/No select list for Approved Link
	$lists['rev_approved'] = mosHTML::yesnoRadioList("rev_approved", 'class="inputbox"', (($row->rev_approved == 1) ? 1 : 0));

	# Lookup Cat ID
	$link = new mtLinks( $database );
	$link->load( $row->link_id );

	# Get Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Get Return task - Used by listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	HTML_mtree::editreview( $row, $pathWay, $returntask, $lists, $option );
}

function savereview( $option ) {
	global $database, $my, $_MT_LANG;

	$row = new mtReviews( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$owner = mosGetParam( $_POST, 'owner', '' );
	$not_registered = mosGetParam( $_POST, 'not_registered', 0 );

	# Is this a new review?
	if ($row->rev_id == 0) {
		$row->rev_date = date( "Y-m-d H:i:s" );	
	}

	# Lookup owner's userid. Return error if does not exists
	if ($owner == '') {
		// If owner field is left blank, assign the link to the current user
		$row->user_id = $my->id;
	} else {

		if ( $not_registered == 0 ) {
		
			$database->setQuery("SELECT id FROM #__users WHERE username ='".$owner."'");
			$owner_id = $database->loadResult();
			if ($owner_id > 0) {
				$row->user_id = $owner_id;
			} else {
				echo "<script> alert('".$_MT_LANG->INVALID_OWNER_SELECT_AGAIN."'); window.history.go(-1); </script>\n";
				exit();
			}

		} else {
			$row->user_id = 0;
			$row->guest_name = $owner;
		}
	}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	# Check return task - used to return to listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );
	
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {
		mosRedirect( "index2.php?option=$option&task=reviews_list&link_id=$row->link_id" );
	}

}

function removeReviews( $rev_id, $option ) {
	global $database, $_MT_LANG;

	$row = new mtReviews( $database );
	$row->load( $rev_id[0] );

	if (!is_array( $rev_id ) || count( $rev_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $rev_id )) {
		$rev_ids = implode( ',', $rev_id );
		
		# Remove links
		$database->setQuery( "DELETE FROM #__mt_reviews WHERE rev_id IN ($rev_ids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}

	mosRedirect( "index2.php?option=$option&task=reviews_list&link_id=".$row->link_id );
}

function cancelreview( $link_id, $option ) {
	# Check return task - used to return to listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );
	
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask" );
	} else {
		mosRedirect( "index2.php?option=$option&task=reviews_list&link_id=$link_id" );
	}
}

function backreview( $link_id, $option ) {
	global $database;

	$mtLinks = new mtLinks( $database );
	$mtLinks->load( $link_id );

	mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$mtLinks->cat_id" );
}

/****
 * Search
 */

function search( $option ) {
	global $database, $mainframe, $_MT_LANG;

	$search_text = trim(mosGetParam( $_POST, 'search_text', '' ));
	$search_where = mosGetParam( $_POST, 'search_where', '' ); // 1: Listing, 2: Category

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	# Detect search command
	
	# Quick Go
	$id_found = 0;
	if ( substr($search_text, 0, 3) == "id:" ) {
		$temp = explode(":", $search_text);
		if ( is_numeric($temp[1]) ) {
			$id_found = $temp[1];
		}
	}

	# Search query
	if ( $search_where == 1 ) {
		
		if ($id_found) {
			$link = new mtLinks( $database );
			$link->load( $id_found );
			
			if( !empty($link->link_name) ) {
				mosRedirect( "index2.php?option=com_mtree&task=editlink&link_id=".$id_found );
			} else {
				mosRedirect( "index2.php?option=com_mtree",$_MT_LANG->YOUR_SEARCH_DOES_NOT_RETURN_ANY_RESULT );
			}

		} else {
			
			// Total Results
			$database->setQuery( "SELECT COUNT(*) FROM #__mt_links"
				//.	"\nWHERE link_name LIKE '%".$search_text."%' OR link_desc LIKE '%".$search_text."%'"
				.	"\nWHERE link_name LIKE '%".$search_text."%'"
				);
			$total = $database->loadResult();

			// Links
			$database->setQuery( "SELECT l.*, COUNT(r.rev_id) AS reviews FROM #__mt_links AS l"
				.	"\nLEFT JOIN #__mt_reviews AS r ON r.link_id = l.link_id"
				//.	"\nWHERE l.link_name LIKE '%".$search_text."%' OR l.link_desc LIKE '%".$search_text."%'"
				.	"\nWHERE l.link_name LIKE '%".$search_text."%'"
				.	"\nGROUP BY l.link_id"
				.	"\nORDER BY l.link_name ASC"
				.	"\nLIMIT $limitstart, $limit"
				);

		}
		
	} else {

		if ($id_found) {
			$cat = new mtCats( $database );
			$cat->load( $id_found );
			
			if( !empty($cat->cat_name) ) {
				mosRedirect( "index2.php?option=com_mtree&task=editcat&cat_id=".$id_found );
			} else {
				mosRedirect( "index2.php?option=com_mtree",$_MT_LANG->YOUR_SEARCH_DOES_NOT_RETURN_ANY_RESULT );
			}

		} else {

			// Total Results
			$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats WHERE cat_name LIKE '%".$search_text."%'" );
			$total = $database->loadResult();

			// Categories
			$database->setQuery( "SELECT * FROM #__mt_cats WHERE cat_name LIKE '%".$search_text."%' ORDER BY cat_name ASC LIMIT $limitstart, $limit" );
		
		}

	}

	$results = $database->loadObjectList();

		# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get Pathway
	$pathWay = new mtPathWay();

	# Results Output
	if ( $search_where == 1 ) {
		// Links
		HTML_mtree::searchresults_links( $results, $pageNav, $pathWay, $search_where, $search_text, $option );
	} else {
		// Categories
		HTML_mtree::searchresults_categories( $results, $pageNav, $pathWay, $search_where, $search_text, $option );
	}

}

function advsearch( $option ) {
	global $database, $_MT_LANG, $mosConfig_absolute_path;

	# Template select list
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', $_MT_LANG->DEFAULT );

	foreach($templateDirs as $templateDir) {
		$templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'link_template', 'class="inputbox" size="1"',
	'value', 'text', '' );
	
	# Publishing
	$publishing[] = mosHTML::makeOption( 1, $_MT_LANG->ALL );
	$publishing[] = mosHTML::makeOption( 2, $_MT_LANG->PUBLISHED );
	$publishing[] = mosHTML::makeOption( 3, $_MT_LANG->UNPUBLISHED );
	$publishing[] = mosHTML::makeOption( 4, $_MT_LANG->PENDING );
	$publishing[] = mosHTML::makeOption( 5, $_MT_LANG->EXPIRED );
	$publishing[] = mosHTML::makeOption( 6, $_MT_LANG->AWAITING_APPROVAL );
	$lists['publishing'] = mosHTML::selectList( $publishing, 'publishing', 'class="inputbox" size="1"',	'value', 'text', '' );

	// Comparison option
	$comparison[] = mosHTML::makeOption( 1, $_MT_LANG->EXACTLY );
	$comparison[] = mosHTML::makeOption( 2, $_MT_LANG->MORE_THAN );
	$comparison[] = mosHTML::makeOption( 3, $_MT_LANG->LESS_THAN );

	# Price
	$lists['price'] = mosHTML::selectList( $comparison, 'opt_price', 'class="inputbox" size="1"',
	'value', 'text', 1 );

	# Rating
	$lists['rating'] = mosHTML::selectList( $comparison, 'opt_rating', 'class="inputbox" size="1"',
	'value', 'text', 1 );

	# Votes
	$lists['votes'] = mosHTML::selectList( $comparison, 'opt_votes', 'class="inputbox" size="1"',
	'value', 'text', 1 );

	# Hits
	$lists['hits'] = mosHTML::selectList( $comparison, 'opt_hits', 'class="inputbox" size="1"',
	'value', 'text', 1 );

	# Reviews
	$lists['reviews'] = mosHTML::selectList( $comparison, 'opt_reviews', 'class="inputbox" size="1"',
	'value', 'text', 1 );

	# Retrieve the custom field's caption
	$database->setQuery("SELECT name, value FROM #__mt_config WHERE name LIKE 'cust_%' ORDER BY name");
	$custom_fields = $database->loadObjectList('name');

	HTML_mtree::advsearch( $custom_fields, $lists, $option );
}

function advsearch2( $option ) {
	global $database, $mosConfig_offset, $_MT_LANG;

	$search_where = mosGetParam( $_POST, 'search_where', '' ); // 1: Listing, 2: Category

	$limit = mosGetParam( $_POST, 'limit', 15 ); // 1: Listing, 2: Category
	$limitstart = mosGetParam( $_POST, 'limitstart', 0 ); // 1: Listing, 2: Category

	$owner =	mosGetParam( $_POST, 'owner', '' );

	$link_name =	mosGetParam( $_POST, 'link_name', '' );
	$link_desc =	mosGetParam( $_POST, 'link_desc', '' );
	$website =		mosGetParam( $_POST, 'website', '' );
	$address =		mosGetParam( $_POST, 'address', '' );
	$city =				mosGetParam( $_POST, 'city', '' );
	$country =		mosGetParam( $_POST, 'country', '' );
	$postcode =		mosGetParam( $_POST, 'postcode', '' );
	$telephone =	mosGetParam( $_POST, 'telephone', '' );
	$fax =				mosGetParam( $_POST, 'fax', '' );
	$email =			mosGetParam( $_POST, 'email', '' );
	$publishing = mosGetParam( $_POST, 'publishing', '' );
	$link_template = mosGetParam( $_POST, 'link_template', '' );
	$price =			mosGetParam( $_POST, 'price', '' );
	$opt_price =	mosGetParam( $_POST, 'opt_price', '' );
	$link_rating = mosGetParam( $_POST, 'link_rating', '' );
	$opt_rating = mosGetParam( $_POST, 'opt_rating', '' );
	$link_votes = mosGetParam( $_POST, 'link_votes', '' );
	$opt_votes =	mosGetParam( $_POST, 'opt_votes', '' );
	$link_hits =	mosGetParam( $_POST, 'link_hits', '' );
	$opt_hits =		mosGetParam( $_POST, 'opt_hits', '' );
	$reviews =	mosGetParam( $_POST, 'reviews', '' );
	$opt_reviews =		mosGetParam( $_POST, 'opt_reviews', '' );
	$link_image =		mosGetParam( $_POST, 'link_image', '' );
	$internal_notes =		mosGetParam( $_POST, 'internal_notes', '' );
	$metakey =		mosGetParam( $_POST, 'metakey', '' );
	$metadesc =		mosGetParam( $_POST, 'metadesc', '' );

	# Custom Fields
	for( $i=1; $i<=30; $i++ ) {
		$tmp_var = "cust_".$i;
		$$tmp_var = mosGetParam( $_POST, "cust_$i", '' );
	}

	# Search query
	if ( $search_where == 1 ) {
		
		$where = array();
		$having = '';

		# Construct SELECT condition
		if ($link_name) $where[] = "link_name LIKE '%$link_name%'";
		if ($link_desc) $where[] = "link_desc LIKE '%$link_desc%'";
		if ($website) $where[] = "website LIKE '%$website%'";
		if ($address) $where[] = "address LIKE '%$address%'";
		if ($city) $where[] = "city LIKE '%$city%'";
		if ($country) $where[] = "country LIKE '%$country%'";
		if ($postcode) $where[] = "postcode LIKE '%$postcode%'";
		if ($telephone) $where[] = "telephone LIKE '%$telephone%'";
		if ($fax) $where[] = "fax LIKE '%$fax%'";
		if ($email) $where[] = "email LIKE '%$email%'";
		if ($link_template) $where[] = "link_template LIKE '%$link_template%'";
		if ($link_image) $where[] = "link_image LIKE '%$link_image%'";
		if ($internal_notes) $where[] = "internal_notes LIKE '%$internal_notes%'";
		if ($metakey) $where[] = "metakey LIKE '%$metakey%'";
		if ($metadesc) $where[] = "metadesc LIKE '%$metadesc%'";

		# Custom Fields
		for( $i=1; $i<=30; $i++ ) {
			$tmp_var = "cust_".$i;
			if ($$tmp_var) $where[] = "$tmp_var LIKE '%".$$tmp_var."%'";
		}

		// price
		if ( is_numeric($price) && $price >= 0 ) {
			switch($opt_price) {
				case 1:
					$where[] = "price = '$price'";
					break;
				case 2:
					$where[] = "price > '$price'";
					break;
				case 3:
					$where[] = "price < '$price'";
					break;
			}
		}

		// rating
		if ( is_numeric($link_rating) && $link_rating >= 0 && $link_rating <= 5 ) {
			switch($opt_rating) {
				case 1:
					$where[] = "link_rating = '$link_rating'";
					break;
				case 2:
					$where[] = "link_rating > '$link_rating'";
					break;
				case 3:
					$where[] = "link_rating < '$link_rating'";
					break;
			}
		}
		
		// votes
		if ( is_numeric($link_votes) && $link_votes >= 0 ) {
			switch($opt_votes) {
				case 1:
					$where[] = "link_votes = '$link_votes'";
					break;
				case 2:
					$where[] = "link_votes > '$link_votes'";
					break;
				case 3:
					$where[] = "link_votes < '$link_votes'";
					break;
			}
		}
		
		// hits
		if ( is_numeric($link_hits) && $link_hits >= 0 ) {
			switch($opt_hits) {
				case 1:
					$where[] = "link_hits = '$link_hits'";
					break;
				case 2:
					$where[] = "link_hits > '$link_hits'";
					break;
				case 3:
					$where[] = "link_hits < '$link_hits'";
					break;
			}
		}

		// reviews
		if ( is_numeric($reviews) && $reviews >= 0 ) {
			switch($opt_reviews) {
				case 1:
					$having = "reviews = '$reviews'";
					break;
				case 2:
					$having = "reviews > '$reviews'";
					break;
				case 3:
					$having = "reviews < '$reviews'";
					break;
			}
		}

		$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

		switch ($publishing) {
			case 2: // Published
				$where[] = "( (publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now')  AND "
				. "(publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now') AND "
				.	"link_published = '1' )";
				break;
			case 3: // Unpublished
				$where[] = "link_published = '0'";
				break;
			case 4: // Pending
				$where[] =  "( (publish_up => '$now' OR publish_up = '0000-00-00 00:00:00') AND link_published = '1' )";
				break;
			case 5: // Expired
				$where[] =  "( publish_down < '$now' AND link_published = '1' )";
				break;
			case 6: // Pending Listing, waiting for approval
				$where[] = "link_approved <= 0";
				break;
		}

		# Check if this owner exists
		# Lookup owner's userid. Return error if does not exists
		if ( !empty($owner) ) {
			$database->setQuery("SELECT id FROM #__users WHERE username ='".$owner."'");
			$owner_id = $database->loadResult();
			if ($owner_id > 0) {
				$where[] = "l.user_id = $owner_id";
			} else {
				echo "<script> alert('".$_MT_LANG->INVALID_OWNER_SELECT_AGAIN."'); window.history.go(-1); </script>\n";
				exit();
			}
		}

		// Total Results

		$database->setQuery( "SELECT l.*, COUNT(r.rev_id) AS reviews FROM #__mt_links AS l"
			.	"\nLEFT JOIN #__mt_reviews AS r ON r.link_id = l.link_id"
			.	( (count($where)) ? "\nWHERE ".implode(" AND ", $where) : '')
			.	"\nGROUP BY l.link_id"
			. ( ($having <> '') ? "\nHAVING " . $having : '' ) );
		
		$database->query();
		$total = $database->getNumRows();

		// Links
		$where[] = "cl.main = '1'";
		$where[] = "cl.link_id = l.link_id";

		$database->setQuery( "SELECT l.*, cl.cat_id, COUNT(r.rev_id) AS reviews FROM (#__mt_links AS l, #__mt_cl AS cl) "
			.	"\nLEFT JOIN #__mt_reviews AS r ON r.link_id = l.link_id"
			.	( (count($where)) ? "\nWHERE ".implode(" AND ", $where) : '')
			.	"\nGROUP BY l.link_id"
			. ( ($having <> '') ? "\nHAVING " . $having : '' )
			.	"\nORDER BY l.link_name ASC"
			.	"\nLIMIT $limitstart, $limit" );

	} else {

		// Total Results
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats WHERE cat_name LIKE '%".$search_text."%'" );
		$total = $database->loadResult();

		// Categories
		$database->setQuery( "SELECT * FROM #__mt_cats WHERE cat_name LIKE '%".$search_text."%' ORDER BY cat_name ASC LIMIT $limitstart, $limit" );
	}
	//echo $database->getQuery();

	$results = $database->loadObjectList();

	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get Pathway
	$pathWay = new mtPathWay();
	
	# Results Output
	if ( $search_where == 1 ) {
		// Links
		HTML_mtree::advsearchresults_links( $results, $pageNav, $pathWay, $search_where, $option );
	} else {
		// Categories
		HTML_mtree::searchresults_categories( $results, $pageNav, $pathWay, $search_where, $option );
	}

}

/***
* Tree Templates
*/

function templates( $option ) {
	global $database, $mainframe;
	global $mosConfig_absolute_path, $mosConfig_list_limit, $mt_template;

	$templateBaseDir = mosPathName( $mosConfig_absolute_path . '/components/com_mtree/templates' );

	$rows = array();
	// Read the template dir to find templates
	$templateDirs		= mosReadDirectory($templateBaseDir);

	$cur_template = $mt_template;

	$rowid = 0;

	// Check that the directory contains an xml file
	foreach($templateDirs as $templateDir) {
		$dirName = mosPathName($templateBaseDir . $templateDir);
		$xmlFilesInDir = mosReadDirectory($dirName,'.xml');

		foreach($xmlFilesInDir as $xmlfile) {
			// Read the file to see if it's a valid template XML file
			$xmlDoc =& new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors( true );
			if (!$xmlDoc->loadXML( $dirName . $xmlfile, false, true )) {
				continue;
			}

			$element = &$xmlDoc->documentElement;

			if ($element->getTagName() != 'mosinstall') {
				continue;
			}
			if ($element->getAttribute( 'type' ) != 'template') {
				continue;
			}

			$row = new StdClass();
			$row->id = $rowid;
			$row->directory = $templateDir;
			$element = &$xmlDoc->getElementsByPath('name', 1 );
			$row->name = $element->getText();

			$element = &$xmlDoc->getElementsByPath('creationDate', 1);
			$row->creationdate = $element ? $element->getText() : 'Unknown';

			$element = &$xmlDoc->getElementsByPath('author', 1);
			$row->author = $element ? $element->getText() : 'Unknown';

			$element = &$xmlDoc->getElementsByPath('copyright', 1);
			$row->copyright = $element ? $element->getText() : '';

			$element = &$xmlDoc->getElementsByPath('authorEmail', 1);
			$row->authorEmail = $element ? $element->getText() : '';

			$element = &$xmlDoc->getElementsByPath('authorUrl', 1);
			$row->authorUrl = $element ? $element->getText() : '';

			$element = &$xmlDoc->getElementsByPath('version', 1);
			$row->version = $element ? $element->getText() : '';

			$element = &$xmlDoc->getElementsByPath('description', 1);
			$row->description = $element ? $element->getText() : '';

			// Get info from db
			if ($cur_template == $templateDir) {
				$row->default	= 1;
			} else {
				$row->default = 0;
			}

			$row->checked_out = 0;
			$row->mosname = strtolower( str_replace( ' ', '_', $row->name ) );

			$rows[] = $row;
			$rowid++;
		}
	}

	HTML_mtree::list_templates( $rows, $option );
}

function edit_templatepage( $option ) {
	global $mosConfig_absolute_path, $_MT_LANG;

	$page = mosGetParam( $_REQUEST, 'page', '' );
	$template = mosGetParam( $_REQUEST, 'template', '' );

	$file = $mosConfig_absolute_path .'/components/com_mtree/templates/'. $template .'/'. $page .'.tpl.php';

	if ( $fp = fopen( $file, 'r' ) ) {
		$content = fread( $fp, filesize( $file ) );
		$content = htmlspecialchars( $content );

		HTML_mtree::edit_templatepage( $page, $template, $content, $option );
		//HTML_templates::editTemplateSource( $p_tname, $content, $option, $client );
	} else {
		mosRedirect( 'index2.php?option='. $option .'&task=templates', sprintf($_MT_LANG->CANNOT_OPEN_FILE, $file) );
	}

}

function save_templatepage( $option ) {
	global $mosConfig_absolute_path, $_MT_LANG;

	$template = mosGetParam( $_POST, 'template', '' );
	$page = mosGetParam( $_POST, 'page', '' );
	$pagecontent = mosGetParam( $_POST, 'pagecontent', '', _MOS_ALLOWHTML );

	if ( !$template ) {
		mosRedirect( 'index2.php?option='. $option .'&task=templates' );
	}

	if ( !$pagecontent ) {
		mosRedirect( 'index2.php?option='. $option .'&task=templates' );
	}

	$file = $mosConfig_absolute_path .'/components/com_mtree/templates/'. $template .'/'.$page.'.tpl.php';

	if ( is_writable( $file ) == false ) {
		mosRedirect( "index2.php?option=$option&task=templates" , sprintf($_MT_LANG->FILE_NOT_WRITEABLE, $file) );
	}

	if ( $fp = fopen ($file, 'w' ) ) {
		fputs( $fp, stripslashes( $pagecontent ), strlen( $pagecontent ) );
		fclose( $fp );
		mosRedirect( "index2.php?option=$option&task=templates", $_MT_LANG->TEMPLATE_PAGE_SAVED );
	} else {
		mosRedirect( "index2.php?option=$option&task=templates", sprintf( $_MT_LANG->FILE_NOT_WRITEABLE, $file ) );
	}

}

function cancel_template( $option ) {
	mosRedirect( "index2.php?option=$option&task=templates" );
}

/***
* Languages
*/

function languages( $active_language='', $option ) {
	global $database, $mainframe;
	global $mosConfig_absolute_path, $mosConfig_list_limit, $mt_language;

	// get current languages
	$cur_language = $mt_language;

	if ( $active_language == '' ) $active_language = $cur_language;

	$rows = array();
	// Read the template dir to find templates
	$languageBaseDir = mosPathName( $mosConfig_absolute_path . '/components/com_mtree/language' );

	$rowid = 0;

	$xmlFilesInDir = mosReadDirectory($languageBaseDir,".xml");

	$dirName = $languageBaseDir;
	foreach($xmlFilesInDir as $xmlfile) {
		// Read the file to see if it's a valid template XML file
		$xmlDoc =& new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if (!$xmlDoc->loadXML( $dirName . $xmlfile, false, true )) {
			continue;
		}

		$element = &$xmlDoc->documentElement;

		if ($element->getTagName() != 'mtreeinstall') {
			continue;
		}
		if ($element->getAttribute( "type" ) != "language") {
			continue;
		}

		$row = new StdClass();
		$row->id = $rowid;
		$row->language = substr($xmlfile,0,-4);
		$element = &$xmlDoc->getElementsByPath('name', 1 );
		$row->name = $element->getText();

		$element = &$xmlDoc->getElementsByPath('creationDate', 1);
		$row->creationdate = $element ? $element->getText() : 'Unknown';

		$element = &$xmlDoc->getElementsByPath('author', 1);
		$row->author = $element ? $element->getText() : 'Unknown';

		$element = &$xmlDoc->getElementsByPath('copyright', 1);
		$row->copyright = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('authorEmail', 1);
		$row->authorEmail = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('authorUrl', 1);
		$row->authorUrl = $element ? $element->getText() : '';

		$element = &$xmlDoc->getElementsByPath('version', 1);
		$row->version = $element ? $element->getText() : '';

		// if current than set published
		if ($cur_language == $row->language) {
			$row->published	= 1;
		} else {
			$row->published = 0;
		}

		$row->checked_out = 0;
		$row->mosname = strtolower( str_replace( " ", "_", $row->name ) );
		$rows[] = $row;
		$rowid++;
	}

	// Open the language file for editing
	$file = $mosConfig_absolute_path .'/components/com_mtree/language/'. $active_language . '.php';

	if ( $fp = fopen( $file, 'r' ) ) {
		$content = fread( $fp, filesize( $file ) );
		$content = htmlspecialchars( $content );
	}

	HTML_mtree::editLanguage( $cur_language, $active_language, $content, $rows, $option );

}

function save_language( $option ) {
	global $mosConfig_absolute_path, $_MT_LANG;

	$language = mosGetParam( $_POST, 'language', '' );
	$pagecontent = mosGetParam( $_POST, 'pagecontent', '', _MOS_ALLOWHTML );

	if ( !$language ) {
		mosRedirect( 'index2.php?option='. $option .'&task=languages' );
	}

	if ( !$pagecontent ) {
		mosRedirect( 'index2.php?option='. $option .'&task=languages' );
	}

	$file = $mosConfig_absolute_path .'/components/com_mtree/language/'. $language .'.php';

	if ( is_writable( $file ) == false ) {
		mosRedirect( "index2.php?option=$option&task=languages" , sprintf($_MT_LANG->FILE_NOT_WRITEABLE, $file) );
	}

	if ( $fp = fopen ($file, 'w' ) ) {
		fputs( $fp, stripslashes( $pagecontent ), strlen( $pagecontent ) );
		fclose( $fp );
		mosRedirect( "index2.php?option=$option&task=languages", $_MT_LANG->LANGUAGE_FILE_SAVED );
	} else {
		mosRedirect( "index2.php?option=$option&task=languages", sprintf( $_MT_LANG->FILE_NOT_WRITEABLE, $file ) );
	}

}

function cancel_language( $option ) {
	mosRedirect( "index2.php?option=$option" );
}

/***
* CSV Import Export
*/

function csv( $option ) {
	global $database, $_MT_LANG;

	# Retrieve the custom field's caption
	$database->setQuery("SELECT name, value FROM #__mt_config WHERE name LIKE 'cust_%' AND value != '' ORDER BY name");
	$custom_fields = $database->loadObjectList();

	# Publishing
	$publishing[] = mosHTML::makeOption( 1, $_MT_LANG->ALL );
	$publishing[] = mosHTML::makeOption( 2, $_MT_LANG->PUBLISHED );
	$publishing[] = mosHTML::makeOption( 3, $_MT_LANG->UNPUBLISHED );
	$publishing[] = mosHTML::makeOption( 4, $_MT_LANG->PENDING );
	$publishing[] = mosHTML::makeOption( 5, $_MT_LANG->EXPIRED );
	$publishing[] = mosHTML::makeOption( 6, $_MT_LANG->AWAITING_APPROVAL );
	$lists['publishing'] = mosHTML::selectList( $publishing, 'publishing', 'class="inputbox" size="1"',	'value', 'text', '' );

	HTML_mtree::csv( $custom_fields, $lists, $option );
	
}

function csv_export( $option ) {
	global $database, $mosConfig_offset;
	
	$fields = mosGetParam( $_POST, 'fields', '');
	$publishing = mosGetParam( $_POST, 'publishing', '');

	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

	switch ($publishing) {
		case 2: // Published
			$where[] = "( (publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now')  AND "
			. "(publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now') AND "
			.	"link_published = '1' )";
			break;
		case 3: // Unpublished
			$where[] = "link_published = '0'";
			break;
		case 4: // Pending
			$where[] =  "( (publish_up => '$now' OR publish_up = '0000-00-00 00:00:00') AND link_published = '1' )";
			break;
		case 5: // Expired
			$where[] =  "( publish_down < '$now' AND link_published = '1' )";
			break;
		case 6: // Pending Listing, waiting for approval
			$where[] = "link_approved <= 0";
			break;
	}
	
	$where[] = "l.link_id = cl.link_id";
	$where[] = "cl.main = '1'";

	$sql = "SELECT ".implode(", ",$fields)." FROM #__mt_links AS l, #__mt_cl AS cl";

	if (isset($where) AND count($where)) {
		$sql .= "\n WHERE ".implode(" AND ", $where);
	}

	$database->setQuery( $sql );
	$rows = $database->loadObjectList();
	
	$seperator = ',';

	# Create the .CSV
	$header = '';
	$data='';
	foreach ($fields AS $field) {
			$header .= $field.$seperator;
	}
	$header .= "\n";

	foreach($rows AS $row) {
		$line = '';
		$j = 0;

		foreach($row as $value){

			if ($j >= 0) {
				if(!isset($value) || $value == ""){
					//$value = $seperator;
				}else{
					$value = str_replace('"', '""', $value);
					$value = '"' . $value . '"'; // . $seperator;
				}
				$line .= $value;
				$line .= $seperator;
			}
			$j++;

		}

		$data .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
		$data = str_replace("\r", "", $data);

	HTML_mtree::csv_export( $header, $data, $option );
}

/***
* Custom Fields
*/

function customfields( $option ) {
	global $database;

	# Retrieve the custom field's caption
	$database->setQuery("SELECT name, value FROM #__mt_config WHERE name LIKE 'cust_%' ORDER BY name");
	$custom_fields = $database->loadObjectList('name');

	HTML_mtree::customfields( $custom_fields, $option );

}

function save_customfields( $option ) {
	global $database, $_MT_LANG;

	$where = array();

	for($i=1;$i<=30;$i++) {
		$var_name = "cust_".$i;
		$$var_name = trim(mosGetParam( $_REQUEST, $var_name, '' ));
		//$where[] = "$var_name = '".$$var_name."'";

		$database->setQuery( "UPDATE #__mt_config SET value='".$$var_name."' WHERE name = '".$var_name."'"   );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
	}

	mosRedirect( "index2.php?option=$option&task=customfields", $_MT_LANG->CUSTOM_FIELDS_HAVE_BEEN_UPDATED );

}

/***
* Configuration
*/

function config( $option ) {
  global $database, $_MT_LANG, $mosConfig_absolute_path;

	$row = new mtConfig();
	$row->bindGlobals();

  $configfile = "components/com_mtree/config.mtree.php";
  @chmod ($configfile, 0766);
  $permission = is_writable($configfile);
  if (!$permission) {
     echo "<center><h1><font color=red>Warning...</FONT></h1><BR>";
     echo "<B>Your config file is /administrator/$configfile</b><BR>";
     echo "<B>You need to chmod this to 766 in order for the config to be updated</B></center><BR><BR>";
  }

	# compile list of the languages
	$langs = array();
	$menuitems = array();

	if ($handle=opendir("../components/com_mtree/language/")) {
		$i=0;
		while ($file = readdir($handle)) {
			if (!strcasecmp(substr($file,-4),".php") && $file <> "." && $file <> ".." && strcasecmp(substr($file,-11),".ignore.php")) {
				$langs[] = mosHTML::makeOption( substr($file,0,-4) );
			}
		}
	}

	# sort list of languages
	//sort($langs);
	//reset($langs);

	# Template select list
	$templateDirs	= mosReadDirectory($mosConfig_absolute_path . '/components/com_mtree/templates');

	foreach($templateDirs as $templateDir) {
		if ( $templateDir <> "index.html") $templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['language'] = mosHTML::selectList( $langs, 'language', 'class="inputbox" size="1"',
	'value', 'text', $row->language );
	$lists['template'] = mosHTML::selectList( $templates, 'template', 'class="inputbox" size="1"',
	'value', 'text', $row->template );


	# Map
	$map = array();
	$map[] = mosHTML::makeOption( "mapquest", "MapQuest" );
	$map[] = mosHTML::makeOption( "yahoomaps", "Yahoo! Maps" );
	$map[] = mosHTML::makeOption( "googlemaps", "Google Maps" );
	$lists['map'] = mosHTML::selectList( $map, 'map', 'class="inputbox" size="1"',
	'value', 'text', $row->map );

	# Sorting
	$sort = array();
	$sort[] = mosHTML::makeOption( "asc", "Ascending" );
	$sort[] = mosHTML::makeOption( "desc", "Descending" );
	
	$cat_order = array();
	$cat_order[] = mosHTML::makeOption( "cat_name", $_MT_LANG->NAME );
	$cat_order[] = mosHTML::makeOption( "cat_featured", $_MT_LANG->FEATURED );
	$cat_order[] = mosHTML::makeOption( "cat_created", $_MT_LANG->CREATED );

	$listing_order = array();
	$listing_order[] = mosHTML::makeOption( "link_name", $_MT_LANG->NAME );
	$listing_order[] = mosHTML::makeOption( "link_hits", $_MT_LANG->HITS );
	$listing_order[] = mosHTML::makeOption( "link_votes", $_MT_LANG->VOTES );
	$listing_order[] = mosHTML::makeOption( "link_rating", $_MT_LANG->RATING );
	$listing_order[] = mosHTML::makeOption( "link_visited", $_MT_LANG->VISIT );
	$listing_order[] = mosHTML::makeOption( "link_featured", $_MT_LANG->FEATURED );
	$listing_order[] = mosHTML::makeOption( "link_created", $_MT_LANG->CREATED );
	$listing_order[] = mosHTML::makeOption( "link_modified", $_MT_LANG->MODIFIED );
	$listing_order[] = mosHTML::makeOption( "price", $_MT_LANG->PRICE );

	// Category
	$lists['first_cat_order1'] = mosHTML::selectList( $cat_order, 'first_cat_order1', 'class="inputbox" size="1"',
	'value', 'text', $row->first_cat_order1 );
	$lists['first_cat_order2'] = mosHTML::selectList( $sort, 'first_cat_order2', 'class="inputbox" size="1"',
	'value', 'text', $row->first_cat_order2 );
	$lists['second_cat_order1'] = mosHTML::selectList( $cat_order, 'second_cat_order1', 'class="inputbox" size="1"',
	'value', 'text', $row->second_cat_order1 );
	$lists['second_cat_order2'] = mosHTML::selectList( $sort, 'second_cat_order2', 'class="inputbox" size="1"',
	'value', 'text', $row->second_cat_order2 );

	// Listing
	$lists['first_listing_order1'] = mosHTML::selectList( $listing_order, 'first_listing_order1', 'class="inputbox" size="1"',
	'value', 'text', $row->first_listing_order1 );
	$lists['first_listing_order2'] = mosHTML::selectList( $sort, 'first_listing_order2', 'class="inputbox" size="1"',
	'value', 'text', $row->first_listing_order2 );
	$lists['second_listing_order1'] = mosHTML::selectList( $listing_order, 'second_listing_order1', 'class="inputbox" size="1"',
	'value', 'text', $row->second_listing_order1 );
	$lists['second_listing_order2'] = mosHTML::selectList( $sort, 'second_listing_order2', 'class="inputbox" size="1"',
	'value', 'text', $row->second_listing_order2 );

	// Search
	$lists['fulltext_search'] = mosHTML::selectList( $listing_order, 'fulltext_search', 'class="inputbox" size="1"',
	'value', 'text', $row->fulltext_search );
	$lists['first_search_order1'] = mosHTML::selectList( $listing_order, 'first_search_order1', 'class="inputbox" size="1"',
	'value', 'text', $row->first_search_order1 );
	$lists['first_search_order2'] = mosHTML::selectList( $sort, 'first_search_order2', 'class="inputbox" size="1"',
	'value', 'text', $row->first_search_order2 );
	$lists['second_search_order1'] = mosHTML::selectList( $listing_order, 'second_search_order1', 'class="inputbox" size="1"',
	'value', 'text', $row->second_search_order1 );
	$lists['second_search_order2'] = mosHTML::selectList( $sort, 'second_search_order2', 'class="inputbox" size="1"',
	'value', 'text', $row->second_search_order2 );

	# User Access
	$access = array();
	$access[] = mosHTML::makeOption( "-1", $_MT_LANG->NONE );
	$access[] = mosHTML::makeOption( "0", $_MT_LANG->PUBLIC );
	$access[] = mosHTML::makeOption( "1", $_MT_LANG->REGISTERED_ONLY );
	$lists['user_rating'] = mosHTML::selectList( $access, 'user_rating', 'class="text_area" size="3"', 'value', 'text', $row->user_rating );
	$lists['user_review'] = mosHTML::selectList( $access, 'user_review', 'class="text_area" size="3"', 'value', 'text', $row->user_review );
	$lists['user_recommend'] = mosHTML::selectList( $access, 'user_recommend', 'class="text_area" size="3"', 'value', 'text', $row->user_recommend );
	$lists['user_addlisting'] = mosHTML::selectList( $access, 'user_addlisting', 'class="text_area" size="3"', 'value', 'text', $row->user_addlisting );
	$lists['user_addcategory'] = mosHTML::selectList( $access, 'user_addcategory', 'class="text_area" size="3"', 'value', 'text', $row->user_addcategory );

	$lists['user_allowmodify'] = mosHTML::selectList( $access, 'user_allowmodify', 'class="text_area" size="3"', 'value', 'text', $row->user_allowmodify );
	$lists['user_allowdelete'] = mosHTML::selectList( $access, 'user_allowdelete', 'class="text_area" size="3"', 'value', 'text', $row->user_allowdelete );

	# Get custom field's caption
	$database->setQuery( "SELECT name, value, searchable FROM #__mt_config WHERE name LIKE 'cust_%'" );
	$custom_fields = $database->loadObjectList('name');

	# Detect Image Libraries available
	$imageLibs=array();
	$imageLibs=detect_ImageLibs();

	# Thumbnail Creator
	if(!empty($imageLibs['gd1'])) { $thumbcreator[] = mosHTML::makeOption( 'gd1', 'GD Library '.$imageLibs['gd1'] ); }

	$thumbcreator[] = mosHTML::makeOption( 'gd2', 'GD2 Library '.( (array_key_exists('gd2',$imageLibs)) ? $imageLibs['gd2'] : '') );
	$thumbcreator[] = mosHTML::makeOption( 'netpbm', (isset($imageLibs['netpbm'])) ? $imageLibs['netpbm'] : "Netpbm" );
	$thumbcreator[] = mosHTML::makeOption( 'imagemagick', (isset($imageLibs['imagemagick'])) ? $imageLibs['imagemagick'] : "Imagemagick" ); 

	$lists['resize_method'] = mosHTML::selectList( $thumbcreator, 'resize_method', 'class="text_area" size="3"', 'value', 'text', $row->resize_method );
	
	# Front End Wysiwig Editor
	/*
	$edits[] = mosHTML::makeOption( '0', $_MT_LANG->DO_NOT_ALLOW_HTML );
	$edits[] = mosHTML::makeOption( '-1', $_MT_LANG->USE_MAMBO_DEFAULT_EDITOR );
	
	$query = "SELECT id AS value, name AS text"
	. "\n FROM #__mambots"
	. "\n WHERE folder='editors' AND published >= 0"
	. "\n ORDER BY ordering, name"
	;
	$database->setQuery( $query );
	$edits = array_merge($database->loadObjectList(),$edits);

	$query = "SELECT id"
	. "\n FROM #__mambots"
	. "\n WHERE folder='editors' AND published = 1"
	. "\n LIMIT 1"
	;
	$database->setQuery( $query );
	$editor = $database->loadResult();

	$lists['fe_editor'] = mosHTML::selectList( $edits, 'fe_editor', 'class="inputbox" size="1"', 'value', 'text', $row->fe_editor );
	*/
  HTML_mtree::config( $row, $custom_fields, $lists, $imageLibs, $option );

}

function saveconfig($option) {
	global $_MT_LANG, $database;

	$row = new mtConfig();
	if (!$row->bind( $_POST )) {
		mosRedirect( "index2.php", $row->getError() );
	}
	
	// Save search_cust_xx value to database
	for( $i=1; $i <=30; $i++ ) {
		$searchable = $_POST["search_cust_".$i];
		if ( $searchable <> 1 ) $searchable = 0;

		$database->setQuery( "UPDATE #__mt_config SET searchable= '$searchable' WHERE name='cust_".$i."'" );
		$database->query();
	}

	$config = "<?php\n";
	$config .= $row->getVarText();
	$config .= "?>";

	if ($fp = fopen("components/com_mtree/config.mtree.php", "w")) {
		fputs($fp, $config, strlen($config));
		fclose ($fp);
		mosRedirect( "index2.php?option=$option&task=config", $_MT_LANG->CONFIG_HAVE_BEEN_UPDATED );
	} else {
		mosRedirect( "index2.php?option=$option&task=config", $_MT_LANG->ERROR_UNABLE_TO_WRITE_CONFIG );
	}
}

?>