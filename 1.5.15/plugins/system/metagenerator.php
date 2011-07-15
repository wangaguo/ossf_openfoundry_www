<?php
/**
* @author Juan Padial (www.shikle.com)
* This plugin will automatically generate Meta Description tags and Meta keywords from your content.
* version 1.2.8
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.event.plugin');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class plgSystemMetagenerator extends JPlugin
{
  
	// Constructor
    function plgSystemMetagenerator( &$subject, $params )
    {
		parent::__construct( $subject, $params );
    }

function onAfterDispatch()
    {
	$mainframe = &JFactory::getApplication();
        //only mod site pages that are html docs (no admin, install, etc.)
	$document =& JFactory::getDocument();
        $docType = $document->getType();
        $option = JRequest::getVar('option', '');
        if (!$mainframe->isSite() || $docType != 'html') return ;
        
        // load plugin parameters
	$plugin =& JPluginHelper::getPlugin('system', 'metagenerator');
	$pluginParams = new JParameter( $plugin->params );
      $fpdisable = $pluginParams->def('fpdisable', 'no');
      if ($this->isFrontPage() && $fpdisable == 'yes') return;
      $titOrder = $pluginParams->def('titorder', 0);
	$fptitle = $pluginParams->def('fptitle','Home');
	$fptitorder = $pluginParams->def('fptitorder', 0);
	$usecanonical = $pluginParams->def('usecanonical', 0);
	$categorytitle = $pluginParams->def('categorytitle', 0);
	$sitedomain = $pluginParams->def('sitedomain','');

	$pageTitle = $document->getTitle();
	$sitename = $mainframe->getCfg('sitename');
	$sitename = str_replace( '&amp;', '&', $sitename );
	$sep = str_replace('\\','',$pluginParams->def('separator','|')); //Sets and removes Joomla escape char bug.    
        $view = JRequest::getVar('view','');
        if($usecanonical==0){
          $thestart = JRequest::getInt('start',0);
          $limitstart = JRequest::getInt('limitstart',0);
          $start="";
          if($thestart>0) {
            $start = '?start='.$thestart;
          } elseif($limitstart>0) {
            $start = '?limitstart='.$limitstart;
          }
        }
        if ($this->isFrontPage() && $usecanonical==0) {
         if($start!=''){
           $ucanonical = $sitedomain.JRoute::_('index.php').$start;
         } else {
           $ucanonical = $sitedomain;
         }
         $document->addHeadLink( $ucanonical, 'canonical', 'rel', '' );
        }
		
	     $db =  $database =& JFactory::getDBO();
	     if($option == 'com_content') {
		if($view=='article') {

			if($usecanonical==0 || $categorytitle==0){
				$temp = JRequest::getString('id');
				$temp = explode(':', $temp);
				(int) $id = $temp[0];
				if($id>0) {
                                  $query = "SELECT a.sectionid as secid, b.title as cattitle,".
                                  " CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as slug,".
                                  " CASE WHEN CHAR_LENGTH(b.alias) THEN CONCAT_WS(':', a.catid, b.alias) ELSE a.catid END as catslug".
                                  " FROM #__content AS a LEFT JOIN #__categories AS b ON b.id = a.catid WHERE a.id = $id";
                                  $row = $db->SetQuery($query);
                                  $row = $db->loadObject();
                                  if($usecanonical==0){
                                   $ucanonical = $sitedomain.JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->secid));
                                   $document->addHeadLink( $ucanonical, 'canonical', 'rel', '' );
                                  }
                    
                                 if($categorytitle==0 && $row->cattitle!='') {
                                  $sitename = $row->cattitle;
			         }
			        }
			}
		}
		
                if($view=='category' && $usecanonical==0) {
                    $id = JRequest::getInt('id');
                    $query = "SELECT b.id as secid,".
                              " CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(':', a.id, a.alias) ELSE a.id END as catslug".
                              " FROM #__categories as a LEFT JOIN #__sections as b ON b.id = a.section WHERE a.id = $id";
                    $row = $db->SetQuery($query);
                    $row = $db->loadObject();
                      $ucanonical = $sitedomain.JRoute::_(ContentHelperRoute::getCategoryRoute($row->catslug, $row->secid));
                      if(strpos($ucanonical, '&') !== 0) {
                       $start = str_replace('&','?',$start);
                      }
                      $ucanonical = $ucanonical.$start;
                      $document->addHeadLink( $ucanonical, 'canonical', 'rel', '' );
		}
		if($view=='section' && $usecanonical==0) {
                      $ucanonical = $sitedomain.JRoute::_(ContentHelperRoute::getSectionRoute(JRequest::getInt('id')));
                      if(strpos($ucanonical, '&') !== 0) {
                       $start = str_replace('&','?',$start);
                      }
                      $ucanonical = $ucanonical.$start;
                      $document->addHeadLink( $ucanonical, 'canonical', 'rel', '' );
		}
	     }

		if ($this->isFrontPage()):
			if ($fptitorder == 0):
				$newPageTitle = $fptitle . ' ' . $sep . ' '. $sitename;
			elseif ($fptitorder == 1):
				$newPageTitle = $sitename . ' ' . $sep . ' ' . $fptitle;
			elseif ($fptitorder == 2):
				$newPageTitle = $fptitle;
			elseif ($fptitorder == 3):
				$newPageTitle = $sitename;
			endif;
		else:
			if ($titOrder == 0):
				$newPageTitle = $pageTitle . ' ' . $sep . ' ' .  $sitename;
			elseif ($titOrder == 1):
				$newPageTitle = $sitename . ' ' . $sep . ' ' . $pageTitle;
			elseif ($titOrder == 2):
				$newPageTitle = $pageTitle;
			endif;
		endif;
		
		// Set the Title
		$document->setTitle ($newPageTitle);
	}

	function onPrepareContent( &$article, &$params, $limitstart )
	{
		$mainframe = &JFactory::getApplication();
                $option = JRequest::getVar('option', '');
                $view = JRequest::getVar('view', ''); 
                if($option != 'com_content') return; 
                if($option == 'com_content' && $view != 'article') return;
                $plugin =& JPluginHelper::getPlugin('system', 'metagenerator');
                $pluginParams = new JParameter( $plugin->params );
                $fpdisable = $pluginParams->def('fpdisable', 'no');
                if ($this->isFrontPage() && $fpdisable == 'yes') return;
                $document =& JFactory::getDocument();
                if($article->text == '') {
		   return;
		  } elseif($article->metakey == '' || $article->metadesc == '') {
		   $maxcharacters = $pluginParams->def('maxcharacters','500');
		   $thecontent = JString::substr(strip_tags($article->text),0,$maxcharacters);
		   $thecontent = $this->cleanText($thecontent);
		  }
		
                  if ($article->metakey == '' && $document->getMetaData('keywords') == $mainframe->getCfg('MetaKeys')){
                   $catid = JRequest::getInt('catid',0);
                   $listexclude = $pluginParams->def('listexclude','');
                   $goldwords = $pluginParams->def('goldwords','');
                   $minlength = $pluginParams->def('minkeylength','5');
                   $maxwords = $pluginParams->def('maxwords','20');
                   $keywords = $this->cleanAllSymbols($thecontent);
                   $keywords = $this->keys($keywords,$listexclude,$goldwords,$maxwords,$minlength,$catid);
                   //Set the keywords
                   if($keywords != '') {
		    $document->setMetaData('keywords', $keywords);
		   }
                  }
		  // Set the description
		  if ($article->metadesc == '' && $document->getMetaData('description') == $mainframe->getCfg('MetaDesc')) {
		   $thelength = $pluginParams->def('desclength', 200);
		   $metadesc = $thecontent . ' ';
		   $metadesc = JString::substr($metadesc,0,$thelength);
		   $metadesc = JString::substr($metadesc,0,JString::strrpos($metadesc,' '));
		   $document->setDescription($metadesc);
		  }
	}

	
	/* cleanText function - Thx owed to eXtplorer, joomSEO and Jean-Marie Simonet */
	function cleanText( $text ) {
		// Remove tags				
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );		
		$text = preg_replace( '/<!--.+?-->/', '', $text );
		$text = preg_replace( '/{.+?}/', '', $text );
		//$text = strip_tags( $text );
		$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
		$text = preg_replace('/<[^>]*>/', ' ', $text);
		
		// Remove any email addresses
		$regex = '/(([_A-Za-z0-9-]+)(\\.[_A-Za-z0-9-]+)*@([A-Za-z0-9-]+)(\\.[A-Za-z0-9-]+)*)/iex';
		$text = preg_replace($regex, '', $text);
		
		// convert html entities to chars (with conditional for PHP4 users
		if(( version_compare( phpversion(), '5.0' ) < 0 )) {
			require_once(JPATH_SITE.DS.'libraries'.DS.'tcpdf'.DS.'html_entity_decode_php4.php');
			$text = html_entity_decode_php4($text,ENT_QUOTES,'UTF-8');
		}else{
			$text = html_entity_decode($text,ENT_QUOTES,'UTF-8');
		}
		
		$text = str_replace('"', '\'', $text); //Make sure all quotes play nice with meta.
                $text = str_replace(array("\r\n", "\r", "\n", "\t"), " ", $text); //Change spaces to spaces
		
		
		//convert all separators to a normal space
		$text = preg_replace(array('/[\p{Zl}\p{Zp}\p{Zs}]/u',),' ',$text ); //http://www.fileformat.info/info/unicode/category/index.htm
                // remove any extra spaces
		while (strchr($text,"  ")) {
			$text = str_replace("  ", " ",$text);
		}
		
		// general sentence tidyup
		for ($cnt = 1; $cnt < JString::strlen($text)-1; $cnt++) {
			// add a space after any full stops or comma's for readability
			// added as strip_tags was often leaving no spaces
			if ( ($text{$cnt} == '.') || (($text{$cnt} == ',') && !(is_numeric($text{$cnt+1})))) {
				if ($text{$cnt+1} != ' ') {
					$text = JString::substr_replace($text, ' ', $cnt + 1, 0);
				}
			}
		}
			
		return $text;
	}
	
	//function to prepare the text for keywords extraction
	function cleanAllSymbols( $text ) {	    
		//remove symbols
		$text = preg_replace(array('/[\p{Cc}\p{Pd}\p{Pe}\p{Pf}\p{Pi}\p{Po}\p{Ps}\p{Sc}\p{Sm}\p{So}\p{Zl}\p{Zp}\p{Zs}]/u',),' ',$text ); //http://www.fileformat.info/info/unicode/category/index.htm		
                // remove any extra spaces
		while (strchr($text,"  ")) {
			$text = str_replace("  ", " ",$text);
		}			
		return $text;
	}	
	
	function isFrontPage()
	{
		$menu = & JSite::getMenu();
		if ($menu->getActive() == $menu->getDefault()) {
			return true;
		}
		return false;
	}

	function Keys($desc,$blacklist,$sticklist,$count,$minlength,$catid) {
	        $desc = JString::strtolower($desc); 
		$keysArray = explode(" ", $desc);
		// Sort words from up to down
		$keysArray = array_count_values($keysArray);
		$stickArray = explode(",", $sticklist);
		
		if (JString::strlen($blacklist)>0) {
                 $blackArray = explode(",", $blacklist);
	         foreach($blackArray as $blackWord){
		    if(isset($keysArray[JString::trim($blackWord)]))
			unset($keysArray[JString::trim($blackWord)]);
		 }
		}
		arsort($keysArray);
		$i = 1;
		$keywords = "";
		$gkeywords = "";
		
		if (JString::strlen($sticklist)>0) {
		 foreach($keysArray as $word => $instances){
			if($i > $count)
				break;
				if(in_array($word,$stickArray)) {
				$gkeywords .= $word . ",";
				$i++;
			 }
		 }
		}
		foreach($keysArray as $word => $instances){
			if($i > $count)
				break;
			if(JString::strlen(JString::trim($word)) >= $minlength && is_string($word) && in_array($word,$stickArray)==false) {
				$keywords .= $word . ",";
				$i++;
			}
		 }
		$keywords = $gkeywords.$keywords;
		$keywords = JString::rtrim($keywords, ",");
		return $keywords;
  }
}