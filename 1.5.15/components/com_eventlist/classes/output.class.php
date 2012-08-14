<?php
/**
 * @version 1.0 $Id: output.class.php 958 2009-02-02 17:23:05Z julienv $
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

defined('_JEXEC') or die('Restricted access');

/**
 * Holds the logic for all output related things
 *
 * @package Joomla
 * @subpackage EventList
 */
class ELOutput {

	/**
	* Writes footer. Official copyright! Do not remove!
	*
	* @author Christoph Lukes
	* @since 0.9
	*/
	function footer( )
	{
		echo 'EventList powered by <a href="http://www.schlu.net">schlu.net</a>';
	}

	/**
	* Writes Event submission button
	*
	* @author Christoph Lukes
	* @since 0.9
	*
	* @param int $dellink Access of user
	* @param array $params needed params
	* @param string $view the view the user will redirected to
	**/
	function submitbutton( $dellink, &$params )
	{
		if ($dellink == 1) {

			JHTML::_('behavior.tooltip');

			if ( $params->get('icons') ) {
				$image = JHTML::_('image.site', 'submitevent.png', 'components/com_eventlist/assets/images/', NULL, NULL, JText::_( 'DELIVER NEW EVENT' ));
			} else {
				$image = JText::_( 'DELIVER NEW EVENT' );
			}

			$link 		= 'index.php?view=editevent';
			$overlib 	= JText::_( 'SUBMIT EVENT TIP' );
			$output		= '<a href="'.JRoute::_($link).'" class="editlinktip hasTip" title="'.JText::_( 'DELIVER NEW EVENT' ).'::'.$overlib.'">'.$image.'</a>';

			return $output;
		}

		return;
	}

	/**
	* Writes Archivebutton
	*
	* @author Christoph Lukes
	* @since 0.9
	*
	* @param int $oldevent Archive used or not
	* @param array $params needed params
	* @param string $task The current task
	* @param int $categid The cat id
	*/
	function archivebutton( &$params, $task = NULL, $id = NULL )
	{

		$settings = & ELHelper::config();
		
		if ( $settings->oldevent == 2 ) {

			JHTML::_('behavior.tooltip');
			
			$view = JRequest::getWord('view');
			
			if ($task == 'archive') {
				
				if ( $params->get('icons') ) {
					$image = JHTML::_('image.site', 'eventlist.png', 'components/com_eventlist/assets/images/', NULL, NULL, JText::_( 'SHOW EVENTS' ));
				} else {
					$image = JText::_( 'SHOW EVENTS' );
				}
				$overlib 	= JText::_( 'SHOW EVENTS TIP' );
				$title 		= JText::_( 'SHOW EVENTS' );
				
				if ($id) {
						$link 		= JRoute::_( 'index.php?view='.$view.'&id='.$id );
				} else {
						$link 		= JRoute::_( 'index.php' );
				}
				
			} else {
				
				if ( $params->get('icons') ) {
					$image = JHTML::_('image.site', 'archive_front.png', 'components/com_eventlist/assets/images/', NULL, NULL, JText::_( 'SHOW ARCHIVE' ));
				} else {
					$image = JText::_( 'SHOW ARCHIVE' );
				}
				$overlib 	= JText::_( 'SHOW ARCHIVE TIP' );
				$title 		= JText::_( 'SHOW ARCHIVE' );
					
				if ($id) {
					$link 		= JRoute::_( 'index.php?view='.$view.'&id='.$id.'&task=archive' );
				} else {
					$link		= JRoute::_('index.php?view='.$view.'&task=archive');
				}
			}

			$output = '<a href="'.$link.'" class="editlinktip hasTip" title="'.$title.'::'.$overlib.'">'.$image.'</a>';

			return $output;

		}
		return;
	}

	/**
	 * Creates the edit button
	 *
	 * @param int $Itemid
	 * @param int $id
	 * @param array $params
	 * @param int $allowedtoedit
	 * @param string $view
	 * @since 0.9
	 */
	function editbutton( $Itemid, $id, &$params, $allowedtoedit, $view)
	{

		if ( $allowedtoedit ) {

			JHTML::_('behavior.tooltip');

			switch ($view)
			{
				case 'editevent':
					if ( $params->get('icons') ) {
						$image = JHTML::_('image.site', 'calendar_edit.png', 'components/com_eventlist/assets/images/', NULL, NULL, JText::_( 'EDIT EVENT' ));
					} else {
						$image = JText::_( 'EDIT EVENT' );
					}
					$overlib = JText::_( 'EDIT EVENT TIP' );
					$text = JText::_( 'EDIT EVENT' );
					break;

				case 'editvenue':
					if ( $params->get('icons') ) {
						$image = JHTML::_('image.site', 'calendar_edit.png', 'components/com_eventlist/assets/images/', NULL, NULL, JText::_( 'EDIT EVENT' ));
					} else {
						$image = JText::_( 'EDIT VENUE' );
					}
					$overlib = JText::_( 'EDIT VENUE TIP' );
					$text = JText::_( 'EDIT VENUE' );
					break;
			}

			$link 	= 'index.php?view='.$view.'&id='.$id.'&returnid='.$Itemid;
			$output	= '<a href="'.JRoute::_($link).'" class="editlinktip hasTip" title="'.$text.'::'.$overlib.'">'.$image.'</a>';

			return $output;
		}

		return;
	}

	/**
	 * Creates the print button
	 *
	 * @param string $print_link
	 * @param array $params
	 * @since 0.9
	 */	
	function printbutton( $print_link, &$params )
	{
		if ($params->get( 'show_print_icon' )) {

			JHTML::_('behavior.tooltip');

			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

			// checks template image directory for image, if non found default are loaded
			if ( $params->get( 'icons' ) ) {
				$image = JHTML::_('image.site', 'printButton.png', 'images/M_images/', NULL, NULL, JText::_( 'Print' ));
			} else {
				$image = JText::_( 'Print' );
			}

			if (JRequest::getInt('pop')) {
				//button in popup
				$output = '<a href="#" onclick="window.print();return false;">'.$image.'</a>';
			} else {
				//button in view
				$overlib = JText::_( 'PRINT TIP' );
				$text = JText::_( 'Print' );

				$output	= '<a href="'. JRoute::_($print_link) .'" class="editlinktip hasTip" onclick="window.open(this.href,\'win2\',\''.$status.'\'); return false;" title="'.$text.'::'.$overlib.'">'.$image.'</a>';
			}

			return $output;
		}
		return;
	}

	/**
	 * Creates the email button
	 *
	 * @param object $slug
	 * @param array $params
	 * @since 0.9
	 */
	function mailbutton($slug, $view, $params)
	{
		if ($params->get('show_email_icon')) {

			JHTML::_('behavior.tooltip');
			$uri    =& JURI::getInstance();
			$base  	= $uri->toString( array('scheme', 'host', 'port'));
			$link 	= $base.JRoute::_( 'index.php?view='.$view.'&id='.$slug, false );
			$url	= 'index.php?option=com_mailto&tmpl=component&link='.base64_encode( $link );
			$status = 'width=400,height=300,menubar=yes,resizable=yes';

			if ($params->get('icons')) 	{
				$image = JHTML::_('image.site', 'emailButton.png', 'images/M_images/', NULL, NULL, JText::_( 'EMAIL' ));
			} else {
				$image = JText::_( 'EMAIL' );
			}

			$overlib = JText::_( 'EMAIL TIP' );
			$text = JText::_( 'EMAIL' );

			$output	= '<a href="'. JRoute::_($url) .'" class="editlinktip hasTip" onclick="window.open(this.href,\'win2\',\''.$status.'\'); return false;" title="'.$text.'::'.$overlib.'">'.$image.'</a>';

			return $output;
		}
		return;
	}

	/**
	 * Creates the map button
	 *
	 * @param obj $data
	 * @param obj $settings
	 *
	 * @since 0.9
	 */
	function mapicon($data)
	{
		$settings = & ELHelper::config();
		
		//Link to map
		$mapimage = JHTML::_('image.site', 'mapsicon.png', 'components/com_eventlist/assets/images/', NULL, NULL, JText::_( 'MAP' ));

		//set var
		$output 	= null;
		$attributes = null;

		//stop if disabled
		if (!$data->map) {
			return $output;
		}
		
		$data->country = JString::strtoupper($data->country);

		//google or map24
		switch ($settings->showmapserv)
		{
			case 1:
			{
  				if ($settings->map24id) {

				$url		= 'http://link2.map24.com/?lid='.$settings->map24id.'&amp;maptype=JAVA&amp;width0=2000&amp;street0='.$data->street.'&amp;zip0='.$data->plz.'&amp;city0='.$data->city.'&amp;country0='.$data->country.'&amp;sym0=10280&amp;description0='.$data->venue;
				$output		= '<a class="map" title="'.JText::_( 'MAP' ).'" href="'.$url.'" target="_blank">'.$mapimage.'</a>';

  				}
			} break;

			case 2:
			{
				if($settings->gmapkey) {

					$document 	= & JFactory::getDocument();
					JHTML::_('behavior.mootools');

					//TODO: move map into squeezebox
					//TODO: temporary fix (v=2.115) for the gmaps issue caused by a bug in the gmaps api..set back when google finaly was able to fix this
					$document->addScript($this->baseurl.'/components/com_eventlist/assets/js/gmapsoverlay.js');
					$document->addScript('http://maps.google.com/maps?file=api&amp;v=2.115&amp;key='.trim($settings->gmapkey));
  					$document->addStyleSheet($this->baseurl.'/components/com_eventlist/assets/css/gmapsoverlay.css', 'text/css');

					$url		= 'http://maps.google.com/maps?q='.str_replace(" ", "+", $data->street).', '.$data->plz.' '.str_replace(" ", "+", $data->city).', '.$data->country.'&amp;venue='.$data->venue;
					$attributes = ' rel="gmapsoverlay"';
				} else {
					$url		= 'http://maps.google.com/maps?q='.str_replace(" ", "+", $data->street).', '.$data->plz.' '.str_replace(" ", "+", $data->city).', '.$data->country;
				}

				$output		= '<a class="map" title="'.JText::_( 'MAP' ).'" href="'.$url.'"'.$attributes.'>'.$mapimage.'</a>';

			} break;
		}

		return $output;
	}

	/**
	 * Creates the flyer
	 *
	 * @param obj $data
	 * @param obj $settings
	 * @param array $image
	 * @param string $type
	 *
	 * @since 0.9
	 */
	function flyer( $data, $image, $type = 'venue' )
	{
		$settings = & ELHelper::config();

		//define the environment based on the type
		if ($type == 'event') {
			$folder		= 'events';
			$imagefile	= $data->datimage;
			$info		= $data->title;
		} else {
			$folder 	= 'venues';
			$imagefile	= $data->locimage;
			$info		= $data->venue;
		}

		//do we have an image?
		if (empty($imagefile)) {

			//nothing to do
			return;

		} else {

			jimport('joomla.filesystem.file');

			//does a thumbnail exist?
			if (JFile::exists(JPATH_SITE.DS.'images'.DS.'eventlist'.DS.$folder.DS.'small'.DS.$imagefile)) {

				if ($settings->lightbox == 0) {

					$url		= '#';
					$attributes	= 'class="modal" onclick="window.open(\''.$this->baseurl.'/'.$image['original'].'\',\'Popup\',\'width='.$image['width'].',height='.$image['height'].',location=no,menubar=no,scrollbars=no,status=no,toolbar=no,resizable=no\')"';

				} else {

					JHTML::_('behavior.modal');

					$url		= $this->baseurl.'/'.$image['original'];
					$attributes	= 'class="modal" title="'.$info.'"';

				}

				$icon	= '<img src="'.$this->baseurl.'/'.$image['thumb'].'" width="'.$image['thumbwidth'].'" height="'.$image['thumbheight'].'" alt="'.$info.'" title="'.JText::_( 'CLICK TO ENLARGE' ).'" />';
				$output	= '<a href="'.$url.'" '.$attributes.'>'.$icon.'</a>';
			
				//$output	= '<img class="modal" src="'.$this->baseurl.'/'.$image['original'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$info.'" />';

			//No thumbnail? Then take the in the settings specified values for the original
			} else {
				$output	= '<img class="modal" src="'.$this->baseurl.'/'.$image['original'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$info.'" />';
			}
		}

		return $output;
	}

	/**
	 * Creates the country flag
	 *
	 * @param string $country
	 *
	 * @since 0.9
	 */
	function getFlag($country)
	{
        $country = JString::strtolower($country);

        jimport('joomla.filesystem.file');

        if (JFile::exists(JPATH_COMPONENT_SITE.DS.'assets'.DS.'images'.DS.'flags'.DS.$country.'.gif')) {
        	$countryimg = '<img src="'.JURI::base(true).'/components/com_eventlist/assets/images/flags/'.$country.'.gif" alt="'.JText::_( 'COUNTRY' ).': '.$country.'" width="16" height="11" />';

        	return $countryimg;
        }

        return null;
	}
	
	/**
	 * Formats date
	 *
	 * @param string $date
	 * @param string $time
	 * 
	 * @return string $formatdate
	 *
	 * @since 0.9
	 */
	function formatdate($date, $time)
	{
		$settings = & ELHelper::config();
		
		if(!$date) {
			return;
		}
		
		if(!$time) {
			$time = '00:00:00';
		}
		
		//Format date
		$formatdate = strftime( $settings->formatdate, strtotime( $date.' '.$time ));
		
		return $formatdate;
	}
	
	/**
	 * Formats time
	 *
	 * @param string $date
	 * @param string $time
	 * 
	 * @return string $formattime
	 *
	 * @since 0.9
	 */
	function formattime($date, $time)
	{
		$settings = & ELHelper::config();
		
		if(!$time) {
			return;
		}
		
		//Format time
		$formattime = strftime( $settings->formattime, strtotime( $date.' '.$time ));
		$formattime .= ' '.$settings->timename;
		
		return $formattime;
	}
	
	/*
	活動編輯 預設內容
	 */
function Default_value( )
	{
	$Default = "<!--警告標語--><div class=\"alert\"><div class=\"typo-icon\">本活動尚未開放、請勿報名，未開放報名前的任何報名都將被視為無效。</div></div>
<!--下載/影片/問卷-->
<!--
<div class=\"media\">
	<div class=\"typo-icon\">
		<strong>感謝各界先進的參與，本活動已圓滿結束，如有任何問題歡迎跟活動連絡人連繫。<br />
		簡報檔案<br />
		活動花絮<br>
		<strong>活動錄影檔案</strong> 
		<br>Session1 -<br /> 
		Session2 -<br />
		Session3 - 
		</span>
	</div>
</div>
<div class=\"notice\"><div class=\"typo-icon\">本活動 OSSF 為協助舉辦，主辦單位是XXX ，如有關於活動上的問題，請直接聯絡XXX </div>
</div>
-->

<div class=\"bulletin-workshop\">
	<h3>議程簡介</h3>
	這邊填寫介紹
	<ul>
		<li>對象：</li>
		<li>人數：</li>
		<li>費用：</li>
		<li>平台：</li>
	</ul>
</div>
<!--議程簡介  END--> 
<!--活動議程  Start--> 
<table id=\"customers\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\" width=\"100%\">
	<tbody>
		<tr valign=\"top\">
			<th width=\"20%\"> 時間 </th> <th width=\"60%\"> 議程 </th>
		</tr>
		<tr valign=\"top\">
			<td width=\"20%\">09:30-10:00</td>
			<td width=\"60%\">xxxx</td>
		</tr>
		<tr class=\"alt\" valign=\"top\">
			<td width=\"20%\">10:00-10:10</td>
			<td width=\"60%\">xxxx</td>
		</tr>
	</tbody>
</table>
<!--活動議程  END-->
<!--system_speak-->
<!--system_speak_end-->
<!--講者介紹  END--> <!--注意事項  Start--><div class=\"info-workshop\">
<h3><strong>注意事項</strong></h3>
	<ul>
		<li>報名時請務必填寫 正確 可以聯絡到您的 E-Mail 以利候補作業或課程變動等通知。</li>
		<li>本次課程由於座位有限，若您報名後因故不克前來參加，請您務必於開課前三天 到此<a href=\"#cancel\">取消報名</a>！</li>
		<li>您的報名資料將只用於本次及未來的工作坊活動宣傳及問卷，不會傳遞給任何第三者。</li>
		<li>主辦單位保留更改活動內容及相關事項之權利。</li>
	</ul>
</div><!--注意事項  END--> <!--參考資料  Start--><div class=\"references-workshop\">
<h3><strong>參考資料</strong></h3>
	<ul>
		<li>xxxx</li>
		<li>xxxx</li>
		<li>xxxx</li>
		<li>xxxx</li>
		<li>xxxx</li>
	</ul>
</div>
<!--參考資料  END-->";	
	return $Default;
	}

	/*
	 替換信件內容 
	 eventid:活動
	 mailid:信件
	 usermail:使用者信箱
	 set_lang:語系
	 
	 mailid輸入皆是使用中文信的id
	 如果活動要求使用英文信
	 函式會自動轉換成英文信的id
	 
	 函式流程
	1.抓取活動資料
	2.活動時間取得
	3.轉換語系
	4.編輯時間字串
	5.抓取信件內容
	6.替換信件字串
	*/
	function mail_replace( $eventid, $mailid, $usermail, $set_lang)
	{
		$setting_where[] = " id = 1 ";
		$elsettings = ELOutput::search_data( $setting_where, 'settings', '' );
		
		$db = JFactory::getDBO();

		//抓取活動
		$eventD_where[] = " id = $eventid ";
		$eventD = ELOutput::search_data( $eventD_where, 'events', '' );

	  	$in_time 	= explode(":", $eventD->times);
		$in_date 	= explode("-", $eventD->dates);
		$end_time 	= explode(":", $eventD->endtimes);
		$end_date 	= explode("-", $eventD->enddates);
		$vipin_date	= explode("-", $eventD->vip_regdate);
		$vipend_time= explode(":", $eventD->vip_endtime);

		//vip 時間變數取得
		//以下用說明用2011-10-25 做說明
		$week_in	 = date('w', strtotime($eventD->dates));//活動日期 星期 1 2 3 4  ex:2
		$vipweek_in	 = date('w', strtotime($eventD->vip_regdate));//vip報名截止日 星期 1 2 3 4
		$endweek_in  = date('w', strtotime($eventD->enddates));//活動結束日 星期 1 2 3 4
		
		$week_inEn	 = date('l', strtotime($eventD->dates));//活動日期星期EN ex:Tuesday 
		$vipweek_inEn= date('l', strtotime($eventD->vip_regdate));//vip報名截止日星期EN ex:Tuesday
		$endweek_inEn= date('l', strtotime($eventD->vip_regdate));//活動結束日星期EN ex:Tuesday
		
		$vip_code_m	 = date("F", strtotime($eventD->vip_regdate));//VIP報名月份EN ex:October
		$week_end	 = date('w', strtotime($eventD->enddates));//活動結束日 星期 1 2 3 4
		$vip_md		 = date('M', strtotime(date('Y-M-d'))).' '.date('d', strtotime(date('Y-M-d')));//VIP報名時間簡寫+日期Oct 25

		//set lang 為語系選項
		//如果沒有給語系選項 就使用活動預設的語系
		if($set_lang != '' ){
			$tr_lang = $set_lang;
		}else{
			$tr_lang = $eventD->reg_msg;
		}

		//如果是英文語系 就將中文語系的信轉為英文
	 	if($tr_lang == 'en'){
			
			if( $mailid == $elsettings->mail_approved && $elsettings->mail_approved_EN != 0 ){$mailid = $elsettings->mail_approved_EN;}//通過審核
			if( $mailid == $elsettings->mail_rejected && $elsettings->mail_rejected_EN != 0 ){$mailid = $elsettings->mail_rejected_EN;}//未通過審核
			if( $mailid == $elsettings->audit_notice && $elsettings->audit_notice_EN != 0 ){$mailid = $elsettings->audit_notice_EN;}//等待審核
			if( $mailid == $elsettings->mail_join && $elsettings->mail_join_EN != 0 ){$mailid = $elsettings->mail_join_EN;}//報名成功
			if( $mailid == $elsettings->mail_cancel && $elsettings->mail_cancel_EN != 0 ){$mailid = $elsettings->mail_cancel_EN;}//報名失敗
			if( $mailid == $elsettings->mail_candidate && $elsettings->mail_candidate_EN != 0 ){$mailid = $elsettings->mail_candidate_EN;}//候補
			if( $mailid == $elsettings->touser_vipmail && $elsettings->touser_vipmail_EN != 0 ){$mailid = $elsettings->touser_vipmail_EN;}//邀請信

			$lang = 'English';
			$PJ = "Please refer";
			$CJ	= "Cancel";
		}

		if($tr_lang == 'zh'){
			$lang = '中文';
			$PJ = "請參考";
			$CJ	= "取消報名";
	  	}

	  	if( $eventD->enddates != '' ){
			$eventEndDate = "至 $end_date[1] 月 $end_date[2] 日 （".JText::_( $week_end )."） ";
		}
		if($eventD->dates==$eventD->enddates){
			$event_time_zh = "$in_date[0] 年 $in_date[1] 月 $in_date[2] 日 （".JText::_( $week_in )."） $in_time[0]:$in_time[1]~$end_time[0]:$end_time[1]";
		}else{
			$event_time_zh = "$in_date[0] 年 $in_date[1] 月 $in_date[2] 日 （".JText::_( $week_in )."） ".$eventEndDate."$in_time[0]:$in_time[1]~$end_time[0]:$end_time[1]";
		}
		$vip_end_time	= "$vipin_date[0]年$vipin_date[1]月$vipin_date[2](".JText::_( $week_in ).") $vipend_time[0]:$vipend_time[1]";
		$vip_code_md2	= $vip_code_m.' '.$vipin_date[2].' '."$vipend_time[0]:$vipend_time[1]"; //使用vip 報名結束時間

		/** 英文日期拼湊 **/
		if( $eventD->dates == $eventD->enddates or $eventD->enddates==''){
		//一天的活動
			$eventtime_english = "$in_time[0]:$in_time[1]~$end_time[0]:$end_time[1] on ".$week_inEn.', '.date('M', strtotime($eventD->dates)).' '.$in_date[2].", $in_date[0]";
		} else{
		//二天以上的活動
   		// 同月
			if ($in_date[1] == $end_date[1] ){
				$eventtime_english = "$in_time[0]:$in_time[1]~$end_time[0]:$end_time[1] on ".$week_inEn.', '.date('M', strtotime($eventD->dates)).' '.$in_date[2].' - '.$end_date[2].", $in_date[0]";
			}else{
  		// 不同月 
				$eventtime_english = "$in_time[0]:$in_time[1]~$end_time[0]:$end_time[1] on ".$week_inEn.', '.date('M', strtotime($eventD->dates)).' '.$in_date[2].' - '.date('M', strtotime($eventD->enddates)).' '.$end_date[2].", $in_date[0]";
   		//不同月 不同年
				if ($in_date[0] != $end_date[0] ){
					$eventtime_english = "$in_time[0]:$in_time[1]~$end_time[0]:$end_time[1] on ".$week_inEn.', '.date('M', strtotime($eventD->dates)).' '.$in_date[2].', '.$in_date[0].' - '.date('M', strtotime($eventD->enddates)).' '.$end_date[2].", $end_date[0]";
				}
			}
 		}

		//抓取信件內容
		if($tr_lang != 'parallel'){
			$sql_mail = "SELECT * ".
						"FROM #__eventlist_mail ".
						"WHERE id = ".$mailid;
			$db->setQuery($sql_mail);
			$mail = $db->loadObject();
			$mail_message = $mail->message;
		}else{
			$sql_mail = "SELECT * ".
						"FROM #__eventlist_mail ".
						"WHERE id = ".$mailid;
			$db->setQuery($sql_mail);
			$mail = $db->loadObject();
			$mail_message = $mail->message;
			$mailid_en = 0;
			if( $mailid == $elsettings->mail_approved && $elsettings->mail_approved_EN != 0 ){$mailid_en = $elsettings->mail_approved_EN;}//通過審核
			if( $mailid == $elsettings->mail_rejected && $elsettings->mail_rejected_EN != 0 ){$mailid_en = $elsettings->mail_rejected_EN;}//未通過審核
			if( $mailid == $elsettings->audit_notice && $elsettings->audit_notice_EN != 0 ){$mailid_en = $elsettings->audit_notice_EN;}//等待審核
			if( $mailid == $elsettings->mail_join && $elsettings->mail_join_EN != 0 ){$mailid_en = $elsettings->mail_join_EN;}//報名成功
			if( $mailid == $elsettings->mail_cancel && $elsettings->mail_cancel_EN != 0 ){$mailid_en = $elsettings->mail_cancel_EN;}//報名失敗
			if( $mailid == $elsettings->mail_candidate && $elsettings->mail_candidate_EN != 0 ){$mailid_en = $elsettings->mail_candidate_EN;}//候補
			if( $mailid == $elsettings->touser_vipmail && $elsettings->touser_vipmail_EN != 0 ){$mailid_en = $elsettings->touser_vipmail_EN;}//邀請信

			if( $mailid_en !=0 ){
				$sql_mail = "SELECT * ".
							"FROM #__eventlist_mail ".
							"WHERE id = ".$mailid_en;
				$db->setQuery($sql_mail);
				$mail = $db->loadObject();
				if($mail->message!=''){
					$mail_message_en = $mail->message;
					$mail_message_en .= "<br>-------------------------------------------------------------------------------------------------------<br>";
					$mail_message = $mail_message_en.$mail_message;
				}
			}
		}

		//抓取USER
		$sql_urD =  " SELECT * ".
         			" FROM #__eventlist_reg_user ".
         			" WHERE reg_id = ".$eventid.
         			" AND u_email = '".$usermail."'";
		$db->setQuery($sql_urD);
		$user_D = $db->loadObject();
	
		$url = & JURI::getInstance();

		//event 地址
		$sql_address =	"SELECT * ".
						"FROM #__eventlist_venues ".
						"WHERE id = '$eventD->locid'";
		$db->setQuery($sql_address);
		$address_data = $db->loadObject(); 
		$venue_put = "<a href='".$url->root().JRoute::_("activities/venueevents/$address_data->id")."'>".$address_data->venue."</a>";
		
		$venue_putEn = ELOutput::jf_Tr($eventD->locid,'eventlist_venues');
		if($venue_putEn['venue']!=NULL){
			$venue_put_en = "<a href='".$url->root().JRoute::_("en/activities/venueevents/$address_data->id")."'>".$venue_putEn['venue']."</a>";
		}
		
		$titleEn = ELOutput::jf_Tr($eventD->id,'eventlist_events');
		if($titleEn['title']!=NULL){
			$title_en = $titleEn['title'];
		}

		
		$sql_adm_data = "SELECT * ".
						"FROM #__comprofiler ".
						"WHERE user_id = ".$eventD->contact;
		$db->setQuery($sql_adm_data);
		$adm_data = $db->loadObject();	
	
		$user =& JFactory::getUser($eventD->contact);
		$admin_name = $user->name;
		$admin_mail = $user->email;
		$ed_name = $admin_name;
		$ed_name = ereg_replace('-',' ', $ed_name);
		$ed_name = trim($ed_name);

	  $page_en 	= "<a href='".$url->root().JRoute::_("en/activities/details/$eventid")."'>".$url->root().JRoute::_("en/activities/details/$eventid")."</a>";
		$cancel_link_en = "<a href='".$url->root().JRoute::_("activities/details/$eventid")."#cancel'>here</a>";
	  $page_zh 	= "<a href='".$url->root().JRoute::_("tw/activities/details/$eventid")."'>".$url->root().JRoute::_("tw/activities/details/$eventid")."</a>";
		$cancel_link_zh = "<a href='".$url->root().JRoute::_("activities/details/$eventid")."#cancel'>取消報名</a>";

		$mail_message= str_replace(",",",\r\n",$mail_message);	
		$mail_message= str_replace("，", "，\r\n",$mail_message);	

		$mail_value = ereg_replace("{EVENT}",$eventD->title, $mail_message);//更換title
		$mail_value = ereg_replace("{EVENT_EN}",$title_en, $mail_value);//更換title
		$mail_value = ereg_replace("{USER}", $user_D->u_name, $mail_value);//更換user name
		$mail_value = ereg_replace("{EVENT_ADDRESS}",$venue_put, $mail_value);//更換地址
		$mail_value = ereg_replace("{EVENT_ADDRESS_EN}",$venue_put_en, $mail_value);//更換地址
		$mail_value = ereg_replace("{EVENT_PAGE_EN}",$page_en, $mail_value);//更換頁面
		$mail_value = ereg_replace("{EVENT_PAGE_ZH}",$page_zh, $mail_value);//更換頁面
		$mail_value = ereg_replace("{EVENT_CANCEL_EN}",$cancel_link_en, $mail_value);
		$mail_value = ereg_replace("{EVENT_CANCEL_ZH}",$cancel_link_zh, $mail_value);

		$mail_value = ereg_replace("{EVENT_TIME_ZH}",$event_time_zh, $mail_value);//更換time
		$mail_value = ereg_replace("{ADMIN_PHONE}", $adm_data->cb_tel, $mail_value);
		$mail_value = ereg_replace("{EVENT_ADMIN}",$ed_name, $mail_value);//更換event聯絡人
		$mail_value = ereg_replace("{ADMIN_EMAIL}",$admin_mail, $mail_value);
		$mail_value = ereg_replace("{EVENT_REG_ZH}", "Chinese", $mail_value);
		$mail_value = ereg_replace("{EVENT_REG_EN}", "English", $mail_value);
		$mail_value = ereg_replace("{EVENT_DATE}", $eventD->dates, $mail_value);
		$mail_value = ereg_replace("{EVENT_END_DATE}", $eventD->enddates, $mail_value);
		$mail_value = ereg_replace("{EVENT_TIME_EN}", $eventtime_english, $mail_value);//更換time(英文)
		$mail_value = ereg_replace("{EVENT_VIP_MD}", $vip_md, $mail_value);//更換vip時間 ex:Jan 10
		$mail_value = ereg_replace("{EVENT_VIP_MD2}", $vip_code_md2, $mail_value);//更換vip時間 ex: January 14 to 14
		$mail_value = ereg_replace("{VIP_END_TIME}", $vip_end_time, $mail_value);//更換vip end time

		$mail_value = ereg_replace("{SIGNUP_ID}",$user_D->reg_sn, $mail_value);//報名序號
		$mail_value = ereg_replace("{EVENT_WAITING}", $user_D->waiting , $mail_value);//更換候補
		$mail_value = ereg_replace("{NEW_NAME}",$user_D->u_name, $mail_value);//使用者姓名
		$mail_value = ereg_replace("{NEW_COMPANY}", $user_D->u_company, $mail_value);
		$mail_value = ereg_replace("{NEW_CAPTAINCY}", $user_D->u_captaincy, $mail_value);
		//Fix mail content to large  show ! bug
		$mail_value = str_replace(" "," \r\n",$mail_value);
		$mail_value= str_replace(",",",\r\n",$mail_value);
		$mail_value = str_replace( "，", "，\r\n", $mail_value);

		return $mail_value;
	}

	/*
	 替換信件標題內容 
	*/
	function mailT_replace( $eventid, $mailid, $usermail, $set_long)
	{
		$setting_where[] = " id = 1 ";
		$elsettings = ELOutput::search_data( $setting_where, 'settings', '' );
		
		$db = JFactory::getDBO();
		//抓取活動
		$sql_ev = 	"SELECT * ".
         			"FROM #__eventlist_events ".
         			"WHERE id = ".$eventid;
		$db->setQuery($sql_ev);
		$eventD = $db->loadObject();
		
		if($set_lang != '' ){
			$tr_lang = $set_lang;
		}else{
			$tr_lang = $eventD->reg_msg;
		}

	 	if($tr_lang == 'en' || $tr_lang == 'parallel' ){
			if( $mailid == $elsettings->mail_approved && $elsettings->mail_approved_EN != 0 ){$mailid = $elsettings->mail_approved_EN;}//通過審核
			if( $mailid == $elsettings->mail_rejected && $elsettings->mail_rejected_EN != 0 ){$mailid = $elsettings->mail_rejected_EN;}//未通過審核
			if( $mailid == $elsettings->audit_notice && $elsettings->audit_notice_EN != 0 ){$mailid = $elsettings->audit_notice_EN;}//等待審核
			if( $mailid == $elsettings->mail_join && $elsettings->mail_join_EN != 0 ){$mailid = $elsettings->mail_join_EN;}//報名成功
			if( $mailid == $elsettings->mail_cancel && $elsettings->mail_cancel_EN != 0 ){$mailid = $elsettings->mail_cancel_EN;}//報名失敗
			if( $mailid == $elsettings->mail_candidate && $elsettings->mail_candidate_EN != 0 ){$mailid = $elsettings->mail_candidate_EN;}//候補
			if( $mailid == $elsettings->touser_vipmail && $elsettings->touser_vipmail_EN != 0 ){$mailid = $elsettings->touser_vipmail_EN;}//邀請信
		}

		$check_where[] = " id = $mailid ";
		$mail = ELOutput::search_data( $check_where, 'mail', '' );
		unset($check_where);
		
		//抓取USER
		$check_where[] = " reg_id = $eventid ";
		$check_where[] = "  u_email = '$usermail' ";
		$user_D = ELOutput::search_data( $check_where, 'reg_user', '' );
		unset($check_where);
			
		$event_title = 	$eventD->title;

		$title_putEn = ELOutput::jf_Tr($eventD->id,'eventlist_events');

		if($title_putEn['title'] != NULL){
			$eventTitlen = $title_putEn['title'];
		}else{
			$eventTitlen = $eventD->title;
		}
		
		$mail_kind = ereg_replace("{EVENT}",$event_title, $mail->kind);//更換title
		$mail_kind = ereg_replace("{EVENT_EN}",$eventTitlen, $mail_kind);//更換title
		$mail_kind = ereg_replace("{USER}", $user_D->u_name, $mail_kind);//更換user name
		$mail_kind = ereg_replace("{EVENT_DATE}", $eventD->dates, $mail_kind);
		$mail_kind = ereg_replace("{SIGNUP_ID}",$user_D->reg_sn, $mail_kind);//報名序號

		//Fix mail content to large  show ! bug
		$mail_kind = str_replace(" "," \r\n",$mail_kind);
		$mail_kind = str_replace(",",",\r\n",$mail_kind);
		$mail_kind = str_replace( "，", "，\r\n", $mail_kind);
		
		return $mail_kind;
	}
	
	/*
	 顯示活動圖示 
	 */
	function link_icon( $data, $image )
	{
		$settings = & ELHelper::config();
		
		$db = JFactory::getDBO();
		$image_sql ="SELECT * ".
         			"FROM #__eventlist_events ".
         			"WHERE id = ".$data->did;
		$db->setQuery($image_sql);
		$image_info = $db->loadObject();

		if( $image_info->link_switch == 1 ){
			$url	= $image_info->image_link;
			$icon	= '<img class="modal" src="'.$this->baseurl.'/'.$image['original'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$info.'" />';
			$output = '<a href="'.$image_info->image_link.'" >'.$icon.'</a>';
		}else{
			$output	= '<img class="modal" src="'.$this->baseurl.'/'.$image['original'].'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'.$info.'" />';
		}
		
		if( $image['original'] != '' ){
			return $output;
		}
		
	}
				
	/*
	 * 生成管理者列表
	 * 由editevent使用
	 */
	function member_list( $value, $g_id, $putname )
	{
		
		$db = JFactory::getDBO();
		$query = 'SELECT member '
				. ' FROM #__eventlist_groupmembers'
				. ' WHERE group_id =  '.$g_id;
					;
		$db->setQuery($query);
		$CL = $db->loadObjectlist();
					
		$list_array = array();
		foreach( $CL as $list_index ){
		  $list_array[]= "'".$list_index->member."'";
		}	
		
		$list_member = implode( ",", $list_array );

		$query = "SELECT * ".
				 "FROM #__users ".
				 "WHERE id IN($list_member)";
		$db->setQuery($query);
		$member_id = $db->loadObjectlist();

		$put_list = array();
		$put_list[] = JHTML::_('select.option', 0 , "--".JText::_( 'PLEAST CHOOSE' )."--");

		foreach($member_id as $list){
			$put_list[] = JHTML::_('select.option', $list->id , JText::_( $list->name ));
		}
					
		$output = JHTML::_('select.genericlist', $put_list, $putname, 'size="1" class="inputbox" "', 'value', 'text', $value );
		
		return $output;
	}
	
	/*
	 * 轉換語系 (依靠joomfish)
	 */
	function jf_Tr($v_id,$table){
		
		$db = JFactory::getDBO();
		$query =  ' SELECT * '
				. ' FROM #__jf_content '
				. ' WHERE reference_id = '.$v_id
				. ' AND	reference_table = "'.$table.'"'
				. ' AND published = 1';
		$db->setQuery($query);
		$db->Query();
		$En = $db->loadObjectlist();
		$valueTr = array();
		
		foreach($En as $value){
			$valueTr[$value->reference_field] = $value->value;
		}
		return $valueTr;
	}
	
	/*
	 * 替換講者
	 * 由後台controllers/events.php
	 * 於儲存活動資料時使用
	 */
	function sp_info($speak){
		
		$speak_ids = "$speak";
		$sp_list = explode(',',$speak_ids);
		
		$db = JFactory::getDBO();
		
		$sp_data = '';
		$sp_data .= "<!--system_speak--><div class=\"speaker-workshop\">";
		$sp_data .= "<h3><strong>".JText::_('SPEAK INFO')."</strong></h3>";
		
		for($i=0;$i<count($sp_list);$i++){
			
			//尋找資料
			$data_sql = 'SELECT a.*, b.* '.
						'FROM #__comprofiler AS a, #__users AS b '. 
						'WHERE a.user_id ='.$sp_list[$i].' AND b.id='.$sp_list[$i];
			$db->setQuery($data_sql);
			$db->Query();
			$data_result = $db->loadObject();

			//圖片
			$user_image = GetImageSize("http://www.openfoundry.org/sso/user/image");
			$default_image = GetImageSize("http://www.openfoundry.org/sso/user/image?name=$data_result->username");

			if(count(array_diff_assoc($user_image,$default_image)) != 0){
				$sp_data .= "<img border=\"0\" style=\"border: 0; 
							float: right; margin: 10px;\" 
							src=\"http://www.openfoundry.org/sso/user/image?name=$data_result->username\" width=90 height=90>";
			}
			
			if($data_result->username !=''){
				$userStr = $data_result->username;
				if($userStr[0]=='!'){
					$userStr = substr($userStr,1);
				}
				$user_link = "<a href='http://www.openfoundry.org/community/userprofile/$data_result->username'>$userStr</a>";

				unset($blog_data);
				unset($blog_link);
				
				//blog欄位
				if($data_result->cb_blog!=''){
					$blog_data = explode('|*|',$data_result->cb_blog);
					if( strpos($blog_data[0],'http://') == null || strpos($blog_data[0],'http://') != 0){
						if( $blog_data[0] != null ){$blog_data[0] = 'http://'.$blog_data[0];}
					}
					if( $blog_data[0] != '' &&  $blog_data[1] == '' ){
						$blog_link = "<a href='$blog_data[0]'>$blog_data[0]</a>";
					}else if($blog_data[0] !='' && $blog_data[0] !=''){
						$blog_link = "<a href='$blog_data[0]'>$blog_data[1]</a>";
					}
				}
				
				$sp_data .=	"<h4><strong class=\"moduletable-hilite2\">$user_link</strong></h4>";
				
				//about欄位
				if($data_result->cb_aboutme=='' && count(array_diff_assoc($user_image,$default_image)) != 0){
					$sp_data .= "</br></br>";
				}else{
					$sp_data .= "$data_result->cb_aboutme";
					if(strlen($data_result->cb_aboutme)<105 && count(array_diff_assoc($user_image,$default_image)) != 0){
						$sp_data .= "</br></br></br>";
					}
				}
				
				$sp_data .= "<ul>";
				$sp_data .= 	"<li>".JText::_('SKILL')."：$data_result->cb_itskills</li>";
				if($blog_link){$sp_data .= 	"<li>".JText::_('BLOG')."：$blog_link</li>";}
				$sp_data .= "</ul>";
				
				if( $i+1 != count($sp_list) ){
					$sp_data .= "<hr style=\"border: 0pt none; height: 1px; background-color: #d4d4d4;\">";
				}
			}

			//空白資料欄位
			if($sp_list[$i] == 0){
				$user_link = "speak name"; 
				$sp_data .=	"<h4><strong class=\"moduletable-hilite2\">$user_link</strong></h4>";
				$sp_data .= "about me";
				$sp_data .= "<ul>";
				$sp_data .= 	"<li>".JText::_('SKILL')."：</li>";
				$sp_data .= 	"<li>".JText::_('BLOG')."：</li>";
				$sp_data .= "</ul>";
				if( $i+1 != count($sp_list) ){$sp_data .= "<hr style=\"border: 0pt none; height: 1px; background-color: #d4d4d4;\">";}
			}
		}
		
		$sp_data .= "</div><!--system_speak_end-->";
		return $sp_data;
	}
	
	/*
	 * 尋找資料簡易函式 
	 */
	function search_data( $field, $table, $order ){
		
		$where = implode(' AND ',$field);

		$db = JFactory::getDBO();
		
		$event_sql =" SELECT * ".
					" FROM #__eventlist_".$table;

		if($where!=''){
			$event_sql = $event_sql.' WHERE '.$where;
		}
		if($order!=''){
			$event_sql = $event_sql.' '.$order;
		}
		
		$db->setQuery($event_sql);
		$event_info = $db->loadObject();
		
		return $event_info;	
	}

	/*
	 * 尋找資料簡易函式2 附上資料數量
	 */
	function search_dataRow( $field, $table, $order ){
		
		$where = implode(' AND ',$field);

		$db = JFactory::getDBO();
		
		$event_sql =" SELECT * ".
					" FROM #__eventlist_".$table;

		if($where!=''){
			$event_sql = $event_sql.' WHERE '.$where;
		}
		if($order!=''){
			$event_sql = $event_sql.' '.$order;
		}

		$db->setQuery($event_sql);
		$event_info = $db->loadObjectList();
		$db->query();
		$event_row = $db->getNumRows();
		
		$data_array = array();
		$data_array['info'] = $event_info;
		$data_array['row'] = $event_row;
	
		return $data_array;	

	}
	
	/*
	 * 確認黑名單 
	 */
	function check_black($mail){
		
		$db = JFactory::getDBO();
		$search_black = "SELECT * ".
						"FROM #__eventlist_reg_user ".
						"WHERE u_email = '".$mail."' AND black = 'y'";
		$db->setQuery($search_black);
		$db->Query();
		$black_num = $db->getNumRows();
		$black_state = $db->loadObjectList();

		foreach($black_state as $event_s){
			$event_id[] = $event_s->reg_id;
		}

		if($event_id!=NULL){
			$event_impId = implode( ' , ', $event_id );
			$search_event_name ="SELECT * ".
								"FROM #__eventlist_events ".
								"WHERE id IN($event_impId)";
			$db->setQuery($search_event_name);
			$event_name = $db->loadObjectList();
		
			foreach($event_name as $event_n){
				$black_event[] = $event_n->title;
			}
		
			$black_event_n = implode( ' , ', $black_event );
			$notice =  JText::_('NOTICE1').' '.$black_event_n.' '.JText::_('NOTICE2');
		}
		
		return $notice;
	}
	
	/*
	 * 編輯報名序號
	 */
	function edit_sn($event){
	//編輯reg_sn
		$db = JFactory::getDBO();
		$sn_sql =	"SELECT reg_sn ".
					"FROM #__eventlist_reg_user ".
					"WHERE reg_id = $event ".
					"GROUP BY reg_sn DESC ";
		$db->setQuery($sn_sql);
		$db->Query();
		$sn_get = $db->loadObject();

		if($sn_get->reg_sn == ''){
			$reg_num = '0001';
		}else{
			(int)$reg_num = $sn_get->reg_sn;
			$reg_num = $sn_get->reg_sn + 1;
			//補零
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
		}	

		return $reg_num;
	}
	
	/*
	 * 檢查使用者mail是否整合過
	 */
	function check_merger($u_email){
		$db = JFactory::getDBO();
		$user_sql=" SELECT * ".
						" FROM #__users  ".
						" WHERE email = '".$u_email."'";
		$db->setQuery($user_sql);
		$data_info = $db->loadObject();

		if( $data_info->username[0] == '!' ){
			$msg  = JText::_('CONFORM MSG1');
			$msg .= " $data_info->email "; 
			$msg .= JText::_('CONFORM MSG2');
			$msg .= "<a href='/sso/user/login'> ".JText::_('CONFORM MSG3')." </a>";
			$msg .= JText::_('CONFORM MSG4');
		}
		
		return $msg;
	}
	
}

?>

