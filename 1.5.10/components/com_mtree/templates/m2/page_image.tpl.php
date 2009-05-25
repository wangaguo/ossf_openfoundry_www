<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<div id="listing">
	<h2><?php 
	$link_name = $this->fields->getFieldById(1);
	$this->plugin( 'ahreflisting', $this->link, $link_name->getOutput(1), '', array("delete"=>true) ) ?></h2>

<div class="next-previous-image"><?php
echo '<div class="previous-image">';
if($this->image->ordering > 1) {
	echo '<a href="'. sefReltoAbs('index.php?option=com_mtree&task=viewimage&img_id=' . $this->images[$this->image->ordering -2]->img_id . '&Itemid=' . $this->Itemid ) . '">';
	echo $this->_MT_LANG->PREVIOUS_IMAGE;
	echo '</a>';
}
echo '</div>';

echo '<div class="next-image">';
if(count($this->images) > $this->image->ordering) {
	echo '<a href="'. sefReltoAbs('index.php?option=com_mtree&task=viewimage&img_id=' . $this->images[$this->image->ordering]->img_id . '&Itemid=' . $this->Itemid ) . '">';
	echo $this->_MT_LANG->NEXT_IMAGE;
	echo '</a>';
}
echo '</div>';
echo '</div>';

echo '<div class="medium-image">';
echo $this->plugin( 'mt_image', $this->image->filename, '2' ); 
echo '</div>';

echo '<div class="next-previous-image">';
echo '<div class="previous-image">';
if($this->image->ordering > 1) {
	echo '<a href="'. sefReltoAbs('index.php?option=com_mtree&task=viewimage&img_id=' . $this->images[$this->image->ordering -2]->img_id . '&Itemid=' . $this->Itemid ) . '">';
	echo $this->_MT_LANG->PREVIOUS_IMAGE;
	echo '</a>';
}
echo '</div>';

echo '<div class="next-image">';
if(count($this->images) > $this->image->ordering) {
	echo '<div class="next-image"><a href="'. sefReltoAbs('index.php?option=com_mtree&task=viewimage&img_id=' . $this->images[$this->image->ordering]->img_id . '&Itemid=' . $this->Itemid ) . '">';
	echo $this->_MT_LANG->NEXT_IMAGE;
	echo '</a>';
	echo '</div>';
}
echo '</div>';
echo '</div>';
?>
<br clear="both" /><p />
<center><?php
	if(count($this->images) == 1) {
		echo '<a href="' . sefReltoAbs('index.php?option=com_mtree&task=viewlink&link_id=' . $this->link_id . '&Itemid=' . $this->Itemid ) . '">' . $this->_MT_LANG->BACK_TO_LISTING . '</a>';
	} else {
		echo '<a href="' . sefReltoAbs('index.php?option=com_mtree&task=viewgallery&link_id=' . $this->link_id . '&Itemid=' . $this->Itemid ) . '">' . $this->_MT_LANG->BACK_TO_GALLERY . '</a>';
	}
?></center>
</div>