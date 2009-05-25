


*****************************************************************
*****************************************************************
*****************************************************************

              *** ABOUT GroupJive Templates ***



                GroupJive 1.6 is Open Source.

The amazing principal of Open Source software basically says ...
     "Hey... you can contribute and make this better"

Users can contribute to templates by editing .css and .tmpl
(i.e. templates) and submitting them back to GroupJive in the Forums


The new CSS structure of GroupJive will allow for major refactoring
of the design (look and feel) simply by editing the groupjive_css.css

*****************************************************************
**           !!! GROUPJIVE TEMPLATE STRUCTURE !!!              **
**  The following templates render the majority of GroupJive   **
*****************************************************************
** showgroup.tmpl (the primary view of the Group Activities )  **
** groupjive.tmpl (most of the stuff in addition to showgroup) **
** error.tmpl (the rendering of default and error messages)    **
** script.tmpl (javascript and other script rendering)         **
** admin.tmpl (form template for admin edits, deletions, etc)  **
**  **  **  **  **  **  **  **  **  **  **  **  **  **  **  ** **
**     groupjive_css.css (THE CSS FOR ALL! of GroupJive)       **
*****************************************************************

ALL of these files can be found in the templates folder(s) of
GroupJive :)

*****************************************************************
*****************************************************************
*****************************************************************




*****************************************************************

+----------------------------------------------------+
|       changing the default GroupJive ICON          |
+----------------------------------------------------+

GroupJive has included a series of different ICONS for the community.
They are located in the Images folder in templates.

Please review the files in ../com_groupjive/images

You may of course add your own. AND !! if you have a great group image
and want to donate it to the open source community, please attach and
upload and http://groupjive.org in the forums. The community would love
to share in your creativity and what you bring to GroupJive.


*****************************************************************





*****************************************************************

+----------------------------------------------------+
|             min-mod showgroup.tmpl HACK            |
+----------------------------------------------------+


EXPLANATION:

Users in the GroupJive community have sometimes requested
the Moderator be (*less visible*) in the showgroup.tmpl

Newer users please note: the Moderator Image (avatar) and
contact info take a prominent place in the GroupJive pages.

*** In response to this request, GroupJive has placed a ***
*** min-mod version of the showgroup.tmpl into some of  ***
*** the original templates that ship with GroupJive     ***

min-mod = Minimum Moderator Presence on the showgroup page


This HACK accomplishes three adjustments:

1.) It eliminates the Moderator Image (avatar) from view
2.) It eliminates the Headings associated with Mod functions
3.) It moves the Moderator Profile link into the Actions list


             !!!!!!!!!!! HACK !!!!!!!!!!!
             ****************************

To HACK the showgroup.tmpl so that the Moderator Presence
is reduced. Please follow these simple steps

1.) In the template folder of the template you are using
- - - rename showgroup.tmpl to showgroup.orig.tmpl - - - 
2.) In the same template folder
- - - rename showgroup_min-mod.tmpl to showgroup.tmpl - - - 
3.) Refresh your browser

             ****************************
             !!!!!!!!! END HACK !!!!!!!!!


Wasn't that easy! :)


Thanks for using GroupJive!


*****************************************************************


<!-- CSS REFACTOR IN PROGRESS - THIS GROUPJIVE TEMPLATE IS UNDER CONSTRUCTION -->


<!-- ======================================================
================ MAIN GROUPJIVE TEMPLATE ==================
===========================================================
GroupJive uses the Joomla patTemplate system to render content.
You can read about patTemplate at php-tools here

            http://trac.php-tools.net/patTemplate

GroupJive functions and php scripts are rendered using a series
of template files. In GroupJive, template folders and files are 
located in directories under com_groupjive/templates.
GroupJive template files include:

groupjive.tmpl (MAIN TEMPLATE FILE - contains many templates)
showgroup.tmpl (GROUP TEMPLATE FILE - contains the showgroup template only)

admin.tmpl
error.tmpl
script.tmpl

and finally...

groupjive_css.css (the CSS file for all of GroupJive)

groupjive.tmpl and showgroup.tmpl are set apart in this list
because these two .tmpl files contain almost the entire template system.
Any user can make adjustments to GroupJive's design by editing templates
and groupjive_css.css as needed.

COMMENTS: As you work your way down this file you will note that
each .tmpl file has been commented at the beginning of the file just
before the opening < mostmpl > tag. GroupJive wants to help
users understand the functions of the templates. The template names
and basic explanations that follow describe what each template does.
=========================================================== -->



<!-- +*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*
                   BEGIN TEMPLATES NOW
+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+*+ -->





             !!!!!!!!! UNDER CONSTRUCTION !!!!!!!!!
             **************************************
This readme is under construction. Please see future versions
as the readme is expanded and improved. Thank you!
             **************************************
             !!!!!!!!! UNDER CONSTRUCTION !!!!!!!!!




+----------------------------------------------------+
|                FUTURE HEADINGS HERE                |
+----------------------------------------------------+




+----------------------------------------------------+
|                future content here                 |
|----------------------------------------------------|
|  content content content content content content   |
|                                                    |
|  content content content content content content   |
|                                                    |
|  content content content content content content   |