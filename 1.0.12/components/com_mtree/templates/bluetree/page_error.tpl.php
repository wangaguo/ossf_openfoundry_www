<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane">
	<tr>
		<td><span class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></span></td>
	</tr>
	<tr>
		<td class="contentheading"><?php echo $this->_MT_LANG->ERROR ?></td>
	</tr>
	<tr>
		<td><?php echo $this->pathway->printPathWayWithCurrentCat( 0, "index.php?option=com_mtree&task=listcats&Itemid=$this->Itemid" ) ?></td>
	</tr>
	<tr>
		<td class="sectiontableheader"><?php echo $this->_MT_LANG->ERROR ?></td>
	</tr>
	<tr>
		<td><br /><center><?php echo $this->error_msg ?></center></td>
	</tr>
</table>