<?php
/**
 * @version 1.0 $Id: default.php 1004 2009-04-16 08:45:31Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENCE.php
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
defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">

		Window.onDomReady(function(){
			document.formvalidator.setHandler('date',
				function (value) {
					if(value=="") {
						return true;
					} else {
						timer = new Date();
						time = timer.getTime();
						regexp = new Array();
						regexp[time] = new RegExp('^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$','gi');
						return regexp[time].test(value);
					}
				}
			);
			document.formvalidator.setHandler('time',
				function (value) {
					if(value=="") {
						return true;
					} else {
						timer = new Date();
						time = timer.getTime();
						regexp = new Array();
						regexp[time] = new RegExp('^[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}$','gi');
						return regexp[time].test(value);
					}
				}
			);
			document.formvalidator.setHandler('catsid',
				function (value) {
					if(value=="") {
						return true;
					} else {
						timer = new Date();
						time = timer.getTime();
						regexp = new Array();
						regexp[time] = new RegExp('^[1-9]{1}[0-9]{0,}$');
						return regexp[time].test(value);
					}
				}
			);
		});

		function submitbutton( pressbutton ) {


			if (pressbutton == 'cancelevent' ) {
				elsubmitform( pressbutton );
				return;
			}
			
			var form = document.getElementById('adminForm');
			var validator = document.formvalidator;
			var title = $(form.title).getValue();
			title.replace(/\s/g,'');
			
			var contact = form.contact.value;
			
			if(contact==0){
				alert("<?php echo JText::_( 'PLEAST CHOOSE CONTACT', true ); ?>");
				return false;
			}
			
			if ( title.length==0 ) {
   				alert("<?php echo JText::_( 'ADD TITLE', true ); ?>");
   				validator.handleResponse(false,form.title);
   				form.title.focus();
   				return false;
			} else if ( validator.validate(form.catsid) === false ) {
    			alert("<?php echo JText::_( 'SELECT CATEGORY', true ); ?>");
    			form.catsid.focus();
    			return false;
  			} else if ( validator.validate(form.locid) === false ) {
    			alert("<?php echo JText::_( 'SELECT VENUE', true ); ?>");
    			form.locid.focus();
    			return false;
  			} else {
  			<?php
			// JavaScript for extracting editor text
				echo $this->editor->save( 'datdescription' );
			?>
				submit_unlimited();
				elsubmitform(pressbutton);

				return false;
			}
		}
		
		//joomla submitform needs form name
		function elsubmitform(pressbutton){
			
			var form = document.getElementById('adminForm');
			if (pressbutton) {
				form.task.value=pressbutton;
			}
			if (typeof form.onsubmit == "function") {
				form.onsubmit();
			}
			form.submit();
		}


		var tastendruck = false
		function rechne(restzeichen)
		{
			maximum = <?php echo $this->elsettings->datdesclimit; ?>

			if (restzeichen.datdescription.value.length > maximum) {
				restzeichen.datdescription.value = restzeichen.datdescription.value.substring(0, maximum)
				links = 0
			} else {
				links = maximum - restzeichen.datdescription.value.length
			}
			restzeichen.zeige.value = links
		}

		function berechne(restzeichen)
   		{
  			tastendruck = true
  			rechne(restzeichen)
   		}
</script>

<div id="eventlist" class="el_editevent">

	<?php if ($this->params->def( 'show_page_title', 1 )) : ?>
		<h1 class="componentheading"><?php echo $this->params->get('page_title'); ?></h1>
	<?php endif; ?>

	<form enctype="multipart/form-data" id="adminForm" action="<?php echo JRoute::_('index.php?option=com_eventlist') ?>" method="post">
		<div class="el_save_buttons floattext">
			<button type="submit" class="submit" onclick="return submitbutton('saveevent');"><?php echo JText::_('SAVE') ?></button>
			<button type="reset" class="button cancel" onclick="submitbutton('cancelevent');"><?php echo JText::_('CANCEL') ?></button>
		</div>

		<p class="clear"></p>
        
		<fieldset class="el_fldst_details">
			<legend><?php echo JText::_('NORMAL INFO'); ?></legend>

			<div class="el_title floattext">
				<label for="title"><?php echo JText::_( 'TITLE' ).':'; ?></label>
				<input class="inputbox required" type="text" id="title" name="title" value="<?php echo $this->row->title; ?>" size="40" maxlength="60" />
			</div>
			
			<div class="el_title floattext">
				<label for="speaker"><?php echo JText::_( 'SPEAKER' ).':'; ?></label>
				<?php 
					$value = $this->row->created_by;

					$db = JFactory::getDBO();
					$query = "SELECT * ".
							 "FROM #__users ".
							 "WHERE id IN($value)";
					$db->setQuery($query);
					$member_id = $db->loadObjectlist();

					for($i=0;$i<count($member_id);$i++){
						$speaker[] = $member_id[$i]->name;
					}

					$speakers = implode(',&nbsp;',$speaker);
						echo $speakers;
				?>
          	</div>
          
          	<div class="el_title floattext">
              	<label for="contact"><?php echo JText::_( 'contact' ).':'; ?></label>
				<?php 
					$value = $this->row->contact;
					echo ELOutput::member_list( $value, 2, 'contact' );
				?>
			</div>
			
				<input type="hidden" id="a_name" value="<?php echo $this->row->venue; ?>" disabled="disabled" />
        <input class="inputbox required" type="hidden" id="a_id" name="locid" value="<?php echo $this->row->locid; ?>" />

			<div class="el_category floattext">
          		<label for="catsid" class="catsid"><?php echo JText::_( 'CATEGORY' ).':';?></label>
          		<?php
                	$html = JHTML::_('select.genericlist', $this->categories, 'catsid','size="1" class="inputbox required validate-catsid"', 'value', 'text', $this->row->catsid );
                	echo $html;
          		?>
			</div>
			<div class="el_startdate floattext">
				<label for="registra"><?php echo JText::_( 'AR' ).':'; ?></label>
				<?php echo $this->lists['registra'];?>
			</div>
        </fieldset>
    	<?php if ( $this->elsettings->showfroregistra == 2 ) : ?>
    	<fieldset class="el_fldst_registration">
      		<?php
      		//register end
      		if ( $this->elsettings->showfrounregistra == 2 ) :
      		?>
      		<div class="el_unregister floattext">
        		<p><strong><?php echo JText::_( 'published' ).':'; ?></strong></p>
            	<label for="published0"><?php echo JText::_( 'NO' ); ?></label>
        			<input type="radio" name="published" id="published0" value="0" <?php echo (!$this->row->published) ? 'checked="checked"': ''; ?> />
        			<br class="clear" />
            	<label for="published1"><?php echo JText::_( 'YES' ); ?></label>
            	<input type="radio" name="published" id="published1" value="1" <?php echo ($this->row->published) ? 'checked="checked"': ''; ?>/>
      		</div>
      		<?php
      		//unregister end
      		endif;
      		?>
    	</fieldset>

    	<?php
    	//registration end
    	endif;
    	?>
        <input type="hidden" class="inputbox validate-time" id="times" name="times" value="<?php echo substr($this->row->times, 0, 5); ?>" size="15" maxlength="8" />
				<input type="hidden" class="inputbox validate-time" id="el_endtime" name="endtimes" value="<?php echo substr($this->row->endtimes, 0, 5); ?>" size="15" maxlength="8" />&nbsp;
				<input type="hidden" class="inputbox validate-time" id="signupEndtime" name="signupEndtime" value="<?php echo substr($this->row->signupEndtime, 0, 5); ?>" size="15" maxlength="8" />&nbsp;
		
				<div id="counter_row" style="display:none;">
                  	<label for="recurrence_counter"><?php echo JText::_( 'RECURRENCE COUNTER' ); ?>:</label>
                  	<div class="el_date>"><?php echo JHTML::_('calendar', ($this->row->recurrence_counter <> 0000-00-00) ? $this->row->recurrence_counter : JText::_( 'UNLIMITED' ), "recurrence_counter", "recurrence_counter"); ?><a href="#" onclick="include_unlimited('<?php echo JText::_( 'UNLIMITED' ); ?>'); return false;"><img src="components/com_eventlist/assets/images/unlimited.png" width="16" height="16" alt="<?php echo JText::_( 'UNLIMITED' ); ?>" /></a></div>
			</div>

			<input type="hidden" name="recurrence_number" id="recurrence_number" value="<?php echo $this->row->recurrence_number; ?>" />
			<input type="hidden" name="recurrence_type" id="recurrence_type" value="<?php echo $this->row->recurrence_type; ?>" />

    	<fieldset class="description">
      		<legend><?php echo JText::_('DESCRIPTION'); ?></legend>

      		<?php
      		
      		//if usertyp min editor then editor else textfield
      		if ($this->editoruser) :
      			if($this->row->id == 0){
					 $edit_value = ELOutput::Default_value();
      			}else{
      				 $edit_value = $this->row->datdescription;
      			}
      			echo $this->editor->display('datdescription', $edit_value, '100%', '400', '70', '15', array('pagebreak', 'readmore') );
      		else :
      		?>
      		<textarea style="width:100%;" rows="10" name="datdescription" class="inputbox" wrap="virtual" onkeyup="berechne(this.form)"><?php echo $this->row->datdescription; ?></textarea><br />
      		<?php echo JText::_( 'NO HTML' ); ?><br />
      		<input disabled value="<?php echo $this->elsettings->datdesclimit; ?>" size="4" name="zeige" /><?php echo JText::_( 'AVAILABLE' ); ?><br />
      		<a href="javascript:rechne(document.adminForm);"><?php echo JText::_( 'REFRESH' ); ?></a>
      		<?php endif; ?>
    	</fieldset>
<!--  removed to avoid double posts in ie7
      <div class="el_save_buttons floattext">
          <button type="submit" class="submit" onclick="return submitbutton('saveevent')">
        	    <?php echo JText::_('SAVE') ?>
        	</button>
        	<button type="reset" class="button cancel" onclick="submitbutton('cancelevent')">
        	    <?php echo JText::_('CANCEL') ?>
        	</button>
      </div>
-->   
		<p class="clear">
    	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
    	<input type="hidden" name="referer" value="<?php echo @$_SERVER['HTTP_REFERER']; ?>" />
    	<input type="hidden" name="created" value="<?php echo $this->row->created; ?>" />
    	<input type="hidden" name="author_ip" value="<?php echo $this->row->author_ip; ?>" />
    	<input type="hidden" name="curimage" value="<?php echo $this->row->datimage; ?>" />
    	<?php echo JHTML::_( 'form.token' ); ?>
    	<input type="hidden" name="task" value="" />
    	</p>
    </form>

</div>

<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
