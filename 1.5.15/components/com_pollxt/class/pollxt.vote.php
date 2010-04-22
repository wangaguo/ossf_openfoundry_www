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
class vote {
	function vote(&$frontend) {
		$this->frontend = $frontend;
		$this->addVote();
		$frontend = $this->frontend;		
	}
	function addVote() {
		$database = JFactory::getDBO();
		$my = JFactory::getUser();

		$voteArray = $this->frontend->data->votes;
		$poll = $this->frontend->poll;
		$conf = $this->frontend->conf;
		
	   	$id = intval ($poll->id);
	
		$ip = $conf->ip;	 
	
		$now = date("Y-m-d G:i:s");
	
		$user = $conf->user;

		// set cookie
		$cookiename = "voted$id";
		setcookie("$cookiename", $now);
		
		// send activation mail if required
		$block = 0;
		if ($mailkey = $this->sendConfMail()) {
			$block = 1;
			if (!$my->id) $user = $this->frontend->data->email;
		}

		// create new Options				
		$voteid = array ();
		$voteid = $this->createOptions();
		
		// update the database
/*		$i = 0;
		foreach ($voteArray as $v) {
				$voteid[$i] = $v;
				$i ++;
		}*/
		
		foreach ($voteid as $v) {
			$val = "";
			foreach ($this->frontend->data->texts as $t) {
				if ($t[0] == $v && $t[1]!="-1")
	            	$val = htmlentities($t[1]);
		    }
			$database->setQuery("INSERT INTO #__pollxt_data"."\n(optid, ip, user, datu, value, 
								mailkey, block)"."\nVALUES ($v, '$ip', '$user', '$now', '$val', '$mailkey', '$block')");
			$database->query();
			echo $database->getErrorMsg();
		}
		
		$database->setQuery("UPDATE #__pollsxt SET voters=voters + 1"."\n WHERE id='$id'");
		$database->query();
		echo $database->getErrorMsg();
		
		// save Plugin data
		$plugin = new configPlugin($poll->id);
		$plugin->saveVote($this->frontend->plug); 
		
		
		// Build thank you message
		if ($poll->thanks)
			$thanks = stripslashes($poll->thanks);
		else
			$thanks = JText::_('THANKS');
		
		// email results 
		if ($poll->mailres)
			$this->emailResult($poll, $voteid, $this->frontend->data->texts);
		
		$this->frontend->message = $thanks;		
		
	}
	
	function createOptions() {
		$database = JFactory::getDBO();
		$my = JFactory::getUser();
		$newv= array();
		// get the selection
		$voteArray = $this->frontend->data->votes;
		$poll = $this->frontend->poll;
		$voteid = array ();
		$i = 0;
		foreach ($voteArray as $v) {
				$voteid[$i] = $v;
				$i ++;
		}
		// get IP
		$ip = $this->frontend->conf->ip;

		$user = $this->frontend->conf->user;

		$now = $now = date("Y-m-d G:i:s");
		
	   	$id = intval ($this->frontend->poll->id);
		$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$id' AND inact = '0'";
		$database->setQuery($query);
		$qu = $database->loadObjectList();
		foreach ($qu as $q) {
			foreach ($voteid as $v) {
        	    $v = intval ($v);
           		$id = intval ($q->id);
			$query = "SELECT * FROM #__pollsxt_options WHERE id = '$v' AND quid = '$id' AND inact = '0'";
			$database->setQuery($query);
			$resultList = $database->loadObjectList();
				foreach ($resultList as $result) {
					if ($result->newopt >= 1 && $result->freetext == 1) {
						if (($my->id) or (($result->newopt == 2) || ($result->newopt == 3))) {
							if ($result->newopt == 2)
								$inact = 1;
							else
								$inact = 0;
	
							//existence-check
	                        $id = intval ($q->id);
	                        $val = "";
							foreach ($this->frontend->data->texts as $t) {
								if ($t[0] == $v )
					            	$val = htmlentities($t[1]);
						    }
	                        
							$query = "SELECT * FROM #__pollsxt_options WHERE quid = '$id' and qoption = '$val'";
							$database->setQuery($query);
							$database->loadObject($check);
							if (isset($check->id))
								$newv[] = $check->id;
							else {
							 	$odb = new mosPollOptions($database);
							 	$odb->quid = $id;
							 	$odb->qoption = $val;
							 	$odb->inact = $inact;
							 	$odb->store();
							 	$odb->updateOrder('quid = '.$id);
								$newId = $odb->id;
								$database->setQuery("INSERT INTO #__pollxt_data (optid, ip, user, datu)"."\nVALUES ($newId, '$ip', '$user', '$now')");
								$database->query();
								echo $database->getErrorMsg();
							}
						} else
							$newv[] = $v;
					} else
						$newv[] = $v;
				}

			}
		}
//	print_r($newv);	
	return $newv;
	}
	
	function sendConfMail() {
	    jimport('joomla.user.helper');
	 	$database = JFactory::getDBO();
		$block = 0;
		// Confirmation email required? Send now
	    $key = false;
	    if ($this->frontend->conf->email == 1) {
		//generate key
		$key = md5(JUserHelper::genRandomPassword());

		// get Email-Address
		$email = $this->frontend->data->email;
		
		$subject = $this->frontend->poll->subject;

		$message = htmlentities(stripslashes($this->frontend->conf->emailtext))."\n".JURI::base()."index.php?option=com_pollxt&task=activate&activation=".$key;

		$message = html_entity_decode($message, ENT_QUOTES);
		// Send email to user

		$config	 = &JFactory::getConfig();

		if ($config->getValue('mailfrom') != "" && $config->getValue('fromname') != "") {
			$adminName2 = $config->getValue('fromname');
			$adminEmail2 = $config->getValue('mailfrom');
		} else {
			$database->setQuery("SELECT name, email FROM #__users"."\n WHERE usertype='superadministrator'");
			$rows = $database->loadObjectList();
			$row2 = $rows[0];
			$adminName2 = $row2->name;
			$adminEmail2 = $row2->email;
		}

		JUtility::sendMail($adminEmail2, $adminName2, $email, $subject, $message);
		}
		return $key;
	}
	
	function createRedir() {
	
		$poll = $this->frontend->poll;
		
		switch ($poll->goto) {
			// Nowhere - The easiest task...
			case "1" :
	            if ($this->frontend->data->redir != "")
				$redirUrl = xtCompat::sefRelToAbs("index.php?$this->frontend->data->redir");
				else
				$redirUrl = JUri();
				break;
				// URL - another easy task
			case "2" :
				if (strncasecmp($poll->goto_url, "http", 4) == 0)
					$redirUrl = $poll->goto_url;
				else
					$redirUrl = xtCompat::sefRelToAbs("index.php?$poll->goto_url");
				break;
				// now the funny results...
			case "0" :
				// in case of component same screen = mainscreen
				if ((!$this->frontend->data->cfm) && ($poll->rdisp == 3))
					$poll->rdisp = 1;
				switch ($poll->rdisp) {
					case "1" :
						// set task=result and id
						$redirUrl = xtCompat::sefRelToAbs("index.php?option=com_pollxt&task=results&id=$poll->id&Itemid=$this->frontend->data->Itemid");
						break;
					case "2" :
						// same, but this time index2
						$redirUrl = xtCompat::sefRelToAbs("index2.php?option=com_pollxt&task=results&isPopup=1&id=$poll->id&Itemid=$this->frontend->data->Itemid");
						break;
					case "3" :
						// in module... go to previous page and set task for module
						$redirUrl = xtCompat::sefRelToAbs("index.php?".$this->frontend->data->redir."&xt_resultsId=".$poll->id."&Itemid=".$this->frontend->data->Itemid);
						break;
				}
			}
	
		return html_entity_decode($redirUrl);
	}
	function emailResult($poll, $voteid, $xtVal) {

	$database = JFactory::getDBO();
	$my = JFactory::getUser();
	
	foreach ($xtVal as $x) {
		$ftext[$x[0]] = $x[1];
	}
	
	// build the text for the results
   	$id = intval ($poll->id);
	$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$id' and inact = '0' ORDER BY id";
	$database->setQuery($query);
	$questions = $database->loadObjectList();

	$subject = "Results for Poll \"".$poll->title."\"";

	$msg = stripslashes($poll->mailrestxt)."\n";

// long version
    if ($poll->mailres == 1) {
	foreach ($questions as $q) {
       	$id = intval ($q->id);
		$msg .= "\n\n".$q->title."\n";
		$msg .= "==============================\n";
		$query = "SELECT * FROM #__pollsxt_options WHERE quid = '$id'";
		$database->setQuery($query);
		$results = $database->loadObjectList();
		foreach ($results as $result) {
			if (in_array($result->id, $voteid))
				$msg .= "[X] ";
			else
				$msg .= "[ ] ";
			$msg .= $result->qoption;
			if (isset($ftext[$result->id]))
				$msg .= ": ".$ftext[$result->id]."\n";
			else
				$msg .= "\n";
		}
	}
    }
	else {
// short version
    $i = 0;
    $quid="";
    foreach ($questions as $q) {
        $i++;
       	$id = intval ($q->id);
		$query = "SELECT * FROM #__pollsxt_options WHERE quid = '$id'";
		$database->setQuery($query);
		$results = $database->loadObjectList();
		foreach ($results as $result) {
			if (in_array($result->id, $voteid)) {
            if ($q->id != $quid ) {$quid = $q->id;
            if ($poll->mailres == 2) $msg .= "\n".$q->title."\n";
             else $msg .= $i.".)";
             }
            else
            $msg .= "; ";
			$msg .= $result->qoption;
			if (isset($ftext[$result->id]))
				$msg .= ": ".$ftext[$result->id]."\n";
			else
				$msg .= "\n";
            }
		}
	}

    }
	
    $message = html_entity_decode($msg, ENT_QUOTES);

	if ($my->id) $uname = $my->username;
	else $uname = "anonymous";

	// parse message
	$message = str_replace ("[uname]", $uname, $message);
	$message = str_replace ("[date]", date("d-m-y"), $message);
	$message = str_replace ("[polltitle]", $poll->title, $message);
	// backward campatibility
	$message = str_replace ("<uname>", $uname, $message);
	$message = str_replace ("<date>", date("d-m-y"), $message);
	$message = str_replace ("<polltitle>", $poll->title, $message);

	$config	 = &JFactory::getConfig();
	
	// Send email to user
	if ($config->getValue('mailfrom') != "" && $config->getValue('fromname') != "") {
		$adminName2 = $config->getValue('fromname');
		$adminEmail2 = $config->getValue('mailfrom');;
	} else {
		$database->setQuery("SELECT name, email FROM #__users"."\n WHERE usertype='Super Administrator'");
		$rows = $database->loadObjectList();
		$row2 = $rows[0];
		$adminName2 = $row2->name;
		$adminEmail2 = $row2->email;
		
	}
	if (!$poll->mailresrec) {
		$email = $adminEmail2;
	  	JUtility::sendMail($adminEmail2, $adminName2, $email, $subject, $message);
	}
	else {
		$emaillist = explode(";", $poll->mailresrec);
		foreach ($emaillist as $email) {
         if (strpos($email,":")) {
            $a = strpos($email,":");
            if (in_array(substr($email, 0, $a), $voteid)) {
                $optid = substr($email, 0, $a);
                $email = strstr($email, ":");
				JUtility::sendMail($adminEmail2, $adminName2, $email, $subject, $message); 
            }
         }
        else { 
		  JUtility::sendMail($adminEmail2, $adminName2, $email, $subject, $message);
        }
	  }
   	}
}

}