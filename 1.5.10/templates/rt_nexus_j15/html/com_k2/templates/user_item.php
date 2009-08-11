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

<!-- Plugins: BeforeDisplay -->
<?php echo $this->item->event->BeforeDisplay; ?>

<!-- K2 Plugins: K2BeforeDisplay -->
<?php echo $this->item->event->K2BeforeDisplay; ?>

<?php if ($this->item->params->get('userItemTitle')):?>
<h1 class="itemTitle"><?php echo $this->item->title;?></h1>
<?php endif; ?>

<!-- Plugins: AfterDisplayTitle -->
<?php echo $this->item->event->AfterDisplayTitle; ?>
	
<!-- K2 Plugins: K2AfterDisplayTitle -->
<?php echo $this->item->event->K2AfterDisplayTitle; ?>

<?php if ($this->item->params->get('userItemDateCreated')):?>
	<span class="itemDateCreated"><?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')) ?></span>
<?php endif; ?>

<!-- Plugins: BeforeDisplayContent -->
<?php echo $this->item->event->BeforeDisplayContent; ?>

<!-- K2 Plugins: K2BeforeDisplayContent -->
<?php echo $this->item->event->K2BeforeDisplayContent; ?>

<?php if ($this->item->params->get('userItemImage') && isset($this->item->imageGeneric)):?>
	<div class="itemImageMainBlock"><span class="itemImage"><img src="<?php echo $this->item->imageGeneric;?>" alt="<?php echo $this->item->title;?>" /></span></div>
<?php endif; ?>

<?php if ($this->item->params->get('userItemIntroText')):?>
	<div class="itemIntroText"><?php echo $this->item->introtext;?></div>
<?php endif; ?>

<!-- Plugins: AfterDisplayContent -->
<?php echo $this->item->event->AfterDisplayContent; ?>

<!-- K2 Plugins: K2AfterDisplayContent -->
<?php echo $this->item->event->K2AfterDisplayContent; ?>

<?php if ($this->item->params->get('userItemCategory') or ($this->item->params->get('userItemTags') && count($this->item->tags) or ($this->item->params->get('userItemCommentsAnchor')))):?>
<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
	<div class="center">
		<?php if ($this->item->params->get('userItemCategory')):?>
		<div class="itemCategory">
			<span><?php echo JText::_('Category:'); ?></span>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
		</div>
		<?php endif; ?>
		<?php if ($this->item->params->get('userItemTags') && count($this->item->tags)):?>
		<div class="itemTagsBlock">
			<span><?php echo JText::_('Tags:'); ?></span>
			<ul class="itemTags">
				<?php foreach ($this->item->tags as $tag):?>
				<li><a href="<?php echo $tag->link;?>"><?php echo $tag->name; ?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<?php endif; ?>

		<?php if ($this->item->params->get('userItemCommentsAnchor')):?>
		<div class="comments-link">
			<a class="itemCommentsLink" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
				<span><?php echo $this->item->numOfComments; ?></span> <?php echo JText::_('comments'); ?>
			</a>
		</div>
		<?php endif; ?>
	</div>
</div></div></div></div>
<?php endif; ?>

<?php if ($this->item->params->get('userItemReadMore')):?>
<div class="itemReadMoreBlock">
	<div class="readon-wrap1"><div class="readon1-l"></div><a class="readon-main" href="<?php echo $this->item->link; ?>"><span class="readon1-m"><span class="readon1-r"><?php echo JText::_('Read more...'); ?>
</div></span></span></a></div><div class="clr"></div>
<?php endif; ?>

<!-- Plugins: AfterDisplay -->
<?php echo $this->item->event->AfterDisplay; ?>

<!-- K2 Plugins: K2AfterDisplay -->
<?php echo $this->item->event->K2AfterDisplay; ?>
