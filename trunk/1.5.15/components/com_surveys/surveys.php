<?php
/*
* $Id: <surveys.php,0.0.27b <version> 2007/03/24 hh:mm:ss <iJoomla Al> $
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
* @history
* ====================================================================
* File creation date:
* Current file version: 2.0.1
* 
* Modified Date:   08.04.2009
* Modification:    Remove some spams from 'Open Ended - One Line w/Prompt' and 
*				   'Open Ended - Essay'
*
* Modified Date:   15.04.2009
* Modification:   'One response per respondent ' - 'matrix - one answer per row' 
*	 			  questions required - on Back/Next to page buttons  issue
*
* Modified Date:   16.04.2009
* Modification:    Don't respond multiple times on 'one response only' survey
*		    		- I fill in a survey on IP address A and complete that survey.
*				    - At a later moment I go back to my survey on IP address A. That 
*					takes me back to my previously filled in survey. I'm able to see my 	
*					answers and possibly correct them. That's exactly how it should work.
*				   - But when I go back to my survey from IP address B I would expect the 	
*					same behaviour	
*
* ====================================================================
* @endhistory
*/

//checked for errors, but in the front end warnings are not shown
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL);
ini_set("session.bug_compat_42","0");

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang;
global $mosConfig_debug;
$database = &JFactory::getDBO();
$my = &JFactory::getUser();

session_start();

if( is_file( JPATH_SITE ."/administrator/components/com_surveys/language/$mosConfig_lang.surveys.php")){
    @include_once( JPATH_SITE ."/administrator/components/com_surveys/language/$mosConfig_lang.surveys.php");
}else{
	include_once( JPATH_SITE ."/administrator/components/com_surveys/language/english.surveys.php" );
}
require_once( JPATH_SITE."/components/com_surveys/functions.php" );
require_once( JPATH_SITE."/components/com_surveys/surveys.html.php" );
require_once( JPATH_SITE."/administrator/components/com_surveys/surveys_config.php" );

$get_option     =JArrayHelper::getValue($_REQUEST,"option"     );
$get_itemid     =JArrayHelper::getValue($_REQUEST,"Itemid"     );
$get_act        =JArrayHelper::getValue($_REQUEST,"act"        );
$get_mode       =JArrayHelper::getValue($_REQUEST,"mode"       );
$get_question_id=JArrayHelper::getValue($_REQUEST,"question_id");
$get_page       =JArrayHelper::getValue($_REQUEST,"page"       );
$get_page_now   =JArrayHelper::getValue($_REQUEST,"page_now"   );
$get_page_id    =JArrayHelper::getValue($_REQUEST,"page_id"    );
$get_q_id       =JArrayHelper::getValue($_REQUEST,"q"          );
$get_a_id       =JArrayHelper::getValue($_REQUEST,"a"          );

if ($get_page=="last"){
    $get_page = -1;
}
if ($get_page_now=="last"){
    $get_page_now = -1;
}
if ($get_page_id=="last"){
    $get_page_id = -1;
}

$homelink="index.php?option=".$get_option."&amp;Itemid=".$get_itemid;

function survey_header(){
    global $mainframe;
        
    $text = '
	<style type="text/css" media="screen">
		@import url('.JURI::base().'components/com_surveys/survey.css );
	</style>';

    $mainframe->addCustomHeadTag( $text );
}
survey_header();

//start alin comment
/*$survey_title=str_replace("%20"," ",JArrayHelper::getValue($_REQUEST,"survey"));
$survey_title=str_replace("+"," ",JArrayHelper::getValue($_REQUEST,"survey"));	
	
$database->setQuery("SELECT s_id FROM #__ijoomla_surveys_surveys WHERE title='$survey_title'");

$survey_title = stripslashes($survey_title);


if (!$database->query()){
    die("Error ! Code 00: The process could not be finished, please contact the administrators");
}
$survey_id_exist=$database->getNumRows($database->query());
$survey_id=$database->loadResult(); */
//end alin comment

//start alin 
$survey=JRequest::getVar("survey","","","string");
$survey=explode(":",$survey);
$survey_id=intval($survey[0]);
if($survey_id>0) $survey_id_exist=1;
//end alin

    // session variables init
    if (!isset($_SESSION['init_setup'])){
        $_SESSION['init_setup'] = "YES";
	    $_SESSION["survey"]=null;
	    $_SESSION["order"]=null;
	    $_SESSION["order_column"]=null;
	    $_SESSION["pre_page"]=null;
    }
    
switch ($get_act) {
    case "view_survey":
        require(JPATH_SITE."/components/com_surveys/inc.view_survey.php");
        break;
        
    case "view_result":
        view_result($survey_id,$survey_title);
        break;
        
    case "details":
        view_details($survey_id,$get_q_id);
        break;
            
    case "values":
        view_values($survey_id,$get_a_id);
        break;        
      
    default:show_surveys();
}

function view_details( $s_id, $q_id ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_result_text WHERE q_id=$q_id" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();

	# Do the main database query
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result_text WHERE q_id=$q_id ORDER BY rt_id DESC" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
	view_result_text( $rows, $q_id, $s_id);
}

function view_values( $s_id, $a_id) {
	global $mainframe, $answer_info, $question_info;
	$database = &JFactory::getDBO();
	
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id " );
	$database->loadObject( $answer_info );

	$database->setQuery("SELECT * FROM #__ijoomla_surveys_questions WHERE q_id=$answer_info->q_id" );
	$database->loadObject( $question_info );
	
	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_result WHERE a_id=$a_id" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();
	
	# Do the main database query
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE a_id=$a_id AND value<>'' ORDER BY r_id DESC" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
	view_result_value( $rows, $question_info, $answer_info, $s_id, $a_id );
}
?>
