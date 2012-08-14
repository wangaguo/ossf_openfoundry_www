<?php
/**
 * @version 1.0 $Id: eventlist_events.php 958 2009-02-02 17:23:05Z julienv $
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

defined('_JEXEC') or die('Restricted access');

/**
 * EventList events Model class
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class eventlist_reguser extends JTable
{
	/**
	 * Primary Key
	 * @var int
	 */
		var $reg_id = nul;
		var $reg_sn	= null;
		var $u_name	= null;
		var $u_email = null;
		var $u_regday = null;
		var $u_sex = 'm';
		var $u_company = null;
		var $u_captaincy = null;
		var $u_tel = null;
		var $u_addr = null;
		var $u_eat = null;
		var $u_date = '0000-00-00';
		var $u_signup = null;
		var $ch_phone = null;
		var $ch_join = null;
		var $note = null;
		var $community = null;
		var $black = null;
		var $vip_code = null;
		var $uid = null;
		var $uregdate = null;
		var $uip = null;
		var $ch_mail = null;
		var $cancel_mail 	= null;
		var $notes 	= null;
		var $waiting = null;
		var $survey = null;
		var $survey_text 	= null;
	function eventlist_reguser(& $db) {
		parent::__construct('#__eventlist_reguser', 'reg_id', $db);
	}

	// overloaded check function
	function check($elsettings)
	{
		return true;
	}
}
?>
