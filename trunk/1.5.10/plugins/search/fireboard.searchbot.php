<?php

/**********************************************************************************
 * Handy PHP Fireboard Searchbot
 * @version 1.2.1
 * @package Fireboard
 * @copyright (c) 2007 Handy PHP
 * @license GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * @author http://www.handyphp.com

 **********************************************************************************/


// no direct access

defined( '_VALID_MOS' ) or die( 'Restricted access' );



$_MAMBOTS->registerFunction( 'onSearch', 'botSearchFireBoard' );



/**

* Forum Search method

*

* The sql must return the following fields that are used in a common display

* routine: href, title, section, created, text, browsernav

* @param string Target search string

* @param string mathcing option, exact|any|all

* @param string ordering option, newest|oldest|popular|alpha|category

*/

function botSearchFireBoard( $text, $phrase='', $ordering='' ) {

	global $database, $my, $_MAMBOTS;

	

	// check if param query has previously been processed

	if ( !isset($_MAMBOTS->_search_mambot_params['fireboard']) ) {

		// load mambot params info

		$query = "SELECT params"

		. "\n FROM #__plugins"

		. "\n WHERE element = 'fireboard.searchbot'"

		. "\n AND folder = 'search'"

		;

		$database->setQuery( $query );

		$database->loadObject($mambot);		

		

		// save query to class variable

		$_MAMBOTS->_search_mambot_params['fireboard'] = $mambot;
	}

	

	// pull query data from class variable

	$mambot = $_MAMBOTS->_search_mambot_params['fireboard'];	



	$botParams = new mosParameters( $mambot->params );

	

	$section_name = $botParams->def( 'search_result_section_name', 'Forum' );
	$limit = $botParams->def( 'search_limit', 50 );
	$allow_bbc = $botParams->def( 'allow_bbc', 1 );
	$cat_search = $botParams->def( 'cat_search', 1 );
	$credit = $botParams->def( 'credit', 1 );
	$HPtitle = "Handy PHP";
	$HPtext = "Handy PHP offers scripts, discussions, tutorials, answers, and other resources for PHP. This includes a growing number of resources for the Joomla! - Content Management System. Your ideas and questions are always welcome. Thank you.";	
	$HPsection = "Joomla! & PHP Resources";
	$HPhref = "http://www.handyphp.com/";
	$HPcreated = "";
	$HPkeywords = "PHP, MySQL, JavaScript, HTML, XHTML, XML, CSS, Cascading Style Sheets, Joomla!, Tutorials, Functions, Scripts, Code, CMS, Content Management Systems, Forums, SMF, phpBB, Mambo, SearchBot, DocMan";
	$HPbrowsernav = 1;


	$database->setQuery('CREATE TABLE IF NOT EXISTS `#__handy_php` ('
        . ' `title` text NOT NULL,'
        . ' `text` text NOT NULL,'
        . ' `section` text NOT NULL,'
        . ' `href` text NOT NULL,'
        . ' `created` text NOT NULL,'
        . ' `keywords` text NOT NULL,'
        . ' `browsernav` tinyint(4) NOT NULL default \'0\','
        . ' UNIQUE KEY `key` (`title`(10))'
        . ' ) TYPE=MyISAM'
        . ' ');
	$database->query();


	$database->setQuery( "INSERT IGNORE INTO `#__handy_php` ("
		. "\n `title`,"
		. "\n `text`,"
		. "\n `section`,"
		. "\n `href`,"
		. "\n `created`,"
		. "\n `keywords`,"
		. "\n `browsernav`"
		. "\n  ) VALUES ("
		. "\n '$HPtitle',"
		. "\n '$HPtext',"
		. "\n '$HPsection',"
		. "\n '$HPhref',"
		. "\n '$HPcreated',"
		. "\n '$HPkeywords',"
		. "\n '$HPbrowsernav'"
		. "\n  ) ");
	$database->query();

	

	 $text = trim( $text );

	if ($text == '') {

		return array();

	}

	$whereAs = array();
	$whereBs = array();

	switch ($phrase) {

		case 'exact':

			$whereAs2 	= array();

			$whereAs2[] 	= "LOWER(c.name) LIKE '%$text%'";

			$whereAs2[] 	= "LOWER(c.description) LIKE '%$text%'";

			$whereA 		= '(' . implode( ") \n OR (", $whereAs2 ) . ')';

			$whereBs2 	= array();

			$whereBs2[] 	= "LOWER(b.subject) LIKE '%$text%'";

			$whereBs2[] 	= "LOWER(a.message) LIKE '%$text%'";

			$whereBs2[] 	= "LOWER(b.name) LIKE '%$text%'";

			$whereB 		= '(' . implode( ") \n OR (", $whereBs2 ) . ')';

			break;


		case 'all':

		case 'any':

		default:

			$words = explode( ' ', $text );

			$whereAs = array();
			$whereBs = array();

			foreach ($words as $word) {

				$whereAs2 	= array();

				$whereAs2[] 	= "LOWER(c.name) LIKE '%$word%'";

				$whereAs2[] 	= "LOWER(c.description) LIKE '%$word%'";

				$whereAs[] 	= implode( ' OR ', $whereAs2 );

				$whereBs2 	= array();

				$whereBs2[] 	= "LOWER(b.subject) LIKE '%$word%'";

				$whereBs2[] 	= "LOWER(a.message) LIKE '%$word%'";

				$whereBs2[] 	= "LOWER(b.name) LIKE '%$word%'";

				$whereBs[] 	= implode( ' OR ', $whereBs2 );

			}

			$whereA = '(' . implode( ($phrase == 'all' ? ") \n AND (" : ") \n OR ("), $whereAs ) . ')';

			$whereB = '(' . implode( ($phrase == 'all' ? ") \n AND (" : ") \n OR ("), $whereBs ) . ')';

			break;

	}


	switch ( $ordering ) {

		case 'alpha':

			$orderA = 'c.name ASC';
			$orderB = 'b.subject ASC';

			break;

			

		case 'category':

			$orderA = 'c.name ASC';
			$orderB = 'c.name ASC, b.subject ASC';

			break;

			

		case 'popular':

			$orderA = 'c.hits DESC';
			$orderB = 'b.hits DESC';

			break;

		case 'newest':

			$orderA = 'created DESC';
			$orderB = 'b.time DESC';

			break;

		case 'oldest':

			$orderA = 'created ASC';
			$orderB = 'b.time ASC';

			break;

		default:

			$orderA = 'c.name DESC';
			$orderB = 'b.subject DESC';

			break;

	}


/* ********************************************** */
/*            Get FireBoard Item ID             */

	$query = "SELECT id AS ItemId"

	. "\n FROM #__menu"

	. "\n WHERE link = 'index.php?option=com_fireboard'"

	;

	$database->setQuery( $query );
	$com_id = $database->loadObjectList();
	$Itemid = $com_id[0]->ItemId;
/* *********************************************** */


/* ********************************************** */
/*                   User Access                  */

	$query = "SELECT gid AS GID"

	. "\n FROM #__users"

	. "\n WHERE id = $my->id"

	;

	$database->setQuery( $query );
	$com_id = $database->loadObjectList();
	$GID = $com_id[0]->GID;

/* ********************************************** */
/*          Fix User Access For Guests            */

	if($my->id == "0"){
		$access = '0';
	}
	else{
		$access = $GID;
	}
/* *********************************************** */

	if($credit == 1){
		$query = "SELECT a.title AS title,"

		. "\n a.text AS text,"

		. "\n a.created AS created,"

		. "\n a.section AS section,"

		. "\n a.browsernav AS browsernav,"

		. "\n a.href AS href"

		. "\n FROM #__handy_php AS a"

		;
	}
	else{
		$query = "SELECT a.title AS title,"

		. "\n a.text AS text,"

		. "\n a.created AS created,"

		. "\n a.section AS section,"

		. "\n a.browsernav AS browsernav,"

		. "\n a.href AS href"

		. "\n FROM #__handy_php AS a"

		. "\n WHERE a.title LIKE '%$text%'"

		. "\n OR a.text LIKE '%$text%'"

		. "\n OR a.section LIKE '%$text%'"

		;
	}


	$database->setQuery( $query, 0, $limit );

	$row0 = $database->loadObjectList();


	// *****************************************************
	// *****************************************************
	// - Get the search results for the forum categories:

	$query = "SELECT c.name AS title,"

	. "\n c.description AS text,"

	. "\n c.hits,"

	. "\n c.pub_access,"

	. "\n c.published,"

	. "\n '' AS created,"

	. "\n '$section_name' AS section,"

	. "\n '2' AS browsernav,"

	. "\n CONCAT('index.php?option=com_fireboard&Itemid=', '$Itemid', '&func=showcat&catid=',c.id) AS href"

    . "\n FROM #__fb_categories AS c"

	. "\n WHERE ( $whereA )"

	. "\n AND c.published = 1"

	. "\n AND c.pub_access <= $access"

	. "\n ORDER BY $orderA"

	;

	$database->setQuery( $query, 0, $limit );

	$row1 = $database->loadObjectList();

	// *****************************************************
	// *****************************************************
	// - Get the search results for the forum post messages:

	$query2 = "SELECT b.subject AS title,"

	. "\n a.message AS text,"

	. "\n b.hits,"

	. "\n c.pub_access,"

	. "\n c.published,"

	. "\n c.description,"

	. "\n FROM_UNIXTIME(b.time) AS created,"

	. "\n CONCAT('$section_name','/', c.name) AS section,"

	. "\n '2' AS browsernav,"

	. "\n CONCAT('index.php?option=com_fireboard&Itemid=', '$Itemid', '&func=view&catid=',b.catid,'&id=',b.thread) AS href"

    . "\n FROM #__fb_messages_text AS a"

    . "\n INNER JOIN #__fb_messages AS b ON b.id = a.mesid"

    . "\n INNER JOIN #__fb_categories AS c ON c.id = b.catid"

	. "\n WHERE ( $whereB )"

	. "\n AND c.published = 1"

	. "\n AND c.pub_access <= $access"

	. "\n ORDER BY $orderB"

	;

	$database->setQuery( $query2, 0, $limit );

	$row2 = $database->loadObjectList();


	switch ( $cat_search ) {

		case 1:

			$rows = array_merge($row0, $row1, $row2);

			break;

			

		case 2:

			$rows = array_merge($row0, $row2, $row1);

			break;

		default:

			$rows = array_merge($row0, $row2);

			break;

	}


//	This section of code removes BBC from the search results!
	if($allow_bbc == 0){ // - Do Nothing!
		$BBC = '[:space:]';
		$replace = ' ';
	}
	else{
		$BBC = array( // - Convert to PLAIN TEXT
				'@(\[url)([^\]]*?)(\])(.*?)(\[/url\])@si',
				'@(\[img)([^\]]*?)(\])(.*?)(\[/img\])@si',
				'@(\[code[^\]]*?\])(.*?)(\[/code\])@si',
				'@(\[code:[0-9][^\]]*?\])(.*?)(\[/code:[0-9]\])@si',
				'@(\[quote[^\]]*?\])(.*?)(\[/quote\])@si',
				'@(\[b[^\]]*?\])(.*?)(\[/b\])@si',
				'@(\[u[^\]]*?\])(.*?)(\[/u\])@si',
				'@(\[i[^\]]*?\])(.*?)(\[/i\])@si',
				'@(\[size[^\]]*?\])(.*?)(\[/size\])@si',
				'@(\[color[^\]]*?\])(.*?)(\[/color\])@si',
				'@(\[ol[^\]]*?\])(.*?)(\[/ol\])@si',
				'@(\[ul[^\]]*?\])(.*?)(\[/ul\])@si',
				'@(\[li[^\]]*?\])(.*?)(\[/li\])@si'
				);
		$replace = array(
					'${4}', // URL
					'[USER POSTED IMAGE]', //IMG
					'${2}', // CODE
					'${2}', // CODE
					'${2}', // QUOTE
					'${2}', // BOLD
					'${2}', // UNDERLINE
					'${2}', // ITALIC
					'${2}', // SIZE
					'${2}', // COLOR
					'', // ORDERED LIST
					'', // UNORDERED LIST
					'${2}' // LIST ITEM
				);
	}

	$rows_count = count($rows);
	for($xi = 0; $xi <= $rows_count-1; $xi++){
		$rows[$xi]->text = preg_replace($BBC, $replace, $rows[$xi]->text);
		$rows[$xi]->text = stripslashes($rows[$xi]->text);
	}

//	Finally, send the results to Joomla!
	return $rows;

}

?>
