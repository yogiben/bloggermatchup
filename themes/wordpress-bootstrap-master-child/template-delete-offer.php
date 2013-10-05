<?php
/*
Template Name: Delete Offer
*/
?>

<?php get_header(); ?>



<?php

$offer_ID = $_GET['offer_ID'];

//var_dump($_POST);
?>


<?php if (!(can_edit($user_ID,$offer_ID))){

echo 'You can\'t edit this';

exit();

};

?>

<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "delete_offer" && is_user_logged_in()  && wp_verify_nonce( $_POST['_wpnonce']) ) {

    
wp_delete_post($offer_ID);

wp_redirect("http://bloggermatchup.com/industry/my-offers/");

};
?>

			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span9 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							 <div class="page-header">
							     <h1 class="page-title" itemprop="headline">Delete Offer</h1>
                            </div>
							
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
						
					
                         <p>
                         <strong><?php echo get_the_title($offer_ID);?></strong><br/>
                         Are you sure you want to delete this offer?
                         </p>
        <form id="delete-offer" name="delete_offer" method="post" action="" class="wpcf7-form" enctype="multipart/form-data">

            
            
                <input type="hidden" name="action" value="delete_offer" />
                <input type="hidden" name="offer_ID" value="<?php echo $offer_ID;?>" />
                <?php wp_nonce_field(); ?>
						
						
				<input class="btn btn-danger left" style="float:left" type="submit" value="Delete Offer" tabindex="40" id="submit" name="submit" />
				
            </form>		

					
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