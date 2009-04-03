<?PHP /* $Id$ */

	/**
	* module browser stats
	* @package mod_browser_stats
	* @copyright 2004 PJH Diender
	* @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
	* @version $Revision: 2.0-RC1 $
	* @author Patrick Diender <caffeincoder@oplossing.net>
	*/
	
	//ensure this file is being included by a parent file
	defined('_VALID_MOS') or die ('Direct Access to this location is not allowed.');

	$content = '<table cellspacing="0" width="100%">';
	
	$limit = $params->get('top') != '' ? " LIMIT 0, ".$params->get('top') : "";
	$append = $params->get('top') != '' ? " 's Top ".$params->get('top') : "";
	
	//get global hour difference
	global $mosConfig_offset;

/* Updated SQL for JoomlaStats by Roy L. 21/05/06*/
	switch($params->get('visitors'))
	{
		case "today":
			$content .= '<tr><td colspan="2"><span class="small">Today'.$append.'</span></td></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id)  WHERE ((#__jstats_visits.day = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%e')) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
			break;
		case "thisweek":
			$content .= '<tr><td colspan="2"><span class="small">This week'.$append.'</span></td></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE (DATE_FORMAT(DATE_ADD(CONCAT(#__jstats_visits.year,'-',#__jstats_visits.month,'-',#__jstats_visits.day), INTERVAL $mosConfig_offset HOUR),'%v') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%v') AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
			break;
		case "thismonth":
			$content .= '<tr><td colspan="2"><span class="small">This month'.$append.'</span></td></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE ((#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
			break;
		default:
			$content .= '<tr><td colspan="2"><span class="small">Total'.substr($append,2).'</span></td></tr>';
			$sql = "SELECT count(*) AS numbers,#__jstats_ipaddresses.system FROM #__jstats_ipaddresses LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) WHERE #__jstats_ipaddresses.type='1' GROUP BY #__jstats_ipaddresses.system ORDER BY numbers DESC, #__jstats_ipaddresses.system ASC".$limit;
	}

	$mainframe->_db->setQuery($sql);
	
	$rs = mysql_query($mainframe->_db->_sql);
	
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

	$content .= '</table>';

?>