<?php
/*
 * $Id: <functions.php,0.0.31 <version> 2007/04/11 hh:mm:ss <creator name> $
 *
 * @package iJoomla Surveys
 * @email webmaster@ijoomla.com
 *
 * @copyright
 * ==================================================================== * @copyright   (C) 2010 iJoomla, Inc. - All rights reserved.
 * @license  GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author  iJoomla.com <webmaster@ijoomla.com>
 * @url   http://www.ijoomla.com/licensing/
 * the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript  *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0 
 * More info at http://www.ijoomla.com/licensing/
 * ====================================================================
 * @endcopyright
 *
 * @file <functions.php>
 * @brief <brief description of file purpose>
 *
 * @functionlist
 * ====================================================================
 * function msg
 * function isequal
 * function hascommonpoint
 * function hasnotcommonpoint
 * function sess_process
 * function text_wrap
 * function add_result_for_page
 * ====================================================================
 * @endfunctionlist
 *
 * @history
 * ====================================================================
 * File creation date:
 * Current file version: 0.0.31
 *
 * Modified By: iJoomla Al
 * Modified Date: 20/09/2006
 * Modification: add_result() - send mail to admin when survey is finished
 *
 * Modified By: iJoomla Al
 * Modified Date: 21/09/06
 * Modification: add_result() - question answers in emails
 *
 * Modified By: iJoomla Al
 * Modified Date: 21/09/2006
 * Modification: new $s_title parameter replaces id for it to be used in URLs in functions
 *
 * Modified By: iJoomla Al
 * Modified Date: 03/10/2006
 * Modification: add_result() - we use two new arrays for answers
 *
 * Modified By: iJoomla Al
 * Modified Date: 06/10/2006
 * Modification: sefRelToAbs() is used for SEF URLs
 *
 * Modified By: iJoomla Al
 * Modified Date: 23/10/2006
 * Modification: SURVEYS-5
 *
 * Modified By: iJoomla Al
 * Modified Date: 31/10/2006
 * Modification: SURVEYS-53 - Problems with long names - text_wrap() added
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/11/2006
 * Modification: SURVEYS-74 code cleaned
 *
 * Modified By: iJoomla Al
 * Modified Date: 22/11/2006
 * Modification: SURVEYS-52 add_result_for_page() function modified for open datetime questions
 *
 * Modified By: iJoomla Al
 * Modified Date: 08/12/2006
 * Modification: survey last page id changed in URLs from -1 to "last", for SEF compliance
 *
 * Modified By: iJoomla Al
 * Modified Date: 02/02/2007
 * Modification: SURVEYS-143 - add_result_for_page() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 12/03/2007
 * Modification: XHTML1.0 valid
 *
 * Modified By: iJoomla Al
 * Modified Date: 11/04/2007
 * Modification: sess_process() modified
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
function msg($Content, $url){
		echo "<script language='javascript1.2' >alert('$Content'); window.location='".JRoute::_($url)."'</script>";
}

function isequal($arr1,$arr2) {
		foreach ($arr1 as $value) {
			if (!in_array($value,$arr2)) {
			    return false;
			}
		}
		foreach ($arr2 as $value) {
			if (!in_array($value,$arr1)) {
			    return false;
			}
		}
		return true;
}

function hascommonpoint($arr1,$arr2) {
		foreach ($arr1 as $value) {
			if (in_array($value,$arr2)) {
			    return true;
			}
		}
		return false;
}

function hasnotcommonpoint($arr1,$arr2) {
		foreach ($arr1 as $value) {
			if (!in_array($value,$arr2)) {
			    return true;
			}
		}
		return false;
}

function sess_process($page=0,$action='next') {
    $post_question=JArrayHelper::getValue($_POST,"question");
    $post_cpage   =JArrayHelper::getValue($_POST,"cpage"   );
    if ($post_cpage=="last"){
        $post_cpage = -1;
    }
	if ($action=='next') {
	    $page_name = "page_".intval($post_cpage);
	    if (!is_array($_SESSION["survey"])){
	        $_SESSION["survey"] = array();
	    }
		$_SESSION["survey"][$page_name]=serialize($post_question);
		$_SESSION['pre_page'][$page]=intval($post_cpage);
	}
	elseif ($action=='back') {
	    if (!is_array($_SESSION["survey"])){
	        $_SESSION["survey"] = array();
	    }
		$_SESSION["survey"]["page_".intval($post_cpage)]=null;
	}
}

function text_wrap ($text, $length, $break) {
    /* iJoomla Al SURVEYS-53
    wraps $text in pieces of maximum $length
    returns layout text
    */
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

function add_result_for_page($current_page_id,$completed_page_id,$session_id){
    $database = &JFactory::getDBO();
    $error=0;
    if ($current_page_id!=-1){
        $database->setQuery("UPDATE #__ijoomla_surveys_session SET last_page_id='$current_page_id' WHERE session_id='$session_id'");
        if (!$database->query()){
            die("Error ! The process could not be finished due to internal error. Please contact the administrators");
        }
    }

    $page_array_name="page_".$completed_page_id;
    if (isset($_SESSION["survey"]["$page_array_name"])){
		if (!is_array($_SESSION["survey"]["$page_array_name"])){
			$data=unserialize($_SESSION["survey"]["$page_array_name"]);
        }else{
            $data=$_SESSION["survey"]["$page_array_name"];
        }
    }else{
        $data=null;
    }

    if (is_array($data)) {
        foreach ($data as $q_id => $question) {
            $questions[]=$q_id;
            $clear_res_query="DELETE FROM #__ijoomla_surveys_result WHERE q_id='$q_id' AND session_id='$session_id'";
            $database->setQuery($clear_res_query);
            if (!$database->query()){
                die("Error ! The process could not be finished due to internal error. Please contact the administrators");
            }

            $clear_res_text_query="DELETE FROM #__ijoomla_surveys_result_text WHERE q_id='$q_id' AND session_id='$session_id'";
            $database->setQuery($clear_res_text_query);
            if (!$database->query()){
                die("Error ! The process could not be finished due to internal error. Please contact the administrators");
            }


            if ($question["orientation"]!='matrix' && $question["orientation"]!='open') {
                // 'dropdown' orientation : 'Open Ended - One Line w/Prompt', 'Open Ended - Essay'
                if (isset($question["answer_text"])&&$question["answer_text"]!='') {
                    // remove spam
                    $regx = "/\[url=(.*)\[\/url\]/iU";
                    $question["answer_text"] = preg_replace($regx, '', $question["answer_text"]);

                    $database->setQuery("INSERT INTO #__ijoomla_surveys_result_text(rt_id,q_id,value,session_id)
										 VALUES ('', '".$q_id."', '".trim($database->getEscaped($question["answer_text"]))."', '".$session_id."')");
                    if(!$database->query()){
                        $error=1;
                    }
                    $answers[]=trim(addslashes($question["answer_text"]));
                    $answers_rt_id[]=$database->insertid();
                }

                    if (isset($question["answer"])&&is_array($question["answer"]))
                    foreach ($question["answer"] as $key => $a_id) {
                        if (isset($a_id)&&$a_id>0){
                            $database->setQuery("INSERT INTO #__ijoomla_surveys_result(r_id,q_id,a_id,ac_id,session_id)
    											 VALUES ('', '$q_id', '$a_id', '', '$session_id')");
                            if(!$database->query()){
                                $error=1;
                            }
                            $answers[]=$a_id;
                            $answers_r_id[]=$database->insertid();
                        }
                    }
            }
            elseif ($question["orientation"]=='open')	{

                if ($question["type"]=='text' || $question["type"]=='textarea') {
                    if (isset($question["answer_text"])&&$question["answer_text"]!='') {

                        $database->setQuery("INSERT INTO #__ijoomla_surveys_result_text(rt_id,q_id,value,session_id)
										 VALUES ('', '".$q_id."', '".trim($database->getEscaped($question["answer_text"]))."', '".$session_id."')");
                        if(!$database->query()){
                            $error=1;
                        }
                        $answers[]=trim(addslashes($question["answer_text"]));
                        $answers_rt_id[]=$database->insertid();
                    }
                }
                elseif ($question["type"]=='constant') {
                    if (isset($question["answer"])&&is_array($question["answer"])){
                        $answer_valid="no";
                        foreach ($question["answer"] as $a_id => $value) {
                            if ($value!=''&&$value!=0&&$a_id>0){
                                $answer_valid="yes";
                                break;
                            }
                        }

                        if ($answer_valid=="yes")
                        foreach ($question["answer"] as $a_id => $value) {
                            $value=intval($value);
                            if (is_int($value))
                            {
                                $database->setQuery("INSERT INTO #__ijoomla_surveys_result(r_id,q_id,a_id,ac_id,session_id,value)
    								     				 VALUES ('', '$q_id', '$a_id', '', '$session_id','".intval($value)."')");
                                if(!$database->query()){
                                    $error=1;
                                }
                            }
                            $answers[]=intval($value);
                            $answers_r_id[]=$database->insertid();
                        }

                    }
                }
                elseif ($question["type"]=='moreline') {
                    if (isset($question["answer"]))
                    foreach ($question["answer"] as $a_id => $value) {
                        if ($value!=''&&$a_id>0) {
                            $sql="INSERT INTO #__ijoomla_surveys_result(r_id,q_id,a_id,ac_id,session_id,value)		 VALUES ('', '$q_id', '$a_id', '', '$session_id','".trim(addslashes($value))."')";
                            $database->setQuery($sql);
                            if(!$database->query()){
                                $error=1;
                            }
                            $answers[]=trim(addslashes($value));
                            $answers_r_id[]=$database->insertid();
                        }
                    }
                }
                elseif ($question["type"]=='datetime') {

                    if (isset($question["answer"])&&is_array($question["answer"])){
                        foreach ($question["answer"] as $a_id => $value) {
                            if ($a_id>0 && $value!='')
                            if ($value["month"]!=""||$value["day"]!=""||$value["year"]!=""){
                                $year_val=1971;
                                if (intval($value["year"])>1971 && intval($value["year"]) <= 2038){
                                    $year_val = intval($value["year"]);
                                }elseif (intval($value["year"]) > 2038){
                                    $year_val = 2038;
                                }

                                $timesubmited=mktime(0,0,0,intval($value["month"]),intval($value["day"]),$year_val);
                                $database->setQuery("INSERT INTO #__ijoomla_surveys_result(r_id,q_id,a_id,ac_id,session_id,value)		 VALUES ('', '$q_id', '$a_id', '', '$session_id','".$timesubmited."')");
                                if(!$database->query()){
                                    $error=1;
                                }
                                $answers[]=$timesubmited;
                                $answers_r_id[]=$database->insertid();
                            }
                        }
                    }
                }
            }
            else { // ANSWER IS  MATRIX

                if ($question["type"]!='menu') {
                    if (isset($question["answer"])&&is_array($question["answer"]))
                    foreach ($question["answer"] as $a_id => $ac_idarr) {
                        if (is_array($ac_idarr) && $a_id>0)
                        foreach ($ac_idarr as $key => $ac_id) {
                            $database->setQuery("INSERT INTO #__ijoomla_surveys_result(r_id,q_id,a_id,ac_id,session_id)
												 VALUES ('', '$q_id', '$a_id', '$ac_id', '$session_id')");
                            if(!$database->query()){
                                $error=1;
                            }
                            $answers[]=$a_id;
                            $answers_r_id[]=$database->insertid();
                        }
                    }
                }
                else {

                    // iJoomla Al : 22/11/2006 : code causing error, undefined variable
                    // if (intval($ac_id)!=-1)
                    foreach ($question["menu"] as $m_id => $answers) {
                        foreach ($answers["answer"] as $a_id => $ac_id) {
                            if ($a_id>0 && $ac_id>0){
                                $database->setQuery("INSERT INTO #__ijoomla_surveys_result(r_id,q_id,a_id,m_id,ac_id,session_id)
    												 VALUES ('', '$q_id', '$a_id','$m_id', '$ac_id', '$session_id')");
                                if(!$database->query()){
                                    $error=1;
                                }
                                $answers[]=$a_id;
                                $answers_r_id[]=$database->insertid();
                            }
                        }
                    }
                }
            }
        }

    }
    if ($error!=0){
        echo "An error occured while registering the results ! Contact the administrators";
    }
}

?>