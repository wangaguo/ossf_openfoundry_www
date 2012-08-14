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
	function submitbutton(task)
	{
			submitform( task );
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

	<table cellspacing="0" cellpadding="0" border="0" width="22%" class="adminform">
		<tr>
			<td><label for="title"><?php echo JText::_( 'VIP CODE' ).':'; ?></label></td>
			<td><?php echo $this->row->vip_code;/*echo $this->row->aa[0];*/?></td>
		</tr>
		<tr>
			<td><label for="use_code"><?php echo JText::_( 'Who Use?' ).':'; ?></label></td>
			<td><?php echo $this->row->use_code; ?></td>
		</tr>
		<tr>
			<td>
				<label for="code_state"><?php echo JText::_( 'STATUS' ).':'; ?></label>
			</td>
			<td>
				<?php
				if($this->row->code_state == 'y'){
					$code_state = 1;
				}else{
					$code_state = 0;
				}
				$html = JHTML::_('select.booleanlist', 'code_state', '', $code_state );
				echo $html;
				?>
			</td>
		</tr>
				
		<tr>
			<td>
				<label for="vip_name"><?php echo JText::_( 'USER NAME' ).':'; ?></label>
			</td>
			<td>
				<input class="inputbox" type="text" name="vip_name" id="vip_name" size="50" maxlength="100" value="<?php echo $this->row->vip_name; ?>" />
			</td>
		</tr>

		<tr>
			<td>
				<label for="vip_mail"><?php echo JText::_( 'E MAIL' ).':'; ?></label>
			</td>
		<td>
			<input class="inputbox" type="text" name="vip_mail" id="vip_mail" size="50" maxlength="100" value="<?php echo $this->row->vip_mail; ?>" />
		</td>

		<tr>
			<td>
				<label for="note">
					<?php echo JText::_( 'NOTE' ).':'; ?>
				</label>
			</td>
			<td>
				<textarea class="inputbox" name="note" id="note" rows="5" cols="37" maxlength="200"><?php echo $this->row->note; ?></textarea>
			</td>
		</tr>


</table>
<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="vip_code" value="<?php echo $this->row->vip_code; ?>" />
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="vip" />
<input type="hidden" name="view" value="editvip" />
<input type="hidden" name="task" value="save" />

</form>


<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
