<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php 
	if( $this->my->id == $this->owner->id ) {
		echo $this->_MT_LANG->MY_PAGE ?> (<?php echo $this->owner->username ?>)<?php
	} else {
		echo $this->owner->username;
	}
?></h2>
<div class="users-tab">
<div class="users-listings"><a href="<?php echo sefReltoAbs("index.php?option=com_mtree&task=viewowner&user_id=".$this->owner->id."&Itemid=$this->Itemid") ?>"><?php echo $this->_MT_LANG->LISTINGS ?></a>(<?php echo $this->total_links ?>)</div>
<div class="users-reviews-active"><span><?php echo $this->_MT_LANG->REVIEWS ?></span>(<?php echo $this->pageNav->total ?>)</div>
<?php if($this->mtconf['show_favourite']) { ?><div class="users-favourites"><a href="<?php echo sefReltoAbs("index.php?option=com_mtree&task=viewusersfav&user_id=".$this->owner->id."&Itemid=$this->Itemid") ?>"><?php echo $this->_MT_LANG->FAVOURITES ?></a>(<?php echo $this->total_favourites ?>)</div><?php } ?>
</div>
<div class="reviews">
<?php if (is_array($this->reviews) && !empty($this->reviews)) { ?>

	<div class="info"><b><?php echo $this->pageNav->writePagesCounter(); ?></b></div><?php

		foreach ($this->reviews AS $review): 
	?>
	<div class="review">
		<div class="review-listing"><?php $this->plugin('ahref', array("path"=>"index.php?option=".$this->option."&task=viewlink&link_id=".$review->link_id."&Itemid=".$this->Itemid), $review->link_name); ?></div>
		<div class="review-head">
		<div class="review-title"><?php 

		if($review->rating > 0) { ?><div class="review-rating"><?php $this->plugin( 'review_rating', $review->rating ); ?></div><?php }

		$this->plugin('ahref', array("path"=>"index.php?option=".$this->option."&task=viewlink&link_id=".$review->link_id."&Itemid=".$this->Itemid,"fragment"=>"rev-".$review->rev_id), $review->rev_title,'id="rev-'.$review->rev_id.'"'); 
		
		?></div><div class="review-info"><?php 
		echo $this->_MT_LANG->REVIEWED_BY ?><span class="review-owner"><?php echo ( ($review->user_id) ? $review->username : $review->guest_name); ?></span>, <?php echo date("F j, Y",strtotime($review->rev_date)) ?>
		</div><?php 
		
		echo '<div id="rhc'.$review->rev_id.'" class="found-helpful"'.( ($review->vote_total==0)?' style="display:none"':'' ).'>';
		echo '<span id="rh'.$review->rev_id.'">';
		if( $review->vote_total > 0 ) { 
			printf( $this->_MT_LANG->PEOPLE_FIND_THIS_REVIEW_HELPFUL, $review->vote_helpful, $review->vote_total );
		}
		echo '</span>';
		echo '</div>';
		
		echo '</div>';
		?>
		<div class="review-text">
		<?php 
		if ($review->link_image) {
			echo '<div class="thumbnail">';
			echo '<a href="index.php?option=com_mtree&task=viewlink&link_id=' . $review->link_id . '&Itemid=' . $this->Itemid . '">';
			$this->plugin( 'mt_image', $review->link_image, '3', $review->link_name );
			echo '</a>';
			echo '</div>';
		}
		
		echo $review->rev_text;

		if( !empty($review->ownersreply_text) && $review->ownersreply_approved ) {
			echo '<div class="owners-reply">';
			echo '<span>'.$this->_MT_LANG->OWNERS_REPLY.'</span>';
			echo '<p>' . $review->ownersreply_text . '</p>';
			echo '</div>';
		}
		?>
		</div>
	</div>
	<?php
	endforeach; 

	if( $this->pageNav->total > $this->pageNav->limit ) {
		?><div class="pages-counter"><?php echo $this->pageNav->writePagesCounter(); ?></div>
		<div class="pages-links"><?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=$this->option&amp;user_id=" . $this->owner->id . "&amp;Itemid=$this->Itemid") ?></div><?php
	}


} else {

	?><center><?php
	if( $this->my->id == $this->owner->id ) {
		echo $this->_MT_LANG->YOU_DO_NOT_HAVE_ANY_REVIEWS;
	} else {
		echo $this->_MT_LANG->THIS_USER_DO_NOT_HAVE_ANY_REVIEWS;
	}
	?></center><?php
	
}
?></div>