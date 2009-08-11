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

<?php if ($this->item->params->get('genericItemTitle')):?>
	<h1 class="itemtitle"><?php echo $this->item->title;?></h1>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemDateCreated')):?>
	<span class="itemDateCreated"><?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')) ?></span>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemImage') && isset($this->item->imageGeneric)):?>
	<div class="itemImageThumbBlock"><span class="itemImage"><img src="<?php echo $this->item->imageGeneric;?>" alt="<?php echo $this->item->title;?>" /></span></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemIntroText')):?>
	<div class="itemIntroText"><?php echo $this->item->introtext;?></div>
<?php endif; ?>
<div class="clr"></div>
<?php if ($this->item->params->get('genericItemCategory')):?>
<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
	<div class="center">
		<div class="itemCategory">
			<span><?php echo JText::_('Category:'); ?></span>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
		</div>
	</div>
</div></div></div></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemReadMore')):?>
	<div class="readon-wrap1"><div class="readon1-l"></div><a class="readon-main" href="<?php echo $this->item->link; ?>"><span class="readon1-m"><span class="readon1-r"><?php echo JText::_('Read more...'); ?></span></span></a></div><div class="clr"></div>
<?php endif; ?>
	
<div class="clr"></div>
