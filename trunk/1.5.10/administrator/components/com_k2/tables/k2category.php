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

class TableK2Category extends JTable
{

	var $id = null;
	var $name = null;
	var $alias = null;
	var $description = null;
	var $parent = null;
	var $extraFieldsGroup = null;
	var $published = null;
	var $image = null;
	var $access = null;
	var $ordering = null;
	var $params = null;
	var $trash = null;
	var $plugins = null;

	function __construct( & $db) {
	
		parent::__construct('#__k2_categories', 'id', $db);
	}

	function check() {
	
		if (trim($this->name) == '') {
			$this->setError(JText::_('Category must have a name'));
			return false;
		}
		if ( empty($this->alias)) {
			$this->alias = $this->name;
		}
		
		$this->alias = trim(str_replace(' ', '-', $this->alias));

		$stripthese = ',|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|â€ž|â€¹|â€™|â€˜|â€œ|â€�|â€¢|â€º|Â«|Â´|Â»|Â°';
		$strips = explode('|', $stripthese);
		foreach ($strips as $strip){
			$this->alias = str_replace($strip, '', $this->alias);
		}
		
		$params = & JComponentHelper::getParams('com_k2');
	    $SEFReplacements = array();
	    $items = explode(',', $params->get('SEFReplacements'));
	    foreach ($items as $item) {
	      if (!empty($item)) { 
	        @list($src, $dst) = explode('|', trim($item));
	        $SEFReplacements[trim($src)] = trim($dst);
	      }
	    }
		
		foreach ($SEFReplacements as $key => $value){
			$this->alias = str_replace($key, $value, $this->alias);
		}
		
		$this->alias = trim(strtolower($this->alias));
		
		
		//$this->alias = JFilterOutput::stringURLSafe($this->alias);
		if (trim(str_replace('-', '', $this->alias)) == '') {
			$datenow = & JFactory::getDate();
			$this->alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
		}
	
		return true;
	}

	function bind($array, $ignore = '')	{
	
		if (key_exists('params', $array) && is_array($array['params']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}
		
		if (key_exists('plugins', $array) && is_array($array['plugins']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['plugins']);
			$array['plugins'] = $registry->toString();
		}
		
		return parent::bind($array, $ignore);
	}

}
