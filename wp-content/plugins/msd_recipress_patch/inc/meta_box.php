<?php 
function msd_nutritional_input($fields){
	$fields['nutritional_info'] =
		array(
			'label'	=> __('Nutritional Information', 'recipress'),
		);
	$fields['calories'] =
		array(
			'label'	=> __('Calories', 'recipress'),
			'desc'	=> __('per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'calories',
			'type'	=> 'text'
		);
	$fields['fat'] =
		array(
			'label'	=> __('Fat', 'recipress'),
			'desc'	=> __('grams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'fat',
			'type'	=> 'text'
		);
	/*
	$fields['saturated_fat'] =
		array(
			'label'	=> __('Saturated fat', 'recipress'),
			'desc'	=> __('grams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'saturated_fat',
			'type'	=> 'text'
		);
	$fields['cholesterol'] =
		array(
			'label'	=> __('Cholesterol', 'recipress'),
			'desc'	=> __('milligrams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'cholesterol',
			'type'	=> 'text'
		);
	*/
	$fields['sodium'] =
		array(
			'label'	=> __('Sodium', 'recipress'),
			'desc'	=> __('milligrams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'sodium',
			'type'	=> 'text'
		);
	$fields['carbohydrates'] =
		array(
			'label'	=> __('Carbohydrates', 'recipress'),
			'desc'	=> __('grams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'carbohydrates',
			'type'	=> 'text'
		);
	/*
	$fields['sugar'] =
		array(
			'label'	=> __('Sugar', 'recipress'),
			'desc'	=> __('grams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'sugar',
			'type'	=> 'text'
		);
	*/
	$fields['fiber'] =
		array(
			'label'	=> __('Fiber', 'recipress'),
			'desc'	=> __('grams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'fiber',
			'type'	=> 'text'
		);
	$fields['protein'] =
		array(
			'label'	=> __('Protein', 'recipress'),
			'desc'	=> __('grams per serving', 'recipress'),
			'size'	=> 'small',
			'id'	=> 'protein',
			'type'	=> 'text'
		);
	return $fields;
}
add_filter('recipress_fields','msd_nutritional_input');

/* Add Meta Box to multiple post types.
 ------------------------------------------------------------------------- */
remove_action('admin_menu', 'recipe_add_box', 22);
add_action('admin_menu', 'msd_recipe_add_box');
function msd_recipe_add_box() {
	global $meta_fields;
	$post_types = explode(',',recipress_post_type());
	foreach($post_types AS $type){
		add_meta_box('recipress', __('Recipe', 'recipress'), 'recipe_show_box', $type, 'normal', 'high');
	}
}

function add_css(){
	wp_enqueue_style('msd-recipress-patch',plugin_dir_url(__FILE__).'msd_recipress_patch_style.css');
}

add_action('admin_print_styles', 'add_css');