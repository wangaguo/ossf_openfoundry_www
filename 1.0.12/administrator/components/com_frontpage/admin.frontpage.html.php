<?php
/**
* @version $Id: admin.frontpage.html.php 6070 2006-12-20 02:09:09Z robs $
* @package Joomla
* @subpackage Content
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
* @subpackage Content
*/
class HTML_content {
	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showList( &$rows, $search, $pageNav, $option, $lists ) {
		global $my, $acl, $database;
		global $_LANG;

		mosCommonHTML::loadOverlib();
		$nullDate = $database->getNullDate();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="frontpage" rowspan="2">
			<?php echo $_LANG->_( 'Frontpage Manager' ); ?>
			</th>
			<td width="right">
			<?php echo $lists['sectionid'];?>
			</td>
			<td width="right">
			<?php echo $lists['catid'];?>
			</td>
			<td width="right">
			<?php echo $lists['authorid'];?>
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
			<?php echo $_LANG->_( 'Filter' ); ?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5">
			<?php echo $_LANG->_( 'Num' ); ?>
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title">
			<?php echo $_LANG->_( 'Title' ); ?>
			</th>
			<th width="10%" nowrap="nowrap">
			<?php echo $_LANG->_( 'Published' ); ?>
			</th>
			<th colspan="2" nowrap="nowrap" width="5%">
			<?php echo $_LANG->_( 'Reorder' ); ?>
			</th>
			<th width="2%">
			<?php echo $_LANG->_( 'Order' ); ?>
			</th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
			</th>
			<th width="8%" nowrap="nowrap">
			<?php echo $_LANG->_( 'Access' ); ?>
			</th>
			<th width="10%" align="left">
			<?php echo $_LANG->_( 'Section' ); ?>
			</th>
			<th width="10%" align="left">
			<?php echo $_LANG->_( 'Category' ); ?>
			</th>
			<th width="10%" align="left">
			<?php echo $_LANG->_( 'Author' ); ?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			mosMakeHtmlSafe($row);
			$link = 'index2.php?option=com_content&sectionid=0&task=edit&hidemainmenu=1&id='. $row->id;

			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='. $row->sectionid;
			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='. $row->catid;

			$now = _CURRENT_SERVER_TIME;
			if ( $now <= $row->publish_up && $row->state == '1' ) {
				$img = 'publish_y.png';
				$alt = $_LANG->_( 'Published' );
			} else if (($now <= $row->publish_down || $row->publish_down == $nullDate) && $row->state == '1') {
				$img = 'publish_g.png';
				$alt = $_LANG->_( 'Published' );
			} else if ( $now > $row->publish_down && $row->state == '1' ) {
				$img = 'publish_r.png';
				$alt = $_LANG->_( 'Expired' );
			} elseif ( $row->state == "0" ) {
				$img = "publish_x.png";
				$alt = $_LANG->_( 'Unpublished' );
			}

			$times = '';
			if ( isset( $row->publish_up ) ) {
				  if ( $row->publish_up == $nullDate) {
						$times .= '<tr><td>'. $_LANG->_( 'Start: Always' ) .'</td></tr>';
				  } else {
						$times .= '<tr><td>'. $_LANG->_( 'Start' ) .': '. $row->publish_up .'</td></tr>';
				  }
			}
			if ( isset( $row->publish_down ) ) {
				  if ($row->publish_down == $nullDate) {
						$times .= '<tr><td>'. $_LANG->_( 'Finish: No Expiry' ) .'</td></tr>';
				  } else {
				  $times .= '<tr><td>'. $_LANG->_( 'Finish' ) .': '. $row->publish_down .'</td></tr>';
				  }
			}

			$access 	= mosCommonHTML::AccessProcessing( $row, $i );
			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->created_by;
					$author = '<a href="'. $linkA .'" title="'. $_LANG->_( 'Edit Section' ) .'">'. $row->author .'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $_LANG->_( 'Edit Content' ); ?>">
					<?php echo $row->title; ?>
					</a>
					<?php
				}
				?>
				</td>
				<?php
				if ( $times ) {
					?>
					<td align="center">
					<a href="javascript: void(0);" onmouseover="return overlib('<table><?php echo $times; ?></table>', CAPTION, '<?php echo $_LANG->_( 'Publish Information' ); ?>', BELOW, RIGHT);" onMouseOut="return nd();" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->state ? "unpublish" : "publish";?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt;?>" />
					</a>
					</td>
					<?php
				}
				?>
				<td>
				<?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td>
				<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td align="center" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->fpordering;?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
				<?php echo $access;?>
				</td>
				<td>
				<a href="<?php echo $row->sect_link; ?>" title="<?php echo $_LANG->_( 'Edit Section' ); ?>">
				<?php echo $row->sect_name; ?>
				</a>
				</td>
				<td>
				<a href="<?php echo $row->cat_link; ?>" title="<?php echo $_LANG->_( 'Edit Category' ); ?>">
				<?php echo $row->name; ?>
				</a>
				</td>
				<td>
				<?php echo $author; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php
		echo $pageNav->getListFooter();
		mosCommonHTML::ContentLegend();
		?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}
}
?>