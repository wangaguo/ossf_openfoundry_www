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
function submitbutton(pressbutton) {
	if (pressbutton == 'import') {
		var answer = confirm('<?php echo JText::_('WARNING: You are about to import all articles from com_content! If you have executed this operation before you might produce duplicate content!', true);?>')
		if (answer){
			submitform( pressbutton );
		} else {
			return;
		}
	}
	if (trim( document.adminForm.name.value ) == "") {
		alert( '<?php echo JText::_('Category must have a Name', true);?>' );
	} else {
		submitform( pressbutton );
	}
}
</script>

<?php $ordering = ($this->lists['order'] == 'i.ordering' || $this->lists['order'] == 'category');?>

<form action="index.php" method="post" name="adminForm">
  <table width="100%">
    <tr>
      <td align="left" width="50%"><?php echo JText::_('Filter:'); ?>
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_('Filter by title'); ?>"/>
        <button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_category').value='0';this.form.getElementById('filter_trash').value='0';this.form.getElementById('filter_author').value='0';this.form.getElementById('filter_state').value='-1';this.form.getElementById('filter_featured').value='-1';this.form.submit();"><?php echo JText::_('Reset'); ?></button></td>
      <td align="right" width="50%"><?php echo "{$this->lists['trash']}&nbsp;{$this->lists['featured']}&nbsp;&nbsp; | &nbsp;&nbsp;{$this->lists['categories']}&nbsp;{$this->lists['authors']}&nbsp;{$this->lists['state']}"; ?></td>
    </tr>
  </table>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5">#</th>
        <th width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>
        <th class="title"><?php echo JHTML::_('grid.sort', JText::_('Title'), 'i.title', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th width="1%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', JText::_('Featured'), 'i.featured', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th width="1%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', JText::_('Published'), 'i.published', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th width="8%"><?php echo JHTML::_('grid.sort', JText::_('Order'), 'i.ordering', @$this->lists['order_Dir'], @$this->lists['order']); ?>
          <?php if ($ordering) echo JHTML::_('grid.order',  $this->rows ); ?></th>
        <th class="title" width="8%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', JText::_('Category'), 'category', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th class="title" width="8%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', JText::_('Author'), 'author', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th class="title" width="8%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', JText::_('Last modified by'), 'moderator', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th width="7%"><?php echo JHTML::_('grid.sort', JText::_('Access Level'), 'i.access', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th align="center" width="10"><?php echo JHTML::_('grid.sort', JText::_('Created'), 'i.created', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th align="center" width="10"><?php echo JHTML::_('grid.sort', JText::_('Modified'), 'i.modified', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
        <th align="center" width="10"><?php echo JHTML::_('grid.sort', JText::_('hits'), 'i.hits', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th width="1%" class="title"><?php echo JHTML::_('grid.sort', JText::_('ID'), 'i.id', @$this->lists['order_Dir'], @$this->lists['order']); ?> </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="14"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
    <tbody>
      <?php
      $k = 0; $i = 0;	$n = count( $this->rows );
			$user=& JFactory::getUser();
			foreach ($this->rows as $row) :
				$checked 	= JHTML::_('grid.checkedout', $row, $i );
				$published = JHTML::_('grid.published', $row, $i );
				$access = JHTML::_('grid.access', $row, $i );
				$link = JRoute::_('index.php?option=com_k2&view=item&cid='.$row->id);
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td><?php echo $i+1; ?></td>
        <td align="center"><?php echo $checked; ?></td>
        <td><?php if (JTable::isCheckedOut($user->get('id'), $row->checked_out )):?>
          <?php echo $row->title;?>
          <?php else: ?>
          <a href="<?php echo $link; ?>"><?php echo $row->title;?></a>
          <?php endif;?></td>
        <td align="center"><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','featured')" title="<?php echo ( $row->featured ) ? JText::_( 'Unmark featured' ) : JText::_( 'Mark as featured' );?>"> <img src="images/<?php echo ( $row->featured ) ? 'tick.png' :  'publish_x.png' ;?>" width="16" height="16" border="0" alt="<?php echo ( $row->featured ) ? JText::_( 'Unmark featured' ) : JText::_( 'Mark as featured' );?>" /> </a></td>
        <td align="center"><?php echo $published;?></td>
        <td class="order"><span><?php echo $this->page->orderUpIcon($i, ($row->catid == @$this->rows[$i-1]->catid), 'orderup', 'Move Up', $ordering); ?></span> <span><?php echo $this->page->orderDownIcon($i, $n, ($row->catid == @$this->rows[$i+1]->catid), 'orderdown', 'Move Down', $ordering); ?></span>
          <?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
          <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?>	class="text_area" style="text-align: center" /></td>
        <td><a href="<?php echo JRoute::_('index.php?option=com_k2&view=category&cid='.$row->catid);?>"><?php echo $row->category; ?></a></td>
        <td><a href="<?php echo JRoute::_('index.php?option=com_users&task=edit&cid[]='.$row->created_by);?>"><?php echo $row->author; ?></a></td>
        <td><a href="<?php echo JRoute::_('index.php?option=com_users&task=edit&cid[]='.$row->modified_by);?>"><?php echo $row->moderator; ?></a></td>
        <td align="center"><?php echo $access;?></td>
        <td nowrap="nowrap"><?php echo $row->created; ?></td>
        <td nowrap="nowrap"><?php echo $row->modified; ?></td>
        <td nowrap="nowrap" align="center"><?php echo $row->hits ?></td>
        <td align="center"><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <?php	echo JHTML::_('form.token'); ?>
</form>
