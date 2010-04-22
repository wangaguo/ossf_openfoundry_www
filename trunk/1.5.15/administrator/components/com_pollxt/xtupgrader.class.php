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
class xt_upgrader {
	var $version_xml = null;
	var $xmlDocServer = null;
	var $upgradePath = null;
	var $msg = null;

	function xt_upgrader() {
		global $mosConfig_absolute_path;

		require_once (JPATH_SITE.'/includes/domit/xml_domit_lite_include.php');

	}
	function set_upgrade_path($path) {
		$this->upgradePath = $path;
	}

	function set_version_xml($file) {
		$this->version_xml = $this->upgradePath."/".$file;
	}

	function get_version_xml() {
		return $this->version_xml;

	}
	function get_installed_modules($filter) {
		global $database;
		// get installed modules
		$database->setQuery("SELECT id, module, client_id"."\n FROM #__modules"."\n WHERE module LIKE '$filter%' AND iscore='0'"."\n GROUP BY module, client_id"."\n ORDER BY client_id, module");
		return $database->loadObjectList();

	}
	function get_mod_version($mod) {
		jimport('joomla.filesystem.path');
		

		// path to module directory
		if ($mod->client_id == "1") {
			$moduleBaseDir = JPath::clean(JPATH_SITE.DS."administrator/modules");
		} else {
			$moduleBaseDir = JPath::clean(JPATH_SITE.DS."modules");
		}
		// xml file for module
		$xmlfile = $moduleBaseDir.DS.$mod->module.DS.$mod->module.".xml";
		if (file_exists($xmlfile)) {
			$xmlDoc = & new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors(true);
			if (!$xmlDoc->loadXML($xmlfile)) {
				$this->addMsg("e", $xmlDoc->getErrorString());
			}

			$element = & $xmlDoc->getElementsByPath('version', 1);
			return $element ? $element->getText() : '';

		}

	}
	function get_installed_bots($filter) {
		global $database;
		// get installed bots
		$database->setQuery("SELECT id, element, client_id"."\n FROM #__mambots"."\n WHERE element LIKE '$filter%' AND iscore='0'"."\n GROUP BY element, client_id"."\n ORDER BY client_id, element");
		return $database->loadObjectList();

	}
	function get_bot_version($mod) {
		global $mosConfig_absolute_path;

		// path to bot directory
			$botBaseDir = mosPathName(mosPathName($mosConfig_absolute_path)."mambots/content");
		// xml file for module
		$xmlfile = $botBaseDir."/".$mod->element.".xml";
		if (file_exists($xmlfile)) {
			$xmlDoc = & new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors(true);
			if (!$xmlDoc->loadXML($xmlfile)) {
				$this->addMsg("e", $xmlDoc->getErrorString());
			}
			$element = & $xmlDoc->getElementsByPath('version', 1);
			return $element ? $element->getText() : '';

		}

	}

	function get_server_version($item) {

		if (!$this->xmlDocServer) {
			$this->xmlDocServer = & new DOMIT_Lite_Document();
			$this->xmlDocServer->resolveErrors(true);
			if (!$this->xmlDocServer->loadXML($this->get_version_xml(), false, true)) {
				return;
			}
		}

		// get Server Version
		$xml = & $this->xmlDocServer;
		$newElement = $xml->getElementsByPath($item."Version", 1);
		return $newElement ? $newElement->getText() : '';
	}

	function upgrade($item) {
		global $database;
		// get upgrade info from server
		require_once ($this->upgradePath."/".$item->module."upd.inc");

		//update files
		if (isset ($updatefile)) {
			foreach ($updatefile as $u) {
				if ($u->upversion > $item->oldversion) {
					if ($this->up_file($u->name)) {
						$this->addMsg("s", "File ".$u->name." updated");
					} else {
						$this->addMsg("e", "File ".$u->name." update failed");
					}
				}

				if ($u->delversion > $item->oldversion) {
					if ($this->del_file($u->name)) {
						$this->addMsg("s", "File ".$u->name." deleted");
					} else {
						$this->addMsg("e", "File ".$u->name." delete failed");
					}
				}
			}
		}

		// update database

		if (isset ($updatequery)) {
			foreach ($updatequery as $q) {
				if ($q->upversion > $item->oldversion) {
					$database->setQuery($q->query);
					$database->query();
					if ($database->getErrorNum()) {
						$this->addMsg("e", $q->text.$database->getErrorMsg());
					} else {
						$this->addMsg("s", $q->text." successful");
					}
				}
			}
		}

		$this->addMsg("i", "Upgrade of ".$item->module." completed");
	}

	function addMsg($type, $text) {
		$tmp = null;
		$tmp->type = $type;
		$tmp->text = $text;

		if (!is_array($this->msg))
			$this->msg = array ();
		array_push($this->msg, $tmp);
	}

	function up_file($fname) {
		global $mosConfig_absolute_path;

		$b = set_magic_quotes_runtime(0);

		if (!function_exists('file_get_contents')) {
			function file_get_contents($file) {
				$file = file($file);
				return !$file ? false : implode('', $file);
			}
		}
		if (!function_exists('file_put_contents')) {
			function file_put_contents($filename, $data, $file_append = false) {
				$fp = fopen($filename, (!$file_append ? 'w+' : 'a+'));
				if (!$fp) {
					trigger_error('file_put_contents cannot write in file.', E_USER_ERROR);
					return 0;
				}
				$return = fwrite($fp, $data);
				fclose($fp);
				if ($return === false) {
					$return = 0;
				}
				return $return;
			}
		}

		$upfile = file_get_contents($this->upgradePath.preg_replace('/\.php$/', '.inc', $fname));
		return file_put_contents($mosConfig_absolute_path.$fname, $upfile);
	}

	function del_file($fname) {
		global $mosConfig_absolute_path;
		$ret = true;
		if (file_exists($mosConfig_absolute_path."/".$fname))
			$ret = unlink($mosConfig_absolute_path."/".$fname);
        return $ret;
	}

}

class xtupgradeItem {
	var $module = null;
	var $oldversion = null;

	function xtupgradeItem() {

	}
	function bind($array, $ignore = "") {
		if (!is_array($array)) {
			$this->_error = strtolower(get_class($this))."::bind failed.";
			return false;
		} else {
			return mosBindArrayToObject($array, $this, $ignore);
		}
	}

}

class HTML_upgrader {
	function showCheckResult($option, $mod, & $pageNav) {
		global $mainframe;
		JHTML::_('behavior.tooltip');
		
?>


<form action="index2.php" method="post" name="adminForm">

<table width = "75%" class="adminlist">
<tr>
    <th align="left"><?php echo JText::_('ADMIN_POLLXT_UPGRADER_MODCOM'); ?></th>
    <th ><?php echo JText::_('ADMIN_POLLXT_UPGRADER_INSTALLED_VER'); ?></th>
    <th ><?php echo JText::_('ADMIN_POLLXT_UPGRADER_LATEST_VER'); ?></th>
    <th ><?php echo JText::_('ADMIN_POLLXT_UPGRADER_CHANGELOG'); ?></th>
    <th ><?php echo JText::_('ADMIN_POLLXT_UPGRADER_STATUS'); ?></th>
</tr>
<?php

		$i = 0;
		foreach ($mod as $m) {
			if ($m->update)
				$img = "status_r";
			else
				$img = "status_g";
			$imgpath = $mainframe->getSiteURL()."components/com_pollxt/images/".$img.".png";
//			if ($m->update) {
//				$checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$i."\" onclick=\"isChecked(this.checked);\" />";
//			} else
//				$checked = "<input disabled type=\"checkbox\" onclick=\"isChecked(this.checked);\" />";
?>
<input type="hidden" name="mod[<?php echo $i?>][module]" value="<?php echo $m->module?>" />
<input type="hidden" name="mod[<?php echo $i?>][oldversion]" value="<?php echo $m->oldVersion?>" />

 <tr class="<?php echo "row$k"; ?>">
  <?php  // echo $checked  
  ?>
    <td><?php echo $m->module ?></td>
    <td align="center"><?php echo $m->oldVersion?></td>
    <td align="center"><?php echo $m->newVersion?></td>
    <td align="center">
    <a href="#" onClick="javascript:window.open('http://www.joomlaxt.com/updates/<?php echo $m->module?>log.txt','Changelog', 'resizable=yes, scrollbars=yes, location=no, menubar=no, status=no, toolbar=no, width=640, height=480')">
<img src="components/com_pollxt/preview.gif" width="12" height="12" border="0" alt="" />
</a>
    </td>
    <td align="center"><img src="<?php echo $imgpath;?>" /></td>
    </tr>
<?php


			$i ++;
		}
?>
</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0">

</form>
<?php


	}

	function updateResult($option, $msg) {
		global $mosConfig_live_site;
		mosCommonHTML :: loadOverlib();
?>

<?php $header = new xtTitle("PollXT"); echo $header->show("Upgrade Result") ?>


<form action="index2.php" method="post" name="adminForm">

<table width = "75%" class="adminlist">
<?php


		foreach ($msg as $m) {
			if ($m->type == "e")
				$fc = "bb0000";
			if ($m->type == "s")
				$fc = "009900";
			if ($m->type == "i")
				$fc = "000000";
?>
<tr>
 <td style="color:#<?php echo $fc?>; font-weight:bold; font-size:12px"><?php echo $m->text ?></td>
</tr>
<?php } ?>
</table>
</form>
<?php


		}
	}
?>


