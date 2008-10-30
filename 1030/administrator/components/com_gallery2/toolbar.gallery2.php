<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require_once($mainframe->getPath('toolbar_default'));
global $act, $task;
switch ($act) {
	case 'conf':
		mosMenuBar::startTable();
		if(function_exists('curl_init')){
			mosMenuBar::custom('sitestats', 'upload.png', 'upload_f2.png', 'Update Stats', false);
			mosMenuBar::spacer( 5);
		}
		mosMenuBar::custom('sitemap', 'xml.png', 'xml_f2.png', 'Sitemap', false);
		mosMenuBar::spacer( 25);
		mosMenuBar::trash('Cache', 'Cache', false);
		mosMenuBar::spacer( 25 );
		mosMenuBar::save();
		mosMenuBar::back();
		mosMenuBar::endTable();
	break;
	case 'user':
		switch ($task){
			case 'user_edit':
			mosMenuBar::startTable();
			mosMenuBar::save();
			mosMenuBar::back();
			mosMenuBar::endTable();
			break;
			case 'save':
			mosMenuBar::startTable();
			mosMenuBar::back();
			mosMenuBar::endTable();
			break;
			default:
			mosMenuBar::startTable();
			mosMenuBar::custom('syncGroups', 'reload.png', 'reload_f2.png', 'Groups', false);
			mosMenuBar::custom('syncUsers', 'reload.png', 'reload_f2.png', 'Users', false);
			mosMenuBar::spacer( 25 );
			mosMenuBar::back();
			mosMenuBar::endTable();
			break;
		}
		break;
	case 'tools':
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::endTable();
		break;
	case 'album':
		switch($task){
			case 'album_spec':
				mosMenuBar::startTable();
				mosMenuBar::save();
				mosMenuBar::back();
				mosMenuBar::endTable();
			break;
			default:
				mosMenuBar::startTable();
				mosMenuBar::back();
				mosMenuBar::endTable();
			break;
		}
		break;
	default:
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::back();
		mosMenuBar::endTable();
		break;
}
?>