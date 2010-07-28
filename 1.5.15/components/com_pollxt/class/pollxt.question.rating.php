<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

class xtQuestionRating extends xtQuestion {

	function getOptionHtml() {
		$html = "<div id=\"poll".$this->frontend->data->name.$this->question->id."\"";
		if ($this->frontend->conf->hide == "1") $html .= " style = \"display:none\" >";

		$vals = split(",", $this->question->ratingval);
		$dess = split(",", $this->question->ratingdesc);
		
		
		foreach ($vals as $k=>$val) {
			$arr[$dess[$k]] = $val;
		}

		$i = 0;
		
    	foreach ($this->options as $o) {
			$vid = intval($this->question->id) * 100 + intval($i);		
			$onclick = " onchange=\"if (this.value != '-1') document.getElementById('p".$o->id."').value='".$o->id."';\"";
			$sel = xtMakeSelect($arr, false, 'xtVal['.$o->id.']', array(1,2), $onclick, "v".$o->id);
			 
		 	if (!empty ($o->img_url)) {
				$img = createImg($o->imglink, $o->img_url, $o->imgor, $o->imgsize, $this->frontend->conf->sfx, 
				$this->frontend->conf->imgpath, $this->tabclass_arr[$this->tabcnt], $this->frontend->conf->imgpar);
				$html .= "<div id=\"pollxtImgCol\">".$img."</div>";
			}

			$html .= "<div id=\"pollxtOptCol\">";		  
			$html .=  "<div class='".$this->tabclass_arr[$this->tabcnt]."'>";
			$html .= "<input type=\"hidden\" name=\"voteid[".$vid."][]\"".
               	     "id =\"p".$o->id."\" value=\"\" >"; 
			$html .= $o->qoption;
			$html .= "</div>";
			$html .= "</div>";
			
			$html .= "<div id=\"pollxtFreeCol\">".$sel."</div>";			
			
			$html .= "<div style=\"clear:both\"></div>"; 
			
			if ($this->tabcnt == 1) $this->tabcnt = 0;
			else $this->tabcnt ++;
			$i++;
		}
	 	$html .= "</div>";
	 
		return $html;	
	}
}

?>