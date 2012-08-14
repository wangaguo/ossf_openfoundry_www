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
class EventListViewEvent extends JView {

	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'addvenue') {
			$this->_displayaddvenue($tpl);
			return;
		}

		//Load behavior
		jimport('joomla.html.pane');
		JHTML::_('behavior.tooltip');

		//initialise variables
		$editor 	= & JFactory::getEditor();
		$document	= & JFactory::getDocument();
		$pane 		= & JPane::getInstance('sliders');
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
		
		if ($task == 'copy') {
		  	JToolBarHelper::title( JText::_( 'COPY EVENT'), 'eventedit');		
		} elseif ( $cid ) {
			JToolBarHelper::title( JText::_( 'EDIT EVENT' ), 'eventedit' );
		} else {
			JToolBarHelper::title( JText::_( 'ADD EVENT' ), 'eventedit' );

			//set the submenu
			JSubMenuHelper::addEntry( JText::_( 'EVENTLIST' ), 'index.php?option=com_eventlist');
			JSubMenuHelper::addEntry( JText::_( 'EVENTS' ), 'index.php?option=com_eventlist&view=events');
			JSubMenuHelper::addEntry( JText::_( 'VENUES' ), 'index.php?option=com_eventlist&view=venues');
			JSubMenuHelper::addEntry( JText::_( 'CATEGORIES' ), 'index.php?option=com_eventlist&view=categories');
			JSubMenuHelper::addEntry( JText::_( 'ARCHIVESCREEN' ), 'index.php?option=com_eventlist&view=archive');
			JSubMenuHelper::addEntry( JText::_( 'GROUPS' ), 'index.php?option=com_eventlist&view=groups');
			JSubMenuHelper::addEntry( JText::_( 'REGUSER' ), 'index.php?option=com_eventlist&view=reguser');
			JSubMenuHelper::addEntry( JText::_( 'VIP' ), 'index.php?option=com_eventlist&view=vip');
			JSubMenuHelper::addEntry( JText::_( 'BLACK' ), 'index.php?option=com_eventlist&view=blacklist');
			JSubMenuHelper::addEntry( JText::_( 'MAIL MANAGEMENT' ), 'index.php?option=com_eventlist&view=mail_list');
			JSubMenuHelper::addEntry( JText::_( 'HELP' ), 'index.php?option=com_eventlist&view=help');
            if ($user->get('gid') > 24) {
            	JSubMenuHelper::addEntry( JText::_( 'SETTINGS' ), 'index.php?option=com_eventlist&controller=settings&task=edit');
            }
		}
		JToolBarHelper::apply();
		JToolBarHelper::spacer();
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.editevents', true );

		//get data from model
		$model		= & $this->getModel();
		$row     	= & $this->get( 'Data');

		// fail if checked out not by 'me'
		if ($row->id) {
			if ($model->isCheckedOut( $user->get('id') )) {
				JError::raiseWarning( 'SOME_ERROR_CODE', $row->titel.' '.JText::_( 'EDITED BY ANOTHER ADMIN' ));
				$mainframe->redirect( 'index.php?option=com_eventlist&view=events' );
			}
		}

		//make data safe
		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'datdescription' );

		//Create category list
		$categories = & $this->get( 'Categories');

		$catlist 	= array();
		$catlist[] 	= JHTML::_('select.option', '0', JText::_( 'SELECT CATEGORY' ) );
		$catlist 	= array_merge( $catlist, $categories );

		$Lists = array();
		$Lists['category'] = JHTML::_('select.genericlist', $catlist, 'catsid', 'size="1" class="inputbox"', 'value', 'text', $row->catsid );

		//build venue select js and load the view
		$js = "
		function elSelectVenue(id, venue, area) {
			document.getElementById('a_id').value = id;
			document.getElementById('a_name').value = venue;
			document.getElementById('reg_area').value = area;
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

		//活動區域(北,中,南)
		$area_sections = array();
		$area_sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT AREA').' -', 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '1', JText::_('NORTH'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '2', JText::_('MIDDLE'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '3', JText::_('SOUTH'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '4', JText::_('EAST'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '5', JText::_('OTHER'), 'id', 'title');
		$Lists['area'] = JHTML::_('select.genericlist',  $area_sections, 'reg_area', ' class="inputbox" size="1" onmousemove="this.releaseCapture();"', 'id', 'title', $row->reg_area); 

		//信件語言
		if(!$row->reg_msg){
			$default_msg = 'zh';
		}else{
			$default_msg = $row->reg_msg;
		}

		//活動語系
		$sections = array();
		$sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT LANGUAGE2').' -', 'id', 'title');
		$sections[] = JHTML::_('select.option', 'zh', JText::_('Chinese letter'), 'id', 'title');
		$sections[] = JHTML::_('select.option', 'en', JText::_('English letter'), 'id', 'title');
		$sections[] = JHTML::_('select.option', 'parallel', JText::_('PARALLEL'), 'id', 'title');
		$Lists['reg_msg'] = JHTML::_('select.genericlist',  $sections, 'reg_msg', 'class="inputbox" size="1" ', 'id', 'title', $default_msg); 

		//活動開放方式
		$vip_sections = array();
		$vip_sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT EVENT TYPE').' -', 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '0', JText::_('Close registion'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '7', JText::_('Open for All'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '8', JText::_('Open for VIP'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '9', JText::_('Open for time Limit VIP ,then Open for all'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '3', JText::_('Only OF Member'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '4', JText::_('Only VIP OF Member'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '5', JText::_('Time Limit VIP ，then Open OF member'), 'id', 'title');

		(int) $vip = $row->registra;
		$Lists['registra'] = JHTML::_('select.genericlist',  $vip_sections, 'vip', 'class="inputbox" size="1" onChange="getSelect()" ', 'id', 'title', $vip); 
				
		if( $row->id == 0 ){
			$default_survey = 'n';
			$default_reg_eat = 'n';
			$default_audit = 'n';
		}else{
			$default_survey = "$row->survey";
			$default_reg_eat = "$row->reg_eat";
			$default_audit = "$row->audit";
		}

		//問卷選單
		$survey_array = array();
		$survey_array[] = JHTML::_('select.option', 'y', JText::_('YES'), 'id', 'survey');
		$survey_array[] = JHTML::_('select.option', 'n', JText::_('NO'), 'id', 'survey');
		$Lists['survey'] = JHTML::_('select.genericlist',  $survey_array, 'survey', 'class="inputbox" size="1" ', 'id', 'survey', $default_survey); 

		//詢問葷素
		$sections_eat = array();
		$sections_eat[] = JHTML::_('select.option', 'y', JText::_('YES'), 'id', 'title');
		$sections_eat[] = JHTML::_('select.option', 'n', JText::_('NO'), 'id', 'title');
		$Lists['reg_eat'] = JHTML::_('select.genericlist',  $sections_eat, 'reg_eat', 'class="inputbox" size="1" ', 'id', 'title', $default_reg_eat); 

		//詢問審核制
		$sections_audit = array();
		$sections_audit[] = JHTML::_('select.option', 'y', JText::_('YES'), 'id', 'title');
		$sections_audit[] = JHTML::_('select.option', 'n', JText::_('NO'), 'id', 'title');
		$Lists['audit'] = JHTML::_('select.genericlist',  $sections_audit, 'audit', 'class="inputbox" size="1" ', 'id', 'title', $default_audit); 

		$g_model 	= $this->getModel('event');
		$all_user 	= $g_model->getall_user();
		$getSpeaker = $g_model->getSpeaker(1);
		
		$null_user = array(
						'value' => '0',
						'username' => 'NULL',
						'name' => 'NULL',
						'text' => 'NULL'
					);
		$null_user = (object) $null_user;
		
		for($i=0;$i<4;$i++){
			$all_user[] = $null_user;
		}
		
		//講者列表選單
		$Lists['all_user']		= JHTML::_('select.genericlist', $all_user, 
											'all_user', 'class="inputbox" 
											size="10" 
											onDblClick="moveOptions(document.adminForm[\'all_user\'], 
											document.adminForm[\'getSpeaker[]\'])" 
											multiple="multiple" style="padding: 6px; width: 150px;"', 'value', 'text' );
		$Lists['getSpeaker']	= JHTML::_('select.genericlist', $getSpeaker, 
											'getSpeaker[]', 'class="inputbox" 
											size="10" id ="getSpeaker[]"
											onDblClick="moveOptions(document.adminForm[\'getSpeaker[]\'], 
											document.adminForm[\'all_user\'])" 
											multiple="multiple" style="padding: 6px; width: 150px;"', 'value', 'text' );

		//assign vars to the template 
		$this->assignRef('Lists'      	, $Lists);
		$this->assignRef('row'      	, $row);
		$this->assignRef('imageselect'	, $imageselect);
		$this->assignRef('venueselect'	, $venueselect); 
		$this->assignRef('editor'		, $editor);
		$this->assignRef('pane'			, $pane);
		$this->assignRef('task'			, $task);
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}

	/**
	 * Creates the output for the add venue screen
	 *
	 * @since 0.9
	 *
	 */
	function _displayaddvenue($tpl)
	{
		global $mainframe;

		//initialise variables
		$editor 	= & JFactory::getEditor();
		$document	= & JFactory::getDocument();
		$uri 		= & JFactory::getURI();
		$elsettings = ELAdmin::config();

		//add css and js to document
		JHTML::_('behavior.modal', 'a.modal');
		JHTML::_('behavior.tooltip');

		//Build the image select functionality
		$js = "
		function elSelectImage(image, imagename) {
			document.getElementById('a_image').value = image;
			document.getElementById('a_imagename').value = imagename;
			document.getElementById('sbox-window').close();
		}";

		$link = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;layout=uploadimage&amp;task=venueimg&amp;tmpl=component';
		$link2 = 'index.php?option=com_eventlist&amp;view=imagehandler&amp;task=selectvenueimg&amp;tmpl=component';
		$document->addScriptDeclaration($js);
		$imageselect = "\n<input style=\"background: #ffffff;\" type=\"text\" id=\"a_imagename\" value=\"".JText::_('SELECTIMAGE')."\" disabled=\"disabled\" onchange=\"javascript:if (document.forms[0].a_imagename.value!='') {document.imagelib.src='../images/eventlist/events/' + document.forms[0].a_imagename.value} else {document.imagelib.src='../images/blank.png'}\"; /><br />";

		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('Upload')."\" href=\"$link\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('Upload')."</a></div></div>\n";
		$imageselect .= "<div class=\"button2-left\"><div class=\"blank\"><a class=\"modal\" title=\"".JText::_('SELECTIMAGE')."\" href=\"$link2\" rel=\"{handler: 'iframe', size: {x: 650, y: 375}}\">".JText::_('SELECTIMAGE')."</a></div></div>\n";

		$imageselect .= "\n&nbsp;<input class=\"inputbox\" type=\"button\" onclick=\"elSelectImage('', '".JText::_('SELECTIMAGE')."' );\" value=\"".JText::_('Reset')."\" />";
		$imageselect .= "\n<input type=\"hidden\" id=\"a_image\" name=\"locimage\" value=\"".JText::_('SELECTIMAGE')."\" />";

		//set published
		$published = 1;

		//assign to template
		$this->assignRef('editor'      	, $editor);
		$this->assignRef('imageselect' 	, $imageselect);
		$this->assignRef('published' 	, $published);
		$this->assignRef('request_url'	, $uri->toString());
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}
}
?>
