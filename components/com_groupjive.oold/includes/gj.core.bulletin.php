<?php
/**
 * Bulletin functions
 */
// defines
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

switch($task) {
	// bulletin
	case 'bulletin':
		showbulletin();
		break;

	case 'editpost':
		editpost($exgroup);
		break;

	case 'savepost':
		savepost($exgroup);
		break;

	case 'deletepost':
		$postid=intval(mosGetParam($_REQUEST,'postid',-1));
		deletepost($postid);
		break;

	case 'archive':
		showArchive($exgroup);
		break;

	case 'addpost':
		addpost();
		break;

	case 'showfullmessage':
		showFullMessage($exgroup);
		break;
}
/**
* shows the bulletin archive of a group
* @param integer $group groupid
*/
function showArchive($group) {
	global $database, $my;

	$query="SELECT COUNT(*) FROM #__gj_groups as a "
		. "INNER JOIN #__gj_grcategory as b ON a.category = b.id "
		. "WHERE b.access <= $my->gid AND a.id='$group' AND b.published=1 AND active='1'";

	$database->setQuery($query);

	if ($database->loadResult() == 0) {
		HTML_wg::errorpage(GJ_GROUP_NOT_EXISTS, '', $group,'error');
		return;
	}

	$sql = "SELECT COUNT(*) FROM #__gj_bul "
		. "\nWHERE group_id='$group' ";
	$database->setQuery($sql);

	$limit = intval(mosGetParam( $_REQUEST, 'limit', _GJ_CONF_ONPAGE ));
	$limitstart = intval(mosGetParam( $_REQUEST, 'limitstart', 0 ));
	$pageNav = new mosPageNav( $database->loadResult(), $limitstart, $limit  );

	if(REAL_NAMES) {
	  $name = "u.name";
	} else {
	  $name = "u.username";
	}

	$query="SELECT a.*, ".$name." AS author_name FROM #__gj_bul AS a"
	        . "\nINNER JOIN #__users AS u"
                . "\nON a.author_id = u.id"
		. "\nWHERE group_id='$group' "
		. "\nORDER BY id DESC"
		. "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;

	$database->setQuery($query);

	if ($database->getAffectedRows($result)==0) {
		HTML_wg::errorpage(GJ_PAGE_NOT_EX, '', $group,'error');
		return;
	}

	$usrows=$database->loadObjectList();

	$database->setQuery("SELECT COUNT(*) FROM #__gj_bul WHERE group_id='$group'");
	if (!$result=$database->query()) {
		echo $database->stderr();
		return;
	}

	HTML_wg::archive($usrows,$database->loadResult(), $group, $pageNav);
}

/**
* shows the bulletin message of a group
* @param integer $group groupid
*/
function showFullMessage($group) {
	global $database, $date_format;
	$idm=mosGetParam($_REQUEST,'idm',-1);

	if(REAL_NAMES) {
		$name = "u.name";
	} else {
		$name = "u.username";
	}

	$query="SELECT b.* ,DATE_FORMAT(date_bul, '$date_format') AS date_bul, "
		. "\n".$name." AS username "
		. "\nFROM #__gj_bul AS b"
		. "\nLEFT JOIN #__users AS u ON b.author_id = u.id"
		. "\nWHERE b.id='$idm' AND group_id='$group'";
	$database->setQuery($query);
	$da=$database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	};

	if (!$database->getAffectedRows($result)) {
		HTML_wg::errorpage(GJ_MESSAGE_NOT_EXISTS, '', $group,'error');
		return ;
	}

	HTML_wg::showfullmessage($da);
}

/**
* adds a post to a group
* @param integer $group groupid
*/
function addpost(){
	global $database, $Itemid, $my, $pms, $mosConfig_live_site;

	$bul = new groupJiveBulletin($database);

	// bind it to the table
	if (!$bul->bind($_POST)) {
		echo "<script> alert('"
		.$bul -> getError()
		."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (!checkuseractive($bul->group_id, $my->id)) {
		HTML_wg::errorpage(GJ_ONLY_MEMBERS_CAN_POST, '', $bul->group_id,'error');
		return;
	}

	if(WYSIWYG) {
		$post=mosGetParam($_POST,'message','', _MOS_ALLOWHTML);
	} else {
		$post=mosGetParam($_POST,'message','');
	}

	$subject=mosGetParam($_POST,'subject','');
	$post=trim($post);
	$post=nl2br($post);
	$post=stripslashes($post);

	$bul->post = $post;
	$bul->author_name = $my->username;
	$bul->author_id = $my->id;
	$bul->date_bul = date("Y-m-d H:i:s");

	if (empty($bul->post) || empty($bul->subject)) {
		HTML_wg::errorpage(GJ_FILL_REQ);
		return;
	}

	$bul->store();

	$group = new groupJiveGroup($database);
	$group->load($bul->group_id);

	// notification

	// notes: needs some testing (maybe format is not ok)
	// $message needs to be checked if inserted into Database, cause $post is not checked
	$message=str_replace("%p",$post,GJ_NEW_BUL);
	if (NOTIFY) {
		notify($bul->group_id, $pms, $message, $my->username, 'notifyall');
	} else {
		notify($bul->group_id, $pms, $message, $my->username);
	}

	mosRedirect('index.php?option=com_groupjive&'
		.'task=bulletin&groupid='.$bul->group_id.'&Itemid='.$Itemid, GJ_MESSAGE_WAS_ADDED );
}


/**
* deletes a specific post
* @param integer $postid postid
*/
function deletepost($postid) {
	global $database, $my, $admin;

	// get bulletin object
	$bul = new groupJiveBulletin($database);
	if (!$bul -> load($postid)) {
		HTML_wg::errorpage(GJ_MESSAGE_NOT_EXISTS);
		return;
	}

	// check if user is allowed to delete
	if ($bul->author_id != $my->id && !$admin && !ismoder($bul->group_id,$my->id)) {
		HTML_wg::errorpage(GJ_NOT_MODER, '', $bul->group_id,'error');
		return;
	}

	if ($bul->delete($postid)) {
		HTML_wg::errorpage(GJ_MES_WAS_DELETED, '', $bul->group_id,'error');
	} else {
		HTML_wg::errorpage(GJ_MES_COULD_NOT_DELETED, '', $bul->group_id,'error');
	}
}

/**
* stores a specific post
* @param integer $group group
*/
function savepost($group){
	global $database, $my, $admin, $Itemid;

	// this is called to save the edited post
	$g=intval(mosGetParam($_POST,'_g',-1));
	$i=intval(mosGetParam($_POST,'_i',-1));

	$bul = new groupJiveBulletin($database);
	$bul->load($i);

	if (!ismoder($g,$my->id) && !$admin && !$my->id == $bul->author_id)	{
		HTML_wg::errorpage(GJ_NOT_MODER, '', $group,'error');
		return;
	}

	$subject = trim(mosGetParam($_POST,'subject',''));

	if(WYSIWYG) {
		$textpost=mosGetParam($_POST,'message','', _MOS_ALLOWHTML);
	} else {
		$textpost=trim(mosGetParam($_POST,'message',''));
	}

	if (empty($textpost)) {
		HTML_wg::errorpage(GJ_FILL_REQ, '', $group,'error');
		return;
	}

	$textpost=trim($textpost);
	//     $textpost=htmlspecialchars($textpost);
	$textpost=escapeString(nl2br($textpost));

	$query = "UPDATE #__gj_bul"
		. "\nSET post='$textpost',"
	        . "\nsubject='$subject'"
		. "\nWHERE id='$i'"
		. "\nAND group_id='$g'";
	$database->setQuery($query);
	if(!$result=$database->query()) {
		echo $database->stderr();
		return;
	}

	mosRedirect('index.php?option=com_groupjive&task=bulletin&groupid='.$g.'&Itemid='.$Itemid, GJ_MES_WAS_EDITED);
}

/**
* shows an edit form for a specific message
* @param integer $group group
*/
function editpost($group){
	global $database, $my, $admin;

	//This function is only visible in the "Archive" for the Bulletin
	//Will allow you to edit and delete bulletins :)
	$postid=intval(mosGetParam($_REQUEST,'postid',-1));

	// get bulletin object
	$bul = new groupJiveBulletin($database);
	if (!$bul -> load($postid)) {
		HTML_wg::errorpage(GJ_MESSAGE_NOT_EXISTS);
		return;
	}

	if (!ismoder($bul->group_id,$my->id) && !$admin  && ($my->id != $bul->author_id) ) {
	HTML_wg::errorpage(GJ_NOT_MODER, '', $bul->group_id,'error');
	return;
}

          //Turn the object into an array
        $arr = get_object_vars($bul);
	HTML_wg::editpost($arr);
}


/**
* shows a bulletin overview
*/
function showbulletin(){
	global $my, $database, $date_format;
	$gid = intval($_REQUEST['groupid']);

	if(REAL_NAMES) {
	  $name = "d.name";
	} else {
	  $name = "d.username";
	}

	$query = "SELECT a.*, DATE_FORMAT(date_bul, '$date_format') AS date_bul, ".$name." AS author_name "
		. "FROM #__gj_bul as a "
		. "INNER JOIN #__gj_groups as b ON a.group_id = b.id "
		. "INNER JOIN #__gj_grcategory as c ON b.category = c.id "
		. "INNER JOIN #__users as d ON a.author_id = d.id "
		. "WHERE group_id = '$gid' "
		. "AND c.access <= $my->gid "
		. "AND c.published=1 "
		. "ORDER BY a.id DESC  LIMIT ".BLOGM;

	$database->setQuery($query);
	$blogrows=$database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	HTML_wg::bulletin($gid, $blogrows);
}


?>
