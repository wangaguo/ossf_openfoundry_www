<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {
   case "info":
      menuJFCEI::INFO_MENU();
      break;
      
   case "sendmemail":
      menuJFCEI::MAIL_MENU();
      break;

   default:
      menuJFCEI::DEFAULT_MENU();
      break;
}
?>
