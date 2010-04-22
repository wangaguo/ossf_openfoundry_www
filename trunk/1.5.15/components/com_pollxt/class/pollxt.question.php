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

class xtQuestion {
var $tabclass_arr = null;
var $options = null;
	function xtQuestion($frontend) {
		$this->frontend = $frontend;
		$this->tabcnt = 0;
	}
	
	function load($q)    {
   		
		$database = JFactory::getDBO();
		$this->tabclass_arr = array ("sectiontableentry2".$this->frontend->conf->sfx, 
									 "sectiontableentry1".$this->frontend->conf->sfx);

		$query = "SELECT * FROM #__pollsxt_options"."\nWHERE quid='$q->id' AND inact = '0' ORDER BY ordering";
		$database->setQuery($query);
		$this->options = $database->loadObjectList();
		$this->question = $q;
		if ($q->random == "1") {
			srand((double) microtime() * 1000000);
			shuffle($this->options);
		}

	}

	function getQuestionHtml() {
		$html  = "<div class=\"sectiontableheader".$this->frontend->conf->sfx."\">";
       	if ($this->frontend->conf->hide != "2")
       		$html .= "<a href=\"javascript:switchonoff('".$this->frontend->data->name.$this->question->id.
			   		 "')\"><small>[+]</small> ".$this->question->title."</a>";
		else
			$html .= $this->question->title;

		if ($this->question->obli) 
			$html .=  "<font class = \"hasTip\" title=\"".JText::_('POLLXT_OBLIGATORY_QUESTION')."\" color=\"red\">*</font>";

		$html .= "</div>";

		if (!empty($this->question->img_url)) { 
			$html .= createImg($this->question->imglink, $this->question->img_url, $this->question->imgor, 
			$this->question->imgsize, $this->frontend->conf->sfx, $this->frontend->conf->imgpath, 
			"sectiontableheader", $this->frontend->conf->imgpar);
		}
		return $html;	
	}

	function getOptionHtml() {
		$html = "<div id=\"poll".$this->frontend->data->name.$this->question->id."\"";
		if ($this->frontend->conf->hide == "1") $html .= " style = \"display:none\" ";

        foreach ($this->options as $o) { 
			$html .= $this->getOption($o);
			if ($this->tabcnt == 1) $this->tabcnt = 0;
			else $this->tabcnt ++;
			
		}
	 	$html .= "</div>";
	 
		return $html;	
	}

}

















?>