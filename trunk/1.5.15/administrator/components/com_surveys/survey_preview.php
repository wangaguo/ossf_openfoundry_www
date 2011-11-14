<?php
/*
 * $Id: <survey_preview,0.0.28 <version> 2007/01/10 hh:mm:ss <iJoomla Al> $
 *
 * @package iJoomla Surveys
 * @email webmaster@ijoomla.com
 *
 ** @copyright
 * ==================================================================== 
 * @copyright   (C) 2010 iJoomla, Inc. - All rights reserved.
 * @license  GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author  iJoomla.com <webmaster@ijoomla.com>
 * @url   http://www.ijoomla.com/licensing/
 * the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript  *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0 
 * More info at http://www.ijoomla.com/licensing/
 * ====================================================================
 * @endcopyright
 *
 * @file <survey_preview.php>
 * @brief <allows administrator to preview a survey>
 *
 * @functionlist
 * ====================================================================
 * function survey_header
 * function view_survey
 * function view_page
 * function ij_starttable
 * function ij_endtable
 * function view_open_answers
 * function view_dropdown_answers
 * function view_date_answers
 * function view_open_more_line
 * function view_checksum_answers
 * function view_vertical_answers
 * function view_horizontal_answers
 * function view_matrix_answers
 * function isequal
 * function hascommonpoint
 * function hasnotcommonpoint
 * function msg
 * function sess_process 
 * function text_wrapp
 * ====================================================================
 * @endfunctionlist
 * 
 * @history
 * ====================================================================
 * File creation date: 28/09/2006 16:14:30
 * Current file version: 0.0.28
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/11/2006
 * Modification: SURVEYS-74 code cleaned  
 *
 * Modified By: iJoomla Al
 * Modified Date: 22/11/2006
 * Modification: SURVEYS-101 view_open_more_line() function call fixed
 *
 * Modified By: 
 * Modified Date: 
 * Modification: 
 *
 * ====================================================================
 * @endhistory
 */
// ensure this file is being included by a parent file

//defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
define( '_JEXEC', 1 );

session_start();
error_reporting(E_ALL & ~E_NOTICE);

//include_once( '../../../globals.php' );
//require_once( '../../../configuration.php' );
//require_once( '../../../includes/joomla.php' );
require_once( JPATH_SITE."/administrator/components/com_surveys/surveys_config.php" );

if( is_file( JPATH_SITE ."/administrator/components/com_surveys/language/$mosConfig_lang.surveys.php")){
		@include_once( JPATH_SITE ."/administrator/components/com_surveys/language/$mosConfig_lang.surveys.php");
}else{
	include_once( JPATH_SITE ."/administrator/components/com_surveys/language/english.surveys.php" );
}

JRequest::setVar('css_page_name', $css_page_name);
JRequest::setVar('css_page_description', $css_page_description);
JRequest::setVar('css_survey_name', $css_survey_name);
JRequest::setVar('css_question', $css_question);
JRequest::setVar('css_question_description', $css_question_description);
JRequest::setVar('css_button', $css_button); 
JRequest::setVar('css_column_heading', $css_column_heading);
JRequest::setVar('css_table_row2', $css_table_row2);
JRequest::setVar('css_row_heading', $css_row_heading); 
JRequest::setVar('css_table_row1', $css_table_row1);
JRequest::setVar('css_survey_description', $css_survey_description);
JRequest::setVar('css_dropdownmenu', $css_dropdownmenu);
JRequest::setVar('css_answer', $css_answer); 
JRequest::setVar('css_checkbox', $css_checkbox);
JRequest::setVar('css_radiobutton', $css_radiobutton);
JRequest::setVar('css_inputbox', $css_inputbox);
JRequest::getVar('css_column_heading', $css_column_heading);
JRequest::getVar('css_row_heading', $css_row_heading);
JRequest::getVar('css_table_row1', $css_table_row1);
JRequest::getVar('css_table_row2', $css_table_row2);
JRequest::setVar('css_result_heading', $css_result_heading);
JRequest::setVar('css_totalbackground', $css_totalbackground);
JRequest::setVar('css_tablerow1', $css_tablerow1);
JRequest::setVar('css_tablerow2', $css_tablerow2);
JRequest::setVar('css_total_background', $css_total_background);


function survey_header(){
		global $mainframe;
		$database = &JFactory::getDBO();    
		$text = '
	<style type="text/css" media="screen">
		@import url('.$mainframe->getSiteURL().'/components/com_surveys/survey.css );
	</style>';

		echo $text;
		//$mainframe->addCustomHeadTag( $text );
}
survey_header();

$get_s_id         = JArrayHelper::getValue($_GET ,"s_id"         );
$get_page         = JArrayHelper::getValue($_GET ,"page"         );
$post_cpage       = JArrayHelper::getValue($_POST,"cpage"        );
$get_preview_start= JArrayHelper::getValue($_GET ,"preview_start");
$post_question    = JArrayHelper::getValue($_POST,"question"     );

// before the start of the preview we check for unfinished previews and clear session
if ($get_preview_start=="yes"){
	if (isset($_SESSION["survey"])){
		unset($_SESSION["survey"]);
	}
	if (isset($_SESSION["pre_page"])){
		unset($_SESSION["pre_page"]);
	}							
	if (isset($_SESSION["survey_id"])){
		unset($_SESSION["survey_id"]);
	}							
	if (isset($_SESSION["order"])){
		unset($_SESSION["order"]);
	}					
	if (isset($_SESSION["order_column"])){
		unset($_SESSION["order_column"]);
	}	    
}

if ($get_s_id!=""){
	$database = &JFactory::getDBO();
		$survey_id=$get_s_id;
		$database->setQuery("SELECT title FROM #__ijoomla_surveys_surveys WHERE s_id='$survey_id'");
		$survey_title=$database->loadResult();
		$survey_id_exist=1;
}else{ 
	$database = &JFactory::getDBO();
		$survey_title=JArrayHelper::getValue($_GET,'survey');
		$database->setQuery("SELECT s_id FROM #__ijoomla_surveys_surveys WHERE title='$survey_title'");
		$survey_id_exist=$database->getNumRows($database->query());
		$survey_id=$database->loadResult();

}

if ($survey_id_exist<1)
		die("Survey not existant");

// START EXECUTION
			
		if (JArrayHelper::getValue($_POST,'Submit')) {
				// SKIP LOGIC
				$database->setQuery("SELECT * FROM #__ijoomla_surveys_skip_logics WHERE s_id=".$survey_id." AND page_id=".intval($post_cpage)." AND published=1 ORDER BY ordering ASC");
					$database->query();    	    
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());	
			}    	    
						if ($database->getNumRows()>0) {
								$skiplogic=$database->loadAssocList();
								foreach ($skiplogic as $logic) {
										$answer_value=explode(",",$logic["a_id"]);
										if (isset($post_question[$logic["q_id"]]["answer"])&&is_array($post_question[$logic["q_id"]]["answer"])) {
												$q_type       =$post_question[$logic["q_id"]]["type"];
												$q_orientation=$post_question[$logic["q_id"]]["orientation"];                    
												if (($q_type=="radio"&&($q_orientation!="matrix"))||($q_type=="checkbox"&&$q_orientation!="matrix")){
														$data=$post_question[$logic["q_id"]]["answer"];
														foreach ($data as $a_id) {
																if (intval($a_id)>0) {
																		$a_ids[]=$a_id;
																}
														}                        
												}else{
														$data=$post_question[$logic["q_id"]]["answer"];
														foreach ($data as $a_id => $a_val) {
																if (intval($a_id)>0) {
																		$a_ids[]=$a_id;
																}
														}
												}
												if ($logic["compare"]=="equal") {
														if ($logic["logic"]=="AND") {
																if (isequal($answer_value,$a_ids)){ // Valid
																		if ($logic["action"]=='jump') {
																				$paget=$logic["page_target"];
																				break;
																		}
																		else { // SKIP
																				if (!isset($_SESSION["survey"])||!is_array($_SESSION["survey"])){
																						$_SESSION["survey"]=array();
																				}
																				if (!isset($_SESSION["survey"]["skip_page"])||!is_array($_SESSION["survey"]["skip_page"])){
																						$_SESSION["survey"]["skip_page"]=array();
																				}       
																				if (!in_array($logic["page_target"],$_SESSION["survey"]["skip_page"]))  {
																						array_push($_SESSION["survey"]["skip_page"],$logic["page_target"]);
																				}
																				$paget=intval($get_page);
																		}
																}
																else { // not valid
		
																		$paget=intval($get_page);
																}
														}
														else { // Logic = OR
																if (hascommonpoint($a_ids,$answer_value)) { // valid
		
																		if ($logic["action"]=='jump') {
																				$paget=$logic["page_target"];
																				break;
																		}
																		else { // SKIP
																				if (!isset($_SESSION["survey"])||!is_array($_SESSION["survey"])){
																						$_SESSION["survey"]=array();
																				}
																				if (!isset($_SESSION["survey"]["skip_page"])||!is_array($_SESSION["survey"]["skip_page"])){
																						$_SESSION["survey"]["skip_page"]=array();
																				}
																				if (!in_array($logic["page_target"],$_SESSION["survey"]["skip_page"]))  {
																						array_push($_SESSION["survey"]["skip_page"],$logic["page_target"]);
																				}
																				$paget=intval($get_page);
																		}
																}
																else { // not valid
		
																		$paget=intval($get_page);
																}
														}
												}
												else { // Logic Compare = Different
		
		
														if ($logic["logic"]=="AND") {
																if (!isequal($answer_value,$a_ids)){ // Valid
		
																		if ($logic["action"]=='jump') {
																				$paget=$logic["page_target"];
																				break;
																		}
																		else { // SKIP
																				if (!isset($_SESSION["survey"])||!is_array($_SESSION["survey"])){
																						$_SESSION["survey"]=array();
																				}
																				if (!isset($_SESSION["survey"]["skip_page"])||!is_array($_SESSION["survey"]["skip_page"])){
																						$_SESSION["survey"]["skip_page"]=array();
																				}    
																				if (!in_array($logic["page_target"],$_SESSION["survey"]["skip_page"]))  {                    
																						array_push($_SESSION["survey"]["skip_page"],$logic["page_target"]);
																				}
																				$paget=intval($get_page);
																		}
																}
																else { // not valid
		
																		$paget=intval($get_page);
																}
														}
														else {
																if (hasnotcommonpoint($a_ids,$answer_value)) { // valid
		
																		if ($logic["action"]=='jump') {
																				$paget=$logic["page_target"];
																				break;
																		}
																		else { // SKIP
																				if (!isset($_SESSION["survey"])||!is_array($_SESSION["survey"])){
																						$_SESSION["survey"]=array();
																				}
																				if (!isset($_SESSION["survey"]["skip_page"])||!is_array($_SESSION["survey"]["skip_page"])){
																						$_SESSION["survey"]["skip_page"]=array();
																				}     
																				if (!in_array($logic["page_target"],$_SESSION["survey"]["skip_page"]))  {                              
																						array_push($_SESSION["survey"]["skip_page"],$logic["page_target"]);
																				}
																				$paget=intval($get_page);
																		}
																}
																else { // not valid
		
																		$paget=intval($get_page);
																}
														}
												}
										}elseif (isset($post_question[$logic["q_id"]]["answer_text"])) {
												$q_type       =$post_question[$logic["q_id"]]["type"];
												$q_orientation=$post_question[$logic["q_id"]]["orientation"];
												// some questions type have only a field that has to be completed,
												if ((($q_type=="text"||$q_type=="textarea")&&$q_orientation=="dropdown")){
														if ($logic["action"]=='jump') {
																$paget=$logic["page_target"];
																break;
														}
														else { // SKIP
																if (!isset($_SESSION["survey"])||!is_array($_SESSION["survey"])){
																		$_SESSION["survey"]=array();
																}
																if (!isset($_SESSION["survey"]["skip_page"])||!is_array($_SESSION["survey"]["skip_page"])){
																		$_SESSION["survey"]["skip_page"]=array();
																}    
																if (!in_array($logic["page_target"],$_SESSION["survey"]["skip_page"]))  {        
																		array_push($_SESSION["survey"]["skip_page"],$logic["page_target"]);
																}
																$paget=intval($get_page);
														}
												}
										} 
								}
						}
				else  {
						$paget=intval($get_page);
				}
				if (isset($_SESSION['survey']['skip_page'])&&is_array($_SESSION['survey']['skip_page']))
						if (in_array($paget,$_SESSION['survey']['skip_page'])) {
							$id_list = implode(",",$_SESSION["survey"]["skip_page"]); 
							$database->setQuery("SELECT page_id FROM #__ijoomla_surveys_pages WHERE s_id=".$survey_id." AND page_id NOT IN ($id_list) AND ordering>=".intval(JArrayHelper::getValue($_POST,'ordering'))." AND page_id<>".intval($post_cpage)." ORDER BY ordering ASC LIMIT 1");
									$database->query();
							if ($database->getNumRows()<1){
								$paget=-1;
							}
							else 	{
									$paget=$database->loadResult();
							}
						}	
				sess_process(intval($paget),'next');   		
				view_survey($survey_id,$survey_title,$paget);
		}
		elseif (isset($_POST['Back'])) {	    
			sess_process(intval($get_page),'back');		
			view_survey($survey_id,$survey_title,intval($get_page));
		}
		else  {// start view survey			    
				view_survey($survey_id,$survey_title,intval($get_page));
		}

// END EXECUTION



// FUNCTIONS 


function view_survey($s_id,$s_title='',$page=0) {
	$my = &JFactory::getUser();
	
	$css_survey_name = JRequest::getVar('css_survey_name');
	$css_survey_description = JRequest::getVar('css_survey_description');
	
	
	$database = &JFactory::getDBO();
	$scriptlib='
					<script type="text/javascript"> 
					<!--
					var AlertText = "'._QUESTIONS_REQUIRED.' (*). \n\n";
					var form=document.view_survey;
					function setentered(field,fieldx,field_other) {
						if (fieldx.checked==null || fieldx.checked=="") field.value=0;
						else { 
								field.value=1;
								if (field_other!=""&&field_other!=null){
										var other_field_input =document.getElementsByName(field_other);
										if (other_field_input.length>0)
												other_field_input[0].value="";
								}
						}
					}
					function setentertext(field,ftext) {					    
						if (ftext!=""||ftext!=null) {
								field.value=1;
						}else {
								field.value=0;						
						}
					}
					function setsum(field,field1) {
						if (field.value!=""){
								field1.value=parseFloat(field.value);
								if (field1.value!="NaN"){
										field.value=field1.value;
								}
						}else {
								field1.value="";
						}	
					}
					function checkNumber(e, minLen, maxLen, minVal, maxVal, errorMsg) {
						var v = parseFloat(e.value);
						if (isNaN(v) || e.value.length < minLen || e.value.length > maxLen || v < minVal || v > maxVal) { 
							alert(errorMsg);
							e.focus();  return false; 
						} 
						else { return true; 
						}
					}
					function validate_required(field,alerttxt)	{
						with (field) {
							if (value==null||value=="")	  {alert(alerttxt); return false}
							else {return true}
						}
					}
					function setselected(field,fieldx,field_other) {
						if (fieldx.value==null || fieldx.value=="") field.value=0;
						else { 
								field.value=1;
								
								if (field_other!=""&&field_other!=null){
										var other_field_input =document.getElementsByName(field_other);
										if (other_field_input.length>0)
												other_field_input[0].value="";
								}
								
								var radio_field=document.getElementsByName(fieldx.name);
								if (radio_field.length>0)
										if (radio_field[1].checked!=false)
												radio_field[1].checked=false;
						}
					}
					function setselectedMatrix(field,fieldx) {
						if (fieldx.value==null || fieldx.value=="") field.value=0;
						else { 
								field.value=1;
						}
					}					
					function getfocus(id)	{
						document.getElementById("id"+id).focus()
					}
					function test_select(field,fieldx){
							var field_q=document.getElementsByName(fieldx);
							if (field_q.length>0){
								if (field_q[0].value==null || field_q[0].value=="") field.value=0;
								else { 
										field.value=1;					    
								}
								if (field_q[1].checked!=false)
										field_q[1].checked=false;
							}
					}
					function test_radios(field,fieldx,number){
							var field_q=document.getElementsByName(fieldx);
							if (field_q.length>0){
								if (field_q[0].value==null || field_q[0].value=="") field.value=0;
								else { 
										field.value=1;					    
								}
								if (field_q[number].checked!=false)
										field_q[number].checked=false;
							}

					}										
					function change_selected(select_name){
							var selected_input=document.getElementsByName(select_name);
							if (selected_input.length>0){
									if (selected_input[0].selectedIndex!=0)
											selected_input[0].selectedIndex=0;
								if (selected_input[1].checked!=true)
										selected_input[1].checked=true;    
							}
					}
					function change_checked(radio_name,number){
							var radios=document.getElementsByName(radio_name);
							radios[number].checked="true";
					}
					-->
					</script>';
	echo $scriptlib;
	
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_surveys WHERE s_id=$s_id");		
	$database->query();		
	$surveys=$database->loadAssocList();
	
	if (count($surveys)) {	
		
		$_SESSION["survey_id"]="$s_id";
		$survey_info=$surveys[0];

		// Editor usertype check			
		if ($survey_info["access"]>0) {
			if ($survey_info["access"]==1) {
				if ($my->id) {
						$access=true;
				}
				else {
						$access=false;
				}
			}
			else { if ($my->usertype) $access=true; else $access=false; }
		}
		else {
				$access=true;
		}
		
		if (!$access) 
		{
						echo "<tr><td align='left'><b>"._LOGIN_REQUIRED."</b></td></tr>";
			}

		ij_starttable("100%",stripslashes($survey_info["title"]),1,$css_survey_name);
		
		if (!$page) {
			echo "<tr>
				<td align='left' class='$css_survey_description'>";
			if ($survey_info["images"]) {global $mainframe;
			echo "<table align='left'><tr><td align='left' style='padding-right:10px;padding-bottom:10px'><img src='".$mainframe->getSiteURL()."/images/stories/".$survey_info["images"]."' border='0' /></td></tr></table>";
			}	
			echo "<span class='$css_survey_description'> ".str_replace("{mosimage}","",stripslashes($survey_info["description"]))."</span>";
			
			echo "</td>
			</tr>";
		}
		ij_endtable();
		if ($page==0)  {
			$database->setQuery("SELECT page_id FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND published=1 ORDER BY ordering ASC LIMIT 1");		
			$database->query();		
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());	
			}			
			if ($database->getNumRows()>0) {	
				$first_page=$database->loadAssocList();
				$first_page_info=$first_page[0];
				view_page($s_id,$s_title,intval($first_page_info["page_id"]));
			}
		}
		else {
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND page_id='$page' AND published=1 ");		
			$database->query();
			
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());	
			}
			if ($database->getNumRows()<1) {	
				// END PAGE 				
					if (isset($_SESSION["survey"])){
							unset($_SESSION["survey"]);
					}
					if (isset($_SESSION["pre_page"])){
							unset($_SESSION["pre_page"]);
					}							
					if (isset($_SESSION["survey_id"])){
							unset($_SESSION["survey_id"]);
					}							
					if (isset($_SESSION["order"])){
							unset($_SESSION["order"]);
					}					
					if (isset($_SESSION["order_column"])){
							unset($_SESSION["order_column"]);
					}					
											
					if ($survey_info["form_target"]=='Show end page'){
							ij_starttable("100%",$survey_info["end_page_title"]);
							echo "<tr><td width='100%' align='left'>".stripslashes($survey_info["end_page_description"])."</td></tr>";								
							if ($survey_info["show_result"]==1) {
								echo "<tr><td align='center' width='100%'>
								
									<input type='button' name='show_result' value='"._CLOSE_PREVIEW."' onClick='javascript: self.close ()' class='button'> 
									
								</td></tr>";
							}
							ij_endtable();
					}
					else {
							msg($survey_info["redirection_msg"],$survey_info["redirection_url"]);
					}	
			}
			else	view_page($s_id,$s_title,$page);
		
		
		}
	}
	else {
		die("Error ! This survey do not exist ");
	}
}

function view_page($s_id,$s_title='',$page_id) {
	global $mainframe;
	$my = &JFactory::getUser();	
	
	$css_page_name = JRequest::getVar('css_page_name');
	$css_page_description = JRequest::getVar('css_page_description');
	$css_button = JRequest::getVar('css_button');
	$css_question = JRequest::getVar('css_question');
	$css_question_description = JRequest::getVar('css_question_description');

	$database = &JFactory::getDBO();
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND page_id='$page_id' AND published=1");		
	$page=$database->loadAssocList();	
	
	if ($database->getErrorMsg()){
		die($database->getErrorMsg());		
	}
	$page_info=$page[0];
	$database->setQuery("SELECT page_id,ordering FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND page_id<>$page_id AND ordering >=".$page_info["ordering"]." AND published=1 ORDER BY ordering ASC LIMIT 1");		
	$database->query();	
		
	if ($database->getErrorMsg()){
		die($database->getErrorMsg());			
	}
	if ($database->getNumRows()>0) {
		list($nextpage,$order)=$database->loadRow();
		$target='?option=com_surveys&preview=preview&s_id='.$s_id.'&survey='.$s_title.'&page='.$nextpage;
	}
	else { 
		$nextpage=$page_info["page_id"]+10;
		$target='?option=com_surveys&preview=preview&s_id='.$s_id.'&survey='.$s_title.'&page='.$nextpage;
	}
		
	echo "<table width='100%'>";
	if ($page_info['show_title']){
			
			echo "<tr class='$css_page_name'><td >".stripslashes($page_info["title"])."</td></tr>";
			echo "<tr><td class='$css_page_description'>";
			if ($page_info["images"]) {
				echo "<table align='left'><tr><td align='left' style='padding-right:10px;padding-bottom:10px'><img src='".$mainframe->getSiteURL()."/images/stories/".$page_info["images"]."' /></td></tr></table>";
			}
			echo stripslashes($page_info["description"])."</td></tr>";
	}
		
	echo '<form id="view_survey" name="view_survey" method="post" action="'.$target.'">';
			
	$now=time();
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_questions WHERE s_id=$s_id  AND page_id=$page_id AND start_date<=$now AND end_date>=$now AND published=1 ORDER BY ordering ASC");		
	$database->query();	
			
	if ($database->getErrorMsg()){
		die($database->getErrorMsg());	
	}
	if ($database->getNumRows()>0) {
			$questions=$database->loadAssocList();	
			ij_starttable('100%',"");
					
			$script='<script type="text/javascript"> 
					<!--
					var form=document.view_survey;
					var AlertText = "'._QUESTIONS_REQUIRED.' (*). \n\n";
					function validate_form(thisform) {
						
						with (thisform) { ';
			echo '<form id="view_survey" name="view_survey" method="post" action="'.$target.'" onsubmit="return validate_form(this)">';	
			
			if (isset($_SESSION["survey"]["page_".$page_id])){
					$data=unserialize($_SESSION["survey"]["page_".$page_id]);
			}else{
					$data=null;
			}
					
			foreach ($questions as $question_info) {
				echo "<tr class='$css_question'><td ><span class='$css_question'>".$question_info["title"].'<a id="id'.$question_info["q_id"].'"></a>';
				if ($question_info["required"]==1) {
					 echo "<span style='color:red'>*</span>";
					 $required=1;
				}
				echo "</span></td></tr>";
				
				echo "<tr class='$css_question_description'><td>";
				echo "<span class='$css_question_description'>".stripslashes($question_info["description"])."</span>
				</td></tr>";
				echo "<tr><td>"; // Start view answer
				if ($question_info["random_a"]==1) {
						$order=" ORDER BY RAND()";
				}
				else {
						$order=" ORDER BY a_id ASC";
				}
				if ($question_info["random_c"]==1) {
						$orderC=" ORDER BY RAND()";
				}
				else {
						$orderC=" ORDER BY ac_id ASC";	
				}
				$dataq=array();
				if (isset($data[$question_info["q_id"]])&&is_array($data[$question_info["q_id"]])) {
					$dataq=$data[$question_info["q_id"]];
					if (!isset($dataq["answer"])||!is_array($dataq["answer"])) {
							$dataq["answer"]=array();
										}
				}
				else {
						$dataq["answer"]=array();
								}
				
				if ($question_info["orientation"]=="vertical") {
					
					view_vertical_answers($question_info["q_id"],$question_info["type"],$question_info["other_field"],$question_info["other_field_title"],$order,$dataq);
					if ($question_info["required"]==1) 
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars($question_info["title"]))."\"); 
						getfocus(".$question_info["q_id"].");
						return false;} ";
				}
				elseif ($question_info["orientation"]=="matrix") {
					view_matrix_answers($question_info["q_id"],$question_info["type"],$order,$orderC,$data[$question_info["q_id"]]);
					if ($question_info["required"]==1) 
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars($question_info["title"]))."\"); 
						getfocus(".$question_info["q_id"].");
						return false;}";
				}
				elseif ($question_info["orientation"]=="dropdown") {
					view_dropdown_answers($question_info["q_id"],$question_info["type"],$question_info["other_field"],$question_info["other_field_title"],$order,$dataq);
					if ($question_info["required"]==1) 
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars($question_info["title"]))."\"); 
						getfocus(".$question_info["q_id"].");
						return false;}";
				}
				elseif ($question_info["orientation"]=="horizontal") {
					
					view_horizontal_answers($question_info["q_id"],$question_info["type"],$order,$dataq);
					if ($question_info["required"]==1) 
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars($question_info["title"]))."\");
					 getfocus(".$question_info["q_id"].");
					 return false;}";
				}
				elseif ($question_info["orientation"]=='open') {
					if ($question_info["type"]=='constant') {
						
						view_checksum_answers($question_info["q_id"],$order,$question_info["required"],$question_info["constant"],$script,$dataq,$question_info["bounded"],$question_info["minvalue"],$question_info["maxvalue"]);
						echo "<input type='hidden' name='qconstant".$question_info["q_id"]."' value='".$question_info["constant"]."'/>";	
						echo "<input type='hidden' name='qconstantcache".$question_info["q_id"]."' value=''/>";					
									
					}
					elseif ($question_info["type"]=='datetime') {
						if ($question_info["required"]==1) 
							$script.="	var rq".$question_info["q_id"]."='required';";
						else $script.="	var rq".$question_info["q_id"]."='none';";
						view_date_answers($question_info["q_id"],$order,$script,$data[$question_info["q_id"]]);
						echo "<input type='hidden' name='q".$question_info["q_id"]."' value='0'/>";
						
					}
					elseif ($question_info["type"]=='moreline') {
						view_open_more_line($question_info["q_id"],$order,$script,$question_info["required"],$dataq);
						
					}
					else {
						view_open_answers($question_info["q_id"],$question_info["type"],$dataq);
						if ($question_info["required"]==1) 
							$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars($question_info["title"]))."\"); 
						 getfocus(".$question_info["q_id"].");
						 return false;}";
					}
				}
				$entered="";
				if (isset($data[$question_info["q_id"]])&&is_array($data[$question_info["q_id"]])){
						$entered="1";
								}
				if (isset($data[$question_info["q_id"]]["answer_text"])){
						$text=$data[$question_info["q_id"]]["answer_text"];
				}
				else {
						$text="";    
				}
				echo "<input type='hidden' name='q".$question_info["q_id"]."' value='$entered'/>
						<input type='hidden' name='qtext".$question_info["q_id"]."' value='$text'/>";
				echo "<br /></td></tr>";
				
				
			}
			
			$script.="
					
				}  // END WITH THIS FORM
			} // END FUNTION VALIDATE FORM
			-->
			</script>
			";
			
	}
		echo '<tr><td align="center">';
		
			if (isset($_SESSION["pre_page"][$page_info["page_id"]])&&intval($_SESSION["pre_page"][$page_info["page_id"]])>0) {
				//$targetprev=$homelink.'?survey='.$s_title.'&page='.$_SESSION['pre_page'][$page_info["page_id"]];
				
				echo  '<input type="submit" name="Back" value="'._BACK_BTN.'" class="'.$css_button.'" onclick="form.action=\''.$targetprev.'\';" /> &nbsp;';
			}
		
			
			echo '
				<input type="hidden" name="cpage" value="'.$page_info["page_id"].'">
				<input type="hidden" name="ordering" value="'.$page_info["ordering"].'">
				<input type="submit" name="Submit" value="'._NEXT_BTN.'" class="'.$css_button.'"  onclick="return validate_form(form)"/>
					</td></tr>';
			echo '</form>';
			ij_endtable();
			if (isset($script)){
						echo $script;	
			}
	
}

function ij_starttable($width = '-1', $title='', $title_colspan='1', $class = '', $date = '') {

	$title = stripslashes($title);
	
	global $CONFIG_EXT;

	if ($width == '-1' | $width == '100%' ) $width = "100%";

	if (!empty($class)) {
	echo <<<EOT

<!-- Start standard table -->
<table align="center" width="$width" cellspacing="0" cellpadding="0" class="$class">

EOT;
	} else {
	echo <<<EOT
	
<!-- Start standard table -->
<table align="center" width="$width" cellspacing="0" cellpadding="0" class="maintable">

EOT;
	}
	
	if ($title) {
	echo <<<EOT
	<tr>
		<td class="tableh1" colspan="$title_colspan">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td class='$class'>$title</td>
EOT;
		if ($date) {
	echo <<<EOT
					<td align="right" >$date</td>
EOT;
		}
	echo <<<EOT
				</tr>
			</table>
		</td>
	</tr>

EOT;
	}
}
function ij_endtable()
{
	echo <<<EOT
</table>
<!-- End standard table -->

EOT;
}

function view_open_answers($q_id,$type='text',$data=null) {
	
	echo "<table width='100%'><tr><td align='left' valign='top'>
			
			<input type='hidden' name='question[$q_id][type]' value='$type'>
			<input type='hidden' name='question[$q_id][orientation]' value='dropdown'>
		";
	if (!isset($data["answer_text"])){
			$data["answer_text"]=null;
	}
	if ($type=='textarea') {
		echo '<textarea name="question['.$q_id.'][answer_text]" cols="35" rows="5" onchange="setentertext(form.q'.$q_id.',this)" >'.stripslashes($data["answer_text"]).'</textarea>';
	}
	else 	{
		echo '<input name="question['.$q_id.'][answer_text]" type="text" id="question['.$q_id.'][answer_text]" size="35" value="'.$data["answer_text"].'" maxlength="250" onchange="setentertext(form.q'.$q_id.',this)" />';
	}
			
	echo "</td></tr></table>";
}
function view_dropdown_answers($q_id,$type="radio",$other_field=0,$other_field_title="",$order,$data=null){
	$database = &JFactory::getDBO();
	
	$css_dropdownmenu 	= JRequest::getVar('css_dropdownmenu');
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox	 	= JRequest::getVar('css_checkbox');
	$css_radiobutton 	= JRequest::getVar('css_radiobutton');
	
	$css=$type=='radio'?$css_radiobutton:$css_checkbox;	
	if (!isset($_SESSION["order"][$q_id])){
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
			$database->query();	
		if ($database->getErrorMsg()){
			die($database->getErrorMsg());	
		}    		
			echo "<table width='100%'>";
			if ($database->getNumRows()>0) {
				$answers=$database->loadAssocList();
				$i=0;
				$selected="";
				if (isset($data["answer"][$i])&&$data["answer"][$i]==''){
						$selected="selected";
				}
				echo "<tr><td >
							<input type='hidden' name='question[$q_id][type]' value='$type'>
							<input type='hidden' name='question[$q_id][orientation]' value='dropdown'>
							<select name='question[$q_id][answer][]' onchange='setselected(q$q_id,this,\"question[$q_id][answer_text]\")' class='$css_dropdownmenu'>
							<option value='' $selected >"._PLEASE_SELECT."</option>";
					if ($order !=""){
							$load_order=true;
								$_SESSION["order"][$q_id]=array();
						}		
				foreach ($answers as $answer_info) {
						 if ($load_order){
										 array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
								 }
					 $selected=in_array($answer_info["a_id"],$data["answer"])?"Selected":"";
					 echo "   <option value='".$answer_info["a_id"]."' $selected >".stripslashes($answer_info["value"])."</option>";
					 $i++;
				}
						 echo "</select>";
				echo "</td></tr>";
			}
	}else{
					echo "<table width='100%'>";    	
				echo "<tr><td >
							<input type='hidden' name='question[$q_id][type]' value='$type'>
							<input type='hidden' name='question[$q_id][orientation]' value='dropdown'>
							<select name='question[$q_id][answer][]' onchange='setselected(q$q_id,this,\"question[$q_id][answer_text]\")' class='$css_dropdownmenu'>
							<option value='' >"._PLEASE_SELECT."</option>";
				$i=0;
				foreach ($_SESSION["order"][$q_id] as $a_id) {   		
						 $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
						 $database->query();
					 if ($database->getErrorMsg()){
						 die($database->getErrorMsg());	
					 }    		     
							 $answers=$database->loadAssocList();   		         
							 $answer_info=$answers[0];
							 $selected=$data["answer"][$i]==''?"selected":"";
						
					 $selected=in_array($answer_info["a_id"],$data["answer"])?"Selected":"";
					 echo "   <option value='".$answer_info["a_id"]."' $selected >".stripslashes($answer_info["value"])."</option>";
					 $i++;
				}
						 echo "</select>";
				echo "</td></tr>";
	}
	if (!isset($data["answer_text"])){
			$data["answer_text"]=null;
	}
	if ($other_field!=0) {
			echo "<tr><td class='$css_answer'><input name='question[$q_id][answer][]' type='$type' class='$css'/>".text_wrapp(stripslashes($other_field_title),30,"<br />")."<br />";//qother_$q_id
			echo "<input name='question[$q_id][answer_text]' type='text' value='".$data["answer_text"]."' onkeyup='setentertext(form.q$q_id,this); if(this.value.length>0) {change_selected(\"question[$q_id][answer][]\",$i);} else {test_select(q$q_id,\"question[$q_id][answer][]\")};' />";
			echo "</td></tr>";
	}
	echo "</table>";
}
function view_date_answers($q_id,$order,&$script,$data=null) {
	
	$database = &JFactory::getDBO();
	
	$css_answer 		= JRequest::getVar('css_answer');
	$css_inputbox 		= JRequest::getVar('css_inputbox');
	
	if (!isset($_SESSION["order"][$q_id])){    	    
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
				if (!$database->query()){
						die("Error !Code 31: The process could not be finished due to internal error. Please contact the administrators");
				}    						
			echo "<table width='100%'>
			<tr>
				<td align='left'>
				<input type='hidden' name='question[$q_id][type]' value='datetime'>
				<input type='hidden' name='question[$q_id][orientation]' value='open'>
				</td>
				<td  align='left'>"._MM."</td>
				<td  align='left'>"._DD."</td>
				<td  align='left'>"._YYYY."</td>
			</tr>";
			if ($database->getNumRows()>0) {
				$answers=$database->loadAssocList();
				if ($order !=""){
						$load_order=true;
								$_SESSION["order"][$q_id]=array();
				}    		
				foreach ($answers as $answer_info) {
							if ($load_order){
									array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
							}    	
						if (isset($data["answer"][$answer_info["a_id"]])){
								$ans_value=$data["answer"][$answer_info["a_id"]];
						}else{
								$ans_value="";
								$ans_value["month"]="";
								$ans_value["day"]="";
								$ans_value["year"]="";
						}            		    
					echo "<tr><td class='$css_answer'>";
					echo text_wrapp(stripslashes($answer_info["value"]),30,"<br />");
					echo "</td>";
								
					echo "<td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."][month]' type='text' value='".$ans_value["month"]."' id='am".$answer_info["a_id"]."' size='4' class='$css_inputbox' />";
						
					echo "</td>";
								
					echo "<td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."][day]' type='text' value='".$ans_value["day"]."' id='ad".$answer_info["a_id"]."' size='4' class='$css_inputbox' />";
					echo "</td>";
					
					echo "<td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."][year]' type='text' value='".$ans_value["year"]."' id='ay".$answer_info["a_id"]."' o size='4' class='$css_inputbox' />";
					echo "</td>";    						
					
					echo "</tr>";
					/*$script.="
					if ((form.am".$answer_info["a_id"].".value!='' || form.ad".$answer_info["a_id"].".value!='' || form.ay".$answer_info["a_id"].".value!='' || rq$q_id=='required')) {
						if (checkNumber(form.am".$answer_info["a_id"].", 1, 2, 1, 12, '"._YOU_MUST_ENTER." "._THE_MONTH.". (1-12)') == false || checkNumber(form.ad".$answer_info["a_id"].", 1, 2, 1, 31, '"._YOU_MUST_ENTER." "._THE_DAY." (1-31)') == false || checkNumber(form.ay".$answer_info["a_id"].", 4, 4, 1971, 2038, '"._YOU_MUST_ENTER." "._THE_YEAR." (1971-2038)') == false ) {
							return false;
						}
					}";*/
					
					$script.="
					if ((form.am".$answer_info["a_id"].".value!='' || form.ad".$answer_info["a_id"].".value!='' || form.ay".$answer_info["a_id"].".value!='' || rq$q_id=='required')) {
						if (checkNumber(form.am".$answer_info["a_id"].", 1, 2, 1, 12, '"._YOU_MUST_ENTER." "._THE_MONTH.". (1-12)') == false || checkNumber(form.ad".$answer_info["a_id"].", 1, 2, 1, 31, '"._YOU_MUST_ENTER." "._THE_DAY." (1-31)') == false ) {
							return false;
						}
					}";
					
				}
			}
	}else{
			echo "<table width='100%'>
			<tr>
				<td  align='left'>
				<input type='hidden' name='question[$q_id][type]' value='datetime'>
				<input type='hidden' name='question[$q_id][orientation]' value='open'>
				</td>
				<td  align='left'>"._MM."</td>
				<td  align='left'>"._DD."</td>
				<td  align='left'>"._YYYY."</td>
			</tr>";
						foreach ($_SESSION["order"][$q_id] as $a_id) {
								$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
								if (!$database->query()){
										die("Error !Code 31: The process could not be finished due to internal error. Please contact the administrators");
								}                 
						$answers=$database->loadAssocList();  		    		
							$answer_info=$answers[0];
						if (isset($data["answer"][$answer_info["a_id"]])){
								$ans_value=$data["answer"][$answer_info["a_id"]];
						}else{
								$ans_value="";
								$ans_value["month"]="";
								$ans_value["day"]="";
								$ans_value["year"]="";
						}   		        
					echo "<tr><td class='$css_answer'>";
					echo text_wrapp(stripslashes($answer_info["value"]),30,"<br />");
					echo "</td>";
								
					echo "<td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."][month]' type='text' value='".$ans_value["month"]."' id='am".$answer_info["a_id"]."' size='4' class='$css_inputbox' />";
						
					echo "</td>";
								
					echo "<td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."][day]' type='text' value='".$ans_value["day"]."' id='ad".$answer_info["a_id"]."' size='4' class='$css_inputbox' />";
					echo "</td>";
					
					echo "<td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."][year]' type='text' value='".$ans_value["year"]."' id='ay".$answer_info["a_id"]."' o size='4' class='$css_inputbox' />";
					echo "</td>";
								
					echo "</tr>";
					/*$script.="if ((form.am".$answer_info["a_id"].".value!='' || form.ad".$answer_info["a_id"].".value!='' || form.ay".$answer_info["a_id"].".value!='' || rq$q_id=='required')) {
						if (checkNumber(form.am".$answer_info["a_id"].", 1, 2, 1, 12, '"._YOU_MUST_ENTER." "._THE_MONTH." (1-12)') == false || checkNumber(form.ad".$answer_info["a_id"].", 1, 2, 1, 31, '"._YOU_MUST_ENTER." "._THE_DAY." (1-31)') == false || checkNumber(form.ay".$answer_info["a_id"].", 4, 4, 1971, 2038, '"._YOU_MUST_ENTER." "._THE_YEAR." (1971-2038)') == false ) {
							return false;
						}
					}";*/
					
					$script.="if ((form.am".$answer_info["a_id"].".value!='' || form.ad".$answer_info["a_id"].".value!='' || form.ay".$answer_info["a_id"].".value!='' || rq$q_id=='required')) {
						if (checkNumber(form.am".$answer_info["a_id"].", 1, 2, 1, 12, '"._YOU_MUST_ENTER." "._THE_MONTH." (1-12)') == false || checkNumber(form.ad".$answer_info["a_id"].", 1, 2, 1, 31, '"._YOU_MUST_ENTER." "._THE_DAY." (1-31)') == false ) {
							return false;
						}
					}";
				}   
	}
	echo "</table>";
}
function view_open_more_line($q_id,$order,&$script,$required=0,$data){
	$database = &JFactory::getDBO();
	
	$css_answer 		= JRequest::getVar('css_answer');
	$css_inputbox 		= JRequest::getVar('css_inputbox');
	
	echo "<table width='100%'>";
	if (!isset($_SESSION["order"][$q_id])){	
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
			$database->query();
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());		
			}
			if ($database->getNumRows()>0) {
				$answers=$database->loadAssocList();
				if ($order !=""){
						$load_order=true;
							$_SESSION["order"][$q_id]=array();
				}    		
				foreach ($answers as $answer_info) {
							if ($load_order){
									array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
							}    		 
						if (isset($data["answer"][$answer_info["a_id"]])){
								$ans_value=$data["answer"][$answer_info["a_id"]];
						}else{
								$ans_value="";
						}            	   
					echo "<tr><td>";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>&nbsp;";
					echo "</td><td>";
					echo "<input id='a".$answer_info["a_id"]."' name='question[$q_id][answer][".$answer_info["a_id"]."]' type='text' value='".$ans_value."' class='$css_inputbox'/> &nbsp;";
					echo "</td></tr>";
					if ($required) 
					$script.="
					
							if (form.a".$answer_info["a_id"].".value.length==0) { alert(AlertText +\"".addslashes(htmlspecialchars($answer_info["value"]))."\"); 
								 
								 getfocus($q_id);
								 return false;}\n";
				}
			}
	}else{
			foreach ($_SESSION["order"][$q_id] as $a_id) {
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");		
							$database->query();
							if ($database->getErrorMsg()){
								die($database->getErrorMsg());
							}
						$answers=$database->loadAssocList();
						$answer_info=$answers[0];
						if (isset($data["answer"][$answer_info["a_id"]])){
								$ans_value=$data["answer"][$answer_info["a_id"]];
						}else{
								$ans_value="";
						}    		    
					echo "<tr><td>";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>&nbsp;";
					echo "</td><td>";
					echo "<input id='a".$answer_info["a_id"]."' name='question[$q_id][answer][".$answer_info["a_id"]."]' type='text' value='".$ans_value."' class='$css_inputbox'/> &nbsp;";
					echo "</td></tr>";
					if ($required) 
					$script.="
					
							if (form.a".$answer_info["a_id"].".value.length==0) { alert(AlertText +\"".addslashes(htmlspecialchars($answer_info["value"]))."\"); 
								 
								 getfocus($q_id);
								 return false;}\n";
			}	    
	}
	echo "<tr><td>
				<input type='hidden' name='question[$q_id][type]' value='moreline'>
				<input type='hidden' name='question[$q_id][orientation]' value='open'>
			</td></tr>";
	echo "</table>";
	
}
function view_checksum_answers($q_id,$order,$required,$constant,&$script,$data=null,$bounded=0,$minvalue=0,$maxvalue=0) {
	$database = &JFactory::getDBO();
	
	$css_answer 		= JRequest::getVar('css_answer');
	$css_inputbox 		= JRequest::getVar('css_inputbox');
	
	echo "<table width='100%'>";
	$script.="var checksum=0;
		checksum=0";
	if (!isset($_SESSION["order"][$q_id])){	
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
			$database->query();
		if ($database->getErrorMsg()){
			die($database->getErrorMsg());	
		}    	
			if ($database->getNumRows()>0) {
				$answers=$database->loadAssocList();
				$counter_extra_script=0;
				$counter_extra_script2=0;
				$extra_script_condition="";
				$extra_script_condition2="";    		
				$bounded_script_condition="";
				if ($order !=""){
						$load_order=true;
								$_SESSION["order"][$q_id]=array();
				}    		
				foreach ($answers as $answer_info) {	
							if ($load_order){
									array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
							}    		    
						$counter_extra_script++;
						$counter_extra_script2++;
						if (isset($data["answer"][$answer_info["a_id"]])){
								$ans_value=$data["answer"][$answer_info["a_id"]];
						}else{
								$ans_value="";
						}
								
					echo "<tr><td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."]' type='text' size='4' value='".$ans_value."' onchange='setsum(this,document.view_survey.a".$answer_info["a_id"].")' $css_inputbox /> &nbsp;";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>";
					echo "<input type='hidden' name='a".$answer_info["a_id"]."' id='".$answer_info["a_id"]."' value='".$ans_value."' />";
					echo "</td></tr>";
					$script.="+parseFloat(form.a".$answer_info["a_id"].".value)";
					if ($counter_extra_script==1){
							$extra_script_condition.="form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
					}
					else    {
							$extra_script_condition.=" || form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
					}
							
					if ($required==0){
							if ($counter_extra_script2==1){
									$extra_script_condition2.="form.a".$answer_info["a_id"].".value=='NaN'";
							}
							else {
									$extra_script_condition2.=" || form.a".$answer_info["a_id"].".value=='NaN'";
							}    			    
					}
										
					if ($bounded==1){
							if ($counter_extra_script==1)
									$bounded_script_condition.="form.a".$answer_info["a_id"].".value<$minvalue || form.a".$answer_info["a_id"].".value>$maxvalue";
							else    
									$bounded_script_condition.=" || form.a".$answer_info["a_id"].".value<$minvalue || form.a".$answer_info["a_id"].".value>$maxvalue";			    
					}
				}
			}
	}else{
				$counter_extra_script=0;
				$counter_extra_script2=0;
				$extra_script_condition="";
				$extra_script_condition2="";
				$bounded_script_condition="";
				foreach ($_SESSION["order"][$q_id] as $a_id) {	
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");		
							$database->query();
					if ($database->getErrorMsg()){
						die($database->getErrorMsg());	
					}    	        
						$answers=$database->loadAssocList();    		    
						$answer_info=$answers[0];
						$counter_extra_script++;
						$counter_extra_script2++;
						if (isset($data["answer"][$answer_info["a_id"]])){
								$ans_value=$data["answer"][$answer_info["a_id"]];
						}else{
								$ans_value="";
						}    		    
					echo "<tr><td>";
					echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."]' type='text' size='4' value='".$ans_value."' onchange='setsum(this,document.view_survey.a".$answer_info["a_id"].")' $css_inputbox /> &nbsp;";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>";
					echo "<input type='hidden' name='a".$answer_info["a_id"]."' id='".$answer_info["a_id"]."' value='".$ans_value."' />";
					echo "</td></tr>";
					$script.="+parseFloat(form.a".$answer_info["a_id"].".value)";
					if ($counter_extra_script==1){
							$extra_script_condition.="form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
					}
					else {
							$extra_script_condition.=" || form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
					}
							
					if ($required==0){
							if ($counter_extra_script2==1){
									$extra_script_condition2.="form.a".$answer_info["a_id"].".value=='NaN'";
							}
							else {
									$extra_script_condition2.=" || form.a".$answer_info["a_id"].".value=='NaN'";
							}    			    
					}
										
					if ($bounded==1){
							if ($counter_extra_script==1)
									$bounded_script_condition.="form.a".$answer_info["a_id"].".value<$minvalue || form.a".$answer_info["a_id"].".value>$maxvalue";
							else    
									$bounded_script_condition.=" || form.a".$answer_info["a_id"].".value<$minvalue || form.a".$answer_info["a_id"].".value>$maxvalue";			    
					}
				}
	}
	echo "<tr><td>
				<input type='hidden' name='question[$q_id][type]' value='constant'>
				<input type='hidden' name='question[$q_id][orientation]' value='open'>
			</td></tr>";
	echo "</table>";
	$script.=";";
	if ($bounded==1){
		if ($required!=0) {
				$script.="
								if ( $bounded_script_condition ){
								alert(AlertText +' "._THE_NUMBERS_IN_INTERVAL." ($minvalue,$maxvalue)'); 
								getfocus($q_id);
								return false;
									}";			
		}else{
				$script.="
								if ( $bounded_script_condition ){
								alert(' "._THE_NUMBERS_IN_INTERVAL." ($minvalue,$maxvalue)'); 
								getfocus($q_id);
								return false;
									}";			
		}
	}
	if ($required!=0) {
		if ($constant!=0) {
			$script.="
				if (checksum!=$constant) 	{
					alert(AlertText +' "._CHOICES_MUST_ADD_UP." $constant .' + '"._THEY_ADD_UP_TO." ' + checksum ); 
					getfocus($q_id);
					return false;
				}";
		}
		else {
			$script.="
							if ( $extra_script_condition ){
							alert(AlertText +' "._CHOICES_MUST_BE_NUMBERS."'); 
							getfocus($q_id);
							return false;
								}";
		}
	}else{	
			$script.="
							if ( $extra_script_condition2 ){
							alert(' "._CHOICES_MUST_BE_NUMBERS."'); 
							getfocus($q_id);
							return false;
								}";	    
		}
	
}
function view_vertical_answers($q_id,$type="radio",$other_field=0,$other_field_title="",$order,$data=null){
	$database = &JFactory::getDBO();
	
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 		= JRequest::getVar('css_radiobutton');
	$css_inputbox 		= JRequest::getVar('css_inputbox');
	
	$css=$type=='radio'?$css_radiobutton:$css_checkbox;	
	if (!isset($_SESSION["order"][$q_id])){
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
			$database->query();	
		if ($database->getErrorMsg()){
			die($database->getErrorMsg());	
		}    	
			echo "<table width='100%'>";
			if ($database->getNumRows()>0) {
				$answers=$database->loadAssocList();
				$i=0;
				if ($order !=""){
						$load_order=true;
								$_SESSION["order"][$q_id]=array();
				}
				foreach ($answers as $answer_info) {	
							if ($load_order){
									array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
							}		    
					$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
					echo "<tr><td>";
					echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this,\"question[$q_id][answer_text]\")' $checked class='$css'/>";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>";
					echo "</td></tr>";
					$i++;
				}
			}
	}else{
			echo "<table width='100%'>";
			$i=0;
			foreach ($_SESSION["order"][$q_id] as $a_id) {
					$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
					$database->query();
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());	
			}    	    
				$answers=$database->loadAssocList();
				$answer_info=$answers[0];
				$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
				echo "<tr><td>";
				echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this,\"question[$q_id][answer_text]\")' $checked class='$css'/>";
				echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>";
				echo "</td></tr>";
				$i++;
			}	    
	}
	if (!isset($data["answer_text"])){
			$data["answer_text"]=null;
	}	
	if ($other_field!=0) {
			echo "<tr><td class='$css_answer'><input name='question[$q_id][answer][]' type='$type' class='$css'/>".text_wrapp(stripslashes($other_field_title),30,"<br />")."<br />";
			echo "<input name='question[$q_id][answer_text]' type='text' value='".$data["answer_text"]."' onkeyup='setentertext(form.q$q_id,this.value); if(this.value.length>0) {change_checked(\"question[$q_id][answer][]\",$i);} else {test_radios(q$q_id,\"question[$q_id][answer][]\",$i)}; ' class='$css_inputbox'/>";
			echo "</td></tr>";
	}
	echo "<tr><td>
				<input type='hidden' name='question[$q_id][type]' value='$type'>
				<input type='hidden' name='question[$q_id][orientation]' value='vertical'>
			</td></tr></table>";
}
function view_horizontal_answers($q_id,$type="radio",$order,$data=null){
	$database = &JFactory::getDBO();
	
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 		= JRequest::getVar('css_radiobutton');
		
	$css=$type=='radio'?$css_radiobutton:$css_checkbox;
	if (!isset($_SESSION["order"][$q_id])){	
			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
			$database->query();		
		if ($database->getErrorMsg()){
			die($database->getErrorMsg());	
		}    			
			$numrows=$database->getNumRows();	
			if ($numrows>0) {
				$answers=$database->loadAssocList();
				$i=0;
				$percent=(int)(100/$numrows);
				echo "<table width='100%'><tr>";
				if ($order !=""){
						$load_order=true;
								$_SESSION["order"][$q_id]=array();
				}    		
				foreach ($answers as $answer_info) {	
							if ($load_order){
									array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
							}    		    
					$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
					echo "<td width='$percent%' valign=\"top\">";
					echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/>";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>";
					echo "</td>";
				}
				echo "</tr><tr><td><input type='hidden' name='question[$q_id][type]' value='$type'>
							<input type='hidden' name='question[$q_id][orientation]' value='horizontal'></td></table>";
			}
	}else{
					$numrows=count($_SESSION["order"][$q_id]);
				
				$percent=(int)(100/$numrows);
				echo "<table width='100%'><tr>";
				foreach ($_SESSION["order"][$q_id] as $a_id) {	
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");		
							$database->query();		
					if ($database->getErrorMsg()){
						die($database->getErrorMsg());	
					}            			    		    
							$answers=$database->loadAssocList();
							$answer_info=$answers[0];
					$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
					echo "<td width='$percent%' valign=\"top\">";
					echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/>";
					echo "<span class='$css_answer'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span>";
					echo "</td>";
				}
				echo "</tr><tr><td><input type='hidden' name='question[$q_id][type]' value='$type'>
							<input type='hidden' name='question[$q_id][orientation]' value='horizontal'></td></table>";
	}
}
function view_matrix_answers($q_id,$type="radio",$order='',$orderC='',$data=null){
	$database = &JFactory::getDBO();
	
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 		= JRequest::getVar('css_radiobutton');
	$css_column_heading 		= JRequest::getVar('css_column_heading');
	$css_row_heading 		= JRequest::getVar('css_row_heading');
	$css_table_row1 		= JRequest::getVar('css_table_row1');
	$css_table_row2 		= JRequest::getVar('css_table_row2');
	$css_dropdownmenu 		= JRequest::getVar('css_dropdownmenu');
	
	$css=$type=='radio'?$css_radiobutton:$css_checkbox;

	$order1=$orderC==' ORDER BY RAND()'?"ORDER BY RAND()":" ORDER BY ac_id ASC";
	$order2=$order==' ORDER BY RAND()'?"ORDER BY RAND()":" ORDER BY m_id ASC";
	if ($type=="radio" || $type=="checkbox") {
			if (!isset($_SESSION["order_column"][$q_id])&&!isset($_SESSION["order"][$q_id])){
				$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=$q_id $order1");		
				$database->query();	
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());	
			}    		
				$numcolumns=$database->getNumRows();		
				if ($numcolumns>0)	$percent=(int)(60/$numcolumns);
					else $percent=60;	
				if ($numcolumns>0){			
					$answer_columns=$database->loadAssocList();	
							if ($order1 !=""){
									$load_column_order=true;
										$_SESSION["order_column"][$q_id]=array();
							}		            					
					foreach ($answer_columns as $column_info) {
										if ($load_column_order){
												array_push($_SESSION["order_column"][$q_id],$column_info["ac_id"]);
										}			    
							$c_value[]=$column_info["ac_id"];
							$c_label[]=$column_info["value"];
					}
				}	
				echo "<table width='100%'><tr class='$css_column_heading'><td width='40%'><input type='hidden' name='question[$q_id][type]' value='$type'>
						<input type='hidden' name='question[$q_id][orientation]' value='matrix'></td>";
				for ($i=0;$i<count($c_value);$i++) {
						echo "<td width='$percent%' align='center' stype='padding:15px' class='$css_column_heading'>".text_wrapp(stripslashes($c_label[$i]),30,"<br />")."</td>";
				}
				echo "</tr>";
				$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
				$database->query();	
			if ($database->getErrorMsg()){
				die($database->getErrorMsg());	
			}    					
				if ($database->getNumRows()>0) {
						$answers=$database->loadAssocList();	
						$j=0;
								if ($order2 !=""){
										$load_line_order=true;
												$_SESSION["order"][$q_id]=array();
								}				
						foreach ($answers as $answer_info)	{
											if ($load_line_order){
													array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
											}				    
							if ($j%2!=0) {
									$class=$css_table_row1;
							}
							else {
									$class=$css_table_row2;
							}
							echo "<tr class='$class'><td align='left'><span class='$css_row_heading'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span></td>";
							for ($i=0;$i<count($c_value);$i++) {
									$checked="";
								if (isset($data["answer"][$answer_info["a_id"]])&&is_array($data["answer"][$answer_info["a_id"]])){
										$checked=in_array($c_value[$i],$data["answer"][$answer_info["a_id"]])?" Checked":"";				
								}
								echo "<td align='center'><input name='question[$q_id][answer][".$answer_info["a_id"]."][]' type='$type' value='".$c_value[$i]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/></td>";
							}
							echo "</tr>";
							$j++;
						}
				}	    
				echo "</table>";
			}else{
				$numcolumns=count($_SESSION["order_column"][$q_id]);
				if ($numcolumns>0)	{
						$percent=(int)(60/$numcolumns);
				}
				else {
						$percent=60;	
				}
				if ($numcolumns>0){			    			
					foreach ($_SESSION["order_column"][$q_id] as $ac_id) { 
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE ac_id=$ac_id");
							$answer_columns=$database->loadAssocList();		
							$column_info=$answer_columns[0];
							$c_value[]=$column_info["ac_id"];
							$c_label[]=$column_info["value"];
					}
				}	
				echo "<table width='100%'><tr class='$css_column_heading'><td width='40%'><input type='hidden' name='question[$q_id][type]' value='$type'>
						<input type='hidden' name='question[$q_id][orientation]' value='matrix'></td>";
				for ($i=0;$i<count($c_value);$i++) {
						echo "<td width='$percent%' align='center' stype='padding:15px' class='$css_column_heading'>".text_wrapp(stripslashes($c_label[$i]),30,"<br />")."</td>";
				}
				echo "</tr>";
						
						$j=0;
						foreach ($_SESSION["order"][$q_id] as $a_id)	{    				    
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");		
										$database->query();				    				    
										$answers=$database->loadAssocList();	
										$answer_info=$answers[0];
							if ($j%2!=0) {
									$class=$css_table_row1;
							}
							else {
									$class=$css_table_row2;
							}
							echo "<tr class='$class'><td align='left'><span class='$css_row_heading'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</span></td>";
							for ($i=0;$i<count($c_value);$i++) {
									$checked="";
								if (isset($data["answer"][$answer_info["a_id"]])&&is_array($data["answer"][$answer_info["a_id"]])){
										$checked=in_array($c_value[$i],$data["answer"][$answer_info["a_id"]])?" Checked":"";	
								}		
								echo "<td align='center'><input name='question[$q_id][answer][".$answer_info["a_id"]."][]' type='$type' value='".$c_value[$i]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/></td>";
							}
							echo "</tr>";
							$j++;
						}
				echo "</table>";	        
			}
	}
		elseif ($type=="menu") {
				if (!isset($_SESSION["order"][$q_id])&&(!isset($_SESSION["order_column"][$q_id]))){
					echo "<table width='100%'>";
					echo "<tr><td width='25%'></td>";
					$database->setQuery("SELECT * FROM #__ijoomla_surveys_menu_heading WHERE q_id=$q_id $order2");		
					$database->query();	
					if ($database->getErrorMsg()){
						die($database->getErrorMsg());	
					}
					$total_menus=$database->getNumRows();				
					$percent=intval(65/$total_menus);
					if ($total_menus>0) {
						$menus=$database->loadAssocList();	
									if ($order2 !=""){
												$load_menu_order=true;
												$_SESSION["order_column"][$q_id]=array();
										}													
						foreach ($menus as $m_info){			    	    
											if ($load_menu_order){
													array_push($_SESSION["order_column"][$q_id],$m_info["m_id"]);
											}				    
							echo "<td width='$percent%' class='matrix_heading'>".$m_info["value"]."</td>";
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE m_id=".$m_info["m_id"]." $order1");		
							$database->query();	
							if ($database->getErrorMsg()){
								die($database->getErrorMsg());						
							}
							if ($database->getNumRows()>0) {
								$items=$database->loadAssocList();	
								foreach ($items as $c_info){
									$option["ac_id"]=$c_info["ac_id"];
									$option["value"]=$c_info["value"];
									$m_items[$m_info["m_id"]][]=$option;
								}
								
							}
						}
					}
					echo "</tr>"; // MENU HEADING
					$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");		
					$database->query();	
					if ($database->getErrorMsg()){
						die($database->getErrorMsg());	
					}    						
					if ($database->getNumRows()>0) {				
						$answers=$database->loadAssocList();				
								if ($order !=""){
										$load_order=true;
												$_SESSION["order"][$q_id]=array();
								}				
						$i=0;
						foreach ($answers as $answer_info){
											if ($load_order){
													array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
											}				    
							if ($i%2!=0) {
									$class=$css_table_row1;
							}
							else {
									$class=$css_table_row2;
							}
							echo "<tr class='$class'><td align='right' style='padding-right:15px'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</td>";
							$m_width=intval(65/$total_menus);
							foreach ($m_items as $m_id => $menu) { // MENU PER ANSWER						
								echo "<td>";
								echo "<select name='question[$q_id][menu][$m_id][answer][".$answer_info["a_id"]."]' onchange='setselectedMatrix(form.q$q_id,this)' class='$css_dropdownmenu'>";
								echo "<option value='-1' selected></option>";
								foreach ($menu as $key => $option) {
												$selected=$data["menu"][$m_id]["answer"][$answer_info["a_id"]]==$option["ac_id"]? " Selected":"";
									echo "<option value='".$option["ac_id"]."' $selected>".text_wrapp(stripslashes($option["value"]),30,"<br />")."</option>";
								}
								echo "</select>";
								echo "</td>";
							}
							
							echo "</tr>";
							$i++;
						}
						echo "<tr><td><input type='hidden' name='question[$q_id][type]' value='$type'>
							<input type='hidden' name='question[$q_id][orientation]' value='matrix'></td></tr></table>";
					}
			}else{
					echo "<table width='100%'>";
					echo "<tr><td width='25%'></td>";
					
					$total_menus=count($_SESSION["order_column"][$q_id]);
					$percent=intval(65/$total_menus);

						foreach ($_SESSION["order_column"][$q_id] as $m_id_sel){			    	    
												$database->setQuery("SELECT * FROM #__ijoomla_surveys_menu_heading WHERE m_id=$m_id_sel");		
									$database->query();	
									if ($database->getErrorMsg()){
										die($database->getErrorMsg());	    				    
									}
								$menus=$database->loadAssocList();						    				        
								$m_info=$menus[0];
							echo "<td width='$percent%'>".$m_info["value"]."</td>";
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE m_id=".$m_info["m_id"]." $order1");		
							$database->query();	
							if ($database->getErrorMsg()){
								die($database->getErrorMsg());						
							}
							if ($database->getNumRows()>0) {
								$items=$database->loadAssocList();	
								foreach ($items as $c_info){
									$option["ac_id"]=$c_info["ac_id"];
									$option["value"]=$c_info["value"];
									$m_items[$m_info["m_id"]][]=$option;
								}
								
							}
						}
					echo "</tr>"; // MENU HEADING							
						
						$i=0;
						foreach ($_SESSION["order"][$q_id] as $a_id){		    
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");		
									$database->query();	 
									if ($database->getErrorMsg()){
										die($database->getErrorMsg());	
									}            			   				    
									$answers=$database->loadAssocList();				
									$answer_info=$answers[0];
							if ($i%2!=0) {
									$class=$css_table_row1;
							}
							else {
									$class=$css_table_row2;
							}
							echo "<tr class='$class'><td align='right' style='padding-right:15px'>".text_wrapp(stripslashes($answer_info["value"]),30,"<br />")."</td>";
							$m_width=intval(65/$total_menus);
							foreach ($m_items as $m_id => $menu) { // MENU PER ANSWER						
								echo "<td>";
								echo "<select name='question[$q_id][menu][$m_id][answer][".$answer_info["a_id"]."]' onchange='setselectedMatrix(form.q$q_id,this)' class='$css_dropdownmenu'>";
								echo "<option value='-1' selected></option>";
								foreach ($menu as $key => $option) {
										$selected="";
										if (isset($data["menu"][$m_id]["answer"][$answer_info["a_id"]])&&$data["menu"][$m_id]["answer"][$answer_info["a_id"]]==$option["ac_id"]){
												$selected=" Selected";    
										}
									echo "<option value='".$option["ac_id"]."' $selected>".text_wrapp(stripslashes($option["value"]),30,"<br />")."</option>";
								}
								echo "</select>";
								echo "</td>";
							}
							
							echo "</tr>";
							$i++;
						}
						echo "<tr><td><input type='hidden' name='question[$q_id][type]' value='$type'>
							<input type='hidden' name='question[$q_id][orientation]' value='matrix'></td></tr></table>";		    
			}
		}
}


function isequal($arr1,$arr2) {
		foreach ($arr1 as $value) {
			if (!in_array($value,$arr2)) return false;
		}
		foreach ($arr2 as $value) {
			if (!in_array($value,$arr1)) return false;
		}
		return true;
}
function hascommonpoint($arr1,$arr2) {
		foreach ($arr1 as $value) {
			if (in_array($value,$arr2)) return true;
		}
		return false;
}
function hasnotcommonpoint($arr1,$arr2) {
		foreach ($arr1 as $value) {
			if (!in_array($value,$arr2)) return true;
		}
		return false;
}
function msg($Content, $url){ 
		echo "<script language='javascript1.2' >alert('$Content'); window.location='".$url."'</script>";
}
function sess_process($page=0,$action='next') {
	global $post_cpage;
	$post_question=JArrayHelper::getValue($_POST,"question");
	if ($action=='next') {
		$_SESSION["survey"]["page_".intval($post_cpage)]=serialize($post_question);
		$_SESSION['pre_page'][$page]=intval($post_cpage);
	}
	elseif ($action=='back') {
		$_SESSION["survey"]["page_".intval($post_cpage)]=null;
	}
}
/* iJoomla Al SURVEYS-53
wraps $text in pieces of maximum $length
returns layout text
*/
function text_wrapp ($text, $length, $break) {
	 $pure=strip_tags($text);
	 $words=str_word_count($pure, 1);
	 foreach ($words as $word) {
			 if (strlen($word) > $length) {
					 $newword=wordwrap($word, $length, $break, TRUE);
					 $text=str_replace($word, $newword, $text);
			 }
	 }
	 return $text;
}
?>	    