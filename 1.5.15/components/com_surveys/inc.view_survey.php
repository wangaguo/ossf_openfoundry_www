<?php
/*
 * $Id: <inc.view_survey.php,0.0.28 <version> 2007/02/19 15:40:12 <iJoomla Al> $
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
 * @file <inc.view_survey.php>
 * @brief <starts view_survey process>
 *
 * @history
 * ====================================================================
 * File creation date: 17/10/2006
 * Current file version: 0.0.28
 *
 * Modified By: iJoomla Al
 * Modified Date: 18/10/2006
 * Modification: SURVEYS-35
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/10/2006
 * Modification: browser "back" button not allowed when ORPRFO
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/11/2006
 * Modification: SURVEYS-74 code cleaned 
 *
 * Modified By: iJoomla Al
 * Modified Date: 08/12/2006
 * Modification: survey last page id changed in URLs from -1 to "last", for SEF compliance
 *
 * Modified By: iJoomla Al
 * Modified Date: 19/02/2007
 * Modification: other option for vertical questions included in skip action
 *
 * Modified By: iJoomla Al
 * Modified Date: 12/03/2007
 * Modification: JArrayHelper::getValue source changed from $_GET and $_POST to $_REQUEST 
 *
 * Modified By: iJoomla Al
 * Modified Date: 12/03/2007
 * Modification: XHTML1.0 valid
 *
 * Modified By: 
 * Modified Date: 
 * Modification:  
 *
 * ====================================================================
 * @endhistory
 */
// ensure this file is being included by a parent file

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
if ($survey_id_exist<1){
    echo "Survey not existant";
}else{
    
    $post_question=JArrayHelper::getValue($_REQUEST,"question");
    $post_cpage   =JArrayHelper::getValue($_REQUEST,"cpage"   );
    $post_ordering=JArrayHelper::getValue($_REQUEST,"ordering");
    
    if ($post_cpage=="last"){
        $post_cpage = -1;
    }
    $database->setQuery("SELECT published FROM #__ijoomla_surveys_surveys WHERE s_id='$survey_id'");
    if (!$database->query()){
        die("Error !Code 14: The process could not be finished due to internal error. Please contact the administrators");
    }    
    $survey_is_published=$database->loadResult();
    if ($survey_is_published!=1){
        echo _SURVEY_UNAVAILABLE;
    }else

    if (JArrayHelper::getValue($_REQUEST,'Submit')) {
        // SKIP LOGIC
        $database->setQuery("SELECT * FROM #__ijoomla_surveys_skip_logics WHERE s_id=".$survey_id." AND page_id=".intval($post_cpage)." AND published=1 ORDER BY ordering ASC");
        $database->query();
        if (!$database->query()){
            die("Error !Code 14: The process could not be finished due to internal error. Please contact the administrators");
        }
        if ($database->getNumRows()>0) {
            $skiplogic=$database->loadAssocList();
            foreach ($skiplogic as $logic) {
                $answer_value=explode(",",$logic["a_id"]);
                
                    if (isset($post_question[$logic["q_id"]]["answer"])&&is_array($post_question[$logic["q_id"]]["answer"])) {
                        
                        $q_type=$post_question[$logic["q_id"]]["type"];
                        $q_orientation=$post_question[$logic["q_id"]]["orientation"];                    
                        if (($q_type=="radio"&&($q_orientation!="matrix"))||($q_type=="checkbox"&&$q_orientation!="matrix")){
                            $data=$post_question[$logic["q_id"]]["answer"];
                            foreach ($data as $a_id) {
                                if (intval($a_id)>0) {
                                    $a_ids[]=$a_id;
                                }elseif ($a_id == "on"){
                                    $a_ids[]=0;
                                }
                            }                        
                        }else{
                            $data=$post_question[$logic["q_id"]]["answer"];
                            foreach ($data as $a_id => $a_val) {
                                if (intval($a_id)>0) {
                                    $a_ids[]=$a_id;
                                }elseif ($a_id == "on"){
                                    $a_ids[]=0;
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
        if (isset($_SESSION["survey"]["skip_page"])&&is_array($_SESSION["survey"]["skip_page"])){
            if (in_array($paget,$_SESSION["survey"]["skip_page"])){
                $id_list = implode(",",$_SESSION["survey"]["skip_page"]);               
                $database->setQuery("SELECT page_id FROM #__ijoomla_surveys_pages WHERE s_id=".$survey_id." AND page_id NOT IN ($id_list) AND ordering>=".intval($post_ordering)." AND page_id<>".intval($post_cpage)." ORDER BY ordering ASC LIMIT 1");
                
                if (!$database->query()){
                    die("Error !Code 14: The process could not be finished due to internal error. Please contact the administrators");
                }
                if ($database->getNumRows()<1){
                    $paget=-1;
                }
                else{
                    $paget=$database->loadResult();
                }
            }
        } 
            
        $page_to_view=intval($paget);
            
        sess_process($page_to_view,'next');
        
        $database->setQuery("SELECT general_option FROM #__ijoomla_surveys_config");
        if (!$database->query()){
            die("Error !Code 14: The process could not be finished due to internal error. Please contact the administrators");
        }        
        $general_result=$database->loadResult();
        if ($general_result==_ONE_RESPONSE_P_RESPONDENT_FO_VALUE) {
            if (!isset($_SESSION["visited_pages"])){
                $_SESSION["visited_pages"]=array();
            }
            if (in_array($page_to_view,$_SESSION["visited_pages"])){
                $page_to_view=array_pop($_SESSION["visited_pages"]);
                array_push($_SESSION["visited_pages"],$page_to_view);
            }
            else{
                array_push($_SESSION["visited_pages"],$page_to_view);
            }
        }
        
        view_survey($survey_id,$survey_title,$page_to_view,'survey flow');
    }
    elseif (JArrayHelper::getValue($_REQUEST,'Back')) {
        $page_to_view=intval($get_page);
        sess_process($page_to_view,'back');
        view_survey($survey_id,$survey_title,$page_to_view,'survey flow');
    }
    else{  // start view survey
        if (isset($_SESSION["visited_pages"])){
            $_SESSION["visited_pages"]=null;
        }
        view_survey($survey_id,$survey_title);
    }
}
?>