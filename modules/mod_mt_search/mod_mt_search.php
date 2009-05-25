<?php
/**
* Mosets Tree Search
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2007 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

# Get Itemid, determine if the MT component is published
global $mt_itemid;
if(!isset($mt_itemid)) {
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$mt_itemid = $database->loadResult();
}

$width 			= intval( $params->get( 'width', 16 ) );
$text 			= $params->get( 'text', (( $GLOBALS['_VERSION']->RELEASE == '1.0' )?_SEARCH_BOX:JTEXT::_('search...')) );
$moduleclass_sfx= $params->get( 'moduleclass_sfx' );
$advsearch 		= intval( $params->get( 'advsearch', 1 ) );
$search_button	= intval( $params->get( 'search_button', 1 ) );
$showCatDropdown= intval( $params->get( 'showCatDropdown', 0 ) );
$parent_cat		= intval( $params->get( 'parent_cat', 0 ) );
$dropdownWidth	= intval( $params->get( 'dropdownWidth', 0 ) );

global $database, $custom404, $mosConfig_sef, $cat_id;

# Get sub catgories for parent_cat
if ( $showCatDropdown == 1 && $parent_cat >= 0 ) {
	$database->setQuery( "SELECT cat_id, cat_name FROM #__mt_cats WHERE cat_approved='1' AND cat_published='1' AND cat_parent = '$parent_cat' ORDER BY cat_name ASC" );
	$cats = $database->loadObjectList();
}

# Using Built in SEF feature in Joomla
if ( !isset($custom404) && $mosConfig_sef ) {
	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		$onclickCmd = "document.location.href= '$mosConfig_live_site/component/option,com_mtree/task,search/Itemid,$mt_itemid/searchword,' + escape(document.searchfrm2_mod.mt_search.value) + '/'";
	} else {
		$onclickCmd = "document.location.href='" . JURI::base() . "index.php?option=com_mtree&task=search&Itemid=$mt_itemid";
		if($showCatDropdown) {
			$onclickCmd .= "&cat_id=' + escape(document.searchfrm2_mod.cat_id.value) + '";
		}
		$onclickCmd .= "&searchword=' + document.searchfrm2_mod.mt_search.value";
	}
	if($showCatDropdown) {
		$onclickCmd .= " + 'cat_id,' + escape(document.searchfrm2_mod.cat_id.value) + '/'";
	}
} else {

# Using SEF advance or no SEF at all
	$onclickCmd = "document.location.href='" . $mosConfig_live_site . "/index.php?option=com_mtree&task=search&Itemid=$mt_itemid";
	if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
		if($showCatDropdown) {
			$onclickCmd .= "&cat_id=' + escape(document.searchfrm2_mod.cat_id.value) + '";
		}
		$onclickCmd .= "&searchword=' + escape(document.searchfrm2_mod.mt_search.value)";
	} else {
		if($showCatDropdown) {
			$onclickCmd .= "&cat_id=' + escape(document.searchfrm2_mod.cat_id.value) + '";
		}
		$onclickCmd .= "&searchword=' + document.searchfrm2_mod.mt_search.value";
	}
}

?>
<form action="javascript: <?php echo $onclickCmd; ?>" method="POST" name="searchfrm2_mod">

<div align="left" class="search<?php echo $moduleclass_sfx; ?>">
	<input type="text" id="mt_search" class="inputbox" size="<?php echo $width; ?>" value="<?php echo $text; ?>"  onblur="if(this.value=='') this.value='<?php echo $text; ?>';" onfocus="if(this.value=='<?php echo $text; ?>') this.value='';" onkeypress="if(event.keyCode == 13) <?php echo $onclickCmd; ?>" />
	<?php if($showCatDropdown) { ?>
	<br />
	<select name="cat_id" <?php echo ($dropdownWidth>0) ? 'style="width:' . $dropdownWidth . 'px"' : ''; ?>>
		<option value="<?php echo $parent_cat ?>" selected><?php echo $_MT_LANG->ALL_CATEGORIES ?>
		<?php foreach( $cats AS $cat ) { ?>
		<option value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?>
		<?php } ?>
	</select>
	<?php } ?>
	
	<?php if ( $search_button ) { ?>
		<br /><input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" />
	<?php } ?>

	<?php if ( $advsearch ) { ?>
		<br /><a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=advsearch&Itemid=$mt_itemid"); ?>"><?php echo $_MT_LANG->ADVANCED_SEARCH ?></a>
	<?php } ?>

</div>
</form>
