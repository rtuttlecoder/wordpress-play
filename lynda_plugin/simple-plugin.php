<?php
/*
Plugin Name: Simple Plugin
Description: Welcome to WordPress plugin development.
Plugin URI:  https://accessidaho.org/
Author:      Richard Tuttle
Version:     1.0
License:     GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/



function myplugin_action_hook_sendemail() {
	wp_mail('email@example.com', 'Sub', 'Msg...');
}
add_action('init', 'myplugin_action_hook_sendemail');


/**
 * will extend the_content() and append the new $content info
 */
function myplugin_filter_hook($content) {
	$content = $content . '<p>Custom content....</p>';
	return $content;
}
add_filter('the_content', 'myplugin_filter_hook');



function myplugin_on_deactivation() {
	if (!current_user_can('activate_plugins')) return;
	flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'myplugin_on_deactivation');

function myplugin_on_activtion() {
	if (!current_user_can('activate_plugins')) return;
	// add_option();
}
register_activation_hook(__FILE__, 'myplugin_on_activtion');

function myplugin_on_uninstall() {
	if (!current_user_can('activate_plugins')) return;
	// delete_option();
}
register_uninstall_hook(__FILE__, 'myplugin_on_uninstall');



