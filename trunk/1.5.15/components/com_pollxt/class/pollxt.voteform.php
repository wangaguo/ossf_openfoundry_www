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
require_once(JPATH_SITE."/components/com_pollxt/class/pollxt.question.php");
class voteform {
	function voteform(&$frontend) {
		$this->poll = $frontend->poll;
		$this->data = $frontend->data;
		$this->conf = $frontend->conf;
		$this->frontend = $frontend;
		$plugin = new configPlugin($this->poll->id);

		$this->getQuestions();
		$htmlQuestions = $this->buildQuestions();
		$qc= 0;
		$html = "";
		foreach ($this->htmlQuestion as $q) { 
		 	$html .= $q; 
			$html .= $this->htmlOption[$qc]; 
			$qc++;
		} 
		$html .= $plugin->afterDisplay();
		$html .= $this->addEmail();
		
		$frontend->text = $html;
		$frontend->header = $this->getHeader();        
		$frontend->intro = $this->getIntro();
		$frontend->outro = $this->getOutro();
		$frontend->select = $this->createSelect();

//		if ($frontend->conf->hide == "1") 
//			$frontend->func = "document.getElementById('poll".$this->data->name."').style.display=\"none\";";

	}
	
	function getHeader() {
		$poll = $this->poll; 
		$conf = $this->conf;
		
		$html = "";
		if (isset($this->conf->header)) {

			if ($this->conf->show_page_title == "1" && $this->data->pos=="com") {
				$html .= "<div class=\"componentheading".$this->conf->sfx."\">";
				$html .= charEnc($this->conf->header); 
		  		$html .= "</div>";
			}
		}
	return $html;
	}
	
	function getIntro() {
		$poll = $this->poll; 
		$conf = $this->conf;
		$pollimg = "";
		
		if (!empty ($poll->img_url)) {
			$src = xtCompat::sefRelToAbs($poll->img_url);
			if ($poll->imglink == 1) {
				$onkeypress = "window.open('".$src."','Pic', '".$this->conf->imgpar."')";
				$pollimg = "<a style=\"cursor:pointer\" onkeypress=\"".$onkeypress."\""." onclick   =\"".$onkeypress."\" >";
			}
			$pollimg .= "<img border = \"0\" ".$poll->imgor."=\"".$poll->imgsize."\" "."src=\"".$src."\" />";
			if ($poll->imglink == 1)
				$pollimg .= "</a>";
		}
	 
	 	$html = "";
		if (!$poll->hidetitle) { 
			$html .= "<div id=\"pollxtTitle\" class=\"componentheading".$this->conf->sfx."\">";
			$html .= "<b>";
    		$html .= charEnc($poll->title);
            $html .= "</b></div>";
            $html .= "<div id=\"pollxtImg\">";
            $html .= $pollimg;
    		$html .= "</div>";
    		$html .= "<div style=\"clear:both\"></div>";
		}

		if ($poll->intro) { 
  			$html .= "<div>".str_replace("\n", "<br/>", charEnc($poll->intro))."</div>";
		} 
		return $html;
	}
	function getOutro() {
		$html = "";
		if ($this->conf->pollExp=="1" && $this->poll->dateto != '0000-00-00') {		
	        $html .= "<div class=\"smalldark".$this->conf->sfx."\">";
	        $html .= JText::_('POLLXT_VOTING_UNTIL').JHTML::_('date', $this->poll->dateto." ".$this->poll->timeto, JText::_('DATE_FORMAT_LC2')); 
			$html .= "</div>";
		}
		if ($this->poll->showvoters =="1") {
	        $html .= "<div class=\"smalldark".$this->conf->sfx."\">";
			$html .= JText::_('NUM_VOTERS').": ".$this->poll->voters;	
			$html .= "</div>";
		}
		$nav = $this->getNavButtons();
		// Poll Navigation 
		if (($this->data->pos == "com" ) && (($nav->navBack != "") || ($nav->navNext != "") )) {
		    $html .= "<br />";

    		$html .= "<center>";
    		$html .= $nav->navBack;
    		$html .= $nav->navNext;
		    $html .= "</center>";
		}
		
		return $html;
	}
		
	function buildQuestions() {
	$imgpar = $this->conf->imgpar;
	 
	 	$qc = 0;
	 	$sfx = $this->conf->sfx;
		foreach ($this->questions as $q) {
			// rating: new logic
			if ($q[3] == "7") {
				$class = "Rating";
				$name = "xtQuestion".$class;
				$file = "pollxt.question.".strtolower($class).".php";
				require_once($file);
				$r = new $name($this->frontend);
			 	$r->load($this->qo[$qc]);
				
				$this->htmlQuestion[$qc] = $r->getQuestionHtml();
				$this->htmlOption[$qc] = $r->getOptionHtml();		
			} 
		 
			// if it's a separator 
//				echo $q[3];			 
			elseif ($q[3] == "6" ) {
					$this->htmlQuestion[$qc] = "<div class=\"pollseparator".$sfx."\">".$q[2]."</div>";
					$this->htmlOption[$qc] = "";
				}
			else {
					$this->htmlQuestion[$qc]  = "<div class=\"sectiontableheader".$sfx."\">";
       				if ($this->conf->hide != "2")
       					$this->htmlQuestion[$qc] .= "<a href=\"javascript:switchonoff('".$this->data->name.$q[0]."')\"><small>[+]</small> ".$q[2]."</a>";
					else
						$this->htmlQuestion[$qc] .= $q[2];

      				if ($q['obli']) 
					   $this->htmlQuestion[$qc] .=  "<font title=\"".JText::_('POLLXT_OBLIGATORY_QUESTION')."\" color=\"red\">*</font>";

					$this->htmlQuestion[$qc] .= "</div>";

					$this->htmlQuestion[$qc] .= "<div id=\"poll".$this->data->name.$q[0]."\"";
					if ($this->conf->hide == "1") $this->htmlQuestion[$qc] .= " style = \"display:none\" ";
					$this->htmlQuestion[$qc] .= ">";
					if (!empty($q['img_url'])) { 
					$this->htmlQuestion[$qc]  .= createImg($q['imglink'], $q['img_url'], $q['imgor'], $q['imgsize'], $sfx, $this->conf->imgpath, "sectiontableheader", $imgpar);
					}
				
					$qhelper = new xtUtil($q, $qc, $this->poll->id, $this->conf);
					$qhelper->conf = $this->conf;
					$qhelper->imgpath = $this->conf->imgpath;
					$qhelper->sfx = $sfx;
					$qhelper->imgpar = $imgpar;
					$this->htmlOption[$qc] = $qhelper->getOptions($this->options[$qc],$this->data->name);
				}
			$qc++;
			
			}
	}
	function getQuestions() {
		$database = JFactory::getDBO();			
	   		$id = $this->poll->id;
			$query = "SELECT * FROM #__pollsxt_questions"
            ."\nWHERE pollid='$id' AND inact = '0' ORDER BY ordering ";
			$database->setQuery($query);
			$q = $database->loadObjectList();
			$this->qo = $q;
			$i = 0;
			// For each question
			foreach ($q as $p) {
				$questions[$i][0] = $p->id;
				$questions[$i][1] = $p->pollid;
				$questions[$i][2] = stripslashes($p->title);
				$questions[$i][3] = $p->type;
				$questions[$i]['img_url'] = $p->img_url;
				$questions[$i]['imgor'] = $p->imgor;
				$questions[$i]['imgsize'] = $p->imgsize;
				$questions[$i]['imglink'] = $p->imglink;
				$questions[$i]['multisize'] = $p->multisize;
				$questions[$i]['obli'] = $p->obli;
				$questions[$i]['style'] = $p->style;
				$i ++;
			}
			for ($i = 0, $n = count($questions); $i < $n; $i ++) {
				$quid = $questions[$i][0];
              	$id = intval ($quid);
				$query = "SELECT * FROM #__pollsxt_options"."\nWHERE quid='$id' AND inact = '0' ORDER BY ordering";
				$database->setQuery($query);
				$o = $database->loadObjectList();
				$j = 0;
				
				if ($q[$i]->random == "1") {
					srand((double) microtime() * 1000000);
					shuffle($o);
				}
				foreach ($o as $p) {
					$options[$i][$j][0] = $p->id;
					$options[$i][$j][1] = $p->quid;
					$options[$i][$j][2] = stripslashes($p->qoption);
					$options[$i][$j]['img_url'] = $p->img_url;
					$options[$i][$j]['imgor'] = $p->imgor;
					$options[$i][$j]['imgsize'] = $p->imgsize;
					$options[$i][$j]['imglink'] = $p->imglink;
					$options[$i][$j]['freetext'] = $p->freetext;
					$options[$i][$j]['multirows'] = $p->multirows;
					$options[$i][$j]['multicols'] = $p->multicols;
					if ($p->multirows =="") $p->multirows = "1";
					if ($p->multicols =="") $p->multicols = "10";
					$j ++;
				}
			}
		$this->questions = $questions;
		$this->options = $options;	
	}

	function createSelect() {
		
		$conf = $this->conf;
	    $querystring = "";
		unset($_GET["pollid"]);
		foreach ($_GET as $k=>$v) $querystring .= $k."=".$v."&";
	    $action = xtCompat::sefRelToAbs("index.php?".$querystring);
	
		$spolls = getPolls($this->data->pos, $conf);
		$pollist = "";
		if (($conf->selpo=="1") and (count($spolls) > 1)) {
			$pollist = "<form name=\"pollxt".$this->data->name."\" method=\"post\" action=\"$action\">";
			$pollist .= "\n".JText::_('POLLXT_SEL_POLL')."<select name=\"id\" class=\"inputbox\" size=\"1\"
	        onChange=\"document.forms.".$this->data->name.".id.value=this.options[selectedIndex].value;
	        if (this.options[selectedIndex].value != '') {xtInit('".$this->data->name."');}\">";
			$pollist .= "\n\t<option value=\"\">".JText::_('POLLXT_SEL_POLL')."</option>";
			for ($i = 0, $n = count($spolls); $i < $n; $i ++) {
				$k = $spolls[$i]->id;
				$t = charEnc($spolls[$i]->title);
				$sel = ($k == intval($this->poll->id) ? " selected=\"selected\"" : '');
				$pollist .= "\n\t<option value=\"".$k."\"$sel>".$t."</option>";
			}
			$pollist .= "\n</select>\n";
			$pollist .= "<input type=hidden name='pollid' value = ''></form>";
		}
	return $pollist;
	}	
	function addEmail() {
	 	$my = JFactory::getUser();
	 	
	 	$sfx = $this->conf->sfx;
	 	$html = "";
		if ($this->poll->email == "1") 
		 	$type = "input";
		else 
			$type = "hidden";
		
		if ($this->poll->email == "1") {
			$html .= "<div class=\"sectiontableheader".$sfx."\">";
			$html .= JText::_('POLLXT_EMAIL');
	       	$html .=  "<font title=\"".JText::_('POLLXT_OBLIGATORY_QUESTION')."\" color=\"red\">*</font>";
			$html .= "</div>";
		}
		if ($my->id) $email = $my->email;
		else $email = "";
		$input = "<input type=\"".$type."\" class=\"input\" name=\"email\" id=\"email\" value=\"".$email."\"/>";

		$html .= "<div class='sectiontableentry1".$sfx."' width=\"100%\">".
				 "<div id=\"pollxtOptCol\">".$input."</div>".
				 "<div style=\"clear:both\"></div></div>"; 
		
		return $html;
	}	
	function getNavButtons() {
		$navBack = "";
		$navNext = "";
		if ($this->conf->pollNav == '1') {
			$navPolls = getPolls("com", $this->conf, "", $this->data->Itemid);
			if (is_array($navPolls)) {
				$navPolls = sortPolls($navPolls, $this->conf);
				$pollcount = 0;
					foreach ($navPolls as $p) {
						if (($p->id == $this->poll->id)) {
							if ($pollcount > 0) {
								$prevPoll = $navPolls[$pollcount -1];
								$link = "document.forms.".$this->data->name.".id.value='".$prevPoll->id."';";
								$link .= "document.forms.".$this->data->name.".state.value='init';";
								$link .= "xtInit('".$this->data->name."');";
								$navBack = "<a href=\"javascript:".$link."\">[ ".JText::_('CMN_PREV_ARROW').JText::_('CMN_PREV')." ]</a>";
								}
							if ($pollcount < (count($navPolls) - 1)) {
								$nextPoll = $navPolls[$pollcount +1];
								$link = "document.forms.".$this->data->name.".id.value='".$nextPoll->id."';";
								$link .= "document.forms.".$this->data->name.".state.value='init';";
								$link .= "xtInit('".$this->data->name."');";
								$navNext = "<a href=\"javascript:".$link."\">[ ".JText::_('CMN_NEXT_ARROW').JText::_('CMN_NEXT')." ]</a>";
								}
							}
						$pollcount ++;
					}
			}
		}
	$nav->navBack = $navBack;
	$nav->navNext = $navNext;
	return $nav;
	}
	
}