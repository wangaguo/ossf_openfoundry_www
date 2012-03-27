<?php
/**
* Letterman Subscriber Module 
* based on the one for Yanc 1.3
*
* @author soeren
* @author Wee Keat Chin
* @Copyright (C) 2004-2005 soeren
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version 1.1
*
* Email: soeren@virtuemart.net
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if( !file_exists($mosConfig_absolute_path . "/components/com_letterman/letterman.php")) {
	echo '<p>This module requires the Letterman component.</p>';
}
else {
	
	if( !@include_once( $mosConfig_absolute_path . "/administrator/components/com_letterman/language/$mosConfig_lang.messages.php" ) ) {
		include_once( $mosConfig_absolute_path . "/administrator/components/com_letterman/language/english.messages.php" );
	}

?>
<SCRIPT TYPE="text/javascript">
<!--

function dropdown(mySel,myEm)
{
var myWin, myVal, myUrl, myLin, myPw;
myUrl = "http://forge.iis.sinica.edu.tw/mailman/"
myVal = document.newsletter.kind.value;
//myVal = mySel.options[mySel.selectedIndex].value;
myEm  =	document.newsletter.email.value;
		
if(document.newsletter.subscribe[0].checked)
	{
		myLin = "subscribe/";
	}else {
		myLin = "options/";
	}
if(myVal)
   {
   if(mySel.form.target)myWin = parent[mySel.form.target];
   else myWin = window;
   if (! myWin) return true;
   myVal = myUrl + myLin + myVal + "?email="+ myEm ;  	
	 myWin.location = myVal;
   }
return false;
}
//-->
</SCRIPT>

<FORM Name=newsletter
     ACTION="" 
     METHOD=POST onSubmit="return dropdown(this.kind,this.email)">
<p>
<input name="email" size="16" value="E-Mail" type="text"onblur="if(this.value=='') this.value='E-Mail';" onfocus="if(this.value=='E-Mail') this.value='';"/>
<input type="hidden" name="pw" value="foundry" />
<input type="hidden" name="pw-conf" value="foundry" />
<input type="hidden" name="digest" value="0" />
<input type="hidden" name="kind" value="OSSF-HTML" />
</p>
<input type="radio" name="subscribe" value="subscribe/" checked ><?php echo LM_SUBSCRIBE; ?>
<input type="radio" name="subscribe" value="options/" ><?php echo LM_UNSUBSCRIBE; ?>

<INPUT type="Submit" name="<?php echo $name; ?>" value="GO!" >

</FORM>
<?php
}
?>
