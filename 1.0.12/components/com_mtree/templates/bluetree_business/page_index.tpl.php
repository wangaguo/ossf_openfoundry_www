<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>

	<?php if( $this->display_alpha_index ) { ?>
	<tr><td align="center"><center><?php $this->display( 'sub_alphaIndex.tpl.php' ) ?></center></td></tr>
	<?php } ?>
	
	<tr><td class="contentheading"><?php echo $this->_MT_LANG->CATEGORIES; ?></td></tr>

	<tr>
		<td align="center">
		<?php if (is_array($this->categories)): ?>
		<center>
		<table border="0" cellpadding="4" cellspacing="0" width="90%">
			
			<?php 
				$i = 0;
				foreach ($this->categories as $cat): 
					if ( ($i % 3) == 0) echo '<tr>';
			?>	
				<td width="33%" valign="top" align="left">
					<b><?php $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$cat->cat_id&Itemid=$this->Itemid", $cat->cat_name, 'class="indexCat"'); ?></b><?php

					if($this->display_cat_count_in_root) {
						$count[]=$cat->cat_cats;
					}
					if($this->display_listing_count_in_root) {
						$count[]=$cat->cat_links;
					}

					if( !empty($count) ) {
						echo ' ('.implode('/',$count).')';
						unset($count);
					}

					?><br />
					<?php 
						if (count($this->sub_cats[$cat->cat_id]) > 0): 
							$j = 0;
					?>
						<?php foreach ($this->sub_cats[$cat->cat_id] AS $sub_cat): ?>
							<?php $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$sub_cat->cat_id&Itemid=$this->Itemid", $sub_cat->cat_name, 'class="indexSubCat"'); 
							$j++;
							if ($this->sub_cats_total[$cat->cat_id] > $j) {
								if ($j >= $this->num_of_subcats_to_show) {
									echo '...';
								} else {
									echo ', ';
								}
							} elseif($this->sub_cats_total[$cat->cat_id] == $j) {
								// No more sub-categories
							} 
							endforeach; 
						?>
					<?php endif; ?>
				</td>
			<?php 
					if ( ($i++ % 3) == 2) echo '</tr>';
				endforeach; 
			?>

		</table>
		</center>
		<?php endif; ?>
		
		</td>
	</tr>
</table>

<br />
<?php if( $this->display_listings_in_root ) include $this->loadTemplate( 'sub_listings.tpl.php' ) ?>