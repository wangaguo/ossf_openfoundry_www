<?php
/**
* Mosets Tree Last Update
*
* @package Mosets Tree 2.00
* @copyright (C) 2005-2007 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

# Get params
$caption = $params->get( 'caption', 'Directory last update: %s' );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );

# Get totals
global $mosConfig_offset;
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

$database->setQuery( "SELECT MAX(link_modified) FROM #__mt_links " 
		.	"\n WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
);

$last_update = $database->loadResult();

echo sprintf($caption, $last_update);