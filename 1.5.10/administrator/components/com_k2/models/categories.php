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

class K2ModelCategories extends JModel
{

	function getData() {
	
		global $mainframe;
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', '', 'string');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$filter_trash = $mainframe->getUserStateFromRequest($option.$view.'filter_trash', 'filter_trash', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
	
		$query = "SELECT c.*, g.name AS groupname, exfg.name as extra_fields_group FROM #__k2_categories as c LEFT JOIN #__groups AS g ON g.id = c.access LEFT JOIN #__k2_extra_fields_groups AS exfg ON exfg.id = c.extraFieldsGroup WHERE c.trash={$filter_trash}";
	
		if ($search) {
			$query .= " AND LOWER( c.name ) LIKE ".$db->Quote('%'.$search.'%');
		}
	
		if ($filter_state > -1) {
			$query .= " AND c.published={$filter_state}";
		}

		if (!$filter_order) {
			$filter_order = "c.parent, c.ordering";
		}

		if ($filter_order) {
			$query .= " ORDER BY {$filter_order} {$filter_order_Dir}";
		} else {
			$query .= " ORDER BY c.parent, c.ordering";
		}
	
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		$categories = array();
		
		if ($search || $filter_trash == 1) {
			foreach ($rows as $row) {
				$row->treename = $row->name;
				$categories[]=$row;
			}
		
		}
		else {
			$categories = $this->indentRows($rows);
		}
		if (isset($categories))
			$total = count($categories);
		else $total = 0;
		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);
		$categories = @array_slice($categories, $pageNav->limitstart, $pageNav->limit);
		return $categories;
	}

	function getTotal() {
	
		global $mainframe;
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_trash = $mainframe->getUserStateFromRequest($option.$view.'filter_trash', 'filter_trash', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', 1, 'int');
	
		$query = "SELECT c.*, g.name AS groupname FROM #__k2_categories as c LEFT JOIN #__groups AS g ON g.id = c.access WHERE c.trash={$filter_trash}";
	
		if ($search) {
			$query .= " AND LOWER( c.name ) LIKE ".$db->Quote('%'.$search.'%');
		}
	
		if ($filter_state > -1) {
			$query .= " AND c.published={$filter_state}";
		}
	
		$db->setQuery($query);
		$rows = $db->loadObjectList();
	
		if ($search || $filter_trash == 1) {
			return count($rows);
		}
	
		else {
			$list = $this->indentRows($rows);
			$total = count($list);
			return $total;
		}
	
	}

	function indentRows( & $rows) {
	
		$children = array ();
		if(count($rows)){
			foreach ($rows as $v) {
				$pt = $v->parent;
				$list = @$children[$pt]?$children[$pt]: array ();
				array_push($list, $v);
				$children[$pt] = $list;
			}
		}

		$categories = JHTML::_('menu.treerecurse', 0, '', array (), $children);
		return $categories;
	}

	function publish() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 1);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=categories');
	}

	function unpublish() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 0);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=categories');
	}

	function saveorder() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$total = count($cid);
		$order = JRequest::getVar('order', array (0), 'post', 'array');
		JArrayHelper::toInteger($order, array (0));
		$row = & JTable::getInstance('K2Category', 'Table');
		$groupings = array ();
		for ($i = 0; $i < $total; $i++) {
			$row->load(( int )$cid[$i]);
			$groupings[] = $row->parent;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}
		$groupings = array_unique($groupings);
		foreach ($groupings as $group) {
			$row->reorder('parent = '.( int )$group.' AND published >=0');
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=categories', $msg);
	}

	function orderup() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		$row->load($cid[0]);
		$row->move(-1, 'parent = 0 AND published >=0');
		$row->reorder('parent = 0 AND published >=0');
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=categories', $msg);
	}

	function orderdown() {
	
		global $mainframe;
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		$row->load($cid[0]);
		$row->move(1, 'parent = 0 AND published >=0');
		$row->reorder('parent = 0 AND published >=0');
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=categories', $msg);
	}

	function accessregistered() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$row = & JTable::getInstance('K2Category', 'Table');
		$cid = JRequest::getVar('cid');
		$row->load($cid[0]);
		$row->access = 1;
		if (!$row->check()) {
			return $row->getError();
		}
		if (!$row->store()) {
			return $row->getError();
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New access setting saved');
		$mainframe->redirect('index.php?option=com_k2&view=categories', $msg);
	}

	function accessspecial() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$row = & JTable::getInstance('K2Category', 'Table');
		$cid = JRequest::getVar('cid');
		$row->load($cid[0]);
		$row->access = 2;
		if (!$row->check()) {
			return $row->getError();
		}
		if (!$row->store()) {
			return $row->getError();
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New access setting saved');
		$mainframe->redirect('index.php?option=com_k2&view=categories', $msg);
	}

	function accesspublic() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$row = & JTable::getInstance('K2Category', 'Table');
		$cid = JRequest::getVar('cid');
		$row->load($cid[0]);
		$row->access = 0;
		if (!$row->check()) {
			return $row->getError();
		}
		if (!$row->store()) {
			return $row->getError();
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New access setting saved');
		$mainframe->redirect('index.php?option=com_k2&view=categories', $msg);
	}

	function trash() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->trash = 1;
			$db->updateObject('#__k2_categories', $row, 'id');
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=categories', JText::_('Categories moved to trash'));
	
	}

	function restore() {
	
		global $mainframe;
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->trash = 0;
			$db->updateObject('#__k2_categories', $row, 'id');
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=categories', JText::_('Categories restored'));
	
	}

	function remove() {
	
		global $mainframe;
		jimport('joomla.filesystem.file');
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Category', 'Table');
		for ($i = 0; $i < sizeof($cid); $i++) {
			$row->load($cid[$i]);
			$query = "SELECT COUNT(*) FROM #__k2_items WHERE catid={$cid[$i]}";
			$db->setQuery($query);
			$num = $db->loadResult();
			$msg = sprintf(JText::_('CATDELETEERROR'), $row->name);
			if ($num > 0) {
				$mainframe->redirect('index.php?option=com_k2&view=categories', $msg, 'error');
			}
			else {
				if ($row->image) {
					JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'categories'.DS.$row->image);
				}
				$row->delete($cid[$i]);
			}
		
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=categories', JText::_('Delete Completed'));
	}

	function categoriesTree(  $row = NULL) {
	
		$db = & JFactory::getDBO();
		if (isset($row->id)) {
			$idCheck = ' AND id != '.( int )$row->id;
		}
		else {
			$idCheck = null;
		}
		if (!isset($row->parent)) {
			$row->parent = 0;
		}
		$query = "SELECT m.* FROM #__k2_categories m WHERE published != 0 {$idCheck} ORDER BY parent, ordering";
		$db->setQuery($query);
		$mitems = $db->loadObjectList();
		$children = array ();
		if ($mitems) {
			foreach ($mitems as $v) {
				$pt = $v->parent;
				$list = @$children[$pt]?$children[$pt]: array ();
				array_push($list, $v);
				$children[$pt] = $list;
			}
		}
		$list = JHTML::_('menu.treerecurse', 0, '', array (), $children, 9999, 0, 0);
		$mitems = array ();
		foreach ($list as $item) {
			$mitems[] = JHTML::_('select.option', $item->id, '&nbsp;&nbsp;&nbsp;'.$item->treename);
		}
		return $mitems;
	}

}
