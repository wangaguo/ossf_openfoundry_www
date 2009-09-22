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
<script type="text/javascript">
	window.addEvent('domready', function(){
		$$('#toolbar-Link a').addEvent('click', function(e){
			var answer = confirm('<?php echo JText::_('WARNING: You are about to import all articles from com_content! If you have executed this operation before you might produce duplicate content!', true); ?>')
			if (!answer){
				new Event(e).stop();
			}
		})
	});
</script>

<div id="cpanel" style="float:left;width:54%;">
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=items&amp;filter_view=1"><img alt="<?php echo JText::_('Items'); ?>" src="components/com_k2/images/items.png"/><span><?php echo JText::_('Items'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=items&amp;filter_featured=1"><img alt="<?php echo JText::_('Featured Items'); ?>" src="components/com_k2/images/itemsFeatured.png"/><span><?php echo JText::_('Featured Items'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=items&amp;filter_view=0"><img alt="<?php echo JText::_('Trashed Items'); ?>" src="components/com_k2/images/itemsTrashed.png"/><span><?php echo JText::_('Trashed Items'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=categories&amp;filter_trash=0"><img alt="<?php echo JText::_('Categories'); ?>" src="components/com_k2/images/categories.png"/><span><?php echo JText::_('Categories'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=categories&amp;filter_trash=1"><img alt="<?php echo JText::_('Trashed Categories'); ?>" src="components/com_k2/images/categoriesTrashed.png"/><span><?php echo JText::_('Trashed Categories'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=tags"><img alt="<?php echo JText::_('Tags'); ?>" src="components/com_k2/images/tags.png"/><span><?php echo JText::_('Tags'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=comments"><img alt="<?php echo JText::_('Comments'); ?>" src="components/com_k2/images/comments.png"/><span><?php echo JText::_('Comments'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=users"><img alt="<?php echo JText::_('Users'); ?>" src="components/com_k2/images/users.png"/><span><?php echo JText::_('Users'); ?></span></a></div>
  </div>
  <?php $user= &JFactory::getUser(); if ($user->gid>23) { ?>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=extraFields"><img alt="<?php echo JText::_('Extra Fields'); ?>" src="components/com_k2/images/extra_fields.png"/><span><?php echo JText::_('Extra Fields'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a href="index.php?option=com_k2&amp;view=extraFieldsGroups"><img alt="<?php echo JText::_('Extra Fields Groups'); ?>" src="components/com_k2/images/extra_fields_groups.png"/><span><?php echo JText::_('Extra Fields Groups'); ?></span></a></div>
  </div>
  <?php } ?>
  <div style="float: left;">
    <div class="icon"><a href="#" onclick="window.open('http://www.splashup.com/splashup/','splashupEditor','height=700,width=990,toolbar=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes'); return false;"><img alt="<?php echo JText::_('Edit Images (with SplashUp)'); ?>" src="components/com_k2/images/imageEditing.png"/><span><?php echo JText::_('Edit Images<br />(with SplashUp)'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a class="modal" rel="{handler: 'iframe', size: {x: 980, y: 700}}" href="http://k2.joomlaworks.gr/help/"><img alt="<?php echo JText::_('Documentation'); ?>" src="components/com_k2/images/documentation.png"/><span><?php echo JText::_('Documentation'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a target="_blank" href="http://forum.joomlaworks.gr/#8"><img alt="<?php echo JText::_('Support Forum'); ?>" src="components/com_k2/images/help.png"/><span><?php echo JText::_('Support Forum'); ?></span></a></div>
  </div>
  <div style="float: left;">
    <div class="icon"><a class="modal" rel="{handler: 'iframe', size: {x: 1040, y: 600}}" href="http://start.joomlaworks.gr"><img alt="<?php echo JText::_('Joomla!Sphere (news for Joomla!)'); ?>" src="components/com_k2/images/joomlasphere.gif"/><span><?php echo JText::_('Joomla!Sphere<br />(news for Joomla!)'); ?></span></a></div>
  </div>
  <div class="clr"></div>
</div>
<div id="stats" style="float:right;width:44%">
  <?php
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('Tabs');
		echo $pane->startPane('myPane');
		
		echo $pane->startPanel(JText::_('Info'), 'infotab');
		echo JText::_('K2_INFO');
		echo $pane->endPanel();
		?>
  <?php echo $pane->startPanel(JText::_('Latest items'), 'itemstab');?>
  <table class="adminlist" style="width:100%;">
    <thead>
      <tr>
        <td class="title"><?php echo JText::_('Title');?></td>
        <td class="title"><?php echo JText::_('Created');?></td>
        <td class="title"><?php echo JText::_('Created by');?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->latestItems as $latest):?>
      <tr>
        <td><?php echo $latest->title;?></td>
        <td><?php echo $latest->created;?></td>
        <td><?php echo $latest->author;?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $pane->endPanel();?> <?php echo $pane->startPanel(JText::_('Latest comments'), 'commentstab');?>
  <table class="adminlist" style="width:100%;">
    <thead>
      <tr>
        <td class="title"><?php echo JText::_('Comment');?></td>
        <td class="title"><?php echo JText::_('Submited by');?></td>
        <td class="title"><?php echo JText::_('Date');?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->latestComments as $latest):?>
      <tr>
        <td><?php echo $latest->commentText;?></td>
        <td><?php echo $latest->userName;?></td>
        <td><?php echo $latest->commentDate;?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $pane->endPanel();?> <?php echo $pane->startPanel(JText::_('Statistics'), 'statstab');?>
  <table class="adminlist" style="width:100%;">
    <thead>
      <tr>
        <td class="title"><?php echo JText::_('Data type');?></td>
        <td class="title"><?php echo JText::_('Number');?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo JText::_('Items');?></td>
        <td><?php echo $this->numOfItems;?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('Comments');?></td>
        <td><?php echo $this->numOfComments;?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('Categories');?></td>
        <td><?php echo $this->numOfCategories;?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('Users');?></td>
        <td><?php echo $this->numOfUsers;?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('Tags');?></td>
        <td><?php echo $this->numOfTags;?></td>
      </tr>
    </tbody>
  </table>
  <?php echo $pane->endPanel();?>
  <?php echo $pane->endPane();?>
  </div>
<div class="clr"></div>
