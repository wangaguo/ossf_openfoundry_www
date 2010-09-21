<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: traditional_chinese.frontend.php 765 2009-01-05 20:55:57Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official web site
 **/
defined('_VALID_MOS') or die('Restricted access');

/**
 * TRANSLATORS:
 * PLEASE ADD THE INFO BELOW
 */

/**
 * Language:
 * Creator:  
 * Website:  
 * E-mail:   
 * Revision: 
 * Date:
 */

// -- General
define('_DML_NOLOG', "登錄後才能訪問檔案區.");
define('_DML_NOLOG_UPLOAD', "你必須登錄並且被授權才能上傳檔案.");
define('_DML_NOLOG_DOWNLOAD', "你必須登錄並且被授權才能訪問檔案.");
define('_DML_NOAPPROVED_DOWNLOAD', "這個文件必須核準才可下載.");
define('_DML_NOPUBLISHED_DOWNLOAD', "這個文件必須發佈才可下載.");
define('_DML_ISDOWN', "對不起，該區臨時維護，請稍後再試.");
define('_DML_SECTION_TITLE', "下載");

// -- Files
define('_DML_DOCLINKTO', "檔案連結到 ");
define('_DML_DOCLINKON', "連結創建於 ");
define('_DML_ERROR_LINKING', "錯誤的連接.");
define('_DML_LINKTO', "連結到 ");
define('_DML_DONE', "完成.");
define('_DML_FILE_UNAVAILABLE', "無法使用這個網站上的檔案");

// -- Documents
define('_DML_TAB_BASIC', "Basic");
define('_DML_TAB_PERMISSIONS', "權限");
define('_DML_TAB_LICENSE', "許可");
define('_DML_TAB_DETAILS', "其他資訊");
define('_DML_TAB_PARAMS', "參數");
define('_DML_OP_CANCELED', "操作被取消");
define('_DML_CREATED_BY', "創建者");
define('_DML_UPDATED_BY', "最後更新");
define('_DML_DOCMOVED', "檔案被移走");
define('_DML_MOVETO', "移動到");
define('_DML_MOVETHEFILES', "移動檔案");
define('_DML_SELECTFILE', "選擇檔案");
define('_DML_THANKSDOCMAN', "感謝你的提交.");
define('_DML_NO_LICENSE', "沒有許可");
define('_DML_DISPLAY_LIC', "顯示許可協議");
define('_DML_LICENSE_TYPE', "許可類型");
define('_DML_MANT_TOOLTIP', "這將決定誰能編輯，或維護，此檔案. "
     . "當一個用戶或群組成員是 檔案的" . _DML_MAINTAINER . "  就意味著能使用特殊的檔案管理選項: 編輯, 更新, 移動, 放回/取出和刪除.");
define('_DML_ON', "on");
define('_DML_CURRENT', "當前");
define('_DML_YOU_MUST_UPLOAD', "你必須首先在這個區塊上傳一個檔案.");
define('_DML_THE_MODULE', "模組");
define('_DML_IS_BEING', "當前正在由另一個管理員編輯");
define('_DML_LINKED', "->連結的檔案<-");
define('_DML_FILETITLE', "文件標題");
define('_DML_OWNER_TOOLTIP', "這決定著誰有下載和瀏覽該檔案的權限. 選擇: "
     . "*所有人* 如果你想讓每個人都能訪問該檔案. "
     . "*所有註冊用戶* 只允許在網站上的註冊用戶訪問該檔案. "
     . "通過選擇在" . _DML_USERS . "下一個用戶名你可以讓單一的註冊用戶可以訪問該檔案 ; "
     . "只有那個用戶將被允許訪問. "
     . "通過選擇在" . _DML_GROUPS . "下一個群組名你可以讓一個用戶群組可以訪問該檔案 ; "
     . "僅群組成員允許訪問該檔案.");
define('_DML_MAKE_SURE', "URL 位址的前面必須加上' http:// '");
define('_DML_DOCURL', "檔案的位址:");
define('_DML_DOCDELETED', "檔案被刪除.");
define('_DML_DOCURL_TOOLTIP', "當你有在別處連結的檔案時，你必須在這裡輸入檔案的 URL 位址. 通常開頭包含網絡協議 (http:// 或 ftp://).");
define('_DML_HOMEPAGE_TOOLTIP', "你可以隨意輸入關於該檔案 URL 位址. 一般在 URL 位址的開頭必須包含http://否則將不能正常運作.");
define('_DML_LICENSE_TOOLTIP', "檔案可能有一個許可協議，瀏覽者只有接受它才可訪問. 在這裡定義許可協議的類型.");
define('_DML_DISPLAY_LICENSE', "在瀏覽時顯示協議/許可");
define('_DML_DISPLAY_LIC_TOOLTIP', " 如果你要使許可協議顯示在被准許訪問之前，那麼選*是*.");
define('_DML_APPROVED_TOOLTIP', "一個檔案須經通過審核才能顯示和儲存到文件庫。選擇「是」，並且請勿忘了發佈該檔案！只有設置了這兩個選項，檔案才能在前台列出");
define('_DML_RESET_COUNTER', "點繫數歸零");
define('_DML_PROBLEM_SAVING_DOCUMENT', "Problem saving document");

// -- Download
define('_DML_PROCEED', "點擊這裡繼續");
define('_DML_YOU_MUST', "要瀏覽該檔案你必須接受該協議.");
define('_DML_NOTDOWN', "該檔案已被一個用戶編輯或更新，現在無法訪問.");
define('_DML_ANTILEECH_ACTIVE', "您正在嘗試進入一個未被授權區域.");
define('_DML_DONT_AGREE', "我不同意.");
define('_DML_AGREE', "我同意.");

// -- Upload
define('_DML_UPLOADED', "開始上傳.");
define('_DML_SUBMIT', "提交");
define('_DML_NEXT', "下一步 >>>");
define('_DML_BACK', "<<< 上一步");
define('_DML_LINK', "連結");
define('_DML_EDITDOC', "編輯這個檔案");
define('_DML_UPLOADWIZARD', "上傳導引");
define('_DML_UPLOADMETHOD', "選擇上傳的方法");
define('_DML_ISUPLOADING', "DOCMan 正在上傳");
define('_DML_PLEASEWAIT', "請稍候");
define('_DML_DOCMANISLINKING', "DOCMan 正在檢查 <br />連結");
define('_DML_DOCMANISTRANSF', "DOCMan 正在轉移<br />文件");
define('_DML_TRANSFER', "轉移");
define('_DML_REMOTEURL', "URL 位址");
define('_DML_LINKURLTT', "輸入位址，位址必須完全（包含http:// 或 ftp://），如：http://joomlacode.org/gf/download/frsrelease/292/1001/docman_1.3RC2.zip.");
define('_DML_REMOTEURLTT'   , _DML_LINKURLTT . "<br />你可以通過以下方式給文件另外命名&quot;本地名稱（Local Name）&quot; 字段（field）.");
define('_DML_LOCALNAME', "本地名稱");
define('_DML_LOCALNAMETT', "另外命名該文件."
     . "因為位址（URL）沒有給出該檔案足夠的信息，該字段是必須增加的.");
define('_DML_ERROR_UPLOADING', "上傳錯誤.");

// -- Search
define('_DML_SELECCAT', "選擇分類目錄");
define('_DML_ALLCATS', "所有分類目錄");
define('_DML_SEARCH_WHERE', "搜尋區域");
define('_DML_SEARCH_MODE', "搜尋條件");
define('_DML_SEARCH', "搜尋");
define('_DML_SEARCH_REVRS', " 反向搜尋");
define('_DML_SEARCH_REGEX', "正則表達式");
define('_DML_NOT', " 排除"); // Used for Inversion

// -- E-mail
define('_DML_EMAIL_GROUP', "發送 E-mail 給群組");
define('_DML_SUBJECT', "主旨");
define('_DML_EMAIL_LEADIN', "標題文字");
define('_DML_MESSAGE', "主要訊息");
define('_DML_SEND_EMAIL', "送出");

// -- Task buttons
// NOTE: these strings were originally _DML_TPL_DOC_... in the theme language
define('_DML_BUTTON_DOWNLOAD', "檔案下載");
define('_DML_BUTTON_VIEW', "直接瀏覽");
define('_DML_BUTTON_DETAILS', "詳細內容");
define('_DML_BUTTON_EDIT', "編輯");
define('_DML_BUTTON_MOVE', "移動");
define('_DML_BUTTON_DELETE', "刪除");
define('_DML_BUTTON_UPDATE', "更新");
define('_DML_BUTTON_CHECKOUT', "取出");
define('_DML_BUTTON_CHECKIN', "放回");
define('_DML_BUTTON_UNPUBLISH', "取消發佈");
define('_DML_BUTTON_PUBLISH', "發佈");
define('_DML_BUTTON_RESET', "歸零");
define('_DML_BUTTON_APPROVE', "核準");

// -- Added v1.4.0 RC1
define('_DML_CHECKED_IN', "放回");