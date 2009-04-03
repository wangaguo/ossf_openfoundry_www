<?php
/**
* @version $Id: fckeditor.php 1 2005-10-07 24:00:00 angelfranco $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$_MAMBOTS->registerFunction( 'onInitEditor', 'botFCKInitEditor' );
$_MAMBOTS->registerFunction( 'onGetEditorContents', 'botFCKGetEditorContents' );
$_MAMBOTS->registerFunction( 'onEditorArea', 'botFCKEditorArea' );

function botFCKInitEditor() {
	global $mosConfig_live_site;
return <<<EOD
<script type="text/javascript" src="$mosConfig_live_site/mambots/editors/fckeditor/fckeditor.js"></script>
EOD;
}

function botFCKEditorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
global $mosConfig_live_site, $database, $_MAMBOTS, $mosConfig_absolute_path;
 
    if(!file_exists($mosConfig_absolute_path . "/images/Flash/")){
          umask(0);
          @mkdir($mosConfig_absolute_path . "/images/Flash/");
     }
		
	if(!is_writable($mosConfig_absolute_path . "/images/Flash/")){
          @chmod($mosConfig_absolute_path . "/images/Flash/", 0777);
    }
 
    $query = "SELECT id FROM #__mambots WHERE element = 'fckeditor' AND folder = 'editors'";
	$database->setQuery( $query );
	$id = $database->loadResult();
	
	$mainframe = new mosMainFrame( $database, $option, '.' );
	
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$params = new mosParameters( $mambot->params );

	$toolbar = $params->get( 'toolbar', 'Default' );
	$text_direction	= $params->get( 'text_direction', 'ltr' );
	$newlines = $params->get( 'newlines', 'false' );
	$docprops = $params->get( 'docprops', 'false' );
	$content_css = $params->get( 'content_css', '1' );
	$content_css_custom = $params->get( 'content_css_custom', '' );
	$wwidth = $params->get( 'wwidth', '100%' );
	$hheight = $params->get( 'hheight', '250' );
	
	if ( $content_css ) {
		$template = $mainframe->getTemplate();
		
		$file = $mosConfig_absolute_path ."/templates/". $template ."/css/editor_content.css";
		if ( file_exists( $file ) ) {
			$content_css = 'templates/'.$template.'/css/editor_content.css';
		} else {
			$content_css = 'templates/'.$template.'/css/template_css.css';
		}
	} else {
		if ( $content_css_custom ) {
			$content_css = $content_css_custom;
		} else {
			$content_css = 'mambots/editors/fckeditor/editor/css/fck_editorarea.css';
		}
	}
	
	
	$results = $_MAMBOTS->trigger( 'onCustomEditorButton' );
	$buttons = array();
	
	foreach ($results as $result) {
	    $buttons[] = '<img src="'.$mosConfig_live_site.'/mambots/editors-xtd/'.$result[0].'" onclick="InsertHTML(\''.$hiddenField.'\',\''.$result[1].'\')" />';
	}
	$buttons = implode( "", $buttons );
	
	$eNoEditor = "eNoEditor".$hiddenField;
	$eEditor = "eEditor".$hiddenField;
return <<<EOD

<div id="$eNoEditor" style="DISPLAY: none">
<img src="$mosConfig_live_site/mambots/editors/fckeditor/editor/images/plusbottom.gif" width="19" height="19" onmouseover="return overlib('Mostrar Editor');" onMouseOut="return nd();" onclick="Show('$hiddenField', '$eNoEditor', '$eEditor');">
</div>
<div id="$eEditor">
<img src="$mosConfig_live_site/mambots/editors/fckeditor/editor/images/minusbottom.gif" width="19" height="19" onmouseover="return overlib('Ocultar Editor');" onMouseOut="return nd();" onclick="Hide('$hiddenField', '$eNoEditor', '$eEditor');">

<textarea name="$hiddenField" id="$hiddenField" cols="$col" rows="$row" style="width:{$width}px; height:{$height}px;">$content</textarea>
$buttons</div>

<script type="text/javascript">

function Show(hiddenField, eNoEditor, eEditor)
{
	document.getElementById(eEditor).style.display	= '' ;
	document.getElementById(eNoEditor).style.display	= 'none' ;

	// This is a hack for Gecko... it stops editing when the editor is hidden.
	if ( !document.all )
	{
		var oEditor = FCKeditorAPI.GetInstance( hiddenField ) ;
		
		if (  oEditor.EditMode == FCK_EDITMODE_WYSIWYG )
		{
			oEditor.SwitchEditMode() ;
			oEditor.SwitchEditMode() ;
		}
	}
}

function Hide(hiddenField, eNoEditor, eEditor)
{
	document.getElementById(eEditor).style.display	= 'none' ;
	document.getElementById(eNoEditor).style.display	= '' ;
}

function InsertHTML(hiddenField, value)
{
	// Get the editor instance that we want to interact with.
	var oEditor = FCKeditorAPI.GetInstance(hiddenField) ;

	// Check the active editing mode.
	if ( oEditor.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		// Insert the desired HTML.
		oEditor.InsertHtml( value ) ;
	}
	else
		alert( 'Su editor debe estar en modalidad WYSIWYG !!!' ) ;
}

        var oFCKeditor = new FCKeditor( '$hiddenField' ) ;
		oFCKeditor.BasePath = "$mosConfig_live_site/mambots/editors/fckeditor/" ;
		//if("$name" == "com_post"){
		//oFCKeditor.ToolbarSet = "Basic" ;
		//} else {
		oFCKeditor.ToolbarSet = "$toolbar" ;
		//}
		oFCKeditor.Width = "$wwidth" ;
		oFCKeditor.Height = "$hheight" ;
		
		oFCKeditor.Config['EditorAreaCSS'] = "$mosConfig_live_site/$content_css";
		oFCKeditor.Config['ContentLangDirection'] = "$text_direction" ;
		oFCKeditor.Config['UseBROnCarriageReturn'] = "$newlines" ;
		oFCKeditor.Config['FullPage'] = "$docprops" ;
		
		oFCKeditor.ReplaceTextarea() ;
</script>
EOD;
}

function botFCKGetEditorContents( $editorArea, $hiddenField ) {

}
?>
