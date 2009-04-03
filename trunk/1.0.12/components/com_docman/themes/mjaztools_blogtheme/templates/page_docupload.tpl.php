<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_docupload.tpl.php 32 2007-11-06 11:40:26Z mjaz $
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
global $mainframe;
?>

<?php if ($this->theme->conf->ie_png_fix) {
    $mainframe->addCustomHeadTag( "<!--[if lt IE 7]><script defer type=\"text/javascript\" src=\"" . $this->theme->path . "js/pngfix.js\"></script><![endif]-->");
}?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_UPLOAD ) ?>

<?php echo $this->plugin('stylesheet', $this->theme->path."css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>
      
<?php echo $this->plugin('overlib'); ?>



<?php
if($this->update) :
?><div class="componentheading"><?php echo _DML_TPL_TITLE_UPDATE;?></div><?php
else :
?><div class="componentheading"><?php echo _DML_TPL_TITLE_UPLOAD;?></div><?php
endif;
?>



<?php
switch($this->step) :
    case '1' :  include $this->loadTemplate('upload/step_1.tpl.php');  break;
    case '2' :  include $this->loadTemplate('upload/step_2.tpl.php');  break;
    case '3' :  include $this->loadTemplate('upload/step_3.tpl.php');  break;
endswitch;
?>

<?php echo $this->html->menu; ?>