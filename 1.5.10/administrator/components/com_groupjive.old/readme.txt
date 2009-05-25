               # # - GROUPJIVE - # #


+----------------------------------------------------+
+----------------------------------------------------+
|                READ ME'S EXPLAINED                 |
| readme.txt explains installation and functions     |
| readme_eventlist.txt explains eventlist integration|
| readme_fireboard.txt explains fireboard integration|
| readme_features.txt is a list of GroupJive features|
| readme_templates.txt explains design/design hacks  |
+----------------------------------------------------+
+----------------------------------------------------+



GroupJive is a social networking component that creates Groups for users in
the Joomla CMS! GroupJive can be used to enhance an existing site or as the
basis around which to build a social network.

REQUIREMENT: GroupJive requires the presence of Community Builder or Community
Builder Enhanced user management components. To use GroupJive, Community Builder
-OR- Community Builder Enhanced must be installed!

GroupJive provides all registered Joomla! users the ability to create groups,
join together with other users and generate content that is unique to their
Group(s). GroupJive supports a group bulletin with WYSIWYG options, compatibility
with almost all Joomla! PMS systems, a Plugin for Community Builder, a series of
Modules that enhance the GroupJive user experience and direct integration between
Groups and various Joomla! components which then generate their content inside
the GroupJive Groups. GroupJive currently integrates with:

______ Joomla! 1.0.x series ______
+ Joomla! 1.0.13 stable
+ Community Builder 1.1 stable
+ Community Builder Enhanced
+ FireBoard 1.0.3 stable
+ EventList 0.8.10
+ JomComment 1.8.10
+ Personal Messaging (various PMS components)


______ Joomla! 1.5 series ______
+ Joomla! 1.5
+ Community Builder 1.1 stable
+ FireBoard 1.0.3 stable
+ Personal Messaging (various PMS components)


Groups are based on three privilege levels which determine a users ability to
access and join groups:

* Open to all - (open to all registered users)
* Approval to join - (requires Moderator to approve membership)
* Invite to join - (membership is by invitation only)

To learn more about GroupJive... please read through all readme's in this
installation package.


!! GroupJive is "not" compatible with current versions of Mambo. !!

!! Please post feedback in the Forums at http://groupjive.org
!! Please post BUG reports to http://joomlacode.org/gf/project/groupjive !!



Here we go >>>


- - - - - - - -  READ ME  - - - - - - - -
*********** updated 2007/11/4 ***********


GroupJive is a Group social networking component enabling users to create Groups
with other users.

* Users can create groups (from the frontend)
* Admins can create groups (from the backend)

Groups are based on three privilege levels which determine a users ability to access
and join groups:

* Open to all
* Approval to join
* Invite to join

Open groups can be joined by anyone. Approval requires that a moderator must approve
each new member. Invite is designed so that a User must be invited to join a Group.

Features support numerous mods, compatibility with almost all Joomla! PMS systems,
a group bulletin with WYSIWYG options, a CB plugin and integration with components
like EventList, FireBoard and more.




- - - - - - - - INSTALLATION - - - - - - - -
*********** please read carefully ***********





PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!!
PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!!



        *** GroupJive requires MySQL ver 4.1 or higher ***
        *** You must UPGRADE if you user a lower version ***

*** GroupJive requires one of the following two Profile components ***
            *** Community Builder be installed ***
                            -OR-
              *** Community Builder Enhanced ***

Please see GroupJive *Installation and Upgrade* Forums http://groupjive.org
for links to these Joomla! User Profile / User Management components.



PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!!
PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY !!!  





*** FOR UPGRADES.... Read this section
*** FOR NEW INSTALLS... Please scroll to *Installing GroupJive as NEW*

|####################################################|
+----------------------------------------------------+
|  UPGRADING GROUPJIVE ON "EXISTING" INSTALLATIONS   |
+----------------------------------------------------+
|####################################################|


To upgrade GroupJive please:

1.) GO TO the Administrator module (backend) of your Joomla installation
2.) UNPUBLISH all existing GroupJive menu links from Joomla menus
3.) DELETE all existing menu links from Joomla menus
4.) DELETE the GroupJive CB Plug in (if it exists). This will also delete
    the GroupJive CB [tab]
5.) UNINSTALL GROUPJIVE
    - GO TO Installers > Components
    - Select the GroupJive radio button (o)
    - CLICK Uninstall button (top right)
6.) Use your FTP file manager to to confirm directories/files are gone
7.) INSTALL "new" com_groupjive component
8.) RE-INSTALL CB Plug-in (and publish)
9.) RE-INSTALL all mod_groupjive modules you use (and publish)
10.) RE-CREATE and PUBLISH menus for the GroupJive component


NOTES:
*** When you uninstall GroupJive the database tables remain, they are not dropped (DELETED)
*** GroupJive has an install script that upgrades your tables if needed
*** You should always make a backup before you upgrade
*** Various uninstall issues with Joomla! itself can cause issues
*** Always have your backups ready and available to restore


+----------------------------------------------------+
|   About the "unique_key" message during upgrade    |
+----------------------------------------------------+


This section discusses the "unique_key" message that appears in the list of 
items completed (and items "needing to be completed") during GroupJive installation.

This section is to address "the unusual" circumstance that you must create
(or delete and re-create) a "unique_key". THIS SECTION IS RARELY NEEDED BUT
INCLUDED FOR THOSE FEW TIMES WHEN THE CIRCUMSTANCES APPLY.

*** This section also discusses working directly with your MySQL database.

*** please make a backup of your data before you manipulate your database
*** directly with phpMyAdmin or any other database interface

                     "unique_key"

GroupJive uses a multi-column-key to make sure that only one entry
per group / user is added to the usertable. If you completing a "fresh install"
you will notice a red line during installation named

      "TODO check this --- Index "unique_key" not found"

This happens if the key:

1.) does NOT exist
2.) the database DOES NOT execute the statement 

*IF you receive the "TODO check this --- Index "unique_key" not found" message,
then then Groupjive installation script will then try to create the index for you.

*IF you get the error message "TODO check this --- Error while alter table #__gj_users".
Then you have work with your database directly because: The creation of the key FAILED!

TO CREATE THE UNIQUE KEY PLEASE CHECK THE FOLLOWING:

- Open phpMyAdmin and go to your Joomla database

- does the table #__gj_users exist? (if not try to install Groupjive again)

- does the key "unique_key" exist? (if not try to create the key manually)


TO CREATE THE KEY MANUALLY:

- SQL 1 - execute this statement in phpMyAdmin ------------------------------
ALTER TABLE `jos_gj_users` 
ADD UNIQUE `unique_key` ( `id_user` , `id_group` )
-----------------------------------------------------------------------------


ABOUT DUPLICATE "unique_key" ENTRIES AND THE FAILURE OF "SQL 1" STATEMENT

IF manual creation fails you must check your database to see if ***duplicates exist***.

This can be done with this SQL statment:

- SQL 2 - execute this statement in phpMyAdmin ------------------------------ 
SELECT MAX(id), COUNT(*)
FROM `jos_gj_users`
GROUP BY id_user, id_group
HAVING COUNT(*) > 1;
-----------------------------------------------------------------------------


WHAT TO DO IF DUPLICATES APPEAR?

The above statement "SQL 2" is designed to reveal duplicate "unique_key(s)".
* if any appear, you must delete this lines from MySQL
* DELETE the duplicate entries by executing the following statement:

- SQL 3 - execute this statement in phpMyAdmin ------------------------------
DELETE FROM jos_gj_users 
WHERE id IN (
--***insert here comma separated list of ids***--
);
-----------------------------------------------------------------------------


FINALLY... 

you can execute "SQL 2" STATEMENT again to check if there are still duplicates.

*IF an empty result is returned, you must then complete the process and
execute the "SQL 1" STATEMENT

TO CREATE THE NEW "unique_key"

*** Please return to the text above named "TO CREATE THE KEY MANUALLY:" and
*** Execute the SQL 1 STATEMENT


*IF SQL 1 is executed without errors you should have no problems with your user table.

GroupJive has been upgraded and you are ready for Groups!







|####################################################|
+----------------------------------------------------+
|      INSTALLING GROUPJIVE AS "NEW" COMPONENT       |
+----------------------------------------------------+
|####################################################|


GroupJive installs and uninstalls as a Joomla! component.

To install GroupJive

1.) GO TO joomla/administrator
2.) GO TO Installation
3.) GO TO Components
4.) [Browse] for the the com_groupjive.zip install package
5.) CLICK [Upload File and Install]

Each time the site Admin installs or uninstalls GroupJive, a script checks
your database tables to confirm the required fields are present and the
values work with the version of GroupJive you are installing.

If no error is cast, the installation is successful.

6.) click Continue
7.) go to Components
8.) select GroupJive
9.) select Settings to configure

*** About Permanent Un-Install. Data is not deleted from your database when
you uninstall GroupJive or when you reinstall. Removing GroupJive is achieved
using the administration panel. When un-installing the component the directories
and files are removed. However, you must manually delete the GroupJive tables
from your database if you choose to stop using GroupJive.









+----------------------------------------------------+
|                   CONFIGURATION                    |
+----------------------------------------------------+

>> CONFIGURING GROUPJIVE


To configure GroupJive go to Components > GroupJive > Settings.
You will see 5 tabs:

* Global Setup
* Front End
* Integration
* WYSIWYG
* AJAX


There are many settings available here to configure. Please review and
setup according to your preferences.



+----------------------------------------------------+
|    CREATING CATEGORIES AND GROUPS  (BackEnd)       |
+----------------------------------------------------+

>> CATEGORY CREATION (Categories Manager)

In order to create groups, you must create at least one category.
To create a Category in the backend (administrator)

1.) Go to Components > GroupJive > Catgories Manager
2.) click "New" to Name a new Category and Save it

You can assign a seperate Adminisrator to each Category you create.
Access to Categories can be controlled using the built in Joomla!
settings of Public, Registered or Special.

The Group Types that can be created in a Category are:

* Open to all
* Approval to join
* Invite to join

To determine what Group types can be in a Category you simply turn the
ability to create that Group type. Settings are either ON (Yes) or OFF (No).

You can also upload a category picture.

REMEMBER: **Publish** your Categories or they will not appear in the
front end!


>> GROUP CREATION (Groups Manager)

Groups can be created in the front end - usually by "registered" users.
- The Admin must FIRST enable Group creation for FrontEnd users
  for this to be possible.
- The Admin can also disable Group creation from the FrontEnd
  if they choose to Administer Group creation from Backend only.
When creating groups from the frontend, the creator will automatically
become the group moderator.

If Admins create groups in the backend, the Admin will need to select a moderator 
(from your user base) to moderate each group that is created.

Group Settings include:

Group Name, Description, Category in which to place the Group, 
Group Type (Open, Approval, Invite), Published (Yes, No),
Administrator (select whom from users), Group Logo (image upload)
.

>> MEMBER MANAGER (user add/remove/invite utility)

GroupJive Member Manager enables the Admin to complete common user manangment
tasks without having to search through Groups in the FrontEnd to find which
Groups a user may have joined. Member Manager enables 3 basic functions to 
simplify administration. These are:

- Invite members
- Add members
- Remove members

Member manager also includes a Username filter (to search large userbases)
and a Group List filter to select specific Groups from which to choose members.



+----------------------------------------------------+
|                   INTEGRATION                      |
+----------------------------------------------------+


>>> EVENTLIST INTEGRATION

Eventlist integration is described in a seperate readme file.
Please OPEN readme_eventlist.txt in this package for instructions.


>>> FIREBOARD INTEGRATION

FireBoard integration is described in a seperate readme file.
Please OPEN readme_fireboard.txt in this package for instructions.


>>> JOMCOMMENT INTEGRATION

JomComment integration is the easiest of our integrations
and does not require a seperate readme file.

1.) Install JomComment
2.) Go to GroupJive Settings (in admin panel)
3.) Select Integration [tab]
4.) Look for *Integrate JomComment* and select (Yes) as the drop-down value
5.) Click [Save] at top right of page.



+----------------------------------------------------+
|                  PMS COMPONENTS                    |
+----------------------------------------------------+


GroupJive Integrates with a variety of Personal Messaging System components
written for the Joomla! CMS.

There is a an issue to consider when working with a PMS component that will
affect the usability of GroupJive in relation to the PMS you choose. This issue
will surface in the area of "message formating".

GroupJive messaging is written "by default" for EMAIL and uses XHTML in the
layout of it's messages. Some PMS systems will visibly display the XHTML tags
along with the message content because some PMS systems DO NOT SUPPORT XHTML
or have a "switch" in their Admin panel in which to enable and control formating.
These controls will need to be adjusted to configure BBCODE Support or HTML Support.

*** IF XHTML/HTML support is not offered... you message formating will not be user friendly.

Please consider that if you use a particular PMS and the formatting of notifications
is not to your liking, you can change the formatting in your language files. GO TO
(site_root/components/com_groupjive/language/) and locate your native language file.
Open the language file and edit the notification messages to your liking. Then save.

Re-writing the message notification formating (without XHTML) will generally solve
the issue. You can also experiment with [BBCODE] if PMS is the primary method you
use for delivering notifications. Thank you.



+----------------------------------------------------+
|                EXTENDING GROUPJIVE                 |
+----------------------------------------------------+

>> GROUPJIVE ADD-ONS


Currently there are four GroupJive modules available for download.
The modules can be downloaded from the File Release System at joomlacode
HERE>  http://joomlacode.org/gf/project/groupjive/frs

The modules for GroupJive are
- mod_largestgroups
- mod_latestbulletins
- mod_mygroups
- mod_newestgroups

There is also a plugin for Community Builder and Community Builder Enhanced
that creates a TAB in Community Builder profiles displaying the Groups
that a member has joined and allowing other users to click the Groups
from the profile page.


+----------------------------------------------------+
|           ERROR MESSAGING IN GROUPJIVE             |
+----------------------------------------------------+

GroupJive has an extensive libarary of error messages
built into the component. The error.tmpl provides a variety
of messages depending on ERROR circumstances.

Please help us improve this aspect of the component.
You can report and request changes to error messaging
at http://groupjive.org

Although the GroupJive team has invested a considerable
about of energy into seeking out all error.tmpl responses.
There are some responses that may occur "out of context" or
as a surprise reaction to an unknown ERROR TYPE.

** in addtion: the SuperAdmin role in Joomla causes the
"This shouldn't happen" error to be generated under certain
circumstances. This is not a break... but simply a choice
by GroupJive to tolerate unusual errors related to the very
rare use of the SuperAdmin role while interacting with
GroupJive through the Front End.


Thank you.


+----------------------------------------------------+
|               SUPPORT AND COMMUNITY                |
+----------------------------------------------------+

>> SUPPORT

GroupJive wants to create an environment that is friendly, informative and fun!
Users will find support in these places:
- the forums at http://www.groupjive.org
- by emailing team@groupjive.org
- for Community Builder issues at http://joomlapolis.com
- for EventList issues at http://www.schlu.net
- for FireBoard issues at http://bestofjoomla.com
- for JomComment issues at http://azrul.com

For BUG REPORTING, please visit the GroupJive TRACKER at http://joomlacode.org/gf/project/groupjive/tracker
For FEATURE REQUESTS, please visit the Feature Forum at http://groupjive.org







Finally!

;-)

GroupJive needs your help! If you are a more experienced user, our community 
invites you to take part in GroupJive's community, as well as it's planning
and development.

You can contribute in the following ways:
- Give your support to new users in the Forums at http://groupjive.org
- Translate language files
- Contribute design work
- Coders are welcome to contact Mark (wwvine), Micha (stiggi) and Anna (fluffy5).

Please enjoy our community. We certainly do. Insights from users around the globe
bring GroupJive (and social networking in general) to new horizons. The contributions
users bring to the GroupJive community is what makes developing in open source
one of the best places to be on the internet today. Enjoy!


Thank you for choosing GroupJive!


| == == END == == |