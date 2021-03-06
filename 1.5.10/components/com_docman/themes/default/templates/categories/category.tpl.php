<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: category.tpl.php 773 2009-01-08 17:38:08Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

/**
 * Default DOCman Theme
 *
 * Creator:  Joomlatools
 * Website:  http://www.joomlatools.eu/
 * Email:    support@joomlatools.eu
 * Revision: 1.4
 * Date:     February 2007
 **/

/*
* Display category details (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->data		(object) : holds the category data
*  $this->links 	(object) : holds the category operations
*  $this->paths 	(object) : holds the category paths
*/
?>

<div class="dm_cat">

<?php
    if($this->data->image) :
        ?><img class="dm_thumb" src="<?php echo $this->paths->thumb; ?>" style="float:<?php echo $this->data->image_position;?>" alt="" /><?php
    endif;

    if($this->data->title != '') :
        ?><div class="dm_name"><?php echo $this->data->title;?></div><?php
    endif;

	if($this->data->description != '') :
		?><div class="dm_description"><?php echo $this->data->description;?></div><?php
	endif;
?>
</div>
<div class="clr"></div>
