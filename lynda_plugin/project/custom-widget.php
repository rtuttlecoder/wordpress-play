<?php

class My_Widget extends WP_Widget {
	// setup widget
	public function __construct() {
		$options = array(
			'classname' 	=> 'my_widget',
			'description'	=> 'My Widget is awesome.',
		);
		parent::__construct('my_widget', 'My Widget', $options);
	}

	// output widget content
	public function widget($args, $instance) {

	}

	// output widget form fields -- widget screen in Admin
	public function form($instance) {

	}

	// process widget options
	public function update($new_instance, $old_instance) {

	}
}

// register widget
function project_register_widget() {
	register_widget('My_Widget');	
}
add_action('widgets_init', 'project_register_widget');