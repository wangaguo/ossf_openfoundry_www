<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: pagenav.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
* Display the pagenav (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->pagenav (object) : the pagenav object
*	$this->link    (nuber)  : the full page link
*
*/
?>

<div id="dm_nav">
<?php echo $this->pagenav->writePagesLinks( $this->link );?>
	<div>
	<?php echo $this->pagenav->writePagesCounter();?>
	</div>
</div>

