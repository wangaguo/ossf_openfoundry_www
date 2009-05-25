<?php

/**
* Mosets Tree Main Menu
*
* @package Mosets Tree 2.0
* @copyright (C) 2005-2008 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include( $mosConfig_absolute_path . '/components/com_mtree/init.php');

# Get params
$limit_toplist = $params->get( 'limit_toplist', 0 );
$show_home = $params->get( 'show_home', 0 );
$show_browse = $params->get( 'show_browse', 1 );
$show_addlisting = $params->get( 'show_addlisting', 1 );
$show_addcategory = $params->get( 'show_addcategory', 1 );
$show_mypage = $params->get( 'show_mypage', 1 );
$show_newlisting = $params->get( 'show_newlisting', 1 );
$show_recentlyupdatedlisting = $params->get( 'show_recentlyupdatedlisting', 1 );
$show_mostfavoured = $params->get( 'show_mostfavoured', 1 );
$show_featuredlisting = $params->get( 'show_featuredlisting', 1 );
$show_popularlisting = $params->get( 'show_popularlisting', 1 );
$show_mostratedlisting = $params->get( 'show_mostratedlisting', 1 );
$show_topratedlisting = $params->get( 'show_topratedlisting', 1 );
$show_mostreviewedlisting = $params->get( 'show_mostreviewedlisting', 1 );
$moduleclass_sfx	= $params->get( 'moduleclass_sfx' );
$linksclass	= $params->get( 'linksclass', 'mainlevel' );
$show_addlisting_force	= $params->get( 'show_addlisting_force', 0 );

# Get Itemid, determine if the MT component is published
global $mt_itemid;
if(!isset($mt_itemid)) {
	$database->setQuery("SELECT id FROM #__menu"
		.	"\nWHERE link='index.php?option=com_mtree'"
		.	"\nAND published='1'"
		.	"\nLIMIT 1");
	$mt_itemid = $database->loadResult();
}

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
$cat_allow_submission = 0;
if ( $show_addlisting_force ) {
	$cat_allow_submission = 1;
} elseif( $cat_id > 0 ) {
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
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->BROWSE; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_addlisting && $cat_allow_submission) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=addlisting&cat_id=".$cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->ADD_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_addcategory) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=addcategory&cat_id=".$cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->ADD_CATEGORY; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mypage && $my->id > 0) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=mypage&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MY_PAGE; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_newlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listnew&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->NEW_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_recentlyupdatedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listupdated&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->RECENTLY_UPDATED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mostfavoured) { 
	?>
	  <tr>
	    <td align="left">
				<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listfavourite&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MOST_FAVOURED_LISTINGS; ?></a>
	    </td>
	  </tr>
	<?php 
		}
	if ($show_featuredlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listfeatured&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->FEATURED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_popularlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listpopular&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->POPULAR_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mostratedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listmostrated&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MOST_RATED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_topratedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listtoprated&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->TOP_RATED_LISTING; ?></a>
    </td>
  </tr>
<?php 
	}
	if ($show_mostreviewedlisting) { 
?>
  <tr>
    <td align="left">
			<a href="<?php echo sefRelToAbs("index.php?option=com_mtree&task=listmostreview&cat_id=".$toplist_cat_id."&Itemid=$mt_itemid"); ?>" class="<?php echo $linksclass ?>"><?php echo $_MT_LANG->MOST_REVIEWED_LISTING; ?></a>
    </td>
  </tr>
<?php } ?>
</table>
<?php 
//} 
?>
