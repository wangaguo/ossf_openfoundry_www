<?php
/**
* Mosets Tree toolbar 
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2007 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if ( !class_exists('mtConfig') ) {
	class mtConfig {
		var $_db=null;
		var $mtconfig=null;
		var $jconfig=null;
		var $params=null;

		function mtConfig($db) {
			$this->_db=$db;
			$db->setQuery( 'SELECT `varname`, `value`, `default` FROM #__mt_config' );
			$this->mtconfig = $db->loadObjectList('varname');

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				foreach($GLOBALS AS $key=>$value) {
					if( substr($key,0,10) == 'mosConfig_' ) {
						$this->jconfig[substr($key,10)] = $value;
					}
				}
			} else {
				/*
				if(class_exists('JCONFIG')) {
					$jconfig_vars = get_class_vars('JCONFIG');
					foreach ($jconfig_vars as $name => $value) {
					    // echo "<br />$name : $value\n";
					}
				}
				*/
				global $mainframe;
				$this->jconfig['absolute_path'] = JPATH_SITE;
				$this->jconfig['live_site'] = JURI::root();
				$this->jconfig['sitename'] = $mainframe->getCfg('sitename');
				$this->jconfig['offset'] = $mainframe->getCfg('offset');
				$this->jconfig['MetaTitle'] = $mainframe->getCfg('MetaTitle');
				$this->jconfig['MetaAuthor'] = $mainframe->getCfg('MetaAuthor');
				$this->jconfig['sef'] = $mainframe->getCfg('sef');
				$this->jconfig['cachepath'] = JPATH_BASE.DS.'cache';
			}

		}

		function get($varname){
			if(array_key_exists($varname,$this->mtconfig)) {
				$value = $this->mtconfig[$varname]->value;
			} else {
				$value = '';
			}
		  	if (((is_null($value) || trim($value) == "") && $value !== false) || (is_array($value) && empty($value))) {
				return $this->getDefault($varname);
			} else {
				return $this->mtconfig[$varname]->value;
			}
		}
		
		function set($varname,$value) {
			$this->mtconfig[$varname]->value = $value;
		}

		function getjconf($varname){
			return $this->jconfig[$varname];
		}
	
		function getTemParam($key,$default='') {
			if(is_null($this->params)) {
				$this->_db->setQuery('SELECT params FROM #__mt_templates WHERE tem_name = \'' . $this->get('template') . '\' LIMIT 1');
				$params = $this->_db->loadResult();
				$this->params = new mosParameters( $params );
			}
			return $this->params->get( $key, $default );
		}
	
		function getDefault($varname){
			return $this->mtconfig[$varname]->default;
		}

		function getVarArray() {
			foreach( $this->mtconfig AS $key=>$value) {
				if (((is_null($value->value) || trim($value->value) == "") && $value->value !== false) || (is_array($value->value) && empty($value->value))) {
					$vars[$key] = $this->getDefault($key);
				} else {
					$vars[$key] = $value->value;
				}
			}
			return $vars;
		}
	
		function getJVarArray() {
			foreach( $this->jconfig AS $key=>$value) {
				$vars[$key] = $value;
			}
			return $vars;
		}
	}
}
?>