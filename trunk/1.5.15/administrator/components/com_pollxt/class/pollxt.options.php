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
class pageEditorOptions {

	function pageEditorOptions(&$page) {
		$this->page =& $page;	 
	}

	function applyOption() {
		$sQ = $this->page->selQuestion[0]; 
		$sel = $this->page->selOption;
		foreach ($sel as $s) {
			foreach ($this->page->options->$sQ->$s as $k=>$v) {
			 $x = "edit_".$k;
			 if (isset($this->page->edit->$x) && $this->page->edit->$x != "-1" )
		     	$this->page->options->$sQ->$s->$k = $this->page->edit->$x;
		     }
		}	
	}
	function newOption() {
		global $database;
		    $q = $this->page->options;
			$sQ = $this->page->selQuestion[0]; 
		    
		    $qdb->qoption = "New Option";
		    $qdb->quid = $sQ;
		    
		    $x=1;
		    if (isset($q->$sQ)) {
				foreach ($q->$sQ as $qi) {
				 	if ($x <= $qi->id) $x = $qi->id + 1;
				}
		    }
			$qdb->id = $x;
		    $qdb->ordering = $x+1;
			
			$qdb->upd = "I";
			$qdb->inact = "0";
			$qdb->img_url = "";
			$qdb->imgor = "width";
			$qdb->imgsize = "100";
			$qdb->imglink = "";
			$qdb->freetext = "";
			$qdb->multicols = "";
			$qdb->multirows = "";
			$qdb->newopt = "";
			

			$this->page->selOption = array($qdb->id);	

			$this->page->options->$sQ->$x = $qdb;
	}
	function delOption() {
		$sQ = $this->page->selQuestion[0]; 
		$sel = $this->page->selOption; 
		if (!isset($sel[0])) {
			$this->page->message = _POLLXT_PLEASE_SELECT_ENTRY;
			return;	    
		}
		foreach ($sel as $s) {
			$this->page->options->$sQ->$s->upd = "D"; 		
		}
	}

	function copyOption() {
		global $database;
			$sQ = $this->page->selQuestion[0]; 
			$s = $this->page->selOption; 
			if (!isset($s[0])) {
				$this->page->message = _POLLXT_PLEASE_SELECT_ENTRY;
				return;	    
			}
				
			foreach ($s as $sel) {
				$q = $this->page->options->$sQ;
				
				$sdb = $q->$sel;
			    
			    $qdb = clone($sdb);
			    $qdb->qoption = "Copy of ".$sdb->qoption;
			    
			    $x=1;
				foreach ($q as $qi) {
				 	if ($x <= $qi->id) $x = $qi->id + 1;
				}
			    $qdb->id = $x;
			    $qdb->ordering = $x+1;
				$qdb->upd = "I";			
				$selOption[] = $qdb->id;	
	
				$this->page->options->$sQ->$x = $qdb;
			}
			$this->page->selOption = $selOption;		
	}


	function getOptionArea() {
	    $q = $this->page->options;

		if (is_array($this->page->selOption)) {
	    	$arr = Array();
      		for ($i=0; $i < count($this->page->selOption); $i++) {
	        	$obj[$i]->value = $this->page->selOption[$i];
	        	$arr[] = $obj[$i];
      		}
      		$selected = $arr;
    	}
    	else $selected = $this->page->selOption;
		$questionid = $this->page->selQuestion;	
		if ($questionid == "" || count($questionid) > 1) return "&nbsp;";

		$questionid = $questionid[0];
        $xtopt = array();
        if (isset($q->$questionid)) {
	        foreach ($q->$questionid as $qi) {
	            if (strlen($qi->qoption) >= 39) {
	             $qtitle = mb_substr(stripslashes($qi->qoption),0,36, 'UTF-8')."...";
				}
	            else $qtitle = stripslashes($qi->qoption);
		        if ($qi->upd == "D") $qtitle = "<--".$qtitle."-->";
	
	            $xtopt[] = JHTML::_('select.option', $qi->id, stripslashes($qtitle) );
	      	}
		}
		
        $xtoptions = JHTML::_('select.genericlist', $xtopt, 'xtoptions',
       'size="10" onclick="xtAdminController(\'selectOption\')" style="width:260px" class="inputbox" multiple="true" id="xtoptions"' , 'value', 'text', $selected );

        $this->createHtml($xtoptions);
        return $this->html;

	}
	
	function orderOptions($inc) {
	 	$selQ = $this->page->selQuestion[0]; 
	    $options = $this->page->options;

		if (!isset($this->page->selOption[0])) {
			$this->page->message = _POLLXT_PLEASE_SELECT_ENTRY;
			return;	    
		}


		$sel = $this->page->selOption[0];
		$o = null;				
		$i = 1;


		// refresh ordering 
		foreach ($options->$selQ as $q) {
		 	if ($q->id == $sel) $o = $i;
			$q->ordering = $i;
			$qs[$q->id] = $q;
			$i++;
		}

		// order
		foreach ($qs as $qi) {
		 	$qid = $qi->id;
		 	$qj->$qid = $qi;
			if ($qi->ordering == ($o + $inc)) 
				$qj->$qid->ordering = $o;
			elseif ($qi->ordering == $o) 
				$qj->$qid->ordering = $o + $inc;
		}
		
		// sort 
		$sort = new sortBy(Array("ordering"=>1));
		$qj = $sort->usort($qj);

		//re-build array
		foreach ($this->page->options as $k=>$oj) {
			if ($k == $selQ) $qz->$k = $qj;
			else $qz->$k = $oj;
		}

		$this->page->options = $qz;
	}

	
	
	function createHtml($page) {

	 	$this->html = "";
		$this->html .= "<table class=\"adminform\">";
 		$this->html .= "<tr>";
 		$this->html .= "<th colspan=\"2\"><b>".JText::_('POLLXT_ADMIN_PE_OPTIONS')."</b></th></tr>";
 		$this->html .= "<tr>";
		$this->html .= "<td width=\"260\" align=\"left\">";
		$this->html .= $page;
		$this->html .= "</td>";
		$this->html .= "<td align=\"left\" valign=\"top\">";
		$this->html .= "<table>";
		$this->html .= "<tr>";
		$this->html .= "<td class=\"icon\">";
		$this->html .= "<a href =\"javascript:xtAdminController('orderUpOption')\"><img width=\"24\" title=\"Up\" alt=\"Up\" src=\"components/com_pollxt/uparrow.png\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_UP')."";
      $this->html .= "</a>";
      $this->html .= "</td>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href = \"javascript:xtAdminController('orderDownOption')\"><img width=\"24\" title=\"Down\" alt=\"Down\" src=\"components/com_pollxt/downarrow.png\" border=\"0\" />".JText::_('POLLXT_ADMIN_PE_DOWN')."";
      $this->html .= "</a>";
      $this->html .= "</td>";
      $this->html .= "<td></td></tr>";
      $this->html .= "<tr>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href=\"javascript:xtAdminController('newOption')\"><img title=\"New Question\" alt=\"New Question\" src=\"images/new_f2.png\" width=\"32\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_NEW')."</a>";
      $this->html .= "</td>";
      $this->html .= "<td class=\"icon\">";
	  $this->html .= "<!--      <a href=\"javascript:add_pb('xtpage')\"><img title=\"Insert Pagebreak\" alt=\"Insert Pagebreak\" src=\"images/forward_f2.png\" width=\"32\" border=\"0\" ><br/>Break -->&nbsp;";
      $this->html .= "</td>";
      $this->html .= "<tr>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href=\"javascript:xtAdminController('delOption')\"><img title=\"Delete Option\" alt=\"Delete Option\" src=\"images/delete_f2.png\" width=\"32\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_DELETE')."";
      $this->html .= "</td>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href=\"javascript:xtAdminController('copyOption')\"><img title=\"Copy Option\" alt=\"Copy Option\" src=\"images/copy_f2.png\" width=\"32\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_COPY')."";
      $this->html .= "</td></tr>";
      $this->html .= "</table>";
      $this->html .= "</td>";
 	  $this->html .= "</tr>";
 	  $this->html .= "</table>";
	}
	function getEditArea() {
		$sQ = $this->page->selQuestion[0];
		$sel = $this->page->selOption;
		if (!isset($sel[0])) return;
		if (count($sel) == 1) { 
			$q = $this->page->options->$sQ->$sel[0]; }
		else {
			$q = clone($this->page->options->$sQ->$sel[0]);
			$qi = clone($this->page->options->$sQ);
			foreach ($sel as $s) {
			 	$qs = $qi->$s;
			 	foreach ($qs as $k=>$v) {
					if ($q->$k != $v) {
						$q->$k = "-1";
					}
				}
			}
		}

		$html = "";
 	  	$html .= "<table class = \"adminform\" width=\"98%\">";
		$html .= "<tr>";
		$html .= "<th colspan=\"20\">".JText::_('POLLXT_ADMIN_PE_EDIT_OPTION')."</th>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td></td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_OPTION'), JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_OPTION_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_IMAGE_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_SIZE'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_IMAGE_SIZE_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_LINK'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_LINK_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_FREETEXT'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_FREETEXT_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_COLS'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_COLS_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_ROWS'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_ROWS_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_NEWOP'), JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_NEWOP_LONG'))."</td>";
		$html .= "<td class=\"icon\" rowspan=\"2\" valign=\"middle\" align=\"right\">";
		$html .= "<a href=\"javascript:xtAdminController('applyOption')\"><img title=\"Apply Changes\" alt=\"Apply Changes\" src=\"images/apply_f2.png\" align=\"top\" border=\"0\"/></a>";
		$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td valign=\"top\"><a onclick=\"activate('edit_inact', 'qtoggle')\" >";

		if ($q->inact) { $img="publish_x.png"; $alt="active"; }
        else {$img="publish_g.png"; $alt="inactive";} 

        $html .= "<img id=\"qtoggle\" src=\"images/".$img."\" alt=\"".$alt."\" border=\"0\" /></a>";
        $html .= "<input type=\"hidden\" id=\"edit_inact\" value=\"".$q->inact."\" />";
        $html .= "</td>";
		$html .= "<td valign=\"top\">";

		$html .= xtMakeInput($q, $sel, $this->page->options->$sQ, "qoption", 60);
		
		$html .= "</td>";
		$html .= "<td valign=\"top\">";

		$conf = new pollxtConfig();
		$conf->pollid = $this->page->poll->id;
		$conf->load();
		$html .= xtHTML::mediaManager("edit_img_url", $q->img_url, $conf->imgpath);           
		
		$html .= "</td>";

		$html .= "<td valign=\"top\">";

        $types = array(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_WIDTH')=>"width", JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_HEIGHT')=>"height");
        
		$html .= xtMakeSelect($types, $q->imgor, 'edit_imgor', $this->page->selOption);

		$html .= xtMakeInput($q, $sel, $this->page->options->$sQ, "imgsize", 5);
		$html .= "</td>";

		

		$html .= "<td valign=\"top\">";
		$html .= xtYesNo($q->imglink, "edit_imglink", $this->page->selOption);
		$html .= "</td>";

		$html .= "<td valign=\"top\">";
		$html .= xtYesNo($q->freetext, "edit_freetext", $this->page->selOption);
		$html .= "</td>";
		$html .= "<td valign=\"top\">";
		$html .= xtMakeInput($q, $sel, $this->page->options->$sQ, "multicols", 3);
		$html .= "</td>";
		$html .= "<td valign=\"top\">";
		$html .= xtMakeInput($q, $sel, $this->page->options->$sQ, "multirows", 3);
		$html .= "</td>";
		$html .= "<td valign=\"top\">";

		$types = array(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_NEVER')=>0, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_ONLY_REGISTER')=>1,
					   JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_ALWAYS_UNPUB')=>2,JText::_('ADMIN_POLL_MANAGER_QUESTIONS_AO_ALWAYS_PUB')=>3);
		$html .= xtMakeSelect($types, $q->newopt, "edit_newopt", $this->page->selOption);
		$html .= "</td>";
		$html .= " </tr>";
		$html .= " </table>";

		$html .= "</td>";
		$html .= "</tr>";
		$html .= "</table>";
		$html .= "</div>";	
		return $html;	
	}

}
?>