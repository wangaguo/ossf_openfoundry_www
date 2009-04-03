<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	<meta http-equiv="PICS-Label" content='(PICS-1.1 "http://www.ticrf.org.tw/chinese/html/06-rating-v11.htm" l gen true for "http://www.openfoundry.org" r (s 0 l 0 v 0 o 0))'>

<?php
if ( $my->id ) {
	initEditor();
}
mosShowHead();

// *************************************************
// Change this variable blow to switch color-schemes
//
// If you have any issues, check out the forum at
// http://www.rockettheme.com
//
// *************************************************
$menu_type = "suckerfish";				// splitmenu | supersucker | suckerfish  | module
$menu_name = "mainmenu";				// mainmenu by default, can be any Joomla menu name
$menu_sidenav = "left";					// left | right - splitmenu only
$default_width = "wide";				// wide | thin | fluid

// *************************************************

if ($menu_type != "module") {
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_" . $menu_type . ".php");
}
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleloader.php");

// splitmenu initialization code
if ($menu_type == "splitmenu") {
	$forcehilite = false;
	$topnav = rtShowHorizMenu($menu_name);
	$sidenav = rtShowSubMenu($menu_name);
	$tabcolor = rtGetTabColor();
	$hilightid = rtGetHilightid();
}

// *************************************************
?>

<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $menu_type; ?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/footer.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 6]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--<link rel="shortcut icon" href="<?php //echo $mosConfig_live_site;?>/images/favicon.ico" />-->
<?php mosInitTransmenu($menu_name);?>
</head>
<body id="page_bg" class="<?php echo $widthstyle; ?> f-default" onload="init()">

	<div id="mainbg">
		<div class="wrapper">
			<div id="mainbg-2">
  				<div id="mainbg-3">
  					<div id="mainbg-4">
  						<div id="mainbg-5">
            
  
           					<div id="header">
			          			<div id="access">
			          				<div id="selectors">
			          					<span class="font-selector">&nbsp;</span>
			          					<span class="width-selector">&nbsp;</span>
			          				</div>
			          				<div id="buttons">
							<?php mosLoadModules('advert1',-1); ?>
			          				</div>
			          			</div>
			          			<a href="<?php echo $mosConfig_live_site;?>" title=""><span id="logo">&nbsp;</span></a>
							<span id="rightbg">&nbsp;</span>
							<span id="search"><?php mosLoadModules('advert2',-1); ?></span>
							<div id="top">
			          				<?php mosLoadModules('top', -1); ?>
			          			</div>
			            	</div>
							<?php if($menu_type != "module" || mosCountModules('toolbar')) { ?>
			            	<div id="toolbar">
			          			<div id="nav">
									<?php if ($menu_type == "module") mosLoadModules('toolbar'); ?>
			          				<?php if ($menu_type == "splitmenu") echo $topnav; ?>
									<?php if ($menu_type == "suckerfish" || $menu_type == "supersucker")  mosTransmenu();	?>
		
							<?php } ?>
			            	<?php if(mosCountModules('user1') || mosCountModules('user2') || mosCountModules('user3')) { ?>
			            	<div id="showcase">
			          			<div class="padding">
			          				<table class="showcase" cellspacing="0">
			          					<tr valign="top">
			          						<?php if(mosCountModules('user1')) { ?>
			          						<td class="showcase">
			          							<?php mosLoadModules('user1', -2); ?>
			          						</td>
			          						<?php } ?>
			          						<?php if(mosCountModules('user2')) { ?>
			          						<td class="showcase">
			          							<?php mosLoadModules('user2', -2); ?>
			          						</td>
			          						<?php } ?>
			          						<?php if(mosCountModules('user3')) { ?>
			          						<td class="showcase">
			          							<?php mosLoadModules('user3', -2); ?>
			          						</td>
			          						<?php } ?>
			          					</tr>
			          				</table>
			          			</div>
			            	</div>
			            	<?php } ?>
         
         						
			          		<div id="mainbody-padding">
			          			<table class="mainbody" cellspacing="0">
			          				<tr valign="top">
			          					<?php if(mosCountModules('left') || (strlen($sidenav)>0 && $menu_sidenav=="left")) { ?>
			          					<td class="left">
			          						<?php if($menu_sidenav=="left" && $menu_type == "splitmenu") { ?>
			          						<?php echo $sidenav; ?>
			          						<?php } ?>
			          						<?php mosLoadModules('left', -2); ?>
			          					</td>
			          					<?php } ?>
			          					<td class="mainbody">
			          						<?php if(mosCountModules('user4') || mosCountModules('user5') || mosCountModules('user6')) { ?>
         
			          						<table class="headlines" cellspacing="10">
			          							<tr valign="top">
			          								<?php if(mosCountModules('user4')) { ?>
			          								<td class="headlines">
			          									<?php mosLoadModules('user4', -2); ?>
			          								</td>
			          								<?php } ?>
			          								<?php if(mosCountModules('user5')) { ?>
			          								<td class="headlines">
			          									<?php mosLoadModules('user5', -2); ?>
			          								</td>
			          								<?php } ?>
			          								<?php if(mosCountModules('user6')) { ?>
			          								<td class="headlines">
			          									<?php mosLoadModules('user6', -2); ?>
			          								</td>
			          								<?php } ?>
			          							</tr>
			          						</table>
         
			          						<?php } ?>
			          						<div class="padding">
											<?php mosPathway(); ?>
								 		<div class="mainbodycount">
										<?php mosMainbody(); ?>
										</div>
			          							<div id="inset">
			          								<?php mosLoadModules('inset', -1); ?>
			          							</div>
			          						</div>
			          					</td>
			          					<?php if(mosCountModules('right') || (strlen($sidenav)>0 && $menu_sidenav=="right")) { ?>
			          					<td class="right">
			          						<?php if($menu_sidenav=="right" && $menu_type == "splitmenu") { ?>
			          						<?php echo $sidenav; ?>
			          						<?php } ?>
			          						<?php mosLoadModules('right', -2); ?>
			          					</td>
			          					<?php } ?>
			          				</tr>
			          			</table>
			          		</div>							
         
			            	<?php if(mosCountModules('user7') || mosCountModules('user8') || mosCountModules('user9') || mosCountModules('footer')) { ?>
			            	<div id="the-footer">
			          			<div class="padding">
			          				<table class="footer" cellspacing="0">
			          					<tr valign="top"> 
			          						<?php if(mosCountModules('user7')) { ?>
			          						<td class="footer">
			          							<?php mosLoadModules('user7', -2); ?>
			          						</td>
			          						<?php } ?>
			          						<?php if(mosCountModules('user8')) { ?>
			          						<td class="footer">
			          							<?php mosLoadModules('user8', -2); ?>
			          						</td>
			          						<?php } ?>
			          						<?php if(mosCountModules('user9')) { ?>
			          						<td class="footer">
			          							<?php mosLoadModules('user9', -2); ?>
			          						</td>
			          						<?php } ?>
			          					</tr>
			          				</table>
         				
			          			</div>
			            	</div>
			            	<?php } ?>


            			</div>
					</div>
        		</div>
      		</div>	
		</div>
	</div>
	
	<div class="wrapper">
	<!--
		<div id="mainft-2">
			<div id="mainft-3">
				<div id="the-footer">
					<div class="padding">
	      		  		<?php mosLoadModules('footer', -1);?>
					</div>
	      		</div>
			</div>
		</div>-->
	</div>
  	

<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>

