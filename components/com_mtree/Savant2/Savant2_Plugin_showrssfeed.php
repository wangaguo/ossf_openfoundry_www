<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.0
* @copyright (C) 2007 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Base plugin class.
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

class Savant2_Plugin_showrssfeed extends Savant2_Plugin {
	
	function plugin( $type )
	{
		global $Itemid, $mtconf;
		$html = '';
		if($type == 'listnew' || $type == 'listupdated') {
			$type = substr($type,4);
		}
		
		if( $type == 'new' || $type == 'updated' ) {
			if( $mtconf->get('show_list' . $type . 'rss') ) {
				$html = '<a href="';
				$html .= 'index.php?option=com_mtree&task=rss&type=' . $type . '&Itemid=' . $Itemid;
				$html .= '">';
				$html .= '<img src="components/com_mtree/img/rss.png" width="14" height="14" hspace="5" alt="RSS" border="0" />';
				$html .= '</a>';
			}
		}
		return $html;
	}

}
?>