<?php
/**
 * eventCal
 *
 * eventCal SearchBot
 *
 * @version		$Id: eventcal.searchbot.php 58 2006-09-02 19:56:27Z kay_messers $
 * @package		eventCal
 * @author		Kay Messerschmidt <kay_messers@email.de>
 * @copyright	Copyright (C) 2006 Kay Messerschmidt. All rights reserved.
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link		http://forge.joomla.org/sf/projects/eventcal
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$_MAMBOTS->registerFunction( 'onSearch', 'botEventCal' );

/**
 * Search eventCal
 *
 * The sql must return the following fields that are used in a common display
 * routine: href, title, section, created, text, browsernav
 *
 * @param string Target search string
 * @param string mathcing option, exact|any|all
 * @param string ordering option, newest|oldest|popular|alpha|category
 */
function botEventCal( $text, $phrase='', $ordering='' ) {
	global $database, $my;

	$text = trim( $text );
	if ($text == '') {
		return array();
	}

	switch ( $ordering ) {
		case 'alpha':
			$order = 'e.name ASC';
			break;

		case 'category':
			$order = 'c.name ASC';
			break;

		case 'popular':
		case 'newest':
		case 'oldest':
		default:
			$order = 'e.title DESC';
			break;
	}

	// $text becomes escaped by com_search. No SQL injection possible here.
	$query = "SELECT e.title AS title, e.description AS text, e.id AS id,"
		. "\n c.name AS category"
		. "\n FROM #__eventcal AS e"
		. "\n LEFT JOIN #__categories AS c ON c.id = e.catid"
		. "\n WHERE ( e.title LIKE '%$text%'"
		. "\n OR e.description LIKE '%$text%' )"
		. "\n AND e.published = 1"
		. "\n AND c.published = 1"
		. "\n AND c.access <= $my->gid"
		. "\n ORDER BY $order";

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	/**
	 * @TODO: Translate "Veranstaltungskalender"
	 */
	$count = count( $rows );
	for ($i = 0; $i < $count; $i++) {
		$rows[$i]->title		= $rows[$i]->category . ": " . $rows[$i]->title;
		$rows[$i]->href			= 'index.php?option=com_eventcal&task=event&eventid='. $rows[$i]->id;
		$rows[$i]->section		= 'Veranstaltungskalendar';
		$rows[$i]->created		= "";
		$rows[$i]->browsernav	= "";
	}
	return $rows;
}
?>