<?php
/*
// "K2 Tools" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

require_once (dirname( __FILE__ ).DS.'helper.php');

// Params
$moduleclass_sfx 	= $params->get('moduleclass_sfx', '');
$module_usage		 	= $params->get('module_usage', '0');
$button 					= $params->get('button', '');
$imagebutton 			= $params->get('imagebutton', '');
$button_pos 			= $params->get('button_pos', 'left');
$button_text 			= $params->get('button_text', JText::_('Search'));
$width 						= intval($params->get('width', 20));
$maxlength 				= $width > 20?$width:20;
$text 						= $params->get('text', JText::_('search...'));

JHTML::_('behavior.mootools');
$document = & JFactory::getDocument();

// Output
switch($module_usage) {

	case '0':
	$months = modK2ToolsHelper::getArchive($params);
	require (JModuleHelper::getLayoutPath('mod_k2_tools', 'archive'));
	break;

	case '1':
	$authors = modK2ToolsHelper::getAuthors($params);
	require (JModuleHelper::getLayoutPath('mod_k2_tools', 'authors'));
	break;

	case '2':
	$calendar = modK2ToolsHelper::calendar($params);
	require (JModuleHelper::getLayoutPath('mod_k2_tools', 'calendar'));
	break;

	case '3':
	if (JRequest::getVar('option') == 'com_k2' && (JRequest::getCmd('task') == 'category' || JRequest::getInt('id'))) {
		$breadcrumbs = modK2ToolsHelper::breadcrumbs($params);
		$path = $breadcrumbs[0];
		$title = $breadcrumbs[1];
		require (JModuleHelper::getLayoutPath('mod_k2_tools', 'breadcrumbs'));
	}
	break;

	case '4':
	
	$output = modK2ToolsHelper::treerecurse($params, 0, 0, true);
	require (JModuleHelper::getLayoutPath('mod_k2_tools', 'categories'));
	break;

	case '5':
	echo modK2ToolsHelper::treeselectbox($params);
	break;

	case '6':
	if ($imagebutton) {
		$img = modK2ToolsHelper::getSearchImage($button_text);
	}
	require (JModuleHelper::getLayoutPath('mod_k2_tools', 'search'));
	break;

	case '7':
	$tags = modK2ToolsHelper::tagCloud($params);
	require (JModuleHelper::getLayoutPath('mod_k2_tools', 'tags'));
	break;

}
