<?php
/**
* 
* @package		Easytagcloud
* @copyright	Copyright(C)2011 joomlatonight.com. All rights reserved.
* @link:
* @license		GNU/GPL, see LICENSE.php
* Easytagcloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/


// no direct access

defined('_JEXEC') or die('Restricted access');


// Include the syndicate functions only once

require_once (dirname(__FILE__).DS.'helper.php');


//Check if the module need to be initialized

require_once (dirname(__FILE__).DS.'updatetime.php');
$currenttime=time();
if(abs($currenttime-$updatetime)>=($params->get('interval')*3600)||!isset($updatetime))
{
   modTagcloudHelper::init($params);
}
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$easytagcloud_params=modTagcloudHelper::getTags($params);
require(JModuleHelper::getLayoutPath('mod_easytagcloud'));

?>