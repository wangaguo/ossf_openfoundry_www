<?php
/**
* 信件列表
*/

defined('_JEXEC') or die('Restricted access');
?>

<form action="index.php" method="post" name="adminForm">

	<table class="adminlist" cellspacing="1">
		<thead>
			<tr>
				<th width="5%"><?php echo JText::_( 'Num' ); ?></th>
				<th width="5%"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>
				<th class="title" width = 200><?php echo JText::_( 'MAIL TITLE' ); ?></th>
				<th width="10%">sys</th>
				<th width="1%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', 'ID', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
			</tr>
		</thead>

	<tbody>
		<?php
		$k = 0;
		for($i=0, $n=count( $this->rows ); $i < $n; $i++) {
			$row = &$this->rows[$i];
			$checked = JHTML::_('grid.checkedout', $row, $i );
			$link = 'index.php?option=com_eventlist&amp;controller=mail_list&amp;task=edit&amp;cid[]='.$row->id;
		?>
		
	<tr class="<?php echo "row$k"; ?>">
		<td><center><?php echo $this->pageNav->getRowOffset( $i ); ?></center></td>
		<td><center><?php echo $checked; ?></center></td>
		<td>
			<?php
			//顯示信件標題
			if ( $row->checked_out && ( $row->checked_out != $this->user->get('id') ) ) {
				echo htmlspecialchars($row->kind, ENT_QUOTES, 'UTF-8');
			} else {
			?>
			<span class="editlinktip hasTip" title="<?php echo JText::_( 'EDIT EVENT' );?>::<?php echo $row->kind; ?>">
				<a href="<?php echo $link; ?>"><?php echo htmlspecialchars($row->kind, ENT_QUOTES, 'UTF-8'); ?></a>
			</span>
			<?php
			}
			?>
			<br />
		</td>
		<td align="center" >
			<?php
				$elsettings = ELAdmin::config();
				//審核通過
				if($row->id==$elsettings->mail_approved){echo JText::_('AUDIT SUCCESS');} 
				if($row->id==$elsettings->mail_approved_EN){echo JText::_('AUDIT SUCCESS')."(EN)";} 
				
				//審核未通過
				if($row->id==$elsettings->mail_rejected){echo JText::_('AUDIT FAIL');} 
				if($row->id==$elsettings->mail_rejected_EN){echo JText::_('AUDIT FAIL')."(EN)";} 
				
				//審核提示
				if($row->id==$elsettings->audit_notice){echo JText::_('AUDIT NOTICE');}
				if($row->id==$elsettings->audit_notice_EN){echo JText::_('AUDIT NOTICE')."(EN)";}
				
				//報名成功
				if($row->id==$elsettings->mail_join){echo JText::_('REGISTRATION SUCCESS');} 
				if($row->id==$elsettings->mail_join_EN){echo JText::_('REGISTRATION SUCCESS')."(EN)";} 
				
				//取消報名
				if($row->id==$elsettings->mail_cancel){echo JText::_('REGISTRATION CANCEL');} 
				if($row->id==$elsettings->mail_cancel_EN){echo JText::_('REGISTRATION CANCEL')."(EN)";} 
				
				//候補通知
				if($row->id==$elsettings->mail_candidate){echo JText::_('REGISTRATION CANDIDATE');} 
				if($row->id==$elsettings->mail_candidate_EN){echo JText::_('REGISTRATION CANDIDATE')."(EN)";}
				
				//使用者加入通知
				if($row->id==$elsettings->toadmin_join){echo JText::_('ADMIN JOIN');}
				
				//使用者取消通知
				if($row->id==$elsettings->toadmin_cancel){echo JText::_('ADMIN CANCEL');}
				
				//額滿通知
				if($row->id==$elsettings->toadmin_full){echo JText::_('ADMIN FULL'); }
				
				//vip邀請信
				if($row->id==$elsettings->	touser_vipmail){echo JText::_('VIP INVITE MAIL');}
				if($row->id==$elsettings->	touser_vipmail_EN){echo JText::_('VIP INVITE MAIL')."(EN)";}
			?>
		</td>
		<td align="center"><?php echo $row->id; ?></td>
	</tr>
	<?php $k = 1 - $k; } ?>
		
	</tbody>
	</table>
	
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="option" value="com_eventlist" />
	<input type="hidden" name="view" value="mail_list" />
	<input type="hidden" name="controller" value="mail_list" />
	<input type="hidden" name="task" value="" />
</form> 
