<?php
/**
 * @version $Id: modules.php 5556 2006-10-23 19:56:02Z Jinx $
 * @package Joomla
 * @copyright Copyright (C) 2005 - 2006 Open Source Matters. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a slider
 */

function modChrome_submenu($module, &$params, &$attribs)
{
	global $Itemid, $show_collapse, $show_tools;
	
	$start	= $params->get('startLevel');
	
	$tabmenu = &JSite::getMenu();
	$item = $tabmenu->getItem($Itemid);
	
	

	if (isset($item)) {
		$tparent = $tabmenu->getItem($item->parent);

	    	while ($tparent != null && $tparent->parent != 0) {
	    		if ($item->sublevel == $start-1) break;
	    		$item = $tabmenu->getItem($item->parent);
				$tparent = $tabmenu->getItem($item->parent);
	    	}
	    	if (!empty ($module->content) && strlen($module->content) > 40) { ?>
	    	<div class="side-module <?php echo $params->get('moduleclass_sfx'); ?> rokmodtools-<?php echo $module->id; ?>">
				<div class="side-mod">
					<div class="side-mod2">
					<div class="side-title-container">
					<h3 class="module-title"><span class="bg"><span class="bg2"><?php echo $item->name; ?> Menu</span></span></h3>
					<?php if ($show_collapse != 'hidecollapse'): ?>
						<div class="close-handle"></div>
					<?php endif; ?>
					<?php if ($show_tools != 'hidetools'): ?>
						<div class="tools-handle"></div>
					<?php endif; ?>
					
					</div>
					<div class="module">
						<?php echo $module->content; ?>
					</div>
				</div>
				</div>
				<div class="side-mod-bottom"><div class="side-mod-bottom2"><div class="side-mod-bottom3"></div></div></div>
			</div>
	    	<?php 
		    }
	}
}

function modChrome_sidebar($module, &$params, &$attribs)
{
	global $show_collapse, $show_tools;
    	
	if (!empty ($module->content)) : ?>
	<div class="side-module <?php echo $params->get('moduleclass_sfx'); ?> rokmodtools-<?php echo $module->id; ?>">
		<div class="side-mod">
			<?php if ($module->showtitle != 0) : ?>
			<div class="side-mod2">
				<div class="side-title-container">
					<h3 class="module-title"><span class="bg"><span class="bg2"><?php echo $module->title; ?></span></span></h3>
					<?php if ($show_collapse != 'hidecollapse'): ?>
						<div class="close-handle"></div>
					<?php endif; ?>
					<?php if ($show_tools != 'hidetools'): ?>
						<div class="tools-handle"></div>
					<?php endif; ?>
					
				</div>
				<?php endif; ?>
				<div class="module">
					<?php echo $module->content; ?>
				</div>
			<?php if ($module->showtitle != 0) : ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="side-mod-bottom"><div class="side-mod-bottom2"><div class="side-mod-bottom3"></div></div></div>
	</div>
	<?php endif;
}

function modChrome_main($module, &$params, &$attribs)
{
	global $show_collapse, $show_tools;
	
	if (!empty ($module->content)) : ?>
	<div class="mainblock-module <?php echo $params->get('moduleclass_sfx'); ?> rokmodtools-<?php echo $module->id; ?>">
		<div class="mainblock-mod">
			<?php if ($module->showtitle != 0) : ?>
			<div class="mainblock-mod2">
				<div class="mainblock-title-container">
					<h3 class="module-title"><span class="bg"><?php echo $module->title; ?></span></h3>
					<?php if ($show_collapse != 'hidecollapse'): ?>
						<div class="close-handle"></div>
					<?php endif; ?>
					<?php if ($show_tools != 'hidetools'): ?>
						<div class="tools-handle"></div>
					<?php endif; ?>
					
				</div>
				<?php endif; ?>
				<div class="module">
					<?php echo $module->content; ?>
				</div>
			<?php if ($module->showtitle != 0) : ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="mainblock-mod-bottom"><div class="mainblock-mod-bottom2"><div class="mainblock-mod-bottom3"></div></div></div>
	</div>
	<?php endif;
}

function modChrome_rokmininews($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
	<div class="rokmininews-surround">
	<div class="<?php echo $params->get('moduleclass_sfx'); ?>">
		<div class="mainblock-mod">
			<?php if ($module->showtitle != 0) : ?>
			<div class="mainblock-mod2">
				<div class="mainblock-title-container">
					<h3 class="module-title"><span class="bg"><?php echo $module->title; ?></span></h3>
				</div>
				<?php endif; ?>
				<div class="module">
					<?php echo $module->content; ?>
				</div>
			<?php if ($module->showtitle != 0) : ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="mainblock-mod-bottom"><div class="mainblock-mod-bottom2"><div class="mainblock-mod-bottom3"></div></div></div>
	</div>
	</div>
	<?php endif;
}

?>