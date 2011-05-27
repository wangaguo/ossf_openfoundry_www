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


<!-- Details EVENT -->
	<h2 class="eventlist">
		<?php
    	//echo JText::_( 'EVENT' );
	echo $this->escape($this->row->title); 
    	echo '&nbsp;'.ELOutput::editbutton($this->item->id, $this->row->did, $this->params, $this->allowedtoeditevent, 'editevent' );
    	?>
	</h2>

	<?php //flyer
	echo ELOutput::flyer( $this->row, $this->dimage, 'event' );
	?>

	<dl class="event_info floattext">

  		<dt class="when"><?php echo JText::_( 'WHEN' ).':'; ?></dt>
		<dd class="when">
			<?php
			echo ELOutput::formatdate($this->row->dates, $this->row->times).'&nbsp;&nbsp;&nbsp;&nbsp;';
    					
    		if ($this->row->enddates) :
    			echo ' - '.ELOutput::formatdate($this->row->enddates, $this->row->endtimes);
    		endif;
    		
    		if ($this->elsettings->showtimedetails == 1) :
    	
				echo '&nbsp;'.ELOutput::formattime($this->row->dates, $this->row->times);
						
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
    		<dd class="category">
				<?php echo "<a href='".JRoute::_( 'index.php?view=categoryevents&id='.$this->row->categoryslug )."'>".$this->escape($this->row->catname)."</a>";?>
			</dd>
                <dt class="category"><?php echo JText::_( 'WHO' ).':'; ?></dt>
                  <?php if ($this->row->did == 58 or $this->row->did==59 or $this->row->did==115) { ?>
                <dd class="category">葛冬梅　Florence T.M. Ko&nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:tmk2005@citi.sinica.edu.tw">tmk2005@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1474 or 0953-366-676</dd>
                 <?php }else  if($this->row->did==35) { ?>
                <dd class="category">BobChao &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:bobchao@mail.moztw.org">bobchao@mail.moztw.org</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1477</dd>

                 <?php }else  if($this->row->did==84 or $this->row->did==85) { ?>
                <dd class="category">葛冬梅 (Florence T.M. Ko) &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:tmk2005@citi.sinica.edu.tw">tmk2005@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">02-27883799 ext.1474 or 0953-366-676</dd>

                 <?php }else if ($this->row->did<=62){ ?>
                <dd class="category">OSSF &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:ossfworkshop@openfoundry.org">ossfworkshop@openfoundry.org </a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1478&nbsp;&nbsp;</dd>
                <?php }else if ($this->row->did==95 or $this->row->did==98){ ?>
                <dd class="category">OSSF &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:ossfworkshop@openfoundry.org">ossfworkshop@openfoundry.org </a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1478&nbsp;&nbsp;</dd>

		<?php }else if ($this->row->did==96 or $this->row->did==97){ ?>
                <dd class="category">胡崇偉(Marr) &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:marr.tw@gmail.com">marr.tw@gmail.com</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1477&nbsp;&nbsp;</dd>

		<?php }else if ($this->row->did==105 or $this->row->did==112 or $this->row->did==113  or $this->row->did==146){ ?>
                <dd class="category">彭冠雯 &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:anna0420@citi.sinica.edu.tw">anna0420@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1469&nbsp;&nbsp;</dd>

                <?php }else if ($this->row->did==120 or $this->row->did==121 or $this->row->did==125 or $this->row->did==148){ ?>
                <dd class="category">彭冠雯 &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:anna0420@citi.sinica.edu.tw">anna0420@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1469&nbsp;&nbsp;</dd>

                <?php }else if ($this->row->did==130 or $this->row->did==140 or $this->row->did==138  or $this->row->did==147 ){ ?>
                <dd class="category">彭冠雯 &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:anna0420@citi.sinica.edu.tw">anna0420@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1469&nbsp;&nbsp;</dd>

                <?php }else if ($this->row->did==137 or $this->row->did ==141 or $this->row->did==142 or $this->row->did==149 or $this->row->did>=150){ ?>
                <dd class="category">林玉涵 &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:tobey@citi.sinica.edu.tw">tobey@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1478&nbsp;&nbsp;or 0972-392-993</dd>

		<?php }else if ($this->row->did==143){ ?>
                <dd class="category">謝沐璇 &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:meg@citi.sinica.edu.tw">meg@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1469&nbsp;&nbsp;or 0921-144-783</dd>


                <?php }else if ($this->row->did==128 or $this->row->did==119 or $this->row->did==118 or $this->row->did==122 or $this->row->did==123 or $this->row->did==131 or $this->row->did==132 or $this->row->did==144){ ?>
                <dd class="category">請直接與主辦人連絡</dd>

                <?php }else { ?>
                <dd class="category">洪華超(Rock) &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:rockhung@citi.sinica.edu.tw">rockhung@citi.sinica.edu.tw</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1477 或 0912-516-695.</dd>
                <?php } ?>

	</dl>


			
			
	<?php
	// is a plugin caching the display of creator ?
  $obj = new stdClass();
  // is a plugin catching this ?
  if ($res = $this->dispatcher->trigger( 'onEventCreatorDisplay', array( $this->row->created_by, $obj )))
  {
     ?>
     <dt class="creator"><?php echo JText::_( 'PROPOSED BY' ).':'; ?></dt>
        <dd class="creator">
        <?php echo $obj->text;?>
      </dd>
     <?php
  }
  ?>
  
	</dl>
<!-- END of event summary section -->
	
  	<?php if ($this->elsettings->showevdescription == 1) : ?>

	<!--  	    <h2 class="description"><?php //echo JText::_( 'DESCRIPTION' ); ?></h2>-->
  		<div class="description event_desc">
  			<?php echo $this->row->datdescription; ?>
  		</div>

  	<?php endif; ?>


	<?php if ($this->row->registra == 1) : ?>

		<!-- Registration -->
		<?php //echo $this->loadTemplate('attendees'); ?>

	<?php endif; ?>
	
	<?php if ($this->elsettings->commentsystem != 0 && !$this->params->get('pop', 0)) :	?>
	
		<!-- Comments -->
		<?php echo $this->loadTemplate('comments'); ?>
		
  	<?php endif; ?>

	<?php //echo ELOutput::footer( ); ?>
</div>
