<?php
/**
* PollXT Module for Mambo Open Source 4.5.2
* @Copyright (C) 2004 - 2005 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.mamboxt.com
* @version 1.20
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once($mosConfig_absolute_path."/administrator/components/com_pollxt/pollxt.inc.php");

$xt_resultsId = mosGetParam( $_REQUEST, 'xt_resultsId', 0 );
$option = mosGetParam( $_SERVER, 'QUERY_STRING', 0 );
$option = str_replace ("option=", "", $option);

// resultsID gesetzt -> Aufruf nach voting
if ($xt_resultsId)
pollresult($xt_resultsId, true);
else
// resultsID nicht gesetzt -> normaler Aufruf
show_pollXT_vote_form( $option, false, $Itemid, false, $params );



?> 
