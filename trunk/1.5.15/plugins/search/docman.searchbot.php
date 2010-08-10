<?php
/**
 * Search Mambot for DOCman 1.4.x
 * @version $Id: docman.searchbot.php 778 2009-02-08 12:07:21Z mathias $
 * @package DOCmanSearch_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

global $mosConfig_absolute_path, $mainframe;

require_once $mosConfig_absolute_path ."/administrator/components/com_docman/docman.class.php";

//DOCman core interaction API
global $_DOCMAN, $_DMUSER;
if(!is_object($_DOCMAN)) {
    $_DOCMAN = new dmMainFrame();
    $_DMUSER = $_DOCMAN->getUser();
}

include_once($_DOCMAN->getPath('classes' , 'utils'));

/** Register our search function with Joomla */
$_MAMBOTS->registerFunction( 'onSearch', 'botSearchDocman' );

if(defined('_DM_J15')) 
{
	$mainframe->registerEvent( 'onSearchAreas', 'plgSearchDocmanAreas' );
}

/**
 * @return array An array of search areas
 */
function &plgSearchDocmanAreas()
{
	static $areas = array(
		'docman' => 'DOCman'
	);
	return $areas;
}

/**
* Search method
* @param 'text'     element is the search term(s)
* @param 'phrase'   element is whether this is a term/phrase/word to search for
* @param 'ordering' element is how to sort the results
*
* Returns an array that contains:
* 	title		Title of the article (ie subject)
*	section		Section name. We use 'Forum:category/section'
*	text		Text from matching articles
*	created		Date created (standard format 2004-....)
*	browsernav	'2' to open in this window
*	href		the link to get back to here.
*
*/
function botSearchDocman( $phrase, $mode='', $ordering='', $areas=null )
{
	global $database, $my, $_DOCMAN, $Itemid;

	if (defined('_DM_J15') AND is_array( $areas )) 
	{
		if (!array_intersect( $areas, array_keys( plgSearchDocmanAreas() ) )) {
			return array();
		}
	}
	
	$phrase = trim( $phrase );
	if( $phrase == '' ){
		return array();
	}

	// -------------------------------------
	// Fetch the configuration options. (Stored in the mambot parameter stuff)
	// -------------------------------------
    $tablename = (defined('_DM_J15') ? 'plugins' : 'mambots');
	$database->setQuery("SELECT id FROM #__$tablename WHERE element='docman.searchbot'");
	$_DOCMAN_searchbot_id = $database->loadResult();

	$mambot = new mosMambot( $database );
	$mambot->load( $_DOCMAN_searchbot_id );
	$params =& new mosParameters( $mambot->params );
	$section_prefix = $params->get( 'prefix','Downloads: ');
	$section_suffix = $params->get( 'suffix','');


	$search_name    = $params->get( 'search_name'        ,0   );
	$search_desc    = $params->get( 'search_description' ,0   );
	$search_cat     = $params->get( 'search_cat'         ,0   );
	$option_link    = $params->get( 'href',        'download' );

	if( ! ( $search_name || $search_desc || $search_cat ) ){
		return array();
	}

	// INTERFACE to standard class
	$search_for = array(
		array(
			'search_phrase'		 => $phrase ,
			'search_mode'		 => $mode
		)
	);

    // ...href...
    $DMItemid = DOCMAN_Utils::getItemid();
    switch($option_link) {
        case 'download':
            $href = "CONCAT('index.php?option=com_docman&task=doc_download&Itemid=$DMItemid&gid=',DM.id )";
            break;
        case 'details':
            $href = "CONCAT('index.php?option=com_docman&task=doc_details&Itemid=$DMItemid&gid=',DM.id )";
            break;
        case 'display':
        default:
            $href = "CONCAT('index.php?option=com_docman&task=cat_view&Itemid=$DMItemid&gid=',DM.catid )";
            break;
    }

	$columns = array(
      "DM.dmname" 			=>	"title"
    , "DM.dmdescription"	=>	"text"
    , "DM.dmlastupdateon"	=>	"created"
    , "'2'"					=>	"browsernav"
    , "$href"				=>	"href"
    , "DM.catid"			=>  "catid"
	);

	$options = array();
	if( $search_name ){ $options[] = 'search_name' ; }
	if( $search_desc ){ $options[] = 'search_desc' ; }
	if( $search_cat  ){ $options[] = 'search_cat'  ; }

	$options['section_prefix'] = $section_prefix ;
	$options['section_suffix'] = $section_suffix ;

	return DOCMAN_Docs::search(  $search_for , $ordering, 0 , $columns , $options);
}


