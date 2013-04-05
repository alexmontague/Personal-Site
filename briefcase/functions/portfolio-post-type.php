<?php
/*###########################################################################
Theme Post Type -Portfolio
###########################################################################*/
function product_listing() {
	$labels = array(
		'name' => __('Portfolio', 'post type general name'),
		'singular_name' => __('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New', 'Listing'),
		'add_new_item' => __('Add New Post'),
		'edit_item' => __('Edit Post'),
		'new_item' => __('New Post'),
		'all_items' => __('All Posts'),
		'view_item' => __('View Post'),
		'search_items' => __('Search Posts'),
		'not_found' =>  __('No Posts found'),
		'not_found_in_trash' => __('No Posts found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'menu_position' => 28,
		'menu_icon' => get_template_directory_uri() .'/images/portfolio-icon.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'portfolio-items', 'with_front' => false ), // Important!
		'supports' => array('title','editor','thumbnail','custom-fields', 'excerpt', 'comments'),
		'taxonomies' => array( 'portfolio-categories'),
	);
	register_post_type( 'portfolio' , $args );
	}
	
	

/*###########################################################################
Add custom taxonomies for product listing
###########################################################################*/
function portfolio_taxonomies() {

	$labels = array (
		'name' => __( 'Categories', 'taxonomy general name' ),
		'singluar_name' => __( 'Category', 'taxonomy singular name' ),
		'search_items' => __( 'Search Category' ),
		'all_items' => __('All Categories'),
		'parent_item' => __('Parent Category'),
		'parent_item_colon' => __('Parent Category:'),
		'edit_item' => __('Edit Category'),
		'update_item' => __('Update Category'),
		'add_new_item' => __('Add New Category'),
		'new_item_name' => __('New Category'),
		'menu_name' => __( 'Categories' )
	);

	register_taxonomy( 'portfolio-categories', array('portfolio'), array (
					'labels' => $labels,
					'hierarchical' =>true,
					'show_ui' => true,
					'rewrite' => array( 'slug' => 'portfolio-categories'),
					'query_var' => true,
					'show_in_nav_menus' => true,
					'public' => true
			));
}

add_action('init', 'product_listing', 0);
add_action('init', 'portfolio_taxonomies', 10);	
?>