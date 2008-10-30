<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class menuJFCEI {

function INFO_MENU() {
mosMenuBar::startTable();
mosMenuBar::back();
mosMenuBar::endTable();
}

function MAIL_MENU() {
mosMenuBar::startTable();
mosMenuBar::back();
mosMenuBar::endTable();
}


function DEFAULT_MENU() {
mosMenuBar::startTable();
mosMenuBar::custom( 'info', 'upload_f2.png', 'upload_f2.png', Install, false );
mosMenuBar::spacer();
mosMenuBar::custom( 'support', 'help_f2.png', 'help_f2.png', Support, false );
mosMenuBar::endTable();
}
}?>
