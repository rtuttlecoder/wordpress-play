<?php

if (!defined('ABSPATH')) {
	exit;
}

// Settings page registration and make sections
function project_register_settings() {
	register_setting(
		'project_options',						// option group
		'project_options',						// option name
		'project_callback_validate_options'		// callable sanitize callback
	);

	add_settings_section(
		'project_section_login',				// section id
		'Customize Login Page',					// section title
		'project_callback_section_login',		// callable 
		'project'								// page on which section to be displayed
	);

	add_settings_section(
		'project_section_admin',
		'Customize Admin Area',
		'project_callback_section_admin',
		'project'
	);

	add_settings_field(
		'custom_url',							// id
		'Custom URL',							// title
		'project_callback_field_text',			// callback
		'project',								// page
		'project_section_login',				// section
		['id' => 'custom_url', 'label' => 'Custom URL for the login logo link']	// args
	);

	add_settings_field(
		'custom_title',						
		'Custom Title',							
		'project_callback_field_text',			
		'project',								
		'project_section_login',				
		['id' => 'custom_title', 'label' => 'Custom Title attribute for logo link']	
	);

	add_settings_field(
		'custom_style',						
		'Custom Style',							
		'project_callback_field_radio',			
		'project',								
		'project_section_login',				
		['id' => 'custom_style', 'label' => 'Custom CSS for the Login screen']	
	);

	add_settings_field(
		'custom_message',						
		'Custom Message',							
		'project_callback_field_textarea',			
		'project',								
		'project_section_login',				
		['id' => 'custom_message', 'label' => 'Custom text and/or markup']	
	);

	add_settings_field(
		'custom_footer',						
		'Custom Footer',							
		'project_callback_field_text',			
		'project',								
		'project_section_admin',				
		['id' => 'custom_footer', 'label' => 'Custom footer text']	
	);

	add_settings_field(
		'custom_toolbar',						
		'Custom Toolbar',							
		'project_callback_field_checkbox',			
		'project',								
		'project_section_admin',				
		['id' => 'custom_toolbar', 'label' => 'Remove new post and comment links from the Toolbar']	
	);

	add_settings_field(
		'custom_scheme',						
		'Custom Scheme',							
		'project_callback_field_select',			
		'project',								
		'project_section_admin',				
		['id' => 'custom_scheme', 'label' => 'Default color scheme for new users']	
	);
}
add_action('admin_init', 'project_register_settings');
