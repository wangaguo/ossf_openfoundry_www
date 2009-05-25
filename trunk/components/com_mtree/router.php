<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.00
* @copyright (C) 2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(  dirname(__FILE__).DS.'init.php' );

jimport( 'joomla.filter.filteroutput' );

define("_MT_SEF_ADD_LINKID", 0);		// Setting this to 1 will add listing ID number as a prefix to the listing name in the URL. This is used in cases where a category has more than one listing with the same name.
define("_MT_SEF_ADD_LINKID_SEP", "-");	// Seperator to separate Listing ID and Listing Name
define("_MT_SEF_ADD_LINKID_ATTACH", 1);	// (1) Add Link ID as a suffix; (2)  Add Link ID as a prefix

define("_MT_SEF_IMAGE", "image");
define("_MT_SEF_GALLERY", "gallery");
define("_MT_SEF_DETAILS", "details");
define("_MT_SEF_REVIEW", "review");
define("_MT_SEF_REPLYREVIEW", "replyreview");
define("_MT_SEF_REPORTREVIEW", "reportreview");
define("_MT_SEF_RATE", "rate");
define("_MT_SEF_RECOMMEND", "recommend");
define("_MT_SEF_CONTACT", "contact");
define("_MT_SEF_REPORT", "report");
define("_MT_SEF_CLAIM", "claim");
define("_MT_SEF_VISIT", "visit");
define("_MT_SEF_CATEGORY_PAGE", "page");
define("_MT_SEF_DELETE", "delete");
define("_MT_SEF_REVIEWS_PAGE","reviews");
define("_MT_SEF_ADDLISTING","Add_Listing");
define("_MT_SEF_ADDCATEGORY","Add_Category");
define("_MT_SEF_MYPAGE","mypage");
define("_MT_SEF_NEWLISTING","New_Listing");
define("_MT_SEF_RECENTLYUPDATED","Recently_Updated");
define("_MT_SEF_MOSTFAVOURED","Most_Favoured");
define("_MT_SEF_FEATUREDLISTING","Featured_Listing");
define("_MT_SEF_POPULARLISTING","Popular_listing");
define("_MT_SEF_MOSTRATEDLISTING","Most_Rated");
define("_MT_SEF_TOPRATEDLISTING","Top_Rated");
define("_MT_SEF_MOSTREVIEWEDLISTING","Most_Reviewed");
define("_MT_SEF_LISTALPHA","List_Alpha");
define("_MT_SEF_OWNER", "Owner");
define("_MT_SEF_FAVOURITES", "Favourites");
define("_MT_SEF_REVIEWS", "Reviews");
define("_MT_SEF_SEARCH", "Search");
define("_MT_SEF_ADVSEARCH", "AdvSearch");
define("_MT_SEF_ADVSEARCH2", "AdvSearchR");
define("_MT_SEF_RSS", "rss");
define("_MT_SEF_NEW", "new");
define("_MT_SEF_UPDATE", "update");
define('_MT_SEF_SPACE', '-');

global $sef_replace, $listing_tasks;
$sef_replace = array(
	'%3F' => '-3F', // ?
	'%2F' => '-2F', // /
	'%3C' => '-3C', // <
	'%3E' => '-3E', // >
	'%23' => '-23', // #
	'%24' => '-24', // $
	'%3A' => '-3A'  // :

	);
$listing_tasks = array(
	// task			=>	SEF String
	'viewgallery'	=>	_MT_SEF_GALLERY,
	'writereview'	=>	_MT_SEF_REVIEW,
	'recommend'		=>	_MT_SEF_RECOMMEND,
	'contact'		=>	_MT_SEF_CONTACT,
	'report'		=>	_MT_SEF_REPORT,
	'claim'			=>	_MT_SEF_CLAIM,
	'visit'			=>	_MT_SEF_VISIT,
	'deletelisting'	=>	_MT_SEF_DELETE
	);

function MtreeBuildRoute(&$query) {
	global $mtconf, $listing_tasks;
	$segments = array();
	$db =& JFactory::getDBO();
	if(!class_exists('mtLinks')) {
		require_once( $mtconf->getjconf('absolute_path').'/administrator/components/com_mtree/admin.mtree.class.php');
	}

	if(!isset($query['task'])) {
		return $segments;
	}
	switch($query['task']) {
		
		case 'listcats':
			if(isset($query['cat_id'])) {
				$segments = appendCat($query['cat_id']);
				unset($query['cat_id']);
				if( isset($query['start']) ) {
					$page = getPage($query['start'],$mtconf->get('fe_num_of_links'));
					$segments[] = _MT_SEF_CATEGORY_PAGE . $page;
				}
			}
			break;
			
		case 'viewlink':
			$mtLink = new mtLinks( $db );
			$mtLink->load( $query['link_id'] );
			$segments = array_merge($segments,appendCat( $mtLink->cat_id ));
			if( isset($query['start']) ) {
				//	http://example.com/c/mtree/Computer/Games/Donkey_Kong/reviews23
				$page = getPage($query['start'],$mtconf->get('fe_num_of_reviews'));
				$segments = array_merge($segments,appendListing( $mtLink->link_name, $mtLink->link_id, false ));
				$segments[] =  _MT_SEF_REVIEWS_PAGE . $page;
			} else {
				$segments = array_merge($segments,appendListing( $mtLink->link_name, $mtLink->link_id, true ));
			}
			unset($query['link_id']);
			break;
			
		case 'mypage':
			$segments[] = _MT_SEF_MYPAGE;
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_links'));
				$segments[] = _MT_SEF_CATEGORY_PAGE . $page;
			}
			break;
			
		case 'listfeatured':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_FEATUREDLISTING;
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_featured'));
				$segments[] = _MT_SEF_CATEGORY_PAGE . $page;
			}
			break;

		case 'listnew':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_NEWLISTING;
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_newlisting'));
				$segments[] = _MT_SEF_CATEGORY_PAGE . $page;
			}
			break;
			
		case 'listupdated':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_RECENTLYUPDATED;
			break;

		case 'listfavourite':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_MOSTFAVOURED;
			break;

		case 'listpopular':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_POPULARLISTING;
			break;

		case 'listmostrated':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_MOSTRATEDLISTING;
			break;

		case 'listtoprated':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_TOPRATEDLISTING;
			break;

		case 'listmostreview':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_MOSTREVIEWEDLISTING;
			break;
	
		case 'advsearch':
			$segments[] = _MT_SEF_ADVSEARCH;
			break;
		
		case 'advsearch2':
			$segments[] = _MT_SEF_ADVSEARCH2;
			$search_id = getId( 'search', $query );
			$page = 1;
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_searchresults'));
				$segments[] = $page;
				$segments[] = $search_id;
			} else {
				$segments[] = 1;
				$segments[] = $search_id;
			}
		
		case 'listalpha':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_LISTALPHA;
			$segments[] = urlencode($query['alpha']);
			unset($query['alpha']);
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_links'));
				$segments[] = $page;
			} else {
				$segments[] = 1;
			}
			break;

		case 'viewowner';
		case 'viewusersreview';
		case 'viewusersfav';
			$user_id = getId( 'user', $query );
			$db->setQuery( "SELECT username FROM #__users WHERE id='".$user_id."' AND block='0'" );
			$username = $db->loadResult();
			if(!empty($username)) {
				switch($query['task']) {
					default:
						$segments[] = _MT_SEF_OWNER;
						break;
					case 'viewusersreview':
						$segments[] = _MT_SEF_REVIEWS;
						break;
					case 'viewusersfav':
						$segments[] = _MT_SEF_FAVOURITES;
						break;
				}
				$segments[] = $username;
			}
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_links'));
				$segments[] = $page;
			} else {
				$segments[] = 1;
			}
			break;
		
		case 'viewimage':
			$segments[] = _MT_SEF_IMAGE;
			$segments[] = getId( 'img', $query );
			break;

		case 'replyreview':
			$segments[] = _MT_SEF_REPLYREVIEW;
			$segments[] = getId( 'rev', $query );
			break;

		case 'reportreview':
			$segments[] = _MT_SEF_REPORTREVIEW;
			$segments[] = getId( 'rev', $query );
			break;
		
		// Listing's tasks
		case array_key_exists($query['task'],$listing_tasks) !== false:
			$mtLink = new mtLinks( $db );
			$mtLink->load( $query['link_id'] );
			$segments = appendCatListing( $mtLink, false );
			$segments[] = $listing_tasks[$query['task']];
			unset($query['link_id']);
			break;
		
		case 'addlisting':
		case 'addcategory':
			if(isset($query['link_id'])) {
				$mtLink = new mtLinks( $db );
				$mtLink->load( getId( 'link', $query ) );
				$segments = appendCat( $mtLink->cat_id );
			} elseif(isset($query['cat_id'])) {
				$segments = appendCat( getId( 'cat', $query ) );
			}
			if($query['task'] == 'addlisting') {
				$segments[] = _MT_SEF_ADDLISTING;
			} else {
				$segments[] = _MT_SEF_ADDCATEGORY;
			}
			break;
			
		case 'search':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_SEARCH;
			if( isset($query['start']) ) {
				$page = getPage($query['start'],$mtconf->get('fe_num_of_searchresults'));
				$segments[] = $page;
			} else {
				$segments[] = 1;
			}
			$segments[] = $query['searchword'];
			break;
		
		case 'rss':
			$cat_id = getId( 'cat', $query );
			$segments = appendCat( $cat_id );
			$segments[] = _MT_SEF_RSS;
			if( isset($query['type']) && $query['type'] == 'new') {
				$segments[] = _MT_SEF_NEW;
			} else {
				$segments[] = _MT_SEF_UPDATE;
			}
			unset($query['type']);
			break;
	}
	unset($query['start']);
	unset($query['limit']);
	unset($query['task']);
	return $segments;
}

function MtreeParseRoute($segments) {
	global $mtconf, $listing_tasks;
	$vars = array();
	$db =& JFactory::getDBO();

	switch(end($segments)) {
		
		case _MT_SEF_DETAILS:
		case eregi( _MT_SEF_REVIEWS_PAGE . "[0-9]+",end($segments)) == true:
			// http://example.com/directory/Arts/Leonardo-da-Vinci/details
			$isReviewsPage = eregi(_MT_SEF_REVIEWS_PAGE . '[0-9]+',end($segments));
			$path_names = array_slice( $segments, 0, -1 );
			$link_id = findLinkID( $path_names );
			$vars['task'] = 'viewlink';
			$vars['link_id'] = $link_id;
			if ( $isReviewsPage ) {
				// Get the page numner
				$pagenumber = substr( end($segments), strlen(_MT_SEF_REVIEWS_PAGE) );
				$vars['limit'] = $mtconf->get('fe_num_of_reviews');
				$vars['limitstart'] = $mtconf->get('fe_num_of_reviews') * ($pagenumber -1);
			}
			break;

		case _MT_SEF_MYPAGE:
		case count($segments) > 1 && eregi( _MT_SEF_MYPAGE,$segments[count($segments)-2]) == true:
			$vars['task'] = 'mypage';
			$pagenumber = getPageNumber($segments);
			if ( $pagenumber > 0 ) {
				$vars['limit'] = $mtconf->get('fe_num_of_links');
				$vars['limitstart'] = ($mtconf->get('fe_num_of_links') * ($pagenumber -1));
			}
			break;
			
		case _MT_SEF_FEATUREDLISTING:
		case count($segments) > 1 && eregi( _MT_SEF_FEATUREDLISTING,$segments[count($segments)-2]) == true:
			$vars['task'] = 'listfeatured';
			$page = getPageNumber($segments);
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			if($page > 0) {
				$vars['limit'] = $mtconf->get('fe_num_of_featured');
				$vars['limitstart'] = $mtconf->get('fe_num_of_featured') * ($page -1);
			}
			break;

		case _MT_SEF_NEWLISTING:
		case count($segments) > 1 && eregi( _MT_SEF_NEWLISTING,$segments[count($segments)-2]) == true:
			$vars['task'] = 'listnew';
			$page = getPageNumber($segments);
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			if($page > 0) {
				$vars['limit'] = $mtconf->get('fe_num_of_newlisting');
				$vars['limitstart'] = $mtconf->get('fe_num_of_newlisting') * ($page -1);
			}
			break;

		case _MT_SEF_RECENTLYUPDATED:
			$vars['task'] = 'listupdated';
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;

		case _MT_SEF_MOSTFAVOURED:
			$vars['task'] = 'listfavourite';
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;
						
		case _MT_SEF_POPULARLISTING:
			$vars['task'] = 'listpopular';
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;

		case _MT_SEF_MOSTRATEDLISTING:
			$vars['task'] = 'listmostrated';
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;

		case _MT_SEF_TOPRATEDLISTING:
			$vars['task'] = 'listtoprated';
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;

		case _MT_SEF_MOSTREVIEWEDLISTING:
			$vars['task'] = 'listmostreview';
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;

		case _MT_SEF_ADVSEARCH:
			$vars['task'] = 'advsearch';
			break;
		
		case count($segments) > 2 && eregi( _MT_SEF_ADVSEARCH2,$segments[count($segments)-3]) == true:
			$search_id = end($segments);
			$page = $segments[count($segments)-2];
			$vars['task'] = 'advsearch2';
			$vars['search_id'] = $search_id;
			$vars['limit'] = $mtconf->get('fe_num_of_searchresults');
			$vars['limitstart'] = ($mtconf->get('fe_num_of_searchresults') * ($page -1));
			break;
		
		case count($segments) > 2 && eregi( _MT_SEF_LISTALPHA,$segments[count($segments)-3]) == true:
			$vars['task'] = 'listalpha';
			$vars['cat_id'] = findCatId(array_slice($segments,0,-3));
			$vars['alpha'] = $segments[count($segments)-2];
			$page = $segments[count($segments)-1];
			if($page > 0) {
				$vars['limit'] = $mtconf->get('fe_num_of_featured');
				$vars['limitstart'] = $mtconf->get('fe_num_of_featured') * ($page -1);
			}
			break;

		case count($segments) > 2 && in_array($segments[count($segments)-3],array(_MT_SEF_OWNER,_MT_SEF_REVIEWS,_MT_SEF_FAVOURITES)) == true:
			switch($segments[count($segments)-3]) {
				case _MT_SEF_OWNER:
					$vars['task'] = 'viewowner';
					break;
				case _MT_SEF_REVIEWS:
					$vars['task'] = 'viewusersreview';
					break;
				case _MT_SEF_FAVOURITES:
					$vars['task'] = 'viewusersfav';
					break;
			}
			$owner_username = $segments[ (count($segments)-2) ];
			$owner_username = murldecode($owner_username);
			
			$db->setQuery( "SELECT id FROM #__users WHERE username='".$owner_username."' LIMIT 1" );
			$vars['user_id'] = $db->loadResult();
			$page = $segments[count($segments)-1];
			if($page > 0) {
				$vars['limit'] = $mtconf->get('fe_num_of_links');
				$vars['limitstart'] = $mtconf->get('fe_num_of_links') * ($page -1);
			}
			break;
		
		case count($segments) > 1 && eregi( _MT_SEF_IMAGE,$segments[count($segments)-2]) == true:
			$vars['task'] = 'viewimage';
			$vars['img_id'] = end($segments);
			break;
			
		case count($segments) > 1 && eregi( _MT_SEF_REPLYREVIEW,$segments[count($segments)-2]) == true:
			$vars['task'] = 'replyreview';
			$vars['rev_id'] = end($segments);
			break;
	
		case count($segments) > 1 && eregi( _MT_SEF_REPORTREVIEW,$segments[count($segments)-2]) == true:
			$vars['task'] = 'reportreview';
			$vars['rev_id'] = end($segments);
			break;
		
		// Listing's task - http://example.com/directory/Business/Mosets/listing_task
		case in_array(end($segments),$listing_tasks):
			$path_names = array_slice( $segments, 0, -1 );
			$link_id = findLinkID( $path_names );
			$vars['task'] = array_search(end($segments),$listing_tasks);
			$vars['link_id'] = $link_id;

			break;
		
		case _MT_SEF_ADDLISTING:
		case _MT_SEF_ADDCATEGORY:
			if(end($segments) == _MT_SEF_ADDLISTING) {
				$vars['task'] = 'addlisting';
			} else {
				$vars['task'] = 'addcategory';
			}
			$cat_id = findCatId(array_slice($segments,0,-1));
			$vars['cat_id'] = $cat_id;
			break;
			
		case count($segments) > 1 && eregi( _MT_SEF_RSS,$segments[count($segments)-2]) == true:
			$vars['task'] = 'rss';
			if(end($segments)=='new') {
				$vars['type'] = 'new';
			} else {
				$vars['type'] = 'updated';
			}
			break;
	
		default:
			$pagepattern = _MT_SEF_CATEGORY_PAGE . "[0-9]+";
			if( eregi($pagepattern,end($segments)) ) {
				$cat_segments = $segments;
				array_pop($cat_segments);
				$cat_id = findCatId($cat_segments);
			} else {
				$cat_id = findCatId($segments);
			}
			$vars['cat_id'] = $cat_id;
			$vars['task'] = 'listcats';
			$page = getPageNumber($segments);
			if($page > 0) {
				$vars['limit'] = $mtconf->get('fe_num_of_links');
				$vars['limitstart'] = $mtconf->get('fe_num_of_links') * ($page -1);
			}
			break;
	}

	return $vars;
}

function appendCat( $cat_id ) {
	global $mtconf;
	
	$segments = array();
	$sefstring = '';

	if(!class_exists('mtPathWay')) {
		require_once( $mtconf->getjconf('absolute_path').'/administrator/components/com_mtree/admin.mtree.class.php');
	}

	$pathWay = new mtPathWay( $cat_id );
	$pathway_ids = $pathWay->getPathWay( $cat_id );
	
	if( !empty($pathway_ids) ) {
		foreach( $pathway_ids AS $id ) {
			$alias = murlencode( $pathWay->getCatName( $id ) );
			$segments[] = $alias;
		}
	}
	
	// If current category is not root, append to sefstring
	$cat_name = $pathWay->getCatName($cat_id);
	if ( $cat_id > 0 && !empty($cat_name) ) {
		$alias = murlencode( $cat_name );
		$segments[] = $alias;
	}
	return $segments;
}

function appendListing( $link_name, $link_id, $add_details=false ) {
	$segments = array();
	
	if( _MT_SEF_ADD_LINKID ) {
		if( _MT_SEF_ADD_LINKID_ATTACH == 1 ) {
			$segments[] = murlencode( $link_name ) . _MT_SEF_ADD_LINKID_SEP . $link_id;
		} else {
			$segments[] = $link_id . _MT_SEF_ADD_LINKID_SEP . murlencode( $link_name );
		}
	} else {
		$segments[] = murlencode( $link_name );
	}

	if( $add_details ) {
		$segments[] = _MT_SEF_DETAILS;
	}

	return $segments;
}

/***
* Find Category ID from an array list of names
* @param array Category name retrieved from SEF Advance URL. 
*/
function findCatID( $cat_names ) {
	$db =& JFactory::getDBO();

	if ( count($cat_names) == 0 ) {
		return 0;
	}
	
	for($i=0;$i<count($cat_names);$i++) {
		$cat_names[$i] = preg_replace('/:/', '-', $cat_names[$i], 1);
	}

	// (1) 
	// First Attempt will try to search by category name. 
	// If it returns one result, then this is most probably the correct category
	$db->setQuery( "SELECT cat_id FROM #__mt_cats WHERE cat_published='1' AND cat_approved='1' && cat_name ='" . $db->getEscaped(murldecode($cat_names[ (count($cat_names)-1) ])) . "' " );
	$cat_ids = $db->loadResultArray();

	if ( count($cat_ids) == 1 && $cat_ids[0] > 0 ) {

		return $cat_ids[0];
	
	} else {

	// (2)
	// Second attempt will search the category ID by looking from top level to bottom
		$cat_ids = array();

		for( $i=0; $i<count($cat_names); $i++ ) {
			$cat_names[$i] = $cat_names[$i];

			$sql = "SELECT cat_id FROM #__mt_cats "
				.	"\n WHERE cat_published='1' AND cat_approved='1' && cat_name ='" . $db->getEscaped(murldecode($cat_names[$i])) . "' ";

			if ( $i > 0 ) {
				$sql .= "&& cat_parent='".$cat_ids[$i-1]."' ";
			} else {
				$sql .= "&& cat_parent='0' ";
			}

			$db->setQuery( $sql );
			$cat_ids[$i] = $db->loadResult();

		}
		
		return end($cat_ids);

	}

}

function findLinkID( $path_names ) {
	$db =& JFactory::getDBO();

	$path_names[count($path_names)-1] = preg_replace('/:/', '-', $path_names[count($path_names)-1], 1);
	
	// (1) 
	// First Attempt will try to search by listing name. 
	// If it returns one result, then this is most probably the correct listing
	
	$link_name = $path_names[ (count($path_names)-1) ];
	$link_name = urldecode( $link_name );

	if( _MT_SEF_ADD_LINKID ) {
		if( _MT_SEF_ADD_LINKID_ATTACH == 1 ) {
			// suffix 

			$link_ids[0] = substr( $link_name, (strrpos( $link_name, _MT_SEF_ADD_LINKID_SEP ) + strlen(_MT_SEF_ADD_LINKID_SEP)), ( strlen($link_name)  - strrpos( $link_name, _MT_SEF_ADD_LINKID_SEP ) ) );
			
		} else {
			// prefix
			
			$link_ids[0] = substr( $link_name, 0, strpos( $link_name, _MT_SEF_ADD_LINKID_SEP ) );

		}
		
		if( is_numeric($link_ids[0]) ) {
			return $link_ids[0];
		}

	}
	$link_name = murldecode( $path_names[ (count($path_names)-1) ]);
	$db->setQuery( "SELECT link_id FROM #__mt_links WHERE link_published=1 AND link_approved=1 AND link_name ='" . $db->getEscaped($link_name) . "' " );
	$link_ids = $db->loadResultArray();
	if ( count($link_ids) == 1 && $link_ids[0] > 0 ) {

		return $link_ids[0];

	} else {

	// (2)
	// Second attempt will look for the category ID and then pinpoint the listing ID
		
		$cat_id = findCatID( array_slice($path_names, 0, -1) );
		
		$db->setQuery( "SELECT l.link_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE link_published='1' AND link_approved='1' AND cl.cat_id = '".$cat_id."' AND link_name ='" . $db->getEscaped($link_name) . "' AND l.link_id = cl.link_id LIMIT 1" );
		
		return $db->loadResult();

	}
}

function murlencode($string) {
	global $sef_replace;
	$string = urlencode($string);
	$string = eregi_replace(_MT_SEF_SPACE, "%252D", $string);
	$string = eregi_replace('\+', _MT_SEF_SPACE, $string);
	foreach ($sef_replace as $key => $value) {
		$string = eregi_replace($key, $value, $string);
	}
	return $string;
}

function murldecode($string) {
	global $sef_replace;
	foreach ($sef_replace as $key => $value) {
		$string = str_replace($value, urldecode($key), $string);
	}
	$string = eregi_replace('%', "%25", $string);
	$string = eregi_replace(_MT_SEF_SPACE, "%20", $string);
	$string = eregi_replace('\+', "%2B", $string);
	$string = eregi_replace('&quot;', "%22", $string);
	$string = urldecode($string);
	$string = eregi_replace("%2D", "-", $string);
	return $string;
}

function getPage($start,$limit) {
	return (($start / $limit) +1);
}

/***
* Try to find the page number from virtual directory - http://example.com/c/mtree/My_Listing/Page3.html
*
* @param array $url_array The SEF advance URL split in arrays (first custom virtual directory beginning at $pos+1)
* @return int Page number
*/
function getPageNumber( $segments ) {
	$pagepattern = _MT_SEF_CATEGORY_PAGE . "[0-9]+";
	$pagenumber = 0;
	if ( eregi($pagepattern,end($segments)) ) {
		// Get the page number
		$pagenumber = substr( end($segments), strlen(_MT_SEF_CATEGORY_PAGE));
	}
	return $pagenumber;
}

function getId( $type, &$query ) {
	$id = 0;
	if(isset($query[$type.'_id'])) {
		$id = intval($query[$type.'_id']);
		unset($query[$type.'_id']);
	}
	return $id;
}

/***
* Return value from appendCat + appendListing
*/
function appendCatListing( $mtLink, $add_extension=true ) {
	return array_merge( appendCat( $mtLink->cat_id ), appendListing( $mtLink->link_name, $mtLink->link_id, false ) );
}

?>