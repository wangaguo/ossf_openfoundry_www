<?php
/**
 * @version		$Id: view.html.php 201 2011-05-08 16:27:15Z happy_noodle_boy $
 * @package   	JCE
 * @copyright 	Copyright © 2009-2011 Ryan Demmer. All rights reserved.
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license   	GNU/GPL 2 or later
 * This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');


/**
 * Extension Manager Default View
 *
 * @package		JCE
 * @since		1.5
 */
class WFViewPreferences extends JView
{
    function display($tpl = null)
    {        
        $db =JFactory::getDBO();

        $client = JRequest::getWord('client', 'admin');
        
        $this->document->setTitle(WFText::_('WF_PREFERENCES_TITLE'));		
		$this->document->addStyleSheet('templates/system/css/system.css');
 
 		$component 	= WFExtensionHelper::getComponent();
        $xml 		= JPATH_COMPONENT.DS.'models'.DS.'preferences.xml';
        
        // get params definitions
        $params = new WFParameter($component->params, $xml, 'preferences');
        $params->addElementPath(JPATH_COMPONENT.DS.'elements');
        
        $this->assignRef('params', $params);

		$model = $this->getModel();	
							
		//$access = $model->getAccessRules();	
		//$this->assignRef('access', $access);
		
		$this->assign('access', null);
        
		$this->document->addScript('components/com_jce/media/js/preferences.js');
		
        if (JRequest::getInt('close') == 1) {
        	$this->document->addScriptDeclaration('jQuery(document).ready(function($){$.jce.Preferences.close();});');
        } else {
        	$this->document->addScriptDeclaration('jQuery(document).ready(function($){$.jce.Preferences.init();});');	
		}
        
        parent::display($tpl);
    }
}