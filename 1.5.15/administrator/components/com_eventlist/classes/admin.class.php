<?php
/**
 * @version 1.0 $Id: admin.class.php 958 2009-02-02 17:23:05Z julienv $
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
 * Holds helpfull administration related stuff
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class ELAdmin {

	/**
	* Writes footer. Do not remove!
	*
	* @since 0.9
	*/
	function footer( )
	{
		//echo 'EventList by <a href="http://www.schlu.net" target="_blank">schlu.net</a>';
	}

	function config()
	{
		$db =& JFactory::getDBO();

		$sql = 'SELECT * FROM #__eventlist_settings WHERE id = 1';
		$db->setQuery($sql);
		$config = $db->loadObject();

		return $config;
	}
	
	/*
	新增活動時的預設內容
	*/
	function Default_value( )
	{
	$Default = "<!--警告標語-->
<div class=\"alert\"><div class=\"typo-icon\">本活動尚未開放、請勿報名，未開放報名前的任何報名都將被視為無效。</div></div>
<!--下載/影片/問卷-->
<!--
<div class=\"media\"><div class=\"typo-icon\"><strong>感謝各界先進的參與，本活動已圓滿結束，如有任何問題歡迎跟活動連絡人連繫。<br />簡報檔案<br />活動花絮<br>
<strong>活動錄影檔案</strong> <br>Session1 -<br /> Session2 -<br />Session3 - </span></div></div>
<div class=\"notice\"><div class=\"typo-icon\">本活動 OSSF 為協助舉辦，主辦單位是XXX ，如有關於活動上的問題，請直接聯絡XXX </div></div>
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
<!--講者介紹  Start-->
<div class=\"speaker-workshop\">
<h3><strong><strong>講者簡介</strong></strong></h3>
<h4><strong class=\"moduletable-hilite2\">講者姓名</strong></h4>
這裡填寫介紹
<ul>
<li>主要專長：</li>
<li>聯絡方式：</li>
</ul>
</div>
<!--講者介紹  END--> <!--注意事項  Start-->
<div class=\"info-workshop\">
<h3><strong>注意事項</strong></h3>
<ul>
<li>報名時請務必填寫 正確 可以聯絡到您的 E-Mail 以利候補作業或課程變動等通知。</li>
<li>本次課程由於座位有限，若您報名後因故不克前來參加，請您務必於開課前三天 到此取消報名！</li>
<li>您的報名資料將只用於本次及未來的工作坊活動宣傳及問卷，不會傳遞給任何第三者。</li>
<li>主辦單位保留更改活動內容及相關事項之權利。</li>
</ul>
</div>
<!--注意事項  END--> 
<!--參考資料  Start-->
<div class=\"references-workshop\">
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
	toolbar功能自定義圖片
	在toolbar新增的圖示皆透過這個函式 來顯示圖示以及功能
	*/
	function myicon($fun_name, $function, $pic){

		$bar = JToolBar::getInstance('toolbar');
	
		$options = array(
			'width' 	=> 760,
			'height'	=> 540,
			'modal'		=> true
		);

		$pic_r	=JURI::base()."components/com_eventlist/assets/images/".$pic;
		$html		= "<td class=button>
						<a href=\"#\" onclick=\"javascript: submitbutton('".
						$function."')\" class=\"toolbar\" >
						<span><img src=".$pic_r." /></span>
						".$fun_name."
						</a>
						</td>";

		return	$bar->appendButton('Custom', $html, 'config');
				
	}
	
	/*
	開啟新視窗 並輸出文件
	/view/reguser/view.html.php 使用
	*/
	function window2html($fun_name, $function, $pic){

		$bar = JToolBar::getInstance('toolbar');
	
		$options = array(
			'width' 	=> 760,
			'height'	=> 540,
			'modal'		=> true
		);
	
		$url = & JURI::getInstance();

		$pic_r	=JURI::base()."components/com_eventlist/assets/images/".$pic;
		$html		= "<td class=button>
							<a href='".$url->root()."administrator/index.php?option=com_eventlist&view=reguser&output=odt2html'  class=\"toolbar\" target=_blank>
							<span><img src=".$pic_r." /></span>
							".$fun_name."
							</a>
						</td>";

		return	$bar->appendButton('Custom', $html, 'config');
				
	}
	
	/*
	開啟新視窗 並輸出問卷圓餅圖
	/view/reguser/view.html.php 使用
	*/
	function window2chart($fun_name, $id){

		$bar = JToolBar::getInstance('toolbar');
	
		$options = array(
			'width' 	=> 760,
			'height'	=> 540,
			'modal'		=> true
		);
	
		$url = & JURI::getInstance();
		$pic_r	=JURI::base()."components/com_eventlist/assets/images/icon-32-chart.png";

		$db = JFactory::getDBO();
		$survey_sql =	" SELECT * ".
						" FROM #__eventlist_reg_user ".
						" WHERE reg_id = ".$id.
						" AND reg_audit != 0 ";
        $db->setQuery($survey_sql);
		$db->Query();
		$survey_num = $db->loadObjectList();
		$survey_array = array();
		foreach($survey_num as $survey){
			$survey_array[] = $survey->survey;
		}

        $calculate = array_count_values($survey_array);
       	if(!$calculate[1]){$calculate[1]=0;}
		if(!$calculate[2]){$calculate[2]=0;}
		if(!$calculate[3]){$calculate[3]=0;}
		if(!$calculate[4]){$calculate[4]=0;}
		if(!$calculate[5]){$calculate[5]=0;}
		if(!$calculate[6]){$calculate[6]=0;}
		$calculate_list = $calculate[1].','.$calculate[2].','.$calculate[3].','.$calculate[4].','.$calculate[5].','.$calculate[6];

		$html	= "<td class=button>
						<a href='http://chart.apis.google.com/chart?cht=p3
							&chs=450x200
							&chd=t:$calculate_list
							&chdl=".JText::_('INTIVE LETTER').":$calculate[1]
								|".JText::_('FRIEND OR COLLEAGUE').":$calculate[2]
								|".JText::_('OSSF NEWS PAPER').":$calculate[3]
								|".JText::_('OSSF RSS').":$calculate[4]
								|".JText::_('OSSF NEWS').":$calculate[5]
								|".JText::_('SURVEY ORDER').":$calculate[6]
							&chco=0000ff,ff0000,00ff00,fff000,00ffff,ff00ff'  class=\"toolbar\" target=_blank>
							<span><img src='$pic_r' /></span>
							".$fun_name."
						</a>
					</td>";

		return	$bar->appendButton('Custom', $html, 'config');
				
	}
}

?>
