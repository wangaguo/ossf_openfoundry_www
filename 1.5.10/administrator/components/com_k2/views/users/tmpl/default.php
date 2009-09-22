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
  <table width="100%">
    <tr>
      <td align="left" width="50%"><?php echo JText::_('Filter:'); ?>
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_('Filter by name'); ?>"/>
        <button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.getElementById('filter_group').value='0';this.form.getElementById('filter_group_k2').value='0';this.form.submit();"><?php echo JText::_('Reset'); ?></button></td>
      <td align="right" width="50%"><?php echo $this->lists['filter_group_k2']; ?>&nbsp;<?php echo $this->lists['filter_group']; ?>&nbsp;<?php echo $this->lists['status']; ?></td>
    </tr>
  </table>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20"> # </th>
        <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>
        <th class="title"> <?php echo JHTML::_('grid.sort',   JText::_('Name'), 'juser.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th class="title"> <?php echo JHTML::_('grid.sort',   JText::_('User Name'), 'juser.username', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="5%" nowrap="nowrap"> <?php echo JText::_('Logged in'); ?> </th>
        <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', JText::_('Enabled'), 'juser.block', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th class="title"> <?php echo JHTML::_('grid.sort',   JText::_('Group'), 'juser.usertype', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th class="title"> <?php echo JHTML::_('grid.sort',   JText::_('K2 Group'), 'groupname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th><?php echo JHTML::_('grid.sort',   JText::_('E-mail'), 'juser.email', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th><?php echo JHTML::_('grid.sort',   JText::_('Last Visit'), 'juser.lastvisitDate', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', JText::_('ID'), 'juser.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="11"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
    <tbody>
      <?php
      $k = 0; $i = 0;
      
			foreach ($this->rows as $row) :
				$row->checked_out=0;
				$checked 	= JHTML::_('grid.id', $i, $row->profileID );		
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td width="20" align="center"><?php echo $i+1; ?></td>
        <td width="20" align="center"><?php if ($row->profileID) echo $checked; ?></td>
        <td><a href="<?php echo $row->link; ?>"><?php echo $row->name;?></a></td>
        <td><?php echo $row->username;?></td>
        <td align="center"><?php echo $row->loggedin ? '<img src="images/tick.png" width="16" height="16" border="0" alt="" />': ''; ?></td>
        <td align="center"><?php echo $row->block ? '<img src="images/publish_x.png" width="16" height="16" border="0" alt="" />': '<img src="images/tick.png" width="16" height="16" border="0" alt="" />'; ?></td>
        <td><?php echo $row->usertype;?></td>
        <td><?php echo $row->groupname;?></td>
        <td><?php echo $row->email;?></td>
        <td><?php echo $row->lvisit;?></td>
        <td align="center"><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <?php echo JHTML::_( 'form.token' );?>
</form>
