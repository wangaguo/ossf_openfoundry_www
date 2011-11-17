<?php
/*
 * $Id: <surveys.html.php,0.0.32 <version> 2007/03/24 hh:mm:ss <creator name> $
 *
 * @package iJoomla Surveys
 * @email webmaster@ijoomla.com
 *
 * @copyright
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
 * @file <surveys.php>
 * @brief <brief description of file purpose>
 *
 * @functionlist
 * ====================================================================
 * function show_surveys
 * function view_survey
 * function survey_restore
 * function survey_start
 * function send_mail
 * function survey_finish
 * function survey_finish_incomplete
 * function check_left_off
 * function check_completed
 * function view_page
 * function view_open_answers
 * function view_dropdown_answers
 * function view_date_answers
 * function view_open_more_line
 * function view_checksum_answers
 * function view_vertical_answers
 * function view_horizontal_answers
 * function view_matrix_answers
 * function ij_starttable
 * function ij_endtable
 * function view_result
 * function delete_session
 * function check_anwered_questions
 * function view_result_text
 * function view_result_value
 * ====================================================================
 * @endfunctionlist
 *
 * @history
 * ====================================================================
 * File creation date:
 * Current file version: 0.0.32
 * 
 * Date:	11.06.2009
 * Issue:   javascript error: 'setentertext is not defined'
 * Lines:	276-278
 *
 * Date:	29.06.2009
 * Issue:   email issues
 * Lines:	856, 944
 *
 * ====================================================================
 * @endhistory
 */
// ensure this file is being included by a parent file

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
require_once( JPATH_SITE."/administrator/components/com_surveys/surveys_config.php" );

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

JRequest::setVar('css_survey_name', $css_survey_name);

	JRequest::setVar('css_result_heading', $css_result_heading);
	JRequest::setVar('css_totalbackground', $css_totalbackground);
	JRequest::setVar('css_tablerow1', $css_tablerow1);
	JRequest::setVar('css_tablerow2', $css_tablerow2);
	JRequest::setVar('css_table_row1', $css_table_row1);
	JRequest::setVar('css_table_row2', $css_table_row2);
	JRequest::setVar('css_question', $css_question);
	JRequest::setVar('css_answer', $css_answer);
	JRequest::setVar('css_total_background', $css_total_background);
	JRequest::setVar('css_column_heading', $css_column_heading);

function show_surveys() {
	global $homelink;
	$my = &JFactory::getUser();

	$css_column_heading = JRequest::getVar('css_column_heading');
	$css_survey_name 	= JRequest::getVar('css_survey_name');
	$css_table_row2 	= JRequest::getVar('css_table_row2');
	$css_row_heading 	= JRequest::getVar('css_row_heading');
	$css_table_row1 	= JRequest::getVar('css_table_row1');


	$database = &JFactory::getDBO();
	$i=0;

	echo "<span class='$css_survey_name'>"._FRONTEND_TITLE."</span>";
	echo "<table width='100%' cellspacing='0' cellpadding='0'>";
	$now=time();
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_surveys WHERE approved=1 AND start_date<=$now AND end_date>=$now AND published=1 ORDER BY ordering");
    if (!$database->query()){
        die("Error !Code 16: The process could not be finished due to internal error. Please contact the administrators");
    }
	if ($database->getNumRows()>0) {
		$surveys=$database->loadAssocList();
		$i=1;
		echo "<tr class='sublevel'>
				<th width='3%' class='$css_column_heading'  >#</th>
				<th align='left' class='$css_column_heading' ><b>"._SURVEY_NAME."</b></th>
			  </tr>";
		foreach ($surveys as $survey_info) {
			if ($i%2!=0) {
			    $class=$css_table_row1;
            }
			else {
			    $class=$css_table_row2;
            }
			echo "<tr class='$class'>";
			echo "<td >".$i."</td>";
			// start alin comment
			/*echo "<td ><a href='".JRoute::_("$homelink&amp;act=view_survey&amp;survey=".urlencode(stripslashes($survey_info["title"])))."'>".stripslashes($survey_info["title"])."</a></td>";*/
			// end alin comment 
			
			//start alin
			$homelink="index.php?option=com_surveys&Itemid=".$_REQUEST['Itemid'];
			echo "<td ><a href='".JRoute::_("$homelink&amp;act=view_survey&amp;survey=".$survey_info["s_id"].":".$survey_info["alias"])."'>".stripslashes($survey_info["title"])."</a></td>";
			//end alin
			echo "</tr>";
			$i++;
		}
	}
	else {
		echo "<tr><td colspan='4'>"._NO_SURVEYS."</td></tr>";
	}
	ij_endtable();
}

function view_survey($s_id,$s_title='',$page=0,$view_command='') {
	global $homelink, $mainframe;
	$my = &JFactory::getUser();

	$css_survey_name 		= JRequest::setVar('css_survey_name');
	$css_survey_description = JRequest::setVar('css_survey_description');
	$css_button				= JRequest::setVar('css_button');

	$database = &JFactory::getDBO();
	$scriptlib='
					<script type="text/javascript">
					
					var AlertText = "'._QUESTIONS_REQUIRED.' (*). \n\n";
					var form=document.view_survey;

          function setentertext(field,ftext) {
						if (ftext!="") {
						    field.value=1;
						}else {
						    field.value=0;
						}
					}

          function setentered(field, fieldx, field_other) {
						if (fieldx.checked == null || fieldx.checked == false) field.value=0;
						else {
						    field.value=1;
						    if (field_other != "" && field_other != undefined){
						        var other_field_input = document.getElementsByName(field_other);
						        if (other_field_input.length>0)
						            other_field_input[0].value="";
						    }
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
						        if (other_field_input.length>0){
						            other_field_input[0].value="";
        						    var radio_field=document.getElementsByName(fieldx.name);
        						    if (radio_field.length>1){
        						        if (radio_field[1].checked!=false){
        						            radio_field[1].checked=false;
        						        }
        						    }
						        }
						    }
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
					
					</script>';
	//echo $scriptlib;
	
	$mainframe->addCustomHeadTag($scriptlib);
	
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_surveys WHERE s_id=$s_id");
    if (!$database->query()){
        die("Error !Code 19: The process could not be finished due to internal error. Please contact the administrators");
    }

	if ($database->getNumRows()>0) {
		$surveys=$database->loadAssocList();
		$survey_info=$surveys[0];
		if ($survey_info["access"]>0) {
			if ($survey_info["access"]==1) {
				if ($my->id) {
					$access=true;
				}
				else{
					$access=false;
				}
			}
			else {
				if ($my->usertype && $my->gid == 25) {
					$access=true;
				}
				else {
					$access=false;
				}
			}
		}
		else {
			$access=true;
		}

		if (!$access)
		{
		    $validate = JUtility::getToken(1);
			echo "<table width='100%'><tr><td align='center' class='$css_survey_description'>"._NOT_CONNECTED."<br /> <br />
				  </td></tr><tr><td align='center'>"; ?>

<!-- ####### the fields name,id, hidden are similar to ones from com_login ###### -->
		<form action="index.php" method="post" name="login" id="form-login">
    		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
            	<tr>

            		<td>
            			<label for="modlgn_username"><?php echo _USERNAME?></label>
            			<input name="username" id="modlgn_username" type="text"  alt="username" size="18" />
            			<label for="modlgn_passwd"><?php echo _PASSWORD?></label>
            			<input type="password" id="modlgn_passwd" name="passwd"  size="18" alt="password" />
            			<input type="checkbox" name="remember" id="modlgn_remember"  value="yes" alt="Remember Me" />
            			<label for="modlgn_remember"><?php echo _REMEMBER_ME?></label>

            			<input type="submit" name="Submit" class="button" value="Login" />

            		</td>
            	</tr>
            	<tr>
            		<td>
            			<a href="<?php echo JRoute::_("index.php?option=com_registration&amp;task=lostPassword"); ?> "><?php echo _LOST_PASSWORD?></a>&nbsp;&nbsp;<?php echo _NO_ACCOUNT?>
						<a href="<?php echo JRoute::_("index.php?option=com_registration&amp;task=register"); ?>"><?php echo _REGISTER?></a>
            		</td>
            	</tr>
    	   </table>
		   <input type="hidden" name="option" value="com_user" />
           <input type="hidden" name="task" value="login" />
           <input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
		   <?php 
		   	//hack to display the correct link 
		    $begin_uri=strpos($_SERVER['REQUEST_URI'],"index.php");
			$link=substr($_SERVER['REQUEST_URI'],$begin_uri);
		   ?>
           <input type="hidden" name="return" value="<?php echo base64_encode(substr(JURI::base(),0,-1)."/".$link)?>" />
           <input type="hidden" name="<?php echo $validate; ?>" value="1" />
		 </form>

    		</td>
    		</tr>
    	   </table>
    	<?php
    	}
    	else {

    	    $can_open_survey=true;
            if ($view_command!="survey flow"){

        	    $database->setQuery("SELECT general_option FROM #__ijoomla_surveys_config");
                if (!$database->query()){
                    die("Error !Code 19: The process could not be finished due to internal error. Please contact the administrators");
                }
        	    $general_result=$database->loadResult();
        	    $page_to_view=0;
        	    $survey_completed=0;
        	    switch ($general_result) {

        	        case _ONE_RESPONSE_P_RESPONDENT_VALUE :
        	        {
					
						if(!ipExist($_SERVER['REMOTE_ADDR'], $s_id, $my->id)){						
							$page_to_view=check_left_off($s_id,$my->id);							
							if($page_to_view == 0){//////
								survey_start($s_id,$my->id);//////
							}//////	
							
							if ($page_to_view!=-1 && $page_to_view != 0){
								$sess_id_completed = intval(check_incompleted($s_id,$my->id));
								survey_restore($s_id, $my->id, $sess_id_completed);
								$page=$page_to_view;
							}
							if($page_to_view == -1){
							//If I complete the survey and re-enter the same survey from another IP-address I come back to my previously filled survey
								$sess_id_completed = intval(check_completed($s_id,$my->id));
								if ($sess_id_completed != 0){
									survey_restore($s_id, $my->id, $sess_id_completed);
								}
								else{
									survey_start($s_id,$my->id);
								}
							}
						}
						else{
							echo "<strong>".ALREADY_COMPLETED."</strong>";
							$can_open_survey=false;
						}
					break;
        	        }

        	        case _ONE_RESPONSE_P_RESPONDENT_FO_VALUE :
        	        {
											
						$page_to_view=check_left_off($s_id,$my->id);							
						if($page_to_view == 0){//////
							survey_start($s_id,$my->id);//////
						}//////	
						
						if ($page_to_view!=-1 && $page_to_view != 0){
							$sess_id_completed = intval(check_incompleted($s_id,$my->id));
							survey_restore($s_id, $my->id, $sess_id_completed);
							$page=$page_to_view;
						}
						if($page_to_view == -1){
						//If I complete the survey and re-enter the same survey from another IP-address I come back to my previously filled survey
							$sess_id_completed = intval(check_completed($s_id,$my->id));
							if ($sess_id_completed != 0){
								survey_restore($s_id, $my->id, $sess_id_completed);
							}
							else{
								survey_start($s_id,$my->id);
							}
						}
						
						break;
					
        	            /*$page_to_view=check_left_off($s_id,$my->id);
        	            if ($page_to_view!=-1){
        	                $database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id='$s_id' AND user_id='".$my->id."' AND ip='".$_SERVER['REMOTE_ADDR']."' AND completed<>'1' ORDER BY session_id ASC LIMIT 1");
                            if (!$database->query()){
                                die("Error !Code 19: The process could not be finished due to internal error. Please contact the administrators");
                            }
        	                $incomplete_sess_id=$database->loadResult();
        	                if ($incomplete_sess_id>0)
                                $_SESSION["sess_id"]=$incomplete_sess_id;
                            else{
                                echo "Previously recorded data could not be loaded!";
                            }
        	                $page=$page_to_view;
        	            }else{
        	                $survey_completed=check_completed($s_id,$my->id);
        	                if ($survey_completed!=0){
        	                    echo "<strong>".ALREADY_COMPLETED."</strong>";
        	                    $can_open_survey=false;
        	                }
        	                else{
        	                    survey_start($s_id,$my->id);
        	                }
        	            }
        	            break;*/
        	        }

        	        case _MULTIPLE_RESPONSES_P_RESPONDENT_VALUE :
        	        {
        	            $page_to_view=check_left_off($s_id,$my->id);
        	            if ($page_to_view!=-1){
        	                survey_restore($s_id,$my->id);
        	                $page=$page_to_view;
        	            }else{
        	                survey_start($s_id,$my->id);
        	            }
        	            break;
        	        }

        	        case _MULTIPLE_RESPONSES_P_RESPONDENT_SC_VALUE :
        	        {
        	            $page_to_view=check_left_off($s_id,$my->id);
        	            if ($page_to_view!=-1){
        	                survey_finish_incomplete($s_id,$my->id);
        	            }
        	            survey_start($s_id,$my->id);

        	            break;
        	        }
        	        default : break;
        	    }
    	    }

            if (JArrayHelper::getValue($_POST,'Submit')){
			
				//-----------------
				/*$sql = "SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND user_id = $my->id AND completed = 0 ORDER BY session_id ASC LIMIT 1";
				$database->setQuery($sql);
				
        		if (!$database->query()){
            		die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
        		}
        		$sess_id=$database->loadResult();*/
				$sess_id = $_SESSION["sess_id"]; 				
				if (isset($sess_id) && $sess_id != NULL){
                    $pst_cpage = JArrayHelper::getValue($_POST,'cpage');
                    if ($pst_cpage=="last"){
                        $pst_cpage = -1;
                    }
                    add_result_for_page($page,$pst_cpage,$sess_id);
                }
                else {
                    echo "Error ! Results not saved !";
                }
				//-----------------
            }

            if ($can_open_survey!=false){
    	        ij_starttable("100%",stripslashes($survey_info["title"]),1,$css_survey_name);
    	        if (!$page) {
    	            echo "<tr>
    				<td align='left' class='$css_survey_description'>";
    	            if ($survey_info["images"]) {
    	                echo "<table align='left'><tr><td align='left' style='padding-right:10px;padding-bottom:10px'><img src='".JURI::base()."/images/stories/".$survey_info["images"]."' border='0' alt='no image' /></td></tr></table>";
    	            }
    	            echo "<span class='$css_survey_description'> ".str_replace("{mosimage}","",stripslashes($survey_info["description"]))."</span>";

    	            echo "</td>
    			</tr>";
    	        }
    	        ij_endtable();				
    	        if ($page==0){					
    	            $database->setQuery("SELECT page_id FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND published=1 ORDER BY ordering ASC LIMIT 1");
                    if (!$database->query()){
                        die("Error !Code 19: The process could not be finished due to internal error. Please contact the administrators");
                    }
    	            if ($database->getNumRows()>0) {
    	                $first_page=$database->loadAssocList();
    	                $first_page_info=$first_page[0];
						//start alin comment
    	                /*view_page($s_id,stripslashes($s_title),intval($first_page_info["page_id"]));*/
						//end alin comment
						
						//start alin
						view_page($s_id,$survey_info['alias'],intval($first_page_info["page_id"]));
						//end alin
    	            }
    	        }
    	        else {
					/*$sql = "SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND user_id = $my->id AND completed = 0 ORDER BY session_id ASC LIMIT 1";
					$database->setQuery($sql);				
					if (!$database->query()){
						die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
					}
					$sess_id=$database->loadResult();*/
									
    	            $database->setQuery("SELECT * FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND page_id='$page' AND published=1 ");
                    if (!$database->query()){
                        die("Error !Code 19: The process could not be finished due to internal error. Please contact the administrators");
                    }
					$sess_id = $_SESSION["sess_id"];
    	            if ($database->getNumRows()<1) {						
    	                if (isset($sess_id)){
							/*//----------------------------
							$database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND user_id = $my->id AND completed = 0 ORDER BY session_id ASC LIMIT 1");
							if (!$database->query()){
								die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
							}
							$sess_id=$database->loadResult();
							//----------------------------*/

    	                    $questions_answered = check_anwered_questions($sess_id);

    	                    if ($questions_answered==1){
        	                    send_mail($sess_id,$s_id);								
        	                    survey_finish($sess_id);
    	                    }
							else{
    	                        delete_session($sess_id);
    	                    }

    	                    // END PAGE
    	                    if ($survey_info["form_target"]==_SHOW_END_PAGE){
    	                        ij_starttable("100%",stripslashes($survey_info["end_page_title"]));    	                        
    	                        echo "<tr><td width='100%' align='left'>".stripslashes($survey_info["end_page_description"])."</td></tr>";
    	                        if ($survey_info["show_result"]==1) {
									//start alin comment
    	                           /*echo "<tr><td align='center' width='100%'>

    									<input type='button' name='show_result' class='".$css_button."' value='"._VIEW.' '._RESULT."' onClick='self.location=\"".JRoute::_("index.php?option=com_surveys&amp;act=view_result&amp;survey=".urlencode(stripslashes($survey_info["title"]))."&Itemid=".$_REQUEST['Itemid'])."\"' class='button' />

    								</td></tr>";*/
									//end alin comment
									//start alin
									echo "<tr><td align='center' width='100%'><input type='button' name='show_result' class='".$css_button."' value='"._VIEW.' '._RESULT."' onClick='self.location=\"".JRoute::_("index.php?option=com_surveys&amp;act=view_result&amp;survey=".$survey_info["s_id"]."-".$survey_info["alias"]."&Itemid=".$_REQUEST['Itemid'])."\"' class='button' />

    								</td></tr>";
									//end alin
    	                        }
    	                        ij_endtable();
    	                    }
    	                    else {
    	                        if ($survey_info["show_result"]==1) {
    	                            ij_starttable("100%","");
                                    view_result($survey_info["s_id"],stripslashes($s_title));
        	                        msg($survey_info["redirection_msg"],$survey_info["redirection_url"]);
    	                            ij_endtable();
    	                        }
    	                        msg($survey_info["redirection_msg"],$survey_info["redirection_url"]);
    	                    }
    	                }else{
    	                    echo "Error ! Survey was not completed";
    	                }
    	            }
    	            else {
						//start alin comment
    	                /*view_page($s_id,stripslashes($s_title),$page);*/
						//end alin comment
						
						//start alin
						view_page($s_id,$survey_info["alias"],$page);
						//end alin
                    }
    	        }
    	    }
    	}
	}
	else {
        ij_starttable('100%','Error');
        echo '<tr >
        		<td align="center" >
        		<br /><br />
        		<strong>The survey does not exist</strong>
        		<br /><br /><br />
        		</td>
        	 </tr>';
        echo '<tr class="tablec">
        		<form action="'.JRoute::_($homelink).'" method="post">
        		<td align="center" colspan="2" height="40" valign="middle" nowrap >
        		<input type="submit" value="&nbsp;&nbsp;Back to iJoomla Survey&nbsp;&nbsp;" class="button"/>
        		</td>
        		</form>
        	  </tr>';
        ij_endtable();
	}
}

function survey_restore($s_id,$user_id,$sess_id=0){
    $database = &JFactory::getDBO();
    if ($sess_id==0){
        //$database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id='$s_id' AND user_id='$user_id' AND ip='".$_SERVER['REMOTE_ADDR']."' AND completed<>'1' ORDER BY session_id ASC LIMIT 1");
        $database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND user_id = $user_id AND completed = 0 ORDER BY session_id ASC LIMIT 1");
        if (!$database->query()){
            die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
        }
        $sess_id=$database->loadResult();
    }
    if ($sess_id>0){
        $_SESSION["sess_id"]=$sess_id;
        $database->setQuery("UPDATE #__ijoomla_surveys_session SET completed = 0 WHERE session_id = $sess_id ");
        if (!$database->query()){
            die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
        }

        $database->setQuery("SELECT * FROM #__ijoomla_surveys_result WHERE session_id='$sess_id' ORDER BY q_id ASC");
        if (!$database->query()){
            die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
        }
        $result_data=$database->loadAssocList();

        $page_info=array();
        foreach ($result_data as $res_no => $result_row){
            $database->setQuery("SELECT orientation, type, page_id FROM #__ijoomla_surveys_questions WHERE q_id='".$result_row["q_id"]."'");
            $question_details=$database->loadAssocList();
            $q_id=$result_row["q_id"];
            $a_id=$result_row["a_id"];
            $m_id=$result_row["m_id"];
            $ac_id=$result_row["ac_id"];
            $value=$result_row["value"];
            $type=$question_details[0]["type"];
            $orientation=$question_details[0]["orientation"];
            $page_id=$question_details[0]["page_id"];

            $page_array_name="page_".$page_id;

            $page_info[$page_array_name][$q_id]["type"]=$type;
            $page_info[$page_array_name][$q_id]["orientation"]=$orientation;

            if ($orientation=="matrix"){
                if ($type=="menu"){
                    if (!isset($page_info[$page_array_name][$q_id]["menu"])||!is_array($page_info[$page_array_name][$q_id]["menu"])){
                        $page_info[$page_array_name][$q_id]["menu"]=array();
                    }
                    if (!isset($page_info[$page_array_name][$q_id]["menu"][$m_id])||!is_array($page_info[$page_array_name][$q_id]["menu"][$m_id]))  {
                        $page_info[$page_array_name][$q_id]["menu"][$m_id]=array();
                    }
                    if (!isset($page_info[$page_array_name][$q_id]["menu"][$m_id]["answer"])||!is_array($page_info[$page_array_name][$q_id]["menu"][$m_id]["answer"])){
                        $page_info[$page_array_name][$q_id]["menu"][$m_id]["answer"]=array();
                    }
                    $page_info[$page_array_name][$q_id]["menu"][$m_id]["answer"][$a_id]=$ac_id;
                }else{
                    if (!isset($page_info[$page_array_name][$q_id]["answer"])||!is_array($page_info[$page_array_name][$q_id]["answer"])){
                        $page_info[$page_array_name][$q_id]["answer"]=array();
                    }

                    if (!isset($page_info[$page_array_name][$q_id]["answer"][$a_id])||!is_array($page_info[$page_array_name][$q_id]["answer"][$a_id])){
                        $page_info[$page_array_name][$q_id]["answer"][$a_id]=array();
                    }
                    array_push($page_info[$page_array_name][$q_id]["answer"][$a_id],$ac_id);
                }
            }elseif ($orientation=="open"){
                if (!isset($page_info[$page_array_name][$q_id]["answer"])||!is_array($page_info[$page_array_name][$q_id]["answer"])){
                    $page_info[$page_array_name][$q_id]["answer"]=array();
                }
                if ($type=="constant"||$type=="moreline"){
                    $page_info[$page_array_name][$q_id]["answer"][$a_id]=$value;
                }elseif ($type=="datetime"&&$value!=-1){
                    if (!isset($page_info[$page_array_name][$q_id]["answer"][$a_id])||!is_array($page_info[$page_array_name][$q_id]["answer"][$a_id])){
                        $page_info[$page_array_name][$q_id]["answer"][$a_id]=array();
                    }
                    $page_info[$page_array_name][$q_id]["answer"][$a_id]["year"]=date("Y",$value);
                    $page_info[$page_array_name][$q_id]["answer"][$a_id]["month"]=date("m",$value);
                    $page_info[$page_array_name][$q_id]["answer"][$a_id]["day"]=date("d",$value);
                    $page_info[$page_array_name][$q_id]["answer"][$a_id]["hour"]=date("H",$value);
                    $page_info[$page_array_name][$q_id]["answer"][$a_id]["minute"]=date("i",$value);
                }
            }else{ // not matrix
                if (!isset($page_info[$page_array_name][$q_id]["answer"])||!is_array($page_info[$page_array_name][$q_id]["answer"])){
                    $page_info[$page_array_name][$q_id]["answer"]=array();
                }
                array_push($page_info[$page_array_name][$q_id]["answer"],$a_id);
            }
        }

        $database->setQuery("SELECT * FROM #__ijoomla_surveys_result_text WHERE session_id='$sess_id'");
        if (!$database->query()){
            die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
        }
        $result_text_data=$database->loadAssocList();

        foreach ($result_text_data as $res_no => $result_text_row){
            $database->setQuery("SELECT orientation, type, page_id FROM #__ijoomla_surveys_questions WHERE q_id='".$result_text_row["q_id"]."'");
            if (!$database->query()){
                die("Error !Code 20: The process could not be finished due to internal error. Please contact the administrators");
            }
            $question_details=$database->loadAssocList();
            $q_id=$result_text_row["q_id"];
            $value=$result_text_row["value"];

            $type=$question_details[0]["type"];
            $orientation=$question_details[0]["orientation"];
            $page_id=$question_details[0]["page_id"];

            $page_array_name="page_".$page_id;

            $page_info[$page_array_name][$q_id]["type"]=$type;
            $page_info[$page_array_name][$q_id]["orientation"]=$orientation;
            $page_info[$page_array_name][$q_id]["answer_text"]=$value;

            if (!isset($page_info[$page_array_name][$q_id]["answer"])||!is_array($page_info[$page_array_name][$q_id]["answer"])){
                $page_info[$page_array_name][$q_id]["answer"]=array();
            }

            array_push($page_info[$page_array_name][$q_id]["answer"],'on');
        }

        if (!is_array($_SESSION["survey"])){
            $_SESSION["survey"] = array();
        }
        foreach ($page_info as $page_name => $page_content){
            $_SESSION["survey"][$page_name]=serialize($page_content);
        }
    }/*
    else {
        echo "Previously completed answers could not be loaded";
    }*/
}

function survey_start($s_id,$user_id){
    $database = &JFactory::getDBO();
	$database->setQuery("INSERT INTO #__ijoomla_surveys_session(session_id,user_id,s_id,ip,played_time,completed)
	 		   VALUES ('','$user_id','$s_id', '".$_SERVER['REMOTE_ADDR']."', '".time()."', '0')");
    if (!$database->query()){
        die("Error !Code 21: The process could not be finished due to internal error. Please contact the administrators");
    }
	$_SESSION["sess_id"]=$database->insertid();
	$_SESSION["survey"]=null;
	$_SESSION["order"]=null;
	$_SESSION["order_column"]=null;
	$_SESSION["pre_page"]=null;

	if (isset($_SESSION["visited_pages"])){
	    $_SESSION["visited_pages"]=null;
	}
}

function send_mail($sess_id,$s_id){
    global $mosConfig_mailfrom;
    $database = &JFactory::getDBO();
    $my = &JFactory::getUser();

    $database->setQuery("SELECT q_id,type FROM #__ijoomla_surveys_questions WHERE s_id='$s_id' AND published='1' ORDER BY ordering ASC ");

	 if (!$database->query()){
        die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
    }
    $questions=$database->loadResultArray();
    $question=$database->loadAssocList();
    //print_r($question);
    //echo $question[0]['type'].'*<br />';
    foreach($question as $value => $type)
	    {
		   	$TYPE = trim(rtrim($type['type']));
		    	if($TYPE == 'moreline')
		    	{
		    		//echo 'o'	;
				}
	    }
	//handling settings
    $database->setQuery("SELECT  `email_send`, `email_send_to` FROM #__ijoomla_surveys_surveys WHERE `s_id` = '".$s_id."' ");
    if (!$database->query()){
        die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
    }
    $survey_sett=$database->loadAssocList();
	//general-mail settings
    $database->setQuery("SELECT * FROM #__ijoomla_surveys_email_settings");
    if (!$database->query()){
        die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
    }
    $sett=$database->loadAssocList();

	if($survey_sett[0]["email_send"] == '1' && $sett[0]["email_settings_activ"] == '1'){
		$send_email_to = $sett[0]["email_settings_to"].",".$survey_sett[0]["email_send_to"];
	}elseif($survey_sett[0]["email_send"] == '0' && $sett[0]["email_settings_activ"] == '1'){
		$send_email_to = $sett[0]["email_settings_to"].",".$survey_sett[0]["email_send_to"];
	}elseif($survey_sett[0]["email_send"] == '2' && $sett[0]["email_settings_activ"] == '1'){
		$send_email_to = $sett[0]["email_settings_to"];

	}elseif($survey_sett[0]["email_send"] == '1'){
		$send_email_to = $survey_sett[0]["email_send_to"];
	}else{
		$send_email_to = "";
	}

    $database->setQuery("SELECT r_id FROM #__ijoomla_surveys_result WHERE session_id='$sess_id'");
    if (!$database->query()){
        die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
    }
    $answers_r_id=$database->loadResultArray();

    $database->setQuery("SELECT rt_id FROM #__ijoomla_surveys_result_text WHERE session_id='$sess_id'");
    if (!$database->query()){
        die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
    }
    $answers_rt_id=$database->loadResultArray();

    $mail_result[] = array($questions,$answers_r_id,$answers_rt_id);

    $database->setQuery("SELECT * FROM #__ijoomla_surveys_email_settings ");
    if (!$database->query()){
        die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
    }
    $sett=$database->loadAssocList();

	//if more email address separated by comma start
	$email_send_array = explode(",",$send_email_to);
		foreach($email_send_array as $email_send_array_row => $email_send_array_value){
	//if more email address separated by comma end

		if(!empty($email_send_array_value)){//$sett[0]["email_settings_activ"] == '1'){
			//added vers 0.34 start
			
			$config = new JConfig();
			$email_from_var = $config->mailfrom;			
			$send_email_from = empty($sett[0]["email_settings_from"]) ? $email_from_var : $sett[0]["email_settings_from"];
			
			//$send_email_from = empty($sett[0]["email_settings_from"]) ? $mosConfig_mailfrom : $sett[0]["email_settings_from"];
			//added vers 0.34 end
			$headers = "From: ".$send_email_from." <".$email_send_array_value.">\r\n"
			."Reply-To: ".$send_email_from."\r\n"
			."MIME-Version: 1.0\r\n"
			."Content-type: text/html; charset=iso-8859-1\r\n";

			$mail_send="";
			if (isset($mail_result[0][0])&&count($mail_result[0][0])!=0)
			foreach($mail_result[0][0] as $row => $value){
				if(is_numeric($value)){
					$database->setQuery("select * from #__ijoomla_surveys_questions WHERE q_id = '".$value."'");
					if (!$database->query()){
						die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
					}
					$question_name =$database->loadAssocList();
					$mail_send .= $question_name[0]["title"].":&nbsp;";
				}else{
					$mail_send .= $value.":&nbsp;";
				}

				$answers_per_question=0;
					$c = 0;
				if (isset($mail_result[0][1])&&count($mail_result[0][1])!=0){
					foreach ($mail_result[0][1] as $result_count => $result_id){
						$c++;
						if(is_numeric($result_count)){

							$database->setQuery("select a_id,m_id,ac_id,value from #__ijoomla_surveys_result WHERE r_id = '".$result_id."' AND  q_id='".$value."' ");
							if (!$database->query()){
								die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
							}
							$answer_data=$database->loadAssocList();

							if (isset($answer_data[0]['a_id'])&&$answer_data[0]['a_id']!=0){
									$database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id='".$answer_data[0]['a_id']."'");
									if (!$database->query()){
										die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
									}
									$value_text	=$database->loadResult();
									$database->setQuery("SELECT `type` FROM `#__ijoomla_surveys_questions` WHERE `q_id` = '".$value."'");
									$val	= $database->loadAssocList();

									$valid = $val[0]["type"];
									if($valid == 'moreline')
									{
										$value_text	= $value_text.' : '.$answer_data[0]['value'].'<br />';
									}


									$database->setQuery("SELECT `general_date` FROM `#__ijoomla_surveys_config` ");
									$date	= $database->loadAssocList();
									$date_option = $date[0]["general_date"];
									switch ($date_option)
									{
										case 1:
										   $general_date = 'm-d-Y';
											break;
										case 2:
											$general_date = 'd-m-Y';
											break;
										case 3:
										   $general_date = 'Y-m-d';
											break;
										 case 4:
										   $general_date = 'Y-d-m';
											break;
									}
							if($valid == 'datetime')
									{
										$value_text	= $value_text.' : '.date($general_date,$answer_data[0]['value']).'<br />';
									}
									if($valid == 'constant')
									{
										$value_text	= $value_text.' : '.$answer_data[0]['value'].$answer_data[1]['value'].'<br />';
									}
																		
									$mail_send .= "<br/>".stripslashes($value_text)."&nbsp;&nbsp;";

									$answers_per_question++;
							}

							if (isset($answer_data[0]['m_id'])&&$answer_data[0]['m_id']!=0){
								$database->setQuery("SELECT value FROM #__ijoomla_surveys_menu_heading WHERE m_id='".$answer_data[0]['m_id']."'");
								if (!$database->query()){
									die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
								}
								$value_text=$database->loadResult();
								$mail_send.=stripslashes($value_text)."&nbsp;&nbsp;";
								$answers_per_question++;

							}
							if (isset($answer_data[0]['ac_id'])&&$answer_data[0]['ac_id']!=0){
								$database->setQuery("SELECT value FROM #__ijoomla_surveys_answer_columns WHERE ac_id='".$answer_data[0]['ac_id']."'");
								if (!$database->query()){
									die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
								}
								$value_text=$database->loadResult();
								$mail_send.=stripslashes($value_text)."&nbsp;&nbsp;";
								$answers_per_question++;

							}
							//echo $questions[0][type].' == <br />';
							if($questions[$c][type])
							{
								$database->setQuery("SELECT value FROM #__ijoomla_surveys_result WHERE ac_id='".$answer_data[0]['ac_id']."'");
							}
						}elseif (trim($result_count)!=''){
							$mail_send .= $result_count."&nbsp;&nbsp;";
							$answers_per_question++;
							 if($valid == 'moreline'){
											$value_text = 'moreline';
											}
						}
					}
				}
				if (isset($mail_result[0][2])&&count($mail_result[0][2])!=0){

					foreach ($mail_result[0][2] as $result_text_count => $result_text_id){

						if(is_numeric($result_text_count)){
							$database->setQuery("select value from #__ijoomla_surveys_result_text WHERE rt_id = '".$result_text_id."' AND  q_id='".$value."' ");
							//echo "select value from #__ijoomla_surveys_result WHERE rt_id = '".$result_text_id."' AND  q_id='".$value."' ";
							if (!$database->query()){
								die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
							}
							$value_text=$database->loadResult();
							$value_text;
							if ($value_text){
								$mail_send.=stripslashes($value_text)."&nbsp;&nbsp;";
								$answers_per_question++;
							}
						}elseif (trim($result_text_count)!=''){
							$mail_send .= $result_text_count."&nbsp;&nbsp;";
							$answers_per_question++;
						}

					}
				}

				if ($answers_per_question==0){
					$mail_send .= _NO_ANSWER."&nbsp;&nbsp;";
				}

				$mail_send .= "<br />&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			$replace_content = str_replace("#RESULTS#",$mail_send,$sett[0]["email_settings_content"]);
			$database->setQuery("select * from #__ijoomla_surveys_surveys WHERE s_id = '".$s_id."'");
			if (!$database->query()){
				die("Error !Code 22: The process could not be finished due to internal error. Please contact the administrators");
			}
			$survey_name=$database->loadAssocList();
			$survey_mail = $survey_name[0]["title"];
			$replace_content = str_replace("#SURVEYNAME#",$survey_mail,$replace_content);

			$connected_username=$my->username;
			if ($connected_username==""){
				$replace_content = str_replace("User: #USER#",'',$replace_content);
			}
			else {
				$replace_content = str_replace("#USER#",$connected_username,$replace_content);
			}
						  
		   //mail($email_send_array_value, $sett[0]["email_settings_subject"], $replace_content, $headers);
		   $frommail = $send_email_from;
		   JUtility::sendMail($frommail,$fromname,$email_send_array_value, $sett[0]["email_settings_subject"], $replace_content, 1 );

		}
	}//end foreach many email separated by comma
}

function survey_finish($sess_id){
	$database = &JFactory::getDBO();
	$database->setQuery("UPDATE #__ijoomla_surveys_session SET completed='1',last_page_id='0',played_time='".time()."' WHERE session_id='$sess_id' ");
    if (!$database->query()){
        die("Error !Code 23: The process could not be finished due to internal error. Please contact the administrators");
    }
    if (isset($_SESSION["sess_id"])) {
        unset($_SESSION["sess_id"]);
    }

	$_SESSION["survey"]=null;
	$_SESSION["order"]=null;
	$_SESSION["order_column"]=null;
	$_SESSION["pre_page"]=null;
	if (isset($_SESSION["visited_pages"])){
	    $_SESSION["visited_pages"]=null;
	}

}

function check_anwered_questions($sess_id){
    $database = &JFactory::getDBO();
    $database->setQuery("SELECT COUNT(*) FROM #__ijoomla_surveys_result WHERE session_id=$sess_id");
    if (!$database->query()){
        die("Error !Code 60: The process could not be finished due to internal error. Please contact the administrators");
    }
    $results = $database->loadResult();
    $database->setQuery("SELECT COUNT(*) FROM #__ijoomla_surveys_result_text WHERE session_id=$sess_id");
    if (!$database->query()){
        die("Error !Code 60: The process could not be finished due to internal error. Please contact the administrators");
    }
    $results2 = $database->loadResult();

    $total = $results + $results2;
    if ($total>0){
        return 1;
    }else{
        return 0;
    }
}

function delete_session($sess_id){
    $database = &JFactory::getDBO();
	$database->setQuery("DELETE FROM #__ijoomla_surveys_session WHERE session_id='$sess_id' LIMIT 1");
    if (!$database->query()){
        die("Error !Code 61: The process could not be finished due to internal error. Please contact the administrators");
    }
    if (isset($_SESSION["sess_id"])) {
        unset($_SESSION["sess_id"]);
    }

	$_SESSION["survey"]=null;
	$_SESSION["order"]=null;
	$_SESSION["order_column"]=null;
	$_SESSION["pre_page"]=null;
	if (isset($_SESSION["visited_pages"])){
	    $_SESSION["visited_pages"]=null;
	}
}

function survey_finish_incomplete($s_id,$user_id){
    $database = &JFactory::getDBO();
	$database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE user_id='$user_id' AND s_id='$s_id' AND ip='".$_SERVER['REMOTE_ADDR']."' AND completed<>'1' ");
    if (!$database->query()){
        die("Error !Code 24: The process could not be finished due to internal error. Please contact the administrators");
    }
    $sess_list = $database->loadAssocList();

    foreach ($sess_list as $index => $sess_array){
    	$questions_answered = check_anwered_questions($sess_array['session_id']);

    	if ($questions_answered==0){
        	$database->setQuery("DELETE FROM #__ijoomla_surveys_session WHERE session_id='".$sess_array['session_id']."' LIMIT 1");
            if (!$database->query()){
                die("Error !Code 63: The process could not be finished due to internal error. Please contact the administrators");
            }
        }else{
            $database->setQuery("UPDATE #__ijoomla_surveys_session SET completed='1', last_page_id='0' WHERE session_id='".$sess_array['session_id']."'");
            if (!$database->query()){
                die("Error !Code 64: The process could not be finished due to internal error. Please contact the administrators");
            }
        }
    }

    if (isset($_SESSION["sess_id"])) {
        $_SESSION["sess_id"]=null;
    }

	$_SESSION["survey"]=null;
	$_SESSION["order"]=null;
	$_SESSION["order_column"]=null;
	$_SESSION["pre_page"]=null;
}


function ipExist($ip, $s_id, $user_id){
	$and = "";
	if($user_id != "0"){
		$and = " and user_id=".$user_id;
	}
	$db =& JFactory::getDBO();
	$sql = "select count(*) from #__ijoomla_surveys_session where ip='".$ip."' and (completed=1 and last_page_id=0) and s_id=".$s_id.$and;
	$db->setQuery($sql);
	$db->query();
	$result = $db->loadResult();
	if($result != 0){
		return TRUE;
	}
	return FALSE;
}


function check_left_off($s_id,$user_id){

	
	$database = &JFactory::getDBO();
	$sql = "SELECT last_page_id FROM #__ijoomla_surveys_session WHERE s_id='$s_id' AND user_id='$user_id' AND completed<>'1' AND ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY session_id ASC LIMIT 1";
	$database->setQuery($sql);
	//$database->setQuery("SELECT last_page_id FROM #__ijoomla_surveys_session WHERE s_id='$s_id' AND user_id='$user_id' AND ip='".$_SERVER['REMOTE_ADDR']."' AND completed<>'1' ORDER BY session_id ASC LIMIT 1");
	if (!$database->query()){
		die("Error !Code 25: The process could not be finished due to internal error. Please contact the administrators");
	}
	if ($database->getNumRows()>0){	
		$last_page_id=$database->loadResult();
		return $last_page_id; 
	}
	else {	
	  return -1;
	}
}

function check_incompleted($s_id, $user_id){
	$database = &JFactory::getDBO();

    //$database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id='$s_id' AND user_id='$user_id' AND ip='".$_SERVER['REMOTE_ADDR']."' AND completed='1' ORDER BY session_id DESC LIMIT 1");
    $database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND user_id = $user_id AND completed = 0 AND ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY session_id DESC LIMIT 1");
    if (!$database->query()){
      die("Error !Code 26: The process could not be finished due to internal error. Please contact the administrators");
    }
    $completed_session_id=$database->loadResult();
    if ($completed_session_id>0){
		return $completed_session_id;
    }
    else{
		return 0;
    }
}

function check_completed($s_id, $user_id){
	$database = &JFactory::getDBO();

    //$database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id='$s_id' AND user_id='$user_id' AND ip='".$_SERVER['REMOTE_ADDR']."' AND completed='1' ORDER BY session_id DESC LIMIT 1");
    $database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND user_id = $user_id AND completed = 1 AND ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY session_id DESC LIMIT 1");
    if (!$database->query()){
      die("Error !Code 26: The process could not be finished due to internal error. Please contact the administrators");
    }
    $completed_session_id=$database->loadResult();
    if ($completed_session_id>0){
		return $completed_session_id;
    }
    else{
		return 0;
    }
}

function view_page($s_id,$s_title='',$page_id) {
	global $homelink;
	$my = &JFactory::getUser();

	$css_page_name = JRequest::getVar('css_page_name');
	$css_page_description = JRequest::getVar('css_page_description');
	$css_question = JRequest::getVar('css_question');
	$css_question_description = JRequest::getVar('css_question_description');
	$css_button = JRequest::getVar('css_button');

$database = &JFactory::getDBO();
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND page_id='$page_id' AND published=1");
    if (!$database->query()){
        die("Error !Code 27: The process could not be finished due to internal error. Please contact the administrators");
    }
	$page=$database->loadAssocList();

		$page_info=$page[0];
		$database->setQuery("SELECT page_id,ordering FROM #__ijoomla_surveys_pages WHERE s_id=$s_id AND page_id<>$page_id AND ordering >=".$page_info["ordering"]." AND published=1 ORDER BY ordering ASC LIMIT 1");
        if (!$database->query()){
            die("Error !Code 27: The process could not be finished due to internal error. Please contact the administrators");
        }
		if(isset($_REQUEST['Itemid']) && intval($_REQUEST['Itemid'])>0)
			$itemid_value="&Itemid=".$_REQUEST['Itemid'];
		else $itemid_value="";;
		if ($database->getNumRows()>0) {
			list($nextpage,$order)=$database->loadRow();
			 //$target=JRoute::_($homelink.'&amp;act=view_survey&amp;survey='.stripslashes($s_title).'&amp;page='.$nextpage);
		
			//start alin comment
					/*$target=JRoute::_('index.php?option=com_surveys&amp;act=view_survey&amp;survey='.addslashes($s_title).'&amp;page='.$nextpage.$itemid_value);*/
			//end alin comment
			
			//start alin
			$target=JRoute::_('index.php?option=com_surveys&amp;act=view_survey&amp;survey='.$s_id.":".$s_title.'&amp;page='.$nextpage.$itemid_value);
			//end alin
		}
		else {
			$nextpage="-1";
			//$target=JRoute::_($homelink.'&amp;act=view_survey&amp;survey='.stripslashes($s_title).'&amp;page=last');
			//start alin comment
			/*$target=JRoute::_('index.php?option=com_surveys&amp;act=view_survey&amp;survey='.addslashes($s_title).'&amp;page=last'.$itemid_value);
			//end alin comment*/
			
			//start alin
			$target=JRoute::_('index.php?option=com_surveys&amp;act=view_survey&amp;survey='.$s_id.":".$s_title.'&amp;page=last'.$itemid_value);
			//end alin
		}

		echo '<form id="view_survey" name="view_survey" method="post" action="'.$target.'">';//onsubmit="return validate_form(this)"

		echo "<table width='100%'>";
		if ($page_info['show_title']){

			echo "<tr class='$css_page_name'><td >".stripslashes($page_info["title"])."</td></tr>";
			//echo "<tr><td class='$css_page_description'>";
			if ($page_info["images"]) {
				echo "<table align='left'><tr><td align='left' style='padding-right:10px;padding-bottom:10px'><img src='".JURI::base()."images/stories/".$page_info["images"]."' alt='no image'/></td></tr></table>";
			}
			//echo stripslashes($page_info["description"])."</td></tr>";
		}
			echo "<tr><td class='$css_page_description'>";
			echo stripslashes($page_info["description"])."</td></tr>";
		echo "</table>";
		$now=time();
		$database->setQuery("SELECT * FROM #__ijoomla_surveys_questions WHERE s_id=$s_id  AND page_id=$page_id AND start_date<=$now AND end_date>=$now AND published=1 ORDER BY ordering ASC");
        if (!$database->query()){
            die("Error !Code 27: The process could not be finished due to internal error. Please contact the administrators");
        }

        ij_starttable('100%',"");
    $num = $database->getNumRows();
    if($num > 0) {
			$questions=$database->loadAssocList();
			$script='<script type="text/javascript">
					<!--
					var form=document.view_survey;
					var AlertText = "'._QUESTIONS_REQUIRED.' (*). \n\n";
					function validate_form(thisform) {
						';//with (thisform) {

			if (isset($_SESSION["survey"]['page_'.$page_id])){
			    if (!is_array($_SESSION["survey"]['page_'.$page_id])){
			        $data=unserialize($_SESSION["survey"]['page_'.$page_id]);
                }else{
                    $data=$_SESSION["survey"]['page_'.$page_id];
                }
			}
      else{   $data=null;   }

			foreach ($questions as $question_info) {
			  echo '<tr><td><table width="100%">';
				echo "<tr class='$css_question'><td ><br><span class='$css_question'>".text_wrap(stripslashes($question_info["title"]),30,"<br />").'<a id="id'.$question_info["q_id"].'"></a>';
				if ($question_info["required"]==1) {
					 echo "<span style='color:red'>*</span>";
					 $required=1;
				}
				echo "</span></td></tr>";

				echo "<tr class='$css_question_description'><td>";
				echo "<span class='$css_question_description'>".text_wrap(stripslashes($question_info["description"]),30,"<br />")."</span>
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
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars(text_wrap(stripslashes($question_info["title"]),30,"<br />")))."\");												 											
						getfocus(".$question_info["q_id"].");
						return false;} ";
				}
				elseif ($question_info["orientation"]=="matrix") {
					view_matrix_answers($question_info["q_id"],$question_info["type"],$order,$orderC,$dataq);
					if ($question_info["required"]==1)
					$typ = $question_info["type"];
					$q_id = $question_info["q_id"];
					if( $typ  == 'menu'){
						$database->setQuery("SELECT `a_id` FROM #__ijoomla_surveys_answers WHERE q_id=$q_id");
							//echo "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$question_info["q_id"];die();
			            if (!$database->query()){
			                die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
			            }
				    		if ($database->getNumRows()>0) {
				    				$a_id=$database->loadAssocList();
				    		}

				    		$database->setQuery("SELECT COUNT(q_id) FROM #__ijoomla_surveys_answer_columns WHERE q_id=$q_id");
							//echo "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$question_info["q_id"];die();
			            if (!$database->query()){
			                die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
			            }
				    		if ($database->getNumRows()>0) {
				    				$num_colums = $database->loadAssocList();
				    		}
				    		//print_r($num_colums).'<br />';
				    		$num_col 	=  $num_colums[0]['COUNT(q_id)'];
				    		//for($i=0;$i<count($a_id);$i++)
				    		//{
				    			$yd 		= '';
				    			$check		= '';
				    			$condition	= '';
				    			//for($k=1;$k<=$num_col;$k++)
								for($k=1;$k <= count($a_id);$k++)
				    			{
				    				//$yd		= 'q'.$question_info["q_id"].'a'.$a_id[$i]['a_id'].$k;
									$yd= 'q'.$question_info["q_id"].'a'.$a_id[$k-1]['a_id'].$k;
					    			$check	.= 'i'.$k.' = document.getElementById("'.$yd.'").value ;
					    					';
					    			if($k == '1')
					    			{
					    				$condition .= 'i'.$k.' == -1';
									}
									else {
										$condition .= ' || i'.$k.' == -1';
									}

				    			}
				    			$condition .= ')';
								 $script.= $check.' if('.$condition."
									{
									alert(AlertText +\"".addslashes(htmlspecialchars(stripslashes($question_info["title"])))."\");
									getfocus(".$question_info["q_id"].");
									return false;}";
				    		//}

					}else{
						//iJoomal Si added for matrix problem with javascript
						if ($question_info["required"]==1){
						//iJoomal Si added for matrix problem with javascript
							$database->setQuery("SELECT `a_id` FROM #__ijoomla_surveys_answers WHERE q_id=$q_id");
								//echo "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$question_info["q_id"];die();
							if (!$database->query()){
								die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
							}
								if ($database->getNumRows()>0) {
										$a_id=$database->loadAssocList();
								}

								$database->setQuery("SELECT COUNT(q_id) FROM #__ijoomla_surveys_answer_columns WHERE q_id=$q_id");
								//echo "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$question_info["q_id"];die();
							if (!$database->query()){
								die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
							}
								if ($database->getNumRows()>0) {
										$num_colums = $database->loadAssocList();
								}
								//print_r($num_colums).'<br />';
								$num_col 	=  $num_colums[0]['COUNT(q_id)'];
								if($question_info["required"] == '0')
									{
									//	echo $condition;die();
										$script .= $check."
													return true;
													";
									}
								for($i=0;$i<count($a_id);$i++)
								{
									$yd 			= '';
									$check		= '';
									$condition	= '';
									for($k=1;$k<=$num_col;$k++)
									{
										$yd		= 'q'.$question_info["q_id"].'a'.$a_id[$i]['a_id'].$k;
										$check	.= 'i'.$k.' = document.getElementById("'.$yd.'").checked ;
												';
										if($k == '1')
										{
											$condition .= 'i'.$k.' == false';
										}
										else {
											$condition .= ' && i'.$k.' == false';
										}

									}


									 $script.= $check.'

										 if('.$condition.")
										{
										alert(AlertText +\"".addslashes(htmlspecialchars(stripslashes($question_info["title"])))."\");
										getfocus(".$question_info["q_id"].");
										return false;}";
								}
						}//else from iJoomal Si added for matrix problem with javascript
					}// else from menu condition
				}
				elseif ($question_info["orientation"]=="dropdown") {
					view_dropdown_answers($question_info["q_id"],$question_info["type"],$question_info["other_field"],$question_info["other_field_title"],$order,$dataq);
					if ($question_info["required"]==1)
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars(text_wrap(stripslashes($question_info["title"]),30,"<br />")))."\");						
						getfocus(".$question_info["q_id"].");
						return false;}";
				}
				elseif ($question_info["orientation"]=="horizontal") {

					view_horizontal_answers($question_info["q_id"],$question_info["type"],$order,$dataq);
					if ($question_info["required"]==1)
						$script.="if (form.q".$question_info["q_id"].".value==0 && form.qtext".$question_info["q_id"].".value==0) { alert(AlertText +\"".addslashes(htmlspecialchars(text_wrap(stripslashes($question_info["title"]),30,"<br />")))."\");						
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
						if ($question_info["required"]==1) {
							$script.="	var rq".$question_info["q_id"]."='required';";
						}
						else {
						    $script.="	var rq".$question_info["q_id"]."='none';";
                        }
						view_date_answers($question_info["q_id"],$order,$script,$dataq);
						echo "<input type='hidden' name='q".$question_info["q_id"]."' id='q".$question_info["q_id"]."' value='0'/>";
					}
					elseif ($question_info["type"]=='moreline') {
						view_open_more_line($question_info["q_id"],$order,$script,$question_info["required"],$dataq);

					}
					else {
						view_open_answers($question_info["q_id"],$question_info["type"],$dataq);
						if ($question_info["required"]==1) {
						//changed for auto fill - start
							$script.="
							var field_answer_text = document.getElementById(\"question[".$question_info["q_id"]."][answer_text]\");
							setentertext(form.q".$question_info["q_id"].",field_answer_text.value);
							var field = document.getElementById(\"q".$question_info["q_id"]."\");
							var field_qtext = document.getElementById(\"qtext".$question_info["q_id"]."\");
							if (field.value==0 && field_qtext.value==0) { alert(AlertText +\"".addslashes(strip_tags(stripslashes($question_info["title"])))."\");
						 document.getElementById(\"question[".$question_info["q_id"]."][answer_text]\").focus();
						 return false;}";
						//changed for auto fill - end
						}
					}
				}
				$entered="";
				if (isset($data[$question_info["q_id"]])&&is_array($data[$question_info["q_id"]])){
				    $entered="1";
				}
				if (isset($data[$question_info["q_id"]]["answer_text"])){
				    $text=$data[$question_info["q_id"]]["answer_text"];
				}else{
				    $text="";
                }
				echo "<input type='hidden' name='q".$question_info["q_id"]."' id='q".$question_info["q_id"]."' value='$entered'/>
					  <input type='hidden' name='qtext".$question_info["q_id"]."' id='qtext".$question_info["q_id"]."' value='$text'/>";
				echo "</td></tr>";


				echo '</table></td></tr>';
			}

			$script.="


			} // END FUNTION VALIDATE FORM
			-->
			</script>
			";//}  // END WITH THIS FORM
		}

		echo '<tr><td align="center">';

		    $database->setQuery("SELECT general_option FROM #__ijoomla_surveys_config");
		    $general_result=$database->loadResult();
		    if ($database->getErrorMsg()){
		        die($database->getErrorMsg());
		    }
			if (isset($_SESSION["pre_page"][$page_info["page_id"]])&&intval($_SESSION['pre_page'][$page_info["page_id"]])>0&&$general_result!=_ONE_RESPONSE_P_RESPONDENT_FO_VALUE) {
			    $target_page=$_SESSION['pre_page'][$page_info["page_id"]];
			    if ($target_page==-1){
			        $target_page ="last";
			    }
				
				//start alin comment
				/*$targetprev=$homelink.'&amp;act=view_survey&amp;survey='.$s_title.'&amp;page='.stripslashes($target_page);*/
				//end alin comment
				
				//start alin
				$homelink="index.php?option=com_surveys&Itemid=".$_REQUEST['Itemid'];
				$targetprev=$homelink.'&amp;act=view_survey&amp;survey='.$s_id.":".$s_title.'&amp;page='.stripslashes($target_page);
				//end alin
				

				echo  '<input type="hidden" name="flow_safety" value="secure" />';
				//echo  '<input type="button" name="Back" value="'._BACK_BTN.'" class="'.$css_button.'" onclick="history.go(-1);" /> &nbsp;';
				if($css_button == ""){
					$css_button = "art-button";
				}
				echo  '<input type="submit" name="Back" value="'._BACK_BTN.'" class="'.$css_button.'" onclick="form.action=\''.JRoute::_($targetprev).'\';" /> &nbsp;';
			}
			if($css_button == ""){
				$css_button = "art-button";
			}

      echo '<input type="hidden" name="cpage" value="'.$page_info["page_id"].'" />
            <input type="hidden" name="ordering" value="'.$page_info["ordering"].'" />';
	
	 
      // if there are questions on page then validate them
      if($num){	
         echo '<input type="submit" name="Submit" value="'._NEXT_BTN.'" class="'.$css_button.'"  onclick="return validate_form(form)" />';
	  }		
      else{ 	  	
	     echo '<input type="submit" name="Submit" value="'._NEXT_BTN.'" class="'.$css_button.'" />';
	  }		 

      echo '</td></tr>';

			ij_endtable();
			echo '</form>';
			if (isset($script)){
			    echo $script;
			}
}

function view_open_answers($q_id,$type='text',$data=null) {

	echo "<table width='100%'><tr><td align='left' valign='top'>

			<input type='hidden' name='question[$q_id][type]' value='$type' />
			<input type='hidden' name='question[$q_id][orientation]' value='dropdown' />
		";
	if (!isset($data["answer_text"])){
	    $data["answer_text"]=null;
	}
	if ($type=='textarea') {
		//Si added start
		echo '<textarea name="question['.$q_id.'][answer_text]" id="question['.$q_id.'][answer_text]" cols="35" rows="5" onchange="setentertext(form.q'.$q_id.',this)" >'.$data["answer_text"].'</textarea>';
		//Si added end
	}
	else 	{
		echo '<input name="question['.$q_id.'][answer_text]" type="text" id="question['.$q_id.'][answer_text]" size="35" value="'.$data["answer_text"].'" maxlength="250" onchange="setentertext(form.q'.$q_id.',this.value)" />';
	}

	echo "</td></tr></table>";
}

function view_dropdown_answers($q_id,$type="radio",$other_field=0,$other_field_title="",$order,$data=null){

	$css_dropdownmenu 	= JRequest::getVar('css_dropdownmenu');
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 	= JRequest::getVar('css_radiobutton');

	$database = &JFactory::getDBO();
	$css=$type=='radio'?$css_radiobutton:$css_checkbox;
	if (!isset($_SESSION["order"][$q_id])){
    	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
        if (!$database->query()){
            die("Error !Code 30: The process could not be finished due to internal error. Please contact the administrators");
        }
    	echo "<table width='100%'>";
    	if ($database->getNumRows()>0) {
    		$answers=$database->loadAssocList();
    		$i=0;
    		if (isset($data["answer"][$i])&&$data["answer"][$i]==''){
    		    $selected="selected";
    		}else{
    		    $selected="";
    		}

    		echo "<tr><td >
    					<input type='hidden' name='question[$q_id][type]' value='$type' />
    					<input type='hidden' name='question[$q_id][orientation]' value='dropdown' />
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
    					<input type='hidden' name='question[$q_id][type]' value='$type' />
    					<input type='hidden' name='question[$q_id][orientation]' value='dropdown' />
    					<select name='question[$q_id][answer][]' onchange='setselected(q$q_id,this,\"question[$q_id][answer_text]\")' class='$css_dropdownmenu'>
    					<option value='' >"._PLEASE_SELECT."</option>";
    		foreach ($_SESSION["order"][$q_id] as $a_id) {
    		     $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
                 if (!$database->query()){
                     die("Error !Code 30: The process could not be finished due to internal error. Please contact the administrators");
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
			echo "<tr><td class='$css_answer'><input name='question[$q_id][answer][]' type='$type' class='$css'/>".text_wrap($other_field_title,30,"<br />")."&nbsp;:&nbsp;&nbsp;";
			echo "<input name='question[$q_id][answer_text]' type='text' value='".$data["answer_text"]."' onkeyup='setentertext(form.q$q_id,this.value); if(this.value.length>0) {change_selected(\"question[$q_id][answer][]\",$i);} else {test_select(q$q_id,\"question[$q_id][answer][]\")};' />";
			echo "</td></tr>";
	}
	echo "</table>";
}

function view_date_answers($q_id,$order,&$script,$data=null) {

	$css_answer 		= JRequest::getVar('css_answer');
	$css_inputbox 		= JRequest::getVar('css_inputbox');

	$database = &JFactory::getDBO();
	if (!isset($_SESSION["order"][$q_id])){
    	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
        if (!$database->query()){
            die("Error !Code 31: The process could not be finished due to internal error. Please contact the administrators");
        }
    	echo "<table width='100%'>
    	<tr>
    		<td align='left'>
    		<input type='hidden' name='question[$q_id][type]' value='datetime' />
    		<input type='hidden' name='question[$q_id][orientation]' value='open' />
    		</td>";
    	/*
    		<td  align='left'>"._MM."</td>
    		<td  align='left'>"._DD."</td>
    		<td  align='left'>"._YYYY."</td>
    	</tr>";
    	*/

    		$m = "<td  align='left'>"._MM."</td>";
    		$d =	"<td  align='left'>"._DD."</td>";
    		$y = "<td  align='left'>"._YYYY."</td>";

    	if ($database->getNumRows()>0) {
    		$answers=$database->loadAssocList();
	    	if ($order !=""){
    		    $load_order=true;
           	    $_SESSION["order"][$q_id]=array();
    		}

    		$database->setQuery("SELECT `general_date` FROM `#__ijoomla_surveys_config` ");
					$date	= $database->loadAssocList();
				 	$date_option = $date[0]["general_date"];


				 	switch ($date_option)
						{
						case 1:
						   $content = $m.$d.$y;
						    break;
						case 2:
						    $content = $d.$m.$y;
						    break;
						case 3:
						   $content = $y.$m.$d;
						    break;
						case 4:
						   $content = $y.$d.$m;
							    break;
						}
				echo $content;
			echo "</tr>";
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
    			echo text_wrap(stripslashes($answer_info["value"]),30,"<br />");
    			echo "</td>";



    			$month	=  "<td>";
    			$month	.= "<input name='question[$q_id][answer][".$answer_info["a_id"]."][month]' type='text' value='".$ans_value["month"]."' id='am".$answer_info["a_id"]."' size='6' class='$css_inputbox' />";

    			$month	.= "</td>";

    			$day	=	 "<td>";
    			$day	.= "<input name='question[$q_id][answer][".$answer_info["a_id"]."][day]' type='text' value='".$ans_value["day"]."' id='ad".$answer_info["a_id"]."' size='4' class='$css_inputbox' />";
    			$day	.= "</td>";

    			$year	= "<td>";
    			$year .= "<input name='question[$q_id][answer][".$answer_info["a_id"]."][year]' type='text' value='".$ans_value["year"]."' id='ay".$answer_info["a_id"]."' o size='4' class='$css_inputbox' />";
    			$year .= "</td>";


					switch ($date_option)
						{
						case 1:
						   $content = $month.$day.$year;
						    break;
						case 2:
						    $content = $day.$month.$year;
						    break;
						case 3:
						   $content = $year.$month.$day;
						    break;
						case 4:
						   $content = $year.$day.$month;
							    break;
						}

    			echo $content;

    			echo "</tr>";
    			$script.="
    			if ((form.am".$answer_info["a_id"].".value!='' || form.ad".$answer_info["a_id"].".value!='' || form.ay".$answer_info["a_id"].".value!='' || rq$q_id=='required' )) {
    				if (checkNumber(form.am".$answer_info["a_id"].", 1, 2, 1, 12, '"._YOU_MUST_ENTER." "._THE_MONTH." (1-12)') == false || checkNumber(form.ad".$answer_info["a_id"].", 1, 2, 1, 31, '"._YOU_MUST_ENTER." "._THE_DAY." (1-31)') == false || checkNumber(form.ay".$answer_info["a_id"].", 4, 4, 1971, 2038, '"._YOU_MUST_ENTER." "._THE_YEAR." (1971-2038)') == false ) {
    					return false;
    				}
    			}";
    		}
    	}
	}else{
    	echo "<table width='100%'>
    	<tr>
    		<td  align='left'>
    		<input type='hidden' name='question[$q_id][type]' value='datetime' />
    		<input type='hidden' name='question[$q_id][orientation]' value='open' />
    		</td>";
    		/*<td align='left'>"._MM."</td>
    		<td align='left'>"._DD."</td>
    		<td align='left'>"._YYYY."</td>
    	</tr>";*/
    		$m = "<td  align='left'>"._MM."</td>";
    		$d =	"<td  align='left'>"._DD."</td>";
    		$y = "<td  align='left'>"._YYYY."</td>";

    				$database->setQuery("SELECT `general_date` FROM `#__ijoomla_surveys_config` ");
					$date	= $database->loadAssocList();
				 	$date_option = $date[0]["general_date"];


				 	switch ($date_option)
						{
						case 1:
						   $content = $m.$d.$y;
						    break;
						case 2:
						    $content = $d.$m.$y;
						    break;
						case 3:
						   $content = $y.$m.$d;
						    break;
						case 4:
						   $content = $y.$d.$m;
							    break;
						}
				echo $content;
				echo "</tr>";
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
    			echo text_wrap(stripslashes($answer_info["value"]),30,"<br />");
    			echo "</td>";

    			$month	=  "<td>";
    			$month	.= "<input name='question[$q_id][answer][".$answer_info["a_id"]."][month]' type='text' value='".$ans_value["month"]."' id='am".$answer_info["a_id"]."' size='6' class='$css_inputbox' />";
    			$month	.= "</td>";

    			$day	=	 "<td>";
    			$day	.= "<input name='question[$q_id][answer][".$answer_info["a_id"]."][day]' type='text' value='".$ans_value["day"]."' id='ad".$answer_info["a_id"]."' size='4' class='$css_inputbox' />";
    			$day	.= "</td>";

    			$year	= "<td>";
    			$year .= "<input name='question[$q_id][answer][".$answer_info["a_id"]."][year]' type='text' value='".$ans_value["year"]."' id='ay".$answer_info["a_id"]."' o size='4' class='$css_inputbox' />";
    			$year .= "</td>";

					switch ($date_option)
						{
						case 1:
						   $content = $month.$day.$year;
						    break;
						case 2:
						    $content = $day.$month.$year;
						    break;
						case 3:
						   $content = $year.$month.$day;
						    break;
						case 4:
						   $content = $year.$day.$month;
							    break;
						}

    			echo $content;

    			echo "</tr>";
    			$script.="if ((form.am".$answer_info["a_id"].".value!='' || form.ad".$answer_info["a_id"].".value!='' || form.ay".$answer_info["a_id"].".value!='' || rq$q_id=='required')) {
    				if (checkNumber(form.am".$answer_info["a_id"].", 1, 2, 1, 12, '"._YOU_MUST_ENTER." "._THE_MONTH." (1-12)') == false || checkNumber(form.ad".$answer_info["a_id"].", 1, 2, 1, 31, '"._YOU_MUST_ENTER." "._THE_DAY." (1-31)') == false || checkNumber(form.ay".$answer_info["a_id"].", 4, 4, 1971, 2038, '"._YOU_MUST_ENTER." "._THE_YEAR." (1971-2038)') == false ) {
    					return false;
    				}
    			}";
    		}
	}
	echo "</table>";
}

function view_open_more_line($q_id,$order,&$script,$required=0,$data){

	$css_answer 		= JRequest::getVar('css_answer');
	$css_inputbox 		= JRequest::getVar('css_inputbox');

	$database = &JFactory::getDBO();
	echo "<table width='100%'>";
	if (!isset($_SESSION["order"][$q_id])){
    	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
        if (!$database->query()){
            die("Error !Code 32: The process could not be finished due to internal error. Please contact the administrators");
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
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>&nbsp;";
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
                if (!$database->query()){
                    die("Error !Code 32: The process could not be finished due to internal error. Please contact the administrators");
                }
    		    $answers=$database->loadAssocList();
    		    $answer_info=$answers[0];
    		    if (isset($data["answer"][$answer_info["a_id"]])){
    		        $ans_value=$data["answer"][$answer_info["a_id"]];
    		    }else{
    		        $ans_value="";
    		    }
    			echo "<tr><td>";
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>&nbsp;";
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
				<input type='hidden' name='question[$q_id][type]' value='moreline' />
				<input type='hidden' name='question[$q_id][orientation]' value='open' />
		  </td></tr>";
	echo "</table>";

}

function view_checksum_answers($q_id,$order,$required,$constant,&$script,$data=null,$bounded=0,$minvalue=0,$maxvalue=0) {
	$css_answer 		= JRequest::getVar('css_answer');
	$css_inputbox 		= JRequest::getVar('css_inputbox');

	$database = &JFactory::getDBO();
	echo "<table width='100%'>";
	$script.="var checksum=0;
		checksum=0";
	if (!isset($_SESSION["order"][$q_id])){
    	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
        if (!$database->query()){
            die("Error !Code 33: The process could not be finished due to internal error. Please contact the administrators");
        }
    	if ($database->getNumRows()>0) {
    		$answers=$database->loadAssocList();
    		$counter_extra_script=0;
    		$counter_extra_script2=0;
    		$counter_extra_script_const=0;
    		$extra_script_condition="";
    		$extra_script_condition2="";
    		$extra_script_const="(";
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
    		    $counter_extra_script_const++;
    		    if (isset($data["answer"][$answer_info["a_id"]])){
    		        $ans_value=$data["answer"][$answer_info["a_id"]];
    		    }else{
    		        $ans_value="";
    		    }

    			echo "<tr><td>";
    			echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."]' type='text' size='4' value='".$ans_value."' onchange='setsum(this,document.view_survey.a".$answer_info["a_id"].")' $css_inputbox /> &nbsp;";
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>";
    			echo "<input type='hidden' name='a".$answer_info["a_id"]."' id='a".$answer_info["a_id"]."' value='".$ans_value."' />";
    			echo "</td></tr>";
    			$script.="+parseFloat(form.a".$answer_info["a_id"].".value)";
    			if ($counter_extra_script==1){
    				 $cond 						.= "form.a".$answer_info["a_id"].".value == ''";
    			    $extra_script_condition.="form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
    			}
    			else {
    				 $cond 						.= " && form.a".$answer_info["a_id"].".value == ''";
    			    $extra_script_condition.=" || form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
    			}

    			if ($constant!=0){
    			    if ($counter_extra_script_const==1){
    			        $extra_script_const.="(form.a".$answer_info["a_id"].".value!=''&&form.a".$answer_info["a_id"].".value!='NaN')";
    			    }else{
    			        $extra_script_const.="||(form.a".$answer_info["a_id"].".value!=''&&form.a".$answer_info["a_id"].".value!='NaN')";
    			    }
    			}
    			 //  echo $required;
    			if ($required==0){
        			if ($counter_extra_script2==1){
        				 $condn 						.= "form.a".$answer_info["a_id"].".value == ''";
        			    $extra_script_condition2.="form.a".$answer_info["a_id"].".value=='NaN'";
        			}
        			else {
        				 $condn 						.= " && form.a".$answer_info["a_id"].".value == ''";
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
    	if($required == 0)
    	{
    		$cond = $condn;
		}
	}else{
    		$counter_extra_script=0;
    		$counter_extra_script2=0;
    		$counter_extra_script_const=0;
    		$extra_script_condition="";
    		$extra_script_condition2="";
    		$extra_script_const="(";
    		$bounded_script_condition="";
    		foreach ($_SESSION["order"][$q_id] as $a_id) {
    	        $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
                if (!$database->query()){
                    die("Error !Code 33: The process could not be finished due to internal error. Please contact the administrators");
                }
    		    $answers=$database->loadAssocList();
    		    $answer_info=$answers[0];
    		    $counter_extra_script++;
    		    $counter_extra_script2++;
    		    $counter_extra_script_const++;
    		    if (isset($data["answer"][$answer_info["a_id"]])){
    		        $ans_value=$data["answer"][$answer_info["a_id"]];
    		    }else{
    		        $ans_value="";
    		    }
    			echo "<tr><td>";
    			echo "<input name='question[$q_id][answer][".$answer_info["a_id"]."]' type='text' size='4' value='".$ans_value."' onchange='setsum(this,document.view_survey.a".$answer_info["a_id"].")' $css_inputbox /> &nbsp;";
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>";
    			echo "<input type='hidden' name='a".$answer_info["a_id"]."' id='a".$answer_info["a_id"]."' value='".$ans_value."' />";
    			echo "</td></tr>";
    			$script.="+parseFloat(form.a".$answer_info["a_id"].".value)";
    			if ($counter_extra_script==1){
    			    $extra_script_condition.="form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
    			}
    			else {
    			    $extra_script_condition.=" || form.a".$answer_info["a_id"].".value=='NaN'||form.a".$answer_info["a_id"].".value==''";
    			}

    			if ($constant!=0){
    			    if ($counter_extra_script_const==1){
    			        $extra_script_const.="(form.a".$answer_info["a_id"].".value!=''&&form.a".$answer_info["a_id"].".value!='NaN')";
    			    }else{
    			        $extra_script_const.="||(form.a".$answer_info["a_id"].".value!=''&&form.a".$answer_info["a_id"].".value!='NaN')";
    			    }
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
        			if ($counter_extra_script==1) {
        			    $bounded_script_condition.="form.a".$answer_info["a_id"].".value<$minvalue || form.a".$answer_info["a_id"].".value>$maxvalue";
        			}
        			else {
        			    $bounded_script_condition.=" || form.a".$answer_info["a_id"].".value<$minvalue || form.a".$answer_info["a_id"].".value>$maxvalue";
        			}
    			}
    		}
	}
	if ($extra_script_const!="("){
	    $extra_script_const.=")";
	}else{
	    $extra_script_const="";
	}
	echo "<tr><td>
				<input type='hidden' name='question[$q_id][type]' value='constant' />
				<input type='hidden' name='question[$q_id][orientation]' value='open' />
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
				        		if($cond)
							    {
							    return true;
							    }
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
				    var err_msg;
					if (isNaN(checksum)==true){
				        err_msg='"._NOT_EMPTY_CHOICES." ';
				    }else{
				        err_msg='"._THEY_ADD_UP_TO." ' + checksum;
				    }
					alert(AlertText +' "._CHOICES_MUST_ADD_UP." $constant .' + err_msg  );
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
		if ($constant!=0) {
			$script.="
				if (checksum!=$constant && $extra_script_const) 	{
				    var err_msg;
				    if (isNaN(checksum)==true){
				        err_msg='"._NOT_EMPTY_CHOICES." "._IF_COMPLETED."';
				    }else{
				        err_msg='"._THEY_ADD_UP_TO." ' + checksum;
				    }
					alert(' "._CHOICES_MUST_ADD_UP." $constant .' + err_msg);
					getfocus($q_id);
					return false;
				}";
		}
		$script.="
			        if ( $extra_script_condition2 ){
					    alert(' "._CHOICES_MUST_BE_NUMBERS."');
					    getfocus($q_id);
					    return false;
		            }";
    }
}

function view_vertical_answers($q_id,$type="radio",$other_field=0,$other_field_title="",$order,$data=null){

	$css_inputbox 		= JRequest::getVar('css_inputbox');
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 	= JRequest::getVar('css_radiobutton');

	$css=$type=='radio'?$css_radiobutton:$css_checkbox;
	$database = &JFactory::getDBO();
	if (!isset($_SESSION["order"][$q_id])){
    	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
        if (!$database->query()){
            die("Error !Code 34: The process could not be finished due to internal error. Please contact the administrators");
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

          if ($type=="radio"){
    			echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onclick='setentered(form.q$q_id,this,\"question[$q_id][answer_text]\")' $checked class='$css'/>";
                }else{
    			echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this,\"question[$q_id][answer_text]\")' $checked class='$css'/>";
                }
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>";
    			echo "</td></tr>";
    			$i++;
    		}
    	}
	}else{
    	echo "<table width='100%'>";
    	$i=0;
    	foreach ($_SESSION["order"][$q_id] as $a_id) {
    	    $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
            if (!$database->query()){
                die("Error !Code 34: The process could not be finished due to internal error. Please contact the administrators");
            }
    		$answers=$database->loadAssocList();
    		$answer_info=$answers[0];
  			$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
   			echo "<tr><td>";

        if ($type=="radio"){
   			echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onclick='setentered(form.q$q_id,this,\"question[$q_id][answer_text]\")' $checked class='$css'/>";
            }else{
   			echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this,\"question[$q_id][answer_text]\")' $checked class='$css'/>";
            }
   			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>";
   			echo "</td></tr>";
   			$i++;
    	}
	}
	if ($other_field!=0) {
	       	if (!isset($data["answer_text"])){
	            $data["answer_text"]=null;
	        }
			echo "<tr><td class='$css_answer'><input name='question[$q_id][answer][]' type='$type' class='$css'/>".text_wrap(stripslashes($other_field_title),30,"<br />")."&nbsp;:&nbsp;&nbsp;";
			echo "<input name='question[$q_id][answer_text]' type='text' value='".$data["answer_text"]."' onkeyup='setentertext(form.q$q_id,this.value); if(this.value.length>0) {change_checked(\"question[$q_id][answer][]\",$i);} else {test_radios(q$q_id,\"question[$q_id][answer][]\",$i)}' class='$css_inputbox'/>";
			echo "</td></tr>";
	}
	echo "<tr><td>
				<input type='hidden' name='question[$q_id][type]' value='$type' />
				<input type='hidden' name='question[$q_id][orientation]' value='vertical' />
		  </td></tr></table>";
}

function view_horizontal_answers($q_id,$type="radio",$order,$data=null){
	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 	= JRequest::getVar('css_radiobutton');

	$database = &JFactory::getDBO();
	$css=$type=='radio'?$css_radiobutton:$css_checkbox;
	if (!isset($_SESSION["order"][$q_id])){
    	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
        if (!$database->query()){
            die("Error !Code 35: The process could not be finished due to internal error. Please contact the administrators");
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
			$nr_q = 0;
    		foreach ($answers as $answer_info) {
            	if ($load_order){
            	    array_push($_SESSION["order"][$q_id],$answer_info["a_id"]);
            	}
    			$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
    			echo "<td width='$percent%' valign=\"top\">";

          if ($type=="radio"){

            echo "<input name='question[$q_id][answer][]' id='question[$q_id][answer][$nr_q]' type='$type' value='".$answer_info["a_id"]."' onclick='setentered(form.q$q_id,this)' $checked class='$css'/>";
          }else{
              echo "<input name='question[$q_id][answer][]' id='question[$q_id][answer][$nr_q]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/>";
                }
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>";
    			echo "</td>";
				$nr_q++;
    		}
    		echo "</tr><tr><td><input type='hidden' name='question[$q_id][type]' value='$type' />
						<input type='hidden' name='nr_q' value='$nr_q' id='nr_q' />
    					<input type='hidden' name='question[$q_id][orientation]' value='horizontal' /></td></tr></table>";
    	}
	}else{
    	    $numrows=count($_SESSION["order"][$q_id]);

    		$i=0;
    		$percent=(int)(100/$numrows);
    		echo "<table width='100%'><tr>";
    		foreach ($_SESSION["order"][$q_id] as $a_id) {
            	$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
                if (!$database->query()){
                    die("Error !Code 35: The process could not be finished due to internal error. Please contact the administrators");
                }
            	$answers=$database->loadAssocList();
            	$answer_info=$answers[0];
    			$checked=in_array($answer_info["a_id"],$data["answer"])?" Checked":"";
    			echo "<td width='$percent%' valign=\"top\">";

          if ($type=="radio"){
            $id = 'q'.$q_id.'a'.$answer_info["a_id"].$count;
            echo "<input id = '$id' name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onclick='setentered(form.q$q_id,this)' $checked class='$css'/>";
    			}
          else{
            echo "<input name='question[$q_id][answer][]' type='$type' value='".$answer_info["a_id"]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/>";
    			}
    			echo "<span class='$css_answer'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span>";
    			echo "</td>";
    		}
    		echo "</tr><tr><td><input type='hidden' name='question[$q_id][type]' value='$type' />
    					<input type='hidden' name='question[$q_id][orientation]' value='horizontal' /></td></tr></table>";
	}
}

function view_matrix_answers($q_id,$type="radio",$order='',$orderC='',$data=null){

	$css_answer 		= JRequest::getVar('css_answer');
	$css_checkbox 		= JRequest::getVar('css_checkbox');
	$css_radiobutton 	= JRequest::getVar('css_radiobutton');
	$css_dropdownmenu 	= JRequest::getVar('css_dropdownmenu');

	$css_column_heading = JRequest::getVar('css_column_heading');
	$css_row_heading 	= JRequest::getVar('css_row_heading');
	$css_table_row1 	= JRequest::getVar('css_table_row1');
	$css_table_row2 	= JRequest::getVar('css_table_row2');


	$database = &JFactory::getDBO();

	$css=$type=='radio'?$css_radiobutton:$css_checkbox;

	$order1=$orderC==' ORDER BY RAND()'?"ORDER BY RAND()":" ORDER BY ac_id ASC";
	$order2=$order==' ORDER BY RAND()'?"ORDER BY RAND()":" ORDER BY m_id ASC";

  if ($type=="radio" || $type=="checkbox") {
	     if (!isset($_SESSION["order_column"][$q_id])&&!isset($_SESSION["order"][$q_id])){
   	 	 $database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=$q_id $order1");
       if (!$database->query()){
            die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
        }
    		$numcolumns = $database->getNumRows();
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
    		echo "<table width='100%'><tr class='$css_column_heading'><td width='40%'><input type='hidden' name='question[$q_id][type]' value='$type' />
    				<input type='hidden' name='question[$q_id][orientation]' value='matrix' /></td>";

        for ($i=0;$i<count($c_value);$i++) {
    				echo "<td width='$percent%' align='center' style='padding:5px' class='$css_column_heading'>".text_wrap(stripslashes($c_label[$i]),30,"<br />")."</td>";
    		}
    		echo "</tr>";

        $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
            if (!$database->query()){
                die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
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
    					if ($j%2!=0) $class=$css_table_row1;
    					else $class=$css_table_row2;
    					echo "<tr class='$class'><td align='left'><span class='$css_row_heading'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span></td>";

              $count = 0;
    					for ($i=0;$i<count($c_value);$i++) {
    					    $checked="";
    						if (isset($data["answer"][$answer_info["a_id"]])&&is_array($data["answer"][$answer_info["a_id"]])){
    						    $checked=in_array($c_value[$i],$data["answer"][$answer_info["a_id"]])?" Checked":"";
    						}

    						if ($type=="radio"){
    								$count++;
                            	$id = 'q'.$q_id.'a'.$answer_info["a_id"].$count;
    						//modified
							//echo "<td align='center'><input name='question[$q_id][answer][".$answer_info["a_id"]."][".$count."]' id='$id' type='$type' value='".$c_value[$i]."' $checked class='$css'/></td>";
							echo "<td align='center'><input name='question[$q_id][answer][".$answer_info["a_id"]."][]' id='$id' type='$type' value='".$c_value[$i]."' onclick='setentered(form.q$q_id,this,\"question[$id][answer][".$answer_info["a_id"]."][]\")' $checked class='$css'/></td>";
                            }else{

                            	$count++;
                            	$id = 'q'.$q_id.'a'.$answer_info["a_id"].$count;
    						echo "<td align='center'><input name='question[$q_id][answer][".$answer_info["a_id"]."][".$count."]' id='$id' type='$type' value='".$c_value[$i]."'  $checked class='$css'  /></td>";

                            }
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
                    if (!$database->query()){
                        die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                    }
    			    $answer_columns=$database->loadAssocList();
    			    $column_info=$answer_columns[0];
        			$c_value[]=$column_info["ac_id"];
        			$c_label[]=$column_info["value"];
    			}
    		}
    		echo "<table width='100%'><tr class='$css_column_heading'><td width='40%'><input type='hidden' name='question[$q_id][type]' value='$type' />
    				<input type='hidden' name='question[$q_id][orientation]' value='matrix' /></td>";
    		for ($i=0;$i<count($c_value);$i++) {
    				echo "<td width='$percent%' align='center' style='padding:5px' class='$css_column_heading'>".text_wrap(stripslashes($c_label[$i]),30,"<br />")."</td>";
    		}
    		echo "</tr>";

    				$j=0;
    				foreach ($_SESSION["order"][$q_id] as $a_id)	{
              $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
                  if (!$database->query()){
                      die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                  }
              $answers=$database->loadAssocList();
              $answer_info=$answers[0];
    					if ($j%2!=0) {
    					    $class=$css_table_row1;
    					}
    					else {
    					    $class=$css_table_row2;
    					}
    					echo "<tr class='$class'><td align='left'><span class='$css_row_heading'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</span></td>";

              $count = 0;
              $cnum = count($c_value);
              for ($i=0; $i<$cnum; $i++) {
    					  $checked="";
    						if (isset($data["answer"][$answer_info["a_id"]])&&is_array($data["answer"][$answer_info["a_id"]])){
    						    $checked=in_array($c_value[$i],$data["answer"][$answer_info["a_id"]])?" Checked":"";
    						}

    						if ($type=="radio"){
                  $count++;
                  $id = 'q'.$q_id.'a'.$answer_info["a_id"].$count;
                  echo "<td align='center'><input id = '$id' name='question[$q_id][answer][".$answer_info["a_id"]."][]' type='$type' value='".$c_value[$i]."' onclick='setentered(form.q$q_id,this)' $checked class='$css'/></td>";
    						}
                else{
                  echo "<td align='center'><input name='question[$q_id][answer][".$answer_info["a_id"]."][]' type='$type' value='".$c_value[$i]."' onchange='setentered(form.q$q_id,this)' $checked class='$css'/></td>";
    						}
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
    			echo "<tr><td width='10%'></td>";
    			$database->setQuery("SELECT * FROM #__ijoomla_surveys_menu_heading WHERE q_id=$q_id $order2");
                if (!$database->query()){
                    die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                }
    			$total_menus=$database->getNumRows();
    			$percent=intval(50/$total_menus);

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
    					echo "<td width='90%'>".$m_info["value"]."</td>";
    					$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE m_id=".$m_info["m_id"]." $order1");
                        if (!$database->query()){
                            die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                        }
    					if ($database->getNumRows()>0) {
    						$items=$database->loadAssocList();
    						foreach ($items as $c_info){
    							$option["ac_id"]=$c_info["ac_id"];
    							$option["value"]=stripslashes($c_info["value"]);
    							$m_items[$m_info["m_id"]][]=$option;
    						}

    					}
    				}
    			}
    			echo "</tr>"; // MENU HEADING
    			$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$q_id $order");
                if (!$database->query()){
                    die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                }
    			if ($database->getNumRows()>0) {
    				$answers=$database->loadAssocList();
        	    	if ($order !=""){
            		    $load_order=true;
                   	    $_SESSION["order"][$q_id]=array();
            		}
    				$i=0;
   					$count = 0;
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
    					echo "<tr class='$class'><td align='right' style='padding-right:15px'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</td>";
    					$m_width=intval(65/$total_menus);
    					foreach ($m_items as $m_id => $menu) { // MENU PER ANSWER
    						echo "<td>";
    						$count++;
                            	$id = 'q'.$q_id.'a'.$answer_info["a_id"].$count;
    						echo "<select id='$id' name='question[$q_id][menu][$m_id][answer][".$answer_info["a_id"]."]' onchange='setselectedMatrix(form.q$q_id,this)' class='$css_dropdownmenu'>";
    						echo "<option value='-1' selected></option>";
    						foreach ($menu as $key => $option) {
    				      $selected=$data["menu"][$m_id]["answer"][$answer_info["a_id"]]==$option["ac_id"]? " Selected":"";
    							echo '<option '; echo " value='".$option["ac_id"]."' $selected>".text_wrap(stripslashes($option["value"]),30,"<br />")." </option>";
    						}
    						echo "</select>";
    						echo "</td>";
    					}

    					echo "</tr>";
    					$i++;
    				}
    				echo "<tr><td><input type='hidden' name='question[$q_id][type]' value='$type' />
    					<input type='hidden' name='question[$q_id][orientation]' value='matrix' /></td></tr></table>";
    			}
			}else{
    			echo "<table width='100%'>";
    			echo "<tr><td width='10%'></td>";


    			$total_menus=count($_SESSION["order_column"][$q_id]);
    			$percent=intval(65/$total_menus);

    				foreach ($_SESSION["order_column"][$q_id] as $m_id_sel){
                        $database->setQuery("SELECT * FROM #__ijoomla_surveys_menu_heading WHERE m_id=$m_id_sel");
                        if (!$database->query()){
                            die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                        }
    				    $menus=$database->loadAssocList();
    				    $m_info=$menus[0];
    					echo "<td width='90%'>".$m_info["value"]."</td>";
    					//echo "<td width='$percent%'>".$m_info["value"]."</td>";
    					$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE m_id=".$m_info["m_id"]." $order1");
                        if (!$database->query()){
                            die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
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
                        if (!$database->query()){
                            die("Error !Code 36: The process could not be finished due to internal error. Please contact the administrators");
                        }
            			$answers=$database->loadAssocList();
            			$answer_info=$answers[0];
    					if ($i%2!=0) {
    					    $class=$css_table_row1;
    					}
    					else {
    					    $class=$css_table_row2;
    					}
    					echo "<tr class='$class'><td align='right' style='padding-right:15px'>".text_wrap(stripslashes($answer_info["value"]),30,"<br />")."</td>";
    					$m_width=intval(65/$total_menus);
    					foreach ($m_items as $m_id => $menu) { // MENU PER ANSWER
    						echo "<td>";
    						echo "<select name='question[$q_id][menu][$m_id][answer][".$answer_info["a_id"]."]' onchange='setselectedMatrix(form.q$q_id,this)' class='$css_dropdownmenu'>";
    						echo "<option value='-1' selected></option>";
    						foreach ($menu as $key => $option) {
    				            $selected=$data["menu"][$m_id]["answer"][$answer_info["a_id"]]==$option["ac_id"]? " Selected":"";
    							echo "<option value='".$option["ac_id"]."' $selected>".text_wrap($option["value"],30,"<br />")."</option>";
    						}
    						echo "</select>";
    						echo "</td>";
    					}

    					echo "</tr>";
    					$i++;
    				}
    				echo "<tr><td><input type='hidden' name='question[$q_id][type]' value='$type' />
    					<input type='hidden' name='question[$q_id][orientation]' value='matrix' /></td></tr></table>";
			}
		}
}

function ij_starttable($width = '-1', $title='', $title_colspan='1', $class = '', $date = '')
{

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

function view_result($s_id=0,$survey_title) {
	global $homelink;

	$css_survey_name 		= JRequest::getVar('css_survey_name');
	$css_result_heading 	= JRequest::getVar('css_result_heading');
	$css_totalbackground 	= JRequest::getVar('css_totalbackground');
	$css_tablerow1 			= JRequest::getVar('css_tablerow1');
	$css_tablerow2 			= JRequest::getVar('css_tablerow2');
	$css_table_row1			= JRequest::getVar('css_table_row1');
	$css_table_row2 		= JRequest::getVar('css_table_row2');
	$css_question 			= JRequest::getVar('css_question');
	$css_answer 			= JRequest::getVar('css_answer');
	$css_total_background 	= JRequest::getVar('css_total_background');
	$css_column_heading 	= JRequest::getVar('css_column_heading');


	$status_bar_img_path=JURI::base()."components/com_surveys/images/Blue_dot.png";
	$database = &JFactory::getDBO();
	$database->setQuery("SELECT * FROM #__ijoomla_surveys_surveys WHERE s_id=$s_id LIMIT 1");
    if (!$database->query()){
        die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
    }
	if ($database->getNumRows()>0) {
		$survey=$database->loadAssocList();
		$survey_info=$survey[0];
		echo "<div align='left'>";
		ij_starttable('100%',stripslashes($survey_info["title"]),1,$css_survey_name);
		ij_endtable();
		echo "<br /></div><div align='left'><br />";

	   if ($survey_info["show_result"]==1 || $survey_info["show_on_results"]==1) {
		echo "
		<table width='100%' align='left' cellpadding='5'>
		<tr><td width='100%' style='text-align:left;vertical-align:top;'><span class='$css_result_heading'> "._RESULTS.' '._SUMMARY."</span> <br />\n";

					// QUESTION
					$database->setQuery("SELECT q.*,p.ordering FROM #__ijoomla_surveys_questions as q,
												#__ijoomla_surveys_pages as p WHERE
												q.s_id=$s_id AND
												p.s_id=$s_id AND
												q.page_id=p.page_id AND
												q.published=1 AND
												p.published=1 AND
												q.show_results=1 ORDER BY
												p.ordering ASC,
												q.ordering ASC");
                    if (!$database->query()){
                        die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                    }
					if ($database->getNumRows()>0) {
						$questions=$database->loadAssocList();
						$i=1;
						foreach ($questions as $q_info)
						{
						    // iJoomla Al : 03/11/2006 : SURVEYS-62
						    $database->setQuery("SELECT DISTINCT s.session_id FROM #__ijoomla_surveys_session as s,#__ijoomla_surveys_result as r WHERE r.q_id='".$q_info["q_id"]."' AND r.session_id=s.session_id AND s.published=1");
                            if (!$database->query()){
                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                            }
						    $total_respondents=$database->getNumRows();
						    $database->setQuery("SELECT DISTINCT s.session_id FROM #__ijoomla_surveys_session as s,#__ijoomla_surveys_result_text as rt WHERE rt.q_id='".$q_info["q_id"]."' AND rt.session_id=s.session_id AND s.published=1");
                            if (!$database->query()){
                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                            }
						    $total_respondents+=$database->getNumRows();

								echo "\n<table width='100%' >\n";
								echo "<tr><td align='left' style='border:1px solid #CCCCCC' class='$css_question'>\n<b>$i. ".$q_info["title"]."</b>\n</td></tr>";
								echo "\n<tr><td valign='top'>";
								if ($q_info["orientation"]!='matrix' && $q_info["orientation"]!='open')
								{
									echo "\n<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >";
									echo "\n<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center' style='padding-left:4px'><b>"._RESPONSE."<br />"._PERCENT."</b></td><td width='13%' align='center' style='padding-left:4px'><b>"._RESPONSE."<br />"._TOTAL."</b></td></tr>";
									$database->setQuery("SELECT r.* FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE q_id=".$q_info["q_id"]." AND r.session_id=s.session_id and s.published=1");
                                    if (!$database->query()){
                                        die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                    }
									$total_answers=$database->getNumRows();
									if ($q_info["other_field"]!=0) {
										$database->setQuery("SELECT r.* FROM #__ijoomla_surveys_result_text as r,#__ijoomla_surveys_session as s WHERE q_id=".$q_info["q_id"]." AND r.session_id=s.session_id and s.published=1");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										$other=$database->getNumRows();
										$total_answers+=$other;
									}
									$database->setQuery("SELECT count( r_id ) , a_id FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s
										WHERE q_id =".$q_info["q_id"]." AND a_id<>0   AND r.session_id=s.session_id and s.published=1
										GROUP BY a_id ORDER BY `count( r_id )` DESC	LIMIT 1");
									list($most,$most_id)=$database->loadRow();
									$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
                                    if (!$database->query()){
                                        die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                    }
									if ($database->getNumRows()>0)
									{
										$answers=$database->loadAssocList();
										$j=0;
										foreach ($answers as $a_info)
										{
											$database->setQuery("SELECT count(r_id) FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s  WHERE q_id=".$q_info["q_id"]." AND a_id=".$a_info["a_id"]." AND r.session_id=s.session_id and s.published=1 LIMIT 1");
                                            if (!$database->query()){
                                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                            }
											list($nums_chooser)=$database->loadRow();
											if ($nums_chooser==$most) {
											    $bold="style='font-weight:bold' ";
                                            }
											else {
											    $bold='';
                                            }
											$row_css=$j%2==0?$css_table_row1:$css_table_row2;
											echo "\n<tr $bold  class='$row_css'>";
											echo "\n<td align='right' >".stripslashes($a_info["value"])."</td>";


											if ($total_answers!=0) {
											    $percent=100*floatval($nums_chooser/$total_answers);
                                            }
											else {
											    $percent=0;
                                            }
											echo "\n<td align='left' ><img src='$status_bar_img_path' height='13' width='".intval($percent)."%' alt='x' /></td>";
											echo "\n<td align='center' >";printf("%2.2f",$percent);echo "%</td>";
											$ft=$nums_chooser;
											echo "\n<td align='center' >$ft</td>";
											echo "\n</tr>";
											$j++;
										}
									}
									if ($q_info["other_field"]!=0) {

											echo "\n<tr class='$row_css'>";
											echo "\n<td align='right' class='$css_answer' >".stripslashes($q_info["other_field_title"])."</td>";
											if ($total_answers!=0) $percent=100*floatval($other/$total_answers);
											else $percent=0;
											echo "\n<td align='left'><img src='$status_bar_img_path' height='13' width='".intval($percent)."%' alt='x' /></td>";
											echo "\n<td align='center' >";printf("%2.2f",$percent);echo "%</td>";
											/*
											if ($other>0){
											    echo "<td align='center' ><a href='".JRoute::_('index.php?option=com_surveys&act=details&survey='.$survey_title.'&q='.$q_info["q_id"])."'> $other "._VIEW_TEXT."</a></td>";
											}else{*/
											    echo "\n<td align='center' >$other</td>";
											//}

											echo "\n</tr>";

									}
									// iJoomla Al : 03/11/2006 : SURVEYS-62
									echo "\n<tr><td colspan='3' align='right' style='padding-left:4px'><b>"._TOTAL." "._RESPONDENTS." : </b></td><td align='center' class='$css_total_background' style='padding-left:4px'><b>$total_respondents</b></td></tr>";
									echo "\n</table>";
								}
								elseif ($q_info["orientation"]=='open')
								{
									if ($q_info["type"]=='constant')
									{
										$database->setQuery("SELECT sum( value ) FROM `#__ijoomla_surveys_result` as r,#__ijoomla_surveys_session as s  WHERE q_id =".$q_info["q_id"]." AND r.session_id=s.session_id and s.published=1");
										list($total_answers)=$database->loadRow();
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										echo "\n<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >";
										echo "\n<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center' style='padding-left:4px'><b>"._RESPONSE." <br />"._PERCENT."</b></td><td width='13%' align='center' style='padding-left:4px'><b>"._RESPONSE."<br />"._TOTAL."</b></td></tr>";
										if ($database->getNumRows()>0)
										{
											$answers=$database->loadAssocList();
											$database->setQuery("SELECT sum( value ) , a_id	FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s
											WHERE q_id =".$q_info["q_id"]." AND a_id<>0  AND r.session_id=s.session_id and s.published=1
											GROUP BY a_id	ORDER BY `sum( value )` DESC LIMIT 1");
                                            if (!$database->query()){
                                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                            }
											list($most,$most_id)=$database->loadRow();
											$j=0;
										    foreach ($answers as $a_info)
										    {
												$row_css=$j%2==0?$css_table_row1:$css_table_row2;
												$database->setQuery("SELECT sum(r.value) FROM #__ijoomla_surveys_result as r, #__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.a_id=".$a_info["a_id"]." AND r.session_id=s.session_id AND s.published=1");
                                                if (!$database->query()){
                                                    die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                }
												list($nums_chooser)=$database->loadRow();
												if ($nums_chooser==$most) {
												    $bold="style='font-weight:bold' ";
                                                }
												else {
												    $bold='';
												}
												echo "\n<tr $bold  class='$row_css'>";

												echo "\n<td align='right'>";
            									if ( $nums_chooser != 0 ) {
													$homelink="index.php?option=com_surveys&Itemid=".$_REQUEST['Itemid'];
            									    echo "<a href='".JRoute::_($homelink.'&amp;act=values&amp;survey='.$survey_info['s_id'].":".$survey_info['alias'].'&amp;a='.$a_info["a_id"])."'> <b>"._VIEW." "._DETAIL."</b> </a> &nbsp;&nbsp;&nbsp;" ;
            									}
            									echo stripslashes($a_info["value"]) . "</td>" ;

												if ($total_answers!=0) {
												    $percent=100*floatval($nums_chooser/$total_answers);
                                                }
												else {
												    $percent=0;
                                                }
												echo "\n<td align='left'><img src='$status_bar_img_path' height='13' width='".intval($percent)."%' alt='x' /></td>";
												echo "\n<td align='center' >";printf("%2.2f",$percent);echo "%</td>";
												echo "\n<td align='center' >$nums_chooser</td>";
												echo "\n</tr>";
												$j++;
											}
										}
										echo "\n<tr><td colspan='3' align='right' style='padding-left:4px'><b>"._TOTAL." "._RESPONDENTS." : </b></td><td align='center' class='$css_total_background' style='padding-left:4px'><b>$total_respondents</b></td></tr>";
										echo "\n</table>";
									}
									elseif ($q_info["type"]=='moreline')
									{
										$sql="SELECT count(r.r_id) FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.session_id=s.session_id AND s.published=1 LIMIT 1";
										$database->setQuery($sql);
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										list($total_answers)=$database->loadRow();
										echo "\n<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >";
										echo "\n<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center' style='padding-left:4px'><b>"._RESPONSE." <br />". _PERCENT."</b></td><td width='13%' align='center' style='padding-left:4px'><b>"._RESPONSE." <br /> "._TOTAL."</b></td></tr>";
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										if ($database->getNumRows()>0) {
											$sql="SELECT count( r.r_id ) , r.a_id
													FROM #__ijoomla_surveys_result as r, #__ijoomla_surveys_session as s
													WHERE r.q_id =".$q_info["q_id"]." AND r.a_id<>0 AND r.value<>''
													AND r.session_id=s.session_id AND s.published=1
													GROUP BY r.a_id
													ORDER BY `count( r.r_id )` DESC
													LIMIT 1";
											$database->setQuery($sql);
                                            if (!$database->query()){
                                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                            }
											list($most,$most_id)=$database->loadRow();
											$i=0;
											$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
											$answers=$database->loadAssocList();
											foreach ($answers as $a_info) {
												$database->setQuery("SELECT count(r.r_id) FROM #__ijoomla_surveys_result as r, #__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.a_id=".$a_info["a_id"]."  AND r.session_id=s.session_id AND s.published=1 LIMIT 1");
                                                if (!$database->query()){
                                                    die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                }
												list($nums_chooser)=$database->loadRow();
												if ($nums_chooser==$most) {
												    $bold="style='font-weight:bold' ";
                                                }
												else {
												    $bold='';
                                                }
                                                $row_css=$j%2==0?$css_table_row1:$css_table_row2;
												echo "\n<tr $bold class='$row_css'>";
												echo "\n<td align='right' >";
												if ( $nums_chooser > 0 ) {
													$homelink="index.php?option=com_surveys&Itemid=".$_REQUEST['Itemid'];
												    echo "<a href='".JRoute::_($homelink.'&amp;act=values&amp;survey='.$survey_info['s_id'].":".$survey_info['alias'].'&amp;a='.$a_info["a_id"])."' > <b>"._VIEW." "._DETAIL."</b> </a> &nbsp;&nbsp;&nbsp;" ;
												}
												echo stripslashes($a_info["value"])."</td>";

												if ($total_answers!=0) {
												    $percent=100*floatval($nums_chooser/$total_answers);
                                                }
												else {
												    $percent=0;
                                                }
												echo "\n<td align='left'><img src='$status_bar_img_path' height='13' width='".intval($percent)."%' alt='x' /></td>";
												echo "\n<td align='center' >";printf("%2.2f",$percent);echo "%</td>";
												echo "\n<td align='center' >$nums_chooser</td>";
												echo "\n</tr>";
											}
										}
										echo "\n<tr><td colspan='3' align='right' style='padding-left:4px'><b>"._TOTAL.' '._RESPONDENTS.": </b></td><td align='center' bgcolor='".$css_totalbackground."' style='padding-left:4px'><b>$total_respondents</b></td></tr>";
										echo "\n</table>";

									}
									elseif($q_info["type"]=='datetime')
									{
										echo "\n<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >";
										echo "\n<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center' style='padding-left:4px'><b>"._RESPONSE."<br />"._PERCENT."</b></td><td width='13%' align='center' style='padding-left:4px'><b>"._RESPONSE."<br />"._TOTAL."</b></td></tr>";
										$database->setQuery("SELECT r.* FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE q_id=".$q_info["q_id"]." AND value>0 AND r.session_id=s.session_id and s.published=1");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										$total_answers=$database->getNumRows();
										if ($q_info["other_field"]!=0)
										{
											$database->setQuery("SELECT r.* FROM #__ijoomla_surveys_result_text r,#__ijoomla_surveys_session as s WHERE q_id=".$q_info["q_id"]>" AND r.session_id=s.session_id and s.published=1");
                                            if (!$database->query()){
                                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                            }
											$other=$database->getNumRows();
											$total_answers+=$other;
										}
										$database->setQuery("SELECT count( r.r_id ) , r.a_id
											FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE r.q_id =".$q_info["q_id"]." AND r.value>0
											AND r.session_id=s.session_id AND s.published=1
											GROUP BY r.a_id ORDER BY `count( r.r_id )` DESC		LIMIT 1");
										list($most,$most_id)=$database->loadRow();
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										if ($database->getNumRows()>0) {
											$answers=$database->loadAssocList();
											$j=0;
											foreach ($answers as $a_info) {
												$row_css=$j%2==0?$css_table_row1:$css_table_row2;
												$database->setQuery("SELECT count(r.r_id) FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.a_id=".$a_info["a_id"]." AND r.value>0 AND r.session_id=s.session_id and s.published=1 LIMIT 1");
                                                if (!$database->query()){
                                                    die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                }
												list($nums_chooser)=$database->loadRow();
												if ($nums_chooser==$most) {
												    $bold="style='font-weight:bold' ";
                                                }
												else {
												    $bold='';
                                                }
												echo "\n<tr $bold class='$row_css'>";
												echo "\n<td align='right'>";
												if ( $nums_chooser > 0 ) {
													$homelink="index.php?option=com_surveys&Itemid=".$_REQUEST['Itemid'];
												    echo "<a href='".JRoute::_($homelink.'&amp;act=values&amp;survey='.$survey_info['s_id'].":".$survey_info['alias'].'&amp;a='.$a_info["a_id"])."' > <b>"._VIEW." "._DETAIL."</b> </a> &nbsp;&nbsp;&nbsp;" ;
												}
												echo stripslashes($a_info["value"])."</td>";

												if ($total_answers!=0) {
												    $percent=100*floatval($nums_chooser/$total_answers);
                                                }
												else {
												    $percent=0;
                                                }
												echo "\n<td align='left'><img src='$status_bar_img_path' height='13' width='".intval($percent)."%' alt='x' /></td>";
												echo "\n<td align='center' >";printf("%2.2f",$percent);echo "%</td>";
												echo "\n<td align='center' >$nums_chooser</td>";
												echo "\n</tr>";
												$j++;
											}

										}
										echo "\n<tr><td colspan='3' align='right' style='padding-left:4px'><b>"._TOTAL." "._RESPONDENTS." : </b></td><td align='center' class='$css_total_background' style='padding-left:4px'><b>$total_respondents</b></td></tr>";
										echo "\n</table>";
									}
									else
									{ // OPEN TEXT
										$database->setQuery("SELECT count(rt.q_id) FROM #__ijoomla_surveys_result_text as rt, #__ijoomla_surveys_session as s WHERE rt.q_id=".$q_info["q_id"]."  AND rt.session_id=s.session_id AND s.published=1");
										list($totalanswers)=$database->loadRow();
										echo "\n<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'>";
										echo "\n<tr>";
										echo "\n<td align='left' width='50%' style='padding-left:4px'><b>"._TOTAL." "._RESPONDENTS.":</b> </td>";
										if ($total_respondents>0){
											$homelink="index.php?option=com_surveys&Itemid=".$_REQUEST['Itemid'];
										    echo "\n<td align='left' width='50%'  class='$css_total_background' style='padding-left:20px'><a href='".JRoute::_($homelink.'&amp;act=details&amp;survey='.$survey_info["s_id"].":".stripslashes($survey_info["alias"]).'&amp;q='.$q_info["q_id"])."'><b>" . $total_respondents . " &nbsp;&nbsp; " . _VIEW . ' ' . _DETAIL . "</b></a></td>";
										}else{
										    echo "\n<td align='left' width='50%'  class='$css_total_background' style='padding-left:20px'><b>".$total_respondents." </b></td>";
										}
										echo "\n</tr>\n</table>	";
									}
								}
								else { // MATRIX
									if ($q_info["type"]!='menu') {
										echo "\n<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'><tr>";
										echo "\n<td width='25%'></td>";
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=".$q_info["q_id"]." ORDER BY ac_id ASC");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										$total_c=$database->getNumRows();
										if ($total_c>0) {
											$columns=$database->loadAssocList();
											$c_width=intval(60/$total_c);
											foreach ($columns as $c_info) {
												echo "\n<td width='$c_width%' align='center' style='padding-left:4px; vertical-align:middle;'><span class='$css_column_heading'>".stripslashes($c_info["value"])."</span></td>";
												$column_info[]=$c_info["ac_id"];
											}
										}
										echo "\n<td width='15%' align='center' style='padding-left:4px;vertical-align:middle;'><b>"._RESPONSE."<br />"._TOTAL."</b></td> </tr>";
										$total_answers=0;
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										if ($database->getNumRows()>0) {
											$rows=$database->loadAssocList();
											$j=0;
											foreach ($rows as $row_info) {
												$database->setQuery("SELECT * FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE q_id=".$q_info["q_id"]." AND a_id=".$row_info["a_id"]." AND r.session_id=s.session_id and s.published=1");
                                                if (!$database->query()){
                                                    die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                }
												$total_answers_per_row=$database->getNumRows();
												$database->setQuery("SELECT count( r_id ) , ac_id
													FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s
													WHERE q_id =".$q_info["q_id"]." AND ac_id<>0 AND a_id=".$row_info["a_id"]."  AND r.session_id=s.session_id and s.published=1
													GROUP BY ac_id	ORDER BY `count( r_id )` DESC	LIMIT 1");
                                                if (!$database->query()){
                                                    die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                }
												list($most,$most_id)=$database->loadRow();
												$total_answers+=$total_answers_per_row;
												$row_css=$j%2==0?$css_table_row1:$css_table_row2;
												echo "\n<tr class='$row_css'>";
												echo "\n<td align='right' style='padding-right:5px; vertical-align:middle;' >".stripslashes($row_info["value"])."</td>";
												foreach ($column_info as $ac_id) {
													$database->setQuery("SELECT * FROM #__ijoomla_surveys_result as r, #__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.a_id=".$row_info["a_id"]." AND r.ac_id=".$ac_id."  AND r.session_id=s.session_id AND s.published=1");
                                                    if (!$database->query()){
                                                        die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                    }
													$nums_chooser=$database->getNumRows();
													if ($nums_chooser==$most) {
													    $bold="font-weight:bold; ";
                                                    }
													else {
													    $bold='';
                                                    }
													if ($total_answers_per_row!=0) {
													    $percent=floatval($nums_chooser/$total_answers_per_row)*100;
                                                    }
													else {
													    $percent=0;
                                                    }
													$ft=$nums_chooser;
													echo "\n<td align='center'  style='vertical-align:middle;$bold'  >";printf("%4.2f",$percent);echo "% ($ft) </td>";
												}
												echo "\n<td align='center' style='vertical-align:middle'>$total_answers_per_row</td>";
												echo "\n</tr>";
												$j++;
											}
										}

										echo "\n<tr><td colspan='".($total_c+1)."' style='padding-left:4px;vertical-align:middle;'><b>"._TOTAL." "._RESPONDENTS.":</b></td><td align='center' class='$css_total_background' style='padding-left:4px'><b>$total_respondents</b></td></tr>";
										echo "\n</table>";
									}
									else { // MATRIX MENU
										$database->setQuery("SELECT * FROM #__ijoomla_surveys_menu_heading WHERE q_id=".$q_info["q_id"]." ORDER BY m_id ASC");
                                        if (!$database->query()){
                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                        }
										$menus=$database->loadAssocList();
										foreach ($menus as $m_info) {
											echo "\n<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'>";
											echo "\n<tr><td align='center' bgcolor='#D1E9E9' style='padding-left:4px;vertical-align:middle;'>".$m_info["value"]."</td></tr>";
											echo "\n<tr><td>";
											echo "\n<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC;vertical-align:middle;' border='1'>";
												echo "\n<tr><td width='25%' ></td>";
													$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=".$q_info["q_id"]." AND m_id=".$m_info["m_id"]);
                                                    if (!$database->query()){
                                                        die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                    }
													$total_c=$database->getNumRows();

													if ($total_c>0) {
														$columns=$database->loadAssocList();
														$c_width=intval(60/$total_c);
														foreach ($columns as $c_info) {
															echo "<td width='$c_width%' align='center' style='padding-left:4px;vertical-align:middle;'><b>".stripslashes($c_info["value"])."</b></td>";
															$column_info[]=$c_info["ac_id"];
														}
													}
												echo "\n<td width='15%' align='center' style='padding-left:4px;vertical-align:middle;'><b>"._RESPONSE."<br />"._TOTAL."</b></td> </tr>";
												$total_answers=0;
												$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=".$q_info["q_id"]." ORDER BY a_id ASC");
                                                if (!$database->query()){
                                                    die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                }
												if ($database->getNumRows()>0)	 {
    												$rows=$database->loadAssocList();
													$j=0;

													foreach ($rows as $row_info) {
														$database->setQuery("SELECT * FROM #__ijoomla_surveys_result as r, #__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.a_id=".$row_info["a_id"]." AND r.ac_id>0 AND r.m_id=".$m_info["m_id"]."  AND r.session_id=s.session_id AND s.published=1");
                                                        if (!$database->query()){
                                                            die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                        }
														$total_answers_per_row=$database->getNumRows();

														$total_answers+=$total_answers_per_row;
														$row_css=$j%2==0?$css_table_row1:$css_table_row2;
														$database->setQuery("SELECT count( r_id ) , ac_id
														FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s
														WHERE q_id =".$q_info["q_id"]." AND ac_id>0 AND a_id=".$row_info["a_id"]." AND m_id=".$m_info["m_id"]." AND r.session_id=s.session_id and s.published=1
														GROUP BY ac_id	ORDER BY `count( r_id )` DESC	LIMIT 1");
														list($most,$most_id)=$database->loadRow();
														echo "\n<tr  class='$row_css'>";
														echo "\n<td align='right' style='padding-right:5px;vertical-align:middle;'>".stripslashes($row_info["value"])."</td>";
														foreach ($column_info as $ac_id) {
															$database->setQuery("SELECT * FROM #__ijoomla_surveys_result as r, #__ijoomla_surveys_session as s WHERE r.q_id=".$q_info["q_id"]." AND r.a_id=".$row_info["a_id"]." AND r.ac_id=".$ac_id." AND r.m_id=".$m_info["m_id"]."  AND r.session_id=s.session_id AND s.published=1");
                                                            if (!$database->query()){
                                                                die("Error !Code 37: The process could not be finished due to internal error. Please contact the administrators");
                                                            }
															$nums_chooser=$database->getNumRows();

															if ($nums_chooser==$most) {
															    $bold="font-weight:bold; ";
                                                            }
															else {
															    $bold='';
                                                            }
															if ($total_answers_per_row!=0) {
															    $percent=100*floatval($nums_chooser/$total_answers_per_row);
                                                            }
															else {
															    $percent=0;
                                                            }
															$ft=$nums_chooser;
															echo "\n<td align='center' style='vertical-align:middle;$bold' >";printf("%4.2f",$percent);echo "% ($ft) </td>";
														}
														echo "\n<td align='center'  style='vertical-align:middle'>$total_answers_per_row</td>";
														echo "\n</tr>";
														$j++;
													}

												}
												echo "\n<tr><td colspan='".($total_c+1)."' style='padding-left:4px;vertical-align:middle;'><b>"._TOTAL." "._RESPONDENTS.":</b></td><td align='center' class='$css_total_background' style='padding-left:4px'><b>$total_respondents</b></td></tr>";

											echo "\n</table>";
											echo "\n</td></tr>";
											echo "\n</table>";
											$column_info=null;
											echo "<br />";
										}


									}
									$column_info=null;
								}

								$i++;
								echo "\n</td></tr>";
								echo "\n</table>\n <br />";
							}

						}
					echo "\n</td></tr>\n</table>";
					?>

<?php
		}
		else {
			msg("The survey does not allow to view result",$homelink);
		}
		echo "</div>";
	}
	else {
		msg("The survey not existant",$homelink);
	}
}

function view_result_text ( &$rows, $q_id, $lasts_id) {
	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<td width="100%" ><span><?php echo _RESULT_TEXT;?></span></td>
		</tr>
	</table>
	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th style="text-align:center" width="5%">#</th>
			<th ><?php echo _VALUE ; ?></th>
		</tr>
	<?php
		$k = 0 ;
		for( $i = 0; $i < count( $rows ); $i++ ) {
			$row = $rows[$i] ;
	?>
		<tr class="<?php echo "row$k" ; ?>">
			<td style="text-align:center"><?php echo $i + $pageNav->limitstart + 1 ; ?></td>
			<td ><?php echo $row->value ; ?></a></td>
		</tr>
	<?php
		$k = 1 - $k ;
		}
	?>
	   <tr>
	       <td colspan="2" style="text-align:center"><input type="button" value="<?php echo _BACK_BTN;?>" onclick="javascript:history.go(-1);" />
	       </td>
	   </tr>
	</table>
	<?php
}

function view_result_value ( &$rows, $question_info, $answer_info, $lasts_id, $a_id ) {
	?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<td width="100%" ><?php echo _QUESTION." : ".stripslashes($question_info->title) ; ?></td>
		</tr>
		<tr>
			<td colspan="3"><b><?php echo _CHOICE." : ".stripslashes($answer_info->value) ; ?></b></td>
		</tr>
	</table>

	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th style="text-align:center" width="5%">#</th>
			<th ><?php if ( $question_info->type == 'datetime' ) echo "day/month/Year hour:minute"; else echo _VALUE ;?></th>
		</tr>
	<?php
		$k = 0 ;
		for( $i = 0 ; $i < count( $rows ) ; $i++ ) {
			$row = $rows[$i] ;
			if ( !($question_info->type == 'datetime' && $row->value == -1 ) ) {
	?>
		<tr class="<?php echo "row$k" ; ?>">
			<td style="text-align:center"><?php echo $i + $pageNav->limitstart + 1 ;?></td>
			<td ><?php if ( $question_info->type == 'datetime' ) echo date( "d/m/Y h:i", $row->value ) ;
				 else echo $row->value ;
			?></td>
		</tr>
	<?php
			}
		$k = 1 - $k ;
		}
	?>
	   <tr>
	       <td colspan="2" style="text-align:center"><input type="button" value="<?php echo _BACK_BTN;?>" onclick="javascript:history.go(-1);">
	       </td>
	   </tr>
	</table>

	<?php
}
?>
