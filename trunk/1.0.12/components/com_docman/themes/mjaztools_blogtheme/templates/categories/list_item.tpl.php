<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: list_item.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* 
* Display a category list item (called by categories/list.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$item->data		(object) : holds the category data
*  $item->links 	(object) : holds the category operations
*  $item->paths 	(object) : holds the category paths      
*/



if (!$item->data->image OR $item->data->image == "") {
	$myImage = $item->paths->icon;
} else {
	$myImage = $item->paths->thumb;
}

?>
<tr>

	<td valign="top" width="<?php echo $this->theme->conf->doc_image_width;?>" >
		<a href="<?php echo $item->links->view;?>">
			<img src="<?php echo $myImage;?>" alt="<?php echo $item->data->name;?>" align="right" width="<?php echo $this->theme->conf->doc_image_width;?>" height="<?php echo $this->theme->conf->doc_image_width;?>" />
		</a>
	</td>

	<td valign="top">
		<table class="contentpaneopen">
			<tr>
				<td class="contentheading" width="100%">
					<a class="contentpagetitle" href="<?php echo $item->links->view;?>"><?php echo $item->data->name;?></a>
				</td>
			</tr>

			<?php if ( $this->theme->conf->catitem_files  ) { ?>
			<tr width="100%">
				<td valign="top" colspan="2" class="small">
					<?php echo _DML_TPL_FILES . ': ' . $item->data->files;?>
				</td>
			</tr>
			<?php } ?>

			<?php if ( $this->theme->conf->catitem_description  ) { ?>
			<tr>
				<td valign="top" >

					<?php
						if($item->data->description != '') {
							?><?php echo $item->data->description;?><br /><?php
						}?>
				</td>
			</tr>
			<?php } ?>
		</table>

		<span class="article_seperator">&#160;</span>
	 </td>
 
 </tr>