<?php
/**
* Mosets Tree toolbar html
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class menumtree {

	/***
	 * Link
	 */
	function EDITLINK_MENU() {
		global $task, $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( ($task=='newlink') ? $_MT_LANG->ADD_LISTING : $_MT_LANG->EDIT_LISTING), 'addedit.png' );
		}
		mosMenuBar::startTable();
		if($task == 'editlink_for_approval') {
			mosMenuBar::save( 'savelink', $_MT_LANG->SAVE_CHANGES );
		} else {
			mosMenuBar::save( 'savelink' );
			mosMenuBar::apply( 'applylink' );
		}
		mosMenuBar::cancel( 'cancellink' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function MOVELINKS_MENU() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::save( 'links_move2' );
		//mosMenuBar::custom( 'links_move2', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::custom( 'cancellinks_move', 'cancel.png', 'cancel_f2.png', $_MT_LANG->CANCEL, false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function COPYLINKS_MENU() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::save( 'links_copy2' );
		//mosMenuBar::custom( 'links_copy2', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::custom( 'cancellinks_copy', 'cancel.png', 'cancel_f2.png', $_MT_LANG->CANCEL, false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	/***
	 * Category
	 */
	function EDITCAT_MENU() {
		global $task, $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( ($task=='newcat') ? $_MT_LANG->ADD_CATEGORY : $_MT_LANG->EDIT_CATEGORY), 'categories.png' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save( 'savecat' );
		mosMenuBar::apply( 'applycat' );
		mosMenuBar::cancel( 'cancelcat' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function MOVECATS_MENU() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::save( 'cats_move2' );
		//mosMenuBar::custom( 'cats_move2', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::custom( 'cancelcats_move', 'cancel.png', 'cancel_f2.png', $_MT_LANG->CANCEL, false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function COPYCATS_MENU() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::save( 'cats_copy2' );
		//mosMenuBar::custom( 'cats_copy2', 'save.png', 'save_f2.png', 'Save', false );
		mosMenuBar::custom( 'cancelcats_copy', 'cancel.png', 'cancel_f2.png', $_MT_LANG->CANCEL, false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function REMOVECATS_MENU() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'removecats2', 'delete.png', 'delete_f2.png', $_MT_LANG->DELETE, false );
		mosMenuBar::custom( 'cancelcat', 'cancel.png', 'cancel_f2.png', $_MT_LANG->CANCEL, false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function LISTCATS_MENU() {
		global $_MT_LANG;
		if (!defined('JVERSION')) {
			?>
	    	<script language="JavaScript" type="text/JavaScript">
			<!--
			function MM_swapImgRestore() { //v3.0
				var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
			}
			//-->
			</script>
			 <table cellpadding="0" cellspacing="3" border="0" width="715">
				<tr>

			<?php
			mosMenuBar::custom( 'removecats', 'delete.png', 'delete_f2.png', $_MT_LANG->DELETE_CATEGORIES, true );
			mosMenuBar::custom( 'cats_copy', 'copy.png', 'copy_f2.png', '&nbsp;'.$_MT_LANG->COPY_CATEGORIES, true );
			mosMenuBar::custom( 'cats_move', 'move.png', 'move_f2.png', $_MT_LANG->MOVE_CATEGORIES, true );
			mosMenuBar::divider();
			# Delete Links
			?>
			<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->DELETE_LISTINGS_MSG ?>');}else{submitbutton('removelinks')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('removelinks','','images/delete_f2.png',1);"><img name="removelinks" src="images/delete_f2.png" alt="<?php echo $_MT_LANG->DELETE_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->DELETE_LISTINGS ?></a></td>
			<?php
			# Copy Listings
			?>
			<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->COPY_LISTINGS_MSG ?>');}else{submitbutton('links_copy')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_copy','','images/copy_f2.png',1);"><img name="links_copy" src="images/copy_f2.png" alt="<?php echo $_MT_LANG->COPY_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->COPY_LISTINGS ?></a></td>
			<?php
			# Move Listings
			?>
			<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->MOVE_LISTINGS_MSG ?>');}else{submitbutton('links_move')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_move','','images/move_f2.png',1);"><img name="links_move" src="images/move_f2.png" alt="<?php echo $_MT_LANG->MOVE_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->MOVE_LISTINGS ?></a></td>
			<?php
			mosMenuBar::endTable();
		} else {
			JToolBarHelper::title(  JText::_( 'Mosets Tree' ), 'addedit.png' );
			JToolBarHelper::deleteList('','removecats');
			JToolBarHelper::customX( 'cats_copy', 'copy.png', 'copy_f2.png', JText::_( 'Copy Categories' ) );
			JToolBarHelper::customX( 'cats_move', 'move.png', 'move_f2.png', JText::_( 'Move Categories' ) );
			JToolBarHelper::divider();
			$bar = & JToolBar::getInstance('toolbar');
			$bar->appendButton( 'Custom', '<a href="#" onclick="javascript:if(document.adminForm.link_boxchecked.value==0){alert(\'' . JText::_( 'Please make a selection from the list to delete listing(s)' ) . '\');}else{  submitbutton(\'removelinks\')}" class="toolbar"><span class="icon-32-delete" title="Delete Listings"></span>' . JText::_( 'Delete Listings' ) . '</a>', 'delete-links' );
			$bar->appendButton( 'Custom', '<a href="#" onclick="javascript:if(document.adminForm.link_boxchecked.value==0){alert(\'' . JText::_( 'Please make a selection from the list to copy listing(s)' ) . '\');}else{  submitbutton(\'links_copy\')}" class="toolbar"><span class="icon-32-copy" title="' . JText::_( 'Copy Listings' ) . '"></span>' . JText::_( 'Copy Listings' ) . '</a>', 'copy-links' );
			$bar->appendButton( 'Custom', '<a href="#" onclick="javascript:if(document.adminForm.link_boxchecked.value==0){alert(\'' . JText::_( 'Please make a selection from the list to move listing(s)' ) . '\');}else{  submitbutton(\'links_move\')}" class="toolbar"><span class="icon-32-move" title="' . JText::_( 'Move Listings' ) . '"></span>' . JText::_( 'Move Listings' ) . '</a>', 'move-links' );
		}
	}

	/***
	 * Approval
	 */
	function LISTPENDING_LINKS_MENU() {
		global $_MT_LANG;
		if (!defined('JVERSION')) {
			mosMenuBar::startTable();
			# Approve & Publish Listing
			?>
			<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->APPROVE_AND_PUBLISH_LISTING_MSG ?>');}else{submitbutton('approve_publish_links')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('approve_publish_links','','images/publish_f2.png',1);"><img name="approve_publish_links" src="images/publish.png" alt="<?php echo $_MT_LANG->APPROVE_AND_PUBLISH_LISTING ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->APPROVE_AND_PUBLISH_LISTING ?></a></td>
			<?php
			mosMenuBar::divider();
			# Delete Listing
			?>
			<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->DELETE_LISTINGS_MSG ?>');}else{submitbutton('removelinks')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('removelinks','','images/delete_f2.png',1);"><img name="removelinks" src="images/delete.png" alt="<?php echo $_MT_LANG->DELETE_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->DELETE_LISTINGS ?></a></td>
			<?php
			mosMenuBar::endTable();
		} else {
			JToolBarHelper::title(  JText::_( $_MT_LANG->PENDING_LISTING ), 'addedit.png' );
			$bar = & JToolBar::getInstance('toolbar');
			$bar->appendButton( 'Custom', '<a href="#" onclick="javascript:if(document.adminForm.link_boxchecked.value==0){alert(\'' . JText::_( $_MT_LANG->APPROVE_AND_PUBLISH_LISTING_MSG ) . '\');}else{  submitbutton(\'approve_publish_links\')}" class="toolbar"><span class="icon-32-publish" title="<?php echo $_MT_LANG->APPROVE_AND_PUBLISH_LISTING ?>"></span>' . JText::_( $_MT_LANG->APPROVE_AND_PUBLISH_LISTING ) . '</a>', 'approve-links' );
			$bar->appendButton( 'Custom', '<a href="#" onclick="javascript:if(document.adminForm.link_boxchecked.value==0){alert(\'' . JText::_( $_MT_LANG->DELETE_LISTINGS_MSG ) . '\');}else{  submitbutton(\'removelinks\')}" class="toolbar"><span class="icon-32-delete" title="<?php echo $_MT_LANG->DELETE_LISTINGS ?>"></span>' . JText::_( $_MT_LANG->DELETE_LISTINGS ) . '</a>', 'delete-links' );
		}
	}

	function LISTPENDING_CATS_MENU() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->PENDING_CATEGORIES ), 'categories.png' );
		}
		mosMenuBar::startTable();
		mosMenuBar::custom( 'approve_publish_cats', 'publish.png', 'publish_f2.png',$_MT_LANG->APPROVE_AND_PUBLISH, true );
		mosMenuBar::custom( 'approve_cats', 'publish.png', 'publish_f2.png', $_MT_LANG->APPROVE_CATEGORIES, true );
		mosMenuBar::divider();
		mosMenuBar::deleteList('', 'removecats');
		mosMenuBar::endTable();
	}

	function LISTPENDING_REVIEWS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_pending_reviews' );
		mosMenuBar::endTable();
	}

	function LISTPENDING_REPORTS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_reports' );
		mosMenuBar::endTable();
	}

	function LISTPENDING_REVIEWSREPORTS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_reviewsreports' );
		mosMenuBar::endTable();
	}

	function LISTPENDING_REVIEWSREPLY_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_reviewsreply' );
		mosMenuBar::endTable();
	}

	function LISTPENDING_CLAIMS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_claims' );
		mosMenuBar::endTable();
	}

	/***
	 * Reviews
	 */
	function LISTREVIEWS_MENU() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'newreview', 'new.png', 'new_f2.png', $_MT_LANG->NEW, false );
		mosMenuBar::editList( 'editreview' );
		mosMenuBar::deleteList( '', 'removereviews' );
		mosMenuBar::divider();
		mosMenuBar::custom( 'backreview', 'back.png', 'back_f2.png', $_MT_LANG->BACK, false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function EDITREVIEW_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'savereview' );
		mosMenuBar::cancel( 'cancelreview' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	/***
	*	Search Results
	*/
	function SEARCH_LISTINGS() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		# Delete Listing
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->DELETE_LISTINGS_MSG ?>');}else{submitbutton('removelinks')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('removelinks','','images/delete_f2.png',1);"><img name="removelinks" src="images/delete.png" alt="<?php echo $_MT_LANG->DELETE_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->DELETE_LISTINGS ?></a></td>
		<?php
		# Copy Listings
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->COPY_LISTINGS_MSG ?>');}else{submitbutton('links_copy')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_copy','','images/copy_f2.png',1);"><img name="links_copy" src="images/copy.png" alt="<?php echo $_MT_LANG->COPY_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->COPY_LISTINGS ?></a></td>
		<?php
		# Move Listing
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('<?php echo $_MT_LANG->MOVE_LISTINGS_MSG ?>');}else{submitbutton('links_move')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_move','','images/move_f2.png',1);"><img name="links_move" src="images/move.png" alt="<?php echo $_MT_LANG->MOVE_LISTINGS ?>" border="0" align="middle" />&nbsp;<?php echo $_MT_LANG->MOVE_LISTINGS ?></a></td>
		<?php
		mosMenuBar::endTable();
	}

	function SEARCH_CATEGORIES() {
		global $_MT_LANG;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'editcat', 'edit.png', 'edit_f2.png', $_MT_LANG->EDIT_CATEGORY, true );
		mosMenuBar::custom( 'removecats', 'delete.png', 'delete_f2.png', $_MT_LANG->DELETE_CATEGORIES, true );
		mosMenuBar::custom( 'cats_move', 'move.png', 'move_f2.png', $_MT_LANG->MOVE_CATEGORIES, true );
		mosMenuBar::endTable();
	}

	/***
	* Languages
	*/
	function LANGUAGES() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->LANGUAGES ), 'langmanager.png' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_language' );
		mosMenuBar::cancel( 'cancel_language' );
		mosMenuBar::endTable();
	}

	/***
	* Tree Templates
	*/
	function TREE_TEMPLATES() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->TREE_TEMPLATES ), 'thememanager' );
		}
		mosMenuBar::startTable();
		mosMenuBar::addNew('new_template');
		mosMenuBar::makeDefault('default_template');
		mosMenuBar::editList( 'template_pages' );
		mosMenuBar::deleteList( '','delete_template' );
		mosMenuBar::endTable();
	}
	
	function TREE_TEMPLATEPAGES() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->TREE_TEMPLATES ), 'thememanager' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_templateparams' );
		mosMenuBar::apply( 'apply_templateparams' );
		mosMenuBar::editList( 'edit_templatepage' );
		mosMenuBar::cancel( 'cancel_templatepages' );
		mosMenuBar::endTable();
	}

	function TREE_EDITTEMPLATEPAGE() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->TEMPLATE_PAGE_EDITOR ), 'thememanager' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_templatepage' );
		mosMenuBar::cancel( 'cancel_edittemplatepage' );
		mosMenuBar::endTable();
	}
	
	function TREE_NEWTEMPLATE() {
		mosMenuBar::startTable();
		mosMenuBar::cancel( 'cancel_templatepages' );
		mosMenuBar::endTable();
	}

	/***
	* Configuration
	*/
	function CONFIG_MENU() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->CONFIGURATION ), 'config.png' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save('saveconfig');
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	
	/***
	* Custom Fields
	*/
	function CUSTOM_FIELDS() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->CUSTOM_FIELDS ), 'module' );
		}
		mosMenuBar::startTable();
		mosMenuBar::publishList('cf_publish');
		mosMenuBar::unpublishList('cf_unpublish');
		mosMenuBar::divider();
		mosMenuBar::custom( 'newcf', 'new.png', 'new_f2.png', $_MT_LANG->NEW, false );
		mosMenuBar::deleteList( '', 'removecf' );
		mosMenuBar::endTable();
	}
	
	function EDIT_CUSTOM_FIELDS() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->CUSTOM_FIELD ), 'module' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save( 'savecf' );
		mosMenuBar::apply( 'applycf' );
		mosMenuBar::cancel( 'cancelcf' );
		mosMenuBar::endTable();
	}
	
	function EDIT_FIELD_TYPE() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->FIELD_TYPE ), 'install.png' );
		}
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveft' );
		mosMenuBar::apply( 'applyft' );
		mosMenuBar::cancel( 'cancelft' );
		mosMenuBar::endTable();
	}
	
	function MANAGE_FIELD_TYPES() {
		global $_MT_LANG;
		if (defined('JVERSION')) {
			JToolBarHelper::title(  JText::_( $_MT_LANG->INSTALLED_FIELD_TYPES ), 'install.png' );
		}
		mosMenuBar::startTable();
		mosMenuBar::custom( 'newft', 'new.png', 'new_f2.png', $_MT_LANG->ADD, false );
		mosMenuBar::editList( 'editft' );
		mosMenuBar::deleteList( '', 'removeft', $_MT_LANG->UNINSTALL );
		mosMenuBar::endTable();
	}

	/***
	* Link Checker
	*/
	function LINKCHECKER_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save('linkchecker');
		mosMenuBar::endTable();
	}
	
	/***
	* Spy
	*/
	function SPY_VIEWUSER_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::deleteList();
		mosMenuBar::endTable();
	}
}
?>