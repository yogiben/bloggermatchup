<?php
/*
  Plugin Name: BMU: Registers Industry Widgets
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Industry Widgets
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

 
class industry_blogger_contact extends WP_Widget {

	function industry_blogger_contact() {
		// Instantiate the parent object
		parent::__construct( false, 'Industry Blogger Contact' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<table>
		  <tr>
			  <td><a class="btn btn-success" target="_blank" href="mailto:<?php the_field('email');?>"><i class="icon-envelope"></i> Get in touch</a></td>
		   </tr>
		   <tr>
			  <td><a class="btn btn-primary"><i class="icon-star-empty"></i> Favourite</a></td>
		  </tr>
	  </table>
  </div>
		
	<?php
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
};





class industry_favourite extends WP_Widget {

	function industry_favourite() {
		// Instantiate the parent object
		parent::__construct( false, 'Industry Favourite' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Favourites Bloggers</h4>
	</div>
		
	<?php
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
};





class industry_recent extends WP_Widget {

	function industry_recent() {
		// Instantiate the parent object
		parent::__construct( false, 'Industry Recent' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Favourites Bloggers</h4>
	</div>
		
	<?php
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
};





function industry_register_widgets() {
	register_widget( 'industry_blogger_contact' );
	register_widget( 'industry_favourite' );
	register_widget( 'industry_recent' );
}

add_action( 'widgets_init', 'industry_register_widgets' );
 
?>