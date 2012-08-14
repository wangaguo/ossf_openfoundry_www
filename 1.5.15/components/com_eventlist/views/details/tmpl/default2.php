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
	<h1 class="componentheading">
		<?php echo $this->params->get('page_title'); ?>
	</h1>
<?php endif; ?>

<!-- Details EVENT -->
	<h2 class="eventlist">
		<?php
    	//echo JText::_( 'EVENT' ); //yen delete
	echo $this->escape($this->row->title); //yen edit
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
			echo ELOutput::formatdate($this->row->dates, $this->row->times);
    					
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

			    <a href="<?php echo $this->row->url; ?>"><?php echo $this->escape($this->row->venue); ?></a> -

			<?php elseif ($this->elsettings->showdetlinkvenue == 2) : ?>

			    <a href="<?php echo JRoute::_( 'index.php?view=venueevents&id='.$this->row->venueslug ); ?>"><?php echo $this->row->venue; ?></a> -

			<?php elseif ($this->elsettings->showdetlinkvenue == 0) :

				echo $this->escape($this->row->venue).' - ';

			endif;

			echo $this->escape($this->row->city); ?>

			</dd>

		<?php endif; ?>

		<dt class="category"><?php echo JText::_( 'CATEGORY' ).':'; ?></dt>
    		<dd class="category">
				<?php echo "<a href='".JRoute::_( 'index.php?view=categoryevents&id='.$this->row->categoryslug )."'>".$this->escape($this->row->catname)."</a>";?>
		<dt class="contact"><?php echo JText::_( 'CONTACT' ).':'; ?></dt>
		<dd class="contact">
			<?php
				//yen edit
				$db = JFactory::getDBO();
				$contact_id = explode(":",$this->row->slug);
				$query = "SELECT contact FROM #__eventlist_events WHERE id = '".$contact_id[0]."'";
				$db->setQuery($query);
				$contact = $db->loadObject();	
				$query_contact = "SELECT name, email FROM #__users WHERE id = '".$contact->contact."'";
				$db->setQuery($query_contact);
				$contacter = $db->loadObject();
				echo "$contacter->name ";
				echo "<img src = ./images/M_images/emailButton.png /> ";
				echo "<a href='mailto:".$contacter->email."'>".$contacter->email."</a>";
				//yen edit end
			?>				
</dd>
			
	<?php
	// is a plugin catching the display of creator ?
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

  	    <h2 class="description"><?php //echo JText::_( 'DESCRIPTION' ); ?></h2>
  		<div class="description event_desc">
  			<?php echo $this->row->datdescription; ?>
  		</div>

  	<?php endif; ?>

<!--  	Venue  -->

	<?php if ($this->row->locid != 0) : ?>

		<h2 class="location">
			<?php //echo JText::_( 'VENUE' ) ; ?>
  			<?php echo ELOutput::editbutton($this->item->id, $this->row->locid, $this->params, $this->allowedtoeditvenue, 'editvenue' ); ?>
		</h2>

		<?php //flyer
		echo ELOutput::flyer( $this->row, $this->limage );
		echo ELOutput::mapicon( $this->row );
		?>

		<dl class="location floattext">
			 <dt class="venue"><?php echo $this->elsettings->locationname.':'; ?></dt>
				<dd class="venue">
				<?php echo "<a href='".JRoute::_( 'index.php?view=venueevents&id='.$this->row->venueslug )."'>".$this->escape($this->row->venue)."</a>"; ?>

				<?php if (!empty($this->row->url)) : ?>
					&nbsp; - &nbsp;
					<a href="<?php echo $this->row->url; ?>"> <?php echo JText::_( 'WEBSITE' ); ?></a>
				<?php
				endif;
				?>
				</dd>

			<?php
  			if ( $this->elsettings->showdetailsadress == 1 ) :
  			?>

  				<?php if ( $this->row->street ) : ?>
  				<dt class="venue_street"><?php echo JText::_( 'STREET' ).':'; ?></dt>
				<dd class="venue_street"><?php echo $this->escape($this->row->street); ?></dd>
				<?php endif; ?>

				<?php if ( $this->row->plz ) : ?>
  				<dt class="venue_plz"><?php echo JText::_( 'ZIP' ).':'; ?></dt>
				<dd class="venue_plz"><?php echo $this->escape($this->row->plz); ?></dd>
				<?php endif; ?>

				<?php if ( $this->row->city ) : ?>
    			<dt class="venue_city"><?php echo JText::_( 'CITY' ).':'; ?></dt>
    			<dd class="venue_city"><?php echo $this->escape($this->row->city); ?></dd>
    			<?php endif; ?>

    			<?php if ( $this->row->state ) : ?>
    			<dt class="venue_state"><?php echo JText::_( 'STATE' ).':'; ?></dt>
    			<dd class="venue_state"><?php echo $this->escape($this->row->state); ?></dd>
				<?php endif; ?>

				<?php if ( $this->row->country ) : ?>
				<dt class="venue_country"><?php echo JText::_( 'COUNTRY' ).':'; ?></dt>
    			<dd class="venue_country"><?php echo $this->row->countryimg ? $this->row->countryimg : $this->row->country; ?></dd>
    			<?php endif; ?>
			<?php
			endif;
			?>
			
		</dl>

		<?php if ($this->elsettings->showlocdescription == 1) :	?>
			<h2 class="location_desc"><?php echo JText::_( 'DESCRIPTION' ); ?></h2>
  			<div class="description location_desc"><?php echo $this->row->locdescription;	?></div>
		<?php endif; ?>

	<?php
	//row->locid !=0 end
	endif;
	?>

	<?php 
	if ($this->row->registra == 1) :
		echo $this->loadTemplate('attendees');//<!-- Registration -->
	endif; 
	if ($this->elsettings->commentsystem != 0 && !$this->params->get('pop', 0)) :	
		echo $this->loadTemplate('comments'); //<!-- Comments -->
	endif; 
	?>

<p class="copyright"><?php echo ELOutput::footer( ); ?></p>
</div>
