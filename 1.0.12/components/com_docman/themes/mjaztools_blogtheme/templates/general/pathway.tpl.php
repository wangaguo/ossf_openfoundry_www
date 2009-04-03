<?php
/**
 * MjazTools BlogTheme for DOCMan
 * @version      $Id: pathway.tpl.php 32 2007-11-06 11:40:26Z mjaz $
 * @package      mjaztools_blogtheme
 * @copyright    Copyright (C) 2007 MjazTools. All rights reserved.
 * @license      GNU/GPL
 * @link         http://www.mjaztools.com/ MjazTools Official Site
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*
* Display the pathway (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*
* Template variables :
*	$this->links (array) : an array of link objects
*
*/


/*
* Traverse through the links object array and display each link,
* remove the last item of the array and only display it's name.
*
* Link object variables
*	$link->link (string) : url of the link
*	$link->name (string) : name of the link
*	$link->title (string): title of the link
*/
global $mainframe;

if(defined('_DM_J15')){
    $pathway = & $mainframe->getPathWay();
    //$last = array_pop($this->links);
    $first = array_shift($this->links);

    foreach($this->links as $link) {
        $pathway->addItem($link->title, $link->link);
    }
} else {
    $last = array_pop($this->links);
    $first = array_shift($this->links);

    foreach($this->links as $link) :
        ob_start();
        ?><a title="<?php echo $link->title; ?>" href="<?php echo $link->link; ?>">
        <?php echo $link->title; ?></a><?php
        $mainframe->appendPathway( ob_get_clean() );
    endforeach;
    $mainframe->appendPathway( $last->title );
}
