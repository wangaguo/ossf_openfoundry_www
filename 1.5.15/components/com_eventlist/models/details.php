<?php
/**
 * @version 1.0 $Id: details.php 999 2009-04-13 12:08:23Z julienv $
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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

/**
 * EventList Component Details Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelDetails extends JModel
{
			
	/**
	 * Details data in details array
	 *
	 * @var array
	 */
	var $_details = null;

	/**
	 * registeres in array
	 *
	 * @var array
	 */
	var $_registers = null;
//	var $_registers2 = null;
	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		$id = JRequest::getInt('id');
		$this->setId((int)$id);
	}


	
	/**
	 * Method to set the details id
	 *
	 * @access	public
	 * @param	int	details ID number
	 */

	function setId($id)
	{
		// Set new details ID and wipe data
		$this->_id			= $id;
	}


	/**
	 * Method to get event data for the Detailsview
	 *
	 * @access public
	 * @return array
	 * @since 0.9
	 */
	function &getDetails( )
	{
		/*
		 * Load the Category data
		 */
		if ($this->_loadDetails()){
				
			$user	= & JFactory::getUser();

			// Is the category published?
			if (!$this->_details->published && $this->_details->catsid){
				JError::raiseError( 404, JText::_("CATEGORY NOT PUBLISHED") );
			}
			// Do we have access to the category?
			if (($this->_details->access > $user->get('aid')) && $this->_details->catsid){
				JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
			}
		}

		return $this->_details;
	}

	/**
	 * Method to load required data
	 *
	 * @access	private
	 * @return	array
	 * @since	0.9
	 */
	function _loadDetails()
	{
		if (empty($this->_details))
		{
			// Get the WHERE clause
			$where	= $this->_buildDetailsWhere();

			$query = 'SELECT a.id AS did, a.dates, a.enddates, a.title, a.times, a.endtimes, '
			    . ' a.datdescription, a.meta_keywords, a.meta_description, a.datimage, a.registra, a.unregistra, '
			    . 'a.locid, a.catsid, a.created_by, a.full, a.candidate, a.vip_regdate, a.vip_endtime, a.open_date, a.open_time, '
			    . 'a.survey, a.reg_eat, a.audit, a.signupEnddate, a.signupEndtime, '
					. ' l.id AS locid, l.venue, l.city, l.state, l.url, l.locdescription, l.locimage, l.city, l.plz, l.street, l.country, l.map, l.created_by AS venueowner,'
					. ' c.id, c.catname, c.published, c.access, '
          . ' u.name AS creator_name, u.username AS creator_username,'
					. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug,'
					. ' CASE WHEN CHAR_LENGTH(l.alias) THEN CONCAT_WS(\':\', a.locid, l.alias) ELSE a.locid END as venueslug,'
					. ' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as categoryslug'
					. ' FROM #__eventlist_events AS a'
					. ' LEFT JOIN #__eventlist_venues AS l ON a.locid = l.id'
					. ' LEFT JOIN #__eventlist_categories AS c ON c.id = a.catsid'
          . ' LEFT JOIN #__users AS u ON u.id = a.created_by'
					. $where
					;
    		$this->_db->setQuery($query);
			$this->_details = $this->_db->loadObject();

			return (boolean) $this->_details;
		}
		return true;
	}

	/**
	 * Method to build the WHERE clause of the query to select the details
	 *
	 * @access	private
	 * @return	string	WHERE clause
	 * @since	0.9
	 */
	function _buildDetailsWhere()
	{
		$where = ' WHERE a.id = '.$this->_id;

		return $where;
	}

	/**
	 * Method to check if the user is allready registered
	 *
	 * @access	public
	 * @return	array
	 * @since	0.9
	 */
	function getUsercheck()
	{
		// Initialize variables
		$user 		= & JFactory::getUser();
		$userid		= (int) $user->get('id', 0);

		//usercheck
		$query =  'SELECT *'
				. ' FROM #__eventlist_reg_user'
				. ' WHERE u_email = "'.$user->email
				. '" AND reg_id = '.$this->_id
		    	. " AND ch_join = 'y'"
				;
		$this->_db->setQuery( $query );
		return $this->_db->loadResult();
	}

	/**
	 * Method to get the registered users
	 *
	 * @access	public
	 * @return	object
	 * @since	0.9
	 */
	function getRegisters()
	{
		//avatars should be displayed
		$elsettings = & ELHelper::config();

		$avatar	= '';
		$join	= '';

		if ($elsettings->comunoption == 1 && $elsettings->comunsolution >=1) {
			$avatar = ', c.avatar';
			$join	= ' LEFT JOIN #__comprofiler as c ON c.user_id = r.uid';
		}

		//$name = $elsettings->regname ? 'u.*' : 'u.username';
/*
 * 以下為功能在 設定=>頁面細節的"報名"
 * 增加一個選項為openfoundry
 * 但因為有不同資料表之設定
 * 故使用if else 讓對不同的設定有所區隔
 * */
		//Get registered users
		//r.uid改成r.*

			$query = 'SELECT u.* AS name, r.*'
					. $avatar
					. ' FROM #__eventlist_reg_user AS r'
					. ' LEFT JOIN #__users AS u ON u.id = r.uid'
					. $join
					. ' WHERE r.reg_id = '.$this->_id;
					
			if( $elsettings->comunsolution == 2 ){
				$query .= ' AND r.ch_join = "y" ';
				$query .= ' order by uid DESC';
			}else{
				$query .= ' AND r.uid != 0 ';
			}

		$this->_db->setQuery( $query );
		$this->_registers = $this->_db->loadObjectList();

		return $this->_registers;
	}

	function getRegisters_ORDER()
	{
		//avatars should be displayed
		$elsettings = & ELHelper::config();

		$db = JFactory::getDBO();
		//Get registered users
		$query = 'SELECT * '
				. ' FROM #__eventlist_reg_user '
				. ' WHERE uid = 0'
				. ' AND ch_join = "y"'
				;
		$db->setQuery( $query );
		$this->_registers2 = $this->_db->loadObjectList();
		
		return $this->_registers2;
	}
	/**
	 * Deletes a registered user
	 由view/detail/tmpl/default_attendees.php使用
	 *
	 * @access public
	 * @return true on success
	 * @since 0.7
	 * 以下為code作業流程
	 * 1.驗證報名資料
	 * 2.修改vip code狀態
	 * 3.將使用者參與狀態改為取消
	 * 4.發信通知給使用者以及管理者 取消訊息
	 */
	function delreguser()
	{
			
		$user 	= & JFactory::getUser();
		$event 	= (int) $this->_id;
		$userid = $user->get('id');
		$reg_sn		=  JRequest::getVar( 'reg_sn', '', 'post','string', JREQUEST_ALLOWRAW );
		$ch_email	=  JRequest::getVar( 'ch_email', '', 'post','string', JREQUEST_ALLOWRAW );
		$registra	=  JRequest::getVar( 'registra', '', 'post','string', JREQUEST_ALLOWRAW );
		$elsettings = & ELHelper::config();

		$session =& JFactory::getSession();
		$leave_info = array();
		$leave_info['reg_sn'] = $reg_sn;
		$leave_info['ch_email'] = $ch_email;
		$session->set("leave_info", $leave_info);

    //確認驗證碼
			
		$tsCode=JRequest::getVar( 'Turing_cancel', '', 'post','string', JREQUEST_ALLOWRAW );
  	$ts_cancel=$session->get('ts_add');
		
		if (!isset($ts_cancel)){
						 JError::raiseNotice( 403, JText::_('CAPTCHAMESS') );
						 return;
		  }elseif( strtoupper($ts_cancel) != strtoupper($tsCode) ){
  	 	  		JError::raiseNotice( 403, JText::_('CAPTCHAMESS') );
						return;
	   }
		
		// Must be logged in
		if ($userid < 1 && $registra < 6) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}
		
		if( $reg_sn == null || $ch_email == null ){
			JError::raiseNotice( 500, JText::_('PLEASE ENTER THE CORRECT INFORMATION') );//vip 
			return;
		}
		
		//更改vip 狀態
		$db = JFactory::getDBO();
		$query = "UPDATE #__eventlist_vip SET ".
				 "code_state =  'n', ".
				 "use_code = '' ".
				 "WHERE reg_id = $event ".
				 "AND use_code = '$ch_email' ";
		$db->setQuery($query);
		$db->loadObject(); 
		
		//將使用者改成取消報名狀態
		$query ="UPDATE #__eventlist_reg_user SET ".
				"ch_join = 'n', ".
				"ch_mail = '1' , ".
				"note = 'OnlineCancel', ".
				"vip_code = '' ,".
				"reg_audit = '0' ".
				"WHERE reg_id = $event ".
				"AND u_email = '$ch_email' ".
				"AND reg_sn = '$reg_sn' ";
		
		$this->_db->SetQuery( $query );

		if (!$this->_db->query()) {
				JError::raiseError( 500, $this->_db->getErrorMsg() );
		}else{
			$ch_cancel = "SELECT * FROM #__eventlist_reg_user ".
						 "WHERE reg_sn = '$reg_sn' ".
						 "AND reg_id = $event ".
						 "AND ch_join = 'n' ".
						 "AND u_email = '$ch_email' ";

			$this->_db->SetQuery($ch_cancel);
			$this->_db->Query();

			if($this->_db->getNumRows() == 1 ){
				EventListModelDetails::mailtouser( $event, $elsettings->mail_cancel, $ch_email );
				EventListModelDetails::mailtouser( $event, $elsettings->toadmin_cancel, $ch_email );
	      		JError::raiseNotice( 403, JText::_('UNREGISTERED SUCCESSFULL') );
			}else{
				JError::raiseNotice( 403, JText::_('LAEAVE EVENT ERROR') );
			}
		}
		return true;
	}
	/**
	 * Deletes a registered user
	 *
	 * @access public
	 * @return true on success
	 * @since 0.7
	 * 以下為code作業流程
	 * 1.抓取活動資料
	 * 2.替換訊息
	 * 3.寄出
	 */
	function mailtouser($event,$mail_nu,$u_email,$u_name,$reg_num)
	{
		$elsettings = & ELHelper::config();
		$event		= $event;	//event id
		$mail_id	= $mail_nu;	//event mail
		$u_email	= $u_email;	//user mail
		$u_name		= $u_name;	//user name
		$reg_num	= $reg_num;
		
	//抓取event 資料
		$where[]= "id=$event";
		$event_data = ELOutput::search_data( $where, 'events', '');

		$mail_value=ELOutput::mail_replace( $event, $mail_id, $u_email );
		$kind = 	ELOutput::mailT_replace( $event, $mail_id, $u_email );
		
		$user =& JFactory::getUser($event_data->contact);
		$admin_name = $user->name;
		$admin_mail = $user->email;
  		$new_name = ereg_replace('-', ' ', $admin_name );
		$new_name = trim($new_name);

		//以下的if 共用參數為admin_name  admin_mail
		//若mail_nu==9
		//兩個參數是寄給活動聯絡人
		//若不是 則是寄給使用者

		if( $mail_nu == $elsettings->toadmin_cancel || $mail_nu == $elsettings->toadmin_full || $mail_nu == $elsettings->toadmin_join ){
			$j_user	= $u_email;
			$u_email= $admin_mail;
			
			if( $mail_nu == $elsettings->toadmin_cancel || $mail_nu == $elsettings->toadmin_full ){
				$j_user ='';
			}
			
			$db = JFactory::getDBO();
			$query = 'SELECT member '
					.' FROM #__eventlist_groupmembers '
					.' WHERE group_id = 1'; 
					;
			$db->setQuery($query);
			$CL = $db->loadObjectlist();

			foreach($CL as $admLs){
				$adm[]="'".$admLs->member."'";
			} 
			
			if($adm[0]!=''){
				$adm_Mail = implode(",",$adm);
				$query ="SELECT name, email ".
						"FROM #__users ".
						"WHERE id IN($adm_Mail)";
				$db->setQuery($query);
				$adm_Ls = $db->loadObjectlist();

				$subject = "=?UTF-8?b?".base64_encode($kind)."?=";

				foreach($adm_Ls as $list){
					$header_name = "";
					$header ="";
					$header_name ="=?UTF-8?B?".base64_encode($new_name)."?=";
					$header.= "From:".$header_name.$i." <".$list->email.">\r\n"; 
					$header.= "Reply-To: ".$list->email."\r\n";
					$header.= "MIME-Version: 1.0\r\n";
					$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
					$header.= "Content-Transfer-Encoding:8bit\n\r";
					mail($list->email, $subject, $mail_value,$header);
				}
			}
		}else{
			$subject =  "=?UTF-8?b?".base64_encode($kind)."?=";
			$header_name ="=?UTF-8?B?".base64_encode($new_name)."?=";
			$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
			$header.= "Reply-To: ".$admin_mail."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
			$header.= "Content-Transfer-Encoding:8bit\n\r";
			mail($u_email, $subject, $mail_value,$header);
		}
		
		return $mail_value;
	}
	
	/*
	報名函式
	不分註冊會員或非註冊會員
	 由view/detail/tmpl/default_attendees.php使用
	 * 以下為code作業流程
	 * 1.檢查登入狀態
	 * 2.檢查是否需要驗證vip
	 * 3.檢查整合狀態
	 * 4.檢查是否為黑名單
	 * 5.檢查參加人數
	 * 6.編輯報名序號
	 * 7.寫入資料庫並寄信
	 */
	function userregister()
	{
		global $mainframe;

		$user 		= & JFactory::getUser();
		$elsettings = & ELHelper::config();
		$tzoffset	= $mainframe->getCfg('offset');

		$uip 	= $elsettings->storeip ? getenv('REMOTE_ADDR') : 'DISABLED';//IP
		$today 	= date("Y-m-d");
		$uid 	= $user->get('id');
		
		$event 	= (int) $this->_id;
		$where[]= "id=$event";
		$event_info = ELOutput::search_data( $where, 'events', '');
		$db = JFactory::getDBO();
		$join_data = JRequest::get( 'join_data' );

		$user->email = $join_data['u_email'];//提供給view.html使用
		
	//檢查登入
		if($event_info->registra == 3 || $event_info->registra == 4 || $event_info->registra == 5){
			if( $user->get('id') == 0 ){
				JError::raiseNotice( 403, JText::_('ALERTNOTAUTH') );
				return;
			}
		}

	//確認驗證碼
		$session =& JFactory::getSession();
	  $ts_add=$session->get('ts_add');	
		$tsCode=JRequest::getVar( 'Turing', '', 'post','string', JREQUEST_ALLOWRAW );

	  if (!isset($ts_add)){
	              JError::raiseNotice( 403, JText::_('CAPTCHAMESS') );
	              return;
	    }elseif( strtoupper($ts_add) != strtoupper($tsCode) ){
	              JError::raiseNotice( 403, JText::_('CAPTCHAMESS') );
	              return;
	    }      



	//檢查是否需要驗證vip code
		if( $event_info->registra == 5 || $event_info->registra == 9 ){
			$today_join = strtotime(date( "Y-m-d H:i:s"));
			$open_vip	= strtotime(date("$event_info->vip_regdate $event_info->vip_endtime"));
			if( $open_vip > $today_join ) {$test_code = 1;}
		}
		if( $event_info->registra == 4 || $event_info->registra == 8 ){
			$test_code = 1;
		}
	//檢查是否需要驗證vip code END

	//驗證vip 
		if( $test_code == 1 ){
			$vipwhere[] = "reg_id = $event";
			$vipwhere[] = "vip_code = '".$join_data['vip_code']."'";
			$vipwhere[] = "code_state = 'n'";
			$vip_data = ELOutput::search_data( $vipwhere, 'vip', '');

		//code 已經被使用 返回前一頁
			if($vip_data->code_state == 'y'){
				JError::raiseNotice( 403, JText::_('VIP ERROR2') );//vip code 使用狀態
				return ;
			}
		//code 找不到 返回前一頁
			if($vip_data->code_state == ''){
				JError::raiseWarning( 403, JText::_('PLEASE ENTER A VALID VIP CODE') );
				return ;
			}
		}
	//驗證vip 結束
		
		
	if( $user->get('id') == 0 ){
		$notice_merger = ELOutput::check_merger($join_data['u_email']);//檢查是否合併
	}
	//查詢黑名單
	$notice_black = ELOutput::check_black( $join_data['u_email'] );

	  //判斷是否已開放報名
    $start_date = date('Y-m-d H:i:s',strtotime($event_info->open_date." ".$event_info->open_time));
    if(date('Y-m-d H:i:s')<=$start_date){
	         JError::raiseNotice( 403, JText::_('Not yet open for registration') );
	         return;
	       }
				
    //檢查目前參加人數
		$get_num =	"SELECT reg_sn ".
					"FROM #__eventlist_reg_user ".
					"WHERE reg_id = $event ".
					"AND ch_join = 'y' ".
					"GROUP BY reg_sn DESC ";
		$db->setQuery($get_num);
		$db->Query();
		$user_Full = $db->getNumRows();
		$eventJ = $db->loadObject();
	    
	  //判斷目前報名是否己滿（正取人數加後補人數）
	 
		if($user_Full >= ($event_info->candidate + $event_info->full)){
	          JError::raiseNotice( 403, JText::_('Quota is full, can not be registered') );
	          return;
	      }
	

		//報名人數超過正常人數
		if($user_Full >= $event_info->full){
			//user waiting
			$waitarray[] = "reg_id = $event";
			$wait_num = ELOutput::search_data( $waitarray, 'reg_user', 'GROUP BY waiting DESC');

			if($wait_num->waiting ==''){
				$waitN = 1;
			}else{
				$waitN = $wait_num->waiting + 1;
			}
			if( $test_code != 1 ){
				$user_mail = $elsettings->mail_candidate;//候補
			}
		}else{
			$user_mail = $elsettings->mail_join;//正常報名信件		
		}

		if($event_info->audit=='y' && $test_code != 1 ){
			$user_mail = $elsettings->audit_notice;//審核信
			$auditData = 0;
		}
		
		if($event_info->audit=='n'){
			$auditData = 1;
		}
		
		//編輯報名序號
		$reg_num = ELOutput::edit_sn($event);

		$obj = new stdClass();
		$obj->reg_id 		= $event;
		$obj->reg_sn   		= $reg_num;
		$obj->u_name 		= $join_data['u_name'];
		$obj->u_email   	= $join_data['u_email'];
		$obj->u_regday		= $today;
		$obj->u_sex			= 'm';
		$obj->u_company		= $join_data['u_company'];
		$obj->u_captaincy	= $join_data['u_captaincy0']."/".$join_data['u_captaincy1'];
		$obj->u_tel			= $join_data['u_tel'];
		$obj->u_addr		= $join_data['u_addr'];
		$obj->u_eat			= $join_data['reg_eat'];
		$obj->u_date		= '0000-00-00';
		$obj->u_signup		= $join_data['u_signup'];
		$obj->ch_phone		= 'n';
		$obj->ch_join		= 'y';
		$obj->note			= 'user join';
		$obj->community		= $join_data['community'];
		$obj->black			= 'n';
		$obj->vip_code		= $join_data['vip_code'];
		$obj->uid			= $uid;
		$obj->uregdate		= '';
		$obj->uip			= '';
		$obj->ch_mail		= '0';
		$obj->cancel_mail 	= 'n';
		$obj->notes			= '';
		$obj->waiting		= $waitN;
		$obj->survey		= $join_data['survey'];
		$obj->survey_text	= $join_data['survey_text'];
		$obj->reg_audit		= $auditData;

		if( $db->insertObject('#__eventlist_reg_user', $obj) == 1 ){

			if($test_code==1){
				$query = "UPDATE jos_eventlist_vip ".
						"SET code_state = 'y', ".
						"use_code = '".$join_data['u_email']."'".
						"WHERE vip_code = '".$join_data['vip_code']."'";
				$db->SetQuery( $query );
				if(!$db->Query()){
					JError::raiseWarning( 403, JText::_('SAVE VIP CODE ERROR') );
					return ;
				}
				$query =" UPDATE jos_eventlist_reg_user ".
						" SET reg_audit = '1' ".
						" WHERE u_email = '".$join_data['u_email']."' ".
						" AND reg_id = $event";
				$db->SetQuery( $query );
				if(!$db->Query()){
					JError::raiseWarning( 403, JText::_('SAVE VIP CODE ERROR') );
					return ;
				}
			}
			
			//寄信給使用者
			EventListModelDetails::mailtouser($event, $user_mail, $join_data['u_email'], $join_data['u_name'], $reg_num);
			//寄給管理者
			EventListModelDetails::mailtouser($event, $elsettings->toadmin_join, $join_data['u_email'], $join_data['u_name'], $reg_num);
			//檢查活動是否關閉
			EventListModelDetails::check_close($event,$event_info->full, $event_info->candidate);

			//報名成功取消 session
			$session =& JFactory::getSession();
			$session->clear("join_info");
			unset($join_data);
			
			if($notice_black!=''){
				JError::raiseNotice( 403,$notice_black);
			}	
			if($notice_merger!=''){
				JError::raiseNotice( 403,$notice_merger);
			}	
			return;
		}
		
//若正常報名後就會跳出此函式

//若不正常就會執行下面的 驗證是否重複報名
		$eventwhere = array();
		$eventwhere[] = " reg_id = ".$event;
		$eventwhere[] = " u_email = '".$join_data['u_email']."'";
		$checkJ = ELOutput::search_data( $eventwhere, 'reg_user', '');

		if( $checkJ->ch_join == 'y' ){
			JError::raiseNotice( 403, JText::_('DONT REGISTERED') );//已經重複報名
			return;
		}
		
		if( $checkJ->ch_join == 'n' ){
			$query ="UPDATE  #__eventlist_reg_user SET ".
					"ch_join =  'y', ".
					"reg_sn = 		'".$reg_num."', ".
					"u_name = 		'".$join_data['u_name']."', ".
					"community = 	'".$join_data['community']."', ".
					"u_company = 	'".$join_data['u_company']."', ".
					"u_captaincy = 	'".$join_data['u_captaincy0']."/".$join_data['u_captaincy1']."', ".
					"u_tel = 		'".$join_data['u_tel']."', ".
					"vip_code = 	'".$join_data['vip_code']."', ".
					"note = 'user join', ".
					"waiting = 		'".$waitN."', ".
					"u_signup = 	'".$join_data['u_signup']."', ".
					"uid = 			".$uid.", ".
					"u_regday = 	'".$today."', ".
					"survey  = 		'".$join_data['survey']."', ".
					"survey_text =	'".$join_data['survey_text']."', ".
					"ch_mail = '0', ".
					"cancel_mail = 'n' ,".
					"waiting= '$waitN' ,".
					"u_eat = 		'".$join_data['reg_eat']."', ".
					"reg_audit = '$auditData' ".
					"WHERE  reg_id = $event ".
					"AND u_email = '".$join_data['u_email']."'";
			$db->SetQuery( $query );
		}
		
		if($db->Query()){

			if($test_code==1){
				$query =" UPDATE jos_eventlist_vip ".
						" SET code_state = 'y', ".
						" use_code = '".$join_data['u_email']."' ".
						" WHERE vip_code = '".$join_data['vip_code']."' ".
						" AND reg_id = $event";
				$db->SetQuery( $query );
				if(!$db->Query()){
					JError::raiseWarning( 403, JText::_('SAVE VIP CODE ERROR') );
					return ;
				}
				$query =" UPDATE jos_eventlist_reg_user ".
						" SET reg_audit = '1' ".
						" WHERE u_email = '".$join_data['u_email']."' ".
						" AND reg_id = $event";
				$db->SetQuery( $query );
				if(!$db->Query()){
					JError::raiseWarning( 403, JText::_('SAVE VIP CODE ERROR') );
					return ;
				}
			}

		 	EventListModelDetails::mailtouser($event,$user_mail, $join_data['u_email'], $join_data['u_name'],$reg_num);//寄信給使用者
			EventListModelDetails::mailtouser($event,$elsettings->toadmin_join, $join_data['u_email'], $join_data['u_name'],$reg_num);//寄給管理者
			EventListModelDetails::check_close($event,$event_info->full,$event_info->candidate);//檢查是否關閉

			//報名成功取消 session
			$session =& JFactory::getSession();
			$session->clear("join_info");
			unset($join_data);
			if($notice_black!=''){
				JError::raiseNotice( 403,$notice_black);
			}	
			if($notice_merger!=''){
				JError::raiseNotice( 403,$notice_merger);
			}	
			return;
			
		}else{
			JError::raiseError( 500, $this->_db->getErrorMsg() );		
			return;
		}
		
		return;
	}
	
	/*
	admin信件函式
	判斷活動是否額滿
	若有就寄信給admin

	 * 以下為code作業流程
	 * 1.檢查目前參加人數
	 * 2.若額滿寄信給管理者
	 */

	function check_close($evevt_id,$full,$candidate){
		
		global $mainframe;
		$elsettings = & ELHelper::config();
		$event 		= (int) $evevt_id;

		//檢查目前參加人數
		$db = JFactory::getDBO();
		$get_num =	"SELECT waiting ".
					"FROM #__eventlist_reg_user ".
					"WHERE reg_id = $evevt_id ".
					"GROUP BY reg_sn DESC ";
		$db->setQuery($get_num);
		$db->Query();
		$waitNum = $db->loadObject();

		if( $candidate <=  $waitNum->waiting){
			EventListModelDetails::mailtouser( $event, $elsettings->toadmin_full, $u_email, $u_name, $reg_num );
		}
		
	}
	/*
	 * 列出已報名的會員
	 由view/detail/tmpl/default_attendees.php使用
	 */
	function user_viewM($register,$audit)
	{
		$u_num=0;

		foreach ($this->registers as $register) :
	
			if($u_num==10){
				$output .= "<ul id=\"menu\"  class=\"user floattext\" style='display:none;text-align:center;' >";
			}
		
			//原本應該使用的code
			//$useravatar = "<img src = ".$this->baseurl."/sso/user/image?name=$register->name&size=medium width=30>";
			//測試用的code 由於測試機的圖片無法顯現 所以直接使用主網站的圖片 待上線後可替換回原本應該使用的code 

			if($this->elsettings->regname == 0){
				$member_name = $register->username;
			}else{
				$member_name = $register->name;
			}

			if( $audit == 'y' && $register->reg_audit == '1' ){
				if($register->uid != 0 && $this->elsettings->comunoption == 0){
					$output .= "<li><a href='/community/userprofile/".$register->name."'><span class='username'>".str_replace('!','',$member_name)."</span></a></li>";
					$u_num=$u_num+1;
				}
				
				if($register->uid != 0 && $this->elsettings->comunoption == 1){
					$useravatar = "<img src = http://www.openfoundry.org/sso/user/image?name=$register->username&size=medium width=40>";
					$output .= "<li><a href='/community/userprofile/".$register->username."'>".$useravatar."<span class='username'>".str_replace('!','',$member_name)."</span></a></li>";
					$u_num=$u_num+1;
				}
			}

			if( $audit == 'n' ){
					if($register->uid != 0 && $this->elsettings->comunoption == 0){
						$output .= "<li><a href='/community/userprofile/".$register->name."'><span class='username'>".str_replace('!','',$member_name)."</span></a></li>";
						$u_num=$u_num+1;
					}
					
					if($register->uid != 0 && $this->elsettings->comunoption == 1){
						$useravatar = "<img src = http://www.openfoundry.org/sso/user/image?name=$register->username&size=medium width=40>";
						$output .= "<li><a href='/community/userprofile/".$register->username."'>".$useravatar."<span class='username'>".str_replace('!','',$member_name)."</span></a></li>";
						$u_num=$u_num+1;
					}
			}
			
		endforeach;

		return $output;
	}
	/*
	 * 列出已報名的使用者(非會員)
	 由view/detail/tmpl/default_attendees.php使用
	 */
	function user_viewNM($register,$audit)
	{
		$u_num=0;

		foreach ($this->registers as $register) :
		
			if( $audit == 'y' && $register->reg_audit == '1' ){
				if($u_num==20  ){
					$output .=  "</ul><ul id=\"menu2\"  class=\"user floattext\" style='display:none;text-align:left;' >";
				}
					
				$useravatar = "<img src = http://www.openfoundry.org/sso/user/image?name=$register->name&size=medium width=40>";
			 
				if($register->uid == 0){
					$output .= JHTML::_('image.site', 'people.png', 'components/com_eventlist/assets/images/', NULL, NULL, NULL,"width=32 title=$register->u_name");
					$u_num=$u_num+1;
				}
			}
			
			if( $audit == 'n' ){
				if($u_num==20  ){
					$output .=  "</ul><ul id=\"menu2\"  class=\"user floattext\" style='display:none;text-align:left;' >";
				}
					
				$useravatar = "<img src = http://www.openfoundry.org/sso/user/image?name=$register->name&size=medium width=40>";
			 
				if($register->uid == 0){
					$output .= JHTML::_('image.site', 'people.png', 'components/com_eventlist/assets/images/', NULL, NULL, NULL,"width=32 title=$register->u_name");
					$u_num=$u_num+1;
				}
			}
			
		endforeach;

		return $output;
	}
	
}
?>
