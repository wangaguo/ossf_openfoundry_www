<?php
/**
* Mosets Tree 
*
* @package Mosets Tree 2.0
* @copyright (C) 2006-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// load feed creator class
require_once( $mtconf->getjconf('absolute_path').'/includes/feedcreator.class.php' );

function rss( $option, $type, $cat_id=0 ) {
	global $database, $_MT_LANG, $mtconf;

	$info	=	null;
	$rss	=	null;
	$now = date( "Y-m-d H:i:s", time()+$mtconf->getjconf('offset')*60*60 );

	$rss = new MTRSSCreator20();
	
	if ($type == 'new') {
		$filename = $mtconf->getjconf('cachepath') . '/mtreeNew' . ($cat_id?'-'.$cat_id:'') . '.xml';
	} else {
		$filename = $mtconf->getjconf('cachepath') . '/mtreeUpdated' . ($cat_id?'-'.$cat_id:'') . '.xml';
	}
	$rss->useCached($filename);
	
	switch($type) {
		case 'updated':
			$rss->title = $mtconf->getjconf('sitename') . $mtconf->get('rss_title_separator') . $_MT_LANG->RECENTLY_UPDATED_LISTING;
			break;
		case 'new':
		default:
			$rss->title = $mtconf->getjconf('sitename') . $mtconf->get('rss_title_separator') . $_MT_LANG->NEW_LISTING;
			break;
	}
	if($cat_id>0) {
		$mtCats = new mtCats($database);
		$cat_name = $mtCats->getName($cat_id);
		$rss->title .= $mtconf->get('rss_title_separator') . $cat_name;
	}
	
	$rss->link = $mtconf->getjconf('live_site');
	$rss->cssStyleSheet	= NULL;
	$rss->feedURL = $mtconf->getjconf('live_site').$_SERVER['PHP_SELF'];

	$database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_mtree' AND published='1' LIMIT 1");
	$Itemid = $database->loadResult();
	
	$sql = "SELECT l.*, u.username, u.name AS owner, c.cat_id, c.cat_name FROM (#__mt_links AS l, #__mt_cl AS cl, #__users AS u, #__mt_cats AS c) "
		. "WHERE link_published='1' && link_approved='1' "
		. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  ) "
		. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' ) "
		. "\n AND l.link_id = cl.link_id "
		. "\n AND cl.main = 1 "
		. "\n AND cl.cat_id = c.cat_id "
		. "\n AND l.user_id = u.id ";
	if($cat_id > 0) {
		$subcats = getSubCats_Recursive($cat_id);
		if(count($subcats)>1) {
			$sql .= ' AND cl.cat_id IN (' . implode(',',$subcats) . ')';
		}
	}
	switch($type) {
		case 'updated':
			$sql .= "ORDER BY l.link_modified DESC ";
			break;
		case 'new':
		default:
			$sql .= "ORDER BY l.link_created DESC ";
			break;
	}
	$sql .= "LIMIT 10";
	$database->setQuery( $sql );
	$links = $database->loadObjectList();

	# Get arrays if link_ids
	foreach( $links AS $link ) {
		$link_ids[] = $link->link_id;
	}
	
	# Additional elements from core fields
	$core_fields = array( 'cat_name', 'cat_url', 'link_votes', 'link_rating', 'address', 'city', 'postcode', 'state', 'country', 'email', 'website', 'telephone', 'fax', 'metakey', 'metadesc' );
	$additional_elements = array();
	foreach( $core_fields AS $core_field ) {
		if($mtconf->get('rss_'.$core_field)) { $additional_elements[] = $core_field; }
	}
	
	# Additional elements from custom fields
	$custom_fields = trim($mtconf->get( 'rss_custom_fields' ));
	$custom_fields_values = array();
	if( !empty($custom_fields) && count($link_ids) > 0 ) {
		$array_custom_fields = explode(',',$custom_fields);
		foreach( $array_custom_fields AS $key => $value ) {
			if( intval($value) > 0 ) {
				$array_custom_fields[$key] = intval($value);
				$additional_elements[] = 'cust_' . $array_custom_fields[$key];
			} else {
				unset($array_custom_fields[$key]);
			}
		}
		if( count($array_custom_fields) > 0 ) {
			$database->setQuery( 'SELECT cf_id, link_id, value FROM #__mt_cfvalues WHERE cf_id IN (' . implode(',',$array_custom_fields) . ') AND link_id IN (' . implode(',',$link_ids) . ') LIMIT ' . (count($array_custom_fields) * count($link_ids)) );
			$array_custom_fields_values = $database->loadObjectList();
			foreach( $array_custom_fields_values AS $array_custom_fields_value ) {
				$custom_fields_values[$array_custom_fields_value->link_id][$array_custom_fields_value->cf_id] = $array_custom_fields_value->value;
			}
		}
	}
	
	foreach( $links AS $link ) {
		$item = new FeedItem();
		$item->title = $link->link_name;
		$item->link = sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=".$link->link_id."&Itemid=".$Itemid);
		$item->guid = sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=".$link->link_id."&Itemid=".$Itemid);
		$item->description = $link->link_desc;
		//optional
		$item->descriptionHtmlSyndicated = true;

		switch($type) {
			case 'updated':
				$item->date = strtotime($link->link_modified);
				break;
			case 'new':
			default:
				$item->date = strtotime($link->link_created);
				break;
		}
		$item->source = $mtconf->getjconf('live_site');
		// $item->author = $link->owner;
		$item->author = $link->username;
		if(count($additional_elements)>0) {
			$ae = array();
			foreach($additional_elements AS $additional_element) {
				if( in_array($additional_element,$core_fields) ) {
					if ($additional_element == 'cat_url') {
						$ae['mtree:'.$additional_element] = htmlspecialchars(sefReltoAbs('index.php?option=com_mtree&task=listcats&cat_id='.$link->cat_id.'&Itemid='.$Itemid));
					} else {
						$ae['mtree:'.$additional_element] = '<![CDATA[' . $link->$additional_element . ']]>';
					}
				} else {
					$cf_id = substr( $additional_element, 5 );
					if( array_key_exists($link->link_id,$custom_fields_values) && array_key_exists($cf_id,$custom_fields_values[$link->link_id]) ) {
						$ae['mtree:'.$additional_element] = '<![CDATA[' . str_replace('|',',',$custom_fields_values[$link->link_id][$cf_id]) . ']]>';
					}
				}
			}
			$item->additionalElements = $ae;
		}
		$rss->addItem($item);
	}
	echo $rss->saveFeed($filename);
}

class MTRSSCreator20 extends RSSCreator091 {
	
	function MTRSSCreator20() {
		$this->_setRSSVersion("2.0");
		$this->contentType = "application/rss+xml";
	}
	
	function createFeed() {
		$feed = "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\n";
		$feed.= $this->_createStylesheetReferences();
		$feed.= "<rss version=\"".$this->RSSVersion."\" xmlns:mtree=\"http://www.mosets.com/tree/rss/\">\n";
		$feed.= "<channel>\n";
		$feed.= "<title>".FeedCreator::iTrunc(htmlspecialchars($this->title),100)."</title>\n";
		$this->descriptionTruncSize = 500;
		$feed.= "<description>".$this->getDescription()."</description>\n";
		$feed.= "<link>".$this->link."</link>\n";
		$now = new FeedDate();
		$feed.= "<lastBuildDate>".htmlspecialchars($now->rfc822())."</lastBuildDate>\n";
		$feed.= "<generator>".FEEDCREATOR_VERSION."</generator>\n";

		if ($this->image!=null) {
			$feed.= "<image>\n";
			$feed.= "	<url>".$this->image->url."</url>\n";
			$feed.= "	<title>".FeedCreator::iTrunc(htmlspecialchars($this->image->title),100)."</title>\n";
			$feed.= "	<link>".$this->image->link."</link>\n";
			if ($this->image->width!="") {
				$feed.= "	<width>".$this->image->width."</width>\n";
			}
			if ($this->image->height!="") {
				$feed.= "	<height>".$this->image->height."</height>\n";
			}
			if ($this->image->description!="") {
				$feed.= "	<description>".$this->image->getDescription()."</description>\n";
			}
			$feed.= "</image>\n";
		}
		if ($this->language!="") {
			$feed.= "<language>".$this->language."</language>\n";
		}
		if ($this->copyright!="") {
			$feed.= "<copyright>".FeedCreator::iTrunc(htmlspecialchars($this->copyright),100)."</copyright>\n";
		}
		if ($this->editor!="") {
			$feed.= "<managingEditor>".FeedCreator::iTrunc(htmlspecialchars($this->editor),100)."</managingEditor>\n";
		}
		if ($this->webmaster!="") {
			$feed.= "<webMaster>".FeedCreator::iTrunc(htmlspecialchars($this->webmaster),100)."</webMaster>\n";
		}
		if ($this->pubDate!="") {
			$pubDate = new FeedDate($this->pubDate);
			$feed.= "<pubDate>".htmlspecialchars($pubDate->rfc822())."</pubDate>\n";
		}
		if ($this->category!="") {
			$feed.= "<category>".htmlspecialchars($this->category)."</category>\n";
		}
		if ($this->docs!="") {
			$feed.= "<docs>".FeedCreator::iTrunc(htmlspecialchars($this->docs),500)."</docs>\n";
		}
		if ($this->ttl!="") {
			$feed.= "<ttl>".htmlspecialchars($this->ttl)."</ttl>\n";
		}
		if (isset( $this->rating_count ) && $this->rating_count > 0) {
			$rating = round( $this->rating_sum / $this->rating_count );
			$feed.= "<rating>".FeedCreator::iTrunc(htmlspecialchars($rating),500)."</rating>\n";
		}
		if ($this->skipHours!="") {
			$feed.= "<skipHours>".htmlspecialchars($this->skipHours)."</skipHours>\n";
		}
		if ($this->skipDays!="") {
			$feed.= "<skipDays>".htmlspecialchars($this->skipDays)."</skipDays>\n";
		}
		$feed.= $this->_createAdditionalElements($this->additionalElements, "	");

		for ($i=0;$i<count($this->items);$i++) {
			$feed.= "<item>\n";
			$feed.= "	<title>".FeedCreator::iTrunc(htmlspecialchars(strip_tags($this->items[$i]->title)),100)."</title>\n";
			$feed.= "	<link>".htmlspecialchars($this->items[$i]->link)."</link>\n";
			$feed.= "	<description>".$this->items[$i]->getDescription()."</description>\n";

			if ($this->items[$i]->author!="") {
				$feed.= "	<author>".htmlspecialchars($this->items[$i]->author)."</author>\n";
			}
			if ($this->items[$i]->category!="") {
				$feed.= "	<category>".htmlspecialchars($this->items[$i]->category)."</category>\n";
			}
			if ($this->items[$i]->comments!="") {
				$feed.= "	<comments>".htmlspecialchars($this->items[$i]->comments)."</comments>\n";
			}
			if ($this->items[$i]->date!="") {
			$itemDate = new FeedDate($this->items[$i]->date);
				$feed.= "	<pubDate>".htmlspecialchars($itemDate->rfc822())."</pubDate>\n";
			}
			if ($this->items[$i]->guid!="") {
				$feed.= "	<guid>".htmlspecialchars($this->items[$i]->guid)."</guid>\n";
			}
			$feed.= $this->_createAdditionalElements($this->items[$i]->additionalElements, "	");
			$feed.= "</item>\n";
		}
		$feed.= "</channel>\n";
		$feed.= "</rss>\n";
		return $feed;
	}
}

?>