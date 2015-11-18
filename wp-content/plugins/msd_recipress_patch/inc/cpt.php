<?php 

/* Add a recipe CPT
 ------------------------------------------------------------------------- */
function msd_register_cpt_recipe() {
	$labels = array(
			'name' => _x( 'Recipes', 'recipe' ),
			'singular_name' => _x( 'Recipe', 'recipe' ),
			'add_new' => _x( 'Add New', 'recipe' ),
			'add_new_item' => _x( 'Add New Recipe', 'recipe' ),
			'edit_item' => _x( 'Edit Recipe', 'recipe' ),
			'new_item' => _x( 'New Recipe', 'recipe' ),
			'view_item' => _x( 'View Recipe', 'recipe' ),
			'search_items' => _x( 'Search Recipes', 'recipe' ),
			'not_found' => _x( 'No recipes found', 'recipe' ),
			'not_found_in_trash' => _x( 'No recipes found in Trash', 'recipe' ),
			'parent_item_colon' => _x( 'Parent Recipe:', 'recipe' ),
			'menu_name' => _x( 'Recipes', 'recipe' ),
	);

	$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Add a recipe',
			'supports' => array( 'title', 'thumbnail'),
			'taxonomies' => array( 'msd_feature','ingredient','cuisine','course','skill-level' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 20,

			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => array('slug'=>'recipes','with_front'=>false),
			'capability_type' => 'post'
	);

	register_post_type( 'msd_recipe', $args );
	flush_rewrite_rules();
}

add_action( 'init', 'msd_register_cpt_recipe' );