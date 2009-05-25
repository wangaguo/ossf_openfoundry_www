<?php
/**
* @version 2.0 - RokZoom - RocketTheme
* @package RocketTheme
* @copyright Copyright (C) 2008 RocketTheme, LLC. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die();

jimport( 'joomla.plugin.plugin' );
require_once(dirname(__FILE__) . '/rokzoom/imagehandler.php');

class plgContentRokzoom extends JPlugin
{
    function plgContentRokzoom( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	
	function onPrepareContent( &$article, &$params, $limitstart )
	{
		global $mainframe;
		

    	// simple performance check to determine whether bot should process further
    	if ( strpos( $article->text, 'rokzoom' ) === false ) {
    		return true;
    	}
    	
    	// Get plugin info
    	$plugin =& JPluginHelper::getPlugin('content', 'rokzoom');

    	// define the regular expression for the bot
    	$regex = "#{rokzoom(.*?)}(.*?){/rokzoom}#s";
    	
    	$pluginParams = new JParameter( $plugin->params );

    	// check whether plugin has been unpublished
    	if ( !$pluginParams->get( 'enabled', 1 ) ) {
    		$article->text = preg_replace( $regex, '', $row->text );
    		return true;
    	}
    	
    	// find all instances of plugin and put in $matches
    	preg_match_all( $regex, $article->text, $matches );

    	// Number of plugins
     	$count = count( $matches[0] );

     	// plugin only processes if there are any instances of the plugin in the text
     	if ( $count ) {
    		// Get plugin parameters
    	 	$style	= $pluginParams->def( 'style', -2 );

     		$this->plgContentProcessRokzoomImages( $article, $matches, $count, $regex, $pluginParams );
    	}


	}
	
	function plgContentProcessRokzoomImages( &$row, &$matches, $count, $regex, &$botParams ) {
    	global $mainframe;


    	$thumb_ext	= $botParams->def( 'thumb_ext', '_thumb');
    	$thumb_class	= $botParams->def( 'thumb_class', 'album');
    	$thumb_width = $botParams->def( 'thumb_width', '100');
    	$thumb_height = $botParams->def( 'thumb_height', '100');
    	$thumb_quality = $botParams->def( 'thumb_quality', '90');
    	$thumb_custom = $botParams->def( 'thumb_custom', 0);
    	$thumb_dir = $botParams->def( 'thumb_dir');
    	$compatibility = $botParams->def( 'compatibility', 'rokzoom');
    	$thealbum = '';
    	$thetitle = '';

    	/* thumbnail settings */
    	$improve_thumbnails = false; // Auto Contrast, Unsharp Mask, Desaturate,  White Balance
    	$thumb_quality = $thumb_quality;
    	$width = $thumb_width;
    	$height = $thumb_height;

    	/* slimbox = lightbox mode */
    	if ($compatibility == "slimbox") $compatibility = "lightbox";

        for ( $i=0; $i < $count; $i++ )
    	{
    	    if (@$matches[1][$i]) {
        		$inline_params = $matches[1][$i];

        		// get album
        		$album_matches = array();
        		preg_match( "#album=\|(.*?)\|#s", $inline_params, $album_matches );
        		if (isset($album_matches[1])) $thealbum = "[" . trim($album_matches[1]) . "]";

        		// get title
        		$title_matches = array();
        		preg_match( "#title=\|(.*?)\|#s", $inline_params, $title_matches );
        		if (isset($title_matches[1])) $thetitle =  $title_matches[1];
        	}

        	$image_url = trim($matches[2][$i]);
        	$extension = substr($image_url,strrpos($image_url,"."));
        	$image_name = substr($image_url,0,strrpos($image_url, "."));
        	$just_name = substr($image_name,strrpos($image_name,DS)+1);
        	
        	$full_url = JURI::base() . $image_url;
        	$full_path = JPATH_ROOT . DS . $image_url;
        	$thumb_url_custom =  JURI::base() . $thumb_dir . DS . $just_name . $thumb_ext . $extension;
        	$thumb_path_custom = JPATH_ROOT. DS . $thumb_dir . DS . $just_name . $thumb_ext . $extension;
        	$thumb_url = JURI::base() . $image_name . $thumb_ext . $extension;
        	$thumb_path = JPATH_ROOT . DS . $image_name . $thumb_ext . $extension;
        	
            // var_dump($full_url);
            // var_dump($full_path);
            // var_dump($thumb_url_custom);
            // var_dump($thumb_path_custom);
            // var_dump($thumb_url);
            // var_dump($thumb_path);


        	if (!$thumb_custom && file_exists($thumb_path)) {
        		// thumbnail exists so can do lightbox with thumbnail
        		$text = '<a href="' . $full_url . '" rel="' . $compatibility . $thealbum . '" title="' . $thetitle . '"><img class="'. $thumb_class . '" src="' . $thumb_url . '" alt="' . $thetitle . '" /></a>';
        	} elseif (file_exists($thumb_path_custom)) {
        		$text = '<a href="' . $full_url . '" rel="' . $compatibility . $thealbum . '" title="' . $thetitle . '"><img class="'. $thumb_class . '" src="' . $thumb_url_custom . '" alt="' . $thetitle . '" /></a>';

        	} else {
        		//try to generate thumbs
        		if ($thumb_custom) $thumb_path = $thumb_path_custom;
          		
        		$rd = new imgRedim(false, $improve_thumbnails, JPATH_CACHE);
        		$image_filename = $full_path; // define source image here
        		$output_filename = $thumb_path; // define destination image here

        		$rd->loadImage($image_filename);
        		$rd->redimToSize($width, $height, true);
        		$rd->saveImage($output_filename, $thumb_quality);
        		$text = '<a href="' . $image_url . '" rel="' . $compatibility . $thealbum . '" title="' . $thetitle . '"><img class="'. $thumb_class . '" src="' . $thumb_url . '" alt="' . $thetitle . '" /></a>';
        	}
        	$row->text = str_replace( $matches[0][$i], $text, $row->text );
	    }

    	
    }
}

?>
