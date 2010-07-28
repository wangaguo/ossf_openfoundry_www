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
class polllist {

	function polllist(&$frontend) {

		$this->frontend =& $frontend;
		$conf = $frontend->conf;
		// get the polls
		$id = null;
		$polls = getPolls($frontend->data->pos, $conf);

		if (!$polls) {
			$frontend->text = JText::_('POLLXT_NO_POLLS');
			return;
		}
		
		// used to show table rows in alternating colours
		$tabclass = array ('sectiontableentry1', 'sectiontableentry2');
	
		$polllist->header = $conf->header;
	
		// page description
		$polllist->descrip = $conf->description_text;
	
		// page image
		$path = JUri::base()."images/stories/";
		if ($conf->image <> "") {
			$polllist->img = $path.$conf->image;
			$polllist->align = $conf->image_align;
		}
		else {$polllist->img ="";
	          $polllist->align = "";
	    }
	
		// item image
		
		if ($conf->itemimage <> "-1" && $conf->itemimage <> "") {
			$polllist->itemimg = $path.$conf->itemimage;
		} else
			$polllist->itemimg = JUri::base()."components/com_pollxt/images/"."status_r.png";
	
		if ($conf->itemimagenot <> "" && $conf->itemimagenot <> "-1") {
			$polllist->itemimgnot = $path.$conf->itemimagenot;
		} else
			$polllist->itemimgnot = JUri::base()."components/com_pollxt/images/"."status_g.png";
	
		$this->showList($polls, $tabclass, $polllist, $frontend->data->Itemid);
		$frontend->text = $this->frontend->text;
	
	}
	function showList($polls, $tabclass, $polllist, $Itemid) {
		$html = "";
		$conf = $this->frontend->conf;
		if ($conf->show_page_title) {
			$html = "<div class=\"componentheading".$conf->sfx."\">";
			$html .= htmlentities($polllist->header);
			$html .= "</div>";
		}
		
		$html .= "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\" class=\"contentpane".$conf->sfx."\">";
		if (!empty($polllist->img) && !empty($polllist->descrip)) {
			$html .= "<tr>";
			$html .= "<td width=\"60%\" valign=\"top\" class=\"contentdescription".$conf->sfx."\" colspan=\"2\">";
			if ($polllist->img) 
				$html .= "<img src=\"".$polllist->img."\" align=\"".$polllist->align."\" hspace=\"6\" alt=\"\" />";
			$html .= charEnc($polllist->descrip);
			$html .= "</td></tr>";
		}
		$html .= "<tr><td>";
		$html .= "<table cellspacing=\"1\" cellpadding=\"3\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		if ($conf->list_headings) {
			$html .= "<tr>";
			if ($conf->list_voted) {
				$html .= "<td height=\"20\" class=\"sectiontableheader".$conf->sfx."\">";
				$html .= JText::_('POLLXT_VOTABLE');
                $html .= "</td>";
			}
			$html .= "<td width=\"80%\" height=\"20\" class=\"sectiontableheader".$conf->sfx."\">";
			$html .= JText::_('POLLXT_POLL_TITLE');
			$html .= "</td>";
			if ($conf->list_votes) {
				$html .= "<td height=\"20\" class=\"sectiontableheader".$conf->sfx."\">";
				$html .= JText::_('POLLXT_VOTES');
                $html .= "</td>";
			}
			$html .= "</tr>";
		}
		$k = 0;
		foreach ($polls as $poll) {
		 	if ($conf->target=="mod") {
				$link = "javascript:document.forms.".$this->frontend->data->name.".id.value='".$poll->id."';";
				$link .= "document.forms.".$this->frontend->data->name.".state.value='init';";
				$link .= "xtInit('".$this->frontend->data->name."')";
				
			}
			else
				$link = JUri::base()."index.php?option=com_pollxt&task=init&pollid=".$poll->id;
				
			$menuclass = 'category'.$conf->sfx;
			$txt = "<a href=\"".$link."\" class=\"".$menuclass."\">".charEnc($poll->title)."</a>";
			$html .= "<tr class=\"".$tabclass[$k]."\">";
	        if ( $conf->list_voted) { 
            	$html .= "<td><center>";
				if (checkVote($poll)) {
					$html .= "<img src=\"".$polllist->itemimg."\" />";
				} else {
	            	$html .= "<img src=\"".$polllist->itemimgnot."\" />";
				}
			}
            $html .= "</center></td><td>";
			$html .= $txt;
			if ($conf->item_description) {
				$html .= "<br>".str_replace("\n", "<br/>", charEnc($poll->intro));
			}
            $html .= "</td>";
			if ( $conf->list_votes) {
            	$html .= "<td><center>";
				$html .= $poll->voters;
        		$html .= "</td>";
			}
			$html .= "</tr>";
			$k = 1 - $k;
		}
		$html .= "</table></td></tr></table>";
		$this->frontend->text = $html;
	}

}
?>