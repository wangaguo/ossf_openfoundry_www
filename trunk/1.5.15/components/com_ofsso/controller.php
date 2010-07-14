<?php
/**
 * @package    OpenFoundry SSO 
 * @subpackage Components
 * @link 
 * @license    OSI: MIT License
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');


$REMOTE_ADDR = '';
if(isset($_SERVER[HTTP_X_FORWARDED_FOR])) $REMOTE_ADDR = $_SERVER[HTTP_X_FORWARDED_FOR];
else $REMOTE_ADDR = $_SERVER[REMOTE_ADDR];

$config =& JFactory::getConfig();
$ofsso_ip_limit = $config->getValue( 'ofsso_ip_limit' );
if (!preg_match("/".$REMOTE_ADDR."/", $ofsso_ip_limit)) 
{
   die( "Restricted access, $REMOTE_ADDR is not allowed" );
}
