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
class EventListModelEvent extends JModel
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
			$query = 'SELECT e.*, v.venue'
					. ' FROM #__eventlist_events AS e'
					. ' LEFT JOIN #__eventlist_venues AS v ON v.id = e.locid'
					. ' WHERE e.id = '.$this->_id
					;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;
		}
		return true;
	}

	/**
	 * Method to get the category data
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	0.9
	 */
	function &getCategories()
	{
		$query = 'SELECT id AS value, catname AS text'
				. ' FROM #__eventlist_categories'
				. ' WHERE published = 1'
				. ' ORDER BY ordering'
				;
		$this->_db->setQuery( $query );

		$this->_categories = $this->_db->loadObjectList();

		return $this->_categories;
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
			$event->locid				= 0;
			$event->catsid				= 0;
			$event->dates				= null;
			$event->enddates			= null;
			$event->times				= null;
			$event->endtimes			= null;
			$event->title				= null;
			$event->alias				= null;
			$event->created				= null;
			$event->author_ip			= null;
			$event->created_by			= null;
			$event->published			= 0;
			$event->registra			= 0;
			$event->unregistra			= 0;
			$event->full				= 0;
			$event->datdescription		= null;
			$event->meta_keywords		= null;
			$event->meta_description	= null;
			$event->recurrence_number	= 0;
			$event->recurrence_type		= 0;
			$event->recurrence_counter	= '0000-00-00';
			$event->datimage			= JText::_('SELECTIMAGE');
			$event->venue				= JText::_('SELECTVENUE');
			$event->vip_regdate			= '0000-00-00';
			$event->reg_area			= 0;
			$event->reg_msg				= null;
			$event->mail_title			= null;
			//$event->reg_type			= 0;
			$event->candidate			= 0;
			$event->reg_free			= 'free';
			$event->vip_endtime			= null;
			$event->image_link			= null;
			$event->link_switch			= null;
			$event->open_date			= null;
			$event->open_time			= null;
			$event->survey				= null;
			$event->reg_eat				= null;
			$event->audit				= null;
			$event->signupEndtime		= null;
			$event->signupEnddate		= null;
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
			$event = & JTable::getInstance('eventlist_events', '');
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
			$event = & JTable::getInstance('eventlist_events', '');
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

		$row =& JTable::getInstance('eventlist_events', '');

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Check/sanitize the metatags => done in joomla filterinput
		//$row->meta_description = htmlspecialchars(trim(addslashes($row->meta_description)));
		if (JString::strlen($row->meta_description) > 255) {
			$row->meta_description = JString::substr($row->meta_description, 0, 254);
		}
    // sanitize  => done in joomla filterinput
		//$row->meta_keywords = htmlspecialchars(trim(addslashes($row->meta_keywords)));
		if (JString::strlen($row->meta_keywords) > 200) {
			$row->meta_keywords = JString::substr($row->meta_keywords, 0, 199);
		}

		//Check if image was selected
		jimport('joomla.filesystem.file');
		$format 	= JFile::getExt('JPATH_SITE/images/eventlist/events/'.$row->datimage);

		$allowable 	= array ('gif', 'jpg', 'png');
		if (in_array($format, $allowable)) {
			$row->datimage = $row->datimage;
		} else {
			$row->datimage = '';
		}
		
		// sanitise id field
		$row->id = (int) $row->id;

		$nullDate	= $this->_db->getNullDate();

		// Are we saving from an item edit?
		if ($row->id) {
			$row->modified 		= gmdate('Y-m-d H:i:s');
			$row->modified_by 	= $user->get('id');
		} else {
			$row->modified 		= $nullDate;
			$row->modified_by 	= '';

			//get IP, time and userid
			$row->created 			= gmdate('Y-m-d H:i:s');

			$row->author_ip 		= $elsettings->storeip ? getenv('REMOTE_ADDR') : 'DISABLED';
			$row->created_by		= $row->created_by;
 
		}

		$row->survey	= $row->survey;

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

	/*
	顯示報名情況聯絡群組
	由/view/event/tmpl/default.php 呼叫
	*/
	function contact_cum()
	{
				
		$db = JFactory::getDBO();
		$query = 'SELECT member '
				. ' FROM #__eventlist_groupmembers'
				. ' WHERE group_id = 1 '
				;
		$db->setQuery($query);
		$CL = $db->loadObjectlist();

		
		foreach($CL as $admLs){
		  $adm[]="'".$admLs->member."'";
		}
		
		if($adm[0]!=''){
			$adm_Mail = implode(",",$adm);
			$query ="SELECT username, email ".
							"FROM #__users ".
							"WHERE id IN($adm_Mail)";
			$db->setQuery($query);
			$adm_ls = $db->loadObjectlist();
			$Ls = '';
			foreach($adm_ls as $list){
				$Ls .= $list->username."<br>";
			}
		}else{
			$Ls = 'N/A';
		}
		return $Ls;
	}
	
	/*
	生成聯絡人列表 event(編輯活動)時使用
	views/event/tmpl/default.php使用
	*/
	function add_list( $default_value, $gid, $name ){
		
		$db = JFactory::getDBO();
		$creater_List = "SELECT member ".
						"FROM #__eventlist_groupmembers ".
						"WHERE group_id = $gid";
		$db->setQuery($creater_List);
		$createrList = $db->loadObjectList();

		foreach($createrList as $speakerList){
			$speaker_List[] = $speakerList->member;
		}
		$speakerArray = implode(',',$speaker_List);
	
		$speaker = "SELECT * ".
				 "FROM #__users ".
				 "WHERE id IN($speakerArray)";
		$db->setQuery($speaker);
		
		$speakArray=array();
		$speak_Array = $db->loadObjectList();
		
		$speakArray[] = JHTML::_('select.option', 0 , "--".JText::_( 'PLEASE CHOOSE' )."--");
		
		foreach($speak_Array as $created_byArray){
			$speakArray[] = JHTML::_('select.option', $created_byArray->id , JText::_( $created_byArray->name ));
		}

		$sp_list = $lists[$name] = JHTML::_('select.genericlist', $speakArray, "$name", 'size="1" class="inputbox" "', 'value', 'text', $default_value );
	
		return $sp_list;
	}

	/*
	生成報名通知群組列表 event(編輯活動)時使用
	models/event.php使用
	*/
	function members($g_id)
	{
    	//get selected members
		if ($g_id){
			$query = 'SELECT member'
					. ' FROM #__eventlist_groupmembers'
					. ' WHERE group_id = '.$g_id;

			$this->_db->setQuery ($query);

			$member_ids = $this->_db->loadResultArray();

			if (is_array($member_ids)) $members = implode(',', $member_ids);
		}
		return $members;
	}

	/*
	取得講者列表
	views/event/view.html.php 使用
	 */
	function getall_user()
	{
		$members = $this->members(3);
		$speak_member = $this->speak_members( $this->_id );
		
    	// get non selected members
    	$query = 'SELECT id AS value, username, name FROM #__users';
    	$query .= ' WHERE block = 0' ;

    	if ($members) $query .= ' AND id IN ('.$members.')' ;
    	
    	if ($speak_member) $query .= ' AND id NOT IN ('.$speak_member.')' ;
    	
    	$query .= ' ORDER BY username ASC';

    	$this->_db->setQuery($query);

    	$all_user = $this->_db->loadObjectList();

    	$k = 0;
		for($i=0, $n=count( $all_user ); $i < $n; $i++) {
    		$item = $all_user[$i];

			$item->text = trim($item->username,"!").' ('.$item->name.')';

    		$k = 1 - $k;
		}

		return $all_user;
	}
	
	/*
	取得講者列表
	views/event/view.html.php 使用
	 */
	function speak_members($g_id)
	{
    	//get selected members
		if ($g_id){
			$query = 'SELECT created_by'
					. ' FROM #__eventlist_events'
					. ' WHERE id = '.$g_id;

			$this->_db->setQuery ($query);

			$member_ids = $this->_db->loadObject();

		}

		return $member_ids->created_by;
	}

	/*
	取得講者資料
	views/event/view.html.php 使用
	 */
	function getSpeaker()
	{

		$members = $this->speak_members( $this->_id );
		
    	// get non selected members
    	$query = 'SELECT id AS value, username, name FROM #__users';
    	$query .= ' WHERE block = 0' ;

    	if ($members){
			 $query .= ' AND id IN ('.$members.')' ;
		}else{
			 $query .= ' AND id = 0 ' ;
		}
		
    	$query .= ' ORDER BY username ASC';

    	$this->_db->setQuery($query);

    	$getSpeaker = $this->_db->loadObjectList();

    	$k = 0;
		for($i=0, $n=count( $getSpeaker ); $i < $n; $i++) {
    		$item = $getSpeaker[$i];

			$item->text = trim($item->username,"!").' ('.$item->name.')';

    		$k = 1 - $k;
		}

		return $getSpeaker;
	}
}
?>

