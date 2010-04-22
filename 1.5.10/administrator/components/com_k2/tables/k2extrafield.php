<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

class TableK2ExtraField extends JTable
{

	var $id = null;
	var $name = null;
	var $value = null;
	var $type = null;
	var $group = null;
	var $published = null;
	var $ordering = null;

	function __construct( & $db) {
		parent::__construct('#__k2_extra_fields', 'id', $db);
	}
	
}