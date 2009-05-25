!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

**** | *** EXPERIMENTAL **** EXPERIMENTAL *** | ****


  # # - GROUPJIVE and EVENTLIST INTEGRATION - # #


PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY
PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY


****************************************************
****************************************************
***    EventList Refactor is for GJ 1.6 ONLY     ***
***        and Joomla 1.0.x Series ONLY          ***

!!!    *NOT* Compatible with Joomla 1.5 series   !!!
!!!    *NOT* Compatible with Joomla 1.5 series   !!!

!!!    PLEASE NOTE THAT USE OF THIS EVENTLIST    !!!
!!!   CUSTOM BUILD "MAY NOT" PROVIDE A SIMPLE    !!!
!!!     UPGRADE PATH FOR  FUTURE  EVENTLIST      !!!
!!!     INSTALLATIONS. THIS INCLUDES JOOMLA      !!!
!!!     J1.0.X SERIES AND FUTURE J1.5 SERIES     !!!

!!!                   EVENT LIST                 !!!
!!!   these instructions are for use only with   !!!
!!!   the refactor of EventList 0.8.10 AND ONLY  !!!
!!!  the customized package of EventList for GJ  !!!
!!!      available at....                        !!!

   http://joomlacode.org/gf/project/groupjive/frs/

***             Thank you very much              ***
****************************************************
****************************************************


PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY
PRIORITY !!! - PRIORITY !!! - PRIORITY !!! - PRIORITY



- - - - - - - - - - INTRODUCTION - - - - - - - - - - -
+----------------------------------------------------+
|        EventList integration with GroupJive        |
|                 updated 2007/11/03                 |
+----------------------------------------------------+
- - - - - - - - - - INTRODUCTION - - - - - - - - - - -

EventList is a component for Joomla! developed by Christoph Lukes.
Fluffy5 has refactored the entire build of EventList 0.8.10 to make
it better compatible with Groups functionality in GroupJive 1.6.

*** This build functions in Joomla 1.0.13 __BUT DOES NOT FUNCTION IN Joomla! 1.5 ***

EventList 0.8.10 for GroupJive is a *full component*. Since our customized build of
EventList is a complete component, install the component as you would with any other
component using the GroupJive Admin panel for Installation of components, modules, etc..

The GroupJive version of EventList may be used in a manner similar to the original 0.8.10
EventList version... (originally developed at http://www.schlu.net/)
This means that GJ EventList is still EventList and can be used *stand-alone*
GroupJive thanks and acknowledges the original developer Christoph Lukes in all respects
as the source and center of continued development for EventList. (thank you Christoph)

GroupJive has also asked Christoph to partner with GroupJive on future versions
of EventList as we begin to move forward on the Joomla! 1.5 platform.

To clarify once again: EventList 0.8.10 installs on Joomla! 1.0.13 ONLY today.
A GroupJive specific version of EventList is not yet available for Joomla! 1.5


*****************************************************
*****************   INSTALLATIONS   *****************
*****************************************************

2 Methods (METHOD 1 clean install and METHOD 2 Upgrade install)

*****************   INSTALLATIONS   *****************
*****************************************************




- - - - - - - - - - - METHOD 1 - - - - - - - - - - - -
+----------------------------------------------------+
|  COMPLETELY "NEW" INSTALL -OR- "CLEAN" RE-INSTALL  |
|                   ( METHOD 1 )                     |
+----------------------------------------------------+
- - - - - - - - - - INSTALLATION - - - - - - - - - - -



*** To install EventList 0.8.10 customized for GroupJive, you should
UNINSTALL ANY OLDER VERSION OF EVENTLIST "PRIOIR TO" INSTALLING THIS ONE
   (PLEASE NOTE: in this process ALL EVENTLIST DATA WILL BE LOST!!)
   
!!!!!! Completely clean installs can begin at STEP 4 !!!!!!



STEP 1 - uninstall EventList (Admin Panel backend of Joomla!)

STEP 2 - DROP all EventList tables from MySQL Database
(using phpMyAdmin - tables usually in form of "jos_eventlist...")

STEP 3 - EMPTY the Grouptable #__gj_eventlist in MySQL Database
(using phpMyAdmin - single table usually in form of "jos_gj_eventlist")


!!!!!! Clean installs begin here >
STEP 4 - Install customized EventList 0.8.10 for GroupJive
(use Joomla! admin panel in backend of your website)

STEP 5 - integrate EventList and update "old" (use GroupJive admin panel)

- Enter the administrator module (backend) of your website
- GO TO > Components > GroupJive > Settings
- Click on the [Integration] tab
- look for > item Integrate with Eventlist 0.8.10 alpha? >Click here to update old groups<
- Select YES from the drop down menu
- click the Save button (top right)
- look for > Integrate with Eventlist 0.8.10 alpha? >Click here to update old groups<
- CLICK >Click here to update old groups<
  ("IF" you have Groups in GroupJive that existed "before" you installed the EventList HACK)


STEP 6 - enable users access to submit new events in EventList (use EventList admin panel)

- Enter the administrator module (backend) of your website
- GO TO > Components > EventList> Edit Settings
- Click on the [Access] tab

- look for > AC - Events > New Events from users: 
- Select - All Registered Users - from the drop down list (or any other level of Access you prefer)

- look for > AC - Venues > Autopublish?
- Select - All Registered Users - from the drop down list (or any other level of Access you prefer)

- click the Save button (top right)


STEP 7 - Test your installation

- GO TO the front end of your site and log in as a registered user
- Select the GroupJive component from your menus
- GO TO the GroupJive Category of your choice 
- GO TO the GroupJive Group of your choice (you must be a member)
- ENTER the GroupJive Group
- Under GROUP FUNCTIONS, Look for the link... Group Events ~>
- CLICK Group Events ~>
- CLICK Submit new event
- Select the City, Venue and Category (displays a list of available Groups in which that user is a member)
- Make your event entry by completing the event form
  (note that if no Venues/Cities exist they will be created upon form Submission)
- CLICK the SUBMIT button


NOTES:
The event should be viewable by the registered user.
The event should "not" be viewable by any user outside of the Group
The event should be viewable in the admin panel - backend
The event should be "un-published by default" (this can be confirmed in the admin panel - backend)

ADDITIONAL INSTALLATION NOTES:
The Event Categories in Event List that releate to each GroupJive Group are created automatically
when EventList integration is set to YES in the GroupJive Admin panel.

Event Categories are created for existing Groups when the >Click here to update old groups<
link is activated in the GroupJive Admin panel.

!!!!!! EventList integration has not yet been tested with any GroupJive Modules

- - - - - - - END METHOD 1 (Clean Install) - - - - - -









- - - - - - - - - -   METHOD 2   - - - - - - - - - - -
+----------------------------------------------------+
|     UPGRADE INSTALLATION OF EVENTLIST 0.8.10       |
|           (***ADVANCED USERS ONLY***)              |
+----------------------------------------------------+
- - - - - - - - - - INSTALLATION - - - - - - - - - - -


              ***___ UNSUPPORTED ___***
			  
              ***ADVANCED USERS ONLY***
			  
IF your current EventList install is vitally important to your community
and you desire to attempt an upgrade of the EventList data for integration with GroupJive,
then please follow these steps:

1.) BACKUP YOUR MySQL DATABASE (using phpMyAdmin or other tool)
2.) BACKUP YOUR JOOMLA! INSTALLATION (all directories, files and other resources)

3.) Using FTP/Shell access GO TO your Joomla root
4.) OPEN THE FOLDER http://MyJoomlaRoot/components/com_eventlist
5.) Delete the existing directories/files
- - - images (dir)
- - - languages (dir)
- - - eventlist.class.php
- - - eventlist.css
- - - eventlist.html.php
- - - eventlist.php
- - - index.html
6.) copy the new files from the customized EventList 0.8.10 for GroupJive package to the directory
(same as Step 5 list above) replacing the old files with the "new files"
7.) OPEN THE FOLDER http://MyJoomlaRoot/administrator/components/com_eventlist
8.) Delete the existing directories/files
- - - images (dir)
- - - joomfish(dir)
- - - js(dir)
- - - admin.eventlist.html.php
- - - admin.eventlist.php
- - - config.eventlist.php
- - - eventlist.xml
- - - index.html
- - - install.eventlist.php
- - - toolbar.eventlist.html.php
- - - toolbar.eventlist.php
- - - uninstall.eventlist.php
9.) copy the new files from the customized EventList 0.8.10 for GroupJive package to the directory
(same as Step 8 list above) replacing the old files with the "new files"


10.) ADDITION OF TABLE TO MySQL DATABASE for EventList
using phpMyAdmin - add a field to the #__eventlist_locate table...
Use the following MySQL QUERY: from SQL tab QUERY command line in phpMyAdmin,
please enter two queries (replacing name_of_your_joomla_database AND THE #__ prefix):
- - - - - - - - - -   QUERY (add this table)   - - - - - - - - - - -

USE name_of_your_joomla_database;
ALTER TABLE #__eventlist_locate ADD category int(11) NOT NULL default 0;

- - - - - - - - - -   QUERY (add this table)   - - - - - - - - - - -



11.) EMPTY "DATA ONLY" IN MySQL DATABASE of 1 table containing GroupJive EventList information
*** Please note this table is a GroupJive table with prefix of (#_gj_eventlist)
- - - - - - - - - -   QUERY (add this table)   - - - - - - - - - - -

using phpMyAdmin - EMPTY the table #__gj_eventlist

- - - - - - - - - -   QUERY (add this table)   - - - - - - - - - - -



12.) GroupJive Admin Panel
GO TO administrator > components > GroupJive > Settings > Integration

13.) integrate EventList and update "old" (use GroupJive admin panel)

- Enter the administrator module (backend) of your website
- GO TO > Components > GroupJive > Settings
- Click on the [Integration] tab
- look for > item Integrate with Eventlist 0.8.10 alpha? >Click here to update old groups<
- Select YES from the drop down menu
- click the Save button (top right)
- look for > Integrate with Eventlist 0.8.10 alpha? >Click here to update old groups<
- CLICK >Click here to update old groups<
  ("IF" you have Groups in GroupJive that existed "before" you installed the EventList HACK)


14.) enable users access to submit new events in EventList (use EventList admin panel)

- Enter the administrator module (backend) of your website
- GO TO > Components > EventList> Edit Settings
- Click on the [Access] tab

- look for > AC - Events > New Events from users: 
- Select - All Registered Users - from the drop down list (or any other level of Access you prefer)

- look for > AC - Venues > Autopublish?
- Select - All Registered Users - from the drop down list (or any other level of Access you prefer)

- click the Save button (top right)


15.) Test your installation

- GO TO the front end of your site and log in as a registered user
- Select the GroupJive component from your menus
- GO TO the GroupJive Category of your choice 
- GO TO the GroupJive Group of your choice (you must be a member)
- ENTER the GroupJive Group
- Under GROUP FUNCTIONS, Look for the link... Group Events ~>
- CLICK Group Events ~>
- CLICK Submit new event
- Select the City, Venue and Category (displays a list of available Groups in which that user is a member)
- Make your event entry by completing the event form
  (note that if no Venues/Cities exist they will be created upon form Submission)
- CLICK the SUBMIT button


NOTES:
The event should be viewable by the registered user.
The event should "not" be viewable by any user outside of the Group
The event should be viewable in the admin panel - backend
The event should be "un-published by default" (this can be confirmed in the admin panel - backend)

ADDITIONAL INSTALLATION NOTES:
The Event Categories in Event List that releate to each GroupJive Group are created automatically
when EventList integration is set to YES in the GroupJive Admin panel.

Event Categories are created for existing Groups when the >Click here to update old groups<
link is activated in the GroupJive Admin panel.



***CAUTION*** ABOUT UPGRADING AN EXISTING EVENTLIST INSTALL:
IF you just overwrite the EventList files and try to proceed without updating MySQL database,
you might end up with groups and categories not matching, or several records for each group in 
#__gj_eventlist. This could be a bit tricky to resolve. If there is no data to save from your
"original installation" we strongly suggest to uninstall EventList, drop all EventList tables,
empty #__gj_eventlist and start from scratch. 


ABOUT THE CUSTOMIZED EVENTLIST for GROUPJIVE:
- breadcrumbs should hold through all actions
- breadcrumbs should hold when you access events through a group
- using EventList should now always keep you in the context of the Group and you should always stay
- - > in that group, with only the option to create events in that category
- all locations you create while in group mode should be specific for that group, not visible outside it
- the EventList component should work as usual when you access it outside of a group
- using EventList directly (not through GroupJive) will require you to create at least one published,
- - > non-group category in EventList 

ABOUT ADMINISTRATION OF EVENTLIST 0.8.10(customized for GJ):
- admins can edit all events, including group events
- admins can also however mess things up, as they have access to all locations and all categories and
can mix those as they please. Mixing GroupJive specific locations and categories with the rest of
EventList functionality could lead to very strange results.


FINAL NOTE: customized EventList 0.8.10 is for Joomla! 1.0.13 ONLY
see http://www.schlu.net and http://www.groupjive.org for future Joomla! 1.5 compatible EventList


:) enjoy
wwvine writing on behalf of "Fluffy5 who says..... Smoochies!"



_________________________ GroupJive core is fluffy5, stiggi, wwvine _________________________
