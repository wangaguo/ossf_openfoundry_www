<?php 
/**
 * RokStories Module
 *
 * @package		Joomla
 * @subpackage	RokStories Module
 * @copyright Copyright (C) 2009 RocketTheme. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see RT-LICENSE.php
 * @author RocketTheme, LLC
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$layout = $params->get("layout_type", 'layout1');
$content_position = $params->get("content_position", 'right');
$image_pad = '';
$content_pad = '';
if ($content_position == 'right') $image_pad = ' feature-pad';
if ($content_position == 'left') $content_pad = ' feature-pad';
?>

<script type="text/javascript">
<?php foreach ($list as $item): ?>
    RokStoriesImage.push('<?php echo $item->image; ?>');
	<?php if ($params->get('link_images', 0) == 1): ?>
	RokStoriesLinks.push('<?php echo $item->link; ?>');
	<?php endif; ?>
<?php endforeach; ?>
</script>
<div class="rokstories-<?php echo $layout; ?>">
	<div class="feature-block">
		<div class="image-container<?php echo $image_pad; ?>" style="float: <?php echo $content_position; ?>">
			<div class="image-full"></div>
			<div class="image-small">
			    <?php foreach ($list as $item): ?>
			    <img src="<?php echo $item->thumb; ?>" class="feature-sub" alt="image" />
				<?php endforeach; ?>
			</div>
			<?php if ($layout == 'layout2'): ?>
				<div class="feature-block-tl"></div>
				<div class="feature-block-tr"></div>
				<div class="feature-block-bl"></div>
				<div class="feature-block-br"></div>
				<div class="feature-arrow-r"></div>
				<div class="feature-arrow-l"></div>
				
				<div class="labels-title">
					<?php foreach ($list as $item): ?>
						<?php if ($params->get("show_label_article_title",1)==1): ?>
						<div class="feature-block-title">
							<div class="feature-block-title2"></div>
							<div class="feature-block-title3">
								<?php if ($params->get("link_labels", 0) == 1): ?>
									<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
								<?php else: ?>
									<?php echo $item->title; ?>
								<?php endif; ?>
							</div>
						</div>
						<?php endif;?>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
		</div>
		<div class="desc-container">
		    <?php foreach ($list as $item): ?>
	        
			<div class="description<?php echo $content_pad; ?>">
				<?php if ($params->get("show_article_title",1)==1): ?>
					<span class="feature-title"><?php echo $item->title; ?></span>
				<?php endif;?>
				<?php if ($params->get("show_created_date",0)==1): ?>
				    <span class="created-date"><?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC2')); ?></span>
				<?php endif;?>
			
				<?php if ($params->get("show_article",1)==1): ?>
					<span class="feature-desc"><?php echo $item->introtext; ?></span>
				<?php endif; ?>
		    
				<?php if ($params->get("show_article_link",1)==1): ?>
					<div class="clr"></div><div class="readon-wrap1"><div class="readon1-l"></div><a href="<?php echo $item->link; ?>" class="readon-main"><span class="readon1-m"><span class="readon1-r"><?php echo $params->get("readon_text","Read the Full Story"); ?></span></span></a></div><div class="clr"></div>
				<?php endif; ?>
			</div>
	        <?php endforeach; ?>
		</div>
	</div>
</div>