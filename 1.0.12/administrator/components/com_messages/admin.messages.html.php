<?php
/**
* @version $Id: admin.messages.html.php 5981 2006-12-12 02:01:34Z friesengeist $
* @package Joomla
* @subpackage Messages
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
* @subpackage Messages
*/
class HTML_messages {
	function showMessages( &$rows, $pageNav, $search, $option ) {
	global $_LANG;
?>
<form action="index2.php" method="post" name="adminForm">

  <table class="adminheading">
	<tr>
	  <th class="inbox">
	  <?php echo $_LANG->_( 'Private Messaging' ); ?>
	  </th>
	  <td>
	  <?php echo $_LANG->_( 'Search' ); ?>:
	  </td>
	  <td>
	   <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
	  </td>
	</tr>
  </table>

  <table class="adminlist">
	<tr>
	  <th width="20">
	  <?php echo $_LANG->_( 'Num' ); ?>
	  </th>
	  <th width="5%" class="title">
	   <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
	  </th>
	  <th width="60%" class="title">
	  <?php echo $_LANG->_( 'Subject' ); ?>
	  </th>
	  <th width="15%" class="title">
	  <?php echo $_LANG->_( 'From' ); ?>
	  </th>
	  <th width="15%" class="title">
	  <?php echo $_LANG->_( 'Date' ); ?>
	  </th>
	  <th width="5%" class="title">
	  <?php echo $_LANG->_( 'Read' ); ?>
	  </th>
	</tr>
<?php
$k = 0;
for ($i=0, $n=count( $rows ); $i < $n; $i++) {
	$row =& $rows[$i];
?>
	<tr class="<?php echo "row$k"; ?>">
	  <td width="20">
	  <?php echo $i+1+$pageNav->limitstart;?>
	  </td>
	  <td width="5%">
	  <?php echo mosHTML::idBox( $i, $row->message_id ); ?>
	  </td>
	  <td width="60%">
	   <a href="#edit" onClick="hideMainMenu();return listItemTask('cb<?php echo $i;?>','view')">
		<?php echo $row->subject; ?> </a> 
		</td>
	  <td width="15%">
	  <?php echo $row->user_from; ?>
	  </td>
	  <td width="15%">
	  <?php echo $row->date_time; ?>
	  </td>
	  <td width="15%">
	  <?php
	  if (intval( $row->state ) == "1") {
	  	echo $_LANG->_( 'Read' );
	  } else {
	  	echo $_LANG->_( 'Unread' );
	  } 
	  ?>
	  </td>
	</tr>
	<?php $k = 1 - $k;
			} 
			?>
	</table>
	<?php echo $pageNav->getListFooter(); ?>

  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0" />
</form>
<?php 
}

function editConfig( &$vars, $option) {
global $_LANG;

	$tabs = new mosTabs(0);
?>
<form action="index2.php" method="post" name="adminForm">
<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == 'saveconfig') {
		if (confirm ("<?php echo $_LANG->_( 'Are you sure?' ); ?>")) {
			submitform( pressbutton );
		}
	} else {
		document.location.href = 'index2.php?option=<?php echo $option;?>';
	}
}
</script>

	<table class="adminheading">
		<tr>
			<th class="msgconfig">
				<?php echo $_LANG->_( 'Private Messaging Configuration' ); ?>
			</th>
		</tr>
		</table>

	<table class="adminform">
	  <tr>
			<td width="25%">
		<?php echo $_LANG->_( 'Lock Inbox' ); ?>:
		</td>
		<td>
		 <?php echo $vars['lock']; ?>
		  </td>
	  </tr>
	  <tr>
		<td>
		<?php echo $_LANG->_( 'Mail me on new Message' ); ?>:
		</td>
		<td>
		 <?php echo $vars['mail_on_new']; ?> 
		 </td>
	  </tr>
		<tr>
			<td>
				Auto Purge Messages:
			</td>
			<td> 
				<input type="text" name="vars[auto_purge]" size="5" value="<?php echo $vars['auto_purge']; ?>" class="inputbox" /> days old
			</td>
		</tr>
	</table>

<input type="hidden" name="option" value="<?php echo $option; ?>">
  <input type="hidden" name="task" value="">
</form>
<?php 
}

function viewMessage( &$row, $option ) {
global $_LANG;
?>
		<form action="index2.php" method="post" name="adminForm">

	<table class="adminheading">
		<tr>
			<th class="inbox">
			<?php echo $_LANG->_( 'View Private Message' ); ?>
			</th>
		</tr>
	</table>

	<table class="adminform">
		<tr>
			<td width="100">
			<?php echo $_LANG->_( 'From' ); ?>:
			</td>
			<td width="85%" bgcolor="#ffffff">
			<?php echo $row->user_from;?>
				</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Posted' ); ?>:
			</td>
			<td bgcolor="#ffffff">
			<?php echo $row->date_time;?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Subject' ); ?>:
			</td>
			<td bgcolor="#ffffff">
			<?php echo $row->subject;?>
			</td>
		</tr>
		<tr>
			<td valign="top">
			<?php echo $_LANG->_( 'Message' ); ?>:
			</td>
			<td width="100%" bgcolor="#ffffff">
			<pre><?php echo htmlspecialchars( $row->message );?></pre>
			</td>
		</tr>
	</table>

	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="1" />
	<input type="hidden" name="cid[]" value="<?php echo $row->message_id; ?>" />
	<input type="hidden" name="userid" value="<?php echo $row->user_id_from; ?>" />
	<input type="hidden" name="subject" value="<?php echo ( substr( $row->subject, 0, 4 ) != 'Re: ' ? 'Re: ' : '' ) . htmlspecialchars( $row->subject, ENT_QUOTES ); ?>" />
	<input type="hidden" name="hidemainmenu" value="0" />
	</form>
<?php 
}

function newMessage($option, $recipientslist, $subject ) {
	global $my;
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
		if (form.subject.value == "") {
				alert( "<?php echo $_LANG->_( 'You must provide a subject.' ); ?>" );
			} else if (form.message.value == "") {
				alert( "<?php echo $_LANG->_( 'You must provide a message.' ); ?>" );
			} else if (getSelectedValue('adminForm','user_id_to') < 1) {
				alert( "<?php echo $_LANG->_( 'You must select a recipient.' ); ?>" );
			} else {
				submitform( pressbutton );
		}
	}
	</script>

	<table class="adminheading">
		<tr>
			<th class="inbox">
			<?php echo $_LANG->_( 'New Private Message' ); ?>
			</th>
		</tr>
	</table>

	<form action="index2.php" method="post" name="adminForm">
	<table class="adminform">
		<tr>
			<td width="100">
			<?php echo $_LANG->_( 'To' ); ?>:
			</td>
			<td width="85%">
			<?php echo $recipientslist; ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Subject' ); ?>:
			</td>
			<td>
				<input type="text" name="subject" size="50" maxlength="100" class="inputbox" value="<?php echo htmlspecialchars( $subject, ENT_QUOTES ); ?>"/>
			</td>
		</tr>
		<tr>
			<td valign="top">
			<?php echo $_LANG->_( 'Message' ); ?>:
			</td>
			<td width="100%">
				<textarea name="message" style="width:100%" rows="30" class="inputbox"></textarea>
			</td>
		</tr>
	</table>

	<input type="hidden" name="user_id_from" value="<?php echo $my->id; ?>">
	<input type="hidden" name="option" value="<?php echo $option; ?>">
	<input type="hidden" name="task" value="">
	</form>
<?php 
}
}
?>