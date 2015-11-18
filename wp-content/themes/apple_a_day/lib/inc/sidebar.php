<?php
if(!class_exists('WPAlchemy_MetaBox')){
	include_once get_stylesheet_directory() . '/lib/wpalchemy/MetaBox.php';
}
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');
function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/lib/css/meta.css');
}

//define the metabox
global $sidebar;
$sidebar = new WPAlchemy_MetaBox(array
(
	'id' => '_sidebar',
	'title' => 'Sidebar Content',
	'types' => array('post','page'), // added only for posts & pages
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_stylesheet_directory() . '/lib/wpalchemy/metaboxes/sidebar-meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_sb_'
));
