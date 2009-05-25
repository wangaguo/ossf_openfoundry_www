<?php
/**
 * gj.pms.pmsenh.php
 * 
 * This file contains extended PMS class for PMSEnhanced
 * @author Michael Perthel <micha@voodootools.de> based on work of Anna Tannenberg
 * @version 1.0
 * @package com_groupjive
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Class to support private messaging systems
* @package groupjive
*/
class pmsenh_pms extends gj_pms {

	var $_code = "bbcode";

	/**
	 * validate the given data
	 */
	function validate() {
		$this->_errorNum = 0;

		if (!file_exists('components/com_pms/')) {
			$this->_errorNum = 1;
		} else if (empty($this->_from)) {
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
			$date = date('Y-m-d');
			$time = date('H:i:s');

			$sql="INSERT INTO #__pms"
				. "\n(recip_id,sender_id,date,time,readstate,subject,message)"
				. "\nVALUES ('".$this->_to->id."','".$this->_from->id."',"
				. "\n'$date','$time','','".escapeString($this->subject)."','".escapeString($this->message)."')";
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
