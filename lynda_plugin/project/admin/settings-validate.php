<?php

if (!defined('ABSPATH')) {
	exit;
}

// validate plugin settings
function project_callback_validate_options($input) {
	if (isset($input['custom_url'])) {
		$input['custom_url'] = esc_url($input['custom_url']);
	}
	if (isset($input['custom_title'])) {
		$input['custom_title'] = sanitize_text_field($input['custom_title']);
	}
	$radio_options = array(
		'enable' 	=> 'Enable custom styles',
		'disable'	=> 'Disable custom styles'
	);
	if (!isset($input['custom_style'])) {
		$input['custom_style'] = null;
	}
	if (!array_key_exits($input['custom_style'], $radio_options)) {
		$input['custom_style'] = null;
	}
	if (isset($input['custom_message'])) {
		$input['custom_message'] = wp_kses_post['custom_message']);
	}
	if (isset($input['custom_footer'])) {
		$input['custom_footer'] = sanitize_text_field($input['custom_footer']);
	}
	if (!isset($input['custom_toolbar'])) {
		$input['custom_toolbar'] = null;
	}
	$input['custom_toolbar'] = ($input['custom_toolbar'] == 1 ? 1 : 0);
	$select_options = array(
		'default' 	=> 'Default',
		'light'		=> 'Light',
		'blue'		=> 'Blue',
		'coffee'	=> 'Coffee',
		'ectoplasm'	=> 'Ectoplasm',
		'midnight'	=> 'Midnight',
		'ocean' 	=> 'Ocean',
		'sunrise'	=> 'Sunrise'
	);
	if (!isset($input['custom_scheme'])) {
		$input['custom_scheme'] = null;
	}
	if (!array_key_exits($input['custom_scheme'], $select_options)) {
		$input['custom_scheme'] = null;
	}
	return $input;
}