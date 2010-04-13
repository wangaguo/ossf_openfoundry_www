<h2 class="contentheading"><?php echo $this->title ?></h2>

<div id="listings">

<div class="rt-pagination">
	<?php echo $this->pageNav->getPagesLinks(); ?>
</div>
	<p class="pagescounter"><?php echo $this->pageNav->getResultsCounter(); ?></p>
<?php

	foreach ($this->links AS $link) {
		$fields = $this->fields[$link->link_id];
		include $this->loadTemplate('sub_listingSummary.tpl.php');
	}
	
	if( $this->pageNav->total > 0 ) { ?>
	<div class="rt-pagination">
		<?php echo $this->pageNav->getPagesLinks(); ?>
	</div>
		<p class="pagescounter"><?php echo $this->pageNav->getResultsCounter(); ?></p>
	<?php }
	
?></div>
