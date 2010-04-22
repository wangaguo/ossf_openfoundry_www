<?php 
/**
* PollXT List Module for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.00
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

//load the language file
$lang =& JFactory::getLanguage();
$lang->load("com_pollxt");

require_once(JPATH_SITE."/components/com_pollxt/class/pollxt.frame.php");
echo "<link rel=\"stylesheet\" href=\"".JUri::base()."components/com_pollxt/poll_bars.css\" type=\"text/css\" />"; 

$pos = $params->get('mod_target');

	$frame = new xtFrame();
	$frame->pos = $pos;
//	$frame->pollid = $pollid;
//	$frame->Itemid = $Itemid;
	$frame->task = "list";
	if ($params)
		$frame->parameters = $params;
	echo $frame->get();

?> 
