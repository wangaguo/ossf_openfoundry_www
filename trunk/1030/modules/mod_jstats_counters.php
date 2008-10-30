<?php
/*****************************************************************
 * 
 * module jstats_visitors_by_country
 * @package mod_jstats_visitors_by_country
 * @copyright 2007 JoomlaStats Team
 * @license http://www.gnu.org/copyleft/gpl.html. GNU Public License
 * @version $Revision: 1.8 $
 * @author JoomlaStats Team <www.JoomlaStats.org>
**
** Based on                                                     **
**         Zeltru-Design TFS CounterStats                       **
**                                                              **
**         @ Released under GNU/GPL License:                    **
**         http://www.gnu.org/copyleft/gpl.html                 **
*****************************************************************/

defined('_VALID_MOS') or die ('Direct Access to this location is not allowed.');

global $mosConfig_offset;


/* Get DateStamps */

// might want to use JoomlaStats time offset
//$date_today = strtotime("now");
$date_today = (time() + ($mosConfig_offset*60*60));
$date_yesterday = strtotime("-1 day", $date_today);

$date_today_d = date("d", $date_today);
$date_today_m = date("n", $date_today);
$date_today_y = date("Y", $date_today);

$date_yesterday_d = date("d", $date_yesterday);
$date_yesterday_m = date("m", $date_yesterday);
$date_yesterday_y = date("Y", $date_yesterday);

$moduleclass_sfx = $params->get("moduleclass_sfx", "");
$v_counter_offset = (int)$params->get("v_counter_offset", 0);
$p_counter_offset = (int)$params->get("p_counter_offset", 0);

$occurred_text = $params->get("occurred", "");

/* make Counters */
$counters = array();
$counter_names = array(
                  array("name"  => "v_today",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 AND #__jstats_visits.day=" . $date_today_d . " AND #__jstats_visits.month=" . $date_today_m . " AND #__jstats_visits.year=" . $date_today_y . " GROUP by #__jstats_visits.day"),
                  array("name"  => "v_yesterday",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 AND #__jstats_visits.day=" . $date_yesterday_d . " AND #__jstats_visits.month=" . $date_yesterday_m . " AND #__jstats_visits.year=" . $date_yesterday_y . " GROUP by #__jstats_visits.day"),
                  array("name"  => "v_month",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 AND #__jstats_visits.month=" . $date_today_m . " AND #__jstats_visits.year=" . $date_today_y . " GROUP by #__jstats_visits.month"),
                  array("name"  => "v_total",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1"),
                        
                  array("name"  => "v_maxaday",
//                      "query" => "SELECT SQL_BIG_RESULT count(*) as maxcount FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 GROUP by #__jstats_visits.day   ORDER by maxcount DESC LIMIT 1"),
                        "query" => "SELECT SQL_BIG_RESULT count(*) as maxcount, year, month, day FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 GROUP by year, month, day ORDER by maxcount DESC LIMIT 1"),
                  array("name"  => "v_maxamonth",
//                      "query" => "SELECT SQL_BIG_RESULT count(*) as maxcount FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 GROUP by #__jstats_visits.month ORDER by maxcount DESC LIMIT 1"),
                        "query" => "SELECT SQL_BIG_RESULT count(*) as maxcount, year, month      FROM #__jstats_visits LEFT JOIN #__jstats_ipaddresses ON (#__jstats_visits.ip_id=#__jstats_ipaddresses.id) WHERE #__jstats_ipaddresses.type=1 GROUP by year, month      ORDER by maxcount DESC LIMIT 1"),
                        
                  array("name"  => "p_today",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_page_request WHERE day=" . $date_today_d . " AND month=" . $date_today_m . " AND year=" . $date_today_y),
                  array("name"  => "p_yesterday",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_page_request WHERE day=" . $date_yesterday_d . " AND month=" . $date_yesterday_m . " AND year=" . $date_yesterday_y),
                  array("name"  => "p_month",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_page_request WHERE month=" . $date_today_m . " AND year=" . $date_today_y),
                  array("name"  => "p_total",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_page_request"),
                        
                  array("name"  => "bots",
                        "query" => "SELECT SQL_BIG_RESULT count(*) FROM #__jstats_ipaddresses, #__jstats_visits WHERE (#__jstats_visits.ip_id = #__jstats_ipaddresses.id) AND (#__jstats_ipaddresses.browser !='') AND (#__jstats_ipaddresses.type =2) AND (#__jstats_visits.day =" . $date_today_d . ") AND (#__jstats_visits.month =" . $date_today_m . ") AND (#__jstats_visits.year =" . $date_today_y . ")"),

                  array("name"  => "data_since",
                        "query" => "SELECT min(time) FROM #__jstats_visits`"),                        
                      );
                      
for ($i=0, $n=count($counter_names); $i<$n; $i++)
{
  $counters[$i] = new JStatsCounter($params, $counter_names[$i]["name"], ($i+1));
  $counters[$i]->setCounter($counter_names[$i]["query"], $occured_text);
}


/* reorder */
$new_counter = array();
foreach ($counters as $c)
{
  if ($c->published)
  {
    $new_i = $c->ordering;
    while (isset($new_counter[$new_i]))
      $new_i++;
    $new_counter[$new_i] = $c;
  }
}
unset($counters);
ksort($new_counter);
reset($new_counter);


/* Diplay */

$out = '
<table border="0" width="100%" cellpadding="0" cellspacing="0"'. ($moduleclass_sfx?' class="'. $moduleclass_sfx .'"':'') .'>
';
foreach ($new_counter as $c)
{
  if ($c->name == 'v_total' && is_int($v_counter_offset))
    $c->counter = $c->counter + $v_counter_offset;
  if ($c->name == 'p_total' && is_int($p_counter_offset))
  	$c->counter = $c->counter + $p_counter_offset;
  $out .= '
<tr>
  <td>' . $c->label . '</td>
  <td align="right">' . $c->counter . '</td>
</tr>
  ';

  if ($c->showdate)
  {
  $out .= '
<tr>
  <td>'. $occurred_text .'</td>
  <td align="right">' . $c->date . '</td>
</tr>
  ';  	
  }
}

$out .= '
</table>';

echo $out;


class JStatsCounter
{
  var $id;			// int		reordered id
  var $name;		// string
  var $label;		// string
  var $published;	// bool
  var $ordering;	// int
  var $counter;		// int / string
  var $date;		// string	when the max occured
  var $showdate;	// bool
  
  function JStatsCounter($params, $counter_name, $id)
  {
    $this->id       = $id;
    $this->name     = $counter_name;
    $this->label    = $params->get($this->name . "_label", " ");
    
    if ($params->get($this->name . "_published") == 1)
    	$this->published = true;
    else
    	$this->published = false;
    	
    if ($params->get($this->name . "_showdate") == 1)
    	$this->showdate = true;
    else
    	$this->showdate = false;
    
    	
    $this->ordering = $params->get($this->name . "_ordering", 99);
    $this->counter = 0;
  }

  function setCounter($sql)
  {
    global $database;
    
    if (trim($sql)!="" && $this->published === true)
    {
      $database->setQuery($sql);
      
      if ($this->showdate)
      {
      	$row = $database->loadRow();
      	$this->counter = (int)$row[0];
      	$this->date = $row[1] ."-". + $row[2];	// fixed year month   //RB: maybe add a format field and 
      	if ($row[3] != 0)
      	  $this->date .= "-". $row[3];			// and possibly day
      }	
      else
      	if ($this->name == "data_since")
      	{
      		$this->counter = $database->loadResult();
      		$this->counter = substr($this->counter,0,strpos($this->counter," "));	// keep it as string and use only date part (example 2007-04-20 22:40:59)
    	}
      	else	
      		$this->counter = (int)$database->loadResult();
    }
  }
}

?>