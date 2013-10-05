<?php
/*
Template Name: My Offers
*/
?>

<?php get_header(); ?>




			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span9 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							 <div class="page-header">
							     <h1 class="page-title" itemprop="headline">Your Offers</h1>
                                <h4>Make offers so that bloggers can find you</h4>
                            </div>
							
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
						
						<?php
						wp_reset_query();
			
                        $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'offer',
                        'author' => $user_ID
                        );
                        
                        $recent_posts_query = new WP_Query( $args );
                        
                        if ( $recent_posts_query->have_posts() ) {
                        
                            echo '<ul class="no-list-style">';
                        
                        while ( $recent_posts_query->have_posts() ) {
                                $recent_posts_query->the_post();
                                
                                    echo '<li>';
                                    echo '<h5><a href="';
                                    the_permalink();
                                    echo '">';
                                    the_title();
                                    echo '</a></h5>';
                                    echo '<a href="';
                                    echo get_permalink(54);
                                    echo '?edit_offer=true&offer_ID=';
                                    echo get_the_ID();
                                    echo '" class="btn">Edit</a>';
                                    
                                    echo '<a href="http://bloggermatchup.com/industry/my-offers/delete-offer/?offer_ID=';
                                    echo get_the_ID();
                                    echo '" class="btn btn-danger">Delete</a>';
                                    echo '</li>';
                            
                                };
                                
                                echo '</ul>';
                            } else {
                            
                            echo '<h4>You haven\'t created any public offers yet.</h4><a href="http://bloggermatchup.com/industry/create-an-offer/" class="btn btn-success">Create one now</a>';
                            
                            };
                    
                    ?>
						
						
						

					
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","bonestheme") . ':</span> ', ', ', '</p>'); ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
                <div id="sidebar3" class="fluid-sidebar sidebar span3 sidebar-right" role="complementary">
            	   
            	      <?php dynamic_sidebar( 'industry-favourite-recent' ); ?> 
            	   
            	</div><!--End of sidebar-->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>