<?php // @version $Id: default_links.php 9781 2007-12-31 11:13:48Z mtk $
defined('_JEXEC') or die('Restricted access');
?>

<h1 class="componentheading">
	<span class="bg"><span class="bg2">
	<?php echo JText::_('More Articles...'); ?>
	</span></span>
</h1>

<ul>
	<?php foreach ($this->links as $link) : ?>
	<li>
		<a class="blogsection" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($link->slug, $link->catslug, $link->sectionid)); ?>">
			<?php echo $link->title; ?></a>
	</li>
	<?php endforeach; ?>
</ul>
