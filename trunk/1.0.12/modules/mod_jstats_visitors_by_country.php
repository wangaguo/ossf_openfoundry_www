<?PHP /* $Id$ */

	/**
	* module jstats_visitors_by_country
	* @package mod_jstats_visitors_by_country
	* @copyright 2006 JoomlaStats Team
	* @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
	* @version $Revision: 2.3 $
	* @author JoomlaStats Team <www.JoomlaStats.org>
	*/
	
	//ensure this file is being included by a parent file
	defined('_VALID_MOS') or die ('Direct access to this location is not allowed.');

	global $mosConfig_offset;		// get global hour difference

	// $limit	= $params->get('top') != '' ? " LIMIT 0, ".$params->get('top') : "";	
	$append	= $params->get('top') != '' ? " 's Top ".$params->get('top') : "";

	$content = '<table cellspacing="0" width="100%">';
	
		
	switch($params->get('visitors'))
	{
		case "today":
			$content .= '<tr><td colspan="3"><span class="small">Today'.$append.'</span></td></tr>';
			$sql  = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname ";
			$sql .= "FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) ";
			$sql .= "WHERE ((#__jstats_visits.day = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%e')) AND (#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) ";
			$sql .= "GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC";
			break;
		case "thisweek":
			$content .= '<tr><td colspan="3"><span class="small">This week'.$append.'</span></td></tr>';
			$sql  = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname ";
			$sql .= "FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) ";
			$sql .= "WHERE (DATE_FORMAT(DATE_ADD(CONCAT(#__jstats_visits.year,'-',#__jstats_visits.month,'-',#__jstats_visits.day), INTERVAL $mosConfig_offset HOUR),'%v') = DATE_FORMAT(NOW(),'%v') AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) ";
			$sql .= "GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC";
			break;
		case "thismonth":
			$content .= '<tr><td colspan="3"><span class="small">This month'.$append.'</span></td></tr>';
			$sql  = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname ";
			$sql .= "FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) ";
			$sql .= "WHERE ((#__jstats_visits.month = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%c')) AND (#__jstats_visits.year = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $mosConfig_offset HOUR),'%Y')) AND (#__jstats_ipaddresses.type='1')) ";
			$sql .= "GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC";
			break;
		default:
			$content .= '<tr><td colspan="3"><span class="small">Total'.substr($append,2).'</span></td></tr>';
			$sql  = "SELECT count(*) AS numbers,#__jstats_ipaddresses.tld,#__jstats_topleveldomains.fullname ";
			$sql .= "FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) LEFT JOIN #__jstats_visits ON(#__jstats_ipaddresses.id = #__jstats_visits.ip_id) ";
			$sql .= "WHERE #__jstats_ipaddresses.type='1' ";
			$sql .= "GROUP BY tld ORDER BY numbers DESC, #__jstats_topleveldomains.fullname ASC";
	}
//	$sql .= $limit;	// now we only need to queury the number of items selected		// is it good or not to limit the SQL request?

	// calculate total tld visits
	$totalnmb = 0;
	$mainframe->_db->setQuery($sql);
	$rs = mysql_query($mainframe->_db->_sql);
		
	while ($row = mysql_fetch_array($rs)) 
		$totalnmb += $row['numbers'];
		
	if ($totalnmb != 0)
	{
		$i = $params->get('top') != '' ? $params->get('top') : 0;	// set how many rows we must display
		
		mysql_data_seek($rs,0);		
		while (($row = mysql_fetch_array($rs)) && $i>0) 
		{
			$i--;
			$content .= '<tr>';

			if ($row[1] == '')
				$content .= "<td align=\"left\"><img src=\"components/com_joomlastats/images/tld/unknown.png\"></td>";
			else
				$content .= "<td align=\"left\"><img src=\"components/com_joomlastats/images/tld/".$row[1].".png\"></td>";

			$val = round((($row[0]/$totalnmb)*100),0) > 1 ? round((($row[0]/$totalnmb)*100),0) : "< 1.0";
			$content .= "<td align=\"right\" nowrap>&nbsp;$val %</td>";
			$content .= "<td width=\"100%\" align=\"left\" nowrap>&nbsp;$row[2]</td>";
			$content .= '</tr>';
		}	
	}
	
	mysql_free_result($rs);
	$content .= '</table>';
?>
