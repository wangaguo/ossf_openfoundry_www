<?php
define( '_JEXEC', 1 );
define('JPATH_BASE', '/home/ossf/OpenFoundry' );
define('DS', DIRECTORY_SEPARATOR);
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

if ($_REQUEST['entry'] == 'admin')
  $mainframe =& JFactory::getApplication('administrator');
else
  $mainframe =& JFactory::getApplication('site');

$mainframe->initialise();
jimport('joomla.user.helper');
JPluginHelper::importPlugin('user');

function triggerEvent($event, $args=null)
{
  $dispatcher =& JDispatcher::getInstance();
  return $dispatcher->trigger($event, $args);
}

$identity = null;
if (isset($_SERVER['HTTP_EPPN']) && !empty($_SERVER['HTTP_EPPN'])) {
  $identity = $_SERVER['HTTP_EPPN'];
}
else {
  // Error, identity attribute is missing
}
preg_match('/^(.*)@.*$/', $identity, $matches);
$user = JUser::getInstance($matches[1]);
$results = triggerEvent('onLoginUser', array((array)$user, $options));

?>

<script>
location.href="<?=$_REQUEST['return_url']?>";
</script>
