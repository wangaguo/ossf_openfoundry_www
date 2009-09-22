<?php
/*
// "K2 Tools" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

// CSS
$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));
$document->addStyleSheet($filePath.'/css/style.css');

?>

<div class="k2Breadcrumbs <?php echo $params->get('moduleclass_sfx'); ?>">
	<?php
	$output = '';
	if ($params->get('home')) {
		$output .= '<span class="k2BreadcrumbsTitle">'.JText::_('You are here:').'</span>';
		$output .= '<a href="'.JURI::root().'">'.$params->get('home',JText::_('Home')).'</a>';
		if (count($path)) {
			foreach ($path as $link) {
				$output .= '<span class="k2BreadcrumbsSep">'.$params->get('seperator','&raquo;').'</span>'.$link;
			}
		}
		if($title){
			$output .= '<span class="k2BreadcrumbsSep">'.$params->get('seperator','&raquo;').'</span>'.$title;
		}
	} else {
		if($title){
			$output .= '<span class="k2BreadcrumbsTitle">'.JText::_('You are here:').'</span>';
		}
		if (count($path)) {
			foreach ($path as $link) {
				$output .= $link.'<span class="k2BreadcrumbsSep">'.$params->get('seperator','&raquo;').'</span>';
			}
		}
		$output .= $title;
	}

	echo $output;
	?>
	<div class="clr"></div>
</div>
