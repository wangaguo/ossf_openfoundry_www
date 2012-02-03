<?php 
// no direct access
 defined('_JEXEC') or die('Restricted access');
?>

<style type="text/css">
<!--
div#easytagcloud<?php echo $moduleclass_sfx ?> a:link {
	text-decoration: <?= $easytagcloud_params->show_underline; ?>;
}

div#easytagcloud<?php echo $moduleclass_sfx ?> a:hover {
	text-decoration: <?= $easytagcloud_params->hover_show_underline; ?>;
}

div#easytagcloud<?php echo $moduleclass_sfx ?> a {
    color: <?= $easytagcloud_params->color; ?>;
}


-->
</style>
<div id="easytagcloud<?php echo $moduleclass_sfx ?>" style="text-align:justify;">
<?php
 foreach($easytagcloud_params->tagsarray as $key=>$value) 
  {    
   $app =& JFactory::getApplication();
   if($value==1)
     {
     $tip=Jtext::_('MOD_EASYTAGCLOUD_RELATED_ARTICLE');
	 }else 
	    {
		  $tip=Jtext::_('MOD_EASYTAGCLOUD_RELATED_ARTICLES');
		}
		
     $sef_rewrite=$app->getCfg('sef_rewrite')==0?'index.php/':'';     
     if($app->getCfg('sef')==0)	
	   {        
	    $searchphrase="<a href='".JURI::base()."index.php?option=com_search&amp;Itemid=1&amp;searchword=".urlencode($key)."&amp;submit=Search&amp;searchphrase=exact&amp;ordering=newest'  style='font-size:".$easytagcloud_params->tagsstyle[$key]."em' title='".$value." $tip' target='_blank'>".$key."</a>";   
	    }
	    else if($app->getCfg('sef')==1&&$app->getCfg('sef_suffix')==0)	
		       {   
			    $searchphrase="<a href='".JURI::base().$sef_rewrite."component/search/".urlencode($key)."?searchphrase=exact&amp;ordering=newest'  style='font-size:".$easytagcloud_params->tagsstyle[$key]."em' title='".$value." $tip' target='_blank'>".$key."</a>";    }	
			    else if($app->getCfg('sef')==1&&$app->getCfg('sef_suffix')==1)	
				       {  
					    $searchphrase="<a href='".JURI::base().$sef_rewrite."component/search/".urlencode($key).".html?searchphrase=exact&amp;ordering=newest'  style='font-size:".$easytagcloud_params->tagsstyle[$key]."em' title='".$value." $tip' target='_blank'>".$key."</a>";   
					    }	
   echo $searchphrase;
   echo " "; 
  } 
 ?>
</div>
