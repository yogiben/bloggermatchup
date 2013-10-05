<?php
/*
  Plugin Name: BMU: Registers Blogger Widgets
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Blogger Widgets
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

 
class blogger_recent_offers extends WP_Widget {

	function blogger_recent_offers() {
		// Instantiate the parent object
		parent::__construct( false, 'Blogger Recent Offers' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>New Offers</h4>
  
  <?php 
			wp_reset_query();
			
			$args = array(
			'post_type' => 'offer',
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






class blogger_favourite_offers extends WP_Widget {

	function blogger_favourite_offers() {
		// Instantiate the parent object
		parent::__construct( false, 'Blogger Favourite Offers' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Favourite Offers</h4>
		
		<ul>
			
			<li>
				<a href="#">Favourite Offer 1</a>
			</li>
			
			
			<li>
				<a href="#">Favourite Offer 2</a>
			</li>
				
		</ul>
		
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





class blogger_update_location extends WP_Widget {

	function blogger_update_location() {
		// Instantiate the parent object
		parent::__construct( false, 'Blogger Update Location' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Update Location</h4>
		
		<p>You're current location is:<br/>
		
		<span class="tooltipster" title="Blogger's current location"><img class="country-flag" src="http://bloggermatchup.com/img/flags/<?php echo strtolower(get_field('current_location',16));?>.png"></img> <?php $field = get_field_object('field_52480e33a95d5'); echo $field['choices'][get_field('current_location',16)];?></span>
		<br/>
		
		<div class="btn-container"><a class="btn btn-primary"><i class="icon-map-marker"></i> Update Location</a></div>
		
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



class blogger_visitors extends WP_Widget {

	function blogger_visitors() {
		// Instantiate the parent object
		parent::__construct( false, 'Blogger Visitors' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Visitors this week</h4>
		
		<p>15 visitors this week</p>
		
		
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





class blogger_update_profile extends WP_Widget {

	function blogger_update_profile() {
		// Instantiate the parent object
		parent::__construct( false, 'Update Profile' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>Update your profile</h4>
		<p>A good profile is the key to getting headhunted</p>
		<div class="btn-container"><a class="btn btn-success"><i class="icon-pencil"></i> Update Profile</a></div>
		
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





class promotion extends WP_Widget {

	function promotion() {
		// Instantiate the parent object
		parent::__construct( false, 'From our Blog' );
	}

	function widget( $args, $instance ) {
	?>
	
	<div class="widget">
		<h4>From our Blog</h4>
		
		<?php 
			wp_reset_query();
			
			$args = array(
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




function blogger_register_widgets() {
	register_widget( 'blogger_recent_offers' );
	register_widget( 'blogger_favourite_offers' );
	register_widget( 'blogger_update_location' );
	register_widget( 'blogger_visitors' );
	register_widget( 'blogger_update_profile' );
	register_widget( 'promotion' );
}

add_action( 'widgets_init', 'blogger_register_widgets' );
 
?>