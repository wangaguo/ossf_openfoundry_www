<?php
/**
 * @package Gantry Template Framework - RocketTheme
 * @version 1.5.0 March 31, 2010
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2010 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
//require_once('../../administrator/components/com_menus/admin.menus.php');
$gantry->init();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
<?php
$app = JFactory::getApplication();
$this->setTitle( $this->getTitle() . ' - ' . $app->getCfg( 'sitename' ) );
?>

<link rel="shortcut icon" href="/images/favicon.ico" />

	<?php 
		$gantry->displayHead();
		$gantry->addStyles(array('template.css','joomla.css','style.css','typography.css'));
	?>
<script type="text/javascript" src="/sso/javascripts/langsync.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4136519-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
	<body <?php echo $gantry->displayBodyTag(array('backgroundLevel','bodyLevel')); ?>>
		<div id="rt-main-background">
			<div class="rt-container">
				<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
				<div id="rt-drawer">
					<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Drawer **/ endif; ?>
				<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
				<div id="rt-top">
					<?php echo $gantry->displayModules('top','standard','standard'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Top **/ endif; ?>
				<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
				<div id="rt-header">
					<?php echo $gantry->displayModules('header','standard','standard'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Header **/ endif; ?>
				<?php if ($gantry->countModules('navigation')=="0") : ?>
				<div class="rt-surround-top"><div class="rt-surround-top2"><div class="rt-surround-top3"></div></div></div>
				<?php endif; ?>
				<?php /** Begin Menu **/ if ($gantry->countModules('navigation')) : ?>
				<div id="rt-navigation"><div id="rt-navigation2"><div id="rt-navigation3">
					<?php echo $gantry->displayModules('navigation','basic','basic'); ?>
				    <div class="clear"></div>
				</div></div></div>
				<?php /** End Menu **/ endif; ?>
				<div class="rt-surround"><div class="rt-surround2"><div class="rt-surround3">
					<?php if ($gantry->countModules('showcase') or $gantry->countModules('feature')) : ?>
					<div id="rt-showcase-section">
						<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
						<div id="rt-showcase">
							<?php echo $gantry->displayModules('showcase','standard','showcase'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Showcase **/ endif; ?>
						<?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
						<div id="rt-feature">
							<?php echo $gantry->displayModules('feature','standard','standard'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Feature **/ endif; ?>
					</div>
					<?php endif; ?>
					<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
					<div id="rt-utility">
						<?php echo $gantry->displayModules('utility','standard','basic'); ?>
						<div class="clear"></div>
					</div>
					<?php /** End Utility **/ endif; ?>
					<div id="rt-main-surround">
						<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
						<div id="rt-breadcrumbs">
							<?php echo $gantry->displayModules('breadcrumb','basic','breadcrumbs'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Breadcrumbs **/ endif; ?>
						<?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
						<div id="rt-maintop"><div id="rt-maintop2">
							<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
							<div class="clear"></div>
						</div></div>
						<?php /** End Main Top **/ endif; ?>
						<?php /** Begin Main Body **/ ?>
					    <?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?>
						<?php /** End Main Body **/ ?>
						<?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
						<div id="rt-mainbottom">
							<?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Main Bottom **/ endif; ?>
						<?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
						<div id="rt-bottom"><div id="rt-bottom2">
							<?php echo $gantry->displayModules('bottom','standard','standard'); ?>
							<div class="clear"></div>
						</div></div>
						<?php /** End Bottom **/ endif; ?>
						<?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
						<div id="rt-footer">
							<?php echo $gantry->displayModules('footer','standard','standard'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Footer **/ endif; ?>
					</div>
					<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
					<div id="rt-copyright">
						<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
						<div class="clear"></div>
					</div>
					<div class="rt-footer-bottom-wrap"><div class="rt-footer-bottom"><div class="rt-footer-bottom2"><div class="rt-footer-bottom3"></div></div></div></div>
					<?php /** End Copyright **/ endif; ?>
				</div></div></div>
				<div class="rt-surround-bottom"><div class="rt-surround-bottom2"><div class="rt-surround-bottom3"></div></div></div>
				<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
				<div id="rt-debug">
					<?php echo $gantry->displayModules('debug','standard','standard'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Debug **/ endif; ?>
			</div>
		</div>
		<?php /** Begin Popup **/ 
		echo $gantry->displayModules('popup','popup','popup'); 
		/** End Popup **/ ?>
<!--
		<script id="aptureScript">
						(function (){var a=document.createElement("script");a.defer="true";a.src="http://www.apture.com/js/apture.js?siteToken=vsJttrn";document.getElementsByTagName("head")[0].appendChild(a);})();
     </script>
-->

	</body>
</html>
<?php
$gantry->finalize();
?>
