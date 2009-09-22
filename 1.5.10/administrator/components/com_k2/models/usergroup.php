<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelUserGroup extends JModel
{

	function getData() {
	
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2UserGroup', 'Table');
		$row->load($cid);
		return $row;
	}

	function save() {
	
		global $mainframe;
		$row = & JTable::getInstance('K2UserGroup', 'Table');
	
		if (!$row->bind(JRequest::get('post'))) {
			$mainframe->redirect('index.php?option=com_k2&view=userGroups', $row->getError(), 'error');
		}
	
		if (!$row->check()) {
			$mainframe->redirect('index.php?option=com_k2&view=userGroup&cid='.$row->id, $row->getError(), 'error');
		}
		
		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=userGroups', $row->getError(), 'error');
		}

		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		
		switch(JRequest::getCmd('task')) {
			case 'apply':
			$msg = JText::_('Changes to User Group saved');
			$link = 'index.php?option=com_k2&view=userGroup&cid='.$row->id;
			break;
			case 'save':
			default:
			$msg = JText::_('User Group Saved');
			$link = 'index.php?option=com_k2&view=userGroups';
			break;
		}
		$mainframe->redirect($link, $msg);
	}
	
}
