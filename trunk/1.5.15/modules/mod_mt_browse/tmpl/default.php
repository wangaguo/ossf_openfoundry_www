<?php defined('_JEXEC') or die('Restricted access'); ?>
<span class="breadcrumbs pathway">
	<a  class="pathway" href="<?php echo $root->link; ?>"><?php echo $root->name; ?></a>
		<?php
		// Print subcategories
		if( !is_null( $pathway ) ): foreach( $pathway AS $pcat ):
		?>
			<a href="<?php echo $pcat->link; ?>" class="<?php echo $currentcat_class; ?>"><?php echo $pcat->cat_name; ?></a>
		<?php 
		endforeach;	endif;

		// Print Current category
		if ( !is_null($cat) ):
		?>
			<a href="<?php echo $cat->link; ?>" class="<?php echo $subcat_class; ?>"><?php echo $cat->cat_name; ?></a>
		<?php
		endif;
	
		// Print subcategories
	
		if ( !is_null($cat) ):
			?>
			<?php if( !empty($cats) ): ?>
			<?php endif;
		endif;
	
		$pathway_count = count($pathway);
		for( $i=0; $i<$pathway_count; $i++ ) {
			echo '';
		}
		?>
</span>
