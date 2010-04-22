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
class validate {

	function validate(&$frontend) {
		
		$database = JFactory::getDBO();
		$my = JFactory::getUser();

		// get IP
		$ip = $frontend->conf->ip;
	
		// get the selection
		$voteArray = $frontend->data->votes;
		$poll = $frontend->poll;

		// Plugin check
		$plugin = new configPlugin($poll->id);
		if ($message = $plugin->checkVote($frontend->plug)) {
	        $frontend->error = true;
	        $frontend->message = $message;
			return;
		}

		// Poll exists (visible for user)?
		if (!$poll->load($frontend->data->pollid)) {
	        $frontend->error = true;
	        $frontend->message = JText::_('POLLXT_NOT_AUTH');
	        return;
		}
		
		// check for email
		if ($poll->email == "1" && !$my->id) {
			$email = $frontend->data->email;			
		}
		else $email = null;
		
		// already voted?
		$voted = checkVote($poll, $email);
		if (!$poll->multivote == 1) {
			if ($voted) {
        		$frontend->error = true;
	        	$frontend->message = JText::_('POLLXT_ALREADY_VOTE');
		        return;
			}
		}
	
		// something selected?
		if (!$voteArray) {
	        $frontend->error = true;
	        $frontend->message = JText::_('POLLXT_NO_SELECTION');
	        return;
		}
	
		$voteid = array ();
		$i = 0;
		foreach ($voteArray as $v) {
			$voteid[$i] = $v;
			$i ++;
		}

		$now = $now = date("Y-m-d G:i:s");
	
		$user = $frontend->conf->user;
	
		// Check for obligatory questions
	
		$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$poll->id' and obli = '1' and inact = '0' and type <> '6'";
		$database->setQuery($query);
		$questions = $database->loadObjectList();
	    $obligatory = "";
		foreach ($questions as $q) {
			$found = false;
			foreach ($voteid as $v) {
				$query = "SELECT * FROM #__pollsxt_options WHERE id = '$v' AND quid = '$q->id'";
				$database->setQuery($query);
				$result = $database->loadResult();
				if ($result)
					$found = true;
			}
			if (!$found)
				$obligatory .= "<li>".$q->title;
		}
	
		if (!empty ($obligatory)) {
			$html = JText::_('POLLXT_OBLIGATORY')."<ul>";
        	$frontend->error = true;
	        $frontend->message = $html.$obligatory."</ul>";
	        return;
		}
		
		// Check for obligatory questions
	
		$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$poll->id' and inact = '0' and ( type = '2' or type = '4') AND (minvotes > 0 or maxvotes > 0)";
		$database->setQuery($query);
		$questions = $database->loadObjectList();
	    $count = 0;
	    $html = "";
	    $frontend->error = false;
		foreach ($questions as $q) {
			$found = false;
			foreach ($voteid as $v) {
				$query = "SELECT * FROM #__pollsxt_options WHERE id = '$v' AND quid = '$q->id'";
				$database->setQuery($query);
				$result = $database->loadResult();
				if ($result)
					$count++;
			}
			if ($count > $q->maxvotes and $q->maxvotes > 0) {
				$html .= $q->title.": ";
				$html .= JText::_('POLLXT_MAXVOTES').$q->maxvotes.JText::_('POLLXT_MAXVOTES_END')."<br/>";
	        	$frontend->error = true;
			}
			if ($count < $q->minvotes and $q->minvotes > 0) {
				$html .= $q->title.": ";
				$html .= JText::_('POLLXT_MINVOTES').$q->minvotes.JText::_('POLLXT_MINVOTES_END')."<br/>";
	        	$frontend->error = true;
			}
		}
		if ($frontend->error) {
	        $frontend->message = $html;
	        return;
		}	

		
		
		
		if ($poll->email == "1") {
			if (!isset($frontend->data->email)) {
				$frontend->error = true;
				$frontend->message = JText::_('POLLXT_EMAIL_MISSING');
				return ;
			}
			elseif (!is_email($frontend->data->email)) {
				$frontend->error = true;
				$frontend->message = JText::_('POLLXT_EMAIL_NOT_VALID');
				return ;
			}
		}
		
		foreach ($frontend->data->texts as $t) {
			foreach ($frontend->data->votes as $v) {
				if ($t[0] == $v && $t[1] == "") {
			        $frontend->error = true;
			        $frontend->message = JText::_('POLLXT_ENTER_TEXT'); 
					return;
				}
			}
	
		}
	
        $frontend->error = false;
        $frontend->message = JText::_('POLLXT_VOTE_SUBMITTED');
	}

}
?>