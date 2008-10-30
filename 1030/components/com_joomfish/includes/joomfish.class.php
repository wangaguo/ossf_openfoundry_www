<?php
/**
 * Joom!Fish - Multi Lingual extention and translation manager for Joomla!
 * Copyright (C) 2003-2007 Think Network GmbH, Munich
 *
 * All rights reserved.  The Joom!Fish project is a set of extentions for
 * the content management system Joomla!. It enables Joomla!
 * to manage multi lingual sites especially in all dynamic information
 * which are stored in the database.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * -----------------------------------------------------------------------------
 * $Id: joomfish.class.php 776 2007-11-24 09:39:21Z geraint $
 *
*/

/**
* @package joomfish
 * @subpackage frontend.includes
 * @copyright 2003-2007 Think Network GmbH
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version $Revision: 776 $
 * @author Alex Kempkens <Alex@JoomFish.net>
*/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// backwards compatability hack!
global $mambelfishWarnedAdmin;
$mambelfishWarnedAdmin=false;
class MambelFish{
	function warnAdmin(){
		global $mosConfig_mailfrom, $mosConfig_fromname, $adminEmail,$mambelfishWarnedAdmin;
		$privateWarning=false;
		if (!$mambelfishWarnedAdmin) {
			$bt = debug_backtrace();
			if (count($bt)>=2){
				$subject = "Deprecated use of Mambelfish Translation";
				$content = "Deprecated use of Mambelfish. Request URL : ".$_SERVER['REQUEST_URI']."\n\n";
				$content .= "Please contact the author of this component/module/mambot with the details in this message.\n\n";
				$content .= "In the meantime the following function reference can be commented out and translation should not be affected.\n";
				$content .= "File : ".basename(dirname($bt[1]["file"]))."\\".basename($bt[1]["file"])."\n";
				$content .= "Line : ".$bt[1]["line"]."\n";
				$content .= "Function : ".$bt[1]["function"]."\n\n";
				if ( $privateWarning) {
					global $database, $my ;
					require_once( mosMainFrame::getBasePath() .'/components/com_messages/messages.class.php' );

					$query = "SELECT id"
					. "\n FROM #__users"
					. "\n WHERE sendEmail = 1"
					;
					$database->setQuery( $query );
					$users = $database->loadResultArray(false);
					foreach ($users as $user_id) {
						$msg = new mosMessage( $database );
						// send message from admin
						$msg->send( $user_id, $user_id, $subject, $content);
					}
				}

				else {
					$content = str_replace("\n","<br/>",$content);
					echo "$content";
				}
			}
			//mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $subject, $content );
		}
		$mambelfishWarnedAdmin=true;
	}
	function translate( $content, $reference_table, $language, $tableArray=array())	{ MambelFish::warnAdmin(); return $content;}
	function translateList( $rows, $reference_table, $language , $tableArray) {	  MambelFish::warnAdmin(); return $rows;}
}

/**
 * The joom fish change the text information in the supported
 * objects after they have been loaded. The idea is to create a
 * flexible environment which can add the multi language support at
 * any time.</p>
 *
 * The basic concept behind the joom fish is to map an existing content
 * with all his general information to a different translation of it's
 * text content. There is no additional copy of the information like the
 * author or publishing flags, only a copy of the text fields.
 *
 * @author	A. Kempkens
 */
class JoomFish {
	/* New experimental version*/
	function translateList( &$rows, $reference_table, $language , $tableArray) {
		if (!isset($rows) || !is_array($rows)) return $rows;

		global  $_JOOMFISH_MANAGER, $mosConfig_defaultLang, $database;
		$querySQL = $database->_sql;
		// do not try to translate if I have no fields!!!
		if (!isset($tableArray) || count($tableArray)==0) {
			//echo "$tableArray $querySQL<br>";
			return;
		}
		// If I write content in non-default language then this skips the translation!
		//if($language == $mosConfig_defaultLang) return $rows;
		// toggle variable to allow testing - remove at later date!
		$useTranslateListWithIDs = true;
		$rowsLanguage = $language;
		if (count($rows)>0){
			foreach ($tableArray["fieldTablePairs"] as $alias=>$value){
				$reftable = $tableArray["fieldTablePairs"][$alias];

				// If there is not translated content for this table then skip it!
				if (!$database->translatedContentAvailable($reftable)) continue;

				// get primary key for tablename
				$idkey = $_JOOMFISH_MANAGER->getPrimaryKey( trim($reftable) );

				// I actually need to check the primary key against the alias list!

				for ($i=0;$i<$tableArray["fieldCount"];$i++){
					if (!array_key_exists($i,$tableArray["fieldTableAliasData"])) continue;
					// look for fields from the correct table with the correct name
					if ($tableArray["fieldTableAliasData"][$i]["tableName"]==$reftable &&
					$tableArray["fieldTableAliasData"][$i]["fieldName"]==$idkey
					&&  $tableArray["fieldTableAliasData"][$i]["tableNameAlias"]==$alias){
						$idkey=$tableArray["fieldTableAliasData"][$i]["fieldNameAlias"];
						break;
					}
				}

				$idstring = "";
				$idlist = array(); // temp variable to make sure all ids in idstring are unique (for neatness more than performance)
				foreach( array_keys( $rows) as $key ) {
					$content =& $rows[$key];

					// NASTY KLUDGE TO DEAL WITH SQL CONSTRUCTION IN contact.php, weblinks.php where multiple tables to be translated all use "id" which gets dropped! etc.
					if ($reftable=='categories' && isset($content->catid) && $content->catid>0 && (!isset($content->section) || $content->section!='')) {
						$newidkey = "catid";
						$idkey = $newidkey;
					}

					if (isset($content->$idkey) && !in_array($content->$idkey,$idlist)) {
						//print ($idkey ." ".$content->$idkey." list<br>");
						$idstring .= (strlen( $idstring)>0?",":""). $content->$idkey;
						$idlist[] = $content->$idkey;
					}
				}
				/* no translate if you have no id!*/
				/* Some queries do not include the primarykey/index - consider reissuing these queries*/
				// This is too dangerous for production at present
				/*
				if (strlen( $idstring)==0) {
				global $database;
				// Useful DEBUG message to spot untranslated material and its cause!
				//echo "no primarykey/index in query string change original query? : $querySQL<br>";

				// RADICAL ATTEMPT TO REWORK SQL ON THE FLY
				// FOR THIS TO WORK I NEED TO TRACK THE ALIAS AND REUSE IT IN IDENTIFYING THE EXTRA FIELD!
				$tempArray = preg_split("/SELECT\s+/i",$querySQL);
				if (count($tempArray)!=2) return;
				global $mosConfig_dbprefix;
				$alias = $tableArray["tableAliases"][$reftable];
				if (!isset($alias)) return;
				$querySQL = "SELECT $alias.$idkey, ".$tempArray[1];
				//echo "reworked query : $querySQL<br>";
				$database->setQuery($querySQL);
				// SOME COMPONENTS USE loadRESULT AND DO NOT CHECK FIELDS
				// SINCE THEY WROTE THE SQL THEMSELVES!!
				// IMUST NOT THEREOFRE write this directly into $content
				// MAKE SURE THIS IS NOT TRANSLATED TO AVOID ALL RISKS OF RECURSION!
				$rows2 = $database->loadObjectList("",false);
				foreach( array_keys( $rows2) as $key ) {
				$content =& $rows2[$key];
				$idstring .= (strlen( $idstring)>0?",":""). $content->$idkey;
				}
				if (strlen( $idstring)==0) {
				// In this case I give up - no translation!
				return;
				}

				}
				*/
				if (strlen( $idstring)==0) continue;

				if ($useTranslateListWithIDs)
				JoomFish::translateListWithIDs( $rows, $idstring, $reftable, $language ,$idkey, $tableArray);
				else
				JoomFish:: translateListOLD( $rows, $reftable, $language );
			}
		}
	}

	/** Cover function which tries to find out the id from the object
	 *
	 */
	function translate( &$content, $reference_table, $language, $tableArray=array())
	{
		// no point trying to translate a bad result
		if (is_null($content)){
			return;
		}
		//print "translate $reference_table<br>";
		// if the currect language is the site default language not translations needed
		global $mosConfig_lang, $mosConfig_defaultLang,  $_JOOMFISH_MANAGER, $database;
		$querySQL = $database->_sql;
		// If I write content in non-default language then this skips the translation!
		//if($language == $mosConfig_defaultLang) return;
		if (isset($tableArray) && array_key_exists("fieldTablePairs",$tableArray)) foreach ($tableArray["fieldTablePairs"] as $i=>$value){
			$reftable = $tableArray["fieldTablePairs"][$i];

			$idkey = $_JOOMFISH_MANAGER->getPrimaryKey( trim($reftable) );

			// I actually need to check the primary key against the alias list!

			for ($i=0;$i<$tableArray["fieldCount"];$i++){
				if (!array_key_exists($i,$tableArray["fieldTableAliasData"])) continue;
				// look for fields from the correct table with the correct name
				if ($tableArray["fieldTableAliasData"][$i]["tableName"]==$reftable &&
				$tableArray["fieldTableAliasData"][$i]["fieldName"]==$idkey){
					$idkey=$tableArray["fieldTableAliasData"][$i]["fieldNameAlias"];
					break;
				}
			}
			
			// use this instead of isset on class because value of idkey may be null and isset returns true!!
			if (array_key_exists($idkey,get_object_vars($content))) {
				//print ($idkey ." ".$content->$idkey." nonlist<br>");
				$id = $content->$idkey;
				JoomFish::translateWithID( $content, $id, $reftable, $language,  $idkey, $tableArray);
			}
			else  {
				global $database;
				// Useful DEBUG message to spot untranslated material and its cause!
				// VERY IMPORTANT SKIP ANY SQL THAT IS A SELECT UPDATE etc.!
				//echo "no primarykey/index in query string change original query? : $querySQL<br>";
				// RADICAL ATTEMPT TO REWORK SQL ON THE FLY
				// FOR THIS TO WORK I NEED TO TRACK THE ALIAS AND REUSE IT IN IDENTIFYING THE EXTRA FIELD!
				$tempArray = preg_split("/SELECT\s+/i",$querySQL);
				if (count($tempArray)!=2) return;
				global $mosConfig_dbprefix;
				$alias = $tableArray["tableAliases"][$reftable];
				if (!isset($alias)) return;
				$querySQL = "SELECT $alias.$idkey, ".$tempArray[1];
				//echo "reworked query : $querySQL<br>";
				$database->setQuery($querySQL);
				// SOME COMPONENTS USE loadRESULT AND DO NOT CHECK FIELDS
				// SINCE THEY WROTE THE SQL THEMSELVES!!
				// IMUST NOT THEREOFRE write this directly into $content
				// MAKE SURE THIS IS NOT TRANSLATED TO AVOID ALL RISKS OF RECURSION!
				$database->loadObject($content2,false);
				//echo var_export($content2,true);
				if (isset($content2->$idkey)) {
					$id = $content2->$idkey;
					//$content = $content2;
					//echo var_export($content,true);
					JoomFish::translateWithID( $content, $id, $reftable, $language,  $idkey, $tableArray);
				}

			}

		}
		else {
			if (isset($content->id))
			JoomFish::translateWithID( $content, $content->id, $reference_table, $language,  $idkey,$tableArray);
		}
	}

	/**
	 * Function to translate a section object
	 *
	 * @static
	 * @param object  $content by reference
	 * @param int $id
	 * @param string $reference_table
	 * @param string $language
	 * @param string $refTablePrimaryKey
	 * @param array $tableArray
	 * @return void
	 */
	function translateWithID( &$content, $id, $reference_table, $language, $refTablePrimaryKey="id", $tableArray)
	{
		/**
	 	 * This function now uses the list code which can handle a single item list!
	 	 */
		$rows = array();
		$rows[0]=$content;
		JoomFish::translateListWithIDs( $rows, $id, $reference_table, $language, $refTablePrimaryKey, $tableArray);
		$content=$rows[0];
		return;
	}

	/**
	  * Function to translate a section object
	  */
	function translateListWithIDs( &$rows, $ids, $reference_table, $language, $refTablePrimaryKey="id", $tableArray, $allowfallback=true)
	{
		//print " translateListWithIDs for ids=$ids refTablePrimaryKey=$refTablePrimaryKey<br>" ;
		global $database, $mosConfig_debug, $mosConfig_defaultLang, $_JOOMFISH_MANAGER;
		if ($reference_table == "languages" || $reference_table == "jf_content" ) {
			return;					// I can't translate myself ;-)

		}

		// find reference table alias
		$reftableAlias = $reference_table;
		for ($i=0;$i<$tableArray["fieldCount"];$i++){
			if (!array_key_exists($i,$tableArray["fieldTableAliasData"])) continue;
			// ANOTHER NASTY KLUDGE TO DEAL WITH SQL CONSTRUCTION IN content.php, contact.php and weblinks.php
			// by Kochin Chang, 2008-02-21
			if ($tableArray["fieldTableAliasData"][$i]["tableName"]==$reference_table) {
			  if ($tableArray["fieldTableAliasData"][$i]["fieldNameAlias"]==$refTablePrimaryKey
        || $reference_table=='categories'){
				  $reftableAlias = $tableArray["fieldTableAliasData"][$i]["tableNameAlias"];
				  break;
				}
			}
		}

		//print " translateListWithIDs( ".count($rows). ", ids=$ids, reftab=$reference_table, $language, primkey = $refTablePrimaryKey )<br>";
		if ($mosConfig_debug) {
			echo "<p><strong>JoomFish debug (new):</strong><br>"
			. "reference_table=$reference_table<br>"
			. "$refTablePrimaryKey  IN($ids)<br>"
			. "language=$language<br>"
			.(count($rows)>0? "class=" .get_class(current($rows)):"")
			. "</p>";
		}

		static $languages;
		if (!isset($languages)){
			$sql = "SELECT * from #__languages";
			$database->setQuery( $sql );
			$languages = $database->loadObjectList("code",false);
		}

		// process fallback language
		$fallbackrows=array();
		$idarray = explode(",",$ids);
		$fallbackids=array();
		if ($languages[$language]->fallback_code==""){
			$allowfallback=false;
		}
		else {
			$fallbacklanguage = $languages[$language]->fallback_code;
			if (!array_key_exists($fallbacklanguage, $languages)){
				$allowfallback=false;
			}
		}

		if (isset($ids) && $reference_table!='') {
			$sql = "SELECT jf_content.reference_field, jf_content.value, jf_content.reference_id, jf_content.original_value "
			. "\nFROM #__jf_content AS jf_content"
			//. "\n  , #__languages as languages"
			//. "\nWHERE jf_content.language_id=languages.id"
			. "\nWHERE jf_content.language_id=".$languages[$language]->id
			. "\n	AND jf_content.published=1"
			. "\n   AND jf_content.reference_id IN($ids)"
			. "\n   AND jf_content.reference_table='$reference_table'"
			//. "\n	AND languages.code='$language'"
			;
			$database->setQuery( $sql );
			$translations = $database->loadObjectList('',false);
			if (count($translations)>0){
				$fieldmap = null;
				foreach( array_keys( $rows) as $key ) {
					$row_to_translate =& $rows[$key];
					$rowTranslationExists=false;
					//print_r ($row_to_translate); print"<br>";
					if( isset( $row_to_translate->$refTablePrimaryKey ) ) {
						foreach ($translations as $row){
							if ($row->reference_id!=$row_to_translate->$refTablePrimaryKey) continue;
							$refField = $row->reference_field;
							// adjust refField for aliases (make sure the field is from the same table!).
							// I could reduce the calculation by building an array of translation reference fields against their mapping number
							// but this refinement can wait!
							for ($i=0;$i<$tableArray["fieldCount"];$i++){
								if (!array_key_exists($i,$tableArray["fieldTableAliasData"])) continue;
								// look for fields from the correct table with the correct name
								if ($tableArray["fieldTableAliasData"][$i]["tableName"]==$reference_table &&
								$tableArray["fieldTableAliasData"][$i]["fieldName"]==$refField &&
								$tableArray["fieldTableAliasData"][$i]["tableNameAlias"] == $reftableAlias){
									$refField=$tableArray["fieldTableAliasData"][$i]["fieldNameAlias"];
									$adjustedRefField=$refField;
									break;
								}
							}
							$fieldIndex = $i;
							if (isset( $row->reference_id)  && $row->reference_id==$row_to_translate->$refTablePrimaryKey && $fieldIndex<$tableArray["fieldCount"]){
								if (is_subclass_of($row_to_translate, 'mosDBTable')) {
									$row_to_translate->set($row->reference_field, $row->value);
								} else {
									$row_to_translate->$refField = $row->value;
								}
								$rowTranslationExists=true;
								//print_r( $row_to_translate);
							}
						}
						if (!$rowTranslationExists){
							if ($allowfallback){
								$fallbackrows[$key] =& $rows[$key];
								$fallbackids[$key] = $rows[$key]->$refTablePrimaryKey;
							}
							else {
								JoomFish::processMissingTranslation($row_to_translate, $language,$reference_table);
							}
						}
					}
				}
			}
			else {
				foreach( array_keys( $rows ) as $key ) {
					if ($allowfallback){
						$fallbackrows[$key] =& $rows[$key];
						$fallbackids[$key] = $rows[$key]->$refTablePrimaryKey;
					}
					else {
						JoomFish::processMissingTranslation($rows[$key], $language,$reference_table);
					}
				}
			}


			if ($allowfallback && count($fallbackrows)>0 ){
				$fallbackids = implode($fallbackids,",");
				JoomFish::translateListWithIDs( $fallbackrows, $fallbackids, $reference_table, $fallbacklanguage, $refTablePrimaryKey, $tableArray, false);
			}
		}
	}

	/**
	 * Works out what to show if the translation is missing
	 *
	 * @param object $row_to_translate
	 * @param string $language
	 * @param string $reference_table
	 */
	function processMissingTranslation(&$row_to_translate, $language,$reference_table){
		global $database, $mosConfig_debug, $mosConfig_defaultLang, $mosConfig_lang, $_JOOMFISH_MANAGER;
		$noTranslationBehaviour = $_JOOMFISH_MANAGER->getCfg( 'noTranslation' );
		if( $noTranslationBehaviour  >= 1 && $language != $mosConfig_defaultLang ) {
			// don't even think about translations if none exist for the table
			if ($database->translatedContentAvailable($reference_table)) {
				// only offer alternatives for table == content
				if( $reference_table == $_JOOMFISH_MANAGER->DEFAULT_CONTENTTYPE ) {
					$defaultText = $_JOOMFISH_MANAGER->getCfg('defaultText');

					if ($defaultText=="") {
						// load language file to get default text
						require_once( mosMainFrame::getBasePath() .'/components/com_joomfish/includes/defines.php' );
						require_once( JOOMFISH_LIBPATH .DS. 'joomla' .DS. 'language.php' );
						require_once( JOOMFISH_LIBPATH .DS. 'joomla' .DS. 'registry.php' );
						$lang =& JLanguageHelper::getLanguage($language);
						$lang->load( 'com_joomfish', JOOMFISH_LANGPATH );
						//$lang->setDebug( true );

						$defaultText = '<div class="jfdefaulttext">' .JText::_('FRONTPAGE_NO_TRANSLATION_AVAILABLE'). '</div>';
					}
					if ($noTranslationBehaviour==3 && isset($row_to_translate->id)){
						$defaultText="{jfalternative}".$row_to_translate->id."|content|$defaultText{/jfalternative}";
					}

					// Note that its critical that the content elements are only loaded here otherwise joomla caching of content is wasted
					// since the contentelement files are loaded unnecessarily even when the content is cached!!

					// cache this burdonsome analysis of field types
					$fieldInfo = JoomFish::_contentElementFields($reference_table);
					//$contentElement = $_JOOMFISH_MANAGER->getContentElement( $reference_table );
					//$contentObject = new ContentObject( $_JOOMFISH_MANAGER->getLanguageID($language), $contentElement );
					//$textFields = $contentObject->getTextFields();
					$textFields = $fieldInfo["textFields"];
					if( $textFields !== null ) {
						$defaultSet = false;
						foreach ($textFields as $field) {
							if( !$defaultSet ) {
								if ($noTranslationBehaviour==1)	{
									$row_to_translate->$field = $defaultText;
								} else if ($noTranslationBehaviour>=2) {
									//if ($contentObject->getFieldType($field)=="htmltext"){
									if ($fieldInfo["fieldTypes"][$field]=="htmltext"){
										$cr="<br/>";
									} else {
										$cr="\n";
									}
									$row_to_translate->$field = $defaultText .$cr.(isset($row_to_translate->$field)?$row_to_translate->$field:"");
								}
								$defaultSet = true;
							} else {
								if ($noTranslationBehaviour==1)	{
									$row_to_translate->$field = "";
								} else if ($noTranslationBehaviour>=2) {
									//if ($contentObject->getFieldType($field)=="htmltext"){
									if ($fieldInfo["fieldTypes"][$field]=="htmltext"){
										$cr="<br/>";
									} else {
										$cr="\n";
									}
									$row_to_translate->$field = (isset($row_to_translate->$field)?$row_to_translate->$field:"");
								}
							}
						}
					}
				}
			}
		}

	}

	/**
	 * Cached extraction of content element field information
	 * this cached version is chared between pages and hence makes a big improvement to load times
	 * for newly visited pages in a cached scenario
	 *
	 * private function
	 *
	 * @param string $reference_table
	 * @return unknown
	 */
	function _contentElementFields($reference_table){
		static $info;
		if (!isset($info)){
			$info = array();
		}
		if (!isset($info[$reference_table])){
			$cacheDir = dirname(__FILE__)."/cache";
			if (!file_exists($cacheDir)){
				mkdir($cacheDir);
			}
			$cacheFile = $cacheDir."/".$reference_table."_cefields.cache";
			if (file_exists($cacheFile)){
				$cacheFileContent = file_get_contents($cacheFile);
				$info[$reference_table] = unserialize($cacheFileContent);
			}
			else {
				$jfm =& JoomFishManager::getInstance();
				$contentElement = $jfm->getContentElement( $reference_table );
				// The language is not relevant for this function so just use the current language
				global $mosConfig_lang;
				$contentObject = new ContentObject( $jfm->getLanguageID($mosConfig_lang), $contentElement );
				$textFields = $contentObject->getTextFields();
				$info[$reference_table]["textFields"] = $textFields ;
				$info[$reference_table]["fieldTypes"] = array();
				if( $textFields !== null ) {
					$defaultSet = false;
					foreach ($textFields as $field) {
						$info[$reference_table]["fieldTypes"][$field] = $contentObject->getFieldType($field);
					}
				}
				$cacheFileContent = serialize($info[$reference_table]);
				$handle = fopen($cacheFile,"w");
				fwrite($handle,$cacheFileContent);
				fclose($handle);	
			}
		}

		return $info[$reference_table];
	}

	/**
	  * Version information of the component
	  *
	  * @author	Alex Kempkens
	  */
	function version() {
		return JoomFishManager :: getVersion();
	}
}

?>
