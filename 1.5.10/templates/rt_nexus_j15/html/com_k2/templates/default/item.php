<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

?>

<!-- START K2 Item Layout -->
<div id="k2Container" class="itemView <?php if($this->params->get('pageclass_sfx')) echo $this->params->get('pageclass_sfx'); ?>">

	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>
	
	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>

	<div class="itemHeader">
		<?php if ($this->params->get('itemDateCreated')): ?>
		<span class="itemDateCreated">
			<?php echo JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC2')); ?>
		</span>
		<?php endif; ?>
	
	  <?php if ($this->params->get('itemTitle')): ?>
	  <h1 class="itemTitle">
	  	<?php echo $this->item->title; ?>
	  	
	  	<?php if ($this->params->get('itemFeaturedNotice') && $this->item->featured): ?>
	  	<span>
		  	<sup>
		  		<?php echo JText::_('Featured'); ?>
		  	</sup>
	  	</span>
	  	<?php endif; ?>

	  </h1>
	  <?php endif; ?>
		
		<?php if (isset($this->item->editLink)): ?>
		<!-- Item edit link -->
		<span class="k2EditLink">
			<a class="modal" rel="{handler:'iframe',size:{x:1000,y:650}}" href="<?php echo $this->item->editLink;?>">
				<?php echo JText::_('Edit item');?>
			</a>
		</span>
		<?php endif; ?>
		
  </div>


  <!-- Plugins: AfterDisplayTitle -->
  <?php echo $this->item->event->AfterDisplayTitle; ?>
  
  <!-- K2 Plugins: K2AfterDisplayTitle -->
  <?php echo $this->item->event->K2AfterDisplayTitle; ?>


	<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
		<div class="center">
  <div class="itemTools">
		<?php if ($this->params->get('itemAuthor')): ?>
		<!-- Item Author -->
		<span class="itemAuthor">
			<?php echo JText::_('By'); ?> <?php echo $this->item->author->name; ?>
		</span>
		<?php endif; ?>
		
		<ul class="itemToolbar">
			<?php if($this->params->get('itemFontResizer')): ?>
			<!-- Font Resizer -->
			<li>
				<span class="itemTextResizerTitle"><?php echo JText::_('font size:'); ?></span>
				<span class="itemTextResizerButtons">
					<a href="#" id="fontIncrease">
						<span><?php echo JText::_('increase font size'); ?></span>
						<img src="images/blank.png" alt="<?php echo JText::_('increase font size'); ?>" class="k2FontIncreaseButton"/>
					</a>
					<a href="#" id="fontDecrease">
						<span><?php echo JText::_('decrease font size'); ?></span>
						<img src="images/blank.png" alt="<?php echo JText::_('decrease font size'); ?>" class="k2FontDecreaseButton"/>
					</a>
				</span>
			</li>
			<?php endif; ?>
			
			<?php if ($this->params->get('itemPrintButton')): ?>
			<!-- Print Button -->
			<li>
				<?php if (JRequest::getCmd('print')==1): ?>
				<a class="itemPrintLink" href="<?php echo $this->item->printLink; ?>" onclick="window.print();return false;">
					<span><?php echo JText::_('Print'); ?></span>
				</a>		
				<?php else: ?>
				<a class="modal itemPrintLink" href="<?php echo $this->item->printLink; ?>" rel="{handler:'iframe',size:{x:900,y:500}}">
					<span><?php echo JText::_('Print'); ?></span>
				</a>
				<?php endif; ?>
			</li>
			<?php endif; ?>

			<?php if ($this->params->get('itemEmailButton') && (!JRequest::getInt('print')) ): ?>
			<!-- Email Button -->
			<li>
				<a class="itemEmailLink" onclick="window.open(this.href,'win2','width=400,height=350,menubar=yes,resizable=yes'); return false;" href="<?php echo $this->item->emailLink; ?>">
					<span><?php echo JText::_('Email'); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if ($this->params->get('itemSocialButton') && !is_null($this->params->get('socialButtonCode', NULL))): ?>
			<!-- Item Social Button -->
			<li>
				<?php echo $this->params->get('socialButtonCode'); ?>
			</li>
			<?php endif; ?>
			
			
			<?php if ($this->params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
			<!-- Anchor link to item video below - if it exists -->
			<li>
				<a class="itemVideoLink" href="#itemVideoAnchor"><?php echo JText::_('Related Video'); ?></a>
			</li>
			<?php endif; ?>
			
			<?php if ($this->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
			<!-- Anchor link to item image gallery below - if it exists -->
			<li>
				<a class="itemImageGalleryLink" href="#itemImageGalleryAnchor"><?php echo JText::_('Image Gallery'); ?></a>
			</li>
			<?php endif; ?>
			
			<?php if ($this->params->get('itemCommentsAnchor') && $this->item->numOfComments > 0 && ( ($this->params->get('comments') == '2' && !$this->user->guest) || ($this->params->get('comments') == '1')) ): ?>
			<!-- Anchor link to comments below - if enabled -->
			<li>
				<a class="itemCommentsLink" href="#itemCommentsAnchor">
					<span><?php echo $this->item->numOfComments; ?></span> <?php echo JText::_('comments'); ?>
				</a>
			</li>
			<?php endif; ?>
		</ul>
		
		<div class="clr"></div>
  </div>
</div>
</div></div></div></div>


	<?php if ($this->params->get('itemRating')): ?>
	<!-- Item Rating -->
	<div class="itemRatingBlock">
		<?php echo $this->item->ratingForm; ?>
	</div>
	<?php endif; ?>


  <div class="itemBody">
  
  
  
	  <!-- Plugins: BeforeDisplayContent -->
	  <?php echo $this->item->event->BeforeDisplayContent; ?>
	  
	  <!-- K2 Plugins: K2BeforeDisplayContent -->
	  <?php echo $this->item->event->K2BeforeDisplayContent; ?>


	  <?php if ($this->params->get('itemImage') && !empty($this->item->image)): ?>
	  <!-- Item Main Image -->
	  <div class="itemMainImageBlock">
	  
		  <span class="itemMainImage">
		  	<img src="<?php echo $this->item->image; ?>" alt="<?php if (!empty($this->item->image_caption)) echo $this->item->image_caption; else echo $this->item->title; ?>" />
		  </span>
		  
		  <?php if ($this->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
		  <span class="itemMainImageCaption"><?php echo $this->item->image_caption; ?></span>
		  <?php endif; ?>
		  
		  <?php if ($this->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
		  <span class="itemMainImageCredits"><?php echo $this->item->image_credits; ?></span>
		  <?php endif; ?>
		  
		  <div class="clr"></div>
	  </div>
	  <?php endif; ?>
	  
	  <?php if ($this->params->get('itemIntroText')): ?>
	  <!-- Item introtext -->
	  <div class="itemIntroText">
	  	<?php echo $this->item->introtext; ?>
	  </div>
	  <?php endif; ?>

	  <?php if ($this->params->get('itemFullText')): ?>
	  <!-- Item fulltext -->
	  <div class="itemFullText">
	  	<?php echo $this->item->fulltext; ?>
	  </div>
	  <?php endif; ?>
		
		<div class="clr"></div>

	  <?php if ($this->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
	  <!-- Item extra fields -->  
	  <div class="itemExtraFields">
	  	<h3><?php echo JText::_('Additional Info'); ?></h3>
			<?php foreach ($this->item->extra_fields as $extraField):?>
				<div><span><?php echo $extraField->name;?>:</span> <?php echo $extraField->value;?></div>
			<?php endforeach; ?>
	    <div class="clr"></div>
	  </div>
	  <?php endif; ?>
	  
		<?php if($this->params->get('itemDateModified')):?>
			<!-- Item date modified -->
			<?php if ($this->item->created!=$this->item->modified): ?>
			<span class="itemDateModified">
				<?php echo JText::_('Last modified on'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2')); ?> 
			</span>
			<?php endif; ?>
		<?php endif; ?>

	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $this->item->event->AfterDisplayContent; ?>
	  
	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $this->item->event->K2AfterDisplayContent; ?>

	  <div class="clr"></div>
  </div>
	<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
	<div class="k2-break-div"></div>
	<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
 
  <?php if ($this->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)):?>
<!-- Author Block -->
<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
	<div class="center">
 		<div class="itemAuthorBlock">
	  		<?php if ($this->params->get('itemAuthorImage') && !empty($this->item->author->profile->image)):?>
		  	<img class="itemAuthorAvatar" src="<?php echo JURI::root().'media/k2/users/'.$this->item->author->profile->image; ?>" alt="<?php echo $this->item->author->name; ?>" />
		  	<?php endif; ?>
		    <div class="itemAuthorDetails">
		      <h3 class="itemAuthorName">
		      	<a href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
		      </h3>
		      <?php if ($this->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)):?>
		      <p><?php echo $this->item->author->profile->description; ?></p>
		      <?php endif; ?>
     
		      <?php if ($this->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)):?>
		      <span class="itemAuthorUrl"><?php echo JText::_("Website:"); ?> <a href="<?php echo $this->item->author->profile->url; ?>" target="_blank"><?php echo str_replace('http://','',$this->item->author->profile->url); ?></a></span>
		      <?php endif; ?>
     
		      <?php if ($this->params->get('itemAuthorEmail')):?>
		      <span class="itemAuthorEmail"><?php echo JText::_("E-mail:"); ?> <?php echo JHTML::_('Email.cloak', $this->item->author->email); ?></span>
		      <?php endif; ?>
		    </div>
		    <div class="clr"></div>
	  	</div>  
	</div>
</div></div></div></div>
<?php endif; ?>
 
  <?php if ($this->params->get('itemAuthorLatest') &&  empty($this->item->created_by_alias) && isset($this->authorLatestItems)):?>
  <!-- itemAuthorLatest -->
  <div class="itemAuthorLatest">
  	<h3><?php echo JText::_("Author's latest items");?></h3>
  	<?php foreach ($this->authorLatestItems as $item):?>
		<div><a href="<?php echo $item->link ?>"><?php echo $item->title;?></a></div>
	<?php endforeach; ?>
  </div>
  <?php endif; ?>
  
  <?php if ($this->params->get('itemRelated') && isset($this->relatedItems)):?>
  <!-- itemRelated -->
  <div class="itemRelated">
  	<h3><?php echo JText::_("Related items");?></h3>
  	<?php foreach ($this->relatedItems as $item):?>
		<div><a href="<?php echo $item->link ?>"><?php echo $item->title;?></a></div>
	<?php endforeach; ?>
  </div>
  <?php endif; ?>
  <div class="clr"></div>
  
  
  <?php if ($this->params->get('itemHits') || $this->params->get('itemTwitterLink')): ?>
  <!-- Item info block -->
  <div class="itemInfo">
		<?php if ($this->params->get('itemHits')): ?>
		<!-- Item Hits -->
		<span class="itemHits">
			<?php echo JText::_('Read'); ?> <?php echo $this->item->hits; ?> <?php echo JText::_('times'); ?>
		</span>
		<?php endif; ?>

		<?php if ($this->params->get('itemTwitterLink')): ?>
		<!-- Twitter Link -->
		<span class="itemTwitterLink">
			<a title="<?php echo JText::_('Like this? Tweet it to your followers!'); ?>" href="<?php echo $this->item->twitterURL;?>" target="_blank">
				<?php echo JText::_('Like this? Tweet it to your followers!'); ?>
			</a>
		</span>
		<?php endif; ?>
	</div>
  <?php endif; ?>
  
  
  
  <?php if ($this->params->get('itemCategory') || $this->params->get('itemTags') || $this->params->get('itemShareLinks') || $this->params->get('itemAttachments')): ?>
  <div class="itemLinks">
		
		<?php if ($this->params->get('itemCategory')): ?>
		<!-- Item category name -->
		<div class="itemCategory">
			<span><?php echo JText::_('Category:'); ?></span>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
		</div>
		<?php endif; ?>
		
	  <?php if ($this->params->get('itemTags') && count($this->item->tags)): ?>
	  <!-- Item tags -->
	  <div class="itemTagsBlock">
		  <span><?php echo JText::_("Tags:"); ?></span>
		  <ul class="itemTags">
		    <?php foreach ($this->item->tags as $tag): ?>
		    <li><a href="<?php echo $tag->link;?>"><?php echo $tag->name; ?></a></li>
		    <?php endforeach; ?>
		  </ul>
	  </div>
	  <?php endif; ?>

	  <?php if ($this->params->get('itemShareLinks')): ?>
	  <!-- Item social links -->
	  <div class="itemSocialLinksBlock">
	  	<span><?php echo JText::_("Share:"); ?></span>
			<ul class="itemSocialLinks">
				<li><a class="digg" title="<?php echo JText::_("Digg this"); ?>" href="http://digg.com/submit?url=<?php echo $this->item->link; ?>&amp;title=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Digg this"); ?></span></a></li>
				<li><a class="delicious" title="<?php echo JText::_("Add to Delicious"); ?>" href="http://del.icio.us/post?url=<?php echo $this->item->link; ?>&amp;title=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to Delicious"); ?></span></a></li>
				<li><a class="facebook" title="<?php echo JText::_("Add to Facebook"); ?>" href="http://www.facebook.com/share.php?u=<?php echo $this->item->link; ?>&amp;t=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to Facebook"); ?></span></a></li>
				<li><a class="windowslive" title="<?php echo JText::_("Add to Windows Live"); ?>" href="https://favorites.live.com/quickadd.aspx?url=<?php echo $this->item->link; ?>&amp;title=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to Windows Live"); ?></span></a></li>
				<li><a class="myspace" title="<?php echo JText::_("Add to MySpace"); ?>" href="http://www.myspace.com/Modules/PostTo/Pages/?l=3&amp;u=<?php echo $this->item->link; ?>&amp;t=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to MySpace"); ?></span></a></li>
				<li><a class="yahoobuzz" title="<?php echo JText::_("Add to Yahoo Buzz"); ?>" href="http://buzz.yahoo.com/submit?submitUrl=<?php echo $this->item->link; ?>&amp;submitHeadline=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to Yahoo Buzz"); ?></span></a></li>
				<li><a class="google" title="<?php echo JText::_("Add to Google Bookmarks"); ?>" href="http://www.google.com/bookmarks/mark?op=add&amp;bkmk=<?php echo $this->item->link; ?>&amp;title=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to Google Bookmarks"); ?></span></a></li>
				<li><a class="reddit" title="<?php echo JText::_("Add to Reddit"); ?>" href="http://reddit.com/submit?url=<?php echo $this->item->link; ?>&amp;title=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to Reddit"); ?></span></a></li>
				<li><a class="technorati" title="<?php echo JText::_("Add to Technorati"); ?>" href="http://www.technorati.com/faves?add=<?php echo $this->item->link; ?>" target="_blank"><span><?php echo JText::_("Add to Technorati"); ?></span></a></li>
				<li><a class="stumble" title="<?php echo JText::_("Add to StumbleUpon"); ?>" href="http://www.stumbleupon.com/submit?url=<?php echo $this->item->link; ?>&amp;title=<?php echo urlencode($this->item->title); ?>" target="_blank"><span><?php echo JText::_("Add to StumbleUpon"); ?></span></a></li>
				<li class="clr"></li>
			</ul>
			<div class="clr"></div>
	  </div>
	  <?php endif; ?>
	  
	  <?php if ($this->params->get('itemAttachments') && count($this->item->attachments)): ?>
	  <!-- Item attachments -->
	  <div class="itemAttachmentsBlock">
		  <span><?php echo JText::_("Download attachments:"); ?></span>
		  <ul class="itemAttachments">
		    <?php foreach ($this->item->attachments as $attachment): ?>
		    <li>
			    <a title="<?php echo $attachment->titleAttribute; ?>" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=download&id='.$attachment->id); ?>">
			    	<?php echo $attachment->title ; ?>
			    </a>
			    <?php if ($this->params->get('itemAttachmentsCounter')): ?>
			    <span><?php echo $attachment->hits; ?> <?php echo JText::_("downloads"); ?></span>
			    <?php endif; ?>
		    </li>
		    <?php endforeach; ?>
		  </ul>
	  </div>
	  <?php endif; ?>

		<div class="clr"></div>
  </div>
  <?php endif; ?>
  
  
  
  <?php if ($this->params->get('itemVideo') && !empty($this->item->video)): ?>
  <!-- Item video -->
  <a name="itemVideoAnchor" id="itemVideoAnchor"></a>
  <div class="itemVideoBlock">
  	<h3 class="itemVideoTitle"><?php echo JText::_('Related Video'); ?></h3>
	  <span class="itemVideo"><?php echo $this->item->video; ?></span>
	  
	  <?php if ($this->params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
	  <span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
	  <?php endif; ?>
	  
	  <?php if ($this->params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
	  <span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
	  <?php endif; ?>
	  
	  <div class="clr"></div>
  </div>
  <?php endif; ?>
  

  <?php if ($this->params->get('itemImageGallery')  && !empty($this->item->gallery)): ?>
  <!-- Item image gallery -->
  <a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
  <div class="itemImageGallery">
	  <h3 class="itemImageGalleryTitle"><?php echo JText::_('Photo Gallery'); ?></h3>
	  <?php echo $this->item->gallery; ?>
  </div>
  <?php endif; ?>
  
  
  
  <?php if ($this->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
  <!-- Item navigation -->
  <div class="itemNavigation">
  	<span class="itemNavigationTitle"><?php echo JText::_('More in this category:'); ?></span>
	
		<?php if (isset($this->item->previousLink)): ?>
		<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">
			&laquo; <?php echo $this->item->previousTitle; ?>
		</a>
		<?php endif; ?>
		
		<?php if (isset($this->item->nextLink)): ?>
		<a class="itemNext" href="<?php echo $this->item->nextLink; ?>">
			<?php echo $this->item->nextTitle; ?> &raquo;
		</a>
		<?php endif; ?>
		
  </div>
  <?php endif; ?>
	<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
	<div class="k2-break-div"></div>
	<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
  
  
  
  <!-- Plugins: AfterDisplay -->
  <?php echo $this->item->event->AfterDisplay; ?>
  
  <!-- K2 Plugins: K2AfterDisplay -->
  <?php echo $this->item->event->K2AfterDisplay; ?>
  
 <?php if ($this->params->get('itemComments') && !JRequest::getInt('print') && ($this->params->get('comments') == '1' || ($this->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))):?>
  <!-- Item comments -->
  <a name="itemCommentsAnchor" id="itemCommentsAnchor"></a>
	<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
		<div class="center">  
  <div class="itemComments">
	  
	  <?php if ($this->params->get('commentsFormPosition')=='above'): ?>
	  <!-- Item comments form -->
	  <div class="itemCommentsForm">
	  	<?php echo $this->loadTemplate('comments_form'); ?>
	  </div>
	  <?php endif; ?>
	  
	  
	  <?php if ($this->item->numOfComments>0): ?>
	  <!-- Item user comments -->
	  <h4 class="itemCommentsCounter">
	  	<span><?php echo $this->item->numOfComments; ?></span> <?php echo JText::_('comments'); ?>
	  </h4>
	  
	  <ul class="itemCommentsList">
	    <?php $i=0; ?>
	    <?php foreach ($this->item->comments as $comment): ?>
	    <li class="<?php echo ($i%2) ? "odd" : "even"; ?>">
		    
			<?php if ($comment->userImage):?>
				<img style="float:left; margin-right:5px; margin-bottom:5px;" src="<?php echo $comment->userImage; ?>" alt="<?php echo $comment->userName; ?>" width="<?php echo $this->params->get('commenterImgWidth');?>" />
			<?php endif;?>
			
			<span class="commentDate">
		    	<?php echo JHTML::_('date', $comment->commentDate, JText::_('DATE_FORMAT_LC2')); ?>
		    </span>
		    <span class="commentAuthorName">
			    <?php echo JText::_("posted by"); ?>
			    <?php if(!empty($comment->commentURL)): ?>
			    <a href="<?php echo $comment->commentURL; ?>" title="<?php echo $comment->userName; ?>">
			    	<?php echo $comment->userName; ?>
			    </a>
			    <?php else: ?>
			    <?php echo $comment->userName; ?>
			    <?php endif; ?>
		    </span>
		    <span class="commentLink">
		    	<a href="#comment<?php echo $comment->id; ?>" name="comment<?php echo $comment->id; ?>" id="comment<?php echo $comment->id; ?>"><?php echo JText::_('Comment Link'); ?></a>
		    </span>
		    <p><?php echo $comment->commentText; ?></p>
		    <span class="commentAuthorEmail">
		    	<?php echo JHTML::_('Email.cloak', $comment->commentEmail, 0); ?>
		    </span>
			<div style="clear:both"></div>
	    </li>
	    <?php $i++; ?>
	    <?php endforeach; ?>
	  </ul>
	  
	  <div class="itemCommentsPagination">
	  	<?php echo $this->pagination->getPagesLinks(); ?>
	  	<div class="clr"></div>
	  </div>
		<?php endif; ?>

		
	 <?php if ($this->params->get('commentsFormPosition')=='below'): ?>
	  <!-- Item comments form -->
	  <div class="itemCommentsForm">
	  	<?php echo $this->loadTemplate('comments_form'); ?>
	  </div>
	  <?php endif; ?>
	  
  </div>
</div>
</div></div></div></div>
  <?php endif; ?>



	<div class="clr"></div>
</div>
<!-- End K2 Item Layout -->
