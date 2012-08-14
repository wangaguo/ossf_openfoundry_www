<?php
/**
 * @version 1.0 $Id: events.php 958 2009-02-02 17:23:05Z julienv $
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

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
jimport( 'joomla.database.database.mysql' );
/**
 * EventList Component blacklist Controller
 *
 * @package Joomla
 * @subpackage EventList
 * @since 0.9
 */
class EventListControllerBlacklist extends EventListController
{
	/*
	將使用者移除黑名單
	由view/Blacklist/view.html.php使用
	 */
 	function remove()
	{
		$cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$total = count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('blacklist');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}
		$cids=implode(',',$cid);
		$user_info=explode('&',$cids);
		$msg = JText::_( 'DELETE BLACKED');

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();
		
		$this->setRedirect( 'index.php?option=com_eventlist&view=blacklist', $msg );
	}
}
?>
