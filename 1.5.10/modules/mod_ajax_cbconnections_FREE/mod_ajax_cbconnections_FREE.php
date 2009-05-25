<?php
//
// Copyright (C) 2006 Mike Feng Jinglong
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
if(defined( '_VALID_MOS' )) {
	require_once("configuration.php");
} else {
	require_once("../configuration.php");
	require("../administrator/components/com_comprofiler/ue_config.php");
}

$jos_ = $mosConfig_dbprefix;
$dbase = array("user"=>$mosConfig_user, "db"=>$mosConfig_db, "host"=>$mosConfig_host, "password"=>$mosConfig_password);
$mod_folder = $mosConfig_live_site.'/modules/mod_ajax_cbconnections_FREE';

## If form is posted
if ($_POST['acbc_task']) {
	$task = $_POST['acbc_task'];
	$args = array();
	# Get critical info
	$args['my_id']				= $_POST['my_id'];
	$args['img_path']			= $_POST['img_path'];
	$args['name_type']			= $_POST['name_type'];
	$args['avatar_dimension']	= $_POST['avatar_dimension'];
	$args['display_count']		= $_POST['display_count'];
	$args['num_column']			= $_POST['num_column'];
	$args['no_photo_img']		= $_POST['no_photo_img'];
	$args['left_limit']			= $_POST['left_limit'];
	$args['right_limit']		= $_POST['right_limit'];
	$args['cbItemid']			= $_POST['cbItemid'];
	
	switch ($task) {
		case 'processOutput_FREE':
			processOutput_FREE();
			break;
	}
}

function processOutput_FREE() {
	global $args, $ueConfig, $mosConfig_live_site, $_POST, $task, $mod_folder;

	$selected_conn_cat = $_POST['conn_cat'];
	$connections = getConnections_FREE();
	$response = "";
	$response .= "<br clear=\"all\"><br />Showing: ".$selected_conn_cat."...";
	$j=$k=0;
	for ($i=0; $i < sizeof($connections); $i++) {
		$conn_cat = explode("|*|",$connections[$i]->type);
		if ( in_array($selected_conn_cat, $conn_cat) || $selected_conn_cat=="All" || ($selected_conn_cat=="[undefined]" && $connections[$i]->type=="")) {
			if ($j % $args['num_column'] == 0 && $j < $args['display_count']) {
				$response .= '<br clear="all">';
			}
			$j++;
			if ($j > $args['left_limit'] && $j <= $args['right_limit']) {
				$response .= '<div class="conn_box">'."\n";
				$response .= '<div class="conn_photo">';
				$response .= '<a href="' . $mosConfig_live_site . '/index.php?option=com_comprofiler&task=userProfile&Itemid='.$args['cbItemid'].'&user=' . $connections[$i]->memberid . '">';
				$response .= '<img alt="'.$connections[$i]->displayname.'\'s Profile" title="'.$connections[$i]->displayname.'\'s Profile" src="';
				if ($connections[$i]->avatar && $connections[$i]->avatar!=NULL) {
					if (substr_count($connections[$i]->avatar, "/") == 0)
						$response .= $mosConfig_live_site.'/'.$args['img_path'].'/tn'.$connections[$i]->avatar;
					else
						$response .= $mosConfig_live_site.'/'.$args['img_path'].'/'.$connections[$i]->avatar;
				}
				else
					$response .= $mosConfig_live_site . '/' . $args['no_photo_img'];
				$response .= '" /></a></div>'."\n";
				$response .= '<div class="conn_name"><a title="'.$connections[$i]->displayname.'\'s Profile" href="' . $mosConfig_live_site . '/index.php?option=com_comprofiler&task=userProfile&Itemid='.$cbItemid.'&user=' . $connections[$i]->memberid . '">';
				$response .= $connections[$i]->displayname;
				$response .= '</a></div>';
				$response .= '</div>';
			}
		}
	}
	$response .= '<br clear="all"><br /><div class="small">';
	if ($j > 0)
		$response .= 'Showing '.($args['display_count']<$j?$args['display_count']:$j).' of '.$j;
	else
		$response .= 'You have no connections of type: '.$selected_conn_cat;
	$response .= '</div>';
	$response .= getHiddenInput_FREE($args);
	// output response
	echo $response;
}

function getHiddenInput_FREE($args) {
	$return = '';
	$return .= '<input type="hidden" name="my_id" id="my_id" value="'.$args['my_id'].'" />'."\n";
	$return .= '<input type="hidden" name="img_path" id="img_path" value="'.$args['img_path'].'" />'."\n";
	$return .= '<input type="hidden" name="name_type" id="name_type" value="'.$args['name_type'].'" />'."\n";
	$return .= '<input type="hidden" name="avatar_dimension" id="avatar_dimension" value="'.$args['avatar_dimension'].'" />'."\n";
	$return .= '<input type="hidden" name="display_count" id="display_count" value="'.$args['display_count'].'" />'."\n";
	$return .= '<input type="hidden" name="num_column" id="num_column" value="'.$args['num_column'].'" />'."\n";
	$return .= '<input type="hidden" name="no_photo_img" id="no_photo_img" value="'.$args['no_photo_img'].'" />'."\n";
	$return .= '<input type="hidden" name="left_limit" id="left_limit" value="'.$args['left_limit'].'" />'."\n";
	$return .= '<input type="hidden" name="right_limit" id="right_limit" value="'.$args['right_limit'].'" />'."\n";
	$return .= '<input type="hidden" name="cbItemid" id="cbItemid" value="'.$args['cbItemid'].'" />'."\n";
	$return .= '<input type="hidden" name="acbc_task" id="acbc_task" value="" />'."\n";
	return $return;
}

function getConnections_FREE($sql_extra="") {
	global $dbase, $jos_, $args;
	$conn = mysql_connect($dbase["host"], $dbase["user"], $dbase["password"]);
	mysql_select_db($dbase["db"], $conn);
	$connections = array();
	if ($args['name_type'] == 1) $s = "c.username";
	elseif ($args['name_type'] == 0) $s = "c.name";
	$sql = "SELECT a.*, b.avatar, ".$s." as displayname " .
				"FROM ".$jos_."comprofiler_members a " .
				"LEFT JOIN ".$jos_."comprofiler b ON a.memberid = b.user_id " .
				"LEFT JOIN ".$jos_."users c ON a.memberid = c.id " .
				"WHERE a.referenceid=".$args['my_id']." AND a.accepted=1 AND a.pending=0 " .
				$sql_extra;
	$results = mysql_query( $sql, $conn );

	while ($row = mysql_fetch_object( $results )) {
		if ($key) {
			$connections[$row->$key] = $row;
		} else {
			$connections[] = $row;
		}
	}
	mysql_free_result($results);
	mysql_close($conn);
	return $connections;
}

// no direct access
if(defined( '_VALID_MOS' )) {
	global $database, $my;
	## Load module parameters
	$name_type = $params->def('name_type',1);
	$img_path = $params->get('img_path');
	$avatar_dimension = $params->get('avatar_dimension');
	$display_count = $params->get('display_count');
	$num_column = $params->get('num_column');
	$no_photo_img = $params->get('no_photo_img');

	$mod_folder = $mosConfig_live_site.'/modules/mod_ajax_cbconnections_FREE';
	## Make sure Community Builder is installed
	if (file_exists($mosConfig_absolute_path.'/administrator/components/com_comprofiler/ue_config.php')) {
		require($mosConfig_absolute_path.'/administrator/components/com_comprofiler/ue_config.php');
	}
	else {
		echo '<div class="message">Community Builder not installed!</div>';
		return;
	}
	## Get CB Itemid
	$database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_comprofiler' AND published=1");
	$cbItemid = $database->loadResult();
	## Get connections information
	// username(1) or real name(0)?
	if ($name_type == 1) $s = "c.username";
	elseif ($name_type == 0) $s = "c.name";
	$database->setQuery( "SELECT a.*, b.avatar, ".$s." as displayname " .
					"FROM #__comprofiler_members a " .
					"LEFT JOIN #__comprofiler b ON a.memberid = b.user_id " .
					"LEFT JOIN #__users c ON a.memberid = c.id " .
					"WHERE a.referenceid=".$my->id." AND a.accepted=1 AND a.pending=0" );
	$connections = $database->loadObjectList();
?>
	<link rel="stylesheet" href="<?php echo $mod_folder ?>/mod_ajax_cbconnections_FREE.css" type="text/css"/>
	<script language="javascript" type="text/javascript" src="<?php echo $mod_folder ?>/mod_ajax_cbconnections_FREE.js"></script>
	<style type="text/css">
	<!--
	.conn_photo
	{ width: <?php echo $avatar_dimension ?>px; height: <?php echo $avatar_dimension ?>px; border: #aeaeae solid 1px;overflow: hidden; text-align:center; }
	.conn_photo img
	{ height: <?php echo $avatar_dimension ?>px !important; border: 0; margin: 0; padding: 0; }	-->
	.conn_box
	{ width: <?php echo ($avatar_dimension+2) ?>px; height: auto; margin: 10px 4px 0px 4px; display: block; float: left; }	</style>
	<form name="connectionsForm_FREE" id="connectionsForm_FREE" method="post">
	<?php
	$conn_cat = explode("\n",$ueConfig['connection_categories']);
	//echo 'Connection Type: <div style="float:left;"><select class="inputbox" name="conn_cat" id="conn_cat" onChange="document.connectionsForm_FREE.acbc_task.value=\'processOutput_FREE\'; acbc_submitForm_FREE();">'."\n";
	//echo '<option value="All">All</option>'."\n";
//	for ($i=0;$i<sizeof($conn_cat);$i++) {
//		echo '<option value="'.trim($conn_cat[$i]).'">'.trim($conn_cat[$i]).'</option>'."\n";
//	}
//	echo '<option value="[undefined]">[undefined]</option>'."\n";
//	echo '</select></div>';
//	echo '<div id="ajaxloading_FREE" style="float:left;padding-left:10px;padding-top:3px;">&nbsp;</div>';
	?>
	<div id="connections_output_FREE">
	<!--	<br clear="all"><br />Showing: All...-->
		<?php
		$i=$j=0;
		foreach ($connections as $connection) {
			if ($i % $num_column == 0) {
				echo '<br clear="all">';
			}
			$i++;
			if ($i > $display_count)
				break;
			echo '<div class="conn_box">'."\n";
			echo '<div class="conn_photo">';
			echo '<a href="' . $mosConfig_live_site . '/index.php?option=com_comprofiler&task=userProfile&Itemid='.$cbItemid.'&user=' . $connection->memberid . '">';
			echo '<img alt="'.$connection->displayname.'\'s Profile" title="'.$connection->displayname.'\'s Profile" src="';
			if ($connection->avatar && $connection->avatar!=NULL) {
				if (substr_count($connection->avatar, "/") == 0)
					echo $mosConfig_live_site.'/'.$img_path.'/tn'.$connection->avatar;
				else
					echo $mosConfig_live_site.'/'.$img_path.'/'.$connection->avatar;
			}
			else
				echo $mosConfig_live_site . '/' . $no_photo_img;
			echo '"></a></div>'."\n";
			//echo '<div class="conn_name"><a title="'.$connection->displayname.'\'s Profile" href="' . $mosConfig_live_site . '/index.php?option=com_comprofiler&task=userProfile&Itemid='.$cbItemid.'&user=' . $connection->memberid . '">';
			//echo $connection->displayname;
			//echo '</a></div>';//Modify by ally
			echo '</div>';
		}
		echo '<br clear="all"><br /><div class="small">';
		if (sizeof($connections) > 0)
			echo 'Showing '.($display_count<sizeof($connections)?$display_count:sizeof($connections)).' of '.sizeof($connections);
		else
			echo 'You have no connections in your friends list!';
		echo '</div>';
		echo '<input type="hidden" name="my_id" id="my_id" value="'.$my->id.'" />'."\n";
		echo '<input type="hidden" name="img_path" id="img_path" value="'.$img_path.'" />'."\n";
		echo '<input type="hidden" name="name_type" id="name_type" value="'.$name_type.'" />'."\n";
		echo '<input type="hidden" name="avatar_dimension" id="avatar_dimension" value="'.$avatar_dimension.'" />'."\n";
		echo '<input type="hidden" name="display_count" id="display_count" value="'.$display_count.'" />'."\n";
		echo '<input type="hidden" name="num_column" id="num_column" value="'.$num_column.'" />'."\n";
		echo '<input type="hidden" name="no_photo_img" id="no_photo_img" value="'.$no_photo_img.'" />'."\n";
		echo '<input type="hidden" name="left_limit" id="left_limit" value="0" />'."\n";
		echo '<input type="hidden" name="right_limit" id="right_limit" value="'.($display_count<sizeof($connections)?$display_count:sizeof($connections)).'" />'."\n";
		echo '<input type="hidden" name="cbItemid" id="cbItemid" value="'.$cbItemid.'" />'."\n";
		echo '<input type="hidden" name="acbc_task" id="acbc_task" value="" />'."\n";
		?>
	</div>
	<input type="hidden" name="mosConfig_live_site" id="mosConfig_live_site" value="<?php echo $mosConfig_live_site ?>" />
	</form>
<?php
}
?>
