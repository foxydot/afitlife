<?php
remove_all_actions( 'genesis_loop' );
/** Remove default sidebar */
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
function homepage(){
	if ( ! is_front_page() ) //should only exist on the front page anyway, so this should never happen.
          return;
      genesis_widget_area( 'home-left', array(
          'before' => '<div class="home-left widget-area">',
      ) );
      genesis_widget_area( 'home-right', array(
          'before' => '<div class="home-right widget-area">',
      ) );
      genesis_widget_area( 'home-footer', array(
          'before' => '<div class="home-footer widget-area">',
      ) );
}
add_action('genesis_loop','homepage');


genesis();