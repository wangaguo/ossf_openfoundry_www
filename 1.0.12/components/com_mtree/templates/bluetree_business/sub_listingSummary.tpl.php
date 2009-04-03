		<?php if ($link->link_featured): ?>
		<table width="100%" cellspacing="10" class="featuredHiLight">
			<tr><td>
		<?php endif; ?>
		
		<?php if ($link->link_image): ?>
		<?php $this->plugin( 'ahreflistingimage', $link, 'align="left" class="listingPhoto_bus" alt="'.htmlspecialchars($link->link_name).'"' ) ?>
		<?php endif; ?>

		<?php $this->plugin( 'ahreflisting', $link, 'class="listingName"', array("delete"=>true) ) ?>
		<?php $this->plugin( 'rating', $link->link_rating, $link->link_votes, $link->attribs) ?>
		

		<?php
			if ( !empty($link->address) || !empty($link->city) || !empty($link->state) || !empty($link->country) || !empty($link->postcode) || !empty($link->telephone) || !empty($link->fax) || !empty($link->email) || !empty($link->website) ) {
		?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr><td>
				<?php
					if ( !empty($link->address) || !empty($link->city) || !empty($link->state) || !empty($link->country) || !empty($link->postcode) ) {
				?>
				<div class="detailsAddress">
					<?php 
					
					// Printing address
					if (!empty($link->address)) echo $link->address . ',<br />';
					
					// Printing city and state
					if ( !empty($link->city) && !empty($link->state) && !empty($link->postcode) ) {
						echo $link->postcode .', '. $link->city .',<br />'.$link->state . ',<br />';
					} elseif ( !empty($link->city) && !empty($link->postcode) ) {
						echo $link->postcode .', '.$link->city.',<br />';
					} elseif ( !empty($link->city) && !empty($link->state) ) {
						echo $link->city .', '.$link->state.',<br />';
					} elseif ( !empty($link->postcode) && !empty($link->state) ) {
						echo $link->postcode .', '.$link->state.',<br />';
					} elseif ( !empty($link->state) ) {
						echo $link->state .',<br />';
					} elseif ( !empty($link->city) ) {
						echo $link->city .',<br />';
					}

					// Printing Country and Postcode
					if ( !empty($link->country) ) {
						echo $link->country .'<br />';
					} 
					
					$this->plugin( 'ahrefmap', $link, 'class="website"', 0);
					?>
				</div>
				<?php } ?>

				<div class="detailsContact">
					<?php
					if ( !empty($link->telephone) ) echo $this->_MT_LANG->TELEPHONE.": ".$link->telephone."<br />";
					if ( !empty($link->fax) ) echo $this->_MT_LANG->FAX.": ".$link->fax."<br />";
					if ( !empty($link->email) && ($this->mt_show_email == 1) ) echo $this->_MT_LANG->EMAIL.": ". "<a href=\"mailto:".$link->email."\" class=\"website\">".$link->email."</a>"  ."<br />";
					if ( !empty($link->website) ) echo "<a href=\"".sefRelToAbs("index.php?option=com_mtree&task=visit&link_id=".$link->link_id)."\" target=\"_blank\" class=\"website\">".$this->_MT_LANG->WEBSITE."</a><br />";
					?>
				</div>

			</td></tr>
			</table>
			<?php } ?>

			<div class="listingSummary">
			<?php echo substr($link->text,0,$this->max_chars) . ( ((strlen($link->text)) > $this->max_chars) ? ' <b>...</b>' : '' ) ?>
			</div>

		<?php 
			global $task; 
			if ( isset($task) && $task <> 'listcats' && $task <> '' ) { 
		?>
		<div class="listingCat">
		<?php echo $this->_MT_LANG->CATEGORY . ': ' ?><?php $this->plugin( 'mtpath', $link->cat_id, 'class="category"' ) ?>
		</div>
		<?php } ?>
		
		<div style="overflow: auto">
		<?php $this->plugin( 'ahrefreview', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefrating', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefrecommend', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefprint', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefreport', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefclaim', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefcontact', $link, 'class="bulletData"') ?>
		<?php $this->plugin( 'ahrefmap', $link, 'class="bulletData"') ?>
		</div>

		<?php if ($link->link_featured): ?>
			</td></tr>
		</table>
		<?php else: ?>
		<div class="dottedLine" />
		<?php endif; ?>

