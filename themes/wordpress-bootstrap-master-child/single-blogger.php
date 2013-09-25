
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
            	   
            	    <hr/>
            	    
            	    <h4 class="tooltipster" title="Pageviews is the total number of pages viewed. Repeated views of a single page are counted.">Page Views</h4>
            	    <table>
            	        <tr class="tooltipster" title="<?php the_field('page_views_30_days')?> page views in the last 30 days">
            	            <td>30d</td>
            	            <td><?php the_field('page_views_30_days')?></td>
            	        </tr>
            	        <tr class="tooltipster" title="<?php the_field('page_views_60_days')?> page views in the last 60 days">
            	            <td>30d</td>
            	            <td><?php the_field('page_views_60_days')?></td>
            	        </tr>
            	        <tr class="tooltipster" title="<?php the_field('page_views_1_year')?> page views in the last year">
            	            <td>30d</td>
            	            <td><?php the_field('page_views_1_year')?></td>
            	        </tr>

            	    </table>
            	   
            	    </ul>
            	    
            	    <h4 class="tooltipster" title="Unique Visitors is the number of unduplicated (counted only once) visitors to your website over the course of a specified time period.">Unique Visits</h4>
            	    
            	   <table>
            	        <tr class="tooltipster" title="<?php the_field('unique_visitors_30_days')?> unique visitors in the last 30 days">
            	            <td>30d</td>
            	            <td><?php the_field('unique_visitors_30_days')?></td>
            	        </tr>
            	        <tr class="tooltipster" title="<?php the_field('unique_visitors_60_days')?> unique visitors in the last 60 days">
            	            <td>30d</td>
            	            <td><?php the_field('unique_visitors_60_days')?></td>
            	        </tr>
            	        <tr class="tooltipster" title="<?php the_field('unique_visitors_1_year')?> unique visitors views in the last year">
            	            <td>30d</td>
            	            <td><?php the_field('unique_visitors_1_year')?></td>
            	        </tr>

            	    </table>
            	    
            	    <hr/>
            	    
            	    <ul class="social">
                    
                    <?php
                    if(get_field('facebook_page'))
                    {
                    
                        if (get_field('facebook_friends')){
                        
                            $facebookAdditional = ' and '.get_field('facebook_friends').' friends';
                        
                        } else {
                        
                            $facebookAdditional = "";
                        
                        }
                    
                    ?>
                        <li><a target="_blank" title="<?php the_field('facebook_likes');?> Facebook likes<?php echo $facebookAdditional;?>" class="tooltipster" href="<?php the_field('facebook_page');?>"><span class="facebook"><icon class="icon-facebook social-icon"></icon></span><i class="sidebar-stat"><?php the_field('facebook_likes'); ?> likes</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    
                    if(get_field('twitter_accounts'))
                    {
                    $twitters = get_field('twitter_accounts');
                        
                    $totalAccounts = 0;
                    $totalFollowers = 0;
                        
                    foreach($twitters as $row)
                   {
                        
                        if ($totalAccounts == 0){
                        
                            $twitterPrimaryUrl = $row['twitter_handle'];
                        
                        };

                        $totalAccounts++;
                        $totalFollowers = $totalFollowers + $row['followers'];
                        
                    };
                    
                    if ($totalAccounts > 1){
                    
                        $accountsMessage = ' over '.$totalAccounts.' accounts';
                    
                    };
                    ?>
                        
                        <li><a target="_blank" title="<?php echo $totalFollowers.$accountsMessage?> Twitter followers" class="tooltipster" href="http://twitter.com/<?php echo $twitterPrimaryUrl;?>"><span class="twitter"><icon class="icon-twitter social-icon"></icon></span><i class="sidebar-stat"><?php echo $totalFollowers;?> followers</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    if(get_field('google+'))
                    {
                    
                        if (get_field('google_plus_connections')){
                        
                            $googleAdditional = ' and '.get_field('google_plus_connections').' connections';
                        
                        } else {
                        
                            $googleAdditional = "";
                        
                        }
                    
                    ?>
                    <li><a target="_blank" title="<?php the_field('google_plus_page_plus_ones');?> +1s<?php echo $googleAdditional;?>" class="tooltipster" href="<?php the_field('google+');?>"><span class="google"><icon class="icon-google-plus social-icon"></icon></span><i class="sidebar-stat"><?php the_field('google_plus_page_plus_ones'); ?> +1s</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    if(get_field('linkedin'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="<?php the_field('linkedin_connections');?> connections" class="tooltipster" href="<?php the_field('linkedin');?>"><span class="linkedin"><icon class="icon-linkedin social-icon"></icon></span><i class="sidebar-stat"><?php the_field('linkedin_connections'); ?> followers</i></a></li>
                    <?php
                    };
                    ?>
                    
                    
                    <?php
                    if(get_field('pinterest'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="<?php the_field('pinterest_followers');?> Pinterest followers" class="tooltipster" href="<?php the_field('pinterest');?>"><span class="pinterest"><icon class="icon-pinterest social-icon"></icon></span><i class="sidebar-stat"><?php the_field('pinterest_followers'); ?> followers</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    if(get_field('weibo'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="<?php the_field('youtube_subscribers');?> Youtube subscribers" class="tooltipster" href="<?php the_field('youtube');?>"><span class="youtube"><icon class="icon-youtube social-icon"></icon></span><i class="sidebar-stat"><?php the_field('youtube_subscribers'); ?> subscribers</i></a></li>
                    <?php
                    };
                    ?>
                    
                    
                    <?php
                    if(get_field('weibo'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="<?php the_field('weibo_followers');?> Weibo followers" class="tooltipster" href="<?php the_field('weibo');?>"><span class="weibo"><icon class="icon-weibo social-icon"></icon></span><i class="sidebar-stat"><?php the_field('weibo_followers'); ?> followers</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    if(get_field('klout'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="A Klout score of <?php the_field('klout_score');?>" class="tooltipster" href="<?php the_field('klout');?>"><span class="klout"><icon class="icon-klout social-icon">K</icon></span><i class="sidebar-stat"><?php the_field('klout_score'); ?> Klout score</i></a></li>
                    <?php
                    };
                    ?>
                    
                    
                    <?php
                    if(get_field('kred_score'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="A Kred score of <?php the_field('kred_score');?>" class="tooltipster"><span class="kred"><icon class="icon-kred social-icon">K</icon></span><i class="sidebar-stat"><?php the_field('kred_score'); ?> Kred score</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    if(get_field('peerindex_score'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="A PeerIndex score of <?php the_field('peerindex_score');?>" class="tooltipster"><span class="peerindex"><icon class="icon-peerindex social-icon">P</icon></span><i class="sidebar-stat"><?php the_field('peerindex_score'); ?> PeerIndex score</i></a></li>
                    <?php
                    };
                    ?>
                    
                    <?php
                    if(get_field('flickr'))
                    {
                    
                    
                    ?>
                    <li><a target="_blank" title="This blogger's on Flickr" class="tooltipster"><span class="flickr"><icon class="icon-flickr social-icon"></icon></span><i class="sidebar-stat">Flickr</i></a></li>
                    <?php
                    };
                    ?>
                    
                
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