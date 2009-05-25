<?php
/**
 * Groups functions
 */
// defines
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* stores groupinformation
* @param integer $group groupid
*/
// is this really needed? Yes!
if (!defined('GJBASEPATH')){define ( 'GJBASEPATH', 'components/com_groupjive');}
require_once( GJBASEPATH . '/groupjive_func.inc' );

function savegroup($group, $ueConfig) {
	global $database, $admin, $my,$Itemid, $logosize; 
	//Receives info from function editgroup and handles the actual editing of the group
	$g=intval(mosGetParam($_POST,'_i','-1'));
	$n=escapeString(trim(mosGetParam($_POST,'gj_groupname','')));
	$d=escapeString(trim(mosGetParam($_POST,'gj_aboutgroup','')));
	$t=intval(mosGetParam($_POST,'type','-1'));

	if (!ismoder($g,$my->id) && !$admin) {
		HTML_wg::errorpage(GJ_NOT_MODER, '', $g,'error');
		return;	
	}

	if (empty($n)) {
		HTML_wg::errorpage(GJ_FILL_REQ, '', $g,'error');
		return;	
	}

	$error = '';
	if( $_FILES['image_file']['size'] > 0 ) {
		$imgToolBox = new imgToolBox();
		$imgToolBox->_conversiontype=$ueConfig['conversiontype'];
		$imgToolBox->_IM_path = $ueConfig['im_path'];
		$imgToolBox->_NETPBM_path = $ueConfig['netpbm_path'];
		$imgToolBox->_maxsize = $ueConfig['avatarSize'];
		$imgToolBox->_maxwidth = $logosize;
		$imgToolBox->_maxheight = $logosize;
		$imgToolBox->_debug = 0;

		foreach(glob(JPATH."/images/com_groupjive/".$g.".*") as $fn) {
			if (file_exists($fn)) {
				unlink($fn); 
			}
		}
		
		if( ! $newFileName = $imgToolBox->processImage( $_FILES['image_file'], $g, JPATH."/images/com_groupjive/", 0, 0, 1 ) ) {
			$error = "<br/>The following error occured while processing your request: ";
			$error.= $imgToolBox->_errMSG . "";
		}
		$query="UPDATE #__gj_groups "
			. "SET name='$n', descr='$d', type='$t', logo='$newFileName' "
			. "WHERE id='$g'";
			
		$database->setQuery($query);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		}
	} else {
		$database->setQuery("UPDATE #__gj_groups SET name='$n', descr='$d', type='$t' WHERE id='$g'");
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		}
	}

	if(JB) {
        $sql = "UPDATE #__".PREFIX."_categories a"
            . "\nINNER JOIN #__gj_jb b"
            . "\nSET a.name = '$n'"
            . "\nWHERE a.id = b.category_id"
            . "\nAND b.group_id = '$g'";
		$database->setQuery($sql);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		}
	}
	
	if (EVENTLIST) {
        $sql = "UPDATE #__eventlist_categories a"
            . "\nINNER JOIN #__gj_eventlist b"
            . "\nSET a.catname = '$n',"
            . "\na.catdescription = '$d'"
            . "\nWHERE a.id = b.category_id"
            . "\nAND b.group_id = '$g'";
		$database->setQuery($sql);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		}
	}

	//HTML_wg::errorpage(GJ_GROUP_INFO_WAS_EDITED);
	if ($error) {
		mosRedirect( 'index.php?option=com_groupjive'
		. '&task=editgroup&Itemid='.$Itemid.'&groupid='.$g, $error );
	} else {
		$url = "index.php?option=com_groupjive"
			. "&task=showgroup&Itemid=".$Itemid."&groupid=".$g;
		mosRedirect($url, GJ_GROUP_INFO_WAS_EDITED );
	}
}

/**
* shows an editform for a group
* @param integer $group groupid
*/
function editgroup($group) {
	global $database, $my, $admin, $mainframe;
	//this will allow you to edit the information regarding the group... Even the name...
	if (!ismoder($group,$my->id) && !$admin)	{
		HTML_wg::errorpage(GJ_NOT_MODER, '', $group,'error');
		return;	
	}

	$query="SELECT a.id, a.name, a.descr, a.type, a.user_id, "
		. "b.create_open, b.create_closed, b.create_invite "
		. "FROM #__gj_groups as a, #__gj_grcategory as b "
		. "WHERE a.id='$group' AND b.id=a.category AND b.published=1 AND active='1'";
	$database->setQuery($query);

	$rows=$database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	};

	if ($database->GetAffectedRows() == 0) {
		HTML_wg::errorpage(GJ_GROUP_NOT_EXISTS, '', $group,'error');
		return;
	}

	HTML_wg::editgroup($rows);
	$mainframe->appendPathWay(GJ_EDIT_GROUP_INFO);
}

/**
* deletes a specific group
* @param integer $group groupid
*/
function deletegroup($group) {
	global $database, $my, $admin, $Itemid;
	//Because DeleteGroup handler was in URL go ahead and delete
	// the group..
	//By the way $exgroup is the variable with the group ID in it CHEERS

	if (!ismoder($group,$my->id) && !$admin) {
		HTML_wg::errorpage(GJ_NOT_MODER, '', $group,'error');
		return;	
	}

	$g = new groupJiveGroup($database);
	$g->load($group);

	// delete images
	foreach(glob(JPATH."/images/com_groupjive/".$group.".*") as $fn) {
		if (file_exists($fn)) {
			unlink($fn); 
		}
	}
	foreach(glob(JPATH."/images/com_groupjive/tn".$group.".*") as $fn) {
		if (file_exists($fn)) {
			unlink($fn); 
		}
	}

	if ($g->deleteAll()) {
		$state = GJ_GROUP_WAS_DELETED;
	} else {
		$state = "Error: ".$g->getError;
	}

	mosRedirect( 'index.php?option=com_groupjive&Itemid='.$Itemid, $state);
}

/**
* shows a specific group
* @param integer $gid groupid
*/
function showgroup($gid, $size='') {
	global $my,$database,$mosConfig_live_site, $date_format, 
		$Itemid, $admin, $mainframe, $mypic, $mosConfig_lang;

	$mainframe->addCustomHeadTag('<script src="'.$mosConfig_live_site
			. '/components/com_groupjive/js/functions.js" type="text/javascript"></script>');

	//	if(JB) {
		
	$query="SELECT a.*, a.name AS groupname, DATE_FORMAT(date_s, '$date_format') AS date_s, "
			. "b.catname, b.id AS catid, "
			. "c.category_id, d.name, e.category_id AS category_id_el " 
			. "FROM #__gj_groups as a INNER JOIN #__gj_grcategory AS b "
			. "ON a.category = b.id "
			. "INNER JOIN #__users as d "
			. "ON a.user_id = d.id "
			. "LEFT JOIN #__gj_jb as c "
			. "ON a.id = c.group_id "
			. "LEFT JOIN #__gj_eventlist as e "
			. "ON a.id = e.group_id "	               
			. "WHERE a.id='$gid' AND a.active='1' AND b.access <=$my->gid";
		
		/*	} else {
		$query="SELECT a.*, a.name AS groupname, DATE_FORMAT(date_s, '$date_format') AS date_s, c.name, "
			. "b.id AS catid, b.catname"
			. "\nFROM #__gj_groups AS a INNER JOIN #__gj_grcategory AS b "
			. "ON a.category = b.id "
			. "INNER JOIN #__users as c "
			. "ON a.user_id = c.id "	  
			. "WHERE a.id='$gid' AND a.active='1' AND b.access <= $my->gid";
			}*/

	$database->setQuery($query);
	$rows=$database->loadObjectList();
	if($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	$exist = $database->getAffectedRows($result);
	if ((!$exist) || ($exist!=1)) {
		HTML_wg::errorpage(GJ_GROUP_NOT_EXISTS, '', $group,'error');
		return;
	}

	$row=&$rows[0];

	// check if new users joined the group, whom need to activate
	$newusers ='';
	if ($row->user_id == $my->id) {
		$query="SELECT COUNT(*) FROM #__gj_users "
			. "WHERE id_group =$gid AND status = 'need approval'";

		$database->setQuery($query);
		$countusers = $database->loadResult();

		if ($countusers > 0 ) {
			$mainframe->addCustomHeadTag('<script type="text/javascript">alert(\''.GJ_NEW_USERS_NEED_ACTIVATION.'\')</script>');
			echo  '<p><a href="index.php?option=com_groupjive&'
				. 'task=inactiveusers&groupid='.$gid.'&Itemid='.$Itemid
				. '">'.GJ_NEW_USERS_NEED_ACTIVATION.'</a></p>';
		}
	}

	$query="SELECT avatar FROM #__comprofiler WHERE id=".$row->user_id;
	$database->setQuery($query);
	$founder = $database->loadResult();

	if (file_exists('images/comprofiler/tn'.$founder) && (!PIC2PIC || (PIC2PIC && $mypic))) {
		$image='images/comprofiler/tn'.$founder;
	} else if( file_exists('images/comprofiler/tn'.$founder) && PIC2PIC && !$mypic) {
		if (file_exists('components/com_comprofiler/images/'.$mosConfig_lang.'/tnnophoto.jpg')) 
		$image='components/com_comprofiler/images/'.$mosConfig_lang.'/tnnophoto.jpg';
		else $image='components/com_comprofiler/images/english/tnnophoto.jpg';
	} else if (substr($founder, 0, 7) == 'gallery' && file_exists('images/comprofiler/'.$founder)) {
		$image='images/comprofiler/'.$founder;
	} else {
			$image=NOPHOTO;
	}

	$image = '<img src="'.$image.'" alt="'.$row->creator.'"/>';

	// types --> 1: GJ_OPEN   2: GJ_APREQUIRED  3: GJ_PRIVATE
	$actions = '<ul id="gj_list_standard_funcs">';

	if (($row->type == 3) && (!checkuseractive($row->id,$my->id) && !$admin)) {
		HTML_wg::errorpage(GJ_NOTAUTH.'<br/>'.GJ_PLEASE_LOGIN, '', $row->id,'error');
	} else if (($row->type == 2) && (!checkuser($row->id,$my->id) && !$admin)){
		HTML_wg::errorpage('<a href="'
			. sefRelToAbs("index.php?option=com_groupjive"
			. "&task=sign&groupid=$row->id").'">'
			. GJ_SIGN.'</a>', GJ_ERROR_JOIN_GROUP_L1.'<br/>'.GJ_ERROR_JOIN_GROUP_L2, $row->id,'error');
	} else if (($row->type == 2) && (!checkuseractive($row->id,$my->id) && !$admin)){
		HTML_wg::errorpage(GJ_PENDING, '', $row->id,'error');
	} else {
		if(!checkuser($row->id,$my->id)) {
			$actions .= '<li><a href="'
				. sefRelToAbs("index.php?option=com_groupjive"
				. "&task=sign&groupid=$row->id&"
				. "Itemid=$Itemid").'">'.GJ_SIGN.'</a></li>';
		} elseif(checkuseractive($row->id,$my->id)) {
			$actions .= '<li><a href="'
				. sefRelToAbs("index.php?option=com_groupjive"
				. "&task=sign&groupid=$row->id&"
				. "Itemid=$Itemid").'">'.GJ_INVITE.'</a></li>';
			if (!ismoder($gid,$my->id)) {
				$actions .= '<li><a href="'
					. sefRelToAbs("index.php?option=com_"
					. "groupjive&task=delete&groupid=$gid&"
					. "userid=$my->id&Itemid=$Itemid")
					. '" onclick="return confirm(\''
					. GJ_DELETE_SELF_CONFIRM .'\')">'
					. GJ_LEAVE_GROUP.'</a></li>';
			}
		$actions .= '<li><a href="'
              . sefRelToAbs("index.php?option=com_groupjive&task="
              . "mailowner&groupid=$row->id&Itemid=$Itemid")
              . '">'.GJ_MAIL_OWNER.'</a></li>';

		} else {
		// occurs when admin is viewing a group without being a member
		// HTML_wg::errorpage("this shouldn't happen..", '', $row->id,'error');
		}

		$actions .= '</ul>';
		if (ismoder($row->id,$my->id) || $admin) {
			$moderator_func = moderator_func($row);
		} else {
			$moderator_func = "";
		}
	
		if((!empty($row->logo)) 
			&& ($row->logo != '0') 
			&& (file_exists("images/com_groupjive/".$row->logo))) {
	
			$c = filemtime ("images/com_groupjive/".$row->logo);
			$logo .= '<img align="left" src="'.$mosConfig_live_site
				. '/images/com_groupjive/'.$row->logo
				. '?ac='.$c.'" alt="'.stripslashes($row->groupname).'" />';
		} else {
			$logo .= '<img align="left" src="'.$mosConfig_live_site
				. '/images/com_groupjive/'.DEFAULT_LOGO
				. '" alt="default logo" />';
		}

		HTML_wg::showGroup($row, $newusers, $logo, $image, $actions, $moderator_func, $size);

		$mainframe->appendPathWay("<a href=\"index.php?option=com_groupjive&task=showcat&id=$row->catid&Itemid=$Itemid\">$row->catname</a>");

		if($_REQUEST['task'] == 'showgroup') {
			main_page($row);
			$mainframe->appendPathWay(stripslashes($row->groupname));
		} else {
			$mainframe->appendPathWay("<a href=\"index.php?option=com_groupjive&task=showgroup&groupid=$row->id&Itemid=$Itemid\">".stripslashes($row->groupname)."</a>");
		}
	}
}

/**
* adds a new group
* 
*/
function addnewgroup($ueConfig, $name,$descr,$type,$cat,$image_file,$adminmail, $sendadminemail) {
	global $my,$database,$mosConfig_mailfrom;
	global $jb_cat, $logosize, $Itemid;

	if (!$my->id) {
		HTML_wg::errorpage(GJ_NOTAUTH, '', $group,'error');
		return;	
	}

	$sql = "SELECT *"
		."\nFROM #__gj_grcategory"
		."\nWHERE access <= $my->gid"
		."\nAND published=1 ";
	$database->setQuery($sql);
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$rows=$database->loadObjectList();
	//If the options are set to send emails on group creation then
	//$sendadminemail will equal 1

	if (empty($name) || empty($type)) {
		HTML_wg::newgroup($rows,$name,$descr,GJ_FILL_REQ);
		return;
	}

	$query = "SELECT COUNT(*) FROM #__gj_groups WHERE name='".escapeString($name)."'";
	$database->setQuery( $query );

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$count=$database->loadResult();
	if ($count != 0) {	
		HTML_wg::newgroup($rows,$name,$descr,GJ_GROUPNAME_EXISTS);
		return;
	} else {
		$creator=$my->username;
		if (NEEDAPPROVAL) { 
			$awqw=0;
		} else {
			$awqw=1;
		}

		$query="INSERT INTO #__gj_groups ("
			. "name, "
			. "descr, "
			. "date_s, "
			. "type, "
			. "creator, "
			. "user_id, "
			. "active, "
			. "category) "
			. "VALUES ('"
			. escapeString($name)."','"
			. escapeString($descr)."', "
			. "now(),'"
			. $type."','"
			. $creator."','"
			. $my->id."','"
			. $awqw."','"
			. $cat."')";

		$database->setQuery($query);
		if (!$database->query()) {
			echo $database->stderr();
			return false;
		}
		$lastid=$database->insertid();

		$error = '';
		if( $image_file['size'] > 0 ) {
			$imgToolBox = new imgToolBox();
			$imgToolBox->_conversiontype=$ueConfig['conversiontype'];
			$imgToolBox->_IM_path = $ueConfig['im_path'];
			$imgToolBox->_NETPBM_path = $ueConfig['netpbm_path'];
			$imgToolBox->_maxsize = $ueConfig['avatarSize'];
			$imgToolBox->_maxwidth = $logosize;
			$imgToolBox->_maxheight = $logosize;
			$imgToolBox->_debug = 0;

			if( ! $newFileName = $imgToolBox->processImage( $image_file, $lastid, JPATH."/images/com_groupjive/", 0, 0, 1 ) ) {
				$error = "<br/>The following error occured while processing your request:<br/>\n";			
				$error .= $imgToolBox->_errMSG . "<br/>\n";
			}
		}

		$query="UPDATE #__gj_groups SET logo='".$newFileName."' WHERE id='".$lastid."'"; 
		$database->setQuery($query);
		if (!$database->query()) {
			echo $database->stderr();
			return false;
		}

		$query="INSERT "
			. "\nINTO #__gj_users (id_user,username,id_group,date, status)"
			. "\nVALUES ('$my->id','".escapeString($my->username)."',"
			. "\n'$lastid', now(), 'active')";
		$database->setQuery($query);
		if (!$database->query()) {
			echo $database->stderr();
			return false;
		}

		if(JB) {
			//Joomlaboard or Fireboard integration
			$query="INSERT INTO #__".PREFIX."_categories"
				. "\n(parent, name, cat_emoticon, "
				. "\nlocked, alert_admin, moderated,"
				. "\nmoderators, pub_access, pub_recurse,"
				. "\nadmin_access, admin_recurse, ordering,"
				. "\nfuture2, published, checked_out,"
				. "\nchecked_out_time, review, hits, "
				. "\ndescription, headerdesc, class_sfx,"
				. "\nid_last_msg, numTopics, numPosts,"
				. "\ntime_last_msg)"
				. "\nVALUES"
				. "\n('$jb_cat', '".escapeString($name)."', 0,"
				. "\n0, 0, 1,"
				. "\n$my->id, 0, 0,"
				. "\n0, 0, 1,"
				. "\n0, 0, 0,"
				. "\nnow(), 0, 0,"
				. "\n'', '', '',"
				. "\n'0', '0', '0',"
				. "\nNULL)";
			$database->setQuery($query);
			if (!$database->query()) {
				echo $database->stderr();
				return false;
			}
			$lastid_sb=$database->insertid();

			$query="INSERT INTO #__gj_jb (group_id, category_id) VALUES ($lastid, $lastid_sb)";
			$database->setQuery($query);
			if (!$database->query()) {
				echo $database->stderr();
				return false;
			}

			$query="INSERT INTO #__".PREFIX."_moderation (catid, userid) VALUES ($lastid_sb, $my->id)";
			$database->setQuery($query);
			if (!$database->query()) {
				echo $database->stderr();
				return false;
			}

			$query="UPDATE #__".PREFIX."_sessions SET allowed='na'";
			$database->setQuery($query);
			if (!$database->query()) {
				echo $database->stderr();
				return false;
			}
		}

		if(EVENTLIST) {
		  $database->setQuery("SELECT category_id FROM #__gj_eventlist WHERE group_id=$g_id");
		  $cat_id_eventlist = $database->loadResult();
		  if(!$cat_id_eventlist) {
		    $query = "INSERT INTO #__eventlist_categories (catname, catdescription, image, publishedcat, checked_out, checked_out_time, access, ordering) VALUES ('".$name."', '".$descr."', '', '0', '0', '', '0', '')";
		    $database->setQuery($query);
		    $database->query();
		    
		    $lastid_el=$database->insertid();
		    $query="INSERT INTO #__gj_eventlist (group_id, category_id) "
		      . "VALUES ($lastid, $lastid_el)";
		    $database->setQuery($query);
		    $database->query();
		  }
		  
		}
	}

		//    HTML_wg::groupcreated(NEEDAPPROVAL);

		if ($sendadminemail =='1') {
			//send email to admin
			$message= GJ_NEWGROUPCREATED;
			mosMail($mosConfig_mailfrom, "Admin Groups Messenger", $adminmail, "New Group Waiting For Approval", $message);
		}

		if (NEEDAPPROVAL) {
			mosRedirect( 'index.php?option=com_groupjive'
				. '&Itemid='.$Itemid, 
				GJ_GROUP_WAS_CREATED_APP.$error );
		} else {
			mosRedirect( 'index.php?option=com_groupjive'
				. '&task=showgroup&groupid='.$lastid.'&Itemid='.$Itemid, 
				GJ_GROUP_WAS_CREATED.$error );
		}
}


/**
* shows new group form
*/
function createnewgroup() {
	global $mainframe,$my,$database;

	if (!$my->id) {
		HTML_wg::errorpage(GJ_NOTAUTH);
		return;	
	}

	$query="SELECT *"
		. "\nFROM #__gj_grcategory"
		. "\nWHERE access <= $my->gid"
		. "\nAND published=1"
		. "\nORDER BY catname";
	$database->setQuery($query);
	$rows=$database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}
	
	HTML_wg::newgroup($rows);
}

function showMailForm($type, $option, $gid, $message='', $subject='', $body='', $copy=true, $showgroup=true){
	global $mainframe, $mosConfig_live_site, $database, $Itemid;
	
	HTML_wg::showMailForm($type, $gid, $subject, $body, $copy, $message, $showgroup);

	$sql = "SELECT a.name AS groupname, a.id, b.catname, b.id AS catid FROM #__gj_groups AS a"
	."\nINNER JOIN #__gj_grcategory AS b"
	."\nON a.category = b.id"
	."\nWHERE a.id = ".$gid;
	$database->setQuery($sql);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
	echo $database->stderr();
	return false;
	}

	$row = $rows[0];
  	
	if($type == 'mailgroup') $mainframe->appendPathWay(GJ_MAIL_GROUP);
	if($type == 'mailowner') {
	$mainframe->appendPathWay("<a href=\"index.php?option=com_groupjive&task=showcat&id=$row->catid&Itemid=$Itemid\">$row->catname</a>");
	 $mainframe->appendPathWay("<a href=\"index.php?option=com_groupjive&task=showgroup&groupid=$row->id&Itemid=$Itemid\">".stripslashes($row->groupname)."</a>");
	$mainframe->appendPathWay(GJ_MAIL_OWNER);	
}
}

function mailgroup ($option, $gid, $task) {
	global $database, $Itemid, $my;

	$copy = mosGetParam($_POST, 'copy', '');
	$subject = mosGetParam($_POST, 'subject', '');
	$body = mosGetParam($_POST, 'body', '');

	$subject = stripslashes( strval( $subject));
	$body = stripslashes( strval( $body));

	$group = new groupJiveGroup($database);
	$group->load($gid);

	if (!$subject) {
		$error[] = GJ_MAIL_NO_SUBJECT;
	}
	if (!$body) {
		$error[] = GJ_MAIL_NO_BODY;
	}

	if ($task =='mailgroupowner') {
		$showgroup=false;
		$type = 'mailowner';
	} else {
		$showgroup=true;
		$type = 'mailgroup';
	}

	if (isset($error)) {
		showMailForm($type, $option, $gid, implode('<br/>', $error), $subject, $body, $copy, $showgroup);
		return;
	}

	if ($task =='mailgroupowner') {
//	echo("owner");
		$subject = $subject;

		if (mailToGroupMember($my->id, $group->user_id, $gid, $body, $subject)) {
			$res = GJ_MAILS_WERE_SENT;
		} else {
			$res = GJ_MAILS_WERE_NOT_SENT;
		}
		mosRedirect( 'index.php?option=com_groupjive'
			. '&task=showgroup&Itemid='.$Itemid.'&groupid='.$gid, $res );
	} else {
		if (!$group->getUsersOfGroup()) {
			HTML_wg::errorpage("error:".$group->getError(), '', $group->id,'error');
			return;
		}
		
		foreach ($group->users as $user) {
		if (!($copy!='on' && $my->id == $user->id_user)) {
			mailToGroupMember($my->id, $user->id_user, $gid, $body, $subject);
		}
		}
		mosRedirect( 'index.php?option=com_groupjive'
			. '&task=showgroup&Itemid='.$Itemid.'&groupid='.$gid, GJ_MAILS_WERE_SENT );
	}
}


function mailToGroupMember($fromId, $toId, $groupId, $body, $subject) {
	global $database;
	$from = new mosUser($database);
	$from->load($fromId);

	$to = new mosUser($database);
	$to->load($toId);

	// realnames or nickname
	if(REAL_NAMES) {
		$fromname = $from->name;
	} else {
		$fromname = $from->username;
	}
	return mosMail( $from->email, $fromname, $to->email, $subject, $body);
}
?>
