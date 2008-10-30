<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//===========================
// component version 2.0.10 =
//===========================
# general translations
define('_USR_CHC', 		'Users Choice');
define('_G2_FULLNAME', 	'Full Name');
define('_G2_USERNAME', 	'Username');
define('_G2_EMAIL', 	'E-mail');
define('_G2_PASSWORD', 	'Password');

# G2 PERMISSION ITEMS
define('_G2_PER_NONE', 		'No Access');
define('_G2_PER_ADMIN', 	'Admin Access');
define('_G2_PER_EDIT', 		'Edit item');
define('_G2_PER_DEL', 		'Delete item');
define('_G2_PER_ALBUM', 	'Add sub-album');
define('_G2_PER_ITEM', 		'Add sub-item');
define('_G2_PER_PER', 		'Change item permissions');

define('_G2_PER_VIEW', 		'View item');
define('_G2_PER_RESIZE', 	'View resized version(s)');
define('_G2_PER_SOURCE', 	'View original version');
define('_G2_PER_VIEWALL', 	'View all versions');

define('_G2_PER_COM_ALL', 	'All access');
define('_G2_PER_COM_DEL', 	'Delete comments');
define('_G2_PER_COM_EDIT', 	'Edit comments');
define('_G2_PER_COM_ADD', 	'Add comments');
define('_G2_PER_COM_VIEW', 	'View comments');


# user albums
define('_G2_DONT_HAVE',		'You dont have your own album, create one by clicking ');
define('_G2_HERE', 			'here.');
define('_G2_REMIND',		'Remind me again in:');
define('_G2_HOURS',			'2 hours');
define('_G2_DAY',			'1 day');
define('_G2_WEEK',			'1 week');
define('_G2_MONTH',			'1 month');
define('_G2_YEAR',			'1 year');

# admin back end
/* config page */
	/* config tab */
	define('_G2_HD_CONFIG', 	'Config Settings:');
	define('_G2_HD_SYNC', 		'Sync Settings:');
	define('_G2_FPATH', 		'Full Server Path to G2:');
	define('_G2_FPATH_SUM', 	'Full server path to G2. This will only be saved if correctly given!');
	define('_G2_GURI', 			'URL to G2:');
	define('_G2_GURI_SUM',		'URL to your Gallery2, example: http://www.example.com/gallery2/main.php');
	define('_G2_JPATH', 		'Path to Joomla:');
	define('_G2_JPATH_SUM', 	'Path to Joomla relative to web root (ex: / or /joomla ). No trailing slash!');
	define('_G2_EURL', 			'embedUri:');
	define('_G2_EURL_SUM', 		'This is generated and can be adjusted. If it is wrong adjust the settings for \"Path to Joomla\" and \"Relative Path to Gallery2\".');
	define('_G2_LOG_RED', 		'Login Page Redirect:');
	define('_G2_LOG_RED_SUM', 	'Where to redirect to if the user has no access. (ex: / or /index.php)');
	define('_G2_SIDEBAR', 		'Display G2 Sidebar:');
	define('_G2_SIDEBAR_SUM',	"Display G2's sidebar in the main content area?");
	define('_G2_LOGIN', 		'Display G2 Login:');
	define('_G2_LOGIN_SUM', 	"Display G2's login?");
	define('_G2_MRRR_USER',		'Use Mirrored User Logins:');
	define('_G2_MRRR_USER_SUM', "Mirrors Joomla user list in G2 as required. Turning off the \"Display G2's Login\" option is recommended if this feature is used.");
	define('_G2_USER_SCRIPT', 	'Run User Setup Script:');
	define('_G2_USER_SCRIPT_SUM', 'You should run this if you want to use the Mirrored User Logins option. The user you are currently logged in as will be set as the G2 admin, so make sure you\'re logged in as the right person! When done it will change back to No.');
	define('_G2_CHCK_LEVEL', 	'User Checking Level:');
	define('_G2_CHCK_LEVEL_SUM','Select which must be checked when syncing users, all above the selection is checked.');
	define('_G2_CHCK_CASE', 	'User Check Case Sensitive:');
	define('_G2_CHCK_CASE_SUM', 'Will the check be case sensitive or not?');
	define('_G2_USER_SYNC', 	'Sync G2 Users:');
	define('_G2_USER_SYNC_SUM', 'If set to yes, the NEXT user sync will also import G2 users into Joomla. When done it will change back to No.');
	define('_G2_GROUP_SYNC', 	'Recursive User Sync:');
	define('_G2_GROUP_SYNC_SUM','Should user with higher permission also be included in lower groups? If set to NO user will be synced to highest Joomla group.');
	
	/* cache tab */
	define('_G2_CCH_TLL', 'Cache Time to Life:');
	define('_G2_CCH_L', 'Long:');
	define('_G2_CCH_S', 'Short:');
	define('_G2_CCH_FILE', 'File Cache:');
	define('_G2_CCH_DB', 'Database Cache:');
	define('_G2_CCH_EXP', 'Set the time in seconds, don\'t change unless you know what you are doing!');
	define('_G2_CCH_CCS', 'Cache Clean Settings:');
	define('_G2_CCH_OC', 'Obsolete Cache:');
	define('_G2_CCH_OC_SUM', 'Number of seconds until "lastChanged" items are deemed obsolete.');
	define('_G2_CCH_CC', 'Clean Cache Period:');
	define('_G2_CCH_CC_SUM', 'Number of seconds until the Cache is cleaned.');
		
	/* user album creation tab */
	define('_G2_USR_SET', 			'User Album Settings:');
	define('_G2_USR_ENABLE', 		'Enable Auto-Album creation:');	
	define('_G2_USR_ENABLE_SUM', 	'Enables automatic album creation for registered users. Has no effect if the "Mirror user logins" option is not enabled.');
	define('_G2_USR_PLACE', 		'Location for User Albums:');
	define('_G2_USR_PLACE_SUM',		'Select the location where the user albums will be made, when using above option.');
	define('_G2_USR_CR_SET', 		'Creation Settings:');
	define('_G2_USR_NAME_PRE',		'Album Name Prefix:');
	define('_G2_USR_NAME_PRE_SUM',	"Prefix before album name. Shouldn't be needed as usernames are unique in gallery.");
	define('_G2_USR_TITLE', 		'Title of Album:');
	define('_G2_USR_TITLE_SUM',		'Title of the user Album.');
	define('_G2_USR_SUMMARY', 		'Summary:');
	define('_G2_USR_SUMMART_SUM',	'Summary of the user Album.');
	define('_G2_USR_KEY', 			'Keywords of Album:');
	define('_G2_USR_KEY_SUM', 		'Keywords of the user Album.');
	define('_G2_USR_DESC', 			'Description of Album:');
	define('_G2_USR_DESC_SUM',		'Description of the user Album.');
	define('_G2_USR_PER',			'Permission Settings:');
	define('_G2_USR_GNAME', 		'Groupname:');
	define('_G2_USR_JOOMLA', 		'Joomla Groups:');
	define('_G2_USR_VIEW', 			'View Size:');
	define('_G2_USR_VIEW_SUM', 		'TODO users may view up to this size.');
	define('_G2_USR_COMMENT', 		'Comment Settings:');
	define('_G2_USR_COMMENT_SUM', 	'TODO Comment settings.');
	define('_G2_USR_EXTRA', 		'Extra Settings:');
	define('_G2_USR_EXTRA_SUM', 	'TODO extra settings.');
	define('_G2_USR_OWNER', 		'Owner permissions:');
	define('_G2_USR_OWNER_SUM',		'TODO Owner Permissions');
	
	/* Cronjob tab */
	define('_G2_CRONJOB_SET',		'Cronjob settings.');
	define('_G2_CRONJOB',			'Cronjob:');
	define('_G2_GSM_SET',			'Google Sitemap settings.');
	define('_G2_GSM_NAME',			'Filename');
	define('_G2_GSM_NAME_SUM',		'Filename for your album xml file.');
	define('_G2_GSM_CHECK',			'Warnings:');
	define('_G2_GSM_WARN',			"File doesn't exists.");
	define('_G2_GSM_AUTO',			'Auto Generate File.');
	define('_G2_GSM_AUTO_SUM',		"If you have a large gallery with a lot of albums don't use this function");

/* album manager */

/* user manager */


//==========================
// modules                 =
//==========================

//==========================
// CB Plugin               =
//==========================
	define('_G2BRIDGE_NOIMAGES',		'This user has no images!');
	define('_G2BRIDGE_GALLERYNOTINSTALLED', 'Gallery2 Bridge component is not installed.  Please contact your site administrator.');
	define('_G2BRIDGE_SORTLAST',		'Last Added Images');
	define('_G2BRIDGE_SORTVIEWS',		'MostViewed Images');
	define('_G2BRIDGE_SORTALBUM',		'Latest Added Albums');
?>