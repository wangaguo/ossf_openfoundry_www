<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 2.0
* @copyright (C) 2007-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/linkchecker.mtree.html.php' );

$task2 = strval( mosGetParam( $_REQUEST, 'task2', '' ) );
$updateurl = mosGetParam( $_REQUEST, 'updateurl', '' );
$newurl = mosGetParam( $_REQUEST, 'newurl', '' );
$field = mosGetParam( $_REQUEST, 'field', '' );
$config_num_of_links = intval(mosGetParam( $_REQUEST, 'linkchecker_num_of_links', '' ));
$config_seconds = intval(mosGetParam( $_REQUEST, 'linkchecker_seconds', '' ));

switch( $task2 ) {
	case 'linkchecker2':
		linkChecker2( $option, $updateurl, $field, $newurl, $config_num_of_links, $config_seconds );
		break;
	default:
		linkChecker( $option );
		break;
}

function linkChecker2( $option, $updateurl, $field, $newurl, $config_num_of_links, $config_seconds ) {
	global $database;

	$updated=0;
	if(count($updateurl)>0 && !empty($updateurl)){
		foreach($updateurl AS $id => $link_id) {
			if( !empty($newurl[$id]) && $newurl[$id] != 'http://' && !empty($field[$id])) {
				$database->setQuery( 'UPDATE #__mt_links SET '.$field[$id].' = \''.$newurl[$id].'\' WHERE link_id = '.$link_id.' LIMIT 1' );
				if($database->query()){
					$updated++;  
				}
			}	
		}
	}
	
	if( $config_num_of_links > 0 ) {
		$database->setQuery('UPDATE #__mt_config SET value = '.$config_num_of_links.' WHERE varname =\'linkchecker_num_of_links\' LIMIT 1');
		$database->query();
	}
	
	if( $config_seconds > 0 ) {
		$database->setQuery('UPDATE #__mt_config SET value = '.$config_seconds.' WHERE varname =\'linkchecker_seconds\' LIMIT 1');
		$database->query();
	}
	
	mosRedirect( "index2.php?option=$option&task=linkchecker", sprintf("%d links has been succesfully updated.",$updated) );

}

function linkChecker( $option ) {
	global $database;
	
	$database->setQuery( 'SELECT link_id, link_name, website FROM #__mt_links WHERE website LIKE \'http://%\'' );
	$links = $database->loadObjectList( 'link_id' );
	
	$database->setQuery( 'SELECT l.link_id, l.link_name, cfv.value AS website FROM #__mt_cfvalues AS cfv '
		. ' LEFT JOIN #__mt_customfields AS cf ON cf.cf_id = cfv.cf_id'
		. ' LEFT JOIN #__mt_links AS l ON l.link_id = cfv.link_id'
		. ' WHERE cf.field_type = \'weblink\''
		. ' AND cfv.value LIKE \'http://%\'' );
	array_merge( $links, $database->loadObjectList( 'link_id' ) );

	$database->setQuery('TRUNCATE TABLE #__mt_linkcheck');
	$database->query();

	foreach( $links AS $link ){
		$value = $link->website;
		if(!empty($value)){
			if( substr($value,0,7) == 'http://' ) {
				$website = substr($value,7);
			} else {
				$website = $value;
			}
			if( strpos($website,'/') !== false ) {
				$domain = substr($website,0,strpos($website,'/'));
				$path = substr($website,strpos($website,'/'));
			} else {
				$domain = $website;
				$path = '/';
			}
			$database->setQuery( 'INSERT INTO #__mt_linkcheck (`link_id`, `link_name`,`domain`,`path`) VALUES('.$link->link_id.', \''.$database->getEscaped($link->link_name) .'\', \''.$domain.'\', \''.$path.'\')' );
			$database->query();
		}
	}
	$database->setQuery( 'SELECT COUNT(*) FROM #__mt_linkcheck' );
	$count = $database->loadResult();
	
	$database->setQuery( 'SELECT varname, value FROM #__mt_config WHERE groupname = \'linkchecker\'' );
	$config = $database->loadObjectList('varname');
	
	HTML_mtlinkchecker::linkChecker( $option, $count, $config );
}
?>