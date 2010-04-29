<?php
class OfssoLibrary 
{
  function PostRequest($url, $referer, $_data) {
    // convert variables array to string:
    $data = array();
    while(list($n,$v) = each($_data)){
      $data[] = "$n=$v";
    }
    $data = implode('&', $data);
    // format --> test1=a&test2=b etc.

    // parse the given URL
    $url = parse_url($url);
    if ($url['scheme'] != 'http') {
      die('Only HTTP request are supported !');
    }

    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];

    // open a socket connection on port 80
    $fp = fsockopen($host, 80);

    // send the request headers:
    fputs($fp, "POST $path HTTP/1.1\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp, "Referer: $referer\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: ". strlen($data) ."\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $data);

    $result = '';
    while(!feof($fp)) {
      // receive the results of the request
      $result .= fgets($fp, 128);
    }

    // close the socket connection:
    fclose($fp);

    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);

    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';

    // return as array:
    return array($header, $content);
  }

  /**
  * Check if the user can access the application
  *
  * @access public
  */
  function authorize($itemid)
  {
    $config =& JFactory::getConfig();
    $ofsso_regist_key = $config->getValue( 'config.ofsso_regist_key' );
    $ofsso_cookie_name = $config->getValue( 'config.ofsso_cookie_name' );
    $ofsso_service_cookie_name = $config->getValue( 'config.ofsso_service_cookie_name' );
    $ofsso_site  = $config->getValue( 'config.ofsso_site' );
    $ofsso_sso  = $ofsso_site.'/site/fetch';

    global $mainframe;
    $menus  =& JSite::getMenu();
    $user   =& JFactory::getUser();
    $aid    = $user->get('aid');

    if($user->get('aid') > 0 && $_COOKIE[$ofsso_cookie_name] != $_COOKIE[$ofsso_service_cookie_name])
    {
      $mainframe->logout();
    }
    if($user->get('aid') == 0 && $_COOKIE[$ofsso_cookie_name])
    { //do check & login
      $data = array(
        'regist_key' => $ofsso_regist_key,
        'session_key' => $_COOKIE[$ofsso_cookie_name]
      );

      list($header, $content) = $this->PostRequest(
        $ofsso_sso,
        JFactory::getURI()->toString(),
        $data
      );

      preg_match('/name:\s(.*),?$/', $content, $matches);
      if($matches[1] != null)
      { //fetch username successed. do service login.
        $user =& JFactory::getUser($matches[1]);
        JPluginHelper::importPlugin('user');
        $results = $mainframe->triggerEvent('onLoginUser', array((array)$user, $options));
        if(!in_array(false, $results, true))
        { //successed. save backup session_id.
          setcookie($ofsso_service_cookie_name, $_COOKIE[$ofsso_cookie_name]);
        }
        else
        {
          echo('failed');
        }
      }
      else
      { //fetch faild. remove auth_session.
        setcookie("ossfauth", "", time()-3600);
      }
    }

    if(!$menus->authorize($itemid, $aid))
    {
      echo('menus authorize');
      if ( ! $aid )
      {
        // Redirect to login
        $uri        = JFactory::getURI();
        $return     = $uri->toString();
        $url = $ofsso_site.'/users/login?return_url='.$return;

        $mainframe->redirect($url);
      }
      else
      {
        JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
      }
    }
  }
}
