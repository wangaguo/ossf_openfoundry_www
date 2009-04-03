<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: step_3.tpl.php 32 2007-11-06 11:40:26Z mjaz $
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
*	$this->step (number)  : holds the current step
*
* Preformatted variables :
*	$this->html->docupload (string)(hardcoded, can change in future versions)
*
*/
?>
<?php echo $this->plugin('calendar'); ?>
<?php echo $this->plugin('validator', array('step' => $this->step)); ?>
<script><?php include $this->loadTemplate('scripts/form_docedit.tpl.php'); ?></script>
<style>
	select option.label { background-color: #EEE; border: 1px solid #DDD; color : #333; }
</style>

<p><?php echo _DML_TPL_UPLOAD_STEP." ".$this->step." "._DML_TPL_UPLOAD_OF." 3" ;?></p>

<ul class="dm_toolbar">
<li><a title="Cancel" class="dm_btn" id="dm_btn_cancel" href="javascript:submitbutton('cancel');" style="border:none;"><?php echo _DML_CANCEL?></a></li>
<li><a title="Save"   class="dm_btn" id="dm_btn_save"   href="javascript:submitbutton('save');" style="border:none;"><?php echo _DML_SAVE?></a></li>
</ul>

<?php echo $this->html->docupload ?>

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

