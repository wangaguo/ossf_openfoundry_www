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
class pageEditorQuestions {

	function pageEditorQuestions(&$page) {
		$this->page =& $page;	 
	}
	function getQuestionArea() {
		
//		print_r($this->page->questions);
	 	if (is_object($this->page->questions)) {
		    $questions = clone($this->page->questions);
		    
			$selected = makeSelected($this->page->selQuestion);
	
	        foreach ($questions as $qi) {
		        if (strlen($qi->title) >= 39)
	            	$qtitle = mb_substr(stripslashes($qi->title),0,36, 'UTF-8')."...";
	            else $qtitle = stripslashes($qi->title);
	            if ($qi->upd == "D") $qtitle = "<--".$qtitle."-->";
	            $xtopt[] = JHTML::_('select.option', $qi->id, $qtitle );
	        }
	        $xtpage = JHTML::_('select.genericlist', $xtopt, 'xtquestions',
	       'size="10" onclick="xtAdminController(\'selectQuestion\')" class="inputbox" style="width:260px" multiple="true" id="xtquestions"' , 'value', 'text', $selected );
		}
		else 
			$xtpage = null;
		
        $this->createHtml($xtpage);
        return $this->html;

	}
	
	function applyQuestion() {
		$sel = $this->page->selQuestion; 
		foreach ($sel as $s) {
			foreach ($this->page->questions->$s as $k=>$v) {
			 $x = "edit_".$k;
			 if (isset($this->page->edit->$x) && $this->page->edit->$x != "-1") {
			 	if ($this->page->edit->$x == "null") $this->page->edit->$x = "";
		     	$this->page->questions->$s->$k = $this->page->edit->$x;
		    }
		     }
		}	
	}
	function newQuestion() {
		global $database;
		    $x=1;

			if (isset($this->page->questions)) {
			    $q = $this->page->questions;
				foreach ($q as $qi) {
				 	if ($x <= $qi->id) $x = $qi->id + 1;
				}
		    }

//		    $this->page->questions->$x = new mosPollQuestion($database);
		    $qdb->title = "New Question";
		    $qdb->pollid = $this->page->poll->id;
		    
		    $qdb->id = $x;
		    $qdb->ordering = $x+1;
			
			$qdb->upd = "I";
			$qdb->inact = "";
			$qdb->type = "";
			$qdb->multisize = "";
			$qdb->img_url = "";
			$qdb->imgor = "width";
			$qdb->imgsize = "100";
			$qdb->imglink = "";
			$qdb->obli = "";
			$qdb->minvotes = "";
			$qdb->maxvotes = "";
			$qdb->ratingval = "";
			$qdb->ratingdesc = "";
			$qdb->random = "";
			$qdb->style = "v";
			$qdb->desc = "";
			

			$this->page->selQuestion = array($qdb->id);	
			$this->page->questions->$x = $qdb;
	}
	function delQuestion() {

		$sel = $this->page->selQuestion; 
		foreach ($sel as $s) {
			$this->page->questions->$s->upd = "D"; 		
			if (isset($this->page->options->$s)) {
				foreach ($this->page->options->$s as $k=>$v) {
					$this->page->options->$s->$k->upd = "D"; 		
				}
			}
		}
	}

	function copyQuestion() {
		global $database;
			$s = $this->page->selQuestion; 
			foreach ($s as $sel) {
			    $q = $this->page->questions;
				$sdb = $q->$sel;
			    
			    $qdb = clone($sdb);
			    $qdb->title = "Copy of ".$sdb->title;
			    
			    $x=1;
				foreach ($q as $qi) {
				 	if ($x <= $qi->id) $x = $qi->id + 1;
				}
			    $qdb->id = $x;
			    $qdb->ordering = $x+1;
				$qdb->upd = "I";			
				$selQuestion[] = $qdb->id;	
	
				$this->page->questions->$x = $qdb;
				if (isset($this->page->options->$sel)) {
					$options = clone($this->page->options->$sel);
					foreach ($options as $oi) {
					 	$ox = clone($oi);
						$ox->quid = $x;
						$ox->upd = "I";
						$oj[] = $ox;
					}
				
					$this->page->options->$x = $oj;
				}
			}
			$this->page->selQuestion = $selQuestion; 
	}
	
	function orderQuestions($inc) {
		$sel = $this->page->selQuestion[0];
		$questions = $this->page->questions;

		$o = null;				
		$i = 1;
		foreach ($questions as $q) {
		 	if ($q->id == $sel) $o = $i*10;
			$q->ordering = $i*10;
			$qid = $q->id;
			$qs->$qid = $q;
			$i++;
		}
		foreach ($qs as $qi) {
		 	$qid = $qi->id;
		 	$qj->$qid = $qi;
			if ($qi->ordering == $o) 
				$qj->$qid->ordering = $o + $inc*15;
		}
		$sort = new sortBy(Array("ordering"=>1));
		$qj = $sort->usort($qj);
		
		$this->page->selQuestion = array($sel);
		$this->page->questions = $qj;	
	}
	
	function createHtml($page) {
	 	$this->html = "";
		$this->html .= "<table class=\"adminform\">";
 		$this->html .= "<tr>";
 		$this->html .= "<th colspan=\"2\"><b>".JText::_('POLLXT_ADMIN_PE_QUESTIONS')."</b></th></tr>";
 		$this->html .= "<tr>";
		$this->html .= "<td width=\"260\" align=\"left\">";
		$this->html .= $page;
		$this->html .= "</td>";
		$this->html .= "<td align=\"left\" valign=\"top\">";
		$this->html .= "<table>";
		$this->html .= "<tr>";
		$this->html .= "<td class=\"icon\">";
		$this->html .= "<a href =\"javascript:xtAdminController('orderUpQuestion')\"><img width=\"24\" title=\"Up\" alt=\"Up\" src=\"components/com_pollxt/uparrow.png\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_UP')."";
      $this->html .= "</a>";
      $this->html .= "</td>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href = \"javascript:xtAdminController('orderDownQuestion')\"><img width=\"24\" title=\"Down\" alt=\"Down\" src=\"components/com_pollxt/downarrow.png\" border=\"0\" />".JText::_('POLLXT_ADMIN_PE_DOWN')."";
      $this->html .= "</a>";
      $this->html .= "</td>";
      $this->html .= "<td></td></tr>";
      $this->html .= "<tr>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href=\"javascript:xtAdminController('newQuestion')\"><img title=\"New Question\" alt=\"New Question\" src=\"images/new_f2.png\" width=\"32\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_NEW')."</a>";
      $this->html .= "</td>";
      $this->html .= "<td class=\"icon\">";
	  $this->html .= "<!--      <a href=\"javascript:add_pb('xtpage')\"><img title=\"Insert Pagebreak\" alt=\"Insert Pagebreak\" src=\"images/forward_f2.png\" width=\"32\" border=\"0\" ><br/>Break -->&nbsp;";
      $this->html .= "</td>";
      $this->html .= "<tr>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href=\"javascript:xtAdminController('delQuestion')\"><img title=\"Delete Question\" alt=\"Delete Question\" src=\"images/delete_f2.png\" width=\"32\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_DELETE')."";
      $this->html .= "</td>";
      $this->html .= "<td class=\"icon\">";
      $this->html .= "<a href=\"javascript:xtAdminController('copyQuestion')\"><img title=\"Copy Question\" alt=\"Copy Question\" src=\"images/copy_f2.png\" width=\"32\" border=\"0\" >".JText::_('POLLXT_ADMIN_PE_COPY')."";
      $this->html .= "</td></tr>";
      $this->html .= "</table>";
      $this->html .= "</td>";
 	  $this->html .= "</tr>";
 	  $this->html .= "</table>";
	}
	
	function getEditArea() {
		$sel = $this->page->selQuestion;
		if (count($sel) == 1)
			$q = $this->page->questions->$sel[0];
		else {
			$q = clone($this->page->questions->$sel[0]);
			$qi = clone($this->page->questions);
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
		$html .= "<th colspan=\"20\">".JText::_('POLLXT_ADMIN_PE_EDIT_QUESTION')."</th>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td></td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_QUESTION'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_QUESTION_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_LINES'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_LINES_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_OBLIG'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_OBLIG_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_SIZE'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_SIZE_LONG'))."</td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_LINK'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_LINK_LONG'))."</td>";
		$html .= "<td class=\"icon\" rowspan=\"2\" valign=\"middle\" align=\"right\">";
		$html .= "<a href=\"javascript:xtAdminController('applyQuestion')\"><img title=\"Apply Changes\" alt=\"Apply Changes\" src=\"images/apply_f2.png\" align=\"top\" border=\"0\"/></a>";
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

		$html .= xtMakeInput($q, $sel, $this->page->questions, "title", 60);
		
		$html .= "</td>";
		$html .= "<td valign=\"top\">";

		$types = array(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_RADIOBUTTON')=>1, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_CHECKBOX')=>2, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_LISTBOX')=>3, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_MULTISELECT')=>4, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_NONE')=>5, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_SEPARATOR')=>6, JText::_('ADMIN_POLL_MANAGER_QUESTIONS_TYPE_RATING')=>7);

		$html .= xtMakeSelect($types, $q->type, 'edit_type', $this->page->selQuestion, 'onChange="typeChange(this.value)"');

		$html .= "<td valign=\"top\">";


		if ($q->type <> "4" ) $add = " disabled=\"disabled\" ";
		else $add = ""; 

		$html .= xtMakeInput($q, $sel, $this->page->questions, "multisize", 4, $add);

		$html .= "</td>";

		$html .= "<td valign=\"top\">";
		$html .= xtYesNo($q->obli, "edit_obli", $this->page->selQuestion);
		$html .= "</td>";

		
		$html .= "<td valign=\"top\">";

		$img = array(""=>"");
		
		$conf = new pollxtConfig();
		$conf->pollid = $this->page->poll->id;
		$conf->load();

		$html .= xtHTML::mediaManager("edit_img_url", $q->img_url, $conf->imgpath);           

		$html .= xtMakeSelect($img, $q->img_url, 'edit_img_url', $this->page->selQuestion, " width:100px ");

		$html .= "</td>";

		$html .= "<td valign=\"top\">";

        $types = array(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_WIDTH')=>"width", JText::_('ADMIN_POLL_MANAGER_QUESTIONS_IMAGE_HEIGHT')=>"height");
        
		$html .= xtMakeSelect($types, $q->imgor, 'edit_imgor', $this->page->selQuestion);

		$html .= xtMakeInput($q, $sel, $this->page->questions, "imgsize", 5);
		$html .= "</td>";

		

		$html .= "<td valign=\"top\">";
		$html .= xtYesNo($q->imglink, "edit_imglink", $this->page->selQuestion);
		$html .= "</td>";

		$html .= " </tr>";
//		$html .= "<td colspan = \"8\">";
		$html .= "<tr><td></td>";
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_DESC'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_DESC_LONG'))."</td>";

		$html .= "</td>";
		
		$html .= "<td style=\"font-weight:bold\">".xtTooltip(JText::_('ADMIN_POLL_MANAGER_QUESTIONS_RAND'),JText::_('ADMIN_POLL_MANAGER_QUESTIONS_RAND_LONG'))."</td>";
		$html .= "<td colspan=\"5\"></td>";
		$html .= "</tr>";
		$html .= "<tr><td></td>";
		$html .= "<td><textarea id=\"edit_desc\" cols=\"34\">".$q->desc;
		$html .= "</textarea></td>";
		
		$html .= "<td valign=\"top\">";
		$html .= xtYesNo($q->random, "edit_random", $this->page->selQuestion);
		$html .= "</td></td>";
		$html .= "<td colspan=\"5\"></td>";
		
		$html .= "</tr>"	;	
		
		if ($q->type == "2" || $q->type == "4") $style = "style=\"display:block\"";
		else $style = "style=\"display:none\"";
		$html .= "<tr><td></td><td colspan = \"8\">";
		$html .= "<div id=\"minmax\" ".$style."><table><tr>";
		$html .= "<td><b>".JText::_('ADMIN_POLL_MANAGER_QUESTIONS_MIN')."</b></td>";
		$html .= xtMakeInput($q, $sel, $this->page->questions, "minvotes", 3)."</td>";
		$html .= "<td><b>".JText::_('ADMIN_POLL_MANAGER_QUESTIONS_MAX')."</b></td>";
		$html .= xtMakeInput($q, $sel, $this->page->questions, "maxvotes", 3)."</td>";
		$html .= "</tr></table></div></td>";
		$html .= "</tr>";

		if ($q->type == "2" || $q->type == "0" || $q->type == "1") $style = "style=\"display:block\"";
		else $style = "style=\"display:none\"";
		$html .= "<tr><td></td><td colspan = \"8\">";
		$html .= "<div id=\"style\" ".$style."><table><tr>";
		$html .= "<td><b>".JText::_('ADMIN_POLL_MANAGER_QUESTIONS_STYLE')."</b></td>";
        $types = array(JText::_('ADMIN_POLL_MANAGER_STYLE_HORIZONTAL')=>"h", JText::_('ADMIN_POLL_MANAGER_STYLE_VERTICAL')=>"v");
		$html .= xtMakeSelect($types, $q->style, 'edit_style', $this->page->selQuestion)."</td>";
		$html .= "</tr></table></div></td>";
		$html .= "</tr>";
		
		if ($q->type == "7") $style = "style=\"display:block\"";
		else $style = "style=\"display:none\"";
		$html .= "<tr><td></td><td colspan = \"8\">";
		$html .= "<div id=\"rating\" ".$style."><table><tr>";
		$html .= "<td><b>".JText::_('ADMIN_POLL_MANAGER_QUESTIONS_RATING_VAL')."</b></td>";
		$html .= xtMakeInput($q, $sel, $this->page->questions, "ratingval", 20)."</td>";
		$html .= "<td><b>".JText::_('ADMIN_POLL_MANAGER_QUESTIONS_RATING_DESC')."</b></td>";
		$html .= xtMakeInput($q, $sel, $this->page->questions, "ratingdesc", 40)."</td>";
		$html .= "</tr></table></div></td>";
		$html .= "</tr>";


		$html .= " </table>";

		$html .= "</td>";
		$html .= "</tr>";
		$html .= "</table>";
		return $html;	
	}
}
?>