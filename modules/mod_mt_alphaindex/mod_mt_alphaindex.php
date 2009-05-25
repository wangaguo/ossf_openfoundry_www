<?php
/**
* Mosets Tree Alpha Index
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Get params
$moduleclass = $params->get( 'moduleclass', 'mainlevel' );
$direction = $params->get( 'direction', 'vertical' );
$show_number = $params->get( 'show_number', 1 );
$display_total_links = $params->get( 'display_total_links', 0 );
$show_empty = $params->get( 'show_empty', 0 );
$seperator = $params->get( 'seperator', '|' );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );

# Get Itemid, determine if the MT component is published
global $mt_itemid;
if(!isset($mt_itemid)) {
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$mt_itemid = $database->loadResult();
}

# Count total links
if ($display_total_links || !$show_empty) {
	global $mosConfig_offset;

	$total = array();	
	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

	// Count alphabet
	for($i=65; $i<=90; $i++) {

		$where = array();

		// Get Total results - Links
		$sql = "SELECT COUNT(*) FROM #__mt_links ";
		$where[] = "link_approved = '1'";
		$where[] = "link_published = '1'";
		$where[] = "( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )";
		$where[] = "( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )";
		$where[] = "link_name LIKE '".chr($i)."%'";
		
		$sql .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");

		$database->setQuery( $sql );
		$total[chr($i)] = $database->loadResult();
		
	}

	// Count Integers
	for( $i=48; $i <= 57; $i++) {
		$where = array();

		$sql = "SELECT COUNT(*) FROM #__mt_links ";
		$where[] = "link_approved = '1'";
		$where[] = "link_published = '1'";
		$where[] = "( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )";
		$where[] = "( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )";
		$where[] = "link_name LIKE '".chr($i)."%'";

		$sql .= (count( $where ) ? " WHERE " . implode( ' AND ', $where ) : "");

		$database->setQuery( $sql );
		$total[0] = $database->loadResult();

	}

}

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php

#****
# Output Vertically
#***

if ($direction == 'vertical') {

if ($show_number) {
	if ( $show_empty || ( !$show_empty && $total[0] > 0 ) ) {
?>
	<tr align="left">
		<td>
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listalpha&alpha=0&Itemid=$mt_itemid"); ?>" class="<?php echo $moduleclass ?>">0-9<?php
				if ($display_total_links) {
				echo " <small>(".$total[0].")</small>";
				}
			?></a>
		</td>
	</tr>
<?php
	}
}

	for($i=65; $i<=90; $i++) {
		if ( $show_empty || ( !$show_empty && $total[chr($i)] > 0 ) ) {
?>
	<tr align="left">
		<td>
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listalpha&alpha=".strtolower(chr($i))."&Itemid=$mt_itemid"); ?>" class="<?php echo $moduleclass ?>"><?php echo chr($i) ?><?php
				if ($display_total_links) {
				echo " <small>(".$total[chr($i)].")</small>";
				}
			?></a>
		</td>
	</tr>
<?php
		}

	}

} else {

#****
# Output Horizontally
#***

?>
<tr><td>
<?php

	if ($show_number) {
		if ( $show_empty || ( !$show_empty && $total[0] > 0 ) ) {
			?><a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listalpha&alpha=0&Itemid=$mt_itemid"); ?>">0-9<?php
			if ($display_total_links) {
				echo " <small>(".$total[0].")</small>";
			}
			?></a> <?php echo $seperator ?> <?php
		}
	}

	for($i=65; $i<=90; $i++) {
		if ( $show_empty || ( !$show_empty && $total[chr($i)] > 0 ) ) {
			?><a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listalpha&alpha=".strtolower(chr($i))."&Itemid=$mt_itemid"); ?>"><?php echo chr($i) ?><?php
			
			if ($display_total_links) {
				echo " <small>(".$total[chr($i)].")</small>";
			}
			
			if ( $i < 90 ) {
				?></a> <?php echo $seperator ?> <?php
			}
		}

	}
?>
</td></tr>
<?php
}
?>
</table>
