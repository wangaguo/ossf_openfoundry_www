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

class detailsResult extends pollxtResultController {
	function printIntro() {
		$ret = "<table width=\"100%\" class=\"pollstableborder\" >";
		return $ret;
	}
	
 	function print_title($d) {
 	 	$r = $d->data;
		$ret = "";
		$ret = "<tr><td colspan=\"6\" width=\"100%\" class=\"componentheading\">"; 
		$ret .= $r->title."</td></tr>";
		return $ret;
	}
	function print_qoption($d) {
 	 	 $r = $d->data;
		 $ret = "<tr>";
         $ret .= "<td width=\"10\">&nbsp</td>";
		 $ret .= "<td colspan=\"5\">".$r->qoption."</td>";
         $ret .= "</tr>";
		return $ret;
	}
	function printData($d) {
		$tabclass_arr = array ('sectiontableentry1'.$this->class_sfx, 'sectiontableentry2'.$this->class_sfx);
 	 	$r = $d->data;
		if (!isset($this->tabcnt)) $this->tabcnt=0;
        $ret = "<tr class=\"".$tabclass_arr[$this->tabcnt]."\">";
		$ret .= "<td width =\"20\">&nbsp</td>";
		$ret .= "<td width =\"20\">&nbsp</td>";
		$ret .= "<td>".$r->ip."</td>";
		$ret .= "<td>".$r->user."</td>";
        $ret .= "<td>". JHTML::_('date', $r->datu, JText::_('DATE_FORMAT_LC2'))."</td>";
        $ret .= "<td>".$r->value."</td>";
        $ret .= "</tr>";
		$this->tabcnt = 1 - $this->tabcnt;
		return $ret;
	}
 
 	function printOutro() {
		return "</table>";
	}
}

?>
