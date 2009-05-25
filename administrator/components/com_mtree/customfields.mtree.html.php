<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 2.0
* @copyright (C) 2006-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

class HTML_mtcustomfields {

	function editft( $row, $attachments, $option ) {
		global $_MT_LANG, $mtconf;
		
		if( $row->ft_id == 0 ) {
	?>
	<form enctype="multipart/form-data" action="index2.php" method="post" name="adminForm2">
	<table class="adminheading"><tr><th class="install"><?php echo $_MT_LANG->INSTALL_NEW_FIELD_TYPE ?></th></tr></table>
	<table class="adminform">
	<tr><th><?php echo $_MT_LANG->UPLOAD_PACKAGE_FILE ?></th></tr>
	<tr>
		<td align="left">
		<?php echo $_MT_LANG->PACKAGE_FILE ?>:
		<input class="text_area" name="userfile" type="file" size="70"/>
		<input class="button" type="submit" value="<?php echo $_MT_LANG->UPLOAD_FILE_AND_INSTALL ?>" />
		</td>
	</tr>
	</table>
	<input type="hidden" name="option" value="<?php echo $option ?>"/>
	<input type="hidden" name="task" value="uploadft"/>
	</form>
	<p />
	<?php } ?>
	<script language="javascript" type="text/javascript">
	var attCount=1;
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton=='cancelft') {
			submitform( pressbutton );
			return;
		}
		if (form.field_type.value==""||form.ft_caption.value==""||form.ft_class.value==""){
			alert( "<?php echo $_MT_LANG->PLEASE_COMPLETE_THE_FIELD_TYPE_NAME_CAPTION_AND_CODE_BEFORE_SAVING ?>" );
		} else {
			submitform( pressbutton );
		}
	}
	function gebid(id) {return document.getElementById(id);}

	function addAtt() {
		var newLi = document.createElement("LI");
		newLi.id="att"+attCount;
		var newFile=document.createElement("INPUT");
		newFile.style.marginRight="5px";
		newFile.class="text_area";
		newFile.name="attachment[]";
		newFile.type="file";
		newFile.size="30";
		newLi.appendChild(newFile);
		var newLink=document.createElement("A");
		newLink.href="javascript:remAtt("+attCount+")";

		removeText=document.createTextNode("remove");
		newLink.appendChild(removeText);


		newLi.appendChild(newLink);
		gebid('upload_att').appendChild(newLi);
		attCount++;
	}
	function remAtt(id) {gebid('upload_att').removeChild(gebid('att'+id));}
	</script>
	<form action="index2.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
	
	<?php if( $row->ft_id == 0 ) { ?>
	<table class="adminheading"><tr><th><?php echo $_MT_LANG->OR_CREATE_A_NEW_FIELD_TYPE ?></th></tr></table>
	<?php } else { ?>
	<table class="adminheading"><tr><th><?php echo $_MT_LANG->EDIT_FIELD_TYPE ?></th></tr></table>
	<?php } ?>
	<table width="100%" class="adminform">
		<tr><th colspan="2"><?php echo $_MT_LANG->FIELD_TYPE_DETAILS ?></th></tr>
		<tr>
			<td width="15%"><?php echo $_MT_LANG->NAME_OF_THE_FIELD_TYPE ?>:</td>
			<td width="85%"><?php 
			if( $row->ft_id == 0 ) { 
			?><input type="text" name="field_type" size="30" value="<?php echo $row->field_type ?>" class="text_area" /><?php
			} else {
				echo $row->field_type;
				?><input type="hidden" name="field_type" value="<?php echo $row->field_type ?>" /><?php
			}
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->CAPTION ?>:</td>
			<td><input type="text" name="ft_caption" size="30" value="<?php echo $row->ft_caption ?>" class="text_area" /></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $_MT_LANG->PHP_CLASS_CODE ?>:</td>
			<td><textarea cols="80" rows="20" name="ft_class" class="text_area"><?php echo htmlentities($row->ft_class) ?></textarea></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->USES_ELEMENTS; ?></td>
			<td><?php echo mosHTML::yesnoRadioList("use_elements", 'class="inputbox"'.(($row->iscore=='1')?' disabled':''), (($row->use_elements == 1) ? 1 : 0)); ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->USES_SIZE ?></td>
			<td><?php echo mosHTML::yesnoRadioList("use_size", 'class="inputbox"'.(($row->iscore=='1')?' disabled':''), (($row->use_size == 1) ? 1 : 0)); ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->VERSION ?>:</td>
			<td><input type="text" name="ft_version" size="10" value="<?php echo $row->ft_version ?>" class="text_area"<?php echo ($row->iscore)?' disabled':'' ?> /></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->WEBSITE ?>:</td>
			<td><input type="text" name="ft_website" size="50" value="<?php echo $row->ft_website ?>" class="text_area"<?php echo ($row->iscore)?' disabled':'' ?> /></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $_MT_LANG->DESCRIPTION ?>:</td>
			<td><textarea cols="80" rows="4" name="ft_desc" class="text_area"<?php echo ($row->iscore)?' disabled':'' ?>><?php echo $row->ft_desc ?></textarea></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $_MT_LANG->ATTACHMENTS ?>:</td>
			<td valign="top"><ol style="margin:0 15px;padding:0" id="upload_att"><?php
			foreach( $attachments AS $attachment ) {
				echo '<li style="margin-bottom:2px;">';
				echo ' <input type="checkbox" name="useatt[]" value="' . $attachment->fta_id . '" checked />&nbsp;';
				echo '<a href="' . $mtconf->getjconf('live_site'). '/components/com_mtree/attachment.php?ft=' . $row->field_type . '&amp;o=' . $attachment->ordering . '" target="_blank">' . $attachment->filename . '</a>';
				echo '&nbsp;';
				if( $attachment->filesize < 1024 ) {
					echo $attachment->filesize . ' bytes';
				}  elseif( $attachment->filesize < 1048576 ) {
					echo round($attachment->filesize / 1024) . ' KB';
				} else {
					echo round($attachment->filesize / 1048576) . ' MB';
				}
				echo '</li>';
			}
			?>
			</ol>
			<br />
			<a href="javascript:addAtt();" id="add_att">Add an attachment</a>
			</td>
		</tr>
	</table>

	<input type="hidden" name="option" value="<?php echo $option ?>"/>
	<input type="hidden" name="task" value="saveft"/>
	<input type="hidden" name="id" value="<?php echo $row->ft_id ?>"/>
	</form>
	<?php
	}
	
	function managefieldtypes( $option, $rows ) {
		global $_MT_LANG;
	?>
	<div style="position:relative;top:5px;clear:both;text-align:left;margin-bottom:20px;"><img style="position:relative;top:4px;" src="../components/com_mtree/img/arrow_left.png" width="16" height="16" /> <a href="index2.php?option=com_mtree&amp;task=customfields"><b><?php echo $_MT_LANG->BACK_TO_CUSTOM_FIELDS ?></b></a></div>
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
		
	<table class="adminheading"><tr><th class="install"><?php echo $_MT_LANG->INSTALLED_FIELD_TYPES ?></th></tr></table>
	<table class="adminlist">
	<thead>
	<tr>
		<th width="25%" class="title"><?php echo $_MT_LANG->FIELD_TYPE ?></th>
		<th width="35%" class="title"><?php echo $_MT_LANG->DESCRIPTION ?></th>
		<th width="5%" align="center"><?php echo $_MT_LANG->VERSION ?></th>
		<th width="20%" align="left"><?php echo $_MT_LANG->WEBSITE ?></th>
		<th width="10%" align="left"><?php echo $_MT_LANG->DOWNLOAD_XML ?></th>
	</tr>
	</thead>
	<?php
	if(count($rows) > 0) {
		$rc = 0;
		for ($i = 0, $n = count( $rows ); $i < $n; $i++) {
			$row =& $rows[$i];
			?>
		<tr class="<?php echo "row$rc"; ?>">
			<td valign="top">
			<input type="radio" id="cb<?php echo $i;?>" name="cfid[]" value="<?php echo $row->ft_id; ?>" onclick="isChecked(this.checked);"><a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','editft')">
			<?php echo $row->ft_caption; ?></a></td>
			<td><?php 
			if($row->iscore) {
				echo '<b>' . $_MT_LANG->CORE_FIELDTYPE . '</b>';	
			} else {
				echo $row->ft_desc;	
			}
			?></td>
			<td><?php echo $row->ft_version; ?></td>
			<td><a href="<?php echo $row->ft_website; ?>" target="_blank"><?php echo $row->ft_website; ?></a></td>
			<td align="center"><a href="index2.php?option=<?php echo $option; ?>&amp;task=downloadft&amp;cfid=<?php echo $row->ft_id; ?>&amp;no_html=1"><?php echo $_MT_LANG->DOWNLOAD; ?></a></td>
		</tr>
			<?php 
			$rc = $rc == 0 ? 1 : 0;
		} 
	} else {
		echo '<tr><td colspan="5">No custom field type installed.</td></tr>';
	}
	?>
	<tfoot>
	<tr><th colspan="5"></th></tr>
	<tfoot>
	</table>
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="managefieldtypes" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
	<?php
	}
	
	function customfields( $custom_fields, $pageNav, $option ) {
		global $_MT_LANG,$mtconf;
	?>
	<form action="index2.php" method="post" name="adminForm" id="adminForm">
	<table class="adminheading">
		<tr>
			<th class="menus"><?php echo $_MT_LANG->CUSTOM_FIELDS ?></td>
		</tr>
		<tr><td>
			<a href="index2.php?option=com_mtree&amp;task=managefieldtypes"><?php echo $_MT_LANG->MANAGE_FIELD_TYPES ?></a>
		</td></tr>
	</table>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<thead>
		<th width="20"><?php echo $_MT_LANG->ID ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $custom_fields ); ?>);" /></th>
		<th width="40%" align="left" nowrap><?php echo $_MT_LANG->CAPTION ?></th>
		<th width="20%" align="left"><?php echo $_MT_LANG->FIELD_TYPE ?></th>
		<th width="50" align="center" nowrap><?php echo $_MT_LANG->ADVANCED_SEARCHABLE ?></th>
		<th width="50" align="center" nowrap><?php echo $_MT_LANG->SIMPLE_SEARCHABLE ?></th>
		<th width="50" align="center" nowrap><?php echo $_MT_LANG->REQUIRED ?></th>

		<th width="50" align="center" nowrap><?php echo $_MT_LANG->SUMMARY_VIEW ?></th>
		<th width="50" align="center" nowrap><?php echo $_MT_LANG->DETAILS_VIEW ?></th>

		<th width="10%" align="center" nowrap><?php echo $_MT_LANG->PUBLISHED ?></th>
		<th width="4%" align="center" nowrap colspan="2"><?php echo $_MT_LANG->ORDERING ?></th>
		</thead>
	
		<?php
		$k = 0;
		for ($i=0, $n=count( $custom_fields ); $i < $n; $i++) {
			$row = &$custom_fields[$i];
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $row->cf_id;?></td>
			<td>
				<input type="checkbox" id="cb<?php echo $i;?>" name="cfid[]" value="<?php echo $row->cf_id; ?>" onClick="isChecked(this.checked);" />
			</td>
			<td align="left">
				<a href="index2.php?option=com_mtree&amp;task=editcf&amp;cfid=<?php echo $row->cf_id; ?>"><?php 
					if ( strlen($row->caption) > 55 ) {
						echo strip_tags(substr($row->caption, 0, 55))."...";
					} else {
						echo strip_tags($row->caption);
					}
				?></a>
			</td>
			<td><?php 
				if($row->iscore) {
					echo '<b>' . strtoupper($_MT_LANG->CORE) . '</b>';
				} else { 
					// echo $row->field_type;
					if(isset($_MT_LANG->{'FIELD_TYPE_' . strtoupper($row->field_type)})) {
						echo $_MT_LANG->{'FIELD_TYPE_' . strtoupper($row->field_type)};
					} else {
						echo $row->ft_caption;
					}
				} ?></td>
			<?php if ($row->hidden) { 
				?>
				<td align="center" colspan="5"><strong><?php echo $_MT_LANG->HIDDEN_FIELD ?></strong></td>
				<?php
			} else { ?>
			<td align="center"><?php if ($row->advanced_search) { 
				echo '<img border="0" src="images/tick.png">';
			} else {
				echo '<img border="0" width="6" height="6" src="images/publish_x.png">';
			} 
			?></td>
			<td align="center"><?php if ($row->simple_search) { 
				echo '<img border="0" src="images/tick.png">';
			} else {
				echo '<img border="0" width="6" height="6" src="images/publish_x.png">';
			} 
			?></td>
			<td align="center"><?php if ($row->required_field) { 
				echo '<img border="0" src="images/tick.png">';
			} else {
				echo '<img border="0" width="6" height="6" src="images/publish_x.png">';
			} 
			?></td>
			
			<td align="center"><?php if ($row->summary_view) { 
				echo '<img border="0" src="images/tick.png">';
			} else {
				echo '<img border="0" width="6" height="6" src="images/publish_x.png">';
			} 
			?></td>
			<td align="center"><?php if ($row->details_view) { 
				echo '<img border="0" src="images/tick.png">';
			} else {
				echo '<img border="0" width="6" height="6" src="images/publish_x.png">';
			} 
			?></td>
			<?php
			
			}
			
				$task = $row->published ? 'cf_unpublish' : 'cf_publish';
				$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			?>
			<td align="center">
				<?php if ($row->field_type <> 'corename') { ?>
				<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				<?php } else {echo "<img src=\"images/publish_g.png\">";} ?>
			</td>
			<td class="order">
				<span><?php echo $pageNav->orderUpIcon( $i, true, 'cf_orderup' ); ?></span>
			</td>
			<td class="order">
				<span><?php echo $pageNav->orderDownIcon( $i, $n, true, 'cf_orderdown'  ); ?></span>
			</td>
			<!-- <td class="order" align="center">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td> -->
		</tr>
		<?php
			$k = 1 - $k;
		}
		?>
		<tfoot>
			<tr>
				<td colspan="12">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="customfields" />
	<input type="hidden" name="boxchecked" value="0">
	</form>
	<?php
	}

	function editcf( $row, $custom_cf_types, $lists, $params, $option ) {
		global $_MT_LANG;
	?>
	<script language="javascript">
	<!--
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if(pressbutton=='cancelcf') {
			submitform(pressbutton);
			return;
		}
		if (form.caption.value == "") {
			alert( "<?php echo $_MT_LANG->PLEASE_FILL_IN_THE_FIELDS_CAPTION ?>" );
		} else if (form.iscore.value == "0" && ( form.field_type.value == "checkbox" || form.field_type.value == "selectlist" || form.field_type.value == "selectmultiple" || form.field_type.value == "radiobutton" ) && form.field_elements.value == "" ) {
			alert( "Please fill in the Field Elements." );
		} else {
			submitform( pressbutton );
		}
	}
	function updateInputs(ftype) {
		var f = document.adminForm;
		if (ftype=='selectlist'||ftype=='selectmultiple'||ftype=='checkbox'||ftype=='radiobutton'<?php
		foreach( $custom_cf_types AS $custom_cf_type ) {
			if($custom_cf_type->use_elements) {	echo '||ftype==\'' . $custom_cf_type->field_type . '\''; }
		}
		?>) {
			f.field_elements.disabled=false;
			f.field_elements.style.backgroundColor='#FFFFFF'; 
		} else {
			f.field_elements.style.backgroundColor='#f5f5f5'; 
			f.field_elements.disabled=true;
		}
	
		if(ftype=='checkbox'||ftype =='radiobutton'<?php
		foreach( $custom_cf_types AS $custom_cf_type ) {
			if(!$custom_cf_type->use_size) {	echo '||ftype==\'' . $custom_cf_type->field_type . '\''; }
		}
		?>) {
			f.size.disabled=true;
		} else {
			f.size.disabled=false;
		}
	}
	-->
	</script>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminheading"><tr><th class="edit"><?php echo $_MT_LANG->CUSTOM_FIELD ?>: <?php echo $row->cf_id ? 'Edit' : 'New';?></th></tr></table>

	<table width="100%" class="adminform">
		<tr>
			<th colspan="2">
			<?php echo $_MT_LANG->CUSTOM_FIELD_DETAILS ?>
			</th>
		</tr>
		<tr>
			<td width="20%"><?php echo $_MT_LANG->FIELD_TYPE ?>:</td>
			<td width="80%"><?php
			if( $row->iscore ) { 
				echo '<b>' . $_MT_LANG->CORE_FIELD . '</b>';
				echo '<input type="hidden" name="field_type" value="' . $row->field_type. '" />';
			} else { 
				echo $lists['field_types']; 
			}
			echo '<input type="hidden" name="iscore" value="' . $row->iscore . '" />';
			if( !$row->iscore && $row->cf_id == 0 ) {
				echo '<span style="background-color:white;margin-left:10px;">' . $_MT_LANG->SOME_FIELDTYPE_HAS_PARAMS_DESC . '</span>';
			}
			?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->CAPTION ?>:</td>
			<td><input type="text" size="40" name="caption" class="text_area" value="<?php echo $row->caption ?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="checkbox" name="hide_caption" id="hide_caption" class="text_area" value="1"<?php echo ($row->hide_caption) ? ' checked' : '' ?> /> <label for="hide_caption"><?php echo $_MT_LANG->HIDE_CAPTION ?></label></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $_MT_LANG->FIELD_ELEMENTS ?>:</td>
			<td><textarea name="field_elements" rows="8" cols="50" class="text_area"><?php echo $row->field_elements ?></textarea>
				<br /><?php echo $_MT_LANG->FIELD_ELEMENTS_NOTE ?></td>
		</tr>
		<tr>
			<td valign="top" rowspan="2"><?php echo $_MT_LANG->PREFIX_AND_SUFFIX_TEXT_TO_DISPLAY_DURING_FIELD_MODIFICATION ?>:</td>
			<td><?php echo $_MT_LANG->PREFIX ?>: <input type="text" size="40" name="prefix_text_mod" class="text_area" value="<?php echo $row->prefix_text_mod ?>" /></td>
		</tr>
		<tr><td><?php echo $_MT_LANG->SUFFIX ?>: <input type="text" size="40" name="suffix_text_mod" class="text_area" value="<?php echo $row->suffix_text_mod ?>" /></td></tr>
		<tr>
			<td valign="top" rowspan="2"><?php echo $_MT_LANG->PREFIX_AND_SUFFIX_TEXT_TO_DISPLAY_DURING_DISPLAY ?>:</td>
			<td><?php echo $_MT_LANG->PREFIX ?>: <input type="text" size="40" name="prefix_text_display" class="text_area" value="<?php echo $row->prefix_text_display ?>" /></td>
		</tr>
		<tr><td><?php echo $_MT_LANG->SUFFIX ?>: <input type="text" size="40" name="suffix_text_display" class="text_area" value="<?php echo $row->suffix_text_display ?>" /></td></tr>
		<tr>
			<td><?php echo $_MT_LANG->SIZE ?>:</td>
			<td><input type="text" size="40" name="size" class="text_area" value="<?php echo $row->size ?>" /></td>
		</tr>
		<?php if ($row->field_type <> 'corename') { ?>
		<tr>
			<td><?php echo $_MT_LANG->PUBLISHED ?>:</td>
			<td><?php echo $lists['published'] ?></td>
		</tr>
		<?php } else { ?><input type="hidden" name="published" value="1"><?php
		} 
		?>
		<tr>
			<td><?php echo $_MT_LANG->SHOWN_IN_DETAILS_VIEW ?>:</td>
			<td><?php echo $lists['details_view'] ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->SHOWN_IN_SUMMARY_VIEW ?>:</td>
			<td><?php echo $lists['summary_view'] ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->SIMPLE_SEARCHABLE ?>:</td>
			<td><?php echo $lists['simple_search'] ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->ADVANCED_SEARCHABLE ?>:</td>
			<td><?php echo $lists['advanced_search'] ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->REQUIRED_FIELD ?>:</td>
			<td><?php echo $lists['required_field'] ?></td>
		</tr>
		<tr>
			<td><?php echo $_MT_LANG->HIDDEN_FIELD ?>:</td>
			<td><?php echo $lists['hidden'] ?> <span style="background-color:white;margin-left:10px;"><?php echo $_MT_LANG->HIDDEN_FIELD_DESC; ?></span></td>
		</tr>
		<?php
		if($row->cf_id) { ?>
		<tr>
			<td><?php echo $_MT_LANG->ORDERING ?>:</td>
			<td><?php echo $lists['order'] ?></td>
		</tr>
		<?php } ?>
	</table>
	<?php if(!is_null($params)) { 
		mosCommonHTML::loadOverlib();
	?>
	<div style="width:70%;">
	<table class="adminform">
	<tr><th ><?php echo $_MT_LANG->PARAMETERS ?></th></tr>
	<tr><td><?php echo $params->render();?></td>
	</tr>
	</table>
	</div>
	<?php } ?>
	<input type="hidden" name="option" value="<?php echo $option; ?>">
	<input type="hidden" name="cf_id" value="<?php echo $row->cf_id; ?>">
	<input type="hidden" name="task" value="save_customfields" />
	</form>
	<script language="javascript"><!--
	updateInputs(document.adminForm.field_type.value);
	--></script>
	<?php
	}
}
?>