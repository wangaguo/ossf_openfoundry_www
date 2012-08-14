<?php
/**
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
?>

<script language="javascript" type="text/javascript">
function submitbutton(task)
{
  
	var startdate = document.adminForm.dates.value; 
	var enddate = document.adminForm.enddates.value;
	var startArray = startdate.split("-");
	var endArray = enddate.split("-");
	var s_time = document.adminForm.times.value; 
	var ed_time = document.adminForm.endtimes.value; 
	var vip = document.adminForm.vip.value; 
	var st_Array = s_time.split(":");
	var ed_Array = ed_time.split(":");
	var star = new Date(startArray[0], startArray[1], startArray[2], st_Array[0], st_Array[1]);
	var end = new Date(endArray[0], endArray[1], endArray[2], ed_Array[0], ed_Array[1]);
	var form = document.adminForm;
	var datdescription = <?php echo $this->editor->getContent( 'datdescription' ); ?>
	var link_switch = form.link_switch.checked;
	var image_link = form.image_link.value;
	var open_date = form.open_date.value;
	var open_time = form.open_time.value;
	var reg_eat = form.reg_eat.value;
	//var created_by = form.created_by.value;
	var contact = form.contact.value;
	var re ="\'\"\<>";
		
	if(task == 'apply' || task =='save' ){
		for(var j=0;j<re.length;j++){
			if(form.title.value.indexOf(re.substring(j,j+1))!=-1){
				alert("<?php echo JText::_('DONTSYMBOL');?>");
				return false;
			}
		}
	}
		
	var switch_value;
	var publish_value;
	for (var i=0; i<form.published.length; i++){
		if (form.published[i].checked){
			publish_value = form.published[i].value;
		}
    }
/*
else if (form.created_by.value == 0) {
			alert("<?php echo JText::_( 'PLEASE CHOOSE CREATED_BY'); ?>");
			form.created_by.focus();
		} 
*/
		if (task == 'cancel') {
			submitform( task );
		} else if (form.contact.value == 0) {
			alert("<?php echo JText::_( 'PLEASE CHOOSE CONTACT'); ?>");
			form.contact.focus();
	//	} else if ( open_date.length == 0 ){
	//		alert("<?php echo JText::_( 'PLEAST INSERT OPEN DATE' ); ?>");
	//	} else if ( open_time.length == 0 ){
	//		alert("<?php echo JText::_( 'PLEAST INSERT OPEN TIME' ); ?>");
		}else if ( switch_value == 1  && form.image_link.value.length == 0 ){
			alert("<?php echo JText::_( 'PLEAST INSERT IMAGE LINK' ); ?>");
		} else if (form.dates.value == ""){
			alert( "<?php echo JText::_( 'ADD DATE'); ?>" );
		} else if (form.title.value == ""){
			alert( "<?php echo JText::_( 'ADD TITLE'); ?>" );
			form.title.focus();
		} else if (!form.dates.value.match(/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/gi)) {
			alert("<?php echo JText::_( 'DATE WRONG'); ?>");
		} else if (form.enddates.value !="" && !form.enddates.value.match(/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/gi)) {
			alert("<?php echo JText::_( 'ENDDATE WRONG'); ?>");
		} else if (form.times.value == "" && form.endtimes.value != "") {
			alert("<?php echo JText::_( 'ADD TIME'); ?>");
			form.times.focus();
		} else if (form.times.value != "" && !form.times.value.match(/[0-2][0-9]:[0-5][0-9]/gi)) {
			alert("<?php echo JText::_( 'TIME WRONG'); ?>");
			form.times.focus();
		} else if (form.vip.value == -1 ) {
			alert("<?php echo JText::_( 'PLEASE SELECT JOIN TYPE'); ?>");
			form.vip.focus();
		} else if (form.vip_regdate.value == "" && form.vip.value == "4") {
			alert("<?php echo JText::_( 'PLEASE INSERT VIP REG DATES'); ?>");
			form.vip_regdate.focus();
		} else if (form.vip_regdate.value == "" && form.vip.value == "5") {
			alert("<?php echo JText::_( 'PLEASE INSERT VIP REG DATES'); ?>");
			form.vip_regdate.focus();
		} else if (form.vip_regdate.value == "" && form.vip.value == "8") {
			alert("<?php echo JText::_( 'PLEASE INSERT VIP REG DATES'); ?>");
			form.vip_regdate.focus();
		} else if (form.vip_regdate.value == "" && form.vip.value == "9") {
			alert("<?php echo JText::_( 'PLEASE INSERT VIP REG DATES'); ?>");
			form.vip_regdate.focus();
		//} else if (form.reg_type.value == -1) {
		//	alert("<?php echo JText::_( 'CHOOSE REG_TYPE'); ?>");
		//	form.reg_type.focus();
		} else if (form.reg_area.value == "-1"){
			alert( "<?php echo JText::_( 'CHOOSE REG_AREA'); ?>" );
		} else if (form.reg_msg.value == "-1"){
			alert( "<?php echo JText::_( 'CHOOSE LANGUAGE'); ?>" );
			form.reg_msg.focus();
		} else if (form.times.value == "") {
			alert("<?php echo JText::_( 'PLEASE INSERT TIMES'); ?>");
			form.times.focus();
		} else if (form.endtimes.value == "") {
			alert("<?php echo JText::_( 'PLEASE INSERT ENDTIMES'); ?>");
			form.times.focus();
		} else if (form.endtimes.value != "" && !form.endtimes.value.match(/[0-2][0-9]:[0-5][0-9]/gi)) {
			alert("<?php echo JText::_( 'TIME WRONG'); ?>");
			form.endtimes.focus();
		} else if (form.vip_endtime.value == "" && form.vip.value == "5") {
			alert("<?php echo JText::_( 'PLEASE INSERT VIP_ENDTIME'); ?>");
			form.vip_endtime.focus();
		} else if (form.vip_endtime.value == "" && form.vip.value == "9") {
			alert("<?php echo JText::_( 'PLEASE INSERT VIP_ENDTIME'); ?>");
			form.vip_endtime.focus();
		} else if (form.vip_endtime.value != "" && !form.vip_endtime.value.match(/[0-2][0-9]:[0-5][0-9]/gi)) {
			alert("<?php echo JText::_( 'TIME WRONG'); ?>");
			form.vip_endtime.focus();
		} else if (form.reg_eat.value == -1){
			alert( "<?php echo JText::_( 'CHOOSE EAT'); ?>" );
		} else if (form.catsid.value == "0"){
			alert( "<?php echo JText::_( 'CHOOSE CATEGORY'); ?>" );
		} else if (form.locid.value == ""){
			alert( "<?php echo JText::_( 'CHOOSE VENUE'); ?>" );
		} else if (end < star){
			alert( "<?php echo JText::_( 'DATE WRONG'); ?>" );
		} else {
			<?php
			echo $this->editor->save( 'datdescription' );
			?>
			$("meta_keywords").value = $keywords;
			$("meta_description").value = $description;
			submit_unlimited();
			var user_num = 0;
			
			if(document.adminForm['getSpeaker[]'].options.length ==0){
				alert("<?php echo JText::_( 'PLEASE CHOOSE CREATED_BY'); ?>");
			}
			
			if( form.open_date.value=='0000-00-00' && form.open_time.value=='00:00' && <?php echo $this->row->id;?> == 0 && publish_value == 1 && form.vip.value > 0 ){
				if( confirm("<?php echo JText::_( 'OPEN EVENT SURE');?>")==1 ){
					allSelected(document.adminForm['getSpeaker[]']);
					submitform( task );
				}
			}else{
				allSelected(document.adminForm['getSpeaker[]']);
				submitform( task );
			}
		
		}
	}

	function moveOptions(from,to) {
		// Move them over
		for (var i=0; i<from.options.length; i++) {
			var o = from.options[i];
			if (o.selected) {
			  to.options[to.options.length] = new Option( o.text, o.value, false, false);
			}
		}

		// Delete them from original
		for (var i=(from.options.length-1); i>=0; i--) {
			var o = from.options[i];
			if (o.selected) {
			  from.options[i] = null;
			}
		}
		from.selectedIndex = -1;
		to.selectedIndex = -1;
	}

	function allSelected(element) {
		for (var i=0; i<element.options.length; i++) {
			var o = element.options[i];
			o.selected = true;
		}
	}
</script>
<?php  $model = $this->getModel('event'); ?>
<form action="index.php" method="post" name="adminForm" id="adminForm">

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="adminform">
	<tr>
		<td valign="top">
			<table class="adminform">
				<tr>
					<td><label for="title"><?php echo JText::_( 'EVENT TITLE' ).':'; ?></label></td>
					<td><input class="inputbox" name="title" value="<?php echo $this->row->title; ?>" size="50" maxlength="100" id="title" /></td>
					<td><label for="published"><?php echo JText::_( 'PUBLISHED' ).':'; ?></label></td>
					<td>
						<?php
						$html = JHTML::_('select.booleanlist', 'published', '', $this->row->published );
						echo $html;
						?>
					</td>
				</tr>
				<tr>
					<td><label for="alias"><?php echo JText::_( 'Alias' ).':'; ?></label></td>
					<td><input class="inputbox" type="text" name="alias" id="alias" size="50" maxlength="100" value="<?php echo $this->row->alias; ?>" /></td>
				</tr>
				<tr>
					<td><label for="venueid"><?php echo JText::_( 'VENUE' ).':'; ?></label></td>
					<td><?php echo $this->venueselect; ?></td>
					<td><label for="catid"><?php echo JText::_( 'CATEGORY' ).':'; ?></label></td>
					<td><?php echo $this->Lists['category']?></td>
				</tr>
			</table>
			
<?php
	// parameters : areaname, content, hidden field, width, height, rows, cols, buttons echo $this->row->id;
	
	if($this->row->id != 0){
		$edit_value = $this->row->datdescription;
	}else{
		$edit_value = ELOutput::Default_value();
	}
?>
			<table class="adminform">
				<tr>
					<td><?php echo $this->editor->display( 'datdescription',  $edit_value, '100%;', '550', '75', '20', array('pagebreak', 'readmore') ) ;?></td>
				</tr>
			</table>
		</td>

		<td valign="top" width="320px" style="padding: 7px 0 0 5px">
			<?php
				$title = JText::_( 'BASIC' ).JText::_( 'PARAMETERS');
				echo $this->pane->startPane("det-pane");
				echo $this->pane->startPanel( $title, 'date' );
			//Set the info image
				$infoimage = JHTML::image('components/com_eventlist/assets/images/icon-16-hint.png', JText::_( 'NOTES' ) );
			?>
<!--講者--> 
			<table>
				<td><?php echo JText::_( 'SPEAKER LIST' ).':'; ?></td>
				<td>&nbsp;</td>
				<td><?php echo JText::_( 'SPEAKER JOIN' ).':'; ?></td>
				<tr>
					<td><center><?php echo $this->Lists['all_user']; ?></center></td>
					<td>
						<input type="button" name="right" value="&gt;" onClick="moveOptions(document.adminForm['all_user'], document.adminForm['getSpeaker[]'])" /><br /><br />
						<input type="button" name="left"  value="&lt;" onClick="moveOptions(document.adminForm['getSpeaker[]'], document.adminForm['all_user'])" />
					</td>
					<td ><center><?php echo $this->Lists['getSpeaker']; ?></center></td>
				</tr>
			</table>
<!--講者--> 
			
			<table>
<!--聯絡人-->
				<tr>
					<td><label for = "contact"><?php echo JText::_('CONTACT_P').':';?></label></td>
					<td><?php echo $model->add_list($this->row->contact,2,'contact');?></td>
				</tr>
<!--聯絡人end-->

<!--日期-->
				<tr>
					<td><label for="dates"><?php echo JText::_( 'EVENT' ).JText::_( 'DATE' ).':'; ?></label></td>
					<td><?php echo JHTML::_('calendar', $this->row->dates, "dates", "dates"); ?></td>
					<td><span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT DATE'); ?>"><?php echo $infoimage; ?></span></td>
				</tr>
				<tr>
					<td><label for="enddates"><?php echo JText::_( 'ENDDATE' ).':'; ?></label></td>
					<td><?php echo JHTML::_('calendar', $this->row->enddates, "enddates", "enddates"); ?></td>
					<td><span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT DATE'); ?>"><?php echo $infoimage; ?></span></td>
				</tr>
<?php
	if ($this->row->times){$this->row->times = substr($this->row->times, 0, 5);}
	if ($this->row->endtimes){$this->row->endtimes = substr($this->row->endtimes, 0, 5);}
?>
				<tr>
					<td><label for="times">	<?php echo JText::_( 'EVENT TIME' ).':'; ?></label></td>
					<td><input class="inputbox" name="times" value="<?php echo $this->row->times; ?>" size="15" maxlength="8" id="times" /></td>
					<td>
						<?php if ( $this->elsettings->showtime == 1 ) { ?>
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT TIME'); ?>"><?php echo $infoimage; ?></span>
						<?php } else { ?>
							<span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT TIME OPTIONAL'); ?>"><?php echo $infoimage; ?></span>
						<?php } ?>
					</td>
				</tr>
	
					<td><label for="endtimes"><?php echo JText::_( 'END TIME' ).':'; ?></label></td>
					<td><input class="inputbox" name="endtimes" value="<?php echo $this->row->endtimes; ?>" size="15" maxlength="8" id="endtimes" /></td>
					<td><span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT TIME OPTIONAL'); ?>"><?php echo $infoimage; ?></span></td>
<!--日期end-->

<!--活動類型-->
	<!--tr>
		<td><label for="reg_type"><?php echo JText::_('EVENT').JText::_('TYPE').':';?></label></td>
		<td><?php echo $this->Lists['reg_type']; ?>	</td>
	</tr-->
<!--活動類型end-->

<!--vip選項-->
	<tr>
		<td><label for="vip"><?php echo JText::_('AR').':';?></label></td>
		<td><?php echo $this->Lists['registra']; ?></td>
	</tr> 
<!--vip選項-->

<!--額滿人數-->
  <tr>
    <td><label for="full"><?php echo JText::_('FULL').':';?></label></td>
    <td><input class="inputbox" name="full" value="<?php echo $this->row->full; ?>" size="15" maxlength="8" id="full" />default : 30</td>
  </tr>
<!--額滿人數end-->

<!--候補數量-->
  <tr>
    <td><label for="candidate"><?php echo JText::_('CANDIDATE').':';?></label></td>
    <td><input class="inputbox" name="candidate" value="<?php echo $this->row->candidate; ?>" size="15" maxlength="8" id="candidate" />default : 5</td>
  </tr>
<!--候補數量end-->

</table>

	<?php
		$title = JTEXT::_('ADVANCE').JText::_( 'TIME' ).JText::_( 'PARAMETERS');
		echo $this->pane->endPanel();
		
		echo $this->pane->startPanel( $title, 'registra' );
		?>

<table>
<!--活動開放報名時間-->
<?php
	if( $this->row->id == 0 ){
		$open_date = '0000-00-00';
	}else{
		$open_date = $this->row->open_date;
	}
?>
	<tr>
		<td><label for="open_date"><?php echo JText::_('OPEN DATE').':';?></label></td>
		<td><?php echo JHTML::_('calendar', $open_date, 'open_date', 'open_date'); ?></td>
	</tr>
	
	<tr>
<?php 
	if( $this->row->id == 0 ){
		$open_time = '00:00';
	}else{
		$edit_time = explode(':',$this->row->open_time);
		$open_time = $edit_time[0].":".$edit_time[1];
	}
?>
		<td><label for="open_time"><?php echo JText::_('OPEN TIME').':';?></label></td>
		<td><input class="inputbox" name="open_time" value="<?php echo $open_time; ?>" size="15" id="open_time" /></td>
	</tr>
<!--活動開放報名時間end-->

<!--活動截止報名時間-->
	<tr>
		<td><label for="signupEnddate"><?php echo JText::_('SIGNUP END DATE').':';?></label></td>
		<td><?php echo JHTML::_('calendar', $this->row->signupEnddate, 'signupEnddate', 'signupEnddate'); ?></td>
	</tr>
	
	<tr>
<?php 
	if( $this->row->id != '0' ){
		$edit_sig_time = explode(':',$this->row->signupEndtime);
		$signup_end_time = $edit_sig_time[0].":".$edit_sig_time[1];
	}
?>
		<td><label for="signupEndtime"><?php echo JText::_('SIGNUP END TIME').':';?></label></td>
		<td><input class="inputbox" name="signupEndtime" value="<?php echo $signup_end_time; ?>" size="15" id="signupEndtime" /></td>
	</tr>
<!--活動截止報名時間end-->

	<tr>
		<td><label for="ve_dates"><?php echo JText::_( 'VIP SIGNUP END' ).':'; ?></label></td>
		<td><?php echo JHTML::_('calendar', $this->row->vip_regdate, "vip_regdate", "vip_regdate"); ?></td>
        <td><span class="editlinktip hasTip" title="<?php echo JText::_( 'NOTES' ); ?>::<?php echo JText::_('FORMAT DATE'); ?>"><?php echo $infoimage; ?></span></td>
	</tr>
<!--vip結束時間-->
	<tr>
		<td><label for="vip_endtime"><?php echo JText::_( 'VIPENDTIME' ).':'; ?></label></td>
		<td>
		<?php
		if ($this->row->vip_endtime) {
			$this->row->vip_endtime = substr($this->row->vip_endtime, 0, 5);
		}
		?>
		<input class="inputbox" name="vip_endtime" value="<?php echo $this->row->vip_endtime; ?>" size="15" maxlength="8" id="vip_endtime" />
		</td>
	</tr>
<!--vip結束時間-->
</table>

	<?php
		$title = JText::_( 'ADVANCE' ).JText::_( 'PARAMETERS');
		echo $this->pane->endPanel();
		echo $this->pane->startPanel( $title, 'registra' );
	?>
<table>
<!--活動聯絡人-->
    <tr>
      <td><label for = "contact"><?php echo JText::_('CONTACT_GROUP').':';?></label></td>
      <td><?php echo EventListModelEvent::contact_cum();?></td>
    </tr>

<!--信件語言-->
	<tr>
		<td><label for="language"><?php echo JText::_('SELECT LANGUAGE').':';?></label></td>
		<td><?php echo $this->Lists['reg_msg']; ?></td>
	</tr>
<!--信件語言end-->

<!--活動區域-->
	<tr>
		<td><label for="reg_area"><?php echo JText::_('SELECT AREA').':';?></label></td>
		<td><?php echo $this->Lists['area']; ?></td>
	</tr>
<!--活動區域end-->

<!--詢問葷素-->
	<tr>
		<td><label for="reg_eat"><?php echo JText::_('EVENT EAT').':';?></label></td>
		<td><?php echo $this->Lists['reg_eat']; ?></td>
	</tr>
<!--活詢問葷素end-->

<!--問卷-->
	<tr>
		<td><label for="display_survey"><?php echo JText::_('SURVEY').':';?></label></td>
		<td><?php echo $this->Lists['survey']; ?></td>
	</tr>
<!--問卷--> 

<!--審核制選項-->
  <tr>
    <td><label for="audit"><?php echo JText::_('EVENT AUDIT');?></label></td>
    <td><?php echo $this->Lists['audit']; ?></td>
  </tr>
<!--審核制選項end-->

<!--活動費用-->
	<tr>
		<td><label for="reg_fee"><?php echo JText::_('EVENT FEE').':';?></label></td>
		<td><input class="inputbox" name="reg_free" value="<?php echo $this->row->reg_free; ?>" size="15" maxlength="8" id="reg_free" />default : free</td>
	</tr>
<!--活動費用end-->
	
</table>
	<?php
	$title = JText::_( 'IMAGE' );
	echo $this->pane->endPanel();
	echo $this->pane->startPanel( $title, 'image' );
	
	$html = JHTML::_('select.booleanlist', 'link_switch', '', $this->row->link_switch );
	
	?>
	<table>
		<tr>
			<td><label for="image_link"><?php echo JText::_('PINRT LINK');?></label></td>
			<td><?php echo $html;?></td>
		</tr>
		<tr>
			<td><label for="image_link"><?php echo JText::_('ROUTE');?></label></td>
			<td><input class="inputbox" name="image_link" id="image_link" value=<?php echo $this->row->image_link; ?>></td>
		</tr>
		<tr>
			<td><label for="image"><?php echo JText::_( 'CHOOSE IMAGE' ).':'; ?></label></td>
			<td><?php echo $this->imageselect; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<img src="../images/M_images/blank.png" name="imagelib" id="imagelib" width="80" height="80" border="2" alt="Preview" />
				<script language="javascript" type="text/javascript">
				if (document.forms[0].a_imagename.value!=''){
					var imname = document.forms[0].a_imagename.value;
					jsimg='../images/eventlist/events/' + imname;
					document.getElementById('imagelib').src= jsimg;
				}
				</script>
				<br />
			</td>
		</tr>
	</table>
	<?php
	$title = JText::_( 'RECURRING EVENTS' );
	echo $this->pane->endPanel();
	echo $this->pane->startPanel( $title, 'recurrence' );
	?>
	<table width="100%">
		<tr>
			<td width="40%"><?php echo JText::_( 'RECURRENCE' ); ?>:</td>
			<td width="60%">
				<select id="recurrence_select" name="recurrence_select" size="1">
			 	<option value="0"><?php echo JText::_( 'NOTHING' ); ?></option>
				<option value="1"><?php echo JText::_( 'DAYLY' ); ?></option>
				<option value="2"><?php echo JText::_( 'WEEKLY' ); ?></option>
				<option value="3"><?php echo JText::_( 'MONTHLY' ); ?></option>
				<option value="4"><?php echo JText::_( 'WEEKDAY' ); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" id="recurrence_output">&nbsp;</td>
		</tr>
		<tr id="counter_row" style="display:none;">
			<td><?php echo JText::_( 'RECURRENCE COUNTER' ); ?>:</td>
			<td><?php echo JHTML::_('calendar', ($this->row->recurrence_counter <> 0000-00-00)? $this->row->recurrence_counter: JText::_( 'UNLIMITED' ), "recurrence_counter", "recurrence_counter"); ?><a href="#" onclick="include_unlimited('<?php echo JText::_( 'UNLIMITED' ); ?>'); return false;"><img src="../components/com_eventlist/assets/images/unlimited.png" width="16" height="16" alt="<?php echo JText::_( 'UNLIMITED' ); ?>" /></a></td>
		<tr>
		<tr>
			<td><br/><br/></td>
		</tr>
	</table>
	<br/>
	<input type="hidden" name="recurrence_number" id="recurrence_number" value="<?php echo $this->row->recurrence_number; ?>" />
	<input type="hidden" name="recurrence_type" id="recurrence_type" value="<?php echo $this->row->recurrence_type; ?>" />
	<script type="text/javascript">
			<!--
				var $select_output = new Array();
				$select_output[1] = "<?php echo JText::_( 'OUTPUT DAY' ); ?>";
				$select_output[2] = "<?php echo JText::_( 'OUTPUT WEEK' ); ?>";
				$select_output[3] = "<?php echo JText::_( 'OUTPUT MONTH' ); ?>";
				$select_output[4] = "<?php echo JText::_( 'OUTPUT WEEKDAY' ); ?>";

				var $weekday = new Array();
				$weekday[0] = "<?php echo JText::_( 'MONDAY' ); ?>";
				$weekday[1] = "<?php echo JText::_( 'TUESDAY' ); ?>";
				$weekday[2] = "<?php echo JText::_( 'WEDNESDAY' ); ?>";
				$weekday[3] = "<?php echo JText::_( 'THURSDAY' ); ?>";
				$weekday[4] = "<?php echo JText::_( 'FRIDAY' ); ?>";
				$weekday[5] = "<?php echo JText::_( 'SATURDAY' ); ?>";
				$weekday[6] = "<?php echo JText::_( 'SUNDAY' ); ?>";

				var $before_last = "<?php echo JText::_( 'BEFORE LAST' ); ?>";
				var $last = "<?php echo JText::_( 'LAST' ); ?>";

				start_recurrencescript();
			-->
	</script>
	<?php
		$title = JText::_( 'METADATA INFORMATION' );
		echo $this->pane->endPanel();
		echo $this->pane->startPanel( $title, 'meta' );
	?>
	<table>
		<tr>
			<td>
				<input class="inputbox" type="button" onclick="insert_keyword('[title]')" value="<?php echo JText::_( 'EVENT TITLE' ); ?>" />
				<input class="inputbox" type="button" onclick="insert_keyword('[a_name]')" value="<?php echo JText::_( 'VENUE' ); ?>" />
				<input class="inputbox" type="button" onclick="insert_keyword('[catsid]')" value="<?php echo JText::_( 'CATEGORY' ); ?>" />
				<input class="inputbox" type="button" onclick="insert_keyword('[dates]')" value="<?php echo JText::_( 'DATE' ); ?>" />
				<p><input class="inputbox" type="button" onclick="insert_keyword('[times]')" value="<?php echo JText::_( 'EVENT TIME' ); ?>" />
				<input class="inputbox" type="button" onclick="insert_keyword('[enddates]')" value="<?php echo JText::_( 'ENDDATE' ); ?>" />
				<input class="inputbox" type="button" onclick="insert_keyword('[endtimes]')" value="<?php echo JText::_( 'END TIME' ); ?>" /></p>
				<br/>
				<label for="meta_keywords"><?php echo JText::_( 'META KEYWORDS' ).':'; ?></label>
				<br />
				<?php
				if (!empty($this->row->meta_keywords)) {
					$meta_keywords = $this->row->meta_keywords;
				} else {
					$meta_keywords = $this->elsettings->meta_keywords;
				}
				?>
				<textarea class="inputbox" name="meta_keywords" id="meta_keywords" rows="5" cols="40" maxlength="150" onfocus="get_inputbox('meta_keywords')" onblur="change_metatags()"><?php echo $meta_keywords; ?></textarea>
			</td>
		<tr>
		<tr>
			<td>
				<label for="meta_description">
					<?php echo JText::_( 'META DESCRIPTION' ).':'; ?>
				</label>
				<br />
				<?php
				if (!empty($this->row->meta_description)) {
					$meta_description = $this->row->meta_description;
				} else {
					$meta_description = $this->elsettings->meta_description;
				}
				?>
				<textarea class="inputbox" name="meta_description" id="meta_description" rows="5" cols="40" maxlength="200" onfocus="get_inputbox('meta_description')" onblur="change_metatags()"><?php echo $meta_description; ?></textarea>
			</td>
		<tr>
			<!-- include the metatags end-->
	</table>
	<script type="text/javascript">
	<!--
		starter("<?php echo JText::_( 'META ERROR' ); ?>");	// da window.onload schon belegt wurde, wird die Funktion 'manuell' aufgerufen
	-->
	</script>
	<?php
		echo $this->pane->endPane(); 
	?>

		</td>
	</tr>
</table>
<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="controller" value="events" />
	<input type="hidden" name="view" value="event" />
	<input type="hidden" name="task" value="" />
<?php if ($this->task == 'copy') { ?>
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="created" value="" />
	<input type="hidden" name="author_ip" value="" />
	<input type="hidden" name="created_by" value="" />
<?php } else { ?>
	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
	<input type="hidden" name="created" value="<?php echo $this->row->created; ?>" />
	<input type="hidden" name="author_ip" value="<?php echo $this->row->author_ip; ?>" />

<?php } ?>

</form>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
