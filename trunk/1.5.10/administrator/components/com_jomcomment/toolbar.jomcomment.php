<?php

/**
* @copyright (C) 2006 - All rights reserved!
**/
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

require_once ($mainframe->getPath('toolbar_html'));
require_once ($mainframe->getPath('toolbar_default'));

switch ($task) {
	case "maintd":
	case 'hacks':
		break;
		
	case "config" :
		menujomcomment :: CONFIG_MENU();
		break;
	case "import" :
		menujomcomment :: ABOUT_MENU();
		break;

	case "edit" :
		menujomcomment :: FILE_MENU();
		break;

	case "comments" :
		menujomcomment :: MENU_Default();
		break;
		
	case "trackbacks" :
		menujomcomment :: TRACKBACK_MENU();
		break;

	case "editLanguage" :
		menujomcomment :: STATS_MENU();
		break;
		
	
	case "about" :
		menujomcomment :: ABOUT_MENU();
		break;

	case "stats" :
		menujomcomment :: STATS_MENU();
		break;
	case "reports":
		break;
	default :
		//MENU_Default::MENU_Default();
		menujomcomment :: MENU_Default();
		break;
}
?>
