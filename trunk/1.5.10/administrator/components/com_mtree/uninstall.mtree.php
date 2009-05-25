<?php
function com_uninstall()
{
	global $database;

	$msg = '<table width="100%" border="0" cellpadding="8" cellspacing="0"><tr>';
	$msg .= '<td width="100%" align="left" valign="top"><center><h3>Mosets Tree</h3><h4>A powerful directory component for Joomla!</h4><font class="small">&copy; Copyright 2004-2007 by Lee Cher Yeong. <a href="http://www.mosets.com/">http://www.mosets.com/</a><br/></font></center><br />';

	$msg .= "<fieldset style=\"border: 1px dashed #C0C0C0;\"><legend>Details</legend>";

	$msg .= "<font color=#339900>OK</font> &nbsp; Mosets Tree Uninstalled Successfully</fieldset>";
	$msg .='<br /><br /></td></tr></table>';

	return $msg;
}
?>
