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

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelItem extends JModel
{

	function getData() {
	
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2Item', 'Table');
		$row->load($cid);
		return $row;
	}

	function save($front=false) {
	
		global $mainframe;
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.archive');
		require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'class.upload.php');
		$db = & JFactory::getDBO();
		$user = & JFactory::getUser();
		$row = & JTable::getInstance('K2Item', 'Table');
		$params = & JComponentHelper::getParams('com_k2');
		$nullDate	= $db->getNullDate();
				
		if (!$row->bind(JRequest::get('post'))) {
			$mainframe->redirect('index.php?option=com_k2&view=items', $row->getError(), 'error');
		}


		if ($front && $row->id==NULL){
			if (!$user->authorize('com_k2', 'add','category',$row->catid) && ! $user->authorize('com_k2', 'add', 'category', 'all')) {
				$mainframe->redirect('index.php?option=com_k2&view=item&task=add&tmpl=component', JText::_('You are not allowed to post to this category. Save failed.') , 'error');
			}
		}

		if ($params->get('mergeEditors')){
			
			$text = JRequest::getVar( 'text', '', 'post', 'string', JREQUEST_ALLOWRAW );
			$pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';
			$tagPos	= preg_match($pattern, $text);
			if ($tagPos == 0) $row->introtext=$text;
			else list($row->introtext, $row->fulltext) = preg_split($pattern, $text, 2);
		}
		else {
			$row->introtext = JRequest::getVar('introtext', '', 'post', 'string', JREQUEST_ALLOWRAW);
			$row->fulltext = JRequest::getVar('fulltext', '', 'post', 'string', JREQUEST_ALLOWRAW);
		}
		
		if ($row->id) {
			$datenow =& JFactory::getDate();
			$row->modified 		= $datenow->toMySQL();
			$row->modified_by 	= $user->get('id');
		}
		else {
			$row->ordering = $row->getNextOrder("catid = {$row->catid} AND published >= 0 AND trash = 0");
			$config =& JFactory::getConfig();
			$tzoffset = $config->getValue('config.offset');
			$date =& JFactory::getDate($row->created, $tzoffset);
			$row->created = $date->toMySQL();	
		}

		$row->created_by 	= $row->created_by ? $row->created_by : $user->get('id');

		if ($row->created && strlen(trim( $row->created )) <= 10) {
			$row->created 	.= ' 00:00:00';
		}

		$config =& JFactory::getConfig();
		$tzoffset = $config->getValue('config.offset');
		$date =& JFactory::getDate($row->created, $tzoffset);
		$row->created = $date->toMySQL();

		if (strlen(trim($row->publish_up)) <= 10) {
			$row->publish_up .= ' 00:00:00';
		}

		$date =& JFactory::getDate($row->publish_up, $tzoffset);
		$row->publish_up = $date->toMySQL();

		if (trim($row->publish_down) == JText::_('Never') || trim( $row->publish_down ) == '')
		{
			$row->publish_down = $nullDate;
		}
		else
		{
			if (strlen(trim( $row->publish_down )) <= 10) {
				$row->publish_down .= ' 00:00:00';
			}
			$date =& JFactory::getDate($row->publish_down, $tzoffset);
			$row->publish_down = $date->toMySQL();
		}


		$metadata = JRequest::getVar( 'meta', null, 'post', 'array');
		if (is_array($metadata)) {
			$txt = array();
			foreach ($metadata as $k => $v) {
				if ($k == 'description') {
					$row->metadesc = $v;
				} 
				elseif ($k == 'keywords') {
					$row->metakey = $v;
				} 
				else {
					$txt[] = "$k=$v";
				}
			}
			$row->metadata = implode("\n", $txt);
		}
		
		$row->featured=JRequest::getInt('featured');
		

		if (!$row->check()) {
			$mainframe->redirect('index.php?option=com_k2&view=item&cid='.$row->id, $row->getError(), 'error');
		}
	
		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=items', $row->getError(), 'error');
		}
		
		$row->reorder("catid = {$row->catid} AND published >= 0 AND trash = 0");


		$files = JRequest::get('files');
	
		//Image
		if ($files['image']['error'] == 0 && !JRequest::getBool('del_image')) {
			
			$handle = new Upload($files['image']);
			$handle->allowed = array('image/*');
			
			if ($handle->uploaded) {
				
				$category = & JTable::getInstance('K2Category', 'Table');
				$category->load($row->catid);
				$categoryParams=new JParameter($category->params);
				
				//Original image
				$savepath = JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'src';
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 100;
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = md5("Image".$row->id);
				$handle->Process($savepath);
				
				$filename = $handle->file_dst_name_body;
				$savepath = JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache';
				
				//XLarge image
				$handle->image_resize = true;
				$handle->image_ratio_y = true;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = $params->get('imagesQuality');
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = $filename.'_XL';
				if (JRequest::getInt('itemImageXL')){
					$imageWidth=JRequest::getInt('itemImageXL');
				}
				else {
					$imageWidth=$categoryParams->get('itemImageXL', '800');
				}
				$handle->image_x = $imageWidth;
				$handle->Process($savepath);
				
				//Large image
				$handle->image_resize = true;
				$handle->image_ratio_y = true;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = $params->get('imagesQuality');
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = $filename.'_L';
				if (JRequest::getInt('itemImageL')){
					$imageWidth=JRequest::getInt('itemImageL');
				}
				else {
					$imageWidth=$categoryParams->get('itemImageL', '600');
				}
				$handle->image_x = $imageWidth;
				$handle->Process($savepath);
				
				//Medium image
				$handle->image_resize = true;
				$handle->image_ratio_y = true;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = $params->get('imagesQuality');
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = $filename.'_M';
				if (JRequest::getInt('itemImageM')){
					$imageWidth=JRequest::getInt('itemImageM');
				}
				else {
					$imageWidth=$categoryParams->get('itemImageM', '400');
				}
				$handle->image_x = $imageWidth;
				$handle->Process($savepath);
				
				
				//Small image
				$handle->image_resize = true;
				$handle->image_ratio_y = true;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = $params->get('imagesQuality');
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = $filename.'_S';
				if (JRequest::getInt('itemImageS')){
					$imageWidth=JRequest::getInt('itemImageS');
				}
				else {
					$imageWidth=$categoryParams->get('itemImageS', '200');
				}
				$handle->image_x = $imageWidth;
				$handle->Process($savepath);
				
				//XSmall image
				$handle->image_resize = true;
				$handle->image_ratio_y = true;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = $params->get('imagesQuality');
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = $filename.'_XS';
				if (JRequest::getInt('itemImageXS')){
					$imageWidth=JRequest::getInt('itemImageXS');
				}
				else {
					$imageWidth=$categoryParams->get('itemImageXS', '100');
				}
				$handle->image_x = $imageWidth;
				$handle->Process($savepath);
				
				//Generic image
				$handle->image_resize = true;
				$handle->image_ratio_y = true;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = $params->get('imagesQuality');
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->file_new_name_body = $filename.'_Generic';
				$imageWidth=$categoryParams->get('itemImageGeneric', '300');
				$handle->image_x = $imageWidth;
				$handle->Process($savepath);
				
				$handle->Clean();
				
			}
			
			else {
				$mainframe->redirect('index.php?option=com_k2&view=items', $handle->error, 'error');
			}
			
		}
	
		if (JRequest::getBool('del_image')) {
		
			$current = & JTable::getInstance('K2Item', 'Table');
			$current->load($row->id);
			$filename = md5("Image".$current->id);
			
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.$filename.'.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.$filename.'.jpg');
			}
			
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XS.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XS.jpg');
			}
			
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_S.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_S.jpg');
			}
			
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_M.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_M.jpg');
			}
			
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_L.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_L.jpg');
			}
			
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XL.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XL.jpg');
			}
			
			$row->image_caption = '';
			$row->image_credits = '';
			
		}
		
		//Attachments
		$attachments = JRequest::getVar ( 'attachment_file', NULL, 'FILES', 'array' );
		$attachments_names = JRequest::getVar ( 'attachment_name', '', 'POST', 'array' );
		$attachments_titles = JRequest::getVar ( 'attachment_title', '', 'POST', 'array' );
		$attachments_title_attributes = JRequest::getVar ( 'attachment_title_attribute', '', 'POST', 'array' );
		
	  	$attachmentFiles = array();

		if (count($attachments)){
		
		    foreach ($attachments as $k => $l) {
		        foreach ($l as $i => $v) {
		            if (!array_key_exists($i, $attachmentFiles)) 
		                $attachmentFiles[$i] = array();
		            $attachmentFiles[$i][$k] = $v;
		        }
				
		    }
			
			$path=$params->get('attachmentsFolder',NULL);
			if (is_null($path)){
				$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
			}
			else{
				$savepath = $path;
			}
			
			$counter=0;
			
			foreach ($attachmentFiles as $file) {
				
				$handle = new Upload($file);
				
				if ($handle->uploaded) {
					$handle->file_auto_rename = true;
					$handle->Process($savepath);
					$filename=$handle->file_dst_name;
					$handle->Clean();
					$attachment = & JTable::getInstance('K2Attachment', 'Table');
					$attachment->itemID=$row->id;
					$attachment->filename=$filename;
					$attachment->title=$attachments_titles[$counter];
					$attachment->titleAttribute=$attachments_title_attributes[$counter];
					$attachment->store();
				}
				else {
					$mainframe->redirect('index.php?option=com_k2&view=items', $handle->error, 'error');
				}
				
				$counter++;
			}
		
		}
		
		//Gallery
		if (isset($files['gallery']) && $files['gallery']['error'] == 0 && !JRequest::getBool('del_gallery')) {
			$handle = new Upload($files['gallery']);
			$handle->file_auto_rename = true;
			$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries';
			$handle->allowed = array(
				"application/rar",
				"application/x-rar-compressed",
				"application/arj",
				"application/gnutar",
				"application/x-bzip",
				"application/x-bzip2",
				"application/x-compressed",  
				"application/x-gzip",
				"application/x-zip-compressed",
				"application/zip",
				"multipart/x-zip",
				"multipart/x-gzip",
				"application/x-unknown",
				"application/x-zip"
			);
									
			if ($handle->uploaded) {
				
				$handle->Process($savepath);
				$handle->Clean();
				
				if (JFolder::exists($savepath.DS.$row->id)){
					JFolder::delete($savepath.DS.$row->id);
				}

				if (!JArchive::extract($savepath.DS.$handle->file_dst_name,$savepath.DS.$row->id)) {
					$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Gallery upload error: Cannot extract archive!'), 'error');
				}
				else {
					$row->gallery = '{gallery}'.$row->id.'{/gallery}';
				}
				JFile::delete($savepath.DS.$handle->file_dst_name);
				$handle->Clean();
	
			}
			else {
				$mainframe->redirect('index.php?option=com_k2&view=items', $handle->error, 'error');
			}
		}
		
		if (JRequest::getBool('del_gallery')) {
		
			$current = & JTable::getInstance('K2Item', 'Table');
			$current->load($row->id);
			
			if (JFolder::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$current->id)) {
				JFolder::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$current->id);
			}
			$row->gallery = '';
		}
		
		//Video
		if (!JRequest::getBool('del_video')){
			if (isset($files['video']) && $files['video']['error'] == 0) {
				
				$validExtensions = array('flv',	'swf', 'wmv', 'mov', 'mp4',	'3gp', 'avi','divx');
				
				$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos';
					
				$filetype=JFile::getExt($files['video']['name']);
				
				if (!in_array($filetype, $validExtensions)){
					$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Invalid video file'), 'error');
				}
				
				$filename=JFile::stripExt($files['video']['name']);
				
				JFile::upload($files['video']['tmp_name'], $savepath.DS.$row->id.'.'.$filetype); 
				$filetype=JFile::getExt($files['video']['name']);
				$row->video = '{'.$filetype.'}'.$row->id.'{/'.$filetype.'}';
				
			}
			else {
				
				if (JRequest::getVar('remoteVideo')){
					$fileurl=JRequest::getVar('remoteVideo');
					$filetype=JFile::getExt($fileurl);
					$row->video = '{'.$filetype.'remote}'.$fileurl.'{/'.$filetype.'remote}';
				}
				
				if (JRequest::getVar('videoID')){
					$provider=JRequest::getWord('videoProvider');
					$videoID=JRequest::getVar('videoID');
					$row->video = '{'.$provider.'}'.$videoID.'{/'.$provider.'}';
				}
				
			}

		}
		else {
			
			$current = & JTable::getInstance('K2Item', 'Table');
			$current->load($row->id);

			preg_match_all("#^{(.*?)}(.*?){#",$current->video,$matches,PREG_PATTERN_ORDER); 
			$videotype=$matches[1][0];
			$videofile=$matches[2][0];
			
			if ($videotype=='flv' || $videotype=='swf' || $videotype=='wmv' || $videotype=='mov' || $videotype=='mp4' || $videotype=='3gp' || $videotype=='divx'){
				
				if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype))
					JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype);
			}
			
			$row->video = '';
			$row->video_caption = '';
			$row->video_credits = '';
		}

		//Extra fields
		$objects = array ();
		$variables=JRequest::get('post');
		
		foreach ( $variables as $key => $value ) {
			if (( bool ) JString::stristr( $key, 'K2ExtraField_' )) {
				$object = new JObject;
				$object->set('id',JString::substr ($key,13));
				$object->set('value', $value);
				unset($object->_errors);
				$objects[] = $object;
			}
		}
		
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
		$json=new Services_JSON;
		$row->extra_fields=$json->encode($objects);
		
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'extrafield.php');
		$extraFieldModel=new K2ModelExtraField;
		$row->extra_fields_search='';
		
		foreach ($objects as $object){
			$row->extra_fields_search.=$extraFieldModel->getSearchValue($object->id,$object->value);
			$row->extra_fields_search.=' ';
		}
		
		//Tags
		$db  =& JFactory::getDBO();
		$query = "DELETE FROM #__k2_tags_xref WHERE itemID={intval($row->id)}";     
		$db->setQuery( $query );   
        $db->query();
		
		$tags = JRequest::getVar ( 'selectedTags', NULL, 'POST', 'array' );
		if (count($tags)){
			foreach ($tags as $tagID){
				$query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {intval($tagID)}, {intval($row->id)})";     
				$db->setQuery( $query );   
	           	$db->query();
			}
		}

		if ($front){
			if (!K2HelperPermissions::canPublishItem($row->catid)){
				$row->published=0;
				$mainframe->enqueueMessage(JText::_("You don't have the permission to publish items."),'notice');
			}	
		}

		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=items', $row->getError(), 'error');
		}

		$row->checkin();
		
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();

		switch(JRequest::getCmd('task')) {
			case 'apply':
			$msg = JText::_('Changes to Item saved');
			$link = 'index.php?option=com_k2&view=item&cid='.$row->id;
			break;
			case 'saveAndNew':
			$msg = JText::_('Item saved');
			$link = 'index.php?option=com_k2&view=item';
			break;
			case 'save':
			default:
			$msg = JText::_('Item Saved');
			if ($front) $link = 'index.php?option=com_k2&view=item&task=edit&cid='.$row->id.'&tmpl=component';
			else $link = 'index.php?option=com_k2&view=items';
			break;
		}
		$mainframe->redirect($link, $msg);
	}
	
	function cancel(){
		
		global $mainframe;
		$cid = JRequest::getInt('id');
		$row = & JTable::getInstance('K2Item', 'Table');
		$row->load($cid);
		$row->checkin();
		$mainframe->redirect('index.php?option=com_k2&view=items');
	}

	function getVideoProviders() {
	
		jimport('joomla.filesystem.file');
		if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos'.DS.'jw_allvideos_sources.php')) {
			require JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos'.DS.'jw_allvideos_sources.php';
			$thirdPartyProviders = array_slice($tagReplace, 18);
			$providersTmp = array_keys($thirdPartyProviders);
			$providers = array();
			foreach ($providersTmp as $providerTmp) {
					
				if (stristr($providerTmp, 'google|google.co.uk|google.com.au|google.de|google.es|google.fr|google.it|google.nl|google.pl') !== false) {
					$provider = 'google';
				}
				elseif (stristr($providerTmp, 'spike|ifilm') !== false) {
					$provider = 'spike';
				}
				else {
					$provider = $providerTmp;
				}
				$providers[]=$provider;
			}
			return $providers;
		}
		
		else {
			return;
		}
	
	}
	
	function download($front=false){
		
		global $mainframe;
		jimport('joomla.filesystem.file');
		$params = & JComponentHelper::getParams('com_k2');
		$id = JRequest::getInt('id');
		$attachment = & JTable::getInstance('K2Attachment', 'Table');
		$attachment->load($id);
		$path=$params->get('attachmentsFolder',NULL);
		if (is_null($path)){
			$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
		}
		else{
			$savepath = $path;
		}
		$file=$savepath.DS.$attachment->filename;
		
		if (JFile::exists($file)){
			if ($front) $attachment->hit();
			$len = filesize($file);
			$filename = basename($file);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private", false);
			header("Content-Type: application/zip");
			header("Content-Disposition: attachment; filename=".$filename.";");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".$len);
			readfile($file);
		}
		else {
			echo JText::_('File does not exist');
		}
		$mainframe->close();
		
	}
	
	function getAttachments($itemID){
		
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_attachments WHERE itemID={$itemID}";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
		
	}
	
	function deleteAttachment() {
	
		global $mainframe;
		$params = & JComponentHelper::getParams('com_k2');
		jimport('joomla.filesystem.file');
		$id = JRequest::getInt('id');
		$itemID = JRequest::getInt('cid');
		
		$db = & JFactory::getDBO();
		$query = "SELECT COUNT(*) FROM #__k2_attachments WHERE itemID={$itemID} AND id={$id}";
		$db->setQuery($query);
		$result = $db->loadResult();
		
		if (!$result){
			$mainframe->close();
		}
		
		
		$row = & JTable::getInstance('K2Attachment', 'Table');
		$row->load($id);
		
		$path=$params->get('attachmentsFolder',NULL);
		if (is_null($path)){
			$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
		}
		else{
			$savepath = $path;
		}

		if (JFile::exists($savepath.DS.$row->filename)) {
			JFile::delete($savepath.DS.$row->filename);
		}
		
		$row->delete($id);
		$mainframe->close();
	}
	
	function getAvailableTags($itemID=NULL){
		
		$db = & JFactory::getDBO();
		$query="SELECT * FROM #__k2_tags as tags";
		if (!is_null($itemID)) 
		$query.=" WHERE tags.id NOT IN (SELECT tagID FROM #__k2_tags_xref WHERE itemID={$itemID})";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}
	
	function getCurrentTags($itemID){
		
		$db = & JFactory::getDBO();
		$query="SELECT * FROM #__k2_tags as tags WHERE tags.id IN (SELECT tagID FROM #__k2_tags_xref WHERE itemID={$itemID})";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}
	
	function checkSIG(){
		
		global $mainframe;
		if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_sigpro.php') || JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_sig.php') || JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jwsig.php')) {
			return true;
		}
		else {
			$mainframe->enqueueMessage(JText::_('Notice: Please install the Simple Image Gallery (Free/Pro) plugin if you want to use the image gallery features of K2!'), 'notice');
			return false;
		}
	}

	function checkAllVideos(){
		
		global $mainframe;
		if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos.php')) {
			return true;
		}
		else {
			$mainframe->enqueueMessage(JText::_('Notice: Please install the AllVideos plugin if you want to use the video features of K2!'), 'notice');
			return false;
		}
	}

}
