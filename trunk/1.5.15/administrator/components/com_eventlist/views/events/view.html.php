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
 * View class for the EventList events screen
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewEvents extends JView {

	function display($tpl = null)
	{
		global $mainframe, $option;

		//initialise variables
		$user		= & JFactory::getUser();
		$document	= & JFactory::getDocument();
		$db			= & JFactory::getDBO();
		$elsettings = ELAdmin::config();

		//get vars
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'.events.filter_order', 'filter_order',  'a.dates', 'cmd' );
		$filter_order_Dir 	= $mainframe->getUserStateFromRequest( $option.'.events.filter_order_Dir', 'filter_order_Dir',  '', 'word' );
 		$filter_state    	= $mainframe->getUserStateFromRequest( $option.'.events.filter_state', 'filter_state',  '*', 'word' );
		$filter          	= $mainframe->getUserStateFromRequest( $option.'.events.filter', 'filter', '', 'int' );
		$search       	    = $mainframe->getUserStateFromRequest( $option.'.events.search', 'search', '', 'string' );
		$search     		= $db->getEscaped( trim(JString::strtolower( $search ) ) );
		$template        	= $mainframe->getTemplate();

		//add css and submenu to document
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');
		//Create Submenu
		JSubMenuHelper::addEntry( JText::_( 'EVENTLIST' ), 'index.php?option=com_eventlist');
		JSubMenuHelper::addEntry( JText::_( 'EVENTS' ), 'index.php?option=com_eventlist&view=events', true);
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
		
		JHTML::_('behavior.tooltip');

		//create the toolbar
		JToolBarHelper::title( JText::_( 'EVENTS' ), 'events' );
		//JToolBarHelper::custom('join_admlist','default','default','join to admlist',false);
		ELAdmin::myicon( JText::_( 'JOIN TO ADMLIST' ), "join_admlist", 'admin_user.png');
		JToolBarHelper::spacer();
		JToolBarHelper::archiveList();
		JToolBarHelper::spacer();
		JToolBarHelper::publishList();
		JToolBarHelper::spacer();
		JToolBarHelper::unpublishList();
		JToolBarHelper::spacer();
		JToolBarHelper::addNew();
		JToolBarHelper::spacer();
		JToolBarHelper::editList();
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList();
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::spacer();
		ELAdmin::myicon(JText::_( 'DELETE TEST'), "remove_test", 'icon-32-testinfo.png');
		JToolBarHelper::spacer();
		ELAdmin::myicon(JText::_( 'GROUP MAIL' ), "group_mailEvent", 'icon-32-group_mail.png');
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.listevents', true );

		// Get data from the model
		$rows	= & $this->get( 'Data');
		//$total      = & $this->get( 'Total');
		$pageNav= & $this->get( 'Pagination' );

		//publish unpublished filter
		$lists['state'] = JHTML::_('grid.state', $filter_state );

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
 		$lists['order'] = $filter_order;

		//search filter
		$filters = array();
		$filters[] = JHTML::_('select.option', '1', JText::_( 'EVENT TITLE' ) );
		$filters[] = JHTML::_('select.option', '2', JText::_( 'VENUE' ) );
		$filters[] = JHTML::_('select.option', '3', JText::_( 'CITY' ) );
		$filters[] = JHTML::_('select.option', '4', JText::_( 'CATEGORY' ) );
		$lists['filter'] = JHTML::_('select.genericlist', $filters, 'filter', 'size="1" class="inputbox"', 'value', 'text', $filter );

		//mail filter
		$mail_title = array();
		$title_data = ELOutput::search_dataRow( $check_where, 'mail', 'ORDER by id' );
		$mail_title[] = JHTML::_('select.option', 0 , JText::_('PLEASE CHOICE MAIL') );

		foreach($title_data[info] as $title){
			$short_kind = mb_substr( $title->kind, 0, 40 )."...";
			$mail_title[] = JHTML::_('select.option', $title->id , JText::_( "$short_kind" ) );
		}
		
		//mail title filter
		$lists['mail_title'] = JHTML::_('select.genericlist', $mail_title, 'mail_title', 'size="1" class="inputbox" ', 'value', 'text' );

		// search filter
		$lists['search']= $search;

		//assign data to template
		$this->assignRef('lists'        , $lists);
		$this->assignRef('rows'         , $rows);
		$this->assignRef('pageNav'              , $pageNav);
		$this->assignRef('user'                 , $user);
		$this->assignRef('template'             , $template);
		$this->assignRef('elsettings'   , $elsettings);

		parent::display($tpl);
	}
}
?>
