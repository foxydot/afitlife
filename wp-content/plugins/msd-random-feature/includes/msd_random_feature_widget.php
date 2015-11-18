<?php

class MSDRandomFeatureWidget extends WP_Widget {
    /** constructor */
    function MSDRandomFeatureWidget() {
    	self::__construct();
    }
    function __construct() {
    	$widget_ops = array('classname' => 'msd_random_feature_widget', 'description' => __('Display a random feature item of a particular class'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('msd_random_feature_widget', __('MSD Random Feature Widget'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		global $random_feature;
		$instance['widget'] = true;
		echo $before_widget;
		echo $random_feature->display_random_feature($instance);
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['ingredient'] = strip_tags($new_instance['ingredient']);
		$instance['cuisine'] = strip_tags($new_instance['cuisine']);
		$instance['course'] = strip_tags($new_instance['course']);
		$instance['skill_level'] = strip_tags($new_instance['skill_level']);
		$instance['post_type'] = strip_tags($new_instance['post_type']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);	
		$cuisine = strip_tags($instance['cuisine']);
		$course = strip_tags($instance['course']);
		$skill_level = strip_tags($instance['skill_level']);
		$post_type = strip_tags($instance['post_type']);	
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:'); ?></label>
		<select  id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="">All Categories</option>
				<?php $cats = get_terms('category',array('hide_empty' => 0)); foreach ($cats as $cat):?>
					<?php $in= ($cat->slug==$category)? " SELECTED":"";?>
  					<option value="<?php echo $cat->slug ?>"<?php echo $in?>><?php echo $cat->name?></option>
				<?php endforeach;?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('cuisine'); ?>"><?php _e('Cuisine:'); ?></label>
		<select  id="<?php echo $this->get_field_id('cuisine'); ?>" name="<?php echo $this->get_field_name('cuisine'); ?>">
				<option value="">All Cuisines</option>
				<?php $cats = get_terms('cuisine',array('hide_empty' => 0)); foreach ($cats as $cat):?>
					<?php $in= ($cat->slug==$cuisine)? " SELECTED":"";?>
  					<option value="<?php echo $cat->slug ?>"<?php echo $in?>><?php echo $cat->name?></option>
				<?php endforeach;?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('course'); ?>"><?php _e('Course:'); ?></label>
		<select  id="<?php echo $this->get_field_id('course'); ?>" name="<?php echo $this->get_field_name('course'); ?>">
				<option value="">All Courses</option>
				<?php $cats = get_terms('course',array('hide_empty' => 0)); foreach ($cats as $cat):?>
					<?php $in= ($cat->slug==$course)? " SELECTED":"";?>
  					<option value="<?php echo $cat->slug ?>"<?php echo $in?>><?php echo $cat->name?></option>
				<?php endforeach;?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('skill_level'); ?>"><?php _e('Skill Levels:'); ?></label>
		<select  id="<?php echo $this->get_field_id('skill_level'); ?>" name="<?php echo $this->get_field_name('skill_level'); ?>">
				<option value="">All Skill Levels</option>
				<?php $cats = get_terms('skill_level',array('hide_empty' => 0)); foreach ($cats as $cat):?>
					<?php $in= ($cat->slug==$skill_level)? " SELECTED":"";?>
  					<option value="<?php echo $cat->slug ?>"<?php echo $in?>><?php echo $cat->name?></option>
				<?php endforeach;?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:'); ?></label>
		<select  id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
				<option value="">All Post Types</option>
				<?php $cats = get_post_types(array('public'=>true)); foreach ($cats as $cat):?>
					<?php $in= ($cat==$post_type)? " SELECTED":"";?>
  					<option value="<?php echo $cat ?>"<?php echo $in?>><?php echo $cat; ?></option>
				<?php endforeach;?>
		</select></p>
		
		
<?php
	}
}