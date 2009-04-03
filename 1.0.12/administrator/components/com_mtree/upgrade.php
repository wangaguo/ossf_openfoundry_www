<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$patch = mosGetParam( $_REQUEST, 'patch', '' );

switch( $patch ) {

	case '157-158':
		upgrade157_158();
		break;
}

function upgrade157_158() {
	global $database;

	$updated = false;
	
	?>
	<table class="adminform">
		<tr><th>Upgrade: Mosets Tree 1.57 - 1.58</th></tr>
	<?php
	
	$database->setQuery( 'SHOW COLUMNS FROM #__mt_reports LIKE "admin_note"' );
	$tmp = $database->loadResult();
	if ( $tmp == "admin_note" ) {
		//echo 'Has admin_note';
	} else {
		$database->setQuery( 'ALTER TABLE #__mt_reports ADD `admin_note` MEDIUMTEXT NOT NULL');
		if( $database->query() ) printRow( 1, 'Added admin_notes column to mt_reports.');
		$updated = true;
	}

	$database->setQuery( 'SHOW COLUMNS FROM #__mt_claims LIKE "admin_note"' );
	$tmp = $database->loadResult();
	if ( $tmp == "admin_note" ) {
		//echo 'Has admin_note';
	} else {
		$database->setQuery( 'ALTER TABLE #__mt_claims ADD `admin_note` MEDIUMTEXT NOT NULL');
		if( $database->query() ) printRow( 1, 'Added admin_notes column to mt_claims.');
		$updated = true;
	}

	$database->setQuery( 'SHOW COLUMNS FROM #__mt_reviews LIKE "admin_note"' );
	$tmp = $database->loadResult();
	if ( $tmp == "admin_note" ) {
		//echo 'Has admin_note';
	} else {
		$database->setQuery( 'ALTER TABLE #__mt_reviews ADD `admin_note` MEDIUMTEXT NOT NULL');
		if( $database->query() ) printRow( 1, 'Added admin_notes column to mt_reviews.');
		$updated = true;
	}

	$database->setQuery( 'DESCRIBE #__mt_reviews rev_date' );
	$database->loadObject( $tmp2 );
	if( $tmp2->Type <> 'datetime' ) {
		$database->setQuery( "ALTER TABLE #__mt_reviews CHANGE `rev_date` `rev_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'" );
		if ( $database->query() ) printRow( 1, 'Updated rev_date to datetime type.');
		$updated = true;
	}

	$database->setQuery( 'SHOW INDEX FROM #__mt_cats WHERE Key_name = "func_getPathWay" ' );
	$tmp2 = $database->loadObjectList();
	if( count($tmp2) == 0 ) {
		$database->setQuery( 'ALTER TABLE #__mt_cats ADD INDEX `func_getPathWay` ( `lft` , `rgt` , `cat_id` , `cat_parent` )' );
		if ( $database->query() ) printRow( 1, 'Added func_getPathWay index to mt_cats.');
		$updated = true;
	}

	$database->setQuery( 'SHOW INDEX FROM #__mt_links WHERE Key_name = "count_listfeatured" OR Key_name = "count_viewowner" OR Key_name = "mylisting"' );
	$tmp2 = $database->loadObjectList();

	if( count($tmp2) == 0 ) {
		$database->setQuery( 'ALTER TABLE #__mt_links ADD INDEX `count_listfeatured` ( `link_published` , `link_approved` , `link_featured` , `publish_up` , `publish_down` , `link_id` )' );
		if ( $database->query() ) printRow( 1, 'Added count_listfeatured index to mt_links.');

		$database->setQuery( 'ALTER TABLE #__mt_links ADD INDEX `count_viewowner` ( `link_published` , `link_approved` , `user_id` , `publish_up` , `publish_down` )' );
		if ( $database->query() ) printRow( 1, 'Added count_viewowner index to mt_links.');

		$database->setQuery( 'ALTER TABLE #__mt_links ADD INDEX `mylisting` ( `user_id` , `link_id` )' );
		if ( $database->query() ) printRow( 1, 'Added mylisting index to mt_links.');

		$updated = true;

	}

	if( $updated ) {
		printRow(2,'Mosets Tree has been successfully upgraded to 1.58!');
	} else {
		printRow(2,'No update required.');
	}

	printRow(2,'< <a href="index2.php?option=com_mtree">Back to Mosets Tree</a>');

	?>
	</table>
	<?php
}

function printRow( $ok, $msg ) {
	if( $ok == 1 OR $ok == 0 ) {
		echo '<tr><td><b>'.(($ok)?'Updated':'Skipped').'</b> - '.$msg.'</td></tr>';
	} elseif( $ok == 2 ) {
		echo '<tr><td>'.$msg.'</td></tr>';
	}

}
?>