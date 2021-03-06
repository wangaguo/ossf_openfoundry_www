<?php
/**
* @package		ContentSubmit
* @copyright	Copyright (C) 2009 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class ContentSubmit extends JObject
{
    static $_version 		= '1.5.1';
    static $_copyrightyear 	= '2009';
    static $_name 			= 'contentsubmit';

    /**
     * Get the version
     */
    public static function getVersion()
    {
        return self::$_version;
    }

    /**
     * Get the copyright year
     */
    public static function getCopyrightYear()
    {
        return self::$_copyrightyear;
    }
    
    /**
     * Get the Name
     */
    public static function getName()
    {
        return self::$_name;
    }
    
	/**
     * Get the URL to the folder containing all media assets
     *
     * @param string	$type	The type of URL to return, default 'media'
     * @return 	string	URL
     */
    public static function getURL($type = 'media')
    {
    	$url = '';
    	
    	switch($type) 
    	{
    		case 'media' :
    			$url = JURI::root(true).'/media/com_contentsubmit/';
    			break;
    		case 'css' :
    			$url = JURI::root(true).'/media/com_contentsubmit/css/';
    			break;
    		case 'images' :
    			$url = JURI::root(true).'/media/com_contentsubmit/images/';
    			break;
    		case 'js' :
    			$url = JURI::root(true).'/media/com_contentsubmit/js/';
    			break;			
    	}
    	
    	return $url;
    }
    
	/**
     * Get the path to the folder containing all media assets
     *
     * @param 	string	$type	The type of path to return, default 'media'
     * @return 	string	Path
     */
    public static function getPath($type = 'media')
    {
    	$path = '';
    	
    	switch($type) 
    	{
    		case 'media' :
    			$path = JPATH_SITE.DS.'media'.DS.'com_contentsubmit';
    			break;
    		case 'css' :
    			$path = JPATH_SITE.DS.'media'.DS.'com_contentsubmit'.DS.'css';
    			break;
    		case 'images' :
    			$path = JPATH_SITE.DS.'media'.DS.'com_contentsubmit'.DS.'images';
    			break;
    		case 'js' :
    			$path = JPATH_SITE.DS.'media'.DS.'com_contentsubmit'.DS.'js';
    			break;			
    	}
    	
    	return $path;
    }
    
	/**
	 * Method to dump the structure of a variable for debugging purposes
	 *
	 * @param	mixed	A variable
	 * @param	boolean	True to ensure all characters are htmlsafe
	 * @return	string
	 * @since	1.5
	 * @static
	 */
	function dump( &$var, $htmlSafe = true ) {
		$result = print_r( $var, true );
		return '<pre>'.( $htmlSafe ? htmlspecialchars( $result ) : $result).'</pre>';
	}
	
}

class ContentSubmitConfig extends ContentSubmit 
{
	
	var $show_linkback					= '1';
	var $amigosid						= '';
	var $page_tooltip_dashboard_disabled	= '0';
	var $page_tooltip_config_disabled		= '0';
	var $page_tooltip_tools_disabled		= '0';
	var $page_tooltip_users_disabled		= '0';
		
	/**
	 * constructor
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		
		$this->setVariables();
	}

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery() 
	{
		$query = "SELECT * FROM #__contentsubmit_config";	
		return $query;
	}
	
	/**
	 * Retrieves the data
	 * @return array Array of objects containing the data from the database
	 */
	function getData() {
		// load the data if it doesn't already exist
		if (empty( $this->_data )) {
			$database = &JFactory::getDBO();
			$query = $this->_buildQuery();
			$database->setQuery( $query );
			$this->_data = $database->loadObjectList();
		}
		
		return $this->_data;
	}

	/**
	 * Set Variables
	 *
	 * @acces	public
	 * @return	object
	 */
	function setVariables() {
		$success = false;
		
		if ( $data = $this->getData() ) {
			for ($i=0; $i<count($data); $i++) {
				$title = $data[$i]->title;
				$value = $data[$i]->value;
				if (isset($title)) {
					$this->$title = $value;
				}
			}
			
			$success = true;
		}
		
		return $success;
	}	

	/**
	 * Get component config
	 *
	 * @acces	public
	 * @return	object
	 */
	function &getInstance() {
		static $instance;

		if (!is_object($instance)) {
			$instance = new ContentSubmitConfig();
		}

		return $instance;
	}

	/**
	 * 
	 * @return unknown_type
	 */
	function &getFromXML( $needle='version' ) 
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.archive');
		jimport('joomla.filesystem.path');
		jimport('joomla.installer.installer' );
		jimport('joomla.installer.helper' );
		
		$success = "1.50";
		$pkg = strtolower( "com_contentsubmit" );
		// $row = new JObject();
		
		/* Get the component base directory */
		$adminDir = JPATH_ADMINISTRATOR .DS. 'components';
		$siteDir = JPATH_SITE .DS. 'components';

		/* Get the component folder and list of xml files in folder */
		$folder = $adminDir.DS.$pkg;
		if (JFolder::exists($folder)) {
			$xmlFilesInDir = JFolder::files($folder, '.xml$');
		} else {
			$folder = $siteDir.DS.$pkg;
			if (JFolder::exists($folder)) {
				$xmlFilesInDir = JFolder::files($folder, '.xml$');
			} else {
				$xmlFilesInDir = null;
			}
		}

		//if there were any xml files found
		if (count($xmlFilesInDir))
		{
			foreach ($xmlFilesInDir as $xmlfile)
			{

				if ($data = JApplicationHelper::parseXMLInstallFile($folder.DS.$xmlfile)) {
					foreach($data as $key => $value) {
						// $row->$key = $value;
						if (strtolower($key) == strtolower($needle)) {
							$success = $value;
						}
					}
				}
			}
		}

		return $success;
	}
}
?>