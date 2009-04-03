<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_docmove.tpl.php 32 2007-11-06 11:40:26Z mjaz $
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
*	$this->theme->icon (string) : template icon path
*
* Preformatted variables :
*	$this->html->docmove (string)(hardcoded, can change in future versions)
*/
global $mainframe;
?>

<?php if ($this->theme->conf->ie_png_fix) {
    $mainframe->addCustomHeadTag( "<!--[if lt IE 7]><script defer type=\"text/javascript\" src=\"" . $this->theme->path . "js/pngfix.js\"></script><![endif]-->");
}?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_MOVE ) ?>

<?php echo $this->plugin('stylesheet', $this->theme->path."css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>


<?php if ($this->theme->conf->title_move) { ?>
    <div class="componentheading"><?php echo _DML_TPL_TITLE_MOVE;?></div>
<?php } ?>


<?php echo $this->html->docmove ?>


<div class="dm_taskbar">
    <ul>
        <li><a href="javascript: history.go(-1);"><?php echo _DML_TPL_BACK ?></a></li>
    </ul>
</div>

<?php echo $this->html->menu; ?>