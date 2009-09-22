<?php
/*
// "K2 Items" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

class modK2ContentHelper {

	function getItems( & $params) {
	
		jimport('joomla.filesystem.file');
		$limit = $params->get('items_limit', 5);
		$cid = $params->get('category_id', NULL);
		$ordering = $params->get('itemsOrdering');
		$componentParams = & JComponentHelper::getParams('com_k2');
		$limitstart = JRequest::getInt('limitstart');
	
		$user = & JFactory::getUser();
		$aid = $user->get('aid');
		$db = & JFactory::getDBO();
	
		$jnow = & JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();
	
		$query = "SELECT i.*, c.name as categoryname,c.id as categoryid, c.alias as categoryalias, c.params as categoryparams".
		" FROM #__k2_items as i".
		" LEFT JOIN #__k2_categories c ON c.id = i.catid";
	
		$query .= " WHERE i.published = 1"
		." AND i.access <= {$aid}"
		." AND i.trash = 0"
		." AND c.published = 1"
		." AND c.access <= {$aid}"
		." AND c.trash = 0"
		;
	
		$query .= " AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )";
		$query .= " AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )";
		
		if ($params->get('catfilter')){
			if (!is_null($cid)) {
				if (is_array($cid)) {
					$query .= " AND i.catid IN(".implode(',', $cid).")";
				}
				else {
					$query .= " AND i.catid={$cid}";
				}
			}
			
		}

		if ($params->get('FeaturedItems')=='0')
			$query.= " AND i.featured != 1";
	
		if ($params->get('FeaturedItems')=='2')
			$query.= " AND i.featured = 1";
	
		switch ($ordering) {
			
			case 'date' :
				$orderby = 'i.created ASC';
				break;

			case 'rdate' :
				$orderby = 'i.created DESC';
				break;

			case 'alpha' :
				$orderby = 'i.title';
				break;

			case 'ralpha' :
				$orderby = 'i.title DESC';
				break;

			case 'order' :
				$orderby = 'i.ordering';
				break;

			default :
				$orderby = 'i.id DESC';
				break;
		}

		$query .= " ORDER BY ".$orderby;
	
		$db->setQuery($query, 0, $limit);
		$items = $db->loadObjectList();
	
		require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'item.php');
		$model = new K2ModelItem;
	
		if (count($items)) {
		
			foreach ($items as $item) {
			
				//Images
				if ($params->get('itemImage')) {
				
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XS.jpg'))
					$item->imageXSmall = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_XS.jpg';
				
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_S.jpg'))
					$item->imageSmall = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_S.jpg';
				
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_M.jpg'))
					$item->imageMedium = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_M.jpg';
				
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_L.jpg'))
					$item->imageLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_L.jpg';
				
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XL.jpg'))
					$item->imageXLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_XL.jpg';
				
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_Generic.jpg'))
					$item->imageGeneric = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_Generic.jpg';
					
					$image = 'image'.$params->get('itemImgSize');
					if(isset($item->$image))
					$item->image = $item->$image;
				
				}
			
				//Read more link
				$item->link = JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.$item->alias, $item->catid.':'.$item->categoryalias));
			
				//Tags
				if ($params->get('itemTags')) {
					$tags = $model->getItemTags($item->id);
					for ($i = 0; $i < sizeof($tags); $i++) {
						$tags[$i]->link = JRoute::_(K2HelperRoute::getTagRoute($tags[$i]->name));
					}
					$item->tags = $tags;
				}
				
				//Category link
				if ($params->get('itemCategory'))
				$item->categoryLink = JRoute::_(K2HelperRoute::getCategoryRoute($item->catid.':'.$item->categoryalias));
				
				//Extra fields
				if ($params->get('itemExtraFields')){
					$item->extra_fields=$model->getItemExtraFields($item->extra_fields);
				}
				
				//Comments counter
				if ($params->get('itemCommentsCounter'))
				$item->numOfComments = $model->countItemComments($item->id);
				
				
				//Plugins
				$dispatcher = &JDispatcher::getInstance();
				JPluginHelper::importPlugin ('content');
				$item->text='';
				if ($params->get('itemIntroText'))
					$item->text.= $item->introtext;
					
				$results = $dispatcher->trigger('onBeforeDisplay', array ( & $item, $params, $limitstart));
				$item->event->BeforeDisplay = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onAfterDisplay', array ( & $item, $params, $limitstart));
				$item->event->AfterDisplay = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onAfterDisplayTitle', array ( & $item, $params, $limitstart));
				$item->event->AfterDisplayTitle = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onBeforeDisplayContent', array ( & $item, $params, $limitstart));
				$item->event->BeforeDisplayContent = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onAfterDisplayContent', array ( & $item, $params, $limitstart));
				$item->event->AfterDisplayContent = trim(implode("\n", $results));
				
				$dispatcher->trigger('onPrepareContent', array ( & $item, $params, $limitstart));
				$item->introtext = $item->text;
				
				//K2 plugins
				$item->event->K2BeforeDisplay = '';
				$item->event->K2AfterDisplay = '';
				$item->event->K2AfterDisplayTitle = '';
				$item->event->K2BeforeDisplayContent = '';
				$item->event->K2AfterDisplayContent = '';
				
				JPluginHelper::importPlugin ( 'k2' );
			
				$results = $dispatcher->trigger('onK2BeforeDisplay', array ( & $item, $params, $limitstart));
				$item->event->K2BeforeDisplay = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onK2AfterDisplay', array ( & $item, $params, $limitstart));
				$item->event->K2AfterDisplay = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onK2AfterDisplayTitle', array ( & $item, $params, $limitstart));
				$item->event->K2AfterDisplayTitle = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onK2BeforeDisplayContent', array ( & $item, $params, $limitstart));
				$item->event->K2BeforeDisplayContent = trim(implode("\n", $results));
			
				$results = $dispatcher->trigger('onK2AfterDisplayContent', array ( & $item, $params, $limitstart));
				$item->event->K2AfterDisplayContent = trim(implode("\n", $results));
				
				$dispatcher->trigger('onK2PrepareContent', array ( & $item, $params, $limitstart));
				$item->introtext = $item->text;
				
			
				//Author
				if ($params->get('itemAuthor')) {
					$author = & JFactory::getUser($item->created_by);
					$item->author = $author->name;
				
					//Author Avatar
					if ($params->get('itemAuthorAvatar')) {
						$profile = $model->getUserProfile($item->created_by);
						if($profile && $profile->image!=''){
							$item->authorAvatar = JURI::root().'media/k2/users/'.$profile->image;
						}
						else {
							if ($componentParams->get('userImageDefault'))
								$item->authorAvatar = JURI::root().'media/k2/users/default.jpg';
						}
					}
					
					//Author Link
					$item->authorLink = JRoute::_(K2HelperRoute::getUserRoute($item->created_by));
				}
			
				$rows[] = $item;
			}
		
			return $rows;
		
		}
	
	}

}
