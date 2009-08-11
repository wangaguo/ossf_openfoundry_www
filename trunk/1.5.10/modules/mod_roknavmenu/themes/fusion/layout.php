<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class FustionScriptLoader { 
	function loadScripts($menu)
	{
		$enablejs = $menu->getParameter('roknavmenu_fusion_enable_js', '1');
		$subsoffset_top = $menu->getParameter('roknavmenu_fusion_subsoffset_top', '32');
		$subsoffset_left = $menu->getParameter('roknavmenu_fusion_subsoffset_left', '177');
		$negativeoffset_top = $menu->getParameter('roknavmenu_fusion_negativeoffset_top', '0');
		$negativeoffset_left = $menu->getParameter('roknavmenu_fusion_negativeoffset_left', '0');
		$vertical_animation = $menu->getParameter('roknavmenu_fusion_vertical_animation','Quad.easeOut');
		$vertical_duration = $menu->getParameter('roknavmenu_fusion_vertical_duration','400');
		$horizontal_animation = $menu->getParameter('roknavmenu_fusion_horizontal_animation','Quad.easeOut');
		$horizontal_duration = $menu->getParameter('roknavmenu_fusion_horizontal_duration','400');
		
		$doc = &JFactory::getDocument();
		
		JHTML::_('behavior.mootools');
		if (FustionScriptLoader::isIe(6)) {
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
global $activeid;

FustionScriptLoader::loadScripts(&$menu);

$theme      = $menu->getParameter('roknavmenu_fusion_theme', 'light');
$loadcss    = $menu->getParameter('roknavmenu_fusion_load_css', 1) == 1 ? true : false;
$activeid   = $menu->getParameter('roknavmenu_fusion_enable_current_id',0) == 0 ? false : true;

$doc =& JFactory::getDocument();
if ($loadcss)  {
    $doc->addStyleSheet(JURI::Root(true)."/modules/mod_roknavmenu/themes/fusion/css/fusion.css");
}
?>
<?php
if ( ! defined('modRokNavMenuShowItems') )
{
function showItem(&$item, &$menu) {
    global $activeid;
?>
<li <?php if($item->hasListItemClasses()) : ?>class="<?php echo $item->getListItemClasses();?>"<?php endif;?> <?php if(isset($item->css_id) && $activeid):?>id="<?php echo $item->css_id;?>"<?php endif;?>>
	<?php if ($item->type == 'menuitem') : ?>
		<a <?php if($item->hasLinkClasses()):?>class="<?php echo $item->getLinkClasses();?>"<?php endif;?> <?php if(isset($item->link)):?>href="<?php echo $item->link;?>"<?php endif;?> <?php if(isset($item->target)):?>target="<?php echo $item->target;?>"<?php endif;?> <?php if(isset($item->onclick)):?>onclick="<?php echo $item->onclick;?>"<?php endif;?><?php if($item->hasLinkAttribs()):?> <?php echo $item->getLinkAttribs();?><?php endif;?>>
			<?php if (isset($item->image)):?><img alt="<?php echo $item->alias;?>" src="<?php echo $item->image;?>"/><?php endif; ?>
			<span><?php echo $item->title;?></span>
		</a>
	<?php elseif($item->type == 'separator') : ?>
		<span <?php if($item->hasLinkClasses()):?>class="<?php echo $item->getLinkClasses();?> nolink"<?php endif;?>>
		    <span><?php echo $item->title;?></span>
		</span>
	<?php endif; ?>
	<?php if ($item->hasChildren()): ?>
	<ul class="level<?php echo intval($item->level)+2; ?>">
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
<div id="horizmenu-surround">
    <ul class="menutop level1" <?php if($menu->getParameter('tag_id') != null):?>id="<?php echo $menu->getParameter('tag_id');?>"<?php endif;?>>
    	<?php foreach ($menu->getChildren() as $item) :  ?>
    		<?php showItem($item, $menu); ?>
    	<?php endforeach; ?>
    </ul>
</div>
