<?php
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_action( 'genesis_sidebar', 'apple_do_page_sidebar' );

genesis();
