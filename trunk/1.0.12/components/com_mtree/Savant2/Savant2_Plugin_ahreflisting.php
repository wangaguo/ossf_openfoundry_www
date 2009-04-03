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


class Savant2_Plugin_ahreflisting extends Savant2_Plugin {
	
	function plugin(&$link, $attr=null, $show=null, $visit=0)
	{
		global $Itemid, $mt_link_new, $mt_link_popular, $mt_user_allowdelete, $mt_user_allowmodify, $_MT_LANG, $my;

		# Setup default value for $show
		if (!isset($show["link"])) $show["link"] = true;
		if (!isset($show["new"])) $show["new"] = true;
		if (!isset($show["featured"])) $show["featured"] = true;
		if (!isset($show["popular"])) $show["popular"] = true;
		if (!isset($show["edit"])) $show["edit"] = true;
		if (!isset($show["delete"])) $show["delete"] = true;
		// End of default values

		if ( $show["link"] <> false ) {
			$html = '<a href="';
			$html .= $link->website.'" target="_black"';
//
//			if ( $visit ) {
//				$html .= sefRelToAbs("index2.php?option=com_mtree&task=visit&link_id=".$link->link_id);
//			} else {
//				$html .= sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=".$link->link_id."&Itemid=".$Itemid);
//			}
//
//			$html .= '"';
			
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
			
			# set the listing text, close the tag
//			$html .= '>' . $link->link_name . '</a> ';
			$html .=  '>'.$link->link_name.'&nbsp;<img src="./images/link-ok.png" border="0"></a>' ;
		
		} else {
			$html = $link->link_name.' ';
		}

		# New Link?
		if ($show["new"] <> false) {
			if ( (strtotime(date("Y-m-d H:i:s"))-strtotime($link->link_created)) < ($mt_link_new*86400) ) {
				$html .= '<sup class="new">'.$_MT_LANG->LINK_NEW.'</sup> ';
			}
		}

		# Featured Link?
		if ($show["featured"] <> false) {
			if ( $link->link_featured ) {
				//$html .= '<sup class="featured">'.$_MT_LANG->LINK_FEATURED.'</sup> ';
				$html .= '';
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
				$html .= '<a href="';
				$html .= sefRelToAbs('index.php?option=mtree&task=editlisting&link_id='.$link->link_id.'&Itemid='.$Itemid);
				$html .= '">';
				$html .= '<img border="0" src="images/M_images/edit.png" />';
				$html .= '</a> ';
			}
		}

		# Delete?
		if ($show["delete"] <> false) {
			if ( $my->id == $link->user_id && $mt_user_allowdelete == 1 && $my->id > 0 ) {
				$html .= '<a href="';
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
		$start = strtotime($start_date);
		$end = strtotime("now");
		if ($start > $end) {
			$temp = $start;
			$start = $end;
			$end = $temp;
		}
		return intval(($end-$start)/(86400));
	}

}
?>
