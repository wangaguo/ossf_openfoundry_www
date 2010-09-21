<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: traditional_chinese.backend.php 765 2009-01-05 20:55:57Z mathias $
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

// -- Toolbar
define('_DML_TOOLBAR_SAVE', "儲存");
define('_DML_TOOLBAR_CANCEL', "取消");
define('_DML_TOOLBAR_NEW', "新增");
define('_DML_TOOLBAR_NEW_DOC', "新檔案");
define('_DML_TOOLBAR_HOME', "控制面版");
define('_DML_TOOLBAR_UPLOAD', "上傳");
define('_DML_TOOLBAR_MOVE', "移動");
define('_DML_TOOLBAR_COPY', "複製");
define('_DML_TOOLBAR_SEND', "傳送");
define('_DML_TOOLBAR_BACK', "返回");
define('_DML_TOOLBAR_PUBLISH', "發佈");
define('_DML_TOOLBAR_UNPUBLISH', "取消發佈");
define('_DML_TOOLBAR_DEFAULT', "預設");
define('_DML_TOOLBAR_DELETE', "刪除");
define('_DML_TOOLBAR_CLEAR', "清除");
define('_DML_TOOLBAR_EDIT', "編輯");
define('_DML_TOOLBAR_EDIT_CSS', "編輯 CSS");
define('_DML_TOOLBAR_APPLY', "套用");


// -- Files
define('_DML_ORPHANS', "未發佈檔案");
define('_DML_ORPHANS_LINKED', "文件未被刪除。不能刪除連結到檔案的文件.");
define('_DML_ORPHANS_PROBLEM', "文件未被刪除。文件權限出錯。");
define('_DML_ORPHANS_DELETED', "已刪除的文件.");
define('_DML_LINKS', "連結");
define('_DML_NEXT', "下一步");
define('_DML_SUCCESS', "成功！");
define('_DML_UPLOADMORE', "上傳更多");
define('_DML_UPLOADWIZARD', "上傳導引");
define('_DML_UPLOADMETHOD', "選擇上傳模式");
define('_DML_ISUPLOADING', "DOCMan 正在上傳");
define('_DML_PLEASEWAIT', "請稍候");
define('_DML_UPLOADDISK', "上傳導引 - 從你的電腦中上傳一個文件");
define('_DML_FILETOUPLOAD', "選擇要上傳的文件");
define('_DML_BATCHMODE', "批次處理模式");
define('_DML_BATCHMODETT', "以批次處理模式上傳一個包含多個文件的壓縮包。請注意壓縮包內不能包含目錄或子目錄。請務必謹慎操作，因為這一過程將覆蓋遠端檔案目錄中的同名文件。");
define('_DML_DOCMANISTRANSF', "DOCMan正在轉移<br />文件");
define('_DML_TRANSFERFROMWEB', _DML_UPLOADWIZARD." - "."從一個網站轉移一個文件");
define('_DML_REMOTEURL', "URL 位址");
define('_DML_LINKURLTT', "輸入 URL 位址。位址必須完整（包含http:// 或 ftp://），如：http://mamboforge.net/frs/download.php/2026/docmanV1.3.zip.");
define('_DML_REMOTEURLTT', _DML_LINKURLTT . "<br />你可以透過以下方式將文件另外命名&quot;本地名稱（Local Name）&quot; 字段（field）.");
define('_DML_LOCALNAME', "本地名稱");
define('_DML_LOCALNAMETT', "輸入你想要存儲的文件的本地名稱."
     . "因為位址（URL）沒有給出該檔案足夠的信息，該字段是必須增加的。");
define('_DML_DOCUPDATED', "檔案已更新.");
define('_DML_FILEUPLOADED', "文件已上傳");
define('_DML_MAKENEWENTRY', "使用該文件增加一個新的檔案項目");
define('_DML_DISPLAYFILES', "顯示文件。");
define('_DML_ALLFILES', "所有文件");
define('_DML_DOCFILES', "檔案庫所有文件");
define('_DML_CREATEALINK', "建立一個已連結的檔案");
define('_DML_SELECTMETHODFIRST', "請選擇一個檔案轉移模式");
define('_DML_ERROR_UPLOADING', "上傳錯誤.");
define('_DML_ZLIB_ERROR', "因為在php缺乏必要的zlib庫，不能進行該項操作。");
define('_DML_UNZIP_ERROR', "無法解壓文件.");
define('_DML_SUBMIT', "提交");
define('_DML_NEW_FILE', "新文件");
define('_DML_MAKE_SELECTION', "請從列表中選取.");

// -- Documents
define('_DML_MOVECAT', "移動分類目錄");
define('_DML_MOVETOCAT', "移至..分類目錄");
define('_DML_DOCSMOVED', "檔案已轉移");
define('_DML_COPYCAT', "複製分類目錄");
define('_DML_COPYTOCAT', "複製到..分類目錄");
define('_DML_COPY_OF', "副本"); // Copy of [document name]
define('_DML_DOCSCOPIED', "檔案已複製");
define('_DML_DOCS_NOT_APPROVED', "檔案未通過審核");
define('_DML_DOCS_NOT_PUBLISHED', "檔案未發佈");
define('_DML_NO_PENDING_DOCS', "待審核檔案.");
define('_DML_FILE_MISSING', "***文件不存在***");
define('_DML_YOU_MUST_UPLOAD', "你必須先為該單元上傳一個檔案.");
define('_DML_THE_MODULE', "模組");
define('_DML_IS_BEING', "正在被另一個管理員編輯");
define('_DML_NO_LICENSE', "無授權");
define('_DML_LINKED', "->已連結檔案<-");
define('_DML_CURRENT', "當前的");
define('_DML_LICENSE_TYPE', "授權類型");
define('_DML_FILETITLE', "文件標題");
define('_DML_OWNER_TOOLTIP', "這將決定誰能下載和和檢閱該檔案。請選擇："
     . "*任何人*——如果你希望任何人都能夠存取和瀏覽該檔案。 "
     . "*所有註冊用戶* 只允許註冊用戶存取和瀏覽該檔案. "
     . "你可以把該檔案指定給特定的註冊用戶，請通過" . _DML_USERS . "選擇一個註冊名; "
     . "把該檔案指定給某個用戶。 "
     . "你可以把該檔案指定給特定的用戶組，請通過" . _DML_GROUPS ."選擇;"
     . "把該檔案指定給某個用戶組.");
define('_MANT_TOOLTIP', "這將決定誰能編輯或維護該檔案. "
     . "當一個註冊用戶或一個用戶組已被指定為一個檔案的" . _DML_MAINTAINER ."，則意味著他們擁有該檔案的以下操作權限：編輯，更新，移動，簽入（提交審核）/簽出（審核通過），和刪除。");
define('_DML_MAKE_SURE', "URL 位址一定要包含' http:// '");
define('_DML_DOCURL', "檔案位址：");
define('_DML_DOCURL_TOOLTIP', "當你有一個已連結檔案時，你必須輸入該檔案的 URL 位址。URL 位址必須包含有(http:// 或 ftp://)");
define('_DML_HOMEPAGE_TOOLTIP', "你可以為這個檔案輸入一個有該檔案信息的 URL 位址。URL 位址一定要包含「http://」");
define('_DML_LICENSE_TOOLTIP', "一個檔案可以擁有一個授權，用戶只有同意該協議才能瀏覽或下載該檔案。你可以在此定義許可類型。");
define('_DML_DISPLAY_LICENSE', "瀏覽時顯示授權");
define('_DML_DISPLAY_LIC_TOOLTIP', "選擇「是」，如果你希望用戶獲得該檔案權限前顯示該協議");
define('_DML_APPROVED_TOOLTIP', "一個檔案須經通過審核才能顯示和儲存到文件庫。選擇「是」，並且請記得發佈該檔案！");
define('_DML_PLEASE_SEL_CAT', "請首先定義一個種類");
define('_DML_MANT_TOOLTIP', "這個項目用來設置編輯、維護檔案的人員. "
     . "當一個檔案屬於此用戶或群組成員" . _DML_MAINTAINER . "意味著他們能使用特別的檔案管理選項: 編輯, 更新, 移動, 放回/取出和刪除.");
define('_DML_DISPLAY_LIC', "顯示協議");

define('_DML_TAB_PERMISSIONS', "權限");
define('_DML_TAB_LICENSE', "授權");
define('_DML_TAB_DETAILS', "其他細節");
define('_DML_TAB_PARAMS', "參數");

define('_DML_TITLE_DOCINFORMATION', "文件資訊");
define('_DML_TITLE_DOCPERMISSIONS', "文件權限");
define('_DML_TITLE_DOCLICENSES', "文件授權");
define('_DML_TITLE_DOCDETAILS', "文件細節");
define('_DML_TITLE_DOCPARAMETERS', "文件參數");

define('_DML_CREATED_BY', "創建由");
define('_DML_UPDATED_BY', "最後更新");
define('_DML_SELECT_ITEM_DEL', "選擇一個項目刪除");
define('_DML_SELECT_ITEM_MOVE', "選擇一個項目移動");
define('_DML_SELECT_ITEM_COPY', "選擇一個項目複製");
define('_STATUS_YOU', "該檔案已通過您的審核。");
define('_STATUS_NOT_OUT', "該檔案未通過您的審核。");
define('_DML_NEW_DOCUMENT', "新檔案");
define('_DML_DOCUMENTS_MOVED_TO', "檔案移動到.."); // [Number of] Documents moved to [location]
define('_DML_DOCUMENTS_COPIED_TO', "檔案複製到.."); // [Number of] Documents moved to [location]


// -- Categories
define('_DML_CATDETAILS', "分類明細");
define('_DML_CATTITLE', "分類標題");
define('_DML_CATNAME', "分類名稱");
define('_DML_LONGNAME', "在標題裡顯示全名");
define('_DML_PARENTITEM', "上級分類");
define('_DML_IMAGE', "圖像");
define('_DML_PREVIEW', "預覽");
define('_DML_IMAGEPOS', "圖像位置");
define('_DML_ORDERING', "排序");
define('_DML_ACCESSLEVEL', "訪問級別");
define('_DML_CREATEMENUITEM', "這將在你選擇的選單中生成一個新的選單項目");
define('_DML_SELECTMENU', "選擇一個選單");
define('_DML_SELECTMENUTYPE', "選擇一個選單類型");
define('_DML_MENUITEMNAME', "選單項目名稱");
define('_DML_SELECTCATTO', "選擇一個分類到..");
define('_DML_SELECTCATTODELETE', "選擇要刪除的分類");
define('_DML_REORDER', "排序");
define('_DML_ACCESS', "訪問");
define('_DML_CAT_MUST_SELECT_NAME', "分類必須有一個名稱");
define('_DML_CATS_CANT_BE_REMOVED', "無法刪除. 這個項目下仍有其他子類別");

// -- Groups
define('_DML_TITLE_GROUPS', "群組");
define('_DML_CANNOT_DEL_GROUP', "不能馬上刪除一個擁有文件的群組.");
define('_DML_USERS_AVAILABLE', "可以訪問的用戶");
define('_DML_MEMBERS_IN_GROUP', "群組成員");
define('_DML_ADD_GROUP_TIP', "雙擊用戶名或選擇該用戶,使用箭頭新增/刪除一個用戶成員. "
     . "一次選擇超過一個用戶, " . _DML_MULTIPLE_SELECTS);
define('_DML_ADDING_USERS', "新增用戶成員到群組。");
define('_DML_FILL_FORM', "請正確填寫表單");
define('_DML_ONLY_ADMIN_EMAIL', "只有超級管理員能群發 E-mail！");
define('_DML_NO_TARGET_EMAIL', "在這個群組中，所有用戶的郵件地址都無效。");
define('_DML_THIS_IS', "這個 E-mail 來自於");
define('_DML_SENT_BY', "由 DOCMan 發送給檔案群組成員");
define('_DML_EMAIL_SENT_TO', "E-mail 發送到");
define('_DML_MEMBERS', "成員");
define('_DML_EMAIL', "E-mail");
define('_DML_USER_BLOCKED', "封鎖");

// -- Licenses
define('_DML_LICENSE_TEXT', "授權內容");
define('_DML_CANNOT_DEL_LICENSE', "一個檔案正在使用授權文件，因此無法刪除.");


// -- Config
define('_DML_FRONTEND', "前台");
define('_DML_PERMISSIONS', "權限");
define('_DML_RESETDEFAULT', "重置");
define('_DML_ASCENDENT', "上升");
define('_DML_DESCENDENT', "下降");

define('_DML_CONFIGURATION', "DOCMan 系統設定");
define('_DML_CONFIG_UPDATED', "系統設定資料已經被更新.");
define('_DML_CONFIG_WARNING', "警告: 上傳的最大文件大小如果超過PHP允許的最大量，配置將不會更新: ");
define('_DML_CONFIG_ERROR', "發生錯誤，系統設定文件不可寫入!");
define('_DML_CONFIG_ERROR_UPLOAD', "錯誤: 上傳的最大的文件大小不能為負。");

define('_DML_CFG_DOCMANTT', "DOCMan 工具提示...");
define('_DML_CFG_ALLOWBLANKS', "允許空白");
define('_DML_CFG_REJECT', "拒絕");
define('_DML_CFG_CONVERTUNDER', "轉換成底線");
define('_DML_CFG_CONVERTDASH', "轉換成破折號");
define('_DML_CFG_REMOVEBLANKS', "移動空白");
define('_DML_CFG_PATHFORSTORING', "儲存文件的路徑");
define('_DML_CFG_PATHTT', "這裡你應該指定儲存文件的本地目錄. 請填寫絕對路徑. 你可以使用預設值, 或者，如果你更喜歡自定一個不同的目錄, 在這裡輸入完整的目錄路徑.<br /><br />"
     . "如, Linux 服務器中可以用如下路徑：/var/usr/www/dmdocuments<br /><br />"
     . "如果你使用的是 Windows 服務器，你可以使用如下路徑：c:/inetpub/www/dmdocuments");
define('_DML_CFG_SECTIONISDOWN', "關閉檔案庫?");
define('_DML_CFG_SECTIONTT', "如果你要取消用戶訪問檔案庫的權限，請將選項設為「是」。<br />"
     . "這將有助於檢查或升級檔案庫<br /><br />"
     . "即使關閉檔案庫，管理員和特殊用戶仍能具備訪問權限<br />"
    );
define('_DML_CFG_NUMBEROFDOCS', "每頁顯示的檔案數");
define('_DML_CFG_NUMBERTT', "每頁顯示的檔案數。如果檔案總數比你的設定數大。將出現分頁標號.");

define('_DML_CFG_GUEST', "訪客");
define('_DML_CFG_GUEST_NO', "無權限");
define('_DML_CFG_GUEST_X', "僅瀏覽");
define('_DML_CFG_GUEST_RX', "瀏覽, 下載和查看");
define('_DML_CFG_GUEST_TT', "這個項目用來設置訪客(非註冊用戶)的權限: <br />*"
     . _DML_CFG_GUEST_NO . "* 訪問所有檔案<br />*"
     . _DML_CFG_GUEST_X . "* 允許用戶看到但是不能訪問. <br />*"
     . _DML_CFG_GUEST_RX . "* 允許用戶看到並且能夠訪問."
     . "<br /><br />這個權限是除個人專有的檔案外能訪問的權限."
     . "</span>");

define('_DML_CFG_AUTHOR_NONE', "不能訪問");
define('_DML_CFG_AUTHOR_READ', "僅供下載");
define('_DML_CFG_AUTHOR_BOTH', "下載並編輯");

define('_DML_CFG_ICONSIZE', "圖標大小");
define('_DML_CFG_DAYSFORNEW', "幾天內為最新下載");
define('_DML_CFG_DAYSFORNEWTT', "設置幾天內為文件標記為最新下載。這將在檔案名稱後增加*" . _DML_NEW . "*標記。如果該值設為零，則不出現該標記");
define('_DML_CFG_HOT', "熱門下載所需下載次數");
define('_DML_CFG_HOTTT', "成為熱門下載檔案必須達到的下載次數。這將在檔案名稱後增加*" . _DML_HOT . "*標記。如果該值設為零，則不出現該標記.");
define('_DML_CFG_DISPLAYLICENSES', "顯示授權?");

define('_DML_CFG_VIEW', "查看");
define('_DML_CFG_VIEWTT', "本選項設置默認能下載並查看檔案的用戶/群組. 可以不做考慮.");
define('_DML_CFG_MAINTAIN', "維護");
define('_DML_CFG_MAINTAINTT', "此項設置能夠維護檔案的默認用戶/群組. 可以不設置.");
define('_DML_CFG_CREATORS_PERM', "創建者能");
define('_DML_CFG_CREATORSPERMTT', "此項為總體設置檔案創立者有什麼權限.<br /><br />"
     . "此項是除了檔案的瀏覽及維護者的權限之外的許可.");
define('_DML_CFG_WHOCANAREADER', "下載");
define('_DML_CFG_WHOCANAREADERTT', "此項決定檔案創建者/維護者是否能更改查看檔案的的用戶.<br /><br />"
     . "N.B.: 管理員通常被授予了查看權限.");
define('_DML_CFG_WHOCANAEDITOR', "編輯");
define('_DML_CFG_WHOCANAEDITORTT', "此項決定檔案創建者/維護者是否能更改維護檔案的的用戶.<br /><br />"
     . "N.B.: 管理員能選擇一個維護者.");

define('_DML_CFG_EMAILGROUP', "給群組用戶發 E-mail?");
define('_DML_CFG_EMAILGROUPTT', "如果 *是* 第一選項選 *是*, 則在每個檔案中顯示其所有者的連結，允許用戶發 E-mail 給所有的在這個群組中的其它的用戶討論.");

define('_DML_CFG_UPLOAD', "上傳");
define('_DML_CFG_UPLOADTT', "這項你可以設置能上傳的用戶/群組. 它控制所有的上傳方法: http, 連結及移動");
define('_DML_CFG_APPROVE', "審核通過");
define('_DML_CFG_APPROVETT', "設置能審核檔案的用戶/群組.<br />檔案在使用之前必須審核通過並且發佈.");
define('_DML_CFG_PUBLISH', "發佈");
define('_DML_CFG_PUBLISHTT', "設置能發佈檔案的用戶/群組.<br />檔案在使用之前必須審核通過並且發佈.");
define('_DML_CFG_USER_UPLOAD', "選擇能上傳的人");
define('_DML_CFG_USER_APPROVE', "選擇能審核的人");
define('_DML_CFG_USER_PUBLISH', "選擇能發佈的人");

define('_DML_CFG_EXTALLOWED', "允許的擴展名");
define('_DML_CFG_EXTALLOWEDTT', "允許的檔案格式, 用|隔開. 後台用戶能上傳所有文件.");
define('_DML_CFG_MAXFILESIZE', "允許上傳的最大文件容量");
define('_DML_CFG_MAXFILESIZETT', "前台允許上傳的最大文件容量. 在項目中你可以使用K/M/G等快捷方式.<br />這項限定並不應用於後台（管理區）. <br /><hr />所有上傳設置都遵從 PHP 設定值。 ");
define('_DML_CFG_USERCANUPLOAD', "允許用戶上傳所有的文件類型?");
define('_DML_CFG_USERCANUPLOADTT', "如果選 *是* 之前的*用戶上傳* 選 *是*, 系統將忽略以上的設定，註冊用戶能上傳所有類型的文件.");
define('_DML_CFG_OVERWRITEFILES', "覆蓋文件?");
define('_DML_CFG_OVERWRITEFILESTT', "如果選是，如果有文件名稱重覆，檔案將覆蓋上傳.");
define('_DML_CFG_LOWERCASE', "小寫字母的名字?");
define('_DML_CFG_LOWERCASETT', "如果選 *是*, 上傳的文件名自動變更為小寫字母, 例如&nbsp;YourFile.TXT 變更為 yourfile.txt.<br />如果選 *否*, 文件名將不變.");
define('_DML_CFG_FILENAMEBLANKS', "文件名包含空格");
define('_DML_CFG_FILENAMEBLANKSTT', "處理的文件名包含空格:<br />"
     . "*允許空格* 將連同空格一同保存.<br />"
     . "*拒絕* 將不允許文件上傳.<br /><br />"
     . "也可以轉換空格為底線 (_), 破折號 (-) 或從文件名中刪除空格.");
define('_DML_CFG_REJECTFILENAMES', "非法文件名");
define('_DML_CFG_REJECTFILENAMESTT', "輸入不允許上傳的文件名列表, 用豎線分開(|). 這些是具有特殊意義的文件名. <br />你也可以在 | 符號 到 結束文件名使用正規的包含討厭字符(例如: * $ ?)的表達式.");
define('_DML_CFG_UPMETHODS', "上傳方法?");
define('_DML_CFG_UPMETHODSTT', "選擇用戶能用的所有的方法. 對於多種方法, " . _DML_MULTIPLE_SELECTS);

define('_DML_CFG_ANTILEECH', "防盜鏈系統?");
define('_DML_CFG_ANTILEECHTT', "防盜鏈系統防止未被授權的用戶連結到你的檔案. "
     . "當設置選中的每一項為*是*，看是否選中下載/查看 "
     . "(HTTP 提交)來源於從一個\'允許的網站\' 目錄. 如果選否，訪問將被拒絕. "
     . "這項是為了防止其它的網站使用你的網站上的檔案庫.<br /><br />"
     . "N.B. DocMAN 支持兩個網站的連結. "
     . "如果你使用連結, 請確保來源網站包含在網站\'允許的網站\'目錄中."
    );
define('_DML_CFG_ALLOWEDHOSTS', "允許的網站");
define('_DML_CFG_ALLOWEDHOSTSTT', "當防盜鏈系統運行時能請求檔案的網站目錄. 如果你想多個網站能夠訪問這些文件, 輸入名稱，用豎線(|)隔開.<br />默認值通常是安全的.");

define('_DML_CFG_LOG', "日誌瀏覽?");
define('_DML_CFG_LOGTT', "它記錄 IP 位址, 日期和時間，及查看的檔案名. "
     . "激活這個設置後，可以給數據庫增加許多資料.<hr />"
     . "Mambots對附加日誌功能可用.");

define('_DML_CFG_UPDATESERVER', "更新服務器");
define('_DML_CFG_UPDATESERVERTT', "DOCMan 可在線升級。升級中會增加模組、組件、觸發器，甚至數據庫！如果 DOCMan 主機位址已改變，請輸入 DOCMan 升級位址。否則不必改變。.");
define('_DML_CFG_DEFAULTLISTING', "預設列表排序");
define('_DML_CFG_TRIMWHITESPACE', "整理頭尾的空白");
define('_DML_CFG_TRIMWHITESPACETT', "選擇此項整理代碼和節省網路頻寬");

define('_DML_CFG_ERR_DOCPATH', 'Tab [' . _DML_GENERAL . '] \'' . _DML_CFG_PATHFORSTORING . '\' 必須設置.');
define('_DML_CFG_ERR_PERPAGE', 'Tab [' . _DML_FRONTEND . '] \'' . _DML_CFG_NUMBEROFDOCS . '\' 必須是大於0的數');
define('_DML_CFG_ERR_NEW', 'Tab [' . _DML_FRONTEND . '] \'' . _DML_CFG_DAYSFORNEW . '\' 必須是大於等於0');
define('_DML_CFG_ERR_HOT', 'Tab [' . _DML_FRONTEND . '] \'' . _DML_CFG_HOT . '\' 必須是大於等於0');
define('_DML_CFG_ERR_UPLOAD', 'Tab [' . _DML_PERMISSIONS . '] \'' . _DML_CFG_UPLOAD . '\': 選擇能上傳檔案的人.');
define('_DML_CFG_ERR_APPROVE', 'Tab [' . _DML_PERMISSIONS . '] \'' . _DML_CFG_APPROVE . '\': 選擇能審核檔案的人.');
define('_DML_CFG_ERR_DOWNLOAD', 'Tab [' . _DML_PERMISSIONS . '] \'' . _DML_CFG_VIEW . '\': 選擇預設的用戶/群組.');
define('_DML_CFG_ERR_EDIT', 'Tab [' . _DML_PERMISSIONS . '] \'' . _DML_CFG_MAINTAIN . '\': 選擇一個預設維護檔案的用戶/群組');
define('_DML_CFG_EXTENSIONSVIEWING', "能被查看的文件擴展名");
define('_DML_CFG_EXTENSIONSVIEWINGTT', "能被查看的文件擴展名. 留空表示沒有, * 表示所有. 用 | 分開兩個類型 (txt|pdf).");

define('_DML_CFG_GENERALSET', "一般設定");
define('_DML_CFG_THEMES', "模板");
define('_DML_CFG_EXTRADOCINFO', "額外檔案資訊");
define('_DML_CFG_GUESTPERM', "訪客權限");
define('_DML_CFG_FRONTPERM', "前台權限");
define('_DML_CFG_DOCPERM', "檔案權限");
define('_DML_CFG_OVERRIDEVIEW', "允許變更瀏覽權限");
define('_DML_CFG_OVERRIDEMANT', "允許變更維護權限");
define('_DML_CFG_CREATORPERM', "創建者權限");
define('_DML_CFG_FILEXTENSIONS', "檔案擴展名");
define('_DML_CFG_FILENAMES', "檔案名稱");

define('_DML_CFG_PROCESS_BOTS', "內容使用自動化程式?");
define('_DML_CFG_PROCESS_BOTSTT', "在檔案或分類說明中使用自動化程式.這個設定允許你在說明內容中使用{標籤}. *警告* 不是所有的情況下,自動化程式都一定能正常運作.");
define('_DML_CFG_INDIVIDUAL_PERM', "允許個別用戶");
define('_DML_CFG_INDIVIDUAL_PERMTT', "當這個選項關閉時，你仍然能把授權分發給一個群組，但是無法將授權分發給個別用戶. 你現有的檔案權限將被保存, 但是當你編輯一個被別配給個別用戶的檔案時, 你必須改為選擇一個使用者群組. 當用戶流量較大時, 關閉這個選項可以改善工作效能. ");
define('_DML_CFG_HIDE_REMOTE', "隱藏遠端連結");
define('_DML_CFG_HIDE_REMOTETT', "這個選項用來隱藏檔案詳細內容裡的遠端檔案連結. 允許編輯的用戶仍然可以看到這個連結. *注意* 這絕對無法對遠端連結達到的完整的保護. 用戶仍然可以找到檔案的遠端位置.");

// -- Statistics
define('_DML_STATS', "統計");
define('_DML_DOCSTATS', "DOCMan 統計 -  前 50 個熱門下載");
define('_DML_RANK', "排名");

// -- Logs
define('_DML_DOWNLOAD_LOGS', "下載日誌");
define('_DML_IP', "IP");
define('_DML_BROWSER', "瀏覽者");
define('_DML_OS', "操作系統");
define('_DML_ANONYMOUS', "匿名");

// -- Updates
define('_DML_UPGRADE', "升級");
define('_DML_YOU_HAVE_VERSION', "您的版本");
define('_DML_UPTODATE', "您的版本已已更新.");
define('_DML_NO_UP_AVAIL', "暫無新版本可升級.");
define('_DML_COULD_NOT_COPY', "無法拷貝所有文件至目標目錄。請檢查目錄權限。拷貝中止");
define('_DML_UPDATING_DB', "升級數據庫...");
define('_DML_DELETING_OLD', "刪除舊文件...");
define('_DML_ERROR_DELETING_OLD', "刪除舊文件出錯。但並非嚴重錯誤。");
define('_DML_PACKAGE', "壓縮包");
define('_DML_INST_CLICK', "已安裝。請點擊");
define('_DML_HERE', "這裡");
define('_DML_TO_CONT', "繼續");
define('_DML_ERROR_READING', "讀取錯誤");
define('_DML_XML_ERROR', "XML文件無效");
define('_DML_CHECKING_UP', "檢測更新");
define('_DML_RELEASED_ON', "發佈於");

// -- Themes
define('_DML_THEMES', "模板");
define('_DML_EDIT_DEFAULT_THEME', "編輯當前模板");
define('_DML_THEME_INSTALLED', "已安裝的模板");
define('_DML_ADJUST_CONFIG', "更改系統設定");
define('_DML_NEED_ZLIB', "沒有zlib庫，安裝程式無法繼續");
define('_DML_INSTALLER_ERROR', "安裝程式 錯誤");
define('_DML_SUCCESFULLY_INSTALLED', "安裝完成");
define('_DML_ENABLE_FILE_UPLOADS', "檔案上傳必須啟用才能繼續");
define('_DML_UPLOAD_ERROR', "上傳錯誤");
define('_DML_EXTRACT_FAILED', "取出錯誤");
define('_DML_INSTALL_FAILED', "安裝錯誤");
define('_DML_UNINSTALL_FAILED', "反安裝錯誤");
define('_DML_INSTALL_FROM_DIRECTORY', "從目錄安裝");
define('_DML_INSTALL_DIRECTORY', "安裝路徑");
define('_DML_PACKAGE_FILE', "壓縮檔");
define('_DML_UPLOAD_PACKAGE_FILE', "上傳壓縮檔");
define('_DML_UPLOAD_AND_INSTALL', "上傳檔案並安裝");
define('_DML_INSTALL_THEME', "安裝模板");
define('_DML_SELECT_DIRECTORY', "請選擇一個目錄");
define('_DML_SELECT_PACKAGE', "請選擇一個壓縮檔");
define('_DML_STYLESHEET_EDITOR', "模板風格編輯器");
define('_DML_OPFAILED_NO_TEMPLATE', _DML_OPERATION_FAILED.": 沒有指定模板");
define('_DML_OPFAILED_CONTENT_EMPTY', _DML_OPERATION_FAILED.": 沒有內容");
define('_DML_OPFAILED_UNWRITABLE', _DML_OPERATION_FAILED.": 檔案無法寫入");
define('_DML_OPFAILED_CANT_OPEN_FILE', _DML_OPERATION_FAILED.": 檔案寫入錯誤");
define('_DML_OPFAILED_COULDNT_OPEN', _DML_OPERATION_FAILED.": 無法開啟 ");
define('_DML_AUTHOR_URL', "編輯 URL" );
define('_DML_AUTHOR', "著作者" );
define('_DML_INSTALLED_THEMES', "安裝模板");
define('_DML_THEME_DETAILS', "模板詳細內容");
define('_DML_EDIT_THEME', "編輯模板");


// -- E-mail
define('_DML_EMAIL_GROUP', "發送 E-mail 給群組");
define('_DML_SUBJECT', "主旨");
define('_DML_EMAIL_LEADIN', "標題文字");
define('_DML_MESSAGE', "主要訊息");
define('_DML_SEND_EMAIL', "送出");

// -- Credits
define('_DML_CREDITS', "Credits" );
define('_DML_APPLICATION', "Application");
define('_DML_ICONS', "Icons");
define('_DML_ICONS_PERMISSION', "Icons used with permission from" );
define('_DML_CHANGELOG', "Changelog");

// -- Clear Data
define('_DML_CLEARDATA', "刪除記錄" );
define('_DML_CLEARDATA_CLEARED', "記錄已刪除" );
define('_DML_CLEARDATA_FAILED', "刪除發生錯誤" );
define('_DML_CLEARDATA_ITEM', "項目" );
define('_DML_CLEARDATA_CLEAR', "刪除" );
define('_DML_CLEARDATA_CATS_CONTAIN_DOCS', "在刪除分類記錄前請先刪除檔案記錄");
define('_DML_CLEARDATA_DELETE_DOCS_FIRST', "在刪除檔案記錄前請先刪除文件記錄");

// -- Sample data
define('_DML_SAMPLE_CATEGORY', "示範類別" );
define('_DML_SAMPLE_CATEGORY_DESC', "你可以刪除這個示範類別." );
define('_DML_SAMPLE_DOC', "示範檔案" );
define('_DML_SAMPLE_DOC_DESC', "你可以刪除這個示範檔案以及所連結的文件." );
define('_DML_SAMPLE_FILENAME', "sample_file.png" );
define('_DML_SAMPLE_COMPLETED', "加入示範數據完成." );
define('_DML_SAMPLE_GROUP', "示範群組" );
define('_DML_SAMPLE_GROUP_DESC', "你可以透過使用者群組的選項來分配群組權限." );
define('_DML_SAMPLE_LICENSE', "示範授權" );
define('_DML_SAMPLE_LICENSE_DESC', "你可以任意分配檔案的授權." );

// -- Added v1.4.0 RC1
define('_DML_CFG_COMPAT', "同步" );
define('_DML_CFG_SPECIALCOMPATMODE', "&quot;特殊&quot; 同步模式" );
define('_DML_CFG_SPECIALCOMPATMODETT', "In DOCman 1.3 compatibility mode, &quot;Special&quot; users are Managers, Administrators and Super Administrators. In Joomla! mode, this also includes Authors, Publishers and Editors");
define('_DML_CFG_SPECIALCOMPAT_DM13', "DOCman 1.3" );
define('_DML_CFG_SPECIALCOMPAT_J10', "Joomla!" );