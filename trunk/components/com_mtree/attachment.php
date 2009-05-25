<?php
/**
* Mosets Tree
*
* @package Mosets Tree 2.0
* @copyright (C) 2007 Lee Cher Yeong
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/


if(file_exists('../../globals.php')) {
	define( "_VALID_MOS", 1 );
	include_once( '../../globals.php' );
	require_once( "../../configuration.php" );
	require_once( $mosConfig_absolute_path . '/includes/database.php' );
} else {
	define( '_JEXEC', 1 );
	define( 'DS', DIRECTORY_SEPARATOR );
	$arrPath = explode(DS,dirname(__FILE__));
	array_pop($arrPath);
	array_pop($arrPath);
	define('JPATH_BASE', implode(DS,$arrPath) );
	
	require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
	require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
	$mainframe =& JFactory::getApplication('site');
	$mainframe->initialise();
	JPluginHelper::importPlugin('system');
}

$field_type = trim(mGetParam( $_REQUEST, 'ft', '' ));
$ordering = intval(mGetParam( $_REQUEST, 'o', 0 ));
$filename = trim(mGetParam( $_REQUEST, 'file', '' ));
$link_id = intval(mGetParam( $_REQUEST, 'link_id', 0 ));
$cf_id = intval(mGetParam( $_REQUEST, 'cf_id', 0 ));
$img_id = intval(mGetParam( $_REQUEST, 'img_id', 0 ));
$size = intval(mGetParam( $_REQUEST, 'size', 0 ));

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );

# Fieldtype's attachment
if ( !empty($field_type) ) {
	if($ordering > 0) {
		$database->setQuery("SELECT fta.* FROM #__mt_fieldtypes_att AS fta "
			.	"LEFT JOIN #__mt_fieldtypes AS ft ON ft.ft_id=fta.ft_id "
			.	"WHERE ft.field_type = '" . getEscaped($field_type) . "' AND ordering = " . $ordering . " LIMIT 1"
			);
	} elseif( !empty($filename) ) {
		$database->setQuery("SELECT fta.* FROM #__mt_fieldtypes_att AS fta "
			.	"LEFT JOIN #__mt_fieldtypes AS ft ON ft.ft_id=fta.ft_id "
			.	"WHERE ft.field_type = '" . getEscaped($field_type) . "' AND fta.filename = '" . $filename . "' LIMIT 1"
			);
	}
	$database->loadObject($attachment);

# Custom field's attachment
} elseif( $link_id > 0 && $cf_id > 0) {
	$database->setQuery("SELECT cfva.* FROM #__mt_cfvalues_att AS cfva "
		.	"WHERE cfva.link_id = '" . $link_id . "' && cf_id = '" . $cf_id . "' LIMIT 1"
		);
	$database->loadObject($attachment);

}


if (!empty($attachment)) {
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header('Cache-Control: max-age=86400'); // Cache for 24 hours
	header("Content-type: ".$attachment->extension);
	if($attachment->filesize>0) {
		header("Content-length: ".$attachment->filesize);
	}
	header("Content-Disposition: inline; filename=".$attachment->filename);
	header('Content-transfer-encoding: binary');
	header("Connection: close");
	echo $attachment->filedata;
}

function getEscaped( $text ) {
	return mysql_escape_string($text);
}
function mGetParam( &$array, $key, $default ) {
	if(array_key_exists($key,$array)) {
		$value = $array[$key];
	} else {
		$value = $default;
	}
	if (!get_magic_quotes_gpc()) {
		$value = addslashes($value);
	}
	return $value;
}
?>