<?php
/*
Plugin Name: Hide Admin Bar
Plugin URI: http://bigblogmap.com/map/support/
Description: Hide Admin bar for Non-admins
Author: Ben Jones
Author URI: http://benjaminpeterjones.com/
*/

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
?>