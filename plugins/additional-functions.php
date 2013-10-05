<?php

/*
  Plugin Name: Adds custom functions
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Adds type 'place' as a post type
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
 
function my_deregister_styles() {
	wp_deregister_style( 'wp-admin' );
}
 
 
 
function can_edit($user_ID,$post_ID){

    $allowed_edit = false;

    wp_reset_query();
    
/*    echo 'author: ';
    echo $user_ID;
    echo '  post: ';
    echo $post_ID;*/
    
    $args_can_edit = array(
    'author' => $user_ID,
    'post_type'=> 'offer');
    
    $can_edit_query = new WP_Query( $args_can_edit );
    
    if ( $can_edit_query->have_posts() ) {
    
//    echo 'have posts';
    
    while ( $can_edit_query->have_posts() ) {
            $can_edit_query->the_post();
               
               
            // the_ID();
            
            if (get_the_ID() == $post_ID){
               
               
               $allowed_edit = true;

            }
        
            };
            
        } else {
        
//            echo 'no posts';
        
        }
    
    if (is_admin())
    {
        //For Production
        //$allowed_edit = true;
    }
    
				
    return $allowed_edit;


};



function my_pre_save_post( $post_id )
{
    // check if this is to be a new post
    if( $post_id != 'new' )
    {
        return $post_id;
    }
 
    // Create a new post
    $post = array(
        'post_status'  => 'draft' ,
        'post_title'  => $_POST["fields"]['field_524e55a88415b'],
        'post_type'  => 'offer' ,
    );
 
    // insert the post
    $post_id = wp_insert_post( $post ); 

 
    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );    
    
    wp_publish_post( $post_id );
    
    // return the new ID
    return $post_id;
}
 
add_filter('acf/pre_save_post' , 'my_pre_save_post' );
                         
                        








function results_blogger($blogger){
?>

<div class="results-blogger well row-fluid">
    
        
        <div class="span3 results-blogger-left">
        <div id="blogger-profile-image">
           <?php echo wp_get_attachment_image( get_field('blogger_photo',$blogger), 'thumbnail'); ?>
       </div>
        <div id="blogger-blog-image">
           <a class="" target="_blank" href="<?php the_field('blog_url',$blogger);?>"><?php echo wp_get_attachment_image( get_field('blog_logo',$blogger), 'small'); ?></a>
       </div>
       
        <!--<a class="blogger-sidebar-link" target="_blank" href="<?php the_field('blog_url',$blogger);?>"><i class="icon-link"></i> <?php the_field('blog_name',$blogger);?></a>
        <br/>-->
        <a class="blogger-sidebar-email" target="_blank" href="mailto:<?php the_field('email',$blogger);?>"><i class="icon-envelope"></i> <?php the_field('name',$blogger);?> <?php the_field('surname',$blogger);?></a>
        <br/>
        <span class="tooltipster" title="Blogger's current location"><img class="country-flag" src="http://bloggermatchup.com/img/flags/<?php echo strtolower(get_field('current_location',$blogger));?>.png"></img> <?php $field = get_field_object('field_52480e33a95d5'); echo $field['choices'][get_field('current_location',$blogger)];?></span>
       

   </div>
   
   <div class="span7 results-blogger-center">
       <h4><?php the_field('blog_name',$blogger); ?></h4>
       <h5><?php the_field('blog_short_description',$blogger); ?></h5>
    
     <hr/>
     
     <table>
          <tr>
              <td class="tooltipster" title="The category of this blog"><i class="icon-asterisk"></i> <?php $field = get_field_object('category',$blogger); echo $field['choices'][get_field('category',$blogger)]; ?></td>
              <td class="tooltipster" title="The primary way this blogger communicates"><i class="icon-indent-right"></i> <?php $field = get_field_object('primary_medium',$blogger); echo $field['choices'][get_field('primary_medium',$blogger)]; ?></td>
              <td class="tooltipster" title="The budget range this blogger tends to write about"><i class="icon-usd"></i> <?php $field = get_field_object('field_523c56837bccc',$blogger); echo $field['choices'][get_field('budget_range',$blogger)]; ?></td>
              <td class="tooltipster" title="The blog language"><i class="icon-comment"></i> <?php the_field('language',$blogger);?> <?php echo implode(', ', get_field('other_language',$blogger)); ?></td>
          </tr>
      </table>
       
       
      <table>
        <tr>
                <td><a target="_blank" class="btn btn-small" href="<?php the_field('example_post_1',$blogger);?>"><i class="icon-pencil"></i> Sample Post 1</a></td>
                <td><a target="_blank" class="btn btn-small" href="<?php the_field('example_post_2',$blogger);?>"><i class="icon-pencil"></i> Sample Post 2</a></td>
                <td><a target="_blank" class="btn btn-small" href="<?php the_field('about_page',$blogger);?>"><i class="icon-question"></i> About Page</a></td>
            </tr>
    </table>
       
     <table>
          <tr>
              <td><i class="icon-tag"></i> <?php echo implode(', ', get_field('niches',$blogger)); ?>              <?php
                   echo '</span>';
                    
                    if (get_field('tags')){
                    echo ', ';
                      echo  str_replace(",",", ",get_field('tags',$blogger));
                    };
                    ?>
              </td>
          </tr>
          <tr>
              
          </tr>
      </table>
    

    
    <hr/>

       
      <div class="results-blogger-btn-container pull-right">
       <a class="btn btn-success" href="mailto:<?php the_field('email',$blogger);?>"><i class="icon-envelope"></i> Email</a>
       <a class="btn " href="<?php echo get_permalink($blogger);?>"><i class="icon-star-empty"></i> Favourite</a>
       <a class="btn btn-primary" href="<?php echo get_permalink($blogger);?>">Read more</a>
    </div>
      
       
    </div>
    
    <div class="span2 results-blogger-right">
           <div class="table pull-right">
               <table>
                    <tr class="tooltipster" title="<?php the_field('page_views_30_days',$blogger)?> page views in the last 30 days">
                        <td><i class="icon-signal"></i></td>
                        <td><?php the_field('page_views_30_days',$blogger)?></td>
                    </tr>
                    
                    <tr class="tooltipster" title="<?php the_field('subscribers',$blogger);?> subscribers">
                        <td><i class="icon-rss"></i></td>
                        <td><?php the_field('subscribers',$blogger)?></td>
                    </tr>
                    
                    
                        
                            <?php
                            if(get_field('facebook_page',$blogger))
                            {
                            
                                if (get_field('facebook_friends',$blogger)){
                                
                                    $facebookAdditional = ' and '.get_field('facebook_friends',$blogger).' friends';
                                
                                } else {
                                
                                    $facebookAdditional = "";
                                
                                }
                            
                            ?>
                    <tr title="<?php the_field('facebook_likes',$blogger);?> Facebook likes<?php echo $facebookAdditional;?>" class="tooltipster" href="<?php the_field('facebook_page',$blogger);?>">
                               
                                 <td>
                                    <i class="icon-facebook"></i>
                                </td>
                                
                                <td>
                                <?php the_field('facebook_likes',$blogger); ?>
                            
                            <?php
                            };
                            ?>
                        </td>
                    </tr>
                    
                            
                            
                             <?php
                    
                    if(get_field('twitter_accounts',$blogger))
                    {
                    $twitters = get_field('twitter_accounts',$blogger);
                        
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

                    <?php
                    };
                    ?>
                            
                    <tr target="_blank" title="<?php echo $totalFollowers.$accountsMessage?> Twitter followers" class="tooltipster" href="http://twitter.com/<?php echo $twitterPrimaryUrl;?>"><span class="twitter">
                        <td>
                            <i class="icon-twitter"></i>
                        </td>
                        <td>
                            <?php echo $totalFollowers;?>
                        </td>
                    </tr>
                    
                    
                    
                    
                    
                     <?php
                    if(get_field('google+',$blogger))
                    {
                    
                        if (get_field('google_plus_connections',$blogger)){
                        
                            $googleAdditional = ' and '.get_field('google_plus_connections',$blogger).' connections';
                        
                        } else {
                        
                            $googleAdditional = "";
                        
                        }
                    
                    ?>
                    
                    <?php
                    };
                    ?>
                    
                    
                    
                    <tr target="_blank" title="<?php the_field('google_plus_page_plus_ones',$blogger);?> +1s<?php echo $googleAdditional;?>" class="tooltipster" href="<?php the_field('google+',$blogger);?>">
                        <td><i class="icon-google-plus"</td>
                        <td><?php the_field('google_plus_page_plus_ones',$blogger); ?></td>
                        
                    </tr>
        
                </table>
            </div>
       </div>
</div>
       
<?php
}



function do_form( $atts ){

        extract(shortcode_atts(array(
                'ID' => 5
       ), $atts));

    
    $form_ID = $ID;

}

//add our shortcode movie

add_shortcode('do_acf_form', 'do_form');


add_action( 'init', 'register_shortcodes');





function process_image($file, $post_id, $caption){
 
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');
 
  $attachment_id = media_handle_upload($file, $post_id);
 
  update_post_meta($post_id, '_thumbnail_id', $attachment_id);

  $attachment_data = array(
  	'ID' => $attachment_id,
    'post_excerpt' => $caption
  );
  
  wp_update_post($attachment_data);

  return $attachment_id;

};

function count_blogger($new_blogger){

   


    $current_user_ID = get_current_user_id();
    
    echo 'current user: ';
    echo $current_user_ID;
    
    echo ' <br/> blog: ';
    echo $new_blogger;

    $recent_bloggers = get_user_meta($current_user_ID,'recent_bloggers',true);
    

    
    if ($recent_bloggers == ''){
    
    
        $recent_bloggers = array();
        
        echo 'empty';

    } 
    
    else {
    
    echo 'Not empty:   COUNTING BLOGGER: ';
    
    var_dump($recent_bloggers);
    
        $recent_bloggers = json_decode($recent_bloggers);
        
        if (in_array($new_blogger,$recent_bloggers)) {

            //blogger already there
        
        } else if ( count($recent_bloggers > 5) ) {
        
            unset($recent_bloggers[0]);
            
            array_push($recent_bloggers,$new_blogger);
        
        }
        
        
        
        
        
    
    }
    
    
    
    $recent_bloggers = json_encode($recent_bloggers);
    
    update_user_meta($current_user_ID,'recent_bloggers',$recent_bloggers);
    
    var_dump($recent_bloggers);
    
    
}


?>