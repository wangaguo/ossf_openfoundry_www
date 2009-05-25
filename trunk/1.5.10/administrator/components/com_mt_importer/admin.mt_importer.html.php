<?php
/**
* Mosets Tree Importer admin html
*
* @package Mosets Tree Importer 1.5
* @copyright (C) 2004 - 2007 Mosets Consulting
* @url http://www.Mosets.com/
* @author Lee Cher Yeong <mtree@mosets.com>
**/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_mt_importer {
	
	function check_jcontent( &$sections ) {
	?>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminform">
		<tr><th colspan="3">MT Importer - Import data content from Joomla's content</th></tr>
		<tr valign="top">
			<td align="left">
				<p /><b>Select the sections you wish to import to Mosets Tree</b> and then <b>press the Import button</b	>.<p />These sections and its categories and content will be imported to the root directory. Please note that most mambot calls (eg: {mosimage}, {mospagebreak} etc.) will not work in a Mosets Tree listing.<p />Since you're importing data from another component, you need to perform "<b>Recount Cats/Listings</b>" after the import process is completed. This function will recount the number of categories and listings you have in Mosets Tree.
			</td>
		</tr>
	</table>
	<p align="left" />
	<table class="adminlist">
		<tr>
			<th width="20">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $sections );?>);" />
			</th>
			<th class="title" width="76%">
			Section Name
			</th>
			<th width="12%" nowrap="nowrap">
			# Categories
			</th>
			<th width="12%" nowrap="nowrap">
			# Content Items
			</th>
		</tr><?php
		$k = 0;
		for ( $i=0, $n=count( $sections ); $i < $n; $i++ ) {
			$row = &$sections[$i];
			mosMakeHtmlSafe($row);
			$link = 'index2.php?option=com_sections&scope=content&task=editA&hidemainmenu=1&id='. $row->id;
			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="20" align="right"><?php echo $i+1; ?></td>
				<td width="20"><?php echo $checked; ?></td>
				<td width="35%"><?php echo $row->name; ?></td>
				<td align="center"><?php echo $row->categories; ?></td>
				<td align="center"><?php echo $row->contentitems; ?></td>
				<?php
				$k = 1 - $k;
				?>
			</tr>
			<?php
		}
		?>
		<tr><th colspan="5" align="left"></th></tr>
		</table>
	<p align="left" />
	<input type="submit" value="Import" />
	
	<input type="hidden" name="task" value="import_jcontent" />
	<input type="hidden" name="option" value="com_mt_importer" />
	</form>
	
	<?php
	}
	
	function check_mosdir( &$pt_count, &$mt_count, &$custom_fields, &$cust ) {
	?>
<form action="index2.php" method="post" name="adminForm">
<table class="adminform">
	<tr><th colspan="3">MT Importer - Import data from mosDirectory 2.2x</th></tr>
	<tr valign="top">
		<td width="33%" align="left">
		<h1>Step 1</h1>

		<table class="adminform">
			<tr><td><h3>Pre-check and warning</h3>
				<font color="Blue"><b>Introduction</b></font>: MT Importer will import all categories and listings from mosDirectory 2.2.x to Mosets Tree version 2.0x.<br /><br />			
			
				<font color="Green"><b>Requirement</b></font>: You must have the <b>correct version</b> of mosDirectory and Mosets Tree installed before you can use this Importer.<br /><br />

				<font color="Red"><b>WARNING</b></font>: This importer will delete all your current listing in Mosets Tree before importing any data from mosDirectory. Please backup your database if you do not wish to delete these information.<br /><br />
			</td></tr>

			
			
			<tr><td><u><b>mosDirectory</b></u></td></tr>
			<tr><td>Number of Categories: <b><?php echo (($pt_count['cats'] >= 0) ? $pt_count['cats'] : "<font color=\"Red\">No table found</font>") ?></b></td></tr>
			<tr><td>Number of Listings: <b><?php echo (($pt_count['listings'] >= 0) ? $pt_count['listings'] : "<font color=\"Red\">No table found</font>") ?></b></td></tr>
			<tr><td>Custom Fields: <b><?php echo (($custom_fields > 0) ? count($custom_fields) : "<font color=\"Red\">No table found</font>" ) ?></b></td></tr>

			<tr><td>&nbsp;</td></tr>

			<tr><td><u><b>Mosets Tree</b></u></td></tr>
			<tr><td>Number of Categories: <b><?php echo $mt_count['cats'] ?></b></td></tr>
			<tr><td>Number of Listings: <b><?php echo $mt_count['listings'] ?></b></td></tr>

		</table>
		</td>	

		<td width="33%" align="left">
		<h1>Step 2</h1>

		<table class="adminform">

		<tr>
			<td colspan="2">
				<h3>Custom Fields</h3>
				Options below allow you to map custom fields from mosDirectory to Tree's custom fields. Please make sure the fields are mapped to a compatible fieldtype, otherwise the values will not be displayed properly.<br /><br />
			</td>
		</tr>
		
		<tr><td width="40%"><b><u>mosDirectory field</u></b></td><td width="90%"><b><u>Mosets Tree's custom field</u></b></td></tr>

		<?php if ( count($custom_fields) > 0 ) { 
			$i = 0;
			foreach( $custom_fields AS $cf ) {
				$i++;
				$cust_list = mosHTML::selectList( $cust, $cf->name, 'class="inputbox" size="1"',	'value', 'text', 0 );
		?>
		<tr><td><?php echo $cf->name ?>:</td><td><?php echo $cust_list ?></td></tr>
		<?php 
				} 
			}
		?>
		</table>

		</td>

		<td width="33%" align="left">
		<h1>Step 3</h1>
		<table class="adminform">
			<tr><td><h3>Import</h3>
				Click the "Import" button below to start the import process. You will be notified and redirected to Mosets Tree main page when the import is complete.<p />Since you're importing data from another component, you need to perform "<b>Recount Cats/Listings</b>" after the import process is complete. This function will recount the number of categories and listings you have in Mosets Tree.<br /><br />
			</td></tr>

			<tr><td><input type="submit" value="Import" /></td></tr>
		</table>
		</td>

	</tr>
</table>

<input type="hidden" name="task" value="import_mosdir" />
<input type="hidden" name="option" value="com_mt_importer" />

</form>
	<?php
	}

	function check_gossamer( &$pt_count, &$mt_count, $table_prefix='linksql_' ) {
	?>
<form action="index2.php" method="post" name="adminForm">
<table class="adminform">
	<tr><th colspan="3">MT Importer - Import data from Gossamer Links</th></tr>
	<tr valign="top">
		<td width="50%" align="left">
		<h1>Step 1</h1>

		<table class="adminform">
			<tr><td><h3>Pre-check and warning</h3>
				<font color="Blue"><b>Introduction</b></font>: MT Importer will import all categories and listings from Gossamer Links to Mosets Tree version 1.5x.<br /><br />			

				<font color="Green"><b>Requirement</b></font>: You must have Mosets Tree version 1.5x installed and Gossamer Links table exists in the database before you can use this Importer.<br /><br />

				<font color="Red"><b>WARNING</b></font>: This importer will delete all your current listing in Mosets Tree before importing any data from Gossamer Links. Please backup your database if you do not wish to delete these information.<br /><br />
			</td></tr>

			
			
			<tr><td><u><b>Gossamer Links</b></u></td></tr>
			<tr><td>Number of Categories: <b><?php echo (($pt_count['cats'] >= 0) ? $pt_count['cats'] : "<font color=\"Red\">No table found</font>") ?></b></td></tr>
			<tr><td>Number of Related Categories: <b><?php echo (($pt_count['relcats'] >= 0) ? $pt_count['relcats'] : "<font color=\"Red\">No table found</font>") ?></b></td></tr>
			<tr><td>Number of Listings: <b><?php echo (($pt_count['listings'] >= 0) ? $pt_count['listings'] : "<font color=\"Red\">No table found</font>") ?></b></td></tr>
			<?php
			if($pt_count['cats'] == -1 && $pt_count['relcats'] == -1 && $pt_count['listings'] == -1) {
			?>
			<tr><td>If you are using a non-default table prefix, please enter the prefix and check again:</td></tr>
			<tr><td>
				<input type="text" name="table_prefix" size="10" value="<?php echo $table_prefix ?>" />
				<input type="button" value="Check Again" onclick="document.adminForm.task.value='check_gossamerlinks';document.adminForm.submit();" />
			</td></tr>
			<?php	
			} else {
			?>
			<input type="hidden" name="table_prefix" value="<?php echo $table_prefix ?>" />
			<?php
			}
			?>
			<tr><td>&nbsp;</td></tr>

			<tr><td><u><b>Mosets Tree</b></u></td></tr>
			<tr><td>Number of Categories: <b><?php echo $mt_count['cats'] ?></b></td></tr>
			<tr><td>Number of Listings: <b><?php echo $mt_count['listings'] ?></b></td></tr>

		</table>
		</td>	

		<td width="50%" align="left">
		<h1>Step 2</h1>
		<table class="adminform">
			<tr><td><h3>Import</h3>
				Click the "Import" button below to start the import process. You will be notified and redirected to Mosets Tree main page when the import is complete.<p />Since you're importing data from another source, you need to perform "<b>Recount Cats/Listings</b>" after the import process is complete. This function will recount the number of categories and listings you have in Mosets Tree.<br /><br />
			</td></tr>

			<tr><td><input type="submit" value="Import" <?php
				if($pt_count['cats'] == -1 && $pt_count['relcats'] == -1 && $pt_count['listings'] == -1) {
				echo 'disabled '	;
				}
				?>/></td></tr>
		</table>
		</td>

	</tr>
</table>

<input type="hidden" name="task" value="import_gossamerlinks" />
<input type="hidden" name="option" value="com_mt_importer" />

</form>
	<?php
	}

	function check_csv() {
		global $mosConfig_dbprefix, $mosConfig_live_site;
	?>
<form action="index2.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<table class="adminform">
	<tr><th colspan="3">MT Importer - Import data from Comma Seperated Values (CSV) File</th></tr>
	<tr valign="top">

		<td width="50%" align="left">
		<h1>Step 1</h1>

		<table class="adminform">
			<tr><td><h3>Introduction</h3>
				This Importer will import all listings from a <i>.csv</i> files. <a href="components/com_mt_importer/sample.csv">Download a sample</a> and start by adding your listings to the file. Please bear in mind the following when adding listings:
				<ul>
					<li>The first line of <i>sample.csv</i> contains the list of column names that map to Moset Tree's database. Only the first column - <b>link_name</b> is compulsory. Other columns are optional and can be safely removed. If you're removing a column, make sure you remove the corresponding values for the listings.</li>
					<li>Second line and onwards is where you insert your data. One line for each listing. In <i>sample.csv</i>, the second line is filled with one sample listing.</li>
					<li>You may use Microsoft Excel or any other word processor to edit the file. Make sure you do not save the formatting when prompted.</li>
					<li>Enter Category ID to the <b>cat_id</b> field. This information can be found when you're browsing the category. If no cat_id is specified, Importer will import the listing to Root category (0).</li>
					<li>Enter User ID to the <b>user_id</b> field. This information can be found from your database table called <i><?php echo $mosConfig_dbprefix ?>users</i>. If no user_id column is specified, the listing will be owned by <b>admin</b> by default.</li>
					<li>If you want a particular listing to be featured, set <b>link_featured</b> field to <i>1</i>, otherwise set it to <i>0</i>.</li>
					<li>There is no need to enter <b>link_published</b> or <b>link_approved</b>'s value. All imported listings will be published and approved automatically. </li>
					<li>To import custom values, the ID of the custom field will be the column name. In the sample, the last 2 columns are mapped to custom fields with ID 25 and 26. You can locate these IDs at <a href="<?php echo $mosConfig_live_site; ?>/administrator/index2.php?option=com_mtree&amp;task=customfields">Custom Fields</a> page.
				</ul>

				<p />

				<font color="Red"><b>WARNING</b></font>: <b>PLEASE BACKUP YOUR DATABASE BEFORE PROCEEDING TO THE NEXT STEP.</b> Although we have done everything possible to minimize the risk of database corruption, accident do happens once a while. Backing up your database is the best protection to this.<br /><br />
			</td></tr>
		</table>
		</td>	

		<td width="50%" align="left">
		<h1>Step 2</h1>
		<table class="adminform">
			<tr><td><h3>Import</h3>
				Select your <i>.csv</i> file and click "Import" button below to start the import process. You will be notified and redirected to Mosets Tree main page when the import is completed.<p />Since you're importing data from another source, you need to perform "<b>Recount Cats/Listings</b>" after the import process is complete. This function will recount the number of categories and listings you have in Mosets Tree.<br />
			</td></tr>

			<tr><td>
				CSV File: <input class="text_area" type="file" name="file_csv" />
				<p />
				<input type="submit" value="Import" />
			</td></tr>
		</table>
		</td>
	</tr>
</table>

<input type="hidden" name="task" value="import_csv" />
<input type="hidden" name="option" value="com_mt_importer" />

</form>
	<?php
	}

}
?>
