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

class Savant2_Plugin_ahrefcontact extends Savant2_Plugin {
	
	function plugin( &$link, $attr=null )
	{
		global $Itemid, $_MT_LANG, $mtree;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_contact', $mtree->getCfg( 'mt_show_contact' ));
		$params->def( 'use_owner_email', $mtree->getCfg( 'mt_use_owner_email' ));
		
		if ( ($params->get( 'show_contact' ) == 1 && $link->email <> '') OR ( $params->get( 'show_contact' ) == 1 && $link->user_id > 0 ) ) {

			$html = '<img src="images/M_images/indent1.png" width="9" height="9" />';

			$html .= '<a href="';

			$html .= sefRelToAbs("index.php?option=com_mtree&task=contact&link_id=".$link->link_id."&Itemid=".$Itemid);
			
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
			
			$html .= '>'.$_MT_LANG->CONTACT_OWNER."</a>";

			# Return the contact owner link
			return $html;
		}

	}

}
?>