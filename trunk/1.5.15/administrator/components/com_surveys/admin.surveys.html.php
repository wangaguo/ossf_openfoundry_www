<?php
/*
 * $Id: admin.surveys.html.php v. 0.0.30 2007/04/06 19:48:36Z iJoomla Al $
 *
 * @copyright
 * ====================================================================
/**
 * @copyright   (C) 2010 iJoomla, Inc. - All rights reserved.
 * @license  GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author  iJoomla.com <webmaster@ijoomla.com>
 * @url   http://www.ijoomla.com/licensing/
 * the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript  *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0 
 * More info at http://www.ijoomla.com/licensing/

 * ====================================================================
 * @endcopyright
 *
 * @file admin.surveys.html.php
 * @brief <brief description of file purpose>
 *
 * @classlist
 * ====================================================================
 * class HTML_surveys_config
 * class HTML_surveys
 * class HTML_questions
 * class HTML_blocks
 * class HTML_skiplogics
 * ====================================================================
 * @endclasslist
 *    
 * @history
 * ====================================================================
 * File creation date: 
 * Current file version: 0.0.29
 *
 * Modified By: iJoomla Al
 * Modified Date: 20/09/2006
 * Modification: show_config() - new email tab   
 *
 * Modified By: iJoomla Al
 * Modified Date: 20/09/2006
 * Modification: header() - new email tab  
 *
 * Modified By: iJoomla Al
 * Modified Date: 22/09/2006
 * Modification: editquestion() - force reload for survey preload      
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: showquestion() - error alert 
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: showblock() - error alert    
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: editblock() - select by default the previous survey    
 *
 * Modified By: iJoomla Al
 * Modified Date: 25/09/2006
 * Modification: showskiplogic() - error alert   
 *
 * Modified By: iJoomla Al
 * Modified Date: 26/09/2006
 * Modification: editskiplogic() - fixed 
 *
 * Modified By: iJoomla Al
 * Modified Date: 02/10/2006
 * Modification: collect() - survey link uses name instead of the id    
 *
 * Modified By: iJoomla Al
 * Modified Date: 04/10/2006
 * Modification: analyze() - fixed   
 *
 * Modified By: iJoomla Al
 * Modified Date: 05/10/2006
 * Modification: editskiplogic() - SURVEYS-30  
 *
 * Modified By: iJoomla Al
 * Modified Date: 06/10/2006
 * Modification: editblock() - SURVEYS-30     
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/10/2006
 * Modification: show_config() - general tab content      
 *
 * Modified By: iJoomla Al
 * Modified Date: 13/10/2006
 * Modification: SURVEYS-24 - function editSurvey()
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/10/2006
 * Modification: SURVEYS-28 - function editquestion() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/10/2006
 * Modification: SURVEYS-29 - editskiplogic() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 27/10/2006
 * Modification: show survey list settings
 *
 * Modified By: iJoomla Al
 * Modified Date: 31/10/2006
 * Modification: text_wrap() used in question manager, datetime question type edit fixed
 *
 * Modified By: iJoomla Al
 * Modified Date: 01/11/2006
 * Modification: analyze - status bar image path 
 *
 * Modified By: iJoomla Al
 * Modified Date: 02/11/2006
 * Modification: SURVEYS-55 Strange values in Statistics : analyze() - type==moreline modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 02/11/2006
 * Modification: SURVEYS-56 Problems in SkipActions Manager : editskiplogic() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 03/11/2006
 * Modification: SURVEYS-64 Control Panel and navigation tree problems
 *
 * Modified By: iJoomla Al
 * Modified Date: 03/11/2006
 * Modification: SURVEYS-67 Stats in Surveys Manager - analyze() fixed; respondents count by filter
 *
 * Modified By: Nik
 * Modified Date: 04/11/2006
 * Modification: Fixed syntax
 *
 * Modified By: iJoomla Al
 * Modified Date: 06/11/2006
 * Modification: SURVEYS-63 Headers of manager pages
 *
 * Modified By: iJoomla Al
 * Modified Date: 07/11/2006
 * Modification: SURVEYS-69 Show Result in Surveys Manager
 *
 * Modified By: iJoomla Al
 * Modified Date: 07/11/2006
 * Modification: SURVEYS-68 Problems with redirect in Surveys Manager - editSurvey() modified  
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/11/2006
 * Modification: SURVEYS-60 editquestion() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/11/2006
 * Modification: SURVEYS-59 editquestion() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 14/11/2006
 * Modification: SURVEYS-65 showSurvey(),showquestion(),showblock(),showskiplogic() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/11/2006
 * Modification: SURVEYS-74 code cleaned  
 *
 * Modified By: iJoomla Al
 * Modified Date: 17/11/2006
 * Modification: SURVEYS-73 links updated
 *
 * Modified By: iJoomla Al
 * Modified Date: 17/11/2006
 * Modification: SURVEYS-57 editskiplogic() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-92 editquestion() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-89 editSurvey() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-87 html display functions for survey,question,page and skip modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-83 language file modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-94 show_config() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 24/11/2006
 * Modification: SURVEYS-96 show_config() and language file modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 27/11/2006
 * Modification: SURVEYS-105 control_panel(),header() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 27/11/2006
 * Modification: SURVEYS-103 editSurvey() modified 	 
 *
 * Modified By: iJoomla Al
 * Modified Date: 28/11/2006
 * Modification: SURVEYS-88 showquestion() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 04/12/2006
 * Modification: SURVEYS-92 - new comment : showquestion() fixed 
 *
 * Modified By: iJoomla Al
 * Modified Date: 04/12/2006
 * Modification: SURVEYS-106 - collect() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 04/12/2006
 * Modification: SURVEYS-108 editskiplogic() modified
 * 
 * Modified By: iJoomla Al
 * Modified Date: 04/12/2006
 * Modification: SURVEYS-88 - filter buttons added for every manager:showSurvey(),showquestion(),showblock(),showskiplogic() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 13/12/2006
 * Modification: SURVEYS-109 editquestion() modified  
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/12/2006
 * Modification: SURVEYS-110 continue_editing task added to 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 18/12/2006
 * Modification: SURVEYS-111,SURVEYS-113 analyze() parameters modified , last task, last s_id, last session_id kept in $_POST 
 * 
 * Modified By: iJoomla Al
 * Modified Date: 04/01/2006
 * Modification: SURVEYS-119 - editquestion() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 22/01/2006
 * Modification: SURVEYS-129 - editSurvey() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 23/01/2007
 * Modification: SURVEYS-134 - show_config() modified ; cookie path set to global $mainframe,  
 *
 * Modified By: iJoomla Al
 * Modified Date: 02/02/2007
 * Modification: SURVEYS-143 analyze() modified  
 *
 * Modified By: iJoomla Al
 * Modified Date: 06/02/2007
 * Modification: SURVEYS-152 - showresponses() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 07/02/2007
 * Modification: analyze(),showresponses() - jos_ fixed table prefix modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/02/2007
 * Modification: SURVEYS-153 - editSurvey() modified 
 *
 * Modified By: iJoomla Al
 * Modified Date: 30/03/2007
 * Modification: analyze() modified - matrix questions statistics fixed
 *
 * Modified By: iJoomla Al
 * Modified Date: 06/04/2007
 * Modification: showskiplogic(),editskiplogic() modified for 'Jump to Survey End'
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
$export           = JArrayHelper::getValue( $_REQUEST, 'export'     );
if($export!="export"){
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $mainframe->getSiteURL();?>includes/js/calendar/calendar-mos.css" title="green" /> 
		<!-- import the calendar script -->
		<script type="text/javascript" src="<?php echo $mainframe->getSiteURL();?>includes/js/calendar/calendar_mini.js"></script>
		<!-- import the language module -->    
		<script type="text/javascript" src="<?php echo $mainframe->getSiteURL();?>includes/js/calendar/lang/calendar-en-GB.js"></script>

<script>
function showCalendar(id) {
	
	var el = document.getElementById(id);
	if (calendar != null) {
		// we already have one created, so just update it.
		calendar.hide();		// hide the existing calendar
		calendar.parseDate(el.value); // set it to a new date
	} else {
		// first-time call, create the calendar
		var cal = new Calendar(true, null, selected, closeHandler);
		calendar = cal;		// remember the calendar in the global
		cal.setRange(1900, 2070);	// min/max year allowed
		calendar.create();		// create a popup calendar
		calendar.parseDate(el.value); // set it to a new date
	}
	calendar.sel = el;		// inform it about the input field in use
	calendar.showAtElement(el);	// show the calendar next to the input field

	// catch mousedown on the document

	Calendar.addEvent(document, "mousedown", checkCalendar);	
	return false;
}
</script>		
		
<?php }
$export           = JArrayHelper::getValue( $_REQUEST, 'export'     );

class HTML_surveys_config {
	function show_config ( $option, $act ) {
		global $mainframe, $row, $emailArrayValues,
					 $css_survey_name, $css_survey_description, $css_page_name, $css_page_description,
					 $css_question, $css_question_description, $css_answer, $css_checkbox, $css_radiobutton, 
					 $css_dropdownmenu, $css_textarea, $css_button, $css_row_heading, $css_column_heading, 
					 $css_table_row1, $css_table_row2, $css_result_heading, $css_total_background, $css_popup_title,
					 $css_popup_content, $css_popup_button_row ;
		$database = &JFactory::getDBO();
		JOutputFilter::objectHTMLSafe( $row, ENT_QUOTES );
		//JHTML::_('loadOverlib') ;
		
		$req_task2=JArrayHelper::getValue($_GET,'task2');
		if    ( $req_task2 == 'general' ){
			setcookie( "webfxtab_SettingsPanel", 0 , 0 , '/') ;
		}
		elseif( $req_task2 == 'css' ){
			setcookie( "webfxtab_SettingsPanel", 1 , 0 , '/') ;
		}
		elseif( $req_task2 == 'language' ){
			setcookie( "webfxtab_SettingsPanel", 2 , 0 , '/') ;
		}
		elseif( $req_task2 == 'email' ){
			setcookie( "webfxtab_SettingsPanel", 3 , 0 , '/') ;
		}
		
		include_once( JPATH_SITE . "/administrator/components/com_surveys/surveys_config.php" ) ;
		
		$filename = JPATH_SITE . "/components/com_surveys/survey.css" ;
		$handle = fopen( $filename, 'r' ) ;
		$css_file = fread($handle, filesize( $filename ) ) ;
		fclose( $handle ) ;
		
		$filename = JPATH_SITE . "/administrator/components/com_surveys/language/english.surveys.php" ;
		$handle = fopen( $filename, 'r' ) ;
		$language_file = fread( $handle, filesize( $filename ) ) ;
		fclose( $handle ) ;
		
		$database->setQuery( "SELECT * FROM #__ijoomla_surveys_email_settings" ) ;
		$emailArrayValues = $database->loadObject(  ) ;
		
		if ( $database->getErrorNum() ) {
				echo $database->stderr() ;
				return false ;
		}
				
		?>
		<h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL() ; ?>administrator/components/com_surveys/images/icons/settings.png" width="48" height="48" align="middle"> Survey Component Settings </h2>
		<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
		<?php
		jimport( 'joomla.html.pane' );
	
		$tab=JRequest::getVar('tab','0','get','int');
		$tabs =& JPane::getInstance('tabs', array('startOffset'=>$tab));
		echo $tabs->startPane( "SettingsPanel" ) ;
		echo $tabs->startPanel(_GENERAL, 'general-settings-panel' ) ;
		$database->setQuery( "SELECT general_option,general_date FROM #__ijoomla_surveys_config" ) ;
		$general_results = $database->loadAssocList() ;
		
		$general_result		= $general_results[0]["general_option"];
		$general_date			= $general_results[0]["general_date"];
		if ( $database->getErrorNum() ) {
				echo $database->stderr() ;
				return false ;
		}		
		?>
		<table width="100%" class="adminform">
		<th><?php echo _GENERAL ; ?> </th>		
		<tr>
			<td valign="top" width="100%">
				<table width="100%">
				<tr>
					<td><input type="radio" name="general_value" value="<?php echo _ONE_RESPONSE_P_RESPONDENT_VALUE ; ?>" <?php if ( $general_result == _ONE_RESPONSE_P_RESPONDENT_VALUE ) echo "checked" ; ?> />&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo _ONE_RESPONSE_P_RESPONDENT_TEXT ; ?></td>
				</tr>
				<tr>
					<td><input type="radio" name="general_value" value="<?php echo _ONE_RESPONSE_P_RESPONDENT_FO_VALUE ; ?>" <?php if ( $general_result == _ONE_RESPONSE_P_RESPONDENT_FO_VALUE ) echo "checked" ; ?> />&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo _ONE_RESPONSE_P_RESPONDENT_FO_TEXT ; ?></td>
				</tr>
				<tr>
					<td><input type="radio" name="general_value" value="<?php echo _MULTIPLE_RESPONSES_P_RESPONDENT_VALUE ; ?>" <?php if ( $general_result == _MULTIPLE_RESPONSES_P_RESPONDENT_VALUE ) echo "checked" ; ?> />&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo _MULTIPLE_RESPONSES_P_RESPONDENT_TEXT ; ?></td>
				</tr>
				<tr>
					<td><input type="radio" name="general_value" value="<?php echo _MULTIPLE_RESPONSES_P_RESPONDENT_SC_VALUE ; ?>" <?php if ( $general_result == _MULTIPLE_RESPONSES_P_RESPONDENT_SC_VALUE ) echo "checked" ; ?> />&nbsp;&nbsp;&nbsp;</td>
					<td><?php echo _MULTIPLE_RESPONSES_P_RESPONDENT_SC_TEXT ; ?></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		
		<table width="100%" class="adminform">
		<th><?php echo _DATETIME ; ?> </th>		
		<tr>
			<td valign="top" width="100%">
				<table width="100%">
				<tr>
					<td width="15%"><?php echo _DATETIME; ?></td>
					<td width="85%" align="left">
					<select name="general_date">
						<option  <?php if($general_date == '1') { echo 'selected="selected"'; }?> value="1">mm/dd/yyyy </option>
						<option <?php if($general_date == '2') { echo 'selected="selected"'; }?> value="2">dd/mm/yyyy</option>
						<option <?php if($general_date == '3') { echo 'selected="selected"'; }?> value="3">yyyy/mm/dd </option>
						<option <?php if($general_date == '4') { echo 'selected="selected"'; }?> value="4">yyyy/dd/mm </option>
					</select>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		
		<?php
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( LM_MENU_CSS, "css-settings-panel" ) ;
		?>
		<table width="100%" class="adminform">
			<tr>
				<th colspan="2"> <?php echo _MANAGE . ' ' . LM_MENU_CSS . ' ' . _CLASSES ; ?></th>
			</tr>
		<tr>
		<td width="50%" valign="top">
			<span  style="color:#669900;font-size:14px;font-weight:bold;"><?php echo _GENERAL . '  ' ; ?></span>
			<table width="100" class="adminform">
				<tr>
					<td width="35%"> <b><?php echo _SURVEY . ' ' . _NAME1 ; ?></b></td>
					<td width="65%"> <input type="text" name="css[survey_name]" value="<?php echo $css_survey_name ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _SURVEY . ' ' . _DESCRIPTION ; ?></b></td>
					<td><input type="text" name="css[survey_description]" value="<?php echo $css_survey_description ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _PAGE . ' ' . _NAME1 ; ?></b></td>
					<td><input type="text" name="css[page_name]" value="<?php echo $css_page_name ; ?>" /></td>
				</tr>
					<td><b><?php echo _PAGE . ' ' . _DESCRIPTION ; ?></b></td>
					<td><input type="text" name="css[page_description]" value="<?php echo $css_page_description ; ?>" /></td>
				</tr>
				<tr>
				<tr>
					<td><b><?php echo _QUESTION?></b></td>
					<td><input type="text" name="css[question]" value="<?php echo $css_question ; ?>" /></td>
				</tr>
				<td><b><?php echo _QUESTION.' '._DESCRIPTION?></b></td>
				<td><input type="text" name="css[question_description]" value="<?php echo $css_question_description ; ?>" /></td>
				</tr>
				<tr>
				<tr>
					<td><b><?php echo _ANSWER?></b></td>
					<td><input type="text" name="css[answer]" value="<?php echo $css_answer ; ?>" /></td>
				</tr>
			</table>
			
			<span  style="color:#669900;font-size:14px;font-weight:bold;"><?php echo _FORM . '  ' . _ELEMENTS ; ?></span>
			<table width="100" class="adminform">
				<tr>
					<td width="35%"><b> <?php echo _CHECKBOX ; ?></b></td>
					<td width="65%"><input type="text" name="css[checkbox]" value="<?php echo $css_checkbox ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _RADIOBUTTON ; ?></b></td>
					<td><input type="text" name="css[radiobutton]" value="<?php echo $css_radiobutton ; ?>" /></td>
				</tr>
				<tr>
					<td><b> <?php echo _DROPDOWNMENU?></b></td>
					<td><input type="text" name="css[dropdownmenu]" value="<?php echo $css_dropdownmenu ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _TEXTAREA ; ?></b></td>
					<td><input type="text" name="css[textarea]" value="<?php echo $css_textarea ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _BUTTON ; ?></b></td>
					<td><input type="text" name="css[button]" value="<?php echo $css_button ; ?>" /></td>
				</tr>
			</table>
			
			<span  style="color:#669900;font-size:14px;font-weight:bold;"><?php echo _TABLE ; ?></span>
			<table width="100" class="adminform">
				<tr>
					<td width="35%"> <b><?php echo _ROW . ' ' . _HEADING; ?></b></td>
					<td width="65%"> <input type="text" name="css[row_heading]" value="<?php echo $css_row_heading ; ?>" /></td>
				</tr>
				<tr>
					<td><b> <?php echo _COLUMN . ' ' . _HEADING ; ?></b></td>
					<td><input type="text" name="css[column_heading]" value="<?php echo $css_column_heading ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _TABLE . ' ' . _ROW ; ?>1</b></td>
					<td><input type="text" name="css[table_row1]" value="<?php echo $css_table_row1 ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _TABLE.' '._ROW ; ?>2</b></td>
					<td><input type="text" name="css[table_row2]" value="<?php echo $css_table_row2 ; ?>" /></td>
				</tr>
			</table>
			
			<span  style="color:#669900;font-size:14px;font-weight:bold;"><?php echo _RESULTS ; ?></span>
			<table width="100" class="adminform">
				<tr>
					<td width="35%"><b> <?php echo _RESULT . ' ' . _HEADING ; ?></b></td>
					<td width="65%"> <input type="text" name="css[result_heading]" value="<?php echo $css_result_heading ; ?>" /></td>
				</tr>
				<tr>
					<td><b> <?php echo _TOTAL . ' ' . _BACKGROUND ; ?></b></td>
					<td><input type="text" name="css[total_background]" value="<?php echo $css_total_background ; ?>" /></td>
				</tr>
			</table>
			
			<span  style="color:#669900;font-size:14px;font-weight:bold;"><?php echo _POP_UP ; ?></span>
			<table width="100" class="adminform">
				<tr>
					<td width="35%"><b> <?php echo _POP_UP.' '._TITLE?></b></td>
					<td width="65%"><input type="text" name="css[popup_title]" value="<?php echo $css_popup_title ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _POP_UP . ' ' . _CONTENT ; ?></b></td>
					<td><input type="text" name="css[popup_content]" value="<?php echo $css_popup_content ; ?>" /></td>
				</tr>
				<tr>
					<td><b><?php echo _POP_UP . ' ' . _BUTTON . ' row' ; ?></b></td>
					<td><input type="text" name="css[popup_button_row]" value="<?php echo $css_popup_button_row ; ?>" /></td>
				</tr>
			</table>
		
		</td>
		<td width="50%" valign="top">
			<span  style="color:#669900;font-size:14px;font-weight:bold;">CSS File </span>
			<table width="100" class="adminform">
				<tr>
					<td> 
						<textarea cols="50" rows="40" name="css_file"><?php echo $css_file ; ?></textarea>
					</td>
				</tr>
			</table>
		</td>
		</tr>
		</table>
		
		<?php
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( LM_MENU_LANGUAGE, 'language-settigs-panel' ) ;
		?>
		<table width="100%" class="adminform">
		<tr>
			<th> Editing file : <?php echo JPATH_SITE . "/administrator/components/com_surveys/language/english.surveys.php" ; ?></th>
		</tr>
		<tr>
			<td>
				<b><?php echo LM_MENU_LANGUAGE . ' ' . _DATA ; ?></b><br />
				<textarea cols="90" rows="20" name="lang_file"><?php echo $language_file ; ?></textarea>
			</td>
		</tr>
		</table>
		
		<?php		
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( LM_MENU_EMAIL, "email-settings-panel" ) ;
		
		?>
		<table width="100%">
			<tr>
				<td align="right">
					<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/email.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
				</td>
			</tr>	
		</table>
		<table width="100%" class="adminform">
		<th ><?php echo ucfirst(_EMAIL) . ' ' . _SETTING ; ?> </th>		
			<tr>
				<td valign="top" width="100%">
					<table width="100%">
					<tr>
					<td colspan="2">
					<?php echo _NOTITY_ME_BY_EMAIL ; ?>:&nbsp;<?php echo _YES ; ?><input type="radio" name="email_activ" value="1" <?php echo $emailArrayValues->email_settings_activ == '1' ? "checked" : "" ; ?>>&nbsp;&nbsp;&nbsp;<?php echo _NO ; ?>&nbsp;<input type="radio" name="email_activ" value="0" <?php echo $emailArrayValues->email_settings_activ == '0' ? "checked" : "" ; ?> /> 
					</td>
					</tr>
				<tr>
					<td nowrap width="10%">
					<?php echo _SEND_EMAIL_NOTIFICATION_TO ; ?>:
					</td>
					<td>
					<input class="text_area" type="text" name="email_to" value="<?php echo $emailArrayValues->email_settings_to ; ?>" size="50" maxlength="50" title="" />&nbsp;&nbsp;&nbsp;Enter an e-mail address here
					</td>
				</tr>
				<tr>
					<td>
					<?php echo _FROM ; ?>:
					</td>
					<td>
					<input class="text_area" type="text" name="email_from" value="<?php echo $emailArrayValues->email_settings_from ; ?>" size="50" maxlength="50" title="" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo _EMAIL_SUBJECT ; ?>:
					</td>
					<td>
					<input class="text_area" type="text" name="email_subject" value="<?php echo $emailArrayValues->email_settings_subject ; ?>" size="50" maxlength="50" title="" />
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo _EMAIL_MESSAGE ; ?>:
					</td>
					<td>
					<?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					$editor1  = & JFactory::getEditor();
					$emailArrayValues->email_settings_content = str_replace('\\&quot;', '', $emailArrayValues->email_settings_content);
					echo $editor1->display( 'editor1',  ''.$emailArrayValues->email_settings_content, '100%', '100%;', '200', '50', '10' ) ; ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		
		<?php
		echo $tabs->endPanel() ;	
		echo $tabs->endPane() ;
		?>
		<input type="hidden" name="option" value="<?php echo $option ; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="<?php echo $act ; ?>" />
		</form>
		<?php
	}
}

class HTML_surveys {
	function header(){
	global $mainframe;
	$export = JArrayHelper::getValue( $_REQUEST, 'export');

	if($export!="export"){
	?>

	<link rel="StyleSheet" href="<?php echo $mainframe->getSiteURL() ; ?>administrator/components/com_surveys/javascript/dtree.css" type="text/css" />
	<script type="text/javascript" src="<?php echo $mainframe->getSiteURL() ; ?>administrator/components/com_surveys/javascript/dtree.js"></script>

	<table width="100%" cellspacing='3' cellpadding="4" >
	<tr><td valign='top' width="160" >
	<table width='100%' cellpadding='5' height='100%' class='menu_table'><tr><td>

				<div class="dtree" align="left">

				<a href="javascript: d.openAll();">open all</a> | <a href="javascript: d.closeAll();">close all</a><br />
	<br/>
	<script type="text/javascript">
	<!--

	d = new dTree('d');

	d.add( 0, -1, '&nbsp;<?php echo LM_MENU_SURVEY;?>', 'index2.php?option=com_surveys', '', '', 'components/com_surveys/images/icons/small/ijoomla.png' ) ;

	d.add( 800, 0, '&nbsp;<?php echo LM_MENU_ADMINISTRATION ; ?>', '', '', '', 'components/com_surveys/images/icons/small/settings.png', 'components/com_surveys/images/icons/small/settings.png' ) ;

	d.add( 801, 800, '&nbsp;<?php echo LM_MENU_CONFIGURATION ; ?>', 'index2.php?option=com_surveys&act=config&task2=general&tab=0', '', '', 'components/com_surveys/images/icons/small/settings.png') ;
	d.add( 803, 800, '&nbsp;<?php echo LM_MENU_CSS ; ?>', 'index2.php?option=com_surveys&act=config&task2=css&tab=1', '', '', 'components/com_surveys/images/icons/small/css.png', 'components/com_surveys/images/icons/small/css.png' ) ;
	d.add( 804, 800, '&nbsp;<?php echo LM_MENU_LANGUAGE ; ?>', 'index2.php?option=com_surveys&act=config&task2=language&tab=2' ,'' ,'' ,'components/com_surveys/images/icons/small/language.png', 'components/com_surveys/images/icons/small/language.png' ) ;
	d.add( 805, 800, '&nbsp;<?php echo LM_MENU_EMAIL ; ?>', 'index2.php?option=com_surveys&act=config&task2=email&tab=3', '', '', 'components/com_surveys/images/icons/small/email.png', 'components/com_surveys/images/icons/small/email.png' ) ;

	d.add( 810, 0  , '&nbsp;<?php echo LM_MENU_MANAGERS ; ?>', '', '', '', 'components/com_surveys/images/icons/small/surveys.png', 'components/com_surveys/images/icons/small/surveys.png') ;
	d.add( 811, 810, '&nbsp;<?php echo LM_MENU_SURVEYS_MANAGER ; ?>', 'index2.php?option=com_surveys&act=survey', '', '', 'components/com_surveys/images/icons/small/surveys.png', 'components/com_surveys/images/icons/small/surveys.png' ) ;
	d.add( 812, 810, '&nbsp;<?php echo LM_MENU_PAGES_MANAGER ; ?>', 'index2.php?option=com_surveys&act=block', '', '', 'components/com_surveys/images/icons/small/pages.png', 'components/com_surveys/images/icons/small/pages.png' ) ;
	d.add( 813, 810, '&nbsp;<?php echo LM_MENU_QUESIONS_MANAGER ; ?>', 'index2.php?option=com_surveys&act=question', '', '', 'components/com_surveys/images/icons/small/questions.png', 'components/com_surveys/images/icons/small/questions.png' ) ;
	d.add( 814, 810, '&nbsp;<?php echo LM_MENU_SKIP_ACTIONS_MANAGER ; ?>', 'index2.php?option=com_surveys&act=skip', '', '', 'components/com_surveys/images/icons/small/skip_actions.png', 'components/com_surveys/images/icons/small/skip_actions.png' ) ;

	d.add( 820, 0  , '&nbsp;<?php echo LM_MENU_DOCUMENTATION ; ?>', '', '', '', 'components/com_surveys/images/icons/small/support.png', 'components/com_surveys/images/icons/small/support.png' ) ;
	d.add( 821, 820, '&nbsp;<?php echo LM_MENU_IJOOMLA_WEBSITE ; ?>', 'http://www.ijoomla.com', 'iJoomla website', '_blank', 'components/com_surveys/images/icons/small/ijoomla.png' ) ;
	d.add( 822, 820, '&nbsp;<?php echo LM_MENU_LATEST_VERSION ; ?>', 'http://www.ijoomla.com/redirect/general/latestversion.htm', 'Latest Version', '_blank', 'components/com_surveys/images/icons/small/star_green_small.png' ) ;
	d.add( 823, 820, '&nbsp;<?php echo LM_MENU_SUPPORT_HELP ; ?>', 'http://www.ijoomla.com/redirect/general/support.htm', 'iJoomla Support', '_blank', 'components/com_surveys/images/icons/small/support.png') ;
	d.add( 824, 820, '&nbsp;<?php echo LM_MENU_FORUMS ; ?>', 'http://www.ijoomla.com/redirect/survey/forum.htm', 'iJoomla Forum', '_blank', 'components/com_surveys/images/icons/small/forum.png' ) ;
	d.add( 825, 820, '&nbsp;<?php echo LM_MENU_MANUAL ; ?>', 'http://www.ijoomla.com/redirect/survey/manual.htm', 'iJoomla Surveys Manual', '_blank','components/com_surveys/images/icons/small/manual.png' ) ;
	d.add( 826, 820, '&nbsp;<?php echo LM_MENU_OTHER_COMPONENTS ; ?>', 'http://www.ijoomla.com/redirect/general/othercomponents.htm', 'iJoomla Other Components', '_blank', 'components/com_surveys/images/icons/small/other_components.png' ) ;
	d.add( 827, 820, '&nbsp;<?php echo LM_MENU_TEMPLATES ; ?>', 'http://www.ijoomla.com/redirect/general/templates.htm', 'iJoomla Templates', '_blank', 'components/com_surveys/images/icons/small/templates.png' ) ;


	d.add( 830, 0, '&nbsp;<?php echo LM_MENU_ABOUT ; ?>', 'index2.php?option=com_surveys&act=about', '', '', 'components/com_surveys/images/icons/small/about.png' ) ;


	document.write( d ) ;

	//-->
	
	</script> </td></tr></table>
	</td><td valign='top' align='left'>
	<style type="text/css">
	.adminheading th {
			color:#669900;
		}
		
	a{
			color:#669900;
		}
		
	table.adminform th{
			background: url(components/com_surveys/images/adminform_back.png);
		}
		
	table.adminlist th{
			background: url(components/com_surveys/images/adminform_back.png);
		}
		
	table.adminForm th{
			background: url(components/com_surveys/images/adminform_back.png);
		}

	</style>
	<?php
	}
}

function footer () {
	?>
	</td></tr></table>
	<p><center><?php echo LM_POWERED_BY ; ?><a href='http://www.ijoomla.com' target='_blank'>.iJoomla Surveys</a></center></p>

	<?php
	}

function control_panel ( $option, $act ) {
	global $mainframe;
	?>

	<table class="adminheading">
	<tr><td valign='top' align="left">
	<img src="<?php echo $mainframe->getSiteURL() ; ?>administrator/components/com_surveys/images/logo_ijoomlasurvey.png" border="0">
	</td></tr>
	</table>

	<table class="adminform" style="width:513px;" >
	<tr><td >
	<div id="cpanel">

				<div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=config">
					<img src="components/com_surveys/images/icons/settings.png"
										alt="Survey <?php echo LM_MENU_ADMINISTRATION;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_ADMINISTRATION;?></span>
				</a>
			</div>
		</div>
	
					
				<div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=config&task2=css">
					<img src="components/com_surveys/images/icons/css.png"
										alt="Surveys <?php echo LM_MENU_CSS;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_CSS;?></span>
				</a>
			</div>
		</div>
	
				<div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=config&task2=language">
					<img src="components/com_surveys/images/icons/language.png"
										alt="Survey <?php echo LM_MENU_LANGUAGE;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_LANGUAGE;?></span>
				</a>
			</div>
		</div>

				<div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=config&task2=email">
					<img src="components/com_surveys/images/icons/email.png"
										alt="Survey <?php echo LM_MENU_EMAIL ; ?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_EMAIL ; ?></span>
				</a>
			</div>
		</div>

				<div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=survey">
					<img src="components/com_surveys/images/icons/surveys.png"
										alt="<?php echo LM_MENU_SURVEYS_MANAGER;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_SURVEYS_MANAGER;?></span>
				</a>
			</div>
		</div>
	
			 <div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=block">
					<img src="components/com_surveys/images/icons/pages.png"
										alt="<?php echo LM_MENU_PAGES_MANAGER;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_PAGES_MANAGER;?></span>
				</a>
			</div>
		</div>
	
			 <div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=question">
					<img src="components/com_surveys/images/icons/questions.png"
										alt="<?php echo LM_MENU_QUESIONS_MANAGER;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_QUESIONS_MANAGER;?></span>
				</a>
			</div>
		</div>
	
			 <div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=skip">
					<img src="components/com_surveys/images/icons/skip_actions.png"
										alt="<?php echo LM_MENU_SKIP_ACTIONS_MANAGER;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_SKIP_ACTIONS_MANAGER;?></span>
				</a>
			</div>
		</div>
			
			 <div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com"  target='_blank'>
					<img src="components/com_surveys/images/icons/ijoomla.png"
										alt="<?php echo LM_MENU_IJOOMLA_WEBSITE;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_IJOOMLA_WEBSITE;?></span>
				</a>
			</div>
		</div>  
			 
			 <div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com/redirect/general/latestversion.htm"  target='_blank'>
					<img src="components/com_surveys/images/icons/star_green_big.png"
										alt="<?php echo LM_MENU_LATEST_VERSION;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_LATEST_VERSION;?></span>
				</a>
			</div>
		</div> 
				
				<div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com/redirect/general/support.htm"  target='_blank'>
					<img src="components/com_surveys/images/icons/support.png"
										alt="<?php echo LM_MENU_SUPPORT_HELP;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_SUPPORT_HELP;?></span>
				</a>
			</div>
		</div>
	
				<div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com/redirect/survey/forum.htm"  target='_blank'>
					<img src="components/com_surveys/images/icons/forum.png"
										alt="<?php echo LM_MENU_FORUMS;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_FORUMS;?></span>
				</a>
			</div>
		</div>

		
				<div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com/redirect/survey/manual.htm" target='_blank'>
					<img src="components/com_surveys/images/icons/manual.png"
										alt="<?php echo LM_MENU_MANUAL;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_MANUAL;?></span>
				</a>
			</div>
		</div>		
	
			 <div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com/redirect/general/othercomponents.htm"  target='_blank' >
					<img src="components/com_surveys/images/icons/other_components.png"
										alt="<?php echo LM_MENU_OTHER_COMPONENTS;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_OTHER_COMPONENTS;?></span>
				</a>
			</div>
		</div>
			
			 <div style="float:left;">
			<div class="icon">
				<a href="http://www.ijoomla.com/redirect/general/templates.htm"  target='_blank' >
					<img src="components/com_surveys/images/icons/templates.png"
										alt="<?php echo LM_MENU_TEMPLATES;?>" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_TEMPLATES;?></span>
				</a>
			</div>
		</div>
		
		
			 <div style="float:left;">
			<div class="icon">
				<a href="index2.php?option=com_surveys&act=about">
					<img src="components/com_surveys/images/icons/about.png"
										alt="<?php echo LM_MENU_ABOUT ; ?> iJoomla Surveys" align="middle" name="" border="0" />
										<span><?php echo LM_MENU_ABOUT ; ?></span>
				</a>
			</div>
		</div>		
	
	</div>
	</td></tr>
	</table>
<?php
}
function collect ( $s_id, $option, $act ) {
		global $mainframe;
		$database = &JFactory::getDBO();
		
		$database->setQuery( "SELECT alias FROM #__ijoomla_surveys_surveys WHERE s_id='$s_id'" ) ;
		$survey_title = $database->loadResult() ;
		if ( $database->getErrorNum() ) {
				echo $database->stderr() ;
				return false ;
		}

		$database->setQuery( "SELECT comp.option,comp.id FROM #__components comp WHERE name='.iJoomla Surveys'" );
		if ( !$database->query() ){
				echo $database->stderr() ;
				return false ;
		}
		if ( $database->getNumRows()>0){
				$component_res = $database->loadAssocList();
				$component_info = $component_res[0];		
				$database->setQuery( "SELECT `id` as menuID FROM `#__menu` WHERE `componentid`='".$component_info['id']."'" );
				if ( !$database->query() ){
						echo $database->stderr() ;
						return false ;
				}
				if ( $database->getNumRows() > 0 ){
						$menu_res = $database->loadAssocList();
						$menu_info = $menu_res[0];
			
						$homelink = "index.php?option=".$component_info['option']."&Itemid=".$menu_info['menuID'];    
						//$link = $mainframe->getSiteURL().$homelink."&act=view_survey&survey=".$survey_title ;
						$link =$homelink."&act=view_survey&survey=".$s_id.":".$survey_title ;	
						$link=buildRoute($link);		
				}else{
					$link = $mainframe->getSiteURL();
				}
		}else{
			$link = $mainframe->getSiteURL();
		}
		
		
	?>
	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%"  class='menu_table'>
	<tr>
		<td><h2 style="color:#669900" > <?php echo _COLLECT . ' ' . _RESPONSES ; ?></h2></td> 	
	</tr>
	<tr>
		<td><b><?php echo _LINK_EMAIL;?></b></td> 
	</tr>
	<tr>
		<td><textarea cols="80" rows="4"><?php echo $link ; ?></textarea></td>
	</tr>
	<tr>
		<td><b><?php echo _LINK_WEB;?></b></td>
	</tr>
	<tr>
		<td>
			<textarea cols="80" rows="4"><a href="<?php echo $link ; ?>"><?php echo _CLICK_TO_TAKE;?></a></textarea>
		</td>
	</tr>
	</table>
	<input type="hidden" name="option" value="<?php echo $option ; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="<?php echo $act ; ?>" />	
	</form>
	<?php
}
function view_result_text ( &$rows, $pageNav, $option, $act, $task, $q_id, $lasts_id, $lasttask ,$post_filter) {
	?>
	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<td width="100%" ><span><?php echo _RESULT_TEXT;?></span></td>
		</tr>
	</table>
	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th align="center" width="5%">#</th>
			<th ><?php echo _VALUE ; ?></th>
		</tr>	
	<?php
		$k = 0 ;
		for( $i = 0; $i < count( $rows ); $i++ ) {
			$row = $rows[$i] ;
	?>
		<tr class="<?php echo "row$k" ; ?>">
			<td align="center"><?php echo $i + $pageNav->limitstart + 1 ; ?></td>
			<td ><?php echo $row->value ; ?></a></td>
		</tr>
	<?php 
		$k = 1 - $k ;
		}
	?>
		<tr>
			<th align="center" colspan="10"> <?php echo $pageNav->getPagesCounter() ; ?></th>
		</tr>
		<tr>
				<td colspan="10" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td nowrap style="border:none"><?php //echo _DISPLAY ; ?> </td>
							<td style="border:none"> <?php //echo $pageNav->writeLimitBox() ; ?> </td>		
							<td style="border:none"> <?php echo $pageNav->getListFooter() ; ?></td>
						</tr>
				</table>
				</td>
		</tr>
	</table>
	
	<input type="hidden" name="option" value="<?php echo $option ; ?>" />
	<input type="hidden" name="task" value="<?php echo $task ; ?>" />
	<input type="hidden" name="q_id" value="<?php echo $q_id ; ?>" />
	<input type="hidden" name="lasts_id" value="<?php echo $lasts_id ; ?>" />
	<input type="hidden" name="lasttask" value="<?php echo $lasttask ; ?>" />
	<input type="hidden" name="filter_machine" value="<?php echo $post_filter ; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="<?php echo $act ; ?>" />
	</form>
	
	
			
	<?php	
}
function view_result_value ( &$rows, $question_info, $answer_info, $pageNav, $option, $act, $task, $lasts_id, $lasttask ,$post_filter, $a_id ) {
	
	global $mainframe;
	$database = &JFactory::getDBO();
	?>
	
	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<td width="100%" ><!--<img src="images/mos_gel.png" width="70" height="67" align="middle" />--><?php echo _QUESTION." : ".stripslashes($question_info->title) ; ?></td>
		</tr>
		<tr>
			<td colspan="3"><b><?php echo _CHOICE." : ".stripslashes($answer_info->value) ; ?></b></td>
		</tr>
	</table>
	<?php
	
	
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
				
				
			?>
	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th align="center" width="5%">#</th>
			
			<th ><?php if ( $question_info->type == 'datetime' ) echo $disp." hour:minute"; else echo _VALUE ;?></th>
		</tr>	
	<?php
		$k = 0 ;
		for( $i = 0 ; $i < count( $rows ) ; $i++ ) {
			$row = $rows[$i] ;
			if ( !($question_info->type == 'datetime' && $row->value == -1 ) ) {
	?>
		<tr class="<?php echo "row$k" ; ?>">
			<td align="center"><?php echo $i + $pageNav->limitstart + 1 ;?></td>
			<td ><?php if ( $question_info->type == 'datetime' ) echo date( $general_date." h:i", $row->value ) ; 
				 else echo $row->value ;
			?></td>
		</tr>
	<?php 
			}
		$k = 1 - $k ;
		}
	?>
		<tr>
			<th align="center" colspan="10"> <?php //echo $pageNav->getPagesCounter() ; ?></th>
		</tr>
		<tr>
				<td colspan="10" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td nowrap style="border:none"><?php //echo _DISPLAY ; ?> </td>
							<td style="border:none"> <?php //echo //ageNav->writeLimitBox() ; ?> </td>		
							<td style="border:none"> <?php echo $pageNav->getListFooter() ; ?></td>		        
						</tr>
				</table>
				</td>
		</tr>
	</table>
	
	<input type="hidden" name="option" value="<?php echo $option ; ?>" />
	<input type="hidden" name="task" value="<?php echo $task ; ?>" />
	<input type="hidden" name="a_id" value="<?php echo $a_id ; ?>" />
	<input type="hidden" name="lasts_id" value="<?php echo $lasts_id ; ?>" />
	<input type="hidden" name="lasttask" value="<?php echo $lasttask ; ?>" />
	<input type="hidden" name="filter_machine" value="<?php echo $post_filter ; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="<?php echo $act ; ?>" />
	</form>
	<?php	
	}


function showSurvey ( &$rows, $pageNav, $option, $act ) {
	global $mainframe,  $search_filter, $n ;
	$database = &JFactory::getDBO();
	?>
	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
							<td width="100%" ><h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL() ; ?>administrator/components/com_surveys/images/icons/surveys.png" width="48" height="48"  align="middle" /><?php echo _SURVEYS." "._MANAGER;?></h2></td>
								<td nowrap valign="bottom">
										<table height="45px" width="100%">
											<tr>
												<td align="right" colspan="2" align="right" valign="top">
													<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/create.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
											</tr>
										</table>
										<table align="right">											
											<tr>
											<td valign="middle" align="right">
											<?php echo _FILTER;?>: <input type="text" name="search_filter" value="<?php echo $search_filter;?>" class="text_area" onChange="document.adminForm.submit();" />
												</td>
												<td valign="middle">
												<input type="submit" name="submit_btn" value="<?php echo _GO;?>" />
												</td>
											</tr>	
										</table>
								</td>			
		</tr>
	</table>

	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="2%" align="center">#</th>
			<th width="2%" align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ) ; ?>);" /></th>
			<th width="25%" align="left"><?php echo _SURVEY . ' ' . _NAME1 ; ?></th>
			<th width="5%" align="center"><?php echo _COLLECT ; ?></th>
			<th width="5%" align="center"><?php echo _ACCESS ; ?></th>
			<th width="5%" align="center"><?php echo _RESPONSES ; ?></th>
			<th width="5%" align="center"><?php echo _STATS; ?></th>
			<th width="5%" align="center"><?php echo _PAGES ; ?></th>
			<th width="5%" align="center"><?php echo _QUESTIONS ; ?></th>
			<th width="6%" align="center"><?php echo _SHOW . ' ' . _RESULT ; ?></th>
			<th width="5%" align="center"><?php echo _FINISHING ; ?></th>
			<th width="5%" align="center"><?php echo _PUBLISHED ; ?></th>
			<th width="5%" align="center"><?php echo _PREVIEW ; ?></th>
			<th width="5%" colspan="2" align="center"><?php echo _REORDER ; ?></th>
			<th width="9%" align="center" valign="middle"> 
				<table align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding-left:0px;padding-right:0px;border:none"><?php echo _ORDER ; ?></td>
						<td style="padding-left:2px;padding-right:0px;border:none"><a href="javascript: saveorder( <?php echo count( $rows ) - 1 ; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a></td>
					</tr>
				</table>
			</th>
		</tr>
	<?php
		$k = 0 ;
		for( $i = 0; $i < count( $rows ); $i++ ) {
			$row = &$rows[$i] ;
			$img = $row->published ? 'tick.png' : 'publish_x.png' ;
			$task = $row->published ? 'unpublish' : 'publish' ;
			$showr = $row->show_result ? "unshowresult" : "showresult" ;
			$database->setQuery( "SELECT q_id FROM #__ijoomla_surveys_questions WHERE s_id=$row->s_id" ) ;
			$database->query() ;			
					if ($database->getErrorMsg()){										
							die($database->getErrorMsg());
					}			
			$noofquestions = $database->getNumRows() ;
			$database->setQuery( "SELECT count(page_id) FROM #__ijoomla_surveys_pages WHERE s_id=$row->s_id" ) ;
			list( $blocks ) = $database->loadResult() ;	
			$show_result = $row->show_result ? 'tick.png' : 'publish_x.png' ;
			
			$access = JCommonHTML::AccessProcessing( $row, $i );
			$database->setQuery("SELECT count( session_id ) "
								. "FROM #__ijoomla_surveys_session " 
								. "WHERE s_id =" . $row->s_id . " AND (completed = '1' and last_page_id = 0)") ;
			list( $responses ) = $database->loadRow() ;
	?>
		<tr class="<?php echo "row$k" ; ?>">
			<td align="center"><?php echo $i + $pageNav->limitstart + 1 ; ?></td>
			<td align="center"><input type="checkbox" id="cb<?php echo $i;?>" name="s_id[]" value="<?php echo $row->s_id ; ?>" onclick="isChecked(this.checked);" /></td>
			<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i ; ?>','edit')"><?php echo stripslashes($row->title) ; ?></a></td>
			<td align="center"><a href="#collect" onclick="return listItemTask('cb<?php echo $i ; ?>','collect')"><?php echo _COLLECT ; ?></a></td>
			<td align="center"><?php echo $access ; ?></td>
			<td align="center"> <a href="#responses" onclick="return listItemTask('cb<?php echo $i ; ?>','responses')"><?php echo $responses ; ?></a>	</td>
			<td align="center">
			<?php 
				if ( $responses > 0 ) {
			?>
			<a href="#analyze" onclick="return listItemTask('cb<?php echo $i ; ?>','analyze')"><?php echo _STATS ; ?></a>
			<?php }
			else {
			?>
			<?php echo _STATS ; ?>
			<?php } ?>
			</td>
	
			<td align="center"><a href="index2.php?option=<?php echo $option ; ?>&act=block&s_id=<?php echo $row->s_id ; ?>"><?php echo $blocks ; ?></a></td>
			<td align="center"><a href="index2.php?option=<?php echo $option ; ?>&act=question&s_id=<?php echo $row->s_id ; ?>"><?php echo $noofquestions ; ?></a></td>
			<td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i ; ?>','<?php echo $showr ; ?>')"> <img src="images/<?php echo $show_result ; ?>" border="0" alt=""> </a></td>
			<td align="center"><?php echo $row->form_target ; ?></td>
			<td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i ; ?>','<?php echo $task ; ?>')"><img src="images/<?php echo $img ; ?>" border="0" alt="" /></a></td>
			<td align="center"><a target="_blank" href="<?php echo $mainframe->getSiteURL() ; ?>administrator/index.php?option=com_surveys&preview=preview&s_id=<?php echo $row->s_id ; ?>&preview_start=yes"><?php echo _PREVIEW ; ?></a></td>
			<td align="center">
				<?php echo $pageNav->orderUpIcon( $i ) ; ?>
			</td>
			<td align="center">
				<?php echo $pageNav->orderDownIcon( $i, $n ) ; ?>
			</td>
			<td align="center">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering ; ?>" class="text_area" style="text-align: center" />
				</td>
		</tr>
	<?php
			$k = 1 - $k ;
		}
	?>
		<tr>
			<th align="center" colspan="16"> <?php //echo $pageNav->getPagesCounter() ; ?></th>
		</tr>
		<tr>
				<td colspan="16" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td nowrap style="border:none"><?php //echo _DISPLAY ; ?> </td>
							<td style="border:none"> <?php //echo $pageNav->getLimitBox() ; ?> </td>		
							<td style="border:none"> <?php echo $pageNav->getListFooter() ; ?></td>		        
						</tr>
				</table>
				</td>
		</tr>
	</table>
	
	<input type="hidden" name="option" value="<?php echo $option ; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="<?php echo $act ; ?>" />
	</form>
	<?php
	}

function showresponses( &$rows, $s_id, $pageNav, $option ,$act ) {
	global $mainframe;
	$database = &JFactory::getDBO();
	?>
	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<th width="100%"><?php echo _RESPONSES;?></span></th>
		</tr>
		<tr>
			<td align="right" colspan="3" nowrap>
				<?php echo _FILTER ; ?>:
				<select name="field">
					<option value="name"> <?php echo _NAME ; ?> </option>	
					<option value="username"> <?php echo _USERNAME ; ?> </option>	
					<option value="email"> <?php echo ucfirst(_EMAIL) ; ?> </option>
					<option value="ip"> <?php echo _IP;?> </option>
				</select>
				<input type="text" name="search" value="<?php if (isset($_POST['search']) && trim($_POST['search'])!="" && $_POST['search']!= "<br />") {echo $_POST['search'];}?>" class="text_area" onChange="document.adminForm.submit('searchreponse');" />
							<input type="submit" name="submit_btn" value="<?php echo _GO;?>" />			
			</td>
		</tr>
	</table>

	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="5">#</th>
			<th width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ) ; ?>);" /></th>
			<th width="15%"><?php echo _NAME1 ; ?></th>
			<th width="15%"><?php echo _USERNAME ; ?></th>
			<th width="20%"><?php echo _EMAIL . ' ' . _ADDRESS ; ?></th>
			<th width="10%"><?php echo _IP." "._ADDRESS ; ?></th>
			<th width="20%" align="center"><?php echo _DATE_TIME ; ?></th>
			<th width="10%" align="center"><?php echo _PUBLISHED ; ?> </th>
			<th width="10%" align="center"><?php echo _VIEW . ' ' . _RESPONSE ; ?></th>
		 </tr>
	<?php
		$k = 0 ;
		for( $i = 0; $i < count( $rows ); $i++ ) {
						$row = &$rows[$i] ;
				//Custom for Newsletter Survey because want to show user's answer not Register Member, so set s_id =1
				if ($row->s_id!=1){
					if ( $row->user_id != 0 ) {
						$database->setQuery( "SELECT  name,username,email FROM #__users WHERE id=$row->user_id" ) ;
						list( $name, $username, $email ) = $database->loadRow() ;	
					}
					else {
						$name="N/A";				
						$username = "N/A" ;
						$email = "N/A" ;
					}
			}else {
				  			$database->setQuery( "SELECT  value as name FROM jos_ijoomla_surveys_result_text WHERE session_id=$row->session_id and q_id=1" ) ;
								list( $name ) = $database->loadRow() ;	
				  			$database->setQuery( "SELECT  value as email FROM jos_ijoomla_surveys_result_text WHERE session_id=$row->session_id and q_id=5" ) ;
								list( $email ) = $database->loadRow() ;	
								$username = "N/A" ;
			}
			$img = $row->published == 0 ? "publish_x.png" : "tick.png" ;
			$publish = $row->published == 0 ? "rpublish" : "runpublish" ;
	?>
		<tr class="<?php echo "row$k" ; ?>">
			<td align="center"><?php echo $i + $pageNav->limitstart + 1 ; ?></td>
			<td ><input type="checkbox" id="cb<?php echo $i ;?>" name="session_id[]" value="<?php echo $row->session_id ; ?>" onclick="isChecked(this.checked);" /></td>
			<td ><?php echo $name ; ?></td>
			<td ><?php
				if ( $username != "N/A" ) echo "<a href='index2.php?option=com_users&task=editA&id=$row->user_id&hidemainmenu=1'> $username </a>" ;
				else echo $username ;
			?>
			</td>
			<td><?php echo $email ; ?></td>
			<td><?php echo $row->ip ; ?></td>
			<td align="center"><?php echo date("m/d/Y H:i",$row->played_time); ?></td>
			<td align="center"><a href="#<?php echo $publish ; ?>" onclick="return listItemTask('cb<?php echo $i ; ?>','<?php echo $publish ; ?>')"><img src="images/<?php echo $img ; ?>" border="0" alt="0"></a>	</td>
			<td align="center"> <a href="#ShowRespondent" onclick="return listItemTask('cb<?php echo $i ; ?>','showrespondent')"><?php echo _VIEW ; ?></a>	</td>
		</tr>
	<?php
			$k = 1 - $k ;
		}
	?>
		<tr>
			<th align="center" colspan="9"> <?php echo $pageNav->getPagesCounter() ; ?></th>
		</tr>
		<tr>
				<td colspan="9" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						
				</table>
				<?php echo $pageNav->getListFooter(); ?>
				</td>
		</tr>		
	</table>
	
	<input type="hidden" name="option" value="<?php echo $option ; ?>" />
	<input type="hidden" name="task" value="responses" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="responses" value="yes" />
	<input type="hidden" name="s_id[]" value="<?php echo $s_id ; ?>" />
	<input type="hidden" name="act" value="<?php echo $act ; ?>" />
	</form>
<?php
}

function export_data($s_id,$option,$act,$lasttask){
		global $mainframe;
		$database = &JFactory::getDBO();
		
		$CSV_limit = 200;
		
		$database->setQuery("SELECT title,published FROM #__ijoomla_surveys_surveys WHERE s_id=$s_id");
		$database->query() ;
	if ( $database->getErrorMsg() ){
		die( $database->getErrorMsg() ) ;		
	}
		$result = $database->loadAssocList();
		
		$survey_name = $result[0]['title'];
		$survey_status = $result[0]['published'] == 1 ? "Active" : "Finished";
		
	$img = $result[0]['published'] ? 'tick.png' : 'publish_x.png' ;
	$task = $result[0]['published'] ? 'force_unpublish' : 'force_publish' ;
	
	$sql = "SELECT COUNT(*) FROM #__ijoomla_surveys_session WHERE s_id = $s_id AND (completed = '1' OR last_page_id <> '0')";
		$database->setQuery($sql);// AND completed = '1'
		$database->query() ;
	if ( $database->getErrorMsg() ){
		die( $database->getErrorMsg() ) ;		
	}

	$survey_responses = $database->loadResult();
?>
		<form action='index2.php' method='post' name='adminForm'>
	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
					<td colspan="6" align="left"><span class='sectionname'><?php echo _EXPORT_DATA?></span></td>
			</tr>
		<tr>
			<th width="2%" align="center"><?php echo _ID;?></th>
			<th width="25%" align="left"><?php echo _SURVEY . ' ' . _NAME1 ; ?></th>			
			<th width="16%" align="center"><?php echo _PUBLISHED ; ?></th>
			<th width="16%" align="center"><?php echo _STATUS ; ?></th>
			<th width="16%" align="center"><?php echo _RESPONSES ; ?></th>
			<th width="25%" align="center"><?php echo _DOWNLOAD ; ?></th>			
		</tr>
		<tr>
				<td align="center"><?php echo $s_id?></td>
				<td align="left"><?php echo $survey_name?></td>		    
				<td align="center"><a href="javascript: void(0);" onclick="return submitbutton('<?php echo $task ; ?>')"><img src="images/<?php echo $img ; ?>" border="0" alt="" /></a></td>
				<td align="center"><?php echo $survey_status?></td>
				<td align="center"><?php echo $survey_responses?></td>
				<td align="center"></td>
		</tr>
		<?php 
				if ($survey_responses > $CSV_limit){
						$step = $CSV_limit;
						$number_steps = ceil($survey_responses / $CSV_limit);
				}else{
						$step = $survey_responses;
						$number_steps = 1;
				}
				for ($i=1; $i<=$number_steps; $i++){
						$low_limit = ($i-1)*$step+1;
						$high_limit= $i*$step;
						if ($high_limit > $survey_responses){
								$high_limit = $survey_responses;
						}
		?>        
		<tr>
				<td align="center"></td>
				<td align="right"></td>		    
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"><?php if ($low_limit!=$high_limit) {echo $low_limit." to ".$high_limit;} else {echo $low_limit;}?></td>
				<td align="center"><a href="<?php echo $mainframe->getSiteURL() ; ?>administrator/index.php?option=com_surveys&export=export&s_id=<?php echo $s_id?>&start=yes&limit_start=<?php echo $low_limit?>&limit_finish=<?php echo $high_limit;?>" target="_blank"><?php echo strtoupper(_DOWNLOAD)?></a></td>
		</tr>
		<?php   
				}
		?>
				<tr>
			<th align="center" colspan="6">&nbsp;</th>
		</tr>		
	</table>	
	<input type="hidden" name="option" value="<?php echo $option ; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="lasttask" value="analyze" />
	<input type="hidden" name="lasts_id" value="<?php echo $s_id ; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="<?php echo $act ; ?>" />
	<input type="hidden" name="filter_machine" value="<?php echo $filter ; ?>" />
	<input type="hidden" name="filter_text" value="<?php echo $filter_text ; ?>" />
	<input type="hidden" name="analyze_form" value="yes" />
	<input type="hidden" name="s_id[]" value="<?php echo $s_id ; ?>" />
	</form>
		<?php					
}

function analyze ( $s_id, $filter = '', $filter_text = "", $option, $act, $lasttask='' ) {
	global $mainframe,  $task, $css_totalbackground , $css_question , $css_tablerow1 , $css_tablerow2;
	$database = &JFactory::getDBO();
	$database->setQuery( "SELECT * FROM #__ijoomla_surveys_surveys WHERE s_id=$s_id LIMIT 1" ) ; 
	$database->query() ;
	
	$extra_cond="";
	if ($filter){
		 $extra_cond=" AND session_id IN ($filter) ";
	}
	if ( $database->getErrorMsg() ){
		die( $database->getErrorMsg() ) ;		
	}
	if ( $database->getNumRows()>0 ) {
		$survey = $database->loadAssocList() ;	
		$survey_info = $survey[0] ;
		
			$status_bar_img_path = $mainframe->getSiteURL() . "/administrator/components/com_surveys/images/Blue_dot.png" ;
	?>
		<script language="javascript" type="text/javascript">
			function SetCookie ( cookieName, cookieValue, nDays ) {
				 var today = new Date() ;
				 var expire = new Date() ;
				 if ( nDays == null || nDays == 0) nDays = 1 ;
				 expire.setTime(today.getTime() + 3600000 * 24 * nDays ) ;
				 document.cookie = cookieName + "=" + escape( cookieValue )
												 + ";expires=" + expire.toGMTString() ;
			}
			
			function settask ( lasttaskx, taskx, id ) {
				document.adminForm.task.value = taskx ;
				document.adminForm.lasttask.value = lasttaskx ;
				document.adminForm.q_id.value = id ;
				submitform( taskx ) ;
			}
			function settaskexport ( lasttaskx, taskx ) {
				document.adminForm.task.value = taskx ;
				document.adminForm.lasttask.value = lasttaskx ;
				submitform( taskx ) ;
			}			
			function settaskanswer ( lasttaskx, taskx, id ) {
				document.adminForm.task.value = taskx ;
				document.adminForm.lasttask.value = lasttaskx ;
				document.adminForm.a_id.value = id ;
				submitform( taskx ) ; 
			}
			function settaskfilter ( taskx, q_id, m_id, a_id, ac_id ) {
				document.adminForm.task.value = taskx ;
				document.adminForm.q_id.value = q_id ;
				document.adminForm.m_id.value = m_id ;
				document.adminForm.a_id.value = a_id ;
				document.adminForm.ac_id.value = ac_id ;
				
				submitform( taskx ) ;
			}
			function clear() {
				if ( confirm( 'Are you sure ?' ) ) submitform( 'clear_filter' ) ;
				else return false ;
			}
			
		</script>
<?php 
		echo "<form action='index2.php' method='post' name='adminForm'>
		<table width='100%' align='left' cellpadding='5'>
		<tr><td width='60%' align='left'><span class='sectionname' >"._RESULTS." "._SUMMARY."</span> <h2 style='color:#669900'>Survey: ".$survey_info["title"]."</h2> ";
		if ( $task == 'showrespondent' ) {
			$sql = "SELECT u.name,u.username,u.email,s.ip FROM #__users as u, #__ijoomla_surveys_session as s WHERE s.user_id=u.id $extra_cond  LIMIT 1";
			$database->setQuery( $sql ) ;
			if (!$database->query()){
					echo "SQL ERROR in query :".$database->getQuery();
			}
			if ($database->getNumRows()>0){
					list( $name, $username, $email, $ip ) = $database->loadRow() ;	
			}else{
					$database->setQuery("SELECT s.ip FROM #__ijoomla_surveys_session as s WHERE 1 $extra_cond");
					if (!$database->query()){
							echo "SQL ERROR in query :".$database->getQuery();
					}
					$respondent_ip = $database->loadResult();
					$name = $username = $email = "N/A";
					$ip = $respondent_ip;
			}
			echo "<b>" . _NAME1 . ": </b>$name <br />" ; 
			echo "<b>" . _USERNAME . ": </b>$username <br />" ;
			echo "<b>" . ucfirst(_EMAIL) . " </b>$email <br />" ;
			echo "<b>" ._IP. ": </b>$ip <br />" ;
		}
		else {
			if ( !$filter_text )
			echo "<p>
			"._CLICK_TO." <b> " . _RESPONSE . ' ' . _TOTAL . "</b> of <b>" . _ANSWER . " X </b>" . _IN . " <b>" . _QUESTION . " Y</b> " . _TO . " " . _FILTER . " " . _RESPONDENTS . " " . _CHOOSE . " <b>X</b> " . _IN . " <b>" . _QUESTION . " Y</b>
			</p> " ;
			else { 
				 echo "<b>"._FILTER." :</b> " ;
				 echo "<a href='#clearfilter' onClick='submitform(\"clear_filter\")'> "._CLEAR." "._FILTER." </a>" ;
				 echo "<br />" . $filter_text ;
			}
		}
		echo "</td>
		<td width='40%' align='right'>
				<input type=\"button\" onclick=\"settaskexport('$task','export_data')\" value=\""._EXPORT_DATA."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a target=\"_blank\" href=\"http://www.ijoomla.com/redirect/survey/videos/export.htm\" class=\"video\">Video Tutorial <img src=\"components/com_surveys/images/icon_video.gif\"></a>
		</td>					
		</tr>" ;
				echo "<tr><td width='100%' colspan=2 align='left' valgin='top'>" ;
				// QUESTION 
				
				$database->setQuery( "SELECT q.*,p.ordering FROM #__ijoomla_surveys_questions as q, #__ijoomla_surveys_pages as p WHERE q.s_id=$s_id AND p.s_id=$s_id AND q.page_id=p.page_id AND q.published=1 AND p.published=1 ORDER BY p.ordering ASC, q.ordering ASC" ) ;
					
				$database->query() ;
				if ( $database->getErrorMsg() ){
						die( $database->getErrorMsg() ) ;
				}
				if ( $database->getNumRows() > 0 ) { 
						$questions = $database->loadAssocList() ;	
						$ii = 1 ;
						foreach( $questions as $q_info ) {	
								$database->setQuery( "SELECT DISTINCT session_id FROM #__ijoomla_surveys_result WHERE q_id='" . $q_info["q_id"] . "' $extra_cond") ;
								$database->query() ;
								
								if ( $database->getErrorMsg() ){
										die( $database->getErrorMsg() ) ;
								}
							$total_respondents = $database->getNumRows() ;
							
							if ($q_info['type']=="checkbox"&&$q_info['orientation']=="vertical"){
									$final_sess_array = array();
									
									$session_result_array= $database->loadAssocList();
									
									 foreach ($session_result_array as $nr_sess => $sess_array){
																		array_push($final_sess_array,$sess_array['session_id']);
																}
							
							}
								$database->setQuery( "SELECT DISTINCT session_id FROM #__ijoomla_surveys_result_text WHERE q_id='" . $q_info["q_id"] . "' $extra_cond") ;
								$database->query() ;
							 
								if ( $database->getErrorMsg() ){
											die( $database->getErrorMsg() ) ;	       					    
								}
								 
								if ($q_info['type']=="checkbox"&&$q_info['orientation']=="vertical"){
										$session_result_array2 = $database->loadAssocList();
										foreach ($session_result_array2 as $nr_sess => $sess_array2 ){
												if (!in_array($sess_array2['session_id'],$final_sess_array)){
														array_push($final_sess_array,$sess_array2['session_id']);
												}
										}
										
										$total_respondents = count($final_sess_array);
								}else{
										$total_respondents += $database->getNumRows() ;
								}

								echo "<table width='100%' >" ;
								echo "<tr><td align='left' style='border:1px solid #CCCCCC' class='$css_question'><b>$ii . " . $q_info["title"] . "</b></td></tr>" ;
								echo "<tr><td valign='top'>" ;
							
							if ( $q_info["orientation"] != 'matrix' && $q_info["orientation"] != 'open' ) {	
								echo "<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >" ;
								echo "<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center'><b>" . _RESPONSE . " <br /> " . _PERCENT."</b></td><td width='13%' align='center'><b>" . _RESPONSE . " <br /> " . _TOTAL . "</b></td></tr>" ; 
								$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " $extra_cond" ) ;
								$database->query() ;
															if ($database->getErrorMsg()){										
																	die($database->getErrorMsg());
															}								
								$total_answers = $database->getNumRows() ;
							
								
								
									if ( $q_info["other_field"] != 0 ) {
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result_text WHERE q_id=" . $q_info["q_id"] . " $extra_cond" ) ;
										$database->query() ;
																	if ($database->getErrorMsg()){										
																			die($database->getErrorMsg());
																	}    								
										$other = $database->getNumRows() ;
										$total_answers += $other ;
								}
								
								$database->setQuery( "SELECT count( r_id ) , a_id FROM #__ijoomla_surveys_result WHERE q_id =" . $q_info["q_id"] . " AND a_id<>0 $extra_cond GROUP BY a_id ORDER BY `count( r_id )` DESC LIMIT 1") ;
								list( $most, $most_id ) = $database->loadRow() ;									
								
											
								
								$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC") ;
								$database->query() ;
															if ($database->getErrorMsg()){										
																	die($database->getErrorMsg());
															}								
								$Num_answer = $database->getNumRows() ;
							
								if ( $Num_answer > 0 ) {
									$answers = $database->loadAssocList() ;
									$i = 0 ;
									foreach( $answers as $a_info )	{
										$database->setQuery( "SELECT count(r_id) FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $a_info["a_id"] . " $extra_cond LIMIT 1" ) ;
										list( $nums_chooser ) = $database->loadRow() ;

										if ( $database->getErrorMsg() ){
											die( $database->getErrorMsg() ) ;
										}

										if ( $nums_chooser == $most ) {
												$bold = "style='font-weight:bold' " ;
										}
										else {
												$bold = '' ;
										}
												echo "<tr $bold>" ;
												echo "<td align='right' stype='padding-right:4px'" ;

										if ( $i%2 == 0 ) {
												echo "class='$css_tablerow1'" ;
										}else {
												echo "class='$css_tablerow2'" ;
										}
												echo ">" . stripslashes($a_info["value"]) . "</td>" ;
											
										if ( $total_answers != 0) {
												$percent = 100 * floatval( $nums_chooser / $total_answers ) ;
										}
										else {
												$percent = 0 ;
										} 
												echo "<td align='left' stype='padding-left:4px'><img src='$status_bar_img_path' height='13' width='" . intval($percent) . "%'></td>" ;
												echo "<td align='center' >" ; 
												printf( "%2.2f", $percent ); 
												echo "%</td>" ;

										if ( $nums_chooser > 0 ) {
												$ft = "<a href='#filter' onclick='settaskfilter(\"analyze\"," . $q_info["q_id"] . ",0," . $a_info["a_id"] . ",0)'>$nums_chooser</a>" ;
										}
										else {
												$ft = $nums_chooser ;
										}
												echo "<td align='center' >$ft</td>" ;
												echo "</tr>" ;
												$i++ ;
											}
									}
										if ( $q_info["other_field"] != 0 ) {
										echo "<tr>" ;
										echo "<td align='right'>" . $q_info["other_field_title"] . "</td>" ;
							
											if ( $total_answers != 0 ) {
													$percent = 100 * floatval( $other / $total_answers ) ;
											}
											else {
													$percent = 0 ;
											}
										echo "<td align='left'><img src='$status_bar_img_path' height='13' width='" . intval( $percent ) . "%'></td>" ;
										echo "<td align='center'>" ;
										printf( "%2.2f", $percent ) ;
										echo "%</td>" ;
										if ($other>0){
										echo "<td align='center'><a href='#other' onClick='settask(\"$task\",\"view_result_text\"," . $q_info["q_id"] . ")' >$other "._VIEW_TEXT."</a></td>" ;
										}else{
										echo "<td align='center'>$other</td>" ;    
										}
										echo "</tr>" ;
									}
									echo "<tr><td colspan='3' align='right'><b>" . _TOTAL . ' ' . _RESPONDENTS . ": </b></td><td align='center' bgcolor='$css_totalbackground'><b>$total_respondents</b></td></tr>" ;
									echo "</table>" ; 
								}
								 
								elseif ( $q_info["orientation"] == 'open' ) {

									if ( $q_info["type"] == 'constant' ) {
										$database->setQuery( "SELECT sum( value ) FROM `#__ijoomla_surveys_result` WHERE q_id =" . $q_info["q_id"] . " $extra_cond") ;
										list( $total_answers ) = $database->loadRow() ;
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC") ;
										$database->query() ;
																			if ($database->getErrorMsg()){										
																					die($database->getErrorMsg());
																			}											
										echo "<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >" ;
										echo "<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center'><b>" . _RESPONSE . " <br />" . _PERCENT . "</b></td><td width='13%' align='center'><b>" . _RESPONSE . " <br /> " . _TOTAL . "</b></td></tr>" ;

											if ( $database->getNumRows() > 0 ) {
												$answers = $database->loadAssocList() ;
												$database->setQuery( "SELECT sum( value ) , a_id "
																	 . "FROM #__ijoomla_surveys_result "
																	 . "WHERE q_id =".$q_info["q_id"]." AND a_id<>0 $extra_cond"
																	 . "GROUP BY a_id	ORDER BY `sum( value )` DESC LIMIT 1" ) ;
														 
													list( $most, $most_id ) = $database->loadRow() ;
													$i = 0 ;
											
													foreach ( $answers as $a_info ) {
														$database->setQuery( "SELECT sum(value) FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $a_info["a_id"] . " $extra_cond") ;
														list( $nums_chooser ) = $database->loadRow() ;
				
															if ( $nums_chooser == $most ) {
																	$bold = "style='font-weight:bold' " ;
															}
															else {
																	$bold = '' ;
															}
																	echo "<tr $bold>" ;
																	echo "<td align='right' stype='padding-right:4px'" ;
						
															if ( $i%2 == 0 ) {
																	echo "class='$css_tablerow1'" ;
															}
															else {
																	echo "class='$css_tablerow2'" ;
															}
																		echo ">" ;
						
															if ( $nums_chooser != 0 ) {
																	echo "<a href='#detail' onClick='settaskanswer(\"".$task."\",\"view_result_value\",\"" . $a_info["a_id"] . "\")' > <b>"._VIEW." "._DETAIL."</b> </a> &nbsp;&nbsp;&nbsp;" ;
															}
																		echo stripslashes($a_info["value"]) . "</td>" ;
						
															if ( $total_answers != 0 ) {
																	$percent = 100 * floatval( $nums_chooser / $total_answers ) ;
															}
															else {
																	$percent = 0 ;
															}
														echo "<td align='left' stype='padding-left:4px'><img src='$status_bar_img_path' height='13' width='" . intval( $percent ) . "%'></td>" ;
														echo "<td align='center' >" ;
														printf( "%2.2f", $percent ) ;
														echo "%</td>" ;
														echo "<td align='center' >$nums_chooser</td>" ;
														echo "</tr>" ;
													} 
											}
											echo "<tr><td colspan='3' align='right'><b>" . _TOTAL . ' ' . _RESPONDENTS . ": </b></td><td align='center' bgcolor='" . $css_totalbackground . "'><b>$total_respondents</b></td></tr>" ;
											echo "</table>" ;
										}
									elseif ( $q_info["type"] == 'moreline' ) {
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC") ;
										$answers = $database->loadAssocList() ;
										
										$sql = "SELECT count(r_id) FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " $extra_cond LIMIT 1" ;
										$database->setQuery( $sql ) ;
										list( $total_answers ) = $database->loadRow() ;

											if ( $database->getErrorMsg() ) {
													die( $database->getErrorMsg() ) ;										
											}
											echo "<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >" ;
											echo "<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center'><b>" . _RESPONSE . " <br />" . _PERCENT . "</b></td><td width='13%' align='center'><b>" . _RESPONSE . " <br /> " . _TOTAL . "</b></td></tr>" ;										
											$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC" ) ;
											$database->query() ;
																			if ($database->getErrorMsg()){										
																					die($database->getErrorMsg());
																			}    									
											$Num_answer = $database->getNumRows() ;
									
											if ( $Num_answer > 0 ) {
														$sql = "SELECT count( r_id ) , a_id "
															 . "FROM #__ijoomla_surveys_result "
															 . "WHERE q_id =".$q_info["q_id"]." AND a_id<>0 AND value<>'' $extra_cond "
															 . "GROUP BY a_id	ORDER BY `count( r_id )` DESC	LIMIT 1" ;
												$database->setQuery( $sql ) ;
												list( $most, $most_id ) = $database->loadRow() ;
											
													if ( $database->getErrorMsg() ){
															die( $database->getErrorMsg() ) ;
													}
											$i = 0 ;
											$database->setQuery( $sql ) ;
											list( $most, $most_id ) = $database->loadRow() ;
											$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC" ) ;											
											$answers = $database->loadAssocList() ;
											foreach ( $answers as $a_info ) {	
												$database->setQuery( "SELECT count(r_id) FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $a_info["a_id"] . " $extra_cond LIMIT 1") ;											
												list( $nums_chooser ) = $database->loadRow() ;
												if ( $nums_chooser == $most ) {
														$bold = "style='font-weight:bold' " ;
												}
												else {
														$bold = '' ;
												}
														echo "<tr $bold>" ;
														echo "<td align='right' stype='padding-right:4px'" ;
												if ( $i%2 == 0 ) {
														echo "class='$css_tablerow1'" ;
												}
												else {
														echo "class='$css_tablerow2'" ;
												}
														echo ">" ;
												if ( $nums_chooser > 0 ) {
														echo "<a href='#detail' onClick='settaskanswer(\"".$task."\",\"view_result_value\",\"" . $a_info["a_id"] . "\")' > <b>"._VIEW." "._DETAIL."</b> </a> &nbsp;&nbsp;&nbsp;" ;
												}
												echo stripslashes($a_info["value"]) . "</td>" ;

												if ( $total_answers != 0) {
														$percent = 100 * floatval( $nums_chooser / $total_answers ) ;
												}
												else {
														$percent = 0 ;
												}
														echo "<td align='left' stype='padding-left:4px'><img src='$status_bar_img_path' height='13' width='" . intval( $percent ) . "%'></td>" ;
														echo "<td align='center' >" ;
														printf( "%2.2f", $percent ) ;
														echo "%</td>" ;
														echo "<td align='center' >$nums_chooser</td>" ;
														echo "</tr>" ;
											}
										}
										echo "<tr><td colspan='3' align='right'><b>" . _TOTAL . ' ' . _RESPONDENTS . ": </b></td><td align='center' bgcolor='" . $css_totalbackground . "'><b>$total_respondents</b></td></tr>" ;
										echo "</table>" ;
									}
									elseif( $q_info["type"] == 'datetime' ) {
										echo "<table width='100%' border='1' style='border-collapse:collapse;border:1px solid #CCCCCC' >" ;
										echo "<tr><td width='25%'></td><td width='50%'></td><td width='12%' align='center'><b>" . _RESPONSE . " <br /> " . _PERCENT . "</b></td><td width='13%' align='center'><b>" . _RESPONSE . " <br /> " . _TOTAL . "</b></td></tr>" ;
										
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND value>0 $extra_cond" ) ;											
										$database->query() ;
																			if ($database->getErrorMsg()){										
																					die($database->getErrorMsg());
																			}										
										$total_answers = $database->getNumRows() ;
										if ( $q_info["other_field"] != 0 ) {
											$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result_text WHERE q_id=" . $q_info["q_id"] . " $extra_cond") ;											
											$database->query() ;
																					if ($database->getErrorMsg()){										
																							die($database->getErrorMsg());
																					}											
											$other = $database->getNumRows() ;
											$total_answers += $other ;
										}
										
										$database->setQuery( "SELECT count( r_id ) , a_id "
															 . "FROM #__ijoomla_surveys_result "
															 . "WHERE q_id =".$q_info["q_id"]." AND value>0 $extra_cond "
															 . "GROUP BY a_id "
															 . "ORDER BY `count( r_id )` DESC "
															 . "LIMIT 1" ) 
															 ;
										list( $most, $most_id ) = $database->loadRow() ;
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC" ) ;											
										$database->query() ;																				
																			if ($database->getErrorMsg()){										
																					die($database->getErrorMsg());
																			}										
										if ( $database->getNumRows() > 0 ) {
											$answers = $database->loadAssocList() ;										
											foreach( $answers as $a_info ) {												
												$database->setQuery( "SELECT count(r_id) FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $a_info["a_id"] . " AND value>0 $extra_cond LIMIT 1" ) ;											
												list( $nums_chooser ) = $database->loadRow() ;												
												if ( $nums_chooser == $most ) {
														$bold = "style='font-weight:bold' " ;
												}
												else {
														$bold = '' ;
												}
												echo "<tr $bold>" ;
												echo "<td align='right' stype='padding-right:4px'>" ;
												if ( $nums_chooser > 0 ) {
														echo "<a href='#detail' onClick='settaskanswer(\"".$task."\",\"view_result_value\",\"" . $a_info["a_id"] . "\")' > <b>"._VIEW." "._DETAIL."</b> </a> &nbsp;&nbsp;&nbsp;" ;
												}
												echo $a_info["value"] . "</td>" ;
																					
												if ( $total_answers != 0 ) {
														$percent = 100 * floatval( $nums_chooser / $total_answers ) ;
												}
												else {
														$percent = 0 ;
												}
												echo "<td align='left' stype='padding-left:4px'><img src='$status_bar_img_path' height='13' width='" . intval( $percent ) . "%'></td>" ;
												echo "<td align='center' >" ;
												printf( "%2.2f", $percent ) ;
												echo "%</td>" ;
												echo "<td align='center' >$nums_chooser</td>" ;
												echo "</tr>" ;
											}
										}
										echo "<tr><td colspan='3' align='right'><b>" . _TOTAL . ' ' . _RESPONDENTS . ": </b></td><td align='center' bgcolor='$css_totalbackground'><b>$total_respondents</b></td></tr>" ; 
										echo "</table>" ;
									}
									else { // OPEN TEXT
										$database->setQuery( "SELECT count(q_id) FROM #__ijoomla_surveys_result_text WHERE q_id=" . $q_info["q_id"] . " $extra_cond" ) ;											
										list( $totalanswers ) = $database->loadRow() ;	
										echo "<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'>" ;
										echo "<tr>" ;
										echo "<td align='left' width='50%'><b>Total Respondents</b> </td>" ;
										if ($totalanswers>0){
										echo "<td align='left' width='50%'  bgcolor='$css_totalbackground' style='padding-left:20px'><a href='#other' onClick='settask(\"$task\",\"view_result_text\",\"" . $q_info["q_id"] . "\")' ><b>" . $totalanswers . " &nbsp;&nbsp; " . _VIEW . ' ' . _DETAIL . "</a></b></td>";
										}else{
										echo "<td align='left' width='50%'  bgcolor='$css_totalbackground' style='padding-left:20px'><b>". $totalanswers . "</b></td>";    
										}
										echo "</tr></table>	" ;
									}
								}
								else { // MATRIX
									if ( $q_info["type"] != 'menu' ) {
										echo "<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'><tr>" ;
										echo "<td width='25%'></td>" ;
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=" . $q_info["q_id"] . " ORDER BY ac_id ASC" ) ;											
										$database->query() ;
										if ($database->getErrorMsg()){										
												die($database->getErrorMsg());
										}
										$total_c = $database->getNumRows() ;
										if ( $total_c > 0 ) {
											$columns = $database->loadAssocList() ;
											$c_width = intval( 60 / $total_c ) ;
											foreach ( $columns as $c_info ) {
												echo "<td width='$c_width%' align='center'><b>" . stripslashes($c_info["value"]) . "</b></td>" ;
												$column_info[] = $c_info["ac_id"] ;
											}
										}
										echo "<td width='15%' align='center'><b>" . _RESPONSE . " <br /> " . _TOTAL . "</b></td> </tr>" ;
																				
										$total_answers = 0 ;
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"] . " ORDER BY a_id ASC" ) ;											
										$database->query() ;
										if ($database->getErrorMsg()){										
												die($database->getErrorMsg());
										}										
										$total_rows = $database->getNumRows() ;
										if ( $total_rows > 0 ) {
											$rows = $database->loadAssocList() ;
											$i = 0 ;
											foreach ($rows as $row_info ) {
													$database->setQuery("SELECT COUNT(*) FROM #__ijoomla_surveys_result as r,#__ijoomla_surveys_session as s WHERE q_id=".$q_info["q_id"]." AND a_id=".$row_info["a_id"]." AND r.session_id=s.session_id and s.published=1");																			
																								if (!$database->query()){
																										die($database->getErrorMsg());
																								}
												$total_answers_per_row=$database->loadResult();	
												$database->setQuery( "SELECT count( r_id ) , ac_id "
																	 . "FROM #__ijoomla_surveys_result "
																	 . "WHERE q_id =" . $q_info["q_id"] 
																	 . " AND ac_id<>0 AND a_id=" . $row_info["a_id"]." $extra_cond "
																	 . "GROUP BY ac_id "
																	 . "ORDER BY `count( r_id )` DESC "
																	 . "LIMIT 1" )
																	 ;														
												$database->query() ;		
														if ($database->getErrorMsg()){										
																die($database->getErrorMsg());
														}												
												list( $most, $most_id ) = $database->loadRow() ; 
												$total_answers += $total_answers_per_row ;
												echo "<tr>" ;
												echo "<td align='right' style='padding-right:5px'" ;
												if ( $i%2 == 0 ) {
														echo "class='$css_tablerow1'" ;
												}
												else {
														echo "class='$css_tablerow2'" ;
												}
												echo ">" . stripslashes($row_info["value"]) . "</td>" ;
												foreach ( $column_info as $ac_id ) {
													$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $row_info["a_id"] . " AND ac_id=" . $ac_id . " $extra_cond") ;
													$database->query() ;
																if ($database->getErrorMsg()){										
																		die($database->getErrorMsg());
																}													
													$nums_chooser = $database->getNumRows() ;
													if ( $nums_chooser == $most ) {
															$bold = "style='font-weight:bold' " ;
													}
													else {
															$bold = '' ;
													}
													if ( $total_answers_per_row != 0) {
															$percent = floatval( $nums_chooser / $total_answers_per_row ) * 100 ;
													}
													else {
															$percent = 0 ; 
													}
													if ( $nums_chooser > 0 ) {
															$ft = "<a href='#filter' onclick='settaskfilter(\"analyze\"," . $q_info["q_id"] . ",0," . $row_info["a_id"] . "," . $ac_id . ")'>$nums_chooser</a>" ;
													}
													else {
															$ft = $nums_chooser ;
													}
													echo "<td align='center' $bold >" ;
													printf( "%4.2f", $percent ) ;
													echo "% ($ft) </td>" ;
												}
												echo "<td align='center'>$total_answers_per_row</td>" ; 												echo "</tr>";
												$i++ ;
											}
										}
										
										echo "<tr><td colspan='" . ( $total_c + 1 ) . "' style=\"text-align:right\"><b>"._TOTAL." "._RESPONDENTS."</b></td><td align='center' bgcolor='$css_totalbackground'><b>$total_respondents</b></td></tr>" ;
										echo "</table>" ;
									}
									else { // MATRIX MENU
										$database->setQuery( "SELECT * FROM #__ijoomla_surveys_menu_heading WHERE q_id=" . $q_info["q_id"] . " ORDER BY m_id ASC" ) ;
										$menus = $database->loadAssocList() ;
										foreach ( $menus as $m_info ) {
											echo "<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'>" ; 
											echo "<tr><td align='center' bgcolor='#D1E9E9'>" . $m_info["value"] . "</td></tr>" ;
											echo "<tr><td>" ;
											echo "<table width='100%' style='border-collapse:collapse;border:1px solid #CCCCCC' border='1'>" ;
											echo "<tr><td width='25%'></td>" ;
											$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=" . $q_info["q_id"] . " AND m_id=" . $m_info["m_id"] ) ;
											$database->query() ;
													if ($database->getErrorMsg()){										
															die($database->getErrorMsg());
													}											
											$total_c = $database->getNumRows() ;
											if ( $total_c > 0 ) {
												$columns = $database->loadAssocList() ;
												$c_width = intval( 60 / $total_c ) ;
												foreach ( $columns as $c_info ) {
													echo "<td width='$c_width%' align='center'><b>" . stripslashes($c_info["value"]) . "</b></td>" ;
													$column_info[] = $c_info["ac_id"] ;
												}
											}
											echo "<td width='15%' align='center'><b>" . _RESPONSE . " <br /> " . _TOTAL . "</b></td> </tr>" ;												
											$total_answers = 0 ;
											$database->setQuery( "SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=" . $q_info["q_id"]. " ORDER BY a_id ASC" ) ;
											$database->query() ;
													if ($database->getErrorMsg()){										
															die($database->getErrorMsg());
													}																							
											if ( $database->getNumRows() > 0 ) {
												$rows = $database->loadAssocList() ;												
												$i = 0 ;
												foreach ( $rows as $row_info ) {
													$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $row_info["a_id"] . " AND ac_id>0 AND m_id=" . $m_info["m_id"] . " $extra_cond" ) ;
													$database->query() ;
																if ($database->getErrorMsg()){										
																		die($database->getErrorMsg());
																}																																						
													$total_answers_per_row = $database->getNumRows() ; 
													$total_answers += $total_answers_per_row ;
														
													$database->setQuery( "SELECT count( r_id ) , ac_id "
																		 . "FROM #__ijoomla_surveys_result "
																		 . "WHERE q_id =" . $q_info["q_id"] . " AND ac_id>0 AND a_id=" . $row_info["a_id"] . " AND m_id=" . $m_info["m_id"] . " $extra_cond "
																		 . "GROUP BY ac_id " 
																		 . "ORDER BY `count( r_id )` DESC  LIMIT 1" ) 
																		 ;
													list( $most, $most_id ) = $database->loadRow() ;																																							
													echo "<tr>" ;
													echo "<td align='right' style='padding-right:5px'" ;
													if ( $i%2 == 0 ) {
															echo "class='$css_tablerow1'" ;
													}
													else {
															echo "class='$css_tablerow2'" ;
													}
													echo ">" . stripslashes($row_info["value"]) . "</td>" ;
													foreach ( $column_info as $ac_id ) {
														$database->setQuery( "SELECT * FROM #__ijoomla_surveys_result WHERE q_id=" . $q_info["q_id"] . " AND a_id=" . $row_info["a_id"] . " AND ac_id=" . $ac_id . " AND m_id=" . $m_info["m_id"] . " $extra_cond" ) ;
														$database->query() ;
																		if ($database->getErrorMsg()){										
																				die($database->getErrorMsg());
																		}														
														$nums_chooser = $database->getNumRows() ;
														if ( $nums_chooser == $most ) {
																$bold = "style='font-weight:bold' " ;
														}
														else {
																$bold = '' ;
														}
														if ( $total_answers_per_row != 0 ) {
															$percent = 100 * floatval( $nums_chooser / $total_answers_per_row ) ;
														}
														else {
															$percent = 0 ;
														}
														if ( $nums_chooser > 0 ) {
																$ft = "<a href='#filter' onclick='settaskfilter(\"analyze\"," . $q_info["q_id"] . "," . $m_info["m_id"] . "," . $row_info["a_id"] . "," . $ac_id . ")'>$nums_chooser</a>" ;
														}
														else {
																$ft = $nums_chooser ; 
														}
														echo "<td align='center' $bold>" ; 
														printf( "%4.2f", $percent ) ;
														echo "% ($ft) </td>" ;
													}
													echo "<td align='center'>$total_answers_per_row</td>" ;
													echo "</tr>" ;
													$i++ ;
												}
													
											}
											echo "<tr><td colspan='" . ( $total_c + 1 ) . "' style=\"text-align:right\"><b>"._TOTAL." "._RESPONDENTS."</b></td><td align='center' bgcolor='$css_totalbackground'><b>$total_respondents</b></td></tr>" ;
											
											echo "</table>" ;
											echo "</td></tr>" ;
											echo "</table>" ;
											$column_info = null ;
											echo "<br />" ;
										}
									}
									$column_info = null ;
								}
								
								$ii++ ;
								echo "</td></tr>" ;
								echo "</table> <br />" ;
							}
							
						}
					echo "</td></tr></table>" ; 
					?>
					
					<input type="hidden" name="option" value="<?php echo $option ; ?>" />
					<input type="hidden" name="task" value="" />
					<input type="hidden" name="lasttask" value="<?php echo $lasttask ; ?>" />
					<input type="hidden" name="lasts_id" value="<?php echo $s_id ; ?>" />
					<input type="hidden" name="boxchecked" value="0" />
					<input type="hidden" name="act" value="<?php echo $act ; ?>" />
					<input type="hidden" name="q_id" value="" />
					<input type="hidden" name="a_id" value="" />
					<input type="hidden" name="ac_id" value="" />
					<input type="hidden" name="m_id" value="" />
					<input type="hidden" name="filter_machine" value="<?php echo $filter ; ?>" />
					<input type="hidden" name="filter_text" value="<?php echo $filter_text ; ?>" />
					<input type="hidden" name="analyze_form" value="yes" />
					<input type="hidden" name="s_id[]" value="<?php echo $s_id ; ?>" />
					</form>
					<script language="javascript">
						SetCookie( "filter_machine", document.adminForm.filter_machine.value, 10 ) ;
						SetCookie( "filter_text", document.adminForm.filter_text.value, 10 ) ;						
					</script>
	<?php
	
	}
	else {
		$mainframe->redirect( "The survey does not exists", "index2.php?option=$option&act=$act" ) ;
	}
}	

function editSurvey ( &$row, &$images, &$lists, $option, $act ) {
	global $mainframe;
	$database = &JFactory::getDBO();
			JOutputFilter::objectHTMLSafe( $row, ENT_QUOTES ) ;
			//JHTML::_loadOverlib() ;
			//JHTML::_loadCalendar() ;
	
	?>
	<script language="javascript" type="text/javascript">
		var folderimages = new Array ;
		<?php
		$i = 0 ;
		foreach ( $images as $k => $items ) {
			foreach ( $items as $v ) {
				echo "folderimages[" . $i++ . "] = new Array( '$k', '".addslashes( $v->value ) . "','" . addslashes( $v->text ) . "' );\n\t\t" ;
			}
		}
		?>
		function submitbutton( pressbutton ) {
			var form = document.adminForm ;
			if ( pressbutton == "cancel" ) {
				submitform( pressbutton ) ;
				return ;
			}
			
			if ( form.title.value == '' ) {
				alert( "<?php echo _PLEASE_FILL_SURVEY_TITLE;?>" ) ;
			} else {
				
				var temp = new Array ;
				for ( var i = 0, n = form.imagelist.options.length ; i < n; i++ ) {
					temp[i] = form.imagelist.options[i].value ;
				}
				if ( temp.length > 0 )
					form.images.value = temp[0] ;
				else 
					form.images.value = '' ;
				<?php
					$editor1  = & JFactory::getEditor();
					$editor2  = & JFactory::getEditor();
					$editor3  = & JFactory::getEditor();
					$editor1->save( 'editor1', 'description' ) ;
					$editor2->save( 'editor2', 'popup_content' ) ;
					$editor3->save( 'editor3', 'end_page_description' ) ;
				?>
				
				submitform( pressbutton );
			}
			
		}
		
				function check_form_target( form_target, redirection_url_name , redirection_message ) {
						var redirect_url = document.getElementsByName( redirection_url_name ) ;
						var redirect_msg = document.getElementsByName( redirection_message ) ;
						if ( form_target.value == '<?php echo _SHOW_END_PAGE ; ?>') {
								if ( redirect_url.length > 0 ) {
										if ( redirect_url[0].disabled != true )
												redirect_url[0].disabled = true ;
										redirect_url[0].value = '' ;    
								}
								if ( redirect_msg.length > 0 ) {
										if ( redirect_msg[0].disabled != true )
												redirect_msg[0].disabled = true ;
										redirect_msg[0].value = '' ;    
								}                
						} else
						if ( form_target.value == '<?php echo _REDIRECT_TO_URL ; ?>' ) {
								if ( redirect_url.length > 0 ) {
										if ( redirect_url[0].disabled != false )
												redirect_url[0].disabled = false ;
										redirect_url[0].value = '<?php echo _URL_DEFAULT ; ?>' ;
								}
								if ( redirect_msg.length > 0 ) {
										if ( redirect_msg[0].disabled != false )
												redirect_msg[0].disabled = false ;
										redirect_msg[0].value = 'Thank You' ;
								}                
						}            
				}
		
	</script>
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table width="100%">
		<tr>
			<td>
	<h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL() ; ?>administrator/components/com_surveys/images/icons/surveys.png" width="48" height="48"  align="middle" />
	<?php 
	if ( $row->title != '' ) {
			echo " " . _EDIT_SURVEY . "</h2>" ;
	}
	else {
			echo "" . _NEW_SURVEY . "</h2>" ;
	}	
	jimport( 'joomla.html.pane' );
	?>
			</td>
			<td align="right">
	<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/create.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
		</tr>	
	</table>
	
	<?php
	$tabs =& JPane::getInstance('tabs');
	echo $tabs->startPane( "EditSurveyPane" ) ;
	
	echo $tabs->startPanel( _HEADER, "survey-header" ) ;
	?>	
	<div style="overflow:hidden">
		<table border="0" cellpadding="3" cellspacing="0" align="left">
			<tr>
				<td align="left" width="5%"><b><?php echo _TITLE ; ?>:</b> </td>
				<td align="left" >					
					<input class="inputbox" type="text" size="50" maxlength="250" name="title" value="<?php echo stripslashes($row->title) ; ?>" />
				</td>
			</tr>
			<?php
				if($row->alias != ""){
					$alias = strtolower($row->alias);
					$alias = str_replace(" ", "-", $alias);
					$alias = str_replace("&", "a", $alias);
					$alias = str_replace("@", "", $alias);
					$alias = str_replace("'", "", $alias);
					$alias = str_replace('"', "", $alias);
					$alias = str_replace('?', "", $alias);
					$alias = str_replace('/', "", $alias);
					$alias = str_replace('\\', "", $alias);
					$row->alias = $alias;
				}
				else{
					$alias = strtolower($row->title);
					$alias = str_replace(" ", "-", $alias);
					$alias = str_replace("&", "a", $alias);
					$alias = str_replace("@", "", $alias);
					$alias = str_replace("'", "", $alias);
					$alias = str_replace('"', "", $alias);
					$alias = str_replace('?', "", $alias);
					$alias = str_replace('/', "", $alias);
					$alias = str_replace('\\', "", $alias);
					$row->alias = $alias;
				}
			?>
			<tr>
				<td align="left" width="5%"><b><?php echo _ALIAS ; ?>:</b> </td>
				<td align="left" >
					<input class="inputbox" type="text" size="50" maxlength="250" name="alias" value="<?php echo stripslashes($row->alias) ; ?>" />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b><?php echo _DESCRIPTION ; ?>:</b></td>
				<td align="left" valign="top">
					<?php
						// parameters : areaname, escription, hidden field, width, height, rows, cols
						$editor1  = & JFactory::getEditor();
						//$row->description = str_replace('\\&quot;', '', $row->description);
						echo $editor1->display( 'editor1',  ''.stripslashes($row->description) , '100%', '270px', '150', '10' ) ; 
					?>
				</td>
				
			</tr>
		</table></div>
	<?php
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( _IMAGES, "Images" ) ;
	?>	
	<div style="display:block; overflow:auto; height:325px; width:100%;">
		<table class="adminform" width="100%">
			<tr>
				<td colspan="3"><b><?php echo _SUB_FOLDER ; ?></b>: <?php echo $lists['folders'] ; ?></td>
			</tr>
			<tr>
				<td width="45%" style="text-align: center">
					<b><?php echo _GALLERY_IMAGES ; ?></b>:
					<br />
					<?php echo $lists['imagefiles'] ; ?>
				</td>
				<td width="10%">
				<input class="button" type="button" value="<?php echo _ADD;?>" onClick="addSelectedToList('adminForm','imagefiles','imagelist')" /> <br />
				<input class="button" type="button" value="<?php echo _REMOVE;?>" onClick="delSelectedFromList('adminForm','imagelist')" />
				</td>
				<td width="45%" style="text-align: center">
					<b><?php echo _SURVEY ; ?> <?php echo _IMAGES ; ?>:</b>
					<br />
					<?php echo $lists['imagelist'] ; ?>
				</td>
			</tr>
			
			<tr>
				<td valign="top" align="left" width="50%">
					<div style="display:block; overflow:hidden; width:100%;" align="center">
						<img name="view_imagefiles" src="../images/M_images/blank.png" />
					</div>							
				</td>
				<td></td>
				<td width="50%">
					<div style="display:block; overflow:hidden; width:100%;" align="center">
						<img name="view_imagelist" src="../images/M_images/blank.png"  />
					</div>
				</td>
			</tr>
			
				<tr>
					<td colspan="3">
							<div style="display: none">
						<?php echo _EDIT_IMAGE;?>:
						<table>
						<tr>
							<td align="right">
							Source:
							</td>
							<td>
							<input class="text_area" type="text" name= "_source" value="" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Image Align:
							</td>
							<td>
							<input class="text_area" type="text" name="_align" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Alt Text:
							</td>
							<td>
							<input class="text_area" type="text" name="_alt" value="" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Border:
							</td>
							<td>
							<input class="text_area" type="text" name="_border" value="" size="3" maxlength="1" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption Position:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption_position" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption Align:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption_align" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption Width:
							</td>
							<td>
							<input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<input class="button" type="button" value="Apply" onclick="applyImageProps()" />
							</td>
						</tr>
						</table>
						</div>
					</td>
				</tr>			
		</table>
	</div>
	<?php
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( _HANDLING, 'survey-handling' ) ;
	?>
	<table width="100%">
		<tr>
			<td align="left" valign="middle" width="100%">
				<b><?php echo _SHOW . ' ' . _SURVEY . ' ' . _RESULT ; ?> :</b> 
				<?php echo _NO?> <input name="show_result" type="radio" value="0" <?php if ($row->show_result==0) echo "checked=\"checked\""?>/>
				<?php echo _YES?> <input name="show_result" type="radio" value="1" <?php if ($row->show_result==1) echo "checked=\"checked\""?> />
			</td>
		</tr>
		<tr>
			<td valign="top" width="100%">
				<table width="100%">
				<tr>
					<td width="15%"><?php echo _SEND_EMAIL; ?> :</td>
					<td width="85%" align="left">
					<select name="email_send">
						<option <?php if($row->email_send == '0') { echo 'selected="selected"'; }?> value="0"><?php echo _global ; ?></option>
						<option  <?php if($row->email_send == '1') { echo 'selected="selected"'; }?> value="1"><?php echo _YES; ?></option>
						<option <?php if($row->email_send == '2') { echo 'selected="selected"'; }?> value="2"><?php echo _NO; ?></option>
					</select>
					</td>
				</tr>
				<tr>
					<td><b><?php echo _SEND_EMAIL_TO; ?> :</b></td>
					<td><input type="text" name="email_send_to" value="<?php echo $row->email_send_to; ?>" /></td>
				</tr>				
				</table>
			</td>
		</tr>
	</table>	
	<?php	
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( _PUBLISHING, 'survey-publishing' ) ;
	?>
	<table width="100%">
		<tr>
				<td align="left"><b><?php echo _PUBLISHED ; ?> :</b></td>
				<td align="left"><input type="radio" name="published" value="0" <?php if ( $row->published == 0 ) { echo 'checked' ;} ?>/> No &nbsp;
					<input type="radio" name="published" value="1" <?php if ( $row->published == 1 ) { echo 'checked' ;} ?>/> Yes
				</td>
		
		</tr>	
		<tr>
				<td align="left"><b><?php echo _SHOW_ON_RESULTS ; ?> :</b></td>
				<td align="left"><input type="radio" name="show_on_results" value="0" <?php if ( $row->show_on_results == 0 ) { echo 'checked' ;} ?>/> <?php echo _NO?> &nbsp;
					<input type="radio" name="show_on_results" value="1" <?php if ( $row->show_on_results == 1 ) { echo 'checked' ;} ?>/> <?php echo _YES?>
				</td>
		
		</tr>			
		<tr>
			<td align="left" width="15%"><b><?php echo _ORDERING ; ?> :</b>	</td>
			<td align="left" width="85%">
				<?php
					$database->setQuery( "SELECT title,ordering FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC" ) ;
					$database->query() ;					
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
					if ( $database->getNumRows() > 0 ) {
							$listsurvey = $database->loadAssocList() ;
				?>
				<select name="ordering">
				<option value="0">0. <?php echo _FIRST ; ?> </option>
				<?php
					$last = 1 ;					
					foreach ( $listsurvey as $survey ) {
				?>
						<option value="<?php echo $survey["ordering"]?>" <?php if ( $row->ordering == $survey["ordering"] ) { echo 'selected' ; }?>><?php echo $survey["ordering"] . ' . ' . stripslashes($survey["title"])?></option>
				<?php
							$last = $survey["ordering"] + 1 ;
					}
				?>
				<option value="<?php echo $last ; ?>" <?php if ( $row->ordering == 'last' ) { $row->ordering = $last ; echo 'selected' ; }?>><?php echo $last ; ?>. <?php echo _LAST ; ?></option>
					</select>
					<?php 
					}
				?>
				
			</td>
		</tr>
		<tr>
				<td valign="top" align="left">
					<b><?php echo _ACCESS . ' ' . _LEVEL ; ?>:</b>
				</td>
				<td>
					 <?php echo $lists['access'] ; ?> 
				</td>
		</tr>
		<tr>
				<td valign="top" align="left">
					<b><?php echo _OVERRIDE . ' ' . _CREATED . " " . _DATE ; ?></b>
				</td>
				<td>
				
				<?php
			      $timedatestring = date( "Y-m-d H:i:s", $row->created_date );
			      $datestring = substr($timedatestring,0,10);
	              $datestringArray = explode('-',$datestring);

	              $timestring = @substr($timedatestring,-8,8);
 	              $timestringArray = explode(':',$timestring);
				  $format_string = "";
			      if(date("H", $row->created_date) != 0 && date("H", $row->created_date) != 24){
						  $firsdate = date("h", $row->created_date);		
						  $myvar = $timestringArray[0]-12;	
						 // die(var_dump($firsdate));
						  if($myvar < 0){
							 $second = $firstdata + 1; // le fac diferite
						  }			  
						  else{
							 $second = date("h", mktime($myvar ,$timestringArray[1],$timestringArray[2],$datestringArray[1],$datestringArray[2],$datestringArray[0]));
						  }
						  
						  //die( $firsdate . "  " . $second);						  						  
						  if($firsdate == $second){
							  $format_string = "Y-m-d H:i:s";
						  }
						  else{
							  $format_string = "Y-m-d h:i:s";
						  }
				 }
				 else{
				     $format_string = "Y-m-d H:i:s";
				 }				 
			  ?>
				
					<input class="text_area" type="text" name="created_date" id="created_date" size="25" maxlength="19" value="<?php echo date(  $format_string , $row->created_date ) ; ?>" />
					<input name="reset" type="reset" class="button" onClick="return showCalendar('created_date', 'y-mm-dd h:i:s');" value="..." />
				</td>
		</tr>
		<tr>
			<td align="left"><b><?php echo _START . ' ' . _PUBLISHING ; ?>:</b></td>
			<td align="left"> 
			
			<?php
			      $timedatestring = date( "Y-m-d H:i:s", $row->start_date );
			      $datestring = substr($timedatestring,0,10);
	              $datestringArray = explode('-',$datestring);

	              $timestring = @substr($timedatestring,-8,8);
 	              $timestringArray = explode(':',$timestring);
				  $format_string = "";
			      if(date("H", $row->end_date) != 0 && date("H", $row->start_date) != 24){
						  $firsdate = date("h", $row->start_date);		
						  $myvar = $timestringArray[0]-12;	
						 // die(var_dump($firsdate));
						  if($myvar < 0){
							 $second = $firstdata + 1; // le fac diferite
						  }			  
						  else{
							 $second = date("h", mktime($myvar ,$timestringArray[1],$timestringArray[2],$datestringArray[1],$datestringArray[2],$datestringArray[0]));
						  }
						  
						  //die( $firsdate . "  " . $second);						  						  
						  if($firsdate == $second){
							  $format_string = "Y-m-d H:i:s";
						  }
						  else{
							  $format_string = "Y-m-d h:i:s";
						  }
				 }
				 else{
				     $format_string = "Y-m-d H:i:s";
				 }				 
			  ?>
			
				<input class="text_area" type="text" name="start_date" id="start_date" size="25" maxlength="19" value="<?php echo date( $format_string, $row->start_date ) ; ?>" />
				<input name="reset" type="reset" class="button" onClick="return showCalendar('start_date', 'y-mm-dd h:i:s');" value="..." />
				
			</td>
		</tr>
		<tr>
			<td align="left"><b><?php echo _FINISH . ' ' . _PUBLISHING ; ?>:</b></td>
			<td align="left"> 
			  <?php
			      $timedatestring = date( "Y-m-d H:i:s", $row->end_date );
			      $datestring = substr($timedatestring,0,10);
	              $datestringArray = explode('-',$datestring);

	              $timestring = @substr($timedatestring,-8,8);
 	              $timestringArray = explode(':',$timestring);
				  $format_string = "";
			      if(date("H", $row->end_date) != 0 && date("H", $row->end_date) != 24){
						  $firsdate = date("h", $row->end_date);		
						  $myvar = $timestringArray[0]-12;	
						 // die(var_dump($firsdate));
						  if($myvar < 0){
							 $second = $firstdata + 1; // le fac diferite
						  }			  
						  else{
							 $second = date("h", mktime($myvar ,$timestringArray[1],$timestringArray[2],$datestringArray[1],$datestringArray[2],$datestringArray[0]));
						  }
						  
						  //die( $firsdate . "  " . $second);						  						  
						  if($firsdate == $second){
							  $format_string = "Y-m-d H:i:s";
						  }
						  else{
							  $format_string = "Y-m-d h:i:s";
						  }
				 }
				 else{
				     $format_string = "Y-m-d H:i:s";
				 }				 
			  ?>
				<input class="text_area" type="text" name="end_date" id="end_date" size="25" maxlength="19" value="<?php echo date( $format_string, $row->end_date ) ; ?>" />
				<input name="reset" type="reset" class="button" onClick="return showCalendar('end_date');" value="..." />
			</td>
		</tr>
	</table>
	
	<?php	
	echo $tabs->endPanel() ;
	echo $tabs->startPanel( _POP_UP, "PopUp" ) ;
	?>
	<table width="100%">
		<tr>
			<td align="right">
				<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/popup.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
		</tr>	
	</table>
	<div id="editor122">
	<table width="100%">
	<tr>
		<td align="left" width="15%"><?php echo '<strong>'._SHOW . ' ' . _POP_UP . ' ' . _INVITATION.'</strong>' ; ?> </td>
		<td align="left"> <input type="radio" name="show_popup" value="0" <?php if ( $row->show_popup == 0 ) echo 'checked' ;?>> <?php echo _NO?> &nbsp; <input type="radio" name="show_popup" value="1" <?php if ( $row->show_popup == 1 ) echo 'checked' ; ?> />  <?php echo _YES?>	</td>
	
	</tr>
	<tr>
		<td align="left"> <?php echo '<strong>'._SHOW.'</strong>' ; ?>:</td> 
		<td align="left"> <select name="popup_show_freq">
											<option value="<?php echo _ONCE_A_DAY_VALUE ; ?>" <?php if ( $row->popup_show_freq == 1 ) echo "selected" ; ?>><?php echo _ONCE_A_DAY ; ?></option>
											<option value="<?php echo _ONCE_A_WEEK_VALUE ; ?>" <?php if ( $row->popup_show_freq == 7 ) echo "selected" ; ?>><?php echo _ONCE_A_WEEK ; ?></option>
											<option value="<?php echo _ONCE_A_MONTH_VALUE ; ?>" <?php if ( $row->popup_show_freq == 30 ) echo "selected" ; ?>><?php echo _ONCE_A_MONTH ; ?></option>
											<option value="<?php echo _ONCE_EVERY_3_MONTH_VALUE ; ?>" <?php if ( $row->popup_show_freq == 91 ) echo "selected" ; ?>><?php echo _ONCE_EVERY_3_MONTH ; ?></option>
											<option value="<?php echo _ONCE_A_YEAR_VALUE ; ?>" <?php if ( $row->popup_show_freq == 365 ) echo "selected" ; ?>><?php echo _ONCE_A_YEAR ; ?></option>
											</select>
		</td>
	</tr>	
	<tr>
		<td align="left"> <?php echo '<strong>'._POP_UP . ' ' . _WIDTH.'</strong>' ; ?>:</td> 
		<td align="left"> <input type="text" size="5" name="popup_width" value="<?php echo $row->popup_width ; ?>" /></td>
	</tr>
	<tr>
		<td align="left"> <?php echo '<strong>'._POP_UP . ' ' . _HEIGHT.'</strong>' ; ?>:</td> 
		<td align="left"> <input type="text" size="5" name="popup_height" value="<?php echo $row->popup_height ; ?>" /></td>
	</tr>
	<tr>
		<td align="left"> <?php echo '<strong>'._POP_UP . ' ' . _TITLE.'</strong>' ; ?>:</td> 
		<td align="left"> <input type="text" size="45" name="popup_title" value="<?php echo $row->popup_title ; ?>" /></td>
	</tr>	
	<tr>
		<td align="left"><?php echo '<strong>'._CONTENT.'</strong>' ; ?></td>
		
		<td align="left">
		
				<?php
				//$editor2  = & JFactory::getEditor();
				
				$row->popup_content = str_replace('\\&quot;', '', $row->popup_content);
				echo $editor2->display( 'editor2',  ''.stripslashes($row->popup_content) , '100%', '250px', '10', '45' ) ; 
				?>
		</td>
	</tr>
	</table></div>

	<?php
		echo $tabs->endPanel() ;
		echo $tabs->startPanel( _FINISHING, 'survey-finishing' ) ;
	?>
	<div id="test" style="overflow:hidden; display:block;">
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
		<tr>
			<td width="15%" align="left"> <b><?php echo _END . ' ' . _PAGE . ' ' . _TITLE ; ?>:</b></td>
			<td width="85%" align="left"> <input class="inputbox" type="text" size="50" maxlength="250" name="end_page_title" value="<?php echo stripslashes($row->end_page_title) ; ?>" /></td>
		</tr>
		<tr>
			<td align="left"><b><?php echo _END . ' ' . _PAGE . ' ' . _DESCRIPTION ; ?></b></td>
			<td align="left">
				<?php 
				// parameters : areaname, escription, hidden field, width, height, rows, cols
				//$editor3  = & JFactory::getEditor();
				
				$row->end_page_description = str_replace('\\&quot;', '', $row->end_page_description);
				echo $editor3->display( 'editor3',  ''.stripslashes($row->end_page_description) , '100%', '250px', '10', '45') ; 
				?>
			</td>
		</tr>
		<tr>
			<td align="left"><b><?php echo _FORM . ' ' . _TARGET ; ?>:</b></td>
			<td align="left">
				<select name="form_target" id="form_target" onchange="Javascript:check_form_target(this,'redirection_url','redirection_msg');">
						<option value="<?php echo _SHOW_END_PAGE ; ?>" <?php if ( $row->form_target == _SHOW_END_PAGE ) echo " selected" ; ?>><?php echo _SHOW_END_PAGE ; ?></option>
						<option value="<?php echo _REDIRECT_TO_URL ; ?>" <?php if ( $row->form_target == _REDIRECT_TO_URL ) echo " selected" ; ?>><?php echo _REDIRECT_TO_URL ; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="left"> <b><?php echo _REDIRECTION_URL ; ?>:</b> </td>
			<td align="left"> <input class="inputbox" type="text" size="50" maxlength="250" name="redirection_url" value="<?php echo $row->redirection_url ; ?>" /> 
			</td>
		</tr>
		<tr>
			<td align="left"> <b><?php echo _REDIRECTION_MSG ; ?>:</b> </td>
			<td align="left"> <input class="inputbox" type="text" size="50" maxlength="250" name="redirection_msg" value="<?php echo $row->redirection_msg ; ?>" /> 
			</td>
		</tr>		
		<script type="text/JavaScript">
				var form_target=document.getElementById('form_target');
				if (form_target.value== '<?php echo _SHOW_END_PAGE;?>'){
						var redirection_url=document.getElementsByName('redirection_url');
						if (redirection_url.length>0)
								redirection_url[0].disabled=true;
								redirection_url[0].value='';
						var redirection_msg=document.getElementsByName('redirection_msg');
						if (redirection_msg.length>0)
								redirection_msg[0].disabled=true;
								redirection_msg[0].value='';    
				}
		</script>
	</table></div>
	<?php	
		echo $tabs->endPanel() ;
		echo $tabs->endPane() ;
	?>
		<input type="hidden" name="s_id" value="<?php echo $row->s_id ; ?>" />
		<input type="hidden" name="images" value="<?php echo $row->images ; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="<?php echo $act?>" />
	</form>
	
	<script type="text/javascript">
			
			function returnObjById( id )
			{
				if (document.getElementById)
					var returnVar = document.getElementById(id);
				else if (document.all)
					var returnVar = document.all[id];
				else if (document.layers)
					var returnVar = document.layers[id];
				return returnVar;
			}
			
			function ascunde(){
				
				var browser=navigator.appName;
				if (browser=="Microsoft Internet Explorer"){
					
					var pp=returnObjById('survey-header');
					
					pp.onclick=function(){																								
						afis().style.display='block';
						$('test').style.visibility = "hidden";
						$('editor122').style.visibility = "hidden";
						
					};
				
					var mp=returnObjById('Images');
					
					mp.onclick=function(){																													
						afis().style.display='none';
						$('test').style.visibility = "hidden";
						$('editor122').style.visibility = "hidden";
					};
					
					var np=returnObjById('survey-handling');
					
					np.onclick=function(){																								
						afis().style.display='none';
						$('test').style.visibility = "hidden";
						$('editor122').style.visibility = "hidden";
					};
				
					var jp=returnObjById('survey-publishing');
					
					jp.onclick=function(){																													
						afis().style.display='none';
						$('test').style.visibility = "hidden";
						$('editor122').style.visibility = "hidden";
					};
					
					var kp=returnObjById('PopUp');
					
					kp.onclick=function(){																													
						afis().style.display='none';
						$('test').style.visibility = "hidden";
						$('editor122').style.visibility = "inherit";
					};
					
					var lp=returnObjById('survey-finishing');
					
					lp.onclick=function(){																													
						afis().style.display='none';
						$('test').style.visibility = "inherit";
						$('editor122').style.visibility = "hidden";
					};
				}
			
			}			
			
			function afis(){
				var b=document.adminForm.getElementsByTagName('span');
				for(i=0; i<b.length; i++)
					if(b[i].className=='mceToolbarContainer')
						return b[i];
			}
			
			ascunde();
			
		</script>
		
	<?php
	}
	}

// QUESTION .............

class HTML_questions {

function showquestion( &$rows, $pageNav, $option ,$act) {
	global $mainframe,  $search, $n;
	$database = &JFactory::getDBO();
	
	$errcode=JArrayHelper::getValue($_GET,'errcode');
	if ($errcode!=null){
			switch ($errcode){
					case '1':case '2':
					$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._QUESTION." "._BECAUSE_PART_OF_SKIP;break;
						case '3':case '4':
						$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._PAGE." "._BECAUSE_PART_OF_SKIP;break;
					case '5':case '6':
					$error_msg=ucfirst(_THIS)." "._QUESTION." "._PART_OF_SKIP_REQUIRED;break;
					case '9':case '10':
					$error_msg=_YOU_CANT." "._DELETE." "._THIS." "._QUESTION." "._BECAUSE_PART_OF_SKIP;break;
					case '11':$error_msg=_YOU_CANT." "._UNPUBLISH." "._OR." "._MAKE." "._NOT." "._REQUIRED." "._THIS." "._QUESTION." "._BECAUSE_PART_OF_SKIP;break;
					default :$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._PAGE."/"._QUESTION." "._BECAUSE_PART_OF_SKIP;
			}
			echo "<script type=\"text/JavaScript\">alert('$error_msg')</script>" ;
	}
	?>
	<script type="text/JavaScript">
	<!--
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}
	//-->
	</script>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminheading">
		<tr>
			<td width="100%" rowspan="2" valign="bottom"><h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL()?>/administrator/components/com_surveys/images/icons/questions.png" align="middle" /><?php echo _QUESTIONS.' '._MANAGER?></h2></td>
			<td nowrap align="right" valign="bottom">
			<table align="right">
			<tr>
			<td valign="middle" align="right"> 
				<?php
					$database->setQuery("SELECT s_id,title FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC");
					$database->query();
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
										$s_id   = JArrayHelper::getValue($_GET,'s_id'   );            					
										$page_id= JArrayHelper::getValue($_GET,'page_id');
				?>
					<select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
						<option value="index2.php?option=<?php echo $option?>&act=question" <?php if (intval($s_id)==0) echo " selected" ?>> <?php echo _ALL.' '._SURVEYS?> </option>
						<?php 
						
						$lists=$database->loadAssocList();
						if (count($lists)) {
							foreach ($lists as $survey) {
						?>
						 <option value="index2.php?option=<?php echo $option?>&act=question&s_id=<?php echo $survey["s_id"]?>" <?php if ($survey["s_id"]==intval($s_id)) echo " selected" ?>><?php echo stripslashes($survey["title"])?></option>
						<?php } 
						}?>
				 </select>
					<?php	
					if (intval($s_id)&&($s_id>0)) {
						$database->setQuery("SELECT page_id,title FROM #__ijoomla_surveys_pages WHERE s_id=".intval($s_id)." ORDER BY ordering ASC");						
					}
					else {
						$database->setQuery("SELECT page_id,title FROM #__ijoomla_surveys_pages ORDER BY ordering ASC");						
					}
					$database->query();					
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
				?>
					<select name="menu2" onchange="MM_jumpMenu('parent',this,0)">
						<option value="index2.php?option=<?php echo $option?>&act=question&s_id=<?php echo intval($s_id)?>" <?php if (intval($page_id)==0) echo " selected" ?>> <?php echo _ALL.' '._PAGES?> </option>
						<?php 
						
						if ($database->getNumRows()>0) {
							$lists=$database->loadAssocList();
							foreach ($lists as $block) {
						?>
						 <option value="index2.php?option=<?php echo $option?>&act=question&s_id=<?php echo intval($s_id)?>&page_id=<?php echo $block["page_id"]?>" <?php if ($block["page_id"]==intval($page_id)) { echo " selected"; }?>><?php echo stripslashes($block["title"])?></option>
						<?php }
						} ?>
				 </select>
						</td>
						</tr>
				<tr>
						<td nowrap align="right">
						<table align="right">
					<td valign="middle" align="right">
					<?php echo _FILTER?>: <input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
						</td>
						<td valign="middle">
						<input type="submit" name="submit_btn" value="<?php echo _GO?>" />
						</td>
						</table>
						</td>
				</tr>            
						</table>
						</td>
		</tr>
	</table>

	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="2%" align="center">#</th>
			<th width="2%" align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
			<th width="30%" align="left"><?php echo _QUESTION?> </th>
			<th width="15%" align="center"><?php echo _QUESTION.' '._TYPE?></th>
			<th width="10%" align="center"><?php echo _FIELD_REQUIRED?></th>
			<th width="10%" align="center"><?php echo _SURVEY.' '._NAME1?></th>
			<th width="10%" align="center"><?php echo _PAGE.' '._NAME1?></th>
			<th width="5%" align="center"><?php echo _PUBLISHED?></th>
			<th width="5%" colspan="2" align="center"><?php echo _REORDER?></th>
			<th width="11%" align="center">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding-left:0px;padding-right:0px;border:none"><b><?php echo _ORDER?></b></td>
						<td style="padding-left:2px;padding-right:0px;border:none"><a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a></td>
					</tr>
				</table>
			</th>
		</tr>
	<?php
		$k = 0;
		for($i=0; $i < count( $rows ); $i++) {
			$row = $rows["$i"];
			$img = $row->published ? 'tick.png' : 'publish_x.png';
			$task = $row->published ? 'unpublish' : 'publish';
			$required=$row->required? 'unrequired' : 'required';
			$field_required=$row->required?'tick.png':'publish_x.png';
			$database->setQuery("SELECT title FROM #__ijoomla_surveys_surveys WHERE s_id=".$row->s_id);						
			list($survey_name)=$database->loadRow();
	?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+$pageNav->limitstart+1;?></td>
			<td align="center"><input type="checkbox" id="cb<?php echo $i;?>" name="q_id[]" value="<?php echo $row->q_id; ?>" onclick="isChecked(this.checked);" /></td>
			<td  align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo text_wrap(stripslashes($row->title),50,"<br />"); ?></a></td>
			<td align="center">
			<?php
				if ($row->type=='radio' && $row->orientation=='vertical') { $q_type=_CHOICE_ONE_ANSWER_VERTICAL;}
				elseif ($row->type=='radio' && $row->orientation=='horizontal') {$q_type=_CHOICE_ONE_ANSWER_HORIZONTAL;}
				elseif ($row->type=='radio' && $row->orientation=='dropdown') {$q_type=_CHOICE_ONE_ANSWER_MENU;}
				elseif ($row->type=='checkbox' && $row->orientation=='vertical') {$q_type=_CHOICE_MULTIPLE_ANSWER_VERTICAL;}
				elseif ($row->type=='checkbox' && $row->orientation=='horizontal'){$q_type=_CHOICE_MULTIPLE_ANSWER_HORIZONTAL;}
				elseif ($row->type=='radio' && $row->orientation=='matrix') {$q_type=_MATRIX_ONE_ANSWER_PER_ROW;}
				elseif ($row->type=='checkbox' && $row->orientation=='matrix') {$q_type=_MATRIX_MULTIPLE_ANSWER_PER_ROW;}
				elseif ($row->type=='menu' && $row->orientation=='matrix') {$q_type=_MATRIX_MULTIPLE_ANSWER_PER_ROW_MENUS;}
				elseif ($row->type=='text' && $row->orientation=='open') {$q_type=_OPEN_ENDED_ONE_LINE_W_PROMPT;}
				elseif ($row->type=='textarea' && $row->orientation=='open') {$q_type=_OPEN_ENDED_ESSAY;}
				elseif ($row->type=='constant' && $row->orientation=='open') {$q_type=_OPEN_ENDED_CONSTANT_SUM;}
				elseif ($row->type=='datetime' && $row->orientation=='open') {$q_type=_OPEN_ENDED_DATE_AND_OR_TIME;}
				elseif ($row->type=='moreline' && $row->orientation=='open') {$q_type=_OPEN_ENDED_ONE_MORE_LINE_W_PROMPT;}
				elseif ($row->orientation=='present') {$q_type="Presentation - Descriptive Text";}
			?>
			<?php echo $q_type?>
			</td>
			<td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $required;?>')"><img src="images/<?php echo $field_required?>" border="0" alt=""> </a></td>
			<td align="center"><?php echo stripslashes($survey_name)?></td>
			<td align="center">
			<?php
				$database->setQuery("SELECT title FROM #__ijoomla_surveys_pages WHERE page_id=$row->page_id");						
				list($page_name)=$database->loadRow();
				echo stripslashes($page_name);
			?>
			</td>
			<td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" border="0" alt="" /></a></td>
				
			<td align="center">
				<?php echo $pageNav->orderUpIcon( $i ); ?>
			</td>
			<td align="center">
				<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
			</td>
			<td align="center">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td>
		</tr>
	<?php
			$k = 1 - $k;
		}
	?>
		<tr>
			<th align="center" colspan="11"> <?php echo $pageNav->getPagesCounter(); ?></th>
		</tr>
		<tr>
				<td colspan="16" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						
				</table>
				<?php echo $pageNav->getListFooter(); ?>
				</td>
		</tr>		
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="s_id" value="<?php echo intval($s_id); ?>" />
	<input type="hidden" name="page_id" value="<?php echo intval($page_id); ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="<?php echo $act?>" />
	</form>
	<?php
	}
	
function editquestion( &$row,&$answer,&$column,$option ,$act) {
		global $mainframe;
		$database = &JFactory::getDBO();

		JOutputFilter::objectHTMLSafe( $row, ENT_QUOTES );
		//JHTML::_loadOverlib();
		//JHTML::_loadCalendar();
	?>
	
	<script language="JavaScript1.2">
	<!---
			function check_radios(){
					var other_field=document.getElementById('other_field_title');
					var radio_yes=document.getElementById('other_field_yes');
					var radio_no=document.getElementById('other_field_no');
					
					if (other_field.value.length>0) {
							radio_yes.checked='checked'; 
					}else{
							radio_no.checked='checked';
					}
			}
			function check_other(){
					var other_field=document.getElementById('other_field_title');
					if (other_field.value.length>0){
							other_field.value='';
					}
			}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( pressbutton );
				return;
			}
			
			if (form.title.value == '') {
				alert( "<?php echo _PLEASE_FILL_QUESTION_TITLE;?>" );
			}
			else {
				if (form.s_id.value=="") {
					alert("<?php echo _PLEASE_SELECT_SURVEY;?>");
				}
				else
				{
					if (form.page_id.value=="") {
						alert("<?php echo _PLEASE_SELECT_PAGE;?>");
					}
					else {
							if (form.question_type.value=="#") {
									alert("<?php echo _PLEASE_SELECT_QUESTION_TYPE;?>");    
							}
							else {
									// iJoomla Al if clause eliminated - ( || (form.question_type.options[form.question_type.selectedIndex].value==8) )
									if (
									( (form.question_type.options[form.question_type.selectedIndex].value==6)|| (form.question_type.options[form.question_type.selectedIndex].value==7)  )
									&& (form.column.value.length==0)) {
											alert("<?php echo _PLEASE_FILL_COLUMN;?>");
									}
									else {
											submitform( pressbutton );
									}
								}
					}
				}
			}
		}
		
		function reload() {
			submitform('reload');
		}
		function setcookie(selObj) {
			document.cookie="s_id="+ selObj.options[selObj.selectedIndex].value;
		}
		function show_div(did) {
			document.getElementById(did).style.display="inline";
		}
		
		function hide_div(did) {
			document.getElementById(did).style.display="none";
		}
		function MM_jumpMenu(targ,selObj,restore){ //v3.0
				eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
				if (restore) selObj.selectedIndex=0;
		}
		function print_textarea( selObj ) {
			switch (selObj.options[selObj.selectedIndex].value) {
				case '1':
					show_div('div_menu_1');
					<?php	for ($i=2;$i<=5;$i++) echo "hide_div('div_menu_$i');\n"		?>
				break;
				case '2':
					<?php	for ($i=1;$i<=2;$i++) echo "show_div('div_menu_$i');\n";
							for ($i=3;$i<=5;$i++) echo "hide_div('div_menu_$i');\n"
					?>			
				break;
				case '3':
					<?php	for ($i=1;$i<=3;$i++) echo "show_div('div_menu_$i');\n";
							for ($i=4;$i<=5;$i++) echo "hide_div('div_menu_$i');\n"
					?>			
				break;
				case '4':
					<?php	for ($i=1;$i<=4;$i++) echo "show_div('div_menu_$i');\n";
					?>			
					hide_div('div_menu_5');
				break;
				case '5':
					<?php	for ($i=1;$i<=5;$i++) echo "show_div('div_menu_$i');\n";
					?>	
				break;
				case '6':
					<?php	for ($i=1;$i<=6;$i++) echo "show_div('div_menu_$i');\n";
					?>	
				break;
				case '7':
					<?php	for ($i=1;$i<=7;$i++) echo "show_div('div_menu_$i');\n";
					?>	
				break;
				case '8':
					<?php	for ($i=1;$i<=8;$i++) echo "show_div('div_menu_$i');\n";
					?>	
				break;
				case '9':
					<?php	for ($i=1;$i<=9;$i++) echo "show_div('div_menu_$i');\n";
					?>	
				break;
				case '10':
					<?php	for ($i=1;$i<=10;$i++) echo "show_div('div_menu_$i');\n";
					?>	
				break;
			}
		}
		function prepair_form( selObj ) {
			switch (selObj.options[selObj.selectedIndex].value) {
				case '1':
					window.document.adminForm.orientation.value='vertical';
					window.document.adminForm.type.value='radio';
					show_div('div_answers');
					hide_div('div_column');
					show_div('div_random_answers');
					hide_div('div_constant');
					hide_div('div_menu_heading');
					show_div('div_other_field');
				break;
				case '2':
					window.document.adminForm.orientation.value='horizontal';
					window.document.adminForm.type.value='radio';
					show_div('div_answers');
					hide_div('div_constant');
					hide_div('div_column');
					show_div('div_random_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '3':
					window.document.adminForm.orientation.value='dropdown';
					window.document.adminForm.type.value='radio';
					show_div('div_answers');
					hide_div('div_constant');
					show_div('div_random_answers');
					hide_div('div_column');
					hide_div('div_menu_heading');
					show_div('div_other_field');
				break;
				case '4':
					window.document.adminForm.orientation.value='vertical';
					window.document.adminForm.type.value='checkbox';
					show_div('div_answers');
					hide_div('div_constant');
					show_div('div_random_answers');
					hide_div('div_column');
					hide_div('div_menu_heading');
					show_div('div_other_field');

				break;
				case '5':
					window.document.adminForm.orientation.value='horizontal';
					window.document.adminForm.type.value='checkbox';
					show_div('div_answers');
					hide_div('div_constant');
					show_div('div_random_answers');
					hide_div('div_column');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '6':
					window.document.adminForm.orientation.value='matrix';
					window.document.adminForm.type.value='radio';
					show_div('div_answers');
					hide_div('div_constant');
					show_div('div_random_answers');
					show_div('div_column');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '7':
					window.document.adminForm.orientation.value='matrix';
					window.document.adminForm.type.value='checkbox';
					show_div('div_answers');
					hide_div('div_constant');
					show_div('div_column');
					show_div('div_random_answers');
					hide_div('div_other_field');
					hide_div('div_menu_heading');
				break;
				case '8':
					window.document.adminForm.orientation.value='matrix';
					window.document.adminForm.type.value='menu';
					show_div('div_answers');
					hide_div('div_constant');
					hide_div('div_column');
					show_div('div_random_answers');
					show_div('div_menu_heading');
					show_div('div_menu_1');
					hide_div('div_other_field');
				break;
				case '9':
					window.document.adminForm.orientation.value='open';
					window.document.adminForm.type.value='text';
					hide_div('div_constant');
					hide_div('div_column');
					hide_div('div_random_answers');
					hide_div('div_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '10':
					window.document.adminForm.orientation.value='open';
					window.document.adminForm.type.value='textarea';
					hide_div('div_constant');
					hide_div('div_column');
					hide_div('div_random_answers');
					hide_div('div_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '14':
					window.document.adminForm.orientation.value='open';
					window.document.adminForm.type.value='moreline';
					hide_div('div_constant');
					hide_div('div_column');
					show_div('div_answers');
					show_div('div_random_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '11':
					window.document.adminForm.orientation.value='present';
					window.document.adminForm.type.value='textarea';
					hide_div('div_constant');
					hide_div('div_column');
					hide_div('div_answers');
					hide_div('div_random_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '12':
					window.document.adminForm.orientation.value='open';
					window.document.adminForm.type.value='constant';
					show_div('div_constant');
					hide_div('div_column');
					show_div('div_answers');
					show_div('div_random_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				case '13':
					window.document.adminForm.orientation.value='open';
					window.document.adminForm.type.value='datetime';
					hide_div('div_constant');
					hide_div('div_column');
					show_div('div_answers');
					show_div('div_random_answers');
					hide_div('div_menu_heading');
					hide_div('div_other_field');
				break;
				
			}
		}
		
		-->
	</script>
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<h2 style="color:#669900"> <img src="<?php echo $mainframe->getSiteURL()?>/administrator/components/com_surveys/images/icons/questions.png" width="48" height="48" align="middle" />
	<?php 
		if ($row->title!='') {
				echo " "._EDIT." "._QUESTION." </h2>";
		}
		else {
				echo ""._NEW." "._QUESTION." </h2>";
		}
		jimport( 'joomla.html.pane' );
	
		$tabs =& JPane::getInstance('tabs');
		echo $tabs->startPane("EditquestionPane");
		echo $tabs->startPanel(_QUESTION,"question-general");
	?>	
	<div style="display:block; overflow:auto; height:450px; width:100%;">
		<table border="0" cellpadding="3" cellspacing="0" align="left" >
			<tr>
				<td align="left" width="10%" valign="top"><b> <?php echo _SURVEY." "._NAME1?>: </b></td>
				<td align="left" width="60%" valign="top">
				
				<?php
					$database->setQuery("SELECT s_id,title FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC");						
					$database->query();
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
					if ($database->getNumRows()>0) {
						$lists=$database->loadAssocList();
						$must_reload=0;
				?>
					<select name="s_id" onchange='return reload()' >
				 <?php 
						if (($row->s_id<1)&& (!isset($_SESSION['selected_survey_id']) || $_SESSION['selected_survey_id']<1)) {
								echo '<option value="" selected> '._PLEASE_SELECT.'</option>';
								foreach ($lists as $survey) {
							?>			  	 
								<option value="<?php echo $survey["s_id"]?>" <?php if (($row->s_id==$survey["s_id"])) echo " selected" ?>><?php echo stripslashes($survey["title"])?></option>
								<?php 
								}
						}else				 
						if (($row->s_id<1)&&(isset($_SESSION['selected_survey_id']))&&($_SESSION['selected_survey_id']!="")){
								$must_reload=1;
								foreach ($lists as $survey) {
							?>			  	 
								<option value="<?php echo $survey["s_id"]?>" <?php if (($_SESSION['selected_survey_id']==$survey["s_id"])) echo " selected" ?>><?php echo stripslashes($survey["title"])?></option>
								<?php 
								}		        
						}else{
								foreach ($lists as $survey) {
							?>			  	 
								<option value="<?php echo $survey["s_id"]?>" <?php if (($row->s_id==$survey["s_id"])) echo " selected" ?>><?php echo stripslashes($survey["title"])?></option>
								<?php 
								}				        
						}

					?>
				 </select>
				<?php 

					}
				 
				else { ?>
				<b><span style="color:red"><?php echo _YOU_MUST_ADD_SURVEY;?></span></b>
				<?php
				}
				?>
				</td>
				<?php
						
						$maxmenu=11;
						$cm=null;
						// CURRENTLY is MENU
						if ($row->orientation=='matrix' && $row->type=='menu') {
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_menu_heading WHERE q_id=".$row->q_id." ORDER BY m_id ASC");						
							$database->query();
													if ($database->getErrorMsg()){										
															die($database->getErrorMsg());
													}							
							$cm=$database->getNumRows();
							if ($cm>0) {
								$menus=$database->loadAssocList();
								foreach ($menus as $m_info) {									
									$menu[]=$m_info;
									$database->setQuery("SELECT * FROM #__ijoomla_surveys_answer_columns WHERE q_id=$row->q_id AND m_id=".$m_info["m_id"]." ORDER BY ac_id ASC");						
									$database->query();									
																	if ($database->getErrorMsg()){										
																			die($database->getErrorMsg());
																	}									
									if ($database->getNumRows()>0) {
										$columns=$database->loadAssocList();
										if (!isset($column[$m_info["m_id"]])){									
																	$column[$m_info["m_id"]]=null;					    
										}
										if (!isset($c_id[$m_info["m_id"]])){
												$c_id[$m_info["m_id"]]=null;
										}
										foreach ($columns as $c_info) {
											$column[$m_info["m_id"]].=$c_info["value"]."\n";
											$c_id[$m_info["m_id"]].="<input name='cid[".$m_info["m_id"]."][]' type='hidden' value='".$c_info["ac_id"]."' /> \n";
										}
									}
								}
							}
							else {
									$cm=1;
							}
							for ($i=2;$i<=$maxmenu;$i++) {
									if ($i<=$cm) {
											$sm[$i]='inline'; 
									}
									else {
											$sm[$i]='none';
									}
							}
						}
						else {
								for ($i=1;$i<=$maxmenu;$i++)  {
										$sm[$i]='none';
								}
						}
						
				?>
				<td width="30%" align="left" valign="top" rowspan="10">
					<div style="display:<?php echo $sm[1]?>" id="div_menu_heading">
						<table width="100%" align="left">
							<tr>
								<td width="100%" align="left" valign="top"> <b><?php echo _MENUS?> </b> 
								<select name="nums_menu_heading" id="nums_nenu_heading" onchange="print_textarea(this)">
										<?php
											for ($i=1;$i<$maxmenu;$i++) {
										?>
											<option value="<?php echo $i?>" <?php if ($i==$cm) echo 'selected';?>><?php echo $i?></option>
										<?php } ?>
								 </select>
								<br /> <?php echo _SELECT_NUMBER_MENUS;?> </td>
							</tr>
							<tr>	
								<td width="100%" align="left" valign="top"> 
									
										<?php
										if ($row->orientation!='matrix') {// curently is not matrix
												for ($i=1;$i<=$maxmenu;$i++) {
												 ?>
													<div style="display:<?php echo $sm[$i]?>" id="div_menu_<?php echo $i?>" align="left">
													<b><?php echo _MENU.' '._HEADING?></b>
													<input name="menu_heading[]" type="text" id="menu_heading[]" size="25" value="" />
													<br />
													<b><?php echo _MENU.' '._CHOICES?></b>
													<textarea name="m_choices[]" cols="45" rows="4" id="m_choices[]"></textarea>
													<br /><br />
													</div>
												<?php }
										}
										else { // curently is a matrix
												for ($i=0;$i<$maxmenu;$i++) {
														if (!isset($menu[$i]["m_id"]))
																$menu[$i]["m_id"]=null;
												 ?>
													<div style="display:<?php echo $sm[$i+1]?>" id="div_menu_<?php echo ($i+1)?>" align="left">
													<b><?php echo _MENU.' '._HEADING?>: </b>
													<input name="menu_heading[<?php echo $menu[$i]["m_id"]?>]" type="text" id="menu_heading[<?php echo $menu[$i]["m_id"]?>]" size="25" value="<?php if (isset($menu[$i]["value"])) {echo $menu[$i]["value"];}?>" />
													<br />
													<b><?php echo _MENU.' '._CHOICES?></b>
													<textarea name="m_choices[<?php echo $menu[$i]["m_id"]?>]" cols="45" rows="4" id="m_choices[<?php echo $menu[$i]["m_id"]?>]"><?php if (isset($column[$menu[$i]["m_id"]])) {echo stripslashes($column[$menu[$i]["m_id"]]);}?></textarea>
													<?php if (isset($c_id[$menu[$i]["m_id"]])) {echo $c_id[$menu[$i]["m_id"]];}?>
													<br /><br />
													</div>
												<?php
												}
										}
										?>
									</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"> <b><?php echo _PAGE.' '._NAME1?> :</b> </td>
				<td align="left" valign="top">
				<?php
						
					if ($row->s_id>0) {					
							$database->setQuery("SELECT page_id,title FROM #__ijoomla_surveys_pages WHERE s_id=$row->s_id ORDER BY ordering ASC");						
							$database->query();	
											if ($database->getErrorMsg()){										
													die($database->getErrorMsg());
											}					
							
							$listblocks=$database->loadAssocList();	
							if (count($listblocks)>0) {
				?>
					<select name="page_id" >
								<option value="" <?php if ($row->page_id<1&&!isset($_SESSION['selected_page_id'])) {echo " selected";} ?>> <?php echo _PLEASE_SELECT?></option>
						 <?php 
										 if ($row->page_id>0){
												 foreach ($listblocks as $block) {
								 ?>
								 <option value="<?php echo $block["page_id"]?>" <?php if ($row->page_id==$block["page_id"]) {echo " selected";} ?>><?php echo stripslashes($block["title"])?></option>
								 <?php   }  	     
										 }else{
												 foreach ($listblocks as $block) {
									 ?>
									 <option value="<?php echo $block["page_id"]?>" <?php if (isset($_SESSION['selected_page_id'])&&$_SESSION['selected_page_id']==$block["page_id"]) echo " selected" ?>><?php echo stripslashes($block["title"])?></option>
								 <?php   }
										 } ?>
				 </select>
				<?php 
						 }else echo "<b style='color:red'>"._PLEASE_CREATE_PAGE."</b><input type='hidden' name='page_id' value='' />";
					}else echo "<b style='color:red'>"._PLEASE_CREATE_SURVEY."</b>";
					
				 ?>
				
				</td>
			</tr>
			<tr>
				<td align="left" valign="top" ><b><?php echo _QUESTION?>:</b> </td>
				<td align="left" valign="top">
						<textarea name="title" cols="60" rows="3"><?php echo stripslashes($row->title); ?></textarea>
				</td>				
					<tr>
						<td align="left"  valign="top"><b><?php echo _DESCRIPTION?>:</b></td>
						<td align="left" valign="top">
					<textarea name="description" id="description" cols="40" rows="3"><?php echo stripslashes($row->description)?></textarea>
					<?php
						// parameters : areaname, escription, hidden field, width, height, rows, cols
									// JEditor::display( 'editor1',  $row->description , 'description', '100%;', '250', '20', '30' ) ; 
					?>
					</td>
			 </tr>				
			
			<tr>
				<td align="left" valign="top"><b><?php echo _REQUIRED?>:</b></td>
				<td align="left" valign="top"><?php echo _NO?>  <input name="required" type="radio" value="0" <?php if ($row->required==0) {echo 'checked="checked"';} ?>/>
				 &nbsp; <?php echo _YES?> <input name="required" type="radio" value="1" <?php if ($row->required==1) {echo ' checked="checked"';} ?>  /></td>
			</tr>
				
				<tr>
					<td colspan="2" align="left">
						<div style="display:<?php if ($row->orientation=='open' && $row->type!='constant' && $row->type!='datetime'  && $row->type!='moreline') {echo 'none';} else {echo 'inline';} ?>" id="div_random_answers" align="left">
						<table border="0" cellpadding="3" cellspacing="0" align="left" width="65%">
						<tr>
						<td align="left" valign="top" width="22%"></td>
						<td align="left" valign="top" width="78%">
							<input name="random_a" type="checkbox" value="1" <?php if ($row->random_a==1) {echo 'checked="checked"';} ?>/>
							<b><?php echo _RANDOMIZE.' '._ANSWER." "._CHOICES?>:</b> 
						</td>
						</tr>
						</table>
						</div>
					</td>
				</tr>
				
			</tr>
			<tr>
			<td align="left" valign="middle" width="15%" valign="top"><b><?php echo _QUESTION." "._TYPE?>:</b>	</td>
			<td align="left" valign="middle" width="85%" valign="top">
			<?php /* iJoomla Al 31/10/2006 : original conditions made edit not 100% functional
			if ($row->orientation=='matrix' && $row->type=='menu') echo "<b>"._Matrix_Multiple_Answers_per_Row_Menus."</b>";
			elseif ($row->orientation=='open' && $row->type=='constant' ) echo "<b>"._Open_Ended_Constant_Sum."</b>";
			elseif ($row->orientation=='open' && $row->type=='date') echo "<b>"._Open_Ended_Date_and_or_Time."</b>";
			else {*/
					?>
			<select name="question_type" onchange="prepair_form(this)">
							<option  value="#" selected="selected">-- Select a Question Type --</option>
							<option  value="1" <?php if ($row->type=='radio' && $row->orientation=='vertical') {echo ' selected="selected"';} ?>><?php echo _CHOICE_ONE_ANSWER_VERTICAL?></option>
						<option  value="2" <?php if ($row->type=='radio' && $row->orientation=='horizontal') {echo ' selected="selected"';} ?>><?php echo _CHOICE_ONE_ANSWER_HORIZONTAL?></option>
						<option  value="3" <?php if ($row->type=='radio' && $row->orientation=='dropdown') {echo ' selected="selected"';} ?>><?php echo _CHOICE_ONE_ANSWER_MENU?></option>
						<option  value="4" <?php if ($row->type=='checkbox' && $row->orientation=='vertical') {echo 'selected="selected"';} ?>><?php echo _CHOICE_MULTIPLE_ANSWER_VERTICAL?></option>
						<option  value="5" <?php if ($row->type=='checkbox' && $row->orientation=='horizontal') {echo 'selected="selected"';} ?>><?php echo _CHOICE_MULTIPLE_ANSWER_HORIZONTAL?></option>
						<option  value="6" <?php if ($row->type=='radio' && $row->orientation=='matrix') {echo 'selected="selected"';}?>><?php echo _MATRIX_ONE_ANSWER_PER_ROW?></option>
						<option  value="7" <?php if ($row->type=='checkbox' && $row->orientation=='matrix') {echo 'selected="selected"';} ?>><?php echo _MATRIX_MULTIPLE_ANSWER_PER_ROW?></option>
						<option  value="8" <?php if ($row->type=='menu' && $row->orientation=='matrix') {echo 'selected="selected"';} ?>><?php echo _MATRIX_MULTIPLE_ANSWER_PER_ROW_MENUS?></option>
						<option  value="9" <?php if ($row->type=='text' && $row->orientation=='open') {echo 'selected="selected"';} ?>><?php echo _OPEN_ENDED_ONE_LINE_W_PROMPT?></option>
						<option  value="14" <?php if ($row->type=='moreline' && $row->orientation=='open') {echo 'selected="selected"';} ?>><?php echo _OPEN_ENDED_ONE_MORE_LINE_W_PROMPT?></option>
						<option  value="10" <?php if ($row->type=='textarea' && $row->orientation=='open') {echo 'selected="selected"';} ?>><?php echo _OPEN_ENDED_ESSAY?></option>
						<option  value="12" <?php if ($row->type=='constant' && $row->orientation=='open') {echo 'selected="selected"';} ?>><?php echo _OPEN_ENDED_CONSTANT_SUM?></option>
						<option  value="13" <?php if ($row->type=='datetime' && $row->orientation=='open') {echo 'selected="selected"';} ?>><?php echo _OPEN_ENDED_DATE_AND_OR_TIME?></option>					
						
				</select>	
			<?php /*}*/ ?>	
			</td>
		</tr>
		<?php
				$answers="";
				$aid="";
			for ($i=0;$i<count($answer);$i++) {
					$answers.=$answer[$i]->value."\n"; 
					$aid.="<input name='a_id[]' type='hidden' value='".$answer[$i]->a_id."' /> \n";
			}
		?>
		<tr>
			<td colspan="2" align="left">
			<div style="display:<?php if ($row->orientation=='open' && $row->type!='constant' && $row->type!='datetime' && $row->type!='moreline') {echo 'none';} else {echo 'inline';} ?>" id="div_answers" align="left">
			<table border="0" cellpadding="3" cellspacing="0" align="left" width="65%">
			<tr>
			<td align="left" valign="top" width="22%"><b><?php echo _ANSWER.' '._CHOICES?></b> <br /> <?php echo _ENTER_EARCH_CHOICE?></td>
			<td align="left" valign="top" width="78%">
				<textarea name="answer" cols="40" rows="7" id="answer"><?php echo stripslashes($answers)?></textarea>
				<?php echo $aid?>
			</td>
			</tr>
			</table>
			</div>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top"></td>
			<td>
				<div style="display:<?php if ($row->orientation=='open' && $row->type=='constant') {echo 'inline';} else {echo 'none';} ?>" id="div_constant" align="left">
				<table>
				<tr>
						<td align="left" valign="middle">
						<input type="text" name="constant" value="<?php echo $row->constant?>" size="5" maxlength="10" />
						</td>
						<td align="left" valign="top">
						<?php echo _ENTER_THE_TOTAL?>
						</td>
				</tr>
				<tr>
						<td colspan="2" align="left" valign="top">
								<?php echo _MIN_VALUE?>
								<input type="text" name="minvalue" id="minvalue" value="<?php if ($row->bounded==1) {echo $row->minvalue;}?>" size="5" maxlength="10" />
								<?php echo _MAX_VALUE?>
								<input type="text" name="maxvalue" id="maxvalue" value="<?php if ($row->bounded==1) {echo $row->maxvalue;}?>" size="5" maxlength="10" />
						</td>
				</tr>
				</table>
				</div>
			</td>
		</tr>
		<?php
			if ($row->orientation=='matrix' && $row->type!='menu') {
				$columns='';
				$ac_id="";
				for ($i=0;$i<count($column);$i++) {
					$columns.=$column[$i]->value."\n";
					$ac_id.="<input name='ac_id[]' type='hidden' value='".$column[$i]->ac_id."' /> \n";
				}
			}
			else {
					$columns=null;
					$ac_id=null;
			}
		?>
		<tr>
			<td colspan="2" align="left" valign="top">
					
			<div style="display:<?php if ($row->orientation=='matrix' & $row->type!='menu') echo 'inline'; else echo 'none'; ?>" id="div_column" align="left">
				<table width="100%" align="left">
					<tr>
					<td align="left" valign="top" width="22%"></td>
					<td align="left" valign="top" width="78%">
						<input name="random_c" type="checkbox" value="1" <?php if ($row->random_c==1) echo 'checked="checked"'; ?>/>
						<b><?php echo _RANDOMIZE.' '._COLUMN.' '._CHOICES?>:</b> 
					</td>
					</tr>					
					<tr>
					<td width="10%" align="left" valign="top"> <b><?php echo _COLUMN.' '._NAME1?>s</b> <br /><?php echo _ENTER_EARCH_COLUMN?></td>
					<td width="55%" align="left" valign="top"><textarea name="column" cols="40" rows="4" id="column"><?php echo stripslashes($columns)?></textarea>
					<?php echo $ac_id?>
					</td>									
					</tr>
				</table>
			</div>
			
			</td>
		</tr>
	
		<tr>
			<td colspan="2" align="left" valign="top">
				<div style="display:<?php if ($row->orientation=='vertical' || $row->orientation=='dropdown') echo "inline"; else echo "none"; ?>" id="div_other_field" align="left">
				<table align="left" width="100%">
				<tr>
					<td align="left" width="10%" valign="middle"><b><?php echo _HAS_OTHER_ANSWER?> :</b> </td>
					<td align="left" width="55%" valign="middle"><?php echo _NO?>  <input id="other_field_no" name="other_field" type="radio" value="0"  <?php if ($row->other_field==0) echo 'checked="checked"'; ?> onclick="Javascript:check_other()"/> 
									 &nbsp; <?php echo _YES?> <input id="other_field_yes" name="other_field" type="radio" value="1" <?php if ($row->other_field==1) echo 'checked="checked"'; ?>  /></td>
				</tr>
				<tr>
					<td align="left"><?php echo _OTHER_FIELD_S_TITLE?>: </td>
					<td align="left"><input type="text" name="other_field_title" id="other_field_title" value="<?php echo stripslashes($row->other_field_title)?>"  size="45" maxlength="250" onkeyup="Javascript:check_radios()" /></td>
				</tr>
				</table>
				</div>
			</td>
		</tr>
		</table></div>	
	<?php
		echo $tabs->endPanel();
		echo $tabs->startPanel(_PUBLISHING,'question-publishing');
	?>
	<table width="100%">
		<tr>
				<td align="left" width="20%"><b><?php echo _PUBLISHED?>:</b></td>
				<td align="left" width="80%">
					<input type="radio" name="published" value="0" <?php if ($row->published==0) echo 'checked'; ?> /> <?php echo _NO;?> &nbsp;
					<input type="radio" name="published" value="1" <?php if ($row->published==1) echo 'checked'; ?> /> <?php echo _YES;?>
				</td>
		
		</tr>
		<tr>
			<td align="left"><b><?php echo _SHOW_ON_RESULT?></b></td>
			<td align="left">
			<input type="radio" name="show_results" value="0" <?php if ($row->show_results==0) echo 'checked'; ?> /> <?php echo _NO;?> &nbsp;
			<input type="radio" name="show_results" value="1" <?php if ($row->show_results==1) echo 'checked'; ?> /> <?php echo _YES;?>
			</td>
		</tr>	
		<tr>
			<td align="left" ><b><?php echo _ORDERING?>:</b>	</td>
			<td align="left" >
				<select name="ordering">
					<option value="0" selected>0. <?php echo _FIRST?></option>
								
						<?php				    				 
				
					if ($row->s_id>0) {
						$database->setQuery("SELECT title,ordering FROM #__ijoomla_surveys_questions WHERE s_id=".$row->s_id." ORDER BY ordering ASC");											
						$database->query();	
											if ($database->getErrorMsg()){										
													die($database->getErrorMsg());
											}						
						if ($database->getNumRows()==0) {
								$database->setQuery("SELECT title,ordering FROM #__ijoomla_surveys_questions ORDER BY ordering ASC LIMIT 0,30");											
								$database->query();		
													if ($database->getErrorMsg()){										
															die($database->getErrorMsg());
													}						    
						}
					}
					else {
						$database->setQuery("SELECT title,ordering FROM #__ijoomla_surveys_questions ORDER BY ordering ASC LIMIT 0,30");											
						$database->query();		
											if ($database->getErrorMsg()){										
													die($database->getErrorMsg());
											}						
					}

					if ($database->getNumRows()>0) {								  	 
						$lists=$database->loadAssocList();		

							foreach ($lists as $question) {			
						?>
						
						<option value="<?php echo $question["ordering"]?>" <?php if ($row->ordering==$question["ordering"]) echo "selected"; ?>><?php echo $question["ordering"].'. '.stripslashes($question["title"])?></option>

						
						<?php
							}
							
							
							$last=1;
							$extra_query_cond="";
							if ($row->s_id>0){
									$extra_query_cond=" WHERE s_id=".$row->s_id." ";
							}
							
							$database->setQuery("SELECT MAX(ordering) FROM #__ijoomla_surveys_questions $extra_query_cond");
							$database->query();		
											if ($database->getErrorMsg()){										
													die($database->getErrorMsg());
											}
											if ($database->getNumRows()>0){
													$last=$database->loadResult()+1;
											}
							
							$last_ordering_selected=false;		
							if ($row->ordering=='last'){
									$row->ordering=$last;    
									$last_ordering_value=$last;
									$last_ordering_selected=true;					        
							}elseif ($row->ordering>=$last){
									$last_ordering_value=$row->ordering;
									$last_ordering_selected=true;					        
							}else{
									$last_ordering_value=$last;
							}
					}
					?>					    
					<option value="<?php echo $last_ordering_value?>" <?php if ($last_ordering_selected) { echo 'selected';} ?>><?php echo $last_ordering_value?>. <?php echo _LAST?></option>    				    				    
					</select>
			</td>
		</tr>
		<tr>
				<td valign="top" align="left">
					<b><?php echo _OVERRIDE.' '._CREATED.' '._DATE?></b>
				</td>
				<td>
					<input class="text_area" type="text" name="created_date" id="created_date" size="25" maxlength="19" value="<?php echo date("Y-m-d h:i:s",$row->created_date); ?>" />
					<input name="reset" type="reset" class="button" onClick="return showCalendar('created_date', 'y-mm-dd h:i:s');" value="..." />
				</td>
		</tr>
		<tr>
			<td align="left"><b><?php echo _START.' '._PUBLISHING?>:</b></td>
			<td align="left"> 
				<input class="text_area" type="text" name="start_date" id="start_date" size="25" maxlength="19" value="<?php echo date("Y-m-d h:i:s",$row->start_date); ?>" />
				<input name="reset" type="reset" class="button" onClick="return showCalendar('start_date', 'y-mm-dd h:i:s');" value="..." />
				
			</td>
		</tr>
		<tr>
			<td align="left"><b><?php echo _FINISH.' '._PUBLISHING?>:</b></td>
			<td align="left"> 
				<input class="text_area" type="text" name="end_date" id="end_date" size="25" maxlength="19" value="<?php echo date("Y-m-d h:i:s",$row->end_date); ?>" />
				<input name="reset" type="reset" class="button" onClick="return showCalendar('end_date', 'y-mm-dd h:i:s');" value="..." />
				
			</td>
		</tr>
	</table>
	<?php	
		echo $tabs->endPanel();
		echo $tabs->endPane();
	?>
		<input type="hidden" name="q_id" value="<?php echo $row->q_id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="<?php echo $act?>" />
		<input type="hidden" name="orientation" value="<?php echo $row->orientation?>" />
		<input type="hidden" name="type" value="<?php echo $row->type?>" />
	</form>
	<?php
						if ($must_reload==1){
												?>
												<script type="text/javascript">
														reload();
												</script>
											 <?php
						}
		}
	}
// BLOCK
class HTML_blocks {

function showblock( &$rows, $pageNav, $option ,$act) {
	global $mainframe,  $search, $n;
	$database = &JFactory::getDBO();
	$errcode=JArrayHelper::getValue($_GET,'errcode');	
	if ($errcode){
			switch ($errcode){
					case '1' :case '2' :
					$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._QUESTION." "._BECAUSE_PART_OF_SKIP;break;
					case '3' : case '4' : 
					$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._PAGE." "._BECAUSE_PART_OF_SKIP;break;
					case '4' :case '12':case '13':
					$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._PAGE." "._BECAUSE_PART_OF_SKIP;break;	        
					default  :
					$error_msg=_YOU_CANT." "._UNPUBLISH." "._THIS." "._PAGE."/"._QUESTION." "._BECAUSE_PART_OF_SKIP;
			}
			echo "<script type=\"text/JavaScript\">alert('$error_msg')</script>" ;
	}
	?>
	<script type="text/JavaScript">
	<!--
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}
	//-->
	</script>
	<form action="index2.php" method="post" name="adminForm">
	<table width="100%">
		<tr>
			<td align="right">
	<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/create.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
		</tr>	
	</table>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<td ><h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL()?>/administrator/components/com_surveys/images/icons/pages.png" width="48" height="48" align="middle" /><?php echo _PAGES.' '._MANAGER?></h2></td>
			<td align="right" valign="bottom"> 
					<table align="right">
					<tr>
							<td align="right">
				<?php
					$database->setQuery("SELECT s_id,title FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC");											
					$database->query();							
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
					$s_id =JArrayHelper::getValue($_GET,'s_id');
					if ($database->getNumRows()>0) {								  	 
						$lists=$database->loadAssocList();													
				?>
					<select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
						<option value="index2.php?option=<?php echo $option?>&act=block" <?php if (intval($s_id)==0) {echo " selected";} ?>> <?php echo _ALL.' '._SURVEYS?> </option>
						<?php 
						foreach ($lists as $survey) {
						?>
						 <option value="index2.php?option=<?php echo $option?>&act=block&s_id=<?php echo $survey["s_id"]?>" <?php if ($survey["s_id"]==intval($s_id)) echo " selected" ?>><?php echo stripslashes($survey["title"])?></option>
						<?php } ?>
				 </select>
				<?php } ?>
						</td>
				</tr>
						<tr>
								<td nowrap valign="bottom">
										<table align="right">
											<td valign="middle" align="right">
											<?php echo _FILTER;?>: <input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
												</td>
												<td valign="middle">
												<input type="submit" name="submit_btn" value="<?php echo _GO;?>" />
												</td>
										</table>
								</td>
						</tr>				
						</table>
			</td>
			
		</tr>		
	</table>

	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="2%" align="center">#</th>
			<th width="2%" align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
			<th width="30%" align="left"><?php echo _PAGE.' '._NAME1?></th>
			<th width="10%" align="center"><?php echo _SHOW.' '._TITLE?></th>
			<th width="10%" align="center"><?php echo _PUBLISHED?></th>
			<th width="10%" colspan="2" align="center"><?php echo _REORDER?> </th>
			<th width="10%" align="center">
					<table cellpadding="0" cellspacing="0">
							<tr>
									<td style="padding-left:0px;padding-right:0px;border:none"><?php echo _ORDER?></td>
									<td style="padding-left:2px;padding-right:0px;border:none"><a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a></td>
							</tr>
					</table>			 			
			</th>
			<th width="15%" align="center"> <?php echo _SURVEY.' '._NAME1?> </th>
			<th width="11%" align="center"> <?php echo _PAGE?> ID</th>
			<th width="10%" align="center"> <?php echo _QUESTIONS?></th>
		</tr>
	<?php
		$k = 0;
		for($i=0; $i < count( $rows ); $i++) {
			$row = $rows[$i];
			$img = $row->published ? 'tick.png' : 'publish_x.png';
			$task = $row->published ? 'unpublish' : 'publish';
			$database->setQuery("SELECT count(q_id) FROM #__ijoomla_surveys_questions WHERE s_id=$row->s_id AND page_id=$row->page_id");											
			list($questions)=$database->loadRow();										
			$database->setQuery("SELECT title FROM #__ijoomla_surveys_surveys WHERE s_id=".$row->s_id);											
			list($survey_name)=$database->loadRow();	  	 
			$show_title=$row->show_title?'tick.png':'publish_x.png';
			$show_t=$row->show_title?"unshowtitle":"showtitle";
						
	?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+$pageNav->limitstart+1;?></td>
			<td align="center"><input type="checkbox" id="cb<?php echo $i;?>" name="page_id[]" value="<?php echo $row->page_id; ?>" onclick="isChecked(this.checked);" /></td>
			<td align="left" ><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo stripslashes($row->title); ?></a></td>
			<td align="center">
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $show_t?>')"><img src="images/<?php echo $show_title;?>" border="0" alt="" /></a>
			</td>
			<td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" border="0" alt="" /></a>
			</td>
			<td align="center">
				<?php echo $pageNav->orderUpIcon( $i ); ?>
			</td>
			<td align="center">
				<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
			</td>
			
			
			<td align="center">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td>
			<td align="center"><?php echo stripslashes($survey_name)?></td>
			<td align="center"><?php echo $row->page_id?></td>
			<td align="center"><a href="index2.php?option=<?php echo $option?>&act=question&s_id=<?php echo $row->s_id?>&page_id=<?php echo $row->page_id?>"><?php echo $questions?></a></td>
		</tr>
	<?php
			$k = 1 - $k;
		}
	?>
		<tr>
			<th align="center" colspan="11"> <?php //echo $pageNav->getPagesCounter(); ?></th>
		</tr>
		<tr>
				<td colspan="16" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						
				</table>
				<?php echo $pageNav->getListFooter(); ?>
				</td>
		</tr>
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="s_id" value="<?php echo intval($s_id); ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="<?php echo $act?>" />
	</form>
	<?php
	}
function editblock( &$row , &$images, &$lists, $option ,$act) {
	global $mainframe;
	$database = &JFactory::getDBO();
	JOutputFilter::objectHTMLSafe( $row, ENT_QUOTES );
	?>
	<script language="javascript" type="text/javascript">
		var folderimages = new Array;
		<?php
		$i = 0;
		foreach ($images as $k=>$items) {
			foreach ($items as $v) {
				echo "folderimages[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( pressbutton );
				return;
			}
			
			if (form.title.value == '') {
				alert( "<?php echo _PLEASE_FILL_PAGE_TITLE;?>" );
			} else {
				if (form.s_id.value=='') {
					alert("<?php echo _PLEASE_SELECT_SURVEY;?>");
				}
				else {
					if (form.s_id.value==0) {
						alert("<?php echo _YOU_MUST_ADD_SURVEY;?>");
					}
				
				else {
					var temp = new Array;
					for (var i=0, n=form.imagelist.options.length; i < n; i++) {
						temp[i] = form.imagelist.options[i].value;
					}
					if (temp.length>0) form.images.value = temp[0];
					else form.images.value = '';
					
					<?php
						
					$editor1  = & JFactory::getEditor();
								// parameters : areaname, description, hidden field, width, height, rows, cols
						echo $editor1->save( 'editor1', 'description' ) ;
					?>
					
					submitform( pressbutton );
				}
				}
			}
			
		}
		
	</script>
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table width="100%">
		<tr>
			<td>
	<h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL()?>/administrator/components/com_surveys/images/icons/pages.png" width="48" height="48" align="middle" />
	<?php 
	if ($row->title!='') {
			echo " "._EDIT." "._PAGE." </h2>";
	}
	else {
			echo " "._NEW." "._PAGE." </h2>";
	}
	?>
			</td>
			<td align="right">
				<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/create.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
		</tr>	
	</table
	><?php
		jimport( 'joomla.html.pane' );
	
		$tabs =& JPane::getInstance('tabs');
		echo $tabs->startPane("EditPagePane");
		echo $tabs->startPanel(_GENERAL,"question-general");
	?>	
	
	<table border="0" cellpadding="3" cellspacing="0"  class="adminform" >
			<tr>
				<td align="left" width="10%" valign="top"><b><?php echo _PAGE.' '._NAME1?>:</b> </td>
				<td align="left" width="90%" valign="top">
					<input class="inputbox" type="text" size="50" maxlength="250" name="title" value="<?php echo stripslashes($row->title); ?>" />
				</td>
			</tr>
			<tr>
				<td align="left" width="10%" valign="top"><b> <?php echo _SURVEY.' '._NAME1?>: </b></td>
				<td align="left" width="90%" valign="top">
				
				<?php
					$database->setQuery("SELECT s_id,title FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC");											
					$database->query();				
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
					if ($database->getNumRows()>0) {	
						$listsurvey=$database->loadAssocList();				
				?>
					<select name="s_id" >
						 <option value="" <?php if ($row->s_id<1&&(isset($_SESSION['selected_survey_id'])&&$_SESSION['selected_survey_id']<1)) {echo " selected";} ?>> <?php echo _PLEASE_SELECT?></option>
						 <?php 
						 if ($row->s_id>0) {
								 foreach ($listsurvey as $survey) {
										 if (isset($survey["s_id"])){
									 ?>				  	 
								 <option value="<?php echo $survey["s_id"]?>" <?php if ($row->s_id==$survey["s_id"]) {echo " selected";} ?>><?php echo stripslashes($survey["title"])?></option>
									 <?php 
										 }
								 } 
						 }else {
						 foreach ($listsurvey as $survey) {
						 ?>				  	 
						 <option value="<?php echo $survey["s_id"]?>" <?php if (isset($_SESSION['selected_survey_id'])&&$_SESSION['selected_survey_id']==$survey["s_id"]) {echo " selected";} ?>><?php echo stripslashes($survey["title"])?></option>
						<?php }
						 } ?>
				 </select>
				<?php }
				else { ?>
				<b><span style="color:red"><?php echo _YOU_MUST_ADD_SURVEY;?>e</span></b><input type="hidden" name="s_id" value="0" />
				<?php
				}
				?>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<b><?php echo _SHOW." "._TITLE?>:</b>
				</td >
				<td valign="top">
					<input type="radio" name="show_title" value="0" <?php if (!$row->show_title) echo "checked"; ?>> <?php echo _NO?> <input type="radio" name="show_title" value="1" <?php if ($row->show_title) echo "checked"; ?> /> <?php echo _YES?>
				</td>
					
			</tr>
			<tr>
				<td valign="top"><b> <?php echo _ORDERING?>:</b></td>
				<td valign="top">
					<?php
							if ($row->page_id){ // block edit
									//minimum
									$query="SELECT MAX(s_pages.ordering) min_order ,COUNT(s_pages.ordering) count_order FROM #__ijoomla_surveys_pages s_pages, #__ijoomla_surveys_skip_logics s_logics ";
									$query.=" WHERE s_pages.s_id=s_logics.s_id ";
									$query.=" AND s_pages.page_id=s_logics.page_id";
									$query.=" AND s_logics.page_target=$row->page_id";
									
									$database->setQuery($query);
														$result=$database->loadAssocList();
														if ($database->getErrorMsg()){
																die($database->getErrorMsg());
														}
														$min_limit=false;
									if ($result[0]["count_order"]>0){
											$min_ordering=$result[0]["min_order"];
											$min_limit=true;
									}
									$query_add_min="";
									if ($min_limit){
											$query_add_min=" AND ordering > $min_ordering ";
									}
									
									//maximum
									$query="SELECT MIN(s_pages.ordering) max_order,COUNT(s_pages.ordering) count_order FROM #__ijoomla_surveys_pages s_pages, #__ijoomla_surveys_skip_logics s_logics ";
									$query.=" WHERE s_pages.s_id=s_logics.s_id ";
									$query.=" AND s_pages.page_id=s_logics.page_target";
									$query.=" AND s_logics.page_id=$row->page_id";
									
									$database->setQuery($query);
														$result=$database->loadAssocList();
														if ($database->getErrorMsg()){
																die($database->getErrorMsg());                            
														}
														$max_limit=false;
									if ($result[0]["count_order"]>0){
											$max_ordering=$result[0]["max_order"];
											$max_limit=true;
									}
									$query_add_max="";
									if ($max_limit){
											$query_add_max=" AND ordering < $max_ordering ";
									}
							}
							
						if ($row->s_id>0) {
							$database->setQuery("SELECT title,ordering FROM #__ijoomla_surveys_pages WHERE s_id=".$row->s_id." ".$query_add_min." ".$query_add_max." ORDER BY ordering ASC");
						}
						else{
							$database->setQuery("SELECT title,ordering FROM #__ijoomla_surveys_pages ORDER BY ordering ASC LIMIT 0,30");											
						}
						$database->query();		
						if ($database->getErrorNum()) {
								echo $database->stderr();
								return false;
						}
					?>
						<select name="ordering">
					<?php 
						if (!$min_limit){ // only if min limit not existant
					?>
							<option value="0" selected>0. <?php echo _FIRST?></option>
					<?php
						}
						$last=1;
						if ($database->getNumRows()>0) {	
							$listpages=$database->loadAssocList();	
														if ($database->getErrorMsg()){
																die($database->getErrorMsg());																					
														}
							foreach ($listpages as $page){
					?>
							<option value="<?php echo $page["ordering"]?>" <?php if ($row->ordering==$page["ordering"]) {echo "selected";}?>><?php echo $page["ordering"].'. '.stripslashes($page["title"])?></option>
					<?php
											$last=$page["ordering"]+1;
							}
						}
						if (!$max_limit){ // only if max limit not existant
						?>	
							<option value="<?php echo $last?>" <?php if ($row->ordering=='last') { $row->ordering=$last; echo 'selected';} ?>><?php echo $last?>. <?php echo _LAST?></option>
						<?php
						}
						?>
						</select>
				
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b><?php echo _DESCRIPTION; ?>:</b></td>
				<td style="text-align: center;" >
					<?php
						// parameters : areaname, escription, hidden field, width, height, rows, cols
							$editor1  = & JFactory::getEditor();
								// parameters : areaname, description, hidden field, width, height, rows, cols
								//$row->description = str_replace('\\&quot;', '', $row->description);
								echo $editor1->display( 'editor1',  ''.stripslashes($row->description) , '100%', '200', '10', '45' ) ; 
					?>
				</td>
			</tr>
	</table>
	<?php
		echo $tabs->endPanel();
		echo $tabs->startPanel(_IMAGES,"Images");
	?>
		<div style="display:block; overflow:auto; height:325px; width:100%;">
		<table class="adminform" width="100%">
			<tr>
				<td colspan="3"><?php echo _SUB_FOLDER?>: <?php echo $lists['folders'];?></td>
			</tr>
			
			<tr>
				<td width="45%" style="text-align:center">
					<b><?php echo _GALLERY_IMAGES?></b>:
					<br />
					<?php echo $lists['imagefiles'];?>
				</td>
				<td width="10%">
				<input class="button" type="button" value="Add >>" onClick="addSelectedToList('adminForm','imagefiles','imagelist')" /> <br />
				<input class="button" type="button" value="<< Remove" onClick="delSelectedFromList('adminForm','imagelist')" />
				</td>
				<td width="45%" style="text-align:center">
					<b><?php echo _PAGE?> <?php echo _IMAGES?>:</b>
					<br />
					<?php echo $lists['imagelist'];?>
				</td>
			</tr>
			
			<tr>
				<td valign="top" align="left" width="50%">
					<div style="display:block; overflow:hidden; width:100%;" align="center">
						<img name="view_imagefiles" src="../images/M_images/blank.png" />
					</div>							
				</td>
				<td></td>
				<td width="50%">
					<div style="display:block; overflow:hidden; width:100%;" align="center">
						<img name="view_imagelist" src="../images/M_images/blank.png"  />
					</div>
				</td>
			</tr>
				
			<tr>
					<td colspan="3">
							<div style="display: none">
						Edit the image selected:
						<table>
						<tr>
							<td align="right">
							Source:
							</td>
							<td>
							<input class="text_area" type="text" name= "_source" value="" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Image Align:
							</td>
							<td>
							<input class="text_area" type="text" name="_align" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Alt Text:
							</td>
							<td>
							<input class="text_area" type="text" name="_alt" value="" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Border:
							</td>
							<td>
							<input class="text_area" type="text" name="_border" value="" size="3" maxlength="1" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption Position:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption_position" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption Align:
							</td>
							<td>
							<input class="text_area" type="text" name="_caption_align" value="" size="30" />
							</td>
						</tr>
						<tr>
							<td align="right">
							Caption Width:
							</td>
							<td>
							<input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<input class="button" type="button" value="Apply" onclick="applyImageProps()" />
							</td>
						</tr>
						</table>
						</div>
					</td>
				</tr>			
		</table>
		</div>
	<?php
		echo $tabs->endPanel();
		echo $tabs->startPanel(_PUBLISHING,"Publishing");
	?>
		<table>
			<tr>
				<td align="left"><?php echo _PUBLISHED?>:</td>
				<td align="left">
					<input type="radio" name="published" value="0" <?php if ($row->published==0) echo 'checked'; ?> /> <?php echo _NO;?> &nbsp;
					<input type="radio" name="published" value="1" <?php if ($row->published==1) echo 'checked'; ?> /> <?php echo _YES;?>
				</td>
		
			</tr>
		</table>

	<?php
		echo $tabs->endPanel();
		echo $tabs->endPane();
	?>
		<input type="hidden" name="page_id" value="<?php echo $row->page_id; ?>" />
		<input type="hidden" name="images" value="<?php echo $row->images?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="<?php echo $act?>" />
		</form>
		
		<script type="text/javascript">
			
			function returnObjById( id )
			{
				if (document.getElementById)
					var returnVar = document.getElementById(id);
				else if (document.all)
					var returnVar = document.all[id];
				else if (document.layers)
					var returnVar = document.layers[id];
				return returnVar;
			}
			
			function ascunde(){
				
				var browser=navigator.appName;
				if (browser=="Microsoft Internet Explorer"){
					
					var pp=returnObjById('question-general');
					
					pp.onclick=function(){																								
						afis().style.display='block';
						
					};
				
					var mp=returnObjById('Images');
					
					mp.onclick=function(){																													
							afis().style.display='none';
					
					};
					
					var pp=returnObjById('Publishing');
					
					pp.onclick=function(){																								
						afis().style.display='none';
						
					};
									
				}
			
			}			
			
			function afis(){
				var b=document.adminForm.getElementsByTagName('span');
				for(i=0; i<b.length; i++)
					if(b[i].className=='mceToolbarContainer')
						return b[i];
			}
			
			ascunde();
			
		</script>
	<?php
	}
	}

	// 	END BLOCK

	// START SKIP LOGIC

class HTML_skiplogics {

function cutstring($str='',$chars=150) {
	$str=str_replace('{mosimage}','',$str);
	if (strlen($str)<$chars) return $str;
	$temp=$chars;
	while ($str[$temp]!=' ') $temp--;
	$r=substr($str,0,$temp);
	if ($temp<$chars) $r.='...';
	
	return $r;
}
	
function showskiplogic( &$rows, $pageNav, $option ,$act,$s_id,$page_id) {
	global $mainframe,  $search;
	$database = &JFactory::getDBO();
	$errcode     =JArrayHelper::getValue($_GET,'errcode');
	$get_s_id    =JArrayHelper::getValue($_GET,'s_id'   );
	$get_page_id =JArrayHelper::getValue($_GET,'page_id');
	if ($errcode){
			switch ($errcode){
					case '7':
					default :$error_msg=_QUESTION_CHANGED_TO_REQUIRED;
			}
			echo "<script type=\"text/JavaScript\">alert('$error_msg')</script>" ;
	}
	?>
	<script type="text/JavaScript">
	<!--
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}
	//-->
	</script>
	<form action="index2.php" method="post" name="adminForm">
	<table width="100%">
		<tr>
			<td align="right">
				<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/skip.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
		</tr>	
	</table>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<td width="100%" ><h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL()?>/administrator/components/com_surveys/images/icons/skip_actions.png" width="48" height="48" align="middle" /><?php echo _SKIP.' '._ACTIONS.' '._MANAGER?></h2></td>
			<td valign="bottom">
					<table align="right">
						<tr>
							<td nowrap align="right"> 
				<?php
					$database->setQuery("SELECT s_id,title FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC");
					$database->query();
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
										$s_id   = JArrayHelper::getValue($_GET,'s_id'   );            					
										$page_id= JArrayHelper::getValue($_GET,'page_id');
				?>
					<select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
						<option value="index2.php?option=<?php echo $option?>&act=skip" <?php if (intval($s_id)==0) echo " selected" ?>> <?php echo _ALL.' '._SURVEYS?> </option>
						<?php 
						if ($database->getNumRows()>0) {
							$lists=$database->loadAssocList();
							foreach ($lists as $survey) {
						?>
						 <option value="index2.php?option=<?php echo $option?>&act=skip&s_id=<?php echo $survey["s_id"]?>" <?php if ($survey["s_id"]==intval($s_id)) echo " selected" ?>><?php echo stripslashes($survey["title"])?></option>
						<?php } 
						}?>
				 </select>
					<?php	
					if (intval($s_id)&&($s_id>0)) {
						$database->setQuery("SELECT page_id,title FROM #__ijoomla_surveys_pages WHERE s_id=".intval($s_id)." ORDER BY ordering ASC");						
					}
					else {
						$database->setQuery("SELECT page_id,title FROM #__ijoomla_surveys_pages ORDER BY ordering ASC");						
					}
					$database->query();					
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
				?>
					<select name="menu2" onchange="MM_jumpMenu('parent',this,0)">
						<option value="index2.php?option=<?php echo $option?>&act=skip&s_id=<?php echo intval($s_id)?>" <?php if (intval($page_id)==0) echo " selected" ?>> <?php echo _ALL.' '._PAGES?> </option>
						<?php 
						
						if ($database->getNumRows()>0) {
							$lists=$database->loadAssocList();
							foreach ($lists as $block) {
						?>
						 <option value="index2.php?option=<?php echo $option?>&act=skip&s_id=<?php echo intval($s_id)?>&page_id=<?php echo $block["page_id"]?>" <?php if ($block["page_id"]==intval($page_id)) { echo " selected"; }?>><?php echo stripslashes($block["title"])?></option>
						<?php }
						} ?>
				 </select>
											
												</td>         				 
							</tr>	
								<tr>
										<td nowrap valign="bottom" align="right">
												<table align="right">
											<td valign="middle" align="right">
											<?php echo _FILTER;?>: <input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
												</td>
												<td valign="middle">
												<input type="submit" name="submit_btn" value="<?php echo _GO;?>" />
												</td>
												</table>
										</td>
								</tr>	
							</table>
						</td>							
		</tr>
	</table>

	<table cellpadding="9" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr>
			<th width="2%" align="center">#</th>
			<th width="2%" align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
			<th width="8%" align="left"><?php echo _SKIP.' '._NAME1?></th>
			<th width="15%" align="center"><?php echo _QUESTION.' '._NAME1?></th>
			<th width="7%" align="center"><?php echo _COMPARE?></th>
			<th width="12%" align="center"><?php echo _ANSWER.' '._VALUE?></th>
			<th width="5%" align="center"><?php echo _ACTION?></th>
			<th width="8%" align="center"><?php echo _PAGE?></th>
			<th width="10%" align="center">
					<table cellpadding="0" cellspacing="0" border="0">
							<tr>
									<td style="padding-left:0px;padding-right:0px;border:none"><?php echo _ORDER ; ?></td>
									<td style="padding-left:2px;padding-right:0px;border:none"><a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a></td>
							</tr>
					</table> 			
			</th>
			<th width="3%" align="center"> <?php echo _PUBLISHED?> </th>
			<th width="10%" align="center"> <?php echo _SURVEY." "._NAME1?> </th>
			<th width="10%" align="center"> <?php echo _PAGE." "._NAME1?></th>
			<th width="7%" align="center"> <?php echo _SKIP."ID"?></th>
		</tr>
	<?php
		$k = 0;
		for($i=0; $i < count( $rows ); $i++) {
			$answer_value='';		    
			$row = $rows[$i];
			$img = $row->published ? 'tick.png' : 'publish_x.png';
			$task = $row->published ? 'unpublish' : 'publish';
			$database->setQuery("SELECT title FROM #__ijoomla_surveys_surveys WHERE s_id=".$row->s_id);																
			list($survey_name)=$database->loadRow();
			$database->setQuery("SELECT title FROM #__ijoomla_surveys_pages WHERE page_id=$row->page_id");																
			list($block_name)=$database->loadRow();			
			$database->setQuery("SELECT title FROM #__ijoomla_surveys_questions WHERE q_id=$row->q_id");																
			list($question_name)=$database->loadRow();
			if ($row->a_id) {
				$database->setQuery("SELECT value FROM #__ijoomla_surveys_answers WHERE a_id IN ($row->a_id) ORDER BY a_id ASC");																																				
				$answ=$database->loadRowList();				
				foreach ($answ as $key => $value) {	
						if (is_array($value)){
								if ($key==0) {
										$answer_value.=stripslashes($value[0]);
								}
								else{
										$answer_value.=" ".$row->logic." ".stripslashes($value[0]);
								}
						}else{
								if ($key==0) {
										$answer_value.=stripslashes($value);
								}
								else{
										$answer_value.=" ".$row->logic." ".stripslashes($value);
								}
						}
				}
			}
			else {
					$answer_value="Empty";
			}
			$compare=$row->compare=="equal"?"Equal":"Different than";
			$action=$row->action=="jump"?"Jump to":"Skip";
			$database->setQuery("SELECT title FROM #__ijoomla_surveys_pages WHERE page_id=$row->page_target");																
			list($block_target)=$database->loadRow();	
			// 0.0.30
				if ($row->page_target==-1){
						$block_target = _SURVEY_END;
				}
	?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center"><?php echo $i+$pageNav->limitstart+1;?></td>
			<td align="center"><input type="checkbox" id="cb<?php echo $i;?>" name="sk_id[]" value="<?php echo $row->sk_id; ?>" onclick="isChecked(this.checked);" /></td>
			<td align="left" ><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo stripslashes($row->title); ?></a></td>
			<td align="center">	<?php echo stripslashes($question_name)?>	</td>
			<td align="center">	<?php echo $compare?>	</td>
			<td align="center">	<?php echo $answer_value?>	</td>
			
			<td align="center">	<?php echo $action?>	</td>
			<td align="center">	<?php echo stripslashes($block_target)?>	</td>
			<td align="center">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td>
			
			<td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" border="0" alt="" /></a>
			</td>
			
			<td align="center"><?php echo stripslashes($survey_name)?></td>
			<td align="center"><?php echo stripslashes($block_name)?></td>
			<td align="center"><?php echo $row->sk_id?></td>
		</tr>
	<?php
			$k = 1 - $k;
		}
		
	?>
		<tr>
			<th align="center" colspan="13"> <?php echo $pageNav->getPagesCounter(); ?></th>
		</tr>
		<tr>
				<td colspan="16" width="100%" align="center" style="border:none">
				<table align="center" cellpadding="0" cellspacing="0" border="0">
						
				</table>
				<?php echo $pageNav->getListFooter(); ?>
				</td>
		</tr>
	</table>
	
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="s_id" value="<?php echo intval($get_s_id); ?>" />
		<input type="hidden" name="page_id" value="<?php echo intval($get_page_id); ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="act" value="<?php echo $act?>" />
		</form>
	<?php
	}
function editskiplogic( &$row ,$option ,$act) {
	global $mainframe;
	$database = &JFactory::getDBO();
	JOutputFilter::objectHTMLSafe( $row, ENT_QUOTES );
	?>
	<script language="javascript" type="text/javascript">
			function update_select(){
					var form = document.adminForm;
					var select1 = document.getElementById('page_target_1');
					var select2 = document.getElementById('page_target_2');
					
					if (form.action.value=="jump"){
							select1.style.display='none';
							select2.style.display='block';
					}else{
							/* 0.0.30
							if (select2.options[select2.selectedIndex].value="<?php echo _SURVEY_END?>"){
									select1.selectedIndex=0;
							}*/
							select1.style.display='block';
							select2.style.display='none';	            
					}
			}
			function pre_reload(){
					var question_input = document.getElementById('q_id_select');
					if (question_input){
							if (question_input.selectedIndex!=0){
									question_input.selectedIndex=0;
							}
					}
			}	    
		function reload() {
			submitform('reload');
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
					var select1 = document.getElementById('page_target_1');
					var select2 = document.getElementById('page_target_2');
						 
			if (pressbutton == "cancel") {
				submitform( pressbutton );
				return;
			}
			
					if (select1==null||select2==null){
							alert("<?php echo _FOLLOW_INSTRUCTIONS_FOR_SKIP;?>");
							return;
					}
								
						if (form.action.value=="jump"){
								form.page_target.value=select2.options[select2.selectedIndex].value;
						}else{
								form.page_target.value=select1.options[select1.selectedIndex].value;
						}
						
			if (form.title.value == '') {
				alert( "<?php echo _PLEASE_FILL_SKIP_NAME;?>" );
			}
			else {
				if (form.s_id.value=='') alert("<?php echo _PLEASE_SELECT_SURVEY;?>");
				else {
					if (form.page_id.value=='') alert("<?php echo _PLEASE_SELECT_PAGE;?>");
					else {
						if (form.q_id.value=='') alert("<?php echo _PLEASE_SELECT_QUESTION;?>");
						else {																					
							if (form.page_target.value=='') alert("<?php echo _SELECT_ACTION_TARGET;?> ");
							else 	{
									
									submitform( pressbutton );
							}
						}
					}
				}
			}
			
		}
		
	</script>
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table width="100%">
		<tr>
			<td>
	<h2 style="color:#669900"><img src="<?php echo $mainframe->getSiteURL()?>/administrator/components/com_surveys/images/icons/skip_actions.png" width="48" height="48" align="middle" />
	<?php 
		if ($row->title!='') {
				echo _EDIT_SKIP." </h2>";
		}
		else {
				echo _NEW." "._SKIP." "._ACTION."</h2>";
		}
	?>	
			</td>			
			<td align="right">
				<a target="_blank" href="http://www.ijoomla.com/redirect/survey/videos/skip.htm" class="video">Video Tutorial <img src="components/com_surveys/images/icon_video.gif"></a>
			</td>
		</tr>	
	</table>
	<table border="0" cellpadding="3" cellspacing="0" align="left" class="adminform" >
			<tr>
				<td align="left" width="15%" valign="top"><b><?php echo _SKIP." "._ACTION." "._NAME1?>:</b> </td>
				<td align="left" width="85%" valign="top">
					<input class="inputbox" type="text" size="50" maxlength="250" name="title" value="<?php echo stripslashes($row->title); ?>" />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b><?php echo _SURVEY." "._NAME1?>: </b></td>
				<td align="left" valign="top">
				
				<?php
					$database->setQuery("SELECT s_id,title FROM #__ijoomla_surveys_surveys ORDER BY ordering ASC");																
					$database->query();					
									if ($database->getErrorMsg()){										
											die($database->getErrorMsg());
									}					
					if ($database->getNumRows()>0) {
						$lists=$database->loadAssocList();					
				?>
					<select name="s_id" onchange="return reload()">  >
					<option value="" <?php if ($row->s_id<1) echo " selected" ?>> <?php echo _PLEASE_SELECT?> </option>
						 <?php 
						 foreach ($lists as $survey) {
						 ?>
						 
						 <option value="<?php echo $survey["s_id"]?>" <?php if ($row->s_id==$survey["s_id"]) {echo " selected";} ?>><?php echo stripslashes($survey["title"])?></option>
						<?php } ?>
				 </select>
				<?php }
				else echo "<strong style=\"color:red\">Please create a survey</strong>"; ?>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b> <?php echo _PAGE." "._NAME1?>: </b> </td>
				<td align="left" valign="top">
					<?php
					if ($row->s_id) {
						$database->setQuery("SELECT page_id,title FROM #__ijoomla_surveys_pages WHERE s_id=$row->s_id ORDER BY ordering ASC");																
						$database->query();
											if ($database->getErrorMsg()){										
													die($database->getErrorMsg());
											}						
						if ($database->getNumRows()>0) {
							$lists=$database->loadAssocList();
						?>
							<select name="page_id" onchange="pre_reload();return reload()">  >
							<option value="" <?php if ($row->page_id<1) echo " selected" ?>> <?php echo _PLEASE_SELECT?> </option>
								 <?php 
								 foreach ($lists as $block){
								 ?>
								 
								 <option value="<?php echo $block["page_id"]?>" <?php if ($row->page_id==$block["page_id"]) echo " selected" ?>><?php echo stripslashes($block["title"])?></option>
								<?php } ?>
						 </select>
						<?php }
						else echo "<strong style=\"color:red\">"._PLEASE_CREATE_PAGE."</strong>"; 
					}
					else echo "<strong style=\"color:red\">"._PLEASE_SELECT_SURVEY."</strong>";
					?>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b><?php echo _QUESTION." "._NAME1?>: </b></td>
				<td align="left" valign="top">
					<?php
					if ($row->s_id) {
						if ($row->page_id) {
							$database->setQuery("SELECT q_id,title FROM #__ijoomla_surveys_questions WHERE s_id=$row->s_id AND page_id=$row->page_id AND orientation!='open'  ORDER BY ordering ASC");																
							$database->query();
													if ($database->getErrorMsg()){										
															die($database->getErrorMsg());
													}							
							if ($database->getNumRows()>0) {
								$lists=$database->loadAssocList();
							?>
								<select name="q_id" id="q_id_select" onchange="return reload()">  >
								<option value="" <?php if (intval($row->q_id)<1) {echo " selected";} ?>> <?php echo _PLEASE_SELECT?></option>
									 <?php 
									 foreach ($lists as $question) {
									 ?>
									 
									 <option value="<?php echo $question["q_id"]?>" <?php if (intval($row->q_id)==$question["q_id"]) {echo " selected";} ?>><?php echo HTML_skiplogics::cutstring(stripslashes($question["title"]),88)?></option>
									<?php } ?>
							 </select>
							<?php }
							else echo "<strong style=\"color:red\">"._PAGE_WITHOUT_QUESTIONS."</strong>"; 
						}
						else echo "<strong style=\"color:red\">"._PLEASE_SELECT_PAGE."</strong>";
					}
					else echo "<strong style=\"color:red\">"._PLEASE_SELECT_SURVEY."</strong>";
					?>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"> <b><?php echo _COMPARE?>: </b></td>
				<td>
					<select name="compare">
						<option value="equal" <?php if($row->compare=='equal') {echo " Selected";} ?>> <?php echo _EQUAL;?> </option>
						<option value="different" <?php if($row->compare=='different') {echo " Selected";} ?>> <?php echo _DIFFERENT_THAN;?> </option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b><?php echo _ANSWER." "._VALUE?>:</b> <br />
							<?php
						if ($row->q_id){
								$database->setQuery("SELECT  type, orientation FROM #__ijoomla_surveys_questions WHERE q_id='".$row->q_id."'");
								$question_info=$database->loadAssocList();
								if ($database->getErrorNum()) {
										echo $database->stderr();
								}
								
								if ($question_info[0]["type"]=='checkbox'||$question_info[0]["orientation"]=='matrix')
										$AND_valid=1;
								else     
										$AND_valid=0;
						?>				
						<b><?php echo _LOGIC?></b> : <select name="logic">
										<?php if ($AND_valid==1){ ?>
								<option value="AND" <?php if ($row->logic=='AND') echo " Selected";?> ><?php echo _AND;?></option>
								<?php }?>
								<option value="OR" <?php if ($row->logic=='OR') echo " Selected";?>> <?php echo _OR;?> </option>
								</select>
					<?php 
						}
					?>	
				</td>
				<td align="left" valign="top">
					<?php
					if ($row->q_id) {
							$database->setQuery("SELECT * FROM #__ijoomla_surveys_answers WHERE q_id=$row->q_id ORDER BY a_id ASC");																
							$database->query();
													if ($database->getErrorMsg()){										
															die($database->getErrorMsg());
													}							
							if ($database->getNumRows()>0) {
								$lists=$database->loadAssocList();							
					?>
					<select name="a_id[]" id="a_id[]" multiple="multiple" size="8" >
							<?php
							if ($row->a_id) {
									$a_id=explode(",",$row->a_id);
							}
							else { 
								echo "<option value='' Selected> "._PLEASE_SELECT." </option>";
								$a_id=array();
							}
							$i=0;
							foreach ($lists as $answer) {
							?>  
						<option value="<?php echo $answer["a_id"]?>" <?php if (in_array($answer["a_id"],$a_id)) echo "Selected" ?>> <?php echo stripslashes($answer["value"])?>     </option>
					<?php 
							}
					?>
					</select>
					<?php
						}
					}
					else echo "<strong style=\"color:red\">"._PLEASE_SELECT_QUESTION."</strong>";
					?>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"><b><?php echo _ACTION?>:</b></td>
				<td align="left" valign="top">
					<select name="action" onchange="update_select()">
						<option value="jump" <?php if ($row->action=='jump') echo "Selected";?>> <?php echo _JUMP_TO;?></option>
						<option value="skip" <?php if ($row->action=='skip') echo "Selected";?>> <?php echo _SKIP;?> </option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top"> <b><?php echo _PAGE?>: </b> <br /> </td>
				<td align="left" valign="top">
					<?php if ($row->s_id && $row->page_id) {		
							$database->setQuery("SELECT ordering FROM #__ijoomla_surveys_pages WHERE page_id=$row->page_id");
							if ($database->getErrorMsg()){
									die($database->getErrorMsg());
							}
							$selected_page_level=(int)$database->loadResult();
						$database->setQuery("SELECT page_id,title,ordering FROM #__ijoomla_surveys_pages WHERE s_id=$row->s_id AND page_id<>$row->page_id AND ordering>$selected_page_level ORDER BY ordering ASC");																
						$database->query();		
						if ($database->getErrorNum()) {
								echo $database->stderr();
								return false;
						}
						if ($database->getNumRows()>0) {
							$lists=$database->loadAssocList();							
					?>
					<select name="page_target_1" id="page_target_1" style="display:block">
						<?php							
							if ($row->page_target<1) echo "echo <option value='' selected='selected'>"._PLEASE_SELECT."</option> ";
							foreach ($lists as $block) {
						?>
						<option value="<?php echo $block["page_id"]?>" <?php if($row->page_target==$block["page_id"]) {echo 'selected="selected"';}?>> <?php echo stripslashes($block["title"])?> </option>
						<?php } ?>
					</select>					
					<select name="page_target_2" id="page_target_2" style="display:none">
						<?php							
							if ($row->page_target<1) echo "echo <option value='' 'selected='selected'>"._PLEASE_SELECT."</option> ";
							$last_page_ordering=0;
							$last_page_id=0;							
							foreach ($lists as $block) {
									if ($block["ordering"]>$last_page_ordering){
											$last_page_ordering=$block["ordering"];
											$last_page_id=$block["page_id"];
									}
						?>
						<option value="<?php echo $block["page_id"]?>" <?php if($row->page_target==$block["page_id"]) {echo 'selected="selected"';}?>> <?php echo stripslashes($block["title"])?> </option>
						<?php 
							} 
							
						// 0.0.30	
						/* <option value="<?php echo $last_page_id?>"> <?php echo _SURVEY_END?> </option>*/
						?>
						<option value="-1" <?php if($row->page_target==-1) {echo 'selected="selected"';}?>> <?php echo _SURVEY_END?> </option>
					</select>
					<script>update_select()</script>
					<?php 
						}
							else {					  
									echo "<strong style=\"color:red\">"._YOU_CANT_ADD_SKIP_TO_LAST."</strong>";
							}
					}else {
							echo "<strong style=\"color:red\">"._PLEASE_SELECT_SURVEY_AND_PAGE."</strong>"; 
					}
					?>
				</td>
			</tr>
			 
	</table>
				<input type="hidden" name="page_target" value="" />
		<input type="hidden" name="sk_id" value="<?php echo $row->sk_id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="act" value="<?php echo $act?>" />
		</form>
	<?php
		}
	}


	// END SKIP LOGIC
?>
