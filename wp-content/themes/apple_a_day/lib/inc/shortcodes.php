<?php
add_shortcode('button','apple_button_function');
function apple_button_function($atts, $content = null){	
	extract( shortcode_atts( array(
      'url' => null,
	  'target' => '_self'
      ), $atts ) );
	$ret = '<div class="button-wrapper">
<a class="button" href="'.$url.'" target="'.$target.'">'.remove_wpautop($content).'</a>
</div>';
	return $ret;
}

add_shortcode('postit','apple_postit_function');
function apple_postit_function($atts, $content = null){
	extract( shortcode_atts( array(
	'type' => ''
			), $atts ) );
			$notice = strtolower($type)=='remember'?'<h3>REMEMBER</h3>':'';
			$ret = '<div class="postit '.strtolower($type).'">'.$notice.remove_wpautop($content).'</div>';
			return $ret;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 

if(is_plugin_active('recipress/recipress.php')){
	add_shortcode('recipes', 'recipe_list_function');
}

function recipe_list_function( $atts ){
	global $random_feature;
	extract( shortcode_atts( array(
	  'title' => false,
      'ingredient' => false,
	  'cuisine' => false,
	  'course' => false,
	  'skill_level' => false
      ), $atts ) );
      
      $args = array(
		'meta_key' => 'hasRecipe',
		'meta_value' => 'Yes',
      );
      if($ingredient){
      	$args['ingredient'] = $ingredient;
      }
      if($cuisine){
      	$args['cuisine'] = $cuisine;
      }
      if($course){
      	$args['course'] = $course;
      }
      if($skill_level){
      	$args['skill_level'] = $skill_level;
      }
      
      if(!$title){
      	$cat = $random_feature->get_category_info($atts);
      	$title = ucwords($cat['value']);
      }
      
      $recipes = new WP_query($args);
	if($recipes->have_posts()) :
		$output = '<h3 class="recipress-list">'.$title.'</h3><ul class="recipress-list">';
		while($recipes->have_posts()) : $recipes->the_post();
			$output .= '<li class="clear_items">';
			$output .= '<a href="'.get_permalink().'">';
			$output .= recipress_recipe('photo', 'class=recipress-thumb alignright');
			$output .= '<strong>'.recipress_recipe('title').'</strong></a></li>';
		endwhile;
		$output .= '</ul>';
	else :
		$output = '<p>'.__('No recipes found.', 'recipress').'</p>';
	endif;
	
	wp_reset_postdata();
	return $output;
      
}

add_shortcode('list', 'category_list_function');

function category_list_function( $atts ){
	global $random_feature;
	extract( shortcode_atts( array(
	'title' => false,
	'category' => false,
	), $atts ) );

	if($category){
		$args['category_name'] = $category;
	}
	if(!$title){
		$cat = $random_feature->get_category_info($atts);
		$title = ucwords($cat['value']);
	}

	$myposts = new WP_query($args);
	if($myposts->have_posts()) :
	$output = '<h3 class="recipress-list">'.$title.'</h3><ul class="recipress-list">';
	while($myposts->have_posts()) : $myposts->the_post();
	$output .= '<li class="clear_items">';
	$output .= '<a href="'.get_permalink().'">';
	$output .= recipress_recipe('photo', 'class=recipress-thumb alignright');
	$output .= '<strong>'.get_the_title().'</strong></a></li>';
	endwhile;
	$output .= '</ul>';
	else :
	$output = '<p>'.__('No recipes found.', 'recipress').'</p>';
	endif;

	wp_reset_postdata();
	return $output;

}