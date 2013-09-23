<?php
	/*
		dpMaintenance - Default Theme
	*/
	@session_start();
	global $dpMaintenance;
	$plugin_dir = plugin_dir_url(__FILE__);
	if(strpos($_SERVER['HTTP_HOST'], 'www') === false) { $plugin_dir = str_replace("www.", "", $plugin_dir); }
	
	// Expiration date vars	
	$expiration_date = explode("/", $dpMaintenance['expiration_date']);		
	$expiration_month = $expiration_date[0];
	$expiration_day = $expiration_date[1];
	$expiration_year = $expiration_date[2];
	
	/* Set MailChimp API Key in Session */
	if($dpMaintenance['mailchimp_api'] != "" && $dpMaintenance['mailchimp_active']) {
		$_SESSION['mailchimp_api'] = $dpMaintenance['mailchimp_api'];
		$_SESSION['mailchimp_list'] = $dpMaintenance['mailchimp_list'];
		$_SESSION['mailchimp_active'] = $dpMaintenance['mailchimp_active'];
	} else {
		$_SESSION['mailchimp_active'] = false;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php bloginfo( 'name' )?></title>	
	
	<!-- ########## CSS Files ########## -->
    	
	<!-- Framework CSS -->
	<link rel="stylesheet" href="<?php echo $plugin_dir?>css/960.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo $plugin_dir?>css/reset.css" type="text/css" media="screen" />

	<!-- Screen CSS -->
	<link type="text/css" href="<?php echo $plugin_dir?>themes/redmond/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo $plugin_dir?>css/prettyPhoto.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $plugin_dir?>css/style.css" type="text/css" media="screen" />
    
	<!-- For progressively larger displays -->
    <link rel="stylesheet" media="only screen and (max-width: 768px)" href="<?php echo $plugin_dir?>css/style-768.css" />
    <link rel="stylesheet" media="only screen and (max-width: 480px)" href="<?php echo $plugin_dir?>css/style-480.css" />
    <link rel="stylesheet" media="only screen and (max-width: 320px)" href="<?php echo $plugin_dir?>css/style-320.css" />

	<!-- ########## end css ########## -->	
 	
 	<!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
	<![endif]-->
	
	<!-- Jquery -->
	<script type="text/javascript" src="<?php echo $plugin_dir?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $plugin_dir?>ui/jquery-ui-1.8.17.custom.js"></script>
	<script type="text/javascript" src="<?php echo $plugin_dir?>js/jquery.counterClock.js"></script>
    <script type="text/javascript" src="<?php echo $plugin_dir?>js/jquery.bxSlider.min.js"></script>
    <script type="text/javascript" src="<?php echo $plugin_dir?>js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?php echo $plugin_dir?>js/modernizr.full.min.js"></script>
    
	<!-- To customise any of the above, please use this file -->
	<script type="text/javascript" src="<?php echo $plugin_dir?>js/custom.js"></script>
	
    <script type="text/javascript">
	$(document).ready(function() { 
		<?php if($dpMaintenance['show_timer']) {?>
		$('#counter').counterClock({
			launchDate: { year: <?php echo $expiration_year?>, month: <?php echo $expiration_month?>, day: <?php echo $expiration_day?>, hour: <?php echo $dpMaintenance['expiration_date_hh']?>, minute: <?php echo $dpMaintenance['expiration_date_mm']?>}	
		});
		<?php }?>
		
		<?php if($dpMaintenance['show_loading_bar']) {?>
		$( "#progressbar" ).progressbar({
			value: <?php echo $dpMaintenance['percentage']?>
		});
		<?php }?>
		
		<?php if($dpMaintenance['show_twitter_widget']) {?>
		/* Twitter API */
		try{
		var msgs = '';
		$.getJSON('<?php echo dpMaintenance_plugin_url()?>/lib/user_timeline.php?screen_name=<?php echo $dpMaintenance['twitter_id']?>&count=<?php echo $dpMaintenance['twitter_count']?>&include_rts=true&include_entities=true&t=<?php echo time()?>', function(data){
			$.each(data, function(index, item){
					msgs += '<div>' + item.text.linkify() + ' ' + '<br /><span class="date">' + relative_time(item.created_at) + '</span>' + '</div>';
			});
			$('#twittMsg').append(msgs);
			$('#twittMsg').bxSlider({
				auto: true,
				mode: 'fade', //Type of transition between each slide ('horizontal', 'vertical', 'fade')
				controls: false, //Display previous and next controls
				speed: 600, //In ms, duration of time slide transitions will occupy
				pause: 5000, //In ms, the duration between each slide transition
				autoHover: true //If true show will pause on mouse over
			});
			$("#twittBox").removeClass("loading");
		});
		} catch(err){}
		<?php }?>
		
		<?php if($dpMaintenance['show_newsletter']) {?>
		// Newsletter Form
		var $newsletter_not = $('<div />').addClass('notification').click(function(){ $(this).fadeOut('fast'); });
		$('#btn_newsletter').click(function(){
			if($('#newsletter_email').val() == '') { $('.newsletterContent').prepend($newsletter_not.html('<?php echo addslashes($dpMaintenance['valid_required_fields'])?>').fadeIn('fast')); return; }
			$(this).hide();
			$(this).after($('<img />').attr({src: '<?php echo $plugin_dir?>images/ajax-loader.gif', id:'btn_newsletter_loading'}));
			
			$.post("<?php echo $plugin_dir?>php/post_newsletter.php", { newsletter_email: $('#newsletter_email').val(), to_email : '<?php echo $dpMaintenance['newsletter_email_address']?>' }, function(data) {
				$('#btn_newsletter_loading').remove();
				$('#btn_newsletter').show();
				
				if(data == 'ok') {
					//Success
					$('.newsletterContent').prepend($newsletter_not.html('<?php echo addslashes($dpMaintenance['valid_newsletter_success'])?>').fadeIn('fast'));
				} else {
					//Error
					$('.newsletterContent').prepend($newsletter_not.html('<?php echo addslashes($dpMaintenance['valid_error'])?>').fadeIn('fast'));
				}
			});
		});
		<?php }?>
		
		<?php if($dpMaintenance['show_contact_form']) {?>
		// Contact Form
		var $contact_not = $('<div />').addClass('notification').click(function(){ $(this).fadeOut('fast'); });
		$('#btn_contact').click(function(){
			if($('#name').val() == '' || $('#email').val() == '' || $('#message').val() == '') { $('.contactContent').prepend($contact_not.html('<?php echo addslashes($dpMaintenance['valid_required_fields'])?>').fadeIn('fast')); return; }
			$(this).hide();
			$(this).after($('<img />').attr({src: '<?php echo $plugin_dir?>images/ajax-loader.gif', id:'btn_contact_loading'}));
			
			$.post("<?php echo $plugin_dir?>php/post_contact.php", { email: $('#email').val(), name: $('#name').val(), message: $('#message').val(), to_email : '<?php echo $dpMaintenance['contact_form_email_address']?>' }, function(data) {
				$('#btn_contact_loading').remove();
				$('#btn_contact').show();
				
				if(data == 'ok') {
					//Success
					$('.contactContent').prepend($contact_not.html('<?php echo addslashes($dpMaintenance['valid_contact_success'])?>').fadeIn('fast'));
				} else {
					//Error
					$('.contactContent').prepend($contact_not.html('<?php echo addslashes($dpMaintenance['valid_error'])?>').fadeIn('fast'));
				}
			});
		});
		<?php }?>
		
	}); 
	</script>
	
</head>

<body id="top">
		
    <!-- Start Head -->
    <div id="top_page">
        <?php if($dpMaintenance['logo'] != "") {?>
	    <img id="logo" src="<?php echo $dpMaintenance['logo']?>" />
        <?php }?>
    </div>
    <!-- Head END -->
        
	<!-- Start Container 12 -->
	<div id="main_content" class="container_12">
		
        <div class="<?php echo $dpMaintenance['show_timer'] ? "grid_6" : "grid_12"?>">
        	<h1><?php echo $dpMaintenance['maintenance_message']?></h1>
        </div>
        
        <?php if($dpMaintenance['show_timer']) {?>
        <!-- Timer Widget -->
        <div class="grid_6">
        	<div class="container_clock">
                <h2><?php echo $dpMaintenance['timer_widget_title']?></h2>
                
                <div class="clear"></div><!-- CLEAR -->	
                
                <ul id="counter">
                    <li class="days">
                    	<span></span>
                        <h3><?php echo $dpMaintenance['timer_widget_days'] != "" ? $dpMaintenance['timer_widget_days'] : "Days" ?></h3>
                    </li>
                    <li class="hours">
                    	<span></span>
                        <h3><?php echo $dpMaintenance['timer_widget_hours'] != "" ? $dpMaintenance['timer_widget_hours'] : "Hours"?></h3>
                    </li>
                    <li class="minutes">
                    	<span></span>
                        <h3><?php echo $dpMaintenance['timer_widget_minutes'] != "" ? $dpMaintenance['timer_widget_minutes'] : "Minutes"?></h3>
                    </li>
                    <li class="seconds">
                    	<span></span>
                        <h3><?php echo $dpMaintenance['timer_widget_seconds'] != "" ? $dpMaintenance['timer_widget_seconds'] : "Seconds"?></h3>
                    </li>
                </ul>
                <div class="clear"></div><!-- CLEAR -->	
            </div>
        </div>
        <!-- Timer Widget END -->
		<?php }?>
        
        <div class="clear"></div><!-- CLEAR -->		
	
	</div><!-- Container 12 END-->
	
    <?php if($dpMaintenance['show_loading_bar']) {?>
    <!-- Start Progress Bar -->
    <div id="loading_bar">
        <span class="up"></span>
        <div class="container_12">
        	<div class="grid_12">
        		<h2><?php echo $dpMaintenance['percentage']?>% <?php echo $dpMaintenance['completed_translation'] != "" ? $dpMaintenance['completed_translation'] : "Completed"?></h2>
                <div id="progressbar"></div>
            </div>
        </div>
    </div>
    <!-- Progress Bar END --> 
    <?php }?>
    
    <!-- Start Widgets -->
    <div id="widgets">
        <span class="up"></span>
        <div class="container_12">
        	<div class="grid_4">
            	<?php if($dpMaintenance['show_twitter_widget']) {?>
            	<!-- Twitter Widget -->
        		<h2><?php echo $dpMaintenance['twitter_widget_title']?></h2>
                
                <div class="twitterContent">
                    <div id="twittBox" class="loading">
                        <div id="twittMsg"></div>
                    </div>
                </div>
                <!-- Twitter Widget END -->
                <?php }?>
                
                <?php if($dpMaintenance['show_social']) {?>
                <!-- Social Widget -->
                <h2><?php echo $dpMaintenance['social_widget_title']?></h2>
                <div class="socialContent">
                	<?php if($dpMaintenance['twitter_url'] != "") {?><a href="<?php echo $dpMaintenance['twitter_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/twitter.png" alt="Twitter" /></a><?php }?>
                    <?php if($dpMaintenance['facebook_url'] != "") {?><a href="<?php echo $dpMaintenance['facebook_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/facebook.png" alt="Facebook" /></a><?php }?>
                    <?php if($dpMaintenance['google_url'] != "") {?><a href="<?php echo $dpMaintenance['google_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/googleplus.png" alt="Google +" /></a><?php }?>
                    <?php if($dpMaintenance['linkedin_url'] != "") {?><a href="<?php echo $dpMaintenance['linkedin_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/linkedin.png" alt="Linkedin" /></a><?php }?>
                    <?php if($dpMaintenance['skype_url'] != "") {?><a href="skype:<?php echo $dpMaintenance['skype_url']?>?call"><img src="<?php echo $plugin_dir?>images/icons/skype.png" alt="Skype" /></a><?php }?>
                    <?php if($dpMaintenance['youtube_url'] != "") {?><a href="<?php echo $dpMaintenance['youtube_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/youtube.png" alt="Youtube" /></a><?php }?>
                    <?php if($dpMaintenance['vimeo_url'] != "") {?><a href="<?php echo $dpMaintenance['vimeo_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/vimeo.png" alt="Vimeo" /></a><?php }?>
                    <?php if($dpMaintenance['forrst_url'] != "") {?><a href="<?php echo $dpMaintenance['forrst_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/forrst.png" alt="Forrst" /></a><?php }?>
                    <?php if($dpMaintenance['tumblr_url'] != "") {?><a href="<?php echo $dpMaintenance['tumblr_url']?>" target="_blank"><img src="<?php echo $plugin_dir?>images/icons/tumblr.png" alt="Tumblr" /></a><?php }?>
                    <?php if($dpMaintenance['email_url'] != "") {?><a href="mailto:<?php echo $dpMaintenance['email_url']?>"><img src="<?php echo $plugin_dir?>images/icons/email.png" alt="Email" /></a><?php }?>
                </div>
                <!-- Social Widget END -->
                <?php }?>
            </div>
            <div class="grid_4">
            	
                <?php if($dpMaintenance['show_newsletter']) {?>
                <!-- Newsletter Widget -->
                <h2><?php echo $dpMaintenance['newsletter_widget_title']?></h2>
                
                <div class="newsletterContent">
                	<form onsubmit="$('#btn_newsletter').trigger('click'); return false;">
                        <input type="text" value="mail@mail.com" name="newsletter_email" id="newsletter_email" onfocus="if(this.value == 'mail@mail.com') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'mail@mail.com'; }" class="text newsletter_email" />
                        
                        <input type="button" class="button" id="btn_newsletter" value="<?php echo $dpMaintenance['button_subscribe']?>" />
                    </form>
                </div>
                <!-- Newsletter Widget END -->
                <?php }?>
            </div>
            <div class="grid_4">
            	<?php if($dpMaintenance['show_contact_form']) {?>
            	<!-- Contact Widget -->
        		<h2><?php echo $dpMaintenance['contact_form_title']?></h2>
                
                <div class="contactContent">
                	<?php 
					if($dpMaintenance['your_name'] == "") {
						$dpMaintenance['your_name'] = "Your Name";
					}
					?>
                	<form onsubmit="$('#btn_contact').trigger('click'); return false;">
                    	<input type="text" value="<?php echo $dpMaintenance['your_name']?>" name="name" id="name" onfocus="if(this.value == '<?php echo $dpMaintenance['your_name']?>') { this.value = ''; }" onblur="if(this.value == '') { this.value = '<?php echo $dpMaintenance['your_name']?>'; }" class="text" />
                        
                        <input type="text" value="mail@mail.com" name="email" id="email" onfocus="if(this.value == 'mail@mail.com') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'mail@mail.com'; }" class="text" />
                        
                        <textarea name="message" id="message" class="text"></textarea>
                        
                        <input type="button" class="button" id="btn_contact" value="<?php echo $dpMaintenance['send_button']?>" />
                    </form>
                </div>
                <!-- Contact Widget END -->
                <?php }?>
                
            </div>
        </div>
        <div class="clear"></div><!-- CLEAR -->	
    </div>
    <!-- Widgets END --> 
    
	<!-- Start Footer Bottom -->
    <div id="bottom_page">
        
        <div class="container_12">
        	<div class="grid_12">
        		<p><?php echo $dpMaintenance['text_footer']?></p>
            </div>
        </div>

    </div>
    <!-- Footer Bottom END --> 

</body>
</html>