<?php

/*
  Plugin Name: Adds Shortcodes
  Plugin URI: http://www.benjaminpeterjones.com
  Description: Custom Shortcodes
  Version: 1.0.0
  Author: Ben Jones
  Author URI: Http://www.benjaminpeterjones.com
 */

function foobar_func(){

$options = array(

'post_id' => $post->ID,
'field_groups'=>array()

);

acf_form($options);

}

add_shortcode( 'foobar', 'foobar_func' );

?>