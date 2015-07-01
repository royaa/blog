<?php
/**
 * Tiny Framework Customizer functionality
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.2
 */

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Tiny Framework 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function tinyframework_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'tinyframework' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'tinyframework' );
}
add_action( 'customize_register', 'tinyframework_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_customize_preview_js() {
	wp_enqueue_script( 'tinyframework_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'tinyframework_customize_preview_js' );
