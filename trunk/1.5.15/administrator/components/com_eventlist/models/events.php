<?php
/**
 * @version 1.0 $Id: events.php 1072 2009-06-29 12:28:50Z schlu $
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

/**
 * EventList Component Events Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelEvents extends JModel
{
	/**
	 * Events data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Events total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 0.9
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe, $option;

    	$limit      = $mainframe->getUserStateFromRequest( $option.'.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    	$limitstart = $mainframe->getUserStateFromRequest( $option.JRequest::getCmd( 'view').'.limitstart', 'limitstart', 0, 'int' );
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

	}

	/**
	 * Method to get event item data
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			$this->_data = $this->_additionals($this->_data);
		}

		return $this->_data;
	}

	/**
	 * Total nr of events
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the total nr if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object for the events
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	/**
	 * Build the query
	 *
	 * @access private
	 * @return string
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$query = 'SELECT a.*, loc.venue, loc.city, loc.checked_out AS vchecked_out, cat.checked_out AS cchecked_out, cat.catname, u.email, u.name AS author'
					. ' FROM #__eventlist_events AS a'
					. ' LEFT JOIN #__eventlist_venues AS loc ON loc.id = a.locid'
					. ' LEFT JOIN #__eventlist_categories AS cat ON cat.id = a.catsid'
					. ' LEFT JOIN #__users AS u ON u.id = a.created_by'
					. $where
					. $orderby
					;

		return $query;
	}

	/**
	 * Build the order clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildContentOrderBy()
	{
		global $mainframe, $option;

		$filter_order		= $mainframe->getUserStateFromRequest( $option.'.events.filter_order', 'filter_order', 'a.id', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'.events.filter_order_Dir', 'filter_order_Dir', '', 'word' );

		$filter_order		= JFilterInput::clean($filter_order, 'cmd');
		$filter_order_Dir	= JFilterInput::clean($filter_order_Dir, 'word');

				if($filter_order == 'a.id' && $filter_order_Dir ==''){
							$filter_order_Dir = 'DESC';
							$filter_order = 'a.dates';
				}


		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.', a.dates, a.times';

		return $orderby;
	}

	/**
	 * Build the where clause
	 *
	 * @access private
	 * @return string
	 */
	function _buildContentWhere()
	{
		global $mainframe, $option;

		$filter_state 		= $mainframe->getUserStateFromRequest( $option.'.filter_state', 'filter_state', '', 'word' );
		$filter 			= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
		$search 			= $mainframe->getUserStateFromRequest( $option.'.search', 'search', '', 'string' );
		$search 			= $this->_db->getEscaped( trim(JString::strtolower( $search ) ) );

		$where = array();

		if ($filter_state) {
			if ($filter_state == 'P') {
				$where[] = 'a.published = 1';
			} else if ($filter_state == 'U') {
				$where[] = 'a.published = 0';
			} else {
				$where[] = 'a.published >= 0';
			}
		} else {
			$where[] = 'a.published >= 0';
		}

		if ($search && $filter == 1) {
			$where[] = ' LOWER(a.title) LIKE \'%'.$search.'%\' ';
		}

		if ($search && $filter == 2) {
			$where[] = ' LOWER(loc.venue) LIKE \'%'.$search.'%\' ';
		}

		if ($search && $filter == 3) {
			$where[] = ' LOWER(loc.city) LIKE \'%'.$search.'%\' ';
		}

		if ($search && $filter == 4) {
			$where[] = ' LOWER(cat.catname) LIKE \'%'.$search.'%\' ';
		}

		$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

		return $where;
	}

	/**
	 * Get the editor name and the nr of attendees
	 *
	 * @access private
	 * @param array $rows
	 * @return array
	 */
	function _additionals($rows)
	{
		for ($i=0, $n=count($rows); $i < $n; $i++) {

			// count registered users
			$query = 'SELECT count(r.event)'
					. ' FROM #__eventlist_register AS r'
					. ' WHERE r.event = '.$rows[$i]->id
					;
			$this->_db->SetQuery( $query );

			$rows[$i]->regCount = $this->_db->loadResult();

			// Get editor name
			$query = 'SELECT name'
					. ' FROM #__users'
					. ' WHERE id = '.$rows[$i]->modified_by
					;
			$this->_db->SetQuery( $query );

			$rows[$i]->editor = $this->_db->loadResult();
		}

		return $rows;
	}

	/**
	 * Method to (un)publish a event
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();
		$userid = (int) $user->get('id');

		if (count( $cid ))
		{
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__eventlist_events'
				. ' SET published = '. (int) $publish
				. ' WHERE id IN ('. $cids .')'
				. ' AND ( checked_out = 0 OR ( checked_out = ' .$userid. ' ) )'
			;

			$this->_db->setQuery( $query );

			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
	}

	/*
	刪除活動並將參與活動的使用者資料
	由controllers/events.php的remove()呼叫
	*/
	function delete($cid = array())
	{
		$result = false;

		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM #__eventlist_events'
					. ' WHERE id IN ('. $cids .')'
					;

			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			$query = 'DELETE FROM #__eventlist_reg_user'
					. ' WHERE reg_id IN ('. $cids .')'
					;

			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	
	/*
	加入/退出報名狀況聯絡群組
	由controllers/events.php的join_admlist()呼叫
	*/
	function maillist($id)
	{
				
		$user 	=& JFactory::getUser();
		$userid = (int) $user->get('id');

		$query = "SELECT member ".
				 "FROM #__eventlist_groupmembers ".
				 "WHERE member = $userid ";
		$this->_db->setQuery( $query );
		$group_State = $this->_db->loadObject();
		
		if($group_State->member == ''){
			$query ="INSERT INTO  #__eventlist_groupmembers ( ".
					"`group_id`, `member` ) ".
					"VALUES ('1',  $userid)";
			$this->_db->setQuery( $query );
			$admLs_msg 	= JRequest::setVar( 'admLs_msg', JText::_('JOIN COMPLETE'), 'post', false );
		}else{
			$query ="DELETE FROM #__eventlist_groupmembers ".
					"WHERE member = $userid ";
			$this->_db->setQuery( $query );
			$admLs_msg 	= JRequest::setVar( 'admLs_msg', JText::_('DELETE COMPLETE'), 'post', false );
		}
								
		if(!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return true;
	}

	/*
	刪除測試資料
	由controllers/events.php的remove_test()呼叫
	*/
	function delete_test($cid = array())
	{
		$result = false;
		
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );
			
			$query = 'DELETE FROM #__eventlist_reg_user'
					.' WHERE reg_id IN ('. $cids .')'
					;
			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			$query = " UPDATE #__eventlist_vip "
					." SET vip_name = NULL, "
					." vip_mail = NULL, "
					." use_code = NULL, "
					." code_state = 'n', "
					." note = NULL "
					." WHERE reg_id IN ( $cids )"
					;

			$this->_db->setQuery( $query );
			
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}

		return true;
	}
	
	
}//Class end
?>
