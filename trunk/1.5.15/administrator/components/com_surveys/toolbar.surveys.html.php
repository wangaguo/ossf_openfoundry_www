<?php
/*
 * $Id: <toolbar.surveys.html.php,0.0.18 <version> 2007/01/10 hh:mm:ss <creator name> $
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
 * @file toolbar.surveys.html.php
 * @brief <brief description of file purpose>
 *
 * @classlist
 * ====================================================================
 * class JToolBarHelperExtended
 * class menuijoomla_surveys 
 * ====================================================================
 * @endclasslist
 *
 * @history
 * ====================================================================
 * File creation date: 
 * Current file version: 0.0.18
 *
 * Modified By: iJoomla Al
 * Modified Date: 26/09/2006
 * Modification: MENU_Survey() - new copy feature, using JToolBarHelperExtended class
 *
 * Modified By: iJoomla Al
 * Modified Date: 28/09/2006
 * Modification: MENU_Block() - new function for block toolbar   
 *
 * Modified By: iJoomla Al
 * Modified Date: 05/10/2006
 * Modification: MENU_responses() - SURVEYS-31
 *
 * Modified By: iJoomla Al
 * Modified Date: 13/10/2006
 * Modification: SURVEYS-26- MENU_Edit() uses new save() function
 *
 * Modified By: iJoomla Al
 * Modified Date: 16/10/2009
 * Modification: SURVEYS-22
 *
 * Modified By: iJoomla Al
 * Modified Date: 09/11/2006
 * Modification: SURVEYS-59 save() fixed
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/11/2006
 * Modification: SURVEYS-74 code cleaned  
 *
 * Modified By: iJoomla Al
 * Modified Date: 27/11/2006
 * Modification: SURVEYS-93 help button added to all toolbars 
 *
 * Modified By: iJoomla Al
 * Modified Date: 15/12/2006
 * Modification: SURVEYS-110 MENU_Edit() modified 
 *
 * Modified By: 
 * Modified Date: 
 * Modification:  
 * 
 * ====================================================================
 * @endhistory
 */	

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
require_once( JPATH_SITE . "/administrator/components/com_surveys/surveys.class.php" ) ;
class JToolBarHelperExtended extends JToolBarHelper {
	/**
	* Writes a common 'copy' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
 /*   function copyList( $task='copy', $alt='Copy' ) {
        $image2 = JmosAdminMenus::ImageCheckAdmin( 'copy_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 1 );
		?>
	 	<div class="button">
			<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo _PLEASE_SELECT_TO_COPY;?>'); } else {submitbutton('<?php echo $task;?>', '');}">
				<?php echo $image2; ?>
				<br /><?php echo $alt; ?></a>
		</div>
	 	<?php
    }*/
    
    function copy( $task='copy', $alt='Copy' ){
		$bar = & JToolBar::getInstance('toolbar');
		$bar->appendButton( 'Standard', 'archive', $alt, $task, true, false );
    }
   /*
    function save( $task='save', $alt='Save' ) {
		//$image2 = JmosAdminMenus::ImageCheckAdmin( 'save_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 1 );
		$bar = & JToolBar::getInstance('toolbar');
		$bar->appendButton( 'Standard', 'save', $alt, $task, true, false, 1 );
		?>
		<script type="text/javascript" language="Javascript">
    		function save_precheck(form_target_id,redirection_url_name){
    		    var form_target=document.getElementById(form_target_id);
    		    var redirect_url=document.getElementsByName(redirection_url_name);
    		    var valid;
    		    valid=true;
    		    if (form_target.value=='<?php echo _REDIRECT_TO_URL?>'){
    		        if (redirect_url.length>0){
    		            var v = new RegExp();
    		            v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
    		            if (!v.test(redirect_url[0].value)) {
    		                alert("<?php echo _MUST_SUPPLY_VALID_URL?>");
    		                valid=false;
    		            }
    		        }else{
    		            alert("<?php echo _MUST_SUPPLY_VALID_URL?>");
    		            valid=false;
    		        }
    		    }
    		    if (valid==true){
    		        submitbutton('<?php echo $task;?>');
    		    }
    		}
    		
    		function checkbound_save(minlimit,maxlimit){
    		    var form = document.adminForm;	    
    		    var minvalue=document.getElementById(minlimit);
    		    var maxvalue=document.getElementById(maxlimit);		 
    		    if (form.question_type.value!=12){
    		        if (minvalue.value!='') minvalue.value='';
    		        if (maxvalue.value!='') maxvalue.value='';
    		        submitbutton('<?php echo $task;?>');
    		    }		    
    		    var difference=maxvalue.value-minvalue.value;	    
    		    if (difference<0){
    		        alert("<?php echo _MAXIMUM_VALUE_GREATER?>");
    		    }else{
    		        submitbutton('<?php echo $task;?>'); 
    		    }
    		}
        </script>	
		
		<?php
	}    
	
	function apply( $check='' , $task='apply', $alt='Apply' ) {
		$image 	= JmosAdminMenus::ImageCheckAdmin( 'apply.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = JmosAdminMenus::ImageCheckAdmin( 'apply_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 1 );
		?>
		<td>
		<script type="text/javascript">
    		function apply_precheck(form_target_id,redirection_url_name){
    		    var form_target=document.getElementById(form_target_id);
    		    var redirect_url=document.getElementsByName(redirection_url_name);
    		    var valid;
    		    valid=true;
    		    if (form_target.value=='<?php echo _REDIRECT_TO_URL?>'){
    		        if (redirect_url.length>0){
    		            var v = new RegExp();
    		            v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
    		            if (!v.test(redirect_url[0].value)) {
    		                alert("<?php echo _MUST_SUPPLY_VALID_URL?>");
    		                valid=false;
    		            }
    		        }else{
    		            alert("<?php echo _MUST_SUPPLY_VALID_URL?>");
    		            valid=false;
    		        }
    		    }
    		    if (valid==true){
    		        submitbutton('<?php echo $task;?>');
    		    }
    		}
		
    		function checkbound_apply(minlimit,maxlimit){
    		    var form = document.adminForm;	    
    		    var minvalue=document.getElementById(minlimit);
    		    var maxvalue=document.getElementById(maxlimit);		 
    		    if (form.question_type.value!=12){
    		        if (minvalue.value!='') minvalue.value='';
    		        if (maxvalue.value!='') maxvalue.value='';
    		        submitbutton('<?php echo $task;?>');
    		    }		    
    		    var difference=maxvalue.value-minvalue.value;	    
    		    if (difference<0){
    		        alert("<?php echo _MAXIMUM_VALUE_GREATER?>");
    		    }else{
    		        submitbutton('<?php echo $task;?>');
    		    }
    		}		
        </script>		
			<a class="toolbar" href="<?php if ($check=='check url') {echo "javascript:apply_precheck('form_target','redirection_url');";}
			                           elseif ($check=="check sum") {echo "javascript:checkbound_apply('minvalue','maxvalue');";}?>">
				<?php echo $image2; ?>
				<br /><?php echo $alt;?></a>
		</td>
		<?php
	} 	*/
}
		
class menuijoomla_surveys {

	function MENU_Default() {
		////JToolBarHelper::startTable();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::divider();
		JToolBarHelper::addNew('new');
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();
		JToolBarHelper::divider();
		JToolBarHelper::help('com_surveys',true);		
		////JToolBarHelper::endTable();
	}

	function MENU_Block() {
		//JToolBarHelper::startTable();
		JToolBarHelperExtended::copy();
		JToolBarHelper::divider();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::divider();
		JToolBarHelper::addNew('new');
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();
		JToolBarHelper::divider();
		JToolBarHelper::help('com_surveys',true);	
		//JToolBarHelper::endTable();
	}
	    	
	function MENU_Edit( $check = '') {
		//JToolBarHelper::startTable();
		if ($check != ''){	        		
		JToolBarHelperExtended::save('save');
		
		JToolBarHelper::spacer();
		JToolBarHelperExtended::apply('apply');		
		}
		else {
		JToolBarHelper::save('save');
		JToolBarHelper::spacer();
		JToolBarHelper::apply('apply');
		}
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help('com_surveys',true);	
		//JToolBarHelper::endTable();  
	}
	function MENU_analyze() {
		//JToolBarHelper::startTable();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help('com_surveys',true);	
		//JToolBarHelper::endTable();  
	}
	function MENU_responses() {
		//JToolBarHelper::startTable();
		JToolBarHelper::publishList('rpublish','Publish');
		JToolBarHelper::unpublishList('runpublish','Unpublish');
		JToolBarHelper::divider();
		JToolBarHelper::trash();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::help('com_surveys',true);	
		//JToolBarHelper::endTable();  
	}
	function MENU_Survey() {
		//JToolBarHelper::startTable();
		JToolBarHelperExtended::copy();
		JToolBarHelper::divider();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::divider();
		JToolBarHelper::addNew('new');
		JToolBarHelper::editList();
		JToolBarHelper::divider();	
		JToolBarHelper::deleteList();
		JToolBarHelper::trash('clear',"Clear");
		JToolBarHelper::divider();	
		JToolBarHelper::help('com_surveys',true);
		JToolBarHelper::spacer();
		//JToolBarHelper::endTable();			
	}
	/*function MENU_Survey2() {
		//JToolBarHelper::startTable();
		JToolBarHelper::save();
		JToolBarHelper::divider();	
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
		JToolBarHelper::divider();	
		JToolBarHelper::help('com_surveys',true);
		JToolBarHelper::spacer();
		//JToolBarHelper::endTable();			
	}*/
	function MENU_none() {
	}
	
}
?>
