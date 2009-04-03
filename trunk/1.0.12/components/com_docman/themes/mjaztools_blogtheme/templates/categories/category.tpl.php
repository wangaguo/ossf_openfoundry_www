<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: category.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
* Display category details (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->data		(object) : holds the category data
*  $this->links 	(object) : holds the category operations
*  $this->paths 	(object) : holds the category paths
*/
?>

<div class="dm_cat">


<?php
	if($this->data->title != '') : 
		?><div class="dm_name"><?php echo $this->data->title;?></div><?php
	endif;
	
	if($this->data->description != '') : 
		?><div class="dm_description"><?php echo $this->data->description;?></div><?php
	endif;

	if($this->data->image) : 
		?>
 		<div class="dm_thumb">
			<a href="<?php echo $this->paths->thumb; ?>" target="_blank">
				<img src="<?php echo $this->paths->thumb; ?>" alt="" />
			</a>
		</div>
 		<?php 
 	endif; 
 ?>
	<div class="clr"></div>
</div>
