<?php
/**
 * @copyright (C) 2007 - All rights reserved!
 *
 * Rem:
 * This file is to perform the execution of displaying user's info in the javascript variables.
 **/
global $_JC_CONFIG;

$cms        =& cmsInstance('CMSCore');
$cms->load('libraries','user');

$nameField  = $_JC_CONFIG->get('username');

$userName   = isset($cms->user->$nameField) ? $cms->user->$nameField : '';
$userEmail  = isset($cms->user->email) ? $cms->user->email : '';

echo '
	jc_username     = "' . $userName . '";
	jc_email        = "' . $userEmail . '";
';
exit();
?>