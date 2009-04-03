<?PHP /* $Id$ */

/**
* module jstats_latestvisitors
* @package mod_jstats_latestvisitors
* @copyright 2006 RoBo
* @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
* @version $Revision: 1.3 $
* @author RoBo <info@JoomlaStats.org>
*/

//ensure this file is being included by a parent file
defined('_VALID_MOS') or die ('Direct Access to this location is not allowed.');

global $mosConfig_offset;


function Sec2Str($seconds)
{ 
	$calc = $seconds; 
	$calc = abs($calc); 
	$days = floor($calc/86400); 
	$rest_days = $calc % 86400; 
	$hours = floor($rest_days/3600); 
	$rest_hours = $rest_days % 3600; 
	$minutes = floor($rest_hours/60); 
	$rest_minutes = $rest_hours % 60; 
//	$seconds = floor($rest_minutes); 
	
	if ($days==0)
	{ 
		$days="&nbsp;" ;
	}
	else
		if ($days==1)
		{
			$days="&nbsp; $days day "; 
		}
		else
		{
			$days="&nbsp; $days days ";
		}

	if ($hours==0)
	{ 
		$hours="" ;
	}
	else
		if($hours==1)
		{
			$hours="$hours"."h"; 
		}
		else
		{
			$hours="$hours"."h";
		}
	
	if ($minutes==0)
	{ 
		$minutes="00m" ;
	}
	else
	{
		$minutes="$minutes"."m";
	}

//	if ($seconds==0)
//	{ 
//		$seconds="00s" ;
//	}
//	else
//	{
//		$seconds="$seconds"."s";
//	}

//	return "&nbsp;&nbsp;".$days.$hours.$minutes.$seconds." ago"; 
	return "&nbsp;&nbsp;".$days.$hours.$minutes." ago"; 
//	return "&nbsp;&nbsp;".$days.$hours.$minutes; 
} 



function Table_LatestVisitors($mainframe, $limit)
{		
	$table = "";
	$rs = "";


	$sql_table = 'SELECT MAX(#__jstats_visits.time) AS Latest , #__jstats_visits.ip_id ,#__jstats_visits.userid, #__jstats_ipaddresses.nslookup'
        . ' FROM #__jstats_visits,#__jstats_ipaddresses'
        . ' WHERE #__jstats_visits.ip_id = #__jstats_ipaddresses.id'
        . ' AND #__jstats_ipaddresses.type=1'
        . ' GROUP BY `#__jstats_visits` . ip_id'
        . ' ORDER BY Latest DESC';
	$sql_table .= ($limit != '') ? " LIMIT 0, ".$limit.";" : ";";



	$mainframe->_db->setQuery($sql_table);
	$rs_table = mysql_query($mainframe->_db->_sql);

	$table .= '<table cellspacing="1" width="100%" border="0">';		
//	$table .= "<TR> <td><b>Visitor</b></td>  <td><b>HowLongAgo</b></td> </TR>";

	while ($row = mysql_fetch_array($rs_table)) 
	{
		// Calulate how long ago we've seen the user
		$f1 = $row[0];
		$f2 = date("Y-m-d H:i:s");
		$dif = strtotime($f2)-strtotime($f1);

		$UserId = $row[2];
		if ($UserId=="0")
		{
			$UserName = "<small><small>".$row[3]."</small></small>";
		}
		else
		{
			// Get UserName from LoggedInName or NSLookup
			$sql_line = 'SELECT #__users.name'
		        . ' FROM #__users'
		        . ' WHERE #__users.id='.$UserId;

			$mainframe->_db->SetQuery($sql_line);
			$rs_line = mysql_query($mainframe->_db->_sql);
			$row_line = mysql_fetch_array($rs_line);

			$UserName = "<b>".$row_line[0]."</b>";


			mysql_free_result($rs_line);

		}

		// add the line to the table
//		$table .= "<TR> <td><b>&raquo; &nbsp;".$UserName."</b></td>  <td>".Sec2Str($dif)."</td> </TR>";
		$table .= "<TR> <td>&raquo; &nbsp;".$UserName."</td></tr>";
		$table .= "<tr> <td>".Sec2Str($dif)."</td></TR>";

/*
<tr>
<td><b> <?php echo $row->username ?></b><br><span="smalldark"><font size="1"><?php echo seg2tiempo($dif); ?></font></span></td>
</tr>

*/


	}
	mysql_free_result($rs_table);

	$table .= '</table>';

	return $table;
}





$content = "";
$content .= Table_LatestVisitors($mainframe, $params->get('limit'));

?>




