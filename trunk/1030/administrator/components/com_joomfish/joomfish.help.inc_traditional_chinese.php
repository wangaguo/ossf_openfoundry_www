<?php
/**
 * Joom!Fish - multilingual extention and translation manager for Joomla!
 * Copyright (C) 2003-2006 Think Network GmbH, Munich
 * 
 * All rights reserved.  The Joom!Fish project is a set of extentions for 
 * the content management system Joomla!. It enables Joomla! 
 * to manage multilingual sites especially in all dynamic information 
 * which are stored in the database.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU Lesser General Public License" (LGPL) is available at
 * http: *www.gnu.org/copyleft/lgpl.html
 * -----------------------------------------------------------------------------
 * $Id: ReadMe,v 1.2 2005/03/15 11:07:01 akede Exp $
 *
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_joomfish_help {

	function showWelcome() {
		global $act, $task, $option, $mosConfig_live_site, $mosConfig_absolute_path;
		HTML_joomfish::_JoomlaHeader( _JOOMFISH_TITLE. ' '._JOOMFISH_CREDITS, 'credits', false );
    ?>
	<tr align="center" valign="middle">
      <td align="left" valign="top" width="70%">
		<p>
      	<span class="moduleheading">歡迎使用 Joom!Fish</span></p>
      	
        <strong>Joom!Fish - 翻譯? 多國語言內容管理 - 您到底在胡捻些什麼? 這是什麼玩意兒"魚"?</strong>
		<p>Ok, 有一件事可以肯定! <b>這不是屬於自動化的翻譯工具, 像是外面一些公司所提供的!</b> 他們只是借用這個名詞!</p>
		<p>但是你總聽過 Ford Perfect , 是吧?<br />
		<strong>不會吧!</strong><br />
		&nbsp;<br />
		嗚, 你嘛幫幫忙 - 人生真的是有這樣困難嗎?<br />
		說真的 ... - 沒錯! <br />
		&nbsp;<br />
		<strong>但是現在呢? ...</strong><br />
		你最好可以這樣做: <a href="http://www.amazon.de/exec/obidos/ASIN/0345391802/thinknetwork-21" target="_blank">來這裡看看</a> - 多看看書吧! 瞭解嘛!<br />
		&nbsp;<br />
		動作要快, 要不然通往銀河的路都做好那就太遲了 ;-)</p>
		<p>
		<strong>對, 這是當然!</strong><br />
		聰明, 您在宇宙盡頭的餐廳預約的位置已經訂好了.<br />
		你想要 <a href="index2.php?option=com_joomfish&act=dinnermenu">看看菜單嗎</a>?<br />
		&nbsp;<br />
		我很榮幸的能在這裡為您服務.<br>
		
		<p>
		<span class="moduleheading">特別說明</span><br />
		如果有人還搞不懂我到底在說些什麼. 你還真的需要去多看些書!<br />
		<br />
		我在這裡要感謝所有 MambelFish 以及 Joom!Fish 的開發團隊, 你們針對 Joomla! 所開發的工具具有的重大意義. <br />
		請不要客氣. 歡迎你們的意見與建議, 來讓這條"魚"變得更好
		</p>
		<p>
		感謝 Joom!Fish 的研發團隊, 所有的參予者以及 Tommy 設計這麼可愛地"魚".
		&nbsp;<br />
		Alex</p>
		</p>
		</td>
		<td align="left" valign="top" nowrap>
			<?php HTML_joomfish::_sideMenu();?>
			<?php HTML_joomfish::_creditsCopyright(); ?>
		</td>
	<?php
		HTML_joomfish::_footer($act, $option);
  }		
	
	
	function showDinnermenu() {
		global $act, $task, $option, $mosConfig_live_site;
		HTML_joomfish::_JoomlaHeader( _JOOMFISH_TITLE. ' ' ._JOOMFISH_ADMIN_HELP, 'support', false );
    ?>
	<tr align="center" valign="middle">
      <td align="left" valign="top" width="70%">
		<h2>我們該從何著手?</h2>
	   <p>您曾經捫心自問若是不使用 Joomla 的架構. 要如何製作多國語言的網站? 使用 Joom!Fish 就是這個問題的答案. <br />
		&nbsp;<br />
		Joom!Fish 元件能夠支援您進行管理您網站中所有內容的翻譯, 甚至是所有的元件以及模組. 這項元件是相當靈活的. <br />
		您可以輕易地加入新的元件之後來翻譯新產生的內容.<br />
		&nbsp;</p>
		
		<h2>我們要如何了解內容?</h2>
		<p>當我們談論到內容, 我所意指的是在於 Joomla 伺服器中所提供存取資料庫中所儲存的任何內容物或是其他資訊. <br />
			有每些文字資訊, 像是一些連結文字, 存放於系統中的廣泛地語言檔案. 這些檔案可以讓你在網站中輕易地變換 <br />
			不同的語言文字. 但是網站中您所發佈的新聞訊息, 文章或者是其他的內容資料都只是屬於單一的語言, Joom!Fish <br />
			是能夠協助您翻譯這些內容的解決方案 ;-) 以便於您的網站中能夠真正支援多國語系. 每項動態內容我們這裡先 <br />
			稱為元件元素<br />
		&nbsp;</p>

		<h2>這個元件對您有什麼幫助?</h2>
		我們當初沒有想要製作翻譯機器或者其他電腦為主的翻譯方式. 目標在於翻譯的處理過程, 您將會有更龐大的數 <br />
		據資料庫. 在您建立新的內容資料的同時, 也必須要有人進行翻譯的工作.<br />
		&nbsp;<br />
		而使用 Joom!Fish 的人也能夠檢查所有的內容中有哪些項目還沒有被進行翻譯, 觀看近期改變的項目或管理所翻 <br />
		譯支援的語系. 翻譯內容的人在所能修改翻譯的內容項目可以根據他/她所詮釋更好的表達文字.</p>

		<h2>要如何運作它?</h2>
		<p>相當地簡易. 在元件選單中您可以找到 <a href="index2.php?option=com_joomfish&act=config_component">"元件偏好設定"</a> 來變更顯示的一般設定. 這些是屬於通盤性的執行要件. <br />
		在此設定中主要是讓您定義您的網站中提供哪些國家的語言翻譯. 您可以從清單中選擇.</p>

		<p>而緊接下來的部份就較為困難了. 您必須從資料庫中不同的內容元素目錄各別去定義各個內容資料, 這就是我們 <br />
			 不打算在管理區去執行這項設定的原因. 您可以進到管理區的 <a href="index2.php?option=com_joomfish&act=config_elements">"內容元素"</a> 來檢視所有安裝內容元素的定義. 這些 <br />
			 內容元素定義的 XML 檔案都存放在 /administraton/components/com_joomfish/contentelements/ 目錄夾當中. <br />
			 <br />
			 如果您想要自行去增加新的內容元素或者修改現有的 XML 檔案當中的內容, 我想這應該不難去定義. 主要就在於 <br />
			 您自己, 從 XML 檔案中去找尋可行的正確指引欄位 ;-) <br />
		&nbsp;<br />
			 如果您新增一項新的 XML 檔案來針對尚未執行的元件/模組, 請確定您同樣地也編輯元件/模組的PHP檔案.</p>
		
		<p>關於翻譯內容, 您必需透過 <a href="index2.php?option=com_joomfish&act=translate">"內容翻譯"</a> 單元. 您可以找到關於資料庫中所指定的內容元素列表. 選取特定的內容 <br />
			 元素之後您就可以檢視資料庫的內容物而輕易地進行翻譯.</p>
		 <p>概略的說明到此, 如果有什麼新的看法與問題 - 再寫信給我<br>
	   &nbsp;<br />
	   Alex</p>		</td>
		<td align="left" valign="top" nowrap>
			<?php HTML_joomfish::_sideMenu();?>
			<?php HTML_joomfish::_creditsCopyright(); ?>
		</td>
	</tr>

<?php
		HTML_joomfish::_footer($act, $option);
  }

  function showMambotWarning(){
		global $act, $task, $option, $mosConfig_live_site, $mosConfig_absolute_path, $_VERSION;
		HTML_joomfish::_header();
		?>
     <td align="left" valign="top">
       <h2 style="color:red">There was a problem with your installation</h2>
       <p>目錄 "<?php echo $mosConfig_absolute_path?>/mambots/system/" 無法進行寫入</p>
       <p>請執行以下動作:</p>
       <ul>
       <li>移除 Joomfish</li>
       <li>修改檔案的存取權限</li>
       <li>重新安裝</li>
       </ul>
       <br/>謝謝.</p>
       </td>
	<?php
		HTML_joomfish::_footer($act, $option);
  	
  }
	function showPostInstall( $success=false ) {
		global $act, $task, $option, $mosConfig_live_site, $mosConfig_absolute_path, $_VERSION;
		HTML_joomfish::_header();
	?>
     <td align="left" valign="top">
       <h2>歡迎使用 JoomFish</h2>
       <p>我們當初沒有想要製作翻譯機器或者其他電腦為主的翻譯方式. 目標在於翻譯的處理過程, 您將會有更龐大的數
       	Joom!Fish 元件能夠提供您設計與建立多國語系的網站. 它在使用上並不輕鬆,也不是一套相當好進行處理的元件 </p>
       	請您仔細地閱讀以下的指示並且進行測試. 往後您如需找尋支援以及更進階的協助可以前往至<a href="http://forge.joomla.org/sf/discussion/do/listForums/projects.joomfish/discussion" target="_blank">http://forge.joomla.org</a>.

        這套 Joom!Fish 目前的版本只能執行 Joomla! Version 1.0.7 以上的系統. 如果您使用的是不同的版本, 請參考 <br />
        相關的網站來取得適合的版本的 Joomla!.</p>
	   <p>
	   	  現在請安裝所有的語系 (並沒有限制) 您可以透過您的網站進行: <a href="index2.php?option=com_installer&element=language">網站 -> 語言管理 -> 新增</a> 的功能來安裝所可 <br />
	   	  以支援的語系. <br />
	   	  在您完成了語系檔的安裝之後您必須啟動該語系並且给予語系的名稱. 您可以前往 (<a href="index2.php?option=com_joomfish&act=config_language">元件 -> Joom!Fish -> Languanges</a>) 進行操作.<br />
	   &nbsp;<br />
	   <b>首先檢查:</b> 當您在網站前台變更網站的語系 (Solarflar [預設] 佈景主題已經修改) 時, 所有的靜態內容應該也 <br />
	   會改變.</p>

	   <h2>要如何翻譯內容?</h2>
	   翻譯的方式相當的簡單. 將來只要有人建立了新的內容資料後, 您將會在翻譯總覽(Joom!Fish -> Translation )中發現 <br />
	   這項新內容. <br />
	   輕鬆翻譯的方式是您可以去定義針對所有內容寫入的標準語系. 然後您再用翻譯模組來針對內容去編輯各式不同的語言.</p>
		 當您點選其中一項內容要進行翻譯時, 您會發現 Joom!Fish 將某些指定的文字欄位提出讓您進行翻譯. 使用該表格進行 <br />
		 翻譯工作完成後也別忘記進行發佈的動作. 完成了整個翻譯動作後您可以從前台前往所進行翻譯的內容觀看成果(當然是 <br />
		 要切換到您所翻譯的語系項目). <br />
	   &nbsp;<br />

	   <h2>What I know</h2>
	   這套版本相當的深遠. 管理區設定中有一小部份的指派已經合乎 Joomla! 的標準 (回存 / 取出回存) 並且作用於前台. <br />
		 &nbsp;<br />
		 主要是在前台的翻譯整合於所有 Joomla! 核心系統的元件以及模組. 由於有幾個 DHTML 的問題, 將在下個版本進行這項 <br />
		 挑戰.
	   &nbsp;</p>
		 目前針對下一個版本已經有一些新的創意, 例如, 包含: :
		 <ul>
		 	<li>當原始的內容改變後將自動通知</li>
		 </ul>
	   	 還有什麼問題嗎? 請前往<a href="http://www.joomfish.net" target="_blank">viewProject/projects.joomfish</a>來發表您的看法以及意見.
	   	 Joom!Fish 將會進行追蹤或公開的論壇.
		 
	   <p>感謝您體驗這個元件所帶來的挑戰<br>
		 &nbsp;<br />
		 Alex</p>
	   </td>
		<td align="left" valign="top" nowrap>
			<?php HTML_joomfish::_sideMenu();?>
			<?php HTML_joomfish::_creditsCopyright(); ?>
		</td>
<?php
		HTML_joomfish::_footer($act, $option);
  }
}
?>
