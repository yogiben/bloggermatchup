<?php
/*
Template Name: Blogger Dashboard
*/
?>

<?php $blogger = 16; ?>

<?php get_header(); ?>
			
			<?php
			
			?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							 <div class="page-header">
							     <h1 class="page-title" itemprop="headline">Hi, <?php the_field('name',$blogger);?></h1>
                            </div>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							
                        <div class="row-fluid">
                            
                            <div class="span4">
                                <?php the_widget( 'blogger_visitors'); ?> 
                            </div>
                            
                            <div class="span4">
                                <?php the_widget( 'blogger_favourite_offers'); ?> 
                            </div>
                            
                            <div class="span4">
                                <?php the_widget( 'blogger_recent_offers'); ?> 
                            </div>
                            
                        </div>
                        
                        <div class="row-fluid">
                            
                            <div class="span4">
                                <?php the_widget( 'blogger_update_profile'); ?> 
                            </div>
                            
                            <div class="span4">
                                <?php the_widget( 'blogger_update_location'); ?> 
                            </div>
                            
                            <div class="span4">
                                <?php the_widget( 'promotion'); ?> 
                            </div>
                            
                        </div>
                        
                        
                        
                        <!--<?php dynamic_sidebar('blogger_dashboard');?>-->
							
					
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
			
				</div> <!-- end #main 
    
			</div> <!-- end #content -->

<?php get_footer(); ?>