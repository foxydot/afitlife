<?php 
function msd_sidebar_output($recipe){
	if(has_recipress_recipe() && recipress_output()) {
		$recipe = array();
		//add photo back
		$recipe['photo'] = msd_recipress_recipe('photo', array('imgsize' => 'medium', 'class' => 'aligncenter photo medium'));
		// details
		$recipe['details_before'] = '<ul class="recipe-details">';
		if(recipress_recipe('yield'))
			$recipe['yield'] = '<li><b>'.__('Yield:', 'recipress').'</b> <span class="yield">'.recipress_recipe('yield').'</span></li>';
		if(recipress_recipe('cost'))
			$recipe['cost'] = '<li><b>'.__('Cost:', 'recipress').'</b> <span class="cost">'.recipress_recipe('cost').'</span></li>';
		if(recipress_recipe('prep_time') && recipress_recipe('cook_time'))
			$recipe['clear_items'] = '<li class="clear_items"></li>';
		if(recipress_recipe('prep_time'))
			$recipe['prep_time'] = '<li><b>'.__('Prep:', 'recipress').'</b> <span class="preptime"><span class="value-title" title="'.recipress_recipe('prep_time', 'iso').'"></span>'.recipress_recipe('prep_time','mins').'</span></li>';
		if(recipress_recipe('cook_time'))
			$recipe['cook_time'] = '<li><b>'.__('Cook:', 'recipress').'</b> <span class="cooktime"><span class="value-title" title="'.recipress_recipe('cook_time','iso').'"></span>'.recipress_recipe('cook_time','mins').'</span></li>';
		if(recipress_recipe('prep_time') && recipress_recipe('cook_time'))
			$recipe['ready_time'] ='<li><b>'.__('Ready In:', 'recipress').'</b> <span class="duration"><span class="value-title" title="'.recipress_recipe('ready_time','iso').'"></span>'.recipress_recipe('ready_time','mins').'</span></li>';
		$recipe['details_after'] = '</ul>';
		// nutritional information
		$recipe['nutritional_before'] = '<h4 class="recipie-nutritional">Nutritional Information (per serving)</h4><ul class="recipe-taxes">';
		$recipe['calories'] = recipress_recipe('calories')?'<li><b>'.__('Calories', 'recipress').':</b> '.recipress_recipe('calories').'</li>':'';
		$recipe['fat'] = recipress_recipe('fat')?'<li><b>'.__('Fat', 'recipress').':</b> '.recipress_recipe('fat').' grams</li>':'';
		//$recipe['saturated_fat'] = recipress_recipe('saturated_fat')?'<li><b>'.__('Saturated Fat', 'recipress').':</b> '.recipress_recipe('saturated_fat').' grams</li>':'';
		//$recipe['cholesterol'] = recipress_recipe('cholesterol')?'<li><b>'.__('Cholesterol', 'recipress').':</b> '.recipress_recipe('cholesterol').' milligrams</li>':'';
		$recipe['sodium'] = recipress_recipe('sodium')?'<li><b>'.__('Sodium', 'recipress').':</b> '.recipress_recipe('sodium').' milligrams</li>':'';
		$recipe['carbohydrates'] = recipress_recipe('carbohydrates')?'<li><b>'.__('Carbohydrates', 'recipress').':</b> '.recipress_recipe('carbohydrates').' grams</li>':'';
		//$recipe['sugar'] = recipress_recipe('sugar')?'<li><b>'.__('Sugar', 'recipress').':</b> '.recipress_recipe('sugar').' grams</li>':'';
		$recipe['fiber'] = recipress_recipe('fiber')?'<li><b>'.__('Fiber', 'recipress').':</b> '.recipress_recipe('fiber').' grams</li>':'';
		$recipe['protein'] = recipress_recipe('protein')?'<li><b>'.__('Protein', 'recipress').':</b> '.recipress_recipe('protein').' grams</li>':'';
		$recipe['nutritional_after'] = '</ul>';
		print implode( '', $recipe );
	}
}
add_action('genesis_sidebar','msd_sidebar_output',9);

function msd_remove_some_things($recipe){
	//ts_data($recipe);
	unset($recipe['title']);
	unset($recipe['photo']);
	unset($recipe['details_before']);
	unset($recipe['yield']);
	unset($recipe['cost']);
	unset($recipe['prep_time']);
	unset($recipe['cook_time']);
	unset($recipe['ready_time']);
	unset($recipe['details_after']);
	unset($recipe['taxonomies_before']);
	unset($recipe['cuisine']);
	unset($recipe['course']);
	unset($recipe['skill_level']);
	unset($recipe['taxonomies_after']);
	unset($recipe['credit']);
	return $recipe;
}
add_filter('the_recipe','msd_remove_some_things');



// function for outputting recipe items
// ----------------------------------------------------
function msd_recipress_recipe($field, $attr = null) {
	global $post;
	$meta = get_post_custom($post->ID);
	
	switch($field) {
		// photo
		case 'photo':
			$thumbsize = $attr['imgsize']?$attr['imgsize']:'thumbnail';
			if(current_theme_supports('post-thumbnails') && recipress_options('use_photo') != 'no')
				$photo = get_the_post_thumbnail($post->ID, $thumbsize, $attr);
			else {
				$photo_id = $meta['photo'][0];
				$photo = wp_get_attachment_image($photo_id, $thumbsize, false, $attr);
			}
			return $photo;
			break;
		// calories
		case 'calories':
			$calories = $meta['calories'][0];
			return $calories;
		break;
		
		default:
			return $meta[$field][0];
	} // end switch
	
}

function msd_strip_ingredient_links($recipe){
	$link_pattern = "/<a[^>]*>(.*)<\/a>/iU";
	
	$ingredients = $recipe['ingredients'];
	$ingredients = preg_replace($link_pattern, "$1", $ingredients);
	$recipe['ingredients'] = $ingredients;
	return $recipe;
}
add_filter('the_recipe','msd_strip_ingredient_links');

function msd_cross_reference_recipes($recipe){
	//$recipe['ingredients'] = msd_recipress_ingredients_list();
	$recipe['instructions'] = msd_recipress_instructions_list();
	return $recipe;
}
add_filter('the_recipe','msd_cross_reference_recipes');