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

class pollxtResultController {
var $sortByFields = null;
var $sortByDir = false;
 	function pollxtResultController(&$frontend) {

		$database = JFactory::getDBO();

	    $this->conf = $frontend->conf;
		$this->result = null;
		if (!isset($frontend->poll->id)) return;
		$id = $frontend->poll->id; 			
		$database->setQuery("SELECT q.id as quid, q.title , q.type, q.ordering, o.id as oid, o.qoption,
							q.imglink as qlink, q.img_url as qurl, q.imgor as qor, q.imgsize as qsize,
							q.ratingval, q.ratingdesc,
							o.img_url as ourl, o.imgor as oor, o.imgsize as osize,
							o.ordering as oordering
							FROM #__pollsxt_questions AS q
							LEFT JOIN #__pollsxt_options AS o ON o.quid = q.id
							WHERE q.pollid =  '$id' 
							AND q.type <> 6
							");
		
		$result = $database->loadObjectList();
		echo $database->getErrorMsg();
		$detCount = false;
		$detailx = array();
		$i = 0;
		foreach ($result as $r) {
			$database->setQuery("SELECT	* FROM #__pollxt_data WHERE optid = '$r->oid'");		
			$data = $database->loadObjectList();
			echo $database->getErrorMsg();
			if (count($data)>0) {
			 	$detCount = true;
				foreach ($data as $dat) {
				 	
					$detailx[$i] = clone($r);
					$detailx[$i]->count = count($data);
					$detailx[$i]->ip = $dat->ip;
					$detailx[$i]->user = $dat->user;
					$detailx[$i]->datu = $dat->datu;
					$detailx[$i]->value = $dat->value;
					$detailx[$i]->did = $dat->id;
			
					$i++;		
				}
			}
			else {
			 	if ($frontend->poll->rdispall == "1") {
					$d = $r;
					$d->count = 0;
					$d->ip = "";
					$d->user = "";
					$d->datu = "";
					$d->value = "";
					$d->did = 0;
					$detailx[$i] = $d;
					$i++;
				}
			}
		}
		$this->result = $detailx;

		if (!$detCount) $this->result = null;

		$database->setQuery("SELECT MAX(t1.datu) AS maxdate, " .
						"MIN(t1.datu) AS mindate, " .
						"t4.voters AS votes " .
						"FROM #__pollxt_data as t1, " .
						"#__pollsxt_options as t2, #__pollsxt_questions as t3, " .
						"#__pollsxt as t4 where t4.id='$id' " .
						"AND t1.optid = t2.id AND t2.quid = t3.id " .
						"AND t3.pollid = t4.id and t1.block = 0 " .
						"GROUP BY t3.id;");
		$dates = $database->loadObjectList();
		if (isset($dates[0])) {
			$this->firstVote = JHTML::_('date', $dates[0]->mindate);
			$this->lastVote = JHTML::_('date', $dates[0]->maxdate);
			$this->votes = $dates[0]->votes;
    	}
		
		$this->data = $frontend->data;

		$this->class_sfx = $this->conf->sfx;
		$this->pollid = $frontend->data->pollid;
		$this->Itemid = $frontend->data->Itemid;
		$this->poll = $frontend->poll;

		
	}
	function sortBy() {
		$s = new sortBy($this->sortByOrder, $this->sortByDir);
		$this->result = $s->usort($this->result);
	}
	function extendResult() {
		
	}

	function prepareResult() {
	 	
		$this->sortBy();
		$index = array();
	 	foreach ($this->sortByFields as $k=>$t) {
			$index[$k] = null;
		}
		$count = array();
	 	$j = 0;
	 	
	 	foreach ($this->result as $l) {
 		 	foreach ($this->sortByFields as $k=>$t) {       
				if ($l->$t != $index[$k]) {					
					$index[$k] = $l->$t;
 					$index[$k+1] = null;
 				 	$parent[$k] = $j ;
 					$o->parent = $parent;
  				 	$o->level = $k;
 				 	$o->data = $l;
 				 	$o->line = $j;
					$output[$j] = $o;
 				 	unset ($o);
 				 	$j++;
 				}
			}
			if ($l->did > 0) {			
				$o->data = $l;
				$o->level = count($this->sortByFields);
				$o->parent = $parent;
				$o->line = $j;
				$output[$j] = $o;
				unset($o);
				$j++;
			}
		}
	 	$this->result = $output;
	}
	
	function printResult() {
	 	$maxLevel = count($this->sortByFields);
	 	$html = "";
		foreach ($this->result as $r) {
			if ($r->level == $maxLevel)
			 	$html .= $this->printData($r);
			else {
				$func = "print_".$this->sortByFields[$r->level];
				$html .= $this->$func($r);
			}
		}
		return $html;
	}
	function getChildren($line) {
	 	$out = array();
		foreach ($this->result as $r) {
		 	if (isset($r->parent[$line->level])) $line1 = $r->parent[$line->level];
		 	else $line1="";
			if (($line1 == $line->line) && ($r->level == count($this->sortByFields))) {
			$out[] = $r;
			}
		}
		return $out;
	}
	
	function print_title($r) {
		$ret = "";
		$ret = "<div width=\"100%\" class=\"sectiontableheader\">"; 
		if ($r->data->qurl) {
			$ret .= createImg($r->data->qlink, $r->data->qurl, $r->data->qor, 
			$r->data->qsize, "", "", "sectiontableheader", "");	 

//			$ret .= "<img src=\"";
//	 		$ret .= xtCompat::sefRelToAbs($this->conf->imgpath.$r->data->qurl);
//	 		$ret .= "\" ".$r->data->qor."=\"".$r->data->qsize."\"/>";
	 }
	
		$ret .= $r->data->title."</div>";
		$this->colorx = 0;
		return $ret;
	}
	function print_qoption($r) {

		if (!isset($this->tabcnt)) $this->tabcnt = 0;
		$tabclass_arr = array ('sectiontableentry1'.$this->class_sfx, 'sectiontableentry2'.$this->class_sfx);

	 	$ret = "<div class=\"".$tabclass_arr[$this->tabcnt]."\">";
		if ($r->data->ourl) {
			$ret .= "<img src=\"";
	 		$ret .= xtCompat::sefRelToAbs($r->data->ourl);
	 		$ret .= "\" ".$r->data->oor."=\"".$r->data->osize."\"/>";
	 }

		if ($this->conf->wordwrap=="")
			$l = 9999;
		else
			$l = $this->conf->wordwrap;


		$o_intro = mb_substr($r->data->qoption,0,strpos(wordwrap( $r->data->qoption, $l, "\n" ),"\n"), 'UTF-8');
		if (strlen($o_intro)== 0) $o_intro = $r->data->qoption;
		$o_rest = mb_substr($r->data->qoption,strlen($o_intro), 'UTF-8');


		$ret .= $o_intro;
        if ($o_rest != "") {
			$ret .= "<a href=\"javascript:switchonoff('".$r->line."')\"> +</a>";
			$ret .= "<div style=\"display:none\" id=\"poll".$r->line."\">"; 
			$ret .= $o_rest."</div>";
		}
		$ret .= "</div>";

		$polls_maxcolors = $this->conf->maxcolors;
        $tdclass = '';
        $polls_barcolor = 0;

        if (!isset($this->colorx)) $this->colorx = 0;
		if ($polls_barcolor == 0) {
			if ($this->colorx < $polls_maxcolors) {
				$this->colorx = ++ $this->colorx;
			} else {
				$this->colorx = 1;
			}
			$tdclass = "polls_color_".$this->colorx;
			} else {
				$tdclass = "polls_color_".$polls_barcolor;
			}
	 	$count = $r->data->count; //count($this->getChildren($r));
	 	$l = $this->result[$r->parent[0]];
	 	$total = count($this->getChildren($l));
		$sum = $countrat = 0; 
		foreach ($this->getChildren($r) as $c) {
//		 	echo $c->data->value."-";
			$sum += intval($c->data->value); 
			$countrat++ ;
		}
		if ($count > 0)
			$avg = $sum/$countrat;
		else 
			$avg = 0;
		if ($r->data->type == "7") {
		 	$arr = split(",", $r->data->ratingval);
		 	asort($arr);
			$max = $arr[count($arr)-1];
			$min = $arr[0];
			$count = $avg - $min;
			$total = $max - $min;
			$rdesc = split(",", $r->data->ratingdesc);
			if (isset ($rdesc[round($avg-$min)])) $rdes = $rdesc[round($avg-$min)];
			else $rdes = "";
		}
		
		if ($total > 0) {
			$perc = round(($count * 100 / $total), 0);
			$percVal = round(($count * 100 / $total), 2);
		}
		else {
			$perc = 0;
			$percVal = 0;
		}
    	$width = ceil($perc * 0.90);
//		$ret = "";
	 	$ret .= "<div class=\"".$tabclass_arr[$this->tabcnt]."\">";
        $ret .= "<img src=\"".JUri::root()."components/com_pollxt/images/blank.png\" class=\"".$tdclass."\" height=\"".$this->conf->barheight."px\" width=\"".$width."%\" />";
		if ($r->data->type == "7") 
			$ret .= " ".round($count+$min,2);		
		else
			if ($this->conf->sh_abs) $ret .= " ".$count;
		if ($this->conf->sh_abs && $this->conf->sh_perc) $ret.= " ("; 
		if ($r->data->type == "7") 
			$ret .= $rdes;
		else 
        	if ($this->conf->sh_perc) $ret .= " ".$percVal."%";
		if ($this->conf->sh_abs && $this->conf->sh_perc) $ret.= ")"; 

		$ret .= "</div>";
		$this->tabcnt = 1 - $this->tabcnt;
		
		return $ret;
	}
	function printIntro() {
		$ret = "<div class=\"pollstableborder\" >";
		return $ret;
	}

	function printData($r) {
	}

	function printOutro() {
		$out = "</div><table style=\"margin-top:10px;\" border=\"0\">";
		if ($this->conf->sh_numvote == 1) {
			  $out .= "<tr>";
			  $out .= "<td class='smalldark".$this->class_sfx."'>".JText::_('NUM_VOTERS').": <br/><br/></td>";
			  $out .= "<td class='smalldark".$this->class_sfx."'>".$this->votes."<br/><br/></td>";
			  $out .= "</tr>";
		}
		if ($this->conf->sh_flvote == 1) {
			  $out .= "<tr>";
			  $out .= "<td class='smalldark".$this->class_sfx."'>".JText::_('FIRST_VOTE').": <br/><br/></td>";
			  $out .= "<td class='smalldark".$this->class_sfx."'>".$this->firstVote."<br/><br/></td>";
			  $out .= "</tr>";
			  $out .= "<tr>";
			  $out .= "<td class='smalldark".$this->class_sfx."''>".JText::_('LAST_VOTE').": <br/><br/></td>";
			  $out .= "<td class='smalldark".$this->class_sfx."'>".$this->lastVote."<br/><br/></td>";
			  $out .= "</tr>";
    	}
	   	$out .= "</table>";
  		return $out;		
	}
	function print_count($r) {
		
	}
	function getHTML() {
	 	if (!$this->result) return $this->noResults();
		$this->sortByFields = array ("title", "count", "qoption");
		if ($this->conf->asc == "ASC") $asc = "1";
		else $asc = "-1";
		
		if ($this->conf->orderby == "hits")
			$this->sortByOrder = array ("ordering"=>"1", "count"=>$asc, "oordering"=>"1");
		else
			$this->sortByOrder = array ("ordering"=>"1", "oordering"=>$asc);
		
		$this->extendResult();
		$this->prepareResult();
	
		$html  = $this->printIntro();
		$html .= $this->printResult();
		$html .= $this->printOutro();

		return $html;
	}
    function getPollList() {
		$database = JFactory::getDBO();
		$my = JFactory::getUser();


    	$ret = "";
   		if (!$my->id)
			$logonQuery = "AND logon=0";
		else
			$logonQuery = "";

	    if ($this->conf->publ)
			$publquery = "published=1";
		else
			$publquery = "id <> 0";

	    $query = "SELECT * FROM #__pollsxt"."\nWHERE ".
    	        $publquery.
        	    "\n".$logonQuery."\nORDER BY ordering";

		$database->setQuery($query);
		$polls = $database->loadObjectList();

	    if ($this->conf->resselpo == "0") { $pollist = null; }
    	else {
  	  		$sel = $this->pollid;
  			$opts[] = JHTML::_('select.option', "", JText::_('SEL_POLL'));
  			for ($i = 0, $n = count($polls); $i < $n; $i ++) {
    			if (($polls[$i]->rdispb != 2) or (($polls[$i]->rdispb == 2) and (checkVote($polls[$i]))) or ($my->usertype == "Super Administrator")) {
    					$k = $polls[$i]->id;
    					$t = charEnc($polls[$i]->title);
    					$opts[] = JHTML::_('select.option', $k, $t);
    			}
  			}
			$isPopup = JRequest::getVar('isPopup', 0);
			if ($isPopup) $index = "index2.php?isPopup=1&amp;"; 
			else $index = "index.php?";
  			
			$link = xtCompat::sefRelToAbs($index.'option=com_pollxt&amp;task=results&amp;Itemid='.$this->Itemid.'&amp;id=\' + this.options[selectedIndex].value + \'');

			$pollist = JHTML::_('select.genericlist', $opts, 'resselpo', "size=\"1\" class=\"inputbox\" style=\"width:160px\" id=\"resselpo\" onchange=\"document.forms.".$this->data->name.".id.value=this.options[selectedIndex].value;if (this.options[selectedIndex].value != '') {xtResults('".$this->data->name."');}\"" , 'value', 'text', $sel );
		$ret = "<div>";
    	$ret .= JText::_('POLLXT_SEL_POLL');
		$ret .= $pollist."</div>";

        }

  		return $ret;
	}
	function noResults() {
		$ret = JText::_('NO_RESULTS');
		return $ret;

	}
}
?>
