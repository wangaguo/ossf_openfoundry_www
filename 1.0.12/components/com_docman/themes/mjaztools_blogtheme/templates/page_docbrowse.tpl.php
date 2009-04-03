<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_docbrowse.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* Display the documents overview (required)
*
* This template is called when u user preform browse the docman
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Preformatted html variables :
*	$this->html->menu     (string)(fetched from : general/menu.tpl.php)
*	$this->html->pathway  (string)(fetched from : general/pathway.tpl.php)
*	$this->html->category (string)(fetched from : categories/category.tpl.php)
*	$this->html->cat_list (string)(fetched from : categories/list.tpl.php)
*	$this->html->doc_list (string)(fetched from : documents/list.tpl.php)
*	$this->html->pagenav  (string)(fetched from : general/pagenav.tpl.php)
*	$this->html->pagetitle(string)(fetched from : general/pagetitle.tpl.php)
*/

global $mainframe;
?>


<?php $this->splugin('pagetitle', _DML_TPL_TITLE_BROWSE.$this->html->pagetitle ) ?>

<?php echo $this->plugin('stylesheet', $this->theme->path . "css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<?php echo $this->plugin('javascript', $this->theme->path . "js/theme.js") ?>

<?php if ($this->theme->conf->ie_png_fix) {
    $mainframe->addCustomHeadTag( "<!--[if lt IE 7]><script defer type=\"text/javascript\" src=\"" . $this->theme->path . "js/pngfix.js\"></script><![endif]-->");
}?>

<?php echo $this->plugin('overlib'); ?>

<?php if ($this->theme->conf->title_downloads) { ?>
    <div class="componentheading"><?php echo _DML_TPL_TITLE_BROWSE;?></div>
<?php } ?>

<?php echo $this->html->category; ?>

<?php echo $this->html->cat_list; ?>

<?php echo $this->html->doc_list; ?>

<?php echo $this->html->pagenav; ?>

<?php echo $this->html->menu; ?>