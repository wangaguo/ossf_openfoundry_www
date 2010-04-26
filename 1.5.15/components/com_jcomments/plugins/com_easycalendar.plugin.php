<?php
/**
 * JComments plugin for EasyCalendar events support
 *
 * @version 2.0
 * @package JComments
 * @author Sergey M. Litvinov (smart@joomlatune.ru)
 * @copyright (C) 2006-2009 by Sergey M. Litvinov (http://www.joomlatune.ru)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 **/
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

class jc_com_easycalendar extends JCommentsPlugin
{
	function getTitles($ids)
	{
		$db = & JCommentsFactory::getDBO();
		$db->setQuery( 'SELECT id, name as title FROM #__easycalendar WHERE published = 1 AND IN (' . implode(',', $ids) . ')' );
		return $db->loadObjectList('id');
	}

	function getObjectTitle($id)
	{
		$db = & JCommentsFactory::getDBO();
		$db->setQuery( 'SELECT name FROM #__easycalendar WHERE published = 1 AND id = ' . $id );
		return $db->loadResult();
	}

	function getObjectLink($id)
	{
		$_Itemid = JCommentsPlugin::getItemid( 'com_easycalendar' );
		$link = sefRelToAbs( 'index.php?option=com_easycalendar&amp;task=view&amp;id=' . $id . '&amp;Itemid=' . $_Itemid );
		return $link;
	}
}
?>