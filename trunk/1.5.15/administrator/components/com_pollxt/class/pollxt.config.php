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

class pollxtConfig {
var $pollid = null;
var $itemid = null;
var $parameters = null;

	function pollxtConfig() {
	}

	function load() {
		$database = JFactory::getDBO();

		$this->sfx = "";

	// Configuration
		$conf = new mosPollConfig ($database);
		$conf->load('1');		

		$this->version =   $conf->version;
		$this->debug = $conf->debug;	
		$this->publ = $conf->xt_publ;	
		$this->orderby = $conf->xt_orderby;
		$this->disp = $conf->xt_disp;
		$this->asc = $conf->xt_asc;
		$this->hide = $conf->xt_hide;
		$this->publ = $conf->xt_publ;
		$this->resselpo = $conf->resselpo;
		$this->selpo = $conf->xt_selpo;
		$this->maxcolors = $conf->xt_maxcolors;		
		$this->barheight = $conf->xt_height;
		$this->publ = $conf->xt_publ;		
		$this->imgpath = $conf->imgpath; 
		$this->imgvote = $conf->xt_imgvote;
		$this->imgresult = $conf->xt_imgresult;
		$this->seccookie = $conf->xt_seccookie;
		$this->secip = $conf->xt_secip;
		$this->secuname = $conf->xt_secuname;
		$this->rdisp = $conf->rdisp;
		$this->btnstyle = $conf->button_style;
		$this->imgdetail = $conf->imgdetail;
		$this->imgback = $conf->imgback;
		$this->compat = $conf->compat;
		$this->tooltips = $conf->tooltips;

	 	
	// Poll data 	 
		if ($this->pollid) {	
			$poll = new mospoll($database);
			$poll->load($this->pollid);
	
			$this->wordwrap = $poll->wordwrap;
			$this->rdisp = $poll->rdisp;
			$this->rdispall = $poll->rdispall;
			$this->sh_abs = $poll->sh_abs;
			$this->sh_perc = $poll->sh_perc;
			$this->sh_numvote = $poll->sh_numvote;
			$this->sh_flvote = $poll->sh_flvote;
			$this->css = $poll->css;
			$this->email = $poll->email;
			$this->emailtext = $poll->emailtext;
			$this->category = $poll->category;
			
			if ($poll->hide != "-1") $this->hide = $poll->hide;
			// Build thank you message
			if ($poll->thanks)
				$this->thanks = stripslashes($poll->thanks);
			else
				$this->thanks = JText::_('THANKS');
			$this->notvote = $poll->notvote;
			$this->notvoteerr = $poll->notvoteerr;
		}

	// module/plugin Parameters
			$this->pollExp = "";
//			$this->page_title =  "";
			$this->pollNav =  "";
	
		if ($this->parameters) {
			$params = & new JParameter($this->parameters->_raw);
			$this->sfx = "";
			if ($params->get("moduleclass_sfx")) $this->sfx = $params->get("moduleclass_sfx");
			if ($params->get("pageclass_sfx")) $this->sfx = $params->get("pageclass_sfx");
			if ($params->get("mod_disp") != "") $this->disp = $params->get("mod_disp");
			if ($params->get("mod_order") != "") $this->orderby = $params->get("mod_order");
			if ($params->get("mod_hide") != "") $this->hide = $params->get("mod_hide");
			if ($params->get("mod_selpo") != "") $this->selpo = $params->get("mod_selpo");
			if ($params->get("mod_imgvote") != "-1") $this->imgvote = $params->get("mod_imgvote");
			if ($params->get("mod_imgresult") != "-1") $this->imgresult = $params->get("mod_imgresult");
			if ($params->get("mod_category") != "") $this->category = $params->get("mod_category");
			if ($params->get("mod_target") != "") $this->target = $params->get("mod_target");
			// stuff from menu
			$this->pollExp = "";
			$this->page_title =  "";
			$this->description =  "";
			$this->description_text =  "";
			$this->image =  "";
			$this->image_align =  "";
			$this->item_description =  "";
			$this->itemimage =  "";
			$this->itemimagenot =  "";
			$this->list_headings =  "";
			$this->list_voted =  "";
			$this->list_votes =  "";
			$this->pollNav =  "";
			$this->header = "";
			$this->show_page_title = "";
		}

	
	// Menu parameters
		if ($this->itemid) {
			$menu = &JSite::getMenu();
			$m = $menu->getItem($this->itemid);
			$params = new JParameter($m->params);
			
			if ($params->def('page_title') <> '') {
				$this->header = $params->def('page_title');
			} else {
			 	if (isset($m))
					$this->header = $m->name;
				else
					$this->header ="";
			}
			
			$this->pollExp = $params->def( 'pollExp' );
			$this->sfx   = $params->def( 'pageclass_sfx' );
			$this->show_page_title = $params->get('show_page_title');
			$this->description = $params->get('description');
			$this->description_text = $params->get('description_text');
			$this->image = $params->get('image');
			$this->image_align = $params->get('image_align');
			$this->item_description = $params->get('description');
			$this->itemimage = $params->get('itemimage');
			$this->itemimagenot = $params->get('itemimagenot');
			$this->list_headings = $params->get('headings');
			$this->list_voted = $params->get('voted');
			$this->list_votes = $params->get('votes');
			$this->pollNav = $params->get('pollNav');
			$this->category = $params->get('category');
			$this->target = "mod";
		}
		
	// Others
		$this->ip = $this->getIp();
		$this->user = $this->getUser();

		$this->imgpar = "resizable=yes,"."scrollbars=yes,"."location=no,"."menubar=no,"."status=no,"."toolbar=no,"."width=640,"."height=480";

	}

	function getIp() {

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip=$_SERVER['REMOTE_ADDR']; 		
		return $ip;
	}

	function getUser() {
		$my =& JFactory::getUser();
		if ($my->id)
			$user = $my->username;
		else
			$user = "anonymous";
		return $user;	
	}	
}

?>
