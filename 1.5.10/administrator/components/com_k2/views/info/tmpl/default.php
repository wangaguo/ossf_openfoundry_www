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
<form action="index.php" method="post" name="adminForm">
  <fieldset class="adminform">
    <legend><?php echo JText::_('System information');?></legend>
    <table class="adminlist">
      <thead>
        <tr>
          <th width="250"><?php echo JText::_('Check'); ?></th>
          <th><?php echo JText::_('Result');?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="2">&nbsp;</th>
        </tr>
      </tfoot>
      <tbody>
        <tr>
          <td valign="top"><strong><?php echo JText::_('PHP version');?></strong></td>
          <td><?php echo $this->php_version; ?></td>
        </tr>
        <tr>
          <td valign="top"><strong><?php echo JText::_('MySQL version');?></strong></td>
          <td><?php echo $this->db_version; ?></td>
        </tr>
        <tr>
          <td valign="top"><strong><?php echo JText::_('GD image library');?></strong></td>
          <td><?php if ($this->gd_check) {$gdinfo=gd_info(); echo $gdinfo["GD Version"];} else echo JText::_('Disabled'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong><?php echo JText::_('Upload limit');?></strong></td>
          <td><?php echo ini_get('upload_max_filesize'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong><?php echo JText::_('Simple Image Gallery Plugin');?></strong></td>
          <td><?php 
				if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_sigpro.php') || JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_sig.php') || JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jwsig.php'))
					echo JText::_('Installed');
				else 
					echo JText::_('Not found');
			?></td>
        </tr>
        <tr>
          <td valign="top"><strong><?php echo JText::_('AllVideos Plugin');?></strong></td>
          <td><?php 
				if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos.php'))
					echo JText::_('Installed');
				else 
					echo JText::_('Not found');
			?></td>
        </tr>
      </tbody>
    </table>
  </fieldset>
  <fieldset class="adminform">
    <legend><?php echo JText::_('Directory permissions');?></legend>
    <table class="adminlist">
      <thead>
        <tr>
          <th width="250"><?php echo JText::_('Check'); ?></th>
          <th><?php echo JText::_('Result');?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="2">&nbsp;</th>
        </tr>
      </tfoot>
      <tbody>
        <tr>
          <td valign="top"><strong>media/k2</strong></td>
          <td><?php if ($this->media_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>media/k2/attachments</strong></td>
          <td><?php if ($this->attachments_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>media/k2/categories</strong></td>
          <td><?php if ($this->categories_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>media/k2/galleries</strong></td>
          <td><?php if ($this->galleries_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>media/k2/items</strong></td>
          <td><?php if ($this->items_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>media/k2/users</strong></td>
          <td><?php if ($this->users_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>media/k2/videos</strong></td>
          <td><?php if ($this->videos_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
        <tr>
          <td valign="top"><strong>cache</strong></td>
          <td><?php if ($this->cache_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
        </tr>
      </tbody>
    </table>
  </fieldset>
</form>
