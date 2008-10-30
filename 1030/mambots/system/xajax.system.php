<?php
/**
 * xajax.system.php :: Main xajax plugin for Joomla
 *
 * copyright (c) 2006 Blue Flame IT Ltd.
 * http://www.xajax-Joomla.com
 * Contributions from:
 * Azurl 
 *
 * xajax for Joomla is an open source PHP class library for easily creating powerful
 * PHP-driven, web-based Ajax Applications. Using xajax, you can asynchronously
 * call PHP functions and update the content of your your webpage without
 * reloading the page.
 *
 * xajax and xajax for Joomla Plugin are both released under the terms of the LGPL license
 * http://www.gnu.org/copyleft/lesser.html#SEC3
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * @package xajax for Joomla
 * @version $Id: xajax.system.php 4 2006-08-31 14:36:13Z philtaylor $
 * @copyright Copyright (c) 2006 Blue Flame IT Ltd.
 * @license http://www.gnu.org/copyleft/lesser.html#SEC3 LGPL License
 */

/* Stop direct access */
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/* Define xAJAX constants */
define ('XAJAX_ROOT', dirname(__FILE__));
define ('XAJAX_VER', 'xajax_0.2.4');

/* Register the Plugin in Joomla */
$_MAMBOTS->registerFunction( 'onAfterStart', '_LOAD_XAJAX' );

/**
 * Includes all the component xajax functions and outputs JS to Head
 *
 */
function _LOAD_XAJAX () {

	global $mainframe, $_MAMBOTS, $xajaxFunctions, $database;

	/*  Prevent any unwanted output */
	ob_start('XAJAX_MAMBOT');

	/* Require xAJAX */
	require_once(XAJAX_ROOT . '/'. XAJAX_VER . '/xajax.inc.php');

	/* Instantiate the xajax object. */
	$xajax = new xajax();

	/* Get configuration from params */
	$query = "SELECT params"
	. "\n FROM #__mambots"
	. "\n WHERE element = 'xajax.system'"
	. "\n AND folder = 'system'"
	;
	$database->setQuery( $query );
	$database->loadObject($mambot);

	/* Get Configuration from params */
	$params = new mosParameters( $mambot->params );

	/* Set defaults from params */
	$params->get('statusMessagesOn','1') 	? $xajax->statusMessagesOn(): $xajax->statusMessagesOff();
	$params->get('waitCursorOn','1')		? $xajax->waitCursorOn() 	: $xajax->waitCursorOff();
	$params->get('debug','0')				? $xajax->debugOn() 	 	: $xajax->debugOff();

	/** Encoding Nightmare
	 * Joomla 1.0.x doesn't support UTF-8 really
	 * Further reading: 
	 * http://www.phil-taylor.com/kb/xajax_data_could_not_be_converted_from_UTF-8/
	 * http://forum.joomla.org/index.php?topic=55065.0
	 * http://wiki.xajaxproject.org/Tutorials:Character_Encoding_and_xajax
	 * http://www.nicknettleton.com/zine/php/php-utf-8-cheatsheet
	 * 
	 * And for Joomla! 1.5.x
	 * http://dev.joomla.org/index.php?option=com_jd-wiki&Itemid=31&id=guidelines:utf-8
	 **/
	$xajax->setCharEncoding($params->get('encoding','UTF-8'));
	$params->get('decodeUTF8','0') 			? $xajax->decodeUTF8InputOff() : $xajax->decodeUTF8InputOn();


	/* Locate and get PHP functions to wrap from the xAJAX file in each component (if exists) */
	$xajaxFunctions = array();

	/* azrul: Look into all component folder and call xajax.component.php */
	$database->setQuery("SELECT `option` FROM #__components WHERE parent=0 AND iscore=0 ");
	$coms = $database->loadObjectList();

	foreach($coms as $com){

		/* Build path to file and filename */
		$xajaxFile = $GLOBALS['mosConfig_absolute_path'] . '/components/'.$com->option. '/xajax.' . substr($com->option, 4) . '.php';

		/* If file exists include it */
		if(file_exists($xajaxFile)){
			include_once($xajaxFile);

		}
	}

	/* Register each function with xAJAX */
	foreach ($xajaxFunctions as $call ){
		
		/* check function is now callable and file exists*/
		if (is_callable($call[0]) && file_exists($call[1])){
			$xajax->registerExternalFunction($call[0],$call[1]);
		}
		
	}

	/* azrul: need to fix request URI. Unpredictable behaviour with Open-SEF */
	$reqURI   = $GLOBALS['mosConfig_live_site'] . "/index2.php";

	/* if host have wwww, but mosConfig doesn't */
	if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www.") {

		if (!strstr($reqURI, "www.")) {
			$reqURI = str_replace("http://", "http://www.", $reqURI);
		}

	} else {

		/* host do not have 'www' */
		if (strstr($reqURI, "http://www.")) {
			$reqURI = str_replace("http://www.", "http://", $reqURI);
		}

	}

	/* Check for HTTPS */
	if(isset($HTTP_SERVER_VARS)){
		if(isset($HTTP_SERVER_VARS['HTTPS'])){
			if($HTTP_SERVER_VARS['HTTPS'] == "ON" ){
				$reqURI = str_replace("http://", "https://", $reqURI);
			}
		}
	}

	/* set the xAJAX request URL */
	$xajax->setRequestURI($reqURI);

	/* Get the xAJAX Javascript */
	$js = $xajax->getJavascript($GLOBALS['mosConfig_live_site'] .'/mambots/system/' . XAJAX_VER . '/');

	/* Add the Javascript to the HTML Head */
	$mainframe->addCustomHeadTag($js);

	/* azrul: initialise $my variables to make it available globally */
	if($xajax->canProcessRequests ()){
		$my = $mainframe->getUser();
	}

	/**
	 * Process any requests.  Because our requestURI is the same as our html page,
	 * this must be called before any headers or HTML output have been sent 
	 **/
	$xajax->processRequests();

	/* Remove any output without displaying it */
	ob_end_clean();
}
?>