<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr><td class="contentheading"><?php echo $this->_MT_LANG->LISTINGS; ?></td></tr>
</table>

<center>
<table border="0" cellpadding="5" cellspacing="10" width="98%">
	
	<tr><td align="left">
		<span class="xlistings"><?php echo sprintf($this->_MT_LANG->THERE_ARE_X_LISTING, $this->total_listing) ?></span>
		<?php //if ($this->cat_allow_submission && $this->user_addlisting >= 0) echo $this->plugin("ahref","index.php?option=com_mtree&task=addlisting&cat_id=$this->cat_id&Itemid=$this->Itemid",$this->_MT_LANG->ADD_YOUR_LISTING_HERE,'class="addsite"') ?>
		<div class="dottedLine" />
	</td></tr>

	<?php foreach ($this->links AS $link): ?>
	<tr><td align="left">
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

	<?php if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<tr><td align="center">
		<br />
		<center>
			<?php echo $this->pageNav->writePagesCounter(); ?>
			<br />
			<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=listcats&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>
	<?php } ?>

</table>
</center>
