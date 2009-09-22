<?php
/**
 * Sample Data Custom Module
 *
 * @package		Joomla
 * @subpackage	Sample Data Custom Module
 * @copyright Copyright (C) 2009 RocketTheme. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see RT-LICENSE.php
 * @author RocketTheme, LLC
 *
 */


// no direct access
defined('_JEXEC') or die();

class JElementSampleData extends JElement {
	

	function fetchElement($name, $value, &$node, $control_name)
	{
		$output = '';
		$document 	=& JFactory::getDocument();
		
		if (defined('ROKSTORIES_ADMIN')) return;
		define('ROKSTORIES_ADMIN', 1);
		
		if (!ROKMODULE_CHECK) return "You need RokModule in order to install Sample Data.";
		
		$module_id = JRequest::getVar('cid', null);
		if(is_array($module_id)) $module_id = $module_id[0];
		if (!$module_id) $module_id = JRequest::getVar('id', null);
		
		$document->addScript(JURI::Root(true)."/modules/mod_rokstories/admin/importData.js");
		$document->addStyleSheet(JURI::Root(true)."/modules/mod_rokstories/admin/rokstories-admin.css");
		$document->addScriptDeclaration("		window.RokStoriesAdminPath = '".JURI::Root(true)."/index.php?option=com_rokmodule&tmpl=component&type=raw&moduleid=$module_id';");
		
		$output .= "<div id='rokstories-admin-wrapper'>
						<div>
							<button>Import Sample Data</button>
						</div>
					</div>";
		
		return $output;
	}
	
}

?>