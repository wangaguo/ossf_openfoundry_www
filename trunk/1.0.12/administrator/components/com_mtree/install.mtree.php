<?php

require_once( 'components/com_mtree/admin.mtree.class.php' );

function com_install() {

	# Perform fresh install
	return new_install();

}

function new_install() {
	global $database, $mosConfig_mailfrom;

	$msg = '<table width="100%" border="0" cellpadding="8" cellspacing="0"><tr width="100%"><td align="center" valign="top"><center><img width="230" height="103" src="../components/com_mtree/img/logo_mtree.gif" alt="Mosets Tree" /></center></td></tr>';
	$msg .= '<tr><td align="left" valign="top"><center><h3>Mosets Tree v'.mt_version.'</h3><h4>A flexible directory component for Mambo</h4><font class="small">&copy; Copyright 2005 by Mosets Consulting. <a href="http://www.mosets.com/">http://www.mosets.com/</a><br/></font></center><br />';
	$msg .= "<fieldset style=\"border: 1px dashed #C0C0C0;\"><legend>Details</legend>";

	# Change Admin Icon to Mosets icon
	$database->setQuery("UPDATE #__components SET admin_menu_img='../components/com_mtree/img/favicon.png' WHERE admin_menu_link='option=com_mtree'");
	$database->query();

	# Assigning default config
	$row = new mtConfig();
	//	$row->imgsize_standard='400';
	$row->template='bluetree_business';
	$row->language='english';
	$row->map='googlemaps';
	$row->admin_email=$mosConfig_mailfrom;
	$row->listing_image_dir='/components/com_mtree/img/listings/';
	$row->cat_image_dir='/components/com_mtree/img/cats/';
	$row->resize_method='gd2';
	$row->resize_quality='60';
	$row->resize_listing_size='120';
	$row->img_impath='';
	$row->img_netpbmpath='';
	$row->resize_cat_size='80';
	$row->first_cat_order1='cat_name';
	$row->first_cat_order2='asc';
	$row->second_cat_order1='cat_name';
	$row->second_cat_order2='desc';
	$row->first_listing_order1='link_featured';
	$row->first_listing_order2='desc';
	$row->second_listing_order1='link_name';
	$row->second_listing_order2='asc';
	$row->fulltext_search='0';
	$row->first_search_order1='link_featured';
	$row->first_search_order2='desc';
	$row->second_search_order1='link_hits';
	$row->second_search_order2='desc';
	$row->display_empty_cat='1';
	$row->display_alpha_index='1';
	$row->display_listings_in_root='1';
	$row->display_listing_count_in_root='0';
	$row->display_cat_count_in_root='0';
	$row->show_map='1';
	$row->show_print='1';
	$row->show_recommend='1';
	$row->show_rating='1';
	$row->show_review='1';
	$row->show_visit='1';
	$row->show_contact='1';
	$row->use_owner_email='1';
	$row->show_report='1';
	$row->show_email='1';
	$row->show_claim='0';
	$row->show_ownerlisting='1';
	$row->fe_num_of_subcats='3';
	$row->fe_num_of_chars='220';
	$row->fe_num_of_links='10';
	$row->fe_num_of_reviews='10';
	$row->fe_num_of_popularlisting='10';
	$row->fe_num_of_newlisting='10';
	$row->fe_total_newlisting='20';
	$row->fe_num_of_mostrated='10';
	$row->fe_num_of_toprated='10';
	$row->fe_num_of_mostreview='10';
	$row->fe_num_of_searchresults='10';
	$row->fe_num_of_featured='10';
	$row->rate_once='1';
	$row->min_votes_for_toprated='1';
	$row->min_votes_to_show_rating='1';
	$row->user_review_once='1';
	$row->user_rating='0';
	$row->user_review='0';
	$row->user_recommend='0';
	$row->user_addlisting='0';
	$row->user_addcategory='0';
	$row->user_allowmodify='1';
	$row->user_allowdelete='1';
	$row->needapproval_addlisting='1';
	$row->needapproval_modifylisting='1';
	$row->needapproval_addcategory='1';
	$row->needapproval_addreview='1';
	$row->link_new='7';
	$row->link_popular='50';
	$row->hit_lag='86400';
	$row->notifyuser_newlisting='1';
	$row->notifyadmin_newlisting='1';
	$row->notifyuser_modifylisting='1';
	$row->notifyadmin_modifylisting='1';
	$row->notifyadmin_newreview='1';
	$row->notifyuser_approved='1';
	$row->notifyuser_review_approved='1';
	$row->notifyadmin_delete='1';
	$row->use_internal_notes='1';
	$row->allow_html='1';
	$row->allow_imgupload='1';
	$row->search_link_name='1';
	$row->search_link_desc='1';
	$row->search_address='0';
	$row->search_city='0';
	$row->search_postcode='0';
	$row->search_state='0';
	$row->search_country='0';
	$row->search_email='0';
	$row->search_website='0';
	$row->search_telephone='0';
	$row->search_fax='0';
	$row->search_metakey='0';
	$row->search_metadesc='0';
	$row->admin_use_explorer='1';
	$row->explorer_tree_level='9';
	$row->fullmenu_tree_level='9';
	# End of config

	# Write Configuration to file
	$config = "<?php\n";
	$config .= $row->getVarText();
	$config .= "?>";

	if ($fp = fopen("components/com_mtree/config.mtree.php", "w")) {
		fputs($fp, $config, strlen($config));
		fclose ($fp);
		$msg .= "<font color='green'>OK</font> &nbsp; Updated configuration file<br />";
	} else {
		$msg = "<font color=red>FAILED</font> &nbsp; An Error Has Occurred! Unable to open config file to write!<br />";
	}

	global $mosConfig_absolute_path;
	
	$msg .= '<br />';
	$msg .= (is_writable( $mosConfig_absolute_path.$row->listing_image_dir ) ? '<b><font color="green">Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>');
	$msg .= ' &nbsp;'.$mosConfig_absolute_path.$row->listing_image_dir . '<br />';

	$msg .= (is_writable( $mosConfig_absolute_path.$row->cat_image_dir ) ? '<b><font color="green">Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>');
	$msg .= ' &nbsp;'.$mosConfig_absolute_path.$row->cat_image_dir . '<br />';

	$msg .= "<br /><font color='green'>OK &nbsp; Mosets Tree Installed Successfully!</font></fieldset>";
	$msg .= "<p /><a href=\"index2.php?option=com_mtree\">Run Mosets Tree now!</a>";
	$msg .='<br /><br /></td></tr></table>';

	mosets_mail( "mtree", "Mosets Tree" );

	return $msg ;
} 

function mosets_mail( $name, $product ) {
	// Send notice of installation information to Mosets
	global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_lang, $my, $version;

	$email_to= $name.".install@mosets.com";

	global $database, $my; 
	$sql = "SELECT * FROM `#__users` WHERE id = $my->id LIMIT 1"; 
	$database->setQuery( $sql ); 
	$u_rows = $database->loadObjectList(); 

	$text = "There was an installation of **" . $product ."** \r \n at " 
	. $mosConfig_live_site . " with version: " . mt_version . "  \r \n"
	. "Username: " . $u_rows[0]->username . "\r \n"
	. "Email: " . $u_rows[0]->email . "\r \n"
	. "Referer: " . $_SERVER['HTTP_REFERER']. "\r \n"
	. "Language: " . $mosConfig_lang . "\r \n"
	. "Mambo version: " . $version . "\r \n";

	$subject = " Installation at: " .$mosConfig_sitename;
	$headers = "MIME-Version: 1.0\r \n";
	$headers .= "From: ".$u_rows[0]->username." <".$u_rows[0]->email.">\r \n";
	$headers .= "Reply-To: <".$email_to.">\r \n";
	$headers .= "X-Priority: 1\r \n";
	$headers .= "X-MSMail-Priority: High\r \n";
	$headers .= "X-Mailer: Mambo 4.5 on " .
	$mosConfig_sitename . "\r \n";

	@mail($email_to, $subject, $text, $headers);
}

?>
