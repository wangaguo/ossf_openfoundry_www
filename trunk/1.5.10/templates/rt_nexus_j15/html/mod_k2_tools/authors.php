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
//$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));
//$document->addStyleSheet($filePath.'/css/style.css');

?>

<div class="k2AuthorsListContainer <?php echo $params->get('moduleclass_sfx'); ?>">
  <div class="k2AuthorsList">
    <?php $i=1; foreach ($authors as $author): ?>
    <div<?php if($i==count($authors)) echo ' class="lastAuthor"'; ?>>
      <?php if ($params->get('authorAvatar')):?>
      <img src="<?php echo JURI::root().'media/k2/users/'.$author->profile->image;?>" alt="<?php echo $author->name; ?>" style="float:left"/>
      <?php endif; ?>
      <a href="<?php echo $author->link; ?>"> <?php echo $author->name; ?>
      <?php if ($params->get('authorItemsCounter')):?>
      <span>(<?php echo $author->items; ?>)</span>
      <?php endif; ?>
      </a>
      <div>
      	<a href="<?php echo $author->latest->link;?>" title="<?php echo $author->latest->title; ?>">
      		<?php echo $author->latest->title; ?>
      	</a>
      	<!--(<a href="<?php echo $author->latest->link;?>#itemCommentsAnchor"><?php echo JText::_('add comment');?></a>)-->
      </div>
      <div><?php echo $author->latest->numOfComments;?> <?php echo JText::_('comments');?></div>
      <div class="clr"></div>
    </div>
    <?php $i++; endforeach; ?>
  </div>
</div>
