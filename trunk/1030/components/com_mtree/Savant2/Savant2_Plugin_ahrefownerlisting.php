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

class Savant2_Plugin_ahrefownerlisting extends Savant2_Plugin {
	
	function plugin( &$link, $attr=null )
	{
		global $Itemid, $_MT_LANG, $mtree;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_ownerlisting', $mtree->getCfg( 'mt_show_ownerlisting' ));

		if ( $params->get( 'show_ownerlisting' ) == 1 ) {

			$html = '<img src="images/M_images/indent1.png" width="9" height="9" />';

			$html .= '<a href="';

			$html .= sefRelToAbs("index.php?option=com_mtree&task=viewowner&user_id=".$link->user_id."&Itemid=".$Itemid);
			
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
			
			$html .= '>'.$_MT_LANG->ALL_OWNERS_LISTING	."</a>";

			# Return the contact owner link
			return $html;
		}

	}

}
?>