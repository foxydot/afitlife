<?php
/**
 * @package MSD Random Feature
 * @version 0.1
 */
/*
Plugin Name: MSD Random Feature
Description: Add a random feature as a widget or a shortcode
Author: Catherine Sandrick
Version: 0.1
Author URI: http://madsciencedept.com
*/

$msd_rdmftr_path = plugin_dir_path(__FILE__);
$msd_rdmftr_url = plugin_dir_url(__FILE__);

//Include utility functions
include_once('includes/msd_functions.php');

//Include main plugin
include_once('includes/msd_random_feature.php');

//Include widget files
include_once('includes/msd_random_feature_widget.php');

$random_feature = new MSDRandomFeature();