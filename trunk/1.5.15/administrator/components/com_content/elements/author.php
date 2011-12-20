<?php
/**
* @version		$Id: author.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @subpackage	Articles
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * Renders a author element
 *
 * @package 	Joomla
 * @subpackage	Articles
 * @since		1.5
 */
class JElementAuthor extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Author';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = &JFactory::getDBO();
				//return JHTML::_('list.users', $control_name.'['.$name.']', $value);
				$isauthor = "SELECT id,name  FROM jos_users  where params like '%isauthor=1%'";
				$db->setQuery($isauthor);
				$options = $db->loadObjectList( );
				return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', '', 'id', 'name', $value, $name );

	}
}
