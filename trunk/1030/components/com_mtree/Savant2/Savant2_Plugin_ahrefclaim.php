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

class Savant2_Plugin_ahrefclaim extends Savant2_Plugin {
	
	function plugin( &$link, $attr=null )
	{
		global $database, $Itemid, $_MT_LANG, $mtree;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_claim', $mtree->getCfg( 'mt_show_claim' ));
		
		$owner = new mosUser( $database );
		$owner->load( $link->user_id );

		if ( $params->get( 'show_claim' ) == 1 && ( $owner->usertype == 'Administrator' || $owner->usertype == 'Super Administrator' ) ) {

			$html = '<img src="images/M_images/indent1.png" width="9" height="9" />';
			$html .= '<a href="';
			$html .= sefRelToAbs("index.php?option=com_mtree&task=claim&link_id=".$link->link_id."&Itemid=".$Itemid);
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
			
			$html .= '>'.$_MT_LANG->CLAIM	."</a>";

			# Return the claim listing link
			return $html;
		}

	}

}
?>