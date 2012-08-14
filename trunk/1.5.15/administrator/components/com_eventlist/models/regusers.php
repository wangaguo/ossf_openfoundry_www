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
class EventListModelRegusers extends JModel
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
		$this->_id	    = JRequest::getVar( 'cid', array(0), '', 'array' );
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
			$user_num = explode(" ", $this->_id[0]);

			$where[] = " reg_id = $user_num[0] ";
			$where[] = " reg_sn = $user_num[1] ";
			$user = ELOutput::search_data( $where, 'reg_user', '' );
			unset($where);
			$this->_data = $user;

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
			$event->reg_id;
			$event->reg_sn;
			$event->u_name;
			$event->u_email;
			$event->u_regday;
			$event->u_sex;
			$event->u_company;
			$event->u_captaincy;
			$event->u_tel;
			$event->u_addr;
			$event->u_eat;
			$event->u_date;
			$event->u_signup;
			$event->ch_phone;
			$event->ch_join;
			$event->note;
			$event->community;
			$event->black;
			$event->vip_code;
			$event->uid;
			$event->uregdate;
			$event->uip;
			$event->ch_mail;
			$event->cancel_mail;
			$event->notes;
			$event->waiting;
			$event->survey;
			$event->survey_text;
			$event->reg_audit;
			$this->_data;
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
		$user_num = explode(" ", $this->_id[0]);
		if ($user_num[0])
		{
			$event = & JTable::getInstance('eventlist_reguser', '');
			return $event->checkin($user_num[0]);
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
		$user_num = explode(" ", $this->_id[0]);
		if ($user_num[0])
		{
			// Make sure we have a user id to checkout the event with
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$event = & JTable::getInstance('eventlist_reguser', '');
			return $event->checkout($uid, $user_num[0]);
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
			$user_num = explode(" ", $this->_id[0]);
			if ($uid) {
				return ($this->_data->checked_out && $this->_data->checked_out != $uid);
			} else {
				return $this->_data->checked_out;
			}
		} elseif ($user_num[0] < 1) {
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

		$row =& JTable::getInstance('eventlist_reguser', '');
		$row->ch_join	= $row->ch_join;
		$row->reg_id 	= $row->reg_id;
		$row->reg_sn 	= $row->reg_sn;
		
		return $row->id;
	}
	
	/*
	 顯示出席紀錄
	 由/view/regusers/tmpl/default.php使用
	*/
	function join_list($user_mail)
	{
		global $mainframe;
		
		$db = JFactory::getDBO();
		$join_data ="SELECT reg_id, ch_join ".
					"FROM #__eventlist_reg_user ". 
					"WHERE u_email = '".$user_mail."'";	
		$db->setQuery($join_data);
		$join_data = $db->loadObjectList();
		
		$join_list = array();
		foreach($join_data as $join){
			$join_list[] = $join->reg_id;
		}
		
		$user_event = implode( ' , ', $join_list );
		
		$join_event =	"SELECT  a.id, a.title, a.dates, b.black ".
						"FROM jos_eventlist_events AS a ".
						"left join ".
						"jos_eventlist_reg_user AS b ".
						"ON a.id=b.reg_id ".
						"AND b.u_email = '".$user_mail."' ";
		$db->setQuery($join_event);
		$event_name = $db->loadObjectList();
		
		$join_image  = JHTML::_('image', 'administrator/images/tick.png', JText::_('NOTES'),'height=16 width =16' );
		$black_image = JHTML::_('image', 'administrator/images/publish_x.png', JText::_('NOTES'),'height=16 width =16' );
						
		$put_list ='';
		foreach($event_name as $event_list){
			if($event_list->black != ''){
				if($event_list->black == 'y'){
					$put_list.= $black_image.' '.$event_list->dates.' '.$event_list->title."<br>";
				}else{
					$put_list.= $join_image.' '.$event_list->dates.' '.$event_list->title."<br>";
				}		
			}
		}
		
		return $put_list;

	}
}
?>
