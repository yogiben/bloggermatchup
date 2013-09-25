<?php

/*
  Plugin Name: Add Tooltipster
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Tooltipster Tooltip Plugin
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

 
 add_action('init', 'tooltipster_setup');

function tooltipster_setup(){

wp_enqueue_script( 'tooltipster', plugins_url().'/tooltipster/js/jquery.tooltipster.min.js', 'jQuery', '1.0', true);

wp_enqueue_style( 'tooltipster', plugins_url().'/tooltipster/css/tooltipster.css' );

}
 

?>