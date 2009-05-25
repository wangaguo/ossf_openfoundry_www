<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class groupJiveCategory extends mosDBTable {
	var $id = null;
	var $catname = null;
	var $published  = null;
	var $type = null;
	var $admin = null;
	var $create_open = null;
	var $create_closed = null;
	var $create_invite = null;
	var $cat_image = null;
	var $ordering = null;
	/** @var int */
	var $access = null;
	var $descr = null;

	function groupJiveCategory(&$db) {
		$this->mosDBTable('#__gj_grcategory', 'id', $db);
	}
}

class groupJiveGroup extends mosDBTable {
	var $id = null;
	var $name = null;
	var $descr  = null;
	var $date_s = null;
	var $type = null;
	var $creator = null;
	var $user_id = null;
	var $active = null;
	var $category = null;
	var $logo = null;


	function groupJiveGroup(&$db)	{
		$this->mosDBTable('#__gj_groups', 'id', $db);
	}

	function check() {
		if (is_object( $this )) {
			if ($this->category == '') {
				$this->_error = get_class( $this )."::check failed ".GJ_NO_CAT_SELECTED;
				return false;
			}
			if ($this->name == '') {
				$this->_error = get_class( $this )."::check failed ".GJ_NO_GROUPNAME;
				return false;
			}
			if (!$this->creator || $this->user_id == 0) {
				$this->_error = get_class( $this )."::check failed ".GJ_NO_ADMIN;
				return false;
			}
			return true;
		} else {
			return false;
		}
	}

	function getArray($group) {
		$sql = "SELECT *"
			. "\nFROM #__gj_groups a"
			. "\nINNER JOIN #__gj_grcategory b"
			. "\nON a.category = b.id"
			. "\nWHERE a.id = ".$group;
		$this->_db->setQuery($sql);
		$result = $this->_db->loadAssocList();
		if ($this->_db->getErrorNum()) {
			$this->_error = $this->_db->stderr();
			return false;
		}
		$this->asArray = $result;
	}

	function getUsersOfGroup() {
		$sql = "SELECT *"
			. "\nFROM #__gj_users"
			. "\nWHERE id_group = $this->id";
		$this->_db->setQuery($sql);
		$result = $this->_db->loadObjectList();
		if ($this->_db->getErrorNum()) {
			$this->_error = $this->_db->stderr();
			return false;
		}
		$this->users = $result;
		return true;
	}

	function deleteAll() {
		$this->_db->setQuery("DELETE FROM #__gj_bul WHERE group_id='$this->id'");
		if (!$result=$this->_db->query()) {
			$this->_error = $this->_db->stderr();
			return false;
		};

		$this->_db->setQuery("DELETE FROM #__gj_active WHERE groups='$this->id'");
		if (!$result=$this->_db->query()) {
			$this->_error = $this->_db->stderr();
			return false;
		};
	
		$this->_db->setQuery("DELETE FROM #__gj_users WHERE id_group='$this->id'");
		if (!$result=$this->_db->query()) {
			$this->_error = $this->_db->stderr();
			return false;
		};
	
		$this->_db->setQuery("DELETE FROM #__gj_groups WHERE id='$this->id'");
		if (!$result=$this->_db->query()) {
			$this->_error = $this->_db->stderr();
			return false;
		};
	
		//If Joomlaboard or Fireboard is integrated, remove the group forum
		if(JB) {
			//First get the category id
			$this->_db->setQuery("SELECT category_id FROM #__gj_jb WHERE group_id='$this->id'");
			$cat_id=$this->_db->loadResult();
			if ($this->_db->getErrorNum()){
				$this->_error = $this->_db->stderr();
				return false;
			}
	
			$this->_db->setQuery("DELETE FROM #__gj_jb WHERE group_id='$this->id'");
			if (!$result=$this->_db->query()) {
				$this->_error = $this->_db->stderr();
				return false;
			}
	
			$this->_db->setQuery("DELETE FROM #__".PREFIX."_categories WHERE id='$cat_id'");
			if (!$result=$this->_db->query()) {
				$this->_error = $this->_db->stderr();
				return false;
			}
	
			$this->_db->setQuery("DELETE FROM #__".PREFIX."_moderation WHERE catid='$cat_id'");
			if (!$result=$this->_db->query()) {
				$this->_error = $this->_db->stderr();
				return false;
			}
		}
	
		if(EVENTLIST) {
			$this->_db->setQuery("DELETE FROM #__eventlist_categories WHERE catname='$this->name'");
			if (!$result=$this->_db->query()) {
				$this->_error = $this->_db->stderr();
				return false;
			}
			
			$this->_db->setQuery("DELETE FROM #__gj_eventlist WHERE group_id='$this->id'");
			if (!$result=$this->_db->query()) {
			  $this->_error = $this->_db->stderr();
			  return false;
			}
			
		}
		return true;
	}
}


class groupJiveUsers extends mosDBTable {
	var $id = null;
	var $id_user = null;
	var $username = null;
	var $id_group = null;
	var $date = null;
	var $status = null;

	function groupJiveUsers($db) {
		$this->mosDBTable('#__gj_users', 'id', $db);
	}

	function getUserObject ($uid, $group) {
		$sql = "SELECT id"
			. "\nFROM #__gj_users"
			. "\nWHERE id_user = $uid"
			. "\nAND id_group = $group";

		$this->_db->setQuery($sql);
		$id = $this->_db->loadResult();
		if ($this->_db->getErrorNum()) {
			$this->_error = $this->_db->stderr();
			return false;
		}
		$idObj = $this->load($id);
		return $idObj; 
	}

	function getGroupsOfUser($uid) {
		$sql = "SELECT *"
			. "\nFROM #__gj_users"
			. "\nWHERE id_user = $uid";
		$this->_db->setQuery($sql);
		$result = $this->_db->loadAssocList;
		if ($this->_db->getErrorNum()) {
			$this->_error = $this->_db->stderr();
			return false;
		}
		return $result;
	}

	function changeUserState($state='undefined'){
		if ($this->status != $state) {
			$this->status = $state;
			return $this->store();
		} else {
			$this->_error = GJ_ERROR_STATUS_ALREADY_SET;
			return false;
		}
	}
}

class groupJiveOptions extends mosDBTable {
	var $id = null;
	var $onpage = null;
	var $onpage_members = null;
	var $bul_creator = null;
	var $blogm = null;
	var $nophoto  = null;
	var $nophoto_logo  = null;
	var $approval  = null;
	var $admin_email  = null;
	var $create_open = null;
	var $send_admin_emails  = null;
	var $real_names = null;
	var $create_groups  = null;
	var $notify = null;
	var $notifyjoin = null;
	var $nonreg = null;
	var $version = null;
	var $logosize = null;
	var $pms = null;
	var $date_form = null;
	var $jb = null;
	var $jb_cat = null;
	var $eventlist = null;
	var $bulletin = null;
	var $jomcomment = null;
	var $wysiwyg = null;
	var $wysiwyg_width = null;
	var $wysiwyg_height = null;
	var $wysiwyg_rows = null;
	var $wysiwyg_cols = null;
	var $ajax_active = null;
	var $ajax_access = null;
	var $ajax_message = null;
	var $template = null;
	var $hideprivate = null;
	var $jb_count = null;
	var $el_count = null;  
        var $force_invite = null;
        

	function groupJiveOptions(&$db) {
		$this->mosDBTable('#__gj_options', 'id', $db);
	}
	function getAll(){
	// needs some error handling
		$this->load(1);
		$params = array();
		foreach ($this as $key=>$value) {
                    $params[$key] = $value;
		}
		return $params;
	}
}

class groupJiveBulletin extends mosDBTable {
	var $id = null;
	var $group_id = null;
	var $author_name = null;
	var $author_id = null;
	var $post = null;
	var $subject = null;
	var $date_bul = null;

	function groupJiveBulletin($db) {
		$this->mosDBTable('#__gj_bul', 'id', $db);
	}
}
?>
