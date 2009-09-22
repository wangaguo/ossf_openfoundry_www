<?php
/*
// "K2 Tools" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

// CSS
$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));
$document->addStyleSheet($filePath.'/css/style.css');

?>

<div class="k2TagCloud <?php echo $params->get('moduleclass_sfx'); ?>">
  <?php if (count($tags)):?>
  <?php foreach ($tags as $tag): ?>
  <?php if(!empty($tag->tag)): ?>
  <a href="<?php echo $tag->link; ?>" style="font-size:<?php echo $tag->size; ?>%" title="<?php echo $tag->count.' '.JText::_('items tagged'); ?>"> <?php echo $tag->tag; ?> </a>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>
  <div class="clr"></div>
</div>
