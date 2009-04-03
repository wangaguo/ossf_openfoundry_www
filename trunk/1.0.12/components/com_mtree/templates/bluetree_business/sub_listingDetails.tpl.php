<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr>
		<td class="contentheading"><?php $this->plugin( 'listingname', $this->link) ?></td>
	</tr>
</table>

<center>
<div class="mtframe">

		<?php if ( !empty($this->mambotAfterDisplayTitle) ): 
				echo trim( implode( "\n", $this->mambotAfterDisplayTitle ) );
			endif;
		?>
		<?php 
			if ( !empty($this->mambotBeforeDisplayContent) && $this->mambotBeforeDisplayContent[0] <> '' ): 
				echo trim( implode( "\n", $this->mambotBeforeDisplayContent ) );
			endif;
		?>

		<?php
			if ( !empty($this->link->address) || !empty($this->link->city) || !empty($this->link->state) || !empty($this->link->country) || !empty($this->link->postcode) || !empty($this->link->telephone) || !empty($this->link->fax) || !empty($this->link->email) || !empty($this->link->website) ) {
		?>
			<p />
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr><td>

					<?php 
					if ( !empty($this->link->address) || !empty($this->link->city) || !empty($this->link->state) || !empty($this->link->country) || !empty($this->link->postcode) ) {
					?>
					<div class="detailsAddress">
					<?php
						// Printing address
						if (!empty($this->link->address)) echo $this->link->address . ',<br />';
								
						// Printing city and state
						if ( !empty($this->link->city) && !empty($this->link->state) && !empty($this->link->postcode) ) {
							echo $this->link->postcode .', '. $this->link->city .',<br />'.$this->link->state . ',<br />';
						} elseif ( !empty($this->link->city) && !empty($this->link->postcode) ) {
							echo $this->link->postcode .', '.$this->link->city.',<br />';
						} elseif ( !empty($this->link->city) && !empty($this->link->state) ) {
							echo $this->link->city .', '.$this->link->state.',<br />';
						} elseif ( !empty($this->link->postcode) && !empty($this->link->state) ) {
							echo $this->link->postcode .', '.$this->link->state.',<br />';
						} elseif ( !empty($this->link->state) ) {
							echo $this->link->state .',<br />';
						} elseif ( !empty($this->link->city) ) {
							echo $this->link->city .',<br />';
						}

						// Printing Country and Postcode
						if ( !empty($this->link->country) ) {
							echo $this->link->country .'<br />';
						} 
							
						$this->plugin( 'ahrefmap', $this->link, 'class="website"', 0);
					?>
					</div>
					<?php } ?>

					<div class="detailsContact">
						<?php
						if ( !empty($this->link->telephone) ) echo $this->_MT_LANG->TELEPHONE.": ".$this->link->telephone."<br />";
						if ( !empty($this->link->fax) ) echo $this->_MT_LANG->FAX.": ".$this->link->fax."<br />";
						if ( !empty($this->link->email) && ($this->mt_show_email == 1) ) echo $this->_MT_LANG->EMAIL.": <a href=\"mailto:".$this->link->email."\" class=\"website\">". $this->link->email ."</a><br />";
						if ( !empty($this->link->website) ) echo "<a href=\"".sefRelToAbs("index.php?option=com_mtree&task=visit&link_id=".$this->link->link_id)."\" class=\"website\" target=\"_blank\">".$this->_MT_LANG->WEBSITE."</a><br />";
						?>
					</div>

				</td></tr>
			</table>
			<?php } ?>

			<div class="detailsText">
			<?php if ($this->link->link_image): 
			if ( !empty($this->link->website) ) echo "<a href=\"".sefRelToAbs("index.php?option=com_mtree&task=visit&link_id=".$this->link->link_id)."\" class=\"website\" target=\"_blank\">";
			$this->plugin( 'image', $this->listing_image_dir.$this->link->link_image, '', '', '', 'class="listingPhoto"' );
			if ( !empty($this->link->website) ) echo "</a>";
			endif; ?>
			<?php echo $this->link->text ?>
			</div>

			<?php 
				if ( !empty($this->mambotAfterDisplayContent) ): 
					echo trim( implode( "\n", $this->mambotAfterDisplayContent ) );
				endif;
			?>

	<p />

		<?php $this->plugin( 'ahrefreview', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefrating', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefrecommend', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefprint', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefreport', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefclaim', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefownerlisting', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefcontact', $this->link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefmap', $this->link, 'class="bulletData"'); ?>
</div>
</center>
<br style="clear:both" />