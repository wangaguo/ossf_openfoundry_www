<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: document.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
* Display document details (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->data		(object) : holds the document data
*   $this-            >buttons 	(object) : holds the document operations $this-
* >paths (object) : holds the document paths
*/

global $mainframe;
$mainframe->appendPathway( $this->data->dmname );
$mainframe->setPageTitle( _DML_TPL_TITLE_DETAILS . ' | ' . $this->data->dmname );
?>

<?php if ($this->theme->conf->ie_png_fix) {
    $GLOBALS['mainframe']->addCustomHeadTag( "<!--[if lt IE 7]><script defer type=\"text/javascript\" src=\"" . $this->theme->path . "js/pngfix.js\"></script><![endif]-->");
}?>

<?php if ($this->theme->conf->title_details) { ?>
    <div class="contentheading"><?php echo _DML_TPL_DETAILSFOR ?>&nbsp;<?php echo $this->data->dmname ?></div>
<?php } ?>

<?php
if ($this->data->dmthumbnail) {
    ?><img src="<?php echo $this->paths->thumb ?>" alt="<?php echo $this->data->dmname;?>" /><?php
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" summary="<?php echo $this->data->dmname;?>">
    <tr>
        <td width="50%" class="sectiontableheader"><?php echo _DML_PROPERTY?></td>
        <td width="50%" class="sectiontableheader"><?php echo _DML_VALUE?></td>
    </tr>
    <?php
    $k = 0;
    if($this->theme->conf->details_name) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_NAME ?></strong></td>
            <td><?php echo $this->data->dmname ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->dmuploader_shortdesc) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_SHORTDESC?></strong></td>
            <td><?php echo $this->data->params->get('shortdesc') ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_description) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_DESC ?></strong></td>
            <td><?php echo $this->data->dmdescription ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->dmuploader_keywords) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_KEYWORDS?></strong></td>
            <td><?php echo $this->data->params->get('keywords') ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_filename) {
        $k = 1 - $k;
         ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_FNAME ?></strong></td>
            <td><?php echo $this->data->filename ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_filesize) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_FSIZE ?></strong></td>
            <td><?php echo $this->data->filesize ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_filetype) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_FTYPE ?></strong></td>
            <td><?php echo $this->data->filetype ?>&nbsp;(<?php echo _DML_TPL_MIME.":&nbsp;".$this->data->mime ?>)</td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_submitter) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_SUBBY ?></strong></td>
            <td><?php echo $this->data->submited_by ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_created) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_SUBDT ?></strong></td>
            <td>
                 <?php  $this->plugin('dateformat', $this->data->dmdate_published , _DML_TPL_DATEFORMAT_LONG); ?>
            </td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_readers) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_OWNER ?></strong></td>
            <td><?php echo $this->data->owner ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_maintainers) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_MAINT ?></strong></td>
            <td><?php echo $this->data->maintainedby ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_downloads) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_HITS ?></strong></td>
            <td><?php echo $this->data->dmcounter."&nbsp;"._DML_TPL_HITS ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_updated) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_LASTUP ?></strong></td>
            <td>
                <?php  $this->plugin('dateformat', $this->data->dmlastupdateon , _DML_TPL_DATEFORMAT_LONG); ?>
            </td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_homepage) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_HOME ?></strong></td>
            <td><?php echo $this->data->dmurl ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_crc_checksum) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_CRC_CHECKSUM ?></strong></td>
            <td><?php echo $this->data->params->get('crc_checksum'); ?></td>
        </tr>
        <?php
    }
    if($this->theme->conf->details_md5_checksum) {
        $k = 1 - $k;
        ?>
        <tr class="sectiontableentry<?php echo $k+1?>">
            <td><strong><?php echo _DML_TPL_MD5_CHECKSUM ?></strong></td>
            <td><?php echo $this->data->params->get('md5_checksum'); ?></td>
        </tr>
        <?php
    }
    ?>

</table>


<table class="dm_taskbar">
    <tr>
        <?php
            unset($this->buttons['details']);
            $this->doc = &$this;
            include $this->loadTemplate('documents/tasks.tpl.php');
        ?>
    </tr>
</table>