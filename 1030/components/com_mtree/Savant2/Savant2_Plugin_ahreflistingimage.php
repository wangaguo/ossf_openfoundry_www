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
		global $Itemid, $_MT_LANG, $my, $mosConfig_live_site, $mt_listing_image_dir;

		//$html = '<a href="';
		//$html .= sefRelToAbs('index.php?option=com_mtree&task=viewlink&link_id='.$link->link_id.'&Itemid='.$Itemid);
		//$html .= '">';
		
		# set the listing text, close the tag
		$html .= '<img border="0" src="' . $mosConfig_live_site.$mt_listing_image_dir.$link->link_image . '"';

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

		$html .= ' />';
		
		# Return the listing link
		return $html;
	}
}
?>
