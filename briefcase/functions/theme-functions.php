<?php
/*###########################################################################
Color Scheme
###########################################################################*/
function head_styles(){
	
	if (get_option('rt_color_scheme')=='Green' ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
        
	<?php } elseif (get_option('rt_color_scheme')) { ?>
       <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/<?php echo(get_option('rt_color_scheme'));?>.css" type="text/css" media="screen" />
	<?php };
};

add_action('wp_head','head_styles');


/*###########################################################################
Create Rockable Themes Menu in Admin Bar
###########################################################################*/
function rt_admin_bar_menu() {
   global $wp_admin_bar;
		  $wp_admin_bar->add_menu( array(
			'id' => 'custom_menu',
			'title' => __( 'Rockable Themes'),
			'href' => admin_url( 'admin.php?page=rockableframework') ) );
		  $wp_admin_bar->add_menu( array(
			'parent' => 'custom_menu',
			'title' => __( 'Theme Options'),
			'href' => admin_url( 'admin.php?page=rockableframework') ) );
		  //$wp_admin_bar->add_menu( array(
			//'parent' => 'custom_menu',
			//'title' => __( 'Rockable News'),
			//'href' => admin_url( 'admin.php?page=rockable_news') ) );		
}
add_action('admin_bar_menu', 'rt_admin_bar_menu',20);

//Show - Hide
if ( get_option('rt_show_ab') == "false") { 
add_filter( 'show_admin_bar', '__return_false' );
} 



/*###########################################################################
CUSTOM LOGIN LOGO
###########################################################################*/
function my_custom_login_logo() {
	if (get_option('rt_custom_login_logo'))
       echo '<style type="text/css">
            h1 a { background-image:url('.  get_option('rt_custom_login_logo')  .') !important; }
            </style>';
	else 
	   echo '<style type="text/css">
            h1 a { background-image:url('.get_bloginfo('template_directory').'/admin/images/logo-login.gif") !important; }
            </style>';
}

add_action('login_head', 'my_custom_login_logo');



/*###########################################################################
Breadcrumbs Function Code
###########################################################################*/
function rt_breadcrumbs() {
 
  $delimiter = '';
  $home = get_option('rt_bc_anchor'); // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
 
    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
 
  }
} 



/*###########################################################################
List categories for the portfolio
###########################################################################*/
class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" data-value="'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items filed under %s' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      // $link .= $cat_name . '</a>';
      $link .= $cat_name;
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}




/*###########################################################################
SEO - This function controls the meta titles display
###########################################################################*/
function rockable_titles() {
	global $shortname;
	
	#if the title is being displayed on the homepage
	if (is_home()) {
 
			if (get_option('rt_seo_home_title') == 'Site Title - Site Description') echo get_bloginfo('name').get_option('rt_title_separator').get_bloginfo('description'); 
			if ( get_option('rt_seo_home_title') == 'Site Description - Site Title') echo get_bloginfo('description').get_option('rt_title_separator').get_bloginfo('name');
			if ( get_option('rt_seo_home_title') == 'Site Title') echo get_bloginfo('name');
			if ( get_option('rt_seo_home_title') == 'Site Description') echo get_bloginfo('description');
			if ( get_option('rt_seo_home_title') == 'Custom-Title') echo get_option('rt_home_custom_title');
 	}
	#if the title is being displayed on single posts/pages
	if (is_single() || is_page()) { 

			if (get_option('rt_seo_posts_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('rt_titlepp_separator').wp_title('',false,''); 
			if ( get_option('rt_seo_posts_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('rt_titlepp_separator').get_bloginfo('name');
			if ( get_option('rt_seo_posts_title') == 'Page Title') echo wp_title('',false,'');
			if ( get_option('rt_seo_posts_title') == 'Site Title') echo get_bloginfo('name');
			if ( get_option('rt_seo_posts_title') == 'Custom-Title') echo get_option('rt_posts_custom_title');
					
	}
	#if the title is being displayed on index pages (categories/archives/search results)
	if (is_category() || is_archive() || is_search()) { 
		if (get_option('rt_seo_pages_title') == 'Site Title - Page Title') echo get_bloginfo('name').get_option('rt_titles_separator').wp_title('',false,''); 
		if ( get_option('rt_seo_pages_title') == 'Page Title - Site Title') echo wp_title('',false,'').get_option('rt_titles_separator').get_bloginfo('name');
		if ( get_option('rt_seo_pages_title') == 'Page Title') echo wp_title('',false,'');
		if ( get_option('rt_seo_pages_title') == 'Site Title') echo get_bloginfo('name');
		if ( get_option('rt_seo_pages_title') == 'Custom-Title') echo get_option('rt_pages_custom_title');
	}	  
} 

/*###########################################################################
SEO - This function controls the meta post keywords
###########################################################################*/
function meta_post_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
		$meta_post_keywords = $tag->name . ',';
	}
	echo '<meta name="keywords" content="'.$meta_post_keywords.'" />';
}

/*###########################################################################
SEO - This function controls the meta home keywords
###########################################################################*/
function meta_home_keywords() {
    global $rt_meta_key;
     if (strlen($rt_meta_key) > 1 ) {
    echo '<meta name="keywords" content="'.get_option('rt_meta_key').'" />';
    }
}

/*###########################################################################
SEO - This function controls the search indexing
###########################################################################*/
function rt_index(){
		global $post;
		global $wpdb;
		if(!empty($post)){
		$post_id = $post->ID; }
 
		/* Robots */	
		$index = 'index';
		$follow = 'follow';

		if ( is_tag() && get_option('rt_index_tag') != 'index') { $index = 'noindex'; }
		elseif ( is_search() && get_option('rt_index_search') != 'index' ) { $index = 'noindex'; }  
		elseif ( is_author() && get_option('rt_index_author') != 'index') { $index = 'noindex'; }  
		elseif ( is_date() && get_option('rt_index_date') != 'index') { $index = 'noindex'; }
		elseif ( is_category() && get_option('rt_index_category') != 'index' ) { $index = 'noindex'; }
		echo '<meta name="robots" content="'. $index .', '. $follow .'" />' . "\n";	
	}

/*###########################################################################
SEO - This function controls canonical urls
###########################################################################*/
function rt_canonical() {
 	if(get_option('rt_canonical') == 'true' ) {
	#homepage urls
	if (is_home() )echo '<link rel="canonical" href="'.get_bloginfo('url').'" />';
	#single page urls
	global $wp_query; 
	$postid = $wp_query->post->ID; 
	if (is_single() || is_page()) echo '<link rel="canonical" href="'.get_permalink().'" />';
	#index page urls
		if (is_archive() || is_category() || is_search()) echo '<link rel="canonical" href="'.get_permalink().'" />';	
	}
}




/*###########################################################################
Add Thumbnails in Manage Posts/Pages List
###########################################################################*/
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
    // for post and page
    add_theme_support('post-thumbnails', array( 'post', 'page', 'portfolio' ) );
    function AddThumbColumn($cols) {
        $cols['thumbnail'] = __('Thumbnail');
        return $cols;
    }
    function AddThumbValue($column_name, $post_id) {
            $width = (int) 60;
            $height = (int) 60;
            if ( 'thumbnail' == $column_name ) {
                // thumbnail of WP 2.9
                $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                // image from gallery
                $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
                if ($thumbnail_id)
                    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
                elseif ($attachments) {
                    foreach ( $attachments as $attachment_id => $attachment ) {
                        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                    }
                }
                    if ( isset($thumb) && $thumb ) {
                        echo $thumb;
                    } else {
                        echo __('None');
                    }
            }
    }
    // for posts
    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
    // for pages
    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
	
	add_filter( 'manage_edit-portfolio_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
}



?>