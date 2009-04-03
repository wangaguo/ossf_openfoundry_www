<?php

/**
* Mosets Tree Main Menu
*
* @package Mambo Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Get params
$limit_toplist = $params->get( 'limit_toplist', 0 );
$show_home = $params->get( 'show_home', 0 );
$show_browse = $params->get( 'show_browse', 1 );
$show_addlisting = $params->get( 'show_addlisting', 1 );
$show_addcategory = $params->get( 'show_addcategory', 1 );
$show_mylisting = $params->get( 'show_mylisting', 1 );
$show_newlisting = $params->get( 'show_newlisting', 1 );
$show_featuredlisting = $params->get( 'show_featuredlisting', 1 );
$show_popularlisting = $params->get( 'show_popularlisting', 1 );
$show_mostratedlisting = $params->get( 'show_mostratedlisting', 1 );
$show_topratedlisting = $params->get( 'show_topratedlisting', 1 );
$show_mostreviewedlisting = $params->get( 'show_mostreviewedlisting', 1 );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );
$linksclass	= $params->get( 'linksclass', 'mainlevel' );
$show_addlisting_force	= $params->get( 'show_addlisting_force', 0 );

# Include the config file
require( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );

# Include the language file. Default is English
if ($mosConfig_lang=='') $mosConfig_lang='english';
include_once('components/com_mtree/language/'.$mosConfig_lang.'.php');
if ( !isset($_MT_LANG) ) $_MT_LANG =& new mosConfig_lang();

# Include the language file. Default is English
#if ($mt_language=='') $mt_language='english';
#include_once('components/com_mtree/language/'.$mt_language.'.php');
#if ( !isset($_MT_LANG) ) $_MT_LANG =& new mtLanguage();
#if ( !isset($_MT_LANG) ) $_MT_LANG =& new mosConfig_lang();



# Get Itemid, determine if the HP component is published
$database->setQuery("SELECT id FROM #__menu"
	.	"\nWHERE link='index.php?option=com_mtree'"
	.	"\nAND published='1'"
	.	"\nLIMIT 1");
$Itemid = $database->loadResult();

# Detect whether cat_id / link_id present
$cat_id = trim( mosGetParam( $_REQUEST, 'cat_id', 0 ) );
$link_id = trim( mosGetParam( $_REQUEST, 'link_id', '' ) );

// Get Link's category
if ( $link_id > 0 && $cat_id == 0 ) {
	$mtLink = new mtLinks( $database );
	$mtLink->load( $link_id );
	$cat_id = $mtLink->cat_id;
}

if ( $limit_toplist == 0 ) {
	$toplist_cat_id = 0;
} else {
	if ( $cat_id > 0 ) {
		$toplist_cat_id = $cat_id;
	} else {
		$cat_id = 0;
		$toplist_cat_id = 0;
	}
}

# Check if this category allow link submission
if ( $show_addlisting_force ) {
	$cat_allow_submission = 1;
} else {
	$database->setQuery( "SELECT cat_allow_submission FROM #__mt_cats WHERE cat_id = $cat_id LIMIT 1" );
	$cat_allow_submission = $database->loadResult();
}

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php 
	if ($show_home) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->HOME; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_browse) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->BROWSE; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_addlisting && $cat_allow_submission) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=addlisting&cat_id=".$cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->ADD_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_addcategory) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=addcategory&cat_id=".$cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->ADD_CATEGORY; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mylisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=mylisting&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MY_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_newlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listnew&cat_id=".$toplist_cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->NEW_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_featuredlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listfeatured&cat_id=".$toplist_cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->FEATURED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_popularlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listpopular&cat_id=".$toplist_cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->POPULAR_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mostratedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listmostrated&cat_id=".$toplist_cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MOST_RATED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_topratedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listtoprated&cat_id=".$toplist_cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->TOP_RATED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mostreviewedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listmostreview&cat_id=".$toplist_cat_id."&Itemid=$Itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MOST_REVIEWED_LISTING; ?></a>
    </td>
  </tr>
<?php } ?>
</table>
<?php 
//} 
?>
