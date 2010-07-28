<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');


$createTable[0]->tname = "pollsxt";
$createTable[0]->tstruct = "CREATE TABLE IF NOT EXISTS `#__pollsxt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  `multivote` tinyint(1) DEFAULT '0',
  `rdisp` tinyint(1) NOT NULL DEFAULT '0',
  `rdispb` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rdispd` tinyint(1) NOT NULL DEFAULT '0',
  `intro` text NOT NULL,
  `thanks` text NOT NULL,
  `logon` tinyint(1) NOT NULL DEFAULT '0',
  `img_url` text,
  `imgsize` int(11) NOT NULL DEFAULT '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL DEFAULT '0',
  `css` varchar(20) NOT NULL DEFAULT 'poll_bars',
  `datefrom` date NOT NULL DEFAULT '0000-00-00',
  `dateto` date NOT NULL DEFAULT '0000-00-00',
  `timefrom` time NOT NULL,
  `timeto` time NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `sh_numvote` tinyint(1) NOT NULL DEFAULT '0',
  `sh_flvote` tinyint(1) NOT NULL DEFAULT '0',
  `sh_abs` tinyint(1) NOT NULL DEFAULT '0',
  `sh_perc` tinyint(1) NOT NULL DEFAULT '0',
  `email` tinyint(1) NOT NULL DEFAULT '0',
  `subject` varchar(80) NOT NULL DEFAULT '',
  `emailtext` text NOT NULL,
  `goto` tinyint(1) NOT NULL DEFAULT '0',
  `goto_url` varchar(100) NOT NULL DEFAULT '',
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
  PRIMARY KEY (`id`)
)";
$createTable[1]->tname = "pollsxt_options";
$createTable[1]->tstruct = "CREATE TABLE IF NOT EXISTS `#__pollsxt_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quid` int(11) NOT NULL DEFAULT '0',
  `qoption` text NOT NULL,
  `img_url` text,
  `imgsize` int(11) NOT NULL DEFAULT '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL DEFAULT '0',
  `freetext` tinyint(1) NOT NULL DEFAULT '0',
  `newopt` tinyint(1) NOT NULL DEFAULT '0',
  `inact` tinyint(1) NOT NULL DEFAULT '0',
  `multicols` char(3) NOT NULL,
  `multirows` char(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `desc` text NOT NULL,
  `linkurl` varchar(255) NOT NULL,
  `linktext` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
)";
$createTable[2]->tname = "pollsxt_questions";
$createTable[2]->tstruct = "CREATE TABLE IF NOT EXISTS `#__pollsxt_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `img_url` text,
  `imgsize` int(11) NOT NULL DEFAULT '0',
  `imgor` text NOT NULL,
  `imglink` tinyint(1) NOT NULL DEFAULT '0',
  `obli` tinyint(1) NOT NULL DEFAULT '0',
  `multisize` char(3) NOT NULL DEFAULT '',
  `inact` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `ratingval` varchar(80) NOT NULL,
  `ratingdesc` text NOT NULL,
  `random` tinyint(1) NOT NULL,
  `minvotes` tinyint(3) NOT NULL,
  `maxvotes` tinyint(3) NOT NULL,
  `style` varchar(1) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
)";
$createTable[3]->tname = "pollxt_config";
$createTable[3]->tstruct = "CREATE TABLE IF NOT EXISTS `#__pollxt_config` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `version` varchar(10) NOT NULL DEFAULT '',
  `xt_disp` tinyint(1) NOT NULL DEFAULT '0',
  `xt_hide` tinyint(1) NOT NULL DEFAULT '0',
  `xt_selpo` tinyint(1) NOT NULL DEFAULT '0',
  `xt_publ` tinyint(1) NOT NULL DEFAULT '0',
  `xt_order` tinyint(1) NOT NULL DEFAULT '0',
  `xt_imgvote` varchar(80) NOT NULL DEFAULT '',
  `xt_imgresult` varchar(80) NOT NULL DEFAULT '',
  `xt_maxcolors` tinyint(1) NOT NULL DEFAULT '0',
  `xt_height` tinyint(2) NOT NULL DEFAULT '0',
  `xt_orderby` varchar(10) NOT NULL DEFAULT '',
  `xt_asc` varchar(4) NOT NULL DEFAULT '',
  `xt_seccookie` tinyint(1) NOT NULL DEFAULT '0',
  `xt_secip` tinyint(1) NOT NULL DEFAULT '0',
  `xt_secuname` tinyint(1) NOT NULL DEFAULT '0',
  `resselpo` tinyint(1) NOT NULL,
  `imgpath` varchar(80) NOT NULL,
  `rdisp` tinyint(1) NOT NULL,
  `button_style` tinyint(1) NOT NULL,
  `debug` tinyint(1) NOT NULL,
  `imgdetail` varchar(80) NOT NULL,
  `imgback` varchar(80) NOT NULL,
  `compat` varchar(1) NOT NULL,
  `tooltips` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
)";
$createTable[4]->tname = "pollxt_data";
$createTable[4]->tstruct = "CREATE TABLE IF NOT EXISTS`#__pollxt_data` (
  `id` int(11) NOT NULL auto_increment,
  `optid` int(11) NOT NULL default '0',
  `ip` text NOT NULL,
  `user` text NOT NULL,
  `datu` datetime NOT NULL default '0000-00-00 00:00:00',
  `value` text,
  `mailkey` varchar(100) NOT NULL default '',
  `block` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;";
$createTable[5]->tname = "pollxt_menu";
$createTable[5]->tstruct = "CREATE TABLE IF NOT EXISTS `#__pollxt_menu` (
  `pollid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pollid`,`menuid`)
);";
$createTable[6]->tname = "pollxt_plugins";
$createTable[6]->tstruct = "CREATE TABLE IF NOT EXISTS `#__pollxt_plugins` (
  `id` tinyint(11) NOT NULL auto_increment,
  `pollid` tinyint(11) NOT NULL,
  `plugin` varchar(40) NOT NULL,
  `param` varchar(40) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ;";
$updatequery[0]->query = "INSERT INTO `#__pollxt_config` (`id`, `version`, `xt_disp`, `xt_hide`, `xt_selpo`, `xt_publ`, `xt_order`, `xt_imgvote`, `xt_imgresult`, `xt_maxcolors`, `xt_height`, `xt_orderby`, `xt_asc`, `xt_seccookie`, `xt_secip`, `xt_secuname`, `resselpo`, `imgpath`, `rdisp`, `button_style`, `debug`, `imgdetail`, `imgback`, `compat`, `tooltips`) VALUES
(1, '1.24.16', 1, 0, 1, 1, 1, '', '', 5, 5, 'hits', 'DESC', 1, 1, 1, 1, 'images/stories/', 1, 0, 0, '', '', '0', '1');";
$updatequery[0]->upversion = "0";
$updatequery[0]->text = "Insert default config";
$updatequery[1]->query = "INSERT INTO `#__pollsxt` (`id`, `title`, `voters`, `checked_out`, `checked_out_time`, `published`, `access`, `lag`, `multivote`, `rdisp`, `rdispb`, `ordering`, `rdispd`, `intro`, `thanks`, `logon`, `img_url`, `imgsize`, `imgor`, `imglink`, `css`, `datefrom`, `dateto`, `timefrom`, `timeto`, `type`, `sh_numvote`, `sh_flvote`, `sh_abs`, `sh_perc`, `email`, `subject`, `emailtext`, `goto`, `goto_url`, `hidetitle`, `mailres`, `mailresrec`, `mailrestxt`, `rdispall`, `wordwrap`, `category`, `rdispdw`, `notvote`, `notvoteerr`, `vbtext`, `hide`, `showvoters`) VALUES
(1, 'Sample Poll', 77, 0, '0000-00-00 00:00:00', 1, 0, 0, 1, 2, 1, 1, 1, 'This is a sample poll, that shows you quickly some of the capabilities of PollXT', '', 0, '', 100, 'width', 0, '', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 1, 1, 1, 1, 0, 'Confirm your vote ', 'Please click on the link below to confirm your vote.', 0, '', 0, 0, '', '', 1, '', 0, 1, 2, 1, '', 0, 0);";
$updatequery[1]->upversion = "0";
$updatequery[1]->text = "Insert Sample Poll (Poll)";
$updatequery[2]->query = "INSERT INTO `#__pollsxt_questions` (`id`, `pollid`, `title`, `type`, `img_url`, `imgsize`, `imgor`, `imglink`, `obli`, `multisize`, `inact`, `ordering`, `ratingval`, `ratingdesc`, `random`, `minvotes`, `maxvotes`, `style`, `desc`) VALUES
(1, 1, 'A question with radio buttons... like it?', 1, '', 100, 'width', 0, 0, '', 0, 1, '', '', 0, 0, 0, 'v', ''),
(2, 1, 'Now some checkboxes with pictures, do you like...', 2, '', 100, 'width', 0, 0, '', 0, 2, '', '', 0, 0, 0, 'v', 'Select your favorite fruit'),
(3, 1, 'Select as much as you''''d like to...', 4, 'images/stories/clock.jpg', 30, 'width', 1, 0, '', 0, 3, '', '', 0, 0, 0, 'v', '');";
$updatequery[2]->upversion = "0";
$updatequery[2]->text = "Insert Sample Poll (Questions)";
$updatequery[3]->query = "INSERT INTO `#__pollsxt_options` (`id`, `quid`, `qoption`, `img_url`, `imgsize`, `imgor`, `imglink`, `freetext`, `newopt`, `inact`, `multicols`, `multirows`, `ordering`, `desc`, `linkurl`, `linktext`) VALUES
(1, 1, 'yes', '', 100, 'width', 0, 0, 0, 0, '10', '1', 1, '', '', ''),
(3, 1, 'no', '', 100, 'width', 0, 0, 0, 0, '10', '1', 1, '', '', ''),
(2, 2, 'Cherries', 'images/stories/fruit/cherry.jpg', 30, 'width', 1, 0, 0, 0, '10', '1', 1, '', '', ''),
(4, 2, 'Strawberrys', 'images/stories/fruit/strawberry.jpg', 30, 'width', 0, 0, 0, 0, '10', '1', 2, '', '', ''),
(5, 2, 'Something else', '', 100, 'width', 0, 1, 3, 0, '10', '5', 3, '', '', ''),
(6, 3, 'PollXT is cool', '', 100, 'width', 0, 0, 0, 0, '10', '1', 1, '', '', ''),
(7, 3, 'I like JoomlaXT', '', 100, 'width', 0, 0, 0, 0, '10', '1', 2, '', '', ''),
(8, 3, 'The standard poll is crap', '', 100, 'width', 0, 0, 0, 0, '10', '1', 3, '', '', ''),
(9, 3, 'I''ll try StaticXT, too', '', 100, 'width', 0, 0, 0, 0, '10', '1', 4, '', '', '');";
$updatequery[3]->upversion = "0";
$updatequery[3]->text = "Insert Sample Poll (Options)";
$updatequery[4]->query = "INSERT INTO `#__pollxt_menu` (`pollid`, `menuid`) VALUES
(1, 0);";
$updatequery[4]->upversion = "0";
$updatequery[4]->text = "Insert Sample Poll (Menu)";
$updatequery[5]->query = "UPDATE `#__pollxt_config` SET `version` = '2.00.06' WHERE `id` =1;";
$updatequery[5]->upversion = "99";
$updatequery[5]->text = "Update Version Info";
?>
