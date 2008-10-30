<?php

function update_cats_and_links_count( $cat_id = 0, $updateOrder = true, $visible_links_only = false ) {
	global $database, $mosConfig_offset;

	$sql = "SELECT cat_id FROM #__mt_cats WHERE cat_parent=$cat_id ";
	if ( $visible_links_only ) {
		$sql .= "AND cat_published = '1' AND cat_approved = '1'";
	}
	$database->setQuery( $sql );
	
	$retval["cats"]=0;
	$retval["links"]=0;

	//all children and their links
	$cat_ids = $database->loadResultArray();

	foreach($cat_ids AS $cid) 
	{	
		$val=update_cats_and_links_count( $cid, $updateOrder, $visible_links_only );

		$retval["cats"]  += $val["cats"]+1;
		$retval["links"] += $val["links"];

		$database->setQuery("UPDATE #__mt_cats SET cat_cats=".$val["cats"].", cat_links=".$val["links"]." WHERE cat_id = ".$cid);
		$database->query();

	}

	# Update its own links
	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
	$sql2 = "SELECT count(l.link_id) FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND cl.cat_id=$cat_id ";
	if ( $visible_links_only ) {
		$sql2 .= "AND link_published = '1' AND link_approved = '1'"
			. " AND ( l.publish_up = '0000-00-00 00:00:00' OR l.publish_up <= '$now'  ) "
			. " AND ( l.publish_down = '0000-00-00 00:00:00' OR l.publish_down >= '$now' ) ";

	}
	$database->setQuery( $sql2 );
	$count_links = $database->loadResult();

	if ($count_links >= 0) $retval["links"] += $count_links;

	return $retval; 
}

function fast_update_cats_and_links_count( $cat_id = 0 ) {
	global $database, $_MT_LANG;

	$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats AS c, #__mt_cl AS cl WHERE c.cat_id = cl.cat_id AND cl.main = 1 AND cl.cat_id = '$cat_id'" );
	$total_links = $database->loadResult();

	$database->setQuery( "SELECT cat_id, cat_cats, cat_links FROM #__mt_cats WHERE cat_parent=$cat_id AND cat_published = '1' AND cat_approved = '1'" );
	
	//all children and counts
	$cat_ids = $database->loadObjectList();

	$total_cats = count( $cat_ids );

	foreach($cat_ids AS $cid) {	
		$total_links += $cid->cat_links;
		$total_cats += $cid->cat_cats;
	}

	$database->setQuery("UPDATE #__mt_cats SET cat_cats=".$total_cats.", cat_links=".$total_links." WHERE cat_id = ".$cat_id);
	$database->query();

	return true;

}

function recount( $method, $cat_id ) {
	global $_MT_LANG, $database;

	echo "<center><strong>".$_MT_LANG->PLEASE_WAIT_RECOUNT_IN_PROGRESS."</strong>";
	
	if ( $method == "fast" ) {
		fast_update_cats_and_links_count( $cat_id );
	} else {
		$retval = update_cats_and_links_count( $cat_id, true, true );
		$database->setQuery("UPDATE #__mt_cats SET cat_cats=".$retval["cats"].", cat_links=".$retval["links"]." WHERE cat_id = ".$cat_id);
		$database->query();
	}

	echo '<p /><strong>'.$_MT_LANG->DONE.'</strong><p /><input type="button" class="button" value="'.$_MT_LANG->CLOSE_THIS_WINDOW.'" onclick="window.close();" /></center>';
}
?>