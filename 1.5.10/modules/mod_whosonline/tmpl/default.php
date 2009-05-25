<?php // no direct access
defined('_JEXEC') or die('Restricted access');

if ($showmode == 0 || $showmode == 2) :
    if ($count['guest'] != 0 || $count['user'] != 0) :
        echo JText::_('We have') . '&nbsp;';
		if ($count['guest'] == 1) :
		    echo JText::sprintf('guest', '1');
		else :
		    if ($count['guest'] > 1) :
			    echo JText::sprintf('guests', $count['guest']);
			endif;
		endif;

		if ($count['guest'] != 0 && $count['user'] != 0) :
		    echo '&nbsp;' . JText::_('and') . '&nbsp;';
	    endif;

		if ($count['user'] == 1) :
		    echo JText::sprintf('member', '1');
		else :
		    if ($count['user'] > 1) :
			    echo JText::sprintf('members', $count['user']);
			endif;
		endif;
		echo '&nbsp;' . JText::_('online');
    endif;
endif;

if(($showmode > 0) && count($names)) : ?>
    <ul>
<?php foreach($names as $name) : ?>
	    <!--<li><strong><a href="index.php?option=com_comprofiler&amp;task=userProfile&amp;user=<?php //echo $name->id;?>" class="mod_login"><?php //echo $name->username; ?></a></strong></li>Modify by ally-->
	    <li><strong><a href="<?php echo JRoute::_( 'people/userprofile/'.$name->username.'.html'); ?>" class="mod_login"><?php echo $name->username; ?></a></strong></li><!--Modify by ally-->
<?php endforeach;  ?>
	</ul>
<?php endif;
