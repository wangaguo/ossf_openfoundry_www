<?php
/**
 * @version 1.0 $Id: default.php 662 2008-05-09 22:28:53Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
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
//    	echo JText::_( 'EVENT' );
	echo $this->escape($this->row->title);	
    	echo '&nbsp;'.ELOutput::editbutton($this->item->id, $this->row->did, $this->params, $this->allowedtoeditevent, 'editevent' );
    	?>
	</h2>

	<?php //flyer
	echo ELOutput::flyer( $this->row, $this->dimage, 'event' );
	?>

	<dl class="event_info floattext">
<!--
		<?php// if ($this->elsettings->showdetailstitle == 1) : ?>
			<dt class="title"><?php// echo JText::_( 'TITLE' ).':'; ?></dt>
    		<dd class="title"><?php //echo $this->escape($this->row->title); ?></dd>
		<?php
  		//endif;
  		?>
-->
  		<dt class="when"><?php echo JText::_( 'WHEN' ).':'; ?></dt>
		<dd class="when">
			<?php
			echo ELOutput::formatdate($this->row->dates, $this->row->times);
    					
    		if ($this->row->enddates) :
    			echo ' &nbsp;-&nbsp; '.ELOutput::formatdate($this->row->enddates, $this->row->endtimes).'&nbsp;&nbsp;';
    		endif;
    		
    		if ($this->elsettings->showtimedetails == 1) :
    	
				echo '&nbsp;'.ELOutput::formattime($this->row->dates, $this->row->times);
						
				if ($this->row->endtimes) :
					echo ' &nbsp;~&nbsp; '.ELOutput::formattime($this->row->enddates, $this->row->endtimes);
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

			    <a href="<?php echo JRoute::_( 'index.php?view=venueevents&id='.$this->row->venueslug ); ?>"><?php echo $this->row->venue; ?></a> 

			<?php elseif ($this->elsettings->showdetlinkvenue == 0) :

				echo $this->escape($this->row->venue).' - ';

			endif;

			//echo $this->escape($this->row->city); ?>

			</dd>

		<?php endif; ?>

		<dt class="category"><?php echo JText::_( 'CATEGORY' ).':'; ?></dt>
    		<dd class="category">
				<?php echo "<a href='".JRoute::_( 'index.php?view=categoryevents&id='.$this->row->categoryslug )."'>".$this->escape($this->row->catname)."</a>";?>
			</dd>
		<dt class="category"><?php echo JText::_( 'WHO' ).':'; ?></dt>
	          <?php if ($this->row->did == 16) { ?>

		<dd class="category">Susan &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:yunchi23@iis.sinica.edu.tw">yunchi23@iis.sinica.edu.tw</a></dd>
		<dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1477</dd>
		
		 <?php }else  if($this->row->did==35) { ?>
                <dd class="category">BobChao &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:bobchao@mail.moztw.org">bobchao@mail.moztw.org</a></dd>
                <dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
                <dd class="category">2788-3799#1477</dd>

		 <?php }else { ?>
		<dd class="category">陳飛亨(Freddi) &nbsp;&nbsp;<img src="/images/M_images/emailButton.png">&nbsp;&nbsp;<a href="mailto:freddi.chen@iis.sinica.edu.tw">freddi.chen@iis.sinica.edu.tw</a></dd>
		<dt class="category">&nbsp;&nbsp;<!--TEL--></dt>
		<dd class="category">2788-3799#1478&nbsp;&nbsp;or&nbsp;&nbsp;0926-700-316</dd>
		<?php } ?>
	</dl>


  	<?php if ($this->elsettings->showevdescription == 1) : ?>

<!--  	    <h2 class="description"><?php //echo JText::_( 'DESCRIPTION_INFO' ); ?></h2> Modify by ally-->
<!-- 	    Insert the signupJ Online Registion						 	       -->
  		<div class="description event_desc">
  			<?php echo $this->row->datdescription; ?>
			<div class="contentpane">


<!-- Start SignupJ-->
                        <?php// if ($this->row->did == 18)  : ?>
<!--                        <iframe src="http://swan.iis.sinica.edu.tw/signupJ/signup.php?reg_id=35" width="100%"  height="650" scrolling="auto" align="top" frameborder="0" lass="wrapper"> Not Open </iframe>-->
                        <?php //endif; ?>



<!-- End SignupJ-->

			</div>
			
  		</div>

  	<?php endif; ?>


	<?php if ($this->row->registra == 1) : ?>

		<!-- Registration -->
		<?php echo $this->loadTemplate('attendees'); ?>

	<?php endif; ?>
	
	<?php if ($this->elsettings->commentsystem != 0) :	?>
	
		<!-- Comments -->
		<?php echo $this->loadTemplate('comments'); ?>
		
  	<?php endif; ?>

<p class="copyright">
	<?php echo ELOutput::footer( ); ?>
</p>
</div>
