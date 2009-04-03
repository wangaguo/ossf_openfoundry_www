<?php
// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
?>
1. 開發日誌
------------

Legend:

* -> 安全性 修正
# -> 程式臭蟲 修正
+ -> 新增
^ -> 更改
- -> 移除
! -> 注意
------------------------------------1.0.12中文穩定版發佈-----------------------------
25-Apr-2007 Eddy
^翻譯TinyMCE未譯之中文字詞
^所視即所得編輯器中的日曆中文化
^調整預設前台佈景之字型大小適合中文顯示
+加入所視即所得編輯器下方的{mosimage}和{mospagebreak}按鈕會依中文更改圖示

24-Apr-2007 Eddy
^加入a仔的TinyMCE中文化修改
#FPDF升級至1.53
#增加官方版本升級檔中缺少檔案

17-Apr-2007 Eddy
#修正安裝時的sql檔內容
#加大管理區字體
^加入中文化日期選擇功能

------------------------------------1.0.12RC1發佈-----------------------------
7-Feb-2007 Eddy
#修正後台trash中未譯字詞
#使用1.0.11後台刪除分類的函式取代1.0.12中的
#使用kochin網友提供之安裝程式更新檔案
	
------------------------------------1.0.12Beta1發佈-----------------------------
7-Jan-2007 Eddy
^前台繁中、簡中語言檔校正，加入新字詞
^校對前台簡中翻譯
^修整部份安裝檔編碼問題
!後台trash翻譯有可能會被覆蓋或功能失常
!後台banner有新字需翻譯
!substr中文斷字問題
	
30-Dec-2006 Eddy
^加入1.0.12官方升級檔
	
------------------------------------1.0.11中文穩定版發佈-----------------------------
4-Oct-2006 Eddy
#翻譯mambot中繁中、簡中語系xml
#修正部份前台繁中語系
#加入中文版本的日期警告於後台

20-Sep-2006 Eddy
#修正RSS 1.0/2.0 編碼為UTF-8
#修正安裝資料庫檔翻譯錯誤
#修正選單模組翻譯錯誤
+加入Mambot可使用不同語系xml檔功能
!所有Mambot尚未加入繁中、簡中語系xml

12-Sep-2006 Eddy
#upload image檔案錯誤，回覆1.0.10，重新再升級
+新增登入時的SESSON有關訊息翻譯
+新增Section的字詞翻譯

5-Sep-2006 Eddy
+新增1.0.11版中的警告視窗翻譯
	
4-Sep-2006 Eddy
#修正ie中的註冊時Javascript錯誤訊息視窗問題
#修正註冊信中的網址連結問題
^更改部份繁體中文語言檔翻譯字詞
--------------------------------------------------------------------------------
31-Aug-2006 A仔
+新增TinyMce 第四列工具列功能, 加入經隱藏功能, 顯示的功能加入到 bot-> tinymce.xml 控制參數.

--------------------------------------------------------------------------------
29-Aug-2006 Eddy
#加入1.0.11官方正式版兩個bugs，相關網址如下：
http://forum.joomla.org/index.php/topic,90039.0.html
^加入1.0.11升級檔案


21-Jul-2006 Eddy
#修正joomla搜尋時的錯誤訊息	
--------------------------------1.0.10stable發佈--------------------------------

	
26-Jul-2006 A仔
#修正TinyMCE 所見即所得編輯器 Table 翻譯直行及橫列錯誤
+加入TinyMCE 所見即所得編輯器 Style, layer 簡繁中文翻譯及功能
	

17-Jul-2006 Eddy
#修正PHP5.1中對XML檔案不能解析UTF-8格式問題
#修正UTF-8轉碼為BIG5、GB2312時，以iconv為主，mb_encoding_convert為第二，big5_func為第三
#修正後台一些沒翻的工具列、字詞
#提高fpdf及big5_func函式庫的目錄安全性
	
	
11-Jul-2006 A仔
#修正 會員 liwenjun com_sections 後台單元項目管理出錯 Line: 190 引入 $mainframe

06-Jul-2006 A仔
#修正後台靜態內容管理出錯 Line: 249 引入 $database 

--------------------------------1.0.10Beta2發佈--------------------------------
03-Jul-2006 Eddy
#修正後台的單元ID譯誤

03-Jul-2006 A仔
+加入簡繁體中文的協助頁面
^加入TinyMCE 所見即所得編輯器簡繁體中文
	
29-Jun-2006 A仔
#修正xml檔案中category_link的參數 是/否 相反
^宣告彈跳視窗語系的屬性
	
-------------------------------1.0.10Beta1發佈---------------------------------
27-Jun-2006
^加入1.0.10版更新檔案
#修正xml檔案中link_titles的參數 是/否 相反
	
11-Jun-2006
^加入1.0.9版更新檔案
	
-------------------------------1.0.8中文版穩定版本發佈-------------------------
12-May-2006
#修正安裝時，未加入configuration.php裡的三個設定值
^合併簡體中文版的資料庫檔案
^修正簡體中文翻譯的未翻譯部份

9-May-2006
^合併繁體中文版的資料庫檔案
-------------------------------1.0.8中文版RC1發佈------------------------------
26-Apr-2006
^修正一些字詞
^修正後台選單中component_item/blog_archive_XXX的javascript錯誤
^修正靜態內容的mosimage儲存錯誤
^修正前台搜尋中文斷字問題
^修正前台觀看blog_archive的問題
	
12-Apr-2006
^修正一些翻譯字詞
!本週要架設中文help伺服器於http://help.joomla.org.tw/

-------------------------------1.0.8中文版beta2發佈------------------------
10-Apr-2006
-移除spanish語言檔
	
10-Apr-2006
+所有模組參數值翻譯完成
^修正一些翻譯字詞

4-Apr-2006
+選單項目翻譯XML工作完成
^"新聞聯播"改為"RSS新聞聯播"
^修正一些翻譯字詞
	
17-Mar-2006
+選單項目的翻譯XML工作，內容相關部份完成。（尚有嵌入器、網站連結、新聞聯播部份未完成）
!注意內容管理最下方解釋圖示還需翻譯
	
16-Mar-2006
#修正com_registration中兩個mosmsg的bug
+進行選單項目的翻譯xml檔，尚未完成。
!發現前台搜尋結果有中文斷字問題。
	
15-Mar-2006
+新增xml參數檔依非英語語系時，檔案會尋找加上語系檔案結尾的xml檔案。
#廣告看板語言及引用語言翻譯問題錯誤
^連絡人參數檔引用中文的xml
^新聞聯播管理引用xml問題
+進行選單項目的翻譯xml檔，目前翻譯了前四個。

13-Mar-2006
^更改網站最下方版權規定(version.php)
#修改靜態內容管理的語法錯誤
^修改所有範例文章為中文，除了範例新聞尚未更改（將影響範例sql檔案）
^修改所有模組、選單對應名詞（將影響範例sql檔案）

26-Feb-2006
^升級至1.0.8修正更檔案
#在javascript alert function前加入php header強制使用utf-8

---------------------------------1.0.7 Chinese version release--------------
17-Jan-2006
^Upgrade 1.0.7 patch (Include 1.0.5 to 1.0.6 patch)
#Fix the administrator/popup/uploadimage.php bug.
#Fix joomla.php function_exists bugs.
+Add utf-8 library for utf-8 string handler.

---------------------------------1.0.5(fixed 20060103) Chinese version release--------------
3-Jan-2006
#Fix the administrator/components/com_content/ bug.
#Fix joomla.php if bugs.
+Add function_exists(mb_convert_encoding) to check if mbstring library installed.

---------------------------------1.0.5 Chinese version release------------------------------
27-Dec-2005 seafone & EddyChang
^Simpified Chinese language phrases change

26-Dec-2005 EddyChang
^Upgrade 1.0.5 patch

---------------------------------1.0.4 Chinese version release------------------------------
12-Dec-2005 EddyChang
#fromname encode UTF-8 to TC/SC in mosMail

^Change all rss feed to UTF-8 encode

+Add PDF feature for output chinese font

#Fatal error: Call to a member function on a non-object in/home/joomla/public_html/natural_home/administrator/components/
com_menus/admin.menus.php on line 472


10-Dec-2005 EddyChang
^Upgrade 1.0.4 patch (Included components/ and administrator/)


30-Nov-2005 EddyChang
^Upgrade 1.0.4 patch (Excluded components/ and administrator/)

---------------------------------1.0beta release---------------------------------------------
24-Oct-2005 EddyChang
^Change the install sql to Traditional/Simplified Chinese
^Modify mosCreateMail to detect the language and covert the encode UTF-8  to BIG5/GB2312
^Modify mosCurrentDate and mosFormatDate

24-Oct-2005 EddyChang
+Traditional/Simplified Chinese language file for Backend
+Simplified Chinese language file for Installation
^Fixed mosRedirect utf-8 bugs


20-Oct-2005 EddyChang
^(Remind)The Location setting need to detect windows(to cht_twn) or unix-like(to zh_TW) server

20-Oct-2005 EddyChang
^All installation file is ok for UTF-8
+Traditional Chines language file for installation

19-Oct-2005 EddyChang
^Files in Installation folder change to UTF-8 encode(HTML/XML charset & SQL files).

^template rhuk_solarflare_ii meta charset move above <?php mosShowHead(); ?>

^backend template joomla_admin meta charset move above page title
---------------- 1.0.3 Released -- [14-Oct-2005 10:00 UTC] ------------------

?>