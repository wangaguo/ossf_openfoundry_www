<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
core::classRequireOnce('utility');
global $g2Cache;
$g2Version = $g2Cache->getCachedFunction('expiresLong', 'utility::comVersion'); 
print '<div class="footer" align="center">Powered by <a href="http://opensource.4theweb.nl" target="_blank">4 The Web</a> V'.$g2Version.'</div>';
?>