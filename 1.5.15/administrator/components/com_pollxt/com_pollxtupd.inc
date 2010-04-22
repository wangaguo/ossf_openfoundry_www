<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');


$updatequery[0]->query = "CREATE TABLE IF NOT EXISTS `#__pollsxt` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `voters` int(9) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `access` int(11) NOT NULL default '0',
  `lag` int(11) NOT NULL default '0',
  `multivote` tinyint(1) default '0',
  `rdisp` tinyint(1) NOT NULL default '0',
  `rdispb` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `rdispd` tinyint(1) NOT NULL default '0',
  `intro` text NOT NULL,
  `thanks` text NOT NULL,
  `logon` tinyint(1) NOT NULL default '0',
  `img_url` text,
  `imgsize` int(11) NOT NULL default '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL default '0',
  `css` varchar(20) NOT NULL default 'poll_bars',
  `datefrom` date NOT NULL default '0000-00-00',
  `dateto` date NOT NULL default '0000-00-00',
  `timefrom` time NOT NULL,
  `timeto` time NOT NULL,
  `type` tinyint(1) NOT NULL default '0',
  `sh_numvote` tinyint(1) NOT NULL default '0',
  `sh_flvote` tinyint(1) NOT NULL default '0',
  `sh_abs` tinyint(1) NOT NULL default '0',
  `sh_perc` tinyint(1) NOT NULL default '0',
  `email` tinyint(1) NOT NULL default '0',
  `subject` varchar(80) NOT NULL default '',
  `emailtext` text NOT NULL,
  `goto` tinyint(1) NOT NULL default '0',
  `goto_url` varchar(100) NOT NULL default '',
  `hidetitle` tinyint(1) NOT NULL,
  `mailres` tinyint(1) NOT NULL,
  `mailresrec` varchar(80) NOT NULL,
  `mailrestxt` varchar(255) NOT NULL,
  `rdispall` tinyint(1) NOT NULL,
  `wordwrap` char(4) NOT NULL,
  `category` int(11) NOT NULL,
  `rdispdw` tinyint(1) NOT NULL,
  `notvote` tinyint(1) NOT NULL,
  `notvoteerr` tinyint(1) NOT NULL,
  `vbtext` varchar(80) NOT NULL,
  `hide` tinyint(1) NOT NULL,
  `showvoters` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ;";
$updatequery[0]->upversion = "0";
$updatequery[0]->text = "Create Polls Table";
$updatequery[1]->query = "CREATE TABLE IF NOT EXISTS `#__pollsxt_options` (
  `id` int(11) NOT NULL auto_increment,
  `quid` int(11) NOT NULL default '0',
  `qoption` text NOT NULL,
  `img_url` text,
  `imgsize` int(11) NOT NULL default '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL default '0',
  `freetext` tinyint(1) NOT NULL default '0',
  `newopt` tinyint(1) NOT NULL default '0',
  `inact` tinyint(1) NOT NULL default '0',
  `multicols` char(3) NOT NULL,
  `multirows` char(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);
";
$updatequery[1]->upversion = "0";
$updatequery[1]->text = "Create Options Table";
$updatequery[2]->query = "CREATE TABLE IF NOT EXISTS `#__pollsxt_questions` (
  `id` int(11) NOT NULL auto_increment,
  `pollid` int(11) NOT NULL default '0',
  `title` text NOT NULL,
  `type` tinyint(1) NOT NULL default '0',
  `img_url` text,
  `imgsize` int(11) NOT NULL default '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL default '0',
  `obli` tinyint(1) NOT NULL default '0',
  `multisize` char(3) NOT NULL default '',
  `inact` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL,
  `ratingval` varchar(80) NOT NULL,
  `ratingdesc` text NOT NULL,
  `random` tinyint(1) NOT NULL,
  `minvotes` tinyint(3) NOT NULL,
  `maxvotes` tinyint(3) NOT NULL,
  `style` varchar(1) NOT NULL,
  PRIMARY KEY  (`id`)
);
";
$updatequery[2]->upversion = "0";
$updatequery[2]->text = "Create Questions Table";
$updatequery[3]->query = "CREATE TABLE IF NOT EXISTS `#__pollxt_config` (
  `id` tinyint(1) NOT NULL auto_increment,
  `version` varchar(10) NOT NULL default '',
  `xt_disp` tinyint(1) NOT NULL default '0',
  `xt_hide` tinyint(1) NOT NULL default '0',
  `xt_selpo` tinyint(1) NOT NULL default '0',
  `xt_publ` tinyint(1) NOT NULL default '0',
  `xt_order` tinyint(1) NOT NULL default '0',
  `xt_imgvote` varchar(80) NOT NULL default '',
  `xt_imgresult` varchar(80) NOT NULL default '',
  `xt_maxcolors` tinyint(1) NOT NULL default '0',
  `xt_height` tinyint(2) NOT NULL default '0',
  `xt_orderby` varchar(10) NOT NULL default '',
  `xt_asc` varchar(4) NOT NULL default '',
  `xt_seccookie` tinyint(1) NOT NULL default '0',
  `xt_secip` tinyint(1) NOT NULL default '0',
  `xt_secuname` tinyint(1) NOT NULL default '0',
  `resselpo` tinyint(1) NOT NULL,
  `imgpath` varchar(80) NOT NULL,
  `rdisp` tinyint(1) NOT NULL,
  `button_style` tinyint(1) NOT NULL,
  `debug` tinyint(1) NOT NULL,
  `imgdetail` varchar(80) NOT NULL,
  `imgback` varchar(80) NOT NULL,
  PRIMARY KEY  (`id`)
) ;";
$updatequery[3]->upversion = "0";
$updatequery[3]->text = "Create Config Table";
$updatequery[4]->query = "CREATE TABLE IF NOT EXISTS`#__pollxt_data` (
  `id` int(11) NOT NULL auto_increment,
  `optid` int(11) NOT NULL default '0',
  `ip` text NOT NULL,
  `user` text NOT NULL,
  `datu` datetime NOT NULL default '0000-00-00 00:00:00',
  `value` text,
  `mailkey` varchar(100) NOT NULL default '',
  `block` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;
";
$updatequery[4]->upversion = "0";
$updatequery[4]->text = "Create Data Table";
$updatequery[5]->query = "CREATE TABLE IF NOT EXISTS `#__pollxt_menu` (
  `pollid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pollid`,`menuid`)
);";
$updatequery[5]->upversion = "0";
$updatequery[5]->text = "Create Menu Table";
$updatequery[6]->query = "CREATE TABLE IF NOT EXISTS `#__pollxt_plugins` (
  `id` tinyint(11) NOT NULL auto_increment,
  `pollid` tinyint(11) NOT NULL,
  `plugin` varchar(40) NOT NULL,
  `param` varchar(40) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;
";
$updatequery[6]->upversion = "0";
$updatequery[6]->text = "Create Plugin Table";
$updatequery[7]->query = "INSERT INTO `#__pollxt_config` VALUES (1,'2.00.00', 2, 0, 0, 0, 1, '', '', 5, 5, 'hits', 'ASC', 1, 1, 1, 0, 'images/stories', 1, 0, 0, '', '');";
$updatequery[7]->upversion = "0";
$updatequery[7]->text = "Insert default config";
$updatequery[8]->query = "ALTER TABLE `#__pollxt_config` ADD `compat` VARCHAR( 1 ) NOT NULL ;
";
$updatequery[8]->upversion = "2.00.05";
$updatequery[8]->text = "ALter Config Table";
$updatequery[9]->query = "UPDATE `#__pollxt_config` SET `version` = '2.00.05' WHERE `id` =1;";
$updatequery[9]->upversion = "99";
$updatequery[9]->text = "Update Version Info";
?>
