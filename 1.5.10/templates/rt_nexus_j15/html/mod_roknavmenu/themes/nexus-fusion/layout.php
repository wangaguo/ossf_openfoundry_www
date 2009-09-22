<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
define('FUSION_TEMPLATE','rt_nexus_j15');

class FusionScriptLoader { 
	function loadScripts(&$menu)
	{
		$enablejs = $menu->getParameter('roknavmenu_fusion_enable_js', '1');
		$subsoffset_top = $menu->getParameter('roknavmenu_fusion_subsoffset_top', '0');
		$subsoffset_left = $menu->getParameter('roknavmenu_fusion_subsoffset_left', '0');
		$negativeoffset_top = $menu->getParameter('roknavmenu_fusion_negativeoffset_top', '0');
		$negativeoffset_left = $menu->getParameter('roknavmenu_fusion_negativeoffset_left', '0');
		$vertical_animation = $menu->getParameter('roknavmenu_fusion_vertical_animation','Quad.easeOut');
		$vertical_duration = $menu->getParameter('roknavmenu_fusion_vertical_duration','400');
		$horizontal_animation = $menu->getParameter('roknavmenu_fusion_horizontal_animation','Quad.easeOut');
		$horizontal_duration = $menu->getParameter('roknavmenu_fusion_horizontal_duration','400');
		
		$doc = &JFactory::getDocument();
		
		JHTML::_('behavior.mootools');
		if (FusionScriptLoader::isIe(6)) {
            $doc->addScript(JURI::Root(true).'/modules/mod_roknavmenu/themes/fusion/js/sfhover.js');
	    }
	    if ($enablejs) {
	        $doc->addScript(JURI::Root(true).'/modules/mod_roknavmenu/themes/fusion/js/fusion.js');
	        $initialization = "
	        window.addEvent('domready', function() {
            	new Fusion('horizmenu-surround', {
            		pill: false,
            		slide: {
            			'vertical': {
            				duration: ".$vertical_duration.",
            				transition: Fx.Transitions.".$vertical_animation."
            			},
            			'horizontal': {
            				duration: ".$horizontal_duration.",
            				transition: Fx.Transitions.".$horizontal_animation."
            			}
            		},
            		subsOffset: {
            			'top': ".$subsoffset_top.",
            			'left': ".$subsoffset_left."
            		},
        			negativeOffsets: {
        				'top': ".$negativeoffset_top.",
        				'left': ".$negativeoffset_left."
        			},
            		timeout: 0,
            		zIndex: 500
            	});
            });";
            $doc->addScriptDeclaration($initialization);
        }
	}
	
	function isIe($version = false) {   
    	$agent=$_SERVER['HTTP_USER_AGENT'];  
    	$found = strpos($agent,'MSIE ');  
    	if ($found) { 
    	        if ($version) {
    	            $ieversion = substr(substr($agent,$found+5),0,1);   
    	            if ($ieversion == $version) return true;
    	            else return false;
    	        } else {
    	            return true;
    	        }

            } else {
                    return false;
            }
    	if (stristr($agent, 'msie'.$ieversion)) return true;
    	return false;        
    }
}

FusionScriptLoader::loadScripts($menu);

global $activeid;
$activeid = $menu->getParameter('roknavmenu_fusion_enable_current_id',0) == 0 ? false : true;

?>
<?php
if ( ! defined('modRokNavMenuShowItems') )
{
function showItem(&$item, &$menu) {
    
	global $activeid;
    
   $doc = &JFactory::getDocument();
   
    //get columns count for children
    $columns = $item->getParameter('fusion_columns',1);
    //get custom image
    $custom_image = $item->getParameter('fusion_customimage');
    if ($custom_image && $custom_image != -1) $item->addLinkClass('image');
    else $item->addLinkClass('bullet');

    //not so elegant solution to add subtext
    $item->subtext = $item->getParameter('fusion_item_subtext','');
    if ($item->subtext=='') $item->subtext = false;
    else $item->addLinkClass('subtext');
?>
<li <?php if($item->hasListItemClasses()) : ?>class="<?php echo $item->getListItemClasses()?>"<?php endif;?> <?php if(isset($item->css_id) && $activeid):?>id="<?php echo $item->css_id;?>"<?php endif;?>>
	<?php if ($item->type == 'menuitem') : ?>
		<a <?php if($item->hasLinkClasses()):?>class="<?php echo $item->getLinkClasses();?>"<?php endif;?> <?php if(isset($item->link)):?>href="<?php echo $item->link;?>"<?php endif;?> <?php if(isset($item->target)):?>target="<?php echo $item->target;?>"<?php endif;?> <?php if(isset($item->onclick)):?>onclick="<?php echo $item->onclick;?>"<?php endif;?><?php if($item->hasLinkAttribs()):?> <?php echo $item->getLinkAttribs();?><?php endif;?>>
			<span>
		    <?php if ($custom_image && $custom_image != -1) :?>
		        <img src="<?php echo $doc->baseurl."/templates/".FUSION_TEMPLATE."/images/menus/".$custom_image; ?>" alt="<?php echo $custom_image; ?>" />
		    <?php endif; ?>
			<?php echo $item->title;?>
			<?php if (isset($item->subtext)) :?>
			<em><?php echo $item->subtext; ?></em>    
			<?php endif; ?>    
			</span>
		</a>
	<?php elseif($item->type == 'separator') : ?>
		<span <?php if($item->hasLinkClasses()):?>class="<?php echo $item->getLinkClasses();?> nolink"<?php endif;?>>
		    <span>
		        <?php if ($custom_image && $custom_image != -1) :?>
    		        <img src="<?php echo $doc->baseurl."/templates/".FUSION_TEMPLATE."/images/menus/".$custom_image; ?>" alt="<?php echo $custom_image; ?>" />
    		    <?php endif; ?>
		    <?php echo $item->title;?>
		    <?php if (isset($item->subtext)) :?>
			<em><?php echo $item->subtext; ?></em>    
			<?php endif; ?>
		    </span>
		</span>
	<?php endif; ?>
	<?php if ($item->hasChildren()): ?>
	<ul class="level<?php echo intval($item->level)+2; ?><?php if ($columns > 1) echo ' columns'.$columns; ?>">
		<?php foreach ($item->getChildren() as $child) : ?>			
			<?php showItem($child, $menu); ?>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	
</li>	
<?php
} 
define('modRokNavMenuShowItems', true);
}
?>
<ul class="menutop level1" <?php if($menu->getParameter('tag_id') != null):?>id="<?php echo $menu->getParameter('tag_id');?>"<?php endif;?>>
	<?php foreach ($menu->getChildren() as $item) :  ?>
		<?php showItem($item, $menu); ?>
	<?php endforeach; ?>
</ul>
