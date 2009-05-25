<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.00
* @copyright (C) 2007-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if(!isset($database)) { global $database; }
if(!isset($mosConfig_absolute_path)) { global $mosConfig_absolute_path; }

global $mtconf;
if(!isset($mtconf)) {
	require( $mosConfig_absolute_path . '/administrator/components/com_mtree/config.mtree.class.php');
	$mtconf	= new mtConfig($database);
}

require_once( $mosConfig_absolute_path . '/components/com_mtree/language/' . $mtconf->get('language') . '.php');
if ( !isset($_MT_LANG) ) {
	$_MT_LANG =& new mtLanguage();	
}

?>