<?php
/**
 * @version 1.0 $Id: view.html.php 958 2009-02-02 17:23:05Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by  	the Free Software Foundation.

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
class EventListViewVip extends JView {

	function display($tpl = null)
	{
		global $mainframe, $option;

		//initialise variables
		$user 		= & JFactory::getUser();
		$document	= & JFactory::getDocument();
		$db  		= & JFactory::getDBO();
		$elsettings = ELAdmin::config();
		
		//get vars
		$filter = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter',  $mainframe->getCfg('filter'), 'int' );
		$template			= $mainframe->getTemplate();

		//add css and submenu to document
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		//Create Submenu
		JSubMenuHelper::addEntry( JText::_( 'EVENTLIST' ), 'index.php?option=com_eventlist');
		JSubMenuHelper::addEntry( JText::_( 'EVENTS' ), 'index.php?option=com_eventlist&view=events');
		JSubMenuHelper::addEntry( JText::_( 'VENUES' ), 'index.php?option=com_eventlist&view=venues');
		JSubMenuHelper::addEntry( JText::_( 'CATEGORIES' ), 'index.php?option=com_eventlist&view=categories');
		JSubMenuHelper::addEntry( JText::_( 'ARCHIVESCREEN' ), 'index.php?option=com_eventlist&view=archive');
		JSubMenuHelper::addEntry( JText::_( 'GROUPS' ), 'index.php?option=com_eventlist&view=groups');
		JSubMenuHelper::addEntry( JText::_( 'REGUSER' ), 'index.php?option=com_eventlist&view=reguser');
		JSubMenuHelper::addEntry( JText::_( 'VIP' ), 'index.php?option=com_eventlist&view=vip', true);
		JSubMenuHelper::addEntry( JText::_( 'BLACK' ), 'index.php?option=com_eventlist&view=blacklist');
		JSubMenuHelper::addEntry( JText::_( 'MAIL MANAGEMENT' ), 'index.php?option=com_eventlist&view=mail_list');
		JSubMenuHelper::addEntry( JText::_( 'HELP' ), 'index.php?option=com_eventlist&view=help');
		if ($user->get('gid') > 24) 
		{
			JSubMenuHelper::addEntry( JText::_( 'SETTINGS' ), 'index.php?option=com_eventlist&controller=settings&task=edit');
		}

		JHTML::_('behavior.tooltip');

		//create the toolbareventlist.png
		JToolBarHelper::title( JText::_( 'VIP' ), 'vip' );
		JToolBarHelper::spacer();
		
		$check_where[] = " registra IN (4, 5, 8 ,9) ";
		$check_where[] = " id = $filter ";
		$event_r = ELOutput::search_data( $check_where, 'events', ' ORDER By dates DESC ' );
		unset($check_where);
		
		if($event_r->id != NULL)
		{
			JToolBarHelper::custom('pure_vipcode','default','pure_vipcode','pure_vipcode',false);
			JToolBarHelper::spacer();
			ELAdmin::myicon(JText::_( 'produce_vipcode' ), "produce_vipcode", 'vip_user.png');
			//JToolBarHelper::custom('produce_vipcode','default','produce_vipcode','produce_vipcode',false);
			JToolBarHelper::spacer();
			JToolBarHelper::deleteList('DELETE VIP','delete_vip','DELETE VIP');
			JToolBarHelper::spacer();
		}
		
		JToolBarHelper::help( 'el.listvip', true );
		
		// Get data from the model
		$rows      	= & $this->get( 'Data');
		$pageNav 	= & $this->get( 'Pagination' );

		//yen edit start 報名人數列表
		$filters = array();
		$db = JFactory::getDBO();
		$event_data = "SELECT id, title, dates ".
				"FROM #__eventlist_events ".
				"WHERE registra IN (4, 5, 8 ,9)".
				"ORDER By dates DESC";
		$db->setQuery($event_data);
		$event_items = $db->loadObjectList();

		$filters[] = JHTML::_('select.option', 0 , JText::_('PLEASE CHOICE EVENT') );
		foreach($event_items as $item)
		{
			$short_title = mb_substr( $item->title, 0, 30 )."...";
			$filters[] = JHTML::_('select.option', $item->id , JText::_( "(".$item->dates.") ".$short_title ) );
		}
		
		$lists['filter'] = JHTML::_('select.genericlist', $filters, 'filter', 'size="1" class="inputbox" onchange="submitform( );"', 'value', 'text', $filter );

		//assign data to template
		$this->assignRef('lists'      	, $lists);
		$this->assignRef('rows'      	, $rows);
		$this->assignRef('pageNav' 		, $pageNav);
		$this->assignRef('user'			, $user);
		$this->assignRef('template'		, $template);
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}
}
 
?>
