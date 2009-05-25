<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Base plugin class.
*/
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

/**
* Mosets Tree 
*
* @package Mosets Tree 0.8
* @copyright (C) 2004 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <cy@mosets.com>
**/


class Savant2_Plugin_ahreflistingimage extends Savant2_Plugin {

	/**
	* 
	* Output an HTML <a href="">...</a> with optional 'Popular', 'Featured', 'New' text.
	* 
	* @access public
	* 
	* @param int $link_id Listing's ID. To be used in the URL
	*
	* @param object $link Reference to link object.
	* 
	* @return string The <a href="">...</a> tag.
	* 
	*/
	
	//function plugin(&$link, $linkable=true, $attr = null, $showNew=true, $showFeatured=true, $showPopular=true, $showEdit=true, $showDelete=true)
	function plugin(&$link, $attr=null)
	{
		global $Itemid, $_MT_LANG, $my, $mosConfig_live_site, $mosConfig_absolute_path, $mtconf;

		$html = '<a href="';
		$html .= sefRelToAbs('index.php?option=com_mtree&task=viewlink&link_id='.$link->link_id.'&Itemid='.$Itemid);
		$html .= '"';
		
		# set the listing text, close the tag
		// $html .= '><img border="0" src="' . $mtconf->getjconf('live_site').$mtconf->get('relative_path_to_attachment_php').'?img_id='.$link->img_id . '&size=3"';
		$html .= '><img border="0" src="' . $mtconf->getjconf('live_site').$mtconf->get('relative_path_to_listing_small_image').$link->link_image . '"';
		
		// if (substr(PHP_OS, 0, 3) != 'WIN' && ini_get('allow_url_fopen')) {
		if (substr(PHP_OS, 0, 3) != 'WIN') {
			$listingimage_info = @getimagesize($mtconf->getjconf('live_site').$mtconf->get('relative_path_to_listing_small_image').$link->link_image);
			if($listingimage_info !== false && !empty($listingimage_info[0]) && $listingimage_info[0] > 0 && !empty($listingimage_info[1]) && $listingimage_info[1] >0) {
				$html .= ' width="'.$listingimage_info[0].'" height="'.$listingimage_info[1].'"';
			}
		}

		# Insert attributes
		if (is_array($attr)) {
			// from array
			foreach ($attr as $key => $val) {
				$key = htmlspecialchars($key);
				$val = htmlspecialchars($val);
				$html .= " $key=\"$val\"";
			}
		} elseif (! is_null($attr)) {
			// from scalar
			$html .= " $attr";
		}

		$html .= ' /></a> ';
		
		# Return the listing link
		return $html;
	}
}
?>