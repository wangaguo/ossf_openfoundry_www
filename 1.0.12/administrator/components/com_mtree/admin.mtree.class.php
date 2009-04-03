<?php
/**
* Mosets Tree class
*
* @package Mosets Tree 1.5
* @copyright (C) 2005 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define ('mt_version',"1.59");
define ('mt_name', "Mosets Tree");

class mtPathWay {

	var $cat_id = null;

	function mtPathWay( $cat_id=0 ) {
		$this->cat_id = $cat_id;
	}

	/***
	* Generates a pathway based from $link_id, if provided. Otherwise, it will lookup
	* this class cat_id ($this->cat_id) to generate the pathway
	*/
	function printPathWayFromLink( $link_id=0, $url='' ) {
		global $database, $_MT_LANG;

		# Get Cat ID
		if ( $link_id > 0 ) {
			$database->setQuery( "SELECT cl.cat_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND l.link_id ='".$link_id."' AND cl.main = '1'" );
			$this->cat_id = $database->loadResult();
		}

		# Generate the pathway array
		$path = $this->getPathWay( $this->cat_id );
		
		if ( $url <> '' ) {
			echo '<a href="'.$url.'">'.$_MT_LANG->ROOT.'</a> ';
		} else {
			echo $_MT_LANG->ROOT;
		}

		foreach($path AS $cat_id) {
			$database->setQuery("SELECT cat_name, cat_id FROM #__mt_cats WHERE cat_id = '".$cat_id."'");//Modify by ally 2008/01/09
			$cat_name = $database->loadResult();
			if ( $url <> '' ) {
				echo $_MT_LANG->ARROW.'<a href="'.$url.'&cat_id='.$cat_id.'">'.$cat_name.'</a> ';
			} else {
				echo $_MT_LANG->ARROW.$cat_name;
			}
		}

		if ($link_id > 0) {
			if ($this->cat_id > 0) {
				if ( $url <> '' ) {
					echo $_MT_LANG->ARROW.'<a href="'.$url.'&cat_id='.$this->cat_id.'">'.$this->getCatName().'</a> ';
				} else {
					echo $_MT_LANG->ARROW.$this->getCatName();
				}
			}
			$database->setQuery("SELECT link_name FROM #__mt_links WHERE link_id='".$link_id."'");
			//echo $database->loadResult();
		} else {

			if ( $this->cat_id > 0 ) {
				# Print current directory
				echo $_MT_LANG->ARROW.$this->getCatName();
			}

		}
	}

	function printPathWayWithCurrentCat( $link_id=0, $url ) {
		global $database, $_MT_LANG;

		$path = $this->getPathWay();
		
		echo "<a href=".$url.">".$_MT_LANG->ROOT."</a> > ";

		foreach($path AS $cat_id) {
			$database->setQuery("SELECT cat_name, cat_id FROM #__mt_cats WHERE cat_id = '".$cat_id."'");//Modify by ally 2008/01/09
			$cat_name = $database->loadResult();
			echo '<a href="'.$url.'&cat_id='.$cat_id.'">'.$cat_name.'</a> > ';
		}

		if ($link_id > 0) {
			if ($this->cat_id > 0) {
				echo '<a href="'.$url.'&cat_id='.$this->cat_id.'">'.$this->getCatName().'</a> > ';
			}
			$database->setQuery("SELECT link_name FROM #__mt_links WHERE link_id='".$link_id."'");
			echo $database->loadResult();
		} else {
			# Print current directory
			echo '<a href="'.$url.'&cat_id='.$this->cat_id.'">'.$this->getCatName().'</a>';
			//echo $this->getCatName();
		}
	}

	function printPathWayFromCat( $cat_id=0, $withlink=0 ) {
		global $database, $_MT_LANG;

		$old_cat_id = $this->cat_id ;
		$this->cat_id = $cat_id;
		$path = $this->getPathWay( $cat_id );
		
		$return = '';

		if ( $withlink ) {
			//echo '<a href="index2.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'">'.$_MT_LANG->ROOT.'</a> '.$_MT_LANG->ARROW;
			$return .= '<a href="index2.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'">'.$_MT_LANG->ROOT.'</a> '.$_MT_LANG->ARROW;
		} else {
			//echo $_MT_LANG->ROOT." ";
			$return .= $_MT_LANG->ROOT." ";
		}

		foreach($path AS $cat_id) {
			$database->setQuery("SELECT cat_name, cat_id FROM #__mt_cats WHERE cat_id = '".$cat_id."'");//Modify by ally 2008/01/09
			$cat_name = $database->loadResult();
			if ( $withlink ) {
				//echo '<a href="index2.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'">'.$cat_name.'</a> '.$_MT_LANG->ARROW;
				$return .= '<a href="index2.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'">'.$cat_name.'</a> '.$_MT_LANG->ARROW;
			} else {
				//echo $_MT_LANG->ARROW.$cat_name;
				$return .= $_MT_LANG->ARROW.$cat_name;
			}
		}
		
		$this->cat_id = $old_cat_id;
		
		return $return;

	}

	function printPathWayFromCat_withCurrentCat( $cat_id=0, $withlink=0 ) {

		global $_MT_LANG;

		$return = '';
		$return .= $this->printPathWayFromCat( $cat_id, $withlink );

		if ( $cat_id <> 0 ) {
			if ( $withlink ) {
				$return .= '<a href="index2.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'">'.$this->getCatName( $cat_id ).'</a> '.$_MT_LANG->ARROW;
			} else {
				$return .= $_MT_LANG->ARROW;
				$return .= $this->getCatName( $cat_id );
			}
		}

		return $return;

	}

	function getPathWay( $node=0 ) {
		global $database;
		
		$path = array();
		if ( $node > 0 ) {
			global $cache_paths;

			if ( !isset($cache_paths) || empty($cache_paths) || !array_key_exists($node,$cache_paths) || empty($cache_paths[$node]) ) {
				$database->setQuery("SELECT lft, rgt FROM #__mt_cats WHERE cat_id = ".(($node <= 0) ? $this->cat_id : $node));
				$database->loadObject( $left_right );

				if (!empty($left_right)) {
					$database->setQuery("SELECT cat_id FROM #__mt_cats WHERE lft < $left_right->lft AND rgt > $left_right->rgt AND cat_id > 0 AND cat_parent >= 0 ORDER BY lft ASC");
					$cache_paths[$node] = $database->loadResultArray();
				}

			}
			return $cache_paths[$node]; 
		}
		return $path;
		
	}
	
	function getPathWayWithCurrentCat() {
		$path = $this->getPathWay( $this->cat_id );
		$path[] = $this->cat_id;
		return $path;
	}

	function getCatName( $cat_id = '' ) {
		global $database;

		# look up the name for this category
		if ( $cat_id == '' ) {
			$database->setQuery("SELECT cat_name FROM #__mt_cats WHERE cat_id = '".$this->cat_id."'");
			return $database->loadResult();
		} else {
			global $cache_cat_names;
			if ( empty($cache_cat_names) || !array_key_exists($cat_id,$cache_cat_names) ) {
				$database->setQuery("SELECT cat_name, cat_id FROM #__mt_cats WHERE cat_id = '".$cat_id."'");//Modify by ally 2008/01/09
				$cache_cat_names[$cat_id] = $database->loadResult();
			}
			return $cache_cat_names[$cat_id];
		}
	}
}

/**
* Link Categories Table class
*/
class mtCats extends mosDBTable {
	var $cat_id=null;
	var $cat_name=null;
	var $cat_desc=null;
	var $cat_parent=null;
	var $cat_links=null;
	var $cat_cats=null;
	var $cat_featured=null;
	var $cat_image=null;
	var $cat_published=null;
	var $cat_created=null;
	var $cat_approved=null;
	var $cat_template=null;
	var $cat_usemainindex=null;
	var $cat_allow_submission=null;
	var $cat_show_listings=null;
	var $metakey=null;
	var $metadesc=null;
	var $ordering=null;
	var $lft=null;
	var $rgt=null;

	function mtCats( &$db ) {
		$this->mosDBTable( '#__mt_cats', 'cat_id', $db );
	}

	/***
	 * Return true if the given category is a child
	 */
	 function isChild( $child_id ) {
		$this->_db->setQuery( "SELECT lft, rgt FROM #__mt_cats WHERE cat_id = '".$child_id."' LIMIT 1" );
		$this->_db->loadObject($child);

		if( $child->lft > $this->lft && $child->rgt < $this->rgt ) {
			return true;
		} else {
			return false;
		}
	 }

	/***
	* Update parent cat - increase categories count
	*/
	function updateCatCount( $inc=1 ) {
		if ($this->cat_id <= 0) {
			return false;
		} else {
		
			$cat_parent_ids = mtPathWay::getPathWay( $this->cat_id );
			
			if ( !empty($cat_parent_ids) ) {
				
				$cat_parent_ids2 = implode(',',$cat_parent_ids);
				//echo $cat_parent_ids2;
				if ($inc < 0) {
					$this->_db->setQuery("UPDATE #__mt_cats SET cat_cats = (cat_cats - ABS($inc)) WHERE cat_id IN ($cat_parent_ids2)");
				} else {
					$this->_db->setQuery("UPDATE #__mt_cats SET cat_cats = (cat_cats + ABS($inc)) WHERE cat_id IN ($cat_parent_ids2)");
				}

				if (!$this->_db->query()) {
					echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
					return false;
				}

			}
			return true;
		}
	}

	function updateLftRgt() {
		
		# Retrieve parent's rgt value
		$this->_db->setQuery( "SELECT rgt FROM #__mt_cats WHERE cat_id = $this->cat_parent LIMIT 1" );
		$parent_rgt = $this->_db->loadResult();
		
		if ( is_null($parent_rgt) && $this->cat_parent == 0 ) {
			$this->_db->setQuery( "SELECT rgt FROM #__mt_cats WHERE cat_parent = -1 LIMIT 1" );
			$parent_rgt = $this->_db->loadResult();

			if ( is_null($parent_rgt) ) {
				$this->_db->setQuery( "SELECT rgt FROM #__mt_cats WHERE cat_name = 'Root' LIMIT 1" );
				$parent_rgt = $this->_db->loadResult();

				if ( is_null($parent_rgt) ) {
					$this->_db->setQuery( "SELECT (MAX(rgt) +1) FROM #__mt_cats" );
					$parent_rgt = $this->_db->loadResult();
				}

			}

		}

		# Update all category's lft and rgt (+ 2) to the right of this category
		$this->_db->setQuery("UPDATE #__mt_cats SET lft = lft+2 WHERE lft >= $parent_rgt");
		if (!$this->_db->query()) {
				echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				return false;
		}

		$this->_db->setQuery("UPDATE #__mt_cats SET rgt = rgt+2 WHERE rgt >= $parent_rgt");
		if (!$this->_db->query()) {
				echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				return false;
		}

		# Update this category's lft and rgt
		$this->_db->setQuery("UPDATE #__mt_cats SET lft = ".$parent_rgt.", rgt = ".($parent_rgt+1)." WHERE cat_id = $this->cat_id");
		if (!$this->_db->query()) {
				echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				return false;
		}
		$this->lft = $parent_rgt;
		$this->rgt = $parent_rgt+1;

		return true;

	}


	/***
	* Delete individual Category
	*/
	function deleteCat( $cat_id ) {
		global $mosConfig_absolute_path, $mt_cat_image_dir;

		# Delete all the links
		$this->delCatLinks( $cat_id );

		# Delete all related categories
		$this->_db->setQuery( "DELETE FROM #__mt_relcats WHERE cat_id = '".$cat_id."'" );
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		# Remove the photos
		$this->_db->setQuery( "SELECT cat_image FROM #__mt_cats WHERE cat_id = '".$cat_id."'" );
		$cat_image = $this->_db->loadResult();

		if ( $cat_image <> '' ) {
			unlink( $mosConfig_absolute_path.$mt_cat_image_dir.$cat_image );
		}

		# Delete this cat
		$this->_db->setQuery("DELETE FROM #__mt_cats WHERE cat_id = '".$cat_id."'");

		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		return true;

	}
	
	/***
	* Delete Category recursively
	*/
	function deleteCats( $cat_id ) {

		# Find lft & rgt value of this category
		$this->_db->setQuery( "SELECT lft, rgt, cat_approved FROM #__mt_cats WHERE cat_id = $cat_id LIMIT 1" );
		$this->_db->loadObject( $lr );		

		if ( $lr->cat_approved == 0 OR ($lr->lft == 0 AND $lr->rgt == 0) ) {

			$cat_ids = array( $cat_id );

		} else {

			#Look up all categories committed for deletion
			$this->_db->setQuery( "SELECT cat_id FROM #__mt_cats WHERE lft >= $lr->lft AND rgt <= $lr->rgt" );
			$cat_ids = $this->_db->loadResultArray();
		
		}

		# Remove categories
		foreach( $cat_ids AS $cid ) {
			$this->deleteCat( $cid );
		}

		# Update all categories to the right
		$this->_db->setQuery(" UPDATE #__mt_cats SET lft = lft-".(count($cat_ids)*2)." WHERE lft > $lr->rgt");
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		$this->_db->setQuery(" UPDATE #__mt_cats SET rgt = rgt-".(count($cat_ids)*2)." WHERE rgt > $lr->rgt");
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		return true;

	}

	/***
	* Delete all links for a category
	*/
	function delCatLinks( $cat_id ) {

		$this->_db->setQuery("SELECT l.link_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE cl.link_id = l.link_id AND cl.cat_id = '".$cat_id."' AND cl.main = '1'");
		$link_ids = $this->_db->loadResultArray();

		# Remove all hard listing
		foreach($link_ids AS $link_id) {
			mtLinks::delLink( $link_id );
		}

		# Remove all soft listing
		$this->_db->setQuery("DELETE FROM #__mt_cl WHERE cat_id = '".$cat_id."'");
		$this->_db->query();

		return true;
	}

	/***
	* Publish Category
	*/
	function publishCat( $publish, $cat_id=0 ) {
		
		# Determine which Cat ID to use. If none, return false.
		if ( $this->cat_id > 0 ) {
			$cid = $this->cat_id;
		} elseif ( $cat_id > 0) {
			$cid = $cat_id;
		} else {
			return false;
		}

		$this->_db->setQuery("UPDATE #__mt_cats SET cat_published = '".$publish."' WHERE cat_id = '".$cid."'");
	
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		} else {
			return true;
		}

	}

	/***
	* Approve Category
	*/
	function approveCat( $cat_id=0 ) {
		
		# Determine which Cat ID to use. If none, return false.
		if ( $this->cat_id > 0 ) {
			$cid = $this->cat_id;
		} elseif ( $cat_id > 0) {
			$cid = $cat_id;
		} else {
			return false;
		}

		$this->_db->setQuery("UPDATE #__mt_cats SET cat_approved = '1' WHERE cat_id = '".$cid."'");
	
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		} else {
			return true;
		}

	}

	/***
	* Set Featured for category
	*/
	function setFeaturedCat( $featured=1, $cat_id=0 ) {
		if ($cat_id == 0 && $this->cat_id > 0) {
			$this->_db->setQuery("UPDATE #__mt_cats SET cat_featured = '".$featured."' WHERE cat_id = '".$this->cat_id."'");
		} else {
			$this->_db->setQuery("UPDATE #__mt_cats SET cat_featured = '".$featured."' WHERE cat_id = '".$cat_id."'");
		}
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		} else {
			return true;
		}
	}

	/***
	* Set all sub categories to use the same template
	*/
	function updateSubCatsTemplate() {
		$mtPathway = new mtPathway();
		
		$subcats = $this->getSubCats_Recursive( $this->cat_id );

		$this->_db->setQuery( "UPDATE $this->_tbl SET cat_template = '$this->cat_template' WHERE cat_id IN(". implode(',',$subcats) .") " );
		$this->_db->query();
	}

	/***
  * Return an array with all sub categories (including owner)
	*/
	function getSubCats_Recursive( $cat_id='', $published_only=false ) {
		
		$subcats = array();

		// Find current category's lft and rgt value
		$this->_db->setQuery("SELECT lft, rgt FROM #__mt_cats WHERE cat_id = $cat_id LIMIT 1");
		$this->_db->loadObject($left_right);
		
		if ( !empty($left_right)) {
			// Find all subcategories
			if ( $published_only ) {
				$sql = "SELECT cat_id FROM #__mt_cats WHERE lft BETWEEN $left_right->lft AND $left_right->rgt AND cat_published = 1";
			} else {
				$sql = "SELECT cat_id FROM #__mt_cats WHERE lft BETWEEN $left_right->lft AND $left_right->rgt";
			}

			$this->_db->setQuery($sql);
			$subcats = $this->_db->loadResultArray();
		}

		return $subcats;

	}

	/***
	* Copy Category
	*/
	function copyCategory( $cat_id, $dest, $copy_subcats, $copy_relcats, $copy_listings, $copy_reviews, $reset_hits, $reset_rating, $increment=null ) {
		global $database;
		static $copied_cat_ids;

		# Get original cat's info
		$this->_db->setQuery( "SELECT * FROM $this->_tbl WHERE cat_id = '".$cat_id."' LIMIT 1" );
		$this->_db->loadObject( $org_cat );

		# Get $dest (New cat parent)'s lft & rgt

		if ( is_null($increment) ) {
			$this->_db->setQuery( "SELECT lft, rgt FROM $this->_tbl WHERE cat_id = '".$dest."' LIMIT 1" );
			$this->_db->loadObject( $new_cat );

			$inc = $new_cat->rgt - $org_cat->lft;

			$copied_cat_ids = array();
		} else {
			$inc = $increment;
		}

		# Change cat_parent
		$org_cat->cat_parent = $dest;

		# Copy cat
		$this->_db->setQuery( "INSERT INTO $this->_tbl (cat_name, cat_desc, cat_parent, cat_links, cat_cats, cat_featured, cat_image, cat_published, cat_created, cat_approved, cat_template, metakey, metadesc, ordering, lft, rgt) VALUES('".mysql_escape_string($org_cat->cat_name)."', '".mysql_escape_string($org_cat->cat_desc)."', '$org_cat->cat_parent', '".(($copy_listings)?$org_cat->cat_links:'0')."', '$org_cat->cat_cats', '$org_cat->cat_featured', '$org_cat->cat_image', '$org_cat->cat_published', '$org_cat->cat_created', '$org_cat->cat_approved', '$org_cat->cat_template', '".mysql_escape_string($org_cat->metakey)."', '".mysql_escape_string($org_cat->metadesc)."', '$org_cat->ordering', ".($org_cat->lft + $inc).", ".($org_cat->rgt + $inc)." )" );
		
		//, (".$org_cat->lft + $inc."), (".$org_cat->rgt + $inc.") )" );
		$this->_db->query();
		//echo "<br />(org_cat->lft:".$org_cat->lft."|inc:".$inc.")".$this->_db->getQuery();

		$new_cat_parent = mysql_insert_id();
		$copied_cat_ids[] = $new_cat_parent;

		# Copy image
		global $mosConfig_absolute_path, $mt_cat_image_dir;
		$file = $mosConfig_absolute_path.$mt_cat_image_dir.$org_cat->cat_image;

		if ( $org_cat->cat_image ) {
			if( 
			copy( $file, $mosConfig_absolute_path.$mt_cat_image_dir.$new_cat_parent."_".(substr($org_cat->cat_image, strpos( $org_cat->cat_image, "_" )+1 )) ) ) {
				$this->_db->setQuery( "UPDATE #__mt_cats SET cat_image = '".$new_cat_parent."_".(substr($org_cat->cat_image, strpos( $org_cat->cat_image, "_" )+1 ))."' WHERE cat_id = '".$new_cat_parent."'" );
				$this->_db->query();
			}
		}

		# Copy Related Categories
		$this->_db->setQuery( "SELECT rel_id FROM #__mt_relcats WHERE cat_id = '".$cat_id."'" );
		$rel_ids = $this->_db->loadResultArray();

		if ( count( $rel_ids ) > 0 && $copy_relcats == 1 ) {
			foreach( $rel_ids AS $rel_id ) {
				$this->_db->setQuery( "INSERT INTO #__mt_relcats ( cat_id, rel_id ) VALUES ( '$new_cat_parent', '$rel_id' )" );
				$this->_db->query();
			}
		}

		# Copy listings
		if ( $copy_listings == 1 ) {

			$this->_db->setQuery( "SELECT l.link_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND cl.cat_id ='".$cat_id."' AND cl.main = '1'" );
			$listings = $this->_db->loadResultArray();

			if ( count($listings) > 0 ) {
				foreach( $listings AS $listing ) {
					
					$l = new mtLinks( $database );
					$l->copyLink( $listing, $new_cat_parent, $reset_hits, $reset_rating, $copy_reviews);

				}
			}
			
			# Copy soft listing / CL mapping
			$this->_db->setQuery( "INSERT INTO #__mt_cl( link_id, cat_id, main ) SELECT link_id, '".$new_cat_parent."', '0' FROM #__mt_cl WHERE cat_id = '".$cat_id."'" );
			$this->_db->query();
			
		}

		# Copy Sub categories
		$this->_db->setQuery( "SELECT cat_id FROM $this->_tbl WHERE cat_parent = '".$cat_id."'" );
		$subcats = $this->_db->loadResultArray();

		if ( count($subcats) > 0 && $copy_subcats == 1 ) {
			foreach( $subcats AS $subcat ) {
				$this->copyCategory( $subcat, $new_cat_parent, $copy_subcats, $copy_relcats, $copy_listings, $copy_reviews, $reset_hits, $reset_rating, $inc );
			}
		}
		
		return $copied_cat_ids;

	}

	/***
	* Returns total number of sub categories
	*/
	function getNumOfCats( $cat_id ) {
		if ($cat_id <= 0) {
			// Counting number of cats for root
			$this->_db->setQuery("SELECT COUNT(*) as total FROM #__mt_cats WHERE cat_parent = '0'");
			return $this->_db->loadResult();
		} else {
			return $this->cat_cats;
		}
	}

	/***
	* Returns total number of related categories
	*/
	function getNumOfRelCats( $cat_id=0 ) {
		if ($cat_id <= 0) {
			// Counting number of cats for root
			$cat_id = $this->cat_id;
		}

		$this->_db->setQuery("SELECT COUNT(*) as total FROM #__mt_relcats WHERE cat_id = '$cat_id'");
		return $this->_db->loadResult();
	}

	/***
	* Returns total number of links, Recursively
	*/
	function getNumOfLinks( $cat_id ) {
		if ($cat_id <= 0) {
			// Counting number of cats for root
			$this->_db->setQuery("SELECT COUNT(*) as total FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND cl.cat_id = '0'");
			return $this->_db->loadResult();
		} else {
			return $this->cat_links;
		}
	}

	/***
	* Returns total number of links for this category ONLY
	*/
	function getNumOfLinks_NoRecursive( $cat_id=0, $approved=1 ) {
		$this->_db->setQuery("SELECT COUNT(*) as total FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND cl.cat_id = '$cat_id' AND l.link_approved = '$approved'");
		return $this->_db->loadResult();
	}

	/***
	* Returns Parent category
	*/
	function getParent( $cat_id=0 ) {
		
		if ($this->cat_id > 0 && $cat_id == 0) {
			return $this->cat_parent;
		} else {
			$this->_db->setQuery("SELECT cat_parent FROM #__mt_cats WHERE cat_id = '$cat_id'");
			return $this->_db->loadResult();
		}
	}

	function getName( $cat_id=0 ) {
		global $_MT_LANG;
		if ($cat_id == 0) {
			//return $this->cat_name;
			return $_MT_LANG->ROOT;
		} else {
			$this->_db->setQuery("SELECT cat_name FROM #__mt_cats WHERE cat_id = '$cat_id'");
			return $this->_db->loadResult();
		}
	}

}

class mtCL extends mosDBTable {

	var $cl_id=null;
	var $link_id=null;
	var $cat_id=null;
	var $main=null;
	
	function mtCL( &$db ) {
		$this->mosDBTable( '#__mt_cl', 'cl_id', $db );
	}
	
	function update( $cat_id, $link_id ) {
		$this->_db->setQuery( "SELECT * FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id = cl.link_id AND l.link_id = $link_id " );
		$this->_db->loadObject( $ori );
		$this->_db->setQuery( "UPDATE #__mt_cl SET cat_id = $cat_id WHERE cat_id = $ori->cat_id AND link_id = $link_id" );
		$this->_db->query();
	}
	
}

class mtCL_main0 {

	var $_db=null;
	var $link_id=null;
	var $cat_id=null;
	var $other_cat_ids=null;

	function mtCL_main0( &$db ) {
		$this->_db = $db;
	}

	function load( $link_id ) {
		$this->link_id = $link_id;

		$this->_db->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = '$link_id' AND main = '0'" );
		$this->other_cat_ids = $this->_db->loadResultArray();

		$this->_db->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = '$link_id' AND main = '1' LIMIT 1" );
		$this->cat_id = $this->_db->loadResult();

		return true;
	}
	
	function update( $new_other_cat_ids ) {
		
		$new_other_cat_ids = array_diff( $new_other_cat_ids, (array("0"=>$this->cat_id)) );

		// Get the new other cats
		$removes = array_diff( $this->other_cat_ids, $new_other_cat_ids );
		foreach( $removes AS $remove ) {
			$this->_db->setQuery( "DELETE FROM #__mt_cl WHERE link_id = '".$this->link_id."' AND cat_id = '".$remove."' AND main = '0'" );
			$this->_db->query();
			mtUpdateLinkCount( $remove, -1 );
		}

		// Get the soon to be removed cats
		$adds = array_diff( $new_other_cat_ids, $this->other_cat_ids );
		foreach( $adds AS $add ) {
			if ( is_numeric($add) ) {
				$this->_db->setQuery( "INSERT INTO #__mt_cl ( link_id, cat_id, main )  VALUES('".$this->link_id."', '".$add."', '0')" );
				$this->_db->query();
				mtUpdateLinkCount( $add, 1 );
			}
		}
		

	}
	
}

/**
* Links Table class
*/
class mtLinks extends mosDBTable {
	var $link_id=null;
	var $link_name=null;
	var $link_desc=null;
	var $user_id=null;
	var $cat_id=null;
	var $link_hits=null;
	var $link_votes=null;
	var $link_rating=null;
	var $link_featured=null;
	var $link_image=null;
	var $link_published=null;
	var $link_approved=null;
	var $link_template=null;
	var $attribs=null;
	var $metakey=null;
	var $metadesc=null;
	var $internal_notes=null;
	var $ordering=null;
	var $link_created=null;
	var $publish_up=null;
	var $publish_down=null;
	var $link_modified=null;
	var $link_visited=null;
	var $address=null;
	var $city=null;
	var $state=null;
	var $country=null;
	var $postcode=null;
	var $telephone=null;
	var $fax=null;
	var $email=null;
	var $website=null;
	var $price=null;
	var $cust_1=null;
	var $cust_2=null;
	var $cust_3=null;
	var $cust_4=null;
	var $cust_5=null;
	var $cust_6=null;
	var $cust_7=null;
	var $cust_8=null;
	var $cust_9=null;
	var $cust_10=null;
	var $cust_11=null;
	var $cust_12=null;
	var $cust_13=null;
	var $cust_14=null;
	var $cust_15=null;
	var $cust_16=null;
	var $cust_17=null;
	var $cust_18=null;
	var $cust_19=null;
	var $cust_20=null;
	var $cust_21=null;
	var $cust_22=null;
	var $cust_23=null;
	var $cust_24=null;
	var $cust_25=null;
	var $cust_26=null;
	var $cust_27=null;
	var $cust_28=null;
	var $cust_29=null;
	var $cust_30=null;

	function mtLinks( &$db ) {
		$this->mosDBTable( '#__mt_links', 'link_id', $db );
	}

//	function store( $cat_id, $updateNulls=false ) {
	function store( $updateNulls=false ) {

		$k = $this->_tbl_key;
		global $migrate, $database;
		$cl = new mtCL( $database );

		if( $this->$k && !$migrate) {
			$cl->update( $this->cat_id, $this->link_id );
			unset( $this->cat_id);
			$ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
		} else {
			// Store a new map to #__mt_cl
			$cl->cat_id = $this->cat_id;
			$cl->main = 1;

			unset( $this->cat_id);
			$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );

			$cl->link_id = $this->link_id;
			if (!$cl->store()) {
				echo "<script> alert('".$cl->getError().": $this->link_id"." - $cl->link_id "."'); window.history.go(-1); </script>\n";
				exit();
			}

		}
		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}

	function load( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$oid = $this->$k;
		if ($oid === null) {
			return false;
		}
		$this->_db->setQuery( "SELECT l.*, cl.cat_id AS cat_id FROM #__mt_links AS l, #__mt_cl AS cl WHERE l.link_id=cl.link_id AND l.link_id='$oid' AND main='1'" );
		return $this->_db->loadObject( $this );
	}
	
	/***
	* Update parent cat - increase links count
	*
	* A simple routine to increase or decrease a category's link 
	* count. If no category is specified, it will default to the 
	* link's parent category. The update bubbles up to top level 
	* category.
	*/
	function updateLinkCount( $inc=1, $cat_id = null ) {
		
		if ( !isset($this->cat_id) && is_null($cat_id) ) {
			return false;
		} elseif ( is_null($cat_id) && $this->cat_id > 0 ) {
			$cat_id = $this->cat_id;
		} 
		
		$mtPathWay = new mtPathWay( $cat_id );
		$cat_parent_ids = implode(',',$mtPathWay->getPathWayWithCurrentCat());

		//echo "<br />cat_parent_ids (cat_id:".$cat_id.") - ".$cat_parent_ids;

		if ($inc < 0) {
			$this->_db->setQuery("UPDATE #__mt_cats SET cat_links = (cat_links - ABS($inc)) WHERE cat_id IN ($cat_parent_ids)");
		} else {
			$this->_db->setQuery("UPDATE #__mt_cats SET cat_links = (cat_links + ABS($inc)) WHERE cat_id IN ($cat_parent_ids)");
		}

		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		return true;

	}

	/***
	* Publish Link
	*/
	function publishLink( $publish, $link_id=0 ) {
		
		# Determine which Link ID to use. If none, return false.
		if ( $this->link_id > 0 ) {
			$lid = $this->link_id;
		} elseif ( $link_id > 0) {
			$lid = $link_id;
		} else {
			return false;
		}

		$this->_db->setQuery("UPDATE #__mt_links SET link_published = '".$publish."' WHERE link_id = '".$lid."'");
	
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		} else {
			return true;
		}

	}

	/***
	* Set Featured value for Links
	*/
	function setFeaturedLink( $featured=1, $link_id=0 ) {
		if ($link_id == 0 && $this->link_id > 0) {
			$this->_db->setQuery("UPDATE #__mt_links SET link_featured = '".$featured."' WHERE link_id = '".$this->link_id."'");
		} else {
			$this->_db->setQuery("UPDATE #__mt_links SET link_featured = '".$featured."' WHERE link_id = '".$link_id."'");
		}
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		} else {
			return true;
		}
	}

	/***
	* Delete link
	*/
	function delLink( $link_id=0 ) {
		global $mosConfig_absolute_path, $mt_listing_image_dir;

		if ($link_id == 0 && $this->link_id > 0) {
			$link_id = $this->link_id;
		}

		# Remove all reviews
		$this->_db->setQuery("DELETE FROM #__mt_reviews WHERE link_id = '".$link_id."'");
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		# Remove all votes
		$this->_db->setQuery("DELETE FROM #__mt_log WHERE link_id = '".$link_id."'");
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		# Remove the photos
		$this->_db->setQuery( "SELECT link_image FROM #__mt_links WHERE link_id = '".$link_id."'" );
		$link_image = $this->_db->loadResult();

		if ( $link_image <> '' ) {
			unlink( $mosConfig_absolute_path.$mt_listing_image_dir.$link_image );
		}

		# Remove CL mapping
		$this->_db->setQuery("DELETE FROM #__mt_cl WHERE link_id = '".$link_id."'");
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		# Remove the link itself
		$this->_db->setQuery("DELETE FROM #__mt_links WHERE link_id = '".$link_id."'");
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		}

		return true;

	}

	/***
	* Approve Link
	* As long as a link is approved, a notification mail is sent the to user regardless of the listing is
	* published or not
	*/
	function approveLink( $link_id=0 ) {
		global $mt_notifyuser_approved, $_MT_LANG, $mosConfig_live_site, $mosConfig_absolute_path, $mt_listing_image_dir;
		global $mosConfig_mailfrom, $mosConfig_fromname;

		# Determine which Link ID to use. If none, return false.
		if ( $this->link_id > 0 ) {
			$lid = $this->link_id;
		} elseif ( $link_id > 0) {
			$lid = $link_id;
		} else {
			return false;
		}

		# Check if this is an approval to modification or new listing
		$this->_db->setQuery( "SELECT link_approved FROM #__mt_links WHERE link_id = '".$lid."'");
		$link_approved = $this->_db->loadResult();

		// Approval to modification
		if ( $link_approved < 0 ) {

			$original_link_id = (-1 * $link_approved);
			//$this->_tbl_key = $original_link_id;
			$this->link_approved = 1;

			// Insert new listing
			$new_link_id = $this->link_id;
			$this->link_id = $original_link_id;

			// Removal of image
			// Replace '-1' in link_image to empty string ''
			if ( $this->link_image == "-1" ) {

				$this->_db->setQuery( "SELECT link_image FROM #__mt_links WHERE link_id = '".$original_link_id."'" );
				$link_image = $this->_db->loadResult();
				
				if ( !empty($link_image) ) {
					if(!unlink($mosConfig_absolute_path.$mt_listing_image_dir.$link_image)) {
							echo "<script> alert('".$_MT_LANG->ERROR_DELETING_OLD_IMAGE."'); </script>\n";
					}
				}
				
				$this->link_image = '';

			} elseif ( $this->link_image <> '' ) {

				$this->_db->setQuery( "SELECT link_image FROM #__mt_links WHERE link_id = '".$original_link_id."'" );
				$link_image = $this->_db->loadResult();
				
				if ( !empty($link_image) && $link_image <> $this->link_image ) {
					if(!unlink($mosConfig_absolute_path.$mt_listing_image_dir.$link_image)) {
							echo "<script> alert('".$_MT_LANG->ERROR_DELETING_OLD_IMAGE."'); </script>\n";
					}
				}

			}

			$this->_db->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = '".$original_link_id."' AND main = '1'" );
			$ori_cat_id = $this->_db->loadResult();

			if ( $ori_cat_id <> $this->cat_id ) {
				$this->_db->setQuery( "UPDATE #__mt_cl SET cat_id = '".$this->cat_id."' WHERE link_id = '".$original_link_id."' AND main = '1'" );
				$this->_db->query();
			}

			//echo "<br />this->cat_id: ".$this->cat_id;
			$this->store();

			// Remove *new* unused listing
			$this->_db->setQuery( "DELETE FROM #__mt_links WHERE link_id = '".$new_link_id."'" );
			$this->_db->query();
			$this->_db->setQuery( "DELETE FROM #__mt_cl WHERE link_id = '".$new_link_id."'" );
			$this->_db->query();
			
			// Send approval notification to user
			if ( $mt_notifyuser_approved == 1 ) {

				$this->_db->setQuery( 
					"SELECT u.email FROM #__mt_links AS l"
					.	"\nLEFT JOIN #__users AS u ON u.id = l.user_id"
					.	"\nWHERE l.link_id = '".$this->link_id."' LIMIT 1"
				);
				$email = $this->_db->loadResult();

				if ( $email <> '' ) {
					$subject = $_MT_LANG->UPDATE_LISTING_APPROVED_SUBJECT;
					$body = sprintf($_MT_LANG->UPDATE_LISTING_APPROVED_MSG, $this->link_name);
					mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $email, $subject, $body );
				}

			}

			return true;

		// Approval to new listing
		} else {
			
			# Approve and reset the created date. This ensure the approved listing is shown in Latest Listings
			$this->_db->setQuery("UPDATE #__mt_links SET link_approved = '1', link_created = '".date( "Y-m-d H:i:s" )."' WHERE link_id = '".$lid."'");
		
			if (!$this->_db->query()) {
				echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				return false;
			}
			
			//smartCountUpdate( $this->cat_id, 1, 0 );

			// Send approval notification to user
			if ( $mt_notifyuser_approved == 1 ) {
				
				//echo "Sending approval notification to user!";

				$this->_db->setQuery( 
					"SELECT u.email FROM #__mt_links AS l"
					.	"\nLEFT JOIN #__users AS u ON u.id = l.user_id"
					.	"\nWHERE l.link_id = '".$this->link_id."' LIMIT 1"
				);
				$email = $this->_db->loadResult();

				if ( $email <> '' ) {
					$subject = $_MT_LANG->NEW_LISTING_APPROVED_SUBJECT;
					$body = sprintf($_MT_LANG->NEW_LISTING_APPROVED_MSG, $this->link_name);
					mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $email, $subject, $body );

				}

			}

			//$this->store(); //Using this breaks Approve & Publish

		}

	}
	
	/***
	* Copy Listing
	*/
	function copyLink( $listing, $new_cat_parent, $reset_hits, $reset_rating, $copy_reviews) {

		// Get original listing info
		$this->_db->setQuery( "SELECT * FROM #__mt_links WHERE link_id = '".$listing."'" );
		$this->_db->loadObject( $org_listing );

		// Change cat_id
		$org_listing->cat_id = $new_cat_parent;

		if ( $reset_hits == 1 ) {
			$org_listing->link_hits = 0;
		}

		if ( $reset_rating == 1 ) {
			$org_listing->link_rating = 0;
			$org_listing->link_votes = 0;
		}

		# Copy listing
		$this->_db->setQuery( "INSERT INTO #__mt_links 
			( 
				link_name, 
				link_desc, 
				user_id, 
				link_hits, 
				link_votes, 
				link_rating, 
				link_featured, 
				link_image, 
				link_published, 
				link_approved, 
				link_template, 
				attribs, 
				metakey, 
				metadesc, 
				ordering, 
				link_created, 
				publish_up,
				publish_down,
				link_modified, 
				address, 
				city, 
				state, 
				country, 
				postcode, 
				telephone, 
				fax, 
				email, 
				website,
				price,
				cust_1,
				cust_2,
				cust_3,
				cust_4,
				cust_5,
				cust_6,
				cust_7,
				cust_8,
				cust_9,
				cust_10,
				cust_11,
				cust_12,
				cust_13,
				cust_14,
				cust_15,
				cust_16,
				cust_17,
				cust_18,
				cust_19,
				cust_20,
				cust_21,
				cust_22,
				cust_23,
				cust_24,
				cust_25,
				cust_26,
				cust_27,
				cust_28,
				cust_29,
				cust_30

			) "
			. "VALUES( '"
				.mysql_escape_string($org_listing->link_name)."', '"
				.mysql_escape_string($org_listing->link_desc)."', '"
				.$org_listing->user_id."', '"
				.$org_listing->link_hits."', '"
				.$org_listing->link_votes."', '"
				.$org_listing->link_rating."', '"
				.$org_listing->link_featured."', '"
				.$org_listing->link_image."', '"
				.$org_listing->link_published."', '"
				.$org_listing->link_approved."', '"
				.$org_listing->link_template."', '"
				.$org_listing->attribs."', '"
				.mysql_escape_string($org_listing->metakey)."', '"
				.mysql_escape_string($org_listing->metadesc)."', '"
				.$org_listing->ordering."', '"
				.$org_listing->link_created."', '"
				.$org_listing->publish_up."', '"
				.$org_listing->publish_down."', '"
				.$org_listing->link_modified."', '"
				.mysql_escape_string($org_listing->address)."', '"
				.mysql_escape_string($org_listing->city)."', '"
				.mysql_escape_string($org_listing->state)."', '"
				.mysql_escape_string($org_listing->country)."', '"
				.mysql_escape_string($org_listing->postcode)."', '"
				.mysql_escape_string($org_listing->telephone)."', '"
				.mysql_escape_string($org_listing->fax)."', '"
				.mysql_escape_string($org_listing->email)."', '"
				.mysql_escape_string($org_listing->website)."', '" 
				.mysql_escape_string($org_listing->price)."', '" 
				.mysql_escape_string($org_listing->cust_1)."', '" 
				.mysql_escape_string($org_listing->cust_2)."', '" 
				.mysql_escape_string($org_listing->cust_3)."', '" 
				.mysql_escape_string($org_listing->cust_4)."', '" 
				.mysql_escape_string($org_listing->cust_5)."', '" 
				.mysql_escape_string($org_listing->cust_6)."', '" 
				.mysql_escape_string($org_listing->cust_7)."', '" 
				.mysql_escape_string($org_listing->cust_8)."', '" 
				.mysql_escape_string($org_listing->cust_9)."', '" 
				.mysql_escape_string($org_listing->cust_10)."', '" 
				.mysql_escape_string($org_listing->cust_11)."', '" 
				.mysql_escape_string($org_listing->cust_12)."', '" 
				.mysql_escape_string($org_listing->cust_13)."', '" 
				.mysql_escape_string($org_listing->cust_14)."', '" 
				.mysql_escape_string($org_listing->cust_15)."', '" 
				.mysql_escape_string($org_listing->cust_16)."', '" 
				.mysql_escape_string($org_listing->cust_17)."', '" 
				.mysql_escape_string($org_listing->cust_18)."', '" 
				.mysql_escape_string($org_listing->cust_19)."', '" 
				.mysql_escape_string($org_listing->cust_20)."', '" 
				.mysql_escape_string($org_listing->cust_21)."', '" 
				.mysql_escape_string($org_listing->cust_22)."', '" 
				.mysql_escape_string($org_listing->cust_23)."', '" 
				.mysql_escape_string($org_listing->cust_24)."', '" 
				.mysql_escape_string($org_listing->cust_25)."', '" 
				.mysql_escape_string($org_listing->cust_26)."', '" 
				.mysql_escape_string($org_listing->cust_27)."', '" 
				.mysql_escape_string($org_listing->cust_28)."', '" 
				.mysql_escape_string($org_listing->cust_29)."', '" 
				.mysql_escape_string($org_listing->cust_30)."'" 
				.")"
				);
		$this->_db->query();

		$new_listing_id = mysql_insert_id();

		# Create CL mapping
		$this->_db->setQuery( "INSERT INTO #__mt_cl ( link_id, cat_id, main )  VALUES( '".$new_listing_id."', '".$org_listing->cat_id."', '1' )" );
		$this->_db->query();
		
		# Copy image
		global $mosConfig_absolute_path, $mt_listing_image_dir;
		$file = $mosConfig_absolute_path.$mt_listing_image_dir.$org_listing->link_image;

		if ( $org_listing->link_image ) {
			if( 
			copy( $file, $mosConfig_absolute_path.$mt_listing_image_dir.$new_listing_id."_".(substr($org_listing->link_image, strpos( $org_listing->link_image, "_" )+1 )) ) ) {
				$this->_db->setQuery( "UPDATE #__mt_links SET link_image = '".$new_listing_id."_".(substr($org_listing->link_image, strpos( $org_listing->link_image, "_" )+1 ))."' WHERE link_id = '".$new_listing_id."'" );
				$this->_db->query();
			}
		}

		# Copy Reviews
		$this->_db->setQuery( "SELECT rev_id FROM #__mt_reviews WHERE link_id = '".$listing."'" );
		$reviews = $this->_db->loadResultArray();

		if ( count($reviews) > 0 && $copy_reviews == 1 ) {
			foreach( $reviews AS $review ) {
				// Get original review
				$this->_db->setQuery( "SELECT * FROM #__mt_reviews WHERE rev_id = '".$review."'" );
				$this->_db->loadObject( $org_review );

				// Change link_id
				$org_review->link_id = $new_listing_id;

				// Copy Review
				$this->_db->setQuery( "INSERT INTO #__mt_reviews ( link_id, user_id, guest_name, rev_title, rev_text, rev_date, rev_approved ) VALUES ( '$org_review->link_id', '$org_review->user_id', '".mysql_escape_string($org_review->guest_name)."', '".mysql_escape_string($org_review->rev_title)."', '".mysql_escape_string($org_review->rev_text)."', '$org_review->rev_date', '$org_review->rev_approved' )" );
				$this->_db->query();

			}
		}

	}

	/***
	*	Return template in use. If listing is not assigned with template, 
	* it will look for it in its parent category. Otherwise the function
	* return false
	*/
	function getTemplate() {
		
		if ( $this->link_template <> '' ) {
		
			return $this->link_template;

		} else {
			
			$cat = new mtCats( $this->_db );
			$cat->load( $this->cat_id );
			
			if ( $cat->cat_template <> '' ) {
				return $cat->cat_template;
			} else {
				return false;
			}

		}

	}

	function getCatID() {
		$this->_db->setQuery( "SELECT cat_id FROM #__mt_cl WHERE link_id = $this->link_id AND main = 1 LIMIT 1" );
		return $this->_db->loadResult();
	}

	function getCatName() {
		global $_MT_LANG;

		$this->_db->setQuery( "SELECT c.cat_id, cat_name FROM #__mt_cl AS cl, #__mt_cats AS c WHERE cl.cat_id = c.cat_id AND link_id = $this->link_id AND main = 1 LIMIT 1" );
		$this->_db->loadObject( $cat );

		if ( !isset($cat->cat_id) || $cat->cat_id == 0 ) {
			return $_MT_LANG->ROOT;
		} else {

			return $cat->cat_name;

		}
	}

}

/**
* Reviews Table class
*/
class mtReviews extends mosDBTable {
	var $rev_id=null;
	var $link_id=null;
	var $user_id=null;
	var $guest_name=null;
	var $rev_title=null;
	var $rev_text=null;
	var $rev_date=null;
	var $rev_approved=null;
	var $admin_note=null;

	function mtReviews( &$db ) {
		$this->mosDBTable( '#__mt_reviews', 'rev_id', $db );
	}

	/***
	* Approve Review
	*/
	function approveReview( $approve=1, $rev_id=0 ) {
		global $mt_notifyuser_review_approved, $_MT_LANG, $mosConfig_mailfrom, $mosConfig_fromname;

		# Determine which Review ID to use. If none, return false.
		if ( $this->rev_id > 0 ) {
			$rid = $this->rev_id;
		} elseif ( $rev_id > 0) {
			$rid = $rev_id;
		} else {
			return false;
		}

		$this->_db->setQuery("UPDATE #__mt_reviews SET rev_approved = '".$approve."' WHERE rev_id = '".$rid."'");
	
		if (!$this->_db->query()) {
			echo "<script> alert('".$this->_db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			return false;
		} else {
	
			$this->_db->setQuery("UPDATE #__mt_reviews SET admin_note = '' WHERE rev_id = '".$rid."'");
			$this->_db->query();

			// Send approval notification to user
			if ( $mt_notifyuser_review_approved == 1 ) {

				$this->_db->setQuery( 
					"SELECT u.email, l.link_name FROM #__mt_reviews AS r"
					.	"\nLEFT JOIN #__users AS u ON u.id = r.user_id"
					.	"\nLEFT JOIN #__mt_links AS l ON l.link_id = r.link_id"
					.	"\nWHERE r.rev_id = '".$rid."' LIMIT 1"
				);
				$this->_db->loadObject($row);

				if ( $row->email <> '' ) {
					$subject = $_MT_LANG->REVIEW_APPROVED_SUBJECT;
					$body = sprintf($_MT_LANG->REVIEW_APPROVED_MSG, $row->link_name);
					mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $row->email, $subject, $body );

				}

			}

			return true;
		}

	}

}

/**
* Votes Table class
*/
/*
class mtVotes extends mosDBTable {
	var $vote_ip=null;
	var $user_id=null;
	var $vote_date=null;
	var $link_id=null;

	function mtVotes( &$db ) {
		$this->mosDBTable( '#__mt_votes', 'vote_ip', $db );
	}
}
*/

/**
* Related Categories Table class
*/
class mtRelCats extends mosDBTable {
	var $cat_id=null;
	var $rel_id=null;

	function mtRelCats( &$db ) {
		$this->mosDBTable( '#__mt_relcats', 'cat_id', $db );
	}
	
	function setcatid( $cat_id ) {
		$this->cat_id = $cat_id;
	}

	/**
	* Updates the related categories
	* @param array Source array for related categories
	* @return boolean TRUE if update is successful, FALSE if not.
	*/
	function update( $related_cats ) {

		$this->_db->setQuery( "DELETE FROM $this->_tbl WHERE cat_id = '$this->cat_id'" );
		$this->_db->query();
		
		if ( !empty($related_cats) ) {

			$sql = "INSERT INTO $this->_tbl (cat_id, rel_id) VALUES ";
			
			foreach( $related_cats AS $related_cat ) {
				$values[] = "($this->cat_id, $related_cat)";
			}
			
			$sql .= implode(', ', $values);
			$this->_db->setQuery( $sql );

			if (!$this->_db->query()) {
				return false;
			} else {
				return true;
			}
			
		}
	} // End function

}

/**
* Related Categories Table class
*/
class mtClaims extends mosDBTable {
	var $claim_id=null;
	var $user_id=null;
	var $link_id=null;
	var $comment=null;
	var $admin_note=null;
}

class mtReports extends mosDBTable {
	var $report_id=null;
	var $user_id=null;
	var $guest_name=null;
	var $link_id=null;
	var $subject=null;
	var $comment=null;
	var $report_date=null;
	var $admin_note=null;
}


/**
* Image class
*/

class mtImage {

	var $tmpFile=null;
	var $imageName=null;
	var $type=null;
	var $size=null;
	var $directory=null;
	var $method=null;
	var $quality=80;
	var $errorMsg=null;

	//function mtImage( $src_path, $imageName, $dest_dir ) {
	function mtImage( $listing_image, $dest_dir ) {
		$this->tmpFile = $listing_image['tmp_name'];
		$this->imageName = $listing_image['name'];
		$this->type = $listing_image['type'];
		$this->size = $listing_image['size'];
		$this->directory = $dest_dir;
	}

	function setName( $imageName ) {
		$this->imageName = $imageName;
	}

	function setMethod( $method ) {
		$this->method = $method;
	}

	function setQuality( $quality ) {
		if ( is_numeric($quality) && $quality >= 0 && $quality <= 100 ) {
			$this->quality = $quality;
		}
	}

	function setSize( $size ) {
		$this->size = $size;
	}

	function setErrorMsg( $errorMsg ) {
		$this->errorMsg = $errorMsg;
	}

	function getErrorMsg() {
		return $this->errorMsg;
	}

	function check() {
		global $_MT_LANG;

		# Is destination directory writable?
		if( !is_writable($this->directory) ) { 
			$this->setErrorMsg(sprintf($_MT_LANG->IMAGE_DIR_NOT_WRITABLE, $this->directory));
			return false;
		}

		# Is there a specified source path?
		if ( $this->tmpFile == '' ) {
			$this->setErrorMsg($_MT_LANG->IMAGE_NOT_SPECIFIED);
			return false;
		}

		# Uploaded ?
		if ( !is_uploaded_file($this->tmpFile) ) {
			$this->setErrorMsg($_MT_LANG->IMAGE_NOT_VALID);
			return false;
		} 

		# No duplicate
		if ( file_exists($this->directory.$this->imageName) ) {
			$this->setErrorMsg($_MT_LANG->DUPLICATE_IMAGE);
			return false;
		}
		
		return true;

	}

	function moveToMedia( $file ) {
		global $mosConfig_absolute_path;
		
		$newTmpFile = $mosConfig_absolute_path.'/media/'.basename($file);

		if ( move_uploaded_file( $file, $newTmpFile ) ) {
			$this->tmpFile = $newTmpFile;
			return true;
		} else {
			return false;
		}
		
	}
	
	function resize()	{

		if( $this->moveToMedia( $this->tmpFile ) ) {

			$imagetype = array( 1 => 'GIF', 2 => 'JPG', 3 => 'PNG', 4 => 'SWF', 5 => 'PSD', 6 => 'BMP', 7 => 'TIFF', 8 => 'TIFF', 9 => 'JPC', 10 => 'JP2', 11 => 'JPX', 12 => 'JB2', 13 => 'SWC', 14 => 'IFF');
			
			$imginfo = getimagesize($this->tmpFile);
			$imginfo[2] = $imagetype[$imginfo[2]];

			# GD can only handle JPG & PNG images
			if ($imginfo[2] != 'JPG' && $imginfo[2] != 'PNG' && $imginfo[2] != 'GIF' && ($this->method == 'gd1' || $this->method == 'gd2')) die("ERROR: GD can only handle JPG, GIF and PNG files!");

			# height/width
			$srcWidth = $imginfo[0];
			$srcHeight = $imginfo[1];

			# Generate new width/height
			$ratio = max($srcWidth, $srcHeight) / $this->size;
			$ratio = max($ratio, 1.0);
			$destWidth = (int)($srcWidth / $ratio);
			$destHeight = (int)($srcHeight / $ratio);

			# Method for thumbnails creation
			switch ($this->method) {

				case "gd1" :
					if (!function_exists('imagecreatefromjpeg')) {
							die('GD image library not installed!');
					}
					if ($imginfo[2] == 'JPG')
						$src_img = imagecreatefromjpeg($this->tmpFile);
					else
						$src_img = imagecreatefrompng($this->tmpFile);
					if (!$src_img){
						$ERROR = $lang_errors['invalid_image'];
						return false;
					}
					$dst_img = imagecreate($destWidth, $destHeight);
					imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
					imagejpeg($dst_img, $this->directory.$this->imageName, $this->quality);
					imagedestroy($src_img);
					imagedestroy($dst_img);
					break;

				case "gd2" :
					if (!function_exists('imagecreatefromjpeg')) {
							die('GD image library not installed!');
					}
					if (!function_exists('imagecreatetruecolor')) {
							die('GD2 image library does not support truecolor thumbnailing!');
					}

					switch($imginfo[2]) {
						case 'JPG':
							$src_img = imagecreatefromjpeg($this->tmpFile);
							break;

						case 'PNG':
							$src_img = imagecreatefrompng($this->tmpFile);
							break;
						
						case 'GIF':
							$src_img = imagecreatefromgif($this->tmpFile);
							break;
					}

					if (!$src_img){
						$ERROR = $lang_errors['invalid_image'];
						return false;
					}
					$dst_img = imagecreatetruecolor($destWidth, $destHeight);
					imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
					imagejpeg($dst_img, $this->directory.$this->imageName, $this->quality);
					imagedestroy($src_img);
					imagedestroy($dst_img);
					break;
				case "netpbm":
					global $mt_img_netpbmpath; 
					if($mt_img_netpbmpath) { 
						if(!is_dir($mt_img_netpbmpath))	{ 
								echo "NetPbm path incorrect";
								die; 
						} 
					} 
					
					if ($imginfo[2] == 'PNG') { 
						$cmd = $mt_img_netpbmpath . "pngtopnm $this->tmpFile | " . $mt_img_netpbmpath . "pnmscale -xysize $destWidth ".(int)$destHeight." | " . $mt_img_netpbmpath . "pnmtopng > $this->directory$this->imageName" ; 
					}	else if ($imginfo[2] == 'JPG')	{ 
						$cmd = $mt_img_netpbmpath . "jpegtopnm $this->tmpFile | " . $mt_img_netpbmpath . "pnmscale -xysize $destWidth ".(int)$destHeight." | " . $mt_img_netpbmpath . "pnmtojpeg -quality=$this->quality > $this->directory$this->imageName" ;
					}	else if ($imginfo[2] == 'GIF') { 
						$cmd = $mt_img_netpbmpath . "giftopnm $this->tmpFile | " . $mt_img_netpbmpath . "pnmscale -xysize $destWidth ".(int)$destHeight." | " . $mt_img_netpbmpath . "ppmquant 256 | " . $mt_img_netpbmpath . "ppmtogif > $this->directory$this->imageName" ; 
					}

					exec($cmd);

					break;
				case "imagemagick":
					global $mt_img_impath, $mosConfig_absolute_path;

					$tmp_name = substr(strrchr($this->directory.$this->imageName, "/"), 1);
					copy($this->tmpFile, $mosConfig_absolute_path.'/media/'.$tmp_name);
					$uploadfile = $mosConfig_absolute_path.'/media/'.$tmp_name;
					$cmd = $mt_img_impath."convert -resize ".$destWidth."x".(int)$destHeight." $uploadfile $this->directory$this->imageName";
					exec($cmd);
					unlink($uploadfile);

					break;
			}

			unlink( $this->tmpFile );

			# Set mode of uploaded picture
			chmod($this->directory.$this->imageName, octdec('755'));

			# We check that the image is valid
			$imginfo = getimagesize($this->directory.$this->imageName);
			if ($imginfo == null){
				return false;
			} else {
				return true;
			}

		}	else {
			
			return false;

		} // End If: Move To Media

	}

}

/***
* Mosets Tree Display Class
*/

class mtDisplay {

	var $captions=null;
	var $data=null;

	function mtDisplay() {
		// Empty Constructor
	}

	function add( $caption, $data ) {
		$this->captions[] = $caption;
		$this->data[] = $data;
	}

	function display() {
		global $_MT_LANG;
		?>
		<table width="100%" cellpadding="2" cellspacing="0" border="0" style="border: 1px solid #C0C0C0">
		<?php
		for( $i=0; $i<count($this->captions); $i++ ) {

			if ( $this->captions[$i] == $_MT_LANG->NAME ) {
				echo "<tr>";
				echo '<td colspan="2" align="center">' . $this->data[$i] . "</td>";
				echo "</tr>";
			} else {
				echo "<tr>";
				echo '<td width="50%" align="right" style="border-top: 1px solid #C0C0C0">' . $this->captions[$i] . ': </td>';
				echo '<td width="50%" style="background-color: white;border-top: 1px solid #C0C0C0; border-left: 1px solid #C0C0C0;">&nbsp;&nbsp;' . $this->data[$i] . "</td>";
				echo "</tr>";
			}
		}
		?>
		</table>
		<?php
	}

}

/**
* Configuration
*/
class mtConfig extends mosDBTable {

	var $template=null;
	var $language=null;
	var $map=null;
	var $admin_email=null;
	var $listing_image_dir='/components/com_mtree/img/listings/';
	var $cat_image_dir='/components/com_mtree/img/cats/';
	var $resize_method=null;
	var $resize_quality=null;
	var $resize_listing_size=null;
	var $resize_cat_size=null;
	var $img_impath=null;
	var $img_netpbmpath=null;
	var $first_cat_order1=null;
	var $first_cat_order2=null;
	var $second_cat_order1=null;
	var $second_cat_order2=null;
	var $first_listing_order1=null;
	var $first_listing_order2=null;
	var $second_listing_order1=null;
	var $second_listing_order2=null;
	var $fulltext_search=null;
	var $first_search_order1=null;
	var $first_search_order2=null;
	var $second_search_order1=null;
	var $second_search_order2=null;
	var $display_empty_cat=null;
	var $display_alpha_index=null;
	var $display_listing_count_in_root;
	var $display_cat_count_in_root;
	var $display_cat_count_in_subcat;
	var $display_listing_count_in_subcat;
	var $allow_listings_submission_in_root;
	var $display_listings_in_root;

	var $show_map=null;
	var $show_print=null;
	var $show_recommend=null;
	var $show_rating=null;
	var $show_review=null;
	var $show_visit=null;
	var $show_contact=null;
	var $use_owner_email=null;
	var $show_report=null;
	var $show_email=null;
	var $show_claim=null;
	var $show_ownerlisting=null;
	var $fe_num_of_subcats=null;
	var $fe_num_of_chars=null;
	var $fe_num_of_links=null;
	var $fe_num_of_reviews=null;
	var $fe_num_of_popularlisting=null;
	var $fe_num_of_newlisting=null;
	var $fe_total_newlisting=null;
	var $fe_num_of_mostrated=null;
	var $fe_num_of_toprated=null;
	var $fe_num_of_mostreview=null;
	var $fe_num_of_searchresults=null;
	var $fe_num_of_featured=null;
	var $rate_once=null;
	var $min_votes_for_toprated=null;
	var $min_votes_to_show_rating=null;
	var $user_review_once=null;
	var $user_rating=null;
	var $user_review=null;
	var $user_recommend=null;
	var $user_addlisting=null;
	var $user_addcategory=null;
	var $user_allowmodify=null; 
	var $user_allowdelete=null; 
	var $needapproval_addlisting=null;
	var $needapproval_modifylisting=null;
	var $needapproval_addcategory=null;
	var $needapproval_addreview=null;
	var $link_new=null;
	var $link_popular=null;
	var $hit_lag=null;
	var $notifyuser_newlisting=null;
	var $notifyadmin_newlisting=null;
	var $notifyuser_modifylisting=null;
	var $notifyadmin_modifylisting=null;
	var $notifyadmin_newreview=null;
	var $notifyuser_approved=null;
	var $notifyuser_review_approved=null;
	var $notifyadmin_delete=null;
	var $use_internal_notes=null;
	var $allow_html=null;
	var $allow_imgupload=null;
	var $search_link_name=null;
	var $search_link_desc=null;
	var $search_address=null;
	var $search_city=null;
	var $search_postcode=null;
	var $search_state=null;
	var $search_country=null;
	var $search_email=null;
	var $search_website=null;
	var $search_telephone=null;
	var $search_fax=null;
	var $search_metakey=null;
	var $search_metadesc=null;
	var $admin_use_explorer=null;
	var $explorer_tree_level=null;
	var $fullmenu_tree_level=null;
	var $_alias=null;

	function mtConfig() {
		$this->_alias = array(
		'template'=>'mt_template',
		'language'=>'mt_language',
		'map'=>'mt_map',
		'admin_email'=>'mt_admin_email',
		'listing_image_dir'=>'mt_listing_image_dir',
		'cat_image_dir'=>'mt_cat_image_dir',
		'resize_method'=>'mt_resize_method',
		'resize_quality'=>'mt_resize_quality',
		'resize_listing_size'=>'mt_resize_listing_size',
		'img_impath'=>'mt_img_impath',
		'img_netpbmpath'=>'mt_img_netpbmpath',
		'resize_cat_size'=>'mt_resize_cat_size',
		'first_cat_order1'=>'mt_first_cat_order1',
		'first_cat_order2'=>'mt_first_cat_order2',
		'second_cat_order1'=>'mt_second_cat_order1',
		'second_cat_order2'=>'mt_second_cat_order2',
		'first_listing_order1'=>'mt_first_listing_order1',
		'first_listing_order2'=>'mt_first_listing_order2',
		'second_listing_order1'=>'mt_second_listing_order1',
		'second_listing_order2'=>'mt_second_listing_order2',
		'fulltext_search'=>'mt_fulltext_search',
		'first_search_order1'=>'mt_first_search_order1',
		'first_search_order2'=>'mt_first_search_order2',
		'second_search_order1'=>'mt_second_search_order1',
		'second_search_order2'=>'mt_second_search_order2',
		'display_empty_cat'=>'mt_display_empty_cat',
		'display_alpha_index'=>'mt_display_alpha_index',
		'allow_listings_submission_in_root'=>'mt_allow_listings_submission_in_root',
		'display_listings_in_root'=>'mt_display_listings_in_root',
		'display_cat_count_in_root'=>'mt_display_cat_count_in_root',
		'display_listing_count_in_root'=>'mt_display_listing_count_in_root',
		'display_cat_count_in_subcat'=>'mt_display_cat_count_in_subcat',
		'display_listing_count_in_subcat'=>'mt_display_listing_count_in_subcat',

		'show_map'=>'mt_show_map',
		'show_print'=>'mt_show_print',
		'show_recommend'=>'mt_show_recommend',
		'show_rating'=>'mt_show_rating',
		'show_review'=>'mt_show_review',
		'show_visit'=>'mt_show_visit',
		'show_contact'=>'mt_show_contact',
		'use_owner_email'=>'mt_use_owner_email',
		'show_report'=>'mt_show_report',
		'show_email'=>'mt_show_email',
		'show_claim'=>'mt_show_claim',
		'show_ownerlisting'=>'mt_show_ownerlisting',
		'fe_num_of_subcats'=>'mt_fe_num_of_subcats',
		'fe_num_of_chars'=>'mt_fe_num_of_chars',
		'fe_num_of_links'=>'mt_fe_num_of_links',
		'fe_num_of_reviews'=>'mt_fe_num_of_reviews',
		'fe_num_of_popularlisting'=>'mt_fe_num_of_popularlisting',
		'fe_num_of_newlisting'=>'mt_fe_num_of_newlisting',
		'fe_total_newlisting'=>'mt_fe_total_newlisting',
		'fe_num_of_mostrated'=>'mt_fe_num_of_mostrated',
		'fe_num_of_toprated'=>'mt_fe_num_of_toprated',
		'fe_num_of_mostreview'=>'mt_fe_num_of_mostreview',
		'fe_num_of_searchresults'=>'mt_fe_num_of_searchresults',
		'fe_num_of_featured'=>'mt_fe_num_of_featured',
		'rate_once'=>'mt_rate_once',
		'min_votes_for_toprated'=>'mt_min_votes_for_toprated',
		'min_votes_to_show_rating'=>'mt_min_votes_to_show_rating',
		'user_review_once'=>'mt_user_review_once',
		'user_rating'=>'mt_user_rating',
		'user_review'=>'mt_user_review',
		'user_recommend'=>'mt_user_recommend',
		'user_addlisting'=>'mt_user_addlisting',
		'user_addcategory'=>'mt_user_addcategory',
		'user_allowmodify'=>'mt_user_allowmodify', 
		'user_allowdelete'=>'mt_user_allowdelete', 
		'needapproval_addlisting'=>'mt_needapproval_addlisting',
		'needapproval_modifylisting'=>'mt_needapproval_modifylisting',
		'needapproval_addcategory'=>'mt_needapproval_addcategory',
		'needapproval_addreview'=>'mt_needapproval_addreview',
		'link_new'=>'mt_link_new',
		'link_popular'=>'mt_link_popular',
		'hit_lag'=>'mt_hit_lag',
		'notifyuser_newlisting'=>'mt_notifyuser_newlisting',
		'notifyadmin_newlisting'=>'mt_notifyadmin_newlisting',
		'notifyuser_modifylisting'=>'mt_notifyuser_modifylisting',
		'notifyadmin_modifylisting'=>'mt_notifyadmin_modifylisting',
		'notifyadmin_newreview'=>'mt_notifyadmin_newreview',
		'notifyuser_approved'=>'mt_notifyuser_approved',
		'notifyuser_review_approved'=>'mt_notifyuser_review_approved',
		'notifyadmin_delete'=>'mt_notifyadmin_delete',
		'use_internal_notes'=>'mt_use_internal_notes',
		'allow_html'=>'mt_allow_html',
		'allow_imgupload'=>'mt_allow_imgupload',
		'search_link_name'=>'mt_search_link_name',
		'search_link_desc'=>'mt_search_link_desc',
		'search_address'=>'mt_search_address',
		'search_city'=>'mt_search_city',
		'search_postcode'=>'mt_search_postcode',
		'search_state'=>'mt_search_state',
		'search_country'=>'mt_search_country',
		'search_email'=>'mt_search_email',
		'search_website'=>'mt_search_website',
		'search_telephone'=>'mt_search_telephone',
		'search_fax'=>'mt_search_fax',
		'search_metakey'=>'mt_search_metakey',
		'search_metadesc'=>'mt_search_metadesc',
		'admin_use_explorer'=>'mt_admin_use_explorer',
		'explorer_tree_level'=>'mt_explorer_tree_level',
		'fullmenu_tree_level'=>'mt_fullmenu_tree_level'
		);
	}

	function getVarText() {
		$txt = '';
		foreach ($this->_alias as $k=>$v) {
			$txt .= "\$$v='".addslashes( $this->$k )."';\n";
		}
		return $txt;
	}

	function bindGlobals() {
		foreach ($this->_alias as $k=>$v) {
			if(isset($GLOBALS[$v])) {
				$this->$k = $GLOBALS[$v];
			} else {
				$this->$k = "";
			}
		}
	}
}

?>
