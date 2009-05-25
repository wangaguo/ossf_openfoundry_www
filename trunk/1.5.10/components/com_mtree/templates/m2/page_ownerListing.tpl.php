<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php 
	if( $this->my->id == $this->owner->id ) {
		echo $this->_MT_LANG->MY_PAGE ?> (<?php echo $this->owner->username ?>)<?php
	} else {
		echo $this->owner->username;
	}
?></h2>
<div class="users-tab">
<div class="users-listings-active"><span><?php echo $this->_MT_LANG->LISTINGS ?></span>(<?php echo $this->pageNav->total  ?>)</div>
<?php if($this->mtconf['show_review']) { ?><div class="users-reviews"><a href="<?php echo sefReltoAbs("index.php?option=com_mtree&task=viewusersreview&user_id=".$this->owner->id."&Itemid=$this->Itemid") ?>"><?php echo $this->_MT_LANG->REVIEWS ?></a>(<?php echo $this->total_reviews ?>)</div><?php } ?>
<?php if($this->mtconf['show_favourite']) { ?><div class="users-favourites"><a href="<?php echo sefReltoAbs("index.php?option=com_mtree&task=viewusersfav&user_id=".$this->owner->id."&Itemid=$this->Itemid") ?>"><?php echo $this->_MT_LANG->FAVOURITES ?></a>(<?php echo $this->total_favourites ?>)</div><?php } ?>
</div>
<div id="listings"><?php
if (is_array($this->links) && !empty($this->links)) {

	?><div class="info"><b><?php echo $this->pageNav->writePagesCounter(); ?></b></div><?php
	foreach ($this->links AS $link) {
		$fields = $this->fields[$link->link_id];
		include $this->loadTemplate('sub_listingSummary.tpl.php');
	}
	
	if( $this->pageNav->total > $this->pageNav->limit ) {
		?><div class="pages-counter"><?php echo $this->pageNav->writePagesCounter(); ?></div>
		<div class="pages-links"><?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=$this->task&amp;user_id=" . $this->owner->id . "&amp;Itemid=$this->Itemid") ?></div><?php
	}

} else {

	?><center><?php
	
	if( $this->my->id == $this->owner->id ) {
		echo $this->_MT_LANG->YOU_DO_NOT_HAVE_ANY_LISTINGS;
	} else {
		echo $this->_MT_LANG->THIS_USER_DO_NOT_HAVE_ANY_LISTINGS;
	}
	
	?></center><?php
	
} ?></div>