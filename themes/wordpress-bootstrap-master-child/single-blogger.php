
<?php get_header(); ?>
			
			
			<?php $blogger = 16;?>
			<div id="content" class="clearfix row-fluid">
            
            	<div id="sidebar1" class="fluid-sidebar sidebar span3 sidebar-industry-blogger" role="complementary">
            	   <div id="blogger-profile-image">
            	       <?php echo wp_get_attachment_image( get_field('blogger_photo'), 'thumbnail'); ?>
            	   </div>
                    <div id="blogger-blog-image">
            	       <a class="" target="_blank" href="<?php the_field('blog_url');?>"><?php echo wp_get_attachment_image( get_field('blog_logo'), 'small'); ?></a>
            	   </div>
            	   
            	   <a class="blogger-sidebar-link" target="_blank" href="<?php the_field('blog_url');?>"><i class="icon-link"></i> <?php the_field('blog_name');?></a><br/>
            	   <a class="blogger-sidebar-email" target="_blank" href="mailto<?php the_field('email');?>"><i class="icon-envelope"></i> <?php the_field('name');?> <?php the_field('surname');?></a>
            	   
            	    <ul class="social">
                    <li><a target="_blank" class="facebook" href="http://www.facebook.com/bigblogmap">Facebook</a></li>
                    <li><a target="_blank" class="twitter" href="http://twitter.com/#!/bigblogmap">Twitter</a></li>
                    <li><a target="_blank" class="google" href="https://plus.google.com/109255999969650423867">Google+</a></li>
                    <li><a target="_blank" class="pinterest" href="http://pinterest.com/bigblogmap/">Pinterest</a></li>
                    </ul>
                    
            	</div><!--End of sidebar-->
			
				<div id="main" class="span6 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<div class="page-header"><h1><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
					
						<section class="post_content">
							<?php the_content(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","bonestheme") . ': ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
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
				
				<div id="sidebar3" class="fluid-sidebar sidebar span2" role="complementary">
            	   <div class="widget">
            	      <h3>Favourite Bloggers</h3>
            	   </div>
                    <div id="blogger-blog-image">
            	      <h3>Recently Viewed</h3>
            	   </div>
            	</div><!--End of sidebar-->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>