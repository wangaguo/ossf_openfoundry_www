<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');
?>

1. Copyright and disclaimer
---------------------------

This application is released under Donationware License.
All Rights Reserved
Copyright (c) 2005 - 2008 - Bernard Gilly
ALPHACONTENT IS DISTRIBUTED "AS IS". NO WARRANTY OF ANY KIND IS EXPRESSED OR IMPLIED. YOU USE IT AT YOUR OWN RISK.
THE AUTHOR WILL NOT BE LIABLE FOR ANY DAMAGES, INCLUDING BUT NOT LIMITED TO DATA LOSS, LOSS OF PROFITS OR ANY OTHER KIND OF LOSS WHILE USING OR MISUSING THIS SCRIPT.


2. Changelog
------------

This is a non-exhaustive (but still near complete) changelog for
AlphaContent, including beta and release candidate versions.
Our thanks to all those people who've contributed bug reports and
code fixes.


3. Legend
---------

* -> Security Fix
# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note

--------------------  4.0.7 production release [21 November 2008]  --------------------
# fixed original intro selection
# fixed redirection on ordering list item
+ added new plugin system for retreive Itemid on article
+ added dynamic set page title in browser

--------------------  4.0.6 production release [20 October 2008]  --------------------
# fixed routing sections and categories with SEF enabled
# fixed link to article on comment(s) link
# fixed weblink title link
+ added counter comments for mXcomment
! upgrade language finnish
! upgrade language turkish

--------------------  4.0.5 production release [17 October 2008]  --------------------
# fixed link title with SEF enabled
# fixed routing sections and categories
# fixed open link in new window
+ added meta description in choice intro listing
+ added Portuguese language (frontend)

--------------------  4.0.4 production release [02 October 2008]  --------------------
# fixed counter comments with Simple Comment System
# fixed working animation on rating stars
+ added exclude ID content item for not displayed rating bar outside AlphaContent framework
+ added possibilty to showing rating bar everywhere on content (intro + content or only content article) outside AlphaContent framework
+ added counter comments for ChronoComments system
+ added counter comments for MS Comment system
+ added image clickable on listing
+ added counter on category
+ added Italian language (frontend)
+ added German language (frontend)

--------------------  4.0.3 production release [06 September 2008]  --------------------
# fixed ordering on listing
# fixed show page title if not defined in params menu
+ Thumbnail image for Weblinks directly (hide - show - Thumbnail)
+ added image contact
+ added result categories and listing on search letter

--------------------  4.0.2 production release [18 August 2008]  --------------------
# fixed scalar value (line 371) on default layout
# fixed ordering by default on listing
# fixed sharethis function on view article
# fixed unlink files for plugin during install
# fixed specific categories selected
# fixed Itemid on Directory
+ added parse content plugins for sections and categories description
+ added Joomla pathway on view article
+ added ability to search on keywords and search on fulltext
- removed category description on view article (can be activate manualy in plugin page code)
+ added ability to choose specific categories in Weblinks as a section
+ added ability to choose specific categories in Contacts as a section
+ added Dutch language (frontend)
+ added Simplified Chinese language (frontend)
+ added Traditional Chinese language (frontend)

--------------------  4.0.1 production release [28 July 2008]  --------------------
# fixed Show/hide num index
# fixed Show/hide Section/category
# fixed Show/hide author
# fixed Google Maps API key error
# fixed Alphabetical bar with numbers
# fixed Ordering box and listing
# fixed search by alphabetical bar when article showing
- removed Tag echo for debug in router.php
+ added search specials characters in alphabetical bar
+ added ability to add a second alphabetical bar below the first (see detail in help file)
+ added Simple Comment System into systems comment list
+ added Russian language
+ added Turkish language

--------------------  4.0.0 production release [26 May 2008]  --------------------
! Note: New AlphaContent release entire rewriting for Joomla 1.5.x
