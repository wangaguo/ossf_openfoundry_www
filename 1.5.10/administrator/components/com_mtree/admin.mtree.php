<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if($task != 'upgrade') {
	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/config.mtree.class.php' );
		$mtconf = new mtConfig($database);
		require_once( $mainframe->getPath( 'admin_html' ) );
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/admin.mtree.class.php' );
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/tools.mtree.php' );
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mfields.class.php' );
		include_once( $mosConfig_absolute_path . '/components/com_mtree/language/'.$mtconf->get('language').'.php');
	
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		require_once(  JPATH_COMPONENT.DS.'config.mtree.class.php' );
		global $mtconf;
		$database =& JFactory::getDBO();
		$mtconf = new mtConfig($database);
		require_once( JPATH_COMPONENT.DS.'admin.mtree.html.php' );
		require_once( JPATH_COMPONENT.DS.'admin.mtree.class.php' );
		require_once( JPATH_COMPONENT.DS.'tools.mtree.php' );
		require_once( JPATH_COMPONENT.DS.'mfields.class.php' );
		require_once( JPATH_SITE.DS.'components'.DS.'com_mtree'.DS.'language'.DS.$mtconf->get('language').'.php');
		DEFINE( '_E_START_PUB', JText::_( 'Start Publishing' ) );
		DEFINE( '_E_FINISH_PUB', JText::_( 'Finish Publishing' ) );
	}
}

# Categories name cache
$cache_cat_names = array();

$id = intval(mosGetParam( $_REQUEST, 'id', 0 ));

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
if( empty($rev_id[0]) ) {
	$rev_id[0] = mosGetParam( $_REQUEST, 'rid', '' );
}

/* Custom Field ID */
$cf_id = mosGetParam( $_POST, 'cfid', array(0) );
if( empty($cf_id[0]) ) {
	$cf_id[0] = mosGetParam( $_REQUEST, 'cfid', '' );
}

$cat_parent = mosGetParam( $_POST, 'cat_parent', '' );
if ( $cat_parent == '' ) {
	$cat_parent = mosGetParam( $_REQUEST, 'cat_parent', 0 );
}

/* Hide menu */
$hide_menu = mosGetParam( $_REQUEST, 'hide', 0 );

/* Get Category ID for the Add Category/Listing links */
if ($task == 'newlink' || $task == 'newcat') {
	$parent_cat = mosGetParam( $_REQUEST, 'cat_parent', 0 );
} else {
	$parent_cat = mosGetParam( $_REQUEST, 'cat_id', 0 );
}

/* Start Left Navigation Menu */
if ( !$hide_menu && !in_array($task,array('upgrade','spy','ajax','downloadft', 'manageftattachments')) ) {
	// $mosConfig_debug = 0;
	HTML_mtree::print_startmenu( $task, $parent_cat );
}

switch ($task) {
	/***
	 * Ajax event
	 */
	 case 'ajax':
		 require_once($mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/admin.mtree.ajax.php');
		break;
	/***
	 * Spy
	 */
	 case 'spy':
		require_once($mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/spy.mtree.php');
		break;
	/***
	* Link Checker
	*/
	case 'linkchecker':
		require_once($mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/linkchecker.mtree.php');
		break;

	/***
	* Custom Fields
	*/
	case 'customfields':
	case "newcf":
	case "editcf":
	case "savecf":
	case "applycf":
	case 'cf_orderup':
	case 'cf_orderdown':
	case 'cancelcf':
	case 'cf_unpublish':
	case 'cf_publish':
	case 'removecf':
	case 'managefieldtypes':
	case 'newft':
	case 'editft':
	case 'saveft':
	case 'applyft':
	case 'cancelft':
	case 'downloadft':
	case 'uploadft':
	case 'removeft':
	case 'manageftattachments':
		require_once($mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/customfields.mtree.php');
		switch( $task ) {
			case "newcf":
				editcf( 0, $option );
				break;
			case "editcf":
				editcf( $cf_id[0], $option );
				break;
			case "applycf":
			case "savecf":
				savecf( $option );
				break;
			case 'cf_orderup':
				ordercf( intval( $cf_id[0] ), -1, $option );
				break;
			case 'cf_orderdown':
				ordercf( intval( $cf_id[0] ), 1, $option );
				break;
			case 'cancelcf':
				cancelcf( $option );
				break;
			case 'cf_unpublish':
				cf_publish( $cf_id, 0, $option );
				break;
			case 'cf_publish':
				cf_publish( $cf_id, 1, $option );
				break;
			case 'removecf':
				removecf( $cf_id, $option );
				break;	
			case 'customfields':
				customfields( $option );
				break;	
			case 'managefieldtypes':
				managefieldtypes( $option );
				break;
			case 'newft':
				editft( 0, $option );
				break;
			case 'editft':
				editft( $cf_id[0], $option );
				break;
			case 'applyft':
			case 'saveft':
				saveft( $id, $option );
				break;
			case 'cancelft':
				cancelft( $option );
				break;
			case 'downloadft':
				downloadft( $cf_id[0], $option );
				break;
			case 'uploadft':
				uploadft( $option );
				break;
			case 'removeft':
				removeft( $cf_id[0], $option );
				break;	
			case 'manageftattachments':
				manageftattachments($id, $option);
				break;				
		}
		break;

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
	/*
	case "editlink_browse_cat":
		editlink_browse_cat( $option, 0 );
		break;
	case "editlink_add_cat":
		editlink_browse_cat( $option, 1 );
		break;
	case "editlink_remove_cat":
		editlink_browse_cat( $option, -1 );
		*/
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

	case "listpending_reviewsreports":
		listpending_reviewsreports( $option );
		break;
	case "save_reviewsreports":
		save_reviewsreports( $option );
		break;

	case "listpending_reviewsreply":
		listpending_reviewsreply( $option );
		break;
	case "save_reviewsreply":
		save_reviewsreply( $option );
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
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mAdvancedSearch.class.php' );
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
		require_once( $mtconf->getjconf('absolute_path') .'/includes/domit/xml_domit_lite_include.php' );
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
		require_once( $mtconf->getjconf('absolute_path') .'/includes/domit/xml_domit_lite_include.php' );
		templates( $option );
		break;
	case "template_pages":
	require_once( $mtconf->getjconf('absolute_path') .'/includes/domit/xml_domit_lite_include.php' );
		template_pages( $option );
		break;
	case "edit_templatepage":
		edit_templatepage( $option );
		break;
	case "save_templatepage":
		mosCache::cleanCache( 'com_mtree' );
		save_templatepage( $option );
		break;
	case "cancel_edittemplatepage":
		cancel_edittemplatepage( $option );
		break;
	case "cancel_templatepages":
		cancel_templatepages( $option );
		break;
	case "new_template":
		new_template( $option );
		break;
	case "install_template":
		install_template( $option );
		break;
	case "default_template":
		default_template( $option );
		break;
	case "delete_template":
		delete_template( $option );
		break;
	case 'save_templateparams':
	case 'apply_templateparams':
		save_templateparam( $option );
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
		if(isset($mtconf)) {
			require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/upgrade.php' );
		} else {
			require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/upgrade.php' );
		}
		break;

	/***
	* Diagnosis
	*/
	case "diagnosis":
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/diagnosis.php' );
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
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/recount.mtree.php' );
		update_cats_and_links_count( 0, true, true );
		mosRedirect( "index2.php?option=$option&task=listcats&cat_id=0", $_MT_LANG->CAT_AND_LISTING_COUNT_UPDATED );
		break;

	/***
	* Recount
	*/
	case "fullrecount":
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/recount.mtree.php' );
		recount( 'full', $cat_id[0] );
		break;
	
	case "fastrecount":
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/recount.mtree.php' );
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
if ( !$hide_menu && !in_array($task,array('upgrade','spy','ajax','downloadft', 'manageftattachments')) ) {
	HTML_mtree::print_endmenu();
}


/***
* Link
*/

function editlink( $link_id, $cat_id, $for_approval=false, $option ) {
	global $database, $my, $mainframe, $_MT_LANG, $mtconf;
	
	$row = new mtLinks( $database );
	$row->load( $link_id );

	if ($row->link_id == 0) {
		$row->cat_id = $cat_id;
		$row->link_hits = 0;
		$row->link_visited = 0;
		$row->link_votes = 0;
		$row->link_rating = 0.00;
		$row->link_featured = 0;
		$row->link_created = date( 'Y-m-d H:i:s', time() + ( $mtconf->getjconf('offset') * 60 * 60 ) );
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
	
	# Load images
	$database->setQuery( "SELECT img_id, filename FROM #__mt_images WHERE link_id = '" . $row->link_id . "' ORDER BY ordering ASC" );
	$images = $database->loadObjectList();
	
	$lists = array();

	# Load all published CORE & custom fields
	$sql = "SELECT cf.*, cfv.link_id, cfv.value, cfv.attachment, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_cfvalues AS cfv ON cf.cf_id=cfv.cf_id AND cfv.link_id = " . $link_id
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.published='1' ORDER BY ordering ASC";
	$database->setQuery($sql);

	$fields = new mFields();
	$fields->setCoresValue( $row->link_name, $row->link_desc, $row->address, $row->city, $row->state, $row->country, $row->postcode, $row->telephone, $row->fax, $row->email, $row->website, $row->price, $row->link_hits, $row->link_votes, $row->link_rating, $row->link_featured, $row->link_created, $row->link_modified, $row->link_visited, $row->publish_up, $row->publish_down, $row->metakey, $row->metadesc, $row->user_id, $row->owner );
	$fields->loadFields($database->loadObjectList());
		
	# Template select list
	$templateDirs	= mosReadDirectory($mtconf->getjconf('absolute_path') . '/components/com_mtree/templates');
	$templates[] = mosHTML::makeOption( '', $_MT_LANG->DEFAULT );

	foreach($templateDirs as $templateDir) {
		if ( $templateDir <> "index.html") $templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}

	$lists['templates'] = mosHTML::selectList( $templates, 'link_template', 'class="inputbox" size="1"',
	'value', 'text', $row->link_template );

	# Get other categories
	$database->setQuery( "SELECT cl.cat_id FROM #__mt_cl AS cl WHERE cl.link_id = '$link_id' AND cl.main = '0'");
	$other_cats = $database->loadResultArray();

	# Get Pathway
	$pathWay = new mtPathWay( $cat_id );

	# Is this approval for modification?
	if ( $row->link_approved < 0 ) {
		$row->original_link_id = (-1 * $row->link_approved);
	} else {
		$row->original_link_id = '';
	}

	# Compile list of categories
	if ( $cat_id > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$cat_id'");
		$browse_cat_parent = $database->loadResult();
	}
	$categories = array();
	if ( $cat_id > 0 ) {
		$categories[] = mosHTML::makeOption( $browse_cat_parent, $_MT_LANG->ARROW_BACK );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	. "\nWHERE cat_parent = '". $cat_id ."' AND cat_approved = '1' AND cat_published = '1' ORDER BY cat_name ASC" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$lists['cat_id'] = mosHTML::selectList( $categories, 'new_cat_id', 'size="8" class="text_area" style="display:block;width:50%;margin-top:6px;" id="browsecat"',	'value', 'text', $row->getCatID() );
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		$lists['cat_id'] = mosHTML::selectList( $categories, 'new_cat_id', 'size="8" class="text_area" style="display:block;width:50%;margin-top:6px;"',	'value', 'text', $row->getCatID(), 'browsecat' );
	}

	# Yes/No select list for Approved Link
	$lists['link_approved'] = mosHTML::yesnoRadioList("link_approved", 'class="inputbox"', (($row->link_approved == 1) ? 1 : 0));

	# Yes/No select list for Featured Link
	$lists['link_featured'] = mosHTML::yesnoRadioList("link_featured", 'class="inputbox"', $row->link_featured);

	# Yes/No select list for "Published"
	$lists['link_published'] = mosHTML::yesnoRadioList("link_published", 'class="inputbox"', $row->link_published);

	# Get Return task - Used by listpending_links
	$returntask = mosGetParam( $_POST, 'returntask', '' );

	# Get params definitions
	$params =& new mosParameters( $row->attribs, $mtconf->getjconf('absolute_path') . "/administrator/components/$option/params/mtree.listing.xml" );

	if ( $row->link_approved <= 0 ) {
		$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_approved <= 0 ORDER BY link_created ASC, link_modified DESC" );
		$links = $database->loadResultArray();
		$number_of_prev = array_search($row->link_id,$links);
		$number_of_next = count($links) - 1 - $number_of_prev;
	} else {
		$number_of_prev = 0;
		$number_of_next = 0;
	}

	HTML_mtree::editlink( $row, $fields, $images, $cat_id, $other_cats, $lists, $number_of_prev, $number_of_next, $pathWay, $returntask, $params, $option );
}

function openurl( $option ) {
	global $database;

	$url = mosGetParam( $_REQUEST, 'url', '' );

	if ( substr($url, 0, 7) <> "http://" ) {
		$url = "http://".$url;
	}

	mosRedirect( $url );
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
	global $database, $my, $_MT_LANG, $mtconf;
	
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
	$other_cats = explode(',', mosGetParam( $_POST, 'other_cats', '' ));
	
	# Is this a new listing?
	$new_link = false;
	$old_image = '';

	// Yes, new listing
	if ($row->link_id == 0) {
		$new_link = true;
		$row->link_created =  date( 'Y-m-d H:i:s', time() + ( $mtconf->getjconf('offset') * 60 * 60 ) );

	// No, this listing has been saved to the database 
	// 1) Submission from visitor
	// 2) Modification request from listing owner
	} else {
		$row->link_modified = $row->getLinkModified( (empty($original_link_id)?$row->link_id:$original_link_id), $_POST );

		# Let's check if this link is on "pending approval" from an existing listing
		$database->setQuery( "SELECT link_approved FROM #__mt_links WHERE link_id = $row->link_id LIMIT 1" );
		$database->loadObject($thislink); // 1: approved; 0:unapproved/new listing; <-1: pending approval for update
		$link_approved = $thislink->link_approved;

		if ( $link_approved < 0 && $row->link_approved == 0 ) {
			$row->link_approved = $link_approved;
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
		}
	}

	# Update the Link Counts for all cat_parent(s)
	if ($new_link) {
		$row->updateLinkCount( 1 );
	} else {
		// Get old state (approved, published)
		$database->setQuery( "SELECT link_approved, link_published, cl.cat_id FROM (#__mt_links AS l, #__mt_cl AS cl) WHERE l.link_id = cl.link_id AND l.link_id ='".$row->link_id."' LIMIT 1" );
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
	
	# Erase Previous Records, make way for the new data
	$sql="DELETE FROM #__mt_cfvalues WHERE link_id='".$row->link_id."' AND attachment <= 0";
	$database->setQuery($sql);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	# Load field type
	$database->setQuery('SELECT cf_id, field_type FROM #__mt_customfields');
	$fieldtype = $database->loadObjectList('cf_id');
	
	if(count($fieldtype) > 0 ) {
		$load_ft = array();
		foreach( $fieldtype AS $ft ) {
			if(!in_array($ft->field_type,$load_ft)) {
				$load_ft[] = $ft->field_type;
			}
		}
		$database->setQuery('SELECT ft_class FROM #__mt_fieldtypes WHERE field_type IN (\'' . implode('\',\'',$load_ft) . '\')');
		$ft_classes = $database->loadResultArray();
		foreach( $ft_classes AS $ft_class ) {
			eval($ft_class);
		}
	}
	
	# Collect all active custom field's id
	$active_cfs = array();
	$additional_cfs = array();
	$core_params = array();
	foreach($_POST AS $k => $v) {
		$v = mosStripslashes($v);
		if ( substr($k,0,2) == "cf" && ( (!is_array($v) && (!empty($v) || $v == '0')) || (is_array($v) && !empty($v[0])) ) ) {
			if(strpos(substr($k,2),'_') === false && is_numeric(substr($k,2))) {
				// This custom field uses only one input. ie: cf17, cf23, cf2
				$active_cfs[substr($k,2)] = $v;
			} else {
				// This custom field uses more than one input. The date field is an example of cf that uses this. ie: cf13_0, cf13_1, cf13_2
				$ids = explode('_',substr($k,2));
				if(count($ids) == 2 && is_numeric($ids[0]) && is_numeric($ids[1]) ) {
					$additional_cfs[$ids[0]][$ids[1]] = $v;
				}
			}
		} elseif( substr($k,0,7) == 'keep_cf' ) {
			$cf_id = substr($k,7);
			$keep_att_ids[] = $cf_id;
			
	# Perform parseValue on Core Fields
		} elseif( substr($k,0,2) != "cf" && isset($row->{$k}) ) {
			if(strpos(strtolower($k),'link_') === false) {
				$core_field_type = 'core' . $k;
			} else {
				$core_field_type = 'core' . str_replace('link_','',$k);
			}
			$class = 'mFieldType_' . $core_field_type;
			
			if(class_exists($class)) {
				if(empty($core_params)) {
					$database->setQuery('SELECT field_type, params FROM #__mt_customfields WHERE iscore = 1 ');
					$core_params = $database->loadObjectList('field_type');
				}
				$mFieldTypeObject = new $class(array('params'=>$core_params[$core_field_type]->params));
				$v = call_user_func(array(&$mFieldTypeObject, 'parseValue'),$v);
				$row->{$k} = $v;
			}
		}
	}

	if (!$stored) {
		# Save core values to database
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

			}
		}

	}
	
	// $files_cfs is used to store attachment custom fields. 
	// This will be used in the next foreach loop to 
	// prevent it from storing it's value to #__mt_cfvalues 
	// table
	$file_cfs = array();
	
	// $file_values is used to store parsed data through 
	// mFieldType_* which will be done in the next foreach 
	// loop
	$file_values = array();
	
	foreach($_FILES AS $k => $v) {
		if ( substr($k,0,2) == "cf" && is_numeric(substr($k,2)) && $v['error'] == 0) {
			$active_cfs[substr($k,2)] = $v;
			$file_cfs[] = substr($k,2);
		}
	}

	if(count($active_cfs)>0) {
		$database->setQuery('SELECT cf_id, params FROM #__mt_customfields WHERE iscore = 0 AND cf_id IN (\'' . implode('\',\'',array_keys($active_cfs)). '\') LIMIT ' . count($active_cfs));
		$params = $database->loadObjectList('cf_id');
		
		foreach($active_cfs AS $cf_id => $v) {
			if(class_exists('mFieldType_'.$fieldtype[$cf_id]->field_type)) {
				$class = 'mFieldType_'.$fieldtype[$cf_id]->field_type;
			} else {
				$class = 'mFieldType';
			}
		
			# Perform parseValue on Custom Fields
			
			$mFieldTypeObject = new $class(array('id'=>$cf_id,'params'=>$params[$cf_id]->params));
			
			if(array_key_exists($cf_id,$additional_cfs) && count($additional_cfs[$cf_id]) > 0) {
				$arr_v = $additional_cfs[$cf_id];
				array_unshift($arr_v, $v);
				$v = &$mFieldTypeObject->parseValue($arr_v);
			} else {
				$v = &$mFieldTypeObject->parseValue($v);
			}
			
			if(in_array($cf_id,$file_cfs)) {
				$file_values[$cf_id] = $v;
			}
			
			if( (!empty($v) || $v == '0') && !in_array($cf_id,$file_cfs)) {
				# -- Now add the row
				$sql = "INSERT INTO #__mt_cfvalues (`cf_id`, `link_id`, `value`)"
					. "\nVALUES ('".$cf_id."', '".$row->link_id."', '".$database->getEscaped((is_array($v)) ? implode("|",$v) : $v)."')";
				$database->setQuery($sql);
				if (!$database->query()) {
					echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
					exit();
				}
			}
			unset($mFieldTypeObject);
		} // End of foreach
	}

	# Remove all attachment except those that are kept
	if(isset($keep_att_ids) && count($keep_att_ids)>0) {
		$database->setQuery('DELETE FROM #__mt_cfvalues_att WHERE link_id = \'' . $row->link_id . '\' AND cf_id NOT IN (\'' . implode('\',\'',$keep_att_ids) . '\')' );
		$database->query();
		$database->setQuery('DELETE FROM #__mt_cfvalues WHERE link_id = \'' . $row->link_id . '\' AND cf_id NOT IN (\'' . implode('\',\'',$keep_att_ids) . '\') AND attachment > 0' );
		$database->query();
	} else {
		$database->setQuery('DELETE FROM #__mt_cfvalues_att WHERE link_id = \'' . $row->link_id . '\'' );
		$database->query();
		$database->setQuery('DELETE FROM #__mt_cfvalues WHERE link_id = \'' . $row->link_id . '\' AND attachment > 0' );
		$database->query();
	}
	
	$database->setQuery('SET GLOBAL max_allowed_packet =10485760');
	$database->query();
	
	foreach($_FILES AS $k => $v) {
		if ( substr($k,0,2) == "cf" && is_numeric(substr($k,2)) && $v['error'] == 0) {
			$cf_id = substr($k,2);
			
			if(array_key_exists($cf_id,$file_values)) {
				$file = $file_values[$cf_id];
				if(!empty($file['data'])) {
					$data = $file['data'];
				} else {
					$data = fread(fopen($v['tmp_name'], "r"), $v['size']);
				}
			} else {
				$file = $v;
				$data = fread(fopen($v['tmp_name'], "r"), $v['size']);
			}

			$database->setQuery('DELETE FROM #__mt_cfvalues_att WHERE link_id = \'' . $row->link_id . '\' AND cf_id =\'' . $cf_id . '\'');
			$database->query();
		
			$database->setQuery('DELETE FROM #__mt_cfvalues WHERE cf_id = \'' . $cf_id  . '\' AND link_id = \'' . $row->link_id . '\' AND attachment > 0' );
			$database->query();

			$database->setQuery( "INSERT INTO #__mt_cfvalues_att (link_id, cf_id, filename, filedata, filesize, extension) "
				.	"\n VALUES("
				.	"'" . $row->link_id . "', "
				.	"'" . $cf_id . "', "
				.	"'" . $file['name'] . "', "
				.	"'" . addslashes($data) . "', "
				.	"'" . $file['size'] . "', "
				.	"'" . $file['type'] . "')"
				);
			if($database->query() !== false) {
				$sql = "INSERT INTO #__mt_cfvalues (`cf_id`, `link_id`, `value`, `attachment`)"
					. "\nVALUES ('".$cf_id."', '".$row->link_id."', '".$database->getEscaped($file['name'])."','1')";
				$database->setQuery($sql);
				$database->query();
			}
		} 
	}

	# Remove all images except those that are kept
	$msg = '';
	if(is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_small_image')) && is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_medium_image')) && is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_original_image'))) {
		$keep_img_ids = mosGetParam( $_POST, 'keep_img', null );
		$image_filenames = array();
		if(isset($keep_img_ids) && count($keep_img_ids)>0) {
			$database->setQuery('SELECT filename FROM #__mt_images WHERE link_id = \'' . $row->link_id . '\' AND img_id NOT IN (\'' . implode('\',\'',$keep_img_ids) . '\')' );
			$image_filenames = $database->loadResultArray();
			$database->setQuery('DELETE FROM #__mt_images WHERE link_id = \'' . $row->link_id . '\' AND img_id NOT IN (\'' . implode('\',\'',$keep_img_ids) . '\')' );
			$database->query();
		} else {
			$database->setQuery('SELECT filename FROM #__mt_images WHERE link_id = \'' . $row->link_id . '\'' );
			$image_filenames = $database->loadResultArray();
			$database->setQuery('DELETE FROM #__mt_images WHERE link_id = \'' . $row->link_id . '\'' );
			$database->query();
		}
		if( count($image_filenames) ) {
			foreach($image_filenames AS $image_filename) {
				unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $image_filename);
				unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $image_filename);
				unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $image_filename);
			}
		}
	}

	$images = new mtImages( $database );
	if( isset($_FILES['image']) ) {
		if( !is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_small_image')) || !is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_medium_image')) ||  !is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_original_image')) ) {
			$msg = $_MT_LANG->IMAGE_DIRECTORIES_NOT_WRITABLE;
		} else {
			for($i=0;$i<count($_FILES['image']['name']);$i++) {
				if ( !empty($_FILES['image']['name'][$i]) && $_FILES['image']['error'][$i] == 0 &&  $_FILES['image']['size'][$i] > 0 ) {
					$file_extension = pathinfo($_FILES['image']['name'][$i]);
					$file_extension = strtolower($file_extension['extension']);

					$mtImage = new mtImage();
					$mtImage->setMethod( $mtconf->get('resize_method') );
					$mtImage->setQuality( $mtconf->get('resize_quality') );
					$mtImage->setSize( $mtconf->get('resize_listing_size') );
					$mtImage->setTmpFile( $_FILES['image']['tmp_name'][$i] );
					$mtImage->setType( $_FILES['image']['type'][$i] );
					$mtImage->setName( $_FILES['image']['name'][$i] );
					$mtImage->setSquare( $mtconf->get('squared_thumbnail') );
					$mtImage->resize();
					$mtImage->setDirectory( $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') );
					$mtImage->saveToDirectory();
				
					$mtImage->setSize( $mtconf->get('resize_medium_listing_size') );
					$mtImage->setSquare(false);
					$mtImage->resize();
					$mtImage->setDirectory( $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') );
					$mtImage->saveToDirectory();
					move_uploaded_file($_FILES['image']['tmp_name'][$i],$mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $_FILES['image']['name'][$i]);

					$database->setQuery( "INSERT INTO #__mt_images (link_id, filename, ordering) "
						.	"\n VALUES('" . $row->link_id . "', '".$_FILES['image']['name'][$i]."', '9999')");
					$database->query();
					$img_id = $database->insertid();
					rename($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $_FILES['image']['name'][$i], $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $img_id . '.' . $file_extension);
					rename($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $_FILES['image']['name'][$i], $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $img_id . '.' . $file_extension);
					rename($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $_FILES['image']['name'][$i], $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $img_id . '.' . $file_extension);
					$database->setQuery("UPDATE #__mt_images SET filename = '" . $img_id . '.' . $file_extension . "' WHERE img_id = '" . $img_id . "'");
					$database->query();
				}
			}
		}
	}
	
	$img_sort_hash = mosGetParam( $_POST, 'img_sort_hash', null );
	if(!empty($img_sort_hash)) {
		$arr_img_sort_hashes = split("[&]*upload_att\[\]=img_\d*", $img_sort_hash);
		$i=1;
		foreach($arr_img_sort_hashes AS $arr_img_sort_hash) {
			if(!empty($arr_img_sort_hash) && $arr_img_sort_hash > 0) {
				$database->setQuery( "UPDATE #__mt_images SET ordering = '" . $i . "' WHERE img_id = '" . $arr_img_sort_hash. "' LIMIT 1" );
				$database->query();
				$i++;
			}
		}
	}
	$images->updateOrder('link_id='.$row->link_id);
	
	# Update "Also appear in these categories" aka other categories
	$mtCL = new mtCL_main0( $database );
	$mtCL->load( $row->link_id );
	$mtCL->update( $other_cats );
	
	$returntask = mosGetParam( $_POST, 'returntask', '' );

// /*
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask", $msg );
	} else {

		$task = mosGetParam( $_POST, 'task', '' );

		if ( $task == "applylink" ) {
			mosRedirect( "index2.php?option=$option&task=editlink&link_id=$row->link_id", $msg );
		} else {
			mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$cat_id", $msg );
		}
	}
// */
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
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' ORDER BY cat_name ASC");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), '&lt;--Back' );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$catList = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" id="browsecat" style="width:30%"', 'value', 'text', null );
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		$catList = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" style="width:30%"', 'value', 'text', null, 'browsecat' );
	}

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
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' ORDER BY cat_name ASC");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), $_MT_LANG->ARROW_BACK );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	# Main Category list
	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$lists['cat_id'] = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" id="browsecat" style="width:30%"', 'value', 'text', null );
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		$lists['cat_id'] = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" style="width:30%"', 'value', 'text', null, 'browsecat' );
	}

	# Copy Reviews?
	$copy_reviews = mosGetParam( $_POST, 'copy_reviews', 0 );
	$lists['copy_reviews'] = mosHTML::yesnoRadioList("copy_reviews", 'class="inputbox"', $copy_reviews);

	# Copy Secondary Categories?
	$copy_secondary_cats = mosGetParam( $_POST, 'copy_secondary_cats', 0 );
	$lists['copy_secondary_cats'] = mosHTML::yesnoRadioList("copy_secondary_cats", 'class="inputbox"', $copy_secondary_cats);
	
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
	$copy_secondary_cats = intval( mosGetParam( $_POST, 'copy_secondary_cats', 0 ) );
	$reset_hits = intval( mosGetParam( $_POST, 'reset_hits', 1 ) );
	$reset_rating = intval( mosGetParam( $_POST, 'reset_rating', 1 ) );

	$row = new mtLinks( $database );

	if ( count( $link_id ) > 0 ) {
		foreach( $link_id AS $id ) {
			$row->copyLink( $id, $new_cat_parent, $reset_hits, $reset_rating, $copy_reviews, $copy_secondary_cats);
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
	global $database, $mainframe, $mtconf;

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
	$sql = "SELECT cat.* FROM #__mt_cats AS cat"
		. "\nWHERE cat_parent = '".$cat_id."' AND cat_approved = '1'"
		. "\nORDER BY " . $mtconf->get('first_cat_order1') . ' ' . $mtconf->get('first_cat_order2') . ', ' . $mtconf->get('second_cat_order1') . ' ' . $mtconf->get('second_cat_order2');
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
		."\nORDER BY " . $mtconf->get('first_listing_order1') . ' ' . $mtconf->get('first_listing_order2') . ', ' . $mtconf->get('second_listing_order1') . ' ' . $mtconf->get('second_listing_order2')
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
	global $database, $_MT_LANG, $mtconf;

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
		$row->cat_image = '';
	} else {
		$cat_parent = $row->cat_parent;
	}

	$lists = array();

	# Find image if the category has one
	// if($row->cat_id > 0) {
	// 	$database->setQuery('SELECT filename FROM #__mt_cats_images WHERE cat_id = \'' . $row->cat_id . '\' LIMIT 1');
	// 	$cat_image = $database->loadResult();
	// } else {
	// 	$cat_image = '';
	// }
	
	# Template select list
	// Decide if parent has a custom template assigned to it. If there is, select this template
	// by default.
	if ( $cat_parent > 0 && $cat_id == 0 ) {
		$database->setQuery( "SELECT cat_template FROM #__mt_cats WHERE cat_id = '".$cat_parent."' LIMIT 1" );
		$parent_template = $database->loadResult();
	}
	$templateDirs	= mosReadDirectory($mtconf->getjconf('absolute_path') . '/components/com_mtree/templates');
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
	// if ( $browse_cat > 0 ) {
	if ( $cat_id > 0 ) {
		$categories[] = mosHTML::makeOption( $row->cat_parent, '&lt;--Back' );
	}
	$database->setQuery( "SELECT cat_id AS value, cat_name AS text FROM #__mt_cats"
	// . "\nWHERE cat_parent='". $row->getParent($cat_parent) ."' ORDER BY cat_name ASC" );
	. "\nWHERE cat_parent='". $cat_id ."' ORDER BY cat_name ASC" );
	$categories = array_merge( $categories, $database->loadObjectList() );

	# new_related_cat
	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$lists['new_related_cat'] = mosHTML::selectList( $categories, 'new_related_cat', 'size="8" class="text_area" style="display:block;width:50%;margin-top:6px;" id="browsecat"', 'value', 'text', ( ($row->cat_id == 0) ? $cat_parent : $row->cat_id ) );
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		$lists['new_related_cat'] = mosHTML::selectList( $categories, 'new_related_cat', 'size="8" class="text_area" style="display:block;width:50%;margin-top:6px;"', 'value', 'text', ( ($row->cat_id == 0) ? $cat_parent : $row->cat_id ), 'browsecat' );
	}

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

function savecat( $option ) {
	global $database, $my, $_MT_LANG, $mtconf;

	$template_all_subcats = mosGetParam( $_POST, 'template_all_subcats', '' );
	$related_cats = explode(',', mosGetParam( $_POST, 'other_cats', '' ));
	$remove_image = mosGetParam( $_REQUEST, 'remove_image', 0 );
	$cat_image = mosGetParam( $_FILES, 'cat_image', null );
	
	if ( $related_cats[0] == '' ) {
		$related_cats = array();
	}

	if ( $GLOBALS['_VERSION']->RELEASE == '1.5' && get_magic_quotes_gpc()) {
		$_POST['cat_desc'] = stripslashes($_POST['cat_desc']);
		$_POST['cat_name'] = stripslashes($_POST['cat_name']);
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
	$msg = '';
	if ( $remove_image || ($old_image <> '' && array_key_exists('tmp_name',$cat_image) && !empty($cat_image['tmp_name'])) ) {
		$row->cat_image = '';

		if(file_exists($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_cat_original_image') . $old_image) && file_exists($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_cat_small_image') . $old_image) && is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_cat_small_image')) && is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_cat_original_image'))) {
			if(!unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_cat_original_image') . $old_image) || !unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_cat_small_image') . $old_image)) {
				$msg .= $_MT_LANG->ERROR_DELETING_OLD_IMAGE;
			}
		}
	}
	

	# Create Thumbnail
	if ( $cat_image['name'] <> '' ) {
		if(!is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_cat_small_image')) || !is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_cat_original_image'))) {
			$msg .= $_MT_LANG->IMAGE_DIRECTORIES_NOT_WRITABLE;
		} else {
			$mtImage = new mtImage();
			$mtImage->setDirectory( $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_cat_small_image') );
			$mtImage->setMethod( $mtconf->get('resize_method') );
			$mtImage->setQuality( $mtconf->get('resize_quality') );
			$mtImage->setSize( $mtconf->get('resize_cat_size') );
			$mtImage->setTmpFile( $cat_image['tmp_name'] );
			$mtImage->setType( $cat_image['type'] );
			if($row->cat_id > 0) {
				$mtImage->setName( $row->cat_id . '_' . $cat_image['name'] );
				$row->cat_image = $row->cat_id . '_' . $cat_image['name'];
			} else {
				$mtImage->setName( $cat_image['name'] );
				$row->cat_image = $cat_image['name'];
			}
			$mtImage->setSquare(false);
			$mtImage->resize();
			$mtImage->saveToDirectory();
			move_uploaded_file($cat_image['tmp_name'],$mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_cat_original_image') . $row->cat_image);
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
			if ( $new_cat && $cat_image['name'] <> '' ) {

				// Get last inserted listing ID
				$mysql_last_insert_id = mysql_insert_id();

				if ( $mysql_last_insert_id > 0 ) {

					if ( rename( $mtconf->getjconf('absolute_path').$mtconf->get('cat_image_dir').$cat_image['name'], $mtconf->getjconf('absolute_path').$mtconf->get('cat_image_dir').$mysql_last_insert_id."_".$cat_image['name'] ) ) {
						
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
	
	// /*
	if ( $returntask <> '' ) {
		mosRedirect( "index2.php?option=$option&task=$returntask", $msg );
	} else {
		$task = mosGetParam( $_POST, 'task', '' );

		if ( $task == "applycat" ) {
			mosRedirect( "index2.php?option=$option&task=editcat&cat_id=$row->cat_id", $msg );
		} else {
			mosRedirect( "index2.php?option=$option&task=listcats&cat_id=$row->cat_parent", $msg );
		}
	}
	// */
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
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' AND cat_id NOT IN ($cat_ids) ORDER BY cat_name ASC");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), '&lt;--Back' );
		array_unshift( $rows, $cat_back );
	}
	
	$cats = $rows;

	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$catList = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" id="browsecat" style="width:30%"', 'value', 'text', null );
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		$catList = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" style="width:30%"', 'value', 'text', null, 'browsecat' );
	}

	HTML_mtree::move_cats( $cat_id, $cat_parent, $catList, $pathWay, $option );

}

function moveCats2( $cat_id, $option ) {
	global $database;

	$new_cat_parent_id = mosGetParam( $_POST, 'new_cat_parent', '' );
	
	if( $new_cat_parent_id == 0 ) {
		$database->setQuery( "SELECT cat_id, lft, rgt FROM #__mt_cats WHERE cat_parent = -1" );
		$database->loadObject($new_cat_parent);
	} else {
		$database->setQuery( "SELECT cat_id, lft, rgt FROM #__mt_cats WHERE cat_id = $new_cat_parent_id" );
		$database->loadObject($new_cat_parent);
	}
	
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
			$old_cat_parent = $row->cat_parent;
			if( $new_cat_parent_id == 0 ) {
				$row->cat_parent = 0;
			} else {
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
	$database->setQuery("SELECT cat_id AS value, cat_name AS text FROM #__mt_cats WHERE cat_parent = '".$cat_parent."' AND cat_id NOT IN ($cat_ids) ORDER BY cat_name ASC");
	$rows = $database->loadObjectList();

	# Get Parent's parent
	if ( $cat_parent > 0 ) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '".$cat_parent."'");
		$cat_back = mosHTML::makeOption( $database->loadResult(), $_MT_LANG->ARROW_BACK );
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
	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$lists['cat_id'] = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" id="browsecat" style="width:30%"', 'value', 'text', null );
	} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
		$lists['cat_id'] = mosHTML::selectList( $cats, 'cat_parent', 'class="text_area" size="8" style="width:30%"', 'value', 'text', null, 'browsecat' );
	}
	
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

	if (!is_array( $link_id ) || count( $link_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->SELECT_AN_ITEM_TO_APPROVE."'); window.history.go(-1);</script>\n";
		exit;
	}
	
	var_dump( $link_id );

	if (count( $link_id )) {
		foreach( $link_id AS $lid ) {

			$mtLinks = new mtLinks( $database );
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
			unset($mtLinks);
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
	/*
	$sql = "SELECT cat.*, cimg.filename AS cat_image FROM #__mt_cats AS cat"
		. "\nLEFT JOIN #__mt_cats_images AS cimg ON cimg.cat_id = cat.cat_id"
	
	*/
	$sql = "SELECT cat.* FROM #__mt_cats AS cat"
		. "\nWHERE cat.cat_approved <> '1'"
		. "\nORDER BY cat.cat_created DESC"
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
	$sql = "SELECT r.*, u.username AS username, u.email AS email, l.link_name, log.value FROM #__mt_reviews AS r"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nLEFT JOIN #__mt_log AS log ON log.link_id = r.link_id AND log.user_id = r.user_id AND log.log_type = 'vote' AND log.rev_id = r.rev_id"
		.	"\nWHERE r.rev_approved <> '1'"
		.	"\nORDER BY r.rev_date DESC";

	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$reviews = $database->loadObjectList();

	HTML_mtree::listpending_reviews( $reviews, $pathWay, $pageNav, $option );
}

function save_pending_reviews( $option ) {
	global $database, $mtconf, $_MT_LANG;

	$mtReviews = new mtReviews( $database );

	$reviews = mosGetParam( $_POST, 'rev', '' );
	$review_titles = mosGetParam( $_POST, 'rev_title', '' );
	$review_texts = mosGetParam( $_POST, 'rev_text', '' );
	$admin_notes = mosGetParam( $_POST, 'admin_note', '' );
	$email_message = mosGetParam( $_POST, 'emailmsg', '' );
	$send_email = mosGetParam( $_POST, 'sendemail', '' );

	foreach( $reviews AS $review_id => $action ) {
		
		switch($action){
			// 1: Approve; 0: Ignore
			case '0';
			case '1';
				$database->setQuery( "UPDATE #__mt_reviews SET rev_title = '".$review_titles[$review_id]."', rev_text = '".$review_texts[$review_id]."' WHERE rev_id = '".$review_id."'" );
				$database->query();

				if($action == 1) {
					$mtReviews->load( $review_id );
					$mtReviews->approveReview( 1 );
				} else if ($action == 0 ) {
					if(@isset($admin_notes) && @array_key_exists($review_id,$admin_notes)) {
						$database->setQuery( "UPDATE #__mt_reviews SET admin_note = '".$admin_notes[$review_id]."' WHERE rev_id = '".$review_id."'" );
						$database->query();
					}
					if(@isset($send_email) && @array_key_exists($review_id,$send_email) && $send_email[$review_id] == 1) {
						$database->setQuery( "UPDATE #__mt_reviews SET send_email = '1', email_message = '".$email_message[$review_id]."' WHERE rev_id = '".$review_id."' LIMIT 1" );
						$database->query();
					} else {
						$database->setQuery( "UPDATE #__mt_reviews SET send_email = '0', email_message = '' WHERE rev_id = '".$review_id."' LIMIT 1" );
						$database->query();
					}
				}
				break;
			// -1: Reject; -2: Reject and remove vote
			case '-1':
			case '-2':
				if($action==-2){
					$database->setQuery( 'SELECT link_id, user_id FROM #__mt_reviews WHERE rev_id = '.$review_id.' LIMIT 1' );
					$database->loadObject($rev);
					
					$database->setQuery( 'SELECT * FROM #__mt_links WHERE link_id = '.$rev->link_id.' LIMIT 1' );
					$database->loadObject($link);
					
					$database->setQuery( 'SELECT value FROM #__mt_log WHERE log_type = \'vote\' AND user_id = \''.$rev->user_id.'\' AND link_id = \''.$rev->link_id.'\' LIMIT 1' );
					$user_rating = $database->loadResult();
					
					if($link->link_votes == 1){
						$new_rating = 0;
					} elseif($link->link_rating > 0 && $link->link_votes > 0 && $user_rating > 0) {
						$new_rating = (($link->link_rating * $link->link_votes) - $user_rating) / ($link->link_votes -1);
					}
					$database->setQuery( "UPDATE #__mt_links SET link_rating = '$new_rating', link_votes = '".($link->link_votes -1)."' WHERE link_id = '$link->link_id' ");
					$database->query();
					unset($link);
					$database->setQuery( "DELETE FROM #__mt_log WHERE log_type = 'vote' AND rev_id = '".$review_id."' AND user_id = '" . $rev->user_id . "' LIMIT 1" );
					$database->query();
				}
				$database->setQuery( "DELETE FROM #__mt_reviews WHERE rev_id = '".$review_id."' LIMIT 1" );
				$database->query();
				$database->setQuery( "DELETE FROM #__mt_log WHERE log_type = 'review' AND rev_id = '".$review_id."' AND user_id = '" . $rev->user_id . "' LIMIT 1" );
				$database->query();
				break;		
		}
		
		if($action <> 0 && !empty($email_message[$review_id])) {
			$subject = sprintf($_MT_LANG->REJECTED_APPROVED_REVIEW_SUBJECT,$review_titles[$review_id]);
			// $body = sprintf($_MT_LANG->CLAIM_APPROVED_MSG, $link->link_name, $mtconf->getjconf('live_site')."/index.php?option=com_mtree&task=viewlink&link_id=$link->link_id" );
			
			$database->setQuery( 'SELECT email FROM (#__mt_reviews AS r, #__users AS u) WHERE r.rev_id = '.$review_id.' AND r.user_id = u.id LIMIT 1' );
			$to_email = $database->loadResult();
			
			$from_name = $mtconf->get('predefined_reply_from_name');
			if(empty($from_name)) {
				$from_name = $mtconf->getjconf('fromname');
			}
			$from_email = $mtconf->get('predefined_reply_from_email');
			if(empty($from_email)) {
				$from_email = $mtconf->getjconf('mailfrom');
			}
			$bcc = $mtconf->get('predefined_reply_bcc');
			if(empty($bcc)) {
				$bcc = NULL;
			}			
			mosMail( $from_email, $from_name, $to_email, $subject, $email_message[$review_id], 0, NULL, $bcc );
		}
		
	}
	mosRedirect( "index2.php?option=$option&task=listpending_reviews" );

}

function listpending_reports( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	$database->setQuery("SELECT COUNT(*) FROM #__mt_reports WHERE rev_id = 0 && link_id > 0");
	$total = $database->loadResult();

	# Get all pending reports
	$sql = "SELECT r.*, u.username AS username, u.email AS email, l.link_name FROM #__mt_reports AS r"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nWHERE r.rev_id = 0 && r.link_id > 0"
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

function listpending_reviewsreports( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	$database->setQuery("SELECT COUNT(*) FROM #__mt_reports WHERE rev_id > 0 && link_id > 0");
	$total = $database->loadResult();

	# Get all pending reports
	$sql = "SELECT r.*, rev.rev_title, rev.rev_text, u2.username AS review_username, u2.id AS review_user_id, rev.rev_date, u.username AS username, u.email AS email, l.link_name FROM #__mt_reports AS r"
		.	"\nLEFT JOIN #__mt_reviews AS rev ON rev.rev_id = r.rev_id"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"		// The person that made the report
		.	"\nLEFT JOIN #__users AS u2 ON u2.id = rev.user_id"	// The reviewer
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nWHERE r.rev_id > 0 && r.link_id > 0"
		.	"\nORDER BY r.created DESC";

	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$reports = $database->loadObjectList();

	HTML_mtree::listpending_reviewsreports( $reports, $pathWay, $option );
}

function save_reviewsreports( $option ) {
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

	mosRedirect( "index2.php?option=$option&task=listpending_reviewsreports" );

}

function listpending_reviewsreply( $option ) {
	global $database, $mainframe;

	# Get Pathway
	$pathWay = new mtPathWay();

	# Get all pending owner's reply
	$sql = "SELECT r.*, u.username AS username, owner.username AS owner_username, owner.id AS owner_user_id, owner.email AS owner_email, u.email AS email, l.link_name FROM #__mt_reviews AS r"
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
		.	"\nLEFT JOIN #__users AS owner ON owner.id = l.user_id"
		.	"\nWHERE r.ownersreply_approved = '0' AND r.ownersreply_text != ''"
		.	"\nORDER BY r.ownersreply_date DESC";

	$database->setQuery($sql);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$reviewreplies = $database->loadObjectList();
	HTML_mtree::listpending_reviewsreply( $reviewreplies, $pathWay, $option );
}

function save_reviewsreply( $option ) {
	global $database;

	$ownersreplies = mosGetParam( $_POST, 'or', '' );
	$or_text = mosGetParam( $_POST, 'or_text', '' );
	$admin_notes = mosGetParam( $_POST, 'admin_note', '' );

	foreach( $ownersreplies AS $rev_id => $action ) {
		
		// 1: Approve; 0: Ignore; -1: Reject
		if ( $action == 1 || $action == 0 ) {

			$database->setQuery( "UPDATE #__mt_reviews SET ownersreply_text = '".$or_text[$rev_id]."' WHERE rev_id = '".$rev_id."'" );
			$database->query();

			if($action == 1) {
				$database->setQuery( "UPDATE #__mt_reviews SET ownersreply_approved = '1' WHERE rev_id = '".$rev_id."'" );
				$database->query();
			} else if ($action == 0 && @isset($admin_notes) && @array_key_exists($rev_id,$admin_notes) ) {
				$database->setQuery( "UPDATE #__mt_reviews SET ownersreply_admin_note = '".$admin_notes[$rev_id]."' WHERE rev_id = '".$rev_id."'" );
				$database->query();
			}

		} else {
			//$database->setQuery( "DELETE FROM #__mt_reviewreply WHERE rev_id = '".$rev_id."'" );
			$database->setQuery( "UPDATE #__mt_reviews SET ownersreply_text = '', ownersreply_approved = '0', ownersreply_date = '', ownersreply_admin_note = '' WHERE rev_id = '".$rev_id."'" );
			$database->query();
		}

	}

	mosRedirect( "index2.php?option=$option&task=listpending_reviewsreply" );

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
	global $database, $mtconf, $_MT_LANG;

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
			$body = sprintf($_MT_LANG->CLAIM_APPROVED_MSG, $link->link_name, $mtconf->getjconf('live_site')."/index.php?option=com_mtree&task=viewlink&link_id=$link->link_id" );

			mosMail( $mtconf->getjconf('mailfrom'), $mtconf->getjconf('fromname'), $email, $subject, $body );

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
		$row->not_registered = 0;
	} else {
		if ($row->user_id > 0) {
			$database->setQuery("SELECT username FROM #__users WHERE id ='".$row->user_id."'");
			$row->owner = $database->loadResult();
			$row->not_registered = 0;
		} else {
			$row->not_registered = 1;
		}
	}

	# Yes/No select list
	$lists['rev_approved'] = mosHTML::yesnoRadioList("rev_approved", 'class="inputbox"', (($row->rev_approved == 1) ? 1 : 0));
	$lists['ownersreply_approved'] = mosHTML::yesnoRadioList("ownersreply_approved", 'class="inputbox"', (($row->ownersreply_approved == 1) ? 1 : 0));

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
		$database->setQuery( "DELETE FROM #__mt_reviews WHERE rev_id IN ($rev_ids) LIMIT ".count( $rev_id ) );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}

		# Remove logs
		$database->setQuery( "DELETE FROM #__mt_log WHERE log_type = 'review' AND rev_id IN ($rev_ids) LIMIT ".count( $rev_id ) );
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

/***
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
	global $database, $_MT_LANG, $mtconf;

	# Template select list
	$templateDirs	= mosReadDirectory($mtconf->getjconf('absolute_path') . '/components/com_mtree/templates');
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

	# Load all CORE and custom fields
	$database->setQuery( "SELECT cf.*, '0' AS link_id, '' AS value, '0' AS attachment, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.published='1' ORDER BY ordering ASC" );
	$fields = new mFields($database->loadObjectList());

	# Search condition
	$searchConditions[] = mosHTML::makeOption( 1, strtolower($_MT_LANG->ANY) );
	$searchConditions[] = mosHTML::makeOption( 2, strtolower($_MT_LANG->ALL) );
	$lists['searchcondition'] = mosHTML::selectList( $searchConditions, 'searchcondition', 'class="inputbox" size="1"',
	'value', 'text', 1 );

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

	HTML_mtree::advsearch( $fields, $lists, $option );
}

function advsearch2( $option ) {
	global $database, $mtconf, $_MT_LANG;

	$search_where = mosGetParam( $_POST, 'search_where', '' ); // 1: Listing, 2: Category
	$limit = mosGetParam( $_POST, 'limit', 15 ); // 1: Listing, 2: Category
	$limitstart = mosGetParam( $_POST, 'limitstart', 0 ); // 1: Listing, 2: Category
	$owner =	mosGetParam( $_POST, 'owner', '' );

	$searchParams = array();
	
	# Load all published CORE & custom fields
	$database->setQuery( "SELECT cf.*, '0' AS link_id, '' AS value, '0' AS attachment, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.published='1' ORDER BY ordering ASC" );
	// $database->setQuery( "SELECT cf.*, '' AS value FROM #__mt_customfields AS cf "
	// 	.	"\nORDER BY ordering ASC" );
	$fields = new mFields($database->loadObjectList());

	// while( $fields->hasNext() ) {
	// 	$field = $fields->getField();
	// 	$searchFields = $field->getSearchFields();
	// 	foreach( $searchFields AS $searchField ) {
	// 		$searchParams[$searchField] = mosGetParam( $_POST, $searchField, '' );
	// 	}
	// 	$fields->next();
	// }
	$searchParams = $fields->loadSearchParams($_POST);
	
	foreach( array('publishing','link_template','link_rating','opt_rating','link_votes','opt_votes','link_hits','opt_hits','reviews','opt_reviews','internal_notes','metakey','metadesc', 'opt_price', 'price') AS $otherField ) {
		$searchParams[$otherField] = mosGetParam( $_POST, $otherField, '' );
	}

	# Search query
	if ( $search_where == 1 ) {
		
		$where = array();
		$having = '';
		$advsearch = new mAdvancedSearch( $database );

		if( intval(mosGetParam( $_POST, 'searchcondition', 1 )) == '2' ) {
			$advsearch->useAndOperator();
		} else {
			$advsearch->useOrOperator();
		}

		$fields->resetPointer();
		while( $fields->hasNext() ) {
			$field = $fields->getField();
			$searchFields = $field->getSearchFields();
			
			if( array_key_exists(0,$searchFields) && isset($searchParams[$searchFields[0]]) && !empty($searchParams[$searchFields[0]]) ) {
				foreach( $searchFields AS $searchField ) {
					$searchFieldValues[] = $searchParams[$searchField];
				}
				if( count($searchFieldValues) > 0 && !empty($searchFieldValues[0]) ) {
					if( is_array($searchFieldValues[0]) && empty($searchFieldValues[0][0]) ) {
						// Do nothing
					} else {
						$tmp_where_cond = call_user_func_array(array($field, 'getWhereCondition'),$searchFieldValues);
						if( !is_null($tmp_where_cond) ) {
							$advsearch->addCondition( $field, $searchFieldValues );
						} 
					}
				}
				unset($searchFieldValues);
			}
			$fields->next();
		}

		if(!empty($searchParams['link_template'])) $where[] = 'link_template LIKE \'%' . $searchParams['link_template'] . '\'';
		if(!empty($searchParams['internal_notes'])) $where[] = 'internal_notes LIKE \'%' . $searchParams['internal_notes'] . '\'';
		if(!empty($searchParams['metadesc'])) $where[] = 'metadesc LIKE \'%' . $searchParams['metadesc'] . '\'';
		if(!empty($searchParams['metakey'])) $where[] = 'metakey LIKE \'%' . $searchParams['metakey'] . '\'';

		// link_template
		if ( !empty($searchParams['link_template']) ) {
			$advsearch->addRawCondition( "link_template = '" . $searchParams['link_template'] . "'" );
		}

		// rating
		if ( is_numeric($searchParams['link_rating']) && $searchParams['link_rating'] >= 0 && $searchParams['link_rating'] <= 5 ) {
			switch($searchParams['opt_rating']) {
				case 1:
					$advsearch->addRawCondition( "link_rating = '" . $searchParams['link_rating'] . "'" );
					break;
				case 2:
					$advsearch->addRawCondition( "link_rating > '" . $searchParams['link_rating'] . "'" );
					break;
				case 3:
					$advsearch->addRawCondition( "link_rating < '" . $searchParams['link_rating'] . "'" );
					break;
			}
		}
		
		// votes
		if ( is_numeric($searchParams['link_votes']) && $searchParams['link_votes'] >= 0 ) {
			switch($searchParams['opt_votes']) {
				case 1:
					$advsearch->addRawCondition( "link_votes = '" . $searchParams['link_votes'] . "'" );
					break;
				case 2:
					$advsearch->addRawCondition( "link_votes > '" . $searchParams['link_votes'] . "'" );
					break;
				case 3:
					$advsearch->addRawCondition( "link_votes < '" . $searchParams['link_votes'] . "'" );
					break;
			}
		}
		
		// hits
		if ( is_numeric($searchParams['link_hits']) && $searchParams['link_hits'] >= 0 ) {
			switch($searchParams['opt_hits']) {
				case 1:
					$advsearch->addRawCondition( "link_hits = '" . $searchParams['link_hits'] . "'" );
					break;
				case 2:
					$advsearch->addRawCondition( "link_hits > '" . $searchParams['link_hits'] . "'" );
					break;
				case 3:
					$advsearch->addRawCondition( "link_hits < '" . $searchParams['link_hits'] . "'" );
					break;
			}
		}

		// price
		if ( is_numeric($searchParams['price']) && $searchParams['price'] >= 0 ) {
			switch($searchParams['opt_price']) {
				case 1:
					$advsearch->addRawCondition( "price = '" . $searchParams['price'] . "'" );
					break;
				case 2:
					$advsearch->addRawCondition( "price > '" . $searchParams['price'] . "'" );
					break;
				case 3:
					$advsearch->addRawCondition( "price < '" . $searchParams['price'] . "'" );
					break;
			}
		}
		
		// reviews
		/*
		if ( is_numeric($searchParams['reviews']) && $searchParams['reviews'] >= 0 ) {
			echo '<br />scanning review... ' . $searchParams['opt_reviews'] . ' ' . $searchParams['reviews'];
			switch($searchParams['opt_reviews']) {
				case 1:
					// $having = "reviews = '" . $searchParams['reviews'] . "'";
					$advsearch->addHavingCondition( "reviews = " . $searchParams['reviews'] );
					break;
				case 2:
					// $having = "reviews > '" . $searchParams['reviews'] . "'";
					$advsearch->addHavingCondition( "reviews > " . $searchParams['reviews'] );
					break;
				case 3:
					//$having = "reviews < '" . $searchParams['reviews'] . "'";
					$advsearch->addHavingCondition( "reviews < " . $searchParams['reviews'] );
					break;
			}
		}
		*/

		$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

		switch ($searchParams['publishing']) {
			case 2: // Published
				$advsearch->addRawCondition( "( (publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now')  AND "
				. "(publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now') AND "
				.	"link_published = '1' )" );
				break;
			case 3: // Unpublished
				$advsearch->addRawCondition( "link_published = '0'" );
				break;
			case 4: // Pending
				$advsearch->addRawCondition( "( (publish_up => '$now' OR publish_up = '0000-00-00 00:00:00') AND link_published = '1' )" );
				break;
			case 5: // Expired
				$advsearch->addRawCondition( "( publish_down < '$now' AND link_published = '1' )" );
				break;
			case 6: // Pending Listing, waiting for approval
				$advsearch->addRawCondition( "link_approved <= 0" );
				break;
		}

		# Check if this owner exists
		# Lookup owner's userid. Return error if does not exists
		if ( !empty($searchParams['owner']) ) {
			$database->setQuery("SELECT id FROM #__users WHERE username ='".$searchParams['owner']."'");
			$owner_id = $database->loadResult();
			if ($owner_id > 0) {
				$advsearch->addRawCondition( "l.user_id = $owner_id" );
			} else {
				echo "<script> alert('".$_MT_LANG->INVALID_OWNER_SELECT_AGAIN."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
		
		$advsearch->search();

		// Total Results
		$total = $advsearch->getTotal();

		// Links
		$where[] = "cl.main = '1'";
		$where[] = "cl.link_id = l.link_id";

	} else {

		// Total Results
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats WHERE cat_name LIKE '%".$search_text."%'" );
		$total = $database->loadResult();

		// Categories
		$database->setQuery( "SELECT * FROM #__mt_cats WHERE cat_name LIKE '%".$search_text."%' ORDER BY cat_name ASC LIMIT $limitstart, $limit" );
	}

	$results = $advsearch->loadResultList( $limitstart, $limit );
	
	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	# Get Pathway
	$pathWay = new mtPathWay();
	
	# Results Output
// /*
	if ( $search_where == 1 ) {
		// Links
		HTML_mtree::advsearchresults_links( $results, $pageNav, $pathWay, $search_where, $option );
	} else {
		// Categories
		HTML_mtree::searchresults_categories( $results, $pageNav, $pathWay, $search_where, $option );
	}
// */
}

/***
* Tree Templates
*/
function templates( $option ) {
	global $database, $mainframe, $mtconf;

	$templateBaseDir = mosPathName( $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates' );

	$rows = array();
	// Read the template dir to find templates
	$templateDirs		= mosReadDirectory($templateBaseDir);

	$cur_template = $mtconf->get('template');

	$rowid = 0;

	// Check that the directory contains an xml file
	foreach($templateDirs as $templateDir) {
		if($templateDir == 'index.html') continue;
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

function template_pages( $option ) {
	global $mtconf, $database;
	
	$template = mosGetParam( $_REQUEST, 'template', '' );
	
	$xmlfile = $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates/' . $template . '/templateDetails.xml';
	$xmlDoc =& new DOMIT_Lite_Document();
	$xmlDoc->resolveErrors( true );
	$xmlDoc->loadXML( $xmlfile, false, true );

	$element = &$xmlDoc->documentElement;
	$element = &$xmlDoc->getElementsByPath('name', 1 );
	$template_name = $element->getText();
	
	$database->setQuery('SELECT params FROM #__mt_templates WHERE tem_name = \'' . $template . '\' LIMIT 1');
	$template_params = $database->loadResult();
	
	$params = new mosParameters( $template_params, $xmlfile, 'template' );

	HTML_mtree::template_pages( $template, $template_name, $params, $option );
}

function edit_templatepage( $option ) {
	global $mtconf, $_MT_LANG;

	$page = mosGetParam( $_REQUEST, 'page', '' );
	$template = mosGetParam( $_REQUEST, 'template', '' );

	$file = $mtconf->getjconf('absolute_path') .'/components/com_mtree/templates/'. $template .'/'. $page .'.tpl.php';

	if ( $fp = fopen( $file, 'r' ) ) {
		$content = fread( $fp, filesize( $file ) );
		$content = htmlspecialchars( $content );

		HTML_mtree::edit_templatepage( $page, $template, $content, $option );
		//HTML_templates::editTemplateSource( $p_tname, $content, $option, $client );
	} else {
		mosRedirect( 'index2.php?option='. $option .'&task=template_pages&template=' . $template, sprintf($_MT_LANG->CANNOT_OPEN_FILE, $file) );
	}

}

function delete_template( $option ) {
	global $mtconf, $database;
	
	$template = mosGetParam( $_REQUEST, 'template', '' );

	$path = $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates/' . $template;
	$database->setQuery('DELETE FROM #__mt_templates WHERE tem_name = \'' . $template . '\' LIMIT 1');
	$database->query();
	if (is_dir( $path )) {
		rmdirr( mosPathName( $path ) );
	}

	mosRedirect( 'index2.php?option='. $option .'&task=templates' );
}

function save_templateparam( $option ) {
	global $database;
	
	$params = mosGetParam( $_POST, 'params', '' );
	$template = mosGetParam( $_REQUEST, 'template', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ($params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}
	
	$database->setQuery('UPDATE #__mt_templates SET params = \'' . $database->getEscaped($_POST['params']) . '\' WHERE tem_name = \'' . $template . '\' LIMIT 1');
	$database->query();
	
	$task = mosGetParam( $_POST, 'task', '' );
	if ( $task == "save_templateparams" ) {
		mosRedirect( 'index2.php?option='. $option .'&task=templates' );
	} else {
		mosRedirect( 'index2.php?option='. $option .'&task=template_pages&template=' . $template );
	}
}

function save_templatepage( $option ) {
	global $mtconf, $_MT_LANG;

	$template = mosGetParam( $_POST, 'template', '' );
	$page = mosGetParam( $_POST, 'page', '' );
	$pagecontent = mosGetParam( $_POST, 'pagecontent', '', 0x0002 );

	if ( !$template ) {
		mosRedirect( 'index2.php?option='. $option .'&task=templates' );
	}

	if ( !$pagecontent ) {
		mosRedirect( 'index2.php?option='. $option .'&task=templates' );
	}

	$file = $mtconf->getjconf('absolute_path') .'/components/com_mtree/templates/'. $template .'/'.$page.'.tpl.php';

	if ( is_writable( $file ) == false ) {
		mosRedirect( "index2.php?option=$option&task=templates" , sprintf($_MT_LANG->FILE_NOT_WRITEABLE, $file) );
	}

	if ( $fp = fopen ($file, 'w' ) ) {
		fputs( $fp, stripslashes( $pagecontent ), strlen( $pagecontent ) );
		fclose( $fp );
		mosRedirect( "index2.php?option=$option&task=template_pages&template=$template", $_MT_LANG->TEMPLATE_PAGE_SAVED );
	} else {
		mosRedirect( "index2.php?option=$option&task=template_pages&template=$template", sprintf( $_MT_LANG->FILE_NOT_WRITEABLE, $file ) );
	}

}

function new_template( $option ) {
	HTML_mtree::new_template( $option );
}

function install_template( $option ) {
	global $mtconf, $_MT_LANG, $database;

	$template = $_FILES['template']['tmp_name'];
	
	require_once( $mtconf->getjconf('absolute_path') . '/includes/domit/xml_domit_lite_include.php' );
	require_once( $mtconf->getjconf('absolute_path') . '/administrator/includes/pcl/pclzip.lib.php' );
	require_once( $mtconf->getjconf('absolute_path') . '/administrator/includes/pcl/pclerror.lib.php' );
	$zipfile = new PclZip( $template );

	if( substr(PHP_OS, 0, 3) == 'WIN' ) {
		define('OS_WINDOWS',1);
	} else {
		define('OS_WINDOWS',0);
	}
	
	$tmp_install = mosPathName( $mtconf->getjconf('absolute_path') . '/media/' . uniqid( 'minstall_' ) );
	if(!$zipfile->extract( PCLZIP_OPT_PATH, $tmp_install )) {
		mosRedirect( 'index2.php?option=com_mtree&task=templates', $_MT_LANG->TEMPLATE_INSTALLATION_FAILED );
	}
	
	$tmp_xml = $tmp_install . '/templateDetails.xml';
	if( file_exists($tmp_xml) ) {

		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if (!$xmlDoc->loadXML( $tmp_xml, true, false )) {
			return false;
		}
		$root =& $xmlDoc->documentElement;
		$template_name = $root->getElementsByPath( 'name', 1 );
		$template_name = $template_name->getText();
		
		$database->setQuery('INSERT INTO #__mt_templates (tem_name) VALUES(\'' . $template_name . '\')');
		$database->query();

	} else {
		rmdirr($tmp_install);
		mosRedirect( 'index2.php?option=com_mtree&task=templates', $_MT_LANG->TEMPLATE_INSTALLATION_FAILED );
	}
	
	if ($handle = opendir($tmp_install)) {
		$tmp_installdir = $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates/' . $template_name;
		if(file_exists($tmp_installdir)) {
			rmdirr($tmp_install);
			mosRedirect( 'index2.php?option=com_mtree&task=templates', $_MT_LANG->TEMPLATE_INSTALLATION_FAILED );
		}
		mkdir( $tmp_installdir, 0755);
	    while (false !== ($file = readdir($handle))) {
			if( $file != '.' && $file != '..' ) {
				copy( $tmp_install . '/' . $file, $tmp_installdir . '/' . $file);
			}
	    }
	    closedir($handle);
		rmdirr($tmp_install);
	}
	mosRedirect( 'index2.php?option=com_mtree&task=templates', $_MT_LANG->TEMPLATE_INSTALLATION_SUCCESS );
	
}

function rmdirr($path) {
    if($files = glob($path . "/*")){
        foreach($files AS $file) {
            is_dir($file)? rmdirr($file) : unlink($file);
        }
    }
    rmdir($path);
}

function default_template( $option ) {
	global $database;

	$template = mosGetParam( $_POST, 'template', '' );
	
	if(!empty($template)) {
		$database->setQuery("UPDATE #__mt_config SET value ='" . $database->getEscaped($template) . "' WHERE varname = 'template' AND groupname = 'main' LIMIT 1");
		$database->query();
	}
	mosRedirect('index2.php?option=com_mtree&task=templates');	
}

function cancel_edittemplatepage( $option ) {
	$template = mosGetParam( $_REQUEST, 'template', '' );
	mosRedirect( "index2.php?option=$option&task=template_pages&template=" . $template );
}

function cancel_templatepages( $option ) {
	$template = mosGetParam( $_REQUEST, 'template', '' );
	mosRedirect( "index2.php?option=$option&task=templates" );
}

/***
* Languages
*/
function languages( $active_language='', $option ) {
	global $database, $mainframe, $mtconf;
	//$mt_language;

	// get current languages
	$cur_language = $mtconf->get('language');

	if ( $active_language == '' ) $active_language = $cur_language;

	$rows = array();
	// Read the template dir to find templates
	$languageBaseDir = mosPathName( $mtconf->getjconf('absolute_path') . '/components/com_mtree/language' );

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
	$file = $mtconf->getjconf('absolute_path') .'/components/com_mtree/language/'. $active_language . '.php';

	if ( $fp = fopen( $file, 'r' ) ) {
		$content = fread( $fp, filesize( $file ) );
		$content = htmlspecialchars( $content );
	}

	HTML_mtree::editLanguage( $cur_language, $active_language, $content, $rows, $option );

}

function save_language( $option ) {
	global $mtconf, $_MT_LANG;

	$language = mosGetParam( $_POST, 'language', '' );
	if (defined('JVERSION')) {
		$pagecontent = $_POST['pagecontent'];
	} else {
		$pagecontent = mosGetParam( $_POST, 'pagecontent', '', 0x0002 );
	}
	
	if ( !$language ) {
		mosRedirect( 'index2.php?option='. $option .'&task=languages' );
	}

	if ( !$pagecontent ) {
		mosRedirect( 'index2.php?option='. $option .'&task=languages' );
	}

	$file = $mtconf->getjconf('absolute_path') .'/components/com_mtree/language/'. $language .'.php';

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
	global $database, $_MT_LANG, $mtconf;

	# Load all custom fields
	$sql = "SELECT cf.*, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.iscore = 0 ORDER BY ordering ASC";
	$database->setQuery($sql);

	$fields = new mFields();
	// $fields->setCoresValue( $row->link_name, $row->link_desc, $row->address, $row->city, $row->state, $row->country, $row->postcode, $row->telephone, $row->fax, $row->email, $row->website, $row->price, $row->link_hits, $row->link_votes, $row->link_rating, $row->link_featured, $row->link_created, $row->link_modified, $row->link_visited, $row->publish_up, $row->publish_down, $row->user_id, $row->username );
	$fields->loadFields($database->loadObjectList());

	# Publishing
	$publishing[] = mosHTML::makeOption( 1, $_MT_LANG->ALL );
	$publishing[] = mosHTML::makeOption( 2, $_MT_LANG->PUBLISHED );
	$publishing[] = mosHTML::makeOption( 3, $_MT_LANG->UNPUBLISHED );
	$publishing[] = mosHTML::makeOption( 4, $_MT_LANG->PENDING );
	$publishing[] = mosHTML::makeOption( 5, $_MT_LANG->EXPIRED );
	$publishing[] = mosHTML::makeOption( 6, $_MT_LANG->AWAITING_APPROVAL );
	$lists['publishing'] = mosHTML::selectList( $publishing, 'publishing', 'class="inputbox" size="1"',	'value', 'text', '' );

	HTML_mtree::csv( $fields, $lists, $option );
	
}

function csv_export( $option ) {
	global $database, $mtconf;
	
	$fields = mosGetParam( $_POST, 'fields', '');
	$publishing = mosGetParam( $_POST, 'publishing', '');

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$custom_fields = array();
	$core_fields = array();
	foreach($fields AS $field) {
		if(substr($field,0,2) == 'cf') {
			$custom_fields[] =  substr($field,2);
		} else {
			$core_fields[] = $field;
		}
	}
	$where = array();
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
	
	# Get link_id(s) first
	if(count($where)>0) {
		$database->setQuery('SELECT link_id FROM #__mt_links WHERE '.implode(" AND ", $where));
	} else {
		$database->setQuery('SELECT link_id FROM #__mt_links');
	}
	$link_ids = $database->loadResultArray();
	
	$header = '';
	$data = '';
	if(count($link_ids) > 0) {
		# Get the core fields value
		unset($where);
		$where = array();
		$where[] = "l.link_id = cl.link_id";
		$where[] = "cl.main = '1'";
		$where[] = "l.link_id IN (" . implode(',',$link_ids) . ")";
		if(in_array('l.link_id',$core_fields)) {
			$sql = "SELECT ".implode(", ",$core_fields)." FROM (#__mt_links AS l, #__mt_cl AS cl)";
		} else {
			$sql = "SELECT ".implode(", ",array_merge(array('l.link_id'),$core_fields))." FROM (#__mt_links AS l, #__mt_cl AS cl)";
		}
		if (count($where)) {
			$sql .= "\n WHERE ".implode(" AND ", $where);
		}

		$database->setQuery( $sql );
		$rows = $database->loadObjectList('link_id');
	
		# Get the custom fields' value
		if(count($custom_fields)>0) {
			$database->setQuery('SELECT cf_id, link_id, value FROM #__mt_cfvalues WHERE cf_id IN (' . implode(',',$custom_fields) . ') AND link_id IN (' . implode(',',$link_ids) . ')');
			$cfvalues = $database->loadObjectList();
			foreach($cfvalues AS $cfvalue) {
				$rows[$cfvalue->link_id]->{'cf'.$cfvalue->cf_id} = $cfvalue->value;
			}
		}
	
		$seperator = ',';

		# Create the CSV data
		$header = '';
		$data='';
		$i=0;
		foreach ($fields AS $field) {
			$i++;
			if($field == 'l.link_id') {
				$header .= 'link_id';
			} elseif(substr($field,0,2) == 'cf') {
				$header .=  substr($field,2);
			} else {
				$header .= $field;
			}
			if($i<count($fields)) {
				$header .= $seperator;
			}
		}
		$header .= "\n";

		foreach($rows AS $row) {
			$line = '';
			$j = 0;

			foreach($row as $key => $value){
				if($key == 'link_id' && !in_array('l.link_id',$core_fields)) {
					continue;
				}
				if ($j >= 0) {
					if(!isset($value) || $value == ""){
						//$value = $seperator;
					} else {
						$value = str_replace('"', '""', $value);
						$value = '"' . $value . '"'; // . $seperator;
					}
					$line .= $value;
					if( ($j+1) < count($fields) ) {
						$line .= $seperator;
					}
				}
				$j++;

			}

			$data .= trim($line)."\n";
		}
	}
	
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$data = str_replace("\r", "", $data);

	HTML_mtree::csv_export( $header, $data, $option );
}

/***
* Configuration
*/
function config( $option ) {
	global $database, $mtconf, $_MT_LANG;
	
	# Get all config groups
	$database->setQuery( 'SELECT * FROM #__mt_configgroup WHERE displayed = 1 ORDER BY ordering ASC' );
	$configgroups = $database->loadResultArray();

	# Get all configs
	$database->setQuery( 'SELECT c.* FROM (#__mt_config AS c, #__mt_configgroup AS cg) WHERE cg.groupname = c.groupname AND c.displayed = \'1\' ORDER BY cg.ordering ASC, c.ordering' );
	$configs = $database->loadObjectList('varname');

	# compile list of the languages
	$langs = array();
	if ($handle=opendir($mtconf->getjconf('absolute_path')."/components/com_mtree/language/")) {
		$i=0;
		while ($file = readdir($handle)) {
			if (!strcasecmp(substr($file,-4),".php") && $file <> "." && $file <> ".." && strcasecmp(substr($file,-11),".ignore.php")) {
				$langs[] = mosHTML::makeOption( substr($file,0,-4) );
			}
		}
	}
	$lists['language'] = mosHTML::selectList( $langs, 'language', 'class="inputbox" size="1"', 'value', 'text', $configs['language']->value );

	# Compile template list
	/*
	$templateDirs	= mosReadDirectory($mtconf->getjconf('absolute_path') . '/components/com_mtree/templates');
	foreach($templateDirs as $templateDir) {
		if ( $templateDir <> "index.html") $templates[] = mosHTML::makeOption( $templateDir, $templateDir );
	}
	$lists['template'] = mosHTML::selectList( $templates, 'template', 'class="inputbox" size="1"', 'value', 'text', $configs['template']->value );
	*/
	# Map
	$map = array();
	$map[] = mosHTML::makeOption( "mapquest", "MapQuest" );
	$map[] = mosHTML::makeOption( "yahoomaps", "Yahoo! Maps" );
	$map[] = mosHTML::makeOption( "googlemaps", "Google Maps" );
	$map[] = mosHTML::makeOption( "googlemaps_ca", "Google Maps Canada" );
	$map[] = mosHTML::makeOption( "googlemaps_cn", "Google Maps China" );
	$map[] = mosHTML::makeOption( "googlemaps_fr", "Google Maps France" );
	$map[] = mosHTML::makeOption( "googlemaps_de", "Google Maps Germany" );
	$map[] = mosHTML::makeOption( "googlemaps_it", "Google Maps Italy" );
	$map[] = mosHTML::makeOption( "googlemaps_jp", "Google Maps Japan" );
	$map[] = mosHTML::makeOption( "googlemaps_es", "Google Maps Spain" );
	$map[] = mosHTML::makeOption( "googlemaps_uk", "Google Maps UK" );
	$lists['map'] = mosHTML::selectList( $map, 'map', 'class="inputbox" size="1"', 'value', 'text', $configs['map']->value );

	# Image Library list
	$imageLibs=array();
	$imageLibs=detect_ImageLibs();
	if(!empty($imageLibs['gd1'])) { $thumbcreator[] = mosHTML::makeOption( 'gd1', 'GD Library '.$imageLibs['gd1'] ); }
	$thumbcreator[] = mosHTML::makeOption( 'gd2', 'GD2 Library '.( (array_key_exists('gd2',$imageLibs)) ? $imageLibs['gd2'] : '') );
	$thumbcreator[] = mosHTML::makeOption( 'netpbm', (isset($imageLibs['netpbm'])) ? $imageLibs['netpbm'] : "Netpbm" );
	$thumbcreator[] = mosHTML::makeOption( 'imagemagick', (isset($imageLibs['imagemagick'])) ? $imageLibs['imagemagick'] : "Imagemagick" ); 
	$lists['resize_method'] = mosHTML::selectList( $thumbcreator, 'resize_method', 'class="text_area" size="3"', 'value', 'text', $configs['resize_method']->value );

	# Sort Direction
	$sort[] = mosHTML::makeOption( "asc", $_MT_LANG->ASCENDING );
	$sort[] = mosHTML::makeOption( "desc", $_MT_LANG->DESCENDING );
	$lists['sort_direction'] = $sort;

	# Category Order
	$cat_order = array();
	$cat_order[] = mosHTML::makeOption( "cat_name", $_MT_LANG->NAME );
	$cat_order[] = mosHTML::makeOption( "cat_featured", $_MT_LANG->FEATURED );
	$cat_order[] = mosHTML::makeOption( "cat_created", $_MT_LANG->CREATED );
	$lists['cat_order'] = $cat_order;

	# Listing Order
	$listing_order = array();
	$listing_order[] = mosHTML::makeOption( "link_name", $_MT_LANG->NAME );
	$listing_order[] = mosHTML::makeOption( "link_hits", $_MT_LANG->HITS );
	$listing_order[] = mosHTML::makeOption( "link_votes", $_MT_LANG->VOTES );
	$listing_order[] = mosHTML::makeOption( "link_rating", $_MT_LANG->RATING );
	$listing_order[] = mosHTML::makeOption( "link_visited", $_MT_LANG->VISIT );
	$listing_order[] = mosHTML::makeOption( "link_featured", $_MT_LANG->FEATURED );
	$listing_order[] = mosHTML::makeOption( "link_created", $_MT_LANG->CREATED );
	$listing_order[] = mosHTML::makeOption( "link_modified", $_MT_LANG->MODIFIED );
	$listing_order[] = mosHTML::makeOption( "address", $_MT_LANG->CONFIGNAME_RSS_ADDRESS );
	$listing_order[] = mosHTML::makeOption( "city", $_MT_LANG->CONFIGNAME_RSS_CITY );
	$listing_order[] = mosHTML::makeOption( "state", $_MT_LANG->CONFIGNAME_RSS_STATE );
	$listing_order[] = mosHTML::makeOption( "country", $_MT_LANG->CONFIGNAME_RSS_COUNTRY );
	$listing_order[] = mosHTML::makeOption( "postcode", $_MT_LANG->CONFIGNAME_RSS_POSTCODE );
	$listing_order[] = mosHTML::makeOption( "telephone", $_MT_LANG->CONFIGNAME_RSS_TELEPHONE );
	$listing_order[] = mosHTML::makeOption( "fax", $_MT_LANG->CONFIGNAME_RSS_FAX );
	$listing_order[] = mosHTML::makeOption( "email", $_MT_LANG->CONFIGNAME_RSS_EMAIL );
	$listing_order[] = mosHTML::makeOption( "website", $_MT_LANG->CONFIGNAME_RSS_WEBSITE );

	$listing_order[] = mosHTML::makeOption( "price", $_MT_LANG->PRICE );
	$lists['listing_order'] = $listing_order;

	# Review Order
	$review_order[] = mosHTML::makeOption( "rev_date", $_MT_LANG->REVIEW_DATE );
	$review_order[] = mosHTML::makeOption( "vote_helpful", $_MT_LANG->TOTAL_HELPFUL_VOTES );
	$review_order[] = mosHTML::makeOption( "vote_total", $_MT_LANG->TOTAL_VOTES );
	$lists['review_order'] = $review_order;

	# User Access
	$access = array();
	$access[] = mosHTML::makeOption( "-1", $_MT_LANG->NONE );
	$access[] = mosHTML::makeOption( "0", $_MT_LANG->PUBLIC );
	$access[] = mosHTML::makeOption( "1", $_MT_LANG->REGISTERED_ONLY );
	$lists['user_access'] = $access;

	# User Access2
	$lists['user_access2'] = array_merge($access,array(mosHTML::makeOption( "2", $_MT_LANG->REGISTERED_ONLY_EXCEPT_LISTING_OWNER )));

	/*
	# Custom fields
	$database->setQuery( 'SELECT * FROM #__mt_customfield' );
	$customfields = $database->loadObjectList('cf_id');
	*/
	HTML_mtree::config( $configs, $configgroups, $lists, $option );


}

function saveconfig($option) {
	global $_MT_LANG, $database;
	
	# This make sure the root entry has a cat_id equal to 0.
	$database->setQuery( "UPDATE #__mt_cats SET cat_id = 0 WHERE cat_parent = -1 LIMIT 1" );
	$database->query();
	
	# Save configs
	foreach( $_POST AS $key => $value ) {
		if( in_array($key,array('option','task')) ) continue;
		$sql = 'UPDATE #__mt_config SET value = \''.$value.'\' WHERE varname = \''.$key.'\' LIMIT 1';
		$database->setQuery($sql);
		$database->query();
	}
	mosRedirect( "index2.php?option=$option&task=config", $_MT_LANG->CONFIG_HAVE_BEEN_UPDATED );
}

?>