<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_docdetails.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* Display the document details page(required)
* 
* This template is called when u user preform a details operation on a document. 
* 
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Preformatted html variables :
*	$this->html->docdetails (string)(fetched from : documents/document.tpl.php)
*/
?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_DETAILS ) ?>

<?php echo $this->plugin('javascript', $this->theme->path . "js/theme.js") ?>
<?php echo $this->plugin('stylesheet', $this->theme->path . "css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>


<?php if ($this->theme->conf->title_details) { ?>
	<div class="componentheading"><?php echo _DML_TPL_TITLE_DETAILS;?></div>
<?php } ?>


<?php echo $this->html->docdetails ?>


<?php echo $this->html->menu; ?>