<?php
/**
 * @version		$Id: install.mtimporter.php 608 2009-03-20 12:18:51Z CY $
 * @package		MT Importer
 * @copyright	(C) 2005-2009 Mosets Consulting. All rights reserved.
 * @license		GNU General Public License
 * @author		Lee Cher Yeong <mtree@mosets.com>
 * @url			http://www.mosets.com/tree/
 */

defined('_JEXEC') or die('Restricted access');

require_once( 'components/com_mtree/admin.mtree.class.php' );

function com_install() {
?>
<font size="+1">
<a href="index.php?option=com_mtimporter&amp;task=check_csv">Import data from .csv file</a>
<br />
<a href="index.php?option=com_mtimporter&amp;task=check_jcontent">Import data Joomla's Content &amp; Weblinks</a>
<br />
<a href="index.php?option=com_mtimporter&amp;task=check_gossamerlinks">Import data from Gossamer Links</a>
</font>
<?php
}

?>