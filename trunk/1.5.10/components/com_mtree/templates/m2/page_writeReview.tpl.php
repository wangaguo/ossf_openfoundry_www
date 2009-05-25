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
		<?php
		if( 
			$this->config->get('require_rating_with_review')
			&& 
			$this->config->get('allow_rating_during_review') 
			&&
			(
				$this->config->get('user_rating') == '0'
				||
				($this->config->get('user_rating') == '1' && $this->my->id > 0)
				||
				($this->config->get('user_rating') == '2' && $this->my->id > 0 && $this->my->id != $this->link->user_id)
			)
		) {			
			echo '} else if (form.rating.value == ""){ alert("' . $this->_MT_LANG->PLEASE_FILL_IN_RATING . '"); ';
		}		
		?>} else {
			form.submit();
		}
	}
</script>
<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php echo $this->_MT_LANG->WRITE_REVIEW . ' - ' . $this->link->link_name; ?></h2>

<div id="listing">

<table border="0" cellpadding="3" cellspacing="0" width="100%">
<form action="<?php echo sefReltoAbs('index.php'); ?>" method="post" name="adminForm" id="adminForm">
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
			<?php
			if( 
				$this->config->get('allow_rating_during_review') 
				&&
				(
					$this->config->get('user_rating') == '0'
					||
					($this->config->get('user_rating') == '1' && $this->my->id > 0)
					||
					($this->config->get('user_rating') == '2' && $this->my->id > 0 && $this->my->id != $this->link->user_id)
				)
			) {
			?>
			<select name="rating" class="inputbox">
			<?php
			$options = array(""=>$this->_MT_LANG->SELECT_YOUR_RATING, "5"=>$this->_MT_LANG->RATING_5, "4"=>$this->_MT_LANG->RATING_4, "3"=>$this->_MT_LANG->RATING_3, "2"=>$this->_MT_LANG->RATING_2, "1"=>$this->_MT_LANG->RATING_1);
			echo $this->plugin( "options", $options, $this->user_rating ); 
			?>
			</select>
			<?php } ?>
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
			<input type="hidden" name="<?php echo $this->validate; ?>" value="1" />
			<input type="button" value="<?php echo $this->_MT_LANG->ADD_REVIEW ?>" onclick="javascript:submitbutton('addreview')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
		</td>
	</tr>
</table>	
</form>

</div>