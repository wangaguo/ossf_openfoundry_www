<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

include_once('includes/gj.core.groups.php');
$group_cat=$jb_cat;

if(isset($_REQUEST['catid'])) {
$catid = $_REQUEST['catid'];
 
 $q=( "SELECT parent from #__".PREFIX."_categories WHERE id='$catid'");
 $database->setQuery($q);
 $result=$database->loadResult();
 if($result == $group_cat )
   {
     if($admin) {
       $and = '';
     } else {
       $and =  "AND $my->id=id_user";
     }
			  $q=("SELECT group_id, type from #__gj_jb AS a, #__gj_users AS b, #__gj_groups AS c WHERE category_id='$catid' ".$and." AND id_group=group_id AND status='active' AND c.id=group_id");
			  $database->setQuery($q);
			  $res=$database->loadObjectList();
			  $gid=$res[0]->group_id;
			  
			  
			  if(!empty($gid))
			    {
			    showgroup($gid, 'mini');
			      // Navigation Item
			      if (!$Itemid || $Itemid == 99999999) {
				$sql = "SELECT id FROM #__menu "
				  . "WHERE link = 'index.php?option=com_groupjive' "
				  . "AND published=1";
				$database->setQuery($sql);
				$Itemid = $database->loadResult();
				}
			      
			    echo '<a class="forum_returntogroup" href="'
			      . sefRelToAbs("index.php?option=com_groupjive&task="
              . "showgroup&groupid=$gid&Itemid=$Itemid")
			      . '"> <~ '.GJ_BACKTGROUPVIEW.'</a>';
			    }
			  else 
			    {
			      mosRedirect( 'index.php?option=com_groupjive', 
					   "The group forum is for members only." );
			  }
   }
}

?>
