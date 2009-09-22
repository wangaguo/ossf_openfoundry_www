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

class K2ModelExtraFields extends JModel
{
	
	function getData() {
	
		global $mainframe;
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', '', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_type = $mainframe->getUserStateFromRequest($option.$view.'filter_type', 'filter_type', '', 'string');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', 0, 'int');
	
		$query = "SELECT * FROM #__k2_extra_fields WHERE id>0";
	
		if ($filter_state > -1) {
			$query .= " AND published={$filter_state}";
		}
	
		if ($search) {
			$query .= " AND LOWER( name ) LIKE ".$db->Quote('%'.$search.'%');
		}
	
		if ($filter_type) {
			$query .= " AND `type`=".$db->Quote($filter_type);
		}
		
		if ($filter_group) {
			$query .= " AND `group`={$filter_group}";
		}
		
		if (!$filter_order) {
			$filter_order = '`group`';
		}
		
		if ($filter_order == 'ordering') {
			$query .= " ORDER BY `group`, ordering {$filter_order_Dir}";
		} 
		else {
			$query .= " ORDER BY {$filter_order} {$filter_order_Dir}, `group`, ordering";
		}

		$db->setQuery($query, $limitstart, $limit);
		$rows = $db->loadObjectList();
		return $rows;
	}
	
	function getTotal() {
	
		global $mainframe;
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', 1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_type = $mainframe->getUserStateFromRequest($option.$view.'filter_type', 'filter_type', '', 'string');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', '', 'string');
	
		$query = "SELECT COUNT(*) FROM #__k2_extra_fields WHERE id>0";
		
		if ($filter_state > -1) {
			$query .= " AND published={$filter_state}";
		}
		
		if ($search) {
			$query .= " AND LOWER( name ) LIKE ".$db->Quote('%'.$search.'%');
		}

		if ($filter_type) {
			$query .= " AND `type`=".$db->Quote($filter_type);
		}
		
		if ($filter_group) {
			$query .= " AND `group`=".$db->Quote($filter_group);
		}

		$db->setQuery($query);
		$total = $db->loadresult();
		return $total;
	}
	
	function publish() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 1);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields');
	}

	function unpublish() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 0);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields');
	}

	function saveorder() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$total = count($cid);
		$order = JRequest::getVar('order');
		JArrayHelper::toInteger($order, array (0));
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$groupings = array ();
		for ($i = 0; $i < $total; $i++) {
			$row->load((int)$cid[$i]);
			$groupings[] = $row->group;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}
		$groupings = array_unique($groupings);
		foreach ($groupings as $group) {
			$row->reorder("`group` = {$group}");
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', $msg);
	}

	function orderup() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$row->load($cid[0]);
		$row->move(-1, "`group` = '{$row->group}' AND published = 1");
		$row->reorder("`group` = '{$row->group}' AND published = 1");
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', $msg);
	}

	function orderdown() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$row->load($cid[0]);
		$row->move(1, "`group` = '{$row->group}' AND published >= 0");
		$row->reorder("`group` = '{$row->group}' AND published >= 0");
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', $msg);
	}

	function remove() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->delete($id);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', JText::_('Delete Completed'));
	}
	
	function getExtraFieldsGroup() {
	
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
		$row->load($cid);
		return $row;
	}
	
	function getGroups() {
	
		global $mainframe;
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
	
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_extra_fields_groups";
		$db->setQuery($query, $limitstart, $limit);
		$rows = $db->loadObjectList();
		return $rows;
	}
	
	function getTotalGroups() {
	
		$db = & JFactory::getDBO();
		$query = "SELECT COUNT(*) FROM #__k2_extra_fields_groups";
		$db->setQuery($query);
		$total = $db->loadResult();
		return $total;
	}
	
	function saveGroup(){
		
		global $mainframe;
		$id = JRequest::getInt('id');
		$row = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
		if (!$row->bind(JRequest::get('post'))) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroups', $row->getError(), 'error');
		}

		if (!$row->check()) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroup&cid='.$row->id, $row->getError(), 'error');
		}
	
		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroup', $row->getError(), 'error');
		}
		
		switch(JRequest::getCmd('task')) {
			case 'apply':
			$msg = JText::_('Changes to Group saved');
			$link = 'index.php?option=com_k2&view=extraFieldsGroup&cid='.$id;
			break;
			case 'save':
			default:
			$msg = JText::_('Group Saved');
			$link = 'index.php?option=com_k2&view=extraFieldsGroups';
			break;
		}
		
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect($link, $msg);
	}
	
	function removeGroups(){
		
		global $mainframe;
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->delete($id);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroups', JText::_('Delete Completed'));
	}

}
