<?php
/** 
 * @version 1.0 $Id: default_attendees.php 1082 2009-07-22 11:18:13Z schlu $
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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

	$user   = & JFactory::getUser();
	$ch_login = $user->get('id');
	$dis = 'none';
	
//session 寫入
	$session =& JFactory::getSession();
	$info_session = $session->get("join_info");
	
	if($ch_login!=0){
		if($info_session['u_name']==''){
			$edit_name	= $user->name;
		}else{
			$edit_name	= $info_session['u_name'];
		}
		$u_email 	= $user->email;
		$readonly	= 'readonly';
	}else{
		$edit_name	=	$info_session['u_name'];
		$u_email	=	$info_session['u_email'];
	}

	if( count( $info_session > 0 ) ){
		$vip_code	=	$info_session['vip_code'];
		$community	=	$info_session['community'];
		$u_company	=	$info_session['u_company'];
		$u_captaincy0=	$info_session['u_captaincy0'];
		$u_captaincy1=	$info_session['u_captaincy1'];
		$u_tel		=	$info_session['u_tel'];
		$u_addr		=	$info_session['u_addr'];
		$u_signup	=	$info_session['u_signup'];
		$ch_phone	=	$info_session['ch_phone'];
		$u_sex		=	$info_session['u_sex'];
		$u_signup	=	$info_session['u_signup'];
		$reg_eat 	=	$info_session['reg_eat'];
		$survey		=	$info_session['survey'];
		if($survey == 6){
			$survey_text=	$info_session['survey_text'];
			$dis = '';
		}
		$session->clear("join_info");
	}
//session 寫入end

	//電子報訂閱選單
	$setMial = array();
	$setMial[] = JHTML::_('select.option', 0, JText::_( 'PLEASE CHOICE' ) );
	$setMial[] = JHTML::_('select.option', 1, JText::_( 'SUBSCRIBE' ) );
	$setMial[] = JHTML::_('select.option', 2, JText::_( 'I DO NOT SUBSCRIBE' ) );
	$setMial[] = JHTML::_('select.option', 3, JText::_( 'I SUBSCRIBE TO THE NEWSLETTER' ) );
	$lists['signup'] = JHTML::_('select.genericlist', $setMial, 'u_signup', 'size="1" class="inputbox"', 'value', 'text', $u_signup );

	//survey選單
	$setSurvey = array();
	$setSurvey[] = JHTML::_('select.option', 0, JText::_( 'PLEASE CHOICE' ) );
	$setSurvey[] = JHTML::_('select.option', 1, JText::_( 'INTIVE LETTER' ) );
	$setSurvey[] = JHTML::_('select.option', 2, JText::_( 'FRIEND OR COLLEAGUE' ) );
	$setSurvey[] = JHTML::_('select.option', 3, JText::_( 'OSSF NEWS PAPER' ) );
	$setSurvey[] = JHTML::_('select.option', 4, JText::_( 'OSSF RSS' ) );
	$setSurvey[] = JHTML::_('select.option', 5, JText::_( 'OSSF INFORTAION' ) );
	$setSurvey[] = JHTML::_('select.option', 6, JText::_( 'SURVEY ORDER' ) );
	$lists['survey']= JHTML::_('select.genericlist', $setSurvey, 'survey', 'size="1" class="inputbox" onchange="show(\'Eventlist\',\'survey_text\');"', 'value', 'text', $survey );

	//詢問葷素選單
	$sections_eat = array();
	$sections_eat[] = JHTML::_('select.option', 0, JText::_( 'PLEASE CHOICE' ), 'id', 'title' );
	$sections_eat[] = JHTML::_('select.option', '1', JText::_('MEAT AND FISH'), 'id', 'title');
	$sections_eat[] = JHTML::_('select.option', '2', JText::_('VEGETARIAN'), 'id', 'title');
	$sections_eat[] = JHTML::_('select.option', '3', JText::_('Take care of themselves'), 'id', 'title');
	$lists['reg_eat'] = JHTML::_('select.genericlist',  $sections_eat, 'reg_eat', 'class="inputbox" size="1" ', 'id', 'title', $reg_eat); 

	//email 欄位 readonly 若使用者登入時 email欄位強制readonly 
	if( $this->row->registra==3 || $this->row->registra==4 || $this->row->registra==5 ){$readonly='readonly';}
	
	// * 的標記 審核制會將所有的欄位加上 * 
	if( $this->row->audit == 'y' ){$audit_flag = '&nbsp;&nbsp;<b>*</b>';}

	//vip 欄位
	$vip_text=
	"<tr>".
		"<td class=semi2 align=right valign=top>VIP Code</td>".
		"<td class=semi4 >&nbsp;".
		"<input type=text name=vip_code size=30 maxlength=12 class=input value='$vip_code'><b>&nbsp;&nbsp;*</b><br>&nbsp;&nbsp;".
		"<span style=font-size:xx-small;>".JText::_('PNTC')."</span>&nbsp;&nbsp;<b>*</b>".
		"</td>".
	"</tr>";
	
	//問卷欄位
	if($this->row->survey=='y'){
		$survey="<tr>".
					"<td class=semi2 align=right width=20% bgcolor=#caf5b5>".JText::_('DISPLAY SURVEY')."</td>".
					"<td class=semi4 bgcolor=#caf5b5>&nbsp;".$lists['survey']."<input type=text id ='survey_text' style=display:$dis name='survey_text'  maxlength=20 class=input value='$survey_text'>&nbsp;<b>*</b></td>".
				"</tr>";
	}
	
	//葷素欄位
	if($this->row->reg_eat=='y'){
		$survey.="<tr>".
					"<td class=semi2 align=right width=20% bgcolor=#caf5b5>".JText::_('EAT SURVEY')."</td>".
					"<td class=semi4 bgcolor=#caf5b5>&nbsp;".$lists['reg_eat']."&nbsp;<b>*</b></td>".
				"</tr>";
	}
	
	//reg add 僅檢查vip code   reg add2 檢查表單
	if( $this->formhandler == 5 || $this->formhandler == 8 ){
		$vip_ins = $vip_text;
		$check = "reg_add();";
		$check_inBacked = 1;
	}else{
		$check = "reg_add2();";
		$check_inBacked = 0;
	}

//會員 報名
	$new_name = str_replace('-', ' ', $edit_name);
	$new_name = str_replace('.', ' ', $new_name);
	$new_name = explode(' ',$new_name);
	$new_name = implode('&nbsp;',$new_name);

	$reg_button="<tr>".
					"<td bgcolor=#caf5b5  COLSPAN=2 align=center>".
						"<input type=button id=el_send_attend name=el_send_attend value=".JText::_( 'EVENT REGISTRATION' )." onClick=".$check." />".
						"<input type=hidden name=check_vip value=".$check_inBacked." />".
						"<input type=hidden name=rdid value=".$this->row->did." />".
						"<input type=hidden name=task value=userregister />".
						"<input type=hidden name=full value=".$this->row->full." />".
						"<input type=hidden name=candidate value=".$this->row->candidate." />".
						"<input type=hidden name=sw_vip value=".$this->row->registra." />".
					"</td>".
				"</tr>";
			
	$join_RU = 
	"<form id=Eventlist name=Eventlist action=".JRoute::_('index.php')." method=post>".

	"<div class=moduletable-hilite5><a neme='reg'></a>".

		"<h3 class=register>".JText::_('CLICK REGISTRATION')."</h3>".
		"<table cellspacing=1 cellpadding=4 border=0 width=100% id=tab align=center>".
			"<tr>".
				"<td class=semi2 colspan=2></td>".
			"</tr>".$vip_ins.
			"<tr>". 
				"<td class=semi2 align=right width=20%>".JText::_('NAME')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=u_name size=30 class=input value=".$new_name."><b>&nbsp;&nbsp;*</b></td>".
			"</tr>".
			"<tr>".
				"<td class=semi2 align=right width=20%>".JText::_('EMAIL')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=u_email size=30 class=input value='".$u_email."' $readonly><b>&nbsp;&nbsp;*</b></td>".
			"</tr>".
			"<tr>". 
				"<td class=semi2 align=right width=20%>".JText::_('COMMUNITY')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=community size=30  maxlength=100 class=input value=".$community." ><b>&nbsp;&nbsp;</b></td>".
			"</tr>".
			"<tr>". 
				"<td class=semi2 align=right width=20%>".JText::_('COMPANY')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=u_company size=30 maxlength=30 class=input value=".$u_company.">$audit_flag</td>".
			"</tr>".
			"<tr>". 
				"<td class=semi2 align=right width=20%>".JText::_('DEPARTMENT')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=u_captaincy0 size=30 maxlength=20 class=input value=".$u_captaincy0."></td>".
			"</tr>".
			"<tr>".
				"<td class=semi2 align=right width=20%>".JText::_('JOBTITLE')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=u_captaincy1 size=30 maxlength=20 class=input value=".$u_captaincy1.">$audit_flag</td>".
			"</tr>".
			"<tr>". 
				"<td class=semi2 align=right width=20%>".JText::_('PHONE')."</td>".
				"<td class=semi4>&nbsp;<input type=text name=u_tel size=30 maxlength=20 class=input value=".$u_tel.">$audit_flag</td>".
			"</tr>".
				"<input type=hidden name=u_addr size=30 maxlength=60 class=input >".
			"<tr>". 
				"<td class=semi4 width=23% align=right bgcolor=#caf5b4 >".'&nbsp;'.JText::_('UCA')."</td>".
				"<td class=semi2 bgcolor=#caf5b5>&nbsp;".
					"<input type=hidden name=u_sex value='null'>".$lists['signup'].'&nbsp;'.JText::_('FON')."(<a target=_blank href=http://www.openfoundry.org/previous-issue>".JText::_('DETAILS')."</a>)".
		"&nbsp;<b>*</b></tr>"."$survey".$reg_button.JHTML::_( 'form.token' ).
		"</table>".
	"</div>".
	"</form>";

//取消報名所用的參數
	if($ch_login!=0){
		$ch_email	= $this->u_join->u_email;
		$reg_sn 	= $this->u_join->reg_sn;
		$sn_text 	= "<input type=hidden name=reg_sn value=$reg_sn />";
	}else if($ch_login==0){
		$sn_text =	"<H4>".JText::_('PESN')."</H4>"."<br>".JText::_('REG_SN').":".
					"<input type=text size=23 name=reg_sn value='' >";
					
		$leave_session = $session->get("leave_info");
		
		if( count( $leave_session > 0 ) ){
			$reg_sn		=	$leave_session['reg_sn'];
			$ch_email	=	$leave_session['ch_email'];
			$session->clear("leave_info");
		}
	}

	//取消報名表單
	$cancel_user_loginNR=
	"<div class=moduletable-hilite5><a name=cancel></a>".
	"<form id=Eventlist2 name=Eventlist2 action=".JRoute::_('index.php')." method=post>".
		"<h3>".JText::_('CANCELREG')."</h3><a name=cancel></a>".
		"<table cellspacing=0 cellpadding=0 border=0 width=100% align=center id=tab>".
			"<tr align=center >".
				"<td>".
					$sn_text.
					JText::_('EMAIL').":".
					"<input type=text size=23 name=ch_email value=".$ch_email." >".
				"</td>".
			"</tr>".
			"<tr align=center>".
				"<td>".
					"<input type=checkbox name=reg_check onclick=check(this,document.getElementById('el_send_attend2')) />".
					JText::_('IMCANCELREG').
					"<input type=button id='el_send_attend2' name='el_send_attend2' value=".JText::_( 'ENTERUNREGISTER' )." onClick=reg_cancel() disabled=disabled  />".
				"</td>".
			"</tr>".
			"<tr>".
				"<td align=center>".
					"<input type=hidden name=registra value=".$this->row->registra.">".
					"<input type=hidden name=reg_id value=".$this->row->did.">".
					"<input type=hidden name=action value=in>".
					"<input type=hidden size = 40 name=note value=\"Online canceled\" >".
					"<input type=hidden name=rdid value=".$this->row->did." />".
					"<input type=hidden name=task value=delreguser />".
				"</td>".JHTML::_( 'form.token' ).
			"</tr>".
		"</table>".
	"</form>".
	"</div>";


?>

<script language=JavaScript>

	function display(y){
		$(y).style.display=($(y).style.display=="none")?"":"none";
	} 

	function $(s){
		return document.getElementById(s);
	} 

	function check(checkbox, senden) {
		if(checkbox.checked==true){
			senden.disabled = false;
		} else {
			senden.disabled = true;
		}
	}

	function reg_add(){	//驗證有vip欄位的報名表單
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var re ="\/'\"\.<>=";
		var j=0;
		var m=new Array();
		var error;
		var msg=document.Eventlist.vip_code.value;

		if( navigator.cookieEnabled == 0){
			alert('<?php echo JText::_('PLEASE ENABLED COOKIE');?>');
			return false;
		}
		
		for(i=0;i<=11;i++)
		m[i+1]=msg.substr(i,1);

		switch(m[1])
		{
			case "A":   m[1]=0  ;   break;
			case "B":   m[1]=4  ;   break;
			case "C":   m[1]=2  ;   break;
			case "D":   m[1]=4  ;   break;
			case "E":   m[1]=6  ;   break;
			case "F":   m[1]=8  ;   break;
			case "G":   m[1]=0  ;   break;
			case "H":   m[1]=2  ;   break;
			case "I":   m[1]=4  ;   break;
			default :   error=0 ;
		}

		switch(m[12])
		{
			case "Z":   m[12]=8 ;   break;
			case "Y":   m[12]=6 ;   break;
			case "X":   m[12]=10;   break;
			case "U":   m[12]=2 ;   break;
			case "V":   m[12]=2 ;   break;
			case "W":   m[12]=10;   break;
			case "S":   m[12]=4 ;   break;
			case "R":   m[12]=2 ;   break;
			case "T":   m[12]=6 ;   break;
			case "H":   m[12]=10;   break;
			case "P":   m[12]=10;   break;
			case "L":   m[12]=2 ;   break;
			default :   error=0;
		}

		switch(m[8])
		{
			case "A":   m[8]=1  ;   break;
			case "B":   m[8]=10 ;   break;
			case "C":   m[8]=19 ;   break;
			case "D":   m[8]=28 ;   break;
			case "E":   m[8]=37 ;   break;
			case "F":   m[8]=46 ;   break;
			case "G":   m[8]=55 ;   break;
			case "H":   m[8]=64 ;   break;  
			case "I":   m[8]=39 ;   break;
			case "J":   m[8]=73 ;   break;
			case "K":   m[8]=82 ;   break;
			case "L":   m[8]=2  ;   break;
			case "M":   m[8]=11 ;   break;
			case "N":   m[8]=20 ;   break;
			case "O":   m[8]=48 ;   break;
			case "P":   m[8]=29 ;   break;  
			case "Q":   m[8]=38 ;   break;
			case "R":   m[8]=47 ;   break;
			case "S":   m[8]=56 ;   break;
			case "T":   m[8]=65 ;   break;
			case "U":   m[8]=74 ;   break;
			case "V":   m[8]=83 ;   break;
			case "W":   m[8]=21 ;   break;
			case "X":   m[8]=3  ;   break;
			case "Y":   m[8]=12 ;   break;
			case "Z":   m[8]=30 ;   break;  
			default :   error=0 ;
		}

		if(msg.length!=12){
			alert('<?php echo JText::_('VIP CODEERROR');?>');
			return false;
		}

		var sum=m[8]+m[5]*8+m[6]*7+m[7]*6+m[2]*5+m[3]*4+m[4]*3+m[9]*2+parseInt(m[10])+parseInt(m[11]);
		var sum2=m[1]+m[12];

		if(sum2%2==0){
			if(sum%10!=0){
				alert('<?php echo JText::_('VIP CODEERROR');?>');
				return false;
			}   
		}else{
			alert('<?php echo JText::_('VIP CODEERROR');?>');
			return false;
		}

	   reg_add2();

	}

	function reg_add2(){ //驗證無vip欄位的報名表單
	
		uname		= document.Eventlist.u_name.value;
		umail		= document.Eventlist.u_email.value;
		usignup		= document.Eventlist.u_signup.value;
		utel 		= document.Eventlist.u_tel.value;
		ucommunity	= document.Eventlist.community.value;
		ucompany	= document.Eventlist.u_company.value;
		ucaptaincy0 = document.Eventlist.u_captaincy0.value;
		ucaptaincy1 = document.Eventlist.u_captaincy1.value;
		uaddr		= document.Eventlist.u_addr.value;
		
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var re ="\/'\"\.<>=";
		var j=0;
		var error;
		
		if( navigator.cookieEnabled == 0){
			alert('<?php echo JText::_('PLEASE ENABLED COOKIE');?>');
			return false;
		}

		for(var j=0;j<re.length;j++){

			if(uname.indexOf(re.substring(j,j+1))!=-1){ 
				alert('<?php echo JText::_('SSF');?>');
				return false;
			}

			if(ucaptaincy0.indexOf(re.substring(j,j+1))!=-1){ 
				alert('<?php echo JText::_('SSF');?>');
				return false;
			}

			if(ucommunity!=""){ 
				if(ucommunity.indexOf(re.substring(j,j+1))!=-1){ 
					alert('<?php echo JText::_('SSF');?>');
					return false;
				}
			}

			if(ucompany.indexOf(re.substring(j,j+1))!=-1){ 
				alert('<?php echo JText::_('SSF');?>');
				return false;
			}

			if(ucaptaincy1.indexOf(re.substring(j,j+1))!=-1){ 
				alert('<?php echo JText::_('SSF');?>');
				return false;
			}

			if(uaddr.indexOf(re.substring(j,j+1))!=-1){ 
				alert('<?php echo JText::_('SSF');?>');
				return false;
			}
			
			if(utel.indexOf(re.substring(j,j+1))!=-1){ 
				alert('<?php echo JText::_('SSF');?>');
				return false;
			}
<?php if($this->row->survey=='y'){?>
			if(document.Eventlist.survey.value == 6 && document.Eventlist.survey_text.value =='' ){
				if(survey_text.indexOf(re.substring(j,j+1))!=-1){
					alert('<?php echo Jtext::_('SSF');?>');
					return false;
				}
			}
<?php }?>
		}
	   
	   if(uname == ''){
			alert('<?php echo JText::_('INSERT NAME');?>');
			return false;
	   }
	   
	   if(umail == ''){
			alert('<?php echo JText::_('INSERT EMAIL');?>');
			return false;
	   }
	   
	<?php if($this->row->audit=='y'){ ?>
		if(document.Eventlist.u_company.value =='' ){
			alert('<?php echo Jtext::_('INSERT CONPANY');?>');
			return false;
		}
		if(document.Eventlist.u_captaincy1.value =='' ){
			alert('<?php echo Jtext::_('INSERT CAPTAINCY TITLE');?>');
			return false;
		}
		if(document.Eventlist.u_tel.value =='' ){
			alert('<?php echo Jtext::_('INSERT PHONE');?>');
			return false;
		}

	<?php } ?>

		if(usignup==0){ 
			alert('<?php echo JText::_('PLEASE SET NEWSLETTER');?>');
			return false;
		}
		
	<?php if($this->row->survey=='y'){?>
		if(!document.Eventlist.survey.value || document.Eventlist.survey.value == 0){
			alert('<?php echo JText::_('PLEASE CHOICE SURVEY');?>');
			return false;
		}

		if(document.Eventlist.survey.value == 6 && document.Eventlist.survey_text.value =='' ){
			alert('<?php echo JText::_('PLEASE INSERT SURVEY TEXT');?>');
			return false;		
		}
	<?php }?>

	<?php if($this->row->reg_eat == 'y'){?>
		if(!document.Eventlist.reg_eat.value || document.Eventlist.reg_eat.value == 0){
			alert('<?php echo JText::_('PLEASE CHOOISE REG EAT');?>');
			return false;
		}
	<?php }?>

		if(filter.test(umail)){
			document.Eventlist.submit();
		}else{
			alert('<?php echo JText::_('INCORRECT EMAIL');?>');
			return false; 
		}
	}

	function reg_cancel()
	{
		reg_sn   = document.Eventlist2.reg_sn.value;
		ch_email = document.Eventlist2.ch_email.value;
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var re ="\/'\"\.<>";
		var j=0;
		var error;

		if(reg_sn.length != 4){
			alert('<?php echo JText::_('SN ERROR');?>');
			return false;
		}

		if(reg_sn == ''){
			alert('<?php echo JText::_('INSERT REG_SN');?>');
			return false;
		}
	   
		if(ch_email == ''){
			alert('<?php echo JText::_('INSERT EMAIL');?>');
			return false;
		}
	   
		if(filter.test(ch_email)){
			document.Eventlist2.submit();
		}else{
			alert('<?php echo JText::_('INCORRECT EMAIL');?>');
			return false; 
		}
	   
		document.Eventlist2.submit();
	}

	function reg_cancelForm()
	{
		reg_sn   = document.Eventlist.reg_sn.value;
		ch_email = document.Eventlist.ch_email.value;
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var re ="\/'\"\.<>=";
		var j=0;
		var error;

		if(reg_sn.length != 4){
			alert('<?php echo JText::_('SN ERROR');?>');
			return false;
		}

		if(reg_sn == ''){
			alert('<?php echo JText::_('INSERT reg_sn');?>');
			return false;
		}
	   
		if(ch_email == ''){
			alert('<?php echo JText::_('INSERT EMAIL');?>');
			return false;
		}
	   
		if(filter.test(ch_email)){
			document.Eventlist.submit();
		}else{
			alert('<?php echo JText::_('INCORRECT EMAIL');?>');
			return false; 
		}
		document.Eventlist.submit();
	}

	function show(obj,item){
		if(document.Eventlist.survey.value ==6){
			document.getElementById(item).style.display = '';
		}else{
			document.getElementById(item).style.display = 'none';
		}
	}
</script>

</ul>

<?php
if( $this->row->registra == 0 ){
	$this->formhandler = 0;
}

//print_r($this->row->reg_eat);exit;
$linkreg = "<a name='reg'></a>";
//$join_user_NR=$linkreg.$join_user_NR;
$join_RU=$linkreg.$join_RU;
/*
print_r('</br>formhandler='.$this->formhandler);
print_r('</br>check_back='.$check_inBacked."</br>");
print_r('id='.$this->row->did."</br>");
print_r('full='.$this->row->full."</br>");
print_r('candidate='.$this->row->candidate."</br>");
print_r('registra='.$this->row->registra."</br>");
$ya=array();
$ya[] = '活動結束';
$ya[] = '活動結束';
$ya[] = '檢查登入';
$ya[] = '取消頁面';
$ya[] = 'open頁面';
$ya[] = 'vip頁面';
$ya[] = '系統自動關閉';
$ya[] = 'open 非會員';
$ya[] = 'vip 非會員';
$ya[] = '尚未開放';
print_r('活動顯示頁面：'.$ya[$this->formhandler].'formhandler</br>');
print_r($this->u_join->ch_mail.'ch_mail</br>');
print_r($this->u_join->ch_join.'ch_join</br>');
print_r($this->u_join->cancel_mail .'cancel_mail</br>');
*/

switch ($this->formhandler) {

	case 0:
	//報名截止(後台設定)
		//echo "<br><h1><font color='#277BC0'><center>".JText::_( 'TOO LATE REGISTER' )."</cnter></font></h1><br>";
	break;
		
	case 1:
	//報名截止(報名額滿)
		echo "<br><h1><font color='#277BC0'><center>".JText::_( 'TOO LATE REGISTER' )."</cnter></font></h1><br>";

		$jetzt = date("Y-m-d H:i:s");
		$now = strtotime($jetzt);
		$date = strtotime(date($this->row->signupEnddate.' '.$this->row->signupEndtime));
		$timecheck = $date - $now;
		$eventTime = strtotime(date($this->row->dates.' '.$this->row->times));
		$timecheck_event = $eventTime - $now;
		//時間未到 報名人數額滿
		//無登入者 僅顯示取消報名表格
		//有登入者 若有加入 才顯示取消表格
	
		if($timecheck > 0 && $timecheck_event > 0){
			if( $ch_login==0 && $this->row->registra >=7 && $this->row->registra <=9 ){
				echo $cancel_user_loginNR;
			}
			if($ch_login > 0 && $this->u_join->ch_join == 'y' ){
				echo $cancel_user_loginNR;
			}
		}
	break;

	case 2:
	//登入才可報名
		echo "<h1 style='color:#277BC0;text-align:center;'>".JText::_( 'LOGIN FOR REGISTER' )."</h1>";
	break;

	case 3:
		//the user is allready registered. Let's check if he can unregister from the event
		if ($this->row->unregistra == 0) :
			//no he is not allowed to unregister
			echo JText::_( 'ALLREADY REGISTERED' );
		else:
			//he is allowed to unregister -> display form
			echo $cancel_user_loginNR;
		endif;
	break;

	case 4:
	//報名表單
		echo $join_RU;
	break;

	case 5:
	//報名表單含vip欄位
		echo $join_RU;
	break;
	
	case 6:
	//額滿
		echo JText::_( 'FULL REGISTER' );
	break;

	case 7:
	//非會員報名 ＋ 取消
		if( $this->u_join->ch_mail == 1 || $this->u_join->ch_mail == '' ){
			$print_joinT = 1;
		}
		if( $this->u_join->u_email !='' && $this->u_join->cancel_mail == 'y' ){
			$print_joinT = 1;
		}
		if( $print_joinT == 1 ){
			echo $join_RU;
		}  
		echo "<BR>".$cancel_user_loginNR;
	break;
	
	case 8:
	//非會員vip + 取消
		if( $this->u_join->ch_mail == 1 || $this->u_join->ch_mail == '' ){
			$print_joinT = 1;
		}
		if( $this->u_join->u_email !='' && $this->u_join->cancel_mail == 'y' ){
			$print_joinT = 1;
		}
		if( $print_joinT == 1 ){
			echo $join_RU;
		} 	
		
		echo "<BR>".$cancel_user_loginNR;
	break;
	
	case 9:
	//尚未開放報名
		$todayD		=strtotime(date("Y-m-d"));
		$todayT		= strtotime(date("H:i:s"));
		$start_day	= strtotime(date($this->row->open_date));
		$start_time	= strtotime(date($this->row->open_time));
		$exp_time = explode(':',$this->row->open_time);
 		$exp_date = explode('-',$this->row->open_date);
  		$exp_date = implode('/',$exp_date);
  		
		if( $todayD < $start_day ){
			if($_GET[lang]=='tw'){
				$output_time = $this->row->open_date." ".$exp_time[0].":".$exp_time[1];
			}
			if($_GET[lang]=='en'){
				$output_time = $exp_time[0].":".$exp_time[1].' '.JText::_( 'OPEN TIME MSG2' ).' '.$this->row->open_date;
			}
		}

		if( $todayT < $start_time ){
			if( $todayD >= $start_day ){   
				$output_time = $exp_time[0].":".$exp_time[1];
			}
		}

		if($_GET[lang]=='tw'){
			echo "<br><h1><font color='#277BC0'><center>".JText::_( 'OPEN TIME MSG1' ).' '.$output_time.' '.JText::_( 'OPEN TIME MSG2' )."</cnter></font></h1><br>";
		}
		if($_GET[lang]=='en'){
			echo "<br><h1><font color='#277BC0'><center>".JText::_( 'OPEN TIME MSG1' ).' '.$output_time.' '."</cnter></font></h1><br>";
		}
	break;
}
 


$reg_No=0;
$user_No=0;
$cla_div = "</div>";
$cla_div .= "<h2 class=register>".JText::_( 'REGISTERED USERS' ).':'."</h2>";
$cla_div .= "<div class=register>";
$num = 0;

foreach ($this->registers as $register) :

	if( $register->uid > 0 ){ 
		if( $this->row->audit=='y' && $register->reg_audit == '1' ){
			$reg_No = $reg_No + 1;  
		}
		if( $this->row->audit=='n'){
			$reg_No = $reg_No + 1;  
		}
	}
	if( $register->uid == 0 ){
		if( $this->row->audit=='y' && $register->reg_audit == '1' ){
			$user_No = $user_No + 1;
		}
		if( $this->row->audit=='n'){
			$user_No = $user_No + 1;
		}
	}

	$useravatar = JHTML::_('image.site', 'tn'.$register->avatar, 'images/comprofiler/', NULL, NULL, $register->name);
	$nouseravatar = JHTML::_('image.site', 'tnnophoto.jpg', 'components/com_comprofiler/images/english/', NULL, NULL, $register->name);

//以下為使用者列表 
//從後台的setting=>頁面細節=>報名中設定
//為原本的模式0 什麼都不做
	if ($this->elsettings->comunsolution == 1 && $this->elsettings->comunoption == 0){
		if($num == 0){
			echo $cla_div;
		}
		if($register->uid != 0){
			echo "<li><span class='username'><a href='".JRoute::_( 'index.php?option=com_comprofiler&amp;task=userProfile&amp;user='.$register->uid )."'>".$register->name." </a></span></li>";
			$num = $num +1;
		}
	}
	
//為原本的模式1 使用cb
	if ( $this->elsettings->comunsolution == 1 && $this->elsettings->comunoption == 1){
		if ($this->formhandler !=0 ) { 
			if(!empty($register->avatar)){
				echo "<li><a href='".JRoute::_('index.php?option=com_comprofiler&task=userProfile&user='.$register->uid )."'>".$useravatar."<span class='username'>".$register->name."</span></a></li>";
				$num = $num +1;
			//User has no avatar
			}else{
				echo "<li><a href='".JRoute::_( 'index.php?option=com_comprofiler&task=userProfile&user='.$register->uid )."'>".$nouseravatar."<span class='username'>".$register->name."</span></a></li>";
				$num = $num +1;
			}
		}
	}
endforeach;

if ($this->formhandler !=0 ) { 
//新增的模式2 使用openfoundry
	if( $this->elsettings->comunsolution == 2 ){
		echo "</div>";
?> 
		<h2 class="register" align="left"><?php echo JText::_( 'REGISTERED USERS' ).':'.$reg_No; ?></h2>
		<div class="register">
		<?php if($this->elsettings->comunoption == 0){ ?>
					<ul class="usertext floattext" style='text-align:center'>
		<?php }else{ ?>
					<ul class="user floattext" style='text-align:center'>
		<?php } ?>	
				<?php echo EventListModelDetails::user_viewM($this->registra,$this->row->audit);?>
			</ul>
		</div>

		<h2 class="register" align="left"><?php echo JText::_( 'OTHERS' ).':'.$user_No; ?></h2>
		<div class="register">
			<ul class="user floattext" style='text-align:left'>
			<?php echo EventListModelDetails::user_viewNM($this->registra,$this->row->audit);?>
<?php
	}
}
?>
