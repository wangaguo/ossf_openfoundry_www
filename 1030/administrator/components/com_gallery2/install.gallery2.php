<?php
/*
 Install file: executes any once-off code on install
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$GLOBALS['error'] = new errorReporting();

function com_install(){
	global $database, $mosConfig_absolute_path, $error;
	/* first get the version for this install */
	require_once($mosConfig_absolute_path.'/components/com_gallery2/version.php');
	$_G2VERSION = new g2Version();
	$shippedVersion = $_G2VERSION->getShortVersion();
	$upgradeFrom = 0;
	
	/*
	 *Sets the image used in back-end
	 */
	 backEndImages();
	
	/*
	 * Now we check if there is a database and what his state is
	 */
	$query = "SELECT `value` FROM `#__gallery2` WHERE `key`='version'";
	$database->setQuery($query);
	$result = $database->loadResult();
	if($result){
		/* we have a version, know check if it predates 2.0.9 */
		if(version_compare($result, '2.0.9', '<')){
			/* older version drop table and create a new one */
			createDatebase(true);
		} else {
			/* 2.0.9 or newer we can go into the update cycle */
			$upgradeFrom = $result;
		}
	} else {
		createDatebase(true);
	}
	 /*
	  * We have version old version and want to update
	  */
	 if($upgradeFrom != $shippedVersion){
	 	updateDatabase($upgradeFrom, $shippedVersion);
	 }
	 
	 /**
	  * Print Text, adjust installText function way down
	  */
		print installText();
	 /**
	  * Print Errors if they are there
	  */
	 if($error->count() > 0){
	 	print '<strong>!There were some errors during install, copy/paste for support!</strong><br />'."\n";
	 	print $error->get('html');
	 }
}


/**
 *All helper function below here
 */
 
 
function createDatebase($drop=false){
	global $database, $error;
		if($drop){
			$database->setQuery( "DROP TABLE IF EXISTS #__gallery2");
			$result = $database->query();
			if(!$result){
				$error->add($database->getQuery(), 3);
			}
		}
		$database->setQuery( "CREATE TABLE `#__gallery2` (`key` varchar(255) NOT NULL default '',`value` text NOT NULL, PRIMARY KEY (`key`))");
		$result = $database->query();
		if(!$result){
			$error->add($database->getQuery(), 5);
		}
}


function backEndImages(){
	
	global $database, $mosConfig_absolute_path;
	$database->setQuery( "UPDATE #__components SET admin_menu_img = '../administrator/components/com_gallery2/images/foto.png' WHERE admin_menu_link='option=com_gallery2'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_gallery2&act=conf'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/users.png' WHERE admin_menu_link='option=com_gallery2&act=user'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = '../administrator/components/com_gallery2/images/tools.png' WHERE admin_menu_link='option=com_gallery2&act=tools'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/sections.png' WHERE admin_menu_link='option=com_gallery2&act=album'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/help.png' WHERE admin_menu_link='option=com_gallery2&act=help'");
	$database->query();
	
	if(!file_exists($mosConfig_absolute_path .'/administrator/images/reload.png')){
		@copy($mosConfig_absolute_path .'/administrator/components/com_gallery2/images/reload.png', $mosConfig_absolute_path .'/administrator/images/reload.png');	
	}
	if(!file_exists($mosConfig_absolute_path .'/administrator/images/reload_f2.png')){
		@copy($mosConfig_absolute_path .'/administrator/components/com_gallery2/images/reload_f2.png', $mosConfig_absolute_path .'/administrator/images/reload_f2.png');
	}
}

function updateDatabase($upgradeFrom){
	$time = time() + 86400;
	$sql = array();
	switch($upgradeFrom){
	case '0':	
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('path', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('relativeG2Path', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('loginredirect', '/index.php')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('displaysidebar', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('displaylogin', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('mirrorUsers', '1')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userSetup', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('enableAlbumCreation', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('version', '2.0.9')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('tablePrefix', 'g2_')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('columnPrefix', 'g_')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('lastChanged', '604800')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('expires', '3600')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('lastChangedCleaned', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('id.rootAlbum', '')";

	case '2.0.9':
		/* user syncing new config settings */
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userCheckParams', 'YToyOntzOjEwOiJieVVzZXJOYW1lIjtiOjE7czo3OiJieUVtYWlsIjtiOjE7fQ==')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userCheckCase', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('g2ToJoomla', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userGroupRecursive', '0')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('id.everybodyGroup', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('id.anonymousUser', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('id.allUserGroup', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('id.adminGroup', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('id.admin', '')";
		/* user album creation new settings */
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('rootuseralbum', '7')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumName', '')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumTitle', '%username%')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumSummary', '%username%\'s album.')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumKeywords', '%username, %fullnamesplit%')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumDescription', 'This is the %username%\'s album.')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumView', 'a:1:{i:0;N;}')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumComment', 'a:1:{i:0;N;}')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('userAlbumExtra', 'a:1:{i:0;N;}')";

		/* new table for user album mapping */
		$sql[] = 	"CREATE TABLE `#__gallery2_useralbum` (`userid` INT(11) UNSIGNED NOT NULL," 
					."`albumid` INT(11) UNSIGNED NOT NULL,PRIMARY KEY(`userid`, `albumid`))";
		/* cache new settings */
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheFileLong', '900')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheFileShort', '60')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheDbLong', '60')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheDbShort', '10')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheObsolete', '604800')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheCleanPeriod', '3600')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('cacheCleaned', '$time')";
		/* google sitemap settings */
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('sitemapLastUpdate', '$time')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('sitemapFilename', 'sitemap_albums.xml')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('sitemapAutoRefresh', '0')";
		/* last curl run */
		$time = time() - 402400;
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('curlRun', '$time')";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('sendStats', '1')";
		
		/* delete obsolete */
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'lastChanged'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'expires'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'lastChangedCleaned'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'hostname'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'username'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'password'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'database'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'tablePrefix'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'columnPrefix'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'userAlbumViewGuest'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'userAlbumGuest'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'userAlbumPermissions'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'databasequel'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'expiresCleaned'";
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'embedPath'";	
	case '2.0.10':
		
		/* do to wrong install file migth be not included no warning if it already is there */
		$sql[] = "INSERT IGNORE INTO `#__gallery2` VALUES ('id.rootAlbum', '')"; 
	
	case '2.0.12':
		/* we have to update entries for new paths required by galleryEmbed::init */
		$sql[] = "DELETE FROM `#__gallery2` WHERE `key` = 'relativeG2Path'";
		$sql[] = "INSERT INTO `#__gallery2` VALUES ('g2Uri', '')"; 	

	default:
		/* update database version */
		$sql[] = "UPDATE `#__gallery2` SET `value` = '2.0.13' WHERE `key`='version'";
		$databaseEntries = 40;
	}
	/*
	 * Update Engine
	 */
	 global $database, $error;
	 if(count($sql)>0){
		 foreach($sql as $query){
		 	$database->setQuery( $query );
			$result = $database->query();
			if(!$result){
				$msg = 'failed Query: '.$database->getQuery();
				if(strpos($msg, 'IGNORE') !== false) {
					$msg = str_replace(array('<pre>', '</pre>'), '', $msg);
					$msg .= '<br />'.$database->getErrorMsg();
					$error->add($msg, 5);
				}
			}
		 }
	 }
	 /* count config rows */
	 $query = "SELECT count(*) FROM `#__gallery2`";
	 $database->setQuery($query);
	 $count = $database->loadResult();
	 
	 if($count != $databaseEntries){
			$msg = 'counted '.$count.' Rows Should have been '.$databaseEntries.' rows.';
			$error->add($msg, 3);
	 }
	
	 return true;
}

class errorReporting{
	/**
	 * Holds the error messages
	 *
	 * @var array
	 */
	var $errorArray = array(null);
	/**
	 * Count of error messages
	 *
	 * @var integer
	 */
	var $errorCount = 0;
	
	/**
	 * Add a error
	 *
	 * @param string $msg
	 * @param error severity, integer, 0(no problem)-5(most critical)
	 */
	function add($msg, $cat=5){
		$this->errorCount++;
		$this->errorArray[] = array($msg, $cat);
	}
	
	function reset(){
		$this->errorArray = array(null);
		$this->errorCount = 0;
	}
	
	/**
	 * Get error Count
	 *
	 * @return integer
	 */
	function count(){
	 return $this->errorCount;	
	}
	
	/**
	 * Get Errors
	 *
	 * @param string, html or array
	 * @return mixed, string or array
	 */
	function get($from = 'html') {
		$color = array();
		$color[0] = 'White';
		$color[1] = 'White';
		$color[2] = 'Yellow';
		$color[3] = 'Yellow';
		$color[4] = 'Red';
		$color[5] = 'Red';
		 
		switch($from){
			case 'array':
				return $this->errorArray;
			break;
			default:
			case 'html':
				$content = '<table border="0" cellpadding="0" cellspacing="0" class="adminform">'."\n";
				$content .= '<tr><th>Error Msg</th><th>Error Level</th></tr>'."\n";
				foreach($this->errorArray as $array){
					$content .= '<tr><td width="80%">'.$array[0].'</td>'."\n";
					$content .= '<td bgcolor="'.$color[$array[1]].'">'.$array[1].'</td></tr>'."\n";	
				}
				$content .= '</table><br />'."\n";
				return $content;
			break;
		}
	}
}

function installText(){
$text = <<<END
<strong>Installation finished.<br /></strong>
If there are any errors below copy/paste them for support! Most likely those errors will impede the normal functioning of this component.<br />
<br />
Documentation can be found on <a href="http://opensource.4theweb.nl" target="_blank">opensource.4theweb.nl</a>; also there is a support forum where you can post questions to other users.<br />
<br />
This component is still in <strong>Beta</strong> fase, remember this!<br /><br />
END;
return $text;
}
?>