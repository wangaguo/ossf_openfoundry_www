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
	<div><?php echo $this->item->title;?></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemDateCreated')):?>
	<div><?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')) ?></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemImageThumb')):?>
	<div><img src="<?php echo JURI::root().'media/k2/items/'.$this->item->catid.'/'.$this->item->thumb;?>" alt="<?php echo $this->item->title;?>" /></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemIntroText')):?>
	<div><?php echo $this->item->introtext;?></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemCategory')):?>
	<div><?php echo $this->item->category;?></div>
<?php endif; ?>

<?php if ($this->item->params->get('genericItemReadMore')):?>
	<div><a href="<?php echo $this->item->link; ?>"><?php echo JText::_('Read more...'); ?></a></div>
<?php endif; ?>

