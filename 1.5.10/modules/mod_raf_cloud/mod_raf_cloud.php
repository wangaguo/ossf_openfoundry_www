<?php
/**
* @version 2.0.2
* @package Raf Cloud
* @copyright Copyright (C) 2007 Skorp. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Raf Cloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @Author: Rafal Blachowski (Skorp) <http://joomla.royy.net>
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!function_exists("mb_strtolower")) {
  function mb_strtolower($str,$encoding=null)
  {
	if (strtoupper($encoding)=="UTF-8")
      		return  utf8_encode(strtolower(utf8_decode($str)));
	return strtolower($str);
}
}

if (!function_exists("mb_strtoupper")) {
  function mb_strtoupper($str,$encoding=null)
  {
	if (strtoupper($encoding)=="UTF-8")
      		return  utf8_encode(strtoupper(utf8_decode($str)));
	return strtoupper($str);
}
}

if (!defined( '_JOS_RAF_CLOUD_MODULE' )) {
	/** ensure that functions are declared only once */
	define( '_JOS_RAF_CLOUD_MODULE', 1 );

  function RC_stripos(&$str,&$needle,&$encoding)
  {
	return strpos(mb_strtolower($str,$encoding),mb_strtolower($needle,$encoding));
  }


function checkSearch(&$word)
{	
	global $database;
	
	$database->setQuery("SELECT search_term FROM `#__core_log_searches` WHERE search_term like '%".$word."%'");
	if ($database->loadResult()) return true;
return false;	
}

function contentSQL($id)
{
	$rules=null;
	if (defined('_JEXEC')) 
	{
		$task = mosGetParam( $_GET, 'view' );
		if ($task=="article") $rules="and id=".$id;
		if ($task=="category") $rules="and catid=".$id;
		if ($task=="section") $rules="and sectionid=".$id;
	}
	else
	{
		$task = mosGetParam( $_GET, 'task' );
		if ($task=="view") $rules="and id=".$id;
		if ($task=="category") $rules="and catid=".$id;
		if ($task=="section") $rules="and sectionid=".$id;
	}


	return $rules;
}

function checkArticle(&$word,&$encoding)
{
	global $database,$mosConfig_dbprefix;
	$id = intval(mosGetParam( $_GET, 'id' ,0 ));
	$rules=contentSQL($id);
	$stag="";
	if (empty($id)) return true;
	$database->setQuery("SELECT * FROM ".$mosConfig_dbprefix."content WHERE state=1 ".$rules);

	if ($cur = $database->query()) 
	{
		while ($row = mysql_fetch_object( $cur )) 
		{
			$stag.=" ".$row->title;
			$stag.=" ".$row->title_alias;
			$stag.=" ".$row->fulltext;
			$stag.=" ".$row->introtext;
		}
	}
	if((RC_stripos(strip_tags($stag),$word,$encoding))!==FALSE) return true;

return false;
}

function checkArticleKey(&$word,&$encoding)
{
	global $database,$mosConfig_dbprefix;
	$id = intval(mosGetParam( $_GET, 'id' ,0 ));
	$stag="";
	$rules=contentSQL($id);

	if (empty($id)) return true;
	$database->setQuery("SELECT * FROM ".$mosConfig_dbprefix."content WHERE state=1 ".$rules);
	if ($cur = $database->query()) 
	{
		while ($row = mysql_fetch_object( $cur )) 
		{
			$stag.=" ".$row->metakey;
		}
	}
	if((RC_stripos(strip_tags($stag),$word,$encoding))!==FALSE) return true;

return false;
}

function checkDocman(&$word,&$encoding)
{
	global $database;
	$gid = intval(mosGetParam( $_GET, 'gid' ,0 ));
	$task = mosGetParam( $_GET, 'task' );
	
	if (empty($gid)) return true;
	$rules=null;
	if ($task=="doc_details") $rules="and id=".$gid;
	if ($task=="cat_view") $rules="and catid=".$gid;

	$stag="";
	$database->setQuery("SELECT dmdescription,dmname FROM #__docman WHERE published=1 ".$rules);
	if ($cur = $database->query()) 
	{
		while ($row = mysql_fetch_object( $cur )) 
		{
			$stag.= " ".$row->dmdescription;
			$stag.= " ".$row->dmname;
		}
	}
	if((RC_stripos(strip_tags($stag),$word,$encoding))!==FALSE) return true;

return false;
}

function checkMojoblog(&$word,&$encoding)
{
	global $database;

	$p=intval(mosGetParam( $_GET, 'p' ));
	$cat=intval(mosGetParam( $_GET, 'cat' ));
	$rules=null;
	if ($p>0) $rules="and ID=".$p;
	if ($cat>0) $rules="and category_id=".$cat;

	$stag="";
	$database->setQuery("SELECT post_content,post_title FROM #__wp_posts,#__wp_post2cat WHERE 	#__wp_posts.ID=#__wp_post2cat.post_id and post_status='publish' ".$rules);

	if ($cur = $database->query()) {
		while ($row = mysql_fetch_object( $cur )) {
			$stag.= " ".$row->post_content;
			$stag.= " ".$row->post_title;
		}
	if((RC_stripos(strip_tags($stag),$word,$encoding))!==FALSE) return true;
	}
return false;

}


function checkSobi(&$word,&$encoding)
{
	global $database;
	$catid = mosGetParam( $_GET, 'catid' );
	$sobi2Id =mosGetParam( $_GET, 'sobi2Id' );

	$rules=null;
	if ($catid>0) $rules="#__sobi2_cat_items_relations.catid=".$catid;
	if ($sobi2Id>0) $rules="and #__sobi2_item.itemid=".$sobi2Id;

	$stag="";
	$database->setQuery("SELECT title,metakey,metadesc,data_txt FROM #__sobi2_item,#__sobi2_cat_items_relations, #__sobi2_fields_data WHERE #__sobi2_item.itemid=#__sobi2_cat_items_relations.itemid and #__sobi2_item.itemid=#__sobi2_fields_data.itemid and published=1 ".$rules );

	if ($cur = $database->query()) 
	{
		while ($row = mysql_fetch_object( $cur )) 
	{
			$stag.= " ".$row->title;
			$stag.= " ".$row->metakey;
			$stag.= " ".$row->metadesc;
			$stag.= " ".$row->data_txt;
		}
	}
	if((RC_stripos(strip_tags($stag),$word,$encoding))!==FALSE) return true;

return false;
}

function showCloudArray(&$params)
{
global $database, $mosConfig_dbprefix;
$rafCloudSearch=intval($params->get('rafCloudSearch', 0));
$rafCloudArticle=intval($params->get('rafCloudArticle', 0));
$rafCloudDocman=intval($params->get('rafCloudDocman', 0));
$rafCloudKeyword=intval($params->get('rafCloudKeyword', 0));
$rafCloudMojoblog=intval($params->get('rafCloudMojoblog', 0));
$rafCloudSobi2=intval($params->get('rafCloudSobi2', 0));

$rafSearch=$params->get('rafSearch', 0);
$rafSearchConnector=$params->get('rafSearchConnector', 0);

$rafSearchOrder=$params->get('rafSearchOrder', "newest");
$rafSearchPhrase=$params->get('rafSearchPhrase', "any");

$rafCloudType=intval($params->get('rafCloudType', 0));

$rafCloudInfo=intval($params->get('rafCloudInfo', 0));
$rafCloudSort=intval($params->get('rafCloudSort', 0));
$rafCloudOrder=intval($params->get('rafCloudOrder', 0));
$rafCloudSef = intval($params->get('rafCloudSef', 0));
$rafCloudLimit = intval($params->get('rafCloudLimit', 10));
$lheight = intval($params->get('rafCloudHeight', 20));
$align=$params->get('rafAlign', "justify");
$uplow=$params->get('rafString', "lowercase");
$rafFormat = intval($params->get('rafFormat', 0));
$rafCounter = intval($params->get('rafCounter', 0));
$moduleclass_sfx = $params->get('moduleclass_sfx', null);
$task = mosGetParam( $_GET, 'task' );
$option = mosGetParam( $_GET, 'option' );
$func = mosGetParam( $_GET, 'func' );
$rafItemid = intval($params->get('rafItemid', 0));
$rafItemidLink=null;

if (!empty($rafItemid)) $rafItemidLink="&Itemid=".$rafItemid;

$encoding = strtoupper(str_replace('charset=','',_ISO));

	if ($rafCloudOrder==1) $order=" ASC "; else $order=" DESC ";

	$orderby=" ORDER BY ";
	switch ($rafCloudSort)
	{
		case 0: $orderby.=" counter ".$order;
		break;
		case 1: $orderby.=" word ".$order;
		break;
		case 2: $orderby.=" counter ".$order.", word ASC";
		break;
		case 3: $orderby.=" counter ".$order.", word DESC";
		break;
		case 4: $orderby=NULL;
		break;
		case 5: $orderby.=" RAND()";
		break;
	}

	$filter=null;
	if ($rafCloudType==1) $filter=" AND (type=1 OR type=4 OR type=5)";
	if ($rafCloudType==2) $filter=" AND (type=2 OR type=4 OR type=5)";

	if ($rafCloudLimit>0)
		$limit="LIMIT ".$rafCloudLimit;
	else
		$limit = null;

	$database->setQuery("SELECT * FROM #__rafcloud_stat WHERE published=1 ".$filter." ".$orderby." ".$limit);
	if ($rows=$database->loadObjectList())
	{
		if ($rafFormat==1) $form="ul"; else $form="p";
		echo("<".$form." style=\"text-align: ".$align."; line-height: ".$lheight."px;\" class=\"". $moduleclass_sfx ."\">\n");

		foreach($rows as $row)
		{
			$show1=true;
			$show2=true;
			if (($row->type!=4)&&($row->type!=5)) //whitelist
			{
			if ($rafCloudSearch>0) $show1=checkSearch($row->word);
			
			if (($rafCloudArticle>0)&&($option=="com_content")) $show2=checkArticle($row->word,$encoding);
			if (($rafCloudKeyword>0)&&($option=="com_content")) $show2=checkArticleKey($row->word,$encoding);
			if (($rafCloudDocman>0)&&($option=="com_docman")) $show2=checkDocman($row->word,$encoding);
			if (($rafCloudSobi2>0)&&($option=="com_sobi2")) $show2=checkSobi($row->word,$encoding);
			if (($rafCloudMojoblog>0)&&($option=="com_mojo")) $show2=checkMojoblog($row->word,$encoding);

			}
			if ($show1&&$show2)
			{ 
				$word=trim($row->word);
				if ($uplow=="lowercase") $word=strtolower($word);
				if ($uplow=="uppercase") $word=strtoupper($word);
				if ($uplow=="mb_lowercase") $word=mb_strtolower($word,$encoding);
				if ($uplow=="mb_uppercase") $word=mb_strtoupper($word,$encoding);

				if (empty($rafSearchConnector))
					$wordSearch=$word;
				else
					$wordSearch=str_replace(" ",$rafSearchConnector,$word);
				$wordSearch=urlencode($wordSearch);

				if ($rafCounter>0) $word.="(".$row->counter.") ";
				if (!empty($rafSearch))
				{
					$search=str_replace("%1",$wordSearch,$rafSearch);
					$search=str_replace("%2",$row->id,$search);
					$search=str_replace("%3",$rafItemidLink,$search);
					$href="href=\"".$search."\"";
				}else
				{
					switch ($rafCloudSef)
					{
					case 1:
						$href="href=\"/searchword/".$wordSearch."/\"";	
					break;
					case 0:
						$href="href=\"index.php?searchword=".$wordSearch."&option=com_search".$rafItemidLink."\"";
					break;
					case 2:
						$href="href=\"".sefRelToAbs("index.php?option=com_rafcloud&ordering=".$rafSearchOrder."&searchphrase=".$rafSearchPhrase."&sid=".$row->id.$rafItemidLink)."\"";
					break;
					case 3:
						$href="href=\"".sefRelToAbs("index.php?searchword=".$wordSearch."&option=com_search".$rafItemidLink)."\"";
					break;
					}
				}
				if ($rafFormat==1) echo ("<li>");
				
				echo("<a ".$href."  style=\" font-size:".$row->fontSize."%;\">".$word."</a>\n");
				if ($rafFormat==1) echo ("</li>");
			}
		}
		echo("</".$form.">");
	}
	if ($rafCloudInfo==1) echo("<div style=\"text-align: right; font-size: 7px; font-weight: bold;\">Powered by <a href=\"http://www.joomla.royy.net\" >RafCloud 2.0.2</a></div>");
	
}
}

showCloudArray($params);
echo "\n<!-- Raf Cloud 2.0.2 - http://joomla.royy.net -->" ;
?>