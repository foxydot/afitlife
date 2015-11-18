<?php
class MSDRandomFeature {

	public function MSDRandomFeature(){
		self::__construct();
	}
	
	public function __construct(){
		add_shortcode( 'random-feature', array(&$this,'random_feature_shortcode_handler') );
		add_shortcode( 'random_feature', array(&$this,'random_feature_shortcode_handler') );
		add_action( 'widgets_init', array(&$this,'register_widgets') );
		add_image_size( 'homepage-thumb', 105, 105, true ); //(cropped)
		add_image_size( 'random-thumb', 220, 180, true ); //(cropped)
	}
	
	function register_widgets() {
		register_widget( 'MSDRandomFeatureWidget' );
	}
	
	function get_random_feature( $atts ){
		foreach($atts AS $key => $value){
			if($value){
				$args[$key] = $value;
			}
		}
		if($args['category']){$args['category_name']=$args['category'];}
		$features = get_posts( $args );
		$rand = rand(0,count($features)-1);
		return $features[$rand];
	}
	
	function get_category_info($atts){
		$category = FALSE;
		$meta = array(
			'category',
			'ingredient',
			'cuisine',
			'course',
			'skill_level',
			'post_type'
				);
		$i = 0;
		while(!$category){
			$type = $meta[$i];
			$category = $atts[$meta[$i]];
			$i++;
		}
		//if(is_multisite())
			//$type = 'blog/'.$type;
		return array('type' => $type,'value' => $category);
	}
	function display_random_feature( $atts ){
		$feature = self::get_random_feature($atts);
		$category = self::get_category_info($atts);
		$title = $atts['title'] != NULL?$atts['title']:msd_ucwords($category['value']);
		$class = $atts['widget']?'random-feature-widget':'random-feature one-third';
		$size = $atts['widget']?'homepage-thumb':'random-thumb';
		$ret = '<div class="'.$class.'">
					<h3>'.$title.'</h3>
					<h4><a href="'.get_permalink($feature->ID).'">'.$feature->post_title.'</a></h4>
					<div class="aligncenter"><a href="'.get_permalink($feature->ID).'">'.get_the_post_thumbnail($feature->ID,$size,array('class'=>'img-rounded')).'</a></div>
					<div class="view-more"><a href="/'.$category['type'].'/'.$category['value'].'">'.msd_ucwords($category['value']).' ></a></div>
				</div>';
		return $ret;
	}
	
	function random_feature_shortcode_handler( $atts ){
		$atts = shortcode_atts( array(
			'title'			  => FALSE,
		    'category'        => FALSE,
		    'meta_key'        => FALSE,
		    'meta_value'      => FALSE,
   			'post_parent'     => FALSE,
		    'post_type'       => 'post',
		    'post_status'     => 'publish',
			'ingredient' => FALSE,
			'cuisine' => FALSE,
			'course' => FALSE,
			'skill_level' => FALSE
			), $atts );
		return self::display_random_feature($atts);
	}
}