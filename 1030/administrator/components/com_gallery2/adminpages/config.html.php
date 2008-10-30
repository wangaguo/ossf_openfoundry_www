<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
 * html section
 */
 class HTML {
		
		function showSettings($option, $params, $act, $g2Config, $task, $loadAll) {
		global $my;
		$tabs = new mosTabs( 1 );
	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="228">
				<a target="_blank" href="http://gallery.sourceforge.net/"><img src="components/com_gallery2/images/logo-228x67.png" border="0" width="228" height="67" align="middle" /></a>
			</td>
			<td align="left" class="sectionname" style="margin-left: 10px;">
				Gallery Component Settings
			</td>
		</tr>
		<tr>
			<td><?php print $params['versionCheck']; ?></td>
		</tr>
	</table>
	<script language="javascript" src="js/dhtml.js"></script>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			submitform(pressbutton);
		}
	</script>
	<div align="left" class="sectionname"><p>
	</p></div>
	<form action="index2.php" method="post" name="adminForm">
	<?php
	$tabs->startPane("content-pane");
	$tabs->startTab("Configuration","configpage");
	?>
	  <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
	  <tr><th colspan="3"><?php echo _G2_HD_CONFIG; ?></th></tr>
		<tr>
		  <td width="140" valign="top"><?php echo _G2_FPATH; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="path" size="50" value="<?php echo $g2Config['path']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_FPATH_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_GURI; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="g2Uri" size="50" value="<?php echo $g2Config['g2Uri']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_GURI_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_JPATH; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="embedPath" readonly="true" size="50" value="<?php echo $g2Config['embedPath']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_JPATH_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_EURL; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="embedUri" readonly="true" size="50" value="<?php echo $g2Config['embedUri']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_EURL_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_LOG_RED; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="loginredirect" size="50" value="<?php echo $g2Config['loginredirect']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_LOG_RED_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_SIDEBAR; ?></td>
			<td valign="top"><?php echo $params['displaysidebar']; ?></td>
			<td class="error" valign="top"><?php echo _G2_SIDEBAR_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_LOGIN; ?></td>
			<td valign="top"><?php echo $params['displaylogin']; ?></td>
			<td class="error" valign="top"><?php echo _G2_LOGIN_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_MRRR_USER; ?></td>
			<td valign="top"><?php echo $params['mirrorUsers']; ?></td>
			<td class="error" valign="top"><?php echo _G2_MRRR_USER_SUM; ?></td>
		  </tr>
		  <tr>
		  <?php if($loadAll){ ?>
		  <td width="140" valign="top"><?php echo _G2_USER_SCRIPT; ?></td>
			<td valign="top"><?php echo $params['userSetup']; ?></td>
			<td class="error" valign="top"><?php echo _G2_USER_SCRIPT_SUM; ?></td>
		  </tr>
		  <?php } ?>
		  <tr><th colspan="3"><?php echo _G2_HD_SYNC; ?></th></tr>
		  <tr>
			<td width="80" valign="top"><?php echo _G2_CHCK_LEVEL; ?></td>
			<td valign="top"><?php echo $params['userCheckParams']; ?></td>
			<td class="error" valign="top"><?php echo _G2_CHCK_LEVEL_SUM; ?></td>	  	
		  </tr>
		  <tr>
			<td width="80" valign="top"><?php echo _G2_CHCK_CASE; ?></td>
			<td valign="top"><?php echo $params['userCheckCase']; ?></td>
			<td class="error" valign="top"><?php echo _G2_CHCK_CASE_SUM; ?></td>
		  </tr>
		  <tr>
			<td width="80" valign="top"><?php echo _G2_USER_SYNC; ?></td>
			<td valign="top"><?php echo $params['g2ToJoomla']; ?></td>
			<td class="error" valign="top"><?php echo _G2_USER_SYNC_SUM; ?></td>	  	
		  </tr>
		  <tr>
			<td width="80" valign="top"><?php echo _G2_GROUP_SYNC; ?></td>
			<td valign="top"><?php echo $params['userGroupRecursive']; ?></td>
			<td class="error" valign="top"><?php echo _G2_GROUP_SYNC_SUM; ?></td>
		  </tr>
		</table>
	<?php
	$tabs->endTab();
	$tabs->startTab("Cache","cachepage");
		/* cache Tab */
		?>
		<table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
	  	<tr>
	  		<th width="140"><?php echo _G2_CCH_TLL; ?></th>
	  		<th><?php echo _G2_CCH_L; ?></th>
	  		<th><?php echo _G2_CCH_S; ?></th>
	  	</tr>
	  	<tr>
			<td width="140" valign="top"><?php echo _G2_CCH_FILE; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="cacheFileLong" size="10" value="<?php echo $g2Config['cacheFileLong']; ?>"></td>
			<td valign="top"><input class="inputbox" type="text" name="cacheFileShort" size="10" value="<?php echo $g2Config['cacheFileShort']; ?>"></td>
		</tr>
		<tr>
		 	<td width="140" valign="top"><?php echo _G2_CCH_DB; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="cacheDbLong" size="10" value="<?php echo $g2Config['cacheDbLong']; ?>"></td>
			<td valign="top"><input class="inputbox" type="text" name="cacheDbShort" size="10" value="<?php echo $g2Config['cacheDbShort']; ?>"></td>
		</tr>
		<tr>
			<td colspan="3" valign="top"><?php echo _G2_CCH_EXP; ?></td>
		</tr>
		<tr><th colspan="3"><?php echo _G2_CCH_CCS; ?></th></tr>
		<tr>
			<td width="140" valign="top"><?php echo _G2_CCH_OC; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="cacheObsolete" size="10" value="<?php echo $g2Config['cacheObsolete']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_CCH_OC_SUM; ?></td>
		  </tr>
		  <tr>
		  <td width="140" valign="top"><?php echo _G2_CCH_CC; ?></td>
			<td valign="top"><input class="inputbox" type="text" name="cacheCleanPeriod" size="10" value="<?php echo $g2Config['cacheCleanPeriod']; ?>"></td>
			<td class="error" valign="top"><?php echo _G2_CCH_CC_SUM; ?></td>
		  </tr>
		 </table>
		<?php
		list( $count, $size) = $params['cacheCount'];
		print '<table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">';
	  	print '<tr><th>Cache Info:</th></tr>';
		foreach($count as $k => $v){
			print '<tr><td><strong>'.$k.'</strong> contains '.$v.' cache files and has a total size of '.utility::sizeToString($size[$k]).'</td></tr>';
		}
		print '<tr><th>In total there are '.array_sum($count).' cache files and they have a total size of '.utility::sizeToString(array_sum($size)).'</th></tr>';
		print '</table>';
		//end content
	$tabs->endTab();
	/* sitemap tab */
	$tabs->startTab('Cron Job','cronjob');
		/* google sitemap tab */
	?>
		<table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
		  	<th colspan="3"><?php echo _G2_CRONJOB_SET; ?></th>
			<tr>
				<td width="80" valign="top"><?php echo _G2_CRONJOB; ?></td>
				<td valign="top" colspan="2"><p style="font-size: 10px; font-weight: bolder;">php -f <?php print BaseUrl; ?>/cron/g2CronJob.php</p></td>		
		  	</tr>
			<tr>
			<td colspan="3"><?php echo $params['cronJobTime'];?> </td>
			</tr>
		  	<tr>
		  		<th colspan="3"><?php echo _G2_GSM_SET; ?></th>
		  	</tr>
		  	<tr>
				<td width="80" valign="top"><?php echo _G2_GSM_AUTO; ?></td>
				<td valign="top"><?php echo $params['sitemapAutoRefresh']; ?></td>
				<td class="error" valign="top"><?php echo _G2_GSM_AUTO_SUM; ?></td>
		  	</tr>
		  	<tr>
				<td width="80" valign="top"><?php echo _G2_GSM_NAME; ?></td>
				<td valign="top"><input class="inputbox" type="text" name="sitemapFilename" size="25" value="<?php echo $g2Config['sitemapFilename']; ?>"></td>
				<td class="error" valign="top"><?php echo _G2_GSM_NAME_SUM; ?></td>
		  	</tr>
		  	<tr>
				<td valign="top"><?php echo _G2_GSM_CHECK; ?></td>
				<td colspan="2" class="error" valign="top"><?php echo $params['sitemapWarnings']; ?></td>
		  	</tr>		  	
	  	</table>
	<?php
	$tabs->endTab();
	/* everythin from here will only be executed if gallery2 install is confirmed */
	if($loadAll){
		/* user album tab */
		$tabs->startTab("User Album","useralbum");
		?>
				
		<table cellpadding="2" cellspacing="0" border="0" width="100%" class="adminform">
		  	<tr><th colspan="4"><?php echo _G2_USR_SET; ?></th></tr>
			<tr>
				<td width="80" valign="top"><?php echo _G2_USR_ENABLE; ?></td>
				<td valign="top"><?php echo $params['enableAlbumCreation']; ?></td>
				<td class="error" valign="top" colspan="2"><?php echo _G2_USR_ENABLE_SUM; ?></td>
			 </tr>
			 <tr>
				<td width="80" valign="top"><?php echo _G2_USR_PLACE; ?></td>
				<td valign="top"><?php echo $params['rootuseralbum']; ?></td>
				<td class="error" valign="top"  colspan="2"><?php echo _G2_USR_PLACE_SUM; ?></td>	  	
			</tr>
			<tr><th colspan="4"><?php echo _G2_USR_CR_SET; ?></th></tr>
			<tr>
				<td width="80" valign="top"><?php echo _G2_USR_NAME_PRE; ?></td>
				<td valign="top"><input class="inputbox" type="text" name="userAlbumName" size="10" value="<?php echo $g2Config['userAlbumName']; ?>"></td>
				<td class="error" valign="top" colspan="2"><?php echo _G2_USR_NAME_PRE_SUM; ?></td>	  	
			</tr>
			<tr>
				<td width="80" valign="top"><?php echo _G2_USR_TITLE; ?></td>
				<td valign="top"><input class="inputbox" type="text" name="userAlbumTitle" size="25" maxlength="200" value="<?php echo $g2Config['userAlbumTitle']; ?>"></td>
				<td class="error" valign="top" colspan="2"><?php echo _G2_USR_TITLE_SUM; ?></td>	  	
			</tr>
			<tr>
				<td width="80" valign="top"><?php echo _G2_USR_SUMMARY; ?></td>
				<td valign="top"><input class="inputbox" type="text" name="userAlbumSummary" size="50" maxlength="200" value="<?php echo $g2Config['userAlbumSummary']; ?>"></td>
				<td class="error" valign="top" colspan="2"><?php echo _G2_USR_SUMMART_SUM; ?></td>	  	
			</tr>
			<tr>
				<td width="80" valign="top"><?php echo _G2_USR_KEY; ?></td>
				<td valign="top"><input class="inputbox" type="text" name="userAlbumKeywords" size="50" maxlength="200" value="<?php echo $g2Config['userAlbumKeywords']; ?>"></td>
				<td class="error" valign="top" colspan="2"><?php echo _G2_USR_KEY_SUM; ?></td>	  	
			</tr>
			<tr>
				<td width="80" valign="top"><?php echo _G2_USR_DESC; ?></td>
				<td valign="top"><textarea class="inputbox" name="userAlbumDescription" cols="37"  rows="5" ><?php echo $g2Config['userAlbumDescription']; ?></textarea></td>
				<td class="error" valign="top" colspan="2"><?php echo _G2_USR_DESC_SUM; ?></td>	  	
			</tr>		
				<tr><th colspan="4"><?php echo _G2_USR_PER; ?></th></tr>
			<tr>
				<th><?php echo _G2_USR_GNAME; ?></th>
				<th><?php echo _G2_USR_VIEW; ?></th>
				<th><?php echo _G2_USR_COMMENT; ?></th>
				<th><?php echo _G2_USR_EXTRA; ?></th>
			</tr>
					<tr>
						<td width="25%" valign="top"><?php echo $params['groups'][$g2Config["id.everybodyGroup"]]; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$g2Config["id.everybodyGroup"]]['view']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$g2Config["id.everybodyGroup"]]['comment']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$g2Config["id.everybodyGroup"]]['extra']; ?></td>	  	
					</tr>					
					<tr>
						<td width="25%" valign="top"><?php echo $params['groups'][$g2Config["id.allUserGroup"]]; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$g2Config["id.allUserGroup"]]['view']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$g2Config["id.allUserGroup"]]['comment']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$g2Config["id.allUserGroup"]]['extra']; ?></td>	  	
					</tr>					
					<tr>
						<td width="25%" valign="top"><?php echo _G2_USR_OWNER; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists']['owner']['view']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists']['owner']['comment']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists']['owner']['extra']; ?></td>	  	
					</tr>					
			<?php
			unset($params['groups'][$g2Config["id.everybodyGroup"]]);
			unset($params['groups'][$g2Config["id.allUserGroup"]]);
			if(count($params['groups']) > 0){
				?>
				<tr><th colspan="4"><?php echo _G2_USR_JOOMLA; ?></th></tr>
				<?php
				ksort($params['groups']);
				$i = 0;
				foreach($params['groups'] as $id =>$groupname){
					if(strpos($groupname, '_Registered')){
						continue;
					}
				?>
					<tr>
						<td width="25%" valign="top"><?php echo $groupname; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$id]['view']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$id]['comment']; ?></td>
						<td width="25%" valign="top"><?php echo $params['selectLists'][$id]['extra']; ?></td>	  	
					</tr>
				<?php 
					$i++;
				}
			}
			?>
		 </table>
		<?php	
		$tabs->endTab();	
	}
	/* end gallery2 confirmed tabs */
	$tabs->startTab("Privacy","privacy");
	?>
	<table cellpadding="2" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
				<td width="80" valign="top">Send data</td>
				<td valign="top"><?php print $params['sendStats']; ?></td>	  	
			</tr>
			<tr>
				<td colspan="2">
				To check for updates we need some info to be send to our server. You can agree to this or not.<br />
				The data that will be transmitted will be shown below.
				</td>
			</tr>
			<tr>
				<th>Data</th><th>Why</th>
			</tr>
			<tr>
				<td>Site Id, constucted from a md5 hash</td>
				<td>We need a uniqui identifier to store some stats below, this identifier can't be recalculated back to your site so the info is privately stored.</td>
			</tr>
			<tr>
				<td>Joomla/Mambo version and G2 version</td>
				<td>first: we need to check this as there will be separete files for different releases, because of incompatibillity.<br />
				Second: We store this data as it is very time consuming to watch 3 relaeses and make it work with all 3 of them. This will let us now if we can drop one version, like joomla 1.0, after joomla 1.1 is releaced.</td>
			</tr>
			<tr>
				<td>total albums and Photos</td>
				<td>we don't need this but gives as some insight into use and We willbe able to put some numbers on our site.<br />This is only send if you run the cronjob and set this function to yes. IT IS NOT SEND WHEN CHECKING FOR UPDATES!</td>
			</tr>
			<tr>
				<td colspan="1">Example data for your site:<br /><br />
				<?php
				global $mosConfig_live_site, $mosConfig_absolute_path;
				print 'siteid='.md5($mosConfig_live_site.$mosConfig_absolute_path).'<br />';
				include_once($mosConfig_absolute_path.'/includes/version.php');
				global $_VERSION;
				print 'cms='.$_VERSION->PRODUCT.'<br />';
				print 'cmsversion='.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.'<br />' ;
				core::classRequireOnce('utility');
				print 'componentVersion='.utility::comVersion();
				?>
				</td>
			</tr>
	</table>
	<?php
	$tabs->endTab();
	$tabs->endPane();
	?>
	  <input type="hidden" name="option" value="<?php echo $option; ?>">
	  <input type="hidden" name="act" value="<?php echo $act; ?>">
	  <input type="hidden" name="task" value="">
	</form>
	<?php
	}
}
?>