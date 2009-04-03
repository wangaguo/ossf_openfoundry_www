<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: menu.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
* Display the menu (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->links (object) : holds the different menu links
*   $this->perms (number) : upload user permissions
*
*/

function blogtheme_dmuploaderLink($data) {
    if( $data->theme->conf->dmuploader_button ) { // is Uploader support set in the theme config?
            global $database, $my;
            $query = "SELECT id FROM #__menu "
                    ."\n WHERE link = 'index.php?option=com_dmuploader' "
                    ."\n AND published = 1"
                    ."\n AND access <= " . $my->gid;
            $database->setQuery( $query );
            $rows = $database->loadObjectList();

            // try to auto detect component Itemid
            if ( count( $rows ) ) {
                $_Itemid    = $rows[0]->id;
                return 'index.php?option=com_dmuploader&amp;Itemid='. $_Itemid;
            }
    }
    return false;
}
?>

<br />
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
    <?php
    if($this->theme->conf->menu_home) :
        ?>
        <td valign="top" width="33%" align="center">
            <a href="<?php echo $this->links->home;?>" style="border:none">
                <img src="<?php echo $this->theme->icon;?>home.png" alt="<?php echo _DML_TPL_CAT_VIEW;?>" width="64" height="64" /><br />
                <?php echo _DML_TPL_CAT_VIEW;?>
            </a>
        </td>
        <?php
    endif;
    if($this->theme->conf->menu_search) :
        ?>
        <td valign="top" width="33%" align="center">
            <a href="<?php echo $this->links->search;?>" style="border:none">
                <img src="<?php echo $this->theme->icon;?>search.png" alt="<?php echo _DML_TPL_SEARCH_DOC;?>" width="64" height="64"/><br />
                <?php echo _DML_TPL_SEARCH_DOC;?>
            </a>
        </td>
        <?php
    endif;
        /*
         * Check to upload permissions and show the appropriate icon/text
         * Values for $this->perms->upload
         *		- DM_TPL_AUTHORIZED 	: the user is authorized to upload
         *		- DM_TPL_NOT_LOGGED_IN  : the user isn't logged in
         *		- DM_TPL_NOT_AUTHORIZED : the user isn't authorized to upload
        */
        /* Added v1.1.0 check if MjazTools Uploader is available in the menu*/
    if( $dmuploaderLink = blogtheme_dmuploaderLink($this) ) {?>
        <td valign="top" width="34%" align="center">
            <a href="<?php echo $dmuploaderLink;?>" style="border:none">
                <img src="<?php echo $this->theme->icon;?>submit.png" alt="<?php echo _DML_TPL_SUBMIT;?>" width="64" height="64"/><br />
                <?php echo _DML_TPL_SUBMIT;?>
            </a>
        </td> <?php
    } elseif($this->theme->conf->menu_upload) {
        switch($this->perms->upload) :
            case DM_TPL_AUTHORIZED : ?>
                <td valign="top" width="34%" align="center">
                    <a href="<?php echo $this->links->upload;?>" style="border:none">
                        <img src="<?php echo $this->theme->icon;?>submit.png" alt="<?php echo _DML_TPL_SUBMIT;?>" width="64" height="64"/><br />
                        <?php echo _DML_TPL_SUBMIT;?>
                    </a>
                </td> <?php
                break;
        endswitch;
    } // if
        ?>
</tr>
</table>