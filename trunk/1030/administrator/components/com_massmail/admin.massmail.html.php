<?php
/**
* @version $Id: admin.massmail.html.php 85 2005-09-15 23:12:03Z eddieajau $
* @package Joomla
* @subpackage Massmail
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
* @package Joomla
* @subpackage Massmail
*/
class HTML_massmail {
	function messageForm( &$lists, $option ) {
	global $_LANG;
		?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				// do field validation
				if (form.mm_subject.value == ""){
					alert( "<?php echo $_LANG->_( 'Please fill in the subject' ) ;?>" );
				} else if (getSelectedValue('adminForm','mm_group') < 0){
					alert( "<?php echo $_LANG->_( 'Please select a group' ) ;?>" );
				} else if (form.mm_message.value == ""){
					alert( "<?php echo $_LANG->_( 'Please fillin the message' ) ;?>" );
				} else {
					submitform( pressbutton );
				}
			}
		</script>

		<form action="index2.php" name="adminForm" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail">
			<?php echo $_LANG->_( 'Mass Mail' ) ;?>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo $_LANG->_( 'Details' ) ;?>
			</th>
		</tr>
		<tr>
			<td width="150" valign="top">
			<?php echo $_LANG->_( 'Group' ) ;?>:
			</td>
			<td width="85%">
			<?php echo $lists['gid']; ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Mail to Child Groups' ) ;?>:
			</td>
			<td>
			<input type="checkbox" name="mm_recurse" value="RECURSE" />
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Send in HTML mode' ) ;?>:
			</td>
			<td>
			<input type="checkbox" name="mm_mode" value="1" />
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Subject' ) ;?>:
			</td>
			<td>
			<input class="inputbox" type="text" name="mm_subject" value="" size="50"/>
			</td>
		</tr>
		<tr>
			<td valign="top">
			<?php echo $_LANG->_( 'Message' ) ;?>:
			</td>
			<td>
			<textarea cols="80" rows="25" name="mm_message" class="inputbox"></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>"/>
		<input type="hidden" name="task" value=""/>
		</form>
		<?php
	}
}
?>