<?php
/*
// "K2 Comments" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
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

<div class="k2CommentsListContainer <?php echo $params->get('moduleclass_sfx'); ?>">
	<ul class="k2CommentsList">
	<?php if(count($comments)):?>
	<?php foreach ($comments as $comment):	?>
	<li>
	<?php if ($comment->userImage):?>
	<img class="commenterAvatar" src="<?php echo $comment->userImage; ?>" alt="<?php echo $comment->userName; ?>" width="<?php echo $componentParams->get('commenterImgWidth');?>" />
	<?php endif;?>
	
	<?php if ($params->get('commenterName')):?>
	<span class="commenterName"><?php echo $comment->userName; ?></span>
	<?php endif;?>
	
	<?php if ($params->get('commentText')):?>
	<?php if ($params->get('commentLink')):?>
	<a href="<?php echo $comment->link; ?>">
	<?php endif;?>
	
	<?php echo $comment->commentText; ?>
	
	<?php if ($params->get('commentLink')):?>
	</a>
	<?php endif;?>
	
	<?php endif;?>
	
	<?php if ($params->get('commentDate')):?>
	<span class="commentDate"><?php echo JText::_('written on'); ?> <?php echo JHTML::_('date', $comment->commentDate, JText::_('DATE_FORMAT_LC2')); ?></span>
	<?php endif; ?>
	
	<?php if ($params->get('itemTitle')):?>
	<span class="commentItemTitle"><?php echo $comment->title; ?></span>
	<?php endif; ?>
	
	<?php if ($params->get('itemCategory')):?>
	<span class="commentItemCategory"><?php echo $comment->categoryname; ?></span>
	<?php endif; ?>
	
	</li>
	<?php endforeach;?>
	<?php endif;	?>

	</ul>
</div>
