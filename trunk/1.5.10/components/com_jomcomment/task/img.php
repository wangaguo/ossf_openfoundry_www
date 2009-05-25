<?php
/**
 * @copyright (C) 2007 - All rights reserved!
 *
 * Rem:
 * This file is to perform the execution of displaying captcha's image
 **/

include_once(JC_MODEL_PATH . '/captcha.db.php');
include_once(JC_LIB_PATH . '/captcha.class.php');

$cms    	=& cmsInstance('CMSCore');
$cms->load('libraries','input');

$captcha    = new JCCaptcha();
$captcha->show($cms->input->get('jc_sid', ''));
?>