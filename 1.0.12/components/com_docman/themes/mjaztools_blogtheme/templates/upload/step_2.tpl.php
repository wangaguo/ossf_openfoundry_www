<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: step_2.tpl.php 32 2007-11-06 11:40:26Z mjaz $
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
<p><?php echo _DML_TPL_UPLOAD_STEP." ".$this->step." "._DML_TPL_UPLOAD_OF." 3" ;?></p>

<p>
<?php 
switch($this->method) :
	case 'http' 	: 	echo _DML_TPL_UPLOAD; break;
	case 'transfer' : 	echo _DML_TPL_TRANSFER; break;
	case 'link'     :	echo _DML_TPL_LINK; break;
	default : break;
endswitch;
?>
</p>

<?php echo $this->html->docupload ?>

