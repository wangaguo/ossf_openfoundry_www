<?php
/*
 * $Id: <sef_ext.php,0.0.27 <version> 2007/03/20 12:20:00 <iJoomla Al> $
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
 * @file <sef_ext.php>
 * @brief <advanced SEF extension>
 *
 * @classlist
 * ==================================================================== 
 * class sef_surveys 
 * ====================================================================
 * @endclasslist
 * 
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class sef_surveys {
   
    /**
	* Creates the SEF advance URL out of the Mambo request
	* Input: $string, string, The request URL (index.php?option=com_example&Itemid=$Itemid)
	* Output: $sefstring, string, SEF advance URL ($var1/$var2/$var3.html)
	**/

	function create ($string){
   	  	$database=&JFactory::getDBO();
   	  	$retval ="";
     	$string = str_replace("&amp;","&",$string);
     	$o = split("&",substr($string,strpos($string,"index.php?")+10));
     	foreach($o as $value){
         	$i = split("=",$value);
		 	if($i[1]!="com_surveys")
         	$ns[$i[0]] = $i[1];   
      	}
	  
	  	//start take out component name
	 	if(isset($ns["option"]))	unset($ns["option"]);
	  	//end take out component name
	
		//start take config from sef_advanced table
		$query="select * from #__sef_config";
		$database->setQuery($query);
		$database->query();
		$result		=$database->loadObject();
		$space		=$result->space;
		$use_alias	=$result->alias;
		$lowercase	=$result->lowercase;
		//end take config from sef_advanced table
		
	  	if($use_alias==0){
	  		$query="select name from #__menu where id=".$ns["Itemid"];
			$database->setQuery($query);
			$database->query();
			$result=$database->loadObject();
			$val=str_replace($space,"%11",$result->name);
			$val=str_replace(" ",$space,$val);
			$retval .=$val;
			$retval .= "/";
		}
		else{
			$query="select alias from #__menu where id=".$ns["Itemid"];
			$database->setQuery($query);
			$database->query();
			$result=$database->loadObject();
			$val=$result->alias;
			$retval .=$val;
			$retval .= "/"; 
		}
	  
	  	foreach($ns as $key=>$val){
			if($key=="page"){
				$retval.="page".$space.$val."/";
			}
			else if($key=="survey"){
				//if the character set as space in sef advanced exists in title replace it with %11
				if($use_alias==0){
					//take the id from link
					$array=explode(":",$val);
					$id=$array[0];
					$sql="SELECT title FROM #__ijoomla_surveys_surveys WHERE s_id=".intval($id);
					$database->setQuery($sql);
					$database->query();
					$result=$database->loadObject();
					$val=$result->title;
					$val=str_replace($space,"%11",$val);
					$val=str_replace(" ",$space,$val);
				}
				else{
					$array=explode(":",$val);
					$val=$array[1];
				}
				if($lowercase==1)
					$val=strtolower($val);
				//$val=urldecode($val);
				$retval.=$val."/";
			}
			else if($key=="q"){
				$retval.="question".$space.$ns['q']."/";
			}
			else if($key=="a"){
				$retval.="answer".$space.$ns['a']."/";
			}
	  		else if($key!="act" && $key!="Itemid")
				$retval.=$val."/";
	  	}
		
		if(isset($ns["act"]) && $ns['act']!="view_survey" && $ns['act']!="details" && $ns['act']!="values")
			$retval.=$ns['act']."/";
		
      	return $retval;
   }

	 
	 
	 function revert ($url_array, $pos){
   		$database=&JFactory::getDBO();
	
		//start take the replacement for space from sef_advanced config table
		$query="select * from #__sef_config";
		$database->setQuery($query);
		$database->query();
		$result=$database->loadObject();
		$space		=$result->space;
		$use_alias	=$result->alias;
		$lowercase	=$result->lowercase;
		//end take the replacement for space from sef_advanced config table
	
      	$na = array();
	
      	for ($a=$pos+1;$a<count($url_array);$a++){
        	if (strlen($url_array[$a]) > 0){
            	$na[] = $url_array[$a];
         	}
      	}
		
		//set Itemid
		if($use_alias==0){
			$na[1]=str_replace($space," ",$na[1]);
			$na[1]=str_replace("%11",$space,$na[1]);
			$sql="select id from #__menu where name like'".$na[1]."'";
			$database->setQuery($sql);
			$database->query();
			$result=$database->loadObject();
			$vars['Itemid']=$result->id;
		}else{
			$sql="select id from #__menu where alias='".$na[1]."'";
			$database->setQuery($sql);
			$database->query();
			$result=$database->loadObject();
			$vars['Itemid']=$result->id;
		}
		//end set Itemid
		
		//set survey name
		if(isset($na[2])){
			if($use_alias==0){
				$na[2]=str_replace($space," ",$na[2]);
				$na[2]=str_replace("%11",$space,$na[2]);
				$sql="SELECT s_id,alias FROM #__ijoomla_surveys_surveys WHERE title like '".$na[2]."'";
				$database->setQuery($sql);
				$database->query();
				$result=$database->loadObject();
				$vars["survey"]=$result->s_id.":".$result->alias;
			}
			else{
				$sql="SELECT s_id FROM #__ijoomla_surveys_surveys WHERE alias='".$na[2]."'";
				$database->setQuery($sql);
				$database->query();
				$result=$database->loadObject();
				$vars["survey"]=$result->s_id.":".$na[2];
			}
			//$vars["survey"]=urldecode($vars["survey"]);
			//end set survey name
		
			if(isset($na[3])){
				if(substr($na[3],0,5)=="page".$space){
					if(intval(substr($na[3],5))>0)
						$vars["page"]=intval(substr($na[3],5));
					else $vars["page"]=substr($na[3],5);
					$vars['act']="view_survey";
				}
				else if(substr($na[3],0,8)=="question"){
					$vars["q"]=intval(substr($na[3],9));
					$vars['act']="details";
				}
				else if(substr($na[3],0,6)=="answer"){
					$vars["a"]=intval(substr($na[3],7));
					$vars['act']="values";
				}
				else $vars['act']=$na[3];
			}
			else $vars['act']="view_survey";
		}
      	$QUERY_STRING = '';
     	foreach($vars as $key=>$value){
        	$QUERY_STRING .="&";
        	$QUERY_STRING .=$key;
        	$QUERY_STRING .="=";
        	$QUERY_STRING .=$value;   
        	$GLOBALS[$key] = $_GET[$key] = $_REQUEST[$key] = $value;                  
      	}
		return $QUERY_STRING;
   	}  
}

?>
