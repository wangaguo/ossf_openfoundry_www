<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		form.task.value=pressbutton;
		form.submit();
		}
</script>
<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php echo $this->_MT_LANG->ADVANCED_SEARCH ?></h2>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
	<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" name="adminForm" id="adminForm">
	<tr>
		<td colspan="2"><?php printf($this->_MT_LANG->RETURN_RESULTS_IF_X_OF_THE_FOLLOWING_CONDITIONS_ARE_MET,$this->lists['searchcondition']); ?></td>
	</tr>
	<tr height="60">
		<td colspan="2">
		<input type="button" value="<?php echo $this->_MT_LANG->SEARCH ?>" onclick="javascript:submitbutton('advsearch2')" class="button" />	<input type="reset" value="<?php echo $this->_MT_LANG->RESET ?>" class="button" /></td>
	</tr>
	<tr>
		<td width="20%"><?php echo $this->_MT_LANG->CATEGORY ?>:</td>
		<td width="80%"><?php echo $this->catlist; ?></td>
	</tr>
	<?php
	while( $this->fields->hasNext() ) {
		$field = $this->fields->getField();
		if($field->hasSearchField()) {
			echo '<tr>';
			echo '<td width="20%" valign="top" align="left">' . $field->caption . ':' . '</td>';
			echo '<td width="80%" align="left">';
			echo $field->getSearchHTML();
			echo '</td>';
			echo '</tr>';
		}
		$this->fields->next();
	}
	?>
	<tr height="60">
		<td colspan="2">
		<input type="button" value="<?php echo $this->_MT_LANG->SEARCH ?>" onclick="javascript:submitbutton('advsearch2')" class="button" />	<input type="reset" value="<?php echo $this->_MT_LANG->RESET ?>" class="button" /></td>
	</tr>
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />
	<input type="hidden" name="option" value="com_mtree" />
	<input type="hidden" name="task" value="advsearch2" />
	</form>
</table>