<?php
/*
// "K2 Items" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
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

<div class="k2ItemsListContainer <?php echo $params->get('moduleclass_sfx'); ?>">
  <ul class="k2ItemsList">
    <?php if (count($items)): ?>
    <?php foreach ($items as $item):	?>
    <li>
      	<!-- Plugins: BeforeDisplay -->
		<?php echo $item->event->BeforeDisplay; ?>
	
		<!-- K2 Plugins: K2BeforeDisplay -->
		<?php echo $item->event->K2BeforeDisplay; ?>
		
      <?php if ($params->get('itemTitle')):?>
      <a class="k2ItemsTitle" href="<?php echo $item->link;?>"><?php echo $item->title; ?></a>
      <?php endif; ?>
	  
		<!-- Plugins: AfterDisplayTitle -->
		<?php echo $item->event->AfterDisplayTitle; ?>
		
		<!-- K2 Plugins: K2AfterDisplayTitle -->
		<?php echo $item->event->K2AfterDisplayTitle; ?>
	  
	  
      <?php if ($params->get('itemAuthor')):?>
      <span class="k2ItemsAuthor"><a href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a></span>
      <?php if ($params->get('itemAuthorAvatar')):?>
      <span class="k2ItemsAuthorAvatar"><img src="<?php echo $item->authorAvatar;?>" alt="<?php echo $item->author; ?>" /></span>
      <?php endif; ?>
      <?php endif; ?>
      <?php if($params->get('itemDateCreated')): ?>
      <span class="k2ItemsDate"><?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC2')); ?></span>
      <?php endif; ?>
      <?php if($params->get('itemCategory')): ?>
      <span class="k2ItemsCategory"><a href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a></span>
      <?php endif; ?>
      <?php if ($params->get('itemImage') && isset($item->image)):?>
      <a class="k2ItemsThumb" href="<?php echo $item->link; ?>"><img src="<?php echo $item->image;?>" alt="<?php echo $item->title; ?>"/></a>
      <?php endif;?>
	  
	  <!-- Plugins: BeforeDisplayContent -->
	  <?php echo $item->event->BeforeDisplayContent; ?>
	  
	  <!-- K2 Plugins: K2BeforeDisplayContent -->
	  <?php echo $item->event->K2BeforeDisplayContent; ?>
	  
	  
      <?php if ($params->get('itemIntroText')):?>
      <p class="k2ItemsIntrotext"><?php echo $item->introtext; ?></p>
      <?php endif; ?>

	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $item->event->AfterDisplayContent; ?>
	  
	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $item->event->K2AfterDisplayContent; ?>

      <?php if ($params->get('itemTags')):?>
      <p class="k2ItemsTags"> <?php echo JText::_('Tags:'); ?>
        <?php foreach ($item->tags as $tag): ?>
        <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
        <?php endforeach; ?>
      </p>
      <?php endif;?>
	  <?php if ($params->get('itemExtraFields') && count($item->extra_fields)): ?>
	  <div class="itemExtraFields">
	  	<p><?php echo JText::_('Additional Info'); ?></p>
			<?php foreach ($item->extra_fields as $extraField):?>
				<div><span><?php echo $extraField->name;?>:</span> <?php echo $extraField->value;?></div>
			<?php endforeach; ?>
	    <div class="clr"></div>
	  </div>
	  <?php endif; ?>
      <?php if ($params->get('itemCommentsCounter') && $item->numOfComments>0):?>
      <p class="k2ItemsCommentsCounter"><a href="<?php echo $item->link.'#itemCommentsAnchor';?>"><?php echo JText::_('Comments:') ?><?php echo $item->numOfComments; ?></a></p>
      <?php endif; ?>
      <?php if ($params->get('itemReadMore')):?>
      <span class="k2ItemsReadMore"><a href="<?php echo $item->link;?>"><?php echo JText::_('Read more...');?></a></span>
      <?php endif; ?>
	  
	  <!-- Plugins: AfterDisplay -->
	  <?php echo $item->event->AfterDisplay; ?>
	  
	  <!-- K2 Plugins: K2AfterDisplay -->
	  <?php echo $item->event->K2AfterDisplay; ?>
	  
    </li>
    <?php endforeach; ?>
    <?php endif;?>
    <li class="clr"></li>
  </ul>
</div>

