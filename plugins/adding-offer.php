<?php

/*
  Plugin Name: BMU: Adds Offer as post type
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Adds type 'offer' as a post type
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

	
add_action('init', 'offer_register'); 
	
	function offer_register() {   

	$labels = array( 
		'name' => _x('Offer', 'post type general name'), 
		'singular_name' => _x('Offer Item', 'post type singular name'), 
		'add_new' => _x('Add New', 'offer item'), 
		'add_new_item' => __('Add New Offer Item'), 
		'edit_item' => __('Edit Offer Item'), 
		'new_item' => __('New Offer Item'), 
		'view_item' => __('View Offer Item'), 
		'search_items' => __('Search Offer'), 
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
	
	register_post_type( 'offer' , $args );
	
	//register_taxonomy("categories", array("country"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
	
	
	
}
?>