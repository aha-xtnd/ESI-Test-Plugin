<?php
/*
 * Plugin Name: ESI Test Plugin
 * Plugin URI: https://example.com/
 * Description: A simple plugin to test Edge Side Includes (ESI) using a shortcode.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPLv2 or later
 */

add_action('init', 'register_esi_test_shortcode');

function register_esi_test_shortcode() {
	add_shortcode('test-esi', 'display_esi_test_shortcode');
}

function display_esi_test_shortcode() {
	$output = '';

	// Display the current request URI
	$output .= $_SERVER['REQUEST_URI'] . PHP_EOL;

	// Display the request time
	$output .= 'Request Time: ' . date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME_FLOAT']) . PHP_EOL;

	// Check if a specific plugin's class exists (e.g., Contact Form 7)
	$output .= get_other_plugin_class_exists() . PHP_EOL;

	// Display the current user status
	$output .= get_user_text();

	// Return the output with some basic styling
	return add_html_colour_markup($output);
}

function get_other_plugin_class_exists() {
	return class_exists('WPCF7') ? 'WPCF7 Class exists' : 'WPCF7 Class doesn\'t exist';
}

function get_user_text() {
	$current_user = wp_get_current_user();
	if ($current_user && $current_user->ID !== 0) {
		return 'Hello, ' . esc_html($current_user->display_name);
	}

	return 'Not logged in';
}

function add_html_colour_markup($text) {
	return '<div style="color: green; background-color: #f0f0f0; padding: 10px;">' . nl2br(esc_html($text)) . '</div>';
}
