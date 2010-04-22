<?php
/**
 * @version		$Id: admin.mtimporter.php 725 2009-06-11 10:53:00Z CY $
 * @package		MT Importer
 * @copyright	(C) 2005-2009 Mosets Consulting. All rights reserved.
 * @license		GNU General Public License
 * @author		Lee Cher Yeong <mtree@mosets.com>
 * @url			http://www.mosets.com/tree/
 */

defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'admin.mtimporter.html.php' );
require_once( JPATH_ADMINISTRATOR.DS.'components' .DS.'com_mtree'.DS.'tools.mtree.php' );

$task		= JRequest::getCmd('task', '');

switch( $task ) {

case "check_csv":
	check_csv();
	break;

case "check_gossamerlinks":
	check_gossamerlinks();
	break;

case "import_gossamerlinks":
	import_gossamerlinks();
	break;

case "import_csv":
	import_csv();
	break;
	
case "import_jcontent":
	$cid = JRequest::getVar( 'cid', array(0), 'post');
	JArrayHelper::toInteger($cid, array(0));
	import_jcontent($cid);
	break;

case "check_jcontent":
default:
	check_jcontent();
	break;
}

function check_jcontent(){
	$database =& JFactory::getDBO();
	
	$database->setQuery( 'SELECT * FROM #__sections' );
	$sections = $database->loadObjectList();
	
	for ( $i=0; $i<count($sections); $i++ ) {
		$database->setQuery('SELECT COUNT(*) FROM #__categories WHERE section = '.$sections[$i]->id);
		$sections[$i]->categories = $database->loadResult();
		
		$database->setQuery('SELECT COUNT(*) FROM #__content WHERE sectionid = '.$sections[$i]->id);
		$sections[$i]->contentitems = $database->loadResult();
	}
	
	// Web links
	$sections[$i]->id = -1;
	$sections[$i]->title = JText::_( 'Web Links' );
	$sections[$i]->checked_out = 0;

	$database->setQuery('SELECT COUNT(*) FROM #__categories WHERE section = ' . $database->quote('com_weblinks') );
	$sections[$i]->categories = $database->loadResult();
	
	$database->setQuery('SELECT COUNT(*) FROM #__weblinks');
	$sections[$i]->contentitems = $database->loadResult();
	
	HTML_mtimporter::check_jcontent($sections);
	
}

function check_gossamerlinks() {
	global $mainframe;
	
	$db = $mainframe->getCfg('db');
	$db_prefix = $mainframe->getCfg('dbprefix');

	$database =& JFactory::getDBO();

	$table_prefix = JRequest::getWord('table_prefix','linksql_');

	# Select gossamer's categories
	$database->setQuery( "show tables from $db like '" . $table_prefix . "Category'" );
	$tmp = $database->loadResult();
	if ( $tmp == $table_prefix . "Category" ) {
		$database->setQuery( "SELECT count(*) FROM " . $table_prefix . "Category" );
		$pt_count['cats'] = $database->loadResult();
	} else {
		$pt_count['cats'] = -1;
	}

	# Select gossamer's related categories
	$database->setQuery( "show tables from $db like '" . $table_prefix . "CatRelations'" );
	$tmp = $database->loadResult();
	if ( $tmp == $table_prefix . "CatRelations" ) {
		$database->setQuery( "SELECT count(*) FROM " . $table_prefix . "CatRelations" );
		$pt_count['relcats'] = $database->loadResult();
	} else {
		$pt_count['relcats'] = -1;
	}

	
	# Select gossamer's listings
	$database->setQuery( "show tables from $db like '" . $table_prefix . "Links'" );
	$tmp = $database->loadResult();
	if ( $tmp == $table_prefix . "Links" ) {
		$database->setQuery( "SELECT count(*) FROM " . $table_prefix . "Links" );
		$pt_count['listings'] = $database->loadResult();
	} else {
		$pt_count['listings'] = -1;
	}
	
	# Find Mosets Tree's Status
	$database->setQuery( "SELECT count(*) FROM #__mt_links" );
	$mt_count['listings'] = $database->loadResult();
	$database->setQuery( "SELECT count(*) FROM #__mt_cats" );
	$mt_count['cats'] = $database->loadResult();

	HTML_mtimporter::check_gossamer( $pt_count, $mt_count, $table_prefix );

}

function check_csv() {
	$database =& JFactory::getDBO();
	HTML_mtimporter::check_csv();
}

function import_jcontent( $cid ) {
	global $mainframe;
	
	$database 	=& JFactory::getDBO();
	$my			=& JFactory::getUser();
	$nullDate	= $database->getNullDate();
	
	$added_cats = 0;
	$added_links= 0;
	
	# Load sections
	$database->setQuery( "SELECT s.id, s.title, s.alias, s.description, s.published FROM #__sections AS s WHERE s.id IN (".implode(",",$cid).")" );
	$sections = $database->loadObjectList();
	
	if( count($sections) > 0 ) {
		foreach( $sections AS $section )
		{
			# Import Section
			$database->setQuery( 
			"INSERT INTO `#__mt_cats` ( `cat_name` , `alias` , `cat_desc` , `cat_parent` , `cat_links` , "
			.	"\n`cat_cats` , `cat_featured` , `cat_published` , `cat_created` , "
			.	"\n`cat_approved` , `cat_template` , `cat_usemainindex` , `metakey` , `metadesc` , `ordering` ) "
			.	"VALUES('".$database->getEscaped($section->title)."', '".$database->getEscaped($section->alias)."', '".$database->getEscaped($section->description)."', 0, 0, "
			.	"\n0, 0, ".$section->published.", ".$database->Quote($nullDate).","
			.	"\n'1', '', 0, '', '', 0)"
			);
			$database->query();
			$section_cat_id = $database->insertid();
			$added_cats++;
			
			# Load Categories
			$database->setQuery( "SELECT c.id, c.title, c.alias, c.description, c.published FROM #__categories AS c WHERE section = '".$section->id."'" );
			$categories = $database->loadObjectList();
			
			if( count($categories) ) {
				foreach( $categories as $category )
				{
					# Import Category
					$database->setQuery( 
					"INSERT INTO `#__mt_cats` ( `cat_name` , `alias` , `cat_desc` , `cat_parent` , `cat_links` , "
					.	"\n`cat_cats` , `cat_featured` , `cat_published` , `cat_created` , "
					.	"\n`cat_approved` , `cat_template` , `cat_usemainindex` , `metakey` , `metadesc` , `ordering` ) "
					.	"VALUES('".$database->getEscaped($category->title)."', '".$database->getEscaped($category->alias)."', '".$database->getEscaped($category->description)."', ".$section_cat_id.", 0, "
					.	"\n0, 0, ".$category->published.", ".$database->Quote($nullDate).","
					.	"\n'1', '', 0, '', '', 0)"
					);
					$database->query();
					$category_cat_id = $database->insertid();
					$added_cats++;
					
					# Load Content
					$database->setQuery( 
					"SELECT `title`, `alias`, CONCAT_WS(' ',`introtext`, `fulltext`) AS description, `created_by`, `state`, images "
					.	"FROM #__content WHERE catid = " . $category->id
					);
					$contents = $database->loadObjectList();
				
					if( count($contents) ) {
						foreach( $contents as $content ) {
							# Parse {mosimage}
							if(trim($content->images)) {
								$images = explode( "\n", $content->images );
								foreach($images AS $image) {
									$attr = explode("|",$image);

									// alt & title
									if ( !isset($attr[2]) || empty($attr[2]) ) {
										$attr[2] = 'Image';
									} else {
										$attr[2] = htmlspecialchars($attr[2]);
									}

									// border
									if ( !isset($attr[3]) || !$attr[3] ) {
										$attr[3] = 0;
									}

									// caption
									if ( !isset($attr[4]) || !$attr[4] ) {
										$attr[4] = '';
										$border = $attr[3];
									} else {
										$border = 0;
									}

									// caption position
									if ( !isset($attr[5]) || !$attr[5] ) {
										$attr[5] = '';
									}

									// caption alignment
									if ( !isset($attr[6]) || !$attr[6] ) {
										$attr[6] = '';
									}

									// width
									if ( !isset($attr[7]) || !$attr[7] ) {
										$attr[7] = '';
										$width = '';
									} else {
										$width = ' width: '. $attr[7] .'px;';
									}
									
									$html = '<img src="' . JURI::root() . 'images/stories/' . $attr[0] . '"';

									if ( function_exists( 'getimagesize' ) ) {
										$size = @getimagesize( JPATH_ROOT.DS.'images'.DS.'stories'.DS.$attr[0] );
										if (is_array($size)) {
											$html .= ' width="'. $size[0] .'" height="'. $size[1] .'"';
										}
									}
									// no aligment variable - if caption detected
									if ( !$attr[4] ) {
										if ($attr[1] == 'left' OR $attr[1] == 'right') {
											$html .= ' style="float: '. $attr[1] .';"';
										} else {
											$html .= $attr[1] ? ' align="middle"' : '';
										}
									}
									
									$html .=' hspace="6" alt="'. $attr[2] .'" title="'. $attr[2] .'" border="'. $border .'" />';
									
									// assemble caption - if caption detected
									$caption = '';
									if ( $attr[4] ) {				
										$caption = '<div class="mosimage_caption"';
										if ( $attr[6] ) {
											$caption .= ' style="text-align: '. $attr[6] .';"';
											$caption .= ' align="'. $attr[6] .'"';
										}
										$caption .= '>';
										$caption .= $attr[4];
										$caption .= '</div>';
									}
									
									if($attr[4]) {
										$float = '';
										$border_width = '';
										$style = '';
										if ( $attr[1] ) {
											$float = ' float: '. $attr[1] .';';
										}
										if ( $attr[3] ) {
											$border_width = ' border-width: '. $attr[3] .'px;';
										}

										if (  $attr[1] || $attr[3] ) {
											$style = ' style="'. $border_width . $float . $width .'"';
										}

										$img = '<div class="mosimage" '. $style .' align="center">'; 

										// display caption in top position
										if ( $attr[5] == 'top' && $caption ) {
											$img .= $caption;
										}
										$html = $img . $html;

										// display caption in bottom position
										if ( $attr[5] == 'bottom' && $caption ) {
											$html .= $caption;
										}
										$html .='</div>';
									}
									$arr_images[] = $html;
								}
							}
							
							if ( strpos( $content->description, 'mosimage' ) !== false ) {
								$regex = '/{mosimage\s*.*?}/i';	
								$GLOBALS['botMosImageCount'] 	= 0;
								$GLOBALS['botMosImageArray'] 	=& $arr_images;
								$content->description = preg_replace_callback( $regex, 'botMosImage_replacer', $content->description );
							}
							
							# Import Content
							$database->setQuery( 
							"INSERT INTO `#__mt_links` ( `link_name` , `alias` , `link_desc` , `user_id`, `link_published`, `link_approved`, `link_created` ) "
							.	"VALUES('".$database->getEscaped($content->title)."', '".$database->getEscaped($content->alias)."', '".$database->getEscaped($content->description)."', '".$content->created_by."', ".$content->state.", '1', ".$database->Quote($nullDate)." )"
							);
							$database->query();
							$link_id = $database->insertid();
							
							$database->setQuery( "INSERT INTO #__mt_cl (link_id, cat_id, main) VALUES( '".$link_id."', '".$category_cat_id."', 1)" );
							$database->query();
							// echo $database->getErrorMsg();
							// echo $database->getQuery();
							$added_links++;
							unset($arr_images);
						}
					}
					
				}
			}

		}
	}
	
	// Importing web links
	if( in_array(-1,$cid) )
	{
		# Insert Web Links section
		$database->setQuery( 
		"INSERT INTO `#__mt_cats` ( `cat_name` , `alias` , `cat_desc` , `cat_parent` , `cat_links` , "
		.	"\n`cat_cats` , `cat_featured` , `cat_published` , `cat_created` , "
		.	"\n`cat_approved` , `cat_template` , `cat_usemainindex` , `metakey` , `metadesc` , `ordering` ) "
		.	"VALUES('".$database->getEscaped(JText::_( 'Web Links' ))."', 'web-links', '', 0, 0, "
		.	"\n0, 0, 1, ".$database->Quote($nullDate).","
		.	"\n'1', '', 0, '', '', 0)"
		);
		$database->query();
		$section_cat_id = $database->insertid();
		$added_cats++;
		
		# Load Categories
		$database->setQuery( "SELECT c.id, c.title, c.alias, c.description, c.published FROM #__categories AS c WHERE section = 'com_weblinks'" );
		$categories = $database->loadObjectList();
		
		if( count($categories) ) {
			foreach( $categories as $category )
			{
				# Import Category
				$database->setQuery( 
				"INSERT INTO `#__mt_cats` ( `cat_name` , `alias` , `cat_desc` , `cat_parent` , `cat_links` , "
				.	"\n`cat_cats` , `cat_featured` , `cat_published` , `cat_created` , "
				.	"\n`cat_approved` , `cat_template` , `cat_usemainindex` , `metakey` , `metadesc` , `ordering` ) "
				.	"VALUES('".$database->getEscaped($category->title)."', '".$database->getEscaped($category->alias)."', '".$database->getEscaped($category->description)."', ".$section_cat_id.", 0, "
				.	"\n0, 0, ".$category->published.", ".$database->Quote($nullDate).","
				.	"\n'1', '', 0, '', '', 0)"
				);
				$database->query();
				$category_cat_id = $database->insertid();
				$added_cats++;
				
				# Load web links
				$database->setQuery( 
				"SELECT `title`, `alias`, `catid`, `url`, `description`, `date`, `hits`, `published`, `approved` "
				.	"FROM #__weblinks WHERE catid = " . $category->id
				);
				$weblinks = $database->loadObjectList();
			
				if( count($weblinks) ) {
					foreach( $weblinks as $weblink ) {
						# Import web links
						$database->setQuery( 
						"INSERT INTO `#__mt_links`"
						.	" ( `link_name` , `alias` , `link_desc` , `user_id`, `link_hits`, `website`, `link_published`, `link_approved`, `link_created` ) "
						.	"VALUES('"
						.	$database->getEscaped($weblink->title)."', '"
						.	$database->getEscaped($weblink->alias)."', '"
						.	$database->getEscaped($weblink->description)."', '"
						.	$my->id."', '"
						.	$weblink->hits."', '"
						.	$weblink->url."', '"
						.	$weblink->published."', '"
						.	$weblink->approved."', '"
						.	$weblink->date."' )"
						);
						$database->query();
						$link_id = $database->insertid();
						$added_links++;
						
						$database->setQuery( "INSERT INTO #__mt_cl (link_id, cat_id, main) VALUES( '".$link_id."', '".$category_cat_id."', 1)" );
						$database->query();
					}
				}
				
			}
		}
	}
	
	# Rebuild tree
	
	if( $added_cats > 0 || $added_links > 0 )
	{
		$tree = new mtTree();
		$tree->rebuild( 0, 1);
		$mainframe->redirect( 'index.php?option=com_mtree', JText::sprintf('Import process Completed. %s categories and %s listings imported.', $added_cats, $added_links) );
	} else {
		$mainframe->redirect( 'index.php?option=com_mtimporter&task=check_jcontent', JText::_('MT Importer did not find any categories or listings available for import. No categories or listings are added to the directory.') );
	}
	
}

function botMosImage_replacer( &$matches ) {
	$i = $GLOBALS['botMosImageCount']++;
	return @$GLOBALS['botMosImageArray'][$i];
}

function import_csv() {
	global $mainframe;
	
	$database =& JFactory::getDBO();
	
	$files = JRequest::get( 'files' );
	$file_csv = $files['file_csv'];
	
	if( isset($file_csv['tmp_name']) && file_exists($file_csv['tmp_name']) )
	{
		# Find user_id for administrator
		$database->setQuery( "SELECT id FROM #__users WHERE username = 'admin' OR usertype = 'Super Administrator' LIMIT 1" );
		$admin_user_id = $database->loadResult();

		# Now, start reading the file
		$row = 0;
		$index_catid = -1;
		$index_linkname = -1;
		$handle = fopen($file_csv['tmp_name'], "r");
	
		// Test if the csv file is using /r as the line ending. If it is, use our custom csv parser.
		$data = fgets($handle, 100000);
		$type = 0;
		// if(strpos($data,"\r") > 0) {
		// 	$type = 1;
		// }
		rewind($handle);
	
		while (($data = mtgetcsv($handle,$type,$row)) !== FALSE) {
			$row++;

			# Set the field name first
			if ( $row == 1 ) {
				$fields = array();
				for ($f=0; $f < count($data); $f++) {
					if ( $data[$f] == 'cat_id' ) {
						$index_catid = $f;
					}
					$fields[] = $data[$f];
					if( $data[$f] == 'link_name' ) {
						$index_linkname = $f;
					} 
				}
				// echo "Fields list: <b>" .implode("|",$fields) . "</b><br />";
			} else {
			
				# Make sure the listing has at least a link_name. Everything else is optional.
				if ( !empty($data[$index_linkname]) ) {
					$num = count($data);
					$sql_cf_ids = array();
					$sql_cf_insertvalues = array();
					$sql_insertfields = array('alias','link_published','link_approved','link_created','user_id');
					$sql_insertvalues = array(JFilterOutput::stringURLSafe($data[$index_linkname]),1,1,date('Y-m-d H:i:s'),$admin_user_id);
					for ($c=0; $c < $num; $c++) {
						if ( !empty($data[$c]) && !empty($fields[$c]) && $c != $index_catid ) {
							switch($fields[$c]) {
								case 'alias':
									$sql_insertvalues[0] = $database->getEscaped($data[$c]);
									break;
								case 'link_published':
									$sql_insertvalues[1] = $database->getEscaped($data[$c]);
									break;
								case 'link_approved':
									$sql_insertvalues[2] = $database->getEscaped($data[$c]);
									break;
								case 'link_created':
									$sql_insertvalues[3] = $database->getEscaped($data[$c]);
									break;
								case 'user_id':
									$sql_insertvalues[4] = $database->getEscaped($data[$c]);
									break;
								default:
									if(is_numeric($fields[$c])) {
										if($fields[$c] > 22) {
											$sql_cf_ids[] = $fields[$c];
											$sql_cf_insertvalues[] = $database->getEscaped($data[$c]);
										}
									} else {
										$sql_insertfields[] = $fields[$c];
										$sql_insertvalues[] = $database->getEscaped($data[$c]);
									}
									break;
							}
							// echo "<br /><b>".$fields[$c].": </b>".$database->getEscaped($data[$c]);
						}
					}
				
					if ( count($sql_insertfields) == count($sql_insertvalues) && count($sql_insertvalues) > 0 ) {
						# Insert core data
						$sql = "INSERT INTO #__mt_links (".implode(",",$sql_insertfields).") VALUES ('".implode("','",$sql_insertvalues)."')";
						$database->setQuery($sql);
						$database->query();
						$link_id = $database->insertid();
						// echo '<br />' . $sql;
					
						# Insert Custom Field's data
						$values = array();
						if(count($sql_cf_ids)>0 && count($sql_cf_insertvalues)>0) {
							$sql = "INSERT INTO #__mt_cfvalues (cf_id,link_id,value) VALUES";
							for($i=0;$i<count($sql_cf_ids);$i++) {
								$values[] = "('" . $sql_cf_ids[$i] . "', '" . $link_id . "', '" . $sql_cf_insertvalues[$i] . "')";
							}
							$sql .= implode(',',$values);
							$database->setQuery($sql);
							$database->query();
							// echo '<br />' . $sql;
						}
					
						# Assign listing to categories
						if(stristr($data[$index_catid],',') === false) {
							$sql = "INSERT INTO #__mt_cl (link_id, cat_id, main) VALUES (".$link_id.", ".( ($index_catid == -1 || empty($data[$index_catid])) ? 0:$data[$index_catid] ).",1)";
							$database->setQuery($sql);
							$database->query();
							// echo '<br />' . $sql;
						# This record is assigning to more than one category at once.
						} else {
							$cat_ids = explode(',',$data[$index_catid]);
							$j = 0;
							foreach($cat_ids AS $cat_id) {
								$sql = 'INSERT INTO #__mt_cl (link_id, cat_id, main) VALUES ('.$link_id.', '.$cat_id.',';
								if($j==0) {
									$sql .= '1';
								} else {
									$sql .= '0';
								}
								$sql .= ')';
								$database->setQuery($sql);
								$database->query();
								// echo '<br />' . $sql;
								++$j;
							}
						}
					}
				}

			}
			// echo '<hr />';
		}

		fclose($handle);

		$mainframe->redirect( 'index.php?option=com_mtree', JText::_( 'Import process Complete!' ) );
	} else {
		$mainframe->redirect( 'index.php?option=com_mtimporter&task=check_csv', JText::_( 'No file specified' ) );
	}
}

function mtgetcsv($handle,$type=0,$line=0) {
	switch($type) {
		case 1:
			rewind($handle);
			$data = fgets($handle);
			$newlinedData = explode("\r",$data);
			if(($line+1)>count($newlinedData)) {
				return false;
			} else {
				$expr="/,(?=(?:[^\"]*\"[^\"]*\")*(?![^\"]*\"))/";
				$results=preg_split($expr,trim($newlinedData[$line]));
				return preg_replace("/^\"(.*)\"$/","$1",$results);
			}
			break;
		case 0:
		default:
			return fgetcsv($handle, 100000, ",");
	}
	
}

function import_gossamerlinks() {
	global $mainframe;
	
	$database =& JFactory::getDBO();
	$table_prefix = JRequest::getWord( 'table_prefix', 'linksql_');

	# Import gossamer's categories

	$database->setQuery( "SELECT * FROM " . $table_prefix . "Category" );
	$categories = $database->loadObjectList();

	// Empty mos_mt_cats
	$database->setQuery( "TRUNCATE TABLE `#__mt_cats`" );
	$database->query();
	$i = 0;

	$database->setQuery( 
		"INSERT INTO #__mt_cats (cat_id, cat_name, cat_parent, "
		.	"cat_desc, cat_links, metadesc, metakey, cat_published, "
		.	"cat_approved, cat_usemainindex, cat_allow_submission) "
		
		.	"SELECT ID, Name, FatherID, "
		.	"Description, Number_of_Links, Meta_Description, Meta_Keywords, '1', "
		.	"'1', '0', '1' "
		.	"FROM " . $table_prefix . "Category"
	);
	$database->query();


	// Insert Root
	$database->setQuery( "INSERT INTO #__mt_cats (cat_name, cat_published, cat_approved, cat_parent, lft) VALUES('Root', 1, 1, -1, 1) " );
	$database->query();
	$root_id = $database->insertid();

	$database->setQuery( "UPDATE #__mt_cats SET cat_id = 0 WHERE cat_id = ".$root_id );
	$database->query();

	// Rebuild tree
	$tree = new mtTree();
	$tree->rebuild( 0, 1);

	# Import Gossamer's related categories

	// Empty mos_mt_cats
	$database->setQuery( "TRUNCATE TABLE `#__mt_relcats`" );
	$database->query();

	$database->setQuery( 
		"INSERT INTO #__mt_relcats (cat_id, rel_id) "
		.	"SELECT CategoryID, RelatedID FROM " . $table_prefix . "CatRelations"
	);
	$database->query();

	# Import Gossamer's links
	/*
	Custom Fields:
	- LinkOwner
	- Contact_Name
	- Password
	*/
	
	// Empty mos_mt_links
	$database->setQuery( "TRUNCATE TABLE `#__mt_links`" );
	$database->query();

	$database->setQuery( 
		// "INSERT INTO #__mt_links (link_id, link_name, website, cust_1, "
		// .	"link_created, link_modified, link_desc, cust_2, email, "
		// .	"link_hits, link_approved, link_published, link_rating, link_votes, cust_3 ) "
		"INSERT INTO #__mt_links (link_id, link_name, website, "
		.	"link_created, link_modified, link_desc, email, "
		.	"link_hits, link_approved, link_published, link_rating, link_votes ) "
		
		.	"SELECT ID, Title, URL, "
		.	"CONCAT_WS(' ', Add_Date, '00:00:00'), CONCAT_WS(' ', Mod_Date, '00:00:00'), Description, Contact_Email, "
		.	"Hits, '1', '1', Rating, Votes "
		.	"FROM " . $table_prefix . "Links"
	);
	$database->query();

	$database->setQuery( "UPDATE #__mt_links set link_rating = link_rating/2" );
	$database->query();
	
	// Create custom fields for LinkOwner, Contact_Name and Password
	$database->setQuery("INSERT INTO `jos_mt_customfields` (`field_type`, `caption`, `default_value`, `size`, `field_elements`, `prefix_text_mod`, `suffix_text_mod`, `prefix_text_display`, `suffix_text_display`, `cat_id`, `ordering`, `hidden`, `required_field`, `published`, `hide_caption`, `advanced_search`, `simple_search`, `details_view`, `summary_view`, `search_caption`, `params`, `iscore`) VALUES ('text', 'Link Owner', '', 30, '', '', '', '', '', 0, 26, 0, 0, 1, 0, 0, 0, 1, 0, '', '', 0)");
	$database->query();
	$linkowner_cf_id = $database->insertid();

	$database->setQuery("INSERT INTO `jos_mt_customfields` (`field_type`, `caption`, `default_value`, `size`, `field_elements`, `prefix_text_mod`, `suffix_text_mod`, `prefix_text_display`, `suffix_text_display`, `cat_id`, `ordering`, `hidden`, `required_field`, `published`, `hide_caption`, `advanced_search`, `simple_search`, `details_view`, `summary_view`, `search_caption`, `params`, `iscore`) VALUES ('text', 'Contact Name', '', 30, '', '', '', '', '', 0, 26, 0, 0, 1, 0, 0, 0, 1, 0, '', '', 0)");
	$database->query();
	$contactname_cf_id = $database->insertid();

	// $database->setQuery("INSERT INTO `jos_mt_customfields` (`field_type`, `caption`, `default_value`, `size`, `field_elements`, `prefix_text_mod`, `suffix_text_mod`, `prefix_text_display`, `suffix_text_display`, `cat_id`, `ordering`, `hidden`, `required_field`, `published`, `hide_caption`, `advanced_search`, `simple_search`, `details_view`, `summary_view`, `search_caption`, `params`, `iscore`) VALUES ('text', 'Password', '', 30, '', '', '', '', '', 0, 26, 1, 0, 1, 0, 0, 0, 0, 0, '', '', 0)");
	// $database->query();
	// $password_cf_id = $database->insertid();
	
	// Populate the custom fields
	$database->setQuery( "INSERT INTO #__mt_cfvalues (cf_id, link_id, value) "
		.	"SELECT '" . $linkowner_cf_id . "', ID, LinkOwner "
		.	"FROM " . $table_prefix . "Links" );
	$database->query();

	$database->setQuery( "INSERT INTO #__mt_cfvalues (cf_id, link_id, value) "
		.	"SELECT '" . $contactname_cf_id . "', ID, Contact_Name "
		.	"FROM " . $table_prefix . "Links" );
	$database->query();
	
	// $database->setQuery( "INSERT INTO #__mt_cfvalues (cf_id, link_id, value) "
	// 	.	"SELECT '" . $password_cf_id . "', ID, Password "
	// 	.	"FROM " . $table_prefix . "links" );
	// $database->query();
	
	# Import Gossamer's catlinks

	$database->setQuery( "SELECT * FROM " . $table_prefix . "CatLinks" );
	$relcats = $database->loadObjectList();

	$database->setQuery( "TRUNCATE TABLE `#__mt_cl`" );
	$database->query();

	$cache = array();

	foreach( $relcats AS $rl ) {
		
		if ( in_array($rl->LinkID,$cache) ) {
			$database->setQuery( "INSERT INTO #__mt_cl (link_id, cat_id, main) VALUES( '".$rl->LinkID."', '".$rl->CategoryID."', '0')" );
		} else {
			$database->setQuery( "INSERT INTO #__mt_cl (link_id, cat_id, main) VALUES( '".$rl->LinkID."', '".$rl->CategoryID."', '1')" );
			$cache[] = $rl->LinkID;
		}

		$database->query();
	}

	// Insert Root
	/*
	$database->setQuery( "INSERT INTO #__mt_cats (cat_name, cat_published, cat_approved, cat_parent, lft) VALUES('Root', 1, 1, -1, 1) " );
	$database->query();
	$root_id = $database->insertid();

	$database->setQuery( "UPDATE #__mt_cats SET cat_id = 0 WHERE cat_id = ".$root_id );
	$database->query();
	*/
	
	// Rebuild tree
	$tree = new mtTree();
	$tree->rebuild( 0, 1);

	$mainframe->redirect( 'index.php?option=com_mtree', 'Import process Complete!' );

}

?>