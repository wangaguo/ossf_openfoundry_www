<?php 
/**
* PollXT Module for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.02
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

//load the language file
$lang =& JFactory::getLanguage();
$lang->load("com_pollxt");

require_once(JPATH_SITE."/components/com_pollxt/class/pollxt.frame.php");
$xt_resultsId = JRequest::getInt('xt_resultsId', 0 );
$Itemid = JRequest::getInt('Itemid', 0 );

//$params = &JComponentHelper::getParams( 'mod_pollxt' );
$pollid = $params->get('mod_pollid');

	$frame = new xtFrame();
	$frame->pos = "mod";
	$frame->pollid = $pollid;
	$frame->Itemid = $Itemid;
	$frame->task = "init";
	if ($params)
		$frame->parameters = $params;
	echo $frame->get();

?> 
