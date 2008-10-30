<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr>
		<td class="contentheading"><?php echo $this->cat_name ?></td>
	</tr>
	
	<tr>
		<td align="left">
		
			<?php if (isset($this->cat_image) && $this->cat_image <> ''): ?>
			<?php $this->plugin( 'image', $this->cat_image_dir.$this->cat_image, '', '', '', 'class="catPhoto"' ); ?>
			<?php endif; ?>

			<?php if ( isset($this->cat_desc) && $this->cat_desc <> ''): ?>
			<?php echo $this->cat_desc ?>
			<br />
			<?php endif; ?>
			
		</td>
	</tr>
</table>	

<?php include $this->loadTemplate( 'sub_subCats.tpl.php' ) ?>

<?php if( $this->cat_show_listings ) include $this->loadTemplate( 'sub_listings.tpl.php' ) ?>