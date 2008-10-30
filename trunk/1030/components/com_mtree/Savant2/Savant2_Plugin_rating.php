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
* @package Mosets Tree 1.5
* @copyright (C) 2004-2006 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/


class Savant2_Plugin_rating extends Savant2_Plugin {

	function plugin($rating, $votes, $attribs)
	{
		global $mt_min_votes_to_show_rating, $Itemid, $_MT_LANG, $my, $mtree;
		
		# Load Parameters
		$params =& new mosParameters( $attribs );
		$params->def( 'show_rating', $mtree->getCfg( 'mt_show_rating' ));

		if ( $params->get( 'show_rating' ) == 1 ) {
			
			if ( isset($mt_min_votes_to_show_rating) AND $votes >= $mt_min_votes_to_show_rating ) {
				$star = round($rating, 0);
			} else {
				$star = 0;
			}
			$html = '';

			// Print starts
			for( $i=0; $i<$star; $i++) {
				$html .= '<img src="images/M_images/rating_star.png" width="9" height="11" />';
			}

			// Print blank star
			for( $i=$star; $i<5; $i++) {
				$html .= '<img src="images/M_images/rating_star_blank.png" width="9" height="11" />';
			}

			# Return the listing link
			return $html;
		} else {
			return '';
		}

	}
}
?>