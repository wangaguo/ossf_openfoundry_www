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
require_once(JPATH_SITE. "/administrator/components/com_pollxt/sajax/Sajax.php");

require_once(JPATH_SITE."/components/com_pollxt/class/pollxt.utilities.php");
require_once(JPATH_SITE."/components/com_pollxt/class/pollxt.frontend.php");
require_once(JPATH_SITE."/administrator/components/com_pollxt/pollxt.class.php");
require_once (JPATH_SITE. "/administrator/components/com_pollxt/class.compat.15.php");

JHTML::_('stylesheet', 'poll_bars.css', 'components/com_pollxt/'); 

$conf = new pollxtConfig();
$conf->load();



if ($conf->debug == "0" || $conf->debug == "2" || $conf->debug = "") {
	$GLOBALS['sajax_debug_mode'] = 0;
}
else {
	$GLOBALS['sajax_debug_mode'] = 1;
	ini_set  ( "display_errors"  , "1"  );
	error_reporting(E_ALL);
}

$GLOBALS['sajax_request_type'] = "POST";

if (isset ($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $uri = "https://";
else $uri = "http://";
$uri .= $_SERVER["HTTP_HOST"];
if ($_SERVER["SERVER_PORT"] != "80") $uri .= ":".$_SERVER["SERVER_PORT"];
if (isset($_SERVER["REQUEST_URI"]))
	$path = parse_url($_SERVER["REQUEST_URI"]);
else 
	$path = parse_url($_SERVER["PHP_SELF"]);

$uri .= $path["path"];
$GLOBALS['sajax_remote_uri'] = $uri."?option=com_pollxt";

sajax_init();
sajax_export("pollxtController");
sajax_handle_client_request();

class xtFrame {
var $pos = null;
var $pollid = null;
var $Itemid = null;
var $task = null;
var $parameters = null;
var $debug = null;
var $isPopup = null;
var $activation = null;


	function xtFrame() {
		$conf = new pollxtConfig();
		$conf->pollid = $this->pollid;
		$conf->load();
		if ($conf->compat != 1)
			JHTML::_('behavior.modal');
		if ($conf->debug == "0" || $conf->debug == "2" || $conf->debug = "")
			$this->debug = "0";
		else $this->debug = "1";		

	 	$html = "";
	 	$html .= $this->addTags();
		$html .= $this->initSajax();
		
		$this->html = $html;	
		
	}
	
	


	function get() {
	 	$this->html .= $this->addTags();
	  
		$conf = new pollxtConfig();
		$conf->itemid = $this->Itemid;
		$conf->parameters = $this->parameters;
		$conf->load();
		$this->conf = $conf;
		
		$database = JFactory::getDBO();
		switch ($this->task) {
		 	case "activate":
		 		$this->pollActivate();
		 		break;
			case "list":
				$this->singleFrame(); 	
				break;
			default:
				$this->pollFrame();
				break;
		}
		
		return $this->html;
	}

	// -----------------------------------------------------------------------------
	// init the sajax framework
	// -----------------------------------------------------------------------------
	
	function initSajax() {
	}

	function addTags() {
	 	global $mainframe;
	 	if (defined('_POLLXT_SCRIPTS')) return;
	 	define('_POLLXT_SCRIPTS', '1');
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::base().'components/com_pollxt/script/json2.js" charset="UTF-8"></script>');
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::base().'components/com_pollxt/script/pollxt.js" charset="UTF-8"></script>');
			$mainframe->addCustomHeadTag("<script type='text/javascript'><!--".sajax_get_javascript()."//--></script>");
		
	}
	function getPolls() {
		$polls = getPolls($this->pos, $this->conf, $this->pollid, $this->Itemid, $this->task);
		$polls = sortPolls($polls, $this->conf);
		return $polls;
	}
	
	function pollFrame() {
		global $mainframe;
		$polls = $this->getPolls();
		if (!$polls) $this->html .= $this->getNoPolls();
		else {
			foreach ($polls as $poll) {
				$this->conf->pollid = $poll->id;
				$this->conf->load();
				$plugin = new configPlugin($poll->id);
				if ($this->pos == "com") $mainframe->setPageTitle($poll->title);
				$this->createFrame($poll->id, $plugin, $this->conf);
				if ($this->conf->disp == "2") break;						 
			}
		}
	}
	
	function singleFrame() {
		global $mainframe;
		if ($this->pos == "com") $mainframe->setPageTitle($poll->title);

		$this->createFrame();
	}
	
	function createFrame($id = "", $plugin = null, $conf = null) {
		$name = "xt".rand(10000,99999);
		$this->name = $name;
	
		$this->html .= "<div class=\"tipxt\" title=\"".JText::_('Poll loading')."\" id=\"load".$name."\"><img src='components/com_pollxt/images/busy.gif' alt=\"busy\"/>".JText::_('POLLXT_LOADING')."</div>";
		$this->html .= "<div id=\"header".$name."\"></div>";
		$this->html .= "<div id=\"select".$name."\"></div>";

		$this->html .= "<div id=\"intro".$name."\"></div>";

		$this->html .= "<form name=\"".$name."\" action=\"\">";
		$this->html .= "<input type=\"hidden\" name=\"name\" id=\"name\" value=\"".$name."\" />";
		$this->html .= "<input type=\"hidden\" name=\"state\" id=\"state\" value=\"".$this->task."\" />";
		$this->html .= "<input type=\"hidden\" name=\"Itemid\" id=\"Itemid\" value=\"".$this->Itemid."\" />";
		$this->html .= "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"".$id."\" />";
		$this->html .= "<input type=\"hidden\" name=\"pollid\" id=\"pollid\" value=\"".$id."\" />";
		$this->html .= "<input type=\"hidden\" name=\"isPopup\" id=\"isPopup\" value=\"".$this->isPopup."\" />";
		$this->html .= "<input type=\"hidden\" name=\"params\" id=\"params\" value=\"".htmlspecialchars(json_encode($this->parameters))."\" />";
		$this->html .= "<input type=\"hidden\" name=\"pos\" id=\"pos\" value=\"".$this->pos."\" />";
	 	if (!$this->pos == "com") 
			$this->html .= "<input type=\"hidden\" name=\"cfm\" id=\"cfm\" value=\"1\" />";
		else 
			$this->html .= "<input type=\"hidden\" name=\"cfm\" id=\"cfm\" value=\"\" />";

			
		if ($plugin) $this->html .= $plugin->beforeDisplay();			
			
		$this->html .= "<div id=\"poll".$name."\"";
//		if ($xt_hide == "1" && $this->) $this->html .= "style=\"display:none;\"";
		$this->html .= "></div>";
		
		if ($plugin) $this->html .= $plugin->afterDisplay();			

		$this->html .= "<div class =\"xtmessage\" id=\"checkmsg".$name."\"></div>";
		$this->html .= "<div class =\"xtbuttons\" id=\"button".$name."\"></div>";
		$this->html .= "<div id=\"outro".$name."\"></div>";
		if ($this->debug == 1 && !defined("XTDEBUG")) {
			$this->html .= "<textarea cols=\"60\" rows=\"20\" id=\"xtDebug\"></textarea>";
			define ("XTDEBUG","X");
		}
		$this->html .= "</form>";
		if ($this->conf->compat == 1) 
			$this->html .= "<script language=\"javascript\" type=\"text/javascript\">xtInit('".$name."');</script>";	
		else
			$this->html .= "<script>window.addEvent('domready', function() {xtInit('".$name."');});</script>";


	}		

	function getNoPolls() {
		return JText::_('POLLXT_NO_POLLS');
	}
	function pollActivate () {
		$database = JFactory::getDBO();
		$mailkey = $this->activation;
		// Check if key exists (and not already unblocked)
		$query = "SELECT id FROM #__pollxt_data "
		        ."\nWHERE mailkey = '$mailkey' "
		        ."\nAND block = 1";
		$database->setQuery($query);
		$id = $database->loadResult();
		
		// key ist o.k., unblock
		if ($id) {
			$query = "UPDATE #__pollxt_data SET block = 0"
			        ."\nWHERE mailkey = '$mailkey'";
			$database->setQuery($query);
			$database->query();
			$this->html .= JText::_('POLLXT_ACTIVATE');
		}
		else {
			$this->html .= JText::_('POLLXT_NOT_ACTIVATED').$mailkey;
		}
	}
}
function pollxtController($data) {
// 	if (get_magic_quotes_gpc() == 1) $data = stripslashes($data);
// 	print_r($data);
	$frontend = new xtFrontend($data);
	return $frontend->execute();
}

?>
