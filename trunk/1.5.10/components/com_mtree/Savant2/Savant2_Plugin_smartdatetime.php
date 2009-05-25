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
* @copyright (C) 2006 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/


class Savant2_Plugin_smartdatetime extends Savant2_Plugin {

	function plugin( $datetime ) {
		global $mosConfig_offset, $_MT_LANG;

		if ( $datetime == '0000-00-00 00:00:00' ) {
			return $_MT_LANG->NEVER;
		}

		//$time_now = time()+$mosConfig_offset*60*60;
		$time_now = time();
		$time_str = strtotime( $datetime );

		$day_str = mktime( 0, 0, 0, date("m",$time_str),date("d",$time_str),date("Y",$time_str));
		$day_now = mktime( 0, 0, 0, date("m",$time_now),date("d",$time_now),date("Y",$time_now));
		
		# Today's date
		if ($day_now == $day_str) {
			$minutes = ceil(($time_now - $time_str)/60);
			if( $minutes < 60 ) {
				if($minutes == 1) {
					return sprintf( $_MT_LANG->MINUTE_AGO, $minutes );
				} else {
					return sprintf( $_MT_LANG->MINUTES_AGO, $minutes );
				}
			} else {
				$hours = ceil(($time_now - $time_str)/3600);
				if($hours == 1) {
					return  sprintf( $_MT_LANG->HOUR_AGO, $hours );
				} else {
					return  sprintf( $_MT_LANG->HOURS_AGO, $hours );
				}
			}
		} else {
			$days = ceil(($time_now - $time_str)/86400);
			if($days == 1) {
				return  sprintf( $_MT_LANG->DAY_AGO, $days );
			} else {
				return  sprintf( $_MT_LANG->DAYS_AGO, $days );
			}
		}

	}

}
?>