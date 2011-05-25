<?php
/**
 * $Id: style.php 55 2011-02-13 16:16:19Z happy_noodle_boy $
 * @package     JCE Style
 * @copyright 	Copyright (C) 2005 - 2010 Ryan Demmer. All rights reserved.
 * @copyright 	Copyright (C) 2010 Moxiecode Systems AB. All rights reserved.
 * @author		Ryan Demmer
 * @author		Moxiecode
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL, see licence.txt
 * JCE is free software. This version may have been modified pursuant
 * to the GNU Lesser General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU Lesser General Public License or
 * other free or open source software licenses.
 */
defined( '_JEXEC' ) or die('ERROR_403');

$tabs = WFTabs::getInstance(); 
?>
<form>
<?php $tabs->render();?>
<div class="mceActionPanel">
	<button type="submit" id="insert" name="insert" onclick="StyleDialog.updateAction();">{#update}</button>
	<button type="button" class="button" id="apply" name="apply" onclick="StyleDialog.applyAction();">{#style_dlg.apply}</button>
	<button type="button" id="cancel">{#cancel}</button>
</div>
</form>
<div style="display: none">
	<div id="container"></div>
</div>