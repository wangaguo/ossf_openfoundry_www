<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
 * html part
 */
 
 class HTML {
	
		//userlist
	function showUsers( &$rows, $pageNav, $search, $option, $lists, $param ) {
		global $my;
		//start G2 embed
		$ret =  core::initiatedG2($my->id, 'true');

		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="user">
			User Manager Gallery 2
			</th>
			<td>
			Filter:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
			<!--
			<td width="right">
			<?php echo $lists['type'];?>
			</td>
			<td width="right">
			<?php echo $lists['logged'];?>
			</td>-->
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="2%" class="title">
			#
			</th>
			<!--
			<th width="3%" class="title">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			-->
			<th class="title">
			Fullname
			</th>
			<!--
			<th width="5%" class="title" nowrap="nowrap">
			Logged In
			</th>-->
			<th width="5%" class="title">
			Enabled
			</th>
			<th width="15%" class="title" >
			Username
			</th>
			<th width="15%" class="title">
			Group
			</th>
			<th width="5%" class="title">
			G2 user check
			</th>
			<th width="25%" class="title">
			Error Message
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	=& $rows[$i];
			unset($error_msg);
			$img 	= $row->block ? 'publish_x.png' : 'tick.png';
			$task 	= $row->block ? 'unblock' : 'block';
			$alt 	= $row->block ? 'Enabled' : 'Blocked';
			$link 	= 'index2.php?option=com_gallery2&amp;act=user&amp;task=user_edit&amp;id='. $row->id. '&amp;hidemainmenu=1';
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $i+1+$pageNav->limitstart;?>
				</td>
				<!--<td>
				<?php echo mosHTML::idBox( $i, $row->id ); ?>
				</td>-->
				<td>
				<a href="<?php echo $link; ?>">
				<?php echo $row->name; ?>
				</a>
				</td>
				<!--
				<td align="center">
				<?php echo $row->loggedin ? '<img src="images/tick.png" width="12" height="12" border="0" alt="" />': ''; ?>
				</td>-->
				<td>
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
				</td>
				<td>
				<?php echo $row->username; ?>
				</td>
				<td>
				<?php echo $row->groupname; ?>
				</td>
				<td align="center">
				<?php
					$ret = GalleryEmbed::isExternalIdMapped($row->id, 'GalleryUser');
					if (!$ret->_errorCode) {
						//if external id found
						//check if all is in sync? todo
						//unset($flag);
						$flag = false;
						list( $ret , $gUser) = GalleryCoreApi::loadEntityByExternalId($row->id, 'GalleryUser');
						if ($ret->_errorCode){
							$flag = true;
							$error_msg[]='Mapping error';
							
						} else {
							if($gUser->getuserName() != $row->username ){ $flag = true; $error_msg[]='Username';}
							if($gUser->getfullName() != $row->name){ $flag = true; $error_msg[]='Fullname';}
							if($gUser->getemail() != $row->email){ $flag = true; $error_msg[]='email';}
							if($gUser->gethashedPassword() != $row->password){
							 	//check if user is blocked
								if($row->block == 1){
									print '<img src="images/disabled.png"> / ';
									$error_msg[]='User is blocked!';
									$flag = false;
								} else {
									$flag = true;
									$error_msg[]='password';
								}
							}
						}
						if(!$flag){
							print '<img src="images/tick.png">';
						} else {
							print '<img src="images/publish_x.png">';
						}
						
					}else{
						$gUser = GalleryCoreApi::fetchUserByUsername ($row->username);
						if (!$gUser[0]->_errorCode) {
							//Collision i think
							echo '<img src="images/disable.png">';
						}else{
							//if no match and no external id
							$error_msg[]='User doesn\'t exist in G2';
							echo '<img src="images/publish_x.png">';
						}
					}
				?>
				</td>
				<td align="left">
				<?php 
				if(!empty($error_msg) AND count($error_msg) > 0){
					print implode(", " ,$error_msg);
				}
				 ?>
				</td>
				</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="act" value="user" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}
//clean this function up and check html<<check<<	
function showUserDetails( $option, $act, $task, $userId, $groupids, $count_total, $count_album, $album_ids, $groupswitch,  $g2_id ){
	global $database;
	$database->setQuery("SELECT username FROM #__users WHERE id = $userId");
	$username = $database->loadResult();
	
	?>
	<table class="adminheading">
		<tr>
			<th class="user">
			User Details For <?php print $username;?>
			</th>
		</tr>
	</table>
<form action="index2.php" method="post" name="adminForm">
<table align="left">
  <tr> 
    <td>
	 
        <table width="100%" border="0" cellpadding="4" class="adminform">
		  <tr><th>Summary:</th><th></th></tr>
          <tr> 
            <td width="180"><strong>Number of albums:</strong></td>
            <td><?php print $count_album ?></td>
          </tr>
          <tr> 
            <td width="180"><strong>Number of Photo's:</strong></td>
            <td><?php print ($count_total - $count_album) ?></td>
          </tr>
        </table>
      </td>
  </tr>
  <tr> 
    <td>
          <table width="100%" border="0" cellpadding="4" class="adminform">
            <tr>
				<th width="200px" align="left">groupname:</th>
					<th align="left">member:</th>
			</tr>
            <?php
  foreach ($groupids as $id => $name) {
 		print  '<tr><td>'.$name.'</td><td>'.$groupswitch[$name].'</td></tr>';
	}
?>
            <!--<tr>
<td><input name="" type="button" value="remove from group"></td>
</tr>-->
          </table>
        </div>
   		</td>
  </tr>
  <?php if($count_album > 0){  ?>
  <tr> 
    <td>
        <table width="100%" border="0" cellpadding="4" class="adminform">
		<tr><th>User albums:</th><th></th></tr>
          <?php
	 	
	 list ($ret, $items) = GalleryCoreApi::loadEntitiesById($album_ids);
	 foreach ($items as $item){
		$title = $item->getTitle() ? $item->getTitle() : $item->getPathComponent();
		$titles[$item->getId()] = preg_replace('/\r\n/', ' ', $title);
		$itemId = $item->getId();
		$discription = $item->getdescription();
	list ($ret, $viewed) = GalleryCoreApi::fetchItemViewCount($itemId);

		if(empty($discription)){ $discription = 'empty!';}
		?>
          <tr> 
            <td width="150" nowrap><strong>Name:</strong><?php print $titles[$itemId]; ?></td>
			<td><a href="index2.php?option=com_gallery2&act=album&task=album_spec&amp;albumId=<?php print $itemId; ?>">View Album Details</a></td>
          </tr>
          <!--<tr>
		  <td><strong>ParentId:</strong><?php print $item->getparentId(); ?></td>
            <td nowrap><strong>Created:</strong><?php print date("j-m-Y", $item->getcreationTimestamp()) ; ?></td>
            <td colspan="2" nowrap><strong>Last Modified:</strong><?php print date("j-m-Y", $item->getmodificationTimestamp()) ; ?></td>
          </tr>
          <tr> 
            <td nowrap><strong>View count:<?php print $viewed; ?></strong></td>
            <td colspan="2" nowrap><strong>Since:</strong><?php print date("j-m-Y", $item->getviewedSinceTimestamp( )) ; ?></td>
          </tr>
          <tr> 
            <td colspan="3" nowrap><strong>Key words:</strong><?php print $item->getkeywords(); ?></td>
          </tr>
          <tr> 
            <td colspan="3"><strong>Summary:</strong><?php print $item->getsummary(); ?></td>
          </tr>
          <tr> 
            <td colspan="3"><strong>Description:</strong><?php print $discription; ?></td>
          </tr>|-->
          <tr> 
            <td colspan="3"><hr></td>
          </tr>
          <?php	 
		 }
	?>
        </table>
		
     </td>
  </tr>
  <?php } ?>
</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="act" value="user" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="g2_id" value="<?php echo $g2_id;?>" />
		<input type="hidden" name="user_id" value="<?php echo $userId;?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="1" />
		
		</form>
<?php
}
}
?>