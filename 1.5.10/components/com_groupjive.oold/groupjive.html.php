<?php
/**
* @version $Id: groupjive.html.php,v 1.5 2005/05/25
* @package Joomla!
* @subpackage GroupJive
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @Joomla! is Free Software
* @author Joshua Holmes
* @further developed by Anna Tannenberg, John Bultena, Michael Perthel, David Freund, Mark Raborn and Project GroupJive.
*/


/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!defined('GJBASEPATH')) define( 'GJBASEPATH', dirname(__FILE__) );
if (!defined('JPATH')) define ('JPATH', $mainframe->getCfg('absolute_path'));

// Modules Workaround
if (file_exists(JPATH.'/includes/HTML_toolbar.php')) {
	require_once( JPATH.'/includes/HTML_toolbar.php' );
}

class HTML_wg
{
  /**
	* Static method to create the template object
	* @return patTemplate
	*/
	function &createTemplate($template=null) {
		global $option;
		if (file_exists(JPATH.'/includes/patTemplate/patTemplate.php')) {
			require_once( JPATH.'/includes/patTemplate/patTemplate.php' );
		}
		if (file_exists(JPATH.'/plugins/system/legacy/patfactory.php')) {
			require_once( JPATH.'/plugins/system/legacy/patfactory.php' );
		}

		$tmpl =& patFactory::createTemplate( $option, true, false );
		
		if (file_exists(GJBASEPATH . '/templates/'.TEMPLATE. '/'.$template)) {
			$tmpl->setRoot( GJBASEPATH . '/templates/'.TEMPLATE );
		} else {
			$tmpl->setRoot( GJBASEPATH . '/templates/default' );
		}
		$tmpl->readTemplatesFromInput($template);
		return $tmpl;
	}  // ---- end &createTemplate -----------------------------------------------
	
	
	function newgroup($rows,$gj_groupname="",$gj_aboutgroup="",$message="")	{
		global $my,$mainframe,$mosConfig_editor, $Itemid;
		
		// create the Javascript output
	$tmpl =& HTML_wg::createTemplate('script.tmpl');
    
    // data for javascript
    foreach( $rows as $val ) {
      $typeCat .= "typeCat[".$val->id."] = new Array();\n";
      $typeCat .= "typeCat[".$val->id."][0]=". $val->create_open . ";\n";
      $typeCat .= "typeCat[".$val->id."][1]=". $val->create_closed . ";\n";
      $typeCat .= "typeCat[".$val->id."][2]=". $val->create_invite . ";\n";
    }
    
    $tmpl->addVar( 'javascript', 'GJ_TYPECAT', $typeCat);
    // put the javascript into the head-section
    $mainframe->addCustomHeadTag($tmpl->getParsedTemplate('javascript'));
    // --\ end creating javascript
    		
		// create the HTML output
		$tmpl =& HTML_wg::createTemplate('newgroup.tmpl');

    $tmpl->addVar( 'newgroup', 'GJ_MESSAGE', $message );
    $tmpl->addVar( 'newgroup', 'GJ_GROUPNAME', $gj_groupname);
    $tmpl->addVar( 'newgroup', 'GJ_DESCR', $row->descr);
    
	  if( !isset( $_POST['category'] ) ) {
		  $_POST['category'] = $row[0]->id;
	  }

		foreach( $rows as $row ) {
			$selected = "";
			if( $_POST['category'] == $row->id ) {
				$selected = "selected";
			}
			$options_cat .= "<option $selected value=".$row->id.">".$row->catname."</option>";
		}
		$tmpl->addVar( 'newgroup', 'GJ_OPTIONS_CAT', $options_cat);
		
    $ind = 0;
		$desc = array( GJ_OPEN, GJ_APREQUIRED, GJ_PRIVATE );
		$field = array("create_open", "create_closed", "create_invite");

		foreach( $rows as $key => $row ) {
			if( $row->id == $_POST['category'] ) {
				$ind = $key;
				break;
			}
		}

		for( $i = 0; $i < 3; $i++ ) {
			$f = $field[$i];
			$o = $rows[$ind];

			if( $o->$f ) {
				$selected = "";
				if( $_POST['type'] == ($i+1) ) {
					$selected = "selected";
				}
				$options_type.= "<option $selected value='" . ($i+1) . "'>{$desc[$i]}</option>";
			}
		}
	$mainframe->appendPathWay(GJ_CREATEGROUP_PATH);
    $tmpl->addVar( 'newgroup', 'GJ_OPTIONS_TYPE', $options_type);
    $tmpl->addVar( 'newgroup', 'GJ_HIDDEN_I', $row->id);
    $tmpl->addVar( 'newgroup', 'ITEMID', $Itemid);
    $tmpl->displayParsedTemplate( 'newgroup' );
	}


	function groupcreated($NeedApproval) {
    $tmpl =& HTML_wg::createTemplate('showmenu.tmpl');
   
    if ($NeedApproval==1) {
      $tmpl->addVar( 'groupcreated', 'GJ_NEEDAPPROVAL', 'yes' );
    }else {
      $tmpl->addVar( 'groupcreated', 'GJ_NEEDAPPROVAL', 'no' );
    }
    $tmpl->displayParsedTemplate( 'groupcreated' );
	}

	function showmenu($allowcreategroups = false) {
	global $Itemid;
    $tmpl =& HTML_wg::createTemplate('showmenu.tmpl');

    if ($allowcreategroups != false) {
      $link = '<p><a href="'
              . sefRelToAbs("index.php?option=com_groupjive&task=newgroup&Itemid=$Itemid")
              . '">'.GJ_CREATEGROUP.'</a>'
              . '</p>';
      $tmpl->addVar('showmenu', 'CREATEGROUPSLINK', $link);
    } else {
      $tmpl->addVar('showmenu', 'CREATEGROUPSLINK', $link);
    }
    $tmpl->displayParsedTemplate( 'showmenu' );
	}


	function errorpage($message, $intro='', $gid=0, $type='error') {
		global $Itemid, $database, $my;
		$g = new groupJiveGroup($database);
		$g->getArray($gid);



		if ($my->id== 0){
			$type = '';
			$showemail = 0;
		} else {
			$showemail = 1;
		}

		$tmpl =& HTML_wg::createTemplate('error.tmpl');

		$tmpl->addVar('errorpage', 'GJ_ERROR_INTROMESSAGE', $intro);
		$tmpl->addVar('errorpage', 'GJ_MESSAGE_TYPE', $type);
		$tmpl->addVar('errorpage', 'GJ_ERROR_MESSAGE', $message);
		$tmpl->addVar('errorpage', 'GJ_SHOWEMAIL', $showemail);
		$tmpl->addRows('errorpage', $g->asArray);
		// $tmpl->addVar('errorpage', 'GJ_ERROR_LINK', '<a href="'.GJ_REFERER.'">'.GJ_BACK.'</a>');
		$tmpl->addVar('errorpage', 'GJ_ERROR_LINK', HTML_wg::backButton());
		$tmpl->displayParsedTemplate( 'errorpage' );
	}


  function member_list($gid, $count, $usrows, $pageNav) {
    global $Itemid, $my,$database,$mosConfig_live_site,$admin,$mosConfig_lang,$mypic;
  	showgroup($gid);

    // create array that holds the data for the template
    $tmplrowdata = array();
      
    for ($i=0;$i<count($usrows);$i++) {
  		$ur=&$usrows[$i];

	if (file_exists("images/comprofiler/tn".$ur->avatar) && (!PIC2PIC || (PIC2PIC && $mypic))) {
        $tmplrow['IMAGE']="images/comprofiler/tn".$ur->avatar;
	} else if( file_exists('images/comprofiler/tn'.$ur->avatar) && PIC2PIC && !$mypic) { 
	  if (file_exists('components/com_comprofiler/images/'.$mosConfig_lang.'/tnnophoto.jpg')) 
	    $tmplrow['IMAGE']='components/com_comprofiler/images/'.$mosConfig_lang.'/tnnophoto.jpg';
	  else $tmplrow['IMAGE']='components/com_comprofiler/images/english/tnnophoto.jpg';
	} else if (substr($ur->avatar, 0, 7) == 'gallery' && file_exists('images/comprofiler/'.$ur->avatar)) {
	  $tmplrow['IMAGE']="images/comprofiler/".$ur->avatar;
	}else {
	  $tmplrow['IMAGE']=NOPHOTO;
	}
      
      $tmplrow['ID_USER'] = $ur->id_user;
      if(REAL_NAMES) {
      $tmplrow['USERNAME'] = $ur->name;
      } else {
	 $tmplrow['USERNAME'] = $ur->username;
      }
      $tmplrow['ID_GROUP'] = $gid;
      $tmplrow['DATE'] = $ur->date;
     
      if ((ismoder($gid,$my->id) || $admin ) && $ur->id_user<>$ur->creator) {
	  $tmplrow['ISMODER']='yes';
	} else {
	  $tmplrow['ISMODER']='no';
	  } 
	    $database->setQuery("SELECT COUNT(*) FROM #__session WHERE userid ='".$ur->id_user."'");
	    $isonline = $database->loadResult();
  
		$tmplrow['ISONLINE'] = $isonline;
  		if($isonline > 0) {
        $tmplrow['ONLINESTATUS'] = GJ_USERONLINE; 
      } else { 
        $tmplrow['ONLINESTATUS'] = GJ_USEROFFLINE; 
      }
  			
  		// move this tmplrow-array into the array for the template    
      array_push($tmplrowdata, $tmplrow);
  	}
  	
  	$tmpl =& HTML_wg::createTemplate('member_list.tmpl');
    $tmpl->addVar( 'member_list', 'GJ_COUNT', $count );
    $tmpl->addVar( 'member_list', 'ITEMID', $Itemid );
    $tmpl->addRows( 'list_members', $tmplrowdata);
    $link = sefRelToAbs("index.php?option=com_groupjive&task=member_list&groupid=$gid?Itemid=$Itemid");
    setTemplateVars($tmpl, $pageNav, $link, 'member_list');
    $tmpl->displayParsedTemplate( 'member_list' );
  }


  function bulletin($gid, $blogrows) {
	  global $my,$date_format,$Itemid, $mainframe;
		showgroup($gid);
		
    // create template output
    $tmpl =& HTML_wg::createTemplate('bulletin.tmpl');
    	
		// create array that holds the data for the template
    $tmplrowdata = array();
		
		if (!count($blogrows)) {
		  $tmpl->addVar( 'bulletin', 'GJ_SHOWMESSAGES', 'no' );
		} else {
		  $tmpl->addVar( 'bulletin', 'GJ_SHOWMESSAGES', 'yes' );
			
      for ($j=0;$j<count($blogrows);$j++) {
			  $tmplrow=get_object_vars($blogrows[$j]);
		
        // move this tmplrow-array into the array for the template    
        array_push($tmplrowdata, $tmplrow);
			}
		}
		
		if((!BUL_CREATOR && checkuseractive($gid,$my->id)) || ismoder($gid,$my->id)) {
		  $tmpl->addVar( 'bulletin', 'GJ_SHOWFORM', 'yes' );
			 
		  if(WYSIWYG) {
		     // parameters : areaname, content, hidden field, width, height, rows, cols
		     ob_start();
		     editorArea( 'editor1','', 'message', WYSIWYG_WIDTH.'px', WYSIWYG_HEIGHT.'px', WYSIWYG_ROWS, WYSIWYG_COLS ) ;
		     $inputbox = ob_get_clean();
		        
		     $note = '';
		  } else {
		     $inputbox = '<textarea name="message" cols="40" rows="8" class="inputbox"></textarea><br/>';
		     $note = '* '.GJ_HTML_NOT_ALLOW;
			}
		} else {
      $tmpl->addVar( 'bulletin', 'GJ_SHOWFORM', 'no' );
    } 

	$mainframe->appendPathWay(GJ_GROUP_BUL);
    $tmpl->addVar( 'bulletin', 'GJ_ID_GROUP', $gid );
    $tmpl->addVar( 'bulletin', 'GJ_NOTE', $note );
    $tmpl->addVar( 'bulletin', 'ITEMID', $Itemid );
    $tmpl->addVar( 'bulletin', 'GJ_INPUTBOX', $inputbox );
    $tmpl->addRows( 'list_messages', $tmplrowdata);
    
    $tmpl->displayParsedTemplate( 'bulletin' );		
}


  function showfullmessage(&$data) {
    global $date_format, $my, $admin, $Itemid, $mainframe;
    $d=&$data[0];

  	showgroup($d->group_id);

  	// create template output
    $tmpl =& HTML_wg::createTemplate('showfullmessage.tmpl');
    $d->author_name = $d->username;

	// JomComment Integration
	if (_GJ_CONF_JOMCOMMENT) {
		if (file_exists("mambots/content/jom_comment_bot.php")) {
			include_once("mambots/content/jom_comment_bot.php");
			$tmpl->addVar( 'showfullmessage', 'GJ_JOMCOMMENT', jomcomment($d->id, "com_groupjive") );
		} 
	}
	


	$mainframe->appendPathWay("<a href=\"index.php?option=com_groupjive&task=archive&groupid=$d->group_id&Itemid=$Itemid\">".GJ_GROUP_BUL."</a>");
	$mainframe->appendPathWay(GJ_MESSAGE);

    $tmpl->addObject( 'showfullmessage', $d);
    $tmpl->addVar( 'showfullmessage', 'GJ_IS_OWNER', ($my->id ==$d->author_id||$admin||ismoder($d->group_id, $my->id))?"yes":"no");
    $tmpl->addVar( 'showfullmessage', 'ITEMID', $Itemid);
    $tmpl->displayParsedTemplate( 'showfullmessage' );
  }


  function inactive(&$rows, $group) {
  	if (count($rows)==0) {
  		HTML_wg::errorpage(GJ_NOT_INACTIVE, '', $group,'error');
  	} else {

      $tmpl =& HTML_wg::createTemplate('inactive.tmpl');
      $tmpl->addRows( 'list_inactive', $rows);
      $tmpl->displayParsedTemplate( 'inactive' );
    }
  }


  function transfer($groupid) {
    global $my, $mainframe, $mosConfig_live_site, $admin;
    showgroup($groupid);
  	if (!checkuser($groupid,$my->id) && !$admin) {
  			HTML_wg::errorpage(GJ_ONLY_CURRENT, '', $groupid,'error');
  			return;
  	} 
  	// create template output
    $tmpl =& HTML_wg::createTemplate('transfer.tmpl');
    $tmpl->addVar( 'transfer', 'ID', $groupid );
	// ajax stuff
    if(AJAX_ACTIVE && $my->gid >= AJAX_ACCESS) {
		$mainframe->addCustomHeadTag('<script src="'.$mosConfig_live_site
			. '/components/com_groupjive/js/ajax.js" type="text/javascript"></script>');

		$html = '<div id="gjsearchbox">'
				. '<div id="gjclose" class="gjclose"><a href="javascript:toggleLayer(\'gjsearchbox\');">X</a></div>'
				. '<div id="gjinviteresults"></div></div>';

		$tmpl->addVar( 'transfer', 'AJAX_DIV', $html );
		$url = $mosConfig_live_site.'/index.php?option=com_groupjive&task=ajaxuserlist&groupid='.$groupid.'&username=';
		
		$tmpl->addVar( 'transfer', 'AJAX_EVENT', 'onKeyUp="username= document.getElementById(\'fr_name\').value;if (username.length >2) {callAHAH(\''.$url.'\' + encodeURI(username), \'gjinviteresults\', \''.AJAX_MESSAGE.'\', \'Error while fetching the content.\')}"' );		
	}
	
	  $tmpl->displayParsedTemplate( 'transfer' );
  }


  function invite($row) {
    global $my, $mainframe, $mosConfig_live_site;
    showgroup($row->id);
  	if (!checkuser($row->id,$my->id)) {
  			HTML_wg::errorpage(GJ_ONLY_CURRENT);
  			return;
  	} 
  	// create template output
    $tmpl =& HTML_wg::createTemplate('invite.tmpl');
    $tmpl->addVar( 'invite', 'ID', $row->id );
    $tmpl->addVar( 'invite', 'NAME', $row->name );
	// ajax stuff
	if(AJAX_ACTIVE && $my->gid >= AJAX_ACCESS) {
		$mainframe->addCustomHeadTag('<script src="'.$mosConfig_live_site
			. '/components/com_groupjive/js/ajax.js" type="text/javascript"></script>');

		$html = '<div id="gjsearchbox">'
				. '<div id="gjclose" class="gjclose"><a href="javascript:toggleLayer(\'gjsearchbox\');">X</a></div>'
				. '<div id="gjinviteresults"></div></div>';

		$tmpl->addVar( 'invite', 'AJAX_DIV', $html );
		$url = $mosConfig_live_site.'/index.php?option=com_groupjive&task=ajaxuserlist&username=';
		
		$tmpl->addVar( 'invite', 'AJAX_EVENT', 'onKeyUp="username= document.getElementById(\'fr_name\').value;if (username.length >2) {callAHAH(\''.$url.'\' + encodeURI(username), \'gjinviteresults\', \''.AJAX_MESSAGE.'\', \'Error while fetching the content.\')}"' );		
	}

    if(NONREG) {
      $tmpl->addVar('invite', 'EMAIL', GJ_FR_EMAIL.'<br/>	
		      <input type="text" name="fr_email" size="50" maxlength="255" class="inputbox" /><br/>');
    }
    $tmpl->displayParsedTemplate( 'invite' );
  }

	function archive(&$rows,$count,$idg, $pageNav) {
	  global $my, $admin, $mainframe, $Itemid;
		showgroup($idg);
		$tmplrowdata = array();
		
		for ($j=0;$j<count($rows);$j++) {
		  $tmplrow=get_object_vars($rows[$j]);
	    $tmplrow['gj_group'] = $idg;
	    
  	  if(ismoder($idg,$my->id) || $admin){
        $tmplrow['GJ_IS_MODER']='yes' ;
      } else {
        $tmplrow['GJ_IS_MODER']='no' ;
      }
      // move this tmplrow-array into the array for the template    
      array_push($tmplrowdata, $tmplrow);
		}

	$mainframe->appendPathWay(GJ_GROUP_BUL);
	// create template output
    $tmpl =& HTML_wg::createTemplate('archive.tmpl');

	// insert pagenavigation directly into the template
	$link = sefRelToAbs("index.php?option=com_groupjive&task=archive&&groupid=$idg&Itemid=$Itemid");
	setTemplateVars($tmpl, $pageNav, $link, 'archive');

    $tmpl->addVar( 'archive', 'GJ_GROUP', $idg );
    $tmpl->addVar( 'archive', 'ITEMID', $Itemid );
    $tmpl->addRows('list_archive', $tmplrowdata);
    $tmpl->displayParsedTemplate( 'archive' );
	}


	function editpost($row) {
   		global $Itemid;
    
                $group_id = intval(mosGetParam($row, 'group_id'));
                  if(WYSIWYG) {
                      $post = mosGetParam($row, 'post', '', _MOS_ALLOWHTML); 
                  } else {
                      $post = mosGetParam($row, 'post'); 
                  }
                  
                $subject = mosGetParam($row, 'subject');
                $id = intval(mosGetParam($row, 'id'));

                showgroup($group_id);
		
		// create template output
    $tmpl =& HTML_wg::createTemplate('editpost.tmpl');

    $inputboxsubject = '<input type="text" name="subject" size="50" maxlength="255" class="inputbox" value="'.$subject.'" />';
    
 

    if(WYSIWYG) {
		  // parameters : areaname, content, hidden field, width, height, rows, cols
      ob_start();
      editorArea( 'editor1',$post, 'message', WYSIWYG_WIDTH.'px', WYSIWYG_HEIGHT.'px', WYSIWYG_ROWS, WYSIWYG_COLS);
		  $inputbox = ob_get_clean();

		  $note = '';
		} else {
      $inputbox = '<textarea name="message" cols="40" rows="8" class="inputbox">'.$post.'</textarea><br/>';
		  $note = '* '.GJ_HTML_NOT_ALLOW;
		}
    $tmpl->addVar( 'editpost', 'ITEMID', $Itemid );
    $tmpl->addVar( 'editpost', 'GJ_GROUP', $group_id );
    $tmpl->addVar( 'editpost', 'GJ_ID', $id );
    $tmpl->addVar( 'editpost', 'GJ_NOTE', $note );
    $tmpl->addVar( 'editpost', 'GJ_INPUTBOX_SUBJECT', $inputboxsubject );
    $tmpl->addVar( 'editpost', 'GJ_INPUTBOX', $inputbox );
    $tmpl->displayParsedTemplate( 'editpost' );
  }

	function editgroup($rows) {
		global $mosConfig_live_site;
		$row=&$rows[0];
		
		showgroup($row->id);

		if ($row->create_open) {
			$option.= '<OPTION value="1"';
			if($row->type=='1') $option.= ' selected';
				$option.= '>  '. GJ_OPEN.' </option>';
		}

		if ($row->create_closed) {
			$option.= '<OPTION value="2"';
			if($row->type=='2') $option.= ' selected';
				$option.= '> '. GJ_APREQUIRED.'  </option>';
		}

		if ($row->create_invite) {
			$option.= '<OPTION value="3"';
			if($row->type=='3') $option.= ' selected';
				$option.= '>  '. GJ_PRIVATE.'  </option>';
		}

		// create template output
		$tmpl =& HTML_wg::createTemplate('editgroup.tmpl');
		$tmpl->addVar( 'editgroup', 'GJ_OPTIONS', $option );
		$tmpl->addVar( 'editgroup', 'GJ_ID', $row->id );
		$tmpl->addVar( 'editgroup', 'GJ_GROUPNAME', stripslashes($row->name) );
		$tmpl->addVar( 'editgroup', 'GJ_GROUPDESCR', stripslashes($row->descr) );
		$tmpl->displayParsedTemplate( 'editgroup' );
	}

	function showGroup($row, $newusers, $logo, $image, $actions, $moderator_func, $size) {
		global $Itemid;
		$t = 'showgroup'.$size;
		$tmpl =& HTML_wg::createTemplate($t.'.tmpl');
		$tmpl->addVar( $t, 'GJ_GROUPNAME', stripslashes($row->groupname) );
		$tmpl->addVar( $t, 'GJ_NEWUSERS', stripslashes($newusers));
		$tmpl->addVar( $t, 'GJ_GROUPINFO', group_info($row) );
		$tmpl->addVar( $t, 'GJ_LINKS', links($row) );
		$tmpl->addVar( $t, 'GJ_GROUPLOGO', $logo);
		if(REAL_NAMES) {
			$tmpl->addVar( $t, 'GJ_GROUPCREATOR', $row->name );
		} else {
			$tmpl->addVar( $t, 'GJ_GROUPCREATOR', $row->creator );
		}
		$tmpl->addVar( $t, 'GJ_GROUPID', $row->id );
		$tmpl->addVar( $t, 'ITEMID', $Itemid );
		$tmpl->addVar( $t, 'GJ_GROUPCREATORID', $row->user_id );
		$tmpl->addVar( $t, 'GJ_CREATORIMAGE', $image );
		$tmpl->addVar( $t, 'GJ_ACTIONS', $actions );
		if ($my->id) {
			$tmpl->addVar($t, 'SHOWMAILLINK', '1');
		}
		$tmpl->addVar( $t, 'GJ_MODERATOR_FUNC', $moderator_func );
		$tmpl->displayParsedTemplate( $t );
	}

	/**
	 * shows categories overview 
	 * picture will be checked if its existent
	 * link to picture will be generated
	* @param array $rows information of category
	 */
	function showOverview($rows){
		global $Itemid, $database;
		$tmpl =& HTML_wg::createTemplate('showoverview.tmpl');

		// check if picture exists - else use default
		for ($j=0;$j<count($rows);$j++) {
			$row=&$rows[$j];
			if ((file_exists("images/com_groupjive/".$row['cat_image']) && ($row['cat_image']!= ""))) {
				$im="images/com_groupjive/tn".$row['cat_image'];
			} else $im="images/com_groupjive/groupjive_mini.png";
			// build image tag
			$row['CAT_IMAGE'] = '<img src="'.$im.'" alt="'.$rows['catname'].'" style="vertical-align:middle;"/>';
		}

		$tmpl->addVar( 'list_overview', 'ITEMID', $Itemid );
		$tmpl->addRows( 'list_overview', $rows );
		$tmpl->displayParsedTemplate( 'showoverview' );
	}

  function event($gid)
  {
  	global $my, $database;
  	showgroup($gid);
 		include_once('components/com_eventlist/eventlist.html.php');
  }


	function showcat(&$rows,$id, $pageNav, $searchstring = '') {
		global $my, $Itemid, $admin;

		for ($i=0;$i<count($rows);$i++) {
			$row=&$rows[$i];

			//If hideprivate is set to yes, do not show private groups to non-members
			if(HIDEPRIVATE && $row['type'] == 3 && !checkuseractive($row['id'],$my->id) && !$admin) {
			  $row['GJ_HIDE'] = 'yes';
			}  else {
			  $row['GJ_HIDE'] = 'no';
			}

			// get showgroup-link once
                        $showgrouplink = sefRelToAbs("index.php?option=com_groupjive&task=showgroup&groupid=".$row['id']."&Itemid=$Itemid");

			// assign values to the templatevars    
			if (file_exists("images/com_groupjive/".$row['logo']) && ($row['logo'])) {
				$row['GJ_CATIMAGE']= sefRelToAbs("images/com_groupjive/tn".$row['logo']);
			} else if (file_exists("images/com_groupjive/tn".DEFAULT_LOGO)){
				$row['GJ_CATIMAGE']= sefRelToAbs("images/com_groupjive/tn".DEFAULT_LOGO);
			} else {
				$row['GJ_CATIMAGE'] = sefRelToAbs("images/com_groupjive/groupjive_mini.png");
			}

			$row['GJ_URL_SHOWGROUP'] = $showgrouplink;
			$row['GJ_LINKNAME_SHOWGROUP'] = stripslashes($row['name']);
			$row['GJ_SHOWURL_SHOWGROUP'] = "yes";

			//Privacy hack
		       	if (($row['type'] == 3) && (checkuseractive($row['id'],$my->id) || $admin)) {
				if ($row['user_id'] == $my->id) {
					$row['GJ_PRIVACY_STATUS'] = GJ_YOU_ARE_ADMIN;
				} else {
					$row['GJ_PRIVACY_STATUS'] = GJ_ALREADY_MEMBER;
				}
			} elseif (($row['type'] == '3') && (!checkuseractive($row['id'],$my->id))) {
				$row['GJ_SHOWURL_SHOWGROUP'] = "no";
				$row['GJ_PRIVACY_STATUS'] = GJ_INVITE_ONLY;
			} elseif (($row['type'] != 3) && (!checkuser($row['id'],$my->id))) {
				if ($my->gid!=0) {
					$row['GJ_PRIVACY_STATUS'] = "<a href=\""
						. sefRelToAbs("index.php?option=com_groupjive&"
						. "task=sign&groupid=".$row['id']."&"
						. "Itemid=$Itemid")."\">".GJ_SIGN."</a>";
				} else {
				  	$row['GJ_PRIVACY_STATUS'] = '&nbsp;'; 
				}
			} elseif (($row['type'] == 2) && (!checkuseractive($row['id'],$my->id))) {
				$row['GJ_SHOWURL_SHOWGROUP'] = "no";
				$row['GJ_PRIVACY_STATUS'] = GJ_PENDING;
			} else {
				if ($row['user_id'] == $my->id) {
					$row['GJ_PRIVACY_STATUS'] = GJ_YOU_ARE_ADMIN;
				} else {
					$row['GJ_PRIVACY_STATUS'] = GJ_ALREADY_MEMBER;
				}
			}

			// show the link to the group even the admin is not a member
			if ($admin) {$row['GJ_SHOWURL_SHOWGROUP'] = "yes";}
				$row['GROUPUSERCOUNT'] = $row['groupusercount'];
				$row['GJ_CREATED_DATE'] = $row['date_s'];
				$row['GJ_DESCRIPTION'] = stripslashes($row['descr']);
		}

		// create template output
		$tmpl =& HTML_wg::createTemplate('showcat.tmpl');

		// insert pagenavigation directly into the template, different urls for search results and normal category view
			if (isset($searchstring)) {
                    	$link = "index.php?option=com_groupjive&task=search
&Itemid=$Itemid";
			$link .= "&searchstring=$searchstring";
			$tmpl->addVar( 'showcat', 'SEARCHSTRING', $searchstring );
		} else {
                    $link = "index.php?option=com_groupjive&task=showcat&id=$id&Itemid=$Itemid";
                }
                
		
		setTemplateVars($tmpl, $pageNav, $link, 'showcat');
		if ($my->id) {
			$tmpl->addVar('list_entry', 'SHOWMAILLINK', '1');
		}
		$tmpl->addRows( 'list_entry', $rows);
		$tmpl->displayParsedTemplate( 'showcat' );
	}

	function showMailForm($type, $gid, $subject, $body, $copy, $message, $showgroup=true){
		global $Itemid;
		if ($showgroup==true) {
			showgroup($gid);
		}

		$tmpl =& HTML_wg::createTemplate('showmailform.tmpl');

		if ($type == 'mailgroup') {
			$tmpl->addVar( 'showmailform', 'TASK', 'mailgroup');
			$tmpl->addVar( 'showmailform', 'HEADER', GJ_MAIL_GROUP);
		}else{
			$tmpl->addVar( 'showmailform', 'TASK', 'mailgroupowner');
			$tmpl->addVar( 'showmailform', 'HEADER', GJ_MAIL_OWNER);
		}

		$tmpl->addVar( 'showmailform', 'GID', $gid);
		$tmpl->addVar( 'showmailform', 'ITEMID', $Itemid);
		$tmpl->addVar( 'showmailform', 'SUBJECT', $subject);
		$tmpl->addVar( 'showmailform', 'BODY', $body);
		$tmpl->addVar( 'showmailform', 'GJ_MESSAGE', $message);
		$tmpl->addVar( 'showmailform', 'COPY', $copy);
		$tmpl->addVar('showmailform', 'GJ_ERROR_LINK', '<a href="'.GJ_REFERER.'">'.GJ_BACK.'</a>');
		$tmpl->displayParsedTemplate( 'showmailform' );
	}
	
	function backButton() {
		return ('<div class="back_button">'
				.'<a href="javascript:history.go(-1)">'
				.GJ_BACK
				.'</a></div>');
	}
}
?>
