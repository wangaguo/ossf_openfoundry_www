<?php
/**
 * gj.core.pms.php
 * 
 * This file contains PMS and Message class for Groupjive
 * @author Michael Perthel <micha@voodootools.de>
 * @version 1.0
 * @package com_groupjive
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Class to support private messaging systems
 * @package groupjive
 */
class gj_pms {
	/** @var int Sender userid */
	var $fromid = null;
	/** @var int Receiver userid */
	var $toid = null;
	/** @var string Subject */
	var $subject = null;
	/** @var string Message */
	var $message = null;
	/** @var int Errornumber */
	var $_errorNum = 0;
	/** @var string Errormessage */
	var $_errorMsg = array();
	/** @var object userdata receiver */
	var $_to = null;
	/** @var object userdata sender */
	var $_from = null;
	/** @var string Code i.e. BBCode, HTML, plain */
	var $_code = 'plain';


/**
 * Constructor
 * @param int Sender userid
 * @param int Receiver userid
 * @param string Subject
 * @param string Message
 */
	function gj_pms($fromid=null, $toid=null, $subject=null, $message=null) {
            
		$this->fromid = $fromid;
		$this->toid = $toid;
		$this->setSubject($subject);
		$this->setMessage($message);
		$this->_loadErrorMessages();
	}

/**
 * Set the senders ID
 * @param int Sender userid 
 */ 
	function setFromId($fromid) {
		$this->fromid = $fromid;
	}

/**
 * Set the receivers ID
 * @param int receiver userid 
 */ 
	function setToId($toid) {
		$this->toid = $toid;
	}

/**
 * Set the subject
 * @param string Subject
 */ 
	function setSubject($subject) {
            global $database;
            $this->subject = $subject;
	}

/**
 * Set the message
 * @param string message
 */ 
	function setMessage($message) {
            global $database;
            $this->message = $message;
	}

/**
 * Set receiver object
 * @param object receiver data
 */
	function setReceiverObject($to) {
		if (is_object($to)) {
			$this->_to = $to;
			$this->toid = $this->_to->id;
		}
	}

/**
 * Set sender object
 * @param object sender data
 */
	function setSenderObject($from) {
		if (is_object($from)) {
			$this->_from = $from;
			$this->fromid = $this->_from->id;
		}
	}

/**
 * Get codetype (html, bbcode...)
 * returns string 
 */
	function getCode() {
		return $this->_code;
	}

	function _loadErrorMessages() {
		$this->_errorMsg[1] = 'PM component not installed!';
		$this->_errorMsg[10] = 'No from Id';
		$this->_errorMsg[20] = 'No to Id';
		$this->_errorMsg[30] = 'No subject';
		$this->_errorMsg[40] = 'No message';
		
		$this->_errorMsg[100] = 'Inbox full';
	}

/**
 * returns errornumber
 */
	function getErrorNum() {
		return $this->_errorNum;
	}

/**
 *returns errormessage
 */
	function getErrorMsg() {
		if ($this->_errorNum) { 
			return $this->_errorMsg[$thís->_errorNum];
		} else {
			return "no error";
		}
	}

/**
* loads data of receiver and sender
*/
	function _loadData() {
		$this->_from = new mosUser($database);
		$this->_from->load($fromid);

		$this->_to = new mosUser($database);
		$this->_to->load($toid);
	}

	/**
	 * needs to be filled by the child class
	 */
	function send() {
	}

	/**
	 * validate the given data
	 */
	function validate(){
	}
}

/**
* Class to create localised messages
* @package groupjive
*/
class gj_message {
	/** @var object Sender*/
	var $_from = null;
	/** @var object Receiver*/
	var $_to = null;
	/** @var object Group */
	var $_group = null;
	/** @var string Message */
	var $message = null;
	/** @var string Subject */
	var $subject = null;
	/** @var string Type */
	var $type = null;
	/** @var boolean Realnames indicator */
	var $realnames = null;
	/** @var string name of the pmsystem */
	var $pms = null;
	/** @var string name of the pmsclass */
	var $_pmsClass = null;
	/** @var string invitation code */
	var $invitecode = null;
	/** @var int Errornumber */
	var $_errorNum = 0;
	/** @var string Errormessage */
	var $_errorMsg = '';
/**
 *Constructor
 */

	function gj_message($from=null, $to= null, $group=null, $message=null, $type=null, $code=null, $realnames=null, $pms=null, $invitecode=null) {
		global $database;

		$this->_from = $from;
		$this->_to = $to;
		$this->_group = $group;
		$this->message = $message;
		$this->code = $code;
		$this->type = $type;
		$this->realnames = $realnames;
		$this->pms = $pms;
		$this->invitecode = $invitecode;
	}

/**
 * load sender object
 * @param int sender ID
 */
	function loadSender($fromid) {
		global $database;
		if (is_numeric($fromid)) {
			$this->_from = new mosUser($database);
			$this->_from->load($fromid);
		}
	}

/**
 * Set sender object
 * @param object sender data
 */
	function setTo($to) {
		if (is_object($to)) {
			$this->_to = $to;
		}
	}

/**
 * Set pms
 * @param string pms name
 */
	function setPms($pms) {
		if (is_string($pms)) {
			$this->pms = $pms;
			$this->_pmsClass = $pms."_pms";
		}
	}



/**
 * loads group object from ID
 * @param int group id
 */
	function loadGroup($gid){
		global $database;
		if (is_numeric($gid)) {
			$this->_group = new groupJiveGroup($database);
			$this->_group->load($gid);
		}
	} 


/**
 * Set group object
 * @param object group data
 */
	function setGroup($group) {
		if (is_object($group)) {
			$this->_group = $group;
		}
	}

/**
 * loads receiver object from ID
 * @param int group id
 */
	function loadReceiver($toid){
		global $database;
		if (is_numeric($toid)) {
			$this->_to = new mosUser($database);
			$this->_to->load(intval($toid));
		}
	} 

/**
 * Set sender object
 * @param object sender data
 */
	function setFrom($from) {
		if (is_object($from)) {
			$this->_from = $from;
		}
	}

/**
 * Set subject
 * @param string subject
 */
	function setSubject($subject) {
		$this->subject = $subject;
	}

/**
 * Set message
 * @param string message
 */
	function setMessage($message) {
		$this->message = $message;
	}

/**
 * Set messagetype
 * @param string messagetype
 */
	function setType($type) {
		$this->type = $type;
	}

/**
 * Set realnames indicator
 * @param boolean realnames indicator
 */
	function setRealnames($realnames) {
		$this->realnames = $realnames;
	}

/**
 * Set invitationcode
 * @param string invitation code
 */
	function setInviteCode($invitecode){
		$this->invitecode = $invitecode;
	}

/**
 * Set receiver list
 * @param array list of userids
 */
	function setReceiverList($rec_list) {
		$this->receiverList = $rec_list;
	}

/**
 * Load receiver list
 */
	function loadReceiverList() {
		if ($this->_group->id) {
			// TODO SQL load user ids
		}
	}

	function send(){
		if ($this->type == 'notifyall') {
			$return = $this->_sendall();
		} else {
			$return = $this->_send();
		}
		
		return $return;
	}

/**
 * send the message
 */
	function _send() {
		require_once(GJBASEPATH."/includes/gj.pms.".$this->pms.".php");
		$pms = new $this->_pmsClass;
		$return = true;

		if (!$this->_to) {
			$this->loadReceiver($this->_group->user_id);
		}

		$pms->setReceiverObject($this->_to);
		$pms->setSenderObject($this->_from);
		$pms->setMessage($this->_localize($pms->getCode()));

		$pms->setSubject($this->subject); // maybe localize that too

		$return  = true;
		if ($pms->validate()) {
			$pms->send();
		} 

		if ($pms->getErrorNum()) {
			$this->_errorNum = $pms->getErrorNum();
			$this->_errorMsg = $pms->getErrorMsg();
			$return = false;
		}
		return $return;
	}

	/**
 * send the message
 */
	function _sendall() {
		global $database;
		require_once(GJBASEPATH."/includes/gj.pms.".$this->pms.".php");
		$return = true;

		$gj_group = new groupJiveGroup($database);
		$gj_group->load($this->_group->id);
		$gj_group->getUsersOfGroup();

		foreach ($gj_group->users as $user) {

		$pms = new $this->_pmsClass;
	
			$this->loadReceiver($user->id_user);

			$pms->setReceiverObject($this->_to);
			$pms->setSenderObject($this->_from);
			$pms->setMessage($this->_localize($pms->getCode()));
			$pms->setSubject($this->subject); // maybe localize that too
//	echo "<p>send to :";print_r($pms);echo"</p>";
			$return  = true;
			if (($pms->validate()) && ($this->_to->id != $this->_from->id)) {
				$pms->send();
			} 
	
			if ($pms->getErrorNum()) {
				$this->_errorNum = $pms->getErrorNum();
				$this->_errorMsg .= $pms->getErrorMsg()."\n";
				$return = false;
			}
			unset($pms);
		}
		return $return;
	}

/**
 * localizes the message and replaces placeholders
 * @param string used code in PM system (BBCode, BBcode advanced, HTML, plain)
 * @return string localized message 
 */
	function _localize($code) {
		global $mosConfig_live_site, $Itemid;

		switch ($this->type) {
			case 'invite':
					// check if message is empty 
					// if so assign languagestring depending
					// on the code
					if (empty($this->message)) {
						switch ($this->code) {
							case 'plain':
								$this->message = GJ_HELLO_JIM;
								break;
							case 'html';
								$this->message = GJ_HELLO;
								break;
							default:
								$this->message = GJ_HELLO_UDDEIM;
								break;
						}
					}
					$url = "$mosConfig_live_site/index.php?option=com_groupjive&task=active&groupid="
						. $this->_group->id."&Itemid=$Itemid&code=".$this->invitecode;
					$linktext = GJ_INVITE_LINKTEXT;
				break;
			case 'notify':
			case 'notifyall':
				$url = $mosConfig_live_site.'/index.php?option=com_groupjive&task=bulletin&groupid='
					.$this->_group->id.'&Itemid='.$Itemid;
				$linktext = GJ_BULLETIN_LINKTEXT;
				break;
			default:
				break;
		}

		$message = $this->message;
		// Username -> use realnames indicator
		if ($this->realnames) {
			$message=str_replace("%to_name",$this->_to->name,$message);
			$message=str_replace("%from_name",$this->_from->name,$message);
		}else{
			$message=str_replace("%to_name",$this->_to->username,$message);
			$message=str_replace("%from_name",$this->_from->username,$message);
		}

		$message=str_replace("%group_name",$this->_group->name,$message);
		if (strpos($message, '%link')) {
			$message=str_replace("%link",$this->_getLink($url, $linktext, $code) ,$message);
		}
		return $message;
	}

/**
 * forms a link
 * @param string link
 * @param string linktext
 * @param string used code in PM system (BBCode, BBcode advanced, HTML, plain)
 * @return string wellformed link
 */
	function _getLink($link, $linktext, $code) {
		switch ($code) {
			case 'bbcode':
					$link = '[url]'.$link.'[/url]';
					break;
			case 'bbcode_advanced':
					$link = '[url='.$link.']'.$linktext.'[/url]';
				break;
			case 'html':
					$link = '<a href="'.$link.'" alt="'
						.$linktext.'">'.$linktext.'</a>';
				break;
			default:
				break;
		}
		return $link;
	}


/**
 * returns errornumber
 */
	function getErrorNum() {
		return $this->_errorNum;
	}

/**
 *returns errormessage
 */
	function getErrorMsg() {
		if ($this->_errorNum) { 
			return $this->_errorMsg;
		}
	}
}
?>
