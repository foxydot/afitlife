<?php

/* Add recipe feature taxonomy
 *
*/
function msd_register_taxonomy_feature() {

	$labels = array(
			'name' => _x( 'Recipe Features', 'feature' ),
			'singular_name' => _x( 'Recipe Feature', 'feature' ),
			'search_items' => _x( 'Search Recipe Features', 'feature' ),
			'popular_items' => _x( 'Popular Recipe Features', 'feature' ),
			'all_items' => _x( 'All Recipe Features', 'feature' ),
			'parent_item' => _x( 'Parent Recipe Feature', 'feature' ),
			'parent_item_colon' => _x( 'Parent Recipe Feature:', 'feature' ),
			'edit_item' => _x( 'Edit Recipe Feature', 'feature' ),
			'update_item' => _x( 'Update Recipe Feature', 'feature' ),
			'add_new_item' => _x( 'Add New Recipe Feature', 'feature' ),
			'new_item_name' => _x( 'New Recipe Feature Name', 'feature' ),
			'separate_items_with_commas' => _x( 'Separate features with commas', 'feature' ),
			'add_or_remove_items' => _x( 'Add or remove features', 'feature' ),
			'choose_from_most_used' => _x( 'Choose from the most used features', 'feature' ),
			'menu_name' => _x( 'Recipe Features', 'feature' ),
	);

	$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,

			'rewrite' 	=> array( 'slug' => 'feature','with_front' => FALSE, 'hierarchical' => FALSE ),
			'query_var' => true
	);

	register_taxonomy( 'msd_feature', array('msd_recipe'), $args );
}

add_action( 'init', 'msd_register_taxonomy_feature' );



add_action('init', 'msd_register_recipress_taxonomies',30);

/* Register Taxonomies
 ------------------------------------------------------------------------- */
function msd_register_recipress_taxonomies() {
	// get the array of post types
	$post_types = explode(',',recipress_post_type());
	// ingredients
	$labels = array(
			'name' 				=> _x( 'Ingredients', 'taxonomy general name', 'recipress' ),
			'singular_name' 	=> _x( 'Ingredient', 'taxonomy singular name', 'recipress' ),
			'search_items'		=> __( 'Search Ingredients', 'recipress' ),
			'popular_items' 	=> __( 'Popular Ingredients', 'recipress' ),
			'all_items'			=> __( 'All Ingredients', 'recipress' ),
			'parent_item' 		=> __( 'Parent Ingredient', 'recipress' ),
			'parent_item_colon' => __( 'Parent Ingredient:', 'recipress' ),
			'edit_item' 		=> __( 'Edit Ingredient', 'recipress' ),
			'update_item' 		=> __( 'Update Ingredient', 'recipress' ),
			'add_new_item' 		=> __( 'Add New Ingredient', 'recipress' ),
			'new_item_name' 	=> __( 'New Ingredient Name', 'recipress' ),
			'add_or_remove_items' => __( 'Add or remove ingredients', 'recipress' ),
			'menu_name' 		=> _x( 'Ingredients', 'taxonomy menu name', 'recipress' ),
	);

	$args = array(
			'labels' 			=> $labels,
			'public'			=> true,
			'show_in_nav_menus' => true,
			'show_ui' 			=> false,
			'show_tagcloud' 	=> false,
			'hierarchical'	 	=> false,

			'rewrite' 			=> true,
			'query_var' 		=> true
	);
	register_taxonomy( 'ingredient', $post_types, $args );

	// cuisines
	$labels = array(
			'name' 				=> _x( 'Cuisines', 'taxonomy general name', 'recipress' ),
			'singular_name' 	=> _x( 'Cuisine', 'taxonomy singular name', 'recipress' ),
			'search_items'		=> __( 'Search Cuisines', 'recipress' ),
			'popular_items' 	=> __( 'Popular Cuisines', 'recipress' ),
			'all_items'			=> __( 'All Cuisines', 'recipress' ),
			'parent_item' 		=> __( 'Parent Cuisine', 'recipress' ),
			'parent_item_colon' => __( 'Parent Cuisine:', 'recipress' ),
			'edit_item' 		=> __( 'Edit Cuisine', 'recipress' ),
			'update_item' 		=> __( 'Update Cuisine', 'recipress' ),
			'add_new_item' 		=> __( 'Add New Cuisine', 'recipress' ),
			'new_item_name' 	=> __( 'New Cuisine Name', 'recipress' ),
			'add_or_remove_items' => __( 'Add or remove cuisines', 'recipress' ),
			'menu_name' 		=> _x( 'Cuisines', 'taxonomy menu name', 'recipress' ),
	);

	$args = array(
			'labels' 			=> $labels,
			'public'			=> true,
			'show_in_nav_menus' => true,
			'show_ui' 			=> false,
			'show_tagcloud' 	=> false,
			'hierarchical'	 	=> false,

			'rewrite' 			=> true,
			'query_var' 		=> true
	);

	register_taxonomy( 'cuisine', $post_types, $args );

	// courses
	$labels = array(
			'name' 				=> _x( 'Courses', 'taxonomy general name', 'recipress' ),
			'singular_name' 	=> _x( 'Course', 'taxonomy singular name', 'recipress' ),
			'search_items'		=> __( 'Search Courses', 'recipress' ),
			'popular_items' 	=> __( 'Popular Courses', 'recipress' ),
			'all_items'			=> __( 'All Courses', 'recipress' ),
			'parent_item' 		=> __( 'Parent Course', 'recipress' ),
			'parent_item_colon' => __( 'Parent Course:', 'recipress' ),
			'edit_item' 		=> __( 'Edit Course', 'recipress' ),
			'update_item' 		=> __( 'Update Course', 'recipress' ),
			'add_new_item' 		=> __( 'Add New Course', 'recipress' ),
			'new_item_name' 	=> __( 'New Course Name', 'recipress' ),
			'add_or_remove_items' => __( 'Add or remove courses', 'recipress' ),
			'menu_name' 		=> _x( 'Courses', 'taxonomy menu name', 'recipress' ),
	);

	$args = array(
			'labels' 			=> $labels,
			'public'			=> true,
			'show_in_nav_menus' => true,
			'show_ui' 			=> false,
			'show_tagcloud' 	=> false,
			'hierarchical'	 	=> false,

			'rewrite' 			=> true,
			'query_var' 		=> true
	);

	register_taxonomy( 'course', $post_types, $args );

	// skill_levels
	$labels = array(
			'name' 				=> _x( 'Skill Levels', 'taxonomy general name', 'recipress' ),
			'singular_name' 	=> _x( 'Skill Level', 'taxonomy singular name', 'recipress' ),
			'search_items'		=> __( 'Search Skill Levels', 'recipress' ),
			'popular_items' 	=> __( 'Popular Skill Levels', 'recipress' ),
			'all_items'			=> __( 'All Skill Levels', 'recipress' ),
			'parent_item' 		=> __( 'Parent Skill Level', 'recipress' ),
			'parent_item_colon' => __( 'Parent Skill Level:', 'recipress' ),
			'edit_item' 		=> __( 'Edit Skill Level', 'recipress' ),
			'update_item' 		=> __( 'Update Skill Level', 'recipress' ),
			'add_new_item' 		=> __( 'Add New Skill Level', 'recipress' ),
			'new_item_name' 	=> __( 'New Skill Level Name', 'recipress' ),
			'add_or_remove_items' => __( 'Add or remove skill levels', 'recipress' ),
			'menu_name' 		=> _x( 'Skill Levels', 'taxonomy menu name', 'recipress' ),
	);

	$args = array(
			'labels' 			=> $labels,
			'public'			=> true,
			'show_in_nav_menus' => true,
			'show_ui' 			=> false,
			'show_tagcloud' 	=> false,
			'hierarchical'	 	=> false,

			'rewrite' 			=> true,
			'query_var' 		=> true
	);

	register_taxonomy( 'skill_level', $post_types, $args );

	flush_rewrite_rules();
}