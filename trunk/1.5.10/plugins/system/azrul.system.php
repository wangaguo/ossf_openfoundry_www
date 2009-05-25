<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

global $mosConfig_absolute_path, $mainframe, $_MAMBOTS;

if(!defined('CMSLIB_DEFINED'))
	include_once ((dirname(dirname(dirname(__FILE__)))). '/components/libraries/cmslib/spframework.php');

if(cmsVersion() == _CMS_JOOMLA10){
    $_MAMBOTS->registerFunction('onAfterStart', 'azrulSysBot');
}else if(cmsVersion() == _CMS_MAMBO){
    $_MAMBOTS->registerFunction('onHeaders', 'azrulSysBot');
}else if(cmsVersion() == _CMS_JOOMLA15){
	$mainframe->registerEvent( 'onAfterInitialise', 'azrulSysBot' );
}

$cms =& cmsInstance('CMSCore');
include_once($cms->get_path('plugins') . "/system/pc_includes/template.php");

function azrulSysBot(){
	static $headerAdded = false;
	
	
	// Make sure the header are added only once
	if(!$headerAdded){
		global $option, $database, $mainframe;
		$cms    =& cmsInstance('CMSCore');
		
		require_once($cms->get_path('plugins') . '/system/pc_includes/ajax.php');
	
		$jax = new JAX($cms->get_path('plugin-live') . '/system/pc_includes');
		$jax->setReqURI($cms->get_path('live') . '/index.php');
		$jax->process();
	
		if (!isset ($_POST['no_html'])) {
			$mainframe->addCustomHeadTag($jax->getScript());
		}
		$headerAdded = true;
	}
}
