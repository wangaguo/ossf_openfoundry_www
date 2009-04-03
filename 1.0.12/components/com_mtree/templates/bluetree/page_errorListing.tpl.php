<?php include $this->loadTemplate( 'sub_listingDetails.tpl.php' ) ?>

<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane">
	<tr>
		<td>
		<br />
		<center>
		<strong><?php echo $this->error_msg ?></strong>
		<p />
		<?php $this->plugin('ahref', "index.php?option=com_mtree&task=viewlink&link_id=$this->link_id&Itemid=$this->Itemid", $this->_MT_LANG->BACK_TO_LISTING); ?>		
		</center>
		</td>
	</tr>
</table>	