<?php

/**
 * SEF extension for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2009-2010
 * @package     sh404SEF-15
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: toolbar.sh404sef.php 1193 2010-04-04 16:18:35Z silianacom-svn $
 */

/** ensure this file is being included by a parent file */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch ( $task ) {
  case 'view':
    if (@$_GET['section'] == "config")
    TOOLBAR_sh404sef::_NEW();
    else
    TOOLBAR_sh404sef::_DEFAULT();
    break;
  case 'viewMeta':
    TOOLBAR_sh404sef::_META();
    break;
  case 'showconfig':
  case 'edit':
  case 'editMeta':
  case 'newMetaFromSEF':
  case 'homeAlias':
    TOOLBAR_sh404sef::_EDIT();
    break;
  case 'new':
  case 'newMeta':
    TOOLBAR_sh404sef::_NEW();
    break;
  case 'viewDuplicates':
    TOOLBAR_sh404sef::_DUPLICATES();
    break;
  case 'newHomeMeta':
  case 'newHomeMetaFromSEF':
    TOOLBAR_sh404sef::_EDIT_HOME_META($task);
    break;
  case 'info':
    TOOLBAR_sh404sef::_INFO();
    break;
  default:
    break;
}
?>
