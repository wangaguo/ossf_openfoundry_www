<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
 *
 */
require_once(BaseAdminUrl.'/adminpages/user.manager.html.php');
function showUsers( $option, $act, $task ) { 
	global $database, $mainframe, $my, $acl, $mosConfig_list_limit;

	$filter_type	= $mainframe->getUserStateFromRequest( "filter_type{$option}", 'filter_type', 0 );
	$filter_logged	= $mainframe->getUserStateFromRequest( "filter_logged{$option}", 'filter_logged', 0 );
	$limit 			= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 	= $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search 		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 		= $database->getEscaped( trim( strtolower( $search ) ) );
	$where 			= array();

	if (isset( $search ) && $search!= "") {
		$where[] = "(a.username LIKE '%$search%' OR a.email LIKE '%$search%' OR a.name LIKE '%$search%')";
	}
	/*
	if ( $filter_type ) {
		if ( $filter_type == 'Public Frontend' ) {
			$where[] = "a.usertype = 'Registered' OR a.usertype = 'Author' OR a.usertype = 'Editor'OR a.usertype = 'Publisher'";
		} else if ( $filter_type == 'Public Backend' ) {
			$where[] = "a.usertype = 'Manager' OR a.usertype = 'Administrator' OR a.usertype = 'Super Administrator'";
		} else {
			$where[] = "a.usertype = LOWER( '$filter_type' )";
		}
	}*/
	/*
	if ( $filter_logged == 1 ) {
		$where[] = "s.userid = a.id";
	} else if ($filter_logged == 2) {
		$where[] = "s.userid IS NULL";
	}*/

	// exclude any child group id's for this user
	//$acl->_debug = true;
	$pgids = $acl->get_group_children( $my->gid, 'ARO', 'RECURSE' );

	if (is_array( $pgids ) && count( $pgids ) > 0) {
		$where[] = "(a.gid NOT IN (" . implode( ',', $pgids ) . "))";
	}

	$query = "SELECT COUNT(*)"
	. "\n FROM #__users AS a"
	. "\n LEFT JOIN #__session AS s ON s.userid = a.id"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	;
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT a.*, g.name AS groupname, s.userid AS loggedin"
	. "\n FROM #__users AS a"
	. "\n INNER JOIN #__core_acl_aro AS aro ON aro.value = a.id"	// map user to aro
	. "\n INNER JOIN #__core_acl_groups_aro_map AS gm ON gm.aro_id = aro.aro_id"	// map aro to group
	. "\n INNER JOIN #__core_acl_aro_groups AS g ON g.group_id = gm.group_id"
	. "\n LEFT JOIN #__session AS s ON s.userid = a.id"
	. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
	. "\n GROUP BY a.id"
	. "\n LIMIT $pageNav->limitstart, $pageNav->limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

/*	// get list of Groups for dropdown filter
	$query = "SELECT name AS value, name AS text"
	. "\n FROM #__core_acl_aro_groups"
	. "\n WHERE name != 'ROOT'"
	. "\n AND name != 'USERS'"
	;
	$types[] = mosHTML::makeOption( '0', '- Select Group -' );
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type'] = mosHTML::selectList( $types, 'filter_type', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_type" );
	*/
	/* get list of Log Status for dropdown filter
	$logged[] = mosHTML::makeOption( 0, '- Select Log Status - ');
	$logged[] = mosHTML::makeOption( 1, 'Logged In');
	$logged[] = mosHTML::makeOption( 2, 'Not Logged In');
	$lists['logged'] = mosHTML::selectList( $logged, 'filter_logged', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "$filter_logged" );
	*/
	$lists = null;
	$database->setQuery("SELECT * FROM #__gallery2");
	$param = $database->loadRowList();
	
	HTML::showUsers( $rows, $pageNav, $search, $option, $lists, $param );
}

function showUsersDetail($option, $act, $task, $userId){
global $database, $my;
	//start G2 embed
	
	
    
	$ret = core::initiatedG2($my->id, 'true');
//get user id				   				   
list($ret, $g2_user) = GalleryCoreApi::loadEntityByExternalId($userId, 'GalleryUser');
//getting groups
list($ret, $groupids_all) = GalleryCoreApi::fetchGroupNames();
list($ret, $groupids) = GalleryCoreApi::fetchGroupsForUser($g2_user->getId());
foreach($groupids_all as $key => $val){
	//check member or not
	if(array_key_exists($key, $groupids)){
		$switch = 1;
	} else {
		$switch = 0;
	}
	$groupswitch[$val] = mosHTML::yesnoRadioList('g2_group['.$key.']', 'class="inputbox" size="1"', $switch);
}
//all items of user
list($ret, $all_itemids) = GalleryCoreApi::fetchAllItemIdsByOwnerId($g2_user->getId());
$count_total = count($all_itemids);
$count_album = 0;
$album_ids = array();
//all albums
list($ret, $all_albumids) = GalleryCoreApi::fetchAllItemIds('GalleryAlbumItem');
foreach ($all_itemids as $id => $name) {
if (in_array($name, $all_albumids)) {
  	$count_album++;
   	$album_ids[] = $name;
	}	
}
$g2_id = $g2_user->getId();
HTML::showUserDetails( $option, $act, $task, $userId, $groupids_all, $count_total, $count_album, $album_ids, $groupswitch, $g2_id);
}

/*

*save user

*/
function saveUser(){
	global $my, $g2_id, $user_id;
	$ret = core::initiatedG2($my->id, 'true');
	while(list($key, $val) = each($_POST["g2_group"])){
		switch($val){
			case '1':
			$ret = GalleryCoreApi::addUserToGroup($g2_id, $key);
			break;
			case '0':
			$ret = GalleryCoreApi::removeUserFromGroup($g2_id, $key);
			break;
		}
	}
	mosRedirect( 'index2.php?option=com_gallery2&amp;act=user&amp;task=user_edit&amp;hidemainmenu=1&amp;id='.$user_id, 'Groups saved.' );
}
?>