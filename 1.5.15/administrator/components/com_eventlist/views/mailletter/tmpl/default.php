<?php
/**
 * @version 1.0 $Id: default.php 958 2009-02-02 17:23:05Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');
?>

<script language="javascript" type="text/javascript">
	function submitbutton(task)
	{

		var form = document.adminForm;
		var message = <?php echo $this->editor->getContent( 'message' ); ?>

		if (task == 'cancel') {
			submitform( task );
		} else if (form.kind.value == ""){
			alert( "<?php echo JText::_( 'ADD TITLE'); ?>" );
			form.kind.focus();
		} else {
			<?php echo $this->editor->save( 'message' );?>
			submitform( task );
		}
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="adminform">
	<tr>
		<td valign="top">
			<table class="adminform">
				<tr>
					<td>
						<label for="kind"><?php echo JText::_( 'MAIL TITLE' ).':'; ?></label>
					</td>
					<td>
						<input class="inputbox" type="text" name="kind" id="kind" size="50" maxlength="500" value="<?php echo $this->row->kind; ?>" />
					</td>
				</tr>
			</table>

			<table class="adminform">
				<tr>
					<td>
						<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols, buttons echo $this->row->id;
						if($this->row->id != 0){
							$edit_value = $this->row->message;
						}
						echo $this->editor->display( 'message',  $edit_value, '100%;', '550', '75', '20', array('pagebreak', 'readmore') ) ;
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table id="customers" border="1" cellspacing="0" cellpadding="4">
<tbody>
	<tr valign="top" bgcolor=#629DE3>
		<td width='150' align="center"><b><font color='#FFFFFF'>Tag</font></b></td>
		<td width='110' align="center"><b><font color='#FFFFFF'>名稱</font></b></td>
		<td width='110'align="center"><b><font color='#FFFFFF'>語系</font></b></td>
		<td align="center"><b><font color='#FFFFFF'>格式</font></b></TD>
	</tr>
	<tr>
		<td>{EVENT}</td>
		<td>活動名稱</td>
		<td>依據填入的資訊</td>
		<td>測試活動</td>
	</tr>
	<tr  bgcolor=#B2DAEA>
		<td>{EVENT_EN}</td>
		<td>活動名稱</td>
		<td>依據填入的資訊</td>
		<td></td>
	</tr>
	<tr>
		<td>{EVENT_ADDRESS}</td>
		<td>活動地點</td>
		<td>依據填入的資訊</td>
		<td>[台北] 中央研究院資訊科學研究所101室</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_ADDRESS_EN}</td>
		<td>活動地點</td>
		<td>依據填入的資訊</td>
		<td></TD>
	</tr>
	<tr>
		<td>{EVENT_ADMIN}</td>
		<td>聯絡人姓名</td>
		<td>依據填入的資訊</td>
		<td>contact</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{ADMIN_PHONE}</td>
		<td>聯絡人電話</td>
		<td>依據填入的資訊</td>
		<td>(02)2788-3799</TD>
	</tr>
	<tr>
		<td>{ADMIN_EMAIL}</td>
		<td>聯絡人信箱</td>
		<td>依據填入的資訊</td>
		<td>admin@joomla.com</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{USER}</td>
		<td>收件人姓名</td>
		<td>依據填入的資訊</td>
		<td>王大明</TD>
	</tr>
	<tr>
		<td>{EVENT_DATE}</td>
		<td>活動日期</td>
		<td>日期</td>
		<td>2011-08-02</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_END_DATE}</td>
		<td>活動結束日期</td>
		<td>日期</td>
		<td>2011-08-02</TD>
	</tr>
	<tr >
		<td>{SIGNUP_ID}</td>
		<td>報名序號</td>
		<td>數字</td>
		<td>0001</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_WAITING}</td>
		<td>候補序號</td>
		<td>數字</td>
		<td>1</TD>
	</tr>
	<tr>
		<td>{NEW_NAME}</td>
		<td>使用者姓名</td>
		<td>依據填入的資訊</td>
		<td>Admin</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{NEW_COMPANY}</td>
		<td>使用者公司</td>
		<td>依據填入的資訊</td>
		<td>OSSF</TD>
	</tr>
	<tr>
		<td>{NEW_CAPTAINCY}</td>
		<td>使用者職稱</td>
		<td>依據填入的資訊</td>
		<td>OSSF</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_REG_EN}</td>
		<td>活動語系</td>
		<td>英文</td>
		<td>English</TD>
	</tr>
	<tr>
		<td>{EVENT_REG_ZH}</td>
		<td>活動語系</td>
		<td>中文</td>
		<td>Chinese</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_PAGE_EN}</td>
		<td>活動頁面link</td>
		<td>英文</td>
		<td><a href=''>registration website</a></TD>
	</tr>
	<tr>
		<td>{EVENT_PAGE_ZH}</td>
		<td>活動頁面link</td>
		<td>中文</td>
		<td><a href=''>活動網頁</a></TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_CANCEL_EN}</td>
		<td>取消報名連結</td>
		<td>英文</td>
		<td><a href=''>here</a></TD>
	</tr>
	<tr>
		<td>{EVENT_CANCEL_ZH}</td>
		<td>取消報名連結</td>
		<td>中文</td>
		<td><a href=''>取消報名</a></TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_TIME_EN}</td>
		<td>活動時間</td>
		<td>英文</td>
		<td>10:00~12:00 on Wednesday, Nov 23, 2011</TD>
	</tr>
	<tr>
		<td>{EVENT_TIME_ZH}</td>
		<td>活動時間</td>
		<td>中文</td>
		<td>2011 年 11 月 23 ( 三 ) 10:00~12:00</TD>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{EVENT_VIP_MD}</td>
		<td>vip開始報名時間</td>
		<td>英文</td>
		<td>Oct 31</TD>
	</tr>
	<tr>
		<td>{EVENT_VIP_MD2}</td>
		<td>vip結束報名時間</td>
		<td>英文</td>
		<td>November 03 14:00</td>
	</tr>
	<tr bgcolor=#B2DAEA>
		<td>{VIP_END_TIME}</td>
		<td>vip報名結束時間</td>
		<td>中文</td>
		<td>2011年11月03(三) 14:00</td>
	</tr>
</tbody>
</table>


<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_eventlist" />
<input type="hidden" name="controller" value="mail_list" />
<input type="hidden" name="view" value="MailLetter" />
<input type="hidden" name="task" value="" />
<?php if ($this->task == 'copy') { ?>
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="created" value="" />
	<input type="hidden" name="author_ip" value="" />
	<input type="hidden" name="created_by" value="" />
<?php } else { ?>
	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
	<input type="hidden" name="created" value="<?php echo $this->row->created; ?>" />
	<input type="hidden" name="author_ip" value="<?php echo $this->row->author_ip; ?>" />
	<input type="hidden" name="created_by" value="<?php echo $this->row->created_by; ?>" />
<?php } ?>
</form>



<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
