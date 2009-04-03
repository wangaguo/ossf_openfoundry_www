<?php
/**
 * eventCal
 *
 * eventCal Mini Module
 *
 * @version		$Id: mod_eventcal_mini.php 88 2006-09-28 01:32:37Z friesengeist $
 * @package		mod_eventcal_mini
 * @author		Kay Messerschmidt
 * @copyright	Copyright (C) 2006 Kay Messerschmidt. All rights reserved.
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link		http://forge.joomla.org/sf/projects/eventcal
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// Load required eventCal component files or return
if (file_exists( $mainframe->getPath( 'class', 'com_eventcal' ) )) {
	require_once( $mainframe->getPath( 'class', 'com_eventcal' ) );
	require_once( $mosConfig_absolute_path . '/components/com_eventcal/includes/recursion.php' );
} else {
	echo 'eventCal Component not found!<br />';
	return;
}

// eventcal.class.php needs this
if (!defined('_DATE_TIME_FORMAT')) {
	define('_DATE_TIME_FORMAT','14.02.2009 00:31:30');
}

// Make sure functions are declared only once (in case this module is displayed multiple times)
if (!defined( 'MOD_EVENTCAL_MINI' )) {
	define( 'MOD_EVENTCAL_MINI', true );

	class eventCalMini {
		/**
		 * loadEvents - Loads all events from the database with just one query
		 *
		 * @return	array	An array of all eventCal events as objects
		 */
		function loadEvents( $catid ) {
			global $database, $my;

			// Load all Events
			$where = '';
			$catids = explode( ',', $catid );
			if (!in_array( 0, $catids ) ) {
				mosArrayToInts( $catids );
				$where = "\n AND ( c.id=" . implode( " OR c.id=", $catids ) . " )";
			}
			$query = "SELECT e.*, c.name AS category, c.params AS cat_params"
				. "\n FROM #__eventcal AS e"
				. "\n LEFT JOIN #__categories AS c ON c.id = e.catid"
				. "\n WHERE e.published = 1 AND c.published = 1 AND c.access <= " . (int) $my->gid
				. $where
			;
			$database->setQuery( $query );
			$eventsRaw = $database->loadAssocList( 'id' );

			// Make event objects out of them
			$events = array();
			foreach( $eventsRaw as $eventRaw ) {
				$event = new mosEventCal_Event();
				$event->bindRaw( $eventRaw );
				$events[] = $event;
			}
			unset( $eventsRaw );

			// Add repeating events
			eventCal_Recursion::mkRecurrent( $events );

			return $events;
		}

		function echoCSS() {
			global $mosConfig_live_site;
			echo '<link href="' . $mosConfig_live_site . '/modules/mod_eventcal_mini.css" rel="stylesheet" type="text/css" />';
		}

		function monthView( $events, $first_day_of_month, $last_day_of_month, $week_starting_day, $day_chars_count, $moduleclass_sfx ) {
			global $mainframe;
			$week_days = Array("sunday","monday","tuesday","wednesday","thursday","friday","saturday","sunday");

			mosCommonHTML::loadOverlib();
			$actual_day = new mosEventCal_DateTimeObject( $first_day_of_month->timestamp );
			echo '<table width="100%" class="eventcal_mini' . $moduleclass_sfx . '" style="table-layout: fixed;">';
			echo '<tr>';
			$today = new mosEventCal_DateTimeObject( time() );
			$today->offset( "$week_days[$week_starting_day]" );
			for( $i = 0; $i < 7; $i++ ) {
				echo '<td class="header">';
				echo substr( $today->strftime( "%a" ), 0, $day_chars_count );
				$today->offset( "+ 1 day" );
				echo '</td>';
			}
			echo '</tr>';
			$today->update( time() );
			$today->clearTime();
			while ( $actual_day->timestamp <= $last_day_of_month->timestamp) {
				echo '<tr>';
				$actual_wday = $week_starting_day;
				$i = 0;
				while( $i < 7 ) {
					if ($actual_day->timestamp > $last_day_of_month->timestamp) {
						echo '<td class="empty">';
					} else if ($actual_day->timestamp == $today->timestamp) {
						$overlib	= eventCalMini::mkOverlib( $events, $actual_day );
						$active		= $overlib ? ' active' : '';
						echo '<td class="today' . $active . '" ' . $overlib . '>';
							echo '<a href="' . sefRelToAbs('index.php?option=com_eventcal&task=day&date=' . $actual_day->timestamp) .'&Itemid=243'. '">';
								echo $actual_day->strftime( "%d" );
							echo '</a>';
						$actual_day->offset( "+ 1 day" );
					} else if ($actual_day->date["wday"] == $actual_wday) {
						$overlib	= eventCalMini::mkOverlib( $events, $actual_day );
						$active		= $overlib ? ' active' : '';
						echo '<td class="month' . $active . '" ' . $overlib . '>';
							echo '<a href="' . sefRelToAbs('index.php?option=com_eventcal&task=day&date=' . $actual_day->timestamp) .'&Itemid=243'. '">';
								echo $actual_day->strftime( "%d" );
							echo '</a>';
						$actual_day->offset( "+ 1 day" );
					} else echo '<td class="empty">';
					if ($actual_wday < 6) $actual_wday++;
					else $actual_wday = 0;
					$i++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</table>';
			echo '<div id="overlib"></div>';
		}

		function mkOverlib( $events, $day ) {
			$events_for_this_day = array();
			$events_for_this_day = eventCal_Recursion::getDateEvents( $events, $day );
			if (!$events_for_this_day) {
				return false;
			}
			$text = '';
			foreach( $events_for_this_day AS $event ) {
				$text .= '<span style=&quot;border-left:solid 10px ' . $event->getColor() .  ';&quot;>&nbsp;&nbsp;' . htmlspecialchars( $event->title, ENT_QUOTES ) . '</span><br/>';
			}

			$return = 'onmouseover="return overlib(\'' . $text . '\',CAPTION,\'' . $day->strftime("%x") . '\', BELOW, RIGHT, BGCOLOR, \'#000000\', OFFSETX, \'10\');"';
			$return .= ' onMouseOut="return nd();"';
			return $return;
		}
	}
}

// Get settings for this module from it's params
//$view				= $params->get( 'view', 'month' ); // Only month view supported at this time!
$week_starting_day	= (int) $params->get( 'week_startingday', 0 ); // Hardcoded at this time
$day_chars_count	= (int) $params->get( 'day_chars_count', 5 );
$catid				= $params->get( 'catid', '' );
$moduleclass_sfx	= $params->get( 'moduleclass_suffix', '' );

//switch ( $view ) {
//	case "week":
//		break;
//
//	case "day":
//		break;
//
//	case "month":
//	default:
		$today = new mosEventCal_DateTimeObject( time() );
		$first_day_of_month =& $today->startOfMonth();
		$last_day_of_month =& $today->endOfMonth();
		$events = eventCalMini::loadEvents( $catid );
		eventCalMini::echoCSS();
		eventCalMini::monthView( $events, $first_day_of_month, $last_day_of_month, $week_starting_day, $day_chars_count, $moduleclass_sfx );
//		break;
//}
?>
