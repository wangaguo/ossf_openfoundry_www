<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr>
		<td class="contentheading"><?php $this->plugin( 'listingname', $this->link) ?></td>
	</tr>

	<?php if ( !empty($this->mambotAfterDisplayTitle) ): 
			echo trim( implode( "\n", $this->mambotAfterDisplayTitle ) );
		endif;
	?>

	<tr>
		<td>

			<?php 
				if ( !empty($this->mambotBeforeDisplayContent) && $this->mambotBeforeDisplayContent[0] <> '' ): 
					echo trim( implode( "\n", $this->mambotBeforeDisplayContent ) );
				endif;
			?>

			<?php if ($this->link->link_image): 
					echo "<center>";
					$this->plugin( 'image', $this->listing_image_dir.$this->link->link_image, '', '', '', 'class="listingPhoto"' );
					echo "</center>";
			endif; ?>
		</td>
	</tr>
	<tr>
		<td>
			
			<center>
			<table cellpadding="4" cellspacing="0" border="0" width="96%">
				<tr><td class="sectiontableheader2" align="left" colspan="2"><?php echo $this->_MT_LANG->PRODUCT_DETAILS ?></td></tr>
				<tr class="sectiontableentry3">
					<td width="30%" align="left" valign="top"><b><?php echo $this->_MT_LANG->COUNTRY ?>:</b></td>
					<td width="70%" align="left"><?php echo $this->link->country ?></td>
				</tr>
				<tr class="sectiontableentry4">
					<td align="left" valign="top"><b><?php echo $this->_MT_LANG->LOCATION ?>:</b></td>
					<td align="left"><?php echo $this->link->city . '/' . $this->link->state ?></td>
				</tr>

				<tr class="sectiontableentry3">
					<td align="left"><b><?php echo $this->_MT_LANG->TELEPHONE ?>:</b></td>
					<td align="left"><?php echo $this->link->telephone ?></td>
				</tr>
				<tr class="sectiontableentry4">
					<td align="left"><b><?php echo $this->_MT_LANG->FAX ?>:</b></td>
					<td align="left"><?php echo $this->link->fax ?></td>
				</tr>

				<tr class="sectiontableentry3">
					<td align="left"><b><?php echo $this->_MT_LANG->PRICE ?>:</b></td>
					<td align="left"><b>$<?php echo $this->link->price ?></b></td>
				</tr>
				<tr class="sectiontableentry4">
					<td align="left"><b><?php echo $this->_MT_LANG->HITS ?>:</b></td>
					<td align="left"><?php echo $this->link->link_hits ?></td>
				</tr>
				<tr>
					<td colspan="2">
						<h2>Remarks</h2>
						<?php echo $this->link->text ?>

						<?php 
							if ( !empty($this->mambotAfterDisplayContent) ): 
								echo trim( implode( "\n", $this->mambotAfterDisplayContent ) );
							endif;
						?>

						<br /><br />
						<div align="right">
						<small>(<?php echo $this->_MT_LANG->ADDED ?>: <?php echo $this->link->link_created ?>-<?php echo $this->_MT_LANG->MODIFIED ?>: <?php echo $this->link->link_modified ?>)</small>
						</div>

					</td>
				</tr>

				<tr>
					<td colspan="2" align="center">
					<br />
					<div style="overflow:auto">
					<?php $this->plugin( 'ahrefrecommend', $this->link, 'class="bulletData"') ?>
					<?php $this->plugin( 'ahrefprint', $this->link, 'class="bulletData"') ?>
					<?php $this->plugin( 'ahrefcontact', $this->link, 'class="bulletData"') ?>
					<?php $this->plugin( 'ahrefreport', $this->link, 'class="bulletData"') ?>
					<?php $this->plugin( 'ahrefownerlisting', $this->link, 'class="bulletData"') ?>
					</div>
					</td>
				</tr>

			</table>
			</center>

		</td>
	</tr>

</table>

