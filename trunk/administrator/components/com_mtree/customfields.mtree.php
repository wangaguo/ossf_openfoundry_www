<?php
/**
* Mosets Tree admin 
*
* @package Mosets Tree 2.0
* @copyright (C) 2007-2008 Mosets Consulting
* @url http://www.mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mosConfig_absolute_path . '/administrator/components/com_mtree/customfields.mtree.html.php' );

/***
* Custom Fields
*/

function manageftattachments($id, $option) {

	exit();
}

function uploadft( $option ) {
	global $mtconf, $database, $_MT_LANG;
	require_once( $mtconf->getjconf('absolute_path') . '/includes/domit/xml_domit_lite_include.php' );
	
	$filename = $_FILES['userfile']['tmp_name'];

	if(!empty($filename)) {

		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if (!$xmlDoc->loadXML( $filename, true, false )) {
			return null;
		}
		$root =& $xmlDoc->documentElement;
		
		if ($root->getTagName() != 'fieldtype') {
			return null;
		}
		
		$useelements = $root->getAttribute( 'useelements' );
		$usesize = $root->getAttribute( 'usesize' );
		// $usecolumns = $root->getAttribute( 'usecolumns' );
		$version = $root->getElementsByPath( 'version', 1 );
		$website = $root->getElementsByPath( 'website', 1 );
		$desc = $root->getElementsByPath( 'description', 1 );
		$field_type = $root->getElementsByPath( 'name', 1 );
		$caption = $root->getElementsByPath( 'caption', 1 );
		$class = $root->getElementsByPath( 'class', 1 );

		$version = $version->getText();
		$website = $website->getText();
		$desc = $desc->getText();
		$field_type = $field_type->getText();
		$caption = $caption->getText();
		$class = $class->getText();

		if(empty($useelements)) { $useelements = 0;	}
		if(empty($usesize)) { $usesize = 0;	}
		if(empty($version)) { $version = '1.00'; }
		if( empty($field_type) || empty($caption) || empty($class) ) {
			return null;
		}

		$database->setQuery('SELECT ft_id FROM #__mt_fieldtypes WHERE field_type = \'' . $field_type . '\' LIMIT 1');
		$duplicate_ft_id = $database->loadResult();
		
		if( $duplicate_ft_id > 0 ) {
			// mosRedirect('index2.php?option=com_mtree&task=managefieldtypes',$_MT_LANG->FAILED_TO_INSTALL_FIELD_TYPE_1);
			$ft_id = saveft2( $field_type, $caption, $class, $useelements, $usesize, $version, $website, $desc, $duplicate_ft_id );
			$database->setQuery( "DELETE FROM #__mt_fieldtypes_att WHERE ft_id = " . $ft_id );
			$database->query();
			
		} else {
			$ft_id = saveft2( $field_type, $caption, $class, $useelements, $usesize, $version, $website, $desc );
		}
		
		
		$attachments	= &$root->getElementsByPath('attachments',1);
		if(!is_null($attachments)) {
			$attachmentsChildNodes = $attachments->childNodes;
			$attachment = new mtFieldTypesAtt( $database );
			foreach($attachmentsChildNodes as $attachmentsChildNode) {
				$filename = $attachmentsChildNode->getElementsByPath( 'filename', 1 );
				$filesize = $attachmentsChildNode->getElementsByPath( 'filesize', 1 );
				$extension = $attachmentsChildNode->getElementsByPath( 'extension', 1 );
				$ordering = $attachmentsChildNode->getElementsByPath( 'ordering', 1 );
				$filedata = $attachmentsChildNode->getElementsByPath( 'filedata', 1 );
				
				$filename = $filename->getText();
				$filesize = $filesize->getText();
				$extension = $extension->getText();
				$ordering = $ordering->getText();
				$filedata = $filedata->getText();
				
				$database->setQuery( "INSERT INTO #__mt_fieldtypes_att (ft_id, filename, filedata, filesize, extension, ordering) "
					.	"\n VALUES("
					.	"'" . $ft_id . "', "
					.	"'" . $filename . "', "
					.	"'" . $database->getEscaped(base64_decode($filedata)) . "', "
					.	"'" . $filesize . "', "
					.	"'" . $extension . "', "
					.	"'9999')" 
					);
				$database->query();
				$attachment->updateOrder('ft_id='.$ft_id);
			}
		}
		
		if( is_null($duplicate_ft_id) ) {
			# Create an unpublished custom field for the new field type
			$database->setQuery('INSERT INTO #__mt_customfields (field_type, caption, published, ordering, advanced_search, simple_search, iscore)'
				.	"\n VALUES('" . $field_type . "', '" . $caption . "', '0', '99', '0', '0', '0')");
			$database->query();

			$row = new mtCustomFields( $database );
			$row->updateOrder( 'published >= 0' );
			
			mosRedirect('index2.php?option=com_mtree&task=managefieldtypes',$_MT_LANG->FIELD_TYPE_INSTALLATION_SUCCESS);
		} else {
			mosRedirect('index2.php?option=com_mtree&task=managefieldtypes',$_MT_LANG->FIELD_TYPE_UPGRADED_SUCCESSFULLY);
		}
		
	}
	
}

function downloadft( $ft_id, $option ) {
	global $database;
	
	$database->setQuery('SELECT * FROM #__mt_fieldtypes AS ft LEFT JOIN #__mt_fieldtypes_info AS fti ON fti.ft_id=ft.ft_id WHERE ft.ft_id = ' . $ft_id . ' LIMIT 1');
	$database->loadObject( $row );

	$database->setQuery('SELECT * FROM #__mt_fieldtypes_att AS fta WHERE fta.ft_id = ' . $ft_id);
	$attachments = $database->loadObjectList();

	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header("Content-Type: application/xml");
	header("Content-Disposition: attachment; filename=mFieldType_" . $row->field_type . "-" . $row->ft_version . ".xml");
	// header('Content-transfer-encoding: binary');
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";

	echo "\n\n<fieldtype useelements=\"" . $row->use_elements . "\" usesize=\"" . $row->use_size . "\" >";
	echo "\n\t<name>" . $row->field_type . "</name>";
	echo "\n\t<caption><![CDATA[" . $row->ft_caption . "]]></caption>";
	echo "\n\t<class><![CDATA[" . $row->ft_class . "]]></class>";
	echo "\n\t<version>" . $row->ft_version . "</version>";
	echo "\n\t<website><![CDATA[" . $row->ft_website . "]]></website>";
	echo "\n\t<description><![CDATA[" . $row->ft_desc . "]]></description>";
	if(count($attachments)>0) {
		echo "\n\t<attachments>";
		foreach($attachments AS $attachment) {
			echo "\n\t\t<attachment>";
			echo "\n\t\t\t<filename>" . $attachment->filename . "</filename>";
			echo "\n\t\t\t<filesize>" . $attachment->filesize . "</filesize>";
			echo "\n\t\t\t<extension>" . $attachment->extension . "</extension>";
			echo "\n\t\t\t<ordering>" . $attachment->ordering . "</ordering>";
			echo "\n\t\t\t<filedata><![CDATA[" . base64_encode($attachment->filedata) . "]]></filedata>";
			echo "\n\t\t</attachment>";
		}
		echo "\n\t</attachments>";
	}
	echo "\n</fieldtype>";
	exit();
}

function editft( $ft_id, $option ) {
	global $database;
	
	if( $ft_id > 0 ) {
		$database->setQuery('SELECT ft.*, fti.ft_version, fti.ft_website, fti.ft_desc FROM #__mt_fieldtypes AS ft LEFT JOIN #__mt_fieldtypes_info AS fti ON fti.ft_id=ft.ft_id WHERE ft.ft_id = ' . $ft_id );
		$database->loadObject( $row );
		$database->setQuery('SELECT * FROM #__mt_fieldtypes_att WHERE ft_id = ' . $ft_id . ' ORDER BY ordering ASC');
		$attachments = $database->loadObjectList();
	} else {
		$row->ft_id = 0;
		$row->field_type = '';
		$row->ft_caption = '';
		$row->ft_class = '';
		$row->use_elements = '0';
		$row->use_size = '0';
		$row->iscore = '0';
		$row->ft_version = '1';
		$row->ft_website = 'http://';
		$row->ft_desc = '';
		$attachments = array();
	}
	HTML_mtcustomfields::editft( $row, $attachments, $option );
	
}

function saveft( $ft_id, $option ) {
	global $database, $_MT_LANG;

	$class = $_POST['ft_class'];
	$website = $_POST['ft_website'];
	$desc = $_POST['ft_desc'];
	$caption = $_POST['ft_caption'];
	$useatt = @$_POST['useatt'];
	$use_elements = $_POST['use_elements'];
	$use_size = @$_POST['use_size'];
	
	if(get_magic_quotes_gpc()) {
		$class = stripslashes($class);
		$website = stripslashes($website);
		$desc = stripslashes($desc);
		$caption = stripslashes($caption);
	}
	
	$attachment = new mtFieldTypesAtt( $database );

	if( $ft_id > 0 ) {
		if(count($useatt) > 0) {
			$database->setQuery('DELETE FROM #__mt_fieldtypes_att WHERE ft_id = ' . $ft_id . ' AND fta_id NOT IN (' . implode(',',$useatt) . ')');
		} else {
			$database->setQuery('DELETE FROM #__mt_fieldtypes_att WHERE ft_id = ' . $ft_id);
		}
		$database->query();
		
		$attachment->updateOrder('ft_id='.$ft_id);
		
		$database->setQuery('UPDATE #__mt_fieldtypes SET field_type = \'' . $database->getEscaped($_POST['field_type']) . '\', ft_caption = \'' . $database->getEscaped($caption) . '\', ft_class = \'' . $database->getEscaped($class) . '\', use_elements = \'' . $use_elements . '\', use_size = \'' . $use_size . '\' WHERE ft_id = \'' . $ft_id . '\' LIMIT 1');
		$database->query();
		$database->setQuery('UPDATE #__mt_fieldtypes_info SET ft_version = \'' . $database->getEscaped($_POST['ft_version']) . '\', ft_website = \'' . $database->getEscaped($website) . '\', ft_desc = \'' . $database->getEscaped($desc) . '\' WHERE ft_id = \'' . $ft_id . '\' LIMIT 1');
		$database->query();
	} else {
		$ft_id = saveft2( $_POST['field_type'], $_POST['ft_caption'],  stripslashes($_POST['ft_class']), $use_elements, $use_size, $_POST['ft_version'], $_POST['ft_website'], $_POST['ft_desc'] );

		# Create an unpublished custom field for the new field type
		$database->setQuery('INSERT INTO #__mt_customfields (field_type, caption, published, ordering, advanced_search, simple_search, iscore)'
			.	"\n VALUES('" . $_POST['field_type'] . "', '" . $_POST['ft_caption'] . "', '0', '99', '0', '0', '0')");
		$database->query();
	}
	
	$database->setQuery('SET GLOBAL max_allowed_packet =10485760');
	$database->query();
	
	if(array_key_exists('attachment',$_FILES)) {
		for($i=0;$i<count($_FILES['attachment']['name']);$i++) {
			// echo '<br />filename:' . $_FILES['attachment']['name'][$i];
			if ( !empty($_FILES['attachment']['name'][$i]) && $_FILES['attachment']['error'][$i] == 0 &&  $_FILES['attachment']['size'][$i] > 0 ) {
				$data = addslashes(fread(fopen($_FILES['attachment']['tmp_name'][$i], "r"), $_FILES['attachment']['size'][$i]));
		
				$database->setQuery( "INSERT INTO #__mt_fieldtypes_att (ft_id, filename, filedata, filesize, extension, ordering) "
					.	"\n VALUES("
					.	"'" . $ft_id . "', "
					.	"'".$_FILES['attachment']['name'][$i]."', "
					.	"'" . $data . "', "
					.	"'".$_FILES['attachment']['size'][$i]."', "
					.	"'".$_FILES['attachment']['type'][$i]."', "
					.	"'9999')" 
					);
				$database->query();
				$attachment->updateOrder('ft_id='.$ft_id);
				
			}
		}
	}
	
	$row = new mtCustomFields( $database );
	$row->updateOrder( 'published >= 0' );
	
	$task = mosGetParam( $_POST, 'task', '' );
	if ( $task == "applyft" ) {
		mosRedirect( "index2.php?option=$option&task=editft&cfid=$ft_id" );
	} else {
		mosRedirect( "index2.php?option=$option&task=managefieldtypes" );
	}
	
}

function saveft2( $field_type, $caption, $class, $useelements, $usesize, $version, $website, $desc, $ft_id=0 ) {
	global $database;
	if($ft_id == 0) {
		$isNew = true;
	} else {
		$isNew = false;
	}
	if($isNew) {
		$sql = 'INSERT INTO #__mt_fieldtypes (field_type,ft_caption,ft_class,use_elements,use_size) ';
		$sql .=	'VALUES('
			.	'\'' . $database->getEscaped($field_type) . '\','
			.	'\'' . $database->getEscaped($caption) . '\','
			.	'\'' . $database->getEscaped($class) . '\','
			.	'\'' . $database->getEscaped($useelements) . '\','
			.	'\'' . $database->getEscaped($usesize) . '\''
			.	')';
	} else {
		$sql = 'UPDATE #__mt_fieldtypes SET ';
		$sql .= 'field_type = \'' . $database->getEscaped($field_type) . '\'';
		$sql .= ', ft_caption = \'' . $database->getEscaped($caption) . '\'';
		$sql .= ', ft_class = \'' . $database->getEscaped($class) . '\'';
		$sql .= ', use_elements = \'' . $database->getEscaped($useelements) . '\'';
		$sql .= ', use_size = \'' . $database->getEscaped($usesize) . '\'';
		$sql .= ' WHERE ft_id = ' . $ft_id . ' LIMIT 1';
	}
	$database->setQuery( $sql );
	$database->query();
	if($isNew) {
		$ft_id = $database->insertid();
	}
	
	$website = ($website == 'http://') ? '' : $database->getEscaped($website);
	if($isNew) {
		$sql = 'INSERT INTO #__mt_fieldtypes_info (ft_id,ft_version,ft_website,ft_desc) ';
		$sql .= 'VALUES('
			.	'\'' . $ft_id . '\','
			.	'\'' . $database->getEscaped($version) . '\','
			.	'\'' . $database->getEscaped($website) . '\','
			.	'\'' . $database->getEscaped($desc) . '\''
			.	')';
	} else {
		$sql = 'UPDATE #__mt_fieldtypes_info SET '
			.	'ft_version = \'' . $database->getEscaped($version) . '\','
			.	'ft_website = \'' . $database->getEscaped($website) . '\','
			.	'ft_desc = \'' . $database->getEscaped($desc) . '\''
			.	' WHERE ft_id = ' . $ft_id . ' LIMIT 1';		
	}
	$database->setQuery( $sql );
	$database->query();
	
	return $ft_id;
}

function removeft( $ft_id, $option ) {
	global $database, $_MT_LANG;
	
	# Get field_type value
	$database->setQuery('SELECT field_type, iscore FROM #__mt_fieldtypes WHERE ft_id = ' . $ft_id . ' LIMIT 1');
	$database->loadObject($fieldtype);
	$field_type = $fieldtype->field_type;
	
	if($fieldtype->iscore) {
		mosRedirect("index2.php?option=$option&task=managefieldtypes",$_MT_LANG->CANNOT_DELETE_CORE_FIELDTYPE);
	} else {
		if(!empty($field_type)) {

			# Get cf_id(s) that uses this field type
			$database->setQuery('SELECT cf_id FROM #__mt_customfields WHERE field_type = \'' . $field_type . '\'');
			$cf_ids = $database->loadResultArray();

			if(count($cf_ids)>0) {
				# Delete attachments
				$database->setQuery('DELETE FROM #__mt_cfvalues_att WHERE cf_id IN (' . implode(',',$cf_ids) . ')');
				$database->query();		

				# Delete values the uses this field type
				$database->setQuery('DELETE FROM #__mt_cfvalues WHERE cf_id IN (' . implode(',',$cf_ids) . ')');
				$database->query();		

				# Delete instances of this field type
				$database->setQuery('DELETE FROM #__mt_customfields WHERE cf_id IN (' . implode(',',$cf_ids) . ') LIMIT ' . count($cf_ids));
				$database->query();		
			}

			# Delete attachments
			$database->setQuery('DELETE FROM #__mt_fieldtypes_att WHERE ft_id = ' . $ft_id);
			$database->query();		

			# Delete field type's information
			$database->setQuery('DELETE FROM #__mt_fieldtypes_info WHERE ft_id = ' . $ft_id . ' LIMIT 1');
			$database->query();		

			# Delete field type itself
			$database->setQuery('DELETE FROM #__mt_fieldtypes WHERE ft_id = ' . $ft_id . ' LIMIT 1');
			$database->query();		

		} 
		mosRedirect("index2.php?option=$option&task=managefieldtypes");
	}
}

function cancelft( $option ) {
	mosRedirect( 'index2.php?option='. $option .'&task=managefieldtypes' );
}

function managefieldtypes( $option ) {
	global $database;
	
	$database->setQuery( "SELECT ft.*, fti.ft_version, fti.ft_website, fti.ft_desc FROM #__mt_fieldtypes AS ft LEFT JOIN #__mt_fieldtypes_info AS fti ON fti.ft_id = ft.ft_id ORDER BY iscore ASC, ft_caption ASC" );
	$rows = $database->loadObjectList();
	
	HTML_mtcustomfields::managefieldtypes( $option, $rows );
}

function customfields( $option ) {
	global $database, $mainframe;
	
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 15 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

 	$database->setQuery( 'SELECT COUNT(*) FROM #__mt_customfields');
	$total = $database->loadResult();
	
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	
	$database->setQuery( 'SELECT cf.*, ft.ft_caption FROM #__mt_customfields AS cf '
		.	'LEFT JOIN #__mt_fieldtypes AS ft ON ft.field_type = cf.field_type '
		.	'ORDER BY ordering ASC'
		. "\nLIMIT $pageNav->limitstart,$pageNav->limit");
	$custom_fields = $database->loadObjectList();
	
	HTML_mtcustomfields::customfields( $custom_fields, $pageNav, $option );
}

function editcf( $cf_id, $option ) {
	global $database, $_MT_LANG, $mtconf;
	
	$row = new mtCustomFields( $database );
	$row->load( $cf_id );
	$params = null;

	if ($row->cf_id == 0) {
		$row->caption = '';
		$row->field_type = 'text';
		$row->cat_id = 0;
		$row->ordering = 0;
		$row->hidden = 0;
		$row->published = 1;
		$row->size = 30;
		$row->hide_caption = 0;
		$row->advanced_search = 0;
		$row->simple_search = 0;
		$row->search_caption = '';
		$row->details_view=1;
		$row->summary_view=0;
		
	} else {
		$database->setQuery("SELECT COUNT(fta.fta_id) FROM #__mt_fieldtypes_att AS fta "
			.	"LEFT JOIN #__mt_fieldtypes AS ft ON ft.ft_id=fta.ft_id "
			.	"WHERE ft.field_type = '" . $row->field_type . "' AND fta.filename = '" . $mtconf->get('params_xml_filename') . "' LIMIT 1"
		);

		if($database->loadResult() == 1) {
			# Parameters
			require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/include/MT_DOMIT_Lite_Document.php' );
			require_once( $mtconf->getjconf('absolute_path') . '/administrator/components/com_mtree/include/MT_mosParameters.php' );
			$database->setQuery("SELECT fta.filedata FROM #__mt_fieldtypes_att AS fta "
				.	"LEFT JOIN #__mt_fieldtypes AS ft ON ft.ft_id=fta.ft_id "
				.	"WHERE ft.field_type = '" . $database->getEscaped($row->field_type) . "' AND fta.filename = 'params.xml' LIMIT 1");
			$xmlText = $database->loadResult();

			$xmlDoc = new MT_DOMIT_Lite_Document();
			$xmlDoc->resolveErrors( true );
			if ($xmlDoc->loadXMLFromText( $xmlText, false, true )) {
				$root = &$xmlDoc->documentElement;
				if ($root->getTagName() == 'mosinstall') {
					$element = &$root->getElementsByPath( 'description', 1 );
					$row->description = $element ? trim( $element->getText() ) : '';
				}
			}
			$params = new MT_mosParameters( $row->params, $xmlText, 'module' );
		}
	}

	$lists = array();

	# build the html select list for ordering
	$order = mosGetOrderingList( "SELECT ordering AS value, caption AS text"
		. "\nFROM #__mt_customfields ORDER BY ordering ASC"	);
	$lists['ordering'] = mosHTML::selectList( $order, 'ordering', 'class="inputbox" size="1"', 'value', 'text', intval( $row->ordering ) );
	
	# Generate the Field Types
	$cf_types = array (
		'text' => $_MT_LANG->FIELD_TYPE_TEXT,
		// 'multitext' => $_MT_LANG->FIELD_TYPE_MULTITEXT,
		'selectlist' => $_MT_LANG->FIELD_TYPE_SELECTLIST,
		'selectmultiple' => $_MT_LANG->FIELD_TYPE_SELECTMULTIPLE,
		'checkbox' => $_MT_LANG->FIELD_TYPE_CHECKBOX,
		'radiobutton' => $_MT_LANG->FIELD_TYPE_RADIOBUTTON
		);
	# Get custom field types
	$database->setQuery("SELECT * FROM #__mt_fieldtypes WHERE iscore = '0' ORDER BY ft_caption ASC");
	$custom_cf_types = $database->loadObjectList('field_type');

	$lists["field_types"] = '<select name="field_type" onchange="updateInputs(this.value)">';
	$lists["field_types"] .= '<optgroup label="' . $_MT_LANG->BASIC_FIELDTYPES . '">';
	foreach( $cf_types AS $key => $value ) {
		$lists["field_types"] .= '<option value="' . $key . '"' . (($row->field_type == $key)?' selected':'') . '>' . $value . '</option>';
	}
	$lists["field_types"] .= '</optgroup>';
	$lists["field_types"] .= '<optgroup label="' . $_MT_LANG->CUSTOM_FIELDTYPES . '">';
	foreach( $custom_cf_types AS $key => $value ) {
		$lists["field_types"] .= '<option value="' . $key . '"' . (($row->field_type == $key)?' selected':'') . '>' . $value->ft_caption . '</option>';
	}
	$lists["field_types"] .= '</optgroup>';
	$lists["field_types"] .= '</select>';
	
	$lists['advanced_search'] = mosHTML::yesnoRadioList("advanced_search", 'class="inputbox"', (($row->advanced_search == 1) ? 1 : 0));
	
	$lists['simple_search'] = mosHTML::yesnoRadioList("simple_search", 'class="inputbox"', (($row->simple_search == 1) ? 1 : 0));

	$lists['details_view'] = mosHTML::yesnoRadioList("details_view", 'class="inputbox"'.(($cf_id=='1')?' disabled':''), (($row->details_view == 1) ? 1 : 0));
	$lists['summary_view'] = mosHTML::yesnoRadioList("summary_view", 'class="inputbox"'.(($cf_id=='1')?' disabled':''), (($row->summary_view == 1) ? 1 : 0));
	
	if( in_array($row->cf_id,array(1)) ) {
		$lists['required_field'] = mosHTML::yesnoRadioList("required_field", 'class="inputbox" disabled', '1');
	} elseif ( in_array($row->cf_id,array(3,14,15,16,17,18,19,20,21,22,26,27)) ) {
		$lists['required_field'] = mosHTML::yesnoRadioList("required_field", 'class="inputbox" disabled', '0');
	} else {
		$lists['required_field'] = mosHTML::yesnoRadioList("required_field", 'class="inputbox"', (($row->required_field == 1) ? 1 : 0));
	}
	$lists['hidden'] = mosHTML::yesnoRadioList("hidden", 'class="inputbox"', (($row->hidden == 1) ? 1 : 0));
	$lists['published'] = mosHTML::yesnoRadioList("published", 'class="inputbox"', (($row->published == 1) ? 1 : 0));
	
	# make order list
	$orders = mosGetOrderingList( "SELECT ordering AS value, caption AS text"
		. "\nFROM #__mt_customfields"
		. "\nORDER BY ordering"
	);
	$lists["order"] = mosHTML::selectList( $orders, 'ordering', 'class="text_area" size="1"', 'value', 'text', intval( $row->ordering ) );

	HTML_mtcustomfields::editcf( $row, $custom_cf_types, $lists, $params, $option );
}

function savecf( $option ) {
	global $database, $_MT_LANG;
	
	if( !array_key_exists('hide_caption', $_POST) || $_POST['hide_caption'] != '1' )  {
		$_POST['hide_caption'] = 0;
	}
	
	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ($params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}
	
	$row = new mtCustomFields( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	# Successively remove '|' at the start and end to eliminate blank options
	while (substr($row->field_elements, -1) == '|') {
		$row->field_elements = substr($row->field_elements, 0, -1);
	}
	while (substr($row->field_elements, 0, 1) == '|') {
		$row->field_elements = substr($row->field_elements, 1);
	}

	# Clean up Field Elements's data. Remove spaces around '|' so that it is used correctly in SET COLUMN in MySQL
	$tmp_fe_array = explode('|',$row->field_elements);
	foreach($tmp_fe_array AS $tmp_fe) {
		# Detect usage of comma.
		if (strrpos($tmp_fe,',') == FALSE) 
		{
			$tmp_fe_array2[] = trim($tmp_fe);
		} else {
			echo "<script> alert('".$_MT_LANG->WARNING_COMMAS_ARE_NOT_ALLOWED_IN_FIELD_ELEMENTS."'); window.history.go(-1); </script>\n";
			exit();
		}
	}
	$row->field_elements = implode('|',$tmp_fe_array2);

	# Put new item to last
	if($row->cf_id <= 0) $row->ordering = 999;

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->updateOrder( 'published >= 0' );

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$task = mosGetParam( $_POST, 'task', '' );
	if ( $task == "applycf" ) {
		mosRedirect( "index2.php?option=$option&task=editcf&cfid=" . $row->cf_id );
	} else {
		mosRedirect( "index2.php?option=$option&task=customfields" );
	}

}

function ordercf( $cf_id, $inc, $option ) {
	global $database;
	$row = new mtCustomFields( $database );
	$row->load( $cf_id );
	$row->move( $inc, '' );
	mosRedirect( 'index2.php?option='. $option .'&task=customfields' );
}

function cf_publish( $cf_id, $publish=1 ,$option ) {
	global $database, $_MT_LANG;

	if (!is_array( $cf_id ) || count( $cf_id ) < 1) {
		echo "<script> alert('".$_MT_LANG->PLEASE_SELECT_AN_ITEM_TO_PUBLISH_OR_UNPUBLISH."'); window.history.go(-1);</script>\n";
		exit();
	}

	$ids = implode( ',', $cf_id );

	$database->setQuery( "UPDATE #__mt_customfields SET published='$publish' WHERE cf_id IN ($ids)" );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	mosRedirect( "index2.php?option=$option&task=customfields" );

}

function removecf( $id, $option ) {
	global $database, $_MT_LANG;

	for ($i = 0; $i < count($id); $i++) {
		$query = "SELECT iscore FROM #__mt_customfields WHERE cf_id='".$id[$i]."' LIMIT 1";
		$database->setQuery($query);
		
		if(($iscore = $database->loadResult()) == null) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
		
		if ($iscore == 1) {
			mosRedirect( "index2.php?option=$option&task=customfields", $_MT_LANG->CANNOT_DELETE_CORE_FIELD );
		} else {
			# Delete the main fields data
			$database->setQuery("DELETE FROM #__mt_customfields WHERE `cf_id`='".$id[$i]."'");
			$database->query();

			# Delete the data associated with this field
			$database->setQuery("DELETE FROM #__mt_cfvalues WHERE `cf_id`='".$id[$i]."'");
			$database->query();
			
			# Delete the data associated with this field
			$database->setQuery("DELETE FROM #__mt_cfvalues_att WHERE `cf_id`='".$id[$i]."'");
			$database->query();
			
		}
	}
	mosRedirect("index2.php?option=$option&task=customfields");
}

function cancelcf( $option ) {
	mosRedirect( 'index2.php?option='. $option .'&task=customfields' );
}

?>