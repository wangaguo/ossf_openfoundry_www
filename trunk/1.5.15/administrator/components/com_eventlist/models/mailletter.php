<?php
/**
 * @version 1.0 $Id: event.php 1005 2009-04-16 10:09:57Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');
jimport( 'joomla.database.database.mysql' );
/**
 * EventList Component Event Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelMailLetter extends JModel
{
	/**
	 * Event id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * Event data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Categories data array
	 *
	 * @var array
	 */
	var $_categories = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		JArrayHelper::toInteger($cid, array(0));
		$this->setId($cid[0]);
	}

	/**
	 * Method to set the identifier
	 *
	 * @access	public
	 * @param	int event identifier
	 */
	function setId($id)
	{
		// Set event id and wipe data
		$this->_id	    = $id;
		$this->_data	= null;
	}

	/**
	 * Logic for the event edit screen
	 *
	 */
	function &getData()
	{

		if ($this->_loadData())
		{

		}
		else  $this->_initData();

		return $this->_data;
	}

	/**
	 * Method to load content event data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = 'SELECT * '
					. ' FROM #__eventlist_mail '
					. ' WHERE id = '.$this->_id
					;
			$this->_db->setQuery($query);
			
			$check_where[] = " id=$this->_id ";
			$this->_data =  ELOutput::search_data( $check_where, 'mail', '' );
			unset($check_where);
			
			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to initialise the event data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function _initData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$event = new stdClass();
			$event->id					= 0;
			$event->kind					= '';
			$event->message					= '';
			$this->_data				= $event;
			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to checkin/unlock the item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function checkin()
	{
		if ($this->_id)
		{
			$event = & JTable::getInstance('eventlist_mail_list', '');
			return $event->checkin($this->_id);
		}
		return false;
	}

	/**
	 * Method to checkout/lock the item
	 *
	 * @access	public
	 * @param	int	$uid	User ID of the user checking the item out
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function checkout($uid = null)
	{
		if ($this->_id)
		{
			// Make sure we have a user id to checkout the event with
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$event = & JTable::getInstance('eventlist_mail_list', '');
			return $event->checkout($uid, $this->_id);
		}
		return false;
	}

	/**
	 * Tests if the event is checked out
	 *
	 * @access	public
	 * @param	int	A user id
	 * @return	boolean	True if checked out
	 * @since	0.9
	 */
	function isCheckedOut( $uid=0 )
	{
		if ($this->_loadData())
		{
			if ($uid) {
				return ($this->_data->checked_out && $this->_data->checked_out != $uid);
			} else {
				return $this->_data->checked_out;
			}
		} elseif ($this->_id < 1) {
			return false;
		} else {
			JError::raiseWarning( 0, 'Unable to Load Data');
			return false;
		}
	}

	/**
	 * Method to store the event
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		global $mainframe;

		$elsettings = ELAdmin::config();
		$user		= & JFactory::getUser();

		$tzoffset 	= $mainframe->getCfg('offset');

		$row =& JTable::getInstance('eventlist_mail_list', '');

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// sanitise id field
		$row->id = (int) $row->id;
		$row->kind = $row->kind;
		$row->message = $row->message;

		// Make sure the data is valid
		if (!$row->check($elsettings)) {
			$this->setError($row->getError());
			return false;
		}

		// Store the table to the database
		if (!$row->store(true)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return $row->id;
	}
}
?>
