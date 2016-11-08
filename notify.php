<?php
/**
 * Plugin Name: WP Notify
 * Plugin URI: https://github.com/midhundevasia/wp-notify
 * Version: 1.0.0
 * Author: Midhun Devasia
 * Author URI: http://midhundevasia.com
 * Description: WP-Notify is a notification plugin, this will help you to notify or alert some informations/about latest posts/system maintenance time etc to your visitors. The plugin have an admin area, from there you can choose what type of message you want to show and which style you want to use. You can change the color and display styles from the dropdown list. Three styles are there, StackOverFlow, Safari Alert and Facebook Style, and three events are on load, on scroll and on mouse move.

	Copyright 2010-2016  Midhun Devasia  (email : hello@midhundevasia.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    
*/

// Check for valid url
if(!defined('ABSPATH')) {
	die("Better luck next time!!!");
}

// Include the option page HTML for the adiministration view.
function wp_notify_settings_page() {
	require_once('admin/settings_page.php');
}

/* Administration Area */
if(is_admin()) {
	// callback function for the plugin activation event.
	register_activation_hook( __FILE__, 'activate_wp_notify' );
	add_action( 'init', 'init_notify_admin' );
	add_action( 'admin_menu', 'wp_notify_menu' );
	add_action( 'admin_init', 'register_wp_notify_settings' ); 
}else {
	// Get the option values of wp-notify
	$wp_notify = get_option('wp_notify_options');
	// If the plugin status is ture.
	if($wp_notify[status] == '1') {
		// Init the wp-notify plugin activities
		add_action( 'init', 'init_notify' );
		// Add the CSS codes at the top of the page
		add_action('wp_head', 'wp_notify_css');
		// Add jQuery Script for the notification style & display
		add_action('wp_footer', 'wp_notify_script');
		// Load the notification message from db
		add_action('wp_footer', 'wp_notify_message');
	}
		
}

function init_notify() {
	// Load jQuery
	wp_enqueue_script('jquery');
}

function init_notify_admin() {
	// Set the plugin path
	define(WP_NOTIFY_URL, WP_PLUGIN_URL.'/wp-notify/');
	// Load the JSColor Plugin files
	wp_register_script('wp_notify_scripts', WP_NOTIFY_URL. 'js/jscolor.js');
	// enqueue the script
	wp_enqueue_script('wp_notify_scripts');
}

function wp_notify_menu() {
	// Add WP-Notify Menu to the Settings menu group
	add_options_page('WP Notify Settings', 'WP Notify', 9, "wp_notify", 'wp_notify_settings_page');
}

function register_wp_notify_settings() { 
	// whitelist options
	register_setting( 'wp-notify-group', 'wp_notify_options' );
}

function activate_wp_notify() {
	$wp_notify_opts1 = get_option('wp_notify_options');
	$wp_notify_opts2 = array();
	if ($wp_notify_opts1) {
	    $wp_notify = $wp_notify_opts1 + $wp_notify_opts2;
		update_option('wp_notify_options', $wp_notify);
	}
	else {
		$wp_notify_opts1 = array(	'bg_color'=>'F4A83D',
									'text_color'=>'735005',
									'status'=>'1',
									'border_color'=>'D6800C',
									'button_bg_color'=>'FAD163',
									'button_border_color'=>'735005',
									'button_text_color'=>'735005',
									'style'=>'stackoverflow',
									'event'=>'onLoad',
									'type'=>'custom',
									'custom_message'=> '"Measuring programming progress by lines of code is like measuring aircraft building progress by weight."
(Bill Gates)',
									'other_types'=>'recent_post',
									'post_count'=>'2'
						);	
		$wp_notify = $wp_notify_opts1 + $wp_notify_opts2;
		add_option('wp_notify_options', $wp_notify);		
	}
}

function wp_notify_css(){
	require_once('styles.php');
}
function wp_notify_script(){
	require_once('scripts.php');
}
function wp_notify_message(){
	require_once('messages.php');
}
// Returns the last articles from publish, future
function __get_posts($type = "publish" ,$num = 10) {
	global $wpdb;
	
	// Set the limit clause, if we got a limit
	$num = (int) $num;
	if ( $num ) {
		$limit = "LIMIT $num";
	}
	$sql = "SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status IN ( '$type') ORDER BY post_date DESC $limit";
	$result = $wpdb->get_results($sql, ARRAY_A);
	
	return $result ? $result : array();
}