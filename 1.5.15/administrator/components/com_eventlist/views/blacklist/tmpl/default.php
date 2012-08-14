<?php
/**
 * @version 1.0 $Id: default.php 958 2009-02-02 17:23:05Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">

	function submitbutton(task)
	{
		var obj=document.getElementsByName("cid[]");
		var len = obj.length;
		var checked = false;
		var form = document.adminForm;
		
        for (i = 0; i < len; i++)
        {
            if (obj[i].checked == true)
            {
                checked = true;
                break;
            }
        } 

        if(task =='remove'){	
        	if(checked==false)
			{
				alert("<?php echo JText::_( 'PLEASE SELECT THE OBJECT' ); ?>");
			} else {
				submitform( task );
			}	
		}
		

}
		function checkAll(obj){
				
			var checkboxs = document.getElementsByName("cid[]"); 
			for(var i=0;i<checkboxs.length;i++)
			{
				checkboxs[i].checked = obj.checked;
			} 

		}
</script> 
<form action="index.php" method="post" name="adminForm">

	<table class="adminlist" cellspacing="1">
		<thead>
			<tr>
				<th width="5"><?php echo JText::_( 'Num' ); ?></th>
				<th width="40"><input type="checkbox" name="toggle" value="" onClick="checkAll(this);" /></th>
				<th><?php echo JText::_( 'USER NAME' ); ?></th>
				<th><?php echo JText::_( 'EMAIL' ); ?></th>
				<th><?php echo JText::_( 'KEEPING AN APPOINTMENT' ); ?></th>
				<th><?php echo JText::_( 'Black Note' ); ?></th>
				<th><?php echo JText::_( 'Black Date' ); ?></th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<td colspan="12">
					<?php //echo $this->pageNav->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>

		<tbody>
			<?php
			$k = 0;
			for($i=0, $n=count( $this->rows ); $i < $n; $i++) {
				$row = &$this->rows[$i];

				//$checked = JHTML::_('grid.checkedout', $row,$i);
   			?>
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $this->pageNav->getRowOffset( $i ); ?></td>
				<td align=center><input type="checkbox" id="cb0" name="cid[]" value="<?php echo $row->reg_id."&".$row->reg_sn."&".$row->u_email; ?>" onclick="isChecked(this.checked);"></td>
				<td><?php echo $row->u_name;?></td>
				<td><?php echo $row->u_email;?></td>
				<td>
				<?php 
				//yen edit start 未到次數
					$db = JFactory::getDBO();
					$black_data = "SELECT reg_id, reg_sn, u_date ".
								"FROM #__eventlist_reg_user ".
								"WHERE u_email = '".$row->u_email.
								"' AND black = 'y' ";
					$db->setQuery($black_data);
					$black_q = $db->loadObject();
					echo $db->getAffectedRows(); 
				?>
				</td>
				<td>
				<?php 
				//顯示未到的活動
					$db2 = JFactory::getDBO();
					$black_data2 = "SELECT a.title, b.reg_id ".
								"FROM #__eventlist_events as a, ".
								"#__eventlist_reg_user as b ".
								"WHERE a.id = b.reg_id ".
								"AND b.u_email = '".$row->u_email."' ".
								"AND b.black = 'y'";
								
					$db2->setQuery($black_data2);
					$black_q2 = $db2->loadObjectList();
		
					foreach($black_q2 as $item){
						echo $item->title."<br>";
					}
				?>
				</td>
				<td><?php echo $black_q->u_date;?></td>
			</tr>
			<?php $k = 1 - $k;  } ?>

		</tbody>
	</table>

	<input type="hidden" name="boxchecked" value="1" />
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="view" value="blacklist" />
	<input type="hidden" name="controller" value="blacklist" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />
</form>
