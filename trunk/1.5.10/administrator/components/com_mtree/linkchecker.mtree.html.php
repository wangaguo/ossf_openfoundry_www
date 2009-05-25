<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 2.0
* @copyright (C) 2007-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

class HTML_mtlinkchecker {
	
	function linkChecker( $option, $num_of_links, $config ) {
		global $_MT_LANG, $mtconf;
	?>
	<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site') . $mtconf->get('relative_path_to_js_library'); ?>"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/administrator/components/com_mtree/js/admin.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $mtconf->getjconf('live_site'); ?>/administrator/components/com_mtree/js/linkchecker.js"></script>
	<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var mosConfig_live_site='http://<?php echo $_SERVER["SERVER_NAME"] . str_replace("/administrator/index2.php","",$_SERVER["PHP_SELF"]); ?>';
	var num_of_links='<?php echo $num_of_links; ?>';
	var msgLCCompleted = '<?php echo $_MT_LANG->LINK_CHECKER_COMPLETED ?>';
	var msgLinksRemaining = '<?php echo $_MT_LANG->LINKS_REMAINING ?>';
	var checked=0;
	var okLinks=new Array();
	</script>
	<style type="text/css">
	tbody#problem table{border:0px solid red;padding:0px;margin:0px;}
	tbody#problem table td {border:0px;padding:0px;}
	#report {display:none;clear:both;text-align:center;margin:0 0 13px 0;}
	</style>
	<form action="index2.php" method="post" name="adminForm">
	<table width="100%">
		<tr>
			<td width="100%">
			<fieldset>
			<legend><?php echo $_MT_LANG->LINK_CHECKER ?></legend>
			<table width="100%" border=0>
				<tr>
					<td width="50%" valign="top">
						<input type="button" value="Check Links" onclick="startLinkChecker()" /> &nbsp;<?php printf($_MT_LANG->THERE_ARE_X_LINKS_IN_THE_DIRECTORY, $num_of_links) ?><?php printf($_MT_LANG->LAST_CHECKED_DATE,( (empty($config['linkchecker_last_checked']->value))? $_MT_LANG->NEVER : tellDateTime($config['linkchecker_last_checked']->value) )) ?>
						<p />
						<a href="#" onclick="jQuery('#advancedoptions').slideToggle('fast');return false;"><?php echo $_MT_LANG->ADVANCED_OPTIONS ?></a>
						<div id="advancedoptions" style="display:none">
							<table>
								<tr><td width="20"><input type="checkbox" id="togglelinks" onclick="toggleLinks()" class="text_area" /></td><td width="99%"><label for="togglelinks"><?php echo $_MT_LANG->SHOW_ALL_LINKS ?></label></td></tr>
								<tr><td colspan="2"><?php printf( $_MT_LANG->CHECK_X_LINKS_EVERY_Y_SECONDS, '<input type="text" value="'.$config['linkchecker_num_of_links']->value.'" name="linkchecker_num_of_links" id="linkchecker_num_of_links" size="3" class="text_area" />', '<input type="text" value="'.$config['linkchecker_seconds']->value.'" name="linkchecker_seconds" id="linkchecker_seconds" size="3" class="text_area" />') ?></td></tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			</fieldset>
			</td>
		</tr>
	</table>
	
	<div id="report">
		<div style="margin-left:35%;width:30%;height:20px;border:1px solid #000;"><div style="background-color:green;height:20px;" id="progressbar"></div></div>
		<div id="progresstext" style="text-align:center;margin-top:5px;font-weight:bold"></div>
	</div>

	<table class="adminlist">
	<tbody id="problem">
		<tr align="left"><th width="20"></th><th width="40%" align="left"><?php echo $_MT_LANG->WEBSITE ?></th><th width="20%" align="left"><?php echo $_MT_LANG->STATUS_CODE_AND_REASON ?></th><th width="16">&nbsp;</th><th width="20%" align="left"><?php echo $_MT_LANG->ACTION ?></th><th width="20%" align="right">	</th></tr>
	</tbody>
	</table>

	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="task" value="linkchecker" />
	<input type="hidden" name="task2" value="linkchecker2" />
	</form>	
	<?php
	}
}
?>