<!--
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2005 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * File Name: fck_link.html
 * 	Link dialog window.
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (fredck@fckeditor.net)
-->
<?php
/**
* TinyMCE extended InsertLink option. Based on TinyMCE InsertLink and IdeaMan's InsertLink mod - Ryan Demmer.
* @package Mambo Open Source
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.02en $
**/
define( "_VALID_MOS", 1 );
require_once("../../../../../configuration.php");
require_once("../../../../../includes/mambo.php");
global $database;
$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database->setQuery( "SELECT id AS value, CONCAT( title, ' (', title_alias, ')' ) AS text FROM #__content ORDER BY id" );
$content = $database->loadObjectList( );
$article_select =  "<select size=\"1\" name=\"articles\" id=\"articles\" style=\"width: 98%\" onChange=\"document.getElementById('href').value= homeurl + contenturl + document.getElementById('articles').value; document.getElementById('categories').value = '';document.getElementById('sections').value = '';document.getElementById('contacts').value = '';\">\n";
$article_select .= "<option value='' fckLang='DlnLnkMsgChoose' selected>Please choose...</option>\n";
foreach($content as $objElement) {
        $article_select .= "<option value='{$objElement->value}'>{$objElement->text}</option>\n";
}
$article_select .=  "</select>\n";

//Section
$database1 = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database1->setQuery( "SELECT id AS value, CONCAT( title, ' (', name, ')' ) AS text FROM #__sections ORDER BY id" );
$content1 = $database1->loadObjectList( );
$section_select =  "<select size=\"1\" name=\"sections\" id=\"sections\" style=\"width: 98%\" onChange=\"document.getElementById('href').value= homeurl + sectionurl + document.getElementById('sections').value; document.getElementById('articles').value = '';document.getElementById('categories').value = '';document.getElementById('contacts').value = '';\">\n";
$section_select .= "<option value='' fckLang='DlnLnkMsgChoose'>Please choose...</option>\n";
foreach($content1 as $objElement1) {
        $section_select .= "<option value='{$objElement1->value}'>{$objElement1->text}</option>\n";
}
$section_select .=  "</select>\n";

//Category
$database2 = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database2->setQuery( "SELECT id AS value, CONCAT( title, ' (', name, ')' ) AS text FROM #__categories WHERE section <> 'com_docman' ORDER BY id" );
$content2 = $database2->loadObjectList( );
$cat_select =  "<select size=\"1\" name=\"categories\" id=\"categories\" style=\"width: 98%\" onChange=\"document.getElementById('href').value= homeurl + categoriesurl + document.getElementById('categories').value; document.getElementById('articles').value = '';document.getElementById('sections').value = '';document.getElementById('contacts').value = '';\">\n";
$cat_select .= "<option value='' fckLang='DlnLnkMsgChoose'>Please choose...</option>\n";
foreach($content2 as $objElement2) {
                $cat_select .= "<option value='{$objElement2->value}'>{$objElement2->text}</option>\n";
}
$cat_select .=  "</select>\n";

//Contact
$database3 = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database3->setQuery( "SELECT id AS value, CONCAT( name, ' (', con_position, ')' ) AS text FROM #__contact_details ORDER BY id" );
$content3 = $database3->loadObjectList( );
$con_select =  "<select size=\"1\" name=\"contacts\" id=\"contacts\" style=\"width: 98%\" onChange=\"document.getElementById('href').value= homeurl + contactsurl + document.getElementById('contacts').value; document.getElementById('articles').value = '';document.getElementById('sections').value = '';\">\n";
$con_select .= "<option value='' fckLang='DlnLnkMsgChoose'>Please choose...</option>\n";
foreach($content3 as $objElement3) {
                $con_select .= "<option value='{$objElement3->value}'>{$objElement3->text}</option>\n";
}
$con_select .=  "</select>\n";

$database6 = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database6->setQuery( "SELECT COUNT(*) FROM #__components WHERE link='option=com_docman'" );
$total = $database6->loadResult();

//Category Docman
if ($total != 0) {

$database4 = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database4->setQuery( "SELECT id AS value, CONCAT( title, ' (', name, ')' ) AS text FROM #__categories WHERE section = 'com_docman' ORDER BY id" );
$content4 = $database4->loadObjectList( );
$cat_select_doc =  "<select size=\"1\" name=\"categories_doc\" id=\"categories_doc\" style=\"width: 98%\" onChange=\"document.getElementById('doc_href').value= homeurl + categoriesurl_doc + document.getElementById('categories_doc').value;document.getElementById('filesurl_doc').value = '';\">\n";
$cat_select_doc .= "<option value='' fckLang='DlnLnkMsgChoose'>Please choose...</option>\n";
foreach($content4 as $objElement4) {
                $cat_select_doc .= "<option value='{$objElement4->value}'>{$objElement4->text}</option>\n";
}
$cat_select_doc .=  "</select>\n";

//File Docman
$database5 = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database5->setQuery( "SELECT id AS value, CONCAT( dmname, ' (', dmfilename, ')' ) AS text FROM #__docman ORDER BY id" );
$content5 = $database5->loadObjectList( );
$filesurl_doc =  "<select size=\"1\" name=\"filesurl_doc\" id=\"filesurl_doc\" style=\"width: 98%\" onChange=\"document.getElementById('doc_href').value= homeurl + filesurl_doc + document.getElementById('filesurl_doc').value;document.getElementById('categories_doc').value = '';\">\n";
$filesurl_doc .= "<option value='' fckLang='DlnLnkMsgChoose'>Please choose...</option>\n";
foreach($content5 as $objElement5) {
                $filesurl_doc .= "<option value='{$objElement5->value}'>{$objElement5->text}</option>\n";
}
$filesurl_doc .=  "</select>\n";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>Link Properties</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex, nofollow" />
		<script src="common/fck_dialog_common.js" type="text/javascript"></script>
		<script src="fck_link/fck_link.js" type="text/javascript"></script>
		
		<script type="text/javascript">
var homeurl = '<?php echo $mosConfig_live_site ?>';
var contenturl = '/index.php?option=content&task=view&id=';
var sectionurl = '/index.php?option=content&task=section&id=';
var categoriesurl = '/index.php?option=content&task=category&id=';
var contactsurl = '/index.php?option=contact&task=view&contact_id=';
var categoriesurl_doc = '/index.php?option=com_docman&task=cat_view&gid=';
var filesurl_doc = '/index.php?option=com_docman&task=doc_download&gid=';
	</script>	
		
	</head>
	<body scroll="no" style="OVERFLOW: hidden">
		<div id="divInfo" style="DISPLAY: none">
			<span fckLang="DlgLnkType">Link Type</span><br />
			<select id="cmbLinkType" onchange="SetLinkType(this.value);">
				<option value="url" fckLang="DlgLnkTypeURL" selected="selected">URL</option>
				<option value="anchor" fckLang="DlgLnkTypeAnchor">Anchor in this page</option>
				<option value="email" fckLang="DlgLnkTypeEMail">E-Mail</option>
				<option value="content" fckLang="DlgLnkTypeContent">Content</option>
				<?php
				if ($total != 0) {
				?>
				<option value="docman">Docman</option>
				<?php
				}
				?>
			</select>
			<br />
			<br />
			<div id="divLinkTypeUrl">
				<table cellspacing="0" cellpadding="0" width="100%" border="0" dir="ltr">
					<tr>
						<td nowrap="nowrap">
							<span fckLang="DlgLnkProto">Protocol</span><br />
							<select id="cmbLinkProtocol">
								<option value="http://" selected="selected">http://</option>
								<option value="https://">https://</option>
								<option value="ftp://">ftp://</option>
								<option value="news://">news://</option>
								<option value="" fckLang="DlgLnkProtoOther">&lt;other&gt;</option>
							</select>
						</td>
						<td nowrap="nowrap">&nbsp;</td>
						<td nowrap="nowrap" width="100%">
							<span fckLang="DlgLnkURL">URL</span><br />
							<input id="txtUrl" style="WIDTH: 100%" type="text" onkeyup="OnUrlChange();" onchange="OnUrlChange();" />
						</td>
					</tr>
				</table>
				<br />
				<div id="divBrowseServer">
				<input type="button" value="Browse Server" fckLang="DlgBtnBrowseServer" onclick="BrowseServer();" />
				</div>
			</div>
			<div id="divLinkTypeAnchor" style="DISPLAY: none" align="center">
				<div id="divSelAnchor" style="DISPLAY: none">
					<table cellspacing="0" cellpadding="0" border="0" width="70%">
						<tr>
							<td colspan="3">
								<span fckLang="DlgLnkAnchorSel">Select an Anchor</span>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<span fckLang="DlgLnkAnchorByName">By Anchor Name</span><br />
								<select id="cmbAnchorName" onchange="GetE('cmbAnchorId').value='';" style="WIDTH: 100%">
									<option value="" selected="selected"></option>
								</select>
							</td>
							<td>&nbsp;&nbsp;&nbsp;</td>
							<td width="50%">
								<span fckLang="DlgLnkAnchorById">By Element Id</span><br />
								<select id="cmbAnchorId" onchange="GetE('cmbAnchorName').value='';" style="WIDTH: 100%">
									<option value="" selected="selected"></option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="divNoAnchor" style="DISPLAY: none">
					<span fckLang="DlgLnkNoAnchors">&lt;No anchors available in the document&gt;</span>
				</div>
			</div>
			<div id="divLinkTypeEMail" style="DISPLAY: none">
				<span fckLang="DlgLnkEMail">E-Mail Address</span><br />
				<input id="txtEMailAddress" style="WIDTH: 100%" type="text" /><br />
				<span fckLang="DlgLnkEMailSubject">Message Subject</span><br />
				<input id="txtEMailSubject" style="WIDTH: 100%" type="text" /><br />
				<span fckLang="DlgLnkEMailBody">Message Body</span><br />
				<textarea id="txtEMailBody" style="WIDTH: 100%" rows="3" cols="20"></textarea>
			</div>
			
			<div id="divLinkTypeContent" style="DISPLAY: none">
				<span fckLang="DlgLnkItem">Item</span><br />
				<?php echo $article_select; ?><br />
				<span fckLang="DlgLnkCategory">Category</span><br />
				<?php echo $cat_select; ?><br />
				<span fckLang="DlgLnkSection">Section</span><br />
				<?php echo $section_select; ?><br />
				<span fckLang="DlgLnkContact">Contact</span><br />
				<?php echo $con_select; ?><br />
				<table cellspacing="0" cellpadding="0" width="100%" border="0" dir="ltr">
					<tr>
					<td nowrap="nowrap" width="100%">
							<span fckLang="DlgLnkURL">URL</span><br />
							<input id="href" style="WIDTH: 100%" type="text" onkeyup="OnUrlChange();" onchange="OnUrlChange();" />
						</td>
					</tr>
				</table>
			</div>
			
		<div id="divLinkTypeDocman" style="DISPLAY: none">
				<span fckLang="DlgLnkCategory">Category</span><br />
				<?php echo $cat_select_doc; ?><br />
				<span fckLang="DlgLnkFile">File</span><br />
				<?php echo $filesurl_doc; ?><br />
				<table cellspacing="0" cellpadding="0" width="100%" border="0" dir="ltr">
					<tr>
					<td nowrap="nowrap" width="100%">
							<span fckLang="DlgLnkURL">URL</span><br />
							<input id="doc_href" style="WIDTH: 100%" type="text" onkeyup="OnUrlChange();" onchange="OnUrlChange();" />
						</td>
					</tr>
				</table>
			</div>
			
		</div>
		<div id="divUpload" style="DISPLAY: none">
			<form id="frmUpload" method="post" target="UploadWindow" enctype="multipart/form-data" action="" onsubmit="return CheckUpload();">
				<span fckLang="DlgLnkUpload">Upload</span><br />
				<input id="txtUploadFile" style="WIDTH: 100%" type="file" size="40" name="NewFile" /><br />
				<br />
				<input id="btnUpload" type="submit" value="Send it to the Server" fckLang="DlgLnkBtnUpload" />
				<iframe name="UploadWindow" style="DISPLAY: none"></iframe> 
			</form>
		</div>
		<div id="divTarget" style="DISPLAY: none">
			<table cellspacing="0" cellpadding="0" width="100%" border="0">
				<tr>
					<td nowrap="nowrap">
						<span fckLang="DlgLnkTarget">Target</span><br />
						<select id="cmbTarget" onchange="SetTarget(this.value);">
							<option value="" fckLang="DlgGenNotSet" selected="selected">&lt;not set&gt;</option>
							<option value="frame" fckLang="DlgLnkTargetFrame">&lt;frame&gt;</option>
							<option value="popup" fckLang="DlgLnkTargetPopup">&lt;popup window&gt;</option>
							<option value="_blank" fckLang="DlgLnkTargetBlank">New Window (_blank)</option>
							<option value="_top" fckLang="DlgLnkTargetTop">Topmost Window (_top)</option>
							<option value="_self" fckLang="DlgLnkTargetSelf">Same Window (_self)</option>
							<option value="_parent" fckLang="DlgLnkTargetParent">Parent Window (_parent)</option>
						</select>
					</td>
					<td>&nbsp;</td>
					<td id="tdTargetFrame" nowrap="nowrap" width="100%">
						<span fckLang="DlgLnkTargetFrameName">Target Frame Name</span><br />
						<input id="txtTargetFrame" style="WIDTH: 100%" type="text" onkeyup="OnTargetNameChange();"
							onchange="OnTargetNameChange();" />
					</td>
					<td id="tdPopupName" style="DISPLAY: none" nowrap="nowrap" width="100%">
						<span fckLang="DlgLnkPopWinName">Popup Window Name</span><br />
						<input id="txtPopupName" style="WIDTH: 100%" type="text" />
					</td>
				</tr>
			</table>
			<br />
			<table id="tablePopupFeatures" style="DISPLAY: none" cellspacing="0" cellpadding="0" align="center"
				border="0">
				<tr>
					<td>
						<span fckLang="DlgLnkPopWinFeat">Popup Window Features</span><br />
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td valign="top" nowrap="nowrap" width="50%">
									<input id="chkPopupResizable" name="chkFeature" value="resizable" type="checkbox" /><label for="chkPopupResizable" fckLang="DlgLnkPopResize">Resizable</label><br />
									<input id="chkPopupLocationBar" name="chkFeature" value="location" type="checkbox" /><label for="chkPopupLocationBar" fckLang="DlgLnkPopLocation">Location 
										Bar</label><br />
									<input id="chkPopupManuBar" name="chkFeature" value="menubar" type="checkbox" /><label for="chkPopupManuBar" fckLang="DlgLnkPopMenu">Menu 
										Bar</label><br />
									<input id="chkPopupScrollBars" name="chkFeature" value="scrollbars" type="checkbox" /><label for="chkPopupScrollBars" fckLang="DlgLnkPopScroll">Scroll 
										Bars</label>
								</td>
								<td></td>
								<td valign="top" nowrap="nowrap" width="50%">
									<input id="chkPopupStatusBar" name="chkFeature" value="status" type="checkbox" /><label for="chkPopupStatusBar" fckLang="DlgLnkPopStatus">Status 
										Bar</label><br />
									<input id="chkPopupToolbar" name="chkFeature" value="toolbar" type="checkbox" /><label for="chkPopupToolbar" fckLang="DlgLnkPopToolbar">Toolbar</label><br />
									<input id="chkPopupFullScreen" name="chkFeature" value="fullscreen" type="checkbox" /><label for="chkPopupFullScreen" fckLang="DlgLnkPopFullScrn">Full 
										Screen (IE)</label><br />
									<input id="chkPopupDependent" name="chkFeature" value="dependent" type="checkbox" /><label for="chkPopupDependent" fckLang="DlgLnkPopDependent">Dependent 
										(Netscape)</label>
								</td>
							</tr>
							<tr>
								<td valign="top" nowrap="nowrap" width="50%">&nbsp;</td>
								<td></td>
								<td valign="top" nowrap="nowrap" width="50%"></td>
							</tr>
							<tr>
								<td valign="top">
									<table cellspacing="0" cellpadding="0" border="0">
										<tr>
											<td nowrap="nowrap"><span fckLang="DlgLnkPopWidth">Width</span></td>
											<td>&nbsp;<input id="txtPopupWidth" type="text" maxlength="4" size="4" /></td>
										</tr>
										<tr>
											<td nowrap="nowrap"><span fckLang="DlgLnkPopHeight">Height</span></td>
											<td>&nbsp;<input id="txtPopupHeight" type="text" maxlength="4" size="4" /></td>
										</tr>
									</table>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td valign="top">
									<table cellspacing="0" cellpadding="0" border="0">
										<tr>
											<td nowrap="nowrap"><span fckLang="DlgLnkPopLeft">Left Position</span></td>
											<td>&nbsp;<input id="txtPopupLeft" type="text" maxlength="4" size="4" /></td>
										</tr>
										<tr>
											<td nowrap="nowrap"><span fckLang="DlgLnkPopTop">Top Position</span></td>
											<td>&nbsp;<input id="txtPopupTop" type="text" maxlength="4" size="4" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div id="divAttribs" style="DISPLAY: none">
			<table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
				<tr>
					<td valign="top" width="50%">
						<span fckLang="DlgGenId">Id</span><br />
						<input id="txtAttId" style="WIDTH: 100%" type="text" />
					</td>
					<td width="1"></td>
					<td valign="top">
						<table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
							<tr>
								<td width="60%">
									<span fckLang="DlgGenLangDir">Language Direction</span><br />
									<select id="cmbAttLangDir" style="WIDTH: 100%">
										<option value="" fckLang="DlgGenNotSet" selected>&lt;not set&gt;</option>
										<option value="ltr" fckLang="DlgGenLangDirLtr">Left to Right (LTR)</option>
										<option value="rtl" fckLang="DlgGenLangDirRtl">Right to Left (RTL)</option>
									</select>
								</td>
								<td width="1%">&nbsp;&nbsp;&nbsp;</td>
								<td nowrap="nowrap"><span fckLang="DlgGenAccessKey">Access Key</span><br />
									<input id="txtAttAccessKey" style="WIDTH: 100%" type="text" maxlength="1" size="1" />
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="50%">
						<span fckLang="DlgGenName">Name</span><br />
						<input id="txtAttName" style="WIDTH: 100%" type="text" />
					</td>
					<td width="1"></td>
					<td valign="top">
						<table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
							<tr>
								<td width="60%">
									<span fckLang="DlgGenLangCode">Language Code</span><br />
									<input id="txtAttLangCode" style="WIDTH: 100%" type="text" />
								</td>
								<td width="1%">&nbsp;&nbsp;&nbsp;</td>
								<td nowrap="nowrap">
									<span fckLang="DlgGenTabIndex">Tab Index</span><br />
									<input id="txtAttTabIndex" style="WIDTH: 100%" type="text" maxlength="5" size="5" />
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="50%">&nbsp;</td>
					<td width="1"></td>
					<td valign="top"></td>
				</tr>
				<tr>
					<td valign="top" width="50%">
						<span fckLang="DlgGenTitle">Advisory Title</span><br />
						<input id="txtAttTitle" style="WIDTH: 100%" type="text" />
					</td>
					<td width="1">&nbsp;&nbsp;&nbsp;</td>
					<td valign="top">
						<span fckLang="DlgGenContType">Advisory Content Type</span><br />
						<input id="txtAttContentType" style="WIDTH: 100%" type="text" />
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span fckLang="DlgGenClass">Stylesheet Classes</span><br />
						<input id="txtAttClasses" style="WIDTH: 100%" type="text" />
					</td>
					<td></td>
					<td valign="top">
						<span fckLang="DlgGenLinkCharset">Linked Resource Charset</span><br />
						<input id="txtAttCharSet" style="WIDTH: 100%" type="text" />
					</td>
				</tr>
			</table>
			<table cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
				<tr>
					<td>
						<span fckLang="DlgGenStyle">Style</span><br />
						<input id="txtAttStyle" style="WIDTH: 100%" type="text" />
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
