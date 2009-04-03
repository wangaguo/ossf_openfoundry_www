<p />
<center>
<div class="mtframe">
	<div class="sectiontableheader"><a name="action"><?php echo $this->_MT_LANG->REVIEWS; ?> (<?php echo $this->pageNav->total ?>)</a></div><!-- Modify by ally -->

	<?php if (is_array($this->reviews) && !empty($this->reviews)): ?>

	<?php 
		$k = 1;
		foreach ($this->reviews AS $review): 
		
	?>
	<div class="reviewBorder"><div class="sectiontableentry<?php echo ($k+1) ?>">
		<?php $this->plugin('ahref', array("path"=>"index.php?option=".$this->option."&task=viewlink&link_id=".$this->link_id."&Itemid=".$this->Itemid,"fragment"=>"rev-".$review->rev_id), $review->rev_title,'id="rev-'.$review->rev_id.'" style="font-size:14px"'); ?><br />
		<?php echo $this->_MT_LANG->REVIEWED_BY ?> <b><?php echo ( ($review->user_id) ? $review->username : $review->guest_name); ?></b>, <?php echo $review->rev_date ?>
		<p />
		<?php echo $review->rev_text ?>
		<br /><br />
	</div></div>
	<?php	$k = 1 - $k; ?>
	<?php endforeach; ?>

	<p />
	<?php if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<center>
		<?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=viewlink&amp;link_id=$this->link_id&amp;Itemid=$this->Itemid") ?>
		<br />
		<?php echo $this->pageNav->writePagesCounter(); ?>
	</center>
	<?php } else { ?>
		<center><?php echo $this->pageNav->writePagesCounter(); ?></center>
	<?php } ?>

	<?php else: ?>

	<p />
	<?php $this->plugin('ahref', "index.php?option=$this->option&task=writereview&link_id=$this->link_id&Itemid=$this->Itemid", $this->_MT_LANG->BE_THE_FIRST_TO_REVIEW); ?>
	
	<?php endif; ?>

</div>
</center>
