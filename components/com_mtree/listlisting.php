<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 1.50
* @copyright (C) 2006 - 2007 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class mtListListing {

	var $task=null;
	var $_MT_LANG=null;
	var $list=null;
	var $subcats=null;
	var $now=null;
	var $limitstart=0;

	function mtListListing( $task ) {
		global $_MT_LANG, $mtconf;
		$this->task = $task;
		$this->now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );
		$this->list = array(
					'listpopular' => array(
						'title'		=> $_MT_LANG->POPULAR_LISTING2,
						'header'		=> $_MT_LANG->POPULAR_LISTING,
						'template'	=> 'page_popular.tpl.php'
						),
					'listmostrated' => array(
						'title'		=> $_MT_LANG->MOST_RATED_LISTING2,
						'header'		=> $_MT_LANG->MOST_RATED_LISTING,
						'template'	=> 'page_mostRated.tpl.php'
						),
					'listtoprated' => array(
						'title'		=> $_MT_LANG->TOP_RATED_LISTING2,
						'header'		=> $_MT_LANG->TOP_RATED_LISTING,
						'template'	=> 'page_topRated.tpl.php'
						),
					'listmostreview' => array(
						'title'		=> $_MT_LANG->MOST_REVIEWED_LISTING2,
						'header'		=> $_MT_LANG->MOST_REVIEWED_LISTING,
						'template'	=> 'page_mostReviewed.tpl.php'
						),
					'listnew' => array(
						'title'		=> $_MT_LANG->NEW_LISTING2,
						'header'		=> $_MT_LANG->NEW_LISTING,
						'template'	=> 'page_new.tpl.php'
						),
					'listupdated' => array(
						'title'		=> $_MT_LANG->RECENTLY_UPDATED_LISTING2,
						'header'		=> $_MT_LANG->RECENTLY_UPDATED_LISTING,
						'template'	=> 'page_updated.tpl.php'
						),
					'listfavourite' => array(
						'title'		=> $_MT_LANG->MOST_FAVOURED_LISTINGS2,
						'header'		=> $_MT_LANG->MOST_FAVOURED_LISTINGS,
						'template'	=> 'page_mostFavoured.tpl.php'
						),
					'listfeatured' => array(
						'title'		=> $_MT_LANG->FEATURED_LISTING2,
						'header'		=> $_MT_LANG->FEATURED_LISTING,
						'template'	=> 'page_featured.tpl.php'
						)		
					);
	}

	function setSubcats( $cat_ids ) {
		$this->subcats = $cat_ids;
	}

	function setLimitStart( $limitstart ) {
		$this->limitstart = $limitstart;
	}

	function getImplodedSubcats() {
		if( count($this->subcats) == 1 && $this->subcats[0] == 0 ) {
			return 0;
		} else {
			return implode( ", ", $this->subcats );
		}	
	}

	function getTitle() {
		return $this->list[$this->task]['title'];
	}

	function getHeader() {
		return $this->list[$this->task]['header'];
	}

	function getTemplate() {
		return $this->list[$this->task]['template'];
	}

	function getListNewLinkCount() {
		global $mtconf;

		if ( ($this->limitstart + $mtconf->get('fe_num_of_newlisting')) > $mtconf->get('fe_total_newlisting') ) {
			return $mtconf->get('fe_total_newlisting') - $this->limitstart;
		} else {
			return $mtconf->get('fe_num_of_newlisting');
		}
	}

	function getSQL() {
		global $mtconf;

		$sql = '';
		switch( $this->task ) {
			case 'listpopular':
				$sql = "SELECT l.*, u.username, cat.cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						//.	"ORDER BY (link_hits / ((UNIX_TIMESTAMP() - UNIX_TIMESTAMP(link_created))/86400)) DESC "
						. "ORDER BY link_hits DESC "
						. "LIMIT " . $mtconf->get('fe_num_of_popularlisting');
				break;
			case 'listmostrated':
				$sql = "SELECT l.*, u.username, cat.cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "ORDER BY link_votes DESC, link_rating DESC " 
						. "LIMIT " . $mtconf->get('fe_num_of_mostrated');
				break;
			case 'listtoprated':
				$sql = "SELECT l.*, u.username, cat.cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ( $mtconf->get('min_votes_for_toprated') >= 1 ) ? "\n AND l.link_votes >= " . $mtconf->get('min_votes_for_toprated') . " " : '' )
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "ORDER BY link_rating DESC, link_votes DESC  " 
						. "LIMIT " . $mtconf->get('fe_num_of_toprated');
				break;
			case 'listmostreview':
				$sql = "SELECT COUNT(r.link_id) AS reviews, l.*, u.username, cat.*, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "LEFT JOIN #__mt_reviews AS r ON r.link_id = l.link_id "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE l.link_published='1' && l.link_approved='1' && r.rev_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "GROUP BY r.link_id "
						. "ORDER BY reviews DESC " 
						. "LIMIT " . $mtconf->get('fe_num_of_mostreview');
				break;
			case 'listnew':
				$sql = "SELECT l.*, u.username, cat.cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "ORDER BY link_created DESC ";
				$sql .= "LIMIT " . (($this->limitstart) ? $this->limitstart : 0) . ", " . $this->getListNewLinkCount();
				break;
			case 'listupdated':
				$sql = "SELECT l.*, u.username, cat.cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "ORDER BY link_modified DESC ";
				$sql .= "LIMIT " . $mtconf->get('fe_num_of_recentlyupdated');
				break;
			case 'listfavourite':
				$sql = "SELECT l.*, u.username, cl.*, cat.*, COUNT(f.fav_id) AS favourites, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat, #__mt_favourites AS f) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND l.link_id = f.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "\n GROUP BY f.link_id "
						. "ORDER BY favourites DESC ";
				$sql .= "LIMIT " . $mtconf->get('fe_num_of_mostfavoured');
				break;
			case 'listfeatured':
				$sql = "SELECT l.*, u.username, cat.cat_id, img.filename AS link_image FROM (#__mt_links AS l, #__mt_cl AS cl, #__mt_cats AS cat) "
						. "\n LEFT JOIN #__mt_images AS img ON img.link_id = l.link_id AND img.ordering = 1 "
						. "\n LEFT JOIN #__users AS u ON u.id = l.user_id "
						. "WHERE link_published='1' && link_approved='1' && link_featured='1' "
						. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
						. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
						. "\n AND l.link_id = cl.link_id "
						. "\n AND cl.main = 1 "
						. "\n AND cl.cat_id = cat.cat_id "
						. ( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
						. "ORDER BY link_name ASC " 
						. "LIMIT $this->limitstart, " . $mtconf->get('fe_num_of_featured');
				break;
		}
		return $sql;
	}

	function getPageNav() {
		global $database, $mtconf;

		switch( $this->task ) {

			case 'listnew':
				# Get the total available new listings
				$database->setQuery( "SELECT COUNT(*) FROM (#__mt_links AS l, #__mt_cl AS cl) "
					. "WHERE link_published='1' && link_approved='1' "
					. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
					. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) "
					. "\n AND l.link_id = cl.link_id "
					. "\n AND cl.main = 1 "
					.	( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
					);
				$total = $database->loadResult();
				if( $total > $mtconf->get('fe_total_newlisting') ) {
					$total = $mtconf->get('fe_total_newlisting');
				}
				$link_count = $this->getListNewLinkCount();
				break;

			case 'listfeatured':
				$database->setQuery( "SELECT COUNT(*) FROM (#__mt_links AS l, #__mt_cl AS cl) "
					. "WHERE link_published='1' && link_approved='1' && link_featured='1' "
					. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$this->now'  ) "
					. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$this->now' ) " 
					. "\n AND l.link_id = cl.link_id "
					. "\n AND cl.main = 1 "
					.	( ($this->getImplodedSubcats()) ? "\n AND cl.cat_id IN (" . $this->getImplodedSubcats() . ") " : '')
					);
				$total = $database->loadResult();
				$link_count = $mtconf->get('fe_num_of_featured');
				break;

			default:
				return null;
		}


		# Page Navigation
		require_once($mtconf->getjconf('absolute_path')."/includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total, $this->limitstart, $link_count );
		return $pageNav;
	}

}

?>