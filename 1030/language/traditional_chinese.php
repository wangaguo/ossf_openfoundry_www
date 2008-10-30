<?php
/**
* @version $Id: traditional_chinese.php 85 2005-09-27 23:12:03Z eddy&dofi $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
/**
* Support site : http://www.TaiwanJoomla.com/
* Translators : Eddy Chang (eddy@joomla.com.tw) & DOFI(dofilab@seed.net.tw)
* Version : 1.0.1 for Joomla! 1.0.1
* Last Update:2005/09/27
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// Site page note found
define( '_404', '您要存取的網頁不存在。' );
define( '_404_RTS', '回到網站' );

// common
DEFINE('_LANGUAGE','tw');
DEFINE('_NOT_AUTH','您並沒有檢視這個頁面的權限。');
DEFINE('_DO_LOGIN','您必須先登入。');
DEFINE('_VALID_AZ09','請輸入有效的 %s。 不能有空格，至少要有 %d 個字元，而且只能使用0-9、a-z、A-Z字元符號');
DEFINE('_CMN_YES','是');
DEFINE('_CMN_NO','否');
DEFINE('_CMN_SHOW','顯示');
DEFINE('_CMN_HIDE','隱藏');

DEFINE('_CMN_NAME','名稱');
DEFINE('_CMN_DESCRIPTION','說明');
DEFINE('_CMN_SAVE','儲存');
DEFINE('_CMN_CANCEL','取消');
DEFINE('_CMN_PRINT','列印');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','E-mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','上一層'); 
DEFINE('_CMN_ORDERING','排序');
DEFINE('_CMN_ACCESS','存取等級');
DEFINE('_CMN_SELECT','選擇');

DEFINE('_CMN_NEXT','下一頁');
DEFINE('_CMN_NEXT_ARROW','&gt;&gt; ');
DEFINE('_CMN_PREV','上一頁');
DEFINE('_CMN_PREV_ARROW','&lt;&lt; ');

DEFINE('_CMN_SORT_NONE','不排序');
DEFINE('_CMN_SORT_ASC','遞增排序');
DEFINE('_CMN_SORT_DESC','遞減排序');

DEFINE('_CMN_NEW','新增');
DEFINE('_CMN_NONE','無');
DEFINE('_CMN_LEFT','置左');
DEFINE('_CMN_RIGHT','置右');
DEFINE('_CMN_CENTER','置中');
DEFINE('_CMN_ARCHIVE','歸檔');
DEFINE('_CMN_UNARCHIVE','不歸檔');
DEFINE('_CMN_TOP','上方');//452
DEFINE('_CMN_BOTTOM','底層');//452

DEFINE('_CMN_PUBLISHED','發佈');
DEFINE('_CMN_UNPUBLISHED','不發佈');

DEFINE('_CMN_EDIT_HTML','編輯HTML');
DEFINE('_CMN_EDIT_CSS','編輯CSS');

DEFINE('_CMN_DELETE','刪除');

DEFINE('_CMN_FOLDER','資料夾');
DEFINE('_CMN_SUBFOLDER','子資料夾');
DEFINE('_CMN_OPTIONAL','選擇性項目');
DEFINE('_CMN_REQUIRED','必要');

DEFINE('_CMN_CONTINUE','繼續');

DEFINE('_CMN_NEW_ITEM_LAST','新項目預設排到最後面。排序可以在這個項目被儲存後更改。');//452
DEFINE('_CMN_NEW_ITEM_FIRST','新項目預設排到最前面。排序可以在這個項目被儲存後更改。');//452
DEFINE('_LOGIN_INCOMPLETE','請完整填寫帳號和密碼欄。');
DEFINE('_LOGIN_BLOCKED','您已被禁止登入。請聯絡系統管理員。');
DEFINE('_LOGIN_INCORRECT','不正確的帳號和密碼。 請重新輸入。');
DEFINE('_LOGIN_NOADMINS','您無法登入。還沒有設定好系統管理員帳號。');
DEFINE('_CMN_JAVASCRIPT','!注意! Javascript必需先啟動，程式才能正常運作。');

DEFINE('_NEW_MESSAGE','一個新的訊息送達');
DEFINE('_MESSAGE_FAILED','這個帳號鎖住信箱。訊息傳送失敗。');

DEFINE('_CMN_IFRAMES', '這個選項無法正常運作。不幸地，您的瀏覽器不支援Inline Frames');

DEFINE('_INSTALL_WARN','為了安全考量，請完整移除installation目錄，包含所有檔案和子目錄 - 然後再重新整理網頁');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>佈景主題檔案找不到！尋找佈景主題檔案於：</b></font>');
DEFINE('_NO_PARAMS','這個項目沒有參數值');
DEFINE('_HANDLER','Handler not defined for type');

/** mambots */
DEFINE('_TOC_JUMPTO','文章索引');//原英文為Article Index

/**  content */
DEFINE('_READ_MORE','詳細內容...');
DEFINE('_BACK_TOP','回目錄');
DEFINE('_READ_MORE_REGISTER','註冊後才可讀取更多內容...');
DEFINE('_MORE','更多...');
DEFINE('_ON_NEW_CONTENT', '%s 已送出一個新的內容項目，其標題為 %s' );
DEFINE('_SEL_CATEGORY','- 選擇分類 -');//452
DEFINE('_SEL_SECTION','- 選擇單元 -');//452
DEFINE('_SEL_AUTHOR','- 選擇作者 -');//452
DEFINE('_SEL_POSITION','- 選擇位置 -');//452
DEFINE('_SEL_TYPE','- 選擇類型 -');//452
//DEFINE('_SEL_CATEGORY','選擇分類');
//DEFINE('_SEL_SECTION','選擇單元段落');
DEFINE('_EMPTY_CATEGORY','目前分類是空的');
DEFINE('_EMPTY_BLOG','目前沒有可顯示的項目');
DEFINE('_NOT_EXIST','您試圖存取的頁面已不存在。<br />請從主選單選擇另一個頁面。');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','投票');
DEFINE('_BUTTON_RESULTS','結果');
DEFINE('_USERNAME','帳號');
DEFINE('_LOST_PASSWORD','遺失密碼');
DEFINE('_PASSWORD','密碼');
DEFINE('_BUTTON_LOGIN','登入');
DEFINE('_BUTTON_LOGOUT','登出');
DEFINE('_NO_ACCOUNT','尚未註冊？');
DEFINE('_CREATE_ACCOUNT','註冊');
DEFINE('_VOTE_POOR','差');
DEFINE('_VOTE_BEST','佳');
DEFINE('_USER_RATING','會員評價');
DEFINE('_RATE_BUTTON','評價');
DEFINE('_REMEMBER_ME','記住密碼');

/** contact.php */
DEFINE('_ENQUIRY','詢問');
DEFINE('_ENQUIRY_TEXT','這份透過 %s 傳送的詢問郵件是來自於：');//452
DEFINE('_COPY_TEXT','這是一份複製的訊息，是您之前寄給網站 %s，且是透過 %s 寄送的');//452
//DEFINE('_ENQUIRY_TEXT','這份詢問郵件是來自於');
//DEFINE('_COPY_TEXT','這是一份複製的訊息，是您之前寄給這個網站 %s 的管理員的');
DEFINE('_COPY_SUBJECT','複製來源：');
DEFINE('_THANK_MESSAGE','感謝您的來函');
DEFINE('_CLOAKING','這個email住址已經被防垃圾郵件程式保護，您需要啟動Javascript才能觀看');
DEFINE('_CONTACT_HEADER_NAME','名字');
DEFINE('_CONTACT_HEADER_POS','職稱');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','電話');
DEFINE('_CONTACT_HEADER_FAX','傳真');
DEFINE('_CONTACTS_DESC','這個網站的聯絡名單。');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','聯絡');
DEFINE('_EMAIL_DESCRIPTION','發送Email給這個聯絡人：');
DEFINE('_NAME_PROMPT',' 輸入您的姓名：');
DEFINE('_EMAIL_PROMPT',' 輸入您的e-mail地址：');
DEFINE('_MESSAGE_PROMPT',' 輸入您的訊息：');
DEFINE('_SEND_BUTTON','發送');
DEFINE('_CONTACT_FORM_NC','請檢查您所填寫的表單是否完整且合法。');
DEFINE('_CONTACT_TELEPHONE','電話： ');
DEFINE('_CONTACT_MOBILE','手機： ');
DEFINE('_CONTACT_FAX','傳真： ');
DEFINE('_CONTACT_EMAIL','Email： ');
DEFINE('_CONTACT_NAME','姓名 ');
DEFINE('_CONTACT_POSITION','職位： ');
DEFINE('_CONTACT_ADDRESS','地址：');
DEFINE('_CONTACT_MISC','相關資訊：');
DEFINE('_CONTACT_SEL','選擇聯絡人：');
DEFINE('_CONTACT_NONE','沒有任何的聯絡資訊');
DEFINE('_EMAIL_A_COPY','Email一份複製到您的住址');
DEFINE('_CONTACT_DOWNLOAD_AS','下載有關資訊於');//452
DEFINE('_VCARD','VCard');//452

/** pageNavigation */
DEFINE('_PN_LT','&lt;');//1.0.4
DEFINE('_PN_RT','&gt;');//1.0.4
DEFINE('_PN_PAGE','頁');
DEFINE('_PN_OF','/');
DEFINE('_PN_START','首頁');
DEFINE('_PN_PREVIOUS','上頁');
DEFINE('_PN_NEXT','下頁');
DEFINE('_PN_END','末頁');
DEFINE('_PN_DISPLAY_NR','顯示 #');
DEFINE('_PN_RESULTS','當前記錄');

/** emailfriend */
DEFINE('_EMAIL_TITLE','E-mail給您的朋友');
DEFINE('_EMAIL_FRIEND','E-mail此頁給您的朋友。');
DEFINE('_EMAIL_FRIEND_ADDR','您朋友的e-mail：');
DEFINE('_EMAIL_YOUR_NAME','您的姓名：');
DEFINE('_EMAIL_YOUR_MAIL','您的e-mail：');
DEFINE('_SUBJECT_PROMPT',' 訊息標題：');
DEFINE('_BUTTON_SUBMIT_MAIL','發送e-mail');
DEFINE('_BUTTON_CANCEL','取消');
DEFINE('_EMAIL_ERR_NOINFO','您必須輸入您自己的有效郵件地址，以及所要發送的合法e-mail地址。');
DEFINE('_EMAIL_MSG',' 下面的網頁是來自於 %s 這個網站，並且是由 %s ( %s )所發送給您的。 

您可以透過底下的URL來存取它：
%s');
DEFINE('_EMAIL_INFO','這個項目的發送者');
DEFINE('_EMAIL_SENT','這個項目已經被發送給');
DEFINE('_PROMPT_CLOSE','關閉視窗');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' 投稿人');
DEFINE('_WRITTEN_BY', ' 作者');
DEFINE('_LAST_UPDATED', '最後更新');
DEFINE('_BACK','[返回]');
DEFINE('_LEGEND','Legend');
DEFINE('_DATE','時間');
DEFINE('_ORDER_DROPDOWN','排序');
DEFINE('_HEADER_TITLE','標題');
DEFINE('_HEADER_AUTHOR','作者');
DEFINE('_HEADER_SUBMITTED','提供');
DEFINE('_HEADER_HITS','點擊');
DEFINE('_E_EDIT','編輯');
DEFINE('_E_ADD','新增');
DEFINE('_E_WARNUSER','請選擇要取消或儲存目前所做的更改');
DEFINE('_E_WARNTITLE','內容項目必須要有標題');
DEFINE('_E_WARNTEXT','內容項目必須要有簡介');
DEFINE('_E_WARNCAT','請選擇一個分類');
DEFINE('_E_CONTENT','內容');
DEFINE('_E_TITLE','標題：');
DEFINE('_E_CATEGORY','類別：');
DEFINE('_E_INTRO','簡介');
DEFINE('_E_MAIN','主要內容');
DEFINE('_E_MOSIMAGE','插入 {mosimage}');
DEFINE('_E_IMAGES','圖片');
DEFINE('_E_GALLERY_IMAGES','圖庫');
DEFINE('_E_CONTENT_IMAGES','內容圖片');
DEFINE('_E_EDIT_IMAGE','編輯圖片');
DEFINE('_E_INSERT','插入');
DEFINE('_E_UP','上');
DEFINE('_E_DOWN','下');
DEFINE('_E_REMOVE','移除');
DEFINE('_E_SOURCE','原始碼：');
DEFINE('_E_ALIGN','對齊位置：');
DEFINE('_E_ALT','說明文字：');
DEFINE('_E_BORDER','邊框：');
DEFINE('_E_CAPTION','標題');//452
DEFINE('_E_APPLY','套用');
DEFINE('_E_PUBLISHING','發佈');
DEFINE('_E_STATE','狀態：');
DEFINE('_E_AUTHOR_ALIAS','作者別名：');
DEFINE('_E_ACCESS_LEVEL','存取等級：');
DEFINE('_E_ORDERING','排序：');
DEFINE('_E_START_PUB','發佈起始時間：');
DEFINE('_E_FINISH_PUB','發佈結束時間：');
DEFINE('_E_SHOW_FP','顯示在首頁：');
DEFINE('_E_HIDE_TITLE','隱藏項目標題：');
DEFINE('_E_METADATA','Metadata');
DEFINE('_E_M_DESC','敘述說明：');
DEFINE('_E_M_KEY','關鍵字：');
DEFINE('_E_SUBJECT','主題：');
DEFINE('_E_EXPIRES','過期時間：');
DEFINE('_E_VERSION','版本：');
DEFINE('_E_ABOUT','關於');
DEFINE('_E_CREATED','建立時間：');
DEFINE('_E_LAST_MOD','最後修改時間：');
DEFINE('_E_HITS','點擊：');
DEFINE('_E_SAVE','儲存');
DEFINE('_E_CANCEL','取消');
DEFINE('_E_REGISTERED','僅限已註冊會員');
DEFINE('_E_ITEM_INFO','項目資訊');
DEFINE('_E_ITEM_SAVED','項目已被成功儲存。');
DEFINE('_ITEM_PREVIOUS','&lt; 前一個');
DEFINE('_ITEM_NEXT','下一個 &gt;');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','目前在這個單元內並沒有任何的歸檔項目，請稍後再回來觀看。');	
DEFINE('_CATEGORY_ARCHIVE_EMPTY','目前在這個分類內並沒有任何的歸檔項目，請稍後再回來觀看。');	
DEFINE('_HEADER_SECTION_ARCHIVE','單元資料儲存庫');
DEFINE('_HEADER_CATEGORY_ARCHIVE','分類資料儲存庫');
DEFINE('_ARCHIVE_SEARCH_FAILURE','沒有在 %s 月 %s 年所進行歸檔的項目');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','這裡是 %s 月 %s 年所進行歸檔的項目');	// values are month then year
DEFINE('_FILTER','關鍵字過濾');
DEFINE('_ORDER_DROPDOWN_DA','日期遞增');
DEFINE('_ORDER_DROPDOWN_DD','日期遞減');
DEFINE('_ORDER_DROPDOWN_TA','標題遞增');
DEFINE('_ORDER_DROPDOWN_TD','標題遞減');
DEFINE('_ORDER_DROPDOWN_HA','點擊數遞增');
DEFINE('_ORDER_DROPDOWN_HD','點擊數遞減');
DEFINE('_ORDER_DROPDOWN_AUA','作者遞增');
DEFINE('_ORDER_DROPDOWN_AUD','作者遞減');
DEFINE('_ORDER_DROPDOWN_O','排序');

/** poll.php */
DEFINE('_ALERT_ENABLED','必須啟用Cookies功能！');
DEFINE('_ALREADY_VOTE','您今天已經對這個項目投過票了！');
DEFINE('_NO_SELECTION','沒有選擇任何項目，請再試一次');
DEFINE('_THANKS','感謝您參與投票！');
DEFINE('_SELECT_POLL','選擇一個調查項目');

/** classes/html/poll.php */
DEFINE('_JAN','一月');
DEFINE('_FEB','二月');
DEFINE('_MAR','三月');
DEFINE('_APR','四月');
DEFINE('_MAY','五月');
DEFINE('_JUN','六月');
DEFINE('_JUL','七月');
DEFINE('_AUG','八月');
DEFINE('_SEP','九月');
DEFINE('_OCT','十月');
DEFINE('_NOV','十一月');
DEFINE('_DEC','十二月');
DEFINE('_POLL_TITLE','調查 - 結果');
DEFINE('_SURVEY_TITLE','調查標題：');
DEFINE('_NUM_VOTERS','投票總數');
DEFINE('_FIRST_VOTE','首次投票時間');
DEFINE('_LAST_VOTE','最後投票時間');
DEFINE('_SEL_POLL','選擇調查項目：');
DEFINE('_NO_RESULTS','這個調查還沒有結果。');

/** registration.php */
DEFINE('_ERROR_PASS','對不起，沒有找到符合的帳號');
DEFINE('_NEWPASS_MSG','帳號 $checkusername 已使用這個郵件地址來進行註冊了。\n'
.' 來自於 $mosConfig_live_site 的會員剛剛已提出發送新密碼的請求。\n\n'
.' 您的新密碼是: $newpass\n\n 要是您並沒有提過這樣的請求，也請勿擔心。'
.' 因為收到這個訊息的是您自己，而不是提出申請的人。如果這是並不是誤寄的訊息的話，'
.' 請使用您的新密碼登入。然後再改成您所想要的其他密碼。');
DEFINE('_NEWPASS_SUB','$_sitename :: $checkusername - 新的登錄密碼');
DEFINE('_NEWPASS_SENT','新的會員密碼已經產生，並且也已經寄出！');
DEFINE('_REGWARN_NAME','請輸入您的姓名。');
DEFINE('_REGWARN_UNAME','請輸入帳號。');
DEFINE('_REGWARN_MAIL','請輸入合法的e-mail地址。');
DEFINE('_REGWARN_PASS','請輸入合法的密碼。不能有空格，至少要有6個字元，而且只能使用0-9、a-z、A-Z字元符號');
DEFINE('_REGWARN_VPASS1','請輸入驗証密碼。');
DEFINE('_REGWARN_VPASS2','密碼和驗証密碼不同，請重新輸入。');
DEFINE('_REGWARN_INUSE','這組帳號和密碼已經有人使用了。 請試試其他的組合。');
DEFINE('_REGWARN_EMAIL_INUSE', '這個e-mail已經被註冊了。如果您是忘了密碼請按"忘記密碼"，會有另一組新的密碼寄給您。');
DEFINE('_SEND_SUB','%s 的帳號資料於 %s');
DEFINE('_USEND_MSG_ACTIVATE', '您好 %s,

感謝您註冊 %s。您的帳號已經建立了，但必須在您使用它前啟動。
要啟動帳號請按下以下的連結，或複製到您的瀏覽器中：
%s

在啟動之後，您就可以用以下的帳號和密碼登入 %s ：


帳號 - %s
密碼 - %s');
DEFINE('_USEND_MSG', "您好 %s,
感謝您註冊 %s。

您現在可以用您註冊時的帳號和密碼登入 %s ");
DEFINE('_USEND_MSG_NOPASS','$name 您好，\n\n您已經被加入成為 $mosConfig_live_site 的會員。\n'
.'請使用您註冊時所設定的帳號和密碼來登入 $mosConfig_live_site 。\n\n'
.'請不要回覆這份由系統自動產生出來的訊息，因為這只是一份通知用的郵件而已。\n');
DEFINE('_ASEND_MSG','您好 %s,

一個新的會員已經在 %s 註冊。
這個email包含了他的詳細資料：

姓名 - %s
e-mail - %s
帳號 - %s

請不要回覆這份由系統自動產生出來的訊息，因為這只是一份回報用的郵件而已。');
DEFINE('_REG_COMPLETE_NOPASS','<span class="componentheading">註冊完成！</span><br />&nbsp;&nbsp;'
.'您現在就可以進行登入了。<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">註冊完成！</div><br />您現在可以登入了。');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">註冊完成！</div><br />您的帳號已經被建立，啟動連結已經寄送到您填寫的e-mail位置去了。請注意您必須在您登入前，按下您收到的e-mail中的啟動帳號連結。');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">啟動完成！</div><br />您的帳號已經成功啟動。您現在可以用您註冊時的帳號與密碼進行登入。');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">無效的啟動連結！</div><br />沒有任何可啟動的帳號在資料庫中，或是此帳號已被啟動。');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','遺失您的密碼了？');
DEFINE('_NEW_PASS_DESC','請輸入您的帳號和e-mail地址，然後點擊「發送密碼」按鈕。<br />'
.'您很快地就會收到一份新密碼。請使用新的密碼來存取網站。');
DEFINE('_PROMPT_UNAME','帳號');
DEFINE('_PROMPT_EMAIL','E-mail地址：');
DEFINE('_BUTTON_SEND_PASS','發送密碼');
DEFINE('_REGISTER_TITLE','註冊');
DEFINE('_REGISTER_NAME','姓名(可用中文)：');
DEFINE('_REGISTER_UNAME','帳號(限英文與數字)：');
DEFINE('_REGISTER_EMAIL','E-mail：');
DEFINE('_REGISTER_PASS','密碼：');
DEFINE('_REGISTER_VPASS','驗証密碼：');
DEFINE('_REGISTER_REQUIRED','有標記星號(*)是必填欄位。');//452
DEFINE('_BUTTON_SEND_REG','送出註冊資料');
DEFINE('_SENDING_PASSWORD','您的密碼將會被發送至上面所指定的e-mail地址當中。<br />一旦您收到您自己的新密碼時，就可以進行登入，並且去修改它。');


/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','搜尋');
DEFINE('_PROMPT_KEYWORD','搜尋關鍵字');
DEFINE('_SEARCH_MATCHES','找到 %d 個符合搜尋條件的結果');
DEFINE('_CONCLUSION','以<b>$searchword</b>進行搜尋，總共找到 $totalRows 筆記錄。  ');
DEFINE('_NOKEYWORD','沒有找到符合搜尋條件的任何結果');
DEFINE('_IGNOREKEYWORD','在搜尋過程中忽略了一個或多個常用單字');
DEFINE('_SEARCH_ANYWORDS','任一關鍵字');
DEFINE('_SEARCH_ALLWORDS','所有關鍵字');
DEFINE('_SEARCH_PHRASE','符合完整字詞');
DEFINE('_SEARCH_NEWEST','較新的排前面');
DEFINE('_SEARCH_OLDEST','較舊的排前面');
DEFINE('_SEARCH_POPULAR','最常見的');
DEFINE('_SEARCH_ALPHABETICAL','按字母次序的');
DEFINE('_SEARCH_CATEGORY','單元段落/分類');
DEFINE('_SEARCH_MESSAGE','搜尋字詞最少3個字元, 最多20個字元');//1.0.4
DEFINE('_SEARCH_ARCHIVED','封存');//1.0.4
DEFINE('_SEARCH_CATBLOG','分類部落格風格');//1.0.4
DEFINE('_SEARCH_CATLIST','分類列表');//1.0.4
DEFINE('_SEARCH_NEWSFEEDS','RSS新聞聯播');//1.0.4
DEFINE('_SEARCH_SECLIST','單元列表');//1.0.4
DEFINE('_SEARCH_SECBLOG','單元部落格風格');//1.0.4

/** templates/*.php */
DEFINE('_ISO','charset=utf-8');
DEFINE('_DATE_FORMAT','l, F d Y');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE('_DATE_FORMAT_LC','%A, %d %B %Y %H:%M'); //Uses PHP's strftime Command Format
*/
DEFINE('_DATE_FORMAT_LC','%Y/%m/%d, %A'); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2','%Y/%m/%d, %A %H:%M');
DEFINE('_SEARCH_BOX','搜尋...');
DEFINE('_NEWSFLASH_BOX','新聞快報！');
DEFINE('_MAINMENU_BOX','主選單');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','會員選單');
DEFINE('_HI','您好，');

/** user.php */
DEFINE('_SAVE_ERR','請完成所有的欄位內容。');
DEFINE('_THANK_SUB','感謝您的投稿。 您的稿件將會在經過審核之後，才會被刊登在網站上。');
DEFINE('_THANK_SUB_PUB','感謝您的投稿。'); //new 1.0.8
DEFINE('_UP_SIZE','您不能上傳大於15kb的檔案。');
DEFINE('_UP_EXISTS','圖片名稱 $userfile_name 已經存在。 請改用別的名稱再試一次。');
DEFINE('_UP_COPY_FAIL','複製失敗');
DEFINE('_UP_TYPE_WARN','您只能上傳gif或jpg格式的圖片。');
DEFINE('_MAIL_SUB','一份新的會員投稿稿件');
DEFINE('_MAIL_MSG','$adminName 您好，\n\n 有一份由會員投遞至 $mosConfig_live_site '
.'的 $type ， $title ，作者是$author'
.'請登入 $mosConfig_live_site/administrator 來審核這份 $type 。\n\n'
.'請不要回覆這份由系統自動產生出來的訊息，因為這只是一份回報用的郵件而已。\n');
DEFINE('_PASS_VERR1','如果您要修改密碼，請再輸一遍密碼，以便進行驗証。');
DEFINE('_PASS_VERR2','如果您要修改密碼，請確認一下您的密碼和驗証密碼確實是相同的。');
DEFINE('_UNAME_INUSE','這個帳號已經有人使用了。');
DEFINE('_UPDATE','更新');
DEFINE('_USER_DETAILS_SAVE','您的設定資料已經被儲存起來了。');
DEFINE('_USER_LOGIN','會員註冊');

/** components/com_user */
DEFINE('_EDIT_TITLE','編輯您的詳細資料');
DEFINE('_YOUR_NAME','您的姓名：');
DEFINE('_EMAIL','e-mail：');
DEFINE('_UNAME','帳號：');
DEFINE('_PASS','密碼：');
DEFINE('_VPASS','驗証密碼：');
DEFINE('_SUBMIT_SUCCESS','成功送出！');
DEFINE('_SUBMIT_SUCCESS_DESC','您的資料項目已經成功遞送給系統管理員。這些資料將會在經過審核之後，才會被發佈在網站上。');
DEFINE('_WELCOME','歡迎光臨！');
DEFINE('_WELCOME_DESC','歡迎來到我們網站的會員區');
DEFINE('_CONF_CHECKED_IN','被取出（checked out）的項目已經全部都被回存（checked in）');
DEFINE('_CHECK_TABLE','檢核表格');
DEFINE('_CHECKED_IN','回存（Checked in） ');
DEFINE('_CHECKED_IN_ITEMS',' 項目');
DEFINE('_PASS_MATCH','密碼並不相符');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','您必需為客戶選擇一個名稱。');
DEFINE('_BNR_CONTACT','您必需為客戶選擇一個聯絡方式。');
DEFINE('_BNR_VALID_EMAIL','您必需為客戶選擇一個合法的email。');
DEFINE('_BNR_CLIENT','您必需選擇一個客戶，');
DEFINE('_BNR_NAME','您必需為廣告看板選擇一個名稱。');
DEFINE('_BNR_IMAGE','您必需為廣告看板選擇一個圖片。');
DEFINE('_BNR_URL','您必需為廣告看板選擇一個 URL/自訂的看板代碼。');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','您已經登入了！');
DEFINE('_LOGOUT','點按此處即可登出');
DEFINE('_LOGIN_TEXT','使用登入功能和密碼來取得完整的存取權限');
DEFINE('_LOGIN_SUCCESS','您已經成功登入');
DEFINE('_LOGOUT_SUCCESS','您已經成功登出');
DEFINE('_LOGIN_DESCRIPTION','要存取本站專屬區域請先登入');
DEFINE('_LOGOUT_DESCRIPTION','您目前已登入到本站專屬區域');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','網站連結');
DEFINE('_WEBLINKS_DESC','我們都會經常地瀏覽各個網站。一旦當發現到不錯的網站時，就會把它列在這裡，以便讓您一同來瀏覽。'
.'<br />您可以選擇底下所列的網站連結主題之一，並點選所要拜訪的網址。');
DEFINE('_HEADER_TITLE_WEBLINKS','網站連結');
DEFINE('_SECTION','區域：');
DEFINE('_SUBMIT_LINK','提供一個網站連結');
DEFINE('_URL','URL：');
DEFINE('_URL_DESC','說明：');
DEFINE('_NAME','名稱：');
DEFINE('_WEBLINK_EXIST','已經存在相同的網站連結名稱，請再輸入其他不同的名稱。');
DEFINE('_WEBLINK_TITLE','您的網站連結必須要有標題.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','來源名稱');
DEFINE('_FEED_ARTICLES','# 文章數');
DEFINE('_FEED_LINK','來源連結');

/** whos_online.php */
DEFINE('_WE_HAVE', '我們有 ');
DEFINE('_AND', ' 和 ');
/* modify in 1.0.9*/
/*
DEFINE('_GUEST_COUNT','$guest_array 位訪客');
DEFINE('_GUESTS_COUNT','$guest_array 位訪客');
DEFINE('_MEMBER_COUNT','$user_array 位會員');
DEFINE('_MEMBERS_COUNT','$user_array 位會員');
*/
DEFINE('_GUEST_COUNT','%s 位訪客');
DEFINE('_GUESTS_COUNT','%s 位訪客');
DEFINE('_MEMBER_COUNT','%s 位會員');
DEFINE('_MEMBERS_COUNT','%s 位會員');

DEFINE('_ONLINE','在線上');
DEFINE('_NONE','線上沒有任何訪客');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','時間');
DEFINE('_MEMBERS_STAT','註冊會員');
DEFINE('_HITS_STAT','點閱次數');
DEFINE('_NEWS_STAT','新聞');
DEFINE('_LINKS_STAT','網站連結');
DEFINE('_VISITORS','訪客');

/** /adminstrator/components/com_menus/admin.menus.html.php *///452
DEFINE('_MAINMENU_HOME','* 在選單[mainmenu]中第一個被發佈的項目就是預設的網站`首頁` *');//452
DEFINE('_MAINMENU_DEL','* 您不能 `刪除` 這個選單，因為這是Joomla!裡必需要有的 *');//452
DEFINE('_MENU_GROUP','* 有些 `Menu Types（選單類型）` 會出現在一個以上的群組中 *');//452


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', '新會員詳細資料' );
DEFINE('_NEW_USER_MESSAGE', 'Hello %s,


管理者已經批準您加入成為 %s 的會員。

這封email包含了您的登入 %s 所需的帳號和密碼： 

帳號 - %s
密碼 - %s


請不要回覆這份由系統自動產生出來的訊息，因為這只是一份通知用的郵件而已。');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "這封email是來自'%s'

訊息:
" );

/** includes/pdf.php *///1.0.4
DEFINE('_PDF_GENERATED','建立者是:');//1.0.4
DEFINE('_PDF_POWERED','Powered by Joomla!');//1.0.4
	
//新的強化版字詞 1.0.8 CE
DEFINE('_CMN_ALL','所有的');//1.0.8
DEFINE('_CMN_UNASSIGNED','未指定');//1.0.8
	
//new in 1.0.9
DEFINE('_VALID_AZ09_USER','請輸入合法的 %s。只能包含0-9 a-z A-Z，需超過 %d 個字元');
DEFINE('_CMN_APPLY','應用');
DEFINE('_STATIC_CONTENT','靜態內容');
DEFINE('_CONTACT_MORE_THAN','您不能輸入超過一個email住址');
DEFINE('_CONTACT_ONE_EMAIL','您不能輸入超過一個email住址');
DEFINE('_E_NO_IMAGE','無圖片');
DEFINE('_E_CAPTION_POSITION','標題位置');
DEFINE('_E_CAPTION_ALIGN','標題對齊');
DEFINE('_E_CAPTION_WIDTH','標題寬度');
DEFINE('_KEY_NOT_FOUND','找不到關鍵字');
DEFINE('_NO_IMAGES','無圖片');
?>
