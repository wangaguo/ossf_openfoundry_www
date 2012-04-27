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
<div id="easytagcloud<?php echo $moduleclass_sfx ?>" >
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
	 $itemid= $params->get('Itemid');
	 $ordering= $params->get('ordering');

     $sef_rewrite=$app->getCfg('sef_rewrite')==0?'index.php/':'';     
	    $searchphrase="<a href='".JURI::base()."index.php?option=com_search&Itemid=$itemid&searchphrase=exact_meta&ordering=$ordering&searchword=".$key."'  style='font-size:".$easytagcloud_params->tagsstyle[$key]."em' title='".$value." $tip' >".$key."</a>";   
	 echo $searchphrase;
   echo " "; 
  } 


 ?>
</div>
