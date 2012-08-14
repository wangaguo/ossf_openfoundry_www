<?php
/**s
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
class EventListViewReguser extends JView {

	function display($tpl = null)
	{
		global $mainframe, $option;

		//initialise variables
		$user 		= & JFactory::getUser();
		$document	= & JFactory::getDocument();
		$db  		= & JFactory::getDBO();
		$elsettings = ELAdmin::config();

		//get vars
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'.reguser.filter_order', 'filter_order', 	'a.dates', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.reguser.filter_order_Dir', 'filter_order_Dir',	'', 'word' );
		$filter_signup 		= $mainframe->getUserStateFromRequest( $option.'.reguser.filter_signup', 'filter_signup', 	'', 'int' );
		$filter 			= $mainframe->getUserStateFromRequest( $option.'.reguser.filter', 'filter', '', 'int' );
		$filter_glist 			= $mainframe->getUserStateFromRequest( $option.'.reguser.glist', 'glist', '', 'int' );
		$mail_title_set		= $mainframe->getUserStateFromRequest( $option.'.reguser.mail_title', 'mail_title', '', 'int' );
		$search 			= $mainframe->getUserStateFromRequest( $option.'.reguser.search', 'search', '', 'string' );
		$search 			= $db->getEscaped( trim(JString::strtolower( $search ) ) );
		$template			= $mainframe->getTemplate();
		$list_area		=	$mainframe->getUserStateFromRequest( $option.'.reguser.area', 'area', '', 'int' );
		$list_category=	$mainframe->getUserStateFromRequest( $option.'.reguser.glist', 'glist', '', 'int' );

		//add css and submenu to document
		$document->addStyleSheet('components/com_eventlist/assets/css/eventlistbackend.css');

		//Create Submenu
		JSubMenuHelper::addEntry( JText::_( 'EVENTLIST' ), 'index.php?option=com_eventlist');
		JSubMenuHelper::addEntry( JText::_( 'EVENTS' ), 'index.php?option=com_eventlist&view=events');
		JSubMenuHelper::addEntry( JText::_( 'VENUES' ), 'index.php?option=com_eventlist&view=venues');
		JSubMenuHelper::addEntry( JText::_( 'CATEGORIES' ), 'index.php?option=com_eventlist&view=categories');
		JSubMenuHelper::addEntry( JText::_( 'ARCHIVESCREEN' ), 'index.php?option=com_eventlist&view=archive');
		JSubMenuHelper::addEntry( JText::_( 'GROUPS' ), 'index.php?option=com_eventlist&view=groups');
		JSubMenuHelper::addEntry( JText::_( 'REGUSER' ), 'index.php?option=com_eventlist&view=reguser', true);
		JSubMenuHelper::addEntry( JText::_( 'VIP' ), 'index.php?option=com_eventlist&view=vip');
		JSubMenuHelper::addEntry( JText::_( 'BLACK' ), 'index.php?option=com_eventlist&view=blacklist');
		JSubMenuHelper::addEntry( JText::_( 'MAIL MANAGEMENT' ), 'index.php?option=com_eventlist&view=mail_list');
		JSubMenuHelper::addEntry( JText::_( 'HELP' ), 'index.php?option=com_eventlist&view=help');
		if ($user->get('gid') > 24) {
			JSubMenuHelper::addEntry( JText::_( 'SETTINGS' ), 'index.php?option=com_eventlist&controller=settings&task=edit');
		}

		JHTML::_('behavior.tooltip');

		//create the toolbareventlist.png
		JToolBarHelper::title( JText::_( 'REGUSER' ), 'groups' );
		JToolBarHelper::spacer();
		
		$check_where[] = " id = $filter ";
		$audit_event = ELOutput::search_data( $check_where, 'events', '' );
		
		if($filter != 0){
			if($audit_event->survey == 'y'){
				ELAdmin::window2chart(JText::_( 'CHART' ), $filter);//取消報名
				JToolBarHelper::spacer();
			}
			ELAdmin::myicon(JText::_( 'add user' ), "add_user", 'new_user.png');
			JToolBarHelper::spacer();
			ELAdmin::myicon("TXT", "output_txt", 'csv.png');//輸出txt
			JToolBarHelper::spacer();
			ELAdmin::myicon("CSV", "output_csv", 'csv.png');//輸出csv
			JToolBarHelper::spacer();
			ELAdmin::window2html("HTML", "HTML", 'html.png');//輸出html
			JToolBarHelper::spacer();
			ELAdmin::myicon(JText::_( 'JOIN BLACK' ), "black_user", 'black_user.png');//加入黑名單
			JToolBarHelper::spacer();
			ELAdmin::myicon(JText::_( 'DELETE USER' ), "cancel_join", 'cancel_user.png');//取消報名
			JToolBarHelper::spacer();
			ELAdmin::myicon(JText::_( 'Filter MAIL' ), "group_mail", 'icon-32-group_mail.png');
			JToolBarHelper::spacer();
		}
		 
		if( $list_area != 0 || $filter != 0 || $list_category != 0 ){
			ELAdmin::myicon("MAIL TO ME", "mailtoadmin", 'mail_test.png');
			JToolBarHelper::spacer();
			ELAdmin::myicon("SENDMAIL", "sendmail", 'mail.png');
			JToolBarHelper::spacer();
		} 
	
		JToolBarHelper::help( 'el.listreguser', true );
		
		// Get data from the model
		$rows      	= & $this->get( 'Data');
		//$total      = & $this->get( 'Total');
		$pageNav 	= & $this->get( 'Pagination' );

		//參與狀態
		$user_signup = array();
		$check_where[] = " id = $filter ";
		
		$audit_state = ELOutput::search_data( $check_where, 'events', '' );
		$user_signup[] = JHTML::_('select.option', '0' , JText::_( 'LIST CONFIRM' ));
		if( $audit_state->audit == 'n' ){
			$user_signup[] = JHTML::_('select.option', '1' , JText::_( 'JOIN CONFIRM' ));
			$user_signup[] = JHTML::_('select.option', '2' , JText::_( 'candidate' ));
			$user_signup[] = JHTML::_('select.option', '3' , JText::_( 'FULL_USER' ));
		}
		$user_signup[] = JHTML::_('select.option', '5' , JText::_( 'CANCEL CONFIRM' ) );	
		

		if($audit_event->audit=='y'){
			$user_signup[] = JHTML::_('select.option', '6' , JText::_( 'approved' ));
			$user_signup[] = JHTML::_('select.option', '7' , JText::_( 'rejected' ) );	
		}
		$lists['signup']	= JHTML::_('select.genericlist', $user_signup, 'filter_signup', 'size="1" class="inputbox" onchange="chick_select4();"', 'value', 'text', $filter_signup );

		//yen edit start 信件列表
		$mail_title = array();

		$system_mail[] = $elsettings->mail_approved; 	
		$system_mail[] = $elsettings->mail_rejected; 	
		$system_mail[] = $elsettings->audit_notice; 	
		$system_mail[] = $elsettings->mail_join; 
		$system_mail[] = $elsettings->mail_cancel; 
		$system_mail[] = $elsettings->mail_candidate; 
		$system_mail[] = $elsettings->toadmin_join; 
		$system_mail[] = $elsettings->toadmin_cancel; 
		$system_mail[] = $elsettings->toadmin_full; 
		$system_mail[] = $elsettings->touser_vipmail; 	
		$system_mail[] = $elsettings->mail_approved_EN; 
		$system_mail[] = $elsettings->mail_rejected_EN; 
		$system_mail[] = $elsettings->audit_notice_EN; 
		$system_mail[] = $elsettings->mail_join_EN;
		$system_mail[] = $elsettings->mail_cancel_EN;
		$system_mail[] = $elsettings->mail_candidate_EN; 	
		$system_mail[] = $elsettings->touser_vipmail_EN;
		$sys_mail = implode(',',$system_mail);

		if( $filter != 0 ){
			$mail_where[] = " id NOT IN ($sys_mail) ";
			$title_data = ELOutput::search_dataRow( $mail_where, 'mail', 'ORDER by id' );
		}					

		$mail_title[] = JHTML::_('select.option', 0 , JText::_('PLEASE CHOICE MAIL') );

		foreach($title_data['info'] as $title){
			$short_kind = mb_substr( $title->kind, 0, 40 )."...";
			$mail_title[] = JHTML::_('select.option', $title->id , JText::_( "$short_kind" ) );
		}
		
		$lists['mail_title'] = JHTML::_('select.genericlist', $mail_title, 'mail_title', 'size="1" class="inputbox" ', 'value', 'text' );

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
