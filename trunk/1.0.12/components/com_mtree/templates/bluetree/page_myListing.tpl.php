<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr>
		<td class="contentheading"><?php echo $this->_MT_LANG->MY_LISTING ?></td>
	</tr>

	<?php if (is_array($this->links) && !empty($this->links)): ?>

	<tr><td class="contentheading"><?php echo $this->_MT_LANG->LISTINGS; ?></td></tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<?php foreach ($this->links AS $link): ?>
	<tr><td>
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

	<tr><td align="center">
		<br />
		<center><?php echo $this->pageNav->writePagesCounter(); ?>
		<br />
		<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=mylisting&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>

<?php else: ?>
	<tr>
		<td>
		<p />
		<center><?php echo $this->_MT_LANG->YOU_DO_NOT_HAVE_ANY_LISTING ?></center>
		<br />
		</td>
	</tr>
<?php endif; ?>

</table>