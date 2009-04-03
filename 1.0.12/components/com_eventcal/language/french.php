<?php
/**
 * eventCal
 *
 * French language file
 *
 * @version		$Id: french.php 76 2006-09-18 22:43:46Z friesengeist $
 * @package		eventCal
 * @author		Michael Ulrich
 * @author		Yves Caloz
 * @author		Kay Messerschmidt <kay_messers@email.de>
 * @copyright	Copyright (C) 2006 Kay Messerschmidt. All rights reserved.
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link		http://forge.joomla.org/sf/projects/eventcal
 *
 * Thanks to Michael Ulrich and Yves Caloz for this translation
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

//Translations for front_end interface
//error messages
define('_UNVALID_ACCESS','Der Event Kalender wurde ungltig aufgerufen.<br />Der Vorgang wurde abgebrochen!<br />Sollte dieser Fehler erneut auftreten wende Dich bitte an die Administratoren!<br /> Falls mï¿½lich gib uns bitte eine genaue Fehlerbeschreibung, damit wir den Fehler rekonstruieren kï¿½nen. Danke!');
define('_NO_ACCESS_CAP','Accès non autorisé');
//define('','');

//redirect-dialog
define('_MISSING_PARAM_CAP','processus interdit');
define('_MISSING_PARAM_TEXT','Il y a un problème avec les paramètres.<br />Le processus est terminé!');
define('_SUCCESSFULL_ACTION_CAP', 'Succès');
define('_SUCCESSFULL_POSTED', _SUBMIT_SUCCESS_DESC);
define('_ACTION_ABORTED_CAP', 'Echec');

//category-list
define('_CATLIST_HEADER','catégories');
define('_SELECT_ALL','choisi tout');

//Contact Details
define('_CONTACT_CONTACT','personne à contacter:');
define('_CONTACT_URL','site personnel:');

//editor Form
define('_EDITOR_CAPTION','formulaire');
define('_FORM_START_DATE','date début:');
define('_FORM_END_DATE','date fin:');
define('_SUBMIT_BUTTON','enregistrer');
define('_RESET_BUTTON','reinitialiser');
define('_FORM_EXCEPTIONS','date exceptionelle:');
define('_FORM_REPEATCAP','répétition');
define('_FORM_CATEGORY','catégorie');
/*********** Please post translations to http://forge.joomla.org/sf/go/post11778 *************/
define('_EVENT','Event');
define('_COUNTER_DESC', 'Enter repetition count (Exceptions not counted). <i>Enddate will be ignored</i>');

//repetition types
define('_REP_NONE','never');
define('_REP_DAYLY','dayly');
define('_REP_WEEKLY','weekly');
define('_REP_MONTHLY','monthly');
define('_REP_YEARLY','yearly');
/*********************************************************************************************/

//week view
define('_WEEK_SHOW_VIEW','voir une semaine');
define('_WEEK_FROM','semaine de');
define('_WEEK_TILL',' à  ');
define('_LAST_WEEK','&lt; semaine dernière');
define('_NEXT_WEEK','semaine prochaine &gt;');
define('_WEEK_WEEK','. semaine');

//month view
define('_MONTH_SHOW_VIEW','voir un mois');

//dayly view
define('_DAY_SHOW_VIEW','afficher journée en cours');
define('_DAY_SHOW_NEXT','afficher demain &gt;');
define('_DAY_SHOW_LAST','&lt; afficher hier');
define('_DAY_TODAY','aujourd&apos;hui');
define('_DAY_YESTERDAY','&lt; hier');
define('_DAY_TOMORROW','demain &gt;');

//general information
define('_EVENT_CAL','Calendrier des évenements');

//Date and Time Conversion Constants:
define('_DATE_SPLITTER','.');
define('_TIME_SPLITTER',':');
define('_DATE_MONTH_POS', 1); //position -beginning with 0- the month is situated at in the current date-format
define('_DATE_DAY_POS', 0);
define('_DATE_YEAR_POS', 2);

//time-formats for strftime
define('_DAYVIEW_CAPTION','%A, %x');
define('_DAYVIEW_EVENT_START','%H:%M');
define('_DAYVIEW_EVENT_END',' - %H:%M');
define('_OVERLIB_STARTDATE', 'début: %x');
define('_OVERLIB_ENDDATE', 'fin: %x');
define('_OVERLIB_STARTTIME', 'début: %H:%M');
define('_OVERLIB_ENDTIME', 'fin: %H:%M');
define('_OVERLIB_TIME_FROM', 'de %H:%M');
define('_OVERLIB_TIME_TO', ' à  %H:%M');
define('_OVERLIB_SINGLETIME', ' %H:%M');
define('_OVERLIB_SINGLEDATE', ' %x');
define('_OVERLIB_SINGLETIME_FROM', ' ab %H:%M');

define('_OVERLIB_CALENDAR','dd/mm/y');
define('_NORMAL_DATE_FORMAT','%d/%m/%Y');
define('_NORMAL_TIME_FORMAT','%H:%M');
define('_DATE_TIME_FORMAT', '14/02/2009 00:31');

//translation for admin-interface
define('_ALL_EVENTS','Afficher tous les événements');
define('_OLD_EVENTS','Afficher tous les événements passés');

?>