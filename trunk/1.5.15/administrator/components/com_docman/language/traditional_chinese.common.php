<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: traditional_chinese.common.php 803 2009-02-13 14:58:45Z mathias $
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

define ('_DM_DATEFORMAT_LONG', "%A %B %d, %Y %H:%M:%S"); // use PHP strftime Format, more info at http://php.net
define ('_DM_DATEFORMAT_SHORT', "%B %d, %Y");         // use PHP strftime Format, more info at http://php.net
define ('_DM_ISO', 'UTF-8');
define ('_DM_LANG', 'zh_TW');

// -- General
define('_DML_NAME', "名稱");
define('_DML_DATE', "日期");
define('_DML_DATE_MODIFIED', "修正的日期");
define('_DML_HITS', "點擊數");
define('_DML_SIZE', "大小");
define('_DML_EXT', "副檔名");
define('_DML_MIME', "Mime 類型");
define('_DML_THUMBNAIL', "縮圖");
define('_DML_DESCRIPTION', "描述:");
define('_DML_VERSION', "版本");
define('_DML_DEFAULT', "預設");
define('_DML_FOLDER', "文件夾");
define('_DML_FOLDERS', "文件夾");
define('_DML_FILE', "文件");
define('_DML_FILES', "文件");
define('_DML_URL', "URL");
define('_DML_PARAMS', "參數");
define('_DML_PARAMETERS', "參數");
define('_DML_TOP', "Top");
define('_DML_PROPERTY', "文件屬性");
define('_DML_VALUE', "　　屬性內容");
define('_DML_PATH', "路徑");

define('_DML_DOC', "檔案");
define('_DML_DOCS', "檔案");
define('_DML_DOCUMENT', "檔案");
define('_DML_CAT', "類別");
define('_DML_CATS', "類別");
define('_DML_CATEGORY', "類別");

define('_DML_UPLOAD', "上傳");
define('_DML_SECURITY', "安全");
define('_DML_CPANEL', "DOCMan 控制面板");
define('_DML_CONFIG', "配置");
define('_DML_LICENSE', "許可");
define('_DML_LICENSES', "許可");
define('_DML_UPDATES', "更新");
define('_DML_DOWNLOADS', "下載");

define('_DML_HOMEPAGE', "檔案來源");

define('_DML_NO', "否");
define('_DML_YES', "是");
define('_DML_OK', "OK");
define('_DML_CANCEL', "取消");
define('_DML_ADD', "新增");
define('_DML_EDIT', "編輯");
define('_DML_CONTINUE', "繼續");
define('_DML_SAVE', "儲存");

define('_DML_APPROVED', "審核");
define('_DML_DELETED', "刪除");

define('_DML_INSTALL', "安裝");
define('_DML_PUBLISHED', "發佈");
define('_DML_UNPUBLISH', "取消發佈");
define('_DML_CHECKED_OUT', "取出");

define('_DML_TOOLTIP', "即時說明");
define('_DML_FILTER_NAME', "過濾名稱");

define('_DML_TITLE', "標題");
define('_DML_MULTIPLE_SELECTS', "Windows/Unix/Linux請按住<b>Ctrl</b>鍵，Mac用戶請按住<b>Command</b>鍵進行選擇.");

define('_DML_USER', "用戶");
define('_DML_OWNER', "允許檢閱");
define('_DML_CREATOR', "創建者");
define('_DML_EDITOR', "維護者");
define('_DML_MAINTAINER', "維護者");
define('_DML_UNKNOWN', "未知");

define('_DML_FILEICON_ALT', "文件圖標"); 

define('_DML_NOT_AUTHORIZED', "未經授權");
define('_DML_ERROR', "錯誤");
define('_DML_OPERATION_FAILED', "操作失敗");

define('_DML_EDIT_THIS_MODULE', "編輯模組");
define('_DML_UNPUBLISH_THIS_MODULE', "取消發佈模組");
define('_DML_ORDER_THIS_MODULE', "模組順序");

define('_DML_WRITABLE', "可寫入");
define('_DML_UNWRITABLE', "不可寫入");

define('_DML_SAVED_CHANGES', "儲存修改");
define('_DML_ARE_YOU_SURE', "是否確定?");


// -- HTML Class
define('_DML_SELECT_CAT', "選擇類別");
define('_DML_SELECT_DOC', "選擇檔案(Doc)");
define('_DML_SELECT_FILE', "選擇檔案(File)");
define('_DML_ALL_CATS', "- 所有分類");
define('_DML_SELECT_USER', "選擇用戶");
define('_DML_GENERAL', "常規");
define('_DML_GROUPS', "群組");
define('_DML_DOCMAN_GROUPS', "Docman 群組");
define('_DML_MAMBO_GROUPS', "Mambo 群組");
define('_DML_JOOMLA_GROUPS', "Joomla! 群組"); // alias
define('_DML_USERS', "用戶");
define('_DML_EVERYBODY', "任何人");
define('_DML_ALL_REGISTERED', "所有註冊用戶");
define('_DML_NO_USER_ACCESS', "無用戶入口");
define('_DML_AUTO_APPROVE', "自動核准");
define('_DML_AUTO_PUBLISH', "自動發佈");
define('_DML_GROUP', "群組");
define('_DML_GROUP_PUBLISHER', "出版者");
define('_DML_GROUP_EDITOR', "編輯者");
define('_DML_GROUP_AUTHOR', "作者");

// -- File Class
define('_DML_OPTION_HTTP', "從你的電腦中上傳檔案");
define('_DML_OPTION_XFER', "從其它網站上傳檔案");
define('_DML_OPTION_LINK', "連結其他網站的檔案");
define('_DML_SIZEEXCEEDS', "檔案容量最大限制.");
define('_DML_ONLYPARTIAL', "只接收到部分文件，請重試.");
define('_DML_NOUPLOADED', "未上傳檔案.");
define('_DML_TRANSFERERROR', "轉移過程出現錯誤");
define('_DML_DIRPROBLEM', "目錄錯誤. 不能移動文件.");
define('_DML_DIRPROBLEM2', "目錄錯誤");
define('_DML_COULDNOTCONNECT', "無法連接主機");
define('_DML_COULDNOTOPEN', "不能打開目標目錄。請檢查您的權限.");
define('_DML_FILETYPE', "文件類型");
define('_DML_NOTPERMITED', "未許可");
define('_DML_EMPTY', "無");

define('_DML_ALREADYEXISTS', "已經存在.");
define('_DML_PROTOCOL', "協議");
define('_DML_NOTSUPPORTED', "不支持.");
define('_DML_NOFILENAME', "未指定文件名.");
define('_DML_FILENAME', "文件名");
define('_DML_CONTAINBLANKS', "包括空格.");
define('_DML_ISNOTVALID', "是無效文件名");
define('_DML_SELECTIMAGE', "選擇圖標");
define('_DML_FAILEDTOCREATEDIR', "創建目錄失敗");
define('_DML_DIRNOTEXISTS', "目錄不存在，不能轉移文件");
define('_DML_TEMPLATEEMPTY', "模板id為空，不能轉移文件");
define('_DML_INTERRORMAMBOT', "內部錯誤：缺乏對應曼波觸發器（mambot）設置");
define('_DML_INTERRORMABOT', _DML_INTERRORMAMBOT); // alias
define('_DML_NOTARGGIVEN', "參數設置不夠");
define('_DML_ARG', "參數");
define('_DML_ISNOTARRAY', "不是一個數組");

define('_DML_NEW', "new!");
define('_DML_HOT', "hot!");

define('_DML_BYTES', "Bytes");
define('_DML_KB', "kB");
define('_DML_MB', "MB");
define('_DML_GB', "GB");
define('_DML_TB', "TB");


// -- Form Validation
define('_DML_ENTRY_ERRORS', "DOCMan系統信息: 請改正下述錯誤:");
define('_DML_ENTRY_TITLE', "請給該項目一個標題.");
define('_DML_ENTRY_NAME', "請給該項目一個名稱.");
define('_DML_ENTRY_DATE', "請給該項目一個日期.");
define('_DML_ENTRY_OWNER', "請給該項目一個擁有者.");
define('_DML_ENTRY_CAT', "請給該項目一個分類.");
define('_DML_ENTRY_DOC', "請給該項目一個可選擇的檔案.");
define('_DML_ENTRY_MAINT', "請給該項目一個指定的維護者.");

define('_DML_ENTRY_DOCLINK_LINK', "檔案必須有連結(連結至詳細說明裡的檔案)");
define('_DML_ENTRY_DOCLINK', "檔案同時對應一個文件名和連結至詳細說明裡的檔案.");
define('_DML_ENTRY_DOCLINK_PROTOCOL', "未知連結至詳細說明裡的檔案的協議");
define('_DML_ENTRY_DOCLINK_NAME', "詳細說明裡的檔案需要連結");
define('_DML_ENTRY_DOCLINK_HOST', "需要完整的位址（URL）");
define('_DML_ENTRY_DOCLINK_INVALID', "沒有找到符合的文件");
define('_DML_FILENAME_REQUIRED', "檔案名稱必須填寫");

// Missing  constants from J!1.0.x
define('_DML_FILTER', "過濾");
define('_DML_UPDATE', "更新");
define('_DML_SEARCH_ANYWORDS', "任一關鍵字");
define('_DML_SEARCH_ALLWORDS', "所有關鍵字");
define('_DML_SEARCH_PHRASE', "符合完整字詞");
define('_DML_SEARCH_NEWEST', "較新的優先");
define('_DML_SEARCH_OLDEST', "較舊的優先");
define('_DML_SEARCH_POPULAR', "最常見的");
define('_DML_SEARCH_ALPHABETICAL', "依字母次序");
define('_DML_SEARCH_CATEGORY', "依據分類");
define('_DML_SEARCH_MESSAGE', "搜尋關鍵字至少3個字符、最多20個字符");
define('_DML_SEARCH_TITLE', "搜尋");
define('_DML_PROMPT_KEYWORD', "搜尋關鍵字");
define('_DML_SEARCH_MATCHES', "returned %d matches");
define('_DML_NOKEYWORD', "沒有符合的結果");
define('_DML_IGNOREKEYWORD', "一個或多個關鍵字詞已被忽略");
define('_DML_CMN_ORDERING', "排序依據");

// Added DOCman 1.4 RC3
define('_DML_HELP', "Help");

// Added DOCman 1.4.0.stable
define('_DML_DONATE', "Donate");
