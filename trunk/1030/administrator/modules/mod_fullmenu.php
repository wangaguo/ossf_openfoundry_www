<?php
/**
* @version $Id: mod_fullmenu.php 6070 2006-12-20 02:09:09Z robs $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

if (!defined( '_JOS_FULLMENU_MODULE' )) {
	/** ensure that functions are declared only once */
	define( '_JOS_FULLMENU_MODULE', 1 );

/**
* Full DHTML Admnistrator Menus
* @package Joomla
*/
class mosFullAdminMenu {
	/**
	* Show the menu
	* @param string The current user type
	*/
	function show( $usertype='' ) {
		global $acl, $database;
		global $mosConfig_live_site, $mosConfig_enable_stats, $mosConfig_caching;
		global $_LANG;

		// cache some acl checks
		$canConfig 			= $acl->acl_check( 'administration', 'config', 'users', $usertype );

		$manageTemplates 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_templates' );
		$manageTrash 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_trash' );
		$manageMenuMan 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_menumanager' );
		$manageLanguages 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_languages' );
		$installModules 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$installComponents 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$canMassMail 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );

		$query = "SELECT a.id, a.title, a.name"
		. "\n FROM #__sections AS a"
		. "\n WHERE a.scope = 'content'"
		. "\n GROUP BY a.id"
		. "\n ORDER BY a.ordering"
		;
		$database->setQuery( $query );
		$sections = $database->loadObjectList();
		
		$menuTypes = mosAdminMenus::menutypes();
		?>
		<div id="myMenuID"></div>
		<script language="JavaScript" type="text/javascript">
		var myMenu =
		[
		<?php
	// Home Sub-Menu
?>			[null,'<?php echo $_LANG->_( "Home" ); ?>','index2.php',null,'<?php echo $_LANG->_( "Control Panel" ); ?>'],
			_cmSplit,
			<?php
	// Site Sub-Menu
?>			[null,'<?php echo $_LANG->_( "Site" ); ?>',null,null,'<?php echo $_LANG->_( "Site Management" ); ?>',
<?php
			if ($canConfig) {
?>				['<img src="../includes/js/ThemeOffice/config.png" />','<?php echo $_LANG->_( "Global Configuration" ); ?>','index2.php?option=com_config&hidemainmenu=1',null,'<?php echo $_LANG->_( "Configuration" ); ?>'],
<?php
			}
			if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/language.png" />','<?php echo $_LANG->_( "Language Manager" ); ?>',null,null,'<?php echo $_LANG->_( "Manage languages" ); ?>',
  					['<img src="../includes/js/ThemeOffice/language.png" />','<?php echo $_LANG->_( "Site Languages" ); ?>','index2.php?option=com_languages',null,'<?php echo $_LANG->_( "Manage Languages" ); ?>'],
   				],
<?php
			}
?>				['<img src="../includes/js/ThemeOffice/media.png" />','<?php echo $_LANG->_( "Media Manager" ); ?>','index2.php?option=com_media',null,'<?php echo $_LANG->_( "Manage Media Files" ); ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />', '<?php echo $_LANG->_( "Preview" ); ?>', null, null, '<?php echo $_LANG->_( "Preview" ); ?>',
					['<img src="../includes/js/ThemeOffice/preview.png" />','<?php echo $_LANG->_( "In New Window" ); ?>','<?php echo $mosConfig_live_site; ?>/index.php','_blank','<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />','<?php echo $_LANG->_( "Inline" ); ?>','index2.php?option=com_admin&task=preview',null,'<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" />','<?php echo $_LANG->_( "Inline with Positions" ); ?>','index2.php?option=com_admin&task=preview2',null,'<?php echo $mosConfig_live_site; ?>'],
				],
				['<img src="../includes/js/ThemeOffice/globe1.png" />', '<?php echo $_LANG->_( "Statistics" ); ?>', null, null, '<?php echo $_LANG->_( "Site Statistics" ); ?>',
<?php
			if ($mosConfig_enable_stats == 1) {
?>					['<img src="../includes/js/ThemeOffice/globe4.png" />', '<?php echo $_LANG->_( "Browser" ); ?>, OS, <?php echo $_LANG->_( "Domain" ); ?>', 'index2.php?option=com_statistics', null, '<?php echo $_LANG->_( "Browser" ); ?>, OS, <?php echo $_LANG->_( "Domain" ); ?>'],
<?php
			}
?>					['<img src="../includes/js/ThemeOffice/search_text.png" />', '<?php echo $_LANG->_( "Search Text" ); ?>', 'index2.php?option=com_statistics&task=searches', null, '<?php echo $_LANG->_( "Search Text" ); ?>']
				],
<?php
			if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $_LANG->_( "Template Manager" ); ?>',null,null,'<?php echo $_LANG->_( "Change site template" ); ?>',
  					['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $_LANG->_( "Site Templates" ); ?>','index2.php?option=com_templates',null,'<?php echo $_LANG->_( "Change site template" ); ?>'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $_LANG->_( "Administrator Templates" ); ?>','index2.php?option=com_templates&client=admin',null,'<?php echo $_LANG->_( "Change admin template" ); ?>'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" />','<?php echo $_LANG->_( "Module Positions" ); ?>','index2.php?option=com_templates&task=positions',null,'<?php echo $_LANG->_( "Template positions" ); ?>']
  				],
<?php
			}
			if ($manageTrash) {
?>				['<img src="../includes/js/ThemeOffice/trash.png" />','<?php echo $_LANG->_( "Trash Manager" ); ?>','index2.php?option=com_trash',null,'<?php echo $_LANG->_( "Manage Trash" ); ?>'],
<?php
			}
			if ($canManageUsers || $canMassMail) {
?>				['<img src="../includes/js/ThemeOffice/users.png" />','<?php echo $_LANG->_( "User Manager" ); ?>','index2.php?option=com_users&task=view',null,'<?php echo $_LANG->_( "Manage users" ); ?>'],
<?php
				}
?>			],
<?php
	// Menu Sub-Menu
?>			_cmSplit,
			[null,'<?php echo $_LANG->_( "Menu" ); ?>',null,null,'<?php echo $_LANG->_( "Menu Management" ); ?>',
<?php
			if ($manageMenuMan) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" />','<?php echo $_LANG->_( "Menu Manager" ); ?>','index2.php?option=com_menumanager',null,'<?php echo $_LANG->_( "Menu Manager" ); ?>'],
				_cmSplit,
<?php
			}
			foreach ( $menuTypes as $menuType ) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" />','<?php echo $menuType;?>','index2.php?option=com_menus&menutype=<?php echo $menuType;?>',null,''],
<?php
			}
?>			],
			_cmSplit,
<?php
	// Content Sub-Menu
?>			[null,'<?php echo $_LANG->_( "Content" ); ?>',null,null,'<?php echo $_LANG->_( "Content Management" ); ?>',
<?php
			if (count($sections) > 0) {
?>				['<img src="../includes/js/ThemeOffice/edit.png" />','<?php echo $_LANG->_( "Content by Section" ); ?>',null,null,'<?php echo $_LANG->_( "Content Managers" ); ?>',
<?php
				foreach ($sections as $section) {
					$txt = addslashes( $section->title ? $section->title : $section->name );
?>					['<img src="../includes/js/ThemeOffice/document.png" />','<?php echo $txt;?>', null, null,'<?php echo $txt;?>',
                        ['<img src="../includes/js/ThemeOffice/edit.png" />', '<?php echo $txt;?> - <?php echo $_LANG->_( "Items" ); ?>', 'index2.php?option=com_content&sectionid=<?php echo $section->id;?>',null,null],
                        ['<img src="../includes/js/ThemeOffice/backup.png" />', '<?php echo $txt;?> - <?php echo $_LANG->_( "Archive" ); ?>', 'index2.php?option=com_content&task=showarchive&sectionid=<?php echo $section->id;?>',null,null],
                        ['<img src="../includes/js/ThemeOffice/add_section.png" />', '<?php echo $txt;?> - <?php echo $_LANG->_( "Add/Edit" ); ?> <?php echo $_LANG->_( "Categories" ); ?>', 'index2.php?option=com_categories&section=<?php echo $section->id;?>',null, null],
				],
<?php
				} // foreach
?>				],
				_cmSplit,
<?php
			}
?>
				['<img src="../includes/js/ThemeOffice/edit.png" />','<?php echo $_LANG->_( "All Content Items" ); ?>','index2.php?option=com_content&sectionid=0',null,'<?php echo $_LANG->_( "Manage Content Items" ); ?>'],
  				['<img src="../includes/js/ThemeOffice/edit.png" />','<?php echo $_LANG->_( "Static Content Manager" ); ?>','index2.php?option=com_typedcontent',null,'<?php echo $_LANG->_( "Manage Typed Content Items" ); ?>'],
  				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/add_section.png" />','<?php echo $_LANG->_( "Section Manager" ); ?>','index2.php?option=com_sections&scope=content',null,'<?php echo $_LANG->_( "Manage Content Sections" ); ?>'],
				['<img src="../includes/js/ThemeOffice/add_section.png" />','<?php echo $_LANG->_( "Category Manager" ); ?>','index2.php?option=com_categories&section=content',null,'<?php echo $_LANG->_( "Manage Content Categories" ); ?>'],
				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/home.png" />','<?php echo $_LANG->_( "Frontpage Manager" ); ?>','index2.php?option=com_frontpage',null,'<?php echo $_LANG->_( "Manage Frontpage Items" ); ?>'],
  				['<img src="../includes/js/ThemeOffice/edit.png" />','<?php echo $_LANG->_( "Archive Manager" ); ?>','index2.php?option=com_content&task=showarchive&sectionid=0',null,'<?php echo $_LANG->_( "Manage Archive Items" ); ?>'],
                ['<img src="../includes/js/ThemeOffice/globe3.png" />', '<?php echo $_LANG->_( "Page Impressions" ); ?>', 'index2.php?option=com_statistics&task=pageimp', null, '<?php echo $_LANG->_( "Page Impressions" ); ?>'],
			],
<?php
	// Components Sub-Menu
	if ($installComponents) {
?>			_cmSplit,
			[null,'<?php echo $_LANG->_( "Components" ); ?>',null,null,'<?php echo $_LANG->_( "Component Management" ); ?>',
<?php
		$query = "SELECT *"
		. "\n FROM #__components"
		. "\n WHERE name != 'frontpage'"
		. "\n AND name != 'media manager'"
		. "\n ORDER BY ordering, name"
		;
		$database->setQuery( $query );
		$comps = $database->loadObjectList();	// component list
		$subs = array();	// sub menus
		// first pass to collect sub-menu items
		foreach ($comps as $row) {
			if ($row->parent) {
				if (!array_key_exists( $row->parent, $subs )) {
					$subs[$row->parent] = array();
				}
				$subs[$row->parent][] = $row;
			}
		}
		$topLevelLimit = 19; //You can get 19 top levels on a 800x600 Resolution
		$topLevelCount = 0;
		foreach ($comps as $row) {
			if ($editAllComponents | $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', $row->option )) {
				if ($row->parent == 0 && (trim( $row->admin_menu_link ) || array_key_exists( $row->id, $subs ))) {
					$topLevelCount++;
					if ($topLevelCount > $topLevelLimit) {
						continue;
					}
					$name = addslashes( $row->name );
					$alt = addslashes( $row->admin_menu_alt );
					$link = $row->admin_menu_link ? "'index2.php?$row->admin_menu_link'" : "null";
					echo "\t\t\t\t['<img src=\"../includes/$row->admin_menu_img\" />','$name',$link,null,'$alt'";
					if (array_key_exists( $row->id, $subs )) {
						foreach ($subs[$row->id] as $sub) {
							echo ",\n";
							$name = addslashes( $sub->name );
							$alt = addslashes( $sub->admin_menu_alt );
							$link = $sub->admin_menu_link ? "'index2.php?$sub->admin_menu_link'" : "null";
							echo "\t\t\t\t\t['<img src=\"../includes/$sub->admin_menu_img\" />','$name',$link,null,'$alt']";
						}
					}
					echo "\n\t\t\t\t],\n";
				}
			}
		}
		if ($topLevelLimit < $topLevelCount) {
			echo "\t\t\t\t['<img src=\"../includes/js/ThemeOffice/sections.png\" />',$_LANG->_( 'More Components' ),'index2.php?option=com_admin&task=listcomponents',null,$_LANG->_( 'More Components' )],\n";
		}
?>
			],
<?php
	// Modules Sub-Menu
		if ($installModules | $editAllModules) {
?>			_cmSplit,
			[null,'<?php echo $_LANG->_( "Modules" ); ?>',null,null,'<?php echo $_LANG->_( "Module Management" ); ?>',
<?php
			if ($editAllModules) {
?>				['<img src="../includes/js/ThemeOffice/module.png" />', '<?php echo $_LANG->_( "Site Modules" ); ?>', "index2.php?option=com_modules", null, '<?php echo $_LANG->_( "Manage Site modules" ); ?>'],
				['<img src="../includes/js/ThemeOffice/module.png" />', '<?php echo $_LANG->_( "Administrator Modules" ); ?>', "index2.php?option=com_modules&client=admin", null, '<?php echo $_LANG->_( "Manage Administrator modules" ); ?>'],
<?php
			}
?>			],
<?php
		} // if ($installModules | $editAllModules)
	} // if $installComponents
	// Mambots Sub-Menu
	if ($installMambots | $editAllMambots) {
?>			_cmSplit,
			[null,'<?php echo $_LANG->_( "Mambots" ); ?>',null,null,'<?php echo $_LANG->_( "Mambot Management" ); ?>',
<?php
		if ($editAllMambots) {
?>				['<img src="../includes/js/ThemeOffice/module.png" />', '<?php echo $_LANG->_( "Site Mambots" ); ?>', "index2.php?option=com_mambots", null, '<?php echo $_LANG->_( "Manage Site Mambots" ); ?>'],
<?php
		}
?>			],
<?php
	}
?>
<?php
	// Installer Sub-Menu
	if ($installModules) {
?>			_cmSplit,
			[null,'<?php echo $_LANG->_( "Installers" ); ?>',null,null,'<?php echo $_LANG->_( "Installer List" ); ?>',
<?php
		if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $_LANG->_( "Templates - Site" ); ?>','index2.php?option=com_installer&element=template&client=',null,'<?php echo $_LANG->_( "Install Site Templates" ); ?>'],
				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $_LANG->_( "Templates - Admin" ); ?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo $_LANG->_( "Install Administrator Templates" ); ?>'],
<?php
		}
		if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/install.png" />','<?php echo $_LANG->_( "Languages" ); ?>','index2.php?option=com_installer&element=language',null,'<?php echo $_LANG->_( "Install Languages" ); ?>'],
				_cmSplit,
<?php
		}
?>				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $_LANG->_( "Components" ); ?>','index2.php?option=com_installer&element=component',null,'<?php echo $_LANG->_( "Install/Uninstall Components" ); ?>'],
				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $_LANG->_( "Modules" ); ?>', 'index2.php?option=com_installer&element=module', null, '<?php echo $_LANG->_( "Install/Uninstall Modules" ); ?>'],
				['<img src="../includes/js/ThemeOffice/install.png" />', '<?php echo $_LANG->_( "Mambots" ); ?>', 'index2.php?option=com_installer&element=mambot', null, '<?php echo $_LANG->_( "Install/Uninstall Mambots" ); ?>'],
			],
<?php
	} // if ($installModules)
	// Messages Sub-Menu
	if ($canConfig) {
?>			_cmSplit,
  			[null,'<?php echo $_LANG->_( "Messages" ); ?>',null,null,'<?php echo $_LANG->_( "Messaging Management" ); ?>',
  				['<img src="../includes/js/ThemeOffice/messaging_inbox.png" />','<?php echo $_LANG->_( "Inbox" ); ?>','index2.php?option=com_messages',null,'<?php echo $_LANG->_( "Private Messages" ); ?>'],
  				['<img src="../includes/js/ThemeOffice/messaging_config.png" />','<?php echo $_LANG->_( "Configuration" ); ?>','index2.php?option=com_messages&task=config&hidemainmenu=1',null,'<?php echo $_LANG->_( "Configuration" ); ?>']
  			],
<?php
	// System Sub-Menu
    /*
?>			_cmSplit,
  			[null,'<?php echo $_LANG->_( "System" ); ?>',null,null,'<?php echo $_LANG->_( "System Management" ); ?>',
  			   ['<img src="../includes/js/ThemeOffice/joomla_16x16.png" />', 'Version Check', 'index2.php?option=com_admin&task=versioncheck', null,'Version Check'], 	   
  			   ['<img src="../includes/js/ThemeOffice/sysinfo.png" />', '<?php echo $_LANG->_( "System Info" ); ?>', 'index2.php?option=com_admin&task=sysinfo', null,'<?php echo $_LANG->_( "System Information" ); ?>'],

	<?php
		*/
	?>      _cmSplit,
	  			[null,'<?php echo $_LANG->_( "System" ); ?>',null,null,'<?php echo $_LANG->_( "System Management" ); ?>',
	  				['<img src="../includes/js/ThemeOffice/joomla_16x16.png" />', '<?php echo $_LANG->_( "Version Check" ); ?>', 'http://www.joomla.org/content/blogcategory/32/66/', '_blank','<?php echo $_LANG->_( "Version Check" ); ?>'], 				
	  				['<img src="../includes/js/ThemeOffice/sysinfo.png" />', '<?php echo $_LANG->_( "System Info" ); ?>', 'index2.php?option=com_admin&task=sysinfo', null,'<?php echo $_LANG->_( "System Info" ); ?>'],
<?php
  		if ($canConfig) {
?>				
['<img src="../includes/js/ThemeOffice/checkin.png" />', '<?php echo $_LANG->_( "Global Checkin" ); ?>', 'index2.php?option=com_checkin', null,'<?php echo $_LANG->_( "Check-in all checked-out items" ); ?>'],
<?php
			if ($mosConfig_caching) {
?>				['<img src="../includes/js/ThemeOffice/config.png" />','<?php echo $_LANG->_( "Clean Content Cache" ); ?>','index2.php?option=com_admin&task=clean_cache',null,'<?php echo $_LANG->_( "Clean the content items cache" ); ?>'],
				['<img src="../includes/js/ThemeOffice/config.png" />','<?php echo $_LANG->_( "Clean All Caches" ); ?>','index2.php?option=com_admin&task=clean_all_cache',null,'<?php echo $_LANG->_( "Clean all caches" ); ?>'],
<?php
			}
		}
?>			],
<?php
			}
?>			_cmSplit,
<?php
	// Help Sub-Menu
?>			[null,'<?php echo $_LANG->_( "Help" ); ?>','index2.php?option=com_admin&task=help',null,null]
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
		</script>
<?php
	}


	/**
	* Show an disbaled version of the menu, used in edit pages
	* @param string The current user type
	*/
	function showDisabled( $usertype='' ) {
		global $acl, $_LANG;

		$canConfig 			= $acl->acl_check( 'administration', 'config', 'users', $usertype );
		$installModules 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$installComponents 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$canMassMail 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );

		$text = 'Menu inactive for this Page';
		?>
		<div id="myMenuID" class="inactive"></div>
		<script language="JavaScript" type="text/javascript">
		var myMenu =
		[
		<?php
	/* Home Sub-Menu */
		?>
			[null,'<?php echo $_LANG->_( "Home" ); ?>',null,null,'<?php echo $text; ?>'],
			_cmSplit,
		<?php
	/* Site Sub-Menu */
		?>
			[null,'<?php echo $_LANG->_( "Site" ); ?>',null,null,'<?php echo $text; ?>'
			],
		<?php
	/* Menu Sub-Menu */
		?>
			_cmSplit,
			[null,'<?php echo $_LANG->_( "Menu" ); ?>',null,null,'<?php echo $text; ?>'
			],
			_cmSplit,
		<?php
	/* Content Sub-Menu */
		?>
 			[null,'<?php echo $_LANG->_( "Content" ); ?>',null,null,'<?php echo $text; ?>'
			],
		<?php
	/* Components Sub-Menu */
			if ( $installComponents) {
				?>
				_cmSplit,
				[null,'<?php echo $_LANG->_( "Components" ); ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			} // if $installComponents
			?>
		<?php
	/* Modules Sub-Menu */
			if ( $installModules | $editAllModules) {
				?>
				_cmSplit,
				[null,'<?php echo $_LANG->_( "Modules" ); ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			} // if ( $installModules | $editAllModules)
			?>
		<?php
	/* Mambots Sub-Menu */
			if ( $installMambots | $editAllMambots) {
				?>
				_cmSplit,
				[null,'<?php echo $_LANG->_( "Mambots" ); ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			} // if ( $installMambots | $editAllMambots)
			?>


			<?php
	/* Installer Sub-Menu */
			if ( $installModules) {
				?>
				_cmSplit,
				[null,'<?php echo $_LANG->_( "Installers" ); ?>',null,null,'<?php echo $text; ?>'
					<?php
					?>
				],
				<?php
			} // if ( $installModules)
			?>
			<?php
	/* Messages Sub-Menu */
			if ( $canConfig) {
				?>
				_cmSplit,
	  			[null,'<?php echo $_LANG->_( "Messages" ); ?>',null,null,'<?php echo $text; ?>'
	  			],
				<?php
			}
			?>

			<?php
	/* System Sub-Menu */
			if ( $canConfig) {
				?>
				_cmSplit,
	  			[null,'<?php echo $_LANG->_( "System" ); ?>',null,null,'<?php echo $text; ?>'
				],
				<?php
			}
			?>
			_cmSplit,
			<?php
	/* Help Sub-Menu */
			?>
			[null,'<?php echo $_LANG->_( "Help" ); ?>',null,null,'<?php echo $text; ?>']
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
		</script>
		<?php
	}
}
}
$cache =& mosCache::getCache( 'mos_fullmenu' );

$hide = intval( mosGetParam( $_REQUEST, 'hidemainmenu', 0 ) );

if ( $hide ) {
	mosFullAdminMenu::showDisabled( $my->usertype );
} else {
	mosFullAdminMenu::show( $my->usertype );
}
?>