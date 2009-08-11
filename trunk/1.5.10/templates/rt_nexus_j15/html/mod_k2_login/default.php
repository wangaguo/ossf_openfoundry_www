<?php
/*
// "K2 Login" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
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

<?php if($type == 'logout') : ?>

<form action="index.php" method="post" name="login" class="form-login">
  <?php if ($params->get('greeting')) : ?>
  <div>
    <?php if ($params->get('name')) : {
		echo JText::sprintf( 'HINAME', $user->get('name') );
	} else : {
		echo JText::sprintf( 'HINAME', $user->get('username') );
	} endif; ?>
  </div>
  <?php endif; ?>
  <div align="center">
    <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
  </div>
  <input type="hidden" name="option" value="com_user" />
  <input type="hidden" name="task" value="logout" />
  <input type="hidden" name="return" value="<?php echo $return; ?>" />
</form>

<?php else : ?>

<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var modlogin = 1;';
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif; ?>
<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" class="form-login" >
  <?php echo $params->get('pretext'); ?>
  <fieldset class="input">
    <p id="form-login-username">
      <label for="modlgn_username"><?php echo JText::_('Username') ?></label>
      <br />
      <div class="input-field-l"><input id="modlgn_username" type="text" name="username" class="inputbox" alt="username" size="18" /></div>
    </p>
    <p id="form-login-password">
      <label for="modlgn_passwd"><?php echo JText::_('Password') ?></label>
      <br />
      <div class="input-field-l"><input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="18" alt="password" /></div>
    </p>
    <?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
    <p id="form-login-remember">
      <input id="modlgn_remember" type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" />
<label for="modlgn_remember"><?php echo JText::_('Remember me') ?></label>
    </p>
    <?php endif; ?>
    <div class="readon-wrap1"><div class="readon1-l"></div><a class="readon-main"><span class="readon1-m"><span class="readon1-r"><input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" /></span></span></a></div><div class="clr"></div>
  </fieldset>
<div class="login-links">
    <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>" class="login-forgot-password"> <?php echo JText::_('Forgot your password?'); ?></a><br />
    <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>" class="login-forgot-password"> <?php echo JText::_('Forgot your username?'); ?></a><br />
    <?php
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		if ($usersConfig->get('allowUserRegistration')) : ?>
    <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=register' ); ?>"> <?php echo JText::_('Create an account'); ?></a>
    <?php endif; ?>
</div>
  <?php echo $params->get('posttext'); ?>
  <input type="hidden" name="option" value="com_user" />
  <input type="hidden" name="task" value="login" />
  <input type="hidden" name="return" value="<?php echo $return; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php endif; ?>
