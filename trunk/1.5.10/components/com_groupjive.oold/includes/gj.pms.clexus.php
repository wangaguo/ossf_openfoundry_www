<?php
/**
 * gj.pms.clexus.php
 * 
 * This file contains extended PMS class for Clexus
 * @author Michael Perthel <micha@voodootools.de> based on work of Anna Tannenberg
 * @version 1.0
 * @package com_groupjive
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Class to support private messaging systems
* @package groupjive
*/
class clexus_pms extends gj_pms {

	var $_code = "bbcode";

	/**
	 * validate the given data
	 */
	function validate() {
		$this->_errorNum = 0;
		if (empty($this->_from)) {
			$this->_errorNum = 10;
		} else if (empty($this->_to)) {
			$this->_errorNum = 20;
		} else if (empty($this->subject)) {
			$this->_errorNum = 30;
		} else if (empty($this->message)) {
			$this->_errorNum = 40;
		}

	// TODO: check if inbox is full

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
		global $database;
		$disablereply = "1";
		$sysflag = "Group Messenger";
		$timestamp = time();

		if ($this->validate()) {
			$datetime = date('Y-m-d H:i:s');

			$sql="INSERT INTO #__mypms"
				. "\n(userid,whofrom,time,subject,message,owner)"
				. "\nVALUES ('".$this->_to->id."','".$this->_from->id."',"
				. "\n'$datetime','".escapeString($this->subject)."',"
				. "\n'".escapeString($this->message."',"
				. "\n'".$this->_to->id."')";
			$database->setQuery($sql);
		
			if (!$database->query()) {
				die("SQL error when attempting to save a message" . $database->stderr(true));
			}
			return true;
		} else {
			return false;
		}
	}
}
?>
