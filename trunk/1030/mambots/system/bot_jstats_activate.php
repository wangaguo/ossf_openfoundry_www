<?php
/**
 *
 * @version $Id: mosimage.php 117 2005-09-16 19:46:26Z stingrey $
 * @package Joomla
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
// no direct access
defined('_VALID_MOS') or die('Restricted access');

$_MAMBOTS->registerFunction('onAfterStart', 'bot_jstats_activate');

/**
 *	 Using this bot you don't need to manualy add the lines to your template
 */
function bot_jstats_activate()
{
    global $mainframe,$GLOBALS;
    
    $absolute_path = $GLOBALS[mosConfig_absolute_path];
    

	if (file_exists($absolute_path."/components/com_joomlastats/joomlastats.inc.php"))
		require_once($absolute_path."/components/com_joomlastats/joomlastats.inc.php");
	else
    	if (file_exists($absolute_path . "/components/com_tfsformambo/tfsformambo.php")) 
	        require_once($absolute_path . "/components/com_tfsformambo/tfsformambo.php");
    
    return true;
}

?>