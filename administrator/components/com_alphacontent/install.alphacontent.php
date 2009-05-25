<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */
defined('_JEXEC') or die('Restricted access');

defined('JPATH_BASE') or die();
global $mainframe;

// include version
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'assets'.DS.'includes'.DS.'version.php');

// Copyright
$copyStart = 2005; 
$copyNow = date('Y');  
if ($copyStart == $copyNow) { 
	$copySite = $copyStart;
} else {
	$copySite = $copyStart." - ".$copyNow ;
}

// plugin content
$file_destination_php = JPATH_PLUGINS.DS.'content'.DS.'alphacontent.php';
$file_destination_xml = JPATH_PLUGINS.DS.'content'.DS.'alphacontent.xml';

$file_orginal_php = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontent.php';
$file_orginal_xml = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontent.xml';

@copy ($file_orginal_php, $file_destination_php );
@copy ($file_orginal_xml, $file_destination_xml );

// publish plugin 
$db	=& JFactory::getDBO(); 
$query = "INSERT INTO `#__plugins` VALUES ('', 'AlphaContent', 'alphacontent', 'content', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
$db->setQuery( $query );
$db->query();


// plugin system
$file_destination_php = JPATH_PLUGINS.DS.'system'.DS.'alphacontentsys.php';
$file_destination_xml = JPATH_PLUGINS.DS.'system'.DS.'alphacontentsys.xml';

$file_orginal_php = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontentsys.php';
$file_orginal_xml = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontentsys.xml';

@copy ($file_orginal_php, $file_destination_php );
@copy ($file_orginal_xml, $file_destination_xml );

// publish plugin 
$db	=& JFactory::getDBO(); 
$query = "INSERT INTO `#__plugins` VALUES ('', 'AlphaContentSys', 'alphacontent', 'system', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
$db->setQuery( $query );
$db->query();


if (!file_exists ($file_destination_php ) && !file_exists($file_destination_php ) ) {
	$mainframe->redirect( 'index.php?option=com_alphacontent','NOTICE: AlphaContent plugin is not successfully installed. Make sure that the plugin directory is writeable' );
} else {

	$debugInstallSQL = "";
	// check if install.sql populate tables
	$query = "SELECT `total_votes` FROM #__alpha_rating";
	$db->setQuery( $query );
	// if not installed by install.sql...
	// populate now
	if (!$db->query()) {			
		$query = "CREATE TABLE IF NOT EXISTS `#__alpha_rating` (
		  `ref` int(11) NOT NULL auto_increment,
		  `id` int(11) NOT NULL default '0',
		  `total_votes` int(11) NOT NULL default '0',
		  `total_value` int(11) NOT NULL default '0',
		  `used_ips` longtext NOT NULL default '',
		  `component` varchar(30) NOT NULL default '',
		  `cid` int(11) NOT NULL default '0',
		  `rid` int(11) NOT NULL default '0',
		  PRIMARY KEY  (`ref`)
		) TYPE=MyISAM;";
		$db->setQuery( $query );
		$db->query();		
	
		$debugInstallSQL = "Install table successfully";
	}


	@unlink( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontent.php' );
	@unlink( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontent.xml' );
	
	@unlink( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontentsys.php' );
	@unlink( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontentsys.xml' );

	
	// Modify the admin icons
	$query = "SELECT id FROM #__components WHERE `name`='AlphaContent'";
	$db->setQuery( $query );
	$id = $db->loadResult();

	//add new admin menu images
	$query = "UPDATE #__components SET `name`='AlphaContent', admin_menu_img = '../administrator/components/com_alphacontent/assets/images/alphacontent_icon.png' WHERE id='$id'";
	$db->setQuery( $query );
	$db->query();

?>
<table width="100%" border="0">
<tr>
  <td><img src="components/com_alphacontent/assets/images/alphacontent.jpg"></td>
  <td>	<br />
  </td>
</tr>
<tr>
	<td colspan="2"><br /><b>
	  AlphaContent - A Joomla Directory Component</b><br />
      <font class="small">&copy; <?php echo $copySite ; ?> - Bernard Gilly<br />
Released under donationware licence - All Rights Reserved - <a href="http://www.alphaplug.com" target="_blank">www.alphaplug.com</a></font><br />
<?php echo $debugInstallSQL ; ?></td>
</tr>
<tr>
  <td background="E0E0E0" style="border:1px solid #999999;color:green;font-weight:bold;" colspan="2">Installation finished.</td>
</tr>
</table>
<?php } ?>