<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr><td class="contentheading"><?php echo $this->_MT_LANG->FEATURED_LISTING; ?></td></tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	
	<tr><td><b><?php echo $this->pageNav->writePagesCounter(); ?></b><div class="dottedLine"></div></td></tr>

	<?php foreach ($this->links AS $link): ?>
	<tr><td>
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

	<?php if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<tr><td align="center">
		<br />
		<center><?php echo $this->pageNav->writePagesCounter(); ?>
		<br />
		<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=listfeatured&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>
	<?php } ?>

</table>