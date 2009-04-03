<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: tasks.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
* Display the document tasks (called by document/list_item.tpl.php and documents/document.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->doc->links (object) : holds the tasks a user can preform on a document
*/

foreach($this->doc->buttons as $button) {
    $popup = ($button->params->get('popup', false)) ? 'type="popup"' : '';
    $attr = '';
    if($class = $button->params->get('class', '')) {
        $attr = 'class="' . $class . '"';
    }
    ?><td>
        <a style="font-size:9px;" href="<?php echo $button->link?>" <?php echo $attr?>>
            <?php echo $button->text ?>
        </a>
    </td><?php
}

/*
if ( $this->theme->conf->task_details ) :
	if( $this->doc->links->details ) :
		?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->details?>"><?php echo _DML_TPL_DOC_DETAILS ?></a></td><?php
    endif;
endif;
if ( $this->theme->conf->task_download ) :
	if( $this->doc->links->download  ) :
		?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->download ?>"><?php echo _DML_TPL_DOC_DOWNLOAD ?></a></td><?php
	endif;
endif;
if ( $this->theme->conf->task_view ) :
	if( $this->doc->links->view ) :
		?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->view ?>" type="popup"><?php echo _DML_TPL_DOC_VIEW ?></a></td><?php
	endif;
endif;

if( $this->doc->links->edit) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->edit ?>"><?php echo _DML_TPL_DOC_EDIT ?></a></td><?php
endif;

if( $this->doc->links->checkout) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->checkout ?>"><?php echo _DML_TPL_DOC_CHECKOUT ?></a></td><?php
endif;

if( $this->doc->links->checkin ) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->checkin ?>"><?php echo _DML_TPL_DOC_CHECKIN ?></a></td><?php
endif;

if( $this->doc->links->reset  ) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->reset ?>"><?php echo _DML_TPL_DOC_RESET ?></a></td><?php
endif;

if( $this->doc->links->move ) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->move ?>"><?php echo _DML_TPL_DOC_MOVE ?></a></td><?php
endif;

if( $this->doc->links->delete ) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->delete ?>"><?php echo _DML_TPL_DOC_DELETE ?></a></td><?php
endif;

if( $this->doc->links->update ) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->update ?>"><?php echo _DML_TPL_DOC_UPDATE ?></a></td><?php
endif;

if( $this->doc->links->approve) :
	?><td><a style="font-size:9px;" class="approve" href="<?php echo $this->doc->links->approve ?>"><?php echo _DML_TPL_DOC_APPROVE ?></a></td><?php
endif;

if( $this->doc->links->unpublish  ) :
	?><td><a style="font-size:9px;" href="<?php echo $this->doc->links->unpublish ?>"><?php echo _DML_TPL_DOC_UNPUBLISH ?></a></td><?php
endif;

if( $this->doc->links->publish) :
	?><td><a style="font-size:9px;" class="publish" href="<?php echo $this->doc->links->publish ?>"><?php echo _DML_TPL_DOC_PUBLISH ?></a></td><?php
endif;
*/