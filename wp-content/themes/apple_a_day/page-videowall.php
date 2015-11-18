<?php
/*
Template Name: Video Wall Page
*/

global $slug;
global $content_width;
$content_width = 450;
function add_video_wrapper($atts){
	extract( shortcode_atts( array(
      'title' => '&nbsp;',
      'url' => '',
	  'class' => '',
      ), $atts ) );
	return '<div class="video '.strtolower($class).'"><h5>'.$title.'</h5>'.wp_oembed_get($url).'</div>';
}
add_shortcode('video','add_video_wrapper');
remove_filter( 'the_content', 'wpautop' );
wp_enqueue_style('videowall-css',get_stylesheet_directory_uri().'/lib/css/videowall.css');

genesis();