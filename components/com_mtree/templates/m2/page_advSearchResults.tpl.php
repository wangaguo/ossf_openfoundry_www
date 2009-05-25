<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php echo $this->_MT_LANG->ADVANCED_SEARCH_RESULTS ?></h2>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<?php if ( !empty($this->links) ) { ?>

	<?php
	foreach ($this->links AS $link): 
	$fields = $this->fields[$link->link_id];
	?>
	<tr><td>
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

	<tr><td align="center">
		<br />
		<center>
			<?php echo $this->pageNav->writePagesCounter(); ?>
			<br />
			<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=advsearch2&amp;search_id=$this->search_id&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>

	<?php } else { ?>
	<tr><td>
		<p /><center><?php echo $this->_MT_LANG->YOUR_SEARCH_DOES_NOT_RETURN_ANY_RESULT ?></center><p />
	</td></tr>
	<?php } ?>
</table>