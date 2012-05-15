<?php
// --------------------------------------------------------------------------------
// Letterman Newsletter Component
//
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html
// --------------------------------------------------------------------------------
// $Id: contentRenderer.class.php,v 1.6 2006/06/29 18:34:43 soeren Exp $

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Loads the bot file
 * @param string The folder (group)
 * @param string The elements (name of file without extension)
 * @param int Published state
 * @param string The params for the bot
 */

//More Newsletter Menu

function CalTitle( &$row, &$params, &$access ) {
    global $mosConfig_live_site, $Itemid;

    if ( $params->get( 'item_title' ) ) {
            ?>
            <td class="contentheading<?php echo $params->get( 'pageclass_sfx' ); ?>" width="100%" height="26" valign     ="middle" style="font-size: 12px;font-weight:bold;vertical-align:bottom;color: #0055C5;">
						<span style="font-size: 18pt; color: #000000;">&nbsp;■&nbsp;</span><a href="#<?php echo $row->id ; ?>" class="contentpagetitle<?php echo $params->get( 'pageclass_sfx' ); ?>">[<?php echo $row->category; ?>]&nbsp;&nbsp;<?php echo $row->title;?></a>
            </td>
            <?php
    } else {
        ?>
        <td class="contentheading<?php echo $params->get( 'pageclass_sfx' ); ?>" width="100%">
        </td>
        <?php
    }
}
 
function lm_loadBot( $folder, $element, $published, $params='' ) {
	global $mosConfig_absolute_path;
	global $_MAMBOTS;

	$path = $mosConfig_absolute_path . '/plugins/' . $folder . '/' . $element . '.php';
	echo $path;
	if (file_exists( $path )) {
		$_MAMBOTS->_loading = count( $_MAMBOTS->_bots );
		$bot = new stdClass;
		$bot->folder 	= $folder;
		$bot->element 	= $element;
		$bot->published = $published;
		$bot->lookup 	= $folder . '/' . $element;
		$bot->params 	= $params;
		$_MAMBOTS->_bots[] 	= $bot;

		require_once( $path );

		$_MAMBOTS->_loading = null;
	}
}

global $database, $_MAMBOTS, $my;

// Load the content mambots into $_MAMBOTS
$botgroup = 'content';
// But not ALL!
// Here is a list of all content mambots,
// which will be loaded by Letterman
$loadBots = array( 'mosimage', 
					'mosproductsnap', 
					'legacybots', 
					'moscode', // add a mambot
					'geshi', // when you think it's missing
					'mosloadposition');
$gid = $my->gid;

$query = "SELECT folder, element, published, params"
. "\n FROM #__plugins"
. "\n WHERE access <= $gid"
. "\n AND folder = '$botgroup'"
. "\n ORDER BY ordering";
$database->setQuery( $query );
$contentbots = $database->loadObjectList();

// we need functions from the class HTML_content!
//require_once( $mosConfig_absolute_path.'/components/com_content/content.html.php');


/**
 * This class allows you to render content items 
 * just like Mambo and Joomla do on the frontpage
 * formerly a mambot for YaNC (render_content)
 * @author soeren
 * @author Tim v. Dongen
 * @copyright Soeren, Tim_Online
 * @since Letterman 1.2.1
 */
class lm_contentRenderer {
	/**
	 * This is the main function to render the content from an ID to HTML
	 *
	 * @param unknown_type $nl_content
	 * @return unknown
	 */
	function getContent( $nl_content) {
		global $mosConfig_absolute_path, $lm_params;
		/**
		 * usage: [CONTENT id=""]
		*/
		if( get_magic_quotes_gpc() ) {
			$nl_content = stripslashes( $nl_content );
			
		}
		$regex = '#\[CONTENT id="(.*?)"\]#s';

		/**
			�ؿ���HTML by ally 2007/0612

		**/

		$content['html_message'] = '<table width="100%" border="0" cellpadding="0" cellspacing="0" name="catalogue" bgcolor="#EAEAEA">'
	        .'<tr>' 
        	.' <td height="28" colspan="2" valign="top" background="http://www.openfoundry.org/images/newsletter/cal-bg.gif"><a name="TOP"></a><img src="http://www.openfoundry.org/images/newsletter/catl.gif" width="179" height="28" border="0"></td>'
       		.'</tr>'
	        .'<tr>' 
          	.'  <td height="8">&nbsp;</td>'
       		.'</tr>';
		$content['html_message'] .= preg_replace_callback( $regex, 'lm_replaceTitleHtml', nl2br($nl_content) );
		$content['html_message'] .= '<tr><td height="8">&nbsp;</td></tr></table><br>';

		/** end **/ 
	
		$content['html_message'] .= preg_replace_callback( $regex, 'lm_replaceContentHtml', nl2br($nl_content) );
		
		$content['message'] =  $nl_content ;

		/**
		 * usage: [ATTACHMENT filename="{the letterman attachment_dir}/path/to/file"]
		*/
		if( !empty( $_POST['nl_attachments'])) {
			foreach( $_POST['nl_attachments'] as $file) {
				$att = '[ATTACHMENT filename="'.$lm_params->get('attachment_dir','/media').'/'.$file.'"]';
				$content['message'] .= $att;
			}
		}
		return $content;

	}
	function retrieveContent( $id ) {
		global $database, $mainframe;
		
		$query = "SELECT a.*, ROUND(v.rating_sum/v.rating_count) AS rating, v.rating_count, u.name AS author, u.usertype, cc.title AS category, s.name AS section, g.name AS groups, s.published AS sec_pub, cc.published AS cat_pub"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = 'content'"
		. "\n LEFT JOIN #__users AS u ON u.id = a.created_by"
		. "\n LEFT JOIN #__content_rating AS v ON a.id = v.content_id"
		. "\n LEFT JOIN #__groups AS g ON a.access = g.id"
		. "\n WHERE a.id = $id";
		$database->setQuery( $query );
		$row = NULL;
		$database->loadObject($row);
		if( $row ) {
			$params = new mosParameters( $row->attribs );
			
			$params->def( 'link_titles', 	$mainframe->getCfg( 'link_titles' ) );
			$params->def( 'author', 		!$mainframe->getCfg( 'hideAuthor' ) );
			$params->def( 'createdate', 	!$mainframe->getCfg( 'hideCreateDate' ) );
			$params->def( 'modifydate', 	!$mainframe->getCfg( 'hideModifyDate' ) );
			$params->def( 'print', 			!$mainframe->getCfg( 'hidePrint' ) );
			$params->def( 'pdf', 			!$mainframe->getCfg( 'hidePdf' ) );
			$params->def( 'email', 			!$mainframe->getCfg( 'hideEmail' ) );
			$params->def( 'rating', 		$mainframe->getCfg( 'vote' ) );
			$params->def( 'icons', 			$mainframe->getCfg( 'icons' ) );
			$params->def( 'readmore', 		$mainframe->getCfg( 'readmore' ) );
			$params->def( 'item_title', 	1 );
			
			$params->set( 'intro_only', 	1 );
			$params->set( 'item_navigation', 0 );
			$params->def( 'back_button', 	0 );
			$params->def( 'image', 			1 );
			$row->params = $params;
			$row->text = $row->introtext;
		}
		
		return $row;
	}
}

function lm_replaceContentHtml(&$matches){
	global $mosConfig_live_site, $database, $_MAMBOTS, $my, $mainframe, $acl, $_VERSION;

	$getlive_site	=	$mainframe->getCfg('live_site');
	
	$id = intval($matches[1]);

	if($id != 0){
		
		// Editor usertype check
		$access = new stdClass();
		$access->canEdit = $access->canEditOwn = $access->canPublish = 0;
		$row = lm_contentRenderer::retrieveContent( $id );
		if ( $row ) {
			$params = $row->params;
			$_Itemid = $mainframe->getItemid( $row->id, $typed=1, $link=1, $bs=1, $bc=1, $gbs=1 );
			
			$_MAMBOTS->trigger( 'onPrepareContent', array( &$row, &$params, 0 ), true );
			
			$intro_text = $row->text;
			//$intro_text = lm_replaceMosImage($row);
			//$intro_text = lm_replacePageBreak($intro_text);

			if ( intval( $row->created ) != 0 ) {
				$create_date = mosFormatDate( $row->created );
			}

			$content .= '<table class="contentpaneopen'. $params->get( 'pageclass_sfx' ) .'">';
			ob_start();

		
			if ($id > 1028 || $id < 1000 ) {
			//Add Article Category
  				echo '<tr>';
  				echo '<td width="116" height="29" valign="middle" background="http://www.openfoundry.org/images/newsletter/kind.gif">';
  				echo '<span style="color: #fd6003; font-size: medium;"><strong>';
  				echo $row->category;
				echo '</strong></span></td><td width="482" background="http://www.openfoundry.org/images/newsletter/kind-bg.gif"></td></tr>';
  				echo '<tr><td colspan="2" align="left" valign="middle" style="font-weight: bold; font-size: 22px; vertical-align: bottom; color: rgb(0, 85, 197);"><a name="'.$row->id.'"></a>';
  				echo $row->title;
  				echo '</td></tr>';
  				echo '<tr><td colspan="2" align="left" style="font-weight: bold; font-size: 12px; color: rgb(153, 153, 153);">';
  				echo _WRITTEN_BY.'&nbsp;&nbsp;'.( $row->created_by_alias ? $row->created_by_alias : $row->author );
  				echo '</td></tr>';

			}

			$content .= ob_get_contents();
			ob_end_clean();

			if ($id > 1028 || $id < 1000 ) {	
			$content .= '<tr>'
			. '  <td colspan="2" align="left" style="font-size:15px;color:#444;line-height:200%;">' .( function_exists('ampReplace') ? ampReplace( $intro_text ) : $intro_text ). '</td>'
			. '</tr>'
			. '<tr>'
			. '<td align="left" colspan="2">'
			. '<a href="'. $getlive_site
			. '/index.php?option=com_content&amp;task=view&amp;id='.$row->id
			. '&amp;Itemid=4;isletter=1 ' . '" style="font-size:15px;color:#FD6003;"">'.	
			_READ_MORE
			. '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
      //. '<a href="'. $getlive_site
			//. '/index.php?option=com_content&amp;task=view&amp;id='.$row->id
			//. '&amp;Itemid=4;isletter=1#addcomments' 
			//. '" style="font-size:15px;color:#FD6003;"">'.
      //      		_ADD_COMMENT
      //. '</a>'
			. '</td>'
			. '</tr>'
			. '<tr>'
			. ' <td align="right" colspan="2" ><a href="#TOP">'
			. '<font size="15px" color="#FD6003"><b>'
			._BACK_TOP
			.'</b></font>' 
			. '</a></td>'
			. ' </tr>'
			. ' </table></br>';
			} else {

			$content .= '</br><tr>'
			. '  <td>' .( function_exists('ampReplace') ? ampReplace( $intro_text ) : $intro_text ). '</td>'
			. '</tr>'
			. '<tr>'
			. '		<td align="left" colspan="2">'
			. '		</td>'
			. '	</tr>'
			. ' </table>';
			}
			
			return $content;
		}
	}
	else {
		return 'error retrieving Content ID: '.$id.'<br/>';
	}
}
/** �ؿ� by ally 2007/06/12 **/
function lm_replaceTitleHtml(&$matches){
	global $mosConfig_live_site, $database, $_MAMBOTS, $my, $mainframe, $acl, $_VERSION;

	$id = intval($matches[1]);
	if($id != 0){

		// Editor usertype check
		$access = new stdClass();
		$access->canEdit = $access->canEditOwn = $access->canPublish = 0;
		
		$row = lm_contentRenderer::retrieveContent( $id );
		if ( $row ) {
			$params = $row->params;
			$_Itemid = $mainframe->getItemid( $row->id, $typed=1, $link=1, $bs=1, $bc=1, $gbs=1 );
			
			$_MAMBOTS->trigger( 'onPrepareContent', array( &$row, &$params, 0 ), true );
			
			$intro_text = $row->text;
			//$intro_text = lm_replaceMosImage($row);
			//$intro_text = lm_replacePageBreak($intro_text);

			if ( intval( $row->created ) != 0 ) {
				$create_date = mosFormatDate( $row->created );
			}

			
			if ($id > 1028 || $id < 1000 ) {
			$content = '<tr>';
			ob_start();
			// displays Item Title
			// Damn it! Open the content API and make it more flexible...
			if( @$_VERSION->DEV_LEVEL >= 9 ) {
				$tmp = '';
				CalTitle( $row, $params,  $access );
			}
			$content .= ob_get_contents();
			ob_end_clean();
			$content .= '</tr>';
			}
			
			return $content;
		}
	}
	else {
		return 'error retrieving Content ID: '.$id.'<br/>';
	}
}

function lm_replaceMosImage($row, $empty = false) {
	global $mosConfig_absolute_path, $mosConfig_live_site;

	if ($row->images && !$empty) {
		$introtext = $row->introtext;
		$aImages = explode("\n", trim($row->images));

		foreach($aImages as $img) {
			$temp = explode( '|', trim( $img ) );
			if ( !isset($temp[1]) || !$temp[1] ) {
				$temp[1] = '';
			}
			if ( !isset($temp[2]) || !$temp[2] ) {
				$temp[2] = 'Image';
			} else {
				$temp[2] = htmlspecialchars( $temp[2] );
			}
			if ( !isset($temp[3]) || !$temp[3] ) {
				$temp[3] = '0';
			}
			$size = '';

			$source = '/images/stories/'. $temp[0];
			// assemble the image tag
			if (function_exists( 'getimagesize' )) {
				$size = @getimagesize( $mosConfig_absolute_path . $source );
				if (is_array( $size )) {
					$size = ' width="'. $size[0] .'" height="'.
					$size[1] .'"';
				}
			}

			$path = $mosConfig_live_site . $source;

			$img = '<img src="'. $path .'"'. $size;
			$img .= ( $temp[1] ? ' align="'. $temp[1] .'" ' : "" );
			$img .='  hspace="6" alt="'. $temp[2] .'"title="'. $temp[2] .'" border="'. $temp[3] .'" />';

			$introtext = preg_replace('/{mosimage}/', $img, $introtext, 1); // first match only
		}
		return $introtext;
	} else {
		$introtext = preg_replace('/{mosimage}/', "", $row->introtext); // all matches
		return $introtext;
	}
}

function lm_replacePageBreak($introtext)
{
	return preg_replace('/{mospagebreak}/', '', $introtext);
}


function lm_unHTMLSpecialCharsAll($text) {
	//	return str_replace(array("&amp;","&quot;","&#039;","&lt;","&gt;","&nbsp;"), array("&","\"","'","<",">"," "), $text);
	return lm_deHTMLEntities($text);
}
/**
 * convert html special entities to literal characters
 */
function lm_deHTMLEntities($text) {
	$search = array(
	"'&(quot|#34);'i",
	"'&(amp|#38);'i",
	"'&(lt|#60);'i",
	"'&(gt|#62);'i",
	"'&(nbsp|#160);'i",   "'&(iexcl|#161);'i",  "'&(cent|#162);'i",   "'&(pound|#163);'i",  "'&(curren|#164);'i",
	"'&(yen|#165);'i",    "'&(brvbar|#166);'i", "'&(sect|#167);'i",   "'&(uml|#168);'i",    "'&(copy|#169);'i",
	"'&(ordf|#170);'i",   "'&(laquo|#171);'i",  "'&(not|#172);'i",    "'&(shy|#173);'i",    "'&(reg|#174);'i",
	"'&(macr|#175);'i",   "'&(neg|#176);'i",    "'&(plusmn|#177);'i", "'&(sup2|#178);'i",   "'&(sup3|#179);'i",
	"'&(acute|#180);'i",  "'&(micro|#181);'i",  "'&(para|#182);'i",   "'&(middot|#183);'i", "'&(cedil|#184);'i",
	"'&(supl|#185);'i",   "'&(ordm|#186);'i",   "'&(raquo|#187);'i",  "'&(frac14|#188);'i", "'&(frac12|#189);'i",
	"'&(frac34|#190);'i", "'&(iquest|#191);'i", "'&(Agrave|#192);'",  "'&(Aacute|#193);'",  "'&(Acirc|#194);'",
	"'&(Atilde|#195);'",  "'&(Auml|#196);'",    "'&(Aring|#197);'",   "'&(AElig|#198);'",   "'&(Ccedil|#199);'",
	"'&(Egrave|#200);'",  "'&(Eacute|#201);'",  "'&(Ecirc|#202);'",   "'&(Euml|#203);'",    "'&(Igrave|#204);'",
	"'&(Iacute|#205);'",  "'&(Icirc|#206);'",   "'&(Iuml|#207);'",    "'&(ETH|#208);'",     "'&(Ntilde|#209);'",
	"'&(Ograve|#210);'",  "'&(Oacute|#211);'",  "'&(Ocirc|#212);'",   "'&(Otilde|#213);'",  "'&(Ouml|#214);'",
	"'&(times|#215);'i",  "'&(Oslash|#216);'",  "'&(Ugrave|#217);'",  "'&(Uacute|#218);'",  "'&(Ucirc|#219);'",
	"'&(Uuml|#220);'",    "'&(Yacute|#221);'",  "'&(THORN|#222);'",   "'&(szlig|#223);'",   "'&(agrave|#224);'",
	"'&(aacute|#225);'",  "'&(acirc|#226);'",   "'&(atilde|#227);'",  "'&(auml|#228);'",    "'&(aring|#229);'",
	"'&(aelig|#230);'",   "'&(ccedil|#231);'",  "'&(egrave|#232);'",  "'&(eacute|#233);'",  "'&(ecirc|#234);'",
	"'&(euml|#235);'",    "'&(igrave|#236);'",  "'&(iacute|#237);'",  "'&(icirc|#238);'",   "'&(iuml|#239);'",
	"'&(eth|#240);'",     "'&(ntilde|#241);'",  "'&(ograve|#242);'",  "'&(oacute|#243);'",  "'&(ocirc|#244);'",
	"'&(otilde|#245);'",  "'&(ouml|#246);'",    "'&(divide|#247);'i", "'&(oslash|#248);'",  "'&(ugrave|#249);'",
	"'&(uacute|#250);'",  "'&(ucirc|#251);'",   "'&(uuml|#252);'",    "'&(yacute|#253);'",  "'&(thorn|#254);'",
	"'&(yuml|#255);'");
	$replace = array(
	"\"",
	"&",
	"<",
	">",
	" ",      chr(161), chr(162), chr(163), chr(164), chr(165), chr(166), chr(167), chr(168), chr(169),
	chr(170), chr(171), chr(172), chr(173), chr(174), chr(175), chr(176), chr(177), chr(178), chr(179),
	chr(180), chr(181), chr(182), chr(183), chr(184), chr(185), chr(186), chr(187), chr(188), chr(189),
	chr(190), chr(191), chr(192), chr(193), chr(194), chr(195), chr(196), chr(197), chr(198), chr(199),
	chr(200), chr(201), chr(202), chr(203), chr(204), chr(205), chr(206), chr(207), chr(208), chr(209),
	chr(210), chr(211), chr(212), chr(213), chr(214), chr(215), chr(216), chr(217), chr(218), chr(219),
	chr(220), chr(221), chr(222), chr(223), chr(224), chr(225), chr(226), chr(227), chr(228), chr(229),
	chr(230), chr(231), chr(232), chr(233), chr(234), chr(235), chr(236), chr(237), chr(238), chr(239),
	chr(240), chr(241), chr(242), chr(243), chr(244), chr(245), chr(246), chr(247), chr(248), chr(249),
	chr(250), chr(251), chr(252), chr(253), chr(254), chr(255));
	return $text = preg_replace($search, $replace, $text);
}

?>
