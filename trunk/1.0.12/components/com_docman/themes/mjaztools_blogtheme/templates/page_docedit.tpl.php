<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_docedit.tpl.php 32 2007-11-06 11:40:26Z mjaz $
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
*	$this->html->docedit (string)(hardcoded, can change in future versions)
*/

global $mainframe;
?>
<script><?php include $this->loadTemplate('scripts/form_docedit.tpl.php'); ?></script>
<?php if ($this->theme->conf->ie_png_fix) {
    $mainframe->addCustomHeadTag( "<!--[if lt IE 7]><script defer type=\"text/javascript\" src=\"" . $this->theme->path . "js/pngfix.js\"></script><![endif]-->");
}?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_EDIT ) ?>

<?php echo $this->plugin('stylesheet', $this->theme->path."css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<?php echo $this->plugin('overlib'); ?>
<?php echo $this->plugin('calendar'); ?>
<?php echo $this->plugin('validator'); ?>


<div class="componentheading"><?php echo _DML_TPL_TITLE_EDIT;?></div>



<ul class="dm_toolbar">
<li><a title="Cancel" class="dm_btn" id="dm_btn_cancel" href="javascript:submitbutton('cancel');" style="border:none;"><?php echo _DML_CANCEL?></a></li>
<li><a title="Save"   class="dm_btn" id="dm_btn_save"   href="javascript:submitbutton('save');" style="border:none;"><?php echo _DML_SAVE?></a></li>
</ul>

<?php echo $this->html->docedit ?>

<div class="clr"></div>

<script language="javascript" type="text/javascript">
<!--
    list = document.getElementById('dmthumbnail');
    img  = document.getElementById('dmthumbnail_preview');
    list.onchange = function() {
        var index = list.selectedIndex;
        if(list.options[index].value!='') {
            img.src = 'images/stories/' + list.options[index].value;
        } else {
            img.src = 'images/blank.png';
        }
    }
//-->
</script>

<?php echo $this->html->menu; ?>