<?php
function com_install() {
global $database;
?>

<div style="text-align:left;width:60%;">
  <div style="background-color:#fbfbfb;border:1px solid #EFEFEF;margin-bottom:5px;padding-right: 5px;">
    <h3>GroupJive Information</h3>
	<p><em><strong>GroupJive</strong></em> is a social networking component that creates Groups for the Joomla CMS! GroupJive requires the presence of Community Builder or Community Builder Enhanced user management components in your Joomla! installation.</p>
	<p><em><strong>GroupJive</strong></em> provides all registered Joomla! users the ability to create groups, join together with other users and generate content that is unique to their Group(s). GroupJive supports a group bulletin with WYSIWYG options, compatibility with almost all Joomla! PMS systems, a Plugin for Community Builder, a series of Modules that enhance the GroupJive user experience and integration with other Joomla! components including EventList, FireBoard, JomComment and more...</p>
	<p>Groups are based on three privilege levels which determine a users ability to access and join groups:</p>
	<ul>
	  <li><strong>Open to all</strong> - <em>(open to all registered users)</em></li>
	  <li><strong>Approval to join</strong> - <em>(requires Moderator to approve membership)</em></li>
	  <li><strong>Invite to join</strong> - <em>(membership is by invitation only)</em></li>
	</ul>
	<p><em><strong>REQUIREMENT:</strong></em> GroupJive requires the presence of Community Builder or Community
Builder Enhanced user management components. To use GroupJive, Community Builder
-OR- Community Builder Enhanced must be installed!</p>
	<p>Please review the <a href="components/com_groupjive/readme.txt" target="_blank"><big>readme.txt</big></a> in your installation package. It contains detailed information on GroupJive setup as well as integration instructions for components we support. Visit us at <a href="http://groupjive.org" target="_blank">http://www.groupjive.org</a> for more information. <strong>Thank you!</strong></p>
  </div>
  
  <div style="background-color:#fbfbfb;border:1px solid #EFEFEF;margin-bottom:5px;padding-right: 5px;">
    <h3>Installation Process</h3>
	<table><tr><th>Current step</th><th>Message</th></tr>
		<?php
		checkField('#__gj_options', 'bul_creator', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");					
		checkField('#__gj_options', 'real_names', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");					
		checkField('#__gj_options', 'nonreg', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");
		checkField('#__gj_options', 'bulletin', "ENUM( '0', '1' ) NOT NULL DEFAULT '1'");
		checkField('#__gj_options', 'jomcomment', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");
		checkField('#__gj_options', 'wysiwyg', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");
		checkField('#__gj_options', 'wysiwyg_width', "int(5) NOT NULL default '400'");
		checkField('#__gj_options', 'wysiwyg_height', "int(5) NOT NULL default '200'");
		checkField('#__gj_options', 'wysiwyg_rows', "int(5) NOT NULL default '80'");
		checkField('#__gj_options', 'wysiwyg_cols', "int(5) NOT NULL default '15'");
		checkField('#__gj_options', 'ajax_active', "enum('0','1') NOT NULL default '0'");
		checkField('#__gj_options', 'ajax_access', "tinyint(3) NOT NULL DEFAULT '0'");
		checkField('#__gj_options', 'ajax_message', "varchar(25) NOT NULL default 'load data'");
		checkField('#__gj_options', 'template', "varchar(25) NOT NULL default 'default'");
		checkField('#__gj_options', 'hideprivate', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");
		checkField('#__gj_options', 'jb_count', "int(5) NOT NULL default '5'");
                checkField('#__gj_options', 'el_count', "int(5) NOT NULL default '5'");
                checkField('#__gj_options', 'force_invite', "ENUM( '0', '1' ) NOT NULL DEFAULT '0'");
		checkField('#__gj_grcategory', 'cat_image', "varchar(255) default NULL");
		checkField('#__gj_grcategory', 'access', "tinyint(3) NOT NULL DEFAULT '0'");
		checkField('#__gj_grcategory', 'ordering', "tinyint(4) default NULL");
		checkField('#__gj_grcategory', 'descr', "text NOT NULL default ''");
		checkField('#__gj_groups', 'params', "text NOT NULL default ''");

		/**
		 * check if value 'jim' exists in field pms in table gj_options
		 */
		showAction('check if value `jim` exists for `pms`');
		if (!checkIfValueExists('#__gj_options', 'pms', 'jim', 1)){
			showResult('value `jim` does not exist', true);
			showAction('try to add value `jim` to field `pms`');
			$sql = "ALTER TABLE `#__gj_options` MODIFY `pms` "
				. "ENUM('email','uddeim','mypms','pmsenh','jim','missus','clexus') "
				. "NOT NULL DEFAULT 'email'";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while alter table #__gj_options', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			showResult ('added value `jim` to field `pms` in table #__gj_options', true);
		} else {
			showResult('value `jim` already exist', true);
		}

		/**
		 * check if value 'missus' exists in field pms in table gj_options
		 */
		showAction('check if value `missus` exists for `pms`');
		if (!checkIfValueExists('#__gj_options', 'pms', 'missus', 1)){
			showResult('value `missus` does not exist', true);
			showAction('try to add value `missus` to field `pms`');
			$sql = "ALTER TABLE `#__gj_options` MODIFY `pms` "
				. "ENUM('email','uddeim','mypms','pmsenh','jim','missus','clexus') "
				. "NOT NULL DEFAULT 'email'";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while alter table #__gj_options', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			showResult ('added value `missus` to field `pms` in table #__gj_options', true);
		} else {
			showResult('value `missus` already exist', true);
		}

		/**
		 * check if value 'clexus' exists in field pms in table gj_options
		 */
		showAction('check if value `clexus` exists for `pms`');
		if (!checkIfValueExists('#__gj_options', 'pms', 'clexus', 1)){
			showResult('value `clexus` does not exist', true);
			showAction('try to add value `clexus` to field `pms`');
			$sql = "ALTER TABLE `#__gj_options` MODIFY `pms` "
				. "ENUM('email','uddeim','mypms','pmsenh','jim','missus','clexus') "
				. "NOT NULL DEFAULT 'email'";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while alter table #__gj_options', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			showResult ('added value `clexus` to field `pms` in table #__gj_options', true);
		} else {
			showResult('value `clexus` already exist', true);
		}

		/**
		 * check if gj_options is filled;
		 */
		showAction ('check if default values exists');
		$sql = 'SELECT id FROM #__gj_options'; 
		$database->SetQuery($sql);

		if(!$result=$database->query()) {
			showResult ('Error while selecting the default values into table #__gj_options', false);
			echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
			return;
		}

		$value_exists = $database-> getNumRows() == 1;

		if (!$value_exists) {
			$sql = "INSERT INTO `#__gj_options` (id, onpage, onpage_members, blogm, nophoto,nophoto_logo, approval, pms, notify, notifyjoin, version, admin_email, send_admin_emails, create_groups, logosize, date_form, jb, jb_cat, eventlist, bulletin, jomcomment, wysiwyg, nonreg, real_names, bul_creator, hideprivate)VALUES (1, 20, 5, 3, 'components/"
				. "com_comprofiler/images/english/tnnophoto.jpg', "
				. "'groupjive_mini.png', '0', 'email', '0', '0', "
				. "'1', 'Webmaster@MyDomain.com', '1', '1', '128', "
				. "'%Y-%m-%d %H:%i:%s', "
				. "'0', '0', '0', '1', '0', '0', '0', '0', '0', '0') ;";

			$database->SetQuery($sql);

			if(!$result=$database->query()) {
				showResult ( 'Error while inserting the default values into table #__gj_options', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			showResult('added default values into table #__gj_options', true);

		} else {
			showResult('Default Values found', true);
		}

		/**
		 * check if gj_users needs an update 
		 * enum(0,1) to enum('active','inactive',...)
		 */
		showAction('check if usertable still uses new enum set');
		if (!checkIfValueExists('#__gj_users', 'status', 'active', 1)){
			showResult('table uses old values', true);
			showAction('try to alter table to use new values');

			// rename old field
			
			// add new field
			// move values from old field to new field
			// remove old field

			// 1. create a new table with the new structure
			$sql = "ALTER TABLE `#__gj_users`"
				. "\nADD `status_tmp` enum('active','inactive','invited','need approval','undefined') NOT NULL default 'undefined'";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while alter table #__gj_users - add field status_tmp', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			// 2. move all the data from the old table to the new one
			// (change status from 0/1 to the specific value)
			$sql = "UPDATE #__gj_users"
				. "\nSET status_tmp ="
				. "\nCASE `status`"
				. "\nWHEN '0' THEN 'active'"
				. "\nWHEN '1' THEN 'inactive'"
				. "\nELSE 'inactive'"
				. "\nEND;";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while updating data in table #__gj_users', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			
			// 3. delete the old table
			$sql = "ALTER TABLE `#__gj_users`"
				. "\nDROP `status`;";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while alter table #__gj_users - dropping old field status', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}
			// 4. rename the new table 
			$sql = "ALTER TABLE `#__gj_users`"
				. "\nCHANGE `status_tmp` `status`"
				. "\nENUM( 'active', 'inactive', 'invited',"
				. "\n'need approval', 'undefined' )"
				. "\nNOT NULL DEFAULT 'undefined';";
			$database->SetQuery($sql);
	
			if(!$result=$database->query()) {
				showResult ('Error while alter table #__gj_users rename status_tmp to status', false);
				echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
				return;
			}

			showResult ('successful altere table #__gj_users', true);
		} else {
			showResult('table still uses new enum set', true);
		}


		// check user fields
		$sql = "SELECT a.id"
			."\nFROM `#__gj_users` a"
			."\nINNER JOIN #__gj_users b ON a.id_user = b.id_user"
			."\nAND a.id_group = b.id_group"
			."\nWHERE a.id > b.id";
		$database->setQuery($sql);
		$result = implode(',', $database->loadResultArray());

		if ($result){
			$sql = "DELETE FROM #__gj_users WHERE id IN ($result)";
			$database->setQuery($sql);
			$database->query();
		}

		/**
		 * check if Index exists
		 */
		showAction ('Check if "unique_key" exists');
		if (indexExists('unique_key', '_gj_users')) {
			showResult ('Index "unique_key" exists', true);
		} else {
			showResult ('TODO check this --- Index "unique_key" not found', false);
			showAction ('Try to create index "unique_key"');
			$sql = "ALTER TABLE `#__gj_users` ADD UNIQUE `unique_key` ( `id_user` , `id_group` )";
			$database->SetQuery($sql);

			if(!$result=$database->query()) {
				showResult ('TODO check this --- Error while alter table #__gj_users', false);
			} else {
				showResult ('added index "unique_key" to table #__gj_users', true);
			}
		}
		
		/**
		 * check if CB is installed
		 */
		showAction ('check if Community Builder Component is installed'); 
		$sql = "SELECT * FROM #__components WHERE name = 'Community Builder'";
		$database->setQuery($sql);
		$count = count($database->loadResult());
		if ($count > 0) {
			showResult ('Community Builder is installed', true);
		} else {
			showResult ('TODO check this --- Please install the Community Builder component, GroupJive will not function without it', false);
		}

		handleImages();?>
	</table>
	<p style="font-size:16px; color:#FF0099">Installation done!</p>
	<p style="color: #FF9900"><em>If no error occurs, Groupjive should be installed correctly.</em></p>
  </div>
  <div style="background-color:#fbfbfb;border:1px solid #EFEFEF;margin-bottom:5px;padding-right: 5px;">
    <h3>Support</h3>
	<p>For information and support please visit</p>
	<big><a href="http://www.groupjive.org" target="_blank">www.groupjive.org</a></big>
	<p>If you have problems with Groupjive, the support forums at GroupJive are the best place to find help, knowledge articles and experienced users with the community.</p>
	<p>You can help improve GroupJive by submitting your bug reports and feature requests to our joomlacode.org development site at:</p>
	<big><a href="http://joomlacode.org/gf/project/groupjive" target="_blank">ProjectGroupJive</a></big>
	<p>Please <a href="http://www.groupjive.org/index.php?option=com_comprofiler&task=registers" target="_blank">register</a> to stay informed.</p>
  </div>
  <div style="background-color:#fbfbfb;border:1px solid #EFEFEF;margin-bottom:5px;padding-right: 5px;">
    <?php showLicense(); ?>
  </div>
  <div style="background-color:#fbfbfb;border:1px solid #EFEFEF;margin-bottom:5px;padding-right: 5px;">
    <h2 style="color:#009900"><em>Thank you for using Groupjive.</em></h2>
  </div>
  </div>
  <?php
}

function checkIfTableExists($tablename) {
	global $database;

	$sql = "SHOW TABLE STATUS LIKE '$tablename'";
	$database->SetQuery($sql);

	if(!$result=$database->query()) {
		echo '<p>'.$database->stderr().'</p>'; // this is not w3c valid
		return;
	}

	$table_exists = $database-> getNumRows() == 1;

	return $table_exists;
}

function getTableFields($tablename, $fieldname){
	global $database;

	$sql = "SHOW COLUMNS FROM $tablename LIKE '$fieldname'";
	$database->SetQuery($sql);

	if(!$result=$database->query()) {
		echo '<p>'.$database->stderr().'</p>'; // this is not w3c valid
		return;
	}

	$fields = $database->loadObjectList();; 
	//print_r($fields); 
	return $fields;
}

function checkIfValueExists ($tablename, $fieldToCheck, $value, $enum = 0) {
	$fields = getTableFields($tablename, $fieldToCheck);
	if($enum == 1) {
		$types = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$fields[0]->Type));
		foreach ($types as $type) {
			if ($type == $value) {
				return true;
				break;
			}
		}
	}
}

function checkIfFieldExists($tablename, $fieldToCheck, $enum = 0) {
	$fields = getTableFields($tablename, $fieldToCheck);
	foreach ($fields as $field) {
		if ($field->Field == $fieldToCheck) {
			return true;
			break;
		}	
	} 
	return false;
}

function handleImages() {
	global $mainframe;
	$mosConfig_absolute_path = $mainframe->getCfg('absolute_path');
	// template used from cb install file - regards to the cb team 
	showAction('check if imagepath is writable');
	if(is_writable($mosConfig_absolute_path . "/images/")) {
		showResult('imagepath is writable', true);
		$galleryFiles = array("groupjive_mini.png","index.html");

		showAction('check if folder /images/com_groupjive exists');
		if(!file_exists($mosConfig_absolute_path . "/images/com_groupjive/")){
			showResult('/images/com_groupjive does not exist', true);
			showAction('try to create /images/com_groupjive');
			if(mkdir($mosConfig_absolute_path . "/images/com_groupjive/")) {
				showResult($mosConfig_absolute_path . "/images/com_groupjive/ "
					. "Successfully added!", true);
			} else {
				showResult($mosConfig_absolute_path . "/images/com_groupjive/ "
					. "Failed to be to be created, please do so manually!", false);
			}
		} else {
			showResult($mosConfig_absolute_path . "/images/com_groupjive/ "
				. "already exists!", true);
		}
		
		showAction('check if folder /images/com_groupjive is writable');
		if(!is_writable($mosConfig_absolute_path . "/images/com_groupjive/")){
			showResult('folder /images/com_groupjive is not writable', true);
			showAction('try to chmod folder /images/com_groupjive to 777');
			if(!chmod($mosConfig_absolute_path . "/images/com_groupjive/", 0777)) {
				showResult($mosConfig_absolute_path . "/images/com_groupjive/ "
					. "Failed to be chmod'd to 777 please do so manually!", false);
			} else {
				showResult('folder /images/com_groupjive successfully chmodded to 777', true);
			}
		} else {
			showResult('folder /images/com_groupjive is writable', true);
		}

		foreach($galleryFiles AS $galleryFile) {
			showAction('try to copy file '.$galleryFile);
			if(copy($mosConfig_absolute_path . "/components/com_groupjive/images/"
				. $galleryFile,$mosConfig_absolute_path 
				. "/images/com_groupjive/".$galleryFile)) {
				showResult($galleryFile." successfully added to the image folder!", true);
			} else {
				showResult($galleryFile." failed to be added to the image folder please do so manually!", false);
			}
		}
	} else {
		showResult($mosConfig_absolute_path . "/images/ is not writable!<br />"
			. "Manually do the following:<br /> 1.) create "
			. $mosConfig_absolute_path . "/images/com_groupjive/ directory <br />"
			. "2.) chmod it to 777 <br /> "
			. "3.) copy ".$mosConfig_absolute_path . "/components/com_groupjive/images/ "
			. "and its contents to ".$mosConfig_absolute_path . "/images/com_groupjive/", false);
	}
	echo '</tr></table>';
}

function showAction($string){
	echo "<tr><td>$string</td>";
}
function showResult($string, $state){
	if ($state == false) {
		$font = 'red';
	} else {
		$font = 'green';	
	}
	echo "<td><font color=\"$font\">$string</td></tr>";
}

function indexExists($index, $table) {
	global $database, $mosConfig_db;
	// DOESNT WORK YET
	// get indexes
	$sql = "SELECT COUNT( * ) FROM INFORMATION_SCHEMA.`KEY_COLUMN_USAGE` "
		. "WHERE TABLE_SCHEMA = '$mosConfig_db' AND CONSTRAINT_NAME = '$index' AND TABLE_NAME LIKE '%$table'";
	//echo $sql;
	$database->setQuery($sql);
	$table_keys = $database->loadResult();

	if ($table_keys == 0) {
		$result = false;
	} else {
		$result = true;
	}
	// return result
	return $result;
}

function checkField($tablename, $fieldname, $fieldtype) {
	global $database;
	showAction('check if field `'.$fieldname.'` exists');
	if (!checkIfFieldExists($tablename, $fieldname)){
		showResult('field `'.$fieldname.'` does not exist', true);
		showAction('try to create field `'.$fieldname.'`');
		$sql = "ALTER TABLE `$tablename` ADD `$fieldname` $fieldtype ";
		$database->SetQuery($sql);

		if(!$result=$database->query()) {
			showResult ('Error while alter table '.$tablename, false);
			echo '<tr><td colspan="2">'.$database->stderr().'</td></tr></table>';
			return;
		}
		showResult ('added field `'.$fieldname.'` to table '.$tablename, true);
	} else {
		showResult('field `'.$fieldname.'` already exist', true);
	}
}

function showLicense() {
?>
<h3>License</h3>
<pre style="text-align:center;">This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
Link to the license: <a href="http://www.gnu.org/copyleft/gpl.html">http://www.gnu.org/copyleft/gpl.html</a></pre>
<?php
}
?>
