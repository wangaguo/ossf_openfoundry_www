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
// -----------------------------------------------------------------------------
// init the sajax framework
// -----------------------------------------------------------------------------
$conf = new pollxtConfig();
$conf->load();
if ($conf->debug == "0" || $conf->debug == "1" || $conf->debug = "")
	$GLOBALS['sajax_debug_mode'] = 0;
else {
	$GLOBALS['sajax_debug_mode'] = 1;
	ini_set  ( "display_errors"  , "1"  );
	error_reporting(E_ALL);
}
$GLOBALS['sajax_request_type'] = "POST";
$GLOBALS['sajax_remote_uri'] = $_SERVER["REQUEST_URI"]."?option=com_pollxt";
sajax_init();
sajax_export("pollxtAdminController");
sajax_handle_client_request();


// -----------------------------------------------------------------------------
// class to build initial Frame
// -----------------------------------------------------------------------------
class adminFrame {
	function adminFrame() {
	 	global $sajax_debug_mode;
	 	$this->debug = $sajax_debug_mode;
	 	$html = "";
		$html .= $this->initSajax();
		
		$this->html = $html;	
	}	

	function get() {
		$this->createFrame();
		return $this->html;
	}


	// -----------------------------------------------------------------------------
	// init the sajax framework
	// -----------------------------------------------------------------------------
	
	function initSajax() {
		$global_html = "<script>".sajax_get_javascript().";</script>";
		return $global_html;	
	}
	function createFrame() {
	 	global $mainframe;
	 	
		$p = htmlspecialchars(json_encode($this->poll));
		$q = htmlspecialchars(json_encode($this->questions));
		$o = htmlspecialchars(json_encode($this->options));
		$this->html .= '<script type="text/javascript" src="'.JURI::root().'/administrator/components/com_pollxt/script/pollxt.admin.js" charset="UTF-8"></script>';		
		$this->html .= '<script type="text/javascript" src="'.JURI::root().'/components/com_pollxt/script/json2.js" charset="UTF-8"></script>';		
		$this->html .= "<input type=\"hidden\" id=\"ajaxPoll\" name=\"ajaxPoll\" value =\"".$p."\" />";				
		$this->html .= "<input type=\"hidden\" id=\"ajaxQuestions\" name=\"ajaxQuestions\" value =\"".$q."\" />";				
		$this->html .= "<input type=\"hidden\" id=\"ajaxOptions\" name=\"ajaxOptions\" value =\"".$o."\" />";				
		
		$this->html .= "<table align=\"left\" width=\"98%\" >";
		$this->html .= "<tr>";
		$this->html .= "<td>";
		$this->html .= "<table align=\"left\" width=\"98%\" >";
/*		    <tr>
		     <td colspan="2">
		     <div id = "pageArea"></div>
		     </td>
		    </tr> 
*/
		$this->html .= "<tr>";
		$this->html .= "<td width=\"50%\" rowspan=\"10\" align=\"left\"><div id=\"questionArea\"></div>";
		$this->html .= "</td>";
		$this->html .= "<td width=\"50%\" rowspan=\"10\" align=\"left\"><div id=\"optionArea\"></div>";
		$this->html .= "</td>";
		$this->html .= "</tr>";
		$this->html .= "</table>";
		$this->html .= "</td>";
		$this->html .= "</tr>";
		$this->html .= "<tr>";
		$this->html .= "<td>";
		$this->html .= "<table align=\"left\" width=\"98%\" >";
		$this->html .= "<tr>";
		$this->html .= "<td><div id=\"editArea\"></div>";
		$this->html .= "</td>";
		$this->html .= "</tr>";
		$this->html .= "</table>";
		$this->html .= "</td>";
		$this->html .= "</tr>";
		$this->html .= "<tr>";
		$this->html .= "<td>";
		$this->html .= "<div id=\"loadArea\"><img src=\"".JURI::root()."/administrator/components/com_pollxt/ajax-loader.gif\">Working...</div>";
		if ($this->debug == 1) $this->html .= "<textarea cols=\"100\" rows=\"20\" id=\"xtDebug\"></textarea>";
		$this->html .= "</td>";
		$this->html .= "</tr>";
		$this->html .= "</table>";
		$this->html .= "<script>window.addEvent('domready', function() {xtAdminController('init');});</script>";
		
		
	}
}
function pollxtAdminController($data) {
 	if (get_magic_quotes_gpc() == 1)
	 	$d = json_decode(stripslashes($data));
	else
	 	$d = json_decode($data);
	
	 $pe = new pageEditor($d);
 	return json_encode($pe->output);
}



?>
