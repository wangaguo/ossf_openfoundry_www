<?php
/**
 * @package   Quantive Template - RocketTheme
 * @version   1.5.0 March 31, 2010
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2010 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Quantive Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="rt-joomla <?php echo $this->params->get('pageclass_sfx')?>">
	<div class="user">

		<h2 class="title">
			<?php echo JText::_('PASSWORD_RESET_SUCCESS'); ?>
		</h2>
		
		<p>
			<?php echo JText::_('PASSWORD_RESET_SUCCESS_REDIRECT'); ?>
		</p>
	
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	</div>
</div>
