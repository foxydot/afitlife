<?php
/**
 * Move the Genesis breadcrumb
 *
 * @author Rick R. Duncan
 * @link http://www.buildbrandbelieve.com
 *
 */
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
add_action('genesis_before_content', 'genesis_do_breadcrumbs');

add_filter( 'genesis_breadcrumb_args', 'child_breadcrumb_args' );
/**
 * Amend breadcrumb arguments.
 *
 * @author Gary Jones
 *
 * @param array $args Default breadcrumb arguments
 * @return array Amended breadcrumb arguments
 */
function child_breadcrumb_args( $args ) {
    $args['home']                    = 'Home';
    $args['sep']                     = ' > ';
    $args['list_sep']                = ', '; // Genesis 1.5 and later
    $args['prefix']                  = '<div class="breadcrumb">';
    $args['suffix']                  = '</div>';
    $args['heirarchial_attachments'] = true; // Genesis 1.5 and later
    $args['heirarchial_categories']  = true; // Genesis 1.5 and later
    $args['display']                 = true;
    $args['labels']['prefix']        = '';
    $args['labels']['author']        = 'Archives for ';
    $args['labels']['category']      = 'Archives for '; // Genesis 1.6 and later
    $args['labels']['tag']           = 'Archives for ';
    $args['labels']['date']          = 'Archives for ';
    $args['labels']['search']        = 'Search for ';
    $args['labels']['tax']           = 'Archives for ';
    $args['labels']['post_type']     = 'Archives for ';
    $args['labels']['404']           = 'Not found: '; // Genesis 1.5 and later
    return $args;
}

add_filter( 'genesis_nav_items', 'tagline_in_nav', 10, 2 );
add_filter( 'wp_nav_menu_items', 'tagline_in_nav', 10, 2 );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
/**
* Follow Icons in Menu
* @author Bill Erickson
* @link http://www.billerickson.net/genesis-wordpress-nav-menu-content/
*
* @param string $menu
* @param array $args
* @return string
*/
function tagline_in_nav($menu, $args) {
$args = (array)$args;
if ( 'primary' !== $args['theme_location'] )
return $menu;
$tagline = '<li class="tagline">'.get_option('blogdescription').'</li>';
return $tagline.$menu;
}

//logous interruptus

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
add_action( 'genesis_site_title', 'apple_seo_site_title' );
function apple_seo_site_title() {
	if(genesis_nav_menu_supported( 'secondary' )&&has_nav_menu( 'secondary' )){
		genesis_do_subnav();
	} else {
	/** Set what goes inside the wrapping tags */
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), get_bloginfo( 'name' ) );

	/** Determine which wrapping tags to use */
	$wrap = is_home() && 'title' == genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	/** A little fallback, in case an SEO plugin is active */
	$wrap = is_home() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	/** Build the Title */
	$title = sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );

	/** Echo (filtered) */
	echo apply_filters( 'genesis_seo_title', $title, $inside, $wrap );
	}
}

//use the description for the second logo

remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
add_action( 'genesis_site_description', 'apple_seo_site_description' );
function apple_seo_site_description() {
	/** Set what goes inside the wrapping tags */
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'description' ) ), get_bloginfo( 'description' ) );

	/** Determine which wrapping tags to use */
	$wrap = is_home() && 'description' == genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	/* Build the description */
	$description = $inside ? sprintf( '<%s id="description">%s</%s>', $wrap, $inside, $wrap ) : '';

	/** Echo (filtered) */
	echo apply_filters( 'genesis_seo_description', $description, $inside, $wrap );
}

//some homepage widget areas
/** Remove footer widgets */
remove_theme_support( 'genesis-footer-widgets');
unregister_sidebar( 'header-right' );
/** Register widget areas *//** Register widget areas *//** Register widget areas */
genesis_register_sidebar( array(
    'id'            => 'home-left',
    'name'          => __( 'Homepage Top Left', 'apple' ),
    'description'   => __( 'This is a widget area that shows in the top left quadrant of the home page', 'apple' ),
) );
/** Register widget areas */
genesis_register_sidebar( array(
    'id'            => 'home-right',
    'name'          => __( 'Homepage Top Right', 'apple' ),
    'description'   => __( 'This is a widget area that shows in the top right quadrant of the home page', 'apple' ),
) );
/** Register widget areas */
genesis_register_sidebar( array(
    'id'            => 'home-footer',
    'name'          => __( 'Home Footer', 'apple' ),
    'description'   => __( 'This is a widget area that includes the four homepage footer widgets', 'apple' ),
) );

//remove post byline/meta
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

function apple_do_page_sidebar(){
	global $sidebar;
	//add code here to get any special sidebar info.
	if($sidebar->get_the_value('sidebar-content')!=''){
		print wpautop($sidebar->get_the_value('sidebar-content'));
		return TRUE;
	}
	if ( ! dynamic_sidebar( 'sidebar' ) ) {
	}
}
