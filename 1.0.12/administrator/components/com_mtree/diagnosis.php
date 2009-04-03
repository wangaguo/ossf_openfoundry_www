<?php

function startprint( $cat_id ) {
	echo '<pre align="left">';
	getsubcats( 0 );
	echo "</pre>";
}

function getsubcats( $cat_id ) {
	global $database;

	static $level = 0;

	$database->setQuery( "SELECT cat_id, cat_name, cat_cats, cat_links, lft, rgt FROM #__mt_cats WHERE cat_parent = $cat_id ORDER BY lft" );
	$cats = $database->loadObjectList();
	$level++;

	foreach( $cats AS $cat ) {
		echo "<br /> &nbsp;".str_repeat("&nbsp;",($level-1)*4).str_repeat("-",($level-1)).$cat->cat_name ." <small>[$cat->cat_id] <font color=\"#C0C0C0\">$cat->cat_cats,$cat->cat_links</font></small> (<font color=blue>".$cat->lft."</font>;<font color=green>".$cat->rgt."</font>)";

		getsubcats( $cat->cat_id );

	}
	$level--;

}

?>