<?php
/**
* Mosets Tree Search
*
* @package Mosets Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Include the language file. Default is English
if ($mt_language=='') $mt_language='english';
include_once('components/com_mtree/language/'.$mt_language.'.php');
if ( !isset($_MT_LANG) ) $_MT_LANG =& new mosConfig_lang();

# Get Itemid, determine if the mtree component is published
$database->setQuery("SELECT id FROM #__menu"
	.	"\nWHERE link='index.php?option=com_mtree'"
	.	"\nAND published='1'"
	.	"\nLIMIT 1");
$Itemid = $database->loadResult();

$width 			= intval( $params->get( 'width', 16 ) );
$text 			= $params->get( 'text', '' );
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx' );
$advsearch 			= intval( $params->get( 'advsearch', 1 ) );
$search_current	= intval( $params->get( 'search_current', 1 ) );
$search_button	= intval( $params->get( 'search_button', 1 ) );

global $custom404, $mosConfig_sef, $cat_id, $mosConfig_live_site;

$link_id_passfromurl = intval( mosGetParam( $_REQUEST, 'link_id', 0 ) );

if ( $search_current == "1" ) { 

	if ( $link_id_passfromurl > 0 && $cat_id == 0 ) {
		$database->setQuery( "SELECT cl.cat_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND cl.main = 1 AND l.link_id ='".$link_id_passfromurl."'" );
		$search_cat_id = $database->loadResult();
	} else {
		$search_cat_id = $cat_id;
	}

} else {
	$search_cat_id = 0;
}

# Using Built in SEF feature in Mambo
if ( !isset($custom404) && $mosConfig_sef ) {
	$onclickCmd = "document.location.href= '$mosConfig_live_site/component/option,com_mtree/task,search/Itemid,$Itemid/searchword,' + escape(document.searchfrm_mod.mt_search.value) + '/cat_id,".$search_cat_id."/'";
} else {

# Using SEF advance or no SEF at all
	$onclickCmd = "document.location.href='" . $mosConfig_live_site . "/index.php?option=com_mtree&task=search&Itemid=$Itemid&cat_id=".$search_cat_id."&searchword=' + escape(document.searchfrm_mod.mt_search.value)";

}


?>
<form action="javascript: <?php echo $onclickCmd; ?>" method="POST" name="searchfrm_mod">

<div align="left" class="search<?php echo $moduleclass_sfx; ?>">
	<input type="text" id="mt_search" class="inputbox" size="<?php echo $width; ?>" value="<?php echo $text; ?>"  onblur="if(this.value=='') this.value='<?php echo $text; ?>';" onfocus="if(this.value=='<?php echo $text; ?>') this.value='';" onkeypress="if(event.keyCode == 13) <?php echo $onclickCmd; ?>" />
	
	<?php if ( $search_button ) { ?>
		<br /><input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" />
	<?php } ?>

	<?php if ( $advsearch ) { ?>
	<br /><a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=advsearch&Itemid=$Itemid"); ?>"><?php echo $_MT_LANG->ADVANCED_SEARCH ?></a>
	<?php } ?>

</div>
</form>
