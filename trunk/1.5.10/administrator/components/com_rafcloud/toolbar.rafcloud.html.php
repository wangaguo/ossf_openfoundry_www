<?php
/**
* @version 2.0.2
* @package Raf Cloud
* @copyright Copyright (C) 2007 Skorp. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Raf Cloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @Author: Rafal Blachowski (Skorp) <http://joomla.royy.net>
*/
defined( '_VALID_MOS' ) or die( 'Restricted access' );

class TOOLBAR_rafcloud {
	function CONFIG_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save('saveconfig', RC_SAVE);
		mosMenuBar::spacer();
		mosMenuBar::cancel('view', RC_CANCEL);
		mosMenuBar::endTable();
	}
	function PLUGIN_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::publishList('publishPlugin');
		mosMenuBar::spacer();
		mosMenuBar::unpublishList('unpublishPlugin');
		mosMenuBar::spacer();
		mosMenuBar::trash( 'removePlugin', RC_REMOVE_PLUGIN);
		mosMenuBar::spacer();
		mosMenuBar::cancel('view', RC_CLOSE);
		mosMenuBar::endTable();
	}
	function REMOVE_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::trash( 'eraseAll', RC_ERASE_ALL,true);
		mosMenuBar::divider();
		mosMenuBar::trash( 'eraseUnpubl', RC_ERASE_UNPUBL,false);
		mosMenuBar::spacer();
		mosMenuBar::cancel('view', RC_CANCEL);
		mosMenuBar::endTable();
	}
	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'create', 'reload_f2.png','reload_f2.png', RC_BUILD,false);
		mosMenuBar::spacer();
		mosMenuBar::trash( 'removeWords', RC_ERASE,false);
		mosMenuBar::spacer();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::custom( 'plugins', 'file_f2.png','file_f2.png', RC_PLUGINS,false);
		mosMenuBar::spacer();
		mosMenuBar::custom( 'config', 'edit_f2.png','edit_f2.png', RC_CONFIG,false);

		global $mosConfig_lang, $mosConfig_absolute_path;
               if (file_exists($mosConfig_absolute_path.'/administrator/components/com_rafcloud/help/rafcloud.help.'.$mosConfig_lang.'.html')) {
                  $help_file = 'rafcloud.help.'.$mosConfig_lang;
               } else {
                  $help_file = 'rafcloud.help.english';
               }
		mosMenuBar::spacer();
                mosMenuBar::help($help_file, true);
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
}
?>