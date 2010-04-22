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

if (!class_exists("JTable")) {
//	class JTable extends mosDBTable {};
}

if (defined('_JEXEC'))
	$version = "1.5";
else
	$version = "1.0";

define("_JOOMVER", $version);

class xtCompat {
var $version=null;
	function redirect($url,$msg=null) {
 	global $mainframe;
		if (_JOOMVER == "1.5") 
			$mainframe->redirect($url,$msg);
		else
			mosredirect($url,$msg);
	}

	function sefRelToAbs($url) {
		if (_JOOMVER == "1.5") 
			return JRoute::_(JURI::base()."/".$url);
		else {
		  global $mosConfig_live_site;
		  if ( strpos($url, $mosConfig_live_site)=== false) 
			  return sefRelToAbs($mosConfig_live_site."/".$url);
		  else 
			  return sefRelToAbs($url);
		}

	}

	function pagenav($total)	{
	global $mainframe, $option;
		if (_JOOMVER == "1.5") {
			$limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' ); 
			$limitstart = $mainframe->getUserStateFromRequest( $option.'limitstart', 'limitstart', 0, 'int' ); 
			jimport('joomla.presentation.pagination');
			$pagination = new JPagination($total, $limitstart, $limit);
		}
		else {
			global $mosConfig_absolute_path, $mosConfig_list_limit;
			$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
			$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
			require_once ($mosConfig_absolute_path.'/administrator/includes/pageNavigation.php');
			$pagination = new mosPageNav($total, $limitstart, $limit);
		}
		return $pagination;
	}
	
	function db() {
 	global $mainframe;
		if (_JOOMVER == "1.5") 
			$database = &JFactory::getDBO();
		else
			global $database;
		return $database;
	}
	
	function getVar($var, $default=null, $opt=false) {
		$raw = null;
		if (_JOOMVER == "1.5") {
			if ($opt) $raw = "JREQUEST_ALLOWRAW";
			$val = JRequest::getVar( $var, $default, "", $raw );
		}
		else {
			if ($opt) $raw = _MOS_ALLOWRAW;	
			$val = mosGetParam( $_REQUEST, $var, $default, $raw );
		}
		return $val;
	}
	
	function getAbsPath() {
		if (_JOOMVER == "1.5") 
			return JPATH_SITE;
		else {
			return $GLOBALS['mosConfig_absolute_path'];
		}	
	}
		
	function getParams() {
	global $Itemid, $mainframe;
		if (_JOOMVER == "1.5") {
//			$menus	= &JSite::getMenu();
//			$menu	= $menus->getActive();
			$params	= &$mainframe->getParams();
		}
		else { 
			global $database;
			$menu =& new mosMenu( $database );
			$menu->load( $Itemid );
			$params =& new mosParameters( $menu->params );
		}
		return $params;
		
	}
	function toolbarStart() {
		if (_JOOMVER == "1.5") {}
		else
			mosMenuBar :: startTable();
	}

	function toolbarEnd() {
		if (_JOOMVER == "1.5") {}
		else
			mosMenuBar :: endTable();
	}

	function toolbar($func, $jfunc=null, $text=null) {
		if (_JOOMVER == "1.5") {
			JToolBarHelper::$func($jfunc,$text);			
		}
		else {
			mosMenuBar :: $func();
			mosMenuBar :: spacer();
		}		
	}
	function toolbarX($jfunc,$p1, $p2, $text, $val) {
		if (_JOOMVER == "1.5") {
			JToolBarHelper::customx($jfunc,$p1, $p2, $text, $val);			
		}
		else {
			mosMenuBar :: customx($jfunc,$p1, $p2, $text, $val);
			mosMenuBar :: spacer();
		}		
	}
	
	function getCfg($p) {
	global $mainframe;

		if (_JOOMVER == "1.5") {
			return $mainframe->getCfg( $p );
		}
		else {
		 	$param = "mosConfig_".$p;
			return $GLOBALS[$param];
		}
	}
	
	
}


function getCalendarScriptPath() {
global $mainframe;

	if ($GLOBALS["_VERSION"]->RELEASE == "1.5")
		$calendarScriptPath = $mainframe->getCfg( 'live_site' )."/includes/js/calendar/lang/calendar-en-GB.js";
	else {
		global $mosConfig_live_site;
		$calendarScriptPath = $mosConfig_live_site."/includes/js/calendar/lang/calendar-en.js";
	}
return $calendarScriptPath;
}



function xtTooltip($short, $long) {
		return "<a class= \"tooltip hasTip\" href=\"#\" title=\"".$long."\">".$short."</a>";	
}


class xtTitle {
	function xtTitle($product) {
		$this->product = $product;
	}
	function show($title) {	 
		if (_JOOMVER == "1.5") {
		 	$html = "<div class=\"header icon-48-categories\">";
		 	$html .= $this->product." ".$title;
			$html .= "</div>";
		}
		else {
		 	$html = "<table class=\"adminheading\" cellpadding=\"2\" cellspacing=\"4\" border=\"0\" width=\"100%\" ><tr>";
		 	$html .= "<th  class=\"config\" align=\"left\">";
		 	$html .= $this->product." ".$title;
		 	$html .= "</tr></table>";
		}
		return $html;
	}
}
class xtTabs {
	function xtTabs($index) {
		$this->initTabs($index);
		
	}
	
	function initTabs($index) {
		if (_JOOMVER == "1.5") {
			$tabs = JPane::getInstance('Tabs');
		}
		else {
			$tabs = new mosTabs($index);			
		}
		$this->tabs = $tabs;
	}
	
	function startPane ($name) {
		if (_JOOMVER == "1.5") {
			echo $this->tabs->startPane($name);
		}
		else {
			$this->tabs->startPane($name);
		}
		
	}
	function startTab($name, $text) {
		if (_JOOMVER == "1.5") {
			echo $this->tabs->startPanel($name,$text);
		}
		else {
			$this->tabs->startTab($name,$text);
		}
	}
	function endTab() {
		if (_JOOMVER == "1.5") {
			echo $this->tabs->endPanel();
		}
		else {
			$this->tabs->endTab();
		}
	}
	function endPane() {
		if (_JOOMVER == "1.5") {
			echo $this->tabs->endPane();
		}
		else {
			$this->tabs->endPane();
		}
	}

}
	
