<?php
/*
Plugin Name: DP Maintenance Mode Lite
Description: The DP Maintenance Lite plugin includes the possibility to add a maintenance mode with a sleek theme to your website.
Version: 1.3.2
Author: Diego Pereyra
Author URI: http://www.dpereyra.com/
Wordpress version supported: 2.8 and above
*/

//on activation
//defined global variables and constants here
global $dpMaintenance;
$dpMaintenance = get_option('dpMaintenance_options');

define("DPMAINTENANCE_VER","1.3.2",false);//Current Version of this plugin
if ( ! defined( 'DPMAINTENANCE_PLUGIN_BASENAME' ) )
	define( 'DPMAINTENANCE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
if ( ! defined( 'MAINTENANCE_CSS_DIR' ) ){
	define( 'MAINTENANCE_CSS_DIR', WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).'/css/' );
}
// Create Text Domain For Translations
load_plugin_textdomain('dpMaintenance', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

add_action('init','dpMaintenance_initial_run');
function dpMaintenance_initial_run(){
	global $dpMaintenance;
	if($dpMaintenance['active']){	dpMaintenance_activate();	}

}

function install_dpMaintenance() {

   $default_settings = array();
   $default_settings = array(
						   'active'						=>false,
						   'theme'						=> 'default',
						   'logo'						=> '',
						   'percentage' 				=> '0',
						   'expiration_date' 			=> '',
						   'expiration_date_hh'			=> '',
						   'expiration_date_mm'			=> '',
						   'maintenance_message'		=> 'Our site is currently on maintenance. Please, be patient.',
						   'auto_deactive'				=> 0,
						   'twitter_url'				=> '',
						   'facebook_url'				=> '',
						   'google_url'					=> '',
						   'linkedin_url'				=> '',
						   'skype_url'					=> '',
						   'youtube_url'				=> '',
						   'vimeo_url'					=> '',
						   'forrst_url'					=> '',
						   'tumblr_url'					=> '',
						   'email_url'					=> '',
						   'show_company_info'			=> true,
						   'intro_title'				=> '',
						   'intro'						=> '',
						   'timer_widget_title'			=> 'We will be back in',
						   'timer_widget_days'			=> 'Days',
						   'timer_widget_hours'			=> 'Hours',
						   'timer_widget_minutes'		=> 'Minutes',
						   'timer_widget_seconds'		=> 'Seconds',
						   'completed_translation'		=> 'Completed',
						   'show_newsletter'			=> true,
						   'newsletter_email_address'	=> '',
						   'button_subscribe'			=> 'Subscribe',
						   'show_timer'					=> true,
						   'show_contact_form'			=> true,
						   'contact_form_email_address'	=> '',
						   'send_button'				=> 'Send',
						   'show_social'				=> true,
						   'social_widget_title'		=> 'Get Social',
						   'newsletter_widget_title'	=> 'Newsletter',
						   'contact_form_title'			=> 'Drop us a Line!',
						   'show_twitter_widget'		=> true,
						   'twitter_widget_title'		=> 'Twitter',
						   'twitter_id'					=> '',
						   'twitter_count'				=> 5,
						   'show_loading_bar'			=> true,
						   'text_footer'				=> 'Copyright 2012 - My website',
						   'valid_newsletter_success'	=> 'Your email has been saved successfully.',
						   'valid_contact_success'		=> 'Your message has been sent succesfully.',
						   'valid_error'				=> 'Error: Please try again later.',
						   'valid_required_fields'		=> 'Error: All the fields are required.',
						   'user_roles'					=> array(),
						   'mailchimp_active'			=> false,
						   'mailchimp_api'				=> '',
						   'mailchimp_list'				=> '',
						   'your_name'					=> 'Your Name'
			              );
   
	$dpMaintenance = get_option('dpMaintenance_options');
	
	if(!$dpMaintenance) {
	 $dpMaintenance = array();
	}
	
	foreach($default_settings as $key=>$value) {
	  if(!isset($dpMaintenance[$key])) {
		 $dpMaintenance[$key] = $value;
	  }
	}
	
	delete_option('dpMaintenance_options');	  
	update_option('dpMaintenance_options',$dpMaintenance);
}
register_activation_hook( __FILE__, 'install_dpMaintenance' );

function uninstall_dpMaintenance() {
	global $wpdb;
	delete_option('dpMaintenance_options'); 
	
}
register_uninstall_hook( __FILE__, 'uninstall_dpMaintenance' );

require_once (dirname (__FILE__) . '/functions.php');
require_once (dirname (__FILE__) . '/includes/core.php');
require_once (dirname (__FILE__) . '/mailchimp/miniMCAPI.class.php');
require_once (dirname (__FILE__) . '/settings/settings.php');
?>