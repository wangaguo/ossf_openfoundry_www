<?PHP /* $Id$ */

	/**
	* module visitors detail
	* @package mod_visitors_detail
	* @copyright 2004 JoomlaStats Team
	* @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
	* @version $Revision: 2.0 $
	* @author JoomlaStats Team
	*/
	
	//ensure this file is being included by a parent file
	defined('_VALID_MOS') or die ('Direct Access to this location is not allowed.');

	$content = '<table cellspacing="2" width="100%">';
/* Updated SQL Statement for JoomlaStats by Roy L. 21/05/06 */	
	$sql = "SELECT #__jstats_ipaddresses.tld,#__jstats_ipaddresses.system,#__jstats_ipaddresses.browser,#__jstats_topleveldomains.fullname FROM #__jstats_ipaddresses LEFT JOIN #__jstats_topleveldomains ON(#__jstats_ipaddresses.tld = #__jstats_topleveldomains.tld) WHERE ((#__jstats_ipaddresses.useragent='".GetUserAgent()."') AND (#__jstats_ipaddresses.ip='".GetIpAddress()."'))";

	$mainframe->_db->setQuery($sql);
	
	$rs = mysql_query($mainframe->_db->_sql);
	
	$row = mysql_fetch_array($rs);

	$content .= '<tr><td align="right"><b>Flag</b></td>';

/* Updated Image Src path for JoomlaStats by Roy L. 21/05/06 */	
	if ($row[0] == '')
	{
		$content .= "<td width=\"100%\" align=\"left\"><img src=\"components/com_joomlastats/images/unknown.png\"></td>";
	}
	else
	{
		$content .= "<td width=\"100%\" align=\"left\"><img src=\"components/com_joomlastats/images/".$row[0].".png\"></td>";
	}
	
	$content .= '</tr>';
	$content .= '<tr><td align="right"><b>Country</b></td>';
	$content .="<td>".$row[3]."</td></tr>";
	$content .= '<tr><td align="right"><b>OS</b></td>';
	$content .="<td>".$row[1]."</td></tr>";
	$content .= '<tr><td align="right"><b>Browser</b></td>';
	$content .="<td>".$row[2]."</td></tr>";
				
	mysql_free_result($rs);

	$content .= '</table>';

	function GetUserAgent()
	{		
		if (isset($_SERVER['HTTP_USER_AGENT']))
		{
			if ($_SERVER['HTTP_USER_AGENT'] != NULL)
			{
				return strtolower((string)$_SERVER['HTTP_USER_AGENT']);	
			}
			else
			{	
				return '';
			}
		}
		else
		{
			return '';
		}
	}
	
	function GetIpAddress() 
	{
		//get usefull vars:
		$client_ip = '';
		$x_forwarded_for = '';
		$remote_addr = '';

		$client_ip = (string)$_SERVER['HTTP_CLIENT_IP'];
		$x_forwarded_for = (string)$_SERVER["HTTP_X_FORWARDED_FOR"];
		$remote_addr = (string)$_SERVER['REMOTE_ADDR'];
	
		// then the script itself
		if (!empty ($client_ip) ) 
		{
			$ip_expl = explode('.',$client_ip);
			$referer = explode('.',$remote_addr);
	
			if($referer[0] != $ip_expl[0]) 
			{
				$ip=array_reverse($ip_expl);
				return implode('.',$ip);
			} 
			else 
			{
				return $client_ip;
			}
		} 
		elseif (!empty($x_forwarded_for) && strrpos($x_forwarded_for,'.') > 0 ) 
		{
			if(strstr($x_forwarded_for,',')) 
			{
				$ip_expl = explode(',',$x_forwarded_for);
				return end($ip_expl);
			} 
			else 
			{
				return $x_forwarded_for;
			}
		} 
		else 
		{
			return $remote_addr;
		}
	}	
?>