<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Base plugin class.
*/
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

/**
* Mosets Tree 
*
* @package Mosets Tree 0.8
* @copyright (C) 2004 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <cy@mosets.com>
**/


class Savant2_Plugin_editor extends Savant2_Plugin {
	function plugin($name, $text = '', $hiddenField, $width=350, $height=200, $cols=10, $rows=45)
	{
		editorArea( $name,  $text, $hiddenField, $width, $height, $cols, $rows );
	}
}
?>