<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<div id="listing">
<h2><?php 
$link_name = $this->fields->getFieldById(1);
$this->plugin( 'ahreflisting', $this->link, $link_name->getOutput(1), '', array("delete"=>true) ) ?></h2>
<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane">
	<tr>
		<td>
		<br />
		<center><strong><?php echo $this->error_msg ?></strong></center>
		<p />
		<center><?php $this->plugin('ahref', "index.php?option=com_mtree&task=viewlink&link_id=$this->link_id&Itemid=$this->Itemid", $this->_MT_LANG->BACK_TO_LISTING); ?></center>
		</td>
	</tr>
</table>
</div>