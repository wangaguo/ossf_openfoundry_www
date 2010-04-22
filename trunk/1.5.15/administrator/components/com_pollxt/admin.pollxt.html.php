<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php
class HTML_poll
{
 
function showPolls( &$rows, &$pageNav, $option, $lists ) {
                global $my, $_VERSION;



?>

<script type="text/javascript">
function alertClear() {
 return confirm("<?php echo "Do you really want to delete all results?" ?>");
}
</script>

<form action="index2.php" method="POST" name="adminForm">
<input type="hidden" name="hidemainmenu" value="0" />

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminlist">
  <thead>
  <tr>
   <th  colspan="2" align="left">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_TITLE'), 'm.title', @$lists['order_Dir'], @$lists['order'] ); ?>
   </th>
   <th width ="10%" align="center">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_ID'), 'm.id', @$lists['order_Dir'], @$lists['order'] ); ?>
   <th width ="10%" align="center">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_QUESTIONS'), 'numoptions', @$lists['order_Dir'], @$lists['order'] ); ?>
   </th>
   <th width ="10%" align="center">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_PUBLISHED'), 'm.published', @$lists['order_Dir'], @$lists['order'] ); ?>
   </th>
   <th width ="10%" align="center">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_CHECKOUT'), 'editor', @$lists['order_Dir'], @$lists['order'] ); ?>
   </th>
   <th width ="10%" colspan = "2" align="center">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_ORDERING'), 'm.ordering', @$lists['order_Dir'], @$lists['order'] ); ?>
	<?php echo JHTML::_('grid.order',  $rows ); ?>
   </th>
  
   <th width ="10%" align="center"><?php echo JText::_('ADMIN_POLL_MANAGER_CLEARDATA'); ?></th>
   <th width ="10%" colspan="2" align="center">
   <?php echo JHTML::_('grid.sort',  JText::_('ADMIN_POLL_MANAGER_DISPLAY_RESULTS'), 'm.voters', @$lists['order_Dir'], @$lists['order'] ); ?>
   
  </tr>
  </thead>
<?php
$k = 0;
$j = 0;
for ($i=0, $n=count( $rows ); $i < $n; $i++) {
 $row = &$rows[$i];

 $link 	= 'index2.php?option=com_pollxt&task=editA&hidemainmenu=1&id='. $row->id;

 $task 	= $row->published ? 'unpublish' : 'publish';
 $img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
 $alt 	= $row->published ? 'Published' : 'Unpublished';

  $checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$row->id."\" onclick=\"isChecked(this.checked);\" />";
?>

 <tr class="<?php echo "row$k"; ?>">
  <td width="10">
  <?php  echo $checked  ?>
  </td>
  <td align="left">
    <a href="<?php echo $link ?>"><?php echo stripslashes($row->title); ?></a>
  </td>
  <td  align="center"><?php echo $row->id; ?>&nbsp;</td>
  <td  align="center"><?php echo $row->numoptions; ?>&nbsp;</td>
<?php
  $task = $row->published ? 'unpublish' : 'publish';
  $img = $row->published ? 'publish_g.png' : 'publish_x.png';

?>
  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a></td>
  <td align="center"><?php echo $row->editor; ?>&nbsp;</td>

					<td class="order">
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" class="text_area" style="text-align: center" />
					</td>
  
  <td align="center">
<?php echo $pageNav->orderUpIcon( $i );  ?>
<?php echo $pageNav->orderDownIcon( $i, $n );  ?>
 </td>

<td width="10%" align="center"><a href="#clear" onclick="alertClear(); return listItemTask('cb<?php echo $i;?>','clear')"><img src="components/com_pollxt/delete.gif" width="12" height="12" border="0" alt="" /></a></td>
<td width="5%" align="center">
<a href="#" onClick="javascript:window.open('<?php echo JUri::root().'index.php?tmpl=component&option=com_pollxt&isPopup=1&admin=1&task=showResult&id='.$row->id;?>','Result', 'resizable=yes, scrollbars=yes, location=no, menubar=no, status=no, toolbar=no, width=640, height=480')">
<img src="components/com_pollxt/preview.gif" width="12" height="12" border="0" alt="" />
</a>
</td>
<td width="5%" align="center">(<?php echo $row->voters?>)</td>
<?php                $k = 1 - $k; $j++; ?>
</tr>
<?php        } ?>
</table>
<?php echo $pageNav->getListFooter(); ?>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="task" value="show" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />

</form>
        <?php
}

function editPoll( $mypoll, $questions, $options, $menulist, $conf, $images, $option, $lists, $tab, $plugin) {
		JHTML::_('behavior.tooltip');
		JFilterOutput::objectHTMLSafe( $mypoll, ENT_QUOTES );
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal');
?>

        <script language="javascript" type="text/javascript">
        function XTexpandAll() {
          for (var i = 0; i < <?php echo count($questions) ?>; i++) {
            xtname = "opt" + i.toString();
            switchonoff(xtname);
          }
        }

        function switchonoff(name) {
                name_pic = name + "_pic"
                name_opt = "conf[" + name + "]";

                if (document.getElementById(name).style.display=="none")
                 {
                  document.getElementById(name).style.display="block";
                  document.getElementById(name_pic).src="components/com_pollxt/minus.gif";
                  document.getElementById(name_opt).value = 1;

                 }
                else
                 {
                 document.getElementById(name).style.display="none";
                 document.getElementById(name_pic).src="components/com_pollxt/plus.gif";
                  document.getElementById(name_opt).value = "";
                 }
                }

        function submitbutton(pressbutton) {
                var form = document.adminForm;
               	xtAdminController(pressbutton);
        }
        
		function jInsertEditorText(tag, editor) {
		 	ret = tag.match(/src="(\S*)"/);
		 	val = ret[1];
		 	document.getElementById(editor).value=val;
		}
		
       </script>


<?php echo "<div id=\"messageArea\"></div>"; ?>
<form action="index2.php" method="POST" name="adminForm">
    
<?php	//	$tabs = new xtTabs(1);

		jimport('joomla.html.pane');
		$tabs = JPane::getInstance('Tabs');

		echo $tabs->startPane("poll_pane");
		echo $tabs->startPanel(JText::_('ADMIN_POLL_MANAGER_CONFIG'),"config_tab");
?>

    <table cellpadding="5" cellspacing="0" border="0" width=
    "100%" class="adminform">
      <tr>
        <td width="70%">
          <table valign="top" class="adminform">
<tr>
<th colspan="4"><?php echo JText::_('ADMIN_POLL_MANAGER_GENERAL'); ?></th>
</tr>
            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_TITLE'); ?>
              </td>
              <td colspan="3" valign="top">
                <input class="inputbox" id="title" type="text"
                name="mypoll[title]" size="75" value=
                "<?php echo $mypoll['title']; ?>">
              </td>
            </tr>
            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_ORDERING'); ?>
              </td>
              <td colspan="3" valign="top">
                <?php echo $lists['ordering']; ?>
              </td>
            </tr>
            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_CAT'); ?>
              </td>
              <td colspan="3" valign="top">
                <?php echo categoryList($mypoll['category']); ?>
              </td>
            </tr>
           
            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_SHOWNIN'); ?>
              </td>
              <td valign="middle" colspan="3">
                <select class="inputbox" name="mypoll[type]">
                  <option <?php if ($mypoll['type'] == '1') echo 'selected';?>
                   value='1'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_SHOWNIN_MOD'); ?>
                  </option>
                  <option <?php if ($mypoll['type'] == '2') echo 'selected';?>
                   value='2'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_SHOWNIN_COM'); ?>
                  </option>
                  <option <?php if ($mypoll['type'] == '3') echo 'selected';?>
                   value='3'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_SHOWNIN_BOT'); ?>
                  </option>
                  <option <?php if ($mypoll['type'] == '0') echo 'selected';?>
                   value='0'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_SHOWNIN_COM_MOD'); ?>
                  </option>
                </select>
              </td>
            </tr>
            <tr>
				<th colspan="4"><?php echo JText::_('ADMIN_POLL_MANAGER_HEADER'); ?></th>
			</tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_HIDE_TITLE'); ?>
              </td>
              <td valign="top">
              	<?php echo xtYesNo($mypoll["hidetitle"], "mypoll[hidetitle]", $mypoll["hidetitle"]); ?>
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_IMAGE'); ?>
              </td>
              <td nowrap="nowrap">
				<?php 
		$cfg = new pollxtConfig();
		$cfg->pollid = $mypoll["id"];
		$cfg->load();
				
				echo xtHTML::mediaManager("mypoll[img_url]", $mypoll['img_url'], $cfg->imgpath) ?>            
              <td valign="middle">
                <select class="inputbox" name="mypoll[imgor]">
                  <option <?php if ($mypoll['imgor'] == 'width') echo 'selected';?>
                   value='width'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_IMAGE_WIDTH'); ?>
                  </option>
                  <option <?php if ($mypoll['imgor'] == 'height') echo 'selected';?>
                   value='height'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_IMAGE_HEIGHT'); ?>
                  </option>
                </select> <input class="inputbox" type="text"
                name="mypoll[imgsize]" value=
                "<?php echo htmlspecialchars( $mypoll['imgsize'], ENT_QUOTES ); ?>"
                 size="5">
              </td>
              <td valign="middle">
              	<?php echo xtYesNo($mypoll["imglink"], "mypoll[imglink]", $mypoll["imglink"]); ?>
                     <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_IMAGE_LINK'); ?>?
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_INTRO_TEXT'); ?>
              </td>
              <td colspan="3" valign="top">
                <textarea class="text_area" name="mypoll[intro]" cols="50" rows="3"
                wrap="soft"><?php echo $mypoll['intro']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_THANK_TEXT'); ?>
              </td>
              <td colspan="3" valign="top">
                <textarea class="text_area" name="mypoll[thanks]" cols="50" rows=
                "3" wrap="soft"><?php echo $mypoll['thanks']; ?></textarea>
              </td>
            </tr>
<tr>
<th colspan="4"><?php echo JText::_('ADMIN_POLL_MANAGER_FOOTER'); ?></th>
</tr>
            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_VOTERS'); ?>
              </td>
              <td colspan="3" valign="top">
				<?php echo xtYesNo($mypoll["showvoters"], "mypoll[showvoters]", $mypoll["showvoters"]); ?>
			  </td>
            </tr>
<tr>
<th colspan="4"><?php echo JText::_('ADMIN_POLL_MANAGER_BEHAVIOUR'); ?></th>
</tr>

            <tr>
              <td width="20%" valign="top">
                 <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_ALLOWDATE'); ?>
              </td>
              <td nowrap width="20%" valign="top">
              <?php echo JHTML::calendar($mypoll['datefrom'], "mypoll[datefrom]", "mypoll[datefrom]"); ?>
				<a href="#" onclick=
                "document.getElementById('mypoll[datefrom]').value='0000-00-00';">
                <img src="components/com_pollxt/cancel.gif" alt="Clear"
                border="0"></a>
              </td>
              <td nowrap width="22%" valign="top">
                <?php echo JText::_('POLLXT_TO');?>: 
               <?php echo JHTML::calendar($mypoll['dateto'], "mypoll[dateto]", "mypoll[dateto]"); ?>

				<a href="#" onclick=
                "document.getElementById('mypoll[dateto]').value='0000-00-00';">
                <img src="components/com_pollxt/cancel.gif" alt="Clear"
                border="0"></a>
              </td>
            </tr>
            <tr>
              <td width="20%" valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_ALLOWTIME'); ?>
              </td>
              <td width="20%" valign="top">
                <input class="inputbox" type="text"
                name="mypoll[timefrom]" id="mypoll[timefrom]"
                size="12" maxlength="19" value=
                "<?php echo $mypoll['timefrom']; ?>">
              </td>
              <td width="22%" valign="top">
                <?php echo JText::_('POLLXT_TO');?>: <input class="inputbox" type="text"
                name="mypoll[timeto]" id="mypoll[timeto]" size=
                "12" maxlength="19" value=
                "<?php echo $mypoll['timeto']; ?>">
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_MULTI_VOTE'); ?>
              </td>
              <td valign="top">
              	<?php echo xtYesNo($mypoll["multivote"], "mypoll[multivote]", $mypoll["multivote"]); ?>
              </td>
			  <td valign="top" colspan="2">
			  <?php echo JText::_('POLLXT_VOTE_AGAIN_AFTER'); ?>					  
                <input class="inputbox" id="lag" 
                name="mypoll[lag]" size="10" value=
                "<?php echo $mypoll['lag']; ?>">
                <?php echo Jtext::_('POLLXT_MINUTES'); ?>
              </td>
            </tr>
            <tr>
              <td valign="top" align="right">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_LOGIN_ONLY'); ?>
              </td>
              <td valign="top">
              	<?php echo xtYesNo($mypoll["logon"], "mypoll[logon]", $mypoll["logon"]); ?>
              </td>
            </tr>
            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_NOTVOTE'); ?>
              </td>
              <td valign="middle">
				<?php 
        			$types = array(JText::_('ADMIN_POLL_MANAGER_NOTVOTE_NOTHING')=>"3", JText::_('ADMIN_POLL_MANAGER_NOTVOTE_POLL')=>"1", JText::_('ADMIN_POLL_MANAGER_NOTVOTE_RESULTS')=>"2");
					echo xtMakeSelect($types, $mypoll['notvote'], 'mypoll[notvote]');
				?>
              </td>
              <td colspan="2" valign="top">
                <?php 
					echo JText::_('ADMIN_POLL_MANAGER_NOTVOTEERR');
					echo xtYesNo($mypoll["notvoteerr"], "mypoll[notvoteerr]", $mypoll["notvoteerr"]); 
				?>
              </td>
            </tr>

            <tr>
              <td>
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_VOTE_GOTO'); ?>
              </td>
              <td valign="middle">
                <select class="inputbox" name="mypoll[goto]">
                  <option <?php if ($mypoll['goto'] == '0') echo 'selected';?>
                   value='0'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_VOTE_GOTO_RESULT'); ?>
                  </option>
                  <option <?php if ($mypoll['goto'] == '1') echo 'selected';?>
                   value='1'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_VOTE_GOTO_NOWHERE'); ?>
                  </option>
                  <option <?php if ($mypoll['goto'] == '2') echo 'selected';?>
                   value='2'>
                    <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_VOTE_GOTO_URL'); ?>
                  </option>
                </select>
              </td>
              <td colspan="2" valign="top">
                URL: <input class="inputbox" type="text" name=
                "mypoll[goto_url]" value=
                "<?php echo htmlspecialchars( $mypoll['goto_url'], ENT_QUOTES ); ?>"
                 size="40" maxlength="80">
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_WORDWRAP'); ?>
            	</td>
	              	<td colspan="3" valign="top">
	                <input class="inputbox" type="text" name=
	                "mypoll[wordwrap]" value=
	                "<?php echo htmlspecialchars( $mypoll['wordwrap'], ENT_QUOTES ); ?>"
	                 size="3" maxlength="4">
	                 <?php echo JText::_('ADMIN_POLL_MANAGER_WORDWRAP_AFTER'); ?>
              	</td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_GS_IHO'); ?>
              </td>
              <td colspan = "3" valign="top">
	     		<?php $types = array(JText::_('ADMIN_POLLXT_COLLAPSE')=>"1", JText::_('ADMIN_POLLXT_NOCOLLAPSE')=>"0", JText::_('ADMIN_POLLXT_COLLAPSE_DEACT')=>"2");
				echo xtMakeSelect($types, $mypoll['hide'], 'mypoll[hide]', array(1,2));
			?>
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_ALT_VBTEXT'); ?>
            	</td>
	              	<td colspan="3" valign="top">
	                <input class="inputbox" type="text" name=
	                "mypoll[vbtext]" value=
	                "<?php echo htmlspecialchars( $mypoll['vbtext'], ENT_QUOTES ); ?>"
	                 size="20" maxlength="20">
              	</td>
            </tr>

<tr>
<th colspan="4"><?php echo JText::_('ADMIN_POLL_MANAGER_EMAIL'); ?></th>
</tr>


            <tr>
              <td valign="top" align="right">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_EMAIL_CONFIRMATION'); ?>
              </td>
              <td valign="top">
              	<?php echo xtYesNo($mypoll["email"], "mypoll[email]", $mypoll["email"]); ?>
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_EMAIL_SUBJECT'); ?>
              </td>
              <td colspan="3">
                <input id="subject" class="inputbox" type="text"
                name="mypoll[subject]" value=
                "<?php echo htmlspecialchars( $mypoll['subject'], ENT_QUOTES ); ?>"
                 size="80" maxlength="80">
              </td>
            </tr>
            <tr>
              <td valign="top">
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_EMAIL_TEXT'); ?>
              </td>
              <td colspan="3" valign="top">
                <textarea class="text_area" id="emailtext" name="mypoll[emailtext]"
                cols="50" rows="3" wrap="soft"><?php echo $mypoll['emailtext']; ?></textarea>
              </td>
            </tr>
          </table>
        </td>
        <td valign="top">
          <table valign="top" class="adminform">
            <tr>
              <th>
                <?php echo JText::_('ADMIN_POLL_MANAGER_CONFIG_MENU_ITEMS'); ?>
              </th>
            </tr>
            <tr>
              <td valign="top" colspan="3" rowspan="4">
                <?php echo $menulist; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
<!-- Tab 2 -->
<style>
td.icon a {
	display: block; float: left;
	vertical-align: middle;
	text-decoration : none;
	border: 1px solid #DDD;
	padding: 1px 1px 1px 5px;
	width: 32px;
}
td.icon a:hover{
	color : #333333;
	background-color: #f1e8e6;
	border: 1px solid #c24733;
//	padding: 3px 4px 0px 6px;
#messageArea.div {
padding: 5px;
} 
}
</style>
<?php $tabs->endPanel();
echo $tabs->startPanel(JText::_('ADMIN_POLL_MANAGER_QUESTIONS'),"page_tab");
$frame = new adminFrame();
$frame->poll = $mypoll;
$frame->questions = $questions;
$frame->options = $options;
echo $frame->get();

echo $tabs->endPanel();
echo $tabs->startPanel(JText::_('ADMIN_POLL_MANAGER_RESULTS'),"result_tab");
?>

<table align=left class="adminform" width="98%" >
<tr>
<td width = "50%">
 <table align=left class="adminform" width="98%" >
<tr>
<th colspan="2"><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS'); ?></th>
</tr>

   <tr>
    <td width="30%" align="right" valign="top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY'); ?></td>
    <td valign = "top" >
    	<?php 
        $types = array(JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY_SAMEWIN')=>"3", JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY_MAINWIN')=>"1", JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY_POPUP')=>"2");
        
		echo xtMakeSelect($types, $mypoll['rdisp'], 'mypoll[rdisp]');
		?>
	</td>
	</tr>
    <tr>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_BUTTON'); ?></td>
    <td valign = "top" >
     <select name="mypoll[rdispb]" class="listbox">
      <option value = '1' <?php if ($mypoll['rdispb'] == 1) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_BUTTON_ALWAYS'); ?></option>
      <option value = '2' <?php if ($mypoll['rdispb'] == 2) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_BUTTON_VOTE_AFTER'); ?></option>
      <option value = '3' <?php if ($mypoll['rdispb'] == 3) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_BUTTON_ADMIN'); ?></option>
      <option value = '4' <?php if ($mypoll['rdispb'] == 4) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_BUTTON_NEVER'); ?></option>
     </select></td></tr>

    <tr>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_DETAIL'); ?></td>
    <td valign = "top" >
	<?php echo xtYesNo($mypoll["rdispd"], "mypoll[rdispd]", $mypoll["rdispd"]); ?>
    </td></tr>
   <tr>
    <td width="30%" align="right" valign="top" ><?php echo JText::_('ADMIN_POLL_MANAGER_DETAILS_DISPLAY'); ?></td>
    <td valign = "top" >
	<?php
        $types = array(JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY_SAMEWIN')=>"3", JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY_MAINWIN')=>"1", JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAY_POPUP')=>"2");
		echo xtMakeSelect($types, $mypoll['rdispdw'], 'mypoll[rdispdw]');
	?>
	</td>
	</tr>
    <tr>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_OPTIONS'); ?></td>
    <td valign = "top" >
	<?php echo xtYesNo($mypoll["rdispall"], "mypoll[rdispall]", $mypoll["rdispall"]); ?>
    </td></tr>

    <tr>
    <td valign=top><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_STYLESHEET'); ?></td>
    <td valign = "top" >
    <input class="inputbox" id="mypoll[css]" type="text" name="mypoll[css]" size="20" value="<?php echo $mypoll['css']; ?>" />
    </td></tr>
</table>
</td>
<td valign="top" >
<table align="left" class="adminform" width="98%" >
<tr>
<th colspan="3"><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_DISPLAYFIELDS'); ?></th>
</tr>
    <tr>
    <td colspan = 3 valign=top><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_FIELDS'); ?><br>&nbsp;
    </td></tr>
    <tr>
    <td>&nbsp;</td>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_TOTAL'); ?></td>
    <td>
	<?php echo xtYesNo($mypoll["sh_numvote"], "mypoll[sh_numvote]", $mypoll["sh_numvote"]); ?>
    </td></tr>
    
    <tr>
    <td>&nbsp;</td>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_FL_DATE'); ?></td>
    <td align=left>
	<?php echo xtYesNo($mypoll["sh_flvote"], "mypoll[sh_flvote]", $mypoll["sh_flvote"]); ?>
    </td></tr>

    <tr>
    <td>&nbsp;</td>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_ABSOLUTNO'); ?></td>
    <td>
	<?php echo xtYesNo($mypoll["sh_abs"], "mypoll[sh_abs]", $mypoll["sh_abs"]); ?>
    </td></tr>

    <tr>
    <td>&nbsp;</td>
    <td valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_PERCENTAGE'); ?></td>
    <td>
	<?php echo xtYesNo($mypoll["sh_perc"], "mypoll[sh_perc]", $mypoll["sh_perc"]); ?>
    </td></tr>
</table>
    </td>
  </tr>
<tr>
<td colspan = 2>
<table align="left" class="adminform" width="98%" >
<tr>
<th colspan="3"><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_OPTIONS'); ?></th>
</tr>
    <tr>
    <td width="20%" valign = "top" ><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL'); ?></td>
    <td>
     <select name="mypoll[mailres]" class="listbox">
      <option value = '0' <?php if ($mypoll['mailres'] == 0) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_NO'); ?></option>
      <option value = '1' <?php if ($mypoll['mailres'] == 1) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_COMPLETE'); ?></option>
      <option value = '2' <?php if ($mypoll['mailres'] == 2) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_SHORT'); ?></option>
      <option value = '3' <?php if ($mypoll['mailres'] == 3) echo 'selected'; ?>><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_TINY'); ?></option>
     </select>
     </td>
     <td valign ="top" rowspan="3">
     <?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_HELP'); ?>
     <input size="65" type="text" class="input" readonly="readonly" value="webmaster@joomlaxt.com;6:oli@joomlaxt.com;7:admin@joomlaxt.com"></input>
     </td>
    </tr>
    <tr>
    <td valign=top><?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_RECEIVERS'); ?></td>
    <td valign = "top" >
    <input class="inputbox" id="mypoll[mailresrec]" type="text" name="mypoll[mailresrec]" size="70" value="<?php echo $mypoll['mailresrec']; ?>" />
    </td></tr>
    
    <tr>
    <td valign="top">
     <?php echo JText::_('ADMIN_POLL_MANAGER_RESULTS_EMAIL_INTROTEXT'); ?>
    </td>
    <td valign="top">
      <textarea class="text_area" name="mypoll[mailrestxt]"
                cols="50" rows="3" wrap="soft"><?php echo $mypoll['mailrestxt']; ?></textarea>
   	</td>
    </tr>
</table>
    </td>
  </tr>
</table>

                 <?php 
                 
if (!$plugin->active) {                 
echo $tabs->endPanel();

echo $tabs->endPane();
}
else {
echo $tabs->endPanel();
echo $tabs->startPanel(JText::_('ADMIN_POLL_MANAGER_PLUGINS'),"plugin_tab");

echo $plugin->getConfigHTML();

echo $tabs->endPanel();

echo $tabs->endPane();
}


?>



                <input type="hidden" name="task" value="">
                <input type="hidden" name="quid" value="">
                <input type="hidden" name="pollid" value="<?php echo $mypoll['id']; ?>">
                <input type="hidden" name="option" value="<?php echo $option;?>" />
                <input type="hidden" name="id" value="<?php echo $mypoll['id']; ?>" />
                <input type="hidden" name="mypoll[id]" value="<?php echo $mypoll['id']; ?>" />
        </form>
<div style="clear:both"></div>


<script type="text/javascript">
<?php /*for ($i=0, $j=0, $n=count( $questions ); $i < $n; $i++ ) { ?>
 if (document.getElementById("conf[opt<?php echo $i;?>]").value == "") {
 document.getElementById("opt<?php echo $i;?>").style.display="none" ;}
 else {
 document.getElementById("opt<?php echo $i;?>").style.display="block" ; }
<?php 
}*/
?>
</script>


<?php
 }
	function edit_settings ($option, $config, $tod, $images, $com_pollxt_ver) {
		JHTML::_('behavior.modal');

    ?>
        <script language="javascript" type="text/javascript">
        function submitbutton(pressbutton) {

                if (pressbutton == 'save' )
                 submitform('saveSettings');
                else

                 submitform(pressbutton);
         }

		function jInsertEditorText(tag, editor) {
		 	ret = tag.match(/src="(\S*)"/);
		 	val = ret[1];
		 	document.getElementById(editor).value=val;
		}


        </script>

    <form action="index2.php" method="post" name="adminForm">

<?php	/*	$tabs = new mosTabs(1); */
		jimport('joomla.html.pane');
		$comp = JPane::getInstance('Tabs');
		echo $comp->startPane("xtsettings_pane"); 
		echo $comp->startPanel(JText::_('ADMIN_TABS_FRONTEND'),"poll_tab");
?>

    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_POLLS_DISPLAY'); ?></strong></td>
        <td valign="top">
         <select class="inputbox" name="config[disp]" >
          <option <?php if ($config['disp'] == '1') echo 'selected';?> value='1'><?php echo JText::_('ADMIN_GS_ALL_PUBLISHED'); ?></option>
          <option <?php if ($config['disp'] == '2') echo 'selected';?> value='2'><?php echo JText::_('ADMIN_GS_ONLY_ONE'); ?></option>
          <option <?php if ($config['disp'] == '3') echo 'selected';?> value='3'><?php echo JText::_('ADMIN_GS_OWVIP'); ?></option>
         </select>
        </td>
       <td valign="top"><?php echo JText::_('ADMIN_GS_PD_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_ORDER_POLLS_DISPLAY'); ?></strong></td>
        <td valign="top">
         <select class="inputbox" name="config[order]" >
          <option <?php if ($config['order'] == '1') echo 'selected';?> value='1'><?php echo JText::_('ADMIN_GS_ORDER_SEQUENCE'); ?></option>
          <option <?php if ($config['order'] == '2') echo 'selected';?> value='2'><?php echo JText::_('ADMIN_GS_ORDER_RANDOM'); ?></option>
         </select>
        </td>
       <td valign="top"><?php echo JText::_('ADMIN_GS_ORDER_PD_HELP'); ?></td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_IHO'); ?></strong></td>
        <td valign="top">
     		<?php $types = array(JText::_('ADMIN_POLLXT_COLLAPSE')=>"1", JText::_('ADMIN_POLLXT_NOCOLLAPSE')=>"0", JText::_('ADMIN_POLLXT_COLLAPSE_DEACT')=>"2");
			echo xtMakeSelect($types, $config['hide'], 'config[hide]');
			?>

        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_IHO_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_SHOW_SELECTBOX'); ?></strong></td>
        <td valign="top">
	       	<?php echo xtYesNo($config["selpo"], "config[selpo]", $config["selpo"]); ?>
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_SHOW_SELECTBOX_HELP'); ?></td>
      </tr>
      <tr><td colspan = 3><hr></td></tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_BUTTON_STYLING'); ?></strong></td>
        <td valign="top">
         <select class="inputbox" name="config[button_style]" >
          <option <?php if ($config['button_style'] == '0') echo 'selected';?> value='0'><?php echo JText::_('ADMIN_GS_BUTTON_STYLING_STA'); ?></option>
          <option <?php if ($config['button_style'] == '1') echo 'selected';?> value='1'><?php echo JText::_('ADMIN_GS_BUTTON_STYLING_BIT'); ?></option>
          <option <?php if ($config['button_style'] == '2') echo 'selected';?> value='2'><?php echo JText::_('ADMIN_GS_BUTTON_STYLING_IS'); ?></option>
         </select>
        </td>
       <td valign="top"><?php echo JText::_('ADMIN_GS_BUTTON_STYLING_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_BUTTON_VB_IMAGE'); ?></strong></td>
        <td valign="top">
			<?php echo xtHTML::mediaManager("config[imgvote]", $config['imgvote'], $config['imgpath']) ?>            
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_BUTTON_VB_IMAGE_HELP'); ?> </td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_BUTTON_RB_IMAGE'); ?></strong></td>
        <td valign="top">
				<?php echo xtHTML::mediaManager("config[imgresult]", $config['imgresult'], $config['imgpath']) ?>            
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_BUTTON_RB_IMAGE_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_BUTTON_DB_IMAGE'); ?></strong></td>
        <td valign="top">
				<?php echo xtHTML::mediaManager("config[imgdetail]", $config['imgdetail'], $config['imgpath']) ?>            
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_BUTTON_DB_IMAGE_HELP'); ?> </td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_BUTTON_BB_IMAGE'); ?></strong></td>
        <td valign="top">
				<?php echo xtHTML::mediaManager("config[imgback]", $config['imgback'], $config['imgpath']) ?>            
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_BUTTON_BB_IMAGE_HELP'); ?> </td>
      </tr>
   </table>
<!-- Page 2 -->
<?php echo $comp->endPanel();
echo $comp->startPanel(JText::_('ADMIN_GS_RESULTS'),"result_tab");
?>

    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_RESULTS_ORDER'); ?></strong></td>
        <td valign="top">
         <select class="inputbox" name="config[orderby]" >
          <option <?php if ($config['orderby'] == 'hits') echo 'selected';?> value='hits'><?php echo JText::_('ADMIN_GS_RESULTS_ORDER_HITS'); ?></option>
          <option <?php if ($config['orderby'] == 'a.id') echo 'selected';?> value='a.id'><?php echo JText::_('ADMIN_GS_RESULTS_ORDER_ORDERING'); ?></option>
         </select>
        </td>
       <td valign="top"><?php echo JText::_('ADMIN_GS_RESULTS_ORDER_HELP'); ?></td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong>&nbsp;</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[asc]" >
          <option <?php if ($config['asc'] == 'ASC') echo 'selected';?> value='ASC'><?php echo JText::_('ADMIN_GS_RESULTS_ORDER_ASC'); ?></option>
          <option <?php if ($config['asc'] == 'DESC') echo 'selected';?> value='DESC'><?php echo JText::_('ADMIN_GS_RESULTS_ORDER_DESC'); ?></option>
         </select>
        </td>
       <td valign="top"></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_RESULTS_SELECTBOX'); ?></strong></td>
        <td valign="top">
         <input type="hidden" name="config[resselpo]" value="0">
         <input type="checkbox" class="checkbox" name="config[resselpo]" value="1" <?php if ($config['resselpo'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_RESULTS_SELECTBOX_HELP'); ?></td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_RESULTS_PUBLISHED_ONLY'); ?></strong></td>
        <td valign="top">
         <input type="hidden" name="config[publ]" value="0">
         <input type="checkbox" class="checkbox" name="config[publ]" value="1" <?php if ($config['publ'] == 1) echo 'checked' ?>/>
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_RESULTS_PUBLISHED_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top" ><strong><?php echo JText::_('ADMIN_GS_RESULTS_DISPLAY'); ?>:</strong></td>
    <td valign = "top" >
     <select name="config[rdisp]" class="listbox">
      <option value = '1' <?php if ($config['rdisp'] == 1) echo 'selected'; ?>><?php echo JText::_('ADMIN_GS_RESULTS_DISPLAY_MAIN'); ?></option>
      <option value = '2' <?php if ($config['rdisp'] == 2) echo 'selected'; ?>><?php echo JText::_('ADMIN_GS_RESULTS_DISPLAY_POPUP'); ?></option>
      </select></td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_RESULTS_DISPLAY_HELP'); ?></td>
      </tr>

    <tr>

      <tr><td colspan = 3><hr></td></tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_RESULTS_BARCOLOR'); ?></strong></td>
        <td valign="top">
         <input class="inputbox" type="text" name="config[maxcolors]" value="<?php echo htmlspecialchars( $config['maxcolors'], ENT_QUOTES ); ?>" size="3" />
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_RESULTS_BARCOLOR_HELP'); ?></td>
       </tr>
       <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_RESULTS_BARHEIGHT'); ?></strong></td>
        <td valign="top">
         <input class="inputbox" type="text" name="config[height]" value="<?php echo htmlspecialchars( $config['height'], ENT_QUOTES ); ?>" size="3" />
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_RESULTS_BARHEIGHT_HELP'); ?></td>
       </tr>
      </table>
<!-- Page 3 -->
<?php echo $comp->endPanel();
echo $comp->startPanel(JText::_('ADMIN_GS_SECURITY'),"secu_tab");
?>

    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_SECURITY_COOKIES'); ?></strong></td>
        <td valign="top">
         <input id=scookie type="hidden" name="config[scookie]" value="0">
         <input id=scookie type="checkbox" class="checkbox" name="config[scookie]" value="1" <?php if ($config['scookie'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_SECURITY_COOKIES_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_SECURITY_IP'); ?></strong></td>
        <td valign="top">
         <input id=sip type="hidden" name="config[sip]" value="0">
         <input id=sip type="checkbox" class="checkbox" name="config[sip]" value="1" <?php if ($config['sip'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_SECURITY_IP_HELP'); ?></td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_SECURITY_USERNAME'); ?></strong></td>
        <td valign="top">
         <input id=sip type="hidden" name="config[suname]" value="0">
         <input id=sip type="checkbox" class="checkbox" name="config[suname]" value="1" <?php if ($config['suname'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top"><?php echo JText::_('ADMIN_GS_SECURITY_USERNAME_HELP'); ?></td>
      </tr>
		</table>

<?php
echo $comp->endPanel();
echo $comp->startPanel(JText::_('ADMIN_GS_MISCELLANEOUS'),"misc_tab");
?>
    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong>Debugging</strong></td>
        <td valign="top">
<?php		$types = array("off"=>0, "Frontend"=>1,"Backend"=>2,"Both"=>3);
			$html = xtMakeSelect($types, $config['debug'], "config[debug]");
    		echo $html;
    		?>
        </td>
        <td align="left" valign="top">Set Debugging mode</td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_MISCELLANEOUS_IMAGE_ROOT'); ?></strong></td>
        <td valign="top">
         <input class="inputbox" type="text" name="config[imgpath]" value="<?php echo htmlspecialchars( $config['imgpath'], ENT_QUOTES ); ?>" size="40" />
        </td>
        <td align="left" valign="top"><?php echo JText::_('ADMIN_GS_MISCELLANEOUS_IMAGE_HELP'); ?></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong><?php echo JText::_('ADMIN_GS_MISCELLANEOUS_COMPAT'); ?></strong></td>
        <td valign="top">
           	<?php echo xtYesNo($config["compat"], "config[compat]", $config["compat"]); ?>
        </td>
        <td align="left" valign="top"><?php echo JText::_('ADMIN_GS_MISCELLANEOUS_COMPAT_HELP'); ?></td>
      </tr>



    </table>
<?php
echo $comp->endPanel();
echo $comp->endPane();
?>

    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="task" value="saveSettings" />
    <input type="hidden" name="boxchecked" value="0" />

    </form>
<div style="clear:both">
      <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><img src="images/help_f2.png" alt="Help"></td>
        <td colspan = 2 valign=top>
        <?php echo $tod; ?>
        </td>
      </tr>
    </table>
</div>
<?php   }


	function showMamboPolls( &$rows, &$pageNav, $option ) {

		JHTML::_('behavior.tooltip');
	
		$my = JFactory::getUser();

		?>
		<form action="index2.php" method="post" name="adminForm">
		
		<table class="adminlist">
		<tr>
			<th width="5">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th align="left">
			<?php echo JText::_('ADMIN_POLL_MANAGER_IMPORT_MANAGER_TITLE'); ?>
			</th>
			<th width="10%" align="center">
			<?php echo JText::_('ADMIN_POLL_MANAGER_IMPORT_MANAGER_PUBLISHED'); ?>
			</th>
			<th width="10%" align="center">
			<?php echo JText::_('ADMIN_POLL_MANAGER_IMPORT_MANAGER_OPTIONS'); ?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$link 	= 'index2.php?option=com_poll&task=editA&hidemainmenu=1&id='. $row->id;

			$task 	= $row->published ? 'unpublish' : 'publish';
			$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt 	= $row->published ? 'Published' : 'Unpublished';

            $checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$row->id."\" onclick=\"isChecked(this.checked);\" />";			?>
			<tr class="<?php echo 'row$k'; ?>">
				<td>
				<?php echo $pageNav->getRowOffset( $i ); ?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td>
				<?php echo $row->title; ?>
				</td>
				<td align="center">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
				</td>
				<td align="center">
				<?php echo $row->numoptions; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}

function cPanel($option, $rows, $limit, $limitstart, $pageNav) {
	require_once(JPATH_SITE.'/administrator/components/com_pollxt/conf.pollxt.php');
?>

<table class="adminform">
<tr>
	<td width="50%" valign="top">
    <table width="100%" class="adminform">
    <tr>
	   <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=settings&amp;hidemainmenu=1">
	        <img src="images/config.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	        <?php echo JText::_('ADMIN_GlOBAL_SETTINGS'); ?>
	       </a>
	       </div></div></div>
        </td>
	   <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=show" style="text-decoration:none;">
	       <img src="images/addedit.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       <?php echo JText::_('ADMIN_MAINTAIN_POLLS'); ?>
	       </a>
	       </div></div>
        </td>
	   <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=import" style="text-decoration:none;">
	       <img src="images/backup.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       <?php echo JText::_('ADMIN_IMPORT_POLLS'); ?>
	       </a>
	       </div></div></div>
        </td>
    </tr>
    <tr>
	   <td valign="top" >
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="http://www.joomlaXT.com" target="_blank" style="text-decoration:none;">
	       <img src="images/support.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       <?php echo JText::_('ADMIN_SUPPORT_HOMEPAGE'); ?>
	       </a>
	       </div></div></div>
        </td>
        <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=checkUpdate" style="text-decoration:none;">
	       <img src="images/install.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       <?php echo JText::_('ADMIN_ONLINE_UPGRADE'); ?>
	       </a>
	       </div></div></div>
        </td>
        <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=exportList" style="text-decoration:none;">
	       <img src="images/downloads_f2.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       <?php echo JText::_('ADMIN_EXPORT_RESULT'); ?>
	       </a>
	       </div></div></div>
        </td>
        </tr>
    </table>
<form action="index2.php" method="POST" name="adminForm">
    <table class="adminlist">
        <tr>
            <th><?php echo JText::_('ADMIN_POLL'); ?></th>
            <th><?php echo JText::_('ADMIN_VOTES'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ( $rows as $row ) {
            $link 	= 'index2.php?option=com_pollxt&task=editA&hidemainmenu=1&id='. $row->id; ?>
        <tr>
		  <td>
		      <a href ="<?php echo $link ?>"><?php echo stripslashes($row->title);?></a>
		  </td>
		  <td>
		      <a href="#" onClick="javascript:window.open('<?php echo JUri::root().'/index.php?option=com_pollxt&isPopup=1&tmpl=component&admin=1&task=showResult&id='.$row->id;?>','Result', 'resizable=yes, scrollbars=yes, location=no, menubar=no, status=no, toolbar=no, width=640, height=480')">
<?php echo $row->voters;?></a>
		  </td>
	   </tr>
	   <?php
	       $i++;
        }
        ?>
    </table>
    <?php echo $pageNav->getListFooter(); ?>
    <input type="hidden" name="option" value="<?php echo $option;?>" />
    </form>
	</td>
    

    <td width="50%" valign="top">
	<?php 
 	$myhtml = new xthtml();
 	$myhtml->version = $xt_config->version;
 	$myhtml->name = "PollXT";
 	$myhtml->headerimg = "components/com_pollxt/pollxt.png";
 	echo $myhtml->cpanelInfo();
	?>
    </td>
</tr>
</table>
<?php
}

function updateResult($option, $msg) {
    mosCommonHTML::loadOverlib();

?>
   <table class="adminheading" border="0">
   <tr>
      <th class="install"><?php echo JText::_('ADMIN_POLLXT_UPGRADE');?></th>
   </tr>
   </table>
<form action="index2.php" method="post" name="adminForm">

<table width = "75%" class="adminlist">
<?php
 foreach ($msg as $m) {
    if ($m->type == "e") $fc="bb0000";
    if ($m->type == "s") $fc="009900";
    if ($m->type == "i") $fc="000000";

?>
<tr>
 <td style="color:#<?php echo $fc?>; font-weight:bold; font-size:12px"><?php echo $m->text ?></td>
</tr>
<?php } ?>
</table>
</form>
<?php
}
function exportList( &$rows, &$pageNav, $option ) {
                global $_VERSION;

?>
<style type= "text/css">.icon-32-download 		{ background-image: url(<?php echo JUri::root();?>/administrator/templates/khepri/images/toolbar/icon-32-download.png); }</style>

<form action="index2.php" method="POST" name="adminForm">
<input type="hidden" name="hidemainmenu" value="0" />

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminlist">
  <tr>
   <th  colspan="2" align="left"><?php echo JText::_('ADMIN_POLL_MANAGER_EXPORT_MANAGER_TITLE');?></th>
   <th width ="10%" align="center"><?php echo JText::_('ADMIN_POLL_MANAGER_EXPORT_MANAGER_ID');?></th>
   <th width ="10%" align="center"><?php echo JText::_('ADMIN_POLL_MANAGER_EXPORT_MANAGER_QUESTIONS');?></th>
   <th width ="10%" align="center"><?php echo JText::_('ADMIN_POLL_MANAGER_EXPORT_MANAGER_VOTES');?></th>  </tr>

<?php
$k = 0;
$j = 0;
for ($i=0, $n=count( $rows ); $i < $n; $i++) {
 $row = &$rows[$i];

 $link 	= 'index2.php?option=com_pollxt&task=doexport&hidemainmenu=1&cid[]='. $row->id;


  $checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$row->id."\" onclick=\"isChecked(this.checked);\" />";

?>

 <tr class="<?php echo "row$k"; ?>">
  <td width="10">
  <?php  echo $checked  ?>
  </td>
  <td align="left">
    <a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','doexport')"><?php echo stripslashes($row->title); ?></a>
  </td>
  <td  align="center"><?php echo $row->id; ?>&nbsp;</td>
  <td  align="center"><?php echo $row->numoptions; ?>&nbsp;</td>
  <td  align="center"><?php echo $row->voters; ?>&nbsp;</td>
<?php                $k = 1 - $k; $j++; ?>
</tr>
<?php        } ?>
</table>
<?php echo $pageNav->getListFooter(); ?>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="task" value="show" />
<input type="hidden" name="boxchecked" value="0" />

</form>
        <?php
}

}
?>
