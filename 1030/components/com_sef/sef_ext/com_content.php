<?php
/**
 * sh404SEF support for com_content component.
 * Copyright Yannick Gaultier (shumisha) - 2007
 * shumisha@gmail.com
 * @version     $Id: com_content.php 229 2008-01-21 19:53:39Z silianacom-svn $
 * {shSourceVersionTag: Version x - 2007-09-20}
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// ------------------  standard plugin initialize function - don't change ---------------------------
global $sh_LANG, $sefConfig;  
$shLangName = '';
$shLangIso = '';
$title = array();
$shItemidString = '';
$dosef = shInitializePlugin( $lang, $shLangName, $shLangIso, $option);
if ($dosef == false) return;
// ------------------  standard plugin initialize function - don't change ---------------------------

// ------------------  load language file - adjust as needed ----------------------------------------
$shLangIso = shLoadPluginLanguage( 'com_content', $shLangIso, '_COM_SEF_SH_CREATE_NEW');
// ------------------  load language file - adjust as needed ----------------------------------------

global $database, $mainframe;
                                          
// 1.2.4.q this is content item, so let's try to improve missing Itemid handling
// retrieve section id to know whether this static or not
$shHomePageFlag = false;

if ((empty($Itemid) || ($Itemid == 99999999)) && !empty($task) 
       && ($task == 'view') ) {
  if (empty($sectionid)) {
    $query = 'SELECT sectionid from #__content WHERE id = '.$id;
    $database->setQuery($query);
    $shSectionId = $database->loadResult();
  } else $shSectionId = $sectionid;  
echo '$shSectionId = '.$shSectionId.'<br />';  
  // retrieve Itemid
  if (empty($mainframe)) { // V 1.2.4.t ! bug #122
    $shMainFrame = new mosMainFrame( $database, $option, '.' );
  } else $shMainFrame = $mainframe;
  if ( !empty($shSectionId) ) {  // has section, so regular content !!! we need to cache this !!
	  $shItemid = $shMainFrame->getItemid( $id, 0, 1);
	  //echo 'shItemid getitemid = '.$shItemid.'<br />';
  } else {  // does not have section, so static
    // V 1.2.4.t better use Joomla built in function !
  	$shItemid = $shMainFrame->getItemid( $id, 1, 1);
//echo 'shItemid selec id = '.$shItemid.'<br />';
  }
  // V 1.2.4.q last possibility : content item is only displayed through com_frontpage
  if (empty($shItemid)) {
    $query = 'SELECT count(content_id) from #__content_frontpage WHERE content_id = '.$id;
    $database->setQuery($query);
    $isOnFrontPage = $database->loadResult();
    if (!empty($isOnFrontPage)) {  // it is on frontpage, let's find out about com_frontpage Itemid
      $query = 'SELECT id,link FROM #__menu WHERE link LIKE "%com_frontpage%"'; // we don't mind if it's not published
      //$database->setQuery($query, 0, 1);
      $database->setQuery($query);  // 10/08/2007 22:12:40 mambo compat
      $database->loadObject($shComFrontpage);
      if (!empty($shComFrontpage)) {      // if on frontpage, let's see if com_frontpage 
        global $shHomeLink;               //is actually frontpage
        if (strpos($shHomeLink, 'com_frontpage') === false) {
          if (!shIsMultilingual() || shIsDefaultLang( $shLangName))
            $string = '';
          else $string = $shLangIso;
          $shHomePageFlag = true;
        } else
          $shItemid =  $shComFrontpage->id;  // content is in com_frontpage, but com_frontpage is not home
          
      }
    }
  }
  // integrate found Itemid
  if (!empty($shItemid)) {
    $string .= '&Itemid='.$shItemid; ;  // append current Itemid 
    $Itemid = $shItemid; 
	
    shAddToGETVarsList('Itemid', $Itemid); // V 1.2.4.m
  }
}

$shHomePageFlag = !$shHomePageFlag ? shIsHomepage ($string): $shHomePageFlag;

if (!$shHomePageFlag) {  // we may have found that this is homepage, so we msut return an empty string
// do something about that Itemid thing
if (eregi('Itemid=[0-9]+', $string) === false) { // if no Itemid in non-sef URL
  // V 1.2.4.t moved back here
  if ($sefConfig->shInsertGlobalItemidIfNone && !empty($shCurrentItemid)) {
    $string .= '&Itemid='.$shCurrentItemid; ;  // append current Itemid 
    $Itemid = $shCurrentItemid; 
    shAddToGETVarsList('Itemid', $Itemid); // V 1.2.4.m
  }
  
  if ($sefConfig->shInsertTitleIfNoItemid)
  	$title[] = $sefConfig->shDefaultMenuItemName ? 
  		$sefConfig->shDefaultMenuItemName : getMenuTitle($option, (isset($task) ? @$task : null), $shCurrentItemid, null, $shLangName );  // V 1.2.4.q added forced language
  $shItemidString = '';
  if ($sefConfig->shAlwaysInsertItemid && (!empty($Itemid) || !empty($shCurrentItemid)))
    $shItemidString = _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement
        .(empty($Itemid)? $shCurrentItemid :$Itemid);
} else {  // if Itemid in non-sef URL
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$Itemid
    : '';
  if ($sefConfig->shAlwaysInsertMenuTitle){
    //global $Itemid; V 1.2.4.g we want the string option, not current page !
    if ($sefConfig->shDefaultMenuItemName)
      $title[] = $sefConfig->shDefaultMenuItemName;// V 1.2.4.q added force language
    elseif ($menuTitle = getMenuTitle($option, (isset($task) ? @$task : null), $Itemid, '',$shLangName )) {
      //echo 'Menutitle = '.$menuTitle.'<br />';
      if ($menuTitle != '/') $title[] = $menuTitle;
    }  
  }  
}  
// V 1.2.4.m 
shRemoveFromGETVarsList('option');
shRemoveFromGETVarsList('lang');
if (!empty($Itemid))  
  shRemoveFromGETVarsList('Itemid');
if (!empty($limit))
  shRemoveFromGETVarsList('limit');  
if (isset($limitstart))
  shRemoveFromGETVarsList('limitstart');  

$task = isset($task) ? @$task : null; 
switch ($task) {
	case 'archivecategory':
	case 'archivesection' :
	  $dosef = false;
	break;
	case 'new' :
	  $title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_CREATE_NEW'];
	  if (!empty($sectionid)) {
      $q = 'SELECT id, title FROM #__sections WHERE id = '.$sectionid;
      $database->setQuery($q);
      if (shTranslateUrl($option, $shLangName)) // V 1.2.4.m
        $database->loadObject( $sectionTitle);
      else $database->loadObject( $sectionTitle, false);
      if ($sectionTitle) {
        $title[] = $sectionTitle->title;
        shRemoveFromGETVarsList('sectionid');
      }  
    }
	  shRemoveFromGETVarsList('task');
	break;
	
	default:
	  // V 1.2.4.j 2007/04/11 : numerical ID, on some categories only
	  if ($sefConfig->shInsertNumericalId && isset($sefConfig->shInsertNumericalIdCatList) 
         && !empty($id) && ($task == 'view')) {
      
      $q = 'SELECT id, catid, created FROM #__content WHERE id = '.$id;
      $database->setQuery($q);
      if (shTranslateUrl($option, $shLangName)) // V 1.2.4.m
        $database->loadObject( $contentElement);
      else $database->loadObject( $contentElement, false);  
      if ($contentElement) {
        $foundCat = array_search($contentElement->catid, $sefConfig->shInsertNumericalIdCatList);
        if (($foundCat !== null && $foundCat !== false) 
            || ($sefConfig->shInsertNumericalIdCatList[0] == ''))  { // test both in case PHP < 4.2.0
          $shTemp = explode(' ', $contentElement->created);
          $title[] = str_replace('-','', $shTemp[0]).$contentElement->id;
	      } 
      }
    }
    
    // V 1.2.4.k 2007/04/25 : if activated, insert edition id and name from iJoomla magazine
    if (!empty($ed) && $sefConfig->shActivateIJoomlaMagInContent && $id && ($task == 'view')) {
      $q = 'SELECT id, title FROM #__magazine_categories WHERE id = '.$ed;
      $database->setQuery($q);
      if (shTranslateUrl($option, $shLangName)) // V 1.2.4.m
        $database->loadObject( $issueName, false);
      else $database->loadObject( $issueName);  
      if ($issueName) {
        $title[] = ($sefConfig->shInsertIJoomlaMagIssueId ? $ed.$sefConfig->replacement:'')
          .$issueName->title;
      } 
      shRemoveFromGETVarsList('ed');
    }
    // end of edition id insertion
    //$shTemp = sef_404::getContentTitles($task,$id, $Itemid, $shLangName);
    //echo '<br />getContentTitle in com_content<br />';
    //var_dump($shTemp);
    //echo '<br />Title<br />';
    //var_dump($title);
    //echo '<br />';
	if (!empty($title))
		  // V 1.2.4.m : we now pass Itemid to getContentTitles(), so as to be able to find menu item name
		  // if blogcategory with several categories (because we don't know which category name to use)
		  $title = array_merge($title, sef_404::getContentTitles($task,$id, (isset($Itemid) ? @$Itemid : null), $shLangName)); // V 1.2.4.q added forced language
	else
	{
		//$title = sef_404::getContentTitles($task,$id,(isset($Itemid) ? @$Itemid : null), $shLangName); // V 1.2.4.q added forced language
		//print_r($title);
		//$title[] = $task.'-'.$id;
        //shAddToGETVarsList('lang', $shLangName);
		//echo $string;
		
		/*081020 update by aeil start
		/*�N�����᪺�ܼƨ��X�A�öJ�s
		*/
		$anchor = explode("#",$string);
		$query = 'SELECT catid, sectionid from #__content WHERE id = '.$id;
		$database->setQuery($query);
		$shcatAndsecId = $database->loadResult();
		/*end*/
		//$title[] = $task.'-'.$id;
		/*08120 update by aeil 
		/*fix some problem �ץ����}�C�ұa���ܼ�
		*/
		$title[] = $shcatAndsecId[0].'-'.$id;
		/*end*/
		
		//$title[] = ' -'.$id;
		//echo $shcatAndsecId[1];
        //shAddToGETVarsList('#', $shcatAndsecId[1]);
	}	
		
		// V 1.2.4.q
    shRemoveFromGETVarsList('task');
    if (isset($id))
      shRemoveFromGETVarsList('id');
    if (!empty($sectionid))
      shRemoveFromGETVarsList('sectionid');  // V 1.2.4.m
    if (!empty($catid))
      shRemoveFromGETVarsList('catid');   // V 1.2.4.m
	}
//echo ">>>>".$string;  	
// ------------------  standard plugin finalize function - don't change ---------------------------  
if ($dosef){
   $string = shFinalizePlugin( $string, $title, $shAppendString, $shItemidString, 
      (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), 
      (isset($shLangName) ? @$shLangName : null));
	/*081020 update by aeil start
	/*�[�J���i�h
	*/
	if(!empty($anchor[1]))$string.=$anchor[1];
	/*end*/
}      
// ------------------  standard plugin finalize function - don't change ---------------------------
} else { // this is multipage homepage
  $title[] = '/';
  $string = sef_404::sefGetLocation( $string, $title, null, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}  
?>
