<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Base plugin class.
*/
global $mosConfig_absolute_path;
require_once $mosConfig_absolute_path.'/components/com_mtree/Savant2/Plugin.php';

/**
* Mosets Tree 
*
* @package Mosets Tree 0.8
* @copyright (C) 2004 Lee Cher Yeong
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <cy@mosets.com>
**/


class Savant2_Plugin_ahrefLicense extends Savant2_Plugin {

	/**
	* 
	* Output an HTML <a href="">...</a> with optional 'Popular', 'Featured', 'New' text.
	* 
	* @access public
	* 
	* @param int $link_id Listing's ID. To be used in the URL
	*
	* @param object $link Reference to link object.
	* 
	* @return string The <a href="">...</a> tag.
	* 
	*/
	
	//function plugin(&$link, $linkable=true, $attr = null, $showNew=true, $showFeatured=true, $showPopular=true, $showEdit=true, $showDelete=true)
	function plugin(&$link, $attr=null)
	{
		global $Itemid, $_MT_LANG, $my, $mosConfig_live_site, $mt_listing_image_dir;

		# set the listing text, close the tag
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/M_images/indent1.png" width="9" height="9" />&nbsp;';
		$Liclink= 'http://www.openfoundry.org/Law-and-Policy/Licenses/';
		$license =$link->cust_1;
		if($license == 'GPL'){
			$Liclink.="GPL.html";
		}else if($license=='AFL'){
			$Liclink.="Academic-Free-License-Version-3.0-AFL.html";
		}else if($license=='BSD'){
			$Liclink.="BSD-3-clause-BSD-License.html";
		}else if($license=='LGPL'){
			$Liclink.="GNU-Lesser-General-Public-License-2.1（LGPL）.html";
		}else if($license=='MPL'){
			$Liclink.="MPL.html";
		}else if($license=='OSL'){
			$Liclink.="Open-Software-License-3.0（OSL）.html";
		}else if($license=='QPL'){
			$Liclink.="Q-Public-License-1.0（QPL）.html";
		}else if($license=='Python'){
			$Liclink.="Python-CNRI-Python-License.html";
		}else if($license=='MIT'){
			$Liclink.="MIT.html";
		}else if($license=='Artistic'){
			$Liclink.="Artistic.html";
		}else if($license=='zlib/libpng'){
			$Liclink.="zlib/libpng.html";
		}else if($license=='Apache2.0'){
			$Liclink.="Aapache-2.0.html";
		}else if($license=='Apache1.1'){
			$Liclink.="Apache-1.1.html";
		}else if($license=='CPL'){
			$Liclink.="CPL.html";
		}else if($license == ''){
			$license = "None";
		}
		
		$html .= '<a href="'.$Liclink.'"';
//		$html .= $link->cust_1;
		# Insert attributes
		if (is_array($attr)) {
			// from array
			foreach ($attr as $key => $val) {
				$key = htmlspecialchars($key);
				$val = htmlspecialchars($val);
				$html .= " $key=\"$val\"";
			}
		} elseif (! is_null($attr)) {
			// from scalar
			$html .= " $attr";
		}

		//$html .= $link->cust_1;
		$html .= ' target="_black" >License:&nbsp;'.$license."</a>";
		if ($license=="None") {
			$html="";
		}	
		# Return the listing link
		return $html;
	}
}
?>
