<?php
/*
Template Name: Search
*/
?>


<?php

$options = array(
    'field_groups' => array(78), // this will find the field groups for this post (post ID's of the acf post objects)

    'form_attributes' => array( // attributes will be added to the form element
        'id' => 'post',
        'class' => '',
        'action' => 'search',
        'method' => 'post',
    ),
    
    'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
    'html_before_fields' => '', // html inside form before fields
    'html_after_fields' => '', // html inside form after fields
    'submit_value' => 'Search', // value for submit field
    'updated_message' => 'Search.', // default updated message. Can be false to show no message
);

?>
<?php acf_form_head();?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<div class="page-header"><h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							
                        
							<?php acf_form($options);?>
					
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
    
                
                <div id="sidebar3" class="fluid-sidebar sidebar span2 sidebar-right" role="complementary">
            	   
            	      <?php dynamic_sidebar( 'industry-favourite-recent' ); ?> 
            	   
            	</div><!--End of sidebar-->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>