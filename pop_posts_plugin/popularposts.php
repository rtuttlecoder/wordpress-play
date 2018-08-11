<?php

/**
 * Plugin Name: Popular Posts
 * Description: The plugin will create a new 'views' field and populate it each time the page is loaded.
 * Plugin URI: https://accessidaho.org
 * Author: Richard Tuttle, Access Idaho
 * Author URI: https://accessidaho.org
 * Version: 1.0.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Post Popularity Counter
 */
function my_popular_post_views($postID) {
	$total_key = 'views';
	// get current 'views' field
	$total = get_post_meta($postID, $total_key, true);
	// if current 'views' field is empty, set it to zero
	if ($total == '') {
		delete_post_meta($postID, $total_key);
		add_post_meta($postID, $total_key, '0');
	} else {
		// if current 'views' field has a value, add 1 to that value
		$total++;
		update_post_meta($postID, $total_key, $total);
	}
}

/** 
 * Dynamically inject counter into single posts
 */
function my_count_popular_posts($post_id) {
	// check that this is a single post and that the user is a visitor
	if (!is_single()) return;
	if (!is_user_logged_in()) {
		// get the post ID
		if (empty($post_id)) {
			global $post;
			$post_id = $post->ID;
		}
		// run post popularity counter on post
		my_popular_post_views($post_id);
	}
}

add_action('wp_head', 'my_count_popular_posts');

/**
 * Add popular posts function data to All Posts table
 */
function my_add_views_column($defaults) {
	$defaults['post_views'] = 'View Count';
	return $defaults;
}

add_filter('manage_posts_columns', 'my_add_views_column');

function my_display_views($column_name) {
	if ($column_name === 'post_views') {
		echo (int)get_post_meta(get_the_ID(), 'views', true);
	}
}

add_action('manager_posts_custom_column', 'my_display_views', 5, 2);


class popular_posts extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'popular_posts',
			esc_html__('Popular Posts', 'text_domain'),
			array('description' => esc_html__('Popular Posts', 'text_domain'), )
		);
	}

	/**
	 * Front-end display of widget
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
		}

		$query_args = array(
			'post_type' 			=> 'posts',
			'posts_per_page' 		=> 5,
			'meta_key' 				=> 'views',
			'orderby' 				=> 'meta_value_num',
			'order' 				=> 'DESC',
			'ignore_sticky_posts' 	=> true
		);

		$the_query = new WP_Query($query_args);
		if ($the_query->have_posts()) {
			echo '<ul>';
			while ($the_query->have_posts()) {
				$the_query->the_post();
				echo '<li>';
				echo '<a href="' . get_the_permalink() . '" rel="bookmark">';
				echo get_the_title();
				echo '</a></li>';
			}
			echo '</ul>';
		} else {
			// no posts found
		}
		wp_reset_postdata();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Popular Posts', 'text_domain');
		}
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$update = array();
		$update['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $update; // !empty($update) ? $update : $old_instance;
	}
}

add_action('widgets_init', function() {
	register_widget('popular_posts');
});
