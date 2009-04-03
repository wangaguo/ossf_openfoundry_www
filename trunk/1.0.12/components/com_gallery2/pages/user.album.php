<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

core::classRequireOnce('userAlbum');
global $Itemid;
switch($task){
	case 'setCookie':
		$timeFrame = intval(mosGetParam( $_REQUEST, 'time', 3600 ));
		userAlbum::setCookie($timeFrame);
		mosRedirect(sefRelToAbs('index.php?option=com_gallery2&amp;Itemid='.$Itemid),
		 'Succesfully Set.');
	break;
	case 'createAlbum':
		global $g2Config;
		$parentId = empty($g2Config['rootuseralbum'])
					? $g2Config['id.rootAlbum'] : $g2Config['rootuseralbum'];
		if(!userAlbum::getUserAlbumId()){
			list($ret, $msg) = userAlbum::createUserAlbum($parentId);
			if(!$ret){
				$msg = empty($msg) ? 'Failed to create no reason given!' : $msg; 
				mosRedirect(
					sefRelToAbs('index.php?option=com_gallery2&amp;Itemid='.$Itemid.'&amp;g2_itemId='.$parentId),
					$msg);	
			}
			mosRedirect(
				sefRelToAbs('index.php?option=com_gallery2&amp;Itemid='.$Itemid.'&amp;g2_itemId='.$parentId),
				'Succesfully Created!');
		}
	break;
	case 'userinput':
	default:
		global $Itemid, $mosConfig_live_site;
		/* print a small header above main page */
		?>
		<form name="userAlbum" method="post" action="index.php" class="adminfrom">
			<input name="option" type="hidden" value="com_gallery2">
			<input name="Itemid" type="hidden" value="<?php print $Itemid; ?>">
			<input name="page" type="hidden" value="useralbum">
			<input name="task" type="hidden" value="setCookie">
			<table width="100%" border="0" cellpadding="4">
				<tr><?php print _G2_DONT_HAVE; ?>
					<a href="<?php print sefRelToAbs('index.php?option=com_gallery2&amp;Itemid='.$Itemid.'&amp;task=createAlbum&amp;page=useralbum'); ?>">
					<?php print _G2_HERE; ?>
					</a>
				</tr>
				<tr>
					<td width="150"><?php print _G2_REMIND; ?></td>
					<td>
						<select name="time">
						  <option value="7200"><?php print _G2_HOURS; ?></option>
						  <option value="86400"><?php print _G2_DAY; ?></option>
						  <option value="604800"><?php print _G2_WEEK; ?></option>
						  <option value="2592000"><?php print _G2_MONTH; ?></option>
						  <option value="31104000"><?php print _G2_YEAR; ?></option>
						</select>
					</td>
					<td><input name="Submit" type="submit" value="Submit"></td>
			  </tr>
			</table>
		</form>
		<?php
	break;
}
?>