<?php

if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }



class eventlistTab extends cbTabHandler {



	function eventlistTab() {

		$this->cbTabHandler();

	}



	function _getLanguageFile() {

		global $mainframe,$mosConfig_lang;

		$UElanguagePath=JPATH_SITE.'/components/com_comprofiler/plugin/user/plug_cbeventlistmyevents';

		if (file_exists($UElanguagePath.'/language/'.$mosConfig_lang.'.php')) {

		  include_once($UElanguagePath.'/language/'.$mosConfig_lang.'.php');

		} else include_once($UElanguagePath.'/language/english.php');

	}

	

	function deleteRecord(){

		global $_CB_database;

		foreach($_POST as $delete_id){

			$query = "DELETE FROM #__eventlist_events where id=".$delete_id;

			$_CB_database->setQuery( $query );

		}			

	}



	function getDisplayTab($tab,$user,$ui) {

	

		global $_CB_database,$my,$mainframe,$mosConfig_live_site , $Itemid ;

		$this->_getLanguageFile();

		$live_site = JURI::base();

		//$user		=& JFactory::getUser();	

		$return = null;

		//echo $user->id;

		$params = $this->params;		

		$event_tab_message = $params->get('hwTabMessage', "");	

		$end_date = $params->get('end_date' );

		$start_date = $params->get('start_date');

		$result_title=null;

		//$return .= JURI::base() ;

				

		echo "<link rel=\"stylesheet\" href=\"media/system/css/modal.css\" type=\"text/css\" />  

		<script type=\"text/javascript\" src=\"includes/js/joomla.javascript.js\"></script>";

  		/*<script type=\"text/javascript\" src=\"media/system/js/mootools-uncompressed.js\"></script>

  		<script type=\"text/javascript\" src=\"media/system/js/modal.js\"></script>

  		<script type=\"text/javascript\" defer='defer'>

		

		window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });

		window.addEvent('domready', function() {

			SqueezeBox.initialize({});

			$$('a.modal').each(function(el) {

				el.addEvent('click', function(e) {

					new Event(e).stop();

					SqueezeBox.fromElement(el);

				});

			});

		});

  		</script>"; */

		

		$base_url = $this->_getAbsURLwithParam(array());		

			//echo JURI::base() ;

			//echo "<br>" . JPATH_SITE;

			//echo "<br>" . admin: $mainframe->getSiteURL();

			$mainframe->addCustomHeadTag("<link href=\"{$mosConfig_live_site}/components/com_comprofiler/plugin/user/plug_cbeventlistmyevents/eventlist_cb.css\" rel=\"stylesheet\" type=\"text/css\" />");

			if($tab->description == null) {

				$tabdescription = "Please enter a descritpion under community builder -> tab manager";

			}

			else{

				$tabdescription = $tab->description;

			}

			// html content is allowed in descriptions

			//$return .= "\t\t<div class=\"tab_Description\">". $tabdescription. "</div>\n";

			

			//get param for thumbnail

			$query = "SELECT gddisabled FROM #__eventlist_settings";

			$_CB_database->setQuery( $query );

			$thumb= $_CB_database->loadResult();

			

			// get selected array of ids for deletion .

/*

			if($_POST['cid']){

			$ids=$_POST['cid'];	

			if($ids){

			foreach($ids as $id){

			echo 'deleting...'.$id;

				$query = "DELETE FROM #__eventlist_events where id=".$id;				

				$_CB_database->setQuery( $query );

				$_CB_database->query();

			} // end foreach

			}// end if

			}//end if

	*/					

			// get eventlist itemid

			$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_eventlist%' AND `type` = 'component' AND `published` = '1' LIMIT 1";

			$_CB_database->setQuery( $query );

			$S_Itemid1= $_CB_database->loadResult();

			

			if(!$S_Itemid1)

				$S_Itemid1 = 999999;

			$userid = $user->get('id');



			// get events

			$query = "SELECT e.id, e.catsid, e.dates, e.enddates,e.created_by, e.title , e.datimage , u.email, u.username , u.gid , u.id AS userid, c.id AS catid, c.catname FROM #__eventlist_events AS e, #__users AS u, #__eventlist_categories AS c WHERE e.published = 1 AND c.id = e.catsid AND u.id = $user->id AND e.created_by = $user->id ORDER BY e.dates";

			$_CB_database->setQuery( $query );

			$results = $_CB_database->loadObjectList();	

			

			// if loop for checking published events

			if($results){ 

			$user_type=$results[0]->gid ;

			if ($userid == $user->id) {	

				$url = "index.php?option=com_eventlist&view=editevent" ;

				$url1 = JRoute::_($url);		

				$query4 = "SELECT `published` FROM `#__eventlist_events` WHERE `created_by` = id and `published` = 0 " ;

				$_CB_database->setQuery( $query4 );

				$results4 = $_CB_database->loadObjectList();



				$sum = "0";

				if(count($results4)) {

					foreach($results4 as $result4) {

						$sum = $sum + 1;					

					}

				}

				if ($sum > 0) {

					$return .="<br><br>".$sum._EVENTLIST_PUB."<br>";

				}

			} 

			$return .= "\n\t<form method=\"post\" name=\"evenlistForm\">";

			

			$return .= "\n\t<table  class='eventCBTabTable' width=100% >";

			$return .= "\n\t\t<tr><td colspan='7'></td></tr>";	

			$return .= "\n\t\t<tr style=\"border-bottom:solid 1px #ccc;\" class='sectiontableheader' >";

			//$return .= "\n\t\t\t<th class='eventCBTabTableTitle'>";

			//$return .= "\n\t\t\t\t" . _EVENT_IMAGE;	

			//$return .= "\n\t\t\t</th>";

					

			$return .= "\n\t\t\t<th class='eventCBTabTableTitle'>";

			$return .= "\n\t\t\t\t" . _EVENT_TITLE;

			$return .= "\n\t\t\t</th>";

			

			$return .= "\n\t\t\t<th class='eventCBTabTableCat'>";

			$return .= "\n\t\t\t\t" . _EVENT_CATEGORY;

			$return .= "\n\t\t\t</th>";



			if($start_date==1){

			$return .= "\n\t\t\t<th class='eventCBTabTablestart'>";

			$return .= "\n\t\t\t\t" . _EVENT_START;

			$return .= "\n\t\t\t</th>";

			}

			

			//if($end_date==1){

			//$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";

			//$return .= "\n\t\t\t\t" . _EVENT_EXPIRE;

			//$return .= "\n\t\t\t</th>";

			//}

			

			//$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";

			//$return .= "\n\t\t\t\t" . _EVENT_REGISTER;

			//$return .= "\n\t\t\t</th>";

			$count=count($results);	

			if($count!=0){



			//echo $user_type;

								

			$return .= "\n\t\t</tr>";

			$return .= "\n\t\t<tr><td colspan='7'><hr width='100%' /></td></tr>";	

			}	

        

			$entryCount = 0;

			$cat = null;

			if(count($results)) {

				//foreach($results as $result) {

			//$k = 0;

			    for ($i=0, $n=count( $results ); $i < $n; $i++){									

					$entryCount++;

					$result = $results[$i];

					$checked 	= JHTML::_('grid.id',   $i, $result->id );

					$catHref = "index.php?option=com_eventlist&amp;func=shcatev1&amp;categid={$result->catid}&amp;Itemid={$S_Itemid1}";

					$cat = "\n\t\t\t<a href='{$catHref}' title='{$result->catname}'>{$result->catname}</a>";						

					$CSSClass = $entryCount%2 ? "row0" : "row1";					

					$return .= "\n\t\t<tr class='{$CSSClass}'>";						

								

					//$return .= "\n\t\t\t<td class='eventCBTabTableCat'>";										

					$live_site = str_replace("/administrator/", "/", $live_site);
	
					$live_site1 =  "images/eventlist/events/small/" . $result->datimage ;
					
					$live_site2 =  "images/eventlist/events/" . $result->datimage ;

					$size = getimagesize($live_site2);

					$img_height=$size[0]+10;

					$img_width=$size[1]+10;

					$url = "index.php?view=details&id={$result->id}%3A$result_title&option=com_eventlist&Itemid=$S_Itemid1" ;

					$url1 = JRoute::_($url);

					/*$return .= "\n\t\t\t\t<a class=\"modal\" rel=\"{handler: 'iframe', size: {x: $img_height, y: $img_width}}\" href=$live_site2 ><img src=\"$live_site1\"></a>";*/

					//$return .= "\n\t\t\t\t<a class=\"eventCBAddLink\" href=\"$url1\" ><img src=\"$live_site1\" width=\"50%\"></a>";

					//$return .= "\n\t\t\t</td>";						

								

					$return .= "\n\t\t\t<td class='eventCBTabTableTitle'>";

					$result_titles=explode(" " , $result->title);

					$result_title=implode("-" , $result_titles);					
					$url = "index.php?view=details&id={$result->id}%3A$result_title&option=com_eventlist&Itemid=$S_Itemid1" ;

					$url1 = JRoute::_($url);

					$return .= "\n\t\t\t\t<a href=\"$url1\" class='eventCBAddLink'>{$result->title}</a>";

					$return .= "\n\t\t\t</td>";			

					

					

					$return .= "\n\t\t\t<td class='eventCBTabTableCat'>";

					$return .= "\n\t\t\t\t{$cat}";

					$return .= "\n\t\t\t</td>";

					

					if($start_date==1){

					$return .= "\n\t\t\t<td class='eventCBTabTablestart'>";

					$return .= "\n\t\t\t\t{$result->dates}";

					$return .= "\n\t\t\t</td>";

					}



					if($end_date==1){

					$return .= "\n\t\t\t<td class='eventCBTabTableExp'>";

					$return .= "\n\t\t\t\t{$result->enddates}";

					$return .= "\n\t\t\t</td>";

					}	

					

					$qry = "SELECT count(uid) AS regs FROM #__eventlist_register where `event`=$result->id";		

					$_CB_database->setQuery($qry);

					$reg = $_CB_database->loadObjectList();					

					//$return .= "\n\t\t\t<td class='eventCBTabTableReg'>";

					//$return .= "\n\t\t\t\t{$reg[0]->regs}";

					//$return .= "\n\t\t\t</td>";						

					

					$return .= "\n\t\t</tr>";

					$return .= "\n\t\t<tr><td colspan='7' style='border-bottom:1px dashed #cccccc;'></td></tr>";	

				}



				

			}

			else {

				// display no listings

				$return .= _EVENTLIST_NO_LISTING;

			}

			$return .="</table>";

			$return .="</form>";

			

			// generate output

		$return .= "\t\t<div>\n<p>". htmlspecialchars($event_tab_message). "</p></div>\n";

		return $return;

		} // end of if loop for checking published events

		

		

	} // end or getDisplayTab function



	function getEditTab($tab,$user,$ui) {

			global $_CB_database,$my,$mainframe,$mosConfig_live_site , $Itemid ;

			$adminurl = strstr($_SERVER['REQUEST_URI'], 'index');

			if ($adminurl != 'index2.php') {

	

				$this->_getLanguageFile();

				$live_site = JURI::base();

				$user		=& JFactory::getUser();	

				$return = null;

				$params = $this->params;		

				$event_tab_message = $params->get('hwTabMessage', "");	

				$end_date = $params->get('end_date' );

				$start_date = $params->get('start_date');

				//$return .= JURI::base() ;

						$result_title=null;

						

				echo "<link rel=\"stylesheet\" href=\"media/system/css/modal.css\" type=\"text/css\" /> 

				<script type=\"text/javascript\" src=\"includes/js/joomla.javascript.js\"></script>"; 

				

				/*<script type=\"text/javascript\" src=\"media/system/js/mootools-uncompressed.js\"></script>

				<script type=\"text/javascript\" src=\"media/system/js/modal.js\"></script>

				<script type=\"text/javascript\" defer='defer'>

				

				window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });

				window.addEvent('domready', function() {

					SqueezeBox.initialize({});

					$$('a.modal').each(function(el) {

						el.addEvent('click', function(e) {

							new Event(e).stop();

							SqueezeBox.fromElement(el);

						});

					});

				});

				</script>";*/

				

				$base_url = $this->_getAbsURLwithParam(array());		

					//echo JURI::base() ;

					//echo "<br>" . JPATH_SITE;

					//echo "<br>" . admin: $mainframe->getSiteURL();

					$mainframe->addCustomHeadTag("<link href=\"{$mosConfig_live_site}/components/com_comprofiler/plugin/user/plug_cbeventlistmyevents/eventlist_cb.css\" rel=\"stylesheet\" type=\"text/css\" />");

					if($tab->description == null) {

						$tabdescription = "Please enter a descritpion under community builder -> tab manager";

					}

					else{

						$tabdescription = $tab->description;

					}

					// html content is allowed in descriptions

					//$return .= "\t\t<div class=\"tab_Description\">". $tabdescription. "</div>\n";

					

					//get param for thumbnail

					$query = "SELECT gddisabled FROM #__eventlist_settings";

					$_CB_database->setQuery( $query );

					$thumb= $_CB_database->loadResult();

					

					// get selected array of ids for deletion .

		/*

					if($_POST['cid']){

					$ids=$_POST['cid'];	

					print_r($ids);

					foreach($ids as $id){

						$query = "DELETE FROM #__eventlist_events where id=".$id;				

						$_CB_database->setQuery( $query );

						$_CB_database->query();

					}}

		*/						

					// get eventlist itemid

					$query = "SELECT `id` FROM `#__menu` WHERE `link` LIKE '%index.php?option=com_eventlist%' AND `type` = 'component' AND `published` = '1' LIMIT 1";

					$_CB_database->setQuery( $query );

					$S_Itemid1= $_CB_database->loadResult();

					

					if(!$S_Itemid1)

						$S_Itemid1 = 999999;

					$userid = $user->get('id');

					

					// get events

					$query = "SELECT e.id, e.catsid, e.dates, e.enddates,e.created_by, e.title , e.datimage , u.email, u.username , u.gid , u.id AS userid, c.id AS catid, c.catname FROM #__eventlist_events AS e, #__users AS u, #__eventlist_categories AS c WHERE e.published = 1 AND c.id = e.catsid AND u.id = $user->id AND e.created_by = $user->id ORDER BY e.dates";

					$_CB_database->setQuery( $query );

					$results = $_CB_database->loadObjectList();	

					

					// if loop for checking published events

		

					$user_type=$results[0]->gid ;

					if ($userid == $user->id) {	

						$url = "index.php?option=com_eventlist&view=editevent" ;

						$url1 = JRoute::_($url);

						$return .= "<a href='$url1' class='eventCBAddLink'>". _EVENTLIST_ADDNEW. "</a>";

						$query4 = "SELECT `published` FROM `#__eventlist_events` WHERE `created_by` = $userid and `published` = 0 " ;

						$_CB_database->setQuery( $query4 );

						$results4 = $_CB_database->loadObjectList();

		

						$sum = "0";

						if(count($results4)) {

							foreach($results4 as $result4) {

								$sum = $sum + 1;					

							}

						}

						if ($sum > 0) {

							$return .="<br><br>".$sum._EVENTLIST_PUB."<br>";

						}

					}

					if($results){  

					$return .= "\n\t<form method=\"post\" name=\"evenlistForm\">";

			//		$return .="<div style=\"float:right;\"><input type='submit' value='Delete' /></div><br />";

			//		$return .= "\n\t\t\t\t<input  type=\"hidden\" name = \"boxchecked\" value=\"\"/>";

					$return .= "\n\t<table  class='eventCBTabTable' width=100% >";

					$return .= "\n\t\t<tr><td colspan='7'><hr size=1 width='100%' /></td></tr>";	

					$return .= "\n\t\t<tr style=\"border-bottom:solid 1px #ccc;\" class='sectiontableheader' >";

					//$return .= "\n\t\t\t<th class='eventCBTabTableTitle'>";

					//$return .= "\n\t\t\t\t" . _EVENT_IMAGE;	

					//$return .= "\n\t\t\t</th>";

							

					$return .= "\n\t\t\t<th class='eventCBTabTableTitle'>";

					$return .= "\n\t\t\t\t" . _EVENT_TITLE;

					$return .= "\n\t\t\t</th>";

					

					$return .= "\n\t\t\t<th class='eventCBTabTableCat'>";

					$return .= "\n\t\t\t\t" . _EVENT_CATEGORY;

					$return .= "\n\t\t\t</th>";

		

					if($start_date==1){

					$return .= "\n\t\t\t<th class='eventCBTabTablestart'>";

					$return .= "\n\t\t\t\t" . _EVENT_START;

					$return .= "\n\t\t\t</th>";

					}

					

					if($end_date==1){

					$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";

					$return .= "\n\t\t\t\t" . _EVENT_EXPIRE;

					$return .= "\n\t\t\t</th>";

					}

					

					$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";

					$return .= "\n\t\t\t\t" . _EVENT_REGISTER;

					$return .= "\n\t\t\t</th>";

					$count=count($results);	

					if($count!=0){

		

					//echo $user_type;

					$id=$results[0]->id;

					$return .= "\n\t\t\t<th class='eventCBTabTableExp'>";

				//	$return .= "\n\t\t\t\t<input name = \"toggle\" type=\"checkbox\" onclick=\"checkAll($count)\" value=\"\"/>";

					$return .= "\n\t\t\t</th>";

											

					$return .= "\n\t\t</tr>";

					$return .= "\n\t\t<tr><td colspan='7'></td></tr>";	

					}	

				

					$entryCount = 0;

					$cat = null;

					if(count($results)) {

						//foreach($results as $result) {

					//$k = 0;

						for ($i=0, $n=count( $results ); $i < $n; $i++){									

							$entryCount++;

							$result = $results[$i];

							//$checked 	= JHTML::_('grid.id',   $i, $result->id );

							$checked ='';

							$catHref = "index.php?option=com_eventlist&amp;func=shcatev1&amp;categid={$result->catid}&amp;Itemid={$S_Itemid1}";

							$cat = "\n\t\t\t<a href='{$catHref}' title='{$result->catname}'>{$result->catname}</a>";						

							$CSSClass = $entryCount%2 ? "row0" : "row1";					

							$return .= "\n\t\t<tr class='{$CSSClass}'>";						

										

							$return .= "\n\t\t\t<td class='eventCBTabTableCat'>";										

							$live_site = str_replace("/administrator/", "/", $live_site);

							$live_site1 = $live_site . "images/eventlist/events/small/" . $result->datimage ;

							$live_site2 = $live_site . "images/eventlist/events/" . $result->datimage ;

							$size = getimagesize($live_site2);

							$img_height=$size[0]+10;

							$img_width=$size[1]+10;

							$url = "index.php?view=details&id={$result->id}%3A$result_title&option=com_eventlist&Itemid=$S_Itemid1" ;

							$url1 = JRoute::_($url);

							//$return .= "\n\t\t\t\t<a class=\"modal\" rel=\"{handler: 'iframe', size: {x: $img_height, y: $img_width}}\" href=$live_site2 ><img src=\"$live_site1\"></a>";

						//	$return .= "\n\t\t\t\t<a class=\"eventCBAddLink\" href=\"$url1\" ><img src=\"$live_site1\" width=\"50%\"></a>";

							$return .= "\n\t\t\t</td>";						

										

							$return .= "\n\t\t\t<td class='eventCBTabTableTitle'>";

							$result_titles=explode(" " , $result->title);

							$result_title=implode("-" , $result_titles);					

							$url = "index.php?view=details&id={$result->id}%3A$result_title&option=com_eventlist&Itemid=$S_Itemid1" ;

							$url1 = JRoute::_($url);

							$return .= "\n\t\t\t\t<a href=\"$url1\" class='eventCBAddLink'>{$result->title}</a>";

							$return .= "\n\t\t\t</td>";			

							

							

							$return .= "\n\t\t\t<td class='eventCBTabTableCat'>";

							$return .= "\n\t\t\t\t{$cat}";

							$return .= "\n\t\t\t</td>";

							

							if($start_date==1){

							$return .= "\n\t\t\t<td class='eventCBTabTablestart'>";

							$return .= "\n\t\t\t\t{$result->dates}";

							$return .= "\n\t\t\t</td>";

							}

		

							if($end_date==1){

							$return .= "\n\t\t\t<td class='eventCBTabTableExp'>";

							$return .= "\n\t\t\t\t{$result->enddates}";

							$return .= "\n\t\t\t</td>";

							}	

							

							$qry = "SELECT count(uid) AS regs FROM #__eventlist_register where `event`=$result->id";		

							$_CB_database->setQuery($qry);

							$reg = $_CB_database->loadObjectList();					

							$return .= "\n\t\t\t<td class='eventCBTabTableReg'>";

							$return .= "\n\t\t\t\t{$reg[0]->regs}";

							$return .= "\n\t\t\t</td>";							

		

							$return .= "\n\t\t\t<td class='eventCBTabTableExp'>";

							$return .= "\n\t\t\t\t {$checked}";

							$return .= "\n\t\t\t</td>";									

							

							$return .= "\n\t\t</tr>";

							$return .= "\n\t\t<tr><td colspan='7'></td></tr>";	

						}

		

						

					}

					else {

						// display no listings

						$return .= _EVENTLIST_NO_LISTING;

					}

					$return .="</table>";

					$return .="</form>";

					

					// generate output

				$return .= "\t\t<div>\n<p>". htmlspecialchars($event_tab_message). "</p></div>\n";

				

				} // end of if loop for checking published events

				else{

					$url = "index.php?option=com_eventlist&view=editevent" ;

					$url1 = JRoute::_($url);

					$return .= "There are no events to display ";		

					//$return .= "\n\t\t\t<a href='$url1' class='eventCBAddLink'>". _EVENTLIST_ADDNEW. "</a>";

				}

				return $return;

			} // loop for displaying edit tab only if it's being accessed from frontend.

	

	}	// end getEditTab function

	

		

} // end of eventlistTab class

?>

