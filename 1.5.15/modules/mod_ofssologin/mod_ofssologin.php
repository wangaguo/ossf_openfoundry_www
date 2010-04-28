<?php
$class_sfx = $params->get( 'moduleclass_sfx', "");
$user = JFactory::getUser();
if($user->get('aid') == 0)
{ //logout
  $loginPost = ("sso/user/login?return_url=/");
  echo '<form action="'.$loginPost.'" method="post" id="mod_loginform'.$class_sfx.'" ';
  //echo 'style="margin:0px;">'."\n";
  //echo '<input type="submit" name="Submit" class="button" value="'.JText::_('LOGIN').'" />'; //login
  echo '<a href="'.$loginPost.'">'.JText::_('Login').'</a>';

  $singupPost = ("sso/user/signup");
  echo '&nbsp;|&nbsp;<a href="'.$singupPost.'" class="mod_register'.$class_sfx.'">';
  echo JText::_('Register'); 
  echo '</a>';
}
else
{ //logout
  $logoutPost = ("sso/user/logout");
  echo '<form action="'.$logoutPost.'" method="post" id="mod_login_logoutform'.$class_sfx.'" style="margin:0px;">'."\n";

  $txtusername = '<label for="mod_login_username'.$class_sfx.'">'.$user->get('username').'</label>';
  echo '<span id="mod_login_usernametext'.$class_sfx.'">'.$txtusername.'</span>'; //username
  echo '&nbsp;|&nbsp;<input type="submit" name="Submit" class="button" value="'.JText::_('Logout').'" />'; //logout
  echo '<input type="hidden" name="return_url" value="'.JRequest::getURI().'"/>';
}
echo '</form>';
