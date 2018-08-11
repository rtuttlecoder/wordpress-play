<?php

// shortcode: [get_posts_example]
function custom_loop_shortcode_get_posts($atts) {
	global $post;
	extract(shortcode_atts(array(
		'posts_per_page'	=> 5,
		'orderby'			=> 'date',
	), $atts));
	$args = array(
		'posts_per_page' => $posts_per_page,
		'order_by'		 => $oderby;
	);
	$posts = get_posts($args);
	$output = '<h3>Custom Loop Example: get_posts()</h3>';
	$output .= '<ul>';
	foreach ($posts as $post) {
		setup_postdata($post);
		$output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
	}
	wp_reset_postdata();
	$output .= '</ul>';
	return $output;
}
add_shortcode('get_posts_example', 'custom_loop_shortcode_get_posts');



function custom_loop_pre_get_posts($query) {
	if (!is_admin() && $query->is_main_query()) {
		$query->set('posts_per_page', 1);
	}
}
add_action('pre_get_posts', 'custom_loop_pre_get_posts');



// shortcode: [wp_query_example]
function custom_loop_shortcode_wp_query($atts) {
	extract(shortcode_atts(array(
		'post_per_page'	=> 5,
		'orderby'		=> 'date',
	), $atts));
	$args = array('posts_per_page' => $posts_per_page, 'orderby' => $orderby);
	$posts = new WP_Query($args);
	$output = '<h3>' . esc_html__('Custom Loop Example: WP_Query', 'project') . '</h3>';
	if ($posts->have_posts()) {
		while ($posts->have_posts()) {
			$posts->the_post();
			$output .= '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
			$output .= get_the_content();
		}
		wp_reset_postdata();
	} else {
		$output .= esc_html__('Sorry, no posts matached your criteria.', 'project');
	}
	return $output;
}
add_shortcode('wp_query_example', 'custom_loop_shortcode_wp_query');