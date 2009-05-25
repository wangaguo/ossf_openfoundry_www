<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 0.8
* @copyright (C) 2004 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <cy@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Base plugin class.
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

class Savant2_Plugin_ahrefprint extends Savant2_Plugin {
	
	function plugin( &$link, $attr=null )
	{
		global $mosConfig_live_site, $Itemid, $_MT_LANG, $mtconf;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_print', $mtconf->get('show_print') );

		if ( $params->get( 'show_print' ) == 1 ) {

			$html = '';
			// $html = '<img src="images/M_images/indent1.png" width="9" height="9" />';

			$html .= '<a ';

			$html .= 'href="javascript:void window.open(\''.$mosConfig_live_site.'/index2.php?option=com_mtree&amp;task=print&amp;link_id='.$link->link_id.'&amp;Itemid='.$Itemid.'\', \'win2\', \'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\');" title="Print"';
			
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
			
			$html .= '>'.$_MT_LANG->PRINT	."</a>";

			# Return the print link
			return $html;
		}

	}

}
?>