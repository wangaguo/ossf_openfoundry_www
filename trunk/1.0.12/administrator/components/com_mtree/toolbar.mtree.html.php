<?php
/**
* Mosets Tree toolbar html
*
* @package Mosets Tree 1.5
* @copyright (C) 2005 Mosets Consulting
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
		mosMenuBar::startTable();
		mosMenuBar::save( 'savelink' );
		mosMenuBar::apply( 'applylink' );
		mosMenuBar::cancel( 'cancellink' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function MOVELINKS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'links_move2', 'save.png', 'save_f2.png', 'Move Listing here', false );
		mosMenuBar::custom( 'cancellinks_move', 'cancel.png', 'cancel_f2.png', 'Cancel', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function COPYLINKS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'links_copy2', 'save.png', 'save_f2.png', 'Copy Listing here', false );
		mosMenuBar::custom( 'cancellinks_copy', 'cancel.png', 'cancel_f2.png', 'Cancel', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	/***
	 * Category
	 */
	function EDITCAT_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'savecat' );
		mosMenuBar::apply( 'applycat' );
		mosMenuBar::cancel( 'cancelcat' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function MOVECATS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'cats_move2', 'save.png', 'save_f2.png', 'Place Category here', false );
		mosMenuBar::custom( 'cancelcats_move', 'cancel.png', 'cancel_f2.png', 'Cancel', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function COPYCATS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'cats_copy2', 'save.png', 'save_f2.png', 'Copy to this Category', false );
		mosMenuBar::custom( 'cancelcats_copy', 'cancel.png', 'cancel_f2.png', 'Cancel', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function REMOVECATS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'removecats2', 'delete.png', 'delete_f2.png', 'Delete', false );
		mosMenuBar::custom( 'cancelcat', 'cancel.png', 'cancel_f2.png', 'Cancel', false );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function LISTCATS_MENU() {
		//mosMenuBar::startTable();
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
		//mosMenuBar::custom( 'newcat', 'new.png', 'new_f2.png', 'Add Category', false );
		//mosMenuBar::custom( 'editcat', 'edit.png', 'edit_f2.png', 'Edit Category', true );
		mosMenuBar::custom( 'removecats', 'delete.png', 'delete_f2.png', 'Delete Categories', true );
		mosMenuBar::custom( 'cats_copy', 'copy.png', 'copy_f2.png', '&nbsp;Copy Category', true );
		mosMenuBar::custom( 'cats_move', 'move.png', 'move_f2.png', 'Move Category', true );
		
		mosMenuBar::divider();
		//mosMenuBar::custom( 'newlink', 'new.png', 'new_f2.png', 'Add Listing', false );
		# Delete Links
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to Delete Listing');}else{submitbutton('removelinks')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('removelinks','','images/delete_f2.png',1);"><img name="removelinks" src="images/delete.png" alt="Delete Listing" border="0" align="middle" />&nbsp;Delete Listing</a></td>
		<?php
		# Copy Listings
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to Copy Listing');}else{submitbutton('links_copy')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_copy','','images/copy_f2.png',1);"><img name="links_copy" src="images/copy.png" alt="Copy Listing" border="0" align="middle" />&nbsp;Copy Listing</a></td>
		<?php		# Move Listings
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to Move Listing');}else{submitbutton('links_move')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_move','','images/move_f2.png',1);"><img name="links_move" src="images/move.png" alt="Move Listing" border="0" align="middle" />&nbsp;Move Listing</a></td>
		<?php
		mosMenuBar::endTable();
	}

	/***
	 * Approval
	 */
	function LISTPENDING_LINKS_MENU() {
		mosMenuBar::startTable();
		
		# Approve & Publish Listing
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to approve & publish listing');}else{submitbutton('approve_publish_links')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('approve_publish_links','','images/publish_f2.png',1);"><img name="approve_publish_links" src="images/publish.png" alt="Approve & Publish Listing" border="0" align="middle" />&nbsp;Approve & Publish Listing</a></td>
		<?php

		# Approve Listing
		/*
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to approve listing');}else{submitbutton('approve_links')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('approve_links','','images/publish_f2.png',1);"><img name="approve_links" src="images/publish.png" alt="Approve Listing" border="0" align="middle" />&nbsp;Approve Listing</a></td>
		<?php
		*/
		mosMenuBar::divider();
		# Delete Listing
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to Delete Listing');}else{submitbutton('removelinks')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('removelinks','','images/delete_f2.png',1);"><img name="removelinks" src="images/delete.png" alt="Delete Listing" border="0" align="middle" />&nbsp;Delete Listing</a></td>
		<?php
//		mosMenuBar::deleteList('removelinks');
		mosMenuBar::endTable();
	}

	function LISTPENDING_CATS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'approve_publish_cats', 'publish.png', 'publish_f2.png', 'Approve & Publish', true );
		mosMenuBar::custom( 'approve_cats', 'publish.png', 'publish_f2.png', 'Approve Category', true );
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

	function LISTPENDING_CLAIMS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_claims' );
		mosMenuBar::endTable();
	}

	/***
	 * Reviews
	 */
	function LISTREVIEWS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'newreview', 'new.png', 'new_f2.png', 'Add Review', false );
		mosMenuBar::editList( 'editreview' );
		mosMenuBar::deleteList( '', 'removereviews' );
		mosMenuBar::divider();
		mosMenuBar::custom( 'backreview', 'back.png', 'back_f2.png', 'Back', false );
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
		mosMenuBar::startTable();
		# Delete Listing
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to Delete Listing');}else{submitbutton('removelinks')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('removelinks','','images/delete_f2.png',1);"><img name="removelinks" src="images/delete.png" alt="Delete Listing" border="0" align="middle" />&nbsp;Delete Listing</a></td>
		<?php
		# Move Listing
		?>
		<td><a class="toolbar" href="javascript:if (document.adminForm.link_boxchecked.value == 0){ alert('Please make a selection from the list to Move Listing');}else{submitbutton('links_move')}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('links_move','','images/move_f2.png',1);"><img name="links_move" src="images/move.png" alt="Move Listing" border="0" align="middle" />&nbsp;Move Listing</a></td>
		<?php
		mosMenuBar::endTable();
	}

	function SEARCH_CATEGORIES() {
		mosMenuBar::startTable();
		mosMenuBar::custom( 'editcat', 'edit.png', 'edit_f2.png', 'Edit Category', true );
		mosMenuBar::custom( 'removecats', 'delete.png', 'delete_f2.png', 'Delete Categories', true );
		mosMenuBar::custom( 'cats_move', 'move.png', 'move_f2.png', 'Move Category', true );
		mosMenuBar::endTable();
	}

	/***
	* Languages
	*/
	function LANGUAGES() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_language' );
		mosMenuBar::cancel( 'cancel_language' );
		mosMenuBar::endTable();
	}

	/***
	* Tree Templates
	*/
	function TREE_TEMPLATES() {
		mosMenuBar::startTable();
		mosMenuBar::endTable();
	}

	function TREE_EDITTEMPLATEPAGE() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_templatepage' );
		mosMenuBar::cancel( 'cancel_template' );
		mosMenuBar::endTable();
	}

	/***
	* Configuration
	*/
	function CONFIG_MENU() {
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
		mosMenuBar::startTable();
		mosMenuBar::save('save_customfields');
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

}
?>