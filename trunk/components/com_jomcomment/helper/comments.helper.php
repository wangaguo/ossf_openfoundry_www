<?php
function getCustomAlertHtml($title, $content, $style ='', $actions=''){
	$html = '<div class="dialog_header">'. $title .'<div onclick="azrulHideWindow();" class="dialog_close">[ Close ]</div></div>
		 <div class="dialog_content">
			<div id="dialog_body" class="dialog_body">
				'. $content .'
			</div>';

	if($actions){
		$html .='
			<div id="dialog_buttons" class="dialog_buttons">
				<hr size="1" noshade="noshade"/>
				'.$actions.'
			</div>';
	}

	$html .='</div>';
	return $html;

}
	
function jcStripBbcode($comment) {

	$patterns = array (
						'/\[b\](.*?)\[\/b\]/i',
						'/\[u\](.*?)\[\/u\]/i',
						'/\[code\](.*?)\[\/code\]/i',
						'/\[quote\](.*?)\[\/quote\]/i',
						'/\[i\](.*?)\[\/i\]/i',
						'/\[url=(.*?)\](.*?)\[\/url\]/i',
						'/\[url\](.*?)\[\/url\]/i',
						'/\[color=(.*?)\](.*?)\[\/color\]/i',
						'/\[font=(.*?)\](.*?)\[\/font\]/i',
						'/\[size=(.*?)\](.*?)\[\/size\]/i',
						'/\[img\](.*?)\[\/img\]/i');

	$replacements = array (
							'<b>\\1</b>',
							'\\1',
							'\\1',
							'\\1',
							'\\1',
							'\\1',
							'\\1',
							'\\1',
							'\\1',
							'\\1',
							'\\1');

	$comment = preg_replace($patterns, $replacements, $comment);
	return $comment;
}

// Build the link to com_content item
// A portable way to create link to article
function jcGetContentLink($cid, $itemid = '', $xhtml = true){
	global $mainframe;

	$cms    	=& cmsInstance('CMSCore');
	$cms->load('helper','url');
	
	$contentUrl = '';
	if(cmsVersion() == _CMS_JOOMLA10){
	    $contentUrl = cmsSefAmpReplace("index.php?option=com_content&task=view&id=$cid&Itemid=$itemid");
	} else if(cmsVersion() == _CMS_JOOMLA15){
	    // We know how Joomla 1.5 handles the URL for com_content so we get
	    // the "slug" and "clug" to be appended to the link.
	    $cms    =& cmsInstance('CMSCore');
	    $strSQL =  "SELECT "
	            .  "CASE WHEN CHAR_LENGTH( a.alias ) "
				.  "THEN CONCAT_WS( ':', a.id, a.alias ) "
				.  "ELSE a.id "
				.  "END AS slug, "
				.  "CASE WHEN CHAR_LENGTH( b.alias ) "
				.  "THEN CONCAT_WS( ':', b.id, b.alias ) "
				.  "ELSE b.id "
				.  "END AS cslug "
				.  "FROM #__content AS a "
				.  "LEFT JOIN jos_categories AS b ON b.id = a.catid "
				.  "AND a.id='{$cid}'";

		$cms->db->query($strSQL);
		$links   = $cms->db->first_row();
		$contentUrl .= 'index.php?option=com_content&view=article&id=' . $links->slug . '&catid=' . $links->cslug . '&Itemid=' . $itemid;
		$contentUrl = cmsSefAmpReplace($contentUrl, $xhtml);
	}
	return $contentUrl;
}

/**
 * jcTranslate()
 * @params $contents: data to be translated by JCView
 **/
function jcTranslate($contents){
	if(!$contents)
	    return $contents;

	$cms    =& cmsInstance('CMSCore');
	
	if(!class_exists('JCView') || !class_exists('UTF8Helper')){
		include_once(JC_COM_PATH . '/class.encoding.php');
		include_once(JC_COM_PATH . '/views.jomcomment.php');
	}
	$viewMgr    = new JCView();
	
	return $viewMgr->_translateTemplate($contents);
}
?>