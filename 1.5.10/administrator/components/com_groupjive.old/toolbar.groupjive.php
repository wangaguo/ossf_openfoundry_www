<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require_once( $mainframe->getPath( 'toolbar_html' ) ); 

switch ( $task ) {
	case 'editcategory':
		menuGroupJive::EDITCATEGORY_MENU();
		break;

	case 'newcategory':
		menuGroupJive::EDITCATEGORY_MENU();
		break;

	case 'editgroup':
		menuGroupJive::EDITGROUP_MENU();
		break;

	case 'newgroup':
		menuGroupJive::EDITGROUP_MENU();
		break;

	case "settings":
		menuGroupJive::OPTIONS_MENU();
		break;
	
	case "categoriesmanager":
		menuGroupJive::CATEGORY_MENU();
		break;

	case "groupsmanager":
		menuGroupJive::GROUP_MENU();
		break;

	case "membersmanager":
		menuGroupJive::MEMBER_MENU();
		break;

        case "deletemembers":
	  	menuGroupJive::MEMBER_DELETE_MENU();
		break;

	case "addmembers":
		menuGroupJive::MEMBER_ADD_MENU();
		break;
	

	default:
		echo $act;
		break;

	}
?>
