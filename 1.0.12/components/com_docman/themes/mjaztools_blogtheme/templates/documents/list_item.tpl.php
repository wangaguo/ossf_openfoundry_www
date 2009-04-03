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
* Display a documents list item (called by document/list.tpl.php)
*
* This template is called when u user preform browse the docman
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path


* Template variables :
*   $this->doc->data  (object) : holds the document data
*   $this->doc->links (object) : holds the document operations
*   $this->doc->paths (object) : holds the document paths
*/



// image
$myImage = $this->doc->data->dmthumbnail ? $this->doc->paths->thumb : $this->doc->paths->icon;

//unapproved or unpublished
if(!$this->doc->data->approved) :
	$myPubApp = " class=\"dm_unapproved\" ";
elseif(!$this->doc->data->published) :
	$myPubApp = " class=\"dm_unpublished\" ";
else :
	$myPubApp = "";
endif;


//State
$myState = $this->doc->data->state ? $this->doc->data->state : "";


/*
// fix for an issue where unregistered users get links to 'http://www.mydomain.com/0'
if ($this->doc->links->download) {
	$anchor = '<a href="' . $this->doc->links->download . '">';
	$anchor_cl = '<a href="' . $this->doc->links->download . '" class="contentpagetitle" >';
	$_anchor = '</a>';
} else {
	$anchor = '';
	$anchor = '';
}
*/
//Better fix with new feature in 1.0.3: unregistered_url
// if the download url is not set, replace it with the one defined by the user

if ( $this->doc->buttons['download'] ) {
	$download_url = $this->doc->buttons['download']->link;
} else {
	$download_url = $this->theme->conf->unregistered_url;
}


?>


<tr>
	<td valign="top" width="<?php echo $this->theme->conf->doc_image_width;?>" >
		<a href="<?php echo $download_url; ?>">
			<span <?php echo $myPubApp?>>
			<img src="<?php echo $myImage?>" alt="<?php echo $this->doc->data->dmname;?>" class="mosimage" style="border:none" align="right" width="<?php echo $this->theme->conf->doc_image_width;?>" height="<?php echo $this->theme->conf->doc_image_width;?>"/>
			</span>
		</a>
	</td>

	<td valign="top" width="100%">
		<table class="contentpaneopen" width="100%">

			<tr>
				<td class="contentheading" width="100%">
					<a href="<?php echo $download_url; ?>" class="contentpagetitle">
						<span <?php echo $myPubApp?>><?php echo $this->doc->data->dmname; ?></span>
					</a>

					<span class="small"><?php echo $myState ?></span>


					<?php if($this->theme->conf->item_tooltip) {
							$this->item = &$this->doc;
							$tooltip = $this->fetch('documents/tooltip.tpl.php');
							$icon    = $this->theme->path."images/tooltip.gif";
							echo $this->plugin('tooltip',  $this->doc->data->id, 'Info', $tooltip, $icon);
					}?>


				</td>
			</tr>

			<?php if ( $this->theme->conf->item_hits  ) { ?>
			<tr width="100%">
				<td valign="top" colspan="2" class="small">
					<?php echo _DML_TPL_HITS . ": " . $this->doc->data->dmcounter ?>
				</td>
			</tr>
			<?php } ?>

			<tr width="100%">
				<td valign="top" colspan="2" class="createdate">
					<?php echo _DML_TPL_DATEADDED;?>: <?php $this->plugin('dateformat', $this->doc->data->dmdate_published, _DML_TPL_DATEFORMAT_SHORT); ?>
				</td>
			</tr>

			<?php if ( $this->theme->conf->item_description  ) { ?>
			<tr width="100%">
				<td valign="top" >
					<?php echo $this->doc->data->dmdescription;?>
				</td>
			</tr>
			<?php } ?>


			<?php if ( $this->theme->conf->item_homepage && $this->doc->data->dmurl != '') {?>
			<tr width="100%">
				<td valign="top" colspan="2" class="small">
					<?php echo _DML_TPL_HOMEPAGE;?>: <a href="<?php echo $this->doc->data->dmurl;?>"><?php echo $this->doc->data->dmurl;?></a>
				</tr>
			</tr>
			<?php } ?>

			<tr width="100%">
				<td valign="top" width="100px">
					<table class="dm_taskbar">
						<tr>
							<?php include $this->loadTemplate('documents/tasks.tpl.php');  ?>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<span class="article_seperator">&#160;</span>
	</td>

 </tr>




