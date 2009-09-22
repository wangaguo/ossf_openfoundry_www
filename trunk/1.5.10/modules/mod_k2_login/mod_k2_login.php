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

require_once (dirname( __FILE__ ).DS.'helper.php');

$moduleclass_sfx = $params->get('moduleclass_sfx', '');

$document = & JFactory::getDocument();

JHTML::_('behavior.mootools');
JHTML::_('behavior.modal');

$params->def('greeting', 1);
$type 	= modK2LoginHelper::getType();
$return	= modK2LoginHelper::getReturnURL($params, $type);
$user		= &JFactory::getUser();

if ($user->guest){
	require(JModuleHelper::getLayoutPath('mod_k2_login', 'default'));
} else {
	$user->profile = modK2LoginHelper::getProfile($params);
	require(JModuleHelper::getLayoutPath('mod_k2_login', 'taskbar'));
}
