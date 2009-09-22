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

jimport('joomla.application.component.view');

class K2ViewUserGroup extends JView
{

	function display($tpl = null) {
	
		JHTML::_( 'behavior.tooltip' );
		JRequest::setVar('hidemainmenu', 1);
		$model = & $this->getModel();
		$userGroup = $model->getData();
		$this->assignRef('row', $userGroup);
		
		$form = new JParameter('', JPATH_COMPONENT.DS.'models'.DS.'userGroup.xml');
		$form->loadINI($userGroup->permissions);
		$this->assignRef('form', $form);
		
		$appliedCategories=$form->get('categories');
		$this->assignRef('categories', $appliedCategories);
		
		$lists = array ();
		require_once(JPATH_COMPONENT.DS.'models'.DS.'categories.php');
		$categoriesModel= new K2ModelCategories;
		$categories = $categoriesModel->categoriesTree();
		$categories_options=@array_merge($categories_option, $categories);
		$lists['categories'] = JHTML::_('select.genericlist', $categories, 'params[categories][]', 'multiple="multiple" size="15"', 'value', 'text',$appliedCategories);
		$lists['inheritance'] = JHTML::_('select.booleanlist', 'params[inheritance]', NULL, $form->get('inheritance'));
		$this->assignRef('lists',$lists);
	
		JToolBarHelper::title(JText::_('Add/Edit User Group'));
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
	
		parent::display($tpl);
	}

}
