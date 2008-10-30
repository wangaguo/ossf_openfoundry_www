<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( 'viewlink' );
			return;
		}

		// do field validation
		if (form.link_name.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_LINK_NAME ?>" );
		} else {
			form.task.value=pressbutton;
			form.submit();
		}
	}
</script>

<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr>
		<td colspan="2" class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr><td colspan="2" class="contentheading"><?php echo ($this->link->link_id) ? $this->_MT_LANG->EDIT_LISTING : 	$this->_MT_LANG->ADD_LISTING; ?></td></tr>
</table>

<center>
<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm">
	
	<?php echo ( (isset($this->warn_duplicate) && $this->warn_duplicate == 1) ? '<tr><td colspan="2">' . $this->_MT_LANG->THERE_IS_ALREADY_A_PENDING_APPROVAL_FOR_MODIFICATION . '</td></tr>' : '' )?>

	<tr>
		<td align="right"><?php echo $this->_MT_LANG->CURRENT_CATEGORY ?>:</td>
		<td><b><?php echo $this->pathWayToCurrentCat ?></b></td>
	</tr>

	<tr>
		<td align="right"><?php echo $this->_MT_LANG->CHANGE_CATEGORY ?>:</td>
		<td><?php echo $this->catlist ?> <i><?php echo $this->_MT_LANG->CATS_IN_BRACKETS_DOES_NOT_ACCEPT_NEW_LISTINGS ?></i></td>
	</tr>

	<?php if ($this->link->link_image): ?>
	<tr>
		<td colspan="2">
			<center>
				<img class="editPhoto" src="<?php echo $this->mosConfig_live_site.$this->mt_listing_image_dir.$this->link->link_image ?>" />
				<br />
				<input type="checkbox" name="remove_image" value="1"> <?php echo $this->_MT_LANG->REMOVE_THIS_IMAGE ?>
			</center>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td width="20%" align="right">
			<?php echo $this->_MT_LANG->NAME ?>:</td>
		<td width="80%" align="left">
			<input class="inputbox" type="text" name="link_name" value="<?php echo $this->link->link_name ?>" size="50" maxlength="250" />
		</td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->DESCRIPTION ?>:</td>
		<td align="left"><textarea name="link_desc" rows="8" cols="40" class="inputbox"><?php echo $this->link->link_desc ?></textarea></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->WEBSITE ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="website" value="<?php echo $this->link->website ?>" size="40" /></td>
	</tr>
	<?php if ($this->allow_upload): ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->IMAGE ?>:</td>
		<td align="left">
			<input class="text_area" type="file" name="link_image" />
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->ADDRESS ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="address" value="<?php echo $this->link->address ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->CITY ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="city" value="<?php echo $this->link->city ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->STATE ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="state" value="<?php echo $this->link->state ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->COUNTRY ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="country" value="<?php echo $this->link->country ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->POSTCODE ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="postcode" value="<?php echo $this->link->postcode ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->TELEPHONE ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="telephone" value="<?php echo $this->link->telephone ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->FAX ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="fax" value="<?php echo $this->link->fax ?>" size="40" /></td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->EMAIL ?>:</td>
		<td align="left"><input class="inputbox" type="text" name="email" value="<?php echo $this->link->email ?>" size="40" /></td>
	</tr>

	<?php if ( !empty($this->custom_fields['cust_1']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_1']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_1']->name?>" value="<?php echo $this->custom_data['cust_1']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_2']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_2']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_2']->name?>" value="<?php echo $this->custom_data['cust_2']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_3']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_3']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_3']->name?>" value="<?php echo $this->custom_data['cust_3']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_4']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_4']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_4']->name?>" value="<?php echo $this->custom_data['cust_4']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_5']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_5']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_5']->name?>" value="<?php echo $this->custom_data['cust_5']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_6']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_6']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_6']->name?>" value="<?php echo $this->custom_data['cust_6']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_7']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_7']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_7']->name?>" value="<?php echo $this->custom_data['cust_7']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_8']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_8']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_8']->name?>" value="<?php echo $this->custom_data['cust_8']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_9']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_9']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_9']->name?>" value="<?php echo $this->custom_data['cust_9']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php if ( !empty($this->custom_fields['cust_10']->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_10']->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_10']->name?>" value="<?php echo $this->custom_data['cust_10']?>" size="40" /></td>
	</tr>
	<?php } ?>

	<?php for ( $i=11; $i<=30; $i++ ) { 
		if ( !empty($this->custom_fields['cust_'.$i]->value) ) { ?>
	<tr>
		<td valign="top" align="right"><?php echo $this->custom_fields['cust_'.$i]->value?>:</td>
		<td align="left"><input class="inputbox" type="text" name="<?php echo $this->custom_fields['cust_'.$i]->name?>" value="<?php echo $this->custom_data['cust_'.$i]?>" size="40" /></td>
	</tr>
	<?php } 
	 } ?>

	<tr>
		<td valign="top"><?php echo $this->_MT_LANG->META_KEYWORDS ?>:</td>
		<td><textarea class="text_area" cols="30" rows="3" style="width:300px; height:50px" name="metakey" width="500"><?php echo str_replace('&','&amp;',$this->link->metakey); ?></textarea>
		</td>
	</tr>

	<tr>
		<td valign="top"><?php echo $this->_MT_LANG->META_DESCRIPTION ?>:</td>
		<td><textarea class="text_area" cols="30" rows="3" style="width:300px; height:50px" name="metadesc" width="500"><?php echo str_replace('&','&amp;',$this->link->metadesc); ?></textarea>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="savelisting" />
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />			
			<?php if ( $this->link->link_id == 0 ) { ?>
			<input type="hidden" name="cat_id" value="<?php echo $this->cat_id ?>" />
			<?php } else { ?>
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			<input type="hidden" name="cat_id" value="<?php echo $this->cat_id ?>" />
			<?php } ?>
			<input type="button" value="<?php echo $this->_MT_LANG->SUBMIT_LISTING ?>" onclick="javascript:submitbutton('savelisting')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
			</form>
		</td>
	</tr>
</table>	
</center>