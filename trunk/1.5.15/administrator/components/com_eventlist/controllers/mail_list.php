<?php
/**
 * @version 1.0 $Id: events.php 958 2009-02-02 17:23:05Z julienv $
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

jimport('joomla.application.component.controller');
jimport( 'joomla.database.database.mysql' );
/**
 * EventList Component maillist Controller
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListControllerMail_List extends EventListController
{
	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra task
		$this->registerTask( 'apply', 		'save' );
		$this->registerTask( 'copy',	 	'edit' );
	}

	/**
	 * Logic to archive events
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function archive()
	{
		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to archive' ) );
		}

		$model = $this->getModel('mail_list');
		if(!$model->publish($cid, -1)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count( $cid );
		$msg 	= $total.' '.JText::_('EVENT ARCHIVED');

		$this->setRedirect( 'index.php?option=com_eventlist&view=mail_list', $msg );
	}

	/**
	 * logic for cancel an action
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$group = & JTable::getInstance('eventlist_mail_list', '');
		$group->bind(JRequest::get('post'));
		$group->checkin();

		$this->setRedirect( 'index.php?option=com_eventlist&view=mail_list' );
	}

	/**
	 * logic to create the new event screen
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function add( )
	{
		global $option;

		$this->setRedirect( 'index.php?option='. $option .'&view=MailLetter' );
	}

	/**
	 * 編輯模組
	 */
	function edit( )
	{
		JRequest::setVar( 'view', 'MailLetter' );
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('MailLetter');
		$task 	= JRequest::getVar('task');
		//print_r($model); exit;
		if ($task == 'copy') {
			JRequest::setVar( 'task', $task );
		} else {
			$user	=& JFactory::getUser();
			if ($model->isCheckedOut( $user->get('id') )) {
				$this->setRedirect( 'index.php?option=com_eventlist&view=mail_list', JText::_( 'EDITED BY ANOTHER ADMIN' ) );
			}
			$model->checkout();
		}
		parent::display();
	}

	/**
	 * 儲存模組
	 */
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$task		= JRequest::getVar('task');
		$post = JRequest::get( 'post' );
		$post['kind']	= trim($post['kind'] ); //去除前面的空白
		$post['message'] = JRequest::getVar( 'message', '', 'post','string', JREQUEST_ALLOWRAW );
		$post['message']	= str_replace( '<br>', '<br />', $post['message'] );
		
		$model = $this->getModel('MailLetter');

		if ($returnid = $model->store($post)) {

			switch ($task){
				case 'apply' :
					$link = 'index.php?option=com_eventlist&controller=mail_list&view=MailLetter&hidemainmenu=1&cid[]='.$returnid;
					break;

				default :
					$link = 'index.php?option=com_eventlist&view=mail_list';
					break;
			}
			$msg	= JText::_( 'EMAIL SAVED');
			$cache = &JFactory::getCache('com_eventlist');
			$cache->clean();

		} else {
			$msg 	= 'SAVE ERROR';
			$link = 'index.php?option=com_eventlist&view=mail_list';
		}

		$model->checkin();
		$this->setRedirect( $link, $msg );
 	}

	/**
	 刪除信件
	 由view/mail_list/view.html.php
	 */
 	function remove()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('mail_list');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$msg = $total.' '.JText::_( 'MAIL DELETED');

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$this->setRedirect( 'index.php?option=com_eventlist&view=mail_list', $msg );
	}
}
?>
