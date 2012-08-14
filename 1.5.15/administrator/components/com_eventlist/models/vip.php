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
 * EventList Component vip Model
 *
 * @package Joomla
 * @subpackage EventList
 * @since		0.9
 */
class EventListModelvip extends JModel
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
		*查詢的資料庫加上where和order
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();

		$query = 'SELECT * '.
			 'FROM #__eventlist_vip '
			 .$where
			 ;

		return $query;
	}

	/**
	 * connected 的過濾功能
	 */
	function _buildContentWhere()
	{
		global $mainframe, $option;

		$filter = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter',  $mainframe->getCfg('filter'), 'int' );
		$where = array();
		$where[] = " reg_id = '".$filter."' ";
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
	 刪除vipcode功能
	 由controllers/vip.php 呼叫
	 */
	function delete_code($cid = array())
	{
		$result = false;
		
		for($i=0;$i<count($cid);$i++){
		
			$del_id = explode( '&', $cid[$i] );
				
			$query = 'DELETE FROM #__eventlist_vip '
					.' WHERE reg_id = '.$del_id[0]
					.' AND vip_code = "'.$del_id[1].'"'
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
	 寄vip信給user
	 生產出vip code後寄給user
	 由controllers/vip.php 呼叫
	 * 
	 * 以下為函式流程
	 * 1.取得資料
	 * 2.編輯主旨
	 * 3.取得聯絡人資料
	 * 4.寄出
	*/
	function mailtouser($event,$u_email,$u_name,$vip_code)
	{
		$elsettings = ELAdmin::config();
	
		$event		= $event;	//event id
		$u_email	= $u_email;	//user mail
		$u_name		= $u_name;	//user name
		$db = JFactory::getDBO();	
		
		$mail_value = ELOutput::mail_replace($event, $elsettings->touser_vipmail, $u_email);
		$mail_value = ereg_replace("{user}", $u_email, $mail_value);//更換收件人
		$mail_value = ereg_replace("{VIP_CODE}", $vip_code, $mail_value);//vip_code
		
		//信件主旨
		$mailtitle = ELOutput::mailT_replace($event, $elsettings->touser_vipmail, $u_email);

		//聯絡人資料
		$event_data =	"SELECT * ". 
						"FROM #__eventlist_events ".
						"WHERE id = $event";
		$db->setQuery($event_data);
	    $event_data = $db->loadObject();	

		$user =& JFactory::getUser($event_data->contact);
		$admin_name = $user->name;
		$admin_mail = $user->email;
			
		if($admin_name[0]=='-'){
			$admin_name = ereg_replace('-',' ', $admin_name);
			$admin_name = trim($admin_name);
		}

		$mail_value = ereg_replace("{EVENT_ADMIN}", $admin_name, $mail_value);//更換信件中event聯絡人
		$mail_value = ereg_replace("{ADMIN_EMAIL}", $admin_mail, $mail_value);//更換信件中聯絡人信箱
		
		$subject = "=?UTF-8?b?".base64_encode($mailtitle)."?=";
		$header_name = "=?UTF-8?B?".base64_encode($admin_name)."?=";
		$header = "From:".$header_name." <".$admin_mail.">\r\n"; 
		$header.= "Reply-To: ".$admin_mail."\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type:text/html;charset=\"utf-8\"\r\n";   
		$header.= "Content-Transfer-Encoding:8bit\n\r";

		mail($u_email, $subject, $mail_value,$header);
		return $event.$mailtitle.$mail_value;
	}

}//Class end
?>
