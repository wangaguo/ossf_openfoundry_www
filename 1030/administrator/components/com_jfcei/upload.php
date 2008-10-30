<?php
define( "_VALID_MOS", 1 );
/** security check */
require( "../../includes/auth.php" );
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

?>
<html>
<head>
<title>Joom!Fish Content Element Installer</title>
<link rel="stylesheet" href="../../templates/joomla_admin/css/template_css.css" type="text/css" />
<link rel="stylesheet" href="../../templates/joomla_admin/css/theme.css" type="text/css" />
</head>
<body>
<table style="padding:20px; margin: 20px;" class="adminheading">
<tr><th class="install">&nbsp;Install Content Elements <small><small>[ Joom!Fish ]</small></small></th></tr>
</table>
<table style="padding-right:10px; margin-left: 10px; margin-right: 10px;" class="adminform"><tr>
<th colspan="2"><form enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="2048000">
Install up to five content elements for Joom!Fish</th></tr>
<tr><td>Select Content Element:</td><td><input class="button" name="userfile" type="file" /></td></tr>
<tr><td>Select Content Element:</td><td><input class="button" name="userfile1" type="file" /></td></tr>
<tr><td>Select Content Element:</td><td><input class="button" name="userfile2" type="file" /></td></tr>
<tr><td>Select Content Element:</td><td><input class="button" name="userfile3" type="file" /></td></tr>
<tr><td>Select Content Element:</td><td><input class="button" name="userfile4" type="file" /></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" class="button" value="Upload" /></td></tr>
</form>
<th colspan="2"><small align="right"><a href="#" onClick="javascript:window.close()">Close Window</a></small></th>
</table><br><br>
</body>
</html>
<?php

if (@is_uploaded_file($_FILES["userfile"]["tmp_name"])) {
copy($_FILES["userfile"]["tmp_name"], "../com_joomfish/contentelements/" . $_FILES["userfile"]["name"]);
echo "<table style='padding-right:10px; margin-left: 10px; margin-right: 10px;' class='adminform'><tr><th>Results</th></tr><tr><td>Content Element 1 Installed Successfully</td></tr>";
}

if (@is_uploaded_file($_FILES["userfile1"]["tmp_name"])) {
copy($_FILES["userfile1"]["tmp_name"], "../com_joomfish/contentelements/" . $_FILES["userfile1"]["name"]);
echo "<tr><td>Content Element 2 Installed Successfully</td></tr>";
}
if (@is_uploaded_file($_FILES["userfile2"]["tmp_name"])) {
copy($_FILES["userfile2"]["tmp_name"], "../com_joomfish/contentelements/" . $_FILES["userfile2"]["name"]);
echo "<tr><td>Content Element 3 Installed Successfully</td></tr>";
}
if (@is_uploaded_file($_FILES["userfile3"]["tmp_name"])) {
copy($_FILES["userfile3"]["tmp_name"], "../com_joomfish/contentelements/" . $_FILES["userfile3"]["name"]);
echo "<tr><td>Content Element 4 Installed Successfully</td></tr>";
}

if (@is_uploaded_file($_FILES["userfile4"]["tmp_name"])) {
copy($_FILES["userfile4"]["tmp_name"], "../com_joomfish/contentelements/" . $_FILES["userfile4"]["name"]);
echo "<tr><td>Content Element 1 Installed Successfully</td></tr>";
}


?>