<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

if (!function_exists("mb_substr")) {
	function mb_substr($str, $start, $length=null, $encoding=null) {
		return substr($str, $start, $length);
	}
}


function categoryList($selected) {
	global $database;
       if ($selected == "") $selected = "0";
   	$query = "SELECT c.id AS `value`, c.section AS `id`, CONCAT_WS( ' / ', s.title, c.title) AS `text`"
	. "\n FROM #__sections AS s"
	. "\n INNER JOIN #__categories AS c ON c.section = s.id"
	. "\n WHERE s.scope = 'content'"
	. "\n ORDER BY s.name, c.name"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	$rows[] = JHTML::_('select.option', '0', "--- None ---" );
	$category = '';
	$category = JHTML::_('select.genericlist', $rows, 'mypoll[category]', 'class="inputbox" size="1"', 'value', 'text', $selected );
	return $category;
}

function xtMakeInput($q, $sel, $questions, $field, $size, $add="") {
	if (count($sel) > 1) {
		$qi = clone($questions);
		foreach ($sel as $s) {
			$qs = $qi->$s;
			$types[$qs->$field] = htmlspecialchars(stripslashes($qs->$field));
		}
		$html = xtMakeSelect($types, $q->$field, 'edit_'.$field, $sel);
	}
	else {
		$html = "<input class=\"inputbox\" type=\"text\" id=\"edit_".$field."\" value=\"".htmlspecialchars( stripslashes($q->$field), ENT_QUOTES )."\" size= \"".$size."\" ".$add."/>";
	}
	return $html;	
}

function xtMakeSelect($types, $field, $name, $sel = null, $style = "", $id="") {

	if (count($sel)>1)
		$t[] = JHTML::_('select.option',"-1", JText::_('POLLXT_SELECT_NOT_SPECIFIED') );
	if ($id=="") $id = $name;
	foreach ($types as $k=>$v) 
		$t[] = JHTML::_('Select.option', $v, $k);
       
	$selected = makeSelected($field);
	$typebox = JHTML::_('Select.genericlist', $t, $name, $style.' class="inputbox" id="'.$id.'"', 'value', 'text', $selected, $id);
	return $typebox;
	
}

function getImages() {

	$xt_imgpath = "";

	if ($xt_imgpath == "")
		$path = JPATH_SITE . "/images/stories/";
	else
		$path = JPATH_SITE . $xt_imgpath;

	$arr = recursedir($path, "");
    asort($arr);
	return ($arr);
}


function xtYesNo($field, $name, $sel, $default = false ) {
		$arr = array(JText::_('POLLXT_CMN_NO')=>0, JText::_('POLLXT_CMN_YES')=>1);
		if ($default) $arr[0] = _POLLXT_USE_DEFAULT;  
		if ($field == "") $field = "0";
		return xtMakeSelect($arr, $field, $name, $sel);
}


function makeSelected($in) {
	if (is_array($in)) {
	   	$arr = Array();
     		for ($i=0; $i < count($in); $i++) {
	       	$obj[$i]->value = $in[$i];
	       	$arr[] = $obj[$i];
     		}
     		$selected = $arr;
    }
    else  {
       	$obj->value = $in;
       	$arr[] = $obj;
	}
	$selected = $arr;
	return $selected;
}

// ============================================================================
// JSON 
// ============================================================================

if (!function_exists("json_encode")) {
	require_once (JPATH_SITE. "/administrator/components/com_pollxt/class/pollxt.json.php");

	function json_encode($str) {
		$json = new Services_JSON();
		return $json->encode($str);
	}

	function json_decode($str) {
		$json = new Services_JSON();
		$val = $json->decode($str);
		return $val;
	}
}
// ============================================================================
// Returns all files of a given directory incl. sub-directories
// ============================================================================
function recursedir($BASEDIR, $subdir, $myarr = array()) {
	$hndl = opendir($BASEDIR.$subdir);
	while ($file = readdir($hndl)) {

		if ($file == '.' || $file == '..')
			continue;
		$completepath = $BASEDIR."/".$subdir."/".$file."/";

		if (is_dir($completepath)) {
			# its a dir, recurse.

			$myarr = recursedir($BASEDIR, $subdir."/".$file, $myarr);

		} else {
//			global $myarr;
			# its a file.
			$myarr[] = trim(stripslashes($subdir."/".$file));
		}
	}
	return $myarr;

}

// ============================================================================
// sorts an array of objects by field names
// ============================================================================

class sortBy {
	function sortBy($field, $desc = false) {
		global $sortname;
		$sortname = $field;
		if ($desc) $this->func = "sort_objects_des";
		else
			$this->func = "sort_objects_asc";	
	}
	function usort ($objects) {
		uasort($objects, $this->func);
		return $objects;
	}
}
function sort_objects_asc($a, $b) {
 	global $sortname;
	$nameArr = $sortname;
	foreach ($nameArr as $name=>$val) {
		if ($a->$name == $b->$name) continue;
	 	return ($a->$name > $b->$name) ? 1*intval($val) : -1*intval($val);
	}
}
function sort_objects_des($a, $b) {
 	global $sortname;
	$nameArr = $sortname;
	foreach ($nameArr as $name) {
		if ($a->$name == $b->$name) return 0;
		return ($a->$name > $b->$name) ? -1 : 1;
	}
}

function print_r_html($data,$return_data=false)
{
    $data = print_r($data,true);
    $data = str_replace( " ","&nbsp;", $data);
    $data = str_replace( "\r\n","<br>\r\n", $data);
    $data = str_replace( "\r","<br>\r", $data);
    $data = str_replace( "\n","<br>\n", $data);

    if (!$return_data)
        echo $data;   
    else
        return $data;
}

function is_email($email) {
	$pattern = "/^([a-z0-9]([a-z0-9_-]*\.?[a-z0-9])*)(\+[a-z0-9]+)?@([a-z0-9]([a-z0-9-]*[a-z0-9])*\.)*([a-z0-9]([a-z0-9-]*[a-z0-9]+)*)\.[a-z]{2,6}$/";
	if (!preg_match($pattern, $email)) return false;
	else return true;
}
?>