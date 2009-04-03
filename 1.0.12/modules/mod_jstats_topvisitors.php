<?PHP /* $Id$ */

/**
* module jstats_topvisitors
* @package mod_jstats_topvisitors
* @copyright 2006 RoBo
* @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
* @version $Revision: 1.4 $
* @author RoBo <info@JoomlaStats.org>
*/

//ensure this file is being included by a parent file
defined('_VALID_MOS') or die ('Direct Access to this location is not allowed.');


function UserVisitsTable($mainframe, $limit)
{		
	$visittable = "";
	$rs = "";

	$sql = 'SELECT #__users.name, count( * )'
        . ' FROM  #__jstats_visits, #__jstats_ipaddresses, #__users'
        . ' WHERE #__jstats_visits.ip_id = #__jstats_ipaddresses.id'
        . ' AND   #__jstats_visits.userid = #__users.id'
        . ' AND   #__jstats_visits.userid  <> 0'
        . ' AND   #__jstats_ipaddresses.exclude <> 1'
        . ' GROUP BY #__jstats_visits.userid'
        . ' ORDER BY `count( * )` DESC';
	$sql .= ($limit != '') ? " LIMIT 0, ".$limit.";" : ";";
	
 
	$mainframe->_db->setQuery($sql);
	$rs = mysql_query($mainframe->_db->_sql);

	$visittable .= '<table cellspacing="2" width="100%">';		
	$visittable .= "<TR> <td><b>Name</b></td>  <td><b>Visits</b></td> </TR>";

	while ($row = mysql_fetch_array($rs)) 
	{
		$visittable .= "<TR> <td>".$row[0]."</td>  <td>".$row[1]."</td> </TR>";
	}
	mysql_free_result($rs);

	$visittable .= '</table>';

	return $visittable;
}

function PagesTable($mainframe, $limit)
{		
	$pagestable = "";
	$rs = "";

	$sql = 'SELECT #__users.name, count(*)'
        . ' FROM  #__jstats_page_request, #__jstats_visits, #__jstats_ipaddresses, #__users'
        . ' WHERE #__jstats_page_request.ip_id = #__jstats_visits.id'
        . ' AND   #__jstats_visits.ip_id = #__jstats_ipaddresses.id'
        . ' AND   #__jstats_visits.userid = #__users.id'
        . ' AND   #__jstats_visits.userid  <> 0'
        . ' AND   #__jstats_ipaddresses.exclude <> 1'
        . ' GROUP BY #__jstats_visits.userid'
        . ' ORDER BY `count(*)` DESC';
	$sql .= ($limit != '') ? " LIMIT 0, ".$limit.";" : ";";


	$mainframe->_db->setQuery($sql);
	$rs = mysql_query($mainframe->_db->_sql);

	$pagestable .= '<table cellspacing="2" width="100%">';		
	$pagestable .= "<TR> <td><b>Name</b></td>  <td><b>Pages</b></td> </TR>";

	while ($row = mysql_fetch_array($rs)) 
	{
		$pagestable .= "<TR> <td>".$row[0]."</td>  <td>".$row[1]."</td> </TR>";
	}
	mysql_free_result($rs);

	$pagestable .= '</table>';

	return $pagestable;
}


function NSLookupVisitsTable($mainframe, $limit)
{		
	$visittable = "";
	$rs = "";

	$sql = 'SELECT #__jstats_ipaddresses.nslookup, count(*)'
        . ' FROM #__jstats_visits, #__jstats_ipaddresses'
        . ' WHERE #__jstats_visits.ip_id = #__jstats_ipaddresses.id'
        . ' AND #__jstats_visits.userid = 0'
        . ' AND #__jstats_ipaddresses.type = 1'
        . ' GROUP BY #__jstats_ipaddresses.nslookup'
        . ' ORDER BY `count(*)` DESC';
	$sql .= ($limit != '') ? " LIMIT 0, ".$limit.";" : ";";

	$mainframe->_db->setQuery($sql);
	$rs = mysql_query($mainframe->_db->_sql);

	$visittable .= '<table cellspacing="2" width="100%">';		
	$visittable .= "<TR> <td><b>NSLookup</b></td>  <td><b>Visits</b></td> </TR>";

	while ($row = mysql_fetch_array($rs)) 
	{
		$visittable .= "<TR> <td><small><small>".$row[0]."</small></small></td>  <td>".$row[1]."</td> </TR>";
	}
	mysql_free_result($rs);

	$visittable .= '</table>';

	return $visittable;
}


function NSLookupPagesTable($mainframe, $limit)
{		
	$visittable = "";
	$rs = "";

	$sql = 'SELECT #__jstats_ipaddresses.nslookup, count(*) AS "Pages"'
        . ' FROM #__jstats_page_request, #__jstats_visits, #__jstats_ipaddresses'
        . ' WHERE #__jstats_page_request.ip_id = #__jstats_visits.id'
        . ' AND #__jstats_visits.ip_id = #__jstats_ipaddresses.id '
        . ' and #__jstats_visits.userid = 0 '
        . ' GROUP BY #__jstats_ipaddresses.nslookup'
        . ' ORDER BY Pages DESC';
	$sql .= ($limit != '') ? " LIMIT 0, ".$limit.";" : ";";
	

	$mainframe->_db->setQuery($sql);
	$rs = mysql_query($mainframe->_db->_sql);

	$visittable .= '<table cellspacing="2" width="100%">';		
	$visittable .= "<TR> <td><b>NSLookup</b></td>  <td><b>Pages</b></td> </TR>";

	while ($row = mysql_fetch_array($rs)) 
	{
		$visittable .= "<TR> <td><small><small>".$row[0]."</small></small></td>  <td>".$row[1]."</td> </TR>";
	}
	mysql_free_result($rs);

	$visittable .= '</table>';

	return $visittable;
}







	$content = "";

	if ($params->get('UserVisits') >0)
	{
		$content .= UserVisitsTable($mainframe, $params->get('UserVisits'));
	}
	if ($params->get('NSLookupVisits') >0)
	{
		$content .= NSLookupVisitsTable($mainframe, $params->get('NSLookupVisits'));
	}
	if ($params->get('Pages') >0)
	{
		$content .= PagesTable($mainframe, $params->get('Pages'));
	}
	if ($params->get('NSLookupPages') >0)
	{
		$content .= NSLookupPagesTable($mainframe, $params->get('NSLookupPages'));
	}

/*
	switch($params->get('type'))
	{
		case "UserVisits":
			$content .= UserVisitsTable($mainframe, $params->get('limit'));
			break;
		case "NSLookupVisits":
			$content .= NSLookupVisitsTable($mainframe, $params->get('limit'));
			break;
		case "Pages":
			$content .= PagesTable ($mainframe, $params->get('limit'));
			break;
		default:	// All
			$content .= UserVisitsTable($mainframe, $params->get('limit'));
			$content .= "<BR>";
			$content .= NSLookupVisitsTable($mainframe, $params->get('limit'));
			$content .= "<BR>";
			$content .= PagesTable ($mainframe, $params->get('limit'));
			$content .= "<BR>";
			$content .= NSLookupPagesTable ($mainframe, $params->get('limit'));
	}
*/
?>








