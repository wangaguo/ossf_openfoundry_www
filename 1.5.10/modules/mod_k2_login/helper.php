<?php
/*
// "K2 Login" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

class modK2LoginHelper {
	
	function getReturnURL($params, $type) {
	
		if($itemid =  $params->get($type))
		{
			$menu =& JSite::getMenu();
			$item = $menu->getItem($itemid);
			$url = JRoute::_($item->link.'&Itemid='.$itemid, false);
		}
		else
		{
			// stay on the same page
			$uri = JFactory::getURI();
			$url = $uri->toString(array('path', 'query', 'fragment'));
		}

		return base64_encode($url);
	}

	function getType() {
	
		$user = & JFactory::getUser();
		return (!$user->get('guest')) ? 'logout' : 'login';
	}

	function getProfile( & $params) {
	
		$user = &JFactory::getUser();
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_users  WHERE userID={$user->id}";
		$db->setQuery($query, 0, 1);
		$profile = $db->loadObject();
		
		if ($profile){
			
			$profile->avatar = JURI::root().'media/k2/users/'.$profile->image;
			
			require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'permissions'.'.php');
			
			if (JRequest::getCmd('option')!='com_k2')
			K2HelperPermissions::setPermissions();
			
			if(K2HelperPermissions::canAddItem())
			$profile->addLink = JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component');

			return $profile;		
			
		}

	}

}
