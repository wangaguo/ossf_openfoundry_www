<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $database, $mosConfig_lang;
if (file_exists('components/com_groupjive/language/'.$mosConfig_lang.'.php'))
{
  include_once('components/com_groupjive/language/'.$mosConfig_lang.'.php');
} else {
  include_once('components/com_groupjive/language/english.php');
}
include_once('includes/gj.core.groups.php');
$itemid_active = intval(mosGetParam($_REQUEST, 'Itemid'));

//Itemid GroupJive
  $sql = "SELECT id FROM #__menu "
    . "WHERE link = 'index.php?option=com_groupjive' "
    . "AND published=1";
  $database->setQuery($sql);
  $itemid_gj = $database->loadResult();

if($itemid_active == $itemid_gj) {
  $Itemid = $itemid_gj;
  $_REQUEST['gj'] = 1;
  if(isset($_REQUEST['categid'])) {
    $catid = mosGetParam($_REQUEST, 'categid');
     if($admin) {
       $and = '';
     } else {
       $and =  " AND $my->id=b.id_user";
     }

     $q = "SELECT a.group_id FROM #__gj_eventlist AS a"
       . "\nINNER JOIN #__gj_users AS b"
       . "\nON a.group_id = b.id_group"
       . "\nINNER JOIN #__gj_groups AS c"
       . "\nON c.id = a.group_id"
       . "\nWHERE b.status = 'active'"
       . "\nAND a.category_id = ".$catid
       . $and
       ;
     
     $database->setQuery($q);   
     $res=$database->loadObjectList();
     $gj_groupid=$res[0]->group_id;
     
     if(!empty($gj_groupid))
       {
		showgroup($gj_groupid, 'mini');
	 echo '<a class="events_returntogroup" href="'
	   . sefRelToAbs("index.php?option=com_groupjive&task="
			 . "showgroup&groupid=$gj_groupid&Itemid=$Itemid")
	   . '"> <~ '.GJ_BACKTGROUP.'</a>';

       }
     else 
       {
		// get groupid
		$q = "SELECT a.group_id FROM #__gj_eventlist AS a"
			. "\nWHERE a.category_id = ".$catid;
		$database->setQuery($q);
		$gid = $database->loadResult();
		showgroup($gid);
	 mosRedirect( 'index.php?option=com_groupjive&task=showgroup&groupid='.$gid.'&Itemid='.$itemid_active, 
		      GJ_EVENTS_ONLY_FOR_MEMBERS );
		
       }
  } else {
    //     $_REQUEST['gj'] = 1;
  }
}

?>
