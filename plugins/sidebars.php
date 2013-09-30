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
 
?>