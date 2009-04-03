<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_docsearch.tpl.php 32 2007-11-06 11:40:26Z mjaz $
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
*	$this->html->menu     	(string)(fetched from : general/menu.tpl.php)
*	$this->html->searchform	(string)(hardcoded)
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items
*/
global $mainframe;
$mainframe->appendPathway(_DML_TPL_TITLE_SEARCH);
?>

<?php if ($this->theme->conf->ie_png_fix) {
    $mainframe->addCustomHeadTag( "<!--[if lt IE 7]><script defer type=\"text/javascript\" src=\"" . $this->theme->path . "js/pngfix.js\"></script><![endif]-->");
}?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_SEARCH ) ?>

<?php echo $this->plugin('stylesheet', $this->theme->path . "css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<?php
if ($this->theme->conf->item_tooltip) :
    echo $this->plugin('overlib');
endif;

?>



<div class="componentheading"><?php echo _DML_TPL_TITLE_SEARCH;?></div>



<?php echo $this->html->searchform ?>

<?php
// If we have not items to show return
if (count($this->items) == 0) {
    // show a message if a search term was entered
    if( mosGetParam($_REQUEST, 'search_phrase') ) {
        $_REQUEST['mosmsg'] = _DML_TPL_NO_ITEMS_FOUND;
    }
    echo $this->html->menu;
    return;
}
?>

<hr />

<table class="contentpaneopen" width="100%">
<?php
/*
     * Include the list_item template and pass the item to it
    */
$category = '';
foreach($this->items as $item) :
    $this->doc = &$item; //add item to template variables
    include $this->loadTemplate('documents/list_item.tpl.php');
endforeach;

?>
</table>

<?php echo $this->html->menu; ?>