<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>

	<tr><td><center><?php $this->display( 'sub_alphaIndex.tpl.php' ) ?></center></td></tr>

	<?php if ( $this->num_of_cats > 0 || count($this->links) > 0): ?>

	<?php if ( $this->num_of_cats > 0 ): ?>

	<tr><td class="contentheading"><?php echo $this->_MT_LANG->CATEGORIES; ?></td></tr>

	<tr>
		<td>

		<center>
		<table border="0" cellpadding="5" cellspacing="0" width="95%">
			<?php 
				$i = 0;
				foreach ($this->featured_cats as $cat): 
					if ( ($i % 2) == 0) echo '<tr>';
			?>	
				<td width="50%" valign="top">
					<b><?php $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$cat->cat_id&Itemid=$this->Itemid", $cat->cat_name,'class="subCatFeatured"');	?></b>
					<small>(<?php echo $cat->cat_cats ?>/<?php echo $cat->cat_links ?>)</small>
				</td>
			<?php 
					if ( ($i++ % 2) == 1) echo '</tr>';
				endforeach; 
			?>
			<tr>
				<td colspan="2" align="left">
				<form method="POST" action="index.php" name="adminForm">
				<?php 
					echo '<b>'.$this->_MT_LANG->MORE_CATEGORIES .'</b>'. $this->lists['cat_id']; ?>
					<input type="hidden" name="option" value="<?php echo $this->option ?>" />
					<input type="hidden" name="task" value="listcats" />
					<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
				</form>	
				</td>
			</tr>
		</table>
		</center>
		<br />
		</td>
	</tr>

	<?php endif; ?>

	<?php if (is_array($this->links) && !empty($this->links)): ?>

	<tr><td class="contentheading"><?php echo $this->_MT_LANG->LISTINGS; ?></td></tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	
	<tr><td><b><?php echo $this->pageNav->writePagesCounter(); ?></b><div class="dottedLine"></div></td></tr>

	<?php foreach ($this->links AS $link): ?>
	<tr><td>
		<?php include $this->loadTemplate('sub_listingSummary.tpl.php') ?>
	</td></tr>
	<?php endforeach; ?>

	<tr><td align="center">
		<br />
		<center><?php echo $this->pageNav->writePagesCounter(); ?>
		<br /> 
		<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=listalpha&amp;start=$this->start&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?>
		</center>
	</td></tr>

<?php endif; ?>

<?php else: ?>
	<tr>
		<td>
		<p />
		<center><?php echo sprintf($this->_MT_LANG->THERE_ARE_NO_CAT_OR_LISTINGS, ( (is_numeric($this->start)) ? $this->_MT_LANG->NUMBER : strtoupper($this->start)) )?></center>
		<br />
		</td>
	</tr>
<?php endif; ?>
</table>
