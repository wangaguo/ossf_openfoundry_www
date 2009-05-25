<?php
/**
* PollXT for Joomla! 1.0.x
* @Copyright (C) 2004 - 2006 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 1.30
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $mosConfig_list_limit;

require_once( $mosConfig_absolute_path .'/administrator/includes/pageNavigation.php' );

$limit 			= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
$limitstart 	= $mainframe->getUserStateFromRequest( "view{$option}", 'limitstart', 0 );


        $database->setQuery( "SELECT COUNT(*) FROM #__pollsxt" );
        $total = $database->loadResult();
        echo $database->getErrorMsg();

        $pageNav = new mosPageNav( $total, $limitstart, $limit  );

        $database->setQuery( "SELECT m.*, u.name AS editor,"
                . "\n        COUNT(d.id) AS numoptions"
                . "\nFROM #__pollsxt AS m"
                . "\nLEFT JOIN #__users AS u ON u.id = m.checked_out"
                . "\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"
                . "\nGROUP BY m.id"
                . "\nORDER BY m.ordering"
                . "\nLIMIT $pageNav->limitstart,$pageNav->limit"
        );
        $rows = $database->loadObjectList();

?>

<table class="adminlist">
<tr>
    <th>
	Poll
	</th>
    <th>
	Votes
	</th>

</tr>
<?php
$i = 0;
foreach ( $rows as $row ) {
    $link 	= 'index2.php?option=com_pollxt&task=editA&hidemainmenu=1&id='. $row->id; ?>
	<tr>
		<td>
		<a href ="<?php echo $link ?>"><?php echo $row->title;?></a>
		</td>
		<td>
		<?php echo $row->voters;?>
		</td>

	</tr>
	<?php
	$i++;
}
?>
</table>
<?php echo $pageNav->getListFooter(); ?>
<input type="hidden" name="option" value="" />
