<?php
/**
 * Joom!Fish - Multi Lingual extention and translation manager for Joomla!
 * Copyright (C) 2003-2006 Think Network GmbH, Munich
 * 
 * All rights reserved.  The Joom!Fish project is a set of extentions for 
 * the content management system Joomla!. It enables Joomla! 
 * to manage multi lingual sites especially in all dynamic information 
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
// JCE chinese translator: http://www.ncc.com.tw Ncc software - AlienChen

/**
* @package joomfish.language
* @copyright 2003-2006 Think Network GmbH
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @version 1.0, 2003-10-16 $Revision: 1.4 $
* @author Alex Kempkens <JoomFish@ThinkNetwork.com>
*/

if( !defined( '_JF_LANG_INCLUDED') ) {	

// @Add By AlienChen Start
define('_JOOMLAFISH_PREAMBLE', '前言');
define('_JOOMLAFISH_PREAMBLEDESC', 'The JoomFish is an extention for the open source CMS Joomla!.<br />
		Joomla! is Copyright (C) 2005 Open Source Matters. All rights reserved.<br />
		license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php<br />
		Joomla! is free software. This version may have been modified pursuant<br />
		to the GNU General Public License, and as distributed it includes or<br />
		is derivative of works licensed under the GNU General Public License or<br />
		other free or open source software licenses.<br />
		See /COPYRIGHT.php for copyright notices and details.<br />
		&nbsp;<br />
		Within this license the "product" refers to the name "Joom!Fish" or "Mambel Fish".<br />
		Also the term "Joom!Fish - Joomla! Babel Fish" must not be used by any derived software.');
define('_JOOMFISH_RELATED_TOPICS','相關主題');
define('_JOOMFISH_HELP','Joom!Fish 對於網站的協助, 後記');
define('_JOOMFISH_MENU_DOC','協助 & 如何使用 (使用說明)');
define('_JOOMFISH_DOCANDTUTORY','說明 & 線上教學');
define('_JOOMFISH_PROJECT_DOC_SITE','專案說明網站');
define('_JOOMFISH_INSTALLATION','安裝註釋 (讀我檔)');
define('_JOOMFISH_CHANGELOG','修改紀錄');
define('_JOOMFISH_OFFICIAL_PROJECT_WEBSITE','官方網站');
define('_JOOMFISH_OFFICIAL_PROJECT_FORUM','官方討論');
define('_JOOMFISH_BUHTRACKER','臭蟲追蹤');
define('_JOOMFISH_LICENSE','許可證');
define('_JOOMFISH_THINK_NETWORK','針對網路上開放原碼程式許可');
define('_JOOMFISH_ADDITIONAL_SITES','其他網站');
define('_JOOMFISH_README','讀我檔');
define('_JOOMFISH_PRESENT','向所有使用 Joom!Fish 的人! 介紹開發團隊人員');
define('_JOOMFISH_LOGODESIGN','Joom!Fish 商標設計由');
define('_JOOMFISH_SPECIAL_THANKS','特別地感謝協助測試, 提議及翻譯的');
// @Add By AlienChen End

define('_JOOMFISH_TITLE', 'Joom!Fish');															// @since 1.7
define('_JOOMFISH_HEADER','多國語言內容管理');							// @since 1.7

// Control panel
define('_JOOMFISH_ADMIN_FRONTEND', '前台');
define('_JOOMFISH_ADMIN_LANGUAGES', '語言');
define('_JOOMFISH_ADMIN_HELP', '協助 &amp; 如何使用');											// @since 1.7
define('_JOOMFISH_ADMIN_CPANEL', '控制台');														// @since 1.7
define('_JOOMFISH_ADMIN_CHECK', '檢察元件');												// @since 1.7
define('_JOOMFISH_ADMIN_CONFIGURATION', '環境設置');										// @since 1.7
define('_JOOMFISH_ADMIN_CREDITS', '關於 Joom!Fish');													// @since 1.7
define('_JOOMFISH_E_STATE', '狀態');															// @since 1.7
define('_JOOMFISH_ADMIN_COMPONENT_STATE', '元件狀態');									// @since 1.7
define('_JOOMFISH_ADMIN_TRANSLATION_STATE', '翻譯狀態');								// @since 1.7
define('_JOOMFISH_ADMIN_SYSTEM_BOT_STATE', '系統自動化狀態');									// @since 1.7
define('_JOOMFISH_ADMIN_SEARCH_BOT_STATE', '搜尋自動化狀態');									// @since 1.7
define('_JOOMFISH_ADMIN_MODULE_STATE', '模組狀態');											// @since 1.7
define('_JOOMFISH_CMN_PUBLISHED', '<span style="font-weight:bold; color:green">發佈</span>' );											// @since 1.7
define('_JOOMFISH_CMN_UNPUBLISHED', '<span style="font-weight:bold; color:red">停止發佈</span>' );										// @since 1.7
define('_JOOMFISH_ADMIN_MAMBELFISH_INSTALL', 'MambelFish 安裝');																	// @since 1.7
define('_JOOMFISH_ADMIN_INSTAL_UPGRADED', '<span style="font-weight:bold; color:green">舊版安裝升級</span>');					// @since 1.7
define('_JOOMFISH_ADMIN_INSTAL_NOT_UPGRADED', '<span style="font-weight:bold; color:red">舊版安裝沒有升級</span>');			// @since 1.7
define('_JOOMFISH_INSTALL_UPGRADE', '安裝升級');																				// @since 1.7

define('_JOOMFISH_ADMIN_LANGUAGE_TITLE','Joom!Fish 語言管理');							// @since 1.7
define('_JOOMFISH_ADMIN_DEFAULT_LANGUAGE', '網站預設語言:');
define('_JOOMFISH_ADMIN_DEFAULT_LANGUAGE_HELP', '語言的設置在您的 <a href="javascript:submitbutton( \'site_config\' );">全站設定</a>.');

define('_JOOMFISH_ADMIN_SELECT_LANGUAGES', '選擇您的網站所使用的語言.');
define('_JOOMFISH_ADMIN_LANGUAGE', '選擇網站語言:');
define('_JOOMFISH_ADMIN_LANGUAGE_HELP', '請命名以及執行您目前網站中所要使用的語言.<br>名稱將會在前台中顯示.');

define('_JOOMFISH_ADMIN_TITLE_NAME', '名稱');
define('_JOOMFISH_ADMIN_TITLE_AUTHOR', '作者');
define('_JOOMFISH_ADMIN_TITLE_VERSION', '版本');
define('_JOOMFISH_ADMIN_TITLE_DESCRIPTION', '敘述');
define('_JOOMFISH_ADMIN_TITLE_TITLE', '原始標題');
define('_JOOMFISH_ADMIN_TITLE_LANGUAGE', '語言管理');
define('_JOOMFISH_ADMIN_TITLE_TRANSLATION', '內容翻譯管理');
define('_JOOMFISH_ADMIN_TITLE_DATECHANGED', '上次修改');
define('_JOOMFISH_ADMIN_TITLE_STATE', '狀態');
define('_JOOMFISH_ADMIN_TITLE_PUBLISHED', '發佈');
define('_JOOMFISH_ADMIN_TITLE_CONTENTELEMENTS', '檢視內容元素');
define('_JOOMFISH_ADMIN_TITLE_DISPLAY', '顯示數');

define('_JOOMFISH_ADMIN_TITLE_ACTIVE', '執行');
define('_JOOMFISH_ADMIN_TITLE_ISO', 'ISO');
define('_JOOMFISH_ADMIN_TITLE_JOOMLA', 'Joomla 語言名稱');
define('_JOOMFISH_ADMIN_TITLE_IMAGE', '國別旗幟圖示名稱');											//new 1.1
define('_JOOMFISH_ADMIN_TITLE_ORDER', '排序');													//new 1.1

define('_JOOMFISH_ADMIN_ELEMENT_CONFIG', '設置');
define('_JOOMFISH_ADMIN_ELEMENT_REFERENCE', '資料庫數據');
define('_JOOMFISH_ADMIN_ELEMENT_SAMPLES', '資料庫內容');
define('_JOOMFISH_ADMIN_COMMONINFORMATION', '一般資訊');

define('_JOOMFISH_ADMIN_DATABASEINFORMATION', '關於資料表的資訊');
define('_JOOMFISH_ADMIN_DATABASETABLE', '資料表');
define('_JOOMFISH_ADMIN_DATABASETABLE_HELP', '於您的資料庫資料中的範例參考 (不含前綴字!)');

define('_JOOMFISH_ADMIN_DATABASEFIELDS', '資料庫欄位');
define('_JOOMFISH_ADMIN_DATABASEFIELDS_HELP', '相關的欄位定義於您的資料庫中.');
define('_JOOMFISH_ADMIN_DBFIELDNAME', '名稱');
define('_JOOMFISH_ADMIN_DBFIELDTYPE', '類型');
define('_JOOMFISH_ADMIN_DBFIELDLABLE', '欄位');
define('_JOOMFISH_ADMIN_TRANSLATE', '翻譯');

define('_JOOMFISH_SET_DEFAULTTEXT', '設置預設本文');												// new 1.5
define('_JOOMFISH_SET_COMPLETE', '設置完成');														// new 1.5
define('_JOOMFISH_SELECT_LANGUAGES', '所有語言');
define('_JOOMFISH_SELECT_NOTRANSLATION', '未經翻譯');
define('_JOOMFISH_NOTRANSLATIONYET', '(未經翻譯)');
define('_JOOMFISH_SELECT_ELEMENTS', '請選擇');
define('_JOOMFISH_NOELEMENT_SELECTED', '請選擇你所要進行翻譯的內容元素類型.');

define('_JOOMFISH_ORIGINAL', '原始');
define('_JOOMFISH_TRANSLATION', '翻譯');
define('_JOOMFISH_ITEM_INFO', '發佈');
define('_JOOMFISH_STATE_NOTEXISTING', '沒有譯本的存在');
define('_JOOMFISH_STATE_CHANGED', '原始內容已變更');
define('_JOOMFISH_STATE_OK', '翻譯狀態正常');

define('_JOOMFISH_COPY', '複製');
define('_JOOMFISH_CLEAR', '清除');
define('_JOOMFISH_TRANSLATION_UPTODATE', '翻譯內容 <u>完成</u>');
define('_JOOMFISH_TRANSLATION_INCOMPLETE', '翻譯內容 <u>不完整</u> 或原始內容 <u>已變更</u>');
define('_JOOMFISH_TRANSLATION_NOT_EXISTING', '翻譯內容 <u>不存在</u>');
define('_JOOMFISH_TRANSLATION_PUBLISHED', '翻譯內容 <u>發佈</u> 至前台');
define('_JOOMFISH_TRANSLATION_NOT_PUBLISHED', '翻譯內容 <u>停止發佈</u>');
define('_JOOMFISH_STATE_TOGGLE', '(點擊圖示變更為<u>停止發佈狀態</u>.)');

define('_JOOMFISH_DBERR_NO_LANGUAGE', '您必須選擇一種語言');
define('_JOOMFISH_CONFIG_SAVED', '設定已儲存.');																// New 1.1
define('_JOOMFISH_CONFIG_PROBLEMS', '儲存設置時有問題!');		// New 1.1
define('_JOOMFISH_LANG_PROBLEMS', '語言資訊仍有問題存在!');		// New 1.1

define ('_JOOMFISH_ADMIN_CATEGORY','分類過濾');													// New 1.7
define ('_JOOMFISH_ADMIN_CATEGORY_ALL','所有分類');												// New 1.7
define ('_JOOMFISH_ADMIN_AUTHOR','作者過濾');														// New 1.7
define ('_JOOMFISH_ADMIN_AUTHOR_ALL','所有作者');													// New 1.7
define ('_JOOMFISH_ADMIN_KEYWORD','關鍵字過濾');													// New 1.7
define ('_JOOMFISH_ADMIN_TRANSLATION_PUBLISHED','翻譯發佈');								// New 1.7
define ('_JOOMFISH_ADMIN_MENUTYPE','選單過濾');														// New 1.7
define ('_JOOMFISH_ADMIN_MENUTYPE_ALL','所有選單');													// New 1.7
define ('_JOOMFISH_ADMIN_BOTH','全部顯示');
define ('_JOOMFISH_ADMIN_PUBLISHED','發佈');
define ('_JOOMFISH_ADMIN_UNPUBLISHED','停止發佈');

define ('_JOOMFISH_ADMIN_CLIPBOARD_COPIED','原始的內容已經複製到剪貼簿(HTML 格式).\n現在請使用 Ctrl + V 貼於編輯器中上');
define ('_JOOMFISH_ADMIN_CLIPBOARD_COPY','按下 Ctrl + C (PC 使用者)或者 command+C (MAC 使用者) 來複製原始的內容到剪貼簿.\n剛貼上時將為 HTML 格式');
define ('_JOOMFISH_ADMIN_CLIPBOARD_NOSUPPORT','您的瀏覽器沒有支援複製到剪貼簿的功能.\n選擇以手動方式將原始的內容複製和貼上');     // New 1.7

define( '_JOOMFISH_NO_TRANSLATION_AVALIABLE', '沒有譯本可供使用, 請選擇其他的語言.');		// Changed 1.7

//tooltips
define ('_JOOMFISH_TT_TITLE_NAME','顯示語言名稱');
define ('_JOOMFISH_TT_TITLE_ISO','<strong>Offcial ISO codes of the language, best use browser definitions.</strong>');
define ('_JOOMFISH_TT_IMAGES_DIR','保持國別圖示為空白. 為所屬國別圖示填入所對應您存放國別圖示的目錄頰相對路徑位置.');
define ('_JOOMFISH_TT_TITLE_ORDER','顯示於前台的排序.');
define ('_JOOMFISH_TT_TRANS_DEFAULT','使用自訂的固定文字. 使用於模組中顯示切換語言的訊息資訊, 如留白將使用語言檔案中 <strong>_JOOMFISH_NO_TRANSLATION_AVAILABLE</strong> 當中定義的內容來顯示.');
define ('_JOOMFISH_TT_SPACER','Spacer for displaying language selector in textmode when in horizontal mode.<br /><strong>Hint</strong>: If nothing is filled here in, but horizontal mode is selected, usually a spacer will be defined by Joomla as: | (with space before and after).<br />Space before and after will be used always.');

// errors
define ('_JOOMFISH_ERROR','錯誤:');
define ('_JOOMFISH_EDITED_BY_ANOTHER_ADMIN','內容項目 [ %s ] 目前已經有其他的管理者進行編輯中'); // %s=$actContentObject->title
define ('_JOOMFISH_CONFIG_WRITE_ERROR','設置檔案無法被寫入!');
define ('_JOOMFISH_ADMIN_MAMBOT_ERROR','多國語言抽象層自動化沒有安裝或發佈 - Joomfish 將無法在這樣的狀態下運作!');

// preferences
define ('_JOOMFISH_ADMIN_PREF_TITLE','Joom!Fish 元件偏好設定');								// @since 1.7
define ('_JOOMFISH_ADMIN_ACCESS_PREFERENCES','存取偏好設定');										// @since 1.7
define ('_JOOMFISH_FRONTEND_PUBLISH','於前台發佈?');											// @since 1.7
define ('_JOOMFISH_ADMIN_PUBLISHERS','Publishers 以上的存取層級');											// @since 1.7
define ('_JOOMFISH_ADMIN_NOONE','沒有人');																// @since 1.7
define ('_JOOMFISH_ADMIN_FEPUBLISH_HELP','誰可以直接發佈翻譯的內容於前台?');	// @since 1.7

define('_JOOMFISH_ADMIN_COMPONENT_CONFIGURATION', '元件設置');							// @since 1.7
define('_JOOMFISH_ADMIN_COMPONENT_CONFIGURATION_HELP', 'Joom!Fish 元件管理使用的語言介面');		// @since 1.7
define('_JOOMFISH_ADMIN_COMPONENT_LANGUAGE', '語言管理');								// @since 1.7
define('_JOOMFISH_ADMIN_SHOWIF', '當無提供譯本進行翻譯時 ...');
define('_JOOMFISH_ADMIN_NOTRANSLATION', '無譯本所要顯示的資訊?');
define('_JOOMFISH_ADMIN_NOTRANSLATION_HELP', '這裡的設定僅應用於當選取的類型為內容資料時!');
define('_JOOMFISH_ADMIN_ORIGINAL_CONTENT', '原始內容');
define('_JOOMFISH_ADMIN_ORIGINAL_WITH_INFO', '原始內容以及無譯本說明');

define('_JOOMFISH_ADMIN_PLACEHOLDER', '無譯本說明文字');													// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_VIEW', '前台顯示');											// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_LIST', '連結列表 (水平)');										// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_COMBO', 'ComboBox');													// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_IMAGE', '圖片列表 (水平)');									// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_HELP', 'Please define how the component should be displayed in the frontend<br>When you select &quot;Image List&quot;, the image path must be empty or valid based on the Joomla root dir.');							// @deprcated from 1.7

define ('_JOOMFISH_ADMIN_TITLE_UNPUBLISHED', '停止發佈');
define ('_JOOMFISH_NAME_MISSING','您必須輸入一個名稱');
define ('_JOOMFISH_ENTER_CORR_JOOMLA_NAME','您必須輸入一個對應於 Joomla 中的名稱');
define ('_JOOMFISH_LANG_ALREADY_EXISTS','已經有一向語言已經和 Joomla 中的名稱相符, 請重試一次');
define ('_JOOMFISH_ADMIN_FRONTEND_VLIST', '名稱列表 (垂直)');
define ('_JOOMFISH_ADMIN_FRONTEND_VIMAGE', '圖示列表 (垂直)');
define ('_JOOMFISH_SPACER','文字中顯示的間隔符號');

// upgrade
define('_JOOMFISH_UPGRADE', '更新');																	// @since 1.7
define('_JOOMFISH_ADMIN_UPGRADE_INFO', '由 MambelFish 升級至 Joom!Fish, 必須 <span style="font-weight:bold; color:red">刪除</span> 所有存在的翻譯內容以及您屬於 Joom!Fish 的資料表!<br />您需要事行確定!');										// @since 1.7
define('_JOOMFISH_UPGRADE_BACKUP_TABLES', '備份 Joom!Fish 資料表?');									// @since 1.7
define('_JOOMFISH_UPGRADE_DELETE_TABLES', '確認刪除 Joom!Fish 資料表');						// @since 1.7
define('_JOOMFISH_UPGRADE_RENAME_TABLES', '於更新前先將舊的資料表進行更名?');							// @since 1.7
define('_JOOMFISH_UPGRADE_ERROR_CONFIRM', '<span style="font-weight:bold; color:red">您需要先行確認, 實際的資料表將被刪除!</span>');							// @since 1.7
define('_JOOMFISH_UPGRADE_ERROR_UPGRADE', '升級的過程發生錯誤, 請檢視紀錄以及詳細的資訊');							// @since 1.7

define('_JOOMFISH_UPGRADE_SUCCESSFUL', '<span style="font-weight:bold; color:green">升級成功</span>');											// @since 1.7
define('_JOOMFISH_UPGRADE_FAILURE', '<span style="font-weight:bold; color:red">升級失敗</span>');													// @since 1.7

define('_JOOMFISH_MBFBOT', 'Mambelfish 自動化');															// @since 1.7
define('_JOOMFISH_MBFMODULE', 'Mambelfish 模組');														// @since 1.7
define('_JOOMFISH_MBF_UNPUBLISHED', '<span style="font-weight:bold; color:green">停止發佈</span>' );											// @since 1.7
define('_JOOMFISH_MBF_NOTUNPUBLISHED', '<span style="font-weight:bold; color:red">無法停止發佈!</span>' );							// @since 1.7

define('_JOOMFISH_CONTENT_BACKUP', 'Joom!Fish tables backup');											// @since 1.7
define('_JOOMFISH_BAK_CONTENT_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地寫入 #__jf_content_bak 資料表</span>' );											// @since 1.7
define('_JOOMFISH_BAK_CONTENT_FAILURE', '<span style="font-weight:bold; color:red">建立備份的 #__jf_content_bak 資料表失敗</span>' );			// @since 1.7
define('_JOOMFISH_BAK_LANGUAGES_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地寫入 #__jf_languages_bak 資料表</span>' );											// @since 1.7
define('_JOOMFISH_BAK_LANGUAGES_FAILURE', '<span style="font-weight:bold; color:red">建立備份的 #__jf_languages_bak 資料表失敗</span>' );			// @since 1.7

define('_JOOMFISH_CONTENT_TABLES', 'Joom!Fish 內容資料表');											// @since 1.7
define('_JOOMFISH_LANGUAGE_TABLES', 'Joom!Fish 語言資料表');											// @since 1.7
define('_JOOMFISH_DEL_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地刪除</span>' );											// @since 1.7
define('_JOOMFISH_DEL_FAILURE', '<span style="font-weight:bold; color:red">刪除實際的 Joom!Fish 資料表失敗</span>' );					// @since 1.7
define('_JOOMFISH_COPY_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地複製</span>' );											// @since 1.7
define('_JOOMFISH_COPY_FAILURE', '<span style="font-weight:bold; color:red">刪除實際的 Joom!Fish 資料表失敗</span>' );					// @since 1.7

// credits
define('_JOOMFISH_CREDITS','後記');								// @since 1.7

define( "_JF_LANG_INCLUDED", true );
}
?>