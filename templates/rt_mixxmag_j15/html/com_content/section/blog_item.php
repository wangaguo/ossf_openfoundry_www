<?php // @version $Id: blog_item.php 11215 2008-10-26 02:25:51Z ian $
defined('_JEXEC') or die('Restricted access');
global $mainframe;
jimport('joomla.filesystem.file');
$tparams = new JParameter(JFile::read(JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.'params.ini'));
$show_collapse = $tparams->get('showCollapse');
$show_tools = $tparams->get('showTools');
?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
<div class="contentpaneopen_edit<?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
</div>
<?php endif; ?>

<div class="blog-item <?php echo "rokmodtools-blog-".$this->item->id; ?>">
<div class="blog-item-bg">
<?php if ($this->item->params->get('show_title')) : ?>
<div class="content-header"><div class="content-tools">
	<?php if ($show_collapse != '0'): ?>
		<div class="close-handle"></div>
	<?php endif; ?>
	<?php if ($show_tools != '0'): ?>
		<div class="tools-handle"></div>
	<?php endif; ?>
<h2 class="contentheading<?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
		<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->item->params->get('pageclass_sfx'); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
	<?php else :
		echo $this->escape($this->item->title);
	endif; ?>
</h2>
</div></div>
<?php endif; ?>

<?php if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<div class="article-extras"><!-- IE6FIX --><?php if ((!empty ($this->item->modified) && $this->item->params->get('show_modify_date')) || ($this->item->params->get('show_author') && ($this->item->author != "")) || ($this->item->params->get('show_create_date'))) : ?><div class="iteminfo">
	<?php if (!empty ($this->item->modified) && $this->item->params->get('show_modify_date')) : ?>
	<span class="modifydate">
		<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</span>
	<?php endif; ?>

	<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
	<span class="createdby">
		<?php JText::printf('Written by', ($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author)); ?>
	</span>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_create_date')) : ?>
	<span class="createdate">
		<?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')); ?>
	</span>
	<?php endif; ?>
</div><?php endif; ?><?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?><div class="pageinfo">
       <?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
        <span>
            <?php if ($this->item->params->get('link_section')) : ?>
                <?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
            <?php endif; ?>
            <?php echo $this->item->section; ?>
            <?php if ($this->item->params->get('link_section')) : ?>
                <?php echo '</a>'; ?>
            <?php endif; ?>
                <?php if ($this->item->params->get('show_category')) : ?>
                <?php echo ' - '; ?>
            <?php endif; ?>
        </span>
        <?php endif; ?>
        <?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
        <span>
            <?php if ($this->item->params->get('link_category')) : ?>
                <?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
            <?php endif; ?>
            <?php echo $this->item->category; ?>
            <?php if ($this->item->params->get('link_category')) : ?>
                <?php echo '</a>'; ?>
            <?php endif; ?>
        </span>
        <?php endif; ?>
</div><?php endif; ?><?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?><div class="buttonheading">
	<img src="<?php echo $this->baseurl ?>/templates/<? echo $mainframe->getTemplate(); ?>/images/blank.gif" alt="<?php echo JText::_('attention open in a new window'); ?>" />
	<?php if ($this->item->params->get('show_pdf_icon')) :
		echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access);
	endif;
	if ($this->item->params->get('show_print_icon')) :
		echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access);
	endif;
	if ($this->item->params->get('show_email_icon')) :
		echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access);
	endif; ?>
</div><?php endif; ?><?php if ($this->item->params->get('readmore') && $this->item->readmore) : ?><div class="readon-tab-block">
<div class="readon-tab"><div class="readon-tab2"><div class="readon-tab3">
<a href="<?php echo $this->item->readmore_link; ?>" class="readon<?php echo $this->item->params->get('pageclass_sfx'); ?>">
	<?php if ($this->item->readmore_register) : ?>
		<?php echo JText::_('Register to read more...'); ?>
	<?php elseif ($readmore = $this->item->params->get('readmore')) : ?>
		<span class="readon-tab-text"><?php echo $readmore; ?></span>
	<?php endif; ?></a>
</div></div></div>
</div><?php endif; ?><?php echo $this->item->event->beforeDisplayContent; ?><?php if ($this->item->params->get('show_url') && $this->item->urls) : ?><span class="small">
	<a href="<?php echo $this->item->urls; ?>" target="_blank">
		<?php echo $this->item->urls; ?></a>
</span><?php endif; ?></div>

<div class="content-padding">
<?php if (isset ($this->item->toc)) :
	echo $this->item->toc;
endif; ?>

<?php echo JFilterOutput::ampReplace($this->item->text); ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
<p>
	<a href="<?php echo $this->item->readmore_link; ?>" class="readon<?php echo $this->item->params->get('pageclass_sfx'); ?>">
		<span class="readon-full">
		<?php if ($this->item->readmore_register) :
			echo JText::_('Register to read more...');
		else :
			echo JText::sprintf('Read more', $this->item->title);
		endif; ?></span></a>
</p>
<?php endif; ?>
</div>
</div>
<div class="content-bottom"><div class="content-bottom2"><div class="content-bottom3"></div></div></div>
</div>

<?php echo $this->item->event->afterDisplayContent;
