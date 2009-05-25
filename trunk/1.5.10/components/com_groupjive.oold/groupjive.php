<?php
  /**
   * @version $Id: groupjive.php,v 1.5 2006/05/25
   * @package Joomla!
   * @subpackage GroupJive
   * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
   * @Joomla! is Free Software
   * @author Joshua Holmes
   * @further developed by Anna Tannenberg, John Bultena, Michael Perthel, David Freund, Mark Raborn and Project GroupJive.
   */

// defines
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (!defined('GJBASEPATH')){define ( 'GJBASEPATH', 'components/com_groupjive');}

if (!defined('GJ_REFERER')){define ( 'GJ_REFERER', $_SERVER['HTTP_REFERER']);}
if (!defined('JPATH')) define ('JPATH', $mainframe->getCfg('absolute_path'));


// include CB / CBE config 
if (file_exists(JPATH.'/administrator/components/com_comprofiler/ue_config.php')) {
	include_once(JPATH.'/administrator/components/com_comprofiler/ue_config.php');
} elseif (file_exists(JPATH.'/administrator/components/com_comprofiler/enhanced_admin/enhanced_config.php')) {
	include_once(JPATH.'/administrator/components/com_comprofiler/enhanced_admin/enhanced_config.php');
} else {
	die( 'Community Builder or Community Builder Enhanced is not installed. One of these components is required for GroupJive to function!' );
}

require_once(JPATH."/includes/pageNavigation.php");

require_once("administrator/components/com_comprofiler/imgToolbox.class.php");
include_once( JPATH.'/administrator/components/com_groupjive/groupjive.class.php');
require_once( GJBASEPATH . '/groupjive_func.inc' );


require_once(GJBASEPATH."/includes/gj.core.groups.php");
require_once(GJBASEPATH."/includes/gj.core.categories.php");
require_once(GJBASEPATH."/includes/gj.core.pms.php");

if (_GJ_CONF_BULLETIN) {
	require_once(GJBASEPATH."/includes/gj.core.bulletin.php");
}


// Navigation Item
if (!$Itemid || $Itemid == 99999999) {
	$sql = "SELECT id FROM #__menu "
		. "WHERE link = 'index.php?option=com_groupjive' "
		. "AND published=1";
	$database->setQuery($sql);
	$Itemid = $database->loadResult();
}


switch($task) {

	case 'bulletin':
	case 'editpost':
	case 'savepost':
	case 'deletepost':
	case 'archive':
	case 'addpost':
	case 'showfullmessage':
		// will be handled in gj.core.bulletin.php
		if (!_GJ_CONF_BULLETIN){
			HTML_wg::errorpage(GJ_NO_BULLETIN_AVAILABLE, '', $exgroup, 'error');
		}
		break;

// categories
	case 'showcat':
		showCategory();
		break;

// groups
	case 'mailowner':
		showmailform('mailowner', $option, $exgroup, '', '', '', false, false);
		break;
	case 'showmailform':
		if ($my->id) {
			showmailform('mailgroup', $option, $exgroup);
		} else {
			HTML_wg::errorpage(GJ_NOTAUTH.'<br/>'.GJ_PLEASE_LOGIN, '', $g->id,'error');
		}
		break;

	case 'mailgroupowner':
	case 'mailgroup':
		mailgroup($option, $exgroup, $task);
		break;



	case 'newgroup': 
		//newgroup handler in URL so start the create new group function
		createnewgroup();
		break;

	case 'addgroup':
		//Because Add Group Handler was in the URL we can
		//take the form variables and send them to the addnewgroup function
		//which will do it's magic and then insert it into the DB
		$gj_name=trim(mosGetParam($_POST,'gj_groupname'));
		$gj_descr=trim(mosGetParam($_POST,'gj_aboutgroup'));
		$gj_type= intval(mosGetParam($_POST,'type'));
		$gj_cat = intval(mosGetParam($_POST,'category'));

		if( $_FILES['image_file']['size'] > 0 ) {
			$image_file =  $_FILES['image_file'];
		}

		addnewgroup($ueConfig, $gj_name,$gj_descr,
			$gj_type,$gj_cat,
			$image_file,$row->admin_email,
			$row->send_admin_emails);
		break;

	case 'showgroup':
		$gid = intval(mosGetParam($_REQUEST, 'groupid', 0));
		showgroup($gid);
		break;

	case 'deletegroup':
		deletegroup($exgroup);
		break;

	case 'editgroup':
		editgroup($exgroup);
		break;

	case 'eg':
		savegroup($exgroup, $ueConfig);
		break;

	case 'search':
		$searchstring = mosGetParam($_REQUEST, 'searchstring');
		search($searchstring);
		break;

// members
	case 'member_list':
		showmemberlist();
		break;

	case 'active':
		activateMember($exgroup);
		break;

	case 'inactiveusers':
		showInactiveUsers($exgroup);
		break;

	case 'sign':
		sign($exgroup);
		break;

	case 'makeactive':
		$uid = intval(mosGetParam($_REQUEST,'userid',-1));
		changeStatus($uid, $exgroup, 'active');
		break;

	case 'makeinactive':
		$uid = intval(mosGetParam($_REQUEST,'userid',-1));
		changeStatus($uid, $exgroup, 'inactive');
		break;

	case 'delete':
		if (!ismoder($exgroup,$my->id) && $ur->id_user == $my->id && !$admin)	{
			HTML_wg::errorpage(GJ_NOT_MODER, '', $exgroup,'error');
		} else {
			$group = intval( mosGetParam( $_REQUEST, 'groupid', 0) );
			deleteUser($group);
		}
		break;

	case 'invitef':
		inviteFriend();
		break;

	case 'ajaxuserlist':
		getAjaxUserlist();
		break;

	case 'transfer':
		$group_id = intval(mosGetParam($_REQUEST, 'groupid', 0));
		HTML_wg::transfer($group_id);
		$mainframe->appendPathWay(GJ_TRANSFER_OWNER);
		break;

	case 'transfer_owner':
		$owner = mosGetParam($_REQUEST, 'fr_name');
		$groupid = intval(mosGetParam($_REQUEST, 'group_id', 0));
		transfer($owner, $groupid);
		break;

	default: 
		if ($my->id!=0) { 
			$admsql = "\nOR admin=$my->id";
		}
		
		$sql = "SELECT a.id, a.catname, a.cat_image,"
			. "\na.type, count(b.id) AS CAT_ISONLINE"
			. "\nFROM #__gj_grcategory a"
			. "\nLEFT JOIN #__gj_groups b"
			. "\nON a.id = b.category"
			. "\nAND (b.active='1' OR b.active IS NULL)"
			. "\nWHERE published = 1"
			. "\nAND (access <= $my->gid"
			. $admsql.")"
		  	. "\nGROUP BY a.id, a.catname, a.cat_image,"
		  	. "\na.type"
			. "\nORDER BY ordering";

		$database->setQuery($sql);
		$rows=$database->loadAssocList();

		if($database->getErrorNum()) {
			echo $database->stderr();
			return;
		}

		$col=$database->GetAffectedRows();
		if (!$col) {
			HTML_wg::errorpage(GJ_NO_CAT, '', $exgroup,'error');
			return;
		}

		if (ALLOWCREATEGROUPS && ($my->gid !=0)) {
			HTML_wg::showmenu(true);
		} else {
			HTML_wg::showmenu();
		}
		HTML_wg::showOverview($rows);
	}// end default

	
	

if (VERSION)
  echo "<div style='text-align:center; vertical-align: bottom; clear: both;'><br />
<img src=\"./components/com_groupjive/images/groupjive.png\" alt=\"GroupJive logo\" /><br />
<a href=\"http://www.groupjive.org\">GroupJive 1.6 beta3</a>
</div>";



// From inviteFriend
//	notify($group_id, $pms, '', '',"invite", $row, $ctime);
function notify($exgroup, $pms, $message, $newmember, $action = "notify", $userdata="", $ctime="")
{
  global $my, $database, $mosConfig_mailfrom, $mosConfig_live_site;

// needs some work
		// use PM class
		$gj_message = new gj_message();
		$gj_message->setPms($pms);

		$gj_message->loadGroup($exgroup);

		switch ($action) {
			case 'notify':
			case 'notifyall':
				if(NOTIFY) {
					$action = 'notifyall';
				}
				$subject = GJ_ACTIVITY;
				$gj_message->loadReceiver($gj_message->_group->user_id);
				$gj_message->loadSender($my->id);
				break;
			default:
				$subject = GJ_INVITED;
				$gj_message->setInviteCode($ctime);
				$gj_message->loadReceiver($newmember);
				$gj_message->loadSender($my->id);
				break;
		}

		$gj_message->setMessage($message);

		$gj_message->setSubject($subject);
		$gj_message->setType($action);
		$gj_message->setRealnames(REAL_NAMES);

		$gj_message->send();
		if ($gj_message->getErrorNum()) {
			$error = $gj_message->getErrorMsg();
			echo $error;exit;
		}
		// end PM class
return;
  $database->setQuery("SELECT user_id, creator, name FROM #__gj_groups WHERE id=".$exgroup);
  $result = $database->loadObjectList();
  $group_name = $result[0]->name;
  $fromid = $result[0]->user_id;
  $creator = $result[0]->creator;
  $timestamp = time();
  $date = date('Y-m-d');
  $time = date('H:i:s');    
  $datetime = date('Y-m-d H:i:s');
  $sysflag = "Group Messenger";
  $disablereply = "1";
  $toid = $userdata->id;
  $toname = $userdata->username;
  $database->setQuery("SELECT * FROM #__gj_users WHERE id_group=$exgroup AND status='active' AND username NOT LIKE '$newmember'");
  $rows = $database->loadObjectList();
  if(REAL_NAMES) {
    $name = $my->name;
  } else {
    $name = $my->username;
  }

  if($pms == 'uddeim')
    {
      //If the message is an invite
      if($action == "invite") {
	$message=str_replace("%u",$toname,GJ_HELLO_UDDEIM);
	$message=str_replace("%f","[url=$mosConfig_live_site/index.php?option=com_comprofiler&task=userProfile&user=".$my->id."]".$name."[/url]",$message);
	$message=str_replace("%g","[url=$mosConfig_live_site/index.php?option=com_groupjive&task=showgroup&groupid=".$exgroup."]".$group_name."[/url]",$message);
	$message=str_replace("%h","[url=$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid=".$exgroup."&code=".$ctime."]here[/url]",$message);
    
	$sql="INSERT INTO #__uddeim (fromid, toid, message, datum, systemmessage, disablereply) VALUES (".$fromid.", ".$toid.", '".$message."', ".$timestamp.", '".$sysflag."', ".$disablereply.")";
	$database->setQuery($sql);
	if (!$database->query()) {
          die("SQL error when attempting to save a message" . $database->stderr(true));
	}
      }
      //If the message is a notification
      if($action == "notify") {   
	$message = str_replace("%g","[url=".$mosConfig_live_site."/index.php?option=com_groupjive&task=showgroup&groupid=".$exgroup."]".$group_name."[/url]",$message);
	$message = str_replace("%u",$newmember,$message);
	$message=addslashes($message);
	foreach ($rows as $row)
	  {
	    if(NOTIFYJOIN) {
	      $toid = $row->id_user;
	    } 
	    //If notifications is off, at least let the group owner know that a new member has joined
	    else {
	      $toid = $fromid;
	    }
	    //  $toid = $row->id_user;
	    $sql="INSERT INTO #__uddeim (fromid, toid, message, datum, systemmessage, disablereply) VALUES (".$fromid.",".$toid.", '".$message."', ".$timestamp.", '".$sysflag."', ".$disablereply.")";
	    $database->setQuery($sql);
	    if (!$database->query()) {
	      die("SQL error when attempting to save a message" . $database->stderr(true));
	    }
	  }
      }
      /*    } else if ($pms == 'mypms') {
       //If the message is an invite
       if($action == "invite") {
       $message=str_replace("%u",$toname,GJ_HELLO_UDDEIM);
       $message=str_replace("%f",$my->username,$message);
       $message=str_replace("%g",$group_name,$message);
       $message=str_replace("%h","[url]$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid=".$exgroup."&code=".$ctime."[/url]",$message);  
       $subject = GJ_INVITED;
       $sql="INSERT INTO #__pms (username,whofrom,date,readstate,subject,message) VALUES ($toid','$sysflag','$datetime','','$subject','$message')";  
      $database->setQuery($sql);
      if (!$database->query()) {
	die("SQL error when attempting to save a message" . $database->stderr(true));
      }
    }
  //If the message is a notification
  if($action == "notify") {  
    $subject = GJ_ACTIVITY;
    $message = str_replace("%g",$group_name,$message);
    $message = str_replace("%u",$newmember,$message);
    $message=addslashes($message);
    foreach ($rows as $row)
      {
	$toid = $row->username;
	$sql= "INSERT INTO #__pms (username,whofrom,date,readstate,subject,message) VALUES ('$toid','$sysflag','$date','0','$subject','$message')";
	$database->setQuery($sql);
	if (!$database->query()) {
	  die("SQL error when attempting to save a message" . $database->stderr(true));
	}
      }
  }*/
    } else if ($pms == 'pmsenh') {
  //If the message is an invite
  if($action == "invite") {
    $message=str_replace("%u",$toname,GJ_HELLO_UDDEIM);
    $message=str_replace("%f",$name,$message);
    $message=str_replace("%g",$group_name,$message);
    $message=str_replace("%h","[url]$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid=".$exgroup."&code=".$ctime."[/url]",$message);    
    $subject = GJ_INVITED;
    
    $sql="INSERT INTO #__pms (recip_id,sender_id,date,time,readstate,subject,message) VALUES ('$toid','$my->id','$date','$time','','$subject','$message')";    
    $database->setQuery($sql);
    if (!$database->query()) {
      die("SQL error when attempting to save a message" . $database->stderr(true));
    }
  }
  //If the message is a notification
  if($action == "notify") {
    $subject = GJ_ACTIVITY;
    $message = str_replace("%g",$group_name,$message);
    $message = str_replace("%u",$newmember,$message);
    $message=addslashes($message);
    foreach ($rows as $row)
      {
	if(NOTIFYJOIN) {
	  $toid = $row->id_user;
	} 
	//If notifications is off, at least let the group owner know that a new member has joined
	else {
	  $toid = $fromid;
	}
	//	  $toid = $row->id_user;
	$sql= "INSERT INTO #__pms (recip_id,sender_id,date,time,readstate,subject,message) VALUES ('$toid','$my->id','$date','$time','0','$subject','$message')";
	$database->setQuery($sql);
	if (!$database->query()) {
	  die("SQL error when attempting to save a message" . $database->stderr(true));
	}
      }
  }
 } else if ($pms == 'jim') {
  //If the message is an invite
  if($action == "invite") {
    $message=str_replace("%u",$toname,GJ_HELLO_JIM);
    $message=str_replace("%f",$name,$message);
    $message=str_replace("%g",$group_name,$message);
    $message=str_replace("%h","$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid=".$exgroup."&code=".$ctime,$message);
    $subject = GJ_INVITED; 
    $sql="INSERT INTO #__jim (username,whofrom,date,readstate,subject,message) VALUES ('$toname','$sysflag','$datetime','','$subject','$message')"; 
    $database->setQuery($sql);
    if (!$database->query()) {
      die("SQL error when attempting to save a message" . $database->stderr(true));
    }
  }
  //If the message is a notification
  if($action == "notify") {
    $subject = GJ_ACTIVITY;
    $message = str_replace("%g",$group_name,$message);
    $message = str_replace("%u",$newmember,$message);
    $message=addslashes($message);
    foreach ($rows as $row)
      {
	if(NOTIFYJOIN) {
	  $toid = $row->username;
	} 
	//If notifications is off, at least let the group owner know that a new member has joined
	else {
	  $toid = $creator;
	}
	//	  $toid = $row->username;
	$sql= "INSERT INTO #__jim (username,whofrom,date,readstate,subject,message) VALUES ('$toid','$sysflag','$datetime','','$subject','$message')";
	$database->setQuery($sql);
	if (!$database->query()) {
	  die("SQL error when attempting to save a message" . $database->stderr(true));
	}
      }
  }
 } else if ($pms == 'missus') {
   //If the message is an invite
  if($action == "invite") {
    $message=str_replace("%u",$toname,GJ_HELLO_JIM);
    $message=str_replace("%f",$name,$message);
    $message=str_replace("%g",$group_name,$message);
    $message=str_replace("%h","[url=$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid=".$exgroup."&code=".$ctime."]here[/url]",$message);
    $subject = GJ_INVITED; 
    $sql="INSERT INTO #__missus (senderid,datesended,subject,message) VALUES ('$fromid','$datetime','$subject','$message')"; 
    $database->setQuery($sql);
    if (!$database->query()) {
      die("SQL error when attempting to save a message" . $database->stderr(true));
    }
    $message_id = mysql_insert_id();
    $sql="INSERT INTO #__missus_receipt (id, receptorid) VALUES ('$message_id','$toid')"; 
    $database->setQuery($sql);
    if (!$database->query()) {
      die("SQL error when attempting to save a message" . $database->stderr(true));
    }
  }
  //If the message is a notification
  if($action == "notify") {
    $subject = GJ_ACTIVITY;
    $message = str_replace("%g",$group_name,$message);
    $message = str_replace("%u",$newmember,$message);
    $message=addslashes($message);
    foreach ($rows as $row)
      {
	if(NOTIFYJOIN) {
	  $toid = $row->id_user;
	} 
	//If notifications is off, at least let the group owner know that a new member has joined
	else {
	  $toid = $fromid;
	}
	$sql="INSERT INTO #__missus (senderid,datesended,subject,message) VALUES ('$fromid','$datetime','$subject','$message')"; 
	$database->setQuery($sql);
	if (!$database->query()) {
	  die("SQL error when attempting to save a message" . $database->stderr(true));
	}
	$message_id = mysql_insert_id();
	$sql="INSERT INTO #__missus_receipt (id,receptorid) VALUES ('$message_id','$toid')"; 
	$database->setQuery($sql);
	if (!$database->query()) {
	  die("SQL error when attempting to save a message" . $database->stderr(true));
	} 
      }
  }
 } else if ($pms == 'clexus') {
  //If the message is an invite
  if($action == "invite") {
    $message=str_replace("%u",$toname,GJ_HELLO_UDDEIM);
    $message=str_replace("%f",$name,$message);
    $message=str_replace("%g",$group_name,$message);
    $message=str_replace("%h","[url]$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid=".$exgroup."&code=".$ctime."[/url]",$message);  
    $subject = GJ_INVITED;
    $sql="INSERT INTO #__mypms (userid,whofrom,time,subject,message,owner) VALUES ('$toid','$fromid','$datetime','$subject','$message','$toid')";  
  
    $database->setQuery($sql);
    if (!$database->query()) {
      die("SQL error when attempting to save a message" . $database->stderr(true));
    }

    $sql="INSERT INTO #__mypms_sent (userid,whofrom,time,subject,message,owner) VALUES ($toid,'$fromid','$datetime','$subject','$message','$fromid')";  
  
    $database->setQuery($sql);
    if (!$database->query()) {
      die("SQL error when attempting to save a message" . $database->stderr(true));
    }
  
    
}
  //If the message is a notification
  if($action == "notify") {  
    $subject = GJ_ACTIVITY;
    $message = str_replace("%g",$group_name,$message);
    $message = str_replace("%u",$newmember,$message);
    $message=addslashes($message);
    foreach ($rows as $row)
      {
	$toid = $row->id_user;
	$sql="INSERT INTO #__mypms (userid,whofrom,time,subject,message,owner) VALUES ('$toid','$fromid','$datetime','$subject','$message','$toid')";  
	$database->setQuery($sql);
	if (!$database->query()) {
	  die("SQL error when attempting to save a message" . $database->stderr(true));
	}
      }
  }
 } else { //E-mail
  //If the message is an invite
  if($action == "invite") {
    $message=str_replace("%u",$userdata->username,GJ_HELLO);
    $message=str_replace("%f","<a href=\"".sefRelToAbs($mosConfig_live_site."/index.php?option=com_comprofiler&task=userProfile&user=$my->id")."\">".$name."</a>",$message);
    $message=str_replace("%g","<a href=\"".sefRelToAbs($mosConfig_live_site."/index.php?option=com_groupjive&task=showgroup&groupid=$exgroup")."\">".stripslashes($group_name)."</a>",$message);
    $message=str_replace("%h","<a href=\"".sefRelToAbs($mosConfig_live_site."/index.php?option=com_groupjive&task=active&groupid=$exgroup&code=$ctime")."\">here</A>",$message);
  
    mosMail($mosConfig_mailfrom, "Group Messenger", $userdata->email, GJ_YOU_WAS_INVITED, $message, true);
  }
  //If the message is a notification
  if($action == "notify") {
    $message = str_replace("%g",stripslashes($group_name),$message);
    $message = str_replace("%a", "$mosConfig_live_site/index.php?option=com_groupjive&task=showgroup&groupid=".$exgroup,$message);
    $message = str_replace("%u",$newmember,$message);
    $database->setQuery("SELECT email FROM #__users, #__gj_users WHERE #__users.id=id_user AND id_group=$exgroup AND status='active'");
    $rows = $database->loadObjectList();

    foreach ($rows as $row) {
      mosMail($mosConfig_mailfrom, "Group Messenger", $row->email, GJ_ACTIVITY, $message, true);
    }
  }
 }
}



function search($searchstring) {
	global $database, $date_format, $mainframe, $my;

	$mainframe->appendPathWay(GJ_SEARCH);

	$searchstring = strtolower($searchstring);
	//Beware of SQL injection
	$searchstring = escapeString($searchstring);
	$q = "SELECT COUNT(*) FROM #__gj_groups a"
		. "\n INNER JOIN #__gj_grcategory b"
		. "\nON a.category = b.id"
		. "\nWHERE b.access <= $my->gid"
		. "\nAND (LCASE(a.name) LIKE '%$searchstring%' "
		. "OR LCASE(a.descr) LIKE '%$searchstring%') "
		. "AND a.active='1' ORDER BY a.name";

	$database->setQuery($q);

	$count = $database->loadResult();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$limit = intval(mosGetParam( $_REQUEST, 'limit', _GJ_CONF_ONPAGE ));
	$limitstart = intval(mosGetParam( $_REQUEST, 'limitstart', 0 ));
	$pageNav = new mosPageNav( $count, $limitstart, $limit  );

	if ($count == 0) {
		HTML_wg::errorpage(GJ_NO_RESULTS, 'info');
		return;
	}


	//Now get the right records depending on the page...
	

	$sql = "SELECT a.id,a.name,a.type,"
		. "\nDATE_FORMAT(date_s, '$date_format') AS date_s,a.descr, a.logo, a.user_id, COUNT(c.id) AS groupusercount "
		. "\nFROM #__gj_groups a"
		. "\n INNER JOIN #__gj_grcategory b"
		. "\nON a.category = b.id"
		. "\nINNER JOIN #__gj_users c"
		. "\nON a.id = c.id_group"
		. "\nWHERE b.access <= $my->gid"
		. "\nAND b.published=1"
		. "\nAND (LCASE(a.name) LIKE '%$searchstring%'"
		. "\nOR LCASE(a.descr) LIKE '%$searchstring%') AND a.active='1'"
		. "\nGROUP BY a.id, a.name, a.type, a.date_s, a.descr, a.logo, a.user_id"
		. "\nORDER BY a.name"
		. "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;

	$database->setQuery($sql);

	if(ALLOWCREATEGROUPS && ($my->gid !=0)) {
		HTML_wg::showmenu(true);
	} else {
		HTML_wg::showmenu();
	}

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$rows=$database->loadAssocList();
	HTML_wg::errorpage(GJ_SEARCH_RESULTS.' : '.$searchstring, 'info');

	HTML_wg::showcat($rows, false, $pageNav, $searchstring);
}



function showmemberlist() {
	global $my, $database, $_REQUEST, $mainframe, $admin;
	$gid = intval($_REQUEST['groupid']);

	$g = new groupJiveGroup($database);
	$g->load($gid);
	
	if (($g->type == 3) && (!checkuseractive($g->id,$my->id) && !$admin)) {
		HTML_wg::errorpage(GJ_NOTAUTH.'<br/>'.GJ_PLEASE_LOGIN, '', $g->id,'error');
		return;
	} else if (($g->type == 2) && (!checkuser($g->id,$my->id) && !$admin)){
		HTML_wg::errorpage('<a href="'
			. sefRelToAbs("index.php?option=com_groupjive"
			. "&task=sign&groupid=$g->id").'">'
			. GJ_SIGN.'</a>', GJ_ERROR_JOIN_GROUP_L1.'<br/>'.GJ_ERROR_JOIN_GROUP_L2, $g->id,'error');
		return;
	} else if (($g->type == 2) && (!checkuseractive($g->id,$my->id) && !$admin)){
		HTML_wg::errorpage(GJ_PENDING, '', $g->id,'error');
		return;
	}



	$query="SELECT COUNT(*)"
		. "\nFROM #__gj_users as a INNER JOIN #__gj_groups as b"
		. "\nON a.id_group = b.id"
		. "\nINNER JOIN #__gj_grcategory as c"
		. "\nON b.category = c.id"
		. "\nWHERE id_group='$gid' AND status='active'"
		. "\nAND c.published=1 AND c.access <= $my->gid";

	$database->setQuery($query);
	$result = $database->loadResult();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$count = $database->loadResult();
	$limit = intval(mosGetParam( $_REQUEST, 'limit', ONPAGE_MEMBERS ));
	$limitstart = intval(mosGetParam( $_REQUEST, 'limitstart', 0 ));
	$pageNav = new mosPageNav( $count, $limitstart, $limit  );

	$query="SELECT a.*,DATE_FORMAT(date, '$date_format') AS date, "
		. "b.user_id AS creator, d.avatar, e.name, e.username "
		. "FROM #__gj_users as a INNER JOIN #__gj_groups as b "
		. "ON a.id_group = b.id "
		. "INNER JOIN #__gj_grcategory as c "
		. "ON b.category = c.id "
		. "INNER JOIN #__users AS e "
		. "ON a.id_user = e.id "
		. "INNER JOIN #__comprofiler AS d "
		. "ON a.id_user = d.id "
		. "WHERE id_group='$gid' AND status='active' "
		. "AND c.published=1 AND c.access <= $my->gid "
		. "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;

	$database->setQuery($query);
	$usrows=$database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	if (count($usrows)==0) {
		HTML_wg::errorpage(GJ_PAGE_NOT_EX, '', $gid,'error');
		return;
	}


	HTML_wg::member_list($gid, $count, $usrows, $pageNav);
	$mainframe->appendPathWay(GJ_MEMBERS);
}



function getAjaxUserlist() {
	global $database, $my, $mosConfig_live_site;
	$gj_username=utf8_decode(trim(mosGetParam($_REQUEST,'username')))	;
	if($my->gid >= AJAX_ACCESS) {
	  if(REAL_NAMES) {
	    $name = "a.name";
	    $where = "\nWHERE a.name LIKE '%".$gj_username."%'";
	    $where .= "\nOR a.username LIKE '%".$gj_username."%'";
	  } else {
	    $name = "a.username";
	    $where = "\nWHERE a.username LIKE '%".$gj_username."%'";
	  }
	  
		if( isset($_REQUEST['groupid'])) {
			$groupid = $_REQUEST['groupid'];
			$query="SELECT ".$name." AS username, avatar"
				. "\nFROM #__users a"
				. "\nLEFT JOIN #__comprofiler b"
				. "\nON a.id = b.user_id"
				. "\nLEFT JOIN #__gj_users c"
				. "\nON a.id = c.id_user"
			        . $where
				. "\nAND b.approved=1"
				. "\nAND b.confirmed=1"
				. "\nAND c.id_group = '".$groupid."'"
				. "\nAND c.status = 'active'"
				. "\nLIMIT 0,8";
		} else {
			$query="SELECT ".$name." AS username, avatar"
				. "\nFROM #__users a"
				. "\nLEFT JOIN #__comprofiler b"
	 			. "\nON a.id = b.user_id"
				. $where
				. "\nAND b.approved=1"
				. "\nAND b.confirmed=1"
				. "\nLIMIT 0,8";
		}

		$database->setQuery($query);
		$rows=$database->loadObjectList();

		if ($database->getErrorNum()) {
			echo $database->stderr();
			return false;
		}

		if (count($rows)== 0) {
			$content = '<p>'.GJ_NO_USERS_FOUND.'</p>';
		}

		$content .= '<ul style="float:left">';
		foreach($rows as $row) {
			if (file_exists("images/comprofiler/tn".$row->avatar)) {
				$image="images/comprofiler/tn".$row->avatar;
			} else if (substr($row->avatar, 0, 7) == 'gallery' 
						&&	file_exists('images/comprofiler/'.$row->avatar)) {
				$image="images/comprofiler/".$row->avatar;
			}else {
				$image=NOPHOTO;
			}

			$content .= '<li><span onMouseOver="showAvatar(\''
			  .$mosConfig_live_site.'/'.$image
			  .'\');" onMouseOut="hideAvatar();" onClick="fillBox(\'fr_name\', \''
			  .$row->username.'\');" style="cursor:pointer;">'.$row->username.'</span></li>';
		}
		$content .= '</ul><div id="gjavatarbox"><img id="gjavatar" style="float:left;margin-left:10px;padding:5px;"/></div>';
		echo utf8_encode($content);
	} else {
		echo('no access');
	}
	exit;  //sorry, but I have to exit here, cause I only want this specific data
}



function inviteFriend() {
	global $database, $my, $pms, $Itemid, $mosConfig_live_site, $mosConfig_sitename;

	$group_id=intval( mosGetParam( $_POST ,'group_id', -1 ) );
	
	$g = new groupJiveGroup($database);
	$g->load($group_id);

	if (!$g->id) {
		// no group exists with that ID
		mosRedirect( 'index.php?option=com_groupjive&task=sign&groupid='.$group_id.'&Itemid='.$Itemid, GJ_NO_GROUP_WITH_THAT_ID );
	}

	$group_name=stripslashes($g->name);

	$fr_name=addslashes(mosGetParam($_POST,'fr_name',-1));
	$fr_email=addslashes(mosGetParam($_POST,'fr_email',-1));
	$ctime=time();
	$ctime=md5($ctime);

	if (!checkuseractive($group_id,$my->id)) {
		HTML_wg::errorpage(GJ_ONLY_CURRENT, '', $g->id,'error');
		return;
	}

	if(!empty($fr_name)) {
		if(REAL_NAMES) {
			$query="SELECT a.id, a.email, a.name AS username"
				. "\nFROM #__users a"
				. "\nLEFT JOIN #__comprofiler b"
				. "\nON a.id = b.user_id"
				. "\nWHERE a.name='$fr_name'"
				. "\nAND b.approved=1"
				. "\nAND b.confirmed=1"
				. "\nAND a.block=0";
		} else {
			$query="SELECT a.id, a.email, a.username"
				. "\nFROM #__users a"
				. "\nLEFT JOIN #__comprofiler b"
				. "\nON a.id = b.user_id"
				. "\nWHERE a.username='$fr_name'"
				. "\nAND b.approved=1"
				. "\nAND b.confirmed=1"
				. "\nAND a.block=0";
		}

		$database->setQuery($query);
		$rows=$database->loadObjectList();

		if ($database->getErrorNum()) {
			echo $database->stderr();
			return false;
		}

		if(count($rows) == 0) {
			mosRedirect( 'index.php?option=com_groupjive&task=sign&groupid='.$group_id.'&Itemid='.$Itemid, GJ_USER_NOT_EXISTS );		
	 		return;
		}

		$row=&$rows[0];

		if (checkuser($group_id,$row->id)) {
			mosRedirect( 'index.php?option=com_groupjive&task=sign&groupid='.$group_id.'&Itemid='.$Itemid, GJ_USER_IN_GROUP );
			return;
		}

		$query="INSERT INTO #__gj_active(code,too,groups)"
			. "\nVALUES ('$ctime', $row->id ,'$group_id')";
		$database->setQuery($query);

		if(!$result=$database->query()) {
			echo $database->stderr();
			return;
		}

		$query="INSERT IGNORE INTO #__gj_users (id_user,id_group,status,date)"
			. "\nVALUES ('$row->id','$group_id','invited', now())";
		$database->setQuery($query);
		if(!$result=$database->query()) {
			echo $database->stderr();
			return;
		}
		//Send inviting message via PM or e-mail
		notify($group_id, $pms, '', $row->id,"invite", $row, $ctime);
	} elseif(!empty($fr_email)) {
	  if(REAL_NAMES) {
	    $name = $my->name;
	  } else {
	    $name = $my->username;
	  }
	 		//To non-registered friends
		if (JosIsValidEmail( $fr_email )) {
			$message=str_replace("%from_name","<a href=".sefRelToAbs($mosConfig_live_site."/index.php?option=com_comprofiler&task=userProfile&user=$my->id").">".$name."</a>",GJ_INVITE_NONMEMBER);
			$message=str_replace("%i","<a href=".sefRelToAbs($mosConfig_live_site).">".$mosConfig_live_site."</a>",$message);
			$message=str_replace("%group_name","<a href=".sefRelToAbs($mosConfig_live_site."/index.php?option=com_groupjive&task=showgroup&groupid=$group_id").">".$group_name."</a>",$message);
			$message=str_replace("%s","<a href=".sefRelToAbs($mosConfig_live_site).">".$mosConfig_sitename."</a>",$message);
			$message=str_replace("%link","<a href=".sefRelToAbs($mosConfig_live_site."/index.php?option=com_groupjive&task=showgroup&groupid=$group_id").">".$group_name."</a>",$message);
			mosMail($mosConfig_mailfrom, "Group Messenger", $fr_email, GJ_YOU_WAS_INVITED, $message, true);
		} else {
			mosRedirect( 'index.php?option=com_groupjive&task=sign&groupid='.$group_id.'&Itemid='.$Itemid, GJ_NOT_VALID_EMAIL );
			return;
		}
	}

	mosRedirect( 'index.php?option=com_groupjive&task=showgroup&groupid='.$group_id.'&Itemid='.$Itemid, GJ_INVITE_WAS_SENT );
}



function deleteUser($group = 0){
	global $database, $my, $Itemid;

	$ui=mosGetParam($_REQUEST,'userid',-1);
	$t = array();
	preg_match('/task=[a-z0-1_]*&/', GJ_REFERER, $t);
	$ptask = $t[0];

	$query="SELECT id FROM #__gj_users WHERE id_group='$group' AND id_user='$ui'";
	$database->setQuery($query);
	$id = $database->loadResult();

	if($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	if (!$id) {
		mosRedirect( 'index.php?option=com_groupjive&'.$ptask.'groupid='.$group.'&Itemid='.$Itemid,GJ_U_G );
		return false;
	}

	$user = new groupJiveUsers($database);
	$user->load($id);
	if (!$user->delete()) {
		mosRedirect( 'index.php?option=com_groupjive&'.$ptask.'groupid='.$group.'&Itemid='.$Itemid, $user->getError());
	}

	$sql = "DELETE FROM  #__gj_active WHERE too = $ui and groups = $group";
	$database->setQuery($sql);
	$database->query();

	if ($ui == $my->id) {
		mosRedirect( 'index.php?option=com_groupjive&'.$ptask.'groupid='.$group.'&Itemid='.$Itemid,GJ_U_LEFT );
		return true;
	} else {
		mosRedirect( 'index.php?option=com_groupjive&'.$ptask.'groupid='.$group.'&Itemid='.$Itemid,GJ_USER_WAS_DELETED );
		return true;
	}
}


function activateMember($group) {
	global $database, $Itemid, $_REQUEST, $my, $pms;

	if (!$my->id) {
		HTML_wg::errorpage(GJ_NOTAUTH, '', $group,'error');
		return;	
	}

	$code=addslashes(mosGetParam( $_REQUEST ,'code', 0 ));
	
	$query = "SELECT COUNT(id)"
		. "\nFROM #__gj_active"
		. "\nWHERE code='$code'"
		. "\nAND too=$my->id"
		. "\nAND groups='$group'";

	$database->setQuery($query);
	$count = $database->loadResult();

	if($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	if ($count == 0) {
		HTML_wg::errorpage(GJ_INVITE_NOT_EXIST, '', $group,'error');
		return;
	}

	$query = "UPDATE #__gj_users"
		. "\nSET status='active'"
		. "\nWHERE id_group='$group'"
		. "\nAND id_user='$my->id'";

	$database->setQuery($query);
	if(!$result=$database->query()) {
		echo $database->stderr();
		return;
	}

	$query = "DELETE FROM #__gj_active"
		. "\nWHERE code='$code'"
		. "\nAND too='$my->username'";
	$database->setQuery($query);
	if(!$result=$database->query()) {
		echo $database->stderr();
		return;
	}

	if(NOTIFYJOIN) {
		$message = GJ_NEW_MEMBER;
		if (REAL_NAMES) {
			notify($group, $pms, $message, $my->name);
		} else {
			notify($group, $pms, $message, $my->username);
		}
	}

	mosRedirect( 'index.php?option=com_groupjive&'
		. 'task=showgroup&groupid='
		. $group.'&Itemid='
		. $Itemid, GJ_WELCOME );
}



function showInactiveUsers($group) {
	global $database, $my, $admin, $mainframe;

	if (!ismoder($group,$my->id) && !$admin)	{
		HTML_wg::errorpage(GJ_NOT_MODER, '', $group,'error');
		return;	
	}

        //Lets the moderator force an invited member into a group or not
        if(FORCE_INVITE) 
            $and = "\nAND (a.status IN ('inactive', 'need approval', 'invited'))";
        else 
            $and ="\nAND (a.status IN ('inactive', 'need approval'))"; 

	$query="SELECT a.*, b.name, b.username AS uname"
		. "\nFROM #__gj_users AS a INNER JOIN #__users AS b "
		. "\nON a.id_user = b.id "
		. "\nWHERE a.id_group='$group'"
		. $and;
	$database->setQuery($query);

	$rows=$database->loadAssocList();

	for ($i=0, $n=count( $rows ); $i < $n; $i++) {
		if (REAL_NAMES) {
			$rows[$i]['realname'] = $rows[$i]['name'];
		} else {
			$rows[$i]['realname'] = $rows[$i]['uname'];
		}
	}

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	showgroup($group);

	HTML_wg::inactive($rows, $group);
	$mainframe->appendPathWay(GJ_INACTIVE_USERS);
}



function sign ($group) {
	global $database, $my, $pms, $Itemid;
	$query="SELECT a.*, b.access, DATE_FORMAT(a.date_s, '$date_format') AS date_s "
		. "FROM #__gj_groups a INNER JOIN #__gj_grcategory b "
		. "ON a.category = b.id "
		. "WHERE a.id='$group' AND a.active='1'";

	$database->setQuery($query);
	$rows=$database->loadObjectList();

	if($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	if ($database->getAffectedRows($result)==0) {
		HTML_wg::errorpage(GJ_GROUP_NOT_EXISTS, '', $group,'error');
		return;
	}

	$row=&$rows[0];

	if (!$my->id || !($row->access <= $my->gid) ) {
		HTML_wg::errorpage(GJ_NOTAUTH, '', $group,'error');
		return;
	}

	switch($row->type) {
		case 1:
			if (checkuseractive($group,$my->id)) {
				HTML_wg::invite($row);
				return;
			}
			$query="REPLACE INTO #__gj_users (id_user,id_group, date, status) "
				. "VALUES ($my->id,$group, now(), 'active')";
			$database->setQuery($query);
                                           

			if(!$result=$database->query()) {
				echo $database->stderr();
				return;
			}
			if ($database->getAffectedRows()) {

				// NOTIFYJOIN is not ignored but noted in the notify function
				// except for email and clexus - this needs to be done when 
				// the PMS class is working
				// meanwhile this is a workaround (the admin now gets no message)
				if (REAL_NAMES) {
					$name = $my->name;
				} else {
					$name = $my->username;
				}
				if (NOTIFYJOIN){
					notify($group, $pms, GJ_NEW_MEMBER, $name, 'notifyall');
				} else {
					notify($group, $pms, GJ_NEW_MEMBER, $name);
				}
	
				mosRedirect( 'index.php?option=com_groupjive&'
					. 'task=showgroup&groupid='
					. $group.'&Itemid='
					. $Itemid, GJ_WELCOME );
			} else {
                            	mosRedirect( 'index.php?option=com_groupjive&'
					. 'task=showgroup&groupid='
					. $group.'&Itemid='
					. $Itemid, GJ_ALREADY_MEMBER );
			}
			break;

		case '2':
			 if (checkuseractive($group,$my->id)) {
				HTML_wg::invite($row);
				return;
			}

			$query="REPLACE INTO #__gj_users (id_user,username,id_group, "
				. "status) VALUES ('$my->id','$my->username',$group,'need approval')";

			$database->setQuery($query);
			if(!$result=$database->query()) {
				echo $database->stderr();
				return;
			}

			if ($database->getAffectedRows()) {

				// NOTIFYJOIN is not ignored but noted in the notify function
				// except for email and clexus - this needs to be done when 
				// the PMS class is working
				// meanwhile this is a workaround (the admin now gets no message)
				if (REAL_NAMES) {
					$name = $my->name;
				} else {
					$name = $my->username;
				}
				if (NOTIFYJOIN){
						notify($group, $pms, GJ_NEW_MEMBER, $name, 'notifyall');
				} else {
					notify($group, $pms, GJ_NEW_MEMBER, $name);
				}

				HTML_wg::errorpage(GJ_WELCOME2, '', $group,'error');
			} else {
				HTML_wg::errorpage(GJ_ALREADY_MEMBER, '', $group,'info');
			}
			break;

		case '3':
			HTML_wg::invite($row);
			break;
	}
}


/**
 * changes the users status to a specific one
 *  
 * @param integer $uid userid
 * @param integer $group groupid
 * @param text $status status (active, inactive)
 */ 
function changeStatus ($uid, $group, $status) {
	global $database, $my, $admin,$Itemid, $pms;
	if (!ismoder($group,$my->id) && !$admin) {
		HTML_wg::errorpage(GJ_NOT_MODER, '', $group,'error');
		return;	
	}

	$user = new groupJiveUsers($database);
	if (!$user->getUserObject($uid, $group)) {
		HTML_wg::errorpage($user->getError(), '', $group,'error');
	}
	if (!$user->changeUserState($status)) {
		HTML_wg::errorpage($user->getError(), '', $group,'error');
	}

	switch ($status) {
		case 'active':
			$resultmessage = GJ_IS_ACT_NOW;
			if(NOTIFYJOIN) {
				if(REAL_NAMES) {
					$database->setQuery("SELECT name FROM #__users WHERE id='$uid'");
				} else {
					$database->setQuery("SELECT username FROM #__users WHERE id='$uid'");
				}
				$newmember = $database->loadResult();
				$message = GJ_NEW_MEMBER;
				$message=str_replace("%from_name",$newmember,$message);
				notify($group, $pms, $message, $newmember);
			}
			mosRedirect( sefRelToAbs('index.php?option=com_groupjive&task=inactiveusers&groupid='.$group.'&Itemid='.$Itemid),$resultmessage );
			break;
		case 'inactive':
			$resultmessage = GJ_IS_INACT_NOW;
			mosRedirect( sefRelToAbs('index.php?option=com_groupjive&task=member_list&groupid='.$group.'&Itemid='.$Itemid),$resultmessage );
			break;
	}
	
}
?>
