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

class Savant2_Plugin_ahrefreview extends Savant2_Plugin {
	
	function plugin(&$link, $attr=null)
	{
		global $Itemid, $_MT_LANG, $mtconf;//, $mt_show_review;

		# Load Parameters
		$params =& new mosParameters( $link->attribs );
		$params->def( 'show_review', $mtconf->get('show_review') );

		if ( $params->get( 'show_review' ) == 1 ) {

			$html = '';
			// $html = '<img src="images/M_images/indent1.png" width="9" height="9" />';

			$html .= '<a href="';

			$html .= sefRelToAbs("index.php?option=com_mtree&task=writereview&link_id=".$link->link_id."&Itemid=".$Itemid);

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

			$html .= '>'.$_MT_LANG->WRITE_REVIEW	."</a>";

			# Return the review link
			return $html;
		}

	}

}
?>