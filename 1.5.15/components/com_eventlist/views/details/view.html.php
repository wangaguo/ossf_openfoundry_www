<?php
/**
 * @version 1.1 $Id: view.html.php 1001 2009-04-14 15:07:36Z julienv $
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
 * HTML Details View class of the EventList component
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListViewDetails extends JView
{
	/**
	 * Creates the output for the details view
	 *
 	 * @since 0.9
	 */
	function display($tpl = null)
	{
		global $mainframe;
		
		$document 	= & JFactory::getDocument();
		$user		= & JFactory::getUser();
		$dispatcher = & JDispatcher::getInstance();
		$elsettings = & ELHelper::config();

		$row		= & $this->get('Details');
		$registers	= & $this->get('Registers');
		$regcheck	= & $this->get('Usercheck');
		$user_data->name = $user->name;
		$user_data->email = $user->email;
		$menu		= & JSite::getMenu();
		$item    	= $menu->getActive();
		$params 	= & $mainframe->getParams('com_eventlist');

		//Check if the id exists
		if ($row->did == 0){
			return JError::raiseError( 404, JText::sprintf( 'Event #%d not found', $row->did ) );
		}

		//Check if user has access to the details
		if ($elsettings->showdetails == 0) {
			return JError::raiseError( 403, JText::_( 'NO ACCESS' ) );
		}

		//add css file
		$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/eventlist.css');
		$document->addCustomTag('<!--[if IE]><style type="text/css">.floattext{zoom:1;}, * html #eventlist dd { height: 1%; }</style><![endif]-->');

		//Print
		$pop	= JRequest::getBool('pop');

		$params->def( 'page_title', JText::_( 'DETAILS' ));

		if ( $pop ) {
			$params->set( 'popup', 1 );
		}

		$print_link = JRoute::_('index.php?view=details&id='.$row->slug.'&pop=1&tmpl=component');

		//pathway
		$pathway 	= & $mainframe->getPathWay();
		$pathway->addItem( JText::_( 'DETAILS' ). ' - '.$row->title, JRoute::_('index.php?view=details&id='.$row->slug));

		//Get images
		$dimage = ELImage::flyercreator($row->datimage, 'event');
		$limage = ELImage::flyercreator($row->locimage);

		//Check user if he can edit
		$allowedtoeditevent = ELUser::editaccess($elsettings->eventowner, $row->created_by, $elsettings->eventeditrec, $elsettings->eventedit);
		$allowedtoeditvenue = ELUser::editaccess($elsettings->venueowner, $row->venueowner, $elsettings->venueeditrec, $elsettings->venueedit);

		//Timecheck for registration
		$jetzt = date("Y-m-d H:i:s");
		$now = strtotime($jetzt);
		$date = strtotime(date("$row->dates $row->times"));
		//$date = strtotime($row->dates) + strtotime($row->endtimes);
		$timecheck = $date - $now;

		$vip_jetzt = date("Y-m-d H:i:s");
		$vip_now = strtotime($vip_jetzt);
		$vip_date = strtotime(date("$row->vip_regdate $row->vip_endtime"));
		$viptmiecheck = $vip_date - $vip_now;

		//let's build the registration handling
		$formhandler  = 0;
		$full = 0;
		
/*$formhandler 狀態說明
 1 = 活動結束
 2 = 檢查登入
 3 = 取消頁面
 4 = open頁面
 5 = vip頁面
 6 = 系統自動關閉
 7 = open 非會員
 8 = vip 會員
 9 = 尚未開放
 */
 
/*$registra 狀態說明
 3 = open頁面
 4 = vip頁面
 5 = open+vip頁面
 7 = open 非會員
 8 = vip 會員
 9 = 免登入vip+open
*/

		//檢查是否有登入 以及活動時間
		if ( !$user->get('id') && $timecheck < 0 ) {
			$formhandler = 1;
		}
		
		//是否報名活動 in 112~117
		if ($formhandler >= 3) {
			$js = "function check(checkbox, senden) {
				if(checkbox.checked==true){
					senden.disabled = false;
				} else {
					senden.disabled = true;
				}}";
			$document->addScriptDeclaration($js);
		}
		
		//系統自動關閉
		if($row->registra == 6){
			$formhandler = 6;
		}

		//驗證vip 報名時間
		$vipdate = strtotime(date("$row->vip_regdate $row->vip_endtime"));
		$viptimecheck = $vipdate - $now;

		//檢查是否登入
		if($row->registra < 6 && $row->registra > 2 && $timecheck > 0 && $user->get('id') == 0){
			$formhandler = 2;
		}
		
		//open+vip(login)
		if($row->registra == 5 && $viptmiecheck > 0){
			$row->registra = 4;
		}
		
		if($row->registra == 5 && $viptimecheck < 0){
			$row->registra = 3;
		}
		
		//open(login)
		if( $row->registra == 3 && $timecheck > 0  && $user->get('id') > 0  ){
			if( !$regcheck ){
				$formhandler = 4;	//有登入 活動性質為open 且為開放時間 未報名
			}else{
				$formhandler = 3;	//有登入 活動性質為open 且為開放時間 已報名
			}
		}
		
		//vip(login)
		if($row->registra == 4 && $timecheck > 0 && $user->get('id') > 0){
			if(!$regcheck ){
				$formhandler = 5;	//有登入 且為開放時間 未報名
			}else{
				$formhandler = 3;	//有登入 且為開放時間 已報名
			}
		}
		
		//open+vip(no login)
		if($row->registra == 9 && $viptmiecheck > 0){
			$row->registra = 8;
		}
		if($row->registra == 9 && $viptimecheck < 0){
			$row->registra = 7;
		}

		//open(no login)
		if($row->registra == 7 && $timecheck > 0 ){
			if( !$user->get('id') > 0 ){
				$formhandler = 7;//未登入 且為開放時間
			}		
			if( $user->get('id') > 0 && !$regcheck ){
				$formhandler = 4;//有登入 且為非開放時間 
			}		
			if( $user->get('id') > 0 && $regcheck ){
				$formhandler = 3;//有登入 且為開放時間
			}		
		}	
		
		//vip(no login)
		if( $row->registra == 8 && $timecheck > 0 ){
			if( !$user->get('id') > 0){
				$formhandler = 8;//未登入 且為開放時間
			}		
			if( $user->get('id') > 0 && !$regcheck ){
				$formhandler = 5;//有登入 且為非開放時間
			}		
			if( $user->get('id') > 0 && $regcheck ){
				$formhandler = 3;//有登入 且為開放時間
			}		
		}

		//檢查活動時間
		if ( $timecheck < 0 ) {
			$formhandler = 1;
		}

		$today_time = strtotime(date( "Y-m-d H:i:s"));
		$open_time	= strtotime(date("$row->open_date $row->open_time"));

		$endSignup = strtotime(date( "$row->signupEnddate $row->signupEndtime"));
		$signupCheck = $endSignup - $today_time;

		if($signupCheck < 0){
			$formhandler = 1; //設定報名時間已到
		}

		if ( $today_time < $open_time ) {
			$formhandler = 9; //到了活動時間
		}

		if ( $row->registra == 0 ){
			$formhandler = 0; //活動不開放報名
		}

		

	

		$db = JFactory::getDBO();

		//非審核制的額滿處理
		if( $row->audit == 'n' ){
			$query ="SELECT waiting FROM #__eventlist_reg_user ".
					"WHERE reg_id = ".$row->did.
					" ORDER by waiting DESC";
			$db->SetQuery( $query );
			$event_wait = $db->loadObject();
			$event_waiting = $event_wait->waiting;

			if( $event_waiting >= $row->candidate ){
				$formhandler = 1;  //人員額滿自動結束
			}
		}
		if( $row->audit == 'y' ){
			$query ="SELECT * FROM #__eventlist_reg_user ".
					"WHERE reg_id = ".$row->did.
					" AND reg_audit = '1' ".
					" AND ch_join = 'y' ";
			$db->SetQuery( $query );
			$db->Query();
			$approved = $db->getNumRows();
			
			if( $approved >= $row->candidate + $row->full ){
				$formhandler = 1;  //人員額滿自動結束
			}
		}
		
		$sql_u = "SELECT * ".
				 "FROM #__eventlist_reg_user ".
				 "WHERE u_email = '".$user->email."' ".
         		 "AND reg_id = $row->did ";
		$db->setQuery($sql_u);
		$u_join = $db->loadObject();

		if( $u_join->ch_mail == 1 ){
			$u_join->u_email == '';
		}
		//Generate Eventdescription
		if (($row->datdescription == '') || ($row->datdescription == '<br />')) {
			$row->datdescription = JText::_( 'NO DESCRIPTION' ) ;
		} else {
			//Execute Plugins
			$row->text	= $row->datdescription;

			JPluginHelper::importPlugin('content');
			$results = $dispatcher->trigger('onPrepareContent', array (& $row, & $params, 0));
			$row->datdescription = $row->text;
		}

		//Generate Venuedescription
		if (($row->locdescription == '') || ($row->locdescription == '<br />')) {
			$row->locdescription = JText::_( 'NO DESCRIPTION' );
		} else {
			//execute plugins
			$row->text	=	$row->locdescription;

			JPluginHelper::importPlugin('content');
			$results = $dispatcher->trigger('onPrepareContent', array (& $row, & $params, 0));
			$row->locdescription = $row->text;
		}

		// generate Metatags
		$meta_keywords_content = "";
		if (!empty($row->meta_keywords)) {
			$keywords = explode(",",$row->meta_keywords);
			foreach($keywords as $keyword) {
				if ($meta_keywords_content != "") {
					$meta_keywords_content .= ", ";
				}
				if (ereg("[/[/]",$keyword)) {
					$keyword = trim(str_replace("[","",str_replace("]","",$keyword)));
					$buffer = $this->keyword_switcher($keyword, $row, $elsettings->formattime, $elsettings->formatdate);
					if ($buffer != "") {
						$meta_keywords_content .= $buffer;
					} else {
						$meta_keywords_content = substr($meta_keywords_content,0,strlen($meta_keywords_content) - 2);	// remove the comma and the white space
					}
				} else {
					$meta_keywords_content .= $keyword;
				}

			}
		}
		if (!empty($row->meta_description)) {
			$description = explode("[",$row->meta_description);
			$description_content = "";
			foreach($description as $desc) {
					$keyword = substr($desc, 0, strpos($desc,"]",0));
					if ($keyword != "") {
						$description_content .= $this->keyword_switcher($keyword, $row, $elsettings->formattime, $elsettings->formatdate);
						$description_content .= substr($desc, strpos($desc,"]",0)+1);
					} else {
						$description_content .= $desc;
					}
			}
		} else {
			$description_content = "";
		}

		//set page title and meta stuff
		$document->setTitle( $item->name.' - '.$row->title );
        $document->setMetadata('keywords', $meta_keywords_content );
        $document->setDescription( strip_tags($description_content) );

        //build the url
        if(!empty($row->url) && strtolower(substr($row->url, 0, 7)) != "http://") {
        	$row->url = 'http://'.$row->url;
        }

        //create flag
        if ($row->country) {
        	$row->countryimg = ELOutput::getFlag( $row->country );
        }

		$query =	"SELECT * FROM #__eventlist_reg_user  ".
					" WHERE reg_id = ".$row->did.
					" AND u_email = '$user->email' ".
					" ORDER by waiting DESC";
		$db->SetQuery( $query );
		$wait_num = $db->loadobject();

		if($u_join->waiting == '')
		{
			$wait_num_PLUS = 0;
			$mail_id	= $elsettings->mail_join;
		}else if($u_join->waiting == 0 )
		{
			$wait_num_PLUS = 0;
			$mail_id	= $elsettings->mail_join;
		}else if($u_join->waiting > 0 )
		{
			$wait_num_PLUS = $wait_num->waiting + 1;
			$mail_id	= $elsettings->mail_candidate;
		}
		
		if($row->audit=='y' && $wait_num->reg_audit == 0 ){
			$mail_id = $elsettings->audit_notice;
		}
//自動關閉活動 結束
		/*
		print_r($row->audit);
		print_r($wait_num->reg_audit);
		print_r($elsettings->audit_notice."</br>");
		print_r($elsettings->mail_join."</br>");
		print_r($elsettings->mail_candidate."</br>");
		print_r($elsettings->mail_cancel."</br>");
		print_r($rwait_num->reg_audit);
		*/

//報名成功預設信件
		$u_join->ch_mail_join =  ELOutput::mail_replace($row->did, $mail_id, $user->email);
//報名成功預設信件 結束
		$u_join->ch_mail_cancel =  ELOutput::mail_replace($row->did, $elsettings->mail_cancel, $user->email);

		// load dispatcher for plugins    
		JPluginHelper::importPlugin( 'eventlist' );
		$dispatcher =& JDispatcher::getInstance();  

		//assign vars to jview
		$this->assignRef('lists'        ,	 	$lists);
		$this->assignRef('u_join', 				$u_join);
		$this->assignRef('user_data', 			$user_data);
		$this->assignRef('row', 				$row);
		$this->assignRef('params' , 			$params);
		$this->assignRef('allowedtoeditevent' , $allowedtoeditevent);
		$this->assignRef('allowedtoeditvenue' , $allowedtoeditvenue);
		$this->assignRef('dimage' , 			$dimage);
		$this->assignRef('limage' , 			$limage);
		$this->assignRef('print_link' , 		$print_link);
		$this->assignRef('registers' , 			$registers);
		$this->assignRef('registers2' , 		$registers2);
		$this->assignRef('formhandler',			$formhandler);
		$this->assignRef('timecheck',			$timecheck);
		$this->assignRef('elsettings' , 		$elsettings);
		$this->assignRef('item' , 				$item);
   		$this->assignRef('dispatcher' ,     	$dispatcher);

		parent::display($tpl);
	}

	/**
	 * structures the keywords
	 *
 	 * @since 0.9
	 */
	function keyword_switcher($keyword, $row, $formattime, $formatdate) {
		switch ($keyword) {
			case "catsid":
				$content = $row->catname;
				break;
			case "a_name":
				$content = $row->venue;
				break;
			case "times":
			case "endtimes":
				if ($row->$keyword) {
					$content = strftime( $formattime ,strtotime( $row->$keyword ) );
				} else {
					$content = '';
				}
				break;
			case "dates":
			case "enddates":
				$content = strftime( $formatdate ,strtotime( $row->$keyword ) );
				break;
			default:
				$content = $row->$keyword;
				break;
		}
		return $content;
	}
}
?>
