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

?>
<script language="javascript" type="text/javascript">
<!--
function submitbutton(pressbutton) {
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}
	if (trim( document.adminForm.name.value ) == "") {
		alert( '<?php echo JText::_('Category must have a Name', true);?>' );
	}
	else {
		submitform( pressbutton );
	}
}
//-->
</script>
<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
	<table class="admintable" width="100%">
		<tbody>
			<tr>
				<td valign="top">
					<fieldset>
					<legend><?php echo JText::_('Details');?></legend>
					<table class="admintable">
						<tr>
							<td width="100" align="right" class="key"><?php	echo JText::_('Published');	?></td>
							<td><?php echo $this->lists['published']; ?></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php echo JText::_('Name'); ?></td>
							<td><input class="text_area" type="text" name="name" id="name" value="<?php echo $this->row->name; ?>" size="50" maxlength="250" /></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php echo JText::_('Alias'); ?></td>
							<td><input class="text_area" type="text" name="alias" value="<?php echo $this->row->alias; ?>" size="50" maxlength="250" /></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php	echo JText::_('Parent'); ?></td>
							<td><?php echo $this->lists['parent']; ?></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php	echo JText::_('Associated Extra Fields Group');	?></td>
							<td><?php echo $this->lists['extraFieldsGroup']; ?></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php echo JText::_('Inherit params from'); ?></td>
							<td><?php echo $this->lists['inheritFrom']; ?></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php echo JText::_('Access level'); ?></td>
							<td><?php echo $this->lists['access']; ?></td>
						</tr>
						<tr>
							<td width="100" align="right" class="key"><?php	echo JText::_('Description'); ?></td>
							<td><?php echo $this->editor; ?></td>
						</tr>
						<tr>
						<td width="100" align="right" class="key"><?php	echo JText::_('Category image'); ?></td>
						<td>
							<input type="file" name="image" class="text_area" />
							<?php if (!empty($this->row->image)):?>
							<img alt="<?php echo $this->row->name;?>" src="<?php echo JURI::root();?>media/k2/categories/<?php echo $this->row->image; ?>" class="k2AdminImage"/>
							<input type="checkbox" name="del_image" id="del_image" />
							<label for="del_image"><?php echo JText::_('Check this box to delete current image');?></label>
							<?php endif;?>
						</td>
						</tr>
					</table>
					<div class="categoryPlugins">
			          	<?php if (count($this->K2Plugins)):?>
				            <?php foreach ($this->K2Plugins as $K2Plugin) : ?>
								<fieldset><legend><?php echo $K2Plugin->name;?></legend>
								<?php echo $K2Plugin->fields;?>
								</fieldset>
				            <?php endforeach; ?>
						<?php endif;?>
			        </div>
					<input type="hidden" name="id" value="<?php echo $this->row->id;?>" />
					<input type="hidden" name="option" value="<?php echo $option;?>" />
					<input type="hidden" name="view" value="category" />
					<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
					<?php echo JHTML::_('form.token'); ?>
					</fieldset>
				</td>
				<td valign="top" width="320">
					<fieldset>
						<legend><?php echo JText::_('Parameters');?></legend>
						<?php
							jimport('joomla.html.pane');
							$pane = & JPane::getInstance('sliders', array('allowAllClose' => true));
							echo $pane->startPane( 'content-pane' );
							
							echo $pane->startPanel( JText::_( 'Category item layout' ), 'category-item-layout' );
							echo $this->form->render('params','category-item-layout');
							echo $pane->endPanel();
							
							echo $pane->startPanel( JText::_( 'Category view options' ), 'category-view-options' );
							echo $this->form->render('params','category-view-options');
							echo $pane->endPanel();
							
							echo $pane->startPanel( JText::_( 'Item view options in category listings' ), 'item-view-options-listings' );
							echo $this->form->render('params','item-view-options-listings');
							echo $pane->endPanel();
							
							echo $pane->startPanel( JText::_( 'Item view options' ), 'item-view-options' );
							echo $this->form->render('params','item-view-options');
							echo $pane->endPanel();
							
							echo $pane->endPane();
						?>
					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>
</form>
