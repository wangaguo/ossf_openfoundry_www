<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

global $database;
$database = JFactory::getDBO();


require_once ($mainframe->getPath('admin_html'));
require_once ($mainframe->getPath('class'));
require_once (JPATH_SITE.'/administrator/components/com_pollxt/xthtml.class.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/xtupgrader.class.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.plugin.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/pollxt.common.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class.compat.15.php');
require_once(JPATH_SITE . '/administrator/components/com_pollxt/sajax/Sajax.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.config.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.pageEditor.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.adminFrame.php');


//$task = mosGetParam( $_REQUEST, 'task', array(0) );
// $cid	= mosGetParam( $_REQUEST, 'cid', array(0) );

$cid = JRequest::getVar( 'cid', array(0), '', 'array' );

$mypoll = JRequest::getVar('mypoll', 0 );
$config = JRequest::getVar('config', 0 );
$pollquestion = JRequest::getVar('pollquestion', 0 );
$polloption = JRequest::getVar('polloption', 0 );
$selections = JRequest::getVar('selections', 0 );
$quid = JRequest::getVar('quid', 0 );
$pollid = JRequest::getVar('pollid', 0 );
$id = JRequest::getVar('id', 0 );
$plugindata = JRequest::getVar('plugindata', 0 );

if (!isset($pollquestion)) $pollquestion = array();
if (!isset($polloption)) $polloption = array();
switch ($task) {
	case "info" :
		print_info();
		break;

	case "settings" :
		edit_settings($option);
		break;

	case "saveSettings" :
		save_settings($option, $config);
		break;

	case "new" :
		editPoll(0, $option);
		break;

	case "addPoll" :
		editPoll(0, $option);
		break;

	case "edit" :
		editPoll( intval( $cid[0] ), $option);
		break;
	case 'editA':
		editPoll( $id, $option );
		break;

	case "save" :
		savePoll($mypoll, $pollquestion, $polloption, $selections, $option, $plugindata, 'save');
		break;
	case "apply" :
		savePoll($mypoll, $pollquestion, $polloption, $selections, $option, $plugindata, 'apply');

		break;

	case "remove" :
		removePoll($cid, $option);
		break;

	case "publish" :
		publishPolls($cid, 1, $option);
		break;

	case "unpublish" :
		publishPolls($cid, 0, $option);
		break;

	case "cancel" :
		cancelPoll($option, $pollid);
		break;
	case "addOption" :
		addOption($mypoll, $pollquestion, $polloption, $quid, $pollid, $option);
		break;

	case "addQuestion" :
		addQuestion($mypoll, $pollquestion, $polloption, $pollid, $option);
		break;

	case "copyQuestion" :
		copyQuestion($mypoll, $pollquestion, $polloption, $quid, $pollid, $option);
		break;

	case "orderup" :
		orderMenu($cid[0], -1, $option);
		break;

	case "orderdown" :
		orderMenu($cid[0], 1, $option);
		break;

	case "clear" :
		deletePollData($cid[0], $option);
		break;

	case "copy" :
		copyPoll($cid[0], $option);
		break;
	case "import" :
		showMamboPolls($option);
		break;
	case "doimport" :
		importMamboPolls($cid, $option);
		break;
	case "show" :
		showPolls($option);
		break;
	case "checkUpdate" :
		checkUpdate($option);
		break;
	case "doupdate" :
		update($cid, $option);
		break;
    case "exportList" :
        exportList($option);
        break;
	case "doexport" :
		doexport($option, intval( $cid[0] ));
		break;
	case "saveorder":
		saveOrder();
		break;
	default :
		showCPanel($option);
		break;
}

function showPolls($option) {
	global $mainframe;
	
		$database = JFactory::getDBO();
		JToolbarHelper::publishList();
		JToolbarHelper::unpublishList();
		JToolbarHelper::addNewX( 'new', JText::_('ADMIN_POLLXT_TOOLBAR_NEW'));
		JToolbarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', JText::_('ADMIN_POLLXT_TOOLBAR_COPY'), true );
		JToolbarHelper::editListX();
		JToolbarHelper::customX( 'remove', 'delete.png',  'delete_f2.png', JText::_('ADMIN_POLLXT_TOOLBAR_DEL'), true );
		JToolbarHelper::custom( 'cpanel', 'back.png', 'back_f2.png', JText::_('ADMIN_POLLXT_TOOLBAR_BACK'), false );
		JToolbarHelper::title(JText::_('ADMIN_POLL_MANAGER'));
		
	$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
	$total = $database->loadResult();
	echo $database->getErrorMsg();


	$context = 'com_pollxt.polls.list.';
	$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		'm.ordering',	'cmd' );
	$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );



	jimport('joomla.html.pagination');
	$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
	$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

	$pageNav = new JPagination( $total, $limitstart, $limit );


	$orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', m.ordering';

	$database->setQuery("SELECT m.*, u.name AS editor,"."\n        COUNT(d.id) AS numoptions"."\nFROM #__pollsxt AS m"."\nLEFT JOIN #__users AS u ON u.id = m.checked_out"."\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"."\nGROUP BY m.id"."\n".$orderby."\nLIMIT $pageNav->limitstart, $pageNav->limit");
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		print $database->stderr();
		return false;
	}

	// table ordering
	$lists['order_Dir']	= $filter_order_Dir;
	$lists['order']		= $filter_order;

	HTML_poll :: showPolls($rows, $pageNav, $option, $lists);
}
function copyPoll($uid = 0, $option) {

	editPoll($uid, $option, 1);

}

function editPoll($uid = 0, $option, $copy = 0) {
 	global $mainframe;
	$database = JFactory::getDBO();
	$my = JFactory::getUser();

	$row = new mosPoll($database);
	// load the row from the db table
	$row->load($uid);


	JToolbarHelper::save('save', JText::_('ADMIN_POLLXT_TOOLBAR_SAVE'));
    JToolbarHelper::apply('apply', JText::_('ADMIN_POLLXT_TOOLBAR_APPLY'));
    JToolbarHelper::cancel('cancel', JText::_('ADMIN_POLLXT_TOOLBAR_CANCEL'));
	
	JToolbarHelper::title($uid ? JText::_('ADMIN_POLL_MANAGER_EDIT')." \"".$row->title."\"" : 'Add/Copy'." \"".$row->title." Poll");
	

// load plugin data 
	$plugin = new configPlugin($uid);

//    if ($uid == 0) $questions = array();
	$row_arr = get_object_vars($row);
	$row_arr = stripMQ($row_arr);
	// defaults
	if (!$row->imgor)
		$row_arr['imgor'] = "width";
	else
		$row_arr['imgor'] = $row->imgor;
	if (!$row->imgsize)
		$row_arr['imgsize'] = "100";
	else
		$row_arr['imgsize'] = $row->imgsize;

		
	if ($copy) {

		$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
		$total = $database->loadResult();

		$row_arr['id'] = 0;
		$row_arr['title'] = "Copy of ".$row_arr['title'];
		$row_arr['ordering'] = $total +1;
	}

	// fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		$mainframe->redirect("index2.php?option=$option&task=show", 'The poll $row->title is currently being edited by another administrator.');
	}


	if ($uid) {
	$options = array ();
		if (!$copy)
			$row->checkout($my->id);
		$query = "SELECT * FROM #__pollsxt_questions"."\nWHERE pollid='$uid' ORDER BY ordering";
		$database->setQuery($query);
		$q = $database->loadObjectList();
		$i = 0;
		foreach ($q as $p) {
		 	$i = $p->id;
			$questions[$i] = get_object_vars($p);
			$questions[$i] = stripMQ($questions[$i]);
			$questions[$i]["upd"] = "";
			//defaults
			if ($copy) {
				$questions[$i]['id'] = $i;
				$questions[$i]["upd"] = "I";
			}
			if (!$p->imgor)
				$questions[$i]['imgor'] = "width";
			else
				$questions[$i]['imgor'] = $p->imgor;
			if (!$p->imgsize)
				$questions[$i]['imgsize'] = "100";
			else
				$questions[$i]['imgsize'] = $p->imgsize;
			if (!$p->style)
				$questions[$i]['style'] = "v";
			else
				$questions[$i]['style'] = $p->style;
//			$i ++;
		}
		$k = 0;
		if (isset($questions)) {
		foreach ($questions as $q) {
			$quid = $q["id"];
			$i = $quid;
			$query = "SELECT * FROM #__pollsxt_options"."\nWHERE quid='$quid' ORDER BY ordering";
			$database->setQuery($query);
			$o = $database->loadObjectList();
			$j = 0;
			foreach ($o as $p) {
			 	$j = $p->id;
				$options[$i][$j] = get_object_vars($p);
				$options[$i][$j] = stripMQ($options[$i][$j]);
				$options[$i][$j]['upd'] = "";
				if ($copy) {
					$options[$i][$j]['id'] = $k;	
					$options[$i][$j]['upd'] = "I";
				}
				//defalts
				if (!$p->imgor)
					$options[$i][$j]['imgor'] = "width";
				else
					$options[$i][$j]['imgor'] = $p->imgor;
				if (!$p->imgsize)
					$options[$i][$j]['imgsize'] = "100";
				else
					$options[$i][$j]['imgsize'] = $p->imgsize;
				if (!$p->multirows)
					$options[$i][$j]['multirows'] = "1";
				if (!$p->multicols)
					$options[$i][$j]['multicols'] = "10";
				
				$k ++;

			}

		}

	}
	} else {
		$row_arr['lag'] = 0;
		$q = new mosPollQuestion($database);
		$q->id = 1;
		$q->pollid = 0;
		$q->title = "-- Please change Question --";
		$q->upd = "I";
		$o = new mosPollOptions($database);		
		$o->id = 1;
		$o->quid = 1;
		$o->qoption = "-- Please change Option --";
		$o->upd = "I";
		$i = 1;
		foreach ($q as $k=>$v) {
			if ($k[0] != "_")
				$questions->$i->$k = $v;
		}
		foreach ($o as $k=>$v) {
			if ($k[0] != "_")
				$options->$i->$i->$k = $v;
		}

    }

       
	show_editPoll($row_arr, $questions, $options, getMenu($row->id), $option, "1", $plugin);
}

function savePoll($mypoll, $questions, $options, $selections, $option, $plugindata, $task) {
	global $mainframe;
	
	$database = JFactory::getDBO();
	$my = JFactory::getUser();
	// save the poll parent information
	$row = new mosPoll($database);
	$qdb = new mosPollQuestion($database);
	$odb = new mosPollOptions($database);
	if (!$row->bind($mypoll)) {
		echo "<script> alert('1".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}
	$isNew = ($row->id == 0 or $row->id=="");

	if (!$row->check()) {
		echo "<script> alert('2".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}

	if (!$row->store()) {
		echo "<script> alert('3".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}
	$row->checkin();

	$row->reorder('id > 0');

    $i = 1;


// store plugin data
	$plugin = new configPlugin($row->id);
	$plugin->store($plugindata);

/*    delete deleted items
		$database->setQuery("SELECT id FROM #__pollsxt_questions WHERE pollid = '$row->id' AND kz='D'");
        $q = $database->loadObjectList();
        foreach($q as $qid) {
            $database->setQuery("DELETE FROM #__pollsxt_options WHERE quid = '$qid->id' ");
            $database->query();
        }
		$database->setQuery("DELETE FROM #__pollsxt_questions WHERE pollid = '$row->id' AND kz='D'");
		$database->query();
        $database->setQuery("DELETE FROM #__pollxt_page WHERE pollid = '$row->id' AND kz='D'");
		$database->query();
*/
	// save the poll options
		$ajaxQuestions = json_decode(stripslashes(xtCompat::getVar('ajaxQuestions', 0, true )));
		$ajaxOptions = json_decode(stripslashes(xtCompat::getVar('ajaxOptions', 0, true )));

	$i = 0; 
	foreach ($ajaxQuestions as $question) {
		foreach ($question as $k=>$v) if ($k != "upd") $qdb->$k = $v; 
/*		if (!$qdb->bind($question)) {
			echo "<script> alert('".$qdb->getError()."'); window.history.go(-1); </script>\n";
			exit ();
		}*/

		$qdb->pollid = $row->id;

		if ($question->upd == "D") {
			$database->setQuery("DELETE FROM #__pollsxt_questions where id='$qdb->id'");
			$database->query();
		} else {

			// 'slash' the options
			if (!get_magic_quotes_gpc()) {
//				$qdb->title = addslashes($qdb->title);
			}
			
			if ($question->upd == "I") {
				$qdb->id = null;
			}

			if (!$qdb->store()) {
				echo "<script> alert('".$qdb->getError()."'); window.history.go(-1); </script>\n";
				exit ();
			}
		}
		$qid = $question->id;
		$qdb->reorder('pollid = '.$row->id);
		foreach ($ajaxOptions->$qid as $options) {
			foreach ($options as $k=>$v) if ($k != "upd") $odb->$k = $v; 

//			$odb->bind($options[$i][$j]);

			$odb->quid = $qdb->id;
            if ($options->upd == "D") {
                $database->setQuery("DELETE FROM #__pollsxt_options where id='$odb->id'");
				$database->query();
			} else {
				// 'slash' the options
				$oldid = $odb->id;
				if ($options->upd == "I") {
                  $odb->id = null;
				}
				if (!$odb->store()) {
					echo "<script> alert('".$odb->getError()."'); window.history.go(-1); </script>\n";
					exit ();
				}
			}
		}
		$odb->reorder('quid = '.$qid);

		$i ++;
	}

	// update the menu visibility
	$selections = JRequest::getVar('selections', array ());

	$database->setQuery("DELETE from #__pollxt_menu where pollid='$row->id'");
	$database->query();

	for ($i = 0, $n = count($selections); $i < $n; $i ++) {
		$database->setQuery("INSERT INTO #__pollxt_menu"."\nSET pollid='$row->id', menuid='$selections[$i]'");
		$database->query();
	}

	if ($task == "save")
		$mainframe->redirect("index2.php?option=$option&task=show", "Settings saved");
	if ($task == "apply")
		$mainframe->redirect("index2.php?option=$option&task=editA&hidemainmenu=1&id=$row->id", "Settings applied");
	if ($task == "doimport")
		return array ($row->id, $qdb);

}

function removePoll($cid, $option) {
	global $mainframe;
	
	$database = JFactory::getDBO();
	$msg = '';
	for ($i = 0, $n = count($cid); $i < $n; $i ++) {
		$poll = new mosPoll($database);

		if (!$poll->delete($cid[$i])) {
			$msg .= $poll->getError();
		}
	}
	$mainframe->redirect("index2.php?option=$option&task=show&mosmsg=$msg");
}
function orderMenu($uid, $inc, $option) {
	global $mainframe;
	$database = JFactory::getDBO();

	$row = new mosPoll($database);
	$row->load($uid);
	$row->move($inc);
	$msg .= $row->getError();
	$mainframe->redirect("index2.php?option=$option&task=show&mosmsg=$msg");

}

function deletePollData($uid, $option) {
 	global $mainframe;
 	$database = JFactory::getDBO();
	$database->setQuery("SELECT o.id
	      FROM #__pollsxt_questions AS q
	      LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
	      WHERE q.pollid =  '$uid'");

	$deldata = $database->loadObjectList();
	foreach ($deldata as $d) {
		$database->setQuery("DELETE FROM #__pollxt_data WHERE optid = '$d->id'");
		$database->query();

	}
	$row = new mosPoll($database);
	$row->load($uid);
	$row->voters = "0";
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}

	$mainframe->redirect("index2.php?option=$option&task=show");

}
function publishPolls($cid = null, $publish = 1, $option) {
	global $mainframe;
		
	$database = JFactory::getDBO();
	$my = JFactory::getUser();

	$catid = JRequest::getVar('catid', array (0));

	if (!is_array($cid) || count($cid) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode(',', $cid);

	$database->setQuery("UPDATE #__pollsxt SET published='$publish'"."\nWHERE id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))");
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit ();
	}

	if (count($cid) == 1) {
		$row = new mosPoll($database);
		$row->checkin($cid[0]);
	}
	$mainframe->redirect("index2.php?option=$option&task=show");
}

function cancelPoll($option, $pollid) {
	global $mainframe;
	$database = JFactory::getDBO();
	
	if (!isset($pollid) or $pollid == 0)
        $mainframe->redirect("index2.php?option=$option");
	$row = new mosPoll($database);
	$row->checkin($pollid);
	$mainframe->redirect("index2.php?option=$option&task=show");
}
function addOption($row, $questions, $options, $quid, $pollid, $option) {
	if (!$options)
		$options = array ();

	$questions = stripMQ($questions);
	$options = stripMQ($options);
	$row = stripMQ($row);

	$i = 0;
	foreach ($questions as $question) {
		if ($question['id'] == $quid) {
			if (!isset($options[$i])) {
				$options[$i][0] = array ("id" => 0, "quid" => $quid, "qoption" => "",
                 "img_url" => "", "imgor" => "", "imgsize" => "",
                 "imglink" => "", "freetext" => "", "newopt" => "", "inact" => "",
                 "multirows" => "", "multicols" => "");
			} else {
				$newOption = array ("id" => 0, "quid" => $quid, "qoption" => "",
                 "img_url" => "", "imgor" => "", "imgsize" => "",
                 "imglink" => "", "freetext" => "", "newopt" => "", "inact" => "",
                 "multirows" => "", "multicols" => "");
				array_push($options[$i], $newOption);

			}
		}
		$i ++;
	}
	show_editPoll($row, $questions, $options, getMenu($pollid), $option, "2");

}
function addQuestion($mypoll, $questions, $options, $pollid, $option) {
	$i = 0;
	if (!$options)
		$options = array ();

	if (!$questions)
		$questions = array ();
	$questions = stripMQ($questions);
	$options = stripMQ($options);
	$mypoll = stripMQ($mypoll);
	$vid = count($questions)."a";
	if (count($questions) == 0)
		$questions[0] = array ("id" => $vid, "pollid" => $pollid, "title" => "", "type" => 1,
        "img_url" => "", "imgor" => "", "imgsize" => "", "imglink" => "", "obli" => "",
        "multisize" => "", "inact" => "");
	else {
		$newQuestion = array ("id" => $vid, "pollid" => $pollid, "title" => "", "type" => 1,
        "img_url" => "", "imgor" => "", "imgsize" => "", "imglink" => "", "obli" => "",
        "multisize" => "", "inact" => "");

		array_push($questions, $newQuestion);
	}
	$i ++;

	show_editPoll($mypoll, $questions, $options, getMenu($pollid), $option, "2");
}
function copyQuestion($row, $questions, $options, $quid, $pollid, $option) {

	$questions = stripMQ($questions);
	$options = stripMQ($options);
	$row = stripMQ($row);

	$vid = count($questions)."a";
	$i = 0;
	foreach ($questions as $q) {

		if ($q['id'] == $quid) {
			$newQuestion = array ("id" => $vid, "pollid" => $pollid, "title" => $q['title'], "type" => $q['type'], "img_url" => $q['img_url'], "imgor" => $q['imgor'], "imgsize" => $q['imgsize'], "multisize" => $q['multisize'], "imglink" => $q['imglink'], "obli" => $q['obli'], "inact" => "");
			array_push($questions, $newQuestion);
			$j = count($questions) - 1;
			if (is_array($options[$i])) {
			foreach ($options[$i] as $o) {

				if (!isset($options[$j])) {
					$options[$j][0] = array ("inact" => 0, "id" => 0, "quid" => $vid, "qoption" => $o['qoption'], "img_url" => $o['img_url'], "imgor" => $o['imgor'], "imgsize" => $o['imgsize'], "freetext" => $o['freetext'], "imglink" => $o['imglink'], "newopt" => $o['newopt']);
				} else {
					$newOption = array ("inact" => 0, "id" => 0, "quid" => $vid, "qoption" => $o['qoption'], "img_url" => $o['img_url'], "imgor" => $o['imgor'], "imgsize" => $o['imgsize'], "freetext" => $o['freetext'], "imglink" => $o['imglink'], "newopt" => $o['newopt']);
					array_push($options[$j], $newOption);
				}

			}
			}
		}
		$i ++;
	}

	show_editPoll($row, $questions, $options, getMenu($pollid), $option, "2");
}

function getMenu($pollid) {
	global $database, $my;
	// get selected pages
	if ($pollid) {
		$database->setQuery("SELECT menuid AS value FROM #__pollxt_menu WHERE pollid='$pollid'");
		$lookup = $database->loadObjectList();
	} else {
		$lookup = array (JHTML::_("select.option", 0, 'All'));
	}

	// build the html select list
	$selections				= JHTML::_('menu.linkoptions', true);
	$list	= JHTML::_('select.genericlist',   $selections, 'selections[]', 'class="inputbox" size="15" multiple="multiple"', 'value', 'text', $lookup, 'selections' );
	return $list;
}


function edit_settings($option) {
	global $database;
	require_once (JPATH_SITE . "/administrator/components/com_pollxt/conf.pollxt.php");

    JToolbarHelper::save('save', JText::_('ADMIN_POLLXT_TOOLBAR_SAVE'));
    JToolbarHelper::cancel('cancel', JText::_('ADMIN_POLLXT_TOOLBAR_CANCEL'));
	JToolbarHelper::title(JText::_('ADMIN_GENERAL_SETTINGS')); 

	$config['debug'] = $debug;
	$config['publ'] = $xt_publ;
	$config['disp'] = $xt_disp;
	$config['hide'] = $xt_hide;
	$config['selpo'] = $xt_selpo;
	$config['order'] = $xt_order;
	$config['imgvote'] = $xt_imgvote;
	$config['imgresult'] = $xt_imgresult;
	$config['imgdetail'] = $xt_config->imgdetail;
	$config['imgback'] = $xt_config->imgback;
	$config['maxcolors'] = $xt_maxcolors;
	$config['height'] = $xt_height;
	$config['orderby'] = $xt_orderby;
	$config['asc'] = $xt_asc;
	$config['scookie'] = $xt_seccookie;
	$config['sip'] = $xt_secip;
	$config['suname'] = $xt_secuname;
	$config['resselpo'] = $xt_config->resselpo;
	$config['imgpath'] = $xt_config->imgpath;
	$config['rdisp'] = $xt_config->rdisp;
	$config['button_style'] = $xt_config->button_style;
	$config['compat'] = $xt_config->compat;

	if (!$config['imgpath'])
		$config['imgpath'] = "images/stories";

	// include random tip of day
	$arrTod[1] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP1');
	$arrTod[2] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP2');
	$arrTod[3] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP3');
	$arrTod[4] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP4');
	$arrTod[5] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP5');
	$arrTod[6] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP6');
	$arrTod[7] = JText::_('ADMIN_GS_PAGE_FOOTER_HELP7');

	srand((double) microtime() * 1000000);
	$randnum = rand(1, count($arrTod));

	$tod = $arrTod[$randnum];

	HTML_poll :: edit_settings($option, $config, $tod, getImages(), $com_pollxt_ver);
}

function save_settings($option, $conf) {
	global $mainframe;
	// Config holen (wegen version)
	require_once (JPATH_SITE . "/administrator/components/com_pollxt/conf.pollxt.php");

	$xt_config->version = $xt_config_version;
	$xt_config->debug = $conf['debug'];
	$xt_config->xt_disp = $conf['disp'];
	$xt_config->xt_hide = $conf['hide'];
	$xt_config->xt_selpo = $conf['selpo'];
	$xt_config->xt_publ = $conf['publ'];
	$xt_config->xt_order = $conf['order'];
	$xt_config->xt_imgvote = $conf['imgvote'];
	$xt_config->xt_imgresult = $conf['imgresult'];
	$xt_config->imgdetail = $conf['imgdetail'];
	$xt_config->imgback = $conf['imgback'];
	$xt_config->xt_maxcolors = $conf['maxcolors'];
	$xt_config->xt_height = $conf['height'];
	$xt_config->xt_orderby = $conf['orderby'];
	$xt_config->xt_asc = $conf['asc'];
	$xt_config->xt_seccookie = $conf['scookie'];
	$xt_config->xt_secip = $conf['sip'];
	$xt_config->xt_secuname = $conf['suname'];
	$xt_config->resselpo = $conf['resselpo'];
	$xt_config->imgpath = $conf['imgpath'];
	$xt_config->rdisp = $conf['rdisp'];
	$xt_config->compat = $conf['compat'];
	$xt_config->button_style = $conf['button_style'];
	if (!$xt_config->store()) {
		echo "<script> document.write('".$xt_config->getError()."');  </script>\n";
		exit ();
	}

	$mosmsg = "Settings saved";

	// back to settings
	$mainframe->redirect("index2.php?option=$option&task=settings", $mosmsg);

}
function stripMQ(& $value) {
	if (is_array($value)) {
		$result = array ();
		foreach ($value as $k => $v) {
			if (is_array($v)) {
				$result[$k] = stripMQ($v);
			} else {
				if (!is_object($v))
					$result[$k] = stripslashes($v);
			}
		}

		return $result;
	} else {
		return stripslashes($value);
	}
}

function show_editPoll($row_arr, $questions, $options, $menu, $option, $tab, $plugin=null) {

	$conf = JRequest::getVar('conf', 0);

	// build the html select list for ordering
	$sql = "SELECT ordering AS value, title AS text"."\n FROM #__pollsxt WHERE id > '0'"."\n ORDER BY ordering";
	$order = JHTML::_('list.genericordering', $sql);


	$lists['ordering'] = JHTML :: _("select.genericList", $order, 'mypoll[ordering]', 'class="inputbox" size="1"', 'value', 'text', intval($row_arr['ordering']));

	HTML_poll :: editPoll($row_arr, $questions, $options, $menu, $conf, getImages(), $option, $lists, $tab, $plugin);

}


function showMamboPolls($option) {
	global $mainframe;
	
	JToolbarHelper::customX( 'doimport', 'upload.png', 'upload_f2.png', JText::_('ADMIN_POLLXT_TOOLBAR_IMPORT'), true );
	JToolbarHelper::cancel('cancel', JText::_('ADMIN_POLLXT_TOOLBAR_CANCEL'));
	JToolbarHelper::title(JText::_('ADMIN_POLL_MANAGER_IMPORT_MANAGER'));

	$database = JFactory::getDBO();

	$database->setQuery("SELECT COUNT(*) FROM #__polls");
	$total = $database->loadResult();

	jimport('joomla.html.pagination');
	$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
	$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

	$pageNav = new JPagination( $total, $limitstart, $limit );


	$query = "SELECT m.*, u.name AS editor,"."\n COUNT(d.id) AS numoptions"."\n FROM #__polls AS m"."\n LEFT JOIN #__users AS u ON u.id = m.checked_out"."\n LEFT JOIN #__poll_data AS d ON d.pollid = m.id AND d.text <> ''"."\n GROUP BY m.id"."\n LIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	HTML_poll :: showMamboPolls($rows, $pageNav, $option);
}
function importMamboPolls($cid, $option) {
	global $mainframe;

	$database = JFactory::getDBO();
	
	$row = new mosPoll($database);
	$qdb = new mosPollQuestion($database);
	$odb = new mosPollOptions($database);

	// get the selected polls
	$query = 'SELECT * FROM #__polls WHERE id IN ('.implode(',', $cid).')';
	$database->setQuery($query);
	$polls = $database->loadObjectList();

	// for each poll
	foreach ($polls as $p) {
	
		// get the options
		$options = array ();

		$query = "SELECT id, text FROM #__poll_data"."\n WHERE pollid='$p->id'"."\n AND text <>''"."\n ORDER BY id";
		$database->setQuery($query);
		$options = $database->loadObjectList();

		// build poll
		$poll['id'] = 0;
		$poll['title'] = $p->title;
		$poll['voters'] = $p->voters;
		$poll['published'] = 0;
		$poll['lag'] = $p->lag;
		$poll['rdispb'] = "1";
		$poll['rdisp'] = "3";

		if (!$row->bind($poll)) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit ();
		}
		$isNew = ($row->id == 0 or $row->id=="");
	
		if (!$row->check()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit ();
		}
	
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit ();
		}
		$row->checkin();
	
		$row->reorder('id > 0');


		// build question (there is only one)
		$qdb->id = null;
		$qdb->title = $p->title;
		$qdb->type = 1;
		$qdb->imgor = 'width';
		$qdb->pollid = $row->id;
		if (!$qdb->store()) {
			echo "<script> alert('".$qdb->getError()."'); window.history.go(-1); </script>\n";
			exit ();
		}
		
		// update the results
		foreach ($options as $o) {
			$opt = new mosPollOptions($database);
			$opt->quid = $qdb->id;
			$opt->qoption = $o->text;
			if (!$opt->store()) {
				echo "<script> alert('".$opt->getError()."'); window.history.go(-1); </script>\n";
				exit ();
			}
			$query = "SELECT * FROM #__poll_date WHERE vote_id = '$o->id'";
			$database->setQuery($query);
			$votes = $database->loadObjectList();
			foreach ($votes as $v) {
				$database->setQuery("INSERT INTO #__pollxt_data (optid, ip, user, datu) "."\nVALUES ('$opt->id', 'unknown', 'anonymous', '$v->date')");
				$database->query();
				echo $database->getErrorMsg();

			}
		}
		//update menu
		$query = 'INSERT INTO #__pollxt_menu (pollid,menuid) SELECT '.$row->id.',menuid FROM #__poll_menu WHERE pollid = '.$p->id;
		$database->setQuery($query);
		$database->query();

	}

	$mainframe->redirect("index2.php?option=$option&task=show", "Polls imported");
}
function showCPanel($option) {
 	global $mainframe;
	$database = JFactory::getDBO();

	jimport('joomla.html.pagination');

	$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
	$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

	$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	$pageNav = new JPagination( $total, $limitstart, $limit );

	JToolBarHelper::title(  JText::_( 'ADMIN_CONTROL_PANEL' ) );


	$database->setQuery("SELECT m.*, u.name AS editor,"."\n        COUNT(d.id) AS numoptions"."\nFROM #__pollsxt AS m"."\nLEFT JOIN #__users AS u ON u.id = m.checked_out"."\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"."\nGROUP BY m.id"."\nORDER BY m.ordering"."\nLIMIT $pageNav->limitstart,$pageNav->limit");
	$rows = $database->loadObjectList();

	HTML_poll :: cPanel($option, $rows, $limit, $limitstart, $pageNav);
}

function checkUpdate($option) {
	global $mainframe;
	
	$database = JFactory::getDBO();
	
	JToolbarHelper::title(JText::_('ADMIN_POLLXT_UPGRADE_CHECK'));
	JToolbarHelper::back();
	
	$upgrader = new xt_upgrader();
	$upgrader->set_upgrade_path("http://www.joomlaxt.com/updates/");
	
	$upgrader->set_version_xml("currentversion.xml");

	// get module versions
	$mod = getModuleVersions($upgrader, "mod_pollxt");
	$modcount = count($mod);
//	$modcount ++;
	// get bot versions
	$mod = getBotVersions($upgrader, "pollxt", $mod);
	$modcount = count($mod);
	$modcount ++;
	// get component version
	$mod[$modcount] = getComponentVersion($upgrader);

	jimport('joomla.html.pagination');
	$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
	$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

	$pageNav = new JPagination( count($mod), $limitstart, $limit );

	HTML_upgrader :: showCheckResult($option, $mod, $pageNav);
}

function update($cid, $option) {
	global $database, $mosConfig_absolute_path;

	$mod = mosGetParam($_REQUEST, 'mod', 0);
	$cid = mosGetParam($_REQUEST, 'cid', 0);

// make dirs if required
	if (!file_exists($mosConfig_absolute_path."/components/com_pollxt/class"))
	 mkdir($mosConfig_absolute_path."/components/com_pollxt/class");
	if (!file_exists($mosConfig_absolute_path."/components/com_pollxt/script"))
	 mkdir($mosConfig_absolute_path."/components/com_pollxt/script");

	$upgrader = new xt_upgrader();
	$upgrader->set_upgrade_path("http://www.joomlaxt.com/updates/");

	foreach ($cid as $c) {
		$curVer = $mod[$c]['oldversion'];

		$item = new xtupgradeItem();
		$item->bind($mod[$c]);

		$upgrader->upgrade($item);
		$msg = $upgrader->msg;

	}

	HTML_upgrader :: updateResult($option, $msg);
}

function getModuleVersions($upgrader, $modname) {
	global $mosConfig_absolute_path, $database, $mainframe;
	$mod = null;
	$rows = $upgrader->get_installed_modules($modname);

	$i = 0;
	foreach ($rows as $row) {
		$version = $upgrader->get_mod_version($row);
		$newVersion = $upgrader->get_server_version($row->module);

		$mod[$i]->newVersion = $newVersion;
		$mod[$i]->oldVersion = $version;
		$mod[$i]->module = $row->module;

		if ($newVersion > $version) {
			$mod[$i]->update = true;

		} else {
			$mod[$i]->update = false;

		}
		$i ++;
	}

	return $mod;
}
function getBotVersions($upgrader, $modname, $mod) {
	global $mosConfig_absolute_path, $database, $mainframe;

	$rows = $upgrader->get_installed_bots($modname);
	if (isset($rows)) {
    $i = count($mod);
	foreach ($rows as $row) {
		$version = $upgrader->get_bot_version($row);
		$newVersion = $upgrader->get_server_version($row->element);

		$mod[$i]->newVersion = $newVersion;
		$mod[$i]->oldVersion = $version;
		$mod[$i]->module = $row->element;

		if ($newVersion > $version) {
			$mod[$i]->update = true;

		} else {
			$mod[$i]->update = false;

		}
		$i ++;
	}
	}
	return $mod;
}

function getComponentVersion($upgrader) {
	global $mosConfig_absolute_path, $database, $mainframe;
	$database->setQuery("SELECT version"."\n FROM #__pollxt_config");
	$com->oldVersion = $database->loadResult();
	$com->module = "com_pollxt";

	$com->newVersion = $upgrader->get_server_version("com_pollxt");

	if ($com->newVersion > $com->oldVersion)
		$com->update = true;
	else
		$com->update = false;
	return $com;
}
function exportList($option) {
	global $mainframe;
	$database = JFactory::getDBO();
 
	JToolbarHelper::title(JText::_('ADMIN_POLL_MANAGER_EXPORT_MANAGER'));
	JToolbarHelper::customX( 'doexport', 'download', 'download', JText::_('ADMIN_POLLXT_TOOLBAR_EXPORT'), true );
	JToolbarHelper::custom( 'cpanel', 'back.png', 'back_f2.png', JText::_('ADMIN_POLLXT_TOOLBAR_BACK'), false );

	$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	jimport('joomla.html.pagination');
	$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
	$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

	$pageNav = new JPagination( $total, $limitstart, $limit );


	$database->setQuery("SELECT m.*, u.name AS editor,"."\n        COUNT(d.id) AS numoptions"."\nFROM #__pollsxt AS m"."\nLEFT JOIN #__users AS u ON u.id = m.checked_out"."\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"."\nGROUP BY m.id"."\nORDER BY m.ordering"."\nLIMIT $pageNav->limitstart, $pageNav->limit");
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		print $database->stderr();
		return false;
	}

	HTML_poll :: exportList($rows, $pageNav, $option);
}

function doexport($option, $cid) {
global $mainframe;
$database = JFactory::getDBO();
$database->setQuery("SELECT p.id as pollid, p.title as ptitle, q.id as qid,
                                q.title as qtitle, o.id as oid, o.qoption ,
                                d.id as did, d.ip, d.user, d.datu, d.value
						FROM #__pollsxt_questions AS q
						LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
						LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
						LEFT JOIN #__pollsxt AS p ON p.id = q.pollid
						WHERE q.pollid =  '$cid' AND d.block = 0
						AND q.type <> 5
						ORDER BY q.id,o.id");

$result = $database->loadObjectList();
$results_arr = array();
echo $database->getErrorMsg();

$csv_output = "";
$csv_output .= "PollID,PollTitle,QuestionID,QuestionText,OptionID,OptionText,ResultID,IP,User,DateTime,Comment";

// no results
if (count($result) == 0) {
    $mosmsg = "No results exist for the selected Poll";
	$mainframe->redirect("index2.php?option=$option&task=exportList", $mosmsg);
}
foreach($result as $r) {
    $results_arr = get_object_vars($r);
    $csv_output .= "\n\"".implode ("\",\"", $results_arr)."\"";

    $polltitle= $results_arr['ptitle'];
   }

$csv_output .= "\n";

//header("Content-type: application/vnd.ms-excel");
header("Content-type: text/csv");
$size_in_bytes = strlen($csv_output);
$fname=str_replace(" ", "", $polltitle).".csv";
header("Content-disposition:  attachment; filename=$fname; size=$size_in_bytes");

print $csv_output;
exit;

}
function print_info() {
	echo "hallo";
}
function saveOrder()
{
	global $mainframe;
	// Initialize variables
	$db			=& JFactory::getDBO();
	$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
	$order		= JRequest::getVar( 'order', array(), 'post', 'array' );
	$row 		= new mosPoll($db);
	$total		= count( $cid );

	if (empty( $cid )) {
		return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
	}

	// update ordering values
	for ($i = 0; $i < $total; $i++)
	{
		$row->load( (int) $cid[$i] );
		if ($row->ordering != $order[$i])
		{
			$row->ordering = $order[$i];
			if (!$row->store()) {
				return JError::raiseError( 500, $db->getErrorMsg() );
			}
		}
	}

	$row->reorder('id > 0');

	$mainframe->redirect("index2.php?option=com_pollxt&task=show");

}
?>

