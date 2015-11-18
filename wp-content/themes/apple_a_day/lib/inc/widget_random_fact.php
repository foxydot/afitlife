<?php
/**
 * Random Fact Widget Class
 */
class random_fact_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function random_fact_widget() {
        parent::WP_Widget(false, 'Random Fact Widget', array('classname' => 'widget_random_fact',));	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $category 	= $instance['category'];
        $args = array(
		    'numberposts'     => -1,
		    'post_type'       => 'qa_faqs',
		    'post_status'     => 'publish',
		    'suppress_filters' => true );
        if(!empty($category)){
        	$args['faq_category'] = $category;
        }
        $facts = get_posts($args);
        $fact = $facts[array_rand($facts)];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<div class="fact-title"><?php print $fact->post_title; ?></div>
							<div class="fact-content"><?php print $fact->post_content; ?></div>
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
        $category	= esc_attr($instance['category']);
        
        $cats = get_categories(array('type' => 'qa_faqs','hide_empty' => 0,'taxonomy' => 'faq_category'));
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Restrict to category'); ?></label> 
          <select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
          	<option value="">All categories</option>
          	<?php 
          	foreach($cats AS $c){
          		$checked = $category==$c->slug?' SELECTED':'';
          		?>
          		<option value="<?php echo $c->slug; ?>"><?php echo $c->name; ?></option>
          		<?php
          	}
          	?>
          </select>
        </p>
        <?php 
    }
 
 
} // end class example_widget <?php 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if(is_plugin_active('q-and-a/q-and-a.php')){
	add_action('widgets_init', create_function('', 'return register_widget("random_fact_widget");'));
}
?>