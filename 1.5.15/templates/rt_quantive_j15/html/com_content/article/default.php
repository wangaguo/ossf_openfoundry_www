<?php
/**
 * @package   Quantive Template - RocketTheme
 * @version   1.5.0 March 31, 2010
 * @author    YOOtheme http://www.yootheme.com & RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * These template overrides are based on the fantastic GNU/GPLv2 overrides created by YOOtheme (http://www.yootheme.com)
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
include_once(dirname(__FILE__).DS.'..'.DS.'icon.php');

$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'publish', 'content', 'own'));
?>

<div class="rt-joomla <?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<div class="rt-article">
		<?php /** Begin Page Title **/ if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
		<h1 class="rt-pagetitle">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>
		<?php /** End Page Title **/ endif; ?>

		<?php /** Begin Article Title **/ if ($this->params->get('show_title')) : ?>
		<div class="rt-headline"><?php if ($this->params->get('show_title')) : ?><h1 class="rt-article-title"><?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?><?php echo $this->escape($this->article->title); ?><?php else : ?><?php echo $this->escape($this->article->title); ?><?php endif; ?></h1><?php endif; ?>
		</div>
		<div class="clear"></div>
		<?php /** End Article Title **/ endif; ?>

		<?php  if (!$this->params->get('show_intro')) :
			echo $this->article->event->afterDisplayTitle;
		endif; ?>

		<?php echo $this->article->event->beforeDisplayContent; ?>

		<?php if ($canEdit || (intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) || ($this->params->get('show_author') && ($this->article->author != "")) || ($this->params->get('show_create_date')) || ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon'))) : ?>
		<div class="rt-articleinfo">
			<?php /** Begin Article Icons **/ if ($canEdit || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
			<div class="rt-article-icons">
				<?php if ($this->print) :
					echo RokIcon::print_screen($this->article, $this->params, $this->access);
				elseif ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
				<?php if ($this->params->get('show_pdf_icon')) :
					echo RokIcon::pdf($this->article, $this->params, $this->access);
				endif;
				if ($this->params->get('show_print_icon')) :
					echo RokIcon::print_popup($this->article, $this->params, $this->access);
				endif;
				if ($this->params->get('show_email_icon')) :
					echo RokIcon::email($this->article, $this->params, $this->access);
				endif;
				endif; ?>
				<?php if (!$this->print) : ?>
					<?php if ($canEdit) : ?>
					<span class="icon edit">
						<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
					</span>
					<?php endif; ?>
				<?php else : ?>
					<span class="icon printscreen">
						<?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
					</span>
				<?php endif; ?>
			</div>
			<?php /** End Article Icons **/ endif; ?>

			<?php /** Begin Created Date **/ if ($this->params->get('show_create_date')) : ?>
			<span class="rt-date-posted">
				<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?>
			</span>
			<?php /** End Created Date **/ endif; ?>

			<?php /** Begin Modified Date **/ if (intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
			<span class="rt-date-modified">
				<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>
			</span>
			<?php /** End Modified Date **/ endif; ?>

			<?php /** Begin Author **/ if ($this->params->get('show_author') && ($this->article->author != "")) : ?>
			<span class="rt-author">
				<?php JText::printf( 'Written by', ($this->escape($this->article->created_by_alias) ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author)) ); ?>
			</span>
			<?php /** End Author **/endif; ?>
	
			<?php /** Begin Url **/ if ($this->params->get('show_url') && $this->article->urls) : ?>
			<span class="rt-url">
				<a href="http://<?php echo $this->article->urls ; ?>" target="_blank"><?php echo $this->escape($this->article->urls); ?></a>
			</span>
			<?php /** End Url **/ endif; ?>
		</div>
		<?php endif; ?>

		<?php if (isset ($this->article->toc)) : ?>
			<?php echo $this->article->toc; ?>
		<?php endif; ?>

		<?php echo $this->article->text; ?>

			<!-- Show relate article -->
		<?php
				if ($this->article->sectionid ==20){  // sectionid 20 is OSSFNewsletter section ID
					$today = date("Y-m-d G:i:s"); // Some article setting open in some times 
					$matchKey= mb_substr($this->article->title,0,8);
					$matchdb = JFactory::getDBO();
					$mcquery = 'select a.id,a.title,a.catid,b.alias from #__content as a, #__categories as b  '
									.'where a.title like "%'.$matchKey.'%" and a.catid=b.id '
									.' and a.state =1 '
									.' and a.publish_up < "'.$today.'"';
					$matchdb->setQuery($mcquery);
					$mc_data	= $matchdb->loadAssocList();
					$mcNUM=count ($mc_data);
					if ($mcNUM > 1){
					echo "<br><br><h4>".JText::_('YOU MIGHT INTERESTED').":</h4><ul>";
					foreach ($mc_data as $mcrow){
									if ($mcrow[title] !=$this->article->title){
													if ($mcrow[alias]!=''){ //make sure all the categories have alias and we ues this to show URL
																	echo  "<li><a href='/".$mcrow[alias]."/".$mcrow[id]."'>".$mcrow[title]."</a></li>";
													}
									}
					}
					echo "</ul>";
					}
				}
		?>
		<!-- end -->
		<div class="article_note">
		<!-- Add tags use metakey, and show OSSF Newsletter tag: OSSFNL+NUM-->
		<?php 
				$getNL	=	strpos($this->article->metakey,'OSSFNL');// Use Letterman to inclould OSSFNL tag in those Newsletter article metakey
				$getNLNUM=substr($this->article->metakey,$getNL,9);// OSSFNL + three number the number is the letterman ID
				$tags = explode(",",$this->article->metakey);
				if($this->article->category!=''){
							echo "<br><br> <hr style='border: 1px dashed #D2DADB;'>";
				}
             $getNLID=substr($getNLNUM,6,3);// get the letterman newsletter ID
             $NLdb = JFactory::getDBO();
             $query = 'SELECT * '
                 .' FROM #__letterman'
                 .' WHERE id = '.$getNLID; 
             $NLdb->setQuery($query);
             $NL_data = $NLdb->loadObject();
             if ($NL_data->published!=0){
             echo "<b>".JText::_('OSSFNL')."&nbsp;:</b>&nbsp;<a href='/previous-issue?task=view&id=$getNLID'>".$NL_data->subject."</a><br>";}

				if ($this->article->metakey!='' ){
								if ($this->article->metakey!=$getNLNUM){
												echo "<b>".JText::_('TAGS').":</b>&nbsp;"; 
								}
				$numtags= count($tags)-1;

								foreach($tags as $index=> $key){
												$getNL = strpos($key,'OSSFNL');
												if ($getNL===false){
														$searchphrase="<a href='".JURI::base()."index.php?option=com_search&Itemid=58".
																							"&amp;searchphrase=exact_meta&amp;ordering=newest&searchword=".$key."'>".$key."</a>";
														echo $searchphrase;
							
														if($index!=$numtags ){
															echo ",&nbsp;&nbsp;";				
														}
												}
				}
		?>
		<?php
		}
		?>
		<!-- End -->
		<?php if ($this->article->category!=''){ ?>
			<br>
					<?php echo '<b>'.JText::_('CATEGORY').': </b><a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
				<?php echo $this->escape($this->article->category); ?>
					<?php echo '</a>';
				}
					 ?>
				</div>
			 <!-- AddThis Button BEGIN ID 3001 is the front page article -->
     <?php if ($this->article->id !=3001):?>
			<br><br>
       <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
       <a class="addthis_button_preferred_1"></a>
       <a class="addthis_button_preferred_2"></a>
       <a class="addthis_button_preferred_3"></a>
       <a class="addthis_button_preferred_4"></a>
       <a class="addthis_button_compact"></a>
       <a class="addthis_counter addthis_bubble_style"></a>
       </div>
       <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
       <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=openfoundry"></script>
       <!-- AddThis Button END -->
     <br>
     <?php endif; ?>
       <!-- AddThis Button END -->

		<?php echo $this->article->event->afterDisplayContent; ?>
	</div>
</div>
