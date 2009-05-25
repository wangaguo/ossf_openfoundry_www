<div id="listings"><?php

if( $this->task == "search" && count($this->links) == 0 ) {

	?>
	<p /><center><?php echo $this->_MT_LANG->YOUR_SEARCH_DOES_NOT_RETURN_ANY_RESULT ?></center><p />
	<?php
	
} else {
	
	?>
	<div class="title"><?php echo $this->_MT_LANG->LISTINGS; ?></div>

	<div class="info"><?php

	switch($this->task) {
		case 'search':
			?><b><?php
			if(is_null($this->pageNav->writePagesCounter()) && defined('JVERSION')) {
				echo JText::_('Page')." ".$this->pageNav->get('pages.current')." ".JText::_('of')." ".$this->pageNav->get('pages.total');
			} else {
				echo $this->pageNav->writePagesCounter(); 
			}
			?></b> <?php echo $this->_MT_LANG->SEARCH_FOR ?> <b><?php echo $this->searchword ?></b><?php
			break;
		default:
			?><span class="xlistings"><?php echo sprintf($this->_MT_LANG->THERE_ARE_X_LISTING, $this->total_listing) ?></span><?php
			break;
	}

	if (isset($this->cat_allow_submission) && $this->cat_allow_submission && $this->user_addlisting >= 0) {
		echo $this->plugin("ahref","index.php?option=com_mtree&task=addlisting&cat_id=$this->cat_id&Itemid=$this->Itemid",$this->_MT_LANG->ADD_YOUR_LISTING_HERE,'class="add-listing"');
	}
	?>
	</div>

	<?php
	foreach ($this->links AS $link) {
		$fields = $this->fields[$link->link_id];
		include $this->loadTemplate('sub_listingSummary.tpl.php');
	}

	if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<div class="pages-counter"><?php echo $this->pageNav->writePagesCounter(); ?></div>
	<?php
	if($this->task == 'search') {
		?><div class="pages-links"><?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=search&amp;searchword=$this->searchword&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?></div><?php
	} else {
		?><div class="pages-links"><?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=listcats&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?></div><?php
	}
	?>
	<?php
	}
	
}
?></div>