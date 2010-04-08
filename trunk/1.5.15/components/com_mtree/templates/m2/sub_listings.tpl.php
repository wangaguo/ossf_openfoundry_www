<div id="listings"><?php

if( $this->task == "search" && empty($this->links) ) {

	if( empty($this->categories) ) {
	?>
	<p /><center><?php echo JText::_( 'Your search does not return any result' ) ?></center><p />
	<?php
	}
	
} else {
	?>
	<div class="title"><?php echo JText::_( 'Listings' ); ?></div>

	<div class="pages-links">
		<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
		<?php echo $this->pageNav->getPagesLinks(); ?>
	</div>

	<?php
//Delete Add list here code	
	foreach ($this->links AS $link) {
		$fields = $this->fields[$link->link_id];
		include $this->loadTemplate('sub_listingSummary.tpl.php');
	}

	if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<div class="pages-links">
		<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
		<?php echo $this->pageNav->getPagesLinks(); ?>
	</div>
	<?php
	}
	
}
?></div>
