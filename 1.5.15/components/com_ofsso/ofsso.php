<?php
/**
 * @package    OpenFoundry SSO 
 * @subpackage Components
 * components/com_ofsso/ofsso.php
 * @link 
 * @license    OSI: MIT License 
*/
 
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );
// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}
else
{
    echo('nono<br/>');
}
 
// Create the controller
$classname    = 'OfssoController'.$controller;
$controller   = new $classname( );
 
// Perform the Request task
$controller->execute( JRequest::getWord( 'task' ) );
 
// Redirect if set by the controller
$controller->redirect();
