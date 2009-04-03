<?php
/**
* Mosets Tree
*
* This extension will give the SEF advance style URLs to Mosets Tree
*
* For SEF advance > v3.7
*
* @package Mosets Tree
* @copyright (C) 2005-2006 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Include the config file
global $mosConfig_absolute_path;
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/config.mtree.php' );
require_once( $mosConfig_absolute_path.'/components/com_mtree/mtree.class.php' );

# Inlcude back-end class
require_once( $mosConfig_absolute_path.'/administrator/components/com_mtree/admin.mtree.class.php' );

define("_MT_SEF_ADD_LINKID", 0);				// Setting this to 1 will add listing ID number as a prefix to the listing name in the URL. This is used in cases where a category has more than one listing with the same name.
define("_MT_SEF_ADD_LINKID_SEP", "-");		// Seperator to separate Listing ID and Listing Name
define("_MT_SEF_ADD_LINKID_ATTACH", 1);	// (1) Add Link ID as a suffix; (2)  Add Link ID as a prefix

define("_MT_SEF_DETAILS", "details");
define("_MT_SEF_REVIEW", "review");
define("_MT_SEF_RATE", "rate");
define("_MT_SEF_RECOMMEND", "recommend");
define("_MT_SEF_CONTACT", "contact");
define("_MT_SEF_REPORT", "report");
define("_MT_SEF_CLAIM", "claim");
define("_MT_SEF_VISIT", "visit");
define("_MT_SEF_CATEGORY_PAGE", "page");

define("_MT_SEF_REVIEWS_PAGE","reviews");
define("_MT_SEF_ADDLISTING","Add_Listing");
define("_MT_SEF_ADDCATEGORY","Add_Category");

define("_MT_SEF_MYLISTING","My_Listing");
define("_MT_SEF_NEWLISTING","New_Listing");
define("_MT_SEF_FEATUREDLISTING","Featured_Listing");
define("_MT_SEF_POPULARLISTING","Popular_listing");
define("_MT_SEF_MOSTRATEDLISTING","Most_Rated");
define("_MT_SEF_TOPRATEDLISTING","Top_Rated");
define("_MT_SEF_MOSTREVIEWEDLISTING","Most_Reviewed");
define("_MT_SEF_LISTALPHA","List_Alpha");

define("_MT_SEF_OWNER", "Owner");
define("_MT_SEF_SEARCH", "Search");
define("_MT_SEF_ADVSEARCH", "AdvSearch");
define("_MT_SEF_ADVSEARCH2", "AdvSearchR");

class sef_mtree {

	var $querystring=null;

	/********************************************************
	* CREATE
	********************************************************/

	/**
	* Creates the SEF advance URL out of the Mambo request
	* Input: $string, string, The request URL (index.php?option=com_mtree&Itemid=$Itemid)
	* Output: $sefstring, string, SEF advance URL ($var1/$var2/)
	**/
	function create ($string) {
		global $database;

		$sefstring = '';

		# List Categories (listcats)
		if ( eregi("&amp;task=listcats&amp;cat_id=",$string) ) {

			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
	
			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_links;
				$page = (($limitstart / $mt_fe_num_of_links) +1);
				$sefstring .= _MT_SEF_CATEGORY_PAGE . $page . '/';
			}

		}

		# My Listing
		if ( $this->taskIs("mylisting", $string) ) {

			$sefstring .= _MT_SEF_MYLISTING .'/';

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_links;
				$page = (($limitstart / $mt_fe_num_of_links) +1);
				$sefstring .= _MT_SEF_CATEGORY_PAGE . $page . '/';
			}

		}

		# Featured Listing
		if ( $this->taskIs("listfeatured", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
			$sefstring .= _MT_SEF_FEATUREDLISTING . '/';

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_links;
				$page = (($limitstart / $mt_fe_num_of_links) +1);
				$sefstring .= $page . '/';
			} else {
				$sefstring .= '1' . '/';
			}
			
		}

		# New/Latest Listing
		if ( $this->taskIs("listnew", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
			$sefstring .= _MT_SEF_NEWLISTING . '/';

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_newlisting;
				$page = (($limitstart / $mt_fe_num_of_newlisting) +1);
				$sefstring .= $page . '/';
			} else {
				$sefstring .= '1' . '/';
			}

		}

		# Popular Listing
		if ( $this->taskIs("listpopular", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
			$sefstring .= _MT_SEF_POPULARLISTING . '/';
		}

		# Most Rated Listing
		if ( $this->taskIs("listmostrated", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
			$sefstring .= _MT_SEF_MOSTRATEDLISTING . '/';
		}

		# Top Rated Listing
		if ( $this->taskIs("listtoprated", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
			$sefstring .= _MT_SEF_TOPRATEDLISTING . '/';
		}

		# Most Reviewed Listing
		if ( $this->taskIs("listmostreview", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );
			$sefstring .= _MT_SEF_MOSTREVIEWEDLISTING . '/';
		}

		if ( $this->taskIs("listalpha", $string) ) {
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );

			$sefstring .= _MT_SEF_LISTALPHA . '/';
			//$sefstring .= _MT_SEF_LISTALPHA;

			// Get start alphabet
			$temp = split("&amp;start=", $string);
			$temp = split("&", $temp[1]);
			$sefstring .= $temp[0] . '/';

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				//	http://example.com/c/mtree/Computer/Games/ist_Alpha/d/page25.html
				
				global $mt_fe_num_of_links;
				$page = (($limitstart / $mt_fe_num_of_links) +1);
				//$sefstring .= _MT_SEF_ALPHA_PAGE . $page;
				$sefstring .= $page . '/';
			
			} else {
				$sefstring .= '1' . '/';

			}

		}		

		# Advanced Search Results
		if ( $this->taskIs("advsearch2", $string) ) {
			$sefstring .= _MT_SEF_ADVSEARCH2 . '/';

			// Get search id
			$search_id = $this->getID("search",$string);
			$page = 1;

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_searchresults;
				$page = (($limitstart / $mt_fe_num_of_searchresults) +1);
			}

			//if ( $page <> 1 && $page <> 0 ) {
			if ( $page > 0 ) {
				$sefstring .= $page . '/' . $search_id .'/';
			}

		# Advanced Search
		// Note: This has to be places in the else statement, otherwise, advsearch2 task 
		//			 will append _MT_SEF_ADVSEARCH another time at the end of the URL
		} elseif ( $this->taskIs("advsearch", $string) ) {
			$sefstring .= _MT_SEF_ADVSEARCH . '/';
		}
		

		# View All listing from Owner
		if ( $this->taskIs("viewowner", $string) ) {

			$user_id = $this->getID( 'user', $string );
			$database->setQuery( "SELECT name FROM #__users WHERE id='".$user_id."' AND block='0'" );
			$username = $database->loadResult();

			if ( !empty($username) ) {
				$sefstring .= _MT_SEF_OWNER . '/' . sefencode($username) . '/';
			}

			// TODO - Does not append further virtual path if username does not exists. mtree.php
			//				should check if user is not block / exists.
			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_links;
				$page = (($limitstart / $mt_fe_num_of_links) +1);
				$sefstring .= $page . '/';
			} else {
				$sefstring .= '1' . '/';
			}

		}
			
		# View Listing
		if ( $this->listingTaskIs("viewlink",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCat( $mtLink->cat_id );

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				//	http://example.com/c/mtree/Computer/Games/Donkey_Kong/reviews23/
				
				global $mt_fe_num_of_reviews;
				$page = (($limitstart / $mt_fe_num_of_reviews) +1);
				$sefstring .= $this->appendListing( $mtLink->link_name, $mtLink->link_id, false );
				$sefstring .= _MT_SEF_REVIEWS_PAGE . $page . '/';
			
			} else {
				//	http://example.com/c/mtree/Computer/Games/Donkey_Kong/details/
				
				$sefstring .= $this->appendListing( $mtLink->link_name, $mtLink->link_id, true );
			
			}

		}

		# Write Review
		if ( $this->listingTaskIs("writereview",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_REVIEW . '/';
		}

		# Rating
		if ( $this->listingTaskIs("rate",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_RATE . '/';
		}

		# RECOMMEND
		if ( $this->listingTaskIs("recommend",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_RECOMMEND . '/';
		}

		# CONTACT OWNER
		if ( $this->listingTaskIs("contact",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_CONTACT . '/';
		}

		# REPORT LISTING
		if ( $this->listingTaskIs("report",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_REPORT . '/';
		}

		# CLAIM LISTING
		if ( $this->listingTaskIs("claim",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_CLAIM . '/';
		}

		# VISIT LISTING
		if ( $this->listingTaskIs("visit",$string) ) {
			$mtLink = new mtLinks( $database );
			$mtLink->load( $this->getID('link',$string) );
			$sefstring .= $this->appendCatListing( $mtLink, false );
			$sefstring .= _MT_SEF_VISIT . '/';
		}
		
		# Add Listing
		if ( $this->listingTaskIs("addlisting",$string) || eregi("&amp;task=addlisting&amp;cat_id=",$string) ) {

			if (eregi("&amp;task=addlisting&amp;link_id=",$string)) {
				
				$mtLink = new mtLinks( $database );
				$mtLink->load( $this->getID('link',$string) );
				$sefstring .= $this->appendCat( $mtLink->cat_id );

			} elseif (eregi("&amp;task=addlisting&amp;cat_id=",$string)) {
				
				$cat_id = $this->getID( 'cat', $string );
				$sefstring .= $this->appendCat( $cat_id );

			}

			$sefstring .= _MT_SEF_ADDLISTING . '/';

		}

		# Add Category
		if ( $this->listingTaskIs("addcategory",$string) || eregi("&amp;task=addcategory&amp;cat_id=",$string) ) {

			if (eregi("&amp;task=addcategory&amp;link_id=",$string)) {
				
				$mtLink = new mtLinks( $database );
				$mtLink->load( $this->getID('link',$string) );
				$sefstring .= $this->appendCat( $mtLink->cat_id );

			} elseif (eregi("&amp;task=addcategory&amp;cat_id=",$string)) {
				
				$cat_id = $this->getID( 'cat', $string );
				$sefstring .= $this->appendCat( $cat_id );

			}

			$sefstring .= _MT_SEF_ADDCATEGORY . '/';

		}

		# Search Results
		if ( $this->taskIs("search",$string) ) {
			
			$cat_id = $this->getID( 'cat', $string );
			$sefstring .= $this->appendCat( $cat_id );

			$sefstring .= _MT_SEF_SEARCH . '/';

			// Get search word
			$temp = split("&amp;searchword=", $string);
			$temp = split("&", $temp[1]);
			$searchword = $temp[0];
			$page = 1;

			if( $this->getLimits( $limit, $limitstart, $string ) ) {
				global $mt_fe_num_of_searchresults;
				$page = (($limitstart / $mt_fe_num_of_searchresults) +1);
			}

			$sefstring .= $page . '/' . $searchword . '/';

		}

		return $sefstring;

	}

	/********************************************************
	* REVERT
	********************************************************/

	/**
	* Reverts to the Mambo query string out of the SEF advance URL
	* Input:
	*    $url_array, array, The SEF advance URL split in arrays (first custom virtual directory beginning at $pos+1)
	*    $pos, int, The position of the first virtual directory (component)
	* Output: $QUERY_STRING, string, Mambo query string (var1=$var1&var2=$var2)
	*    Note that this will be added to already defined first part (option=com_example&Itemid=$Itemid)
	**/
	function revert ($url_array, $pos) {
		global $database;

		$mtree = new mtree();
		$mt_fe_num_of_links = $mtree->getCfg('mt_fe_num_of_links');
		$mt_fe_num_of_searchresults = $mtree->getCfg('mt_fe_num_of_searchresults');
		$mt_fe_num_of_reviews = $mtree->getCfg('mt_fe_num_of_reviews');

		$QUERY_STRING = "";
		
		if ( (isset($url_array[$pos+2]) && $url_array[$pos+2]!="") ) {

			# (1) Viewing Category	-	http://example.com/c/mtree/Computer/Games/
			#								- http://example.com/c/mtree/Computer/Games/page[0-9]+.html
			
			$pagepattern = _MT_SEF_CATEGORY_PAGE . "[0-9]+";
			
			if ( 
						(
							empty( $url_array[ (count($url_array)-1) ] ) 
							|| 
							( eregi($pagepattern,$url_array[ (count($url_array)-2) ]) ) 
						)
						&&
							( !in_array( $url_array[ (count($url_array)-3) ], array( _MT_SEF_FEATUREDLISTING, _MT_SEF_NEWLISTING ) ) )
						&&
							( !in_array( $url_array[ (count($url_array)-4) ], array( _MT_SEF_OWNER, _MT_SEF_SEARCH, _MT_SEF_ADVSEARCH2, _MT_SEF_LISTALPHA ) ) )
						&&
							!in_array( $url_array[ (count($url_array)-2) ], array( _MT_SEF_POPULARLISTING, _MT_SEF_MOSTRATEDLISTING, _MT_SEF_TOPRATEDLISTING, _MT_SEF_MOSTREVIEWEDLISTING, _MT_SEF_REVIEW, _MT_SEF_RATE, _MT_SEF_RECOMMEND, _MT_SEF_CONTACT, _MT_SEF_REPORT, _MT_SEF_CLAIM, _MT_SEF_VISIT, _MT_SEF_ADDLISTING, _MT_SEF_ADDCATEGORY, _MT_SEF_REVIEWS_PAGE, _MT_SEF_DETAILS ) )
						&&
							!eregi(_MT_SEF_REVIEWS_PAGE."[0-9]+",$url_array[ (count($url_array)-2) ])
				 ) {

				$cat_names = array_slice( $url_array, ($pos+2), -1 );
				if ( eregi($pagepattern,$cat_names[count($cat_names)-1]) ) {
					array_pop( $cat_names );
				}
				$cat_id = $this->findCatID( $cat_names );

				switch( end($cat_names) ) {

					case _MT_SEF_MYLISTING:
						$QUERY_STRING .= $this->appendURL( 'task', 'mylisting' );
						$pagenumber = $this->getPageNumber($url_array);
						
						if ( $pagenumber > 0 ) {
							$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_links );
							$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_links * ($pagenumber -1)) );
						}
						break;

					case _MT_SEF_ADVSEARCH:
						$QUERY_STRING .= $this->appendURL( 'task', 'advsearch' );
						break;

					default:
						$QUERY_STRING .= $this->appendURL( 'task', 'listcats' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						
						$pagenumber = $this->getPageNumber($url_array);
						
						if ( $pagenumber > 0 ) {
							$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_links );
							$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_links * ($pagenumber -1)) );
						}
						break;

				} // End switch()

			# (2) Viewing Listing 
			#		- http://example.com/c/mtree/Computer/Games/Donkey_Kong/details/
			#		- http://example.com/c/mtree/Computer/Games/Donkey_Kong/review1/

			
			//} elseif( $url_array[ (count($url_array)-2) ] == _MT_SEF_FEATUREDLISTING ) {
			} elseif( in_array( $url_array[ (count($url_array)-2) ], array( _MT_SEF_POPULARLISTING, _MT_SEF_MOSTRATEDLISTING, _MT_SEF_TOPRATEDLISTING, _MT_SEF_MOSTREVIEWEDLISTING, _MT_SEF_REVIEW, _MT_SEF_RATE, _MT_SEF_RECOMMEND, _MT_SEF_CONTACT, _MT_SEF_REPORT, _MT_SEF_CLAIM, _MT_SEF_VISIT, _MT_SEF_ADDLISTING, _MT_SEF_ADDCATEGORY, _MT_SEF_REVIEWS_PAGE, _MT_SEF_DETAILS ) ) || eregi(_MT_SEF_REVIEWS_PAGE."[0-9]+",$url_array[ (count($url_array)-2) ]) ) {

				// Get the virtual filename
				$vfilename = $url_array[ (count($url_array)-2) ];
				
				switch($vfilename) {
					
					case _MT_SEF_POPULARLISTING:
						$cat_names = array_slice( $url_array, ($pos+2), -2 );
						$cat_id = $this->findCatID( $cat_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'listpopular' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						break;

					case _MT_SEF_MOSTRATEDLISTING:
						$cat_names = array_slice( $url_array, ($pos+2), -2 );
						$cat_id = $this->findCatID( $cat_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'listmostrated' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						break;

					case _MT_SEF_TOPRATEDLISTING:
						$cat_names = array_slice( $url_array, ($pos+2), -2 );
						$cat_id = $this->findCatID( $cat_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'listtoprated' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						break;
						
					case _MT_SEF_MOSTREVIEWEDLISTING:
						$cat_names = array_slice( $url_array, ($pos+2), -2 );
						$cat_id = $this->findCatID( $cat_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'listmostreview' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						break;
						
					case _MT_SEF_REVIEW:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'writereview' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_RATE:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'rate' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_RECOMMEND:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'recommend' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_CONTACT:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'contact' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_REPORT:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'report' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_CLAIM:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'claim' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_VISIT:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'visit' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					case _MT_SEF_ADDLISTING:
						$cat_names = array_slice( $url_array, ($pos+2), -2 );
						$cat_id = $this->findCatID( $cat_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'addlisting' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						break;

					case _MT_SEF_ADDCATEGORY:
						$cat_names = array_slice( $url_array, ($pos+2), -2 );
						$cat_id = $this->findCatID( $cat_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'addcategory' );
						$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
						break;

					case _MT_SEF_DETAILS:
						$path_names = array_slice( $url_array, ($pos+2), -2 );
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'viewlink' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );
						break;

					default:
						$reviewspattern = _MT_SEF_REVIEWS_PAGE . "[0-9]+";
						$isReviewsPage = eregi($reviewspattern,$url_array[ (count($url_array)-2) ]);

						if ($isReviewsPage) {
							$path_names = array_slice( $url_array, ($pos+2), -2 );
						} else {
							$path_names = array_slice( $url_array, ($pos+2) );
						}
						$link_id = $this->findLinkID( $path_names );
						$QUERY_STRING .= $this->appendURL( 'task', 'viewlink' );
						$QUERY_STRING .= $this->appendURL( 'link_id', $link_id );

						// Handling of $limit & $limitstart
						if ( $isReviewsPage ) {

							// Get the page numner
							$pagenumber = substr( $url_array[ (count($url_array)-2) ], strlen(_MT_SEF_REVIEWS_PAGE) );
							
							$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_reviews );
							$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_reviews * ($pagenumber -1)) );

						}
						break;
				}

			# (3) List Alpha
			#   - http://example.com/c/mtree/Game/Action/List_Alpha/[a-z]/[0-9]+
			} elseif( $url_array[ (count($url_array)-4) ] == _MT_SEF_LISTALPHA ) {

				$start = $url_array[ (count($url_array)-3) ];
				$page = $url_array[ (count($url_array)-2) ];
				$cat_names = array_slice( $url_array, ($pos+2), -4 );
				$cat_id = $this->findCatID( $cat_names );
				
				$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
				$QUERY_STRING .= $this->appendURL( 'task', 'listalpha' );
				$QUERY_STRING .= $this->appendURL( 'start', $start );
				$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_links );
				$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_links * ($page -1)) );

			# (4) List Featured
			#   - http://example.com/c/mtree/Game/Action/Featured_Listing/[0-9]+
			} elseif( $url_array[ (count($url_array)-3) ] == _MT_SEF_FEATUREDLISTING ) {

				$page = $url_array[ (count($url_array)-2) ];
				$cat_names = array_slice( $url_array, ($pos+2), -3 );
				$cat_id = $this->findCatID( $cat_names );
				
				$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
				$QUERY_STRING .= $this->appendURL( 'task', 'listfeatured' );
				$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_links );
				$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_links * ($page -1)) );

			# (5) List New
			#   - http://example.com/c/mtree/Game/Action/New_Listing/[0-9]+
			} elseif( $url_array[ (count($url_array)-3) ] == _MT_SEF_NEWLISTING ) {
				global $mt_fe_num_of_newlisting;

				$page = $url_array[ (count($url_array)-2) ];
				$cat_names = array_slice( $url_array, ($pos+2), -3 );
				$cat_id = $this->findCatID( $cat_names );
				
				$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
				$QUERY_STRING .= $this->appendURL( 'task', 'listnew' );
				$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_newlisting );
				$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_newlisting * ($page -1)) );

			# (6) List Owner's listings
			#   - http://example.com/c/mtree/viewowner/Gandalf/1/
			} elseif( $url_array[ (count($url_array)-4) ] == _MT_SEF_OWNER ) {

				$QUERY_STRING .= $this->appendURL( 'task', 'viewowner' );

				$owner_name = $url_array[ (count($url_array)-3) ];
				//$owner_name = reset($owner_name);
				//$owner_length = strlen($owner_name);
				$owner_name = sefdecode($owner_name);

				$database->setQuery( "SELECT id FROM #__users WHERE name='".$owner_name."' LIMIT 1" );
				$user_id = $database->loadResult();
				$QUERY_STRING .= $this->appendURL( 'user_id', $user_id );

				// Get the page number
				$pagenumber = $url_array[ (count($url_array)-2) ]; //substr( $url_array[ (count($url_array)-2) ], ($owner_length + strlen(_MT_SEF_CATEGORY_PAGE) +1) );

				if ( $pagenumber > 0 ) {
					$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_links );
					$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_links * ($pagenumber -1)) );
				}

			# (7) Search Result
			#		- http://example.com/c/mtree/Search/1/searchword/
			} elseif( $url_array[ (count($url_array)-4) ] == _MT_SEF_SEARCH ) {
				
				$cat_names = array_slice( $url_array, ($pos +2), -4 );
				$cat_id = $this->findCatID( $cat_names );
				$searchword = $url_array[ (count($url_array)-2) ];
				$page = $url_array[ (count($url_array)-3) ];
				
				$QUERY_STRING .= $this->appendURL( 'task', "search" );
				$QUERY_STRING .= $this->appendURL( 'cat_id', $cat_id );
				$QUERY_STRING .= $this->appendURL( 'searchword', sefdecode($searchword) );
				$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_searchresults );
				$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_searchresults * ($page -1)) );

			# (8) Advanced Search Result
			#		- http://example.com/c/mtree/AdvSearchR/1/[search_id]
			} elseif( $url_array[ (count($url_array)-4) ] == _MT_SEF_ADVSEARCH2 ) {

				$search_id = $url_array[ (count($url_array)-2) ];
				$page = $url_array[ (count($url_array)-3) ];

				$QUERY_STRING .= $this->appendURL( 'task', "advsearch2" );
				$QUERY_STRING .= $this->appendURL( 'search_id', $search_id );
				$QUERY_STRING .= $this->appendURL( 'limit', $mt_fe_num_of_searchresults );
				$QUERY_STRING .= $this->appendURL( 'limitstart', ($mt_fe_num_of_searchresults * ($page -1)) );
				
			}

		}

		return $QUERY_STRING;

	}


	/********************************************************
	* Utility Functions
	********************************************************/

	/***
	* Append Categories' Pathway
	*/
	function appendCat( $cat_id ) {
		$sefstring = '';

		$pathWay = new mtPathWay( $cat_id );
		$pathway_ids = $pathWay->getPathWay( $cat_id );
		
		foreach( $pathway_ids AS $id ) {
			$sefstring .= sefencode($pathWay->getCatName( $id )) . '/';
		}
		
		// If curreny category is not root, append to sefstring
		if ( $cat_id > 0 ) {
			$sefstring .= sefencode( $pathWay->getCatName( $cat_id ) ) . '/';
		}

		return $sefstring;
	}

	/***
	* Append Listing "filename"
	*/
	function appendListing( $link_name, $link_id, $add_details=false ) {
		$sefstring = '';
		
		if( _MT_SEF_ADD_LINKID ) {
			if( _MT_SEF_ADD_LINKID_ATTACH == 1 ) {
				$sefstring = sefencode( $link_name ) . _MT_SEF_ADD_LINKID_SEP . $link_id . '/';
			} else {
				$sefstring = $link_id . _MT_SEF_ADD_LINKID_SEP . sefencode( $link_name ) . '/';
			}
		} else {
			$sefstring = sefencode( $link_name ) . '/';
		}

		if( $add_details ) {
			$sefstring .= _MT_SEF_DETAILS . '/';
		}

		return $sefstring;
	}

	/***
	* Return value from appendCat + appendListing
	*/
	function appendCatListing( $mtLink, $add_extension=true ) {
			return $this->appendCat( $mtLink->cat_id ) . $this->appendListing( $mtLink->link_name, $mtLink->link_id, false );
	}

	/***
	* Retrieve Cat/Listing's ID from URL string
	*/
	function getID( $type, $string ) {

		$temp = split("&amp;" . $type . "_id=", $string);
		if ( count($temp) >= 2 ) {
			$temp = split("&", $temp[1]);
		} else {
			$temp[0] = 0;
		}
		return intval( $temp[0] );

	}

	/***
	* Return true if a link task matches
	*/
	function listingTaskIs( $task, $string ) {
		return eregi("&amp;task=$task&amp;link_id=",$string);
	}

	/***
	* Return true the task matches
	*/
	function taskIs( $task, $string ) {
		return eregi("&amp;task=$task",$string);
	}

	/***
	* Find Category ID from an array list of names
	* @param array Category name retrieved from SEF Advance URL. 
	*/
	function findCatID( $cat_names ) {
		global $database;

		if ( count($cat_names) == 0 ) {
			return 0;
		}

		// (1) 
		// First Attempt will try to search by category name. 
		// If it returns one result, then this is most probably the correct category
		
		$database->setQuery( "SELECT cat_id FROM #__mt_cats WHERE cat_published='1' AND cat_approved='1' && cat_name ='".sefdecode($cat_names[ (count($cat_names)-1) ])."' " );
		$cat_ids = $database->loadResultArray();
		
		if ( count($cat_ids) == 1 && $cat_ids[0] > 0 ) {

			return $cat_ids[0];
		
		} else {

		// (2)
		// Second attempt will search the category ID by looking from top level to bottom
			$cat_ids = array();

			for( $i=0; $i<count($cat_names); $i++ ) {
				$cat_names[$i] = sefdecode($cat_names[$i]);

				$sql = "SELECT cat_id FROM #__mt_cats "
					.	"\n WHERE cat_published='1' AND cat_approved='1' && cat_name ='".$cat_names[$i]."' ";

				if ( $i > 0 ) {
					$sql .= "&& cat_parent='".$cat_ids[$i-1]."' ";
				} else {
					$sql .= "&& cat_parent='0' ";
				}

				$database->setQuery( $sql );
				$cat_ids[$i] = $database->loadResult();

			}
			
			return end($cat_ids);

		}

	}

	/***
	* Find Listing ID from an array list of names
	* @param array Path names retrieved from SEF Advance URL - http://example.com/c/mtree/Games/Computer_Games/fluid/
	*																													^________________________^
	*/
	function findLinkID( $path_names ) {
		global $database;

		// (1) 
		// First Attempt will try to search by listing name. 
		// If it returns one result, then this is most probably the correct listing
		
		$link_name = $path_names[ (count($path_names)-1) ];
		$link_name = urldecode( $link_name );

		if( _MT_SEF_ADD_LINKID ) {
			if( _MT_SEF_ADD_LINKID_ATTACH == 1 ) {
				// suffix 

				$link_ids[0] = substr( $link_name, (strrpos( $link_name, _MT_SEF_ADD_LINKID_SEP ) + strlen(_MT_SEF_ADD_LINKID_SEP)), ( strlen($link_name)  - strrpos( $link_name, _MT_SEF_ADD_LINKID_SEP ) ) );
				
			} else {
				// prefix
				
				$link_ids[0] = substr( $link_name, 0, strpos( $link_name, _MT_SEF_ADD_LINKID_SEP ) );

			}
			
			if( is_numeric($link_ids[0]) ) {
				return $link_ids[0];
			}

		}
		$link_name = sefdecode( $path_names[ (count($path_names)-1) ]);

		$database->setQuery( "SELECT link_id FROM #__mt_links WHERE link_published='1' AND link_approved='1' && link_name ='".$link_name."' " );
		$link_ids = $database->loadResultArray();

		if ( count($link_ids) == 1 && $link_ids[0] > 0 ) {

			return $link_ids[0];
		
		} else {

		// (2)
		// Second attempt will look for the category ID and then pinpoint the listing ID
			
			$cat_id = $this->findCatID( array_slice($path_names, 0, -1) );
			
			$database->setQuery( "SELECT l.link_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE link_published='1' AND link_approved='1' AND cl.cat_id = '".$cat_id."' AND link_name ='".$link_name."' AND l.link_id = cl.link_id LIMIT 1" );
			
			return $database->loadResult();

		}
	}

	/***
	* Routine function to assign values to $_GET, $_REQUEST and $QUERY_STRING
	*/
	function appendURL( $var, $value ) {
		$_GET[$var] = $value;
		$_REQUEST[$var] = $value;
		return "&".$var."=".$value;
	}

	/***
	* Routine function to restrive $limit & $limitvalue from query string
	*
	* @param int A referenced $limit - number of results shown per page
	* @param int A referenced $limitstart - the record number to start display
	* @param string Query string
	*/
	function getLimits( &$limit, &$limitstart, $string ) {
		// limit
		$temp = split("&amp;limit=", $string);
		if (count($temp) >= 2) {
			$temp = split("&", $temp[1]);
			$limit = $temp[0];
		} else {
			$limit = '';
		}

		// limitstart
		$temp = split("&amp;limitstart=", $string);
		if (count($temp) >= 2) {
			$temp = split("&", $temp[1]);
			$limitstart = $temp[0];
		} else {
			$limitstart = '';
		}

		if ( $limit <> '' && $limitstart <> '' ) {
			return true;
		} else {
			return false;
		}

	}

	/***
	* Try to find the page number from virtual directory - http://example.com/c/mtree/My_Listing/Page3.html
	*
	* @param array $url_array The SEF advance URL split in arrays (first custom virtual directory beginning at $pos+1)
	* @return int Page number
	*/
	function getPageNumber( $url_array) {
		global $mt_fe_num_of_links;

		$pagepattern = _MT_SEF_CATEGORY_PAGE . "[0-9]+";
		$pagenumber = 0;

		if ( eregi($pagepattern,$url_array[ (count($url_array)-2) ]) ) {

			// Get the page number
			$pagenumber = substr( $url_array[ (count($url_array)-2) ], strlen(_MT_SEF_CATEGORY_PAGE));

		}

		return $pagenumber;

	}

}
?>
