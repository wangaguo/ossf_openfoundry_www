<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr><td class="contentheading"><?php// echo $this->_MT_LANG->LISTINGS; ?></td></tr>
</table>

<table border="0" cellpadding="5" cellspacing="0" width="96%">

	<tr><td>
		<span class="xlistings"><?php //echo sprintf($this->_MT_LANG->THERE_ARE_X_LISTING, $this->total_listing) ?></span>
		<?php //if ($this->cat_allow_submission && $this->user_addlisting >= 0) echo $this->plugin("ahref","index.php?option=com_mtree&task=addlisting&cat_id=$this->cat_id&Itemid=$this->Itemid",$this->_MT_LANG->ADD_YOUR_LISTING_HERE,'class="addsite"') ?>
		<div class="dottedLine" />
	</td></tr>
	
	<?php if (is_array($this->links) && !empty($this->links)): ?>

	<tr><td>
		<table cellpadding="5" cellspacing="0" width="100%">
			
			<tr class="sectiontableheader2">
				<th><?php //echo $this->_MT_LANG->NAME ?></th>
				<th><?php //echo $this->_MT_LANG->STATE ?></th>
				<th><?php //echo $this->_MT_LANG->PRICE ?></th>
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

	<?php endif; ?>

	<tr><td align="center">
		<br />
		<center>
			<?php echo $this->pageNav->writePagesCounter(); ?>
			<br />
			<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=listcats&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>

</table>
