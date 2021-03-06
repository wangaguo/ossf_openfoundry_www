<?php
/**
* @version $Id: mospage.btn.php 85 2005-09-15 23:12:03Z eddieajau $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$_MAMBOTS->registerFunction( 'onCustomEditorButton', 'botMosPageButton' );

/**
* mospage button
* @return array A two element array of ( imageName, textToInsert )
*/
function botMosPageButton() {
	global $option;

	// button is not active in specific content components
	switch ( $option ) {
		case 'com_sections':
		case 'com_categories':
		case 'com_modules':
			$button = array( '', '' );
			break;

		default:
			//2007-04-25 Eddy:Add button for different languag
			global $mosConfig_lang;
			if($mosConfig_lang=='traditional_chinese')
				$button = array( 'mospage_tw.gif', '{mospagebreak}' );
			else if($mosConfig_lang=='simplified_chinese')
				$button = array( 'mospage_cn.gif', '{mospagebreak}' );
			else
			    $button = array( 'mospage.gif', '{mospagebreak}' );
			//Eddy: end
			break;
	}

	return $button;
}
?>