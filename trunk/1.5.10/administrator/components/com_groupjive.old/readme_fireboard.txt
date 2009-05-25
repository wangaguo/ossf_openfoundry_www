
*****************************************************************
*****************************************************************
                *** About FireBoard ***


GroupJive 1.6 integrates with FireBoard v1.0.3 only!! Support for
earlier versions of JoomlaBoard and SimpleBoard has ended in the
current version of GroupJive.

*****************************************************************
**      !!! For JoomlaBoard and SimpleBoard users !!!          **
*****************************************************************
** We have an earlier version of GroupJive 1.5 Beta2 rev 277   **
** This version of GroupJive does integrate with JoomlaBoard   **
** This version of GroupJive does integrate with SimpleBoard   **
** You can download GroupJive 1.5 Beta 2 rev 277 at this URL   **
**     http://joomlacode.org/gf/project/groupjive/frs/         **
** NOTE: this version is not feature complete or bug free!     **
*****************************************************************

For all other FireBoard Forum users, please download and install
the current version of FireBoard (FB 1.0.3). Upgrade instructions
from  SimpleBoard, JoomlaBoard and various FireBoard betas are
available at http://bestofjoomla.com

*****************************************************************
*****************************************************************




             !!!!!!!!! PRIORITY !!!!!!!!!
             ****************************
To use FireBoard intergration, you must set the Integrate
with FireBoard before anything else is done. It should be 
your first priority in setting up GroupJive.
             ****************************
             !!!!!!!!! PRIORITY !!!!!!!!!




+----------------------------------------------------+
|               FIREBOARD INTEGRATION                |
+----------------------------------------------------+



FIREBOARD INTEGRATION gives the admin/users the ability to configure
"private" forums and/or public forums based on the different types
of Groups available in GroupJive.



** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
**     to set up integration with FireBoard first edit the     **
**    FireBoard .php file making it aware of GroupJive path    **
**      this is done by adding lines of code as follows        **
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **


+----------------------------------------------------+
|                 EDIT fireboard.php                 |
|----------------------------------------------------|
|  open /components/com_fireboard/fireboard.php      |
|                                                    |
|                 somewhere after                    |
|   the FireBoard configuration params comment       |
|                 which looks like                   |

// get fireboards configuration params in

                  ADD THESE TWO LINES

// this line integrates GroupJive
include_once ($mainframe->getCfg('absolute_path') . '/components/com_groupjive/groupjive_jb.php');


|                                                    |
|----------------------------------------------------|
|                 Save fireboard.php                 |
+----------------------------------------------------+

*** next > follow intructions completing FireBoard integration

1.) Go to Components > GroupJive > Settings
2.) select the Integration [tab]
3.) set "Integrate with Fireboard? > drop down to "Yes"
4.) click Save

to enable a private forum for every group...
5.) go to Components > FireBoard
6.) select Forum Administration
7.) create a Category for GroupJive in FireBoard
 ... - NOTE: (the Category will be published only temporarily)
 ... - go to Components > FireBoard Forum
 ... - select Forum Administration
 ... - select "New"
 ... - create a Forum Category, set to Publish and click Save
 ... - you will return to the previous Forum Administration screen
       (verify that the Category is published)
 ... - GO TO the front end (the public facing side) and login
 ... - GO TO FireBoard and "mouseover" and click the Category link
       for the new Category
 ... - the URL for this link should now appear in your Browser's
       address bar
 ... - the final part of the address contains the : catid=?
 ... - WRITE DOWN THE NUMBER catid=#
9.) go to Components > GroupJive > Settings
10.) select the Integration [tab]
11.) Enter the FireBoard Category ID number (catid=?) in the field following
     this description
     ..... Assign an unpublished FireBoard Category to GroupJive. Please enter the catid #  ["# only"]
12.) click Save
13.) Every Group Forum will be created under this Category
14.) FINAL STEP > go back and unpublish the Category so that GroupJive Forum
     posts remain private
