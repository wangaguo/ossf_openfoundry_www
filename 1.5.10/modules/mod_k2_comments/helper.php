<?php
/*
// "K2 Comments" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

class modK2CommentsHelper {

	function getLatestComments( & $params) {
	
		$limit = $params->get('comments_limit', '5');
		$user = & JFactory::getUser();
		$aid = $user->get('aid');
		$db = & JFactory::getDBO();
		$cid = $params->get('category_id', NULL);
		
		$jnow =& JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();
		
		require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'item.php');
		$model = new K2ModelItem;
		
		$componentParams = & JComponentHelper::getParams('com_k2');
		
		$query = "SELECT c.*, i.catid, i.title, i.alias, category.alias as catalias, category.name as categoryname  FROM #__k2_comments as c".
				" LEFT JOIN #__k2_items as i ON i.id=c.itemID".
				" LEFT JOIN #__k2_categories as category ON category.id=i.catid".
				" WHERE i.published=1 ".
				" AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." ) ".
				" AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )". 
				" AND i.trash=0 AND i.access<={$aid}".
				" AND category.published=1 AND category.trash=0 AND category.access<={$aid}".
				" AND c.published=1 ";
				
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
		
		$query.= " ORDER BY c.commentDate DESC ";
		
		$db->setQuery($query, 0, $limit);
		$rows = $db->loadObjectList();
		
		if (count($rows)){
			foreach ($rows as $row) {
				
				$row->commentText = modK2CommentsHelper::word_limiter($row->commentText, $params->get('comments_word_limit'));
				$row->link=JRoute::_(K2HelperRoute::getItemRoute($row->itemID.':'.$row->alias, $row->catid.':'.$row->catalias))."#comment{$row->id}";
				
				$row->userImage='';
				
				if ($params->get('commentAvatar')){
				
					if ($row->userID > 0){
						$profile=$model->getUserProfile($row->userID);
						
						if ($profile->image){
							$row->userImage=JURI::root().'media/k2/users/'.$profile->image;
						}
						else{
							if ($componentParams->get('userImageDefault'))
								$row->userImage = JURI::root().'media/k2/users/default.jpg';
						}						
					}
					
					else {
						
						if ($componentParams->get('gravatar')){
							$row->userImage='http://www.gravatar.com/avatar/'.md5($row->commentEmail).'?s='.$componentParams->get('commenterImgWidth').'&amp;default='.urlencode(JURI::root().'media/k2/users/default.jpg');
						}
						
						else {
							if ($componentParams->get('userImageDefault')){
								$row->userImage = JURI::root().'media/k2/users/default.jpg';
							}
						}
		
					}
				}

				$comments[]=$row;
			
			}
		
			return $comments;
		}
	
	}

	function getTopCommenters( & $params) {
	
		$limit = $params->get('commenters_limit', '5');
		$user = & JFactory::getUser();
		$aid = $user->get('aid');
		$db = & JFactory::getDBO();
		$query = "SELECT COUNT(id) as counter, userName, userID, commentEmail FROM #__k2_comments".
				" WHERE userID > 0".
				" AND published = 1";
				" GROUP BY userID ORDER BY counter DESC";
				
		$db->setQuery($query, 0, $limit);
		$rows = $db->loadObjectList();
		
		require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'item.php');
		$model = new K2ModelItem;
		
		$componentParams = & JComponentHelper::getParams('com_k2');
		
		if (count($rows)){
			
			foreach ($rows as $row) {
			
				if ($row->counter>0){
					$row->link=JRoute::_(K2HelperRoute::getUserRoute($row->userID));
					
					$row->userImage='';
					
					if ($params->get('commenterAvatar') && $row->userID > 0){
						$profile=$model->getUserProfile($row->userID);
						
						if ($profile->image){
							$row->userImage=JURI::root().'media/k2/users/'.$profile->image;
						}
						else{
							if ($componentParams->get('userImageDefault'))
								$row->userImage = JURI::root().'media/k2/users/default.jpg';
						}						
					}

					$commenters[]=$row;
				}
			}		
			if (isset($commenters))	
			return $commenters;
		}

	}
	
	function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
	
		if (trim($str) == '')
		return $str;
		preg_match('/\s*(?:\S*\s*){'.(int)$limit.'}/', $str, $matches);
		if (strlen($matches[0]) == strlen($str))
		$end_char = '';
		return rtrim($matches[0]).$end_char;
	}

}
