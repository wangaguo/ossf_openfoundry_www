<?php
/**
* @version $Id: login.php 3551 2006-05-18 20:23:01Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$tstart = mosProfiler::getmicrotime();
?>
<?php echo "<?xml version=\"1.0\"?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<title><?php echo $mosConfig_sitename; ?> - <?php echo $_LANG->_( 'Administration' ); ?> [Joomla]</title>
<style type="text/css">
@import url(templates/joomla_admin/css/admin_login.css);
</style>
<script language="javascript" type="text/javascript">
	function setFocus() {
		document.loginForm.usrname.select();
		document.loginForm.usrname.focus();
	}
</script>
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site .'/images/favicon.ico';?>" />
</head>
<body onload="setFocus();">
<div id="wrapper">
	<div id="header">
			<div id="joomla"><img src="templates/joomla_admin/images/header_text.png" alt="<?php echo $_LANG->_( 'Joomla Logo' ); ?>" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<?php
	// handling of mosmsg text in url
	include_once( $mosConfig_absolute_path .'/administrator/modules/mod_mosmsg.php' ); 
	?>
	<div class="login">
		<div class="login-form">
			<img src="templates/joomla_admin/images/login.gif" alt="Login" />
			<form action="index.php" method="post" name="loginForm" id="loginForm">
			<div class="form-block">
				<div class="inputlabel"><?php echo $_LANG->_( 'Username' ); ?></div>
				<div><input name="usrname" type="text" class="inputbox" size="15" /></div>
				<div class="inputlabel"><?php echo $_LANG->_( 'Password' ); ?></div>
				<div><input name="pass" type="password" class="inputbox" size="15" /></div>
				<!--<div class="inputlabel"><?php //echo $_LANG->_( 'Languages' ); ?></div>-->
				<?php
				/*print '<div>';
    $ls = '<select name="setlanguage" style="width: 100px; font-size: 10px; color: #666666">';
    $lancount = 0;
    foreach ($GLOBALS['LANGUAGES'] as $iso => $rec) {
      if (is_dir($mosConfig_absolute_path.'/administrator/language/'.$iso)) {
        $ls .= sprintf('<option value="%s" %s>%s</option>',$iso,$_SESSION['adminlanguage']['iso'] == $iso ? 'selected':'',$rec[0]);
        $lancount++;
      }
    }
	$ls .= '</select>';
	$ls .= '</div><br/>';
	
    if ($lancount > 1) {
      print $ls;
    }*/
				?>
				
				<div align="left"><input type="submit" name="submit" class="button" value="<?php echo $_LANG->_( 'Login' ); ?>" /></div>
			</div>
			</form>
		</div>
		<div class="login-text">
			<div class="ctr"><img src="templates/joomla_admin/images/security.png" width="64" height="64" alt="security" /></div>
			<p><?php echo $_LANG->_( 'Welcome to Joomla' ); ?>!</p>
			<p><a href="<?php echo $mosConfig_live_site;?>">
						<?php echo $mosConfig_sitename;?></a></p>
			<p><?php echo $_LANG->_( 'descUseValidLogin' ); ?></p>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div id="break"></div>
<noscript>
<?php echo $_LANG->_( 'errorNoJavascript' ); ?>
</noscript>
<div class="footer" align="center">
	<div align="center">
		<?php echo $_VERSION->URL; ?>
	</div>
</div>
</body>
</html>