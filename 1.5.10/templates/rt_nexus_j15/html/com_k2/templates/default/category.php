<?php
/*
// "K2" Component by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
// Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
// Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
// More info at http://www.joomlaworks.gr
// Designed and developed by the JoomlaWorks team
// *** Last update: June 20th, 2009 ***
*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

?>

<div id="k2Container" class="itemListView <?php echo $this->params->get('pageclass_sfx')?>">

	<?php if ($this->params->get('catFeedLink')):?>
		<!-- RSS feed -->
		<div id="itemListRssFeedBlock">
		<a href="<?php echo $this->feed ;?>">
			<img src="<?php echo JURI::root();?>components/com_k2/images/system/feed-icon-14x14.gif" alt="<?php echo JText::_('Subscribe to this RSS feed'); ?>" title="<?php echo JText::_('Subscribe to this RSS feed'); ?>" />
		</a>
		</div>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_page_title', 1)) : ?>
		<!-- Page title -->
		<h1 class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>
	<?php endif; ?>
	<?php if (isset($this->category)):?>
		<!-- Category -->
		<div class="yellowbox-bl"><div class="yellowbox-br"><div class="yellowbox-tl"><div class="yellowbox-tr">
			<div class="center">
				<div class="itemListCategoryBlock">
					<?php if ($this->params->get('catImage')):?>
						<!-- Category image -->
						<a class="itemListCategoryImage" href="<?php echo $this->category->link;?>"><img alt="<?php echo $this->category->name;?>" src="<?php echo JURI::root().'media/k2/categories/'.$this->category->image;?>"/></a>
					<?php endif; ?>
			
					<?php if ($this->params->get('catTitle')):?>
						<!-- Category title -->
						<h2 class="itemListCategoryTitle"><?php echo $this->category->name;?> <?php if ($this->params->get('catTitleItemCounter')) echo '('.$this->pagination->total.')';?></h2>
					<?php endif; ?>
		
					<?php if ($this->params->get('catDescription')):?>
						<!-- Category description -->
						<p><?php echo $this->category->description;?></p>
					<?php endif; ?>
		
					<?php echo $this->category->event->K2CategoryDisplay; ?>
			
					<div class="clr"></div>
			
				<?php if ($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)):?>
					<!-- Subcategories -->
					<div class="itemListSubCategoriesBlock">
						<h3><?php echo JText::_('Sub-categories');?></h3>
						<?php $counter=1; foreach($this->subCategories as $subCategory):?>
				
							<div style="float:left;width:<?php echo number_format(100/$this->params->get('subCatColumns'), 1); ?>%;">
					
								<?php if($this->params->get('subCatImage')):?>
								<!-- Subcategory image -->
								<a class="itemListCategoryImage" href="<?php echo $subCategory->link;?>"><img alt="<?php echo $subCategory->name;?>" src="<?php echo JURI::root().'media/k2/categories/'.$subCategory->image;?>"/></a>
								<?php endif; ?>
					
								<?php if($this->params->get('subCatTitle')):?>
								<!-- Subcategory title -->
								<h2 class="itemListCategoryTitle"><?php echo $subCategory->name;?> <?php if ($this->params->get('subCatTitleItemCounter')) echo '('.$subCategory->numOfItems.')';?></h2>
								<?php endif; ?>
						
								<?php if($this->params->get('subCatDescription')):?>
								<!-- Subcategory description -->
								<p><?php echo $subCategory->description;?></p>
								<?php endif; ?>
						
							</div>
					
							 <?php if ($counter%($this->params->get('subCatColumns'))==0) : ?>
					    		<div class="clr"></div>
					    	<?php endif; ?>
					
						<?php $counter++; endforeach; ?>

						<div class="clr"></div>

					</div>
			
				<?php endif; ?>
				</div>
			</div>
		</div></div></div></div>
		<?php if((isset($this->leadings) && count($this->leadings)) || (isset($this->primary) && count($this->primary)) || (isset($this->secondary) && count($this->secondary)) || (isset($this->links) && count($this->links))): ?>
		<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
		<div class="k2-break-div"></div>
		<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
		<?php endif; ?>
	<?php endif; ?>
	
	<!-- Items -->
	<div class="itemList">
		<?php if(isset($this->leadings) && count($this->leadings)): ?>
			<!-- Leading Items -->
			<?php $this->isGroup = 'leading'; ?>
			<div id="itemsListLeading">
				<?php $counter=1; foreach ($this->leadings as $item) :?>
					<div style="float:left;width:<?php echo number_format(100/$this->params->get('num_leading_columns'), 1); ?>%;" class="itemContainerWrapper">
					<?php 
						$this->item=$item;
						echo $this->loadTemplate('item');
					?>
				    </div>
				    <?php if ($counter%($this->params->get('num_leading_columns'))==0) : ?>
				    <div class="clr"></div>
				    <?php endif; ?>
				<?php $counter++; endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php if((isset($this->primary) && count($this->primary)) || (isset($this->secondary) && count($this->secondary)) || (isset($this->links) && count($this->links))): ?>
			<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
			<div class="k2-break-div"></div>
			<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(isset($this->primary) && count($this->primary)): ?>
			<!-- Primary Items -->
			<?php $this->isGroup = 'primary'; ?>
			<div id="itemsListPrimary">
				<?php $counter=1; foreach ($this->primary as $item) :?>
					<div style="float:left;width:<?php echo number_format(100/$this->params->get('num_primary_columns'), 1); ?>%;" class="itemContainerWrapper">
					<?php 
						$this->item=$item;
						echo $this->loadTemplate('item');
					?>
				    </div>
				    <?php if ($counter%($this->params->get('num_primary_columns'))==0) : ?>
				    <div class="clr"></div>
				    <?php endif; ?>
				<?php $counter++; endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php if((isset($this->secondary) && count($this->secondary)) || (isset($this->links) && count($this->links))): ?>
			<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
			<div class="k2-break-div"></div>
			<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
			<?php endif;?>
		<?php endif; ?>
		
		<?php if(isset($this->secondary) && count($this->secondary)): ?>
			<!-- Secondary Items -->
			<?php $this->isGroup = 'secondary'; ?>
			<div id="itemsListSecondary">
				<?php $counter=1; foreach ($this->secondary as $item) :?>
					<div style="float:left;width:<?php echo number_format(100/$this->params->get('num_secondary_columns'), 1); ?>%;" class="itemContainerWrapper">
					<?php 
						$this->item=$item;
						echo $this->loadTemplate('item');
					?>
				    </div>
				    <?php if ($counter%($this->params->get('num_secondary_columns'))==0) : ?>
				    <div class="clr"></div>
				    <?php endif; ?>
				<?php $counter++; endforeach; ?>
				<div class="clr"></div>
			</div>
			<?php if(isset($this->links) && count($this->links)): ?>
			<div class="k2-break1"><div class="k2-break2"></div><div class="k2-break3"></div></div>
			<div class="k2-break-div"></div>
			<div class="k2-break4"><div class="k2-break5"></div><div class="k2-break6"></div></div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(isset($this->links) && count($this->links)): ?>
			<!-- Link Items -->
			<?php $this->isGroup = 'links'; ?>
			<div id="itemsListLinks">
				<?php $counter=1; foreach ($this->links as $item) :?>
					<div style="float:left;width:<?php echo number_format(100/$this->params->get('num_links_columns'), 1); ?>%;" class="itemContainerWrapper">
					<?php 
						$this->item=$item;
						echo $this->loadTemplate('item');
					?>
				    </div>
				    <?php if ($counter%($this->params->get('num_links_columns'))==0) : ?>
				    <div class="clr"></div>
				    <?php endif; ?>
				<?php $counter++; endforeach; ?>
				<div class="clr"></div>
			</div>
		<?php endif; ?>
		
	</div>
	
	<div>
		<?php if ($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<?php if ($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
	</div>
</div>
