<?php
/*
Plugin Name: MSD ReciPress Patch
Description: Add nutritional information to recipies.
Version: 0.1
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('recipress/recipress.php')){

	//include_once('inc/cpt.php');
	include_once('inc/functions.php');	
	include_once('inc/meta_box.php');
	include_once('inc/output.php');
	//include_once('inc/taxonomies.php');
	
	//remove suggestions for MRO
	//remove_action('admin_head', 'add_recipress_script_config',22);
}//end if class exists statement