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
	if (trim( document.adminForm.group.value ) == "") {
		alert( '<?php echo JText::_('Please select a group or create a new one', true);?>' );
	}
	else if (trim( document.adminForm.name.value ) == "") {
		alert( '<?php echo JText::_('Name cannot be empty', true);?>' );
	}
	else if (trim( document.adminForm.name.value ) == "") {
		alert( '<?php echo JText::_('Name attribute cannot be empty', true);?>' );
	}
	else {
		submitform( pressbutton );
	}
}

function addOption(){
	var div = new Element('div').injectInside($('select_dd_options'));
	var label = new Element('label').setHTML('<?php echo JText::_('Name', true);?>').injectInside(div);
	var input = new Element('input',{'name':'option_name[]','type':'text'}).injectInside(div);
	var input = new Element('input',{'name':'option_value[]','type':'hidden'}).injectInside(div);
	var input = new Element('input',{'value':'<?php echo JText::_('Remove',true);?>','type':'button', events: { click: function() {this.getParent().remove();} }}).injectInside(div);
}

function renderExtraFields(fieldType,fieldValues,isNewField){
	var target = $('exFieldsTypesDiv');
	var currentType = '<?php echo $this->row->type;?>';
	
	switch (fieldType){
		
		case 'textfield':
		var label = new Element('label').setHTML('<?php echo JText::_('Textfield Value', true);?>').injectInside(target);
		if (isNewField || currentType!=fieldType)
			var input = new Element('input',{'name':'option_value[]','type':'text'}).injectInside(target);
		else
			var input = new Element('input',{'name':'option_value[]','type':'text','value':fieldValues[0].value}).injectInside(target);
		break;
		
		case 'textarea':
		var label = new Element('label').setHTML('<?php echo JText::_('Textarea Value', true);?>').injectInside(target);
		var br = new Element('br').injectInside(target);
		if (isNewField || currentType!=fieldType)
			var textarea = new Element('textarea',{'name':'option_value[]','cols':'40', 'rows':'10'}).injectInside(target);
		else 
			var textarea = new Element('textarea',{'name':'option_value[]','cols':'40', 'rows':'10','value':fieldValues[0].value}).injectInside(target);
		break;
		
		case 'select':
		case 'multipleSelect':
		case 'radio':
		var title = new Element('label').setHTML('<?php echo JText::_('Select Options', true);?>').injectInside(target);
		var input = new Element('input',{'value':'<?php echo JText::_('Add Option', true);?>','type':'button', events: { click: function() {addOption();} }}).injectInside(target);
		
		var br = new Element('br').injectInside(target);
		var br = new Element('br').injectInside(target);
		var div = new Element('div',{'id':'select_dd_options'}).injectInside(target);
		if (isNewField || currentType!=fieldType) {
			addOption();
		}
		else {
			$each(fieldValues, function(value){
				
				var div = new Element('div').injectInside($('select_dd_options'));
				var label = new Element('label').setHTML('<?php echo JText::_('Name', true);?>').injectInside(div);
				var input = new Element('input',{'name':'option_name[]','type':'text','value':value.name}).injectInside(div);
				var input = new Element('input',{'name':'option_value[]','type':'hidden','value':value.value}).injectInside(div);
				var input = new Element('input',{'value':'<?php echo JText::_('Remove',true);?>','type':'button', events: { click: function() {this.getParent().remove();} }}).injectInside(div);
			});	
			
		}
		break;
		
		case 'link':
		if (isNewField || currentType!=fieldType) {
			var label = new Element('label').setHTML('<?php echo JText::_('Text', true);?>').injectInside(target);
			var input = new Element('input',{'name':'option_name[]','type':'text'}).injectInside(target);
			var label = new Element('label').setHTML('<?php echo JText::_('URL', true);?>').injectInside(target);
			var input = new Element('input',{'name':'option_value[]','type':'text'}).injectInside(target);
			var label = new Element('label').setHTML('<?php echo JText::_('Open in', true);?>').injectInside(target);
			var select = new Element('select',{'name':'option_target[]'}).injectInside(target);
			var option = new Element('option',{'value':'same'}).setHTML('<?php echo JText::_('Same window', true);?>').injectInside(select);
			var option = new Element('option',{'value':'new'}).setHTML('<?php echo JText::_('New window', true);?>').injectInside(select);
			var option = new Element('option',{'value':'popup'}).setHTML('<?php echo JText::_('Classic javascript popup', true);?>').injectInside(select);
			var option = new Element('option',{'value':'lightbox'}).setHTML('<?php echo JText::_('Lightbox popup', true);?>').injectInside(select);
		}
		else {
			var label = new Element('label').setHTML('<?php echo JText::_('Text', true);?>').injectInside(target);
			var input = new Element('input',{'name':'option_name[]','type':'text','value':fieldValues[0].name}).injectInside(target);
			var label = new Element('label').setHTML('<?php echo JText::_('URL', true);?>').injectInside(target);
			var input = new Element('input',{'name':'option_value[]','type':'text','value':fieldValues[0].value}).injectInside(target);
			var label = new Element('label').setHTML('<?php echo JText::_('Open in new window', true);?>').injectInside(target);
			var select = new Element('select',{'name':'option_target[]'}).injectInside(target);
			var options = new Array();
			options[0] = new Element('option',{'value':'same'}).setHTML('<?php echo JText::_('Same window', true);?>').injectInside(select);
			options[1] = new Element('option',{'value':'new'}).setHTML('<?php echo JText::_('New window', true);?>').injectInside(select);
			options[2] = new Element('option',{'value':'popup'}).setHTML('<?php echo JText::_('Classic javascript popup', true);?>').injectInside(select);
			options[3] = new Element('option',{'value':'lightbox'}).setHTML('<?php echo JText::_('Lightbox popup', true);?>').injectInside(select);
			options.each(function(el) {
				if (el.value==fieldValues[0].target){
					el.setProperty('selected','selected');
				}
			});

		}
		break;
		
		default:
		var title = new Element('label').setHTML('<?php echo JText::_('Please select a field type', true);?>').injectInside(target);
		break;
		
	}
	
}

window.addEvent('domready', function(){

	<?php echo ($this->row->group)? "$('groupContainer').setStyle('opacity',0)":""?>
	
	$('groups').addEvent('change', function(){
		
	var selectedValue = this.value;
	
	    if (selectedValue == '0') {
	        $('group').setProperty('value', '');
		$('isNew').setProperty('value', '1');
	        new Fx.Style($('groupContainer'), 'opacity', {
	            duration: 1000
	        }).start(1);
	    }
	    
	    else {
	        new Fx.Style($('groupContainer'), 'opacity', {
	            duration: 1000
	        }).start(0).chain(function(){
	            $('group').setProperty('value', selectedValue);
			$('isNew').setProperty('value', '0');
	        });
	    }
	    
	});
	
	var newField= <?php echo ($this->row->id)?0:1;?>;

	if (!newField) {
		var values = Json.evaluate($('value').getProperty('value'));
	}
	else {
		var values=new Array();
		values[0]=" ";
	}

	renderExtraFields('<?php echo $this->row->type;?>',values,newField);
	
    $('type').addEvent('change', function(){
    	
		var selectedType=this.value;

		new Fx.Style($('exFieldsTypesDiv'), 'opacity', {
			duration: 500
		}).start(0).chain(function(){
		$('exFieldsTypesDiv').empty();
		
		renderExtraFields(selectedType,values,newField);
			new Fx.Style($('exFieldsTypesDiv'), 'opacity', {
				duration: 500
			}).start(1);
		});
		
	});
	
});

//-->
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend><?php echo JText::_('Details'); ?></legend>
    <table class="admintable">
      <tr>
        <td width="100" align="right" class="key"><?php echo JText::_('Published'); ?></td>
        <td><?php echo $this->lists['published']; ?></td>
      </tr>
      <tr>
        <td width="100" align="right" class="key"><?php echo JText::_('Name'); ?></td>
        <td><input class="text_area" type="text" name="name" id="name" value="<?php echo $this->row->name; ?>" size="50" maxlength="250" /></td>
      </tr>
      <tr>
        <td width="100" align="right" class="key"><?php echo JText::_('Group'); ?></td>
        <td><?php echo $this->lists['group']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="groupContainer" style="display:inline"><strong><?php echo JText::_('New group name:');?></strong>  <input id="group" type="text" name="group" value="<?php echo $this->row->group;?>" /></div></td>
      </tr>
      <tr>
        <td width="100" align="right" class="key"><?php echo JText::_('Type'); ?></td>
        <td><?php echo $this->lists['type']; ?></td>
      </tr>
      <tr>
        <td width="100" align="right" class="key"><?php echo JText::_('Values'); ?></td>
        <td><div id="exFieldsTypesDiv"></div></td>
      </tr>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id;?>" />
  <input type="hidden" name="isNew" id="isNew" value="<?php echo ($this->row->group)?'0':'1';?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
  <input type="hidden" id="value" name="value" value="<?php echo htmlentities($this->row->value);?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
