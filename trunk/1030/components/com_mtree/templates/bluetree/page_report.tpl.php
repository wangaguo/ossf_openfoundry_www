<?php include $this->loadTemplate( 'sub_listingDetails.tpl.php' ) ?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			form.task.value='viewlink';
			form.submit();
			return;
		}

	<?php if( $this->user_id <= 0 ) { ?>
		// do field validation
		if (form.your_name.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_THE_FORM ?>" );
		} else {
	<?php } ?>
			form.task.value=pressbutton;
			try {
				form.onsubmit();
				}
			catch(e){}
			form.submit();
	<?php if( $this->user_id <= 0 ) { ?>
		}
	<?php } ?>
	}
</script>

<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
	<tr><td colspan="2" class="sectiontableheader"><?php echo $this->_MT_LANG->REPORT_LISTING; ?></td></tr>
</table>

<center>
<table border="0" cellpadding="3" cellspacing="0" width="96%">
	<?php if( $this->user_id <= 0 ) { ?>
	<tr>
		<td width="20%"><?php echo $this->_MT_LANG->YOUR_NAME ?>:</td>
		<td width="80%"><input type="text" name="your_name" class="inputbox" size="40" /></td>
	</tr>
	<?php } ?>
	<tr>
		<td><?php echo $this->_MT_LANG->REPORT_PROBLEM ?>:</td>
		<td>
		  <select name="report_type">
				<option value="1"><?php echo $this->_MT_LANG->REPORT_PROBLEM_1 ?></option>
				<option value="2"><?php echo $this->_MT_LANG->REPORT_PROBLEM_2 ?></option>
				<option value="3"><?php echo $this->_MT_LANG->REPORT_PROBLEM_3 ?></option>
				<option value="4"><?php echo $this->_MT_LANG->REPORT_PROBLEM_4 ?></option>
		  </select>
		</td>
	</tr>
	<tr><td colspan="2"><b><?php echo $this->_MT_LANG->MESSAGE ?>:</b></td></tr>
	<tr><td colspan="2"><textarea name="message" rows="8" cols="40" class="inputbox"></textarea></td></tr>
	<tr>
		<td colspan="2">
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="send_report" />
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
			<input type="button" value="<?php echo $this->_MT_LANG->SEND ?>" onclick="javascript:submitbutton('send_report')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="javascript:submitbutton('cancel')" class="button" />
		</td>
	</tr>
	</form>
</table>	
</center>