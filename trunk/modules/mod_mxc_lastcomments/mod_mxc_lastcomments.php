<?php
/**
*
* Module mxc_lastcomments for mXcomment
* www.visualclinic.fr
* Author : Bernard Gilly
* Licence creative commons
* version  1.0.3
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mainframe, $mosConfig_live_site, $mosConfig_absolute_path;

$count 		           = intval( $params->get( 'count', 5 ) );
$show_title_item       = intval( $params->get( 'show_title_item', 1 ) );
$limittexttitle	       = intval( $params->get( 'limittexttitle', 40 ) );
$show_link_on_title	   = intval( $params->get( 'show_link_on_title', 1 ) );
$limittexttitlecomment = intval( $params->get( 'limittexttitlecomment', 40 ) );
$limittextcomment	   = intval( $params->get( 'limittextcomment', 40 ) );
$show_title_comment    = intval( $params->get( 'show_title_comment', 1 ) );
$show_intro_comment    = intval( $params->get( 'show_intro_comment', 1 ) );
$show_author_comment   = intval( $params->get( 'show_author_comment', 1 ) );
$hidebadwords		   = intval( $params->get( 'hidebadwords', 1 ) );
$link_author_cb 	   = intval( $params->get( 'link_author_cb', 0 ) );
$show_date_comment     = intval( $params->get( 'show_date_comment', 1 ) );
$thedateformat         = $params->get( 'thedateformat', '%d/%m/%y %H:%M' );
$label4more            = $params->get( 'label4more', 'More...' );
$label4author          = $params->get( 'label4author', 'By' );
$label4nocomment       = $params->get( 'label4nocomment', 'No comment...' );
$specific_itemid       = intval( $params->get( 'specific_itemid', 0 ) );

if ($limittexttitle==0) $limittexttitle = 40;
if ($limittexttitlecomment==0) $limittexttitlecomment = 40;
if ($limittextcomment==0) $limittextcomment = 40;

// compliance with Joom!fish
if ( file_exists($mosConfig_absolute_path . "/administrator/components/com_joomfish/config.joomfish.php") ) {				
	$clang = "\nAND lang='" . $GLOBALS['iso_client_lang'] . "'";
} else $clang = "";

$query = "SELECT lc.id AS idcomment, lc.contentid, lc.title AS titlecomment, lc.comment AS lastcomment, lc.date AS lastpost, lc.name AS authorcomment, lc.iduser AS userId, c.id AS id, c.title AS title, c.sectionid AS id_section" 
		."\nFROM #__mxc_comments AS lc, #__content AS c"
		."\nWHERE c.id = lc.contentid AND lc.published='1'"
		. $clang
		."\nORDER BY lc.id DESC"
		."\nLIMIT $count"
		;			
$database->setQuery( $query );
$rows = $database->loadObjectList();

if ( $rows ) {
	foreach ($rows as $row) {
	
		if ( !$specific_itemid ) {
		
			if ( $row->id_section ) {
				$bs 	= $mainframe->getBlogSectionCount();
				$bc 	= $mainframe->getBlogCategoryCount();
				$gbs 	= $mainframe->getGlobalBlogSectionCount();
				$_Itemid = $mainframe->getItemid( $row->contentid, 0, 0, $bs, $bc, $gbs );
			} else {
				$query = "SELECT id"
				. "\n FROM #__menu"
				. "\n WHERE type = 'content_typed'"
				. "\n AND componentid = $row->contentid"
				;
				$database->setQuery( $query );	
				$_Itemid = $database->loadResult();				
			}
			// Blank itemid checker for SEF
			if ($_Itemid == NULL) {
				$_Itemid = '';
			} else {
				$_Itemid = '&amp;Itemid='. $_Itemid;
			}
			
		} else $_Itemid = '&amp;Itemid='. $specific_itemid;
	
		$link = sefRelToAbs( 'index.php?option=com_content&amp;task=view&amp;id='. $row->contentid . $_Itemid . "#maxcomment" . $row->idcomment );
		?>
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<?php if ( $show_title_item ) { ?>
              <tr>
                <td>
				<?php if ( $show_link_on_title ) { ?>
					<a href="<?php echo $link; ?>">
				<?php } ?>
				<?php 
				$title = cut_short_last_mxcomment( stripslashes($row->title), $limittexttitle ); 
				echo htmlspecialchars( $title );
				?>
				<?php if ( $show_link_on_title ) { ?>
					</a>
				<?php } ?>
				</td>
              </tr>
			  <?php } ?>
              <tr>
                <td>				
				<?php
				
				// title
				 if ( $show_title_comment && trim( $row->titlecomment )!='') {
				 
					if ( $hidebadwords ){
						$query = "SELECT * FROM #__mxc_badwords WHERE published='1'";
						$database->setQuery( $query );
						$rowsbadwords = $database->loadObjectList();
						if ( $rowsbadwords ) {
							foreach ( $rowsbadwords as $rowbadword ) {
								$badword = trim( $rowbadword->badword );
								$replacebadword = str_repeat( '*', strlen( $badword ) );
								$replacebadword = "\$1".$replacebadword."\$2";
								$row->titlecomment = preg_replace("/(\W|^)$badword(\W|$)/i", $replacebadword, $row->titlecomment);
							}
						}
					}
					$titlecomment = trim( $row->titlecomment );
					$titlecomment = cut_short_last_mxcomment( stripslashes( $titlecomment ), $limittexttitlecomment );	
					echo "<strong>" . htmlspecialchars( stripslashes( $titlecomment ) ) . "</strong><br />";
				 }				 
				 
				 if ( $show_intro_comment ) {
					// Prepare smiley array
					$smiley[':)']     = "sm_smile.gif";    $smiley[':grin']  = "sm_biggrin.gif";
					$smiley[';)']     = "sm_wink.gif";     $smiley['8)']     = "sm_cool.gif";
					$smiley[':p']     = "sm_razz.gif";     $smiley[':roll']  = "sm_rolleyes.gif";
					$smiley[':eek']   = "sm_bigeek.gif";   $smiley[':upset'] = "sm_upset.gif";
					$smiley[':zzz']   = "sm_sleep.gif";    $smiley[':sigh']  = "sm_sigh.gif";
					$smiley[':?']     = "sm_confused.gif"; $smiley[':cry']   = "sm_cry.gif";
					$smiley[':(']     = "sm_mad.gif";      $smiley[':x']     = "sm_dead.gif";
					
					//parser for BBCode					
					$_comment = $row->lastcomment;
					$matchCount = preg_match_all("#\[code\](.*?)\[/code\]#si", $_comment, $matches);
					for ($i = 0; $i < $matchCount; $i++) {
					  $currMatchTextBefore = preg_quote($matches[1][$i]);
					  $currMatchTextAfter = htmlspecialchars($matches[1][$i]);
					  $_comment = preg_replace("#\[code\]$currMatchTextBefore\[/code\]#si", "", $_comment);
					}
					$_comment = preg_replace("#\[quote\](.*?)\[/quote]#si", "", $_comment);
					$_comment = preg_replace("#\[img\](.*?)\[/img\]#si", "", $_comment);
					$_comment = preg_replace("#\[email\](.*?)\[/email\]#si", "\\1", $_comment);
					$_comment = preg_replace("#\[url=(http://)?(.*?)\](.*?)\[/url\]#si", "\\2", $_comment);
					$_comment = preg_replace("#\[u\](.*?)\[/u\]#si", "", $_comment);
					$_comment = preg_replace("#\[b\](.*?)\[/b\]#si", "\\1", $_comment);
					$_comment = preg_replace("#\[i\](.*?)\[/i\]#si", "\\1", $_comment);				
					$_comment = str_replace( "<br>", " ", $_comment);		
					$_comment = str_replace( "<br/>", " ", $_comment);	
					$_comment = str_replace( "<br />", " ", $_comment);					
					$_comment = trim( $_comment );					
					$_comment = cut_short_last_mxcomment( stripslashes( $_comment ), $limittextcomment );	
					
					foreach ($smiley as $i=>$sm) {
					  $_comment = str_replace ("$i", "<img src='$mosConfig_live_site/components/com_maxcomment/images/smilies/$sm' border='0' alt='$i' />", $_comment);
					}
					
					if ( $hidebadwords ){
						if ( $rowsbadwords ) {
							foreach ( $rowsbadwords as $rowbadword ) {
								$badword = trim( $rowbadword->badword );
								$replacebadword = str_repeat( '*', strlen( $badword ) );
								$replacebadword = "\$1".$replacebadword."\$2";
								$_comment = preg_replace("/(\W|^)$badword(\W|$)/i", $replacebadword, $_comment);
							}
						}
					}
					// display comment
					echo $_comment;		
				}	
				?>				 
				</td>
              </tr>
              <tr>
                <td class="small">		
				<?php if ( $show_date_comment ){ 
					echo mosFormatDate( $row->lastpost, $thedateformat );
				 } 
				 ?>
				<a href="<?php echo $link; ?>">
				<?php echo $label4more ; ?></a>
				</td>
              </tr>
			  <?php if ( $show_author_comment ){ ?>
				  <tr>
					<td class="small">
					<?php 
					$author = $row->authorcomment;
					if( $link_author_cb ) {
						// Check if CB component exist
						$pathFileCB = "components/com_comprofiler/comprofiler.php";		
						if ( file_exists( $pathFileCB ) ) {
							$mxcCheckCBcomponent = 1;	
						} else $mxcCheckCBcomponent = 0;	
						
						// Link to CB profile
						if( $mxcCheckCBcomponent && $row->userId ){
							$author = "<a href=\""  
							. sefRelToAbs( 'index.php?option=com_comprofiler&amp;task=userProfile&amp;user=' . $row->userId . mxcCBAuthorItemidLastComment() )
							. "\">"
							. $author
							. "</a>";
						}	
					}	
					echo $label4author . " " . $author ; 
					?>
					</td>
				  </tr>
			  <?php } ?>
            </table>
            <br />
		<?php
	}	
} else echo $label4nocomment;

function cut_short_last_mxcomment ( $string, $max_length ) {
	if (strlen($string) > $max_length) {     
		$string = substr($string, 0, $max_length);     
		$position_space = strrpos($string, " ");    
		$string = substr($string, 0, $position_space);     
		$string = $string . "...";
	}
	return $string;
} 


function mxcCBAuthorItemidLastComment() {
	global $_CBAuthorbot__Cache_ProfileItemid, $database;
	
	if ( !$_CBAuthorbot__Cache_ProfileItemid ) {
		if ( !isset( $_REQUEST['Itemid'] ) ) {
			$database->setQuery( "SELECT id FROM #__menu WHERE link = 'index.php?option=com_comprofiler' AND published=1" );
			$Itemid = (int) $database->loadResult();
		} else {
			$Itemid = (int) $_REQUEST['Itemid'];
		}
		if ( ! $Itemid ) {
			$query = "SELECT id"
			. "\n FROM #__menu"
			. "\n WHERE menutype = 'mainmenu'"
			. "\n AND published = 1"
			. "\n ORDER BY parent, ordering"
			. "\n LIMIT 1"
			;
			$database->setQuery( $query );
			$Itemid = (int) $database->loadResult();
		}
		$_CBAuthorbot__Cache_ProfileItemid = $Itemid;
	}
	if ($_CBAuthorbot__Cache_ProfileItemid) {
		return "&amp;Itemid=" . $_CBAuthorbot__Cache_ProfileItemid;
	} else {
		return null;
	}
}
?>