<?php
/// $Id: mod_visitors_counter.php, v2.0 2004/09/25 20:56:34 DJesus Exp $
/**
* Visitors Counter
* @ package Mambo Open Source
* @ Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ Author : DJesus - www.TEGDesign.ch
* @ version $Revision: 2.0 $
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$content = "";

// *** Get Params
$hitsonly = $params->get( 'hitsonly' );
$pretext = $params->get( 'pretext' );
$posttext = $params->get( 'posttext' );
if (!$posttext && !$posttext) { $posttext = _VISITORS; }
$increase = intval( $params->get( 'increase' ) ); // convert to number
$style = intval( $params->get( 'style' ) ); // convert to number

$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

// *** Retrieve DB statisitcs : [1 : Agents/Browsers]
$query = "SELECT sum(hits) AS count FROM #__stats_agents WHERE type='1'";
$database->setQuery( $query );
$hits = $database->loadResult();

if ($hits == NULL) { $hits = 0; }
$hits = $hits + $increase;   // Increase the counter if needed... (use old value, of simulate high traffic...)

// *** Display the Hits
$content .= '<div';
if ($style == 0) { $content .= ' align="left"'; }
if ($style == 1) { $content .= ' align="center"'; }
if ($style == 2) { $content .= ' align="right"'; }
$content .= '>';

if ($pretext && !$hitsonly) { $content .= $pretext." "; }
$content .= $hits;
if ($posttext && !$hitsonly) { $content .= " ".$posttext; }

$content .= '</div>'."\n";

?>
