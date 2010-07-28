<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php
require_once(JPATH_SITE.DS."administrator/components/com_pollxt/installer.class.php");

function com_install() {
$success = true;
$database = &JFactory::getDBO();

$inst = new xtInstaller("pollxt");


$output = "";
// currently installed version
	//for some reason joomla doesn't resolve #_ in this query
	$table = $database->getPrefix()."pollxt_config";
	$database->setQuery("SHOW TABLES LIKE '$table';");
	$tables = $database->loadResult();
	$database->getErrorMsg();
	if (count($tables)>0) {
	 	$database->setQuery("SELECT version"."\n FROM #__pollxt_config");
		$version = $database->loadResult();
		$output .= "<tr><td style=\"color:#000000; font-weight:bold; font-size:12px\">";
        $output .= "Upgrading from ".$version;
		if (!$version) $version=0;
	}
	else {
		$output .= "<tr><td style=\"color:#000000; font-weight:bold; font-size:12px\">";
        $output .= "New Installation";
		$version = 0;
	}

	if ($version < "1.24.16" && $version > 0 ) {
		$output .= "An upgrade from version ".$version. "is not supported</br>" ;
		$output .= "Please either uninstall pollXT completely<br/>";
		$output .= "(That involves deleteing all database tables manually)).<br/>";
		$output .= "or upgrade to version 1.24.16 first.<br/>";
		echo $output;
		return false;

	}

// update images (use of media manager since 2.00.03)

	if ($version < "2.00.03" && $version > 0 ) {
	 	if (updateImgPath()) {
        	$output .= "<tr><td style=\"color:#009900; font-weight:bold; font-size:12px\">";
            $output .= "Updating image paths successful</td></tr>"; 
		}
		else {
        	$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
            $output .= "Updating image paths failed</td></tr>"; 
			echo $output;
			return false;
		}
	}
	
// include updateinfo
    require_once (dirname(__FILE__)."/../com_pollxtupd.php");

// update database
	if ($createTable) $success = $inst->createTable($createTable);
	
    if ($updatequery) {
        foreach ($updatequery as $q) {
            if ($q->upversion > $version || ($q->upversion == 0 && $version == 0)) {
                $database->setQuery($q->query);
                $database->query();
                if ($database->getErrorNum()) {
                    $output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
                    $output .= $database->getErrorMsg()."</td></tr>";
                    $success = false;
                }
                else {
                    $output .= "<tr><td style=\"color:#009900; font-weight:bold; font-size:12px\">";
                    $output .= $q->text." successful</td></tr>"; }

            }
        }
    }
	$database->setQuery("SELECT id FROM #__components WHERE admin_menu_link = 'option=com_pollxt'");
	$id = $database->loadResult();
	$database->setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_pollxt/xtmenu.png'WHERE id='$id'");
	$database->query();
	if ($database->getErrorNum()) {
		$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
		$output .= $database->getErrorMsg()."</td></tr>";
	}

echo $output;
return $success;
}


function updateImgPath() {
 	global $mainframe;
	require_once (JPATH_SITE.'/administrator/components/com_pollxt/pollxt.class.php');

	$db = JFactory::getDBO(); 
	
	$conf = new mosPollConfig ($db);
  	$conf->load('1');
	
	if ($conf->xt_imgvote) $conf->xt_imgvote = $conf->imgpath.$conf->xt_imgvote;
	if ($conf->xt_imgresult) $conf->xt_imgresult = $conf->imgpath.$conf->xt_imgresult;
	if ($conf->imgdetail) $conf->imgdetail = $conf->imgpath.$conf->imgdetail;
	if ($conf->imgback) $conf->imgback = $conf->imgpath.$conf->imgback;
	
	$conf->store();
	
	$pdb = new mosPoll($db);
	$qdb = new mosPollQuestion($db);
	$odb = new mosPollOptions($db);

	$table = $db->getPrefix()."pollsxt";
	$query = "SELECT * FROM $table";
	$db->setQuery($query);
	$polls = $db->loadObjectList();
	echo $db->getErrorMsg();
	foreach ($polls as $p) {
		foreach ($p as $k=>$v) {
			$pdb->$k = $v;
		}
	if ($pdb->img_url) $pdb->img_url = $conf->imgpath.$pdb->img_url;
	$pdb->store();
	}

	$table = $db->getPrefix()."pollsxt_questions";
	$query = "SELECT * FROM $table";
	$db->setQuery($query);
	$qs = $db->loadObjectList();
	echo $db->getErrorMsg();
	foreach ($qs as $q) {
		foreach ($q as $k=>$v) {
			$qdb->$k = $v;
		}
	if ($qdb->img_url) $qdb->img_url = $conf->imgpath.$qdb->img_url;
	$qdb->store();
	}

	$table = $db->getPrefix()."pollsxt_options";
	$query = "SELECT * FROM $table";
	$db->setQuery($query);
	$qs = $db->loadObjectList();
	echo $db->getErrorMsg();
	foreach ($qs as $q) {
		foreach ($q as $k=>$v) {
			$odb->$k = $v;
		}
	if ($odb->img_url) $odb->img_url = $conf->imgpath.$odb->img_url;
	$odb->store();
	}
	
	return true;
}

?>



