<?php
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_action( 'genesis_sidebar', 'apple_do_page_sidebar' );

function apple_post_navigation()
{
	global $post;
	if(!has_recipress_recipe()){
	$categories = get_the_category( $post->ID );
	$category = $categories[0]->cat_name;
	?>
    <div class="prev_next">
        <div class="nav_left">
            <span class="prev"><?php previous_post_link('%link', '< Previous '.$category , true); ?></span>
         </div><div class="nav_right">
            <span class="next"><?php next_post_link('%link', 'Next '.$category.' >' , true); ?></span>
        </div>
    </div>
<?php
	}
}

add_action('genesis_after_post_content', 'apple_post_navigation');
genesis();