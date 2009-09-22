<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

$document = & JFactory::getDocument();
$document->addStyleSheet(JURI::base().'components/com_k2/css/style.css');
$document->addCustomTag('
<!--[if IE 7]>
<link href="'.JURI::base().'components/com_k2/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 6]>
<link href="'.JURI::base().'components/com_k2/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
');

$controller = JRequest::getWord('view', 'cpanel');
require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
$classname = 'K2Controller'.$controller;
$controller = new $classname();
$controller->registerTask('saveAndNew', 'save');
$controller->execute(JRequest::getWord('task'));
$controller->redirect();

?>

<div id="k2AdminFooter">
	<?php echo JText::_('K2_COPYRIGHTS'); ?>
</div>
