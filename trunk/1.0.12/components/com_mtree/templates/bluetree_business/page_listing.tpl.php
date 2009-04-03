<?php include $this->loadTemplate( 'sub_listingDetails.tpl.php' ) ?>

<center><div class="mtframe">
	<table class="mtborder" cellpadding="4" cellspacing="1" border="0" width="100%">
	<tr>
		<th class="thead" colspan="4"><?php echo $this->_MT_LANG->LISTING_INFORMATION ?><th>
	</tr>
	<?php 
		for ($i=1;$i<=30;$i++) {
			$custom_field = "cust_".$i;
			if ( !empty($this->custom_fields[$custom_field]->caption) && !empty($this->link->$custom_field) ) {
	?>
	<tr>
		<td class="mtdata"><b><?php echo $this->custom_fields[$custom_field]->caption ?>:</b></td>
		<td class="mtdata"><?php echo $this->link->$custom_field ?></td>
	</tr>
	<?php 
			}
		} 
	?>
	<?php if ($this->mt_show_rating): ?>
	<tr>
		<td width="25%" class="mtdata"><strong><?php echo $this->_MT_LANG->AVERAGE_VISITOR_RATING ?>:</strong></td>
		<td width="25%" class="mtdata" colspan="3"><?php echo $this->link->link_rating ?> (<?php echo $this->_MT_LANG->OUT_OF_FIVE ?>)</td>
	</tr>
	<tr>
		<td class="mtdata"><strong><?php echo $this->_MT_LANG->NUMBER_OF_RATINGS ?>:</strong></td>
		<td class="mtdata" colspan="3"><?php echo $this->link->link_votes ?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class="mtdata"><strong><?php echo $this->_MT_LANG->HITS ?>:</strong></td>
		<td class="mtdata" colspan="3"><?php echo $this->link->link_hits ?></td>
	</tr>

	<tr>
		<td class="mtdata"><strong><?php echo $this->_MT_LANG->ADDED ?>:</strong></td>
		<td class="mtdata" colspan="3"><?php echo $this->link->link_created ?></td>
	</tr>

	<tr>
		<td class="mtdata"><strong><?php echo $this->_MT_LANG->MODIFIED ?>:</strong></td>
		<td class="mtdata" colspan="3"><?php echo $this->link->link_modified ?></td>
	</tr>
	</table>

</div></center>

<?php if ($this->mt_show_review) include $this->loadTemplate( 'sub_reviews.tpl.php' ) ?>