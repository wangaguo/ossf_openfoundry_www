<?php if ($link->link_featured): ?>
		<table width="100%" cellspacing="10" class="featuredHiLight">
			<tr><td>
		<?php endif; ?>
		
		<?php if ($link->link_image): ?>
		<?php $this->plugin( 'ahreflistingimage', $link, 'class="listingPhoto" alt="'.htmlspecialchars($link->link_name).'"' ) ?>
		<?php endif; ?>
		
		<?php// $this->plugin( 'ahreflisting', $link, 'class="listingName"', array("delete"=>true) ) ?>
		<div class="listingName"><?php echo $link->link_name ?></div>

	            <div style="overflow:auto">
		    <?php $this->plugin( 'rating', $link->link_rating, $link->link_votes, $link->attribs) ?>
        	   
		    <?php $this->plugin( 'ahrefreview', $link, 'class="bulletData"') ?>
	            <?php $this->plugin( 'ahrefrating', $link, 'class="bulletData"') ?>
        	    <?php $this->plugin( 'ahrefrecommend', $link, 'class="bulletData"') ?>
	            <?php $this->plugin( 'ahrefprint', $link, 'class="bulletData"') ?>
        	    <?php $this->plugin( 'ahrefcontact', $link, 'class="bulletData"') ?>
	            <?php $this->plugin( 'ahrefreport', $link, 'class="bulletData"') ?>
        	    <?php $this->plugin( 'ahrefclaim', $link, 'class="bulletData"') ?>
	            <?php $this->plugin( 'ahrefownerlisting', $link, 'class="bulletData"') ?>
        	    <?php $this->plugin( 'ahrefmap', $link, 'class="bulletData"') ?>
	            </div>

		<!--weblink加連結 by ally 2007/07/05 -->
		<br /><div class="website"><b>Website:</b><a href="<?php echo $link->website ?>" target="black"><?php echo $link->website ?></a></div>

		<div class="listingSummary">
                <!--顯示全部的說明 by ally 2007/07/05 -->
		<?php// echo substr($link->text,0,$this->max_chars) . ( ((strlen($link->text)) > $this->max_chars) ? ' <b>...</b>' : '' ) ?>
		<?php echo $link->text ?>
		</div>
		<?php 
			global $task; 
			if ( isset($task) && $task <> 'listcats' && $task <> '' ) { 
		?>
		<div class="listingCat">
		<?php echo $this->_MT_LANG->CATEGORY . ': ' ?><?php $this->plugin( 'mtpath', $link->cat_id, 'class="category"' ) ?>
		</div>
		<?php } ?>
		<div class="listingData"><!-- Modify by ally -->
(<?php echo $this->_MT_LANG->HITS ?>: <?php echo $link->link_hits ?> | <?php echo $this->_MT_LANG->VOTES     ?>:     <?php echo $link->link_votes ?> | <?php echo $this->_MT_LANG->VISITED ?>: <?php echo $link->link_visited ?> | <?php echo     $this->_MT_LANG->ADDED ?>: <?php echo $link->link_created ?>)
		</div>

		<?php if ($link->link_featured): ?>
			</td></tr>
		</table>
		<?php else: ?>
		<div class="dottedLine" />
		<?php endif; ?>
