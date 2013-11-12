<?php
require_once 'mobile_session.php';
if(isset($_GET['mobileNo'])){
    start_session(600);
 }
require_once 'Mobile_Detect.php';
      $detect = new Mobile_Detect;
			// Exclude tablets.
			if( $detect->isMobile() && !$detect->isTablet() ){
			       if(!isset($_COOKIE['closemobile'])){
			           $hrs= $_SERVER['REQUEST_URI'];
			           $hr=explode('/',$hrs);
			     			 $wArray=array('news','law-and-licensing','activities','about');
					 			 $news=array('foss-news','tech-column','foss-programs','legal-column-list','foss-forum','enterprise-application','foss-projects');
			    			 $abouts=array('about-openfoundry','ossf-members','steering-organization');
			  	 			 if($hrs=='/' || $hr[1]=='index.php'){
			 			 			    $m='Location:https://m.openfoundry.org';
			   			  }elseif($hr[1]=='tw'){
			 			  			    if(in_array($hr[2],$news)){
			 			    				   	$action='action=news&page=/tw/'.$hr[2].'/'.$hr[3];				  
					   					  }elseif(in_array($hr[2], $abouts)){
							  				  	$action='action=about&page='.$hr[2];
					  					  }elseif(in_array($hr[2], $wArray)){
			  											if($hr[2]=='activities' && $hr[4]<>''){
		                             $action='action=activities&page='.$hr[4];
																}else{
  																$action='action='.$hr[2];
		 										    	}				    					 					
											}
									$m='Location:https://m.openfoundry.org/?'.$action;
						  }elseif(strpos($hr[1],'option=com_content')){
									$url=explode('&',$hr[1]);
		 							$id=explode('=',$url[2]);
									$m='Location:https://m.openfoundry.org/?action=news&page=/tw/news/'.$id[1];		  
		  			  }
			 			  header($m);
			 			  exit();
			   }
  }
/**
* @version		$Id: index.php 11407 2009-01-09 17:23:42Z willebil $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2009 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Set flag that this is a parent file
define( '_JEXEC', 1 );

define('JPATH_BASE', dirname(__FILE__) );

define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;

/**
 * CREATE THE APPLICATION
 *
 * NOTE :
 */
$mainframe =& JFactory::getApplication('site');

/**
 * INITIALISE THE APPLICATION
 *
 * NOTE :
 */
// set the language
$mainframe->initialise();

JPluginHelper::importPlugin('system');

// trigger the onAfterInitialise events
JDEBUG ? $_PROFILER->mark('afterInitialise') : null;
$mainframe->triggerEvent('onAfterInitialise');

/**
 * ROUTE THE APPLICATION
 *
 * NOTE :
 */
$mainframe->route();

// authorization
$Itemid = JRequest::getInt( 'Itemid');
require_once( JPATH_LIBRARIES.DS.'ofsso'.DS.'ofsso.php');
$ofsso = new OfssoLibrary;
$ofsso->authorize($Itemid);

//$mainframe->authorize($Itemid);

// trigger the onAfterRoute events
JDEBUG ? $_PROFILER->mark('afterRoute') : null;
$mainframe->triggerEvent('onAfterRoute');

/**
 * DISPATCH THE APPLICATION
 *
  NOTE :
 */
$option = JRequest::getCmd('option');
$mainframe->dispatch($option);

// trigger the onAfterDispatch events
JDEBUG ? $_PROFILER->mark('afterDispatch') : null;
$mainframe->triggerEvent('onAfterDispatch');

/**
 * RENDER  THE APPLICATION
 *
 * NOTE :
 */
$mainframe->render();

// trigger the onAfterRender events
JDEBUG ? $_PROFILER->mark('afterRender') : null;
$mainframe->triggerEvent('onAfterRender');

/**
 * RETURN THE RESPONSE
 */
echo JResponse::toString($mainframe->getCfg('gzip'));

