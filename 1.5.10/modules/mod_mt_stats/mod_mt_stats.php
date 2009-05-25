<?php
/**
* Mosets Tree Stats
*
* @package Mosets Tree 2.00
* @copyright (C) 2005-2007 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

# Get params
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx' );
$caption = $params->get( 'caption', 'There are %s listing and %s categories in our website' ); // Default is new listing

# Get totals
global $mosConfig_offset;
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

$database->setQuery( "SELECT COUNT(*) FROM #__mt_links " 
		.	"\n WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
);

$total_links = $database->loadResult();

$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats " 
		.	"\n WHERE cat_published='1' && cat_approved='1' "
);

$total_cats = $database->loadResult();

echo sprintf($caption, $total_links, $total_cats);