<?php

if ($_SERVER['REQUEST_URI']) 
	die('Unauthorized script access');

$baseDir = dirname(__FILE__) . '/';	
// Setup a pseudo-Joomla environment
define('_VALID_MOS', 1); //Pretend we're Joomla
require_once($baseDir.'../../../configuration.php');
if(file_exists($baseDir .'../../../includes/mambo.php')){
	require_once($baseDir .'../../../includes/mambo.php');
} else {
	require_once($baseDir .'../../../includes/joomla.php');
}
$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );

require_once($baseDir.'../init.inc');
global $g2Config;

$jobs = array();
$jobs['cleanCache'] = array($g2Config["cacheCleanPeriod"], $g2Config["cacheCleaned"]);
$jobs['sitemap'] = array(14400, $g2Config["sitemapLastUpdate"]);
if(function_exists('curl_init') && $g2Config['sendStats'] == 1){
	$jobs['stats'] = array(600000, $g2Config["curlRun"]);
}

/* determine which to run */
$overdue = array();
$time = time();
foreach($jobs as $job => $data){
	$overdue[$job] = round((($time - $data[1]) / $data[0]) *2) / 2;
}

if(max($overdue) == 0){
	die('No Task to Run');
}
arsort($overdue);
$task = key($overdue);

switch($task){
	case 'stats':
		core::classRequireOnce('g2curl');
		$stats = new g2Curl();
		$stats->sendStats();
		$database->setQuery("UPDATE `#__gallery2` SET `value` = '$time' WHERE `key`='curlRun'");
		$database->query();
	break;
	case 'sitemap':
		core::classRequireOnce('siteMap');
		siteMap::buildXML();
	break;
	case 'cleanCache':
		g2cache::cleanCache('cache/fileCache/expires', $g2Config['cacheFileLong']);
		g2cache::cleanCache('cache/dbCache/', $g2Config['cacheFileShort']);
		g2cache::cleanCache('cache/fileCache/lastChanged', $g2Config['cacheObsolete']);
		$database->setQuery("UPDATE `#__gallery2` SET `value` = '$time' WHERE `key`='cacheCleaned'");
		$database->query();
	break;
}

print 'Job succesfully completed.'."\n";
print 'This Task was completed: '.$task."\n";
?>