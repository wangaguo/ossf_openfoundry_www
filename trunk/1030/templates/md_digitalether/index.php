<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// needed to seperate the ISO number from the language file constant _ISO
$iso = split( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
if ( $my->id ) {
	initEditor();
}
mosShowHead(); ?>
<?php
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/md_transmenu.php");
mosInitTransmenu("mainmenu");


if (mosCountModules('user1') + mosCountModules('user2') < 2) {
  $greybox = 'large';
} else {
  $greybox = 'small';
}
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
</head>
<body id="page_bg" onload="init()">
<a name="up" id="up"></a>

<div class="center" align="center">
  <table cellpadding="0" cellspacing="0" width="735" id="main">
    <tr valign="top">
      <td class="left_shadow"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="1" width="10" /><br /></td>
      <td class="wrapper">
				<table cellpadding="0" cellspacing="0" width="760" id="inner">
					<tr valign="top">
						<td width="577">
							<div id="logo"></div>
							<div id="topmenu">
								<?php mosTransmenu(); ?>
							</div>
							<div id="pathway">
								<?php mosPathWay(); ?>
							</div>
						</td>
						<td width="183">
							<div id="topnav">
								<div>
									<?php mosLoadModules('top',-1); ?>
								</div>
							</div>
						</td>
					</tr>
					<tr valign="top">
					 <td>
					   <table cellpadding="0" cellspacing="0" width="577">
							 <tr valign="top">
							   <?php if (mosCountModules('left') > 0) { ?>
							   <td width="164">
							     <div id="leftpadding">
							       <?php mosLoadModules ( 'left',-2 ); ?>	
							     </div>
							     <img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="1" width="164" />
							   </td>
							   <td class="greyseperator"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="10" width="1" /></td>
							   <?php } ?>
                 <td width="100%">
							     <div id="centerpadding">
							       <?php if (mosCountModules('user1') > 0) { ?>
							       <div id="headerpadding">
							         <?php mosLoadModules ( 'user1',-1 ); ?>
							       </div>
							       <div class="horizseperator"></div>
							       <?php } ?>
                     <?php mosMainBody(); ?>
							     </div>
							   </td>
							 </tr>
							 <tr>
      					 <td colspan="3"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="10" width="1" /></td>
      					</tr>
							</table>
					 </td>
					 <td class="rightnav">
					   <div id="righttop"></div>
					   <div id="rightpadding">
					     <?php mosLoadModules ( 'right',-2 ); ?>	
					   </div>
					 </td>
					</tr>

					<tr valign="top">
					 <td class="botmenu">
					   <div id="footmenu">
					     <?php mosLoadModules('user3', -1); ?>
					     <div id="footer"><?php mosLoadModules ( 'footer',-1 ); ?></div>
					   </div>
					 </td>
					 <td class="rightbottom"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="50" width="183" /></td>
					</tr>
				</table>
      </td>
      <td class="right_shadow"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="1" width="10" /><br /></td>
    </tr>
    <tr>
      <td class="left_bot_shadow"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="1" width="10" /><br /></td>
      <td class="bottom">&nbsp;</td>  
      <td class="right_bot_shadow"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/spacer.png" alt="spacer.png, 0 kB" title="spacer" class="" height="1" width="10" /><br /></td>
    </tr>
  </table>
  <div class="bottomspacer"></div>
</div>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>
