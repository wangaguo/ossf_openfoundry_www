<?php
/**
 * docman13rc2_patch
 * @version $Id: install.docman13rc2_patch.php 248 2007-09-01 10:44:17Z mjaz $
 * @package docman13rc2_patch
 * @copyright (C) 2003-2007 The DOCman Development Team
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.org/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

function com_install() {
    global $mosConfig_absolute_path;
    $msgs = array();

    // Defines
    if( !defined('DS') ) define('DS', DIRECTORY_SEPARATOR );
    define('_DMPATCH_FROM_VERSION'      , '1.3 RC2');
    define('_DMPATCH_TO_VERSION'        , '1.3 RC2.1 PATCHED');
    define('_DMPATCH_PATH'              , dirname(__FILE__));
    define('_DMPATCH_PATCHFILES_PATH'   , _DMPATCH_PATH.DS.'patchfiles');
    define('_DMPATCH_DOCMAN_PATH'       , $mosConfig_absolute_path.DS.'administrator'.DS.'components'.DS.'com_docman');


    // Patch files and their destinations
    $patchfiles = array(
        _DMPATCH_PATCHFILES_PATH.DS.'docman.xml.~patch' => _DMPATCH_DOCMAN_PATH.DS.'docman.xml',
        _DMPATCH_PATCHFILES_PATH.DS.'admin.docman.php.~patch' => _DMPATCH_DOCMAN_PATH.DS.'admin.docman.php'
        );


    // Check if DOCman is installed
    if( !file_exists(_DMPATCH_DOCMAN_PATH.DS.'docman.config.php')) {
        return "<hr />Couldn't find DOCman. Aborting patch.";
    }


    // Get DOCman config and version
    require_once(_DMPATCH_DOCMAN_PATH.DS.'classes'.DS.'DOCMAN_config.class.php');
    $dmconfig = new DOCMAN_Config( 'dmConfig', _DMPATCH_DOCMAN_PATH.DS.'docman.config.php' );
    $dmversion  = $dmconfig->getCfg( 'docman_version', false );


    // Check if a version was found
    if( !$dmversion ) {
    	return '<hr />No version info was found. Aborting patch.';
    }


    // Check if DOCman is already patched
    if( $dmversion == _DMPATCH_TO_VERSION ) {
    	return '<hr />DOCman is already patched. Aborting patch.';
    }


    // Check if it's the right version
    switch( version_compare( $dmversion, _DMPATCH_FROM_VERSION ) ) {
    	case -1:
        default:
            return '<hr />Please upgrade to DOCman v'._DMPATCH_FROM_VERSION.' before using this patch. You are using v'.$dmversion.'. Aborting patch.';
            break;
        case 1:
            return '<hr />You are already using DOCman v'.$dmversion.'. '.
                 'This patch is only needed for DOCman v'._DMPATCH_FROM_VERSION.'. Aborting patch.';
            break;
        case 0:
            $msgs[] = 'Patching DOCman v.'._DMPATCH_FROM_VERSION.' to v'._DMPATCH_TO_VERSION.' ...';
            break;
    }


    // Patch the files
    foreach( $patchfiles as $src=>$dest ){
        // Backup original file
    	if( file_exists($dest)) {
    		$msgs[] = ( @rename( $dest, $dest.'.~bak' ) ) ? "Succesfully backed up $dest" : "Failed backing up $dest";
    	}
        // Copy patched file
        $msgs[] = ( rename( $src, $dest )) ? "Succesfully copied $src to $dest" : "Failed copying $src to $dest";
    }


    // Change DOCman version
    $dmconfig->setCfg( 'docman_version', _DMPATCH_TO_VERSION );
    $msgs[] = $dmconfig->saveConfig() ? "Saved new version v"._DMPATCH_TO_VERSION : "Failed saving new version";


    // Return messages
    return '<hr /><ul><li>'.implode( '</li><li>', $msgs ).'</li></ul>'.'Finished patching!';
}
