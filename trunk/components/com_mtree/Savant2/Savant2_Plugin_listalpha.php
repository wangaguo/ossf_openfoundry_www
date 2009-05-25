<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.0
* @copyright (C) 2004-2008 Lee Cher Yeong
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Base plugin class.
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

class Savant2_Plugin_listalpha extends Savant2_Plugin {
	
	function plugin($alpha, $cat_id=null, $attr=null)
	{
		global $Itemid, $_MT_LANG;

		if ( $cat_id == null || !is_numeric($cat_id) ) {
			global $cat_id;
		}

		if ( eregi("[a-z0]{1}[0-9]*", $alpha) ) {

			$html = '<a href="';
			$html .= sefRelToAbs("index.php?option=com_mtree&task=listalpha&alpha=".strtolower($alpha)."&cat_id=".$cat_id."&Itemid=".$Itemid);
			$html .= '"';
			
			# Insert attributes
			if (is_array($attr)) {
				// from array
				foreach ($attr as $key => $val) {
					$key = htmlspecialchars($key);
					$val = htmlspecialchars($val);
					$html .= " $key=\"$val\"";
				}
			} elseif (! is_null($attr)) {
				// from scalar
				$html .= " $attr";
			}

			$html .= '>';
			if ( $alpha == "0" ) {
				$html .= "0-9";
			} else {
				$html .= strtoupper($alpha);
			}
			$html .= "</a>";

			# Return the listalpha link
			return $html;
		}

	}

}
?>