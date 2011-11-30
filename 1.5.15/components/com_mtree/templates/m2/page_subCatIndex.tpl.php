 
<h2 class="contentheading"><?php echo htmlspecialchars($this->cat_name) ?></h2>

<?php
if ( (isset($this->cat_image) && $this->cat_image <> '') || (isset($this->cat_desc) && $this->cat_desc <> '') ) {
	echo '<div id="cat-desc">';
	if (isset($this->cat_image) && $this->cat_image <> '') {
		echo '<div id="cat-image">';
		$this->plugin( 'image', $this->config->getjconf('live_site').$this->config->get('relative_path_to_cat_small_image') . $this->cat_image , $this->cat_name, '', '', '' );
		echo '</div>';
	}
	if ( isset($this->cat_desc) && $this->cat_desc <> '') {	echo '<p>' . $this->cat_desc . '</p>'; }
	echo '</div>';
}
?>

<?php include $this->loadTemplate( 'sub_subCats.tpl.php' ) ?>
<div id="listings">
        <div class="title"><?php echo JText::_( 'Teaching material' ); ?></div>

        <div class="rt-pagination">
                <?php echo $this->pageNav->getPagesLinks(); ?>
                <p class="pagescounter"><?php #echo $this->pageNav->getResultsCounter(); ?></p>
        </div>

        <?php
        foreach ($this->links AS $link) {
                $fields = $this->fields[$link->link_id];
                include $this->loadTemplate('sub_listingSummary.tpl.php');


        }
        if( $this->pageNav->total > $this->pageNav->limit ) { ?>
        <div class="rt-pagination">
                <?php echo $this->pageNav->getPagesLinks(); ?>
                <p class="pagescounter"><?php echo $this->pageNav->getResultsCounter(); ?></p>
        </div>
        <?php
        }?>


</div>
<?php# if( $this->cat_show_listings ) include $this->loadTemplate( 'sub_listings.tpl.php' ) ?>
