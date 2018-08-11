<?php

if (!defined('ABSPATH')) {
	exit;
}

// add a top-level Admin menu item
function project_add_toplevel_menu() {
	add_menu_page(
		'Project Settings',					// page title
		'Project',							// menu title
		'manage_options',					// capability
		'project',							// menu slug
		'project_display_settings_page',	// callable function to display settings page
		'dashicons-admin-generic',			// icon url
		null 								// position/priority
	);
}
add_action('admin_menu', 'project_add_toplevel_menu');


// add a sub-level Admin menu item
function project_add_sublevel_menu() {
	add_submenu_page(
		'options-general.php',				// page to add menu item to (Setting section)
		'Project Settings',
		'Project',
		'manage_options',
		'project',
		'project_display_settings_page'
	);
}
add_action('admin_menu', 'project_add_sublevel_menu');

