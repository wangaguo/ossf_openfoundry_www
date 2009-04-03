<?php
/**
 * eventCal
 *
 * Swedish language file
 *
 * @version		$Id: swedish.php 81 2006-09-22 19:14:19Z friesengeist $
 * @package		eventCal
 * @author		Gunnar Wettergren <gunnar@wresearch.se>
 * @copyright	Copyright (C) 2006 Gunnar Wettergren. All rights reserved.
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link		http://forge.joomla.org/sf/projects/eventcal
 *
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

//Translations for front_end interface
//error messages
define('_UNVALID_ACCESS','eventCal gjorde ett illegalt anrop<br />Processen avslutades<br />Om detta fel uppst�r igen kontakta din administrat�r');
define('_NO_ACCESS_CAP','Access denied');
//define('','');

//redirect-dialog
define('_MISSING_PARAM_CAP','Inte till�ten process');
define('_MISSING_PARAM_TEXT','Ett fel uppstod n�r parametrar skulle skickas.<br />Processen avbr�ts');
define('_SUCCESSFULL_ACTION_CAP', 'Aktionen framg�ngsrik!');
define('_SUCCESSFULL_POSTED', _SUBMIT_SUCCESS_DESC);
define('_ACTION_ABORTED_CAP', 'Aktionen avbr�ts');

//category-list
define('_CATLIST_HEADER','Kategorier');
define('_SELECT_ALL','V�lj alla');

//Contact Details
define('_CONTACT_CONTACT','Kontaktperson:');
define('_CONTACT_URL','Hemsida:');

//editor Form
define('_EDITOR_CAPTION','Formul�r');
define('_FORM_START_DATE','Startdatum:');
define('_FORM_END_DATE','Slutdatum:');
define('_SUBMIT_BUTTON','Skicka');
define('_RESET_BUTTON','�terst�ll');
define('_FORM_EXCEPTIONS','Undantagna datum:');
define('_FORM_REPEATCAP','�terupprepning');
define('_FORM_CATEGORY','Kategori');
define('_EVENT','H�ndelse');
define('_COUNTER_DESC', 'Mata in antal repetitioner (Undantag r�knas inte). <i>Slutdatum kommer att ignoreras</i>');

//repetition types
define('_REP_NONE','aldrig');
define('_REP_DAYLY','dagligen');
define('_REP_WEEKLY','vecko');
define('_REP_MONTHLY','m�natligt');
define('_REP_YEARLY','�rligt');

//week view
define('_WEEK_SHOW_VIEW','visa vecka vyn');
define('_WEEK_FROM','vecka fr�n');
define('_WEEK_TILL','till');
define('_LAST_WEEK','&lt; f�rra veckan');
define('_NEXT_WEEK','n�sta vecka &gt;');
define('_WEEK_WEEK','. vecka');

//month view
define('_MONTH_SHOW_VIEW','show month-view');

//dayly view
define('_DAY_SHOW_VIEW','visa daglig vy');
define('_DAY_SHOW_NEXT','n�sta dag &gt;');
define('_DAY_SHOW_LAST','&lt; sista dagen');
define('_DAY_TODAY','idag');
define('_DAY_YESTERDAY','&lt; ig�r');
define('_DAY_TOMORROW','imorgon &gt;');

//general information
define('_EVENT_CAL','Kalender');

//Date and Time Conversion Constants:
define('_DATE_SPLITTER','-');
define('_TIME_SPLITTER',':');
define('_DATE_MONTH_POS', 1); //position -beginning with 0- the month is situated at in the current date-format
define('_DATE_DAY_POS', 2);
define('_DATE_YEAR_POS', 0);

//time-formats for strftime
define('_DAYVIEW_CAPTION','%A, %x');
define('_DAYVIEW_EVENT_START','%H:%M');
define('_DAYVIEW_EVENT_END',' - %H:%M');
define('_OVERLIB_STARTDATE', 'start: %x');
define('_OVERLIB_ENDDATE', 'slut: %x');
define('_OVERLIB_STARTTIME', 'start: %H:%M');
define('_OVERLIB_ENDTIME', 'slut: %H:%M');
define('_OVERLIB_TIME_FROM', 'fr�n %H:%M');
define('_OVERLIB_TIME_TO', ' till %H:%M');
define('_OVERLIB_SINGLETIME', ' %H:%M');
define('_OVERLIB_SINGLEDATE', ' %x');
define('_OVERLIB_SINGLETIME_FROM', ' fr�n %H:%M');

define('_OVERLIB_CALENDAR','mm/dd/y');
define('_NORMAL_DATE_FORMAT','%m/%d/%Y');
define('_NORMAL_TIME_FORMAT','%H:%M');
define ('_DATE_TIME_FORMAT', '02/14/2009 00:31');

//translation for admin-interface
define('_ALL_EVENTS','visa alla h�ndelser');
define('_OLD_EVENTS','visa gamla h�ndelser');

?>