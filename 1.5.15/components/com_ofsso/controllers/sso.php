<?php
/**
 * @package    OpenFoundry SSO
 * @subpackage Components
 * @link
 * @license    OSI: MIT License
*/

class OfssoControllerSso extends JController
{
  var $need_intgration_symbol = '!';
  function logout()
  {
    $username = JRequest::getVar('username');
    global $mainframe;
    $error = $mainframe->logout($username);
    if(!JError::isError($error))
    {
      echo('true');
    }
    else
    {
      echo('false,'.$error);
    }
    $app = JFactory::getApplication();
    $app->close(); 
  }

  function VerifyUser()
  {
    $credentials["username"] = $this->need_intgration_symbol.JRequest::getVar('u');
    $credentials["password"] = JRequest::getVar('p');
    if ($credentials["username"] && $credentials["password"]) {
      jimport( 'joomla.user.authentication');
      $authenticate = & JAuthentication::getInstance();
      $response     = $authenticate->authenticate($credentials, $options);
      if ($response->status === JAUTHENTICATE_STATUS_SUCCESS)
      {
        $user = JFactory::getUser($credentials["username"]);
        if($user)
        {
          echo('true');
          $app = JFactory::getApplication();
          $app->close(); 
          return;
        }
      }  
    }
    echo('false');
    $app = JFactory::getApplication();
    $app->close(); 
  }

  function getUser()
  {
    $user = JFactory::getUser($this->need_intgration_symbol.JRequest::getVar('u'));
    if($user)
    {
      echo(json_encode($user));
    }
    else
    {
      echo('false,'.JText::_('UNABLE TO FIND A USER BY EMAIL'));
    }
    $app = JFactory::getApplication();
    $app->close();
  }

  function getUserByEmail()
  {
    $email = JRequest::getVar('e');
    //Initialize some variables
    $db = & JFactory::getDBO();

    // Lets get the id of the user we want to activate
    $query = 'SELECT id'
    . ' FROM #__users'
    . ' WHERE email = '.$db->Quote($email)
    ;
    $db->setQuery( $query );
    $id = intval( $db->loadResult() );
    
    if ($id)
    {
      $user =& JUser::getInstance( (int) $id );
      if($user)
      {
        echo(json_encode($user));
      }
      else
      {
        echo('false,'.JText::_('UNABLE TO FIND A USER'));
      }
    }
    else
    {
      echo('false,'.JText::_('UNABLE TO FIND A USER BY EMAIL'));
    }
    $app = JFactory::getApplication();
    $app->close();
  }

  function IntegrateUser()
  {
    $username = $this->need_intgration_symbol.JRequest::getVar('u');
    $new_username = JRequest::getVar('nu');
    $user = JFactory::getUser($username);
    if($user)
    {
      $user->username = $new_username; 
      $user->save();
      if($user->getError() == "") echo('true');
      else echo('false,'.$user->getError());
    }
    else
    {
      echo('false,'.JText::_('UNABLE TO FIND A USER'));
    }
    $app = JFactory::getApplication();
    $app->close();
  }

  function SyncUsers()
  {
    $data = json_decode(stripslashes($_REQUEST["data"]), true);
    if($data)
    {
      $udata = Array();
      $user = JFactory::getUser($data["user"]["name"]);
      if(!$user)
      {
        $user = new JUser();
        $udata["username"] = $data["user"]["name"];
        $udata["gid"] = 19;
        $udata["usertype"] = 'Registered';
      }
      $udata["name"] = $data["user"]["last_name"].' '.$data["user"]["first_name"];
      $udata["password"] = $data["user"]["password"];
      $udata["password2"] = $data["user"]["password"];
      $udata["email"] = $data["user"]["email"];
      $udata["params"] == Array();
      $udata["params"]["language"] = $data["user"]["language"];
      $udata["params"]["timezone"] = $data["user"]["timezone"];

      $user->bind($udata);
      $block = $data["user"]["status"] == '1' ? 0 : 1;
      $user->block = $block; 
      $user->save();
      if($user->getError() == ""){
        global $mainframe, $_CB_database;
        include_once( $mainframe->getCfg( 'absolute_path' ). '/administrator/components/com_comprofiler/plugin.foundation.php' );
        cbimport( 'cb.tabs' );
        $row = new moscomprofilerUser( $_CB_database );
        $row->id = $user->id;
        $row->user_id = $user->id;
        $row->storeNew();
        echo('1');
      }
      else echo($user->getError());
    }
    else
    {
      echo('Not a valid JSON data');
    }
    $app = JFactory::getApplication();
    $app->close();
  }
}
