<?php
/**
 * @version 1.0 $Id: view.html.php 958 2009-02-02 17:23:05Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * View class for the EventList event screen
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListVieweditvip extends JView {

	function display($tpl = null)
	{
		global $mainframe;

		//Load behavior
		//jimport('joomla.html.pane');
		JHTML::_('behavior.tooltip');

		//initialise variables
		$editor 	= & JFactory::getEditor();
		$document	= & JFactory::getDocument();
		//$pane 		= & JPane::getInstance('sliders');
		$user 		= & JFactory::getUser();
		$elsettings = ELAdmin::config();

		//get vars
		$cid		= JRequest::getVar( 'cid' );
		$task		= JRequest::getVar('task');
		$url 		= $mainframe->isAdmin() ? $mainframe->getSiteURL() : JURI::base();

		//add the custom stylesheet and the seo javascript
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');
		$document->addScript($url.'administrator/components/com_eventlist/assets/js/seo.js');
		$document->addScript($url.'components/com_eventlist/assets/js/recurrence.js');
		// include the unlimited script
		$document->addScript($url.'components/com_eventlist/assets/js/unlimited.js');

		//build toolbar
		
		if ( $cid ) {
			JToolBarHelper::title( JText::_( 'EDIT VIP CODE' ), 'editmail' );
		}
		JToolBarHelper::apply();
		JToolBarHelper::spacer();
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.editmail', true );

		//get data from model
		$model		= & $this->getModel();
		$row     	= & $this->get( 'Data');

		// fail if checked out not by 'me'
		if ($row->id) {
			if ($model->isCheckedOut( $user->get('id') )) {
				JError::raiseWarning( 'SOME_ERROR_CODE', $row->titel.' '.JText::_( 'EDITED BY ANOTHER ADMIN' ));
				$mainframe->redirect( 'index.php?option=com_eventlist&view=editvip' );
			}
		}

		//make data safe
		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'datdescription' );

		$js = "
		function elSelectVenue(id, venue) {
			document.getElementById('a_id').value = id;
			document.getElementById('a_name').value = venue;
			document.getElementById('sbox-window').close();
		}";

		$linkvsel = 'index.php?option=com_eventlist&amp;view=venueelement&amp;tmpl=component';
		$linkvadd = 'index.php?option=com_eventlist&amp;task=addvenue&amp;tmpl=component';
		$document->addScriptDeclaration($js);

		JHTML::_('behavior.modal', 'a.modal');

		$venueselect = "\n<div style=\"float: left;\"><input style=\"background: #ffffff;\" type=\"text\" id=\"a_name\" value=\"$row->venue\" disabled=\"disabled\" /></div>";
		$venueselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('SELECT')."\" href=\"$linkvsel\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('SELECT')."</a></div></div>\n";
		$venueselect .= "\n<input type=\"hidden\" id=\"a_id\" name=\"locid\" value=\"$row->locid\" />";
		$venueselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"window.open('$linkvadd', 'popup', 'width=750,height=400,scrollbars=yes,toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')\" value=\"".JText::_('ADD')."\" />";
		$venueselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"elSelectVenue(0, '".JText::_('NO VENUE')."' );\" value=\"".JText::_('NO VENUE')."\" onblur=\"seo_switch()\" />";

		//build image select js and load the view
		$js = "
		function elSelectImage(image, imagename) {
			document.getElementById('a_image').value = image;
			document.getElementById('a_imagename').value = imagename;
			document.getElementById('imagelib').src = '../images/eventlist/events/' + image;
			document.getElementById('sbox-window').close();
		}";

		$link = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;layout=uploadimage&amp;task=eventimg&amp;tmpl=component';
		$link2 = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;task=selecteventimg&amp;tmpl=component';
		$document->addScriptDeclaration($js);
		$imageselect = "\n<input style=\"background: #ffffff;\" type=\"text\" id=\"a_imagename\" value=\"$row->datimage\" disabled=\"disabled\" onchange=\"javascript:if (document.forms[0].a_imagename.value!='') {document.imagelib.src='../images/eventlist/events/' + document.forms[0].a_imagename.value} else {document.imagelib.src='../images/blank.png'}\"; /><br />";

		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('Upload')."\" href=\"$link\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('Upload')."</a></div></div>\n";
		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('SELECTIMAGE')."\" href=\"$link2\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('SELECTIMAGE')."</a></div></div>\n";

		$imageselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"elSelectImage('', '".JText::_('SELECTIMAGE')."' );\" value=\"".JText::_('Reset')."\" />";
		$imageselect .= "\n<input type=\"hidden\" id=\"a_image\" name=\"datimage\" value=\"$row->datimage\" />";

		//assign vars to the template
		$this->assignRef('Lists'      	, $Lists);
		$this->assignRef('row'      	, $row);
		$this->assignRef('imageselect'	, $imageselect);
		//$this->assignRef('venueselect'	, $venueselect);
		$this->assignRef('editor'		, $editor);
		//$this->assignRef('pane'			, $pane);
		$this->assignRef('task'			, $task);
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}


}
?>