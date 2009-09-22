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

jimport( 'joomla.application.component.view' );

class K2ViewItems extends JView
{
	function display($tpl = null) {
		
		global $mainframe;
		
		$user = & JFactory::getUser();
		
		$option=JRequest::getCmd('option');
		$view=JRequest::getCmd('view');
		$limit = $mainframe->getUserStateFromRequest ( 'global.list.limit', 'limit', $mainframe->getCfg ( 'list_limit' ), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest ( $option.$view.'.limitstart', 'limitstart', 0, 'int' );
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order','filter_order','i.id','cmd' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir','filter_order_Dir','DESC','word' );
		$filter_trash = $mainframe->getUserStateFromRequest($option.$view.'filter_trash', 'filter_trash', 0, 'int');
		$filter_featured = $mainframe->getUserStateFromRequest($option.$view.'filter_featured', 'filter_featured', -1, 'int');
		$filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category',0, 'int');
		$filter_author = $mainframe->getUserStateFromRequest($option.$view.'filter_author', 'filter_author',0, 'int');
		$filter_state=$mainframe->getUserStateFromRequest( $option.$view.'filter_state','filter_state',-1,'int' );
		$search = $mainframe->getUserStateFromRequest($option.$view.'search','search','','string');
		$search = JString::strtolower ( $search );
		
		$model = &$this->getModel();
		$items = $model->getData();
		$this->assignRef('rows',$items);
		
		$lists = array ();
		$lists ['search'] = $search;
		
		if (!$filter_order) {
			$filter_order = 'category';
		}
		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;
		
		$filter_trash_options[] = JHTML::_('select.option', 0, JText::_('Current'));
		$filter_trash_options[] = JHTML::_('select.option', 1, JText::_('Trashed'));
		$lists['trash'] = JHTML::_('select.genericlist', $filter_trash_options, 'filter_trash', 'onchange="this.form.submit();"', 'value', 'text', $filter_trash);
		
		require_once(JPATH_COMPONENT.DS.'models'.DS.'categories.php');
		$categoriesModel= new K2ModelCategories;
		$categories_option[]=JHTML::_('select.option', 0, JText::_('- Select category -'));
		$categories = $categoriesModel->categoriesTree();
		$categories_options=@array_merge($categories_option, $categories);
		$lists['categories'] = JHTML::_('select.genericlist', $categories_options, 'filter_category', 'onchange="this.form.submit();"', 'value', 'text', $filter_category);
		
		$lists['authors'] = JHTML::_('list.users', 'filter_author', $filter_author, true, 'onchange="this.form.submit();"' );
		
		$filter_state_options[] = JHTML::_('select.option', -1, JText::_('- Select state -'));
		$filter_state_options[] = JHTML::_('select.option', 1, JText::_('Published'));
		$filter_state_options[] = JHTML::_('select.option', 0, JText::_('Unpublished'));
		$lists['state'] = JHTML::_('select.genericlist', $filter_state_options, 'filter_state', 'onchange="this.form.submit();"', 'value', 'text', $filter_state);
		
		$filter_featured_options[] = JHTML::_('select.option', -1, JText::_('- Select featured -'));
		$filter_featured_options[] = JHTML::_('select.option', 1, JText::_('Featured'));
		$filter_featured_options[] = JHTML::_('select.option', 0, JText::_('Not featured'));
		$lists['featured'] = JHTML::_('select.genericlist', $filter_featured_options, 'filter_featured', 'onchange="this.form.submit();"', 'value', 'text', $filter_featured);
		
		$this->assignRef('lists',$lists);
		
		$total=$model->getTotal();
		jimport ( 'joomla.html.pagination' );
		
		$pageNav = new JPagination ( $total, $limitstart, $limit );
		$this->assignRef('page',$pageNav);
		
		JToolBarHelper::title( JText::_('Items') );
		if ($filter_trash == 1) {
			JToolBarHelper::custom('restore','restore.png','restore_f2.png',JText::_('Restore'), true);
		}
		JToolBarHelper::customX( 'featured', 'default.png', 'default_f2.png', JText::_('Toggle Featured Assignment') );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::customX( 'move', 'move.png', 'move_f2.png', JText::_('Move') );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', JText::_('Copy') );
		JToolBarHelper::editList();
		JToolBarHelper::addNew();
		if ($filter_trash == 1) {
			JToolBarHelper::deleteList(JText::_('Are you sure you want to delete selected items?'), 'remove', JText::_('Delete'));
		}
		else {
			JToolBarHelper::trash('trash');
		}
		
		JToolBarHelper::preferences('com_k2', '600', '650');
		
		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2');
		JSubMenuHelper::addEntry(JText::_('Items'), 'index.php?option=com_k2&view=items', true);
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_k2&view=categories');
		JSubMenuHelper::addEntry(JText::_('Tags'), 'index.php?option=com_k2&view=tags');
		JSubMenuHelper::addEntry(JText::_('Comments'), 'index.php?option=com_k2&view=comments');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_k2&view=users');
		JSubMenuHelper::addEntry(JText::_('User Groups'), 'index.php?option=com_k2&view=userGroups');
		
		if ($user->gid > 23) {
			JSubMenuHelper::addEntry(JText::_('Extra Fields'), 'index.php?option=com_k2&view=extraFields');
			JSubMenuHelper::addEntry(JText::_('Extra Field Groups'), 'index.php?option=com_k2&view=extraFieldsGroups');
		}

		JSubMenuHelper::addEntry(JText::_('Information'), 'index.php?option=com_k2&view=info');
	
		parent::display($tpl);
	}
	
	function move(){
		
		global $mainframe;
		JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
		$cid = JRequest::getVar('cid');

		foreach ($cid as $id) {
			$row = & JTable::getInstance('K2Item', 'Table');
			$row->load($id);
			$rows[]=$row;
		}
		
		require_once(JPATH_COMPONENT.DS.'models'.DS.'categories.php');
		$categoriesModel= new K2ModelCategories;
		$categories = $categoriesModel->categoriesTree();
		$lists['categories'] = JHTML::_('select.genericlist', $categories, 'category', 'class="inputbox" size="8"', 'value', 'text');
		
		$this->assignRef('rows',$rows);
		$this->assignRef('lists',$lists);
		
		JToolBarHelper::title( JText::_('Move items') );
		
		JToolBarHelper::custom('saveMove','save.png','save_f2.png',JText::_('Save'), false);
		JToolBarHelper::cancel();
		
		parent::display();
	}
	
}
