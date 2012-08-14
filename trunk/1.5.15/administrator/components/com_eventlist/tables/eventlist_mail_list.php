<?php
/**
確認mail letter 儲存時所有欄位是否符合條件
 */

defined('_JEXEC') or die('Restricted access');

/**
 * EventList events Model class
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class eventlist_mail_list extends JTable
{
	/**
	 * Primary Key
	 * @var int
	 */
	var $id 				= null;

	var $kind			= '';
	
	var $message 		    = null;
	function eventlist_mail_list(& $db) {
		parent::__construct('#__eventlist_mail', 'id', $db);
	}

	// overloaded check function
	function check($elsettings)
	{
		// Check fields
		
		if (empty($this->message)) {
			$this->message = NULL;
		}
		
		$this->kind = strip_tags(trim($this->kind));
		if ( $this->kind == '' ) {
			$this->_error = JText::_( 'ADD MAIL TITLE' );
      		JError::raiseWarning('SOME_ERROR_CODE', $this->_error );
      		return false;
		}
		
		return true;
	}
}
?>