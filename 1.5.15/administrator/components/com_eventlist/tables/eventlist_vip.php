<?php

defined('_JEXEC') or die('Restricted access');

/**
 * EventList events Model class
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class eventlist_vip extends JTable
{
	/**
	 * Primary Key
	 * @var int
	 */
	var $vip_name	= null;

	var $vip_mail	= '';
	
	var $vip_code	= null;

	var $use_code	= null;
	
	var $code_state	= null;
	
	var $note		= null;

	function eventlist_vip(& $db) {
		parent::__construct('#__eventlist_vip', 'vip_code', $db);
	}

	// overloaded check function
	function check($elsettings)
	{
		// Check fields
		
		if (empty($this->vip_name)) {
			$this->vip_name = NULL;
		}
		
		if (empty($this->vip_mail)) {
			$this->vip_mail = NULL;
		}
		
		if (empty($this->use_code)) {
			$this->use_code = NULL;
		}
		
		if (empty($this->code_state)) {
			$this->code_state = NULL;
		}
		
		if (empty($this->note)) {
			$this->note = NULL;
		}

		$this->vip_code = strip_tags(trim($this->vip_code));
		if ( $this->vip_code == '' ) {
			//$this->_error = JText::_( 'ADD MAIL TITLE' );
      		JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
      		return false;
		}
		
		return true;
	}
}
?>