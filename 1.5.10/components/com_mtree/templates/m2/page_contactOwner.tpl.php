<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			form.task.value='viewlink';
			form.submit();
			return;
		}

		// do field validation
		if (form.your_name.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_THE_FORM ?>" );
		} else if (form.your_email.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_THE_FORM ?>" );
		} else {
			form.task.value=pressbutton;
			try {
				form.onsubmit();
				}
			catch(e){}
			form.submit();
		}
	}
</script>
<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php echo $this->_MT_LANG->CONTACT_OWNER . ' - ' . $this->link->link_name; ?></h2>

<div id="listing">

<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr>
		<td colspan="2">
			<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
			<b><?php echo $this->_MT_LANG->FROM ?>:</b>
		</td>
	</tr>
	<tr>
		<td width="20%"><?php echo $this->_MT_LANG->YOUR_NAME ?>:</td>
		<td width="80%"><input type="text" name="your_name" class="inputbox" size="40" /></td>
	</tr>
	<tr>
		<td><?php echo $this->_MT_LANG->YOUR_EMAIL ?>:</td>
		<td><input type="text" name="your_email" class="inputbox" size="40" /></td>
	</tr>
	<tr><td colspan="2"><b><?php echo $this->_MT_LANG->MESSAGE ?>:</b></td></tr>
	<tr><td colspan="2"><textarea name="message" rows="8" cols="40" class="inputbox"></textarea></td></tr>
	<tr>
		<td colspan="2">
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="send_contact" />
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			<input type="hidden" name="<?php echo $this->validate; ?>" value="1" />
			<input type="button" value="<?php echo $this->_MT_LANG->SEND ?>" onclick="javascript:submitbutton('send_contact')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="javascript:submitbutton('cancel')" class="button" />
			</form>
		</td>
	</tr>
</table>	
</div>