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
	
	function plugin(&$link, $link_name, $attr=null, $show=null, $visit=0)
	{
		global $Itemid, $_MT_LANG, $my, $mtconf;
		// $mt_link_new, $mt_link_popular, $mt_user_allowdelete, $mt_user_allowmodify, 

		# Setup default value for $show
		if (!isset($show["link"])) $show["link"] = true;
		if (!isset($show["new"])) $show["new"] = true;
		if (!isset($show["featured"])) $show["featured"] = true;
		if (!isset($show["popular"])) $show["popular"] = true;
		if (!isset($show["edit"])) $show["edit"] = true;
		if (!isset($show["delete"])) $show["delete"] = true;
		// End of default values
		
		$html = '';
		
		# Editable?
		if ($show["edit"] <> false) {
			if ( $my->id == $link->user_id && $mtconf->get('user_allowmodify') == 1 && $my->id > 0 ) {
				$html .= '<a href="';
				$html .= 'index.php?option=com_mtree&task=editlisting&link_id='.$link->link_id.'&Itemid='.$Itemid;
				$html .= '" class="actionlink"">';
				$html .= $_MT_LANG->EDIT;
				$html .= '</a> ';
			}
		}

		# Delete?
		if ($show["delete"] <> false) {
			if ( $my->id == $link->user_id && $mtconf->get('user_allowdelete') == 1 && $my->id > 0 ) {
				$html .= '<a href="';
				$html .= sefRelToAbs('index.php?option=com_mtree&task=deletelisting&link_id='.$link->link_id.'&Itemid='.$Itemid);
				$html .= '" class="actionlink"">';
				$html .= $_MT_LANG->DELETE_LISTING;
				$html .= '</a> ';
			}
		}

		if ( $show["link"] <> false ) {
			$html .= '<a href="';

			if ( $visit ) {
				$html .= sefRelToAbs("index2.php?option=com_mtree&task=visit&link_id=".$link->link_id);
			} else {
				$html .= sefRelToAbs("index.php?option=com_mtree&task=viewlink&link_id=".$link->link_id."&Itemid=".$Itemid);
			}

			$html .= '"';
			
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
			$html .= '>';
			// if(strlen($link_name) > 55) {
			// 	$html .= substr($link_name,0,50);
			// 	$html .= '...';
			// } else {
				$html .= $link_name;
			// }
			$html .= '</a> ';
		
		} else {
			$html = $link_name.' ';
		}

		# New Link?
		if ($show["new"] <> false) {
			if ( (strtotime(date("Y-m-d H:i:s"))-strtotime($link->link_created)) < ($mtconf->get('link_new')*86400) ) {
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
			if ( ($this->datediff($link->link_created) > 0) && ($link->link_hits/$this->datediff($link->link_created)) >= $mtconf->get('link_popular') ) {
				$html .= '<sup class="popular">'.$_MT_LANG->LINK_POPULAR.'</sup> ';
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