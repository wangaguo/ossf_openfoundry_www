<?php
/**
* Forum Tab Class for handling the CB tab api
* @version $Id: cb.fireboard.php 1 2007-18-04 23:24:59 iapostolov $
* @package Community Builder
* @subpackage cb.fireboard.php
* @author LucaZone.net
* @ Based on the Joomlaboard plugin by JoomlaJoe and Beat
* @copyright (C) LucaZone, www.lucazone.net
* @copyright (C) JoomlaJoe and Beat, www.joomlapolis.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global  $mosConfig_absolute_path, $mosConfig_lang;



class getForumfbTab extends cbTabHandler {
	var $com_name = null;
	var $config_filename = null;
	/**
	* Constructor
	*/
	function getForumfbTab() {
		global $mainframe;
		$this->cbTabHandler();
		if (file_exists( $mainframe->getCfg('absolute_path').'/administrator/components/com_fireboard/fireboard_config.php' )) {
			$this->com_name = 'com_fireboard';
			$this->config_filename = $mainframe->getCfg('absolute_path') . '/administrator/components/com_fireboard/fireboard_config.php';
		} 
	}
	/**
	* ForumTab Internal method: returns an unescaped string if magic_quotes_gpc is on, correcting a SB 1.1.0 double-escaping bug!
	* @access private
	* @param string to unescape
	* @return string unescaped if needed
	*/
	function _sbUnEscape($string) {
		return ((get_magic_quotes_gpc()==1) ? stripslashes($string) : $string);	// correcting a SB 1.1.0 double-escaping bug!
	}
	/**
	* ForumTab Internal method: returns an escaped string if magic_quotes_gpc is on, correcting a SB 1.1.0 double-escaping bug!
	* @access private
	* @param string to escape
	* @return string escaped if needed
	*/
	function _sbEscape($string) {
		return ((get_magic_quotes_gpc()==1) ? addslashes($string) : $string);	// correcting a SB 1.1.0 double-escaping bug!
	}
	/**
	* ForumTab Internal method: returns $sbUserDetails for the $user
	* @access private
	* @param array sbConfig
	* @param object user being displayed
	* @return object sbUserDetails
	*/
	function _getSBstats($fbConfig, $user) {
		global $database,$mosConfig_live_site,$acl,$my;
		if($fbConfig['showstats'] || (!$fbConfig['showranking'] && !$fbConfig['showkarma'] && !$fbConfig['postStats'])) {
			$database->setQuery("SELECT posts,karma,moderator,rank,gid FROM #__fb_users sb, #__users u where sb.userid=u.id AND sb.userid=" . (int) $user->id);
			$fbUserDetails=$database->loadObjectList();
			if(count($fbUserDetails)>0) $fbUserDetails=$fbUserDetails[0];
			if( (isset($fbUserDetails->posts)) and $fbUserDetails->posts != 0) {
				if($fbConfig['showranking']) {
					$uIsAdm="";
					$uIsMod="";
					if ( $fbUserDetails->gid > 0 ) {		//only get the groupname from the ACL if we're sure there is one
					$agrp=strtolower( $acl->get_group_name( $fbUserDetails->gid, 'ARO' ) );
					if(strtolower($agrp)=="administrator" || strtolower($agrp)=="superadministrator"|| strtolower($agrp)=="super administrator") $uIsAdm=1;
					}
					$params=$this->params;
		            $pathTemplate=$params->get('TemplateRank', '/template/default/images/english');
					$uIsMod=$fbUserDetails->moderator;
					$sbs=$mosConfig_live_site.'/components/'.$this->com_name.$pathTemplate;
					$numPosts=$fbUserDetails->posts;
					$rText="";
					$rImg="";
                    if ($fbUserDetails->rank != '0')
								{
												//special rank
												$database->setQuery("SELECT * FROM #__fb_ranks WHERE rank_id = '$fbUserDetails->rank'");
												$getRank = $database->loadObjectList();
												$rank=$getRank[0];
												$rText = $rank->rank_title;
												$rImg = $sbs.'/ranks/' . $rank->rank_image;
									}
									if ($fbUserDetails->rank == '0')
									{
											//post count rank
												$database->setQuery("SELECT * FROM #__fb_ranks WHERE ((rank_min <= $numPosts) AND (rank_special = 0))  ORDER BY rank_min DESC LIMIT 1");
												$getRank = $database->loadObjectList();
												$rank=$getRank[0];
												$rText = $rank->rank_title;
												$rImg = $sbs.'/ranks/' . $rank->rank_image;
									}

									if ($uIsMod)
									{
													$rText = _RANK_MODERATOR;
													$rImg = $sbs.'/ranks/' . 'rankmod.gif';
									}

									if ($uIsAdm)
									{
													$rText = _RANK_ADMINISTRATOR;
													$rImg = $sbs.'/ranks/' . 'rankadmin.gif';
									}

					if($fbConfig['rankimages']){$fbUserDetails->msg_userrankimg = '<img src="'.$rImg.'" alt="" />';}
					$fbUserDetails->msg_userrank = $rText;
				}
			} else $fbUserDetails = false;
		} else $fbUserDetails = false;
		return $fbUserDetails;
	}
	/**
	* ForumTab Internal method: returns html output of $sbUserDetails for the $user
	* @access private
	* @param array sbConfig
	* @param object user being displayed
	* @param object sbUserDetails
	* @return html code for tab
	*/
	function _getDisplaySBstats($fbConfig, $user, $params, $fbUserDetails) {
		$return="";
		$return .= "<div class=\"sectiontableheader\" style=\"text-align:left;padding-left:0px;padding-right:0px;width:50%;\">"._UE_FORUM_STATS."</div>";
		if ($fbUserDetails !== false) {
		$return .= "<table cellpadding=\"5\" cellspacing=\"0\" style=\"border:0;margin:0;padding:0;\" width=\"50%\">";
		if($fbConfig['showranking'] && ($params->get('statRanking', '1') == 1)) $return .= "<tr class=\"sectiontableentry1\"><td style=\"font-weight:bold;width:50%;\">".getLangDefinition($params->get('statRankingText', "_UE_FORUM_FORUMRANKING"))."</td><td>".$fbUserDetails->msg_userrank.($params->get('statRankingImg', '1')==1 ? $fbUserDetails->msg_userrankimg : "")."</td></tr>";
		if ($fbConfig['postStats'] && (($params->get('statPosts', '1')==2) || (($params->get('statPosts', '1')==1)&&($fbUserDetails !== false)))) {
			$return .= "<tr class=\"sectiontableentry2\"><td style=\"font-weight:bold;width:50%;\">"
					.getLangDefinition($params->get('statPostsText', "_UE_FORUM_TOTALPOSTS"))."</td><td>".$fbUserDetails->posts."</td></tr>";
		}
		if ($fbConfig['showkarma'] && ($fbUserDetails !== false) && (($params->get('statKarma', '1')==2)||(($params->get('statKarma', '1')==1)&&($fbUserDetails->karma!=0)))) {
			$return .= "<tr class=\"sectiontableentry1\"><td style=\"font-weight:bold;width:50%;\">"
					.getLangDefinition($params->get('statKarmaText', "_UE_FORUM_KARMA"))."</td><td>".$fbUserDetails->karma."</td></tr>";
		}
		$return .= "</table>";
		} else {
			$return = "";
		}
		return $return;
	}
	/**
	* ForumTab Internal method: sets User Status display according to $sbUserDetails for the $user
	* @access private
	* @param array sbConfig
	* @param object user being displayed
	* @param object sbUserDetails
	*/
	function _setStatusMenuSBstats($fbConfig, $user, &$params, $fbUserDetails) {
		if ($fbConfig['showranking'] && ($params->get('statRanking', '1') == 1) && ($fbUserDetails !== false)) {
			$mi = array(); $mi["_UE_MENU_STATUS"][$params->get('statRankingText', "_UE_FORUM_FORUMRANKING")]["_UE_FORUM_FORUMRANKING"]=null;
			$this->addMenu( array(	"position"	=> "menuList" ,		// "menuBar", "menuList"
								"arrayPos"	=> $mi ,
								"caption"	=> $fbUserDetails->msg_userrank.($params->get('statRankingImg', '1')==1 ? $fbUserDetails->msg_userrankimg : "") ,
								"url"		=> "" ,		// can also be "<a ....>" or "javascript:void(0)" or ""
								"target"	=> "" ,		// e.g. "_blank"
								"img"		=> null ,	// e.g. "<img src='plugins/user/myplugin/images/icon.gif' width='16' height='16' alt='' />"
								"alt"		=> null ,	// e.g. "text"
								"tooltip"	=> "") );
		}
		if ($fbConfig['postStats'] && (($params->get('statPosts', '1')==2) || (($params->get('statPosts', '1')==1)&&($fbUserDetails !== false)))) {
			$mi = array(); $mi["_UE_MENU_STATUS"][$params->get('statPostsText', "_UE_FORUM_TOTALPOSTS")]["_UE_FORUM_TOTALPOSTS"]=null;
			$this->addMenu( array(	"position"	=> "menuList" ,
								"arrayPos"	=> $mi ,
								"caption"	=> (($fbUserDetails !== false) ? $fbUserDetails->posts : "0") ,
								"url"		=> "" ,
								"target"	=> "" ,
								"img"		=> null ,
								"alt"		=> null ,
								"tooltip"	=> "") );
		}
		if ($fbConfig['showkarma'] && ($fbUserDetails !== false) && (($params->get('statKarma', '1')==2)||(($params->get('statKarma', '1')==1)&&($fbUserDetails->karma!=0)))) {
			$mi = array(); $mi["_UE_MENU_STATUS"][$params->get('statKarmaText', "_UE_FORUM_KARMA")]["_UE_FORUM_KARMA"]=null;
			$this->addMenu( array(	"position"	=> "menuList" ,
								"arrayPos"	=> $mi ,
								"caption"	=> $fbUserDetails->karma ,
								"url"		=> "" ,
								"target"	=> "" ,
								"img"		=> null ,
								"alt"		=> null ,
								"tooltip"	=> "") );
		}
	}
	/**
	* Generates the menu and user status to display on the user profile by calling back $this->addMenu
	* @param object tab reflecting the tab database entry
	* @param object mosUser reflecting the user being displayed
	* @param int 1 for front-end, 2 for back-end
	* @returns boolean : either true, or false if ErrorMSG generated
	*/
	function getMenuAndStatus($tab,$user,$ui) {
		global $fbConfig;
		$params=$this->params;
		$newslettersRegList=$params->get('statDisplay', '1');
		if ($newslettersRegList==1) {
			if($this->config_filename) {
				include_once ( $this->config_filename );
			} else {
				$this->_setErrorMSG(_UE_SBNOTINSTALLED);
				return false;
			}
			$fbUserDetails = $this->_getSBstats($fbConfig, $user);
			$this->_setStatusMenuSBstats($fbConfig, $user, $params, $fbUserDetails);
		}
		return true;
	}
	/**
	* Generates the HTML to display the user profile tab
	* @param object tab reflecting the tab database entry
	* @param object mosUser reflecting the user being displayed
	* @param int 1 for front-end, 2 for back-end
	* @returns mixed : either string HTML for tab content, or false if ErrorMSG generated
	*/
	function getDisplayTab($tab,$user,$ui) {
		global $database,$mosConfig_live_site,$acl,$my,$fbConfig;
		$return="";
		$searchForm="";
		if ($this->config_filename) {
			include_once ( $this->config_filename );
		} else {
			$return = _UE_SBNOTINSTALLED;
			return $return;
		}
		$database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=".$this->com_name."' AND published=1");
		$Itemid=$database->loadResult();

		if($tab->description != null) $return .= "\t\t<div class=\"tab_Description\">".unHtmlspecialchars(getLangDefinition($tab->description))."</div>\n";

		$params=$this->params;

		$newslettersRegList=$params->get('statDisplay', '1');
		$fbUserDetails = $this->_getSBstats($fbConfig, $user);
		if ($newslettersRegList==2) $return .= $this->_getDisplaySBstats($fbConfig, $user, $params, $fbUserDetails);

		if($my->id == $user->id && $fbConfig['allowsubscriptions']) {
	      $database->setQuery("SELECT thread FROM #__fb_subscriptions WHERE userid=" . (int) $my->id);
	      $subslist=$database->loadObjectList();
	      $csubslist=count($subslist);
		  $return .= "<div class=\"sectiontableheader\" style=\"text-align:left;padding-left:0px;padding-right:0px;margin:0px 0px 10px 0px;height:auto;width:100%;\">"._UE_USER_SUBSCRIPTIONS."";
		  $return .= "\n<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"margin:0px;padding:0px;width:100%;\">";
		  $enum=1;//reset value
		  $tabclass = array("sectiontableentry1", "sectiontableentry2");//alternating row CSS classes
		  $k=1; //value for alternating rows
		  if($csubslist >0){
		  	foreach($subslist as $subs) {	//get all message details for each subscription
			  	$database->setQuery("SELECT * FROM #__fb_messages WHERE id=$subs->thread");
			  	$subdet=$database->loadObjectList();
			  	foreach($subdet as $sub){
			  		$k=1-$k;
			  		$return .= "\n\t<tr class=\"".$tabclass[$k]."\">";
			  		$return .= "\n\t\t<td>".$enum.": <a href=\""
			  		.sefRelToAbs('index.php?option='.$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '').'&amp;func=view&amp;catid='.$sub->catid.'&amp;id='.$sub->id)
			  		.'">'.$this->_sbUnescape($sub->subject).'</a> - ' ._UE_GEN_BY. ' ' .$sub->name."</td>";
			  		$return .= "\n\t\t<td><a href=\""
			  		.sefRelToAbs('index.php?option='.$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '').'&amp;func=myprofile&amp;do=unsubscribeitem&amp;thread='.$subs->thread)
			  		.'">' ._UE_THREAD_UNSUBSCRIBE. "</a></td>";
			  		$return .= "\n\t</tr>";
			  		$enum++;
			  	}
		  	}
		  	$return .= "\n\t<tr>\n\t\t<td colspan=\"2\"><form action=\""
	      		.sefRelToAbs('index.php?option='.$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '').'&amp;func=userprofile&amp;do=update')
	      		.'" method="post" name="postform" id="postform">'
	      		.'<input type="hidden" name="do" value="update" />'
	      		//.'<input type="checkbox" onclick="if (document.forms[\'postform\'].elements[\'unsubscribeAll\'].checked=true && confirm(\''._UE_fb_CONFIRMUNSUBSCRIBEALL.'\')) { document.forms[\'postform\'].submit(\'Submit\')} else {document.forms[\'postform\'].elements[\'unsubscribeAll\'].checked=false};" name="unsubscribeAll" value="1" />'
	      		.'</form></td></tr>';
	      		//.'<i>'._UE_USER_UNSUBSCRIBE_ALL."</i></form></td>\n\t</tr>";
		  }
		  else{
		  	$return .= "\n\t<tr><td>"._UE_USER_NOSUBSCRIPTIONS."</td>\n\t</tr>";
		  }

		  $return .= "\n</table></div>";
		}

        if($my->id == $user->id && $fbConfig['allowfavorites']) {
	      $database->setQuery("SELECT thread FROM #__fb_favorites WHERE userid=" . (int) $my->id);
	      $subslistf=$database->loadObjectList();
	      $csubslistf=count($subslistf);
		  //$return .= "<div class=\"sectiontableheader\" style=\"text-align:left;padding-left:0px;padding-right:0px;margin:0px 0px 10px 0px;height:auto;width:100%;\">"._UE_USER_FAVS."";
		  $return .= "\n<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"margin:0px;padding:0px;width:100%;\">";
		  $enumf=1;//reset value
		  $tabclass = array("sectiontableentry1", "sectiontableentry2");//alternating row CSS classes
		  $k=1; //value for alternating rows
		  if($csubslistf >0){
		  	foreach($subslistf as $subsf) {	//get all message details for each subscription
			  	$database->setQuery("SELECT * FROM #__fb_messages WHERE id=$subsf->thread");
			  	$subdetf=$database->loadObjectList();
			  	foreach($subdetf as $subf){
			  		$k=1-$k;
			  		$return .= "\n\t<tr class=\"".$tabclass[$k]."\">";
			  		$return .= "\n\t\t<td>".$enumf.": <a href=\""
			  		.sefRelToAbs('index.php?option='.$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '').'&amp;func=view&amp;catid='.$subf->catid.'&amp;id='.$subf->id)
			  		.'">'.$this->_sbUnescape($subf->subject).'</a> - ' ._UE_GEN_BY. ' ' .$subf->name."</td>";
			  		$return .= "\n\t\t<td><a href=\""
			  		.sefRelToAbs('index.php?option='.$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '').'&amp;func=myprofile&amp;do=unfavoriteitem&amp;thread='.$subsf->thread)
			  		.'">'. "</a></td>";
			  		//.'">' ._UE_THREAD_UNFAV. "</a></td>";
			  		$return .= "\n\t</tr>";
			  		$enum++;
			  	}
		  	}
		  	$return .= "\n\t<tr>\n\t\t<td colspan=\"2\"><form action=\""
	      		.sefRelToAbs('index.php?option='.$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '').'&amp;func=userprofile&amp;do=update')
	      		.'" method="post" name="postform" id="postform">'
	      		.'<input type="hidden" name="do" value="update" />'
	      		//.'<input type="checkbox" onclick="if (document.forms[\'postform\'].elements[\'unfavoriteAll\'].checked=true && confirm(\''._UE_fb_CONFIRMUNFAVEALL.'\')) { document.forms[\'postform\'].submit(\'Submit\')} else {document.forms[\'postform\'].elements[\'unfavoriteAll\'].checked=false};" name="unfavoriteAll" value="1" />'
	      		.'<i>'."</i></form></td>\n\t</tr>";
	      		//.'<i>'._UE_USER_UNFAV_ALL."</i></form></td>\n\t</tr>";
		  }
		  else{
//		  	$return .= "\n\t<tr><td>"._UE_USER_NOFAV."</td>\n\t</tr>";
		  }

		  $return .= "\n</table></div>";
		}
		$postsNumber	= $params->get('postsNumber', '10');
		$pagingEnabled	= $params->get('pagingEnabled', 0);
		$searchEnabled	= $params->get('searchEnabled', 0);
		$pagingParams = $this->_getPaging(array(),array("fposts_"));
	
		//determine visitors allowable threads based on session
		$sql = "SELECT allowed FROM #__fb_sessions WHERE userid=" . (int) $my->id . " LIMIT 1";
		$database->setQuery($sql);
		//print $database->getQuery();
		$allowedCats=$database->loadResult();
		if($allowedCats==null) {
			//get only the publicly accessible forums..
		   $database->setQuery( "SELECT id FROM #__fb_categories WHERE published=1 AND pub_access=0");
		   $allowed_forums=$database->loadObjectList();
		   $i=0;
		   $allow_forum = array();
		   foreach ($allowed_forums as $af){
		      if (count ($allow_forum) == 0 ){
		         $allow_forum[0]=$af->id;
		      }
		      else {
		         $allow_forum[$i]=$af->id;
		         $i++;
		      }
		   }
		   $allowedCats=implode(",",$allow_forum); 
		}
		if(strtolower($allowedCats)=='na') $allowedCats=null;

		
		if ($pagingEnabled) {
			if (!$searchEnabled) $pagingParams["fposts_search"]=null;
			//Count for paging
	//		$query = "SELECT count(*) FROM #__fb_messages WHERE userid=".$user->id
	//				.($pagingParams["fposts_search"] ? " AND subject LIKE '%".cbEscapeSQLsearch($this->_sbEscape($pagingParams["fposts_search"]))."%'"
	//												 : "");
		$query="SELECT COUNT(*)"
		. "\n FROM #__fb_messages AS a, "
		. "\n #__fb_categories AS b, #__fb_messages AS c, #__fb_messages_text AS d" 
		. "\n WHERE a.catid = b.id"
		. "\n AND a.thread = c.id"
		. "\n AND a.id = d.mesid"
		. "\n AND a.hold = 0 AND b.published = 1"
		. "\n AND a.userid=" . (int) $user->id
		. ($allowedCats!=null ? "\n AND b.id IN ($allowedCats)" :"")
		. ($pagingParams["fposts_search"]	?  "\n AND (a.subject LIKE '%".cbEscapeSQLsearch($this->_sbEscape($pagingParams["fposts_search"]))."%'" 
												  ." OR d.message LIKE '%".cbEscapeSQLsearch($pagingParams["fposts_search"])."%')"
											: "");
			$database->setQuery($query);
			$total = $database->loadResult();
			if (!is_numeric($total)) $total = 0;
			$userHasPosts = ($total>0 || ($pagingParams["fposts_search"] && ($fbUserDetails !== false) && $fbUserDetails->posts>0));

			if ($pagingParams["fposts_limitstart"] === null) $pagingParams["fposts_limitstart"] = "0";
			if ($postsNumber > $total) $pagingParams["fposts_limitstart"] = "0";
			
			if ($searchEnabled) {
				$searchForm = $this->_writeSearchBox($pagingParams,"fposts_",$divClass="style=\"float:right;\"",$inputClass="class=\"inputbox\"");
			} else {
				$pagingParams["fposts_search"] = "0";
			}
			
		} else {
			$pagingParams["fposts_limitstart"] = "0";
			$pagingParams["fposts_search"] = "0";
		}
		switch ($pagingParams["fposts_sortby"]) {
			case "subject":
				$order = "a.subject ASC, a.time DESC";
				break;
			case "category":
				$order = "b.id ASC, a.time DESC";
				break;
			case "hits":
				$order = "c.hits DESC, a.time DESC";
				break;
			case "date":
			default:
				$order = "a.time DESC";
				break;
		}
		$query="SELECT a.* , b.id as category, b.name as catname, c.hits AS 'threadhits'"
		. "\n FROM #__fb_messages AS a, "
		. "\n #__fb_categories AS b, #__fb_messages AS c, #__fb_messages_text AS d" 
		. "\n WHERE a.catid = b.id"
		. "\n AND a.thread = c.id"
		. "\n AND a.id = d.mesid"
		. "\n AND a.hold = 0 AND b.published = 1"
		. "\n AND a.userid=" . (int) $user->id
		. ($allowedCats!=null ? "\n AND b.id IN ($allowedCats)" :"")		
		. ($pagingParams["fposts_search"]	?  "\n AND (a.subject LIKE '%".cbEscapeSQLsearch($this->_sbEscape($pagingParams["fposts_search"]))."%'" 
												  ." OR d.message LIKE '%".cbEscapeSQLsearch($pagingParams["fposts_search"])."%')"
											: "")
		. "\n ORDER  BY ".$order
		. "\n LIMIT ".($pagingParams["fposts_limitstart"]?$pagingParams["fposts_limitstart"]:"0").",".$postsNumber;
		$database->setQuery( $query );
		//print $database->getQuery();

		$items = $database->loadObjectList();
		if(count($items) >0) {
			if ($pagingParams["fposts_search"]) $title = sprintf(_UE_FORUM_FOUNDPOSTS,$total);
			elseif ($pagingEnabled) $title = sprintf(_UE_FORUM_POSTS,$postsNumber);
			else $title = sprintf(_UE_FORUM_LASTPOSTS,$postsNumber);
			$return .= "<div style=\"text-align:left;padding-left:0px;padding-right:0px;margin:0px 0px 10px 0px;height:auto;width:100%;\">";
			$return .= $title;
			if ($pagingEnabled && $searchEnabled) $return .= $searchForm . "<div style=\"clear:both;\">&nbsp;</div>";
			$return .= "\n<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\" style=\"margin:0px;padding:0px;width:100%;\">";
			$return .= "\n\t<tr class=\"sectiontableheader\">";
			$return .= "<th>".$this->_writeSortByLink($pagingParams,"fposts_","date",_UE_FORUMDATE,true)."</th>";
			$return .= "<th>".$this->_writeSortByLink($pagingParams,"fposts_","subject",_UE_FORUMSUBJECT)."</th>";
			$return .= "<th>".$this->_writeSortByLink($pagingParams,"fposts_","category",_UE_FORUMCATEGORY)."</th>";
			$return .= "<th>".$this->_writeSortByLink($pagingParams,"fposts_","hits",_UE_FORUMHITS)."</th>";
			$return .= "</tr>";
			$i=2;
			foreach($items AS $item) {
				$i= ($i==1) ? 2 : 1;
				if(!ISSET($item->created)) $item->created="";
				$sbURL=sefRelToAbs("index.php?option=".$this->com_name.($Itemid ? '&amp;Itemid='.$Itemid : '')."&amp;func=view&amp;catid=".$item->catid."&amp;id=".$item->id."#".$item->id);
				$return .= "\n\t<tr class=\"sectiontableentry$i\"><td>".getFieldValue("date",date("Y-m-d, H:i:s",$item->time))."</td><td><b><a href=\"".$sbURL."\">".$this->_sbUnescape($item->subject)."</b></a></td><td>".$item->catname."</td><td>".$item->threadhits."</td></tr>\n";
			}
			$return .= "\n</table></div>";
			if ($pagingEnabled && ($postsNumber < $total)) {
				$return .= "<div style='width:95%;text-align:center;'>"
				.$this->_writePaging($pagingParams,"fposts_",$postsNumber,$total)
				."</div>";
			}
			$return .= "";
		} else {
			if ($pagingEnabled && $userHasPosts && $searchEnabled && $pagingParams["fposts_search"]) {
				 $return .= "<div class=\"sectiontableheader\" style=\"text-align:left;padding-left:0px;padding-right:0px;margin:0px;height:auto;width:100%;\">";
				 $return .= $searchForm;
				 $return .= ""._UE_NOFORUMPOSTSFOUND;
				 $return .= "</div>";
			} else {
				$return .= _UE_NOFORUMPOSTS;
			}
		}
		return $return;
	}
}	// end class getForumTab.
?>
