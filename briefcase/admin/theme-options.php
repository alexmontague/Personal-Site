<?php
/*###########################################################################
THEME OPTIONS
###########################################################################*/
add_action('init','rt_options');
     if (!function_exists('rt_options')) {
     function rt_options(){
	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$theme_version = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$theme_version = $theme_version['Version'];
$shortname = "rt";

// Populate rockableframework option in array for use in theme
global $rt_options;
$rt_options = get_option('rt_options');

$GLOBALS['template_path'] = RT_DIRECTORY;

//Access the WordPress Categories via an Array
$rt_categories = array();  
$rt_categories_obj = get_categories('hide_empty=0');
foreach ($rt_categories_obj as $rt_cat) {
    $rt_categories[$rt_cat->cat_ID] = $rt_cat->cat_name;}
$categories_tmp = array_unshift($rt_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$rt_pages = array();
$rt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($rt_pages_obj as $rt_page) {
    $rt_pages[$rt_page->ID] = $rt_page->post_name; }
$rt_pages_tmp = array_unshift($rt_pages, "Select a page:");       


//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('rt_uploads');
$other_entries = array("1","2","3","4","5","6","7","8","9","10");

// Set the Options Array
$options = array();

/*###########################################################################
GENERAL OPTIONS
###########################################################################*/
$options[] = array( "name" => "General",
                    "type" => "heading",
					"icon" => "settings.png");

// Header						
$options[] = array( "name" => "General",
					"type" => "tab");	
					
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon. Click the red button over the image to remove it.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Custom Logo Top",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. Click the red button over the image to remove it.",
					"id" => $shortname."_logo_path",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Custom Logo Bottom",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. Click the red button over the image to remove it.",
					"id" => $shortname."_logo_path_bottom",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Custom Login Logo",
					"desc" => "Upload a logo for your login page, or specify the image address of your online logo. Note: Maximum size of the image 310px width and 70px height. Click the red button over the image to remove it.",
					"id" => $shortname."_custom_login_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "type" => "divider");

$options[] = array( "name" => "Show/Hide Admin Bar",
					"desc" => "Press On/Off if you want to show or hide Admin Bar, feature from wordpress 3.1 (default on).",
					"id" => $shortname."_show_ab",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Website's Top Description",
					"desc" => "Press On/Off if you want to show or hide website's top description (default on).",
					"id" => $shortname."_description",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Show/Hide Website's Bottom Description",
					"desc" => "Press On/Off if you want to show or hide website's bottom description (default on).",
					"id" => $shortname."_description_bottom",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "type" => "divider");

$options[] = array( "name" => "FeedBurner Feed Address",
					"desc" => "If you want to use Google Feedburner to track your RSS, insert your Feedburner Feed Address.",
					"id" => $shortname."_misc_feedburner",
					"type" => "text",
					"std" => "");
					

							
// Single Page						
$options[] = array( "name" => "Single Pages",
					"type" => "tab");
					
$options[] = array( "name" => "Show/Hide Title",
					"desc" => "Press On/Off if you want to show or hide title from single pages (default on).",
					"id" => $shortname."_single_title",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Meta",
					"desc" => "Press On/Off if you want to show or hide meta from single pages (default on).",
					"id" => $shortname."_single_meta",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Share Article",
					"desc" => "Press On/Off if you want to show or hide Share Article from single pages (default on).",
					"id" => $shortname."_share_article",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "type" => "divider");

$options[] = array( "name" => "Show/Hide Title - Portfolio Single",
					"desc" => "Press On/Off if you want to show or hide title from portfolio single pages (default on).",
					"id" => $shortname."_portfolio_single_title",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Meta - Portfolio Single",
					"desc" => "Press On/Off if you want to show or hide meta from portfolio single pages (default on).",
					"id" => $shortname."_portfolio_single_meta",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Share Article - Portfolio Single",
					"desc" => "Press On/Off if you want to show or hide Share Article from portfolio single pages (default on).",
					"id" => $shortname."_portfolio_share_article",
					"std" => "true",
					"type" => "checkbox");





//Archive & Categories					
$options[] = array( "name" => "Archive/Categories Page",
					"type" => "tab");
					
$options[] = array( "name" => "Show/Hide Archive & Categories Thumbnail",
					"desc" => "Press On/Off if you want to show or hide Archive & Categories Thumbnail (default on).",
					"id" => $shortname."_arch_thumb",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Archive & Categories Excerpt",
					"desc" => "Choose the number of words you want to display in the excerpt for Archive & Categories. (50 words by default) ",
					"id" => $shortname."_catex",
					"type" => "text",
					"std" => "50");
					
$options[] = array( "name" => "Archive & Categories Excerpt Ending",
					"desc" => "How would you like to end your Archive & Categories custom excerpt. (... by default) ",
					"id" => $shortname."_catexend",
					"type" => "text",
					"std" => "...");	
					
$options[] = array( "name" => "Show/Hide Archive & Categories More Button",
					"desc" => "Press On/Off if you want to show or hide Archive & Categories Read More Button (default on).",
					"id" => $shortname."_arch_more",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Pagination Method",
					"desc" => "Select your pagination method from Facebook/Tweeter like Load More, Custom Pagination with numbers or Default Wordpress pagination with arrows.",
					"id" => $shortname."_archive_nav",
					"options" => array('Load-More', 'Custom-Pagination', 'Default-WordPress'),
					"std" => "Load-More",
					"type" => "select");
										
//Search Page					
$options[] = array( "name" => "Search Page",
					"type" => "tab");
					
$options[] = array( "name" => "Show/Hide Search Thumbnail",
					"desc" => "Press On/Off if you want to show or hide Search Thumbnail (default on).",
					"id" => $shortname."_search_thumb",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Search Results Excerpt",
					"desc" => "Choose the number of words you want to display in the excerpt for Search Results. (50 words by default) ",
					"id" => $shortname."_searchex",
					"type" => "text",
					"std" => "50");
					
$options[] = array( "name" => "Search Results Excerpt Ending",
					"desc" => "How would you like to end your Search Results custom excerpt. (... by default) ",
					"id" => $shortname."_searchexend",
					"type" => "text",
					"std" => "...");	
					
$options[] = array( "name" => "Pagination Method",
					"desc" => "Select your pagination method from Facebook/Tweeter like Load More, Custom Pagination with numbers or Default Wordpress pagination with arrows.",
					"id" => $shortname."_search_nav",
					"options" => array('Load-More', 'Custom-Pagination', 'Default-WordPress'),
					"std" => "Load-More",
					"type" => "select");
					
// Comments						
$options[] = array( "name" => "Comments",
					"type" => "tab");
					
$options[] = array( "name" => "Show/Hide Comments Avatar",
					"desc" => "Press On/Off if you want to show or hide comments Avatar (default on).",
					"id" => $shortname."_comments_avatar",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "type" => "divider");	
					
$options[] = array( "name" => "Show/Hide Comments on Single Page",
					"desc" => "Press On/Off if you want to show or hide comments on single pages (default on).",
					"id" => $shortname."_show_postcomments",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Comments on Portfolio Single Page",
					"desc" => "Press On/Off if you want to show or hide comments on portfolio single pages (default on).",
					"id" => $shortname."_show_postcomments_portfolio",
					"std" => "true",
					"type" => "checkbox");					
					
$options[] = array( "name" => "Show/Hide Comments on Pages",
					"desc" => "Press On/Off if you want to show or hide comments on single pages (default on).",
					"id" => $shortname."_show_pagecomments",
					"std" => "true",
					"type" => "checkbox");

					
// Contact					
$options[] = array( "name" => "Contact",
					"type" => "tab");	

$options[] = array( "name" => "Show/Hide Email, Skype and Twitter Area",
					"desc" => "Press On/Off if you want to show or hide Email, Skype and Twitter Area from contact page (default on).",
					"id" => $shortname."_contacts_est",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array( "name" => "Email Address",
					"desc" => "Enter the email address that will be displayed on Contacts Page.",
					"id" => $shortname."_contacts_mail",
					"type" => "text",
					"std" => "rockablethemes@gmail.com");	
					
$options[] = array( "name" => "Skype",
					"desc" => "Enter your skype ID/Name here to be displayed on Contacts Page.",
					"id" => $shortname."_contacts_skype",
					"type" => "text",
					"std" => "rockablethemes");

$options[] = array( "name" => "Twitter",
					"desc" => "Enter your Twitter ID/Name here to be displayed on Contacts Page.",
					"id" => $shortname."_contacts_twitter",
					"type" => "text",
					"std" => "rockablethemes");
					
$options[] = array( "type" => "divider");					
					
$options[] = array( "name" => "Contact Form Email Address",
					"desc" => "Enter the email address where you'd like to receive emails from the contact form, or leave blank to use admin email.",
					"id" => $shortname."_email",
					"type" => "text",
					"std" => "");	
					
$options[] = array( "name" => "Show/Hide Contact Page Data",
					"desc" => "Press On/Off if you want to show or hide data/text from contact page (default on).",
					"id" => $shortname."_contact_data",
					"std" => "true",
					"type" => "checkbox");		
					
// Footer						
$options[] = array( "name" => "Footer",
					"type" => "tab");

$options[] = array( "name" => "Show/Hide Latest Works",
					"desc" => "Press On/Off if you want to show or hide Latest Works from the Footer (default on).",
					"id" => $shortname."_footer_latest",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Latest Works Items",
					"desc" => "How much portfolio items you want to display in Footer. Add/Manage your portfolio items <a href=".admin_url( 'edit.php?post_type=portfolio').">here</a>.",
					"id" => $shortname."_footer_port_items",
					"type" => "text",
					"std" => "4");	

$options[] = array( "type" => "divider");
					
$options[] = array( "name" => "Show/Hide Copyright Area",
					"desc" => "Press On/Off if you want to show or hide the Copyright Area from the Footer (default on).",
					"id" => $shortname."_display_copyright",
					"std" => "true",
					"type" => "checkbox");

/*###########################################################################
STYLES
###########################################################################*/	
$options[] = array( "name" => "Styling",
                    "type" => "heading",
					"icon" => "styling.png");
					
// Color Scheme					
$options[] = array( "name" => "Color Scheme",
					"type" => "tab");
					
$options[] = array( "name" => "Color Scheme",
					"desc" => "Please select your themes alternative color scheme from the dropdown below to match with your business colors.",
					"id" => $shortname."_color_scheme",
					"id2" => "colors",
					"options" => array('Green', 'Blue', 'Yellow', 'Black'),
					"std" => "Green",
					"type" => "select");
					
$options[] = array( "type" => "divider");
	
					
$options[] = array( "select-id" => "colors",
					"option" => "Green",
					"type" => "select-tab");
								
$options[] = array( "name" => "Background Preview: <br/> <div class='green-back'></div> ");
$options[] = array( "name" => "Headings, Links Color Preview: <br/> <div class='green-font'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis justo arcu. Donec et velit et libero adipiscing vehicula. Praesent a nibh dui. Donec egestas pharetra erat faucibus hendrerit.</div> ");


$options[] = array( "select-id" => "colors",
					"option" => "Blue",
					"type" => "select-tab");
								
$options[] = array( "name" => "Background Preview: <br/> <div class='blue-back'></div> ");
$options[] = array( "name" => "Headings, Links Color Preview: <br/> <div class='blue-font'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis justo arcu. Donec et velit et libero adipiscing vehicula. Praesent a nibh dui. Donec egestas pharetra erat faucibus.</div> ");


$options[] = array( "select-id" => "colors",
					"option" => "Yellow",
					"type" => "select-tab");
								
$options[] = array( "name" => "Background Preview: <br/> <div class='yellow-back'></div> ");
$options[] = array( "name" => "Headings, Links Color Preview: <br/> <div class='yellow-font'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis justo arcu. Donec et velit et libero adipiscing vehicula. Praesent a nibh dui. Donec egestas pharetra erat faucibus.</div> ");


$options[] = array( "select-id" => "colors",
					"option" => "Black",
					"type" => "select-tab");
								
$options[] = array( "name" => "Background Preview: <br/> <div class='black-back'></div> ");
$options[] = array( "name" => "Headings, Links Color Preview: <br/> <div class='black-font'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis justo arcu. Donec et velit et libero adipiscing vehicula. Praesent a nibh dui. Donec egestas pharetra erat faucibus.</div> ");
					
$options[] = array( "type" => "close-select-tabs");	
					

					
/*###########################################################################
SLIDING DASHBOARD
###########################################################################*/						
$options[] = array( "name" => "Sliding Panel",
					"type" => "heading",
					"icon" => "Dashboard.png");
					
// General Dashboard						
$options[] = array( "name" => "General",
					"type" => "tab");
					
$options[] = array( "name" => "Show/Hide Sliding Panel",
					"desc" => "Press On/Off if you want to show or hide the Top Sliding Panel Area in the header (default on).",
					"id" => $shortname."_dashboard",
					"std" => "true",
					"type" => "checkbox");


					
$options[] = array( "name" => "About Section - Text",
					"desc" => "Insert here the about text that will be displayed in the sliding top panel.",
					"id" => $shortname."_panel_about",
					"type" => "textarea",
					"std" => "");
					
$options[] = array( "name" => "About Section - More Button URL",
					"desc" => "Insert here the url/link that you want to be attached to the 'More' button",
					"id" => $shortname."_panel_about_link",
					"type" => "text",
					"std" => "http://rockablethemes.com");

$options[] = array( "type" => "divider");

$options[] = array( "name" => "Latest works Section - 'All Works' URL",
					"desc" => "Insert here the url/link that you want to be attached to the 'All Works' button",
					"id" => $shortname."_panel_works_link",
					"type" => "text",
					"std" => "http://rockablethemes.com");

$options[] = array( "name" => "Latest works Section - 'All Works' Text",
					"desc" => "Insert here the button text.",
					"id" => $shortname."_panel_works_text",
					"type" => "text",
					"std" => "All Works");
					
$options[] = array( "type" => "divider");

$options[] = array( "name" => "Contact Section - 'More Contacts' URL",
					"desc" => "Insert here the url/link that you want to be attached to the 'More Contacts' button",
					"id" => $shortname."_panel_contacts_link",
					"type" => "text",
					"std" => "http://rockablethemes.com");

$options[] = array( "name" => "Contacts Section - 'More Contacts' Text",
					"desc" => "Insert here the button text.",
					"id" => $shortname."_panel_contacts_text",
					"type" => "text",
					"std" => "More Contacts");

					
								
					
/*###########################################################################
HOME PAGE OPTIONS
###########################################################################*/				
$options[] = array( "name" => "Homepage",
					"type" => "heading",
					"icon" => "House.png");				

// General
$options[] = array( "name" => "General",
					"type" => "tab");
					
$options[] = array( "name" => "Home Page Displays :",
					"desc" => "Choose what you want to display on homepage, ex: Home Featured Categories or a simple Blog Page.",
					"id" => $shortname."_homepage_displays",
					"id2" => "home_page",
					"options" => array('Portfolio', 'Blog-Template'),
					"std" => "Portfolio",
					"type" => "select");

$options[] = array( "type" => "divider");



// Portfolio
$options[] = array( "select-id" => "home_page",
					"option" => "Portfolio",
					"type" => "select-tab");
					
$options[] = array( "name" => "Portfolio Items to display on Home Page",
					"desc" => "How much portfolio items you want to display on Home Page. Add/Manage your portfolio items <a href=".admin_url( 'edit.php?post_type=portfolio').">here</a>.",
					"id" => $shortname."_index_port_items",
					"type" => "text",
					"std" => "8");		
					
$options[] = array( "name" => "Show/Hide Portfolio Items Title",
					"desc" => "Press On/Off if you want to show or hide Portfolio Items Title (default on).",
					"id" => $shortname."_index_title",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Show/Hide Portfolio Like Widget",
					"desc" => "Press On/Off if you want to show or hide Portfolio Like/Love Widget (default on).",
					"id" => $shortname."_index_like",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Pagination Method",
					"desc" => "Select your pagination method from Facebook/Tweeter like Load More, Custom Pagination with numbers or Default Wordpress pagination with arrows.",
					"id" => $shortname."_index_port_nav",
					"options" => array('Load-More', 'Custom-Pagination', 'Default-WordPress'),
					"std" => "Load-More",
					"type" => "select",
					"inside-tab" => 1);	
			
					
				
// Blog Template 1
$options[] = array( "select-id" => "home_page",
					"option" => "Blog-Template",
					"type" => "select-tab");
					
$options[] = array( "name" => "Show/Hide Thumbnail",
					"desc" => "Press On/Off if you want to show or hide Thumbnail from Blog Template 1 (default on).",
					"id" => $shortname."_index_blog1_thumb",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Show/Hide Thumbnail Caption",
					"desc" => "Press On/Off if you want to show or hide Thumbnail Image caption (default on).",
					"id" => $shortname."_index_blog1_caption",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide 'Read More' Button",
					"desc" => "Press On/Off if you want to show or hide (Read More) button from Blog Template 1 (default on).",
					"id" => $shortname."_index_blog1_readmore",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Post Meta",
					"desc" => "Press On/Off if you want to show or hide Category, Date and Comments from Blog Template 1 (default on).",
					"id" => $shortname."_index_blog1_meta",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Text Excerpt",
					"desc" => "Choose the number of words you want to display in the excerpt for Blog Template #1 (45 words by default) ",
					"id" => $shortname."_index_blog1_ex",
					"type" => "text",
					"std" => "45");		
					
$options[] = array( "name" => "Text Excerpt Ending",
					"desc" => "How would you like to end your Blog Template #1 custom excerpt. (... by default) ",
					"id" => $shortname."_index_blog1_exte",
					"type" => "text",
					"std" => "...");
					
$options[] = array( "name" => "Pagination Method",
					"desc" => "Select your pagination method from Facebook/Tweeter like Load More, Custom Pagination with numbers or Default Wordpress pagination with arrows.",
					"id" => $shortname."_index_blog1_nav",
					"options" => array('Load-More', 'Custom-Pagination', 'Default-WordPress'),
					"std" => "Load-More",
					"type" => "select",
					"inside-tab" => 1);			
					
					
					

					

/*###########################################################################
Blog
###########################################################################*/						
$options[] = array( "name" => "Blog",
					"type" => "heading",
					"icon" => "blog2.png");
					
$options[] = array( "name" => "General",
					"type" => "tab");

$options[] = array( "name" => "Show/Hide Thumbnail",
					"desc" => "Press On/Off if you want to show or hide Thumbnail from Blog Template 1 (default on).",
					"id" => $shortname."_blog1_thumb",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Show/Hide Thumbnail Caption",
					"desc" => "Press On/Off if you want to show or hide Thumbnail Image caption (default on).",
					"id" => $shortname."_blog1_caption",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide 'Read More' Button",
					"desc" => "Press On/Off if you want to show or hide (Read More) button from Blog Template 1 (default on).",
					"id" => $shortname."_blog1_readmore",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Show/Hide Post Meta",
					"desc" => "Press On/Off if you want to show or hide Category, Date and Comments from Blog Template 1 (default on).",
					"id" => $shortname."_blog1_meta",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Text Excerpt",
					"desc" => "Choose the number of words you want to display in the excerpt for Blog Template #1 (45 words by default) ",
					"id" => $shortname."_blog1_ex",
					"type" => "text",
					"std" => "45");		
					
$options[] = array( "name" => "Text Excerpt Ending",
					"desc" => "How would you like to end your Blog Template #1 custom excerpt. (... by default) ",
					"id" => $shortname."_blog1_exte",
					"type" => "text",
					"std" => "...");
					
$options[] = array( "name" => "Blog Template Pagination Method",
					"desc" => "Select your pagination method from Facebook/Tweeter like Load More, Custom Pagination with numbers or Default Wordpress pagination with arrows.",
					"id" => $shortname."_blog1_nav",
					"options" => array('Load-More', 'Custom-Pagination', 'Default-WordPress'),
					"std" => "Load-More",
					"type" => "select");	

$options[] = array( "name" => "Exclude",
					"type" => "tab");
					
$options[] = array( "name" => "Exclude Category",
					"desc" => "Insert here the ID of the category that you want to exclude from Blog.",
					"id" => $shortname."_blog_exclude_cat",
					"type" => "text",
					"std" => "");					

					
/*###########################################################################
PORTFOLIO OPTIONS
###########################################################################*/						
$options[] = array( "name" => "Portfolio",
					"type" => "heading",
					"icon" => "portfolio.png");	
					
		
$options[] = array( "name" => "General",
					"type" => "tab");
					
$options[] = array( "name" => "Portfolio Items to display",
					"desc" => "How much items you want to display in Portfolio. Add/Manage your portfolio items <a href=".admin_url( 'edit.php?post_type=portfolio').">here</a>.",
					"id" => $shortname."_port_items",
					"type" => "text",
					"std" => "8");
										
$options[] = array( "name" => "Show/Hide Categories Filter",
					"desc" => "Press On/Off if you want to show or hide Categories Filter (default on).",
					"id" => $shortname."_portfolio_filter",
					"std" => "true",
					"type" => "checkbox"); 
					

					

		
/*###########################################################################
SLIDER OPTIONS
###########################################################################*/						
$options[] = array( "name" => "Carousel",
                    "type" => "heading",
					"icon" => "wallpapers.png");

$options[] = array( "name" => "General",
					"type" => "tab");
	
$options[] = array( "name" => "Carousel Delay Time",
					"desc" => "The time delay between slider rotation in milliseconds (Default 5000).",
					"id" => $shortname."_carousel_delay",
					"type" => "text",
					"std" => "5000");
					
$options[] = array( "name" => "Carousel Speed",
					"desc" => "The transition duration in milliseconds (Default 500).",
					"id" => $shortname."_carousel_duration",
					"type" => "text",
					"std" => "500");
					
$options[] = array( "name" => "Carousel Posts",
					"desc" => "Which posts should be shown in the carousel",
					"id" => $shortname."_carousel_posts",
					"options" => array("Portfolio-Posts","Blog-Posts"),
					"type" => "select");
					
$options[] = array( "name" => "Carousel Excluded Categories",
					"desc" => "Categories you want excluded from the carousel",
					"id" => $shortname."_carousel_exclude_cats",
					"type" => "text");	
					

/*###########################################################################
TRACKING CODE
###########################################################################*/						
$options[] = array( "name" => "Analytics",
					"type" => "heading",
					"icon" => "scripts.png");
					
$options[] = array( "name" => "Google Analytics",
					"type" => "tab");
					
$options[] = array( "name" => "Google Analytics Tracking Script Code",
					"desc" => "Insert the complete tracking script that should be included in the footer.",
					"id" => $shortname."_analytics",
					"type" => "textarea",
					"std" => "");
					
$options[] = array( "name" => "Mint",
					"type" => "tab");
					
$options[] = array( "name" => "Mint Tracking Script Code",
					"desc" => "Insert the complete tracking script that should be included in the footer.",
					"id" => $shortname."_mint",
					"type" => "textarea",
					"std" => "");
					


					
/*###########################################################################
SEO
###########################################################################*/						
$options[] = array( "name" => "S.E.O",
					"type" => "heading",
					"icon" => "seo2.png");				

$options[] = array( "name" => "Title Tag Structure",
					"type" => "tab");

					
$options[] = array( "name" => "Homepage Title",
					"desc" => "Choose the format you would like to display title tag on homepage.",
					"id" => $shortname."_seo_home_title",
					"id2" => "home_custom_title",
					"options" => array('Site Title - Site Description', 'Site Description - Site Title', 'Site Title', 'Site Description', 'Custom-Title'),
					"std" => "Site Title - Site Description",
					"type" => "select");
					
$options[] = array( "select-id" => "home_custom_title",
					"option" => "Custom-Title",
					"type" => "select-tab");
					
$options[] = array( "name" => "Homepage Custom Title",
					"desc" => "Insert here the custom title for homepage.",
					"id" => $shortname."_home_custom_title",
					"type" => "text",
					"std" => "");

$options[] = array( "type" => "close-select-tabs");					
					
$options[] = array( "name" => "Home Page Title Separator",
					"desc" => "Home Page Title separator.",
					"id" => $shortname."_title_separator",
					"type" => "text",
					"std" => " | ");
					
$options[] = array( "type" => "divider");

$options[] = array( "name" => "Posts and Pages",
					"desc" => "Choose the format you would like to display title tag on Single Posts and Pages.",
					"id" => $shortname."_seo_posts_title",
					"id2" => "posts_custom_title",
					"options" => array('Page Title', 'Site Title', 'Page Title - Site Title', 'Site Title - Page Title', 'Custom-Title'),
					"std" => "Page Title",
					"type" => "select");
					
$options[] = array( "select-id" => "posts_custom_title",
					"option" => "Custom-Title",
					"type" => "select-tab");
					
$options[] = array( "name" => "Posts and Pages Custom Title",
					"desc" => "Insert here the custom title for Posts and Pages.",
					"id" => $shortname."_posts_custom_title",
					"type" => "text",
					"std" => "");

$options[] = array( "type" => "close-select-tabs");	
					
$options[] = array( "name" => "Posts and Pages Title Separator",
					"desc" => "Posts and Pages Title separator.",
					"id" => $shortname."_titlepp_separator",
					"type" => "text",
					"std" => " | ");
					
$options[] = array( "type" => "divider");

$options[] = array( "name" => "Index Pages",
					"desc" => "Choose the format you would like to display title tag on index pages. (Categories/Archives/Tags/Search Results).",
					"id" => $shortname."_seo_pages_title",
					"id2" => "index_custom_title",
					"options" => array('Page Title - Site Title','Site Title - Page Title', 'Page Title', 'Site Title', 'Custom-Title'),
					"std" => "Page Title - Site Title",
					"type" => "select");
					
$options[] = array( "select-id" => "index_custom_title",
					"option" => "Custom-Title",
					"type" => "select-tab");
					
$options[] = array( "name" => "Index Pages Custom Title",
					"desc" => "Insert here the custom title for Index Pages.",
					"id" => $shortname."_pages_custom_title",
					"type" => "text",
					"std" => "");

$options[] = array( "type" => "close-select-tabs");	
					
$options[] = array( "name" => "Index Pages Title Separator",
					"desc" => "Index Pages Title separator.",
					"id" => $shortname."_titles_separator",
					"type" => "text",
					"std" => " | ");
					
$options[] = array( "name" => "Homepage Meta",
					"type" => "tab");			
					
$options[] = array( "name" => "Meta Description for Homepage",
					"desc" => "Here you can insert META description for your <strong><em>home page</em></strong>, which will appear in search engines. If you leave it blank, the <a href='options-general.php' target='_blank'>Tagline</a> will be used instead.                                  <br />On <strong><em>Single Posts</em></strong> by default will be used the excerpt to generate description.",
					"id" => $shortname."_meta_desc",
					"type" => "textarea",
					"std" => "");
				
$options[] = array( "name" => "Meta Keywords for Homepage",
					"desc" => "Insert META keywords, comma separated. Generally META Keywords are ignored by Search Engines.<br />On <strong><em>Single Posts</em></strong> by default tags will be used to generate keywords.",
					"id" => $shortname."_meta_key",
					"type" => "textarea",
					"std" => "");
					
$options[] = array( "name" => "Indexing Settings",
					"type" => "tab");
					
$options[] = array( "name" => "Search Results",
					"desc" => "Option below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress.",
					"id" => $shortname."_index_search",
					"options" => array('index', 'noindex'),
					"std" => "index",
					"type" => "select");
					
$options[] = array( "name" => "Date Archives",
					"desc" => "Option below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress.",
					"id" => $shortname."_index_date",
					"options" => array('index', 'noindex'),
					"std" => "index",
					"type" => "select");
					
$options[] = array( "name" => "Author Archives",
					"desc" => "Option below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress.",
					"id" => $shortname."_index_author",
					"options" => array('index', 'noindex'),
					"std" => "index",
					"type" => "select");
					
$options[] = array( "name" => "Tag Archives",
					"desc" => "Option below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress.",
					"id" => $shortname."_index_tag",
					"options" => array('index', 'noindex'),
					"std" => "index",
					"type" => "select");
					
$options[] = array( "name" => "Category Archives",
					"desc" => "Option below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress.",
					"id" => $shortname."_index_category",
					"options" => array('index', 'noindex'),
					"std" => "index",
					"type" => "select");
					
$options[] = array( "name" => "Canonical Tag",
					"type" => "tab");

$options[] = array( "name" => "Enable Canonical URLs",
					"desc" => "The Canonical Tag is used to inform search engines of the proper URL to index when they crawl your website.",
					"id" => $shortname."_canonical",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => "Breadcrumbs",
					"type" => "tab");
					
$options[] = array( "name" => "Anchor Text",
					"desc" => "Enher here the anchor text for the home page (default home)",
					"id" => $shortname."_bc_anchor",
					"type" => "text",
					"std" => "Home");
					
$options[] = array( "type" => "divider");


$options[] = array( "name" => "Enable Breadcrumbs - Single Pages",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on single pages (default on).",
					"id" => $shortname."_bc_single",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Enable Breadcrumbs - Portfolio Single Pages",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on Portfolio single pages (default on).",
					"id" => $shortname."_bc_single_portfolio",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Enable Breadcrumbs - Search Page",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on search page (default on).",
					"id" => $shortname."_bc_search",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Enable Breadcrumbs - Simple Page",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on simple page (default on).",
					"id" => $shortname."_bc_page",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Enable Breadcrumbs - Contact Page",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on Contact Page (default on).",
					"id" => $shortname."_bc_contact",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Enable Breadcrumbs - Blog Template #1",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on Blog Template #1 Page (default on).",
					"id" => $shortname."_bc_blog",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Enable Breadcrumbs - Portfolio",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on Portfolio Page (default on).",
					"id" => $shortname."_bc_portfolio",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Enable Breadcrumbs - Archive & Categories",
					"desc" => "Press On/Off if you want to enable or disable Breadcrumbs on archive and categories page (default on).",
					"id" => $shortname."_bc_archive",
					"std" => "true",
					"type" => "checkbox");

/*###########################################################################
END OF THEME OPTIONS
###########################################################################*/		
					
					

update_option('rt_template',$options); 					  
update_option('rt_themename',$themename);
update_option('rt_themeversion',$theme_version);     
update_option('rt_shortname',$shortname);

}
}
?>
