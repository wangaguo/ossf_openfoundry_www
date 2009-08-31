<tr class="sectiontableentry<?php echo ( ($i % 2) == 0 ) ? 1 : 4 ?>"> 
	<td class="listingBorder_clas">
		<?php //$this->plugin( 'ahreflisting', $link, 'class="listingName"', array("delete"=>true) ) ?>
		<?php $this->plugin( 'ahreflisting', $link, 'class="listingName"', array("delete"=>true) ) ?>
		<br />
		<?php echo $link->text ?><br>
		<?php// echo substr($link->text,0,$this->max_chars) . ( ((strlen($link->text)) > $this->max_chars) ? ' <b>...</b>' : '' ) ?>
              <?php $this->plugin( 'ahrefreview', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefrating', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefrecommend', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefprint', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefcontact', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefreport', $link, 'class="bulletData"') ?>
              <?php //$this->plugin( 'ahrefweblink', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefDownload', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefLicense', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefclaim', $link, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefvisit', $link, '', 1, 'class="bulletData"') ?>
              <?php $this->plugin( 'ahrefmap', $link, 'class="bulletData"') ?>
		<br />
		<br />
	</td>
<!--	<td class="listingBorder2_clas"><?php //echo ($link->state) ? $link->state : '&nbsp;' ?>
	</td>
	<td class="listingBorder3_clas"><?php// echo ($link->price) ? '$'. $link->price : '&nbsp;' ?></td>-->

</tr>
