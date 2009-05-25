<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!defined('JPATH')) define ('JPATH', $mainframe->getCfg('absolute_path'));

if (file_exists(JPATH.'/components/com_groupjive/language/'.$mosConfig_lang.'.php'))
{
  include_once(JPATH.'/components/com_groupjive/language/'.$mosConfig_lang.'.php');
} else {
  include_once(JPATH.'/components/com_groupjive/language/english.php');
}

require_once(JPATH.'/components/com_groupjive/groupjive.html.php');
require_once(JPATH.'/administrator/components/com_groupjive/groupjive.class.php');
require_once(JPATH."/components/com_groupjive/helpers.php");

// we can use this to assign defaults to unknown configuration settings
$options = new groupJiveOptions($database);
$gj_params = $options->getAll();

define('_GJ_CONF_BULLETIN', mosGetParam( $gj_params, 'bulletin', 1));
define('_GJ_CONF_JOMCOMMENT', mosGetParam( $gj_params, 'jomcomment', 0));
define('_GJ_CONF_COUNT_FORUM_POSTS', mosGetParam( $gj_params, 'jb_count', 5));
define('_GJ_CONF_ONPAGE', mosGetParam( $gj_params, 'onpage', 20)); //number of groups on page
define('_GJ_CONF_COUNT_EVENTS', mosGetParam( $gj_params, 'el_count', 5 ));
define ('ONPAGE_MEMBERS', mosGetParam( $gj_params, 'onpage_members', 5 )); //number of users on page
define('BLOGM', mosGetParam( $gj_params,'blogm' ));//number message on group frontpage
define ('NOPHOTO', mosGetParam( $gj_params, 'nophoto' )); //This is the URL of the image used for user who have no image :)
define ('ADMINEMAIL',  mosGetParam( $gj_params, 'admin_email' )); //This is the email address of the admin for Notifications
define ('SEND_ADMIN_EMAILS', mosGetParam( $gj_params, 'send_admin_emails', 1 )); 
define ('ALLOWCREATEGROUPS', mosGetParam( $gj_params,'create_groups', 1 ));
define('NEEDAPPROVAL', mosGetParam( $gj_params, 'approval', 1 ));// write 1 - to approval, or 0 - group will not premoderated
define('NOTIFY',  mosGetParam( $gj_params, 'notify', 0));
define('NOTIFYJOIN', mosGetParam( $gj_params, 'notifyjoin', 0 ));
define('VERSION',mosGetParam( $gj_params, 'version', 1 ));
define('JB',  mosGetParam( $gj_params, 'jb', 0 ));
//If we are using the forum integration, are we using Joomlaboard or Fireboard?
if(JB) {
if (file_exists('components/com_fireboard/fireboard.php')) {
  define('PREFIX','fb');
  define('FORUMPATH','com_fireboard');
 } else {
  define('PREFIX','sb');
  define('FORUMPATH','com_joomlaboard');
 }
 }
define('EVENTLIST', mosGetParam( $gj_params, 'eventlist', 0 ));
define('WYSIWYG', mosGetParam( $gj_params, 'wysiwyg', 0 ));//Use the global wysiwyg editor if true
define('DEFAULT_LOGO', mosGetParam( $gj_params, 'nophoto_logo' ));
define('NONREG', mosGetParam( $gj_params, 'nonreg', 0 ));
define('REAL_NAMES', mosGetParam( $gj_params, 'real_names', 0 ));
define('BUL_CREATOR', mosGetParam( $gj_params, 'bul_creator', 0 ));
define('HIDEPRIVATE', mosGetParam( $gj_params, 'hideprivate', 0 ));
define('WYSIWYG_WIDTH', mosGetParam( $gj_params, 'wysiwyg_width' ));
define('WYSIWYG_HEIGHT', mosGetParam( $gj_params, 'wysiwyg_height' ));
define('WYSIWYG_ROWS', mosGetParam( $gj_params, 'wysiwyg_rows' ));
define('WYSIWYG_COLS', mosGetParam( $gj_params, 'wysiwyg_cols' ));
define('AJAX_ACTIVE', mosGetParam( $gj_params, 'ajax_active' ));
define('AJAX_ACCESS', mosGetParam( $gj_params, 'ajax_access' ));
define('AJAX_MESSAGE', mosGetParam( $gj_params, 'ajax_message' ));
define('TEMPLATE', mosGetParam( $gj_params, 'template' ));
define('FORCE_INVITE', mosGetParam( $gj_params, 'force_invite', 'force_invite' ));

//Users without avatars cannot see other users avatars, CBE only
if (file_exists('administrator/components/com_comprofiler/enhanced_admin/enhanced_config.php')) {
include_once('administrator/components/com_comprofiler/enhanced_admin/enhanced_config.php');
define('PIC2PIC',$enhanced_Config['pic2pic']);
} else {
define('PIC2PIC','0');
}
if (PIC2PIC) {
	$query="SELECT COUNT(id) FROM #__comprofiler WHERE user_id=".$my->id." AND avatar IS NOT NULL AND avatarapproved='1'";
	$database->setQuery($query);
  	$mypic = $database->loadResult();
}
global $pms;
$pms = mosGetParam( $gj_params, 'pms' );
$logosize = mosGetParam( $gj_params, 'logosize' ). "px";
$date_format = mosGetParam( $gj_params, 'date_form' );
$jb_cat = mosGetParam( $gj_params, 'jb_cat' );

$todo =  mosGetParam( $_REQUEST ,'task', 0 ) ;
$exgroup = intval( mosGetParam( $_REQUEST, 'groupid',0));
$groupname = mosGetParam( $_REQUEST, 'groupname',0);
$mainframe->setPageTitle(GJ_TITLE);

// put the stylesheet in the head-section
$csslink = '<link href="'.$mosConfig_live_site.'/components/com_groupjive/templates/'.TEMPLATE.'/groupjive_css.css" rel="stylesheet" type="text/css" />';
//echo 'link:<p>'.$csslink.'<p>';
$mainframe->addCustomHeadTag($csslink);

// Permissions: Check for administrators
if ($my->id != 0) {
  $aro_group = $acl->getAroGroup( $my->id );
  $admin = (strtolower($aro_group->name) == 'super administrator' || strtolower($aro_group->name) == 'administrator');
  if($admin) {
    $admin = 1;
  } else {
    $admin = 0;
} 
}else {
   $aro_group=0;
   $admin=0;
 }

function main_page($row) {
  echo '<div id="columnSmall2">';
  latestmembers($row->id);
  echo '</div>';
  if(_GJ_CONF_BULLETIN) {
	  echo '<div id="columnSmall3">';
	  latestbul($row->id);
	  echo '</div>';
  }
  echo '<div id="columnSmall4">';
  latestforumposts($row->category_id);
  echo '</div><div style="clear:both;"></div>';
  if(file_exists('components/com_eventlist') && EVENTLIST){
	  echo '<div id="columnSmall2">';
	  latestEvents($row->id);
	  echo '</div>';
  }
  echo '<div style="clear:both;"></div>';
}

function moderator_func($row) {
  global $Itemid;
	
  $mod = '<ul id="func-inc_moderator_func"><li><a href="'
          . sefRelToAbs("index.php?option=com_groupjive&"
          . "task=inactiveusers&groupid=$row->id&Itemid=$Itemid")
          . '">'.GJ_INACTIVE_USERS.'</a></li>'
		  	
          . '<li><a href="'
          . sefRelToAbs("index.php?option=com_groupjive&"
          . "task=editgroup&groupid=$row->id&Itemid=$Itemid")
          . '">'.GJ_EDIT_GROUP_INFO.'</a></li>'

          . '<li><a href="'
          . sefRelToAbs("index.php?option=com_groupjive&"
          . "task=showmailform&groupid=$row->id&Itemid=$Itemid")
          . '">'.GJ_MAIL_GROUP.'</a></li>'

	      . '<li><a href="'
          . sefRelToAbs("index.php?option=com_groupjive&"
          . "task=transfer&groupid=$row->id&Itemid=$Itemid")
          . '">'.GJ_TRANSFER_OWNER.'</a></li>'

          . '<li><a href="'
          . sefRelToAbs("index.php?option=com_groupjive&"
          . "task=deletegroup&groupid=$row->id&"
          . "Itemid=$Itemid")
          . "\" onclick=\"return confirm('".GJ_DELETE_G_CONFIRM."')\">"
          . GJ_DELETE_GROUP.'</a></li></ul>';
	return $mod;
}

function group_info($row) {
  global $my, $mosConfig_live_site, $date_format;
	// $date = date($date_format, $row->date_s);
	$info = "<ul id=func-inc_group_info>";
	
	if(!empty($row->descr)) {														
	 $info .= '<li><strong>'.GJ_GROUPDESCR.'</strong>:&nbsp;'
            . stripslashes($row->descr).'</li>';
	}
	
	$info .= '<li><strong>'.GJ_TYPE.':&nbsp;</strong>';
		
	switch($row->type) {
		case 1:
		{
			$info .= GJ_OPEN;
			break;
		}
		case 2:
		{
			$info .= GJ_APREQUIRED;
			break;
		}
		case 3:
		{
			$info .= GJ_PRIVATE;
			break;
		}
	}

	 if(REAL_NAMES) {
    $creator = $row->name;
    } else {
    $creator = $row->creator;
	 }
	
	$info .='</li><li><strong>'.GJ_FOUNDED.'</strong>:&nbsp;'
            . $row->date_s.'</li><li><strong>'.GJ_MEMBERS.'</strong>:&nbsp;'
            . groupusercount($row->id).'</li>'
            . '<li><strong>'.GJ_CREATOR.'</strong>:&nbsp;'.$creator;

	$info .= '</li></ul>';
	return $info;
}


function links($row) {
	global $jb_cat, $Itemid;
	$links = '<ul id="func-inc_function_links"><li>'
           . '<a href="'
           . sefRelToAbs("index.php?option=com_groupjive&"
           . "task=member_list&groupid=$row->id&Itemid=$Itemid")
           . '">'.GJ_MEMBERS.'</a></li>';
		   
	if (_GJ_CONF_BULLETIN){
	$links .= '<li><a href="'
		. sefRelToAbs("index.php?option=com_groupjive&"
		. "task=bulletin&groupid=$row->id&"
		. "Itemid=$Itemid").'">'.GJ_GROUP_BUL.'</a></li>';
	}

  if(EVENTLIST) {
		$links .= '<li><a href="'
                . sefRelToAbs("index.php?option=com_eventlist&"
                . "func=shcatev1&categid=$row->category_id_el&"
                . "Itemid=$Itemid").'">'.GJ_GROUP_EVENT.'</a></li>';
	}

  if(JB) {
		$links .= '<li><a href="'
                . sefRelToAbs("index.php?option=".FORUMPATH."&"
                . "func=showcat&catid=$row->category_id&"
                . "Itemid=$Itemid")
                . '">'.GJ_GROUP_FORUM.'</a></li>';
	}

    $links .= '<li><a href="'
              . sefRelToAbs("index.php?option=com_groupjive&task="
              . "showgroup&groupid=$row->id&Itemid=$Itemid")
              . '">'.GJ_BACKTGROUP.'</a></li>';

	return $links;
}



function checkuser($groupid,$userid) {
	global $database;
	
	$query="SELECT COUNT(*) FROM #__gj_users "
          . "WHERE id_user='$userid' "
          . "AND id_group='$groupid' "
          . "AND status IN ('active', 'need approval')";
  $database->setQuery($query);
	if(!$result=$database->query()) {
		echo $database->stderr();
		return;
	}
	
	$exist = $database->loadResult();
	if (!$exist==0)
		return 1;
	else return 0;
}

function checkuseractive($groupid,$userid) {
  global $database;
  
  $query="SELECT COUNT(*) FROM #__gj_users "
          . "WHERE id_user='$userid' "
          . "AND id_group='$groupid' "
          . "AND status='active'";
  $database->setQuery($query);
  if(!$result=$database->query()) {
    echo $database->stderr();
    return;
  }
  
  $exist = $database->loadResult();
  if (!$exist==0)
    return 1;
  else return 0;
}


function ismoder($groupid,$userid) {
	//Check to see if the user viewing is the moderator
	global $database;
	$query="SELECT COUNT(*) FROM #__gj_groups "
          . "WHERE id='$groupid' "
          . "AND user_id='$userid'";
	$database->setQuery($query);
	if(!$result=$database->query()) {
		echo $database->stderr();
		return;
	}
	
	$exist = $database->loadResult();
	if (!$exist==0)
		return 1;
	else return 0;
}

function groupusercount($groupid) {
  // Here is where I find out how many members are in a group
	//for display on the category pages
	global $database;
	$query="SELECT COUNT(*) FROM #__gj_users "
          . "WHERE id_group='$groupid' "
          . "AND status='active'";  
  $database->setQuery($query);
	if(!$result=$database->query()) {
		echo $database->stderr();
		return;
	}
	$usercount= $database->loadResult();
	
	//return the user count for group
	return $usercount;
}

function latestmembers($gid) {
  global $database,$mosConfig_lang,$mypic ;

  $query="SELECT b.name, b.username, b.id, c.avatar "
          . "FROM #__gj_users AS a INNER JOIN #__users AS b "
          . "ON a.id_user = b.id "
          . "INNER JOIN #__comprofiler AS c "
          . "ON b.id = c.user_id "
          . "WHERE a.id_group ='".$gid
          . "' AND a.status = 'active' ORDER BY a.date DESC LIMIT 3";
  $database->setQuery($query);
  if(!$result=$database->query()) {
  	echo $database->stderr();
  	return;
  }
  
  $rows=$database->loadObjectList();
  echo "<h3 class=\"componentheading\">".GJ_NEWESTMEM."</h3>";
  echo "<ul id=func-inc_newest_member>";
  foreach ($rows as $row) {
    	 if(REAL_NAMES) {
    $name = $row->name;
    } else {
    $name = $row->username;
	 }
  	if (file_exists("images/comprofiler/tn".$row->avatar) && (!PIC2PIC || (PIC2PIC && $mypic))) {
  	$im="images/comprofiler/tn".$row->avatar;
	} else if( file_exists('images/comprofiler/tn'.$row->avatar) && PIC2PIC && !$mypic) { 
		if (file_exists('components/com_comprofiler/images/'.$mosConfig_lang.'/tnnophoto.jpg')) { 
		$im='components/com_comprofiler/images/'.$mosConfig_lang.'/tnnophoto.jpg';
	} else {
	$im='components/com_comprofiler/images/english/tnnophoto.jpg';
	}
	} else if (substr($row->avatar, 0, 7) == 'gallery' && file_exists("images/comprofiler/".$row->avatar)) {
  	$im="images/comprofiler/".$row->avatar;
	} else {
	$im=NOPHOTO;
	}  		
  echo "<li><img src=\"$im\" alt=\"$name\" /><br />"
        . "<a href=\""
        . sefRelToAbs("index.php?option=com_comprofiler&"
        . "task=userProfile&user=$row->id")."\">"
        . $name."</a></li>";
  }
  echo "</ul>";
}

function latestforumposts($catid) {
  global $database;
  // check if joomlaboard is installed
  if (!file_exists('components/'.FORUMPATH) || !JB) {
    return;
  }
  
  $query="SELECT * FROM #__".PREFIX."_messages "
          . "WHERE catid='".$catid."' ORDER BY time DESC LIMIT "
		  . _GJ_CONF_COUNT_FORUM_POSTS;
  $database->setQuery($query);
  if(!$result=$database->query()) {
  	echo $database->stderr();
  	return;
  }
  $rows=$database->loadObjectList();
  $total=count($rows);
  echo "<h3 class=\"componentheading\">".GJ_LATESTFORUM."</h3>";
  echo "<ul id=func-inc_latest_forum>";
  if($total > 0) {
    foreach ($rows as $row) {
      echo "<li><a href=\""
            . sefRelToAbs("index.php?option=".FORUMPATH."&"
            . "func=view&id=".$row->id."&catid="
            . $row->catid."#".$row->id)
            . "\">".$row->subject."</a><br /><small>".GJ_BY."&nbsp;<a href=\""
            . sefRelToAbs("index.php?option=com_comprofiler&"
            . "task=userProfile&user=".$row->userid)."\">"
            . $row->name.'</a>&nbsp;('.date('y-m-d',$row->time).")</small></li>";
    }
  echo "</ul>";
  } else {
   echo GJ_NO_FORUM_POSTS;
  }
}

function latestEvents($gid) {
  global $database, $Itemid, $date_format;
  // check if EventList is installed
  if (!file_exists('components/com_eventlist') || !EVENTLIST) {
    return;
  }

  $query = "SELECT a.id AS did, a.catsid, a.titel, a.deliverdate, a.sendername, c.id AS userid FROM #__eventlist_dates AS a"
	."\nINNER JOIN #__gj_eventlist AS b"
        ."\nON a.catsid = b.category_id"
	."\nINNER JOIN #__users AS c"
        ."\nON a.sendername = c.username"
	."\nWHERE b.group_id = $gid"
	."\nORDER BY a.deliverdate DESC"
	."\nLIMIT "._GJ_CONF_COUNT_EVENTS;

  $database->setQuery($query);
  if(!$result=$database->query()) {
  	echo $database->stderr();
  	return;
  }

  $rows=$database->loadObjectList();
  $total=count($rows);
  echo "<h3 class=\"componentheading\">".GJ_LATEST_EVENTS."</h3>";
  echo "<ul id=func-inc_latest_forum>";
  if($total > 0) {
    foreach ($rows as $row) {
 	    echo "<li><a href=\""
            . sefRelToAbs("index.php?option=com_eventlist&amp;"
            . "func=details&amp;Itemid=$Itemid&amp;did=".$row->did."&amp;categid="
            . $row->catsid)
            . "\">".$row->titel."</a><br /><small>"
	    . GJ_BY."&nbsp;<a href=\""
            . sefRelToAbs("index.php?option=com_comprofiler&amp;"
            . "task=userProfile&amp;user=".$row->userid)."\">"
            . $row->sendername.'</a>&nbsp;('.date('Y-m-d', $row->deliverdate).')</small></li>';
    }
  echo "</ul>";
  } else {
   echo GJ_NO_EVENTS;
  }
}

function latestbul($gid) {
  global $database, $Itemid;
  echo "<h3 class=\"componentheading\">".GJ_LATESTBULLETIN."</h3>";
   $query="SELECT a.*";
     if(REAL_NAMES) {
       $query .= ", b.name AS author_name";
     }
     $query .= " FROM #__gj_bul AS a INNER JOIN #__users AS b "
       . "ON a.author_id = b.id "
       . "WHERE a.group_id='$gid' "
       . "ORDER BY date_bul DESC LIMIT 1";
  $database->setQuery($query);
  if(!$result=$database->query()) {
  	echo $database->stderr();
  	return;
  }
  
  $result=$database->loadObjectList();
  $total=count($result);
  if($total > 0) {
    $row=$result[0];
    echo "<h4><a href=\"index.php?option=com_groupjive&task=showfullmessage&idm=$row->id&groupid=$gid&Itemid=$Itemid\">".$row->subject."</a></h4><p>".$row->post."</p> ".$row->author_name;
  } else {
   echo GJ_NO_MESSAGE;
  }
}


function checkImage($avatar) {
	$mosConfig_absolute_path = $mainframe->getCfg('absolute_path');
if (substr($avatar, 0, 7) == 'gallery') {
  $thumbnail = "/images/comprofiler/".$avatar;
} else if ($avatar != '') {
  $thumbnail = "/images/comprofiler/tn".$avatar;
} else {
  $thumbnail = "/components/com_comprofiler/plugin/language/".$fileLang."/images/tnnophoto.jpg";
}

// check if thumbnails exists
			if (file_exists($mosConfig_absolute_path.$thumbnail)) 
			{ 
  // image exists					  
				$image=$mosConfig_live_site.$thumbnail; 
			} else {
  // image not found           					   
				$thumbnail="/components/com_comprofiler/plugin/language/".$fileLang."/images/tnnophoto.jpg";
			   
			  // check if default image exists in specific language
  if (file_exists($mosConfig_absolute_path.$thumbnail)) 
					{ 
						$image=$mosConfig_live_site.$thumbnail; 
					} else {
						$image=$mosConfig_live_site."/components/com_comprofiler/plugin/"
				 ."language/default_language/images/tnnophoto.jpg"; 
					}  
				}
}

function transfer($owner_name, $group_id) {
global $database;
	$owner_name = escapeString($owner_name);
	if (REAL_NAMES) {
		$query = "SELECT a.id"
			. "\nFROM #__users AS a, #__gj_users AS b"
			. "\nWHERE a.name = '".$owner_name."'"
			. "\nAND b.id_group = ".$group_id.""
			. "\nAND a.id = b.id_user"
			. "\nAND b.status = 'active'";
	} else {
		$query = "SELECT a.id"
			. "\nFROM #__users AS a, #__gj_users AS b"
			. "\nWHERE a.username = '".$owner_name."'"
			. "\nAND b.id_group = ".$group_id.""
			. "\nAND a.id = b.id_user"
			. "\nAND b.status = 'active'";
	}

	$database->setQuery($query);
	$owner_id = $database->loadResult();

	if($owner_id) {
		$query = "UPDATE #__gj_groups SET creator = '".$owner_name."', user_id = '".$owner_id."' WHERE id = ".$group_id;
		$database->setQuery($query); 
		$database->query();

		mosRedirect("index.php?option=com_groupjive&task=showgroup&groupid=".$group_id, GJ_TRANSFERRED);
	} else {
		mosRedirect("index.php?option=com_groupjive&task=showgroup&groupid=".$group_id, GJ_TRANS_TO_MBR_RQD);
	}
}

?>
