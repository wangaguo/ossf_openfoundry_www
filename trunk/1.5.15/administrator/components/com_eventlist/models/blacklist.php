<?php
/**i
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
 * EventList Component blacklist Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelblacklist extends JModel
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
			//$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			$this->_data = $this->_getList($query);
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
	 * 資料庫查詢加上where和order
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where	= $this->_buildContentWhere();
		$orderby= $this->_buildContentOrderBy();

		$query = 'SELECT * '.
			 'FROM #__eventlist_reg_user '.
			 $where.
			 $orderby; 
		
		return $query;
	}

	/**
	 * mysql Where
	 */
	function _buildContentWhere()
	{
		$where = ' WHERE black = "y" ';
		
		return $where;
	}

	/**
	 * msyql order
	 */
	function _buildContentOrderBy()
	{
		$orderby 	= ' GROUP by u_email ';

		return $orderby;
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

			// Get editor naime
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
	 移除黑名單
	 由controllers/blacklist.php的remove()呼叫
	*/
	 
	function delete($cid = array())
	{
		$result = false;
		
		for($i=0;$i<count($cid);$i++){
		
		$del_id = explode( '&', $cid[$i] );
		
		$today = date("Y-m-j");
		
		$query = 'UPDATE #__eventlist_reg_user '
				.' SET black = "n" '
				.' WHERE '
				.' u_email = "'.$del_id[2].'"'
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
