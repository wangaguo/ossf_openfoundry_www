<?php
/**
* @version 2.0.2
* @package Raf Cloud
* @copyright Copyright (C) 2007 Skorp. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Raf Cloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @Author: Rafal Blachowski (Skorp) <http://joomla.royy.net>
*/


	defined( '_VALID_MOS' ) or die( 'Restricted access' );
	$descr= "Joomla Letterman Plugin v 2.0.2"; //short information about plugin

	global $database;

if (($runMe)&&($loadWord))
{
	$database->setQuery("SELECT subject,message,html_message FROM #__letterman WHERE published=1");
	if ($cur = $database->query()) 
	{
		while ($row = mysql_fetch_object( $cur )) 
		{
			$stag.= " ".$row->subject;
			$stag.= " ".$row->message;
			$stag.= " ".$row->html_message;
			if ($this->cacheTag($stag,$metaKey)) 			{$stag=null; $metaKey=null;}
		}
	}
}
?>