<?php
defined('_JEXEC') or die('Restricted access');
if(!class_exists('modLoginHelper')){
	class modLoginHelper
	{
		function getReturnURL($params, $type)
		{
			if($itemid =  $params->get($type))
			{
				$menu =& JSite::getMenu();
				$item = $menu->getItem($itemid);
				$url = $item->link;
			}
			else
			{
				// Redirect to login
				$uri = JFactory::getURI();
				$url = $uri->toString();
			}
	
			return base64_encode($url);
		}
	
		function getType()
		{
			$user = & JFactory::getUser();
			return (!$user->get('guest')) ? 'logout' : 'login';
		}
	}
}
?>