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
require_once(JPATH_SITE . "/administrator/components/com_pollxt/pollxt.common.php");
require_once(JPATH_SITE . "/administrator/components/com_pollxt/class/pollxt.config.php");
require_once(JPATH_SITE . "/components/com_pollxt/class/pollxt.validate.php");
require_once(JPATH_SITE . "/components/com_pollxt/class/pollxt.vote.php");
require_once(JPATH_SITE . "/components/com_pollxt/class/pollxt.result.php");
require_once(JPATH_SITE . "/components/com_pollxt/class/pollxt.polllist.php");
require_once(JPATH_SITE . "/components/com_pollxt/class/pollxt.voteform.php");
require_once (JPATH_SITE . "/components/com_pollxt/class/pollxt.utilities.php");
class xtFrontend {
var $text = null;
	function xtFrontend($data) {
	 
	$database = JFactory::getDBO();	
 	if (get_magic_quotes_gpc() == 1)
		$this->data = json_decode(stripslashes($data));
	else
		$this->data = json_decode($data);
		
//		$this->message = "";
		if (isset($this->data->plugin))
			$this->getPlugin($this->data->plugin);
		if (!isset($this->data->texts)) $this->data->texts = array();
		$poll = new mosPoll($database);
		$poll->load($this->data->pollid);
		$this->poll = $poll;
//		print_r($this->data);
		$conf = new pollxtConfig();
	    $conf->pollid = $this->data->pollid;
	    $conf->itemid = $this->data->Itemid;
	    if (isset($this->data->params)) 
	    	$conf->parameters = json_decode($this->data->params);
	    $conf->load();
	    
		$this->conf = $conf;
		
		if ($conf->debug == "1" || $conf->debug == "3") {
			ini_set  ( "display_errors"  , "1"  );
			error_reporting(E_ALL);
		}
		
	}
	function execute() {
		switch ($this->data->state) {
		 	case "init":
				break;
			case "showForm":
				$class = new voteform($this);
				break;
			case "validate":
				$class = new validate($this);
				break;
			case "vote":
				$class = new vote($this);
				break;
			case "result":
				break;
			case "showResult":
				$class = new result($this);
				break;
			case "detail":
				break;
			case "showDetail":
				$class = new result($this);
				break;
			case "list":
				$class = new polllist($this);
				break;
		}
		if ($this->data->state = $this->getNext()) $this->execute();
		$ret = $this->output();
		return $ret;
		
	}
	function getPlugin($data) {
	 	$plug = array();
		foreach ($data as $d) {
			foreach ($d as $k=>$v) {
			$c = explode("_", $k);
		 	

			$o->$c[1] = $v;
			$plug[$c[0]] = $o;
		}
		}
		$this->plug = $plug;
	}
	function output() {
	
		if (isset($this->message))
			$ret->message = $this->message;
		else
			$ret->message = "";

		if (isset($this->func))
			$ret->func = $this->func;
		else
			$ret->func = "";

		if (isset($this->text))
			$ret->text = $this->text;
		else
			$ret->text = "";


		if (isset($this->error) && $this->error) {
			$ret->error = 1;
		}
		else {
			$ret->error = 0;
		}

		if (isset($this->select))
			$ret->select = $this->select;
		else
			$ret->select = "";

		if (isset($this->header))
			$ret->header = $this->header;
		else
			$ret->header = "";

		if (isset($this->intro))
			$ret->intro = $this->intro;
		else
			$ret->intro = "";

		if (isset($this->outro))
			$ret->outro = $this->outro;
		else
			$ret->outro = "";


		$ret->buttons = $this->getButtons();
		$ret->name = $this->data->name;
		
		return json_encode($ret);
	}
	
	function getButtons() {
	 	$html = "";
	 	$buttons = array();
		switch ($this->data->oldstate) {
		 	case "nopolls":
				$buttons = array("result");
				$html =  $this->createButtons($buttons);
				break; 	 	
		 	case "showForm":
				$buttons = array("vote", "result");
				$html =  $this->createButtons($buttons);
				break; 	 	
		 	case "validate":
				$buttons = array("vote", "result");
				$html =  $this->createButtons($buttons);
				break; 	 	
			case "showResult":
				$buttons = array("details", "pollback");
				$html =  $this->createButtons($buttons);
				break; 	 	
			case "nothing":
				$buttons = array("vote", "result");
				$html =  $this->createButtons($buttons);
				break; 	 	
			case "showDetail":
				$buttons = array("detailback");
				$html =  $this->createButtons($buttons);
				break; 	 	
				
	 	}
		
		return $html;
	}
	
	function getNext() {
		$imgpar = $this->conf->imgpar;

	 	$next = null;
	 	$this->data->oldstate = $this->data->state;
	 	$poll = $this->poll;

		switch ($this->data->state) {
			case "validate":
				if (!$this->error) $next = "vote";
				break;
			case "vote":
			
				switch ($poll->goto) {
					case "1" : // nowhere
						$this->message = $this->conf->thanks;
						$next = "showForm";
						break;
					case "2" : //URL
						if (strncasecmp($poll->goto_url, "http", 4) == 0)
							$redirUrl = $poll->goto_url;
						else
							$redirUrl = JRoute::_("index.php?$poll->goto_url");
						$this->func = "window.location.href=\"".$redirUrl."\"";
						$this->message = $this->conf->thanks;
						break;
					case "0" : //result
						$next = "result";
						break;
				}
				break;		
			case "result":	
				$Itemid = $this->data->Itemid;
				if ($poll->rdisp == "1" && $this->data->pos == "com") $poll->rdisp = "3";
				switch ($poll->rdisp) {
					case "1" :
						// set task=result and id
						$redirUrl = JRoute::_("index.php?option=com_pollxt&task=showResult&id=$poll->id&Itemid=$Itemid");
						$this->func = "window.location.href=\"".$redirUrl."\"";
						$next = "nothing";
						break;
					case "2" :
						// same, but this time index2
						$redirUrl = "index.php?option=com_pollxt&tmpl=component&task=showResult&isPopup=1&id=$poll->id&Itemid=$Itemid";
						$this->func = "window.open('".$redirUrl."', '_results')";
						$next = "nothing";
						break;
					case "3" :	 
						$next = "showResult";
						break;
				}
			break;
			case "detail":	
				$Itemid = $this->data->Itemid;
				if ($poll->rdispdw == "1" && $this->data->pos == "com") $poll->rdispdw = "3";
				switch ($poll->rdispdw) {
					case "1" :
						$redirUrl = JRoute::_("index.php?option=com_pollxt&task=showDetail&id=$poll->id&Itemid=$Itemid");
						$this->func = "window.location.href=\"".$redirUrl."\"";
					break;
					case "2" :
						$redirUrl = JRoute::_("index.php?option=com_pollxt&tmpl=component&task=showDetail&id=$poll->id&Itemid=$Itemid");
						$this->func = "window.open('".$redirUrl."', '_results', '$imgpar')";
					break;
					case "3" :	 
						$next = "showDetail";
					break;
				}
			break;
			case "init":
				$voted = checkVote($poll);
				if ((!$voted))
					$next = "showForm";
				else {
				 	switch ($this->conf->notvote) {
				 	  	case "1":
				 	  		$next = "showForm";
				 	  		break;
				 		case "2":
							$next = "showResult";
							break;
						case "3":
							$next = false;
							break;
					}
					if ($this->conf->notvoteerr)
							$this->message = JText::_('POLLXT_ALREADY_VOTE');
				}
			break;
		}
		return $next;
	}


	function createButtons($buttons) {

		$database = JFactory::getDBO();
		$my = JFactory::getUser();
		
		$menu = &JSite::getMenu();
		$m = $menu->getItem($this->data->Itemid);
		$params = $menu->getParams($this->data->Itemid);

		$poll = $this->poll;

		// Close Button (in Popup)
	 	$isPopup = $this->data->isPopup;//mosGetParam($_GET, 'isPopup', 0);
		$html = "";
	    if ($isPopup == 1) {
			$onclick = "JavaScript:self.close()";
			$back = $this->vrButtons($onclick, $this->conf->imgback, JText::_('PROMPT_CLOSE'), "pollxtBack" );
			$html .= $back->button;
		}	    
		$voted = checkVote($poll);

		foreach($buttons as $b) {
			switch ($b) {
			 	case "vote":
			 		if ($poll->vbtext != "") $text = $poll->vbtext;
					else $text = JText::_('BUTTON_VOTE');
			 		$onclick = "this.disabled='disabled';xtVote('".$this->data->name."')";
			 		$buttons = $this->vrButtons($onclick, $this->conf->imgvote, $text, "pollxtVote" );
			 		if ((!$voted) or ($poll->multivote)) $html .= $buttons->button;
			 	break;
			 	case "result":
			 		$onclick = "xtResults('".$this->data->name."')";
			 		$buttons = $this->vrButtons($onclick, $this->conf->imgresult, JText::_('BUTTON_RESULTS'), "pollxtResult" );
			 		if (($poll->rdispb == 1) or ($voted and $poll->rdispb == 2) or ($my->usertype == "Super Administrator")
					    || ($this->data->oldstate == "nopolls"))
			 			$html .= $buttons->button;
			 	break;
			 	case "details": 
				// Details button
//					if ($poll->rdispdw == 2 ) {
//						$onclick="location.href='".JUri::base()."/index.php?option=com_pollxt&tmpl=component&isPopup=1&id=".$poll->id."&amp;Itemid=".$this->data->Itemid."&task=detail'\"";
//					}
//					else { 
			 			$onclick = "xtDetail('".$this->data->name."')";
//					}
				$buttons = $this->vrButtons($onclick, $this->conf->imgdetail, JText::_('POLLXT_DETAIL'), "pollxtDetail" );
				if (($poll->rdispd=="1") or ($my->usertype == "Super Administrator")) {
					$html .= $buttons->button;
				}
				break;
				case "detailback":
					if ($isPopup==1) {
						$onclick="location.href='".JUri::base()."index.php?option=com_pollxt&tmpl=component&isPopup=1&id=".
							 $poll->id."&amp;Itemid=".$this->data->Itemid."&task=results'\" ";
					}
					else {
			 			$onclick="xtResults('".$this->data->name."')";
					$buttons = $this->vrButtons($onclick, $this->conf->imgback, JText::_('POLLXT_BACK'), "pollxtBack" );
					$html .= $buttons->button;
					}
					
				break;		
				case "pollback":
						if (((!$voted) or ($poll->multivote)) && (!$isPopup==1)) {
			 				$onclick="xtInit('".$this->data->name."')";
							$buttons = $this->vrButtons($onclick, $this->conf->imgback, JText::_('POLLXT_BACK'), "pollxtBack" );
							$html .= $buttons->button;
			 			}
			 				
				break;

			}
		}
		$html .="<div style=\"clear:both\"></div>";
		return $html;
	}

	function vrButtons($onclick, $img, $text, $class) {
//	$imgvote = $this->conf->imgpath.$this->conf->imgvote;
//	$imgresult = $this->conf->imgpath.$this->conf->imgresult;
	$imgp = JUri::base().$img;
//    $name = $this->data->name;
//	$rlink = "xtResults('".$name."');";
    
	switch($this->conf->btnstyle) {
	case "1": // background image

			$xthtml->button = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">".$text."</label>"."<button style=\"background-image:url('".$imgp."')\" type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\"".$text."\" onclick=\"".$onclick."\" >".$text."</button>";
			break;

			case "2": //individual
			$xthtml->button = "<div name=\"task_button\" "."id=\"pollxtButton\" class=\"".$class."\" value=\"".$text."\" onclick=\"".$onclick."\" >"."<label for=\"task_button\" ".">"."</label>".$text."</div>";				
			break;
			default:  // STANDARD Buttons (with/ without image)
			if ($img != -1 && $img)
				$xthtml->button = "<a style=\"cursor:pointer\" >"."<img border=\"0\" alt=\"".$text."\" "."src=\"".$imgp."\" "."onclick=\"".$onclick."\" >"."</a>";
			else
				$xthtml->button = "<label for=\"task_button\" ".">"."</label>"."<button type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\"".$text."\""." onclick=\"".$onclick."\" >".$text."</button>";
			break;
			}
	return $xthtml;
	}
}














?>
