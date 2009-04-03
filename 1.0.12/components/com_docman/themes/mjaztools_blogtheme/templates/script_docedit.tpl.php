<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: script_docedit.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* 
* Display the move document form (required)
* 
* This template is called when u user preform a move operation on a document. 
* 
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon 
*   $this->theme->png  (boolean): browser png transparency support
*	
*/
?>
<?php include $this->loadTemplate('scripts/form_docedit.tpl.php'); ?>