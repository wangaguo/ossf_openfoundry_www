<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (!defined('GJBASEPATH')) {define( 'GJBASEPATH', dirname(__FILE__) );}
if (!defined('JPATH')) define ('JPATH', $mainframe->getCfg('absolute_path'));

class option {
	var $id;
	var $text;
}

class HTML_wg {

	/**
	* Static method to create the template object
	* @return patTemplate
	*/
	function &createTemplate() {
		global $option;

		if (file_exists(JPATH.'/includes/patTemplate/patTemplate.php')) {
			require_once( JPATH.'/includes/patTemplate/patTemplate.php' );
		}
		if (file_exists(JPATH.'/plugins/system/legacy/patfactory.php')) {
			require_once( JPATH.'/plugins/system/legacy/patfactory.php' );
		}

		$tmpl =& patFactory::createTemplate( $option, true, false );
		$tmpl->setRoot( JPATH.'/components/com_groupjive/templates/default' );
		return $tmpl;
	} // ---- end &createTemplate -----

	function errorpage($message) {
		echo "<h2 aling=center>$message</h2>";
	}


	function listCategory( $option, &$rows, $pageNav) {
		global $mainframe;
		?>
		<form action="index2.php" method="post" name="adminForm">
	
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
			<tr>
				<th>
				GroupJive :: Categories Manager
				</th>
				<td>&nbsp;
				
				</td>
				<td>&nbsp;
				
				</td>
				<td width="right">&nbsp;
				
				</td>
			</tr>
			</table>
	
			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				<tr>
					<th width="20">#</th>
					<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
					<th class="title" >Category</th>
					<th class="title">Administrator</th>
					<th class="title">Access</th>
					<th class="title">Published</th>
					<th colspan="2">Reorder</th>
				</tr>
	
				<?php $k = 0;
				for($i=0, $n=count( $rows ); $i < $n; $i++) {
					$row = $rows[$i];
					$access 	= mosCommonHTML::AccessProcessing( $row, $i );
				?>
					<tr class="<?php echo "row$k"; ?>">
						<td width="20" align="right"><?php echo $i+$pageNav->limitstart+1;?></td>
						<td ><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
						<td ><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editcategory')"><?php echo $row->catname; ?></a></td>
						<td><?php echo $row->adminname?></td>
						<td><?php echo $access?></td>
						<td align="left">
							<?php if ($row->published == "1") {
								echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublishcat')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
							} else {
								echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publishcat')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
							} ?>
						</td>
						<td align="right">
							<?php if ($i > 0 || ($i+$pageNav->limitstart > 0)) { ?>
								<a href="#reorder" onClick="return listItemTask('cb<?php echo $i;?>','orderup')">
									<img src="images/uparrow.png" width="12" height="12" border="0" alt="Move Up">
								</a>
							<?php } ?>
						</td>
						<td align="left">
							<?php if ($i < $n-1 || $i+$pageNav->limitstart < $pageNav->total-1) { ?>
								<a href="#reorder" onClick="return listItemTask('cb<?php echo $i;?>','orderdown')">
									<img src="images/downarrow.png" width="12" height="12" border="0" alt="Move Down">
								</a>
							<?php } ?>
						</td>
					</tr>
				<?php $k = 1 - $k; } ?>
			</table>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="categoriesmanager" />
			<input type="hidden" name="boxchecked" value="0" />
			<?php if ($row->ordering!=0){echo '<input type="hidden" name="ordering" value="'.$row->ordering.'">';}?>
			<?php echo $pageNav->getListFooter(); ?>
			<?php mosCommonHTML::ContentLegend(); ?>
		</form> 
	<?php } 

	function editCategory( $option, &$row, &$lists ) {
		global $database; ?>

		<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data" id="adminForm" class="adminForm">
			<table class="adminheading">
				<tr>
					<th>
						Category:
						<small>
							<?php echo $row->id ? 'Edit' : 'New';?>
						</small>
					</th>
				</tr>
			</table>

			<table class="adminform" width="60%" align="left">
				<tr>
					<th colspan="2">Category Details</th>
					<th>Category Logo Image</th>
				</tr>
				<tr>
					<td>Category Name: </td>
					<td>
						<input size="30" name="catname" id="catname" value="<?php echo $row->catname; ?>">
					</td>
					<td rowspan="8"><?php if ($row->cat_image != ''){echo '<p>Category Logo:</p><img src="../images/com_groupjive/'.$row->cat_image.'?ac='.time().'" />';} ?></td>
				</tr>
																				       <tr class="row">			     
					<td>Category Description: </td>
					<td colspan="2"><textarea name="descr" id="descr" cols="40" rows="5" ><?php echo $row->descr?></textarea>       		     		       </td>
																				       </tr> 
				<tr class="row">
					<td colspan="2">&nbsp;</td>
				</tr>
								
				<tr class="row">
					<td colspan="2">Set Group Types allowed in this Category ? :</td>
				</tr>

				<tr>
					<td> - Allow Create "OPEN" group type: </td>
					<td><?php echo mosHTML::yesnoSelectList( "create_open", "", $row->create_open ); ?></td>
				</tr>
				<tr>
					<td> - Allow Create "APPROVAL" group type: </td>
					<td><?php echo mosHTML::yesnoSelectList( "create_closed", "", $row->create_closed ); ?></td>
				</tr>
				<tr>
					<td> - Allow Create "INVITE" group type: </td>
					<td><?php echo mosHTML::yesnoSelectList( "create_invite", "", $row->create_invite ); ?></td>
				</tr>
								
				<tr class="row">
					<td colspan="2">&nbsp;</td>
				</tr>

				<tr>
					<td>Category Administrator <em>(set a Front-End Administrator for this Category) </em>:<br />
					- - <small>(NOTE: This user has Moderator privileges in all groups under this Category)</small>
					</td>
					<td>
						<?php 
						$users = array();
						$users[] = mosHTML::makeOption( '0', 'Select Administrator' );
						$database->setQuery( "SELECT id AS value, name AS text FROM #__users" );
						$users = array_merge( $users, $database->loadObjectList() );
						$html = mosHTML::selectList( $users, 'admin', 'size="1" class="inputbox"', 'value', 'text', $row->admin );
						echo $html;
						?>
					</td>
				</tr>

				<tr>
					<td>Category Access to users <em>(set the Joomla! access level required to view this Category)</em> ?:</td>
					<td>
						<?php echo $lists['access']; ?>
					</td>
				</tr>

				<tr>
					<td>Category Logo <em>(upload image for Category) </em>: </td>
					<td><input type="file" name="image_file_cat" size="20"></td>
				</tr>

				<tr>
					<td>Publish this Category:</td>
					<td><?php echo mosHTML::yesnoSelectList( "published", "", $row->published ); ?></td>
				</tr>
				<tr>
					<th colspan="3">&nbsp;</th>
				</tr>
			</table>

			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
		</form>
	<?php }


function listGroup( $option, &$rows, $pageNav) {
?>
	<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th>
				GroupJive :: Groups Manager
				</th>
				<td>&nbsp;
				
				</td>
				<td>&nbsp;
				
				</td>
				<td width="right">&nbsp;
				
				</td>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
				<th class="title" >Group</th>
				<th width="20%" class="title">Grouptype</th>
				<th width="20%" class="title">Category</th>
				<th width="20">Publish</th>
			</tr>

<?php
			$desc = array( 1 => GJ_OPEN, 2 => GJ_APREQUIRED, 3 => GJ_PRIVATE );
			$k = 0;
			for($i=0; $i < count( $rows ); $i++) {
				$row = $rows[$i];
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td >
						<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
					</td>
					<td>
						<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editgroup')"><?php echo $row->name; ?></a>
					</td>
					<td><?php echo $desc[$row->type] ?></td>
					<td><?php echo $row->catname ?></td>
					<td align="center">
					<?php
						if ($row->active == "1") {
							echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublishgroup')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
						} else {
							echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publishgroup')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
						}
					?>
					</td>
					<?php $k = 1 - $k; ?>
				</tr>
			<?php 
			} 
?>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="groupsmanager" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo $pageNav->getListFooter(); ?>
		<?php mosCommonHTML::ContentLegend(); ?>
	</form> 
<?php } 


/*This is the form for editing and creating new groups in the backend*/
function editGroup( $option, &$row ) {
	global $database, $mainframe;
?>
	<form action="index2.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
		<table class="adminheading">
			<tr>
				<th>
				Group:
				<small>
				<?php echo $row->id ? 'Edit' : 'New';?>
				</small>
				</th>
			</tr>
		</table>

		<table class="adminform" width="60%" align="left">
			<tr>
				<th colspan="2">Group Details</th>
				<th>Group Logo Image</th>
			</tr>
			<tr>
				<td>Category for this Group :<br />
				- - <small><em>(all Groups must be placed inside a Category)</em></small><br />
				- - <small><em>(Category settings control which Groups Types are allowed)</em></small><br />
				- - <small><em>(GO TO Category Settings to configure Categories)</em></small>
				</td>
				<td>
					<?php 
					$cat = array();
					// $cat[] = mosHTML:makeOption( '0', 'Select Category' );
					$database->setQuery( "SELECT id AS value, catname AS text, "
						. "create_open, create_closed, create_invite "
						. "FROM #__gj_grcategory" );
					$rows = $database->loadObjectList();
					$cat = array_merge( $cat, $rows );

					// data for javascript
					foreach( $rows as $val ) {
						$typeCat .= "typeCat[".$val->value."] = new Array();\n";
						$typeCat .= "typeCat[".$val->value."][0]=". $val->create_open . ";\n";
						$typeCat .= "typeCat[".$val->value."][1]=". $val->create_closed . ";\n";
						$typeCat .= "typeCat[".$val->value."][2]=". $val->create_invite . ";\n";
					}

					// create the Javascript output
					$tmpl =& HTML_wg::createTemplate();
					$tmpl->readTemplatesFromInput('script.tmpl');
					$tmpl->addVar( 'javascript', 'GJ_TYPECAT', $typeCat);

					// put the javascript into the head-section
					$tmpl->displayParsedTemplate('javascript');
					$desc = array( GJ_OPEN, GJ_APREQUIRED, GJ_PRIVATE  );
					$field = array("create_open", "create_closed", "create_invite");
					$options = array();
	
					$ind = 0;
					foreach( $rows as $key => $val ) {
						if( $val->value == $row->category) {
							$ind = $key;
							break;
						}
					}

					$o = $rows[$ind];
					for( $i = 0; $i < 3; $i++ ) {
						$f = $field[$i];
						if( $o->$f ) {
							$gj_option = new option;
							$gj_option->id = $i+1;
							$gj_option->text = $desc[$i];
							array_push($options, $gj_option);
						}
					}

					$html = mosHTML::selectList( $cat, 'category', 'size="1" class="inputbox" id="category" '
						. 'onchange="setTypes();"', 'value', 'text', $row->category );
					echo $html;
				?>
				</td>
			</tr>

			<tr>
				<td>Group Type: </td>
				<td>
					<?php echo mosHTML::selectList( $options, 'type', 'size="1" class="inputbox" id="type"', 
						'id', 'text', $row->type); ?>
				</td>
			</tr>

			<tr>
				<td>Group Name: </td>
				<td>
					<input size="30" name="name" id="name" value="<?php echo $row->name; ?>">
				</td>
				<td rowspan="7">
					<?php if ($row->logo != ''){echo '<p>Group Logo:</p><img src="../images/com_groupjive/'.$row->logo.'?ac='.time().'" />';} ?>
				</td>
			</tr>
			<tr>
				<td>Group Description: </td>
				<td>
					<textarea name="descr" id="descr" cols="40" rows="4" ><?php echo $row->descr?></textarea>
				</td>
			</tr>

			<tr>
				<td>Group Administrator <em>(set the Front-End Moderator for this Group) </em>: </td>
				<td>
					<?php 
					$users = array();
					$users[] = mosHTML::makeOption( '0', 'Select Administrator' );
					$database->setQuery( "SELECT id AS value, CONCAT(username,' (',name,')') AS text FROM #__users" );
					$users = array_merge( $users, $database->loadObjectList() );
					$html = mosHTML::selectList( $users, 'user_id', 'size="1" class="inputbox"', 'value', 'text', $row->user_id );
					echo $html;
					?>
				</td>
			</tr>
			<tr>
				<td>Group Logo <em>(upload image for Group) </em>:</td>
				<td>
					<input type="file" name="image_file" id="image_file" size="20" />
				</td>
			</tr>
			
			<tr>
				<td>Publish this Group: </td>
				<td><?php echo mosHTML::yesnoSelectList( "active", "", $row->active ); ?></td>
			</tr>
			
			<tr>
				<th colspan="3">&nbsp;</th>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
	</form>
<?php }

function editOptions( $option, &$row ) {
	global $database;
?>

	<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data" id="adminForm" class="adminForm">
		<?php
		$tabs = new mosTabs(0);
		?>
	
		<table class="adminheading">
			<tr>
				<th>
					GroupJive :: Settings
				</th>
				<td>&nbsp;
					
				</td>
				<td>&nbsp;
					
				</td>
				<td width="right">&nbsp;
					
				</td>
			</tr>
		</table>

<?php
		$tabs->startPane("configPane");
		$tabs->startTab("Global Setup","main-page");
?>

		<table class="adminform" width="60%" align="left">
			<tr>
				<th colspan="2">Set Global Options for GroupJive:</th>
			</tr>
			
			<tr class="row">
				<td colspan="2">&nbsp; </td>
			</tr>
			
			<tr class="row">
				<td colspan="2"><strong>Admin Notifications: </strong> </td>
			</tr>

			<tr class="row1">
				<td> Notify admin when a new group is created <em>(send email to admin) </em>: </td>
				<td>
				  <?php echo mosHTML::yesnoSelectList( "send_admin_emails", "", $row->send_admin_emails  ); ?>
				</td>
			</tr>
		
			<tr class="row">
				<td width="50%"> Email address to notify admin: </td>
				<td width="50%">
					<input size="30" name="admin_email" id="admin_email" value="<?php echo $row->admin_email; ?>">
				</td>
			</tr>

			<tr class="row">
				<td colspan="2">&nbsp; </td>
			</tr>

			<tr class="row">
				<td colspan="2"><strong>User Settings <small><em><span style="color:#009900">(go to Members Manager to add/delete and manage users)</span></em></small> : </strong></td>
			</tr>
	
			<tr class="row1">
				<td> Use <span style="text-decoration:underline">Real Name</span> instead of <span style="text-decoration:underline">username</span> for GroupJive Users... <em>(Real Name = Yes) </em>: </td>
				<td>
					<?php echo mosHTML::yesnoSelectList( "real_names", "", $row->real_names  ); ?>
				</td>
			</tr>

			<tr class="row">
				<td> Custom User Avatar - this is user image in GroupJive if user does not specify their own : <br />
				     <small> - - > <span style="color:#666666"><em>(note that user Avatars are generally assigned in Community Builder)</em></span></small>
				</td>
				<td>
					<input size="50" name="nophoto" id="nophoto" value="<?php echo $row->nophoto; ?>">
				</td>
			</tr>

			<tr class="row">
				<td colspan="2">&nbsp; </td>
			</tr>
	
			<tr class="row">
				<td colspan="2"><strong>Group Settings  <small><em><span style="color:#009900">(go to Groups Manager to add/delete and manage groups)</span></em></small> : </strong></td>
			</tr>

			<tr class="row1">
				<td> Invitations and Group notifications are sent using what method? <em>(Email -OR- Personal Messaging)</em></td>
 				<td><?php
					$pms[] = mosHTML::makeOption('email', 'Email - (default)');
					$pms[] = mosHTML::makeOption('uddeim', 'UddeIM - PMS');
					$pms[] = mosHTML::makeOption('mypms', 'MyPMS2 OS - PMS');
					$pms[] = mosHTML::makeOption('pmsenh', 'PMS Enhanced - PMS');
					$pms[] = mosHTML::makeOption('jim', 'Jim - PMS');
					$pms[] = mosHTML::makeOption('missus', 'Missus - PMS');
					$pms[] = mosHTML::makeOption('clexus', 'Clexus - PMS');
					echo mosHTML::selectList($pms, 'pms', 'size="1" class="text"', 'value', 'text', $row->pms);
					?>
				</td>
			</tr>
		
			<tr class="row">
				<td> Group Logo Image <em>(default image for all Groups if Group Creator does not upload new image) </em>: </td>
				<td>
					<?php
					if ($row->nophoto_logo) {
					echo '<img src="../images/com_groupjive/tn'
						. $row->nophoto_logo.'?anticache='.time().'" alt="Default Logo" '
						. 'style="vertical-align:middle"/>&nbsp;&nbsp;';
					}
					?>
					<input type="file" name="nophoto_logo" size="20">
				</td>
			</tr>

			<tr class="row1">
				<td> Group Logo Size &quot;in pixels&quot; as displayed on each Group's main page: </td>
				<td>
					<input size="3" name="logosize" id="logosize" value="<?php echo $row->logosize; ?>">
				</td>
			</tr>


			<tr class="row">
				<td> Display Number of Groups per page <em>(front-end view)</em> : </td>
				<td>
					<input size="3" name="onpage" id="onpage" value="<?php echo $row->onpage; ?>">
				</td>
			</tr>

			<tr class="row1">
				<td> Display Number of Group Members per page <em>(front-end view)</em> : </td>
				<td>
					<input size="3" name="onpage_members" id="onpage_members" value="<?php echo $row->onpage_members; ?>">
				</td>
			</tr>

			<tr class="row">
				<td colspan="2">&nbsp; </td>
			</tr>

			<tr class="row">
				<td colspan="2"><strong>Design Settings  <small><em><span style="color:#009900">(see templates folder in GroupJive component package - customize templates there)</span></em></small> : </strong></td>
			</tr>

			<tr class="row1">
				<?php
				if ($handle = opendir('../components/com_groupjive/templates')) {
					while (false !== ($file = readdir($handle))) {
						if ($file != "." && $file != ".." && is_dir('../components/com_groupjive/templates/'.$file)!=false) {
							$templates[] = mosHTML::makeOption($file, $file);
						}
					}
					closedir($handle);
				}
				?>
				<td> Template <em>(your preferred design template for GroupJive)</em> : </td>
				<td>
					<?php
					echo mosHTML::selectList($templates, 'template', 'size="1" class="text"', 'value', 'text', $row->template)
					?>
				</td>
			</tr>

			<tr class="row">
				<td colspan="2">&nbsp; </td>
			</tr>
		
			<tr class="row">
				<td colspan="2"><strong>Other: </strong></td>
			</tr>

			<tr class="row1">
				<td> Date Format <em>(order of year-month-day displayed in GroupJive)</em> : </td>
				<td>
					<input size="25" name="date_form" id="date_form" value="<?php echo $row->date_form; ?>"> should be something like "%Y-%m-%d %H:%i"
				</td>
			</tr>

			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
	</table>


	<?php
	$tabs->endTab();
	$tabs->startTab("Front End", "access-page");
	?>

	<table class="adminform" width="60%" align="left">
		<tr>
			<th colspan="2">Set Front-End user experience and group creation rights for GroupJive: </th>
		</tr>


		<tr class="row">
			<td colspan="2">&nbsp; </td>
		</tr>

		<tr class="row">
			<td colspan="2"><strong>Front-End Group Creation: </strong></td>
		</tr>
		
		<tr class="row1">
			<td>Allow Front-End users to *Create OWN Groups* ?: </td>
			<td><?php echo mosHTML::yesnoSelectList( "create_groups", "", $row->create_groups ); ?></td>
		</tr>

		<tr class="row">
			<td width="50%">Admin must approve Group Creation of all new Groups created through Front-End? : <br />
			- - > <small><em>(this requires Admin to continually log in and approve/publish Groups)</em></small> </td>
			<td width="50%"><?php echo mosHTML::yesnoSelectList( "approval", "", $row->approval); ?></td>
		</tr>


		<tr class="row">
			<td colspan="2">&nbsp; </td>
		</tr>

		<tr class="row">
			<td colspan="2"><strong>User Experience: </strong></td>
		</tr>

		<tr class="row1">
			<td>Do you want groupmembers to have the option of sending invites to persons not registered with your site?</td>
			<td><?php echo mosHTML::yesnoSelectList( "nonreg", "", $row->nonreg); ?></td>
		</tr>

		<tr class="row">
			<td>Do you want groupmembers to recieve a PM when a new user joins their group?</td>
			<td><?php echo mosHTML::yesnoSelectList( "notifyjoin", "", $row->notifyjoin); ?></td>
		</tr>

		<tr class="row1">
			<td>Do you want groupmembers to recieve a PM when a new bulletin message is posted? </td>
			<td><?php echo mosHTML::yesnoSelectList( "notify", "", $row->notify); ?></td>
		</tr>

		<tr class="row">
		        <td>Do you want  groups to be hidden from non-members on the group listing pages?</td>
			<td><?php echo mosHTML::yesnoSelectList( "hideprivate", "", $row->hideprivate); ?></td>
		</tr>

	        <tr class="row1">
		        <td>Do you want group administrators to be able to "force" users into groups by inviting them and then activate them without their consent?</td>
			<td><?php echo mosHTML::yesnoSelectList( "force_invite", "", $row->force_invite); ?></td>
		</tr>

		<tr class="row1">
			<td colspan="2">&nbsp; </td>
		</tr>

		<tr class="row1">
			<td colspan="2"><strong>Share info about GroupJive with Others: </strong></td>
		</tr>

		<tr class="row">
			<td>Display version and logo information about GroupJive at bottom of page? </td>
			<td><?php echo mosHTML::yesnoSelectList( "version", "", $row->version); ?></td>
		</tr>
							    
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</table>

	<?php 
	$tabs->endTab();
	$tabs->startTab("Integration", "integration-page");
	?>

	<table class="adminform" width="60%" align="left">
		<tr>
			<th colspan="2">Set Integration options here:</th>
		</tr>

		<tr class="row">
			<td colspan="2"><br/><strong>Bulletin Settings</strong></td>
		</tr>

		<tr class="row1">
			<td>Show Bulletinboard</td>
			<td>
				<?php echo mosHTML::yesnoSelectList( "bulletin", "", $row->bulletin); ?>
			</td>
		</tr>

		<tr class="row">
			<td> Only Group Owners can write bulletin messages: </td>
			<td>
				<?php echo mosHTML::yesnoSelectList( "bul_creator", "", $row->bul_creator  ); ?>
			</td>
		</tr>

		<tr class="row1">
			<td> Display Number of Bulletin Messages per page <em>(front-end view)</em> : </td>
			<td>
				<input size="3" name="blogm" id="blogm" value="<?php echo $row->blogm; ?>">
			</td>
		</tr>

		<tr class="row">
			<td colspan="2"><br/><strong>Eventlist integration</strong></td>
		</tr>

		<tr class="row1">
			<td>Integrate with Eventlist 0.8.10 alpha? <a href="index2.php?option=com_groupjive&task=updateevents">>Click here to update old groups<</a></td>
			<td>
				<?php echo mosHTML::yesnoSelectList( "eventlist", "", $row->eventlist); ?> ... please review <a href="components/com_groupjive/readme_eventlist.txt" target="_blank">readme_eventlist.txt</a> in installation package before integrating EventList.
			</td>
		</tr>

	      <tr class="row">
			<td> Display Number of Events in group overview <em>(front-end view)</em> : </td>
			<td>
				<input size="3" name="el_count" id="el_count" value="<?php echo $row->el_count; ?>">
			</td>
		</tr>

		<tr class="row1">
			<td colspan="2"><br/><strong>Fireboard integration</strong></td>
		</tr>

		<tr class="row">
			<td width="50%">Integrate with FireBoard? <a href="index2.php?option=com_groupjive&task=updateforum">>Click here to update old groups<</a></td>
			<td width="50%"><?php echo mosHTML::yesnoSelectList( "jb", "", $row->jb); ?> ... please review <a href="components/com_groupjive/readme_fireboard.txt" target="_blank">readme_fireboard.txt</a> in install package before integrating FireBoard.</td>
		</tr>

		<tr class="row1">
			<td>Assign an unpublished FireBoard Category to GroupJive. Please enter the catid # : </td>
			<td>
				<input size="3" name="jb_cat" id="jb_cat" value="<?php echo $row->jb_cat; ?>">
			</td>
		</tr>

		<tr class="row">
			<td> Display Number of Forum posts in group overview <em>(front-end view)</em> : </td>
			<td>
				<input size="3" name="jb_count" id="jb_count" value="<?php echo $row->jb_count; ?>">
			</td>
		</tr>

		<tr class="row1">
			<td colspan="2"><br/><strong>JomComment integration</strong></td>
		</tr>

		<tr class="row">
			<td>Integrate JomComment</td>
			<td>
				<?php echo mosHTML::yesnoSelectList( "jomcomment", "", $row->jomcomment); ?>
			</td>
		</tr>

		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</table>
	<?php
	$tabs->endTab();
	$tabs->startTab("WYSIWYG", "wysiwyg-page");
	?>

	<table class="adminform" width="60%" align="left">
		<tr>
			<th colspan="2">Set WYSIWYG options for GroupJive:</th>
		</tr>

		<tr class="row">
			<td width="50%">Group Bulletins will use the global WYSIWYG editor?</td>
			<td width="50%"><?php echo mosHTML::yesnoSelectList( "wysiwyg", "", $row->wysiwyg); ?> &nbsp; **NOTE: many third party WYSIWYG editors have built in sizing controls. Please use the sizing controls in your WYSIWYG editor if this setting is YES.</td>
		</tr>

		<tr class="row1">
<td><strong><em>the following parameters apply only if &quot; use Global WYSIWYG &quot; setting is *NO*</em></strong></td>
<td>&nbsp;
				
			</td>
		</tr>

		<tr class="row">
			<td> - - Width of editor (<em>simple editor type only</em>): </td>
			<td>
				<input size="3" name="wysiwyg_width" id="wysiwyg_width" value="<?php echo $row->wysiwyg_width; ?>">
			</td>
		</tr>

		<tr class="row1">
			<td> - - Height of editor (<em>simple editor type only</em>): </td>
			<td>
				<input size="3" name="wysiwyg_height" id="wysiwyg_height" value="<?php echo $row->wysiwyg_height; ?>">
			</td>
		</tr>

		<tr class="row">
			<td> - - Number of Rows in Editor (<em>simple editor type only</em>): </td>
			<td>
				<input size="3" name="wysiwyg_rows" id="wysiwyg_rows" value="<?php echo $row->wysiwyg_rows; ?>">
			</td>
		</tr>

		<tr class="row1">
			<td> - - Number of Columns in Editor (<em>simple editor type only</em>): </td>
			<td>
				<input size="3" name="wysiwyg_cols" id="wysiwyg_cols" value="<?php echo $row->wysiwyg_cols; ?>">
			</td>
		</tr>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</table>

	<?php 
	$tabs->endTab();
	$tabs->startTab("AJAX", "ajax-page");
	?>

	<table class="adminform" width="60%" align="left">
		<tr>
			<th colspan="2">Set AJAX options for GroupJive:</th>
		</tr>

		<tr class="row">
			<td width="50%">User Invite function uses Ajax features ?:</td>
			<td width="50%"><?php echo mosHTML::yesnoSelectList( "ajax_active", "", $row->ajax_active); ?></td>
		</tr>

		<tr class="row1">
			<td>Text displayed while Ajax loads data (ex. &quot;Loading Data&quot;) ?: </td>
			<td>
				<input size="25" name="ajax_message" id="ajax_message" value="<?php echo $row->ajax_message; ?>">
			</td>
		</tr>

		<tr class="row">
			<td>Ajax features experienced with what Joomla! access level ?: </td>
			<td>
				<?php $query = "SELECT id AS value, name AS text"
						. "\n FROM #__groups"
						. "\n ORDER BY id";
					$database->setQuery( $query );
					$groups = $database->loadObjectList();
					echo mosHTML::selectList( $groups, 'ajax_access', 'class="inputbox" size="3"', 'value', 'text', intval( $row->ajax_access ) ); ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</table>

	<?php 
	$tabs->endTab();
	$tabs->startTab("About Us", "aboutteam-page");
	?>

	<table class="adminform" width="60%" align="left">
		<tr>
			<th colspan="3" align="left">GroupJive Developers (our team):</th>
		</tr>

		<tr class="row">
			<td colspan="3"><br /><strong>The People who bring you GroupJive</strong></td>
		</tr>

		<tr class="row1">
			<td colspan="3">
			<p>GroupJive is developed in the Open Source community. In appreciation of the hard work, ideas and 
			talent of our contributors, GroupJive thanks the community. This includes the people who contribute
			to <a href="http://groupjive.org">http://groupjive.org</a>, every person that has ever contributed code to the project and most important of all...
			<span style="color:#009933">GroupJive thanks it's <big>Users &nbsp; :)</big></span></p>
			<p>In working with people, GroupJive aspires to this goal: &nbsp;<span style="font-size:larger">to provide a friendly, informative and fun environment for all our users.</span>
			<br /> We hope you find your experience with GroupJive enjoyable. We feel the community at GroupJive is very supportive. Please seek them out as persons who
			like to help and for support with your installations.</p>			</td>
		</tr>

		<tr class="row">
			<td><br /><strong>Custom Development</strong></td>
		</tr>
	
		<tr class="row1">
			<td colspan="2" valign="top">
			<p>If you find that your needs for GroupJive, for Joomla! or for any other project on the internet would benefit from professional services?
			<br />The GroupJive Team serves these needs. Talk to us:
			<ul>
			  <li>custom development</li>
			  <li>site contruction</li>
			  <li>design</li>
			  <li>social networks</li>
			  <li>extending the core functionality of Groups</li>
			  <li>support</li>
			</ul>
			We consult, develop, design and expand upon GroupJive
			as needed for web sites around the world. Contact us directly or through GroupJive.org to inquire about hiring
			team members to expand your possibilities in Joomla! and in social networking on the internet.
			<br />
			<br /><em>GroupJive itself is a freely available component to the community</em>.</p>			</td>
			<td width="50%">
				<table align="center">
					<tr class="row">
						<td colspan="2" style="text-align:center"><br /><h4>GroupJive Core is: </h4></td>
					</tr>
					<tr class="row">
						<td style="text-align:right"> (<span style="color:#FF9900">fluffy5</span>) <strong>Anna Tannenberg</strong></td>
						<td>- &nbsp; Developer </td>
					</tr>
					<tr class="row">
						<td style="text-align:right">  (<span style="color:#FF3300">stiggi</span>) <strong>Micha Perthel</strong></td>
						<td>- &nbsp; Developer </td>
					</tr>

					<tr class="row">
						<td style="text-align:right"> (<span style="color:#009933">wwvine</span>) <strong>Mark Raborn </strong></td>
						<td>- &nbsp; Designer / Program Manager</td>
					</tr>
					<tr class="row">
						<td style="text-align:right"><em>Contact us individually or the entire team at:</em></td>
						<td>&nbsp;<a href="mailto:team@groupjive.org">team@groupjive.org</a></td>
					</tr>
					<tr class="row">
						<td style="text-align:right"> (<span style="color:#999999">HolmesSPH</span>) <strong>Joshua Holmes </strong></td>
						<td>- &nbsp; Founder <em>(inactive)</em></td>
					</tr>
					<tr class="row">
						<td style="text-align:right"> (<span style="color:#999999">david</span>) <strong>David Freund </strong></td>
						<td>- &nbsp; Team Member <em>(inactive)</em></td>
					</tr>						
					<tr class="row">
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr class="row">
						<td colspan="2" style="text-align:center"><em><span style="color:#009933">Thank you for choosing GroupJive</span></em></td>
					</tr>
					<tr class="row">
						<td colspan="2" style="text-align:center"><big><a href="http://groupjive.org">http://groupjive.org</a></big></td>
					</tr>
					<tr class="row">
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
	
		<tr class="row">
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<th colspan="3">&nbsp;</th>
		</tr>
	</table>

	<?php 
	$tabs->endTab();
	$tabs->endPane();
	?>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
</form>
<?php }

function showOverview($flag = 'overview', $readme='readme.txt') {
	// just to have only something here - needs some more work
	echo '<table class="adminheading" border="0">'
		.'<tr><th class="cpanel"><a href="index2.php?option=com_groupjive">Groupjive Control Panel</a>'
		.'</th></tr></table>';
	echo '<table class="adminform"><tr><td width="40%" valign="top">';
	echo '<div id="cpanel">';
	$link="index2.php?option=com_groupjive&amp;task=settings";
	echo makeIcon($link, 'cpanel.png', 'GroupJive Settings');

	$link="index2.php?option=com_groupjive&amp;task=categoriesmanager";
	echo makeIcon($link, 'categories.png', 'Category Manager');
	
	$link="index2.php?option=com_groupjive&amp;task=groupsmanager";
	echo makeIcon($link, 'addusers.png', 'Groups Manager');
	
	$link="index2.php?option=com_groupjive&amp;task=membersmanager";
	echo makeIcon($link, 'user.png', 'Members Manager');

	$link="index2.php?option=com_groupjive&amp;task=readme";
	echo makeIcon($link, 'generic.png', 'Readme');

	echo '<div style="clear:both;float:left; width:100%; text-align:left; padding-top:10px; text-indent:5px"><p><em style="color:green">Thank you for using Groupjive.</em></p></div>';
	echo '</div>';
	echo '</td><td width="60%" valign="top">';
	if ($flag == 'overview') {
		echo '<img style="padding-right: 10px;" src="../components/com_groupjive/images/box_groupjive.jpg" alt="Groupjive Box" align="left" height="250" width="117"><p><a href="http://www.groupjive.org" target="_blank">Groupjive</a> is a <a target="_blank" href="http://www.joomla.org">Joomla!</a> component and is developed for use in any social networking site built for the Joomla! CMS. To use GroupJive, <a target="_blank" href="http://www.joomlapolis.com">Community Builder</a> or <a target="_blank" href="http://www.kolloczek.com">Community Builder Enhanced</a> must be installed!</p><p>GroupJive gives all registered users the ability to create and moderate their own groups. There are currently three types of groups which can be created: Open to all, Approval needed to join, and Invite only. GroupJive also integrates with other components. See the Readme file for more information.</p><p><a href="http://www.groupjive.org" target="_blank">Groupjive</a> is licensed under <a target="_blank" href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>.</p><p>You can help us to improve the component by contributing ideas and experiences in our Forums, making Feature Request and reporting Bugs at our development site <a href="http://joomlacode.org/gf/project/groupjive">ProjectGroupJive</a>. If you have problems with <a href="http://www.groupjive.org" target="_blank">Groupjive</a>, please ask questions in the support forum.</p><p><a href="http://www.groupjive.org/index.php?option=com_comprofiler&task=registers" target="_blank">Register</a> at GroupJive to stay informed and contact us by email if you are interested in GroupJive development. We do serve software and site development in the Joomla! community. <em>Thank you.</em></p>';
		echo '<p>Contact: <a href="mailto:team@groupjive.org">team@groupjive.org</a></p>';
	} else if ($flag == 'readme') {
		$dir = './components/com_groupjive/';
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if (filetype($dir.$file)=='file' && ereg('.*\.txt$', $file )) {
					$readmes[] = mosHTML::makeOption($file, $file);
				}
			}
			closedir($handle);
		}
		echo '<form action="index2.php" method="post" name="adminForm">';
		echo mosHTML::selectList($readmes, 'readme', 'size="1" class="text" id="readme"', 'value', 'text', $readme);
		echo '<input type="hidden" name="option" value="com_groupjive" />';
		echo '<input type="hidden" name="task" value="readme" />';
		echo '<input type="button" value="Show" onclick="submit();">';
		echo "</form>";
		echo '<pre>';
		if (file_exists(GJBASEPATH.'/'.$readme)){
			echo htmlspecialchars(file_get_contents(GJBASEPATH.'/'.$readme));
		}
		
		echo '</pre>';
	}
	echo '</td></tr></table>';
}

	/*Here we go with the member manager. This function has been "stolen" from the core user manager in Joomla!.*/
 function showMembers ( &$rows, $pageNav, $search, $option, $lists, $task ) {
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="user">
			Member Manager <br /><small>(select members ~ then choose action above)</small>
			</th>
			<td></td>
			<td>Filter by<br />Name/Username<br />(press enter):</td>
			<td>Groups List (drop down)<br /><em>Select a Group. This displays users in</em><br/><em>the selected Group only.</em></td>
			<td></td>
			</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
			<input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
			<td width="right">
			<?php echo $lists['type'];?>
			</td>
			<td width="right">
			    </td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="2%" class="title">
			#
			</th>
			<th width="3%" class="title">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th width="15%" class="title">
			Name
			</th>
			<th width="15%" class="title" >
			Username
			</th>
			<th width="49%" class="title">
			Member of Groups
			</th>
			<th width="15%" class="title">
			E-Mail
			</th>
			<th width="1%" class="title">
			ID
			</th>
		</tr>
		<?php
		$k = 0;
     
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	=& $rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $i+1+$pageNav->limitstart;?>
				</td>
				<td>
				<?php echo mosHTML::idBox( $i, $row->id ); ?>
				</td>
				<td>
				
				<?php echo $row->name; ?>
				
				<td>
				<?php echo $row->username; ?>
				</td>
				</td>
				    <td>
				<?php echo $row->groupname; ?>
				</td>
				<td>
				<a href="mailto:<?php echo $row->email; ?>">
				<?php echo $row->email; ?>
				</a>
				</td>
				<td>
				<?php echo $row->id; ?>
				</td>
			</tr>
				    <?php 
	
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="<?php echo $task;?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
		   }

 function addMembers($rows, $option, $task, $cid) { ?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="user">
			member(s) ready ~> please confirm Group(s) and [ complete! ]
			</th>
		   </tr>
		   <tr>
		   <td>The member(s) selected on the previous screen will be applied to the Group selections made below.
		   </td>
		   </tr>
		   </table>
		<table class="adminlist">
		<tr>
			<th width="2%" class="title">
			#
			</th>
			<th width="3%" class="title">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th width="15%" class="title">
			Name
			</th>
		   	<th width="79%" class="title">
			Description
			</th>
			<th width="1%" class="title">
			ID
			</th>
		</tr>
		<?php
		$k = 0;
     
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	=& $rows[$i];
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
			   <?php echo $i+1+$pageNav->limitstart;?>
			   </td>
				<td>
				<?php echo mosHTML::idBox( $i, $row->id ); ?>
			       </td>
				   <td>
				<a href="<?php echo $link; ?>">
				   <?php echo $row->name; ?>
				   </a>
				       </td>
				       <td>
				       <?php echo $row->descr; ?>
				       </td>
					   <td>
					   <?php echo $row->id; ?>
					   </td>
					       </tr>
					       <?php 
					       
					       $k = 1 - $k;
		}
		  ?>
							       </table>
								   
								   <input type="hidden" name="option" value="<?php echo $option;?>" />
								   <input type="hidden" name="task" value="<?php echo $task;?>" />
								   <?php echo buildArray($cid); ?>      
								   <input type="hidden" name="boxchecked" value="0" /> 
								      <input type="hidden" name="hidemainmenu" value="0" />
								      
								      </form>
								      <?php
								      }

} // end class

function makeIcon( $link, $image, $text ) {
	$icon="<div style=\"float:left;\">"
		."\n<div class=\"icon\">"
		."\n<a href=\"$link\">"
		."\n<img src=\"images/$image\" alt=\"$text\" align=\"middle\" border=\"0\"/>"
		."\n<span>$text</span>"
		."\n</a></div></div>";
	return $icon;

}

function buildArray($cid) {
  $array = '';
  for($i=0; $i < count($cid); $i++) {
	  $array .= '<input type="hidden" name="uid[]" value="'.$cid[$i].'" />';
  }
  return $array;
}
?>
