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
* @package Mosets Tree 2.0
* @copyright (C) 2004-2008 Lee Cher Yeong
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/


class Savant2_Plugin_rating extends Savant2_Plugin {

	function plugin($rating, $votes, $attribs)
	{
		global $Itemid, $_MT_LANG, $my, $mtconf;
		
		# Load Parameters
		$params =& new mosParameters( $attribs );
		$params->def( 'show_rating', $mtconf->get('show_rating') );

		$rating = ($rating>5) ? 5 : $rating;
		if ( $params->get( 'show_rating' ) == 1 ) {

			if ( $votes >= $mtconf->get('min_votes_to_show_rating') ) {
				$star = floor($rating);
			} else {
				$star = 0;
			}
			$html = '';

			// Print starts
			for( $i=0; $i<$star; $i++) {
				$html .= '<img src="components/com_mtree/img/star_10.gif" width="14" height="14" hspace="1" class="star" />';
			}

			if( ($rating-$star) >= 0.5 && $star > 0 ) {
				$html .= '<img src="components/com_mtree/img/star_05.gif" width="14" height="14" hspace="1" class="star" />';
				$star += 1;
			}

			// Print blank star
			for( $i=$star; $i<5; $i++) {
				$html .= '<img src="components/com_mtree/img/star_00.gif" width="14" height="14" hspace="1" class="star" />';
			}

			# Return the listing link
			return $html;
		} else {
			return '';
		}

	}
}
?>