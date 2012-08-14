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
class EventListViewRegusers extends JView {

	function display($tpl = null)
	{
		global $mainframe;

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
			JToolBarHelper::title( JText::_( 'EDIT USER' ), 'eventedit' );
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

		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help( 'el.editreguser', true );

		//get data from model
		$model		= & $this->getModel();
		$row     	= & $this->get( 'Data');

		// fail if checked out not by 'me'
		if ($row->id) {
			if ($model->isCheckedOut( $user->get('id') )) {
				JError::raiseWarning( 'SOME_ERROR_CODE', $row->titel.' '.JText::_( 'EDITED BY ANOTHER ADMIN' ));
				$mainframe->redirect( 'index.php?option=com_eventlist&view=reg_user' );
			}
		}

		$info[] = " id = $row->reg_id ";
		$event_info = ELOutput::search_data( $info, 'events', '');

		//assign vars to the template
		$this->assignRef('eventinfo'	, $event_info);
		$this->assignRef('Lists'      	, $Lists);
		$this->assignRef('row'      	, $row);
		$this->assignRef('editor'		, $editor);
		$this->assignRef('pane'			, $pane);
		$this->assignRef('task'			, $task);
		$this->assignRef('elsettings'	, $elsettings);

		parent::display($tpl);
	}

}
?>
