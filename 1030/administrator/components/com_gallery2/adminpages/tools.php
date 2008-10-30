<?php
//defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Syncs user to Gallery2, option to sync g2 to Joomla
 *
 * @param boolean $g2ToJoomla
 * @param boolean $g2debug
 * @return void() will redirect to user page
 */
define( '_VALID_MOS', 1);
function syncUsers($debug=false){
	global $g2Config;
	core::initiatedG2();
	core::classRequireOnce('userSync');
	core::classRequireOnce('user');
		/* some text and a progress bar */
		?>
		
		<link rel="stylesheet" type="text/css" href="http://www.bijland.net/gallery2/themes/matrix/theme.css"/>
		<div id="ProgressBar">
			<h3 id="progressTitle">
				&nbsp;
			</h3>
			<p id="progressDescription">
				&nbsp;
			</p>
			<table width="80%" cellspacing="0" cellpadding="0">
				<tr>
					<td id="progressDone" style="display: inline-block; width:0%;">&nbsp;</td>
					<td id="progressToGo" style="display: inline-block; width:100%; border-left: none;">&nbsp;</td>
				</tr>
			</table>
			<p id="progressTimeRemaining">
				&nbsp;
			</p>
		</div>
		<?php ob_flush(); flush(); ?>
		<script type="text/javascript">
		document.write("Wait Until Finished Or database corruption may occur!");
		  var saveToGoDisplay = document.getElementById('progressToGo').style.display;
		  function updateProgressBar(title, description, percentComplete, timeRemaining, memoryInfo) {
		    document.getElementById('progressTitle').innerHTML = title;
		    document.getElementById('progressDescription').innerHTML = description;
		    
			var progressMade = percentComplete;
			var progressToGo = document.getElementById('progressToGo');
		    if (progressMade == 100) {
		      progressToGo.style.display = 'none'; 
		    } else {
		      progressToGo.style.display = saveToGoDisplay;
		      progressToGo.style.width = (100 - progressMade) + "%";
		    }
		
		    document.getElementById('progressDone').style.width = progressMade + "%";
		    document.getElementById('progressTimeRemaining').innerHTML = timeRemaining;
		    //document.getElementById('progressMemoryInfo').innerHTML = memoryInfo;
		  }
		
		  function completeProgressBar(url) {
		    var link = document.getElementById('progressContinueLink');
		    link.href = url;
		    link.style.display = 'block';
		  }
		
		  function errorProgressBar(html) {
		    var errorInfo = document.getElementById('progressErrorInfo');
		    errorInfo.innerHTML = html;
		    errorInfo.style.display = 'block';
		  }
		  
		  function resetBar(){
		  	
		  }
		</script>
		<?php
		ob_flush();
		flush();
		/* let's go */
		list($ret, $g2Usernames) = GalleryCoreApi::fetchUsernames();
		if($ret){
			return $ret->wrap(__FILE__, __LINE__);
		}
		$g2UserById = array();
		$g2UserByUsername = array();
		$i = 0;
		$total = count($g2Usernames);
		$increment = min(100, $total * 0.10);
		$startTime = time();
		$title = 'Making list of Gallery2 Users';
		userSync::timeLimit();
		/* make the list for gallery2 users */
		print userSync::progressUpdate($title, 'Start', '0', $startTime);
		foreach($g2Usernames as $g2Username){
			$i++;
			if($i % $increment == 0 || $i == $total){
				userSync::timeLimit();
				$description = sprintf('processing %d of %d.', $i, $total);
				print userSync::progressUpdate($title, $description, round($i/$total*100), $startTime);
				ob_flush();
				flush();
			}
			/* build */
			list($ret, $g2User) = GalleryCoreApi::fetchUserByUserName($g2Username);
			if($ret){
				return $ret->wrap(__FILE__, __LINE__);
			}
			$g2UserById[$g2User->getId()] = $g2User;
			$g2UserByUsername[strtolower($g2Username)] = $g2User;
		}
		print userSync::progressUpdate($title, 'Sync Complete', '100', $startTime);
		
		/* now do the same for Joomla user list */
		flush();
		ob_flush();
		global $database;
		$database->setQuery("SELECT `id`, `name` as fullname, `username`, `email`, `password` AS hashedpassword,"
							." `block` FROM `#__users`");
		$result = $database->query();
		
		$joomlaUserById = array();
		$joomlaUserByUsername = array();
		$i = 0;
		$total = $database->getNumRows();
		$increment = min(100, $total * 0.10);
		$startTime = time();
		$title = 'Making list of Joomla Users';
		userSync::timeLimit();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$i++;
			if($i % $increment == 0 || $i == $total){
				userSync::timeLimit();
				$description = sprintf('processing %d of %d.', $i, $total);
				print userSync::progressUpdate($title, $description, round($i/$total*100), $startTime);
				ob_flush();
				flush();	
			}
			$joomlaUser = array();
			foreach($row as $key => $val){
					$joomlaUser[$key] = $val;
			}
			$joomlaUser['hashmethod'] = 'md5'; 
			$joomlaUserById[$row['id']] = $joomlaUser;
			$joomlaUserByUsername[strtolower($row['username'])] = $joomlaUser;	
		}
		print userSync::progressUpdate($title, 'Sync Complete', '100', $startTime);
		
		/* now the map */
		list($ret, $mapEntityId) = GalleryEmbed::getExternalIdmap('entityId');
		if($ret){
			return $ret->wrap(__FILE__, __LINE__);
		}
		
		$i = 0;
		$total = count($mapEntityId);
		$increment = min(100, $total * 0.10);
		$startTime = time();
		$title = 'Checking for obsolete user mappings.';
		userSync::timeLimit();
		/* loop throuh checking if the users still exist on both sides */
		print userSync::progressUpdate($title, 'Start', '0', $startTime);
		foreach($mapEntityId as $entityId => $mapEntry){
			$i++;
			if($i % $increment == 0 || $i == $total){
				userSync::timeLimit();
				$description = sprintf('processing %d of %d.', $i, $total);
				print userSync::progressUpdate($title, $description, round($i/$total*100), $startTime);
				ob_flush();
				flush();	
			}
			/* first check if it's not a group id */
			if($mapEntry['entityType'] != 'GalleryUser'){
				continue;	
			}
			$externalId = $mapEntry['externalId'];
			/* gallery2 side */
			if(!isset($g2UserById[$entityId])){
				/* it doesn't exist */
				$ret = GalleryCoreApi::removeMapEntry('ExternalIdMap',
						array('entityId' => $entityId, 'entityType' => 'GalleryUser'));
				if($ret){
					return $ret->wrap(__FILE__, __LINE__);
				}
				continue;	
			}
	
			if(!isset($joomlaUserById[$externalId])){
				/* doesn't exist */
				$ret = GalleryCoreApi::removeMapEntry('ExternalIdMap', 
						array('externalId' => $externalId, 'entityType' => 'GalleryUser'));
				if($ret){
					return $ret->wrap(__FILE__, __LINE__);
				}
				continue;	
			}	
		}
		print userSync::progressUpdate($title, 'Sync Complete', '100', $startTime);
		
		/* reload the cleaned map and use externalId*/
		list($ret, $mapByExternalId) = GalleryEmbed::getExternalIdmap('externalId');
		if($ret){
			print $ret->getAsHtml();
		}
		
		/* this would be a good time to safe all info gather so we can start here after a failure */
		$i = 0;
		$total = count($joomlaUserById);
		$increment = min(100, $total * 0.10);
		$startTime = time();
		$title = 'Syncing Joomla Users to G2.';
		userSync::timeLimit();
		/* make ready for loop */
		$lowercaseG2Usernames = array();
		foreach($g2Usernames as $username){
			$lowercaseG2Usernames[] = strtolower($username);	
		}
		/* loop */
		print userSync::progressUpdate($title, 'Start', '0', $startTime);

		foreach($joomlaUserById as $externalId => $joomlaUser){
			$i++;
			if($i % $increment == 0 || $i == $total){
				userSync::timeLimit();
				$description = sprintf('processing %d of %d.', $i, $total);
				print userSync::progressUpdate($title, $description, round($i/$total*100), $startTime);
				ob_flush();
				flush();
			}
			if(isset($mapByExternalId[$externalId])){
				/* exists we need to update */
				$ret = user::updateUser($externalId, $joomlaUser);
				if($ret){
					print $ret->getAsHtml();
				}
			} else {
				/* not mapped, looking for username in G2 */
				if(!in_array(strtolower($joomlaUser['username']), $lowercaseG2Usernames)){
					/* no username found, we can savely create user in G2 */
					$ret = GalleryEmbed::createUser($externalId, $joomlaUser);
					if($ret){
						print $ret->getAsHtml();
					}
				} else {
					/* we need to compare them before hooking them up */
					$g2User = $g2UserByUsername[strtolower($joomlaUser['username'])];
					$entityId = $g2User->getId();
					$compare = userSync::compareUsers($g2User, $joomlaUser);
					if(empty($compare)){
						/* no conflicts we can safely hook them up */
						GalleryEmbed::addExternalIdMapEntry($externalId, $entityId, 'GalleryUser');
						/* we might want to update also */
						$ret = user::updateUser($externalId, $joomlaUser);
						if($ret){
							print $ret->getAsHtml();
						}
					} else {
						/* conflicts we can't hook them up, create a new user */
						print 'print user conflict! for '.$joomlaUser['username'].'<br />';
					}	
				}
			}
		}
		print userSync::progressUpdate($title, 'Sync Complete', '100', $startTime);
	
	/* only perform g2 sync to joomla when requested */
	if($g2Config['g2ToJoomla']==1){	
		/* reload the map as it might have changed */
		list($ret, $mapByEntityId) = GalleryEmbed::getExternalIdmap('entityId');
		if($ret){
			return $ret->wrap(__FILE__, __LINE__);
		}
		/* reload G2 Users */
		list($ret, $g2Usernames) = GalleryCoreApi::fetchUsernames();
		if($ret){
			return $ret->wrap(__FILE__, __LINE__);
		}
		$g2UserById = array();
		$g2UserByUsername = array();
		$i = 0;
		$total = count($g2Usernames);
		$increment = min(100, $total * 0.10);
		$startTime = time();
		$title = 'Reloading list of Gallery2 Users';
		userSync::timeLimit();
		print userSync::progressUpdate($title, 'Start', '0', $startTime);
		/* make the list for gallery2 users */
		foreach($g2Usernames as $g2Username){
			$i++;
			if($i % $increment == 0){
				userSync::timeLimit();
				$description = sprintf('processing %d of %d.', $i, $total);
				print userSync::progressUpdate($title, $description, round($i/$total*100), $startTime);
				ob_flush();
				flush();
			}
			/* build */
			list($ret, $g2User) = GalleryCoreApi::fetchUserByUserName($g2Username);
			if($ret){
				return $ret->wrap(__FILE__, __LINE__);
			}
			$g2UserById[$g2User->getId()] = $g2User;
			$g2UserByUsername[strtolower($g2Username)] = $g2User;
		}
		print userSync::progressUpdate($title, 'Sync Complete', '100', $startTime);	
		
		/* let's sync the G2 user to Joomla */
		$i = 0;
		$total = count($g2Usernames);
		$increment = min(100, $total * 0.10);
		$startTime = time();
		$title = 'Syncing G2 users to Joomla.';
		userSync::timeLimit();
		print userSync::progressUpdate($title, 'Start', '0', $startTime);
		foreach($g2UserById as $entityId => $g2User){
			$i++;
			/* update bar and timelimit every 50 users */
			if($i % $increment == 0 || $i == $total){
				userSync::timeLimit();
				$description = sprintf('processing %d of %d.', $i, $total);
				print userSync::progressUpdate($title, $description, round($i/$total*100), $startTime);
				ob_flush();
				flush();
			}
			if(!isset($mapByEntityId[$entityId]) && $entityId !=5 && $entityId !=6){
				/* not in the map check if exist in Joomla */
				if(array_key_exists(strtolower($g2User->getusername()), $joomlaUserByUsername)){
					/* User exists, compare the 2 before hooking them up */
						$joomlaUser = $joomlaUserByUsername[strtolower($g2User->getusername())];
						$externalId = $joomlaUser['id'];
						$compare = userSync::compareUsers($g2User, $joomlaUser );
						if(empty($compare)){
							/* no conflicts we can safely hook them up */
							GalleryEmbed::addExternalIdMapEntry($externalId, $entityId, 'GalleryUser');
						} else {
							/* conflicts we can't hook them up, create a new user */
							print 'print user conflict! for '.$g2User->getusername().'<br />';
						}	
				} else {
					$externalId = userSync::createJoomlaUser($g2User);
					GalleryEmbed::addExternalIdMapEntry($externalId, $entityId, 'GalleryUser');
				}
			}	
		}
		/* reset Config setting syncG2ToJoomla this should only be needed ones */
		$database->setQuery( "UPDATE `#__gallery2` SET `value` = '0' WHERE `key` = 'g2ToJoomla'" );
		$database->query();
		print userSync::progressUpdate($title, 'Sync Complete', '100', $startTime);
	}
	/* we are done redirect back to user page */
	if(!$debug){
		mosRedirect( "index2.php?option=com_gallery2&act=user", 'Synced Succesfully' );
	}
	/* if we don't redirect die the script else we get header problems! */
	die('<br /><br />Dit we reach it?');
}

function syncGroup($debug=false){
	global $g2Config, $database; /* $g2Config['userGroupRecursive'] */
	core::initiatedG2();
	core::classRequireOnce('userSync');
	core::classRequireOnce('user');
	/* some text and a progress bar */
		?>
		
		<link rel="stylesheet" type="text/css" href="http://www.bijland.net/gallery2/themes/matrix/theme.css"/>
		<div id="ProgressBar">
			<h3 id="progressTitle">
				&nbsp;
			</h3>
			<p id="progressDescription">
				&nbsp;
			</p>
			<table width="80%" cellspacing="0" cellpadding="0">
				<tr>
					<td id="progressDone" style="display: inline-block; width:0%;">&nbsp;</td>
					<td id="progressToGo" style="display: inline-block; width:100%; border-left: none;">&nbsp;</td>
				</tr>
			</table>
			<p id="progressTimeRemaining">
				&nbsp;
			</p>
		</div>
		<?php ob_flush(); flush(); ?>
		<script type="text/javascript">
		document.write("Wait Until Finished Or database corruption may occur!");
		  var saveToGoDisplay = document.getElementById('progressToGo').style.display;
		  function updateProgressBar(title, description, percentComplete, timeRemaining, memoryInfo) {
		    document.getElementById('progressTitle').innerHTML = title;
		    document.getElementById('progressDescription').innerHTML = description;
		    
			var progressMade = percentComplete;
			var progressToGo = document.getElementById('progressToGo');
		    if (progressMade == 100) {
		      progressToGo.style.display = 'none'; 
		    } else {
		      progressToGo.style.display = saveToGoDisplay;
		      progressToGo.style.width = (100 - progressMade) + "%";
		    }
		
		    document.getElementById('progressDone').style.width = progressMade + "%";
		    document.getElementById('progressTimeRemaining').innerHTML = timeRemaining;
		    //document.getElementById('progressMemoryInfo').innerHTML = memoryInfo;
		  }
		
		  function completeProgressBar(url) {
		    var link = document.getElementById('progressContinueLink');
		    link.href = url;
		    link.style.display = 'block';
		  }
		
		  function errorProgressBar(html) {
		    var errorInfo = document.getElementById('progressErrorInfo');
		    errorInfo.innerHTML = html;
		    errorInfo.style.display = 'block';
		  }
		  
		  function resetBar(){
		  	
		  }
		</script>
	<?php
	ob_flush();
	flush();
	/* that done let's loop through groups */
	/* get the groups */
	$database->setQuery("SELECT * FROM `#__core_acl_aro_groups` WHERE `group_id` NOT IN (17,28,29,30)");
	$rows = $database->query();
	/* get users */
	$database->setQuery("SELECT `id`, `gid` FROM `#__users`");
	$users = $database->query();
	$totalusers = $database->getNumRows();
	$increment = min(100, $totalusers * 0.1);
	$i = 0;
	$startTime = time();
	$title = 'Syncing users to There Groups.';
	$databaseloop = true;
	while($row = mysql_fetch_assoc($rows)){
		$row['name'] = 'J_'.$row['name'];
		$ret = GalleryEmbed::isExternalIdMapped($row['group_id'], 'GalleryGroup');
		if ($ret->_errorCode) {
			/* external id not found, check if there is a username that looks like it */
			$gGroup = GalleryCoreApi::fetchGroupByGroupName ($row['name']);
			if (!$gGroup[0]->_errorCode){
				/* group found, hook them up */
				$entityId = $gGroup[0]->getId();
				GalleryEmbed::addExternalIdMapEntry($row['group_id'], $entityId, 'GalleryGroup');
			} else {
				/* no group found with that name, create it */
				group::newGroup($row['group_id'], $row['name']);	
			}
		}
		/* begin the user loop, we use 2 loops, the fist database and largest loop
		 * using this lop to construct a array of users with higher permission this
		 * loop should much shorter every pass around */
		/* database loop */
		if($databaseloop){
			while($user = mysql_fetch_row($users)){
				$i++;
				if($i % $increment == 0 || $i == $totalusers){
					userSync::timeLimit();
					$description = sprintf('processing %d of %d.', $i, $totalusers);
					print userSync::progressUpdate($title, $description, round($i/$totalusers*100), $startTime);
					ob_flush();
					flush();
				}
				if($row['group_id'] == $user[1]) {
					$ret = user::addUserGroup($user[0], $row['group_id']);
				} else if($g2Config['userGroupRecursive'] == 1){
					user::addUserGroup($user[0], $row['group_id']);
					$userArray[$user[0]] = $user[1];
				} else {
					$userArray[$user[0]] = $user[1];	
				}
			}
			unset($users, $row, $user);
			$databaseloop = false;	
		} else {
			/* second loop and much faster, but set new progresbar settings */
			$totalusers = count($userArray);
			$i = 0;
			$startTime = time();
			foreach($userArray as $userid => $gid){
				$i++;
				if($i % $increment == 0 || $i == $totalusers){
					userSync::timeLimit();
					$description = sprintf('processing %d of %d.', $i, $totalusers);
					print userSync::progressUpdate($title, $description, round($i/$totalusers*100), $startTime);
					ob_flush();
					flush();
				}
				
				if($row['group_id'] == $gid) {
					user::addUserGroup($userid, $row['group_id']);
					unset($userArray[$userid]);
				} else if($g2Config['userGroupRecursive'] == 1){
					user::addUserGroup($userid, $row['group_id']);
				}
			}
		}
	}
	
	GalleryEmbed::done();
	/* we are done redirect back to user page */
	if(!$debug){
		mosRedirect( "index2.php?option=com_gallery2&act=user", 'Synced Succesfully' );
	}
	/* if we don't redirect die the script else we get header problems! */
	die;
}
?>