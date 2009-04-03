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
* Display the documents list (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items
*	$this->order (object) : holds the document list order information
*/
?>

<?php if(count($this->items)) { ?>
    <table class="blog" cellpadding="0" cellspacing="0" width="100%"><tr><td valign="top">
    	<?php if ($this->theme->conf->title_documents) { ?>
    		<div class="contentheading"><?php echo _DML_TPL_DOCS;?></div>
    	 <?php } ?>
    	<?php
    		/*
    		 * Include the documents list ordering template
    		*/
    		include $this->loadTemplate('documents/list_order.tpl.php'); ?>

    	<table class="contentpaneopen" width="100%">
    		<?php
    		/*
    		 * Include the list_item template and pass the item to it
    		*/
    		foreach($this->items as $item) :
    			$this->doc = &$item; //add item to template variables
    			include $this->loadTemplate('documents/list_item.tpl.php');
    		endforeach;
    		?>
    	</table>
    </td></tr></table>
<?php } else { ?>
    <br />
    <div id="dm_docs">
        <i><?php echo _DML_TPL_NO_DOCS ?></i>
    </div>
<?php } ?>