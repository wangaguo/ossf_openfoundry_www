<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.0
* @copyright (C) 2007-2008 Lee Cher Yeong
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Base plugin class.
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

class Savant2_Plugin_listalphaindex extends Savant2_Plugin {
	
	function printChar($char, $cat_id, $Itemid) {
		$html = '<a href="';
		$html .= sefRelToAbs("index.php?option=com_mtree&task=listalpha&alpha=".strtolower($char)."&cat_id=".$cat_id."&Itemid=".$Itemid);
		$html .= '" class="alpha">';
		if( $char == '0' ) {
			$html .= '0-9';
		} else {
			$html .= $char;
		}
		$html .= '</a>';
		echo $html;
	}
	function plugin($seperator=' | ') {
		global $Itemid, $_MT_LANG, $mtconf, $cat_id;
		
		$this->printChar(0, $cat_id, $Itemid);
		echo $seperator;
		$default_chars = array('0-9','A','B');
		for ( $i=65; $i < 91; $i++ )
		{ 
			$this->printChar(chr($i), $cat_id, $Itemid);
			if(!empty($seperator)) {
				echo $seperator;
			}
		}
		
		if($mtconf->get('alpha_index_additional_chars') != '') {
			for ( $i=0; $i < strlen($mtconf->get('alpha_index_additional_chars')); $i++ )
			{ 
				$this->printChar(substr($mtconf->get('alpha_index_additional_chars'), $i, 1), $cat_id, $Itemid);
				echo $seperator;
			}
		}

	}

}
?>