<?php
/*
Template Name: Results
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span9 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							 <div class="page-header">
							     <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
                                <h4>Displaying bloggers in the Travel category</h4>
                            </div>
                            
                            <div class="results-number-of-matchees">2 blogger matching 5/5 criteria</div>
                            
                                
                                <?php results_blogger(16);?>
                                <?php results_blogger(16);?>
                                
                           <div class="results-number-of-matchees">1 blogger matching 4/5 criteria</div>
                                <?php results_blogger(16);?>
							
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
					
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