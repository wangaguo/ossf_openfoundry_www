<?PHP /* $Id$ */

	/**
	* admin module for JoomlaStats
	* @package mod_jstats_admin
	* @copyright 2004-2006 JoomlaStats Team
	* @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
	* @version $Revision: 2.0 $
	* @author JoomlaStats Team <info@JoomlaStats.org>
	*/
	
	//ensure this file is being included by a parent file
	defined('_VALID_MOS') or die ('Direct Access to this location is not allowed.');


	// get browser statistics ---------------------------------------------------------------------------
	
	$content = '<table class="adminlist">';
	
	$limit = $params->get('top') != '' ? " LIMIT 0, ".$params->get('top') : "";
	$append = $params->get('top') != '' ? " 's Top ".$params->get('top') : "";

	//get global hour difference
	global $mosConfig_offset;
	
	switch($params->get('period'))
	{
		case "today":
			$content .= '<tr><th class="title" colspan="2">Today'.$append.' browser statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id)  WHERE ((#__jstats_visits.day = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%e')) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
			break;
		case "thisweek":
			$content .= '<tr><th class="title" colspan="2">This week'.$append.' browser statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE (DATE_FORMAT(DATE_ADD(CONCAT(#__jstats_visits.year,'-',#__jstats_visits.month,'-',#__jstats_visits.day), INTERVAL $mosConfig_offset HOUR),'%v') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%v') AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
			break;
		case "thismonth":
			$content .= '<tr><th class="title" colspan="2">This month'.$append.' browser statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE ((#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
			break;
		default:
			$content .= '<tr><th class="title" colspan="2">Total'.substr($append,2).' browser statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE #__jstats_ipaddresses.type='1' GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
	}
	
	$mainframe->_db->setQuery($sql);	
	$rs = mysql_query($mainframe->_db->_sql);	
	$totalnmb = 0;	
	while ($row = mysql_fetch_array($rs)) 
	{
		$totalnmb += $row['numbers'];
	}    		
	
	if($totalnmb != 0)
	{
		mysql_data_seek($rs,0);
		
		while ($row = mysql_fetch_array($rs)) 
		{
			$val = round((($row[0]/$totalnmb)*100),0) > 1 ? round((($row[0]/$totalnmb)*100),0) : "< 1.0";
			$content .= '<tr>';
			$content .= "<td align=\"right\" nowrap>&nbsp;$val %</td>";
			$content .= "<td width=\"100%\" align=\"left\" nowrap>&nbsp;$row[1]</td>";
			$content .= '</tr>';
		} 
	}
	
	mysql_free_result($rs);
	$content .= '</table><br>';


	// get OS statistics ---------------------------------------------------------------------------

	$content .= '<table class="adminlist">';
	
	$limit = $params->get('top') != '' ? " LIMIT 0, ".$params->get('top') : "";
	$append = $params->get('top') != '' ? " 's Top ".$params->get('top') : "";
	
	//get global hour difference
	global $mosConfig_offset;

	switch($params->get('period'))
	{
		case "today":
			$content .= '<tr><th class="title" colspan="2">Today'.$append.' OS statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id)  WHERE ((#__jstats_visits.day = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%e')) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
			break;
		case "thisweek":
			$content .= '<tr><th class="title" colspan="2">This week'.$append.' OS statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE (DATE_FORMAT(DATE_ADD(CONCAT(#__jstats_visits.year,'-',#__jstats_visits.month,'-',#__jstats_visits.day), INTERVAL $mosConfig_offset HOUR),'%v') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%v') AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
			break;
		case "thismonth":
			$content .= '<tr><th class="title" colspan="2">This month'.$append.' OS statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE ((#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
			break;
		default:
			$content .= '<tr><th class="title" colspan="2">Total'.substr($append,2).' OS statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE #__jstats_ipaddresses.type='1' GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
	}

	$mainframe->_db->setQuery($sql);	
	$rs = mysql_query($mainframe->_db->_sql);	
	$totalnmb = 0;
	while ($row = mysql_fetch_array($rs)) 
	{
		$totalnmb += $row['numbers'];
	}    		
	
	if($totalnmb != 0)
	{
		mysql_data_seek($rs,0);
		
		while ($row = mysql_fetch_array($rs)) 
		{
			$val = round((($row[0]/$totalnmb)*100),0) > 1 ? round((($row[0]/$totalnmb)*100),0) : "< 1.0";
			$content .= '<tr>';
			$content .= "<td align=\"right\" nowrap>&nbsp;$val %</td>";
			$content .= "<td width=\"100%\" align=\"left\" nowrap>&nbsp;$row[1]</td>";
			$content .= '</tr>';

		} //while		
	} // end if $totalnmb != 0
	
	mysql_free_result($rs);
	$content .= '</table><br>';


	// get Country statistics ---------------------------------------------------------------------------

	$content .= '<table class="adminlist">';
	
	$limit = $params->get('top') != '' ? " LIMIT 0, ".$params->get('top') : "";
	$append = $params->get('top') != '' ? " 's Top ".$params->get('top') : "";

	//get global hour difference
	global $mosConfig_offset;
	
	switch($params->get('period'))
	{
		case "today":
			$content .= '<tr><th class="title" colspan="2">Today'.$append.' country statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE ((#__jstats_visits.day = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%e')) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC".$limit;
			break;
		case "thisweek":
			$content .= '<tr><th class="title" colspan="2">This week'.$append.' country statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE (DATE_FORMAT(DATE_ADD(CONCAT(#__jstats_visits.year,'-',#__jstats_visits.month,'-',#__jstats_visits.day), INTERVAL $mosConfig_offset HOUR),'%v') = DATE_FORMAT(NOW(),'%v') AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC".$limit;
			break;
		case "thismonth":
			$content .= '<tr><th class="title" colspan="2">This month'.$append.' country statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE ((#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC".$limit;
			break;
		default:
			$content .= '<tr><th class="title" colspan="2">Total'.substr($append,2).' country statistics</th></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE #__jstats_ipaddresses.type='1' GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC".$limit;
	}

	$mainframe->_db->setQuery($sql);
	$rs = mysql_query($mainframe->_db->_sql);	
	$totalnmb = 0;
	while ($row = mysql_fetch_array($rs)) 
	{
		$totalnmb += $row['numbers'];
	}    		
	
	if($totalnmb != 0)
	{
		mysql_data_seek($rs,0);
		
		while ($row = mysql_fetch_array($rs)) 
		{
			$val = round((($row[0]/$totalnmb)*100),0) > 1 ? round((($row[0]/$totalnmb)*100),0) : "< 1.0";
			$content .= '<tr>';
			$content .= "<td align=\"right\" nowrap>&nbsp;$val %</td>";
			$content .= "<td width=\"100%\" align=\"left\" nowrap>&nbsp;$row[2]</td>";
			$content .= '</tr>';

		}
	}
	mysql_free_result($rs);
	$content .= '</table>';
	

	// get bots statistics ---------------------------------------------------------------------------

	$content .= '<table class="adminlist">';
	
	$limit = $params->get('top') != '' ? " LIMIT 0, ".$params->get('top') : "";
	$append = $params->get('top') != '' ? " 's Top ".$params->get('top') : "";

	//get global hour difference
	global $mosConfig_offset;
	
	switch($params->get('period'))
	{
		case "today":
			$content .= '<tr><th class="title" colspan="2">Today'.$append.' bot statistics</th></tr>';
			$sql = "SELECT count(*) as numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses,#__jstats_visits WHERE ((#__jstats_visits.ip_id = #__jstats_ipaddresses.id) AND (#__jstats_ipaddresses.browser !='') AND (#__jstats_ipaddresses.type =2) AND (#__jstats_visits.day = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%e')) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y'))) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
			
			break;
		case "thisweek":
			$content .= '<tr><th class="title" colspan="2">This week'.$append.' bot statistics</th></tr>';
			$sql = "SELECT count(*) as numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses,#__jstats_visits WHERE ((#__jstats_visits.ip_id = #__jstats_ipaddresses.id) AND (#__jstats_ipaddresses.browser !='') AND (#__jstats_ipaddresses.type =2) AND (DATE_FORMAT(DATE_ADD(CONCAT(#__jstats_visits.year,'-',#__jstats_visits.month,'-',#__jstats_visits.day), INTERVAL $mosConfig_offset HOUR),'%v') = DATE_FORMAT(NOW(),'%v') AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')))) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
			break;
		case "thismonth":
			$content .= '<tr><th class="title" colspan="2">This month'.$append.' bot statistics</th></tr>';
			$sql = "SELECT count(*) as numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses,#__jstats_visits WHERE ((#__jstats_visits.ip_id = #__jstats_ipaddresses.id) AND (#__jstats_ipaddresses.browser !='') AND (#__jstats_ipaddresses.type =2) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y'))) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
			break;
		default:
			$content .= '<tr><th class="title" colspan="2">Total'.substr($append,2).' bot statistics</th></tr>';
			$sql = "SELECT count(*) as numbers,#__jstats_ipaddresses.browser FROM #__jstats_ipaddresses,#__jstats_visits WHERE ((#__jstats_visits.ip_id = #__jstats_ipaddresses.id) AND (#__jstats_ipaddresses.browser !='') AND (#__jstats_ipaddresses.type =2)) GROUP BY #__jstats_ipaddresses.browser ORDER BY numbers DESC, #__jstats_ipaddresses.browser ASC".$limit;
	}

	$mainframe->_db->setQuery($sql);	
	$rs = mysql_query($mainframe->_db->_sql);	
	$totalnmb = 0;
	while ($row = mysql_fetch_array($rs)) 
	{
		$totalnmb += $row['numbers'];
	}    		
	
	if($totalnmb != 0)
	{
		mysql_data_seek($rs,0);
		
		while ($row = mysql_fetch_array($rs)) 
		{
			$val = round((($row[0]/$totalnmb)*100),0) > 1 ? round((($row[0]/$totalnmb)*100),0) : "< 1.0";
			$content .= '<tr>';
			$content .= "<td align=\"right\" nowrap>&nbsp;$val %</td>";
			$content .= "<td width=\"100%\" align=\"left\" nowrap>&nbsp;$row[1]</td>";
			$content .= '</tr>';
		}
	} 	
	mysql_free_result($rs);
	$content .= '</table>';	
	echo $content;
?>