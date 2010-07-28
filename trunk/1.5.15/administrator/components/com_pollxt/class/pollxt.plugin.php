<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php
require_once (JPATH_SITE.'/administrator/components/com_pollxt/pollxt.common.php');


class configPlugin {
 var $plugins = false;
 var $active = false;
 var $data = null;
 var $pollid = null;
	
	function configPlugin ($pollid) {
	 	$this->pollid = $pollid;
		$this->getPlugins();
		if (!$this->plugins) return false;
		// include the files
		foreach ($this->plugins as $p) {
			require_once(JPATH_SITE.'/administrator/components/com_pollxt/plugins/'.$p."_plugin.php");
		}
		$this->active = true;
		$this->getPluginDataDB();
	}
	
	function getPlugins() {
 	 	$plugs = array();
 	 	$plugins = array();
		$path = JPATH_SITE.'/administrator/components/com_pollxt/plugins';
		$plugins = recursedir($path, "");
		if (!$plugins) {
			return false;
		}
		foreach ($plugins as $p) {
			if (strpos($p,"_plugin.php"))
  		  		$plugs[] = substr($p,1,strpos($p,"_plugin.php")-1); 
		}
		$this->plugins = $plugs;	
	}
	
	function getPluginDataDB() {
		global $database;
		$database->setQuery("SELECT * FROM #__pollxt_plugins WHERE pollid = '$this->pollid'");
		$this->data = $database->loadObjectList();
	}
	
	function getPluginData($plugin) {
	 	$p = array();
	 	if (!$this->data) return false;
		foreach ($this->data as $d) {
			if ($d->plugin == $plugin) $p[$d->param] = $d->value;
		}
		return $p;
	}
	
	function getConfigHTML() {
	 	$html = "";
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
		 	if (!$plug->pluginTitle) $plug->pluginTitle = $p;
		 	$html .= "<table class=\"adminform\">";
 			$html .= "<tr><th>".$plug->pluginTitle."</th></tr><tr><td>";
		 	$data = $this->getPluginData($p);
			$html .= $plug->getConfigHTML($data);
			$html .= "</td></tr></table>";
		}
		return $html;
	}
	
	function store($data) {
	 global $database;
	 	if (!$this->active) return;
		foreach ($data as $dk=>$dv) {
			foreach ($dv as $k=>$v) {
			 	$db = new mosPollPlugin($database);
			 	$database->setQuery("SELECT id FROM #__pollxt_plugins WHERE pollid = '$this->pollid' AND plugin='$dk' AND param = '$k'");
			 	$db->id = $database->loadResult();
				$db->pollid = $this->pollid;
				$db->plugin = $dk;
				$db->param = $k;
				$db->value = $v;
				$db->store();
			}
		}
	}
	
	function getAuth() {
	 	if (!$this->plugins) return true;
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
		 	$data = $this->getPluginData($p);
			if (!$plug->getAuth($data)) return false;
		}
		return true;	
	}

	function beforeDisplay() {
	 	if (!$this->plugins) return;
	 	$html = "";
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
		 	$data = $this->getPluginData($p);
			$html .= $plug->beforeDisplay($data);
		}
		return $html;	
	}

	function afterDisplay() {
	 	if (!$this->plugins) return;
		$html = "";
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
		 	$data = $this->getPluginData($p);
			$html .= $plug->afterDisplay($data);
		}
		return $html;	
	}

	function getResultPlugin() {
	 	if (!$this->plugins) return;
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
		 	$data = $this->getPluginData($p);
		 	$rplug = $plug->getResultPlugin($data);
			if ($rplug != "") return $rplug;
		}
	}
	
	function checkVote($data) {
	 	if (!$this->plugins) return;
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
			if ($message = $plug->checkVote($data[$p])) return $message;
			else return null;
		}
		
	}

	function saveVote($data) {
	 	if (!$this->plugins) return;
		foreach ($this->plugins as $p) {
		 	$plug = new $p;
			$plug->saveVote($data[$p]); 
		}
		
	}

}

class pollxtPlugin {
var $pluginTitle =  null;
var $pluginName = null; 
	function getConfigHTML($data) {
	}
	function getAuth($data) {
		return true;
	}
	function checkVote($data) {
		return null;
	}	
	function saveVote($data) {
	}	
	function beforeDisplay($data) {
	}	
	function afterDisplay($data) {
	}
	function getResultPlugin($data) {
	}
	function getConfigName($name) {
		return "plugindata[".get_class($this)."][".$name."]";
	}
	function getDisplayName($name) {
		return "plugindata_".get_class($this)."_".$name;
	}
}


?>