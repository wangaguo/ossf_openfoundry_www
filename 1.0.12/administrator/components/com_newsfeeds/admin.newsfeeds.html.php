<?php
/**
* @version $Id: admin.newsfeeds.html.php 6070 2006-12-20 02:09:09Z robs $
* @package Joomla
* @subpackage Newsfeeds
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
* @package Joomla
* @subpackage Newsfeeds
*/
class HTML_newsfeeds {

	function showNewsFeeds( &$rows, &$lists, $pageNav, $option ) {
		global $my, $mosConfig_cachepath;
		global $_LANG;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo $_LANG->_( 'Newsfeed Manager' ); ?>
			</th>
			<td width="right">
			<?php echo $lists['category'];?>
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			<?php echo $_LANG->_( 'Num' ); ?>
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title">
			<?php echo $_LANG->_( 'News Feed' ); ?>
			</th>
			<th width="5%">
			<?php echo $_LANG->_( 'Published' ); ?>
			</th>
			<th colspan="2" width="5%">
			<?php echo $_LANG->_( 'Reorder' ); ?>
			</th>
			<th class="title" width="20%">
			<?php echo $_LANG->_( 'Category' ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
			<?php echo $_LANG->_( 'Num Articles' ); ?>
			</th>
			<th width="10%">
			<?php echo $_LANG->_( 'Cache time' ); ?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			mosMakeHtmlSafe($row);
			$link 	= 'index2.php?option=com_newsfeeds&task=editA&hidemainmenu=1&id='. $row->id;

			$img 	= $row->published ? 'tick.png' : 'publish_x.png';
			$task 	= $row->published ? 'unpublish' : 'publish';
			$alt 	= $row->published ? $_LANG->_( 'Published' ) : $_LANG->_( 'Unpublished' );

			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );

			$row->cat_link 	= 'index2.php?option=com_categories&section=com_newsfeeds&task=editA&hidemainmenu=1&id='. $row->catid;
			?>
			<tr class="<?php echo 'row'. $k; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					?>
					<?php echo $row->name; ?>
					&nbsp;[ <i><?php echo $_LANG->_( 'Checked Out' ); ?></i> ]
					<?php
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $_LANG->_( 'Edit Newsfeed' ); ?>">
					<?php echo $row->name; ?>
					</a>
					<?php
				}
				?>
				</td>
				<td width="10%" align="center">
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')">
				<img src="images/<?php echo $img;?>" border="0" alt="<?php echo $alt; ?>" />
				</a>
				</td>
				<td align="center">
				<?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td align="center">
				<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td>
				<a href="<?php echo $row->cat_link; ?>" title="<?php echo $_LANG->_( 'Edit Category' ); ?>">
				<?php echo $row->catname;?>
				</a>
				</td>
				<td align="center">
				<?php echo $row->numarticles;?>
				</td>
				<td align="center">
				<?php echo $row->cache_time;?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<table class="adminform">
		<tr>
			<td>
				<table align="center">
				<?php
				$visible = 0;
				// check to hide certain paths if not super admin
				if ( $my->gid == 25 ) {
					$visible = 1;
				}
				mosHTML::writableCell( $mosConfig_cachepath, 0, '<strong>Cache Directory</strong> ', $visible );
				?>
				</table>
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}


	function editNewsFeed( &$row, &$lists, $option ) {
	global $_LANG;
		mosMakeHtmlSafe( $row, ENT_QUOTES );
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.name.value == '') {
				alert( "<?php echo $_LANG->_( 'Please fill in the newsfeed name.' ); ?>" );
			} else if (form.catid.value == 0) {
				alert( "<?php echo $_LANG->_( 'Please select a Category.' ); ?>" );
			} else if (form.link.value == '') {
				alert( "<?php echo $_LANG->_( 'Please fill in the newsfeed link.' ); ?>" );
			} else if (getSelectedValue('adminForm','catid') < 0) {
				alert( "<?php echo $_LANG->_( 'Please select a category.' ); ?>" );
			} else if (form.numarticles.value == "" || form.numarticles.value == 0) {
				alert( "<?php echo $_LANG->_( 'VALIDFILLNUMBERARTICLESDISPLAY' ); ?>" );
			} else if (form.cache_time.value == "" || form.cache_time.value == 0) {
				alert( "<?php echo $_LANG->_( 'Please fill in the cache refresh time.' ); ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit">
			<?php echo $_LANG->_( 'Newsfeed' ); ?>: <small><?php echo $row->id ? $_LANG->_( 'Edit' ) : $_LANG->_( 'New' );?></small> <small><small>[ <?php echo $row->name;?> ]</small></small>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo $_LANG->_( 'Details' ); ?>
			</th>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Name' ); ?>
			</td>
			<td>
			<input class="inputbox" type="text" size="40" name="name" value="<?php echo $row->name; ?>">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Category' ); ?>
			</td>
			<td>
			<?php echo $lists['category']; ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Link' ); ?>
			</td>
			<td>
			<input class="inputbox" type="text" size="60" name="link" value="<?php echo $row->link; ?>">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Number of Articles' ); ?>
			</td>
			<td>
			<input class="inputbox" type="text" size="2" name="numarticles" value="<?php echo $row->numarticles; ?>">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Cache time (in seconds)' ); ?>
			</td>
			<td>
			<input class="inputbox" type="text" size="4" name="cache_time" value="<?php echo $row->cache_time; ?>">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $_LANG->_( 'Ordering' ); ?>
			</td>
			<td>
			<?php echo $lists['ordering']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top" align="right">
			<?php echo $_LANG->_( 'Published' ); ?>:
			</td>
			<td>
			<?php echo $lists['published']; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo $row->id; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="">
		</form>
	<?php
	}
}
?>