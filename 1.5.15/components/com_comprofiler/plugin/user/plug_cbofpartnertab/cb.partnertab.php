<?php
// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }


class getPartnerTab extends cbTabHandler {
	
	function getPartnerTab() {
		$this->cbTabHandler();
	}
	
	function getDisplayTab($tab,$user,$ui) {
		global $_CB_framework, $_CB_database, $mainframe;
		$username =str_replace ("!","",$user->username);
		$live_site	=	$_CB_framework->getCfg( 'live_site' );
		$lang = JFactory::getLanguage()->getTag();
		if($lang == 'en-GB')$lang='en';
	    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $live_site."/of/api/user?do=partners&name=$username&lang=$lang");
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); 
	    	$output = curl_exec($ch);
		curl_close($ch); 
        return $output;
	}
}	// end class getPartnerTab.
?>
