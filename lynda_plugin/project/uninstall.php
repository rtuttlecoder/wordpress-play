<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

// uninstall the plugin
delete_option('project_options');

