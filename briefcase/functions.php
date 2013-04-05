<?php
/*###########################################################################
ROCKABLE THEMES FRAMEWORK FUNCTIONS
###########################################################################*/
define('RT_FILEPATH', TEMPLATEPATH);
define('RT_DIRECTORY', get_bloginfo('template_directory'));

require_once (RT_FILEPATH . '/admin/panel-interface.php');		               // Panel Interfaces
require_once (RT_FILEPATH . '/admin/theme-options.php'); 		               // Options panel 
require_once (RT_FILEPATH . '/admin/rockable-news.php');                        // News Page
//require_once (RT_FILEPATH . '/admin/rockable-updates.php');                 // Updates Page

require_once (RT_FILEPATH . '/functions/portfolio-post-type.php');               // Portfolio
require_once (RT_FILEPATH . '/functions/theme-functions.php');                // Theme Functions
require_once (RT_FILEPATH . '/functions/theme-widgets.php');                  // Theme Widgets
require_once (RT_FILEPATH . '/functions/shortcodes/tinymce.php');           // TinyMCE
require_once (RT_FILEPATH . '/functions/shortcodes/shortcode.php');        // Shortcodes

require_once (RT_FILEPATH . '/includes/comments-content.php');              // Comments
require_once (RT_FILEPATH . '/includes/pagination.php');                           // Pagination
require_once (RT_FILEPATH . '/includes/extensions/like/like.class.php');      // Like/Love Module





/*###########################################################################
LOAD CSS FILES
###########################################################################*/
function rt_register_css()  { 
		wp_register_style( 'grid-slider', get_template_directory_uri() . '/css/grid-slider.css', array(), '1.0', 'all' ); 
		wp_register_style( 'shortcodes', get_template_directory_uri() . '/css/shortcodes.css', array(), '1.0', 'all' );
		
		
		wp_enqueue_style( 'grid-slider' ); 
		wp_enqueue_style( 'shortcodes' );
}  
add_action( 'wp_enqueue_scripts', 'rt_register_css' ); 



/*###########################################################################
LOAD JQUERY FILES
###########################################################################*/
function rt_register_js() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/includes/javascripts/jquery1.5.2.js', 'jquery', '1.5.2');
		wp_register_script('validation', get_template_directory_uri() . '/includes/javascripts/jquery.validate.js', 'jquery',true);
		wp_register_script('cycle', get_template_directory_uri() . '/includes/javascripts/jquery.cycle.js', 'jquery', '1.0', true);
		wp_register_script('custom-min', get_template_directory_uri() . '/includes/javascripts/jquery-ui-1.8.16.custom.min.js', 'jquery', '1.0', true);
		wp_register_script('gridslider', get_template_directory_uri() . '/includes/javascripts/jquery.grid-slider.min.js', 'jquery', '1.0', true);
		wp_register_script('lightbox', get_template_directory_uri() . '/includes/javascripts/jquery.lightbox.js', 'jquery', '1.0', true);
		wp_register_script('general', get_template_directory_uri() . '/includes/javascripts/general.js', 'jquery', '1.0', true);
		wp_register_script('quicksand', get_template_directory_uri() . '/includes/javascripts/jquery.quicksand.js', 'jquery');
		wp_register_script('easing', get_template_directory_uri() . '/includes/javascripts/jquery.easing.1.3.js', 'jquery');
		wp_register_script('custom', get_template_directory_uri() . '/includes/javascripts/jquery.custom.js', 'jquery', '1.0', TRUE);
		
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('validation');
		wp_enqueue_script('cycle');
		wp_enqueue_script('custom-min');
		wp_enqueue_script('gridslider');
		wp_enqueue_script('lightbox');
		wp_enqueue_script('general');	
		wp_enqueue_script('quicksand');
		wp_enqueue_script('easing');
		wp_enqueue_script('custom');
		wp_enqueue_script('comment-reply');
	}
}		
add_action('init', 'rt_register_js');





/*###########################################################################
DISPLAY IMAGE CAPTION
###########################################################################*/
function the_post_thumbnail_caption() {
  global $post;
  
  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_title.'</span>';
  }
}


/*###########################################################################
CONTENT LIMIT
###########################################################################*/
function rt_excerpt($excerpt_length = 55, $ending = ' [...]') {
	$text = get_the_content('');
	$text = strip_shortcodes( $text );

	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);

	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = $text . $ending;
		return $text;
	} else {
		$text = implode(' ', $words);
		return $text;
	}
}


/*###########################################################################
CHANGE HTML OUTPUT IN CATEGORIES WIDGET
###########################################################################*/
add_filter('wp_list_categories', 'add_span_cat_count');
function add_span_cat_count($links) {
$links = str_replace('</a> (', ' <span>', $links);
$links = str_replace(')', '</span></a>', $links);
return $links;
}


/*###########################################################################
POST THUMBNAIL
###########################################################################*/
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
  set_post_thumbnail_size( 505, 9999, true );  // Default Post Thumbnail dimensions
  // additional image sizes
  add_image_size( 'blog-thumb', 505, 9999 );  // Blog Thumbnail dimensions
}


/*###########################################################################
GET POST IMAGE SCRIPT
###########################################################################*/
function get_post_image ($post_id=0, $width=0, $height=0, $img_script='') {
	global $wpdb;
	if($post_id > 0) {

		 // select the post content from the db
		 $sql = 'SELECT post_content FROM ' . $wpdb->posts . ' WHERE id = ' . $wpdb->escape($post_id);
		 $row = $wpdb->get_row($sql);
		 $the_content = $row->post_content;
		 if(strlen($the_content)) {

			// use regex to find the src of the image
			preg_match("/<img src\=('|\")(.*)('|\") .*( |)\/>/", $the_content, $matches);
			if(!$matches) {
				preg_match("/<img class\=\".*\" title\=\".*\" src\=('|\")(.*)('|\") .*( |)\/>/U", $the_content, $matches);
			}
			$the_image = '';
			$the_image_src = $matches[2];
			$frags = preg_split("/(\"|')/", $the_image_src);
			if(count($frags)) {
				$the_image_src = $frags[0];
			}

			  // if src found, then create a new img tag
			  if(strlen($the_image_src)) {
				   if(strlen($img_script)) {

					    // if the src starts with http/https, then strip out server name
					    if(preg_match("/^(http(|s):\/\/)/", $the_image_src)) {
						     $the_image_src = preg_replace("/^(http(|s):\/\/)/", '', $the_image_src);
						     $frags = split("\/", $the_image_src);
						     array_shift($frags);
						     $the_image_src = '/' . join("/", $frags);
					    }
					    $the_image = '<img alt="" src="' . $img_script . $the_image_src . '" />';
				   }
				   else {
					    $the_image = '<img alt="" src="' . $the_image_src . '" width="' . $width . '" height="' . $height . '" />';
				   }
			  }
			  return $the_image;
		 }
	}
}


/*###########################################################################
AJAX PAGINATION CODE
###########################################################################*/
if ( !function_exists('rockable_ajax_pagination')):

    function rockable_ajax_pagination() {
        global $wp_query, $portfolio, $template;
		$current_query = ($portfolio)? $portfolio : $wp_query;
		
        // Add code to index pages.
        if( !is_singular() || strpos($template,'template_blog.php') || strpos($template,'template_portfolio.php') ) {
        	
            // Queue JS and CSS
            wp_enqueue_script(
                'rt-load-posts',
                get_template_directory_uri() . '/includes/javascripts/load-posts.js',
                array('jquery'),
                '1.0',
                true
            );
			
            // What page are we on? And what is the pages limit?
            $max = $current_query->max_num_pages;
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

            // Add some parameters for the JS.
            wp_localize_script(
                'rt-load-posts',
                'rt_attr',
                array(
                    'startPage' => $paged,
                    'maxPages' => $max,
                    'nextLink' => next_posts($max, false),
                    'linkText' => __('MORE POSTS', 'rt')
                )
            );
        }
    }
    add_action('wp_footer', 'rockable_ajax_pagination');
	
endif;

/*###########################################################################
Navigate through pages
###########################################################################*/
function page_nav($link) {
    global $post;
    $siblings = get_pages('child_of='.$post->post_parent.'&parent='.$post->post_parent);
    foreach ($siblings as $key=>$sibling){
        if ($post->ID == $sibling->ID){
            $ID = $key;
        }
    }
    $closest = array('before'=>get_permalink($siblings[$ID-1]->ID),'after'=>get_permalink($siblings[$ID+1]->ID));

    if ($link == 'before' || $link == 'after') { echo $closest[$link]; } else { return $closest; }
}


/*###########################################################################
LOCALIZATION
###########################################################################*/
load_theme_textdomain( 'rt', RT_FILEPATH .'/languages' );

$locale = get_locale();
$locale_file = RT_FILEPATH ."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/*###########################################################################
REGISTER SIDEBARS
###########################################################################*/
//Main Sidebar
register_sidebar(array(
	'name' => 'Main Sidebar',
	'id' => 'sidebar-main',
	'description' => __('This is the widget area for the Main Sidebar.', 'rt'),
	
	'before_widget' => '<div class="sidebar-block">',
	'after_widget'   => '</div><!--end sidebar-block-->',
	
	'before_title' => '<h1>',
	'after_title'   => '</h1>'
));
	
//Footer Center Sidebar
register_sidebar(array(
	'name' => 'Footer Center',
	'id' => 'footer-center',
	'description' => __('This is the widget area for the Center Footer Sidebar.', 'rt'),
	
	'before_widget' => '<div class="sidebar-block-footer">',
	'after_widget'   => '</div><!--end sidebar-block-footer-->',
	
	'before_title' => '<h1>',
	'after_title'   => '</h1>'
));	

//Footer Center Sidebar
register_sidebar(array(
	'name' => 'Footer Right',
	'id' => 'footer-right',
	'description' => __('This is the widget area for the Right Footer Sidebar.', 'rt'),
	
	'before_widget' => '<div class="sidebar-block-footer">',
	'after_widget'   => '</div><!--end sidebar-block-footer-->',
	
	'before_title' => '<h1>',
	'after_title'   => '</h1>'
));	


?>