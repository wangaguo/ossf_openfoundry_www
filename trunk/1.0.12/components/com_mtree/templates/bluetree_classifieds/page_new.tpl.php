<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr><td class="contentheading"><?php echo $this->_MT_LANG->NEW_LISTING; ?></td></tr>
</table>

<?php if (is_array($this->links) && !empty($this->links)): ?>
<table border="0" cellpadding="5" cellspacing="0" width="96%">

	<tr><td>
		<table cellpadding="5" cellspacing="0" width="100%">
			
			<tr class="sectiontableheader2">
				<th><?php echo $this->_MT_LANG->NAME ?></th>
				<th><?php echo $this->_MT_LANG->STATE ?></th>
				<th><?php echo $this->_MT_LANG->PRICE ?></th>
			</tr>
			<?php 
			$i = 0;
			foreach ($this->links AS $link): 
			$i++;
			?>
		
			<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>

			<?php endforeach; ?>
			<tr class="sectiontableheader2"><td colspan="3">&nbsp;</td></tr>
		</table>
	</td></tr>

</table>
<?php endif; ?>