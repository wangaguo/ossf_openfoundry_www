<?php
/**aa
 * @version 1.0 $Id: default.php 958 2009-02-02 17:23:05Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');


	$db = JFactory::getDBO();
	$contact_sql =  "SELECT * ".
					"FROM #__eventlist_events ".
					"WHERE id =".$this->rows[0]->reg_id;
	$db->setQuery($contact_sql);
	$eventC = $db->loadObject();
	$user =&JFactory::getUser($eventC->contact);
	$contact_name = $user->name;
	
	$cat_sql =  "SELECT * ".
				"FROM #__eventlist_categories ".
				"WHERE id =".$eventC->catsid;
	$db->setQuery($cat_sql);
	$cat_value = $db->loadObject();
?>

<script type="text/javascript">

	function checkAll(obj){
		var checkboxs = document.getElementsByName("cid[]"); 
		for(var i=0;i<checkboxs.length;i++){
			checkboxs[i].checked = obj.checked;
		} 
	}
	
	function getParameter(param){
		var query = window.location.search;
		var iLen = param.length;
		var iStart = query.indexOf(param);
		if (iStart == -1)
		   return "";
		iStart += iLen + 1;
		var iEnd = query.indexOf("&", iStart);
		if (iEnd == -1)
		   return query.substring(iStart);
		return query.substring(iStart, iEnd);
		}

	function put2html(task){
		var pt = getParameter('output');
	
		if(pt=='odt2html'){
			submitbutton('output_html');
		}
	}
window.onload=put2html;

	function submitbutton(task){
		var obj=document.getElementsByName("cid[]");
		var len = obj.length;
		var checked = false;
		var form = document.adminForm;
		var invite= document.adminForm.invite.value;
		re = /^[0-9]*$/;   
		re1 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/; 
       
		for (i = 0; i < len; i++){
            if (obj[i].checked == true){
                checked = true;
                break;
            }
        } 
        if(task =='output_txt'){	
        	submitform( task );
		}
        if(task =='output_csv'){	
        	submitform( task );
		}
        if(task =='output_html'){	
        	submitform( task );
		}
		if(task =='produce_vipcode'){	
        	submitform( task );
		}
        if(task =='black_user'){	
        	if(checked==false){
				alert("<?php echo JText::_( 'PLEASE SELECT THE OBJECT' ); ?>");
			} else {
				submitform( task );
			}	
		}
        if(task =='cancel_join'){	
        	if(checked==false){
				alert("<?php echo JText::_( 'PLEASE SELECT THE OBJECT' ); ?>");
			} else {
				submitform( task );
			}	
		}
		if(task == 'mailtoadmin'){
			if(document.adminForm.mail_title.value==0){
				alert("<?php echo JText::_( 'PLEASE CHOICE MAIL' ); ?>");
			} else {
				submitform( task );
			}	
		} 
	  	if(task =='add_user'){
			if(invite==0){
				alert("<?php echo JText::_( 'INSERT ONLY MAIL' ); ?>");
				form.invite.focus(); 
			}else if(!re1.test(invite)){
				alert("<?php echo JText::_( 'ERROR MAIL' ); ?>");
				form.invite.focus(); 
			}else{ 
				submitform( task );
			}
  		}

		if(task == 'sendmail'){
			if(document.adminForm.mail_title.value==0){
				alert("<?php echo JText::_( 'PLEASE CHOICE MAIL' ); ?>");
			}else if(checked==false){
				alert("<?php echo JText::_( 'PLEASE SELECT THE OBJECT' ); ?>");
			}else {
				if(document.adminForm.filter.value==0){
					if(confirm("<?php echo JText::_( 'SENDER' ).':'.$this->user->name; ?>")==true){
						submitform( task );
					}
				}
				if(document.adminForm.filter.value!=0){
					if(confirm("<?php echo JText::_( 'SENDER' ).':'.$contact_name; ?>")==true){
						submitform( task );
					}
				}
			}	
		} 
		
		if(task =='audit_approved'){
			submitform(task);
		}
		if(task =='audit_rejected'){
			submitform(task);
		}

		if(task =='group_mail'){

			var mail_title = document.adminForm.mail_title.value;
			
			if( mail_title == 0 ){
				alert("<?php echo JText::_( 'PLEASE CHOICE MAIL' ); ?>");
			}else{
				if(confirm("<?php 
				
				switch($eventC->reg_area){
					case 1:
						$js_area = JText::_( 'NORTH' );
					break;
					case 2:
						$js_area = JText::_( 'MIDDLE' );
					break;
					case 3:
						$js_area = JText::_( 'SOUTH' );
					break;
					case 4:
						$js_area = JText::_( 'EAST' );
					break;
					case 5:
						$js_area = JText::_( 'OTHER' );
					break;
				}
				
				echo JText::_( 'JS MSG1' )."\\n".JText::_('CATEGORY').':'.$cat_value->catname.'\\n'.JText::_('AREA').':'.$js_area."\\n".JText::_( 'JS MSG2' ).'\\n'.$eventC->title.JText::_( 'JS MSG3' );
				
				 ?>")==true){

					var objForm = document.forms['adminForm'];
					var objLen = objForm.length;

					for (var iCount = 0; iCount < objLen; iCount++)
					{
						if (objForm.elements[iCount].type == "checkbox"){
							objForm.elements[iCount].checked = true;
						}
					}

					submitform( task );
				}
			}
			
		}

	}
	
	function chick_select(){
		submitform("user");
	}

	function chick_select2(){
		submitform("mail");
	}

	function chick_select3(){
		submitform("join");
	}

	function chick_select4(){
		submitform("join");
	}
	
	function audit_approved(id,sn,mail){
		document.adminForm.audit_id.value = id;
		document.adminForm.audit_sn.value = sn;
		document.adminForm.audit_mail.value = mail;
		submitform("audit_approved");
	}
	function audit_rejected(id,sn,mail){
		document.adminForm.audit_id.value = id;
		document.adminForm.audit_sn.value = sn;
		document.adminForm.audit_mail.value = mail;
		submitform("audit_rejected");
	}
	function check_cancel(){
		if(document.getElementById("filter_signup")){ 
			document.adminForm.filter_signup.value= '0';
		}
		document.adminForm.filter.value = '0';
		document.adminForm.glist.value = '0';
		document.adminForm.area.value = '0';
		submitform();
	}
</script> 

<form action="index.php" method="post" name="adminForm">

<?php
	$filter	= $mainframe->getUserStateFromRequest( $option.'.reguser.filter', 'filter', '', 'int' );
?>
	<table class="adminform">
		<td >
			<?php echo JText::_( 'USER NAME' );?>：<input class="inputbox" name="vip_name" value="" size="15" id="vipname" />
			<?php echo JText::_( 'E MAIL' );?>：<input class="inputbox" name="invite" value="" size="15" id="invite" />
			<input type="checkbox" name="send_mail"/> <?php echo JText::_( 'SEND MAIL' );?>
			<!--input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onChange="document.adminForm.submit();" /-->
		</td>
		<!--td >
			<input type="checkbox" name="area_g"/> <?php echo JText::_( 'AREA' );?>
			<input type="checkbox" name="categories_g"/> <?php echo JText::_( 'CATEGORIES' );?>
		</td -->
	</table>

	<table class="adminform">
	
	<tr>
		<td width="100%">
		<?php

		$setSurvey = array();
		$setSurvey[] = JText::_( 'PLEASE CHOICE' ) ;
		$setSurvey[] = JText::_( 'INTIVE LETTER' ) ;
		$setSurvey[] = JText::_( 'FRIEND OR COLLEAGUE' ) ;
		$setSurvey[] = JText::_( 'OSSF NEWS PAPER' ) ;
		$setSurvey[] = JText::_( 'OSSF RSS' ) ;
		$setSurvey[] = JText::_( 'OSSF INFORTAION' ) ;
		$setSurvey[] = JText::_( 'SURVEY ORDER' ) ;

			echo JText::_( 'EVENT NAME' );
			echo " : ";
			//echo $this->lists['filter'];
			//活動列表
			$filters = array();

			$where_id[] = " * ";
			$event_items = ELOutput::search_dataRow( '', 'events', ' ORDER BY DATES DESC ' );
			unset($where_id);
			
			$filters[] = JHTML::_('select.option', 0 , JText::_('PLEASE CHOICE EVENT') );
			foreach($event_items['info'] as $item){
				$short_title = mb_substr( $item->title, 0, 30 )."...";
				$filters[] = JHTML::_('select.option', $item->id , JText::_( "(".$item->dates.") ".$short_title ) );
			}
			
			if($_GET['event']!=''){
				$filter = $_GET['event'];
			}
			echo $lists['filter'] = JHTML::_('select.genericlist', $filters, 'filter', 'size="1" class="inputbox" onchange="chick_select();"', 'value', 'text', $filter );

			$where_id[] = " id = $filter ";
			$default_data = ELOutput::search_data( $where_id, 'events', '' );
			unset($where_id);
			//類別列表
			$filter_glist = $mainframe->getUserStateFromRequest( $option.'.reguser.glist', 'glist', '', 'int' );
			$glists = array();
			
 			$db = JFactory::getDBO();
			$glist_data = "SELECT * ".
						  "FROM #__eventlist_categories ORDER BY id";
			$db->setQuery($glist_data);
			$g_data = $db->loadObjectList();
			$glists[] = JHTML::_('select.option', 0 , JText::_('CHOISE') );
			foreach($g_data as $g_data_a){
				$glists[] = JHTML::_('select.option', $g_data_a->id , JText::_( $g_data_a->catname ) );
			}
			
			//區域列表
			$filter_area 			= $mainframe->getUserStateFromRequest( $option.'.reguser.area', 'area', '', 'int' );
			$areas = array();
			$areas[] = JHTML::_('select.option', 0 , JText::_('CHOISE') );
			$areas[] = JHTML::_('select.option', 1 , JText::_( 'NORTH' ) );
			$areas[] = JHTML::_('select.option', 2 , JText::_( 'MIDDLE' ) );
			$areas[] = JHTML::_('select.option', 3 , JText::_( 'SOUTH' ) );
			$areas[] = JHTML::_('select.option', 4 , JText::_('EAST') );
			$areas[] = JHTML::_('select.option', 5 , JText::_('OTHER') );

			if($filter != 0){
				$filter_area = $default_data->reg_area;
				$filter_glist = $default_data->catsid;
				$disabled = "disabled";
			}

			echo 	$lists['g_list'] = JHTML::_('select.genericlist', $glists, 'glist', $disabled.' size="1" class="inputbox" onchange="chick_select2();"', 'value', 'text', $filter_glist );
			echo 	$lists['area'] = JHTML::_('select.genericlist', $areas, 'area', $disabled.' size="1" class="inputbox" onchange="chick_select3();"', 'value', 'text', $filter_area );
			$reg_full = $mainframe->getUserStateFromRequest( $option.'.reg_full', 'reg_full', $mainframe->getCfg('full'), 'int');
			$candidate = $mainframe->getUserStateFromRequest( $option.'.candidate', 'candidate', $mainframe->getCfg('candidate'), 'int');
			$reg_class = $mainframe->getUserStateFromRequest( $option.'.reg_class', 'reg_class', $mainframe->getCfg('reg_class'), 'int');
		?>
		<button onclick="check_cancel();"><?php echo JText::_( 'Reset' ); ?></button>
				<?php
				if( $default_data->audit == 'y' ){
					unset($check_where);
					$audit_notice = array();
					
					//參加人數
					$check_where[0] = " reg_id = $default_data->id AND ch_join = 'y' ";
					$join_row = ELOutput::search_dataRow( $check_where, 'reg_user', '' );
					$audit_notice[0] = "&nbsp;join = ".$join_row['row'];

					//等待審核人數
					$check_where[1] = " reg_audit = '0' AND ch_join = 'y' ";
					$wait_row = ELOutput::search_dataRow( $check_where, 'reg_user', '' );
					$audit_notice[1] = "&nbsp;wait to audit = ".$wait_row['row'];
					
					//審核通過人數
					$check_where[1] = " reg_audit = '1' AND ch_join = 'y' ";
					$approve_row = ELOutput::search_dataRow( $check_where, 'reg_user', '' );
					$audit_notice[2] = "&nbsp;approve = ".$approve_row['row'];
					$notice = "$audit_notice[2]";
					
					//未審核通過人數
					$check_where[1] = " reg_audit = '2' AND ch_join = 'y' ";
					$rejected_row = ELOutput::search_dataRow( $check_where, 'reg_user', '' );
					$audit_notice[3] = "&nbsp;rejected = ".$rejected_row['row'];

					if( $default_data->full <= $approve_row['row'] ){
						$notice = " <font color=red><b>$audit_notice[2]</b></font>";
					}
					
					echo '</br>'.$audit_notice[0].$audit_notice[1].', '.$notice.', '.$audit_notice[3];


				}

				?>
				<!--input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onChange="document.adminForm.submit();" /-->
		</td>
		<td nowrap="nowrap"><?php echo $this->lists['mail_title']; ?></td>
		<td nowrap="nowrap"><?php if( $filter != 0 ){ echo $this->lists['signup']; } ?></td>
	</tr>
</table>
	<table class="adminlist" cellspacing="1">
		<thead>
			<tr>
				<?php
				if( $default_data->audit == 'y' ){echo "<th>".JText::_( 'AUDIT STATE')."</th>";}
				?>
				<th width="5"><?php echo JText::_( 'SN' ); ?></th>
				<th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(this);" /></th>
				<th><?php echo JText::_( 'USER NAME' ); ?></th>
				<th><?php echo JText::_( 'E MAIL' ); ?></th>
				<th>ALL-FUTRUE</th>
				<th><?php echo JText::_( 'COMPANY NAME' ); ?></th>
				<th><?php echo JText::_( 'DEPARTMENT/TITLE' ); ?></th>
				<th><?php echo JText::_( 'GROUP' ); ?></th> 	
				<!--th><?php echo JText::_( 'TEL' ); ?></th> 	
				<th><?php echo JText::_( 'ADDRESS' ); ?></th> 	
				<th><?php echo JText::_( 'FEEDING' ); ?></th--> 	
				<th><?php echo JText::_( 'SIGNUP DATE' ); ?></th> 
				<th><?php echo JText::_( 'USE VIPCODE' );?></th>
				<th><?php echo JText::_( 'USER STATE' ); ?></th>
				<th><?php echo JText::_( 'NOTES' ); ?></th>
			</tr>
	</thead>

	<tfoot>
		<tr>
			<td colspan="13"><?php echo $this->pageNav->getListFooter(); ?></td>
		</tr>
	</tfoot>
		<tbody>
			<?php
			$k = 0;
			for($i=0, $n=count( $this->rows ); $i < $n; $i++) {
				$row = &$this->rows[$i];
   			?>
   			
			<tr class="<?php echo "row$k"; ?>">
		
			<?php 
				if( $default_data->audit == 'y' ){
					if( $row->reg_audit == '1' ){
						$pic = JURI::base()."components/com_eventlist/assets/images/approved.png";
						echo "<td  align=center><img src=$pic ></td>";
					}else if( $row->reg_audit == '2' ){
						$pic = JURI::base()."components/com_eventlist/assets/images/reject.png";
						echo "<td  align=center><img src=$pic ></td>";
					}else{
						echo "<td  align=center>";
						if($row->ch_join == 'y'){
							echo EventListModelreguser::audit_approved($row->reg_id,$row->reg_sn,$row->u_email); 
							echo "</BR>";
							echo EventListModelreguser::audit_rejected($row->reg_id,$row->reg_sn,$row->u_email); 
						}else{
							echo "-";
						}
						echo "</td>";
					}
				}
			?>
			<td><?php echo $row->reg_sn;?></td>
				
			<td align=center>
				<input type="checkbox" id="cb0" name="cid[]" value="<?php echo $row->reg_id."&".$row->reg_sn."&".$row->u_email; ?>" onclick="isChecked(this.checked);">
			</td>
			<td >
				<?php
					//編寫 check box的變數 
					$user_sn = "$row->reg_id+$row->reg_sn";
					$link = 'index.php?option=com_eventlist&amp;controller=reguser&amp;task=edit&amp;cid[]='.$user_sn;
					echo	"<a href=".$link.">$row->u_name</a>";			
					$db = JFactory::getDBO();
					$query =	"SELECT * ".
								"FROM #__eventlist_reg_user ".
								"WHERE u_email = '".$row->u_email."'";
					$db->setQuery($query);
					$db->query();
					$num_rows = $db->getNumRows();
					if($num_rows == 1 || $row->black == 'y' || $row->ch_join == 'n' || $row->u_signup == 1){
						echo "<BR>";
					}
					if($num_rows == 1){
						echo JHTML::_('image', 'administrator/components/com_eventlist/assets/images/add_user.png', '', 'title = "new user" height=20 weight=20' );
					}
						
					if($row->black == 'y'){
						echo $black_image = JHTML::_('image', 'administrator/components/com_eventlist/assets/images/black_user.png', '', 'title = "black" height=20 weight=20' );
					}
						
					if($row->ch_join == 'n'){
						echo $cancel_image = JHTML::_('image', 'administrator/components/com_eventlist/assets/images/cancel_user.png', '', 'title = "cancel" height=20 weight=20' );
					}
						
					if($row->u_signup == 1){
						echo $letter_image = JHTML::_('image', 'administrator/components/com_eventlist/assets/images/newsletter.png', '', 'title = "newsletter" height=20 weight=20' );
					}
					?>
				
				</td>
				
				<td>
					<?php
						//編寫 check box的變數 
						$user_sn = "$row->reg_id+$row->reg_sn";
						$link = 'index.php?option=com_eventlist&amp;controller=reguser&amp;task=edit&amp;cid[]='.$user_sn;
						echo	"<a href=".$link.">$row->u_email</a>";
					?>
				</td>
				<td align=center>
					<?php
						//all_futrue 
						$model = $this->getModel('reguser');
						echo $model->all_futrue($row->u_email);
					?>
				</td>
				
				<td><?php echo $row->u_company; ?></td>
				
				<td>
					<?php
					//職稱
					if(trim($row->u_captaincy) != '/'){
						echo $row->u_captaincy;
					}
					?>
				</td>
				
				<td><?php echo $row->community; //社群 ?></td>
				
				<td><?php echo $row->u_regday;?></td>
				<td>
					<?php
					//vip code
					if($row->vip_code != ''){
						$u_vip_state = $row->vip_code;
					}else{
						$u_vip_state = 'N/A';
					}
					echo $u_vip_state;
					?>
				</td>
				
				<td>
					<?php
					//系統記事
					unset($uesr_note);
					$user_note = array();
					$user_note[] = JText::_('JOIN STATE').':'.$row->note;
					
					if( $row->waiting > 0 ){
						$user_note[] = JText::_('CANDIDATE_NUM').':'.$row->waiting;
					}

					if($default_data->survey=='y'){
						if($row->survey > 0 && $row->survey <= 6){
							$user_note[] = JText::_('SURVEY').':'.$setSurvey[$row->survey];
						}else if($row->survey == 7){
							$user_note[] = JText::_('SURVEY').':'.JText::_('ADMIN JOIN EVENT');
						}else if($row->survey == 6){
							if(!empty($row->survey_text)){
								$user_note[] =  JText::_('SURVEY').': ('.$row->survey_text.")";
							}
						}
					}
					
					if($default_data->reg_eat=='y'){
						switch ($row->u_eat){
							case 0:
								$eat=JText::_('MEALS').JText::_('NO CHOICE');
							break;
							case 1:
								$eat=JText::_('MEALS').JText::_('MEAT AND FISH');
							break;
							case 2:
								$eat=JText::_('MEALS').JText::_('VEGETARIAN');
							break;
							case 3:
								$eat=JText::_('MEALS').JText::_('TAKE CARE OF THEMSELVES');
							break;
						}
						
						$user_note[] = $eat;
					}
					echo implode("<br/>",$user_note);
					?>
				</td>
				<td>
					<?php
					//管理者記事
					if(!empty($row->notes)){
						echo $row->notes;
					}
					?>
				</td>
			</tr>
			<?php $k = 1 - $k;  } ?>
		</tbody>
	</table>
	
	<?php	
		//sql 過濾條件的變數 
		//echo "full = ".$reg_full;
		//echo "<br>candidate = ".$candidate;
		//echo "<br>reg_class = ".$reg_class;
		
	?>

	<input type="hidden" name="audit_id" value="" />
	<input type="hidden" name="audit_sn" value="" />
	<input type="hidden" name="audit_mail" value="" />
	<input type="hidden" name="reg_full" value="<?php echo $reg_full; ?>" />
	<input type="hidden" name="candidate" value="<?php echo $candidate; ?>" />
	<input type="hidden" name="boxchecked" value="1" />
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="view" value="reguser" />
	<input type="hidden" name="controller" value="reguser" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="" />
</form>
<?php

if($filter != '')
{
	echo JHTML::_('image', 'administrator/components/com_eventlist/assets/images/add_user.png', '', 'title = "new user" height=20 weight=20' );
	echo JText::_( 'NEW USER HELP')."&nbsp;&nbsp;&nbsp;";
	echo $black_image = JHTML::_('image', 'administrator/components/com_eventlist/assets/images/black_user.png', '', 'title = "black" height=20 weight=20' );
	echo JText::_( 'BLACKLIST HELP')."&nbsp;&nbsp;&nbsp;";
	echo $cancel_image = JHTML::_('image', 'administrator/components/com_eventlist/assets/images/cancel_user.png', '', 'title = "cancel" height=20 weight=20' );
	echo JText::_( 'LEAVE EVENT')."&nbsp;&nbsp;&nbsp;";
	echo $letter_image = JHTML::_('image', 'administrator/components/com_eventlist/assets/images/newsletter.png', '', 'title = "newsletter" height=20 weight=20' );
	echo JText::_( 'SUBSCRIBE LETTER HELP')."</br>";
}


?>
