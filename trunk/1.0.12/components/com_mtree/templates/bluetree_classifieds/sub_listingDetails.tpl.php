<?php
/*
# Printing Custom Field #1's caption
echo "<br />".$this->custom_fields["cust_1"]->caption;

# Printing Custom Field #1's value
echo "<br />".$this->link->cust_1;
*/
?>
<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
	<tr>
		<td class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></td>
	</tr>
	<tr>
		<td class="contentheading"><?php $this->plugin( 'ahreflisting', $this->link, 'class="listingName"', array("delete"=>true) ) ?></td>
<!--		<td class="contentheading"><?php //$this->plugin( 'listingname', $this->link) ?></td>-->
	</tr>
</table>

<table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">

	<?php if ( !empty($this->mambotAfterDisplayTitle) ): 
			echo trim( implode( "\n", $this->mambotAfterDisplayTitle ) );
		endif;
	?>

	<tr>
		<td>
			<br />
			<?php 
				if ( !empty($this->mambotBeforeDisplayContent) && $this->mambotBeforeDisplayContent[0] <> '' ): 
					echo trim( implode( "\n", $this->mambotBeforeDisplayContent ) );
				endif;
			?>

			<?php if ($this->link->link_image): 
					$this->plugin( 'image', $this->listing_image_dir.$this->link->link_image, '', '', '', 'class="listingPhoto"' );
			endif; ?>
			<span class="detailsText"><?php echo $this->link->text ?></span>

			<?php 
				if ( !empty($this->mambotAfterDisplayContent) ): 
					echo trim( implode( "\n", $this->mambotAfterDisplayContent ) );
				endif;
			?>

		</td>
	</tr>
	<tr>
		<td align="left">
		<div style="overflow:auto">
		<?php //$this->plugin( 'ahrefreview', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefrating', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefrecommend', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefprint', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefcontact', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefreport', $this->link, 'class="bulletData"') ?>
                <?php//// $this->plugin( 'ahrefweblink', $this->link, 'class="bulletData"') ?>
                <?php //$this->plugin( 'ahrefDownload', $this->link, 'class="bulletData"') ?> 
                <?php //$this->plugin( 'ahrefLicense', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefclaim', $this->link, 'class="bulletData"') ?>
		<?php ////$this->plugin( 'ahrefownerlisting', $this->link, 'class="bulletData"') ?>
		<?php //$this->plugin( 'ahrefmap', $this->link, 'class="bulletData"') ?>

		</div>
		</td>
	</tr>
</table>

<br />
