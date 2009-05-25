<?php
/**
* Mosets Tree admin html
*
* @package Mosets Tree 2.00
* @copyright (C) 2005 - 2007 Mosets Consulting
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
		ul.linkcats{
			margin:0px;
			padding:0;
		}
		ul.linkcats > li:first-child
		{
		font-weight:bold;
		}
		ul.linkcats li {
			margin:0;
			padding:0;
			list-style:none;
			padding:0 0 3px 0;
		}
		ul.linkcats img {margin-right:4px;}
		ul.linkcats a {text-decoration:underline;margin-right:3px;}

	</style>
	<?php
	}

	function print_startmenu( $task, $cat_parent ) {
		global $database, $_MT_LANG, $mtconf;

		# Count the number of pending links/cats/reviews/reports/claims
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_cats WHERE cat_approved='0'" );
		$pending_cats = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__mt_links WHERE link_approved <= 0" );
		$pending_links = $database->loadResult();
	
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reviews WHERE rev_approved='0'" );
		$pending_reviews = $database->loadResult();
	
		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reports WHERE rev_id = 0 && link_id > 0" );
		$pending_reports = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reviews WHERE ownersreply_text != '' AND ownersreply_approved = '0'" );
		$pending_reviewsreply = $database->loadResult();

		$database->setQuery( "SELECT COUNT(*) FROM #__mt_reports WHERE rev_id > 0 && link_id > 0" );
		$pending_reviewsreports = $database->loadResult();

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
				if (!$mtconf->get('admin_use_explorer')) {
				?>
				<tr>
					<td width="20" align="center" style="background-color:#DDE1E6"><img src="../includes/js/ThemeOffice/home.png" width="16" height="16" /></td>
					<td width="100%" style="background-color:#F1F3F5"> <a class="mt_menu<?php echo ($task=="listcats" || $task=="editcat" || $task=="") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listcats"><?php echo $_MT_LANG->NAVIGATE_TREE ?></a></td>
				</tr>
				<?php } ?>

				<?php //if ( $task=="listcats" || $task=="" ) { ?>

				<tr>
					<td align="center" style="background-color:#DDE1E6"><img src="../components/com_mtree/img/page_white_add.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5"> <a class="mt_menu<?php echo ($task=="newlink") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&amp;task=newlink&amp;cat_parent=<?php echo $cat_parent ?>"><?php echo $_MT_LANG->ADD_LISTING ?></a></td>
				</tr>

				<tr>
					<td align="center" style="background-color:#DDE1E6"><img src="../components/com_mtree/img/folder_add.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5"> <a class="mt_menu<?php echo ($task=="newcat") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&amp;task=newcat&amp;cat_parent=<?php echo $cat_parent ?>"><?php echo $_MT_LANG->ADD_CAT ?></a></td>
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
							($pending_reviewsreply > 0)
							OR
							($pending_reviewsreports > 0)
							OR
							($pending_claims > 0)
						 ) { 
				?>
				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->AWAITING_APPROVAL ?></td></tr>
					
				<?php if ( $pending_cats > 0 && !$modPublished["mod_mt_unapproved_cats"]->published ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/folder.png" width="18" height="18" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_cats") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_cats"><?php echo $_MT_LANG->CATEGORIES ?> (<?php echo $pending_cats; ?>)</a></td>
				</tr>
					<?php 
					}

					if ( $pending_links > 0 && !$modPublished["mod_mt_unapproved_listing"]->published ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/page_white.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_links") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_links"><?php echo $_MT_LANG->LISTINGS ?> (<?php echo $pending_links; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_reviews > 0 && !$modPublished["mod_mt_unapproved_reviews"]->published ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/comment.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_reviews") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_reviews"><?php echo $_MT_LANG->REVIEWS ?> (<?php echo $pending_reviews; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_reports > 0 ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/error.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_reports") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_reports"><?php echo $_MT_LANG->REPORTS ?> (<?php echo $pending_reports; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_reviewsreply > 0 ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/user_comment.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_reviewsreply") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_reviewsreply"><?php echo $_MT_LANG->OWNERS_REPLIES ?> (<?php echo $pending_reviewsreply; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_reviewsreports > 0 ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/error.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_reviewsreports") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_reviewsreports"><?php echo $_MT_LANG->REVIEWS_REPORTS ?> (<?php echo $pending_reviewsreports; ?>)</a></td>
				</tr>
				<?php 
					}	

					if ( $pending_claims > 0 ) { ?>
				<tr>
					<td style="background-color:#DDE1E6"><img src="../components/com_mtree/img/user_green.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="listpending_claims") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=listpending_claims"><?php echo $_MT_LANG->CLAIMS ?> (<?php echo $pending_claims; ?>)</a></td>
				</tr>
				<?php 
					}	

				} 
				 # End of Awaiting Approvals
				
				 # dTree
				if ($mtconf->get('admin_use_explorer')) {
				?>
				<tr><td colspan="2" style="background: #DDE1E6; border-bottom: 1px solid #cccccc;border-top: 1px solid #cccccc;font-weight:bold;"><?php echo $_MT_LANG->EXPLORER ?></td></tr>
				<tr><td colspan="2" style="background-color:#F1F3F5;">
				<?php

				$cats = HTML_mtree::getChildren( 0, $mtconf->get('explorer_tree_level') );
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
					d.icon.line = '../components/com_mtree/img/dtree/line.png',
					d.icon.join = '../components/com_mtree/img/dtree/join.png',
					d.icon.joinBottom = '../components/com_mtree/img/dtree/joinbottom.png',
					d.icon.plus = '../components/com_mtree/img/dtree/plus.png',
					d.icon.plusBottom = '../components/com_mtree/img/dtree/plusbottom.png',
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
							echo "'".addslashes(htmlspecialchars($cat->cat_name, ENT_QUOTES ));
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
				if ( $task == 'listcats' || $task == 'editcat' || $task == 'editcat_browse_cat' || $task == 'editcat_add_relcat' || $task == 'editcat_remove_relcat' ) {
					if($cat_parent > 0) {
						# Lookup all information about this directory
						$thiscat = new mtCats( $database );
						$thiscat->load( $cat_parent );

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

						$database->setQuery( "SELECT COUNT(*) FROM #__mt_reviews WHERE link_id = '$link_id[0]' AND rev_approved = 1" );
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
					<td style="background: #DDE1E6;"><img src="../components/com_mtree/img/zoom.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu" href="index2.php?option=com_mtree&task=spy"><?php echo $_MT_LANG->SPY_DIRECTORY ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/config.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="config") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=config"><?php echo $_MT_LANG->CONFIGURATION ?></a></td>
				</tr>
				<?php /* ?>
				<tr>
					<td style="background: #DDE1E6;"><img src="../components/com_mtree/img/table_link.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="linkchecker") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=linkchecker"><?php echo $_MT_LANG->LINK_CHECKER ?></a></td>
				</tr>
				<?php */ ?>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/globe3.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu" href="index2.php?option=com_mtree&task=globalupdate"><?php echo $_MT_LANG->RECOUNT_CATEGORIES_LISTINGS ?></a></td>
				</tr>
				<tr>
					<td style="background: #DDE1E6;"><img src="../includes/js/ThemeOffice/template.png" width="16" height="16" /></td>
					<td style="background-color:#F1F3F5">&nbsp;<a class="mt_menu<?php echo ($task=="templates") ? "_selected": ""; ?>" href="index2.php?option=com_mtree&task=templates"><?php echo $_MT_LANG->TEMPLATES ?></a></td>
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

	function print_endmenu() {	
	?></td>
		</tr>
	</table>
	<?php
	}

	function getChildren( $cat_id, $cat_level ) {
		global $database, $mtconf;

		$cat_ids = array();

		if ( $cat_level > 0  ) {

			$sql = "SELECT cat_id, cat_name, cat_parent, cat_cats, cat_links FROM #__mt_cats WHERE cat_published=1 && cat_approved=1 && cat_parent='".$cat_id."' ";
			
			if ( !$mtconf->get('display_empty_cat') ) { 
				$sql .= "&& ( cat_cats > 0 || cat_links > 0 ) ";	
			}

			$sql .= "\nORDER BY cat_name ASC ";

			$database->setQuery( $sql );
			$cat_ids = $database->loadObjectList();

			if ( count($cat_ids) ) {
				foreach( $cat_ids AS $cid ) {
					//$children_ids = getChildren( $cid->cat_id, ($cat_level-1), $mtconf->get('display_empty_cat') );
					$children_ids = HTML_mtree::getChildren( $cid->cat_id, ($cat_level-1) );
					$cat_ids = array_merge( $cat_ids, $children_ids );
				}
			}
		}

		return $cat_ids;

	}

	/***
	* Link
	*/
	function editLink( &$row, $fields, $images, $cat_id, $other_cats, &$lists, $number_of_prev, $number_of_next, &$pathWay, $returntask, &$params, $option, $activetab=0 ) {
		global $_MT_LANG, $mtconf;
		mosMakeHtmlSafe( $row );
		
		$tabs = new mosTabs(0);
		?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<link rel="stylesheet" type="text/css" media="all" href="../includes/js/calendar/calendar-mos.css" title="green" />
		<style type="text/css" media="all">.sortableitem{cursor:move;width: 300px;list-style: none;}</style>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/includes/js/overlib_mini.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/interface.js"></script>
		<script language="javascript" type="text/javascript" src="../includes/js/calendar/calendar.js"></script>
		<script language="javascript" type="text/javascript" src="../includes/js/calendar/lang/calendar-en.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/category.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/addlisting.js"></script>
		<script language="javascript" type="text/javascript">
		jQuery.noConflict();
		var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
		var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
		var active_cat=<?php echo $cat_id; ?>;
		var msgAddAnImage = '<?php echo $_MT_LANG->ADD_AN_IMAGE ?>';
		var txtRemove = '<?php echo $_MT_LANG->REMOVE ?>';
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancellink') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.link_name.value == ""){
				alert( "<?php echo $_MT_LANG->LISTING_MUST_HAVE_NAME ?>" );
			<?php
			$requiredFields = array();
			$fields->resetPointer();
			while( $fields->hasNext() ) {
				$field = $fields->getField();
				if( ($field->isRequired() && !in_array($field->name,array('link_name','link_desc'))) || ($field->isRequired() && $mtconf->get('use_wysiwyg_editor_in_admin') == 0 && $field->name == 'link_desc') ) {
					echo "\n";
					echo '} else if (isEmpty(\'' . $field->getName() . '\')) {'; 
					echo "\n";
					echo 'alert("' .$_MT_LANG->PLEASE_COMPLETE_THIS_FIELD . $field->caption . '");';
				}
				if($field->hasJSValidation()) {
					echo "\n";
					echo $field->getJSValidation();
				}
				$fields->next();
			}
			?>
			} else {
				<?php
				if($mtconf->get('use_wysiwyg_editor_in_admin') == 1 && !is_null($fields->getFieldById(2))) {
					getEditorContents( 'editor1', 'link_desc' );
				}
				?>
				var serial = jQuery.SortSerialize('upload_att');
				if(serial.hash != ''){document.adminForm.img_sort_hash.value=serial.hash;}
/*				if(attCount>0 && checkImgExt(attCount,form.elements['image[]'])==false) {*/
				if(attCount>0 && checkImgExt(attCount,jQuery("input[@type=file][@name='image[]']"))==false) {
					alert('<?php echo $_MT_LANG->PLEASE_SELECT_A_JPG_PNG_OR_GIF_FILE_FOR_THE_IMAGES ?>');
					return;
				} else {
					submitform(pressbutton);
				}
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
			<img src="images/back.png" alt="<?php echo $_MT_LANG->PREVIOUS ?>" align="middle" name="prev_link" border="0" /><b> (<?php echo $number_of_prev ?>) <?php echo $_MT_LANG->PREVIOUS ?></b></a>
			</td>
			<?php
			} else {
			?>
			<td><img src="images/back.png" alt="<?php echo $_MT_LANG->PREVIOUS ?>" align="middle" border="0" /><b><font color="#C0C0C0"> (0) <?php echo $_MT_LANG->PREVIOUS ?></font></b></td>
			<?php
			}

			//if ( $number_of_next > 0 || $number_of_prev > 0 ) {
			?>
			<td>
				<fieldset style="padding: 5px; border: 1px solid #c0c0c0">
					<input type="radio" name="act" id="act_ignore" value="ignore" checked="checked" /><label for="act_ignore"><?php echo $_MT_LANG->IGNORE ?></label>
					<input type="radio" name="act" id="act_approve" value="approve" /><label for="act_approve"><?php echo $_MT_LANG->APPROVE ?></label>
					<input type="radio" name="act" id="act_discard" value="discard" /><label for="act_discard"><?php echo $_MT_LANG->REJECT ?></label>
				</fieldset>
			</td>
			<?php 
			//}

			if ( $number_of_next > 0 ) {
			?>
			<td>
			<a class="toolbar" href="javascript:submitbutton('next_link');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('next_link','','images/next_f2.png',1);"><b>
			<?php echo $_MT_LANG->NEXT ?> (<?php echo $number_of_next ?>) </b><img src="images/next.png" alt="<?php echo $_MT_LANG->NEXT ?>" align="middle" name="next_link" border="0" /></a>
			</td>
			<?php
			} else {
			?>
			<td>
			<a class="toolbar" href="javascript:submitbutton('next_link');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('savelink2','','images/save_f2.png',1);"><b>
			<?php echo $_MT_LANG->SAVE ?> </b><img src="images/save.png" alt="Save" align="middle" name="savelink2" border="0" /></a>
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
				<td width="20%" align="right" valign="top"><?php echo $_MT_LANG->CATEGORY ?>:</td>
				<td width="80%" align="left" colspan="2">
					<ul class="linkcats" id="linkcats">
					<li id="lc<?php echo $cat_id; ?>"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_id, '' ); ?></li>
					<?php
					if ( !empty($other_cats) ) {
						foreach( $other_cats AS $other_cat ) {
							if ( is_numeric( $other_cat ) ) {
								echo '<li id="lc' . $other_cat . '"><a href="javascript:remSecCat('.$other_cat.')">'.$_MT_LANG->REMOVE.'</a>'. $pathWay->printPathWayFromCat_withCurrentCat( $other_cat, '' ) . '</li>';
							}
						}
					}
					?>
					</ul>
					<a href="#" onclick="javascript:togglemc();return false;" id="lcmanage"><?php echo $_MT_LANG->MANAGE; ?></a>
					<div id="mc_con" style="display:none">
					<span id="mc_active_pathway" style="padding: 1px 0pt 1px 3px; background-color: white; width: 98%;position:relative;top:4px;height:13px;color:black"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_id, '' ); ?></span>
					<?php echo $lists["cat_id"]; ?>
					<input type="button" class="button" value="<?php echo $_MT_LANG->UPDATE_CATEGORY ?>" id="mcbut1" onclick="updateMainCat()" />
					<input type="button" class="button" value="<?php echo $_MT_LANG->ALSO_APPEAR_IN_THIS_CATEGORIES ?>" id="mcbut2" onclick="addSecCat()"/>
					</div>
				</td>
			</tr>
			<?php
			$field_link_desc = $fields->getFieldById(2);
			$fields->resetPointer();
			while( $fields->hasNext() ) {
				$field = $fields->getField();
				if($field->hasInputField() && !in_array($field->name,array('metakey','metadesc'))) {
					echo '<tr>';
					echo '<td valign="top">';
					if($field->hasCaption()) {
						if($field->isRequired()) {
							echo '<strong>' . $field->getCaption() . '</strong>:';
						} else {
							echo $field->getCaption() . ':';
						}
					}
					echo '</td>';
					echo '<td>';
					echo $field->getModPrefixText();
					if(
						$mtconf->get('use_wysiwyg_editor_in_admin') == 1 
						&& 
						!is_null($field_link_desc) 
						&& 
						$field->name == 'link_desc'
						) {
						editorArea( 'editor1',  $row->link_desc , 'link_desc', '100%', '250', '75', '25' );
					} else {
						echo $field->getInputHTML();
					}
					echo $field->getModSuffixText();
					echo '</td>';
					echo '</tr>';
				}
				$fields->next();
			}
			?>
		</table>

	</td>
	<td width="40%" valign="top">
	<script language="javascript" type="text/javascript">
		var attCount=0;
		function addAtt() {
			attCount++;
			var newLi = document.createElement("LI");
			newLi.id="att"+attCount;
			newLi.style.marginRight="5px";
			newLi.style.position="relative";
			newLi.style.listStyleType="none";
			newLi.style.left="17px";
			var newFile=document.createElement("INPUT");
			newFile.className="text_area";
			newFile.name="image[]";
			newFile.type="file";
			newFile.size="28";
			newLi.appendChild(newFile);
			var newLink=document.createElement("A");
			newLink.href="javascript:remAtt("+attCount+")";
			removeText=document.createTextNode("<?php echo $_MT_LANG->REMOVE ?>");
			newLink.appendChild(removeText);
			newLi.appendChild(newLink);
			gebid('upload_att').appendChild(newLi);
		}
		function remAtt(id) {gebid('upload_att').removeChild(gebid('att'+id));attCount--;}
		</script>
		<table cellpadding="2" cellspacing="1" border="0" width="100%" class="adminform">
			<tr>
				<th><?php echo $_MT_LANG->IMAGES ?></th>
			</tr>
			<tr>
				<td valign="top"><ul style="margin:0 10px;padding:0;list-style-image:none" id="upload_att"><?php
				foreach( $images AS $image ) {
					echo '<li style="margin-bottom:5px;clear:both;" class="sortableitem" id="img_' . $image->img_id . '">';
					echo '<input type="checkbox" name="keep_img[]" value="' . $image->img_id . '" checked />';
					echo '<a href="' . $mtconf->getjconf('live_site'). $mtconf->get('relative_path_to_listing_medium_image') . $image->filename . '" target="_blank">';
					echo '<img border="0" style="position:relative;border:1px solid black;" align="middle" src="' . $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_listing_small_image') . $image->filename . '" alt="' . $image->filename . '" />';
					echo '</a>';
					echo '</li>';
				}
				?>
				</ul>
				<br />
				<a href="javascript:addAtt();" id="add_att"><?php echo $_MT_LANG->ADD_AN_IMAGE ?></a>
				</td>
			</tr>
		</table>
		<p />
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
		if ($mtconf->get('use_internal_notes')) {

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

		// echo "<script type=\"text/javascript\">\n";
		// echo "  tabPane1.setSelectedIndex(".$activetab.");";
		// echo "</script>";
		?> 
	</td>
	</tr>
	</table>

	<input type="hidden" name="img_sort_hash" value="" />
	<input type="hidden" name="link_id" value="<?php echo $row->link_id; ?>" />
	<input type="hidden" name="original_link_id" value="<?php echo $row->original_link_id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="editlink" />
	<input type="hidden" name="returntask" value="<?php echo ($row->link_approved <= 0)?"listpending_links" : $returntask ?>" />
	<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
	<input type="hidden" name="other_cats" id="other_cats" value="<?php echo ( ( !empty($other_cats) ) ? implode(', ', $other_cats) : '' ) ?>" />
	</form>
<?php
	}
	
	function move_links( $link_id, $cat_parent, $catList, $pathWay, $option ) {
		global $_MT_LANG, $mtconf;
?>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/category.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
	var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
	var active_cat=<?php echo $cat_parent; ?>;
	jQuery(document).ready(function(){
		jQuery('#browsecat').click(function(){
			cc(jQuery(this).val());
		});
	});
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
		<td align="left">
			<div id="mc_active_pathway" style="border: 1px solid #C0C0C0; padding: 1px 0pt 1px 3px;margin-bottom:4px; background-color: white; width: 30%;color:black"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_parent, '' ); ?></div>
			<?php echo $catList;?>
		</td>
	</tr>
</table>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="new_cat_parent" value="<?php echo $cat_parent;?>" />
<input type="hidden" name="task" value="links_move" />
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
		global $_MT_LANG, $mtconf;
?>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/category.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
	var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
	var active_cat=<?php echo $cat_parent; ?>;
	jQuery(document).ready(function(){
		jQuery('#browsecat').click(function(){
			cc(jQuery(this).val());
		});
	});
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
		<td align="right" valign="top"><?php echo $_MT_LANG->COPY_TO ?>:</td>
		<td align="left">
		<div id="mc_active_pathway" style="border: 1px solid #C0C0C0; padding: 1px 0pt 1px 3px;margin-bottom:4px; background-color: white; width: 30%;color:black"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_parent, '' ); ?></div>
		<?php echo $lists['cat_id'];?></td>
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
		<td align="right"><?php echo $_MT_LANG->COPY_SECONDARY_CATEGORIES ?>:</td>
		<td align="left"><?php echo $lists['copy_secondary_cats'] ;?></td>
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
<input type="hidden" name="task" value="links_copy" />
<input type="hidden" name="boxchecked" value="1" />
<?php
		foreach ($link_id as $id) {
			echo "\n<input type=\"hidden\" name=\"lid[]\" value=\"$id\" />";
		}
?>
</form>

<?php
	}

	/**
	* Category
	*/
	function listcats( &$rows, &$links, &$softlink_cat_ids, &$parent, &$pageNav, &$pathWay, $option ) {
		global $database, $_MT_LANG, $mtconf;
		//$mt_listing_image_dir, $mt_cat_image_dir, $mt_resize_listing_size, $mt_resize_cat_size, $mt_admin_use_explorer;

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
		if ( $mtconf->get('admin_use_explorer') ) { ?>
		// Open Explorer
		d.openTo(<?php echo ( (isset($parent->cat_id)) ? $parent->cat_id : '0'); ?>, true);
		<?php } ?>
		function showNotes(notes, caption) {return overlib( notes, STICKY, CAPTION, caption, LEFT, BELOW, WIDTH, 165, OFFSETY, -10, OFFSETX, 56, BGCOLOR, '#d5d5d5', FGCOLOR, '#f1f1f1', CLOSECOLOR, '#000000', CLOSESIZE, '9px' );}
		function submitbutton_fastadd_cat() {submitbutton('fastadd_cat');}
		</script>

		<table class="adminheading"><tr><th class="frontpage"><?php echo $_MT_LANG->NAVIGATION ?></th></tr></table>
		
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
					?>', STICKY, CAPTION, '<?php echo $_MT_LANG->ENTER_ONE_CAT_NAME_PERLINE ?>', CAPCOLOR, '#000', CLOSECOLOR, '#ff6600', CELLPAD, 5, CENTER, BELOW, LEFT, OFFSETX, -20, FGCOLOR, '#F1F3F5', BGCOLOR, '#cccccc', WRAP, CLOSECLICK);"><?php echo $_MT_LANG->FAST_ADD ?></a></td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<thead>
			<tr>
				<th width="40" align="right"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
				<th width="50%" class="title" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th><?php echo $_MT_LANG->CATEGORIES ?></th>
				<th><?php echo $_MT_LANG->LISTINGS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
			</thead>
<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i]; ?>
			<tr class="<?php echo "row$k"; ?>">
				<td><a href="index2.php?option=com_mtree&amp;task=listcats&amp;cat_id=<?php echo $row->cat_id; ?>"><?php 
				if ($row->cat_image) {
					echo "<img border=\"0\" src=\"../components/com_mtree/img/dtree/imgfolder2.gif\" width=\"18\" height=\"18\" onmouseover=\"showInfo('" .$row->cat_name ."', '".$row->cat_image."', 'cat'); this.src='../components/com_mtree/img/dtree/imgfolder.gif'\" onmouseout=\"this.src='../components/com_mtree/img/dtree/imgfolder2.gif'; return nd(); \" />";
				} else {
					echo "<img border=\"0\" src=\"../components/com_mtree/img/dtree/folder.gif\" width=\"18\" height=\"18\" name=\"img".$i."\" onmouseover=\"this.src='../components/com_mtree/img/dtree/folderopen.gif'\" onmouseout=\"this.src='../components/com_mtree/img/dtree/folder.gif'\" />"; 
				}
				?></a><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->cat_id; ?>" onclick="isChecked(this.checked);" /></td>
				<td align="left"><a href="index2.php?option=com_mtree&amp;task=editcat&amp;cat_id=<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></a></td>
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
			  <td width="10%" align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tfoot><tr><th align="center" colspan="9">&nbsp;</th></tr></tfoot>
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
			<thead>
			<tr>
				<th width="38" align="right">
					<input type="checkbox" name="link_toggle" value="" onclick="link_checkAll(<?php echo count( $links ); ?>);" />
				</th>
				<th width="60%" class="title" nowrap="nowrap"><?php echo $_MT_LANG->LISTING ?></th>
				<th><?php echo $_MT_LANG->REVIEWS ?></th>
				<th><?php echo $_MT_LANG->FEATURED ?></th>
				<th><?php echo $_MT_LANG->PUBLISHED ?></th>
			</tr>
			</thead>
<?php
		$k = 0;
		for ($i=0, $n=count( $links ); $i < $n; $i++) {
			$row = &$links[$i]; ?>
			<tr class="<?php echo "row$k"; ?>">
				<?php if ( $row->main == 1 ) { ?>
				<td><?php //echo ($row->link_image) ? "<img src=\"../includes/js/ThemeOffice/media.png\" />": "<img src=\"../includes/js/ThemeOffice/document.png\" width=\"16\" height=\"16\">";
				echo "<img src=\"../includes/js/ThemeOffice/document.png\" width=\"16\" height=\"16\">" ?><input type="checkbox" id="lb<?php echo $i;?>" name="lid[]" value="<?php echo $row->link_id; ?>" onclick="link_isChecked(this.checked);" /></td>
				<td align="left">
					<?php
					if ($row->internal_notes) {
						$intnotes = preg_replace('/\s+/', ' ', nl2br($row->internal_notes));
						echo '<a href="#notes" onmouseover="showNotes(\''.$intnotes.'\', \''.$row->link_name.'\')" onmouseout="return nd();"><img src="../includes/js/ThemeOffice/messaging.png" border="0" width="16" height="16" /></a> ';
					}
					?>
					<a href="index2.php?option=com_mtree&amp;task=editlink&amp;link_id=<?php echo $row->link_id; ?>"><?php echo $row->link_name; ?></a>
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
			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="5"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="5"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

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
		global $_MT_LANG, $mtconf;

		mosMakeHtmlSafe( $row, ENT_QUOTES, 'cat_desc' );
		
		$tabs = new mosTabs(0);

		if(file_exists($mtconf->getjconf('absolute_path') . "/editor/editor.php")) {
			include_once( $mtconf->getjconf('absolute_path') . "/editor/editor.php" );
		}

?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="Javascript" src="../includes/js/overlib_mini.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/category.js"></script>
		<script language="javascript" type="text/javascript">
		jQuery.noConflict();
		var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
		var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
		var active_cat=<?php echo $row->cat_id; ?>;
		jQuery(document).ready(function(){
			toggleMcBut(active_cat);			
			jQuery('#browsecat').click(function(){
				cc(jQuery(this).val());
			});
		});
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
				<th colspan="2"><?php echo $_MT_LANG->CATEGORY_DETAILS ?></th>
			</tr>
			<tr>
				<td width="15%" align="right"><?php echo $_MT_LANG->NAME ?>:</td>
				<td width="85%" align="left">
					<input class="text_area" type="text" name="cat_name" size="50" maxlength="250" value="<?php echo $row->cat_name;?>" />
				</td>
			</tr>
			<tr valign="bottom">
				<td width="20%" align="right" valign="top"><?php echo $_MT_LANG->RELATED_CATEGORIES ?>:</td>
				<td width="80%" align="left" colspan="2">
					<ul class="linkcats" id="linkcats">
					<li><input type="button" class="button" name="lcmanage" value="<?php echo $_MT_LANG->ADD_RELATED_CATEGORIES; ?>" onclick="javascript:togglemc();return false;" /></li>
					<?php
					if ( !empty($related_cats) ) {
						foreach( $related_cats AS $related_cat ) {
							if ( is_numeric( $related_cat ) ) {
								echo '<li id="lc' . $related_cat . '"><a href="javascript:remSecCat('.$related_cat.')">'.$_MT_LANG->REMOVE.'</a>'. $pathWay->printPathWayFromCat_withCurrentCat( $related_cat, '' ) . '</li>';
							}
						}
					}
					?>
					</ul>
					<div id="mc_con" style="display:none">
					<div id="mc_active_pathway" style="border: 1px solid #C0C0C0; padding: 1px 0pt 1px 3px; background-color: white; width: 98%;position:relative;top:4px;height:13px;color:black"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $row->cat_id, '' ); ?></div>
					<?php echo $lists["new_related_cat"]; ?>
					<br />
					<input type="button" class="button" value="<?php echo $_MT_LANG->ADD ?>" id="mcbut1" onclick="addSecCat()"/>
					</div>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" colspan="2"><?php echo $_MT_LANG->DESCRIPTION ?>:
				<br />
				<?php editorArea( 'editor1',  $row->cat_desc , 'cat_desc', '100%', '300', '75', '20' ); ?></td>
			</tr>

			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->IMAGE ?>:</td>
				<td valign="top" align="left">
					<input class="text_area" type="file" name="cat_image" />
					<?php if ($row->cat_image != "") { ?>
					<p />
					<img style="border: 5px solid #c0c0c0;" src="<?php echo $mtconf->getjconf('live_site').$mtconf->get('relative_path_to_cat_small_image') . $row->cat_image ?>" />
					<br />
					<input type="checkbox" name="remove_image" value="1" /> <?php echo $_MT_LANG->REMOVE_THIS_IMAGE ?>
					<?php } ?>
				</td>
			</tr>
		</table>

			</td>
			<td width="40%" valign="top"><?php
		
		if (defined('JVERSION')) {
		
			jimport('joomla.html.pane');
			$pane	=& JPane::getInstance('sliders');
		
			echo $pane->startPane("content-pane");
			echo $pane->startPanel( $_MT_LANG->PUBLISHING_INFO, "publishing-page" );
			?>
			<table width="100%" class="paramlist admintable" cellspacing="1">
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

			echo $pane->endPanel();
			echo $pane->startPanel( $_MT_LANG->OPERATIONS, "operations-page" );

			?>
			<table width="100%" class="paramlist admintable" cellspacing="1">
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
			echo $pane->endPanel();
			echo $pane->endPane();
		} else {
		
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
		}
		?>    
		</td>
	</tr>
</table>
		<?php 
		/* ?>
		<script type="text/javascript">
			tabPane1.setSelectedIndex( "<?php echo $activetab ?>");
		</script>
		<?php */ ?>
		<input type="hidden" name="cat_id" value="<?php echo $row->cat_id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="editcat" />
		<input type="hidden" name="returntask" value="<?php echo $returntask ?>" />
		<input type="hidden" name="cat_parent" value="<?php echo $cat_parent; ?>" />
		<input type="hidden" name="other_cats" id="other_cats" value="<?php echo ( ( !empty($related_cats) ) ? implode(', ', $related_cats) : '' ) ?>" />
		</form>
<?php
	}

	/***
	* Move Category
	*/
	function move_cats( $cat_id, $cat_parent, $catList, $pathWay, $option ) {
		global $_MT_LANG, $mtconf;
?>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/category.js"></script>
<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
	var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
	var active_cat=<?php echo $cat_id; ?>;
	jQuery(document).ready(function(){
		jQuery('#browsecat').click(function(){cc(jQuery(this).val());});
	});
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
		<td align="right" valign="top"><?php echo $_MT_LANG->MOVE_TO ?>:</td>
		<td align="left">
		<div id="mc_active_pathway" style="border: 1px solid #C0C0C0; padding: 1px 0pt 1px 3px;margin-bottom:4px; background-color: white; width: 40%;color:black"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_parent, '' ); ?></div>
		<?php echo $catList;?></td>
	</tr>
</table>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="new_cat_parent" value="<?php echo $cat_parent;?>" />
<input type="hidden" name="task" value="cats_move" />
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
		global $_MT_LANG, $mtconf;
?>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/components/com_mtree/js/category.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
	var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
	var active_cat=<?php echo $cat_id; ?>;
	jQuery(document).ready(function(){
		//toggleMcBut(active_cat);			
		jQuery('#browsecat').click(function(){
			cc(jQuery(this).val());
		});
	});
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
		<td align="right" valign="top"><?php echo $_MT_LANG->COPY_TO ?>:</td>
		<td align="left">
		<div id="mc_active_pathway" style="border: 1px solid #C0C0C0; padding: 1px 0pt 1px 3px;margin-bottom:4px; background-color: white; width: 40%;color:black"><?php echo $pathWay->printPathWayFromCat_withCurrentCat( $cat_parent, '' ); ?></div>
		<?php echo $lists['cat_id'] ;?></td>
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
<input type="hidden" name="task" value="cats_copy" />
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
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="Javascript" src="../includes/js/overlib_mini.js"></script>
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
			function showNotes(notes, caption) {return overlib( notes, STICKY, CAPTION, caption, LEFT, BELOW, WIDTH, 165, OFFSETY, -10, OFFSETX, 56, BGCOLOR, '#d5d5d5', FGCOLOR, '#f1f1f1', CLOSECOLOR, '#000000', CLOSESIZE, '9px' );}
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
			<thead>
			<tr>
				<th width="38" align="right">
					<input type="checkbox" name="link_toggle" value="" onclick="link_checkAll(<?php echo count( $links ); ?>);" />
				</th>
				<th class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->LISTING ?></th>
				<th width="50%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORY ?></th>
				<th width="100"><?php echo $_MT_LANG->CREATED ?></th>
			</tr>
			</thead>
<?php
		$k = 0;
		for ($i=0, $n=count( $links ); $i < $n; $i++) {
			$row = &$links[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td>
					<?php //echo ($row->link_image) ? "<img src=\"../includes/js/ThemeOffice/media.png\" onmouseover=\"showInfo('" .$row->link_name ."', '".$row->link_image."', 'listing')\" onmouseout=\"return nd();\" >": "<img src=\"../includes/js/ThemeOffice/document.png\" width=\"16\" height=\"16\">"; 
					echo "<img src=\"../includes/js/ThemeOffice/document.png\" width=\"16\" height=\"16\">"; ?>
					<input type="checkbox" id="lb<?php echo $i;?>" name="lid[]" value="<?php echo $row->link_id; ?>" onclick="link_isChecked(this.checked);" />
				</td>
				<td><?php
					if ($row->internal_notes) {
						$intnotes = str_replace('"', '&quot;',str_replace("'", "&amp;#039;",preg_replace('/\s+/', ' ', nl2br($row->internal_notes))));
						$link_name = str_replace('"', '&quot;',str_replace("'", "&amp;#039;",preg_replace('/\s+/', ' ', $row->link_name)));
						echo '<a href="#notes" onmouseover="showNotes(\''.$intnotes.'\', \''.addslashes($link_name).'\')" onmouseout="return nd();"><img src="../includes/js/ThemeOffice/messaging.png" border="0" width="16" height="16" /></a> ';
					}
					echo (($row->link_approved < 0 ) ? '': '<b>' ); ?><a href="#edit" onclick="return link_listItemTask('lb<?php echo $i;?>','editlink_for_approval')"><?php echo $row->link_name; ?></a><?php echo (($row->link_approved < 0 ) ? '': '<b>' ); ?></td>
				<td><?php $pathWay->printPathWayFromLink( $row->link_id, '' ); ?></td>
				<td><?php echo tellDateTime($row->link_created); ?></td>
			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="4"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="4"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="4">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

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
			<thead>
			<tr>
				<th width="44" align="right"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $cats ); ?>);" /></th>
				<th class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->CATEGORIES ?></th>
				<th width="52%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->PARENT ?></th>
				<th width="100"><?php echo $_MT_LANG->CREATED ?></th>
			</tr>
			</thead>
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
			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="4"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="4"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="4">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="listpending_cats" />
		<input type="hidden" name="returntask" value="listpending_cats" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function listpending_reviews( $reviews, $pathWay, $pageNav, $option ) {
		global $_MT_LANG, $mtconf;
		require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/spy.mtree.html.php' );
	?>
		<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
		<script language="javascript" type="text/javascript">
		jQuery.noConflict();
		var predefined_reply=new Array();
		<?php
		$num_of_predefined_reply=0;
		for ( $j=1; $j <= 5; $j++ )
		{ 
			if( $mtconf->get( 'predefined_reply_'.$j.'_title' ) <> '' && $mtconf->get( 'predefined_reply_'.$j.'_message' ) <> '') {
				echo 'predefined_reply['.$j.']="'.str_replace("'","\\'",str_replace('"','\\"',str_replace("\t","\\t",str_replace("\r\n","\\n",str_replace("\\","\\\\",$mtconf->get( 'predefined_reply_'.$j.'_message' ))))))."\";\n";
				$num_of_predefined_reply++;
			}
		}
		?>
		function selectreply(value,rev_id){
			jQuery('#emailmsg_'+rev_id).val( predefined_reply[value] );
		}
		function toggleemaileditor(rev_id){
			jQuery('#emaileditor_'+rev_id).slideToggle('fast');
		}
		</script>
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
				<thead><tr><th align="left"<?php echo ( ($mtconf->get('use_internal_notes')) ? ' colspan="2"': '' ) ?>><?php 
					echo mtfHTML::rating($row->value);
				?>&nbsp;<a href="index2.php?option=com_mtree&amp;task=editlink&amp;link_id=<?php echo $row->link_id; ?>"><?php echo $row->link_name ?></a> by <?php
				if($row->user_id > 0) {
					echo '<a href="index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$row->user_id.'">' . $row->username . '</a>';
				} elseif(!empty($row->email)) {
					echo '<a href="mailto:' . $row->email . '">' . $row->guest_name . '</a>';
				} else {
					echo $row->guest_name;
				}
				?>, <?php echo $row->rev_date ?> - <a href="<?php echo $mtconf->getjconf('live_site'). "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $_MT_LANG->VIEW_LISTING ?></a></th></tr></thead>
				<tr align="left">
					<td<?php echo ( ($mtconf->get('use_internal_notes')) ? ' width="65%"': '' ) ?> valign="top" style="border-bottom:0px"><?php echo $_MT_LANG->REVIEW_TITLE ?>: <input class="text_area" type="text" name="rev_title[<?php echo $row->rev_id; ?>]" value="<?php echo htmlspecialchars($row->rev_title); ?>" size="60" /></td>
					<?php if ( $mtconf->get('use_internal_notes') ) { ?><td valign="middle" width="35%" style="border-bottom:0px"><?php echo $_MT_LANG->INTERNAL_NOTES ?>:</td><?php } ?>
				</tr>
				<tr align="left">
					<td<?php echo ( ($mtconf->get('use_internal_notes')) ? ' width="65%"': '' ) ?>>
						<textarea class="text_area" style="width:100%;height:150px" name="rev_text[<?php echo $row->rev_id ?>]"><?php echo htmlspecialchars($row->rev_text) ?></textarea>
						<p />
						<label for="app_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="1" id="app_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->APPROVE ?></label>
						<label for="ign_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="0" id="ign_<?php echo $row->rev_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
						<label for="rej_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="-1" id="rej_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->REJECT ?></label>
						<?php if($row->value > 0) { ?>
						<label for="rejrv_<?php echo $row->rev_id ?>"><input type="radio" name="rev[<?php echo $row->rev_id ?>]" value="-2" id="rejrv_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->REJECT_AND_REMOVE_VOTE ?></label>
						<?php } 
						
						if( !empty($row->email) ) {
						?>						
						<span style="margin-top:2px;display:block;clear:left;"><input type="checkbox"<?php echo (($row->send_email)?' checked':''); ?> name="sendemail[<?php echo $row->rev_id ?>]" value="1" id="sendemail_<?php echo $row->rev_id ?>" onclick="toggleemaileditor(<?php echo $row->rev_id ?>)" /> <label for="sendemail_<?php echo $row->rev_id ?>"><?php echo $_MT_LANG->SEND_EMAIL_TO_REVIEWER_UPON_APPROVAL_OR_REJECTION ?></label></span>
						<div id="emaileditor_<?php echo $row->rev_id ?>"<?php echo ((!$row->send_email)?' style="display:none"':''); ?>>
							<select onchange="selectreply(this.value,<?php echo $row->rev_id ?>)"<?php echo (($num_of_predefined_reply==0)?' disabled':''); ?>>
								<option><?php echo $_MT_LANG->SELECT_A_PRE_DEFINED_REPLY ?></option>
								<?php
								for ( $k=1; $k <= 5; $k++ )
								{ 
									if( $mtconf->get( 'predefined_reply_'.$k.'_title' ) <> '') {
										echo '<option value="'.$k.'">'.$mtconf->get( 'predefined_reply_'.$k.'_title' ).'</option>';
									}
								}
								?>
							</select>&nbsp;<?php echo $_MT_LANG->OR_ENTER_THE_EMAIL_MESSAGE ?>
							<p />
							<textarea name="emailmsg[<?php echo $row->rev_id ?>]" id="emailmsg_<?php echo $row->rev_id ?>" class="text_area" style="width:100%;height:110px"><?php echo $row->email_message ?></textarea>
						</div>
						<?php } ?>
					</td>
					<td valign="top"><textarea class="text_area" style="width:100%;height:150px;" name="admin_note[<?php echo $row->rev_id ?>]"><?php echo htmlspecialchars($row->admin_note) ?></textarea></td>
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
		global $_MT_LANG, $mtconf;
		//$mt_use_internal_notes;
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
			<thead><tr><th align="left"<?php echo ( ($mtconf->get('use_internal_notes')) ? ' colspan="2"': '' ) ?>><a href="index2.php?option=com_mtree&task=editlink&link_id=<?php echo $row->link_id; ?>"><?php echo $row->link_name ?></a> - <a href="<?php echo $mtconf->getjconf('live_site') . "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $_MT_LANG->VIEW_LISTING ?></a></th></tr></thead>
			<tr align="left">
				<td<?php echo ( ($mtconf->get('use_internal_notes')) ? ' width="65%"': '' ) ?> valign="top">
					<u><?php echo $row->subject . "</u>, " . ( (empty($row->username))? $row->guest_name : '<a href="index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$row->user_id.'">' . $row->username . '</a> ' ) ." ". $row->created ?>
					<p />
					<?php echo nl2br($row->comment) ?>
					<p />
					<label for="res_<?php echo $row->report_id ?>"><input type="radio" name="report[<?php echo $row->report_id ?>]" value="1" id="res_<?php echo $row->report_id ?>" /><?php echo $_MT_LANG->RESOLVED ?></label>

					<label for="ign_<?php echo $row->report_id ?>"><input type="radio" name="report[<?php echo $row->report_id ?>]" value="0" id="ign_<?php echo $row->report_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
				</td>
				<?php if( $mtconf->get('use_internal_notes') ) { ?>
				<td style="height:100px;" valign="top" width="35%">
				<?php echo $_MT_LANG->INTERNAL_NOTES ?>:<br />
				<textarea class="text_area" style="width:100%;height:80px;" name="admin_note[<?php echo $row->report_id ?>]"><?php echo htmlspecialchars($row->admin_note) ?></textarea>
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

	function listpending_reviewsreports( $reports, $pathWay, $option ) {
		global $_MT_LANG, $mtconf;
		//$mt_use_internal_notes;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $_MT_LANG->PENDING_REVIEWS_REPORTS ?></td>
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
			<thead><tr><th align="left"<?php echo ( ($mtconf->get('use_internal_notes')) ? ' colspan="2"': '' ) ?>><a href="<?php echo $mtconf->getjconf('live_site') . "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $row->link_name ?></a></th></tr></thead>
			<tr align="left">
				<td<?php echo ( ($mtconf->get('use_internal_notes')) ? ' width="65%"': '' ) ?>>
					<blockquote style="margin:3px 0 10px 2px;background-color:#F3F3F3;padding:6px;border: 1px solid #e1e1e1;border-left:6px solid #E1E1E1;">
					<?php echo '<strong>' . $row->rev_title . '</strong>';
					echo ' - <a href="index2.php?option=com_mtree&task=editreview&rid=' . $row->rev_id . '">' . $_MT_LANG->EDIT_REVIEW . '</a>';
					 echo '<br />' . $_MT_LANG->REVIEWED_BY . ' <a href="index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$row->user_id.'">' . $row->review_username . '</a>, ' . $row->rev_date ?>
					<p />
					<?php echo nl2br($row->rev_text); ?>
					</blockquote>
					<?php echo ( (empty($row->username))? $row->guest_name : '<a href="mailto:'.$row->email.'">'.$row->username."</a> " ) ." ". $row->created ?>
					<p />
					<?php echo nl2br($row->comment) ?>
					<p />
					<label for="res_<?php echo $row->report_id ?>"><input type="radio" name="report[<?php echo $row->report_id ?>]" value="1" id="res_<?php echo $row->report_id ?>" /><?php echo $_MT_LANG->RESOLVED ?></label>

					<label for="ign_<?php echo $row->report_id ?>"><input type="radio" name="report[<?php echo $row->report_id ?>]" value="0" id="ign_<?php echo $row->report_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
				</td>
				<?php if( $mtconf->get('use_internal_notes') ) { ?>
				<td style="height:100px;" valign="top" width="35%">
				<?php echo $_MT_LANG->INTERNAL_NOTES ?>:<br />
				<textarea class="text_area" style="width:100%;height:200px" name="admin_note[<?php echo $row->report_id ?>]"><?php echo htmlspecialchars($row->admin_note) ?></textarea>
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

	function listpending_reviewsreply( $reviewsreply, $pathWay, $option ) {
		global $_MT_LANG, $mtconf;
		//$mt_use_internal_notes;
	?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
			<tr>
				<th class="edit"><?php echo $_MT_LANG->PENDING_REVIEWS_REPLIES ?></td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
		<?php
		if ( count($reviewsreply) <= 0 ) {
			?>
			<tr><th align="left">&nbsp;</th></tr>
			<tr class="row0"><td><?php echo $_MT_LANG->NO_REPLY_FOUND ?></td></tr>
			<?php
		} else {

		$k = 0;
		for ($i=0, $n=count( $reviewsreply ); $i < $n; $i++) {
			$row = &$reviewsreply[$i]; ?>
			<thead><tr><th align="left"<?php echo ( ($mtconf->get('use_internal_notes')) ? ' colspan="2"': '' ) ?>><a href="<?php echo $mtconf->getjconf('live_site') . "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $row->link_name ?></a></th></tr></thead>
			<tr align="left">
				<td<?php echo ( ($mtconf->get('use_internal_notes')) ? ' width="65%"': '' ) ?>>
					<blockquote style="margin:3px 0 10px 2px;background-color:#F3F3F3;padding:6px;border: 1px solid #e1e1e1;border-left:6px solid #E1E1E1;">
					<?php echo '<strong>' . $row->rev_title . '</strong>';
					echo ' - <a href="index2.php?option=com_mtree&task=editreview&rid=' . $row->rev_id . '">' . $_MT_LANG->EDIT_REVIEW . '</a>';
					echo '<br />' . $_MT_LANG->REVIEWED_BY . ' <a href="index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$row->user_id.'">' . $row->username . '</a>, ' . $row->rev_date ?>
					<p />
					<?php echo nl2br($row->rev_text); ?>
					</blockquote>
					<?php 
						if( !empty($row->owner_username) ) {
							echo '<a href="index2.php?option=com_mtree&task=spy&task2=viewuser&id='.$row->owner_user_id.'">'.$row->owner_username."</a>  ";
						}
						echo $row->ownersreply_date;
					?>
					<p />
					<textarea class="text_area" style="width:100%;height:150px" name="or_text[<?php echo $row->rev_id ?>]"><?php echo htmlspecialchars($row->ownersreply_text) ?></textarea>
					<p />

					<label for="app_<?php echo $row->rev_id ?>"><input type="radio" name="or[<?php echo $row->rev_id ?>]" value="1" id="app_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->APPROVE ?></label>
					<label for="ign_<?php echo $row->rev_id ?>"><input type="radio" name="or[<?php echo $row->rev_id ?>]" value="0" id="ign_<?php echo $row->rev_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
					<label for="rej_<?php echo $row->rev_id ?>"><input type="radio" name="or[<?php echo $row->rev_id ?>]" value="-1" id="rej_<?php echo $row->rev_id ?>" /><?php echo $_MT_LANG->REJECT ?></label>
				</td>
				<?php if( $mtconf->get('use_internal_notes') ) { ?>
				<td style="height:100px;" valign="top" width="35%">
				<?php echo $_MT_LANG->INTERNAL_NOTES ?>:<br />
				<textarea class="text_area" style="width:100%;height:200px" name="admin_note[<?php echo $row->rev_id ?>]"><?php echo htmlspecialchars($row->ownersreply_admin_note) ?></textarea>
				</td>
				<?php } ?>
			</tr>
			<?php		$k = 1 - $k; } } ?>
		</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="save_reviewsreply" />
		</form>
		<?php
	}

	function listpending_claims( $claims, $pathWay, $option ) {
		global $_MT_LANG, $mtconf;
		//$mt_use_internal_notes;
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
			<thead><tr><th align="left"<?php echo ( ($mtconf->get('use_internal_notes')) ? ' colspan="2"': '' ) ?>><a href="index2.php?option=com_mtree&task=editlink&link_id=<?php echo $row->link_id; ?>"><?php echo $row->link_name ?></a> by <a href="mailto:<?php echo $row->email ?>"><?php echo $row->name ?></a> (<?php echo $row->username ?>), <?php echo $row->created ?> - <a href="<?php echo $mtconf->getjconf('live_site') . "/index.php?option=com_mtree&task=viewlink&link_id=$row->link_id"; ?>" target="_blank"><?php echo $_MT_LANG->VIEW_LISTING ?></a></th></tr></thead>
			<tr align="left">
				<td <?php echo ( ($mtconf->get('use_internal_notes')) ? 'width="65%" ': '' ) ?>valign="top">
					<?php echo nl2br(htmlspecialchars($row->comment)) ?>
					<p />
					<label for="app_<?php echo $row->claim_id ?>"><input type="radio" name="claim[<?php echo $row->claim_id ?>]" value="<?php echo $row->user_id ?>" id="app_<?php echo $row->claim_id ?>" /><?php echo $_MT_LANG->APPROVE ?></label>
					<label for="ign_<?php echo $row->claim_id ?>"><input type="radio" name="claim[<?php echo $row->claim_id ?>]" value="0" id="ign_<?php echo $row->claim_id ?>" checked="checked" /><?php echo $_MT_LANG->IGNORE ?></label>
					<label for="rej_<?php echo $row->claim_id ?>"><input type="radio" name="claim[<?php echo $row->claim_id ?>]" value="-1" id="rej_<?php echo $row->claim_id ?>" /><?php echo $_MT_LANG->REJECT ?></label>
				</td>
				<?php if ( $mtconf->get('use_internal_notes') ) { ?>
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
				<th class="title" width="15%" nowrap="nowrap"><?php echo $_MT_LANG->USER ?></th>
				<th width="60%" align="left" nowrap="nowrap"><?php echo $_MT_LANG->REVIEW_TITLE ?></th>
				<th width="10%"><?php echo $_MT_LANG->HELPFULS ?></th>
				<th width="15%"><?php echo $_MT_LANG->CREATED ?></th>
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
				<td align="center"><?php if( $row->vote_total > 0 ) { 
					echo $row->vote_helpful.' '.$_MT_LANG->OF.' '.$row->vote_total; 
				} else {
					echo '-';
				}
				?></td>
				<td align="center"><?php echo $row->rev_date; ?></td>
			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="5"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="5"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

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
			if (form.rev_text.value == ""){
				alert( "<?php echo $_MT_LANG->PLEASE_ENTER_REVIEW_TEXT ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<table class="adminheading">
			<tr><th class="edit"><?php echo $row->rev_id ? $_MT_LANG->EDIT : $_MT_LANG->ADD ;?> <?php echo $_MT_LANG->REVIEW ?></td></tr>
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
					<input class="text_area" type="text" name="owner" size="20" maxlength="250" value="<?php echo (($row->not_registered) ? $row->guest_name : $row->owner );?>" /> <input type="checkbox" name="not_registered" id="not_registered" value="1" <?php echo (($row->not_registered) ? 'checked ' : '' ); ?>/> <label for="not_registered"><?php echo $_MT_LANG->THIS_IS_NOT_A_REGISTERED_USER ?></label>
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
				<td align="left"><textarea name="rev_text" cols="70" rows="15" class="text_area"><?php echo $row->rev_text; ?></textarea></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->APPROVED ?>:</td>
				<td align="left"><?php echo $lists['rev_approved'] ?></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->HELPFULS ?>:</td>
				<td align="left"><input class="text_area" type="text" name="vote_helpful" size="3" maxlength="4" value="<?php echo $row->vote_helpful;?>" /> <?php echo $_MT_LANG->OF ?> <input class="text_area" type="text" name="vote_total" size="3" maxlength="4" value="<?php echo $row->vote_total;?>" /></td>
			</tr>
			<tr>
			  <td valign="top" align="right"><?php echo $_MT_LANG->OVERRIDE_CREATED_DATE ?> </td>
			  <td align="left"><input class="text_area" type="text" name="rev_date" id="created" size="25" maxlength="19" value="<?php echo $row->rev_date; ?>" />
				 <input name="reset" type="reset" class="button" onClick="return showCalendar('created', 'y-mm-dd');" value="..."></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->OWNERS_REPLY ?>:</td>
				<td align="left"><textarea name="ownersreply_text" cols="70" rows="8" class="text_area"><?php echo $row->ownersreply_text; ?></textarea></td>
			</tr>
			<tr>
				<td valign="top" align="right"><?php echo $_MT_LANG->APPROVED ?>:</td>
				<td align="left"><?php echo $lists['ownersreply_approved'] ?></td>
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


			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="6"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="6"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

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
			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="7"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="7"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="7">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

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
		global $_MT_LANG, $mtconf;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th class="langmanager"><?php echo $_MT_LANG->LANGUAGES ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<thead>
			<tr>
			<th width="25%" class="title"><?php echo $_MT_LANG->LANGUAGE ?></th>
			<th width="10%"><?php echo $_MT_LANG->VERSION ?></th>
			<th width="10%"><?php echo $_MT_LANG->DATE ?></th>
			<th width="20%"><?php echo $_MT_LANG->AUTHOR ?></th>
			<th width="25%"><?php echo $_MT_LANG->EMAIL ?></th>
			<th width="10%"><?php echo $_MT_LANG->DEFAULT ?></th>
			</tr>
			</thead>
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
      		$language_file = $mtconf->getjconf('absolute_path') . '/components/com_mtree/language/' . $active_language . '.php';
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
		global $_MT_LANG;
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th class="templates"><?php echo $_MT_LANG->TREE_TEMPLATES ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<thead>
			<tr>
				<th class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->NAME ?></th>
				<th class="title" width="60%" nowrap="nowrap"><?php echo $_MT_LANG->DESCRIPTION ?></th>
				<th class="title" width="10%" nowrap="nowrap" align="center"><?php echo $_MT_LANG->DEFAULT ?></th>
			</tr>
			</thead>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i]; ?>
			<tr class="<?php echo "row$k"; ?>" align="left">
				<td><input type="radio" id="cb<?php echo $i ?>" name="template" value="<?php echo $row->directory; ?>"<?php //echo ($row->default) ? 'checked' : '';?> onClick="isChecked(this.checked);" /> <a href="" onClick="return listItemTask('cb<?php echo $i ?>','template_pages')"><?php echo $row->name; ?></a></td>
				<td><?php echo $row->description; ?></td>
				<td align="center"><?php echo ($row->default) ? '<img src="images/tick.png">' : '&nbsp;' ; ?></td>
			</tr>
			<?php		$k = 1 - $k; } ?>
			<tfoot>
			<tr><th colspan="3"></th></tr>
			</tfoot>
		</table>

		<p />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		</form>
		<?php
	}
	
	function template_pages( $template, $template_name, $params, $option ) {
		global $_MT_LANG;
	?>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminheading">
		<tr>
			<th class="templates"><?php echo $_MT_LANG->TREE_TEMPLATES ?>: <? echo $template_name ?></th>
		</tr>
	</table>
	<?php if(!is_null($params)) { ?>
	<div style="width:57%;float:left">
	<?php } ?>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminlist">
		<thead>
		<tr>
			<th colspan="3" class="title" width="30%" nowrap="nowrap"><?php echo $_MT_LANG->SELECT_TEMPLATE_FILE_TO_EDIT ?></th>
		</tr>
		</thead>

		<tr>
			<td width="33%" align="left" valign="top">
				
				<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				
				<tr><td><h3><?php echo $_MT_LANG->LISTING ?></h3></td></tr>
				<tr><td>
					<input type="radio" id="cb1" name="page" value="page_listing" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb1','edit_templatepage')"><?php echo $_MT_LANG->TEM_VIEW_LISTING ?></a>
				</td></tr>
				<tr><td>
					<input type="radio" id="cb2" name="page" value="sub_listingDetails" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb2','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTING_DETAILS ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb3" name="page" value="sub_listingSummary" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb3','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTING_SUMMARY ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb4" name="page" value="sub_listings" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb4','edit_templatepage')"><?php echo $_MT_LANG->LISTINGS ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb5" name="page" value="page_addListing" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb5','edit_templatepage')"><?php echo $_MT_LANG->ADD_LISTING ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb6" name="page" value="page_contactOwner" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb6','edit_templatepage')"><?php echo $_MT_LANG->CONTACT_OWNER ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb7" name="page" value="page_writeReview" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb7','edit_templatepage')"><?php echo $_MT_LANG->WRITE_REVIEW ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb8" name="page" value="page_print" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb8','edit_templatepage')"><?php echo $_MT_LANG->PRINT ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb9" name="page" value="sub_reviews" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb9','edit_templatepage')"><?php echo $_MT_LANG->REVIEWS ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb11" name="page" value="page_recommend" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb11','edit_templatepage')"><?php echo $_MT_LANG->TEM_RECOMMEND_FORM ?></a></td></tr>
				
				</table>

			</td>
			<td width="33%" align="left" valign="top">

				<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

				<tr><td><h3><?php echo $_MT_LANG->INDEX ?></h3>
				<tr><td>
					<input type="radio" id="cb12" name="page" value="page_index" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb12','edit_templatepage')"><?php echo $_MT_LANG->MAIN ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb13" name="page" value="page_subCatIndex" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb13','edit_templatepage')"><?php echo $_MT_LANG->CATEGORY ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb14" name="page" value="page_listAlpha" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb14','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTALPHA ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb15" name="page" value="page_listListings" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb15','edit_templatepage')"><?php echo $_MT_LANG->TOP_LISTINGS ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb31" name="page" value="page_ownerListing" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb31','edit_templatepage')"><?php echo $_MT_LANG->OWNERS_LISTING ?></a></td></tr>

				<tr><td>
					<input type="radio" id="cb35" name="page" value="page_usersFavourites" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb35','edit_templatepage')"><?php echo $_MT_LANG->TEM_USERS_FAVOURITES ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb36" name="page" value="page_usersReview" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb36','edit_templatepage')"><?php echo $_MT_LANG->TEM_USERS_REVIEWS ?></a></td></tr>

				</table>
		
			</td>
			<td width="33%" align="left" valign="top">

				<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

				<tr><td><h3><?php echo $_MT_LANG->CATEGORY ?></h3></td></tr>
				<tr><td>
					<input type="radio" id="cb21" name="page" value="page_addCategory" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb21','edit_templatepage')"><?php echo $_MT_LANG->ADD_CAT ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb22" name="page" value="sub_subCats" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb22','edit_templatepage')"><?php echo $_MT_LANG->TEM_SUBCATS ?></a></td></tr>

				</table>
				<br />
				<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

				<tr><td><h3><?php echo $_MT_LANG->MISC ?></h3></td></tr>
				<tr><td>
					<input type="radio" id="cb23" name="page" value="page_advSearch" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb23','edit_templatepage')"><?php echo $_MT_LANG->ADVANCED_SEARCH ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb24" name="page" value="page_advSearchRedirect" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb24','edit_templatepage')"><?php echo $_MT_LANG->ADVANCED_SEARCH_REDIRECT ?></a></td></tr>
										<tr><td>
					<input type="radio" id="cb25" name="page" value="page_advSearchResults" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb25','edit_templatepage')"><?php echo $_MT_LANG->ADVANCED_SEARCH_RESULTS ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb26" name="page" value="page_searchResults" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb26','edit_templatepage')"><?php echo $_MT_LANG->SEARCH_RESULTS ?></a></td></tr>

				<tr><td>
					<input type="radio" id="cb27" name="page" value="page_confirmDelete" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb27','edit_templatepage')"><?php echo $_MT_LANG->TEM_CONFIRM_DELETE ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb28" name="page" value="page_error" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb28','edit_templatepage')"><?php echo $_MT_LANG->ERROR ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb29" name="page" value="page_errorListing" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb29','edit_templatepage')"><?php echo $_MT_LANG->TEM_LISTING_ERROR ?></a></td></tr>
				<tr><td>
					<input type="radio" id="cb32" name="page" value="sub_alphaIndex" onclick="isChecked(this.checked);" /><a href="#go" onclick="return listItemTask('cb32','edit_templatepage')"><?php echo $_MT_LANG->TEM_AZ ?></a></td></tr>

				</table>
					
			</td>
		</tr>
	</table>
	<?php if(!is_null($params)) { 
		mosCommonHTML::loadOverlib();
	?>
	</div>
	<div style="width:43%;float:left;clear:none">
	<table class="adminform">
	<tr><th ><?php echo $_MT_LANG->PARAMETERS ?></th></tr>
	<tr><td><?php echo $params->render();?></td>
	</tr>
	</table>
	</div>
	<?php } ?>
	
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="template" value="<?php echo $template ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	
	</form>
	<?php
	}
	
	function edit_templatepage( $page, $template, $content, $option ) {
		global $_MT_LANG, $mtconf;
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
      		$template_path = $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates/' . $template . '/'.$page.'.tpl.php';
      		echo is_writable( $template_path ) ? '<b><font color="orange"> - '.$_MT_LANG->WRITEABLE.'</font></b>' : '<b><font color="red"> - '.$_MT_LANG->UNWRITEABLE.'</font></b>';
      		?>
			</th>
		</tr>
		<tr>
			<td>
			<textarea cols="90" rows="25" name="pagecontent" class="inputbox" style="width:100%"><?php echo $content; ?></textarea>
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
	
	function new_template( $option ) {
		global $_MT_LANG, $mtconf;
	?>
	<form enctype="multipart/form-data" action="index2.php" method="post" name="adminForm">
	<table class="adminheading"><tr><th class="install"><?php echo $_MT_LANG->UPLOAD_NEW_TEMPLATE ?></th></tr></table>
	<table class="adminform">
	<tr><th><?php echo $_MT_LANG->UPLOAD_PACKAGE_FILE ?></th></tr>
	<tr>
		<td align="left">
		<?php echo $_MT_LANG->PACKAGE_FILE ?>:
		<input class="text_area" name="template" type="file" size="70"/>
		<input class="button" type="submit" value="<?php echo $_MT_LANG->UPLOAD_FILE_AND_INSTALL ?>" />
		</td>
	</tr>
	</table>
	<input type="hidden" name="option" value="<?php echo $option ?>" />
	<input type="hidden" name="task" value="install_template" />
	</form>
	
	<p />
	
	<table class="content">
	<?php
		echo '<td class="item">';
		echo '<strong>/components/com_mtree/templates</strong>';
		echo '</td><td align="left">';
		if( is_writable( $mtconf->getjconf('absolute_path') . '/components/com_mtree/templates' ) ) {
			echo '<b><font color="green">Writeable</font></b>';
		} else {
			echo '<b><font color="red">Unwriteable</font></b>';
		} 
	?></td></tr>
		
	</table>
	<?php
	}
	
	/***
	* Advanced Back-end Search
	*/
	function advsearch( $fields, $lists, $option ) {
		global $_MT_LANG, $mtconf;
		?>

		<table class="sectionname"><tr><th><?php echo $_MT_LANG->ADVANCED_SEARCH ?></th></tr></table>

		<form action="index2.php" method="post" name="adminForm">

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
				<th class="title" colspan="2" width="100%" nowrap="nowrap"><?php echo $_MT_LANG->SEARCH_LISTINGS ?></th>
			</tr>
			<tr>
				<td valign="top">
					<table cellpadding="4" cellspacing="0" border="0" width="100%">
						<tr>
							<td colspan="2"><?php printf($_MT_LANG->RETURN_RESULTS_IF_X_OF_THE_FOLLOWING_CONDITIONS_ARE_MET,$lists['searchcondition']); ?></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;&nbsp;<input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" /> &nbsp; <input type="reset" value="<?php echo $_MT_LANG->RESET ?>" class="button" />
						</tr>
						<?php
						while( $fields->hasNext() ) {
							$field = $fields->getField();
							if($field->hasSearchField()) {
								echo '<tr>';
								echo '<td valign="top" align="left">' . $field->caption . ':' . '</td>';
								echo '<td align="left">';
								echo $field->getSearchHTML();
								echo '</td>';
								echo '</tr>';
							}
							$fields->next();
						}
						?>
						<tr>
							<td align="left"><?php echo $_MT_LANG->OWNER?>:</td>
							<td align="left"><input name="owner" type="text" class="text_area" size="20" /></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->PUBLISHING?>:</td>
							<td align="left"><?php echo $lists['publishing'] ?></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->TEMPLATE?>:</td>
							<td align="left"><?php echo $lists['templates'] ?></td>
						</tr>
						<tr>
							<td align="left"><?php echo $_MT_LANG->NOTES?>:</td>
							<td align="left" colspan="3"><input name="internal_notes" type="text" class="text_area" size="20" /></td>
						</tr>
					</table>	
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;&nbsp;<input type="submit" value="<?php echo $_MT_LANG->SEARCH ?>" class="button" /> &nbsp; <input type="reset" value="<?php echo $_MT_LANG->RESET ?>" class="button" />
			</tr>
		</table>
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


			</tr><?php

				$k = 1 - $k;
			}

			if( $GLOBALS['_VERSION']->RELEASE == '1.0' ) {
				?>

			<tfoot>
			<tr>
				<th align="center" colspan="6"> <?php echo $pageNav->writePagesLinks(); ?></th>
			</tr>
			<tr>
				<td align="center" colspan="6"> <?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot><?php

			} else {
				?>

			<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot><?php

			}

			?>

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
		<input type="hidden" name="state" value="<?php echo $_POST['state'] ?>" />
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
		<!-- <input type="hidden" name="link_image" value="<?php echo $_POST['link_image'] ?>" /> -->
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
	function csv( $fields, $lists, $option ) {
		global $_MT_LANG;
	?>
  <script type="text/javascript" language="javascript">
		function submitbutton( pressbutton ) {
			var form = document.adminForm;

			// do field validation
			var temp = false;
			if(pressbutton=='csv_export') {
				var elts      = document.adminForm.elements['fields[]'];
				var elts_cnt  = (typeof(elts.length) != 'undefined')
											? elts.length
											: 0;

				for (var i = 0; i < elts_cnt; i++) {
						if (elts[i].checked == true) temp = true;
				} 
			} else {
				temp = true;
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
			<thead>
			<tr>
				<th colspan="4" class="title" width="100%" nowrap="nowrap"><?php echo $_MT_LANG->EXPORT ?></th>
			</tr>
			</thead>
			
			<tr class="row0"><td colspan="4" align="left"><b><?php echo $_MT_LANG->FIELDS ?></b></td></tr>

			<tr>
				<td width="33%" valign="top" align="left">
					<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
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
							<input type="checkbox" name="fields[]" value="state" /><?php echo $_MT_LANG->STATE ?>
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
					<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
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
					<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
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
			$fields->resetPointer();
			$count=0;
			for($i=0;$i<3;$i++) {
				echo '<td align="left" width="33%" valign="top">';
				echo '<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">';
				for($j=$count;$j<(ceil($fields->getTotal()/3)*($i+1)) && $fields->hasNext();$j++) {
					$field = $fields->getField();
					?>
					<tr><td align="left">
						<input type="checkbox" name="fields[]" value="<?php echo $field->getInputFieldName(1) ?>" id="<?php echo $field->getInputFieldName(1) ?>" /> <label for="<?php echo $field->getInputFieldName(1) ?>"><?php echo $field->getCaption(true) ?></label>
					</td></tr>
					<?php
					$count++;
					$fields->next();
					if($count>=(ceil($fields->getTotal()/3)*($i+1))) {
						break;
					}
				}
				echo '</table>';
				if($i==0) {
					echo '<a href="#" onclick="setCheckboxes(\'adminForm\', true); return false;">' . $_MT_LANG->SELECT_ALL . '</a> / <a href="#" onclick="setCheckboxes(\'adminForm\', false); return false;">' . $_MT_LANG->UNSELECT_ALL . '</a>';
				}
				echo '</td>';
			}
			?>
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
			<textarea name="csv_excel" rows="30" cols="80" style="width:100%"><?php 
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
	* Configuration
	*/
	function config( $configs, $configgroups, $lists, $option ) {
		global $_MT_LANG, $mtconf;

		# Initialize Tabs
		$tabs = new mosTabs(0);
	?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		submitform( pressbutton );
	}
</script>

<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
  <tr>
    <th width="100%" class="config"><?php echo $mtconf->get('name') ." ". $_MT_LANG->CONFIGURATION ?></th>
  </tr>
</table>

<form action="index2.php" method="POST" name="adminForm">
	<?php
	$tabs->startPane("content-pane");
	$configgroup = '';
	$j=0;
	
	foreach( $configgroups AS $configgroup ) {
		
		if( $j > 0 ) {
			$tabs->endTab();
		}
		$tabs->startTab( $_MT_LANG->{strtoupper($configgroup)}, $configgroup.'-page');
		
	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
	<?php 
		$i = 0;
		foreach( $configs AS $config ) { 
			if( $config->groupname == $configgroup ) {

				echo '<tr>';
				if( $config->configcode == 'note' ) {
					echo '<td colspan="2" align="left" style="border-bottom: 1px solid #C0C0C0;border-top: 1px solid #C0C0C0; background-color: #FFFFFF">';
				} elseif( !in_array($config->configcode, array('sort_direction','predefined_reply')) ) {
					echo '<td align="left" valign="top"';
					if($i<=1) {
						echo ' width="285"';
					}
					echo '>';
					if( isset($_MT_LANG->{'CONFIGNAME_'.strtoupper($config->varname)}) && !empty($_MT_LANG->{'CONFIGNAME_'.strtoupper($config->varname)}) ) {
						echo $_MT_LANG->{'CONFIGNAME_'.strtoupper($config->varname)};
					} else {
						echo $config->varname;
					}
					
					if( substr($config->varname,0,4) == 'rss_' ) {
						if( $config->varname == 'rss_custom_fields') {
							echo ' (cust_#)';
						} else {
							echo ' ('.substr($config->varname,4).')';
						}
					}
					echo ':</td><td align="left"';
					if($i<=1) {
						echo ' width="76%"';
					}
					echo '>';
				}
				switch( $config->configcode ) {
					case 'text':
						echo '<input name="'.$config->varname.'" value="'.$config->value.'" size="30" class="text_area" />';
						break;
					case 'template':
					case 'language':
					case 'map':
					case 'resize_method':
						echo $lists[$config->configcode];
						break;
					case 'yesno':
						echo mosHTML::yesnoSelectList($config->varname,'class="text_area"',$config->value);
						break;
					case 'sort_direction':
						continue;
						break;
					case 'cat_order':
					case 'listing_order':
					case 'review_order':
						$tmp_varname = substr($config->varname,0,-1);
						echo mosHTML::selectList( $lists[$configs[$tmp_varname.'1']->configcode], $tmp_varname.'1', 'class="inputbox" size="1"',	'value', 'text', $configs[$tmp_varname.'1']->value );
						echo mosHTML::selectList( $lists[$configs[$tmp_varname.'2']->configcode], $tmp_varname.'2', 'class="inputbox" size="1"',	'value', 'text', $configs[$tmp_varname.'2']->value );
						if( substr($config->varname,-1) == '1' ) {
							unset($configs[$tmp_varname.'2']);
						} else {
							unset($configs[$tmp_varname.'1']);
						}
						break;
					case 'predefined_reply':
						continue;
						break;
					case 'predefined_reply_title':
						$tmp_varname = substr($config->varname,17,1);
						echo '<input name="predefined_reply_'.$tmp_varname.'_title" value="'.$configs['predefined_reply_'.$tmp_varname.'_title']->value.'" size="60" class="text_area" />';
						echo '<br />';
						echo '<textarea style="margin-top:5px" name="predefined_reply_'.$tmp_varname.'_message" class="text_area" cols="80" rows="8" />'.$configs['predefined_reply_'.$tmp_varname.'_message']->value.'</textarea>';
						if( substr($config->varname,19) == 'title' ) {
							unset($configs['predefined_reply_'.$tmp_varname.'_message']);
						} else {
							unset($configs['predefined_reply_'.$tmp_varname.'_title']);
						}						
						break;
					case 'user_access':
					case 'user_access2':
						echo mosHTML::selectList( $lists[$config->configcode], $config->varname, 'class="inputbox" size="1"',	'value', 'text', $config->value );
						break;
					case 'note':
						echo $_MT_LANG->{"CONFIGNOTE_".strtoupper($config->varname)};
						break;
					default:
						echo $config->value;
				}
				if( isset($_MT_LANG->{'CONFIGDESC_'.strtoupper($config->varname)}) ) {
					echo '<span style="background-color:white;padding:0 0 3px 10px;">' . $_MT_LANG->{'CONFIGDESC_'.strtoupper($config->varname)} . '</span>';
				}

			?></td>
		</tr>
	<?php 
				unset($configs[$config->varname]);
				$i++;
			}
		}
		echo '</table>';
		$j++;
	}
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
		global $_MT_LANG, $mtconf, $option;
	?>
	<center><img width="230" height="103" src="../components/com_mtree/img/logo_mtree.gif" alt="<?php echo $mtconf->get('name') ?>"></center>

	<br />
	<table width="50%" border="0" align="center" cellpadding="2" cellspacing="0" class="adminform">
		<tr>
			<th colspan="2"><?php echo $mtconf->get('name') ?></th>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->VERSION ?>:</td>
			<td width="80%" align="left"><?php echo $mtconf->get('version') ; ?></td>
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
			<td width="80%" align="left"><a href="mailto:support@mosets.com">support@mosets.com</a></td>
		</tr>
		<tr>
			<td width="20%" align="right"><?php echo $_MT_LANG->LICENSE ?>:</td>
			<td width="80%" align="left"><a href="index2.php?option=com_mtree&task=license"><?php echo $_MT_LANG->LICENSE_AGREEMENT ?></a></td>
		</tr>

	</table>
	<br />
	<?php echo $_MT_LANG->COPYRIGHT_TEXT ?>
	<form action="index2.php" method="post" name="adminForm">
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="" />
	</form>
	<?php

	}

}
?>