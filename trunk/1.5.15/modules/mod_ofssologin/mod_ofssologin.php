<?php
$class_sfx = $params->get( 'moduleclass_sfx', "");
$user = JFactory::getUser();


global $_CB_framework, $_CB_database, $ueConfig, $mainframe, $_SERVER;
include_once( $mainframe->getCfg( 'absolute_path' ) . '/administrator/components/com_comprofiler/plugin.foundation.php');
//Add language select module
include_once( $mainframe->getCfg( 'absolute_path' ) . '/modules/mod_jflanguageselection/mod_jflanguageselection.php');



if($user->get('aid') == 0)
{ //logout
  $loginPost = ("sso/user/login?return_url=/");
  echo '<form action="'.$loginPost.'" method="post" id="mod_loginform'.$class_sfx.'" ';
  echo '<span class="mod_ssologin"><a href="'.$loginPost.'">'.JText::_('Login').'</a></span>';

  $singupPost = ("sso/user/signup");
  echo '|<span class="mod_ssologin"><a href="'.$singupPost.'" class="mod_register'.$class_sfx.'">';
  echo JText::_('REGISTER').'</span>'; 
  echo '</a></span>';
  echo '</form>';
}
else
{ //logout
  $logoutPost   = "sso/user/logout";
  $dashboard    = "sso/user/dashboard";
  $ssoedit      = "sso/user/edit";
  $txtusername = '<span class="mod_ssologin">'.JText::_('HI');
  $txtusername.= '<a href="'.cbSef("index.php?option=com_comprofiler&amp;task=userProfile&amp;Itemid=54").'" class="mod_login'.$class_sfx.'">';
  $txtusername.= $user->get('username').'</a></span>';
  echo '<span class="mod_ssologin">'.$txtusername.'</span>|'; //username
  echo '<span class="mod_ssologin"><a href="'.$dashboard.'" >'.JText::_('DASHBOARD').'</a></span>|';
  echo '<span class="mod_ssologin"><a href="'.$ssoedit.'">'.JText::_('SETTINGS').'</a></span>|';
  echo '<span class="mod_ssologin"><a href="'.$logoutPost.'">'.JText::_('LOGOUT').'</a></span>';
}
//Add search code
include_once( $mainframe->getCfg( 'absolute_path' ) . '/modules/mod_rokajaxsearch/mod_rokajaxsearch.php');
