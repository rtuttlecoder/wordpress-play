<?php
/**
 * Plugin Name: Single Post Content Plus
 * Description: adds a sidebar/widget to single posts
 * Version: 0.1
 * Author: Richard Tuttle
 * Text Domain: spcp
 * License: GPL-2.0+
 */

// security check
if (!definded('ABSPATH')) {
	die;
}

/**
 * Load custom stylesheet
 */
add_action('wp_enqueue_scripts', 'spcp_stylesheet');
function spcp_stylesheet() {
	if (apply_filters('spcp_load_styles', true)) {	
		wp_enqueue_style('spcp-custom-stylesheet', plugin_dir_url(__FILE__) . 'styles.css');
	}
}

// Uncomment the following line to remove custom stylesheet
// add_filter('spcp_load_styles', '__return_false');

/**
 * sidebar widget creator
 */
add_action('widget_init', 'spcp_register_sidebar');
function spcp_register_sidebar() {
	register_sidebar(array(
		'name' 			=> __('Post Content Plus', 'spcp'),
		'id' 			=> 'spcp-sidebar',
		'description' 	=> __('Widgets in this area display on single posts.', 'spcp'),
		'before_widget'	=> '<div class="widget spcp-sidebar">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widgettitle spcp-title">',
		'after_title'	=> '</h2>',
	));
}

/**
 * dynamic sidebar creator - single posts only
 */
add_filter('the_content', 'spcp_display_sidebar');
function spcp_display_sidebar($content) {
	if (is_single() && is_active_sidebar('spcp-sidebar') && is_main_query()) {
		dynamic_sidebar('spcp-sidebar');
	}
	return $content;
}
