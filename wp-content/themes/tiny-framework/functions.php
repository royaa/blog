<?php
/**
 * Tiny Framework functions and definitions.
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * Learn how to set up a solid functions.php file
 * @link http://justintadlock.com/archives/2010/12/30/wordpress-theme-function-files
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.0
 */

/**
 * Table of Contents:
 *
 *  0.0 - Tiny Framework only works in WordPress 4.1 or later.
 *  1.0 - Set up the content width value based on the theme's design and stylesheet.
 *    1.1 - Adjust content width in certain contexts. Adjust content_width value for full-width and single image attachment templates, and when there are no active widgets in the sidebar.
 *  2.0 - Add support for a custom header image.
 *  3.0 - Theme setup - Part 1. Set up theme defaults and register the various WordPress features that Tiny Framework supports.
 *    3.1 - Make Tiny Framework available for translation.
 *    3.2 - This theme styles the visual editor with editor-style.css to match the theme style.
 *    3.3 - Add default posts and comments RSS feed links to head.
 *    3.4 - Let WordPress manage the document title.
 *    3.5 - HTML5 support for default core markup.
 *    3.6 - This theme supports a variety of post formats.
 *    3.7 - This theme uses wp_nav_menu() in two locations.
 *    3.8 - This theme supports custom background color and image, and here we also set up the default background color.
 *    3.9 -  Enable support for Post Thumbnails on posts and pages (also see Tip06 in style.css).
 *    3.10 - Tip07 - Add new image size for custom post/page headers and select default header image (also see Tip06 in style.css).
 *    3.11 - Include Theme Hooks Alliance Hooks (also check inc/tha-theme-hooks.php).
 *    3.12 - A non-disruptive admin notice to inform users about additional resources.
 *  4.0 - Theme setup - Part 2.
 *    4.1 - Register sidebars. Register our main widget area, footer widget areas and the front page widget areas.
 *    4.2 - Add Theme Customizer components.
 *    4.3 - Load custom template tags for this theme.
 *    4.4 - Load plugin compatibility file.
 *    4.5 - Allow Schema.org attributes to be added to HTML tags in the editor (but not for comments).
 *    4.6 - Return the Google font stylesheet URL if available.
 *  5.0 - Enqueue scripts and styles for front-end.
 *    5.1 - Load font stylesheet URL for Open Sans and other optional Google fonts.
 *    5.2 - Add CSS file of the Font Awesome icon font (local version).
 *    5.3 - Load our main stylesheet.
 *    5.4 - Load the Internet Explorer specific stylesheet.
 *    5.5 - Add JavaScript to pages with the comment form to support sites with threaded comments (when in use).
 *    5.6 - Add JavaScript for handling the navigation menu hide-and-show behavior.
 *    5.7 - Add additional scripts for accessibility, etc.
 *    5.8 - Make "skip to content" link work correctly in IE9, Chrome, and Opera for better accessibility.
 *  6.0 - Add optional meta tags, scripts to head - disabled by default.
 *    6.1 - Tip02 - Optional code to enable favicon for the website, admin area and login page. Add favicon.ico file to the theme's /images folder - disabled by default.
 *  7.0 - Enhancements for posts.
 *    7.1 - Change title for protected and private posts - words "protected" and "private" are replaced by lock/lock and user symbols. 
 *    7.2 - Control the length of Excerpts (number of words) - disabled by default.
 *  8.0 - Navigation settings.
 *    8.1 - Filter the page menu arguments. Make our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *  9.0 - Footer credits - Tip87 - Action Hook implementation example.
 *  10.0 - Functions to optimize performance.
 *    10.1 - Stop WordPress Including jQuery Migrate File. This will save you one HTTP request - disabled by default.
 *  11.0 - Functions to increase security.
 *    11.1 - Tip09 - Remove WordPress version info from head and feeds - disabled by default.
 *    11.2 - Tip84 - Remove error message on the login page - disabled by default.
 *  12.0 - Other functions.
 *    12.1 - Tip08 - Remove junk from head - disabled by default.
 *    12.2 - Tip82 - No more jumping for read more link - disabled by default.
 *    12.3 - Tip28 - Remove curly quotes in WordPress.
 *    12.4 - Tip81 - Completely disable the Post Formats UI in the post editor screen - disabled by default.
 *    
 * ----------------------------------------------------------------------------
 */

// 0.0 - Tiny Framework only works in WordPress 4.1 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

// 1.0 - Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 625;
}

if ( ! function_exists( 'tinyframework_content_width' ) ) :
/**
 * 1.1 - Adjust content width in certain contexts.
 *
 * Adjust content_width value for full-width and single image attachment templates, and when there are no active widgets in the sidebar.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
endif;
add_action( 'template_redirect', 'tinyframework_content_width' );



// 2.0 - Add support for a custom header image.
require( get_template_directory() . '/inc/custom-header.php' );



if ( ! function_exists( 'tinyframework_setup' ) ) :
/**
 * 3.0 - Theme setup - Part 1.
 *
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, title tag
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_setup() {

	/* 3.1 - Make Tiny Framework available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Tiny Framework, use a find and replace
	 * to change 'tinyframework' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'tinyframework', get_template_directory() . '/languages' );

	// 3.2 - This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array(
		'css/editor-style.css',
		'fonts/font-awesome/css/font-awesome.min.css',
		tinyframework_fonts_url(),
	) );

	// 3.3 - Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/* 3.4 - Let WordPress manage the document title.
	 *
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// 3.5 - HTML5 support for default core markup.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'widgets',
	) );

	// 3.6 - This theme supports a variety of post formats. @link https://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'link',
		'quote',
		'status',
	) ); // other possible formats: 'audio', 'chat', 'gallery', 'video',

	// 3.7 - This theme uses wp_nav_menu() in two locations.
	register_nav_menus(	array(
		'primary' => __( 'Primary Menu', 'tinyframework' ),
		'social'  => __( 'Social Links Menu', 'tinyframework' ),
	) );

	// 3.8 - This theme supports custom background color and image, and here we also set up the default background color.
	add_theme_support( 'custom-background', array(
		'default-color'      => 'e6e6e6',
		'default-image'      => '',

		// Other custom background settings you might need to use:

		// 'default-image'      => get_template_directory_uri() . '/images/background.jpg',
		// 'default-repeat'     => 'no-repeat',
		// 'default-position-x' => 'center',
		// 'default-attachment' => 'fixed',
	) );

	/* 3.9 - Enable support for Post Thumbnails on posts and pages.
	 *
	 * This theme uses a custom image size for featured images, displayed on "standard" posts.
	 *
	 * @link https://wordpress.stackexchange.com/questions/108572/set-post-thumbnail-size-vs-add-image-size
	 */
	add_theme_support( 'post-thumbnails' );
	/* Set standard Post Thumbnail size. If size is not specified, WordPress will use 'thumb' image size,
	 * one that is setted from WordPress dashboard. 
	 *
	 * Standard Post Thumbnail can be inserted with <?php the_post_thumbnail(); ?>
	 */
	 
	/* Commenting out the line below for the time being. Perhaps will use it to display featured posts in the index,
	 * when Featured Content functionality will be added to the WP core.
	 */
	  
	// set_post_thumbnail_size( 220, 130 ); // 220px x 130px
	
	// 3.10 - Tip07 - Add new image size for custom post/page headers and select default header image.
	add_image_size( 'custom-header-image', 960, 9999 ); // Unlimited height, soft crop

	/* 3.11 - Include Theme Hooks Alliance Hooks (also check inc/tha-theme-hooks.php).
	 *
	 * @link https://github.com/zamoose/themehookalliance
	 */
	require( get_template_directory() . '/inc/tha-theme-hooks.php' );

	// 3.12 - A non-disruptive admin notice to inform users about additional resources.
	require( get_template_directory() . '/inc/admin-notice.php' );
}
endif; // tinyframework_setup
add_action( 'after_setup_theme', 'tinyframework_setup' );



/**
 * 4.0 - Theme setup - Part 2.
 *
 * 4.1 - Register sidebars.
 *
 * Register our main widget area, footer widget areas and the front page widget areas.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'tinyframework' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'First Front Page Widget Area', 'tinyframework' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Second Front Page Widget Area', 'tinyframework' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'First Footer Widget Area', 'tinyframework' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Found at the bottom of every page (except 404s) as the footer. Left Side.', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Second Footer Widget Area', 'tinyframework' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Found at the bottom of every page (except 404s) as the footer. Center.', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Third Footer Widget Area', 'tinyframework' ),
		'id'            => 'sidebar-6',
		'description'   => __( 'Found at the bottom of every page (except 404s) as the footer. Right Side.', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Copyright Widget Area', 'tinyframework' ),
		'id'            => 'sidebar-7',
		'description'   => __( 'Found at the bottom of every page as the footer. Left Side. Use Text widget with no Title.', 'tinyframework' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );
}
add_action( 'widgets_init', 'tinyframework_widgets_init' );

/**
 * 4.2 - Add Theme Customizer components.
 *
 * @since Tiny Framework 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
require get_template_directory() . '/inc/customizer.php';

// 4.3 - Load custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// 4.4 - Load plugin compatibility file.
if ( file_exists( get_template_directory() . '/inc/plugin-compatibility.php' ) ) {
	require get_template_directory() . '/inc/plugin-compatibility.php';
}

if ( ! function_exists( 'tinyframework_allow_schema_markup' ) ) :
// 4.5 - Allow Schema.org attributes to be added to HTML tags in the editor (but not for comments).
function tinyframework_allow_schema_markup() {
	global $allowedposttags;
	foreach( $allowedposttags as $tag => $attr ) {
		$attr[ 'itemscope' ] = array();
		$attr[ 'itemtype' ] = array();
		$attr[ 'itemprop' ] = array();
		$allowedposttags[ $tag ] = $attr;
	}
	return $allowedposttags;
}
add_action( 'init', 'tinyframework_allow_schema_markup' );
endif;

if ( ! function_exists( 'tinyframework_fonts_url' ) ) :
/**
 * 4.6 - Return the Google fonts stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Tiny Framework 1.2
 *
 * @return string Google fonts URL for the theme or empty string if disabled.
 */
function tinyframework_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'tinyframework' ) ) {
		$fonts[] = 'Open Sans:400italic,700italic,400,700';
	}

	/* Tip31 - Support for aditional Google Fonts. Load Google Fonts stylesheet.
	 *
	 * Bellow are examples on how to add more Google fonts as your system fonts.
	 * System fonts will also be used in the visual editor.
	 *
	 * Get the link to your fonts @link http://www.google.com/webfonts
	 *
	 * Remember, using many font styles can slow down your webpage, so only select the font styles that you actually need on your webpage.
	 * We recommend using no more than 3 fonts styles.
	 *
	 * To test the font below, paste this into your post:
	 *
	 * <p style="font-family: 'Audiowide', cursive; font-weight: 400; font-size: 30px;">Testing google font</p>
	 */

	/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */

	/*
	if ( 'off' !== _x( 'on', 'Audiowide font: on or off', 'tinyframework' ) ) {
		$fonts[] = 'Audiowide:400italic,700italic,400,700';
	}
	*/

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */

	/*
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'tinyframework' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}
	*/

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'tinyframework' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = esc_url( add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' ) );
	}

	return $fonts_url;
}
endif;



/**
 * 5.0 - Enqueue scripts and styles for front-end.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_scripts_styles() {
	global $wp_styles;

	/* 5.1 - Load font stylesheet URL for Open Sans and other optional Google fonts. Open Sans is default Tiny Framework font.
	 *
	 * Google recommends to load this stylesheet before any other stylesheet.
	 *
	 * You can comment out this section if you want to remove Open Sans as default font.
	 *
	 * If you're using child theme, search for Tip13 in child theme's functions.php file to remove Open Sans.
	 */
	wp_enqueue_style( 'tinyframework-fonts',
	tinyframework_fonts_url(),
	array(),
	null );

	// 5.2 - Add CSS file of the Font Awesome icon font (local version), used in the main stylesheet.
	wp_enqueue_style( 'font-awesome-iconfont-style',
	get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css',
	array(),
	'4.3.0',
	'all' );

	/* 5.2b - Add CSS file of the Font Awesome icon font, used in the main stylesheet - BootstrapCDN version.
	 *
	 * To load Font Awesome icon font from BootstrapCDN, replace the line in the section above:
	 *
	 * get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css',
	 *
	 * with:
	 *
	 * '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
	 *
	 * Please be advised, that overall loading CSS is recommended from your own domain - it is faster, because DNS will be resolved once.
	 *
	 * In my testing I got mixed results:
	 *    (83 + 282)ms local vs (123 + 350)ms CDN via: webpagetest.org
	 *     (51 + 44)ms local vs    (8 + 17)ms CDN via: tools.pingdom.com
	 */

	// 5.3 - Load our main stylesheet.
	wp_enqueue_style( 'tinyframework-style',
	get_stylesheet_uri(),
	array(),
	'2.0.7' );

	// 5.4 - Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'tinyframework-ie',
	get_template_directory_uri() . '/css/ie.css',
	array( 'tinyframework-style' ),
	'2.0.7' );
	$wp_styles->add_data( 'tinyframework-ie', 'conditional', 'lt IE 9' );

	// 5.5 - Add JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// 5.6 - Add JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'tinyframework-navigation',
	get_template_directory_uri() . '/js/navigation.js',
	array(),
	'2.0.7',
	true ); // Loading script in the footer for a better performance

	// 5.7 - Add additional scripts for accessibility, etc.
	wp_enqueue_script( 'tinyframework-additional-scripts',
	get_template_directory_uri() . '/js/functions.js',
	array( 'jquery' ),
	'2.0.7',
	true ); // Loading script in the footer for a better performance
	// Localize those scripts
	$translation_array = array(
		'newWindow'    => __( 'Opens in a new window', 'tinyframework' ),
	);
	wp_localize_script( 'tinyframework-additional-scripts', 'tinyframeworkAdditionalScripts', $translation_array );

	/* 5.8 - Make "skip to content" link work correctly in IE9, Chrome, and Opera for better accessibility.
	 * This function might be removed in the future, when browser accessibility support will become better.
	 */
	wp_enqueue_script( 'tinyframework-skip-link-focus-fix',
	get_template_directory_uri() . '/js/skip-link-focus-fix.js',
	array(),
	'2.0.1',
	true ); // Loading script in the footer for a better performance
}
add_action( 'wp_enqueue_scripts', 'tinyframework_scripts_styles' );

// 6.0 - Add optional meta tags, scripts to head.
function tinyframework_add_meta_to_head () {

	// Tip03 - We are people, not machines. Read more at: humanstxt.org. Edit file humans.txt to include your information.

	// echo "\n"; echo '<!-- Find out who built this website! Read humans.txt for more information. -->'; echo "\n"; echo '<link rel="author" type="text/plain" href="'.get_template_directory_uri().'/inc/humans.txt" />'; echo "\n";

	// Project author's information

	// echo '<meta name="author" content="Your name here" />'; echo "\n\n";

	/* jQuery - Google, then WordPress's.
	 *
	 * The Google CDN version is chosen because it's fast in absolute terms and it has the best overall penetration which increases the odds
	 * of having a copy of the library in your user's browser cache link: https://github.com/h5bp/html5-boilerplate/blob/master/dist/doc/html.md
	 *
	 * You can do this, but it is not the best option, better use the plugin: https://wordpress.org/extend/plugins/use-google-libraries/
	 * Explanation why: https://pippinsplugins.com/why-loading-your-own-jquery-is-irresponsible/
	 */

	/*
	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', false, '1.11.2', true );
		wp_enqueue_script( 'jquery' );
	}
	*/
}
add_action( 'wp_head', 'tinyframework_add_meta_to_head' );

// 6.1 - Tip02 - Optional code to enable favicon for the website, admin area and login page. Add favicon.ico file to the theme's /images folder.

/*
function tinyframework_favicon() {
	$favicon_url = get_template_directory_uri() . '/images/favicon.ico';
	echo "\n"; echo '<link rel="shortcut icon" type="image/x-icon" href="' . $favicon_url . '" />'; echo "\n";
}
add_action( 'wp_head', 'tinyframework_favicon' ); // Favicon for main website
add_action( 'admin_head', 'tinyframework_favicon' ); // Favicon for admin area
add_action( 'login_head', 'tinyframework_favicon' ); // Favicon for login page
*/



if ( ! function_exists( 'tinyframework_the_title_trim' ) ) :
/**
 * 7.0 - Enhancements for posts.
 *
 * 7.1 - Change title for protected and private posts - words "protected" and "private" are replaced by lock symbol.
 *
 * If you're using localized WordPress, replace words 'Protected' and 'Private' with the corresponding words in your language.
 *
 * If you're using child theme, uncomment function 1.3 in child theme's functions.php and replace
 * words 'Protected' and 'Private' with the corresponding words in your language.
 */
function tinyframework_the_title_trim($title) {
	$title = esc_attr($title); // Sanitize HTML characters in the title. Comment out this line if you want to use HTML in post titles.
	$findthese = array(
		'#Protected:#',
		'#Private:#'
	);
	$replacewith = array(
		// What to replace "Protected:" with
		'<span class="screen-reader-text">Protected article:</span>',
		// What to replace "Private:" with
		'<span class="screen-reader-text">Private article:</span>'
	);
	$title = preg_replace($findthese, $replacewith, $title);
	return $title;
}
endif;
add_filter( 'the_title', 'tinyframework_the_title_trim' );

/**
 * 7.2 - Control the length of Excerpts (number of words). Please note, that Excerpt
 * is not a Teaser (the part of a post that appears on the front page when you use the More tag).
 * 
 * @link https://codex.wordpress.org/Template_Tags/the_excerpt
 */

/*
function tinyframework_custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'tinyframework_custom_excerpt_length', 999 );
*/



/**
 * 8.0 - Navigation settings.
 * 
 * 8.1 - Filter the page menu arguments.
 *
 * Make our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Tiny Framework 1.0
 */
function tinyframework_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) ) {
		$args['show_home'] = true;
	}
	return $args;
}
add_filter( 'wp_page_menu_args', 'tinyframework_page_menu_args' );



// 9.0 - Footer credits - Tip87 - Action Hook implementation example.
function tinyframework_display_credits() {
	$text = sprintf( __( 'Using %s', 'tinyframework' ), '<a href="http://mtomas.com/1/tiny-forge-free-mobile-first-wordpress-theme">Tiny Framework</a> ' );

	// If you would like to use long version of credits, use these two lines below (and delete the line above):

	/*
	$text = sprintf( __( 'Powered by %s', 'tinyframework' ), '<a href="https://wordpress.org/" class="icon-webfont fa-wordpress" rel="generator"><span class="screen-reader-text">WordPress</span></a>' );
	$text .= sprintf( __( ' and %s', 'tinyframework' ), '<a href="http://mtomas.com/1/tiny-forge-free-mobile-first-wordpress-theme">Tiny Framework</a> ' );
	*/

	$text .= '<span class="meta-separator" aria-hidden="true">&bull;</span>';

	// If you want to add your own credits:

	/*
	$text .= ' <a href="http://your-site.com" title="Web design & programing by your credentials" rel="designer">Web development by your credentials</a> ';
	$text .= '<span class="meta-separator" aria-hidden="true">&bull;</span>';
	*/
	echo apply_filters( 'tinyframework_credits_text', $text );
}
add_action( 'tinyframework_credits', 'tinyframework_display_credits' );



/**
 * 10.0 - Functions to optimize performance. "The fastest HTTP request is the one not made."
 *
 * Also see: 5.2b - Add CSS file of the Font Awesome icon font, used in the main stylesheet - BootstrapCDN version.
 *
 * 10.1 - Stop WordPress Including jQuery Migrate File. This will save you one HTTP request.
 *
 * @link http://www.paulund.co.uk/remove-jquery-migrate-file-wordpress
 */

/*
function tinyframework_remove_jquery_migrate( &$scripts)
{
	if(!is_admin())
	{
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.1' ); // Check the jQuery version at: /wp-includes/js/jquery/jquery.js
	}
}
add_filter( 'wp_default_scripts', 'tinyframework_remove_jquery_migrate' );
*/

 

/**
 * 11.0 - Functions to increase security.
 *
 * 11.1 - Tip09 - Remove WordPress version info from head and feeds.
 */

/*
function tinyframework_complete_version_removal() {
	return '';
}
add_filter( 'the_generator', 'tinyframework_complete_version_removal' );
*/

/**
 * 11.2 - Tip84 - Remove error message on the login page.
 *
 * @link http://www.wpbeginner.com/wp-tutorials/11-vital-tips-and-hacks-to-protect-your-wordpress-admin-area/
 */
 
// add_filter( 'login_errors', create_function('$a', "return null;") );



/**
 * 12.0 - Other functions.
 *
 * 12.1 - Tip08 - Remove junk from head.
 *
 * @link https://scotch.io/quick-tips/removing-wordpress-header-junk
 */

// remove_action( 'wp_head', 'rsd_link' ); // remove really simple discovery link
// remove_action( 'wp_head', 'wp_generator' ); // remove wordpress version
// remove_action( 'wp_head', 'feed_links', 2 ); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
// remove_action( 'wp_head', 'feed_links_extra', 3 ); // removes all extra rss feed links
// remove_action( 'wp_head', 'index_rel_link' ); // remove link to index page
// remove_action( 'wp_head', 'wlwmanifest_link' ); // remove wlwmanifest.xml (needed to support windows live writer)
// remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // remove random post link
// remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // remove parent post link
// remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // remove the next and previous post links
// remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

/**
 * 12.2 - Tip82 - No more jumping for read more link.
 *
 * Clicking on "read more" or "continue reading" sends user to the top of the post, not to the place marked with "more".
 */
 
/*
function tinyframework_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter( 'the_content_more_link', 'tinyframework_remove_more_jump_link' );
*/

/**
 * 12.3 - Tip28 - Remove curly quotes in WordPress. For more options:
 *
 * @link http://www.smashingmagazine.com/2013/06/21/five-wordpress-functions-blogging-easier/
 */
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'the_excerpt', 'wptexturize' );
remove_filter( 'comment_text', 'wptexturize' );

/**
 * 12.4 - Tip81 - Completely disable the Post Formats support in the theme and Post Formats UI in the post editor screen.
 *
 * Have a normal/business website and do not really use or need Post Formats?
 *
 * @link https://wordpress.org/support/topic/remove-post-formats-alltogether
 */

/*
function tinyframework_remove_post_formats() {
	remove_theme_support( 'post-formats' );
}
add_action( 'after_setup_theme', 'tinyframework_remove_post_formats', 11 );
*/