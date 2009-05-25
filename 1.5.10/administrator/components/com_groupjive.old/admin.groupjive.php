<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype,'components', 'all' ) | $acl->acl_check( 'administration', 'edit', 'users', $my->usertype,'components', 'com_dailymessage' ))) 
	mosRedirect('index2.php', _NOT_AUTH);

	//	var_dump($_REQUEST);



if (!defined('GJBASEPATH')) {define( 'GJBASEPATH', dirname(__FILE__) );}
if (!defined('GJADMINPATH')) {define('GJADMINPATH', $mainframe->getCfg( 'absolute_path' ). "/administrator");}
if (!defined('JPATH')) define ('JPATH', $mainframe->getCfg('absolute_path'));

define('GJPATH','components/com_groupjive');
define('CBPATH',GJADMINPATH.'/components/com_comprofiler');

require_once($mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );
if (file_exists(CBPATH.'/imgToolbox.class.php')){
	require_once(CBPATH."/imgToolbox.class.php");
} else {
	die( 'Community Builder or Community Builder Enhanced is not installed. One of these components is required for GroupJive to function!' );
}

require_once(JPATH."/components/com_groupjive/helpers.php");

// include CB / CBE config 
if (file_exists(CBPATH.'/ue_config.php')) {
	require_once(CBPATH.'/ue_config.php');
} elseif (file_exists(CBPATH.'/enhanced_admin/enhanced_config.php')) {
	require_once(CBPATH.'/enhanced_admin/enhanced_config.php');
}

if (file_exists('../'.GJPATH.'/language/'.$mosConfig_lang.'.php')) {
	include_once('../'.GJPATH.'/language/'.$mosConfig_lang.'.php'); 
} else {
require_once('../'.GJPATH.'/language/english.php');
}

define('ONPAGE', 10); //number of groups on page
$exgroup = intval( mosGetParam( $_REQUEST, 'groupid',0));
$act = mosGetParam($_REQUEST,'act','');

$cid = josGetArrayInts( 'cid' );

// do we really need this? ^^ $cid
$id = mosGetParam( $_REQUEST, 'cid', array(0) );
$uid = mosGetParam( $_REQUEST, 'uid', array(0) );

if (!is_array( $id )) {$id = array(0);}

switch($task) {
	case 'delete':
		deleteGroup($exgroup);
		break;

	case 'settings':
		editoptions($option);
		break;

	case 'categoriesmanager':
		listcategory($option);
		break;

	case 'groupsmanager':
		listGroup($option);
		break;

	case 'membersmanager':
	        membersManager($option, $task);
		break;

	case 'membergroupsmanager':
		membergroupsmanager($option, $id);
		break;	
		
		//members
         case 'invitemembers':
               mosRedirect( 'index2.php?option=com_groupjive&amp;task=membersmanager','Sorry, this feature has not yet been implemented. We\'re working on it.' );
         break;

         case 'deletemembers':   
         case 'addmembers':
	        addMembers($option, $task, $cid);
                break;

         case 'savedeletemembers':
	   saveDeleteMembers($uid, $cid);
	   break;

         case 'saveaddmembers':
              saveAddMembers($uid, $cid);
              break;
   
 	// options
	case "saveoptions":
		saveoptions($option, $ueConfig);
		break;

	//category
	case "editcategory":
		editcategory($option, $id);
		break;

	case "savecategory":
		savecategory($option, $ueConfig);
		break;

	case "delcategory":
		delcategory($option, $id);
		break;

	case "newcategory" :
		$id = '';
		editcategory( $option, $id);
		break;

	case "publishcat" :
		publish($option, '1', $id, "cat");
		break;

	case "unpublishcat" :
		publish($option, '0', $id, "cat");
		break;

	case "orderup":
		ordercategory( $cid[0], -1, $option );
		break;

	case "orderdown":
		ordercategory( $cid[0], 1, $option );
		break;

//group
	case "editgroup":
		editgroup($option, $id);
		break;

	case "savegroup":
		savegroup($option, $ueConfig);
		break;

	case "delgroup";
		delgroup($option, $id);
		break;

	case "newgroup" :
		$id = '';
		editgroup( $option, $id);
		break;

	case "publishgroup" :
		publish($option, '1', $id, "group");
		break;

	case "unpublishgroup" :
		publish($option, '0', $id, "group");
		break;

	case 'accesspublic':
		accessMenu( intval( $cid[0] ), 0, $option );
		break;

	case 'accessregistered':
		accessMenu( intval( $cid[0] ), 1, $option );
		break;

	case 'accessspecial':
		accessMenu( intval( $cid[0] ), 2, $option );
		break;

	case 'updateforum':
		updateForum();
		break;

	case 'updateevents':
		updateEvents();
		break;

	case 'readme':
		$readme = mosGetParam($_REQUEST, 'readme', 'readme.txt');
		HTML_wg::showOverview('readme', $readme);
		break;

	default:
		HTML_wg::showOverview();
		break;
}

// new

function editoptions($option) {
	global $database;

	$row = new groupJiveOptions($database);
	$row -> load(1);
	HTML_wg::editOptions($option, $row);
}

function saveoptions($option, $ueConfig) {
	global $database;
	$row = new groupJiveOptions($database);

	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();
	}

	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}
	//insert default logo	
	if($_FILES['nophoto_logo']['size'] > 0) {
		$logo_def = create_picture($_FILES['nophoto_logo'], 
					"groupjive_default", JPATH."/images/com_groupjive/",$ueConfig);

		$q = "UPDATE #__gj_options SET nophoto_logo='".$logo_def."'";
		$database->setQuery( $q );

		if( $database->query() === false )
			die( mysql_error() );
	}
	mosRedirect("index2.php?option=com_groupjive&task=settings", "Settings saved");
}

function listcategory($option) {
	global $database,$mainframe;

	require_once( GJADMINPATH . "/includes/pageNavigation.php" );

	// get list limit
	if(!isset($mosConfig_list_limit) || !$mosConfig_list_limit) $limit = 10;
	else $limit = $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$sql = "SELECT COUNT(*)"
		. "\nFROM #__gj_grcategory a"
		. "\nLEFT JOIN #__groups b"
		. "\nON a.access = b.id"
		. "\nLEFT JOIN #__users c"
		. "\nON a.admin = c.id";
	$database->setQuery($sql);
	$total = $database->loadResult();

	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$sql = "SELECT a.*, b.name AS groupname, c.username AS adminname "
		. "FROM #__gj_grcategory a "
		. "LEFT JOIN #__groups b "
		. "ON a.access = b.id "
		. "LEFT JOIN #__users c "
		. "ON a.admin = c.id "
		. "ORDER BY ordering"
		. "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;

	$database->setQuery($sql);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_wg::listCategory($option, $rows, $pageNav);
}

function editcategory($option, $uid) {
	global $database;

	$row = new groupJiveCategory($database);
	if($uid){
		$row -> load($uid[0]);
	}
	
	// build the html select list for the category access
	$lists['access'] = mosAdminMenus::Access( $row );
	
	HTML_wg::editCategory($option, $row, $lists);
}

function savecategory($option, $ueConfig) {
	global $database;
	$row = new groupJiveCategory($database);
	if (empty($_REQUEST['id'])) {
		$row->ordering = 9999;
	}

	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
		.$row -> getError()
		."'); window.history.go(-1); </script>\n";
	exit();
	}

	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
		.$row -> getError()
		."'); window.history.go(-1); </script>\n";
		exit();	
	}

	//inserting category image
	if($_FILES['image_file_cat']['size'] > 0) {
		if( !empty($_REQUEST['id'] ))
			$cat_id = $_REQUEST['id'];
		else
			$cat_id=mysql_insert_id();

		$logo = create_picture($_FILES['image_file_cat'], 
				"cat_".$cat_id, JPATH."/images/com_groupjive/", $ueConfig);

		$q = "UPDATE #__gj_grcategory SET cat_image='".$logo."' "
			. "WHERE id=$cat_id";
		$database->setQuery( $q );
		if( $database->query() === false ) die( mysql_error() );
	}
	$row->updateOrder();
	mosRedirect("index2.php?option=$option&task=categoriesmanager", "Category saved");
}

function delcategory($option, $cid) {
	global $database;
	if (!is_array($cid) || count($cid) < 1) {
		echo "<script> alert('Select an item to delete'); "
			. "window.history.go(-1);</script>\n";
		exit();
	}

	if (count($cid)) {
		$ids = implode(',', $cid);
		$sql = "DELETE FROM #__gj_grcategory \nWHERE id IN ($ids)";
		$database->setQuery($sql);
	}
	if (!$database->query()) {
		echo "<script> alert('"
			.$database -> getErrorMsg()
			."'); window.history.go(-1); </script>\n";
	}
	echo $cid;
	mosRedirect("index2.php?option=$option&task=categoriesmanager", "Categories deleted");
}

function ordercategory( $uid, $inc, $option ) {
	global $database;

	$row = new groupJiveCategory( $database );
	$row->load( $uid );
	$row->move( $inc );
	mosRedirect( "index2.php?option=$option&task=categoriesmanager" );
}
// new groups
function listGroup($option) {
	global $database, $mainframe;

	require_once( GJADMINPATH . "/includes/pageNavigation.php" );

	// get list limit
	if(!isset($mosConfig_list_limit) || !$mosConfig_list_limit) $limit = 10;
	else $limit = $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$sql = "SELECT COUNT(*)"
		. "\nFROM #__gj_groups a"
		. "\nINNER JOIN #__gj_grcategory b"
		. "\nON a.category = b.id";
	$database->setQuery($sql);
	$total = $database->loadResult();

	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$sql = "SELECT a.*, b.catname, b.access "
		. "FROM #__gj_groups a "
		. "INNER JOIN #__gj_grcategory b "
		. "ON a.category = b.id ORDER BY name"
		. "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;
	$database->setQuery($sql);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_wg::listGroup($option, $rows, $pageNav);
}

function editgroup($option, $uid) {
	global $database;

	// check if categories are available
	$sql = "SELECT COUNT(*) FROM #__gj_grcategory WHERE published = 1";
	$database->setQuery($sql);
	$cats = $database->loadResult();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}
	if ($cats == 0) {
		HTML_wg::errorpage(GJ_NO_CAT_AVAILABLE);
		return false;
	}


	$row = new groupJiveGroup($database);
	if($uid){
		$row -> load($uid[0]);
	}

	HTML_wg::editGroup($option, $row);
}

function savegroup($option, $ueConfig) {
	global $database, $my;
	$row = new groupJiveGroup($database);

	$admin_id = $_REQUEST['user_id'];
	$q = "SELECT username FROM #__users WHERE id = $admin_id";

	$database->setQuery( $q );
	$name = $database->loadResult();

	$_POST['creator'] = $name;
	if(empty($_REQUEST['id'])) {
		$_POST['date_s'] = date("Y-m-d H:i:s");
	}
	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (!$row->check()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}

	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}

	if( !empty($_REQUEST['id'] ))
		$g_id = $_REQUEST['id'];
	else
		$g_id=mysql_insert_id();

	if($_FILES['image_file']['size'] > 0) {
		$logo = create_picture($_FILES['image_file'], $g_id, JPATH."/images/com_groupjive/", $ueConfig);
		
		$q = "UPDATE #__gj_groups SET logo='".$logo."' WHERE id=$g_id ";
		$database->setQuery( $q );    
		if( $database->query() === false ) die( mysql_error() );
	}

	$database->setQuery("SELECT * FROM #__gj_options");
	$res = $database->loadObjectList();

	//Joomlaboard integration
	if($res[0]->jb) {
		if (file_exists(JPATH."/components/com_fireboard/fireboard.php")) {
			$prefix = 'fb';
		} else {
			$prefix = 'sb';
		}

		$database->setQuery("SELECT category_id FROM #__gj_jb WHERE group_id=$g_id");
		$cat_id_jb = $database->loadResult();
		if(!$cat_id_jb) {
			$query="INSERT INTO #__".$prefix."_categories (parent, name, cat_emoticon, "
				. "locked, alert_admin, moderated, moderators, pub_access, "
				. "pub_recurse, admin_access, admin_recurse, ordering, "
				. "future2, published, checked_out, checked_out_time, review, "
				. "hits, description, headerdesc, class_sfx, id_last_msg, numTopics, numPosts, time_last_msg) "
				. "VALUES ('".$res[0]->jb_cat
				. "', '".$database->getEscaped($row->name)."', 0, 0, 0, 1, $admin_id, "
				. "0, 0, 0, 0, 1, 0, 0, 0, now(), 0, 0, '', '', '', '0', '0', '0', NULL)";

			$database->setQuery($query);
			$database->query();
			$lastid_sb=$database->insertid();
			$query="INSERT INTO #__gj_jb (group_id, category_id) "
				. "VALUES ($g_id, $lastid_sb)";
			$database->setQuery($query);
			$database->query();

			$query="INSERT INTO #__".$prefix."_moderation (catid, userid) "
			  . "VALUES ($lastid_sb, $admin_id) ";
			  $database->setQuery($query);
			  $database->query();
			
		} else {
			$query="UPDATE #__".$prefix."_categories "
				. "SET name=".$database->getEscaped($row->name).", moderated=1, moderators=$admin_id";
			$database->setQuery($query);
			$database->query();
		
		$query="UPDATE #__".$prefix."_moderation "
		  . "SET userid=$admin_id WHERE catid=$cat_id_jb";
		$database->setQuery($query);
		$database->query();
		}

		$query="UPDATE #__".$prefix."_sessions SET allowed='na'";
		$database->setQuery($query);
		$database->query();

	}

	//EventList integration, create an unpublished category for each group
	if($res[0]->eventlist) {
	  $database->setQuery("SELECT category_id FROM #__gj_eventlist WHERE group_id=$g_id");
	  $cat_id_eventlist = $database->loadResult();
	  if(!$cat_id_eventlist) {
	    $query = "INSERT INTO #__eventlist_categories "
			. "\n(catname, catdescription, image, publishedcat,"
			. "\nchecked_out, checked_out_time, access, ordering)"
			. "\nVALUES ('".$database->getEscaped($row->name)."', '"
			. $database->getEscaped($row->descr)."', '', '0', '0', '', '0', '')";
	    $database->setQuery($query);
	    $database->query();
	    
	    $lastid_el=$database->insertid();
	    $query="INSERT INTO #__gj_eventlist (group_id, category_id) "
	      . "VALUES ($g_id, $lastid_el)";
	    $database->setQuery($query);
	    $database->query();
	  } else {
				$sql = "UPDATE #__eventlist_categories a"
					. "\nINNER JOIN #__gj_eventlist b"
					. "\nON a.id = b.category_id"
					. "\nSET a.catname = '".$database->getEscaped($row->name)."',"
					. "\na.catdescription = '".$database->getEscaped($row->descr)."'";

				$database->setQuery($sql);
				if (!$result=$database->query()) {
					echo $database->stderr();
					return;
				}
		}
	}
	
	$q = "INSERT IGNORE INTO #__gj_users "
		. "\n(id_user, id_group, date, status)"
		. "\nVALUES"
		. "\n({$row->user_id}, {$row->id}, now(), 'active');";

	$database->setQuery( $q );

	if( $database->query() === false )
		die( mysql_error() );
	mosRedirect("index2.php?option=$option&task=groupsmanager", "Group saved");
}

function delgroup($option, $cid) {
	global $database;
	if (!is_array($cid) || count($cid) < 1) {
		echo "<script> alert('Select an item to delete'); "
			. "window.history.go(-1);</script>\n";
		exit();
	}
	
	$g = new groupJiveGroup($database);
	foreach($cid as $group){
		$g->load($group);
		
		//delete images 
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

		// Don't leave anything orphaned
		if ($g->deleteAll()) {
			$state[$group] = 1; //sucess
		} else {
			$state[$group] = "Error: ".$g->getError;
		}
	}

	//check for errors and report if
	foreach($state as $e){
		if ($e != 1) {
			echo "<script> alert('"
				.$e
				."'); window.history.go(-1); </script>\n";
		}
	}

	mosRedirect("index2.php?option=$option&task=groupsmanager", "Group(s) deleted");
}


function publish( $option, $publish=1 ,$cid, $grouporcat ) {
	global $database, $my;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select an item to $action'); "
			. "window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	switch ($grouporcat) {
		case "group": 
			$sql = "UPDATE #__gj_groups SET active='$publish'"
				. "\nWHERE id IN ($cids)";
			$url = "index2.php?option=$option&task=groupsmanager";
			break;
		case "cat":
			$sql = "UPDATE #__gj_grcategory SET published=$publish"
				. "\nWHERE id IN ($cids)";
			$url = "index2.php?option=$option&task=categoriesmanager";
			break;
		default:
			echo "<script> alert('Error while publishing - this "
				. "should not appear!!!'); window.history.go(-1); </script>\n";
			exit();
		break;
	}

	$database->setQuery( $sql	);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); "
			. "window.history.go(-1); </script>\n";
		exit();
	}

	mosRedirect( $url );
}

function create_picture($file, $name, $path, $ueConfig) {
	global $database;
	require_once(GJBASEPATH."/../com_comprofiler/imgToolbox.class.php");

 	
	foreach(glob(JPATH."/images/com_groupjive/".$name	.".*") as $fn) {
		if (file_exists($fn)) {
			unlink($fn); 
		}
	}
	echo "test:";
echo ($ueConfig['reg_email_name']);
	$database->setQuery("SELECT logosize FROM #__gj_options");
	$logosize = $database->loadResult();

	if( $file['size'] > 0 ) {
		$imgToolBox = new imgToolBox();
		$imgToolBox->_conversiontype=$ueConfig['conversiontype'];
		$imgToolBox->_IM_path = $ueConfig['im_path'];
		$imgToolBox->_NETPBM_path = $ueConfig['netpbm_path'];
		$imgToolBox->_maxsize = $ueConfig['avatarSize'];
		$imgToolBox->_maxwidth = $logosize;
		$imgToolBox->_maxheight = $logosize;
		$imgToolBox->_debug = 0;

		if( ! $newFileName = $imgToolBox->processImage( $file, $name, $path, 0, 0, 1 ) ) {
			echo "The following error occured while processing "
				. "your request:<br/>\n";			
			echo $imgToolBox->_errMSG . "<br/>\n";
			exit();
		}
		return $newFileName;
	}
}


/**
 * @param integer The id of the content item
 * @param integer The new access level
 * @param string The URL option
 */
function accessMenu( $uid, $access, $option ) {
	global $database;

	$row = new groupJiveCategory( $database );
	$row->load( (int)$uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	// clean any existing cache files
	mosCache::cleanCache( 'com_groupjive' );
	mosRedirect( 'index2.php?option='. $option . '&amp;task=categoriesmanager');
}

function deleteGroup ($exgroup) {
	global $database;
	$sql = "SELECT id, name FROM #__gj_groups WHERE id='$exgroup'";
	$database->setQuery($sql);

	$result=$database->query();
	if (!$database->GetNumRows($result)) {
		HTML_wg::errorpage(GJ_GR_N_EX);
		return;
	} else {
		$sql = "DELETE FROM #__gj_bul WHERE group_id='$exgroup'";
		$database->setQuery($sql);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		};

		$sql = "DELETE FROM #__gj_active WHERE groups='$exgroup'";
		$database->setQuery($sql);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		};

		$sql = "DELETE FROM #__gj_users WHERE id_group='$exgroup'";
		$database->setQuery($sql);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		};

		$sql = "DELETE FROM #__gj_groups WHERE id='$exgroup'";
		$database->setQuery($sql);
		if (!$result=$database->query()) {
			echo $database->stderr();
			return;
		};

		//If Joomlaboard is integrated, remove the group forum, check EventList integration while we're at it
		$sql = "SELECT jb, jb_cat, eventlist FROM #__gj_options";
		$database->setQuery($sql);
		$res = $database->loadObjectList();
  
		if($res[0]->jb) {
		  if (file_exists(JPATH.'/components/com_fireboard/fireboard.php')) {
		      $prefix = 'fb';
		    } else {
		      $prefix = 'sb';
		    }
		
		 	//First get the category id
		 	$sql = "SELECT category_id FROM #__gj_jb WHERE group_id='$exgroup'";
			$database->setQuery($sql);
			$cat_id=$database->loadResult();

			$sql = "DELETE FROM #__gj_jb WHERE group_id='$exgroup'";
			$database->setQuery($sql);
			if (!$result=$database->query()) {
				echo $database->stderr();
				return;
			}

			$sql = "DELETE FROM #__".$prefix."_categories WHERE id='$cat_id'";
			$database->setQuery($sql);
			if (!$result=$database->query()) {
				echo $database->stderr();
				return;
			}

			$sql = "DELETE FROM #__".$prefix."_moderation WHERE catid='$cat_id'";
			$database->setQuery($sql);
			if (!$result=$database->query()) {
				echo $database->stderr();
				return;
			}
		}

		//If EventList is integrated, remove the forum category
		if($res[0]->eventlist) {
		  $sql = "SELECT category_id FROM #__gj_eventlist WHERE group_id='$exgroup'";
		  $database->setQuery($sql);
		  $cat_id=$database->loadResult();
		  
		  $sql = "DELETE FROM #__gj_eventlist WHERE group_id='$exgroup'";
		  $database->setQuery($sql);
		  if (!$result=$database->query()) {
		    echo $database->stderr();
				return;
		  }
		  $sql = "DELETE FROM #__eventlist_categories WHERE id='$cat_id'";
		  $database->setQuery($sql);
		  if (!$result=$database->query()) {
		    echo $database->stderr();
		    return;
		  }


		mosRedirect("index2.php?option=com_groupjive&task=groupsmanager", "Deleted");
		return;
	}
}
}

function updateForum() {
	global $database ;
	/*Get the GroupJive forum category or "parent"*/
	$query="SELECT jb_cat FROM #__gj_options";
	$database->setQuery($query);
	$jb_cat=$database->loadResult();
	
	/*Get all the groups without forums*/
	$query="SELECT * FROM #__gj_groups WHERE id NOT IN (SELECT group_id FROM #__gj_jb)";
	$database->setQuery($query);
	$groups=$database->loadObjectList();
	$count=count($groups);
	  if (file_exists(JPATH.'/components/com_fireboard')) {
		    $prefix = 'fb';
		  } else {
		    $prefix = 'sb';
		  }
	if($count) {
		/*For every group that's not in #__gj_jb, create a new forum category with the group owner as moderator*/ 
		foreach($groups as $group) {
			$query="INSERT INTO #__".$prefix."_categories (parent, name, cat_emoticon, "
	. "locked, alert_admin, moderated, moderators, pub_access, "
	. "pub_recurse, admin_access, admin_recurse, ordering, future2, "
	. "published, checked_out, checked_out_time, review, hits, "
	. "description, headerdesc, class_sfx, id_last_msg, numTopics, numPosts, time_last_msg) VALUES ('$jb_cat', '".$database->getEscaped($group->name)."', 0, 0, 0, 1, $group->user_id, "
	. "0, 0, 0, 0, 1, 0, 1, 0, now(), 0, 0, '', '', '', '0', '0', '0', NULL)";
			$database->setQuery($query);
			if (!$result=$database->query()) {
	echo $database->stderr();
	return;
			}
			$lastid_sb=$database->insertid();
			$query="INSERT INTO #__gj_jb (group_id, category_id) VALUES ($group->id, $lastid_sb)";
			$database->setQuery($query);
			if (!$result=$database->query()) {
	echo $database->stderr();
	return;
			}
			$query="INSERT INTO #__".$prefix."_moderation (catid, userid) VALUES ($lastid_sb, $group->user_id)";
			$database->setQuery($query);
			if (!$result=$database->query()) {
	echo $database->stderr();
	return;
			}
			$query="UPDATE #__".$prefix."_sessions SET allowed='na'";
			$database->setQuery($query);
			if (!$result=$database->query()) {
	echo $database->stderr();
	return;
			}
		}
		mosRedirect("index2.php?option=com_groupjive&task=settings", "Update successful");
		return;
	} else {
		mosRedirect("index2.php?option=com_groupjive&task=settings", "No groups needed updating");
		return;
	}
}

function updateEvents() {
  global $database ;
  
  /*Get all the groups without EventList categories*/
  $query="SELECT * FROM #__gj_groups WHERE id NOT IN (SELECT group_id FROM #__gj_eventlist)";
  $database->setQuery($query);
  $groups=$database->loadObjectList();
  $count=count($groups);
  
  if($count) {
    /*For every group that's not in #__gj_eventlist, create a new category*/ 
    foreach($groups as $group) {
      $query = "INSERT INTO #__eventlist_categories (catname, catdescription, image, publishedcat, checked_out, checked_out_time, access, ordering) VALUES ('".$database->getEscaped($group->name)."', '".$database->getEscaped($group->descr)."', '', '0', '0', '', '0', '')";
      $database->setQuery($query);
      if (!$result=$database->query()) {
	echo $database->stderr();
	return;
      }
      
      $lastid_el=$database->insertid();
      $query="INSERT INTO #__gj_eventlist (group_id, category_id) "
	. "VALUES ($group->id, $lastid_el)";
      $database->setQuery($query);
      if (!$result=$database->query()) {
	echo $database->stderr();
	return;
      }
    }
    mosRedirect("index2.php?option=com_groupjive&task=settings", "Update successful");
    return;
	} else {
	  mosRedirect("index2.php?option=com_groupjive&task=settings", "No groups needed updating");
	  return;
	}
}

function membersManager($option, $task){
  global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

  $filter_type	= $mainframe->getUserStateFromRequest( "filter_type{$option}", 'filter_type', 0 );
  $limit 			= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
  $limitstart 	= intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
  $search 		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
  if (get_magic_quotes_gpc()) {
	  $search			= stripslashes( $search );
  }
  
  if (isset( $search ) && $search!= "") {
    $searchEscaped = $database->getEscaped( trim( strtolower( $search ) ) );
    $and = " AND (b.username LIKE '%$searchEscaped%' OR b.email LIKE '%$searchEscaped%' OR b.name LIKE '%$searchEscaped%')";
  } else {
    $and = '';
  }
  
  //Get total number of users in the system 
  if( $filter_type ) {
    $query = "SELECT COUNT(g.id)"
      . "\nFROM #__gj_users AS x"
      . "\nLEFT JOIN #__gj_groups AS g"
      . "\nON x.id_group = g.id"
      . "\nINNER JOIN #__users AS b ON b.id = x.id_user"
      . "\nWHERE g.id = '$filter_type'"
      . "\nAND b.block = '0'";
  } else {
    $query = "SELECT COUNT(id)"
      . "\n FROM #__users WHERE block = '0'";
  }
  $database->setQuery( $query );
  $total = $database->loadResult();
  
  require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
  $pageNav = new mosPageNav( $total, $limitstart, $limit  );
  
	$database->setQuery("DROP TEMPORARY TABLE IF EXISTS tmp_users;");
	$database->query();

	if( $filter_type ) {
	  $sql = "SELECT x.id_user"
	    . "\nFROM #__gj_users AS x"
	    . "\nLEFT JOIN #__gj_groups AS g"
	    . "\nON x.id_group = g.id"
	    . "\nINNER JOIN #__users AS b ON b.id = x.id_user"
	    . "\nWHERE g.id = '$filter_type'"
	    . "\nAND b.block = '0'"
	    . "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;
	} else {
		$sql = "SELECT id AS id_user FROM #__users "
		  . "\nWHERE block = '0'"
		  . "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;
	}

	$database->setQuery($sql);
	$tmp_ids = $database->loadResultArray();
	if ($database->getErrorNum()) {
	  echo $database->stderr();
	  return;
	}
	$tmp = implode(',', $tmp_ids);

	$query = "SELECT b.*, GROUP_CONCAT(g.id SEPARATOR ' ') AS groupids"
	  ."\nFROM #__users AS b "
	  ."\nLEFT JOIN #__gj_users AS u ON u.id_user = b.id"
	  ."\nLEFT JOIN #__gj_groups AS g ON u.id_group = g.id"
	  ."\nWHERE b.id IN ($tmp)"
	  .  $and
	  ."\nGROUP BY b.id"
	  ; 

	$database->setQuery( $query);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$sql = "SELECT id, name FROM #__gj_groups";
	$database->setQuery( $sql);
	$gids = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}
	$g = array();
	foreach ($gids as $gid) {
		$g[$gid->id] = $gid->name;
	}

	for ($i=0;$i<count($rows);$i++){
		$_ids = explode(' ',$rows[$i]->groupids);
		if (!empty($_ids[0])) {
			$rows[$i]->groupname ='<ul>';
			foreach ($_ids as $id) {
				$rows[$i]->groupname .= '<li><a href="index2.php?option=com_groupjive&task=membersmanager&filter_type='.$id.'">'.$g[$id].'</a></li>';
			}
			$rows[$i]->groupname .='</ul>';
		}
	}

	// Get list of GJ groups for dropdown filter
	$query = "SELECT id AS value, name AS text"
	. "\n FROM #__gj_groups"
	. "\n ORDER BY name"  
	;
	$types[] = mosHTML::makeOption( '0', '- Select Group -' );
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type'] = mosHTML::selectList( $types, 'filter_type', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_type" );

	HTML_wg::showMembers( $rows, $pageNav, $search, $option, $lists, $task );
}


function addMembers($option, $task, $cid) {
  global $database;
// Get list of GJ groups for dropdown filter
	$query = "SELECT id, name, descr"
	. "\n FROM #__gj_groups"
	. "\n ORDER BY name"  
	;
	
	$database->setQuery($query);
	$rows = $database->loadObjectList();

  HTML_wg:: addMembers($rows, $option, $task, $cid);
}

function saveAddMembers($uid, $groups) {
  global $database;

  $val = array ();
  
  $query = "REPLACE INTO #__gj_users (id_user, id_group, status, date)"
    ."\nVALUES ";

  foreach($uid as $id)
    {
      foreach($groups as $group)
	{
	  $val [] = "($id, $group, 'active', 'now()')";

	    }
    }
  $query .= implode (",", $val);

  echo $query;

  $database->setQuery($query);
  if(!$result=$database->query()) {
    echo $database->stderr();
    return;
    }  
  mosRedirect("index2.php?option=com_groupjive&task=membersmanager", "Members were successfully added to the selected group(s)");
}

function saveDeleteMembers($uid, $groups) {
  global $database;
  if(count($groups)) echo "set"; else echo "Inte set";
  $val = array ();

    $query = "DELETE FROM #__gj_users WHERE ";

	$query1 = "DELETE FROM  #__gj_active WHERE ";

  foreach($uid as $id)
    {
      foreach($groups as $group)
	{
	  $val [] = "(id_user=$id AND id_group=$group)";
	    }
    }

  $query .= implode (" OR ", $val);

	// build SQL to delete entries from gj_active table (invitations)
  $query1 .= implode (" OR ", $val);
  $query1 = str_replace('id_group', 'groups', $query1);
  $query1 = str_replace('id_user', 'too', $query1);

  echo $query;
  $database->setQuery($query);
  if(!$result=$database->query()) {
    echo $database->stderr();
    return;
    }

  $database->setQuery($query1);
  if(!$result=$database->query()) {
    echo $database->stderr();
    return;
    }
   mosRedirect("index2.php?option=com_groupjive&task=membersmanager", "Members were successfully deleted from the selected group(s)");
}

?>
