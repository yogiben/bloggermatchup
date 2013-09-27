<?php

/*
  Plugin Name: BMU: Adds Blogger as post type
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Adds type 'blogger' as a post type
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

	
add_action('init', 'blogger_register'); 
	
	function blogger_register() {   

	$labels = array( 
		'name' => _x('Blogger', 'post type general name'), 
		'singular_name' => _x('Blogger Item', 'post type singular name'), 
		'add_new' => _x('Add New', 'blogger item'), 
		'add_new_item' => __('Add New Blogger Item'), 
		'edit_item' => __('Edit Blogger Item'), 
		'new_item' => __('New Blogger Item'), 
		'view_item' => __('View Blogger Item'), 
		'search_items' => __('Search Blogger'), 
		'not_found' => __('Nothing found'), 
		'not_found_in_trash' => __('Nothing found in Trash'), 
		'parent_item_colon' => '' 
	);   
	
	$args = array( 
		'labels' => $labels, 
		'public' => true, 
		'publicly_queryable' => true, 
		'show_ui' => true, 
		'query_var' => true, 
		'menu_icon' => get_stylesheet_directory_uri() . '/article16.png', 
		'rewrite' => true, 'capability_type' => 'post', 
		'hierarchical' => false, 
		'menu_position' => null, 
		'supports' => array('title','editor','thumbnail','author'),
		'taxonomies' => array('category','tags')
	);   
	
	register_post_type( 'blogger' , $args );
	
	//register_taxonomy("categories", array("country"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
	
	
	
}
?>