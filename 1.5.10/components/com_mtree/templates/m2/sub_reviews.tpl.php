<div class="reviews">
	<div class="title"><?php echo $this->_MT_LANG->REVIEWS; ?> (<?php echo $this->pageNav->total ?>)</div>

	<?php
	if (is_array($this->reviews) && !empty($this->reviews)):
		foreach ($this->reviews AS $review): 
	?>
	<div class="review"><div class="review-head"><div class="review-title"><?php 

		if($review->rating > 0) { ?><div class="review-rating"><?php $this->plugin( 'review_rating', $review->rating ); ?></div><?php }

		$this->plugin('ahref', array("path"=>"index.php?option=".$this->option."&amp;task=viewlink&amp;link_id=".$review->link_id."&amp;Itemid=".$this->Itemid,"fragment"=>"rev-".$review->rev_id), $review->rev_title,'id="rev-'.$review->rev_id.'"'); 
		
		?></div><div class="review-info"><?php 
		echo $this->_MT_LANG->REVIEWED_BY ?><span class="review-owner"><?php echo ( ($review->user_id) ? '<a href="' . sefReltoAbs('index.php?option=com_mtree&amp;task=viewusersreview&amp;user_id='.$review->user_id.'&amp;Itemid='.$this->Itemid) . '">' . $review->username . '</a>': $review->guest_name); ?></span>, <?php echo strftime('%B %e, %Y', strtotime($review->rev_date)); ?>
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
		echo trim($review->rev_text);

		if( !empty($review->ownersreply_text) && $review->ownersreply_approved ) {
			echo '<div class="owners-reply">';
			echo '<span>'.$this->_MT_LANG->OWNERS_REPLY.'</span>';
			echo '<p>' . $review->ownersreply_text . '</p>';
			echo '</div>';
		}
		?>
		</div>
		<?php
	
		if( $this->my->id > 0 && $this->mtconf['user_vote_review'] == 1 ) { 
			echo '<div class="ask-helpful">';
			if( array_key_exists($review->rev_id, $this->voted_reviews) ) {
				// User has voted before
			} else {
				echo '<div class="ask-helpful2" id="ask'.$review->rev_id.'">';
				echo $this->_MT_LANG->WAS_THIS_REVIEW_HELPFUL;
				echo '</div>';
			?> <span id="rhaction<?php echo $review->rev_id ?>" class="rhaction"><a href="<?php 
				echo('index.php?option='.$this->option.'&amp;task=votereview&amp;rev_id='.$review->rev_id.'&amp;vote=1&amp;Itemid='.$this->Itemid) 
				?>" onclick="return(voteHelpful('<?php echo $review->rev_id ?>','1'))"><?php echo $this->_MT_LANG->YES; ?></a>&nbsp;&nbsp;<a href="<?php 
				echo('index.php?option='.$this->option.'&amp;task=votereview&amp;rev_id='.$review->rev_id.'&amp;vote=-1&amp;Itemid='.$this->Itemid) 
				?>" onclick="return(voteHelpful('<?php echo $review->rev_id ?>','-1'))"><?php echo $this->_MT_LANG->NO; ?></a></span><?php 
			}
			echo '</div>';
		} 
		
		if( ( ($this->mtconf['user_report_review'] == 1 && $this->my->id > 0) || $this->mtconf['user_report_review'] == 0) || ( $this->my->id == $this->link->user_id && empty($review->ownersreply_text) )) {
			echo '<div class="review-reply-and-report" style="text-align:right">';
			if( ($this->mtconf['user_report_review'] == 1 && $this->my->id > 0) || $this->mtconf['user_report_review'] == 0) { 
				?><div class="review-report"><a href="<?php echo sefReltoAbs('index.php?option='.$this->option.'&amp;task=reportreview&amp;rev_id='.$review->rev_id.'&amp;Itemid='.$this->Itemid) ?>" style="font-weight:normal"><?php echo $this->_MT_LANG->REPORT_REVIEW; ?></a></div><?php 
			} 

			if( $this->my->id == $this->link->user_id && empty($review->ownersreply_text) ) { 
				?><div class="review-reply"><a href="<?php echo sefReltoAbs('index.php?option='.$this->option.'&amp;task=replyreview&amp;rev_id='.$review->rev_id.'&amp;Itemid='.$this->Itemid) ?>" style="font-weight:normal"><?php echo $this->_MT_LANG->REPLY_REVIEW ?></a></div><?php 
			}
			echo '</div>';
		}
		?>

	</div>
	<?php endforeach; ?>

	<?php if( $this->pageNav->total > $this->pageNav->limit ) { ?>
	<div class="pages-links"><?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=viewlink&amp;link_id=$this->link_id&amp;Itemid=$this->Itemid") ?></div>
	<?php }?>
	<div class="pages-counter"><?php echo $this->pageNav->writePagesCounter(); ?></div>

	<?php else: ?>

	<p />
	<?php $this->plugin('ahref', "index.php?option=$this->option&amp;task=writereview&amp;link_id=$this->link_id&amp;Itemid=$this->Itemid", $this->_MT_LANG->BE_THE_FIRST_TO_REVIEW); ?>
	
	<?php endif; ?>

</div>