<?php
/*
Template Name: Blogger Edit Profile
*/
?>

<?php acf_form_head();?>
<?php get_header(); ?>
			
<?php $blogger = 16; ?>

<?php


if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "blogger_upload_images" && is_user_logged_in()) {

	
	$blogger_to_edit = $_POST['blogger_to_edit'];
	
	echo 'Uploading Images';
	
	if (strlen($_FILES['blogger_photo']['name'])>0){

	   //Blogger Photo
	   
	   $blogger_photo_id = process_image('blogger_photo',$blogger,'blogger_photo');
	   
	   update_post_meta($blogger,'blogger_photo',$blogger_photo_id);

	};
	
	
	
	if (strlen($_FILES['blog_logo']['name'])>0){

	   //Blogger Photo
	   
	   $blog_logo_id = process_image('blog_logo',$blogger,'blogger_photo');
	   
	   update_post_meta($blogger,'blog_logo',$blog_logo_id);

	}

}

?>



<?php
			
			$form_IDs = array();
			
			//Audience
			$form_IDs[68] = 12;
			
			//Availability
			$form_IDs[67] = 9;
			
			//Blog
			$form_IDs[44] = 6;
			
			//Experience
			$form_IDs[75] = 13;
			
			//Personal
			$form_IDs[42] = 5;
			
			//Pictures
			$form_IDs[118] = 'pictures';

//			var_dump($form_IDs);
			?>
			
			
			<div id="content" class="clearfix row-fluid">
            
            	<?php get_sidebar('edit'); // sidebar 1 ?>
			
				<div id="main" class="span8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<div class="page-header"><h1><?php the_title(); ?></h1></div>
						
						</header> <!-- end article header -->
					
						<section class="post_content">
                        <?php the_content(); ?>
                        
                        <?php 
                        
                        $page_ID = get_the_ID();
                        
                        $form_ID = $form_IDs[$page_ID]; 
                        
                        ?>
                        
						<?php //var_dump($_FILES);?>
						<?php //var_dump($_POST);?>
						
                        <?php
							
                            $options = array(
                            'post_id' => $blogger, // post id to get field groups from and save data to
                            'field_groups' => array($form_ID), // this will find the field groups for this post (post ID's of the acf post objects)
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
                                                    
                            if ($form_ID != 'pictures'){
                            
                            acf_form($options);
                            
                            } else {

                               ?>
							   
							   <form id="image_form" name="upload_images" method="post" action="" enctype="multipart/form-data">
								   
								   <h4>Your Picture</h4>
								   <?php 
								   
								   if (get_field('blogger_photo',$blogger)){
								   
										echo wp_get_attachment_image( get_field('blogger_photo',$blogger), 'thumbnail');
										
									};
								   
									?>	
									<br/>
								   <input type="file" size="60" name="blogger_photo" id="blogger_photo">
								   
								   
								   
								   <h4>Blog Logo</h4>
								   <?php 
								   
								   if (get_field('blog_logo',$blogger)){
								   
										echo wp_get_attachment_image( get_field('blog_logo',$blogger), 'small');
										
									};
								   
									?>	
									<br/>
								   <input type="file" size="60" name="blog_logo" id="blog_logo">
								   
								   <input type="hidden" name="action" value="blogger_upload_images" />
								   <input type="hidden" name="blogger_to_edit" value="<?php echo $blogger ?>" />
							   
								<input type="submit" value="Update" class="btn btn-success pull-right" />
							   
							   </form>
							   <?php

                            }
                            
                        ?>
                            
                            
					
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