<?php
function escapeString ( $string ) {
	global $database;
	
	// doesnt work on my local system - needs some checks
	if (!get_magic_quotes_gpc()) {
		$string = $database->getEscaped( $string );
	}
	return $string;
}

// for J1.5 compatibility
function setTemplateVars( &$tmpl, $pagenav, $link = '', $name = 'admin-list-footer' ) {
		$tmpl->addVar( $name, 'PAGE_LINKS', $pagenav->writePagesLinks( $link ) );
		$tmpl->addVar( $name, 'PAGE_LIST_OPTIONS', $pagenav->getLimitBox( $link ) );
		$tmpl->addVar( $name, 'PAGE_COUNTER', $pagenav->writePagesCounter() );
	}
?>
