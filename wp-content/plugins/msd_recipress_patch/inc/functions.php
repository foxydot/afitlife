<?php 

// recipress_ingredients_list
function msd_recipress_ingredients_list() {
	$ingredients = recipress_recipe('ingredients');
	$output = '<ul class="ingredients">';
	foreach($ingredients as $ingredient) {
		$amount = $ingredient['amount'];
		$measurement = $ingredient['measurement'];
		$the_ingredient = $ingredient['ingredient'];
		$notes = $ingredient['notes'];

		if(!$ingredient['ingredient']) continue;

		if($notes=='subtitle'){
			$output .= '<h3>'.$the_ingredient.'</h3>';
			continue;
		}
		
		$output .= '<li class="ingredient">';
		if (isset($amount) || isset($measurement))
			$output .= '<span class="amount">'.$amount.' '.$measurement.'</span> ';
		if (isset($the_ingredient)){
			$post = get_page_by_title($the_ingredient,OBJECT,'msd_recipe');
			if(is_null($post)){
				$term = get_term_by('name', $the_ingredient, 'ingredient');
				$output .= '<span class="name">';
				if (!empty($term)) $output .= '<a href="'.get_term_link($term->slug, 'ingredient').'">';
				$output .= $the_ingredient;
				if (!empty($term)) $output .= '</a>';
				$output .= '</span> ';
				if (isset($notes))
					$output .= '<i class="notes">'.$notes.'</i></li>';
			} else {
				$output .= '<span class="name">';
				$output .= '<a href="'.get_permalink($post->ID).'">'.$the_ingredient.'</a>';
				$output .= '</span> ';
				$notes .= ' <a href="'.get_permalink($post->ID).'">recipe &raquo;</a>';
				if (isset($notes)){
					$output .= '<i class="notes">'.$notes.'</i></li>';
				}
			}
		}

	}
	$output .= '</ul>';

	return $output;
}

// recipress_instructions_list
function msd_recipress_instructions_list() {
	$instructions = recipress_recipe('instructions');
	$output = '<ol class="instructions">';
	foreach($instructions as $instruction) {
		$size = recipress_options('instruction_image_size');
		if (!isset($size)) $size = 'large';
		$image = $instruction['image'] != '' ? wp_get_attachment_image($instruction['image'], $size, false, array('class' => 'align-'.$size)) : '';
		$output .= '<li>';
		if ($size == 'thumbnail' || $size == 'medium')
			$output .= $image;
		preg_match_all("/\[(.*?)\]/i", $instruction['description'], $matches);
		foreach($matches[1] AS $k=>$v){
			$post = get_page_by_title($v,OBJECT,'msd_recipe');
			if(!is_null($post)){
				$instruction['description'] = str_replace($matches[0][$k], '<a href="'.get_permalink($post->ID).'">'.$v.'</a>', $instruction['description']);
			} else {
				$instruction['description'] = str_replace($matches[0][$k], $v, $instruction['description']);
			}
		}
		$output .= $instruction['description'];
		if ($size == 'large' || $size == 'full')
			$output .= '<br />'.$image;
		$output .= '</li>';
	}
	$output .= '</ol>';

	return $output;
}