<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 2.0
* @copyright (C) 2006-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/spy.mtree.html.php' );

$id = mosGetParam( $_REQUEST, 'id', '0' );
$owner = mosGetParam( $_REQUEST, 'owner', '' );
$cid = mosGetParam( $_POST, 'cid', '0' );
$task2 = strval( mosGetParam( $_REQUEST, 'task2', '' ) );

HTML_mtspy::printStartMenu( $option, $task2 );

switch( $task2 ) {

	case 'users':
		viewUsers( $option );
		break;

	case 'viewuser':
		viewUser( $option, $id );
		break;

	case 'viewclone':
		viewClone( $option, $id );
		break;

	case 'listings':
		viewListings( $option );
		break;

	case 'viewlisting':
		viewListing( $option, $id );
		break;

	case 'clones':
		viewClones( $option );
		break;
		
	case 'removelogs':
		removeLogs( $option, $cid );
		break;
		
	case 'removeuserandalllogs':
		removeUserAndAllLogs( $option, $id );
		break;

	case 'removecloneandalllogs':
		removeCloneAndAllLogs( $option, $id, $owner );
		break;

	default:
		viewUsers( $option );
		break;

}

HTML_mtspy::printEndMenu( $task2 );

function removeCloneAndAllLogs( $option, $id, $owner ) {
	global $database, $_MT_LANG;
	
	$database->setQuery('SELECT id FROM #__users WHERE username = \'' . $owner . '\' LIMIT 1');
	$owner_id = $database->loadResult();
	
	if( $id > 0 && $owner_id > 0 ) {
	
		# Since this is a clone removal, archive the user, log and reviews
		$database->setQuery('INSERT INTO #__mt_archived_log SELECT * FROM #__mt_log WHERE user_id = ' . $id);
		$database->query();
		$database->setQuery('INSERT INTO #__mt_archived_reviews SELECT * FROM #__mt_reviews WHERE user_id = ' . $id);
		$database->query();
		$database->setQuery('INSERT INTO #__mt_archived_users SELECT * FROM #__users WHERE id = ' . $id);
		$database->query();
	
		# Remove logs
		$database->setQuery('SELECT log_id FROM #__mt_log WHERE user_id = \'' . $id . '\'');
		$log_ids = $database->loadResultArray();

		if( count($log_ids) > 0 ) {
			removeLogs2($log_ids);
		}

		# Assign owner to clone
		$database->setQuery('INSERT INTO #__mt_clone_owners (user_id,owner_id) VALUES(' . $id. ','  . $owner_id . ')');
		$database->query();
	
		removeUser($id);
		
	}
		
	// mosRedirect('index2.php?option=com_mtree&task=spy&task2=users', 'Clone successfully removed.' );
	mosRedirect('index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$owner_id, 'Clone successfully removed.' );
}

function removeUserAndAllLogs( $option, $id ) {
	global $database, $_MT_LANG;
	
	$database->setQuery('SELECT log_id FROM #__mt_log WHERE user_id = \'' . $id . '\'');
	$log_ids = $database->loadResultArray();

	if( count($log_ids) > 0 ) {
		removeLogs2($log_ids);
	}
	
	removeUser($id);
	
	mosRedirect('index2.php?option=com_mtree&task=spy&task2=users', $_MT_LANG->USER_SUCCESSFULLY_REMOVED );
}

function removeLogs( $option, $cid ) {
	global $_MT_LANG, $database;
	if( count($cid) > 0 ) {
		$database->setQuery( 'SELECT user_id FROM #__mt_log WHERE log_id = \'' . $cid[0] . '\' LIMIT 1' );
		$user_id = $database->loadResult();
		removeLogs2( $cid );
		mosRedirect('index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$user_id, $_MT_LANG->ACTIVITIES_SUCCESSFULLY_REMOVED );
	} else {
		viewUsers( $option );
	}
}

function removeLogs2( $cid ) {
	global $database;
	if( count($cid) > 0 ) {
		$database->setQuery( 'SELECT * FROM #__mt_log WHERE log_id IN (' . implode(',',$cid). ') LIMIT ' . count($cid));
		$rows = $database->loadObjectList();
		foreach( $rows AS $row ) {
			switch( $row->log_type ) {
				case 'vote':
					$database->setQuery( 'SELECT link_rating, link_votes FROM #__mt_links WHERE link_id = \'' . $row->link_id . '\' LIMIT 1' );
					$database->loadObject( $link );
				
					# Calculate and update the new rating & number of votes
					if( $link->link_votes >= 1 ) {
						$new_link_votes = $link->link_votes - 1;
					} else {
						$new_link_votes = 0;
					}
					if( $new_link_votes <= 0 ) {
						$new_link_rating = 0;
					} else {
						$new_link_rating = (($link->link_votes * $link->link_rating) - $row->value) / $new_link_votes;
						if( $new_link_rating < 0 ) {
							$new_link_rating = 0;
						} elseif( $new_link_rating > 5 ) {
							$new_link_rating = 5;
						}
					}
					$database->setQuery( 'UPDATE #__mt_links SET link_rating = \'' . $new_link_rating . '\', link_votes = \'' . $new_link_votes . '\' WHERE link_id = \'' . $row->link_id . '\' LIMIT 1' );
					$database->query();
					break;
				case 'votereview':
					if($row->value == 1) {
						$database->setQuery( 'UPDATE #__mt_reviews SET vote_helpful = vote_helpful -1, vote_total = vote_total - 1 WHERE rev_id = \'' . $row->rev_id . '\' LIMIT 1' );
					} else {
						$database->setQuery( 'UPDATE #__mt_reviews SET vote_total = vote_total - 1 WHERE rev_id = \'' . $row->rev_id . '\' LIMIT 1' );
					}
					$database->query();
					break;
				case 'review':
					$database->setQuery( 'DELETE FROM #__mt_reviews WHERE rev_id = \'' . $row->rev_id . '\' LIMIT 1' );
					$database->query();
					break;
				case 'replyreview':
					$database->setQuery( 'UPDATE #__mt_reviews SET ownersreply_text = \'\', ownersreply_date = \'\', ownersreply_approved = \'0\' WHERE rev_id = \'' . $row->rev_id . '\' LIMIT 1' );
					$database->query();
					break;
				case 'addfav':
				case 'removefav':
					// No additional query required.
					break;				
			}
		}
		$database->setQuery( 'DELETE FROM #__mt_log WHERE log_id IN (' . implode(',',$cid). ') LIMIT ' . count($cid));
		$database->query();
	}
}

function removeUser( $id ) {
	global $database;
	
	// Remove user
	$obj = new mosUser( $database );
	$obj->load( $id );
	$count = 2;
	if ( $obj->gid == 25 ) {
		// count number of active super admins
		$database->setQuery( "SELECT COUNT( id ) FROM #__users WHERE gid = 25 AND block = 0" );
		$count = $database->loadResult();
	}
	
	if ( $count <= 1 && $obj->gid == 25 ) {
		// cannot delete Super Admin where it is the only one that exists
	} else {
		// delete user
		$obj->delete( $id );
	}
}

function viewClones( $option ) {
	global $database;
	
	$database->setQuery('SELECT DISTINCT log.user_id, u.username, u.name, u.email, u.block AS user_blocked, log.log_ip, ('
		."\n  SELECT COUNT( * ) FROM #__mt_links AS l "
		."\n  WHERE l.user_id = log.user_id "
		."\n ) AS num_of_links "
		."\n FROM #__mt_log AS log"
		."\n LEFT JOIN #__users AS u ON u.id = log.user_id"
		."\n WHERE log_ip IN ("
		."\n  SELECT log_ip"
		."\n  FROM #__mt_log AS log2"
		."\n  WHERE log2.user_id <> log.user_id AND log2.user_id >0"
		."\n )"
		."\n AND log.user_id > 0"
		."\n ORDER BY log.log_ip DESC, num_of_links DESC "
	);
	$clones = $database->loadObjectList();

	$database->setQuery( 'SELECT DISTINCT log.user_id, u.username, u.name, links.link_name, links.link_id, links.link_votes, links.link_rating, links.link_hits, links.link_created '
		."\n FROM #__mt_log AS log "
		."\n LEFT JOIN #__users AS u ON u.id = log.user_id "
		."\n LEFT JOIN #__mt_links AS links ON links.link_id = log.link_id "
		."\n AND links.user_id = log.user_id "
		."\n WHERE log_ip "
		."\n IN ( "
		."\n  SELECT log_ip "
		."\n  FROM #__mt_log AS log2 "
		."\n  WHERE log2.user_id <> log.user_id "
		."\n  AND log2.user_id > 0 "
		."\n ) "
		."\n AND log.user_id > 0 "
		."\n AND links.link_id > 0 "
		."\n ORDER BY links.link_votes DESC  "
		);
	$cloners_listings = $database->loadObjectList();

	HTML_mtspy::viewClones( $option, $clones, $cloners_listings );
}

function viewListing( $option, $id ) {
	global $database;

	$database->setQuery( 'SELECT log.*, l.link_name, l.link_id, u.name, u.username, u.id AS user_id, u.block AS user_blocked, r.rev_title FROM #__mt_log AS log '
		."\n LEFT JOIN #__users AS u ON u.id = log.user_id"
		."\n LEFT JOIN #__mt_links AS l ON l.link_id = log.link_id"
		."\n LEFT JOIN #__mt_reviews AS r ON r.rev_id = log.rev_id"
		."\n WHERE log.link_id = '".$id."'"
//		."\n GROUP BY u.id "
		."\n ORDER BY log.log_date ASC" );
	$listing_activities = $database->loadObjectList();

	$database->setQuery( 'SELECT * FROM #__mt_links AS l '
		."\n LEFT JOIN #__users AS u ON u.id = l.user_id "
		."\n WHERE l.link_id = '".$id."' LIMIT 1" );
	$database->loadObject( $listing );

	$database->setQuery( 'SELECT r.*, log.log_ip, u.name, u.username, u.block AS user_blocked FROM #__mt_reviews AS r '
		."\n LEFT JOIN #__mt_log AS log ON log.rev_id = r.rev_id AND (log.log_type='review' OR log.log_type=null) "
		."\n LEFT JOIN #__users AS u ON u.id = r.user_id "
		."\n WHERE r.link_id = '" . $id . "'" );
	$reviews = $database->loadObjectList();
	
	$clones = loadClonesUserid( $listing->user_id );

	$Itemid = getMTItemid();

	HTML_mtspy::viewListing( $option, $Itemid, $listing_activities, $reviews, $listing, $clones );

}

function viewListings( $option ) {
	global $database, $mainframe, $mtconf, $_MT_LANG;

	$orderby = mosGetParam( $_REQUEST, 'orderby', 'latestusers' );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 25 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	$search['link_name'] = mosGetParam( $_POST, 'link_name', '' );
	$search['link_id'] = mosGetParam( $_POST, 'link_id', '' );
	
	$where = array();
	if( !empty($search['link_name']) ) { $where['link_name'] = "l.link_name LIKE '%".$search['link_name']."%'"; }
	if( !empty($search['link_id']) ) { $where['link_id'] = "l.link_id = '".$search['link_id']."'"; }

	switch( $orderby ) {
		case 'mosthits':
			$orderby_query = 'l.link_hits DESC';
			break;

		case 'mostreviews':
			$orderby_query = 'reviews DESC';
			break;

		case 'highestrating':
			$orderby_query = 'l.link_rating DESC';
			$where[] = 'link_votes > '.$mtconf->get('min_votes_to_show_rating');
			break;

		case 'mostvotes':
			$orderby_query = 'l.link_votes DESC';
			break;

		case 'recentlyupdated':
			$orderby_query = 'l.link_modified DESC';
			break;

		case 'featured':
			$orderby_query = 'l.link_featured DESC';
			break;

		default:
		case 'latestlinks':
			$orderby_query = 'l.link_created DESC';
			break;
	}

	// Listings
	$database->setQuery( 'SELECT COUNT(*) FROM #__mt_links AS l' 
		.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
		);
	$totallinks = $database->loadResult();

	$database->setQuery( 'SELECT l.*, u.name, u.id AS user_id, u.username, COUNT(r.rev_id) AS reviews'
		."\n FROM #__mt_links AS l "
		."\n LEFT JOIN #__users AS u ON u.id = l.user_id "
		."\n LEFT JOIN #__mt_reviews AS r ON r.link_id = l.link_id "
		.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
		."\n GROUP BY l.link_id "
		."\n ORDER BY ".$orderby_query.' '
		."\n LIMIT ".$limitstart.', '.$limit
		);
	$links = $database->loadObjectList();
	
	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $totallinks, $limitstart, $limit );

	$orderbys[] = mosHTML::makeOption( 'latestlinks', $_MT_LANG->LATEST_LISTINGS );
	$orderbys[] = mosHTML::makeOption( 'mostvotes', $_MT_LANG->MOST_VOTES );
	$orderbys[] = mosHTML::makeOption( 'highestrating', $_MT_LANG->HIGHEST_RATING .' (>'.$mtconf->get('min_votes_to_show_rating').' '.strtolower($_MT_LANG->VOTES).')' );
	$orderbys[] = mosHTML::makeOption( 'mostreviews', $_MT_LANG->MOST_REVIEWS );
	$orderbys[] = mosHTML::makeOption( 'mosthits', $_MT_LANG->MOST_HITS );
	$orderbys[] = mosHTML::makeOption( 'recentlyupdated', $_MT_LANG->RECENTLY_UPDATED );
	$orderbys[] = mosHTML::makeOption( 'featured', $_MT_LANG->FEATURED_FIRST );
	$lists['orderby'] = mosHTML::selectList( $orderbys, 'orderby', 'class="inputbox" size="1" onchange="document.adminForm.submit();"',
	'value', 'text', $orderby );

	HTML_mtspy::viewLinks( $option, $lists, $search, $pageNav, $links );

}

function viewClone( $option, $id ) {
	global $database;
	
	if( $id > 0 ) {

		$database->setQuery( 'SELECT log.*, l.link_id, l.link_name, r.rev_title, r.rev_approved, u.username FROM #__mt_archived_log AS log '
			."\n LEFT JOIN #__mt_links AS l ON l.link_id = log.link_id "
			."\n LEFT JOIN #__mt_archived_reviews AS r ON r.rev_id = log.rev_id "
			."\n LEFT JOIN #__users AS u ON u.id = l.user_id "
			."\n WHERE log.user_id = '".$id."'"
			."\n ORDER BY log.log_date DESC" );
		$user_activities = $database->loadObjectList();

		$database->setQuery( 'SELECT * FROM #__mt_archived_users WHERE id = \''.$id.'\' LIMIT 1' );
		$database->loadObject( $user );

		$database->setQuery( 'SELECT r.*, l.link_name, log.log_ip FROM #__mt_archived_reviews AS r '
			."\n LEFT JOIN #__mt_links AS l ON l.link_id = r.link_id "
			."\n LEFT JOIN #__mt_archived_log AS log ON log.rev_id = r.rev_id AND log.log_type = 'review' "
			."\n WHERE r.user_id = '".$id."' "
			."\n ORDER BY r.rev_date DESC" );
		$reviews = $database->loadObjectList();
		
		$links = array();
		/*
		$database->setQuery( 'SELECT l.*, '
			."(select COUNT(*) FROM #__mt_reviews AS r where r.link_id = l.link_id) AS reviews "
			."\n FROM #__mt_links AS l "
			."\n WHERE l.user_id = '" . $id . "' "	
			);
		$links = $database->loadObjectList();
		*/
		
		# Load removed clones if available
		$archived_clones = array();
		/*
		$database->setQuery('SELECT co.user_id, au.username FROM #__mt_clone_owners AS co LEFT JOIN #__mt_archived_users AS au ON au.id = co.user_id WHERE co.owner_id = ' . $id);
		$removed_clones = $database->loadObjectList();
		*/
		
		//$clones = loadClones( $id );
		$Itemid = getMTItemid();

		HTML_mtspy::viewUser( $option, $Itemid, $user_activities, $reviews, $links, $user );
	
	} else {
		mosRedirect( 'index2.php?option=com_mtree&task=spy&task2=viewusers' );
	}

}

function viewUser( $option, $id ) {
	global $database;
	
	if( $id > 0 ) {

		$database->setQuery( 'SELECT * FROM #__users WHERE id = \''.$id.'\' LIMIT 1' );
		$database->loadObject( $user );

		if(is_null($user)) {
			mosRedirect( 'index2.php?option=com_mtree&task=spy&task2=viewusers' );
		} else {

			$database->setQuery( 'SELECT log.*, l.link_id, l.link_name, r.rev_title, r.rev_approved, u.username FROM #__mt_log AS log '
				."\n LEFT JOIN #__mt_links AS l ON l.link_id = log.link_id "
				."\n LEFT JOIN #__mt_reviews AS r ON r.rev_id = log.rev_id "
				."\n LEFT JOIN #__users AS u ON u.id = l.user_id "
				."\n WHERE log.user_id = '".$id."'"
				."\n ORDER BY log.log_date DESC" );
			$user_activities = $database->loadObjectList();

			$database->setQuery( 'SELECT r.*, l.link_name, log.log_ip FROM #__mt_reviews AS r '
				."\n LEFT JOIN #__mt_log AS log ON log.rev_id = r.rev_id AND log.log_type = 'review' "
				."\n LEFT JOIN #__mt_links AS l ON l.link_id = r.link_id "
				."\n WHERE r.user_id = '".$id."' "
				."\n ORDER BY r.rev_date DESC" );
			$reviews = $database->loadObjectList();

			$database->setQuery( 'SELECT l.*, '
				."(select COUNT(*) FROM #__mt_reviews AS r where r.link_id = l.link_id) AS reviews "
				."\n FROM #__mt_links AS l "
				."\n WHERE l.user_id = '" . $id . "' "	
				);
			$links = $database->loadObjectList();
		
			# Load removed clones if available
			$archived_clones = array();
			$database->setQuery('SELECT co.user_id, au.username FROM #__mt_clone_owners AS co LEFT JOIN #__mt_archived_users AS au ON au.id = co.user_id WHERE co.owner_id = ' . $id);
			$removed_clones = $database->loadObjectList();
		
			# Assigning points to possible clones. More point a user has, the more like this clone (if it is one) is created by the user
			$possible_cloners = array();
			$possible_cloners_points = array();
			$possible_cloners_output = array();
			$lists = array();
			foreach( $user_activities AS $ua ) {
				if( !in_array($ua->username,$possible_cloners) ) {
					$possible_cloners[] = $ua->username;
					$possible_cloners_points[$ua->username] = 0;
				}
				switch($ua->log_type) {
					case 'vote':
						$possible_cloners_points[$ua->username] += ($ua->value -3) * 2;
						break;
					case 'review':
						$possible_cloners_points[$ua->username]++;
						break;
					case 'addfav':
						$possible_cloners_points[$ua->username]++;
						break;
					case 'votereview':
					case 'removefav':
					case 'replyreview':
						// No point
						break;
				}
			}
			arsort($possible_cloners_points);
			if(count($possible_cloners_points)>0) {
				foreach($possible_cloners_points AS $key => $value) {
					// if($value > 0) {
						// $possible_cloners_output[] = mosHTML::makeOption( $key, $key );
						$possible_cloners_output[] = mosHTML::makeOption( $key, $key . ' ('.$value.' points)' );
					// }
				}
			}
			$possible_cloners_output[] = mosHTML::makeOption( '-1', 'Other...' );

			if(count($possible_cloners_output) > 1) {
				$lists['clone_owner'] = mosHTML::selectList( $possible_cloners_output, 'clone_owner', 'id="clone_owner" class="text_area" size="1" onchange="detectOther(this)"',	'value', 'text');
			}

			$clones = loadClones( $id );
			$Itemid = getMTItemid();

			HTML_mtspy::viewUser( $option, $Itemid, $user_activities, $reviews, $links, $user, $clones, $removed_clones, $lists );
		}
	
	} else {
		mosRedirect( 'index2.php?option=com_mtree&task=spy&task2=viewusers' );
	}

}

function viewUsers( $option ) {
	global $database, $mainframe, $_MT_LANG;

	$orderby = mosGetParam( $_REQUEST, 'orderby', 'latestactivities' );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 25 );
	// $limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );
	$limitstart = mosGetParam( $_REQUEST, 'limitstart', 0 );

	$search['username_name'] = mosGetParam( $_POST, 'username_name', '' );
	$search['username'] = mosGetParam( $_POST, 'username', '' );
	$search['id'] = mosGetParam( $_POST, 'id', '' );
	$search['name'] = mosGetParam( $_POST, 'name', '' );
	$search['email'] = mosGetParam( $_POST, 'email', '' );
	$search['password'] = mosGetParam( $_POST, 'password', '' );
	if( empty($search['password']) ) { $search['password'] = mosGetParam( $_REQUEST, 'password', '' );	}
	$search['ip'] = mosGetParam( $_POST, 'ip', '' );
	if( empty($search['ip']) ) { $search['ip'] = mosGetParam( $_REQUEST, 'ip', '' );	}
	
	$where = array();

	if( !empty($search['username_name']) ) { 
		$where['username_name'] = "(u.username LIKE '%".$search['username_name']."%' OR u.name LIKE '%".$search['username_name']."%')";
	}
	if( !empty($search['username']) ) { $where['username'] = "u.username LIKE '%".$search['username']."%'"; }
	if( !empty($search['name']) ) { $where['name'] = "u.name LIKE '%".$search['name']."%'"; }
	if( !empty($search['id']) ) { $where['id'] = "u.id = '".$search['id']."'"; }
	if( !empty($search['email']) ) { $where['email'] = "u.email LIKE '%".$search['email']."%'"; }
	if( !empty($search['password']) ) { $where['password'] = "u.password = '".$search['password']."'"; }
	if( !empty($search['ip']) ) { $where['ip'] = "l.log_ip = '".$search['ip']."'"; }
	
	// When doing a search and the orderby is set to 'latestactivities',
	// the sort type is force set to by 'Latest Users'. 'latestactivities' 
	// does not offer effective effective grouping to give a better view of the results.
	if( count( $where ) > 0 && $orderby == 'latestactivities' ) {
		$orderby = 'latestusers';
	
	}
	switch( $orderby ) {

		case 'mostvotes':
			$orderby_query = 'votes DESC';
			break;

		case 'mostreviews':
			$orderby_query = 'reviews DESC';
			break;

		case 'mosthelpfuls':
			$orderby_query = 'votereviews DESC';
			break;

		case 'mostlistings':
			$orderby_query = 'listings DESC';
			break;

		case 'latestactivities':
			$orderby_query = 'l.log_date DESC';
			break;

		case 'lastvisit':
			$orderby_query = 'u.lastvisitDate DESC';
			break;

		default:
		case 'latestusers':
			$orderby_query = 'u.id DESC';
			break;
	}

	$Itemid = getMTItemid();

	// Users
	if( !empty($search['ip']) ) {
		$database->setQuery( 'SELECT COUNT(DISTINCT u.id) FROM #__users AS u '
			."\n LEFT JOIN #__mt_log AS l ON l.user_id = u.id "
			.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
		);
	} elseif( $orderby == 'latestactivities' ) {
		$database->setQuery( 'SELECT COUNT(*) FROM #__mt_log' );
	} elseif( $orderby == 'mostreviews' ) {
		$database->setQuery( 'SELECT COUNT(DISTINCT user_id) FROM #__mt_reviews' );
	} elseif( $orderby == 'mostvotes' ) {
		$database->setQuery( 'SELECT COUNT(DISTINCT user_id) FROM #__mt_log WHERE log_type = \'vote\'' );
	} elseif( $orderby == 'mosthelpfuls' ) {
		$database->setQuery( 'SELECT COUNT(DISTINCT user_id) FROM #__mt_log WHERE log_type = \'votereview\'' );
	} elseif( $orderby == 'mostlistings' ) {
		$database->setQuery( 'SELECT COUNT(DISTINCT user_id) FROM #__mt_links' );
	} else {
		$database->setQuery( 'SELECT COUNT(*) FROM #__users AS u '
			.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )	);
	}
	$totalusers = $database->loadResult();

	if( $orderby == 'latestactivities' ) {
		$database->setQuery( 'SELECT u.*, l.* '
			."\n FROM #__mt_log AS l "
			."\n LEFT JOIN #__users AS u ON l.user_id = u.id "
			.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
			."\n ORDER BY ".$orderby_query.' '
			."\n LIMIT ".$limitstart.', '.$limit
			);
			$users = $database->loadObjectList();
	} else {
		switch($orderby) {
			case 'mostvotes':
				$database->setQuery( 'SELECT u.*, l.*, count(l.log_id) AS votes '
					."\n FROM #__users AS u "
					."\n LEFT JOIN #__mt_log AS l ON l.user_id = u.id AND l.log_type = 'vote'"
					.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
					."\n GROUP BY l.user_id "
					."\n ORDER BY ".$orderby_query.' '
					."\n LIMIT ".$limitstart.', '.$limit
				);
				$users = $database->loadObjectList();
				break;
			case 'mostreviews':
				$database->setQuery("SELECT user_id, COUNT(rev_id) AS reviews FROM #__mt_reviews GROUP BY user_id ORDER BY reviews DESC LIMIT " . $limitstart . ', ' . $limit);
				$mostreviews = $database->loadObjectList('user_id');
				if(count($mostreviews) > 0) {
					foreach($mostreviews AS $mostreview) {
						$user_ids[] = $mostreview->user_id;
					}
					$where[] = 'l.user_id IN (' . implode(',',$user_ids) . ')';
					$database->setQuery( 'SELECT u.*, l.* '
						."\n FROM #__users AS u "
						."\n LEFT JOIN #__mt_log AS l ON l.user_id = u.id"
						.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
						."\n GROUP BY l.user_id "
						."\n LIMIT " . count($user_ids)
					);
					$users = $database->loadObjectList();
				} else {
					$users = array();
				}
				break;
			case 'mosthelpfuls':
				$database->setQuery( 'SELECT u.*, l.*, count(l.log_id) AS votereviews '
					."\n FROM #__users AS u "
					."\n LEFT JOIN #__mt_log AS l ON l.user_id = u.id AND l.log_type = 'votereview'"
					.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
					."\n GROUP BY l.user_id "
					."\n ORDER BY ".$orderby_query.' '
					."\n LIMIT ".$limitstart.', '.$limit
				);
				$users = $database->loadObjectList();
				break;
			case 'mostlistings':
				$database->setQuery("SELECT user_id, COUNT(link_id) AS listings FROM #__mt_links GROUP BY user_id ORDER BY listings DESC LIMIT " . $limitstart . ', ' . $limit);
				$mostlistings = $database->loadObjectList('user_id');
				foreach($mostlistings AS $mostlisting) {
					$user_ids[] = $mostlisting->user_id;
				}
				$where[] = 'u.id IN (' . implode(',',$user_ids) . ')';
				if(count($mostlistings) > 0) {
					$database->setQuery( 'SELECT u.*, l.* '
						."\n FROM #__users AS u "
						."\n LEFT JOIN #__mt_log AS l ON l.user_id = u.id"
						.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
						."\n GROUP BY u.id "
						."\n LIMIT " . count($user_ids)
					);
				} else {
					$database->setQuery( 'SELECT u.username, u.id, 0 AS link_id, 0 AS rev_id, \'\' AS name, \'\' AS log_type, \'\' AS value, \'\' AS log_ip '
						."\n FROM #__users AS u "
						.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
						."\n LIMIT " . count($user_ids)
					);
				}
				$users = $database->loadObjectList();
				break;
			default:
				$database->setQuery( 'SELECT u.*, l.* '
					."\n FROM #__users AS u "
					."\n LEFT JOIN #__mt_log AS l ON l.user_id = u.id "
					.( (isset($where) && count($where)>0) ? "\n WHERE ".implode(' AND ', $where) : '' )
					// ."\n GROUP BY u.id "
					."\n ORDER BY ".$orderby_query.' '
					."\n LIMIT ".$limitstart.', '.$limit
				);
				$users = $database->loadObjectList();
				break;
		}
	}

	$user_ids = array();
	$link_ids = array();
	$rev_ids = array();
	foreach($users AS $user) { 
		if(!in_array($user->id,$user_ids) && $user->id > 0) { 
			$user_ids[] = $user->id;
		} 
		if(!in_array($user->link_id,$link_ids) && $user->link_id > 0) { 
			$link_ids[] = $user->link_id;
		} 
		if(!in_array($user->rev_id,$rev_ids) && $user->rev_id > 0) { 
			$rev_ids[] = $user->rev_id;
		} 
	}

	# Get review counts
	$review_counts = array();
	if(!empty($user_ids)) {
		$database->setQuery("SELECT user_id, COUNT(*) AS reviews FROM #__mt_reviews WHERE user_id IN (" . implode(',',$user_ids). ") GROUP BY user_id LIMIT " . count($user_ids));
		$review_counts = $database->loadObjectList('user_id');
	}
	for($i=0;$i<count($users);$i++) { 
		if(array_key_exists($users[$i]->id,$review_counts) && !empty($review_counts)) {
			$users[$i]->reviews = $review_counts[$users[$i]->id]->reviews;
		} else {
			$users[$i]->reviews = 0;
		}
	}

	# Get vote counts
	$vote_counts = array();
	if(!empty($user_ids)) {
		$database->setQuery("SELECT user_id, COUNT(*) AS votes FROM #__mt_log WHERE log_type = 'vote' AND user_id  IN (" . implode(',',$user_ids). ") GROUP BY user_id LIMIT " . count($user_ids));
		$vote_counts = $database->loadObjectList('user_id');
	}
	for($i=0;$i<count($users);$i++) {
		if(array_key_exists($users[$i]->id,$vote_counts) && !empty($vote_counts)) {
			$users[$i]->votes = $vote_counts[$users[$i]->id]->votes;
		} else {
			$users[$i]->votes = 0;
		}
	}
	
	# Get votereview counts
	$votereview_counts = array();
	if(!empty($user_ids)) {
		$database->setQuery("SELECT user_id, COUNT(*) AS votereviews FROM #__mt_log WHERE log_type = 'votereview' AND user_id  IN (" . implode(',',$user_ids). ") GROUP BY user_id LIMIT " . count($user_ids));
		$votereview_counts = $database->loadObjectList('user_id');
	}
	for($i=0;$i<count($users);$i++) {
		if(array_key_exists($users[$i]->id,$votereview_counts) && !empty($votereview_counts)) {
			$users[$i]->votereviews = $votereview_counts[$users[$i]->id]->votereviews;
		} else {
			$users[$i]->votereviews = 0;
		}
	}

	# Get listing counts
	$listing_counts = array();
	if(!empty($user_ids)) {
		$database->setQuery("SELECT user_id, COUNT(*) AS listings FROM #__mt_links AS links WHERE user_id IN (" . implode(',',$user_ids). ") GROUP BY user_id LIMIT " . count($user_ids));
		$listing_counts = $database->loadObjectList('user_id');
	}
	for($i=0;$i<count($users);$i++) { 
		if(array_key_exists($users[$i]->id,$listing_counts) && !empty($listing_counts)) {
			$users[$i]->listings = $listing_counts[$users[$i]->id]->listings;
		} else {
			$users[$i]->listings = 0;
		}
	}
	
	# Load link names
	$link_names = array();
	if(!empty($link_ids)) {
		$database->setQuery("SELECT link_name, link_id FROM #__mt_links WHERE link_id IN (" . implode(',',$link_ids) . ") LIMIT " . count($link_ids));
		$link_names = $database->loadObjectList('link_id');
	}
	for($i=0;$i<count($users);$i++) { 
		if(array_key_exists($users[$i]->link_id,$link_names) && !empty($link_names)) {
			$users[$i]->link_name = $link_names[$users[$i]->link_id]->link_name;
		} else {
			$users[$i]->link_name = '';
		}
	}
	
	# Load review titles
	$reviews = array();
	if( !empty($reviews) ) {
		$database->setQuery("SELECT rev_id, rev_title, rev_approved FROM #__mt_reviews WHERE rev_id IN (" . implode(',',$rev_ids) . ")");
		$reviews = $database->loadObjectList('rev_id');
	}
	for($i=0;$i<count($users);$i++) { 
		if(array_key_exists($users[$i]->rev_id,$reviews) && empty($reviews)) {
			$users[$i]->rev_title = $reviews[$users[$i]->rev_id]->rev_title;
			$users[$i]->rev_approved = $reviews[$users[$i]->rev_id]->rev_approved;
		} else {
			$users[$i]->rev_title = '';
			$users[$i]->rev_approved = null;
		}
	}

	switch($orderby) {
		case 'mostreviews':
			usort($users, "usort_mtlog_mostreviews");
			break;
		case  'mostlistings':
			usort($users, "usort_mtlog_mostlistings");
			break;
	}
	
	# Page Navigation
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $totalusers, $limitstart, $limit );

	$orderbys[] = mosHTML::makeOption( 'latestactivities', $_MT_LANG->LATEST_ACTIVITIES );
	$orderbys[] = mosHTML::makeOption( 'latestusers', $_MT_LANG->LATEST_USERS );
	$orderbys[] = mosHTML::makeOption( 'mostvotes', $_MT_LANG->MOST_VOTES );
	$orderbys[] = mosHTML::makeOption( 'mostreviews', $_MT_LANG->MOST_REVIEWS );
	$orderbys[] = mosHTML::makeOption( 'mosthelpfuls', $_MT_LANG->MOST_HELPFULS );
	$orderbys[] = mosHTML::makeOption( 'mostlistings', $_MT_LANG->MOST_LISTINGS );
	$orderbys[] = mosHTML::makeOption( 'lastvisit', $_MT_LANG->RECENTLY_LOGIN );

	$lists['orderby'] = mosHTML::selectList( $orderbys, 'orderby', 'class="inputbox" size="1" onchange="document.adminForm.limitstart.value=0;document.adminForm.submit();"',
	'value', 'text', $orderby );

	HTML_mtspy::viewUsers( $option, $lists, $search, $pageNav, $Itemid, $users );

}

function getMTItemid() {
	global $database;
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$Itemid = $database->loadResult();
	return $Itemid;
}

function loadClones( $user_id ) {
	global $database;

	$sql = 'SELECT DISTINCT log.user_id, u.username, u.name, u.block AS user_blocked, log.log_ip '
		."\n FROM #__mt_log AS log "
		."\n LEFT JOIN #__users AS u ON u.id = log.user_id "
		."\n WHERE log_ip IN ( "
		."\n  SELECT log_ip "
		."\n  FROM #__mt_log AS log2 "
		."\n  WHERE log2.user_id = " . $user_id
		."\n ) "
		."\n AND log.user_id <> " . $user_id
		."\n ORDER BY log.log_ip DESC ";

	$database->setQuery( $sql );
	return $database->loadObjectList();

}

function loadClonesUserid( $user_id ) {
	global $database;

	$sql = 'SELECT DISTINCT log.user_id '
		."\n FROM #__mt_log AS log "
		."\n LEFT JOIN #__users AS u ON u.id = log.user_id "
		."\n WHERE log_ip IN ( "
		."\n  SELECT log_ip "
		."\n  FROM #__mt_log AS log2 "
		."\n  WHERE log2.user_id = " . $user_id
		."\n ) "
		."\n AND log.user_id <> " . $user_id
		."\n ORDER BY log.log_ip DESC ";

	$database->setQuery( $sql );
	return $database->loadResultArray();

}

function usort_mtlog_mostreviews($a, $b)
{
	if($a->reviews == $b->reviews) {
        return 0;
    }
    return ($a->reviews < $b->reviews) ? 1 : -1;
}
function usort_mtlog_mostlistings($a, $b)
{
	if($a->listings == $b->listings) {
        return 0;
    }
    return ($a->listings < $b->listings) ? 1 : -1;
}
?>