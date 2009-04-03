<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * html part
 */
 class HTML{
 
	 //album details
	function showAlbum( $option, $act, $task, $albumId, $details){
	global $mosConfig_live_site, $g2Config;
	$user_id = $details['mamboid'];
	$link 	= 'index2.php?option=com_gallery2&amp;act=user&amp;task=user_edit&amp;id='. $user_id. '&amp;hidemainmenu=1';
	?>
	<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th class="categories"><div align="left">Album Details for "<?php print $details['title']; ?>"</div></th>
			</tr>
		</table>
		<table width="100%">
				<tr>
					<td width="100%" valign="top">
						<table class="adminform" align="left">
							<tr> 
							  <th colspan="2"> General Info </th>
							  <th></th>
							  <th></th>
							</tr>
							<tr> 
							  <td width="15%" align="left"> <strong>Title:</strong> </td>
							  <td width="45%" align="left"><input name="title" type="text" size="45" class="inputbox" maxlength="125" value="<?php print $details['title']; ?>"></td>
							  <td width"10%" align="left"><strong>Owner:</strong></td>
							  <td width"30%" align="left"><a href="<?php echo $link; ?>"><?php echo $details['mamboname']; ?></a></td>
							</tr>
							<tr> 
							  <td align="left"> <strong>Summary:</strong> </td>
							  <td align="left"><input name="summary" type="text" size="45" class="inputbox" maxlength="250" value="<?php print $details['summary']; ?>"></td>
							</tr>
							<tr> 
							  <td valign="top" align="left"> <strong>Description:</strong></td>
							  <td><textarea name="description" cols="43" class="inputbox" rows="4"><?php print $details['description']; ?></textarea></td>
							</tr>
							<tr> 
							  <td valign="top" align="left"> <strong>Keywords:</strong></td>
							  <td><input name="keywords" type="text" size="45" class="inputbox" maxlength="250" value="<?php print $details['keywords']; ?>"></td>
							  <td valign="top" align="left"><strong>Viewed:</strong></td>
							  <td><?php print $details['views']; ?> </td>
							</tr>
							<tr> 
							  <td valign="top" align="left"> <strong>Creation date:</strong></td>
							  <td> <?php print $details['creationDate']; ?></td>
							  <td valign="top" align="left"><strong>Since:</strong></td>
							  <td><?php print $details['viewedsince']; ?> </td>
							</tr>
							<tr> 
							  <td valign="top" align="left"> <strong>Last Modified:</strong></td>
							  <td> <?php print $details['lastmodified']; ?></td>
							  <td valign="top" align="left"><strong>Parent Album:</strong></td>
							  <td><?php
							  if($details['parentid'] == 0){ ?>
								No Parent.
							  <?php } else { ?>
								 <a href="index2.php?option=com_gallery2&act=album&task=album_spec&albumId=<?php print $details['parentid']; ?>"><?php print $details['parentname']; ?></a>
							  <?php } ?>
							  </td>
							</tr>
						</table>
					</td>
				<td width="160" valign="top">
					<table class="adminform">
					<tr>
						<th colspan="1">
						Album Highlight
						</th>
					</tr>
					<tr>
						
				<td align="center"> 
				  <?php if($details['parentid'] == 0){ ?><a target="_blank" href="http://gallery.sourceforge.net/"> 
				  <img src="components/com_gallery2/images/logo-228x67.png" border="0" width="150" height="67" align="middle" /></a>
				  <?php } else { ?>
				  <img src="<?php print $mosConfig_live_site.'/'.$g2Config['relativeG2Path'].'/main.php?g2_view=core.DownloadItem&'.$details['thumbid'] ;?>"/> 
				  <?php } ?>
				</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="75%">
					<table class="adminform">
						<tr>
							<th colspan="1">Child Details</th>
							<th></th><th></th><th></th>
						</tr>
						<?php if(count($details['childalbumids'])>0){ ?>
						<tr>
						<td width="15%">Child Albums:</td>
						<td><?php 
						foreach($details['childalbumids'] as $album){
							$array[] = '<a href="index2.php?option=com_gallery2&act=album&task=album_spec&albumId='.$album.'">'.$details['childname'][$album].'</a>';
						}
						print implode(", ", $array);
						?>
						</td>
						</tr>
						<?php }
						if((count($details['childids'])-count($details['childalbumids']))>0){ ?>
						<tr>
							<td width="15%">Contains none album childs:</td>
							<td><?php print count($details['childids']) - count($details['childalbumids']); ?></td>
						</tr>
						<?php } ?>
					</table>	
				</td>
			</tr>
			</table>
			<input type="hidden" name="albumId" value="<?php echo $albumId;?>" />
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="act" value="album" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="hidemainmenu" value="1" />
			</form>
	<?php
	}//end show album
	function showAlbumTree( $option, $act, $task, $tree, $titles, $keywords, $summary, $description, $childs, $last_modified){
		?>
		<table class="adminheading">
			<tr>
				<th class="categories"><div align="left">Album Tree</div></th>
			</tr>
		</table>
		<table class="adminform">
			<tr> 
				<th colspan="1" width="5%">Id:</th>
				<th colspan="1">Album Title:</th>
				<th colspan="1">Album notes:</th>
				<th colspan="1">Last Modified:</th>
			</tr>
		<?php
		
			foreach($tree as $key => $val){
				unset($keys);
				$keys[$key]=0;//parent
				//check variables
				//let's check the childeren
				if(count($val) > 0){
					$childeren = getthekeys($val, 1);
					foreach($childeren as $key => $val){
						$keys[$key]=$val;//parent
					}
				}
				//foreach key in the right order, gogogo
				foreach($keys as $key => $val){
					unset($error);
					//error checking
					if(!$keywords[$key]){ $error[] = 'keywords missing'; }
					if(!$summary[$key]){ $error[] = 'Summary missing'; }
					if(!$description[$key]){ $error[] = 'Description missing'; }
					if(count($childs[$key]) < 1){ $error[] = 'Empty Album'; }
					//output
					print '<tr>';
					print '<td>'.$key.'</td>';
					print '<td>'.str_repeat("&nbsp;", $val * 3).'<a href="index2.php?option=com_gallery2&act=album&task=album_spec&albumId='.$key.'">'.$titles[$key].'</a></td>';
					if(!empty($error) AND count($error)>0){
						print '<td>'.implode(", ", $error).'</td><td>'.$last_modified[$key].'</td>';
					} else {
						print '<td></td><td>'.$last_modified[$key].'</td>';
					}
					print '</tr>';
				}
			}
		?>
		</table>
	<?php	
	}
	 
}

			
function getthekeys($parent, $depth){
	foreach($parent as $key => $val){
		$keys[$key]=$depth;
		if(count($val) > 0){
			$depth++;
			$back = getthekeys($val, $depth);
			foreach($back as $key => $val){
				$keys[$key]=$val;
			}
		}
	}			
	return $keys;
}
?>