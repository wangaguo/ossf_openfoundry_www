<?php
/**
 * @copyright   (C) 2010 iJoomla, Inc. - All rights reserved.
 * @license  GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author  iJoomla.com <webmaster@ijoomla.com>
 * @url   http://www.ijoomla.com/licensing/
 * the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript  *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0 
 * More info at http://www.ijoomla.com/licensing/
*/
defined ('_JEXEC') or die ("Go away.");


function SurveysBuildRoute(&$query) {
	$user 		=& JFactory::getUser();
	$database	=& JFactory::getDBO();
	$segments 	= array();
	
	if (isset($query['survey'])) {
		$segments[] = $query['survey'];
		unset($query['survey']);
	}
	
	if (isset($query['page'])) {
		//if(intval($query['page'])>0)
			$segments[] = "page_".$query['page'];
		//else $segments[] = $query['page'];
		unset($query['page']);
	}
	
	if (isset($query['act'])){
		if($query['act']!="view_survey")
			$segments[] = $query['act'];
		unset($query['act']);
	}
	
	if (isset($query['q'])){		
		$segments[] = "question_".$query['q'];
		unset($query['q']);
	}
	
	if (isset($query['a'])){		
		$segments[] = "answer_".$query['a'];
		unset($query['a']);
	}

	return $segments;

}

function SurveysParseRoute($segments) {
	$vars = array();
	$vars['survey'] = $segments[0];
	if(isset($segments[1])){
		if(substr($segments[1],0,5)=="page_"){
			$vars['page']=substr($segments[1],5);
		}
		else $vars["act"]=$segments[1];
	}
	if(!isset($vars["act"])){
		$vars["act"]="view_survey";
	}	
	if($vars["act"]=="details"){
		if(isset($segments[2])){
			$vars['q']=substr($segments[2],9);
		}
	}
	else if ($vars["act"]=="values"){
		if(isset($segments[2])){
			$vars['a']=substr($segments[2],7);
		}
	}
	return $vars;
}


?>