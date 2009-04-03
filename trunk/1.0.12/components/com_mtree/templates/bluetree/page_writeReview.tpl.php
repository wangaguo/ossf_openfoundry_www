<?php include $this->loadTemplate( 'sub_listingDetails.tpl.php' ) ?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( 'viewlink' );
			return;
		}

		// do field validation
		if (form.rev_text.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_REVIEW ?>" );
		} else if (form.rev_title.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_TITLE ?>" );
		} else {
			form.submit();
		}
	}
</script>

<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr><td class="sectiontableheader"><?php echo $this->_MT_LANG->WRITE_REVIEW; ?></td></tr>
</table>

<center>
<table border="0" cellpadding="3" cellspacing="0" width="96%">
<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
	<?php if ( !($this->my->id > 0) ) { ?>
	<tr>
		<td align="left">
			<?php echo $this->_MT_LANG->YOUR_NAME ?>:
		</td>
	</tr>
	<tr>
		<td align="left">
			<input type="text" name="guest_name" class="inputbox" size="20" />
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td align="left">
			<?php echo $this->_MT_LANG->REVIEW_TITLE ?>:
		</td>
	</tr>
	<tr>
		<td align="left">
			<input type="text" name="rev_title" class="inputbox" size="40" />
		</td>
	</tr>
	<tr>
		<td align="left">
			<?php echo $this->_MT_LANG->REVIEW ?>:
		</td>
	</tr>
	<tr>
		<td align="left">
			<?php $this->plugin('textarea', 'rev_text', '', 8, 50, 'class="inputbox"'); ?>
			<br /><br />
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="addreview" />
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			<input type="button" value="<?php echo $this->_MT_LANG->ADD_REVIEW ?>" onclick="javascript:submitbutton('addreview')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
		</td>
	</tr>
</table>	
</form>
</center>