<?php include $this->loadTemplate( 'sub_listingDetails.tpl.php' ) ?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		//if (pressbutton == 'cancel') {
		//	submitform( 'viewlink' );
		//	return;
		//}

		// Obtain rating value
		rad_val = '';
		for (var i=0; i < form.rating.length; i++) {
		 if (form.rating[i].checked) {
				var rad_val = form.rating[i].value;
			}
		}

		// do field validation
		if (rad_val == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_SELECT_A_RATING ?>" );
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

<table border="0" cellpadding="3" cellspacing="0" width="96%">
	<tr>
		<td>
			<b><?php echo $this->_MT_LANG->AVERAGE_VISITOR_RATING ?>:</b> <?php echo $this->link->link_rating ?> (<?php echo $this->_MT_LANG->OUT_OF_FIVE ?>)
			<br />
			<?php echo $this->_MT_LANG->NUMBER_OF_RATINGS ?>: <?php echo $this->link->link_votes ?>
			</td>
	</tr>
</table>
<br />
<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr><td class="sectiontableheader"><?php echo $this->_MT_LANG->SELECT_YOUR_RATING; ?></td></tr>
</table>

<center>
<table border="0" cellpadding="3" cellspacing="0" width="96%">
			<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
	<tr>
		<td>
			<INPUT type="radio" value="5" name="rating"> <?php echo $this->_MT_LANG->RATING_5 ?><br />
		</td>
	</tr>
	<tr>
		<td>
			<INPUT type="radio" value="4" name="rating"> <?php echo $this->_MT_LANG->RATING_4 ?><br />
		</td>
	</tr>
	<tr>
		<td>
			<INPUT type="radio" value="3" name="rating"> <?php echo $this->_MT_LANG->RATING_3 ?><br />
		</td>
	</tr>
	<tr>
		<td>
			<INPUT type="radio" value="2" name="rating"> <?php echo $this->_MT_LANG->RATING_2 ?><br />
		</td>
	</tr>
	<tr>
		<td>			
			<INPUT type="radio" value="1" name="rating"> <?php echo $this->_MT_LANG->RATING_1 ?><br />
		</td>
	</tr>
	<tr>
		<td>
			<input type="hidden" name="option" value="<?php echo $this->option ?>" />
			<input type="hidden" name="task" value="addrating" />
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			<input type="button" value="<?php echo $this->_MT_LANG->ADD_RATING ?>" onclick="javascript:submitbutton('addrating')" class="button" />
			</form>
		</td>
	</tr>
</table>	
</center>