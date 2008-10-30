<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * php part
 */
require_once(BaseAdminUrl.'/adminpages/album.manager.html.php');
function showalbum($option, $act, $task, $albumId){
	//init g2
	
	global $my, $database;
	$ret = core::initiatedG2($my->id, 'true');
	switch($task){
		case 'album_spec':
			//load by id
			list ($ret, $albumspecs) = GalleryCoreApi::loadEntitiesById($albumId);
			//let's get all the needed info
			$title = $albumspecs->getTitle() ? $albumspecs->getTitle() : $albumspecs->getPathComponent();
			$details['title'] = preg_replace('/\r\n/', ' ', $title);
			$details['summary']=$albumspecs->getsummary();
			$details['description']=$albumspecs->getdescription();
			$details['creationDate']=utility::g2DateToMambo($albumspecs->getcreationTimestamp());
			$details['lastmodified']=utility::g2DateToMambo($albumspecs->getmodificationTimestamp());
			$details['parentid']=$albumspecs->getparentId();
			if($details['parentid'] != 0){
			list ($ret, $parent) = GalleryCoreApi::loadEntitiesById($details['parentid']);
			$parent = $parent->getTitle() ? $parent->getTitle() : $parent->getPathComponent();
			$details['parentname'] = preg_replace('/\r\n/', ' ', $parent);
			}
			$details['ownerid']=$albumspecs->getownerId();
			//mambo id we need
			list($ret , $mamboid) = GalleryEmbed::getExternalIdMap('entityId');
			$details['mamboid']= $mamboid[$details['ownerid']]['externalId'];
			// now the name
			$database->setQuery( 'SELECT username FROM #__users WHERE id='.$details['mamboid']);
			$database->query();
			$details['mamboname'] = $database->loadResult();
			$details['viewedsince']=utility::g2DateToMambo($albumspecs->getviewedSinceTimestamp( ));
			$details['keywords']=$albumspecs->getkeywords();
			list ($ret, $details['views']) = GalleryCoreApi::fetchItemViewCount($albumId);
			list($ret, $details['childids']) = GalleryCoreApi::fetchChildItemIdsIgnorePermissions($albumspecs);
			list($ret, $details['childalbumids']) = GalleryCoreApi::fetchChildAlbumItemIds($albumspecs);
			if(count($details['childalbumids'])>0){
			list ($ret, $childalbum) = GalleryCoreApi::loadEntitiesById($details['childalbumids']);
			foreach($childalbum as $parent){
				$parent2 = $parent->getTitle() ? $parent->getTitle() : $parent->getPathComponent();
				$details['childname'][$parent->getid()] = preg_replace('/\r\n/', ' ', $parent2);
			}
			}
			//the thumb info	
			$array = array('show' => 'none', 'blocks' => 'specificItem', 'itemId' => $albumId);
			list ($ret, $details['thumbid']) = GalleryEmbed::getImageBlock($array);
			$count = strpos( $details['thumbid'], 'g2_itemId', strpos( $details['thumbid'], '<img'));
			$count2 = strpos( $details['thumbid'], '/>' , $count) - $count;
			$details['thumbid'] = substr($details['thumbid'], $count, $count2);
			
			HTML::showAlbum( $option, $act, $task, $albumId, $details);
		break;
	}//end switch
}
function showalbumtree($option, $act, $task){
	//init g2
	
	global $my, $database, $g2Config;
	$ret = core::initiatedG2($my->id, 'true');
	//fetch album tree
	$depth = 10;
	$itemid = $g2Config['id.rootAlbum'];
	list ($ret, $tree) = GalleryCoreApi::fetchAlbumTree($itemid, $depth);
	    if ($ret) {
		if ($ret->getErrorCode() & ERROR_PERMISSION_DENIED) {
		    $tree = null;
		} else {
		    return array($ret->wrap(__FILE__, __LINE__), null);
		}
		}//end error
		list ($ret, $items) = GalleryCoreApi::loadEntitiesById(GalleryUtilities::arrayKeysRecursive($tree));
	    if ($ret) {
		return array($ret->wrap(__FILE__, __LINE__), null);
	    }
	    foreach ($items as $item) {
			$title = $item->getTitle() ? $item->getTitle() : $item->getPathComponent();
			$titles[$item->getId()] = preg_replace('/\r\n/', ' ', $title);
			$keywords[$item->getId()] = $item->getkeywords();
			$summary[$item->getId()] = $item->getsummary();
			$description[$item->getId()] = $item->getdescription();
			list($ret, $childs[$item->getId()]) = GalleryCoreApi::fetchChildItemIdsIgnorePermissions($item);
			$last_modified[$item->getId()] = utility::g2DateToMambo($item->getmodificationTimestamp());
			if((time() - $item->getmodificationTimestamp()) < 86400){
				$last_modified[$item->getId()] .= ' Updated!';
			}
		
		}
		HTML::showAlbumTree( $option, $act, $task, $tree, $titles, $keywords, $summary, $description, $childs, $last_modified);
}

//save album
function savealbum($option, $act, $task, $return, $param){
	//init g2
	global $my, $database;
	$ret = core::initiatedG2($my->id, 'true');
	//load the data item
	global $title, $description, $keywords, $summary;
	list ($ret, $albumspecs) = GalleryCoreApi::loadEntitiesById($return);
	print $title.' '.$description.'<br />';
	$albumspecs->settitle($title);
	$albumspecs->setdescription($description);
	$albumspecs->setkeywords($keywords);
	$albumspecs->setsummary($summary);
	list($ret, $lockId) = GalleryCoreApi::acquireWriteLock($return);
	$ret = $albumspecs->save();
	$ret = GalleryCoreApi::releaseLocks($lockId);
	
mosRedirect( "index2.php?option=com_gallery2&amp;act=album&amp;task=album_spec&albumId=$return", 'Succesfully Saved' );
}
?>