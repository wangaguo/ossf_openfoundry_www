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
* @package Mosets Tree 1.50
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/


class Savant2_Plugin_listingname extends Savant2_Plugin {

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
	
function plugin(&$link, $attr=null, $show=null)
	{
		global $Itemid, $mt_link_new, $mt_link_popular, $mt_user_allowmodify, $mt_user_allowdelete, $_MT_LANG, $my;

		# Setup default value for $show
		if (!isset($show["link"])) $show["link"] = true;
		if (!isset($show["new"])) $show["new"] = true;
		if (!isset($show["featured"])) $show["featured"] = true;
		if (!isset($show["popular"])) $show["popular"] = true;
		if (!isset($show["edit"])) $show["edit"] = true;
		if (!isset($show["delete"])) $show["delete"] = true;
		// End of default values


		$html = $link->link_name;
		# New Link?
		if ($show["new"] <> false) {
			if ( (strtotime(date("Y-m-d H:i:s"))-strtotime($link->link_created)) < ($mt_link_new*86400) ) {
				$html .= '<sup class="new">'.$_MT_LANG->LINK_NEW.'</sup> ';
			}
		}

		# Featured Link?
		if ($show["featured"] <> false) {
			if ( $link->link_featured ) {
				$html .= '<sup class="featured">'.$_MT_LANG->LINK_FEATURED.'</sup> ';
			}
		}

		# Popular Link?
		if ($show["popular"] <> false) {
			if ( ($this->datediff($link->link_created) > 0) && ($link->link_hits/$this->datediff($link->link_created)) >= $mt_link_popular ) {
				$html .= '<sup class="popular">'.$_MT_LANG->LINK_POPULAR.'</sup> ';
			}
		}

		# Editable?
		if ($show["edit"] <> false) {
			if ( $my->id == $link->user_id && $mt_user_allowmodify == 1 && $my->id > 0 ) {
				$html .= ' <a href="';
				$html .= sefRelToAbs('index.php?option=mtree&task=editlisting&link_id='.$link->link_id.'&Itemid='.$Itemid);
				$html .= '">';
				$html .= '<img src="images/M_images/edit.png" border="0" />';
				$html .= '</a>';
			}
		}

		# Delete?
		if ($show["delete"] <> false) {
			if ( $my->id == $link->user_id && $mt_user_allowdelete == 1 && $my->id > 0 ) {
				$html .= ' <a href="';
				$html .= sefRelToAbs('index.php?option=mtree&task=deletelisting&link_id='.$link->link_id.'&Itemid='.$Itemid);
				$html .= '">';
				$html .= $_MT_LANG->DELETE_LISTING;
				$html .= '</a> ';
			}
		}

		# Return the listing link
		return $html;
	}
	
	function datediff($start_date) {
		$start=strtotime($start_date);
		$end=strtotime("now");
		if ($start > $end) {
			$temp = $start;
			$start = $end;
			$end = $temp;
		}
		return intval(($end-$start)/(24*60*60));
	}

}
?>