<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>

<?php if( $this->config->getTemParam('displayAlphaIndex','1') ) { $this->display( 'sub_alphaIndex.tpl.php' ); } 

if ( count($this->categories) > 0 || count($this->links) > 0) {

	if ( count($this->categories) > 0 ) { include $this->loadTemplate( 'sub_subCats.tpl.php' ); } 
	
	if (is_array($this->links) && !empty($this->links)) {

		?><div id="listings">
		<div class="title"><?php echo $this->_MT_LANG->LISTINGS; ?></div>
		<div class="pages-counter-top"><?php echo $this->pageNav->writePagesCounter(); ?></div>
		<?php
		foreach ($this->links AS $link) {
			$fields = $this->fields[$link->link_id];
			include $this->loadTemplate('sub_listingSummary.tpl.php');
		}

		if( $this->pageNav->total > $this->pageNav->limit ) { 
			?><div class="pages-counter"><?php echo $this->pageNav->writePagesCounter(); ?></div>
			<div class="pages-links"><?php echo $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=listalpha&amp;alpha=$this->alpha&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?></div>
		<?php
		} 
		?></div><?php
	} 
} else {
	?><center><?php echo sprintf($this->_MT_LANG->THERE_ARE_NO_CAT_OR_LISTINGS, ( (is_numeric($this->alpha)) ? $this->_MT_LANG->NUMBER : strtoupper($this->alpha)) )?></center><?php 
}
?>
