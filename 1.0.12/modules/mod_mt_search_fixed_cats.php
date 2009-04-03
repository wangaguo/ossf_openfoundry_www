<?php

/**
* Mambo Tree Search: Fixed Categories
*
* @package Mambo Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Include the language file. Default is English
if ($mosConfig_lang=='') $mosConfig_lang='english';
include_once('components/com_mtree/language/'.$mosConfig_lang.'.php');
if ( !isset($_MT_LANG) ) $_MT_LANG =& new mosConfig_lang();
#if ($mt_language=='') $mt_language='english';
#include_once('components/com_mtree/language/'.$mt_language.'.php');
#if ( !isset($_MT_LANG) ) $_MT_LANG =& new mtLanguage();

# Get Itemid, determine if the mtree component is published
$database->setQuery("SELECT id FROM #__menu"
	.	"\nWHERE link='index.php?option=com_mtree'"
	.	"\nAND published='1'"
	.	"\nLIMIT 1");
$Itemid = $database->loadResult();

$width 			= intval( $params->get( 'width', 16 ) );
$text 			= $params->get( 'text', _SEARCH_BOX );
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx' );
$advsearch 			= intval( $params->get( 'advsearch', 1 ) );
$parent_cat	= intval( $params->get( 'parent_cat', 0 ) );
$search_button	= intval( $params->get( 'search_button', 1 ) );

global $database, $custom404, $mosConfig_sef, $cat_id;

# Get sub catgories for parent_cat
if ( $parent_cat >= 0 ) {
	$database->setQuery( "SELECT cat_id, cat_name FROM #__mt_cats WHERE cat_approved='1' AND cat_published='1' AND cat_parent = '$parent_cat' ORDER BY cat_name ASC" );
	$cats = $database->loadObjectList();
}

# Using Built in SEF feature in Mambo
if ( !isset($custom404) && $mosConfig_sef ) {
	$onclickCmd = "document.location.href= '$mosConfig_live_site/component/option,com_mtree/task,search/Itemid,$Itemid/searchword,' + encodeURI(document.searchfrm2_mod.mt_search.value) + '/cat_id,' + encodeURI(document.searchfrm2_mod.cat_id.value) + '/'";
} else {

# Using SEF advance or no SEF at all
	//$onclickCmd = "document.location.href='" . sefRelToAbs("index.php?option=com_mtree&task=search&Itemid=$Itemid&cat_id=' + encodeURI(document.searchfrm2_mod.cat_id.value) + '&searchword=' + encodeURI(document.searchfrm2_mod.mt_search.value)");
	$onclickCmd = "document.location.href='" . "index.php?option=com_mtree&task=search&Itemid=$Itemid&cat_id=' + encodeURI(document.searchfrm2_mod.cat_id.value) + '&searchword=' + encodeURI(document.searchfrm2_mod.mt_search.value)";
}

?>
<form action="javascript: <?php echo $onclickCmd; ?>" method="POST" name="searchfrm2_mod">

<div align="left" class="search<?php echo $moduleclass_sfx; ?>">
	<input type="text" id="mt_search" class="inputbox" size="<?php echo $width; ?>" value="<?php echo $text; ?>"  onblur="if(this.value=='') this.value='<?php echo $text; ?>';" onfocus="if(this.value=='<?php echo $text; ?>') this.value='';" onkeypress="if(event.keyCode == 13) <?php echo $onclickCmd; ?>" />
	<br />
	<select name="cat_id">
		<option value="<?php echo $parent_cat ?>" selected><?php echo $_MT_LANG->ALL_CATEGORIES ?>
		<?php foreach( $cats AS $cat ) { ?>
		<option value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?>
		<?php } ?>
	</select>
	
	<?php if ( $search_button ) { ?>
		<br /><input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" />
	<?php } ?>

	<?php if ( $advsearch ) { ?>
		<br /><a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=advsearch&Itemid=$Itemid"); ?>"><?php echo $_MT_LANG->ADVANCED_SEARCH ?></a>
	<?php } ?>

</div>
</form>
