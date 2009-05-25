<?php
  /**
   * Largest Groupjive Groups Module
   * @package Mambo Open Source
   * @Copyright (C) 2006 Anna Tannenberg (Fluffy5)
   * @ All rights reserved
   * @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
   * @version: 1.0 
   **/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (file_exists('components/com_groupjive/language/'.$mosConfig_lang.'.php'))
{
  include_once('components/com_groupjive/language/'.$mosConfig_lang.'.php');
} else {
  include_once('components/com_groupjive/language/english.php');
}

$database->setQuery("SELECT nophoto_logo, hideprivat FROM #__gj_options");
$options = $database->loadObjectlist();
if (!$result=$database->getErrorNum()) {
	echo $database->stderr();
	return;
}

define('DEFAULT_LOGO', $options[0]->nophoto_logo);
$hideprivate = $options[0]->hideprivate;

global $mosConfig_offset,$my;
/**
 * Configuration of the module
 * All these can be set through the Module "Parameter" in the administration
 */
$count = $params->get( 'count', 5 );
$display_type = $params->get( 'display_type', 1 );
$display_number = $params->get( 'display_number', 1 );
$display_pic = $params->get( 'display_pic', 1 );
$type = array();
$type[1] = $params->get( 'display_open', 1 );
$type[2] = $params->get( 'display_aprequired', 1 );
$type[3] = $params->get( 'display_private', 1 );

$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

$a = array();
for ($i=0;$i<count($type);$i++){
	if ($type[$i] == 1) {
		$a[] = $i;
	}
}

$t = implode(',', $a);
if ($t) {
	$tw = " AND a.type IN ($t) ";
}

$query = "SELECT a.*, COUNT(b.id_user) AS number, e.id_user"
	. "\nFROM #__gj_groups as a INNER JOIN #__gj_users as b"
	. "\nON b.id_group = a.id"
	. "\nINNER JOIN #__gj_grcategory AS c"
	. "\nON a.category = c.id"
	. "\nLEFT JOIN #__gj_users AS e"
	. "\nON a.id = e.id_group AND e.id_user = ".$my->id
	. "\nWHERE c.access <= ".$my->gid." AND b.status = 'active'".$tw
	. "\nGROUP BY b.id_group"
	. "\nORDER BY number DESC LIMIT $count";
$database->setQuery( $query );


$rows = $database->loadObjectList();
//sql error handling
if ($database->getErrorNum ()) {
	echo $database->stderr();
	return  false;
} 
$total = count($rows);

// cycle through the returned rows displaying them in a table

$return = '<table cellpadding="0" cellspacing="0" border="0"><tr><td width="50%" valign="top" class="moduletable'.$moduleclass_sfx.'">';
if($total > 0) {
	$return .= '<ul>';
	foreach ($rows as $row) {
		if($row->id_user = $my->id) {
			$member = 1;
		} else {
			$member = 0;
		}

		if (!($hideprivate && $tmplrow['type'] == GJ_PRIVATE && $member)) {
			$return .= '<li>';
			if ($display_pic == 1) {
				if((!empty($row->logo)) && ($row->logo != '') && (file_exists("images/com_groupjive/".$row->logo))) {
					$return .= '<img src="images/com_groupjive/tn'.$row->logo.'" alt="'.$row->name.' logo" /><br />';
				} else {
					if (file_exists("images/com_groupjive/tn".DEFAULT_LOGO)) {
						$return .= '<img src="images/com_groupjive/tn'.DEFAULT_LOGO.'" alt="default logo" /><br />';
					} else {
						$return .= '<img src="images/com_groupjive/groupjive_mini.png" alt="default logo" /><br />';
					}
				}
			}
			if($row->type != 3 || $member > 0) {
				$return .= "<a href=".sefRelToAbs("index.php?option=com_groupjive&task=showgroup&groupid=$row->id").">".$row->name."</a>"; 
			} else {
				$return .= $row->name;
			}
	
			if($display_type == 1) { 
				$return .= '&nbsp;';
				if($row->type==1)
					$return .= '<i>('.GJ_OPEN.')</i>';
				elseif($row->type==2)
					$return .= '<i>('.GJ_APREQUIRED.')</i>';
				elseif($row->type==3)
					$return .= '<i>('.GJ_PRIVATE.')</i>';
			}
	
			$return .= '<br />';
			if($display_number == 1) { 
				if($row->number > 1)
					$return .= $row->number ."&nbsp;".GJ_MODULE_MEMBERS;
				else
					$return .= $row->number ."&nbsp;".GJ_MODULE_MEMBER; 
			}
	
			$return .= '</li>';
			}
		}
	$return .= '</ul>';
} else {
	$return .= GJ_MODULE_NO_GROUPS; 
}
$return .= '</td></tr></table>';
echo $return;
?>
	     

