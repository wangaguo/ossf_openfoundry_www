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
define('_JOOMFISH_RELATED_TOPICS','相关主题');
define('_JOOMFISH_HELP','Joom!Fish 对于网站的协助, 后记');
define('_JOOMFISH_MENU_DOC','协助 & 如何使用 (使用说明)');
define('_JOOMFISH_DOCANDTUTORY','说明 & 线上教学');
define('_JOOMFISH_PROJECT_DOC_SITE','专案说明网站');
define('_JOOMFISH_INSTALLATION','安装注释 (读我档)');
define('_JOOMFISH_CHANGELOG','修改纪录');
define('_JOOMFISH_OFFICIAL_PROJECT_WEBSITE','官方网站');
define('_JOOMFISH_OFFICIAL_PROJECT_FORUM','官方讨论');
define('_JOOMFISH_BUHTRACKER','臭虫追踪');
define('_JOOMFISH_LICENSE','许可证');
define('_JOOMFISH_THINK_NETWORK','针对网路上开放原码程式许可');
define('_JOOMFISH_ADDITIONAL_SITES','其他网站');
define('_JOOMFISH_README','读我档');
define('_JOOMFISH_PRESENT','向所有使用 Joom!Fish 的人! 介绍开发团队人员');
define('_JOOMFISH_LOGODESIGN','Joom!Fish 商标设计由');
define('_JOOMFISH_SPECIAL_THANKS','特别地感谢协助测试, 提议及翻译的');
// @Add By AlienChen End

define('_JOOMFISH_TITLE', 'Joom!Fish');															// @since 1.7
define('_JOOMFISH_HEADER','多国语言内容管理');							// @since 1.7

// Control panel
define('_JOOMFISH_ADMIN_FRONTEND', '前台');
define('_JOOMFISH_ADMIN_LANGUAGES', '语言');
define('_JOOMFISH_ADMIN_HELP', '协助 &amp; 如何使用');											// @since 1.7
define('_JOOMFISH_ADMIN_CPANEL', '控制台');														// @since 1.7
define('_JOOMFISH_ADMIN_CHECK', '检察元件');												// @since 1.7
define('_JOOMFISH_ADMIN_CONFIGURATION', '环境设置');										// @since 1.7
define('_JOOMFISH_ADMIN_CREDITS', '关于 Joom!Fish');													// @since 1.7
define('_JOOMFISH_E_STATE', '状态');															// @since 1.7
define('_JOOMFISH_ADMIN_COMPONENT_STATE', '元件状态');									// @since 1.7
define('_JOOMFISH_ADMIN_TRANSLATION_STATE', '翻译状态');								// @since 1.7
define('_JOOMFISH_ADMIN_SYSTEM_BOT_STATE', '系统自动化状态');									// @since 1.7
define('_JOOMFISH_ADMIN_SEARCH_BOT_STATE', '搜寻自动化状态');									// @since 1.7
define('_JOOMFISH_ADMIN_MODULE_STATE', '模组状态');											// @since 1.7
define('_JOOMFISH_CMN_PUBLISHED', '<span style="font-weight:bold; color:green">发布</span>' );											// @since 1.7
define('_JOOMFISH_CMN_UNPUBLISHED', '<span style="font-weight:bold; color:red">停止发布</span>' );										// @since 1.7
define('_JOOMFISH_ADMIN_MAMBELFISH_INSTALL', 'MambelFish 安装');																	// @since 1.7
define('_JOOMFISH_ADMIN_INSTAL_UPGRADED', '<span style="font-weight:bold; color:green">旧版安装升级</span>');					// @since 1.7
define('_JOOMFISH_ADMIN_INSTAL_NOT_UPGRADED', '<span style="font-weight:bold; color:red">旧版安装没有升级</span>');			// @since 1.7
define('_JOOMFISH_INSTALL_UPGRADE', '安装升级');																				// @since 1.7

define('_JOOMFISH_ADMIN_LANGUAGE_TITLE','Joom!Fish 语言管理');							// @since 1.7
define('_JOOMFISH_ADMIN_DEFAULT_LANGUAGE', '网站预设语言:');
define('_JOOMFISH_ADMIN_DEFAULT_LANGUAGE_HELP', '语言的设置在您的 <a href="javascript:submitbutton( \'site_config\' );">全站设定</a>.');

define('_JOOMFISH_ADMIN_SELECT_LANGUAGES', '选择您的网站所使用的语言.');
define('_JOOMFISH_ADMIN_LANGUAGE', '选择网站语言:');
define('_JOOMFISH_ADMIN_LANGUAGE_HELP', '请命名以及执行您目前网站中所要使用的语言.<br>名称将会在前台中显示.');

define('_JOOMFISH_ADMIN_TITLE_NAME', '名称');
define('_JOOMFISH_ADMIN_TITLE_AUTHOR', '作者');
define('_JOOMFISH_ADMIN_TITLE_VERSION', '版本');
define('_JOOMFISH_ADMIN_TITLE_DESCRIPTION', '叙述');
define('_JOOMFISH_ADMIN_TITLE_TITLE', '原始标题');
define('_JOOMFISH_ADMIN_TITLE_LANGUAGE', '语言管理');
define('_JOOMFISH_ADMIN_TITLE_TRANSLATION', '内容翻译管理');
define('_JOOMFISH_ADMIN_TITLE_DATECHANGED', '上次修改');
define('_JOOMFISH_ADMIN_TITLE_STATE', '状态');
define('_JOOMFISH_ADMIN_TITLE_PUBLISHED', '发布');
define('_JOOMFISH_ADMIN_TITLE_CONTENTELEMENTS', '检视内容元素');
define('_JOOMFISH_ADMIN_TITLE_DISPLAY', '显示数');

define('_JOOMFISH_ADMIN_TITLE_ACTIVE', '执行');
define('_JOOMFISH_ADMIN_TITLE_ISO', 'ISO');
define('_JOOMFISH_ADMIN_TITLE_JOOMLA', 'Joomla 语言名称');
define('_JOOMFISH_ADMIN_TITLE_IMAGE', '国别旗帜图示名称');											//new 1.1
define('_JOOMFISH_ADMIN_TITLE_ORDER', '排序');													//new 1.1

define('_JOOMFISH_ADMIN_ELEMENT_CONFIG', '设置');
define('_JOOMFISH_ADMIN_ELEMENT_REFERENCE', '资料库数据');
define('_JOOMFISH_ADMIN_ELEMENT_SAMPLES', '资料库内容');
define('_JOOMFISH_ADMIN_COMMONINFORMATION', '一般资讯');

define('_JOOMFISH_ADMIN_DATABASEINFORMATION', '关于资料表的资讯');
define('_JOOMFISH_ADMIN_DATABASETABLE', '资料表');
define('_JOOMFISH_ADMIN_DATABASETABLE_HELP', '于您的资料库资料中的范例参考 (不含前缀字!)');

define('_JOOMFISH_ADMIN_DATABASEFIELDS', '资料库栏位');
define('_JOOMFISH_ADMIN_DATABASEFIELDS_HELP', '相关的栏位定义于您的资料库中.');
define('_JOOMFISH_ADMIN_DBFIELDNAME', '名称');
define('_JOOMFISH_ADMIN_DBFIELDTYPE', '类型');
define('_JOOMFISH_ADMIN_DBFIELDLABLE', '栏位');
define('_JOOMFISH_ADMIN_TRANSLATE', '翻译');

define('_JOOMFISH_SET_DEFAULTTEXT', '设置预设本文');												// new 1.5
define('_JOOMFISH_SET_COMPLETE', '设置完成');														// new 1.5
define('_JOOMFISH_SELECT_LANGUAGES', '所有语言');
define('_JOOMFISH_SELECT_NOTRANSLATION', '未经翻译');
define('_JOOMFISH_NOTRANSLATIONYET', '(未经翻译)');
define('_JOOMFISH_SELECT_ELEMENTS', '请选择');
define('_JOOMFISH_NOELEMENT_SELECTED', '请选择你所要进行翻译的内容元素类型.');

define('_JOOMFISH_ORIGINAL', '原始');
define('_JOOMFISH_TRANSLATION', '翻译');
define('_JOOMFISH_ITEM_INFO', '发布');
define('_JOOMFISH_STATE_NOTEXISTING', '没有译本的存在');
define('_JOOMFISH_STATE_CHANGED', '原始内容已变更');
define('_JOOMFISH_STATE_OK', '翻译状态正常');

define('_JOOMFISH_COPY', '复制');
define('_JOOMFISH_CLEAR', '清除');
define('_JOOMFISH_TRANSLATION_UPTODATE', '翻译内容 <u>完成</u>');
define('_JOOMFISH_TRANSLATION_INCOMPLETE', '翻译内容 <u>不完整</u> 或原始内容 <u>已变更</u>');
define('_JOOMFISH_TRANSLATION_NOT_EXISTING', '翻译内容 <u>不存在</u>');
define('_JOOMFISH_TRANSLATION_PUBLISHED', '翻译内容 <u>发布</u> 至前台');
define('_JOOMFISH_TRANSLATION_NOT_PUBLISHED', '翻译内容 <u>停止发布</u>');
define('_JOOMFISH_STATE_TOGGLE', '(点击图示变更为<u>停止发布状态</u>.)');

define('_JOOMFISH_DBERR_NO_LANGUAGE', '您必须选择一种语言');
define('_JOOMFISH_CONFIG_SAVED', '设定已储存.');																// New 1.1
define('_JOOMFISH_CONFIG_PROBLEMS', '储存设置时有问题!');		// New 1.1
define('_JOOMFISH_LANG_PROBLEMS', '语言资讯仍有问题存在!');		// New 1.1

define ('_JOOMFISH_ADMIN_CATEGORY','分类过滤');													// New 1.7
define ('_JOOMFISH_ADMIN_CATEGORY_ALL','所有分类');												// New 1.7
define ('_JOOMFISH_ADMIN_AUTHOR','作者过滤');														// New 1.7
define ('_JOOMFISH_ADMIN_AUTHOR_ALL','所有作者');													// New 1.7
define ('_JOOMFISH_ADMIN_KEYWORD','关键字过滤');													// New 1.7
define ('_JOOMFISH_ADMIN_TRANSLATION_PUBLISHED','翻译发布');								// New 1.7
define ('_JOOMFISH_ADMIN_MENUTYPE','选单过滤');														// New 1.7
define ('_JOOMFISH_ADMIN_MENUTYPE_ALL','所有选单');													// New 1.7
define ('_JOOMFISH_ADMIN_BOTH','全部显示');
define ('_JOOMFISH_ADMIN_PUBLISHED','发布');
define ('_JOOMFISH_ADMIN_UNPUBLISHED','停止发布');

define ('_JOOMFISH_ADMIN_CLIPBOARD_COPIED','原始的内容已经复制到剪贴簿(HTML 格式).\n现在请使用 Ctrl + V 贴于编辑器中上');
define ('_JOOMFISH_ADMIN_CLIPBOARD_COPY','按下 Ctrl + C (PC 使用者)或者 command+C (MAC 使用者) 来复制原始的内容到剪贴簿.\n刚贴上时将为 HTML 格式');
define ('_JOOMFISH_ADMIN_CLIPBOARD_NOSUPPORT','您的浏览器没有支援复制到剪贴簿的功能.\n选择以手动方式将原始的内容复制和贴上');     // New 1.7

define( '_JOOMFISH_NO_TRANSLATION_AVALIABLE', '没有译本可供使用, 请选择其他的语言.');		// Changed 1.7

//tooltips
define ('_JOOMFISH_TT_TITLE_NAME','显示语言名称');
define ('_JOOMFISH_TT_TITLE_ISO','<strong>Offcial ISO codes of the language, best use browser definitions.</strong>');
define ('_JOOMFISH_TT_IMAGES_DIR','保持国别图示为空白. 为所属国别图示填入所对应您存放国别图示的目录颊相对路径位置.');
define ('_JOOMFISH_TT_TITLE_ORDER','显示于前台的排序.');
define ('_JOOMFISH_TT_TRANS_DEFAULT','使用自订的固定文字. 使用于模组中显示切换语言的讯息资讯, 如留白将使用语言档案中 <strong>_JOOMFISH_NO_TRANSLATION_AVAILABLE</strong> 当中定义的内容来显示.');
define ('_JOOMFISH_TT_SPACER','Spacer for displaying language selector in textmode when in horizontal mode.<br /><strong>Hint</strong>: If nothing is filled here in, but horizontal mode is selected, usually a spacer will be defined by Joomla as: | (with space before and after).<br />Space before and after will be used always.');

// errors
define ('_JOOMFISH_ERROR','错误:');
define ('_JOOMFISH_EDITED_BY_ANOTHER_ADMIN','内容项目 [ %s ] 目前已经有其他的管理者进行编辑中'); // %s=$actContentObject->title
define ('_JOOMFISH_CONFIG_WRITE_ERROR','设置档案无法被写入!');
define ('_JOOMFISH_ADMIN_MAMBOT_ERROR','多国语言抽象层自动化没有安装或发布 - Joomfish 将无法在这样的状态下运作!');

// preferences
define ('_JOOMFISH_ADMIN_PREF_TITLE','Joom!Fish 元件偏好设定');								// @since 1.7
define ('_JOOMFISH_ADMIN_ACCESS_PREFERENCES','存取偏好设定');										// @since 1.7
define ('_JOOMFISH_FRONTEND_PUBLISH','于前台发布?');											// @since 1.7
define ('_JOOMFISH_ADMIN_PUBLISHERS','Publishers 以上的存取层级');											// @since 1.7
define ('_JOOMFISH_ADMIN_NOONE','没有人');																// @since 1.7
define ('_JOOMFISH_ADMIN_FEPUBLISH_HELP','谁可以直接发布翻译的内容于前台?');	// @since 1.7

define('_JOOMFISH_ADMIN_COMPONENT_CONFIGURATION', '元件设置');							// @since 1.7
define('_JOOMFISH_ADMIN_COMPONENT_CONFIGURATION_HELP', 'Joom!Fish 元件管理使用的语言介面');		// @since 1.7
define('_JOOMFISH_ADMIN_COMPONENT_LANGUAGE', '语言管理');								// @since 1.7
define('_JOOMFISH_ADMIN_SHOWIF', '当无提供译本进行翻译时 ...');
define('_JOOMFISH_ADMIN_NOTRANSLATION', '无译本所要显示的资讯?');
define('_JOOMFISH_ADMIN_NOTRANSLATION_HELP', '这里的设定仅应用于当选取的类型为内容资料时!');
define('_JOOMFISH_ADMIN_ORIGINAL_CONTENT', '原始内容');
define('_JOOMFISH_ADMIN_ORIGINAL_WITH_INFO', '原始内容以及无译本说明');

define('_JOOMFISH_ADMIN_PLACEHOLDER', '无译本说明文字');													// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_VIEW', '前台显示');											// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_LIST', '连结列表 (水平)');										// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_COMBO', 'ComboBox');													// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_IMAGE', '图片列表 (水平)');									// @deprcated from 1.7
define('_JOOMFISH_ADMIN_FRONTEND_HELP', 'Please define how the component should be displayed in the frontend<br>When you select &quot;Image List&quot;, the image path must be empty or valid based on the Joomla root dir.');							// @deprcated from 1.7

define ('_JOOMFISH_ADMIN_TITLE_UNPUBLISHED', '停止发布');
define ('_JOOMFISH_NAME_MISSING','您必须输入一个名称');
define ('_JOOMFISH_ENTER_CORR_JOOMLA_NAME','您必须输入一个对应于 Joomla 中的名称');
define ('_JOOMFISH_LANG_ALREADY_EXISTS','已经有一向语言已经和 Joomla 中的名称相符, 请重试一次');
define ('_JOOMFISH_ADMIN_FRONTEND_VLIST', '名称列表 (垂直)');
define ('_JOOMFISH_ADMIN_FRONTEND_VIMAGE', '图示列表 (垂直)');
define ('_JOOMFISH_SPACER','文字中显示的间隔符号');

// upgrade
define('_JOOMFISH_UPGRADE', '更新');																	// @since 1.7
define('_JOOMFISH_ADMIN_UPGRADE_INFO', '由 MambelFish 升级至 Joom!Fish, 必须 <span style="font-weight:bold; color:red">删除</span> 所有存在的翻译内容以及您属于 Joom!Fish 的资料表!<br />您需要事行确定!');										// @since 1.7
define('_JOOMFISH_UPGRADE_BACKUP_TABLES', '备份 Joom!Fish 资料表?');									// @since 1.7
define('_JOOMFISH_UPGRADE_DELETE_TABLES', '确认删除 Joom!Fish 资料表');						// @since 1.7
define('_JOOMFISH_UPGRADE_RENAME_TABLES', '于更新前先将旧的资料表进行更名?');							// @since 1.7
define('_JOOMFISH_UPGRADE_ERROR_CONFIRM', '<span style="font-weight:bold; color:red">您需要先行确认, 实际的资料表将被删除!</span>');							// @since 1.7
define('_JOOMFISH_UPGRADE_ERROR_UPGRADE', '升级的过程发生错误, 请检视纪录以及详细的资讯');							// @since 1.7

define('_JOOMFISH_UPGRADE_SUCCESSFUL', '<span style="font-weight:bold; color:green">升级成功</span>');											// @since 1.7
define('_JOOMFISH_UPGRADE_FAILURE', '<span style="font-weight:bold; color:red">升级失败</span>');													// @since 1.7

define('_JOOMFISH_MBFBOT', 'Mambelfish 自动化');															// @since 1.7
define('_JOOMFISH_MBFMODULE', 'Mambelfish 模组');														// @since 1.7
define('_JOOMFISH_MBF_UNPUBLISHED', '<span style="font-weight:bold; color:green">停止发布</span>' );											// @since 1.7
define('_JOOMFISH_MBF_NOTUNPUBLISHED', '<span style="font-weight:bold; color:red">无法停止发布!</span>' );							// @since 1.7

define('_JOOMFISH_CONTENT_BACKUP', 'Joom!Fish tables backup');											// @since 1.7
define('_JOOMFISH_BAK_CONTENT_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地写入 #__jf_content_bak 资料表</span>' );											// @since 1.7
define('_JOOMFISH_BAK_CONTENT_FAILURE', '<span style="font-weight:bold; color:red">建立备份的 #__jf_content_bak 资料表失败</span>' );			// @since 1.7
define('_JOOMFISH_BAK_LANGUAGES_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地写入 #__jf_languages_bak 资料表</span>' );											// @since 1.7
define('_JOOMFISH_BAK_LANGUAGES_FAILURE', '<span style="font-weight:bold; color:red">建立备份的 #__jf_languages_bak 资料表失败</span>' );			// @since 1.7

define('_JOOMFISH_CONTENT_TABLES', 'Joom!Fish 内容资料表');											// @since 1.7
define('_JOOMFISH_LANGUAGE_TABLES', 'Joom!Fish 语言资料表');											// @since 1.7
define('_JOOMFISH_DEL_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地删除</span>' );											// @since 1.7
define('_JOOMFISH_DEL_FAILURE', '<span style="font-weight:bold; color:red">删除实际的 Joom!Fish 资料表失败</span>' );					// @since 1.7
define('_JOOMFISH_COPY_SUCESSFUL', '<span style="font-weight:bold; color:green">成功地复制</span>' );											// @since 1.7
define('_JOOMFISH_COPY_FAILURE', '<span style="font-weight:bold; color:red">删除实际的 Joom!Fish 资料表失败</span>' );					// @since 1.7

// credits
define('_JOOMFISH_CREDITS','后记');								// @since 1.7

define( "_JF_LANG_INCLUDED", true );
}
?>