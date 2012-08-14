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
		var invite= document.adminForm.invite.value;
		var QUANTITY= document.adminForm.quantity.value;
		re = /^[0-9]*$/;   
		re1 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/; 
		  
        for (i = 0; i < len; i++){
            if (obj[i].checked == true){
                checked = true;
                break;
            }
        } 
    if(task =='add_user'){
			if(invite==0){
				alert("<?php echo JText::_( 'INSERT ONLY MAIL' ); ?>");
				form.invite.focus(); 
			}else if(!re1.test(invite)){
				alert("<?php echo JText::_( 'ERROR MAIL' ); ?>");
				form.invite.focus(); 
			}else{ 
				submitform( task );
			}
    }
    
    if(task =='pure_vipcode'){
			if(QUANTITY==0){
				alert("<?php echo JText::_( 'INSERT ONLY INT' ); ?>");
				form.QUANTITY.focus(); 
			}else if(!re.test(QUANTITY)){
 				alert("<? echo JText::_('INSERT ONLY INT');?>");
 				form.QUANTITY.focus(); 
			}else{
				submitform( 'pure_vipcode' );
			}
		}
		
		if(task =='produce_vipcode'){	
			if(invite==0){
				alert("<?php echo JText::_( 'INSERT ONLY MAIL' ); ?>");
				form.invite.focus(); 
			}else if(!re1.test(invite)){
				alert("<?php echo JText::_( 'ERROR MAIL' ); ?>");
				form.invite.focus(); 
			}else if(QUANTITY==0){
				alert("<?php echo JText::_( 'INSERT ONLY INT' ); ?>");
				form.QUANTITY.focus(); 
			}else if(!re.test(QUANTITY)){
 				alert("<? echo JText::_('INSERT ONLY INT');?>");
 				form.QUANTITY.focus(); 
			}else{ 
				submitform( task );
			}
		}

        if(task =='delete_vip'){	
        	if(checked==false){
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

<!--before-->
<form action="index.php" method="post" name="adminForm">

	<table class="adminform">
		<tr>
			<td width="100%">
				<?php
				$filter = $mainframe->getUserStateFromRequest( $option.'.vip.filter', 'filter', $mainframe->getCfg('filter'), 'int' );
				echo JText::_( 'EVENT NAME' );
				echo " : ";
				echo $this->lists['filter'];
				$reg_full = $mainframe->getUserStateFromRequest( $option.'.reg_full', 'reg_full', $mainframe->getCfg('reg_full'), 'int');
				$candidate = $mainframe->getUserStateFromRequest( $option.'.candidate', 'candidate', $mainframe->getCfg('candidate'), 'int');
				$reg_class = $mainframe->getUserStateFromRequest( $option.'.reg_class', 'reg_class', $mainframe->getCfg('reg_class'), 'int');
				?>
				<?php echo JText::_( 'INVITE NAME' );?>：<input class="inputbox" name="vip_name" value="" size="15" id="vipname" />
				<?php echo JText::_( 'E MAIL' );?>：<input class="inputbox" name="invite" value="" size="15" id="invite" />
				<?php echo JText::_( 'QUANTITY' );?>：<input class="inputbox" name="quantity" value="" size="15" id="quantity" />
				<?php //echo JText::_( 'SEND MAIL' );?><!--input type="checkbox" name="send_mail"/--!>
			</td>
		</tr>
	</table>

	<table class="adminlist" cellspacing="1">
		<thead>
			<tr>

				<th width="40"><input type="checkbox" name="toggle" value="" onClick="checkAll(this);" /></th>
				<th width="100"><?php echo JText::_( 'USER NAME' ); ?></th>
				<th width="300"><?php echo JText::_( 'E MAIL' ); ?></th>
				<th width="100" ><?php echo JText::_( 'VIP CODE' ); ?></th>
				<th width="30" width="300"><?php echo JText::_( 'STATUS' ); ?></th> 	
				<th><?php echo JText::_( 'Who Use?' ); ?></th>
				<th><?php echo JText::_( 'NOTE' ); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php
			$k = 0;
			for($i=0, $n=count( $this->rows ); $i < $n; $i++) {
				$row = &$this->rows[$i];
				$link = 'index.php?option=com_eventlist&amp;controller=vip&amp;task=edit&amp;cid[]='.$row->vip_code;
   			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align=center><input type="checkbox" id="cb0" name="cid[]" value="<?php echo $row->reg_id."&".$row->vip_code; ?>" onclick="isChecked(this.checked);"></td>
				<td ><?php echo $row->vip_name;?></td>
				<td><?php echo $row->vip_mail;/*受邀者信箱*/ ?></td>
				<td><?php echo "<a href=$link>$row->vip_code</a>"/*vip code*/ ?></td>
				<td><?php echo $row->code_state;/*code stat*/ ?></td>
				<td><?php echo $row->use_code;/*note*/ ?></td>
				<td><?php echo $row->note;/*note*/ ?></td>
			</tr>
			<?php $k = 1 - $k;  } ?>
		</tbody>
	</table>
	
	<input type="hidden" name="reg_full" value="<?php echo $reg_full; ?>" />
	<input type="hidden" name="candidate" value="<?php echo $candidate; ?>" />
	<input type="hidden" name="boxchecked" value="1" />
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="view" value="vip" />
	<input type="hidden" name="controller" value="vip" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />
</form>
