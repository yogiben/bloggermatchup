<?php
/*
  Plugin Name: BMU: Registers Special Sidebars
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Sidebars
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

 
$args = array(
	'name'          => __( 'Industry Blogger Blogger', 'industry_blogger_blogger' ),
	'id'            => 'industry_blogger_blogger',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>' );
	
register_sidebar($args);



$args = array(
	'name'          => __( 'Industry Favourite Recent', 'industry_favourite_recent' ),
	'id'            => 'industry_favourite_recent',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>' );
	
register_sidebar($args);


$args = array(
	'name'          => __( 'Industry Dashboard', 'industry_dashboard' ),
	'id'            => 'industry_dashboard',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>' );
	
register_sidebar($args);




$args = array(
	'name'          => __( 'Blogger Dashboard', 'blogger_dashboard' ),
	'id'            => 'blogger_dashboard',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>' );
	
register_sidebar($args);




 
?>