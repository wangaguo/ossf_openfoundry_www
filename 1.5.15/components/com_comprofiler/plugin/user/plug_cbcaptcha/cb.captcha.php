<?php
/**
* Captcha Tab Class for handling CB Registrations
* @version $Id: captcha.php 396 2006-08-24 14:16:31Z beat $
* @package Community Builder
* @subpackage captcha.php
* @author Beat and Nant
* @copyright (C) JoomlaJoe and Beat, www.joomlapolis.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!defined('_UE_CAPTCHA_Label')) DEFINE('_UE_CAPTCHA_Label','Security Code');
if (!defined('_UE_CAPTCHA_Desc')) DEFINE('_UE_CAPTCHA_Desc','Enter Security Code from image');
if (!defined('_UE_CAPTCHA_NOT_VALID')) DEFINE('_UE_CAPTCHA_NOT_VALID','Invalid Security Code');

$_PLUGINS->registerFunction( 'onBeforeRegisterForm',		'onBeforeRegisterForm',			'getcaptchaTab' );
$_PLUGINS->registerFunction( 'onBeforeUserRegistration',	'onBeforeUserRegistration',		'getcaptchaTab' );

$_PLUGINS->registerFunction( 'onLostPassForm', 				'onLostPassForm',				'getcaptchaTab' );
$_PLUGINS->registerFunction( 'onLostPassForm', 				'onLostPassFormB',				'getcaptchaTab' );
$_PLUGINS->registerFunction( 'onBeforeNewPassword',			'onBeforeNewPassword',			'getcaptchaTab' );

$_PLUGINS->registerFunction( 'onAfterEmailUserForm', 		'onAfterEmailUserForm',			'getcaptchaTab' );
$_PLUGINS->registerFunction( 'onBeforeEmailUser',			'onBeforeEmailUser',			'getcaptchaTab' );


class getcaptchaTab extends cbTabHandler {
	/**
	* Constructor
	*/	
	function getCaptchaTab() {
		$this->cbTabHandler();
	}

	/**
	* Gets relevant plugin parameters and generates HTML code
	* to link to captcha image
	*/
	function _getHTMLcaptcha() {
		global $mosConfig_live_site;
							 
		$basegetarray = array('user' => null, 'Itemid' => 1 );
		
		$imageUrl	= $mosConfig_live_site
					. str_replace("index.php", "/index2.php", $this->_getAbsURLwithParam( $basegetarray, "tabclass", false ) )
					. "&no_html=1";

		$CaptchaImage = '<img src="' . $imageUrl . '" />';
		
		return $CaptchaImage;
	}
	
	/**
	* Generates the HTML to display the registration tab/area
	* @param object tab reflecting the tab database entry
	* @param object mosUser reflecting the user being displayed (here null)
	* @param int 1 for front-end, 2 for back-end
	* @return mixed : either string HTML for tab content, or false if ErrorMSG generated
	*/
	function getDisplayRegistration($tab, $user, $ui) {

		$params = $this->params;
        if (!$params->get('captchaRegistration',1)) {
        	return;
		}
		
		$CaptchaImage = $this->_getHTMLcaptcha();
				
		$return = "<tr>\n";                                              
		$return .= "	<td class=\"titleCell\"></td>\n";
		$return .= "	<td class=\"fieldCell\">" . $CaptchaImage;
		$return .= "</td></tr>\n";

		$return .= "<tr>\n";
		$return .= "	<td class=\"titleCell\">" . _UE_CAPTCHA_Label . ":</td>\n";
		$return .= "	<td class=\"fieldCell\"><input class=\"inputbox\" type=\"text\" name=\"".$this->_getPagingParamName("captcha")."\" mosReq=\"1\" mosLabel=\"". _UE_CAPTCHA_Label . "\" value=\"\" size=\"20\" />";
		$return .= getFieldIcons($ui, true, true, _UE_CAPTCHA_Desc, _UE_CAPTCHA_Label . ":");
		$return .= "</td></tr>\n";
		
		return $return;
	}
	/**
	* This function is called before user registration and checks if the correct security
	* code was entered during registration application.
	* If not - then the application fails, a popup message is displayed and the applicant must try again.
	*/
	function onBeforeUserRegistration( &$row, &$rowExtras ) {
		global $ueConfig, $mainframe, $_PLUGINS;
		
		if ( ! session_id() ) {
			session_start();				// not even sure if really needed here...
		}

		if ( ! (($_SESSION['security_code'] == $this->_getReqParam("captcha")) && (!empty($_SESSION['security_code'])) ) ) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG( _UE_CAPTCHA_NOT_VALID );
		}
		return true;
	}
	
	function onBeforeRegisterForm( $option, $emailpass, &$regErrorMSG, &$fieldsQuery ) {
		global $_PLUGINS;
		
		$_PLUGINS->_iserror = false;			// ugly bug fix of CB 1.0.2
	}

	function onLostPassForm( $ui ) {

		$params = $this->params;
        if (!$params->get('captchaNewPassword',1)) {
        	return;
		}

		$CaptchaImage = $this->_getHTMLcaptcha();
				
		$return = array( 0 => "", 1 => $CaptchaImage );
		return $return;		
	}
	
	function onLostPassFormB( $ui ) {

		$params = $this->params;
        if (!$params->get('captchaNewPassword',1)) {
        	return;
		}
		
		$captchaInput = "<input class=\"inputbox\" type=\"text\" name=\"".$this->_getPagingParamName("captcha")."\" mosReq=\"1\" mosLabel=\"". _UE_CAPTCHA_Label . ":\" value=\"\" size=\"20\" />";
		
		$return = array( 0 => _UE_CAPTCHA_Label . ':', 1 => $captchaInput );
		return $return;
	}
	
	function onBeforeNewPassword( $user_id, &$newpass, &$subject, &$message ) {
		global $ueConfig, $mainframe, $_PLUGINS;
		
		if ( ! session_id() ) {
			session_start();				// not even sure if really needed here...
		}

		if ( ! (($_SESSION['security_code'] == $this->_getReqParam("captcha")) && (!empty($_SESSION['security_code'])) ) ) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG( _UE_CAPTCHA_NOT_VALID );
		}
		return true;	
	}

	/**
	* Generates the HTML to display security image on forgotten email form
	*/
	function onAfterEmailUserForm( &$rowFrom, &$rowTo, &$warning, $ui ) {
    	global $mosConfig_live_site;

		$params = $this->params;
        if (!$params->get('captchaEmailUser',1)) {
        	return;
		}
    
		$CaptchaImage = $this->_getHTMLcaptcha();

		$return = "<div style=\"margin-left:160px;\">" . $CaptchaImage . "</div>";
		$return .= "<div style=\"float:left; position:relative; left:0px; width:160px;\">" . _UE_CAPTCHA_Label . ":</div>\n";
		$return .= "<div style=\"float:left; position:relative; left:0px;\">"
				.  "<input class=\"inputbox\" type=\"text\" name=\"".$this->_getPagingParamName("captcha")."\" mosReq=\"1\" mosLabel=\"". _UE_CAPTCHA_Label . "\" value=\"\" size=\"20\" />"
				.  "<img src='".$mosConfig_live_site."/components/com_comprofiler/images/required.gif' width='16' height='16' alt='*' title='"._UE_FIELDREQUIRED."' /> "
				.  "</div>"
				.  "<div style=\"clear:both;\">&nbsp;</div>";		
		return $return;
	}

	function onBeforeEmailUser( &$rowFrom, &$rowTo, $ui ) {
		global $ueConfig, $mainframe, $_PLUGINS;
		
		if ( ! session_id() ) {
			session_start();				// not even sure if really needed here...
		}

		if ( ! (($_SESSION['security_code'] == $this->_getReqParam("captcha")) && (!empty($_SESSION['security_code'])) ) ) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG( _UE_CAPTCHA_NOT_VALID );
		}
		return true;	
	}

	
	
	/**
	* WARNING: THIS METHOD IS EXPERIMENTAL !
	* WARNING: UNCHECKED ACCESS! On purpose unchecked access for M2M operations
	* Generates the HTML to display for a specific component-like page for the tab. WARNING: unchecked access !
	* @param object tab reflecting the tab database entry
	* @param object mosUser reflecting the user being displayed
	* @param int 1 for front-end, 2 for back-end
	* @param array _POST data for saving edited tab content as generated with getEditTab
	* @returns mixed : either string HTML for tab content, or false if ErrorMSG generated, or null if nothing to display
	*/
	function getTabComponent($tab, $user, $ui, $postdata) {
		global $mosConfig_live_site, $mosConfig_absolute_path, $database, $my;
		
		if ( ! session_id() ) {
			session_start();
		}
		
		include_once( $mosConfig_absolute_path . '/components/com_comprofiler/plugin/user/plug_cbcaptcha/captchasecurityimages.php');

		$params = $this->params;
		
		// Plugin Parameters
		$cbcaptcha_width = $params->get('captchaWidth', '150');
		$cbcaptcha_height = $params->get('captchaHeight', '40');
		$cbcaptcha_chars = $params->get('captchaChars', '5');
		$cbcaptcha_font2use = $params->get('captchaFont', '0');
        $cbcaptcha_backgroundRGB = $params->get('captchaBackgroundRGB','255,255,255');
        if (substr_count($cbcaptcha_backgroundRGB,',')!=2) {
        	$cbcaptcha_backgroundRGB = '255,255,255';
		}      
        $cbcaptcha_captchaTextRGB = $params->get('captchaTextRGB','20,40,100');
        if (substr_count($cbcaptcha_captchaTextRGB,',')!=2) {
        	$cbcaptcha_captchaTextRGB = '20,40,100';
		}              
        $cbcaptcha_captchaNoiseRGB = $params->get('captchaNoiseRGB','100,120,180');
        if (substr_count($cbcaptcha_captchaNoiseRGB,',')!=2) {
        	$cbcaptcha_captchaNoiseRGB = '100,120,180';              
		}
		$captchaGenerator = new CaptchaSecurityImages();
		$captchaGenerator->setfont($cbcaptcha_font2use);
		
		$brgb = explode(",",$cbcaptcha_backgroundRGB);
		$captchaGenerator->setrgb($brgb[0],'br');
		$captchaGenerator->setrgb($brgb[1],'bg');
		$captchaGenerator->setrgb($brgb[2],'bb');
			
		$trgb = explode(",",$cbcaptcha_captchaTextRGB);
		$captchaGenerator->setrgb($trgb[0],'tr');
		$captchaGenerator->setrgb($trgb[1],'tg');
		$captchaGenerator->setrgb($trgb[2],'tb');
				
		$nrgb = explode(",",$cbcaptcha_captchaNoiseRGB);
		$captchaGenerator->setrgb($nrgb[0],'nr');
		$captchaGenerator->setrgb($nrgb[1],'ng');
		$captchaGenerator->setrgb($nrgb[2],'nb');
		
		$code = $captchaGenerator->generate( $cbcaptcha_width, $cbcaptcha_height, $cbcaptcha_chars );
		
		$_SESSION['security_code'] = $code;

		return null;
	}
} // end class getCaptchaTab.
?>
