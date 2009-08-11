<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

?>

<?php $user= JFactory::getUser(); if (!$user->guest):?>
<script type="text/javascript">
	window.addEvent('domready', function(){
		$('userName').setProperty('value','<?php echo $user->name;?>');
		$('userName').setProperty('disabled','disabled');
		$('commentEmail').setProperty('value','<?php echo $user->email;?>');
		$('commentEmail').setProperty('disabled','disabled');
	})
</script>
<?php endif; ?>

<h4 class="itemCommentsFormTitle"><?php echo JText::_('Add comment') ?></h4>
<form action="index2.php" method="post" id="comment-form" class="form-validate">
	<label class="formComment"><?php echo JText::_( 'Comment' );?></label>
	<textarea rows="20" cols="10" class="inputbox" onblur="if(this.value=='') this.value='<?php echo JText::_( 'enter your comment here...' );?>';" onfocus="if(this.value=='<?php echo JText::_( 'enter your comment here...' );?>') this.value='';" name="commentText"><?php echo JText::_( 'enter your comment here...' );?></textarea>
	<label class="formName"><?php echo JText::_( 'Name' );?></label>
	<input class="inputbox" type="text" name="userName" id="userName" value="<?php echo JText::_( 'enter your name...' );?>"  onblur="if(this.value=='') this.value='<?php echo JText::_( 'enter your name...' );?>';" onfocus="if(this.value=='<?php echo JText::_( 'enter your name...' );?>') this.value='';" />
	<label class="formEmail"><?php echo JText::_( 'E-mail' );?></label>
	<input class="inputbox" type="text" name="commentEmail" id="commentEmail" value="<?php echo JText::_( 'enter your e-mail address...' );?>"  onblur="if(this.value=='') this.value='<?php echo JText::_( 'enter your e-mail address...' );?>';" onfocus="if(this.value=='<?php echo JText::_( 'enter your e-mail address...' );?>') this.value='';" />
	<label class="formUrl"><?php echo JText::_('URL (optional)');?></label>
	<input class="inputbox" type="text" name="commentURL" value="<?php echo JText::_( 'enter your site URL...');?>"  onblur="if(this.value=='') this.value='<?php echo JText::_( 'enter your site URL...' );?>';" onfocus="if(this.value=='<?php echo JText::_( 'enter your site URL...' );?>') this.value='';" />
	<?php if ($this->params->get('recaptcha')):?>
		<?php require_once JPATH_COMPONENT.DS.'lib'.DS.'recaptchalib.php'; $publickey = $this->params->get('recaptcha_public_key'); ?>
		<label class="formRecaptcha"><?php echo JText::_('Enter the two words you see below');?></label>
		<?php echo recaptcha_get_html($publickey); ?>
	<?php endif ?>
	<span class="clr"></span>
	<div class="readon-wrap1"><div class="readon1-l"></div><a class="readon-main"><span class="readon1-m"><span class="readon1-r"><input type="submit" class="button" id="button" value="<?php echo JText::_( 'Submit comment' );?>" /></span></span></a></div><div class="clr"></div>
	<span id="formLog"></span>
	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="item" />
	<input type="hidden" name="task" value="comment" />
	<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
</form>
