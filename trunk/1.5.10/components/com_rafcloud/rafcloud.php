<?php
/**
* @version 2.0.2
* @package Raf Cloud
* @copyright Copyright (C) 2007 Skorp. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Raf Cloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @Author: Rafal Blachowski (Skorp) <http://joomla.royy.net>
*/

defined('_VALID_MOS') or die('Restricted access');

global $mosConfig_absolute_path,$mosConfig_lang;

require_once( $mainframe->getPath( 'front_html' ) );
require_once($mosConfig_absolute_path."/administrator/components/com_rafcloud/includes/config.class.php");
require_once($mosConfig_absolute_path."/administrator/components/com_rafcloud/includes/tag.creator.class.php");

$encoding = strtoupper(str_replace('charset=','',_ISO));
$langcode=null;
if ($encoding=="UTF-8") $langcode=".utf-8";

if( !@include_once( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/language/".$mosConfig_lang.$langcode.".php" ) ) {
	include_once( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/language/english.php" );
}



function updateWords($debug=0)
{
	global $database,$mosConfig_dbprefix, $mosConfig_mailfrom, $mosConfig_fromname,$mosConfig_cachepath, $mosConfig_absolute_path;

	$RC_config = new RafCloud_config();
	
	if (($debug==1)&&($RC_config->getValue("RC_debug")==mosGetParam( $_REQUEST, 'hash' )))
	{
		$debug=1;
		echo("Start Raf Cloud debug!<br>");
	} else
	{
		$debug=0;
	}

	$logfile=$mosConfig_absolute_path."/administrator/components/com_rafcloud/runlog.php";
	//$lockfile=$mosConfig_cachepath."/RC_lockfile_";


	if (file_exists($logfile))
	{

		if ($debug) 
		{
			$filetime=filemtime($logfile);
			echo("File time is ".date ("d-m-Y  G:i",$filetime)."<br>");
			if (!($filetime<(time()-10))) //security - 10 sec delay
			{
				echo ("Wait 10s and refresh this page for debug report.");
				return false;
			}
		}
		require($logfile);
	} else
	{
		if (!touch($logfile))
		{
			if ($debug) echo("Error creating $logfile.<br>");

		} else
		{
			if ($debug) echo("Creating $logfile.<br>");
		}
		return false;
	}
	


	$now=time();
	$run=$RC_nextrun;

	if (empty($run)) $run=$now;


	if ((($run<=$now)&&($starttime<=$now))||($debug)) 
	{



	if ($rows=$RC_config->getValues('scheduler'))
	{
		foreach($rows as $row)
		{
			if (!empty($row))
			{
				$val="\$".$row->RC_key." = \$row->RC_value;";
				eval($val);
			}
		}
	}

	$starttime=mktime ($RC_run_hour,$RC_run_minute,0,$RC_run_month,$RC_run_day,$RC_run_year);
	if ($RC_run_period_unit==1) //hours
	{
		$period=$RC_run_period*3600;
		$nextrun=$now+$period;
	}

	if ($RC_run_period_unit==2) //days
	{
		$nextrun=mktime($RC_run_hour,$RC_run_minute,0,date("m"),date("d")+$RC_run_period,date("Y"));
	}

	@chmod ($logfile, 0666);
	if (is_writable($logfile)) {
	if ($fp = fopen("$logfile", "w"))
	{
		if (!flock($fp, LOCK_EX)) 
		{ 
			if ($debug) echo "Couldn't lock $logfile !<br>";
			return false;
		}
		if (empty($nextrun)) $nextrun=0;
		if (empty($now)) $now=time();
		$config  = "<?php\n";
		$config .= '$RC_nextrun = '       . $nextrun . ";\n";
		$config .= '$RC_runlog = '       . $now . ";\n";
		$config .= "?>";
		
		if (fputs($fp, $config, strlen($config))) 
		{
			if ($debug) echo "Ok writing $logfile !<br>";
		}else
		{
			if ($debug) echo "Error writing $logfile !<br>";
			return false;
		}
	} else 
	{
		if ($debug) echo("Error fopen $logfile !<br>");
		return false;
	}	
	} else 
	{
		if ($debug) echo("File is not writeable !<br>");
		return false;
	}
	
	$time_start = getmicrotime();

	//echo("Run createCloudArray() !<br>");

	$tagCreator = new RafCloud_TagCreator($RC_config);
	$tagCreator->debug=$debug;
	$tagCreator->createCloudArray();
	$tagCreator->eraseZeroCounter();
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	$time = round($time,6);
	$time = RC_GENTIME." : ".$time." s";
	if (empty($RC_run_limit)) $RC_run_limit=100;
	if ($debug) echo($time."<br>".RC_LAST_RUN." : ".date ("d-m-Y  G:i",$now)."<br>".RC_NEXT_RUN." : ".date ("d-m-Y  G:i",$nextrun)."<br>");
	$database->setQuery("SELECT word,counter FROM ".$mosConfig_dbprefix."rafcloud_stat WHERE new=1 order by counter DESC LIMIT ".$RC_run_limit);
	if ($rows=$database->loadObjectList())
	{
		$i=0;
		foreach($rows as $row)
		{
			$i++;
			$words.=$row->word." ( ".$row->counter." )\n";
		}
		if ($debug) echo("New words were added to the database.<br>");
		$rc_footer=str_replace("%1",$RC_run_limit,RC_FOOTER_EMAIL);
		$rc_footer=str_replace("%2",$i,$rc_footer);
		$message= RC_BODY_EMAIL."\n\n".$words."\n".$rc_footer."\n".$time."\n".RC_LAST_RUN." : ".date ("d-m-Y  G:i",$now)."\n".RC_NEXT_RUN." : ".date ("d-m-Y  G:i",$nextrun);
		if (!empty($RC_admin_email))
		{
			if (mosMail($mosConfig_mailfrom, $mosConfig_fromname, $RC_admin_email,RC_TITLE_EMAIL ,$message)) { if ($debug) echo("E-mail sent to $RC_admin_email !<br>");} else {if ($debug) echo("Error sending e-mail !<br>");}
		}
	} else if ($debug) echo("No new words are added to the database.<br>");
	
	flock($fp, LOCK_UN);
	fclose ($fp);
	}
	if ($debug) echo("Stop Raf Cloud debug!<br>");
	return true;
}

function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
    } 


function RC_search($search)
{
	global $database,$mosConfig_absolute_path,$mosConfig_list_limit,$_MAMBOTS,$mainframe;

	$search=$database->getEscaped(trim($search));
	$runSearch=true;
	$searchword=$search;
	echo("Search!<br>");
	

	if( $Itemid > 0 && $Itemid != 99999999 ) {
		$menu = $mainframe->get( 'menu' );
		$params = new mosParameters( $menu->params );
		$params->def( 'page_title', 1 );
		$params->def( 'pageclass_sfx', '' );
		$params->def( 'header', $menu->name, _SEARCH_TITLE );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	} else {
		$params = new mosParameters('');
		$params->def( 'page_title', 1 );
		$params->def( 'pageclass_sfx', '' );
		$params->def( 'header', _SEARCH_TITLE );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	}

	$query = "SELECT plugin FROM #__rafcloud_plugins WHERE published=1";
	$database->setQuery( $query );
	if ($plugs = $database->loadObjectList())
	{
		foreach($plugs as $plug)
		{
			echo($plug->plugin." ".$search."<br>");
			if( is_file( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/plugins/".$plug->plugin ) ) 
			{
				include( $mosConfig_absolute_path ."/administrator/components/com_rafcloud/plugins/".$plug->plugin );
			}

		echo($query);
		//var_dump($results);

		$totalRows 	= 0;

		$rows = array();
		for ($i = 0, $n = count( $results); $i < $n; $i++) {
			$rows = array_merge( (array)$rows, (array)$results[$i] );
		}

		$totalRows = count( $rows );

		for ($i=0; $i < $totalRows; $i++) {
			$text = &$rows[$i]->text;

			if ($searchphrase == 'exact') {
				$searchwords 	= array($searchword);
				$needle 		= $searchword;
			} else {
				$searchwords 	= explode(' ', $searchword);
				$needle 		= $searchwords[0];
			}

			$text = mosPrepareSearchContent( $text, 200, $needle );

		  	foreach ($searchwords as $hlword) {
				$text = preg_replace( '/' . preg_quote( $hlword, '/' ) . '/i', '<span class="highlight">\0</span>', $text );
			}

			if ( strpos( $rows[$i]->href, 'http' ) == false ) {
				$url = parse_url( $rows[$i]->href );
				parse_str( @$url['query'], $link );

				// determines Itemid for Content items where itemid has not been included
				if ( isset($rows[$i]->type) && @$link['task'] == 'view' && isset($link['id']) && !isset($link['Itemid']) ) {
					$itemid 	= '';
					$_itemid = $mainframe->getItemid( $link['id'], 0 );

					if ($_itemid) {
						$itemid = '&amp;Itemid='. $_itemid;
					}

					$rows[$i]->href = $rows[$i]->href . $itemid;
				}
			}
		}
	//	var_dump($rows);
		$total 	= $totalRows;
		$limit	= intval( mosGetParam( $_GET, 'limit', $mosConfig_list_limit ) );
		$limit	= ( $limit ? $limit : $mosConfig_list_limit );
		$limitstart = intval( mosGetParam( $_GET, 'limitstart', 0 ) );
		require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
		// prepares searchword for proper display in url
		$searchword_clean = urlencode( $searchword_clean );
	rafcloud_html::display( $list, $params, $pageNav, $limitstart, $limit, $total, $totalRows, $searchword_clean );
		}
	}



}

$debug = intval(mosGetParam( $_REQUEST, 'debug' ));
$sid = intval(mosGetParam( $_REQUEST, 'sid' ));
$searchword = mosGetParam( $_REQUEST, 'searchword' );

if ((!empty($sid))||(!empty($searchword)))
{
	if (!empty($sid))
	{
	$database->setQuery("SELECT * FROM #__rafcloud_stat WHERE id='".$sid."'");
	$cur=$database->query();
	if ($row = mysql_fetch_object( $cur ))
	{
		if (defined( '_JEXEC' ))
		{
			$_POST['searchword'] = $row->word;
		}
		else
		{
			$_REQUEST['searchword'] = $row->word;
		}
	}
	}

	if (defined( '_JEXEC' ))
		{
			$_REQUEST['task'] = "search";
			include($mosConfig_absolute_path."/components/com_search/search.php");
		}
		else
		{
			include($mosConfig_absolute_path."/components/com_search/search.html.php");
			include($mosConfig_absolute_path."/components/com_search/search.php");
		}
	//RC_search($search); //under construcion
}else 
{
	updateWords($debug);
}
?>