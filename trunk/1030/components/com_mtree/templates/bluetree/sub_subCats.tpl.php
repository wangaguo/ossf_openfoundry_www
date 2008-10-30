		<?php if (is_array($this->categories) && !empty($this->categories)): ?>
		<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2" class="sectiontableheader"><?php echo $this->_MT_LANG->CATEGORIES; ?></td></tr>
		</table>
		<br />
		<center>
		<table border="0" cellpadding="5" cellspacing="0" width="95%">
			<?php 
				$i = 0;
				
				#
				# Sub Categories
				#

				foreach ($this->categories as $cat): 
					if ( ($i % 2) == 0) echo '<tr>';
			?>	
				<td width="50%" valign="top" align="left">
					<b><?php $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$cat->cat_id&Itemid=$this->Itemid", $cat->cat_name, (($cat->cat_featured) ? 'class="subCatFeatured"' : 'class="subCatNormal"') ); ?></b><?php
					
					if( $this->display_cat_count_in_subcat ) {
						$count[] = $cat->cat_cats;
					}
					if( $this->display_listing_count_in_subcat ) {
						$count[] = $cat->cat_links;
					}
					
					if( !empty($count) ) {
						echo ' <small>('.implode('/',$count).')</small>';
						unset($count);
					}

					?>					
					<br />
					<?php 
						if ( isset($this->sub_cats) && count($this->sub_cats[$cat->cat_id]) > 0 ): 
							$j = 0;
					?>
						<?php foreach ($this->sub_cats[$cat->cat_id] AS $sub_cat): ?>
							<?php 
							$this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$sub_cat->cat_id&Itemid=$this->Itemid", $sub_cat->cat_name);
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
					if ( ($i++ % 2) == 1) echo '</tr>';
				endforeach; 
			?>
		</table>
		</center>
		<br />
		<?php endif; ?>

		<?php
				#
				# Related Categories
				#

				if ( count($this->related_categories) > 0 ):
		?>
		<table border="0" cellpadding="5" cellspacing="0" width="100%">
			<tr><td colspan="2"></td></tr>
			<tr><td colspan="2" class="sectiontableheader"><?php echo $this->_MT_LANG->RELATED_CATEGORIES; ?></td></tr>
		</table>
		<br />

		<center>
		<table border="0" cellpadding="5" cellspacing="0" width="95%">
			<?php
				foreach( $this->related_categories AS $related_category ) {
			?>
			<tr><td colspan="2" align="left">
				<?php 
				$this->plugin('ahref', "index.php?option=com_mtree&task=listcats&cat_id=".$related_category."&Itemid=$this->Itemid", $this->pathway->printPathWayFromCat_withCurrentCat( $related_category ), 'class="relCat"'); ?>
			</td></tr>
			<?php
				}
			?>
		</table>
		</center>
			<?php
				endif;
			?>
		<br />
