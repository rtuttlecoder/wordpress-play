<?php

/***
 * Plugin Name: Custom Post Types & Taxonomies
 * Description: assigns custom post types and taxonomies
 * Version: 0.0.1
 * Author: Richard Tuttle
 * License: MIT
 */

// creates taxonomy
function my_custom_posttypes() {
	// Testimonials
	$labels = array(
		'name'				=> 'Testimonials',
		'singular_name'		=> 'Testimonal',
		'menu_name'			=> 'Testimonals',
		'name_admin_bar'	=> 'Testimonal',
		'add_new'			=> 'Add New',
		'add_new_item'		=> 'Add New Testimonal',
		'new_item'			=> 'New Testimonal',
		'edit_item'			=> 'Edit Testimonal',
		'view_item'			=> 'View Testimonal',
		'all_items'			=> 'All Testimonals',
		'search_items'		=> 'Search Testimonals',
		'parent_item_colon' => 'Parent Testimonals:',
		'not_found'			=> 'No Testimonals found.',
		'not_found_in_trash'=> 'No Testimonals found in Trash.',
	);
	$args = array(
		'public' 			=> true,
		'label'  			=> $labels,
		'publicly_queryable'=> true,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'menu_position'		=> 5,
		'menu_icon'			=> 'dashicons-id-alt',
		'query_var'			=> true,
		'rewrite'			=> array('slug' => 'testimonals'),
		'capability_type'	=> 'post',
		'has_archive'		=> true,
		'hierarchical'		=> false,
		'supports'			=> array('title', 'editor', 'thumbnail'),
		'show_in_rest'		=> true  // allows access via REST API
	);
	register_post_type('testimonials', $args);

	// Reviews
	$labels = array(
		'name'				=> 'Reviews',
		'singular_name'		=> 'Reviews',
		'menu_name'			=> 'Reviews',
		'name_admin_bar'	=> 'Review',
		'add_new'			=> 'Add New',
		'add_new_item'		=> 'Add New Review',
		'new_item'			=> 'New Review',
		'edit_item'			=> 'Edit Review',
		'view_item'			=> 'View Review',
		'all_items'			=> 'All Reviews',
		'search_items'		=> 'Search Reviews',
		'parent_item_colon' => 'Parent Reviews:',
		'not_found'			=> 'No Reviews found.',
		'not_found_in_trash'=> 'No Reviews found in Trash.',
	);
	$args = array(
		'public' 			=> true,
		'label'  			=> $labels,
		'publicly_queryable'=> true,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'menu_position'		=> 5,
		'menu_icon'			=> 'dashicons-star-half',
		'query_var'			=> true,
		'rewrite'			=> array('slug' => 'reviews'),
		'capability_type'	=> 'post',
		'has_archive'		=> true,
		'hierarchical'		=> false,
		'supports'			=> array('title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments'),
		'taxonomies'		=> array('category', 'post_tag'),
		'show_in_rest'		=> true,  // allows access via REST API
	);
	register_post_type('reviews', $args);
}
add_action('init', 'my_custom_posttypes');

function my_rewrite_flush() {
	my_custom_posttypes();
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'my_rewrite_flush');



// custom taxonomies
function my_custom_taxonomies() {
	// product / service
	$labels = array(
		'name' 				=> 'Type of Products/Services',
		'singluar_name'		=> 'Type of Products/Service',
		'search_items'		=> 'Search Types of Products/Services',
		'all_items'			=> 'All Types of Products/Services',
		'parent_item'		=> 'Parnet Type of Product/Service',
		'parent_item_colon'	=> 'Parent Type of Product/Service:',
		'edit_item'			=> 'Edit Type of Product/Service',
		'update_item'		=> 'Update Type of Product/Service',
		'add_new_item'		=> 'Add New Type of Product/Service',
		'new_item_name'		=> 'New Type of Product/Service Name',
		'menu_name'			=> 'Type of Product/Service',
	);
	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array('slug' => 'product-type'),
	);
	register_taxonomy('product-type', array('reviews'), $args);

	// mood
	register_taxonomy(
		'mood',
		'reviews',
		array(
			'label' 		=> 'Type of Product / Service',
			'rewrite'		=> array('slug' => 'product-types').
			'hierarchical'	=> true
		),
	);

	// price range
	$labels = array(
		'name' 				=> 'Price Ranges',
		'singluar_name'		=> 'Price Range',
		'search_items'		=> 'Search Price Rangess',
		'all_items'			=> 'All Price Rangess',
		'parent_item'		=> 'Parnet Price Ranges',
		'parent_item_colon'	=> 'Parent Price Ranges:',
		'edit_item'			=> 'Edit Price Ranges',
		'update_item'		=> 'Update Price Ranges',
		'add_new_item'		=> 'Add New Price Ranges',
		'new_item_name'		=> 'New Price Ranges Name',
		'menu_name'			=> 'Price Ranges',
	);
	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array('slug' => 'prices'),
	);
	register_taxonomy('price', array('reviews'), $args);
}	
add_action('init', 'my_custom_taxonomies');