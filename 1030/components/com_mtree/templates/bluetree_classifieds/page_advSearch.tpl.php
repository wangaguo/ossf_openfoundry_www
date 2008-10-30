<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		form.task.value=pressbutton;
		form.submit();
		}
</script>
<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
	<tr>
		<td class="componentheading" colspan="2"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>

	<tr><td class="contentheading" colspan="2"><?php echo $this->_MT_LANG->ADVANCED_SEARCH; ?></td></tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td width="20%"><?php echo $this->_MT_LANG->NAME ?>:</td>
		<td width="80%"><input type="text" name="link_name" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->DESCRIPTION ?>:</td>
		<td><input type="text" name="link_desc" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->WEBSITE ?>:</td>
		<td><input type="text" name="website" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->ADDRESS ?>:</td>
		<td><input type="text" name="address" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->CITY ?>:</td>
		<td><input type="text" name="city" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->STATE ?>:</td>
		<td><input type="text" name="state" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->COUNTRY ?>:</td>
		<td><input type="text" name="country" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->POSTCODE ?>:</td>
		<td><input type="text" name="postcode" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->TELEPHONE ?>:</td>
		<td><input type="text" name="telephone" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->FAX ?>:</td>
		<td><input type="text" name="fax" size="30" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->EMAIL ?>:</td>
		<td><input type="text" name="email" size="30" class="inputbox" /></td>
	</tr>
	
	<?php for( $i=1; $i<=30; $i++ ) { 
		if ( !empty($this->custom_fields['cust_'.$i]->value) ) {
	?>
	<tr>
		<td><?php echo $this->custom_fields['cust_'.$i]->value ?>:</td>
		<td><input type="text" name="<?php echo $this->custom_fields['cust_'.$i]->name ?>" size="30" class="inputbox" /></td>
	</tr>
	<?php 
		}
	} 
	?>

	<tr>
		<td><?php echo $this->_MT_LANG->HITS ?>:</td>
		<td>
		<select name="opt_hits" class="inputbox" size="1">
			<option value="1" selected="selected"><?php echo $this->_MT_LANG->EXACTLY ?></option>
			<option value="2"><?php echo $this->_MT_LANG->MORE_THAN ?></option>
			<option value="3"><?php echo $this->_MT_LANG->LESS_THAN ?></option>
		</select>
		<input type="text" name="link_hits" size="8" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->PRICE ?>:</td>
		<td>
		<select name="opt_price" class="inputbox" size="1">
			<option value="1" selected="selected"><?php echo $this->_MT_LANG->EXACTLY ?></option>
			<option value="2"><?php echo $this->_MT_LANG->MORE_THAN ?></option>
			<option value="3"><?php echo $this->_MT_LANG->LESS_THAN ?></option>
		</select>
		<input type="text" name="price" size="8" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->RATING ?>:</td>
		<td>
		<select name="opt_rating" class="inputbox" size="1">
			<option value="1" selected="selected"><?php echo $this->_MT_LANG->EXACTLY ?></option>
			<option value="2"><?php echo $this->_MT_LANG->MORE_THAN ?></option>
			<option value="3"><?php echo $this->_MT_LANG->LESS_THAN ?></option>
		</select>
		<input type="text" name="link_rating" size="8" class="inputbox" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->VOTES ?>:</td>
		<td>
		<select name="opt_votes" class="inputbox" size="1">
			<option value="1" selected="selected"><?php echo $this->_MT_LANG->EXACTLY ?></option>
			<option value="2"><?php echo $this->_MT_LANG->MORE_THAN ?></option>
			<option value="3"><?php echo $this->_MT_LANG->LESS_THAN ?></option>
		</select>
		<input type="text" name="link_votes" size="8" class="inputbox" /></td>
	</tr>
	<tr height="60">
		<td colspan="2">
		<input type="button" value="<?php echo $this->_MT_LANG->SEARCH ?>" onclick="javascript:submitbutton('advsearch2')" class="button" />	<input type="reset" value="<?php echo $this->_MT_LANG->RESET ?>" class="button" /></td>
	</tr>
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
	<input type="hidden" name="option" value="com_mtree" />
	<input type="hidden" name="task" value="advsearch2" />
	</form>
</table>