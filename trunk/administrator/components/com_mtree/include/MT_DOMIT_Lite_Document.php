<?php
/**
* @version 1.00
* @copyright (C) 2007 Lee Cher Yeong. All rights reserved
* @license http://www.gnu.org/copyleft/lesser.html LGPL License
**/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mtconf->getjconf('absolute_path') . '/includes/domit/xml_domit_lite_include.php' );

class MT_DOMIT_Lite_Document extends DOMIT_Lite_Document {
	function loadXMLFromText($xmlText, $useSAXY = true, $preserveCDATA = true, $fireLoadEvent = false) {
		return $this->parseXML($xmlText, $useSAXY, $preserveCDATA, $fireLoadEvent);
	} //loadXML
}
?>