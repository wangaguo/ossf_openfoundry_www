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

<!-- Item container START -->
<div class="itemContainer <?php echo $this->isGroup; ?>">
	
	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>
	
	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>
	
	<div class="itemHeader">
		<?php if ($this->item->params->get('catItemDateCreated')): ?>
		<!-- Item date created -->
		<span class="itemDateCreated"><?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')); ?></span>
		<?php endif; ?>
	
		<?php if ($this->item->params->get('catItemTitle')): ?>
		<!-- Item title -->
		<h1 class="itemTitle">
			
	    <?php if (!empty($this->item->fulltext)):?>
			<a href="<?php echo $this->item->link; ?>" title="<?php echo $this->item->title; ?>">
		<?php endif; ?>
		
		<?php echo $this->item->title; ?>
		
		<?php if($this->item->params->get('catItemFeaturedNotice') && $this->item->featured):?>
	    <span><sup><?php echo JText::_('Featured'); ?></sup></span>
		<?php endif;?>
		
		<?php if (!empty($this->item->fulltext)):?>
			</a>
		<?php endif; ?>
		
		<?php if (isset($this->item->editLink)): ?>
		<!-- Item edit link -->
		<span class="k2EditLink"><a class="modal" rel="{handler:'iframe',size:{x:950,y:650}}" href="<?php echo $this->item->editLink;?>"><?php echo JText::_('Edit item');?></a></span>
		<?php endif; ?>
		
		</h1>
		<?php endif; ?>
	</div>
	
	<!-- Plugins: AfterDisplayTitle -->
	<?php echo $this->item->event->AfterDisplayTitle; ?>
	
	<!-- K2 Plugins: K2AfterDisplayTitle -->
	<?php echo $this->item->event->K2AfterDisplayTitle; ?>
	
	<div class="itemTools">
		<?php if ($this->item->params->get('catItemAuthor')): ?>
		<!-- Item author -->
		<span class="itemAuthor"><?php echo JText::_('By'); ?> <a href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a></span>
		<?php endif; ?>
	
		<ul class="itemToolbar">
			
			<?php if ($this->item->video && $this->item->params->get('itemVideo')): ?>
			<!-- Link to item video below -->
			<li><a class="itemVideoLink" href="<?php echo $this->item->link; ?>#itemVideoAnchor"><?php echo JText::_('Related Video'); ?></a></li>
			<?php endif; ?>
			
			<?php if ($this->item->gallery && $this->item->params->get('itemImageGallery')): ?>
			<!-- Link to item image gallery below -->
			<li><a class="itemImageGalleryLink" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor"><?php echo JText::_('Photo Gallery'); ?></a></li>
			<?php endif; ?>			
	
			<?php if ((($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) && $this->item->numOfComments>0 && $this->item->params->get('itemComments') && $this->item->params->get('catItemCommentsAnchor')): ?>
			<!-- Link to item comments below -->
			<li><a class="itemCommentsLink" href="<?php echo $this->item->link; ?>#itemCommentsAnchor"><span><?php echo $this->item->numOfComments; ?></span> <?php echo JText::_('comments'); ?></a></li>
			<?php endif; ?>
		</ul>
	
		<div class="clr"></div>
	</div>
	
	<?php if ($this->item->params->get('catItemRating')): ?>
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
	  
	  <?php if(isset($this->isGroup) && $this->isGroup != 'leading'): ?>
	  
	  <?php if (isset($this->item->thumb) && $this->item->params->get('catItemImageThumb')) : ?>
	  <!-- Item Thumb -->
	  <div class="itemImageThumbBlock">
	  	<span class="itemImage">
	  		
	    <?php if (!empty($this->item->fulltext)):?>
	    <a href="<?php echo $this->item->link;?>">
	    <?php endif; ?>
		
	    <img src="<?php echo JURI::root().'media/k2/items/'.$this->item->catid.'/'.$this->item->thumb; ?>" alt="<?php echo $this->item->image_caption;?>" />
	    
		<?php if (!empty($this->item->fulltext)):?>
	    </a>
	    <?php endif; ?>
		
	    </span>
	  </div>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php if(isset($this->isGroup) && $this->isGroup == 'leading'): ?>
	  
		<?php if (isset($this->item->image) && $this->item->params->get('catItemImageMain')) : ?>
		  <!-- Item image -->
		  <div class="itemImageMainBlock">
		  	<span class="itemImage">
		  		
		    <?php if (!empty($this->item->fulltext)):?>
		    <a href="<?php echo $this->item->link;?>">
		    <?php endif; ?>
			
			<img src="<?php echo JURI::root().'media/k2/items/'.$this->item->catid.'/'.$this->item->image; ?>" alt="<?php echo $this->item->image_caption;?>" />
		    
			<?php if (!empty($this->item->fulltext)):?>
		    </a>
		    <?php endif; ?>
			
		    </span>
			<span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
			<span class="itemImageCredits"><?php echo JText::_("Credits:"); ?> <?php echo $this->item->image_credits; ?></span>
			<div class="clr"></div>
		  </div>
		<?php endif; ?>
		
	<?php endif; ?>
	  
	  <?php if ($this->item->params->get('catItemIntroText')): ?>
	   <!-- Item introtext -->
	  <div class="itemIntroText"><?php echo $this->item->introtext; ?></div>
	  <?php endif; ?>
	
	  <div class="clr"></div>
	  
	  <?php if ($this->item->params->get('catItemExtraFields') && count($this->item->extra_fields)): ?>
	  <!-- Item extra fields -->
	  <div class="itemExtraFields">
	    <?php foreach ($this->item->extra_fields as $extra_field): ?>
		    <label class="label-<?php echo $extra_field->type; ?>"><?php echo $extra_field->name; ?></label>
		    <span class="value-<?php echo $extra_field->type; ?>"><?php echo $extra_field->value; ?></span>
		    <br />
	    <?php endforeach; ?>
	    <div class="clr"></div>
	  </div>
	  <?php endif; ?>
		
		
	<!-- Item modified date -->
	<?php if ($this->item->modified!=$this->item->created && $this->item->params->get('catItemDateModified')): ?>
	<span class="itemDateModified">
		<?php echo JText::_('Last modified on'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2')); ?> 
	</span>
	<?php endif; ?>
		
	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $this->item->event->AfterDisplayContent; ?>
	  
	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $this->item->event->K2AfterDisplayContent; ?>
	
	  <div class="clr"></div>
	</div>
	
	
	<div class="itemLinks">
		<?php if ($this->item->params->get('catItemCategory')): ?>
		<!-- Item category name -->
		<div class="itemCategory">
			<span><?php echo JText::_('Category:'); ?></span>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo htmlspecialchars($this->item->category->name); ?></a>
		</div>
		<?php endif; ?>
	
	  <?php if ( count($this->item->tags) && $this->item->params->get('catItemTags') ): ?>
	  <!-- Item tags -->
	  <div class="itemTagsBlock">
		  <span><?php echo JText::_("Tags:"); ?></span>
		  <ul class="itemTags">
		    <?php foreach ($this->item->tags as $tag): ?>
		    <li><a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=tag&tag='.urlencode($tag->name)); ?>"><?php echo $tag->name; ?></a></li>
		    <?php endforeach; ?>
		  </ul>
	  </div>
	  <?php endif; ?>
	
	  
	  <?php if ( $this->item->params->get('catItemAttachments') && count($this->item->attachments)): ?>
	  <!-- Item attachments -->
	  <div class="itemAttachmentsBlock">
		  <span><?php echo JText::_("Download attachments:"); ?></span>
		  <ul class="itemAttachments">
		    <?php foreach ($this->item->attachments as $attachment): ?>
		    <li>
		    	<a title="<?php echo $attachment->titleAttribute; ?>" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=download&id='.$attachment->id); ?>">
			    	<?php echo $attachment->title ; ?>
			    </a>
			    <?php if ($this->item->params->get('catItemAttachmentsCounter')): ?>
			    	<span><?php echo $attachment->hits; ?> <?php echo JText::_("downloads"); ?></span>
			    <?php endif; ?>
			</li>
		    <?php endforeach; ?>
		  </ul>
	  </div>
	  <?php endif; ?>
	
		<div class="clr"></div>
	</div>
	
	<!-- Item video -->
	<?php if ($this->item->video && $this->item->params->get('catItemVideo')): ?>
	<div class="itemVideoBlock">
		<h3 class="itemVideoTitle"><?php echo JText::_('Related Video'); ?></h3>
	  <span class="itemVideo"><?php echo $this->item->video; ?></span>
	  <span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
	  <span class="itemVideoCredits"><?php echo JText::_('video courtesy of'); ?> <?php echo $this->item->video_credits; ?></span>
	  <div class="clr"></div>
	</div>
	<?php endif; ?>
	
	<!-- Item image gallery -->
	<?php if ($this->item->gallery && $this->item->params->get('catItemImageGallery')): ?>
	<div class="itemImageGallery">
	  <h3 class="itemImageGalleryTitle"><?php echo JText::_('Photo Gallery'); ?></h3>
	  <?php echo $this->item->gallery; ?>
	</div>
	<?php endif; ?>  
	
	<!-- Item 'read more...' link -->
	<?php if (!empty($this->item->fulltext) && $this->item->params->get('catItemReadMore')):?>
	<div class="itemReadMoreBlock">
		<a class="itemReadMore" href="<?php echo $this->item->link; ?>"><?php echo JText::_('Read more...'); ?></a>
	</div>
	<?php endif; ?>
	
	<!-- Plugins: AfterDisplay -->
	<?php echo $this->item->event->AfterDisplay; ?>

	<!-- K2 Plugins: K2AfterDisplay -->
	<?php echo $this->item->event->K2AfterDisplay; ?>

	<div class="clr"></div>
	
</div>
