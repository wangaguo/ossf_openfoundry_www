<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php
require_once(JPATH_SITE . "/administrator/components/com_pollxt/class/pollxt.config.php");
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.plugin.php');


function charEnc($string) {
	if (!defined('_JEXEC'))
		$string = htmlentities($string);
	return $string;
}


function createImg($link = "1", $url, $or = "width", $size = "100%", $sfx ="", $path, $class, $imgpar) {

	$imgurl = xtCompat::sefRelToAbs($url);
	$html = "";
	$html = "<div class=\"".$class.$sfx."\">";
	if ($link == 1) {
		$clicklink = "window.open('".$imgurl."','Pic', '".$imgpar."')"; 
		$html .= "<a style=\"cursor:pointer\" onkeypress=\"".$clicklink."\" onclick = \"".$clicklink."\">";
	}
	$html .= "<img border=\"0\" ".$or."="."\"".$size."\" src=".$imgurl." />";
	
	if ($link == 1) $html .= "</a>";
	$html .= "</div>";
	return $html;
}

class xtUtil {
	function xtUtil($question, $i, $pollid, $conf) {
	 	$multiple = "";
		$this->listbox = "0";
		$this->conf = $conf;
		

		switch ($question[3]) {
					case 2 :
						$type = "checkbox";
						break;
					case 3 :
						$type = "select";
						$multiple = "size='1'";
						$this->listbox = "1";
						break;
					case 4;
						$type = "select";
						$multiple = "multiple size='".$question['multisize']."' ";
						break;
					case 5;
						$type = "hidden";
						break;
					case 7;
						$type = "textarea";
						break;
					default :
						$type = "radio";
						break;
		}
		$this->type = $type;
		$this->multiple = $multiple;
		$this->qcount = $i;
		$this->style = $question["style"];
	}
	function getOptions($options, $name) {
	$tabclass_arr = array ("sectiontableentry2".$this->sfx, "sectiontableentry1".$this->sfx);
	$tabcnt = 0;
	$html = "";
//	$html = "<div id=\"poll".$name.$options[0][1]."\"";
//	if ($this->conf->hide == "1") $html .= " style = \"display:none\" ";
//	$html .= ">";
		if ($this->type == "select") {
			$vid = intval($this->qcount);
			if (!empty ($options[0]['img_url'])) {
			 	$html = createImg($options[0]['imglink'], $options[0]['img_url'], $options[0]['imgor'], $options[0]['imgsize'], $this->sfx, $this->imgpath, $tabclass_arr[$tabcnt], $this->imgpar);
			}
            $html .= "<div class='".$tabclass_arr[$tabcnt]."'>".
                	 "<select ".$this->multiple." class=\"inputbox".$this->sfx."\"".
                     "name=\"voteid[".$vid."][]\" id=\"voteid[".$vid."][]\">";
			if ($this->listbox == "1") $html .= "<option value=\"\" >".JText::_('POLLXT_PLEASE_SELECT')."</option>";                     
            foreach ($options as $o) { 
            	$html .= "<option value=\"".$o[0]."\" >".$o[2]."</option>";
			}
            $html .= "</select>";
            $html .= "</div>";
		}
		else {
		 	$i = 0;
            foreach ($options as $o) { 
				if ($this->type == "radio")
					$vid = intval($this->qcount) * 100;
				else
					$vid = intval($this->qcount) * 100 + intval($i);
				
				$img[$i] = "";
				$free[$i] = "";
				if (!empty ($o['img_url'])) {
			 	$img[$i] = createImg($o['imglink'], $o['img_url'], $o['imgor'], $o['imgsize'], $this->sfx, $this->imgpath, $tabclass_arr[$tabcnt], $this->imgpar);
				}
				$lab = "";
				if ($this->type=="radio") $lab = "label_radio";
				if ($this->type=="checkbox") $lab = "label_check";
				
				if ($this->conf->wordwrap=="")
					$l = 9999;
				else
					$l = $this->conf->wordwrap;
				
				$comps = split(";",$o[2]);
				$o[2] = $comps[0];
				if (isset($comps[1])) $link = "<a target=\"_blank\" href=\"".$comps[1]."\"><img border=\"0\" src=\"".JUri::base()."images/M_images/weblink.png\"/></a>"; 
				else $link = false;
				$o_intro = mb_substr($o[2],0,strpos(wordwrap( $o[2], $l, "\n" ),"\n"), 'UTF-8');
				if (strlen($o_intro)== 0) $o_intro = $o[2];
				$o_rest = mb_substr($o[2],strlen($o_intro), 'UTF-8');
				
				$inp[$i]  = "<div class='".$tabclass_arr[$tabcnt]."'>";
				$inp[$i] .= "<label class=\"".$lab."\" for=\"voteid[".$vid."][]\">";
		 		$inp[$i] .= "<input type=\"".$this->type."\" name=\"voteid[".$vid."][]\"".
                  	     "id=\"p".$o[0]."\" value=\"".$o[0]."\" >";
                $inp[$i] .= $o_intro."</input></label>";
                if ($o_rest != "") {
				$inp[$i] .= "<a href=\"javascript:switchonoff('".$vid.$i.$name."')\"> +</a>";
				$inp[$i] .= "<div style=\"display:none\" id=\"poll".$vid.$i.$name."\">"; 
				$inp[$i] .= $o_rest."</div>";
				}
				if ($link) $inp[$i] .= $link;
				$inp[$i] .="</div>";
				
				if ($o['freetext']==1) {
                  if ($o['multirows']==1 || $o['multirows']=="") {
                    $free[$i] = "<input type=\"text\" size=\"".$o['multicols']."\" id=\"v".$o[0]."\"".
						     " class=\"inputbox".$this->sfx."\"".
                             " onchange=\"javascript:checkSelected(".$o[0].")\"". 
                             " name=\"xtVal[".$o[0]."]\" />";
                  } else { 
		            $free[$i] = "<textarea rows=\"".$o['multirows']."\" cols=\"".$o['multicols']."\" id=\"v".$o[0]."\"". 
						     " class=\"inputbox".$this->sfx."\"".
                             " onchange=\"javascript:checkSelected(".$o[0].")\"". 
                             " name=\"xtVal[".$o[0]."]\" />".
                       		 "</textarea>";
				 }
				}				
				if ($img[$i] !="") $html .= "<div id=\"pollxtImgCol\">".$img[$i]."</div>";
				if ($inp[$i] !="") $html .= "<div id=\"pollxtOptCol\">".$inp[$i]."</div>";
				if ($free[$i] !="") $html .= "<div id=\"pollxtFreeCol\">".$free[$i]."</div>";
				if ($this->style != "h") $html .= "<div style=\"clear:both\"></div>"; 

				$i++;
				if ($tabcnt == 1) $tabcnt = 0;
				else $tabcnt ++;
			}
			if ($this->style == "h") $html .= "<div style=\"clear:both\"></div>"; 
/*			$html = "<div style=\"float:left\">";
			if (isset($img)) foreach ($img as $h) $html .= $h."<br/>"; 
			$html .= "</div><div style=\"float:left\">";
			if (isset($inp)) foreach ($inp as $h) $html .= $h."<br/>"; 
			$html .= "</div><div style=\"float:left\">";
			if (isset($free)) foreach ($free as $h) $html .= $h."<br/>"	; 
			$html .= "</div><div style=\"clear:both\"></div>"; */

		}
	$html .= "</div>";	
	return $html;
	}
}

/*------------------------------------------------------------------------------
Check if user already voted for that poll
------------------------------------------------------------------------------*/
function checkVote($poll, $email = null) {


	$database = JFactory::getDBO();
	$my = JFactory::getUser();
	
	$conf = new pollxtConfig();
	$conf->pollid = $poll->id;
	$conf->load();
	$result = "";
	//check date and time
		$now = date("Y-m-d");
		$nowtime = date("H:i:s");

	if (
		($poll->datefrom > $now && $poll->datefrom != "0000-00-00")
	OR ($poll->datefrom == $now AND $poll->timefrom > $nowtime) 
	OR ($poll->dateto < $now && $poll->dateto != "0000-00-00")	
	OR ($poll->dateto == $now AND $poll->timeto > $nowtime)
		) 
		return true;


	$cookiename = "voted$poll->id";
	$vcookie = JRequest::getVar($cookiename, '0', 'COOKIE');

	$scookie = false;

	$now = strtotime(date("Y-m-d G:i:s"));

	//cookie check
	if ($conf->seccookie==1 && $vcookie != 0) {
		if (!$poll->multivote)
			$scookie = true;
		elseif ((strtotime($vcookie)+ $poll->lag*60) > $now)
			$scookie = true;
	}

	$ip = $conf->ip;

	if (!$my->id)
		$logonQuery = "AND p.logon=0";
	else
		$logonQuery = "";

    $where = "";
    $id = intval ($poll->id);
    
    // 
    if ($my->id) $uname = $my->username;
    elseif ($email) $uname = $email;
    else $uname = null;
    
	// if logged on check username else check IP
	if (($uname) and $conf->secuname and $conf->secip) {
		$where = " AND (d.user = \"".$uname."\" OR d.ip = \"".$ip."\" )";
	}
	elseif ($conf->secip) $where = " AND d.ip = \"".$ip."\"";
	elseif (($uname) and $conf->secuname) $where = " AND d.user = \"".$uname."\"";

	if (!$where=="") {
		$query = "SELECT d.*
																																      FROM #__pollsxt_questions AS q
																																      LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
																																      LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
																																      WHERE q.pollid =\"".$id."\"".$where."ORDER BY d.datu DESC
																																      LIMIT 1";

		$database->setQuery($query);

		$result = $database->loadObject();
		echo $database->getErrorMsg();
	}
	$sip = false;
	if (isset($result->datu)) {	
		if (!$poll->multivote )
			$sip = true;
		elseif (strtotime($result->datu)+ $poll->lag*60 > $now)
			$sip = true;
	}

	return ($scookie or $sip);
}
/*------------------------------------------------------------------------------
Gets the Poll List
------------------------------------------------------------------------------*/

function getPolls($pos, $conf, $pollid=null, $Itemid=null, $task = null) {
	$database = JFactory::getDBO();
	$my = JFactory::getUser();


// menuquery: necessary for module only 
	if ($pos == "mod") 
		$query = "FROM #__pollxt_menu AS pm JOIN #__pollsxt AS p \n".
					 " ON p.id=pm.pollid WHERE (pm.menuid='$Itemid' OR pm.menuid='0') AND \n";
	else 
		$query = "FROM #__pollsxt AS p WHERE \n";

// if pollid is given
	if ($pollid) {
		$query .= "p.id='$pollid' AND \n";
	}

// category
	if (isset($conf->category) && $conf->category != "") $query .= " p.category='$conf->category' AND \n";

// component, bot and module position
	if ($pos == "mod")
		$query .= " (p.type = '1' OR p.type = '0')  AND \n";
	if ($pos == "com")
		$query .= " (p.type = '2' OR p.type = '0')  AND \n";
	if ($pos == "bot")
		$query .= " (p.type = '3' OR p.type = '0')  AND \n";

// only logged in 
	if (!$my->id && $task != "showResult")
		$query .= " p.logon=0 AND \n";
// only published (if not results)
	if ($conf->publ == "1" || $task != "showResult") {
		$query .= " p.published=1 AND \n";		
	}
// published date & time
/*	if (!$conf->expired == "1") {
		$now = date("Y-m-d");
		$nowtime = date("H:i:s");
		
		$query .= " (p.datefrom < '$now' OR p.datefrom='0000-00-00' OR (p.datefrom = '$now' AND p.timefrom <= '$nowtime') ) AND (p.dateto > '$now' OR p.dateto='0000-00-00' OR (p.dateto = '$now' AND p.timeto >= '$nowtime') ) AND \n";
	}*/
	$query1 = "SELECT p.* ".$query." id > 0 ORDER BY p.ordering;";

	$database->setQuery($query1);
	$polls = $database->loadObjectList();
	echo $database->getErrorMsg();

// Plugin for additional checks
	$apolls = array();
	foreach ($polls as $p) {
		$plugin = new configPlugin($p->id);
		if ($plugin->getAuth())
			$apolls[] = $p;
	}
	

	if (count($apolls) == 0) return false;
	
	return $apolls;
}

function sortPolls($polls, $conf) {
	
	if (!is_array($polls)) return;
	// Random Polls
	srand((double) microtime() * 1000000);
	if ($conf->orderby == 2)
		shuffle($polls);
	// Only where voting allowed
	if ($conf->disp == 3 && count($polls) > 1) {
		$tmp = $polls;
		unset ($polls);
		$polls = array ();
		foreach ($tmp as $t) {
			if (!checkVote($t) or $t->multivote)
				array_push($polls, $t);
		}
	}
	return $polls;
}


?>