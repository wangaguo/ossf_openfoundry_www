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
 * Eve{EVENT_CANCEL}ntList Component reguser Controller
 * 
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListControllerreguser extends EventListController
{
	/**
	 * 黑名單功能
	 */
 	function black_user()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('reguser');
		
		if(!$model->black_user($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}
		
		$cids = implode(',',$cid);
		$user_info = explode('&',$cids);
		
		$msg = JText::_( 'JOIN BLACKED');
		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();
		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser', $msg );
	}

	/**
	 * 取消報名會員功能
	 */
 	function cancel_join()
	{
		unset($cid);
		
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('reguser');
		
		if(!$model->cancel_join($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}
		
		$cids=implode(',',$cid);
		$user_info=explode('&',$cids);
		
		$msg = JText::_( 'CANCELED');
		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();
		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser', $msg );
	}

	/*
	 編輯參加者 
	 */
	function edit( )
	{
		JRequest::setVar( 'view', 'regusers' );
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('regusers');
		$task 	= JRequest::getVar('task');

		if ($task == 'copy') {
			JRequest::setVar( 'task', $task );
		} else{
			$user	=& JFactory::getUser();
			// Error if checkedout by another administrator
			if ($model->isCheckedOut( $user->get('id') )) {
				$this->setRedirect( 'index.php?option=com_eventlist&view=reguser', JText::_( 'EDITED BY ANOTHER ADMIN' ) );
			}
			$model->checkout();
		}
		parent::display();
	}
	
	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$group = & JTable::getInstance('eventlist_reguser', '');
		$group->bind(JRequest::get('post'));
		$group->checkin();

		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser' );
	}
	
	/*
	 * 以下為函式流程
	 * 1.查詢黑名單否修改
	 * 2.查詢參與狀態是否修改
	 * 3.若參與狀態改為 Y 則編輯序號 更新資料庫
	 * 4.若為 N 則更新資料庫
	 */ 
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$task	= JRequest::getVar('task');
		$post	= JRequest::get( 'post' );
		
		$model	= $this->getModel('regusers');
		$user 	=& JFactory::getUser();
		$admin_name = $user->get('name');
		
		if($admin_name ==''){
			$admin_name ='ADMIN' ;	
		}
		
		$post['note'] = "admin [ ".$user->get('name')." ] join";

		if($post['black_state'] == 1 ){
			$black = 'y';
		}else{
			$black = 'n';
		}

		if($post['join_state'] == 1 ){

			$db = JFactory::getDBO();
			$sql_num = 	"SELECT * ".
						"FROM #__eventlist_reg_user ".
						"WHERE reg_id = $post[reg_id] ".
						"ORDER by reg_sn DESC";
			$db->setQuery($sql_num);
			$db_num = $db->loadObject();
			
			$old_num = $db_num->reg_sn;
			$new_num = $old_num + 1;
			$new_numlong = strlen($new_num);

			$sql_user = "SELECT * ".
						"FROM #__eventlist_reg_user ".
						"WHERE reg_id = $post[reg_id] ".
						"AND reg_sn = $post[reg_sn] ";
			$db->setQuery($sql_user);
			$db_user = $db->loadObject();
			
			$ch_join = $db_user->ch_join;
		
			switch($new_numlong){
				case '1':
					$new_num = "000$new_num";
				break;
		
				case '2':
					$new_num = "00$new_num";
				break;
			
				case '3':
						$new_num = "0$new_num";
				break;
	
				case '4':
					$new_num = "$new_num";
				break;
			}

			$post['ch_join'] = 'y';
			$post[note] = 'admin [ '.$user->get('name').' ] join';
		
		}else{
			$post['ch_join'] = 'n';
			$post['note'] = 'admin [ '.$user->get('name').' ] Cancel';
		}

 	 	$db = JFactory::getDBO();
		$query =	"UPDATE #__eventlist_reg_user SET ".
					"u_name = '$post[u_name]', ".
					"notes = '$post[notes]', ".
					"ch_join = '$post[ch_join]', ".
					"black = '$black', ".
					"community = '$post[community]', ".
					"u_tel = '$post[u_tel]', ".
					"u_captaincy = '$post[u_captaincy]', ".
					"u_company = '$post[u_company]', ".
					"u_eat = '$post[u_eat]', ".
					" note = '$post[note]' ";
							
		if($post['ch_join'] == 'y'){
			$query .=		", u_regday = '".gmdate('Y-m-d')."' ";
		}

		if($ch_join == 'n' && $post['ch_join'] == 'y'){
			$query .=		", reg_sn = '$new_num' ";
		}

		$query .=	"WHERE reg_id = ".$post['reg_id'].
					" AND reg_sn = ".$post['reg_sn'];
		$db->SetQuery( $query );
		$db->loadObject();
		
		$query =	"SELECT * FROM #__eventlist_reg_user  ".
					"WHERE notes = '$post[notes]' ".
					"AND reg_id = ".$post['reg_id']." AND reg_sn = '".$post['reg_sn']."'";
		$db->SetQuery( $query );
		$db->query();

		if ($db->getNumRows()==1) {
			$link = 'index.php?option=com_eventlist&view=reguser';
			$msg	= JText::_('SAVED');
			$cache = &JFactory::getCache('com_eventlist');
			$cache->clean();
		} else {
			$link = 'index.php?option=com_eventlist&view=reguser';
		}

		$model->checkin();

		$this->setRedirect( $link, $msg );
 	}

	/**
	 輸出txt
	 由view/reguser/view.html.php使用 
	 */
	function output_txt()
	{
	    function zbDB_Header($filename)
    	{
        	global $HTTP_USER_AGENT, $mainframe, $option;
			$file = "reg_user.txt";
			
        	if(eregi("msie",$HTTP_USER_AGENT))
            	$browser="1";
        	else
            	$browser="0";

        	header("Content-Type: application/octet-stream");
			
        	if ($browser)
        	{
            	header("Content-Disposition: attachment; filename=" . $file ."; charset=utf8");
            	header("Expires: 0");
            	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            	header('Pragma: public');
        	} else {
            	header("Content-Disposition: attachment; filename=" . $file ."; charset=utf8");
            	header("Expires: 0");
            	header("Pragma: public");
        	}
    		
			$filter = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
      	 	
			$db = JFactory::getDBO();
    		$sql_u = "SELECT u_name, u_email ".
         			 "FROM #__eventlist_reg_user ".
         			 "WHERE u_signup = 1 ".
         			 "AND reg_id = $filter ";
			$db->setQuery($sql_u);
			$event_items = $db->loadObjectList();
		
			$handle= fopen($file,'w');
			foreach($event_items as $item){
				$user_access = $item->u_email.", \n";
				fputs($handle,"$user_access");
			}
		
			fclose($handle);
		
			echo file_get_contents("reg_user.txt");
			exit;
    	}
    	
		zbDB_Header($file);
		
		header("Content-type:application; charset=utf8");
		header("Content-Disposition: attachment; filename=" . $file . "; charset=utf8");
		readfile('reg_user.txt');
		unlink('reg_user.txt');
		header('refresh:0;url=""');
	}
	
	/**
	 輸出csv
	 由view/reguser/view.html.php使用 
	 */
	function output_csv()
	{
	    function zbDB_Header($filename)
    	{
        	global $HTTP_USER_AGENT, $mainframe, $option;
			$file = "reg_user.csv";
			
        	if(eregi("msie",$HTTP_USER_AGENT))
            	$browser="1";
        	else
            	$browser="0";

        	header("Content-Type: application/octet-stream");
			
        	if ($browser)
        	{
            	header("Content-Disposition: attachment; filename=" . $file ."; charset=big5");
            	header("Expires: 0");
            	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            	header('Pragma: public');
        	} else {
            	header("Content-Disposition: attachment; filename=" . $file ."; charset=big5");
            	header("Expires: 0");
            	header("Pragma: public");
        	}
    		
			$filter = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
      	 	$db = JFactory::getDBO();
      	 	
    		$sql_event = " SELECT * ".
         			 " FROM #__eventlist_events ".
         			 " WHERE id = $filter ";
			$db->setQuery($sql_event);
			$event_items = $db->loadObject();

			$handle= fopen($file,'w');
			$title  = iconv('UTF-8','BIG5',JText::_('EVENT NAME')); 
			$title .= ",".iconv('UTF-8','BIG5',JText::_('SN'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('USER NAME'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('E MAIL'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('SIGNUP DATE'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('COMPANY NAME'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('DEPARTMENT/TITLE'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('TEL'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('ADDRESS'));
			if($event_items->reg_eat=='y'){
				$title .= ",".iconv('UTF-8','BIG5',JText::_('供餐'));
			}
			$title .= ",".iconv('UTF-8','BIG5',JText::_('NEWSLETTER'));
			$title .= ",".iconv('UTF-8','BIG5',JText::_('WhosWho'));
			if( $event_items->audit == 'y' ){
				$title .= ",".iconv('UTF-8','BIG5',JText::_('AUDIT'));
			}

			$title .= "\n";
			fputs($handle,$title);
			
    		$sql_u = " SELECT * ".
         			 " FROM #__eventlist_reg_user ".
         			 " WHERE reg_id = $filter ".
         			 " ORDER BY reg_sn ASC";
			$db->setQuery($sql_u);
			$user_list = $db->loadObjectList();

			foreach($user_list as $item)
			{
				if($item->u_signup=='n'){
					$u_signup = JText::_( 'NO2');
				}else{
					$u_signup = JText::_( 'YES2');
				}
				
				if($item->u_sex=='m'){
					$u_sex = "No";
				}else{
					$u_sex = "Yes";
				}
				 
				switch ($item->u_eat){
					case 0:
						$eat=JText::_('NO CHOICE');
					break;
					case 1:
						$eat=JText::_('MEAT AND FISH');
					break;
					case 2:
						$eat=JText::_('VEGETARIAN');
					break;
					case 3:
						$eat=JText::_('TAKE CARE OF THEMSELVES');
					break;
				}

				if($event_items->audit=='y'){
					switch ($item->reg_audit){
						case 0:
							$reg_audit=JText::_('un audit');
						break;
						case 1:
							$reg_audit=JText::_('approve');
						break;
						case 2:
							$reg_audit=JText::_('reject');
						break;
					}
				}
				
				$user_access =	iconv('UTF-8','BIG5',	$event_items->title).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->reg_sn).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_name).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_email).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_regday).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_company).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_captaincy).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_tel).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_addr).',';
				if($event_items->reg_eat=='y'){
					$user_access .=	iconv('UTF-8','BIG5',	$eat).',';
				}
				$user_access .=	iconv('UTF-8','BIG5',	$item->u_signup).',';
				$user_access .=	iconv('UTF-8','BIG5',	$item->sex).',';
								
				if($event_items->audit=='y'){
					$user_access .=		iconv('UTF-8','BIG5',$reg_audit);
				}
				$user_access .=	" \n";
				fputs($handle,$user_access);
			}
		
			fclose($handle);
			echo file_get_contents("reg_user.csv");
			exit;
    	}
    	
		zbDB_Header($file);
		header("Content-type:application; charset=utf8");
		header("Content-Disposition: attachment; filename=" . $file . "; charset=utf8");
		readfile('reg_user.csv');
		unlink('reg_user.csv');
		header('refresh:0;url=""');
	}

	 /**
	 輸出HTML
	 由view/reguser/view.html.php使用 
	 */
	function output_html()
	{
		function zbDB_Header($filename){
				
			global $HTTP_USER_AGENT, $mainframe, $option;
			
			$file = "reg_user.odt";
			$filter = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
 			
			$db = JFactory::getDBO();
			$sql_u = "SELECT * ".
					 "FROM jos_eventlist_events ".
 					 "WHERE id = $filter ORDER BY id";
			$db->setQuery($sql_u);
			$event_items = $db->loadObject();

			$eventtime = explode(':', $event_items->times);
			$eventtime = $eventtime[0].':'.$eventtime[1];
			$handle= fopen($file,'w');
	
			//title 為檔頭
			$title =	"<head>".
						"<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">".
     	  	  			"</head>
      		 	  		<center>
						<body>";
			fputs($handle,$title);
		
			//user_access_title 活動資料表格 上半部(至活動講師欄位)
			$user_access_title =
							"<table width=680px cellspacing=0 >".
							"<tbody font-family:AR PL UMing TW MBE,Arial,Times,TimesNR,New Century Schoolbook,Georgia,,serif;font-size:14px; >".
								"<tr>".
									"<td align=center><img src=http://www.openfoundry.org/images/OSSF.jpg width=130px></td>".
									"<td><b>".JText::_( 'EVENTSIGNALTURE' )."</b></td>".
								"</tr>".
										
								"<tr>".
									"<td colspan=2 height=10><hr size=2 color=#000000></td>".
								"</tr>".
												
								"<tr>".
									"<td height=18px><b>".JText::_( 'JOIN' ).JText::_( 'DATE' )."</b>:".$event_items->dates."</td>".
									"<td height=18><b>".JText::_( 'JOIN' ).JText::_( 'TIME' )."</b>:".$eventtime."</td>".
								"</tr>".
												
								"<tr>".
									"<td colspan=2 height=18><b>".JText::_( 'EVENT NAME' )."</b>:".$event_items->title."</td>".
								"</tr>".
												
								"<tr>".
									"<td colspan=2 height=18><b>".JText::_( 'TEACHER' )."</b>:</td>".
								"</tr>".
							"</tbody>".
						"</table>".
						"<table width=\"680px\" class=\"ex\" cellspacing=\"0\" border=\"1\">".
						"<tr >".
							"<th width=\"5%\" bgcolor=\"#cccccc\"  align=\"center\" valign=\"middle\" height=\"18\">".JText::_( 'SN' )."</th>".
							"<th width=\"15%\" bgcolor=\"#cccccc\"  align=\"center\" valign=\"middle\" height=\"18\" >".JText::_( 'NAME' )."</th>".
							"<th width=\"40%\" bgcolor=\"#cccccc\"  align=\"center\" valign=\"middle\" height=\"18\" >".JText::_( 'COMPANY NAME' )." ".JText::_( 'DEPARTMENT/TITLE' )."</th>".
							"<th width=\"25%\" bgcolor=\"#cccccc\"  align=\"center\" valign=\"middle\" height=\"18\" >".JText::_( 'SIGNALTURE' )."</th>".
							"<th width=\"15%\" bgcolor=\"#cccccc\" align=\"center\" valign=\"middle\" height=\"18\" >".JText::_( 'NOTE' )."</th>".
						"</tr>";
			fputs($handle,$user_access_title);

			//如果為審核制 SQL 搜尋條件增加 "已通過審核"
			if( $event_items->audit=='y' ){ $audit = ' AND reg_audit = \'1\' ';}

			//查詢參加者資料
 			$sql_user = " SELECT * ".
						" FROM jos_eventlist_reg_user ".
						" WHERE ch_join = 'y' ".
						" AND reg_id = $filter ".$audit.
						" ORDER BY reg_sn";
			$db->setQuery($sql_user);
			$user_profile = $db->loadObjectList();
			$no = 0;

			foreach($user_profile as $user_p){
				$sql_newuser =	"SELECT u_regday ".
								"FROM jos_eventlist_reg_user ".
								"WHERE u_email = '$user_p->u_email' ".
								"ORDER BY u_regday";
				$db->setQuery($sql_newuser);
				$newuser_profile = $db->loadObject();
				$db->Query($sql_newuser);
				$join_num=$db->getNumRows();
			
				$note = array();
				
				//如果查詢出的資料只有一 表示為初次參加活動的成員
				if( $join_num == 1 ){$note[] = "new!";}

				$strbr="$user_p->u_company $user_p->u_captaincy";
				$no = $no + 1;
				if($no>20){
					fputs($handle,"</table>");
					fputs($handle,"<div style=page-break-before:always>");
					fputs($handle,$user_access_title);
					$no=1;
				}
				
				//若資料為null 將表格內容填入空格 (未填入表格會無法表現出框架)
				if( $user_p->reg_sn == '' ) $user_p->reg_sn='&nbsp;';
				if( $user_p->u_name == '' ) $user_p->u_name='&nbsp;';
				$strbr = trim($strbr);
				if( $strbr == '/' ) $strbr='&nbsp;';
				if( $strbr == '' ) $strbr='&nbsp;';
				
				//用餐習慣
				switch($user_p->u_eat){
					case 0:
						$user_eat = JText::_('NO CHOICE');
					break;
					case 1:
						$user_eat = JText::_('MEAT AND FISH');
					break;
					case 2:
						$user_eat = JText::_('VEGETARIAN');
					break;
					case 3:
						$user_eat = JText::_('TAKE CARE OF THEMSELVES');
					break;
				}
				if($event_items->reg_eat=='y'){$note[]=JText::_('MEALS').$user_eat;}
				
				if(count($note)==0) $note[]='&nbsp;';
				
				//寫入表格
				$strbr = str_replace( '/', ' ', $strbr );
				$note = implode('</br>',$note);
				$user_access = 	"<tr >".
								"<td height=\"37\">$user_p->reg_sn</td>".
								"<td>$user_p->u_name</td>".
								"<td>$strbr</td>".
								"<td>&nbsp;</td>".
								"<td>$note</td>".
							"</tr>";
				fputs($handle,$user_access);
			}

			//補上空白表格 
			$no_space = 20-$no-1;

			for($add=0;$add<$no_space;$add++){
				$user_access =  "<!--以為下為空格-->".
								"<tr >".
								"<td height=\"37\"><!--填入序號-->&nbsp;</td>".
								"<td style =\"font-size:9pt;\"><!--填入名稱-->&nbsp;</td>".
								"<td height=\"31\" ><!--填入職位-->&nbsp;</td>".
								"<td height=\"31\" ><!--簽到欄位-->&nbsp;</td>".
								"<td height=\"31\" ><!--填入note-->&nbsp;</td>
								</tr>";
				fputs($handle,$user_access);
			}
			fputs($handle,"</center></div>");
			fclose($handle);
			echo file_get_contents("reg_user.odt");
			exit;
		}
		zbDB_Header($file);
	}

	/**
	 寄信給admin
	 由view/reguser/view.html.php使用 
	 * 以下為函式流程流程
	 * 1.取得活動資料
	 * 2.取得管理者資料
	 * 3.編輯信件內容
	 * 4.編輯信件title
	 * 5.寄出
	*/
	function mailtoadmin()
	{
		global $mainframe, $option;
		
		$returnid 	= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int');
		$mail_nu 	= $mainframe->getUserStateFromRequest( $option.'.mail_title', 'mail_title', '', 'int' );
		
		unset($cid);
		
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}
		
		$db = JFactory::getDBO();
		//抓event admin 資料
		$user = & JFactory::getUser();;
		
		$db = JFactory::getDBO();
		$sql_event 	=   "SELECT * ".
						"FROM #__eventlist_events ".
						"WHERE id =  ".$returnid;
		$db->setQuery($sql_event);
		$event_data = $db->loadObject(); 
		
		$my_id = $user->get($event_data->contact);
		$usersParams = &JComponentHelper::getParams( 'com_users' );
		$admin_mail = $user->get('email');
		$admin_name = $user->get('name');
		
		$sql_adm_data = "SELECT * ".
						"FROM #__comprofiler ".
						"WHERE user_id = ".$my_id;
		$db->setQuery($sql_adm_data);
	 	$adm_data = $db->loadObject();	
	    
	 	$mail_value = ELOutput::mail_replace($returnid, $mail_nu, $admin_name);
	 	$kind = ELOutput::mailT_replace($returnid, $mail_nu, $admin_name);

		$subject =  "=?UTF-8?b?".base64_encode("$kind")."?=";
		$admin_name = ereg_replace('-',' ', $admin_name);
		$admin_name = trim($admin_name);
		$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
		$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
		$header.= "Reply-To: ".$admin_mail."\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
		$header.= "Content-Transfer-Encoding:8bit\n\r";
		
			if(mail($admin_mail, $subject, $mail_value,$header)){
				$msg .= JText::_( 'MAIL SENDED' )." $admin_mail";
			}else{
				$msg .= JText::_( 'MAIL ERROR' );
			}

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();
		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser', $msg );
	}

	/**
	 寄信給user
	 由view/reguser/view.html.php使用 
	 * 以下為函式流程流程
	 * 1.依據篩選狀態取得使用者資料
	 * 2.取得管理者資料取得管理者資料
	 * 3.編輯信件內容
	 * 4.編輯信件title
	 * 5.寄出
	*/
	function sendmail()
	{
		global $mainframe, $option;
		
		$returnid = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int');
		$mail_nu = $mainframe->getUserStateFromRequest( $option.'.mail_title', 'mail_title', '', 'int' );
		$glist = $mainframe->getUserStateFromRequest( $option.'.glist', 'glist', '', 'int' );
		$area = $mainframe->getUserStateFromRequest( $option.'.area', 'area', '', 'int' );
		
		unset($cid);
		
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		for($i=0;$i<count($cid);$i++){
				
			$user_info = explode('&',$cid[$i]);
			
			jimport( 'joomla.user.user' );
			
			/*
			如果$returnid != 0
			管理者使用活動列表
			
			如果$returnid = 0 
			管理者使用區域或分類列表
			*/
			if( $returnid != 0 ){
				$db = JFactory::getDBO();
				$sql_event ="SELECT * ".
							"FROM #__eventlist_events ".
							"WHERE id =  ".$returnid;
				$db->setQuery($sql_event);
				$event_data = $db->loadObject(); 
				$user =&JFactory::getUser($event_data->contact);
			}else{
				$user =&JFactory::getUser();
			}

			//抓event admin 資料
			$usersParams = &JComponentHelper::getParams( 'com_users' );
			$admin_mail = $user->get('email');
			$admin_name = $user->get('name');

	 		$mail_value = ELOutput::mail_replace($returnid, $mail_nu, $user_info[2]);
	 		$kind = ELOutput::mailT_replace($returnid, $mail_nu, $user_info[2]);

			$header = '';
			$subject =  "=?UTF-8?b?".base64_encode($kind)."?=";
			$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
			$header.= "From:".$header_name." <".$admin_mail.">\r\n"; 
			$header.= "Reply-To: ".$admin_mail."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
			$header.= "Content-Transfer-Encoding:8bit\n\r";

			if(mail($user_info[2], $subject, $mail_value,$header)){
				$msg .= JText::_( 'MAIL SENDED' )." $user_info[2]";
			}else{
				$msg .= JText::_( 'MAIL ERROR' );
			}
		}
		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();
		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser', $msg );
	}

	/**
	 新增使用者
	 由view/reguser/view.html.php使用 
	 * 以下為函式流程流程
	 * 1.取得使用者資料
	 * 2.編輯報名序號
	 * 3.查詢是否為會員
	 * 4.寫入資料庫
	*/
	function add_user()
	{
		global $mainframe, $option;
		$user =& JFactory::getUser();
		
		$returnid = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int'); //活動id
		$post = JRequest::get( 'post' ); //取得post變數
		$post['vip_name'] 	= JRequest::getVar( 'vip_name', '', 'post','string', JREQUEST_ALLOWRAW); //取得邀請者name
		$post['invite'] 	= JRequest::getVar( 'invite', '', 'post','string', JREQUEST_ALLOWRAW); //取得邀請者信箱
		$post['send_mail'] 	= JRequest::getVar( 'send_mail', '', 'post','int', JREQUEST_ALLOWRAW); //checkbox
		$invite 			= $post['invite'];

		$db = JFactory::getDBO();
		$q_user =	"SELECT * ".
					"FROM #__users ".
					"WHERE email = '$invite'";
		$db->setQuery($q_user);
		$search_user = $db->loadObject();
		unset($where);
		$where[] 	= " reg_id = $returnid ";
		$num_order 	= " ORDER BY reg_sn DESC ";
		$search_num = ELOutput::search_data( $where, 'reg_user', $num_order );
		$num = $search_num->reg_sn;
		$reg_num = $num + 1;
		$strnum = strlen($reg_num);

		switch($strnum){
			case '1':
				$reg_num = "000$reg_num";
			break;
			case '2':
				$reg_num = "00$reg_num";
			break;
			case '3':
				$reg_num = "0$reg_num";
			break;
			case '4':
				$reg_num = "$reg_num";
			break;
		}

		if($search_user->email == '' ){//如果找不到信箱就直接新增
			$reg = new stdClass();
			$reg->reg_id 	= $returnid;
			$reg->reg_sn	= $reg_num;
			$reg->u_name	= $post['vip_name'];
			$reg->u_regday	= gmdate('Y-m-d');
			$reg->u_email 	= $invite;
			$reg->note		= "admin [ ".$user->get('name')." ] join";
			$reg->survey	= '7';
			$reg->reg_audit		= '1';
			$reg->u_eat	= '0';
			if($db->insertObject('#__eventlist_reg_user', $reg)){
				$adduser_msg = JText::_( 'ADD USER1' )." $reg->u_email ".JText::_( 'ADD USER3' );
				if($post['send_mail']=="on"){
					EventListControllerreguser::sendmail_add($returnid,$reg->u_email,$reg_num);
				}
				$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$returnid, $adduser_msg );
			}else{
				$query =	"UPDATE #__eventlist_reg_user SET ".
									"ch_join = 'y' ,".
									"reg_sn = '$reg_num', ".
									"reg_audit = '1', ".
									"survey = '7', ".
									"u_eat = '0', ".
									"note = 'admin [ ".$user->get('name')." ] join' ".
									"WHERE reg_id = $returnid AND u_email = '$reg->u_email'";
				$db->SetQuery( $query );
				$db->loadObject();
				$adduser_msg = JText::_( 'ADD USER1' )." $reg->u_email ".JText::_( 'ADD USER3' );
				if($post['send_mail']=="on"){
					EventListControllerreguser::sendmail_add($returnid,$reg->u_email,$reg_num);
				}
				$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$returnid, $adduser_msg );
			}
		}else{ //如果找到信箱 就新增找到的個人資料

			$reg = new stdClass();
			$reg->reg_id 	= $returnid;
			$reg->reg_sn	= "$reg_num";
			$reg->u_name	= $search_user->name;
			$reg->u_regday	= gmdate('Y-m-d');
			$reg->u_email 	= $search_user->email;
			$reg->note		= "admin [ ".$user->get('name')." ] join";
			$reg->uid		= $search_user->id;
			$reg->reg_audit	= '1';
			$reg->survey	= '7';
			$reg->u_eat		= '0';
			if($db->insertObject('#__eventlist_reg_user', $reg)){    //輸入報名資料
				$adduser_msg = JText::_( 'ADD USER2' )." $reg->u_email ".JText::_( 'ADD USER3' );
				if($post['send_mail']=="on"){
					EventListControllerreguser::sendmail_add($returnid,$reg->u_email,$reg_num);
				}
				$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$returnid, $adduser_msg );
			}else{			//輸入報名資料發生錯誤時
				$user_join ="SELECT * ".
							"FROM #__eventlist_reg_user ".
							"WHERE u_email = '$invite' AND reg_id = $returnid";
				$db->setQuery($user_join);
				$join_state = $db->loadObject();

				if($join_state->ch_join == 'n'){  //找尋此信箱是否取消過參加活動 如果有就改回參加狀態
			
					$query =" UPDATE #__eventlist_reg_user SET ".
							" ch_join = '' ,".
							" reg_sn = '$reg_num', ".
							" reg_audit = '1', ".
							" survey = '7', ".
							" u_eat = '0', ".
							" note = 'admin [ ".$user->get('name')." ] join' ".
							"WHERE reg_id = $returnid AND u_email = '$reg->u_email'";
					$db->SetQuery( $query );
					$db->loadObject();
					$adduser_msg = JText::_( 'ADD USER2' )." $reg->u_email ".JText::_( 'ADD USER3' );
					if($post['send_mail']=="on"){
						EventListControllerreguser::sendmail_add($returnid,$reg->u_email,$reg_num);
					}
					
				}
				
				if($join_state->ch_join == 'y'){
					$adduser_msg = JText::_( 'USER JOIN');
				}
				$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$returnid,$adduser_msg );
			}	
		}
	}

	/*
	 寄信給由管理者加入的參加者 
	 由view/reguser/view.html.php使用 
	*/
	function sendmail_add($returnid,$user_mail,$reg_num)
	{
		global $mainframe, $option;
		$settings = & ELAdmin::config();
		
		jimport( 'joomla.user.user' );
		$db = JFactory::getDBO();
		$sql_event ="SELECT * ".
         			"FROM #__eventlist_events ".
         			"WHERE id = $returnid ";
		$db->setQuery($sql_event);
		$event_data = $db->loadObject(); 

	//抓取event 資料
		//抓event admin 資料
		$user =& JFactory::getUser("$event_data->contact");
		$usersParams = &JComponentHelper::getParams( 'com_users' );
		$admin_mail = $user->get('email');
		$admin_name = $user->get('name');
		
		$kind = ELOutput::mailT_replace( $returnid, $settings->mail_join, $user_mail);
		$mail_value = ELOutput::mail_replace( $returnid, $settings->mail_join, $user_mail);

	//抓admin資料
		$adm_id = $user->get('id');
		$sql_adm_data = "SELECT * ".
		                "FROM #__comprofiler ".
						"WHERE user_id = ".$user->get('id');
		$db->setQuery($sql_adm_data);
	    $adm_data = $db->loadObject();	

	 	$admin_name = ereg_replace('-',' ', $admin_name);
		$admin_name = ereg_replace('!',' ', $admin_name);
		$admin_name = trim($admin_name);
		$adm_phone	= $adm_data->cb_tel;
		
		$subject =  "=?UTF-8?b?".base64_encode("$kind")."?=";
		$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
		$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
		$header.= "Reply-To: ".$admin_mail."\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
		$header.= "Content-Transfer-Encoding:8bit\n\r";

		mail($user_mail, $subject, $mail_value,$header);

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();
	}
	
	/*
	 群組信 
	 * 以下為函式流程
	 * 1.找出參與過相關活動的mail
	 * 2.找出已經報名該活動的mail
	 * 3.刪除重複的mail
	 * 4.抓admin資料
	 * 5.寄出
	 */
	function group_mail()
	{
		global $mainframe, $option;
		$returnid= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int');
		$mail_id = JRequest::getVar( 'mail_title', '', 'post','int', JREQUEST_ALLOWRAW); //select list
		$cid 	 = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$db = JFactory::getDBO();
		
		$where[] = " id = $returnid ";
		$event_info = ELOutput::search_data( $where, 'events', '' );
	    $g_category = $event_info->catsid;
	    $g_area = $event_info->reg_area;

	    $where = array();
	    if($g_area != 0 ){
	    	$where[] = " reg_area = $g_area ";
	    }
	    if($g_category != 0){
	    	$where[] = " catsid = $g_category ";
	    }
	    $where[] = " ID !=".$returnid;
	    
	    $where_f = "WHERE ".implode('AND', $where);

/**	  找出參與過相關活動的mail   **/
		$like_sql = "SELECT id ".
					"FROM #__eventlist_events ".$where_f;
		$db->setQuery($like_sql);
	    $like_id = $db->loadObjectlist();

	    $id_array = array();
	    foreach($like_id as $event){
	    	$id_array[] = $event->id;
	    }

	    $str_id = implode( "," , $id_array);
	    
	    $user_sql = "SELECT u_email ".
					"FROM #__eventlist_reg_user ".
					"WHERE reg_id IN(".$str_id .") ".
					"GROUP BY u_email";
		$db->setQuery($user_sql);
	    $like_user = $db->loadObjectlist();

	    $u_list = array();
	    foreach($like_user as $user_m){
	    	$u_list[] = $user_m->u_email;
	    }
/**	  找出參與過相關活動的mail end   **/

/**	  找出已經報名該活動的mail   **/
		for($i=0;$i<=count($cid);$i++){
			$uid = explode('&',$cid[$i]);
			$eventUL[] =$uid[2];
		}
/**	  找出已經報名該活動的mail end   **/

/**	  刪除重複的mail   **/
		//刪除相同的值
		for($i=0;$i<=count($u_list);$i++){
			for($j=0;$j<=count($eventUL);$j++){
				if($u_list[$i]==$eventUL[$j]){
					unset($u_list[$i]);
				}
			}
		}

		sort($u_list);//將陣列重新排序 不至於有空值出現
/**	  刪除重複的mail end   **/

		//抓admin資料
		$user =& JFactory::getUser();
		$admin_name = $user->get('name');
		$admin_mail = $user->get('email');
		$msg='';

		for($i=0;$i<count($u_list);$i++){
				
			$kind = ELOutput::mailT_replace( $returnid, $mail_id, $u_list[$i]);
			$mail_value = ELOutput::mail_replace( $returnid, $mail_id, $u_list[$i]);

			$subject =  "=?UTF-8?b?".base64_encode("$kind")."?=";
			$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
			$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
			$header.= "Reply-To: ".$admin_mail."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
			$header.= "Content-Transfer-Encoding:8bit\n\r";

			if(mail($u_list[$i], $subject, $mail_value,$header)){;
				$msg .= JText::_( 'MAIL SENDED' )." $u_list[$i]";
			}else{
				$msg .= JText::_( 'MAIL ERROR' );
			}
		}

		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$returnid,$msg );

	}
	
	/*
	審核通過
	 由view/reguser/view.html.php使用 
	*/
	function audit_approved()
	{

		$post = JRequest::get( 'post' ); //取得post變數
		$audit_sn = $post['audit_sn'];
		$audit_mail = $post['audit_mail'];
		$strnum = strlen($audit_sn);
		$elsettings = ELAdmin::config();

		switch($strnum){
			case '1':
				$reg_num = "000$audit_sn";
			break;
			case '2':
				$reg_num = "00$audit_sn";
			break;
			case '3':
				$reg_num = "0$audit_sn";
			break;
			case '4':
				$reg_num = "$audit_sn";
			break;
		}

		$db = JFactory::getDBO();
		$sql_update =" UPDATE  #__eventlist_reg_user SET ".
					" reg_audit = '1' ".
         			" WHERE reg_id = ".$post['audit_id'] .
         			" AND reg_sn = ".$reg_num;
		$db->setQuery($sql_update);
	
		if(!$db->query()) {
			$this->setError($db->getErrorMsg());
			return false;
		}else{
			
			$msg = JText::_( 'AUDIT APPROVED');

			$kind = ELOutput::mailT_replace( $post['audit_id'], $elsettings->mail_approved,$audit_mail);
			$mail_value = ELOutput::mail_replace( $post['audit_id'], $elsettings->mail_approved,$audit_mail);
		
			$sql_event=" SELECT contact FROM #__eventlist_events ".
						" WHERE id =".$post['audit_id'];
			$db->setQuery($sql_event);
			$event_data = $db->loadObject();
			
			$user =& JFactory::getUser($event_data->contact);
			$admin_name = $user->name;
			$admin_mail = $user->email;

			$subject =  "=?UTF-8?b?".base64_encode("$kind")."?=";
			$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
			$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
			$header.= "Reply-To: ".$admin_mail."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
			$header.= "Content-Transfer-Encoding:8bit\n\r";

			mail($audit_mail, $subject, $mail_value,$header);

		}
		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$post['audit_id'],$msg );
	}
	
	/*
	 審核未通過 
	 由view/reguser/view.html.php使用 
	 */
	function audit_rejected()
	{
		$post = JRequest::get( 'post' ); //取得post變數
		$audit_sn = $post['audit_sn'];
		$audit_mail = $post['audit_mail'];
		$strnum = strlen($audit_sn);
		$elsettings = ELAdmin::config();
		
		switch($strnum){
			case '1':
				$reg_num = "000$audit_sn";
			break;
			case '2':
				$reg_num = "00$audit_sn";
			break;
			case '3':
				$reg_num = "0$audit_sn";
			break;
			case '4':
				$reg_num = "$audit_sn";
			break;
		}

		$db = JFactory::getDBO();
		$sql_update =" UPDATE  #__eventlist_reg_user SET ".
					" reg_audit = '2' ".
         			" WHERE reg_id = ".$post['audit_id'] .
         			" AND reg_sn = ".$reg_num;
		$db->setQuery($sql_update);

		if(!$db->query()) {
			$this->setError($db->getErrorMsg());
			return false;
		}else{
			$msg = JText::_( 'AUDIT REJECTED' );
			$kind = ELOutput::mailT_replace( $post['audit_id'], $elsettings->mail_rejected ,$audit_mail);
			$mail_value = ELOutput::mail_replace( $post['audit_id'], $elsettings->mail_rejected,$audit_mail);
		
			$sql_event=" SELECT contact FROM #__eventlist_events ".
						" WHERE id =".$post['audit_id'];
			$db->setQuery($sql_event);
			$event_data = $db->loadObject();
			
			$user =& JFactory::getUser($event_data->contact);
			$admin_name = $user->name;
			$admin_mail = $user->email;
		
			$subject =  "=?UTF-8?b?".base64_encode("$kind")."?=";
			$header_name ="=?UTF-8?B?".base64_encode($admin_name)."?=";
			$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
			$header.= "Reply-To: ".$admin_mail."\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
			$header.= "Content-Transfer-Encoding:8bit\n\r";

			mail($audit_mail, $subject, $mail_value,$header);
			
		}

		$this->setRedirect( 'index.php?option=com_eventlist&view=reguser&event='.$post['audit_id'],$msg );
	}
	
}

?>
