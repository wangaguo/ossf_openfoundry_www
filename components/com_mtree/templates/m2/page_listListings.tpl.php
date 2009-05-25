<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php echo $this->title ?></h2>

<div id="listings">
<div class="title"><?php echo $this->_MT_LANG->LISTINGS; ?><?php echo $this->plugin('showrssfeed',$this->task); ?></div>

<?php if( isset($this->pageNav) && $this->pageNav->total > $this->pageNav->limit ) { ?>
<div class="pages-counter-top"><?php echo $this->pageNav->writePagesCounter(); ?></div>
<?php } 

	foreach ($this->links AS $link) {
		$fields = $this->fields[$link->link_id];
		include $this->loadTemplate('sub_listingSummary.tpl.php');
	}
	
	if( isset($this->pageNav) && $this->pageNav->total > $this->pageNav->limit ) { ?>
	<div class="pages-counter"><?php echo $this->pageNav->writePagesCounter(); ?></div>
	<div class="pages-links"><?php echo  $this->pageNav->writePagesLinks("index.php?option=$this->option&amp;task=$this->task&amp;cat_id=$this->cat_id&amp;Itemid=$this->Itemid") ?></div>
	<?php }
	
?></div>