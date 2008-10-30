<?php
/**
* Mosets Tree toolbar 
*
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/



// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );

switch ($task) {

	/***
	 * Link
	 */
	case "newlink":
	case "editlink":
	case "editlink_for_approval":
	case "editlink_change_cat":
	case "editlink_browse_cat":
	case "editlink_add_cat":
	case "editlink_remove_cat":
		menumtree::EDITLINK_MENU();
		break;

	case "links_move":
		menumtree::MOVELINKS_MENU();
		break;

	case "links_copy":
		menumtree::COPYLINKS_MENU();
		break;

	/***
	 * Pending / Approval
	 */
	case "listpending_links":
		menumtree::LISTPENDING_LINKS_MENU();
		break;
	case "listpending_cats":
		menumtree::LISTPENDING_CATS_MENU();
		break;
	case "listpending_reviews":
		menumtree::LISTPENDING_REVIEWS_MENU();
		break;
	case "listpending_reports":
		menumtree::LISTPENDING_REPORTS_MENU();
		break;
	case "listpending_claims":
		menumtree::LISTPENDING_CLAIMS_MENU();
		break;

	/***
	 * Reviews
	 */

	case "newreview":
	case "editreview":
		menumtree::EDITREVIEW_MENU();
		break;

	case "reviews_list":
		menumtree::LISTREVIEWS_MENU();
		break;

	/***
	 * Category
	 */
	case "newcat":
	case "editcat":
	case "editcat_browse_cat":
	case "editcat_add_relcat":
	case "editcat_remove_relcat":
		menumtree::EDITCAT_MENU();
		break;

	case "cats_move":
		menumtree::MOVECATS_MENU();
		break;

	case "cats_copy":
		menumtree::COPYCATS_MENU();
		break;
	
	case "removecats":
		menumtree::REMOVECATS_MENU();
		break;

	case "listcats":
	default:
		menumtree::LISTCATS_MENU();
		break;
	
	/***
	* Search Results
	*/
	case "search":
		global $search_where;
		if ( $search_where == 1 ) {
			menumtree::SEARCH_LISTINGS();
		} else {
			menumtree::SEARCH_CATEGORIES();
		}
		break;

	/***
	* Languages
	*/
	case "languages":
		menumtree::LANGUAGES();
		break;

	/***
	* Tree Templates
	*/
	case "templates":
		menumtree::TREE_TEMPLATES();
		break;
	case "edit_templatepage":
		menumtree::TREE_EDITTEMPLATEPAGE();
		break;
	
	/***
	* Advanced Search
	*/
	case "advsearch":
		mosMenuBar::startTable();
		mosMenuBar::endTable();
		break;

	/***
	* Configuration
	*/
	case "config":
		menumtree::CONFIG_MENU();
		break;
	
	/***
	* Custom Fields
	*/
	case "customfields":
		menumtree::CUSTOM_FIELDS();
		break;

	/***
	* Export
	*/
	case "csv":
	case "csv_export":

	/***
	* About / License
	*/
	case "about":
	case "license":
		mosMenuBar::startTable();
		mosMenuBar::endTable();
		break;
//	default:
//		MENU_Default::MENU_Default();
//		break;
}
?>