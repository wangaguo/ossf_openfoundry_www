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
/**
* com_pollxt for Joomla!
* @Copyright (C) 2004 - 2008 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 1.24.16
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php
class nopolls {

	function nopolls(&$frontend) {
	  $frontend->message = _POLLXT_NO_POLLS;
	}

}
?>