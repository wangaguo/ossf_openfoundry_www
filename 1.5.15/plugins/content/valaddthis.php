<?php
/*
 * @version		1.3.0 (October 2010)
 * @package		Joomla
 * @subpackage	ValAddThis - Content Plugin (valaddthis)
 * @author		Chrysovalantis Mochlas (valandis@valandis.de)
 * @copyright	Copyright (C) 2010 by Chrysovalantis Mochlas (http://www.valandis.de)
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// load Joomla's library file with the definition of the JPlugin class
jimport('joomla.plugin.plugin');
  
class plgContentValAddThis extends JPlugin{

	//------------------------BEGIN--> ValAddThis plugin initialization
	function plgContentValAddThis(&$subject)
	{
		parent::__construct($subject);
		
		// get plugin's parameters
		$this->_plugin = JPluginHelper::getPlugin('content', 'valaddthis');
		$this->_params = new JParameter($this->_plugin->params);
	}
	//------------------------END--> ValAddThis plugin initialization
	
	//------------------------BEGIN--> function: Prepare content for ValAddThis
	function onPrepareContent( &$article, &$params, $limitstart )
	{
		//-----global params
		$this->_plugin_class = $this->_params->get('plugin_class');
		$this->_addthis_pub = $this->_params->get('addthis_pub');
		$this->_secure_server = $this->_params->get('secure_server');
		$this->_addthis_type = $this->_params->get('addthis_type');
		$this->_addthis_type_cat = $this->_params->get('addthis_type_cat');
		$this->_addthis_type_sec = $this->_params->get('addthis_type_sec');
		$this->_addthis_type_front = $this->_params->get('addthis_type_front');
		$addthis_position = $this->_params->get('addthis_position');
		$show_cat = $this->_params->get('show_cat');
		$show_sec = $this->_params->get('show_sec');
		$show_front = $this->_params->get('show_front');
		$filter_art = $this->_params->get('filter_art');
		$filter_cat = $this->_params->get('filter_cat');
		$filter_sec = $this->_params->get('filter_sec');
		$this->_html_before = $this->_params->get('html_before');
		$this->_html_after = $this->_params->get('html_after');
		
		$this->_services_compact = $this->_params->get('services_compact');
		$this->_services_expanded = $this->_params->get('services_expanded');
		$this->_services_exclude = $this->_params->get('services_exclude');
		$this->_ui_click = $this->_params->get('ui_click');
		$this->_ui_use_addressbook = $this->_params->get('ui_use_addressbook');
		$this->_data_track_linkback = $this->_params->get('data_track_linkback');
		$this->_data_use_flash = $this->_params->get('data_use_flash');
		$this->_data_use_cookies = $this->_params->get('data_use_cookies');
		$this->_ui_use_css = $this->_params->get('ui_use_css');
		
		$this->_ui_header_color = $this->_params->get('ui_header_color');
		$this->_ui_header_background = $this->_params->get('ui_header_background');
		$this->_ui_offset_top = $this->_params->get('ui_offset_top');
		$this->_ui_offset_left = $this->_params->get('ui_offset_left');
		$this->_ui_delay = $this->_params->get('ui_delay');
		$this->_ui_hover_direction = $this->_params->get('ui_hover_direction');
		$this->_ui_cobrand = $this->_params->get('ui_cobrand');
		
		$this->_ui_use_embeddable_services_beta = $this->_params->get('ui_use_embeddable_services_beta');
		$this->_data_ga_tracker = $this->_params->get('data_ga_tracker');
		$this->_ga_tracker_object = $this->_params->get('ga_tracker_object');
		
		//-----language params
		$this->_ui_language = $this->_params->get('ui_language');
		$this->_text_share_caption = $this->_params->get('text_share_caption');
		$this->_text_email_caption = $this->_params->get('text_email_caption');
		$this->_text_email = $this->_params->get('text_email');
		$this->_text_favorites = $this->_params->get('text_favorites');
		$this->_text_more = $this->_params->get('text_more');
		
		//-----AddThis Button params
		$this->_button_type = $this->_params->get('button_type');
		$this->_custom_choice = $this->_params->get('custom_choice');
		$this->_addthis_button = $this->_params->get('addthis_button');
		$this->_custom_button = $this->_params->get('custom_button');
		$this->_custom_text = $this->_params->get('custom_text');
		$this->_text_style = $this->_params->get('text_style');
		$this->_alt_text = $this->_params->get('alt_text');
		$this->_rssfeed_url = $this->_params->get('rssfeed_url');
		
		//-----AddThis Toolbox params
		$this->_toolbox_services = $this->_params->get('toolbox_services');
		$this->_use_text_flag = $this->_params->get('use_text_flag');
		$this->_toolbox_style = $this->_params->get('toolbox_style');
		$this->_toolbox_width = $this->_params->get('toolbox_width');
		$this->_toolbox_sharetext = $this->_params->get('toolbox_sharetext');
		$this->_use_more_flag = $this->_params->get('use_more_flag');
		$this->_toolbox_more = $this->_params->get('toolbox_more');
		$this->_toolbox_separator = $this->_params->get('toolbox_separator');
		$this->_use_nofollow = $this->_params->get('use_nofollow');
		$this->_tooltip_text = $this->_params->get('tooltip_text');
		
		// define the regular expression for activating the plugin
		$regex = "#{valaddthis}(.*?){/valaddthis}#s";
		
		$this->_article = $article; // make article object global
		
		// replace valaddthis tags (if present they override the plugin configuration too)
		if (strpos($article->text, "{valaddthis}") == true) {
			$article->text = preg_replace_callback($regex, array($this,"replaceTags"), $article->text);
		} else {
			
			//-----define arrays with filtered views
			$filter_art = trim($filter_art); // wipe out spaces
			$filter_art = str_replace(" ", "", $filter_art);
			$filter_artArray = explode(",", $filter_art); // array with excluded articles
			
			$filter_cat = trim($filter_cat); // wipe out spaces
			$filter_cat = str_replace(" ", "", $filter_cat);
			$filter_catArray = explode(",", $filter_cat); // array with excluded categories
			
			$filter_sec = trim($filter_sec); // wipe out spaces
			$filter_sec = str_replace(" ", "", $filter_sec);
			$filter_secArray = explode(",", $filter_sec); // array with excluded sections
			
			// get Joomla's view variable
			$this->_currentView = JRequest :: getVar('view');
			
			if ($this->_currentView == "frontpage") { // case frontpage view
				if ($show_front != "1") { // only if frontpage display is enabled
					if ($filter_art != "" or $filter_cat != "" or $filter_sec != "") {
						if (!in_array($article->catid, $filter_catArray) and !in_array($article->sectionid, $filter_secArray) and !in_array($article->id, $filter_artArray)) { // display plugin in article if its ID or category and section it belongs to are not excluded
							$display = true;
						}
					} else {
						$display = true;
					}
				}
			} elseif ($this->_currentView == "section" and $article->sectionid != "") { // case section view
				if ($show_sec != "1") { // only if section display is enabled
					if ($filter_art != "" or $filter_cat != "" or $filter_sec != "") {
						if (!in_array($article->catid, $filter_catArray) and !in_array($article->sectionid, $filter_secArray) and !in_array($article->id, $filter_artArray)) { // display plugin in article if section it belongs to is not excluded
							$display = true;
						}
					} else {
						$display = true;
					}
				}
			} elseif ($this->_currentView == "category" and $article->catid != "") { // case category view
				if ($show_cat != "1") { // only if category display is enabled
					if ($filter_art != "" or $filter_cat != "" or $filter_sec != "") {
						if (!in_array($article->catid, $filter_catArray) and !in_array($article->sectionid, $filter_secArray) and !in_array($article->id, $filter_artArray)) { // display plugin in article if category and section it belongs to are not excluded
							$display = true;
						}
					} else {
						$display = true;
					}
				}
			} elseif ($this->_currentView == "article") { // case article view
				if ($filter_art != "" or $filter_cat != "" or $filter_sec != "") {
					if (!in_array($article->catid, $filter_catArray) and !in_array($article->sectionid, $filter_secArray) and !in_array($article->id, $filter_artArray)) { // display plugin in article if its ID or category and section it belongs to are not excluded
						$display = true;
					}
				} else {
					$display = true;
				}
			} else {
				$display = false;
			}
		
			if ($display == true) { // display plugin if appropriate
				$plugincode = $this->renderAddThis(); // get plugin code to render
				if ($addthis_position == "0") { // position plugin on top of the article
					$article->text = $plugincode.$article->text;
				} elseif ($addthis_position == "1") { // position plugin on the bottom of the article
					$article->text .= $plugincode;
				} else { // position plugin both on the top and the bottom of the article
					$article->text = $plugincode.$article->text.$plugincode;
				}
			}
		}
		
		return true;
	}
	//------------------------END--> function: Prepare content for ValAddThis
	
	//------------------------BEGIN--> function: Replace plugin tags
	function replaceTags(&$matches) {
		
		// get configuration parameters (parameter=value)
		$tags = explode("|", trim($matches[1]));
		
		//-----check parameters and their values
		foreach ($tags as $tag) {
			$var = explode("=", $tag); // split parameter and value
			$param = $var[0]; // parameter name
			$value = $var[1]; // parameter value
			
			switch ($param) { // check for valid parameters (they override plugin configuration)
			case "type": // AddThis type
				if ($value == "button") {
					$this->_addthis_type = 0;
					$this->_currentView = "article"; // force joomla layout to be "article"
				} elseif ($value == "toolbox") {
					$this->_addthis_type = 1;
					$$this->_currentView = "article"; // force joomla layout to be "article"
				}
				break;
			case "button_type": // Button type
				if ($value == "default") {
					$this->_button_type = 0;
				} elseif ($value == "rss") {
					$this->_button_type = 1;
				} elseif ($value == "email") {
					$this->_button_type = 2;
				}
				break;
			case "button_img": // Button standard image
				if ($value == "addthis-long") {
					$this->_addthis_button = 0;
				} elseif ($value == "addthis") {
					$this->_addthis_button = 1;
				} elseif ($value == "bm-long") {
					$this->_addthis_button = 2;
				} elseif ($value == "bm") {
					$this->_addthis_button = 3;
				} elseif ($value == "share-long") {
					$this->_addthis_button = 4;
				} elseif ($value == "share") {
					$this->_addthis_button = 5;
				} elseif ($value == "plus") {
					$this->_addthis_button = 6;
				} elseif ($value == "rss-feed-big") {
					$this->_addthis_button = 7;
				} elseif ($value == "rss-feed-long") {
					$this->_addthis_button = 8;
				} elseif ($value == "rss-feed") {
					$this->_addthis_button = 9;
				} elseif ($value == "subscribe-big") {
					$this->_addthis_button = 10;
				} elseif ($value == "subscribe-long") {
					$this->_addthis_button = 11;
				} elseif ($value == "subscribe") {
					$this->_addthis_button = 12;
				} elseif ($value == "email") {
					$this->_addthis_button = 13;
				} elseif ($value == "counter") {
					$this->_addthis_button = 14;
				}
				break;
			case "lang": // UI language
				$this->_ui_language = $value;
				break;
			case "share_caption": // Text for "Bookmark & Share"
				$this->_text_share_caption = $value;
				break;
			case "email_caption": // Text for "Email a Friend"
				$this->_text_email_caption = $value;
				break;
			case "email": // Text for "Email"
				$this->_text_email = $value;
				break;
			case "favorites": // Text for "Favorites"
				$this->_text_favorites = $value;
				break;
			case "more": // Text for "More"
				$this->_text_more = $value;
				break;
			case "compact": // Compact menu services
				$this->_services_compact = $value;
				break;
			case "expanded": // Expanded menu services
				$this->_services_expanded = $value;
				break;
			case "exclude": // Menu services to exclude
				$this->_services_exclude = $value;
				break;
			case "tool_services": // Toolbox services
				$this->_toolbox_services = $value;
				break;
			case "tool_style": // Toolbox style
				if ($value == "default") {
					$this->_toolbox_style = "default";
				} elseif ($value == "vertical") {
					$this->_toolbox_style = "vertical";
				} elseif ($value == "default32") {
					$this->_toolbox_style = "default32";
				} elseif ($value == "vertical32") {
					$this->_toolbox_style = "vertical32";
				} elseif ($value == "css-hor") {
					$this->_toolbox_style = "cssHorizontal";
				} elseif ($value == "css-vert1") {
					$this->_toolbox_style = "cssVertical1";
				} elseif ($value == "css-vert2") {
					$this->_toolbox_style = "cssVertical2";
				} elseif ($value == "css-user") {
					$this->_toolbox_style = "cssUser";
				}
				break;
			case "tool_width": // Toolbox width
				$this->_toolbox_width = $value;
				break;
			case "tool_share": // Toolbox share text
				$this->_toolbox_sharetext = $value;
				break;
			case "tool_show_names": // Toolbox display service names
				if ($value == "yes") {
					$this->_use_text_flag = 1;
				} elseif ($value == "no") {
					$this->_use_text_flag = 0;
				}
				break;
			case "tool_show_more": // Toolbox display "More" icon
				if ($value == "yes") {
					$this->_use_more_flag = 1;
				} elseif ($value == "no") {
					$this->_use_more_flag = 0;
				}
				break;
			case "tool_more": // Toolbox text for "More"
				$this->_toolbox_more = $value;
				break;
			case "tooltip": // Toolbox text for "Send to" tooltip
				$this->_tooltip_text = $value;
				break;
			case "tool_separator": // Toolbox text for separator (pipe for |)
				if ($value == "pipe") {
					$this->_toolbox_separator = "|";
				} else {
					$this->_toolbox_separator = $value;
				}
				break;
			case "swfurl": // URL of a Flash object to share, along with the link
				$this->_swf_string .= "swfurl: ".$value;
				break;
			case "swf_width": // Ideal width of any provided Flash object
				if ($this->_swf_string != "") {
					$this->_swf_string .= ", ";
				}
				$this->_swf_string .= "width: ".$value;
				break;
			case "swf_height": // Ideal height of any provided Flash object
				if ($this->_swf_string != "") {
					$this->_swf_string .= ", ";
				}
				$this->_swf_string .= "height: ".$value;
				break;
			case "screenshot": // The URL of an image that shows a preview of the content being shared
				if ($this->_swf_string != "") {
					$this->_swf_string .= ", ";
				}
				$this->_swf_string .= "screenshot: ".$value;
				break;
			}
		}
		return $this->renderAddThis(); // return rendered HTML code
	}
	//------------------------END--> function: Replace plugin tags
	
	//------------------------BEGIN--> function: Render HTML for ValAddThis
	function renderAddThis() {
		
		//---------------determine the type of AddThis button to be displayed according to joomla's layout
		//-----case article layout
		if ($this->_currentView == "article" and $this->_addthis_type == 0) {
			$display_button = true;
		//-----case category layout
		} elseif ($this->_currentView == "category" and $this->_addthis_type_cat == 0) {
			$display_button = true;
		//-----case section layout
		} elseif ($this->_currentView == "section" and $this->_addthis_type_sec == 0) {
			$display_button = true;
		//-----case frontpage layout
		} elseif ($this->_currentView == "frontpage" and $this->_addthis_type_front == 0) {
			$display_button = true;
		//-----otherwise display a toolbox
		} else {
			$display_button = false;
		}
		
		if ($display_button == true) { // case AddThis Button, initialize images
			//-----define array with images links and dimensions for AddThis button
			$path = "plugins/content/valaddthis/images/";
			$button_array[0]["button_link"] = $path."addthis-long.gif";
			$button_array[0]["button_x"] = "125"; $button_array[0]["button_y"] = "16";
			$button_array[1]["button_link"] = $path."addthis-short.gif";
			$button_array[1]["button_x"] = "83"; $button_array[1]["button_y"] = "16";
			$button_array[2]["button_link"] = $path."bm-long.gif";
			$button_array[2]["button_x"] = "125"; $button_array[2]["button_y"] = "16";
			$button_array[3]["button_link"] = $path."bm-short.gif";
			$button_array[3]["button_x"] = "83"; $button_array[3]["button_y"] = "16";
			$button_array[4]["button_link"] = $path."share-long.gif";
			$button_array[4]["button_x"] = "125"; $button_array[4]["button_y"] = "16";
			$button_array[5]["button_link"] = $path."share-short.gif";
			$button_array[5]["button_x"] = "83"; $button_array[5]["button_y"] = "16";
			$button_array[6]["button_link"] = $path."plus-small.gif";
			$button_array[6]["button_x"] = "16"; $button_array[6]["button_y"] = "16";
			$button_array[7]["button_link"] = $path."rss-feed-big.gif";
			$button_array[7]["button_x"] = "160"; $button_array[7]["button_y"] = "24";
			$button_array[8]["button_link"] = $path."rss-feed-long.gif";
			$button_array[8]["button_x"] = "125"; $button_array[8]["button_y"] = "16";
			$button_array[9]["button_link"] = $path."rss-feed-short.gif";
			$button_array[9]["button_x"] = "83"; $button_array[9]["button_y"] = "16";
			$button_array[10]["button_link"] = $path."subscribe-big.gif";
			$button_array[10]["button_x"] = "160"; $button_array[10]["button_y"] = "24";
			$button_array[11]["button_link"] = $path."subscribe-long.gif";
			$button_array[11]["button_x"] = "125"; $button_array[11]["button_y"] = "16";
			$button_array[12]["button_link"] = $path."subscribe-short.gif";
			$button_array[12]["button_x"] = "83"; $button_array[12]["button_y"] = "16";
			$button_array[13]["button_link"] = $path."email-short.gif";
			$button_array[13]["button_x"] = "54"; $button_array[13]["button_y"] = "16";
		
			//-----determine the image for the AddThis button and its dimensions
			if ($this->_custom_choice == 0) {
				$this->_but_link = $button_array[$this->_addthis_button]["button_link"];
				$this->_but_x = $button_array[$this->_addthis_button]["button_x"];
				$this->_but_y = $button_array[$this->_addthis_button]["button_y"];
			} else {
				$this->_but_link = $this->_custom_button;
				//	list($this->_but_x, $this->_but_y) = getimagesize($this->_but_link);
			}
		}
		
		//-----get article's URL, title, description and ID
		$articleURL = urldecode($this->getURL($this->_article));
		$articleTitle = $this->_article->title;
		$articleDesc = $this->_article->metadesc;
		$articleID = $this->_article->id;
		
		// create unique class for AddThis according to article's ID
		$addThis_class = "valaddthis_id".$articleID;
		
		$output = "\n<!-- BEGIN: ValAddThis Plugin -->\n";
		
		//-----display HTML code before article if it is defined
		if (isset($this->_html_before)) {
			$output .= $this->_html_before;
		}
		
		// include the remote AddThis script (not in the <head>!)
		$output .= "<script charset=\"utf-8\" type=\"text/javascript\" src=\"";
		if ($this->_secure_server == 0) { // if plugin is installed on a secure Web-Server
			$output .= "https://s7.addthis.com/js/250/addthis_widget.js";
		} else { // if plugin is installed on a non-secure Web-Server
			$output .= "http://s7.addthis.com/js/250/addthis_widget.js";
		}
		$output .= "\"></script>\n";
		if ($this->_plugin_class != "") { // wrap plugin in a div tag, if a plugin CSS class is defined
			$output .= "<div class=\"{$this->_plugin_class}\">\n";
		}
		
		$output .= "<script type=\"text/javascript\" language=\"javascript\">\n";
		if (!empty($this->_addthis_pub)) { // AddThis ID
			$output .= "var addthis_pub = \"{$this->_addthis_pub}\";\n";
		}
		
		//-----pass localization variables for AddThis captions
		if ($this->_text_share_caption != "" or $this->_text_email_caption != "" or $this->_text_email != "" or $this->_text_favorites != "" or $this->_text_more != "") {
			$output .= "var addthis_localize = {
				share_caption: \"{$this->_text_share_caption}\",
				email_caption: \"{$this->_text_email_caption}\",
				email: \"{$this->_text_email}\",
				favorites: \"{$this->_text_favorites}\",
				more: \"{$this->_text_more}\"
			};\n";
		}
		
		//-----pass global congiguration variables to AddThis script
		$output .= "var addthis_config = {";
		if ($this->_ui_language != "") { // Default language
			$output .= "ui_language: \"{$this->_ui_language}\",";
		}
		if ($this->_services_compact != "") { // Displayed services in compact menu
			$output .= "services_compact: \"{$this->_services_compact}\",";
		}
		if ($this->_services_expanded != "") { // Displayed services in expanded menu
			$output .= "services_expanded: \"{$this->_services_expanded}\",";
		}
		if ($this->_services_exclude != "") { // Excluded services in all menus
			$output .= "services_exclude: \"{$this->_services_exclude}\",";
		}
		if ($this->_ui_header_color != "") { // Header color
			$output .= "ui_header_color: \"#{$this->_ui_header_color}\",";
		}
		if ($this->_ui_header_background != "") { // Header background color
			$output .= "ui_header_background: \"#{$this->_ui_header_background}\",";
		}
		if ($this->_ui_offset_top != "") { // Offset top
			$output .= "ui_offset_top: {$this->_ui_offset_top},";
		}
		if ($this->_ui_offset_left != "") { // Offset left
			$output .= "ui_offset_left: {$this->_ui_offset_left},";
		}
		if ($this->_ui_delay != "") { // Hover delay
			$output .= "ui_delay: {$this->_ui_delay},";
		}
		if ($this->_ui_cobrand != "") { // Brand name
			$output .= "ui_cobrand: \"{$this->_ui_cobrand}\",";
		}
		if ($display_button == true) { // ui_click will be used only for the AddThis button, not the toolbox
			if ($this->_ui_click == 1) { // Display upon
				$output .= "ui_click: true,";
			} else {
				$output .= "ui_click: false,";
			}
		}
		if ($this->_ui_hover_direction == 1) { // Hover direction
			$output .= "ui_hover_direction: true,";
		} else {
			$output .= "ui_hover_direction: false,";
		}
		if ($this->_ui_use_addressbook == 1) { // Use addressbook
			$output .= "ui_use_addressbook: true,";
		} else {
			$output .= "ui_use_addressbook: false,";
		}
		if ($this->_data_track_linkback == 1) { // Data track linkback
			$output .= "data_track_linkback: true,";
		} else {
			$output .= "data_track_linkback: false,";
		}
		if ($this->_data_use_flash == 1) { // Use flash
			$output .= "data_use_flash: true,";
		} else {
			$output .= "data_use_flash: false,";
		}
		if ($this->_data_use_cookies == 1) { // Use cookies
			$output .= "data_use_cookies: true,";
		} else {
			$output .= "data_use_cookies: false,";
		}
		if ($this->_ui_use_css == 1) { // Use AddThis CSS
			$output .= "ui_use_css: true,";
		} else {
			$output .= "ui_use_css: false,";
		}
		if ($this->_ui_use_embeddable_services_beta == 1) { // Use embeddable-only services
			$output .= "ui_use_embeddable_services_beta: true";
		} else {
			$output .= "ui_use_embeddable_services_beta: false";
		}
		if ($this->_data_ga_tracker == 1) { // Use GA tracking object
			if ($this->_ga_tracker_object != "") { // User-defined object name
				$output .= ",data_ga_tracker: ".$this->_ga_tracker_object;
			} else {
				$output .= ",data_ga_tracker: pageTracker"; // Use default object name
			}
		}
		$output .= "}; </script>\n";

		//---------------case it's an AddThis Button
		if ($display_button == true) {
			//-----case it's a standard bookmarking services button
			if ($this->_button_type == 0) {
				if ($this->_addthis_button != 14) {
					$output .= "<a class=\"{$addThis_class}\" ";
				} else { // case it's the share counter button
					$output .= "<a class=\"addthis_pill_style\" id=\"{$addThis_class}\" ";
				}
				//-----case for a user-defined text style
				if (!empty($this->_text_style)) {
					$output .= "style=\"{$this->_text_style}\" ";
				}
				$output .= ">";
				//-----case it's a standard image button
				if ($this->_custom_choice == 0) {
					if ($this->_addthis_button != 14) {
						$output .= "<img src=\"{$this->_but_link}\" width=\"{$this->_but_x}\" height=\"{$this->_but_y}\" border=\"0\" alt=\"{$this->_alt_text}\" />\n";
					}
				}
				//-----case it's a user-defined image button
				if ($this->_custom_choice == 1 or $this->_custom_choice == 2) {
					$output .= "<img src=\"{$this->_but_link}\" border=\"0\" alt=\"{$this->_alt_text}\" />\n";
				}
				//-----case text is displayed as a link
				if ($this->_custom_choice >= 2) {
					$output .= $this->_custom_text;
				}
				$output .= "</a>\n";

			//-----case it's an RSS feed services button
			} elseif ($this->_button_type == 1) {
				$output .= "<a alt=\"Subscribe using any feed reader!\" href=\"http://www.addthis.com/feed.php?pub={$this->_addthis_pub}&amp;h1={$this->_rssfeed_url}&amp;t1=\" ";
				//-----case for a user-defined text style
				if (!empty($this->_text_style)) {
					$output .= "style=\"{$this->_text_style}\"";
				}
				$output .= "onclick=\"return addthis_open(this, 'feed', '{$this->_rssfeed_url}', '[TITLE]');\" target=\"_blank\">\n";
				//-----case it's an image button
				if ($this->_custom_choice != 3) {
					$output .= "<img src=\"{$this->_but_link}\" width=\"{$this->_but_x}\" height=\"{$this->_but_y}\" border=\"0\" alt=\"{$this->_alt_text}\" />\n";
				}
				//-----case text is displayed as a link
				if ($this->_custom_choice >= 2) {
					$output .= $this->_custom_text;
				}
				$output .= "</a>\n";
			
			//-----case it's an email button
			} else {
				$output .= "<a class=\"addthis_button_email\" ";
				//-----case for a user-defined text style
				if (!empty($this->_text_style)) {
					$output .= "style=\"{$this->_text_style}\"";
				}
				$output .= ">";
				//-----case it's an image button
				if ($this->_custom_choice != 3) {
					$output .= "<img src=\"{$this->_but_link}\" width=\"{$this->_but_x}\" height=\"{$this->_but_y}\" border=\"0\" alt=\"{$this->_alt_text}\" />\n";
				}
				//-----case text is displayed as a link
				if ($this->_custom_choice >= 2) {
					$output .= $this->_custom_text;
				}
				$output .= "</a>\n";
			}
			
			// Render AddThis Button using Javascript (unless it's an RSS Feed or Email-only Button)
			if ($this->_button_type == 0) {
				if ($this->_addthis_button == 14) { // case it's the share counter button
					$output .= "<script type=\"text/javascript\">\n addthis.counter(\"#{$addThis_class}\", {}, {url: \"{$articleURL}\", title: \"{$articleTitle}\", description: \"{$articleDesc}\"";
				} else {
					$output .= "<script type=\"text/javascript\">\n addthis.button(\".{$addThis_class}\", {}, {url: \"{$articleURL}\", title: \"{$articleTitle}\", description: \"{$articleDesc}\"";
				}
				if (isset($this->_swf_string)) {
					$output .= ", ".$this->_swf_string;
				}
				$output .= "});\n</script>";
			}
			
		//---------------case it's an AddThis Toolbox
		} else {
			if ($this->_use_nofollow == 1 ) { // set rel=nofollow attribute if appropriate
				$nofollow = " rel=\"nofollow\"";
			} else {
				$nofollow = "";
			}
			
			if ($this->_toolbox_services != "") { // if any services defined
				$toolServices = explode(",", $this->_toolbox_services); // get CSV list of services
			}
			
			$path = "plugins/content/valaddthis/css/"; // path to CSS files
			
			$output .= "<div class=\"addthis_toolbox\">\n"; // wrap Toolbox in a div with CSS class
			
			//-----case default/default 32px/vertical/vertical 32px style
			if ($this->_toolbox_style == "default" or $this->_toolbox_style == "default32" or $this->_toolbox_style == "vertical" or $this->_toolbox_style == "vertical32") {
				$output .= "<div class=\"{$addThis_class}";
				if ($this->_toolbox_style == "default") { // default style
					$output .= " addthis_default_style\"";
				} elseif ($this->_toolbox_style == "default32") { // default 32px icons style
					$output .= " addthis_default_style addthis_32x32_style\"";
				} elseif ($this->_toolbox_style == "vertical32") { // vertical 32px icons style
					$output .= " addthis_32x32_style\"";
				}
				if ($this->_toolbox_width != "") { // case width defined
					$output .= " style=\"width:{$this->_toolbox_width}\"";
				}
				$output .= ">\n";
				
				if ($this->_toolbox_style == "default") { // Add reference to the appropriate CSS file
					JHTML::stylesheet("default.css", $path);
				} elseif ($this->_toolbox_style == "default32") {
					JHTML::stylesheet("default32.css", $path);
				} elseif ($this->_toolbox_style == "vertical") {
					JHTML::stylesheet("vertical.css", $path);
				} elseif ($this->_toolbox_style == "vertical32") {
					JHTML::stylesheet("vertical32.css", $path);
				}
				$output .= "<div class=\"share\">".$this->_toolbox_sharetext."&nbsp;</div>"; // display share text
				
				if (isset($toolServices)) { // if any services defined
					foreach ($toolServices as $service) { // display individual service icons
						$service = trim($service); // wipe out spaces
						$title = ucfirst(strtolower($service));
						if ($this->_use_text_flag == 1) { // display also service name?
							$service_name = "&nbsp;".$title;
						} else {
							$service_name = "";
						}
						if ($this->_tooltip_text != "") { // case custom tooltip text in place of "Send to"
							$tooltip_text = " title=\"".$this->_tooltip_text." ".$title."\"";
						} else {
							$tooltip_text = "";
						}
						
						//------display Facebook like button if appropriate
						if ($service == "facebook_like") {
							$output .= "<iframe src=\"http://www.facebook.com/plugins/like.php?href={$articleURL}&amp;layout=button_count&amp;show_faces=false&amp;width=47&amp;action=like&amp;colorscheme=light&amp;height=21\" scrolling=\"no\" frameborder=\"0\" class=\"FBlike\"></iframe>";
						//------display TweetMeme button if appropriate
						} elseif ($service == "tweetmeme") {
							$output .= "<script type=\"text/javascript\">tweetmeme_style = 'compact';tweetmeme_url = '{$articleURL}';</script><script type=\"text/javascript\" src=\"http://tweetmeme.com/i/scripts/button.js\"></script>";
						} else {
							$output .= "<a class=\"addthis_button_{$service}\"{$nofollow}{$tooltip_text}>{$service_name}</a>\n";
						}
					}
				}
				
				if ($this->_use_more_flag == "1") { // case "more" is used
					if ($this->_toolbox_style == "default") { // if default style check for separator
						$output .= "<span class=\"addthis_separator\">".$this->_toolbox_separator."</span>\n";
					}

					$output .= "<a class=\"addthis_button_expanded\"".($this->_toolbox_more != "" ? " title=\"{$this->_toolbox_more}\">{$this->_toolbox_more}" : ">")."</a>\n"; // "more" icon + optional text
				}
			} 
			
			//-----case CSS horizontal/CSS vertical #1/CSS user-defined style
			if ($this->_toolbox_style == "cssHorizontal" or $this->_toolbox_style == "cssVertical1" or $this->_toolbox_style == "cssUser") {
				// Add reference to CSS file and set CSS class for Toolbox
				if ($this->_toolbox_style == "cssHorizontal") {
					JHTML::stylesheet("horizontal.css", $path);
					$toolbox_class = "addHoriz";
					$spacer_char = "&nbsp;"; // set spacer character for share text
				} elseif ($this->_toolbox_style == "cssVertical1") {

					JHTML::stylesheet("vertical1.css", $path);
					$toolbox_class = "addVertical1";
					$spacer_char = "";
				} else {
					JHTML::stylesheet("user.css", $path);
					$toolbox_class = "addUser";
					$spacer_char = "&nbsp;"; // set spacer character for share text
				}
				$output .= "<div class=\"{$addThis_class}\"><div class=\"{$toolbox_class}\"".($this->_toolbox_width != "" ? " style=\"width:{$this->_toolbox_width}\"" : "").">\n";
				
				if ($this->_toolbox_sharetext != "") { // display share text if appropriate
					$output .= "<div class=\"share\">".$this->_toolbox_sharetext."{$spacer_char}</div>";
				}
				
				if (isset($toolServices)) { // if any services defined
					foreach ($toolServices as $service) { // display individual service icons
						$service = trim($service); // wipe out spaces
						$title = ucfirst(strtolower($service));
						if ($this->_use_text_flag == 1) { // display also service name?
							$service_name = "&nbsp;".$title;
						} else {
							$service_name = "&nbsp;";
						}
						if ($this->_tooltip_text != "") { // case custom tooltip text in place of "Send to"
							$tooltip_text = " title=\"".$this->_tooltip_text." ".$title."\"";
						} else {
							$tooltip_text = "";
						}
						
						//------display Facebook like button if appropriate
						if ($service == "facebook_like") {
							$output .= "<iframe src=\"http://www.facebook.com/plugins/like.php?href={$articleURL}&amp;layout=button_count&amp;show_faces=false&amp;width=47&amp;action=like&amp;colorscheme=light&amp;height=21\" scrolling=\"no\" frameborder=\"0\" class=\"FBlike\"></iframe>";
						//------display TweetMeme button if appropriate
						} elseif ($service == "tweetmeme") {
							$output .= "<script type=\"text/javascript\">tweetmeme_style = 'compact';tweetmeme_url = '{$articleURL}';</script><script type=\"text/javascript\" src=\"http://tweetmeme.com/i/scripts/button.js\"></script>";
						} else {
							$output .= "<div><a class=\"addthis_button_{$service}\"{$nofollow}{$tooltip_text}>{$service_name}</a></div>\n";
						}
					}
				}
				if ($this->_use_more_flag == "1") { // case "more" is used
					$output .= "<div><a class=\"addthis_button_expanded\"".($this->_toolbox_more != "" ? " title=\"{$this->_toolbox_more}\">&nbsp;{$this->_toolbox_more}" : ">")."</a></div>\n"; // "more" icon + optional text
				}
				$output .= "<div class=\"clearAddthis\"></div>\n</div>\n";
			}
			
			//-----case CSS vertical #2 style (uses vertical2.css)
			if ($this->_toolbox_style == "cssVertical2") {
				// Add reference to CSS file
				JHTML::stylesheet("vertical2.css", $path);
				
				$output .= "<div class=\"{$addThis_class}\"><div class=\"addVertical2\"".($this->_toolbox_width != "" ? " style=\"width:{$this->_toolbox_width}\"" : "").">\n";
				
				$output .= "<div class=\"share\">".$this->_toolbox_sharetext."</div>"; // display share text
				
				if (isset($toolServices)) { // if any services defined
					foreach ($toolServices as $service) { // display individual service icons
						$service = trim($service); // wipe out spaces
						$title = ucfirst(strtolower($service));
						if ($this->_tooltip_text != "") { // case custom tooltip text in place of "Send to"
							$tooltip_text = " title=\"".$this->_tooltip_text." ".$title."\"";
						} else {
							$tooltip_text = "";
						}
						
						//------display Facebook like button if appropriate
						if ($service == "facebook_like") {
							$output .= "<iframe src=\"http://www.facebook.com/plugins/like.php?href={$articleURL}&amp;layout=button_count&amp;show_faces=false&amp;width=47&amp;action=like&amp;colorscheme=light&amp;height=21\" scrolling=\"no\" frameborder=\"0\" class=\"FBlike\"></iframe>";
						//------display TweetMeme button if appropriate
						} elseif ($service == "tweetmeme") {
							$output .= "<script type=\"text/javascript\">tweetmeme_style = 'compact';tweetmeme_url = '{$articleURL}';</script><script type=\"text/javascript\" src=\"http://tweetmeme.com/i/scripts/button.js\"></script>";
						} else {
							$output .= "<a class=\"addthis_button_{$service}\"{$nofollow}{$tooltip_text}>{$title}</a>\n";
						}
					}
				}
				
				if ($this->_use_more_flag == "1") { // case "more" is used
					if ($this->_toolbox_more == "") { // fix more icon if no text is next to it
						$this->_toolbox_more = "&nbsp;";
					}
					$output .= "<div class=\"more\"><a class=\"addthis_button_expanded\"".($this->_toolbox_more != "" ? " title=\"{$this->_toolbox_more}\">{$this->_toolbox_more}" : ">")."</a></div>\n"; // "more" icon + optional text
				}
				$output .= "</div>\n";
			}
			
			$output .= "</div>\n"; // close Toolbox div
			
			// Render AddThis Toolbox using Javascript
			$output .= "<script type=\"text/javascript\">\n addthis.toolbox(\".{$addThis_class}\", {}, {url: \"{$articleURL}\", title: \"{$articleTitle}\", description: \"{$articleDesc}\"";
			if (isset($this->_swf_string)) {
				$output .= ", ".$this->_swf_string;
			}
			$output .= "});\n</script>";
			$output .= "</div>";
		}
		
		if ($this->_plugin_class != "") { // wrap plugin in a div tag, if a plugin CSS class is defined
			$output .= "</div>";
		}
		
		//-----display HTML code after article if it is defined
		if (isset($this->_html_after)) {
			$output .= $this->_html_after;
		}
		
		$output .= "\n<!-- END: ValAddThis Plugin -->\n";
		
		return $output;
	}
	//------------------------END--> function: Render HTML for ValAddThis
	
	//------------------------BEGIN--> function: Get article URL
	function getURL(&$article) {
		if (!is_null($article))	{
			require_once( JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php');
			
			$uri = &JURI::getInstance();
			$base = $uri->toString(array('scheme', 'host', 'port'));
			$url = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug, $article->sectionid));
			
			return JRoute::_($base . $url, true, 0);
		}
	}
	//------------------------END--> function: Get article URL
}
?>
