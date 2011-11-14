CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_email_settings` (
  `email_settings_id` int(10) NOT NULL auto_increment,
  `email_settings_activ` enum('0','1') NOT NULL default '0',
  `email_settings_to` varchar(250) NOT NULL default '',
  `email_settings_from` varchar(250) NOT NULL default '',
  `email_settings_subject` varchar(250) NOT NULL default '',
  `email_settings_content` text NOT NULL,
  PRIMARY KEY  (`email_settings_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_answer_columns` (
  `ac_id` int(11) NOT NULL auto_increment,
  `q_id` int(11) NOT NULL default '0',
  `value` varchar(250) NOT NULL default '',
  `m_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ac_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_answers` (
  `a_id` int(10) NOT NULL auto_increment,
  `q_id` int(10) NOT NULL default '0',
  `value` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`a_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_config` (
  `user_can_create_survey` tinyint(4) NOT NULL default '0',
  `email_approved_survey_subject` varchar(250) NOT NULL default '',
  `email_approved_survey` text NOT NULL,
  `menu_id` bigint(10) NOT NULL default '0',
  `general_option` varchar(255) NOT NULL default '',
  `general_date` SMALLINT NOT NULL default '1'	
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_menu_heading` (
  `m_id` int(11) NOT NULL auto_increment,
  `q_id` int(11) NOT NULL default '0',
  `value` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`m_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_pages` (
  `page_id` bigint(15) NOT NULL auto_increment,
  `s_id` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `ordering` int(5) NOT NULL default '0',
  `show_title` tinyint(1) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `images` text NOT NULL,
  PRIMARY KEY  (`page_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_questions` (
  `q_id` int(10) NOT NULL auto_increment,
  `s_id` int(10) NOT NULL default '0',
  `title` text NOT NULL,
  `type` varchar(10) NOT NULL default '0',
  `page_id` int(10) NOT NULL default '0',
  `required` tinyint(1) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `other_field` tinyint(1) NOT NULL default '0',
  `other_field_title` varchar(100) NOT NULL default '',
  `ordering` smallint(3) NOT NULL default '0',
  `orientation` varchar(20) NOT NULL default '',
  `style` varchar(250) NOT NULL default '',
  `description` text NOT NULL,
  `start_date` int(10) NOT NULL default '0',
  `end_date` int(10) NOT NULL default '0',
  `random_a` tinyint(1) NOT NULL default '0',
  `random_c` tinyint(1) NOT NULL default '0',
  `bounded` tinyint(1) NOT NULL default '0',
  `minvalue` int(11) NOT NULL default '0',
  `maxvalue` int(11) NOT NULL default '0',
  `created_date` int(10) NOT NULL default '0',
  `constant` int(10) NOT NULL default '0',
  `show_results` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`q_id`)
) TYPE=MyISAM ;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_result` (
  `r_id` bigint(15) NOT NULL auto_increment,
  `q_id` int(11) NOT NULL default '0',
  `a_id` bigint(11) NOT NULL default '0',
  `m_id` int(11) NOT NULL default '0',
  `ac_id` int(11) NOT NULL default '0',
  `session_id` bigint(15) NOT NULL default '0',
  `value` varchar(250) NOT NULL default '0',
  PRIMARY KEY  (`r_id`)
) TYPE=MyISAM ;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_result_text` (
  `rt_id` bigint(15) NOT NULL auto_increment,
  `q_id` int(11) NOT NULL default '0',
  `value` text NOT NULL,
  `session_id` bigint(15) NOT NULL default '0',
  PRIMARY KEY  (`rt_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_session` (
  `session_id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(15) NOT NULL default '0',
  `s_id` int(11) NOT NULL default '0',
  `ip` varchar(30) NOT NULL default '',
  `played_time` int(10) NOT NULL default '0',
  `completed` tinyint(1) NOT NULL default '0',
  `last_page_id` bigint(10) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`session_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_skip_logics` (
  `sk_id` int(10) NOT NULL auto_increment,
  `s_id` int(10) NOT NULL default '0',
  `page_id` int(10) NOT NULL default '0',
  `title` varchar(250) NOT NULL default '',
  `q_id` int(10) NOT NULL default '0',
  `a_id` varchar(100) NOT NULL default '0',
  `logic` varchar(10) NOT NULL default '',
  `compare` varchar(20) NOT NULL default '',
  `action` varchar(10) NOT NULL default '',
  `value` varchar(250) NOT NULL default '',
  `page_target` bigint(15) NOT NULL default '0',
  `ordering` int(10) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`sk_id`)
) TYPE=MyISAM;

#$$$$#

CREATE TABLE IF NOT EXISTS `#__ijoomla_surveys_surveys` (
  `s_id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL default '0',
  `title` varchar(250) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `img_url` varchar(250) NOT NULL default '',
  `start_date` int(10) NOT NULL default '0',
  `end_date` int(10) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '0',
  `show_result` tinyint(1) NOT NULL default '0',
  `open` tinyint(1) NOT NULL default '0',
  `created_date` int(10) NOT NULL default '0',
  `ordering` int(5) NOT NULL default '0',
  `num_questions` tinyint(2) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `show_on_results` tinyint(1) NOT NULL default '0',
  `form_target` varchar(30) NOT NULL default '',
  `end_page_title` varchar(250) NOT NULL default '',
  `end_page_description` text NOT NULL,
  `redirection_url` varchar(250) NOT NULL default '',
  `redirection_msg` varchar(250) NOT NULL default 'Thank You',
  `images` text NOT NULL,
  `access` int(11) NOT NULL default '0',
  `show_popup` tinyint(1) NOT NULL default '0',
  `popup_show_freq` bigint(10) NOT NULL default '7',
  `popup_width` smallint(3) NOT NULL default '300',
  `popup_height` smallint(3) NOT NULL default '250',
  `popup_content` text NOT NULL,
  `popup_title` varchar(250) NOT NULL default '',
  `popup_content_style` varchar(250) NOT NULL default '',
  `popup_title_style` varchar(250) NOT NULL default '',
  `email_send` enum('0','1','2') NOT NULL default '0',
  `email_send_to` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`s_id`)
) TYPE=MyISAM ;
