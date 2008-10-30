<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $mosConfig_absolute_path;
// ensure user has access to this function
if (!($acl->acl_check('administration', 'edit', 'users', $my->usertype, 'components', 'all') | $acl->acl_check('administration', 'edit', 'users', $my->usertype, 'components', 'com_gallery2'))) {
    mosRedirect('index2.php', _NOT_AUTH);
}

require_once($mainframe->getPath('admin_html'));

$act = mosGetParam($_REQUEST, 'act', null);
$task = mosGetParam($_REQUEST, 'task', array(0));
$cid = mosGetParam($_POST, 'cid', array(0));
//replace the 2 lines below
$userId = mosGetParam($_GET, 'id', null);
$albumId = mosGetParam($_REQUEST, 'albumId', null);

if (!is_array( $cid )) {
    $cid = array(0);
}
/*
 * Load classes
 */
define('inAdmin', 1);
require_once("../components/com_gallery2/init.inc" );
global $g2Config, $option, $return, $param;
if(!file_exists($g2Config['path'])){
	$act = 'conf';	
}

switch($act) {
	case 'conf':
		include_once(BaseAdminUrl.'/adminpages/config.php' );
		switch ($task) {
			case 'save':
				saveSettings($option, $act);
			break;
			case 'sitemap':
				core::classRequireOnce('siteMap');
				siteMap::buildXML(true);
				mosRedirect('index2.php?option=com_gallery2&act=conf', 'Sitemap Created.');
			break;
			case 'sitestats':
					core::classRequireOnce('serverapi');
					$options = serverapi::getDefaultData();
					$url = 'http://opensource.4theweb.nl/curl/main.php';
					$object = new serverapi($url, $options);
					$object->sendStats();
					$database->setQuery("UPDATE `#__gallery2` SET `value` = '$time' WHERE `key`='curlRun'");
					$database->query();
				mosRedirect('index2.php?option=com_gallery2&act=conf', 'Site Statistics Send.');
			break;
			case 'Cache':
				g2cache::removeCache('cache');
				/* fall through to config settings */
			default:
				viewSettings($option, $act, $task);
			break;
		}
	break;
	case 'user':
		//check if user are mirrored?
		if(empty($g2Config['mirrorUsers'])){
			mosRedirect( "index2.php?option=com_gallery2&act=conf", 'You have to set User Mirror to use this Function');			
		}
		include_once(BaseAdminUrl.'/adminpages/user.manager.php' );
		switch($task) {
			case 'user_edit':
				showUsersDetail($option, $act, $task, $userId);
			break;
			case 'syncUsers':
				include_once(BaseAdminUrl.'/adminpages/tools.php' );
				syncUsers(false);
			break;
			case 'syncGroups':
				include_once(BaseAdminUrl.'/adminpages/tools.php' );
				syncGroup(false);
			break;
			case 'save':
				saveUser();
			break;
			default:
				showUsers( $option, $act, $task );
			break;
		}
	break;
	case 'album':
		//check if user are mirrored?
		if(empty($g2Config['mirrorUsers'])){
			mosRedirect( "index2.php?option=com_gallery2&act=conf", 'You have to set User Mirror to use this Function');			
		}
		include_once(BaseAdminUrl.'/adminpages/album.manager.php' );
		switch($task) {
			case "save":
				savealbum($option, $act, $task, $albumId, $param);
			break;
			case "album_spec":
				showalbum($option, $act, $task, $albumId);
			break;
			default:
				showalbumtree($option, $act, $task);
			break;
		}
	break;
	case 'ext':
		include_once(BaseAdminUrl.'/adminpages/extension.manager.php' );
	break;
	default:
		global $anchor;
		if(empty($anchor)){ $anchor = null;}
		showHelp( $option, $act, $task, $anchor );
	break;
}

/* help page */
function showHelp( $option, $act, $task, $anchor ){
	HTML_content::showHelp( $option, $act, $task, $anchor );
}//end help page

?>