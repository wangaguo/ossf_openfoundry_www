<?php
/*
// "K2 Login" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
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

<div class="k2TaskbarContainer <?php echo $params->get('moduleclass_sfx'); ?>">
  <ul class="k2Taskbar">
    <li><?php echo JText::_('Welcome').' '.$user->name;?></li>
    <?php if (is_object($user->profile) && isset($user->profile->avatar)):?>
    <li><img src="<?php echo $user->profile->avatar;?>" alt="<?php echo $user->name;?>"/></li>
    <?php endif;?>
    <li><a href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id));?>"><?php echo JText::_('My items');?></a></li>
    <?php if (is_object($user->profile) &&  isset($user->profile->addLink)):?>
    <li><a class="modal" rel="{handler:'iframe',size:{x:1000,y:650}}" href="<?php echo $user->profile->addLink;?>"><?php echo JText::_('Add item');?></a></li>
    <?php endif ;?>
    <li><a href="<?php echo JRoute::_('index.php?option=com_user&view=user&task=edit');?>"><?php echo JText::_('My account');?></a></li>
  </ul>
  <form action="index.php" method="post">
    <div align="center">
      <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'Logout'); ?>" />
    </div>
    <input type="hidden" name="option" value="com_user" />
    <input type="hidden" name="task" value="logout" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
  </form>
</div>
