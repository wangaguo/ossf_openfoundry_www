<?php


/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<style>
/* standard form style table */
table.thisform {
	background-color: #F7F8F9;
	border: solid 1px #d5d5d5;
	width: 100%;
	padding: 10px;
	border-collapse: collapse;
}
table.thisform tr.row0 {
	background-color: #F7F8F9;
}
table.thisform tr.row1 {
	background-color: #eeeeee;
}
table.thisform th {
	font-size: 15px;
	font-weight:normal;
	font-variant:small-caps;
	padding-top: 6px;
	padding-bottom: 2px;
	padding-left: 4px;
	padding-right: 4px;
	text-align: left;
	height: 25px;
	color: #666666;
	background: url(../images/background.gif);
	background-repeat: repeat;
}
table.thisform td {
	padding: 3px;
	text-align: left;
	border: 1px;
	border-style:solid;
	border-bottom-color:#EFEFEF;
	border-right-color:#EFEFEF;
	border-left-color:#EFEFEF;
	border-top-color:#EFEFEF;	
}

table.thisform2 {
	background-color: #F7F8F9;
	border: solid 1px #d5d5d5;
	width: 100%;
	padding: 5px;
}
table.thisform2 td {
	padding: 5px;
	text-align: center;
	border: 1x;
	border-style: solid;
	border-bottom-color:#EFEFEF;
	border-right-color:#EFEFEF;
	border-left-color:#EFEFEF;
	border-top-color:#EFEFEF;
}
.thisform2 td:hover {
	background-color: #B5CDE8;
	border:	1px solid #30559C;
}
</style>
<table class="adminheading">
<tr><td width="58px" ><img src="components/com_joomfish/images/joomfish.png"></td>
<th width="100%" class="cpanel" style="background: none;">Joom!Fish Content Element Installer</th>
</tr>
</table>

<table class="thisform">
   <tr class="thisform">
      <td width="50%" valign="top" class="thisform">
         <div id="cpanel">
         <div style="float:left;">
			<div class="icon">
			<a href="#" onClick="javascript:popupWindow('<?php echo $mosConfig_live_site; ?>/administrator/components/com_jfcei/upload.php','JFCEI',750,580,'no')" style="text-decoration:none;" title="Install Content Elements">
            <img src="images/config.png" width="48px" height="48px" align="middle" border="0"/>
            <span>
            Install Content Elements
			</span>
            </a></div></div>
            
         <div id="cpanel">
         <div style="float:left;">
			<div class="icon">
            <a href="http://www.joomfish.net" target="_blank" style="text-decoration:none;" title="Support Site">
            <img src="images/browser.png" width="48px" height="48px" align="middle" border="0"/>
            <span>
            Support Site
			</span>
            </a></div></div>

         <div id="cpanel">
         <div style="float:left;">
			<div class="icon">
            <a href="index2.php?option=com_joomfish" style="text-decoration:none;" title="Joom!Fish Control Panel">
            <img src="components/com_joomfish/images/fish.png" width="48px" height="48px" align="middle" border="0"/>
            <span>
            Joom!Fish Control Panel
			</span>
            </a></div></div>
         <div id="cpanel">
         <div style="float:left;">
			<div class="icon">
            <a href="index2.php?option=com_jfcei&task=sendmemail" style="text-decoration:none;" title="Report a Bug">
            <img src="images/massemail.png" width="48px" height="48px" align="middle" border="0"/>
            <span>
            Report a Bug
			</span>
            </a></div></div>      </td>
      <td width="50%" valign="top" align="center">
      <table border="1" width="100%" class="thisform">
         <tr class="thisform">
            <th class="cpanel" colspan="2">Joom!Fish Content Element Installer Help</th></td>
         </tr>
         <tr class="thisform"><td bgcolor="#FFFFFF" colspan="2"><br />
	<div style="width=100%" align="justify">
	The Joom!Fish Content Element Installer is a simple component that lets you to Install the content element files, that are necessary to the component in order to work with other components then the one in the core. Sometimes FTP access is not reachable or it is too complicated for you. The use the JFCEI and put the Content Element files for your components with two clicks.<br>
	</div>  
      </td></tr>       
         <tr class="thisform">
            <td width="50" bgcolor="#FFFFFF"><b>Problems:</b></td>
            <td bgcolor="#FFFFFF">If you experience problems by using this component, please check that the directory administrator/components/com_joomfish/contentelements is writeable.</td>
         </tr>
         <tr class="thisform">
            <td bgcolor="#FFFFFF"><b>Copyright:</b></td>
            <td bgcolor="#FFFFFF">&copy; 2006 Ivo Apostolov</td>
         </tr>		  
         <tr class="thisform">
            <td bgcolor="#FFFFFF"><b>License:</b></td>
            <td bgcolor="#FFFFFF">Custom Free and Open Source License</td>
         </tr>
      </table>
      </td>
   </tr>
</table>
