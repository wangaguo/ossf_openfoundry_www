<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

function com_install() {
$success = true;
$database = &JFactory::getDBO();

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
    require_once (dirname(__FILE__)."/../com_pollxtupd.inc");
	if ($version == 0) $updatequery = addSamplePoll($updatequery);
// update database

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

function addSamplePoll($updatequery) {
$u = new stdClass();
$u->query = "INSERT INTO `#__pollsxt` VALUES (1, 'Sample Poll', 10, 0, '0000-00-00 00:00:00', 1, 0, 0, 1, 3, 1, 4, 1, 'This is a sample poll, that shows you quickly some of the capabilities of PollXT', '', 0, '', 100, 'width', 0, '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 1, 0, 0, 1, 0, '', '', 0, '', 0, 0, '', '', 1, '', 0, 1, 2, 1, '', 0, 0); ";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Poll)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_questions` VALUES (1, 1, 'A question with radio buttons... like it?', 1, '', 100, 'width', 0, 0, '', 0, 3, '', '', 0, 0, 0, 'v'); ";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Question1)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_questions` VALUES (2, 1, 'Now some checkboxes with pictures, do you like...', 2, '', 100, 'width', 0, 0, '', 0, 2, '', '', 0, 0, 0, 'v');";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Question 2)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_questions` VALUES (3, 1, 'Select as much as you''d like to...', 4, 'images/stories/clock.jpg', 30, 'width', 0, 1, '3', 0, 1, '', '', 0, 0, 0, 'v');";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Question 3)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (1, 1, 'yes', '', 100, 'width', 0, 0, 0, 0, '10', '1', 1);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (2, 2, 'Cherries', 'images/stories/fruit/cherry.jpg', 30, 'width', 1, 0, 0, 0, '10', '1', 1);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (3, 1, 'no', '', 100, 'width', 0, 0, 0, 0, '10', '1', 2);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (4, 2, 'Strawberrys', 'images/stories/fruit/strawberry.jpg', 30, 'width', 0, 0, 0, 0, '10', '1', 2);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (5, 2, 'Something else', '', 100, 'width', 0, 1, 0, 0, '10', '1', 3);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (6, 3, 'PollXT is cool', '', 100, 'width', 0, 0, 0, 0, '10', '1', 1);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (7, 3, 'I like JoomlaXT', '', 100, 'width', 0, 0, 0, 0, '10', '1', 2);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";
$updatequery[] = clone $u;
$u->query = "INSERT INTO `#__pollsxt_options` VALUES (9, 3, 'I''ll try StaticXT, too', '', 100, 'width', 0, 0, 0, 0, '10', '1', 4);";
$u->upversion = "2.00.00";
$u->text = "Insert Sample Poll (Options)";	
$updatequery[] = clone $u;
/*$u->query = "INSERT INTO `#__pollxt_config` VALUES (1,'', 2, 0, 0, 0, 1, '', '', 5, 5, 'hits', 'ASC', 1, 1, 1, 0, 'images/stories', 1, 0, 0, '', '');
";
$u->upversion = "2.00.00";
$u->text = "Insert default Config";
$updatequery[] = clone $u;*/


return $updatequery;
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



