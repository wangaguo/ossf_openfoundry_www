<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.00
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
	global $$mosConfig_absolute_path;
	require( $mosConfig_absolute_path . '/components/com_mtree/init.php');
	require_once( $mtconf->getjconf('absolute_path').'/administrator/components/com_mtree/admin.mtree.class.php');
	require_once( $mtconf->getjconf('absolute_path').'/components/com_mtree/mtree.class.php');
	require_once( $mtconf->getjconf('absolute_path').'/components/com_mtree/mtree.tools.php');
} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
	require_once(  JPATH_COMPONENT.DS.'init.php' );
	global $mtconf;
	$database =& JFactory::getDBO();
	$mtconf = new mtConfig($database);
	global $no_html;
	$no_html = intval( mosGetParam( $_REQUEST, 'no_html', 0 ) );
	global $task, $link_id, $cat_id, $user_id, $img_id, $start, $limitstart;
	require_once( JPATH_ADMINISTRATOR.DS.'components' .DS.'com_mtree'.DS.'admin.mtree.class.php' );
	require_once( JPATH_COMPONENT.DS.'mtree.class.php' );
	require_once( JPATH_COMPONENT.DS.'mtree.tools.php' );
	DEFINE( '_NOT_EXIST', JText::_( 'The page you are trying to access does not exist.<br />Please select a page from the Main Menu.' ) );
}

# Caches
global $cache_cat_names, $cache_paths, $cache_lft_rgt;
$cache_cat_names = array();
$cache_paths = array();
$cache_lft_rgt = array();

# Savant Class
require_once( $mtconf->getjconf('absolute_path').'/components/com_mtree/Savant2.php');

$task = trim( mosGetParam( $_REQUEST, 'task', '' ) );
$link_id = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );
$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );
$user_id = intval( mosGetParam( $_REQUEST, 'user_id', 0 ) );
$img_id = intval( mosGetParam( $_REQUEST, 'img_id', 0 ) );
$alpha = substr(trim( mosGetParam( $_REQUEST, 'alpha', '' ) ), 0, 3);
$limitstart = intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );

$now = date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 );

global $savantConf;
$savantConf = array (
		'template_path' => $mtconf->getjconf('absolute_path')."/components/com_mtree/templates/" . $mtconf->get('template') . "/",
		'plugin_path' => $mtconf->getjconf('absolute_path').'/components/com_mtree/Savant2/',
		'filter_path' => $mtconf->getjconf('absolute_path').'/components/com_mtree/Savant2/'
);

# cache activation
global $cache;
$cache = mosCache::getCache( 'com_mtree' );

mtAppendPathWay( $option, $task, $cat_id, $link_id, $img_id );

switch ($task) {
	
	case "viewimage":
		viewimage( $img_id, $option );
		break;

	case "viewgallery":
		viewgallery( $link_id, $option );
		break;

	case "viewlink":
		viewlink( $link_id, $limitstart, $option );
		break;

	case "print":
		$cache->call( 'printlink', $link_id, $option );
		break;

	/* RSS feed */
	case 'rss':
		$type = trim( mosGetParam( $_REQUEST, 'type', 'new' ) );
		if( ($type == 'new' && $mtconf->get('show_listnewrss') == 0) || ($type == 'type' && $mtconf->get('show_listupdatedrss') ==  0) ) {
			echo _NOT_EXISTS;
		} else {
			require_once( $mtconf->getjconf('absolute_path').'/components/com_mtree/rss.php');
			rss( $option, $type, $cat_id );
		}
		break;

	/* Visit a URL */
	case "visit":
		visit( $link_id );
		break;

	/* Reviews */
	case "writereview":
		writereview( $link_id, $option );
		break;
	case "addreview":
		mosCache::cleanCache( 'com_mtree' );
		addreview( $link_id, $option );
		break;

	/* Ratings */
	case "rate":
		rate( $link_id, $option );
		break;
	case "addrating":
		mosCache::cleanCache( 'com_mtree' );
		addrating( $link_id, $option );
		break;
	
	/* Favourite */
	case "fav":
		$action = intval( mosGetParam( $_REQUEST, 'action', 1 ) );
		fav( $link_id, $action, $option );
		break;

	/* Vote review */
	case 'votereview':
		$rev_vote = intval( mosGetParam( $_REQUEST, 'vote', 0 ) );
		$rev_id = intval( mosGetParam( $_REQUEST, 'rev_id', 0 ) );
		votereview( $rev_id, $rev_vote, $option );
		break;

	/* Report review */
	case "reportreview":
		$rev_id = intval( mosGetParam( $_REQUEST, 'rev_id', 0 ) );
		reportreview( $rev_id, $option );
		break;
	case "send_reportreview":
		$rev_id = intval( mosGetParam( $_REQUEST, 'rev_id', 0 ) );
		send_reportreview( $rev_id, $option );
		break;

	/* Reply review */
	case 'replyreview':
		$rev_id = intval( mosGetParam( $_REQUEST, 'rev_id', 0 ) );
		replyreview( $rev_id, $option );
		break;
	case 'send_replyreview':
		$rev_id = intval( mosGetParam( $_REQUEST, 'rev_id', 0 ) );
		send_replyreview( $rev_id, $option );
		break;

	/* Recommend to Friend */
	case "recommend":
		recommend( $link_id, $option );
		break;
	case "send_recommend":
		send_recommend( $link_id, $option );
		break;

	/* Contact Owner */
	case "contact":
		contact( $link_id, $option );
		break;
	case "send_contact":
		send_contact( $link_id, $option );
		break;

	/* Report Listing */
	case "report":
		report( $link_id, $option );
		break;
	case "send_report":
		send_report( $link_id, $option );
		break;

	/* Claim Listing */
	case "claim":
		claim( $link_id, $option );
		break;
	case "send_claim":
		send_claim( $link_id, $option );
		break;

	/* Add Listing */
	case "addlisting":
		editlisting( 0, $option );
		break;
	case "editlisting":
		editlisting( $link_id, $option );
		break;
	case "savelisting":
		savelisting( $option );
		break;

	/* Add Category */
	case "addcategory":
		addcategory( $option );
		break;
	case "addcategory2":
		addcategory2( $option );
		break;

	/* Delete Listing */
	case "deletelisting":
		deletelisting( $link_id, $option );
		break;
	case "confirmdelete":
		mosCache::cleanCache( 'com_mtree' );
		confirmdelete( $link_id, $option );
		break;

	/* My Page */
	case "mypage":
		//mypage( $limitstart, $option );
		global $my; viewowner( $my->id, $limitstart, $option );
		break;

	/* All listing from this owner */
	case "viewowner":
		viewowner( $user_id, $limitstart, $option );
		break;

	/* All review from this user */
	case "viewusersreview":
		viewusersreview( $user_id, $limitstart, $option );
		break;

	/* All user's favourites */
	case "viewusersfav":
		viewusersfav( $user_id, $limitstart, $option );
		break;

	/* List Alphabetically */
	case "listalpha":
		listalpha( $cat_id, $alpha, $limitstart, $option );
		break;
	
	/* List Listing */
	case "listpopular":
	case "listmostrated":
	case "listtoprated":
	case "listmostreview":
	case "listnew":
	case "listupdated":
	case "listfeatured":
	case "listfavourite":
		require_once( $mtconf->getjconf('absolute_path').'/components/com_mtree/listlisting.php');
		listlisting( $cat_id, $option, $task, $limitstart );
		break;

	/* Search */
	case "search":
		search( $option );
		break;
	case "advsearch":
		advsearch( $option );
		break;
	case "advsearch2":
		advsearch2( $option );
		break;
		
	/* Ajax Category */
	case "getcats":
		getCats( $cat_id );
		break;
		
	/* Default Main Index */
	case "listcats":
	default:
		showTree( $cat_id, $limitstart, $option );
		break;
}

// Append CSS file to Head
if ( file_exists( $savantConf['template_path'] . '/template.css' ) ) {
	$mainframe->addCustomHeadTag( "<link href=\"" . str_replace($mtconf->getjconf('absolute_path'),$mtconf->getjconf('live_site'),$savantConf['template_path'] . (defined('JVERSION')?'':'/') . 'template.css') . "\" rel=\"stylesheet\" type=\"text/css\"/>" );
} elseif ( file_exists( $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates/' . $mtconf->get('template') . '/template.css' ) ) {
	$mainframe->addCustomHeadTag( "<link href=\"". $mtconf->getjconf('live_site') ."/components/com_mtree/templates/".$mtconf->get('template')."/template.css\" rel=\"stylesheet\" type=\"text/css\"/>" );
} else {
	$mainframe->addCustomHeadTag( "<link href=\"". $mtconf->getjconf('live_site') ."/components/com_mtree/templates/m2/template.css\" rel=\"stylesheet\" type=\"text/css\"/>" );
}

function getCats( $parent_cat_id ) {
	global $database, $_MT_LANG;

	# Get pathway
	$mtPathWay = new mtPathWay($parent_cat_id);
	$return = $mtPathWay->printPathWayFromCat_withCurrentCat($parent_cat_id,0);
	$return .= "\n";
	
	$database->setQuery( 'SELECT cat_id, cat_name FROM #__mt_cats WHERE cat_parent = '. $parent_cat_id . ' && cat_published = 1 && cat_approved = 1 ORDER BY cat_name ASC' );
	$cats = $database->loadObjectList();
	if($parent_cat_id > 0) {
		$database->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$parent_cat_id' && cat_published = 1 && cat_approved = 1 LIMIT 1");
		$browse_cat_parent = $database->loadResult();
		$return .= $browse_cat_parent . "|" . $_MT_LANG->ARROW_BACK;
		if(count($cats)>0) {
			$return .= "\n";
		}
	} else {
		//
	}
	if(count($cats)>0) {
		foreach( $cats as $key => $cat )
		{
			$return .= $cat->cat_id . '|' . $cat->cat_name;
			if($key<(count($cats)-1)) {
				$return .=  "\n";
			}
		}
	}
	echo $return;
	return true;
}

function showTree( $cat_id, $limitstart, $option ) {
	global $database, $mainframe, $cache, $_MT_LANG, $mtconf;

	$database->setQuery( "SELECT cat.cat_id, cat_name, cat_desc, cat_template, cat_image, cat_allow_submission, metakey, metadesc, cat_published, cat_usemainindex, cat_show_listings FROM #__mt_cats AS cat"
		.	"\n WHERE cat.cat_id='".$cat_id."' AND cat_published='1' LIMIT 1" );
	$database->loadObject( $cat );

	if ( $cat ) {
		# Set Page Title
		if ( $cat_id == 0 ) {
			$mainframe->setPageTitle( $_MT_LANG->ROOT );
			$cat->cat_allow_submission = $mtconf->get('allow_listings_submission_in_root');
		} else {
			$mainframe->setPageTitle( html_entity_decode_utf8($cat->cat_name) );
		}

		# Add META tags
		if ($mtconf->getjconf('MetaTitle')=='1') {
			$mainframe->addMetaTag( 'title' , $cat->cat_name );
		}

		if ($cat->metadesc <> '') $mainframe->prependMetaTag( 'description', $cat->metadesc );
		if ($cat->metakey <> '') $mainframe->prependMetaTag( 'keywords', $cat->metakey );
	}

	$cache->call( 'showTree_cache', $cat, $limitstart, $option );
}

function showTree_cache( $cat, $limitstart, $option ) {
	global $database, $_MT_LANG, $Itemid, $savantConf, $mtconf, $_MAMBOTS;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	if ( empty($cat->cat_id) ) {
		$cat_id = 0;
	} else {
		$cat_id = $cat->cat_id;
	}

	if ( is_object($cat) && $cat->cat_published == 0 && $cat_id > 0 ) {
		
		echo _NOT_EXIST;

	} else {

		# Page Navigation
		$database->setQuery("SELECT COUNT(*) FROM (#__mt_links AS l, #__mt_cl AS cl) WHERE l.link_published='1' AND l.link_approved='1' && cl.cat_id ='".$cat_id."' "
			. "\n AND ( l.publish_up = '0000-00-00 00:00:00' OR l.publish_up <= '$now'  ) "
			. "\n AND ( l.publish_down = '0000-00-00 00:00:00' OR l.publish_down >= '$now' ) "
			.	"\n AND cl.link_id = l.link_id "
		);
		$total_links = $database->loadResult();

		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total_links, $limitstart, $mtconf->get('fe_num_of_links') );

		# Retrieve categories
		$sql = "SELECT cat.* FROM #__mt_cats AS cat ";
		$sql .= "\nWHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ";
		if ( !$mtconf->get('display_empty_cat') ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
		$sql .= "\nORDER BY " . $mtconf->get('first_cat_order1') . " " . $mtconf->get('first_cat_order2') .', ' . $mtconf->get('second_cat_order1') . ' ' . $mtconf->get('second_cat_order2');

		$database->setQuery( $sql );
		$cats = $database->loadObjectList("cat_id");

		$cat_desc = '';
		$related_categories = null;

		foreach ( $cats AS $c ) {
			$cat_ids[] = $c->cat_id;
		}

		# Only shows sub-cat if this is a root category
		if ( ($cat_id == 0 || $cat->cat_usemainindex == 1) && $mtconf->getTemParam('numOfSubcatsToDisplay',3) != '0') {
			# Get all sub-cats
			$sql = "SELECT cat_id, cat_name, cat_cats, cat_links, cat_parent FROM #__mt_cats WHERE cat_parent IN (".implode(',',$cat_ids).") && cat_published='1' && cat_approved='1' ";
			if ( !$mtconf->get('display_empty_cat') ) { $sql .= " && ( cat_cats > 0 || cat_links > 0 ) ";	}
			$sql .= "\nORDER BY cat_featured DESC, " . $mtconf->get('first_cat_order1') . " " . $mtconf->get('first_cat_order2') . ', ' . $mtconf->get('second_cat_order1') . ' ' . $mtconf->get('second_cat_order2');
			$database->setQuery( $sql );
			$sub_cats_tmp = $database->loadObjectList();

			foreach($sub_cats_tmp AS $sub_cat) {
				if( isset($sub_cats[$sub_cat->cat_parent]) ) {
					if( $mtconf->getTemParam('numOfSubcatsToDisplay',3) > 0 && count($sub_cats[$sub_cat->cat_parent]) < $mtconf->getTemParam('numOfSubcatsToDisplay',3) ) {
						array_push($sub_cats[$sub_cat->cat_parent],$sub_cat);
					}
				} else {
					$sub_cats[$sub_cat->cat_parent] = array($sub_cat);
				}
				if(!isset($sub_cats_total[$sub_cat->cat_parent])) {
					$total_sub_cats = $cats[$sub_cat->cat_parent]->cat_cats;
					$sub_cats_total[$sub_cat->cat_parent] = (($total_sub_cats) ? $total_sub_cats : 0 );
				}
			}
			foreach($cat_ids AS $c) {
				if(!array_key_exists($c,$sub_cats)) {
					$sub_cats[$c] = array();
				}
			}
			unset($sub_cats_tmp);

		} else {

			# Get related categories
			$database->setQuery( "SELECT r.rel_id FROM #__mt_relcats AS r "
				.	"LEFT JOIN #__mt_cats AS c ON c.cat_id = r.rel_id "
				.	"WHERE r.cat_id='".$cat_id."' AND c.cat_published = '1'" );
			$related_categories = $database->loadResultArray();

		}

		# Get subset of listings
		if( ($cat_id == 0 || $cat->cat_usemainindex == 1) && is_numeric($mtconf->getTemParam('numOfLinksToDisplay',3)) && $mtconf->getTemParam('numOfLinksToDisplay',3)!=0) {

			$sql = "SELECT l.link_id, link_name, cl.cat_id FROM #__mt_links AS l "
				.	"\n LEFT JOIN #__mt_cl AS cl ON cl.link_id = l.link_id "
				.	"\n WHERE link_published='1' && link_approved='1' && cl.cat_id IN (".implode(',',$cat_ids).')'
				.	"\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
				.	"\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) ";
			if( $mtconf->get('min_votes_to_show_rating') > 0 && $mtconf->get('first_listing_order1') == 'link_rating' ) {
				$sql .= "\n ORDER BY link_votes >= " . $mtconf->get('min_votes_to_show_rating') . ' DESC, ' . $mtconf->get('first_listing_order1') . ' ' . $mtconf->get('first_listing_order2') . ', ' . $mtconf->get('second_listing_order1') . ' ' . $mtconf->get('second_listing_order2');
			} else {
				$sql .= "\n ORDER BY " . $mtconf->get('first_listing_order1') . ' ' . $mtconf->get('first_listing_order2') . ', ' . $mtconf->get('second_listing_order1') . ' ' . $mtconf->get('second_listing_order2');
			}

			$database->setQuery( $sql );
			$cat_links_tmp = $database->loadObjectList();
			foreach($cat_links_tmp AS $cat_link) {
				if(isset($cat_links[$cat_link->cat_id])) {
					if($mtconf->getTemParam('numOfLinksToDisplay',3) > 0 && count($cat_links[$cat_link->cat_id]) < $mtconf->getTemParam('numOfLinksToDisplay',3)) {
						array_push($cat_links[$cat_link->cat_id],$cat_link);
					}
				} else {
					$cat_links[$cat_link->cat_id] = array($cat_link);
				}
			}
			foreach($cat_ids AS $c) {
				if(!isset($cat_links) || !array_key_exists($c,$cat_links)) {
					$cat_links[$c] = array();
				}
			}

		}
		
		# Retrieve Links
		$sql = "SELECT l.*, cl.*, cat.*, u.username AS username, u.name AS owner, img.filename AS link_image FROM #__mt_links AS l"
			.	"\n LEFT JOIN #__mt_cl AS cl ON cl.link_id = l.link_id "
			.	"\n LEFT JOIN #__users AS u ON u.id = l.user_id "
			.	"\n LEFT JOIN #__mt_cats AS cat ON cl.cat_id = cat.cat_id "
			.	"\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
			.	"\n WHERE link_published='1' && link_approved='1' && cl.cat_id='".$cat_id."' "
			.	"\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			.	"\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) ";
		
		if( $mtconf->get('min_votes_to_show_rating') > 0 && $mtconf->get('first_listing_order1') == 'link_rating' ) {
			$sql .= "\n ORDER BY link_votes >= " . $mtconf->get('min_votes_to_show_rating') . ' DESC, ' . $mtconf->get('first_listing_order1') . ' ' . $mtconf->get('first_listing_order2') . ', ' . $mtconf->get('second_listing_order1') . ' ' . $mtconf->get('second_listing_order2');
		} else {
			$sql .= "\n ORDER BY " . $mtconf->get('first_listing_order1') . ' ' . $mtconf->get('first_listing_order2') . ', ' . $mtconf->get('second_listing_order1') . ' ' . $mtconf->get('second_listing_order2');
		}
		$sql .= "\n LIMIT $limitstart, " . $mtconf->get('fe_num_of_links');
		$database->setQuery( $sql );

		$links = $database->loadObjectList();

		# Pathway
		$pathWay = new mtPathWay( $cat_id );

		if ( isset($cat->cat_template) && $cat->cat_template <> '' ) {
			loadCustomTemplate(null,$savantConf,$cat->cat_template);
		}

		# Support Plugins
		if( isset($cat->cat_desc) && !empty($cat->cat_desc) ) {
			$cat->text = $cat->cat_desc;
		} else {
			$cat->text = '';
		}
		if( isset($cat_id) )$cat->id = $cat_id;
		if( isset($cat->cat_name) )$cat->title = $cat->cat_name;
		if($mtconf->get('cat_parse_plugin')) {
			$params =& new mosParameters( '' );
			$_MAMBOTS->loadBotGroup( 'content' );
			$results = $_MAMBOTS->trigger( 'onPrepareContent', array( &$cat, &$params, 0 ), true );
		}

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonListlinksVar( $savant, $links, $pathWay, $pageNav );
		$savant->assign('user_addlisting', $mtconf->get('user_addlisting'));
		// $savant->assign('cat_image_dir', $mtconf->getjconf('live_site').$mtconf->get('cat_image_dir'));
		
		if (isset($cat->cat_allow_submission)) {
			$savant->assign('cat_allow_submission',$cat->cat_allow_submission);
		} else {
			$savant->assign('cat_allow_submission',0);
		}

		if (isset($cat->cat_show_listings)) {
			$savant->assign('cat_show_listings',$cat->cat_show_listings);
		} else {
			$savant->assign('cat_show_listings',0);
		}

		if (isset($cat_links)) $savant->assign('cat_links', $cat_links);
		$savant->assign('cat_id', $cat_id);
		$savant->assign('categories', $cats);
		if (isset($sub_cats)) $savant->assign('sub_cats', $sub_cats);
		if (isset($sub_cats_total)) $savant->assign('sub_cats_total', $sub_cats_total);
		$savant->assign('related_categories', $related_categories);
		$savant->assignRef('links', $links);
		if (isset($cat->cat_desc)) $savant->assign('cat_desc', $cat->text);
		if (isset($cat->cat_image)) $savant->assign('cat_image', $cat->cat_image);
		if (isset($cat->cat_name)) $savant->assign('cat_name', $cat->title);
		
		$savant->assign('total_listing', $total_links);

		if ( $cat_id == 0 || $cat->cat_usemainindex == 1 ) {
			$savant->assign('display_listings_in_root', $mtconf->get('display_listings_in_root'));
			$savant->display( 'page_index.tpl.php' );
		} else {
			$savant->display( 'page_subCatIndex.tpl.php' );
		}

	}

}

/***
* Simple Search
*/
function search( $option ) {
	global $database, $_MT_LANG, $savantConf, $Itemid, $custom404, $mtconf;

	# Search word
	$searchword = trim(mosGetParam( $_REQUEST, 'searchword', ''));
	
	# Using Built in SEF feature in Joomla!
	if ( !isset($custom404) && $mtconf->getjconf('sef') ) {
		$searchword = urldecode($searchword);
	}

	# Search Category
	$search_cat = mosGetParam( $_REQUEST, 'cat_id', 0 );
	$only_subcats_sql = '';
	if ( $search_cat > 0 ) {
		$mtCats = new mtCats( $database );
		$subcats = $mtCats->getSubCats_Recursive( $search_cat, true );
		$subcats[] = $search_cat;
		if ( count($subcats) > 0 ) {
			$only_subcats_sql = "\n AND c.cat_id IN (" . implode( ", ", $subcats ) . ")";
		}
	}

	# Page Navigation
	$limitstart = trim( mosGetParam( $_REQUEST, 'limitstart', 0 ) );

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	
	$cats = array(0);
	
	# Construct WHERE
	$link_fields = array('link_name', 'link_desc', 'address', 'city', 'postcode', 'state', 'country', 'email', 'website', 'telephone', 'fax', 'metakey', 'metadesc', 'price' );

	$total = 0;
	$cats = array();

	if(!empty($searchword) || $searchword == '0') {
		if(get_magic_quotes_gpc()) {
			$searchword = stripslashes($searchword);
		} else {
			$searchword = $searchword;
		}
		$words = parse_words($searchword);
		
		foreach($words AS $key => $value) {
			$words[$key] = addslashes($value);
		}
		
		$database->setQuery("SELECT field_type,published,simple_search FROM #__mt_customfields WHERE iscore = 1");
		$searchable_core_fields = $database->loadObjectList('field_type');

		# Determine if there are custom fields that are simple searchable
		$database->setQuery("SELECT COUNT(*) FROM #__mt_customfields WHERE published = 1 AND simple_search = 1 AND iscore = 0");
		$searchable_custom_fields_count = $database->loadResult();
		
		$wheres0 = array();
		$wheres_cat = array();
		$wheres1 = array();
		foreach ($words as $word) {
			$wheres_cat[] = "\nLOWER(c.cat_name) LIKE '%$word%'";

			foreach( $link_fields AS $lf ) {
				if ( 
					(substr($lf, 0, 5) == "link_" && array_key_exists('core'.substr($lf,5),$searchable_core_fields) && $searchable_core_fields['core'.substr($lf,5)]->published == 1 && $searchable_core_fields['core'.substr($lf,5)]->simple_search == 1)
					OR
					(array_key_exists('core'.$lf,$searchable_core_fields) && $searchable_core_fields['core'.$lf]->published == 1 && $searchable_core_fields['core'.$lf]->simple_search == 1)
				) {
					if(in_array($lf,array('metakey','metadesc'))) {
						$wheres0[] = "\n LOWER(l.$lf) LIKE '%$word%'";
					} else {
						$wheres0[] = "\n LOWER($lf) LIKE '%$word%'";
					}
				}
			}
			if($searchable_custom_fields_count > 0) {
				// $wheres0[] = "\n" .' (cf.hidden = 0 AND cf.simple_search = 1 AND cf.published = 1 AND LOWER(cfv.value) LIKE \'%' . $word . '%\')';
				$wheres0[] = "\n" .' (cf.simple_search = 1 AND cf.published = 1 AND LOWER(cfv.value) LIKE \'%' . $word . '%\')';
			}
			$wheres1[] = "\n (" . implode( ' OR ', $wheres0 ) . ")";
			unset($wheres0);
		}
		$where = "(\n" . implode( "\nAND\n", $wheres1 ) . "\n)";
		$where_cat = '(' . implode( ') AND (', $wheres_cat ) . ')';

		# Retrieve categories
		if ( $limitstart == 0 ) {
			# Search Categories 
			$database->setQuery( "SELECT * FROM #__mt_cats AS c" 
				.	"\n WHERE " . $where_cat
				.	"\n AND cat_published='1' AND cat_approved='1' "
				.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
			);
			$cats = $database->loadObjectList();
		}
		# Retrieve links
		$sql = "SELECT DISTINCT l.link_id, l.*, u.username, c.*, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl";
		if($searchable_custom_fields_count > 0) {
			$sql .= ", #__mt_customfields AS cf";
		}
		$sql .= ")";
		if($searchable_custom_fields_count > 0) {
			$sql .= "\n LEFT JOIN #__mt_cfvalues AS cfv ON cfv.link_id = l.link_id AND cfv.cf_id = cf.cf_id";
		}
		$sql .=	"\n	LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 " 
			.	"\n	LEFT JOIN #__mt_cats AS c ON c.cat_id = cl.cat_id " 
			.	"\n LEFT JOIN #__users AS u ON u.id = l.user_id "
			.	"\n	WHERE " 
			. 	"\n	link_published='1' AND link_approved='1' AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )"
			.	"\n AND cl.link_id = l.link_id "
			.	"\n AND cl.main = 1 ";
		$sql .= "\n AND ".$where
			.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' )
			.	"\n ORDER BY " . $mtconf->get('first_search_order1') . ' ' . $mtconf->get('first_search_order2') . ', ' . $mtconf->get('second_search_order1') . ' ' . $mtconf->get('second_search_order2')
			.	"\n LIMIT $limitstart, " . $mtconf->get('fe_num_of_searchresults');
		$database->setQuery( $sql );
		$links = $database->loadObjectList();

		# Get total
		$sql = "SELECT COUNT(DISTINCT l.link_id) FROM (#__mt_links AS l, #__mt_cl AS cl";
			if($searchable_custom_fields_count > 0) {
				$sql .= ", #__mt_customfields AS cf";
			}
			$sql .= ")";
			if($searchable_custom_fields_count > 0) {
				$sql .= "\n LEFT JOIN #__mt_cfvalues AS cfv ON cfv.link_id = l.link_id AND cfv.cf_id = cf.cf_id";
			}
			$sql .=	"\n	LEFT JOIN #__mt_cats AS c ON c.cat_id = cl.cat_id " 
				.	"\n	WHERE " 
				.	"link_published='1' AND link_approved='1' AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )"
				.	"\n AND cl.link_id = l.link_id "
				.	"\n AND cl.main = 1 ";
			$sql .=	"\n AND ".$where
				.	( (!empty($only_subcats_sql)) ? $only_subcats_sql : '' );
			$database->setQuery( $sql );

		$total = $database->loadResult();
	}

	require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $mtconf->get('fe_num_of_searchresults') );

	# Pathway
	$pathWay = new mtPathWay();

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonListlinksVar( $savant, $links, $pathWay, $pageNav );

	$savant->assign('searchword', stripslashes($searchword));
	$savant->assign('cat_id', $search_cat);
	$savant->assign('total_listing', $total);
	if ( $limitstart == 0 ) {
		$savant->assign('cats', $cats);	
		$savant->assign('categories', $cats);	
	}

	$savant->display( 'page_searchResults.tpl.php' );
}

/***
* Advanced Search
*/

function advsearch( $option ) {
	global $cache, $_MT_LANG, $mainframe;

	$mainframe->setPageTitle( $_MT_LANG->ADVANCED_SEARCH ); 

	$cache->call( 'advsearch_cache', $option );
}

function advsearch_cache( $option ) {
	global $savantConf, $_MT_LANG, $database, $Itemid, $mtconf;

	require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mfields.class.php' );

	# Pathway
	$pathWay = new mtPathWay();

	# Get category's tree
	getCatsSelectlist( 0, $cat_tree, 0 );
	$cat_options[] = mosHTML::makeOption( "", "" );
	foreach( $cat_tree AS $ct ) {
		$cat_options[] = mosHTML::makeOption( $ct["cat_id"], str_repeat("&nbsp;",($ct["level"]*3)) .(($ct["level"]>0) ? " -":''). $ct["cat_name"] );
	}
	$catlist = mosHTML::selectList( $cat_options, "cat_id", 'class="text_area"', 'value', 'text', "" );

	# Search condition
	$searchConditions[] = mosHTML::makeOption( 1, strtolower($_MT_LANG->ANY) );
	$searchConditions[] = mosHTML::makeOption( 2, strtolower($_MT_LANG->ALL) );
	$lists['searchcondition'] = mosHTML::selectList( $searchConditions, 'searchcondition', 'class="inputbox" size="1"',
	'value', 'text', 1 );

	# Load all CORE and custom fields
	$database->setQuery( "SELECT cf.*, '0' AS link_id, '' AS value, '0' AS attachment, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.published='1' && advanced_search = '1' ORDER BY ordering ASC" );
	$fields = new mFields($database->loadObjectList());
	
	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonListlinksVar( $savant, $links, $pathWay, $pageNav );
	$savant->assignRef('catlist', $catlist);
	$savant->assignRef('fields', $fields);
	$savant->assignRef('lists', $lists);

	$savant->_MT_LANG =& $_MT_LANG;
	$savant->display( 'page_advSearch.tpl.php' );

}

function advsearch2( $option ) {
	global $database, $mainframe, $savantConf, $_MT_LANG, $Itemid, $mtconf;
	require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mfields.class.php' );
	require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mAdvancedSearch.class.php' );

	$mainframe->setPageTitle( $_MT_LANG->ADVANCED_SEARCH_RESULTS ); 

	# Load up search ID if available
	$search_id = intval( mosGetParam( $_REQUEST, 'search_id', 0 ) );
	
	if ($search_id > 0) {
		$database->setQuery("SELECT search_text FROM #__mt_searchlog WHERE search_id ='".$search_id."'");
		$_POST = unserialize(str_replace("'","\'",$database->loadResult()));
	}

	# Load all published CORE & custom fields
	$database->setQuery( "SELECT cf.*, '0' AS link_id, '' AS value, '0' AS attachment, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.published='1' ORDER BY ordering ASC" );
	$fields = new mFields($database->loadObjectList());
	$searchParams = $fields->loadSearchParams($_POST);
	
	$advsearch = new mAdvancedSearch( $database );
	if( intval(mosGetParam( $_POST, 'searchcondition', 1 )) == '2' ) {
		$advsearch->useAndOperator();
	} else {
		$advsearch->useOrOperator();
	}

	# Search Category
	$search_cat = intval(mosGetParam( $_POST, 'cat_id', 0 ));
	$only_subcats_sql = '';

	if ( $search_cat > 0 && is_int($search_cat) ) {
		$mtCats = new mtCats( $database );
		$subcats = $mtCats->getSubCats_Recursive( $search_cat, true );
		$subcats[] = $search_cat;
		if ( count($subcats) > 0 ) {
			$advsearch->limitToCategory( $subcats );
		}
	}

	$fields->resetPointer();
	while( $fields->hasNext() ) {
		$field = $fields->getField();
		$searchFields = $field->getSearchFields();

		if( isset($searchFields[0]) && isset($searchParams[$searchFields[0]]) && $searchParams[$searchFields[0]] != '' ) {
			foreach( $searchFields AS $searchField ) {
				$searchFieldValues[] = $searchParams[$searchField];
			}
			if( count($searchFieldValues) > 0 && $searchFieldValues[0] != '' ) {
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

	$limit = mosGetParam( $_GET, 'limit', $mtconf->get('fe_num_of_searchresults') );
	$limitstart = mosGetParam( $_GET, 'limitstart', 0 );

	$advsearch->search(1,1);
	
	// Total Results
	$total = $advsearch->getTotal();

	if ( $search_id <= 0 && $total > 0 ) {

		# Store search for later retrieval.
		if ( $search_id < 1 ) {
			$database->setQuery("INSERT INTO #__mt_searchlog (search_text) VALUES ('".serialize($_POST)."')");		
			if(!$database->query())
			{
				echo $database->getErrorMsg();
			}
		}

		# Get the above search ID
		$database->setQuery("SELECT search_id FROM #__mt_searchlog WHERE search_text ='".serialize($_POST)."'");		
		$database->query();
		$search_id = $database->loadResult();

		$mainframe->addCustomHeadTag('<meta http-equiv="Refresh" content="1; URL='.sefRelToAbs("index.php?option=com_mtree&task=advsearch2&search_id=$search_id&Itemid=$Itemid").'">');
		# Savant template
		$savant = new Savant2($savantConf);
		$savant->_MT_LANG =& $_MT_LANG;
		$savant->assign('redirect_url', sefRelToAbs("index.php?option=com_mtree&task=advsearch2&search_id=$search_id&Itemid=$Itemid"));
		$savant->display( 'page_advSearchRedirect.tpl.php' );

	} else {
		$links = $advsearch->loadResultList( $limitstart, $limit );

		# Page Navigation
		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		# Pathway
		$pathWay = new mtPathWay();

		# Savant template
		$savant = new Savant2($savantConf);
		assignCommonListlinksVar( $savant, $links, $pathWay, $pageNav );

		$savant->assign('search_id', $search_id);

		$savant->display( 'page_advSearchResults.tpl.php' );

	}
}

function listalpha( $cat_id, $alpha, $limitstart, $option ) {
	global $cache, $_MT_LANG, $mainframe, $database;
	
	$database->setQuery( "SELECT cat_name FROM #__mt_cats WHERE cat_id = '".$cat_id."' LIMIT 1" );
	$cat_name = $database->loadResult();

	$mainframe->setPageTitle( sprintf($_MT_LANG->LIST_ALPHA_BY_LISTINGS_AND_CATS, strtoupper($alpha), $cat_name) ); 

	$cache->call( 'listalpha_cache', $cat_id, $alpha, $limitstart, $option );
}

function listalpha_cache( $cat_id, $alpha, $limitstart, $option ) {
	global $database, $savantConf, $_MT_LANG, $Itemid, $mainframe, $mtconf;
	
	$where = array();
	
	# Number (0-9)
	if ( $alpha == '0' ) {
		for( $i=48; $i <= 57; $i++) {
			$cond_seq_link[] = "link_name LIKE '".chr($i)."%'";
			$cond_seq_cat[] = "cat1.cat_name LIKE '".chr($i)."%'";
		}
		$where[] = "(".implode(" OR ",$cond_seq_link).")";
		$where_cat[] = "(".implode(" OR ",$cond_seq_cat).")";

	# Alphabets (A-Z)
	} elseif ( eregi("[a-z0-9]{1}[0-9]*", $alpha) OR ($mtconf->get('alpha_index_additional_chars') <> '' AND stripos($mtconf->get('alpha_index_additional_chars'),$alpha) !== false ) ) {
		$where[] = "link_name LIKE '".urldecode($alpha)."%'";
		$where_cat[] = "cat1.cat_name LIKE '".urldecode($alpha)."%'";
	}

	if(count($where) > 0) {
	
		# SQL condition to display category specific results
		$subcats = implode(", ",getSubCats_Recursive($cat_id));

		if ($subcats) $where[] = "cl.cat_id IN (" . $subcats . ")";
		if ($subcats) $where_cat[] = "cat1.cat_parent IN (" . $subcats . ")";

		// Get Total results - Links
		$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

		$sql = "SELECT COUNT(*) FROM (#__mt_links AS l, #__mt_cl AS cl) ";
		$where[] = "l.link_id = cl.link_id";
		$where[] = "cl.main = '1'";
		$where[] = "link_approved = '1'";
		$where[] = "link_published = '1'";
		$where[] = "( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )";
		$where[] = "( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )";
	
		$sql .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");

		$database->setQuery( $sql );
		$total = $database->loadResult();

		// Get Links
		$link_sql = "SELECT l.*, u.username, cl.cat_id AS cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl) ";
		$link_sql .= " LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 ";
		$link_sql .= " LEFT JOIN #__users AS u ON u.id = l.user_id ";
		$link_sql .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");
		$link_sql .= " AND l.link_id = cl.link_id AND cl.main = '1' ";
		$link_sql .= "ORDER BY link_featured DESC, link_name ASC ";
		$link_sql .= "LIMIT $limitstart, " . $mtconf->get('fe_num_of_links');

		# Shows categories if this is the first page. ie: $limitstart = 0
		$num_of_cats = 0;
		
		if ( $limitstart == 0 ) {
			
			$database->setQuery( "SELECT * FROM #__mt_cats AS cat1 WHERE "
				.	implode( ' AND ', $where_cat )	
				.	"AND cat_approved = '1' "
				.	"AND cat_published = '1' "
				.	($mtconf->getTemParam('onlyShowRootLevelCatInListalpha',0) ? "AND cat_parent = 0 " : "AND cat_parent >= 0 ")
				.	"ORDER BY cat_name ASC ");
			$categories = $database->loadObjectList();
			
			// Add parent category name to distinguish categories with same name
			$sql = 'SELECT DISTINCT cat1.cat_name FROM (#__mt_cats AS cat1, #__mt_cats AS cat2) ';
			$sql .= 'WHERE ' . implode( ' AND ', $where_cat ) . ' ';
			$sql .= 'AND cat1.cat_name = cat2.cat_name AND cat1.cat_id != cat2.cat_id ';
			$sql .= 'ORDER BY cat1.cat_name ASC';
			$database->setQuery( $sql );
			$same_name_cats = $database->loadResultArray();
		
			if( count($same_name_cats) > 0 ) {
				$mtcat = new mtCats( $database );
				for( $i=0; $i<count($categories); $i++ ) {
					if( in_array( $categories[$i]->cat_name, $same_name_cats ) ) {
						if( $categories[$i]->cat_parent > 0 ) {
							$categories[$i]->cat_name .= ' (' . $mtcat->getName($categories[$i]->cat_parent) . ')';
						}
					}
				}
			}

		}

		# SQL - Links
		$database->setQuery( $link_sql );
		$links = $database->loadObjectList();

		# Page Navigation
		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total, $limitstart, $mtconf->get('fe_num_of_links') );
	
		# Pathway
		$pathWay = new mtPathWay( 0 );

		# Load custom template
		loadCustomTemplate( $cat_id, $savantConf);

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonListlinksVar( $savant, $links, $pathWay, $pageNav );

		if(!isset($categories)) {
			$savant->assign('categories', array());
		} else {
			$savant->assign('categories', $categories);
		}
		$savant->assign('alpha', urldecode($alpha));
		$savant->display( 'page_listAlpha.tpl.php' );
	} else {
		echo _NOT_EXIST;
	}
}

function listlisting( $cat_id, $option, $task, $limitstart ) {
	global $cache, $database, $mainframe, $_MT_LANG, $mtconf, $Itemid;

	$listListing = new mtListListing( $task );
	$listListing->setLimitStart( $limitstart );
	
	if( $cat_id == 0 ) {
		$database->setQuery( "SELECT cat_name FROM #__mt_cats WHERE cat_id = '".$cat_id."' || cat_parent = '-1' LIMIT 1" );
		$cat_name = $database->loadResult();
	} else {
		$database->setQuery( "SELECT cat_name FROM #__mt_cats WHERE cat_id = '".$cat_id."' LIMIT 1" );
		$cat_name = $database->loadResult();
	}

	$mainframe->setPageTitle( $listListing->getTitle() . $cat_name ); 
	if(in_array($task,array('listnew','listupdated')) && $mtconf->get('show_list' . substr($task,4) . 'rss') ) {
		$mainframe->addCustomHeadTag( '<link rel="alternate" type="application/rss+xml" title="' . $mtconf->getjconf('sitename') . ' - ' . (($task=='listnew')?$_MT_LANG->NEW_LISTING:$_MT_LANG->RECENTLY_UPDATED_LISTING) . '" href="index.php?option=com_mtree&task=rss&type=' . substr($task,4) . '&Itemid=' . $Itemid . '" />' );
	}

	$cache->call( 'listlisting_cache', $cat_id, $option, $listListing );
}

function listlisting_cache( $cat_id, $option, $listListing ) {
	global $database, $_MT_LANG, $savantConf, $Itemid;

	# Retrieve Links
	$listListing->setSubcats( getSubCats_Recursive($cat_id) );

	$database->setQuery( $listListing->getSQL() );
	$links = $database->loadObjectList();

	# Load custom template
	loadCustomTemplate( $cat_id, $savantConf);

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonListlinksVar( $savant, $links, new mtPathWay(), $listListing->getPageNav() );

	$savant->assign('title', $listListing->getHeader());
	$savant->display( 'page_listListings.tpl.php' );
}

function viewowner( $user_id, $limitstart, $option ) {
	global $cache, $database, $_MT_LANG, $mainframe;

	# Get owner's info
	$database->setQuery( "SELECT id, name, username, email FROM #__users WHERE id = '".$user_id."'" );
	$database->loadObject( $owner );
	
	if( count($owner) == 1 ) {
		$mainframe->setPageTitle( sprintf($_MT_LANG->LISTING_BY, $owner->username) );
		$cache->call( 'viewowner_cache', $owner, $limitstart, $option );
	} else {
		echo _NOT_EXIST;
	}

}

function viewowner_cache( $owner, $limitstart, $option ) {
	global $database, $my, $_MT_LANG, $Itemid, $savantConf, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	$user_id = $owner->id;

	if ( $owner ) {

		# Page Navigation
		$database->setQuery("SELECT COUNT(*) FROM #__mt_links WHERE "
			. "\n	link_published='1' AND link_approved='1' AND user_id ='".$user_id."'"
			. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
			);
		$total_links = $database->loadResult();

		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total_links, $limitstart, $mtconf->get('fe_num_of_links') );

		# Retrieve Links
		$database->setQuery( "SELECT l.*, u.username, cat.*, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat)"
			. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
			. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
			. "\n WHERE link_published='1' AND link_approved='1' AND user_id='".$user_id."' "
			. "\n AND l.link_id = cl.link_id AND cl.main = '1'"
			. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
			. "\n AND cl.cat_id = cat.cat_id "
			.	"\n ORDER BY link_featured DESC, l.ordering ASC "
			.	"\n LIMIT $limitstart, " . $mtconf->get('fe_num_of_links') );
		$links = $database->loadObjectList();
		
		# Get total reviews
		$database->setQuery("SELECT COUNT(*) FROM #__mt_reviews AS r"
			.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
			.	"\nWHERE r.user_id = '".$user_id."' AND rev_approved='1' AND l.link_published='1' AND l.link_approved='1'"
			);
		$total_reviews = $database->loadResult();

		# Get total favourites
		$database->setQuery("SELECT COUNT(DISTINCT f.link_id) FROM #__mt_favourites AS f"
			.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = f.link_id"
			.	"\nWHERE f.user_id = '".$user_id."' AND l.link_published='1' AND l.link_approved='1'"
			);
		$total_favourites = $database->loadResult();

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonListlinksVar( $savant, $links, new mtPathWay(), $pageNav );
		$savant->assign('owner', $owner);
		$savant->assign('total_reviews', $total_reviews);
		$savant->assign('total_favourites', $total_favourites);

		$savant->display( 'page_ownerListing.tpl.php' );

	} else {
		echo _NOT_EXIST;
	}
}

function viewusersreview( $user_id, $limitstart, $option ) {
	global $cache, $database, $_MT_LANG, $mainframe, $mtconf;

	# Get owner's info
	$database->setQuery( "SELECT id, name, username, email FROM #__users WHERE id = '".$user_id."'" );
	$database->loadObject( $owner );
	
	if( count($owner) == 1 && $mtconf->get('show_review') ) {
		$mainframe->setPageTitle( sprintf($_MT_LANG->REVIEWS_BY, $owner->username) );
		$cache->call( 'viewusersreview_cache', $owner, $limitstart, $option );
	} else {
		echo _NOT_EXIST;
	}

}

function viewusersreview_cache( $owner, $limitstart, $option ) {
	global $database, $my, $_MT_LANG, $savantConf, $mtconf;

	$user_id = $owner->id;

	if ( $owner ) {

		$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

		# Page Navigation
		$database->setQuery("SELECT COUNT(*) FROM #__mt_reviews AS r"
			.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
			.	"\nWHERE r.user_id = '".$user_id."' AND rev_approved='1' AND l.link_published='1' AND l.link_approved='1'"
			);
		$total_reviews = $database->loadResult();

		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total_reviews, $limitstart, $mtconf->get('fe_num_of_links') );

		# Retrieve reviews
		$database->setQuery( "SELECT DISTINCT r.*, l.*, u.username, log.value AS rating, img.filename AS link_image FROM #__mt_reviews AS r"
			.	"\nLEFT JOIN #__mt_log AS log ON log.user_id = r.user_id AND log.link_id = r.link_id AND log_type = 'vote' AND log.rev_id = r.rev_id"
			.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
			.	"\nLEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1"
			.	"\n LEFT JOIN #__users AS u ON u.id = r.user_id "
			.	"\nWHERE r.user_id = '".$user_id."' AND r.rev_approved = 1 AND l.link_published='1' AND link_approved='1'"
			.	"\nORDER BY r.rev_date DESC"
			.	"\nLIMIT $limitstart, " . $mtconf->get('fe_num_of_links')
			);
		$reviews = $database->loadObjectList();
		
		for( $i=0; $i<count($reviews); $i++ ) {
			$reviews[$i]->rev_text = nl2br(htmlspecialchars(trim($reviews[$i]->rev_text)));
			$reviews[$i]->ownersreply_text = nl2br(htmlspecialchars(trim($reviews[$i]->ownersreply_text)));
		}
		
		# Get total links
		$database->setQuery("SELECT COUNT(*) FROM #__mt_links WHERE "
			. "\n	link_published='1' AND link_approved='1' AND user_id ='".$user_id."'"
			. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
			);
		$total_links = $database->loadResult();

		# Get total favourites
		$database->setQuery("SELECT COUNT(DISTINCT f.link_id) FROM #__mt_favourites AS f"
			.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = f.link_id"
			.	"\nWHERE f.user_id = '".$user_id."' AND l.link_published='1' AND l.link_approved='1'"
			);
		$total_favourites = $database->loadResult();

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonListlinksVar( $savant, $reviews, new mtPathWay(), $pageNav );
		$savant->assign('owner', $owner);
		$savant->assign('reviews', $reviews);
		$savant->assign('total_links', $total_links);
		$savant->assign('total_favourites', $total_favourites);

		$savant->display( 'page_usersReview.tpl.php' );

	} else {
		echo _NOT_EXIST;
	}
}

function viewusersfav( $user_id, $limitstart, $option ) {
	global $cache, $database, $_MT_LANG, $mainframe, $mtconf;

	# Get owner's info
	$database->setQuery( "SELECT id, name, username, email FROM #__users WHERE id = '".$user_id."'" );
	$database->loadObject( $owner );
	
	if( count($owner) == 1 && $mtconf->get('show_favourite')) {
		$mainframe->setPageTitle( sprintf($_MT_LANG->REVIEWS_BY, $owner->username) );
		$cache->call( 'viewusersfav_cache', $owner, $limitstart, $option );
	} else {
		echo _NOT_EXIST;
	}

}

function viewusersfav_cache( $owner, $limitstart, $option ) {
	global $database, $my, $_MT_LANG, $Itemid, $savantConf, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	$user_id = $owner->id;

	if ( $owner ) {

		# Page Navigation
		$database->setQuery("SELECT COUNT(DISTINCT f.link_id) FROM #__mt_favourites AS f "
			.	"\n LEFT JOIN #__mt_links AS l ON l.link_id = f.link_id "
			. "\n WHERE "
			. "\n	l.link_published='1' AND l.link_approved='1' AND f.user_id ='".$user_id."'"
			. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
			);
		$total_favourites = $database->loadResult();

		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total_favourites, $limitstart, $mtconf->get('fe_num_of_links') );

		# Retrieve Links
		$database->setQuery( "SELECT DISTINCT l.*, u.username, cat.*, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat, #__mt_favourites AS f)"
			. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
			. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
			. "\n WHERE link_published='1' AND link_approved='1' AND f.user_id='".$user_id."' AND f.link_id = l.link_id "
			. "\n AND l.link_id = cl.link_id AND cl.main = '1'"
			. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
			. "\n AND cl.cat_id = cat.cat_id "
			.	"\n ORDER BY link_featured DESC, l.ordering ASC "
			.	"\n LIMIT $limitstart, " . $mtconf->get('fe_num_of_links') );
		$links = $database->loadObjectList();
		
		# Get total reviews
		$database->setQuery("SELECT COUNT(*) FROM #__mt_reviews AS r"
			.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
			.	"\nWHERE r.user_id = '".$user_id."' AND rev_approved='1' AND l.link_published='1' AND l.link_approved='1'"
			);
		$total_reviews = $database->loadResult();

		# Get total links
		$database->setQuery("SELECT COUNT(*) FROM #__mt_links WHERE "
			. "\n	link_published='1' AND link_approved='1' AND user_id ='".$user_id."'"
			. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
			. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
			);
		$total_links = $database->loadResult();

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonListlinksVar( $savant, $links, new mtPathWay(), $pageNav );
		$savant->assign('owner', $owner);
		$savant->assign('total_reviews', $total_reviews);
		$savant->assign('total_links', $total_links);

		$savant->display( 'page_usersFavourites.tpl.php' );

	} else {
		echo _NOT_EXIST;
	}
}

/***
* Visit URL
*/

function visit( $link_id ) {
	global $database, $my, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$database->setQuery( "SELECT website FROM #__mt_links"
		.	"\n	WHERE link_published='1' AND link_approved > 0 AND link_id='".$link_id."' " 
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
	);

	$database->loadObject( $link );

	if (empty($link)) {
		
		echo _NOT_EXIST;

	} else {
		
		$mtLog = new mtLog( $database, $mtconf->getjconf('offset'), getenv( 'REMOTE_ADDR' ), $my->id, $link_id );
		$mtLog->logVisit();

		# Update #__mt_links table
		$database->setQuery( "UPDATE #__mt_links "
			.	" SET link_visited = link_visited + 1 "
			.	"WHERE link_id = '$link_id' ");
		if (!$database->query()) {
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( (substr($link->website,0,7) == 'http://' || substr($link->website,0,8) == 'https://') ? $link->website : 'http://'.$link->website );

	}

}

/***
* View Gallery
*/
function viewgallery( $link_id, $option ) {
	global $database, $savantConf, $mainframe, $_MT_LANG;
	
	$link = loadLink( $link_id, $savantConf, $fields, $params );

	if($link === false)	{
		echo _NOT_EXIST;
	} else {

		$mainframe->setPageTitle( sprintf($_MT_LANG->GALLERY2, $link->link_name) );
	
		$database->setQuery('SELECT img_id, filename FROM #__mt_images WHERE link_id = \'' . $link_id . '\' ORDER BY ordering ASC');
		$images = $database->loadObjectList();
		
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
		$savant->assign('images', $images);
		$savant->display( 'page_gallery.tpl.php' );
	}	
}

/***
* View Image
*/
function viewimage( $img_id, $option ) {
	global $database, $savantConf, $mainframe, $_MT_LANG;
	
	$database->setQuery('SELECT img_id, link_id, filename, ordering from #__mt_images WHERE img_id = \'' . $img_id . '\' LIMIT 1');
	$database->loadObject($image);
	
	if(isset($image) && $image->link_id > 0) {
		$link = loadLink( $image->link_id, $savantConf, $fields, $params );
	} else {
		$link = false;
	}

	if($link === false)	{
		echo _NOT_EXIST;
	} else {
		$database->setQuery('SELECT img_id, filename FROM #__mt_images WHERE link_id = \'' . $image->link_id . '\' ORDER BY ordering ASC');
		$images = $database->loadObjectList();

		// $mainframe->setPageTitle( sprintf($_MT_LANG->GALLERY2, $link->link_name) );

		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
		$savant->assign('image', $image);
		$savant->assign('images', $images);
		$savant->display( 'page_image.tpl.php' );
	}	
}

/***
* View Listing
*/
function viewlink( $link_id, $limitstart, $option ) {
	global $cache, $savantConf, $mainframe, $_MT_LANG, $mtconf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	
	if($link === false)	{
		echo _NOT_EXIST;
	} else {
	
		# Set Page Title
		$mainframe->setPageTitle( html_entity_decode_utf8($link->link_name) ); 

		# Add META tags
		if ($mtconf->getjconf('MetaTitle')=='1') {
			$mainframe->addMetaTag( 'title' , $link->link_name );
		}
		if ($mtconf->getjconf('MetaAuthor')=='1') {
			$mainframe->addMetaTag( 'author' , $link->owner );
		}

		if ($link->metadesc <> '') $mainframe->prependMetaTag( 'description', $link->metadesc );
		if ($link->metakey <> '') $mainframe->prependMetaTag( 'keywords', $link->metakey );

		$mainframe->addCustomHeadTag(' <script src="'.$mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library') . '" type="text/javascript"></script>');
		$mainframe->addCustomHeadTag(' <script src="'.$mtconf->getjconf('live_site').'/components/com_mtree/js/vote.js" type="text/javascript"></script>');

		# Predefine variables:
		$prevar = " <script type=\"text/javascript\"><!-- \n";
		$prevar .= "jQuery.noConflict();\n";
		$prevar .= "var mosConfig_live_site=\"".$mtconf->getjconf('live_site')."\";\n";
		$prevar .= "var indexphp=\"index" . ((defined('JVERSION'))?'':'2') . ".php\";\n";
		$prevar .= "var langRateThisListing=\"".$_MT_LANG->RATE_THIS_LISTING."\";\n";
		$prevar .= "var ratingText=new Array();\n";
		$prevar .= "ratingText[5]=\"".$_MT_LANG->RATING_5."\";\n";
		$prevar .= "ratingText[4]=\"".$_MT_LANG->RATING_4."\";\n";
		$prevar .= "ratingText[3]=\"".$_MT_LANG->RATING_3."\";\n";
		$prevar .= "ratingText[2]=\"".$_MT_LANG->RATING_2."\";\n";
		$prevar .= "ratingText[1] =\"".$_MT_LANG->RATING_1."\";\n";
		$prevar .= "//--></script>";
		$mainframe->addCustomHeadTag($prevar);
	
		$cache->call( 'viewlink_cache', $link, $limitstart, $fields, $params, $option );
	}
}

function viewlink_cache( $link, $limitstart, $fields, $params, $option ) {
	global $database, $my, $_MT_LANG, $savantConf, $Itemid, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	$link_id = $link->link_id;
	
	if ( !isset($link->link_id) || $link->link_id <= 0 ) {
		echo _NOT_EXIST;
	} else {

		# Increase 1 hit
		$cookiename = "mtlink_hit$link->link_id";
		$visited = mosGetParam( $_COOKIE, $cookiename, '0' );
		
		if (!$visited) {
			$database->setQuery( "UPDATE #__mt_links SET link_hits=link_hits+1 WHERE link_id='".$link_id."'" );
			$database->query();
		}

		setcookie( $cookiename, '1', time()+$mtconf->get('hit_lag') );
	
		# Get reviews
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reviews AS r WHERE link_id = '".$link_id."' AND r.rev_approved = 1" );
		$total_reviews = $database->loadResult();
		$database->setQuery( "SELECT DISTINCT r.*, u.username, log.value AS rating FROM #__mt_reviews AS r"
			.	"\n LEFT JOIN #__users AS u ON u.id = r.user_id"
			.	"\n LEFT JOIN #__mt_log AS log ON log.user_id = r.user_id AND log.link_id = r.link_id AND log_type = 'vote' AND log.rev_id = r.rev_id"
			.	"\n WHERE r.link_id = '".$link_id."' AND r.rev_approved = 1 ORDER BY " . $mtconf->get('first_review_order1') . ' ' . $mtconf->get('first_review_order2') . ', ' . $mtconf->get('second_review_order1') . ' ' . $mtconf->get('second_review_order2') . ', ' . $mtconf->get('third_review_order1') . ' ' . $mtconf->get('third_review_order2')
			.	"\n LIMIT $limitstart, " . $mtconf->get('fe_num_of_reviews')
			);
		$reviews = $database->loadObjectList();

		# Add <br /> to all new lines & gather an array of review_ids
		for( $i=0; $i<count($reviews); $i++ ) {
			$reviews[$i]->rev_text = nl2br(htmlspecialchars(trim($reviews[$i]->rev_text)));
			$reviews[$i]->ownersreply_text = nl2br(htmlspecialchars(trim($reviews[$i]->ownersreply_text)));
		}
		
		# If the user is logged in, get all voted rev_ids
		if( $my->id > 0 ) {
			$database->setQuery( 'SELECT value, rev_id FROM #__mt_log WHERE log_type = \'votereview\' AND user_id = \''.$my->id.'\' AND link_id = \''.$link_id.'\' LIMIT '.$total_reviews );
			$voted_reviews = $database->loadObjectList( 'rev_id' );
		} else {
			$voted_reviews = array();
		}
		# Get image ids
		$database->setQuery("SELECT img_id AS id, filename FROM #__mt_images WHERE link_id = '" . $link_id . "' ORDER BY ordering ASC");
		$images = $database->loadObjectList();
		
		# Page Navigation
		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total_reviews, $limitstart, $mtconf->get('fe_num_of_reviews') );

		# Pathway
		$pathWay = new mtPathWay( $link->cat_id );

		# Mambots
		global $_MAMBOTS;
		$page = 0;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$mtconf->set('show_rating',$params->def( 'show_rating', $mtconf->get('show_rating') ));
		$mtconf->set('show_review',$params->def( 'show_review', $mtconf->get('show_review') ));
		
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
		
		$savant->assign('pageNav', $pageNav);
		$savant->assign('my', $my);
		$savant->assign('reviews', $reviews);
		$savant->assign('images', $images);
		$savant->assign('voted_reviews', $voted_reviews);
		$savant->assign('total_reviews', ((isset($total_reviews)) ? $total_reviews : 0 ));
		$savant->assign('user_report_review',$mtconf->get('user_report_review'));
		
		if( $my->id > 0 && $mtconf->get('user_vote_review') == 1 ) {
			$savant->assign('show_review_voting', 1);
		} else {
			$savant->assign('show_review_voting', 0);
		}
		$savant->assign('user_report_review',$mtconf->get('user_report_review'));
		$savant->display( 'page_listing.tpl.php' );

	}
}

function printlink( $link_id, $option ) {
	global $database, $_MAMBOTS, $_MT_LANG, $savantConf, $Itemid, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	$link = loadLink( $link_id, $savantConf, $fields, $params );

	if (empty($link)) {
		echo _NOT_EXIST;
	} else {

		$page = 0;

		# Get image ids
		$database->setQuery("SELECT img_id AS id, filename FROM #__mt_images WHERE link_id = '" . $link_id . "' ORDER BY ordering ASC");
		$images = $database->loadObjectList();

		# Pathway
		$pathWay = new mtPathWay( $link->cat_id );

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
		$savant->assign('images', $images);

		$savant->display( 'page_print.tpl.php' );

	}
}

/***
* Report Listing
*/
function report( $link_id, $option ) {
	global $cache, $_MT_LANG, $mainframe, $savantConf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	$mainframe->setPageTitle( $_MT_LANG->REPORT2 . $link->link_name );

	$cache->call( 'report_cache', $link, $fields, $params, $option );
}

function report_cache( $link, $fields, $params, $option ) {
	global $database, $savantConf, $my, $_MT_LANG, $mtconf;

	# Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

	if ( empty($link) || $mtconf->get('user_report') == '-1' ) {
		echo _NOT_EXIST;
	} elseif ( $mtconf->get('user_report') == 1 && $my->id < 1 ) {
		# User is not logged in
		$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_REPORT);
		$savant->display( 'page_errorListing.tpl.php' );
	} else {
		$savant->assign('validate', josSpoofValue());
		$savant->display( 'page_report.tpl.php' );
	}

}

function send_report( $link_id, $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	if ( $mtconf->get('show_report') == 0 ) {
		echo _NOT_EXIST;
	} elseif ( $mtconf->get('user_report') == '-1' || ($mtconf->get('user_report') == 1 && $my->id  < 1) ) {
		# User is not logged in
		echo _NOT_EXIST;
	} else {

		$link = new mtLinks( $database );
		$link->load( $link_id );

		$your_name = trim( mosGetParam( $_POST, 'your_name', '' ) );
		$report_type = trim( mosGetParam( $_POST, 'report_type', '' ) );
		$report_type2 = "REPORT_PROBLEM_".$report_type;

		$message = trim( mosGetParam( $_POST, 'message', '' ) );
		$text = sprintf( $_MT_LANG->REPORT_EMAIL, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$link_id&Itemid=$Itemid"), (($my->id>0)?$my->username:$your_name), $_MT_LANG->$report_type2, $link_id, $message);

		$subject = $_MT_LANG->REPORT." - ".$mtconf->getjconf('sitename');

		mosMailToAdmin( $subject, $text );

		if( $my->id > 0 )  {
			# User is logged on, store user ID
			$database->setQuery( "INSERT INTO #__mt_reports "
				.	"( `link_id` , `user_id` , `subject` , `comment`, created ) "
				.	"VALUES ($link_id, $my->id, '".$_MT_LANG->$report_type2."', '".$message."', '".date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 )."')");
			
		} else {
			# User is not logged on, store Guest name
			$database->setQuery( "INSERT INTO #__mt_reports "
				.	"( `link_id` , `guest_name` , `subject` , `comment`, created ) "
				.	"VALUES ($link_id, '".$your_name."', '".$_MT_LANG->$report_type2."', '".$message."', '".date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 )."')");

		}
		
		if (!$database->query()) {
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->REPORT_HAVE_BEEN_SENT);
	}

}

/***
* Report Listing
*/
function claim( $link_id, $option ) {
	global $cache, $_MT_LANG, $mainframe, $savantConf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	$mainframe->setPageTitle( $_MT_LANG->CLAIM_LISTING .": ". $link->link_name );

	$cache->call( 'claim_cache', $link, $fields, $params, $option );
}

function claim_cache( $link, $fields, $params, $option ) {
	global $database, $_MAMBOTS, $_MT_LANG, $savantConf, $Itemid, $my, $mainframe, $mtconf;

	$page = 0;
	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	# Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

	if ( $my->id <= 0 ) {
		
		# User is not logged in
		$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_CLAIM);
		$savant->display( 'page_errorListing.tpl.php' );

	} elseif( $mtconf->get('show_claim') == 0 || empty($link) ) {
		
		echo _NOT_EXIST;

	} else {

		$savant->display( 'page_claim.tpl.php' );

	}
}

function send_claim( $link_id, $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;

	if ( $mtconf->get('show_claim') == 0 || $my->id <= 0 ) {
		
		echo _NOT_EXIST;

	} else {

		$link = new mtLinks( $database );
		$link->load( $link_id );

		$message = trim( mosGetParam( $_POST, 'message', '' ) );
		$text = sprintf( $_MT_LANG->CLAIM_EMAIL, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$link_id&Itemid=$Itemid"), $link->link_name, $link_id, $message);

		$subject = $_MT_LANG->CLAIM." - ".$mtconf->getjconf('sitename');

		mosMailToAdmin( $subject, stripslashes ($text) );

		# User is logged on, store user ID
		$database->setQuery( "INSERT INTO #__mt_claims "
			.	"( `link_id` , `user_id` , `comment`, `created` ) "
			.	"VALUES ($link_id, $my->id, '".$message."', '".date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 )."')");
		
		if (!$database->query()) {
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->CLAIM_HAVE_BEEN_SENT );
	}

}

/***
* Delete Listing
*/
function deletelisting( $link_id, $option ) {
	global $database, $savantConf, $_MT_LANG, $Itemid, $my, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$link = loadLink( $link_id, $savantConf, $fields, $params );

	if ($mtconf->get('user_allowdelete') && $my->id == $link->user_id && $my->id > 0 ) {

		# Pathway
		$pathWay = new mtPathWay( $link->cat_id );

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

		$savant->display( 'page_confirmDelete.tpl.php' );

	} else {
		echo _NOT_EXIST;
	}

}

function confirmdelete( $link_id, $option ) {
	global $database, $my, $_MT_LANG, $mtconf;
	// $mt_user_allowdelete, $mt_notifyadmin_delete, $mt_admin_email, 

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$database->setQuery( "SELECT * FROM #__mt_links WHERE "
		.	"\n	link_published='1' AND link_approved > 0 AND link_id='".$link_id."'" 
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		);
	$database->loadObject( $link );

	if ($mtconf->get('user_allowdelete') && $my->id == $link->user_id && $my->id > 0 ) {
		
		$link = new mtLinks( $database );
		$link->load( $link_id );

		if ( $mtconf->get('notifyadmin_delete') == 1 ) {

			// Get owner's email
			$database->setQuery( "SELECT email FROM #__users WHERE id = '".$my->id."' LIMIT 1" );
			$my_email = $database->loadResult();

			$subject = $_MT_LANG->ADMIN_NOTIFY_DELETE_SUBJECT;
			$body = sprintf($_MT_LANG->ADMIN_NOTIFY_DELETE_MSG, $link->link_name, $link->link_name, $link->link_id, $my->username, $my_email, $link->link_created);

			mosMailToAdmin( $subject, $body );
			
		}
		
		$link->updateLinkCount( -1 );
		$link->delLink();

		mosRedirect( "index.php?option=$option&task=viewowner&user_id=".$my->id."&Itemid=$Itemid", $_MT_LANG->LISTING_HAVE_BEEN_DELETED );

	} else {
		echo _NOT_EXIST;
	}

}

/***
* Review
*/
function writereview( $link_id, $option ) {
	global $cache, $_MT_LANG, $mainframe, $savantConf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	$mainframe->setPageTitle( $_MT_LANG->REVIEW ." ". $link->link_name );
	
	$cache->call( 'writereview_cache', $link, $fields, $params, $option );
}

function writereview_cache( $link, $fields, $params, $option ) {
	global $database, $_MAMBOTS, $_MT_LANG, $savantConf, $Itemid, $my, $mainframe, $mtconf;
	
	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	if (empty($link) || $mtconf->get('show_review') == 0) {
		echo _NOT_EXIST;
	} else {

		$page = 0;

		# Pathway
		$pathWay = new mtPathWay( $link->cat_id );

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
		
		$user_rev = null;
		$user_rating = 0;
		if( $my->id > 0 ) {
			
			# Check if this user has reviewed this listing previously
			$database->setQuery( "SELECT rev_id FROM #__mt_reviews WHERE link_id = '".$link->link_id."' AND user_id = '".$my->id."'" );
			$user_rev = $database->loadObjectList();

			# Check if this user has voted for this listing previously
			$database->setQuery( "SELECT value FROM #__mt_log WHERE link_id = '".$link->link_id."' AND user_id = '".$my->id."' AND log_type = 'vote' LIMIT 1" );
			$user_rating = $database->loadResult();
		}

		if ( count($user_rev) > 0 &&  $mtconf->get('user_review_once') == '1') {
			# This user has already reviewed this listing
			$savant->assign('error_msg', $_MT_LANG->YOU_CAN_ONLY_REVIEW_ONCE);
			$savant->display( 'page_errorListing.tpl.php' );
		} elseif ( $mtconf->get('user_review') == 1 && $my->id < 1 ) {
			# User is not logged in
			$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_REVIEW);
			$savant->display( 'page_errorListing.tpl.php' );
		} elseif ( $mtconf->get('user_review') == 2 && $my->id > 0 && $my->id == $link->user_id ) {
			# Listing owners are not allowed to review
			$savant->assign('error_msg', $_MT_LANG->YOU_ARE_NOT_ALLOWED_TO_REVIEW);
			$savant->display( 'page_errorListing.tpl.php' );
		} elseif( $mtconf->get('allow_owner_review_own_listing') == 0 && $my->id == $link->user_id ) {
			# Owner is trying to review own listing
			$savant->assign('error_msg', $_MT_LANG->YOU_RE_NOT_ALLOWED_TO_REVIEW_OWN_LISTING);
			$savant->display( 'page_errorListing.tpl.php' );
		} else {
			# OK. User is allowed to review
			$savant->assign('validate', josSpoofValue());
			$savant->assign('user_rating', (($user_rating>0)?$user_rating:0));
			$savant->display( 'page_writeReview.tpl.php' );

		}

	}
}

function addreview( $link_id, $option ) {
	global $database, $_MT_LANG, $savantConf, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	# Get the review text
	$rev_text = trim( mosGetParam( $_POST, 'rev_text', '' ) );
	$rev_title = trim( strip_tags(mosGetParam( $_POST, 'rev_title', '' )) );
	$guest_name = trim( strip_tags(mosGetParam( $_POST, 'guest_name', '' )) );

	$link = loadLink( $link_id, $savantConf, $fields, $params );

	if( 
		$mtconf->get('user_rating') == '-1' 
		|| 
		($mtconf->get('user_rating') == 1 && $my->id <= 0) 
		||
		($mtconf->get('user_rating') == 2 && $my->id > 0 && $my->id == $link->user_id )
		||
		$mtconf->get('allow_rating_during_review') == 0
	) {
		$rating = 0;
	} else {
		$rating = intval( mosGetParam( $_POST, 'rating', 0 ) );
	}

	$user_rev = array();
	if( $my->id > 0 ) {
		# Check if this user has reviewed this listing previously
		$database->setQuery( "SELECT rev_id FROM #__mt_reviews WHERE link_id = '".$link->link_id."' AND user_id = '".$my->id."' LIMIT 1" );
		$user_rev = $database->loadObjectList();
	} elseif ( $my->id == 0 && $mtconf->get('user_review') == 0 ) {
		# Check log if this user's IP has been used to review this listing before
		$database->setQuery( "SELECT rev_id FROM #__mt_log WHERE link_id = '".$link->link_id."' AND log_ip = '".getenv( 'REMOTE_ADDR' )."' AND log_type = 'review' LIMIT 1" );
		$user_rev = $database->loadObjectList();
	}
	
	if ( count($user_rev) > 0 &&  $mtconf->get('user_review_once') == '1') {
		# Pathway
		$pathWay = new mtPathWay( $link->cat_id );

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
		
		# This user has already reviewed this listing
		$savant->assign('error_msg', $_MT_LANG->YOU_CAN_ONLY_REVIEW_ONCE);
		$savant->display( 'page_errorListing.tpl.php' );

	} elseif( $mtconf->get('allow_owner_review_own_listing') == 0 && $my->id == $link->user_id ) {
		# Owner is trying to review own listing
		$savant->assign('error_msg', $_MT_LANG->YOU_RE_NOT_ALLOWED_TO_REVIEW_OWN_LISTING);
		$savant->display( 'page_errorListing.tpl.php' );

	} elseif (empty($link) || $mtconf->get('show_review') == 0) {
		# Link does not exists, is not published or Show Review is disabled
		echo _NOT_EXIST;

	} elseif ( 
		$mtconf->get('user_review') == '-1' 
		|| 
		($mtconf->get('user_review') == 1 && $my->id  < 1) 
		|| 
		($mtconf->get('user_review') == 2 && $my->id  > 0 && $my->id == $link->user_id) 
		) {
		# Not accepting review / User is not logged in / Listing owners are not allowed to review
		echo _NOT_EXIST;

	} elseif ( $rev_text == '' ) {
		# Review text is empty
		echo "<script> alert('".$_MT_LANG->PLEASE_FILL_IN_REVIEW."'); window.history.go(-1); </script>\n";
		exit();
		
	} elseif ( $rev_title == '' ) {
		# Review title is empty
		echo "<script> alert('".$_MT_LANG->PLEASE_FILL_IN_TITLE."'); window.history.go(-1); </script>\n";
		exit();
		
	} elseif ( 
		$rating == 0 
		&&
		$mtconf->get('require_rating_with_review') 
		&&
		$mtconf->get('allow_rating_during_review') 
		&&
		(
			$mtconf->get('user_rating') == '0'
			||
			($mtconf->get('user_rating') == '1' && $my->id > 0)
			||
			($mtconf->get('user_rating') == '2' && $my->id > 0 && $my->id != $link->user_id)
		)
		
	) {
		# No rating given
		echo "<script> alert('".$_MT_LANG->PLEASE_FILL_IN_RATING."'); window.history.go(-1); </script>\n";
		exit();

	} else {
		# Everything is ok, add the review
		$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
		
		if ( $mtconf->get('needapproval_addreview') == 1 ) {
			$rev_approved = 0;
		} else {
			$rev_approved = 1;
		}

		if ( $my->id > 0 ) {

			# User is logged on, store user ID
			$database->setQuery( "INSERT INTO #__mt_reviews "
				.	"( `link_id` , `user_id` , `rev_title` , `rev_text` , `rev_date` , `rev_approved` ) "
				.	"VALUES ($link_id, $my->id, '".$rev_title."', '".$rev_text."', '$now', '$rev_approved')");

		} else {

			# User is not logged on, store Guest name
			$database->setQuery( "INSERT INTO #__mt_reviews "
				.	"( `link_id` , `guest_name` , `rev_title` , `rev_text` , `rev_date` , `rev_approved` ) "
				.	"VALUES ($link_id, '".$guest_name."', '".$rev_title."', '".$rev_text."', '$now', '$rev_approved')");

		}

		if (!$database->query()) {
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}
		$rev_id = $database->insertid();

		$mtLog = new mtLog( $database, $mtconf->getjconf('offset'), getenv( 'REMOTE_ADDR' ), $my->id, $link_id, $rev_id );
		$mtLog->logReview();

		if( $rating > 0 ) {

			$users_last_rating = $mtLog->getUserLastRating();

			# User has voted before. 
			# This review will update his vote and recalculate the listing rating while maintaining the number of votes.
			if( $mtconf->get('rate_once') && $users_last_rating > 0 ) {
				if($rating <> $users_last_rating) {
					$new_rating = ((($link->link_rating * $link->link_votes) + ($rating-$users_last_rating) ) / $link->link_votes);
					# Update the new rating
					$database->setQuery( "UPDATE #__mt_links SET link_votes = link_votes + 1, link_rating = '$new_rating' WHERE link_id = '$link_id' ");
					if (!$database->query()) {
						echo "<script> alert('".$database->stderr()."');</script>\n";
						exit();
					}
				}
				$mtLog->deleteVote();

			# User has not voted before. Simply add a new vote for the listing.
			} else {

				$new_rating = ((($link->link_rating * $link->link_votes) + $rating) / ++$link->link_votes);

				# Update #__mt_links table
				$database->setQuery( "UPDATE #__mt_links "
					.	" SET link_rating = '$new_rating', link_votes = '$link->link_votes' "
					.	"WHERE link_id = '$link_id' ");
				if (!$database->query()) {
					echo "<script> alert('".$database->stderr()."');</script>\n";
					exit();
				}

			}

			$mtLog->logVote( $rating );
		}

		# Notify Admin
		if ( $mtconf->get('notifyadmin_newreview') == 1 ) {
			
			$database->setQuery( "SELECT * FROM #__mt_links WHERE link_id = '".$link_id."' LIMIT 1" );
			$database->loadObject($link);
			
			if ( $my->id > 0 ) {
				$database->setQuery( "SELECT name, username, email FROM #__users WHERE id = '".$my->id."' LIMIT 1" );
				$database->loadObject( $author );
				$author_name = $author->name;
				$author_username = $author->username;
				$author_email = $author->email;
			} else {
				$author_name = $guest_name;
				$author_username = $_MT_LANG->GUEST;
				$author_email = '';
			}

			if ( $rev_approved == 0 ) {
				$subject = sprintf($_MT_LANG->NEW_REVIEW_EMAIL_SUBJECT_WAITING_APPROVAL, $link->link_name);
				$msg = sprintf($_MT_LANG->ADMIN_NEW_REVIEW_MSG_WAITING_APPROVAL, $link->link_name, $rev_title, $author_name, $author_username, $author_email, stripslashes(html_entity_decode($rev_text)));
			} else {
				$subject = sprintf($_MT_LANG->NEW_REVIEW_EMAIL_SUBJECT_APPROVED, $link->link_name);
				$msg = sprintf($_MT_LANG->ADMIN_NEW_REVIEW_MSG_APPROVED, $link->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$link_id&Itemid=$Itemid"), $rev_title, $author_name, $author_username, $author_email, stripslashes(html_entity_decode($rev_text)));
			}

			mosMailToAdmin( $subject, $msg );

		}

		if ( $mtconf->get('needapproval_addreview') == 1 ) {
			mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->REVIEW_WILL_BE_REVIEWED );
		} else {
			mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->REVIEW_HAVE_BEEN_SUCCESSFULLY_ADDED );
		}

	}
}

/***
* Rating
*/
function rate( $link_id, $option ) {
	global $cache, $mainframe, $_MT_LANG, $savantConf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	$mainframe->setPageTitle( $_MT_LANG->RATE . $link->link_name );

	$cache->call( 'rate_cache', $link, $fields, $params, $option );

}

function rate_cache( $link, $fields, $params, $option ) {
	global $database, $_MAMBOTS, $_MT_LANG, $savantConf, $Itemid, $my, $mainframe, $mtconf, $REMOVE_ADDR;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	# User IP Address
	$vote_ip = getenv( 'REMOTE_ADDR' );

	if (empty($link)) {
		echo _NOT_EXIST;
	} else {

		$page = 0;

		# Pathway
		$pathWay = new mtPathWay( $link->cat_id );

		# Savant Template
		$savant = new Savant2($savantConf);
		assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

		# Check if this user has voted before
		if ( $my->id == 0 ) {
			$database->setQuery( "SELECT log_date FROM #__mt_log WHERE link_id ='".$link->link_id."' AND log_ip = '".$vote_ip."' AND log_type = 'vote'" );
		} else {
			$database->setQuery( "SELECT log_date FROM #__mt_log WHERE link_id ='".$link->link_id."' AND user_id = '".$my->id."' AND log_type = 'vote'" );
		}
		
		$voted = false;
		$voted = ($database->loadResult() <> '') ? true : false;

		if ( $mtconf->get('user_rating') == '1' && $my->id < 1) {
			# Error. Please login before you can vote
			$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_RATE);
			$savant->display( 'page_errorListing.tpl.php' );
			
		} elseif( $mtconf->get('user_rating') == '2' && $my->id > 0 && $my->id == $link->user_id ) {
			# Error. Listing owner is not allow to rate
			$savant->assign('error_msg', $_MT_LANG->YOU_ARE_NOT_ALLOWED_TO_RATE);
			$savant->display( 'page_errorListing.tpl.php' );

		} elseif ( $voted && $mtconf->get('rate_once') == '1') {
			# This user has already voted this listing
			$savant->assign('error_msg', $_MT_LANG->YOU_CAN_ONLY_RATE_ONCE);
			$savant->display( 'page_errorListing.tpl.php' );

		} elseif( $mtconf->get('allow_owner_rate_own_listing') == 0 && $my->id == $link->user_id ) {
			# Owner is trying to vote own listing
			$savant->assign('error_msg', $_MT_LANG->YOU_RE_NOT_ALLOWED_TO_RATE_OWN_LISTING);
			$savant->display( 'page_errorListing.tpl.php' );

		} else {
			# OK. User is logged in
			$savant->display( 'page_rating.tpl.php' );

		}

	}
}

function addrating( $link_id, $option ) {
	global $database, $no_html, $_MT_LANG;

	# Get the rating
	$rating = intval( mosGetParam( $_POST, 'rating', 0 ) );

	$result = saverating( $link_id, $rating );

	if( $result ) {
		if( $no_html ) {
			$database->setQuery( "SELECT link_votes FROM #__mt_links WHERE link_id = '".$link_id."' LIMIT 1" );
			$total_votes = $database->loadResult();
			echo $_MT_LANG->THANKS_FOR_RATING . '|' . $total_votes . ' ' . strtolower($_MT_LANG->VOTES);
		} else {
			mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->RATING_HAVE_BEEN_SUCCESSFULLY_ADDED );
		}
	} else {
		if( $no_html ) {
			echo 'NA';
		} else {
			mosRedirect ( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->YOU_CAN_ONLY_RATE_ONCE );
		}
	}

}

function saverating( $link_id, $rating ) {
	global $database, $_MT_LANG, $savantConf, $Itemid, $my, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$database->setQuery( "SELECT * FROM #__mt_links WHERE "
		.	"\n	link_published='1' AND link_approved > 0 AND link_id='".$link_id."'" 
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		);
	$database->loadObject( $link );

	# User IP Address
	$vote_ip = getenv( 'REMOTE_ADDR' );

	if (empty($link)) {
		# Link does not exists, or is not published
		echo _NOT_EXIST;
		return false;

	} elseif ( $mtconf->get('user_rating') == '1' && $my->id < 1) {
		# User is not logged in
		echo _NOT_EXIST;
		return false;

	} elseif ( $mtconf->get('user_rating') == '2' && $my->id > 0 && $my->id == $link->user_id ) {
		# Listing owners are not allowed to rate
		echo $_MT_LANG->YOU_ARE_NOT_ALLOWED_TO_RATE;
		return false;
		
	} elseif ( $rating == 0 || $rating > 5 ) {
		# Invalid rating. User did not fill in rating, or attempt misuse
		echo $_MT_LANG->PLEASE_SELECT_A_RATING;
		return false;
		
	} elseif( $mtconf->get('allow_owner_rate_own_listing') == 0 && $my->id == $link->user_id ) {
		# Owner is trying to vote own listing
		echo $_MT_LANG->YOU_RE_NOT_ALLOWED_TO_RATE_OWN_LISTING;

	} else {

		# Everything is ok, add the rating
		$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

		if ( $my->id < 1 ) $my->id = 0;

		# Check if this user has voted before
		if ( $my->id == 0 ) {
			$database->setQuery( "SELECT log_date FROM #__mt_log WHERE link_id ='".$link_id."' AND log_ip = '".$vote_ip."' AND log_type = 'vote'" );
		} else {
			$database->setQuery( "SELECT log_date FROM #__mt_log WHERE link_id ='".$link_id."' AND user_id = '".$my->id."' AND log_type = 'vote'" );
		}
		
		$voted = false;
		$voted = ($database->loadResult() <> '') ? true : false;
		
		if ( !$voted || ($voted && !$mtconf->get('rate_once')) ) {

			$mtLog = new mtLog( $database, $mtconf->getjconf('offset'), $vote_ip, $my->id, $link_id );
			$mtLog->logVote( $rating );

			$new_rating = ((($link->link_rating * $link->link_votes) + $rating) / ++$link->link_votes);

			# Update #__mt_links table
			$database->setQuery( "UPDATE #__mt_links "
				.	" SET link_rating = '$new_rating', link_votes = '$link->link_votes' "
				.	"WHERE link_id = '$link_id' ");
			if (!$database->query()) {
				/*echo "<script> alert('".$database->stderr()."');</script>\n";*/
				echo $database->stderr();
				exit();
				return false;
			}

			return true;

		} else {
			return false;
		}

	}

}

function fav( $link_id, $action, $option ) {
	global $database, $no_html, $_MT_LANG;

	$result = savefav( $link_id, $action, $option );

	if( $result ) {
		if( $no_html ) {
			$database->setQuery( "SELECT COUNT(*) FROM #__mt_favourites WHERE link_id = '".$link_id."'" );
			$total_fav = $database->loadResult();
			if( !is_numeric($total_fav) || $total_fav < 0 ) {
				$total_fav = 0;
			}
			if( $action == 1 ) {
				echo $_MT_LANG->ADDED_AS_FAVOURITE . '|' . $total_fav;
			} else {
				echo $_MT_LANG->FAVOURITE_REMOVED . '|' . $total_fav;
			}
		}
	} else {
		echo 'NA';
	}
}

function savefav( $link_id, $action ) {
	global $database, $_MT_LANG, $savantConf, $Itemid, $my, $mtconf;

	if($mtconf->get('show_favourite') == 0) {
		return false;
	}

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	if ( $my->id < 1 ) $my->id = 0;

	$database->setQuery( "SELECT * FROM #__mt_links WHERE "
		.	"\n	link_published='1' AND link_approved > 0 AND link_id='".$link_id."'" 
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		);
	$database->loadObject( $link );

	$database->setQuery( "SELECT COUNT(*) FROM #__mt_favourites WHERE user_id = '".$my->id."' AND link_id = '".$link_id."' LIMIT 1" );
	if( $action == 1 ) {
		# If user is adding a favourite, make sure the link has not been added to the user's favourite before
		if( $database->loadResult() > 0 ) {
			return false;
		}
	} else {
		# If user is removing a favourite, make sure he has the favourite
		if( $database->loadResult() < 1 ) {
			return false;
		}
	}

	# User IP Address
	$vote_ip = getenv( 'REMOTE_ADDR' );

	if (empty($link)) {
		# Link does not exists, or is not published
		echo _NOT_EXIST;
		return false;

	} elseif ( $my->id < 1) {
		# User is not logged in
		echo _NOT_EXIST;
		return false;
	
	} elseif ( $action != -1 && $action != 1 ) {
		echo _NOT_EXIST;
		return false;
		
	} else {

		# Everything is ok, add the rating

		$mtLog = new mtLog( $database, $mtconf->getjconf('offset'), $vote_ip, $my->id, $link_id );
		$mtLog->logFav($action);

		# Add favourite
		if( $action == 1 ) {
			$database->setQuery( "INSERT INTO #__mt_favourites "
				.	"(`user_id`, `link_id`, `fav_date`) "
				.	"VALUES ( "
				.	"'" . $my->id . "',"
				.	"'" . $link_id . "',"
				.	"'" . $now . "'"
				.	")");
		} else {
			$database->setQuery( "DELETE FROM #__mt_favourites WHERE user_id = '" . $my->id . "' AND link_id = '" . $link_id . "' LIMIT 1" );
		}
		if (!$database->query()) {
			echo $database->stderr();
			return false;
		}

		return true;

	}

}

/***
* Vote Review - Process the vote and redirect to the listing with message
* @param int review id
* @param int review vote. 1 = helpful, -1 = not helpful
* @param string option
*/
// todo add global var to toggle usage of 'helpful reviews'
function votereview( $rev_id, $rev_vote, $option ) {
	global $database, $_MT_LANG, $Itemid, $no_html;

	$database->setQuery( "SELECT * FROM #__mt_reviews WHERE rev_approved='1' AND rev_id='".$rev_id."' LIMIT 1" );
	$database->loadObject( $review );
	$result = savevotereview( $review, $rev_vote, $option );
	
	if( $result ) {
		if( $no_html ) {
			$return = sprintf( $_MT_LANG->PEOPLE_FIND_THIS_REVIEW_HELPFUL, (($rev_vote == 1)? $review->vote_helpful +1:$review->vote_helpful), ($review->vote_total +1) );
			//$return .= '|'.(($rev_vote == 1)? $_MT_LANG->YES:$_MT_LANG->NO);
			$return .= '|'.$_MT_LANG->THANKS_FOR_YOUR_VOTE;
			
			echo $return;
		} else {
			mosRedirect( "index.php?option=$option&task=viewlink&link_id=".$review->link_id."&Itemid=$Itemid", $_MT_LANG->REVIEW_RATING_HAVE_BEEN_SUCCESSFULLY_ADDED );
		}
	} else {
		if( $no_html ) {
			echo 'NA';
		} else {
			mosRedirect ( "index.php?option=$option&task=viewlink&link_id=".$review->link_id."&Itemid=$Itemid", $_MT_LANG->YOU_CAN_ONLY_RATE_ONCE_FOR_EVERY_REVIEW );
		}
	}

}

/**
* Save the vote review to database
* @param object review object
* @param int review vote. 1 = helpful, -1 = not helpful
* @param string option
* @return TRUE=save is successful, FALSE=save is not successful or vote has been recorded in the past
*/
function savevotereview( $review, $rev_vote, $option ) {
	global $database, $my, $mtconf;

	# User IP Address
	$vote_ip = getenv( 'REMOTE_ADDR' );

	if (empty($review)) {
		# Review does not exists, or is not published
		echo _NOT_EXIST;
		return false;

	} elseif ( $mtconf->get('user_vote_review') == '0' ) {
		# Feature has been disabled
		echo _NOT_EXIST;
		return false;

	} elseif( $my->id < 1) {
		# User is not logged in
		echo _NOT_EXIST;
		return false;

	} elseif ( $rev_vote <> -1 && $rev_vote <> 1 ) {
		# Invalid review vote. User did not fill in rating, or attempt misuse
		echo _NOT_EXIST;
		return false;
		
	} else {

		# Everything is ok, add the rating
		$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

		if ( $my->id < 1 ) $my->id = 0;

		# Check if this user has voted before
		if ( $my->id == 0 ) {
			$database->setQuery( "SELECT log_date FROM #__mt_log WHERE rev_id ='".$review->rev_id."' AND log_ip = '".$vote_ip."' AND log_type = 'votereview'" );
		} else {
			$database->setQuery( "SELECT log_date FROM #__mt_log WHERE rev_id ='".$review->rev_id."' AND user_id = '".$my->id."' AND log_type = 'votereview'" );
		}
		
		$voted = false;
		$voted = ($database->loadResult() <> '') ? true : false;
		
		if ( !$voted ) {

			# Update #__mt_log table
			$database->setQuery( "INSERT INTO #__mt_log "
				.	"( `log_ip` , `log_type`, `user_id` , `log_date` , `link_id`, `rev_id`, `value` )"
				.	"VALUES ( '$vote_ip', 'votereview', '$my->id', '$now', '$review->link_id', '$review->rev_id', '".( ($rev_vote == -1) ? '-1':'1' )."')");
			if (!$database->query()) {
				echo $database->stderr();
				return false;
			}

			# Update review
			$database->setQuery( 'UPDATE #__mt_reviews '
				. 'SET vote_total = vote_total + 1' . ( ($rev_vote == 1) ? ', vote_helpful = vote_helpful + 1 ':' ' )
				. 'WHERE rev_id = \''.$review->rev_id.'\' LIMIT 1'
				);
			if (!$database->query()) {
				echo $database->stderr();
				return false;
			}

			return true;

		} else {
			return false;
		}

	}

}

/***
* Report Review
*/
function reportreview( $rev_id, $option ) {
	global $database, $cache, $_MT_LANG, $mainframe, $savantConf, $mtconf, $my;
	
	if( $mtconf->get('user_report_review') == -1 || ($mtconf->get('user_report_review') == 1 && $my->id == 0) ) {
		echo _NOT_EXIST;
	} else {
		$database->setQuery( "SELECT r.*, u.username, l.value AS rating FROM #__mt_reviews AS r "
			.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
			.	"\nLEFT JOIN #__mt_log AS l ON l.user_id = r.user_id AND l.link_id = r.link_id AND log_type = 'vote'"
			.	"\nWHERE r.rev_id = '".$rev_id."' LIMIT 1" );
		$database->loadObject( $review );

		if( $review->link_id > 0 ) {

			$link = loadLink( $review->link_id, $savantConf, $fields, $params );
			$mainframe->setPageTitle( $_MT_LANG->REPORT_REVIEW . ': ' . $review->rev_title );

			$cache->call( 'reportreview_cache', $review, $link, $fields, $params, $option );
	
		} else {
			echo _NOT_EXIST;
		}
	}
}

function reportreview_cache( $review, $link, $fields, $params, $option ) {
	global $database, $savantConf;

	# Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

	$savant->assign('review', $review);

	if (empty($link)) {
		echo _NOT_EXIST;
	} else {
		$savant->assign('validate', josSpoofValue());
		$savant->display( 'page_reportReview.tpl.php' );
	}

}

function send_reportreview( $rev_id, $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	if( $mtconf->get('user_report_review') == -1 || ($mtconf->get('user_report_review') == 1 && $my->id == 0) ) {
		
		echo _NOT_EXIST;

	} else {

		$database->setQuery( "SELECT l.link_id, rev_title, rev_text, l.link_name FROM #__mt_reviews AS r "
			. "\n LEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
			. "\n WHERE rev_id ='".$rev_id."' AND r.rev_approved = 1 AND l.link_published = 1 AND l.link_approved = 1" 
			. "\n LIMIT 1"
			);
		$database->loadObject( $link );

		if( count($link) == 1 && $link->link_id > 0 ) {
			
			if( $my->id > 0 ) {
				$database->setQuery( "SELECT name, username FROM #__users WHERE id = '".$my->id."' LIMIT 1" );
				$database->loadObject( $my_user );
				$your_name = $my_user->name.' ('.$my_user->username.')';
			} else {
				$your_name = trim( mosGetParam( $_POST, 'your_name', '' ) );
			}

			$message = trim( mosGetParam( $_POST, 'message', '' ) );
			$text = sprintf( $_MT_LANG->REPORT_REVIEW_EMAIL, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$link->link_id&Itemid=$Itemid"), $your_name, $message, $link->rev_title, $link->link_name, $link->rev_text, $link->rev_text );

			$subject = $_MT_LANG->REPORT_REVIEW." - ".$link->rev_title;

			mosMailToAdmin( $subject, $text );

			if( $my->id > 0 )  {
				# User is logged on, store user ID
				$database->setQuery( "INSERT INTO #__mt_reports "
					.	"( `link_id` , `rev_id` , `user_id` , `comment`, created ) "
					.	"VALUES ($link->link_id, $rev_id, $my->id, '".$message."', '".date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 )."')");
				
			} else {
				# User is not logged on, store Guest name
				$database->setQuery( "INSERT INTO #__mt_reports "
					.	"( `link_id` , `rev_id` , `guest_name` , `comment`, created ) "
					.	"VALUES ($link->link_id, $rev_id, '".$your_name."', '".$message."', '".date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 )."')");

			}
			
			if (!$database->query()) {
				echo "<script> alert('".$database->stderr()."');</script>\n";
				exit();
			}

			mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link->link_id&Itemid=$Itemid", $_MT_LANG->REPORT_HAVE_BEEN_SENT);

		}

	}

}

/***
* Reply Review
*/
function replyreview( $rev_id, $option ) {
	global $database, $cache, $_MT_LANG, $mainframe, $savantConf, $my, $mtconf;

	$database->setQuery( "SELECT r.*, u.username, l.value AS rating FROM #__mt_reviews AS r "
		.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
		.	"\nLEFT JOIN #__mt_log AS l ON l.user_id = r.user_id AND l.link_id = r.link_id AND log_type = 'vote'"
		.	"\nWHERE r.rev_id = '".$rev_id."' LIMIT 1" );
	$database->loadObject( $review );
	
	# Replying review are restricted to the listing owner only.
	if( isset($review) && $review->link_id > 0 && $my->id > 0 && $mtconf->get('owner_reply_review') ) {

		$link = loadLink( $review->link_id, $savantConf, $fields, $params );

		if( $link->user_id == $my->id ) {
			$mainframe->setPageTitle( $_MT_LANG->REPLY_REVIEW . ': ' . $review->rev_title );
			$cache->call( 'replyreview_cache', $review, $link, $fields, $params, $option );
		} else {
			echo _NOT_EXIST;
		}

	} else {
		echo _NOT_EXIST;
	}
}

function replyreview_cache( $review, $link, $fields, $params, $option ) {
	global $database, $savantConf, $_MT_LANG;

	# Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

	$savant->assign('review', $review);

	if (empty($link)) {
		echo _NOT_EXIST;
	} elseif ( !empty($review->ownersreply_text) ) {
		$savant->assign('error_msg', $_MT_LANG->YOU_CAN_ONLY_REPLY_A_REVIEW_ONCE);
		$savant->display( 'page_errorListing.tpl.php' );
	} else {
		$savant->display( 'page_replyReview.tpl.php' );
	}

}

function send_replyreview( $rev_id, $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;
	
	$message = trim( mosGetParam( $_POST, 'message', '' ) );

	if ( !$mtconf->get('owner_reply_review') ) {

		echo _NOT_EXIST;

	} else {

		if ( $message == '' ) {
			# Reply text is empty
			echo "<script> alert('".$_MT_LANG->PLEASE_FILL_IN_REPLY."'); window.history.go(-1); </script>\n";
			exit();
		}

		if ( $mtconf->get('needapproval_replyreview') == 1 ) {
			$rr_approved = 0;
		} else {
			$rr_approved = 1;
		}

		$database->setQuery( "SELECT l.link_id, l.user_id AS link_owner_user_id, rev_title, rev_text, l.link_name, r.ownersreply_text FROM #__mt_reviews AS r "
			. "\n LEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
			. "\n WHERE rev_id ='".$rev_id."' AND r.rev_approved = 1 AND l.link_published = 1 AND l.link_approved = 1" 
			. "\n LIMIT 1"
			);
		$database->loadObject( $link );

		if( count($link) == 1 && empty($link->ownersreply_text) && $link->link_id > 0 && $my->id > 0 && $link->link_owner_user_id == $my->id ) {

			$database->setQuery( "UPDATE #__mt_reviews SET ownersreply_text = '" . $message . "', ownersreply_date = '" . date( 'Y-m-d H:i:s', time() + $mtconf->getjconf('offset') * 60 * 60 ) . "', ownersreply_approved = '" . $rr_approved . "' WHERE rev_id = '" . $rev_id . "'" );
			
			if (!$database->query()) {
				echo "<script> alert('".$database->stderr()."');</script>\n";
				exit();
			}

			$mtLog = new mtLog( $database, $mtconf->getjconf('offset'), getenv( 'REMOTE_ADDR' ), $my->id, $link->link_id, $rev_id );
			$mtLog->logReplyReview();
			
			# Notify Admin
			if ( $my->id > 0 ) {
				$database->setQuery( "SELECT name, username, email FROM #__users WHERE id = '".$my->id."' LIMIT 1" );
				$database->loadObject( $author );
				$author_name = $author->name;
				$author_username = $author->username;
				$author_email = $author->email;
			} else {
				$author_name = $guest_name;
				$author_username = $_MT_LANG->GUEST;
				$author_email = '';
			}

			if ( $rr_approved == 0 ) {
				$subject = sprintf($_MT_LANG->NEW_REVIEW_REPLY_EMAIL_SUBJECT_WAITING_APPROVAL, $link->link_name);
				$msg = sprintf( $_MT_LANG->ADMIN_NEW_REVIEW_REPLY_MSG_WAITING_APPROVAL, $my->name, $message, $link->rev_title, $link->link_name, $link->rev_text, $link->rev_text );
			} else {
				$subject = sprintf($_MT_LANG->NEW_REVIEW_REPLY_EMAIL_SUBJECT_APPROVED, $link->link_name);
				$msg = sprintf( $_MT_LANG->ADMIN_NEW_REVIEW_REPLY_MSG_APPROVED, $my->name, $message, $link->rev_title, $link->link_name, $link->rev_text, $link->rev_text );
			}

			mosMailToAdmin( $subject, $msg );

			if ( $mtconf->get('needapproval_replyreview') == 1 ) {
				mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link->link_id&Itemid=$Itemid", $_MT_LANG->REPLY_REVIEW_WILL_BE_REVIEWED);
			} else {
				mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link->link_id&Itemid=$Itemid", $_MT_LANG->REPLY_REVIEW_HAVE_BEEN_SUCCESSFULLY_ADDED);
			}

		} else {

			echo _NOT_EXIST;

		}
	}

}

/***
* Recommend to Friend
*/

function recommend( $link_id, $option ) {
	global $cache, $_MT_LANG, $mainframe, $savantConf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	$mainframe->setPageTitle( $_MT_LANG->RECOMMEND ." ". $link->link_name );

	$cache->call( 'recommend_cache', $link, $fields, $params, $option );

}

function recommend_cache( $link, $fields, $params, $option ) {
	global $database, $_MAMBOTS, $_MT_LANG, $savantConf, $Itemid, $my, $mainframe, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$page = 0;

	# Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );

	if (empty($link)) {
		echo _NOT_EXIST;

	} elseif ( $mtconf->get('user_recommend') == '1' && $my->id < 1 ) {
		# Error. Please login before you can recommend
		$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_RECOMMEND);
		$savant->display( 'page_errorListing.tpl.php' );

	} else {
		$savant->assign('validate', josSpoofValue());
		$savant->display( 'page_recommend.tpl.php' );
	}

}

function send_recommend( $link_id, $option ) {
	global $_MT_LANG, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	if ( $mtconf->get('show_recommend') == 0 || ($mtconf->get('user_recommend') == '1' && $my->id < 1) ) {
		echo _NOT_EXIST;

	} else {

		$your_name = trim( mosGetParam( $_POST, 'your_name', '' ) );
		$your_email = trim( mosGetParam( $_POST, 'your_email', '' ) );
		$friend_name = trim( mosGetParam( $_POST, 'friend_name', '' ) );
		$friend_email = trim( mosGetParam( $_POST, 'friend_email', '' ) );

		if (!$your_email || !$friend_email || (is_email($your_email)==false) || (is_email($friend_email)==false) ){
			echo "<script>alert (\"".$_MT_LANG->YOU_MUST_ENTER_VALID_EMAIL."\"); window.history.go(-1);</script>";
			exit(0);
		}

		$msg = sprintf( $_MT_LANG->RECOMMEND_MSG,
			$mtconf->getjconf('sitename'),
			$your_name,
			$your_email,
			sefRelToAbs('index.php?option=com_mtree&task=viewlink&link_id='.$link_id.'&Itemid='.$Itemid)
			);

		$subject = sprintf($_MT_LANG->RECOMMEND_SUBJECT, $your_name);

		mosMail( $your_email, $your_name, $friend_email, $subject, wordwrap($msg) );

		mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", sprintf($_MT_LANG->RECOMMEND_EMAIL_HAVE_BEEN_SENT, $friend_name) );
	}

}

/***
* Contact Owner
*/

function contact( $link_id, $option ) {
	global $cache, $_MT_LANG, $mainframe, $savantConf;

	$link = loadLink( $link_id, $savantConf, $fields, $params );
	$mainframe->setPageTitle( $_MT_LANG->CONTACT2 . $link->link_name );

	$cache->call( 'contact_cache', $link, $fields, $params, $option );

}

function contact_cache( $link, $fields, $params, $option ) {
	global $database, $_MAMBOTS, $_MT_LANG, $savantConf, $Itemid, $my, $mtconf;

	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
	$page = 0;

	# Pathway
	$pathWay = new mtPathWay( $link->cat_id );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonViewlinkVar( $savant, $link, $fields, $pathWay, $params );
	$savant->assign('validate', josSpoofValue());

	if (
		empty($link)
		OR
		$mtconf->get( 'show_contact' ) == 0
		OR
		$mtconf->get( 'use_owner_email' ) == 0 && empty($link->email)
	) {
		echo _NOT_EXIST;

	} elseif ( $mtconf->get('user_contact') == '1' && $my->id < 1 ) {
		# Error. Please login before you can contact the owner
		$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_CONTACT);
		$savant->display( 'page_errorListing.tpl.php' );

	} else {
		$savant->display( 'page_contactOwner.tpl.php' );
	}

}

function send_contact( $link_id, $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	$link = new mtLinks( $database );
	$link->load( $link_id );

	if ( 
		$mtconf->get('show_contact') == 0 
		OR
		($mtconf->get('user_contact') == '1' && $my->id < 1)
		OR
		$mtconf->get( 'use_owner_email' ) == 0 && empty($link->email)
	) {
		echo _NOT_EXIST;

	} else {

		$your_name = trim( mosGetParam( $_POST, 'your_name', '' ) );
		$your_email = trim( mosGetParam( $_POST, 'your_email', '' ) );
		$message = sprintf( $_MT_LANG->CONTACT_MESSAGE, $your_name, $your_email, $link->link_name, sefReltoAbs("index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid"), trim( mosGetParam( $_POST, 'message', '' ) ) );

		if (!$your_email || (is_email($your_email)==false) ){
			echo "<script>alert (\"".$_MT_LANG->YOU_MUST_ENTER_VALID_EMAIL."\"); window.history.go(-1);</script>";
			exit(0);
		}

		$subject = sprintf($_MT_LANG->CONTACT_SUBJECT, $mtconf->getjconf('sitename'), $link->link_name);
		
		if( empty($link->email) ) {
			$database->setQuery( 'SELECT email FROM #__users WHERE id = '.$link->user_id.' LIMIT 1' );
			$email = $database->loadResult();
		} else {
			$email = $link->email;
		}

		mosMail( $your_email, $your_name, $email, $subject, wordwrap($message) );

		mosRedirect( "index.php?option=$option&task=viewlink&link_id=$link_id&Itemid=$Itemid", $_MT_LANG->CONTACT_EMAIL_HAVE_BEEN_SENT);
	}

}

function is_email($email){
	$rBool=false;

	if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){
		$rBool=true;
	}
	return $rBool;
}

/***
* Edit Listing
*/
function editlisting( $link_id, $option ) {
	global $database, $_MT_LANG, $savantConf, $Itemid, $my, $mainframe, $mtconf;

	require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mfields.class.php' );

	# Get cat_id if user is adding new listing. 
	$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );

	// This var retrieve the link_id for adding listing
	$link_id_passfromurl = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );

	if ( $link_id_passfromurl > 0 && $cat_id == 0 ) {
		$database->setQuery( "SELECT cat_id FROM (#__mt_links AS l, #__mt_cl AS cl) WHERE l.link_id ='".$link_id_passfromurl."' AND cl.link_id = l.link_id" );
		$cat_id = $database->loadResult();
	}

	$link = new mtLinks( $database );

	# Do not allow Guest to edit listing
	if ( $link_id > 0 && $my->id <= 0 ) {
		$link->load( 0 );
	} else {
		$link->load( $link_id );
		// if ( $link_id == 0 ) $link->website = "http://";
		// $link->link_name = htmlspecialchars($link->link_name);
	}

	# Load all published CORE & custom fields
	$sql = "SELECT cf.*, cfv.link_id, cfv.value AS value, cfv.attachment, ft.ft_class FROM #__mt_customfields AS cf "
		.	"\nLEFT JOIN #__mt_cfvalues AS cfv ON cf.cf_id=cfv.cf_id AND cfv.link_id = " . $link_id
		.	"\nLEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type=cf.field_type"
		.	"\nWHERE cf.hidden ='0' AND cf.published='1' ORDER BY ordering ASC";
	$database->setQuery($sql);

	$fields = new mFields();
	$fields->setCoresValue( $link->link_name, $link->link_desc, $link->address, $link->city, $link->state, $link->country, $link->postcode, $link->telephone, $link->fax, $link->email, $link->website, $link->price, $link->link_hits, $link->link_votes, $link->link_rating, $link->link_featured, $link->link_created, $link->link_modified, $link->link_visited, $link->publish_up, $link->publish_down, $link->metakey, $link->metadesc, $link->user_id, '' );
	$fields->loadFields($database->loadObjectList());
	
	# Load images
	$database->setQuery( "SELECT img_id, filename FROM #__mt_images WHERE link_id = '" . $link_id . "' ORDER BY ordering ASC" );
	$images = $database->loadObjectList();
	
	# Get current category's template
	$database->setQuery( "SELECT cat_name, cat_parent, cat_template, metakey, metadesc FROM #__mt_cats WHERE cat_id='".$cat_id."' AND cat_published='1' LIMIT 1" );
	$database->loadObject( $cat );
	
	if( $cat ) {
		$mainframe->setPageTitle( sprintf($_MT_LANG->ADD_LISTING2, $cat->cat_name) );
	} else {
		$mainframe->setPageTitle( $_MT_LANG->ADD_LISTING );
	}

	if ( isset($cat->cat_template) && $cat->cat_template <> '' ) {
		loadCustomTemplate(null,$savantConf,$cat->cat_template);
	}

	# Get other categories
	$database->setQuery( "SELECT cl.cat_id FROM #__mt_cl AS cl WHERE cl.link_id = '$link_id' AND cl.main = '0'");
	$other_cats = $database->loadResultArray();

	# Pathway
	$pathWay = new mtPathWay( $cat_id );
	$pw_cats = $pathWay->getPathWayWithCurrentCat( $cat_id );
	$pathWayToCurrentCat = '';
	$mtCats = new mtCats($database);
	$pathWayToCurrentCat = ' <a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&Itemid=".$Itemid).'">'.$_MT_LANG->ROOT."</a>";
	foreach( $pw_cats AS $pw_cat ) {
		$pathWayToCurrentCat .= $_MT_LANG->ARROW .' <a href="'.sefRelToAbs("index.php?option=com_mtree&task=listcats&cat_id=".$pw_cat."&Itemid=".$Itemid).'">'.$mtCats->getName($pw_cat)."</a>";
	}

	# Savant Template
	$savant = new Savant2($savantConf);

	assignCommonVar($savant);
	$savant->assign('pathway', $pathWay);
	$savant->assign('pathWayToCurrentCat',$pathWayToCurrentCat);
	$savant->assign('cat_id', (($link_id == 0) ? $cat_id : $link->cat_id ) );
	$savant->assign('other_cats', $other_cats );
	$savant->assignRef('link', $link);
	$savant->assignRef('fields',$fields);
	$savant->assignRef('images',$images);

	# Check permission
	if ( ($mtconf->get('user_addlisting') == 1 && $my->id < 1) || ($link_id > 0 && $my->id == 0) ) {

		$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_ADDLISTING);
		$savant->display( 'page_error.tpl.php' );
	
	} elseif( ($link_id > 0 && $my->id <> $link->user_id) || ($mtconf->get('user_allowmodify') == 0 && $link_id > 0) || ($mtconf->get('user_addlisting') == -1 && $link_id == 0) || ($mtconf->get('user_addlisting') == 1 && $my->id == 0) ) {
		
		echo _NOT_EXIST;

	} else {
	# OK, you can edit
		/*
		// Get custom field's caption
		$database->setQuery( "SELECT  CONCAT( 'cust_', cf_id ) AS name, caption AS value FROM #__mt_customfield" );
		$savant->assign('custom_fields', $database->loadObjectList('name'));

		// Get custom field's data
		foreach( $savant->custom_fields AS $cf ) {
			$database->setQuery( "SELECT $cf->name FROM #__mt_links WHERE link_id = '$link_id' LIMIT 1" );
			$val = $database->loadResult();
			if (isset($val)) {
				$savant->custom_data[$cf->name] = $val;
			} else {
				$savant->custom_data[$cf->name] = '';
			}
		}
		*/
		/*
		for($i=0;$i<30;$i++) {
			$val = $mtconf->get('cust_'.($i+1));
			if( !empty($val) ) {
				$savant->custom_data['cust_'.($i+1)] = $val;
			} else {
				$savant->custom_data['cust_'.($i+1)] = '';
			}
		}
		*/
		
		$database->setQuery( "SELECT CONCAT('cust_',cf_id) as varname, caption As value, field_type, prefix_text_mod, suffix_text_mod FROM #__mt_customfields WHERE hidden <> '1' AND published = '1'" );
		$custom_fields = $database->loadObjectList('varname');
		$savant->assign('custom_fields', $custom_fields);

		# Load custom fields' value from #__mt_cfvalues to $link
		$database->setQuery( "SELECT CONCAT('cust_',cf_id) as varname, value FROM #__mt_cfvalues WHERE link_id = '".$link_id."'" );
		$cfvalues = $database->loadObjectList('varname');

		foreach( $custom_fields as $cfkey => $value )
		{
			if( isset($cfvalues[$cfkey]) ) {
				$savant->custom_data[$cfkey] = $cfvalues[$cfkey]->value;
			} else {
				$savant->custom_data[$cfkey] = '';
			}
		}

		// Get category's tree
		if($mtconf->get('allow_changing_cats_in_addlisting')) {
			getCatsSelectlist( $cat_id, $cat_tree, 1 );
			if ( $cat_id > 0 ) {
				$cat_options[] = mosHTML::makeOption( $cat->cat_parent, $_MT_LANG->ARROW_BACK );
			}
			
			if( $mtconf->get('allow_listings_submission_in_root') ) {
				$cat_options[] = mosHTML::makeOption( "0", $_MT_LANG->ROOT );
			}
			if(count($cat_tree)>0) {
				foreach( $cat_tree AS $ct ) {
					if( $ct["cat_allow_submission"] == 1 ) {
						$cat_options[] = mosHTML::makeOption( $ct["cat_id"], str_repeat("&nbsp;",($ct["level"]*3)) .(($ct["level"]>0) ? " -":''). $ct["cat_name"] );
					} else {
						$cat_options[] = mosHTML::makeOption( ($ct["cat_id"]*-1), str_repeat("&nbsp;",($ct["level"]*3)) .(($ct["level"]>0) ? " -":''). "(".$ct["cat_name"].")" );
					}
				}
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				$catlist = mosHTML::selectList( $cat_options, "new_cat_id", 'size=8 class="text_area" id="browsecat"', 'value', 'text', "" );
			} elseif( $GLOBALS['_VERSION']->RELEASE == '1.5' ) {
				$catlist = mosHTML::selectList( $cat_options, "new_cat_id", 'size=8 class="text_area"', 'value', 'text', "", 'browsecat' );
			}
			$savant->assignRef('catlist', $catlist );
		}
		
		// Give warning is there is already a pending approval for modification.
		if ( $link_id > 0 ) {
			$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_approved = '".(-1*$link_id)."'" );
			if ( $database->loadResult() > 0 ) {
				$savant->assign('warn_duplicate', 1);
			} else {
				$savant->assign('warn_duplicate', 0);
			}
		}
		$savant->assign('pathWay', $pathWay);
		$savant->assign('validate', josSpoofValue());
		$savant->display( 'page_addListing.tpl.php' );
	}
}

function savelisting( $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/mfields.class.php' );
	require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/tools.mtree.php' );

	# Get cat_id / remove_image / link_image
	$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );
	// $new_cat_id = intval( mosGetParam( $_POST, 'new_cat_id', 0 ) );
	$other_cats = explode(',', mosGetParam( $_POST, 'other_cats', '' ));

	# Check if any malicious user is trying to submit link
	if ( ($mtconf->get('user_addlisting') == 1 && $my->id < 1) || $mtconf->get('user_addlisting') == -1 ) {
		
		echo _NOT_EXIST;

	} else {
	# Allowed
		
		$row = new mtLinks( $database );
		if (!@$row->bind( $_POST )) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		
		// if ( $new_cat_id <> $row->cat_id AND $new_cat_id > 0 ) {
		// 	$row->cat_id = $new_cat_id;
		// }

		$isNew = ($row->link_id < 1) ? 1 : 0;

		# Assignment for new record
		if ($isNew) {

			$row->link_created = date( 'Y-m-d H:i:s', time() + ( $mtconf->getjconf('offset') * 60 * 60 ) );
			$row->ordering = 999;

			if ( $my->id > 0) {
				$row->user_id = $my->id;
			} else {
				$database->setQuery( "SELECT id FROM #__users WHERE usertype = 'Super Administrator' LIMIT 1" );
				$row->user_id = $database->loadResult();
			}

			// Approval for adding listing
			if ( $mtconf->get('needapproval_addlisting') ) {
				$row->link_approved = '0';
			} else {
				$row->link_approved = 1;
				$row->link_published = 1;
				mosCache::cleanCache( 'com_mtree' );
				$row->updateLinkCount( 1 );
			}

		# Modification to existing record
		} else {
			
			# Validate that this user is the rightful owner
			$database->setQuery( "SELECT user_id FROM #__mt_links WHERE link_id = '".$row->link_id."'" );
			$user_id = $database->loadResult();

			if (  $user_id <> $my->id ) {
				echo _NOT_EXIST;;
			} else {

				// Get the name of the old photo and last modified date
				$sql="SELECT link_id, link_modified, link_created FROM #__mt_links WHERE link_id='".$row->link_id."'";
				$database->setQuery($sql);
				$database->loadObject($old);

				// $old_image = $old->link_image;

				// Retrive last modified date
				$old_modified = $old->link_modified;
				$link_created = $old->link_created;

				$row->link_published = 1;
				$row->user_id = $my->id;
				
				// Get other info from original listing
				$database->setQuery( "SELECT link_desc, link_hits, link_votes, link_rating, link_featured, link_created, link_visited, ordering, publish_down, publish_up, attribs, internal_notes FROM #__mt_links WHERE link_id = '$row->link_id'" );
				$database->loadObject( $original );
				$original_link_id = $row->link_id;
				
				$row->link_modified = $row->getLinkModified( $original_link_id, $_POST );

				foreach( $original AS $k => $v ) {
					if( in_array($k,array('link_hits', 'link_votes', 'link_rating', 'link_featured', 'link_created', 'link_visited', 'ordering', 'publish_down', 'publish_up', 'attribs', 'internal_notes')) ) {
						$row->$k = $v;
					}
				}
				
				// Remove any listing that is waiting for approval for this listing
				$database->setQuery( 'SELECT link_id FROM #__mt_links WHERE link_approved = \''.(-1*$row->link_id).'\' LIMIT 1' );
				$tmp_pending_link_id = $database->loadResult();
				if( $tmp_pending_link_id > 0 ) {
					$database->setQuery( "DELETE FROM #__mt_cfvalues WHERE link_id = '".$tmp_pending_link_id."'" );
					$database->query();
					$database->setQuery( "DELETE FROM #__mt_cfvalues_att WHERE link_id = '".$tmp_pending_link_id."'" );
					$database->query();
					$database->setQuery( "DELETE FROM #__mt_links WHERE link_id = '".$tmp_pending_link_id."' LIMIT 1" );
					$database->query();
					$database->setQuery( "DELETE FROM #__mt_cl WHERE link_id = '".$tmp_pending_link_id."'" );
					$database->query();
					$database->setQuery( "SELECT filename FROM #__mt_images WHERE link_id = '".$tmp_pending_link_id."'" );
					$tmp_pending_images = $database->loadResultArray();
					if(count($tmp_pending_images)) {
						foreach($tmp_pending_images AS $tmp_pending_image) {
							unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $tmp_pending_image);
							unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $tmp_pending_image);
							unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $tmp_pending_image);
						}
					}
					$database->setQuery( "DELETE FROM #__mt_images WHERE link_id = '".$tmp_pending_link_id."'" );
					$database->query();
				}				
				// Approval for modify listing
				if ( $mtconf->get('needapproval_modifylisting') ) {
					$row->link_approved = (-1 * $row->link_id);
					$row->link_id = null;
				} else {
					$row->link_approved = 1;
					mosCache::cleanCache( 'com_mtree' );
					
					// Get old state (approved, published)
					$database->setQuery( "SELECT cat_id FROM #__mt_cl AS cl WHERE link_id ='".$row->link_id."' AND main = 1 LIMIT 1" );
					$database->loadObject( $old_state );
					if($row->cat_id <> $old_state->cat_id) {
						$row->updateLinkCount( 1 );
						$row->updateLinkCount( -1, $old_state->cat_id );
					}
				}

			}

		} // End of $isNew

		# Load field type
		$database->setQuery('SELECT cf_id, field_type, hidden, published FROM #__mt_customfields');
		$fieldtype = $database->loadObjectList('cf_id');
		$hidden_cfs = array();
		foreach($fieldtype AS $ft) {
			if($ft->hidden && $ft->published) {
				$hidden_cfs[] = $ft->cf_id;
			}
		}

		# Erase Previous Records, make way for the new data
		$sql="DELETE FROM #__mt_cfvalues WHERE link_id='".$row->link_id."' AND attachment <= 0";
		if(count($hidden_cfs)>0) {
			$sql .= " AND cf_id NOT IN (" . implode(',',$hidden_cfs) . ")";
		}
		$database->setQuery($sql);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

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
				
		# OK. Store new or updated listing into database
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		} else {
			if( !$isNew && $row->link_id > 0 ) {
				// Find if there are any additional categories assigned to the listinig
				if( $original_link_id <> $row->link_id ) {
					$database->setQuery( 'SELECT DISTINCT cat_id FROM #__mt_cl WHERE link_id = \''.$original_link_id.'\' and main=\'0\' ' );
					$tmp_cats = $database->loadResultArray();
					if( count($tmp_cats)>0 ){
						foreach( $tmp_cats AS $tmp_cat_id ) {
							$database->setQuery( 'INSERT INTO #__mt_cl (`link_id`,`cat_id`,`main`) VALUES(\''.$row->link_id.'\',\''.$tmp_cat_id.'\',\'0\')');
							$database->query();
						}
					}
					unset($tmp_cats);
				}
			}
		}

		# Update "Also appear in these categories" aka other categories
		if($mtconf->get('allow_user_assign_more_than_one_category')) {
			$mtCL = new mtCL_main0( $database );
			$mtCL->load( $row->link_id );
			$mtCL->update( $other_cats );
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
		
		if(!$isNew && isset($keep_att_ids) && count($keep_att_ids)>0 && $mtconf->get('needapproval_modifylisting')) {
			$database->setQuery('INSERT INTO #__mt_cfvalues_att (link_id,cf_id,filename,filedata,filesize,extension) '
				.	"\nSELECT '" . $row->link_id . "',cf_id,filename,filedata,filesize,extension FROM #__mt_cfvalues_att WHERE link_id = '" . $original_link_id . "' AND cf_id IN ('" . implode("','",$keep_att_ids) . "')");
			$database->query();
			$database->setQuery('INSERT INTO #__mt_cfvalues (cf_id,link_id,value,attachment) '
				.	"\nSELECT cf_id,'" . $row->link_id . "',value,attachment FROM #__mt_cfvalues WHERE link_id = '" . $original_link_id . "' AND cf_id IN ('" . implode("','",$keep_att_ids) . "')");
			$database->query();
			
		}

		foreach($_FILES AS $k => $v) {
			if ( substr($k,0,2) == "cf" && is_numeric(substr($k,2)) && $v['error'] == 0 ) {
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
				$database->query();

				$sql = "INSERT INTO #__mt_cfvalues (`cf_id`, `link_id`, `value`, `attachment`)"
					. "\nVALUES ('".$cf_id."', '".$row->link_id."', '".$database->getEscaped($file['name'])."','1')";
				$database->setQuery($sql);
				$database->query();
			}
		}
		
		if($mtconf->get('allow_imgupload')) {
			$redirectMsg = '';
			if(is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_small_image')) && is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_medium_image')) && is_writable($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_original_image'))) {
			
				$keep_img_ids = mosGetParam( $_POST, 'keep_img', null );
		
				if(!$isNew && count($keep_img_ids)>0 && $mtconf->get('needapproval_modifylisting')) {
					foreach($keep_img_ids AS $keep_img_id) {
						$database->setQuery("SELECT * FROM #__mt_images WHERE link_id = '" . $original_link_id . "' AND img_id = '" . $keep_img_id . "' LIMIT 1");
						$database->loadObject($original_image);
						$file_extension = pathinfo($original_image->filename);
						$file_extension = strtolower($file_extension['extension']);
					
						$database->setQuery('INSERT INTO #__mt_images (link_id,filename,ordering) '
							.	"\n VALUES ('" . $row->link_id . "', '" . $original_image->filename . '_' . $row->link_id . "', '" . $original_image->ordering . "')");
						$database->query();
						// $new_img_id = $database->insertid();
						$new_img_ids[$keep_img_id] = $database->insertid();
						$database->setQuery("UPDATE #__mt_images SET filename = '" . $new_img_ids[$keep_img_id] .  '_' . $row->link_id . '.' . $file_extension . "' WHERE img_id = '" . $new_img_ids[$keep_img_id] . "' LIMIT 1");
						$database->query();
						copy( $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $original_image->filename, $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $new_img_ids[$keep_img_id] .  '_' . $row->link_id . '.' . $file_extension );
						copy( $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $original_image->filename, $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $new_img_ids[$keep_img_id] .  '_' . $row->link_id . '.' . $file_extension );
						copy( $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $original_image->filename, $mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $new_img_ids[$keep_img_id] .  '_' . $row->link_id . '.' . $file_extension );
					
						// $database->setQuery('INSERT INTO #__mt_images (link_id,filename,small_filedata,small_filesize,medium_filedata,medium_filesize,original_filedata,original_filesize,extension,ordering) '
						// 	.	"\nSELECT '" . $row->link_id . "',filename,small_filedata,small_filesize,medium_filedata,medium_filesize,original_filedata,original_filesize,extension,ordering FROM #__mt_images WHERE link_id = '" . $original_link_id . "' AND img_id = '" . $keep_img_id . "'");
						// $database->query();
					}
				}
		
				# Remove all images except those that are kept when modification does not require approval
				$image_filenames = array();
				if(!$mtconf->get('needapproval_modifylisting')) {
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
				}
				if(count($image_filenames)) {
					foreach($image_filenames AS $image_filename) {
						unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_small_image') . $image_filename);
						unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_medium_image') . $image_filename);
						unlink($mtconf->getjconf('absolute_path') . $mtconf->get('relative_path_to_listing_original_image') . $image_filename);
					}
				}

				if( isset($_FILES['image']) ) {
					for($i=0;$i<count($_FILES['image']['name']) && ($i<($mtconf->get('images_per_listing') - count($keep_img_ids)) || $mtconf->get('images_per_listing') == '0');$i++) {
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
		
				$img_sort_hash = mosGetParam( $_POST, 'img_sort_hash', null );
				if(!empty($img_sort_hash)) {
					$arr_img_sort_hashes = split("[&]*upload_att\[\]=img_\d*", $img_sort_hash);
					$i=1;
					foreach($arr_img_sort_hashes AS $arr_img_sort_hash) {
						if(!empty($arr_img_sort_hash) && $arr_img_sort_hash > 0) {
							$sql = "UPDATE #__mt_images SET ordering = '" . $i . "' WHERE img_id = '";
							if(isset($new_img_ids) && count($new_img_ids) > 0) {
								$sql .= $new_img_ids[$arr_img_sort_hash];
							} else {
								$sql .= $arr_img_sort_hash;
							}
							$sql .= "' LIMIT 1";
							$database->setQuery( $sql );
							$database->query();
							$i++;
						}
					}
				}
				$images = new mtImages( $database );
				$images->updateOrder('link_id='.$row->link_id);
			} else {
				$redirectMsg .= $_MT_LANG->IMAGE_DIRECTORIES_NOT_WRITABLE;
			}

		}
		
		# Send e-mail notification to user/admin upon adding a new listing
		// Get owner's email
		if( $my->id > 0 ) {
			$database->setQuery( "SELECT email, name, username FROM #__users WHERE id = '".$my->id."' LIMIT 1" );
			$database->loadObject( $author );
		} else {
			if( !empty($row->email) ) {
				$author->email = $row->email;
			} else {
				$author->email = $_MT_LANG->NOT_SPECIFIED;
			}
			$author->username = $_MT_LANG->NONE;
			$author->name = $_MT_LANG->NON_REGISTERED_USER;
		}

		if ( $isNew ) {

			# To User
			if ( $mtconf->get('notifyuser_newlisting') == 1 && ( $my->id > 0 || 
					( !empty($author->email) && (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $author->email )==true))
	
			) ) {
				
				if ( $row->link_approved == 0 ) {
					$subject = sprintf($_MT_LANG->NEW_LISTING_EMAIL_SUBJECT_WAITING_APPROVAL, $row->link_name);
					$msg = $_MT_LANG->NEW_LISTING_EMAIL_MSG_WAITING_APPROVAL;
				} else {
					$subject = sprintf($_MT_LANG->NEW_LISTING_EMAIL_SUBJECT_APPROVED, $row->link_name);
					$msg = sprintf($_MT_LANG->NEW_LISTING_EMAIL_MSG_APPROVED, $row->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$row->link_id&Itemid=$Itemid"),$mtconf->getjconf('fromname'));
				}

				mosMail( $mtconf->getjconf('mailfrom'), $mtconf->getjconf('fromname'), $author->email, $subject, wordwrap($msg) );
			}

			# To Admin
			if ( $mtconf->get('notifyadmin_newlisting') == 1 ) {
				
				if ( $row->link_approved == 0 ) {
					$subject = sprintf($_MT_LANG->NEW_LISTING_EMAIL_SUBJECT_WAITING_APPROVAL, $row->link_name);
					$msg = sprintf($_MT_LANG->ADMIN_NEW_LISTING_MSG_WAITING_APPROVAL, $row->link_name, $row->link_name, $row->link_id, $author->name, $author->username, $author->email);
				} else {
					$subject = sprintf($_MT_LANG->NEW_LISTING_EMAIL_SUBJECT_APPROVED, $row->link_name);
					$msg = sprintf($_MT_LANG->ADMIN_NEW_LISTING_MSG_APPROVED, $row->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$row->link_id&Itemid=$Itemid"), $row->link_name, $row->link_id, $author->name, $author->username, $author->email);
				}

				mosMailToAdmin( $subject, $msg );

			}

		}

		# Send e-mail notification to user/admin upon modifying an existing listing
		else {

			# To User
			if ( $mtconf->get('notifyuser_modifylisting') == 1 && $my->id > 0 ) {
				
				if ( $row->link_approved < 0 ) {
					$subject = sprintf($_MT_LANG->MODIFY_LISTING_EMAIL_SUBJECT_WAITING_APPROVAL, $row->link_name);
					$msg = sprintf($_MT_LANG->MODIFY_LISTING_EMAIL_MSG_WAITING_APPROVAL, $row->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$old->link_id&Itemid=$Itemid") );
				} else {
					$subject = sprintf($_MT_LANG->MODIFY_LISTING_EMAIL_SUBJECT_APPROVED, $row->link_name);
					$msg = sprintf($_MT_LANG->MODIFY_LISTING_EMAIL_MSG_APPROVED, $row->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$old->link_id&Itemid=$Itemid"),$mtconf->getjconf('fromname'));
				}

				mosMail( $mtconf->getjconf('mailfrom'), $mtconf->getjconf('fromname'), $author->email, $subject, wordwrap($msg) );
			}

			# To Admin
			if ( $mtconf->get('notifyadmin_modifylisting') == 1 ) {

				require( $mtconf->getjconf('absolute_path') . '/components/com_mtree/includes/diff.php');
				
				$diff_desc = diff_main( $original->link_desc, $row->link_desc, true );
				diff_cleanup_semantic($diff_desc);
				$diff_desc = diff_prettyhtml( $diff_desc );

				$msg = "<style type=\"text/css\">\n";
				$msg .= "ins{text-decoration:underline}\n";
				$msg .= "del{text-decoration:line-through}\n";
				$msg .= "</style>";

				if ( $row->link_approved < 0 ) {
					
					$subject = sprintf($_MT_LANG->MODIFY_LISTING_EMAIL_SUBJECT_WAITING_APPROVAL, $row->link_name);
					$msg .= nl2br(sprintf($_MT_LANG->ADMIN_MODIFY_LISTING_MSG_WAITING_APPROVAL, $row->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$old->link_id&Itemid=$Itemid"), $row->link_name, $row->link_id, $author->name, $author->username, $author->email, $diff_desc));

				} else {

					$subject = sprintf($_MT_LANG->MODIFY_LISTING_EMAIL_SUBJECT_APPROVED, $row->link_name);
					$msg .= nl2br(sprintf($_MT_LANG->ADMIN_MODIFY_LISTING_MSG_APPROVED, $row->link_name, sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=$old->link_id&Itemid=$Itemid"), $row->link_name, $row->link_id, $author->name, $author->username, $author->email, $diff_desc));

				}

				mosMailToAdmin( $subject, $msg, 1 );
			}

		}

		mosRedirect( "index.php?option=$option&task=listcats&cat_id=$cat_id&Itemid=$Itemid", ( ($isNew) ? ( ($mtconf->get('needapproval_addlisting')) ? $_MT_LANG->LISTING_WILL_BE_REVIEWED : $_MT_LANG->LISTING_HAVE_BEEN_ADDED) : ( ($mtconf->get('needapproval_modifylisting')) ? $_MT_LANG->LISTING_MODIFICATION_WILL_BE_REVIEWED : $_MT_LANG->LISTING_HAVE_BEEN_UPDATED ) ) . (!empty($redirectMsg)?'<br /> '.$redirectMsg:'') );

	}
}

/***
* Add Category
*/
function addcategory( $option ) {
	global $database, $_MT_LANG, $savantConf, $Itemid, $my, $mainframe, $mtconf;
	
	# Get cat_id / link_id
	$cat_id = intval( mosGetParam( $_REQUEST, 'cat_id', 0 ) );
	$link_id = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );

	if ( $cat_id == 0 && $link_id > 0 ) {
		$database->setQuery( "SELECT cl.cat_id FROM (#__mt_links AS l, #__mt_cl AS cl) WHERE l.link_id = cl.link_id AND cl.main = '1' AND link_id ='".$link_id."'" );
		$cat_parent = $database->loadResult();
	} else {
		$cat_parent = $cat_id;
	}

	$database->setQuery( "SELECT cat_name FROM #__mt_cats WHERE cat_id = '".$cat_parent."' LIMIT 1" );
	$cat_name = $database->loadResult();

	$mainframe->setPageTitle( sprintf($_MT_LANG->ADD_CAT2, $cat_name) );

	# Pathway
	$pathWay = new mtPathWay( $cat_parent );

	# Savant Template
	$savant = new Savant2($savantConf);
	assignCommonVar($savant);
	$savant->assign('pathway', $pathWay);
	$savant->assign('cat_parent', $cat_parent);

	if ( $mtconf->get('user_addcategory') == '1' && $my->id < 1 ) {
		# Error. Please login before you can add category
		$savant->assign('error_msg', $_MT_LANG->PLEASE_LOGIN_BEFORE_ADDCATEGORY);
		$savant->display( 'page_error.tpl.php' );
	} else {
		# OK. User is allowed to add category
		$savant->assign('validate', josSpoofValue());
		$savant->display( 'page_addCategory.tpl.php' );
	}

}

function addcategory2( $option ) {
	global $database, $_MT_LANG, $Itemid, $my, $mtconf;

	josSpoofCheck(1);

	# Get cat_parent
	$cat_parent = intval( mosGetParam( $_REQUEST, 'cat_parent', 0 ) );

	# Check if any malicious user is trying to submit link
	if ( $mtconf->get('user_addcategory') == 1 && $my->id <= 0 ) {
		echo _NOT_EXIST;

	} else {
	# Allowed

		$row = new mtCats( $database );
		if (!$row->bind( $_POST )) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$isNew = $row->cat_id < 1;

		# Assignment for new record
		if ($isNew) {
			$row->cat_created = date( 'Y-m-d H:i:s', time() + ( $mtconf->getjconf('offset') * 60 * 60 ) );

			// Required approval
			if ( $mtconf->get('needapproval_addcategory') ) {
				$row->cat_approved = '0';
			} else {
				$row->cat_approved = 1;
				$row->cat_published = 1;
				mosCache::cleanCache( 'com_mtree' );
			}

		} else {
		# Assignment for exsiting record
			$row->cat_modified = date( 'Y-m-d H:i:s', time() + ( $mtconf->getjconf('offset') * 60 * 60 ) );
		}

		# OK. Store new category into database
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		if ( $isNew && !$mtconf->get('needapproval_addcategory')) {
			$row->updateLftRgt();
			$row->updateCatCount( 1 );
		}

		mosRedirect( "index.php?option=$option&task=listcats&cat_id=$cat_parent&Itemid=$Itemid", ( ($mtconf->get('needapproval_addcategory')) ?  $_MT_LANG->CATEGORY_WILL_BE_REVIEWED : $_MT_LANG->CATEGORY_HAVE_BEEN_ADDED) );

	}
}

function mosMailToAdmin( $subject, $body, $mode=0) {
	global $mtconf;

	if ( strpos($mtconf->get('admin_email'),',') === false ) {
		$recipient_emails = array($mtconf->get('admin_email'));
	} else {
		$recipient_emails = explode(',', $mtconf->get('admin_email'));
	}

	mosMail( $mtconf->getjconf('mailfrom'), $mtconf->getjconf('fromname'), $recipient_emails, $subject, wordwrap($body), $mode );

}

?>
