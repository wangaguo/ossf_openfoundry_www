<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title(   JText::_( 'AC_CONFIGURATION_TITLE' ), 'cpanel' );
JToolBarHelper::save( 'save' );
JToolBarHelper::help( 'screen.alphacontent', true );

// include version
require_once (JPATH_COMPONENT.DS.'assets'.DS.'includes'.DS.'version.php');

// Copyright
$copyStart = 2005; 
$copyNow = date('Y');  
if ($copyStart == $copyNow) { 
	$copySite = $copyStart;
} else {
	$copySite = $copyStart." - ".$copyNow ;
}

?>
<form action="index.php" method="post" name="adminForm">
	<div id="config-document">
		<table class="noshow">
			<tr>
			<td width="50%" valign="top">
			   	<fieldset class="adminform">
				<legend><?php echo JText::_( 'AC_CONFIGURATION_LISTING' ); ?></legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_HOMELISTING' ); ?>::<?php echo JText::_('AC_HOMELISTINGDESC'); ?>">
									<?php echo JText::_( 'AC_HOMELISTING' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_homeresult']; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_ITEMS_ID' ); ?>::<?php echo JTEXT::_('AC_ITEMS_ID_DESC'); ?>">
									<?php echo JText::_( 'AC_ITEMS_ID' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="list_featuredID" id="list_featuredID" class="inputbox" size="20" value="<?php echo $this->alphacontent_configuration->list_featuredID; ?>" />
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_NUMCOLS' ); ?>::<?php echo JText::_('AC_NUMCOLSDESC'); ?>">
									<?php echo JText::_( 'AC_NUMCOLS' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_numcols']; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_INTROSTYLE' ); ?>::<?php echo JText::_('AC_INTROSTYLE'); ?>">
									<?php echo JText::_( 'AC_INTROSTYLE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_introstyle']; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_LIMITNUMCHARSINTRO' ); ?>::<?php echo JTEXT::_('AC_LIMITNUMCHARSINTRODESC'); ?>">
									<?php echo JText::_( 'AC_LIMITNUMCHARSINTRO' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="list_numcharsintro" id="list_numcharsintro" class="inputbox" size="5" value="<?php echo $this->alphacontent_configuration->list_numcharsintro; ?>" />
							</td>
						</tr>						
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_TITLELINKABLE' ); ?>::<?php echo JText::_('AC_TITLELINKABLE'); ?>">
									<?php echo JText::_( 'AC_TITLELINKABLE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_titlelinkable']	; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_NUMINDEX' ); ?>::<?php echo JTEXT::_('AC_NUMINDEXDESC'); ?>">
									<?php echo JText::_( 'AC_NUMINDEX' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_numindex'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_ICONNEW' ); ?>::<?php echo JTEXT::_('AC_ICONNEW'); ?>">
									<?php echo JText::_( 'AC_ICONNEW' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_iconnew'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_NUMDAYS' ); ?>::<?php echo JTEXT::_('AC_NUMDAYSDESC'); ?>">
									<?php echo JText::_( 'AC_NUMDAYS' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="list_numdaynew" id="list_numdaynew" class="inputbox" size="5" value="<?php echo $this->alphacontent_configuration->list_numdaynew; ?>" />
							</td>
						</tr>						
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_ICONHOT' ); ?>::<?php echo JTEXT::_('AC_ICONHOT'); ?>">
									<?php echo JText::_( 'AC_ICONHOT' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_iconhot'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_NUMHITS' ); ?>::<?php echo JTEXT::_('AC_NUMHITSDESC'); ?>">
									<?php echo JText::_( 'AC_NUMHITS' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="list_numhitshot" id="list_numhitshot" class="inputbox" size="5" value="<?php echo $this->alphacontent_configuration->list_numhitshot; ?>" />
							</td>
						</tr>					
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_DATEARTICLE' ); ?>::<?php echo JTEXT::_('AC_DATEARTICLE'); ?>">
									<?php echo JText::_( 'AC_DATEARTICLE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showdate'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_FORMATDATE' ); ?>::<?php echo JTEXT::_('AC_FORMATDATE'); ?>">
									<?php echo JText::_( 'AC_FORMATDATE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_formatdate'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_AUTHOR' ); ?>::<?php echo JTEXT::_('AC_AUTHOR'); ?>">
									<?php echo JText::_( 'AC_AUTHOR' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showauthor'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_SECTIONCATEGORY' ); ?>::<?php echo JTEXT::_('AC_SECTIONCATEGORY'); ?>">
									<?php echo JText::_( 'AC_SECTIONCATEGORY' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showsectioncategory'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_HITS' ); ?>::<?php echo JTEXT::_('AC_HITS'); ?>">
									<?php echo JText::_( 'AC_HITS' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showhits']; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_NUMCOMMENT' ); ?>::<?php echo JTEXT::_('AC_NUMCOMMENT'); ?>">
									<?php echo JText::_( 'AC_NUMCOMMENT' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_shownumcomments'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_COMMENTSYSTEM' ); ?>::<?php echo JTEXT::_('AC_COMMENTSYSTEMDESC'); ?>">
									<?php echo JText::_( 'AC_COMMENTSYSTEM' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_commentsystem'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_PRINT' ); ?>::<?php echo JTEXT::_('AC_PRINT'); ?>">
									<?php echo JText::_( 'AC_PRINT' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showprint'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_PDF' ); ?>::<?php echo JTEXT::_('AC_PDF'); ?>">
									<?php echo JText::_( 'AC_PDF' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showpdf'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_EMAIL' ); ?>::<?php echo JTEXT::_('AC_EMAIL'); ?>">
									<?php echo JText::_( 'AC_EMAIL' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showemail'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_READMORE' ); ?>::<?php echo JTEXT::_('AC_READMORE'); ?>">
									<?php echo JText::_( 'AC_READMORE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showreadmore'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_LINKMAP' ); ?>::<?php echo JTEXT::_('AC_LINKMAPDESC'); ?>">
									<?php echo JText::_( 'AC_LINKMAP' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showlinkmap'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_NUMBERPAGETOTAL' ); ?>::<?php echo JTEXT::_('AC_NUMBERPAGETOTAL'); ?>">
									<?php echo JText::_( 'AC_NUMBERPAGETOTAL' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_shownumberpagetotal'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_RESULTPERPAGE' ); ?>::<?php echo JTEXT::_('AC_RESULTPERPAGE'); ?>">
									<?php echo JText::_( 'AC_RESULTPERPAGE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_resultperpage'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_SEARCHBOX' ); ?>::<?php echo JTEXT::_('AC_SEARCHBOX'); ?>">
									<?php echo JText::_( 'AC_SEARCHBOX' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showsearchbox'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_SEARCHBOXBUTTON' ); ?>::<?php echo JTEXT::_('AC_SEARCHBOXBUTTON'); ?>">
									<?php echo JText::_( 'AC_SEARCHBOXBUTTON' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showsearchboxbutton'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_ORDERINGLIST' ); ?>::<?php echo JTEXT::_('AC_ORDERINGLIST'); ?>">
									<?php echo JText::_( 'AC_ORDERINGLIST' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showorderinglist'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_DEFAULTORDERING' ); ?>::<?php echo JTEXT::_('AC_DEFAULTORDERING'); ?>">
									<?php echo JText::_( 'AC_DEFAULTORDERING' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_defaultordering'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_SHOWIMAGE' ); ?>::<?php echo JTEXT::_('AC_SHOWIMAGE'); ?>">
									<?php echo JText::_( 'AC_SHOWIMAGE' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_showimage'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_IMAGEPOSITION' ); ?>::<?php echo JTEXT::_('AC_IMAGEPOSITION'); ?>">
									<?php echo JText::_( 'AC_IMAGEPOSITION' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['list_imageposition'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_WIDTHIMAGE' ); ?>::<?php echo JTEXT::_('AC_WIDTHIMAGE'); ?>">
									<?php echo JText::_( 'AC_WIDTHIMAGE' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="list_widthimage" id="list_widthimage" class="inputbox" size="20" value="<?php echo $this->alphacontent_configuration->list_widthimage; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
				</fieldset>
			</td>
			<td width="50%" valign="top">
			   	<fieldset class="adminform">
				<legend><?php echo JText::_( 'AC_GOOGLEMAPSLOCATION' ); ?></legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_APIKEY' ); ?>::<?php echo JTEXT::_('AC_APIKEYGOOGLEMAPS'); ?>">
									<?php echo JText::_( 'AC_APIKEY' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="apikeygooglemap" id="apikeygooglemap" class="inputbox" size="50" value="<?php echo $this->alphacontent_configuration->apikeygooglemap; ?>" />
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_ZOOMLEVEL' ); ?>::<?php echo JTEXT::_('AC_ZOOMLEVEL'); ?>">
									<?php echo JText::_( 'AC_ZOOMLEVEL' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="zoomlevel" id="zoomlevel" class="inputbox" size="10" value="<?php echo $this->alphacontent_configuration->zoomlevel; ?>" />
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_WIDTHMAP' ); ?>::<?php echo JTEXT::_('AC_WIDTHMAP'); ?>">
									<?php echo JText::_( 'AC_WIDTHMAP' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="widthgooglemap" id="widthgooglemap" class="inputbox" size="10" value="<?php echo $this->alphacontent_configuration->widthgooglemap; ?>" />
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_HEIGHTMAP' ); ?>::<?php echo JTEXT::_('AC_HEIGHTMAP'); ?>">
									<?php echo JText::_( 'AC_HEIGHTMAP' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="heightgooglemap" id="heightgooglemap" class="inputbox" size="10" value="<?php echo $this->alphacontent_configuration->heightgooglemap; ?>" />
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_MAPTYPEMENU' ); ?>::<?php echo JTEXT::_('AC_MAPTYPEMENUDESC'); ?>">
									<?php echo JText::_( 'AC_MAPTYPEMENU' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['showmaptypemenu'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_MAPCONTROLSMENU' ); ?>::<?php echo JTEXT::_('AC_MAPCONTROLSMENUDESC'); ?>">
									<?php echo JText::_( 'AC_MAPCONTROLSMENU' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['showmapcontrolsmenu'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="">
									&nbsp;
								</span>
							</td>
							<td>
								<?php echo JText::_( 'AC_SEEHELPFORTAGUSAGE' ); ?>
							</td>
						</tr>
					</tbody>
				</table>
				</fieldset>
			   	<fieldset class="adminform">
				<legend><?php echo JText::_( 'AC_AJAXSYSTEMRATING' ); ?></legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_USESYSTEMRATING' ); ?>::<?php echo JText::_('AC_USESYSTEMRATINGDESC'); ?>">
									<?php echo JText::_( 'AC_USESYSTEMRATING' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['activeglobalsystemrating']; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_STARS' ); ?>::<?php echo JTEXT::_('AC_NUMSTARSDESC'); ?>">
									<?php echo JText::_( 'AC_STARS' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['numstars'] ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_WIDTH' ); ?>::<?php echo JTEXT::_('AC_WIDTHSTAR'); ?>">
									<?php echo JText::_( 'AC_WIDTH' ); ?>
								</span>
							</td>
							<td>
								<input type="text" name="widthstars" id="widthstars" class="inputbox" size="10" value="<?php echo $this->alphacontent_configuration->widthstars; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
				</fieldset>
			   	<fieldset class="adminform">
				<legend><?php echo JText::_( 'AC_SHARETHISWIDGET' ); ?></legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td colspan="2"><?php echo JText::_( 'AC_SHARETHISWIDGETDESC' ); ?></td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_USESHARETHISWIDGET' ); ?>::<?php echo JText::_('AC_USESHARETHISWIDGET'); ?>">
									<?php echo JText::_( 'AC_USESHARETHISWIDGET' ); ?>
								</span>
							</td>
							<td>
								<?php echo $this->lists['showsharethis']; ?>
							</td>
						</tr>
						<tr>
							<td width="280" class="key">
								<span class="editlinktip hasTip" title="<?php echo JText::_( 'AC_SHARETHISWIDGETCODE' ); ?>::<?php echo JTEXT::_('AC_SHARETHISPASTEYOURWIDGETCODE'); ?>">
									<?php echo JText::_( 'AC_SHARETHISWIDGETCODE' ); ?>
								</span>
							</td>
							<td>
                              <textarea name="sharethiscode" cols="50" rows="5" class="inputbox" id="sharethiscode"><?php echo htmlspecialchars($this->alphacontent_configuration->sharethiscode); ?></textarea>
							</td>
						</tr>
					</tbody>
				</table>
				</fieldset>
			   	<fieldset class="adminform">
				<legend><?php echo JText::_( 'AC_VERSION' ); ?></legend>
				<div style="float:left;"><img src="components/com_alphacontent/assets/images/alphacontent.jpg"></div><div style="padding-top:38px;text-indent:20px;"><h2><?php echo _ALPHACONTENT_NUM_VERSION; ?></h2></div>
				</fieldset>
			    <div align="center">AlphaContent &copy; <?php echo $copySite ; ?> - Bernard Gilly - <a href="http://www.alphaplug.com" target="_blank">www.alphaplug.com</a> - All Rights Reserved </div></td>
			</tr>
		</table>
	</div>
	<input type="hidden" name="option" value="com_alphacontent" />
	<input type="hidden" name="task" value="save" />
</form>
<div>AlphaContent is Free Software released under <a href="http://en.wikipedia.org/wiki/Donationware">Donationware</a> License</a>.
		    <b><br />
  Ever thought about giving something back?</b><br>
	Please make a donation if you find AlphaContent useful and want to support its continued development.
	Your donations help by  hardware, hosting services and other expenses that come up as we develop, protect and promote AlphaContent and other free components.		  
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="donation">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="image" src="<?php echo JURI::base(true).'/components/com_alphacontent/assets/images/Paypal_DonateButton.gif'; ?>" name="submit" alt="PayPal - The safer, easier way to pay online!" style="border:0"/>
<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
</form>
</div>