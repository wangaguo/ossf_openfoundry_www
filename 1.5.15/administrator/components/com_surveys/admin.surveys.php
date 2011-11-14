<?php
/*
 * $Id: <admin.surveys.php,0.0.30 <version> 2007/01/10 hh:mm:ss <creator name> $
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
 * @file admin.surveys.php
 * @brief <brief description of file purpose>
 * 
 *  * @BeginFunctionList
 * ====================================================================
 *	function saveOrder 
 *	function clear_result
 *	function view_result_text
 *	function view_result_value
 *	function ordersurvey
 *	function publishskiplogic
 *	function editskiplogic
 *	function removeskiplogic
 *	function saveskiplogic
 *	function cancelskiplogic
 *	function publishblock
 *	function orderblock
 *	function editblock
 *	function removeblock
 *	function saveblock
 *	function cancelblock
 *	function cancelConfig
 *	function showblock
 *	function copySurvay
 *	function publishSurvey
 *	function publishresponse
 *	function removeSurvey
 *	function removeresponses
 *	function editSurvey
 *	function removeSurvey
 *	function removeresponses
 *	function saveSurvey	 	
 * 	function cancelSurvey
 *	function showSurvey
 *	function showresponses
 *	function showresult
 *	function showtitle
 *	function analyze
 *	function orderquestion
 *	function requiredquestion
 *	function publishquestion
 *	function editquestion
 *	function removequestion
 *	function savequestion
 *	function cancelquestion
 *	function showquestion
 *	function convert_to_time
 *	function mf_convert_to_timestamp
 *	function showConfig
 *	function saveConfig
 *	function showabout
 *	function text_wrap
 *  function change_access
 *  function force_publish_survey
 *  function export_data
 *	====================================================================
 * @EndFunctionList
 * 
 * 
 * @history
 * ====================================================================
 * File creation date: 
 * Current file version:
 *
 * Modified By: iJoomla Al
 * Modified Date: 20/09/2006
 * Modification: saveConfig() - update email settings  
 *
 * Modified By: iJoomla Al
 * Modified Date: 22/09/2006
 * Modification: we keep the s_id and page_id in session for later autocomplete 
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: requiredquestion(),publishquestion(),removequestion(),savequestion() - questions in skip actions cannot be "not required",unpublished,deleted   
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: publishblock() - pages in skip actions cannot be unpublished 
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: saveskiplogic() - questions in skip logics are made required 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 26/09/2006
 * Modification: new copy feature for surveys and pages - copySurvey(), copyBlock() functions
 *
 * Modified By: iJoomla Al
 * Modified Date: 27/09/2006
 * Modification: removeblock(),saveblock() - pages in skip actions cannot be deleted/unpublished
 *
 * Modified By: iJoomla Al
 * Modified Date: 28/09/2006
 * Modification: saveConfig() - update general settings  
 *
 * Modified By: iJoomla Al
 * Modified Date: 04/10/2006
 * Modification: analyze() - fixed 
 *
 * Modified By: iJoomla Al
 * Modified Date: 04/10/2006
 * Modification: SURVEYS-27 - clear_result() function fixed
 *
 * Modified By: iJoomla Al
 * Modified Date: 05/10/2006
 * Modification: SURVEYS-30 - orderblock() 
 *
 * Modified By: iJoomla Al
 * Modified Date: 05/10/2006
 * Modification: removeresponses() - fixed    
 *
 * Modified By: iJoomla Al
 * Modified Date: 06/10/2006
 * Modification: SURVEYS-30 - saveOrder() function : new tests for page reordering, skip action logics must not be broken    
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/10/2006
 * Modification: SURVEYS-22  
 *
 * Modified By: iJoomla Al
 * Modified Date: 23/10/2006
 * Modification: SURVEYS-32
 *
 * Modified By: iJoomla Al
 * Modified Date: 27/10/2006
 * Modification: show survey list settings
 *
 * Modified By: iJoomla Al
 * Modified Date: 30/10/2006
 * Modification: SURVEYS-48 "About page" problem - showabout() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 31/10/2006
 * Modification: SURVEYS-53 Problems with long names - function text_wrap() created
 *
 * Modified By: iJoomla Al
 * Modified Date: 31/10/2006
 * Modification: SURVEYS-54 Creating "Matrix Multiple Answers per row(menus)" - function savequestion() fixed
 * 
 * Modified By: iJoomla Al
 * Modified Date: 09/11/2006     
 * Modification: SURVEYS-59 function savequestion() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/11/2006
 * Modification: SURVEYS-74 code cleaned  
 * 
 * Modified By: iJoomla Al
 * Modified Date: 23/11/2006
 * Modification: SURVEYS-102,SURVEYS-97 JArrayHelper::getValue default value changed for task
 * 
 * Modified By: iJoomla Al
 * Modified Date: 23/11/2006
 * Modification: Edit Page Notice Bug - editblock() modified  
 * 
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-98,SURVEYS-98 - JArrayHelper::getValue before switch
 * 
 * Modified By: iJoomla Al
 * Modified Date: 04/12/2006
 * Modification: SURVEYS-88 - filter buttons added for every manager:showSurvey(),showquestion(),showblock(),showskiplogic() modified
 * 
 * Modified By: iJoomla Al
 * Modified Date: 05/12/2006
 * Modification: SURVEYS-107 - new function created to change access level - change_access()
 * 
 * Modified By: iJoomla Al
 * Modified Date: 11/12/2006
 * Modification: SURVEYS-42 clear_result() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/12/2006
 * Modification: SURVEYS-110 continue_editing task added to surveys, pages, questions, skip
 * 
 * Modified By: iJoomla Al
 * Modified Date: 18/12/2006
 * Modification: SURVEYS-111,SURVEYS-113 analyze() parameters modified , last task, last s_id, last session_id kept in $_POST
 * 
 * Modified By: iJoomla Al
 * Modified Date: 03/01/2006
 * Modification: SURVEYS-42 - clear_result() modified 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 04/01/2006
 * Modification: SURVEYS-119 - editSurvey(),editquestion(),editblock(),saveskiplogic() modified
 * 
 * Modified By: iJoomla Al
 * Modified Date: 18/01/2007
 * Modification: SURVEYS-123 - showquestion() modified 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 20/01/2007
 * Modification: SURVEYS-125 - saveOrder() modified 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 22/01/2007
 * Modification: SURVEYS-128 - editquestion() modified 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 06/02/2007
 * Modification: SURVEYS-152 - showresponses() modified  
 * 
 * Modified By: iJoomla Al
 * Modified Date: 07/02/2007
 * Modification: showresponses() - jos_ fixed table prefix modified
 * 
 * Modified By: iJoomla Al
 * Modified Date: 09/02/2007
 * Modification: SURVEYS-153 - showabout() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 05/06/2007
 * Modification: fix for copySurvey() - escape '
 * 
 * Modified By: iJoomla Al
 * Modified Date: 29/08/2007
 * Modification: sql query optimized in function analyze(...)
 * 
 * Modified By: 
 * Modified Date: 27.02.2009
 * Modification: Show Survey Result/Show on results module 
 *
 * ====================================================================
 * @endhistory
 */	

// ensure this file is being included by a parent file

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
//remove notice msg from lay_out
ini_set('error_reporting',E_ALL ^ E_NOTICE);
/*
global $mainframe, $mainframe;
$acl = &JFactory::getACL();
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_surveys' ))) {
	$mainframe->redirect( 'index2.php', _NOT_AUTH );
}*/

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );
require_once( JPATH_SITE ."/administrator/components/com_surveys/surveys.class.php" );
if( is_file( JPATH_SITE ."/administrator/components/com_surveys/language/$mosConfig_lang.surveys.php")){
    @include_once( JPATH_SITE ."/administrator/components/com_surveys/language/$mosConfig_lang.surveys.php");
}else{
	include_once( JPATH_SITE ."/administrator/components/com_surveys/language/english.surveys.php" );
}

$task             = JArrayHelper::getValue( $_REQUEST, 'task'        );
$lasttask         = JArrayHelper::getValue( $_POST   , 'lasttask'    );
$lasts_id         = JArrayHelper::getValue( $_POST   , 'lasts_id'    );
$post_filter      = JArrayHelper::getValue( $_POST   , 'filter_machine');
$get_filter       = JArrayHelper::getValue( $_GET    , 'filter');
$act              = JArrayHelper::getValue( $_REQUEST, 'act',array(0));
$get_s_id         = JArrayHelper::getValue( $_GET    , 's_id'        );
$get_page_id      = JArrayHelper::getValue( $_GET    , 'page_id'     );
$get_q_id         = JArrayHelper::getValue( $_GET    , 'q_id'        );
$get_sk_id        = JArrayHelper::getValue( $_GET    , 'sk_id'       );
$post_s_id        = JArrayHelper::getValue( $_POST   , 's_id'        );
$post_page_id     = JArrayHelper::getValue( $_POST   , 'page_id'     );
$post_q_id        = JArrayHelper::getValue( $_POST   , 'q_id'        );
$post_a_id        = JArrayHelper::getValue( $_POST   , 'a_id'        );
$post_session_id  = JArrayHelper::getValue( $_POST   , 'session_id'  );
$post_analyze_form= JArrayHelper::getValue( $_POST   , 'analyze_form');
$post_ac_id       = JArrayHelper::getValue( $_POST   , 'ac_id'       );
$post_m_id        = JArrayHelper::getValue( $_POST   , 'm_id'        );
$s_id             = JArrayHelper::getValue( $_POST   , 's_id'        );
$q_id             = JArrayHelper::getValue( $_POST   , 'q_id'        );
$page_id          = JArrayHelper::getValue( $_POST   , 'page_id'     );
$sk_id            = JArrayHelper::getValue( $_POST   , 'sk_id'       );
$preview          = JArrayHelper::getValue( $_REQUEST, 'preview'     );
$export           = JArrayHelper::getValue( $_REQUEST, 'export'     );

HTML_surveys::header(); 

if($preview == "preview"){
	include_once( JPATH_SITE ."/administrator/components/com_surveys/survey_preview.php" );	
}
elseif($export == "export"){
	include_once( JPATH_SITE ."/administrator/components/com_surveys/export_data.php" );	
}
else{
switch ($act) {
	case "survey":
		switch ($task) {
			case "copy":
				copySurvey( $s_id, $option, $act );
				break;		    
		    		    
			case "publish":
				publishSurvey( $s_id, 1, $option, $act );
				break;
		
			case "unpublish":
				publishSurvey( $s_id, 0, $option , $act );
				break;

			case "force_publish":
				force_publish_survey( $s_id[0], 1, $option, $act, "export_data" );
				break;
		
			case "force_unpublish":
				force_publish_survey( $s_id[0], 0, $option , $act , "export_data");
				break;				
				
			case "showresult":
				showresult( $s_id, 1, $option, $act );
				break;
		
			case "unshowresult":
				showresult( $s_id, 0, $option, $act );
				break;
		
			case "new":
				editSurvey( 0, $option, $act );
				break;
		 
			case "edit":
				editSurvey( $s_id[0], $option, $act );
				break;

			case "continue_editing":
				editSurvey( $get_s_id, $option, $act );
				break;				
						 
			case "remove":
				if ( JArrayHelper::getValue($_POST,'responses')=='yes' ){
				    if ( is_array( $post_s_id ) ){
				        $selected_s_id=intval( $post_s_id[0] );
				    }
				    else {
				        $selected_s_id=intval( $post_s_id );		    
				    }
				    removeresponses( $post_session_id, $selected_s_id, $option, $act );
				}
				else {
				    removeSurvey( $s_id, $option, $act );
				}
				break;
		
			case "save":
				saveSurvey( $option, $act, $task );
				break;

			case "apply":
				saveSurvey( $option, $act, $task, $s_id );
				break;				
				
			case "cancel":
				cancelSurvey( $option, $act, $lasttask, $lasts_id );
				break;
		
			case "orderup":
				ordersurvey( $s_id[0], -1, $option, $act );
				break;
			
			case "orderdown":
				ordersurvey( $s_id[0], 1, $option, $act );
				break;
			
			case "view_result_text":
				view_result_text( intval( $post_q_id ), $option, $act, $task , $lasts_id, $lasttask, $post_filter);
				break;
				
			case "view_result_value":
				view_result_value( intval( $post_a_id ), $option, $act, $task , $lasts_id, $lasttask, $post_filter);
				break;
				
			case "rpublish":
				publishresponse( $post_session_id, 1, intval( $post_s_id[0] ), $option, $act );
				break;
		
			case "runpublish":
				publishresponse( $post_session_id, 0, intval( $post_s_id[0] ), $option , $act );
				break;
				
			case "responses":
			    if (isset($s_id[0])&&$s_id[0]>0){
			        $target_s_id=$s_id[0];
			    }else{
			        $target_s_id=$get_s_id;
			    }
				showresponses( $target_s_id, $option, $act );
				break;
				
			case "showrespondent";
			    if (isset($post_s_id[0])&&$post_s_id[0]>0){
			        $target_s_id=$post_s_id[0];
			    }else{
			        $target_s_id=$get_s_id;
			    }
			    if (isset($post_session_id[0])){
			        $target_sess_id=$post_session_id[0];
			    }else{
			        $target_sess_id=$get_filter;
			    }			    		    
				analyze( intval( $target_s_id ), 0, 0, 0, 0, intval( $target_sess_id  ), "", $option, $act, 'yes', "responses" );
				break;
				
			case "analyze":
			    if (isset($s_id[0])&&$s_id[0]>0){
			        $target_s_id=$s_id[0];
			    }else{
			        $target_s_id=$get_s_id;
			    }	
			    
			    if (isset($_COOKIE['filter_machine'])){
			        $target_sess_id=$_COOKIE['filter_machine'];
			    }else{
			        $target_sess_id=$get_filter;
			    }			    		
                if ( $post_analyze_form == "yes" ){
                    analyze( $target_s_id, intval( $post_q_id ), intval( $post_a_id ), intval( $post_ac_id ), intval( $post_m_id ), $_COOKIE['filter_machine'], $_COOKIE['filter_text'], $option, $act );
                }
                else{
    				$_COOKIE['filter']      = '';
    				$_COOKIE['filter_text'] = '';
    				$target_sess_id='';
    				if (isset($get_filter)){    				    
    				    $target_sess_id    = $get_filter;
    				}
    				analyze( $target_s_id, 0, 0, 0, 0, $target_sess_id, '', $option, $act);                    
                }			    				
				break;
				
			case "saveorder":
				saveOrder( $s_id, $option, $act );
				break;
				
			case "clear":
				clear_result( $s_id, $option, $act );
				break;
				
			case "clear_filter":
				analyze( $s_id[0], intval( $post_q_id ), intval( $post_a_id ), intval( $post_ac_id ), intval( $post_m_id ), '', '', $option, $act);
				break;
				
			case "collect":
			    if (isset($s_id) && is_array($s_id)){
				    HTML_surveys::collect( $s_id[0], $option, $act );
			    }
				break;				
				
			case "accesspublic":
			    if (isset($s_id) && is_array($s_id)){
                    change_access($s_id[0],$task);
			    }
			    showSurvey( $option, $act );
			    break;
				
			case "accessregistered":
			    if (isset($s_id) && is_array($s_id)){
                    change_access($s_id[0],$task);
			    }
			    showSurvey( $option, $act );
			    break;
			    
			case "accessspecial":
			    if (isset($s_id) && is_array($s_id)){
                    change_access($s_id[0],$task);  
			    }
			    showSurvey( $option, $act );
			    break;

			case "export_data":
			    if (isset($post_s_id[0])&&$post_s_id[0]>0){
			        export_data($post_s_id[0],$option,$act,$lasttask);
			    }elseif (isset($get_s_id)&&$get_s_id>0){
			        export_data($get_s_id,$option,$act,$lasttask);
			    }
			    break;
			
			default:
				showSurvey( $option, $act );
				break;
		}
		break;


	case "question":
		switch ($task) {
		
			case "publish":
				publishquestion( $q_id, 1, $option, $act, intval( $post_s_id ), intval( $post_page_id ) );
				break;
		
			case "unpublish":
				publishquestion( $q_id, 0, $option, $act ,intval( $post_s_id ), intval( $post_page_id ) );
				break;
				
			case "required":
				requiredquestion( $q_id, 1, $option, $act, intval( $post_s_id ), intval( $post_page_id ) );
				break;
				
			case "unrequired":
				requiredquestion( $q_id, 0, $option, $act, intval( $post_s_id ), intval( $post_page_id ) );
				break;
				
			case "new":
				editquestion( 0, $option, $act );
				break;
		 
			case "edit":
				editquestion( $q_id[0], $option, $act , intval( $get_s_id ), intval( $get_page_id ) );
				break;
				
			case "continue_editing":
				editquestion( $get_q_id, $option, $act , intval( $get_s_id ), intval( $get_page_id ) );
				break;				
		 
			case "remove":
				removequestion( $q_id, $option, $act, intval( $post_s_id ), intval( $post_page_id ) );
				break;
		
			case "save":						
				savequestion( $option, $act, 'no' );
				break;
				
			case "apply":
				savequestion( $option, $act, 'no', $get_s_id, $get_page_id, $task );
				break;				
								
			case "cancel":
				cancelquestion( $option, $act );
				break;
				
			case "orderup":
				orderquestion( $q_id[0], -1, $option, $act, intval( $post_s_id ), intval( $post_page_id ) );
				break;
				
			case "orderdown":
				orderquestion( $q_id[0], 1, $option, $act, intval( $post_s_id ), intval( $post_page_id ) );
				break;
				
			case "saveorder":
				saveOrder( $q_id , $option, $act );
				break;
				
			case "reload":
				savequestion( $option, $act, 'yes', intval( $get_s_id ), intval( $get_page_id ) );
				break;
				
			default:
				showquestion( intval( $get_s_id ), intval( $get_page_id ), $option, $act );
				break;
		}
	break;
	case "block":
		switch ( $task ){
			case "copy":
				copyBlock( $page_id, $option, $act );
				break;		    
		    		    
			case "publish":
				publishblock( $page_id, 1, $option, $act );
				break;
		
			case "unpublish":
				publishblock( $page_id, 0, $option, $act );
				break;
				
			case "showtitle":
				showtitle( $page_id, 1, $option, $act, intval( $post_s_id ) );
				break;
				
			case "unshowtitle":
				showtitle( $page_id, 0, $option, $act, intval( $post_s_id ) );
				break;
				
			case "new":
				editblock( 0, $option, $act );
				break;
		 
			case "edit":
				editblock( $page_id[0], $option, $act );
				break;

			case "continue_editing":
				editblock( $get_page_id, $option, $act );
				break;
								
			case "remove":
				removeblock( $page_id, $option, $act );
				break;
		
			case "save":
				saveblock( $option, $act, $task );
				break;
				
			case "apply":			    
				saveblock( $option, $act , $task);
				break;
								
			case "cancel":
				cancelblock( $option, $act );
				break;
				
			case "orderup":
				orderblock( $page_id[0], -1, $option, $act, intval( $post_s_id ) );
				break;
				
			case "orderdown":
				orderblock( $page_id[0], 1, $option, $act, intval( $post_s_id ) );
				break;	
				
			case "saveorder":
				saveOrder( $page_id , $option, $act );
				break;
				
			default:
				showblock( intval( $get_s_id ), $option, $act );
				break;
		}
		break;
	case "skip":
		switch ($task) {
			case "publish":
				publishskiplogic( $sk_id, 1, $option, $act, intval( $get_s_id ), intval( $get_page_id ) );
				break;
		
			case "unpublish":
				publishskiplogic( $sk_id, 0, $option, $act, intval( $get_s_id ), intval( $get_page_id ) );
				break;
			
			case "new":			
				editskiplogic( 0, $option, $act );
				break;
		 
			case "edit":
				editskiplogic( $sk_id[0], $option, $act );
				break;
		 
			case "continue_editing":
				editskiplogic( $get_sk_id, $option, $act );
				break;	
								
			case "remove":
				removeskiplogic( $sk_id, $option, $act, intval( $get_s_id ), intval( $get_page_id ) );
				break;
		
			case "save":
				saveskiplogic( $option, $act, 'no' , $task);
				break;
				
			case "apply":
				saveskiplogic( $option, $act, 'no' , $task);
				break;				
								
			case "reload":
				saveskiplogic( $option, $act, 'yes', $task );
				break;	
				
			case "cancel":
				cancelskiplogic( $option, $act, intval( $get_s_id ), intval( $get_page_id ) );
				break;
				
			case "saveorder":
				saveOrder( $sk_id, $option, $act);
				break;
				
			default:
				showskiplogic( $option, $act, intval( $get_s_id ), intval( $get_page_id ) );
				break;
		}
		break;
	case "config":
		switch ( $task ){
			case "save" :
				saveConfig( $option, $act );
				break;
				
			case "apply" :
				saveConfig( $option, $act );
				break;				
				
			case "cancel":
				cancelConfig( $option, $act );
				break;
				
			default: 
				showConfig( $option, $act );
				break;
		}
		break;
	case "about" :
		showabout();
		break;
	default:
		switch ( $task ){
			case "analyze":
				analyze( $s_id[0], intval( $post_q_id ), intval( $post_a_id ), intval( $post_ac_id ), intval( $post_m_id ), JArrayHelper::getValue($_COOKIE,'filter_machine'), JArrayHelper::getValue($_COOKIE,'filter_text'), $option, $act );
			    break;
			
			case "rpublish":
				publishresponse( $post_session_id, 1, intval( $post_s_id[0] ), $option, $act );
				break;
		
			case "runpublish":
				publishresponse( $post_session_id, 0, intval( $post_s_id[0] ), $option , $act );
				break;
				
			case "responses":
				showresponses( $s_id[0], $option, $act );
				break;
				
			case "showrespondent";
				analyze( intval( $post_s_id[0] ), 0, 0, 0, 0, intval( $post_session_id[0] ), $option, $act );
				break;
				
			case "view_result_text":
				view_result_text( intval( $post_q_id ), $option, $act, $task , $lasts_id, $lasttask, $post_filter );
				break;
				
			case "clear_filter":
				$_COOKIE['filter']      = '';
				$_COOKIE['filter_text'] = '';
				analyze( $s_id[0], 0, 0, 0, 0, '', '', $option, $act );
				break;
				
			case "view_result_value":
				view_result_value( intval( $post_a_id ), $option, $act, $task , $lasts_id, $lasttask, $post_filter );
				break;
				
			default:
				HTML_surveys::control_panel( $option, $act );
			    break;
		}
		break;	
	}
}

HTML_surveys::footer();


function saveOrder( &$cid, $option, $act ) {
	global $mainframe, $post_s_id,$post_page_id;

	$database = &JFactory::getDBO();
	$total	  	       = count( $cid );
	$order 		       = JArrayHelper::getValue( $_POST, 'order', array(0) );	
	$reordering_blocks = false;
	
	if ( $act == 'question' ) {
		$row = new mosijoomla_questions($database);
	}
	elseif ( $act == 'survey' ) {$row = new mosijoomla_surveys( $database );}
	elseif ( $act == 'skip' )   {$row = new mosijoomla_surveys_skip_logics( $database );}
	else {
	    $row               = new mosijoomla_surveys_blocks( $database );
	    $row2              = new mosijoomla_surveys_blocks( $database );
	    $reordering_blocks = true;
	}

	$msg = "";
	if ( $reordering_blocks ) {
	    for ( $i=0; $i < $total; $i++ ) {
            $row->load( $cid[$i] );
            if ( $row->ordering != $order[$i] ) { 
                $skip_act_broken = false;
                for ( $j=0; $j < $total; $j++ ) {
                    if ( $i != $j) {                       
                        $row2->load( $cid[$j] );
                        if ( ($row->ordering < $row2->ordering) && ($order[$i] >= $order[$j]) ) {
                            $database->setQuery( "SELECT title FROM #__ijoomla_surveys_skip_logics WHERE page_id="
                                                 .$row->page_id
                                                 ." AND page_target="
                                                 .$row2->page_id 
                                                );
                            $skip_act_title = $database->loadAssocList();
                            if ( $database->getErrorNum() ) {
                                echo $database->stderr();
                                return false;
                            }
                            if ( count( $skip_act_title ) > 0 ) {
                                $msg             = "You can't change the order of the page because it's a part of a skip logic "
                                                   .$skip_act_title[0]["title"]
                                                   .", please first change or delete the skip logic <br />"
                                                   ;
                                $skip_act_broken = true;
                                break;
                            }
                        }
                        if ( ($row->ordering > $row2->ordering ) && ( $order[$i] <= $order[$j]) ) {
                            $database->setQuery( "SELECT title FROM #__ijoomla_surveys_skip_logics WHERE page_id="
                                                 .$row2->page_id
                                                 ." AND page_target="
                                                 .$row->page_id 
                                                );
                            $skip_act_title=$database->loadAssocList();
                            if ($database->getErrorNum()) {
                                echo $database->stderr();
                                return false;
                            }
                            if (count($skip_act_title) > 0){
                                $msg             = "You can't change the order of the page because it's a part of a skip logic "
                                                   .$skip_act_title[0]["title"]
                                                   .", please first change or delete the skip logic <br />"
                                                   ;
                                $skip_act_broken = true;
                                break;
                            }
                        } 
                    }
                }
                if ( !$skip_act_broken ){
                    $row->ordering = $order[$i];
                    if ( !$row->store() ) {
                        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
                        exit();
                    } // if
                }
            }
	    }
	}
	
	// update ordering values
	if ( !$reordering_blocks ) {
	    for( $i=0; $i < $total; $i++ ) {
	        $row->load( $cid[$i] );

	        if ( $row->ordering != $order[$i] ) {
	            $row->ordering = $order[$i];
	            if ( !$row->store() ) {
	                echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	                exit();
	            } // if
	        }
	    }
	    $msg = 'New ordering saved';
	}else{
	    if ( !$msg ) {// no errors in page reordering
	        $msg = 'New ordering saved';    
	    }
	}

	$add_text1="";
	if ($post_s_id>0){
	    $add_text1="&s_id=$post_s_id";
	}
	$add_text2="";
	if ($post_page_id>0){
	    $add_text2="&page_id=$post_page_id";
	}	
	$mainframe->redirect( "index2.php?option=$option&act=$act".$add_text1.$add_text2, $msg );
	
	
} // saveOrder
function clear_result( $s_id, $option, $act) {
	global $mainframe;
	$database = &JFactory::getDBO();
	$s_ids   = implode( ',', $s_id );
	$database->setQuery("SELECT title FROM #__ijoomla_surveys_surveys WHERE s_id IN ($s_ids)");
	$surveys = $database->loadResultArray();
	if ( $database->getErrorNum() ) {
	    echo $database->stderr();
	    return false;
	}
	
	$database->setQuery("SELECT session_id FROM #__ijoomla_surveys_session WHERE s_id IN ($s_ids)");
	$database->query();
	if ( $database->getErrorNum() ) {
	    echo $database->stderr();
	    return false;
	}
	if ( $database->getNumRows() > 0 )
	{	
		$sesssion = $database->loadResultArray();	
	    foreach ( $sesssion as $session_id ) 
		{
    		$database->setQuery( "DELETE FROM  #__ijoomla_surveys_result WHERE  session_id=$session_id" );
    		$database->query();
    	    if ( $database->getErrorMsg() ) {
    	        die( $database->getErrorMsg() );
    	    }
    	    $database->setQuery( "DELETE FROM  #__ijoomla_surveys_result_text WHERE session_id=$session_id" );
    	    $database->query();
    	    if ( $database->getErrorMsg() ) {
    	        die( $database->getErrorMsg() );
    	    }
    	    $database->setQuery( "DELETE FROM  #__ijoomla_surveys_session WHERE  session_id =$session_id" );
    	    $database->query();
    	    if ( $database->getErrorMsg() ) {
    	        die( $database->getErrorMsg() );
    	    }
	    }	
	}	
	$listsurvey = implode( ", ", $surveys );
	$msg 	    = "The results of surveys : $listsurvey have been deleted";
	$mainframe->redirect( "index2.php?option=$option&act=$act", $msg );
}

function view_result_text( $q_id, $option, $act, $task, $lasts_id, $lasttask, $post_filter=0 ) {
	global $mainframe, $mainframe;
	$database = &JFactory::getDBO();

	$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$extra_condition="";
	if ($post_filter!=0 && $post_filter>0){
	    $extra_condition = " AND session_id IN ($post_filter)";
	}
	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_result_text WHERE q_id=$q_id $extra_condition" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );

	# Do the main database query
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result_text WHERE q_id=$q_id $extra_condition ORDER BY rt_id DESC LIMIT $pageNav->limitstart,$pageNav->limit" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
	HTML_surveys::view_result_text( $rows, $pageNav, $option , $act , $task, $q_id, $lasts_id, $lasttask , $post_filter);
}
function view_result_value($a_id, $option, $act, $task, $lasts_id, $lasttask, $post_filter=0 ) {
	global $mainframe, $answer_info, $question_info;
	$database = &JFactory::getDBO();
	$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$extra_condition="";
	if ($post_filter!=0 && $post_filter>0){
	    $extra_condition = " AND session_id IN ($post_filter)";
	}
		
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE a_id=$a_id " );
	$database->loadObject( $answer_info );

	$database->setQuery("SELECT * FROM #__ijoomla_surveys_questions WHERE q_id=$answer_info->q_id" );
	$database->loadObject( $question_info );
	
	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_result WHERE a_id=$a_id" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();
	
	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );

	# Do the main database query
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE a_id=$a_id AND value<>'' $extra_condition ORDER BY r_id DESC LIMIT $pageNav->limitstart,$pageNav->limit" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
	HTML_surveys::view_result_value( $rows, $question_info, $answer_info, $pageNav, $option , $act ,$task, $lasts_id, $lasttask ,$post_filter, $a_id );
}
function ordersurvey( $s_id, $inc, $option , $act) {
	global $mainframe;
	$database = &JFactory::getDBO();
	
	$row = new mosijoomla_surveys( $database );
	$row->load( $s_id );
	$row->move( $inc );
	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}
// START SKIP LOGIC

function publishskiplogic( $cid, $publish, $option, $act, $s_id = 0, $page_id = 0 ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__ijoomla_surveys_skip_logics SET published=($publish) WHERE sk_id IN ($cids)");
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( count( $cid ) == 1 ) {
		$row = new mosijoomla_surveys_skip_logics( $database );
		$row->checkin( $cid[0] );
	}

	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id" );
}

function editskiplogic( $cid, $option , $act) {
	$database = &JFactory::getDBO();
	$row = new mosijoomla_surveys_skip_logics( $database );	
	$row->load( $cid );
	HTML_skiplogics::editskiplogic( $row, $option, $act );
}
/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function removeskiplogic( $cid, $option , $act, $s_id = 0, $page_id = 0 ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( !is_array( $cid ) || count( $cid ) < 1 ) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
	
	$cids = implode( ',', $cid );
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_skip_logics WHERE sk_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id" );
}


/**
* Saves the record from an edit form submit
* @param string The current GET/POST option
*/
function saveskiplogic( $option , $act, $reload = 'no' ,$task) {
	global $mainframe, $post_a_id;
	
	$post_a_id = $_REQUEST['a_id'];
//	var_dump($_REQUEST); die();
	$database = &JFactory::getDBO();
	$my = &JFactory::getUser();
	
	$row = new mosijoomla_surveys_skip_logics( $database );
		
	if ( !$row->bind( $_POST ) ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$database->setQuery("SELECT MAX(ordering) FROM #__ijoomla_surveys_skip_logics");
	$max_ordering = $database->loadResult();

	if ($max_ordering!=NULL){
	    $row->ordering = $max_ordering + 1 ;
	}else{
	    $row->ordering = 0;
	}
	if ( $reload == 'yes' ) {		
		HTML_skiplogics::editskiplogic( $row, $option, $act );
	}
	else {
		if ( is_array( $post_a_id ) ) {
		    $row->a_id = implode( ',', $post_a_id );
		}
		
		if ( !$row->store() ) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		
		$row->reorder();
		
		if ( $row->q_id > 0 ){
		    $database->setQuery( "SELECT required FROM #__ijoomla_surveys_questions WHERE q_id='$row->q_id'" );
		    $required_for_q = $database->loadResult();
		    if ( $database->getErrorNum() ) {
		        echo $database->stderr();
		        return false;
		    }
		    if ( $required_for_q != 1 ){
		        $database->setQuery( "UPDATE #__ijoomla_surveys_questions SET required='1' WHERE q_id='$row->q_id' AND required!='1' " );
		        $database->query();
		        if ( $database->getErrorMsg() ){
		            die( $database->getErrorMsg() );
		        }else{
                    $err_add = "&errcode=7";
		        }
		    }
		}

    	switch ( $task ) {
    		case "apply":		    
    			if ($row->page_id) {
    				global $mainframe;
    			    $msg = _SKIP_APPLY;
    			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&sk_id=$row->sk_id"."$err_add",$msg );
    			}
    			break;
    
    		case "save":
    		default:
    			$msg = _SKIP_SAVE;
    			$mainframe->redirect( "index2.php?option=$option&act=$act"."$err_add",$msg );
    			break;
    	}				
	}
}


/**
* Cancels an edit operation
* @param string The current GET/POST option
*/
function cancelskiplogic( $option , $act, $s_id, $page_id ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	$row = new mosijoomla_surveys_skip_logics( $database );
	$row->bind( $_POST );
	$row->checkin();
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id" );
}


/**
* List the records
* @param string The current GET/POST option
*/
function showskiplogic( $option, $act, $s_id = 0, $page_id = 0) {
	global $mainframe, $mainframe;
	$database = &JFactory::getDBO();

	$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_skip_logics" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );
	if ( $s_id && $page_id ) 	{
	    $ex=" WHERE s_id=$s_id  AND page_id=$page_id";
	}
	elseif ( $s_id ) {
	    $ex=" WHERE s_id=$s_id";
	}
	elseif ( $page_id ) {
	    $ex=" WHERE page_id=$page_id";
	}
	else {
	    $ex="";
	}
	# Do the main database query
	$search  = addslashes(JArrayHelper::getValue($_POST,'search'));
	$sql_search='';
	if ( $search ) {
	    if ($ex!=""){
		    $sql_search = " AND LOWER( title ) LIKE '%$search%'";
	    }else{
	        $sql_search = " WHERE LOWER( title ) LIKE '%$search%'";
	    }
	}	
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_skip_logics $ex $sql_search ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
  
	HTML_skiplogics::showskiplogic( $rows, $pageNav, $option , $act, $s_id, $page_id );
}

//END SKIP LOGIC
// START BLOCK

function copyBlock( $cid, $option , $act) {
	global $mainframe;
	$my = &JFactory::getUser();
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._COPY."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );
	
	if ( $cid != '') {
	    $database->setQuery( "SELECT MAX(ordering) FROM #__ijoomla_surveys_pages" );
	    $max_order_page = $database->loadResult();   
		if ( $database->getErrorNum() ) {
		    die( $database->stderr() );
		}	     
	}
	foreach ( $cid as $current_page_id ) { 
	    $new_survey_id = "";

	    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_pages WHERE page_id='".intval($current_page_id)."'" );
	    $pageData = $database->loadAssocList();
		if ( $database->getErrorNum() ) {
		    die( $database->stderr() );
		}	    
	    $max_order_page++;
	    $query_page_columns = "";
	    $query_page_values = "";
	    $column_count = 0;
	    foreach ( $pageData[0] as $key => $value ){

            // escape '
            $value=addslashes($value);

	        if ( $column_count != 0 ) { // we don't use the id for INSERT
	            if ( $key == "title" ) {
	                $query_page_columns .= "$key,";                

	                $test_page_title = "$value Copy";
	                $database->setQuery( "SELECT title FROM #__ijoomla_surveys_pages WHERE title LIKE '$test_page_title%'" );
	                $titleLikeData = $database->loadAssocList();
	                if ( $database->getErrorNum() ) {
	                    die( $database->stderr() );
	                }
	                $title_copy_number = 0;
	                foreach ( $titleLikeData as $currentTitle ) {
	                    if ( substr_count( $currentTitle["title"], 'Copy' ) == substr_count( $test_page_title, 'Copy' ) ) {
	                        $title_copy_number++;
	                    }
	                }
	                if ( $title_copy_number != 0 )
	                $copy_number         = " ".( $title_copy_number+1 );
	                $query_page_values  .= "'$value Copy".$copy_number."',";
	            }elseif ( $key == "s_id" ) {
	                $query_page_columns .= "$key,";
	                $query_page_values  .= "'$new_survey_id',";
	            }elseif ( $key == "ordering" ) {
	                $query_page_columns .= "$key,";
	                $query_page_values  .= "'".$max_order_page."',";
	            }else{
	                $query_page_columns .= "$key,";
	                $query_page_values  .= "'$value',";
	            }
	        }else{
	            $column_count++;
	        }
	    }
	    $query_page_columns = substr( $query_page_columns, 0, strlen( $query_page_columns )-1 );
	    $query_page_values  = substr( $query_page_values, 0, strlen( $query_page_values )-1 );
	    $query = "INSERT INTO #__ijoomla_surveys_pages ($query_page_columns) VALUES ($query_page_values)";

	    $database->setQuery( $query );
	    $database->query();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }
	    
	}
    
	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}

function publishblock( $cid, $publish, $option , $act ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}

    $pages_in_skip = 0;
	if ( $publish == 0 ) {
	    $cids= "0" ;
	    foreach ( $cid as $current_c_id ) {
	        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE  page_id = $current_c_id" );
	        if ( $database->loadResult() == 0 ) {// page not in skip actions
	            
	            $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE page_target = '".$current_c_id."'" );
	            if ( $database->loadResult() == 0 ) {// page not in skip actions
	                $cids .= ",$current_c_id";
	            }else {
	                $pages_in_skip++;
	            }
	        }else {  
	           $pages_in_skip++;
	        }
	    }
	}else{
        $cids = implode( ',', $cid );	    
	}
	
	$database->setQuery( "UPDATE #__ijoomla_surveys_pages SET published=($publish) WHERE page_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( count( $cid ) == 1 ) {
		$row = new mosijoomla_surveys_blocks( $database );
		$row->checkin( $cid[0] );
	}

	if ( $pages_in_skip > 0 ) {
	    if ( $pages_in_skip > 1 ) {
	        $err_add = "&errcode=4";
	    }else{ 
	        $err_add = "&errcode=3";
	    }
	}
	$mainframe->redirect( "index2.php?option=$option&act=$act"."$err_add" );
}
function orderblock( $page_id, $inc, $option , $act ) {
	global $mainframe;
	$database = &JFactory::getDBO();
	
	$database->setQuery( "SELECT ordering FROM #__ijoomla_surveys_pages WHERE page_id=$page_id" );
	$current_ordering = $database->loadResult();
	if ( $database->getErrorMsg() ) {
	    die( $database->getErrorMsg() );
	}
	$new_order[$page_id] = $current_ordering + $inc;
	$database->setQuery( "SELECT page_id FROM #__ijoomla_surveys_pages WHERE ordering=$new_order[$page_id]" );
	$page_target = $database->loadResult();
	if ( $database->getErrorMsg() ) {
	    die( $database->getErrorMsg() );
	}
	$new_order[$page_target] = $current_ordering;
	if ( $inc > 0 ) { // page moves towards survey end
	    $database->setQuery( "SELECT title FROM #__ijoomla_surveys_skip_logics WHERE page_id=$page_id AND page_target=$page_target" );
	    $skip_actions = $database->loadAssocList();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }	    
	    $pages_in_skip_actions = count( $skip_actions );
	    $new_order[$page_id] > $new_order[$page_target] ? $skip_order_broken=true : $skip_order_broken=false;
	}else { // page moves towards survey start
	    $database->setQuery( "SELECT title FROM #__ijoomla_surveys_skip_logics WHERE page_id=$page_target AND page_target=$page_id" );
	    $skip_actions = $database->loadAssocList();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }	    
	    $pages_in_skip_actions = count( $skip_actions );
	    $new_order[$page_id] < $new_order[$page_target] ? $skip_order_broken=true : $skip_order_broken=false;
	}
	if ( ($pages_in_skip_actions != 0) && $skip_order_broken ) {
	    $msg = "You can't change the order of the page because it's a part of a skip logic ".$skip_actions[0]["title"].", please first change or delete the skip logic";
	}else {
	    $row = new mosijoomla_surveys_blocks( $database );
	    $row->load( $page_id );
	    $row->move( $inc );
	}
	$mainframe->redirect( "index2.php?option=$option&act=$act", $msg );
}
/**
* Creates a new or edits and existing user record
* @param int The id of the user, 0 if a new entry
* @param string The current GET/POST option
*/
function editblock( $cid, $option , $act ) {
	global $mainframe, $mosConfig_offset;
	$database = &JFactory::getDBO();
	$my = &JFactory::getUser();
		
	$row = new mosijoomla_surveys_blocks($database );
	
	$row->load( $cid );
	if ( $cid == 0 ) {
		$row->show_title = 1;
		$row->published  = 1;
	}
	$pathA 		= JPATH_SITE .'/images/stories';
	
		$url = JURI::base();
		$url = substr($url, 0, -15);
	
	
	$pathL 		= $url .'/images/stories';
	$images 	= array();
	$folders 	= array();
	$folders[] 	= JHTML::_('select.option', '/' );
	
	JmosAdminMenus::ReadImages( $pathA, '/', $folders, $images );
	
	// list of folders in images/stories/
	$lists['folders'] 			= JmosAdminMenus::GetImageFolders( $folders, $pathL );
	
	// list of images in specfic folder in images/stories/
	$lists['imagefiles']		= JmosAdminMenus::GetImages( $images, $pathL );
	
	//iJoomla Al : 23/11/2006 : Edit Page Notice Bug
	//blocks (pages) don't have access levels, they are related to survey access level
	//$lists['access'] 			= JmosAdminMenus::Access( $row );
	
	if ( $row->images ) {
		$temp        = $row->images;
		$row->images = array(0=>$temp);
	}
	else {
		$row->images = array();
	}
	$lists['imagelist'] 		= JmosAdminMenus::GetSavedImages( $row, $pathL );
	if ( !$cid ) {
		$row->created_date = time();
		$row->ordering     = 'last';
		$row->start_date   = time();
		$row->end_date     = time()+10*365*24*60*60;
	}
	HTML_blocks::editblock( $row , $images, $lists, $option , $act );
}


/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function removeblock( $cid, $option , $act) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( !is_array( $cid ) || count( $cid ) < 1 ) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
    
    $pages_in_skip = 0;
    $cids          = "0";
    $counter_cid   = 0;
    foreach ( $cid as $current_c_id ) {
        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE page_id = '".$current_c_id."'" );
        if ( $database->loadResult() == 0 ) {// page not in skip actions
            $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE page_target = '".$current_c_id."'");
            if ( $database->loadResult() == 0 ) {// page not in skip actions
                $cids .= ",$current_c_id";
            }else {
                $pages_in_skip++;
            }
        }else {
            $pages_in_skip++;
        }
    }
		
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_pages WHERE page_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	
	$err_add = "";
	if ( $pages_in_skip > 0 ) {
	    if ( $pages_in_skip > 1 ) {
	        $err_add = "&errcode=13";
	    }else{ 
	        $err_add = "&errcode=12";
	    }
	}	
	$mainframe->redirect( "index2.php?option=$option&act=$act"."$err_add" );
}


/**
* Saves the record from an edit form submit
* @param string The current GET/POST option
*/
function saveblock( $option , $act , $task) {
	global $mainframe;
	$database = &JFactory::getDBO();
	$my = &JFactory::getUser();
	
	$row = new mosijoomla_surveys_blocks( $database );
	
	
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

    $err_add = "";
    $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE page_id = '".$row->page_id."'" );
    if ( !$database->loadResult() ) {// question not in skip actions

    }else {
        if ( $row->published != 1 ) {
            $row->published = 1;
            $err_add        = "&errcode=3";
        }        
    }
    
    if ( $err_add == "" ){ // check target page in skip logics
        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE page_target = '".$row->page_id."'" );
        if (!$database->loadResult() ) {// question not in skip actions
            
        }else {
            if ( $row->published != 1 ) {
                $row->published = 1;
                $err_add        = "&errcode=3";
            }
        }
    }
	$row->ordering      = intval( JArrayHelper::getValue($_POST,'ordering') );
	$row->description 	= str_replace( '<br>', '<br />', $_POST['editor1'] );	
		
	if ( !$row->store() ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->reorder();
	$_SESSION['selected_survey_id'] = $row->s_id;
	
	switch ( $task ) {
		case "apply":		    
			if ($row->page_id) {
			    $msg = _PAGE_APPLY;
			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&page_id=$row->page_id"."$err_add", $msg );
			}
			break;

		case "save":
		default:
			$msg = _PAGE_SAVE;
			$mainframe->redirect( "index2.php?option=$option&act=$act"."$err_add", $msg );
			break;
	}		
}


/**
* Cancels an edit operation
* @param string The current GET/POST option
*/
function cancelblock( $option , $act ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	$row = new mosijoomla_surveys_blocks( $database );
	$row->bind( $_POST );
	$row->checkin();
	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}

function cancelConfig( $option , $act ) {
	global $mainframe;
	$mainframe->redirect( "index2.php?option=$option" );
}
/**
* List the records
* @param string The current GET/POST option
*/
function showblock( $s_id, $option, $act ) {
	global $mainframe, $mainframe;
	$database = &JFactory::getDBO();

	$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_pages" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );
	if ( $s_id ) {
		$ex = " WHERE s_id=$s_id ";
	}else{
	    $ex="";
	}
	# Do the main database query
	$search  = addslashes(JArrayHelper::getValue($_POST,'search'));
	$sql_search='';
	if ( $search ) {
	    if ($ex!=""){
		    $sql_search = " AND LOWER( title ) LIKE '%$search%'";
	    }else{
	        $sql_search = " WHERE LOWER( title ) LIKE '%$search%'";
	    }
	}
		
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_pages $ex $sql_search ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
  
	HTML_blocks::showblock( $rows, $pageNav, $option , $act);
}

// END BLOCK

function copySurvey( $cid, $option , $act) {
	global $mainframe;
	$database = &JFactory::getDBO();
	$my = &JFactory::getUser();

	if ( count( $cid ) < 1 ) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._COPY."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );
	
	if ( $cid != '' ) {
	    $database->setQuery( "SELECT MAX(ordering) FROM #__ijoomla_surveys_surveys" );
	    $max_order_survey = $database->loadResult();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }	    
	    $database->setQuery( "SELECT MAX(ordering) FROM #__ijoomla_surveys_pages" );
	    $max_order_page = $database->loadResult();
	    if ( $database->getErrorMsg() ) {
	        die($database->getErrorMsg());
	    }
	    $database->setQuery( "SELECT MAX(ordering) FROM #__ijoomla_surveys_questions" );
	    $max_order_question = $database->loadResult();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }	    
	    $database->setQuery( "SELECT MAX(ordering) FROM #__ijoomla_surveys_skip_logics" );
	    $max_order_skip = $database->loadResult();	    
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }	    
	}
	foreach ( $cid as $current_s_id ) {
	    $max_order_survey++; // new surveys are placed last
	    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_surveys WHERE s_id='".intval($current_s_id)."'" );
        $surveyData=$database->loadAssocList();
	    if ( $database->getErrorMsg() ){
	        die( $database->getErrorMsg() );
	    }        
        $query_survey_columns = "";
        $query_survey_values  = "";
        $column_count         = 0;
        foreach ( $surveyData[0] as $key => $value ) {

            // escape '
            $value=addslashes($value);

            if ( $column_count != 0){ // we don't use the id for INSERT
                if ( $key == "title" ) {
                    $query_survey_columns .= "$key,";                                        
                    $test_survey_title     = "$value Copy";
                    
                    $database->setQuery( "SELECT title FROM #__ijoomla_surveys_surveys WHERE title LIKE '$test_survey_title%'" );
                    $titleLikeData = $database->loadAssocList();
                    if ( $database->getErrorMsg() ) {
                        die( $database->getErrorMsg() );
                    }
                    $title_copy_number = 0;
                    $copy_number       = "";
                    foreach ( $titleLikeData as $currentTitle ) {
                        if ( substr_count( $currentTitle["title"], 'Copy' ) == substr_count( $test_survey_title, 'Copy' ) ) {
                            $title_copy_number++;
                        }
                    }
                    if ( $title_copy_number )
                        $copy_number = " ".($title_copy_number+1);
                    $query_survey_values.="'$value Copy".$copy_number."',";
                    
                }elseif ( $key == "user_id" ) {
                    $query_survey_columns .= "$key,";
                    $query_survey_values  .= "'".$my->id."',";
                }elseif ( $key=="created_date" ) {
                    $query_survey_columns .= "$key,";
                    $query_survey_values  .= "'".mf_convert_to_timestamp(date('Y-m-d'),'onlydate')."',";
                }elseif ( $key=="ordering" ) {
                    $query_survey_columns .= "$key,";
                    $query_survey_values  .= "'".$max_order_survey."',";
                }else {  
                    $query_survey_columns .= "$key,";
                    $query_survey_values  .= "'$value',";
                }
            }else{
                $column_count++;
            }
        }
        $query_survey_columns = substr( $query_survey_columns, 0, strlen( $query_survey_columns )-1 );
        $query_survey_values  = substr( $query_survey_values, 0, strlen( $query_survey_values )-1 );
        $query = "INSERT INTO #__ijoomla_surveys_surveys ($query_survey_columns) VALUES ($query_survey_values)";
        
        $database->setQuery( $query );        
        $database->query();
        if ( $database->getErrorMsg() ) {
            die( $database->getErrorMsg() );
        }
                
        $new_survey_id = $database->insertid();
        
	    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_pages WHERE s_id='".intval($current_s_id)."' order by ordering" );
        $pageData = $database->loadAssocList();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }        
        foreach ( $pageData as $current_page ) { // make copies for every page in the survey
            $max_order_page++;
            $query_page_columns = "";
            $query_page_values  = "";
            $column_count       = 0;
            foreach ( $current_page as $key => $value ) {
                
                // escape '
                $value=addslashes($value);
                
                if ( $column_count ){ // we don't use the id for INSERT
                    if ( $key == "title" ){
                        $query_page_columns .= "$key,";
                        $test_page_title = "$value Copy";
                        
                        $database->setQuery( "SELECT title FROM #__ijoomla_surveys_pages WHERE title LIKE '$test_page_title%'" );
                        $titleLikeData = $database->loadAssocList();
                        if ( $database->getErrorMsg() ) {
                            die( $database->getErrorMsg() );
                        }
                        $title_copy_number = 0;
                        $copy_number       = "";
                        foreach ( $titleLikeData as $currentTitle ) {
                            if ( substr_count( $currentTitle["title"], 'Copy' ) == substr_count( $test_page_title, 'Copy' ) ) {
                                $title_copy_number++;
                            }
                        }
                        if ( $title_copy_number )
                        $copy_number        = " ".($title_copy_number+1);
                        $query_page_values .= "'$value Copy".$copy_number."',";
                    }elseif ( $key == "s_id" ) {
                        $query_page_columns .= "$key,";
                        $query_page_values  .= "'$new_survey_id',";
                    }elseif ( $key=="ordering" ) {
                        $query_page_columns .= "$key,";
                        $query_page_values  .= "'".$max_order_page."',";
                    }else {
                        $query_page_columns .= "$key,";
                        $query_page_values  .= "'$value',";
                    }
                }else{
                    $column_count++;
                }
            }
            $query_page_columns = substr( $query_page_columns, 0, strlen( $query_page_columns )-1 );
            $query_page_values  = substr( $query_page_values, 0, strlen( $query_page_values )-1 );
            $query = "INSERT INTO #__ijoomla_surveys_pages ($query_page_columns) VALUES ($query_page_values)";

            $database->setQuery( $query );
            $database->query();
            if ( $database->getErrorMsg() ) {
                die( $database->getErrorMsg() );
            }
            $new_page_id                           = $database->insertid();
            $array_page_id[$current_page["page_id"]] = $new_page_id;
        }

	    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions WHERE s_id='".intval($current_s_id)."' order by ordering" );
        $questionData = $database->loadAssocList();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }        
        foreach ( $questionData as $current_question ) {
            $max_order_question++;
            $query_question_columns = "";
            $query_question_values  = "";
            $column_count           = 0;
            foreach ( $current_question as $key => $value ) {
                
                // escape '
                $value=addslashes($value);

                if ( $column_count ){ // we don't use the id for INSERT
                    if ( $key == "title" ){
                                               
                        $query_question_columns .= "$key,";
                        $test_question_title     = "$value Copy";

                        $database->setQuery( "SELECT title FROM #__ijoomla_surveys_questions WHERE title LIKE '$test_question_title%'" );
                        $titleLikeData = $database->loadAssocList();
                        if ( $database->getErrorMsg() ) {
                            die( $database->getErrorMsg() );
                        }
                        $title_copy_number = 0;
                        $copy_number       = "";
                        foreach ( $titleLikeData as $currentTitle ) {
                            if ( substr_count( $currentTitle["title"], 'Copy' ) == substr_count( $test_question_title, 'Copy' ) ) {
                                $title_copy_number++;
                            }
                        }
                        if ( $title_copy_number ){
                            $copy_number             = " ".($title_copy_number+1);
                        }
                        $query_question_values  .= "'$value Copy".$copy_number."',";
                    }elseif ( $key == "s_id" ) {
                        $query_question_columns .= "$key,";
                        $query_question_values  .= "'$new_survey_id',";
                    }elseif ( $key == "page_id" ) {
                        $query_question_columns .= "$key,";
                        $query_question_values  .= "'".$array_page_id[$value]."',";
                    }elseif ( $key == "created_date" ) {
                        $query_question_columns .= "$key,";
                        $query_question_values  .= "'".mf_convert_to_timestamp(date('Y-m-d'),'onlydate')."',";
                    }elseif ( $key=="ordering" ) {
                        $query_question_columns .= "$key,";
                        $query_question_values  .= "'".$max_order_question."',";
                    }else {
                        $query_question_columns .= "$key,";
                        $query_question_values  .= "'$value',";
                    }
                }else {
                    $column_count++;
                }
            }
            
            $query_question_columns = substr( $query_question_columns, 0, strlen( $query_question_columns )-1 );
            $query_question_values  = substr( $query_question_values, 0, strlen( $query_question_values )-1 );
            $query = "INSERT INTO #__ijoomla_surveys_questions ($query_question_columns) VALUES ($query_question_values)";

            $database->setQuery( $query );
            $database->query();
            if ( $database->getErrorMsg() ) {
                die( $database->getErrorMsg() );
            }
            
            $array_q_id[$current_question["q_id"]] = $database->insertid();
            $database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id='".$current_question["q_id"]."'" );
            $answerData = $database->loadAssocList();
            if ( $database->getErrorMsg() ) {
                die( $database->getErrorMsg() );
            }
            foreach ( $answerData as $current_answer ) {
                $database->setQuery( "INSERT INTO #__ijoomla_surveys_answers (q_id,value) VALUES ('".$array_q_id[$current_question["q_id"]]."','".addslashes($current_answer["value"])."')" );
                $database->query();
                if ( $database->getErrorMsg() ){
                    die( $database->getErrorMsg() );
                }
                $array_answer_id[$current_answer["a_id"]] = $database->insertid();
            }
            $database->setQuery( "SELECT * FROM #__ijoomla_surveys_menu_heading WHERE q_id='".$current_question["q_id"]."'" );
            $menuData = $database->loadAssocList();
            if ( $database->getErrorMsg() ) {
                die( $database->getErrorMsg() );
            }
            foreach ( $menuData as $current_menu_h ) {
                $database->setQuery( "INSERT INTO #__ijoomla_surveys_menu_heading (q_id,value) VALUES ('".$array_q_id[$current_question["q_id"]]."','".$current_menu_h["value"]."')" );
                $database->query();
                if ( $database->getErrorMsg() ) {
                    die( $database->getErrorMsg() );
                }
                $array_menu_id[$current_menu_h["m_id"]]   = $database->insertid();
            }            
            $database->setQuery( "SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id='".$current_question["q_id"]."'" );
            $answerDataColumns = $database->loadAssocList();
            if ( $database->getErrorMsg() ) {
                die( $database->getErrorMsg() );
            }
            foreach ( $answerDataColumns as $current_answer_col ) {
                $database->setQuery( "INSERT INTO #__ijoomla_surveys_answer_columns (q_id,value,m_id) VALUES ('".$array_q_id[$current_question["q_id"]]."','".$current_answer_col["value"]."','".$array_menu_id[$current_answer_col["m_id"]]."')" );
                $database->query();
                if ( $database->getErrorMsg() ) {
                    die( $database->getErrorMsg() );
                }
            }            
        } 
        
	    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_skip_logics WHERE s_id='".intval($current_s_id)."'" );
        $skipData = $database->loadAssocList();
	    if ( $database->getErrorMsg() ) {
	        die( $database->getErrorMsg() );
	    }        
        foreach ( $skipData as $current_skip ) {
            $max_order_skip++;
            $query_skip_columns = "";
            $query_skip_values  = "";
            $column_count       = 0;
            foreach ( $current_skip as $key => $value ) {

                // escape '
                $value=addslashes($value);
                
                if ( $column_count ){ // we don't use the id for INSERT
                    if ( $key=="title" ) {
                        $query_skip_columns .= "$key,";
                        $test_skip_title     = "$value Copy";
                        
                        $database->setQuery( "SELECT title FROM #__ijoomla_surveys_skip_logics WHERE title LIKE '$test_skip_title%'" );
                        $titleLikeData = $database->loadAssocList();
                        if ( $database->getErrorMsg() ) {
                            die( $database->getErrorMsg() );
                        }
                        $title_copy_number =0;
                        $copy_number       ="";
                        foreach ( $titleLikeData as $currentTitle ) {
                            if ( substr_count( $currentTitle["title"], 'Copy' ) == substr_count( $test_skip_title, 'Copy') ) {
                                $title_copy_number++;
                            }
                        }
                        if ( $title_copy_number )
                        $copy_number         = " ".($title_copy_number+1);
                        $query_skip_values  .= "'$value Copy".$copy_number."',";                        
                    }elseif ( $key == "s_id" ) {
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'$new_survey_id',";
                    }elseif ( $key == "page_id" ) {
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'".$array_page_id[$value]."',";
                    }elseif ( $key == "page_target" ) {
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'".$array_page_id[$value]."',";
                    }elseif ( $key == "q_id" ) { 
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'".$array_q_id[$value]."',";
                    }elseif ( $key == "a_id" ) {
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'".$array_answer_id[$value]."',";
                    }elseif ( $key == "ordering" ) {
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'".$max_order_skip."',";
                    }else {
                        $query_skip_columns .= "$key,";
                        $query_skip_values  .= "'$value',";
                    }
                }else {
                    $column_count++;
                }
            }
            
            $query_skip_columns = substr( $query_skip_columns, 0, strlen( $query_skip_columns )-1 );
            $query_skip_values  = substr( $query_skip_values, 0, strlen( $query_skip_values )-1 );
            $query = "INSERT INTO #__ijoomla_surveys_skip_logics ($query_skip_columns) VALUES ($query_skip_values)";

            $database->setQuery( $query );
            $database->query();
            if ( $database->getErrorMsg() ) {
                die( $database->getErrorMsg() );
            }
        }
	}
	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}

function publishSurvey( $cid, $publish, $option , $act) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__ijoomla_surveys_surveys SET published=($publish) WHERE s_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( count( $cid ) == 1 ) {
		$row = new mosijoomla_surveys( $database );
		$row->checkin( $cid[0] );
	}

	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}

function force_publish_survey( $s_id, $publish, $option , $act, $task) {
	global $mainframe;
	$database = &JFactory::getDBO();

	$database->setQuery( "UPDATE #__ijoomla_surveys_surveys SET published=($publish) WHERE s_id IN ($s_id)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( count( $cid ) == 1 ) {
		$row = new mosijoomla_surveys( $database );
		$row->checkin( $s_id );
	}

	$mainframe->redirect( "index2.php?option=$option&act=$act&task=$task&s_id=$s_id" );
}

function publishresponse( $cid, $publish, $s_id, $option , $act) {
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );
	
	$database->setQuery( "UPDATE #__ijoomla_surveys_session SET published=($publish) WHERE session_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
	showresponses( $s_id, $option, $act);
}
/**
* Creates a new or edits and existing user record
* @param int The id of the user, 0 if a new entry
* @param string The current GET/POST option
*/
function editSurvey( $cid, $option , $act ) {
	global $mainframe, $mosConfig_live_site, $mosConfig_offset;
	$database = &JFactory::getDBO();
	$my = &JFactory::getUser();
	$row = new mosijoomla_surveys( $database );
	
	$row->load( $cid );
	$pathA 		= JPATH_SITE .'/images/stories';
		$url = JURI::base();
		$url = substr($url, 0, -15);
	$pathL 		= $url .'/images/stories';
	
	$images 	= array();
	$folders 	= array();
	$folders[] 	= JHTML::_('select.option', '/' );
	
	JmosAdminMenus::ReadImages( $pathA, '/', $folders, $images );
	
	$lists['folders'] 			= JmosAdminMenus::GetImageFolders( $folders, $pathL );
	
	$lists['imagefiles']		= JmosAdminMenus::GetImages( $images, $pathL );
		
	$lists['access'] 			= JmosAdminMenus::Access( $row );
	
	if ( $row->images ) {
		$temp        = $row->images;
		$row->images = array( 0=>$temp );
	}
	else {
		$row->images = array();
	}

	$lists['imagelist'] 		= JmosAdminMenus::GetSavedImages( $row, $pathL );	
	if ( !$cid ) {
		$row->created_date = time();		
		$row->start_date   = time();
		$row->show_result  = 0;
		$row->ordering     = 'last';
		$row->popup_show_freq = 7;
		$row->end_date     = time()+10*365*24*60*60;
	}

	HTML_surveys::editSurvey( $row , $images, $lists, $option , $act );
}


/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function removeSurvey( $cid, $option , $act ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( !is_array( $cid ) || count( $cid ) < 1 ) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
	
	$cids = implode( ',', $cid );
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_surveys WHERE s_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	
	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}
function removeresponses( $cid, $s_id, $option , $act) {
	$database = &JFactory::getDBO();
	
	if ( !is_array( $cid ) || count( $cid ) < 1 ) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
	$cids = implode( ',', $cid );
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_session WHERE session_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}	
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_result WHERE session_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}	
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_result_text WHERE session_id IN ($cids)" );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	$_REQUEST["task"] = 'responses';	
	showresponses( $s_id, $option, $act );
}

/**
* Saves the record from an edit form submit
* @param string The current GET/POST option
*/
function saveSurvey( $option , $act, $task, $s_id = 0 ) {
	global $mainframe;
	$user = &JFactory::getUser();
	
	$database = &JFactory::getDBO();
	$row = new mosijoomla_surveys( $database );
	
	$alias = "";
	
	if($_POST['alias'] == ""){
		$_POST['alias']=JFilterOutput::stringURLSafe($_POST['title']);
	}
	elseif($_POST['alias'] != ""){
		$_POST['alias']=JFilterOutput::stringURLSafe($_POST['alias']);
	}
	
	if ( !$row->bind( $_POST ) ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$row->created_date = mf_convert_to_timestamp( JArrayHelper::getValue($_POST,'created_date'),'onlydate' );
	$row->start_date   = mf_convert_to_timestamp( JArrayHelper::getValue($_POST,'start_date'),'onlydate' );
	$row->end_date     = mf_convert_to_timestamp( JArrayHelper::getValue($_POST,'end_date'),'onlydate' );
	$row->ordering     = intval( JArrayHelper::getValue($_POST,'ordering') );
	$row->description  = str_replace( '<br>', '<br />', $_POST['editor1'] );	
	$row->popup_content= str_replace( '<br>', '<br />', $_POST['editor2'] );
	$row->end_page_description = str_replace( '<br>', '<br />', $_POST['editor3'] );
	$row->user_id      = $user->id;
	
	
	if ( !$row->store() ) {
		echo $row->getError();
		die();
	}
	$row->reorder();
	
	switch ( $task ) {
		case "apply":		    
			if ($s_id) {
			    $msg = 'Changes to Survey saved';
			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&s_id=$s_id", $msg );
			}else{
			    $msg = 'Changes to Survey saved';
			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&s_id=$row->s_id", $msg );
			}
			break;

		case "save":
		default:
			$msg = 'Survey saved';
			$mainframe->redirect( "index2.php?option=$option&act=$act", $msg );
			break;
	}		
}

/**
* Cancels an edit operation
* @param string The current GET/POST option
*/
function cancelSurvey( $option , $act, $lasttask='', $lasts_id=0 ) {
	global $mainframe, $post_filter;
	$database = &JFactory::getDBO();

	$extra_redirect="";
	if ($lasttask=="showrespondent" && $lasts_id!=0){
	    $extra_redirect="&task=showrespondent&s_id=$lasts_id&filter=$post_filter";
	}elseif ($lasttask=="responses" && $lasts_id!=0){
	    $extra_redirect="&task=responses&s_id=$lasts_id";
	}elseif ($lasttask=="analyze" && $lasts_id!=0){
	    $extra_redirect="&task=analyze&s_id=$lasts_id&filter=$post_filter";
	}
	
	$row = new mosijoomla_surveys( $database );
	$row->bind( $_POST );
	$row->checkin();

	$mainframe->redirect( "index2.php?option=$option&act=$act".$extra_redirect );
}


/**
* List the records
* @param string The current GET/POST option
*/
function showSurvey($option,$act) {
	global $mainframe, $mainframe;
	$database = &JFactory::getDBO();
	
	$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	$database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_surveys" );

	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );

	# Do the main database query
	$search_filter  = addslashes(JArrayHelper::getValue($_POST,'search_filter'));
	$sql_search='';
	if ( $search_filter ) {
		    $sql_search = " WHERE LOWER( title ) LIKE '%$search_filter%'";
	}
	$database->setQuery( "SELECT s.*, g.name AS groupname FROM #__ijoomla_surveys_surveys AS s LEFT JOIN #__groups AS g ON g.id = s.access $sql_search ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" );
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}

	HTML_surveys::showSurvey( $rows, $pageNav, $option , $act );
}

function export_data($s_id,$option,$act,$lasttask){
    HTML_surveys::export_data($s_id,$option,$act,$lasttask);
}
function showresponses( $s_id, $option, $act) {
	global $mainframe, $mainframe;
	$database = &JFactory::getDBO();
 
	$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	if ( isset( $_POST['search'] ) && trim($_POST['search']) != "" && trim($_POST['search']) != "<br />" ) {	 
		$field   = JArrayHelper::getValue($_POST,'field');
		$keyword = JArrayHelper::getValue($_POST,'search');
		$database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_session as s,#__users as u WHERE s_id=$s_id AND (s.completed = '1' OR s.last_page_id <> '0') AND s.user_id=u.id AND s.$field LIKE '%$keyword%'" );
	}
	else {
	    $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_session WHERE s_id=$s_id AND (completed = '1' OR last_page_id <> '0')" );
	}	
	
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );
	
	if ( isset( $_POST['search'] ) && trim($_POST['search']) != "" && trim($_POST['search']) != "<br />" ) {
		$field   = JArrayHelper::getValue($_POST,'field');
		$keyword = JArrayHelper::getValue($_POST,'search');
		$database->setQuery( "SELECT * FROM #__ijoomla_surveys_session WHERE s_id=$s_id AND (completed = 1 and last_page_id = 0) ORDER BY played_time DESC LIMIT $pageNav->limitstart,$pageNav->limit" );	
	}
	else {
	    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_session WHERE s_id=$s_id AND (completed = 1 and last_page_id = 0) ORDER BY played_time DESC LIMIT $pageNav->limitstart,$pageNav->limit" );
	}
	
	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}
  
	HTML_surveys::showresponses( $rows, $s_id, $pageNav, $option ,$act );
}

function showresult( $cid, $show_result, $option , $act) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $show_result ? 'ShowResult' : 'UnShowResult';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}
	$cids = implode( ',', $cid );
	$database->setQuery( "UPDATE #__ijoomla_surveys_surveys SET show_result=($show_result) WHERE s_id IN ($cids)");
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( count( $cid ) == 1 ) {
		$row = new mosijoomla_surveys( $database );
		$row->checkin( $cid[0] );
	}

	$mainframe->redirect( "index2.php?option=$option&act=$act" );
}
function showtitle( $cid, $show_title, $option , $act, $s_id = 0 ) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $show_title ? 'ShowTitle' : 'UnShowTitle';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__ijoomla_surveys_pages SET show_title=($show_title) WHERE page_id IN ($cids)");
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosijoomla_surveys( $database );
		$row->checkin( $cid[0] );
	}

	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id" );
}


 function analyze( $s_id, $q_id = 0, $a_id = 0, $ac_id = 0, $m_id = 0, $filter = '', $filter_text = "", $option, $act, $showrespondent = 'no' , $lasttask='') {
	$database = &JFactory::getDBO();
	if ( $showrespondent == 'yes' ) 
		$publish = '';
	else 
		$publish = ' AND s.published=1';
	
	//$sql = "SELECT s.session_id FROM  #__ijoomla_surveys_session as s, #__ijoomla_surveys_result as r WHERE s.s_id=$s_id ";
	$sql = "SELECT s.session_id FROM  #__ijoomla_surveys_session as s WHERE s.s_id=$s_id ";
	
	$temp_text = "";
	if ( $filter ) 
		$sql .=" AND s.session_id IN ($filter)";
	if ( $q_id ) {
	
		$sql .="  AND r.session_id=s.session_id AND r.q_id=$q_id ";
		$database->setQuery( "SELECT title FROM #__ijoomla_surveys_questions WHERE q_id=$q_id");
		$q_title = $database->loadResult();	
		$temp_text .= "* In <b>". $q_title.'</b> ';
	}
	if ( $a_id ) {
		//$sql2 = "SELECT s.session_id FROM #__ijoomla_surveys_result as r WHERE r.s_id=$s_id ";
		//$database->setQuery( $sql2 );
		
		//$sql .="  AND r.session_id=s.session_id AND r.a_id=$a_id ";
		$sql = "SELECT s.session_id FROM  #__ijoomla_surveys_session as s, #__ijoomla_surveys_result as r WHERE s.s_id=$s_id AND r.session_id=s.session_id AND r.a_id=$a_id ";
		$database->setQuery( "SELECT value FROM #__ijoomla_surveys_answers WHERE a_id=$a_id" );
		$answer_title = $database->loadResult();	
		$temp_text   .= _ANSWER."<b> ".$answer_title."</b> ";
	}
	if ( $ac_id ) {
		//$sql         .="  AND r.session_id=s.session_id AND r.ac_id=$ac_id ";
		$sql = "SELECT s.session_id FROM  #__ijoomla_surveys_session as s, #__ijoomla_surveys_result as r WHERE s.s_id=$s_id AND r.session_id=s.session_id AND r.ac_id=$ac_id";
		$database->setQuery( "SELECT value FROM #__ijoomla_surveys_answer_columns WHERE ac_id=$ac_id" );
		$column_title = $database->loadResult();	
		$temp_text   .= _COLUMN.":<b> ".$column_title."</b> ";
	}
	if ( $m_id ) {
		///$sql       .= "  AND r.session_id=s.session_id AND r.m_id=$m_id";
		$sql = "SELECT s.session_id FROM  #__ijoomla_surveys_session as s, #__ijoomla_surveys_result as r WHERE s.s_id=$s_id AND r.session_id=s.session_id AND r.m_id=$m_id";
		$database->setQuery( "SELECT value FROM #__ijoomla_surveys_menu_heading WHERE m_id=$m_id" );
		$menu_title = $database->loadResult();	
		$temp_text .= "Menu:<b> ".$menu_title."</b> ";
	}
	$sql     .= " $publish GROUP BY s.session_id";
	
	
	
	
	$database->setQuery( $sql );
	

	$sessions = $database->loadResultArray();	
	if ($database->getErrorMsg()) 
	     die($database->getErrorMsg());	    	
	
	$filter_machine='';
		
	$filter_text .= $temp_text==""?"":'<br />'.$temp_text;
	
	foreach($sessions as $session_id){
	    $filter_machine.=",$session_id";	
	}
	if ($filter_machine==''){
	    $filter_machine=0;
	}
	elseif ($filter_machine[0]==',') {
	    $filter_machine[0]=' ';
	}
	
	HTML_surveys::analyze($s_id,$filter_machine,$filter_text,$option,$act, $lasttask);
}
// QUESTION ...........................

function orderquestion( $q_id, $inc, $option ,$act,$s_id=0,$page_id=0) {
	global $mainframe;
	$database = &JFactory::getDBO();

	$row = new mosijoomla_questions( $database );
	$row->load( $q_id );
	$row->move( $inc );
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id" );
}

function requiredquestion($cid,$required,$option,$act,$s_id=0,$page_id=0) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if (count( $cid ) < 1) {
		$action = $required ? 'Required' : 'Unrequired';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}
    
    $questions_in_skip=0;
	if ($required==0){
	    $cids="0";
	    foreach ($cid as $current_c_id)    {
	        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE q_id = $current_c_id");
	        if (0==$database->loadResult()) {// question not in skip actions
	           $cids.=",$current_c_id";
	        }else {  
	           $questions_in_skip++;
	        }
	    }
	}else{
        $cids = implode( ',', $cid );	    
	}
		
	$database->setQuery("UPDATE #__ijoomla_surveys_questions SET required=($required) WHERE q_id IN ($cids)");
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosijoomla_questions( $database );
		$row->checkin( $cid[0] );
	}

	if ($questions_in_skip>0){
	    if ($questions_in_skip>1){
	        $err_add="&errcode=6";
	    }else{ 
	        $err_add="&errcode=5";
	    }
	}
		
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id"."$err_add" );
}
function publishquestion( $cid, $publish, $option ,$act,$s_id=0,$page_id=0) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if (count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('"._SELECT_ITEM_TO." ".$action."'); window.history.go(-1);</script>\n";
		exit;
	}
    
    $questions_in_skip=0;
	if ($publish==0){
	    $cids="0";
	    foreach ($cid as $current_c_id)    {
	        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE q_id = $current_c_id");
	        if (0==$database->loadResult()) {// question not in skip actions
	           $cids.=",$current_c_id";
	        }else {  
	           $questions_in_skip++;
	        }
	    }
	}else{
        $cids = implode( ',', $cid );	    
	}
	
	$database->setQuery( "UPDATE #__ijoomla_surveys_questions SET published=($publish) WHERE q_id IN ($cids)");
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosijoomla_questions( $database );
		$row->checkin( $cid[0] );
	}
	
	if ($questions_in_skip>0){
	    if ($questions_in_skip>1){
	        $err_add="&errcode=2";
	    }else{ 
	        $err_add="&errcode=1";
	    }
	}
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id"."$err_add" );
}

/**
* Creates a new or edits and existing user record
* @param int The id of the user, 0 if a new entry
* @param string The current GET/POST option
*/


function editquestion( $cid, $option , $act) {
	$database = &JFactory::getDBO();
	$row = new mosijoomla_questions( $database );
	$row->load( $cid );
  	if ($cid>0) {
		$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$cid ORDER BY a_id ASC");
		$answer = $database->loadObjectList();
		if ($database->getErrorNum()) {
			echo $database->stderr();
			return false;
		}
		if ($row->orientation=='matrix' && $row->type!='menu') {
			$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=$cid ORDER BY ac_id ASC");
			$column = $database->loadObjectList();
			if ($database->getErrorNum()) {
				echo $database->stderr();
				return false;
			}
		}
		else $column=array();
	}
	else {
		$row->created_date = time();
		$row->start_date   = time();
		$row->show_results = 1;
		$row->ordering     = 'last';
		$row->end_date     = time()+10*365*24*60*60;
	}
	
	HTML_questions::editquestion( $row,$answer,$column, $option ,$act);
}


/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function removequestion( $cid, $option ,$act,$s_id=0,$page_id=0) {
	global $mainframe;
	$database = &JFactory::getDBO();

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('"._SELECT_ITEM_TO." "._DELETE."'); window.history.go(-1);</script>\n";
		exit;
	}
    
    $questions_in_skip=0;
    $cids="0";
    $counter_cid=0;
    foreach ($cid as $current_c_id)    {
        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE q_id = $current_c_id");
        if (0==$database->loadResult()) {// question not in skip actions
            $cids.=",$current_c_id";
        }else {
            $questions_in_skip++;
        }
    }
	
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_questions WHERE q_id IN ($cids)" );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_answers WHERE q_id IN ($cids)" );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_answer_columns WHERE q_id IN ($cids)" );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_result WHERE q_id IN ($cids)" );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	$database->setQuery( "DELETE FROM #__ijoomla_surveys_result_text WHERE q_id IN ($cids)" );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	
	if ($questions_in_skip>0){
	    if ($questions_in_skip>1){
	        $err_add="&errcode=10";
	    }else{ 
	        $err_add="&errcode=9";
	    }
	}
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id".$err_add );
}


/**
* Saves the record from an edit form submit
* @param string The current GET/POST option
*/
function savequestion( $option ,$act,$reload='',$s_id=0,$page_id=0, $task='save') {
	global $mainframe, $questions_in_skip;
	$database = &JFactory::getDBO();
		
	$row        = new mosijoomla_questions( $database );
	$post_a_id  = JArrayHelper::getValue($_POST,"a_id");
	$post_ac_id = JArrayHelper::getValue($_POST,"ac_id");
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	if (isset($_POST['random_a'])) {
	    $row->random_a=1;
	}
	else {
	    $row->random_a=0;
	}
	if (isset($_POST['random_c'])) {
	    $row->random_c=1;
	}
	else {
	    $row->random_c=0;	
	}
	
	if ((isset($_POST['minvalue'])&&(intval(trim($_POST['minvalue']))!=''))||(isset($_POST['maxvalue'])&&(intval(trim($_POST['maxvalue']))!=''))){
	   $row->bounded=1;
	   $row->minvalue=intval($_POST['minvalue']);
	   $row->maxvalue=intval($_POST['maxvalue']);
	}else{
	   $row->bounded=0;
	}
	$row->created_date=mf_convert_to_timestamp(JArrayHelper::getValue($_POST,'created_date'),'onlydate');
	$row->start_date=mf_convert_to_timestamp(JArrayHelper::getValue($_POST,'start_date'),'onlydate');
	$row->end_date=mf_convert_to_timestamp(JArrayHelper::getValue($_POST,'end_date'),'onlydate');
	$row->description 	= str_replace( '<br>', '<br />', $row->description );	
	
	if ($reload=='no') {
        
        $err_add="";
        $database->setQuery( "SELECT COUNT(*) FROM #__ijoomla_surveys_skip_logics WHERE q_id = '".$row->q_id."'");
        if (0==$database->loadResult()) {// question not in skip actions
        }else {
            $questions_in_skip++;
            if ($row->published!=1){
                $row->published=1;
                $err_add="&errcode=1";
            }
            if ($row->required!=1){
                $row->required=1;
                if ($err_add==""){
                    $err_add="&errcode=5";
                }
                else {
                    $err_add="&errcode=11";
                }
            }        
            
        }
    	$_SESSION['selected_survey_id']=$row->s_id;
        $_SESSION['selected_page_id']=$row->page_id;
    
    	if (!$row->store()) {
    		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
    		exit();
    	}
    	if ($row->q_id) {
    	    $q_id=$row->q_id;
    	}
    	else {
    	    $q_id=$database->insertid();
    	}
    	
    	$row->reorder();
    	if ($row->q_id>0) { // EDIT // DELETE ANSWERS
        	// INSERT ANSWER 
        	$answers=split("\n",JArrayHelper::getValue($_POST,'answer'));
        	$max=count($answers)>count($post_a_id)?count($answers):count($post_a_id);
        	for ($i=0;$i<$max;$i++) {
        		if (addslashes(trim($answers[$i]))!='') {
        			// OLD ROW
        			if (isset($post_a_id[$i])) {
        			    $database->setQuery("UPDATE #__ijoomla_surveys_answers 
        							 SET value = '".addslashes(trim($answers[$i]))."' 
        							 WHERE a_id = '".intval($post_a_id[$i])."' LIMIT 1");
        				$database->query() ;
        				if($database->getErrorMsg()!=""){
        				   die($database->getErrorMsg()); 
        				}				   
        			}
        			// NEW ROW
        			else{
        			    $database->setQuery("INSERT INTO #__ijoomla_surveys_answers(a_id,q_id,value)
        						     VALUES ('', '".$row->q_id."', '".addslashes(trim($answers[$i]))."')");
        				$database->query();
        				if($database->getErrorMsg()!=""){
        				   die($database->getErrorMsg());
        				}
        			}
        		}
        		else {
        			if (isset($post_a_id[$i])) 
        				{$database->setQuery("DELETE FROM #__ijoomla_surveys_answers 
        							 WHERE a_id=".intval($post_a_id[$i])." LIMIT 1");
        				$database->query();
        				if($database->getErrorMsg()){
        				   die($database->getErrorMsg());
        				}
        		    }
        				   
        		}	
        	}
        	
        	// INSERT COLUMN	
        	if ($row->orientation=='matrix') {
        		
        		if ($row->type!='menu') { // NORMAL MATRIX
        			$columns=split("\n",JArrayHelper::getValue($_POST,'column'));
        			$max=count($columns)>count($post_ac_id)?count($columns):count($post_ac_id);
        			for ($i=0;$i<$max;$i++) {
        				if (addslashes(trim($columns[$i]))!='') {
        					// OLD COLUMN
        					if (isset($_POST["ac_id"][$i]) && intval($_POST["ac_id"][$i])>0) 
        						{$database->setQuery("UPDATE #__ijoomla_surveys_answer_columns 
        									 SET value = '".addslashes(trim($columns[$i]))."' 
        									 WHERE ac_id = '".intval($post_ac_id[$i])."' LIMIT 1");
        						$database->query();
        						if ($database->getErrorMsg()){
        						    die($database->getErrorMsg());
        						}
        						}						
        					// NEW COLUMN
        					else {
        						$database->setQuery("INSERT INTO #__ijoomla_surveys_answer_columns(ac_id,q_id,value,m_id)
        									 VALUES ('', '$row->q_id', '".addslashes(trim($columns[$i]))."', '0')");
        						$database->query();
        						if ($database->getErrorMsg()){
        						    die($database->getErrorMsg());
        						}
        					}
        				}
        				else {
        					if (intval($post_ac_id[$i])>0) 
        					    {				
        						$database->setQuery("DELETE FROM #__ijoomla_surveys_answer_columns 
        									 WHERE ac_id=".intval($post_ac_id[$i]));
        						$database->query();
        						if ($database->getErrorMsg()){
        						    die($database->getErrorMsg());
        						}
        						}
        				}
        			}
        		}
        		// MATRIX MENU
        		else {
        			
        			$t=0;
        			$post_menuheading=JArrayHelper::getValue($_POST,'menu_heading');
        			$post_numsmenuheading=JArrayHelper::getValue($_POST,'nums_menu_heading');
                   
        			foreach ($post_menuheading as $m_id => $value) {
        						$t++;
        						if (isset($_POST["cid"][$m_id]) && count($_POST["cid"][$m_id])>0) { // UPDATE MENU
        						    
            						if ($t>intval($post_numsmenuheading)) { // out of order . Delete old data
            							$database->setQuery("DELETE FROM #__ijoomla_surveys_menu_heading WHERE m_id=$m_id");
            							$database->query();
            							if ($database->getErrorMsg()){
            							    die($database->getErrorMsg());
            							}
            							$database->setQuery("DELETE FROM #__ijoomla_surveys_answer_columns WHERE m_id=$m_id");
            							$database->query();
            							if ($database->getErrorMsg()){
            							    die($database->getErrorMsg());
            							}
            							
                						if (isset($_POST['m_choices'][$m_id]) && trim($_POST['m_choices'][$m_id])=='' || addslashes(trim($value))=='') {// DELETE MENU
                							$database->setQuery("DELETE FROM #__ijoomla_surveys_menu_heading WHERE m_id=$m_id");
                							$database->query();
                							if ($database->getErrorMsg()){
                							    die($database->getErrorMsg());
                							}
                							$database->setQuery("DELETE FROM #__ijoomla_surveys_answer_columns WHERE m_id=$m_id");
                							$database->query();
                							if ($database->getErrorMsg()){
                							    die($database->getErrorMsg());
                							}
                						}        							
            						} else{
               						        						    
            								if (isset($_POST["m_choices"][$m_id]) && trim($_POST["m_choices"][$m_id])!='' && addslashes(trim($value))!='') {
            										// HAS VALUE 
            										$choices=split("\n",trim($_POST['m_choices'][$m_id]));
            										$database->setQuery("UPDATE #__ijoomla_surveys_menu_heading SET value = '".$value."' WHERE m_id = '$m_id' LIMIT 1");
            										$database->query();
            										if ($database->getErrorMsg()){
            										    die($database->getErrorMsg());
            										}
            										$max=count($choices)>count($_POST["cid"][$m_id])?count($choices):count($_POST["cid"][$m_id]);
            										for ($i=0;$i<$max;$i++) {
            											if (isset($_POST["cid"][$m_id][$i]) && intval($_POST["cid"][$m_id][$i])!=0) { // UPDATE CHOICES
            												if (trim($choices[$i])!='') {
            													$database->setQuery("UPDATE #__ijoomla_surveys_answer_columns SET m_id = '$m_id',value='".addslashes(trim($choices[$i]))."' WHERE ac_id = '".intval($_POST["cid"][$m_id][$i])."' LIMIT 1");
            													$database->query();
            													if ($database->getErrorMsg()){
            													    die($database->getErrorMsg());
            													}
            												}
            												else { // EMPTY ROW
            													$database->setQuery("DELETE FROM #__ijoomla_surveys_answer_columns WHERE ac_id=".intval($_POST["cid"][$m_id][$i]));
            													$database->query();
            													if ($database->getErrorMsg()){
            													    die($database->getErrorMsg());
            													}
            												}
            											}
            											else { // NEW CHOICES
            												  $database->setQuery("INSERT INTO #__ijoomla_surveys_answer_columns(ac_id,q_id,value,m_id) VALUES ('', '$q_id', '".addslashes(trim($choices[$i]))."', '$m_id')");
            												  $database->query();
            												  if ($database->getErrorMsg()){
            													    die($database->getErrorMsg());
            												  }
            											}
            									  }
            								}
            						  }
        						}
        											
        						else {  // NEW MENU
        								if (addslashes(trim($value))!='' && isset($_POST['m_choices'][$m_id]) && trim($_POST['m_choices'][$m_id])!='') {
        									$database->setQuery("INSERT INTO #__ijoomla_surveys_menu_heading ( m_id , q_id , value )
        													 VALUES ('', '$q_id', '".$value."')");
        									$database->query();
        									if ($database->getErrorMsg()){
        									    die($database->getErrorMsg());
        									}
        							        $new_m_id=$database->insertid();
        									$choices=split("\n",trim($_POST['m_choices'][$m_id]));
        										for ($j=0;$j<count($choices);$j++) {
        											$database->setQuery("INSERT INTO #__ijoomla_surveys_answer_columns(ac_id,q_id,value,m_id)
        														 VALUES ('', '$q_id', '".addslashes(trim($choices[$j]))."', '$new_m_id')");
        											$database->query();
        											if ($database->getErrorMsg()){
        											    die($database->getErrorMsg());
        											}
        									  }
        								}
        						}	
        			}		
        		}
        	}
        	
            	switch ( $task ) {
            		case "apply":		    
            			if ($row->q_id) {
            			    $msg = _QUESTION_APPLY;
            			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&s_id=$s_id&page_id=$page_id"."$err_add"."&q_id=$row->q_id", $msg );
            			}
            			break;
            
            		case "save":
            		default:
            			$msg = _QUESTION_SAVE;
            			$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id"."$err_add",$msg );
            			break;
            	}        	
        	    
        		//if ($reload=='no') $mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id"."$err_add" );
    	}	
    	else { // NEW QUESTION
    		if ($row->orientation!='matrix' && $row->orientation!='open') {
    			$answers=split("\n",JArrayHelper::getValue($_POST,'answer'));
    			foreach ($answers as $key => $value) {
    				$database->setQuery("INSERT INTO #__ijoomla_surveys_answers(a_id,q_id,value)
    							 VALUES ('', '".$q_id."', '".addslashes(trim($value))."')");
    				$database->query();
    				if ($database->getErrorMsg()){
    				    die($database->getErrorMsg());
    				}
    			}
    		}
    		elseif ($row->orientation=='matrix') { // MATRIX
    			if ($row->type!='menu') {
    				$answers=split("\n",JArrayHelper::getValue($_POST,'answer'));
    				foreach ($answers as $key => $value) {
    					$database->setQuery("INSERT INTO #__ijoomla_surveys_answers(a_id,q_id,value)
    								 VALUES ('', '".$q_id."', '".addslashes(trim($value))."')");
    					$database->query();
    					if ($database->getErrorMsg()){
    					    die($database->getErrorMsg());
    					}
    				}
    				$columns=split("\n",JArrayHelper::getValue($_POST,'column'));
    				foreach ($columns as $key => $value) {
    					$database->setQuery("INSERT INTO #__ijoomla_surveys_answer_columns(ac_id,q_id,value,m_id)
    								 VALUES ('', '$q_id', '$value', '0')");
    					$database->query();
    					if ($database->getErrorMsg()){
    					    die($database->getErrorMsg());
    					}
    				}
    			}
    			else { // MATRIX MENU
    				$answers=split("\n",JArrayHelper::getValue($_POST,'answer'));
    				foreach ($answers as $key => $value) {
    					$database->setQuery("INSERT INTO #__ijoomla_surveys_answers(a_id,q_id,value)
    								 VALUES ('', '".$q_id."', '".addslashes(trim($value))."')");
    					$database->query();
    					if ($database->getErrorMsg()){
    					    die($database->getErrorMsg());
    					}
    				}
    				for ($i=0;$i<count(JArrayHelper::getValue($_POST,'menu_heading'));$i++) {
    					if (isset($_POST['menu_heading'][$i]) && $_POST['menu_heading'][$i]!='' && isset($_POST['m_choices'][$i]) && $_POST['m_choices'][$i]!='') {						
    						$database->setQuery("INSERT INTO #__ijoomla_surveys_menu_heading(m_id,q_id,value)
    									 VALUES ('', '$q_id', '".addslashes(trim($_POST['menu_heading'][$i]))."')");
    						$database->query();
    						if ($database->getErrorMsg()){
    						    die($database->getErrorMsg());
    						}
    						$m_id=$database->insertid();
    						$choices=split("\n",$_POST['m_choices'][$i]);
    						foreach ($choices as $key => $value) {
    							$database->setQuery("INSERT INTO #__ijoomla_surveys_answer_columns(ac_id,q_id,value,m_id)
    										 VALUES ('', '$q_id', '$value', '$m_id')");
    							$database->query();
    							if ($database->getErrorMsg()){
    							    die($database->getErrorMsg());
    							}			 
    						}
    					}
    				}
    			}
    		}
    	}
    	           	
    	switch ( $task ) {
    		case "apply":		    
    			if ($row->q_id) {
    			    $msg = _QUESTION_APPLY;
    			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&s_id=$s_id&page_id=$page_id"."$err_add"."&q_id=$row->q_id", $msg );
    			}else{
    			    $msg = _QUESTION_APPLY;
    			    $mainframe->redirect( "index2.php?option=$option&act=$act&task=continue_editing&s_id=$s_id&page_id=$page_id"."$err_add"."&q_id=$row->q_id", $msg );
    			}
    			break;
    
    		case "save":
    		default:
    			$msg = _QUESTION_SAVE;
    			$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id"."$err_add",$msg );
    			break;
    	}    	
	}	
	else {
		if ($row->q_id) {
			$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$row->q_id ORDER BY a_id ASC");
			$answer = $database->loadObjectList();
			if ($database->getErrorNum()) {
				echo $database->stderr();
				return false;
			}
			if ($row->orientation=='matrix' && $row->type!='menu') {
				$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=$row->q_id ORDER BY ac_id ASC");
				$column = $database->loadObjectList();
				if ($database->getErrorNum()) {
					echo $database->stderr();
					return false;
				}
			}
			else $column=array();
		}
		else {
			$answer=array();
			$column=array();
		}
		HTML_questions::editquestion( $row,$answer,$column, $option ,$act);
	}
}


/**
* Cancels an edit operation
* @param string The current GET/POST option
*/
function cancelquestion( $option ,$act,$s_id=0,$page_id=0) {
	global $mainframe;
	$database = &JFactory::getDBO();

	$row = new mosijoomla_questions( $database );
	$row->bind( $_POST );
	$row->checkin();
	$mainframe->redirect( "index2.php?option=$option&act=$act&s_id=$s_id&page_id=$page_id" );
}


/**
* List the records
* @param string The current GET/POST option
*/
function showquestion($s_id,$page_id,$option,$act) {
	global $mainframe, $mainframe;
	$database = &JFactory::getDBO();

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	
	if ($s_id>0) {
	    $database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_questions WHERE s_id=$s_id" );
	}
	else  {
	    $database->setQuery( "SELECT count(*) FROM #__ijoomla_surveys_questions" );
	}
	
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
	$pageNav = new JPaginationNew( $total, $limitstart, $limit );

	# Do the main database query
	$search  = addslashes(JArrayHelper::getValue($_POST,'search'));
	$sql_search='';
	if ( $search ) {
		$sql_search = " AND LOWER( title ) LIKE '%$search%'";
	}
	if ($s_id>0) {
		if ($page_id) {
			$database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions WHERE s_id=$s_id AND page_id=$page_id $sql_search ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" );
		}
		else { 
		    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions WHERE s_id=$s_id  $sql_search ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" );
		}
    }elseif ($s_id==0) {
		if ($page_id) {
			$database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions WHERE page_id=$page_id $sql_search ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" );
		}
    	elseif ($sql_search) {
    		    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions WHERE LOWER( title ) LIKE '%$search%'  ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" ); 
    		}
    		else {
    		    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" ); 
    		}
    }
	elseif ($sql_search) {
		    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions WHERE LOWER( title ) LIKE '%$search%'  ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" ); 
		}
		else {
		    $database->setQuery( "SELECT * FROM #__ijoomla_surveys_questions ORDER BY ordering ASC LIMIT $pageNav->limitstart,$pageNav->limit" ); 
		}
		
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}
  
	HTML_questions::showquestion( $rows, $pageNav, $option ,$act);
}
function convert_to_time($time) {
	return date("m:d:Y:h:i",$time);
}
function mf_convert_to_timestamp($timedatestring, $filter = 'dateandtime') {

	$datestring = substr($timedatestring,0,10);
	$datestringArray = explode('-',$datestring);

	$timestring = @substr($timedatestring,-8,8);
	$timestringArray = explode(':',$timestring);
	
	if ( $filter == 'dateonly' ) {
		return mktime(0,0,0,$datestringArray[1],$datestringArray[2],$datestringArray[0]);
	} else if ( $filter == 'timeonly' ) {
		return mktime($timestringArray[0],$timestringArray[1],$timestringArray[2],01,01,1970);
	} else {
		return mktime($timestringArray[0],$timestringArray[1],$timestringArray[2],$datestringArray[1],$datestringArray[2],$datestringArray[0]);
	}
}
function showConfig($option,$act) {
	HTML_surveys_config::show_config($option,$act);	
}
function saveConfig($option,$act) {
	global $mainframe;
	$database = &JFactory::getDBO();
	$config=JPATH_SITE."/administrator/components/com_surveys/surveys_config.php";
	@chmod($config,0777);
	$fp=@fopen($config,"w");
	fwrite($fp,'<?php'."\n");
	
	foreach (JArrayHelper::getValue($_POST,'css') as $key => $value) {
		fwrite($fp,'$css_'.$key.'="'.addslashes($value).'";'."\n");
	}
	
	fwrite($fp,'?>'."\n");
	fclose($fp);
	
	
	// UPDATE CSS
	$css=JPATH_SITE."/components/com_surveys/survey.css";
	@chmod($css,0777);
	$fp=@fopen($css,"w");
	fwrite($fp,addslashes(JArrayHelper::getValue($_POST,'css_file')));
	fclose($fp);
	
	// UPDATE LANGUAGE
	$lang=JPATH_SITE."/administrator/components/com_surveys/language/english.surveys.php";
	@chmod($lang,0777);
	
	$fp=@fopen($lang,"w");
	
	
	set_magic_quotes_runtime(0);
	echo $_POST['lang_file'];
	fwrite($fp,stripslashes($_POST['lang_file']));
	fclose($fp);
	
	//UPDATE EMAIL SETTINGS
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_email_settings"); 
	$emailResult=$database->loadResult();
	if ($database->getErrorMsg()){
	    die($database->getErrorMsg());
	}
	if($emailResult!=null){
		// OLD COLUMN
			$database->setQuery("UPDATE #__ijoomla_surveys_email_settings SET
										email_settings_activ = '".JArrayHelper::getValue($_POST,"email_activ")."',
										email_settings_to =  '".JArrayHelper::getValue($_POST,"email_to")."',
										email_settings_from = '".JArrayHelper::getValue($_POST,"email_from")."',
										email_settings_subject = '".JArrayHelper::getValue($_POST,"email_subject")."',
										email_settings_content = '".$_POST["editor1"]."'");
			$database->query();
			if ($database->getErrorNum()) {
			    echo $database->stderr();
			    return false;
			}
	}else{
		// NEW COLUMN
			$database->setQuery("INSERT INTO 
									#__ijoomla_surveys_email_settings(
										email_settings_id,
										email_settings_activ,
										email_settings_to,
										email_settings_from,
										email_settings_subject,
										email_settings_content) 
								VALUES ('',
										'".JArrayHelper::getValue($_POST,"email_activ")."',
										'".JArrayHelper::getValue($_POST,"email_to")."',										
										'".JArrayHelper::getValue($_POST,"email_from")."',
										'".JArrayHelper::getValue($_POST,"email_subject")."',
										'".$_POST["email_content"]."')");
			$database->query();
			if ($database->getErrorNum()) {
			    echo $database->stderr();
			    return false;
			}			
	}
	//UPDATE GENERAL SETTINGS
	$database->setQuery( "SELECT general_option FROM #__ijoomla_surveys_config");
	$generalResult=$database->loadResult();
	if ($database->getErrorMsg()){
	    die($database->getErrorMsg());
	}
	if($generalResult!=null){
	    $database->setQuery("UPDATE #__ijoomla_surveys_config SET general_option='".JArrayHelper::getValue($_POST,"general_value")."', general_date='".JArrayHelper::getValue($_POST,"general_date")."'");
	    $database->query();
	    	
	    if ($database->getErrorNum()) {
	        echo $database->stderr();
	        return false;
	    }
	}else{
	    $database->setQuery("INSERT INTO #__ijoomla_surveys_config (general_option) VALUES ('".JArrayHelper::getValue($_POST,"general_value")."')");
	    $database->query();
	    if ($database->getErrorNum()) {
	        echo $database->stderr();
	        return false;
	    }	    
	}
			
	$mainframe->redirect( "index2.php?option=$option&act=$act" ,"Your settings have been saved" );	
}
function showabout() {
    
    require_once( JPATH_SITE . '/includes/domit/xml_domit_lite_include.php' );    
    
    $components_number = 1;
    $components[1]     = ".iJoomla Surveys";

    $moduleBaseDir	   = JPath::clean( JPath::clean( JPATH_SITE ) . "/administrator/components/com_surveys" ); 
    // xml file for module
    $xmlfilecomp       = $moduleBaseDir. "/surveys.xml";    
    $status[1]         = _NOT_INSTALLED;
    $style [1]         = "color:red";
    $version[1]        = null;
    
    if (file_exists( $xmlfilecomp )) {

        $xmlDoc = new DOMIT_Lite_Document();
        $xmlDoc->resolveErrors( true );
        if (!$xmlDoc->loadXML( $xmlfilecomp, false, true )) {
            echo "err1";
            continue;
        }

        $root = &$xmlDoc->documentElement;

        if ($root->getTagName() != 'install') {
            echo "err2";
            continue;
        }
        if ($root->getAttribute( "type" ) != "component") {
            echo "err3";
            continue;
        }
        $element 	= &$root->getElementsByPath( 'version', 1 );
        $version[1] = "version ".($element ? $element->getText() : '');
        $status [1] = _INSTALLED;
        $style  [1] = "color:green";
    }

    $modules_number=3;
    $modules[1]="iJoomla Surveys List";
    $modules[2]="iJoomla Surveys Popup";
    $modules[3]="iJoomla Surveys Results";

    $moduleBaseDir	= JPath::clean( JPath::clean( JPATH_SITE ) . "/modules" );
    // xml file for module
    $xmlfile[1] = $moduleBaseDir.DS."mod_ijoomla_surveys_list".DS."mod_ijoomla_surveys_list.xml";
    $xmlfile[2] = $moduleBaseDir.DS."mod_ijoomla_surveys_popup".DS."mod_ijoomla_surveys_popup.xml";
    $xmlfile[3] = $moduleBaseDir.DS."mod_ijoomla_surveys_results".DS."mod_ijoomla_surveys_results.xml";
    $version_mod[1]=null;
    $version_mod[2]=null;
    $version_mod[3]=null;

    for ($i=1;$i<=$modules_number;$i++){
        $status_mod[$i]= _NOT_INSTALLED;
        $style_mod[$i]  = "color:red";
        if (file_exists( $xmlfile[$i] )) {
            $xmlDoc = new DOMIT_Lite_Document();
            $xmlDoc->resolveErrors( true );
            if (!$xmlDoc->loadXML( $xmlfile[$i], false, true )) {
                continue;
            }

            $root = &$xmlDoc->documentElement;

            if ($root->getTagName() != 'install') {
                continue;
            }
            if ($root->getAttribute( "type" ) != "module") {
                continue;
            }
            $element 			= &$root->getElementsByPath( 'version', 1 );
            $version_mod[$i] 	= "version ".($element ? $element->getText() : '');
            $status_mod[$i]     = _INSTALLED;
            $style_mod [$i]      = "color:green";
        }
    }  
?>

<table width="100%" align="100%" class='menu_table'>
<tr>
   <td width="100%">
       <table width="60%">
           <tr>
               <td>
                   <?php echo _COMPONENTS;?> 
               </td>
           </tr>
           <tr>
               <td>
                   <table width="100%">
                      <?php
                      for ($i=1;$i<=$components_number;$i++){
                      ?>
                      <tr>
                          <td width="10%">
                          </td>
                          <td width="25%" style="<?php echo $style[$i];?>">
                              <strong><?php echo $status[$i];?></strong>
                          </td>
                          <td width="45%">
                              <?php echo "+ ".$components[$i];?>
                          </td>
                          <td width="20%">
                              <?php echo $version[$i];?>
                          </td>
                      </tr>
                      <?php
                      }
                      ?>
                   </table>
               </td>
           </tr>
           <tr>
               <td>
                   <?php echo _MODULES;?> 
               </td>           
           </tr>
           <tr>
               <td>
                   <table width="100%">
                      <?php
                      for ($i=1;$i<=$modules_number;$i++){
                      ?>
                      <tr>
                          <td width="10%">
                          </td>                      
                          <td width="25%" style="<?php echo $style_mod[$i];?>">
                              <strong><?php echo $status_mod[$i];?></strong>
                          </td>
                          <td width="45%">
                              <?php echo "+ ".$modules[$i];?>
                          </td>
                          <td width="20%">
                              <?php echo $version_mod[$i];?>
                          </td>
                      </tr>
                      <?php
                      }
                      ?>
                   </table>
               </td>           
           </tr>
        </table>             
    </td>   
</tr>
<tr>
    <td align="left" >
<?php echo LM_ABOUT;?>
    </td>
</tr>
<table>
<?php
}

/* iJoomla Al SURVEYS-53
wraps $text in pieces of maximum $length
returns layout text
*/
function text_wrap ($text, $length, $break) {
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

function change_access($s_id=0,$task){
    $database = &JFactory::getDBO();
    if ($task=="accesspublic"){
        $access = 0;       
    }elseif ($task=="accessregistered"){
        $access = 1; 
    }elseif ($task=="accessspecial"){
        $access = 2; 
    }else{
        return false;
    }
    if ($s_id!=0){
        $database->setQuery("UPDATE #__ijoomla_surveys_surveys SET access='$access' WHERE s_id=$s_id LIMIT 1");
	    $database->query();
	    if ($database->getErrorNum()) {
	        echo $database->stderr();
	        return false;
	    }	            
    }
}

// show in admin the sef links for surveys
function buildRoute($link){
	global $mainframe;
	$database=&JFactory::getDBO();
	$sef			= $mainframe->getCfg("sef");
	$sef_rewrite	= $mainframe->getCfg("sef_rewrite");
	$sef_suffix		= $mainframe->getCfg("sef_suffix");
	//sef is not set
	if($sef==0) return $link;
	else{
		$link=explode("index.php?",$link);
		$array_link=explode("&",$link[1]);
		$sef_link="";
		
		//start sh404
		$sql="select enabled from #__components where `option`='com_sh404sef'";
		$database->setQuery($sql);
		$database->query();
		if($database->getNumRows()>0){
			$result=$database->loadObject();
			if ($result->enabled==1){
				require_once(JPATH_SITE.DS."administrator".DS."components".DS."com_sh404sef".DS."config".DS."config.sef.php");
				if($Enabled==1){
					for($i=0;$i<count($array_link);$i++){
						$parts=explode("=",$array_link[$i]);
						if($parts[0]=="act"){
							$sef_link.=$parts[1]."/";
						}
						else if($parts[0]=="survey"){
							$val=explode(":",$parts[1]);
							$sef_link.=$val[1]."/";
						}
					}
					if($shRewriteMode!=0) $sef_link="index.php/".$sef_link;
					if (trim($suffix)!="") $sef_link=substr($sef_link,0,-1).".".$suffix;
					return JURI::root().$sef_link;
				}
			}
		}
		//end sh404
		
		//start sef advance
		$sql="select enabled from #__components where `option`='com_sef'";
		$database->setQuery($sql);
		$database->query();
		if($database->getNumRows()>0){
			$result=$database->loadObject();
			if ($result->enabled==1){
				$sql="select * from #__sef_config";
				$database->setQuery($sql);
				$database->query();
				$result=$database->loadObject();
				if($result->enabled==1){
					$custom_comp=$result->custom_comp;
					$array_custom_comp=explode(",",$custom_comp);
					$custom="surveys";
					for($i=0;$i<count($array_custom_comp);$i++){
						$parts=explode("=>",$array_custom_comp[$i]);
						if($parts[0]=="surveys") $custom=$parts[1];
					}
					for($i=0;$i<count($array_link);$i++){
						$parts=explode("=",$array_link[$i]);
						if($parts[0]=="option"){
							$sef_link.=$custom."/";
						}
						else if ($parts[0]=="Itemid"){
							if($result->alias==0){
								$sql="select name from #__menu where id=".intval($parts[1]);
								$database->setQuery($sql);
								$database->query();
								$val=$database->loadObject();
								$val=str_replace($result->space,"%11",$val->name);
								$val=str_replace(" ",$result->space,$val);
								$sef_link.=$val."/";	
							}
							else{
								$sql="select alias from #__menu where id=".intval($parts[1]);
								$database->setQuery($sql);
								$database->query();
								$val=$database->loadObject();
								$sef_link.=$val->alias."/";	
							}
						}
						else if($parts[0]=="survey"){
							$val=explode(":",$parts[1]);
							if($result->alias==0){
								$sql="select title from #__ijoomla_surveys_surveys where s_id=".intval($val[0]);
								$database->setQuery($sql);
								$database->query();
								$val=$database->loadObject();
								$val=str_replace($result->space,"%11",$val->title);
								$val=str_replace(" ",$result->space,$val);
								if($result->lowercase==1) $sef_link.=strtolower($val)."/";
								else $sef_link.=$val."/";
							}
							else $sef_link.=$val[1]."/";
						}
					}
					if(trim($result->sufix)!="" && $sef_suffix==1)
						$sef_link=substr($sef_link,0,-1).$result->sufix;
					if($sef_rewrite==0) $sef_link="index.php/".$sef_link;
					return JURI::root().$sef_link;
				}
			}
		}
		//end sef advance
		
		//start default sef
		for($i=0;$i<count($array_link);$i++){
			$parts=explode("=",$array_link[$i]);
			if($parts[0]=="Itemid"){
					$sql="select alias from #__menu where id=".intval($parts[1]);
					$database->setQuery($sql);
					$database->query();
					$val=$database->loadObject();
					$sef_link.=$val->alias."/";
			}
			else if($parts[0]=="survey"){
				$val=explode(":",$parts[1]);
				$sef_link.=$val[0]."-".$val[1]."/";
			}
		}
		if($sef_rewrite==0) $sef_link="index.php/".$sef_link;
		return JURI::root().$sef_link;
		//end default sef
	}
	
}
?>