<?php include $this->loadTemplate( 'sub_listingDetails.tpl.php' ) ?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( 'viewlink' );
			return;
		} else {
			form.submit();
		}
	}
</script>

<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr><td class="sectiontableheader"><?php echo $this->_MT_LANG->CLAIM_LISTING; ?></td></tr>
</table>

<center>
<table border="0" cellpadding="3" cellspacing="0" width="96%">
<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
	<tr><td><b><?php echo $this->_MT_LANG->MESSAGE ?>:</b></td></tr>
	<tr><td><textarea name="message" rows="8" cols="50" class="inputbox"></textarea></td></tr>
	<tr>
		<td align="left">
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="send_claim" />
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			<input type="button" value="<?php echo $this->_MT_LANG->CLAIM_LISTING ?>" onclick="javascript:submitbutton('send_claim')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
		</td>
	</tr>
</table>	
</form>
</center>