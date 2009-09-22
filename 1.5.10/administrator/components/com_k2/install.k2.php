<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.installer.installer');

$status = new JObject();
$status->modules = array();
$status->plugins = array();
$src = $this->parent->getPath('source');

$modules = &$this->manifest->getElementByPath('modules');
if (is_a($modules, 'JSimpleXMLElement') && count($modules->children())) {
	foreach ($modules->children() as $module) {
		$mname = $module->attributes('module');
		$mfolder = $module->attributes('folder');
		$path = $src.DS.'modules'.DS.$mfolder;
		$installer = new JInstaller;
		$result = $installer->install($path);
		$status->modules[] = array('name'=>$mname,'client'=>'Site', 'result'=>$result);
	}
}

$plugins = &$this->manifest->getElementByPath('plugins');
if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) {
	foreach ($plugins->children() as $plugin) {
		$pname = $plugin->attributes('plugin');
		$pfolder = $plugin->attributes('folder');
		$pgroup = $plugin->attributes('group');
		$path = $src.DS.'plugins'.DS.$pfolder;
		$installer = new JInstaller;
		$result = $installer->install($path);
		$status->plugins[] = array('name'=>$pname,'group'=>$pgroup, 'result'=>$result);
	}
}

if (JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish'.DS.'contentelements')){
	$elements = &$this->manifest->getElementByPath('joomfish');
	if (is_a($elements, 'JSimpleXMLElement') && count($elements->children())) {
		foreach ($elements->children() as $element) {
			JFile::copy($src.DS.'joomfish_elements'.DS.$element->data(),JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.$element->data());
		}

	}

}
else {
	
	global $mainframe;
	$mainframe->enqueueMessage(JText::_('Joomfish was not found. The content elements have not been copied to Joomfish folder.'));
	
}
?>

<?php $rows = 0;?>
<img src="components/com_k2/images/K2logo.gif" width="109" height="48" alt="K2 Component" align="right" />
<h2>K2 Installation</h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('Extension'); ?></th>
			<th width="30%"><?php echo JText::_('Status'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo 'K2 '.JText::_('Component'); ?></td>
			<td><strong><?php echo JText::_('Installed'); ?></strong></td>
		</tr>
		<?php if (count($status->modules)) : ?>
		<tr>
			<th><?php echo JText::_('Module'); ?></th>
			<th><?php echo JText::_('Client'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->modules as $module) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo ($module['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
		<?php if (count($status->plugins)) : ?>
		<tr>
			<th><?php echo JText::_('Plugin'); ?></th>
			<th><?php echo JText::_('Group'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->plugins as $plugin) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo ($plugin['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
