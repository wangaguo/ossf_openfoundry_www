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

<script language="javascript" type="text/javascript">
	function submitbutton(task){
			submitform( task );
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

	<table cellspacing="0" cellpadding="0" border="0" width="22%" class="adminform">
		<tr>


				<tr>
					<td><label for="title"><?php echo JText::_( 'USER NAME' ).':'; ?></label></td>
					<td><input class="inputbox" rows="3"  name="u_name" id="u_name" size="50" maxlength="100" value="<?php echo $this->row->u_name;?>" />
					<?php //echo $this->row->u_name;?>
				</td>
				<td></td>
				<td></td>
		</tr>
			<td><label for="email"><?php echo JText::_( 'EMAIL' ).':'; ?></label></td>
			<td><?php echo $this->row->u_email;?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><label for="title"><?php echo JText::_( 'SN' ).':'; ?></label></td>
			<td><?php echo $this->row->reg_sn;?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><label for="JOIN"><?php echo JText::_( 'JOIN' ).':'; ?></label></td>
			<td>
				<?php
				if($this->row->ch_join == 'y'){
					$join_state = 1;
				}else{
					$join_state = 0;
				}
				$html = JHTML::_('select.booleanlist', 'join_state', '', $join_state );
				echo $html;
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="black"><?php echo JText::_( 'BLACK' ).':'; ?></label>
			</td>
			<td>
				<?php
					if($this->row->black == 'y'){
						$black_state = 1;
					}else{
						$black_state = 0;
					}
					$black_html = JHTML::_('select.booleanlist', 'black_state', '', $black_state );
					echo $black_html;
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="u_company"><?php echo JText::_( 'COMPANY NAME' ).':'; ?></label>
			</td>
			<td>
				<?php 
				/*if($this->row->u_company==NULL){
						echo "N/A";
				}else{
					echo $this->row->u_company; 
				}*/
				?>
				<input class="inputbox" rows="3"  name="u_company" id="u_company" size="50" maxlength="100" value="<?php echo $this->row->u_company; ?>" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<label for="u_captaincy"><?php echo JText::_( 'DEPARTMENT/TITLE' ).':'; ?></label>
			</td>
			<td>
				<?php /*
					if(trim($this->row->u_captaincy) != '/'){
						echo $this->row->u_captaincy;
					}*/
				?>
				<input class="inputbox" type="text" name="u_captaincy" id="u_captaincy" size="50" maxlength="100" value="<?php echo $this->row->u_captaincy; ?>" />
			</td>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<label for="u_tel"><?php echo JText::_( 'TEL' ).':'; ?></label>
			</td>
			<td>
				<?php 
				/*	if($this->row->u_tel==NULL){
						echo "N/A";
					}else{
						echo $this->row->u_tel; 
					}*/
				?>
			<input class="inputbox" type="text" name="u_tel" id="u_tel" size="50" maxlength="100" value="<?php echo $this->row->u_tel; ?>" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<label for="community"><?php echo JText::_( 'GROUP' ).':'; ?></label>
			</td>
			<td>
				<?php 
					/*if($this->row->community==NULL){
						echo "N/A";
					}else{
						echo $this->row->community; 
					}*/
				?>
			<input class="inputbox" type="text" name="community" id="community" size="50" maxlength="100" value="<?php echo $this->row->community; ?>" />
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<label for="note"><?php echo JText::_( 'note' ).':'; ?></label>
			</td>
			<td><input class="inputbox" type="text" name="notes" id="alias" size="50" maxlength="100" value="<?php echo $this->row->notes; ?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
<?php

//echo array_keys($this->reg_eat);
//如果有活動有開放詢問餐點 就顯示詢問葷素 管理者可修改
if($this->eventinfo->reg_eat=='y'){
	$sections_eat = array();
	$sections_eat[] = JHTML::_('select.option', '0', JText::_('NO CHOICE'), 'id', 'title');
	$sections_eat[] = JHTML::_('select.option', '1', JText::_('MEAT AND FISH'), 'id', 'title');
	$sections_eat[] = JHTML::_('select.option', '2', JText::_('VEGETARIAN'), 'id', 'title');
	$sections_eat[] = JHTML::_('select.option', '3', JText::_('Take care of themselves'), 'id', 'title');
	$eat_select = JHTML::_('select.genericlist',  $sections_eat, 'u_eat', 'class="inputbox" size="1" ', 'id', 'title', $this->row->u_eat); 
?>
		<tr>
			<td><label for="note"><?php echo JText::_( 'EVENT EAT' ); ?></label></td>
			<td><?php echo $eat_select; ?></td>
		</tr>
		<tr>
<?php
}
//如果活動為審核制 顯示審核狀態 管理者不可修改
if($this->eventinfo->audit=='y'){
	if($this->row->reg_audit=='1'){ 
		$audit='approved';
	}else if($this->row->reg_audit=='2'){ 
		$audit='cancel';
	}else{
		$audit=JText::_( 'WAIT AUDIT' );
	}

	echo "<tr>".
			"<td><label for=\"audit\">".JText::_( 'EVENT AUDIT STATE' )."</label></td>".
			"<td>$audit</td>".
		"</tr>".
		"<tr>";
}
?>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>

	<table cellspacing="0" cellpadding="0" border="0" width="50%" class="info">
		<tr>
			<td><label for="join event"><?php echo JText::_( 'JOIN EVENT' ).':'; ?></label></td>
			<td><?php echo EventListModelRegusers::join_list($this->row->u_email);?></td>
		</tr>
	</table>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="reg_id" value="<?php echo $this->row->reg_id;?>" />
	<input type="hidden" name="reg_sn" value="<?php echo $this->row->reg_sn;?>" />
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="controller" value="reguser" />
	<input type="hidden" name="view" value="regusers" />
	<input type="hidden" name="task" value="save" />

</form>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
