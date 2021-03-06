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
		<h4>Favourite Bloggers</h4>
		<p>You don't have any favourite bloggers</p>
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
		<h4>Recently Viewed</h4>
		<p>You don't have any recently viewed bloggers yet</p>
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






class industry_offers extends WP_Widget {

	function industry_offers() {
		// Instantiate the parent object
		parent::__construct( false, 'Industry Offers' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Your Offers</h4>
		<p>You don't have any public offers</p>
		<small><a href="http://bloggermatchup.com/industry/create-an-offer/"><i class="icon-plus"></i> Create new Offer</a></small>
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






class industry_search extends WP_Widget {

	function industry_search() {
		// Instantiate the parent object
		parent::__construct( false, 'Industry Search' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Find bloggers</h4>
		<p>Search our database for bloggers</p>
		<div class="btn-container"><a class="btn btn-success" href="http://bloggermatchup.com/industry/search"><i class="icon-search"></i> Search</a></div>
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


class industry_new extends WP_Widget {

	function industry_new() {
		// Instantiate the parent object
		parent::__construct( false, 'New Bloggers' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>New Bloggers</h4>
		
		  <?php 
			wp_reset_query();
			
			$args = array(
			'post_type' => 'blogger',
			'posts_per_page' => 5);
			
			$recent_posts_query = new WP_Query( $args );
			
			if ( $recent_posts_query->have_posts() ) {
			
				echo '<ul>';
			
			while ( $recent_posts_query->have_posts() ) {
					$recent_posts_query->the_post();
					
						echo '<li>';
						echo '<a href="';
						the_permalink();
						echo '">';
						the_title();
						echo '</a>';
						echo '</li>';
				
					};
					
					echo '</ul>';
				};
		
		?>
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
	register_widget( 'industry_search' );
	register_widget( 'industry_offers' );
	register_widget( 'industry_new' );
}

add_action( 'widgets_init', 'industry_register_widgets' );
 
?>