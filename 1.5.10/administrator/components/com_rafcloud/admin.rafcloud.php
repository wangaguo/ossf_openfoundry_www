<?php
/**
* @version 2.0.2
* @package Raf Cloud
* @copyright Copyright (C) 2007 Skorp. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Raf Cloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivaFttive of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @Author: Rafal Blachowski (Skorp) <http://joomla.royy.net>
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_rafcloud' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

global $mosConfig_absolute_path,$RC_version;

$RC_version = "2.0.2";
$encoding = strtoupper(str_replace('charset=','',_ISO));
$langcode=null;
if ($encoding=="UTF-8") $langcode=".utf-8";


if( !@include_once( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/language/".$mosConfig_lang.$langcode.".php" ) ) {
	include_once( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/language/english.php" );
}
//require($mosConfig_absolute_path."/administrator/components/com_rafcloud/settings.php");


$task = mosGetParam( $_REQUEST, 'task' );
$no_html = mosGetParam( $_REQUEST, 'no_html' );
$plid = mosGetParam( $_REQUEST, 'plid' );
$cid = josGetArrayInts( 'cid' );
$option="com_rafcloud";

require($mosConfig_absolute_path."/administrator/components/com_rafcloud/includes/config.class.php");
require($mosConfig_absolute_path."/administrator/components/com_rafcloud/includes/tag.creator.class.php");

$RC_config = new RafCloud_config();
$tagCreator = new RafCloud_TagCreator($RC_config);

switch ($task) {
	case 'upload':
		upload($option);
		break;
	case 'publish':
		publishWord( $cid,1,$option );
		$tagCreator->setFontSize();
		viewWords( $option );
		break;
	case 'unpublish':
		publishWord( $cid, 0 ,$option );
		$tagCreator->setFontSize();
		viewWords( $option );
		break;
	case 'publishPlugin':
		publishPlugin( $plid,1,$option );
		break;
	case 'unpublishPlugin':
		publishPlugin( $plid, 0 ,$option );
		break;
	case 'config':
		showConfig( $option,$RC_config );
		break;
	case 'saveconfig':
		saveConfig($option);
		//viewWords( $option );
		mosRedirect("index2.php?option=$option&task=refresh", RC_SAVED);
		break;
	case 'create':
		$tagCreator->createCloudArray ();
		viewWords( $option );
		//mosRedirect( "index2.php?option=$option&task=view" );
		break;
	case 'eraseAll': //disabled
		emptyDatabase ($option);
		mosRedirect( "index2.php?option=$option" );
		break;
	case 'eraseUnpubl':
		eraseUnpublished ($option);
		mosRedirect( "index2.php?option=$option" );
		break;
	case 'removeWords':
		$eraseDes=true;
		viewWords( $option );
		break;
	case 'plugins':
		plugins ($option);
		break;
	case 'removePlugin':
		removePlugin( $plid, $option);
		break;
	case 'refresh':
		//eraseUnpublished($option);
		//$tagCreator->createCloudArray ();
		viewWords( $option );
		break;
	case 'view':
		viewWords( $option );
		break;
	case 'addBlacklist':
		addBlacklist($cid, $option );
		viewWords( $option );
		break;
	case 'sortBlacklist':
		echo(sortBlacklist());
		break;
	default:
		viewWords( $option );
		break;
}

function viewWords( $option) {
	global $database, $mainframe, $mosConfig_list_limit;
	
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( trim( $search ) );

	$showPublished = $mainframe->getUserStateFromRequest( "showPublished{$option}", 'showPublished', '' );
	$showPublished = $database->getEscaped( trim( $showPublished ) );

	$orderby = mosGetParam($_REQUEST, 'orderby', 'counter');
	$sort = mosGetParam($_REQUEST, 'ordering', 'DESC');
	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "viewban{$option}limitstart", 'limitstart', 0 ) );
	if( !empty( $search ) ) 
		$r_search=" WHERE word LIKE '%$search%' ";
	else
		$r_search=null;

	$query = "SELECT COUNT(*)"
	. "\n FROM #__rafcloud_stat ".$r_search." ORDER BY ".$orderby." ".$sort." , word ASC";
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	

	$query = "SELECT * FROM #__rafcloud_stat ".$r_search." ORDER BY ".$orderby." ".$sort." , word ASC LIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	HTML_rafcloud::showWords( $rows, $pageNav, $option ,$search ,$sort, $orderby,$showPublished);
}

function sortBlacklist()
{
	global $RC_config;
	$RC_blacklist = $RC_config->getValue("RC_blacklist");
	$blist = explode (",",str_replace(" ","",$RC_blacklist));
	$blist=array_unique($blist);
	sort($blist);
	$blist=implode(",<br>",$blist);
	return $blist;
}

function publishWord( $cid=null, $publish=1, $option ) {
	global $database, $my;

	if (!is_array( $cid ) || count( $cid ) < 1) 
	{
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__rafcloud_stat SET dateAdd=now(), published='$publish'"
	. "\nWHERE id IN (".$cids.")");
	if (!$database->query()) 
	{
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
}

function addBlacklist( $cid=null, $option ) {
	global $database, $my;

	$RC_config = new RafCloud_config();
	if (!is_array( $cid ) || count( $cid ) < 1) 
	{
		echo "<script> alert('Select an item to blacklist'); window.history.go(-1);</script>\n";
		exit;
	}

	$cid=$cid[0];
	$database->setQuery("SELECT * FROM #__rafcloud_stat WHERE id=".$cid);
	if ($database->loadObject($row))
	{
		$word=$row->word;
		$database->setQuery( "DELETE FROM #__rafcloud_stat WHERE id =".$cid);
		if (!$database->query()) 
		{
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		} else
		{
			$RC_blacklist = $RC_config->getValue("RC_blacklist");
			if (empty($RC_blacklist))
				$RC_blacklist = $word;
			else
				$RC_blacklist.=", ".$word;

			$RC_config->setValue("RC_blacklist", $RC_blacklist,'config');
		}
	}else
	{
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
}

function removeBlacklisted()
{

}

function emptyDatabase($option)
{
	global $database;
	$database -> setQuery("DELETE FROM #__rafcloud_stat");
	$database -> query();
}

function eraseUnpublished($option)
{
	global $database;
	$database -> setQuery("DELETE FROM #__rafcloud_stat WHERE published=0");
	$database -> query();
}




function publishPlugin( $plid=null, $publish=1, $option ) {
	global $database, $my;

	if (!is_array( $plid ) || count( $plid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$plids = implode( ',', $plid );
	$plids=str_replace(",","','",$plids);

	$database->setQuery( "UPDATE #__rafcloud_plugins SET published='$publish' "
	. "\nWHERE plugin IN ('".$plids."')");
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
	mosRedirect( "index2.php?option=$option&task=plugins" );
}

function removePlugin( $plid=null, $option ) {
	global $database,$mosConfig_dbprefix,$mosConfig_absolute_path;
	$dir=$mosConfig_absolute_path."/administrator/components/com_rafcloud/plugins/";
	if (!is_array( $plid ) || count( $plid ) < 1) {
		echo "<script> alert('Select an item to remove'); window.history.go(-1);</script>\n";
		exit;
	}

	foreach($plid as $plugin)
	{
		$database->setQuery("SELECT * FROM #__rafcloud_plugins WHERE plugin='".$plugin."'");
		if ($database->loadObject($row))
		{
			//$plugin=$row->plugin;
			$database->setQuery( "DELETE FROM #__rafcloud_plugins WHERE plugin ='".$plugin."'");
			if ($database->query()) 
			{
				if (!unlink($dir.$plugin))
				{
					echo "<script> alert('Error unlink file!'); window.history.go(-1); </script>\n";
					exit();
				}
			}
			else
			{
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
	}
	mosRedirect( "index2.php?option=$option&task=plugins" );
}


/*Configuratior*/
function showConfig( $option='com_rafcloud',&$RC_config) {
	HTML_rafcloud::settings( $option ,$RC_config);
}

function saveConfig ($option) {

global $mosConfig_absolute_path,$database;

if (($_POST['remove_database']==1)&&($_POST['remove_database_1']))
{
	$database->setQuery("DROP TABLE `#__rafcloud_config`;");
	if (!$database->query()) mosRedirect("index2.php?option=$option", "rafcloud_config - ".RC_ERROR); 
	$database->setQuery("DROP TABLE `#__rafcloud_plugins`;");
	if (!$database->query()) mosRedirect("index2.php?option=$option", "rafcloud_plugins - ".RC_ERROR);
	$database->setQuery("DROP TABLE `#__rafcloud_stat`;");
	if (!$database->query()) mosRedirect("index2.php?option=$option", "rafcloud_stat - ".RC_ERROR);

	mosRedirect("index2.php?option=com_installer&element=component", RC_REMOVED );
	//mosRedirect("index2.php?option=$option", RC_REMOVED);
return;
}

$RC_config = new RafCloud_config();
$RC_config->setValue("RC_enabled", $_POST['words_enabled'],'config');
$RC_config->setValue("RC_published", $_POST['published'],'config');
$RC_config->setValue("RC_min_counter", $_POST['mincounter'],'config');
$RC_config->setValue("RC_min_len", $_POST['minlen'],'config');
if ($_POST['maxlen']>200) $ml=200; else $ml=$_POST['maxlen'];
$RC_config->setValue("RC_max_len", $ml,'config');
$RC_config->setValue("RC_blacklist", $_POST['blacklist'],'config');
$RC_config->setValue("RC_whitelist", $_POST['whitelist'],'config');
$RC_config->setValue("RC_min_font", $_POST['minfont'],'config');
$RC_config->setValue("RC_max_font", $_POST['maxfont'],'config');

$RC_config->setValue("RC_run_period", $_POST['run_period'],'scheduler');
$RC_config->setValue("RC_run_period_unit", $_POST['period_unit'],'scheduler');
$RC_config->setValue("RC_run_limit", $_POST['run_limit'],'scheduler');
$RC_config->setValue("RC_admin_email", $_POST['admin_email'],'scheduler');
$RC_config->setValue("RC_run_hour", $_POST['run_hour'],'scheduler');
$RC_config->setValue("RC_run_minute", $_POST['run_minute'],'scheduler');
$RC_config->setValue("RC_run_day", $_POST['run_day'],'scheduler');
$RC_config->setValue("RC_run_month", $_POST['run_month'],'scheduler');
$RC_config->setValue("RC_run_year", $_POST['run_year'],'scheduler');

$RC_config->setValue("RC_preg_replace", $_POST['replace_pattern'],'config');
$RC_config->setValue("RC_str_lower", $_POST['str_lower'],'config');


$RC_config->setValue("RC_key_enabled", $_POST['key_enabled'],'config');
$RC_config->setValue("RC_key_published", $_POST['key_published'],'config');
$RC_config->setValue("RC_key_min_counter", $_POST['key_mincounter'],'config');
$RC_config->setValue("RC_key_min_len", $_POST['key_minlen'],'config');
if ($_POST['key_maxlen']>200) $ml=200; else $ml=$_POST['key_maxlen'];
$RC_config->setValue("RC_key_max_len", $ml,'config');
$RC_config->setValue("RC_key_whitelist", $_POST['key_whitelist'],'config');

$RC_config->setValue("RC_key_preg_replace", $_POST['key_replace_pattern'],'config');
$RC_config->setValue("RC_key_str_lower", $_POST['key_str_lower'],'config');
$RC_config->setValue("RC_key_asword", $_POST['key_asword'],'config');

$RC_config->setValue("RC_on_cache", $_POST['cache'],'config');
$RC_config->setValue("RC_sh404sef_prefix", $_POST['sh404p'],'config');

//$RC_config->setValue("", $_POST[''],'config');

	if(is_file($mosConfig_absolute_path."/administrator/components/com_rafcloud/settings.php"))
	{	
		if (!unlink($mosConfig_absolute_path."/administrator/components/com_rafcloud/settings.php")) 	mosRedirect("index2.php?option=$option", RC_ERROR_REMCONF);
	}
	if ($_POST['resetrun']) 
		unlink($mosConfig_absolute_path."/administrator/components/com_rafcloud/runlog.php");

}


function loadPluginDescr ($plugin)
{	global $mosConfig_absolute_path;
	$fname= $mosConfig_absolute_path ."/administrator/components/com_rafcloud/plugins/".$plugin;

	$file = @fopen ($fname, "r");
	if ($file) 
	{	
		$isDes=false;
		$isPackage=false;
		$isVersion=false;
		while (!feof($file))
		{
    			$buffer = fgets($file, 4096);
			echo($buffer);
			if (strpos($buffer,"descr")!==FALSE) $isDes=true;
			if (strpos($buffer,"@package Raf Cloud")!==FALSE) $isPackage=true;
			if (strpos($buffer,"@version 2.")!==FALSE) $isVersion=true;
    		}
		fclose ($file);
		if($isDes&&$isPackage&&$isVersion)
		{
			$runMe=false;
			include( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/plugins/".$plugin );
			if (empty($descr)) return null;
			return $descr;
		}
	}
return null;
}

function savePluginInfo($plugin)
{
	global $database, $mosConfig_dbprefix,$mosConfig_absolute_path;
	$dir=$mosConfig_absolute_path."/administrator/components/com_rafcloud/plugins/";
	$plugin=strtolower($plugin);
	if ($descr=loadPluginDescr($plugin))
	{	
	$database->setQuery("SELECT * FROM ".$mosConfig_dbprefix."rafcloud_plugins WHERE plugin='".$plugin."'");
	if ($database->loadObject($row))
	{
		$database -> setQuery("UPDATE ".$mosConfig_dbprefix."rafcloud_plugins SET descr='".$descr."' WHERE plugin='".$plugin."'");
	} else
	{ 
		$database -> setQuery("INSERT INTO ".$mosConfig_dbprefix."rafcloud_plugins (plugin,descr) VALUES ('".$plugin."','".$descr."')");
	}
	$database -> query();
	} else
	{
		if (!unlink($dir.$plugin))
		{
			echo "<script> alert('Error unlink file!'); window.history.go(-1); </script>\n";
			exit();
		}
		mosRedirect( "index2.php?option=com_rafcloud&task=plugins", RC_ERROR_PLUGIN );
	}
	
}



function upload($option)
{
	global $mosConfig_absolute_path;
	$dir=$mosConfig_absolute_path."/administrator/components/com_rafcloud/plugins/";

	$file = mosGetParam( $_FILES, 'rcfile', null );

	if (isset($file) && is_array($file))
	{
		if (strtolower(substr( $file['name'], -4 ))!=".php") 
			mosRedirect( "index2.php?option=com_rafcloud&task=plugins", RC_ERROR_UPLOAD_1.".php" );
	
		if (!move_uploaded_file($file['tmp_name'], $dir.strtolower($file['name'])))
			mosRedirect( "index2.php?option=com_rafcloud&task=plugins", RC_ERROR_UPLOAD_2 );
	
	} else mosRedirect( "index2.php?option=com_rafcloud&task=plugins", RC_ERROR_UPLOAD);

savePluginInfo($file['name']);

mosRedirect( "index2.php?option=com_rafcloud&task=plugins", RC_OK_UPLOAD );
}


function plugins($option)
{
	global $mosConfig_absolute_path,$database,$mainframe,$mosConfig_list_limit;
	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "viewban{$option}limitstart", 'limitstart', 0 ) );
	$query = "SELECT COUNT(*)"
	. "\n FROM #__rafcloud_plugins ";
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	

	$query = "SELECT * FROM #__rafcloud_plugins ORDER BY plugin"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	HTML_rafcloud::showPlugins($rows, $pageNav, $option );
}


?>