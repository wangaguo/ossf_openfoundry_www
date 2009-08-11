<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
require( YOURBASEPATH.DS."styles.php");
require( YOURBASEPATH.DS."rt_styleswitcher.php");
JHTML::_( 'behavior.mootools' );
global $template_real_width, $leftcolumn_width, $rightcolumn_width, $tstyle;
global $js_compatibility, $menu_rows_per_column, $menu_columns, $menu_multicollevel;
global $header_style, $body_style, $showcase_style, $primary_style, $footer_style;

$live_site        		= $mainframe->getCfg('live_site');
$template_path 			= $this->baseurl . '/templates/' .  $this->template;

$preset_style 			= $this->params->get("presetStyle", "style1");
$header_style 			= $this->params->get("headerStyle", "dark");
$body_style 			= $this->params->get("bodyStyle", "light");
$showcase_style 		= $this->params->get("showcaseStyle", "light");
$primary_style 			= $this->params->get("primaryStyle", "yellow");
$footer_style           = $this->params->get("footerStyle", "dark");

$frontpage_component    = $this->params->get("enableFrontpage", "show");
$enable_ie6warn         = ($this->params->get("enableIe6warn", 0)  == 0)?"false":"true";
$font_family            = $this->params->get("fontFamily", "nexus");
$enable_fontspans       = ($this->params->get("enableFontspans", 1)  == 0)?"false":"true";
$enable_inputstyle		= ($this->params->get("enableInputstyle", 1) == 0)?"false":"true";
$inputs_exclusion		= $this->params->get("inputsExclusion", "'.content_vote'");

$template_width 		= $this->params->get("templateWidth", "982");
$leftcolumn_width		= $this->params->get("leftcolumnWidth", "260");
$rightcolumn_width		= $this->params->get("rightcolumnWidth", "260");
$leftinset_width		= $this->params->get("leftinsetWidth", "180");
$rightinset_width		= $this->params->get("rightinsetWidth", "180");
$splitmenu_col			= $this->params->get("splitmenuCol", "rightcol");
$menu_name 				= $this->params->get("menuName", "mainmenu");
$menu_type 				= $this->params->get("menuType", "fusion");
$default_font 			= $this->params->get("defaultFont", "default");
$show_logo		 		= ($this->params->get("showLogo", 1)  == 0)?"false":"true";
$show_textsizer			= ($this->params->get("showTextsizer", 1)  == 0)?"false":"true";
$show_date		 		= ($this->params->get("showDate", 0)  == 0)?"false":"true";
$clientside_date		= ($this->params->get("clientSideDate", 0) == 0)?"false":"true";
$show_topbutton 		= ($this->params->get("showTopbutton", 1)  == 0)?"false":"true";
$show_copyright 		= ($this->params->get("showCopyright", 1)  == 0)?"false":"true";
$copyright_text			= $this->params->get("copyrightText", "Copyright 2009, All Rights Reserved");
$js_compatibility	 	= ($this->params->get("jsCompatibility", 0)  == 0)?"false":"true";

// fusion menu
$f_enablejs             = ($this->params->get('roknavmenu_fusion_enable_js', 1) == 0)?"false":"true";
$f_subsoffset_top       = $this->params->get('roknavmenu_fusion_subsoffset_top', '0');
$f_subsoffset_left      = $this->params->get('roknavmenu_fusion_subsoffset_left', '0');
$f_negativeoffset_top       = $this->params->get('roknavmenu_fusion_negativeoffset_top', '0');
$f_negativeoffset_left      = $this->params->get('roknavmenu_fusion_negativeoffset_left', '0');
$f_vertical_animation   = $this->params->get('roknavmenu_fusion_vertical_animation','Quad.easeOut');
$f_vertical_duration    = $this->params->get('roknavmenu_fusion_vertical_duration','400');
$f_horizontal_animation = $this->params->get('roknavmenu_fusion_horizontal_animation','Quad.easeOut');
$f_horizontal_duration  = $this->params->get('roknavmenu_fusion_horizontal_duration','400');
$f_enable_current       = ($this->params->get('roknavmenu_fusion_enable_current_id', 0) == 0)?"false":"true";

// splitmenu
$sm_enable_current       = ($this->params->get('roknavmenu_splitmenu_enable_current_id', 0) == 0)?"false":"true";

								
require(YOURBASEPATH . "/rt_styleloader.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
	<head>
		<jdoc:include type="head" />
		<?php
		require(YOURBASEPATH . DS . "rt_utils.php");
		require(YOURBASEPATH . DS . "rt_head_includes.php");
	?>
	</head>
	<body id="ff-<?php echo $fontfamily; ?>" class="<?php echo $fontstyle; ?> <?php echo $tstyle; ?> head-<?php echo $header_style; ?> show-<?php echo $showcase_style; ?> foot-<?php echo $footer_style; ?> body-<?php echo $body_style; ?> <?php echo $pageclass; ?> iehandle">
	<!--Begin Top Bar-->
	<?php if ($show_textsizer=="true" or $this->countModules('top-left or top-right or search')) : ?>
	<div id="top-bar">
		<div class="wrapper">
			<div class="padding">
				<!--Begin Top Left Tools-->
				<?php if ($this->countModules('top-left')) : ?>
				<div id="topleft-mod"><jdoc:include type="modules" name="top-left" style="xhtml" /></div>
				<?php elseif ($show_date == "true"): ?>
				<div class="date-block">
				    <?php $now = &JFactory::getDate(); ?>
					<span class="date1"><?php echo $now->toFormat('%A'); ?></span>
					<span class="date2"><?php echo $now->toFormat('%B'); ?></span>
					<span class="date3"><?php echo $now->toFormat('%d'); ?> ,</span>
					<span class="date4"><?php echo $now->toFormat('%Y'); ?></span>
				</div>
				<?php endif; ?>
				<!--End Top Left Tools-->
				<!--Begin Top Right Tools-->
				<?php if ($this->countModules('top-right')) : ?>
				<div id="topright-mod"><jdoc:include type="modules" name="top-right" style="xhtml" /></div>
				<?php elseif ($show_textsizer=="true" or $this->countModules('search')) : ?>
				<?php if ($show_textsizer=="true") : ?>
				<div id="accessibility">
					<div id="topwrap"><div id="topwrap2">
						<div class="textsizer-desc"><?php echo JText::_('TEXT_SIZE'); ?></div>
						<div id="buttons">
							<a href="<?php echo JROUTE::_($thisurl . "fontstyle=f-larger"); ?>" title="<?php echo JText::_('INC_FONT_SIZE'); ?>" class="large"><span class="button">&nbsp;</span></a>
							<a href="<?php echo JROUTE::_($thisurl . "fontstyle=f-smaller"); ?>" title="<?php echo JText::_('DEC_FONT_SIZE'); ?>" class="small"><span class="button">&nbsp;</span></a>
						</div>
					</div></div>
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('search')) : ?>
				<div id="searchmod"><jdoc:include type="modules" name="search" style="xhtml" /></div>
				<?php endif; ?>
				<?php endif; ?>
				<!--End Top Right Tools-->
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--End Top Bar-->
	<!--Begin Header-->
	<?php if ($show_logo == "true" or $mtype != "none" or $this->countModules('logo')) : ?>
	<div id="header">
		<div class="wrapper">
			<div class="padding">
				<!--Begin Logo-->
				<?php if ($this->countModules('logo')) : ?>
				<div class="logo-module"><jdoc:include type="modules" name="logo" style="xhtml" /></div>
				<?php elseif ($show_logo == "true") : ?>
				<a href="<?php echo $this->baseurl; ?>" id="logo"></a>
				<?php endif; ?>
				<!--End Logo-->
				<!--Begin Banner Position-->
				<?php if ($this->countModules('banner')) : ?>
				<div class="banner-module"><jdoc:include type="modules" name="banner" style="xhtml" /></div>
				<?php endif; ?>
				<!--End Banner Position-->
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--Begin Horizontal Menu-->
	<?php if($mtype != "none") : ?>
	<div id="horiz-menu" class="<?php echo $mtype; ?>">
		<div class="wrapper">
			<div class="padding">
				<div id="horizmenu-surround"><div id="horizmenu-surround2"></div><div id="horizmenu-surround3"></div><div id="horizmenu-surround4"></div><div id="horizmenu-surround5"></div>
				<?php if($mtype != "module") : ?>
					<?php echo $topnav; ?>
				<?php else: ?>
					<jdoc:include type="modules" name="toolbar" style="none" />
				<?php endif; ?>
				<div class="clr"></div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--End Horizontal Menu-->
	<div id="menu-spacer"></div>
	<!--End Header-->
	<!--Begin Showcase-->
	<?php $mClasses = modulesClasses('case1'); if ($this->countModules('showcase or showcase2 or showcase3')) : ?>
	<div id="showcase-section"><div id="showcase-section2">
		<div class="wrapper">
			<div id="showmodules" class="spacer<?php echo $showmod_width; ?>">
				<?php if ($this->countModules('showcase')) : ?>
				<div class="block <?php echo $mClasses['showcase'][0]; ?>">
					<jdoc:include type="modules" name="showcase" style="feature" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('showcase2')) : ?>
				<div class="block <?php echo $mClasses['showcase2'][0]; ?>">
					<jdoc:include type="modules" name="showcase2" style="feature" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('showcase3')) : ?>
				<div class="block <?php echo $mClasses['showcase3'][0]; ?>">
					<jdoc:include type="modules" name="showcase3" style="feature" />
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div></div>
	<?php endif; ?>
	<!--End Showcase-->
	<!--Begin Featured Area-->
	<?php $mClasses = modulesClasses('case2'); if ($this->countModules('feature or feature2 or feature3 or tabs')) : ?>
	<div id="featuremodules" class="spacer<?php echo $featuremod_width; ?>">
		<?php if ($this->countModules('tabs')) : ?>
		<div id="tabs-bar">
			<div class="wrapper">
				<jdoc:include type="modules" name="tabs" style="none" />
			</div>
			<?php endif; ?>
			<div class="wrapper">
				<?php if ($this->countModules('feature')) : ?>
				<div class="block <?php echo $mClasses['feature'][0]; ?>">
					<jdoc:include type="modules" name="feature" style="feature" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('feature2')) : ?>
				<div class="block <?php echo $mClasses['feature2'][0]; ?>">
					<jdoc:include type="modules" name="feature2" style="feature" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('feature3')) : ?>
				<div class="block <?php echo $mClasses['feature3'][0]; ?>">
					<jdoc:include type="modules" name="feature3" style="feature" />
				</div>
				<?php endif; ?>
			</div>
		<?php if ($this->countModules('tabs')) : ?>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<!--End Featured Area-->
	<!--Begin Main Body-->
		<div id="main-body"><div id="main-body-surround">
			<div id="main-content" class="<?php echo $col_mode; ?>">
			    <div class="colmask leftmenu <?php if (rok_isIe(6)) echo 'wrapper'; ?>"><?php if (!rok_isIe(6)):?><div class="wrapper"><?php endif; ?>
			        <div class="colmid">
			    	    <div class="colright">
					       <!--Begin Main Column (col1wrap)-->   
						    <div class="col1wrap">
						        <div class="col1pad">
						            <div class="col1">
								        <div id="maincol">
											<?php if ($this->countModules('breadcrumb')) : ?>
	    									<div id="breadcrumbs">
												<a href="<?php echo $this->baseurl; ?>" id="breadcrumbs-home"></a>
	    										<jdoc:include type="modules" name="breadcrumb" style="none" />
	    									</div>
	    									<?php endif; ?>
											<?php $mClasses = modulesClasses('case3'); if ($this->countModules('user1 or user2 or user3')) : ?>
	    									<div id="mainmodules" class="spacer<?php echo $mainmod_width; ?>">
	    										<?php if ($this->countModules('user1')) : ?>
	    										<div class="block <?php echo $mClasses['user1'][0]; ?>">
	    											<jdoc:include type="modules" name="user1" style="main" />
	    										</div>
	    										<?php endif; ?>
	    										<?php if ($this->countModules('user2')) : ?>
	    										<div class="block <?php echo $mClasses['user2'][0]; ?>">
	    											<jdoc:include type="modules" name="user2" style="main" />
	    										</div>
	    										<?php endif; ?>
	    										<?php if ($this->countModules('user3')) : ?>
	    										<div class="block <?php echo $mClasses['user3'][0]; ?>">
	    											<jdoc:include type="modules" name="user3" style="main" />
	    										</div>
	    										<?php endif; ?>
	    									</div>
	    									<?php endif; ?>
	    									<div class="bodycontent">
	    										<?php if ($this->countModules('inset2') and !$editmode) : ?>
	    										<div id="inset-block-right">
	    											<jdoc:include type="modules" name="inset2" style="main" />
	    										</div>
	    										<?php endif; ?>
	    										<?php if ($this->countModules('inset') and !$editmode) : ?>
	    										<div id="inset-block-left">
	    											<jdoc:include type="modules" name="inset" style="main" />
	    										</div>
	    										<?php endif; ?>
	    										<div id="maincontent-block">
													<jdoc:include type="message" />
													<?php if (!($frontpage_component == 'hide' and JRequest::getVar('view') == 'frontpage')): ?>
													<jdoc:include type="component" />
													<?php endif; ?>
	    										</div>
	    									</div>
	    									<div class="clr"></div>
        									<?php $mClasses = modulesClasses('case4'); if ($this->countModules('user4 or user5 or user6')) : ?>
        									<div id="mainmodules2" class="spacer<?php echo $mainmod2_width; ?>">
        										<?php if ($this->countModules('user4')) : ?>
        										<div class="block <?php echo $mClasses['user4'][0]; ?>">
        											<jdoc:include type="modules" name="user4" style="main" />
        										</div>
        										<?php endif; ?>
        										<?php if ($this->countModules('user5')) : ?>
        										<div class="block <?php echo $mClasses['user5'][0]; ?>">
        											<jdoc:include type="modules" name="user5" style="main" />
        										</div>
        										<?php endif; ?>
        										<?php if ($this->countModules('user6')) : ?>
        										<div class="block <?php echo $mClasses['user6'][0]; ?>">
        											<jdoc:include type="modules" name="user6" style="main" />
        										</div>
        										<?php endif; ?>
        									</div>
        									<?php endif; ?>
										</div>    
									</div>
						        </div>
						    </div>
						    <!--End Main Column (col1wrap)-->
					        <!--Begin Left Column (col2)-->
					        <?php if ($leftcolumn_width != 0) : ?>
						    <div class="col2">
								<div id="leftcol">
		                            <div id="leftcol-padding">
										<?php if ($subnav and $splitmenu_col=="leftcol") : ?>
											<?php echo $subnav; ?>
										<?php endif; ?>
										<jdoc:include type="modules" name="left" style="side" />
										<?php if (!isset($active)) :?>
										<jdoc:include type="modules" name="inactive" style="side" />    
										<?php endif; ?>
		                            </div>
								</div>
						    </div>
						    <?php endif; ?> 
						    <!--End Left Column (col2)-->
						    <!--Begin Right Column (col3)-->
						    <?php if ($rightcolumn_width != 0) : ?>
						    <div class="col3">
								<div id="rightcol">
									<div id="rightcol-padding">
										<?php if ($subnav and $splitmenu_col=="rightcol") : ?>
										<div class="sidenav-block">
											<?php echo $subnav; ?>
										</div>
										<?php endif; ?>
										<jdoc:include type="modules" name="right" style="side" />
									</div>
								</div>
						    </div>
						    <?php endif; ?> 
						    <!--End Right Column (col3)-->
						</div>
					</div>
				</div><?php if (!rok_isIe(6)):?></div><?php endif; ?>
			</div>
		</div></div>
	<!--End Main Body-->
	<!--Begin Bottom Section-->
	<?php $mClasses = modulesClasses('case5'); if ($this->countModules('bottom or bottom2 or bottom3')) : ?>
	<div id="bottom">
		<div class="wrapper">
			<div id="mainmodules4" class="spacer<?php echo $mainmod4_width; ?>">
				<?php if ($this->countModules('bottom')) : ?>
				<div class="block <?php echo $mClasses['bottom'][0]; ?>">
					<jdoc:include type="modules" name="bottom" style="main" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('bottom2')) : ?>
				<div class="block <?php echo $mClasses['bottom2'][0]; ?>">
					<jdoc:include type="modules" name="bottom2" style="main" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('bottom3')) : ?>
				<div class="block <?php echo $mClasses['bottom3'][0]; ?>">
					<jdoc:include type="modules" name="bottom3" style="main" />
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--End Bottom Section-->
	<!--Begin Bottom Feature-->
	<?php $mClasses = modulesClasses('case6'); if ($this->countModules('user7 or user8 or user9')) : ?>
	<div id="bottom2">
		<div class="wrapper">
			<div id="mainmodules3" class="spacer<?php echo $mainmod3_width; ?>">
				<?php if ($this->countModules('user7')) : ?>
				<div class="block <?php echo $mClasses['user7'][0]; ?>">
					<jdoc:include type="modules" name="user7" style="feature" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('user8')) : ?>
				<div class="block <?php echo $mClasses['user8'][0]; ?>">
					<jdoc:include type="modules" name="user8" style="feature" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('user9')) : ?>
				<div class="block <?php echo $mClasses['user9'][0]; ?>">
					<jdoc:include type="modules" name="user9" style="feature" />
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>	
	<!--End Bottom Feature-->
	<!--Begin Footer-->
	<?php $mClasses = modulesClasses('case7'); if ($this->countModules('footer or footer2 or footer3 or footer4') or $show_copyright == "true" or $show_topbutton == "true") : ?>
	<div id="footer">
		<div class="wrapper">
			<?php $mClasses = modulesClasses('case7'); if ($this->countModules('footer or footer2 or footer3')) : ?>
			<div id="mainmodules5" class="spacer<?php echo $mainmod5_width; ?>">
				<?php if ($this->countModules('footer')) : ?>
				<div class="block <?php echo $mClasses['footer'][0]; ?>">
					<jdoc:include type="modules" name="footer" style="main" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('footer2')) : ?>
				<div class="block <?php echo $mClasses['footer2'][0]; ?>">
					<jdoc:include type="modules" name="footer2" style="main" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('footer3')) : ?>
				<div class="block <?php echo $mClasses['footer3'][0]; ?>">
					<jdoc:include type="modules" name="footer3" style="main" />
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!--Begin Copyright Section-->
			<?php if ($this->countModules('footer4') or $show_copyright == "true" or $show_topbutton == "true") : ?>
			<div class="copyright-block"><div class="copyright-block2">
			<?php if ($show_copyright == "true") : ?>
			<div id="copyright">
				&copy; <?php echo $copyright_text; ?>
			</div>
			<?php else: ?>
			<div class="footer-mod">
				<jdoc:include type="modules" name="footer4" style="main" />
			</div>
			<?php endif; ?>
			<?php if ($show_topbutton == "true") : ?>
			<div id="top-button"><a href="#" id="top-scroll" class="top-button-desc"><?php echo JText::_('TOP'); ?></a></div>
			<?php endif; ?>
			</div></div>
			<?php endif; ?>
			<!--End Copyright Section-->
		</div>
	</div>
	<?php endif; ?>
	<!--End Footer-->	
	<?php if ($this->countModules('debug')) : ?>
	<div id="debug-mod"><jdoc:include type="modules" name="debug" style="none" /></div>
	<?php endif; ?>
	</body>
</html>