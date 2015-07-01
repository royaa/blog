<?php
/**
 * Compatibility settings and functions for Jetpack and other plugins.
 *
 * @package Tiny_Framework
 * @since Tiny Framework 2.0
 */


/**
 * Tip14 - This theme supports custom Site Logo Plugin (also a WordPress.com feature and a feature component of Jetpack plugin).
 *
 * See https://github.com/Automattic/site-logo
 *
 * With logo feature being active, site BODY gets new class .has-site-logo
 * 
 * The `add_theme_support()` declaration can take a `size` argument. The default is `thumbnail`, with other valid values being:
 * `medium`, `large`, `full`, and any additional sizes declared by `add_image_size`.
 * If the selected logo is not big enough to have the requested size, 'full' will be used on output instead.
 *
 * `add_theme_support` also takes a `header-text` argument. This is an array of classes (without the leading `.`) that should be hidden with the "Display Header Text" setting.
 * Defaults to the same classes as Underscores: `site-title` and `site-description`.
 *
 * @since @since Tiny Framework 2.0
 */
function tinyframework_site_logo_init() {
	add_theme_support( 'site-logo' );

	/* If you want to asign specific image size, please use the code below instead. All files uploaded to media library will be also saved in this size. */

	/*
	add_image_size( 'tinyframework-logo', 120, 85 );
	add_theme_support( 'site-logo', array( 'size' => 'tinyframework-logo' ) );
	*/
}
add_action( 'after_setup_theme', 'tinyframework_site_logo_init' );

/**
 * Return early if Site Logo is not available.
 *
 * First function checks if Jetpack is installed, if not, it will check if standalone Site Logo plugin is present.
 */
function tinyframework_the_site_logo() { 
    if ( function_exists( 'jetpack_the_site_logo' ) ) {
        return jetpack_the_site_logo();
    } else if ( function_exists( 'the_site_logo' ) ) {
        return the_site_logo();
    } else {
        return;
    }
}
 
/**
 * Tip35 - Add support for Infinite Scroll.
 * See http://jetpack.me/support/infinite-scroll/
 */
function tinyframework_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer_widgets' => array(
			'sidebar-4',
			'sidebar-5',
			'sidebar-6',
			'sidebar-7',
		),
		'footer'         => 'page',
	) );
}
add_action( 'after_setup_theme', 'tinyframework_infinite_scroll_init' );

/**
 * Check whether or not footer widgets are present. If they are present, then a button to
 * 'Load more posts' will be displayed and Infinite Scroll will not be triggered unless a user manually clicks on that button.
 *
 * @param bool $has_widgets
 * @uses Jetpack_User_Agent_Info::is_ipad, jetpack_is_mobile, is_active_sidebar
 * @filter infinite_scroll_has_footer_widgets
 * @return bool
 */
function tinyframework_has_footer_widgets( $has_widgets ) {
	if ( ( Jetpack_User_Agent_Info::is_ipad() || ( function_exists( 'jetpack_is_mobile' ) && jetpack_is_mobile() ) ) && is_active_sidebar( 'sidebar-1' ) )
		$has_widgets = true;

	return $has_widgets;
}
add_filter( 'infinite_scroll_has_footer_widgets', 'tinyframework_has_footer_widgets' );


/**
 * Add support for the Featured Content Plugin
 *
 * @since Tiny Framework 2.0
 */

/*
function tinyframework_featured_content_init() {
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'tinyframework_get_featured_posts',
		'description'             => __( 'The featured content section displays on the front page above the first post in the content area.', 'tinyframework' ),
		'max_posts'               => 5,
	) );
}
add_action( 'after_setup_theme', 'tinyframework_featured_content_init' );
*/


/**
 * Featured Posts
 *
 * @since @since Tiny Framework 2.0
 */

/*
function tinyframework_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'tinyframework_get_featured_posts', array() );
	return ( is_array( $featured_posts ) && 1 < count( $featured_posts ) );
}

function tinyframework_get_featured_posts() {
	return apply_filters( 'tinyframework_get_featured_posts', false );
}
*/

/**
 * Add theme support for Responsive Videos
 *
 * @since @since Tiny Framework 2.0
 */

/*
function tinyframework_responsive_videos_setup() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'tinyframework_responsive_videos_setup' );
*/
