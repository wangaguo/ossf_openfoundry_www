<?php
/**
* Mosets Tree Tools 
*
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/***
* Load Link
*/
function loadLink( $link_id, &$savantConf, &$custom_fields, &$params ) {
	global $database, $mosConfig_absolute_path, $mosConfig_offset, $_MAMBOTS, $mtree;

	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

	# Get all link data
	$database->setQuery( "SELECT l.*, u.name AS owner, u.email AS owner_email, cl.cat_id AS cat_id FROM (#__mt_links AS l, #__mt_cl AS cl)"
		. "\n LEFT JOIN #__users AS u ON u.id = l.user_id"
		.	"\n	WHERE link_published='1' AND link_approved > 0 AND l.link_id='".$link_id."' " 
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		.	"\n AND l.link_id = cl.link_id"
		.	"\n LIMIT 1"
	);
	$database->loadObject( $link );
	
	# Use owner's email address is listing e-mail is not available
	if ( $mtree->getCfg( 'mt_use_owner_email' ) && empty($link->email) && $link->user_id > 0 ) {
		$link->email = $link->owner_email;
	}

	# Load link's template
	if ( empty($link->link_template) ) {
		// Get link's template
		$database->setQuery( "SELECT cat_template FROM #__mt_cats WHERE cat_id='".$link->cat_id."' LIMIT 1" );
		$cat_template = $database->loadResult();

		if ( !empty($cat_template) ) {
			$templateDir = $mosConfig_absolute_path . '/components/com_mtree/templates/' . $cat_template;
			if ( is_dir( $templateDir ) ) {
				$savantConf["template_path"] = $templateDir;
			}
		}
	} else {
		$templateDir = $mosConfig_absolute_path . '/components/com_mtree/templates/' . $link->link_template;
		if ( is_dir( $templateDir ) ) {
			$savantConf["template_path"] = $templateDir;
		}
	}

	# Load custom fields' caption
	$database->setQuery( "SELECT name, value AS caption FROM #__mt_config WHERE name LIKE 'cust_%'" );
	$custom_fields = $database->loadObjectList( "name" );

	# Parameters
	$params = new mosParameters( $link->attribs );
	$params->def( 'show_review', $mtree->getCfg( 'mt_show_review' ));
	$params->def( 'show_rating', $mtree->getCfg( 'mt_show_rating' ));

	# Support Mambots
	if( isset($link->link_desc) && !empty($link->link_desc) ) $link->text = $link->link_desc;
	if( isset($link->link_id) )$link->id = $link->link_id;
	if( isset($link->link_name) )$link->title = $link->link_name;

	$page = 0;

	$_MAMBOTS->loadBotGroup( 'content' );
	$results = $_MAMBOTS->trigger( 'onPrepareContent', array( &$link, &$params, $page ), true );

	return $link;

}

/***
*
*/

function assignCommonViewlinkVar( &$savant, &$link, &$custom_fields, &$pathWay, &$params  ) {
	global $_MT_LANG, $option, $Itemid, $my, $_MAMBOTS;
	global $mt_show_email, $mt_min_votes_to_show_rating, $mosConfig_live_site, $mt_listing_image_dir;

	$savant->_MT_LANG =& $_MT_LANG;
	$savant->assign('option', $option);
	$savant->assign('Itemid', $Itemid);
	$savant->assign('pathway', $pathWay);
	$savant->assign('link', $link);
	$savant->assign('link_id', $link->link_id);
	$savant->assign('mt_show_email', $mt_show_email);
	$savant->assign('min_votes_to_show_rating', $mt_min_votes_to_show_rating);
	$savant->assign('listing_image_dir', $mosConfig_live_site.$mt_listing_image_dir);
	$savant->assign('custom_fields', $custom_fields);
	$savant->assign('user_id',$my->id);

	// mambots results
	$savant->assign('mambotAfterDisplayTitle', $_MAMBOTS->trigger( 'onAfterDisplayTitle', array( &$link, &$params, 0 ) ));
	$savant->assign('mambotBeforeDisplayContent', $_MAMBOTS->trigger( 'onBeforeDisplayContent', array( &$link, &$params, 0 ) ));
	$savant->assign('mambotAfterDisplayContent', $_MAMBOTS->trigger( 'onAfterDisplayContent', array( &$link, &$params, 0 ) ));

	return true;
}

/***
* getSubCats_Recursive
*
* Recursively retrieves list of categories ID which is the children of of a $cat_id.
* This list will include $cat_id as well.
*/
function getSubCats_Recursive( $cat_id, $published_only=true ) {
	global $database;

	$mtCats = new mtCats( $database );

	if ( $cat_id > 0 ) {
		$subcats = $mtCats->getSubCats_Recursive( $cat_id, $published_only );
		//if ( count($subcats) > 0 ) {
		//	$only_subcats_sql = "cat_id IN (" . implode( ", ", $subcats ) . ")";
		//}
	}
	$subcats[] = $cat_id;

	return $subcats;

}

/***
* getCatsSelectlist
*
*/
function getCatsSelectlist( $cat_id=0, &$cat_tree ) {
	global $database;
	static $level = 0;

	$sql = "SELECT *, '".$level."' AS level FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ORDER BY cat_name ASC";
	$database->setQuery( $sql );

	$cat_ids = $database->loadObjectList();
	
	if ( count($cat_ids) > 0 ) {

		$level++;

		foreach( $cat_ids AS $cid ) {
			
			$cat_tree[] = array("level" => $cid->level, "cat_id" => $cid->cat_id, "cat_name" => $cid->cat_name, "cat_allow_submission" => $cid->cat_allow_submission ) ;

			if ( $cid->cat_cats > 0 ) {
				$children_ids = getCatsSelectlist( $cid->cat_id, $cat_tree );
				$cat_ids = array_merge( $cat_ids, $children_ids );
			}
		}
				$level--;
	}

	return $cat_ids;

}

/***
* loadCustomTemplate
*
* If $cat_id has been assigned a custom template, $savantConf will be updated. Otherwise,
* no changes is done, and it iwll load default template.
*/
function loadCustomTemplate( $cat_id, &$savantConf) {
	global $database, $mosConfig_absolute_path;

	$mtCats = new mtCats( $database );
	$mtCats->load( $cat_id );
	if ( !empty($mtCats->cat_template) ) {
		$savantConf['template_path'] = $mosConfig_absolute_path."/components/com_mtree/templates/".$mtCats->cat_template."/";
	}
}

/***
* Apply Mambot to list of link objects
*/
function applyMambots( &$links ) {
	global $_MAMBOTS;
	$_MAMBOTS->loadBotGroup( 'content' );

	for( $i=0; $i<count($links); $i++ ) {
		
		// Load Parameters
		$params =& new mosParameters( $links[$i]->attribs );
	
		$links[$i]->text = $links[$i]->link_desc;
		$links[$i]->id = $links[$i]->link_id;
		$links[$i]->title = $links[$i]->link_name;

		$results = $_MAMBOTS->trigger( 'onPrepareContent', array( &$links[$i], &$params, 0 ), true );
	}

}

/***
* Strip tags from Listing's summary
*/
function stripTags( &$links ) {
	global $mt_allow_html;
	
	if( !$mt_allow_html ) {
		$allowedTags = '<h1><b><i><a><ul><li><pre><hr><blockquote><img>';

		for( $i=0; $i<count($links); $i++ ) {
			
			$links[$i]->text = strip_tags($links[$i]->text, $allowedTags);
		
		}
	}
}

function mtAppendPathWay( $option, $task, $cat_id=0, $link_id=0 ) {
	global $mainframe, $database, $Itemid, $_MT_LANG;

	$mtPathWay = new mtPathWay();

	switch( $task ) {

		case "listcats":
		case "addcategory": // Show "Add Category Path?"
			$cids = $mtPathWay->getPathWay( $cat_id );
			break;

		case "viewlink":
		case "writereview":
		case "rate":
		case "recommend":
			$mtLink = new mtLinks( $database );
			$mtLink->load( $link_id );
			$cat_id = $mtLink->getCatID();
			$cids = $mtPathWay->getPathWay( $cat_id );
			break;

		// Adding listing from a category
		case "addlisting":
			if ( $cat_id > 0 ) $cids = $mtPathWay->getPathWay( $cat_id );
			elseif( $link_id > 0 ) {
				$mtLink = new mtLinks( $database );
				$mtLink->load( $link_id );
				$cat_id = $mtLink->getCatID();
				$cids = $mtPathWay->getPathWay( $cat_id );
			}
			// Show "Add Listing" Path?
			break;

		
		case "mylisting":
			$mainframe->appendPathWay( $_MT_LANG->MY_LISTING );
			break;
		case "listnew":
			$mainframe->appendPathWay( $_MT_LANG->NEW_LISTING );
			break;
		case "listfeatured":
			$mainframe->appendPathWay( $_MT_LANG->FEATURED_LISTING );
			break;
		case "listpopular":
			$mainframe->appendPathWay( $_MT_LANG->POPULAR_LISTING );
			break;
		case "listmostrated":
			$mainframe->appendPathWay( $_MT_LANG->MOST_RATED_LISTING );
			break;
		case "listtoprated":
			$mainframe->appendPathWay( $_MT_LANG->TOP_RATED_LISTING );
			break;
		case "listmostreview":
			$mainframe->appendPathWay( $_MT_LANG->MOST_REVIEWED_LISTING );
			break;
		case "advsearch":
			$mainframe->appendPathWay( $_MT_LANG->ADVANCED_SEARCH );
			break;
		case "advsearch2":
			$mainframe->appendPathWay( $_MT_LANG->ADVANCED_SEARCH_RESULTS );
			break;
		case "search":
			$mainframe->appendPathWay( $_MT_LANG->SEARCH_RESULTS );
			break;
			
	}
	

	if ( isset($cids) && is_array($cids) && count($cids) > 0 ) {
		foreach( $cids AS $cid ) {
			$mainframe->appendPathWay( "<a href=\"" . sefRelToAbs("index.php?option=$option&task=listcats&cat_id=$cid&Itemid=$Itemid") . "\" class=\"pathway\">".$mtPathWay->getCatName($cid)."</a>");
		}
		
		// Append the curreny category name
		$mainframe->appendPathWay( "<a href=\"" . sefRelToAbs("index.php?option=$option&task=listcats&cat_id=$cat_id&Itemid=$Itemid") . "\" class=\"pathway\">".$mtPathWay->getCatName($cat_id)."</a>");

	} elseif( $cat_id > 0 ) {
		$mainframe->appendPathWay( "<a href=\"" . sefRelToAbs("index.php?option=$option&task=listcats&cat_id=$cat_id&Itemid=$Itemid") . "\" class=\"pathway\">".$mtPathWay->getCatName($cat_id)."</a>");

	}

}

function getReviews( $links ) {
	global $database;
	
	$link_ids = array();
	
	if ( count( $links ) > 0 ) {
		foreach( $links AS $l ) {
			$link_ids[] = $l->link_id;
		}

		if ( count($link_ids) > 0 ) {
			# Get total reviews for each links
			$database->setQuery( "SELECT r.link_id, COUNT( * ) AS total FROM #__mt_cl AS cl "
				.	"\n LEFT JOIN #__mt_reviews AS r ON cl.link_id = r.link_id "
				.	"\n WHERE cl.link_id IN ('".implode("','",$link_ids)."') AND r.rev_approved = '1' AND cl.main = '1'"
				.	"\n GROUP BY r.link_id"	
				);
			return $database->loadObjectList('link_id');
		} else {
			return array(0);
		}
	} else {
		return false;
	}

}
?>
