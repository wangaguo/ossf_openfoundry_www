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

<div id="k2Container" class="authorView <?php echo $this->params->get('pageclass_sfx')?>">

	<?php if ($this->params->get('userFeed')):?>
	<!-- RSS feed -->
	<div id="authorRssFeedBlock">
		<a href="<?php echo $this->feed ;?>">
			<img src="<?php echo JURI::root();?>components/com_k2/images/system/feed-icon-14x14.gif" alt="<?php echo JText::_('Subscribe to this RSS feed'); ?>" title="<?php echo JText::_('Subscribe to this RSS feed'); ?>" />
		</a>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<!-- Page title -->
	<h1 class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>
	
	<?php if ($this->params->get('userImage') && !empty($this->user->image) or $this->params->get('userName') or $this->params->get('userDescription') && isset($this->user->profile->description) or $this->params->get('userURL') && isset($this->user->profile->url) or $this->params->get('userEmail')):?>
	<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
		<div class="center">
			<div class="authorBlock">
				<?php if ($this->params->get('userImage') && !empty($this->user->image)):?>
					<img class="authorAvatar" src="<?php echo JURI::root().'media/k2/users/'.$this->user->image;?>" alt="<?php echo $this->user->name;?>" />
				<?php endif; ?>

				<?php if ($this->params->get('userName')):?>
					<h1 class="authorName"><?php echo $this->user->name;?></h1>
				<?php endif; ?>
		
				<?php if ($this->params->get('userDescription') && isset($this->user->profile->description)):?>
					<p><?php echo $this->user->profile->description;?></p>
				<?php endif; ?>
		
				<?php if ($this->params->get('userURL') && isset($this->user->profile->url)):?>
					<span class="authorUrl"><?php echo JText::_("Website:"); ?> <a href="<?php echo $this->user->profile->url;?>" target="_blank"><?php echo $this->user->profile->url;?></a></span>
				<?php endif; ?>
		
				<?php if ($this->params->get('userEmail')):?>
					<span class="authorEmail"><?php echo JText::_("E-mail:"); ?> <?php echo JHTML::_('Email.cloak', $this->user->email); ?></span>
				<?php endif; ?>
		
				<?php echo $this->user->event->K2UserDisplay; ?>
				<div class="clr"></div>
			</div>
		<?php if ($this->params->get('userImage') && !empty($this->user->image) or $this->params->get('userName') or $this->params->get('userDescription') && isset($this->user->profile->description) or $this->params->get('userURL') && isset($this->user->profile->url) or $this->params->get('userEmail')):?>
		</div>
	</div></div></div></div>
	<?php endif; ?>
	<?php endif; ?>

	<div class="itemlist">
		<?php foreach ($this->items as $item) :?>
		<div>
		<?php 
		$this->item=$item;
		echo $this->loadTemplate('item');
		?>
		</div>
		<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
		<div class="k2-break-div"></div>
		<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
		<?php endforeach; ?>
	</div>
	
	<div>
		<?php echo $this->pagination->getPagesLinks(); ?>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>

</div>
