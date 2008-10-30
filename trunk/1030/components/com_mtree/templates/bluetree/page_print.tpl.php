<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td width="100%" class="contentheading"><?php $this->plugin( 'listingname', $this->link) ?></td>
		<td><a href="#" onclick="javascript:window.print(); return false" title="Print"><img src="images/M_images/printButton.png" alt="<?php echo $this->_MT_LANG->PRINT ?>" align="middle" name="image" border="0" /></a></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="right"><?php echo $this->_MT_LANG->HITS ?>: <?php echo $this->link->link_hits ?></div>
			<center><?php if ($this->link->link_image) $this->plugin( 'image', $this->listing_image_dir.$this->link->link_image, '', '', '', 'class="printPhoto"' );?></center>
			<br />
			<?php echo $this->link->text ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<center>
			<table cellpadding="3" cellspacing="0" border="0" width="400">
				<tr><td class="sectiontableheader" align="left" colspan="2"><?php echo $this->_MT_LANG->MORE_DETAILS ?></td></tr>
				<tr class="sectiontableentry2">
					<td width="20%" align="left" valign="top"><b><?php echo $this->_MT_LANG->ADDRESS ?>:</b></td>
					<td width="80%" align="left">
						<?php echo $this->link->address ?><br />
						<?php echo $this->link->city ?><br />
						<?php echo $this->link->state ?> <?php echo $this->link->postcode ?><br />
						<?php echo $this->link->country ?><br />
					</td>
				</tr>
				<tr class="sectiontableentry1">
					<td align="left"><b><?php echo $this->_MT_LANG->TELEPHONE ?>:</b></td>
					<td align="left"><?php echo $this->link->telephone ?></td>
				</tr>
				<tr class="sectiontableentry2">
					<td align="left"><b><?php echo $this->_MT_LANG->FAX ?>:</b></td>
					<td align="left"><?php echo $this->link->fax ?></td>
				</tr>
				<tr class="sectiontableentry1">
					<td align="left"><b><?php echo $this->_MT_LANG->EMAIL ?>:</b></td>
					<td align="left"><?php echo $this->link->email ?></td>
				</tr>
				<tr class="sectiontableentry2">
					<td align="left"><b><?php echo $this->_MT_LANG->WEBSITE ?>:</b></td>
					<td align="left"><?php echo $this->link->website ?></td>
				</tr>
			</table>
			</center>
			<br />
			<div align="right">
			<small>(<?php echo $this->_MT_LANG->ADDED ?>: <?php echo $this->link->link_created ?>-<?php echo $this->_MT_LANG->MODIFIED ?>: <?php echo $this->link->link_modified ?>)</small>
			</div>
		</td>
	</tr>

	</tr>
</table>