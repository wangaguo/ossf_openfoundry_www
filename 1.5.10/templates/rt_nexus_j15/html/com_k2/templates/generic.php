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

<div id="k2Container" class="itemListView <?php echo $this->params->get('pageclass_sfx')?>">
	<!-- RSS feed -->
	<div id="itemListRssFeedBlock">
		<a href="<?php echo $this->feed ;?>">
		<img src="<?php echo JURI::root();?>components/com_k2/images/system/feed-icon-14x14.gif" alt="<?php echo JText::_('Subscribe to this RSS feed'); ?>" title="<?php echo JText::_('Subscribe to this RSS feed'); ?>" />
		</a>
	</div>
	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<!-- Page title -->
	<h1 class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>
	<div class="itemlist">
	<?php foreach ($this->items as $item) :?>
	    <div>
	      <?php 
				$this->item=$item;
				echo $this->loadTemplate('item');
			?>
	    </div>
	    <?php endforeach; ?>
	</div>
	<div>
		<?php echo $this->pagination->getPagesLinks(); ?>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
</div>