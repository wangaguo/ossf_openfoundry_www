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

require_once (dirname( __FILE__ ).DS.'helper.php');

$moduleclass_sfx = $params->get('moduleclass_sfx','');
$module_usage = $params->get('module_usage','0');

$document = & JFactory::getDocument();

$componentParams = & JComponentHelper::getParams('com_k2');

switch($module_usage) {

	case '0':
	$comments = modK2CommentsHelper::getLatestComments($params);
	require (JModuleHelper::getLayoutPath('mod_k2_comments', 'comments'));
	break;

	case '1':
	$commenters = modK2CommentsHelper::getTopCommenters($params);
	require (JModuleHelper::getLayoutPath('mod_k2_comments', 'commenters'));
	break;

}
