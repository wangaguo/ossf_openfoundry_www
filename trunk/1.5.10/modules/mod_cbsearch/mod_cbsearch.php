<?php
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }


$output = '
<form id="adminForm" class="cb_form" action="index.php?option=com_comprofiler&task=usersList&listid=2&Itemid=400&action=search" method="get" name="adminForm">
<input type="hidden" value="com_comprofiler" name="option"/>
<input type="hidden" value="usersList" name="task"/>
<input type="hidden" value="400" name="Itemid"/>
<input id="cbListlimitstart" type="hidden" value="0" name="limitstart"/>
<input type="hidden" value="phrase" name="username__srmch"/>
<input type="hidden" value="phrase" name="name__srmch"/>
<table>
  <tr><td>
Search by name: </td><td><input id="name" class="inputbox" type="text" title="שם:_UE_REGWARN_NAME" size="25" moslabel="name" mosreq="1" value="" name="name"/></td></tr><tr><td>
Search by user: </td><td><input id="username" class="inputbox" type="text" title="username:_UE_VALID_UNAME" size="25" moslabel="username" mosreq="1" value="" name="username"/></td></tr>
<tr><td colspan="2" align="center">

<input id="cbsearchlist" class="button" type="submit" value="Search"/></td></tr>
</table>
</form>
';

echo $output;

?>