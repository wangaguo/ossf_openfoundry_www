<?php
// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }


class getPartnerTab extends cbTabHandler {
	
	function getPartnerTab() {
		$this->cbTabHandler();
	}
	
	function getDisplayTab($tab,$user,$ui) {
		global $_CB_framework, $_CB_database, $mainframe;
		$return ='';
		$username =str_replace ("!","",$user->username);
	//    	$ch = curl_init();
	//	curl_setopt($ch, CURLOPT_URL, "http://ssodev.openfoundry.org/of/api/user?do=partners&name=$username");
//	//    echo "http://ssodev.openfoundry.org/of/api/user?do=partners&name=$username";
	//	    $output = curl_exec($ch);
	//	curl_close($ch); 
		$return ="<iframe src=\"http://ssodev.openfoundry.org/of/api/user?do=partners&name=$username\" width=\"100%\"  height=\"100%\" scrolling=\"auto\" align=\"top\" frameborder=\"0\" lass=\"wrapper\"> Not Open </iframe>";	

		return $return;
	}
}	// end class getPartnerTab.
?>
