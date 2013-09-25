<?php

/*
  Plugin Name: Add Tooltipster
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Tooltipster Tooltip Plugin
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

 
 add_action('init', 'jQuery_setup');

function jQuery_setup(){

wp_enqueue_script( 'tooltipster', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', 'jQuery', '1.0', true);

}
 
?>