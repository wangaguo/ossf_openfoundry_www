<?php
/*
 * $Id: <uninstall.surveys.php,0.0.05 <version> 2007/01/10 hh:mm:ss <creator name> $
 *
 * @package iJoomla Surveys
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
 * @file <uninstall.surveys.php>
 * @brief <uninstallation file for component>
 *
 * @functionlist
 * ====================================================================
 * function com_uninstall
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
 * Modification: uninstallation
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
function com_uninstall() {
     	

	$database = &JFactory::getDBO();
   
    //delete menu 
    $database->setQuery("SELECT menu_id FROM #__ijoomla_surveys_config LIMIT 1");
    if(!$database->query())  {
        return $database->getErrorMsg();
    }    
    $menu_id=$database->loadResult();
    
    if ($menu_id>0){
        $database->setQuery("UPDATE #__menu SET published='-2' WHERE id='$menu_id'");
        if(!$database->query())  {
            return $database->getErrorMsg();
        }
    }

    $txt= "Thank you for using iJoomla Survey component.";
    return $txt;
}
?>
