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
<?php $ordering = ($this->lists['order'] == 'c.ordering' || $this->lists['order'] == 'c.parent, c.ordering');?>
<form action="index.php" method="post" name="adminForm">
  <table width="100%">
    <tr>
      <td align="left" width="50%"><?php echo JText::_('Filter:'); ?>
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_('Filter by title'); ?>"/>
        <button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.submit();"><?php echo JText::_('Reset'); ?></button></td>
      <td align="right" width="50%"><?php echo "{$this->lists['trash']}&nbsp;{$this->lists['state']}"; ?></td>
    </tr>
  </table>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20"> # </th>
        <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>
        <th class="title"> <?php echo JHTML::_('grid.sort',   JText::_('Name'), 'c.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="8%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', JText::_('Order'), 'c.ordering', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> <?php echo JHTML::_('grid.order',  $this->rows ,'filesave.png' ); ?> </th>
        <th class="title" width="150"> <?php echo JHTML::_('grid.sort', JText::_('Extra fields category'), 'extra_fields_group', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="10%"> <?php echo JHTML::_('grid.sort', JText::_('Access Level'), 'c.access', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', JText::_('Published'), 'c.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', JText::_('ID'), 'c.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="8"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
    <tbody>
	<?php $k = 0; $i = 0;	$n = count( $this->rows );
	
	foreach ($this->rows as $row) :
		$row->checked_out=0;
		$checked 	= JHTML::_('grid.checkedout', $row, $i );
		$published = JHTML::_('grid.published', $row, $i );
		$access = JHTML::_('grid.access', $row, $i );
		$link = JRoute::_('index.php?option=com_k2&view=category&cid='.$row->id);
		?>
	      <tr class="<?php echo "row$k"; ?>">
		  	<td><?php echo $i+1; ?></td>
	        <td><?php echo $checked; ?></td>
	        <td nowrap="nowrap"><a href="<?php echo $link; ?>"><?php echo $row->treename;?> (<?php echo $row->numOfItems;?>)</a> </td>
			
			<td class="order" nowrap="nowrap">
				<span><?php echo $this->page->orderUpIcon( $i, $row->parent == 0 || $row->parent == @$this->rows[$i-1]->parent, 'orderup', 'Move Up', $ordering); ?></span>
				<span><?php echo $this->page->orderDownIcon( $i, $n, $row->parent == 0 || $row->parent == @$this->rows[$i+1]->parent, 'orderdown', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
			</td>

			<td><?php echo $row->extra_fields_group; ?></td>
	        <td align="center"><?php echo $access;?></td>
			<td align="center"><?php echo $published;?></td>
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
