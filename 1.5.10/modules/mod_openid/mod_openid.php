<?php
defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

$type 	= modLoginHelper::getType();
$return	= modLoginHelper::getReturnURL($params, $type);
$user =& JFactory::getUser();
echo "<div style=\"width:300px;float:right;\">\n";
if($type=="logout"){
	echo "<form action=\"index.php\" method=\"post\" name=\"login\" id=\"form-login\">\n";
	echo "	<input type=\"submit\" name=\"Submit\" class=\"button\" value=\"Logout\" />\n";
	echo "	<input type=\"hidden\" name=\"option\" value=\"com_user\" />\n";
	echo "	<input type=\"hidden\" name=\"task\" value=\"logout\" />\n";
	echo "	<input type=\"hidden\" name=\"return\" value=\"".$return."\" />\n";
	echo "</form>\n";
}else{
	if(JPluginHelper::isEnabled('authentication', 'openid')){
			$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
			$langScript = 	'var JLanguage = {};'.
							' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
							' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
							' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
							' var modlogin = 1;';
			$document = &JFactory::getDocument();
			$document->addScriptDeclaration( $langScript );
			JHTML::_('script', 'openid.js');
	}
	
	echo "<form action=\"".JURI :: base()."index.php\" method=\"post\" name=\"login\" id=\"form-login\" >\n";
	
	echo $params->get('pretext')."\n";
	
	echo "<fieldset class=\"input\">
			<input id=\"modlgn_username\" type=\"text\" name=\"username\" class=\"inputbox\" alt=\"username\" size=\"18\" style=\"background:#fff url(".JURI :: base()."modules/mod_openid/images/openid.jpg) no-repeat;padding-left:50px;border:1px solid #FF7F2A;height:20px;float:left;\" />";
	echo "<input type=\"submit\" name=\"Submit\" class=\"button\" value=\"Login\" style=\"padding-left:2px;border:1px solid #FF7F2A;background:#7FAAFF;font-size:10px;height:20px;float:left;\" />
		</fieldset>";
	
	echo "<input type=\"hidden\" name=\"option\" value=\"com_user\" />
		<input type=\"hidden\" name=\"task\" value=\"login\" />
		<input type=\"hidden\" name=\"return\" value=\"".$return."\" />";
	
	echo JHTML::_( 'form.token' );
	
	echo "</form>";
}
echo "</div>\n";
?>