<?php
/**
* @version $id$
* @package EventCal
* @copyright (C) 2006 Kay Messerschmidt
* @contact: kay_messers@email.de
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @designed for fachschaft.etec.uni-karlsruhe.de
	
* Admin-Toolbar File

*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task) {

	case "edit":
		TOOLBAR_eventcal::_EDIT();
		break;
  case "new":  
		TOOLBAR_eventcal::_EDIT();
		break;
	case "config":
	case "storeconfig":
	  TOOLBAR_eventcal::_CONFIG();
	  break;	
	case "categories":	
  case "colorcategories":
	case "apply":  
		TOOLBAR_eventcal::_CATEGORIES();
		break;		
	default:
		TOOLBAR_eventcal::_DEFAULT();
		break;
}
?>