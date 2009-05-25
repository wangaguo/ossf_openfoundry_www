<?php

/**
 * @version 1.0
 * @authorName Himangi Chhatre (Tekdi Eco Services pvt. ltd)
 * @authorEmail himangi.c@tekdi.net
 * @authorUrl http://www.tekdi.net
 * @copyright Copyright (C) Tekdi Eco Services pvt ltd. All rights reserved.
 * eventlist_cb.php 2nd November 2007 Himangi Chhatre
 */

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eventlistTab extends cbTabHandler {

	function eventlistTab() {
		$this->cbTabHandler();
	}

	function _getLanguageFile() {
		global $mainframe,$mosConfig_lang;
		$UElanguagePath=$mainframe->getCfg( 'absolute_path' ).'/components/com_comprofiler/plugin/user/plug_cbeventlistmyevents';
		if (file_exists($UElanguagePath.'/language/'.$mosConfig_lang.'.php')) {
		  include_once($UElanguagePath.'/language/'.$mosConfig_lang.'.php');
		} else include_once($UElanguagePath.'/language/english.php');
	}

	function getDisplayTab($tab,$user,$ui) {
		global $database,$my,$mainframe,$mosConfig_live_site;
		$this->_getLanguageFile();
		$return = null;
		$params = $this->params;
		
		$event_tab_message = $params->get('hwTabMessage', "");

			$mainframe->addCustomHeadTag("<link href=\"{$mosConfig_live_site}/components/com_comprofiler/plugin/user/plug_cbeventlistmyevents/eventlist_cb.css\" rel=\"stylesheet\" type=\"text/css\" />");
			if($tab->description == null) {
				$tabdescription = "Please enter a descritpion under community builder -> tab manager";
			}
			else{
				$tabdescription = $tab->description;
			}
			// html content is allowed in descriptions
//			$return .= "\t\t<div class=\"tab_Description\">". $tabdescription. "</div>\n";

			// get eventlist itemid
			$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_eventlist%' AND `type` = 'components' AND `published` = '1' LIMIT 1";
			$database->setQuery( $query );
			$S_Itemid = $database->loadResult();
			if(!$S_Itemid)
				$S_Itemid = 999999;

			$userid = mosGetParam($_GET,'user');
			if ($userid){
				$userid = $userid;
			}
			else {
				$userid = $my->id;
			}
			
			// get events
			$query = "SELECT e.id as eid, e.catsid, e.dates, e.enddates, e.title, e.created_by, u.email, u.username, u.id, c.id as catid , c.catname FROM #__eventlist_events AS e, #__users AS u, #__eventlist_categories AS c WHERE e.published != 0 AND u.id = e.created_by AND c.id = e.catsid AND u.id = $userid ORDER BY e.dates";
			$database->setQuery( $query );
			$results = $database->loadObjectList();
			// new entry
//			if ($my->id == $user->id) {
//				$url1 = "index.php?view=editevent&amp;option=com_eventlist&amp;Itemid={$S_Itemid}";
//				//$url1 = "index.php?option=com_eventlist&amp;Itemid={$S_Itemid}&amp;func=deliver";
//				$url1 = sefRelToAbs($url1);
//				$return .= "<a href='$url1' class='eventCBAddLink'>". _EVENTLIST_ADDNEW. "</a>";
//				//$query4 = "SELECT `published` FROM `#__eventlist_dates` WHERE `sendermail` = $user->email and `published` = 0";
//				$query4 = "SELECT `published` FROM `#__eventlist_events` WHERE `created` = $user->id and `published` = 1";
//				$database->setQuery( $query4 );
//				$results4 = $database->loadObjectList();
//				$sum = "0";
//				if(count($results4)) {
//					foreach($results4 as $result4) {
//						$sum = $sum + 1;
//					}
//				}
//				if ($sum > 0) {
//					$return .="<br><br>".$sum._EVENTLIST_PUB."<br>";
//                }
//			}
			//build top table - titles
			$return .= "\n\t<table  class='eventCBTabTable'>";
			$return .= "\n\t\t<tr class='sectiontableheader'>";
			$return .= "\n\t\t\t<th class='eventCBTabTableTitle'>";
			$return .= "\n\t\t\t\t" . _EVENT_TITLE;
			$return .= "\n\t\t\t</th>";
			$return .= "\n\t\t\t<th class='eventCBTabTableCat'>";
			$return .= "\n\t\t\t\t" . _EVENT_CATEGORY;
			$return .= "\n\t\t\t</th>";
			$return .= "\n\t\t\t<th class='eventCBTabTablestart'>";
			$return .= "\n\t\t\t\t" . _EVENT_START;
			$return .= "\n\t\t\t</th>";
			//$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";
			//$return .= "\n\t\t\t\t" . _EVENT_EXPIRE;
			//$return .= "\n\t\t\t</th>";
//			$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";
//			$return .= "\n\t\t\t\t" . _EVENT_REGISTER;
//			$return .= "\n\t\t\t</th>";
			
			$return .= "\n\t\t</tr>";

			$entryCount = 0;
			$cat = null;
			if(count($results)) {
				foreach($results as $result) {
					$entryCount++;
					
					$catHref = JRoute::_( 'workshop/categoryevents/'.$result->catid);
					//$catHref = "index.php?option=com_eventlist&amp;view=categoryevents&amp;id={$result->catid}";
//					$catHref = sefRelToAbs($catHref);
					//$cat = "\n\t\t\t<a href='{$catHref}' title='{$result->catname}'>{$result->catname}</a>";
					$cat = "\n\t\t\t<a href=\"".JRoute::_( 'workshop/categoryevents/'.$result->catid)."\" title='{$result->catname}'>{$result->catname}</a>";
						
					$CSSClass = $entryCount%2 ? "row0" : "row1";

					$return .= "\n\t\t<tr class='{$CSSClass}'>";

					$return .= "\n\t\t\t<td class='eventCBTabTableTitle'>";
					//$return .= "\n\t\t\t\t<a href=\"index.php?view=details&id={$result->eid}&option=com_eventlist&Itemid={$S_Itemid}\">{$result->title}</a>";
					$return .= "\n\t\t\t\t<a href=\"".JRoute::_( 'workshop/details/'.$result->eid)."\">{$result->title}</a>";
					$return .= "\n\t\t\t</td>";
					
					$return .= "\n\t\t\t<td class='eventCBTabTableCat'>";
					$return .= "\n\t\t\t\t{$cat}";
					$return .= "\n\t\t\t</td>";
					
					$return .= "\n\t\t\t<td class='eventCBTabTablestart'>";
					$return .= "\n\t\t\t\t{$result->dates}";
					$return .= "\n\t\t\t</td>";

//					$return .= "\n\t\t\t<td class='eventCBTabTableExp'>";
//					$return .= "\n\t\t\t\t{$result->enddates}";
//					$return .= "\n\t\t\t</td>";
					
				
//					$qry = "SELECT count(rdid) AS regs FROM #__eventlist_register WHERE rdid = $result->id";		
//					$database->setQuery($qry);
//					$reg = $database->loadObjectList();
//
//					$return .= "\n\t\t\t<td class='eventCBTabTableReg'>";
//					$return .= "\n\t\t\t\t{$reg[0]->regs}";
//					$return .= "\n\t\t\t</td>";

				}
				$return .= "\n\t\t</tr>";
			}
			else {
				// display no listings
				$return .= _EVENTLIST_NO_LISTING;
			}
			$return .="</table>";
			
			// generate output
		$return .= "\t\t<div>\n<p>". htmlspecialchars($event_tab_message). "</p></div>\n";
		return $return;
	} // end or getDisplayTab function
} // end of eventlistTab class
?>
