<?php
/*
 * $Id: <install.surveys.php,0.0.05 <version> 2007/01/10 hh:mm:ss <creator name> $
 *
 * @package iJoomla Survays
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
 * @file <install.surveys.php>
 * @brief <installation file for component>
 *
 * @functionlist
 * ====================================================================
 * function com_install
 * ====================================================================
 * @endfunctionlist
 *
 * @history
 * ====================================================================
 * File creation date: 
 * Current file version: 0.0.04
 * 
 * Modified By: iJoomla Al
 * Modified Date: 24/10/06
 * Modification: installation
 *
 * Modified By: iJoomla Al
 * Modified Date: 22/01/2006
 * Modification: SURVEYS-135 com_install() modified
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/03/2007
 * Modification: ioncube and sourceguardian code added 
 *
 * Modified By: iJoomla Al
 * Modified Date: 30/08/2007
 * Modification: set the general date default 1-for the existing general date-0 
 *  
 * ====================================================================
 * @endhistory
 */
// ensure this file is being included by a parent file

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
function com_install() {
   
    $database = &JFactory::getDBO();
    
    $user_path=JPATH_SITE."/components/com_surveys/";
    $db_path = JPATH_SITE."/administrator/components/com_surveys/database/queries.sql";

    $database->setQuery( "SELECT id FROM #__components WHERE admin_menu_link = 'option=com_surveys'" );
    if(!$database->query())  {
        return $database->getErrorMsg();
    }    
    $id = $database->loadResult();
    //add new admin menu images
    $database->setQuery( "UPDATE #__components SET admin_menu_img = '../administrator/components/com_surveys/images/s.png', admin_menu_link = 'option=com_surveys' WHERE id=$id");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }
    $sql = "";

    $fp = fopen($db_path, 'r');
    while(!feof($fp))
    $sql .= fread($fp, 1024);
    fclose($fp);

    $sqls = explode("#$$$$#",$sql);

    foreach($sqls as $query){

        $database->setQuery($query);

        if(!$database->query())  {
            return $database->getErrorMsg();
        }
    }

	//when update and alias column doesn't exist
	$database->setQuery( "SELECT alias FROM #__ijoomla_surveys_surveys" );
    if(!$database->query()) {
		
        $database->setQuery("ALTER TABLE #__ijoomla_surveys_surveys ADD alias VARCHAR(255) AFTER title" );
		if(!$database->query())  {
            return $database->getErrorMsg();
        }
		
		$database->setQuery( "SELECT s_id, title FROM #__ijoomla_surveys_surveys");
		if(!$database->query())  {
            return $database->getErrorMsg();
        }
		
		$result = $database->loadAssocList();			
		foreach($result as $key=>$value){					
			$alias = strtolower($value["title"]);
			$alias =JFilterOutput::stringURLSafe($alias);
			$database->setQuery("update #__ijoomla_surveys_surveys set alias='".$alias."' where s_id=".$value["s_id"]);
			if(!$database->query()){
            	return $database->getErrorMsg();
        	}
		} 
    }
	
	$database->setQuery("SELECT `general_date` FROM #__ijoomla_surveys_config ");
    //$database->query();
	if(!$database->query()){
		//$error[] = $database->getErrorMsg();
		//continue
	}
	 else {
	 $database->setQuery("UPDATE `#__ijoomla_surveys_config` SET `general_date`=1 ");
	 if(!$database->query()){
		//$error[] = $database->getErrorMsg();
	}		
	}
	    
    // add email template
    $database->setQuery("SELECT COUNT(*) FROM #__ijoomla_surveys_email_settings");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }
    $res=$database->loadResult();
    if (!($res>0)){
        $database->setQuery("INSERT INTO #__ijoomla_surveys_email_settings VALUES (0, '', '', '', '', '<h5><br />\r\n&nbsp;&nbsp;&nbsp; New survey!</h5>\r\n<h5>&nbsp;&nbsp;&nbsp; Survey name: #SURVEYNAME#<br />\r\n&nbsp;&nbsp;&nbsp; User: #USER#</h5>\r\n<h5>&nbsp;&nbsp;&nbsp; Results:<br />\r\n&nbsp;&nbsp;&nbsp; #RESULTS#</h5>');");
        if(!$database->query())  {
            return $database->getErrorMsg();
        }
    }
        
    // add default general setting
    $database->setQuery("SELECT COUNT(*) FROM #__ijoomla_surveys_config");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }
    $res=$database->loadResult();
    if (!($res>0)){
        $database->setQuery("INSERT INTO #__ijoomla_surveys_config VALUES (0, '', '', 0, 'MRpRSC',1);");
        if(!$database->query())  {
            return $database->getErrorMsg();
        }
    }
        
    // add menu button
    $database->setQuery("SELECT MAX(ordering) FROM #__menu WHERE menutype='topmenu'");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }
    $max_order=$database->loadResult();
    $ordering=$max_order+1;
    
    $database->setQuery("INSERT INTO `#__menu` VALUES ('', 'topmenu', 'Surveys','survey', 'index.php?option=com_surveys', 'components', 0, 0, $id, 0, $ordering, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '','','','')");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }    
    $menu_id=$database->insertid();
    
    $database->setQuery("UPDATE #__ijoomla_surveys_config SET menu_id='$menu_id' LIMIT 1");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }    
    
    
	//extract ioncube and sourceGuardian zip
	$admin_path = JPATH_SITE."/administrator/components/com_surveys/";
	$user_path	= JPATH_SITE."/components/com_surveys/";	
	require_once( JPATH_SITE . '/administrator/includes/pcl/pclzip.lib.php' );
	require_once( JPATH_SITE . '/administrator/includes/pcl/pclerror.lib.php' );
	
	   
    $txt= "Thank you for using iJoomla Survey component.";
    return $txt;
}
?>
