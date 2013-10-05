<?php
/*
Template Name: Blogger Edit Profile
*/
?>

<?php acf_form_head();?>
<?php get_header(); ?>
			
<?php $blogger = 16; ?>
			
			<div id="content" class="clearfix row-fluid">
            
            	<?php get_sidebar('edit'); // sidebar 1 ?>
			
				<div id="main" class="span8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<div class="page-header"><h1><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
					
						<section class="post_content">
                        
                        <?php
							
                            $options = array(
                            'post_id' => $blogger, // post id to get field groups from and save data to
                            'field_groups' => array(), // this will find the field groups for this post (post ID's of the acf post objects)
                            'form' => true, // set this to false to prevent the <form> tag from being created
                            'form_attributes' => array( // attributes will be added to the form element
                                'id' => 'post',
                                'class' => '',
                                'action' => '',
                                'method' => 'post',
                            ),
                            'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url
                            'html_before_fields' => '', // html inside form before fields
                            'html_after_fields' => '', // html inside form after fields
                            'submit_value' => 'Update', // value for submit field
                            'updated_message' => 'Post updated.', // default updated message. Can be false to show no message
                        );
                                                    
                            
                            acf_form($options);
                            
                        ?>
                            
                            
                            <?php the_content(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","bonestheme") . ': ', ', ', '</span>'); ?></p>
							
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
    
			</div> <!-- end #content -->

<?php get_footer(); ?>