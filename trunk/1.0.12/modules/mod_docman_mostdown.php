<?php
/**
 * DOCman Most Downloaded 1.4.x
 * @version $Id: mod_docman_mostdown.php 413 2007-10-18 18:48:15Z mjaz $
 * @package DOCmanModules_1.4
 * @copyright (C) 2003-2007 The DOCman Development Team
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.org/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

// you can define the following parameters at administration:

// limits = number of downloads to display (default = 3);
// show_icon = displays a generic icon near the name of the document, using the theme defined (default = 1) No=0; Yes=1
// show_counter = displays the number of downloads (default = 1) No=0; Yes=1


include_once( $mosConfig_absolute_path."/administrator/components/com_docman/docman.class.php");

//DOCman core interaction API
global $_DOCMAN, $_DMUSER;
if(!is_object($_DOCMAN)) {
    $_DOCMAN = new dmMainFrame();
    $_DMUSER = $_DOCMAN->getUser();
}

$_DOCMAN->setType(_DM_TYPE_MODULE);
$_DOCMAN->loadLanguage('modules');

require_once($_DOCMAN->getPath('classes', 'utils'));
require_once($_DOCMAN->getPath('classes', 'file'));
require_once($_DOCMAN->getPath('classes', 'model'));

// get the parameters
$limits  		= abs($params->def( 'limits', 3 ));
$show_icon 		= abs($params->def( 'show_icon', 1 ));
$show_counter	= abs($params->def( 'show_counter', 1 ));

$menuid = $_DOCMAN->getMenuId();

$html = '';

$rows = DOCMAN_Docs::getDocsByUserAccess(0, 'hits', 'DESC', $limits);

if (count($rows)) {
    $html .='<ul class="dm_mod_mostdown">';
    foreach ($rows as $row)
    {
        $doc = new DOCMAN_Document($row->id);

    	$url = sefRelToAbs( "index.php?option=com_docman&task=cat_view&Itemid=$menuid&gid={$row->catid}" );
    	$html .= '<li><a href="'.$url.'">';

        if ($show_icon)
        	$html .= '<img border="0" src="'.$doc->getPath('icon', 1, '16x16').'" alt="file icon" />';

        $html .= $doc->getData('dmname');

    	if ($show_counter)
    		$html .= ' ('.$doc->getData('dmcounter').')';

    	$html .= '</a></li>';
    }
    $html .= '</ul>';
} else {
	$html .= "<br />"._DML_MOD_NODOCUMENTS;
}

echo $html;