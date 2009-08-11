<?php
/*
// "K2 Tools" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

// CSS
//$filePath = substr(JURI::base(), 0, -1).str_replace(JPATH_SITE,'',dirname(__FILE__));
//$document->addStyleSheet($filePath.'/css/style.css');

?>

<script type="text/javascript">
	//<![CDATA[
	window.addEvent('domready', function(){
	    $$('a.calendarNavLink').addEvent('click', function(e){
	        new Event(e).stop();
					var url = this.getProperty('href');
	        $('k2Calendar').empty().addClass('k2CalendarLoader');
	        new Ajax(url, {
	            method: 'post',
	            update: $('k2Calendar'),
	            onComplete: function(){
	                $('k2Calendar').removeClass('k2CalendarLoader');
									window.fireEvent('mydomready');
	            }
	        }).request();
	    });
	    
	});
	
	window.addEvent('mydomready', function(){
	    $$('a.calendarNavLink').addEvent('click', function(e){
	        new Event(e).stop();
					var url = this.getProperty('href');
	        $('k2Calendar').empty().addClass('k2CalendarLoader');
	        new Ajax(url, {
	            method: 'post',
	            update: $('k2Calendar'),
	            onComplete: function(){
	                $('k2Calendar').removeClass('k2CalendarLoader');
									window.fireEvent('mydomready');
	            }
	        }).request();
	    });
	});
	//]]>
</script>

<div class="k2CalendarContainer <?php echo $params->get('moduleclass_sfx'); ?>">
	<div id="k2Calendar">
		<?php echo $calendar; ?>
	</div>
</div>
