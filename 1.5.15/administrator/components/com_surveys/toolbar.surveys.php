<?php	
/*
 * $Id: <toolbar.surveys.php,0.0.05 <version> 2007/01/10 hh:mm:ss <creator name> $
 *
 * @package iJoomla Surveys
 * @email webmaster@ijoomla.com
 *
 * @copyright
 * ==================================================================== 
 * @copyright   (C) 2010 iJoomla, Inc. - All rights reserved.
 * @license  GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author  iJoomla.com <webmaster@ijoomla.com>
 * @url   http://www.ijoomla.com/licensing/
 * the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript  *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0 
 * More info at http://www.ijoomla.com/licensing/
 * ====================================================================
 * @endcopyright
 *
 * @file toolbar.surveys.html.php
 * @brief <brief description of file purpose>
 *
 * @history
 * ====================================================================
 * File creation date: 
 * Current file version: 0.0.04
 *
 * Modified By: iJoomla Al
 * Modified Date: 13/10/2006
 * Modification: SURVEY-26 , survey save performs check for valid url, triggered by param
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/10/2006
 * Modification: SURVEYS-22
 *
 * Modified By: 
 * Modified Date: 
 * Modification: 
 *
 * ====================================================================
 * @endhistory
 */	

// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );
	
switch($task) {
	case "new": 
    case "continue_editing":	 
	case "edit": 
	    if ($act=="survey"){
		    menuijoomla_surveys::MENU_Edit('check url');
	    }
		elseif ($act=="question"){
		    menuijoomla_surveys::MENU_Edit('check sum');
		}
		else {
		    menuijoomla_surveys::MENU_Edit();
		}
		break;
		
	case "analyze":
	case "export_data":
		menuijoomla_surveys::MENU_analyze();
		break;
		
	case "collect":
	case "view_result_text":
		menuijoomla_surveys::MENU_analyze();
		break;
		
	case "view_result_value":
		menuijoomla_surveys::MENU_analyze();
		break;
		
	case "reload":
		menuijoomla_surveys::MENU_Edit();
		break;
		
	case "responses":
	case "rpublish":
	case "runpublish":
		menuijoomla_surveys::MENU_responses();
	    break;
	    
	case "clear_filter":
		menuijoomla_surveys::MENU_analyze();
		break;
		
	case "showrespondent":
		menuijoomla_surveys::MENU_analyze();
    	break;
	
	default:
		switch ($act) {
			case "survey":
				menuijoomla_surveys::MENU_Survey();
			    break;
			    
			case "config":
			    menuijoomla_surveys::MENU_Edit();
			    break;
			    
			case "block":
			    menuijoomla_surveys::MENU_Block();
			    break;
			    
			case "skip":
			    menuijoomla_surveys::MENU_Default(); 
			    break;
			    
			case "question":
			    menuijoomla_surveys::MENU_Default();
			    break;
			
			default:
			    menuijoomla_surveys::MENU_none();
			    break;
		}
}
?>
