<?php

require_once( 'components/com_mtree/admin.mtree.class.php' );

function com_install() {
?>
<font size="+1">
<a href="index2.php?option=com_mt_importer&amp;task=check_csv">Import data from .csv file</a>
<br />
<a href="index2.php?option=com_mt_importer&amp;task=check_jcontent">Import data Section/Category/Content</a>
<br />
<a href="index2.php?option=com_mt_importer&amp;task=check_mosdir">Import data from mosDirectory 2.2x</a>
<br />
<a href="index2.php?option=com_mt_importer&amp;task=check_gossamerlinks">Import data from Gossamer Links</a>
</font>
<?php
}

?>
