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
<?php mosShowHead(); ?>
<?php
if ( $my->id ) {
	initEditor();
}

/* Mosets Tree */
$leftright = 0;
if ( mosCountModules( 'left' ) > 0 ) $leftright++;
if ( mosCountModules( 'right' ) > 0 ) $leftright++;

/* END: Mosets Tree */

$user1 = 0;
$user2 = 0;

if ( mosCountModules( 'user1' ) + mosCountModules( 'user2' ) == 2 AND mosCountModules( 'left' ) > 0 AND mosCountModules( 'right' ) > 0 ) {
	$user1 = 2;
	$user2 = 2;
} elseif ( (mosCountModules( 'user1' ) + mosCountModules( 'user2' ) == 2) AND (mosCountModules( 'left' ) > 0 XOR mosCountModules('right') > 0) ) {
	$user1 = '2onemod';
	$user2 = '2onemod';
} elseif ( mosCountModules( 'user1' ) == 1 ) {
	$user1 = 1;
} elseif ( mosCountModules( 'user2' ) == 1 ) {
	$user2 = 1;
}

if ( mosCountModules( 'left' ) > 0 AND mosCountModules( 'right' ) == 0 ) {

}

?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site;?>/templates/mosets_bluetree/css/template_css.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico"/>
</head>
<body>

<div align="center">

	<div id="main_outline">
		<div id="top"><div id="top_nav"><?php mosLoadModules ( 'user3', -1); ?></div></div>

		<div id="header">
			<div id="header2">Mosets Directory</div><div id="user4"><?php mosLoadModules ( 'user4' ); ?></div>
		</div>
		<div id="header-bottom"></div>
		<div id="top"><?php mosPathWay(); ?></div>

		<?php
		if ( mosCountModules( 'top' ) ) {
			mosLoadModules ( 'top' );
		}
		?>

		

		<?php
		if ( mosCountModules( 'left' ) ) { ?>
			<div id="left_outline">
			<?php mosLoadModules ( 'left' ); ?>
			</div>
		<?php } ?>

		<div id="content_area" style="width:<?php echo (762 - ($leftright * 168)) ?>px;">
			<?php
			if ( mosCountModules( 'user1' ) ) {
				?>
				<div id="user1_<?php echo $user1; ?>">
					<div class="user1_outline">
					<?php mosLoadModules ( 'user1' ); ?>
					</div>
				</div>
				<?php
			}
			if (mosCountModules( 'user2' )) {
				?>
				<div id="user2_<?php echo $user2; ?>">
					<div class="user2_outline">
					<?php mosLoadModules ( 'user2' ); ?>
					</div>
				</div>
				<?php
			}
			?>
			<div class="clr"></div>
			<?php mosMainBody(); ?>
		</div>

		<?php
		if ( mosCountModules( 'left' ) ) { ?>
			<div id="right_outline">
			<?php mosLoadModules ( 'right' ); ?>
			</div>
		<?php } ?>

		<div class="clr" />
		<?php mosLoadModules ( 'bottom' ); ?>
		<br />
		<small>
			<a href="http://www.mosets.com/">Mosets</a> - <a href="http://www.joomla.org/">Joomla!</a> - <a href="http://demo.mosets.com/hotproperty/">Hot Property</a> - <a href="http://www.mosets.com/">Feedback</a> - <a href="http://www.mosets.com/">Advertise with Us</a>
		</small>
		<div class="clr" />
		<div id="footer"><?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?></div>

	</div>

</div>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>
