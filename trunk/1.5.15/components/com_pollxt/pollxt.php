<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php
require_once(JPATH_SITE."/components/com_pollxt/class/pollxt.frame.php");

$id = JRequest::getInt('pollid', 0 );
$admin = JRequest::getInt('admin', 0 );

if (!$id) $id = JRequest::getInt('id', 0 );
$Itemid = JRequest::getInt('Itemid', 0 );
$task = JRequest::getVar('task', '' );
$activation = JRequest::getVar('activation', '' );
$isPopup = JRequest::getInt('isPopup', 0 );

//$menu = & new JMenu();
//$menu->getItem($Itemid);
//$params = $menu->getParams($Itemid);
$params = &JComponentHelper::getParams( 'com_pollxt' );
if ($task == "" && $params->def( 'xt_task' ) != "1") { 
	$task = "init";
	$id = $params->get( 'xt_pollid' );
}

$pos = "com";
if ($admin == "1") $pos = "admin";

if ($task == "voting") $task = "init";
if ($task == "") $task = "list";

$frame = new xtFrame();
$frame->pos = $pos;
$frame->pollid = $id;
$frame->Itemid = $Itemid;
$frame->task = $task;
$frame->activation = $activation;
$frame->isPopup = $isPopup;
echo $frame->get();


?>
