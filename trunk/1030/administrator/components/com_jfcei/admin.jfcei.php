<?
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_jfcei' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
$sortby = mosGetParam( $_REQUEST, 'sortby', 0 );

if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case "sendmemail":
		sendmemail( $option, $task );
		break;
	case "info":
		include "components/com_jfcei/upload.php";
		break;
	default:
		include_once( "components/com_jfcei/help.php" );
		break;
}
?>
        <script language="javascript" type="text/javascript">
        	<!--        	
        	function submitbutton(pressbutton) {
      			if( pressbutton == 'info' ) {				
					popupWindow('<?php echo $mosConfig_live_site; ?>/administrator/components/com_jfcei/upload.php','JFCEI',750,580,'no'); 
				}
				if( pressbutton == 'support' ) {				
					popupWindow('http://www.joomfish.net/'); 
				}}		
    			//-->
		</script>
<?php

function sendmemail(){

		 
if ($_POST["name"]) {

$msg =  "Name    :". $_POST["name"]."<br>";
$msg .= "Contact :". $_POST["contact"]."<br>";
$msg .= "Subject : ". $_POST["subject"]."<br>";
$msg .= "Message : ". nl2br($_POST["message"])."<br>";
$msg .= "Where : ".$mosConfig_live_site."<br>";
$sent=@mail('joomfish@unwe.net',$_POST["subject"],$msg);

 if ($sent)
          mosRedirect('index2.php?option=com_sef&mosmsg=The e-mail was sent.');
 else
          mosRedirect('index2.php?option=com_sef&mosmsg=The e-mail was not sent');
}
else {
?>
<FORM  action="index2.php" method="POST" name="mosForm">

<TABLE class="adminheading" width="70%" cellspacing=0 cellpadding=5>
<TR><Th class="massemail">Report a Bug</TH></TR>
</table>
   
<TABLE class="adminForm" width="70%" cellspacing=0 cellpadding=5>

   <TR>
      <Th colspan=2>Report a bug form</TH>
   </TR>
   <TR class="row0">
      <TD>Your Name:</TD>
      <TD>
      <INPUT TYPE="TEXT"  name="name" size="30">
      </TD>
   </TR>
   <TR  class="row1">
      <TD>Your e-mail:</TD>
      <TD>
      <INPUT TYPE="TEXT"  name="contact" size="30">
      </TD>
   </TR>
      <TR  class="row0">
      <TD>Subject:</TD>
      <TD>
      <INPUT TYPE="TEXT"  name="subject" size="40">
      </TD>
   </TR>

      <TR  class="row1">
      <TD  Valign=top>Please describe the bug:</TD>
      <TD>
   <TEXTAREA  name="message" rows="6" cols="50" align="top"></TEXTAREA>
      </TD>
   </TR>

   <TR  class="row0">
      <TD align=center colspan=2>
        <input type="hidden" name="option" value="com_sef" />
        <INPUT TYPE="SUBMIT"  value="Send" class=button align="center">
      </TD>
   </TR>


   </TABLE>


</FORM>
<?php } } ?>