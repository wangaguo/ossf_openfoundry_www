<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( 'listcats' );
			return;
		}

		// do field validation
		if (form.cat_name.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_CATEGORY_NAME ?>" );
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
	<tr><td colspan="2" class="contentheading"><?php echo $this->_MT_LANG->ADD_CATEGORY; ?></td></tr>
</table>

<center>
<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">

	<tr>
		<td align="right"><?php echo $this->_MT_LANG->PARENT_CATEGORY ?>:</td>
		<td><b><?php echo $this->pathway->printPathWayFromLink( 0, "index.php?option=com_mtree&task=listcats&Itemid=$this->Itemid" ) ?></b></td>
	</tr>
	<tr>
		<td width="20%" align="right">
			<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
			<?php echo $this->_MT_LANG->NAME ?>:</td>
		<td width="80%" align="left">
			<input class="inputbox" type="text" name="cat_name" size="50" maxlength="250" />
		</td>
	</tr>
	<tr>
		<td valign="top" align="right"><?php echo $this->_MT_LANG->DESCRIPTION ?>:</td>
		<td align="left"><textarea name="cat_desc" rows="8" cols="40" class="inputbox"></textarea></td>
	</tr>

	<tr>
		<td colspan="2">
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="addcategory2" />
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
			<input type="hidden" name="cat_parent" value="<?php echo $this->cat_parent ?>" />
			<input type="button" value="<?php echo $this->_MT_LANG->ADD_CATEGORY?>" onclick="javascript:submitbutton('addcategory2')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="javascript:submitbutton('cancel')" class="button" />
			</form>
		</td>
	</tr>
</table>	
</center>