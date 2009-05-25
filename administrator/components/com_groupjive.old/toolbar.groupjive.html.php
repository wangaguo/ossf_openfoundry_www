<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class menuGroupJive{
	function OPTIONS_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save('saveoptions');
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	function CATEGORY_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::addNew('newcategory');
		mosMenuBar::editList('editcategory', 'Edit');
		mosMenuBar::deleteList( ' ', 'delcategory', 'Remove' );		
		mosMenuBar::divider();		
		mosMenuBar::publish('publishcat');
		mosMenuBar::unpublish('unpublishcat');
		mosMenuBar::endTable();
	}

	function GROUP_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::addNew('newgroup');
		mosMenuBar::editList('editgroup', 'Edit');
		mosMenuBar::deleteList( ' ', 'delgroup', 'Remove' );		
		mosMenuBar::divider();		
		mosMenuBar::publish('publishgroup');
		mosMenuBar::unpublish('unpublishgroup');
		mosMenuBar::endTable();
	}

	function MEMBER_ADD_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::editList('saveaddmembers', 'Add members now');
		mosMenuBar::spacer();
		mosMenuBar::back();	
		mosMenuBar::endTable();
	}

	function MEMBER_DELETE_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::deleteList('   ->  This step will remove the member(s) from the selected Group(s).','savedeletemembers', 'Remove members now');
		mosMenuBar::spacer();
		mosMenuBar::back();	
		mosMenuBar::endTable();
	}

	function MEMBER_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::addNew('invitemembers','Invite members');
		mosMenuBar::spacer();
		mosMenuBar::editList('addmembers', 'Add members');
		mosMenuBar::spacer();
		mosMenuBar::deleteList('   ->  Click OK to select the Group(s) from which you will remove the member(s).', 'deletemembers', 'Remove members' );		
		mosMenuBar::spacer();		
		mosMenuBar::back();	
		mosMenuBar::endTable();
	}

	function EDITCATEGORY_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save('savecategory');
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	function EDITGROUP_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save('savegroup');
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}
}
?>
