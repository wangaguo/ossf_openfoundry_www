<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<div id="listing" class="gallery">
<h2><?php 
$link_name = $this->fields->getFieldById(1);
$this->plugin( 'ahreflisting', $this->link, $link_name->getOutput(1), '', array("delete"=>true) ) ?></h2>
<?php
foreach($this->images AS $image) {

	echo '<div class="thumbnail" style="width:' . ($this->config->get('resize_listing_size') + 10) . 'px;height:' . ($this->config->get('resize_listing_size') + 10) . 'px">';
	echo '<a href="'. sefReltoAbs('index.php?option=com_mtree&task=viewimage&img_id=' . $image->img_id . '&Itemid=' . $this->Itemid ) . '">';
	echo $this->plugin( 'mt_image', $image->filename, '3' );
	echo '</a>';
	echo '</div>';
	
}
?><br clear="both" />
<center><a href="<?php echo sefReltoAbs('index.php?option=com_mtree&task=viewlink&link_id=' . $this->link_id . '&Itemid=' . $this->Itemid ) ?>"><?php echo $this->_MT_LANG->BACK_TO_LISTING ?></a></center>

</div>