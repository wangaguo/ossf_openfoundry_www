<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// include functions
require_once (JPATH_COMPONENT.DS.'assets'.DS.'includes'.DS.'functions.php');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Create the controller
$controller = new configurationController();

// Perform the Request task
$controller->execute( JRequest::getCmd( 'task', 'edit' ) );
$controller->redirect();
?>