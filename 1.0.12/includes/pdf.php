<?php
/**
* @version $Id: pdf.php 5073 2006-09-15 23:49:17Z friesengeist $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* Created by Phil Taylor me@phil-taylor.com
* Support file to display PDF Text Only using class from - http://www.ros.co.nz/pdf/readme.pdf
* HTMLDoc is available from: http://www.easysw.com/htmldoc and needs installing on the server for better HTML to PDF conversion
**/

//Modified by Eddy Chang (mambo.eyesofkids.net)
//Last Updated 28062004


// THIS IS NOT A STANDARD MAMBO CORE FILE BY HAS BEEN MODIFIED BY PHIL TAYLOR <mambo@phil-taylor.com>

// ensure this file is being included by a parent file



defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_offset, $mosConfig_hideAuthor, $mosConfig_hideModifyDate, $mosConfig_hideCreateDate, $mosConfig_live_site;

$safe="0";
if (get_php_setting('safe_mode') == 'ON') {
	$safe="1";
}

if ($safe == "0") {

	if (@file_exists( "/usr/bin/htmldoc" )) {
		$id = strtolower( trim( mosGetParam( $_REQUEST, 'id',1 ) ) );
		$article = $mosConfig_live_site . '/index2.php?option=content&task=view&pop=1&page=0&hide_js=1&pdf=1&id=' . $id;
		header( "Content-Type: application/pdf" );
		header( "Content-Disposition: inline; filename=\"pdf-mambo.pdf\"" );
		flush();
		//following line for Linux only - windows may need the path as well...
		passthru( "/usr/bin/htmldoc --no-localfiles --no-compression -t pdf14 --jpeg --webpage --header t.D --footer ./. --size letter --left 0.5in '$article'" );
	} else {
		dofreePDF ($database);
	}
} else {

	dofreePDF ($database);
}

function dofreePDF ($database) {
	global $mosConfig_lang, $mosConfig_live_site, $mosConfig_sitename, $mosConfig_offset, $mosConfig_hideCreateDate,
   $mosConfig_hideAuthor, $mosConfig_hideModifyDate, $mosConfig_absolute_path;

	$id = strtolower( trim( mosGetParam( $_REQUEST, 'id',1 ) ) );
	$row = new mosContent( $database );
	$row->load($id);
    $row->text = $row->introtext . $row->fulltext;
	// Ugly but needed to do all the stuff the PDF class cant handle
  ob_start();
  ?>
  <?php 
        //below: Copy from old version pdf.php
        
	//Find Author Name
	$users_rows = new mosUser( $database );
	$users_rows->load($row->created_by);
	$row->author = $users_rows->name;
	$row->usertype = $users_rows->usertype;
	
        $txt1 = _E_TITLE.$row->title;
	//$pdf->ezText($txt1,14);

	$txt2=null;
	$mod_date = null; $create_date = null;
	if (intval( $row->modified ) <> 0) {
		$mod_date = mosFormatDate($row->modified);
	}
	if (intval( $row->created ) <> 0) {
		$create_date = mosFormatDate($row->created);
	}

	if ($mosConfig_hideCreateDate == "0") {
		//$txt2 .= "(".$create_date.") - ";
	}

	if ($mosConfig_hideAuthor == "0") {
		if ($row->author != "" && $mosConfig_hideAuthor == "0") {
			if ($row->usertype == 'administrator' || $row->usertype == 'superadministrator') {
				$txt2 .=  _WRITTEN_BY." ".($row->created_by_alias ? $row->created_by_alias : $row->author);
			} else {
				$txt2 .=  _AUTHOR_BY." ".($row->created_by_alias ? $row->created_by_alias : $row->author);
			}
		}

	}

	if ($mosConfig_hideModifyDate == "0" && $mod_date!="0") {
		$txt2 .= " - " . _LAST_UPDATED." (".$mod_date.") ";
	}
	//up: copy from old version pdf.php
		
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">"; ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title><?php echo $txt1; ?><?php echo $txt2; ?></title>
	<link rel="stylesheet" href="templates/<?php echo $cur_template;?>/css/template_css.css" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	</head>
	<body class="contentpane">
	<P>
	<?
			
        $row->html = ob_get_contents();
        ob_end_clean();
        $row->html .= PDF_mosimage($row);
	$row->html .= "</body></html>";
  
        require($mosConfig_absolute_path."/includes/fpdf/fpdf_include.php" );

        $pdf = new PDF();
        //Modified by Eddy Chang 20040828
		if ($mosConfig_lang=='traditional_chinese'){
        
		$pdf->AliasNbPages(); 
        $pdf->AddBig5hwFont();
        //$pdf->AddBig5Font();
        $pdf->Open();
        $pdf->SetFont('Big5-hw', '', 12);
        $pdf->AddPage(); // added by Max 20041202
        $pdf->WriteHTML(big5_utf8_decode($row->html)); // added by Max 20041202
		
		}elseif ($mosConfig_lang=='simplified_chinese'){
		$pdf->AliasNbPages(); 
        $pdf->AddGBhwFont();
        //$pdf->AddBig5Font();
        $pdf->Open();
        $pdf->SetFont('GB-hw', '', 12);
        $pdf->AddPage(); // added by Max 20041202
        $pdf->WriteHTML(gb_utf8_decode($row->html)); // added by Max 20041202
		
		}else{
		$pdf->Open();
        $pdf->SetFont('Arial', '', 12);
        $pdf->AddPage(); // added by Max 20041202
        $pdf->WriteHTML($row->html); // added by Max 20041202
		}
        //End Modified
	//$pdf->AddPage(); // removed by Max 20041202
        //$pdf->WriteHTML($row->html); // removed by Max 20041202
        //save and redirect
       // name, dest
       // dest can be, (I = Inline, D = download, F = Save to local file, S = return as string)
        $pdf->Output("mambo.pdf","I");


}
function decodeHTML($string) {
	$string = strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
	$string = preg_replace("/&#([0-9]+);/me", "chr('\\1')", $string);
	return $string;
}

function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? 'ON' : 'OFF';
}

function PDF_mosimage( $row ) {
	global $mosConfig_live_site, $mosConfig_absolute_path;

	$row->images = explode( "\n", $row->images );
	$images = array();

	foreach ($row->images as $img) {
		$img = trim( $img );
		if ($img) {
			$temp = explode( '|', trim( $img ) );
			if (!isset( $temp[1] )) {
				$temp[1] = "left";
			}
			if (!isset( $temp[2] )) {
				$temp[2] = "Image";
			} else {
				$temp[2] = htmlspecialchars( $temp[2] );
			}
			if (!isset( $temp[3] )) {
				$temp[3] = "0";
			}
			$size = '';
			if (function_exists( 'getimagesize' )) {
				$size = @getimagesize( "$mosConfig_absolute_path/images/stories/$temp[0]" );
				if (is_array( $size )) {
					$size = "width=\"$size[0]\" height=\"$size[1]\"";
				}
			}
			$images[] = "<img src=\"$mosConfig_live_site/images/stories/$temp[0]\" $size align=\"$temp[1]\"  hspace=\"6\" alt=\"$temp[2]\" border=\"$temp[3]\" />";
		}
	}

	$text = explode( '{mosimage}', $row->text );

	$row->text = $text[0];

	for ($i=0, $n=count( $text )-1; $i < $n; $i++) {
		if (isset( $images[$i] )) {
			$row->text .= $images[$i];
		}
		if (isset( $text[$i+1] )) {
			$row->text .= $text[$i+1];
		}
	}
	unset( $text );
	return  $row->text;
}
?>
