<?php
/**
 * @version		$Id: view.html.php 10094 2008-03-02 04:35:10Z instance $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * HTML Article View class for the Content component
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class ContentsubmitViewArticle extends JView
{

	function display($tpl=null)
	{
		global $mainframe;

		// Initialize variables
		$document	=& JFactory::getDocument();
		$user		=& JFactory::getUser();
		$uri     	 =& JFactory::getURI();

		// Make sure you are logged in and have the necessary access rights
		if ($user->get('gid') < 19) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		// Initialize variables
		$article	=& $this->get('Article');
		$params		=& $article->parameters;
		$isNew		= ($article->id < 1);

		// At some point in the future this will come from a request object
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');

		// Add the Calendar includes to the document <head> section
		JHTML::_('behavior.calendar');

		if ($isNew)
		{
			// TODO: Do we allow non-sectioned articles from the frontend??
			$article->sectionid = JRequest::getVar('sectionid', 0, '', 'int');
			$db = JFactory::getDBO();
			$db->setQuery('SELECT title FROM #__sections WHERE id = '.(int) $article->sectionid);
			$article->section = $db->loadResult();
		}

		// Get the lists
		$lists = $this->_buildEditLists();

		// Load the JEditor object
		$editor =& JFactory::getEditor();

		// Build the page title string
		$title = $article->id ? JText::_('Edit') : JText::_('New');

		// Set page title
		$document->setTitle($title);

		// get pathway
		$pathway =& $mainframe->getPathWay();
		$pathway->addItem($title, '');
		
		// Unify the introtext and fulltext fields and separated the fields by the {readmore} tag
		// if (JString::strlen($article->fulltext) > 1) {
			// $article->text = $article->introtext."<hr id=\"system-readmore\" />".$article->fulltext;
		// } else {
			// $article->text = $article->introtext;
		// }

		// Ensure the row data is safe html
		// JFilterOutput::objectHTMLSafe( $article);

		$this->assign('action', 	$uri->toString());

		$this->assignRef('article',	$article);
		$this->assignRef('params',	$params);
		$this->assignRef('lists',	$lists);
		$this->assignRef('editor',	$editor);
		$this->assignRef('user',	$user);


		parent::display($tpl);
	}

	function _buildEditLists()
	{
		// Get the article and database connector from the model
		$article = & $this->get('Article');
		$db 	 = & JFactory::getDBO();

		// $javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";
		$javascript = "";
			
		// layout
		$layout	=& $this->get('Layout');
		$id	=& $this->get('Id');
		switch ($layout) {
			case "bysection":
				// ********************************
				// send over a fixed sectionid
				// ********************************
				$query = "SELECT s.id, s.title " .
						 " FROM #__sections AS s " .
						 " WHERE s.id = '".$id."'";
				$db->setQuery($query);
				$section = $db->loadObject();

				$sections[] = JHTML::_('select.option', $id, $section->title, 'id', 'title');
				$lists['sectionid'] = JHTML::_('select.genericlist',  $sections, 'sectionid', 'class="inputbox" size="1" '.$javascript, 'id', 'title', intval($id));

				// ********************************
				// send over the section's categories
				// ********************************
				$section_list[] = (int) $section->id;	
				$contentSection = $section->title;
		
				$query = " SELECT id, title, section " .
						 " FROM #__categories " .
						 " WHERE `section` = '".$section->id."' ".
						 " ORDER BY `title` ASC ";
				$db->setQuery($query);
				$cat_list = $db->loadObjectList();
		
				// Uncategorized category mapped to uncategorized section
				$uncat = new stdClass();
				$uncat->id = 0;
				$uncat->title = JText::_('Uncategorized');
				$uncat->section = 0;
				$cat_list[] = $uncat;
				$categories = array();
				$categories[] = JHTML::_('select.option', '-1', JText::_( 'Select Category' ), 'id', 'title');				

				foreach ($cat_list as $cat)
				{
					$categories[] = JHTML::_('select.option', $cat->id, $cat->title, 'id', 'title');
				}
		
				$lists['catid'] = JHTML::_('select.genericlist',  $categories, 'catid', 'class="inputbox" size="1"', 'id', 'title', 0);
				
			  break;
			case "bycategory":
				$query = "SELECT s.id AS sectionid, s.title AS sectiontitle, c.id, c.title " .
						 " FROM #__categories AS c " .
						 " LEFT JOIN #__sections as s on c.section = s.id " .
						 " WHERE c.id = '".$id."'";
				$db->setQuery($query);
				$data = $db->loadObject();

				// ********************************
				// send over a fixed sectionid
				// ********************************
				$sections[] = JHTML::_('select.option', $data->sectionid, $data->sectiontitle, 'id', 'title');
				$lists['sectionid'] = JHTML::_('select.genericlist',  $sections, 'sectionid', 'class="inputbox" size="1" '.$javascript, 'id', 'title', intval($data->sectionid));
				
				// ********************************								
				// send over a fixed categoryid
				// ********************************
				$categories[] = JHTML::_('select.option', $data->id, $data->title, 'id', 'title');
				$lists['catid'] = JHTML::_('select.genericlist',  $categories, 'catid', 'class="inputbox" size="1" '.$javascript, 'id', 'title', intval($data->id));

			  break;
		}

		// Select List: Category Ordering
		$query = 'SELECT ordering AS value, title AS text FROM #__content WHERE catid = '.(int) $article->catid.' ORDER BY ordering';
		$lists['ordering'] = JHTML::_('list.specificordering', $article, $article->id, $query, 1);

		// Radio Buttons: Should the article be published
		$lists['state'] = JHTML::_('select.booleanlist', 'state', '', $article->state);

		// Radio Buttons: Should the article be added to the frontpage
		if($article->id) {
			$query = 'SELECT content_id FROM #__content_frontpage WHERE content_id = '. (int) $article->id;
			$db->setQuery($query);
			$article->frontpage = $db->loadResult();
		} else {
			$article->frontpage = 0;
		}

		$lists['frontpage'] = JHTML::_('select.booleanlist', 'frontpage', '', (boolean) $article->frontpage);

		// Select List: Group Access
		$lists['access'] = JHTML::_('list.accesslevel', $article);

		return $lists;
	}

	function _displayPagebreak($tpl)
	{
		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('PGB ARTICLE PAGEBRK'));

		parent::display($tpl);
	}
}
?>
