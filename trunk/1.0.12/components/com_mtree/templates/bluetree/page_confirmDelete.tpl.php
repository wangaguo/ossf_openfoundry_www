<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr>
		<td class="contentheading"><?php echo $this->link->link_name ?></td>
	</tr>
	<tr>
		<td><?php echo $this->pathway->printPathWayWithCurrentCat( 0, "index.php?option=com_mtree&task=listcats&Itemid=$this->Itemid" ) ?></td>
	</tr>
	<tr>
		<td class="sectiontableheader"><?php $this->plugin( 'ahreflisting', $this->link, null, array("delete" => false)) ?></td>
	</tr>
	<tr>
		<td>
			<br /><b><?php echo $this->_MT_LANG->CONFIRM_DELETE ?></b><br /><br />
			<center>
			<form action="<?php echo sefRelToAbs("index.php") ?>" method="post">
			<input type="submit" name="Submit" class="button" value="<?php echo $this->_MT_LANG->DELETE ?>" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
			<input type="hidden" name="option" value="com_mtree" />
			<input type="hidden" name="task" value="confirmdelete" />
			<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
			</form>
			</center>
		</td>
	</tr>

</table>