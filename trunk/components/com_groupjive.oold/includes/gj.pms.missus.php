<?php
/**
 * gj.pms.missus.php
 * 
 * This file contains extended PMS class for Missus
 * @author Michael Perthel <micha@voodootools.de> based on work of Anna Tannenberg
 * @version 1.0
 * @package com_groupjive
 */
 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Class to support private messaging systems
* @package groupjive
*/
class missus_pms extends gj_pms {

	var $_code = "bbcode_advanced";

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

		if ($this->validate()) {
			$datetime = date('Y-m-d H:i:s');

			$sql="INSERT INTO #__missus (senderid,datesended,subject,message)"
				. "\nVALUES ('".$this->_from->id."','$datetime',"
				. "\n'".escapeString($this->subject)."',"
				. "\n'".escapeString($this->message)."')"; 
			$database->setQuery($sql);
			if (!$database->query()) {
				die("SQL error when attempting to save a message" . $database->stderr(true));
			}

			$message_id = mysql_insert_id();
			$sql="INSERT INTO #__missus_receipt (id, receptorid)"
				. "\nVALUES ('$message_id','".$this->_to->id."')"; 
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
