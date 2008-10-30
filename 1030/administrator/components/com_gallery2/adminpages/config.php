<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
 * 
 */
require_once(BaseAdminUrl.'/adminpages/config.html.php');
/* Displays Gallery component settings */
function viewSettings( $option, $act, $task ) {
    global $acl, $g2Config, $g2Cache;
	$loadAll = file_exists($g2Config['path'].'embed.php') ? true : false;
	$params = array();
	$params['versionCheck'] = '';
    $params['displaysidebar'] = mosHTML::yesnoSelectList('displaysidebar', 'class="inputbox" size="1"', $g2Config['displaysidebar']);
    $params['displaylogin'] = mosHTML::yesnoSelectList('displaylogin', 'class="inputbox" size="1"', $g2Config['displaylogin']);
    $params['mirrorUsers'] = mosHTML::yesnoSelectList('mirrorUsers', 'class="inputbox" size="1"', $g2Config['mirrorUsers']);
    $params['userSetup'] = mosHTML::yesnoSelectList('userSetup', 'class="inputbox" size="1"', 0);
    $params['enableAlbumCreation'] = mosHTML::yesnoSelectList('enableAlbumCreation', 'class="inputbox" size="1"', $g2Config['enableAlbumCreation']);
	$params['g2ToJoomla'] = mosHTML::yesnoSelectList('g2ToJoomla', 'class="inputbox" size="1"', $g2Config['g2ToJoomla']);
    $params['userGroupRecursive'] = mosHTML::yesnoSelectList('userGroupRecursive', 'class="inputbox" size="1"', $g2Config['userGroupRecursive']);
    $params['sendStats'] = mosHTML::yesnoSelectList('sendStats', 'class="inputbox" size="1"', $g2Config['sendStats']);
	/* make option for user check params */
	$select = array();
	$select[] = mosHTML::makeOption(base64_encode(serialize(array('byUserName' => true))), _G2_USERNAME);
	$select[] = mosHTML::makeOption(base64_encode(serialize(array('byUserName' => true, 'byEmail' => true))), _G2_EMAIL);
	$select[] = mosHTML::makeOption(base64_encode(serialize(array('byUserName' => true, 'byEmail' => true, 'byHashedPassword' => true))), _G2_PASSWORD);
	$select[] = mosHTML::makeOption(base64_encode(serialize(array('byUserName' => true, 'byEmail' => true, 'byHashedPassword' => true, 'byFullName' => true))), _G2_FULLNAME);
    $params['userCheckParams'] = mosHTML::selectList($select, 'userCheckParams', 'class="inputbox  size="1"', 'value', 'text', base64_encode(serialize($g2Config['userCheckParams'])));
    $params['userCheckCase'] = mosHTML::yesnoSelectList('userCheckCase', 'class="inputbox" size="1"', $g2Config['userCheckCase']);
    /* cache tab */
	$params['cacheCount'] = g2cache::cacheCount('cache');
	/* Sitemap tab */
	$params['sitemapAutoRefresh'] = mosHTML::yesnoSelectList('sitemapAutoRefresh', 'class="inputbox" size="1"', $g2Config['sitemapAutoRefresh']);
    /* generate the warning text */
    	core::classRequireOnce('siteMap');
    	if(!siteMap::existsXMLFile()){
    		$params['sitemapWarnings'] = _G2_GSM_WARN;
    	} else {
    		$params['sitemapWarnings'] = '';
    	}
    /* cronjob */
    $timePeriod = round(($g2Config["cacheCleanPeriod"] * 0.75));
    if(($timePeriod / 3600) > 1){
    	$timePeriod = min(floor($timePeriod / 3600), 12);
    	$params['cronJobTime'] = 'Make sure The cronjob file is run every '.$timePeriod.' Hours';
    } else {
    	$timePeriod = max(ceil($timePeriod / 60), 30);
    	$params['cronJobTime'] = 'Make sure The cronjob file is run every '.$timePeriod.' Minutes';
    }
	/* */
    if($loadAll){
    	/* this only gets executed if the gallery2 path is correct */
    	/* useralbum */
    	$select = array();
    	list($tree, $info) = core::albumTree();
    	$tree = $g2Cache->getCachedFunction( 'expiresShort', 'config::treeSelect', $tree, $info);
    	$select[] = mosHTML::makeOption($g2Config['id.rootAlbum'], 'Root');
    	foreach($tree as $id => $albumName){
			$select[] = mosHTML::makeOption($id, $albumName);
    	}
    	$params['rootuseralbum'] = mosHTML::selectList($select, 'rootuseralbum', 'class="inputbox  size="1"', 'value', 'text', $g2Config['rootuseralbum']);

		core::classRequireOnce('group');
		core::classRequireOnce('userAlbum');
		
		$params['groups'] = $g2Cache->getCachedFunction('expiresLong' , 'group::getGroupsByUsername');
		unset($params['groups'][$g2Config["id.adminGroup"]]);
    	
		foreach($params['groups'] as $id => $groupname){ 	
    		$tmp = array();		
    		$tmp['comment'] = userAlbum::createSelectList($id, 'comment');
    		$tmp['view'] 	= userAlbum::createSelectList($id, 'view');
    		$tmp['extra']	= userAlbum::createSelectList($id, 'extra');
    		
    		$params['selectLists'][$id] = $tmp;
    	}
    		$tmp = array();	
    		$tmp['comment'] = userAlbum::createSelectList('owner', 'comment');	
    		$tmp['view'] 	= userAlbum::createSelectList('owner', 'view');
    		$tmp['extra']	= userAlbum::createSelectList('owner', 'extra');
    	$params['selectLists']['owner'] = $tmp;
    	
    	/* check version */
    	core::classRequireOnce('utility');
		$ret = $g2Cache->getCachedFunction( 'expiresLong', 'utility::getLatestVersion');
		$current = $g2Cache->getCachedFunction( 'expiresLong', 'utility::comVersion');
		if($ret){
	    	if (version_compare($current, $ret['component'], ">=")) { 
				$params['versionCheck'] = '<font color="Green">You have the Latest Version!</font>'; 
			} else { 
				$params['versionCheck'] = '<font color="Red">You need to Update to version: <strong>'.$ret['component'].'!</strong></font>'; 
			} 
		} else {
			$params['versionCheck'] = '<font color="Red">Version couldn\'t be checked as there was no protocol available.(curl or fopen)</font>';
		}
    	
    }
    HTML::showSettings($option, $params, $act, $g2Config, $task,  $loadAll);
}

/* Saves Gallery component settings */ 
function saveSettings( $option, $act ) {
    global $database;
	
    if (mosGetParam($_POST, 'userSetup', false)) {
       RunUserSetup($params);
    }
	
	foreach ($_POST as $k=>$v){
		if($k !='act' AND $k !='option' AND $k !='conf' AND $k !='task' AND $k !='embedUri' AND $k !='embedPath'){
			list($ret, $v) = config::variableCheck($k, $v);
			if($ret){
				if($k == 'userAlbumView' || $k == 'userAlbumComment' || $k == 'userAlbumExtra'){
					$v = serialize($v);
				}
				$g2Config["$k"]=$v;
			}
		}
	}
	
	$permissionSets = array('userAlbumView', 'userAlbumComment', 'userAlbumExtra');
	foreach($permissionSets as $permissionType){
		if(!isset($g2Config[$permissionType])){
			$g2Config[$permissionType] = serialize(array(null));
		}
	}
	
	/* save to DB */
	foreach($g2Config as $k => $v){
		$query = "UPDATE `#__gallery2` SET `value` ='$v' WHERE `key`='$k'";
		$database->setQuery( $query );
		$check = $database->query();
	}
	
	/* return to config screen */
	if(empty($g2Config['path'])){
		mosRedirect('index2.php?option=com_gallery2&act=conf', 'Full server path was incorrect!');
	} else {
		/* store extra data from g2*/
		list($ret , $msg) = config::getG2Settings();
		mosRedirect('index2.php?option=com_gallery2&act=conf', $msg);
	}	
}

function RunUserSetup($params) {
    global $my;
	
	$ret =  core::initiatedG2($my->id, 'true');

    if ($ret) {
        if ($ret->getErrorCode() & ERROR_MISSING_OBJECT) {
            // check if there's no G2 user mapped to the activeUserId
            $ret = GalleryEmbed::isExternalIdMapped($my->id, 'GalleryUser');
            if ($ret->getErrorCode() & ERROR_MISSING_OBJECT) {
                // We want to set the user calling this method as the G2 admin
                list ($ret, $g2user) = GalleryCoreApi::fetchUserByUserName('admin');
                if ($ret) {
                    return false;
                }
                $ret = GalleryEmbed::addExternalIdMapEntry($my->id, $g2user->getId(), 'GalleryUser');
                if ($ret) {
                    return false;
                }
            }
        }
    }
    return true;
}
?>