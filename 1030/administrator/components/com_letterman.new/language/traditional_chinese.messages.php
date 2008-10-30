<?php
	//翻譯者：Eddy Chang(eddy@joomla.org.tw) 20060720
	//http://www.joomla.org.tw
	
define( "LM_SUBSCRIBE_SUBJECT", "您的電子報訂閱於[mosConfig_live_site]" );
define( "LM_SUBSCRIBE_MESSAGE", 
"您好 [NAME],

您已經成功訂閱電子報於 
[mosConfig_live_site]。
感謝您！

要確認您的訂閱，請點按以下的連結或複製它
然後在您的瀏覽器中貼上。

[LINK]

_________________________
[mosConfig_live_site]" );

define( "LM_UNSUBSCRIBE_SUBJECT", "電子報服務於[mosConfig_live_site]：取消訂閱" );
define( "LM_UNSUBSCRIBE_MESSAGE",
"您好 [NAME],

您已經取消訂閱電子報服務於 [mosConfig_live_site].
感謝您使用這項服務。

________________________
[mosConfig_live_site]" );

define( "LM_NEWSLETTER_FOOTER",
"<br/><br/>___________________________________________________________<br/>
您會收到這個電子報是因為您之前有訂閱<br/>
電子報服務於[mosConfig_live_site].<br/>
要取消訂閱請點按這裡：[UNLINK]" );

/* Module */
define( "LM_FORM_NOEMAIL", "請填入合法的電子郵件位址。" );
define( "LM_FORM_SHORTERNAME", "請使用短一點的訂閱者名稱。謝謝。" );
define( "LM_FORM_NONAME", "請填入訂閱者名稱。謝謝。" );
define( "LM_SUBSCRIBE", "訂閱" );
define( "LM_UNSUBSCRIBE", "取消訂閱" );
define( "LM_BUTTON_SUBMIT", "確認！" );

/* Backend */
define( "LM_ERROR_NEWSLETTER_COULDNTBESENT", "電子報無法送出！" );
define( "LM_NEWSLETTER_SENDTO_X_USERS", "電子報已送給{X}位用戶" );
define( "LM_IMPORT_USERS", "匯入訂閱者" );
define( "LM_EXPORT_USERS", "匯出訂閱者" );
define( "LM_UPLAOD_FAILED", "上傳錯誤" );
define( "LM_ERROR_PARSING_XML", "剖析XML檔案時發生錯誤" );
define( "LM_ERROR_NO_XML", "請上傳xml檔案" );
define( "LM_ERROR_EMAIL_ALREADY_ONLIST", "這個電子郵件位址已存在於清單中" );
define( "LM_SUCCESS_ON_IMPORT", "成功匯入{X}位訂閱者。" );
define( "LM_IMPORT_FINISHED", "匯入結束" );
define( "LM_ERROR_DELETING_FILE", "檔案無法刪除" );
define( "LM_DIR_NOT_WRITABLE", "無法寫入目錄 ".$GLOBALS['mosConfig_cachepath'] );
define( "LM_ERROR_INVALID_EMAIL", "不合法的電子郵件位址" );
define( "LM_ERROR_EMPTY_EMAIL", "空白的電子郵件位址" );
define( "LM_ERROR_EMPTY_FILE", "錯誤：空白檔案" );
define( "LM_ERROR_ONLY_TEXT", "僅能使用文字檔案" );

define( "LM_SELECT_FILE", "請選擇一個檔案" );
define( "LM_YOUR_XML_FILE", "您的 YaNC/Letterman XML 匯出檔案" );
define( "LM_YOUR_CSV_FILE", "CSV 匯入檔案" );
define( "LM_POSITION_NAME", "-Name- 欄位的位置" );
define( "LM_NAME_COL", "Name欄位" );
define( "LM_POSITION_EMAIL", "-Email- 欄位的位置" );
define( "LM_EMAIL_COL", "Email欄位" );
define( "LM_STARTFROM", "開始匯入從行數..." );
define( "LM_STARTFROMLINE", "開始行數" );
define( "LM_CSV_DELIMITER", "CSV 分隔符號" );
define( "LM_CSV_DELIMITER_TIP", "CSV 分隔符號： , ; 或Tabulator（跳格鍵）" );

/* Newsletter Management */
define( "LM_NM", "電子報管理" );
define( "LM_MESSAGE", "訊息" );
define( "LM_LAST_SENT", "最後送出" );
define( "LM_SEND_NOW", "立即送出" );
define( "LM_CHECKED_OUT", "提交" );
define( "LM_NO_EXPIRY", "完成：無過期的" );
define( "LM_WARNING_SEND_NEWSLETTER", "您確認要送出電子報？\\n警告：如果您針對數量多的群組用戶寄送，需要花一點時間！" );
define( "LM_SEND_NEWSLETTER", "送出電子報" );
define( "LM_SEND_TO_GROUP", "送給群組" );
define( "LM_MAIL_FROM", "寄件人是" );
define( "LM_DISABLE_TIMEOUT", "關閉時間限制" );
define( "LM_DISABLE_TIMEOUT_TIP", "勾選已保護程式碼產生時間限制錯誤。<br/><strong>在安全模組式下是沒有作用的！<strong>" );
define( "LM_REPLY_TO", "回覆到" );
define( "LM_MSG_HTML", "訊息 (HTML-所視即所得)" );
define( "LM_MSG", "訊息 (HTML-原始碼)" );
define( "LM_TEXT_MSG", "額外的文字訊息" );
define( "LM_NEWSLETTER_ITEM", "電子報項目" );

/* Subscriber Management */
define( "LM_SUBSCRIBER", "訂閱者" );
define( "LM_NEW_SUBSCRIBER", "新訂閱者" );
define( "LM_EDIT_SUBSCRIBER", "編輯訂閱者" );
define( "LM_SELECT_SUBSCRIBER", "選擇訂閱者" );
define( "LM_SUBSCRIBER_NAME", "訂閱者姓名" );
define( "LM_SUBSCRIBER_EMAIL", "訂閱者電子郵件" );
define( "LM_SIGNUP_DATE", "訂閱日期" );
define( "LM_CONFIRMED", "已確認" );
define( "LM_SUBSCRIBER_SAVED", "訂閱者資訊已儲存" );
define( "LM_SUBSCRIBERS_DELETED", "您已成功刪除了{X}位訂閱者。" );
define( "LM_SUBSCRIBER_DELETED", "訂閱者已經被刪除。" );

/* Frontend */
define( "LM_ALREADY_SUBSCRIBED", "您已經訂閱我們的電子報。" );
define( "LM_NOT_SUBSCRIBED", "您目前沒有訂閱我們的電子報。" );
define( "LM_YOUR_DETAILS", "您的詳細資料：" );
define( "LM_SUBSCRIBE_TO", "訂閱我們的電子報" );
define( "LM_UNSUBSCRIBE_FROM", "取消訂閱我們的電子報" );
define( "LM_VALID_EMAIL_PLEASE", "請輸入合法的電子郵件位址！" );
define( "LM_SAME_EMAIL_TWICE", "您填入的電子郵件位址已經在我們的訂閱者清單中！" );
define( "LM_ERROR_SENDING_SUBSCRIBE", "訂閱訊息無法被送達：" );
define( "LM_SUCCESS_SUBSCRIBE", "您的電子郵件位址已經加入我們的電子報中。" );
define( "LM_RETURN_TO_NL", "回到電子報" );
define( "LM_ERROR_UNSUBSCRIBE_OTHER_USER", "抱歉，您無法刪除其它在清單中的用戶。" );
define( "LM_ERROR_SENDING_UNSUBSCRIBE", "一個取消訂閱的訊息無法被送出：" );
define( "LM_SUCCESS_UNSUBSCRIBE", "您的電子郵件位址已經從我們的電子報中移除。" );
define( "LM_SUCCESS_CONFIRMATION", "您的帳戶已成功被確認" );
define( "LM_ERROR_CONFIRM_ACC_NOTFOUND", "與您確認連結的相關帳戶資料無法找到。" );

define( "LM_CONFIRMED_ACCOUNTS_ONLY", "只有要確認帳戶？" );
define( "LM_CONFIRMED_ACCOUNTS_ONLY_TIP", "只寄送電子報給<strong>有確認過</strong>的訂閱者帳戶。訂閱者但未完成確認動作的，是不會收到電子報的。" );

define( "LM_NAME_TAG_USAGE", "您可使用標簽<strong>[NAME]</strong>在電子報中，用來寄送針對個人的電子報。<br/>當寄送電子報時，[NAME]會被用戶/訂閱者的姓名所取代。" );

define( "LM_USERS_TO_SUBSCRIBERS", "讓用戶成為訂閱者" );
define( "LM_ASSIGN_USERS", "指派用戶" );
define( "LM_FORM_MSG", "回覆表單" );

/**
 * @since Letterman 1.2.0
 */
define( 'LM_SEND_LOG', 'Letterman 電子報寄送日誌' );
define( 'LM_NUMBER_OF_MAILS_SENT', '%s 於 %s 郵件已經被送出。');
define( 'LM_SEND_NEXT_X_MAILS', '點按這按鈕寄送剩下的 %s 郵件。');
define( 'LM_CHANGE_MAILS_PER_STEP', '更改每步驟的郵件數量');
define( 'LM_CONFIRM_ABORT_SENDING', '您真的要停止寄送中的電子報？');
define( 'LM_MAILS_PER_STEP', '每次要寄送多少數量的電子報？');
define( 'LM_CONFIRM_UNSUBSCRIBE', '您真的要停止訂閱我們的電子報服務？');

/**
 * @since Letterman 1.2.1
 */
define( 'LM_COMPOSE_NEWSLETTER', '編輯電子報從內容項目');
define( 'LM_USABLE_TAGS', '您可使用的標籤' );
define( 'LM_CONTENT_ITEMS', '內容項目' );
define( 'LM_ADD_CONTENT', '新增內容項目/文章' );
define( 'LM_ADD_CONTENT_TOOLTIP', '如果您從列表中選擇一個內容項目，一個標籤將會被插入到文字區域中。這個標籤在儲存之後將會在文章中被轉譯出來(摘要文字只能使用圖片)。' );
define( 'LM_ATTACHMENTS', '附件' );
define( 'LM_ATTACHMENTS_TOOLTIP', '您可從目錄 %s 選擇一個或多個檔案，可以用來嵌入到要被寄送出的郵件中。請不要在意標籤[ATTACHMENT ..] - 這個將會寄送時被移除！' );
define( 'LM_MULTISELECT', '使用Ctrl鍵和滑鼠點按來複選檔案' );
define( 'LM_ABOUTNEWSLETTER', '關於本報');
define( 'LM_PUBLISH_MODE', '發行方式');
define( 'LM_EMPOWER_WAY', '授權方式');
define( 'LM_SUBSCRIBEORNOT', '訂閱/退閱');
define( 'LM_EDITORIAL_STAFF', '編輯群');
define( 'LM_SUGGESTION', '意見交流');

?>