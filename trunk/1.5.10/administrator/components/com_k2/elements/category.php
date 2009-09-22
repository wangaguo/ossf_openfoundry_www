<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

class JElementCategory extends JElement
{

	var	$_name = 'category';
	
	function fetchElement($name, $value, &$node, $control_name)
	{

		$db = &JFactory::getDBO();
		$query = 'SELECT m.* FROM #__k2_categories m WHERE published = 1 ORDER BY parent, ordering';
		$db->setQuery( $query );
		$mitems = $db->loadObjectList();
		$children = array();

		if ( $mitems )
		{
			foreach ( $mitems as $v )
			{
				$pt 	= $v->parent;
				$list 	= @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}

		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
		$mitems = array();
		
		if($name=='categories'){
			$doc = & JFactory::getDocument();
			$js = "
			function setTask() {
				var counter=0;
				$$('#paramscategories option').each(function(el) {
					if (el.selected){
						value=el.value;
						counter++;
					}
				});
				if (counter>1){
					$('urlparamsid').setProperty('value','');
					$('urlparamstask').setProperty('value','');
				}
				if (counter==1){
					$('urlparamsid').setProperty('value',value);
					$('urlparamstask').setProperty('value','category');
				}
			}
			";
			
			$doc->addScriptDeclaration($js);
		}

		
		foreach ( $list as $item ) {
			@$mitems[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename.$item->title );
		}

		return JHTML::_('select.genericlist',  $mitems, ''.$control_name.'['.$name.'][]', 'onchange="setTask();" class="inputbox" multiple="multiple" size="15"', 'value', 'text', $value );

	}

}