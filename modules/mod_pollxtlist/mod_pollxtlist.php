<?php
/**
* PollXTList Module for Mambo Open Source 4.5.2
* @Copyright (C) 2004 - 2005 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.mamboxt.com
* @version 1.20
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require_once($mosConfig_absolute_path."/administrator/components/com_pollxt/pollxt.inc.php");

$Itemid = mosGetParam( $_REQUEST, 'Itemid', 0 );
$polls = getPolls(true, false, $Itemid);
$polls = sortPolls($polls);

$menu =& new mosMenu( $database );
$menu->load( $Itemid );
$params =& new mosParameters( $menu->params );

 $tabclass = array( 'sectiontableentry1', 'sectiontableentry2' );
 $k=0;
?>
<form action="index.php" method="post" name="xtlistForm">
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" >
<tr><td>
		<table width="100%" border="0" cellspacing="0" cellpadding="" class="pollstableborder<?php echo $params->def( 'pageclass_sfx' )?>">

<?php foreach ($polls as $poll) {
			$link = sefRelToAbs( 'index.php?option=com_pollxt&task=voting&pollid='.$poll->id.'&Itemid='.$Itemid );
			$menuclass = 'category'.$params->def( 'pageclass_sfx' );
            $txt = '<a href="'.$link.'"class='.$menuclass.'>'. $poll->title .'</a>';
?>
			<tr class="<?php echo $tabclass[$k]; ?>">
			 <td>
				<?php echo $txt; ?>
            </td>
			</tr>
<?php
$k = 1 - $k;
}
?>
</table>
</form>
</td></tr></table>

