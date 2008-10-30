<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path;

function com_install() {
  	
	global $_VERSION, $database, $mosConfig_absolute_path, $mosConfig_lang;

	$database->setQuery( "SELECT id FROM #__components WHERE name= 'Joom!Fish CE Installer'" );
	$id = $database->loadResult();
   	$database->setQuery( "UPDATE #__components SET name= 'Joom!Fish CE Installer', admin_menu_img = 'js/ThemeOffice/install.png' WHERE id='$id'");
	$database->query();
if (file_exists($mosConfig_absolute_path . '/administrator/components/com_joomfish/config.joomfish.php')) {
	$database->setQuery( "SELECT id FROM #__components WHERE name= 'Joom!Fish CE Installer'" );
	$id = $database->loadResult();
   	$database->setQuery( "UPDATE #__components SET name= 'Joom!Fish CE Installer', admin_menu_img = 'js/ThemeOffice/install.png' WHERE id='$id'");
	$database->query();
	} else {
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/admin.jfcei.php" );
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/help.php" );
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/install.jfcei.php" );
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/toolbar.jfcei.html.php" );
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/toolbar.jfcei.php" );
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/uninstall.jfcei.php" );
@unlink( "$mosConfig_absolute_path/administrator/components/com_jfcei/upload.php" );
@rmdir ( "$mosConfig_absolute_path/administrator/components/com_jfcei");
@rmdir ( "$mosConfig_absolute_path/components/com_jfcei");
$database->setQuery( "DELETE FROM `#__components` WHERE `name`= 'Joom!Fish CE Installer';");
$database->query();
echo "The component Joom!Fish can not be found on your Joomla! installation. Joom!Fish Content Element Installer will now safetly self-remove. Please install Joom!Fish before trying to install JFCEI!";
		}

}

?>