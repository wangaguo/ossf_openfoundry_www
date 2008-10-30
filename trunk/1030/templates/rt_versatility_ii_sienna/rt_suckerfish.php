<?php
global $cur_template;
?>
 	<!-- these two are required for transmenus to function -->
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $cur_template;?>/styles.css" />	
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $cur_template;?>/transmenu.css" />
	<script type="text/javascript" language="javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $cur_template;?>/transmenu.js"></script>
	

<?php
// initialize some variables taht we will need
$submenu = 0;
$init_info = '';
$menu_info = '';
$top_level = '';
$top_surround = array('<div id="mtm_menu">', '</div></div></div>');

function mosTransmenu()
{
		global $top_level, $menu_info, $top_surround;
		echo $top_surround[0] . $top_level . $top_surround[1];
		echo '<script type="text/javascript" language="javascript">' . chr(10);
		echo '//<![CDATA[' . chr(10);
		echo '  if (TransMenu.isSupported()) {' . chr(10);
		echo '	  var ms = new TransMenuSet(TransMenu.direction.down, 1, 0, TransMenu.reference.bottomLeft);' . chr(10);
		echo $menu_info;
		echo '	  TransMenu.renderAll();' . chr(10);
		echo '  }' . chr(10);
		echo '//]]>' . chr(10);
		echo '</script>' . chr(10);
} 

function mosInitTransmenu($menutype)
{
		global $database, $my, $cur_template, $Itemid, $init_info, $menu_info, $top_level;
		global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_shownoauth; 

		if ($mosConfig_shownoauth) {
				$database->setQuery("SELECT m.*, count(p.parent) as cnt" . "\nFROM #__menu AS m" . "\nLEFT JOIN #__menu AS p ON p.parent = m.id" . "\nWHERE m.menutype='$menutype' AND m.published='1'" . "\nGROUP BY m.id ORDER BY m.parent, m.ordering ");
		} else {
				$database->setQuery("SELECT m.*, count(p.parent) as cnt" . "\nFROM #__menu AS m" . "\nLEFT JOIN #__menu AS p ON p.parent = m.id" . "\nWHERE m.menutype='$menutype' AND m.published='1' AND m.access <= '$my->gid'" . "\nGROUP BY m.id ORDER BY m.parent, m.ordering ");
		} 

		$rows = $database->loadObjectList('id');
		echo $database->getErrorMsg();

		$indents = array('<span class="active">', '</span>' , '<ul>', '</ul>'); 
		// establish the hierarchy of the menu
		$children = array(); 
		// first pass - collect children
		foreach ($rows as $v) {
				$pt = $v->parent;
				$list = @$children[$pt] ? $children[$pt] : array();
				array_push($list, $v);
				$children[$pt] = $list;
		} 
		// second pass - collect 'open' menus
		$open = array($Itemid);
		$count = 20; // maximum levels - to prevent runaway loop
		$id = $Itemid;
		while (--$count) {
				if (isset($rows[$id]) && $rows[$id]->parent > 0) {
						$id = $rows[$id]->parent;
						$open[] = $id;
				} else {
						break;
				} 
		} 
		$class_sfx=null;
		mosRecurseListMenu(0, 0, $children, $open, $indents, $class_sfx); 
		// output initialization information
		echo '<script type="text/javascript" language="javascript">' . chr(10);
		echo '//<![CDATA[' . chr(10);
		echo '	function init() {' . chr(10);
		echo '	  if (TransMenu.isSupported()) {' . chr(10);
		echo '			TransMenu.initialize();' . chr(10);
		echo $init_info;
		echo '	 	}' . chr(10);
		echo '  }' . chr(10);
		echo '//]]>' . chr(10);
		echo '</script>' . chr(10);
} 

function mosRecurseListMenu($id, $level, &$children, $open, &$indents, $class_sfx, $x = 1)
{
		global $Itemid, $init_info, $menu_info, $top_level, $submenu;
		global $HTTP_SERVER_VARS, $mosConfig_live_site;
		$index = 0;

		if (@$children[$id]) {
				$n = min($level, count($indents)-1);

				foreach ($children[$id] as $row) {
						$index++;
						$end = '';
						$start = '';

						switch ($row->type) {
								case 'separator'; 
										// do nothing
										break;

								case 'url':
										if (eregi('index.php\?', $row->link)) {
												if (!eregi('Itemid=', $row->link)) {
														$row->link .= '&Itemid=' . $row->id;
												} 
										} 
										break;

								default:
										$row->link .= "&Itemid=$row->id";
										break;
						} 

						$current_itemid = trim(mosGetParam($_REQUEST, 'Itemid', 0));
						error_reporting(0);
						if ($Itemid == $row->id ||
								(sefRelToAbs(substr($_SERVER['PHP_SELF'], 0, -9) . $row->link)) == $_SERVER['REQUEST_URI'] ||
										(sefRelToAbs(substr($_SERVER['PHP_SELF'], 0, -9) . $row->link)) == $HTTP_SERVER_VARS['REQUEST_URI']) {
								$start = $indents[0];
								$end = $indents[1];
						} 

						if ($level == 0) {
								$top_level .= $start . mosGetLink($row, $level, $class_sfx) . $end . chr(10);
								if (@$children[$row->id]) {
										$init_info .= 'menu' . $x . '.onactivate = function() { document.getElementById("mtm_' . str_replace(" ", "_", strtolower($row->name)) . '").className = "hover"; };' . chr(10);
										$init_info .= 'menu' . $x . '.ondeactivate = function() { document.getElementById("mtm_' . str_replace(" ", "_", strtolower($row->name)) . '").className = ""; };' . chr(10);
										$menu_info .= chr(10) . 'var menu' . $x . ' = ms.addMenu(document.getElementById("mtm_' . str_replace(" ", "_", strtolower($row->name)) . '"));' . chr(10);
										mosRecurseListMenu($row->id, $level + 1, $children, $open, $indents, $class_sfx, $x);
								} else {
										$init_info .= 'document.getElementById("mtm_' . str_replace(" ", "_", strtolower($row->name)) . '").onmouseover = function() { ms.hideCurrent(); this.className = "hover"; }' . chr(10);
										$init_info .= 'document.getElementById("mtm_' . str_replace(" ", "_", strtolower($row->name)) . '").onmouseout = function() { this.className = ""; }' . chr(10);
								} 
								$x++;
						} elseif ($level == 1) {
								$menu_info .= 'menu' . $x . '.addItem(' . mosGetLink($row, $level, $class_sfx) . ');' . chr(10);
								if (@$children[$row->id]) {
										$menu_info .= chr(10) . 'var submenu' . ++$submenu . ' = menu' . $x . '.addMenu(menu' . $x . '.items[' . ($index-1) . ']);' . chr(10);
										mosRecurseListMenu($row->id, $level + 1, $children, $open, $indents, $class_sfx, $x);
								} 
						} elseif ($level == 2) {
								$menu_info .= 'submenu' . $submenu . '.addItem(' . mosGetLink($row, $level, $class_sfx) . ');' . chr(10);
						} 
				} 
		} 
} 

/**
 * Utility function for writing a menu link
 */
function mosGetLink($mitem, $level = 0, $class_sfx = '')
{
		global $Itemid, $mosConfig_live_site;
		$txt = '';


    if ($level == 0) {
		  $mitem->link = str_replace('&', '&amp;', $mitem->link);
    }

		if (strcasecmp(substr($mitem->link, 0, 4), "http")) {
				$mitem->link = sefRelToAbs($mitem->link);
		} 

		if ($level == 0) {
				$txt = '<a href="' . $mitem->link . '" id="mtm_' . str_replace(" ", "_", strtolower($mitem->name)) . '">' . $mitem->name . '</a>';
		} else {
				$txt = '"' . $mitem->name . '", "' . $mitem->link . '"';
		} 

		return $txt;
} 

?>			
 
 
