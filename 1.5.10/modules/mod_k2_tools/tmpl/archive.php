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

<div class="k2ArchiveListContainer <?php echo $params->get('moduleclass_sfx'); ?>">
	<ul class="k2ArchiveList">
		<?php if (count($months)): ?>
			<?php foreach ($months as $month): ?>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=date&month='.$month->m.'&year='.$month->y); ?>">
					<?php echo $month->name.' '.$month->y; if ($params->get('archiveItemsCounter')) echo ' ('.$month->numOfItems.')'; ?> 
				</a>
			</li>
			<?php endforeach; ?>
		<?php endif;?>
		<li class="clr"></li>
	</ul>
</div>
