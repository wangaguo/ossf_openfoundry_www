<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	
	<?php if ( isset($this->cats) && count($this->cats) ): ?>
	<tr><td class="contentheading"><?php echo $this->_MT_LANG->CATEGORIES; ?></td></tr>

	<tr>
		<td>

		<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr><td colspan="2"><?php echo sprintf($this->_MT_LANG->FOUND_CATEGORIES,count($this->cats), $this->searchword); ?><div class="dottedLine"></div></td></tr>
			<?php 
				$i = 0;
				foreach ($this->cats as $cat): 
					if ( ($i % 2) == 0) echo '<tr>';
			?>	
				<td width="50%" valign="top">
					<b><?php $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$cat->cat_id&Itemid=$this->Itemid", $cat->cat_name);	?></b>
					<small>(<?php echo $cat->cat_cats ?>/<?php echo $cat->cat_links ?>)</small>
				</td>
			<?php 
					if ( ($i++ % 2) == 1) echo '</tr>';
				endforeach; 
			?>
		</table>
		</td>
	</tr>
	<?php endif; ?>

	<tr><td class="contentheading"><?php echo $this->_MT_LANG->SEARCH_RESULTS; ?></td></tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<?php if ( !empty($this->links) ) { ?>
	<tr><td><b><?php echo $this->pageNav->writePagesCounter(); ?></b> <?php echo $this->_MT_LANG->SEARCH_FOR ?> <b><?php echo $this->searchword ?></b><div class="dottedLine"></div></td></tr>
	<?php foreach ($this->links AS $link): ?>
	<tr><td>
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

	<?php if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<tr><td align="center">
		<br />
		<center>
			<?php echo $this->pageNav->writePagesCounter(); ?>
			<br />
			<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=search&amp;cat_id=$this->cat_id&amp;searchword=$this->searchword&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>
	<?php } ?>

	<?php } else { ?>
	<tr><td>
		<p /><center><?php echo $this->_MT_LANG->YOUR_SEARCH_DOES_NOT_RETURN_ANY_RESULT ?></center><p />
	</td></tr>
	<?php } ?>

</table>