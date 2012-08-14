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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the EditeventView
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewEditevent extends JView
{
	/**
	 * Creates the output for event submissions
	 *
	 * @since 0.4
	 *
	 */
	function display( $tpl=null )
	{
		global $mainframe;

		//only registered user can add events
		$user   = & JFactory::getUser();
		if (!$user->id) {
			//$mainframe->redirect(JRoute::_('index.php?option=com_user&view=login'), JText::_('Please login to be able to submit events') );
		}
    
		if($this->getLayout() == 'choosevenue') {
			$this->_displaychoosevenue($tpl);
			return;
		}

		// Initialize variables
		$editor 	= & JFactory::getEditor();
		$doc 		= & JFactory::getDocument();
		$elsettings = & ELHelper::config();
		
		//Get Data from the model
		$row 		= $this->Get('Event');
		$categories	= $this->Get('Categories');

		//Get requests
		$id					= JRequest::getInt('id');

		//Clean output
		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'datdescription' );

		JHTML::_('behavior.formvalidation');
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.modal', 'a.modal');

		//add css file
		$doc->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$doc->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		//Set page title
		$id ? $title = JText::_( 'EDIT EVENT' ) : $title = JText::_( 'ADD EVENT' );

		$doc->setTitle($title);

		// Get the menu object of the active menu item
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams('com_eventlist');

		//pathway
		$pathway 	= & $mainframe->getPathWay();
		$pathway->setItemName(1, $item->name);
		$pathway->addItem($title, '');

		//Has the user access to the editor and the add venue screen
		$editoruser = ELUser::editoruser();
		$delloclink = ELUser::validate_user( $elsettings->locdelrec, $elsettings->deliverlocsyes );
		
		//transform <br /> and <br> back to \r\n for non editorusers
		if (!$editoruser) {
			$row->datdescription = ELHelper::br2break($row->datdescription);
		}

		//Get image information
		$dimage = ELImage::flyercreator($row->datimage, 'event');

		//Set the info image
		$infoimage = JHTML::_('image', 'components/com_eventlist/assets/images/icon-16-hint.png', JText::_( 'NOTES' ) );

		//Create the stuff required for the venueselect functionality
		$url	= $mainframe->isAdmin() ? $mainframe->getSiteURL() : JURI::base();

		$js = "
		function elSelectVenue(id, venue, area) {
			document.getElementById('a_id').value = id;
			document.getElementById('a_name').value = venue;
			document.getElementById('reg_area').value = area;
			document.getElementById('sbox-window').close();
		}";

		$doc->addScriptDeclaration($js);
		// include the recurrence script
		$doc->addScript($url.'components/com_eventlist/assets/js/recurrence.js');
		// include the unlimited script
		$doc->addScript($url.'components/com_eventlist/assets/js/unlimited.js');
		
		//活動類型
 		$type_sections = array();
		$type_sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT TYPE').' -', 'id', 'title');
		$type_sections[] = JHTML::_('select.option', '1', JText::_('TYPE1'), 'id', 'title');
		$type_sections[] = JHTML::_('select.option', '2', JText::_('TYPE2'), 'id', 'title');
		$lists['reg_type'] = JHTML::_('select.genericlist',  $type_sections, 'reg_type', 'class="inputbox" size="1" ', 'id', 'title', $row->reg_type); 

		//活動區域
		$area_sections = array();
		$area_sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT AREA').' -', 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '1', JText::_('NORTH'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '2', JText::_('MIDDLE'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '3', JText::_('SOUTH'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '4', JText::_('EAST'), 'id', 'title');
		$area_sections[] = JHTML::_('select.option', '5', JText::_('OTHER'), 'id', 'title');	
		$lists['reg_area']  = JHTML::_('select.genericlist',  $area_sections, 'reg_area', 'class="inputbox" size="1" ', 'id', 'title', $row->reg_area); 

		//活動語言
		$sections = array();
		$sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT LANGUAGE2').' -', 'id', 'title');
		$sections[] = JHTML::_('select.option', 'zh', JText::_('Chinese letter'), 'id', 'title');
		$sections[] = JHTML::_('select.option', 'en', JText::_('English letter'), 'id', 'title');
		$sections[] = JHTML::_('select.option', 'parallel', JText::_('PARALLEL'), 'id', 'title');
		$lists['reg_msg'] = JHTML::_('select.genericlist',  $sections, 'reg_msg', 'class="inputbox" size="1" ', 'id', 'title', $row->reg_msg); 

		//開放方式
		$vip_sections = array();
		$vip_sections[] = JHTML::_('select.option', '-1', '- '.JText::_('SELECT EVENT TYPE').' -', 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '0', JText::_('Close registion'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '7', JText::_('Open for All'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '8', JText::_('Open for VIP'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '9', JText::_('Time Limit VIP ，then Open OF member'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '3', JText::_('Only OF Member'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '4', JText::_('Only VIP OF Member'), 'id', 'title');
		$vip_sections[] = JHTML::_('select.option', '5', JText::_('Open + Vip'), 'id', 'title');
		$lists['registra'] = JHTML::_('select.genericlist',  $vip_sections, 'registra', 'class="inputbox" size="1" ', 'id', 'title', $row->registra); 

		$link_switch = array();
		$link_switch[] = JHTML::_('select.option', '1', JText::_('YES'), 'id', 'title');
		$link_switch[] = JHTML::_('select.option', '0', JText::_('NO'), 'id', 'title');
		$lists['switch'] = JHTML::_('select.genericlist',  $link_switch, 'link_switch', 'class="inputbox" size="1" ', 'id', 'title', $row->link_switch); 

		//詢問葷素
		$sections_eat = array();
		$sections_eat[] = JHTML::_('select.option', '0', JText::_('PLEASE CHOOSE'), 'id', 'title');
		$sections_eat[] = JHTML::_('select.option', 'y', JText::_('YES'), 'id', 'title');
		$sections_eat[] = JHTML::_('select.option', 'n', JText::_('NO'), 'id', 'title');
		$lists['reg_eat'] = JHTML::_('select.genericlist',  $sections_eat, 'reg_eat', 'class="inputbox" size="1" ', 'id', 'title', $row->reg_eat); 
		
		//詢問審核制
		$sections_audit = array();
		$sections_audit[] = JHTML::_('select.option', 'y', JText::_('YES'), 'id', 'title');
		$sections_audit[] = JHTML::_('select.option', 'n', JText::_('NO'), 'id', 'title');
		$lists['audit'] = JHTML::_('select.genericlist',  $sections_audit, 'audit', 'class="inputbox" size="1" ', 'id', 'title', $row->audit); 

		
		$this->assignRef('lists' , 		$lists);
		$this->assignRef('row' , 		$row);
		$this->assignRef('categories' ,	$categories);
		$this->assignRef('editor' , 	$editor);
		$this->assignRef('dimage' , 	$dimage);
		$this->assignRef('infoimage' , 	$infoimage);
		$this->assignRef('delloclink' , $delloclink);
		$this->assignRef('editoruser' , $editoruser);
		$this->assignRef('elsettings' , $elsettings);
		$this->assignRef('item' , 		$item);
		$this->assignRef('params' , 	$params);

		parent::display($tpl);

	}

	/**
	 * Creates the output for the venue select listing
	 *
	 * @since 0.9
	 *
	 */
	function _displaychoosevenue($tpl)
	{
		global $mainframe;

		$document	= & JFactory::getDocument();
		$params 	= & $mainframe->getParams();

		$limitstart			= JRequest::getVar('limitstart', 0, '', 'int');
		$limit				= $mainframe->getUserStateFromRequest('com_eventlist.selectvenue.limit', 'limit', $params->def('display_num', 0), 'int');
		$filter_order		= JRequest::getCmd('filter_order', 'l.venue');
		$filter_order_Dir	= JRequest::getWord('filter_order_Dir', 'desc');;
		$filter				= JRequest::getString('filter');
		$filter_type		= JRequest::getInt('filter_type');

		// Get/Create the model
		$rows 	= $this->get('Venues');
		$total 	= $this->get('Countitems');
		
		JHTML::_('behavior.modal', 'a.modal');

		// Create the pagination object
		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);

		// table ordering
		$lists['order_Dir'] 	= $filter_order_Dir;
		$lists['order'] 		= $filter_order;

		$document->setTitle(JText::_( 'SELECTVENUE' ));
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');

		$filters = array();
		$filters[] = JHTML::_('select.option', '1', JText::_( 'VENUE' ) );
		$filters[] = JHTML::_('select.option', '2', JText::_( 'CITY' ) );
		$searchfilter = JHTML::_('select.genericlist', $filters, 'filter_type', 'size="1" class="inputbox"', 'value', 'text', $filter_type );

		$this->assignRef('rows' , 				$rows);
		$this->assignRef('searchfilter' , 		$searchfilter);
		$this->assignRef('pageNav' , 			$pageNav);
		$this->assignRef('lists' , 				$lists);
		$this->assignRef('filter' , 			$filter);

		parent::display($tpl);
	}
}
?>
