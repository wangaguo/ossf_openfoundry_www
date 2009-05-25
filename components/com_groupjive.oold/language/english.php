<?php

// --------------------------
// GLOBAL - global strings are used throughout GroupJive
// --------------------------

define('GJ_CREATEGROUP','<strong>Create your OWN Group!</strong>');
define('GJ_BACK','<~Go Back');


/* please not usage of Member and Group Members is for singular and/or plural instances when needed. */
define('GJ_MEMBER','Member');
define('GJ_MEMBERS','Group Members');
define('GJ_CURRENT_USER','Members');

define('GJ_USERNAME','Username');
define('GJ_REGISTERED','Presence Online');
define('GJ_USERONLINE','ONLINE');
define('GJ_USEROFFLINE','OFFLINE');

define('GJ_GROUPNAME','Group name');
define('GJ_GROUPDESCR','About group');
define('GJ_CATEGORY_GR','Group category');
define('GJ_TYPE','Group type');
define('GJ_LOGO','Group logo');

define('GJ_DELETE','Delete');

define('GJ_OPEN','Open to all');
define('GJ_APREQUIRED','Approval to join');
define('GJ_PRIVATE','Invite to join');

define('GJ_MAIL_OWNER','Email Group Manager');
define('GJ_ERROR_MAIL_OWNER','email Group Manager?');

define('GJ_SUBMIT','Submit');
define('GJ_REQ','Required');
define('GJ_TITLE','User groups');
define('GJ_SHOWALL','Show all existing groups');
define('GJ_PAGE','Pages');
define('GJ_BACK_MAIN_PAGE','Return to group main page');


define('GJ_CREATEGROUP_PATH','Create new group');

define('GJ_ERROR_INTRO',' Please review this message : ');
define('GJ_NO_GROUP_WITH_THAT_ID','No group with the given ID exists.');
define('GJ_ERROR_JOIN_GROUP_L1','Hello,  This group approves it\'s members. <br /> You are not currently a member of this group. ');
define('GJ_ERROR_JOIN_GROUP_L2',' You can request to join the group. <br /> The manager will review your request and respond.');


// Show Overview (showoverview)
define('GJ_GROUP_CATEGORY','Categories of Community Groups');

// Show Category (showcat)
define('GJ_SIMPLE_WELCOME','WELCOME TO GROUPS');
define('GJ_SIMPLE_DESCR','You can visit groups, join groups or create your own.');
define('GJ_CUR_GROUPS','Online People Groups');
define('GJ_YOU_ARE_ADMIN','You are admin of this group!');
define('GJ_ALREADY_MEMBER','You are a member of this group!');

define('GJ_CREATED','Created');

// Search
define('GJ_SEARCH_GROUP','Search for a group...');
define('GJ_SEARCH','Search');
define('GJ_SEARCH_RESULTS','Here are your search results');
define('GJ_NO_RESULTS','No groups found using the search words you entered');

// Group creation responses
define('GJ_GROUP_WAS_CREATED','The group was created successfully.');

define('GJ_CAT_HASNT_G','No viewable groups! Please create Group if needed <br />
or contact admin to publish Group(s).');


// --------------------------
//  MESSAGES: DEFAULT MESSAGES AND ERROR MESSAGES
// --------------------------
define('GJ_PLEASE_LOGIN', 'Login is the first step, then you can rejoin Groups.');
define('GJ_NO_GROUPS','No groups are viewable. You may need to login, create or join Group.');
define('GJ_NOTAUTH','Hello. Are you logged in?<br />Please check your login and then your Group membership.');
define('GJ_ONLY_CURRENT','Error! Only logged-in users who are members may access.');

define('GJ_NO_CAT','Categories have not been not created yet! <br />Please add categories for your groups in admin module.');
define('GJ_GROUP_NOT_EXISTS','Error! Access to this Group<br /> is not available right now!<br />
 Maybe you are not a member of the Group? <br />... or maybe the Group needs activation by the Admin?<br /><br />
 <small><em>Users who have just applied for a Group membership will receive this error <br />until the Moderator responds to your request.</em></small>');


define('GJ_NO_USERS_FOUND', 'No users found');
define('GJ_NOT_VALID_EMAIL','That is not a valid e-mail address');
define('GJ_MAILS_WERE_SENT','Email was sent successfully.');
define('GJ_MAILS_WERE_NOT_SENT','Alert !!! - sorry, your email was not sent. Please contact Admin.');

define('GJ_FILL_REQ','Error! Please, fill out all required fields.');

define('GJ_PAGE_NOT_EX','The page does not exist');


// --------------------------
// GROUP PAGES
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_FOUNDED','Founded');
define('GJ_CREATOR','Manager');

define ('GJ_NEWESTMEM', 'New Members');

define ('GJ_LATESTBULLETIN', 'Latest bulletin');

define ('GJ_LATESTFORUM', 'Latest forums');
define('GJ_DATE','Date');


// Group Function Navigation

define('GJ_GROUP_MENU','Menu');
define('GJ_GROUP_INFO','Info');
define('GJ_GROUP_LOGO','Logo');



define('GJ_GROUP_FUNCTIONS','Group Activities');
define('GJ_GROUP_BUL','Group Bulletins');
define('GJ_GROUP_EVENT','Group Events');
define('GJ_GROUP_FORUM','Group Forum');
define ('GJ_BACKTGROUP', 'Return to Group');
define ('GJ_BACKTGROUPVIEW', 'Return to Group View');


// Join, Invite and Unjoin Groups
define('GJ_SIGN','Join This Group');
define('GJ_INVITE','Invite People (+)');
define('GJ_INVITE_PEOPLE','Invite a registered user :');
define('GJ_LEAVE_GROUP','Unjoin group (-)');


//Open to join
define('GJ_WELCOME','Welcome! You have successfully joined the group!');


// Email Confirmation to Users/Moderators about Users *JOINING* Groups
define('GJ_NEW_MEMBER','Hello %to_name,<br />
<br />
<br />
This email is your confirmation that <em>%from_name</em> has joined the group <strong>%group_name</strong>.<br />
<br />
<br /><big>To all new users... Welcome to the Group!</big><br/>
<br />
<br />
<br />
Thank you and welcome to the community.<br />
<br />
<br />
<br />
&nbsp;<br />
<small>- PLEASE NOTE:<br />
- OPEN Groups: Users joining Open groups are immediately active.<br />
- APPROVAL Groups: Users applying to Approval groups please stand by. Group Moderators reply to and activate requests as quickly as possible.<br />
- Thank you.</small><br />
<br />
- - - - - - <em><small>end announcment</small></em> - - - - - - <br />
<em><small>* This message was generated automatically.</small></em>
');

//Approval to join
define('GJ_YOU_ARE_SIGN_ALREADY','You are already in that group! Maybe your account has not been activated yet? Contact the group owner');

define('GJ_WELCOME2','Thank you... the group owner must approve <em>(and enable your login)</em>. Your request to join has been sent.');
define('GJ_PENDING','Your request is pending approval.');

define('GJ_INVITE_ONLY','Membership through invite only');


// Invite to join
define('GJ_FR_NAME','Contact by name (must be registered!)');
define('GJ_FR_EMAIL','Or invite by e-mail address (for non-site members)');

define('GJ_USER_NOT_EXISTS','Error! The user does not exist.');
define('GJ_USER_IN_GROUP','Error! The user is already a member of that group (they might have been invited already, or their account might not be active yet).');

define('GJ_INVITE_WAS_SENT','Invitation message was sent!');
define('GJ_YOU_WAS_INVITED','You are invited');

define('GJ_INVITE_NOT_EXIST','Error! Invitation record cannot be viewed. <br />
Please confirm you are logged in and try again.');


// Invitation Email to member
define('GJ_HELLO','Hello %to_name,<br />
<br />
<br />
You have received an invitation to join a group from the member <em>%from_name</em>.
<br/>
<br/> You must <em>click this link <big>%link.</big></em> to activate your membership and join the group. The link is the only way to activate your membership. If you visit the group (without activating) you must to return to this email to join.<br/>
<br/>
<br/><strong>%group_name</strong> is the group that has invited you. Clicking the group name permits visiting the group "ONLY" when the group is the *Open* group type. Visiting the group does not join you to the group or activate your membership.<br/>
<br/>
<br/>
------- <em><small>end invitation</small></em> ------- <br />
<em><small>This message was generated automatically.</small></em>
');


// Invitation Email to non-member
define('GJ_INVITE_NONMEMBER','Hello,<br />
<br /> This email is an <strong>invitation</strong>.
<br />
<br />
You have been invited by <em>%from_name</em> to join a Group.
<br />
<br />
To visit this group, please click this link: <big>%group_name</big>. Please note you must <em> log in</em> prior to joining Groups you have been invited to!
<br />
<br />
Online groups share common interests such as discussion forums, group events, bulletin boards and more. You can return to visit %link anytime on the web at %s .
<br />
<br />
Thank you.
<br />
<br />
<br />
------- <em><small>this is an online invitation</small></em> ------- <br />
<em><small>This message was generated automatically.</small></em>
');


// Invitation PMS
define('GJ_HELLO_UDDEIM','Hello, %to_name, you were invited by %from_name in %group_name. To joing this group, please go to %link.');
define('GJ_HELLO_JIM','Hello, %to_name. You have been invited by %from_name in %group_name. If you want to join that group, please copy the following url and paste into the browser window.
 %link');


// Responses to Unjoin request
define('GJ_DELETE_SELF_CONFIRM','Do you really want to leave this group?');
define('GJ_U_LEFT','<big><em>You have left the group successfully</em></big>');



// --------------------------
// GROUP MODERATOR
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

// Group Moderator Navigation
define('GJ_INACTIVE_USERS','ACTIVATE <em>pending users</em>');
define('GJ_EDIT_GROUP_INFO','EDIT <em>group settings</em>');
define('GJ_MAIL_GROUP', 'EMAIL <em>all in group</em>');
define('GJ_TRANSFER_OWNER', 'TRANSFER <em>to new owner</em>');
define('GJ_DELETE_GROUP','DELETE <strike>this group</strike>');

// Activate pending users (tmpl inactive)
define('GJ_INACTIVE_NAME','Pending User(s)');
define('GJ_INACTIVE_STATUS','Activation Status');
define('GJ_INACTIVE_ACTIONS','Moderator Actions');

define('GJ_MAKE_ACTIVE','Activate User!');

// Email the Group
define('GJ_NO_INPUT', 'No input made');
define('GJ_MAIL_NO_SUBJECT','No subject');
define('GJ_MAIL_NO_BODY', 'Message cannot be empty');
define('GJ_MAIL_SUBJECT','Subject');
define('GJ_MAIL_BODY','Message Body');
define('GJ_MAIL_CC_MOD','Check this box to send a copy to Moderator');


// Group Moderator Functions
define('GJ_MODER_FUNCTION','Managers Tasks');
define('GJ_MODER_PROFILE','Manager Profile: ');
define('GJ_MODER_FUNC_BLANK','...this menu empty <br /> if user not Manager');
define('GJ_NOT_MODER','Error! You are not a moderator of this group.<br /> ...or you are not logged in?');


define('GJ_NEW_USERS_NEED_ACTIVATION','New users have joined your group - please activate them.');

define('GJ_NOT_INACTIVE','All pending users have been Activated.');

define('GJ_IS_ACT_NOW','User is now active.');
define('GJ_IS_INACT_NOW','User is now inactive.');
define('GJ_MAKE_INACTIVE','Make inactive');

define('GJ_GROUP_WAS_CREATED_APP','The group was created successfully. Please wait for Administrator approval.');

define('GJ_GROUP_INFO_WAS_EDITED','Group details were successfully edited!');

define('GJ_TRANSFER_OWNER_HEADER','Transfer Group to NEW Moderator :');
define('GJ_TRANSFERRED','The ownership of this Group has been transferred!');
define('GJ_TRANS_TO_MBR_RQD','Sorry, intended user must be a member of the group!');

define('GJ_DELETE_U_CONFIRM','Please Confirm you want to DELETE this user?');
define('GJ_USER_WAS_DELETED','The user was deleted from your group successfully!');
define('GJ_DELETE_G_CONFIRM','Please Confirm you want to DELETE this group?');
define('GJ_GROUP_WAS_DELETED','The group was deleted successfully!');

define('GJ_MES_WAS_EDITED','The Bulletin was edited successfully.');
define('GJ_MES_WAS_DELETED','The Bulletin was Deleted.');
define('GJ_MESSAGE_NOT_EXISTS','Error! This Bulletin does not exist, <br />... or has been deleted!');


//ORPHAN?
define('GJ_GO_TO','Take me to my new group!');
//ORPHAN?

//ORPHAN?
define('GJ_GROUP_APPROVAL','Thank you. The group will now be reviewed by the site administrator for approval.');
//ORPHAN?

//ORPHAN?
define('GJ_GROUPNAME_EXISTS','A group with that name already exists! Please create again using a new name.');
//ORPHAN?

//ORPHAN?
define('GJ_STANDARD_FUNCTION','Standard Functions');
//ORPHAN?

//ORPHAN?
define('GJ_U_G','Match with that user and group was not found.');
//ORPHAN?


// --------------------------
// BULLETIN FUNCTIONS
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_MOSTRECENT_BUL','(most recently posted)');
define('GJ_ARCHIVE','>> Go To the complete archive of');
define('GJ_ADD_POST_IN_BUL','Add new post in group bulletin');
define('GJ_MESSAGE_WAS_ADDED','The message was succefully added in the group bulletin');
define('GJ_EDIT','Edit this Bulletin');


// Bulletin view
define('GJ_HTML_NOT_ALLOW','<em>HTML content not allowed in bulletin</em>');
define('GJ_AUTHOR','Author');
define('GJ_COMPOSE_BULLETIN','Compose Your Own Bulletin :');
define('GJ_SUBJECT','Bulletin');
define('GJ_SUBJECT_TITLE','Bulletin Title');
define('GJ_LEAVE_MESSAGE','Write your bulletin');
define('GJ_BY','by');
define('GJ_POST','Post');
define('GJ_MESSAGE','Message');

define('GJ_NO_MESSAGE','<em>There are no messages in group bulletin</em>');
define('GJ_ONLY_MEMBERS_CAN_POST', 'Only group members can post a bulletin.');
define('GJ_MES_COULD_NOT_DELETED', 'Bulletin could not be deleted!');
define('GJ_NO_BULLETIN_AVAILABLE','The Bulletinboard is not available.');


define('GJ_BULLETIN_LINKTEXT','Click HERE to view all bulletins online, make comments, and more...~>');

// Bulletin Email
define('GJ_NEW_BUL','Hello %to_name, <br />
<br />
<strong>%from_name</strong> has posted a new bulletin in the group <big><em>%group_name</em></big>. <br />
&nbsp;<br />
&nbsp;<br />
<em>= = =  New Bulletin = = =</em><br />

<br />
%p
<br />
<br />
- - - - <em><small>end bulletin</small></em> - - - - <br />
&nbsp;<br />
&nbsp;<br />
&nbsp;<br />
Link to Bulletin: <br />
<big>%link </big><br />
<br />
<em><small>* This message was generated automatically.</small></em>');





// --------------------------
// EVENT FUNCTIONS
// --------------------------
define('GJ_LATEST_EVENTS','Latest Events');
define('GJ_NO_EVENTS','<em>There are no events yet.</em>');
define('GJ_EVENTS_ONLY_FOR_MEMBERS', 'The events are for members only.');

// --------------------------
// FORUM FUNCTIONS
// --------------------------

define('GJ_NO_FORUM_POSTS','<em>There are no forum posts yet.</em>');



// --------------------------
// ADMINISTRATOR
// --------------------------

define('GJ_GR_CUR_CAT','Current Categories');
define('GJ_ADD','Add category');
define('GJ_CAT_WAS_W','Category was Added');
define('GJ_CAT_WAS_EDITED','Category was Edited');
define('GJ_WAS_DELETED','Category was Deleted');
define('GJ_CAT_NOT_EX','Category does not exist');
define('GJ_CAT_AL_EXF','Category with that name already exists');

define('GJ_NO_CAT_SELECTED', 'No category selected');
define('GJ_NO_CAT_AVAILABLE', 'No published category available - please create at least one first.');


define('GJ_NO_GROUPNAME', 'Groupname is empty');
define('GJ_GR_WAS_ACTIVED','Group(s) now Activated');
define('GJ_GR_WAS_DEACTIVED','Group(s) has been Banned');
define('GJ_GR_WAS_DEL','Group(s) was succefully Deleted!');
define('GJ_GR_N_EX','Group does not exist');

define('GJ_ACTIVITY','Group activity');
define('GJ_INVITED','Group invitation');

define('GJ_NO_ADMIN','No administrator assigned');
define('GJ_FILL_ALL','Please fill all fields');

define('GJ_SET_UPD','Settings Updated');

// ORPHAN?
define('GJ_INT_T','Values of fields groups on page, messages on frontpage should be integer');
// ORPHAN?

// Admin email notification
//TRANSLATORS - PLEASE NOTE THE USE OF QUOTES "" AND THE \n TO CREATE LINE BREAKS IN THIS EMAIL ONLY. THANK YOU
define('GJ_NEWGROUPCREATED',"Hello Group Administrator \n
\n
A new group has been created in GroupJive!\n
Please visit the web site to view new GroupJive Group(s) and complete any administrative tasks.\n
Thank you.
\n
\n
------- end admin notification ------- \n
This message was generated automatically.");



//------------------------------
//   MODULE LANGUAGE STRINGS
//------------------------------
define('GJ_MODULE_NO_GROUPS','You are not a member of any group.');
define('GJ_MODULE_MEMBERS', 'Members');
define('GJ_MODULE_MEMBER', 'Member');

define('GJ_ERROR_STATUS_ALREADY_SET', 'Status already set!');
define('GJ_INVITE_LINKTEXT','the activation page');
?>
