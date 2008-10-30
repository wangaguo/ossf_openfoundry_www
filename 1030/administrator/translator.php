<?php

$LANGUAGES = array(
#"afrikaans" => array("Afrikaans","iso-8859-1, windows-1252"),
#"albanian" => array("Albanian","iso-8859-1, windows-1252"),
#"arabic" => array("Arabic","iso-8859-6"),
#"basque" => array("Basque","iso-8859-1, windows-1252"),
#"bulgarian" => array("Bulgarian","iso-8859-5"),
#"byelorussian" => array("Byelorussian","iso-8859-5"),
#"catalan" => array("Catalan","iso-8859-1, windows-1252"),
#"croatian" => array("Croatian"," iso-8859-2, windows-1250 "),
#"czech" => array("Czech "," iso-8859-2 "),
#"danish" => array("Danish "," iso-8859-1, windows-1252 "),
#"dutch"=> array("Dutch "," iso-8859-1, windows-1252 "),
"english" => array("english "," iso-8859-1, windows-1252 "),
#"esperanto" => array("Esperanto "," iso-8859-3* "),
#"estonian" => array("Estonian ","iso-8859-15 "),
#"faroese" => array("Faroese "," iso-8859-1, windows-1252 "),
#"finnish"=> array("Finnish "," iso-8859-1, windows-1252 "),
#"france"=>array("fran&ccedil;ais ","iso-8859-1, windows-1252 "),
#"galician"=>array("Galician "," iso-8859-1, windows-1252 "),
#"german" => array("German "," iso-8859-1, windows-1252 "),
#"greek"=> array("Greek "," iso-8859-7 "),
#"hebrew"=> array("Hebrew "," iso-8859-8 "),
#"hungarian"=>array("Hungarian "," iso-8859-2 "),
#"icelandic"=>array("Icelandic "," iso-8859-1, windows-1252 "),
#"irish"=>array("Irish "," iso-8859-1, windows-1252 "),
#"italian"=>array("Italian "," iso-8859-1, windows-1252 "),
#"japanese"=>array("Japanese "," shift_jis, iso-2022-jp, euc-jp"),
#"latvian"=> array("Latvian ","iso-8859-13, windows-1257"),
#"lithuanian"=> array("Lithuanian "," iso-8859-13, windows-1257"),
#"macedonian"=> array("Macedonian ","iso-8859-5, windows-1251"),
#"Maltese"=> array("Maltese ","iso-8859-3"),
#"norwegian"=>array("Norwegian ","iso-8859-1, windows-1252"),
#"polish"=>array("Polish ","iso-8859-2"),
#"portuguese"=>array("Portuguese "," iso-8859-1, windows-1252"),
#"romanian"=>array("Romanian "," iso-8859-2"),
#"russian"=>array("Russian "," koi8-r, iso-8859-5"),
#"scottish"=>array("Scottish "," iso-8859-1, windows-1252"),
"simplified_chinese"=>array("SimplifiedChinese"," utf-8"),
#"srlatin"=>array("Serbian "," iso-8859-2, windows-1250"),
#"slovak"=>array( "Slovak "," iso-8859-2"),
#"slovenian"=>array( "Slovenian "," iso-8859-2, windows-1250"),
"spanish"=>array("espa&ntilde;ol"," iso-8859-1, windows-1252"),
#"swedish"=>array("Swedish "," iso-8859-1, windows-1252"),
"tradition_chinese"=>array("TraditionalChinese"," utf-8"),
#"turkish"=> array("Turkish "," iso-8859-9, windows-1254"),
#"ukrainian"=>array("Ukrainian "," iso-8859-5"),
);

if (isset($_POST['setlanguage']) && $_POST['setlanguage'] && is_array($LANGUAGES[$_POST['setlanguage']])) {
  $_SESSION['adminlanguage'] = array(
    "info" => $_POST['setlanguage'],
    "iso" => $_POST['setlanguage'],
    "charset" => $LANGUAGES[$_POST['setlanguage']][1],
  );
}

if (!isset($_SESSION['adminlanguage']) || !is_array($_SESSION['adminlanguage'])) {
  if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $accept_lan = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
  } else {
    $accept_lan = array('english');
  }
  $detectlan = '';
  foreach ($accept_lan as $lan) {
    if (!$detectlan) {
      if (preg_match('/^([\w-]+)/',$lan,$regs)) {
        $code = $regs[1];
        if (isset($LANGUAGES[$code])) {
          $detectlan = $code;
        } elseif (ereg('-',$code)) {
          list($language,$country) = explode('-',$code);
          if (isset($LANGUAGES[$language])) {
            $detectlan = $language;
          }
        }
      }
    }
  }
  if (!$detectlan) {
    $detectlan = 'english';
  }

  $_SESSION['adminlanguage'] = array(
    "info" => $detectlan,
    "iso" => $detectlan,
    "charset" => $LANGUAGES[$detectlan][1],
  );
}
//$GLOBALS['strCharSet'] = $_SESSION['adminlanguage']['charset'];

# Internacionalización (I18N)
class joomla_I18N {
/** @var boolean If true, highlights string not found */
	/** @var boolean If true, highlights string not found */
	var $_debug = false;
	/** @var string Official element name of the language */
	var $_name=null;
	/** @var string language locale for the locale formating */
	var $_locale=null;
	/** @var string iso charset of html files */
	var $_iso=null;
	/** @var string iso code of the languge */
	var $_isocode=null;
	/** @var boolean True if language is displayed right-to-left */
	var $_rtl=null;
	/** @var string The default language to load */
	var $_defaultLang=null;
	/** @var string The user language to load */
	var $_userLang=null;
	/** @var string The user language to load */
	var $_basedir=null;
	/** @var string Identifying string of the language */
	var $_identifyer=null;
	/** @var array Transaltions */
	var $_strings=null;
	
/*
  var $defaultlanguage = 'english';
  var $language = 'english';
  var $basedir = '';
	var $_identifyer=null;
*/
  function joomla_I18N() {
    global $mosConfig_absolute_path;
    $this->_basedir = $mosConfig_absolute_path.'/administrator/language/';
	$this->_strings = array();

		if( isset( $this->_locale ) ) {
			setlocale (LC_TIME, $this->_locale);
		}
		$this->_defaultLang = 'english';
	
    if (isset($_SESSION['adminlanguage']) && is_dir($this->_basedir.$_SESSION['adminlanguage']['iso'])) {
      $this->_userLang = $_SESSION['adminlanguage']['iso'];
    } else {
      print "Idioma no encontrado: ".$_SESSION['adminlanguage'];
      exit;
    }
  }

	/**
	* Translator function, mimics the php gettext (alias _) function
	*/
	function _( $string, $jsSafe=false ) {
		//$key = str_replace( ' ', '_', strtoupper( trim( $string ) ) );echo '<br>'.$key;
		$key = strtoupper( $string );
		$key = substr( $key, 0, 1) == '_' ? substr( $key, 1 ) : $key;
		if (isset( $this->_strings[$key] )) {
			$string = $this->_debug ? "&bull;".$this->_strings[$key]."&bull;" : $this->_strings[$key];
		} else {
			if( defined( $string ) ) {
				$string = $this->_debug ? "!!" .constant( $string ). "!!" : constant( $string );
			} else {
				$string = $this->_debug ? "??$string??" : $string;
			}
		}
		if ($jsSafe) {
			$string = str_replace( "\n", '\\n', $string );
			$string = str_replace( '"', '&quot;', $string );
			$string = str_replace( '\'', '&#39;', $string );
		}
		return $string;
	}

	/**
	 * Passes a string thru an sprintf
	 * @param format The format string
	 * @param mixed Mixed number of arguments for the sprintf function
	 */
	function sprintf( $string ) {
		$args = func_get_args();
		if (count( $args ) > 0) {
			$args[0] = $this->_( $args[0] );
			return call_user_func_array( 'sprintf', $args );
		}
		return '';
	}
	/**
	 * Passes a string thru an printf
	 * @param format The format string
	 * @param mixed Mixed number of arguments for the sprintf function
	 */
	function printf( $string ) {
		$args = func_get_args();
		if (count( $args ) > 0) {
			$args[0] = $this->_( $args[0] );
			return call_user_func_array( 'printf', $args );
		}
		return '';
	}

/**
	* Loads a language file and appends the results to the existing strings
	* @param string The name of the file
	* @return boolean True if successful, false is failed
	*/
	function _load( $filename ) {
	global $mosConfig_absolute_path;
		if (file_exists( $filename )) {
			if ($content = file_get_contents( $filename )) {
			
				if( $this->_identifyer === null ) {
					$this->_identifyer = basename( $filename, '.ini' );
				}
                include_once $mosConfig_absolute_path ."/includes/joomla.xml.php";
				$this->_strings = array_merge( $this->_strings, mosParameters::parse( $content, false, true ) );

				if (isset( $this->_strings['__NAME'] )) {
					$this->name( $this->_strings['__NAME'] );
				}
				if (isset( $this->_strings['__ISO'] )) {
					$this->iso( $this->_strings['__ISO'] );
				}
				if (isset( $this->_strings['__LOCALE'] )) {
					$this->locale( $this->_strings['__LOCALE'] );
				}
				if (isset( $this->_strings['__ISOCODE'] )) {
					$this->isoCode( $this->_strings['__ISOCODE'] );
				}
				if (isset( $this->_strings['__RTL'] )) {
					$this->rtl( $this->_strings['__RTL'] );
				}

				return true;
			}
		}
		return false;
	}

	/**
	 * Loads a single langauge file
	 * @param string The option
	 * @param mixed The client id: 0=site, 1=admin, 2=installation
	 */
	function load( $option='') {
		$basePath = $this->_basedir ;

		if (empty( $option )) {
			$filename = $basePath . $this->_userLang .'/'.$this->_userLang. '.ini';
			if (!file_exists( $filename ) ) {
				// roll back to default language
				$filename = $basePath . $this->_defaultLang .'/'.$this->_defaultLang. '.ini';
			}
		} else {
			$filename = $basePath . $this->_userLang .'/'.$this->_userLang. '.' . $option . '.ini';
			if (!file_exists( $filename ) ) {
				// roll back to default language
				$filename = $basePath . $this->_defaultLang .'/'.$this->_defaultLang. '.' . $option . '.ini';
			}
		}

		$this->_load( $filename );
	}

	/**
	 * Loads the main and component language files
	 * @param string The option
	 * @param mixed The client id: 0=site, 1=admin, 2=installation
	 */
	function loadAll( $option='') {
		// load primary language file
		$this->load( '' );

		// load 'option'(al) language file
		$option = trim( $option );
		if ($option) {
			$this->load( $option );
		}
	}

	/**
	* Getter for Name
	* @param string An optional value
	* @return string Official name element of the language
	*/
	function name( $value=null ) {
		return $value !== null ? $this->_name = $value : $this->_name;
	}

	/**
	* Getter for ISO
	* @param string An optional value
	* @return string ISO charset for the html files
	*/
	function iso( $value=null ) {
		return $value !== null ? $this->_iso = $value : $this->_iso;
	}

	/**
	* Getter for ISO code
	* @param string An optional value
	* @return string iso code of the languge
	*/
	function isoCode( $value=null ) {
		return $value !== null ? $this->_isocode = $value : $this->_isocode;
	}

	/**
	* Getter for Locale information of the language
	* @param string An optional value
	* @return string locale string
	*/
	function locale( $value=null ) {
		return $value !== null ? $this->_locale = $value : $this->_locale;
	}
	/**
	* Sets/gets the RTL property
	* @param string An optional value
	* @return string locale string
	*/
	function rtl( $value=null ) {
		return $value !== null ? $this->_rtl = $value : $this->_rtl;
	}
	/**
	* Sets/gets the Debug property
	* @param string An optional value
	* @return string locale string
	*/
	function debug( $value=null ) {
		return $value !== null ? $this->_debug = $value : $this->_debug;
	}

	/**
	 * Determines is a key exists
	 */
	function hasKey( $key ) {
		return isset( $this->_strings[strtoupper( $key )] );
	}

}
?>