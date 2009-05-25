<?php
/**
* @version $Id: easytube.php,v 1.1 $
* @package Mambo
* @copyright (C) 2007 Paul Bain
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
$mainframe->registerEvent( 'onPrepareContent', 'tube_content' );
$mainframe->registerEvent( 'onPrepareContent', 'googlevideo_content' );

function tube_content( &$row, &$params, $page=0 )  {


    $regex = '/\[youtube:(.*?)]/i';
	preg_match_all( $regex, $row->text, $matches );
	for($x=0; $x<count($matches[0]); $x++)
	{
		$parts = explode(" ", $matches[1][$x]);
		if(count($parts) > 1)
		{
			$vid= explode('=',$parts[0]);
			$vid = $vid[1];
			$width = $parts[1];
			if(count($parts) > 2)
			{
				$height = $parts[2];
			}
			else
			{
				$height = "";
			}
			$replace = '<object class="embed" width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" data="http://www.youtube.com/v/'.$vid.'"><param name="wmode" value="transparent"><param name="movie" value="http://www.youtube.com/v/'.$vid.'" /><em>You need to a flashplayer enabled browser to view this YouTube video</em></object>';
		}
		else
		{
			$vid= explode('=',$matches[1][$x]);
			$vid = $vid[1];
			$replace = '<object class="embed" width="425" height="350" type="application/x-shockwave-flash" data="http://www.youtube.com/v/'.$vid.'"><param name="movie" value="http://www.youtube.com/v/'.$vid.'" /><param name="wmode" value="transparent"><em>You need to a flashplayer enabled browser to view this YouTube video</em></object>';
		}

		$row->text = str_replace($matches[0][$x], $replace, $row->text);
	}

	

}

function googlevideo_content(&$row, &$params, $page=0 )  
{
    $regex = '/\[googlevideo:(.*?)]/i';
	preg_match_all( $regex, $row->text, $matches );
	for($x=0; $x<count($matches[0]); $x++)
	{
		$parts = explode(" ", $matches[1][$x]);
		if(count($parts) > 1)
		{
			$vid= explode('=',$parts[0]);
			$vid = $vid[1];
			$width = $parts[1];
			if(count($parts) > 2)
			{
				$height = $parts[2];
			}
			else
			{
				$height = "";
			}
			$replace = '<object class="embed" width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" data="http://video.google.com/googleplayer.swf?docId='.$vid.'"><param name="movie" value="http://video.google.com/googleplayer.swf?docId='.$vid.'" /><param name="wmode" value="transparent"><em>You need to have flashplayer enabled to watch this Google video</em></object>';
		}
		else
		{
			$vid= explode('=',$matches[1][$x]);
			$vid = $vid[1];
			$replace = '<object class="embed" width="425" height="350" type="application/x-shockwave-flash" data="http://video.google.com/googleplayer.swf?docId='.$vid.'"><param name="movie" value="http://video.google.com/googleplayer.swf?docId='.$vid.'" /><param name="wmode" value="transparent"><em>You need to have flashplayer enabled to watch this Google video</em></object>';
		}

		$row->text = str_replace($matches[0][$x], $replace, $row->text);
	}

	
}


?>
