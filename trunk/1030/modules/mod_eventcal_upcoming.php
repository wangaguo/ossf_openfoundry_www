<?php
/**
 * eventCal
 *
 * Frontend event-handler
 *
 * @version		$Id: mod_eventcal_upcoming.php 85 2006-09-26 23:34:50Z friesengeist $
 * @package		mod_eventcal_upcoming
 * @author		Carsten Nikiel, Kay Messerschmidt
 * @copyright	Copyright (C) 2006 Carsten Nikiel, Kay Messerschmidt. All rights reserved.
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
if (!defined( 'MOD_EVENTCAL_UPCOMING' )) {
	define( 'MOD_EVENTCAL_UPCOMING', true );

	class eventCalUpcoming {
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

		function sortEvents( &$events, $sort_by ) {
			$sortFunct = create_function('$a,$b','return $a->' . $sort_by .' > $b->' . $sort_by . ';');
			usort( $events, $sortFunct );
		}

		function findNextevents( &$events, $max_count ) {
			// Show only the next x events
			$today = time();
			$upcoming_events = null;
			$count = 0;
			foreach ($events as $event) {
				if ($count > $max_count) {
					break;
				}
				if ($event->start_date > $today) {
					$upcoming_events[] = clone( $event );
					$count++;
				}
			}
			return $upcoming_events;
		}
	}
}

// Get settings for this module from it's params
$howManyEvents		= (int) $params->get( 'howManyEvents', '5' );
$noUpcomingEvents	= $params->get( 'noUpcomingEvents', 'There are no upcoming events!' );
$template			= $params->get( 'template', '<small>{date}</small><br />{title}<br /><small style="color:black;">{desc(30)}</small>');
$date_format		= $params->get( 'dateFormat', '%d.%m.%Y' );
$catid				= $params->get( 'catid', '' );

// Load events, sort them by starting date, and filter out the next events
$events = eventCalUpcoming::loadEvents( $catid );
eventCalUpcoming::sortEvents( $events, "start_date" );
$upcoming_events = eventCalUpcoming::findNextevents( $events, $howManyEvents );

$tmpl_wildcards = array (
	'/\{title(\([0-9]{1,2}\))*\}/',
	'/\{desc(\([0-9]{1,2}\))*\}/',
	'/\{color\}/',
	'/\{cattitle\}/',
	'/\{date\}/'
);

// Get length of title
preg_match( '/\{title\(([0-9]+)\)\}/', $template, $title_length );
if (isset( $title_length[1] ) && (int) $title_length[1]) {
	$title_length = (int) $title_length[1];
} else {
	$title_length = 0;
}

// Get length of description
preg_match( '/\{desc\(([0-9]+)\)\}/', $template, $desc_length );
if (isset( $desc_length[1] ) && (int) $desc_length[1]) {
	$desc_length = (int) $desc_length[1];
} else {
	$desc_length = 0;
}

// Display output
if (count ($upcoming_events)) {
	foreach ( $upcoming_events AS $event ) {
		if ($title_length) {
			$title	= substr( $event->title, 0, $title_length);
		} else {
			$title	= $event->title;
		}
		if ($desc_length) {
			$desc	= substr( $event->description, 0, $desc_length - 3 ) . "...";
		} else {
			$desc	= $event->description;
		}
		$tmpl_replace = array(
			htmlspecialchars( $title ),
			htmlspecialchars( $desc ),
			htmlspecialchars( $event->getColor() ),
			htmlspecialchars( $event->category ),
			htmlspecialchars( strftime( $date_format, $event->start_date ) )
		);
		$tmpl_output = preg_replace( $tmpl_wildcards, $tmpl_replace, $template );
		?>
		<div style="border-left: 6px solid <?php echo $event->getColor(); ?>; margin: 2px; padding-left: 4px;">
			<a href="<?php echo sefRelToAbs( "index.php?option=com_eventcal&task=event&eventid=" . (int) $event->id . "&date=" . (int) $event->start_date ); ?>">
				<?php echo $tmpl_output ?>
			</a>
		</div>
		<?php
	}
} else {
	echo htmlspecialchars( $noUpcomingEvents );
}
?>