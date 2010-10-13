-- MySQL dump 10.13  Distrib 5.1.48, for portbld-freebsd8.0 (i386)
--
-- Host: localhost    Database: wsw
-- ------------------------------------------------------
-- Server version	5.1.48

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jos_banner`
--

DROP TABLE IF EXISTS `jos_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'banner',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_banner`
--

LOCK TABLES `jos_banner` WRITE;
/*!40000 ALTER TABLE `jos_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_bannerclient`
--

DROP TABLE IF EXISTS `jos_bannerclient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_bannerclient`
--

LOCK TABLES `jos_bannerclient` WRITE;
/*!40000 ALTER TABLE `jos_bannerclient` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_bannerclient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_bannertrack`
--

DROP TABLE IF EXISTS `jos_bannertrack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_bannertrack`
--

LOCK TABLES `jos_bannertrack` WRITE;
/*!40000 ALTER TABLE `jos_bannertrack` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_bannertrack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_categories`
--

DROP TABLE IF EXISTS `jos_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM AUTO_INCREMENT=511 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_categories`
--

LOCK TABLES `jos_categories` WRITE;
/*!40000 ALTER TABLE `jos_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_components`
--

DROP TABLE IF EXISTS `jos_components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_components`
--

LOCK TABLES `jos_components` WRITE;
/*!40000 ALTER TABLE `jos_components` DISABLE KEYS */;
INSERT INTO `jos_components` VALUES (1,'Banners','',0,0,'','Banner Management','com_banners',0,'js/ThemeOffice/component.png',0,'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n',1),(2,'Banners','',0,1,'option=com_banners','Active Banners','com_banners',1,'js/ThemeOffice/edit.png',0,'',1),(3,'Clients','',0,1,'option=com_banners&c=client','Manage Clients','com_banners',2,'js/ThemeOffice/categories.png',0,'',1),(4,'Web Links','option=com_weblinks',0,0,'','Manage Weblinks','com_weblinks',0,'js/ThemeOffice/component.png',0,'show_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n',1),(5,'Links','',0,4,'option=com_weblinks','View existing weblinks','com_weblinks',1,'js/ThemeOffice/edit.png',0,'',1),(6,'Categories','',0,4,'option=com_categories&section=com_weblinks','Manage weblink categories','',2,'js/ThemeOffice/categories.png',0,'',1),(7,'Contacts','option=com_contact',0,0,'','Edit contact details','com_contact',0,'js/ThemeOffice/component.png',1,'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n',1),(8,'Contacts','',0,7,'option=com_contact','Edit contact details','com_contact',0,'js/ThemeOffice/edit.png',1,'',1),(9,'Categories','',0,7,'option=com_categories&section=com_contact_details','Manage contact categories','',2,'js/ThemeOffice/categories.png',1,'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n',1),(10,'Polls','option=com_poll',0,0,'option=com_poll','Manage Polls','com_poll',0,'js/ThemeOffice/component.png',0,'',1),(11,'News Feeds','option=com_newsfeeds',0,0,'','News Feeds Management','com_newsfeeds',0,'js/ThemeOffice/component.png',0,'',1),(12,'Feeds','',0,11,'option=com_newsfeeds','Manage News Feeds','com_newsfeeds',1,'js/ThemeOffice/edit.png',0,'show_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n',1),(13,'Categories','',0,11,'option=com_categories&section=com_newsfeeds','Manage Categories','',2,'js/ThemeOffice/categories.png',0,'',1),(14,'User','option=com_user',0,0,'','','com_user',0,'',1,'',1),(15,'Search','option=com_search',0,0,'option=com_search','Search Statistics','com_search',0,'js/ThemeOffice/component.png',1,'enabled=0\n\n',1),(16,'Categories','',0,1,'option=com_categories&section=com_banner','Categories','',3,'',1,'',1),(17,'Wrapper','option=com_wrapper',0,0,'','Wrapper','com_wrapper',0,'',1,'',1),(18,'Mail To','',0,0,'','','com_mailto',0,'',1,'',1),(19,'Media Manager','',0,0,'option=com_media','Media Manager','com_media',0,'',1,'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/\nrestrict_uploads=1\nallowed_media_usergroup=2\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=0\n\n',1),(20,'Articles','option=com_content',0,0,'','','com_content',0,'',1,'show_noauth=0\nshow_title=1\nlink_titles=1\nshow_intro=1\nshow_section=0\nlink_section=1\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=0\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=0\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=0\nfilter_tags=\nfilter_attritbutes=\n\n',1),(21,'Configuration Manager','',0,0,'','Configuration','com_config',0,'',1,'',1),(22,'Installation Manager','',0,0,'','Installer','com_installer',0,'',1,'',1),(23,'Language Manager','',0,0,'','Languages','com_languages',0,'',1,'site=zh-TW\nadministrator=zh-TW\n\n',1),(24,'Mass mail','',0,0,'','Mass Mail','com_massmail',0,'',1,'mailSubjectPrefix=\nmailBodySuffix=\n\n',1),(25,'Menu Editor','',0,0,'','Menu Editor','com_menus',0,'',1,'',1),(27,'Messaging','',0,0,'','Messages','com_messages',0,'',1,'',1),(28,'Modules Manager','',0,0,'','Modules','com_modules',0,'',1,'',1),(29,'Plugin Manager','',0,0,'','Plugins','com_plugins',0,'',1,'',1),(30,'Template Manager','',0,0,'','Templates','com_templates',0,'',1,'',1),(31,'User Manager','',0,0,'','Users','com_users',0,'',1,'allowUserRegistration=1\nnew_usertype=Author\nuseractivation=0\nfrontend_userparams=0\n\n',1),(32,'Cache Manager','',0,0,'','Cache','com_cache',0,'',1,'',1),(33,'Control Panel','',0,0,'','Control Panel','com_cpanel',0,'',1,'',1),(34,'Joom!Fish','option=com_joomfish',0,0,'option=com_joomfish','Joom!Fish','com_joomfish',0,'components/com_joomfish/assets/images/icon-16-joomfish.png',0,'noTranslation=0\ndefaultText=\noverwriteGlobalConfig=1\nstorageOfOriginal=md5\nfrontEndPublish=1\nfrontEndPreview=1\nshowDefaultLanguageAdmin=1\nshowPanelNews=1\nshowPanelUnpublished=1\nshowPanelState=1\ncopyparams=1\ntranscaching=0\ncachelife=180\nqacaching=1\nqalogging=0\n\n',1),(35,'Control Panel','',0,34,'option=com_joomfish','Control Panel','com_joomfish',0,'components/com_joomfish/assets/images/icon-16-cpanel.png',0,'',1),(36,'Translation','',0,34,'option=com_joomfish&task=translate.overview','Translation','com_joomfish',1,'components/com_joomfish/assets/images/icon-16-translation.png',0,'',1),(37,'Orphan Translations','',0,34,'option=com_joomfish&task=translate.orphans','Orphan Translations','com_joomfish',2,'components/com_joomfish/assets/images/icon-16-orphan.png',0,'',1),(38,'Manage Translations','',0,34,'option=com_joomfish&task=manage.overview','Manage Translations','com_joomfish',3,'components/com_joomfish/assets/images/icon-16-manage.png',0,'',1),(39,'Statistics','',0,34,'option=com_joomfish&task=statistics.overview','Statistics','com_joomfish',4,'components/com_joomfish/assets/images/icon-16-statistics.png',0,'',1),(40,'','',0,34,'option=com_joomfish','','com_joomfish',5,'components/com_joomfish/assets/images/icon-10-blank.png',0,'',1),(41,'Languages','',0,34,'option=com_joomfish&task=languages.show','Languages','com_joomfish',6,'components/com_joomfish/assets/images/icon-16-language.png',0,'',1),(42,'Content elements','',0,34,'option=com_joomfish&task=elements.show','Content elements','com_joomfish',7,'components/com_joomfish/assets/images/icon-16-extension.png',0,'',1),(43,'Plugins','',0,34,'option=com_joomfish&task=plugin.show','Plugins','com_joomfish',8,'components/com_joomfish/assets/images/icon-16-plugin.png',0,'',1),(44,'','',0,34,'option=com_joomfish','','com_joomfish',9,'components/com_joomfish/assets/images/icon-10-blank.png',0,'',1),(45,'Help','',0,34,'option=com_joomfish&task=help.show','Help','com_joomfish',10,'components/com_joomfish/assets/images/icon-16-help.png',0,'',1),(46,'DOCman','option=com_docman',0,0,'option=com_docman','DOCman','com_docman',0,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_documents_16.png',0,'',1),(47,'Home','',0,46,'option=com_docman&task=cpanel','Home','com_docman',0,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_cpanel_16.png',0,'',1),(48,'Files','',0,46,'option=com_docman&section=files','Files','com_docman',1,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_files_16.png',0,'',1),(49,'Documents','',0,46,'option=com_docman&section=documents','Documents','com_docman',2,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_documents_16.png',0,'',1),(50,'Categories','',0,46,'option=com_docman&section=categories','Categories','com_docman',3,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_categories_16.png',0,'',1),(51,'Groups','',0,46,'option=com_docman&section=groups','Groups','com_docman',4,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_groups_16.png',0,'',1),(52,'Licenses','',0,46,'option=com_docman&section=licenses','Licenses','com_docman',5,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_licenses_16.png',0,'',1),(53,'Statistics','',0,46,'option=com_docman&task=stats','Statistics','com_docman',6,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_stats_16.png',0,'',1),(54,'Download Logs','',0,46,'option=com_docman&section=logs','Download Logs','com_docman',7,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_logs_16.png',0,'',1),(55,'Configuration','',0,46,'option=com_docman&section=config','Configuration','com_docman',8,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_config_16.png',0,'',1),(56,'Themes','',0,46,'option=com_docman&section=themes','Themes','com_docman',9,'http://freenix.iis.sinica.edu.tw/wsw/administrator/components/com_docman/images/dm_templates_16.png',0,'',1),(57,'EventList','option=com_eventlist',0,0,'option=com_eventlist','EventList','com_eventlist',0,'../administrator/components/com_eventlist/assets/images/eventlist.png',0,'display_num=50\ncat_num=4\nfilter=1\ndisplay=1\nicons=1\nshow_print_icon=1\nshow_email_icon=1\n\n',1),(58,'Community Builder','option=com_comprofiler',0,0,'option=com_comprofiler','Community Builder','com_comprofiler',0,'js/ThemeOffice/component.png',0,'',1),(59,'User Management','',0,58,'option=com_comprofiler&task=showusers','User Management','com_comprofiler',0,'js/ThemeOffice/user.png',0,'',1),(60,'Tab Management','',0,58,'option=com_comprofiler&task=showTab','Tab Management','com_comprofiler',1,'js/ThemeOffice/article.png',0,'',1),(61,'Field Management','',0,58,'option=com_comprofiler&task=showField','Field Management','com_comprofiler',2,'js/ThemeOffice/content.png',0,'',1),(62,'List Management','',0,58,'option=com_comprofiler&task=showLists','List Management','com_comprofiler',3,'js/ThemeOffice/static.png',0,'',1),(63,'Plugin Management','',0,58,'option=com_comprofiler&task=showPlugins','Plugin Management','com_comprofiler',4,'js/ThemeOffice/plugin.png',0,'',1),(64,'Tools','',0,58,'option=com_comprofiler&task=tools','Tools','com_comprofiler',5,'js/ThemeOffice/component.png',0,'',1),(65,'Configuration','',0,58,'option=com_comprofiler&task=showconfig','Configuration','com_comprofiler',6,'js/ThemeOffice/config.png',0,'',1),(66,'uddeIM','option=com_uddeim',0,0,'option=com_uddeim','uddeIM','com_uddeim',0,'js/ThemeOffice/component.png',0,'',1),(67,'JComments','option=com_jcomments',0,0,'option=com_jcomments','JComments','com_jcomments',0,'class:jcomments-logo',0,'object_group=com_jcomments\nobject_id=1\n',1),(68,'Manage comments','',0,67,'option=com_jcomments&task=view','Manage comments','com_jcomments',0,'class:jcomments-edit',0,'',1),(69,'Settings','',0,67,'option=com_jcomments&task=settings','Settings','com_jcomments',1,'class:jcomments-settings',0,'',1),(70,'Smiles','',0,67,'option=com_jcomments&task=smiles','Smiles','com_jcomments',2,'class:jcomments-smiles',0,'',1),(71,'Subscriptions','',0,67,'option=com_jcomments&task=subscriptions','Subscriptions','com_jcomments',3,'class:jcomments-subscriptions',0,'',1),(72,'Custom BBCode','',0,67,'option=com_jcomments&task=custombbcodes','Custom BBCode','com_jcomments',4,'class:jcomments-custombbcode',0,'',1),(73,'Import','',0,67,'option=com_jcomments&task=import','Import','com_jcomments',5,'class:jcomments-import',0,'',1),(74,'About','',0,67,'option=com_jcomments&task=about','About','com_jcomments',6,'class:jcomments-logo',0,'',1),(103,'Mosets Tree','option=com_mtree',0,0,'option=com_mtree','Mosets Tree','com_mtree',0,'../components/com_mtree/img/icon-16-mosetstree.png',0,'',1),(76,'MT Importer','option=com_mtimporter',0,0,'option=com_mtimporter','MT Importer','com_mtimporter',0,'js/ThemeOffice/component.png',0,'',1),(77,'Import from .csv file','',0,76,'option=com_mtimporter&task=check_csv','Import from .csv file','com_mtimporter',0,'js/ThemeOffice/component.png',0,'',1),(78,'Import from Joomla\'s Content and Web Links','',0,76,'option=com_mtimporter&task=check_jcontent','Import from Joomla\'s Content and Web Links','com_mtimporter',1,'js/ThemeOffice/component.png',0,'',1),(79,'Import from Gossamer Links','',0,76,'option=com_mtimporter&task=check_gossamerlinks','Import from Gossamer Links','com_mtimporter',2,'js/ThemeOffice/component.png',0,'',1),(80,'PollXT','option=com_pollxt',0,0,'option=com_pollxt','PollXT','com_pollxt',0,'../administrator/components/com_pollxt/xtmenu.png',0,'xt_task=1\n@spacer=Settings below for P\nheadings=1\nitem_description=1\ndescription=1\nimage_align=right\nvoted=1\nvotes=1\npollNav=1\npollExp=1\n',1),(81,'\n			Custom Properties\n		','option=com_customproperties',0,0,'option=com_customproperties','\n			Custom Properties\n		','com_customproperties',0,'components/com_customproperties/images/customproperties.png',0,'',1),(82,'\n				Manage Custom Properties\n			','',0,81,'option=com_customproperties&controller=fields','\n				Manage Custom Properties\n			','com_customproperties',0,'components/com_customproperties/images/editcp.png',0,'',1),(83,'\n				Assign Custom Properties\n			','',0,81,'option=com_customproperties&controller=assign','\n				Assign Custom Properties\n			','com_customproperties',1,'components/com_customproperties/images/assign.png',0,'',1),(84,'\n				Utilities\n			','',0,81,'option=com_customproperties&controller=utilities','\n				Utilities\n			','com_customproperties',2,'components/com_customproperties/images/controlpanel.png',0,'',1),(85,'\n				Config\n			','',0,81,'option=com_customproperties&task=configure&controller=cpanel','\n				Config\n			','com_customproperties',3,'components/com_customproperties/images/config.png',0,'',1),(86,'\n				About\n			','',0,81,'option=com_customproperties&task=about&controller=cpanel','\n				About\n			','com_customproperties',4,'components/com_customproperties/images/customproperties.png',0,'',1),(87,'ContentSubmit','option=com_contentsubmit',0,0,'','ContentSubmit','com_contentsubmit',0,'../media/com_contentsubmit/images/contentsubmit_16.png',0,'',1),(88,'Letterman','option=com_letterman',0,0,'option=com_letterman','Letterman','com_letterman',0,'js/ThemeOffice/edit.png',0,'extended_email_validation=1\nembed_images=1\npersonalized_mails_per_pageload=100\nnormal_mails_per_pageload=500\nattachment_dir=/media\nnewsletter_css=',1),(89,'Newsletter Management','',0,88,'option=com_letterman','Newsletter Management','com_letterman',0,'js/ThemeOffice/edit.png',0,'',1),(90,'Subscriber Management','',0,88,'option=com_letterman&task=subscribers','Subscriber Management','com_letterman',1,'js/ThemeOffice/users.png',0,'',1),(91,'Configuration','',0,88,'option=com_letterman&task=config','Configuration','com_letterman',2,'js/ThemeOffice/config.png',0,'',1),(93,'FireBoard Forum','option=com_fireboard',0,0,'option=com_fireboard','FireBoard Forum','com_fireboard',0,'../administrator/components/com_fireboard/images/fbmenu.png',0,'',1),(97,'RokCandy','',0,0,'option=com_rokcandy','RokCandy','com_rokcandy',0,'components/com_rokcandy/assets/rokcandy-icon-16.png',1,'',1),(96,'RokCandyBundle','',0,0,'','RokCandyBundle','com_rokcandybundle',0,'',0,'',0),(98,'Macros','',0,97,'option=com_rokcandy','Macros','com_rokcandy',0,'images/blank.png',0,'',1),(99,'Categories','',0,97,'option=com_categories&section=com_rokcandy','Categories','com_rokcandy',1,'images/blank.png',0,'',1),(100,'RokModule','',0,0,'','RokModule','com_rokmodule',0,'',0,'',1),(101,'RokNavMenuBundle','',0,0,'','RokNavMenuBundle','com_roknavmenubundle',0,'',0,'',1),(102,'Gantry','',0,0,'','Gantry','com_gantry',0,'',0,'',1),(124,'sh404SEF','option=com_sh404sef',0,0,'option=com_sh404sef','sh404SEF','com_sh404sef',0,'js/ThemeOffice/component.png',0,'',1);
/*!40000 ALTER TABLE `jos_components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler`
--

DROP TABLE IF EXISTS `jos_comprofiler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `message_last_sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message_number_sent` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `avatarapproved` tinyint(4) NOT NULL DEFAULT '1',
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  `confirmed` tinyint(4) NOT NULL DEFAULT '1',
  `lastupdatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registeripaddr` varchar(50) NOT NULL DEFAULT '',
  `cbactivation` varchar(50) NOT NULL DEFAULT '',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `banneddate` datetime DEFAULT NULL,
  `unbanneddate` datetime DEFAULT NULL,
  `bannedby` int(11) DEFAULT NULL,
  `unbannedby` int(11) DEFAULT NULL,
  `bannedreason` mediumtext,
  `acceptedterms` tinyint(1) NOT NULL DEFAULT '0',
  `cb_geomangeocode` varchar(255) DEFAULT NULL,
  `cb_geolatitude` varchar(255) DEFAULT NULL,
  `cb_geolongitude` varchar(255) DEFAULT NULL,
  `cb_pb_enable` varchar(255) DEFAULT NULL,
  `cb_pb_autopublish` varchar(255) DEFAULT NULL,
  `cb_pb_notifyme` varchar(255) DEFAULT NULL,
  `cb_bookandbookchapters` mediumtext,
  `cb_honorsandawards` mediumtext,
  `cb_blog` varchar(255) DEFAULT NULL,
  `cb_aboutme` mediumtext,
  `cb_tel` varchar(255) DEFAULT NULL,
  `cb_summary` varchar(255) DEFAULT NULL,
  `cb_experience` varchar(255) DEFAULT NULL,
  `cb_education` varchar(255) DEFAULT NULL,
  `cb_professional` varchar(255) DEFAULT NULL,
  `cb_headline` varchar(255) DEFAULT NULL,
  `cb_itskills` mediumtext,
  `cb_myprojects` varchar(255) DEFAULT NULL,
  `cb_projects` mediumtext,
  `cb_interests` mediumtext,
  `sbviewtype` varchar(255) NOT NULL DEFAULT '_UE_SB_VIEWTYPE_FLAT',
  `sbordering` varchar(255) NOT NULL DEFAULT '_UE_SB_ORDERING_OLDEST',
  `sbsignature` mediumtext,
  `fbviewtype` varchar(255) NOT NULL DEFAULT '_UE_FB_VIEWTYPE_FLAT',
  `fbordering` varchar(255) NOT NULL DEFAULT '_UE_FB_ORDERING_OLDEST',
  `fbsignature` mediumtext,
  `cb_lang` mediumtext,
  `cb_educationlist` mediumtext,
  `cb_experiencelist` mediumtext,
  `cb_nickname` varchar(255) DEFAULT NULL,
  `cb_channel` mediumtext,
  `cb_speech` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `apprconfbanid` (`approved`,`confirmed`,`banned`,`id`),
  KEY `avatappr_apr_conf_ban_avatar` (`avatarapproved`,`approved`,`confirmed`,`banned`,`avatar`),
  KEY `lastupdatedate` (`lastupdatedate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler`
--

LOCK TABLES `jos_comprofiler` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler` DISABLE KEYS */;
INSERT INTO `jos_comprofiler` VALUES (62,62,'','','',6493,'0000-00-00 00:00:00',0,'62_49b608379f90d.jpg',1,1,1,'2009-03-16 10:05:17','','',0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'','','','Who\'sWho網站管理者，如果有任何疑問，請透過站內寄信給admin :)','',NULL,NULL,NULL,NULL,'','',NULL,'','','_UE_SB_VIEWTYPE_FLAT','_UE_SB_ORDERING_OLDEST',NULL,'_UE_FB_VIEWTYPE_FLAT','_UE_FB_ORDERING_OLDEST',NULL,'','','','','',NULL);
/*!40000 ALTER TABLE `jos_comprofiler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_field_values`
--

DROP TABLE IF EXISTS `jos_comprofiler_field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_field_values` (
  `fieldvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) NOT NULL DEFAULT '0',
  `fieldtitle` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldvalueid`),
  KEY `fieldid_ordering` (`fieldid`,`ordering`),
  KEY `fieldtitle_id` (`fieldtitle`,`fieldid`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_field_values`
--

LOCK TABLES `jos_comprofiler_field_values` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_field_values` DISABLE KEYS */;
INSERT INTO `jos_comprofiler_field_values` VALUES (60,73,'_UE_SB_VIEWTYPE_FLAT',1,0),(61,73,'_UE_SB_VIEWTYPE_THREADED',2,0),(62,74,'_UE_SB_ORDERING_OLDEST',1,0),(63,74,'_UE_SB_ORDERING_LATEST',2,0),(64,73,'_UE_SB_VIEWTYPE_FLAT',1,0),(65,73,'_UE_SB_VIEWTYPE_THREADED',2,0),(66,74,'_UE_SB_ORDERING_OLDEST',1,0),(67,74,'_UE_SB_ORDERING_LATEST',2,0),(81,73,'_UE_SB_VIEWTYPE_FLAT',1,0),(82,73,'_UE_SB_VIEWTYPE_THREADED',2,0),(83,74,'_UE_SB_ORDERING_OLDEST',1,0),(84,74,'_UE_SB_ORDERING_LATEST',2,0),(100,126,'_UE_FB_ORDERING_LATEST',2,0),(99,126,'_UE_FB_ORDERING_OLDEST',1,0),(98,125,'_UE_FB_VIEWTYPE_THREADED',2,0),(97,125,'_UE_FB_VIEWTYPE_FLAT',1,0);
/*!40000 ALTER TABLE `jos_comprofiler_field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_fields`
--

DROP TABLE IF EXISTS `jos_comprofiler_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_fields` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `tablecolumns` text NOT NULL,
  `table` varchar(50) NOT NULL DEFAULT '#__comprofiler',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `maxlength` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `required` tinyint(4) DEFAULT '0',
  `tabid` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `cols` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `default` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0',
  `profile` tinyint(1) NOT NULL DEFAULT '1',
  `displaytitle` tinyint(1) NOT NULL DEFAULT '1',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `searchable` tinyint(1) NOT NULL DEFAULT '0',
  `calculated` tinyint(1) NOT NULL DEFAULT '0',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `pluginid` int(11) NOT NULL DEFAULT '0',
  `params` mediumtext,
  PRIMARY KEY (`fieldid`),
  KEY `tabid_pub_prof_order` (`tabid`,`published`,`profile`,`ordering`),
  KEY `readonly_published_tabid` (`readonly`,`published`,`tabid`),
  KEY `registration_published_order` (`registration`,`published`,`ordering`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_fields`
--

LOCK TABLES `jos_comprofiler_fields` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_fields` DISABLE KEYS */;
INSERT INTO `jos_comprofiler_fields` VALUES (123,'cb_speech','cb_speech','#__comprofiler','演講記錄','','editorta',0,0,0,11,15,0,0,NULL,'',1,0,1,1,0,0,0,0,1,'fieldMinLength=0'),(21,'forumkarma','','#__comprofiler','_UE_FORUM_KARMA','','forumstats',NULL,NULL,0,21,-14,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,4,NULL),(22,'forumposts','','#__comprofiler','_UE_FORUM_TOTALPOSTS','','forumstats',NULL,NULL,0,21,-15,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,4,NULL),(23,'forumrank','','#__comprofiler','_UE_FORUM_FORUMRANKING','','forumstats',NULL,NULL,0,21,-16,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,4,NULL),(51,'password','password','#__users','_UE_PASS','_UE_VALID_PASS','password',50,0,0,11,-45,0,0,NULL,'',0,0,0,1,0,0,1,1,1,'verifyPassTitle=_UE_VERIFY_SOMETHING\nfieldMinLength=6\nfieldValidateExpression=\npregexp=/^.*$/\npregexperror=Not a valid input\nfieldValidateForbiddenList_register=\nfieldValidateForbiddenList_edit='),(52,'params','params','#__users','_UE_USERPARAMS','','userparams',NULL,NULL,0,11,-30,NULL,NULL,NULL,NULL,1,0,0,1,0,0,1,1,1,NULL),(24,'connections','','#__comprofiler','_UE_CONNECTION','','connections',NULL,NULL,0,21,-17,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,1,NULL),(25,'hits','hits','#__comprofiler','_UE_HITS','_UE_HITS_DESC','counter',NULL,NULL,0,21,-22,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,1,NULL),(125,'fbviewtype','fbviewtype','#__comprofiler','_UE_FB_VIEWTYPE_TITLE','','select',NULL,NULL,0,33,1,NULL,NULL,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(126,'fbordering','fbordering','#__comprofiler','_UE_FB_ORDERING_TITLE','','select',NULL,NULL,0,33,2,NULL,NULL,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(117,'cb_lang','cb_lang','#__comprofiler','語文','','textarea',0,0,0,11,8,0,0,NULL,'',1,0,1,1,0,1,0,0,1,'fieldMinLength=0\nfieldValidateForbiddenList_register=http:,https:,mailto:,//.[url],<a,</a>,&#\nfieldValidateForbiddenList_profile='),(103,'sbordering','sbordering','#__comprofiler','_UE_SB_ORDERING_TITLE','','select',NULL,NULL,0,34,2,NULL,NULL,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(104,'sbsignature','sbsignature','#__comprofiler','_UE_SB_SIGNATURE','','textarea',300,NULL,0,34,3,60,5,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(127,'fbsignature','fbsignature','#__comprofiler','_UE_FB_SIGNATURE','','textarea',300,NULL,0,33,3,60,5,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(94,'cb_professional','cb_professional','#__comprofiler','我的專才簡介','','delimiter',0,0,0,37,1,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(96,'cb_headline','cb_headline','#__comprofiler','職稱','Your professional “headline”:\r\n\r\nExamples: Experienced Transportation Executive, Web Designer and Information Architect, Visionary Entrepreneur and Investor','text',0,40,0,11,3,0,0,NULL,NULL,1,0,1,1,0,1,0,0,1,NULL),(99,'cb_projects','cb_projects','#__comprofiler','專案','','editorta',0,0,0,37,3,0,0,NULL,NULL,1,0,1,1,0,1,0,0,1,NULL),(100,'cb_interests','cb_interests','#__comprofiler','興趣','','textarea',0,0,0,11,11,0,0,NULL,NULL,1,0,1,1,0,1,0,0,1,NULL),(102,'sbviewtype','sbviewtype','#__comprofiler','_UE_SB_VIEWTYPE_TITLE','','select',NULL,NULL,0,34,1,NULL,NULL,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(118,'cb_educationlist','cb_educationlist','#__comprofiler','學歷','','textarea',0,0,0,11,7,0,0,NULL,'',1,0,1,1,0,1,0,0,1,'fieldMinLength=0\nfieldValidateForbiddenList_register=http:,https:,mailto:,//.[url],<a,</a>,&#\nfieldValidateForbiddenList_profile='),(88,'cb_education','cb_education','#__comprofiler','學歷','','delimiter',0,0,0,11,14,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,''),(122,'cb_channel','cb_channel','#__comprofiler','IRC','輸入常出現的IRC channel\r\n\r\n什麼是IRC? \r\nIRC 是線上多人聊天室，這是自由軟體社群相當重要的互動工具，Linux, BSD 等等社群都有在用，有問題可以發問、也可以和其他朋友討論，是大家意見交流的場所，在國外流行，國內則較少人知道。玩 Linux 除了要會用 Google，IRC 也是相當重要的工具，也有機會結交許多國內外的高手。 :)\r\n\r\n參考(http://pcman.sayya.org/irc/)','textarea',0,0,0,11,10,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(121,'cb_nickname','cb_nickname','#__comprofiler','網路代稱','','text',0,0,0,11,4,0,0,NULL,NULL,1,0,1,1,0,1,0,0,1,NULL),(119,'cb_experiencelist','cb_experiencelist','#__comprofiler','工作經歷','','textarea',0,0,0,11,16,0,0,NULL,'',1,0,1,1,0,1,0,0,1,'fieldMinLength=0\nfieldValidateExpression=\npregexp=/^.*$/\npregexperror=Not a valid input\nfieldValidateForbiddenList_register=http:,https:,mailto:,//.[url],<a,</a>,&#\nfieldValidateForbiddenList_edit='),(83,'cb_experience','cb_experience','#__comprofiler','工作','','delimiter',0,0,0,11,17,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,''),(81,'cb_summary','cb_summary','#__comprofiler','摘要','','delimiter',0,0,0,11,2,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(80,'cb_tel','cb_tel','#__comprofiler','TEL','','text',0,0,0,11,1,0,0,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(97,'cb_itskills','cb_itskills','#__comprofiler','專業技能','ex: PHP、Perl、MySQL blah blah blah ','textarea',0,0,0,11,6,40,0,NULL,'',1,0,1,1,0,1,0,0,1,'fieldMinLength=0\nfieldValidateForbiddenList_register=http:,https:,mailto:,//.[url],<a,</a>,&#\nfieldValidateForbiddenList_profile='),(98,'cb_myprojects','cb_myprojects','#__comprofiler','我的專案','','delimiter',0,0,0,37,2,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(68,'cb_honorsandawards','cb_honorsandawards','#__comprofiler','獎項記錄','','textarea',0,2,0,11,13,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(79,'cb_aboutme','cb_aboutme','#__comprofiler','關於我','','textarea',1000,100,0,11,5,40,10,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(67,'cb_bookandbookchapters','cb_bookandbookchapters','#__comprofiler','我出版的書','','textarea',0,0,0,11,12,0,0,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(75,'sbsignature','sbsignature','#__comprofiler','_UE_SB_SIGNATURE','','textarea',300,NULL,0,34,1,60,5,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(73,'sbviewtype','sbviewtype','#__comprofiler','_UE_SB_VIEWTYPE_TITLE','','select',NULL,NULL,0,34,1,NULL,NULL,NULL,NULL,1,0,2,1,0,0,0,0,1,NULL),(69,'cb_blog','cb_blog','#__comprofiler','Blog','','webaddress',0,0,0,11,9,0,2,NULL,NULL,1,0,1,1,0,0,0,0,1,NULL),(49,'lastupdatedate','lastupdatedate','#__comprofiler','_UE_LASTUPDATEDON','','datetime',NULL,NULL,0,21,-18,NULL,NULL,NULL,NULL,1,0,0,1,1,0,1,1,1,'field_display_by=2'),(50,'email','email','#__users','_UE_EMAIL','_UE_REGWARN_MAIL','primaryemailaddress',NULL,NULL,1,11,-47,NULL,NULL,NULL,NULL,0,1,0,1,0,0,1,1,1,NULL),(74,'sbordering','sbordering','#__comprofiler','_UE_SB_ORDERING_TITLE','','select',NULL,NULL,0,34,1,NULL,NULL,NULL,NULL,1,0,0,1,0,0,0,0,1,NULL),(46,'firstname','firstname','#__comprofiler','_UE_YOUR_FNAME','_UE_REGWARN_FNAME','predefined',NULL,NULL,1,11,-50,NULL,NULL,NULL,NULL,0,0,0,1,0,0,1,1,1,NULL),(47,'middlename','middlename','#__comprofiler','_UE_YOUR_MNAME','_UE_REGWARN_MNAME','predefined',NULL,NULL,1,11,-49,NULL,NULL,NULL,NULL,0,0,0,1,0,0,1,1,1,NULL),(48,'lastname','lastname','#__comprofiler','_UE_YOUR_LNAME','_UE_REGWARN_LNAME','predefined',NULL,NULL,1,11,-48,NULL,NULL,NULL,NULL,0,0,0,1,0,0,1,1,1,NULL),(45,'formatname','','#__comprofiler','_UE_FORMATNAME','','formatname',NULL,NULL,0,11,-52,NULL,NULL,NULL,NULL,1,0,0,0,1,0,1,1,1,NULL),(42,'username','username','#__users','_UE_UNAME','_UE_VALID_UNAME','predefined',0,0,1,11,-46,0,0,NULL,'',1,1,0,1,0,1,1,1,1,'fieldMinLength=\nfieldValidateExpression=\npregexp=/^.*$/\npregexperror=Not a valid input\nfieldValidateForbiddenList_register=http:,https:,mailto:,//.[url],<a,</a>,&#\nfieldValidateForbiddenList_profile='),(29,'avatar','avatar,avatarapproved','#__comprofiler','_UE_IMAGE','','image',NULL,NULL,0,20,1,NULL,NULL,NULL,NULL,1,0,1,0,0,0,1,1,1,NULL),(28,'registerDate','registerDate','#__users','_UE_MEMBERSINCE','','datetime',NULL,NULL,0,21,-20,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,1,'field_display_by=2'),(27,'lastvisitDate','lastvisitDate','#__users','_UE_LASTONLINE','','datetime',NULL,NULL,0,21,-19,NULL,NULL,NULL,NULL,1,0,1,1,1,0,1,1,1,'field_display_by=2'),(26,'onlinestatus','','#__comprofiler','_UE_ONLINESTATUS','','status',NULL,NULL,0,21,-21,NULL,NULL,NULL,NULL,1,0,1,1,0,0,1,1,1,NULL),(41,'name','name','#__users','_UE_NAME','_UE_REGWARN_NAME','predefined',NULL,NULL,1,11,-51,NULL,NULL,NULL,NULL,0,0,0,1,0,1,1,1,1,NULL);
/*!40000 ALTER TABLE `jos_comprofiler_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_lists`
--

DROP TABLE IF EXISTS `jos_comprofiler_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_lists` (
  `listid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `usergroupids` varchar(255) DEFAULT NULL,
  `useraccessgroupid` int(9) NOT NULL DEFAULT '18',
  `sortfields` varchar(255) DEFAULT NULL,
  `filterfields` mediumtext,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `col1title` varchar(255) DEFAULT NULL,
  `col1enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col1fields` mediumtext,
  `col2title` varchar(255) DEFAULT NULL,
  `col2enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col1captions` tinyint(1) NOT NULL DEFAULT '0',
  `col2fields` mediumtext,
  `col2captions` tinyint(1) NOT NULL DEFAULT '0',
  `col3title` varchar(255) DEFAULT NULL,
  `col3enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col3fields` mediumtext,
  `col3captions` tinyint(1) NOT NULL DEFAULT '0',
  `col4title` varchar(255) DEFAULT NULL,
  `col4enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col4fields` mediumtext,
  `col4captions` tinyint(1) NOT NULL DEFAULT '0',
  `params` mediumtext,
  PRIMARY KEY (`listid`),
  KEY `pub_ordering` (`published`,`ordering`),
  KEY `default_published` (`default`,`published`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_lists`
--

LOCK TABLES `jos_comprofiler_lists` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_lists` DISABLE KEYS */;
INSERT INTO `jos_comprofiler_lists` VALUES (4,'Community','',1,1,'18, 19, 23, 24',-2,'`lastvisitDate` DESC, `lastupdatedate` DESC, `username` ASC','a(%60username%60%20not%20in%20%28%22admin%22%2C%22ossfepaper%22%29)',1,'照片',1,'29','稱號',1,0,'42|*|96',0,'專長領域',1,'97|*|69',0,'狀態',1,'26',0,'list_search=1\nlist_compare_types=2\nlist_limit=\nlist_paging=1\nhotlink_protection=0');
/*!40000 ALTER TABLE `jos_comprofiler_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_members`
--

DROP TABLE IF EXISTS `jos_comprofiler_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_members` (
  `referenceid` int(11) NOT NULL DEFAULT '0',
  `memberid` int(11) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '1',
  `pending` tinyint(1) NOT NULL DEFAULT '0',
  `membersince` date NOT NULL DEFAULT '0000-00-00',
  `reason` mediumtext,
  `description` varchar(255) DEFAULT NULL,
  `type` mediumtext,
  PRIMARY KEY (`referenceid`,`memberid`),
  KEY `pamr` (`pending`,`accepted`,`memberid`,`referenceid`),
  KEY `aprm` (`accepted`,`pending`,`referenceid`,`memberid`),
  KEY `membrefid` (`memberid`,`referenceid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_members`
--

LOCK TABLES `jos_comprofiler_members` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_comprofiler_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_plugin`
--

DROP TABLE IF EXISTS `jos_comprofiler_plugin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(100) DEFAULT '',
  `folder` varchar(100) DEFAULT '',
  `backend_menu` varchar(255) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`),
  KEY `type_pub_order` (`type`,`published`,`ordering`)
) ENGINE=MyISAM AUTO_INCREMENT=511 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_plugin`
--

LOCK TABLES `jos_comprofiler_plugin` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_plugin` DISABLE KEYS */;
INSERT INTO `jos_comprofiler_plugin` VALUES (1,'CB Core','cb.core','user','plug_cbcore','',0,1,1,1,0,0,'0000-00-00 00:00:00',''),(2,'CB Connections','cb.connections','user','plug_cbconnections','',0,3,1,1,0,0,'0000-00-00 00:00:00',''),(3,'Content Author','cb.authortab','user','plug_cbmamboauthortab','',0,4,1,1,0,0,'0000-00-00 00:00:00',''),(4,'Forum integration','cb.simpleboardtab','user','plug_cbsimpleboardtab','',0,5,0,1,0,0,'0000-00-00 00:00:00',''),(5,'Mamblog Blog','cb.mamblogtab','user','plug_cbmamblogtab','',0,6,0,1,0,0,'0000-00-00 00:00:00',''),(6,'YaNC Newsletters','yanc','user','plug_yancintegration','',0,7,0,1,0,0,'0000-00-00 00:00:00',''),(7,'Default','default','templates','default','',0,1,1,1,0,0,'0000-00-00 00:00:00',''),(8,'WinClassic','winclassic','templates','winclassic','',0,2,1,1,0,0,'0000-00-00 00:00:00',''),(9,'WebFX','webfx','templates','webfx','',0,3,1,1,0,0,'0000-00-00 00:00:00',''),(10,'OSX','osx','templates','osx','',0,4,1,1,0,0,'0000-00-00 00:00:00',''),(11,'Luna','luna','templates','luna','',0,5,1,1,0,0,'0000-00-00 00:00:00',''),(12,'Dark','dark','templates','dark','',0,6,1,1,0,0,'0000-00-00 00:00:00',''),(13,'Default language (English)','default_language','language','default_language','',0,-1,1,1,0,0,'0000-00-00 00:00:00',''),(14,'CB Menu','cb.menu','user','plug_cbmenu','',0,2,1,1,0,0,'0000-00-00 00:00:00',''),(15,'Private Message System','pms.mypmspro','user','plug_pms_mypmspro','',0,8,1,1,0,0,'0000-00-00 00:00:00',''),(502,'CB Captcha','cb.captcha','user','plug_cbcaptcha','',0,9,1,0,0,0,'0000-00-00 00:00:00',''),(503,'My Events','eventlist_cb','user','plug_cbeventlistmyevents','',0,10,1,0,0,0,'0000-00-00 00:00:00',''),(504,'CB Fireboard Plugin','cb.fireboard','user','plug_cbfireboardplugin','',0,13,1,0,0,0,'0000-00-00 00:00:00','TemplateRank=/template/default/images/english\nstatDisplay=1\nstatRanking=1\nstatRankingText=_UE_FORUM_FORUMRANKING\nstatRankingImg=1\nstatPosts=1\nstatPostsText=_UE_FORUM_TOTALPOSTS\nstatKarma=1\nstatKarmaText=_UE_FORUM_KARMA'),(505,'PMS uddeIM','pms.uddeim','user','plug_pmsuddeim','',0,12,1,0,0,0,'0000-00-00 00:00:00',''),(506,'uddeIM Blocking Plugin','blocking.uddeim','user','plug_uddeimblockingplugin','',0,15,0,0,0,0,'0000-00-00 00:00:00',''),(507,'PMS uddeIM Inbox','pms.showinbox','user','plug_pmsuddeiminbox','',0,11,1,0,0,0,'0000-00-00 00:00:00',''),(508,'uddeIM Profilelink','pms.uddeim.profilelink','user','plug_uddeimprofilelink','',0,14,1,0,0,0,'0000-00-00 00:00:00',''),(509,'CB OF partner Tab','cb.partnertab','user','plug_cbofpartnertab','',0,16,1,0,0,0,'0000-00-00 00:00:00',''),(510,'CB OF MyProject Tab','cb.myproject','user','plug_cbofmyproject','',0,17,1,0,0,0,'0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `jos_comprofiler_plugin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_sessions`
--

DROP TABLE IF EXISTS `jos_comprofiler_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_sessions` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `ui` tinyint(4) NOT NULL DEFAULT '0',
  `incoming_ip` varchar(39) NOT NULL DEFAULT '',
  `client_ip` varchar(39) NOT NULL DEFAULT '',
  `session_id` varchar(33) NOT NULL DEFAULT '',
  `session_data` mediumtext NOT NULL,
  `expiry_time` int(14) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `expiry_time` (`expiry_time`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_sessions`
--

LOCK TABLES `jos_comprofiler_sessions` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_comprofiler_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_tabs`
--

DROP TABLE IF EXISTS `jos_comprofiler_tabs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_tabs` (
  `tabid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `ordering_register` int(11) NOT NULL DEFAULT '10',
  `width` varchar(10) NOT NULL DEFAULT '.5',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `pluginclass` varchar(255) DEFAULT NULL,
  `pluginid` int(11) DEFAULT NULL,
  `fields` tinyint(1) NOT NULL DEFAULT '1',
  `params` mediumtext,
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `displaytype` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `useraccessgroupid` int(9) NOT NULL DEFAULT '-2',
  PRIMARY KEY (`tabid`),
  KEY `enabled_position_ordering` (`enabled`,`position`,`ordering`),
  KEY `orderreg_enabled_pos_order` (`enabled`,`ordering_register`,`position`,`ordering`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_tabs`
--

LOCK TABLES `jos_comprofiler_tabs` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_tabs` DISABLE KEYS */;
INSERT INTO `jos_comprofiler_tabs` VALUES (47,'WorkShop','<p>Eventlist Plugin</p>',13,10,'.5',1,'eventlistTab',503,0,'end_date=0\nstart_date=0',0,'tab','cb_tabmain',-2),(22,'_UE_PMSTAB','',-4,10,'.5',0,'getmypmsproTab',15,0,NULL,1,'html','cb_right',-2),(21,'_UE_USER_STATUS','',-5,10,'.5',1,'getStatusTab',14,1,NULL,1,'html','cb_right',-2),(20,'個人圖像','<!--_UE_PORTRAIT-->',-7,10,'1',1,'getPortraitTab',1,1,'',1,'html','cb_middle',-2),(19,'_UE_PROFILE_PAGE_TITLE','',-8,10,'1',1,'getPageTitleTab',1,0,NULL,1,'html','cb_head',-2),(18,'_UE_CONNECTIONPATHS','',-9,10,'1',1,'getConnectionPathsTab',2,0,'',1,'html','cb_head',-2),(16,'_UE_NEWSLETTER_HEADER','_UE_NEWSLETTER_INTRODCUTION',11,10,'1',0,'getNewslettersTab',6,0,NULL,1,'tab','cb_tabmain',-2),(17,'_UE_MENU','',-10,10,'1',1,'getMenuTab',14,0,'firstMenuName=\nfirstSubMenuName=_UE_MENU_ABOUT_CB\nfirstSubMenuHref=index.php?option=com_comprofiler&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;task=teamCredits\nsecondSubMenuName=\nsecondSubMenuHref=',1,'html','cb_head',-2),(15,'_UE_CONNECTION','',8,10,'1',1,'getConnectionTab',2,0,'con_ShowTitle=1\ncon_ShowSummary=1\ncon_SummaryEntries=20\ncon_PagingEnabled=1\ncon_EntriesPerPage=20',1,'tab','cb_underall',-2),(14,'_UE_BLOGTAB','',-2,10,'1',0,'getBlogTab',5,0,NULL,1,'tab','cb_tabmain',-2),(13,'_UE_FORUMTAB','',6,10,'1',0,'getForumTab',4,0,NULL,1,'tab','cb_tabmain',-2),(12,'_UE_AUTHORTAB','',3,10,'1',1,'getAuthorTab',3,0,'',1,'tab','cb_tabmain',-2),(11,'About','',1,10,'1',1,'getContactTab',1,1,'',2,'tab','cb_tabmain',-2),(24,'CB Captcha','This CB Captcha Tab placeholder is used to move captcha image placement in relation to other CB tabs that contain registration fields.',2,10,'',1,'getcaptchaTab',501,0,'',0,'tab','cb_tabmain',-2),(34,'_UE_SB_TABTITLE','_UE_SB_TABDESC',7,10,'.5',0,NULL,NULL,1,'',0,'tab','cb_tabmain',-2),(33,'Specialty','',10,10,'.5',0,NULL,NULL,1,'',0,'tab','cb_tabmain',-2),(28,'Public Mail','',105,10,'',0,'getPublicMailTab',506,1,'publicmailShowForm=1\npublicmailTableWidth=100%\npublicmailShowIntro=If you want to contact this person, you may use this email-form:\npublicmailShowAddress=2\npublicmailUseSubject=0\npublicmailUseCopy=1\npublicmailTextMaxlength=500\npublicmailTextRows=5\npublicmailTextCols=40\npublicmailThankSender=0\npublicmailLogMails=0',0,'html','cb_middle',-2),(31,'工作/演講','',5,10,'.5',0,NULL,NULL,1,'',0,'tab','cb_tabmain',-2),(37,'專案','',4,10,'.5',0,NULL,NULL,1,'',0,'tab','cb_tabmain',-2),(44,'_UE_FB_TABTITLE','_UE_FB_TABDESC',0,10,'.5',0,NULL,NULL,1,NULL,0,'','',-2),(40,'Forum','',1,10,'',1,'getForumfbTab',504,0,'postsNumber=10\npagingEnabled=1\nsearchEnabled=0',0,'tab','cb_tabmain',-2),(42,'_UE_MX_RE','',3,10,'',0,'getMXCommentsTab',513,0,'showEmptyTab=1\nshowTitle=1\nshowCommentLevel=1\ntypeComment=\nsortBy=date DESC\ncommentperpage=10\npagination=1',0,'tab','cb_underall',-2),(43,'_UE_MX_FAV','',4,10,'',0,'getMXCFavouredTab',513,0,'showEmptyTab=1\nfavouredperpage=10\npagination=1',0,'tab','cb_underall',-2),(45,'傳遞私人訊息','',109,10,'',1,'getuddeimTab',515,0,'showTitle=1\nshowSubject=0\ndoObfuscate=0\nwidth=25\nheight=5',0,'html','cb_right',-2),(46,'_UE_TABINBOX','',12,10,'',1,'getInboxTab',516,0,'entriesNumber=10\npagingEnabled=1',0,'tab','cb_tabmain',-2),(48,'Partner','',8,10,'.5',1,'getPartnerTab',509,1,'',0,'tab','cb_tabmain',-2),(49,'Projects','',9,10,'.5',1,'getMyProjectTab',510,1,'',0,'tab','cb_tabmain',-2);
/*!40000 ALTER TABLE `jos_comprofiler_tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_userreports`
--

DROP TABLE IF EXISTS `jos_comprofiler_userreports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_userreports` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `reporteduser` int(11) NOT NULL DEFAULT '0',
  `reportedbyuser` int(11) NOT NULL DEFAULT '0',
  `reportedondate` date NOT NULL DEFAULT '0000-00-00',
  `reportexplaination` text NOT NULL,
  `reportedstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reportid`),
  KEY `status_user_date` (`reportedstatus`,`reporteduser`,`reportedondate`),
  KEY `reportedbyuser_ondate` (`reportedbyuser`,`reportedondate`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_userreports`
--

LOCK TABLES `jos_comprofiler_userreports` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_userreports` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_comprofiler_userreports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_comprofiler_views`
--

DROP TABLE IF EXISTS `jos_comprofiler_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_comprofiler_views` (
  `viewer_id` int(11) NOT NULL DEFAULT '0',
  `profile_id` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  `lastview` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewscount` int(11) NOT NULL DEFAULT '0',
  `vote` tinyint(3) DEFAULT NULL,
  `lastvote` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`viewer_id`,`profile_id`,`lastip`),
  KEY `lastview` (`lastview`),
  KEY `profile_id_lastview` (`profile_id`,`lastview`,`viewer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_comprofiler_views`
--

LOCK TABLES `jos_comprofiler_views` WRITE;
/*!40000 ALTER TABLE `jos_comprofiler_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_comprofiler_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_contact_details`
--

DROP TABLE IF EXISTS `jos_contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_contact_details`
--

LOCK TABLES `jos_contact_details` WRITE;
/*!40000 ALTER TABLE `jos_contact_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_content`
--

DROP TABLE IF EXISTS `jos_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL,
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=8063 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_content`
--

LOCK TABLES `jos_content` WRITE;
/*!40000 ALTER TABLE `jos_content` DISABLE KEYS */;
INSERT INTO `jos_content` VALUES (8062,'Welcome to OpenFoundry','welcome-to-openfoundry','','<h1><strong>Welcome to OpenFoundry</strong></h1>\r\n<p><span class=\"attribute-value\">OpenFoundry provides essential tools and services through its service platform for users to develop Open Source Software Projects, the operating funds comes from the National Science Council and the Research Center for Information Technology Innovation of Academia Sinica Taiwan.</span></p>','',1,0,0,0,'2010-10-13 08:40:45',62,'','2010-10-13 08:44:17',62,0,'0000-00-00 00:00:00','2010-10-13 08:40:45','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_pdf_icon=\nshow_print_icon=0\nshow_email_icon=0\nlanguage=\nkeyref=\nreadmore=',4,0,1,'','',0,37,'robots=\nauthor=');
/*!40000 ALTER TABLE `jos_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_content_frontpage`
--

DROP TABLE IF EXISTS `jos_content_frontpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_content_frontpage`
--

LOCK TABLES `jos_content_frontpage` WRITE;
/*!40000 ALTER TABLE `jos_content_frontpage` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_content_frontpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_content_rating`
--

DROP TABLE IF EXISTS `jos_content_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_content_rating`
--

LOCK TABLES `jos_content_rating` WRITE;
/*!40000 ALTER TABLE `jos_content_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_content_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_contentsubmit_config`
--

DROP TABLE IF EXISTS `jos_contentsubmit_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_contentsubmit_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_contentsubmit_config`
--

LOCK TABLES `jos_contentsubmit_config` WRITE;
/*!40000 ALTER TABLE `jos_contentsubmit_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_contentsubmit_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_acl_aro`
--

DROP TABLE IF EXISTS `jos_core_acl_aro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM AUTO_INCREMENT=2430 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_acl_aro`
--

LOCK TABLES `jos_core_acl_aro` WRITE;
/*!40000 ALTER TABLE `jos_core_acl_aro` DISABLE KEYS */;
INSERT INTO `jos_core_acl_aro` VALUES (10,'users','62',0,'admin',0);
/*!40000 ALTER TABLE `jos_core_acl_aro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_acl_aro_groups`
--

DROP TABLE IF EXISTS `jos_core_acl_aro_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_acl_aro_groups`
--

LOCK TABLES `jos_core_acl_aro_groups` WRITE;
/*!40000 ALTER TABLE `jos_core_acl_aro_groups` DISABLE KEYS */;
INSERT INTO `jos_core_acl_aro_groups` VALUES (30,28,'Public Backend',13,20,'Public Backend'),(21,20,'TEST-Newsletter',7,8,'TEST-Newsletter'),(20,19,'Newsletter',6,9,'Newsletter'),(19,18,'Author',5,10,'Author'),(18,29,'Registered',4,11,'Registered'),(29,28,'Public Frontend',3,12,'Public Frontend'),(28,17,'USERS',2,21,'USERS'),(17,0,'ROOT',1,22,'ROOT'),(23,30,'Manager',14,19,'Manager'),(24,23,'Administrator',15,18,'Administrator'),(25,24,'Super Administrator',16,17,'Super Administrator');
/*!40000 ALTER TABLE `jos_core_acl_aro_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_acl_aro_map`
--

DROP TABLE IF EXISTS `jos_core_acl_aro_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_acl_aro_map`
--

LOCK TABLES `jos_core_acl_aro_map` WRITE;
/*!40000 ALTER TABLE `jos_core_acl_aro_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_core_acl_aro_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_acl_aro_sections`
--

DROP TABLE IF EXISTS `jos_core_acl_aro_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_acl_aro_sections`
--

LOCK TABLES `jos_core_acl_aro_sections` WRITE;
/*!40000 ALTER TABLE `jos_core_acl_aro_sections` DISABLE KEYS */;
INSERT INTO `jos_core_acl_aro_sections` VALUES (10,'users',1,'Users',0);
/*!40000 ALTER TABLE `jos_core_acl_aro_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_acl_groups_aro_map`
--

DROP TABLE IF EXISTS `jos_core_acl_groups_aro_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_acl_groups_aro_map`
--

LOCK TABLES `jos_core_acl_groups_aro_map` WRITE;
/*!40000 ALTER TABLE `jos_core_acl_groups_aro_map` DISABLE KEYS */;
INSERT INTO `jos_core_acl_groups_aro_map` VALUES (19,'',11),(19,'',12),(19,'',14),(19,'',15),(19,'',16),(19,'',19),(19,'',20),(19,'',29),(19,'',30),(19,'',31),(19,'',36),(19,'',51),(25,'',10);
/*!40000 ALTER TABLE `jos_core_acl_groups_aro_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_log_items`
--

DROP TABLE IF EXISTS `jos_core_log_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_log_items`
--

LOCK TABLES `jos_core_log_items` WRITE;
/*!40000 ALTER TABLE `jos_core_log_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_core_log_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_core_log_searches`
--

DROP TABLE IF EXISTS `jos_core_log_searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_core_log_searches`
--

LOCK TABLES `jos_core_log_searches` WRITE;
/*!40000 ALTER TABLE `jos_core_log_searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_core_log_searches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_custom_properties`
--

DROP TABLE IF EXISTS `jos_custom_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_custom_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(100) NOT NULL DEFAULT 'content',
  `content_id` int(11) NOT NULL DEFAULT '0',
  `field_id` int(11) NOT NULL DEFAULT '0',
  `value_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_c_f_v` (`ref_table`,`content_id`,`field_id`,`value_id`),
  KEY `content_id` (`content_id`),
  KEY `cp_field_id` (`field_id`),
  KEY `cp_value_id` (`value_id`),
  KEY `ref_table` (`ref_table`)
) ENGINE=MyISAM AUTO_INCREMENT=411 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_custom_properties`
--

LOCK TABLES `jos_custom_properties` WRITE;
/*!40000 ALTER TABLE `jos_custom_properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_custom_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_custom_properties_fields`
--

DROP TABLE IF EXISTS `jos_custom_properties_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_custom_properties_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `label` varchar(255) NOT NULL,
  `field_type` char(50) NOT NULL,
  `modules` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `state` (`published`),
  KEY `access` (`access`),
  KEY `checked_out` (`checked_out`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_custom_properties_fields`
--

LOCK TABLES `jos_custom_properties_fields` WRITE;
/*!40000 ALTER TABLE `jos_custom_properties_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_custom_properties_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_custom_properties_values`
--

DROP TABLE IF EXISTS `jos_custom_properties_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_custom_properties_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL DEFAULT '0',
  `name` char(50) NOT NULL,
  `label` varchar(255) NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `name` (`name`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_custom_properties_values`
--

LOCK TABLES `jos_custom_properties_values` WRITE;
/*!40000 ALTER TABLE `jos_custom_properties_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_custom_properties_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_dbcache`
--

DROP TABLE IF EXISTS `jos_dbcache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_dbcache` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `groupname` varchar(32) NOT NULL DEFAULT '',
  `expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `value` mediumblob NOT NULL,
  PRIMARY KEY (`id`,`groupname`),
  KEY `expire` (`expire`,`groupname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_dbcache`
--

LOCK TABLES `jos_dbcache` WRITE;
/*!40000 ALTER TABLE `jos_dbcache` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_dbcache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_docman`
--

DROP TABLE IF EXISTS `jos_docman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_docman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '1',
  `dmname` text NOT NULL,
  `dmdescription` longtext,
  `dmdate_published` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dmowner` int(4) NOT NULL DEFAULT '-1',
  `dmfilename` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `dmurl` text,
  `dmcounter` int(11) DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `dmthumbnail` text,
  `dmlastupdateon` datetime DEFAULT '0000-00-00 00:00:00',
  `dmlastupdateby` int(5) NOT NULL DEFAULT '-1',
  `dmsubmitedby` int(5) NOT NULL DEFAULT '-1',
  `dmmantainedby` int(5) DEFAULT '0',
  `dmlicense_id` int(5) DEFAULT '0',
  `dmlicense_display` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `attribs` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pub_appr_own_cat_name` (`published`,`approved`,`dmowner`,`catid`,`dmname`(64)),
  KEY `appr_pub_own_cat_date` (`approved`,`published`,`dmowner`,`catid`,`dmdate_published`),
  KEY `own_pub_appr_cat_count` (`dmowner`,`published`,`approved`,`catid`,`dmcounter`)
) ENGINE=MyISAM AUTO_INCREMENT=1218 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_docman`
--

LOCK TABLES `jos_docman` WRITE;
/*!40000 ALTER TABLE `jos_docman` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_docman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_docman_groups`
--

DROP TABLE IF EXISTS `jos_docman_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_docman_groups` (
  `groups_id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_name` text NOT NULL,
  `groups_description` longtext,
  `groups_access` tinyint(4) NOT NULL DEFAULT '1',
  `groups_members` text,
  PRIMARY KEY (`groups_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_docman_groups`
--

LOCK TABLES `jos_docman_groups` WRITE;
/*!40000 ALTER TABLE `jos_docman_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_docman_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_docman_history`
--

DROP TABLE IF EXISTS `jos_docman_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_docman_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `revision` int(5) NOT NULL DEFAULT '1',
  `his_date` datetime NOT NULL,
  `his_who` int(11) NOT NULL,
  `his_obs` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_docman_history`
--

LOCK TABLES `jos_docman_history` WRITE;
/*!40000 ALTER TABLE `jos_docman_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_docman_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_docman_licenses`
--

DROP TABLE IF EXISTS `jos_docman_licenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_docman_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `license` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_docman_licenses`
--

LOCK TABLES `jos_docman_licenses` WRITE;
/*!40000 ALTER TABLE `jos_docman_licenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_docman_licenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_docman_log`
--

DROP TABLE IF EXISTS `jos_docman_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_docman_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_docid` int(11) NOT NULL,
  `log_ip` text NOT NULL,
  `log_datetime` datetime NOT NULL,
  `log_user` int(11) NOT NULL DEFAULT '0',
  `log_browser` text,
  `log_os` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_docman_log`
--

LOCK TABLES `jos_docman_log` WRITE;
/*!40000 ALTER TABLE `jos_docman_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_docman_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_categories`
--

DROP TABLE IF EXISTS `jos_eventlist_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `catname` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `catdescription` mediumtext NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `groupid` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_categories`
--

LOCK TABLES `jos_eventlist_categories` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_eventlist_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_events`
--

DROP TABLE IF EXISTS `jos_eventlist_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `locid` int(11) unsigned NOT NULL DEFAULT '0',
  `catsid` int(11) unsigned NOT NULL DEFAULT '0',
  `dates` date NOT NULL DEFAULT '0000-00-00',
  `enddates` date DEFAULT NULL,
  `times` time DEFAULT NULL,
  `endtimes` time DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `author_ip` varchar(15) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `datdescription` mediumtext NOT NULL,
  `meta_keywords` varchar(200) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `recurrence_number` int(2) NOT NULL DEFAULT '0',
  `recurrence_type` int(2) NOT NULL DEFAULT '0',
  `recurrence_counter` date NOT NULL DEFAULT '0000-00-00',
  `datimage` varchar(100) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registra` tinyint(1) NOT NULL DEFAULT '0',
  `unregistra` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_events`
--

LOCK TABLES `jos_eventlist_events` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_eventlist_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_groupmembers`
--

DROP TABLE IF EXISTS `jos_eventlist_groupmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_groupmembers` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `member` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_groupmembers`
--

LOCK TABLES `jos_eventlist_groupmembers` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_groupmembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_eventlist_groupmembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_groups`
--

DROP TABLE IF EXISTS `jos_eventlist_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_groups`
--

LOCK TABLES `jos_eventlist_groups` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_eventlist_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_register`
--

DROP TABLE IF EXISTS `jos_eventlist_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_register` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `uregdate` varchar(50) NOT NULL DEFAULT '',
  `uip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_register`
--

LOCK TABLES `jos_eventlist_register` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_register` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_eventlist_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_settings`
--

DROP TABLE IF EXISTS `jos_eventlist_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_settings` (
  `id` int(11) NOT NULL,
  `oldevent` tinyint(4) NOT NULL,
  `minus` tinyint(4) NOT NULL,
  `showtime` tinyint(4) NOT NULL,
  `showtitle` tinyint(4) NOT NULL,
  `showlocate` tinyint(4) NOT NULL,
  `showcity` tinyint(4) NOT NULL,
  `showmapserv` tinyint(4) NOT NULL,
  `map24id` varchar(20) NOT NULL,
  `gmapkey` varchar(255) NOT NULL,
  `tablewidth` varchar(20) NOT NULL,
  `datewidth` varchar(20) NOT NULL,
  `titlewidth` varchar(20) NOT NULL,
  `locationwidth` varchar(20) NOT NULL,
  `citywidth` varchar(20) NOT NULL,
  `datename` varchar(100) NOT NULL,
  `titlename` varchar(100) NOT NULL,
  `locationname` varchar(100) NOT NULL,
  `cityname` varchar(100) NOT NULL,
  `formatdate` varchar(100) NOT NULL,
  `formattime` varchar(100) NOT NULL,
  `timename` varchar(50) NOT NULL,
  `showdetails` tinyint(4) NOT NULL,
  `showtimedetails` tinyint(4) NOT NULL,
  `showevdescription` tinyint(4) NOT NULL,
  `showdetailstitle` tinyint(4) NOT NULL,
  `showdetailsadress` tinyint(4) NOT NULL,
  `showlocdescription` tinyint(4) NOT NULL,
  `showlinkvenue` tinyint(4) NOT NULL,
  `showdetlinkvenue` tinyint(4) NOT NULL,
  `delivereventsyes` tinyint(4) NOT NULL,
  `mailinform` tinyint(4) NOT NULL,
  `mailinformrec` varchar(150) NOT NULL,
  `mailinformuser` tinyint(4) NOT NULL,
  `datdesclimit` varchar(15) NOT NULL,
  `autopubl` tinyint(4) NOT NULL,
  `deliverlocsyes` tinyint(4) NOT NULL,
  `autopublocate` tinyint(4) NOT NULL,
  `showcat` tinyint(4) NOT NULL,
  `catfrowidth` varchar(20) NOT NULL,
  `catfroname` varchar(100) NOT NULL,
  `evdelrec` tinyint(4) NOT NULL,
  `evpubrec` tinyint(4) NOT NULL,
  `locdelrec` tinyint(4) NOT NULL,
  `locpubrec` tinyint(4) NOT NULL,
  `sizelimit` varchar(20) NOT NULL,
  `imagehight` varchar(20) NOT NULL,
  `imagewidth` varchar(20) NOT NULL,
  `gddisabled` tinyint(4) NOT NULL,
  `imageenabled` tinyint(4) NOT NULL,
  `comunsolution` tinyint(4) NOT NULL,
  `comunoption` tinyint(4) NOT NULL,
  `catlinklist` tinyint(4) NOT NULL,
  `showfroregistra` tinyint(4) NOT NULL,
  `showfrounregistra` tinyint(4) NOT NULL,
  `eventedit` tinyint(4) NOT NULL,
  `eventeditrec` tinyint(4) NOT NULL,
  `eventowner` tinyint(4) NOT NULL,
  `venueedit` tinyint(4) NOT NULL,
  `venueeditrec` tinyint(4) NOT NULL,
  `venueowner` tinyint(4) NOT NULL,
  `lightbox` tinyint(4) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `showstate` tinyint(4) NOT NULL,
  `statename` varchar(100) NOT NULL,
  `statewidth` varchar(20) NOT NULL,
  `regname` tinyint(4) NOT NULL,
  `storeip` tinyint(4) NOT NULL,
  `commentsystem` tinyint(4) NOT NULL,
  `lastupdate` varchar(20) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_settings`
--

LOCK TABLES `jos_eventlist_settings` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_settings` DISABLE KEYS */;
INSERT INTO `jos_eventlist_settings` VALUES (1,0,1,0,1,1,0,2,'','ABQIAAAArn_k9un_GPsEvKb_x8Vr5RQKLWra3tKsSJ01lNesvMmvYom4ChTF8Jm-yfb9GCYqPhtNSX6_974iww','100%','10%','52%','23%','','時間','活動名稱','地點','地區','%Y.%m.%d','%H:%M','',1,1,1,1,1,1,1,2,24,1,'allywang@iis.sinica.edu.tw,freddi.chen@iis.sinica.edu.tw,rockhung@citi.sinica.edu.tw',1,'1000',-2,24,24,1,'10%','類別',0,0,0,0,'200','160','200',1,1,1,1,1,1,1,24,0,0,24,0,0,1,'[title], [a_name], [catsid], [times]','The event titled [title] starts on [dates]!',0,'State','0',0,1,0,'1286957824',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jos_eventlist_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_eventlist_venues`
--

DROP TABLE IF EXISTS `jos_eventlist_venues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_eventlist_venues` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venue` varchar(50) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `street` varchar(50) DEFAULT NULL,
  `plz` varchar(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `locdescription` mediumtext NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `locimage` varchar(100) NOT NULL DEFAULT '',
  `map` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `author_ip` varchar(15) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_eventlist_venues`
--

LOCK TABLES `jos_eventlist_venues` WRITE;
/*!40000 ALTER TABLE `jos_eventlist_venues` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_eventlist_venues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_announcement`
--

DROP TABLE IF EXISTS `jos_fb_announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_announcement` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `sdescription` text NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` tinyint(4) NOT NULL DEFAULT '0',
  `showdate` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_announcement`
--

LOCK TABLES `jos_fb_announcement` WRITE;
/*!40000 ALTER TABLE `jos_fb_announcement` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_attachments`
--

DROP TABLE IF EXISTS `jos_fb_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_attachments` (
  `mesid` int(11) NOT NULL DEFAULT '0',
  `filelocation` text NOT NULL,
  KEY `mesid` (`mesid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_attachments`
--

LOCK TABLES `jos_fb_attachments` WRITE;
/*!40000 ALTER TABLE `jos_fb_attachments` DISABLE KEYS */;
INSERT INTO `jos_fb_attachments` VALUES (37,'/usr/local/www/ossf/components/com_fireboard/uploaded/images/3.jpg'),(121,'/usr/local/www/new/images/fbfiles/images/3-4eaa6134368f010d90611f1ac32a4ac8.gif'),(124,'/usr/local/www/new/images/fbfiles/images/1340993645.jpg'),(192,'/usr/local/www/phpsys/whoswho/images/fbfiles/images/pics.pics'),(192,'/usr/local/www/phpsys/whoswho/images/fbfiles/files/pics.pics'),(378,'/usr/local/www/phpsys/whoswho/images/fbfiles/images/mind_map.jpg');
/*!40000 ALTER TABLE `jos_fb_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_categories`
--

DROP TABLE IF EXISTS `jos_fb_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `name` tinytext,
  `cat_emoticon` tinyint(4) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `alert_admin` tinyint(4) NOT NULL DEFAULT '0',
  `moderated` tinyint(4) NOT NULL DEFAULT '1',
  `moderators` varchar(15) DEFAULT NULL,
  `pub_access` tinyint(4) DEFAULT '1',
  `pub_recurse` tinyint(4) DEFAULT '1',
  `admin_access` tinyint(4) DEFAULT '0',
  `admin_recurse` tinyint(4) DEFAULT '1',
  `ordering` tinyint(4) NOT NULL DEFAULT '0',
  `future2` int(11) DEFAULT '0',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `checked_out` tinyint(4) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `headerdesc` text NOT NULL,
  `class_sfx` varchar(20) NOT NULL DEFAULT '',
  `id_last_msg` int(10) NOT NULL DEFAULT '0',
  `numTopics` mediumint(8) NOT NULL DEFAULT '0',
  `numPosts` mediumint(8) NOT NULL DEFAULT '0',
  `time_last_msg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `published_pubaccess_id` (`published`,`pub_access`,`id`),
  KEY `msg_id` (`id_last_msg`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_categories`
--

LOCK TABLES `jos_fb_categories` WRITE;
/*!40000 ALTER TABLE `jos_fb_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_config`
--

DROP TABLE IF EXISTS `jos_fb_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_config` (
  `board_title` text,
  `email` text,
  `board_offline` int(11) DEFAULT NULL,
  `board_ofset` int(11) DEFAULT NULL,
  `offline_message` text,
  `default_view` text,
  `enablerss` int(11) DEFAULT NULL,
  `enablepdf` int(11) DEFAULT NULL,
  `threads_per_page` int(11) DEFAULT NULL,
  `messages_per_page` int(11) DEFAULT NULL,
  `messages_per_page_search` int(11) DEFAULT NULL,
  `showhistory` int(11) DEFAULT NULL,
  `historylimit` int(11) DEFAULT NULL,
  `shownew` int(11) DEFAULT NULL,
  `newchar` text,
  `jmambot` int(11) DEFAULT NULL,
  `disemoticons` int(11) DEFAULT NULL,
  `template` text,
  `templateimagepath` text,
  `joomlastyle` int(11) DEFAULT NULL,
  `showannouncement` int(11) DEFAULT NULL,
  `avataroncat` int(11) DEFAULT NULL,
  `catimagepath` text,
  `numchildcolumn` int(11) DEFAULT NULL,
  `showchildcaticon` int(11) DEFAULT NULL,
  `annmodid` int(11) DEFAULT NULL,
  `rtewidth` int(11) DEFAULT NULL,
  `rteheight` int(11) DEFAULT NULL,
  `enablerulespage` int(11) DEFAULT NULL,
  `enableforumjump` int(11) DEFAULT NULL,
  `reportmsg` int(11) DEFAULT NULL,
  `username` int(11) DEFAULT NULL,
  `askemail` int(11) DEFAULT NULL,
  `showemail` int(11) DEFAULT NULL,
  `showuserstats` int(11) DEFAULT NULL,
  `poststats` int(11) DEFAULT NULL,
  `statscolor` int(11) DEFAULT NULL,
  `showkarma` int(11) DEFAULT NULL,
  `useredit` int(11) DEFAULT NULL,
  `useredittime` int(11) DEFAULT NULL,
  `useredittimegrace` int(11) DEFAULT NULL,
  `editmarkup` int(11) DEFAULT NULL,
  `allowsubscriptions` int(11) DEFAULT NULL,
  `subscriptionschecked` int(11) DEFAULT NULL,
  `allowfavorites` int(11) DEFAULT NULL,
  `wrap` int(11) DEFAULT NULL,
  `maxsubject` int(11) DEFAULT NULL,
  `maxsig` int(11) DEFAULT NULL,
  `regonly` int(11) DEFAULT NULL,
  `changename` int(11) DEFAULT NULL,
  `pubwrite` int(11) DEFAULT NULL,
  `floodprotection` int(11) DEFAULT NULL,
  `mailmod` int(11) DEFAULT NULL,
  `mailadmin` int(11) DEFAULT NULL,
  `captcha` int(11) DEFAULT NULL,
  `mailfull` int(11) DEFAULT NULL,
  `allowavatar` int(11) DEFAULT NULL,
  `allowavatarupload` int(11) DEFAULT NULL,
  `allowavatargallery` int(11) DEFAULT NULL,
  `imageprocessor` text,
  `avatarsmallheight` int(11) DEFAULT NULL,
  `avatarsmallwidth` int(11) DEFAULT NULL,
  `avatarheight` int(11) DEFAULT NULL,
  `avatarwidth` int(11) DEFAULT NULL,
  `avatarlargeheight` int(11) DEFAULT NULL,
  `avatarlargewidth` int(11) DEFAULT NULL,
  `avatarquality` int(11) DEFAULT NULL,
  `avatarsize` int(11) DEFAULT NULL,
  `allowimageupload` int(11) DEFAULT NULL,
  `allowimageregupload` int(11) DEFAULT NULL,
  `imageheight` int(11) DEFAULT NULL,
  `imagewidth` int(11) DEFAULT NULL,
  `imagesize` int(11) DEFAULT NULL,
  `allowfileupload` int(11) DEFAULT NULL,
  `allowfileregupload` int(11) DEFAULT NULL,
  `filetypes` text,
  `filesize` int(11) DEFAULT NULL,
  `showranking` int(11) DEFAULT NULL,
  `rankimages` int(11) DEFAULT NULL,
  `avatar_src` text,
  `fb_profile` text,
  `pm_component` text,
  `cb_profile` int(11) DEFAULT NULL,
  `badwords` int(11) DEFAULT NULL,
  `discussbot` int(11) DEFAULT NULL,
  `userlist_rows` int(11) DEFAULT NULL,
  `userlist_online` int(11) DEFAULT NULL,
  `userlist_avatar` int(11) DEFAULT NULL,
  `userlist_name` int(11) DEFAULT NULL,
  `userlist_username` int(11) DEFAULT NULL,
  `userlist_group` int(11) DEFAULT NULL,
  `userlist_posts` int(11) DEFAULT NULL,
  `userlist_karma` int(11) DEFAULT NULL,
  `userlist_email` int(11) DEFAULT NULL,
  `userlist_usertype` int(11) DEFAULT NULL,
  `userlist_joindate` int(11) DEFAULT NULL,
  `userlist_lastvisitdate` int(11) DEFAULT NULL,
  `userlist_userhits` int(11) DEFAULT NULL,
  `showlatest` int(11) DEFAULT NULL,
  `latestcount` int(11) DEFAULT NULL,
  `latestcountperpage` int(11) DEFAULT NULL,
  `latestcategory` int(11) DEFAULT NULL,
  `latestsinglesubject` int(11) DEFAULT NULL,
  `latestreplysubject` int(11) DEFAULT NULL,
  `latestsubjectlength` int(11) DEFAULT NULL,
  `latestshowdate` int(11) DEFAULT NULL,
  `latestshowhits` int(11) DEFAULT NULL,
  `latestshowauthor` int(11) DEFAULT NULL,
  `showstats` int(11) DEFAULT NULL,
  `showwhoisonline` int(11) DEFAULT NULL,
  `showgenstats` int(11) DEFAULT NULL,
  `showpopuserstats` int(11) DEFAULT NULL,
  `popusercount` int(11) DEFAULT NULL,
  `showpopsubjectstats` int(11) DEFAULT NULL,
  `popsubjectcount` int(11) DEFAULT NULL,
  `usernamechange` int(11) DEFAULT NULL,
  `rules_infb` int(11) DEFAULT NULL,
  `rules_cid` int(11) DEFAULT NULL,
  `rules_link` text,
  `enablehelppage` int(11) DEFAULT NULL,
  `help_infb` int(11) DEFAULT NULL,
  `help_cid` int(11) DEFAULT NULL,
  `help_link` text,
  `showspoilertag` int(11) DEFAULT NULL,
  `showvideotag` int(11) DEFAULT NULL,
  `showebaytag` int(11) DEFAULT NULL,
  `trimlongurls` int(11) DEFAULT NULL,
  `trimlongurlsfront` int(11) DEFAULT NULL,
  `trimlongurlsback` int(11) DEFAULT NULL,
  `autoembedyoutube` int(11) DEFAULT NULL,
  `autoembedebay` int(11) DEFAULT NULL,
  `ebaylanguagecode` text,
  `fbsessiontimeout` int(11) DEFAULT NULL,
  `highlightcode` int(11) DEFAULT NULL,
  `rsstype` text,
  `rsshistory` text,
  `fbdefaultpage` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_config`
--

LOCK TABLES `jos_fb_config` WRITE;
/*!40000 ALTER TABLE `jos_fb_config` DISABLE KEYS */;
INSERT INTO `jos_fb_config` VALUES ('Forum','contact@openfoundry.org',0,0,'<h2>The Forum is currently offline for maintenance.</h2>\r\n    Check back soon!                        ','flat',1,1,50,30,15,1,6,1,'NEW!',1,0,'default_ex','default',0,0,0,'category_images/',2,1,62,450,300,1,1,1,1,0,0,1,1,9,1,1,0,600,1,1,1,1,250,50,300,0,0,0,0,1,1,0,1,1,1,1,'gd2',50,50,100,100,250,250,65,2048,1,1,800,800,1024,0,1,'zip,txt,doc,gz,tgz',120,1,1,'cb','cb','uddeim',1,0,0,30,1,1,0,1,0,1,1,0,0,1,1,1,1,10,5,0,1,1,100,1,1,1,0,0,0,0,5,1,5,0,1,1,'http://www.bestofjoomla.com/',0,0,1,'http://www.bestofjoomla.com/',0,1,0,0,40,20,1,1,'en-us',1800,1,'thread','month','categories');
/*!40000 ALTER TABLE `jos_fb_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_config_backup`
--

DROP TABLE IF EXISTS `jos_fb_config_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_config_backup` (
  `board_title` text,
  `email` text,
  `board_offline` int(11) DEFAULT NULL,
  `board_ofset` int(11) DEFAULT NULL,
  `offline_message` text,
  `default_view` text,
  `enablerss` int(11) DEFAULT NULL,
  `enablepdf` int(11) DEFAULT NULL,
  `threads_per_page` int(11) DEFAULT NULL,
  `messages_per_page` int(11) DEFAULT NULL,
  `messages_per_page_search` int(11) DEFAULT NULL,
  `showhistory` int(11) DEFAULT NULL,
  `historylimit` int(11) DEFAULT NULL,
  `shownew` int(11) DEFAULT NULL,
  `newchar` text,
  `jmambot` int(11) DEFAULT NULL,
  `disemoticons` int(11) DEFAULT NULL,
  `template` text,
  `templateimagepath` text,
  `joomlastyle` int(11) DEFAULT NULL,
  `showannouncement` int(11) DEFAULT NULL,
  `avataroncat` int(11) DEFAULT NULL,
  `catimagepath` text,
  `numchildcolumn` int(11) DEFAULT NULL,
  `showchildcaticon` int(11) DEFAULT NULL,
  `annmodid` int(11) DEFAULT NULL,
  `rtewidth` int(11) DEFAULT NULL,
  `rteheight` int(11) DEFAULT NULL,
  `enablerulespage` int(11) DEFAULT NULL,
  `enableforumjump` int(11) DEFAULT NULL,
  `reportmsg` int(11) DEFAULT NULL,
  `username` int(11) DEFAULT NULL,
  `askemail` int(11) DEFAULT NULL,
  `showemail` int(11) DEFAULT NULL,
  `showuserstats` int(11) DEFAULT NULL,
  `poststats` int(11) DEFAULT NULL,
  `statscolor` int(11) DEFAULT NULL,
  `showkarma` int(11) DEFAULT NULL,
  `useredit` int(11) DEFAULT NULL,
  `useredittime` int(11) DEFAULT NULL,
  `useredittimegrace` int(11) DEFAULT NULL,
  `editmarkup` int(11) DEFAULT NULL,
  `allowsubscriptions` int(11) DEFAULT NULL,
  `subscriptionschecked` int(11) DEFAULT NULL,
  `allowfavorites` int(11) DEFAULT NULL,
  `wrap` int(11) DEFAULT NULL,
  `maxsubject` int(11) DEFAULT NULL,
  `maxsig` int(11) DEFAULT NULL,
  `regonly` int(11) DEFAULT NULL,
  `changename` int(11) DEFAULT NULL,
  `pubwrite` int(11) DEFAULT NULL,
  `floodprotection` int(11) DEFAULT NULL,
  `mailmod` int(11) DEFAULT NULL,
  `mailadmin` int(11) DEFAULT NULL,
  `captcha` int(11) DEFAULT NULL,
  `mailfull` int(11) DEFAULT NULL,
  `allowavatar` int(11) DEFAULT NULL,
  `allowavatarupload` int(11) DEFAULT NULL,
  `allowavatargallery` int(11) DEFAULT NULL,
  `imageprocessor` text,
  `avatarsmallheight` int(11) DEFAULT NULL,
  `avatarsmallwidth` int(11) DEFAULT NULL,
  `avatarheight` int(11) DEFAULT NULL,
  `avatarwidth` int(11) DEFAULT NULL,
  `avatarlargeheight` int(11) DEFAULT NULL,
  `avatarlargewidth` int(11) DEFAULT NULL,
  `avatarquality` int(11) DEFAULT NULL,
  `avatarsize` int(11) DEFAULT NULL,
  `allowimageupload` int(11) DEFAULT NULL,
  `allowimageregupload` int(11) DEFAULT NULL,
  `imageheight` int(11) DEFAULT NULL,
  `imagewidth` int(11) DEFAULT NULL,
  `imagesize` int(11) DEFAULT NULL,
  `allowfileupload` int(11) DEFAULT NULL,
  `allowfileregupload` int(11) DEFAULT NULL,
  `filetypes` text,
  `filesize` int(11) DEFAULT NULL,
  `showranking` int(11) DEFAULT NULL,
  `rankimages` int(11) DEFAULT NULL,
  `avatar_src` text,
  `fb_profile` text,
  `pm_component` text,
  `cb_profile` int(11) DEFAULT NULL,
  `badwords` int(11) DEFAULT NULL,
  `discussbot` int(11) DEFAULT NULL,
  `userlist_rows` int(11) DEFAULT NULL,
  `userlist_online` int(11) DEFAULT NULL,
  `userlist_avatar` int(11) DEFAULT NULL,
  `userlist_name` int(11) DEFAULT NULL,
  `userlist_username` int(11) DEFAULT NULL,
  `userlist_group` int(11) DEFAULT NULL,
  `userlist_posts` int(11) DEFAULT NULL,
  `userlist_karma` int(11) DEFAULT NULL,
  `userlist_email` int(11) DEFAULT NULL,
  `userlist_usertype` int(11) DEFAULT NULL,
  `userlist_joindate` int(11) DEFAULT NULL,
  `userlist_lastvisitdate` int(11) DEFAULT NULL,
  `userlist_userhits` int(11) DEFAULT NULL,
  `showlatest` int(11) DEFAULT NULL,
  `latestcount` int(11) DEFAULT NULL,
  `latestcountperpage` int(11) DEFAULT NULL,
  `latestcategory` int(11) DEFAULT NULL,
  `latestsinglesubject` int(11) DEFAULT NULL,
  `latestreplysubject` int(11) DEFAULT NULL,
  `latestsubjectlength` int(11) DEFAULT NULL,
  `latestshowdate` int(11) DEFAULT NULL,
  `latestshowhits` int(11) DEFAULT NULL,
  `latestshowauthor` int(11) DEFAULT NULL,
  `showstats` int(11) DEFAULT NULL,
  `showwhoisonline` int(11) DEFAULT NULL,
  `showgenstats` int(11) DEFAULT NULL,
  `showpopuserstats` int(11) DEFAULT NULL,
  `popusercount` int(11) DEFAULT NULL,
  `showpopsubjectstats` int(11) DEFAULT NULL,
  `popsubjectcount` int(11) DEFAULT NULL,
  `usernamechange` int(11) DEFAULT NULL,
  `rules_infb` int(11) DEFAULT NULL,
  `rules_cid` int(11) DEFAULT NULL,
  `rules_link` text,
  `enablehelppage` int(11) DEFAULT NULL,
  `help_infb` int(11) DEFAULT NULL,
  `help_cid` int(11) DEFAULT NULL,
  `help_link` text,
  `showspoilertag` int(11) DEFAULT NULL,
  `showvideotag` int(11) DEFAULT NULL,
  `showebaytag` int(11) DEFAULT NULL,
  `trimlongurls` int(11) DEFAULT NULL,
  `trimlongurlsfront` int(11) DEFAULT NULL,
  `trimlongurlsback` int(11) DEFAULT NULL,
  `autoembedyoutube` int(11) DEFAULT NULL,
  `autoembedebay` int(11) DEFAULT NULL,
  `ebaylanguagecode` text,
  `fbsessiontimeout` int(11) DEFAULT NULL,
  `highlightcode` int(11) DEFAULT NULL,
  `rsstype` text,
  `rsshistory` text,
  `fbdefaultpage` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_config_backup`
--

LOCK TABLES `jos_fb_config_backup` WRITE;
/*!40000 ALTER TABLE `jos_fb_config_backup` DISABLE KEYS */;
INSERT INTO `jos_fb_config_backup` VALUES ('Forum','contact@openfoundry.org',0,0,'<h2>The Forum is currently offline for maintenance.</h2>\r\n    Check back soon!                        ','threaded',1,1,50,30,15,1,6,1,'NEW!',1,0,'default_ex','default',0,0,0,'category_images/',2,1,62,450,300,1,1,1,1,0,0,1,1,9,1,1,0,600,1,1,1,1,250,50,300,0,0,0,0,1,1,0,1,1,1,1,'gd2',50,50,100,100,250,250,65,2048,1,1,800,800,200,0,1,'zip,txt,doc,gz,tgz',120,1,1,'cb','cb','uddeim',1,0,0,30,1,1,0,1,0,1,1,0,0,1,1,1,1,10,5,0,1,1,100,1,1,1,0,0,0,0,5,1,5,0,1,1,'http://www.bestofjoomla.com/',0,0,1,'http://www.bestofjoomla.com/',0,1,0,0,40,20,1,1,'en-us',1800,1,'thread','month','categories');
/*!40000 ALTER TABLE `jos_fb_config_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_favorites`
--

DROP TABLE IF EXISTS `jos_fb_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_favorites` (
  `thread` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  KEY `thread` (`thread`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_favorites`
--

LOCK TABLES `jos_fb_favorites` WRITE;
/*!40000 ALTER TABLE `jos_fb_favorites` DISABLE KEYS */;
INSERT INTO `jos_fb_favorites` VALUES (305,1593),(130,1435),(114,1435),(463,2258),(502,2207);
/*!40000 ALTER TABLE `jos_fb_favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_groups`
--

DROP TABLE IF EXISTS `jos_fb_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_groups` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_groups`
--

LOCK TABLES `jos_fb_groups` WRITE;
/*!40000 ALTER TABLE `jos_fb_groups` DISABLE KEYS */;
INSERT INTO `jos_fb_groups` VALUES (1,'Registered');
/*!40000 ALTER TABLE `jos_fb_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_messages`
--

DROP TABLE IF EXISTS `jos_fb_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `thread` int(11) DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `name` tinytext,
  `userid` int(11) NOT NULL DEFAULT '0',
  `email` tinytext,
  `subject` tinytext,
  `time` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) DEFAULT NULL,
  `topic_emoticon` int(11) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `hold` tinyint(4) NOT NULL DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `hits` int(11) DEFAULT '0',
  `moved` tinyint(4) DEFAULT '0',
  `modified_by` int(7) DEFAULT NULL,
  `modified_time` int(11) DEFAULT NULL,
  `modified_reason` tinytext,
  PRIMARY KEY (`id`),
  KEY `thread` (`thread`),
  KEY `parent` (`parent`),
  KEY `catid` (`catid`),
  KEY `ip` (`ip`),
  KEY `userid` (`userid`),
  KEY `time` (`time`),
  KEY `locked` (`locked`),
  KEY `hold_time` (`hold`,`time`)
) ENGINE=MyISAM AUTO_INCREMENT=560 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_messages`
--

LOCK TABLES `jos_fb_messages` WRITE;
/*!40000 ALTER TABLE `jos_fb_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_messages_text`
--

DROP TABLE IF EXISTS `jos_fb_messages_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_messages_text` (
  `mesid` int(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  PRIMARY KEY (`mesid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_messages_text`
--

LOCK TABLES `jos_fb_messages_text` WRITE;
/*!40000 ALTER TABLE `jos_fb_messages_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_messages_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_moderation`
--

DROP TABLE IF EXISTS `jos_fb_moderation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_moderation` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `future1` tinyint(4) DEFAULT NULL,
  `future2` int(11) DEFAULT NULL,
  PRIMARY KEY (`catid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_moderation`
--

LOCK TABLES `jos_fb_moderation` WRITE;
/*!40000 ALTER TABLE `jos_fb_moderation` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_moderation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_ranks`
--

DROP TABLE IF EXISTS `jos_fb_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_ranks` (
  `rank_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rank_image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_ranks`
--

LOCK TABLES `jos_fb_ranks` WRITE;
/*!40000 ALTER TABLE `jos_fb_ranks` DISABLE KEYS */;
INSERT INTO `jos_fb_ranks` VALUES (1,'Fresh Boarder',0,0,'rank1.gif'),(2,'Junior Boarder',5,0,'rank2.gif'),(3,'Senior Boarder',10,0,'rank3.gif'),(4,'Expert Boarder',80,0,'rank4.gif'),(5,'Gold Boarder',160,0,'rank5.gif'),(6,'Platinum Boarder',320,0,'rank6.gif'),(7,'Administrator',0,1,'rankadmin.gif'),(8,'Moderator',0,1,'rankmod.gif'),(9,'Spammer',0,1,'rankspammer.gif');
/*!40000 ALTER TABLE `jos_fb_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_sessions`
--

DROP TABLE IF EXISTS `jos_fb_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_sessions` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `allowed` text,
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `readtopics` text,
  `currvisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_sessions`
--

LOCK TABLES `jos_fb_sessions` WRITE;
/*!40000 ALTER TABLE `jos_fb_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_smileys`
--

DROP TABLE IF EXISTS `jos_fb_smileys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_smileys` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(12) NOT NULL DEFAULT '',
  `location` varchar(50) NOT NULL DEFAULT '',
  `greylocation` varchar(60) NOT NULL DEFAULT '',
  `emoticonbar` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_smileys`
--

LOCK TABLES `jos_fb_smileys` WRITE;
/*!40000 ALTER TABLE `jos_fb_smileys` DISABLE KEYS */;
INSERT INTO `jos_fb_smileys` VALUES (1,'B)','cool.png','cool-grey.png',1),(8,';)','wink.png','wink-grey.png',1),(3,':)','smile.png','smile-grey.png',1),(10,':P','tongue.png','tongue-grey.png',1),(6,':laugh:','laughing.png','laughing-grey.png',1),(17,':ohmy:','shocked.png','shocked-grey.png',1),(22,':sick:','sick.png','sick-grey.png',1),(14,':angry:','angry.png','angry-grey.png',1),(25,':blink:','blink.png','blink-grey.png',1),(2,':(','sad.png','sad-grey.png',1),(16,':unsure:','unsure.png','unsure-grey.png',1),(27,':kiss:','kissing.png','kissing-grey.png',1),(29,':woohoo:','w00t.png','w00t-grey.png',1),(21,':lol:','grin.png','grin-grey.png',1),(23,':silly:','silly.png','silly-grey.png',1),(35,':pinch:','pinch.png','pinch-grey.png',1),(30,':side:','sideways.png','sideways-grey.png',1),(34,':whistle:','whistling.png','whistling-grey.png',1),(33,':evil:','devil.png','devil-grey.png',1),(31,':S','dizzy.png','dizzy-grey.png',1),(26,':blush:','blush.png','blush-grey.png',1),(7,':cheer:','cheerful.png','cheerful-grey.png',1),(18,':huh:','wassat.png','wassat-grey.png',1),(19,':dry:','ermm.png','ermm-grey.png',1),(4,':-)','smile.png','smile-grey.png',0),(5,':-(','sad.png','sad-grey.png',0),(9,';-)','wink.png','wink-grey.png',0),(37,':D','laughing.png','laughing-grey.png',0),(12,':X','sick.png','sick-grey.png',0),(13,':x','sick.png','sick-grey.png',0),(15,':mad:','angry.png','angry-grey.png',0),(20,':ermm:','ermm.png','ermm-grey.png',0),(24,':y32b4:','silly.png','silly-grey.png',0),(28,':rolleyes:','blink.png','blink-grey.png',0),(32,':s','dizzy.png','dizzy-grey.png',0),(36,':p','tongue.png','tongue-grey.png',0);
/*!40000 ALTER TABLE `jos_fb_smileys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_subscriptions`
--

DROP TABLE IF EXISTS `jos_fb_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_subscriptions` (
  `thread` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `future1` int(11) DEFAULT '0',
  KEY `thread` (`thread`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_subscriptions`
--

LOCK TABLES `jos_fb_subscriptions` WRITE;
/*!40000 ALTER TABLE `jos_fb_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_users`
--

DROP TABLE IF EXISTS `jos_fb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_users` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `view` varchar(8) NOT NULL DEFAULT 'flat',
  `signature` text,
  `moderator` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `posts` int(11) DEFAULT '0',
  `avatar` varchar(50) DEFAULT NULL,
  `karma` int(11) DEFAULT '0',
  `karma_time` int(11) DEFAULT '0',
  `group_id` int(4) DEFAULT '1',
  `uhits` int(11) DEFAULT '0',
  `personalText` tinytext,
  `gender` tinyint(4) NOT NULL DEFAULT '0',
  `birthdate` date NOT NULL DEFAULT '0001-01-01',
  `location` varchar(50) DEFAULT NULL,
  `ICQ` varchar(50) DEFAULT NULL,
  `AIM` varchar(50) DEFAULT NULL,
  `YIM` varchar(50) DEFAULT NULL,
  `MSN` varchar(50) DEFAULT NULL,
  `SKYPE` varchar(50) DEFAULT NULL,
  `GTALK` varchar(50) DEFAULT NULL,
  `websitename` varchar(50) DEFAULT NULL,
  `websiteurl` varchar(50) DEFAULT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT '0',
  `hideEmail` tinyint(1) NOT NULL DEFAULT '1',
  `showOnline` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_users`
--

LOCK TABLES `jos_fb_users` WRITE;
/*!40000 ALTER TABLE `jos_fb_users` DISABLE KEYS */;
INSERT INTO `jos_fb_users` VALUES (62,'flat',NULL,1,0,6,NULL,0,1262843894,1,0,NULL,0,'0001-01-01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,1,1);
/*!40000 ALTER TABLE `jos_fb_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_version`
--

DROP TABLE IF EXISTS `jos_fb_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(20) NOT NULL,
  `versiondate` date NOT NULL,
  `installdate` date NOT NULL,
  `build` varchar(20) NOT NULL,
  `versionname` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_version`
--

LOCK TABLES `jos_fb_version` WRITE;
/*!40000 ALTER TABLE `jos_fb_version` DISABLE KEYS */;
INSERT INTO `jos_fb_version` VALUES (1,'1.0.0','2007-01-01','2009-01-08','0','Placeholder for unknown prior version'),(2,'1.0.5RC2','2008-10-27','2009-01-08','817','Redwood');
/*!40000 ALTER TABLE `jos_fb_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_fb_whoisonline`
--

DROP TABLE IF EXISTS `jos_fb_whoisonline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_fb_whoisonline` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `userid` int(7) NOT NULL DEFAULT '0',
  `time` varchar(14) NOT NULL DEFAULT '0',
  `item` int(6) DEFAULT '0',
  `what` varchar(255) DEFAULT '0',
  `func` varchar(50) DEFAULT NULL,
  `do` varchar(50) DEFAULT NULL,
  `task` varchar(50) DEFAULT NULL,
  `link` text,
  `userip` varchar(20) NOT NULL DEFAULT '',
  `user` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=274572 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_fb_whoisonline`
--

LOCK TABLES `jos_fb_whoisonline` WRITE;
/*!40000 ALTER TABLE `jos_fb_whoisonline` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_fb_whoisonline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_groups`
--

DROP TABLE IF EXISTS `jos_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_groups`
--

LOCK TABLES `jos_groups` WRITE;
/*!40000 ALTER TABLE `jos_groups` DISABLE KEYS */;
INSERT INTO `jos_groups` VALUES (0,'Public'),(1,'Registered'),(2,'Special');
/*!40000 ALTER TABLE `jos_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jcomments`
--

DROP TABLE IF EXISTS `jos_jcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jcomments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_group` varchar(255) NOT NULL DEFAULT '',
  `object_params` text NOT NULL,
  `lang` varchar(255) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `homepage` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isgood` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ispoor` smallint(5) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subscribe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_userid` (`userid`),
  KEY `idx_source` (`source`),
  KEY `idx_email` (`email`),
  KEY `idx_lang` (`lang`),
  KEY `idx_subscribe` (`subscribe`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_object` (`object_id`,`object_group`,`published`,`date`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jcomments`
--

LOCK TABLES `jos_jcomments` WRITE;
/*!40000 ALTER TABLE `jos_jcomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_jcomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jcomments_custom_bbcodes`
--

DROP TABLE IF EXISTS `jos_jcomments_custom_bbcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jcomments_custom_bbcodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `simple_pattern` varchar(255) NOT NULL DEFAULT '',
  `simple_replacement_html` text NOT NULL,
  `simple_replacement_text` text NOT NULL,
  `pattern` varchar(255) NOT NULL DEFAULT '',
  `replacement_html` text NOT NULL,
  `replacement_text` text NOT NULL,
  `button_acl` text NOT NULL,
  `button_open_tag` varchar(16) NOT NULL DEFAULT '',
  `button_close_tag` varchar(16) NOT NULL DEFAULT '',
  `button_title` varchar(255) NOT NULL DEFAULT '',
  `button_prompt` varchar(255) NOT NULL DEFAULT '',
  `button_image` varchar(255) NOT NULL DEFAULT '',
  `button_css` varchar(255) NOT NULL DEFAULT '',
  `button_enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jcomments_custom_bbcodes`
--

LOCK TABLES `jos_jcomments_custom_bbcodes` WRITE;
/*!40000 ALTER TABLE `jos_jcomments_custom_bbcodes` DISABLE KEYS */;
INSERT INTO `jos_jcomments_custom_bbcodes` VALUES (1,'YouTube Video','[youtube]http://www.youtube.com/watch?v={IDENTIFIER}[/youtube]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/{IDENTIFIER}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/{IDENTIFIER}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v={IDENTIFIER}','\\[youtube\\]http\\://www\\.youtube\\.com/watch\\?v\\=([A-Za-z0-9-_]+)\\[\\/youtube\\]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/${1}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/${1}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v=${1}','Unregistered,Registered,Author,Editor,Publisher,Manager,Administrator,Super Administrator','[youtube]','[/youtube]','YouTube Video','','','bbcode-youtube',1,1,1),(2,'Google Video','[google]http://video.google.com/videoplay?docid={IDENTIFIER}[/google]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId={IDENTIFIER}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid={IDENTIFIER}','\\[google\\]http\\://video\\.google\\.com/videoplay\\?docid\\=([A-Za-z0-9-_]+)\\[\\/google\\]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=${1}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid=${1}','Unregistered,Registered,Author,Editor,Publisher,Manager,Administrator,Super Administrator','[google]','[/google]','Google Video','','','bbcode-google',1,2,1),(3,'Wiki','[wiki]{TEXT}[/wiki]','<a href=\"http://www.wikipedia.org/wiki/{TEXT}\" title=\"{TEXT}\" target=\"_blank\">{TEXT}</a>','{TEXT}','\\[wiki\\]([\\w0-9-\\+\\.,_ ]+)\\[\\/wiki\\]','<a href=\"http://www.wikipedia.org/wiki/${1}\" title=\"${1}\" target=\"_blank\">${1}</a>','${1}','Unregistered,Registered,Author,Editor,Publisher,Manager,Administrator,Super Administrator','[wiki]','[/wiki]','Wikipedia','','','bbcode-wiki',1,3,1);
/*!40000 ALTER TABLE `jos_jcomments_custom_bbcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jcomments_settings`
--

DROP TABLE IF EXISTS `jos_jcomments_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jcomments_settings` (
  `component` varchar(50) NOT NULL DEFAULT '',
  `lang` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`component`,`lang`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jcomments_settings`
--

LOCK TABLES `jos_jcomments_settings` WRITE;
/*!40000 ALTER TABLE `jos_jcomments_settings` DISABLE KEYS */;
INSERT INTO `jos_jcomments_settings` VALUES ('','','enable_username_check','1'),('','','username_maxlength','20'),('','','forbidden_names','administrator,moderator,OSSF,ossf,OpenFoundry,openfoundry,manager'),('','','author_email','2'),('','','author_homepage','1'),('','','comment_maxlength','1000'),('','','word_maxlength','15'),('','','link_maxlength','30'),('','','flood_time','30'),('','','enable_notification','1'),('','','notification_email','lucien@citi.sinica.edu.tw,wanally@gmail.com'),('','','template','default'),('','','enable_smiles','1'),('','','comments_per_page','10'),('','','comments_page_limit','15'),('','','comments_pagination','both'),('','','comments_order','ASC'),('','','show_commentlength','1'),('','','enable_nested_quotes','1'),('','','enable_rss','1'),('','','censor_replace_word','[censored]'),('','','can_comment','Unregistered,Registered,Author,Manager,Administrator'),('','','can_reply','Unregistered,Registered,Author,Manager,Administrator'),('','','show_policy','Unregistered,Registered,Author,Manager'),('','','enable_captcha','Unregistered'),('','','floodprotection','Unregistered,Registered,Author'),('','','enable_comment_length_check','Unregistered,Registered,Author,Manager,Administrator'),('','','autopublish','Unregistered,Registered,Author,Manager,Administrator'),('','','autolinkurls','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_subscribe','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_gravatar','Unregistered'),('','','can_view_homepage','Unregistered,Registered,Manager,Administrator'),('','','can_publish','Manager,Administrator'),('','','can_view_email','Manager,Administrator'),('','','can_edit','Manager,Administrator'),('','','can_edit_own','Registered,Author,Manager,Administrator'),('','','can_delete','Manager,Administrator'),('','','can_delete_own','Manager,Administrator'),('','','enable_bbcode_b','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_bbcode_i','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_bbcode_u','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_bbcode_s','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_bbcode_url','Unregistered,Registered,Author,Manager,Administrator'),('','','enable_bbcode_img','Registered,Author,Manager,Administrator'),('','','enable_bbcode_list','Registered,Author,Manager,Administrator'),('','','enable_bbcode_hide','Registered,Author,Manager,Administrator'),('','','can_view_ip','Administrator'),('','','enable_categories','269,268,270,182,267,105,111,149,143,145,110,148,144,107,204,106,108,137,151,109,187,195,353,38,275'),('','','emailprotection','Unregistered,Registered'),('','','enable_comment_maxlength_check',''),('','','enable_autocensor','Unregistered'),('','','badwords',''),('','','smiles',':D	laugh.gif\n:lol:	lol.gif\n:-)	smile.gif\n;-)	wink.gif\n8)	cool.gif\n:-|	normal.gif\n:-*	whistling.gif\n:oops:	redface.gif\n:sad:	sad.gif\n:cry:	cry.gif\n:o	surprised.gif\n:-?	confused.gif\n:-x	sick.gif\n:eek:	shocked.gif\n:zzz	sleeping.gif\n:P	tongue.gif\n:roll:	rolleyes.gif\n:sigh:	unsure.gif'),('','','enable_mambots','1'),('','','form_show','1'),('','','display_author','name'),('','','enable_voting','1'),('','','can_vote','Unregistered,Registered,Author,Manager,Administrator'),('','','merge_time','30'),('','','gzip_js','0'),('','','template_view','list'),('','','message_policy_post','本站台提供的文章留言功能，為一個開放空間，所有留言不代表自由軟體鑄造場立場，如有不當言論或惡意攻擊，自由軟體鑄造場有權刪除。'),('','','message_policy_whocancomment',''),('','','message_locked','本文章已關閉評論功能，有任何疑問請來信至contact@openfoundry.org  與我們連繫。\r\n\r\nThis content has been locked. You can no longer post any comment.'),('','','comment_title','0'),('','','enable_custom_bbcode','0'),('','','enable_bbcode_quote','Registered,Author,Manager,Administrator'),('','','enable_bbcode_code',''),('','','disabled_notification_authors','65,79,89,142,472'),('','','enable_geshi','0'),('','','notification_emails_of_categories','105:coolword@gmail.com|111:coolword@gmail.com,rockhung@citi.sinica.edu.tw,freddi.chen@citi.sinica.edu.tw,dearscott@citi.sinica.edu.tw|149:coolword@gmail.com|203:coolword@gmail.com|143:coolword@gmail.com|145:coolword@gmail.com|110:coolword@gmail.com|148:coolword@gmail.com|144:coolword@gmail.com|107:coolword@gmail.com|204:coolword@gmail.com|106:tmk2005@citi.sinica.edu.tw,lucien@iis.sinica.edu.tw,richard@citi.sinica.edu.tw,coolword@gmail.com|108:coolword@gmail.com|137:coolword@gmail.com|151:coolword@gmail.com|109:coolword@gmail.com|187:coolword@gmail.com|275:rockhung@citi.sinica.edu.tw,freddi.chen@citi.sinica.edu.tw,dearscott@citi.sinica.edu.tw');
/*!40000 ALTER TABLE `jos_jcomments_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jcomments_subscriptions`
--

DROP TABLE IF EXISTS `jos_jcomments_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jcomments_subscriptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_group` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(255) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `hash` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_object` (`object_id`,`object_group`),
  KEY `idx_lang` (`lang`),
  KEY `idx_hash` (`hash`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jcomments_subscriptions`
--

LOCK TABLES `jos_jcomments_subscriptions` WRITE;
/*!40000 ALTER TABLE `jos_jcomments_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_jcomments_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jcomments_version`
--

DROP TABLE IF EXISTS `jos_jcomments_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jcomments_version` (
  `version` varchar(16) NOT NULL DEFAULT '',
  `previous` varchar(16) NOT NULL DEFAULT '',
  `installed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jcomments_version`
--

LOCK TABLES `jos_jcomments_version` WRITE;
/*!40000 ALTER TABLE `jos_jcomments_version` DISABLE KEYS */;
INSERT INTO `jos_jcomments_version` VALUES ('2.2.0.0','','2010-03-31 17:05:15','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jos_jcomments_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jcomments_votes`
--

DROP TABLE IF EXISTS `jos_jcomments_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jcomments_votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `commentid` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_comment` (`commentid`,`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jcomments_votes`
--

LOCK TABLES `jos_jcomments_votes` WRITE;
/*!40000 ALTER TABLE `jos_jcomments_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_jcomments_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jf_content`
--

DROP TABLE IF EXISTS `jos_jf_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jf_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `reference_id` int(11) NOT NULL DEFAULT '0',
  `reference_table` varchar(100) NOT NULL DEFAULT '',
  `reference_field` varchar(100) NOT NULL DEFAULT '',
  `value` mediumtext NOT NULL,
  `original_value` varchar(255) DEFAULT NULL,
  `original_text` mediumtext NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `combo` (`reference_id`,`reference_field`,`reference_table`),
  KEY `jfContent` (`language_id`,`reference_id`,`reference_table`),
  KEY `jfContentLanguage` (`reference_id`,`reference_field`,`reference_table`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2443 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jf_content`
--

LOCK TABLES `jos_jf_content` WRITE;
/*!40000 ALTER TABLE `jos_jf_content` DISABLE KEYS */;
INSERT INTO `jos_jf_content` VALUES (1853,2,1,'menu','name','Home','469db73ced5abd4932e873be1f26197b','','2010-10-13 08:53:04',62,1),(1854,2,1,'menu','alias','home','106a6c241b8797f52e1e77317b96a201','','2010-10-13 08:53:04',62,1),(1855,2,1,'menu','params','page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=\nshow_title=0\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nshow_hits=\nfeed_summary=\n\n','473e3847b1dec07b71da17c330d4a654','','2010-10-13 08:53:04',62,1),(1856,2,1,'menu','link','index.php?option=com_content&view=article&id=8062','124bb1b1940eb42914319a3c7cb5953f','','2010-10-13 08:53:04',62,1),(1857,2,6,'menu','name','Community','e2aa4d6faa9528ff2ea4935feb4d9c8b','','2010-05-07 02:21:41',62,1),(1858,2,6,'menu','alias','community','82df41632da476065ce2997900554442','','2010-05-07 02:21:41',62,1),(1859,2,6,'menu','params','page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n','79840a7f47989b3bdf41facc16e78292','','2010-05-07 02:21:41',62,1),(1860,2,6,'menu','link','index.php?option=com_comprofiler&task=userslist&listid=4&searchmode=','6e67b621c5e196d17dbc54b85882315e','','2010-05-07 02:21:41',62,1),(1861,2,32,'menu','name','Projects','7bea808ec47a26b634c36300347100d4','','2010-05-07 02:22:12',62,1),(1862,2,32,'menu','alias','projects','46f86faa6bbf9ac94a7e459509a20ed0','','2010-05-07 02:22:12',62,1),(1863,2,32,'menu','params','menu_image=-1\n\n','a8033e310e093c743ea01ec4210f2cba','','2010-05-07 02:22:12',62,1),(1864,2,4,'menu','name','News','69cb3242585ab77658440e1db09d4671','','2010-10-13 08:47:00',62,1),(1865,2,4,'menu','alias','news','508c75c8507a2ae5223dfd2faeb98122','','2010-10-13 08:47:00',62,1),(1866,2,4,'menu','params','menu_image=-1\n\n','a8033e310e093c743ea01ec4210f2cba','','2010-10-13 08:47:00',62,1),(1867,2,4,'menu','link','http://www.openfoundry.org/en/news','ca4cda17bb26d079e8c6053a72f04edd','','2010-10-13 08:47:00',62,1),(1876,2,5,'menu','name','Law and Licenses','31f40f1d4b9dde59441c6c6f04b67626','','2010-10-13 08:46:50',62,1),(1877,2,5,'menu','alias','law-and-licenses','214ad4e4109272f35eee7cd1c0ccbc71','','2010-10-13 08:46:50',62,1),(1878,2,5,'menu','params','menu_image=-1\n\n','a8033e310e093c743ea01ec4210f2cba','','2010-10-13 08:46:50',62,1),(1879,2,5,'menu','link','http://www.openfoundry.org/en/law-and-licenses','7323119a3408387e183da05874af7b00','','2010-10-13 08:46:50',62,1),(1880,2,3,'menu','name','Workshop','ef755d26dc5761a2e163912e3fe64c33','','2010-10-13 08:45:45',62,1),(1881,2,3,'menu','alias','workshop','33f2ee11f1130c5c6e11061cc91d9b9a','','2010-10-13 08:45:45',62,1),(1882,2,3,'menu','params','menu_image=-1\n\n','a8033e310e093c743ea01ec4210f2cba','','2010-10-13 08:45:45',62,1),(2442,2,3,'menu','link','http://www.openfoundry.org/en/workshop','5b962cc074f28e32b40085fb758c13be','','2010-10-13 08:45:45',62,1),(1884,2,2,'menu','name','Resource Catalog','49234248422c88667a54431138578f82','','2010-10-13 08:46:29',62,1),(1885,2,2,'menu','alias','resourcecatalog','1bbc8e542b7847e96067176c74e17dbd','','2010-10-13 08:46:29',62,1),(1886,2,2,'menu','params','menu_image=-1\n\n','3ce3dfd8550cf07f4ac7b2164ea53906','','2010-10-13 08:46:29',62,1),(1887,2,2,'menu','link','http://www.openfoundry.org/en/resourcecatalog','b370d9f276532a2e07d2bec9891128dc','','2010-10-13 08:46:29',62,1),(1888,2,45,'menu','name','About','3bc386f81976f7f3b5ff993349cb0c80','','2010-10-13 08:46:18',62,1),(1889,2,45,'menu','alias','about','46b3931b9959c927df4fc65fdee94b07','','2010-10-13 08:46:18',62,1),(1890,2,45,'menu','params','menu_image=-1\n\n','a8033e310e093c743ea01ec4210f2cba','','2010-10-13 08:46:18',62,1),(1891,2,45,'menu','link','http://www.openfoundry.org/en/about','eda1651787f5c3b55953dd222cb00802','','2010-10-13 08:46:18',62,1);
/*!40000 ALTER TABLE `jos_jf_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_jf_tableinfo`
--

DROP TABLE IF EXISTS `jos_jf_tableinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_jf_tableinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joomlatablename` varchar(100) NOT NULL DEFAULT '',
  `tablepkID` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=149222 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_jf_tableinfo`
--

LOCK TABLES `jos_jf_tableinfo` WRITE;
/*!40000 ALTER TABLE `jos_jf_tableinfo` DISABLE KEYS */;
INSERT INTO `jos_jf_tableinfo` VALUES (149206,'banner','bid'),(149207,'bannerclient','cid'),(149208,'categories','id'),(149209,'contact_details','id'),(149210,'content','id'),(149211,'languages','id'),(149212,'menu','id'),(149213,'modules','id'),(149214,'newsfeeds','id'),(149215,'poll_data','id'),(149216,'polls','id'),(149217,'sections','id'),(149218,'sefexts','id'),(149219,'sefexttexts','id'),(149220,'users','id'),(149221,'weblinks','id');
/*!40000 ALTER TABLE `jos_jf_tableinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_languages`
--

DROP TABLE IF EXISTS `jos_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `iso` varchar(20) DEFAULT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `shortcode` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `fallback_code` varchar(20) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_languages`
--

LOCK TABLES `jos_languages` WRITE;
/*!40000 ALTER TABLE `jos_languages` DISABLE KEYS */;
INSERT INTO `jos_languages` VALUES (2,'English',1,'en_GB.utf8, en_GB.UT','en-GB','en','','','',1),(4,'繁體中文',1,'zh_TW.UTF8, zh_TW, z','zh-TW','tw','','','',0);
/*!40000 ALTER TABLE `jos_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_letterman`
--

DROP TABLE IF EXISTS `jos_letterman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_letterman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `headers` text NOT NULL,
  `message` text NOT NULL,
  `html_message` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `send` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Used to store all newsletters for Letterman.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_letterman`
--

LOCK TABLES `jos_letterman` WRITE;
/*!40000 ALTER TABLE `jos_letterman` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_letterman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_letterman_subscribers`
--

DROP TABLE IF EXISTS `jos_letterman_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_letterman_subscribers` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `subscriber_name` varchar(64) NOT NULL DEFAULT '',
  `subscriber_email` varchar(64) NOT NULL DEFAULT '',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `subscribe_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`subscriber_id`),
  UNIQUE KEY `subscriber_email` (`subscriber_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Subscribers for Letterman are stored here.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_letterman_subscribers`
--

LOCK TABLES `jos_letterman_subscribers` WRITE;
/*!40000 ALTER TABLE `jos_letterman_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_letterman_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_menu`
--

DROP TABLE IF EXISTS `jos_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_menu`
--

LOCK TABLES `jos_menu` WRITE;
/*!40000 ALTER TABLE `jos_menu` DISABLE KEYS */;
INSERT INTO `jos_menu` VALUES (1,'mainmenu','首頁','home','index.php?option=com_content&view=article&id=8062','component',1,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,3,'show_noauth=\nshow_title=0\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,1),(2,'mainmenu','資源表列','resourcecatalog','http://www.openfoundry.org/resourcecatalog','url',1,0,0,0,9,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\nroknavmenu_extendedlink_name_1=Name\nroknavmenu_extendedlink_value_1=Value\n\n',0,0,0),(3,'mainmenu','工作坊','workshop','http://www.openfoundry.org/workshop','url',1,0,0,0,8,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(4,'mainmenu','新聞','news','http://www.openfoundry.org/news','url',1,0,0,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(45,'mainmenu','關於','about','http://www.openfoundry.org/about','url',1,0,0,0,10,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(5,'mainmenu','法律源地','law-and-licenses','http://www.openfoundry.org/law-and-licenses','url',1,0,0,0,7,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(6,'mainmenu','社群','community','index.php?option=com_comprofiler&task=userslist&listid=4','component',1,0,58,0,5,62,'2010-10-13 08:31:59',0,0,0,0,'fusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(108,'dashboardmenu','OpenFoundry','how-to-start','index.php?option=com_content&view=category&id=356','component',-2,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(32,'mainmenu','專案','project','of/','url',1,0,0,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=-1\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(49,'dashboardmenu','建立專案','create-project','of/projects/new','url',1,0,0,0,4,0,'0000-00-00 00:00:00',0,0,1,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=icon-add.png\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(52,'dashboardmenu','我參與的專案','my-projects','/of/user/dashboard#myprojects','url',1,0,0,0,5,0,'0000-00-00 00:00:00',0,0,1,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(53,'dashboardmenu','我的待辨事項','myissuetracker','/of/user/dashboard#mytickets','url',1,0,0,0,6,0,'0000-00-00 00:00:00',0,0,1,0,'menu_image=-1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\n\n',0,0,0),(54,'userpage','個人簡歷','user','index.php?option=com_comprofiler','component',1,0,58,0,1,0,'0000-00-00 00:00:00',0,0,1,0,'fusion_item_subtext=\nfusion_columns=1\nfusion_customimage=icon-notes.png\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(57,'accountsettings','偏好設定','account-settings','index.php?option=com_wrapper&view=wrapper','component',1,0,17,0,1,0,'0000-00-00 00:00:00',0,0,1,0,'url=http://ssodev.openfoundry.org/sso/user/edit?embedded=1\nscrolling=no\nwidth=100%\nheight=800\nheight_auto=1\nadd_scheme=1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=偏好設定\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(58,'accountsettings','搜尋','search','index.php?option=com_search&view=search','component',1,0,15,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'search_areas=1\nshow_date=\nenabled=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(59,'accountsettings','登入','login','index.php?option=com_wrapper&view=wrapper','component',1,0,17,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'url=http://ssodev.openfoundry.org/sso/user/login?return_url=/&embedded=1\nscrolling=auto\nwidth=100%\nheight=500\nheight_auto=0\nadd_scheme=1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(60,'accountsettings','註冊','register','index.php?option=com_wrapper&view=wrapper','component',1,0,17,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'url=http://ssodev.openfoundry.org/sso/user/signup\nscrolling=auto\nwidth=100%\nheight=500\nheight_auto=0\nadd_scheme=1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(61,'accountsettings','專案活動','test','index.php?option=com_wrapper&view=wrapper','component',1,0,17,0,5,0,'0000-00-00 00:00:00',0,0,0,0,'url=http://ssodev.openfoundry.org/of/proj_acts\nscrolling=auto\nwidth=100%\nheight=500\nheight_auto=0\nadd_scheme=1\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(62,'accountsettings','會員提醒','user-remind','index.php?option=com_user&view=remind','component',1,0,14,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'fusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(63,'mainmenu','首頁','home','index.php?option=com_content&view=article&id=8001','component',-2,0,20,0,0,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=0\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(65,'userpage','私人訊息管理','my-message','index.php?option=com_uddeim','component',1,0,66,0,2,0,'0000-00-00 00:00:00',0,0,1,0,'fusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(67,'userpage','提供接案/工作','post-a-job','index.php?option=com_contentsubmit&view=article&layout=bycategory&id=506','component',1,0,87,0,3,0,'0000-00-00 00:00:00',0,0,1,0,'fusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(68,'dashboardmenu','協助','help','index.php?option=com_content&view=category&id=504','component',1,0,20,0,7,0,'0000-00-00 00:00:00',0,0,0,0,'display_num=0\nshow_headings=0\nshow_date=0\ndate_format=\nfilter=0\nfilter_type=title\norderby_sec=order\nshow_pagination=0\nshow_pagination_limit=0\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=0\nshow_create_date=0\nshow_modify_date=1\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=如何使用OpenFoundry?\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(69,'dashboardmenu','線上協助','openfoundry-forum','index.php?option=com_fireboard&Itemid=69&func=showcat&catid=48','component',1,68,93,1,4,0,'0000-00-00 00:00:00',0,0,0,0,'fusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(107,'dashboardmenu','協助','help','index.php?option=com_content&view=category&id=356','component',-2,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(102,'mainmenu','首頁','home2','index.php?option=com_content&view=article&id=8001','component',-2,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,3,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(103,'dashboardmenu','OpenFoundry','how-to-start','index.php?option=com_content&view=category&id=356','component',-2,0,20,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'display_num=0\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=0\nfilter_type=title\norderby_sec=date\nshow_pagination=1\nshow_pagination_limit=0\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=0\nshow_create_date=\nshow_modify_date=1\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=如何使用OpenFoundry\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(106,'dashboardmenu','OpenFoundry','how-to-start','index.php?option=com_content&view=category&id=504','component',1,68,20,1,1,0,'0000-00-00 00:00:00',0,0,0,0,'display_num=0\nshow_headings=0\nshow_date=0\ndate_format=\nfilter=0\nfilter_type=title\norderby_sec=order\nshow_pagination=0\nshow_pagination_limit=0\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=0\nshow_create_date=0\nshow_modify_date=1\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=如何使用OpenFoundry?\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(104,'dashboardmenu','常見問答','faq','index.php?option=com_content&view=category&id=510','component',0,68,20,1,2,0,'0000-00-00 00:00:00',0,0,0,0,'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=order\nshow_pagination=0\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=0\nshow_create_date=0\nshow_modify_date=1\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(105,'dashboardmenu','授權指引 / 精靈','license-wizard','index.php?option=com_content&view=article&id=134','component',1,68,20,1,3,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\nfusion_item_subtext=\nfusion_columns=1\nfusion_customimage=\nsplitmenu_item_subtext=\nsuckerfish_item_subtext=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0);
/*!40000 ALTER TABLE `jos_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_menu_types`
--

DROP TABLE IF EXISTS `jos_menu_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_menu_types`
--

LOCK TABLES `jos_menu_types` WRITE;
/*!40000 ALTER TABLE `jos_menu_types` DISABLE KEYS */;
INSERT INTO `jos_menu_types` VALUES (1,'mainmenu','Main Menu','The main menu for the site'),(9,'userpage','UserPage','UserPage'),(11,'accountsettings','AccountSettings','AccountSettings'),(12,'dashboardmenu','DashboardMenu','DashboardMenu');
/*!40000 ALTER TABLE `jos_menu_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_messages`
--

DROP TABLE IF EXISTS `jos_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_messages`
--

LOCK TABLES `jos_messages` WRITE;
/*!40000 ALTER TABLE `jos_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_messages_cfg`
--

DROP TABLE IF EXISTS `jos_messages_cfg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_messages_cfg`
--

LOCK TABLES `jos_messages_cfg` WRITE;
/*!40000 ALTER TABLE `jos_messages_cfg` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_messages_cfg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_migration_backlinks`
--

DROP TABLE IF EXISTS `jos_migration_backlinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_migration_backlinks`
--

LOCK TABLES `jos_migration_backlinks` WRITE;
/*!40000 ALTER TABLE `jos_migration_backlinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_migration_backlinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_modules`
--

DROP TABLE IF EXISTS `jos_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_modules`
--

LOCK TABLES `jos_modules` WRITE;
/*!40000 ALTER TABLE `jos_modules` DISABLE KEYS */;
INSERT INTO `jos_modules` VALUES (1,'Main Menu','',2,'left',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,1,'menutype=mainmenu\r\nmoduleclass_sfx=_menu',1,0,''),(2,'Login','',1,'login',0,'0000-00-00 00:00:00',1,'mod_login',0,0,1,'',1,1,''),(3,'Popular','',3,'cpanel',0,'0000-00-00 00:00:00',1,'mod_popular',0,2,1,'',0,1,''),(4,'Recent added Articles','',4,'cpanel',0,'0000-00-00 00:00:00',1,'mod_latest',0,2,1,'ordering=c_dsc\nuser_id=0\ncache=0\n\n',0,1,''),(5,'Menu Stats','',5,'cpanel',0,'0000-00-00 00:00:00',1,'mod_stats',0,2,1,'',0,1,''),(6,'Unread Messages','',1,'header',0,'0000-00-00 00:00:00',1,'mod_unread',0,2,1,'',1,1,''),(7,'Online Users','',2,'header',0,'0000-00-00 00:00:00',1,'mod_online',0,2,1,'',1,1,''),(8,'Toolbar','',1,'toolbar',0,'0000-00-00 00:00:00',1,'mod_toolbar',0,2,1,'',1,1,''),(9,'Quick Icons','',1,'icon',0,'0000-00-00 00:00:00',1,'mod_quickicon',0,2,1,'',1,1,''),(10,'Logged in Users','',2,'cpanel',0,'0000-00-00 00:00:00',1,'mod_logged',0,2,1,'',0,1,''),(11,'Footer','',0,'footer',0,'0000-00-00 00:00:00',1,'mod_footer',0,0,1,'',1,1,''),(12,'Admin Menu','',1,'menu',0,'0000-00-00 00:00:00',1,'mod_menu',0,2,1,'',0,1,''),(13,'Admin SubMenu','',1,'submenu',0,'0000-00-00 00:00:00',1,'mod_submenu',0,2,1,'',0,1,''),(14,'User Status','',1,'status',0,'0000-00-00 00:00:00',1,'mod_status',0,2,1,'',0,1,''),(15,'Title','',1,'title',0,'0000-00-00 00:00:00',1,'mod_title',0,2,1,'',0,1,''),(16,'Language Selection','',1,'header-b',0,'0000-00-00 00:00:00',0,'mod_jflanguageselection',0,0,0,'type=names\nshow_active=0\ninc_jf_css=0\nmoduleclass_sfx=\ncache_href=0\n\n',0,0,''),(17,'Direct Translation','',0,'status',0,'0000-00-00 00:00:00',1,'mod_translate',0,2,0,'',0,1,''),(18,'Latest docs','',2,'dmcpanel',0,'0000-00-00 00:00:00',1,'mod_docman_latest',0,2,1,'',2,1,''),(19,'Top docs','',3,'dmcpanel',0,'0000-00-00 00:00:00',1,'mod_docman_top',0,2,1,'',2,1,''),(20,'Latest logs','',4,'dmcpanel',0,'0000-00-00 00:00:00',1,'mod_docman_logs',0,2,1,'',2,1,''),(21,'News','',0,'dmcpanel',0,'0000-00-00 00:00:00',1,'mod_docman_news',0,2,1,'',2,1,''),(22,'Unapproved','',1,'dmcpanel',0,'0000-00-00 00:00:00',1,'mod_docman_approval',0,2,1,'',2,1,''),(24,'CB Workflows','',3,'left',0,'0000-00-00 00:00:00',0,'mod_comprofilermoderator',0,0,1,'',0,0,''),(25,'CB Online','',4,'left',0,'0000-00-00 00:00:00',0,'mod_comprofileronline',0,0,1,'',0,0,''),(26,'uddeIM Notifier','',5,'left',0,'0000-00-00 00:00:00',0,'mod_uddeim',0,0,1,'uddshowmsg=1\nuddmaxchars=50\nuddeajaxtime=5\nuddeDHTMLpopup=2\n@spacer=Following parameters for floating box only\nuddrightpos=10\nuddtimeout=10000\nuddrightspeed=20\nuddleftspeed=10\n',0,0,''),(27,'uddeIM Mailbox','',6,'left',0,'0000-00-00 00:00:00',0,'mod_uddeim_mailbox',0,0,1,'uddshownew=1\nuddshowinbox=1\nuddshowoutbox=1\nuddshowtrashcan=1\nuddshowarchive=1\nuddshowcontacts=1\nuddshowsettings=1\nuddshowcompose=1\n',0,0,''),(28,'uddeIM Statistics','',7,'left',0,'0000-00-00 00:00:00',0,'mod_uddeim_statistics',0,0,1,'uddshowall=1\nuddshow7=1\nuddshow30=1\nuddshow365=1\n',0,0,''),(29,'Alpha Index','',8,'left',0,'0000-00-00 00:00:00',0,'mod_mt_alphaindex',0,0,1,'moduleclass_sfx=_menu\nmoduleclass=mainlevel\ndirection=vertical\nshow_number=1\nseperator= \n',0,0,''),(30,'Browse','',9,'left',0,'0000-00-00 00:00:00',0,'mod_mt_browse',0,0,1,'layout=default\nshow_empty_cat=-1\nroot_class=mainlevel\nsubcat_class=sublevel\ncurrentcat_class=sublevel\nclosedcat_class=sublevel\n',0,0,''),(39,'找資源','',1,'bottom-a',0,'0000-00-00 00:00:00',0,'mod_mt_tagcloud',0,0,1,'cf_id=28\nclass_sfx=\nmoduleclass_sfx=\nmaxTags=30\nhide_list=\n\n',0,0,''),(40,'Voted Best','',10,'left',0,'0000-00-00 00:00:00',0,'mod_mt_votedbest',0,0,1,'only_subcats=1\ncount=5\nshow_more=1\ncaption_showmore=Show more...\ncaption_rank=Rank\nshow_header=1\norder_rank=1\norder_name=2\nmax_name_char=24\n',0,0,''),(41,'PollXT List Module','',11,'left',0,'0000-00-00 00:00:00',0,'mod_pollxtlist',0,0,1,'mod_target=mod\n',0,0,''),(42,'PollXT Module','',12,'left',0,'0000-00-00 00:00:00',0,'mod_pollxt',0,0,1,'',0,0,''),(45,'RokAjaxSearch','',1,'header-c',0,'0000-00-00 00:00:00',0,'mod_rokajaxsearch',0,0,0,'moduleclass_sfx=\nsearch_page=index.php?option=com_search&view=search&tmpl=component\nadv_search_page=index.php?option=com_search&view=search\ninclude_css=1\ntheme=dark\nsearchphrase=any\nordering=newest\nlimit=10\nperpage=3\nwebsearch=0\nblogsearch=0\nimagesearch=0\nvideosearch=0\nwebsearch_api=\nshow_pagination=1\nsafesearch=MODERATE\nimage_size=MEDIUM\nshow_estimated=1\nhide_divs=\ninclude_link=1\nshow_description=1\ninclude_category=1\nshow_readmore=1\n\n',0,0,''),(46,'RokNavMenu','',13,'left',0,'0000-00-00 00:00:00',0,'mod_roknavmenu',0,0,1,'theme=/modules/mod_roknavmenu/themes/basic\ncustom_layout=default.php\ncustom_formatter=default.php\n',1,0,''),(70,'最新消息','',0,'maintop-a',0,'0000-00-00 00:00:00',0,'mod_roknewspager',0,0,1,'load_css=0\ntheme=light\ncontent_type=joomla\nsecid=0\ncatid=0\nshow_front=2\narticle_count=5\nshow_accordion=0\nshow_paging=0\nmaxpages=8\nshow_title=1\nshow_thumbnails=1\nthumb_width=90\nthumbnail_link=1\nshow_overlay=1\noverlay=-1\nshow_ratings=0\nshow_readmore=0\nreadmore_text=Read More...\nitemsOrdering=\nshow_preview_text=0\nstrip_tags=a,br\npreview_count=200\nshow_comment_count=0\nshow_author=0\nshow_published_date=1\nautoupdate=0\nautoupdate_delay=5000\nmoduleclass_sfx=\ncache=0\nmodule_ident=id\ncache_time=900\n\n',0,0,''),(92,'DashboardMenu','',9,'sidebar-a',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,1,0,'menutype=dashboardmenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',0,0,''),(49,'RokTabs','',14,'left',0,'0000-00-00 00:00:00',0,'mod_roktabs',0,0,1,'style=light\ncontent_type=joomla\n@spacer=<div id=\"joomla-label\"  style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Joomla Core Content</div>\nshow_front=1\n@spacer=<div id=\"k2-label\"  id=\"k2-label\"style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">K2 Content</div>\nFeaturedItems=1\n@spacer=<div id=\"content-label\"  style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Content Parameters</div>\n@spacer=<div style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Animation and Styling</div>\nwidth=500\ntabs_count=3\nduration=600\ntransition_type=scrolling\ntransition_fx=Quad.easeInOut\n@spacer=<div style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Tabs Details</div>\ntabs_position=top\ntabs_event=click\ntabs_title=content\ntabs_incremental=Tab \ntabs_hideh6=1\ntabs_iconside=left\ntabs_iconpath=__module__/images\ntabs_icon=icon_home.gif, icon_security.gif, icon_comment.gif, icon_world.gif, icon_note.gif\n@spacer=<div style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Autoplay Settings</div>\nautoplay_delay=2000\n',0,0,''),(93,'統計','',2,'copyright',0,'0000-00-00 00:00:00',0,'mod_stats',0,0,0,'serverinfo=0\nsiteinfo=0\ncounter=0\nincrease=0\nmoduleclass_sfx=\ncache=0\ncache_time=900\n\n',0,0,''),(65,'首頁Slogan','',0,'showcase-a',0,'0000-00-00 00:00:00',0,'mod_rokstories',0,0,0,'moduleclass_sfx=\nload_css=1\nlayout_type=layout2\ncontent_type=joomla\nsecid=25\ncatid=507\nshow_front=1\narticle_count=4\nitemsOrdering=order\nstrip_tags=a,i,br,strong,em,h2,span\ncontent_position=left\nshow_article_title=0\nshow_created_date=0\nshow_article=1\nshow_article_link=0\nthumb_width=90\nstart_width=auto\nuser_id=0\nstart_element=0\nthumbs_opacity=0.3\nmouse_type=click\nautoplay=0\nautoplay_delay=5000\nshow_label_article_title=0\nshow_arrows=1\narrows_placement=outside\nshow_thumbs=0\nfixed_thumb=1\nlink_titles=0\nlink_labels=0\nlink_images=0\nleft_offset_x=-40\nleft_offset_y=-100\nright_offset_x=-30\nright_offset_y=-100\nleft_f_offset_x=-40\nleft_f_offset_y=-100\nright_f_offset_x=-30\nright_f_offset_y=-100\ncache=0\nmodule_cache=1\ncache_time=900\n\n',0,0,''),(53,'系統公告','',2,'mainbottom-a',0,'0000-00-00 00:00:00',0,'mod_feed',0,0,1,'moduleclass_sfx=square1\nrssurl=http://www.openfoundry.org/of/news/new_openfoundry_news_feed.xml\nrssrtl=0\nrsstitle=0\nrssdesc=0\nrssimage=0\nrssitems=3\nrssitemdesc=0\nword_count=0\ncache=0\ncache_time=15\n\n',0,0,''),(60,'麵包屑','',1,'breadcrumb',0,'0000-00-00 00:00:00',1,'mod_breadcrumbs',0,0,0,'showHome=1\nhomeText=Home\nshowLast=1\nseparator=\nmoduleclass_sfx=\ncache=0\n\n',0,0,''),(61,'法律授權','<ul>\r\n<li>問問題</li>\r\n<li>認識GPL</li>\r\n</ul>',1,'mainbottom-a',0,'0000-00-00 00:00:00',0,'mod_custom',0,0,1,'moduleclass_sfx=square1\n\n',0,0,''),(75,'近期工作坊','',0,'mainbottom-b',0,'0000-00-00 00:00:00',0,'mod_eventlist',0,0,1,'count=5\ntype=0\nshowtitloc=1\ncuttitle=200\nlinkloc=1\nlinkdet=2\ncatid=\nvenid=\nformatdate=%Y-%m-%d\nformattime=\nmoduleclass_sfx=square1\ncache=1\ncache_time=900\n\n',0,0,''),(71,'Slick RSS','',15,'left',0,'0000-00-00 00:00:00',0,'mod_slick_rss',0,0,1,'rsscache=3600\nrssitems=5\nrssitemtitle_words=15\nrssitemdesc_words=25\nlink_target=1\nenable_tooltip=yes\nt_word_count_title=25\nt_word_count_desc=25\n',0,0,''),(79,'SSOLogin','',2,'header-c',0,'0000-00-00 00:00:00',1,'mod_ofssologin',0,0,0,'moduleclass_sfx=square9\n\n',0,0,''),(80,'UserPage','',13,'sidebar-a',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,1,0,'menutype=userpage\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=1\nwindow_open=\nshow_whitespace=1\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=3\nindent_image1=-1\nindent_image2=-1\nindent_image3=-1\nindent_image4=-1\nindent_image5=-1\nindent_image6=-1\nspacer=\nend_spacer=\n\n',0,0,''),(77,'聯絡我們','<p>自由軟體鑄造場 製作 最佳瀏覽狀 態：IE7或Firefox2.0以上 (建議使用Firefox) ‧ 解析度1024*768 <br /> <strong>E-Mail</strong>：<a href=\"mailto:contact@openfoundry.org\">contact@openfoundry.org</a> <strong>Address</strong>：台北市南港區研究院路2段128號 中央研究院資訊科學研究所 . <a href=\"http://www.openfoundry.org/privacy-policy\">隱私權條款</a>. <a href=\"http://www.openfoundry.org/terms-of-use\">使用條款</a></p>',0,'copyright',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(89,'專案活動','',1,'maintop-b',0,'0000-00-00 00:00:00',0,'mod_of_proj_acts',0,0,1,'moduleclass_sfx=square1\n\n',0,0,'');
/*!40000 ALTER TABLE `jos_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_modules_menu`
--

DROP TABLE IF EXISTS `jos_modules_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_modules_menu`
--

LOCK TABLES `jos_modules_menu` WRITE;
/*!40000 ALTER TABLE `jos_modules_menu` DISABLE KEYS */;
INSERT INTO `jos_modules_menu` VALUES (1,0),(16,0),(24,0),(25,0),(26,0),(27,0),(28,0),(29,0),(30,0),(39,1),(40,0),(41,0),(42,0),(45,0),(46,0),(49,0),(53,1),(54,5),(54,8),(54,9),(54,10),(54,11),(54,12),(54,13),(54,14),(54,16),(54,17),(54,18),(54,19),(54,20),(54,21),(54,22),(54,23),(54,24),(55,5),(55,8),(55,9),(55,10),(55,11),(55,12),(55,13),(55,14),(55,16),(55,17),(55,18),(55,19),(55,20),(55,21),(55,22),(55,23),(55,24),(56,5),(56,8),(56,9),(56,10),(56,11),(56,12),(56,13),(56,14),(56,16),(56,17),(56,18),(56,19),(56,20),(56,21),(56,22),(56,23),(56,24),(57,5),(57,8),(57,9),(57,10),(57,11),(57,12),(57,13),(57,14),(57,16),(57,17),(57,18),(57,19),(57,20),(57,21),(57,22),(57,23),(57,24),(59,3),(59,25),(59,26),(59,27),(59,28),(59,29),(59,30),(59,31),(59,70),(59,118),(59,119),(59,121),(59,147),(60,2),(60,3),(60,4),(60,5),(60,6),(60,8),(60,9),(60,10),(60,11),(60,12),(60,13),(60,14),(60,15),(60,16),(60,17),(60,18),(60,19),(60,20),(60,21),(60,22),(60,23),(60,24),(60,25),(60,26),(60,27),(60,28),(60,29),(60,30),(60,31),(60,32),(60,33),(60,34),(60,35),(60,36),(60,37),(60,38),(60,39),(60,40),(60,41),(60,42),(60,43),(60,44),(60,45),(60,46),(60,47),(60,49),(60,52),(60,53),(60,58),(60,60),(60,61),(60,62),(60,65),(60,68),(60,69),(61,1),(65,1),(66,4),(66,33),(66,35),(66,36),(66,37),(66,38),(66,39),(66,40),(66,41),(66,42),(66,43),(66,44),(66,114),(66,115),(66,116),(66,141),(67,45),(67,46),(67,47),(67,109),(67,110),(67,111),(67,112),(67,113),(67,120),(67,122),(67,123),(67,124),(67,125),(67,127),(67,140),(67,142),(67,149),(67,150),(70,1),(71,0),(75,1),(77,0),(79,0),(80,49),(80,52),(80,53),(80,65),(80,68),(80,104),(80,105),(80,106),(83,4),(83,33),(83,35),(83,36),(83,37),(83,38),(83,39),(83,40),(83,41),(83,42),(83,43),(83,44),(83,114),(83,115),(83,116),(83,141),(89,1),(92,49),(92,52),(92,53),(92,65),(92,68),(92,104),(92,105),(92,106),(93,0),(94,3),(94,25),(94,26),(94,27),(94,28),(94,29),(94,30),(94,31),(94,70),(94,118),(94,119),(94,121),(94,147),(99,45),(99,46),(99,47),(99,109),(99,110),(99,111),(99,112),(99,113),(99,120),(99,122),(99,123),(99,124),(99,125),(99,127),(99,140),(99,142),(99,149),(99,150),(100,4),(100,33),(100,35),(100,36),(100,37),(100,38),(100,39),(100,40),(100,41),(100,42),(100,43),(100,44),(100,114),(100,115),(100,116),(100,141),(101,0),(102,129),(102,130),(102,131),(102,132),(102,133),(102,134),(102,135),(102,136),(102,137),(102,138),(102,139);
/*!40000 ALTER TABLE `jos_modules_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_archived_log`
--

DROP TABLE IF EXISTS `jos_mt_archived_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_archived_log` (
  `log_id` int(10) unsigned NOT NULL,
  `log_ip` varchar(255) NOT NULL DEFAULT '',
  `log_type` varchar(32) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `log_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_id` int(11) NOT NULL DEFAULT '0',
  `rev_id` int(11) NOT NULL DEFAULT '0',
  `value` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`),
  KEY `link_id2` (`link_id`,`log_ip`),
  KEY `link_id1` (`link_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `log_type` (`log_type`),
  KEY `log_ip` (`log_ip`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_archived_log`
--

LOCK TABLES `jos_mt_archived_log` WRITE;
/*!40000 ALTER TABLE `jos_mt_archived_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_archived_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_archived_reviews`
--

DROP TABLE IF EXISTS `jos_mt_archived_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_archived_reviews` (
  `rev_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `guest_name` varchar(255) NOT NULL DEFAULT '',
  `rev_title` varchar(255) NOT NULL DEFAULT '',
  `rev_text` text NOT NULL,
  `rev_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rev_approved` tinyint(4) NOT NULL DEFAULT '1',
  `admin_note` mediumtext NOT NULL,
  `vote_helpful` int(10) unsigned NOT NULL DEFAULT '0',
  `vote_total` int(10) unsigned NOT NULL DEFAULT '0',
  `ownersreply_text` text NOT NULL,
  `ownersreply_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ownersreply_approved` tinyint(4) NOT NULL DEFAULT '0',
  `ownersreply_admin_note` mediumtext NOT NULL,
  `send_email` tinyint(4) NOT NULL,
  `email_message` mediumtext NOT NULL,
  PRIMARY KEY (`rev_id`),
  KEY `link_id` (`link_id`,`rev_approved`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_archived_reviews`
--

LOCK TABLES `jos_mt_archived_reviews` WRITE;
/*!40000 ALTER TABLE `jos_mt_archived_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_archived_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_archived_users`
--

DROP TABLE IF EXISTS `jos_mt_archived_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_archived_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_archived_users`
--

LOCK TABLES `jos_mt_archived_users` WRITE;
/*!40000 ALTER TABLE `jos_mt_archived_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_archived_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_cats`
--

DROP TABLE IF EXISTS `jos_mt_cats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_cats` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL,
  `cat_parent` int(11) NOT NULL DEFAULT '0',
  `cat_links` int(11) NOT NULL DEFAULT '0',
  `cat_cats` int(11) NOT NULL DEFAULT '0',
  `cat_featured` tinyint(4) NOT NULL DEFAULT '0',
  `cat_image` varchar(255) NOT NULL,
  `cat_published` tinyint(4) NOT NULL DEFAULT '0',
  `cat_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cat_approved` tinyint(4) NOT NULL DEFAULT '0',
  `cat_template` varchar(255) NOT NULL DEFAULT '',
  `cat_usemainindex` tinyint(4) NOT NULL DEFAULT '0',
  `cat_allow_submission` tinyint(4) NOT NULL DEFAULT '1',
  `cat_show_listings` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `cat_id` (`cat_id`,`cat_published`,`cat_approved`),
  KEY `cat_parent` (`cat_parent`,`cat_published`,`cat_approved`,`cat_cats`,`cat_links`),
  KEY `dtree` (`cat_published`,`cat_approved`),
  KEY `lft_rgt` (`lft`,`rgt`),
  KEY `func_getPathWay` (`lft`,`rgt`,`cat_id`,`cat_parent`),
  KEY `alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_cats`
--

LOCK TABLES `jos_mt_cats` WRITE;
/*!40000 ALTER TABLE `jos_mt_cats` DISABLE KEYS */;
INSERT INTO `jos_mt_cats` VALUES (0,'Root','','','',-1,0,0,0,'',1,'0000-00-00 00:00:00',1,'',0,0,1,'','',0,-7,-24);
/*!40000 ALTER TABLE `jos_mt_cats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_cfvalues`
--

DROP TABLE IF EXISTS `jos_mt_cfvalues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_cfvalues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cf_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `value` mediumtext NOT NULL,
  `attachment` int(10) unsigned NOT NULL DEFAULT '0',
  `counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cf_id` (`cf_id`,`link_id`),
  KEY `link_id` (`link_id`),
  KEY `value` (`value`(8))
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_cfvalues`
--

LOCK TABLES `jos_mt_cfvalues` WRITE;
/*!40000 ALTER TABLE `jos_mt_cfvalues` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_cfvalues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_cfvalues_att`
--

DROP TABLE IF EXISTS `jos_mt_cfvalues_att`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_cfvalues_att` (
  `att_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL,
  `cf_id` int(10) unsigned NOT NULL,
  `raw_filename` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` int(11) NOT NULL,
  `extension` varchar(255) NOT NULL,
  PRIMARY KEY (`att_id`),
  KEY `primary2` (`link_id`,`cf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_cfvalues_att`
--

LOCK TABLES `jos_mt_cfvalues_att` WRITE;
/*!40000 ALTER TABLE `jos_mt_cfvalues_att` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_cfvalues_att` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_cl`
--

DROP TABLE IF EXISTS `jos_mt_cl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_cl` (
  `cl_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `main` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cl_id`),
  KEY `link_id` (`link_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1281 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_cl`
--

LOCK TABLES `jos_mt_cl` WRITE;
/*!40000 ALTER TABLE `jos_mt_cl` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_cl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_claims`
--

DROP TABLE IF EXISTS `jos_mt_claims`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_claims` (
  `claim_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `admin_note` mediumtext NOT NULL,
  PRIMARY KEY (`claim_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_claims`
--

LOCK TABLES `jos_mt_claims` WRITE;
/*!40000 ALTER TABLE `jos_mt_claims` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_claims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_clone_owners`
--

DROP TABLE IF EXISTS `jos_mt_clone_owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_clone_owners` (
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_clone_owners`
--

LOCK TABLES `jos_mt_clone_owners` WRITE;
/*!40000 ALTER TABLE `jos_mt_clone_owners` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_clone_owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_config`
--

DROP TABLE IF EXISTS `jos_mt_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_config` (
  `varname` varchar(100) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL,
  `default` mediumtext NOT NULL,
  `configcode` mediumtext NOT NULL,
  `ordering` smallint(6) NOT NULL,
  `displayed` smallint(5) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`varname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_config`
--

LOCK TABLES `jos_mt_config` WRITE;
/*!40000 ALTER TABLE `jos_mt_config` DISABLE KEYS */;
INSERT INTO `jos_mt_config` VALUES ('admin_email','main','freddi.chen@citi.sinica.edu.tw,allywang@iis.sinica.edu.tw','','text',500,1),('template','main','m2','m2','text',200,0),('admin_use_explorer','admin','1','1','yesno',11500,1),('small_image_click_target_size','admin','','o','text',13000,0),('allow_changing_cats_in_addlisting','listing','1','1','yesno',3550,1),('allow_imgupload','image','0','1','yesno',10100,1),('allow_listings_submission_in_root','listing','1','0','yesno',3500,1),('allow_owner_rate_own_listing','ratingreview','0','0','yesno',1700,1),('allow_owner_review_own_listing','ratingreview','0','0','yesno',10005,1),('allow_rating_during_review','ratingreview','1','1','yesno',2650,1),('allow_user_assign_more_than_one_category','listing','1','1','yesno',3575,1),('alpha_index_additional_chars','listing','','','text',3410,0),('cat_image_dir','image','/components/com_mtree/img/cats/','/components/com_mtree/img/cats/','text',700,0),('display_empty_cat','category','1','1','yesno',3300,1),('display_listings_in_root','listing','1','1','yesno',3600,1),('explorer_tree_level','admin','9','9','text',11600,1),('fe_num_of_featured','listing','20','20','text',6700,1),('fe_num_of_links','listing','20','20','text',5500,1),('fe_num_of_favourite','listing','20','20','text',6100,1),('fe_num_of_mostrated','listing','20','20','text',6300,1),('fe_num_of_mostreview','listing','20','20','text',6500,1),('fe_num_of_new','listing','20','20','text',5800,1),('fe_num_of_popular','listing','20','20','text',5700,1),('fe_num_of_updated','listing','20','20','text',6000,1),('fe_num_of_reviews','listing','20','20','text',5600,1),('fe_num_of_searchresults','listing','20','20','text',6600,1),('fe_num_of_toprated','listing','20','20','text',6400,1),('fe_total_new','listing','100','60','text',5900,1),('first_cat_order1','category','cat_created','cat_name','cat_order',1400,1),('first_cat_order2','category','asc','asc','sort_direction',1500,1),('first_listing_order1','listing','link_name','link_rating','listing_order',1800,1),('first_listing_order2','listing','desc','desc','sort_direction',1900,1),('first_review_order1','ratingreview','rev_date','vote_helpful','review_order',2900,1),('first_review_order2','ratingreview','desc','desc','sort_direction',3000,1),('first_search_order1','search','link_featured','link_featured','listing_order',2150,1),('first_search_order2','search','desc','desc','sort_direction',2151,1),('hit_lag','main','86400','86400','text',9000,1),('images_per_listing','image','8','10','text',10200,1),('img_impath','image','','','text',1100,1),('img_netpbmpath','image','','','text',1200,1),('linkchecker_last_checked','linkchecker','','','text',300,0),('linkchecker_num_of_links','linkchecker','10','10','text	',100,0),('linkchecker_seconds','linkchecker','1','1','text',200,0),('link_new','main','10','7','text',8800,1),('link_popular','main','10','120','text',8900,1),('listing_image_dir','image','/components/com_mtree/img/listings/','/components/com_mtree/img/listings/','text',600,0),('map','feature','googlemaps','googlemaps','map',4150,1),('min_votes_for_toprated','ratingreview','1','1','text',1500,1),('min_votes_to_show_rating','ratingreview','0','0','text',1600,1),('name','core','Mosets Tree','Mosets Tree','',0,0),('needapproval_addcategory','main','1','1','yesno',8500,1),('needapproval_addlisting','main','1','1','yesno',8300,1),('needapproval_addreview','ratingreview','1','1','yesno',2700,1),('needapproval_modifylisting','main','1','1','yesno',8400,1),('needapproval_replyreview','ratingreview','0','1','yesno',8500,1),('note_notify_admin','notify','','','note',9099,1),('note_notify_owner','notify','','','note',9450,1),('note_rating','ratingreview','','','note',1000,1),('note_review','ratingreview','','','note',2500,1),('note_rss_custom_fields','rss','','','note',300,1),('notifyadmin_delete','notify','1','1','yesno',9300,1),('notifyadmin_modifylisting','notify','1','1','yesno',9200,1),('notifyadmin_newlisting','notify','1','1','yesno',9100,1),('notifyadmin_newreview','notify','1','1','yesno',9400,1),('notifyuser_approved','notify','1','1','yesno',9700,1),('notifyuser_modifylisting','notify','1','1','yesno',9600,1),('notifyuser_newlisting','notify','1','1','yesno',9500,1),('notifyuser_review_approved','notify','1','1','yesno',9800,1),('optional_email_sent_to_reviewer','ratingreview','','','note',10010,1),('owner_reply_review','ratingreview','1','1','yesno',8000,1),('params_xml_filename','core','params.xml','params.xml','text',100,0),('predefined_reply_1_message','ratingreview','','','predefined_reply',10120,1),('predefined_reply_1_title','ratingreview','','','predefined_reply_title',10110,1),('predefined_reply_2_message','ratingreview','','','predefined_reply',10140,1),('predefined_reply_2_title','ratingreview','','','predefined_reply_title',10130,1),('predefined_reply_3_message','ratingreview','','','predefined_reply',10160,1),('predefined_reply_3_title','ratingreview','','','predefined_reply_title',10150,1),('predefined_reply_4_message','ratingreview','','','predefined_reply',10180,1),('predefined_reply_4_title','ratingreview','','','predefined_reply_title',10170,1),('predefined_reply_5_message','ratingreview','','','predefined_reply',10200,1),('predefined_reply_5_title','ratingreview','','','predefined_reply_title',10190,1),('predefined_reply_bcc','ratingreview','','','text',10040,1),('predefined_reply_for_approved_or_rejected_review','ratingreview','','','note',10100,1),('predefined_reply_from_email','ratingreview','','','text',10030,1),('predefined_reply_from_name','ratingreview','','','text',10020,1),('rate_once','ratingreview','1','0','yesno',1400,1),('relative_path_to_js_library','core','/components/com_mtree/js/jquery-1.2.6.min.js','/components/com_mtree/js/jquery-1.2.6.min.js','text',0,0),('require_rating_with_review','ratingreview','1','1','yesno',2675,1),('resize_cat_size','image','80','80','text',1300,1),('resize_listing_size','image','100','100','text',1000,1),('resize_medium_listing_size','image','600','600','text',1050,1),('resize_method','image','gd2','gd2','resize_method',800,1),('resize_quality','image','80','80','text',900,1),('rss_address','rss','0','0','yesno',400,1),('rss_cat_name','rss','0','0','yesno',310,1),('rss_cat_url','rss','0','0','yesno',320,1),('rss_city','rss','0','0','yesno',500,1),('rss_country','rss','0','0','yesno',800,1),('rss_custom_fields','rss','','','text',1500,1),('rss_email','rss','0','0','yesno',900,1),('rss_fax','rss','0','0','yesno',1200,1),('rss_link_rating','rss','0','0','yesno',340,1),('rss_link_votes','rss','0','0','yesno',330,1),('rss_metadesc','rss','0','0','yesno',1400,1),('rss_metakey','rss','0','0','yesno',1300,1),('rss_postcode','rss','0','0','yesno',600,1),('rss_state','rss','0','0','yesno',700,1),('rss_telephone','rss','0','0','yesno',1100,1),('rss_website','rss','0','0','yesno',1000,1),('second_cat_order1','category','cat_created','','cat_order',1600,1),('second_cat_order2','category','asc','asc','sort_direction',1700,1),('second_listing_order1','listing','link_featured','link_votes','listing_order',2000,1),('second_listing_order2','listing','desc','desc','sort_direction',2100,1),('second_review_order1','ratingreview','','vote_total','review_order',4000,1),('second_review_order2','ratingreview','desc','desc','sort_direction',5000,1),('second_search_order1','search','link_hits','link_hits','listing_order',2152,1),('second_search_order2','search','desc','desc','sort_direction',2153,1),('show_claim','feature','1','1','yesno',4500,1),('show_contact','feature','1','1','yesno',4700,1),('show_listnewrss','rss','1','1','yesno',100,1),('show_listupdatedrss','rss','1','1\n','yesno',200,1),('show_map','feature','0','0','yesno',4100,1),('show_ownerlisting','feature','1','1','yesno',4600,1),('show_print','feature','1','0','yesno',4200,1),('show_rating','ratingreview','1','1','yesno',1100,1),('show_recommend','feature','1','1','yesno',5100,1),('show_report','feature','1','1','yesno',4900,1),('show_review','ratingreview','1','1','yesno',2600,1),('show_visit','feature','1','1','yesno',4300,1),('third_review_order1','ratingreview','','rev_date','review_order',6000,1),('third_review_order2','ratingreview','desc','desc','sort_direction',7000,1),('trigger_modified_listing','listing','','','text',3900,1),('user_addcategory','main','1','1','user_access',8000,1),('user_addlisting','main','1','1','user_access',7900,1),('user_allowdelete','main','1','1','yesno',8200,1),('user_allowmodify','main','1','1','yesno',8100,1),('user_contact','feature','0','0','user_access',4800,1),('user_rating','ratingreview','2','1','user_access2',1300,1),('user_recommend','feature','0','0','user_access',5200,1),('user_report','feature','0','0','user_access',5000,1),('user_report_review','ratingreview','-1','1','user_access',9000,1),('user_review','ratingreview','2','1','user_access2',2800,1),('user_review_once','ratingreview','1','1','yesno',9000,1),('user_vote_review','ratingreview','1','1','yesno',10000,1),('use_internal_notes','admin','1','1','yesno',11900,1),('use_owner_email','feature','1','0','yesno',5300,1),('use_wysiwyg_editor','main','1','0','yesno',11000,1),('use_wysiwyg_editor_in_admin','admin','1','0','yesno',12000,1),('version','core','2.1.0','2.1.0','',0,0),('major_version','core','2','2','',0,0),('minor_version','core','1','1','',0,0),('dev_version','core','0','0','',0,0),('squared_thumbnail','image','0','1','yesno',1025,1),('show_favourite','feature','1','1','yesno',4175,1),('relative_path_to_cat_small_image','core','','/components/com_mtree/img/cats/s/','',0,0),('relative_path_to_cat_original_image','core','','/components/com_mtree/img/cats/o/','',0,0),('relative_path_to_listing_small_image','core','','/components/com_mtree/img/listings/s/','',0,0),('relative_path_to_listing_medium_image','core','','/components/com_mtree/img/listings/m/','',0,0),('relative_path_to_listing_original_image','core','','/components/com_mtree/img/listings/o/','',0,0),('rss_title_separator','rss',' - ',' - ','text',0,0),('cat_parse_plugin','category','1','1','yesno',3400,0),('image_maxsize','image','819200','3145728','text',10300,1),('banned_text','email','','','',0,0),('banned_subject','email','','','',0,0),('banned_email','email','','','',0,0),('notifyowner_review_added','notify','1','1','yesno',9900,1),('unpublished_message_cfid','listing','0','0','text',6600,0),('load_css','core','1','1','yesno',0,0),('rss_secret_token','rss','','','text',0,0),('show_category_rss','rss','1','1','yesno',0,1),('fe_total_updated','listing','60','60','text',6050,0),('fe_total_popular','listing','60','60','text',5750,0),('fe_total_favourite','listing','60','60','text',6150,0),('fe_total_mostrated','listing','60','60','text',6350,0),('fe_total_toprated','listing','60','60','text',6450,0),('fe_total_mostreview','listing','60','60','text',6550,0),('default_search_condition','search','2','2','text',0,0),('reset_created_date_upon_approval','core','1','1','yesno',0,0),('cache_registered_viewlink','main','0','0','yesno',0,0),('relative_path_to_attachments','core','/components/com_mtree/attachments/','/components/com_mtree/attachments/','text',0,0),('sef_link_slug_type','sef','2','1','sef_link_slug_type',100,1),('sef_image','sef','image','image','text',200,1),('sef_gallery','sef','gallery','gallery','text',300,1),('sef_review','sef','review','review','text',400,1),('sef_replyreview','sef','reply-review','reply-review','text',500,1),('sef_reportreview','sef','report-review','report-review','text',600,1),('sef_recommend','sef','recommend','recommend','text',800,1),('sef_print','sef','print','print','text',850,1),('sef_contact','sef','contact','contact','text',900,1),('sef_report','sef','report','report','text',1000,1),('sef_claim','sef','claim','claim','text',1100,1),('sef_visit','sef','visit','visit','text',1200,1),('sef_category_page','sef','page','page','text',1300,1),('sef_delete','sef','delete','delete','text',1400,1),('sef_reviews_page','sef','reviews','reviews','text',1500,1),('sef_addlisting','sef','add','add','text',1600,1),('sef_editlisting','sef','edit','edit','text',1650,1),('sef_addcategory','sef','add-category','add-category','text',1700,1),('sef_mypage','sef','my-page','my-page','text',1800,1),('sef_new','sef','new','new','text',1900,1),('sef_updated','sef','updated','updated','text',2000,1),('sef_favourite','sef','most-favoured','most-favoured','text',2100,1),('sef_featured','sef','featured','featured','text',2200,1),('sef_popular','sef','popular','popular','text',2300,1),('sef_mostrated','sef','most-rated','most-rated','text',2400,1),('sef_toprated','sef','top-rated','top-rated','text',2500,1),('sef_mostreview','sef','most-reviewed','most-reviewed','text',2600,1),('sef_listalpha','sef','list-alpha','list-alpha','text',2700,1),('sef_owner','sef','owner','owner','text',2800,1),('sef_favourites','sef','favourites','favourites','text',2900,1),('sef_reviews','sef','reviews','reviews','text',3000,1),('sef_searchby','sef','search-by','search-by','text',3050,1),('sef_search','sef','search','search','text',3100,1),('sef_advsearch','sef','advanced-search','advanced-search','text',3200,1),('sef_advsearch2','sef','advanced-search-results','advanced-search-results','text',3300,1),('sef_rss','sef','rss','rss','text',3400,1),('sef_rss_new','sef','new','new','text',3500,1),('sef_rss_updated','sef','updated','updated','text',3600,1),('sef_space','sef','-','-','text',3700,1),('note_sef_translations','sef','','','note',150,1),('sef_details','sef','details','details','text',175,0),('show_image_rss','rss','1','1','yesno',250,0),('use_map','feature','0','0','yesno',3950,1),('map_default_country','feature','','','text',3960,1),('map_default_state','feature','','','text',3970,1),('map_default_city','feature','','','text',3980,1),('note_map','feature','','','note',3925,1),('note_other_features','feature','','','note',4170,1),('gmaps_api_key','feature','','','text',3955,1),('map_default_lat','feature','12.554563528593656','12.554563528593656','text',3985,0),('map_default_lng','feature','18.984375','18.984375','text',3986,0),('map_default_zoom','feature','1','1','text',3987,0),('map_control','feature','GSmallMapControl,GMapTypeControl','GSmallMapControl,GMapTypeControl','text',3988,0),('display_pending_approval_listings_to_owners','listing','1','0','yesno',4000,0);
/*!40000 ALTER TABLE `jos_mt_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_configgroup`
--

DROP TABLE IF EXISTS `jos_mt_configgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_configgroup` (
  `groupname` varchar(50) NOT NULL,
  `ordering` smallint(6) NOT NULL,
  `displayed` smallint(6) NOT NULL,
  PRIMARY KEY (`groupname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_configgroup`
--

LOCK TABLES `jos_mt_configgroup` WRITE;
/*!40000 ALTER TABLE `jos_mt_configgroup` DISABLE KEYS */;
INSERT INTO `jos_mt_configgroup` VALUES ('main',100,1),('category',250,1),('listing',300,1),('search',400,1),('ratingreview',450,1),('feature',500,1),('notify',600,1),('image',650,1),('rss',675,1),('admin',700,1),('linkchecker',800,0),('core',999,0),('email',999,0),('sef',685,1);
/*!40000 ALTER TABLE `jos_mt_configgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_customfields`
--

DROP TABLE IF EXISTS `jos_mt_customfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_customfields` (
  `cf_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_type` varchar(36) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `default_value` varchar(255) NOT NULL,
  `size` smallint(9) NOT NULL,
  `field_elements` text NOT NULL,
  `prefix_text_mod` varchar(255) NOT NULL,
  `suffix_text_mod` varchar(255) NOT NULL,
  `prefix_text_display` varchar(255) NOT NULL,
  `suffix_text_display` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `hidden` tinyint(4) NOT NULL DEFAULT '0',
  `required_field` tinyint(4) NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `hide_caption` tinyint(4) NOT NULL DEFAULT '0',
  `advanced_search` tinyint(4) NOT NULL DEFAULT '0',
  `simple_search` tinyint(4) NOT NULL DEFAULT '0',
  `tag_search` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `details_view` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `summary_view` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `search_caption` varchar(255) NOT NULL,
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_customfields`
--

LOCK TABLES `jos_mt_customfields` WRITE;
/*!40000 ALTER TABLE `jos_mt_customfields` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_customfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_favourites`
--

DROP TABLE IF EXISTS `jos_mt_favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_favourites` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fav_date` datetime NOT NULL,
  PRIMARY KEY (`fav_id`),
  KEY `link_id` (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_favourites`
--

LOCK TABLES `jos_mt_favourites` WRITE;
/*!40000 ALTER TABLE `jos_mt_favourites` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_fieldtypes`
--

DROP TABLE IF EXISTS `jos_mt_fieldtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_fieldtypes` (
  `ft_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_type` varchar(36) NOT NULL,
  `ft_caption` varchar(255) NOT NULL,
  `ft_class` mediumtext NOT NULL,
  `use_elements` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `use_size` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `use_columns` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `taggable` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ft_id`),
  UNIQUE KEY `field_type` (`field_type`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_fieldtypes`
--

LOCK TABLES `jos_mt_fieldtypes` WRITE;
/*!40000 ALTER TABLE `jos_mt_fieldtypes` DISABLE KEYS */;
INSERT INTO `jos_mt_fieldtypes` VALUES (1,'corerating','Rating','class mFieldType_corerating extends mFieldType_number {\r\n	var $name = \'link_rating\';\r\n	var $numOfSearchFields = 2;\r\n	var $numOfInputFields = 0;\r\n	function getOutput($view=1) {\r\n		return round($this->getValue(),2);\r\n	}\r\n	function getJSValidation() {\r\n		return null;\r\n	}\r\n}',0,0,0,0,1),(2,'coreprice','Price','class mFieldType_coreprice extends mFieldType_number {\r\n	var $name = \'price\';\r\n	function getOutput() {\r\n		$price = $this->getValue();\r\n		$displayFree = $this->getParam(\'displayFree\',1);\r\n		if($price == 0 && $displayFree == 1) {\r\n			return JText::_( \'FREE\' );\r\n		} else {\r\n			return $price;\r\n		}\r\n	}\r\n}',0,0,0,0,1),(3,'coreaddress','Address','class mFieldType_coreaddress extends mFieldType {\r\n	var $name = \'address\';\r\n	function getInputHTML() {\r\n		global $mtconf;\r\n		\r\n		if( ($this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor_in_admin\')) || (!$this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor\')) ) {\r\n			$editor = &JFactory::getEditor();\r\n			$html = $editor->display( $this->getInputFieldName(1), $this->getValue() , \'100%\', \'250\', \'75\', \'25\', array(\'pagebreak\', \'readmore\') );\r\n		} else {\r\n			$html = \'<textarea class=\"inputbox\" name=\"\' . $this->getInputFieldName(1) . \'\" style=\"width:95%;height:\' . $this->getSize() . \'px\">\' . htmlspecialchars($this->getValue()) . \'</textarea>\';\r\n		}\r\n		return $html;\r\n	}\r\n}\r\n',0,1,0,0,1),(4,'corecity','City','class mFieldType_corecity extends mFieldType {\r\n	var $name = \'city\';\r\n}\r\n',1,1,0,1,1),(5,'corestate','State','class mFieldType_corestate extends mFieldType {\r\n	var $name = \'state\';\r\n}\r\n',1,1,0,1,1),(6,'corecountry','Country','class mFieldType_corecountry extends mFieldType {\r\n	var $name = \'country\';\r\n	\r\n		function getInputHTML() {\r\n		global $mtconf;\r\n		\r\n		if( ($this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor_in_admin\')) || (!$this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor\')) ) {\r\n			$editor = &JFactory::getEditor();\r\n			$html = $editor->display( $this->getInputFieldName(1), $this->getValue() , \'100%\', \'250\', \'75\', \'25\', array(\'pagebreak\', \'readmore\') );\r\n		} else {\r\n			$html = \'<textarea class=\"inputbox\" name=\"\' . $this->getInputFieldName(1) . \'\" style=\"width:95%;height:\' . $this->getSize() . \'px\">\' . htmlspecialchars($this->getValue()) . \'</textarea>\';\r\n		}\r\n		return $html;\r\n	}\r\n}\r\n',1,0,0,1,1),(7,'corepostcode','Postcode','class mFieldType_corepostcode extends mFieldType {\r\n	var $name = \'postcode\';\r\n}\r\n',0,1,0,0,1),(8,'coretelephone','Telephone','class mFieldType_coretelephone extends mFieldType {\r\n	var $name = \'telephone\';\r\n}\r\n',0,1,0,0,1),(9,'corefax','Fax','class mFieldType_corefax extends mFieldType {\r\n	var $name = \'fax\';\r\n}\r\n',0,1,0,0,1),(10,'coreemail','E-mail','class mFieldType_coreemail extends mFieldType_email {\r\n	var $name = \'email\';\r\n}\r\n',0,1,0,0,1),(11,'corewebsite','Website','class mFieldType_corewebsite extends mFieldType_weblink {\r\n	var $name = \'website\';\r\n\r\n	function getOutput() {\r\n		$maxUrlLength = $this->getParam(\'maxUrlLength\',60);\r\n		$text = $this->getParam(\'text\',\'\');\r\n		$openNewWindow = $this->getParam(\'openNewWindow\',1);\r\n		$useMTVisitRedirect = $this->getParam(\'useMTVisitRedirect\',1);\r\n		$hideProtocolOutput = $this->getParam(\'hideProtocolOutput\',1);\r\n	\r\n		$html = \'\';\r\n		$html .= \'<a href=\"\';\r\n		if($useMTVisitRedirect) {\r\n			global $Itemid;\r\n			$html .= JRoute::_(\'index.php?option=com_mtree&task=visit&link_id=\' . $this->getLinkId() . \'&Itemid=\' . $Itemid);\r\n		} else {\r\n			$html .= $this->getValue();\r\n		}\r\n		$html .= \'\"\';\r\n		if( $openNewWindow == 1 ) {\r\n			$html .= \' target=\"_blank\"\';\r\n		}\r\n		$html .= \'>\';\r\n		if(!empty($text)) {\r\n			$html .= $text;\r\n		} else {\r\n			$value = $this->getValue();\r\n			if(strpos($value,\'://\') !== false && $hideProtocolOutput) {\r\n				$value = substr($value,(strpos($value,\'://\')+3));\r\n\r\n				// If $value has a single slash and this is at the end of the string, we can safely remove this.\r\n				if( substr($value,-1) == \'/\' && substr_count($value,\'/\') == 1 )\r\n				{\r\n					$value = substr($value,0,-1);\r\n				}\r\n			}\r\n			if( empty($maxUrlLength) || $maxUrlLength == 0 ) {\r\n				$html .= $value;\r\n			} else {\r\n				$html .= substr($value,0,$maxUrlLength);\r\n				if( strlen($value) > $maxUrlLength ) {\r\n					$html .= $this->getParam(\'clippedSymbol\');\r\n				}\r\n			}\r\n		}\r\n		$html .= \'</a>\';\r\n		return $html;\r\n	}\r\n	\r\n	function getInputHTML() {\r\n		$showGo = $this->getParam(\'showGo\',1);\r\n		$showSpider = $this->getParam(\'showSpider\',0);\r\n		$inBackEnd = (substr(dirname($_SERVER[\'PHP_SELF\']),-13) == \'administrator\') ? true : false;\r\n		$html = \'\';\r\n		$html .= \'<input class=\"text_area inputbox\" type=\"text\" name=\"\' . $this->getInputFieldName(1) . \'\" id=\"\' . $this->getInputFieldName(1) . \'\" size=\"\' . ($this->getSize()?$this->getSize():\'30\') . \'\" value=\"\' . htmlspecialchars($this->getValue()) . \'\" />\';\r\n		if($showGo && $inBackEnd) {\r\n			$html .= \'&nbsp;\';\r\n			$html .= \'<input type=\"button\" class=\"button\" onclick=\\\'\';\r\n			$html .= \'javascript:window.open(\"index3.php?option=com_mtree&task=openurl&url=\"+escape(document.getElementById(\"website\").value))\\\'\';\r\n			$html .= \'value=\"\' . JText::_( \'Go\' ) . \'\" />\';\r\n		}\r\n		\r\n		if($showSpider && $inBackEnd) {\r\n			$html .= \'&nbsp;\';\r\n			$html .= \'<input type=\"button\" class=\"button\" onclick=\\\'\';\r\n			$html .= \'javascript: \';\r\n			$html .= \'jQuery(\"#spiderwebsite\").html(\"\' . JText::_( \'SPIDER PROGRESS\' ) . \'\");\';\r\n			$html .= \'jQuery.ajax({\r\n			  type: \"POST\",\r\n			  url: mosConfig_live_site+\"/administrator/index2.php\",\r\n			  data: \"option=com_mtree&task=ajax&task2=spiderurl&url=\"+document.getElementById(\"website\").value+\"&no_html=1\",\r\n			  dataType: \"script\"\r\n			});\';\r\n			$html .= \'\\\'\';\r\n			$html .= \'value=\"\' . JText::_( \'SPIDER\' ) . \'\" />\';\r\n			$html .= \'<span id=\"spider\' . $this->getInputFieldName(1) . \'\" style=\"margin-left:5px;background-color:white\"></span>\';\r\n		}\r\n		return $html;\r\n	}\r\n	\r\n}',0,0,0,0,1),(12,'corehits','Hits','class mFieldType_corehits extends mFieldType_number {\r\n	var $name = \'link_hits\';\r\n	var $numOfInputFields = 0;\r\n}\r\n',0,0,0,0,1),(13,'corevotes','Votes','class mFieldType_corevotes extends mFieldType_number {\r\n	var $name = \'link_votes\';\r\n	var $numOfInputFields = 0;\r\n}\r\n',0,0,0,0,1),(14,'corefeatured','Featured','class mFieldType_corefeatured extends mFieldType {\r\n	var $name = \'link_featured\';\r\n	var $numOfInputFields = 0;\r\n	function getOutput() {\r\n		$featured = $this->getValue();\r\n		$html = \'\';\r\n		if($featured) {\r\n			$html .= JText::_( \'Yes\' );\r\n		} else {\r\n			$html .= JText::_( \'No\' );\r\n		}\r\n		return $html;\r\n	}\r\n	function getSearchHTML() {\r\n		$html = \'<select name=\"\' . $this->getSearchFieldName(1) . \'\" class=\"inputbox text_area\" size=\"1\">\';\r\n		$html .= \'<option value=\"-1\" selected=\"selected\">\' . JText::_( \'Any\' ) . \'</option>\';\r\n		$html .= \'<option value=\"1\">\' . JText::_( \'FEATURED ONLY\' ) . \'</option>\';\r\n		$html .= \'<option value=\"0\">\' . JText::_( \'NON FEATURED ONLY\' ) . \'</option>\';\r\n		$html .= \'</select>\';\r\n		return $html;\r\n	}\r\n	\r\n	function getWhereCondition() {\r\n		$args = func_get_args();\r\n\r\n		$fieldname = $this->getName();\r\n		\r\n		if(  is_numeric($args[0]) ) {\r\n			switch($args[0]) {\r\n				case -1:\r\n					return null;\r\n					break;\r\n				case 1:\r\n					return $fieldname . \' = 1\';\r\n					break;\r\n				case 0:\r\n				return $fieldname . \' = 0\';\r\n					break;\r\n			}\r\n		} else {\r\n			return null;\r\n		}\r\n	}\r\n}',0,0,0,0,1),(15,'coremodified','Modified','class mFieldType_coremodified extends mFieldType_date {\r\n	var $name = \'link_modified\';\r\n	var $numOfInputFields = 0;\r\n	function getOutput() {\r\n		$value = $this->getValue();\r\n		if($value == \'0000-00-00 00:00:00\') {\r\n			return JText::_( \'NEVER\' );\r\n		} else {\r\n			$dateFormat = $this->getParam(\'dateFormat\',\'%Y-%m-%d\');\r\n			return strftime($dateFormat,mktime(0,0,0,intval(substr($value,5,2)),intval(substr($value,8,2)),intval(substr($value,0,4))));\r\n		}\r\n	}\r\n\r\n}',0,0,0,0,1),(16,'corevisited','Visited','class mFieldType_corevisited extends mFieldType_number {\r\n	var $name = \'link_visited\';\r\n	var $numOfInputFields = 0;\r\n	function getJSValidation() {\r\n		return null;\r\n	}\r\n}\r\n',0,0,0,0,1),(17,'corepublishup','Publish Up','class mFieldType_corepublishup extends mFieldType {\r\n	var $name = \'publish_up\';\r\n	var $numOfSearchFields = 0;\r\n	var $numOfInputFields = 0;\r\n}\r\n',0,0,0,0,1),(18,'corepublishdown','Publish Down','class mFieldType_corepublishdown extends mFieldType {\r\n	var $name = \'publish_down\';\r\n	var $numOfSearchFields = 0;\r\n	var $numOfInputFields = 0;\r\n}\r\n',0,0,0,0,1),(19,'coreuser','Owner','class mFieldType_coreuser extends mFieldType {\r\n	var $name = \'user_id\';\r\n	var $numOfSearchFields = 0;\r\n	var $numOfInputFields = 0;\r\n	\r\n	function getOutput() {\r\n		$html = \'<a href=\"\' . JRoute::_(\'index.php?option=com_mtree&amp;task=viewowner&amp;user_id=\' . $this->getValue(1)) . \'\">\';\r\n		$html .= $this->getValue(2);\r\n		$html .= \'</a>\';\r\n		return $html;\r\n	}\r\n}\r\n',0,0,0,0,1),(20,'corename','Name','class mFieldType_corename extends mFieldType {\r\n	var $name = \'link_name\';\r\n	function getOutput($view=1) {\r\n		$params[\'maxSummaryChars\'] = intval($this->getParam(\'maxSummaryChars\',55));\r\n		$params[\'maxDetailsChars\'] = intval($this->getParam(\'maxDetailsChars\',0));\r\n		$value = $this->getValue();\r\n		$output = \'\';\r\n		if($view == 1 AND $params[\'maxDetailsChars\'] > 0 AND JString::strlen($value) > $params[\'maxDetailsChars\']) {\r\n			$output .= JString::substr($value,0,$params[\'maxDetailsChars\']);\r\n			$output .= \'...\';\r\n		} elseif($view == 2 AND $params[\'maxSummaryChars\'] > 0 AND JString::strlen($value) > $params[\'maxSummaryChars\']) {\r\n			$output .= JString::substr($value,0,$params[\'maxSummaryChars\']);\r\n			$output .= \'...\';\r\n		} else {\r\n			$output = $value;\r\n		}\r\n		return $output;\r\n	}\r\n}',0,0,0,0,1),(21,'coredesc','Description','class mFieldType_coredesc extends mFieldType {\r\n	var $name = \'link_desc\';\r\n	function parseValue($value) {\r\n		$params[\'maxChars\'] = intval($this->getParam(\'maxChars\',3000));\r\n		$params[\'stripAllTagsBeforeSave\'] = $this->getParam(\'stripAllTagsBeforeSave\',0);\r\n		$params[\'allowedTags\'] = $this->getParam(\'allowedTags\',\'u,b,i,a,ul,li,pre,blockquote,strong,em\');\r\n		if($params[\'stripAllTagsBeforeSave\']) {\r\n			$value = $this->stripTags($value,$params[\'allowedTags\']);\r\n		}\r\n		if($params[\'maxChars\'] > 0) {\r\n			$value = JString::substr( $value, 0, $params[\'maxChars\']);\r\n		}\r\n		return $value;\r\n	}\r\n	function getInputHTML() {\r\n		global $mtconf;\r\n		\r\n		if( ($this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor_in_admin\')) || (!$this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor\')) ) {\r\n			$editor = &JFactory::getEditor();\r\n			$html = $editor->display( $this->getInputFieldName(1), $this->getValue() , \'100%\', \'250\', \'75\', \'25\', array(\'pagebreak\', \'readmore\') );\r\n		} else {\r\n			$html = \'<textarea class=\"inputbox\" name=\"\' . $this->getInputFieldName(1) . \'\" style=\"width:95%;height:\' . $this->getSize() . \'px\">\' . htmlspecialchars($this->getValue()) . \'</textarea>\';\r\n		}\r\n		return $html;\r\n	}\r\n	function getSearchHTML() {\r\n		return \'<input class=\"inputbox\" type=\"text\" name=\"\' . $this->getName() . \'\" size=\"30\" />\';\r\n	}\r\n	function getOutput($view=1) {\r\n		$params[\'parseUrl\'] = $this->getParam(\'parseUrl\',1);\r\n		$params[\'summaryChars\'] = $this->getParam(\'summaryChars\',255);\r\n		$params[\'stripSummaryTags\'] = $this->getParam(\'stripSummaryTags\',1);\r\n		$params[\'stripDetailsTags\'] = $this->getParam(\'stripDetailsTags\',1);\r\n		$params[\'parseMambots\'] = $this->getParam(\'parseMambots\',0);\r\n		$params[\'allowedTags\'] = $this->getParam(\'allowedTags\',\'u,b,i,a,ul,li,pre,blockquote,strong,em\');\r\n		$params[\'showReadMore\'] = $this->getParam(\'showReadMore\',0);\r\n		$params[\'whenReadMore\'] = $this->getParam(\'whenReadMore\',0);\r\n		$params[\'txtReadMore\'] = $this->getParam(\'txtReadMore\',JTEXT::_( \'Read More...\' ));\r\n		\r\n		$html = $this->getValue();\r\n		$output = \'\';\r\n		\r\n		// Details view\r\n		if($view == 1) {\r\n			global $mtconf;\r\n			$output = $html;\r\n			if($params[\'stripDetailsTags\']) {\r\n				$output = $this->stripTags($output,$params[\'allowedTags\']);\r\n			}\r\n			if($params[\'parseUrl\']) {\r\n				$regex = \'/http:\\/\\/(.*?)(\\s|$)/i\';\r\n				$output = preg_replace_callback( $regex, array($this,\'linkcreator\'), $output );\r\n			}\r\n			if (!$mtconf->get(\'use_wysiwyg_editor\') && $params[\'stripDetailsTags\'] && !in_array(\'br\',explode(\',\',$params[\'allowedTags\'])) && !in_array(\'p\',explode(\',\',$params[\'allowedTags\'])) ) {\r\n				$output = nl2br(trim($output));\r\n			}\r\n			if($params[\'parseMambots\']) {\r\n				$this->parseMambots($output);\r\n			}\r\n		// Summary view\r\n		} else {\r\n			$html = preg_replace(\'@{[\\/\\!]*?[^<>]*?}@si\', \'\', $html);\r\n			if($params[\'stripSummaryTags\']) {\r\n				$html = strip_tags( $html );\r\n			}\r\n			if($params[\'summaryChars\'] > 0) {\r\n				$trimmed_desc = trim(JString::substr($html,0,$params[\'summaryChars\']));\r\n			} else {\r\n				$trimmed_desc = \'\';\r\n			}\r\n			if($params[\'stripSummaryTags\']) {\r\n				$html = htmlspecialchars( $html );\r\n				$trimmed_desc = htmlspecialchars( $trimmed_desc );\r\n			}\r\n			if (JString::strlen($html) > $params[\'summaryChars\']) {\r\n				$output .= $trimmed_desc;\r\n				$output .= \' <b>...</b>\';\r\n			} else {\r\n				$output = $html;\r\n			}\r\n			if( $params[\'showReadMore\'] && ($params[\'whenReadMore\'] == 1 || ($params[\'whenReadMore\'] == 0 && JString::strlen($html) > $params[\'summaryChars\'])) ) {\r\n				if(!empty($trimmed_desc)) {\r\n					$output .= \'<br />\';\r\n				}\r\n				$output .= \' <a href=\"\' . JRoute::_(\'index.php?option=com_mtree&task=viewlink&link_id=\' . $this->getLinkId()) . \'\" class=\"readon\">\' . $params[\'txtReadMore\'] . \'</a>\';\r\n			}\r\n		}\r\n		return $output;\r\n	}\r\n}',0,0,0,0,1),(22,'corecreated','Created','class mFieldType_corecreated extends mFieldType_date {\r\n	var $name = \'link_created\';\r\n	var $numOfInputFields = 0;\r\n	function parseValue($value) {\r\n		return strip_tags($value);\r\n	}\r\n}',0,0,0,0,1),(23,'weblinknewwin','Web link','class mFieldType_weblinkNewWin extends mFieldType_weblink {\r\n\r\n}',1,1,1,0,0),(24,'audioplayer','Audio Player','class mFieldType_audioplayer extends mFieldType_file {\r\n	function getJSValidation() {\r\n\r\n		$js = \'\';\r\n		$js .= \'} else if (!hasExt(form.\' . $this->getName() . \'.value,\\\'mp3\\\')) {\'; \r\n		$js .= \'alert(\"\' . addslashes($this->getCaption()) . \': Please select a mp3 file.\");\';\r\n		return $js;\r\n	}\r\n	function getOutput() {\r\n		$id = $this->getId();\r\n		$params[\'text\'] = $this->getParam(\'textColour\');\r\n		$params[\'displayfilename\'] = $this->getParam(\'displayfilename\',1);\r\n		$params[\'slider\'] = $this->getParam(\'sliderColour\');\r\n		$params[\'loader\'] = $this->getParam(\'loaderColour\');\r\n		$params[\'track\'] = $this->getParam(\'trackColour\');\r\n		$params[\'border\'] = $this->getParam(\'borderColour\');\r\n		$params[\'bg\'] = $this->getParam(\'backgroundColour\');\r\n		$params[\'leftbg\'] = $this->getParam(\'leftBackgrounColour\');\r\n		$params[\'rightbg\'] = $this->getParam(\'rightBackgrounColour\');\r\n		$params[\'rightbghover\'] = $this->getParam(\'rightBackgroundHoverColour\');\r\n		$params[\'lefticon\'] = $this->getParam(\'leftIconColour\');\r\n		$params[\'righticon\'] = $this->getParam(\'rightIconColour\');\r\n		$params[\'righticonhover\'] = $this->getParam(\'rightIconHoverColour\');\r\n		\r\n		$html = \'\';\r\n		$html .= \'<script language=\"JavaScript\" src=\"\' . $this->getFieldTypeAttachmentURL(\'audio-player.js\'). \'\"></script>\';\r\n		$html .= \"\\n\" . \'<object type=\"application/x-shockwave-flash\" data=\"\' . $this->getFieldTypeAttachmentURL(\'player.swf\'). \'\" id=\"audioplayer\' . $id . \'\" height=\"24\" width=\"290\">\';\r\n		$html .= \"\\n\" . \'<param name=\"movie\" value=\"\' . $this->getFieldTypeAttachmentURL(\'player.swf\') . \'\">\';\r\n		$html .= \"\\n\" . \'<param name=\"FlashVars\" value=\"\';\r\n		$html .= \'playerID=\' . $id;\r\n		$html .= \'&amp;soundFile=\' . urlencode($this->getDataAttachmentURL());\r\n		foreach( $params AS $key => $value ) {\r\n			if(!empty($value)) {\r\n				$html .= \'&amp;\' . $key . \'=0x\' . $value;\r\n			}\r\n		}\r\n		$html .= \'\">\';\r\n		$html .= \"\\n\" . \'<param name=\"quality\" value=\"high\">\';\r\n		$html .= \"\\n\" . \'<param name=\"menu\" value=\"false\">\';\r\n		$html .= \"\\n\" . \'<param name=\"wmode\" value=\"transparent\">\';\r\n		$html .= \"\\n\" . \'</object>\';\r\n		if($params[\'displayfilename\']) {\r\n			$html .= \"\\n<br />\";\r\n			$html .= \"\\n\" . \'<a href=\"\' . $this->getDataAttachmentURL() . \'\" target=\"_blank\">\';\r\n			$html .= $this->getValue();\r\n			$html .= \'</a>\';\r\n		}\r\n		return $html;\r\n	}\r\n}',0,0,0,0,0),(25,'image','Image','class mFieldType_image extends mFieldType_file {\r\n	function parseValue($value) {\r\n		global $mtconf;\r\n		$params[\'size\'] = intval(trim($this->getParam(\'size\')));\r\n		if($params[\'size\'] <= 0) {\r\n			$size = $mtconf->get(\'resize_listing_size\');\r\n		} else {\r\n			$size = intval($params[\'size\']);\r\n		}\r\n		$mtImage = new mtImage();\r\n		$mtImage->setMethod( $mtconf->get(\'resize_method\') );\r\n		$mtImage->setQuality( $mtconf->get(\'resize_quality\') );\r\n		$mtImage->setSize( $size );\r\n		$mtImage->setTmpFile( $value[\'tmp_name\'] );\r\n		$mtImage->setType( $value[\'type\'] );\r\n		$mtImage->setName( $value[\'name\'] );\r\n		$mtImage->setSquare(false);\r\n		$mtImage->resize();\r\n		$value[\'data\'] = $mtImage->getImageData();\r\n		$value[\'size\'] = strlen($value[\'data\']);\r\n		\r\n		return $value;\r\n	}\r\n	function getJSValidation() {\r\n		$js = \'\';\r\n		$js .= \'} else if (!hasExt(form.\' .$this->getInputFieldName(1) . \'.value,\\\'gif|png|jpg|jpeg\\\')) {\'; \r\n		$js .= \'alert(\"\' . addslashes($this->getCaption()) . \': Please select an image with one of these extensions - gif,png,jpg,jpeg.\");\';\r\n		return $js;\r\n	}\r\n	function getOutput() {\r\n		$html = \'\';\r\n		$html .= \'<img src=\"\' . $this->getDataAttachmentURL() . \'\" />\';\r\n		return $html;\r\n	}\r\n	function getInputHTML() {\r\n		$html = \'\';\r\n		if( $this->attachment > 0 ) {\r\n			$html .= $this->getKeepFileCheckboxHTML($this->attachment);\r\n			$html .= \'<label for=\"\' . $this->getKeepFileName() . \'\"><img src=\"\' . $this->getDataAttachmentURL() . \'\" hspace=\"5\" vspace=\"0\" /></label>\';\r\n			$html .= \'</br >\';\r\n		}\r\n		$html .= \'<input class=\"inputbox\" type=\"file\" name=\"\' . $this->getInputFieldName(1) . \'\" />\';\r\n		return $html;\r\n	}\r\n	\r\n}',0,0,0,0,0),(26,'multilineTextbox','Multi-line Textbox','class mFieldType_multilineTextbox extends mFieldType {\r\n	function parseValue($value) {\r\n		$params[\'stripAllTagsBeforeSave\'] = $this->getParam(\'stripAllTagsBeforeSave\',0);\r\n		$params[\'allowedTags\'] = $this->getParam(\'allowedTags\',\'u,b,i,a,ul,li,pre,br,blockquote\');\r\n		if($params[\'stripAllTagsBeforeSave\']) {\r\n			$value = $this->stripTags($value,$params[\'allowedTags\']);\r\n		}\r\n		return $value;		\r\n	}\r\n	function getInputHTML() {\r\n		global $mtconf;\r\n		\r\n		if( ($this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor_in_admin\')) || (!$this->inBackEnd() AND $mtconf->get(\'use_wysiwyg_editor\')) ) {\r\n			$editor = &JFactory::getEditor();\r\n			$html = $editor->display( $this->getInputFieldName(1), $this->getValue() , \'100%\', \'250\', \'75\', \'25\', array(\'pagebreak\', \'readmore\') );\r\n		} else {\r\n			$html = \'<textarea class=\"inputbox\" name=\"\' . $this->getInputFieldName(1) . \'\" style=\"width:95%;height:\' . $this->getSize() . \'px\">\' . htmlspecialchars($this->getValue()) . \'</textarea>\';\r\n		}\r\n		return $html;\r\n	}\r\n	function getSearchHTML() {\r\n		return \'<input class=\"inputbox\" type=\"text\" name=\"\' . $this->getName() . \'\" size=\"30\" />\';\r\n	}\r\n	function getOutput($view=1) {\r\n		$params[\'parseUrl\'] = $this->getParam(\'parseUrl\',1);\r\n		$params[\'summaryChars\'] = $this->getParam(\'summaryChars\',255);\r\n		$params[\'stripSummaryTags\'] = $this->getParam(\'stripSummaryTags\',1);\r\n		$params[\'stripDetailsTags\'] = $this->getParam(\'stripDetailsTags\',1);\r\n		$params[\'allowedTags\'] = $this->getParam(\'allowedTags\',\'u,b,i,a,ul,li,pre,br,blockquote\');\r\n	\r\n		$html = $this->getValue();\r\n	\r\n		// Details view\r\n		if($view == 1) {\r\n			if($params[\'stripDetailsTags\']) {\r\n				$html = $this->stripTags($html,$params[\'allowedTags\']);\r\n			}\r\n			if($params[\'parseUrl\'] AND $view == 0) {\r\n				$regex = \'/http:\\/\\/(.*?)(\\s|$)/i\';\r\n				$html = preg_replace_callback( $regex, array($this,\'linkcreator\'), $html );\r\n			}\r\n		// Summary view\r\n		} else {\r\n			$html = preg_replace(\'@{[\\/\\!]*?[^<>]*?}@si\', \'\', $html);\r\n			if($params[\'stripSummaryTags\']) {\r\n				$html = strip_tags( $html );\r\n			} else {\r\n			}\r\n			$trimmed_desc = trim(JString::substr($html,0,$params[\'summaryChars\']));\r\n			if (JString::strlen($html) > $params[\'summaryChars\']) {\r\n				$html = $trimmed_desc . \' <b>...</b>\';\r\n			}\r\n		}\r\n		return $html;\r\n	}\r\n}',0,0,0,0,0),(29,'onlinevideo','Online Video','class mFieldType_onlinevideo extends mFieldType {\r\n\r\n	function getOutput() {\r\n		$html =\'\';\r\n		$id = $this->getVideoId();\r\n		$videoProvider = $this->getParam(\'videoProvider\',\'youtube\');\r\n		switch($videoProvider) {\r\n			case \'youtube\':\r\n				$params[\'youtubeWidth\'] = $this->getParam(\'youtubeWidth\',425);\r\n				$params[\'youtubeHeight\'] = $this->getParam(\'youtubeHeight\',350);\r\n				$html .= \'<object width=\"\' . $params[\'youtubeWidth\'] . \'\" height=\"\' . $params[\'youtubeHeight\'] . \'\">\';\r\n				$html .= \'<param name=\"movie\" value=\"http://www.youtube.com/v/\' . $id . \'\"></param>\';\r\n				$html .= \'<param name=\"wmode\" value=\"transparent\"></param>\';\r\n				$html .= \'<embed src=\"http://www.youtube.com/v/\' . $id . \'\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"\' . $params[\'youtubeWidth\'] . \'\" height=\"\' . $params[\'youtubeHeight\'] . \'\"></embed>\';\r\n				$html .= \'</object>\';\r\n				break;\r\n			case \'googlevideo\':\r\n				$html .= \'<embed style=\"width:400px; height:326px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=\' . $id . \'\">\';\r\n				$html .= \'</embed>\';\r\n				break;\r\n			/*\r\n			case \'metacafe\':\r\n				$html .= \'<embed src=\"http://www.metacafe.com/fplayer/\' . $id . \'.swf\" width=\"400\" height=\"345\" wmode=\"transparent\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\"></embed>\';\r\n				break;\r\n			case \'ifilm\':\r\n				$html .= \'<embed width=\"448\" height=\"365\" src=\"http://www.ifilm.com/efp\" quality=\"high\" bgcolor=\"000000\" name=\"efp\" align=\"middle\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" flashvars=\"flvbaseclip=\' . $id . \'&amp;\"></embed>\';\r\n				break;\r\n			*/\r\n		}\r\n		return $html;\r\n	}\r\n	\r\n	function getVideoId() {\r\n		$videoProvider = $this->getParam(\'videoProvider\',\'youtube\');\r\n		$value = $this->getValue();\r\n		$id = null;\r\n		if(empty($value)) {\r\n			return null;\r\n		}\r\n		$url = parse_url($value);\r\n	    parse_str($url[\'query\'], $query);\r\n		switch($videoProvider) {\r\n			case \'youtube\':\r\n				if (isset($query[\'v\'])) {\r\n			        $id = $query[\'v\'];\r\n			    }\r\n				break;\r\n			case \'googlevideo\':\r\n			    if (isset($query[\'docid\'])) {\r\n			        $id = $query[\'docid\'];\r\n			    }\r\n				break;\r\n		}\r\n		return $id;\r\n	}\r\n	\r\n	function getInputHTML() {\r\n		$videoProvider = $this->getParam(\'videoProvider\',\'youtube\');\r\n		$youtubeInputDescription = $this->getParam(\'youtubeInputDescription\',\'Enter the full URL of the Youtube video page.<br />ie: <b>http://youtube.com/watch?v=OHpANlSG7OI</b>\');\r\n		$googlevideoInputDescription = $this->getParam(\'googlevideoInputDescription\',\'Enter the full URL of the Google video page.<br />ie: <b>http://video.google.com/videoplay?docid=832064557062572361</b>\');\r\n		$html = \'\';\r\n		$html .= \'<input class=\"text_area\" type=\"text\" name=\"\' . $this->getInputFieldName(1) . \'\" id=\"\' . $this->getInputFieldName(1) . \'\" size=\"\' . $this->getSize() . \'\" value=\"\' . htmlspecialchars($this->getValue()) . \'\" />\';\r\n		switch($videoProvider) {\r\n			case \'youtube\':\r\n				if(!empty($youtubeInputDescription)) {\r\n					$html .= \'<br />\' . $youtubeInputDescription;\r\n				}\r\n				break;\r\n			case \'googlevideo\':\r\n				if(!empty($googlevideoInputDescription)) {\r\n					$html .= \'<br />\' . $googlevideoInputDescription;\r\n				}\r\n		}\r\n		return $html;\r\n	}\r\n	\r\n	function getSearchHTML() {\r\n		$checkboxLabel = $this->getParam(\'checkboxLabel\',\'Contains video\');\r\n		return \'<input class=\"text_area\" type=\"checkbox\" name=\"\' . $this->getSearchFieldName(1) . \'\" id=\"\' . $this->getSearchFieldName(1) . \'\" />&nbsp;<label for=\"\' . $this->getName() . \'\">\' . $checkboxLabel . \'</label>\';\r\n	}\r\n	\r\n	function getWhereCondition() {\r\n		if( func_num_args() == 0 ) {\r\n			return null;\r\n		} else {\r\n			return \'(cfv#.value <> \\\'\\\')\';\r\n		}\r\n	}\r\n}',0,1,0,0,0),(30,'coremetakey','Meta Keys','class mFieldType_coremetakey extends mFieldType {\r\n	var $name = \'metakey\';\r\n}',0,0,0,1,1),(31,'coremetadesc','Meta Description','class mFieldType_coremetadesc extends mFieldType {\r\n	var $name = \'metadesc\';\r\n}\r\n',0,0,0,0,1),(32,'mtags','Tags','class mFieldType_mTags extends mFieldType_tags {\r\n\r\n}',0,1,0,1,0),(45,'videoplayer','Video Player','class mFieldType_videoplayer extends mFieldType_file {\r\n\r\n	function getOutput() {\r\n		$html =\'\';\r\n		$filename = $this->getValue();\r\n		$format = $this->getParam(\'format\');\r\n		$id = $format.$filename;\r\n		$width = $this->getParam(\'width\');\r\n		$height = $this->getParam(\'height\');\r\n		$autoplay = $this->getParam(\'autoplay\',false);\r\n		if($autoplay) {\r\n			$autoplay = \'true\';\r\n		} else {\r\n			$autoplay = \'false\';\r\n		}\r\n		switch($format) {\r\n			case \'mov\':\r\n				$html .= \'<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" width=\"\' . $width . \'\" height=\"\' . $height. \'\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" align=\"middle\">\';\r\n				$html .= \'<param name=\"src\" value=\"\' . $this->getDataAttachmentURL() . \'\" />\';\r\n				$html .= \'<embed src=\"\' . $this->getDataAttachmentURL() . \'\" type=\"video/quicktime\" width=\"\' . $width . \'\" height=\"\' . $height . \'\" pluginspage=\"http://www.apple.com/quicktime/download/\" align=\"middle\" autoplay=\"\' . $autoplay . \'\" />\';\r\n				$html .= \'</object>\';\r\n				break;\r\n			case \'divx\':\r\n				$html .= \'\';\r\n				$html .= \'<object classid=\"clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616\" width=\"\' . $width . \'\" height=\"\' . $height . \'\" codebase=\"http://go.divx.com/plugin/DivXBrowserPlugin.cab\">\';\r\n				$html .= \'<param name=\"src\" value=\"\' . $this->getDataAttachmentURL() . \'\" />\';\r\n				$html .= \'<param name=\"autoPlay\" value=\"\' . $autoplay . \'\" />\';\r\n				$html .= \'<embed src=\"\' . $this->getDataAttachmentURL() . \'\" type=\"video/divx\" width=\"\' . $width . \'\" height=\"\' . $height . \'\" autoPlay=\"\' . $autoplay . \'\" pluginspage=\"http://go.divx.com/plugin/download/\" />\';\r\n				$html .= \'</object>\';\r\n				break;\r\n			case \'windowsmedia\':\r\n				$html .= \'<object classid=\"CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6\" id=\"\' . $id . \'\" width=\"\' . $width . \'\" height=\"\' . $height . \'\" type=\"application/x-oleobject\">\';\r\n				$html .= \'<param name=\"URL\" value=\"\' . $this->getDataAttachmentURL() . \'\" />\';\r\n				$html .= \'<param name=\"wmode\" value=\"opaque\" />\';\r\n				$html .= \'<param name=\"ShowControls\" value=\"1\" />\';\r\n				$html .= \'<param name=\"autoStart\" value=\"\' . (($autoplay==\'true\')?\'1\':\'0\') . \'\" />\';\r\n				$html .= \'<embed src=\"\' . $this->getDataAttachmentURL() . \'\" type=\"application/x-mplayer2\" width=\"\' . $width . \'\" height=\"\' . $height . \'\" wmode=\"opaque\" border=\"0\" autoStart=\"\' . (($autoplay == \'true\')?\'1\':\'0\') . \'\" />\';\r\n				$html .= \'</object>\';\r\n				break;\r\n		}\r\n		return $html;\r\n	}\r\n}',0,0,0,0,0),(46,'year','Year','class mFieldType_year extends mFieldType {\r\n	var $numOfSearchFields = 2;\r\n	function getSearchHTML() {\r\n		$startYear = $this->getParam(\'startYear\',(date(\'Y\')-70));\r\n		$endYear = $this->getParam(\'endYear\',date(\'Y\'));\r\n		\r\n		$html = \'<select name=\"\' . $this->getSearchFieldName(2) . \'\" class=\"inputbox\" size=\"1\">\';\r\n		$html .= \'<option value=\"1\" selected=\"selected\">\' . JText::_( \'EXACTLY\' ) . \'</option>\';\r\n		$html .= \'<option value=\"2\">\' . JText::_( \'AFTER\' ) . \'</option>\';\r\n		$html .= \'<option value=\"3\">\' . JText::_( \'BEFORE\' ) . \'</option>\';\r\n		$html .= \'</select>\';\r\n		$html .= \'&nbsp;\';\r\n\r\n		$html .= \'<select name=\"\' . $this->getInputFieldName(1) . \'\" class=\"inputbox\">\';\r\n		$html .= \'<option value=\"\">&nbsp;</option>\';\r\n		for($year=$endYear;$year>=$startYear;$year--) {\r\n			$html .= \'<option value=\"\' . $year . \'\">\' . $year . \'</option>\';\r\n		}\r\n		$html .= \'</select>\';		\r\n\r\n		return $html;\r\n	}\r\n\r\n	function getInputHTML() {\r\n		$startYear = $this->getParam(\'startYear\',(date(\'Y\')-70));\r\n		$endYear = $this->getParam(\'endYear\',date(\'Y\'));\r\n		$value = $this->getValue();\r\n		\r\n		$html = \'\';\r\n		$html .= \'<select name=\"\' . $this->getInputFieldName() . \'\" class=\"inputbox\">\';\r\n		$html .= \'<option value=\"\">&nbsp;</option>\';\r\n		for($year=$endYear;$year>=$startYear;$year--) {\r\n			$html .= \'<option value=\"\' . $year . \'\"\';\r\n			if( $year == $value ) {\r\n				$html .= \' selected\';\r\n			}\r\n			$html .= \'>\' . $year . \'</option>\';\r\n		}\r\n		$html .= \'</select>\';		\r\n		return $html;\r\n	}\r\n	\r\n	function getWhereCondition() {\r\n		$args = func_get_args();\r\n		$fieldname = \'cfv#.value\';\r\n		if( ($args[1] >= 1 || $args[1] <= 3) && is_numeric($args[0]) ) {\r\n			switch($args[1]) {\r\n				case 1:\r\n					return $fieldname . \' = \\\'\' . $args[0] . \'\\\'\';\r\n					break;\r\n				case 2:\r\n					return $fieldname . \' > \\\'\' . $args[0] . \'\\\'\';\r\n					break;\r\n				case 3:\r\n					return $fieldname . \' < \\\'\' . $args[0] . \'\\\'\';\r\n					break;\r\n			}\r\n		} else {\r\n			return null;\r\n		}\r\n	}	\r\n}',0,0,0,0,0),(47,'mdate','Date','class mFieldType_mDate extends mFieldType_date {\r\n}',0,0,0,0,0),(48,'mfile','File','class mFieldType_mFile extends mFieldType_file {\r\n	function getOutput() {\r\n	global $mtconf;\r\n	\r\n		$html = \'\';\r\n		$showCounter 	= $this->getParam(\'showCounter\',1);\r\n		$useImage		= $this->getParam(\'useImage\',\'\');\r\n		$showFilename	= $this->getParam(\'showFilename\',1);\r\n		$showText		= $this->getParam(\'showText\',\'\');\r\n		if(!empty($this->value))\r\n		{\r\n			$html .= \'<a href=\"\' . $this->getDataAttachmentURL() . \'\" target=\"_blank\">\';\r\n			if( !empty($useImage) )\r\n			{\r\n				$live_site = $mtconf->getjconf(\'live_site\');\r\n				$html .= \'<img src=\"\' . trim(str_replace(\'{live_site}\',$live_site,$useImage)) . \'\"\';\r\n				$html .= \' alt=\"\"\';\r\n				$html .= \' /> \';\r\n			} \r\n\r\n			if( !empty($showText) )\r\n			{\r\n				$html .= $showText . \' \';\r\n			}\r\n			\r\n			if( $showFilename == 1 )\r\n			{\r\n				$html .= $this->getValue();\r\n			}\r\n\r\n			$html .= \'</a>\';\r\n		}\r\n\r\n		$append_html = array();\r\n		if( $showCounter ) {\r\n			$append_html[] = JText::sprintf(\'{{n}} views\', $this->counter);\r\n		}\r\n\r\n		if( !empty($append_html) ) {\r\n			$html .= \' (\' . implode(\', \',$append_html) . \')\';\r\n		}\r\n		return $html;\r\n	}\r\n	function getJSValidation() {\r\n		$fileExtensions = $this->getParam(\'fileExtensions\',\'\');\r\n		if(is_array($fileExtensions)) {\r\n			$fileExtensions = implode(\'|\',$fileExtensions);\r\n		} else {\r\n			$fileExtensions = trim($fileExtensions);\r\n		}\r\n		if(!empty($fileExtensions)) {\r\n			$js = \'\';\r\n			$js .= \'} else if (!hasExt(form.\' .$this->getInputFieldName(1) . \'.value,\\\'\' . $fileExtensions . \'\\\')) {\'; \r\n			$js .= \'alert(\"\' . addslashes($this->getCaption()) . \': Please select files with these extension(s) - \' . str_replace(\'|\',\', \',$fileExtensions) . \'.\");\';\r\n			return $js;\r\n		} else {\r\n			return null;\r\n		}\r\n	}\r\n}',0,0,0,0,0),(50,'memail','E-mail','class mFieldType_mEmail extends mFieldType_email {}',0,1,0,0,0),(51,'mnumber','Number','class mFieldType_mNumber extends mFieldType_number {\r\n}',0,0,0,0,0),(54,'digg','Digg','class mFieldtype_digg extends mFieldType { \r\n    var $numOfSearchFields = 0; \r\n    var $numOfInputFields = 0; \r\n\r\n    function getOutput($view=1) { \r\n        global $mtconf, $Itemid; \r\n        $html = \'\'; \r\n        $html .= \'<script type=\"text/javascript\">\'; \r\n        $html .= \'digg_url=\\\'\'; \r\n        $uri =& JURI::getInstance(); \r\n        if(substr($mtconf->getjconf(\'live_site\'),0,16) == \'http://localhost\') { \r\n            // Allow for debugging \r\n            $html .= str_replace(\'http://localhost\',\'http://127.0.0.1\',$uri->toString(array( \'scheme\', \'host\', \'port\' ))); \r\n        } else { \r\n            $html .= $uri->toString(array( \'scheme\', \'host\', \'port\' )); \r\n        } \r\n        $html .= JRoute::_(\'index.php?option=com_mtree&task=viewlink&link_id=\'.$this->getLinkId().\'&Itemid=\'.$Itemid, false) .\'\\\';\'; \r\n        // Display the compact version when displayed in Summary view \r\n        if($view==2) { \r\n            $html .= \'digg_skin = \\\'compact\\\';\'; \r\n        } \r\n        $html .= \'</script>\'; \r\n        $html .= \'<script src=\"http://digg.com/tools/diggthis.js\" type=\"text/javascript\"></script>\'; \r\n        return $html; \r\n    } \r\n}',0,0,0,0,0);
/*!40000 ALTER TABLE `jos_mt_fieldtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_fieldtypes_att`
--

DROP TABLE IF EXISTS `jos_mt_fieldtypes_att`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_fieldtypes_att` (
  `fta_id` int(11) NOT NULL AUTO_INCREMENT,
  `ft_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filedata` mediumblob NOT NULL,
  `filesize` int(11) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`fta_id`),
  KEY `filename` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_fieldtypes_att`
--

LOCK TABLES `jos_mt_fieldtypes_att` WRITE;
/*!40000 ALTER TABLE `jos_mt_fieldtypes_att` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_fieldtypes_att` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_fieldtypes_info`
--

DROP TABLE IF EXISTS `jos_mt_fieldtypes_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_fieldtypes_info` (
  `ft_id` smallint(6) NOT NULL,
  `ft_version` varchar(64) NOT NULL,
  `ft_website` varchar(255) NOT NULL,
  `ft_desc` text NOT NULL,
  PRIMARY KEY (`ft_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_fieldtypes_info`
--

LOCK TABLES `jos_mt_fieldtypes_info` WRITE;
/*!40000 ALTER TABLE `jos_mt_fieldtypes_info` DISABLE KEYS */;
INSERT INTO `jos_mt_fieldtypes_info` VALUES (1,'','',''),(24,'3','http://www.mosets.com','Audio Player allows users to upload a mucis file and play the music from within the listing page. Provides basic playback options such as play, pause and volumne control. Made possible by http://www.1pixelout.net/code/audio-player-wordpress-plugin/.'),(25,'3','http://www.mosets.com','Image field type accepts gif, png & jpg file and resize it according to the value set in the parameter before it is stored to the database.'),(29,'2','http://www.mosets.com',''),(32,'1','http://www.mosets.com',''),(36,'1','http://www.mosets.com',''),(37,'1','http://www.mosets.com',''),(38,'1','http://www.mosets.com',''),(39,'1','http://www.mosets.com',''),(45,'3','http://www.mosets.com',''),(46,'1','http://www.mosets.com',''),(47,'1','http://www.mosets.com','Date input'),(48,'4','http://www.mosets.com','File field type accept any type of file uploads. You can choose to limit the acceptable file extension in the parameter settings.'),(50,'1','http://www.mosets.com','E-mail field type validates the e-mail entered by users before storing it to the database. The e-mail will be displayed with the \'mailto\' protocol in the front-end. To protect against e-mail harvester, e-mail is cloaked through javascript.'),(51,'1','http://www.mosets.com','Number field type accepts numeric value with up to 2 decimals.'),(53,'1','http://www.mosets.com',''),(54,'1','http://www.digg.com','Displays the Digg button for each listings.');
/*!40000 ALTER TABLE `jos_mt_fieldtypes_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_images`
--

DROP TABLE IF EXISTS `jos_mt_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `ordering` int(10) unsigned NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `link_id_ordering` (`link_id`,`ordering`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_images`
--

LOCK TABLES `jos_mt_images` WRITE;
/*!40000 ALTER TABLE `jos_mt_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_linkcheck`
--

DROP TABLE IF EXISTS `jos_mt_linkcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_linkcheck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `link_name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `status_code` smallint(5) unsigned NOT NULL,
  `check_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_linkcheck`
--

LOCK TABLES `jos_mt_linkcheck` WRITE;
/*!40000 ALTER TABLE `jos_mt_linkcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_linkcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_links`
--

DROP TABLE IF EXISTS `jos_mt_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link_desc` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `link_hits` int(11) NOT NULL DEFAULT '0',
  `link_votes` int(11) NOT NULL DEFAULT '0',
  `link_rating` decimal(7,6) unsigned NOT NULL DEFAULT '0.000000',
  `link_featured` smallint(6) NOT NULL DEFAULT '0',
  `link_published` tinyint(4) NOT NULL DEFAULT '0',
  `link_approved` int(4) NOT NULL DEFAULT '0',
  `link_template` varchar(255) NOT NULL,
  `attribs` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `internal_notes` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `link_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_visited` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `price` double(9,2) NOT NULL DEFAULT '0.00',
  `lat` float NOT NULL COMMENT 'Latitude',
  `lng` float NOT NULL COMMENT 'Longitude',
  `zoom` tinyint(3) unsigned NOT NULL COMMENT 'Map''s zoom level',
  PRIMARY KEY (`link_id`),
  KEY `link_rating` (`link_rating`),
  KEY `link_votes` (`link_votes`),
  KEY `link_name` (`link_name`),
  KEY `publishing` (`link_published`,`link_approved`,`publish_up`,`publish_down`),
  KEY `count_listfeatured` (`link_published`,`link_approved`,`link_featured`,`publish_up`,`publish_down`,`link_id`),
  KEY `count_viewowner` (`link_published`,`link_approved`,`user_id`,`publish_up`,`publish_down`),
  KEY `mylisting` (`user_id`,`link_id`),
  FULLTEXT KEY `link_name_desc` (`link_name`,`link_desc`)
) ENGINE=MyISAM AUTO_INCREMENT=1266 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_links`
--

LOCK TABLES `jos_mt_links` WRITE;
/*!40000 ALTER TABLE `jos_mt_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_log`
--

DROP TABLE IF EXISTS `jos_mt_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_ip` varchar(255) NOT NULL DEFAULT '',
  `log_type` varchar(32) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `log_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_id` int(11) NOT NULL DEFAULT '0',
  `rev_id` int(11) NOT NULL DEFAULT '0',
  `value` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`),
  KEY `link_id2` (`link_id`,`log_ip`),
  KEY `link_id1` (`link_id`,`user_id`),
  KEY `log_type` (`log_type`),
  KEY `log_ip` (`log_ip`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_log`
--

LOCK TABLES `jos_mt_log` WRITE;
/*!40000 ALTER TABLE `jos_mt_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_relcats`
--

DROP TABLE IF EXISTS `jos_mt_relcats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_relcats` (
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `rel_id` int(11) NOT NULL DEFAULT '0',
  KEY `cat_id` (`cat_id`,`rel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_relcats`
--

LOCK TABLES `jos_mt_relcats` WRITE;
/*!40000 ALTER TABLE `jos_mt_relcats` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_relcats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_reports`
--

DROP TABLE IF EXISTS `jos_mt_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `link_id` int(11) NOT NULL,
  `rev_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL,
  `comment` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `admin_note` mediumtext NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_reports`
--

LOCK TABLES `jos_mt_reports` WRITE;
/*!40000 ALTER TABLE `jos_mt_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_reviews`
--

DROP TABLE IF EXISTS `jos_mt_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_reviews` (
  `rev_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `guest_name` varchar(255) NOT NULL DEFAULT '',
  `rev_title` varchar(255) NOT NULL DEFAULT '',
  `rev_text` text NOT NULL,
  `rev_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rev_approved` tinyint(4) NOT NULL DEFAULT '1',
  `admin_note` mediumtext NOT NULL,
  `vote_helpful` int(10) unsigned NOT NULL DEFAULT '0',
  `vote_total` int(10) unsigned NOT NULL DEFAULT '0',
  `ownersreply_text` text NOT NULL,
  `ownersreply_date` datetime NOT NULL,
  `ownersreply_approved` tinyint(4) NOT NULL DEFAULT '0',
  `ownersreply_admin_note` mediumtext NOT NULL,
  `send_email` tinyint(3) unsigned NOT NULL,
  `email_message` mediumtext NOT NULL,
  PRIMARY KEY (`rev_id`),
  KEY `link_id` (`link_id`,`rev_approved`,`rev_date`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_reviews`
--

LOCK TABLES `jos_mt_reviews` WRITE;
/*!40000 ALTER TABLE `jos_mt_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_searchlog`
--

DROP TABLE IF EXISTS `jos_mt_searchlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_searchlog` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_text` text NOT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_searchlog`
--

LOCK TABLES `jos_mt_searchlog` WRITE;
/*!40000 ALTER TABLE `jos_mt_searchlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_mt_searchlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_mt_templates`
--

DROP TABLE IF EXISTS `jos_mt_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_mt_templates` (
  `tem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_name` varchar(255) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`tem_id`),
  UNIQUE KEY `tem_name` (`tem_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_mt_templates`
--

LOCK TABLES `jos_mt_templates` WRITE;
/*!40000 ALTER TABLE `jos_mt_templates` DISABLE KEYS */;
INSERT INTO `jos_mt_templates` VALUES (1,'m2','numOfColumns=3\nnumOfSubcatsToDisplay=9999\nnumOfLinksToDisplay=0\ndisplayIndexCatCount=0\ndisplayIndexListingCount=1\ndisplayCatDesc=0\ndisplayAlphaIndex=0\ndisplayIndexCatImage=0\ndisplaySubcatsCatCount=0\ndisplaySubcatsListingCount=1\nlimitDetailsViewToRegistered=0\nlistingNameLink=3\ndisplayAddressInOneRow=0\nshowActionLinksInSummary=1\nshowImageInSummary=0\nimageDirectionListingSummary=right\nlistingDetailsImagesOutputMode=1\nMaxNumOfImages=6\nskipFirstImage=0\nonlyShowRootLevelCatInListalpha=0\nuseFeaturedHighlight=1');
/*!40000 ALTER TABLE `jos_mt_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_newsfeeds`
--

DROP TABLE IF EXISTS `jos_newsfeeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_newsfeeds`
--

LOCK TABLES `jos_newsfeeds` WRITE;
/*!40000 ALTER TABLE `jos_newsfeeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_newsfeeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_plugins`
--

DROP TABLE IF EXISTS `jos_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_plugins`
--

LOCK TABLES `jos_plugins` WRITE;
/*!40000 ALTER TABLE `jos_plugins` DISABLE KEYS */;
INSERT INTO `jos_plugins` VALUES (1,'Authentication - Joomla','joomla','authentication',0,1,1,1,0,0,'0000-00-00 00:00:00',''),(2,'Authentication - LDAP','ldap','authentication',0,2,1,1,0,0,'0000-00-00 00:00:00','host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n'),(3,'Authentication - GMail','gmail','authentication',0,4,1,0,0,0,'0000-00-00 00:00:00',''),(4,'Authentication - OpenID','openid','authentication',0,3,1,0,0,0,'0000-00-00 00:00:00',''),(5,'User - Joomla!','joomla','user',0,0,1,0,0,0,'0000-00-00 00:00:00','autoregister=1\n\n'),(6,'Search - Content','content','search',0,1,1,1,0,0,'0000-00-00 00:00:00','search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n'),(7,'Search - Contacts','contacts','search',0,3,1,1,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(8,'Search - Categories','categories','search',0,4,1,0,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(9,'Search - Sections','sections','search',0,5,1,0,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(10,'Search - Newsfeeds','newsfeeds','search',0,6,0,0,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(11,'Search - Weblinks','weblinks','search',0,2,1,1,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(12,'Content - Pagebreak','pagebreak','content',0,10000,1,1,0,0,'0000-00-00 00:00:00','enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n'),(13,'Content - Rating','vote','content',0,4,1,1,0,0,'0000-00-00 00:00:00',''),(14,'Content - Email Cloaking','emailcloak','content',0,5,1,0,0,0,'0000-00-00 00:00:00','mode=1\n\n'),(15,'Content - Code Hightlighter (GeSHi)','geshi','content',0,5,0,0,0,0,'0000-00-00 00:00:00',''),(16,'Content - Load Module','loadmodule','content',0,6,1,0,0,0,'0000-00-00 00:00:00','enabled=1\nstyle=0\n\n'),(17,'Content - Page Navigation','pagenavigation','content',0,2,1,1,0,0,'0000-00-00 00:00:00','position=1\n\n'),(18,'Editor - No Editor','none','editors',0,0,1,1,0,0,'0000-00-00 00:00:00',''),(19,'Editor - TinyMCE','tinymce','editors',0,0,1,1,0,0,'0000-00-00 00:00:00','mode=advanced\nskin=0\ncompressed=0\ncleanup_startup=0\ncleanup_save=2\nentity_encoding=raw\nlang_mode=0\nlang_code=en\ntext_direction=ltr\ncontent_css=1\ncontent_css_custom=\nrelative_urls=0\nnewlines=0\ninvalid_elements=applet\nextended_elements=iframe[src\\|width\\|height\\|frameborder\\|scrolling\\|marginheight\\|marginwidth\\|name\\|align]\ntoolbar=top\ntoolbar_align=left\nhtml_height=550\nhtml_width=400\nelement_path=0\nfonts=1\npaste=1\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\ncolors=1\ntable=0\nsmilies=1\nmedia=1\nhr=1\ndirectionality=0\nfullscreen=1\nstyle=0\nlayer=0\nxhtmlxtras=0\nvisualchars=1\nnonbreaking=1\nblockquote=1\ntemplate=0\nadvimage=1\nadvlink=1\nautosave=0\ncontextmenu=1\ninlinepopups=1\nsafari=1\ncustom_plugin=\ncustom_button=\n\n'),(20,'Editor - XStandard Lite 2.0','xstandard','editors',0,0,0,1,0,0,'0000-00-00 00:00:00',''),(21,'Editor Button - Image','image','editors-xtd',2,0,1,0,0,0,'0000-00-00 00:00:00',''),(22,'Editor Button - Pagebreak','pagebreak','editors-xtd',2,0,1,0,0,0,'0000-00-00 00:00:00',''),(23,'Editor Button - Readmore','readmore','editors-xtd',1,0,1,0,0,0,'0000-00-00 00:00:00',''),(24,'XML-RPC - Joomla','joomla','xmlrpc',0,7,0,1,0,0,'0000-00-00 00:00:00',''),(25,'XML-RPC - Blogger API','blogger','xmlrpc',0,7,0,1,0,0,'0000-00-00 00:00:00','catid=1\nsectionid=0\n\n'),(27,'System - SEF','sef','system',0,1,1,0,0,0,'0000-00-00 00:00:00',''),(28,'System - Debug','debug','system',0,2,1,0,0,0,'0000-00-00 00:00:00','queries=1\nmemory=1\nlangauge=1\n\n'),(29,'System - Legacy','legacy','system',0,3,1,1,0,0,'0000-00-00 00:00:00','route=0\n\n'),(30,'System - Cache','cache','system',0,4,0,1,0,0,'0000-00-00 00:00:00','browsercache=1\ncachetime=15\n\n'),(31,'System - Log','log','system',0,5,0,1,0,0,'0000-00-00 00:00:00',''),(32,'System - Remember Me','remember','system',0,6,1,1,0,0,'0000-00-00 00:00:00',''),(33,'System - Backlink','backlink','system',0,7,0,1,0,0,'0000-00-00 00:00:00',''),(34,'System - Jfdatabase','jfdatabase','system',0,-100,1,0,0,0,'0000-00-00 00:00:00',''),(35,'System - Jfrouter','jfrouter','system',0,-101,1,0,0,0,'0000-00-00 00:00:00',''),(36,'Content - Jfalternative','jfalternative','content',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(37,'Search - Jfcategories','jfcategories','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(38,'Search - Jfcontacts','jfcontacts','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(39,'Search - Jfcontent','jfcontent','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(40,'Search - Jfnewsfeeds','jfnewsfeeds','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(41,'Search - Jfsections','jfsections','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(42,'Search - Jfweblinks','jfweblinks','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(43,'Joomfish - Missing_translation','missing_translation','joomfish',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(44,'DOCman Standard Buttons','standardbuttons','docman',0,1,1,1,0,0,'0000-00-00 00:00:00','download=1\nview=1\ndetails=1\nedit=1\nmove=1\ndelete=1\nupdate=1\nreset=1\ncheckout=1\napprove=1\npublish=1'),(45,'Button - Custom Properties Tags','cptags','editors-xtd',2,0,1,0,0,0,'0000-00-00 00:00:00',''),(46,'uddeIM PMS Content Link','uddeim_pms_contentlink','content',0,0,0,0,0,0,'0000-00-00 00:00:00',''),(47,'uddeIM Searchbot','uddeim.searchbot','search',0,0,0,0,0,0,'0000-00-00 00:00:00','search_limit=50\n'),(48,'Content - JComments','jcomments','content',0,10001,1,0,0,0,'0000-00-00 00:00:00',''),(49,'Search - JComments','jcomments','search',0,7,1,0,0,0,'0000-00-00 00:00:00',''),(50,'System - JComments','jcomments','system',0,8,1,0,0,0,'0000-00-00 00:00:00',''),(51,'Editor Button - JComments ON','jcommentson','editors-xtd',2,1,1,0,0,0,'0000-00-00 00:00:00',''),(52,'Editor Button - JComments OFF','jcommentsoff','editors-xtd',2,1,1,0,0,0,'0000-00-00 00:00:00',''),(53,'User - JComments','jcomments','user',0,1,1,0,0,0,'0000-00-00 00:00:00',''),(54,'Search - Mosets Tree','mtree','search',0,0,0,0,0,0,'0000-00-00 00:00:00','search_limit=50\nsearch_listing=1\n'),(55,'Custom Properties Tags Plugin','cptags','content',0,0,1,0,0,0,'0000-00-00 00:00:00','tag_in_meta=1\n'),(56,'Search - CP Tags','cptags','search',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(57,'Letterman searchbot','letterman.searchbot','search',0,0,0,0,0,0,'0000-00-00 00:00:00','search_limit=50\n'),(58,'Content - RokBox','rokbox','content',0,0,0,0,0,0,'0000-00-00 00:00:00','thumb_ext=_thumb\nthumb_class=album\nthumb_dir=cache\nthumb_width=150\nthumb_height=100\nthumb_quality=90\n'),(59,'Editor - RokPad','rokpad','editors',0,0,1,0,0,0,'0000-00-00 00:00:00','@spacer=<div id=\"parser-type\"   style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Parser Type</div>\nrokpad-parser=xhtmlmixed\nrokpad-tidylevel=XHTML 1.0 Transitional\nrokpad-show-formatter=1\n@spacer=<div id=\"editor-parameters\"   style=\"font-weight:normal;font-size:12px;color:#fff;padding:4px;margin:0;background:#666;\">Editor Parameters</div>\nrokpad-height=350\nrokpad-passdelay=200\nrokpad-passtime=50\nrokpad-linenumberdelay=200\nrokpad-linenumbertime=50\nrokpad-continuous=500\nrokpad-matchparens=1\nrokpad-history=50\nrokpad-history-delay=800\nrokpad-lineHandler=1\nrokpad-textwrapperHandler=1\nrokpad-indentunit=2\nrokpad-tabmode=indent\nrokpad-loadindent=1\n'),(60,'System - RokBox','rokbox','system',0,0,0,0,0,0,'0000-00-00 00:00:00','theme=light\ncustom-theme=sample\n'),(61,'System - RokGantry Cache','rokgantrycache','system',0,0,0,0,0,0,'0000-00-00 00:00:00',''),(62,'System - RokGZipper','rokgzipper','system',0,0,0,0,0,0,'0000-00-00 00:00:00','cache_time=900\nexpires_header_time=1440\nstrip_css=1\n'),(63,'System - RokCandy','rokcandy_system','system',0,0,1,1,0,0,'0000-00-00 00:00:00',''),(64,'Button - RokCandy','rokcandy_button','editors-xtd',2,0,0,1,0,0,'0000-00-00 00:00:00',''),(65,'RokNavMenu - Boost','boost','roknavmenu',0,0,1,1,0,0,'0000-00-00 00:00:00',''),(66,'RokNavMenu - Extended Link','extendedlink','roknavmenu',0,0,1,1,0,0,'0000-00-00 00:00:00',''),(70,'System - sh404sef','shsef','system',0,7,1,0,0,0,'0000-00-00 00:00:00',''),(71,'sh404sef offline code plugin','sh404sefofflinecode','sh404sefcore',0,10,1,0,0,0,'0000-00-00 00:00:00','plugin_element=sh404sefofflinecode\nplugin_folder=sh404sefcore\nplugin_event=onAfterDispatch\nplugin_functions=plgSh404sefofflinecode\nretry_after_delay=7400\n'),(72,'sh404sef similar urls plugin','sh404sefsimilarurls','sh404sefcore',0,10,1,0,0,0,'0000-00-00 00:00:00','plugin_element=sh404sefsimilarurls\nplugin_folder=sh404sefcore\nplugin_event=onPrepareContent\nplugin_functions=plgSh404sefsimilarurls\nmax_number_of_urls=5\nmin_segment_length=3\n'),(73,'Search DOCman','docman.searchbot','search',0,0,0,0,0,0,'0000-00-00 00:00:00','prefix=Download: \nhref=download\nsearch_name=1\nsearch_description=1\n');
/*!40000 ALTER TABLE `jos_plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_poll_data`
--

DROP TABLE IF EXISTS `jos_poll_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_poll_data`
--

LOCK TABLES `jos_poll_data` WRITE;
/*!40000 ALTER TABLE `jos_poll_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_poll_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_poll_date`
--

DROP TABLE IF EXISTS `jos_poll_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_poll_date`
--

LOCK TABLES `jos_poll_date` WRITE;
/*!40000 ALTER TABLE `jos_poll_date` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_poll_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_poll_menu`
--

DROP TABLE IF EXISTS `jos_poll_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_poll_menu`
--

LOCK TABLES `jos_poll_menu` WRITE;
/*!40000 ALTER TABLE `jos_poll_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_poll_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_polls`
--

DROP TABLE IF EXISTS `jos_polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_polls`
--

LOCK TABLES `jos_polls` WRITE;
/*!40000 ALTER TABLE `jos_polls` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollsxt`
--

DROP TABLE IF EXISTS `jos_pollsxt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollsxt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  `multivote` tinyint(1) DEFAULT '0',
  `rdisp` tinyint(1) NOT NULL DEFAULT '0',
  `rdispb` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rdispd` tinyint(1) NOT NULL DEFAULT '0',
  `intro` text NOT NULL,
  `thanks` text NOT NULL,
  `logon` tinyint(1) NOT NULL DEFAULT '0',
  `img_url` text,
  `imgsize` int(11) NOT NULL DEFAULT '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL DEFAULT '0',
  `css` varchar(20) NOT NULL DEFAULT 'poll_bars',
  `datefrom` date NOT NULL DEFAULT '0000-00-00',
  `dateto` date NOT NULL DEFAULT '0000-00-00',
  `timefrom` time NOT NULL,
  `timeto` time NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `sh_numvote` tinyint(1) NOT NULL DEFAULT '0',
  `sh_flvote` tinyint(1) NOT NULL DEFAULT '0',
  `sh_abs` tinyint(1) NOT NULL DEFAULT '0',
  `sh_perc` tinyint(1) NOT NULL DEFAULT '0',
  `email` tinyint(1) NOT NULL DEFAULT '0',
  `subject` varchar(80) NOT NULL DEFAULT '',
  `emailtext` text NOT NULL,
  `goto` tinyint(1) NOT NULL DEFAULT '0',
  `goto_url` varchar(100) NOT NULL DEFAULT '',
  `hidetitle` tinyint(1) NOT NULL,
  `mailres` tinyint(1) NOT NULL,
  `mailresrec` varchar(80) NOT NULL,
  `mailrestxt` varchar(255) NOT NULL,
  `rdispall` tinyint(1) NOT NULL,
  `wordwrap` char(4) NOT NULL,
  `category` int(11) NOT NULL,
  `rdispdw` tinyint(1) NOT NULL,
  `notvote` tinyint(1) NOT NULL,
  `notvoteerr` tinyint(1) NOT NULL,
  `vbtext` varchar(80) NOT NULL,
  `hide` tinyint(1) NOT NULL,
  `showvoters` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollsxt`
--

LOCK TABLES `jos_pollsxt` WRITE;
/*!40000 ALTER TABLE `jos_pollsxt` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_pollsxt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollsxt_options`
--

DROP TABLE IF EXISTS `jos_pollsxt_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollsxt_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quid` int(11) NOT NULL DEFAULT '0',
  `qoption` text NOT NULL,
  `img_url` text,
  `imgsize` int(11) NOT NULL DEFAULT '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL DEFAULT '0',
  `freetext` tinyint(1) NOT NULL DEFAULT '0',
  `newopt` tinyint(1) NOT NULL DEFAULT '0',
  `inact` tinyint(1) NOT NULL DEFAULT '0',
  `multicols` char(3) NOT NULL,
  `multirows` char(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollsxt_options`
--

LOCK TABLES `jos_pollsxt_options` WRITE;
/*!40000 ALTER TABLE `jos_pollsxt_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_pollsxt_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollsxt_questions`
--

DROP TABLE IF EXISTS `jos_pollsxt_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollsxt_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `img_url` text,
  `imgsize` int(11) NOT NULL DEFAULT '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL DEFAULT '0',
  `obli` tinyint(1) NOT NULL DEFAULT '0',
  `multisize` char(3) NOT NULL DEFAULT '',
  `inact` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `ratingval` varchar(80) NOT NULL,
  `ratingdesc` text NOT NULL,
  `random` tinyint(1) NOT NULL,
  `minvotes` tinyint(3) NOT NULL,
  `maxvotes` tinyint(3) NOT NULL,
  `style` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollsxt_questions`
--

LOCK TABLES `jos_pollsxt_questions` WRITE;
/*!40000 ALTER TABLE `jos_pollsxt_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_pollsxt_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollxt_config`
--

DROP TABLE IF EXISTS `jos_pollxt_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollxt_config` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `version` varchar(10) NOT NULL DEFAULT '',
  `xt_disp` tinyint(1) NOT NULL DEFAULT '0',
  `xt_hide` tinyint(1) NOT NULL DEFAULT '0',
  `xt_selpo` tinyint(1) NOT NULL DEFAULT '0',
  `xt_publ` tinyint(1) NOT NULL DEFAULT '0',
  `xt_order` tinyint(1) NOT NULL DEFAULT '0',
  `xt_imgvote` varchar(80) NOT NULL DEFAULT '',
  `xt_imgresult` varchar(80) NOT NULL DEFAULT '',
  `xt_maxcolors` tinyint(1) NOT NULL DEFAULT '0',
  `xt_height` tinyint(2) NOT NULL DEFAULT '0',
  `xt_orderby` varchar(10) NOT NULL DEFAULT '',
  `xt_asc` varchar(4) NOT NULL DEFAULT '',
  `xt_seccookie` tinyint(1) NOT NULL DEFAULT '0',
  `xt_secip` tinyint(1) NOT NULL DEFAULT '0',
  `xt_secuname` tinyint(1) NOT NULL DEFAULT '0',
  `resselpo` tinyint(1) NOT NULL,
  `imgpath` varchar(80) NOT NULL,
  `rdisp` tinyint(1) NOT NULL,
  `button_style` tinyint(1) NOT NULL,
  `debug` tinyint(1) NOT NULL,
  `imgdetail` varchar(80) NOT NULL,
  `imgback` varchar(80) NOT NULL,
  `compat` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollxt_config`
--

LOCK TABLES `jos_pollxt_config` WRITE;
/*!40000 ALTER TABLE `jos_pollxt_config` DISABLE KEYS */;
INSERT INTO `jos_pollxt_config` VALUES (1,'2.00.05',1,2,0,0,1,'','',5,5,'hits','ASC',1,1,1,0,'images/stories',1,0,0,'','','0');
/*!40000 ALTER TABLE `jos_pollxt_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollxt_data`
--

DROP TABLE IF EXISTS `jos_pollxt_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollxt_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `optid` int(11) NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `user` text NOT NULL,
  `datu` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `value` text,
  `mailkey` varchar(100) NOT NULL DEFAULT '',
  `block` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollxt_data`
--

LOCK TABLES `jos_pollxt_data` WRITE;
/*!40000 ALTER TABLE `jos_pollxt_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_pollxt_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollxt_menu`
--

DROP TABLE IF EXISTS `jos_pollxt_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollxt_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollxt_menu`
--

LOCK TABLES `jos_pollxt_menu` WRITE;
/*!40000 ALTER TABLE `jos_pollxt_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_pollxt_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_pollxt_plugins`
--

DROP TABLE IF EXISTS `jos_pollxt_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_pollxt_plugins` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `pollid` tinyint(11) NOT NULL,
  `plugin` varchar(40) NOT NULL,
  `param` varchar(40) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_pollxt_plugins`
--

LOCK TABLES `jos_pollxt_plugins` WRITE;
/*!40000 ALTER TABLE `jos_pollxt_plugins` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_pollxt_plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_redirection`
--

DROP TABLE IF EXISTS `jos_redirection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_redirection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpt` int(11) NOT NULL DEFAULT '0',
  `rank` int(11) NOT NULL DEFAULT '0',
  `oldurl` varchar(255) NOT NULL DEFAULT '',
  `newurl` varchar(255) NOT NULL DEFAULT '',
  `dateadd` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `newurl` (`newurl`),
  KEY `rank` (`rank`),
  KEY `oldurl` (`oldurl`)
) ENGINE=MyISAM AUTO_INCREMENT=659 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_redirection`
--

LOCK TABLES `jos_redirection` WRITE;
/*!40000 ALTER TABLE `jos_redirection` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_redirection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_rokcandy`
--

DROP TABLE IF EXISTS `jos_rokcandy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_rokcandy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `macro` text NOT NULL,
  `html` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_rokcandy`
--

LOCK TABLES `jos_rokcandy` WRITE;
/*!40000 ALTER TABLE `jos_rokcandy` DISABLE KEYS */;
INSERT INTO `jos_rokcandy` VALUES (20,509,'[code]{text}[/code]','<code>{text}</code>',1,0,'0000-00-00 00:00:00',7,''),(21,509,'[i]{text}[/i]','<em>{text}</em>',1,0,'0000-00-00 00:00:00',6,''),(22,509,'[b]{text}[/b]','<strong>{text}</strong>',1,0,'0000-00-00 00:00:00',5,''),(23,509,'[h4]{text}[/h4]','<h4>{text}</h4>',1,0,'0000-00-00 00:00:00',4,''),(24,509,'[h1]{text}[/h1]','<h1>{text}</h1>',1,0,'0000-00-00 00:00:00',1,''),(25,509,'[h2]{text}[/h2]','<h2>{text}</h2>',1,0,'0000-00-00 00:00:00',2,''),(26,509,'[h3]{text}[/h3]','<h3>{text}</h3>',1,0,'0000-00-00 00:00:00',3,''),(27,509,'[Create]{text}[/Create]','<div class=\"clr\"></div><div class=\"readon-wrap1\"><a class=\"readon-main\" href=\"http://ssodev.openfoundry.org/of/projects/new\"><span class=\"readon1-m\">{text}</span></a></div>',1,0,'0000-00-00 00:00:00',8,''),(28,509,'[Use]{text}[/Use]','<div class=\"clr\"></div><div class=\"readon-wrap1\"><a class=\"readon-main\" href=\"help/how-to-start\"><span class=\"readon1-m\">{text}</span></a></div>',1,0,'0000-00-00 00:00:00',9,''),(29,509,'[Beginner]{text}[/Beginner]','<div class=\"clr\"></div><div class=\"readon-wrap1\"><a class=\"readon-main\" href=\"beginner\"><span class=\"readon1-m\">{text}</span></a></div>',1,0,'0000-00-00 00:00:00',10,'');
/*!40000 ALTER TABLE `jos_rokcandy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sections`
--

DROP TABLE IF EXISTS `jos_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sections`
--

LOCK TABLES `jos_sections` WRITE;
/*!40000 ALTER TABLE `jos_sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefaliases`
--

DROP TABLE IF EXISTS `jos_sefaliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefaliases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `vars` text NOT NULL,
  `url` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefaliases`
--

LOCK TABLES `jos_sefaliases` WRITE;
/*!40000 ALTER TABLE `jos_sefaliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sefaliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefexts`
--

DROP TABLE IF EXISTS `jos_sefexts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefexts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  `filters` text,
  `params` text,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefexts`
--

LOCK TABLES `jos_sefexts` WRITE;
/*!40000 ALTER TABLE `jos_sefexts` DISABLE KEYS */;
INSERT INTO `jos_sefexts` VALUES (1,'com_wrapper.xml',NULL,'ignoreSource=0\nitemid=1\noverrideId=',NULL);
/*!40000 ALTER TABLE `jos_sefexts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefexttexts`
--

DROP TABLE IF EXISTS `jos_sefexttexts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefexttexts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefexttexts`
--

LOCK TABLES `jos_sefexttexts` WRITE;
/*!40000 ALTER TABLE `jos_sefexttexts` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sefexttexts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefmoved`
--

DROP TABLE IF EXISTS `jos_sefmoved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefmoved` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old` varchar(255) NOT NULL,
  `new` varchar(255) NOT NULL,
  `lastHit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `old` (`old`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefmoved`
--

LOCK TABLES `jos_sefmoved` WRITE;
/*!40000 ALTER TABLE `jos_sefmoved` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sefmoved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefurls`
--

DROP TABLE IF EXISTS `jos_sefurls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefurls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpt` int(11) NOT NULL DEFAULT '0',
  `sefurl` varchar(255) NOT NULL,
  `origurl` varchar(255) NOT NULL,
  `Itemid` varchar(20) DEFAULT NULL,
  `metadesc` varchar(255) DEFAULT '',
  `metakey` varchar(255) DEFAULT '',
  `metatitle` varchar(255) DEFAULT '',
  `metalang` varchar(30) DEFAULT '',
  `metarobots` varchar(30) DEFAULT '',
  `metagoogle` varchar(30) DEFAULT '',
  `canonicallink` varchar(255) DEFAULT '',
  `dateadd` date NOT NULL DEFAULT '0000-00-00',
  `priority` int(11) NOT NULL DEFAULT '0',
  `trace` text,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `sef` tinyint(1) NOT NULL DEFAULT '1',
  `sm_indexed` tinyint(1) NOT NULL DEFAULT '0',
  `sm_date` date NOT NULL DEFAULT '0000-00-00',
  `sm_frequency` varchar(20) NOT NULL DEFAULT 'weekly',
  `sm_priority` varchar(10) NOT NULL DEFAULT '0.5',
  PRIMARY KEY (`id`),
  KEY `sefurl` (`sefurl`),
  KEY `origurl` (`origurl`,`Itemid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefurls`
--

LOCK TABLES `jos_sefurls` WRITE;
/*!40000 ALTER TABLE `jos_sefurls` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sefurls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefurlword_xref`
--

DROP TABLE IF EXISTS `jos_sefurlword_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefurlword_xref` (
  `word` int(11) NOT NULL,
  `url` int(11) NOT NULL,
  PRIMARY KEY (`word`,`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefurlword_xref`
--

LOCK TABLES `jos_sefurlword_xref` WRITE;
/*!40000 ALTER TABLE `jos_sefurlword_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sefurlword_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sefwords`
--

DROP TABLE IF EXISTS `jos_sefwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sefwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sefwords`
--

LOCK TABLES `jos_sefwords` WRITE;
/*!40000 ALTER TABLE `jos_sefwords` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sefwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_session`
--

DROP TABLE IF EXISTS `jos_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_session`
--

LOCK TABLES `jos_session` WRITE;
/*!40000 ALTER TABLE `jos_session` DISABLE KEYS */;
INSERT INTO `jos_session` VALUES ('','1286963510','iinn1jpltbvbot0iguf36cscc2',1,0,'',0,0,NULL);
/*!40000 ALTER TABLE `jos_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sh404SEF_meta`
--

DROP TABLE IF EXISTS `jos_sh404SEF_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sh404SEF_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newurl` varchar(255) NOT NULL DEFAULT '',
  `metadesc` varchar(255) DEFAULT '',
  `metakey` varchar(255) DEFAULT '',
  `metatitle` varchar(255) DEFAULT '',
  `metalang` varchar(30) DEFAULT '',
  `metarobots` varchar(30) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `newurl` (`newurl`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sh404SEF_meta`
--

LOCK TABLES `jos_sh404SEF_meta` WRITE;
/*!40000 ALTER TABLE `jos_sh404SEF_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sh404SEF_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_sh404sef_aliases`
--

DROP TABLE IF EXISTS `jos_sh404sef_aliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_sh404sef_aliases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newurl` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `newurl` (`newurl`),
  KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_sh404sef_aliases`
--

LOCK TABLES `jos_sh404sef_aliases` WRITE;
/*!40000 ALTER TABLE `jos_sh404sef_aliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_sh404sef_aliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_stats_agents`
--

DROP TABLE IF EXISTS `jos_stats_agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_stats_agents`
--

LOCK TABLES `jos_stats_agents` WRITE;
/*!40000 ALTER TABLE `jos_stats_agents` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_stats_agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_templates_menu`
--

DROP TABLE IF EXISTS `jos_templates_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_templates_menu` (
  `template` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_templates_menu`
--

LOCK TABLES `jos_templates_menu` WRITE;
/*!40000 ALTER TABLE `jos_templates_menu` DISABLE KEYS */;
INSERT INTO `jos_templates_menu` VALUES ('rt_quantive_j15',0,0),('khepri',0,1);
/*!40000 ALTER TABLE `jos_templates_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim`
--

DROP TABLE IF EXISTS `jos_uddeim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `replyid` int(11) NOT NULL DEFAULT '0',
  `fromid` int(11) NOT NULL DEFAULT '0',
  `toid` int(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `datum` int(11) DEFAULT NULL,
  `toread` int(1) NOT NULL DEFAULT '0',
  `totrash` int(1) NOT NULL DEFAULT '0',
  `totrashdate` int(11) DEFAULT NULL,
  `totrashoutbox` int(1) NOT NULL DEFAULT '0',
  `totrashdateoutbox` int(11) DEFAULT NULL,
  `expires` int(11) NOT NULL DEFAULT '0',
  `disablereply` int(1) NOT NULL DEFAULT '0',
  `systemmessage` varchar(60) DEFAULT NULL,
  `archived` int(1) NOT NULL DEFAULT '0',
  `cryptmode` int(1) NOT NULL DEFAULT '0',
  `flagged` int(1) NOT NULL DEFAULT '0',
  `crypthash` varchar(32) DEFAULT NULL,
  `publicname` text,
  `publicemail` text,
  PRIMARY KEY (`id`),
  KEY `toid_toread` (`toid`,`toread`),
  KEY `fromid` (`fromid`),
  KEY `replyid` (`replyid`),
  KEY `datum` (`datum`),
  KEY `totrashdate` (`totrashdate`),
  KEY `totrashdateoutbox_datum` (`totrashdateoutbox`,`datum`),
  KEY `toread_totrash_datum` (`toread`,`totrash`,`datum`),
  KEY `totrash_totrashdate` (`totrash`,`totrashdate`),
  KEY `archived_totrash_toid_datum` (`archived`,`totrash`,`toid`,`datum`)
) ENGINE=MyISAM AUTO_INCREMENT=465 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim`
--

LOCK TABLES `jos_uddeim` WRITE;
/*!40000 ALTER TABLE `jos_uddeim` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_uddeim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim_attachments`
--

DROP TABLE IF EXISTS `jos_uddeim_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim_attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(1) NOT NULL DEFAULT '0',
  `tempname` text NOT NULL,
  `filename` text NOT NULL,
  `fileid` varchar(32) NOT NULL,
  `size` int(1) NOT NULL DEFAULT '0',
  `datum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `fileid` (`fileid`),
  KEY `datum` (`datum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim_attachments`
--

LOCK TABLES `jos_uddeim_attachments` WRITE;
/*!40000 ALTER TABLE `jos_uddeim_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_uddeim_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim_blocks`
--

DROP TABLE IF EXISTS `jos_uddeim_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blocker` int(11) NOT NULL DEFAULT '0',
  `blocked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim_blocks`
--

LOCK TABLES `jos_uddeim_blocks` WRITE;
/*!40000 ALTER TABLE `jos_uddeim_blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_uddeim_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim_config`
--

DROP TABLE IF EXISTS `jos_uddeim_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim_config` (
  `varname` tinytext NOT NULL,
  `value` tinytext NOT NULL,
  PRIMARY KEY (`varname`(30))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim_config`
--

LOCK TABLES `jos_uddeim_config` WRITE;
/*!40000 ALTER TABLE `jos_uddeim_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_uddeim_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim_emn`
--

DROP TABLE IF EXISTS `jos_uddeim_emn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim_emn` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `popup` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `remindersent` int(11) NOT NULL DEFAULT '0',
  `lastsent` int(11) NOT NULL DEFAULT '0',
  `autoresponder` int(1) NOT NULL DEFAULT '0',
  `autorespondertext` text NOT NULL,
  `autoforward` int(1) NOT NULL DEFAULT '0',
  `autoforwardid` int(1) NOT NULL DEFAULT '0',
  `locked` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=281 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim_emn`
--

LOCK TABLES `jos_uddeim_emn` WRITE;
/*!40000 ALTER TABLE `jos_uddeim_emn` DISABLE KEYS */;
INSERT INTO `jos_uddeim_emn` VALUES (1,62,1,0,0,1278585812,1242357081,0,'',0,0,0);
/*!40000 ALTER TABLE `jos_uddeim_emn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim_spam`
--

DROP TABLE IF EXISTS `jos_uddeim_spam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim_spam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL DEFAULT '0',
  `datum` int(11) DEFAULT NULL,
  `reported` int(11) DEFAULT NULL,
  `fromid` int(1) NOT NULL DEFAULT '0',
  `toid` int(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim_spam`
--

LOCK TABLES `jos_uddeim_spam` WRITE;
/*!40000 ALTER TABLE `jos_uddeim_spam` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_uddeim_spam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_uddeim_userlists`
--

DROP TABLE IF EXISTS `jos_uddeim_userlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_uddeim_userlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `userids` text NOT NULL,
  `global` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `global` (`global`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_uddeim_userlists`
--

LOCK TABLES `jos_uddeim_userlists` WRITE;
/*!40000 ALTER TABLE `jos_uddeim_userlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_uddeim_userlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_users`
--

DROP TABLE IF EXISTS `jos_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2483 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_users`
--

LOCK TABLES `jos_users` WRITE;
/*!40000 ALTER TABLE `jos_users` DISABLE KEYS */;
INSERT INTO `jos_users` VALUES (62,'admin','admin','please@input.youradminmail.com','f69bcea59a8a3277a842f5d4b6459a61:25snKCWP96rakkfQV6Xlv1xZCO8iQZS2','Super Administrator',0,1,25,'2008-07-07 17:36:15','2010-10-13 09:32:31','','admin_language=\nlanguage=zh-TW\neditor=tinymce\nhelpsite=\ntimezone=8\n\n');
/*!40000 ALTER TABLE `jos_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jos_weblinks`
--

DROP TABLE IF EXISTS `jos_weblinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_weblinks`
--

LOCK TABLES `jos_weblinks` WRITE;
/*!40000 ALTER TABLE `jos_weblinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `jos_weblinks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-10-13 17:52:56
