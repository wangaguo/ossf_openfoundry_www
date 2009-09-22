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

jimport('joomla.application.component.controller');

class K2ControllerCategory extends JController
{

	function display() {
		JRequest::setVar('view', 'category');
		parent::display();
	}

	function save() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('category');
		$model->save();
	}

	function saveAndNew() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('category');
		$model->save();
	}

	function apply() {
		$this->save();
	}

	function cancel() {
		global $mainframe;
		$mainframe->redirect('index.php?option=com_k2&view=categories');
	}

}
