<?php
/**
 * @version   $Id: shsef.php 1078 2009-09-27 10:43:05Z silianacom-svn $
 * @package   sh404SEF
 * @copyright Copyright (C) 2010 Yannick Gaultier. All rights reserved.
 * @license   GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport( 'joomla.utilities.string');

$mainframe->registerEvent( 'onAfterDispatch', 'plgSh404sefofflinecode' );

/**
 * Output a correct response code when site is offline
 * to let know search engines that site data
 * should not be discarded or discounted
 */
function plgSh404sefofflinecode() {

  global $mainframe;

  $user=& JFactory::getUser();

  if (!$mainframe->getCfg('offline') || $user->get('gid') >= '23') {
    return;
  }

  // need to render offline screen
  $document =& JFactory::getDocument();
  $template = $mainframe->getTemplate();
  $params = array(
          'template'  => $template,
          'file'    => 'offline.php',
          'directory' => JPATH_THEMES
  );
  $data = $document->render( $mainframe->getCfg('caching'), $params);

  // header : service unavailable
  JResponse::setHeader('HTTP/1.0 503',true);

  // give it some time
  // get plugin params
  $plugin =& JPluginHelper::getPlugin('sh404sefcore', 'sh404sefofflinecode');
  $pluginParams = new JParameter($plugin->params);
  $retryAfter = $pluginParams->get( 'retry_after_delay', 7400);
  
  // set header
  Jresponse::setheader('Retry-After', gmdate( 'D, d M Y H:i:s', time() + $retryAfter ) . ' GMT');

  // render document and echo it
  JResponse::setBody($data);
  echo JResponse::toString($mainframe->getCfg('gzip'));

  // and terminate
  $mainframe->close();

}
