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
 * EventList Component Events Controller
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListControllerEvents extends EventListController
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
	 * Logic to publish events
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function publish()
	{
		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('events');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count( $cid );
		$msg 	= $total.' '.JText::_('EVENT PUBLISHED');

		$this->setRedirect( 'index.php?option=com_eventlist&view=events', $msg );
	}

	/**
	 * Logic to unpublish events
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function unpublish()
	{
		$cid 	= JRequest::getVar( 'cid', array(0), 'post', 'array' );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('events');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count( $cid );
		$msg 	= $total.' '.JText::_('EVENT UNPUBLISHED');
		
		$this->setRedirect( 'index.php?option=com_eventlist&view=events', $msg );
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

		$model = $this->getModel('events');
		if(!$model->publish($cid, -1)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count( $cid );
		$msg 	= $total.' '.JText::_('EVENT ARCHIVED');

		$this->setRedirect( 'index.php?option=com_eventlist&view=events', $msg );
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
		
		$group = & JTable::getInstance('eventlist_events', '');
		$group->bind(JRequest::get('post'));
		$group->checkin();

		$this->setRedirect( 'index.php?option=com_eventlist&view=events' );
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

		$this->setRedirect( 'index.php?option='. $option .'&view=event' );
	}

	/**
	 * logic to create the edit event screen
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function edit( )
	{
		JRequest::setVar( 'view', 'event' );
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('event');
		$task 	= JRequest::getVar('task');

		if ($task == 'copy') {
			JRequest::setVar( 'task', $task );
		} else {
			
			$user	=& JFactory::getUser();
			// Error if checkedout by another administrator
			if ($model->isCheckedOut( $user->get('id') )) {
				$this->setRedirect( 'index.php?option=com_eventlist&view=events', JText::_( 'EDITED BY ANOTHER ADMIN' ) );
			}
			$model->checkout();
		}
		parent::display();
	}

	/**
	 * logic to save an event
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 * 以下為函式流程
	 * 1.取得變數
	 * 2.修改datdescription資訊資訊
	 * 3.設定open_data open_time
	 * 4.設定signupEnddate signup Endtime
	 * 5.填上使用者未填寫的資料
	 * 6.替換講者
	 * 7.寫入資料庫
	 */
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		$task		= JRequest::getVar('task');

		$post = JRequest::get( 'post' );
		$post['datdescription'] = JRequest::getVar( 'datdescription', '', 'post','string', JREQUEST_ALLOWRAW );
		$post['datdescription']	= str_replace( '<br>', '<br />', $post['datdescription'] );
		$post['unregistra'] 	= 1;
		$post['registra'] 		= $post['vip'];
		if($post['open_date']==''){$post[open_date]=date('Y-m-d');}
		if($post['open_time']==''){$post[open_time]=date('H:i');}
		if($post['signupEnddate']==''||$post['signupEnddate']=='0000-00-00'){$post[signupEnddate]=$post['dates'];}
		if($post['signupEndtime']==''||$post['signupEndtime']=='00:00'){$post[signupEndtime]=$post['times'];}

		if($post['registra']==4 || $post['registra']==8){
			$post['vip_regdate']=$post['dates'];
			$post['vip_endtime']=$post['times'];
		}

		$check_where[] = " id =$post[id] ";
		$check_speaker = ELOutput::search_data( $check_where, 'events', '' );

		if($post['full'] == 0){$post['full'] = 30;}
		if($post['candidate'] == 0){$post['candidate'] = 5;}
		if($post['reg_free'] == ''){$post['reg_free'] = 'free';}
		
		$Speaker_list = JRequest::getVar('getSpeaker', '', 'post', 'array');
		$Speaker_str = implode( ',', $Speaker_list );

		if( $check_speaker->created_by != $Speaker_str ){
			$change_speaker = ELOutput::sp_info($Speaker_str);
			//替換講者
			$post_head = explode('<!--system_speak-->',$post['datdescription']);
			$post_foot = explode('<!--system_speak_end-->',$post['datdescription']);
			$str_num = count($post_foot);
			$post['datdescription'] = $post_head[0].$change_speaker.$post_foot[$str_num-1];
		}
		
		for($j=0;$j<count($Speaker_list);$j++){
			if($Speaker_list[$j]==0){
				unset($Speaker_list[$j]);
			}
		}
		$post['created_by'] = implode(',',$Speaker_list);

		$model = $this->getModel('event');

		if ($returnid = $model->store($post)) {

			switch ($task)
			{
				case 'apply' :
					$link = 'index.php?option=com_eventlist&controller=events&view=event&hidemainmenu=1&cid[]='.$returnid;
					break;

				default :
					$link = 'index.php?option=com_eventlist&view=events';
					break;
			}
			$msg	= JText::_( 'EVENT SAVED');
			$cache = &JFactory::getCache('com_eventlist');
			$cache->clean();

		} else {
			$msg 	= '';
			$link = 'index.php?option=com_eventlist&view=events';
		}

		$model->checkin();
		$this->setRedirect( $link, $msg ); 
 	}

	/**
	 * logic to remove an event
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
 	function remove()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('events');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$msg = $total.' '.JText::_( 'EVENTS DELETED');

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$this->setRedirect( 'index.php?option=com_eventlist&view=events', $msg );
	}
	
	/*
	加入/退出 報名狀況聯絡群組
	交給model的events.php執行
	*/
	function join_admlist()
	{
		$user 	=& JFactory::getUser();
		$userid = (int) $user->get('id');
		
		$model = $this->getModel('events');
		
		if(!$model->maillist($userid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}
		
		$msg = JRequest::getVar( 'admLs_msg', '', 'post','string', JREQUEST_ALLOWRAW );
	
		$this->setRedirect( 'index.php?option=com_eventlist&view=events', $msg );
	}

	/*
	刪除測試資料
	由view/events/view.html.php使用
	*/
 	function remove_test()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('events');
		if(!$model->delete_test($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$msg = $total.' '.JText::_( 'TEST DATA DELETE');

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$this->setRedirect( 'index.php?option=com_eventlist&view=events', $msg );
	}
	
	/*
	群組信件
	由view/events/view.html.php使用
	*/
	function group_mailEvent()
	{
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		$mail_id = JRequest::getVar( 'mail_title', int, 'post', 'int' );
		
		$cid_array = implode( "," , $cid);

		$db = JFactory::getDBO();
	    $cid_sql = "SELECT * ".
					"FROM #__eventlist_reg_user ".
					"WHERE reg_id IN(".$cid_array .") ".
					"GROUP BY u_email";
		$db->setQuery($cid_sql);
	    $cmail = $db->loadObjectlist();

	    $news_list = array();
		$member_userid = array();
	    foreach($cmail as $inv_user){
	    	$news_list[] = $inv_user->u_email;
	    	$member_userid[] = $inv_user->reg_id;
	    }

		$user =& JFactory::getUser();
		$admin_name = $user->get('name');
		$admin_mail = $user->get('email');
	

		for($i=0;$i<count($news_list);$i++){
				
			$kind		= ELOutput::mailT_replace($member_userid[$i], $mail_id, $news_list[$i]);
			$mail_value = ELOutput::mail_replace($member_userid[$i], $mail_id, $news_list[$i]);

			$subject =  "=?UTF-8?b?".base64_encode("$kind")."?=";
			$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
			$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
			$header.= "Reply-To: ".$admin_mail."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
			$header.= "Content-Transfer-Encoding:8bit\n\r";

			if(mail($news_list[$i], $subject, $mail_value,$header)){;
				$msg .= JText::_( 'MAIL SENDED' )." $news_list[$i]";
			}else{
				$msg .= JText::_( 'MAIL ERROR' );
			}

		}

		$this->setRedirect( 'index.php?option=com_eventlist&view=events',$msg );


	}
	
}
?>
