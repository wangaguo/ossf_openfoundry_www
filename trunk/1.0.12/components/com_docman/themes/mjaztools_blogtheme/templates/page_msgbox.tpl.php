<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: page_msgbox.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* 
* Display a msgbox  (required)
* 
* This template is called when the component is down (configuration setting 
* 'section is down') or when the users hasn't the necessary access permissions.
*
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template Variables :
*	$this->msg (string) : the msg to be displayed
*/
?>

<?php echo $this->plugin('stylesheet', $this->theme->path . "/css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<?php
if ($this->theme->conf->item_tooltip) : 
    echo $this->plugin('overlib');
endif; 

?>

<div id="dm_msgbox">
  	<p><?php echo $this->msg ?></p>
</div>