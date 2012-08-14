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

 filter_signup 為報名者篩選(所有名單,可參加,候補,無法參加)
 0=所有名單
 1=正常可參加
 2=候補
 3=額滿
 5=取消報名
 6=審核通過(審核制才出現)
 7=審核未通過(審核制才出現)
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
class EventListModelreguser extends JModel
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
	 * filter 生成
	 * var變數生成
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe, $option;

    	$row->reg_id      = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int');
		
		$db = JFactory::getDBO();
		$seminar_data = "SELECT full, candidate, catsid ".
						"FROM #__eventlist_events ".
						"WHERE id = ".$row->reg_id;
		$db->setQuery($seminar_data);
		$seminar_data = $db->loadObject();
		
		$limit      = $mainframe->getUserStateFromRequest( $option.'.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    	$limitstart = $mainframe->getUserStateFromRequest( $option.JRequest::getCmd( 'view').'.limitstart', 'limitstart', 0, 'int' );
	
    	$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		
		JRequest::setVar( 'reg_full', $seminar_data->full );
		JRequest::setVar( 'candidate', $seminar_data->candidate);
		JRequest::setVar( 'reg_class', $seminar_data->catsid);
	}
	
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
			
		 	$this->_data = $this->_getList($query, 0, 0);
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
		*查詢的資料庫加上where和order
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();
		$groupby	= $this->_buildGroupBy();
		$query = 'SELECT * '.
				 'FROM #__eventlist_reg_user '
				 .$where
				 .$orderby
				 .$groupby;
		return $query;
	}
	function _buildGroupBy()
	{
		global $mainframe, $option;

		$filter_signup 	= $mainframe->getUserStateFromRequest( $option.'.filter_signup', 'filter_signup', '', 'int' );
		$filter 		= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
		$reg_class 		= $mainframe->getUserStateFromRequest( $option.'.reg_class', 'reg_class', '', 'int' );
		$glist 			= $mainframe->getUserStateFromRequest( $option.'.glist', 'glist', '', 'int' );
		$area 			= $mainframe->getUserStateFromRequest( $option.'.area', 'area', '', 'int' );

		if( $filter == 0 ){
			$groupby = ' GROUP BY u_email ';
		}
		
		return $groupby;
	}
	/**
	 * 生成mysql的OrderBy
	 * 主要作list join candidate full 的過濾功能
	 */
	function _buildContentOrderBy()
	{
		global $mainframe, $option;
		$filter 		= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );
		$filter_signup 	= $mainframe->getUserStateFromRequest( $option.'.filter_signup', 'filter_signup', '', 'int' );
		$limit 			= $mainframe->getUserStateFromRequest( $option.'.reg_full', 'reg_full', '', 'int' );
		$candidate 		= $mainframe->getUserStateFromRequest( $option.'.candidate', 'candidate', '', 'int' );
		$glist 			= $mainframe->getUserStateFromRequest( $option.'.glist', 'glist', '', 'int' );
		$area 			= $mainframe->getUserStateFromRequest( $option.'.area', 'area', '', 'int' );

		if( $glist == 0 && $area == 0 ){
			$orderby 	= ' ORDER BY reg_sn ASC ';
		}
		
		if($filter > 0){
			if($filter_signup == '1'){
				$orderby 	.= " LIMIT 0, $limit ";
			}else if($filter_signup == '2'){
				$orderby 	.= " LIMIT $limit, $candidate ";
			}else if($filter_signup == '3'){
				$candidate2 = $limit + $candidate;
				$orderby 	.= " LIMIT $candidate2,18446744073709551615 ";
			}
		}
		
		return $orderby;
	}

	/**
	 * connected 的過濾功能
	 */
	function _buildContentWhere()
	{
		global $mainframe, $option;

		$filter_signup 	= $mainframe->getUserStateFromRequest( $option.'.filter_signup', 'filter_signup', '', 'int' );
		$filter 		= $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', '', 'int' );//filter 活動
		$reg_class 		= $mainframe->getUserStateFromRequest( $option.'.reg_class', 'reg_class', '', 'int' );
		$glist 			= $mainframe->getUserStateFromRequest( $option.'.glist', 'glist', '', 'int' );//glist 分類
		$area 			= $mainframe->getUserStateFromRequest( $option.'.area', 'area', '', 'int' );//area 地區

		$where = array();

		if($glist != 0){
			$db = JFactory::getDBO();
			$class_data = "SELECT id ".
				"FROM #__eventlist_events ".
				"WHERE catsid = $glist";	
				
			if($area !=0){
				$class_data = $class_data." AND reg_area = $area";
			}
				
			$db->setQuery($class_data);
			$class_data = $db->loadObjectList();
			$class_rid = array();

			foreach($class_data as $class){
				$class_rid[] = $class->id;
			}
			
			$class_sem = ( count( $class_rid ) ? ' ' . implode( ' , ', $class_rid ) : '' );
			$where[] = " reg_id IN (".$class_sem.") ";
		}

		if($area != 0 ){
			$db = JFactory::getDBO();
			
			if($glist != 0){
				$glist_num = " AND catsid=".$glist;
			}
			$area_data = "SELECT id ".   //$class data
						"FROM #__eventlist_events ".
						"WHERE reg_area = $area".$glist_num;	
			 
			$db->setQuery($area_data);     //$class data
			$area_data = $db->loadObjectList();   //class tata
			
			$area_id = array();  //class rid

			foreach($area_data as $r_area){
				$area_id[] = $r_area->id;
			}
			
			$area_value = ( count( $area_id ) ? ' ' . implode( ' , ', $area_id ) : '' );
			$where[] = " reg_id IN (".$area_value.") ";
		}

		if($filter != 0){
			unset($where);
			$where[] = " reg_id = '".$filter."' ";
		}
		
		//報名情況篩選
		if($filter_signup == '1' || $filter_signup == '2' || $filter_signup == '3'){
			$where[] = " ch_join = 'y' ";
		}else if($filter_signup =='5'){
			unset($where);
			$where[] = " reg_id = '".$filter."' ";
			$where[] = " ch_join = 'n' ";
		}else if($filter_signup =='6'){
			unset($where);
			$where[] = " reg_id = '".$filter."' ";
			$where[] = " ch_join = 'y' ";
			$where[] = " reg_audit = 2 ";
		}else if($filter_signup =='7'){
			unset($where);
			$where[] = " reg_id = '".$filter."' ";
			$where[] = " ch_join = 'y' ";
			$where[] = " reg_audit = 3 ";
		}

		$where	= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

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
	 * 黑名單功能
	 */
	function black_user($cid = array())
	{
		$result = false;
		
		for($i=0;$i<count($cid);$i++){
		
			$del_id = explode( '&', $cid[$i] );
			$today = date('y-m-d');

			$query = 'UPDATE #__eventlist_reg_user'
					.' SET black = "y"'
					.' , u_date = \''.$today.'\''
					.' WHERE reg_id = '.$del_id[0]
					.' AND reg_sn = "'.$del_id[1].'"'
					.' AND u_email = "'.$del_id[2].'"'
					;
					
			$this->_db->setQuery( $query );
		
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
			
		return true;
	}
	
	/**
	 取消報名功能
	 由controllers/reguser.php使用
	 * 以下為函式流程
	 * 1.取消使用者狀態
	 * 2.取消vip code使用狀態
	 */
	function cancel_join($cid = array())
	{
		$result = false;
		
		for($i=0;$i<count($cid);$i++){
		
			$del_id = explode( '&', $cid[$i] );
			$user	=& JFactory::getUser();
			
			$where[] = " id =  $del_id[0] ";
			$vip = ELOutput::search_data( $where, 'events' );
			unset($where);
			
			$query = ' UPDATE #__eventlist_reg_user '
					.' SET ch_join = "n", '
					.' ch_mail = 0,'
					.' reg_audit = 0, '
					.' note = "admin [ '.$user->get('name').' ] Cancel" '
					.' WHERE reg_id = '.$del_id[0]
					.' AND reg_sn = "'.$del_id[1].'"'
					.' AND u_email = "'.$del_id[2].'"';
			$this->_db->setQuery( $query );

			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			$vip_array = array(4,5,8,9);
			
			if(in_array($vip->registra,$vip_array)){
				$query = " UPDATE #__eventlist_vip "
						." SET vip_name = NULL, "
						." vip_mail = NULL, "
						." use_code = NULL, "
						." code_state = 'n', "
						." note = NULL "
						." WHERE reg_id = $del_id[0] "
						." AND use_code = '$del_id[2]'";
						;

				$this->_db->setQuery( $query );
				
				if(!$this->_db->query()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}
		
		return true;
	}

	/*
	 顯示all future
	 由view/reguser/tmpl/default.php使用
	 */
	function all_futrue($mail){
		
		$today=date("Y-m-d");
		$db = JFactory::getDBO();
		
        $SQL_CHNO_ALL="SELECT s.title ,s.dates 
                      FROM 
                      #__eventlist_reg_user as u, 
                      #__eventlist_events as s 
                      WHERE u.reg_id=s.id and u.u_email='".$mail."'";
        $db->setQuery($SQL_CHNO_ALL);
        $db->Query();
        $all = $db->getNumRows();

        $SQL_CHNO="SELECT s.title, s.dates 
                   FROM 
                   #__eventlist_reg_user as u, 
                   #__eventlist_events as s 
                   WHERE u.reg_id=s.id and s.dates >='".$today."' and u.u_email='".$mail."'";
         $db->setQuery($SQL_CHNO);
         $db->Query();
         $future =  $db->getNumRows();
		
		return "($all)-($future)";
		
	}
	
	/*
	審核通過
	由controllers/reguser.php使用
	 */ 
	function audit_approved($id,$sn,$mail)
	{
			$img    = 'tick.png';
			$task   = 'publish';
			$alt    = JText::_( 'Published' );
			$action = JText::_( 'Publish item' );
	 
			$href = '
			<a href="javascript:void(0);" onclick="if(window.confirm(\'approve this user?\')){audit_approved('."$id,$sn,'$mail'".');}">
			'.JText::_( 'APPROVE' ).'</a>'
			//<img src="images/'. $img .'" border="0" alt="'. $alt .'" />
			;
	 
			return $href;
	}

	/*
	審核未通過
	由controllers/reguser.php使用
	 */
	function audit_rejected($id,$sn,$mail)
	{
			$img    = 'publish_x.png';
			$task   = 'unpublish';
			$alt    = JText::_( 'Unpublished' );
			$action = JText::_( 'Unpublish Item' );
	 
			$href = '
			<a href="javascript:void(0);" onclick="	if(window.confirm(\'reject this user?\')){audit_rejected('."$id,$sn,'$mail'".');}">
			'.JText::_( 'REJECT' ).'</a>'
			//<img src="images/'. $img .'" border="0" alt="'. $alt .'" />
			;
	 
			return $href;
	}

}//Class end
?>

