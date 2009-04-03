<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: script_docupload.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* 
* Display the upload document form (required)
* 
* This template is called when u user preform a upload operation on a document. 
* 
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->step   (number)  : holds the current step
*   $this->update (boolean) : true, if we are updating a document
*   $this->method (string)  : hols the upload method used (http, link or transfer)
*
* Preformatted variables :
*	$this->html->docupload (string)(hardcoded, can change in future versions)
*
*/
?>
<?php
switch($this->step) :
	case '1' :  break;
	case '2' :  break;
	case '3' :  include $this->loadTemplate('scripts/form_docedit.tpl.php');  break;
endswitch;
?>