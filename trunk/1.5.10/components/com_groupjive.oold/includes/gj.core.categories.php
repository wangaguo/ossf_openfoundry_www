<?php
/**
 * Categories functions
 */
// defines
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* shows a category
*
*/
function showCategory() {
	global $database, $my, $date_format, $mainframe;
	// Find out how many records there are anyways...
	$excat = intval( mosGetParam( $_REQUEST, 'id',0));

	$sql = "SELECT *"
		. "\nFROM #__gj_grcategory"
		. "\nWHERE id = $excat"
		. "\nAND access <= $my->gid"
		. "\nAND published=1";
	$database->setQuery($sql);
	$options_rows=$database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$options_row=&$options_rows[0];

	$mainframe->appendPathWay ($options_row->catname);

	// Now get the right records depending on the page...
	// include pageNavigation class to build page navigation
	$sql = "SELECT COUNT(*) FROM #__gj_groups a"
		. "\nINNER JOIN #__gj_grcategory AS b "
		. "\nON a.category = b.id "
		. "\nWHERE category='$excat'"
		. "\nAND active='1'"
		. "\nAND b.published=1"
		. "\nAND b.access <= $my->gid";
	$database->setQuery($sql);
	$total = $database->loadResult();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	if ($total == 0){
		if (ALLOWCREATEGROUPS && ($my->gid !=0)) {
			HTML_wg::showmenu(true);
		} else {
			HTML_wg::showmenu();
		}
		HTML_wg::errorpage(GJ_CAT_HASNT_G);
		return;
	}

	$limit = intval(mosGetParam( $_REQUEST, 'limit', _GJ_CONF_ONPAGE ));
	$limitstart = intval(mosGetParam( $_REQUEST, 'limitstart', 0 ));
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query="SELECT a.id,a.name,a.type,DATE_FORMAT(a.date_s, '$date_format')"
		. "\nAS date_s,a.descr,a.logo, a.user_id, COUNT(c.id) AS groupusercount "
		. "\nFROM #__gj_groups AS a"
		. "\nINNER JOIN #__gj_grcategory AS b "
		. "\nON a.category = b.id "
		. "\nINNER JOIN #__gj_users c"
		. "\nON a.id = c.id_group"
		. "\nWHERE category='$excat'"
		. "\nAND active='1'"
		. "\nAND b.published=1"
		. "\nAND b.access <= $my->gid "
	        . "\nAND c.status = 'active'"
		. "\nGROUP BY a.id, a.name, a.type, a.date_s, a.descr, a.logo, a.user_id"
		. "\nORDER BY name"
		. "\nLIMIT " . (int) $pageNav->limitstart . ", " . (int) $pageNav->limit;

	$database->setQuery($query);
	$rows=$database->loadAssocList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}



	if ($options_row->create_open || $options_row->create_closed || $options_row->create_invite) {
		if(ALLOWCREATEGROUPS && ($my->gid !=0)) {
			HTML_wg::showmenu(true);
		} else {
			HTML_wg::showmenu();
		}
	}
	HTML_wg::showcat($rows,$excat, $pageNav, $Itemid);
}
?>
