<?php
$class_sfx = $params->get( 'moduleclass_sfx', "");
$user = JFactory::getUser();
$pipe = '&nbsp;&nbsp|&nbsp;&nbsp;';


global $mainframe;
echo '<div class="ofssologin_'.$class_sfx.'">';
if($user->get('aid') == 0)
{ //login
  $loginPost = ("/sso/user/login?return_url=/of/user/dashboard");
  $singupPost = ("sso/user/signup");
  
  echo '<a href="'.$loginPost.'">'.JText::_('Login').'</a>';
  echo $pipe;
  echo '<a href="'.$singupPost.'">'.JText::_('REGISTER').'</a>';
  echo $pipe;
  include_once( $mainframe->getCfg( 'absolute_path' ) . '/modules/mod_jflanguageselection/mod_jflanguageselection.php');
}
else
{ //logout
  $logoutPost   = "/sso/user/logout";
  $dashboard    = "/of/user/dashboard";
  $ssoedit      = "/sso/user/edit";
  $txtusername  = $user->get('username');

  echo JText::_('HI');
  echo '<a href="user/userprofile/">';
  echo $txtusername.'</a>';
  echo $pipe;
  echo '<a href="'.$dashboard.'" >'.JText::_('DASHBOARD').'</a>';
  echo $pipe;
  echo '<a href="'.$ssoedit.'">'.JText::_('SETTINGS').'</a>';
  echo $pipe;
  echo '<a href="'.$logoutPost.'">'.JText::_('LOGOUT').'</a>';
  echo $pipe;
  include_once( $mainframe->getCfg( 'absolute_path' ) . '/modules/mod_jflanguageselection/mod_jflanguageselection.php');
}
//Add search code
$doc =& JFactory::getDocument();
$doc->addScript(JURI::root(true) ."/modules/mod_ofssologin/js/ofssologin.js");
$JText = &JFactory::getLanguage();
echo <<<EOD
<div class="ofssologin_search_{$class_sfx}">
  <form id="of_search" action="/of/openfoundry/search" method="get" onsubmit="of_search(); return false;">
    <select id="of_search_type">
      <option value="Projects"> {$JText->_('PROJECTS')} </option>
      <option value="Content"> {$JText->_('CONTENT')} </option>
      <option value="People"> {$JText->_('PEOPLE')} </option>
    </select>
    <input id="query" name="query" id="mod_search_searchword" maxlength="50" alt="search" class="inputbox" type="text" size="28" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />
    <input type="hidden" name="commit" value="search" />
  </form>
</div>
EOD;
echo '</div>';
