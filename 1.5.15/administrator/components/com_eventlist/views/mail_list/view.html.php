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
class EventListViewmail_list extends JView {

        function display($tpl = null)
        {
                global $mainframe, $option;

                //initialise variables
                $user           = & JFactory::getUser();
                $document       = & JFactory::getDocument();
                $db             = & JFactory::getDBO();
                $elsettings = ELAdmin::config();

                //get vars
                $filter_order           = $mainframe->getUserStateFromRequest( $option.'.mail_list.filter_order', 'filter_order',  'a.dates', 'cmd' );
                $filter_order_Dir       = $mainframe->getUserStateFromRequest( $option.'.mail_list.filter_order_Dir', 'filter_order_Dir',  '', 'word' );
                $filter_state           = $mainframe->getUserStateFromRequest( $option.'.mail_list.filter_state', 'filter_state',  '*', 'word' );
                $filter                         = $mainframe->getUserStateFromRequest( $option.'.mail_list.filter', 'filter', '', 'int' );
                $search                         = $mainframe->getUserStateFromRequest( $option.'.mail_list.search', 'search', '', 'string' );
                $search                         = $db->getEscaped( trim(JString::strtolower( $search ) ) );
                $template                       = $mainframe->getTemplate();

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
		JSubMenuHelper::addEntry( JText::_( 'VIP' ), 'index.php?option=com_eventlist&view=vip');
		JSubMenuHelper::addEntry( JText::_( 'BLACK' ), 'index.php?option=com_eventlist&view=blacklist');
		JSubMenuHelper::addEntry( JText::_( 'MAIL MANAGEMENT' ), 'index.php?option=com_eventlist&view=mail_list', true);
		JSubMenuHelper::addEntry( JText::_( 'HELP' ), 'index.php?option=com_eventlist&view=help');
		if ($user->get('gid') > 24) {
			JSubMenuHelper::addEntry( JText::_( 'SETTINGS' ), 'index.php?option=com_eventlist&controller=settings&task=edit');
		}

                JHTML::_('behavior.tooltip');

                //create the toolbar
                JToolBarHelper::title( JText::_( 'MAIL MANAGEMENT' ), 'mail' );
                JToolBarHelper::addNew();
                JToolBarHelper::spacer();
                JToolBarHelper::editList();
                JToolBarHelper::spacer();
                JToolBarHelper::deleteList();
                JToolBarHelper::spacer();
                JToolBarHelper::help( 'el.listmail', true );

                // Get data from the model
                $rows           = & $this->get( 'Data');
                //$total      = & $this->get( 'Total');
                $pageNav        = & $this->get( 'Pagination' );

                //publish unpublished filter
                $lists['state'] = JHTML::_('grid.state', $filter_state );

                // table ordering
                $lists['order_Dir'] = $filter_order_Dir;
                $lists['order'] = $filter_order;

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