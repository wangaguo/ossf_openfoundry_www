<?php
/**
 * gj.pms.email.php
 * 
 * This file contains extended PMS class for email ;)
 * @author Michael Perthel <micha@voodootools.de> based on work of Anna Tannenberg
 * @version 1.0
 * @package com_groupjive
 */
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Class to support private messaging systems
* @package groupjive
*/
class email_pms extends gj_pms {

	// needs to be adjusted - so people can decide if plain or HTML
	var $_code = "html";

	/**
	 * validate the given data
	 */
	function validate() {
		$this->_errorNum = 0;
//		if (empty($this->_from)) {
//			$this->_errorNum = 10;
//		} else
		if (empty($this->_to)) {
			$this->_errorNum = 20;
		} else if (empty($this->subject)) {
			$this->_errorNum = 30;
		} else if (empty($this->message)) {
			$this->_errorNum = 40;
		}

		if ($this->_errorNum) {
			return false;
		} else {
			return true;
		}
	}


	/**
	 * send the message
	 */
	function send () {
		global $database,$mosConfig_mailfrom;
		if ($this->validate()) {
			$datetime = date('Y-m-d H:i:s');
			$sysflag = "Group Messenger";
//			echo 'SEND: return mosMail('.$mosConfig_mailfrom.', "Group Messenger", '.
//				$this->_to->email. ', '.$this->subject.', '.$this->message.', true';
//				exit;
			return mosMail($mosConfig_mailfrom, "Group Messenger", 
				$this->_to->email, $this->subject, $this->message, true);
		}
	}
}
?>
