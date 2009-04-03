<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Base plugin class.
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

class Savant2_Plugin_ahrefvisit extends Savant2_Plugin {
	
	function plugin( &$link, $text='', $newwin=1, $attr=null )
	{
		global $_MT_LANG, $mtree, $Itemid;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_visit', $mtree->getCfg( 'mt_show_visit' ));

		if ( $params->get( 'show_visit' ) == 1 && !empty($link->website) ) {

			$html = '<img src="images/M_images/indent1.png" width="9" height="9" />';
			$html .= '<a href="';
			$html .= sefRelToAbs("index.php?option=com_mtree&task=visit&link_id=".$link->link_id."&Itemid=".$Itemid);
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
			
			if ($newwin) $html .= ' target="_blank"';

			$html .= '>';
			
			if ( empty($text) ) {
				$html .= $_MT_LANG->VISIT;
			} else {
				$html .= $text;
			}

			$html .= "</a>";

			# Return the visit link
			return $html;
		
		}

	}

}
?>