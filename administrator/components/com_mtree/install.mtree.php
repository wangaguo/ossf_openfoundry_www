<?php
/**
* Mosets Tree toolbar 
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $database;
require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/config.mtree.class.php' );

function com_install() {

	# Perform fresh install
	return new_install();

}

function new_install() {
	global $database, $my;
	$mtconf = new mtConfig($database);
	
	$j_absolute_path = $mtconf->getjconf('absolute_path');
	
	$database->setQuery('SELECT fta_id, filedata FROM #__mt_fieldtypes_att');
	$ftas = $database->loadObjectList();
	foreach($ftas AS $fta) {
		$database->setQuery('UPDATE #__mt_fieldtypes_att SET filedata = \''.$database->getEscaped(base64_decode($fta->filedata)).'\' WHERE fta_id = ' . $fta->fta_id . ' LIMIT 1');
		$database->query();
	}
	$database->setQuery('SELECT ft_id, ft_class FROM #__mt_fieldtypes');
	$fts = $database->loadObjectList();
	foreach($fts AS $ft) {
		$database->setQuery('UPDATE #__mt_fieldtypes SET ft_class = \''.$database->getEscaped(base64_decode($ft->ft_class)).'\' WHERE ft_id = ' . $ft->ft_id . ' LIMIT 1');
		$database->query();
	}
	
	$msg = '<table width="100%" border="0" cellpadding="8" cellspacing="0"><tr width="100%"><td align="center" valign="top"><center><img width="230" height="103" src="../components/com_mtree/img/logo_mtree.gif" alt="Mosets Tree" /></center></td></tr>';
	$msg .= '<tr><td align="left" valign="top"><center><h3>Mosets Tree v'.$mtconf->get('version').'</h3><h4>A flexible directory component for Joomla!</h4><font class="small">&copy; Copyright 2005 - 2008 by Mosets Consulting. <a href="http://www.mosets.com/">http://www.mosets.com/</a><br/></font></center><br />';
	$msg .= "<fieldset style=\"border: 1px dashed #C0C0C0;\"><legend>Details</legend>";

	# Assign current user's email as Mosets Tree admin
	$database->setQuery("UPDATE #__mt_config SET value='" . $my->email . "' WHERE varname='admin_email' LIMIT 1");
	$database->query();
	
	# Change Admin Icon to Mosets icon
	$database->setQuery("UPDATE #__components SET admin_menu_img='../components/com_mtree/img/favicon.png' WHERE admin_menu_link='option=com_mtree'");
	$database->query();

	$msg .= '<br />';
	$msg .= isWritableMsg($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_cat_original_image'));
	$msg .= isWritableMsg($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_cat_small_image'));
	$msg .= isWritableMsg($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_original_image'));
	$msg .= isWritableMsg($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_medium_image'));
	$msg .= isWritableMsg($mtconf->getjconf('absolute_path').$mtconf->get('relative_path_to_listing_small_image'));

	$msg .= "<br /><font color='green'>OK &nbsp; Mosets Tree Installed Successfully!</font></fieldset>";
	$msg .= "<p /><a href=\"index2.php?option=com_mtree\">Run Mosets Tree now!</a>";
	$msg .='<br /><br /></td></tr></table>';

	mosets_mail( "mtree", "Mosets Tree" );

	return $msg ;
} 

function isWritableMsg($dir) {
	global $mtconf;
	$msg = '';
	$msg .= (is_writable( $dir ) ? '<b><font color="green">Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>');
	$msg .= ' &nbsp;'.$dir . '<br />';
	return $msg;
}

function mosets_mail( $name, $product ) {
	// Send notice of installation information to Mosets
	global $database, $my, $version;
	$mtconf = new mtConfig($database);
	
	$email_to= $name.".install@mosets.com";

	global $database, $my; 
	$sql = "SELECT * FROM `#__users` WHERE id = $my->id LIMIT 1"; 
	$database->setQuery( $sql ); 
	$u_rows = $database->loadObjectList(); 

	$text = "There was an installation of **" . $product ."** \r \n at " 
	. $mtconf->getjconf('live_site') . " with version: " . $mtconf->get('version') . "  \r \n"
	. "Email: " . $u_rows[0]->email . "\r \n"
	. "Joomla! version: " . $version . "\r \n";

	$subject = " Installation at: " .$mtconf->getjconf('sitename');
	$headers = "MIME-Version: 1.0\r \n";
	$headers .= "From: ".$u_rows[0]->username." <".$u_rows[0]->email.">\r \n";
	$headers .= "Reply-To: <".$email_to.">\r \n";
	$headers .= "X-Priority: 1\r \n";
	$headers .= "X-MSMail-Priority: High\r \n";
	$headers .= "X-Mailer: Joomla! on " .
	$mtconf->getjconf('sitename') . "\r \n";

	@mail($email_to, $subject, $text, $headers);
}

?>
