<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $g2Config, $my;

$g2ItemId = intval(mosGetParam($_REQUEST, 'g2_itemId', 0));

if(empty($g2ItemId)){
	$g2ItemId = $g2Config['id.rootAlbum'];
	$_REQUEST['g2_itemId'] = $g2Config['id.rootAlbum'] ;
	$_GET['g2_itemId'] = $g2Config['id.rootAlbum'] ;
}

$ret = core::initiatedG2('false');
//
    if ($g2Config['displaysidebar'] == 0) {
        GalleryCapabilities::set('showSidebarBlocks', false);
    } else {
        GalleryCapabilities::set('showSidebarBlocks', true);
    }
    
    if ($g2Config['displaylogin'] == 0) {
        GalleryCapabilities::set('login' , false);
    } else {
        GalleryCapabilities::set('login' , true);
    }

    // handle the G2 request
    $g2moddata = GalleryEmbed::handleRequest($my->username);

    // show error message if isDone is not defined
    if (!isset($g2moddata['isDone'])) {
      print 'isDone is not defined, something very bad must have happened.';
      exit;
    }

    // die if it was a binary data (image) request
    if ($g2moddata['isDone']) {
      exit; /* uploads module does this too */
    }

/* pathway and meta data */
if($g2ItemId){
	core::pathWay($g2ItemId, $g2moddata['headHtml']);
}

/* Save sidebar in global so we can call it in the module */
$GLOBALS['g2sidebar'] = $g2moddata['sidebarBlocksHtml'];

/* Print gallery content */
print $g2moddata['bodyHtml'];
?>