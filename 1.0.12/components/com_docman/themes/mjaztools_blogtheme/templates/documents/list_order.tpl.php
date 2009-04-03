<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: list_order.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
* Display the documents list ordering (called by document/list.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->order->links     (array)  : holds an array of order by task links
*  $this->order->orderby   (string) : current orderby setting
*  $this->order->direction (string) : current order direction
*/
?>
<div class="small"> <?php echo _DML_TPL_ORDER_BY ?> :
<?php
	if($this->order->orderby != 'name') :
		?><a href="<?php echo $this->order->links['name'] ?>"><?php echo _DML_TPL_ORDER_NAME ?></a> | <?php
	else :
 		?><strong><?php echo _DML_TPL_ORDER_NAME ?> </strong> | <?php
 	endif;

	if($this->order->orderby != 'date') :
 		?><a href="<?php echo $this->order->links['date'] ?>"><?php echo _DML_TPL_ORDER_DATE ?></a> | <?php
 	else :
 		?><strong><?php echo _DML_TPL_ORDER_DATE ?> </strong> | <?php
 	endif;

 	if($this->order->orderby != 'hits') :
 		?><a href="<?php echo $this->order->links['hits'] ?>"><?php echo _DML_TPL_ORDER_HITS ?></a> <?php
 	else :
 		?><strong><?php echo _DML_TPL_ORDER_HITS ?> </strong> | <?php
 	endif;

	if ($this->order->direction == 'ASC') :
		?><a href="<?php echo $this->order->links['dir'] ?>">[ <?php echo _DML_TPL_ORDER_DESCENT ?> ]</a><?php
   	else :
       	 ?><a href="<?php echo $this->order->links['dir'] ?>">[ <?php echo _DML_TPL_ORDER_ASCENT ?> ]</a><?php
    endif;
?>
</div>