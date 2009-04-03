<?php
/**
* Mosets Tree admin html
*
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_mtree {

	/***
	* Left Navigation
	*/
	function print_style() {
	?>
	<style type="text/css">
		a.mt_menu {
			font-weight: bold;
			text-decoration: none;
		}
		a.mt_menu:hover {
			font-weight: bold;
			text-decoration: underline;
		}
		a.mt_menu_selected {
			font-weight: bold;
			color: #515151;
			text-decoration: none;
			font-size: 12px;
		}
		a.mt_menu_selected:hover {
			text-decoration: underline;
			font-weight: bold;
			color: #515151;
			font-size: 12px;
		}

	</style>
	<?php
	}

	function print_startmenu( $task ) {
		global $database, $_MT_LANG, $mt_admin_use_explorer;

		# Count the number of pending links/cats/reviews/reports/claims
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats WHERE cat_approved='0'" );
		$pending_cats = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__mt_links WHERE link_approved <= 0" );
		$pending_links = $database->loadResult();
	
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reviews WHERE rev_approved='0'" );
		$pending_reviews = $database->loadResult();
	
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reports" );
		$pending_reports = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__mt_claims" );
		$pending_claims = $database->loadResult();

		# Check if Admin's module for unapproved items is published. If it is, do not display.
		$database->setQuery( "SELECT published, module FROM #__modules WHERE module = 'mod_mt_unapproved_cats' OR module = 'mod_mt_unapproved_listing' OR module = 'mod_mt_unapproved_reviews'" );
		$modPublished = $database->loadObjectList( "module" );

		if ( !isset($modPublished["mod_mt_unapproved_cats"]) ) { $modPublished["mod_mt_unapproved_cats"] = new stdclass; $modPublished["mod_mt_unapproved_cats"]->published = 0; }
		if ( !isset($modPublished["mod_mt_unapproved_listing"]) ) { $modPublished["mod_mt_unapproved_listing"] = new stdclass; $modPublished["mod_mt_unapproved_listing"]->published = 0; }
		if ( !isset($modPublished["mod_mt_unapproved_reviews"]) ) { $modPublished["mod_mt_unapproved_reviews"] = new stdclass; $modPublished["mod_mt_unapproved_reviews"]->published = 0; }

		HTML_mtree::print_style();

	?>
	<table cellpadding="3" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left" valign="top" width="160" height="0">

			<style type="text/css">

			</style>

			<table cellpadding="2" cellspacing="0" border="0" width="160" height="100%" align="left" style="border: 1px solid #cccccc;">
				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->TITLE ?></td></tr>
				
				<?php
				if (!$mt_admin_use_explorer) {
				?>
				<tr>
					<td width="20" align="center" style="background-color:#DDE1E6"><img src="../includes/js/ThemeOffice/home.png" width="16" height="16" /></td>
					<td width="100%" style="background-color:#F1F3F5"> <a class="mt_menu<?php echo ($task=="listcats" || $task=="editcat" || $task=="") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listcats"><?php echo $_MT_LANG->NAVIGATE_TREE ?></a></td>
				</tr>
				<?php } ?>

				<?php //if ( $task=="listcats" || $task=="" ) { ?>

				<tr>
					<td align="center" style="background-color:#DDE1E6"><img src="../components/com_mtree/img/dtree/addpage.gif" width="18" height="18" /></td>
					<td style="background-color:#F1F3F5"> <a class="mt_menu<?php echo ($task=="newlink") ? "_selected": ""; ?>" href="javascript:submitbutton('newlink')"><?php echo $_MT_LANG->ADD_LISTING ?></a></td>
				</tr>

				<tr>
					<td align="center" style="background-color:#DDE1E6"><img src="../components/com_mtree/img/dtree/addfolder.gif" width="18" height="18" /></td>
					<td style="background-color:#F1F3F5"> <a class="mt_menu<?php echo ($task=="newcat") ? "_selected": ""; ?>" href="javascript:submitbutton('newcat')"><?php echo $_MT_LANG->ADD_CAT ?></a></td>
				</tr>

				<?php //} ?>

				<?php 
					# Awaiting Approvals
					if ( 
							($pending_links > 0 && !$modPublished["mod_mt_unapproved_listing"]->published)
							OR
							($pending_cats > 0 && !$modPublished["mod_mt_unapproved_cats"]->published)
							OR
							($pending_reviews > 0 && !$modPublished["mod_mt_unapproved_reviews"]->published)
							OR
							($pending_reports > 0)
							OR
							($pending_claims > 0)
						 ) { 
				?>
				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->AWAITING_APPROVAL ?></td></tr>
					
				<?php if ( $pending_cats > 0 && !$modPublished["mod_mt_unapproved_cats"]->published ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/dtree/folder.gif" width="18" height="18" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_cats") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_cats"><?php echo $_MT_LANG->CATEGORIES ?> (<?php echo $pending_cats; ?>)</a></td>
				</tr>
					<?php 
					}

					if ( $pending_links > 0 && !$modPublished["mod_mt_unapproved_listing"]->published ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../includes/js/ThemeOffice/document.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_links") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_links"><?php echo $_MT_LANG->LISTINGS ?> (<?php echo $pending_links; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_reviews > 0 && !$modPublished["mod_mt_unapproved_reviews"]->published ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../includes/js/ThemeOffice/edit.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_reviews") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_reviews"><?php echo $_MT_LANG->REVIEWS ?> (<?php echo $pending_reviews; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_reports > 0 ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../includes/js/ThemeOffice/edit.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_reports") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_reports"><?php echo $_MT_LANG->REPORTS ?> (<?php echo $pending_reports; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_claims > 0 ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../includes/js/ThemeOffice/edit.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_claims") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_claims"><?php echo $_MT_LANG->CLAIMS ?> (<?php echo $pending_claims; ?>)</a></td>
				</tr>
				<?php 
					}	

				} 
				 # End of Awaiting Approvals

				 # dTree
				if ($mt_admin_use_explorer) {
				?>
				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->EXPLORER ?></td></tr>
				<tr><td colspan="2" style="background-color:#F1F3F5;">
				<?php

				global $mt_explorer_tree_level;
				$cats = HTML_mtree::getChildren( 0, $mt_explorer_tree_level );
				?>
				<link rel="StyleSheet" href="components/com_mtree/dtree.css" type="text/css" />
				<script type="text/javascript" src="../components/com_mtree/js/dtree.js"></script>

				<script type="text/javascript">
					<!--
					
					fpath = '../components/com_mtree/img/dtree/folder.gif';
					d = new dTree('d');

					d.config.closeSameLevel = true; 

					d.icon.root = '../includes/js/ThemeOffice/home.png',
					d.icon.folder = '../components/com_mtree/img/dtree/folder.gif',
					d.icon.folderOpen = '../components/com_mtree/img/dtree/folderopen.gif',
					d.icon.node = '../components/com_mtree/img/dtree/page.gif',
					d.icon.empty = '../components/com_mtree/img/dtree/empty.gif',
					d.icon.line = '../components/com_mtree/img/dtree/line.gif',
					d.icon.join = '../components/com_mtree/img/dtree/join.gif',
					d.icon.joinBottom = '../components/com_mtree/img/dtree/joinbottom.gif',
					d.icon.plus = '../components/com_mtree/img/dtree/plus.gif',
					d.icon.plusBottom = '../components/com_mtree/img/dtree/plusbottom.gif',
					d.icon.minus = '../components/com_mtree/img/dtree/minus.gif',
					d.icon.minusBottom = '../components/com_mtree/img/dtree/minusbottom.gif',
					d.icon.nlPlus = '../components/com_mtree/img/dtree/nolines_plus.gif',
					d.icon.nlMinus = '../components/com_mtree/img/dtree/nolines_minus.gif'

					d.add(0,-1,'<?php echo $_MT_LANG->ROOT ?>', 'index2.php?option=com_mtree');
					<?php
					foreach( $cats AS $cat ) {
							echo "\nd.add(";
							echo $cat->cat_id.",";
							echo $cat->cat_parent.",";
							
							// Print Category Name
							echo "'".htmlspecialchars($cat->cat_name, ENT_QUOTES );
							echo "',";

							echo "pp(".$cat->cat_id."),";
							echo "'','',";
							echo "fpath";
							echo ");";
					}
					?>
					document.write(d);
					
					function pp(cid) {
						return 'index2.php?option=com_mtree&task=listcats&cat_id='+cid;
					}
					//-->
				</script>

				</td></tr>
				<?php
					}
				 # End of  dTree

				 # This Directory
//				if ( $task == 'listcats' ) {
				if ( $task == 'listcats' || $task == 'editcat' || $task == 'editcat_browse_cat' || $task == 'editcat_add_relcat' || $task == 'editcat_remove_relcat' ) {
					global $cat_id;
					if ($cat_id[0] > 0) {
				
						# Lookup all information about this directory
						$thiscat = new mtCats( $database );
						$thiscat->load( $cat_id[0] );

				?>
				<tr><td colspan="2" align="left" style="color: black; padding-left: 20px;font-weight:bold;background: #DDE1E6 url(../components/com_mtree/img/dtree/folderopen.gif) no-repeat center left; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;"><?php echo $_MT_LANG->THIS_CATEGORY ?></td></tr>
				<tr class="row0"><td colspan="2" style="background-color:#F1F3F5">
					<?php
						$published_img = $thiscat->cat_published ? 'tick.png' : 'publish_x.png';
						$featured_img = $thiscat->cat_featured ? 'tick.png' : 'publish_x.png';
						
						$tcat = new mtDisplay();
						$tcat->add($_MT_LANG->NAME, '<a href="index2.php?option=com_mtree&task=editcat&cat_id=' . $thiscat->cat_id . '&cat_parent=' . $thiscat->cat_parent . '">' . $thiscat->cat_name . '</a>');
						$tcat->add( $_MT_LANG->CAT_ID, $thiscat->cat_id );
						$tcat->add( $_MT_LANG->LISTINGS, $thiscat->cat_links);
						$tcat->add( $_MT_LANG->CATEGORIES, $thiscat->cat_cats);
						$tcat->add( $_MT_LANG->RELATED_CATEGORIES2, $thiscat->getNumOfRelCats() );
						$tcat->add( $_MT_LANG->PUBLISHED, '<img src="images/' . $published_img . '" width="12" height="12" border="0" alt="" />' );
						$tcat->add( $_MT_LANG->FEATURED, '<img src="images/' . $featured_img . '" width="12" height="12" border="0" alt="" />' );
						$tcat->display();
					?>
				</td></tr>

				<?php
					}

				# This Listing
				} elseif( $task == 'editlink' || $task == 'editlink_change_cat' || $task == 'reviews_list' || $task == 'newreview' || $task == 'editreview' || $task == 'editlink_browse_cat' || $task == 'editlink_add_cat' || $task == 'editlink_remove_cat' ) {
					global $link_id;

					if ( $link_id[0] > 0 ) {
						$thislink = new mtLinks( $database );
						$thislink->load( $link_id[0] );

						$database->setQuery( "SELECT COUNT(*) FROM #__mt_reviews WHERE link_id = '$link_id[0]'" );
						$reviews = $database->loadResult();
						?>
				<tr><td colspan="2" align="left" style="color: black; padding-left: 20px;font-weight:bold;background: #DDE1E6 url(../includes/js/ThemeOffice/document.png) no-repeat center left; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;"><?php echo $_MT_LANG->THIS_LISTING ?></td></tr>
				<tr class="row0"><td colspan="2" style="background-color:#F1F3F5">
					<?php
						$tlisting = new mtDisplay();
						$tlisting->add($_MT_LANG->NAME, '<a href="index2.php?option=com_mtree&task=editlink&link_id=' . $thislink->link_id . '">' . $thislink->link_name . '</a>');
						$tlisting->add( $_MT_LANG->LISTING_ID, $thislink->link_id );
						$tlisting->add( $_MT_LANG->CATEGORY, '<a href="index2.php?option=com_mtree&task=listcats&cat_id=' . $thislink->cat_id . '">' . $thislink->getCatName() . '</a>');
						$tlisting->add( $_MT_LANG->REVIEWS, '<a href="index2.php?option=com_mtree&task=reviews_list&link_id=' . $thislink->link_id . '">' . $reviews . '</a>');
						$tlisting->add( $_MT_LANG->HITS, $thislink->link_hits );
						$tlisting->add( $_MT_LANG->MODIFIED2, tellDateTime($thislink->link_modified) );
						$tlisting->display();
					?>
				</td></tr>
						<?php
					}
				}
				?>

				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->SEARCH ?></td></tr>
				<tr><td colspan="2" align="left" style="background-color:#F1F3F5">
					<form action="index2.php" method="post">
					<input class="text_area" type="text" name="search_text" size="10" maxlength="250" value="" /> <input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" />
					<select name="search_where" class="inputbox" size="1">
						<option value="1"><?php echo $_MT_LANG->LISTINGS ?></option>
						<option value="2"><?php echo $_MT_LANG->CATEGORIES ?></option>
					</select>
					<a href="index2.php?option=com_mtree&task=advsearch"><?php echo $_MT_LANG->ADVANCED_SEARCH_SHORT ?></a>
					<input type="hidden" name="option" value="com_mtree" />
					<input type="hidden" name="task" value="search" />
					<input type="hidden" name="limitstart" value="0" />
					</form>
				</td></tr>

				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->MORE ?></td></tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/globe3.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu" href="index2.php?option=com_mtree&task=globalupdate"><?php echo $_MT_LANG->RECOUNT_CATEGORIES_LISTINGS ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/template.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="templates") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=templates"><?php echo $_MT_LANG->TEMPLATES ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/config.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="config") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=config"><?php echo $_MT_LANG->CONFIGURATION ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/content.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="customfields") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=customfields"><?php echo $_MT_LANG->CUSTOM_FIELDS ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/language.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="languages") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=languages"><?php echo $_MT_LANG->LANGUAGES ?></a></td>
				</tr>

				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/query.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="csv") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=csv"><?php echo $_MT_LANG->EXPORT ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/credits.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="about") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=about"><?php echo $_MT_LANG->ABOUT_MOSETS_TREE ?></a></td>
				</tr>

			</table>		
		</td>
		<td valign="top">
		<?php 
	}

	function print_endmenu() {	?>
		</td>
		</tr>
	</table>
	<?php
	}

	function getChildren( $cat_id, $cat_level ) {
		global $database, $mt_display_empty_cat;

		$cat_ids = array();

		if ( $cat_level > 0  ) {

			$sql = "SELECT cat_id, cat_name, cat_parent, cat_cats, cat_links FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ";
			
			if ( !$mt_display_empty_cat ) { 
				$sql .= "&& ( cat_cats > 0 || cat_links > 0 ) ";	
			}

			$sql .= "\nORDER BY cat_name ASC ";

			$database->setQuery( $sql );
			$cat_ids = $database->loadObjectList();

			if ( count($cat_ids) ) {
				foreach( $cat_ids AS $cid ) {
					//$children_ids = getChildren( $cid->cat_id, ($cat_level-1), $mt_display_empty_cat );
					$children_ids = HTML_mtree::getChildren( $cid->cat_id, ($cat_level-1), $mt_display_empty_cat );
					$cat_ids = array_merge( $cat_ids, $children_ids );
				}
			}
		}

		return $cat_ids;

	}

	/***
	 * Link
	 */
	function editLink( &$row, $cat_id, $other_cats, $browse_cat, &$custom_fields, &$lists, $number_of_prev, $number_of_next, &$pathWay, $returntask, &$params, $option, $activetab=0 ) {
		global $mosConfig_live_site, $mt_listing_image_dir, $mt_use_internal_notes, $_MT_LANG;
		mosMakeHtmlSafe( $row );
		
		$tabs = new mosTabs(0);
?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="../includes/js/calendar/calendar-mos.css" title="green" />
		<!-- import the calendar script -->
		<script type="text/javascript" src="../includes/js/calendar/calendar.js"></script>
		<!-- import the language module -->
		<script type="text/javascript" src="../includes/js/calendar/lang/calendar-en.js"></script>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancellink') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.link_name.value == ""){
				alert( "<?php echo $_MT_LANG->LISTING_MUST_HAVE_NAME ?>" );
			} else {
				<?php getEditorContents( 'editor1', 'link_desc' ) ; ?>
				submitform( pressbutton );
			}
		}
		</script>
	
	<table class="adminheading">
		<tr>
			<th class="mediamanager"><?php echo $row->link_id ? $_MT_LANG->EDIT : $_MT_LANG->ADD ;?> <?php echo $_MT_LANG->LISTING ?></td>
		</tr>
	</table>

	<form action="index2.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
	<center>
	<?php

		if ( $row->link_approved <= 0 ) {

			?>
			<table cellpadding="0" cellspacing="0" border="0" id="toolbar">
			<tr height="60" valign="middle" align="center">
			<?php

			if ( $number_of_prev > 0 ) {
			?>
			<td>
			<a class="toolbar" href="javascript:submitbutton('prev_link');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('prev_link','','images/back_f2.png',1);">
			<img src="images/back.png" alt="Previous" align="middle" name="prev_link" border="0" /><b> (<?php echo $number_of_prev ?>) Previous</b></a>
			</td>
			<?php
			} else {
			?>
			<td><img src="images/back.png" alt="Previous" align="middle" border="0" /><b><font color="#C0C0C0"> (0) Previous</font></b></td>
			<?php
			}

			//if ( $number_of_next > 0 || $number_of_prev > 0 ) {
			?>
			<td>
				<fieldset style="padding: 5px; border: 1px solid #c0c0c0">
					<input type="radio" name="act" value="ignore" checked="checked" />Ignore
					<input type="radio" name="act" value="approve" />Aprove
					<input type="radio" name="act" value="discard" />Discard
				</fieldset>
			</td>
			<?php 
			//}

			if ( $number_of_next > 0 ) {
			?>
			<td>
			<a class="toolbar" href="javascript:submitbutton('next_link');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('next_link','','images/next_f2.png',1);"><b>
			Next (<?php echo $number_of_next ?>) </b><img src="images/next.png" alt="Previous" align="middle" name="next_link" border="0" /></a>
			</td>
			<?php
			} else {
			?>
			<td>
			<a class="toolbar" href="javascript:submitbutton('next_link');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('savelink2','','images/save_f2.png',1);"><b>
			Save </b><img src="images/save.png" alt="Save" align="middle" name="savelink2" border="0" /></a>
			</td>
			<?php
			}
			?>
			</tr>
			</table>
			<?php
		}
	?>
	</center>

	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<th align="left" style="background: url(../components/com_mtree/img/dtree/folderopen.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_id, 'index2.php?option=com_mtree&task=listcats' ); ?></div></th>
		</tr>
	</table>
	
	<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td width="60%" valign="top">

		<table cellpadding="2" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th colspan="3"><?php echo $_MT_LANG->TEM_LISTING_DETAILS ?></th>
			</tr>
			<tr valign="bottom">
				<td width="20%" align="right"><?php echo $_MT_LANG->CATEGORY ?>:</td>
				<td width="80%" align="left" colspan="2">
					<b><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_id, '' ); ?></b> &nbsp;
					<?php echo $lists["cat_id"]; ?>
					<input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'editlink_change_cat' );" class="button" />
				</td>
			</tr>
			<tr>
				<td align="right"><?php echo $_MT_LANG->NAME ?>:</td>
				<td align="left" colspan="2">
					<input class="text_area" type="text" name="link_name" size="50" maxlength="250" value="<?php echo $row->link_name;?>" />
				</td>
			</tr>
			<tr>
				<td width="100%" colspan="3"><?php echo $_MT_LANG->DESCRIPTION ?>:
				<br />
				<?php editorArea( 'editor1',  $row->link_desc , 'link_desc', '100%', '250', '75', '25' ) ; ?>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->WEBSITE ?>:</td>
				<td align="left" colspan="2"><input id="website" class="text_area" type="text" name="website" size="40" value="<?php echo $row->website;?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td align="left" colspan="2">
					<input type="button" class="button" onclick='javascript: window.open("index3.php?option=com_mtree&task=openurl&url="+escape(document.getElementById("website").value))' value="Go!" /> <input type="button" class="button" onclick='javascript: document.getElementById("mtspider").src="index3.php?option=com_mtree&task=spiderurl&url="+document.getElementById("website").value+"&hide=1"' value="Spider" /> &nbsp;<iframe src="index3.php?option=com_mtree&task=spiderurl&hide=1&start=1" id="mtspider" width="50%" height="17" marginwidth="0" marginheight="0" align="top" scrolling="auto" frameborder="0" hspace="0" vspace="0" background="black"> </iframe>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->IMAGE ?>:</td>
				<td align="left"><input class="text_area" type="file" name="link_image" /></td>
				<td width="50%" rowspan="10" valign="top" align="center">
					<?php if ($row->link_image != "" && $row->link_image != "-1") { ?>
					<img style="border: 5px solid #c0c0c0;" src="<?php echo $mosConfig_live_site.$mt_listing_image_dir.$row->link_image ?>" />
					<br />
					<input type="checkbox" name="remove_image" value="1"> <?php echo $_MT_LANG->REMOVE_THIS_IMAGE ?>
					<?php } elseif( $row->link_image == "-1" ) {?>
					<div style="border: 5px solid #c0c0c0;width:130px;padding:20px" /><b><?php echo $_MT_LANG->IMAGE_REMOVED ?></b></div>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->PRICE ?>:</td>
				<td align="left"><input class="text_area" type="text" name="price" size="10" value="<?php echo $row->price ;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->ADDRESS ?>:</td>
				<td align="left"><input class="text_area" type="text" name="address" size="30" value="<?php echo $row->address;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->CITY ?>:</td>
				<td align="left"><input class="text_area" type="text" name="city" size="30" value="<?php echo $row->city;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->STATE ?>:</td>
				<td align="left"><input class="text_area" type="text" name="state" size="30" value="<?php echo $row->state;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->COUNTRY ?>:</td>
				<td align="left"><input class="text_area" type="text" name="country" size="30" value="<?php echo $row->country;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->POSTCODE ?>:</td>
				<td align="left"><input class="text_area" type="text" name="postcode" size="30" value="<?php echo $row->postcode;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->TELEPHONE ?>:</td>
				<td align="left"><input class="text_area" type="text" name="telephone" size="30" value="<?php echo $row->telephone;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->FAX ?>:</td>
				<td align="left"><input class="text_area" type="text" name="fax" size="30" value="<?php echo $row->fax;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->EMAIL ?>:</td>
				<td align="left"><input class="text_area" type="text" name="email" size="30" value="<?php echo $row->email;?>" /></td>
			</tr>

			<?php if (!empty($custom_fields['cust_1']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_1']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_1" size="30" value="<?php echo $row->cust_1;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_2']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_2']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_2" size="30" value="<?php echo $row->cust_2;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_3']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_3']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_3" size="30" value="<?php echo $row->cust_3;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_4']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_4']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_4" size="30" value="<?php echo $row->cust_4;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_5']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_5']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_5" size="30" value="<?php echo $row->cust_5;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_6']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_6']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_6" size="30" value="<?php echo $row->cust_6;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_7']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_7']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_7" size="30" value="<?php echo $row->cust_7;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_8']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_8']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_8" size="30" value="<?php echo $row->cust_8;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_9']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_9']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_9" size="30" value="<?php echo $row->cust_9;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_10']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_10']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_10" size="30" value="<?php echo $row->cust_10;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_11']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_11']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_11" size="30" value="<?php echo $row->cust_11;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_12']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_12']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_12" size="30" value="<?php echo $row->cust_12;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_13']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_13']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_13" size="30" value="<?php echo $row->cust_13;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_14']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_14']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_14" size="30" value="<?php echo $row->cust_14;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_15']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_15']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_15" size="30" value="<?php echo $row->cust_15;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_16']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_16']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_16" size="30" value="<?php echo $row->cust_16;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_17']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_17']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_17" size="30" value="<?php echo $row->cust_17;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_18']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_18']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_18" size="30" value="<?php echo $row->cust_18;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_19']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_19']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_19" size="30" value="<?php echo $row->cust_19;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_20']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_20']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_20" size="30" value="<?php echo $row->cust_20;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_21']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_21']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_21" size="30" value="<?php echo $row->cust_21;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_22']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_22']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_22" size="30" value="<?php echo $row->cust_22;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_23']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_23']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_23" size="30" value="<?php echo $row->cust_23;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_24']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_24']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_24" size="30" value="<?php echo $row->cust_24;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_25']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_25']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_25" size="30" value="<?php echo $row->cust_25;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_26']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_26']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_26" size="30" value="<?php echo $row->cust_26;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_27']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_27']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_27" size="30" value="<?php echo $row->cust_27;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_28']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_28']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_28" size="30" value="<?php echo $row->cust_28;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_29']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_29']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_29" size="30" value="<?php echo $row->cust_29;?>" /></td>
			</tr>
			<?php } ?>
			<?php if (!empty($custom_fields['cust_30']->value)) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $custom_fields['cust_30']->value?>:</td>
				<td align="left" colspan="2"><input class="text_area" type="text" name="cust_30" size="30" value="<?php echo $row->cust_30;?>" /></td>
			</tr>
			<?php } ?>

		</table>

	</td>
	<td width="40%" valign="top">

		<?php
		$tabs->startPane("content-pane");
		$tabs->startTab($_MT_LANG->PUBLISHING,"publishing-page");
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th colspan="2"><?php echo $_MT_LANG->PUBLISHING_INFO ?></th>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->OWNER ?>:</td>
				<td align="left">
					<input class="text_area" type="text" name="owner" size="20" value="<?php echo $row->owner;?>" />
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->APPROVED ?>:</td>
				<td align="left"><?php echo $lists['link_approved'] ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->PUBLISHED ?>:</td>
				<td align="left"><?php echo $lists['link_published'] ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->FEATURED ?>:</td>
				<td align="left"><?php echo $lists['link_featured'] ?></td>
			</tr>
      <tr>
        <td valign="top" align="right"><?php echo $_MT_LANG->OVERWRITE_CREATION_DATE ?>:</td>
        <td align="left"><input class="text_area" type="text" name="link_created" id="created" size="25" maxlength="19" value="<?php echo $row->link_created; ?>" />
          <input name="reset" type="reset" class="button" onClick="return showCalendar('created', 'y-mm-dd');" value="..."></td>
      </tr>
			<tr>
				<td align="left">
				<?php echo _E_START_PUB; ?>
				</td>
				<td>
				<input class="text_area" type="text" name="publish_up" id="publish_up" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
				<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
				</td>
			</tr>
			<tr>
				<td align="left">
				<?php echo _E_FINISH_PUB; ?>
				</td>
				<td>
				<input class="text_area" type="text" name="publish_down" id="publish_down" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
				<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->TEMPLATE ?>:</td>
				<td align="left">
					<?php echo $lists['templates']; ?>
				</td>
			</tr>

			<tr>
				<td valign="top"><?php echo $_MT_LANG->META_KEYWORDS ?>:</td>
				<td><textarea class="text_area" cols="30" rows="3" style="width:210px; height:80px" name="metakey" id="spider_metakey" width="500"><?php echo $row->metakey; ?></textarea>
				</td>
			</tr>
		
			<tr>
				<td valign="top"><?php echo $_MT_LANG->META_DESCRIPTION ?>:</td>
				<td><textarea class="text_area" cols="30" rows="3" style="width:210px; height:80px" name="metadesc" id="spider_metadesc" width="500"><?php echo $row->metadesc; ?></textarea>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->RATINGS ?>:</td>
				<td align="left"><input class="text_area" type="text" name="link_rating" size="7" value="<?php echo $row->link_rating;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->VOTES ?>:</td>
				<td align="left"><input class="text_area" type="text" name="link_votes" size="7" value="<?php echo $row->link_votes;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->HITS ?>:</td>
				<td align="left"><input class="text_area" type="text" name="link_hits" size="7" value="<?php echo $row->link_hits;?>" /></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->VISIT ?>:</td>
				<td align="left"><input class="text_area" type="text" name="link_visited" size="7" value="<?php echo $row->link_visited;?>" /></td>
			</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($_MT_LANG->CATEGORIES,"categories-page");
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th colspan="2"><?php echo $_MT_LANG->ALSO_APPEAR_IN_THESE_CATEGORIES ?></th>
			</tr>
			<?php
				if ( !empty($other_cats) ) {
					foreach( $other_cats AS $other_cat ) {
						if ( is_numeric( $other_cat ) ) {
						?>
			<tr>
				<td width="20"><input type="checkbox" name="remove_cat[]" value="<?php echo $other_cat ?>" /></td>
				<td width="100%" align="left" style="background: url(../components/com_mtree/img/dtree/folder.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $other_cat ); ?></div></td>
			</tr>
						<?php
						}
					}
					?>
			<tr>
				<td colspan="2" height="40" align="left"><input type="button" value="<?php echo $_MT_LANG->REMOVE_CATEGORY ?>" onClick="submitbutton( 'editlink_remove_cat' );" class="button" /></td>
			</tr>
			<?php
				} else {
			?>
			<tr>
				<td colspan="2" height="40" align="left"><b><?php echo $_MT_LANG->NO_CATEGORY_ASSIGNED ?></b><p /></td>
			</tr>
			<?php
				}// End !empty($related_cats)
			?>
			<tr>
				<th colspan="2" align="left"><?php echo $_MT_LANG->ADD_CATEGORY ?></th>
			</tr>
			<tr>
				<td colspan="2" height="40" align="left">
					<?php echo $pathWay->printPathWayFromCat_withCurrentCat( $browse_cat, '' ) . $_MT_LANG->ARROW; ?> &nbsp;
					<?php echo $lists["new_other_cat"]; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="40" align="left">
					<input type="button" value="<?php echo $_MT_LANG->ADD ?>" onClick="submitbutton( 'editlink_add_cat' );" class="button" /> <input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'editlink_browse_cat' );" class="button" />
				</td>
			</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($_MT_LANG->PARAMETERS,"params-page");
		?>
		<table class="adminform">
			<tr>
				<th colspan="2"><?php echo $_MT_LANG->LISTING_PARAMETERS ?></th>
			</tr>
			<tr>
				<td align="left">
				<?php echo $params->render();?>
				</td>
			</tr>
		</table>
		<?php
		$tabs->endTab();
		if ($mt_use_internal_notes) {

		$caption_intnotes = ( $row->internal_notes ) ? "<b>".$_MT_LANG->NOTES."</b>" : $_MT_LANG->NOTES ;
		$tabs->startTab( $caption_intnotes ,"notes-page");
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th><?php echo $_MT_LANG->INTERNAL_NOTES ?></th>
			</tr>
			<tr>
				<td><textarea class="text_area" cols="50" rows="3" style="width:300px; height:300px" name="internal_notes" width="500"><?php echo $row->internal_notes; ?></textarea>
				</td>
			</tr>

		</table>		
		<?php
		$tabs->endTab();
		}

		$tabs->endPane();

		echo "<script type=\"text/javascript\">\n";
		echo "  tabPane1.setSelectedIndex(".$activetab.");";
		echo "</script>";
		?> 
	</td>
	</tr>
	</table>

		<input type="hidden" name="link_id" value="<?php echo $row->link_id; ?>" />
		<input type="hidden" name="original_link_id" value="<?php echo $row->original_link_id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="editlink" />
		<input type="hidden" name="returntask" value="<?php echo ($row->link_approved <= 0)?"listpending_links" : $returntask ?>" />
		<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
		<input type="hidden" name="other_cats" value="<?php echo ( ( !empty($other_cats) ) ? implode(', ', $other_cats) : '' ) ?>" />
		</form>
<?php
	}
	
	function move_links( $link_id, $cat_parent, $catList, $pathWay, $option ) {
		global $_MT_LANG;
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancellinks_move') {
			submitform( pressbutton );
			return;
		}
		submitform( pressbutton );
	}
</script>

<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%"><span class="sectionname"><?php echo $_MT_LANG->MOVE_LINK ?><?php echo (count($link_id) > 1) ? 's' :'';?></span></td>
	</tr>
</table>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
	<tr>
		<td width="20%" align="right"><?php echo $_MT_LANG->NUMBER_OF_ITEMS ?>:</td>
		<td align="left"><?php echo count( $link_id );?></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CURRENT_CATEGORY ?>:</td>
		<td align="left"><strong><?php echo $pathWay->printPathWayFromLink( 0, 'index2.php?option=com_mtree&task=listcats' );?></strong></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CATEGORY ?>:</td>
		<td align="left"><?php echo $catList;?><p /><input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'links_move' );" class="button" /></td>
	</tr>
</table>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="new_cat_parent" value="<?php echo $cat_parent;?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="1" />
<?php
		foreach ($link_id as $id) {
			echo "\n<input type=\"hidden\" name=\"lid[]\" value=\"$id\" />";
		}
?>
</form>

<?php
	}

	function copy_links( $link_id, $cat_parent, $lists, $pathWay, $option ) {
		global $_MT_LANG;
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancellinks_copy') {
			submitform( pressbutton );
			return;
		}
		submitform( pressbutton );
	}
</script>

<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%"><span class="sectionname"><?php echo $_MT_LANG->COPY_LINK ?><?php echo (count($link_id) > 1) ? 's' :'';?></span></td>
	</tr>
</table>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
	<tr>
		<td width="20%" align="right"><?php echo $_MT_LANG->NUMBER_OF_ITEMS ?>:</td>
		<td align="left"><?php echo count( $link_id );?></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CURRENT_CATEGORY ?>:</td>
		<td align="left"><strong><?php echo $pathWay->printPathWayFromLink( 0, 'index2.php?option=com_mtree&task=listcats' );?></strong></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CATEGORY ?>:</td>
		<td align="left"><?php echo $lists['catList'];?><p /><input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'links_copy' );" class="button" /></td>
	</tr>

	<tr><td colspan="2" height="10px"></td></tr>

	<tr>
		<th colspan="2"><?php echo $_MT_LANG->OPTIONS ?></th>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->COPY_REVIEWS ?>:</td>
		<td align="left"><?php echo $lists['copy_reviews'] ;?></td>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->RESET_HITS ?>:</td>
		<td align="left"><?php echo $lists['reset_hits'] ;?></td>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->RESET_RATINGS_AND_VOTES ?>:</td>
		<td align="left"><?php echo $lists['reset_rating'] ;?></td>
	</tr>
</table>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="new_cat_parent" value="<?php echo $cat_parent;?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="1" />
<?php
		foreach ($link_id as $id) {
			echo "\n<input type=\"hidden\" name=\"lid[]\" value=\"$id\" />";
		}
?>
</form>

<?php
	}

	/***
	 * Category
	 */
	function listcats( &$rows, &$links, &$softlink_cat_ids, &$parent, &$pageNav, &$pathWay, $option ) {
		global $database, $_MT_LANG, $mosConfig_live_site, $mt_listing_image_dir, $mt_cat_image_dir, $mt_resize_listing_size, $mt_resize_cat_size, $mt_admin_use_explorer;

		$max_char = 80;

		# Check if mt_pathway is published. If yes, do not use pathway here.
		$database->setQuery( "SELECT published FROM #__modules WHERE module = 'mod_mt_pathway' AND client_id='1'" );
		$modPathWayPublished = $database->loadResult();

?>
		<form action="index2.php" method="post" name="adminForm">

		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="Javascript" src="../includes/js/overlib_mini.js"></script>
		<script language="Javascript">

		<?php
			if ( $mt_admin_use_explorer ) { ?>
		// Open Explorer
		d.openTo(<?php echo ( (isset($parent->cat_id)) ? $parent->cat_id : '0'); ?>, true);
		<?php } ?>

		function showInfo(name,file,type) {
			var pattern = /\b \b/ig;
			name = name.replace(pattern,'_');
			name = name.toLowerCase();
			if (document.adminForm.doPreview.checked) {
				if (type=='listing') {
					var src = '<?php echo $mosConfig_live_site . $mt_listing_image_dir; ?>'+file;
					var width = <?php echo $mt_resize_listing_size ?>;
				} else {
					var src = '<?php echo $mosConfig_live_site . $mt_cat_image_dir; ?>'+file;
					var width = <?php echo $mt_resize_cat_size ?>;
				}
				var html=name;
				html = '<table><tr><td><img border="1" src="'+src+'" name="imagelib" /></td></tr></table>';
				return overlib( html, STICKY, CAPTION, name, LEFT, BELOW, WIDTH, width, OFFSETY, -10, OFFSETX, 56, BGCOLOR, '#d5d5d5', FGCOLOR, '#f1f1f1', CLOSECOLOR, '#000000', CLOSESIZE, '9px' );

			} else {
				return false;
			}
		}

		function showNotes(notes, caption) {
				return overlib( notes, STICKY, CAPTION, caption, LEFT, BELOW, WIDTH, 165, OFFSETY, -10, OFFSETX, 56, BGCOLOR, '#d5d5d5', FGCOLOR, '#f1f1f1', CLOSECOLOR, '#000000', CLOSESIZE, '9px' );
		}

		function submitbutton_fastadd_cat() {
			submitbutton('fastadd_cat');
		}
		</script>

		<table class="adminheading">
			<tr>
				<th class="frontpage"><?php echo $_MT_LANG->NAVIGATION ?></th>
			</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr><?php
				if ( !$modPathWayPublished ) {
				?><th align="left" style="background: url(../components/com_mtree/img/dtree/folderopen.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromLink( 0, 'index2.php?option=com_mtree&task=listcats' ); ?></div></th>
				<?php } else {
					echo "<th> </th>"	;
				}?>
				<td align="right" nowrap>
					<a href="#fastadd" onclick="return overlib('<?php 
					
					$fastadd_html = "<div align=\'left\'>";
					$fastadd_html .= "<textarea class=\'text_area\' name=\'cat_names\' cols=\'21\' rows=\'5\' style=\'width:100%\'></textarea>";
					$fastadd_html .= "<br />";
					$fastadd_html .= "<input type=\'button\' value=\'".$_MT_LANG->ADD."\' onClick=\'javascript:submitbutton_fastadd_cat();\' class=\'button\' />";
					$fastadd_html .= "</div>";
					echo $fastadd_html;
					?>', STICKY, CAPTION, '<?php echo $_MT_LANG->ENTER_ONE_CAT_NAME_PERLINE ?>', CAPCOLOR, '#000', CLOSECOLOR, '#ff6600', CELLPAD, 5, CENTER, BELOW, LEFT, OFFSETX, -20, FGCOLOR, '#F1F3F5', BGCOLOR, '#cccccc', WRAP, CLOSECLICK);"><?php echo $_MT_LANG->FAST_ADD ?></a> | <?php echo $_MT_LANG->PREVIEW_IMAGE ?><input type="checkbox" name="doPreview" /></td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="38" align="right">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
				</th>
				<th width="50%" class="title" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th><?php echo $_MT_LANG->CATEGORIES ?></th>
				<th><?php echo $_MT_LANG->LISTINGS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i]; ?>
			<tr class="<?php echo "row$k"; ?>">
				<td><a href="#go" onclick="return listItemTask('cb<?php echo $i;?>','listcats')"><?php 
					
				if ($row->cat_image) {
					echo "<img border=\"0\" src=\"../components/com_mtree/img/dtree/imgfolder2.gif\" width=\"18\" height=\"18\" onmouseover=\"showInfo('" .$row->cat_name ."', '".$row->cat_image."', 'cat'); this.src='../components/com_mtree/img/dtree/imgfolder.gif'\" onmouseout=\"this.src='../components/com_mtree/img/dtree/imgfolder2.gif'; return nd(); \" />";
				} else {
					echo "<img border=\"0\" src=\"../components/com_mtree/img/dtree/folder.gif\" width=\"18\" height=\"18\" name=\"img".$i."\" onmouseover=\"this.src='../components/com_mtree/img/dtree/folderopen.gif'\" onmouseout=\"this.src='../components/com_mtree/img/dtree/folder.gif'\" />"; 
				}
				?></a><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->cat_id; ?>" onclick="isChecked(this.checked);" /></td>
				<td align="left">
					<a href="#go" onclick="return listItemTask('cb<?php echo $i;?>','editcat')"><?php echo $row->cat_name; ?></a>
				</td>
				<td align="center"><?php echo $row->cat_cats; ?></td>
				<td align="center"><?php echo $row->cat_links; ?></td>
				<?php
				$task = $row->cat_featured ? 'cat_unfeatured' : 'cat_featured';
				$img = $row->cat_featured ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
				<?php
				$task = $row->cat_published ? 'cat_unpublish' : 'cat_publish';
				$img = $row->cat_published ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="9">&nbsp;</th>
			</tr>
		</table>
		
		<p />
		<script language="javascript" type="text/javascript">
			function link_listItemTask( id, task ) {
				var f = document.adminForm;
				lb = eval( 'f.' + id );
				if (lb) {
					lb.checked = true;
					submitbutton(task);
				}
				return false;
			}

			function link_isChecked(isitchecked){
				if (isitchecked == true){
					document.adminForm.link_boxchecked.value++;
				}
				else {
					document.adminForm.link_boxchecked.value--;
				}
			}

			function link_checkAll( n ) {
				var f = document.adminForm;
				var c = f.link_toggle.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					lb = eval( 'f.lb' + i );
					if (lb) {
						lb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.link_boxchecked.value = n2;
				} else {
					document.adminForm.link_boxchecked.value = 0;
				}
			}

		</script>
		<table>
			<td width="100%" nowrap="nowrap" align="right"><?php echo $_MT_LANG->DISPLAY ?></td>
			<td>
				<?php echo $pageNav->writeLimitBox(); ?>
			</td>
		</table>
		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="38" align="right">
					<input type="checkbox" name="link_toggle" value="" onclick="link_checkAll(<?php echo count( $links ); ?>);" />
				</th>
				<th width="60%" class="title" nowrap="nowrap"><?php echo $_MT_LANG->LISTING ?></th>
				<th><?php echo $_MT_LANG->REVIEWS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $links ); $i < $n; $i++) {
			$row = &$links[$i]; ?>
			<tr class="<?php echo "row$k"; ?>">
				<?php if ( $row->main == 1 ) { ?>
				<td><?php echo ($row->link_image) ? "<img src=\"../includes/js/ThemeOffice/media.png\" onmouseover=\"showInfo('" .$row->link_name ."', '".$row->link_image."', 'listing')\" onmouseout=\"return nd();\" >": "<img src=\"../includes/js/ThemeOffice/document.png\" width=\"16\" height=\"16\">"; ?><input type="checkbox" id="lb<?php echo $i;?>" name="lid[]" value="<?php echo $row->link_id; ?>" onclick="link_isChecked(this.checked);" /></td>
				<td align="left">
					<?php
					if ($row->internal_notes) {
						$intnotes = preg_replace('/\s+/', ' ', nl2br($row->internal_notes));
						echo '<a href="#notes" onmouseover="showNotes(\''.$intnotes.'\', \''.$row->link_name.'\')" onmouseout="return nd();"><img src="../includes/js/ThemeOffice/messaging.png" border="0" width="16" height="16" /></a> ';
					}
					?>
					<a href="#edit" onclick="return link_listItemTask('lb<?php echo $i;?>','editlink')"><?php echo $row->link_name; ?></a>
				</td>
				<?php } else { ?>
				<td></td>
				<td align="left">
					<a href="index2.php?option=com_mtree&task=listcats&cat_id=<?php echo $softlink_cat_ids[$row->link_id]->cat_id ?>"> <?php echo $pathWay->printPathWayFromLink( $row->link_id ); ?></a> <?php echo $_MT_LANG->ARROW ?> <a href="index2.php?option=com_mtree&task=editlink&link_id=<?php echo $row->link_id ?>"><?php echo $row->link_name; ?></a>
				</td>
				<?php } ?>
				<td align="center"><a href="index2.php?option=com_mtree&task=reviews_list&link_id=<?php echo $row->link_id; ?>"><?php echo $row->reviews; ?></a></td>
				<?php
				$task = $row->link_featured ? 'link_unfeatured' : 'link_featured';
				$img = $row->link_featured ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('lb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
				<?php

				$now = date( "Y-m-d h:i:s" );
				if ( $now <= $row->publish_up && $row->link_published == "1" ) {
					$img = 'publish_y.png';
				} else if ( ( $now <= $row->publish_down || $row->publish_down == "0000-00-00 00:00:00" ) && $row->link_published == "1" ) {
					$img = 'publish_g.png';
				} else if ( $now > $row->publish_down && $row->link_published == "1" ) {
					$img = 'publish_r.png';
				} elseif ( $row->link_published == "0" ) {
					$img = "publish_x.png";
				}
				$task = $row->link_published ? 'link_unpublish' : 'link_publish';

				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('lb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="5"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="5"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>

		</table>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="cat_parent" value="<?php echo $parent->cat_id; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="link_boxchecked" value="0" />
		</form>
<?php
	}

/**
*
* Writes the edit form for new and existing category
*
*/
	function editCat( &$row, $cat_parent, $related_cats, $browse_cat, &$lists, &$pathWay, $returntask, $option, $activetab=0, $template_all_subcats='' ) {
		global $mosConfig_absolute_path, $mosConfig_editor, $_MT_LANG;
		global $mosConfig_live_site, $mt_cat_image_dir;

		mosMakeHtmlSafe( $row, ENT_QUOTES, 'cat_desc' );
		
		$tabs = new mosTabs(0);

		include_once( $mosConfig_absolute_path . "/editor/editor.php" );

?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="Javascript" src="../includes/js/overlib_mini.js"></script>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancelcat' || pressbutton == 'editcat_add_relcat' || pressbutton == 'editcat_browse_cat') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.cat_name.value == ""){
				alert( "<?php echo $_MT_LANG->CATEGORY_MUST_HAVE_NAME ?>" );
			} else {
				<?php getEditorContents( 'editor1', 'cat_desc' ) ; ?>
				submitform( pressbutton );
			}
		}
		</script>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
			<td><img src="../components/com_mtree/img/folderopenbig.gif" /></td>
      <td width="100%" align="left" valign="middle"><span class="sectionname"><?php echo $row->cat_id ? $_MT_LANG->EDIT : $_MT_LANG->ADD ;?> <?php echo $_MT_LANG->CATEGORY ?></span></td>
    </tr>
		<tr>
			<th colspan="5" align="left" style="background: url(../components/com_mtree/img/dtree/folderopen.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromLink( 0, 'index2.php?option=com_mtree&task=listcats' ); ?></div></th>
		</tr>
  </table>

  	<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td width="60%" valign="top">

		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<form action="index2.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
			<tr>
				<th colspan="3"><?php echo $_MT_LANG->CATEGORY_DETAILS ?></th>
			</tr>
			<tr>
				<td width="15%" align="right"><?php echo $_MT_LANG->NAME ?>:</td>
				<td width="85%" align="left" colspan="2">
					<input class="text_area" type="text" name="cat_name" size="50" maxlength="250" value="<?php echo $row->cat_name;?>" />
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" colspan="3"><?php echo $_MT_LANG->DESCRIPTION ?>:
				<br />
				<?php
				// parameters : areaname, content, hidden field, width, height, rows, cols
				editorArea( 'editor1',  $row->cat_desc , 'cat_desc', '100%', '200', '75', '20' ) ; 
				?></td>
			</tr>

			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->IMAGE ?>:</td>
				<td valign="top" align="left"><input class="text_area" type="file" name="cat_image" /></td>
				<td rowspan="10" valign="top" align="center">
					<?php if ($row->cat_image != "") { ?>
					<img style="border: 5px solid #c0c0c0;" src="<?php echo $mosConfig_live_site.$mt_cat_image_dir.$row->cat_image ?>">
					<br />
					<input type="checkbox" name="remove_image" value="1"> <?php echo $_MT_LANG->REMOVE_THIS_IMAGE ?>
					<?php } ?>
				</td>
			</tr>
		</table>

			</td>
			<td width="40%" valign="top">

		<?php
		$tabs->startPane("content-pane");
		$tabs->startTab($_MT_LANG->PUBLISHING,"publishing-page");
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th colspan="2"><?php echo $_MT_LANG->PUBLISHING_INFO ?></th>
			</tr>
			<?php if ( $row->cat_approved == 0 || $row->cat_id == 0 ) { ?>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->APPROVED ?>:</td>
				<td align="left"><?php echo $lists['cat_approved'] ?></td>
			</tr>
			<?php } else { ?>
			<input type="hidden" name="cat_approved" value="1" />
			<?php } ?>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->PUBLISHED ?>:</td>
				<td align="left"><?php echo $lists['cat_published'] ?></td>
			</tr>

			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->FEATURED ?>:</td>
				<td align="left"><?php echo $lists['cat_featured'] ?></td>
			</tr>

			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->ALLOW_SUBMISSION ?>:</td>
				<td align="left"><?php echo $lists['cat_allow_submission'] ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->SHOW_LISTINGS ?>:</td>
				<td align="left"><?php echo $lists['cat_show_listings'] ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->TEMPLATE ?>:</td>
				<td align="left">
					<?php echo $lists['templates']; ?>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right">&nbsp;</td>
				<td align="left">
					<input type="checkbox" name="template_all_subcats" value="1"<?php echo (($template_all_subcats == 1) ? ' checked="on"' : '' ) ?> /><?php echo $_MT_LANG->CHANGE_ALL_SUBCATS_TO_THIS_TEMPLATE ?>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right">&nbsp;</td>
				<td align="left">
					<?php echo $_MT_LANG->USE_MAIN_INDEX_TEMPLATE_PAGE ?><br />
				  <?php echo $lists['cat_usemainindex'] ?>
				</td>
			</tr>

			<tr>
				<td valign="top"><?php echo $_MT_LANG->META_KEYWORDS ?>:</td>
				<td><textarea class="text_area" cols="30" rows="3" style="width:210px; height:80px" name="metakey" width="500"><?php echo str_replace('&','&amp;',$row->metakey); ?></textarea>
				</td>
			</tr>
		
			<tr>
				<td valign="top"><?php echo $_MT_LANG->META_DESCRIPTION ?>:</td>
				<td><textarea class="text_area" cols="30" rows="3" style="width:210px; height:80px" name="metadesc" width="500"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea>
				</td>
			</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($_MT_LANG->RELATED,"relcats-page");
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminlist">
			<tr>
				<th colspan="2" align="left"><?php echo $_MT_LANG->RELATED_CATEGORIES ?></th>
			</tr>
			<?php
				if ( !empty($related_cats) ) {
					foreach( $related_cats AS $related_cat ) {
						if ( is_numeric( $related_cat ) ) {
						?>
			<tr>
				<td width="20"><input type="checkbox" name="remove_relcat[]" value="<?php echo $related_cat ?>" /></td>
				<td width="100%" align="left" style="background: url(../components/com_mtree/img/dtree/folder.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $related_cat ); ?></div></td>
			</tr>
						<?php
						}
					}
					?>
			<tr>
				<td colspan="2" height="40" align="left"><input type="button" value="<?php echo $_MT_LANG->REMOVE_RELATED_CATEGORY ?>" onClick="submitbutton( 'editcat_remove_relcat' );" class="button" /></td>
			</tr>
			<?php
				} else {
			?>
			<tr>
				<td colspan="2" height="40" align="left"><b><?php echo $_MT_LANG->NO_RELATED_CATEGORY_ASSIGNED ?></b><p /></td>
			</tr>
			<?php
				}// End !empty($related_cats)
			?>
			<tr>
				<th colspan="2" align="left"><?php echo $_MT_LANG->ADD_RELATED_CATEGORY ?></th>
			</tr>
			<tr>
				<td colspan="2" height="40" align="left">
					<?php echo $pathWay->printPathWayFromCat_withCurrentCat( $browse_cat, '' ) . $_MT_LANG->ARROW; ?> &nbsp;
					<?php echo $lists["new_related_cat"]; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<input type="button" value="<?php echo $_MT_LANG->ADD ?>" onClick="submitbutton( 'editcat_add_relcat' );" class="button" /> <input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'editcat_browse_cat' );" class="button" />
				</td>
			</tr>

		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($_MT_LANG->OPERATIONS,"operations-page");
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th><?php echo $_MT_LANG->FULL_RECOUNT ?></th>
			</tr>
			<tr>
				<td valign="top" align="left"><?php echo $_MT_LANG->FULL_RECOUNT_EXPLAIN ?><p />&nbsp;<input type="button" class="button" value="<?php echo $_MT_LANG->PERFORM_FULL_RECOUNT ?>" onClick="window.open('index3.php?option=com_mtree&task=fullrecount&hide=1&cat_id=<?php echo $row->cat_id ?>','recount','width=300,height=150')" /><br /></td>
			</tr>
			<tr>
				<th><?php echo $_MT_LANG->FAST_RECOUNT ?></th>
			</tr>
			<tr>
				<td valign="top" align="left"><?php echo $_MT_LANG->FAST_RECOUNT_EXPLAIN ?><p />&nbsp;<input type="button" class="button" value="<?php echo $_MT_LANG->PERFORM_FAST_RECOUNT ?>" onClick="window.open('index3.php?option=com_mtree&task=fastrecount&hide=1&cat_id=<?php echo $row->cat_id ?>','recount','width=300,height=150')" /><br /></td>
			</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>    
		</td>
	</tr>
</table>

		<script type="text/javascript">
			tabPane1.setSelectedIndex( "<?php echo $activetab ?>");
		</script>
		<input type="hidden" name="cat_id" value="<?php echo $row->cat_id; ?>" />
		<input type="hidden" name="related_cats" value="<?php echo ( ( !empty($related_cats) ) ? implode(', ', $related_cats) : '' ) ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="returntask" value="<?php echo $returntask ?>" />
		<input type="hidden" name="cat_parent" value="<?php echo $cat_parent; ?>" />
		</form>
<?php
	}

	/***
	* Move Category
	*/

	function move_cats( $cat_id, $cat_parent, $catList, $pathWay, $option ) {
		global $_MT_LANG;
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelcats_move') {
			submitform( pressbutton );
			return;
		}
		submitform( pressbutton );
	}
</script>

<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%"><span class="sectionname"><?php echo $_MT_LANG->MOVE_CATEGORY ?></span></td>
	</tr>
</table>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
	<tr>
		<td width="20%" align="right"><?php echo $_MT_LANG->NUMBER_OF_ITEMS ?>:</td>
		<td align="left"><?php echo count( $cat_id );?></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CURRENT_CATEGORY ?>:</td>
		<td align="left"><strong><?php echo $pathWay->printPathWayFromLink( 0, 'index2.php?option=com_mtree&task=listcats' );?></strong></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CATEGORY ?>:</td>
		<td align="left"><?php echo $catList;?><p /><input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'cats_move' );" class="button" /></td>
	</tr>
</table>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="new_cat_parent" value="<?php echo $cat_parent;?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="1" />
<?php
		foreach ($cat_id as $id) {
			echo "\n<input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
?>
</form>

<?php
	}
	
	/***
	* Copy Category
	*/

	function copy_cats( $cat_id, $cat_parent, $lists, $pathWay, $option ) {
		global $_MT_LANG;
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelcats_copy') {
			submitform( pressbutton );
			return;
		}
		submitform( pressbutton );
	}
</script>

<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%"><span class="sectionname"><?php echo $_MT_LANG->COPY_CATEGORY ?></span></td>
	</tr>
</table>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
	<tr>
		<td width="17%" align="right"><?php echo $_MT_LANG->NUMBER_OF_ITEMS ?>:</td>
		<td align="left"><?php echo count( $cat_id );?></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CURRENT_CATEGORY ?>:</td>
		<td align="left"><strong><?php echo $pathWay->printPathWayFromLink( 0, 'index2.php?option=com_mtree&task=listcats' );?></strong></td>
	</tr>
	<tr>
		<td align="right" valign="top"><?php echo $_MT_LANG->CATEGORY ?>:</td>
		<td align="left"><?php echo $lists['catList'] ;?><p /><input type="button" value="<?php echo $_MT_LANG->CHANGE_CATEGORY ?>" onClick="submitbutton( 'cats_copy' );" class="button" /></td>
	</tr>

	<tr><td colspan="2" height="10px"></td></tr>

	<tr>
		<th colspan="2"><?php echo $_MT_LANG->OPTIONS ?></th>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->COPY_SUBCATS ?>:</td>
		<td align="left"><?php echo $lists['copy_subcats'] ;?></td>
	</tr>	<tr>
		<td align="right"><?php echo $_MT_LANG->COPY_RELCATS ?>:</td>
		<td align="left"><?php echo $lists['copy_relcats'] ;?></td>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->COPY_LISTINGS ?>:</td>
		<td align="left"><?php echo $lists['copy_listings'] ;?></td>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->COPY_REVIEWS ?>:</td>
		<td align="left"><?php echo $lists['copy_reviews'] ;?></td>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->RESET_HITS ?>:</td>
		<td align="left"><?php echo $lists['reset_hits'] ;?></td>
	</tr>
	<tr>
		<td align="right"><?php echo $_MT_LANG->RESET_RATINGS_AND_VOTES ?>:</td>
		<td align="left"><?php echo $lists['reset_rating'] ;?></td>
	</tr>
		
</table>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="new_cat_parent" value="<?php echo $cat_parent;?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="1" />
<?php
		foreach ($cat_id as $id) {
			echo "\n<input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
?>
</form>

<?php
	}

	function removecats( $categories, $cat_parent, $option ) {
		global $_MT_LANG;
	?>

		<table class="adminheading">
			<tr>
				<th class="trash"><?php echo $_MT_LANG->DELETE ?></th>
			</tr>
		</table>
		<p />
		<strong><?php echo $_MT_LANG->CONFIRM_DELETE_CATS ?></strong>
		<p />

		<form action="index2.php" method="post" name="adminForm">

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th class="title" width="18px" nowrap="nowrap">&nbsp;</th>
				<th class="title" width="80%" nowrap="nowrap"><?php echo $_MT_LANG->NAME ?></th>
				<th class="title" width="10%" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORIES ?></th>
				<th class="title" width="10%" nowrap="nowrap" align="center"><?php echo $_MT_LANG->LISTINGS ?></th>
			</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $categories ); $i < $n; $i++) {
			$row = &$categories[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td width="18px"><img src="../components/com_mtree/img/dtree/folder.gif" width="18" height="18" /><input type="hidden" name="cid[]" value="<?php echo $row->cat_id ?>" /></td>
				<td align="left" width="80%"><?php echo $row->cat_name; ?></td>
				<td><?php echo $row->cat_cats; ?></td>
				<td><?php echo $row->cat_links; ?></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="cat_parent" value="<?php echo $cat_parent;?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />

		</form>
	<?php

	}

	/***
	* Approval
	*/
	function listpending_links( $links, $pathWay, $pageNav, $option ) {
		global $_MT_LANG;
	?>
		<script language="javascript" type="text/javascript">
			function link_listItemTask( id, task ) {
				var f = document.adminForm;
				lb = eval( 'f.' + id );
				if (lb) {
					lb.checked = true;
					submitbutton(task);
				}
				return false;
			}

			function link_isChecked(isitchecked){
				if (isitchecked == true){
					document.adminForm.link_boxchecked.value++;
				}
				else {
					document.adminForm.link_boxchecked.value--;
				}
			}

			function link_checkAll( n ) {
				var f = document.adminForm;
				var c = f.link_toggle.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					lb = eval( 'f.lb' + i );
					if (lb) {
						lb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.link_boxchecked.value = n2;
				} else {
					document.adminForm.link_boxchecked.value = 0;
				}
			}

		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="mediamanager"><?php echo $_MT_LANG->PENDING_LISTING ?></td>
			</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="100%" align="right" nowrap="nowrap"><?php echo $_MT_LANG->DISPLAY ?></td>
				<td>
					<?php echo $pageNav->writeLimitBox(); ?>
				</td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="38" align="right">
					<input type="checkbox" name="link_toggle" value="" onclick="link_checkAll(<?php echo count( $links ); ?>);" />
				</th>
				<th class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->LISTING ?></th>
				<th width="50%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th width="100"><?php echo $_MT_LANG->CREATED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $links ); $i < $n; $i++) {
			$row = &$links[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td>
					<?php echo ($row->link_image) ? "<img src=\"../includes/js/ThemeOffice/media.png\" onmouseover=\"showInfo('" .$row->link_name ."', '".$row->link_image."', 'listing')\" onmouseout=\"return nd();\" >": "<img src=\"../includes/js/ThemeOffice/document.png\" width=\"16\" height=\"16\">"; ?>
					<input type="checkbox" id="lb<?php echo $i;?>" name="lid[]" value="<?php echo $row->link_id; ?>" onclick="link_isChecked(this.checked);" />
				</td>
				<td><?php echo (($row->link_approved < 0 ) ? '': '<b>' ); ?><a href="#edit" onclick="return link_listItemTask('lb<?php echo $i;?>','editlink_for_approval')"><?php echo $row->link_name; ?></a><?php echo (($row->link_approved < 0 ) ? '': '<b>' ); ?></td>
				<td><?php $pathWay->printPathWayFromLink( $row->link_id, '' ); ?></td>
				<td><?php echo tellDateTime($row->link_created); ?></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="4"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="4"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="listpending_links" />
		<input type="hidden" name="returntask" value="listpending_links" />
		<input type="hidden" name="link_boxchecked" value="0" />
		</form>
		<?php
	}

	function listpending_cats( $cats, $pathWay, $pageNav, $option ) {
		global $_MT_LANG;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td><img src="../components/com_mtree/img/folderopenbig.gif" /></td>
				<td width="100%" align="left" valign="middle"><span class="sectionname"><?php echo $_MT_LANG->PENDING_CATEGORIES ?></span></td>
			</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="100%" align="right" nowrap="nowrap"><?php echo $_MT_LANG->DISPLAY ?></td>
				<td>
					<?php echo $pageNav->writeLimitBox(); ?>
				</td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="38" align="right"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $cats ); ?>);" /></th>
				<th class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORIES ?></th>
				<th width="52%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->PARENT ?></th>
				<th width="100"><?php echo $_MT_LANG->CREATED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $cats ); $i < $n; $i++) {
			$row = &$cats[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td><a href="#go" onclick="return listItemTask('cb<?php echo $i;?>','listcats')"><?php 
					
				if ($row->cat_image) {
					echo "<img border=\"0\" src=\"../components/com_mtree/img/dtree/imgfolder2.gif\" width=\"18\" height=\"18\" onmouseover=\"showInfo('" .$row->cat_name ."', '".$row->cat_image."', 'cat'); this.src='../components/com_mtree/img/dtree/imgfolder.gif'\" onmouseout=\"this.src='../components/com_mtree/img/dtree/imgfolder2.gif'; return nd(); \" />";
				} else {
					echo "<img border=\"0\" src=\"../components/com_mtree/img/dtree/folder.gif\" width=\"18\" height=\"18\" name=\"img".$i."\" onmouseover=\"this.src='../components/com_mtree/img/dtree/folderopen.gif'\" onmouseout=\"this.src='../components/com_mtree/img/dtree/folder.gif'\" />"; 
				}
				?></a><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->cat_id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editcat')"><?php echo $row->cat_name; ?></a></td>
				<td><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $row->cat_parent, 0 ); ?></td>
				<td><?php echo tellDateTime($row->cat_created); ?></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="4"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="4"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="listpending_cats" />
		<input type="hidden" name="returntask" value="listpending_cats" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function listpending_reviews( $reviews, $pathWay, $pageNav, $option ) {
		global $mosConfig_live_site, $_MT_LANG, $mt_use_internal_notes;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $_MT_LANG->PENDING_REVIEWS ?></td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<?php
		if ( count($reviews) <= 0 ) {
			?>
			<tr><th align="left">&nbsp;</th></tr>
			<tr class="row0"><td><?php echo $_MT_LANG->NO_REVIEW_FOUND ?></td></tr>
			<?php
		} else {

			$k = 0;
			for ($i=0, $n=count( $reviews ); $i < $n; $i++) {
				$row = &$reviews[$i]; ?>

				<tr><th align="left"<?php echo ( ($mt_use_internal_notes) ? ' colspan="2"': '' ) ?>><a href="<?php echo $mosConfig_live_site. "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $row->link_name ?></a> by <a href="mailto:<?php echo $row->email ?>"><?php echo (($row->user_id) ? $row->username : $row->guest_name); ?></a>, <?php echo $row->rev_date ?> - <a href="index2.php?option=com_mtree&task=editlink&link_id=<?php echo $row->link_id; ?>"><?php echo $_MT_LANG->EDIT_LISTING ?></a></th></tr>
				<tr align="left">
					<td<?php echo ( ($mt_use_internal_notes) ? ' width="65%"': '' ) ?> valign="top" style="border-bottom:0px;">
						<?php echo $_MT_LANG->REVIEW_TITLE ?>: <input type="text" name="rev_title[<?php echo $row->rev_id; ?>]" value="<?php echo htmlspecialchars($row->rev_title); ?>" class="inputbox" size="60"/>
					</td>
					<?php if ( $mt_use_internal_notes ) { ?>
					<td style="height:100px;" valign="top" width="35%" rowspan="2">
					<?php echo $_MT_LANG->INTERNAL_NOTES ?>:<br />
					<textarea style="width:100%;height:100%" name="admin_note[<?php echo $row->rev_id ?>]"><?php echo htmlspecialchars($row->admin_note) ?></textarea>
					</td>
					<?php } ?>
				</tr>
				<tr align="left">
					<td<?php echo ( ($mt_use_internal_notes) ? ' width="65%"': '' ) ?>>
						<textarea style="width:100%;height:150px" name="rev_text[<?php echo $row->rev_id ?>]"><?php echo htmlspecialchars($row->rev_text) ?></textarea>
						<p />
						<label for="app_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="1" id="app_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->APPROVE ?></label>
						<label for="ign_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="0" id="ign_<?php echo $row->rev_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
						<label for="rej_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="-1" id="rej_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->REJECT ?></label>
					</td>
				</tr>
				
				<?php		$k = 1 - $k; } 
				
			} ?>

		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="listpending_reviews" />
		<input type="hidden" name="returntask" value="listpending_reviews" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function listpending_reports( $reports, $pathWay, $option ) {
		global $mosConfig_live_site, $_MT_LANG, $mt_use_internal_notes;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $_MT_LANG->PENDING_REPORTS ?></td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<?php
		if ( count($reports) <= 0 ) {
			?>
			<tr><th align="left">&nbsp;</th></tr>
			<tr class="row0"><td><?php echo $_MT_LANG->NO_REPORT_FOUND ?></td></tr>
			<?php
		} else {

		$k = 0;
		for ($i=0, $n=count( $reports ); $i < $n; $i++) {
			$row = &$reports[$i]; ?>
			<tr><th align="left"<?php echo ( ($mt_use_internal_notes) ? ' colspan="2"': '' ) ?>><a href="<?php echo $mosConfig_live_site. "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $row->link_name ?></a> - <a href="index2.php?option=com_mtree&task=editlink&link_id=<?php echo $row->link_id; ?>"><?php echo $_MT_LANG->EDIT_LISTING ?></a></th></tr>
			<tr align="left">
				<td<?php echo ( ($mt_use_internal_notes) ? ' width="65%"': '' ) ?>>
					<u><?php echo $row->subject . "</u>, " . ( (empty($row->username))? $row->guest_name : '<a href="mailto:'.$row->email.'">'.$row->username."</a> " ) ." ". $row->created ?>
					<p />
					<?php echo nl2br($row->comment) ?>
					<p />
					<label for="res_<?php echo $row->report_id ?>"><input type="radio" name="report[<?php echo $row->report_id ?>]" value="1" id="res_<?php echo $row->report_id ?>" /><?php echo $_MT_LANG->RESOLVED ?></label>

					<label for="ign_<?php echo $row->report_id ?>"><input type="radio" name="report[<?php echo $row->report_id ?>]" value="0" id="ign_<?php echo $row->report_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
				</td>
				<?php if( $mt_use_internal_notes ) { ?>
				<td style="height:100px;" valign="top" width="35%">
				<?php echo $_MT_LANG->INTERNAL_NOTES ?>:<br />
				<textarea style="width:100%;height:100%" name="admin_note[<?php echo $row->report_id ?>]"><?php echo htmlspecialchars($row->admin_note) ?></textarea>
				</td>
				<?php } ?>
			</tr>
			<?php		$k = 1 - $k; } } ?>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="save_reports" />
		</form>
		<?php
	}

	function listpending_claims( $claims, $pathWay, $option ) {
		global $mosConfig_live_site, $_MT_LANG, $mt_use_internal_notes;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $_MT_LANG->PENDING_CLAIMS ?></td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<?php
		if ( count($claims) <= 0 ) {
			?>
			<tr><th align="left">&nbsp;</th></tr>
			<tr class="row0"><td><?php echo $_MT_LANG->NO_CLAIM_FOUND ?></td></tr>
			<?php
		} else {

		$k = 0;
		for ($i=0, $n=count( $claims ); $i < $n; $i++) {
			$row = &$claims[$i]; ?>
			<tr><th align="left"<?php echo ( ($mt_use_internal_notes) ? ' colspan="2"': '' ) ?>><a href="<?php echo $mosConfig_live_site. "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $row->link_name ?></a> by <a href="mailto:<?php echo $row->email ?>"><?php echo $row->name ?></a> (<?php echo $row->username ?>), <?php echo $row->created ?> - <a href="index2.php?option=com_mtree&task=editlink&link_id=<?php echo $row->link_id; ?>"><?php echo $_MT_LANG->EDIT_LISTING ?></a></th></tr>
			<tr align="left">
				<td <?php echo ( ($mt_use_internal_notes) ? 'width="65%" ': '' ) ?>valign="top">
					<?php echo nl2br(htmlspecialchars($row->comment)) ?>
					<p />
					<label for="app_<?php echo $row->claim_id ?>"><input type="radio" name="claim[<?php echo $row->claim_id ?>]" value="<?php echo $row->user_id ?>" id="app_<?php echo $row->claim_id ?>" /><?php echo $_MT_LANG->APPROVE ?></label>
					<label for="ign_<?php echo $row->claim_id ?>"><input type="radio" name="claim[<?php echo $row->claim_id ?>]" value="0" id="ign_<?php echo $row->claim_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
					<label for="rej_<?php echo $row->claim_id ?>"><input type="radio" name="claim[<?php echo $row->claim_id ?>]" value="-1" id="rej_<?php echo $row->claim_id ?>" /><?php echo $_MT_LANG->REJECT ?></label>
				</td>
				<?php if ( $mt_use_internal_notes ) { ?>
				<td style="height:100px;" valign="top" width="35%">
				<?php echo $_MT_LANG->INTERNAL_NOTES ?>:<br />
				<textarea style="width:100%;height:100%" name="admin_note[<?php echo $row->claim_id ?>]"><?php echo htmlspecialchars($row->admin_note) ?></textarea>
				</td>
				<?php } ?>
			</tr>
			<?php		$k = 1 - $k; } } ?>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="save_claims" />
		</form>
		<?php
	}

	/***
	 * Reviews
	 */
	function list_reviews( &$reviews, &$link, &$pathWay, &$pageNav, $option ) {
		global $_MT_LANG;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $_MT_LANG->REVIEWS ?>: <?php echo $link->link_name; ?></td>
			</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<th width="100%" align="left" style="background: url(../components/com_mtree/img/dtree/folderopen.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromLink( $link->link_id, 'index2.php?option=com_mtree&task=listcats' ); ?></div></th>
				<td nowrap="nowrap"><?php echo $_MT_LANG->DISPLAY ?></td>
				<td>
					<?php echo $pageNav->writeLimitBox(); ?>
				</td>
			</tr>
	  </table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $reviews ); ?>);" />
				</th>
				<th class="title" width="10%" nowrap="nowrap"><?php echo $_MT_LANG->USER ?></th>
				<th width="75%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->REVIEW_TEXT ?></th>
				<th width="250"><?php echo $_MT_LANG->CREATED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $reviews ); $i < $n; $i++) {
			$row = &$reviews[$i]; ?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20">
					<input type="checkbox" id="cb<?php echo $i;?>" name="rid[]" value="<?php echo $row->rev_id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editreview')"><?php echo (($row->user_id) ? $row->username : $row->guest_name); ?></a></td>
				<td align="left"><?php echo $row->rev_title; ?></td>
				<td align="center"><?php echo $row->rev_date; ?></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="4"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="4"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="reviews_list" />
		<input type="hidden" name="link_id" value="<?php echo $link->link_id; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function editreview( &$row, &$pathWay, $returntask, $lists, $option ) {
		global $_MT_LANG;

		mosMakeHtmlSafe( $row, ENT_QUOTES, 'rev_text' );
?>
		<link rel="stylesheet" type="text/css" media="all" href="../includes/js/calendar/calendar-mos.css" title="green" />
		<!-- import the calendar script -->
		<script type="text/javascript" src="../includes/js/calendar/calendar.js"></script>
		<!-- import the language module -->
		<script type="text/javascript" src="../includes/js/calendar/lang/calendar-en.js"></script>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancelreview') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.rev_text.value == ""){
				alert( "<?php echo $_MT_LANG->PLEASE_ENTER_REVIEW_TEXT ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $row->rev_id ? $_MT_LANG->EDIT : $_MT_LANG->ADD ;?> <?php echo $_MT_LANG->REVIEW ?></td>
			</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<th align="left" style="background: url(../components/com_mtree/img/dtree/folderopen.gif) no-repeat center left"><div style="margin-left: 18px"><?php echo $pathWay->printPathWayFromLink( $row->link_id, 'index2.php?option=com_mtree&task=listcats' ); ?></div></th>
			</tr>
	  </table>

		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<form action="index2.php" method="post" name="adminForm" id="adminForm">
			<tr>
				<td width="15%" align="right">User:</td>
				<td width="85%" align="left">
					<input class="text_area" type="text" name="owner" size="20" maxlength="250" value="<?php echo (($row->not_registered) ? $row->guest_name : $row->owner );?>" /><br />
					<input type="checkbox" name="not_registered" value="1" <?php echo (($row->not_registered) ? 'checked ' : '' ); ?>/> <?php echo $_MT_LANG->THIS_IS_NOT_A_REGISTERED_USER ?>
				</td>
			</tr>
			<tr>
				<td width="15%" align="right"><?php echo $_MT_LANG->REVIEW_TITLE ?>:</td>
				<td width="85%" align="left">
					<input class="text_area" type="text" name="rev_title" size="60" maxlength="250" value="<?php echo $row->rev_title;?>" />
				</td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->REVIEW ?>:</td>
				<td align="left"><textarea name="rev_text" cols="70" rows="15"><?php echo $row->rev_text; ?></textarea></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->APPROVED ?>:</td>
				<td align="left"><?php echo $lists['rev_approved'] ?></td>
			</tr>
      <tr>
        <td valign="top" align="right"><?php echo $_MT_LANG->OVERRIDE_CREATED_DATE ?> </td>
        <td align="left"><input class="text_area" type="text" name="rev_date" id="created" size="25" maxlength="19" value="<?php echo $row->rev_date; ?>" />
          <input name="reset" type="reset" class="button" onClick="return showCalendar('created', 'y-mm-dd');" value="..."></td>
      </tr>		
		
		</table>

		<input type="hidden" name="rev_id" value="<?php echo $row->rev_id; ?>" />
		<input type="hidden" name="link_id" value="<?php echo $row->link_id; ?>" />
		<input type="hidden" name="returntask" value="<?php echo $returntask ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		</form>
<?php
	}

	/***
	 * Search
	 */

	function searchresults_links( &$links, &$pageNav, &$pathWay, $search_where, $search_text, $option ) {
		global $_MT_LANG;
	?>
		<script language="javascript" type="text/javascript">
			function link_listItemTask( id, task ) {
				var f = document.adminForm;
				lb = eval( 'f.' + id );
				if (lb) {
					lb.checked = true;
					submitbutton(task);
				}
				return false;
			}

			function link_isChecked(isitchecked){
				if (isitchecked == true){
					document.adminForm.link_boxchecked.value++;
				}
				else {
					document.adminForm.link_boxchecked.value--;
				}
			}

			function link_checkAll( n ) {
				var f = document.adminForm;
				var c = f.link_toggle.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					lb = eval( 'f.lb' + i );
					if (lb) {
						lb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.link_boxchecked.value = n2;
				} else {
					document.adminForm.link_boxchecked.value = 0;
				}
			}

		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname"><?php echo $_MT_LANG->SEARCH_RESULTS ?> - <?php echo $_MT_LANG->LISTINGS ?></td>
			<td nowrap="nowrap"><?php echo $_MT_LANG->DISPLAY ?></td>
			<td>
				<?php echo $pageNav->writeLimitBox(); ?>
			</td>
		</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="20">
					<input type="checkbox" name="link_toggle" value="" onclick="link_checkAll(<?php echo count( $links ); ?>);" />
				</th>
				<th class="title" width="20%" nowrap="nowrap"><?php echo $_MT_LANG->LISTING ?></th>
				<th width="65%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th width="100"><?php echo $_MT_LANG->REVIEWS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $links ); $i < $n; $i++) {
			$row = &$links[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td width="20">
					<input type="checkbox" id="lb<?php echo $i;?>" name="lid[]" value="<?php echo $row->link_id; ?>" onclick="link_isChecked(this.checked);" />
				</td>
				<td><a href="#edit" onclick="return link_listItemTask('lb<?php echo $i;?>','editlink')"><?php echo $row->link_name; ?></a></td>
				<td><?php echo $pathWay->printPathWayFromLink( $row->link_id, '' ); ?></td>


				<td align="center"><a href="index2.php?option=com_mtree&task=reviews_list&link_id=<?php echo $row->link_id; ?>"><?php echo $row->reviews; ?></a></td>
				<?php
				$task = $row->link_featured ? 'link_unfeatured' : 'link_featured';
				$img = $row->link_featured ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return link_listItemTask('lb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
				<?php
				//$task = $row->link_published ? 'link_unpublish' : 'link_publish';
				//$img = $row->link_published ? 'tick.png' : 'publish_x.png';
				?>
				<?php

				$now = date( "Y-m-d h:i:s" );
				if ( $now <= $row->publish_up && $row->link_published == "1" ) {
					$img = 'publish_y.png';
				} else if ( ( $now <= $row->publish_down || $row->publish_down == "0000-00-00 00:00:00" ) && $row->link_published == "1" ) {
					$img = 'publish_g.png';
				} else if ( $now > $row->publish_down && $row->link_published == "1" ) {
					$img = 'publish_r.png';
				} elseif ( $row->link_published == "0" ) {
					$img = "publish_x.png";
				}
				$task = $row->link_published ? 'link_unpublish' : 'link_publish';

				?>

			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return link_listItemTask('lb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>


			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="6"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="6"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="search_where" value="<?php echo $search_where ?>" />
		<input type="hidden" name="search_text" value="<?php echo $search_text ?>" />
		<input type="hidden" name="link_boxchecked" value="0" />
		</form>
	<?php
	}

	function searchresults_categories( &$rows, &$pageNav, &$pathWay, $search_where, $search_text, $option ) {
		global $_MT_LANG;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname"><?php echo $_MT_LANG->SEARCH_RESULTS ?> - <?php echo $_MT_LANG->CATEGORIES ?></td>
			<td nowrap="nowrap"><?php echo $_MT_LANG->DISPLAY ?></td>
			<td>
				<?php echo $pageNav->writeLimitBox(); ?>
			</td>
		</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
				</th>
				<th class="title" width="25%" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th align="left" width="65%"><?php echo $_MT_LANG->PARENT ?></th>
				<th><?php echo $_MT_LANG->CATEGORIES ?></th>
				<th><?php echo $_MT_LANG->LISTINGS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i]; ?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20">
					<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->cat_id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td width="50%" align="left">
					<a href="#go" onclick="return listItemTask('cb<?php echo $i;?>','listcats')"><?php 
						echo $row->cat_name; ?></a>
				</td>
				<td align="left"><?php echo $pathWay->printPathWayFromCat( $row->cat_id, 0 ); ?></td>
				<td align="center"><?php echo $row->cat_cats; ?></td>
				<td align="center"><?php echo $row->cat_links; ?></td>
				<?php
				$task = $row->cat_featured ? 'cat_unfeatured' : 'cat_featured';
				$img = $row->cat_featured ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
				<?php
				$task = $row->cat_published ? 'cat_unpublish' : 'cat_publish';
				$img = $row->cat_published ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="7"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="7"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="search_where" value="<?php echo $search_where ?>" />
		<input type="hidden" name="search_text" value="<?php echo $search_text ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
	<?php
	}

	/***
	* Tree Template
	*/

	function editLanguage( $default_language, $active_language, $content, $rows, $option ) {
		global $mt_template, $_MT_LANG, $mosConfig_absolute_path;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th class="langmanager"><?php echo $_MT_LANG->LANGUAGES ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
			<th width="25%" class="title"><?php echo $_MT_LANG->LANGUAGE ?></th>
			<th width="10%"><?php echo $_MT_LANG->VERSION ?></th>
			<th width="10%"><?php echo $_MT_LANG->DATE ?></th>
			<th width="20%"><?php echo $_MT_LANG->AUTHOR ?></th>
			<th width="25%"><?php echo $_MT_LANG->EMAIL ?></th>
			<th width="10%"><?php echo $_MT_LANG->DEFAULT ?></th>
			</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td>
				<!--- <input type="radio" name="template" value="<?php echo $row->language; ?>" onClick=""<?php echo ($cur_language == $row->language) ? 'checked="on"' : '';?> /> <?php echo $row->name; ?></td> --->
				<input type="radio" id="<?php echo $row->language; ?>" name="page" value="<?php echo $row->language; ?>" <?php if ($active_language == $row->language) echo 'checked="on" ' ?> /><a href="#go" onclick="return listItemTask('<?php echo $row->language; ?>','edit_language')"><?php echo $row->name; ?></a>

				<td><?php echo $row->version ?></td>
				<td><?php echo $row->creationdate ?></td>
				<td><?php echo $row->author ?></td>
				<td><a href="mailto:<?php echo $row->authorEmail ?>"><?php echo $row->authorEmail ?></a></td>
				<td align="center"><?php echo ($default_language == $row->language) ? '<img src="images/tick.png">' : '&nbsp;' ; ?></td>

			</tr>
			<?php		$k = 1 - $k; } ?>
		</table>

		<p />
		
		<!--- ******************************************** --->

		<script language="Javascript">
		<!--
		/*
		Select and Copy form element script- By Dynamicdrive.com
		For full source, Terms of service, and 100s DTHML scripts
		Visit http://www.dynamicdrive.com
		*/

		//specify whether contents should be auto copied to clipboard (memory)
		//Applies only to IE 4+
		//0=no, 1=yes
		var copytoclip=1;

		function HighlightAll(theField) {
		var tempval=eval("document."+theField)
		tempval.focus()
		tempval.select()
		if (document.all&&copytoclip==1){
		therange=tempval.createTextRange()
		therange.execCommand("Copy")
		//window.status="Contents highlighted and copied to clipboard!"
		setTimeout("window.status=''",1800)
		}
		}
		//-->
		</script>

		<table class="adminform">
		<tr>
			<th colspan="4">
			/components/com_mtree/language/<?php echo $active_language; ?>.php
      		<?php
      		$language_file = $mosConfig_absolute_path . '/components/com_mtree/language/' . $active_language . '.php';
      		echo is_writable( $language_file ) ? '<b><font color="orange"> - '.$_MT_LANG->WRITEABLE.'</font></b>' : '<b><font color="red"> - '.$_MT_LANG->UNWRITEABLE.'</font></b>';
      		?>
			</th>
		</tr>
		<tr>
			<td>
			<textarea cols="90" rows="50" name="pagecontent" class="inputbox"><?php echo $content; ?></textarea>
			</td>
		</tr>
		</table>
						<a href="javascript:HighlightAll('adminForm.pagecontent')"><?php echo $_MT_LANG->COPY_PAGE_TO_CLIPBOARD ?></a>

		<!--- ******************************************** --->

		<input type="hidden" name="language" value="<?php echo $active_language; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		</form>

		<?php
	}


	/***
	* Tree Template
	*/

	function list_templates( $rows, $option ) {
		global $mt_template, $_MT_LANG;
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th class="templates"><?php echo $_MT_LANG->TREE_TEMPLATES ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->NAME ?></th>
				<th class="title" width="60%" nowrap="nowrap"><?php echo $_MT_LANG->DESCRIPTION ?></th>
				<th class="title" width="10%" nowrap="nowrap" align="center"><?php echo $_MT_LANG->DEFAULT ?></th>
			</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td><input type="radio" name="template" value="<?php echo $row->directory; ?>" onClick=""<?php echo ($row->default) ? 'checked="on"' : '';?> /> <?php echo $row->name; ?></td>
				<td><?php echo $row->description; ?></td>
				<td align="center"><?php echo ($row->default) ? '<img src="images/tick.png">' : '&nbsp;' ; ?></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
		</table>

		<p />

		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th colspan="3" class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->SELECT_TEMPLATE_FILE_TO_EDIT ?></th>
			</tr>

			<tr>
				<td width="33%" align="left" valign="top">
					
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
					
					<tr><td><h3><?php echo $_MT_LANG->LISTING ?></h3></td></tr>
					<tr><td>
						<input type="radio" id="cb1" name="page" value="page_listing" /><a href="#go" onclick="return listItemTask('cb1','edit_templatepage')"><?php echo $_MT_LANG->TEM_VIEW_LISTING ?></a>
					</td></tr>
					<tr><td>
						<input type="radio" id="cb2" name="page" value="sub_listingDetails" /><a href="#go" onclick="return listItemTask('cb2','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTING_DETAILS ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb3" name="page" value="sub_listingSummary" /><a href="#go" onclick="return listItemTask('cb3','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTING_SUMMARY ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb4" name="page" value="sub_listings" /><a href="#go" onclick="return listItemTask('cb4','edit_templatepage')"><?php echo $_MT_LANG->LISTINGS ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb5" name="page" value="page_addListing" /><a href="#go" onclick="return listItemTask('cb5','edit_templatepage')"><?php echo $_MT_LANG->ADD_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb6" name="page" value="page_contactOwner" /><a href="#go" onclick="return listItemTask('cb6','edit_templatepage')"><?php echo $_MT_LANG->CONTACT_OWNER ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb7" name="page" value="page_writeReview" /><a href="#go" onclick="return listItemTask('cb7','edit_templatepage')"><?php echo $_MT_LANG->WRITE_REVIEW ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb8" name="page" value="page_print" /><a href="#go" onclick="return listItemTask('cb8','edit_templatepage')"><?php echo $_MT_LANG->PRINT ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb9" name="page" value="sub_reviews" /><a href="#go" onclick="return listItemTask('cb9','edit_templatepage')"><?php echo $_MT_LANG->REVIEWS ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb10" name="page" value="page_rating" /><a href="#go" onclick="return listItemTask('cb10','edit_templatepage')"><?php echo $_MT_LANG->TEM_RATING_FORM ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb11" name="page" value="page_recommend" /><a href="#go" onclick="return listItemTask('cb11','edit_templatepage')"><?php echo $_MT_LANG->TEM_RECOMMEND_FORM ?></a></td></tr>
					
					</table>

				</td>
				<td width="33%" align="left" valign="top">

					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">

					<tr><td><h3><?php echo $_MT_LANG->INDEX ?></h3>
					<tr><td>
						<input type="radio" id="cb12" name="page" value="page_index" /><a href="#go" onclick="return listItemTask('cb12','edit_templatepage')"><?php echo $_MT_LANG->MAIN ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb13" name="page" value="page_subCatIndex" /><a href="#go" onclick="return listItemTask('cb13','edit_templatepage')"><?php echo $_MT_LANG->CATEGORY ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb14" name="page" value="page_listAlpha" /><a href="#go" onclick="return listItemTask('cb14','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTALPHA ?></a></td></tr>

					<tr><td>
						<input type="radio" id="cb15" name="page" value="page_mostRated" /><a href="#go" onclick="return listItemTask('cb15','edit_templatepage')"><?php echo $_MT_LANG->MOST_RATED_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb16" name="page" value="page_mostReviewed" /><a href="#go" onclick="return listItemTask('cb16','edit_templatepage')"><?php echo $_MT_LANG->MOST_REVIEWED_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb17" name="page" value="page_topRated" /><a href="#go" onclick="return listItemTask('cb17','edit_templatepage')"><?php echo $_MT_LANG->TOP_RATED_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb18" name="page" value="page_new" /><a href="#go" onclick="return listItemTask('cb18','edit_templatepage')"><?php echo $_MT_LANG->NEW_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb30" name="page" value="page_featured" /><a href="#go" onclick="return listItemTask('cb30','edit_templatepage')"><?php echo $_MT_LANG->FEATURED_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb19" name="page" value="page_popular" /><a href="#go" onclick="return listItemTask('cb19','edit_templatepage')"><?php echo $_MT_LANG->POPULAR_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb20" name="page" value="page_myListing" /><a href="#go" onclick="return listItemTask('cb20','edit_templatepage')"><?php echo $_MT_LANG->MY_LISTING ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb31" name="page" value="page_ownerListing" /><a href="#go" onclick="return listItemTask('cb31','edit_templatepage')"><?php echo $_MT_LANG->OWNERS_LISTING ?></a></td></tr>

					</table>
			
				</td>
				<td width="33%" align="left" valign="top">

					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">

					<tr><td><h3><?php echo $_MT_LANG->CATEGORY ?></h3></td></tr>
					<tr><td>
						<input type="radio" id="cb21" name="page" value="page_addCategory" /><a href="#go" onclick="return listItemTask('cb21','edit_templatepage')"><?php echo $_MT_LANG->ADD_CAT ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb22" name="page" value="sub_subCats" /><a href="#go" onclick="return listItemTask('cb22','edit_templatepage')"><?php echo $_MT_LANG->TEM_SUBCATS ?></a></td></tr>

					</table>
					<br />
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">

					<tr><td><h3><?php echo $_MT_LANG->MISC ?></h3></td></tr>
					<tr><td>
						<input type="radio" id="cb23" name="page" value="page_advSearch" /><a href="#go" onclick="return listItemTask('cb23','edit_templatepage')"><?php echo $_MT_LANG->ADVANCED_SEARCH ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb24" name="page" value="page_advSearchRedirect" /><a href="#go" onclick="return listItemTask('cb24','edit_templatepage')"><?php echo $_MT_LANG->ADVANCED_SEARCH_REDIRECT ?></a></td></tr>
											<tr><td>
						<input type="radio" id="cb25" name="page" value="page_advSearchResults" /><a href="#go" onclick="return listItemTask('cb25','edit_templatepage')"><?php echo $_MT_LANG->ADVANCED_SEARCH_RESULTS ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb26" name="page" value="page_searchResults" /><a href="#go" onclick="return listItemTask('cb26','edit_templatepage')"><?php echo $_MT_LANG->SEARCH_RESULTS ?></a></td></tr>

					<tr><td>
						<input type="radio" id="cb27" name="page" value="page_confirmDelete" /><a href="#go" onclick="return listItemTask('cb27','edit_templatepage')"><?php echo $_MT_LANG->TEM_CONFIRM_DELETE ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb28" name="page" value="page_error" /><a href="#go" onclick="return listItemTask('cb28','edit_templatepage')"><?php echo $_MT_LANG->ERROR ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb29" name="page" value="page_errorListing" /><a href="#go" onclick="return listItemTask('cb29','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTING_ERROR ?></a></td></tr>
					<tr><td>
						<input type="radio" id="cb32" name="page" value="sub_alphaIndex" /><a href="#go" onclick="return listItemTask('cb32','edit_templatepage')"><?php echo $_MT_LANG->TEM_AZ ?></a></td></tr>

					</table>
						
				</td>
			</tr>
		</table>

		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		</form>
		<?php
	}

	function edit_templatepage( $page, $template, $content, $option ) {
		global $mosConfig_absolute_path, $_MT_LANG;
		?>
		<script language="Javascript">
		<!--
		/*
		Select and Copy form element script- By Dynamicdrive.com
		For full source, Terms of service, and 100s DTHML scripts
		Visit http://www.dynamicdrive.com
		*/

		//specify whether contents should be auto copied to clipboard (memory)
		//Applies only to IE 4+
		//0=no, 1=yes
		var copytoclip=1;

		function HighlightAll(theField) {
		var tempval=eval("document."+theField)
		tempval.focus()
		tempval.select()
		if (document.all&&copytoclip==1){
		therange=tempval.createTextRange()
		therange.execCommand("Copy")
		//window.status="Contents highlighted and copied to clipboard!"
		setTimeout("window.status=''",1800)
		}
		}
		//-->
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="templates"><?php echo $_MT_LANG->TEMPLATE_PAGE_EDITOR ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="4">
			/components/com_mtree/templates/<?php echo $template; ?>/<?php echo $page; ?>.tpl.php
      		<?php
      		$template_path = $mosConfig_absolute_path . '/components/com_mtree/templates/' . $template . '/'.$page.'.tpl.php';
      		echo is_writable( $template_path ) ? '<b><font color="orange"> - '.$_MT_LANG->WRITEABLE.'</font></b>' : '<b><font color="red"> - '.$_MT_LANG->UNWRITEABLE.'</font></b>';
      		?>
			</th>
		</tr>
		<tr>
			<td>
			<textarea cols="90" rows="25" name="pagecontent" class="inputbox"><?php echo $content; ?></textarea>
			</td>
		</tr>
		</table>
						<a href="javascript:HighlightAll('adminForm.pagecontent')"><?php echo $_MT_LANG->COPY_PAGE_TO_CLIPBOARD ?></a>
		<input type="hidden" name="template" value="<?php echo $template; ?>" />
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}
	
	/***
	* Advanced Back-end Search
	*/
	function advsearch( $custom_fields, $lists, $option ) {
		global $_MT_LANG;
		?>

		<table class="sectionname"><tr><th><?php echo $_MT_LANG->ADVANCED_SEARCH ?></th></tr></table>

		<form action="index2.php" method="post" name="adminForm">

		<!-- START --->
		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
				<th class="title" colspan="2" width="100%" nowrap="nowrap"><?php echo $_MT_LANG->SEARCH_LISTINGS ?></th>
			</tr>
			<tr>
				<td width="50%" valign="top">
					<table cellpadding="4" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="24%" align="left"><?php echo $_MT_LANG->NAME ?>:</td>
							<td width="76%" align="left"><input name="link_name" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->DESCRIPTION ?>:</td>
							<td align="left"><input name="link_desc" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->WEBSITE?>:</td>
							<td align="left"><input name="website" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->ADDRESS?>:</td>
							<td align="left"><input name="address" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->CITY?>:</td>
							<td align="left"><input name="city" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->COUNTRY?>:</td>
							<td align="left"><input name="country" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->POSTCODE?>:</td>
							<td align="left"><input name="postcode" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->TELEPHONE?>:</td>
							<td align="left"><input name="telephone" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->FAX?>:</td>
							<td align="left"><input name="fax" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->EMAIL?>:</td>
							<td align="left"><input name="email" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->OWNER?>:</td>
							<td align="left"><input name="owner" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->IMAGE?>:</td>
							<td align="left"><input name="link_image" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->PRICE?>:</td>
							<td align="left"><?php echo $lists['price'] ?> <input name="price" type="text" class="text_area" size="8" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->PUBLISHING?>:</td>
							<td align="left"><?php echo $lists['publishing'] ?></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->RATING?>:</td>
							<td align="left"><?php echo $lists['rating'] ?> <input name="link_rating" type="text" class="text_area" size="8" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->HITS?>:</td>
							<td align="left"><?php echo $lists['hits'] ?> <input name="link_hits" type="text" class="text_area" size="8" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->VOTES?>:</td>
							<td align="left"><?php echo $lists['votes'] ?> <input name="link_votes" type="text" class="text_area" size="8" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->TEMPLATE?>:</td>
							<td align="left"><?php echo $lists['templates'] ?></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->REVIEWS?>:</td>
							<td align="left"><?php echo $lists['reviews'] ?> <input name="reviews" type="text" class="text_area" size="8" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->NOTES?>:</td>
							<td align="left" colspan="3"><input name="internal_notes" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->META_KEYWORDS?>:</td>
							<td align="left" colspan="3"><input name="metakey" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->META_DESCRIPTION?>:</td>
							<td align="left" colspan="3"><input name="metadesc" type="text" class="text_area" size="20" /></td>
						</tr>
					</table>	
				</td>
				<td width="50%">
					<table cellpadding="4" cellspacing="0" border="0" width="100%">
						<?php 
						for( $i=1; $i<=30; $i++ ) {
							if (!empty($custom_fields["cust_$i"]->value)) { 
						?>
						<tr>
						<td width="30%" align="left"><?php echo $custom_fields["cust_$i"]->value ?>:</td>
						<td width="70%" align="left"><input name="<?php echo "cust_$i" ?>" type="text" class="text_area" size="20" /></td>
						</tr>
						<?php } } ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;&nbsp;<input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" /> &nbsp; <input type="reset" value="<?php echo $_MT_LANG->RESET ?>" class="button" />
			</tr>
		</table>
		
		<!--- END --->

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="advsearch2" />
		<input type="hidden" name="search_where" value="1" />

		</form>

		<?php		
	}

	function advsearchresults_links( &$links, &$pageNav, &$pathWay, $search_where, $option ) {
		global $_MT_LANG;
	?>
		<script language="javascript" type="text/javascript">
			function link_listItemTask( id, task ) {
				var f = document.adminForm;
				lb = eval( 'f.' + id );
				if (lb) {
					lb.checked = true;
					submitbutton(task);
				}
				return false;
			}

			function link_isChecked(isitchecked){
				if (isitchecked == true){
					document.adminForm.link_boxchecked.value++;
				}
				else {
					document.adminForm.link_boxchecked.value--;
				}
			}

			function link_checkAll( n ) {
				var f = document.adminForm;
				var c = f.link_toggle.checked;
				var n2 = 0;
				for (i=0; i < n; i++) {
					lb = eval( 'f.lb' + i );
					if (lb) {
						lb.checked = c;
						n2++;
					}
				}
				if (c) {
					document.adminForm.link_boxchecked.value = n2;
				} else {
					document.adminForm.link_boxchecked.value = 0;
				}
			}

		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname"><?php echo $_MT_LANG->ADVANCED_SEARCH_RESULTS ?> - <?php echo $_MT_LANG->LISTINGS ?></td>
			<td nowrap="nowrap"><?php echo $_MT_LANG->DISPLAY ?></td>
			<td>
				<?php echo $pageNav->writeLimitBox(); ?>
			</td>
		</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="20">
					<input type="checkbox" name="link_toggle" value="" onclick="link_checkAll(<?php echo count( $links ); ?>);" />
				</th>
				<th class="title" width="20%" nowrap="nowrap"><?php echo $_MT_LANG->LISTING ?></th>
				<th width="65%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th width="100"><?php echo $_MT_LANG->REVIEWS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $links ); $i < $n; $i++) {
			$row = &$links[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td width="20">
					<input type="checkbox" id="lb<?php echo $i;?>" name="lid[]" value="<?php echo $row->link_id; ?>" onclick="link_isChecked(this.checked);" />
				</td>
				<td><a href="#edit" onclick="return link_listItemTask('lb<?php echo $i;?>','editlink')"><?php echo $row->link_name; ?></a></td>
				<td><?php echo '<a href="index2.php?option=com_mtree&task=listcats&cat_id='.$row->cat_id.'">'.$pathWay->getCatName( $row->cat_id ).'</a>'; ?></td>


				<td align="center"><a href="index2.php?option=com_mtree&task=reviews_list&link_id=<?php echo $row->link_id; ?>"><?php echo $row->reviews; ?></a></td>
				<?php
				$task = $row->link_featured ? 'link_unfeatured' : 'link_featured';
				$img = $row->link_featured ? 'tick.png' : 'publish_x.png';
				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return link_listItemTask('lb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>
				<?php

				$now = date( "Y-m-d h:i:s" );
				if ( $now <= $row->publish_up && $row->link_published == "1" ) {
					$img = 'publish_y.png';
				} else if ( ( $now <= $row->publish_down || $row->publish_down == "0000-00-00 00:00:00" ) && $row->link_published == "1" ) {
					$img = 'publish_g.png';
				} else if ( $now > $row->publish_down && $row->link_published == "1" ) {
					$img = 'publish_r.png';
				} elseif ( $row->link_published == "0" ) {
					$img = "publish_x.png";
				}
				$task = $row->link_published ? 'link_unpublish' : 'link_publish';

				?>
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return link_listItemTask('lb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a>
				</td>


			</tr>
			<?php		$k = 1 - $k; } ?>
			<tr>
				<th align="center" colspan="6"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="6"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="advsearch2" />
		<input type="hidden" name="link_boxchecked" value="0" />
		<input type="hidden" name="search_where" value="<?php echo $search_where ?>" />

		<input type="hidden" name="link_name" value="<?php echo $_POST['link_name'] ?>" />
		<input type="hidden" name="link_desc" value="<?php echo $_POST['link_desc'] ?>" />
		<input type="hidden" name="website" value="<?php echo $_POST['website'] ?>" />
		<input type="hidden" name="address" value="<?php echo $_POST['address'] ?>" />
		<input type="hidden" name="city" value="<?php echo $_POST['city'] ?>" />
		<input type="hidden" name="country" value="<?php echo $_POST['country'] ?>" />
		<input type="hidden" name="postcode" value="<?php echo $_POST['postcode'] ?>" />
		<input type="hidden" name="telephone" value="<?php echo $_POST['telephone'] ?>" />
		<input type="hidden" name="fax" value="<?php echo $_POST['fax'] ?>" />
		<input type="hidden" name="email" value="<?php echo $_POST['email'] ?>" />
		<input type="hidden" name="publishing" value="<?php echo $_POST['publishing'] ?>" />
		<input type="hidden" name="link_template" value="<?php echo $_POST['link_template'] ?>" />
		<input type="hidden" name="price" value="<?php echo $_POST['price'] ?>" />
		<input type="hidden" name="opt_price" value="<?php echo $_POST['opt_price'] ?>" />
		<input type="hidden" name="link_rating" value="<?php echo $_POST['link_rating'] ?>" />
		<input type="hidden" name="opt_rating" value="<?php echo $_POST['opt_rating'] ?>" />
		<input type="hidden" name="link_votes" value="<?php echo $_POST['link_votes'] ?>" />
		<input type="hidden" name="opt_votes" value="<?php echo $_POST['opt_votes'] ?>" />
		<input type="hidden" name="link_hits" value="<?php echo $_POST['link_hits'] ?>" />
		<input type="hidden" name="opt_hits" value="<?php echo $_POST['opt_hits'] ?>" />
		<input type="hidden" name="link_image" value="<?php echo $_POST['link_image'] ?>" />
		<?php
		for($c=1;$c<=30;$c++) {
			if( array_key_exists('cust_'.$c, $_POST) ) {
		?><input type="hidden" name="cust_<?php echo $c ?>" value="<?php echo $_POST['cust_'.$c] ?>" /><?php 
			}
		} ?>
		<input type="hidden" name="internal_notes" value="<?php echo $_POST['internal_notes'] ?>" />
		<input type="hidden" name="metakey" value="<?php echo $_POST['metakey'] ?>" />
		<input type="hidden" name="metadesc" value="<?php echo $_POST['metadesc'] ?>" />
		</form>
	<?php
	}

	/***
	* CSV Import/Export
	*/

	function csv( $custom_fields, $lists, $option ) {
		global $_MT_LANG;
	?>
  <script type="text/javascript" language="javascript">
		function submitbutton( pressbutton ) {
			var form = document.adminForm;

			// do field validation

			var elts      = document.adminForm.elements['fields[]'];
			var elts_cnt  = (typeof(elts.length) != 'undefined')
										? elts.length
										: 0;

			temp = false;
			for (var i = 0; i < elts_cnt; i++) {
					if (elts[i].checked == true) temp = true;
			} 

			if (temp == true) {
				submitform( pressbutton );
			} else {
				alert('<?php echo $_MT_LANG->PLEASE_SELECT_AT_LEAST_ONE_FIELD ?>');
			}
		}

		function setCheckboxes(the_form, do_check)
		{
				var elts      = document.forms[the_form].elements['fields[]'];
				var elts_cnt  = (typeof(elts.length) != 'undefined')
											? elts.length
											: 0;

				if (elts_cnt) {
						for (var i = 0; i < elts_cnt; i++) {
								elts[i].checked = do_check;
						} // end for
				} else {
						elts.checked        = do_check;
				} // end if... else

				return true;
		} // end of the 'setCheckboxes()' function
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table>
			<tr>
				<th class="sectionname"><?php echo $_MT_LANG->EXPORT ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th colspan="4" class="title" width="100%" nowrap="nowrap"><?php echo $_MT_LANG->EXPORT ?></th>
			</tr>
			
			<tr class="row0"><td colspan="4" align="left"><b><?php echo $_MT_LANG->FIELDS ?></b></td></tr>

			<tr>
				<td width="33%" valign="top" align="left">
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="l.link_id" /><?php echo $_MT_LANG->LISTING_ID ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_name" /><?php echo $_MT_LANG->NAME ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_desc" /><?php echo $_MT_LANG->DESCRIPTION ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="website" /><?php echo $_MT_LANG->WEBSITE ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="address" /><?php echo $_MT_LANG->ADDRESS ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="city" /><?php echo $_MT_LANG->CITY ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="country" /><?php echo $_MT_LANG->COUNTRY ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="postcode" /><?php echo $_MT_LANG->POSTCODE ?>
						</td></tr>
					</table>

				</td>
				<td width="33%" valign="top">
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="telephone" /><?php echo $_MT_LANG->TELEPHONE ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="fax" /><?php echo $_MT_LANG->FAX ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="email" /><?php echo $_MT_LANG->EMAIL ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_image" /><?php echo $_MT_LANG->IMAGE ?>
						</td></tr>

						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="cat_id" /><?php echo $_MT_LANG->CATEGORY ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="user_id" /><?php echo $_MT_LANG->OWNER ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_created" /><?php echo $_MT_LANG->CREATED ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_modified" /><?php echo $_MT_LANG->MODIFIED ?>
						</td></tr>
					</table>
				</td>
				<td width="33%" valign="top">
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_hits" /><?php echo $_MT_LANG->HITS ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="price" /><?php echo $_MT_LANG->PRICE ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_rating" /><?php echo $_MT_LANG->RATING ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="link_votes" /><?php echo $_MT_LANG->VOTES ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="internal_notes" /><?php echo $_MT_LANG->INTERNAL_NOTES ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="metakey" /><?php echo $_MT_LANG->META_KEYWORDS ?>
						</td></tr>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="metadesc" /><?php echo $_MT_LANG->META_DESCRIPTION ?>
						</td></tr>
					</table>
				</td>

			</tr>
			<tr>
				<?php 
					if ( count($custom_fields) <= 10 ) {
						$td_width = "100%";
						$td_colspan = 3;
					} elseif ( count($custom_fields) > 10 && count($custom_fields) <= 20 ) {
						$td_width = "33%";
						$td_colspan = 2;
					}	else {
						$td_width = "33%";
						$td_colspan = 1;
					}
				?>
				<td align="left" width="<?php echo $td_width ?>" valign="top" <?php if ($td_colspan == 3) echo 'colspan="3"' ?>>
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
					<?php for( $i=0; $i<10 && array_key_exists($i,$custom_fields); $i++ ) { ?>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="<?php echo $custom_fields[$i]->name ?>" /> <?php echo $custom_fields[$i]->value ?>
						</td></tr>
					<?php } ?>
					</table>
					<a href="#" onclick="setCheckboxes('adminForm', true); return false;"><?php echo $_MT_LANG->SELECT_ALL ?></a> / <a href="#" onclick="setCheckboxes('adminForm', false); return false;"><?php echo $_MT_LANG->UNSELECT_ALL ?></a>
				</td>

				<?php if ($td_colspan < 3) { ?>
				<td width="<?php echo $td_width ?>" valign="top" <?php if ($td_colspan == 2) echo 'colspan="2"' ?>>
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
					<?php for( $i=10; $i<20 && array_key_exists($i,$custom_fields); $i++ ) { ?>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="<?php echo $custom_fields[$i]->name ?>" /> <?php echo $custom_fields[$i]->value ?>
						</td></tr>
					<?php } ?>
					</table>
				</td>
				<?php } ?>

				<?php if ($td_colspan < 2) { ?>
				<td width="<?php echo $td_width ?>" valign="top">
					<table cellpadding="4" cellspacing="0" border="1" width="100%" class="adminlist">
					<?php for( $i=20; $i<30 && array_key_exists($i,$custom_fields); $i++ ) { ?>
						<tr><td align="left">
							<input type="checkbox" name="fields[]" value="<?php echo $custom_fields[$i]->name ?>" /> <?php echo $custom_fields[$i]->value ?>
						</td></tr>
					<?php } ?>
					</table>
				</td>
				<?php } ?>
	
			</tr>
			<tr><td colspan="3"></td></tr>

			<tr class="row0"><td colspan="3" align="left"><b><?php echo $_MT_LANG->PUBLISHING ?></b></td></tr>
			<tr><td align="left" colspan="3">
				<?php echo $lists['publishing'] ?>
				<p />
				<input type="button" class="button" value="<?php echo $_MT_LANG->EXPORT ?>" onClick="javascript:submitbutton('csv_export')" />
			</td></tr>
			
		</table>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		</form>
	<?php
	}

	function csv_export( $header, $data, $option ) {
		global $_MT_LANG;
	?>
	<script language="Javascript">
	<!--
	/*
	Select and Copy form element script- By Dynamicdrive.com
	For full source, Terms of service, and 100s DTHML scripts
	Visit http://www.dynamicdrive.com
	*/

	//specify whether contents should be auto copied to clipboard (memory)
	//Applies only to IE 4+
	//0=no, 1=yes
	var copytoclip=1

	function HighlightAll(theField) {
	var tempval=eval("document."+theField)
	tempval.focus()
	tempval.select()
	if (document.all&&copytoclip==1){
	therange=tempval.createTextRange()
	therange.execCommand("Copy")
	window.status="Contents highlighted and copied to clipboard!"
	setTimeout("window.status=''",1800)
	}
	}
	//-->
	</script>

	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr><td width="100%" align="left"><span class="sectionname"><?php echo $_MT_LANG->EXPORT ?></span></td></tr>
	</table>

	<center>
	<form action="index2.php" method="POST" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr class="row0">
			<td>
			<p />
			<a href="javascript:HighlightAll('adminForm.csv_excel')"><?php echo $_MT_LANG->SELECT_ALL ?></a>
			<p />
			<textarea name="csv_excel" rows="30" cols="80"><?php 
				echo $header; 
				echo $data;
			?></textarea>
			<p />
			<a href="javascript:HighlightAll('adminForm.csv_excel')"><?php echo $_MT_LANG->SELECT_ALL ?></a>
			</td>
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="doreport" />
	</form>
	</center>
	<?php
	}

	/***
	* Custom Fields
	*/

	function customfields( $custom_fields, $option ) {
		global $_MT_LANG;
	?>
	<form action="index2.php" method="post" name="adminForm" id="adminForm">

	<table class="adminheading">
		<tr>
			<th class="menus"><?php echo $_MT_LANG->CUSTOM_FIELDS ?></td>
		</tr>
	</table>

	<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $_MT_LANG->CUSTOM_FIELDS ?></th>
		</tr>
		<?php
		for( $i=1; $i<=30; $i++) {
			?>
		<tr>
			<td width="130"><?php echo $_MT_LANG->CUSTOM_FIELD . " #$i" ?>:</td>
			<td width="85%" align="left"><input type="text" class="text_area" size="30" name="cust_<?php echo $i ?>" value="<?php echo $custom_fields['cust_'.$i]->value ?>"></td>
		</tr>
			<?php
		}
		?>
	</table>

	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="save_customfields" />

	</form>
	<?php
	}

	/***
	* Configuration
	*/
	function config( $row, $custom_fields, $lists, $imageLibs, $option ) {
		global $_MT_LANG;

		# Initialize Tabs
		$tabs = new mosTabs(0);
	?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'saveconfig') {
			submitform( pressbutton );
		} else {
			document.location.href = 'index2.php';
		}
	}
</script>

<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
  <tr>
    <th width="100%" class="config"><?php echo mt_name ." ". $_MT_LANG->CONFIGURATION ?>: <span class="componentheading"><?php echo is_writable( 'components/com_mtree/config.mtree.php' ) ? '<b><font color="green">'.$_MT_LANG->WRITABLE.'</font></b>' : '<b><font color="red">'.$_MT_LANG->NOT_WRITABLE.'</font></b>' ?>
</span></th>
  </tr>
</table>

<form action="index2.php" method="POST" name="adminForm">
	<?php
	$tabs->startPane("content-pane");
	$tabs->startTab( $_MT_LANG->MAIN, "main-page");
	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->LANGUAGE ?>:</td>
			<td align="left" width="78%"><?php echo $lists['language'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->DEFAULT_TEMPLATE ?>:</td>
			<td align="left"><?php echo $lists['template'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->DEFAULT_MAP ?>:</td>
			<td align="left"><?php echo $lists['map'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->ADMIN_EMAIL ?>:</td>
			<td align="left"><input type="text" class="text_area" name="admin_email" value="<?php echo $row->admin_email ?>" /></td>
		</tr>
		<tr>
			<td align="left" valign="top"><?php echo $_MT_LANG->USER_ADDLISTING ?>:</td>
			<td align="left"><?php echo $lists['user_addlisting'] ?></td>
		</tr>
		<tr>
			<td align="left" valign="top"><?php echo $_MT_LANG->USER_ADDCATEGORY ?>:</td>
			<td align="left"><?php echo $lists['user_addcategory'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USER_ALLOWMODIFY ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('user_allowmodify','class="text_area"',$row->user_allowmodify); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USER_ALLOWDELETE ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('user_allowdelete','class="text_area"',$row->user_allowdelete); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NEEDAPPROVAL_ADDLISTING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('needapproval_addlisting','class="text_area"',$row->needapproval_addlisting); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NEEDAPPROVAL_ADDCATEGORY ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('needapproval_addcategory','class="text_area"',$row->needapproval_addcategory); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NEEDAPPROVAL_MODIFYLISTING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('needapproval_modifylisting','class="text_area"',$row->needapproval_modifylisting); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NEEDAPPROVAL_ADDREVIEW ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('needapproval_addreview','class="text_area"',$row->needapproval_addreview); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->DAYS_NEWLISTING ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="link_new" value="<?php echo $row->link_new ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->HITS_POPULARLISTING ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="link_popular" value="<?php echo $row->link_popular ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SECONDS_NEXTVOTE ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="hit_lag" value="<?php echo $row->hit_lag ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USE_INTERNAL_NOTES ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('use_internal_notes','class="text_area"',$row->use_internal_notes); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->ALLOW_HTML ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('allow_html','class="text_area"',$row->allow_html); ?></td>
		</tr>
	</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( $_MT_LANG->IMAGES ,"images-page");
		?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr>
			<td align="left" width="185" valign="top"><?php echo $_MT_LANG->RESIZE_METHOD ?>:</td>
			<td align="left" width="78%"><?php echo $lists['resize_method'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NETPBM_PATH ?>:</td>
			<td align="left"><input type="text" class="text_area" size="20" name="img_netpbmpath" value="<?php echo $row->img_netpbmpath ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->IM_PATH ?>:</td>
			<td align="left"><input type="text" class="text_area" size="20" name="img_impath" value="<?php echo $row->img_impath ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->CATEGORY_IMAGE_SIZE ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="resize_cat_size" value="<?php echo $row->resize_cat_size ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->LISTING_IMAGE_SIZE ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="resize_listing_size" value="<?php echo $row->resize_listing_size ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->IMAGE_QUALITY ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="resize_quality" value="<?php echo $row->resize_quality ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->ALLOW_IMGUPLOAD ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('allow_imgupload','class="text_area"',$row->allow_imgupload); ?></td>
		</tr>
	</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( $_MT_LANG->LISTING ,"listing-page");
		?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr><td colspan="4" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->CATEGORY ?></b></td></tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->PRIMARY_ORDERING ?>:</td>
			<td align="left" width="78%" colspan="3"><?php echo $lists['first_cat_order1'] ?> <?php echo $lists['first_cat_order2'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SECONDARY_ORDERING ?>:</td>
			<td align="left" colspan="3"><?php echo $lists['second_cat_order1'] ?> <?php echo $lists['second_cat_order2'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_SUBCATS ?>:</td>
			<td align="left" colspan="3"><input type="text" class="text_area" size="8" name="fe_num_of_subcats" value="<?php echo $row->fe_num_of_subcats ?>" /></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_EMPTY_CATEGORY ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_empty_cat','class="text_area"',$row->display_empty_cat); ?></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_ALPHA_INDEX ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_alpha_index','class="text_area"',$row->display_alpha_index); ?></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->ALLOW_LISTINGS_SUBMISSION_IN_ROOT_CAT ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('allow_listings_submission_in_root','class="text_area"',$row->allow_listings_submission_in_root); ?></td>
		</tr>		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_LISTINGS_IN_ROOT_CAT ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_listings_in_root','class="text_area"',$row->display_listings_in_root); ?></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_CAT_COUNT_IN_ROOT_CAT ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_cat_count_in_root','class="text_area"',$row->display_cat_count_in_root); ?></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_LISTING_COUNT_IN_ROOT_CAT ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_listing_count_in_root','class="text_area"',$row->display_listing_count_in_root); ?></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_CAT_COUNT_IN_SUBCAT ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_cat_count_in_subcat','class="text_area"',$row->display_cat_count_in_subcat); ?></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_LISTING_COUNT_IN_SUBCAT ?></td>
			<td align="left" width="78%" colspan="3"><?php echo mosHTML::yesnoSelectList('display_listing_count_in_subcat','class="text_area"',$row->display_listing_count_in_subcat); ?></td>
		</tr>

		

		<tr><td colspan="4" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->LISTING ?></b></td></tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->PRIMARY_ORDERING ?>:</td>
			<td align="left" width="78%" colspan="3"><?php echo $lists['first_listing_order1'] ?> <?php echo $lists['first_listing_order2'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SECONDARY_ORDERING ?>:</td>
			<td align="left" colspan="3"><?php echo $lists['second_listing_order1'] ?> <?php echo $lists['second_listing_order2'] ?></td>
		</tr>
		<tr>
			<td align="left" width="20%"><?php echo $_MT_LANG->NUMBER_OF_CHARS ?>:</td>
			<td align="left" width="20%"><input type="text" class="text_area" size="8" name="fe_num_of_chars" value="<?php echo $row->fe_num_of_chars ?>" /></td>
			<td align="left" width="30%"><?php echo $_MT_LANG->NUMBER_OF_LISTING ?>:</td>
			<td align="left" width="30%"><input type="text" class="text_area" size="8" name="fe_num_of_links" value="<?php echo $row->fe_num_of_links ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_REVIEWS ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_reviews" value="<?php echo $row->fe_num_of_reviews ?>" /></td>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_POPULAR ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_popularlisting" value="<?php echo $row->fe_num_of_popularlisting ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_NEW ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_newlisting" value="<?php echo $row->fe_num_of_newlisting ?>" /></td>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_MOSTRATED ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_mostrated" value="<?php echo $row->fe_num_of_mostrated ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->TOTAL_OF_NEW ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_total_newlisting" value="<?php echo $row->fe_total_newlisting ?>" /></td>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_MOSTREVIEW ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_mostreview" value="<?php echo $row->fe_num_of_mostreview ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_TOPRATED ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_toprated" value="<?php echo $row->fe_num_of_toprated ?>" /></td>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_FEATURED ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_featured" value="<?php echo $row->fe_num_of_featured ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NUMBER_OF_SEARCHRESULTS ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fe_num_of_searchresults" value="<?php echo $row->fe_num_of_searchresults ?>" /></td>
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr><td colspan="4" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->SEARCH_RESULTS ?></b></td></tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->PRIMARY_ORDERING ?>:</td>
			<td align="left" width="78%" colspan="3"><?php echo $lists['first_search_order1'] ?> <?php echo $lists['first_search_order2'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SECONDARY_ORDERING ?>:</td>
			<td align="left" colspan="3"><?php echo $lists['second_search_order1'] ?> <?php echo $lists['second_search_order2'] ?></td>
		</tr>

	</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( $_MT_LANG->FEATURES ,"features-page");
		?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->MAP ?></b></td></tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->SHOW_MAP ?></td>
			<td align="left" width="78%"><?php echo mosHTML::yesnoSelectList('show_map','class="text_area"',$row->show_map); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->PRINT ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_PRINT ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_print','class="text_area"',$row->show_print); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->RECOMMEND ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_RECOMMEND ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_recommend','class="text_area"',$row->show_recommend); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USER_RECOMMEND ?>:</td>
			<td align="left"><?php echo $lists['user_recommend'] ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->RATING ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_RATING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_rating','class="text_area"',$row->show_rating); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USER_RATING ?>:</td>
			<td align="left"><?php echo $lists['user_rating'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->RATE_ONCE ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('rate_once','class="text_area"',$row->rate_once); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->MIN_VOTES_FOR_TOPRATED ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="min_votes_for_toprated" value="<?php echo $row->min_votes_for_toprated ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->MIN_VOTES_TO_SHOW_RATING ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="min_votes_to_show_rating" value="<?php echo $row->min_votes_to_show_rating ?>" /></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->REVIEW ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_REVIEW ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_review','class="text_area"',$row->show_review); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USER_REVIEW ?>:</td>
			<td align="left"><?php echo $lists['user_review'] ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->REVIEW_ONCE ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('user_review_once','class="text_area"',$row->user_review_once); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->CONTACT_OWNER ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_CONTACT ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_contact','class="text_area"',$row->show_contact); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->USE_OWNER_EMAIL ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('use_owner_email','class="text_area"',$row->use_owner_email); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_EMAIL ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_email','class="text_area"',$row->show_email); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->VISIT ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_VISIT ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_visit','class="text_area"',$row->show_visit); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->REPORT ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_REPORT ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_report','class="text_area"',$row->show_report); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->CLAIM ?></b><br /><?php echo $_MT_LANG->CLAIM_EXPLAINATION ?></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_CLAIM ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_claim','class="text_area"',$row->show_claim); ?></td>
		</tr>
		<tr><td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF"><b><?php echo $_MT_LANG->OWNERS_LISTING ?></b></td></tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->SHOW_OWNERS_LISTING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('show_ownerlisting','class="text_area"',$row->show_ownerlisting); ?></td>
		</tr>

	</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( $_MT_LANG->NOTIFY ,"notify-page");
		?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr>
			<td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; background-color: #FFFFFF">
			<?php echo $_MT_LANG->NOTIFY_CONFIGTEXT ?>
			</td>
		</tr>
		<tr>
			<td colspan="2"><b><?php echo $_MT_LANG->ADMIN ?></b></td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->NEW_LISTING ?>:</td>
			<td align="left" width="78%"><?php echo mosHTML::yesnoSelectList('notifyadmin_newlisting','class="text_area"',$row->notifyadmin_newlisting); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->MODIFY_LISTING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyadmin_modifylisting','class="text_area"',$row->notifyadmin_modifylisting); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->DELETE_LISTING2 ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyadmin_delete','class="text_area"',$row->notifyadmin_delete); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NEW_REVIEW ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyadmin_newreview','class="text_area"',$row->notifyadmin_newreview); ?></td>
		</tr>
		<tr>
			<td colspan="2"><b><?php echo $_MT_LANG->OWNER ?></b></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->NEW_LISTING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyuser_newlisting','class="text_area"',$row->notifyuser_newlisting); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->MODIFY_LISTING ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyuser_modifylisting','class="text_area"',$row->notifyuser_modifylisting); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->LISTING_APPROVED ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyuser_approved','class="text_area"',$row->notifyuser_approved); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->REVIEW_APPROVED ?>:</td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('notifyuser_review_approved','class="text_area"',$row->notifyuser_review_approved); ?></td>
		</tr>
	</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( $_MT_LANG->SEARCH ,"search-page");
		?>	
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr>
			<td align="left"><?php echo $_MT_LANG->PERFORM_FULLTEXT_SEARCH ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('fulltext_search','class="text_area"',$row->fulltext_search); ?></td>
		</tr>
		<tr>
			<td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; background-color: #FFFFFF">
			<?php echo $_MT_LANG->SEARCH_CONFIGTEXT ?>
			</td>
		</tr>
		<tr>
			<td align="left" width="155"><?php echo $_MT_LANG->NAME ?></td>
			<td align="left" width="85%"><?php echo mosHTML::yesnoSelectList('search_link_name','class="text_area"',$row->search_link_name); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->DESCRIPTION ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_link_desc','class="text_area"',$row->search_link_desc); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->ADDRESS ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_address','class="text_area"',$row->search_address); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->CITY ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_city','class="text_area"',$row->search_city); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->POSTCODE ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_postcode','class="text_area"',$row->search_postcode); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->STATE ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_state','class="text_area"',$row->search_state); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->COUNTRY ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_country','class="text_area"',$row->search_country); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->EMAIL ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_email','class="text_area"',$row->search_email); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->WEBSITE ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_website','class="text_area"',$row->search_website); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->TELEPHONE ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_telephone','class="text_area"',$row->search_telephone); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->FAX ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_fax','class="text_area"',$row->search_fax); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->META_KEYWORDS ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_metakey','class="text_area"',$row->search_metakey); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->META_DESCRIPTION ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_metadesc','class="text_area"',$row->search_metadesc); ?></td>
		</tr>

		<?php
			foreach( $custom_fields AS $cf ) {
				if ( !empty($cf->value) ) {
			?>
		<tr>
			<td align="left"><?php echo $cf->value ?></td>
			<td align="left"><?php echo mosHTML::yesnoSelectList('search_'.$cf->name,'class="text_area"',$cf->searchable); ?></td>
		</tr>
			<?php
				}
			}
		?>
	</table>
	<?php
	$tabs->endTab();
	$tabs->startTab( $_MT_LANG->ADMIN ,"admin-page");
	?>	
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
		<tr>
			<td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0; background-color: #FFFFFF">
			<?php echo $_MT_LANG->EXPLORER_CONFIGTEXT ?>
			</td>
		</tr>
		<tr>
			<td align="left" width="185"><?php echo $_MT_LANG->USE_EXPLORER ?></td>
			<td align="left" width="78%"><?php echo mosHTML::yesnoSelectList('admin_use_explorer','class="text_area"',$row->admin_use_explorer); ?></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->EXPLORER_TREE_LEVEL ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="explorer_tree_level" value="<?php echo $row->explorer_tree_level ?>" /></td>
		</tr>
		<tr>
			<td align="left"><?php echo $_MT_LANG->FULLMENU_TREE_LEVEL ?>:</td>
			<td align="left"><input type="text" class="text_area" size="8" name="fullmenu_tree_level" value="<?php echo $row->fullmenu_tree_level ?>" /></td>
		</tr>
	<?php
	$tabs->endTab();
	$tabs->endPane();
	?>
  <input type="hidden" name="option" value="<?php echo $option; ?>">
  <input type="hidden" name="task" value="saveconfig">
</form>
	<?php
	}

	/***
	* About Mosets Tree
	*/
	function about() {
		global $_MT_LANG;
	?>
	<center><img width="230" height="103" src="../components/com_mtree/img/logo_mtree.gif" alt="<?php echo mt_name ?>"></center>

	<br />
	<table width="50%" border="0" align="center" cellpadding="2" cellspacing="0" class="adminform">
		<tr>
			<th colspan="2"><?php echo mt_name ?></th>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->VERSION ?>:</td>
			<td width="80%" align="left"><?php echo mt_version; ?></td>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->WEBSITE ?>:</td>
			<td width="80%" align="left"><a target="_blank" href="http://www.mosets.com/">http://www.mosets.com/</a></td>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->AUTHOR ?>:</td>
			<td width="80%" align="left">Mosets Consulting</td>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->EMAIL ?>:</td>
			<td width="80%" align="left"><a href="mailto:mtree@mosets.com">mtree@mosets.com</a></td>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->LICENSE ?>:</td>
			<td width="80%" align="left"><a href="index2.php?option=com_mtree&task=license"><?php echo $_MT_LANG->LICENSE_AGREEMENT ?></a></td>
		</tr>

	</table>
	<br />
	<?php echo $_MT_LANG->COPYRIGHT_TEXT ?>

	<?php

	}

}
?>