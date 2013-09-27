
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
            	   <a class="blogger-sidebar-email" target="_blank" href="mailto:<?php the_field('email');?>"><i class="icon-envelope"></i> <?php the_field('name');?> <?php the_field('surname');?></a>
            	   
            	    <hr/>
            	    
            	    <div id="sidebar-section-traffic" class="sidebar-section">
                        
                        <h4 class="tooltipster" title="Pageviews is the total number of pages viewed. Repeated views of a single page are counted.">Page Views</h4>
                        <table>
                            <tr class="tooltipster" title="<?php the_field('page_views_30_days')?> page views in the last 30 days">
                                <td>30d</td>
                                <td><?php the_field('page_views_30_days')?></td>
                            </tr>
                            <tr class="tooltipster" title="<?php the_field('page_views_60_days')?> page views in the last 60 days">
                                <td>60d</td>
                                <td><?php the_field('page_views_60_days')?></td>
                            </tr>
                            <tr class="tooltipster" title="<?php the_field('page_views_1_year')?> page views in the last year">
                                <td>1y</td>
                                <td><?php the_field('page_views_1_year')?></td>
                            </tr>
    
                        </table>
                        
                        <table>
                            <tr>
                                <td>Bounce rate: <?php echo get_field('bounce_rate'); ?></td>
                            </tr>
                        </table>
                       
                        
                        
                        <h4 class="tooltipster" title="Unique Visitors is the number of unduplicated (counted only once) visitors to your website over the course of a specified time period.">Unique Visits</h4>
                        
                       <table>
                            <tr class="tooltipster" title="<?php the_field('unique_visitors_30_days')?> unique visitors in the last 30 days">
                                <td>30d</td>
                                <td><?php the_field('unique_visitors_30_days')?></td>
                            </tr>
                            <tr class="tooltipster" title="<?php the_field('unique_visitors_60_days')?> unique visitors in the last 60 days">
                                <td>60d</td>
                                <td><?php the_field('unique_visitors_60_days')?></td>
                            </tr>
                            <tr class="tooltipster" title="<?php the_field('unique_visitors_1_year')?> unique visitors views in the last year">
                                <td>1y</td>
                                <td><?php the_field('unique_visitors_1_year')?></td>
                            </tr>
    
                        </table>
            	    
            	    </div>
            	    
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
                    
                    
                    <div class="sidebar-section-hidden">
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
                        
                    </div>
                    <div class="sidebar-slide-down">Show more</div>
                
                    </ul>
                    
            	</div><!--End of sidebar-->
			
				<div id="main" class="span6 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							 <div class="page-header">
							     <h1><?php the_field('blog_name'); ?></h1>
							     <h4><?php the_field('blog_short_description'); ?></h4>
                                  <table>
                                      <tr>
                                          <td class="tooltipster" title="The category of this blog"><i class="icon-asterisk"></i> <?php the_field('category'); ?></td>
                                          <td class="tooltipster" title="The primary way this blogger communicates"><i class="icon-indent-right"></i> <?php the_field('primary_medium'); ?></td>
                                          <td class="tooltipster" title="The budget range this blogger tends to write about"><i class="icon-usd"></i> <?php $field = get_field_object('field_523c56837bccc'); echo $field['choices'][get_field('budget_range')]; ?></td>
                                          <td class="tooltipster" title="The blog language"><i class="icon-comment"></i> <?php the_field('language');?> <?php echo implode(', ', get_field('other_language')); ?></td>
                                      </tr>
                                  </table>
                              </div>
						
						</header> <!-- end article header -->
					
						<section class="" id="blogger-blog">
						
                          
                          
                          <h4>Blog Description</h4>
                          <p>
                              <?php the_field('blog_description'); ?>
                          </p>
						

                          <table>
						      <tr>
						          <td><i class="icon-tag"></i> <?php echo implode(', ', get_field('niches')); ?>              <?php
                                       if (get_field('tags')){
                                        echo ', ';
						                  echo  str_replace(",",", ",get_field('tags'));
                                        };
                                        ?>
						          </td>
						      </tr>
						      <tr>
						          
                              </tr>
                          </table>
					
						</section>
						
						<section id="blogger-blog">
						    <h4>Author</h4>
						    <p>
						    <table>
                                <tr>
                                    <td>
                                    <?php
                                    
                                    $field = get_field_object('author_type');
                                    
                                    if (get_field('author_type') == 'single_male'){
                                    
                                      echo '<span class="author-icon tooltipster" title="Single Male">Author: <i class="icon-male"></i></span>';
        
                                    } else if (get_field('author_type') == 'single_female') {
                                       
                                         echo '<span class="author-icon  tooltipster" title="Single Female">Author: <i class="icon-female"></i></span>';
                                         
                                    } else if (get_field('author_type') == 'couple') {
                                    
                                        echo '<span class="author-icon tooltipster" title="Couple">Author: <i class="icon-male"></i><i class="icon-female"></i></span>';
        
                                    } else if (get_field('author_type') == 'group') {
                                    
                                        echo '<span class="author-icon tooltipster" title="Couple">Author: <i class="icon-group"></i></span>';
        
                                    }
                                    ?>
                                    </td>
                                    
                                    <td>
                                    <?php
                                         
                                         $dob = get_field('date_of_birth');
                                         
                                         $birthDate = substr($dob,4,-2).'/'.substr($dob,6).'/'.substr($dob,0,-4);
                                         
                                         //explode the date to get month, day and year
                                         $birthDate = explode("/", $birthDate);
                                         //get age from date or birthdate
                                         $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
                                         echo "Age: <strong>".$age.'</strong>';
                                    ?>
                                    
                                    </td>
                                    
                                    <td>
                                        Grew up: <strong><?php $field = get_field_object('grew_up'); echo $field['choices'][get_field('grew_up')];?></strong>
                                    </td>
                                    
                                    <?php
                                    
                                    $field = get_field_object('lifestyle');
                                    $lifestyle = $field['choices'][get_field('lifestyle')];
                                    
                                    if ($lifestyle == 'Part Time Blogger'){
                                    
                                        $lifestyle_additional = '. Additional work: '.get_field('other_work');

                                    };
                                    
                                    $lifestyle_additional
                                    
                                    ?>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                
                                    <td class="tooltipster" title="<?php echo $lifestyle; echo $lifestyle_additional;?>">
                                        Work life: <strong><?php echo $lifestyle;?></strong>
                                    </td>                                    
                                    
						          </tr>
						      </table>
						          
                              <table>
						          
						          <tr>
						              <td>Languages spoken: <strong><?php $field = get_field('languages_spoken');
                                    
                                    $language_count = 0;
                                    
                                    
                                    while(has_sub_field('languages_spoken'))
                                    {
                                        $language_count++;
                                        
                                        echo get_sub_field('blogger_language');
                                        
                                        if ($language_count != count($field)){
                                        
                                            echo ', ';
                                        
                                        }
                                        
                                        
                                        
                                    };
                                    ?>
						          </strong>
						          </td>
						          </tr>
						      </table>
						    
						</section>
						
						<section id="blogger-availability">
						    
						    <h4>Availability</h4>
						    
						    <table>
						        <tr>
						            <td>Based: <strong><?php the_field('based_city');?>, <?php $field = get_field_object('based_country'); echo $field['choices'][get_field('based_country')];?></strong></td>
						        </tr>
						    </table>
						    
						    <h5>Travel Plans</h5>
						    
						    <?php
						    
						    $countries_3_months = array();
						    
						    $countries_6_months = array();
						    
						    $countries_12_months = array();
						    
						    ?>
						    </section>
						    
						    
						    <section id="blogger-travelplans">
						    <div class="countries-visiting_section">The next three months: <br/>
						    <?php
						    
						    $country_count == 0;
						    
						    while(has_sub_field('countries_3_months')){
						    
						       $country_count++;
                                        
                                        $sub_field = get_sub_field_object('country_visited');
                                        
                                        echo '<img class="country-flag" src="http://bloggermatchup.com/img/flags/'.strtolower(get_sub_field('country_visited')).'.png"></img>';
                                        echo $sub_field['choices'][get_sub_field('country_visited')];
                                        
                                        if ($country_count != count(get_field('countries_3_months'))){
                                        
                                            echo ' ';
                                        
                                        };
                                        
                                        array_push($countries_3_months,get_sub_field('country_visited'));
						    
                                };
                            ?>
                            
                            
                            <div class="countries-visiting_section">In 3-6 months time:<br/>
						    <?php
						    
						    $country_count == 0;
						    
						    while(has_sub_field('countries_6_months')){
						    
						       $country_count++;
                                        
                                        $sub_field = get_sub_field_object('country_visited');
                                        
                                        echo '<img class="country-flag" src="http://bloggermatchup.com/img/flags/'.strtolower(get_sub_field('country_visited')).'.png"></img>';
                                        echo $sub_field['choices'][get_sub_field('country_visited')];
                                        
                                        if ($country_count != count(get_field('countries_6_months'))){
                                        
                                            echo ' ';
                                        
                                        };
                                        
                                        array_push($countries_6_months,get_sub_field('country_visited'));
						    
                                };
                            ?>
                            
                            </div>
                            
                            <div class="countries-visiting_section">In 6-12 months time:<br/>
						    <?php
						    
						    $country_count == 0;
						    
						    while(has_sub_field('countries_12_months')){
						    
						       $country_count++;
                                        
                                        $sub_field = get_sub_field_object('country_visited');
                                        
                                        echo '<img class="country-flag" src="http://bloggermatchup.com/img/flags/'.strtolower(get_sub_field('country_visited')).'.png"></img>';
                                        echo $sub_field['choices'][get_sub_field('country_visited')];
                                        
                                        if ($country_count != count(get_field('countries_12_months'))){
                                        
                                            echo ' ';
                                        
                                        };
                                        
                                        array_push($countries_12_months,get_sub_field('country_visited'));
						    
                                };
                            ?>
						    </div>
						    
						    
						    <div id="chart_div" style="width: 475; height: 300px;"></div>
						</section>
						
						<section>
						    
						    <h4>Audience</h4>
						    <table>
						        <tr>
						            <td>1st: <strong><?php
						            
						            echo '<img class="country-flag" src="http://bloggermatchup.com/img/flags/'.strtolower(get_field('visitor_nationality_1')).'.png"></img>';
						            
						            $field = get_field_object('visitor_nationality_1');
						            echo $field['choices'][get_field('visitor_nationality_1')];
						            
						            ?>
						            
						            </strong></td>
						            
						            
                                    <td>2nd: <strong><?php
						            
						            echo '<img class="country-flag" src="http://bloggermatchup.com/img/flags/'.strtolower(get_field('visitor_nationality_2')).'.png"></img>';
						            
						            $field = get_field_object('visitor_nationality_2');
						            echo $field['choices'][get_field('visitor_nationality_2')];
						            
						            ?>
						            
						            </strong></td>

						            
                                    <td>3rd: <strong><?php
						            
						            echo '<img class="country-flag" src="http://bloggermatchup.com/img/flags/'.strtolower(get_field('visitor_nationality_3')).'.png"></img>';
						            
						            $field = get_field_object('visitor_nationality_3');
                                    echo $field['choices'][get_field('visitor_nationality_3')];
						            
						            ?>
						            
						            </strong></td>
						            
						        </tr>
						    </table>
						    
						    <table>
						        <tr>
						            <td>Typical age: <strong><?php the_field('audience');?></strong></td>
						            <td>Typical gender: <strong><?php the_field('gender_balance');?></strong></td>
						        </tr>
						    </table>
						    
						    <p><?php the_field('demographics_description');?></p>
						    
						</section>
						
						
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
			
			<script>
			    $(document).ready(function(){
			    
			         $('.sidebar-slide-down').each(function(){
			         
			             $(this).click(function(){
			                 
			                 if ($(this).html() =='Show more'){
			                 
			                    $(this).html('Show less');
			                    $(this).prev().slideDown();
			                 
                             } else {
                             
                                $(this).html('Show more');
                                $(this).prev().slideUp();
                             
                             };
			             
                         });

                     });
			    
                });
			</script>
			
			<?php
			
			$json_countries_3_months = array();
			$json_countries_6_months = array();
			$json_countries_12_months = array();
			
			$json_countries = array();
			
			array_push($json_countries,array('Country','Visited'));
						
			foreach ($countries_3_months as $country){
			
                $country_pair = array();
			
                array_push($country_pair,$country);
                array_push($country_pair,0);
                
                array_push($json_countries,$country_pair);

            };
            
            
            foreach ($countries_6_months as $country){
            
                $country_pair = array();
			
                array_push($country_pair,$country);
                array_push($country_pair,(1/3));
                
                array_push($json_countries,$country_pair);
                
            };
            
            
            foreach ($countries_12_months as $country){
            
                $country_pair = array();
			
                array_push($country_pair,$country);
                array_push($country_pair,(2/3));
                
                array_push($json_countries,$country_pair);
                
                
            };

            
            $json_countries = json_encode($json_countries);
            
			
			?>
			
			
			<script type='text/javascript' src='https://www.google.com/jsapi'></script>
			<script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable(
        
            <?php
            
            echo $json_countries;
            
            ?>
        
        );

        var options = {
        
        colorAxis: {colors: ['green', 'blue']},
        legend: 'none',
        tooltip:  {textStyle: {trigger : 'none'}}
        
        };

        var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    };
    </script>

<?php get_footer(); ?>