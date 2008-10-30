
<?php

/**
* @copyright (C) 2007 Joshprakash.com
* @author Josh Prakash
*
* --------------------------------------------------------------------------------
* All rights reserved.  Docman module for Joomla!

* @version $Id: mod_docmancat.php 2007-08-2 joshprakash $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/


// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mainframe,$Itemid;


$count 		= intval( $params->get( 'count', 7 ) );
$access 	= !$mainframe->getCfg( 'shownoauth' );
/* Query to retrieve all categories that belong under the docman section and that are published. */
	$query = "SELECT cc.*, a.catid, COUNT(a.id) AS numlinks"
	. "\n FROM #__categories AS cc"
	. "\n LEFT JOIN #__docman AS a ON a.catid = cc.id"
	. "\n WHERE a.published = 1"
	. "\n AND section = 'com_docman'"
	. "\n AND cc.published = 1"
	. "\n AND cc.access <= " . (int) $my->gid
	. "\n GROUP BY cc.id"
	. "\n ORDER BY cc.ordering"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();


// Output
?>
<ul class="docmancat<?php echo $moduleclass_sfx; ?>">
<?php
foreach ( $rows as $row ) {


	$link = 'index.php?option=com_docman&amp;task=cat_view&amp;gid='. $row->id .'&amp;Itemid='. $Itemid;
	?>
	<li>
		<a href="<?php echo sefRelToAbs( $link ); ?>" class="category<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<?php echo stripslashes( $row->name );?>
		</a>
		&nbsp;
		<span class="small">
		(<?php echo $row->numlinks;?>)
		</span>
	</li>
	<?php
}
?>
</ul>