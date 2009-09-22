this is secure/index.php <br/>
<?= "REMOTE_USER: " . $_SERVER['REMOTE_USER'] . "."?> <br/>
<?= "EPPN: " . $_SERVER['HTTP_EPPN'] . "."?><br/>
<?= "EPPN: " . $HTTP_SERVER_VARS['HTTP_EPPN'] . "."?> <br/>
<?=phpinfo()?>

