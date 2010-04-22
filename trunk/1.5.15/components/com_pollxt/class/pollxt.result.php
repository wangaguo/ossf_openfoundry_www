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
class result {
	function result(&$frontend) {

		$database = JFactory::getDBO();
		
		require_once (JPATH_SITE . "/components/com_pollxt/class/pollxtresult.class.php");
		$html = "";

		$poll = $frontend->poll;
		$poll->load($poll->id);

		$conf = $frontend->conf;
		
		if ($frontend->data->state == "showDetail") $default="details";
		else $default="classic";
		// prevent direct calling of unpublished results
		if (($poll->published == 0) && ($conf->publ == 1)) {
			$frontend->message = _NOT_AUTH;
			$frontend->error = true;
			return;
		}
		
		// get the plugin 
		$pluginPath = JPATH_SITE."/components/com_pollxt/resultplugins/";
	
		$plugin = new configPlugin($poll->id);
		$rplug = $plugin->getResultPlugin(); 
		if ($rplug == "") $rplug = $default;
	    include_once ($pluginPath.$rplug.".php");
	    $class = $rplug."Result";
	    $result = new $class($frontend);
	    
		// get the stylesheet
		if (!empty ($conf->css))
		    $stylesheet = $conf->css;
		else
		    $stylesheet = "poll_bars";
		
		$ret  = "<link rel=\"stylesheet\" href=\"components/com_pollxt/".$stylesheet.".css\" type=\"text/css\" />";
		$ret .= "<script type=\"text/javascript\" src=\"components/com_pollxt/script/pollxt.js\"></script>";
		$html .= $ret;	
	
	
	   	
		// Results   	
		$html .= $result->getHTML();
		
		//get the intro (steal it from voteform)
		$tmp = clone $frontend;
		$class = new voteform($tmp);
		$frontend->intro = $tmp->intro;
		// Select Box for polls	
		if ($pollist = $result->getPollList()) {
			$frontend->intro = $pollist.$frontend->intro;
	   	}
		
		
		return $frontend->text = $html;        
	}

}