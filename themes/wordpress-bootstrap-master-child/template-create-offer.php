<?php
/*
Template Name: Create Offer
*/
?>
<?php acf_form_head();?>

<?php get_header(); ?>

<?php //var_dump($_POST);?>
			

<?php 
    if ($_GET['edit_offer'] == 'true'){
    
        $edit_offer = true;
    
        $offer_ID = $_GET['offer_ID'];
        
        $title = 'Edit Offer';
        
    } else {
    
    $edit_offer = false;
    
    $title = 'Create Offer';
    
    }
    

    
?>
            
            
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span9 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							 <div class="page-header">
							     <h1 class="page-title" itemprop="headline"><?php
                                echo $title;
                            
                            ?></h1>
                            <h4>Make offers so that bloggers can find you</h4>
                            
                            </div>
							
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
						
						
						
						<?php
						
						  if ($edit_offer == true){
						  
						      $post_to_edit = $offer_ID;
						      
                          } else {
                          
                            $post_to_edit == 'new';
                          
                          }

						
						?>
						
						<?php
						
						$options = array(
                        'post_id' => $post_to_edit, // post id to get field groups from and save data to
                        'field_groups' => array(84), // this will find the field groups for this post (post ID's of the acf post objects)
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
                        'submit_value' => 'Create Offer', // value for submit field
                        'updated_message' => 'Post updated.', // default updated message. Can be false to show no message
                    );
                                            
                                            
                                            
                    acf_form($options); 
                                            
                    
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