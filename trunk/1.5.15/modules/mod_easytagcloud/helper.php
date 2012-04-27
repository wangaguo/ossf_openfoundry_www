<?php
/**
* 
* @package		Easytagcloud
* @copyright	Copyright(C)2010 Kenny. All rights reserved.
* @link:
* @license		GNU/GPL, see LICENSE.php
* Easytagcloud is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
class modTagcloudhelper 
{
	
 function init(&$params)
 {
  jimport('joomla.filesystem.file');
  global $mainframe;
  $db=JFactory::getDBO();
  $LDB=JFactory::getDBO();
  $tagsarray=array();
  $catid=explode(",",$params->get('catid'));
	$expcatid=explode(",",$params->get('expcatid'));

	$Lettermanquery="SELECT id FROM #__letterman ";
	$LDB->setQuery($Lettermanquery);
	$lettermanID=$LDB->loadAssocList();
	foreach ($lettermanID as $LID){
			$LIDs.= 'OSSFNL'.$LID[id].',';	
	}
	$newblist = $params->get('blacklist').$LIDs;
	$blacklist=explode(",",$newblist);

  if($catid[0]!='')
    {
	 $catidquery=implode("' OR catid='",$catid);
	 $catidquery="AND catid='".$catidquery."'";
	}
	else
	{
	     $catidquery="";
     }
	 
  if($expcatid[0]!='')
     {
	  $expcatidquery=implode("' AND catid <>'",$expcatid);
	  $expcatidquery=" AND catid<>'".$expcatidquery."'";
	 }
	 else
	  {
	     $expcatidquery="";
	  }
	   
      $query="SELECT metakey FROM #__content WHERE state='1' ".$catidquery.$expcatidquery;
      $db->setQuery($query);
			$queryresult=$db->loadObjectlist();
      $save='<?php $tagsarray=array(';
      $firsttagsymbol=true;

   foreach($queryresult as $result)
   {
      $temp=explode(",",$result->metakey);  
        foreach($temp as $t)
        {	 
           $t=addslashes(strip_tags($t));
					 $t=trim($t);
           if(!in_array($t,$blacklist)&&$t!='')
					 {   
              if(in_array($t,array_keys($tagsarray)))
              {
											$tagsarray[$t]+=1;
              }

              else
              {
                 $tagsarray[$t]=1;
              }

           }
   
       }
  }

 foreach($tagsarray as $key=>$value)
 {
	if(!$firsttagsymbol)
	{
	   $save.=',';
	}
	else
	{
	   $firsttagsymbol=false;
	}
	
    $save=$save.'\''.$key.'\'=>'.$value;
 }
 
 $save=$save."); ?>";
 JFile::write(dirname(__FILE__).DS."tagsdata.php",$save);
 $currenttime='<?php $updatetime='.time().'; ?>';
 $filepath=dirname(__FILE__).DS.'updatetime.php';
 JFile::write($filepath,$currenttime);

}


 function getTags(&$params)
 {
    require_once (dirname(__FILE__).DS.'tagsdata.php');
    $tagcloud_params=new stdClass();
    $tagcloud_params->tagsarray=array();
    $tagcloud_params->tagssum=0;
    $tagcloud_params->tagsstyle=array();
    arsort($tagsarray);
    $len=$params->get('maxtags')>count($tagsarray)?count($tagsarray):$params->get('maxtags');
    $tagsarray=array_splice($tagsarray,0,$len);
    $tagssum=0;
    ksort($tagsarray);
    foreach($tagsarray as $key=>$value)
	{
       $tagcloud_params->tagsarray[$key]=$value;
       $tagssum+=$value;
    }

    foreach($tagsarray as $key=>$value)
    {
       $style=modTagcloudhelper::fontsizeCal($value,$tagssum,$params);
       $tagcloud_params->tagsstyle[$key]=$style;
    }

    $tagcloud_params->tagssum=$tagssum;
	
	// set color
	if($params->get('tagscolor')!='')
	  {
	   $validcheck=substr($params->get('tagscolor'),0,1);
	   if($validcheck=='#')
	      {
			 $color=$params->get('tagscolor');
		  }else
		     {
	         $color="#".$params->get('tagscolor');	         
			 }
	  }
	// set underline
	if($params->get('show_underline'))
	  {
       $show_underline="underline";
	   }
	   else
	     {
           $show_underline="none";
		 }
		 
	//set underline when mouse hover
	if($params->get('hover_show_underline'))
	  {
       $hover_show_underline="underline";
	   }
	   else
	     {
           $hover_show_underline="none";
		 }
		 
		 
    $tagcloud_params->show_underline=$show_underline;
		$tagcloud_params->hover_show_underline=$hover_show_underline;
    $tagcloud_params->color=$color;	
	  
return $tagcloud_params;
 }

 function fontsizeCal($n,$m,$params)
 {
    //Caculate the font size based on the radio,but not bigger than the max font size or smaller than the min font size 
	$k=$params->get('coefficient');
    $radio=number_format(($n/$m),2);
	$fontsize=$radio*$k>$params->get('maxfontsize')?$params->get('maxfontsize'):($radio*$k<$params->get('minfontsize')?$params->get('minfontsize'):$radio*$k);
    return $fontsize;
 }


}
?>
