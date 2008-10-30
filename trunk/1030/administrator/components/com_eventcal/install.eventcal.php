<?php
/**
 * eventCal
 *
 * Frontend event-handler
 *
 * @version		$Id: install.eventcal.php 87 2006-09-27 23:18:20Z friesengeist $
 * @package		eventCal
 * @author		Kay Messerschmidt <kay_messers@email.de>
 * @copyright	Copyright (C) 2006 Kay Messerschmidt. All rights reserved.
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link		http://forge.joomla.org/sf/projects/eventcal
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
 
function com_install() {
	global $database;
?>

<table class="adminheading">
	<tr>
		<th class="install">
			Installation of eventCal <small><small>by Kay Messerschmidt</small></small>
		</th>
	</tr>
</table>

<table class="adminform" style="empty-cells:hide">
<?php
$install_errors = false;
// Set up new icons for admin menu
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/categories.png' WHERE admin_menu_link='option=com_eventcal&task=categories'");
if ($database->query() === false) {
	$install_errors = "Error updating database. Backend Menu Items (categories) not updated.<br/>";
}
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/edit.png' WHERE admin_menu_link='option=com_eventcal'");
if ($database->query() === false) {
	$install_errors .= "Error updating database. Backend Menu Items (events) not updated.<br/>";
}
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_eventcal&task=config'");
if ($database->query() === false) {
	$install_errors .= "Error updating database. Backend Menu Items (configuration) not updated.<br/>";
}
// Move the componentid for existing menu items to the new component id, so that parameters can still be set through the eventCal interface
$database->setQuery("SELECT id FROM #__components WHERE `option`='com_eventcal' AND parent=0 ORDER BY id DESC LIMIT 1");
$component_id = (int) $database->loadResult();
if ($component_id) {
	$database->setQuery("UPDATE #__menu SET componentid=" . (int) $component_id . " WHERE type='components' AND link LIKE '%index.php?option=com_eventcal%'");
	if ($database->query() === false) {
		$install_errors .= "Error updating database. Existing Menu Items (componentid) not updated.<br/>";
	}
}
if ($install_errors) {?>
	<tr>
		<td class="menudottedline" style="background-color:red;" colspan="2" >
			Installation notices:
		</td>
		<td>
		<?php
			echo $install_errors;
		?>
			All the above errors are very small errors, mainly making the user interface of eventCal a little bit more friendly.
			You don't need to worry about them!
		</td>
	</tr>
<?php
}
?>
	<tr>
		<th colspan="2">
			eventCal - The Event Calendar System for Joomla!
		</th>
	</tr>
	<tr>
		<td colspan=2>
			<p>
			Programming started in 2005 for our own needs and since then eventCal has evolved into a nice Joomla! application.<br/>
			In addition to the just now installed main component eventCal provides tiny add ons for your Joomla! CMS. To keep your users up with the current events on your site <b>eventCal upcoming</b> was written.
			If you want to provide a small and much less detailed version of the main calendar component for example in your menu bar there was developed <b>eventCal mini</b>.
			Having a large amount of events on your website using the <b>Search eventCal</b> Plugin will make finding events easier.
			<p/>
			<p>
			<h3>Got interested in eventCal's addons?</h3>
			Everything about eventCal and it's addons as well as news on releases or bug-fixes can be found at <a href="http://forge.joomla.org/sf/projects/eventcal" target="_blank">eventCal's homepage</a> at the forge.<br/>
			Refer to this site whenever you got issues concerning this tiny peace of software.
			<p/>
			<p>
			<h3>Inspired by eventCal?</h3>
			If you hold that eventCal is a nice and useful Joomla! component, we kindly ask you to support us by voting for or commenting on eventCal at the official <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,902/Itemid,35/" target="_blank">Joomla! Extensions Directory</a>.
			</p>
			<p>
			<h3>Getting started?!</h3>
			Don't know what to do next? Refer to the <a href="http://forge.joomla.org/sf/wiki/do/viewPage/projects.eventcal/wiki/EndUserDocumentation" target="_blank">End User Documentation</a> on our homepage. There you get help on configuring eventCal the first time. And if you got tired of the standard configuration you may discover a lot of small features to switch on or off just as you like.<br/>
			You found mistakes in the documentation or think something is not explained well? No problem, we appreciate any help. Feel free to add and edit articles at the End-User-Documentation's wiki-pages.<br/>
			And now? Let's go!
			</p>
			<p style="font-weight:bold">
			We wish you a lot of fun with this component.<br/>
			Your development team<br/>
			Kay, Enno, Carsten 
			<p/>
		</td>
	</tr>
</table>
<?php
}
?>