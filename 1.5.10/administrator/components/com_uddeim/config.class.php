<?php
if (!(defined('_JEXEC') || defined('_VALID_MOS'))) { die( 'Direct Access to this location is not allowed.' ); }
if (defined('_uddeConfig')) {
 return true;
} else {
 define('_uddeConfig', 1);
 class uddeimconfigclass {
  var $version = '1.1';
  var $cryptkey = 'uddeIMcryptkey';
  var $datumsformat = 'j M, H:i';
  var $ldatumsformat = 'j F Y, H:i';
  var $emn_sendermail = 'contact@openfoundry.org';
  var $emn_sendername = 'WhosWho Messaging';
  var $sysm_username = 'System';
  var $charset = 'ISO8859-1';
  var $mailcharset = 'UTF-8';
  var $emn_body_nomessage = '';
  var $emn_body_withmessage = '';
  var $emn_forgetmenot = '';
  var $export_format = '';
  var $showtitle = '私人訊息';
  var $templatedir = 'default';
  var $quotedivider = '__________';
  var $blockgroups = '';
  var $pubblockgroups = '';
  var $hideusers = '62';
  var $pubhideusers = '62';
  var $ReadMessagesLifespan = 36524;
  var $UnreadMessagesLifespan = 36524;
  var $SentMessagesLifespan = 36524;
  var $TrashLifespan = 2;
  var $ReadMessagesLifespanNote = 0;
  var $UnreadMessagesLifespanNote = 0;
  var $SentMessagesLifespanNote = 0;
  var $TrashLifespanNote = 1;
  var $adminignitiononly = 1;
  var $pmsimportdone = 2;
  var $blockalert = 0;
  var $blocksystem = 0;
  var $allowemailnotify = 1;
  var $notifydefault = 2;
  var $popupdefault = 0;
  var $allowsysgm = 0;
  var $emailwithmessage = 1;
  var $firstwordsinbox = 40;
  var $longwaitingdays = 75;
  var $longwaitingemail = 1;
  var $maxlength = 2500;
  var $showcblink = 1;
  var $showcbpic = 1;
  var $showonline = 1;
  var $allowarchive = 0;
  var $maxarchive = 100;
  var $allowcopytome = 1;
  var $trashoriginal = 1;
  var $perpage = 8;
  var $enabledownload = 0;
  var $inboxlimit = 0;
  var $showinboxlimit = 0;
  var $allowpopup = 0;
  var $allowbb = 2;
  var $allowsmile = 1;
  var $animated = 0;
  var $animatedex = 0;
  var $showmenuicons = 1;
  var $bottomlineicons = 1;
  var $actionicons = 1;
  var $showconnex = 1;
  var $showsettingslink = 1;
  var $showabout = 0;
  var $emailtrafficenabled = 1;
  var $getpiclink = 0;
  var $connex_listbox = 1;
  var $forgetmenotstart = 1233940356;
  var $realnames = 0;
  var $cryptmode = 0;
  var $modeshowallusers = 0;
  var $useautocomplete = 0;
  var $allowmultipleuser = 1;
  var $connexallowmultipleuser = 1;
  var $allowmultiplerecipients = 1;
  var $showtextcounter = 1;
  var $allowforwards = 1;
  var $showgroups = 0;
  var $mailsystem = 0;
  var $searchinstring = 1;
  var $maxrecipients = 0;
  var $languagecharset = 1;
  var $usecaptcha = 4;
  var $captchalen = 4;
  var $pubfrontend = 0;
  var $pubfrontenddefault = 0;
  var $pubmodeshowallusers = 1;
  var $hideallusers = 0;
  var $pubhideallusers = 0;
  var $unblockCBconnections = 1;
  var $CBgallery = 0;
  var $enablelists = 0;
  var $maxonlists = 100;
  var $timedelay = 0;
  var $pubrealnames = 0;
  var $pubreplies = 0;
  var $csrfprotection = 0;
  var $trashrestriction = 0;
  var $replytruncate = 0;
  var $allowflagged = 1;
  var $overwriteitemid = 0;
  var $useitemid = 0;
  var $timezone = -8;
  var $pubuseautocomplete = 0;
  var $pubsearchinstring = 1;
  var $mootools = 1;
  var $autoresponder = 0;
  var $autoforward = 0;
  var $rows = 10;
  var $cols = 60;
  var $width = 0;
  var $enablefilter = 0;
  var $enablereply = 0;
  // temporary variables
  var $flags = 0;
 }
}