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
* @copyright (C) 2007 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/


class Savant2_Plugin_review_rating extends Savant2_Plugin {

	function plugin($rating)
	{
		if( $rating > 0 && $rating <= 5 ) {
			$star = round($rating, 0);
			$html = '';

			// Print starts
			for( $i=0; $i<$star; $i++) {
				$html .= '<img src="components/com_mtree/img/star_10.gif" width="16" height="16" hspace="1" />';
			}

			// Print blank star
			for( $i=$star; $i<5; $i++) {
				$html .= '<img src="components/com_mtree/img/star_00.gif" width="16" height="16" hspace="1" />';
			}

			# Return the listing link
			return $html;
		} else {
			return '';
		}

	}
}
?>