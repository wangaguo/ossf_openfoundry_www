<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: list.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* 
* Display the category list (required)
* 
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items 
*/
?>

<table class="blog" cellpadding="0" cellspacing="0"><tr><td valign="top">
	<?php if ($this->theme->conf->title_categories) { ?>
		<div class="contentheading"><?php echo _DML_TPL_CATS;?></div>
	<?php } ?>
	<table class="contentpaneopen"> 
	<?php
		/* 
		 * Include the list_item template and pass the item to it 
		*/
	  
		foreach($this->items as $item) :
			if($this->theme->conf->cat_empty || $item->data->files != 0) :
				include $this->loadTemplate('categories/list_item.tpl.php');
			endif;
		endforeach;
	?>
	</table>
</td></tr></table>