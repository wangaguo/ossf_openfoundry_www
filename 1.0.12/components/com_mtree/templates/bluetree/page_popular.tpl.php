<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr><td class="contentheading"><?php echo $this->_MT_LANG->POPULAR_LISTING; ?></td></tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<?php foreach ($this->links AS $link): ?>
	<tr><td>
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

</table>