<?php
/*
 * $Id: <export_data,0.0.12 <version> 2007/02/01 10:44:00 <iJoomla Al> $
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
 * @file <export_data.php>
 * @brief <allows administrator to export statistics of a survey>
 *
 * @functionlist
 * ====================================================================
 * ====================================================================
 * @endfunctionlist
 * 
 * @history
 * ====================================================================
 * File creation date: 01/02/2007 10:30:00
 * Current file version: 0.0.12
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/03/2007
 * Modification: matrix type questions : number of columns expanded to match answer choices number
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

@ini_set('max_execution_time',900);
error_reporting(E_ALL & ~E_NOTICE); 

//include_once( '../../../globals.php' );
//require_once( '../../../configuration.php' );
//require_once( '../../../includes/joomla.php' );

if (!isset($_GET['s_id'])||($_GET['s_id']<1)||!isset($_GET['start'])||$_GET['start']!="yes"){
    die("Error ! Export could not commence");
}else{
    $s_id = $_GET['s_id'];
}

$CSV_limit = 200;

if (isset($_GET['limit_start'])&&$_GET['limit_start']>0){
    $low_limit = $_GET['limit_start'];
}else{
    $low_limit = 0;
}
if (isset($_GET['limit_finish'])&&$_GET['limit_finish']>0){
    $upper_limit = $_GET['limit_finish'];
    if ($upper_limit < $low_limit){
        $upper_limit = $low_limit;
    }
}else{
    $upper_limit = $CSV_limit;
    if ($upper_limit < $low_limit){
        $upper_limit = $low_limit;
    }    
}

$part = ceil($low_limit / $CSV_limit);

$limit_rows   = $upper_limit-$low_limit+1;
$limit_offset = $low_limit-1;

$csv_filename = "survey_{$s_id}_part_{$part}.csv";
$data = "";

$database = &JFactory::getDBO();

///// all questions for survey s_id
$database->setQuery("SELECT q_id,title,type,orientation FROM #__ijoomla_surveys_questions WHERE s_id='".$s_id."' ORDER BY ordering ASC");
$database->query();
if ( $database->getErrorMsg() ){
	die( $database->getErrorMsg() ) ;		
}
$questions_result = $database->loadAssocList();

$csv_file_line[] = 'RESPONSE';
$csv_file_line[] = 'SUBMITTED';
$csv_file_line[] = 'IP';
$csv_file_line[] = 'USERNAME';
$csv_file_line[] = 'NAME';

$matrix_column_answers = array();

foreach ($questions_result as $index => $array){
    if ($array['orientation']=="matrix"){
        $matrix_column_answers[$array['q_id']] = array();
        
      
	    $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id =".$array['q_id']." order by a_id asc");
        if ( !$database->query() ){
        	die( $database->getErrorMsg() ) ;	
        }	       
        $answers = $database->loadAssocList();  
        
        
		
        if (count($answers)>0){
            foreach ($answers as $ans_count => $answer_array){
                $csv_file_line[] = str_replace(',','#####',$array['title'])." : ".str_replace(',','#####',$answer_array['value']);
                $matrix_column_answers[$array['q_id']][$answer_array['a_id']] = "NO ANSWER";
            }
        }        
    	}   else      {
        $csv_file_line[] =str_replace(',','#####',$array['title']);
    }
}


$database->setQuery( "SELECT `general_date` FROM `#__ijoomla_surveys_config`" ) ;
			$database->query() ;			
        	if ($database->getErrorMsg()){										
        	    die($database->getErrorMsg());
        	}			
        	
        	$date	= $database->loadAssocList();
					$date_option = $date[0]["general_date"];
								switch ($date_option)
								{
									case 1:
									   $general_date = 'm/d/Y';
									   $disp		 = 'Month/Day/Year';
									    break;
									case 2:
									    $general_date = 'd/m/Y';
									     $disp		 = 'Day/Month/Year';
									    break;
									case 3:
									   $general_date = 'Y/m/d';
									    $disp		 = 'Year/Month/Day';
									    break;
									 case 4:
									   $general_date = 'Y/d/m';
									    $disp		 = 'Year/Day/Month';
									    break;
								}
				
				

$data .= join(',', $csv_file_line)."\n"; // Join all values without any trailing commas and add a new line

		$database->setQuery("SELECT * FROM #__ijoomla_surveys_session WHERE s_id=$s_id AND (completed = '1' OR last_page_id <> '0') ORDER BY session_id ASC LIMIT $limit_offset,$limit_rows");
		$database->query();
		
		if ( $database->getErrorMsg() ){
			die( $database->getErrorMsg() ) ;		
		}   
  $session_result = $database->loadAssocList();


foreach ($session_result as $sess_number => $session_array){
    $csv_file_line = ''; // We must clear the previous values
    $csv_file_line[] = $sess_number+$low_limit;
    $csv_file_line[] = date( $general_date." H:i",$session_array['played_time']);
    
    $csv_file_line[] = $session_array['ip'];
    if ($session_array['user_id']>0){
        $database->setQuery("SELECT name,username FROM #__users WHERE id=".$session_array['user_id']);
        $database->query();
        if ( $database->getErrorMsg() ){
            die( $database->getErrorMsg() ) ;		
        }        
        if ( $database->getNumRows() > 0 ){
            $user_details = $database->loadAssocList();
            $csv_file_line[] = $user_details[0]['username'];
            $csv_file_line[] = $user_details[0]['name'];
        }else{
            $csv_file_line[] = "Unregistered";
            $csv_file_line[] = "Unregistered";            
        }
    }else{
        $csv_file_line[] = "Unregistered";
        $csv_file_line[] = "Unregistered";
    }

    foreach ($questions_result as $index => $question_array){
        $answer = "NO ANSWER";
        switch ($question_array['type']){
            case "checkbox":
                if ($question_array['orientation']!="matrix"){
                    $database->setQuery("SELECT a_id FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']);
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $checkbox_result = $database->loadAssocList();
                    
                    $checkbox_answer = "";
                    foreach ($checkbox_result as $index_i => $checkbox_array){
                        if ($checkbox_array['a_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$checkbox_array['a_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                    
                            $checkbox_answer .= stripslashes($database->loadResult())." AND "; 
                        }
                    }
                    
                    if ($question_array['orientation']=="vertical"){
                        $database->setQuery("SELECT value FROM #__ijoomla_surveys_result_text WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']);
                        $database->query();
                        if ( $database->getErrorMsg() ){
                        	die( $database->getErrorMsg() ) ;		
                        }              
                        $result_text = stripslashes($database->loadResult());
                        if ($result_text!="") {
                            $checkbox_answer .= $result_text." AND ";    
                        }
                    }
                                        
                    if ($checkbox_answer != ""){
                        $checkbox_answer = substr($checkbox_answer,0,strlen($checkbox_answer)-5);
                        $answer = $checkbox_answer;                         
                    }
                
                }else{
                    // matrix multiple per row
                  $database->setQuery("SELECT a_id,ac_id FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ORDER BY a_id");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $checkbox_result = $database->loadAssocList();
                    
                    $checkbox_answer = "";
                    
                    $matrix_mp_row_cols=array();
                    $matrix_mp_row_cols_selected = array();
                    
                    foreach ($checkbox_result as $index_i => $checkbox_array){
                        if ($checkbox_array['a_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$checkbox_array['a_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                    
                            if (!isset($matrix_mp_row_cols[$checkbox_array['a_id']])){
                                $matrix_mp_row_cols[$checkbox_array['a_id']] = stripslashes($database->loadResult());
                            }                                                       
                        }
                        if ($checkbox_array['ac_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answer_columns WHERE ac_id=".$checkbox_array['ac_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                                                
                            if (!isset($matrix_mp_row_cols_selected[$checkbox_array['a_id']])||!is_array($matrix_mp_row_cols_selected[$checkbox_array['a_id']])){
                                $matrix_mp_row_cols_selected[$checkbox_array['a_id']]=array();
                            }
                            array_push($matrix_mp_row_cols_selected[$checkbox_array['a_id']],stripslashes($database->loadResult()));
                        }
                    }
					
                    $checkbox_answer = array();
                    if (is_array($matrix_column_answers[$question_array['q_id']])){
                        foreach ($matrix_column_answers[$question_array['q_id']] as $a_id_val => $export_ans_val){
                            if (isset($matrix_mp_row_cols_selected[$a_id_val])){                               
                                $new_col = implode(" AND ",$matrix_mp_row_cols_selected[$a_id_val]);                                                            
                                if (@preg_match(',',$new_col)){
                                    $checkbox_answer[] = '"'.str_replace('"',"'",$new_col).'"';
                                }else{
                                    $checkbox_answer[] = $new_col;
                                }
								//unset($matrix_mp_row_cols_selected[$a_id_val]);
                            }else{
                                $checkbox_answer [] = $export_ans_val;
                            }                            
                        }
                        $answer = implode(",",$checkbox_answer);
                    }
                }
                break;
            case "constant":
                    $database->setQuery("SELECT a_id,value FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $constant_sum_result = $database->loadAssocList();
                    
                    $constant_sum_answer = "";
                    foreach ($constant_sum_result as $index_i => $constant_sum_array){
                        if ($constant_sum_array['a_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$constant_sum_array['a_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                    
                            $constant_sum_answer .= stripslashes($database->loadResult()); 
                        }
                        $constant_sum_answer .= " = ".$constant_sum_array['value']." AND ";
                    }                    
                    if ($constant_sum_answer!=""){
                        $constant_sum_answer = substr($constant_sum_answer,0,strlen($constant_sum_answer)-3);
                        $answer = $constant_sum_answer; 
                    }             
                break;                
            case "datetime":
                    $database->setQuery("SELECT a_id,value FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $datetime_result = $database->loadAssocList();
                    
                    $datetime_answer = "";
                    foreach ($datetime_result as $index_i => $datetime_array){
                        if ($datetime_array['a_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$datetime_array['a_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                    
                            $datetime_answer .= stripslashes($database->loadResult()); 
                        }
                        if ($datetime_array['value']!=-1){
                            $datetime_answer .= " - ".date($general_date." H:i",$datetime_array['value'])." AND ";
                        }else{
                            $datetime_answer .= " - INCORRECT DATE AND ";
                        }
                    }                    
                    if ($datetime_answer!=""){
                        $datetime_answer = substr($datetime_answer,0,strlen($datetime_answer)-5);
                        $answer = $datetime_answer; 
                    }                
                break;
            case "menu":
                    // MATRIX multiple per row MENUS
                   
                    $database->setQuery("SELECT a_id, m_id, ac_id FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']);
					$database->query();
					
					
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $matrix_result = $database->loadAssocList();
                   
                    $matrix_answer = "";
                    
                    $matrix_mp_row_cols=array();
                    $matrix_mp_row_cols_selected = array();
                    $line_response = "";
					
					
					foreach ($matrix_result as $index_i => $matrix_array){						   
                        if ($matrix_array['a_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$matrix_array['a_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                    
                            if (!isset($matrix_mp_row_cols[$matrix_array['a_id']])){
                                $matrix_mp_row_cols[$matrix_array['a_id']] = stripslashes($database->loadResult());
                            }                                                       
                        }
                        
                        if ($matrix_array['m_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_menu_heading WHERE m_id=".$matrix_array['m_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                                                
                            $line_response = stripslashes($database->loadResult());   
                                                
                            if ($matrix_array['ac_id']>0){							    								
								
                                //$database->setQuery("SELECT value FROM #__ijoomla_surveys_answer_columns WHERE ac_id=".$matrix_array['ac_id']);
								
								$database->setQuery("SELECT ac.value FROM #__ijoomla_surveys_answer_columns as ac, #__ijoomla_surveys_result as r  WHERE r.session_id=".$session_array['session_id']." and ac.m_id=r.m_id and ac.q_id=r.q_id and ac.ac_id=r.ac_id and ac.ac_id=".$matrix_array['ac_id']);
																
								
                                $database->query();
                                if ( $database->getErrorMsg() ){
                                	die( $database->getErrorMsg() ) ;		
                                } 
								$line_response .= " - ".stripslashes($database->loadResult());
								  
                            }
                             
                            if (!isset($matrix_mp_row_cols_selected[$matrix_array['a_id']])||!is_array($matrix_mp_row_cols_selected[$matrix_array['a_id']])){
                                $matrix_mp_row_cols_selected[$matrix_array['a_id']]=array();
                            }							
                            array_push($matrix_mp_row_cols_selected[$matrix_array['a_id']],$line_response);
                        }
                    }
                    
                    $matrix_answer="";
					$line_response = "";
										
					foreach ($matrix_mp_row_cols as $matrix_a_id => $matrix_a_value){						
						if (isset($matrix_mp_row_cols_selected[$matrix_a_id])){							    
							$new_answer = implode(" AND ",$matrix_mp_row_cols_selected[$matrix_a_id]);	
														
								if (@preg_match(',',$new_answer)){                                
									$matrix_column_answers[$question_array['q_id']][$matrix_a_id]  = '"'.stripslashes(str_replace('"',"'",$new_answer)).'"';
								}else{
									$matrix_column_answers[$question_array['q_id']][$matrix_a_id]  = stripslashes($new_answer);         
								} 
								                           
						}
						
					}
					
///////////////////////////
$database->setQuery("SELECT count(*) total from #__ijoomla_surveys_answers where q_id = " . $question_array['q_id']);
$database->query();
 if ( $database->getErrorMsg() ){
       die( $database->getErrorMsg() ) ;		
 }                    
 $nr_total = $database->loadResult();
 
 
 $database->setQuery("SELECT count(*) total from #__ijoomla_surveys_result where q_id = " . $question_array['q_id'] . " and session_id=" . $session_array['session_id']);
$database->query();
 if ( $database->getErrorMsg() ){
       die( $database->getErrorMsg() ) ;		
 }                    
 $nr_total_setate = $database->loadResult();
////////////////////////////					
					$k=0;
					if(count($matrix_result)>0 && $nr_total == $nr_total_setate){
						if (is_array($matrix_column_answers[$question_array['q_id']])){
							$answer = implode(",",$matrix_column_answers[$question_array['q_id']]);
						}  					
                    }
					else{
					  $vector_gol = array(); 
					  $database->setQuery("SELECT a_id, q_id, value from #__ijoomla_surveys_answers where q_id = " . $question_array['q_id'] . " order by a_id");
			          $database->query();
					  if ( $database->getErrorMsg() ){
						   die( $database->getErrorMsg() ) ;		
					  }                    
					  $raspunsuri = $database->loadObjectList();
					  
					  foreach($raspunsuri as $key => $array_list){// totate raspunsurile
					       $sql = "SELECT  mh.value as menu_heading, x.value as answer_value from #__ijoomla_surveys_answer_columns as x, 
							                                            #__ijoomla_surveys_result as r,
																		#__ijoomla_surveys_answers as a,
																		#__ijoomla_surveys_menu_heading mh
												 where a.a_id = " . $array_list->a_id . " 
												   and a.a_id = r.a_id 
												   and a.q_id = r.q_id
												   and r.q_id = x.q_id
												   and r.ac_id = x.ac_id
												   and mh.q_id = x.q_id
												   and x.m_id = mh.m_id
												   and session_id=" . $session_array['session_id'].
												   " order by a.a_id asc";				   
						   $database->setQuery($sql);
												   
							$database->query();
							if ( $database->getErrorMsg() ){
							   die( $database->getErrorMsg() ) ;		
							}                    
							$my_result = $database->loadAssocList();  
							
							if ($my_result != NULL){
								$temp_value = array();
								foreach($my_result as $key_temp=>$value_temp){
									$temp_value[] = $value_temp["menu_heading"].":".$value_temp["answer_value"];
								}
								$vector_gol[$k] = implode(" | ", $temp_value);
								$k++;
							}
							else{
							    $vector_gol[$k] = "NO ANSWER";
								$k++;
							}
					  }
					  					   
					   				   
					   $answer = implode(",", $vector_gol);					   
					}					          
							      
                break;
		    case "moreline":
                    $database->setQuery("SELECT a_id,value FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $moreline_result = $database->loadAssocList();
                    
                    $moreline_answer = "";
                    foreach ($moreline_result as $index_i => $moreline_array){
                        if ($moreline_array['a_id']>0){
                            $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$moreline_array['a_id']);
                            $database->query();
                            if ( $database->getErrorMsg() ){
                            	die( $database->getErrorMsg() ) ;		
                            }                    
                            $moreline_answer .= stripslashes($database->loadResult()); 
                        }
                        $moreline_answer .= " - ".stripslashes($moreline_array['value'])." AND ";
                    }                    
                    if ($moreline_answer!=""){
                        $moreline_answer = substr($moreline_answer,0,strlen($moreline_answer)-5);
                        $answer = $moreline_answer; 
                    }
                break;
            case "radio":
                if ($question_array['orientation']!="matrix"){
                    $database->setQuery("SELECT a_id FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $a_id = $database->loadResult();
                    
                    if ($a_id>0){
                        $database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=$a_id");
                        $database->query();
                        if ( $database->getErrorMsg() ){
                        	die( $database->getErrorMsg() ) ;		
                        }         
                        if ($database->getnumRows()>0){
                            //$answer = stripslashes($database->loadResult());							
							$actual_result = $database->loadResult();
						    if(strpos($actual_result, ",") != NULL ){
                            	$answer = '"'.stripslashes($actual_result).'"';
							}
							else{
							    $answer = stripslashes($actual_result);
							} 						
                        }
                    }

                    if ($answer == "NO ANSWER"&&($question_array['orientation']=="vertical"||$question_array['orientation']=="dropdown")){
                   		     $database->setQuery("SELECT value FROM #__ijoomla_surveys_result_text WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                        $database->query();
                        if ( $database->getErrorMsg() ){
                        	die( $database->getErrorMsg() ) ;		
                        }            
                        if ($database->getnumRows()>0){        
                            $answer = stripslashes($database->loadResult());  
                        }
                    }
                }else{
					
					########## matrix - one answer per row #########
					
					//// a_id : answer id (option checked), ac_id: answer column, q_id: question id, s_id: survey id
					
					///// Load checked options for question : $question_array['q_id']
					$sql = "SELECT a_id,ac_id FROM #__ijoomla_surveys_result WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ORDER BY a_id ASC";
                    $database->setQuery($sql);
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }
                    /// array of answers objects 
					$a_ids_array = $database->loadAssocList();
                    $export_answer = array();
					
					
					///// First each option of a question is considered with 'no answer'
					$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id =".$question_array['q_id']);
					if ( !$database->query() ){
						die( $database->getErrorMsg() ) ;	
					}	       
					$answers = $database->loadAssocList();  
													
					if (count($answers)>0)
						foreach ($answers as $ans_count => $answer_array)
							$matrix_column_answers[$question_array['q_id']][$answer_array['a_id']] = "NO ANSWER";
										
                    
					
					foreach ($a_ids_array as $local_index => $array_ids){

							//print_r($questions_result);
							
						//Added So start					
						/*foreach ($questions_result as $index => $array){
							if ($array['orientation']=="matrix"){
								$matrix_column_answers[$array['q_id']] = array();
							  
							    $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id =".$array['q_id']);
								if ( !$database->query() ){
									die( $database->getErrorMsg() ) ;	
								}	       
								$answers = $database->loadAssocList();  
																
								if (count($answers)>0){
									foreach ($answers as $ans_count => $answer_array){
										$matrix_column_answers[$array['q_id']][$answer_array['a_id']] = "NO ANSWER";
									}
								}        
							}
						}*/
						//Added So end
						
						/*
						$matrix_column_answers[$array['q_id']] = array();
						$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id =".$question_array['q_id']);
						if ( !$database->query() ){
							die( $database->getErrorMsg() ) ;	
						}	       
						$answers = $database->loadAssocList();  
						if (count($answers)>0){
							foreach ($answers as $ans_count => $answer_array){
								//if($array_ids['a_id'] != $answer_array['a_id'])
									$matrix_column_answers[$question_array['q_id']][$array_ids['a_id']] = "NO ANSWER";
								}
						}        */
						

							if(!empty($array_ids)){
							if ($array_ids['a_id']>0){
								$database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=".$array_ids['a_id']);
								$database->query();
								if ( $database->getErrorMsg() ){
									die( $database->getErrorMsg() ) ;		
								}                    
							}
							if ($array_ids['ac_id']>0){
								$sql = "SELECT value FROM #__ijoomla_surveys_answer_columns WHERE ac_id=".$array_ids['ac_id'];
								$database->setQuery($sql);
								$database->query();
								if ( $database->getErrorMsg() ){
									die( $database->getErrorMsg() ) ;		
								}                    
								$column_name = $database->loadResult();
								if ($column_name==""){
									$column_name = "DELETED OPTION";
								}
								
								if (@preg_match(',',$column_name)){
									$matrix_column_answers[$question_array['q_id']][$array_ids['a_id']] = '"'.stripslashes(str_replace('"',"'",$column_name)).'"';
								}else{
								  
									$matrix_column_answers[$question_array['q_id']][$array_ids['a_id']] = stripslashes($column_name);         
								}                                       
							
							}
																											
							
						}
                    }////for
					
						
								
					//print_r($matrix_column_answers[$question_array['q_id']]);
					//echo '<br/>';
					
					
					
					if ($matrix_column_answers[$question_array['q_id']]){
                        $answer = implode(",",$matrix_column_answers[$question_array['q_id']]);  
						unset($matrix_column_answers[$question_array['q_id']]);
                    }else{
					  $database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id =".$question_array['q_id']);
					  $answers2 = $database->loadAssocList();
						for($i=1;$i<=count($answers2);$i++){
							$no_answer .= $answer.",";
						}
						$answer = substr($no_answer,0, -1);
					}
                }
                break;
            case "text":
                    $database->setQuery("SELECT value FROM #__ijoomla_surveys_result_text WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $text_value = $database->loadResult();
                   
                    if ($text_value!=""){
                        $answer = stripslashes($text_value); 
                    }            
                break;
            case "textarea":
                    $database->setQuery("SELECT value FROM #__ijoomla_surveys_result_text WHERE session_id=".$session_array['session_id']." AND q_id=".$question_array['q_id']." ");
                    $database->query();
                    if ( $database->getErrorMsg() ){
                    	die( $database->getErrorMsg() ) ;		
                    }                    
                    $textarea_value = $database->loadResult();

                    if ($textarea_value!=""){
					    $answer_rezult = "";					    
						$answer = str_replace(',', ' ', $textarea_value);
                        $answer = stripslashes(str_replace("[\r\t]",' ', $answer));						
						$array = explode("\n", $answer);
						foreach($array as $key=>$value){
						   $answer_rezult .= trim($value) . " ";
						}
						$answer_rezult = substr($answer_rezult, 0, strlen($answer_rezult)-1);						
                    }
                break;
        }
		if($answer_rezult == ""){
           $answer = stripslashes(str_replace("[\r\t\n]",' ',$answer)); 
		}
		else{
		   $answer = stripslashes(str_replace("[\r\t\n]",' ',$answer_rezult)); 
		   $answer_rezult = "";
		}	
		
        if (@preg_match(',',$answer)&& $question_array['orientation']!="matrix"){
            $csv_file_line[] = '"'.str_replace('"',"'",$answer).'"';
        }else{
            $csv_file_line[] = $answer;
        }
    }
    $data .= join(",", $csv_file_line)."\n";
}

// Output the headers to download the file
//ereg_replace('#####','+',$data);
$size_in_bytes=strlen($data);


header("Content-Type: application/x-msdownload");
header("Content-Length: $size_in_bytes");
header("Content-Disposition: attachment; filename=\"$csv_filename\"");
header("Pragma: no-cache");
header("Expires: 0");

echo str_replace('#####',  "" , $data);
       
exit();

?>
