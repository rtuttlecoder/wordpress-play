<?php

/**
 * Plugin Name: Sample Plugin for WordPress
 * Description: This is an example description
 * Plugin URI: https://tuttlemm.com
 * Author: Richard Tuttle
 * Version: 1.0
 * Text Domain: project
 * Domain Path: /languages
 * License: MIT
 *
 */

if (!defined('ABSPATH')) {
	exit;
}

// include dependencies
if (is_admin()) {
	require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
	require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
	require_once plugin_dir_path(__FILE__) . 'admin/register-settings.php';
	require_once plugin_dir_path(__FILE__) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path(__FILE__) . 'admin/settings-validate.php';
}

require_once plugin_dir_url(__FILE__) . 'includes/core-functions.php';

// default plugin options
function project_options_default() {
	return array(
		'custom_url'		=> 'https://wordpress.org',
		'custom_title'		=> 'Powered by WordPress',
		'custom_style'		=> 'disable',
		'custom_message'	=> '<p class="custom-message">My custom message</p>',
		'custom_footer'		=> 'Special message for users',
		'custom_toolbar'	=> false,
		'custom_scheme'		=> 'default',
	);
}

