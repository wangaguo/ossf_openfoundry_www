<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
require( YOURBASEPATH.DS."rt_styleswitcher.php");
JHTML::_( 'behavior.mootools' );
global $template_real_width, $leftcolumn_width, $rightcolumn_width, $tstyle, $show_tools, $show_collapse;
global $js_compatibility;

$live_site        		= $mainframe->getCfg('live_site');
$template_path 			= $this->baseurl . '/templates/' .  $this->template;
$default_style 			= $this->params->get("defaultStyle", "style1");
$frontpage_component    = $this->params->get("enableFrontpage", "show");
$enable_ie6warn         = ($this->params->get("enableIe6warn", 0)  == 0)?"false":"true";
$font_family            = $this->params->get("fontFamily", "mixxmag");
$template_width 		= $this->params->get("templateWidth", "958");
$leftcolumn_width		= $this->params->get("leftcolumnWidth", "185");
$rightcolumn_width		= $this->params->get("rightcolumnWidth", "260");
$leftinset_width		= $this->params->get("leftinsetWidth", "160");
$rightinset_width		= $this->params->get("rightinsetWidth", "160");
$splitmenu_col			= $this->params->get("splitmenuCol", "rightcol");
$menu_name 				= $this->params->get("menuName", "mainmenu");
$menu_type 				= $this->params->get("menuType", "splitmenu");
$default_font 			= $this->params->get("defaultFont", "default");
$show_tools		 		= ($this->params->get("showTools", 1)  == 0)?"hidetools":"showtools";
$show_collapse			= ($this->params->get("showCollapse", 1) == 0) ? "hidecollapse" : "showcollapse";
$show_logo		 		= ($this->params->get("showLogo", 1)  == 0)?"false":"true";
$show_date		 		= ($this->params->get("showDate", 1)  == 0)?"false":"true";
$show_textsizer		 	= ($this->params->get("showTextsizer", 1)  == 0)?"false":"true";
$show_copyright 		= ($this->params->get("showCopyright", 1)  == 0)?"false":"true";
$clientside_date		= ($this->params->get("clientSideDate", 1) == 0)?"false":"true";
$js_compatibility	 	= ($this->params->get("jsCompatibility", 0)  == 0)?"false":"true";

// moomenu options
$moo_bgiframe     		= ($this->params->get("moo_bgiframe'","0") == 0)?"false":"true";
$moo_delay       		= $this->params->get("moo_delay", "500");
$moo_duration    		= $this->params->get("moo_duration", "600");
$moo_fps          		= $this->params->get("moo_fps", "200");
$moo_transition   		= $this->params->get("moo_transition", "Sine.easeOut");

$moo_bg_enabled			= ($this->params->get("moo_bg_enabled","0") == 0)?"false":"true";
$moo_bg_over_duration		= $this->params->get("moo_bg_over_duration", "100");
$moo_bg_over_transition		= $this->params->get("moo_bg_over_transition", "Expo.easeOut");
$moo_bg_out_duration		= $this->params->get("moo_bg_out_duration", "800");
$moo_bg_out_transition		= $this->params->get("moo_bg_out_transition", "Sine.easeOut");

$moo_sub_enabled		= ($this->params->get("moo_sub_enabled","0") == 0)?"false":"true";
$moo_sub_over_duration		= $this->params->get("moo_sub_over_duration", "50");
$moo_sub_over_transition	= $this->params->get("moo_sub_over_transition", "Expo.easeOut");
$moo_sub_out_duration		= $this->params->get("moo_sub_out_duration", "600");
$moo_sub_out_transition		= $this->params->get("moo_sub_out_transition", "Sine.easeIn");
$moo_sub_offsets_top		= $this->params->get("moo_sub_offsets_top", "5");
$moo_sub_offsets_right		= $this->params->get("moo_sub_offsets_right", "15");
$moo_sub_offsets_bottom		= $this->params->get("moo_sub_offsets_bottom", "5");
$moo_sub_offsets_left		= $this->params->get("moo_sub_offsets_left", "5");
								
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
	<body id="ff-<?php echo $fontfamily; ?>" class="<?php echo $fontstyle; ?> <?php echo $tstyle; ?> iehandle">
		<div id="page-bg">
			<!--Begin Top Header Bar-->
			<div id="top-bar" class="png">
				<div class="wrapper">
					<?php if ($this->countModules('toplinks')) : ?>
					<div class="links-block">
						<jdoc:include type="modules" name="toplinks" style="none" />
					</div>
					<?php endif ;?>
					<?php if ($show_textsizer=="true") : ?>
					<div id="accessibility"><div id="buttons">
						<a href="<?php echo JROUTE::_($thisurl . "fontstyle=f-larger"); ?>" title="Increase Font Size" class="large"><span class="button">&nbsp;</span></a>
						<a href="<?php echo JROUTE::_($thisurl . "fontstyle=f-smaller"); ?>" title="Decrease Font Size" class="small"><span class="button">&nbsp;</span></a>
					</div></div>
					<?php endif; ?>
					<?php if ($show_date == "true") : ?>
					<div class="date-block">
						<span class="date1"><?php $now = &JFactory::getDate(); echo $now->toFormat('%A'); ?></span>
						<span class="date2"><?php $now = &JFactory::getDate(); echo $now->toFormat('%b'); ?></span>
						<span class="date3"><?php $now = &JFactory::getDate(); echo $now->toFormat('%d'); ?></span>
					</div>
					<?php else : ?>
					<div class="right-module-block">
						<jdoc:include type="modules" name="top" style="xhtml" />
					</div>
					<?php endif; ?>
					<?php if ($this->countModules('login')) : ?>
					<div class="login-module-block">
					    <?php if ($user->guest) : ?>
                                                    <a href="#" id="lock-button" rel="rokbox[240 310][module=login-module]"><span><?php echo JText::_('LOGIN'); ?></span></a>
					    <?php else : ?>
                                                    <a href="#" id="lock-button" rel="rokbox[240 310][module=login-module]"><span><?php echo JText::_('LOGOUT'); ?></span></a>
					    <?php endif; ?>
					</div>
                                        <?php endif; ?>

				</div>
			</div>
			<!--End Top Header Bar-->
			<div class="wrapper"><div class="side-shadow-l png"><div class="side-shadow-r png">
			<!--Begin Main Header-->
			<div id="top-divider" class="png"></div>
			<div id="main-header"<?php if ($tstyle=="style8" or $tstyle=="style9" or $tstyle=="style10"):?> class="png"<?php endif; ?>>
				<?php if($show_logo == "true") : ?>
				<div id="logo-bg-area"></div>
				<div id="logo-surround"><div id="logo-banner"><div id="logo-banner2" class="png"><div id="logo-banner3">
					<a href="<?php echo $this->baseurl; ?>" class="nounder"><img src="<?php echo $template_path; ?>/images/blank.gif" border="0" alt="logo" id="logo" /></a>
				</div></div></div></div>
				<?php elseif($show_logo =="false" and $this->countModules('logo')) : ?>
				<div class="logo-module">
					<jdoc:include type="modules" name="logo" style="xhtml" />
				</div>
				<?php endif; ?>			    
				<?php if ($this->countModules('search')) : ?>
				<div id="header-tools">
					<div id="searchmod">
						<jdoc:include type="modules" name="search" style="xhtml" />
					</div>
				</div>
				<?php else : ?>
				<div class="header-spacer"></div>
				<?php endif; ?>
				<?php if($mtype != "none") : ?>
				<div id="horiz-menu" class="<?php echo $mtype; ?>">
					<div class="wrapper">
					<?php if($mtype != "module") : ?>
						<?php echo $topnav; ?>
					<?php else: ?>
						<jdoc:include type="modules" name="toolbar" style="none" />
					<?php endif; ?>
					</div>
				</div>
				<?php else : ?>
				<div id="menu-spacer"></div>
				<?php endif; ?>

				<div class="clr"></div>
			</div>
			<!--End Main Header-->
			<!--Begin Main Content Area-->
			<div id="main-body-bg">
			<div id="main-body">
				<!--Begin Left Column-->
				<?php if ($leftcolumn_width != 0) : ?>
				<div id="leftcol">
					<div class="padding">
						<?php if ($subnav and $splitmenu_col=="leftcol") : ?>
						<div class="sidenav-block">
							<?php echo $subnav; ?>
						</div>
						<?php endif; ?>
						<?php if ($this->countModules('advertisement1')) : ?>
							<div class="ad-block"><jdoc:include type="modules" name="advertisement1" style="xhtml" /></div>
						<?php endif; ?>
						<jdoc:include type="modules" name="left" style="sidebar" />
						<?php if ($this->countModules('advertisement2')) : ?>
							<div class="ad-block"><jdoc:include type="modules" name="advertisement2" style="xhtml" /></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<!--End Left Column-->
				<!--Begin Main Column-->
				<div id="maincol" style="width: <?php echo getMainWidth(); ?>px">
					<div class="padding">
					<?php if ($this->countModules('breadcrumb')) : ?>
						<div id="breadcrumbs">
							<jdoc:include type="modules" name="breadcrumb" style="xhtml" />
						</div>
					<?php endif; ?>
					<?php if ($this->countModules('featured')) : ?>
					<div id="featured-block">
						<jdoc:include type="modules" name="featured" style="featured" />
					</div>
					<?php endif; ?>
					<?php $mClasses = modulesClasses('case1'); if ($this->countModules('user1') or $this->countModules('user2') or $this->countModules('user3')) : ?>
					<div id="mainmodules" class="spacer<?php echo $mainmod_width; ?>">
						<?php if ($this->countModules('user1')) : ?>
						<div class="block <?php echo $mClasses['user1'][0]; ?>" style="width: <?php echo $mClasses['user1'][1]; ?>px">
							<jdoc:include type="modules" name="user1" style="main" />
						</div>
						<?php endif; ?>
						<?php if ($this->countModules('user2')) : ?>
						<div class="block <?php echo $mClasses['user2'][0]; ?>" style="width: <?php echo $mClasses['user2'][1]; ?>px">
							<jdoc:include type="modules" name="user2" style="main" />
						</div>
						<?php endif; ?>
						<?php if ($this->countModules('user3')) : ?>
						<div class="block <?php echo $mClasses['user3'][0]; ?>" style="width: <?php echo $mClasses['user3'][1]; ?>px">
							<jdoc:include type="modules" name="user3" style="main" />
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ($this->countModules('rokmininews')) : ?>
					<div id="rokmininews-block"><div id="rokmininews">
						<jdoc:include type="modules" name="rokmininews" style="rokmininews" />
					</div></div>
					<?php endif; ?>
					<div id="main-content">
						<?php if ($this->countModules('inset2') and !$editmode) : ?>
						<div id="inset-block-right"><div class="right-padding">
							<jdoc:include type="modules" name="inset2" style="main" />
						</div></div>
						<?php endif; ?>
						<?php if ($this->countModules('inset') and !$editmode) : ?>
						<div id="inset-block-left"><div class="left-padding">
							<jdoc:include type="modules" name="inset" style="main" />
						</div></div>
						<?php endif; ?>
						<div id="maincontent-block">
							<jdoc:include type="message" />
							<?php if (!($frontpage_component == 'hide' and JRequest::getVar('view') == 'frontpage')): ?>
							<jdoc:include type="component" />
							<?php endif; ?>
						</div>
						</div>
					</div>
					<div class="clr"></div>
					<?php $mClasses = modulesClasses('case2'); if ($this->countModules('user4') or $this->countModules('user5') or $this->countModules('user6')) : ?>
					<div id="mainmodules2" class="spacer<?php echo $mainmod2_width; ?>">
						<?php if ($this->countModules('user4')) : ?>
						<div class="block <?php echo $mClasses['user4'][0]; ?>" style="width: <?php echo $mClasses['user4'][1]; ?>px">
							<jdoc:include type="modules" name="user4" style="main" />
						</div>
						<?php endif; ?>
						<?php if ($this->countModules('user5')) : ?>
						<div class="block <?php echo $mClasses['user5'][0]; ?>" style="width: <?php echo $mClasses['user5'][1]; ?>px">
							<jdoc:include type="modules" name="user5" style="main" />
						</div>
						<?php endif; ?>
						<?php if ($this->countModules('user6')) : ?>
						<div class="block <?php echo $mClasses['user6'][0]; ?>" style="width: <?php echo $mClasses['user6'][1]; ?>px">
							<jdoc:include type="modules" name="user6" style="main" />
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
				<!--End Main Column-->
				<!--Begin Right Column-->
				<?php if ($rightcolumn_width != 0) : ?>
				<div id="rightcol">
					<div class="padding">
						<?php if ($subnav and $splitmenu_col=="rightcol") : ?>
						<div class="sidenav-block">
							<?php echo $subnav; ?>
						</div>
						<?php endif; ?>
						<?php if ($this->countModules('advertisement3')) : ?>
							<div class="ad-block"><jdoc:include type="modules" name="advertisement3" style="xhtml" /></div>
						<?php endif; ?>
						<jdoc:include type="modules" name="right" style="sidebar" />
						<?php if ($this->countModules('advertisement4')) : ?>
							<div class="ad-block"><jdoc:include type="modules" name="advertisement4" style="xhtml" /></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<!--End Right Column-->
			<div class="clr"></div>
			</div>
			<!-- Begin Bottom Main Modules -->
			<?php $mClasses = modulesClasses('case3'); if ($this->countModules('user7') or $this->countModules('user8') or $this->countModules('user9')) : ?>
			<div id="mainmodules3" class="spacer<?php echo $mainmod3_width; ?>">
				<?php if ($this->countModules('user7')) : ?>
				<div class="block <?php echo $mClasses['user7'][0]; ?>">
					<jdoc:include type="modules" name="user7" style="main" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('user8')) : ?>
				<div class="block <?php echo $mClasses['user8'][0]; ?>">
					<jdoc:include type="modules" name="user8" style="main" />
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('user9')) : ?>
				<div class="block <?php echo $mClasses['user9'][0]; ?>">
					<jdoc:include type="modules" name="user9" style="main" />
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('advertisement5')) : ?>
				<div class="ad-block-bottom"><jdoc:include type="modules" name="advertisement5" style="xhtml" /></div>
			<?php endif; ?>
			<!-- End Bottom Main Modules -->
		<!--End Main Content Area-->
		<!--Begin Bottom Area-->
		<div class="bottom-padding">
			<?php if ($this->countModules('bottom')) : ?>
			<div id="bottom-block">
				<div id="footer-bg1"><div id="footer-bg2">
					<jdoc:include type="modules" name="bottom" style="xhtml" />
				</div></div>
			</div>
			<?php endif; ?>
			<?php if ($show_copyright == "true" or $this->countModules('footer')) : ?>
			<div id="footer-bar">
				<!--<a href="#" id="clear-cookies">Restore Default Settings</a>-->
				<?php if ($show_copyright == "true") : ?>
				<div class="copyright-block">
					<!--<a href="http://www.rockettheme.com/" title="RocketTheme Joomla Template Club" class="nounder"><img src="<?php echo $template_path; ?>/images/blank.gif" alt="RocketTheme Joomla Templates" id="rocket" /></a>-->
					<div id="copyright">
						OSSF Supports Software Freedom. For Optimum Result: IE5.5 or Firefox1.0 above. Resolution 1024*768.<!--&copy; Copyright <?php// $now = &JFactory::getDate(); echo $now->toFormat('%Y'); ?>, All Rights Reserved-->
					</div>
				</div>
				<?php else: ?>
				<div class="footer-mod">
					<jdoc:include type="modules" name="footer" style="xhtml" />
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
		<!--End Bottom Area-->
		</div></div></div>
		</div>
		<div id="bottom-expansion">
			<div class="wrapper">
				<?php $mClasses = modulesClasses('case4'); if ($this->countModules('footer2') or $this->countModules('footer3') or $this->countModules('footer4')) : ?>
				<div id="mainmodules4" class="spacer<?php echo $mainmod4_width; ?>">
					<?php if ($this->countModules('footer2')) : ?>
					<div class="block <?php echo $mClasses['footer2'][0]; ?>">
						<jdoc:include type="modules" name="footer2" style="xhtml" />
					</div>
					<?php endif; ?>
					<?php if ($this->countModules('footer3')) : ?>
					<div class="block <?php echo $mClasses['footer3'][0]; ?>">
						<jdoc:include type="modules" name="footer3" style="xhtml" />
					</div>
					<?php endif; ?>
					<?php if ($this->countModules('footer4')) : ?>
					<div class="block <?php echo $mClasses['footer4'][0]; ?>">
						<jdoc:include type="modules" name="footer4" style="xhtml" />
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ($this->countModules('debug')) : ?>
				<div class="wrapper"><div class="debug-mod">
					<jdoc:include type="modules" name="debug" style="xhtml" />
				</div></div>
				<?php endif; ?>
                                <?php if ($this->countModules('login')) : ?>
                                <div id="login-module">                 
                                        <?php if ($user->guest) : ?>    
                                        <jdoc:include type="modules" name="login" style="xhtml" />
                                        <?php else : ?>                 
                                        <div class="logout">            
                                                <jdoc:include type="modules" name="login" style="xhtml" />
                                        </div>                          
                                        <?php endif; ?>         
                                </div>                  
                                <?php endif; ?>

			</div>
		</div>
		</div>
	</body>
</html>
