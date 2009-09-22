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
$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));
$document->addStyleSheet($filePath.'/css/style.css');

?>

<div class="k2CommentersListContainer <?php echo $params->get('moduleclass_sfx'); ?>">
	<ul class="k2CommentersList">
	<?php if(count($commenters)):?>
	<?php foreach ($commenters as $commenter): ?>
	<li>
	<?php if ($commenter->userImage):?>
	<img style="float:left; margin-right:5px; margin-bottom:5px;" src="<?php echo $commenter->userImage; ?>" alt="<?php echo $commenter->userName; ?>" width="<?php echo $componentParams->get('commenterImgWidth');?>" />
	<?php endif;?>
	<?php if ($params->get('commenterLink')): ?>
	<a href="<?php echo $commenter->link; ?>">
	<?php endif; ?>
	<?php echo $commenter->userName; ?>
	<?php if ($params->get('commentsCounter')):?>
	<span>(<?php echo $commenter->counter; ?>)</span>
	<?php endif; ?>
	<?php if ($params->get('commenterLink')): ?>
	</a>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
	<?php endif;?>
	</ul>
</div>
