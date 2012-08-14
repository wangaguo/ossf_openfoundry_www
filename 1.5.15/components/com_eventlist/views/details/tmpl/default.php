<?php
/**
 * @version 1.0 $Id: default.php 1023 2009-04-27 15:21:09Z julienv $
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

// no direct access 
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div id="eventlist" class="event_id<?php echo $this->row->did; ?> el_details">
	<p class="buttons">
		<?php echo ELOutput::mailbutton( $this->row->slug, 'details', $this->params ); ?>
		<?php echo ELOutput::printbutton( $this->print_link, $this->params ); ?>
	</p>

<?php if ($this->params->def( 'show_page_title', 1 )) : ?>
	<h1 class="componentheading"><?php echo $this->params->get('page_title'); ?></h1>
<?php endif; ?>

<!-- Details EVENT -->
	<h2 class="eventlist">
		<?php
    	//echo JText::_( 'EVENT' );
		echo $this->escape($this->row->title); 
		echo '&nbsp;'.ELOutput::editbutton($this->item->id, $this->row->did, $this->params, $this->allowedtoeditevent, 'editevent' );
    	?>
	</h2>

	<?php //flyer
	//echo ELOutput::flyer( $this->row, $this->dimage, 'event' );
	  echo ELOutput::link_icon( $this->row, $this->dimage );
	?>

	<dl class="event_info floattext">
  		<dt class="when"><?php echo JText::_( 'WHEN' ).':'; ?></dt>
		<dd class="when">
		<?php
			echo ELOutput::formatdate($this->row->dates, $this->row->times);
    					
    		if ($this->row->enddates && $this->row->dates != $this->row->enddates) :
    			echo ' - '.ELOutput::formatdate($this->row->enddates, $this->row->endtimes);
    		endif;
    		
    		if ($this->elsettings->showtimedetails == 1) :
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ELOutput::formattime($this->row->dates, $this->row->times);
				if ($this->row->endtimes) :
					echo ' - '.ELOutput::formattime($this->row->enddates, $this->row->endtimes);
				endif;
			endif;
		?>
		</dd>
  		<?php
  		if ($this->row->locid != 0) :
  		?>
		    <dt class="where"><?php echo JText::_( 'WHERE' ).':'; ?></dt>
		    <dd class="where">
    		<?php if (($this->elsettings->showdetlinkvenue == 1) && (!empty($this->row->url))) : ?>
			    <a href="<?php echo $this->row->url; ?>"><?php echo $this->escape($this->row->venue); ?></a> 
			<?php elseif ($this->elsettings->showdetlinkvenue == 2) : ?>
			    <a href="<?php echo JRoute::_( 'index.php?view=venueevents&id='.$this->row->venueslug ); ?>"><?php echo $this->row->venue; ?></a> 
			<?php elseif ($this->elsettings->showdetlinkvenue == 0) :
				echo $this->escape($this->row->venue).'-';
			endif;
			//echo $this->escape($this->row->city); ?>
			</dd>
		<?php endif; ?>

<dt class="category"><?php echo JText::_( 'CATEGORY' ).':'; ?></dt>
	<dd class="category"><?php echo "<a href='".JRoute::_( 'index.php?view=categoryevents&id='.$this->row->categoryslug )."'>".$this->escape($this->row->catname)."</a>";?></dd>
                
	<?php
		//查詢聯絡人並連成字串, 聯絡人id 必須非adminustrator也就是62才會顯示

		$db 		= JFactory::getDBO();  
		$contact_id = explode(":", $this->row->slug);
		
		$query 		= "SELECT contact FROM #__eventlist_events WHERE id = '".$contact_id[0]."'";
		$db->setQuery($query);  
		$contact	= $db->loadObject();
		
		$query_contact = "SELECT name, email FROM #__users WHERE id = '".$contact->contact."'";
		$db->setQuery($query_contact); 
		$contacter=$db->loadObject();
		
		$is_contacter = is_object($contacter);
				
		if($is_contacter != ''){
			echo "<dt class=\"contact\">".JText::_( 'CONTACT' ).':</dt>';
			$new_name = $contacter->name;
			$new_name = ereg_replace('-',' ', $new_name);
			echo "<dd class=\"contact\">".trim($new_name).' '.
						JHTML::_('image.site',  'emailButton.png', '/images/M_images/', NULL, NULL, $text ).
						"<a href='mailto:".$contacter->email."'>".$contacter->email."</a>";

			if ($contact_id[0]=='240'){
				echo '<br>'.'陳立忠'.' ';
				echo JHTMLImage::site('emailButton.png', $folder='/images/M_images/');
				echo " <a href='mailto:michael520@citi.sinica.edu.tw'>michael520@citi.sinica.edu.tw</a></dd>";
			}else{
				echo "</dd>";
			}
		}
		echo "</dl><dl>";
		$query_tel = "SELECT cb_tel FROM #__comprofiler WHERE user_id = '".$contact->contact."'";
		$query_tel.= " AND cb_tel != '' AND cb_tel != 'NULL' ";	
		$db->setQuery($query_tel);
		$contact_tel= $db->loadObject();
		
		$is_tel = is_object($contact_tel);

		if($is_tel == 1){
			echo "<dt class=contact>".JText::_( 'TEL' ).":</dt>";
			echo "<dd class=contact>".$contact_tel->cb_tel."</dd>";	
		}
	?>

</dl>
	<?php
	// is a plugin caching the display of creator ?
	$obj = new stdClass();
	// is a plugin catching this ?
	if ($res = $this->dispatcher->trigger( 'onEventCreatorDisplay', array( $this->row->created_by, $obj )))
  	{
	?>
	<dt class="creator"><?php echo JText::_( 'PROPOSED BY' ).':'; ?></dt>
	<dd class="creator"><?php echo $obj->text;?></dd>
	
	<?php } ?>

</dl>

<!-- END of event summary section -->
	
  	<?php if ($this->elsettings->showevdescription == 1) : ?>
	<div class="description event_desc">
<?php
//加入訊息
	if($this->u_join->ch_mail == 0 && $this->u_join->ch_join == 'y'){
		echo $this->u_join->ch_mail_join;
		$query ="UPDATE #__eventlist_reg_user SET ".
				"ch_mail = '1', ".
				"cancel_mail = 'n' ".
				"WHERE reg_id = ".$this->u_join->reg_id.
				" AND reg_sn = '".$this->u_join->reg_sn."'";
		$db->SetQuery( $query );
		$db->loadObject();

	}else if($this->u_join->ch_mail == 1 && $this->u_join->ch_join == 'n' && $this->u_join->cancel_mail == 'n'){
		echo $this->u_join->ch_mail_cancel;
		$query ="UPDATE #__eventlist_reg_user SET ".
				"ch_mail = '0', ".
				"cancel_mail = 'y' ".
				"WHERE reg_id = ".$this->u_join->reg_id.
				" AND reg_sn = '".$this->u_join->reg_sn."'";
		$db->SetQuery( $query );
		$db->loadObject();

	}else{
		echo $this->row->datdescription;
	}

?>
<?php endif; ?>

	<?php
	if ($this->row->registra >= 0) : 
		echo $this->loadTemplate('attendees'); //報名列表
	endif; 
	if ($this->elsettings->commentsystem != 0 && !$this->params->get('pop', 0)) :	
		echo $this->loadTemplate('comments'); 
  	endif; 
  	?>
</div>  	
</div>

<?php 
	//顯示參加者列表
	
	$sig_id=0;
	$sig_id_nor=0;
	
	if($this->elsettings->comunsolution ==2 && $this->row->registra >= 1 ){
		
		if($this->row->audit=='n'){
			for($i=0;$i<count($this->registers);$i++){
				if( $this->registers[$i]->uid > 0 ){
					$sig_id = $sig_id + 1;
				}else{
					$sig_id_nor = $sig_id_nor + 1;
				}
			}
		}
		if($this->row->audit=='y'){
			for($i=0;$i<count($this->registers);$i++){
				if( $this->registers[$i]->uid > 0 && $this->registers[$i]->reg_audit =='1'){
					$sig_id = $sig_id + 1;
				}
				if( $this->registers[$i]->uid == 0 && $this->registers[$i]->reg_audit =='1'){
					$sig_id_nor = $sig_id_nor + 1;
				}
			}
		}
		
		//顯示名單
		$display_userlist = '';
		if($sig_id > 10 ){$display_userlist = 'display(\'menu\')';}
		if($sig_id_nor > 20 ){$display_userlist = 'display(\'menu2\')';}
		if($sig_id > 10  && $sig_id_nor > 20 ){$display_userlist = 'display(\'menu\');display(\'menu2\');';}
		if( $display_userlist != '' ){echo "<a href=javascript:".$display_userlist.">".JText::_('READMORE')."</a>";}
	}
	
unset($this->u_join);
