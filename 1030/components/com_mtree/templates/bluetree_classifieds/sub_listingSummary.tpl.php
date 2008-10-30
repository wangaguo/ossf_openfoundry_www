<tr class="sectiontableentry<?php echo ( ($i % 2) == 0 ) ? 1 : 4 ?>"> 
	<td class="listingBorder_clas">
		<?php $this->plugin( 'ahreflisting', $link, 'class="listingName"', array("delete"=>true) ) ?>
		<br />
		<?php echo substr($link->text,0,$this->max_chars) . ( ((strlen($link->text)) > $this->max_chars) ? ' <b>...</b>' : '' ) ?><br /><br />
	</td>
	<td class="listingBorder2_clas"><b><?php echo ($link->state) ? $link->state : '&nbsp;' ?></b></td>
	<td class="listingBorder3_clas"><?php echo ($link->price) ? '$'. $link->price : '&nbsp;' ?></td>
</tr>