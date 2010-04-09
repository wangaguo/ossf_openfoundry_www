<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post">

	<div class="search<?php echo $moduleclass_sfx; ?>">
	<input type="text" id="mod_mt_search_searchword" name="searchword" maxlength="20" class="inputbox" size="<?php echo $width; ?>" value="<?php echo $text; ?>"  onblur="if(this.value=='') this.value='<?php echo $text; ?>';" onfocus="if(this.value=='<?php echo $text; ?>') this.value='';" />
	<?php if( $lists['categories'] ) { ?>
	<br /><?php echo $lists['categories'];
	} ?>
	
	<?php if ( $search_button ) { ?>
		<br /><input type="submit" value="<?php echo JText::_( 'Search' ) ?>" class="button" />
	<?php } ?>

	<?php if ( $advsearch ) { ?>
		<br /><a href="<?php echo $advsearch_link; ?>"><?php echo JText::_( 'Advanced search' ) ?></a>
	<?php } ?>

	</div>
	<input type="hidden" name="task" value="search" />
	<input type="hidden" name="option" value="com_mtree" />
</form>