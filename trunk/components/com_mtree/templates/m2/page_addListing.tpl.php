<style type="text/css" media="all">.sortableitem{cursor:move;list-style: none;}</style>
<script language="javascript" type="text/javascript" src="<?php echo $this->jconf['live_site'] . $this->mtconf['relative_path_to_js_library']; ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo $this->jconf['live_site']; ?>/components/com_mtree/js/category.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $this->jconf['live_site']; ?>/components/com_mtree/js/interface.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $this->jconf['live_site']; ?>/components/com_mtree/js/addlisting.js"></script>
<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var mosConfig_live_site=document.location.protocol+'//' + location.hostname + '<?php echo ($_SERVER["SERVER_PORT"] == 80) ? "":":".$_SERVER["SERVER_PORT"] ?><?php echo substr($_SERVER["PHP_SELF"],0,strrpos($_SERVER["PHP_SELF"],"/")); ?>';
	var indexphp='index<?php echo (defined('JVERSION'))?'':'2'; ?>.php';
	var active_cat=<?php echo $this->cat_id; ?>;
	var attCount=0;
	var attNextId=1;
	var maxAtt=<?php echo $this->mtconf['images_per_listing']; ?>;
	var msgAddAnImage = '<?php echo $this->_MT_LANG->ADD_AN_IMAGE ?>';
	var txtRemove = '<?php echo $this->_MT_LANG->REMOVE ?>';
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel'){submitform( 'viewlink' );return;}
		if (form.link_name.value == ""){
			alert( "<?php echo $this->_MT_LANG->PLEASE_FILL_IN_LINK_NAME ?>" );
			<?php
			$requiredFields = array();
			$this->fields->resetPointer();
			while( $this->fields->hasNext() ) {
				$field = $this->fields->getField();
				if(!in_array($field->name,array('link_hits','link_votes','link_rating','link__featured'))) {
					if( ($field->isRequired() && !in_array($field->name,array('link_name','link_desc'))) || ($field->isRequired() && $this->mtconf['use_wysiwyg_editor'] == 0 && $field->name == 'link_desc') ) {
						echo '} else if (isEmpty(\'' . $field->getName() . '\')) {'; 
						echo 'alert("' . $this->_MT_LANG->PLEASE_COMPLETE_THIS_FIELD . $field->caption . '");';
					}
					if($field->hasJSValidation()) {
						echo "\n";
						echo $field->getJSValidation();
					}
				}
				$this->fields->next();
			}
			?>
		} else {
			<?php
			if($this->mtconf['use_wysiwyg_editor'] == 1 && !is_null($this->fields->getFieldById(2))) {
				getEditorContents( 'editor1', 'link_desc' );
			}
			?>
			var serial = jQuery.SortSerialize('upload_att');
			if(serial.hash != ''){document.adminForm.img_sort_hash.value=serial.hash;}
			form.task.value=pressbutton;
			if(attCount>0 && checkImgExt(attCount,jQuery("input[@type=file][@name='image[]']"))==false) {
				alert('<?php echo $this->_MT_LANG->PLEASE_SELECT_A_JPG_PNG_OR_GIF_FILE_FOR_THE_IMAGES ?>');
				return;
			} else {
				form.submit();
			}
		}
	}
</script>

<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>
<h2 class="contentheading"><?php echo ($this->link->link_id) ? $this->_MT_LANG->EDIT_LISTING : 	$this->_MT_LANG->ADD_LISTING; ?></h2>

<center>
<form action="<?php echo sefRelToAbs("index.php") ?>" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm">
<table width="96%" cellpadding="0" cellspacing="4" border="0" align="center">
	
	<?php echo ( (isset($this->warn_duplicate) && $this->warn_duplicate == 1) ? '<tr><td colspan="2">' . $this->_MT_LANG->THERE_IS_ALREADY_A_PENDING_APPROVAL_FOR_MODIFICATION . '</td></tr>' : '' )?>
	
	<tr><td colspan="2" align="left">
		<input type="button" value="<?php echo $this->_MT_LANG->SUBMIT_LISTING ?>" onclick="javascript:submitbutton('savelisting')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
	</td></tr>
	<tr valign="bottom">
		<td width="20%" align="left" valign="top"><?php echo $this->_MT_LANG->CATEGORY ?>:</td>
		<td width="80%" align="left" colspan="2">
			<?php if($this->mtconf['allow_changing_cats_in_addlisting']) { ?>
			<ul class="linkcats" id="linkcats">
			<li id="lc<?php echo $this->cat_id; ?>"><?php echo $this->pathWay->printPathWayFromCat_withCurrentCat( $this->cat_id, '' ); ?></li>
			<?php
			if ( !empty($this->other_cats) ) {
				foreach( $this->other_cats AS $other_cat ) {
					if ( is_numeric( $other_cat ) ) {
						echo '<li id="lc' . $other_cat . '">';
						if($this->mtconf['allow_user_assign_more_than_one_category']) {
							echo '<a href="javascript:remSecCat('.$other_cat.')">'.$this->_MT_LANG->REMOVE.'</a>';
						}
						echo $this->pathWay->printPathWayFromCat_withCurrentCat( $other_cat, '' ) . '</li>';
					}
				}
			}
			?>
			</ul>
			<a href="#" onclick="javascript:togglemc();return false;" id="lcmanage"><?php echo $this->_MT_LANG->MANAGE; ?></a>
			<div id="mc_con">
			<div id="mc_selectcat">
				<span id="mc_active_pathway"><?php echo $this->pathWay->printPathWayFromCat_withCurrentCat( $this->cat_id, '' ); ?></span>
				<?php echo $this->catlist; ?>
			</div>
			<input type="button" class="button" value="<?php echo $this->_MT_LANG->UPDATE_CATEGORY ?>" id="mcbut1" onclick="updateMainCat()" />
			<?php if($this->mtconf['allow_user_assign_more_than_one_category']) { ?>
			<input type="button" class="button" value="<?php echo $this->_MT_LANG->ALSO_APPEAR_IN_THIS_CATEGORIES ?>" id="mcbut2" onclick="addSecCat()" />
			<?php } ?>
			</div>
			<?php } else {
			
				echo $this->pathWay->printPathWayFromCat_withCurrentCat( $this->cat_id, '' );
				
			} ?>
		</td>
	</tr>
	<?php
	$this->fields->resetPointer();
	while( $this->fields->hasNext() ) {
		$field = $this->fields->getField();
		if($field->hasInputField()) {
			echo '<tr><td valign="top" align="left">';
			if($field->getCaption() != false) {
				if($field->isRequired()) {
					echo '<strong>' . $field->getCaption() . '</strong>:';
				} else {
					echo $field->getCaption() . ':';
				}
			}
			echo '</td><td align="left">';
			echo $field->getModPrefixText();
			echo $field->getInputHTML();
			echo $field->getModSuffixText();
			echo '</td></tr>';
		}
		$this->fields->next();
	}
	?>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<?php if( $this->mtconf['allow_imgupload'] ) { ?>
<tr><td>
<fieldset>
	<legend><?php echo $this->_MT_LANG->IMAGES ?></legend>
	<ol style="margin:0 10px;padding:0;" id="upload_att"><?php
	foreach( $this->images AS $image ) {
		echo '<li style="margin-bottom:5px;" class="sortableitem" id="img_' . $image->img_id . '">';
		echo '<input type="checkbox" name="keep_img[]" value="' . $image->img_id . '" checked />';
		// echo '<a href="' . $this->jconf['live_site'] . '/components/com_mtree/attachment.php?img_id=' . $image->img_id . '&size=2" target="_blank">';
		echo '<a href="' . $this->jconf['live_site'] . $this->mtconf['relative_path_to_listing_medium_image'] . $image->filename . '" target="_blank">';
		echo '<img border="0" style="position:relative;border:1px solid black;" align="middle" src="' . $this->jconf['live_site'] . $this->mtconf['relative_path_to_listing_small_image'] . $image->filename . '" alt="' . $image->filename . '" />';
		echo '</a>';
		echo '</li>';
	}
	?>
	</ol>
	<br clear="both" />
	<a href="javascript:addAtt();" id="add_att"><?php if(count($this->images) < $this->mtconf['images_per_listing']) { ?><?php echo $this->_MT_LANG->ADD_AN_IMAGE ?><?php } ?></a>
</fieldset>
<input type="hidden" name="img_sort_hash" value="" />
</td></tr>
<?php } ?>
<tr><td align="left">
	<br />
	<input type="hidden" name="option" value="<?php echo $this->option ?>" />
	<input type="hidden" name="task" value="savelisting" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />			
	<?php if ( $this->link->link_id == 0 ) { ?>
	<input type="hidden" name="cat_id" value="<?php echo $this->cat_id ?>" />
	<?php } else { ?>
	<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
	<input type="hidden" name="cat_id" value="<?php echo $this->cat_id ?>" />
	<?php } ?>
	<input type="hidden" name="other_cats" id="other_cats" value="<?php echo ( ( !empty($this->other_cats) ) ? implode(', ', $this->other_cats) : '' ) ?>" />
	<input type="hidden" name="<?php echo $this->validate; ?>" value="1" />
	<input type="button" value="<?php echo $this->_MT_LANG->SUBMIT_LISTING ?>" onclick="javascript:submitbutton('savelisting')" class="button" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
</td></tr>
</table>


</form>

</center>