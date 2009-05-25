<?php
/**
* CB Link 2 author mambot
* @package Community Builder
* @subpackage CB Link 2 author mambot
* @Copyright (C) JoomlaJoe and Beat
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0.2 $
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onBeforeDisplayContent', 'CBAuthorBot');

/**
 * gets Itemid of CB profile, or by default of homepage
 * @return string "&amp;Itemid=xxx" or NULL
 */
	function CBAuthorBotItemId() {
		global $_CBAuthorbot__Cache_ProfileItemid, $database;
		
		if ( !$_CBAuthorbot__Cache_ProfileItemid ) {
			if ( !isset( $_REQUEST['Itemid'] ) ) {
				$database->setQuery( "SELECT id FROM #__menu WHERE link = 'index.php?option=com_comprofiler' AND published=1" );
				$Itemid = (int) $database->loadResult();
			} else {
				$Itemid = (int) $_REQUEST['Itemid'];
			}
			if ( ! $Itemid ) {
				/** Nope, just use the homepage then. */
				$query = "SELECT id"
				. "\n FROM #__menu"
				. "\n WHERE menutype = 'mainmenu'"
				. "\n AND published = 1"
				. "\n ORDER BY parent, ordering"
				. "\n LIMIT 1"
				;
				$database->setQuery( $query );
				$Itemid = (int) $database->loadResult();
			}
			$_CBAuthorbot__Cache_ProfileItemid = $Itemid;
		}
		if ($_CBAuthorbot__Cache_ProfileItemid) {
			return "&amp;Itemid=" . $_CBAuthorbot__Cache_ProfileItemid;
		} else {
			return null;
		}
	}

	function CBAuthorBot (&$row, &$params, $page) {

		//var_dump($row);

		$row->created_by_alias = "<a href=\""
		. sefRelToAbs( 'index.php?option=com_comprofiler&amp;task=userProfile&amp;user=' . $row->created_by . CBAuthorBotItemId() )
		. "\">"
		. ( ( $row->created_by_alias != '' ) ? $row->created_by_alias : $row->author )
		. "</a>";

		//echo $row->created_by_alias;
	}


?>