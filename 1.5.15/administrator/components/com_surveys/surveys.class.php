<?php
/*
* $Id: <surveys.class.php,0.0.28 <version> 2007/01/10 hh:mm:ss <creator name> $
*
* @package iJoomla Survays
* @email webmaster@ijoomla.com
*
* @copyright
* ====================================================================
 * @copyright   (C) 2010 iJoomla, Inc. - All rights reserved.
 * @license  GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author  iJoomla.com <webmaster@ijoomla.com>
 * @url   http://www.ijoomla.com/licensing/
 * the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript  *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0 
 * More info at http://www.ijoomla.com/licensing/
* ====================================================================
* @endcopyright
*
* @file <surveys.class.php>
* @brief <brief description of file purpose>
*
* @BeginClassList
* ====================================================================
* class mosijoomla_surveys
* class mosijoomla_questions
* class mosijoomla_surveys_blocks
* class mosijoomla_surveys_skip_logics
* class mosijoomla_surveys_config
* class mosijoomla_answer
* class mosijoomla_answer_collumn
* class mosijoomla_session
* class mosijoomla_result
* class mosijoomla_result_text
* class mosijoomla_menu_heading
* ====================================================================
* @EndClassList
*
* @history
* ====================================================================
* File creation date:
* Current file version: 0.0.28
*
* Modified By: iJoomla Al
* Modified Date: 07/11/2006
* Modification: SURVEYS-68 Problems with redirect in Surveys Manager - mosijoomla_surveys class modified
*
* Modified By: iJoomla Al
* Modified Date: 09/11/2006
* Modification: SURVEYS-59,SURVEYS-60 mosijoomla_questions class modified
*
* Modified By: iJoomla Al
* Modified Date: 09/02/2007
* Modification: SURVEYS-153 - mosijoomla_surveys class modified
*
* Modified By: 
* Modified Date: 
* Modification: 
*
* ====================================================================
* @endhistory
*/

// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once(JPATH_SITE . "/libraries/joomla/html/pagination.php");
function JReadDirectory( $path, $filter='.', $recurse=false, $fullpath=false  ) {
	$arr = array();
	if (!@is_dir( $path )) {
		return $arr;
	}
	$handle = opendir( $path );

	while ($file = readdir($handle)) {
		$dir = JPath::clean( $path.'/'.$file, false );
		$isDir = is_dir( $dir );
		if (($file != ".") && ($file != "..")) {
			if (preg_match( "/$filter/", $file )) {
				if ($fullpath) {
					$arr[] = trim( mosPathName( $path.'/'.$file, false ) );
				} else {
					$arr[] = trim( $file );
				}
			}
			if ($recurse && $isDir) {
				$arr2 = JReadDirectory( $dir, $filter, $recurse, $fullpath );
				$arr = array_merge( $arr, $arr2 );
			}
		}
	}
	closedir($handle);
	asort($arr);
	return $arr;
}

$export = JArrayHelper::getValue( $_REQUEST, 'export');
	if($export!="export"){
?>


<script>

function previewImage( list, image, base_path ) {
	
	form = document.adminForm;
	srcList = eval( "form." + list );
	srcImage = eval( "document." + image );
	var srcOption = srcList.options[(srcList.selectedIndex < 0) ? 0 : srcList.selectedIndex];
	var fileName = srcOption.text;
	var fileName2 = srcOption.value;
	if (fileName.length == 0 || fileName2.length == 0) {
		srcImage.src = 'images/blank.gif';
	} else {
		srcImage.src = base_path + fileName2;
	}
}

function showImageProps(base_path) {
	form = document.adminForm;
	value = getSelectedValue( 'adminForm', 'imagelist' );
	parts = value.split( '|' );
	form._source.value = parts[0];
	setSelectedValue( 'adminForm', '_align', parts[1] || '' );
	form._alt.value = parts[2] || '';
	form._border.value = parts[3] || '0';
	form._caption.value = parts[4] || '';
	setSelectedValue( 'adminForm', '_caption_position', parts[5] || '' );
	setSelectedValue( 'adminForm', '_caption_align', parts[6] || '' );
	form._width.value = parts[7] || '';

	//previewImage( 'imagelist', 'view_imagelist', base_path );
	srcImage = eval( "document." + 'view_imagelist' );
	srcImage.src = base_path + parts[0];
}

</script>
<?php
	}
class JPaginationNew extends JPagination {
	function getLimitBox()
	{
		global $mainframe;

		// Initialize variables
		$limits = array ();

		// Make the option list
		for ($i = 5; $i <= 30; $i += 5) {
			$limits[] = JHTML::_('select.option', "$i");
		}
		$limits[] = JHTML::_('select.option', '50');
		$limits[] = JHTML::_('select.option', '100');
		$limits[] = JHTML::_('select.option', '1000', JText::_('all'));

		$selected = $this->_viewall ? 0 : $this->limit;

		// Build the select list
		if ($mainframe->isAdmin()) {
			$html = JHTML::_('select.genericlist',  $limits, 'limit', 'class="inputbox" size="1" onchange="submitform();"', 'value', 'text', $selected);
		} else {
			$html = JHTML::_('select.genericlist',  $limits, 'limit', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', $selected);
		}
		return $html;
	}
}

class JOutputFilter
#
{
#
    /**
#
    * Makes an object safe to display in forms
#
    *
#
    * Object parameters that are non-string, array, object or start with underscore
#
    * will be converted
#
    *
#
    * @static
#
    * @param object An object to be parsed
#
    * @param int The optional quote style for the htmlspecialchars function
#
    * @param string|arrayAn optional single field name or array of field names not
#
    *                      to be parsed (eg, for a textarea)
#
    * @since 1.5
#
    */
#
    function objectHTMLSafe( &$mixed, $quote_style=ENT_QUOTES, $exclude_keys='' )
#
    {
#
        if (is_object( $mixed ))
#
        {
#
            foreach (get_object_vars( $mixed ) as $k => $v)
#
            {
#
                if (is_array( $v ) || is_object( $v ) || $v == NULL || substr( $k, 1, 1 ) == '_' ) {
#
                    continue;
#
                }
#
 
#
                if (is_string( $exclude_keys ) && $k == $exclude_keys) {
#
                    continue;
#
                } else if (is_array( $exclude_keys ) && in_array( $k, $exclude_keys )) {
#
                    continue;
#
                }
#
 
#
                $mixed->$k = htmlspecialchars( $v, $quote_style );
#
            }
#
        }
#
    }
#
 
#
    /**
#
     * This method processes a string and replaces all instances of & with &amp; in links only
#
     *
#
     * @static
#
     * @param    string    $input    String to process
#
     * @return    string    Processed string
#
     * @since    1.5
#
     */
#
    function linkXHTMLSafe($input)
#
    {
#
        $regex = 'href="([^"]*(&(amp;){0})[^"]*)*?"';
#
        return preg_replace_callback( "#$regex#i", array('JOutputFilter', '_ampReplaceCallback'), $input );
#
    }
#
 
#
    /**
#
     * This method processes a string all replaces all accented UTF-8 characters by unaccented
#
     * ASCII-7 "equivalents", whitespaces are replaced by hyphens and the string is lowercased.
#
     *
#
     * @static
#
     * @param    string    $input    String to process
#
     * @return    string    Processed string
#
     * @since    1.5
#
     */
#
    function stringURLSafe($string)
#
    {
#
        $str = htmlentities(utf8_decode($string));
#
        $str = preg_replace(
#
            array('/&szlig;/','/&(..)lig;/', '/&([aouAOU])uml;/','/&(.)[^;]*;/'),
#
            array('ss',"$1","$1".'e',"$1"),
#
            $str);
#
 
#
        // remove any duplicate whitespace, and ensure all characters are alphanumeric
#
        $str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('-',''), $str);
#
 
#
        // lowercase and trim
#
        $str = trim(strtolower($str));
#
        return $str;
#
    }
#
 
#
    /**
#
    * Replaces &amp; with & for xhtml compliance
#
    *
#
    * @todo There must be a better way???
#
    *
#
    * @static
#
    * @since 1.5
#
    */
#
    function ampReplace( $text )
#
    {
#
        $text = str_replace( '&&', '*--*', $text );
#
        $text = str_replace( '&#', '*-*', $text );
#
        $text = str_replace( '&amp;', '&', $text );
#
        $text = preg_replace( '|&(?![\w]+;)|', '&amp;', $text );
#
        $text = str_replace( '*-*', '&#', $text );
#
        $text = str_replace( '*--*', '&&', $text );
#
 
#
        return $text;
#
    }
#
 
#
 
#
 
#
    /**
#
     * Callback method for replacing & with &amp; in a string
#
     *
#
     * @static
#
     * @param    string    $m    String to process
#
     * @return    string    Replaced string
#
     * @since    1.5
#
     */
#
    function _ampReplaceCallback( $m )
#
    {
#
         $rx = '&(?!amp;)';
#
         return preg_replace( '#'.$rx.'#', '&amp;', $m[0] );
#
    }
#
 
#
    /**
#
    * Cleans text of all formating and scripting code
#
    */
#
    function cleanText ( &$text )
#
    {
#
        $text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
#
        $text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
#
        $text = preg_replace( '/<!--.+?-->/', '', $text );
#
        $text = preg_replace( '/{.+?}/', '', $text );
#
        $text = preg_replace( '/&nbsp;/', ' ', $text );
#
        $text = preg_replace( '/&amp;/', ' ', $text );
#
        $text = preg_replace( '/&quot;/', ' ', $text );
#
        $text = strip_tags( $text );
#
        $text = htmlspecialchars( $text );
#
        return $text;
#
    }
#
}

class JmosAdminMenus
{
	
	
	/**
 	 * Legacy function, use {@link JHTML::_('menu.ordering')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Ordering( &$row, $id )
	{
		return JHTML::_('menu.ordering', $row, $id);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('list.accesslevel', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Access( &$row )
	{
		return JHTML::_('list.accesslevel', $row);
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Published( &$row )
	{
		$published = JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $row->published );
		return $published;
	}

	/**
 	 * Legacy function, use {@link JAdminMenus::MenuLinks()} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function MenuLinks( &$lookup, $all=NULL, $none=NULL, $unassigned=1 )
	{
		$options = JHTML::_('menu.linkoptions', $lookup, $all, $none|$unassigned);
		if (empty( $lookup )) {
			$lookup = array( JHTML::_('select.option',  -1 ) );
		}
		$pages = JHTML::_('select.genericlist',   $options, 'selections[]', 'class="inputbox" size="15" multiple="multiple"', 'value', 'text', $lookup, 'selections' );
		return $pages;
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Category( &$menu, $id, $javascript='' )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT c.id AS `value`, c.section AS `id`, CONCAT_WS( " / ", s.title, c.title) AS `text`'
		. ' FROM #__sections AS s'
		. ' INNER JOIN #__categories AS c ON c.section = s.id'
		. ' WHERE s.scope = "content"'
		. ' ORDER BY s.name, c.name'
		;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$category = '';

		$category .= JHTML::_('select.genericlist',   $rows, 'componentid', 'class="inputbox" size="10"'. $javascript, 'value', 'text', $menu->componentid );
		$category .= '<input type="hidden" name="link" value="" />';

		return $category;
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Section( &$menu, $id, $all=0 )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT s.id AS `value`, s.id AS `id`, s.title AS `text`'
		. ' FROM #__sections AS s'
		. ' WHERE s.scope = "content"'
		. ' ORDER BY s.name'
		;
		$db->setQuery( $query );
		if ( $all ) {
			$rows[] = JHTML::_('select.option',  0, '- '. JText::_( 'All Sections' ) .' -' );
			$rows = array_merge( $rows, $db->loadObjectList() );
		} else {
			$rows = $db->loadObjectList();
		}

		$section = JHTML::_('select.genericlist',   $rows, 'componentid', 'class="inputbox" size="10"', 'value', 'text', $menu->componentid );
		$section .= '<input type="hidden" name="link" value="" />';

		return $section;
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Component( &$menu, $id )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT c.id AS value, c.name AS text, c.link'
		. ' FROM #__components AS c'
		. ' WHERE c.link <> ""'
		. ' ORDER BY c.name'
		;
		$db->setQuery( $query );
		$rows = $db->loadObjectList( );

		$component = JHTML::_('select.genericlist',   $rows, 'componentid', 'class="inputbox" size="10"', 'value', 'text', $menu->componentid, '', 1 );

		return $component;
	}


	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function ComponentName( &$menu, $id )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT c.id AS value, c.name AS text, c.link'
		. ' FROM #__components AS c'
		. ' WHERE c.link <> ""'
		. ' ORDER BY c.name'
		;
		$db->setQuery( $query );
		$rows = $db->loadObjectList( );

		$component = 'Component';
		foreach ( $rows as $row ) {
			if ( $row->value == $menu->componentid ) {
				$component = JText::_( $row->text );
			}
		}

		return $component;
	}


	/**
 	 * Legacy function, use {@link JHTML::_('list.images', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Images( $name, &$active, $javascript=NULL, $directory=NULL )
	{
		return JHTML::_('list.images', $name, $active, $javascript, $directory);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('list.specificordering', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function SpecificOrdering( &$row, $id, $query, $neworder=0 )
	{
		return JHTML::_('list.specificordering', $row, $id, $query, $neworder);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('list.users', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function UserSelect( $name, $active, $nouser=0, $javascript=NULL, $order='name', $reg=1 )
	{
		return JHTML::_('list.users', $name, $active, $nouser, $javascript, $order, $reg);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('list.positions', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Positions( $name, $active=NULL, $javascript=NULL, $none=1, $center=1, $left=1, $right=1, $id=false )
	{
		return JHTML::_('list.positions', $name, $active, $javascript, $none, $center, $left, $right, $id);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('list.category', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function ComponentCategory( $name, $section, $active=NULL, $javascript=NULL, $order='ordering', $size=1, $sel_cat=1 )
	{
		return JHTML::_('list.category', $name, $section, $active, $javascript, $order, $size, $sel_cat);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('list.section', )} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function SelectSection( $name, $active=NULL, $javascript=NULL, $order='ordering' )
	{
		return JHTML::_('list.section', $name, $active, $javascript, $order);
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function Links2Menu( $type, $and )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT * '
		. ' FROM #__menu '
		. ' WHERE type = '.$db->Quote($type)
		. ' AND published = 1'
		. $and
		;
		$db->setQuery( $query );
		$menus = $db->loadObjectList();

		return $menus;
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function MenuSelect( $name='menuselect', $javascript=NULL )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT params'
		. ' FROM #__modules'
		. ' WHERE module = "mod_mainmenu"'
		;
		$db->setQuery( $query );
		$menus = $db->loadObjectList();
		$total = count( $menus );
		$menuselect = array();
		for( $i = 0; $i < $total; $i++ )
		{
			$registry = new JRegistry();
			$registry->loadINI($menus[$i]->params);
			$params = $registry->toObject( );

			$menuselect[$i]->value 	= $params->menutype;
			$menuselect[$i]->text 	= $params->menutype;
		}
		// sort array of objects
		JArrayHelper::sortObjects( $menuselect, 'text', 1 );

		$menus = JHTML::_('select.genericlist',   $menuselect, $name, 'class="inputbox" size="10" '. $javascript, 'value', 'text' );

		return $menus;
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
		function ReadImages( $imagePath, $folderPath, &$folders, &$images )
	{
		/*jimport( 'joomla.filesystem.folder' );
		$imgFiles = JFolder::files( $imagePath );

		foreach ($imgFiles as $file)
		{
			$ff_ 	= $folderPath.DS.$file;
			$ff 	= $folderPath.DS.$file;
			$i_f 	= $imagePath .'/'. $file;

			if ( is_dir( $i_f ) && $file <> 'CVS' && $file <> '.svn') {
				$folders[] = JHTML::_('select.option',  $ff_ );
				JmosAdminMenus::ReadImages( $i_f, $ff_, $folders, $images );
			} else if ( eregi( "bmp|gif|jpg|png", $file ) && is_file( $i_f ) ) {
				// leading / we don't need
				$imageFile = substr( $ff, 1 );
				$images[$folderPath][] = JHTML::_('select.option',  $imageFile, $file );
			}
		}
		
		/*$imgFiles = JFolder::folders( $imagePath );
		$imgFiles = JFolder::files( $imagePath );
		
		foreach ($imgFiles as $file) {
			$ff_ 	= $folderPath . $file .'/';
			$ff 	= $folderPath . $file;
			$i_f 	= $imagePath .'/'. $file;

			if ( is_dir( $i_f ) && $file != 'CVS' && $file != '.svn') {
				$folders[] = JHTML::_('select.option', $ff_ );
				JmosAdminMenus::ReadImages( $i_f, $ff_, $folders, $images );
			} else if ( eregi( "bmp|gif|jpg|png", $file ) && is_file( $i_f ) ) {
				// leading / we don't need
				$imageFile = substr( $ff, 1 );
				$images[$folderPath][] = JHTML::_('select.option', $imageFile, $file );
			}
		}*/
		
		$imgFiles = JReadDirectory( $imagePath );

		foreach ($imgFiles as $file) {
			$ff_ 	= $folderPath . $file .'/';
			$ff 	= $folderPath . $file;
			$i_f 	= $imagePath .'/'. $file;

			if ( is_dir( $i_f ) && $file != 'CVS' && $file != '.svn') {
				$folders[] = JHTML::_('select.option', $ff_ );
				JmosAdminMenus::ReadImages( $i_f, $ff_, $folders, $images );
			} else if ( preg_match("#gif|jpg|png#i", $file ) && is_file( $i_f ) ) {
				// leading / we don't need
				$imageFile = substr( $ff, 1 );
				$images[$folderPath][] = JHTML::_('select.option', $imageFile, $file );
			}
		}
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function GetImageFolders( &$folders, $path )
	{
		$javascript 	= "onchange=\"changeDynaList( 'imagefiles', folderimages, document.adminForm.folders.options[document.adminForm.folders.selectedIndex].value, 0, 0);  previewImage( 'imagefiles', 'view_imagefiles', '$path/' );\"";
		$getfolders 	= JHTML::_('select.genericlist',   $folders, 'folders', 'class="inputbox" size="1" '. $javascript, 'value', 'text', '/' );
		return $getfolders;
	}

	/**
	 * Legacy function, deprecated
	 *
	 * @deprecated	As of version 1.5
	 */
	function GetImages( &$images, $path )
	{
		if ( !isset($images['/'] ) ) {
			$images['/'][] = JHTML::_('select.option',  '' );
		}
	
		//$javascript	= "onchange=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\" onfocus=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\"";
		$javascript	= "onchange=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\"";
		$getimages	= JHTML::_('select.genericlist',   $images['/'], 'imagefiles', 'class="inputbox" size="10" multiple="multiple" '. $javascript , 'value', 'text', null );

		return $getimages;
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function GetSavedImages( &$row, $path )
	{
		$images2 = array();
		foreach( $row->images as $file ) {
			$temp = explode( '|', $file );
			if( strrchr($temp[0], '/') ) {
				$filename = substr( strrchr($temp[0], '/' ), 1 );
			} else {
				$filename = $temp[0];
			}
			$images2[] = JHTML::_('select.option',  $file, $filename );
		}
		//$javascript	= "onchange=\"previewImage( 'imagelist', 'view_imagelist', '$path/' ); showImageProps( '$path/' ); \" onfocus=\"previewImage( 'imagelist', 'view_imagelist', '$path/' )\"";
		$javascript	= "onchange=\"previewImage( 'imagelist', 'view_imagelist', '$path/' ); showImageProps( '$path/' ); \"";
		$imagelist 	= JHTML::_('select.genericlist',   $images2, 'imagelist', 'class="inputbox" size="10" '. $javascript, 'value', 'text' );

		return $imagelist;
	}
	/**
 	 * Legacy function, use {@link JHTML::_('image.site')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function ImageCheck( $file, $directory='/images/M_images/', $param=NULL, $param_directory='/images/M_images/', $alt=NULL, $name='image', $type=1, $align='top' )
	{
		$attribs = array('align' => $align);
		return JHTML::_('image.site', $file, $directory, $param, $param_directory, $alt, $attribs, $type);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('image.administrator')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function ImageCheckAdmin( $file, $directory='/images/', $param=NULL, $param_directory='/images/', $alt=NULL, $name=NULL, $type=1, $align='middle' )
	{
		$attribs = array('align' => $align);
		return JHTML::_('image.administrator', $file, $directory, $param, $param_directory, $alt, $attribs, $type);
	}

	/**
 	 * Legacy function, use {@link MenusHelper::getMenuTypes()} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function menutypes()
	{
		JError::raiseNotice( 0, 'JmosAdminMenus::menutypes method deprecated' );
	}

	/**
 	 * Legacy function, use {@link MenusHelper::menuItem()} instead
 	 *
 	 * @deprecated	As of version 1.5
 	*/
	function menuItem( $item )
	{
		JError::raiseNotice( 0, 'JmosAdminMenus::menuItem method deprecated' );
	}
}
/**
* ijoomla_surveys table class
*/
class mosijoomla_surveys extends JTable {
	  // INT(11) AUTO_INCREMENT
  	var $s_id=null;
  	var $user_id=null;
  	var $title=null;
	var $alias=null;
  	var $description=null;
  	var $img_url=null;
  	var $created_date=null;
  	var $start_date=null;
  	var $end_date=null;
  	var $approved=1;
  	var $show_result=0;
  	var $result_link=null;
	  // SURVEY STATUS
  	var $open=1;
  	var $ordering=null;
	  // No. QUESTION PER PAGE
	// ADDES VERS 0.34
	var $email_send;
	var $email_send_to;
	// ADDES VERS 0.34	
  	var $num_questions=5;
  	var $form_target=null;
  	var $redirection_url;
  	var $redirection_msg;
  	var $images=null;
  	var $published=0;
  	var $show_on_results=0;
  	var $end_page_title=null;
  	var $end_page_description=null;
  	var $access=null;
  	var $show_popup=null;
  	var $popup_show_freq=7;  
  	var $popup_width=300;
	var $popup_height=250;
  	var $popup_content=null;
  	var $popup_title=null;
  	var $popup_content_style=null;
  	var $popup_title_style=null;
/**
* @param database A database connector object
*/
    function mosijoomla_surveys( &$db ) {
        $this->__construct( '#__ijoomla_surveys_surveys', 's_id', $db );
    }
}

class mosijoomla_questions extends JTable {
	var $q_id=null;
	// SURVEY ID
	var $s_id=null;
	var $title=null;
	// TYPE=menu,checkbox,radio
	var $type=null;
	// PAGE DEFUALT = 0
	var $page_id=0;
	var $required=null;
	// IF ORIENTATION = VERTICAL OTHER ANSWER
	var $other_field=null;
	var $other_field_title=null;
	var $q_order=null;
	var $style=null;
	// ORIENTATION =vertical,matrix,dropdown,horizontal
	var $orientation=null;
	var $published=1;
	var $start_date=null;
	var $end_date=null;
	var $description=null;
	var $random_a;
	var $random_c;
	var $bounded;
	var $minvalue;
	var $maxvalue;
	var $created_date=null;
	var $ordering=null;
	var $constant=null;
	var $show_results=1;
	function mosijoomla_questions( &$db ) {
    	$this->__construct( '#__ijoomla_surveys_questions', 'q_id', $db );
  	}
}

class mosijoomla_surveys_blocks extends  JTable  {
	var $page_id=null;
	var $s_id=null;
	var $title=null;
	var $description=null;
	var $show_title=null;
	var $ordering=null;
	var $published=1;
	var $images=null;	
	function mosijoomla_surveys_blocks( &$db ) {
    	$this->__construct( '#__ijoomla_surveys_pages','page_id', $db );
  	}
}

class mosijoomla_surveys_skip_logics extends  JTable  {
	var $sk_id=null;
	var $title=null;
	var $s_id=null;
	var $page_id=null;
	var $q_id=null;
	var $a_id=null;
	var $logic=null;
	var $compare=null;
	var $value=null;
	var $action=null;
	var $page_target=null;
	var $ordering=null;
	var $published=1;	
	function mosijoomla_surveys_skip_logics( &$db ) {
    	$this->__construct( '#__ijoomla_surveys_skip_logics','sk_id', $db );
  	}
}


class mosijoomla_surveys_config extends  JTable  {
	var $user_can_create_survey=0;
	var $email_approved_survey_subject=null;
	var $email_approved_survey=null;
	function mosijoomla_questions( &$db ) {
    	$this->__construct( '#__ijoomla_surveys_config','', $db );
  	}
}

class mosijoomla_answer extends  JTable {
	var $a_id=null;
	var $q_id=null;
	var $value=null;
	function mosijoomla_answer(&$db) {
		$this->__construct( '#__ijoomla_surveys_answers','a_id', $db );
	}
}

class  mosijoomla_answer_collumn extends JTable {
	var $ac_id=null;
	var $q_id=null;
	var $value=null;
	// MENU ID;
	var $m_id=null;
	function mosijoomla_answer_collumn(&$db) {
		$this->__construct('#__ijoomla_surveys_answer_columns','ac_id', $db);
	}
}

class mosijoomla_session extends JTable {
	var $session_id=null;
	var $ip=null;
	var $played_time=null;
	var $completed=null;
	function mosijoomla_session(&$db) {
		$this->__construct('#__ijoomla_surveys_session','session_id', $db);
	}
}

class mosijoomla_result extends JTable {
	var $r_id=null;
	var $q_id=null;
	var $a_id=null;
	var $m_id=null;
	var $ac_id=null;
	var $session_id=null;
	var $value=null;
	function mosijoomla_result(&$db) {
		$this->__construct('#__ijoomla_surveys_result','r_id', $db);
	}
}

class mosijoomla_result_text extends JTable {
	var $rt_id=null;
	var $q_id=null;
	var $value=null;
	var $session_id=null;
	function mosijoomla_result_text(&$db) {
		$this->__construct('#__ijoomla_surveys_result_text','rt_id', $db);
	}
}

class mosijoomla_menu_heading extends JTable {
	var $m_id=null;
	var $q_id=null;
	var $value=null;
	function mosijoomla_menu_heading(&$db) {
		$this->__construct('#__ijoomla_surveys_menu_heading','m_id', $db);
	}
}

class JCommonHTML
{
	/**
 	 * Legacy function, use {@link JHTML::_('legend');} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function ContentLegend( )
	{
		JHTML::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_content'.DS.'html' );
		JHTML::_('grid.legend');
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function menuLinksContent( &$menus )
	{
		foreach( $menus as $menu ) {
			?>
			<tr>
				<td colspan="2">
					<hr />
				</td>
			</tr>
			<tr>
				<td width="90" valign="top">
					<?php echo JText::_( 'Menu' ); ?>
				</td>
				<td>
					<a href="javascript:go2('go2menu','<?php echo $menu->menutype; ?>');" title="<?php echo JText::_( 'Go to Menu' ); ?>">
						<?php echo $menu->menutype; ?></a>
				</td>
			</tr>
			<tr>
				<td width="90" valign="top">
				<?php echo JText::_( 'Link Name' ); ?>
				</td>
				<td>
					<strong>
					<a href="javascript:go2('go2menuitem','<?php echo $menu->menutype; ?>','<?php echo $menu->id; ?>');" title="<?php echo JText::_( 'Go to Menu Item' ); ?>">
						<?php echo $menu->name; ?></a>
					</strong>
				</td>
			</tr>
			<tr>
				<td width="90" valign="top">
					<?php echo JText::_( 'State' ); ?>
				</td>
				<td>
					<?php
					switch ( $menu->published ) {
						case -2:
							echo '<font color="red">'. JText::_( 'Trashed' ) .'</font>';
							break;
						case 0:
							echo JText::_( 'UnPublished' );
							break;
						case 1:
						default:
							echo '<font color="green">'. JText::_( 'Published' ) .'</font>';
							break;
					}
					?>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="2">
				<input type="hidden" name="menu" value="" />
				<input type="hidden" name="menuid" value="" />
			</td>
		</tr>
		<?php
	}

	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function menuLinksSecCat( &$menus )
	{
		$i = 1;
		foreach( $menus as $menu ) {
			?>
			<fieldset>
				<legend align="right"> <?php echo $i; ?>. </legend>

				<table class="admintable">
				<tr>
					<td valign="top" class="key">
						<?php echo JText::_( 'Menu' ); ?>
					</td>
					<td>
						<a href="javascript:go2('go2menu','<?php echo $menu->menutype; ?>');" title="<?php echo JText::_( 'Go to Menu' ); ?>">
							<?php echo $menu->menutype; ?></a>
					</td>
				</tr>
				<tr>
					<td valign="top" class="key">
						<?php echo JText::_( 'Type' ); ?>
					</td>
					<td>
						<?php echo $menu->type; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" class="key">
						<?php echo JText::_( 'Item Name' ); ?>
					</td>
					<td>
						<strong>
						<a href="javascript:go2('go2menuitem','<?php echo $menu->menutype; ?>','<?php echo $menu->id; ?>');" title="<?php echo JText::_( 'Go to Menu Item' ); ?>">
							<?php echo $menu->name; ?></a>
						</strong>
					</td>
				</tr>
				<tr>
					<td valign="top" class="key">
						<?php echo JText::_( 'State' ); ?>
					</td>
					<td>
						<?php
						switch ( $menu->published ) {
							case -2:
								echo '<font color="red">'. JText::_( 'Trashed' ) .'</font>';
								break;
							case 0:
								echo JText::_( 'UnPublished' );
								break;
							case 1:
							default:
								echo '<font color="green">'. JText::_( 'Published' ) .'</font>';
								break;
						}
						?>
					</td>
				</tr>
				</table>
			</fieldset>
			<?php
			$i++;
		}
		?>
		<input type="hidden" name="menu" value="" />
		<input type="hidden" name="menuid" value="" />
		<?php
	}

	/**
 	 * Legacy function, use {@link JHTMLGrid::checkedOut()} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function checkedOut( &$row, $overlib=1 )
	{
		jimport('joomla.html.html.grid');
		return JHTML::_('grid.checkedOut',$row, $overlib);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('behavior.tooltip')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function loadOverlib()
	{
		JHTML::_('behavior.tooltip');
	}

	/**
 	 * Legacy function, use {@link JHTML::_('behavior.calendar')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function loadCalendar()
	{
		JHTML::_('behavior.calendar');
	}

	/**
 	 * Legacy function, use {@link JHTML::_('grid.access')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function AccessProcessing( &$row, $i, $archived=NULL )
	{
		return JHTML::_('grid.access',  $row, $i, $archived);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('grid.checkedout')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function CheckedOutProcessing( &$row, $i )
	{
		return JHTML::_('grid.checkedout',  $row, $i);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('grid.published')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function PublishedProcessing( &$row, $i, $imgY='tick.png', $imgX='publish_x.png' )
	{
		return JHTML::_('grid.published',$row, $i, $imgY, $imgX);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('grid.state')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function selectState( $filter_state=NULL, $published='Published', $unpublished='Unpublished', $archived=NULL )
	{
		return JHTML::_('grid.state', $filter_state, $published, $unpublished, $archived);
	}

	/**
 	 * Legacy function, use {@link JHTML::_('grid.order')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function saveorderButton( $rows, $image='filesave.png' )
	{
		echo JHTML::_('grid.order', $rows, $image);
	}

	/**
 	 * Legacy function, use {@link echo JHTML::_('grid.sort')} instead
 	 *
 	 * @deprecated	As of version 1.5
 	 */
	function tableOrdering( $text, $ordering, &$lists, $task=NULL )
	{
		// TODO: We may have to invert order_Dir here because this control now does the flip for you
		echo JHTML::_('grid.sort',  $text, $ordering, @$lists['order_Dir'], @$lists['order'], $task);
	}
}
?>
