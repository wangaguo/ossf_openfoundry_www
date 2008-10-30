<?php
// config.sef.php : configuration file for sh404SEF
// Version_1.3.1 - build_263 - Joomla - <a href="http://extensions.siliana.net/en/">extensions.Siliana.net/en/</a>
// saved at: 2008-03-11 17:48:39
// by:  (id:  )
// domain: http://www.openfoundry.org/ossf

if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

$version = "Version_1.3.1 - build_263 - Joomla - <a href=\"http://extensions.siliana.net/en/\">extensions.Siliana.net/en/</a>";
$Enabled = "1";
$replacement = "-";
$pagerep = "-";
$stripthese = ",|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|�|�|�|�|�|�|�|�|�|�|�|�";
$shReplacements = "�|S, �|O, �|Z, �|s, �|oe, �|z, �|Y, �|Y, �|u, �|A, �|A, �|A, �|A, �|A, �|A, �|A, �|C, �|E, �|E, �|E, �|E, �|I, �|I, �|I, �|I, �|D, �|N, �|O, �|O, �|O, �|O, �|O, �|O, �|U, �|U, �|U, �|U, �|Y, �|s, �|a, �|a, �|a, �|a, �|a, �|a, �|a, �|c, �|e, �|e, �|e, �|e, �|i, �|i, �|i, �|i, �|o, �|n, �|o, �|o, �|o, �|o, �|o, �|o, �|u, �|u, �|u, �|u, �|y, �|y, �|ss";
$suffix = ".html";
$addFile = "";
$friendlytrim = "-|.";
$LowerCase = "0";
$ShowSection = "1";
$ShowCat = "1";
$UseAlias = "1";
$page404 = "0";
$predefined = array("frontpage","sef");
$skip = array("letterman");
$nocache = array();
$shDoNotOverrideOwnSef = array();
$shLog404Errors = "1";
$shUseURLCache = "1";
$shMaxURLInCache = "10000";
$shTranslateURL = "1";
$shInsertLanguageCode = "1";
$notTranslateURLList = array();
$notInsertIsoCodeList = array();
$shInsertGlobalItemidIfNone = "1";
$shInsertTitleIfNoItemid = "0";
$shAlwaysInsertMenuTitle = "0";
$shAlwaysInsertItemid = "0";
$shDefaultMenuItemName = "";
$shAppendRemainingGETVars = true;
$shVmInsertShopName = "0";
$shInsertProductId = "0";
$shVmUseProductSKU = "0";
$shVmInsertManufacturerName = "0";
$shInsertManufacturerId = "0";
$shVMInsertCategories = "1";
$shVmAdditionalText = "1";
$shVmInsertFlypage = "1";
$shInsertCategoryId = "0";
$shInsertNumericalId = "0";
$shInsertNumericalIdCatList = array("56","133","59","134","60","51","55","32","57","54","33","34","63","61","62","64","142","105","138","149","203","146","147","143","110","148","144","145","107","204","106","213","108","137","151","109","111","150","187","152","182","228","218","25","131","27","26","23","31","132","70","67","68","69","66","202","197","52","37","53","195","38");
$shRedirectNonSefToSef = "1";
$shRedirectJoomlaSefToSef = "1";
$shConfig_live_secure_site = "";
$shActivateIJoomlaMagInContent = "1";
$shInsertIJoomlaMagIssueId = "0";
$shInsertIJoomlaMagName = "0";
$shInsertIJoomlaMagMagazineId = "0";
$shInsertIJoomlaMagArticleId = "0";
$shInsertCBName = "0";
$shCBInsertUserName = "0";
$shCBInsertUserId = "1";
$shCBUseUserPseudo = "1";
$shLMDefaultItemid = "0";
$shInsertFireboardName = "0";
$shFbInsertCategoryName = "1";
$shFbInsertCategoryId = "0";
$shFbInsertMessageSubject = "1";
$shFbInsertMessageId = "1";
$shInsertMyBlogName = "0";
$shMyBlogInsertPostId = "1";
$shMyBlogInsertTagId = "0";
$shMyBlogInsertBloggerId = "1";
$shInsertDocmanName = "1";
$shDocmanInsertDocId = "0";
$shDocmanInsertDocName = "1";
$shDMInsertCategories = "2";
$shDMInsertCategoryId = "0";
$shEncodeUrl = "0";
$guessItemidOnHomepage = "1";
$shForceNonSefIfHttps = "0";
$shRewriteMode = "1";
$shRewriteStrings = array("/","/index.php/","/index.php?/");
$shRecordDuplicates = "1";
$shRemoveGeneratorTag = "1";
$shPutH1Tags = "0";
$shMetaManagementActivated = "1";
$shInsertContentTableName = "0";
$shContentTableName = "Table";
$shAutoRedirectWww = "1";
$shVmInsertProductName = "1";
$shForcedHomePage = "";
$shInsertContentBlogName = "0";
$shContentBlogName = "";
$shInsertMTreeName = "1";
$shMTreeInsertListingName = "1";
$shMTreeInsertListingId = "1";
$shMTreePrependListingId = "1";
$shMTreeInsertCategories = "2";
$shMTreeInsertCategoryId = "0";
$shMTreeInsertUserName = "1";
$shMTreeInsertUserId = "1";
$shInsertNewsPName = "0";
$shNewsPInsertCatId = "0";
$shNewsPInsertSecId = "0";
$shInsertRemoName = "0";
$shRemoInsertDocId = "1";
$shRemoInsertDocName = "1";
$shRemoInsertCategories = "1";
$shRemoInsertCategoryId = "0";
$shCBShortUserURL = "0";
$shKeepStandardURLOnUpgrade = "1";
$shKeepCustomURLOnUpgrade = "1";
$shKeepMetaDataOnUpgrade = "1";
$shKeepModulesSettingsOnUpgrade = "1";
$shMultipagesTitle = "1";
$encode_page_suffix = "";
$encode_space_char = "-";
$encode_lowercase = "0";
$encode_strip_chars = ",|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|�|�|�|�|�|�|�|�|�|�|�|�";
$spec_chars_d = "�,";
$spec_chars = "ss,";
$content_page_format = "%s-%d";
$content_page_name = "Page-";
$shKeepConfigOnUpgrade = "1";
$shSecEnableSecurity = "1";
$shSecLogAttacks = "1";
$shSecOnlyNumVars = array();
$shSecAlphaNumVars = array();
$shSecNoProtocolVars = array();
$shSecCheckHoneyPot = "0";
$shSecHoneyPotKey = "";
$shSecEntranceText = "<p>Sorry. You are visiting this site from a suspicious IP address, which triggered our protection system.</p>
    <p>If you <strong>ARE NOT</strong> a malware robot of any kind, please accept our apologies for the unconvenience. You can access the page by clicking here : ";
$shSecSmellyPotText = "The following link is here to further trap malicious internet robots, so please don't click on it : ";
$monthsToKeepLogs = "1";
$shSecActivateAntiFlood = "1";
$shSecAntiFloodOnlyOnPOST = "0";
$shSecAntiFloodPeriod = "10";
$shSecAntiFloodCount = "10";
$shLangTranslateList = array("english"=>"0");
$shLangInsertCodeList = array("english"=>"0");
$defaultComponentStringList = array("contact"=>"","docman"=>"Download","eventcal"=>"","gallery2"=>"Pictures","jfcei"=>"","joomap"=>"","joomfish"=>"","joomlaboard"=>"","joomlastats"=>"","letterman"=>"Newsletter","login"=>"","mtree"=>"ResourceCatalog","newsfeeds"=>"","poll"=>"","rd_rss"=>"","search"=>"Search","weblinks"=>"");
$pageTexts = array("traditional_chinese"=>"Page-%s","english"=>"Page-%s");
$shAdminInterfaceType = 2;
$shInsertNoFollowPDFPrint = "1";
$shInsertReadMorePageTitle = "1";
$shMultipleH1ToH2 = "1";
$shVmUsingItemsPerPage = "0";
$shSecCheckPOSTData = "1";
$shSecCurMonth = 0;
$shSecLastUpdated = 0;
$shSecTotalAttacks = 0;
$shSecTotalConfigVars = 0;
$shSecTotalBase64 = 0;
$shSecTotalScripts = 0;
$shSecTotalStandardVars = 0;
$shSecTotalImgTxtCmd = 0;
$shSecTotalIPDenied = 0;
$shSecTotalUserAgentDenied = 0;
$shSecTotalFlooding = 0;
$shSecTotalPHP = 0;
$shSecTotalPHPUserClicked = 0;
$shInsertSMFName = "1";
$shSMFItemsPerPage = "20";
$shInsertSMFBoardId = "1";
$shInsertSMFTopicId = "1";
$shinsertSMFUserName = "1";
$shInsertSMFUserId = "1";
$appendToPageTitle = "";
$prependToPageTitle = "";
$debugToLogFile = "0";
$debugStartedAt = 0;
$debugDuration = 3600;
$shInsertOutboundLinksImage = "0";
$shImageForOutboundLinks = "external-black.png";
$defaultComponentItemidList = array("contact"=>"","docman"=>"","eventcal"=>"","gallery2"=>"","jfcei"=>"","joomap"=>"","joomfish"=>"","joomlaboard"=>"","joomlastats"=>"","letterman"=>"","login"=>"","mtree"=>"","newsfeeds"=>"","poll"=>"","rd_rss"=>"","search"=>"","weblinks"=>"");
$UseDefaultItemids = "1";
$fileAccessStatus = array(" <b><font color=\"green\">Writeable</font></b>"," <b><font color=\"green\">Writeable</font></b>"," <b><font color=\"green\">Writeable</font></b>"," <b><font color=\"green\">Writeable</font></b>");
?>