<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.0
 */
?><!DOCTYPE html>

<?php tha_html_before(); // custom action hook ?>

<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>>
<![endif]-->

<!--[if !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>

<?php tha_head_top(); // custom action hook ?>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
<![endif]-->

<?php tha_head_bottom(); // custom action hook ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php tha_body_top(); // custom action hook ?>

<span class="skiplink"><a class="screen-reader-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'tinyframework' ); ?>"><?php esc_html_e( 'Skip to content', 'tinyframework' ); ?></a></span>

<?php // Tip04 - Reminder to turn ON JavaScript ?>

<noscript>
	<div id="no-javascript">
		<?php esc_html_e( 'Advanced features of this website require that you enable JavaScript in your browser. Thank you!', 'tinyframework' ); ?>
	</div>
</noscript>

<div id="page" class="hfeed site">

	<?php tha_header_before(); // custom action hook ?>

	<header id="masthead" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

		<?php tha_header_top(); // custom action hook ?>

		<div class="site-branding" itemscope itemtype="http://schema.org/WPHeader">

			<?php // Tip14 - Site Logo plugin/feature support. Check: inc/plugin-compatibility.php for more details.
			tinyframework_the_site_logo();
			?>

			<div id="site-title-wrapper">

				<?php
					if ( is_front_page() && is_home() ) : ?>

						<h1 class="site-title" itemprop="headline"><?php bloginfo( 'name' ); ?></h1>

					<?php else : ?>

						<p class="site-title" itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

					<?php endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : 
					?>

						<p class="site-description" itemprop="description"><?php echo $description; ?></p>

					<?php endif;
				?>

			</div><!-- #site-title-wrapper -->

		</div><!-- .site-branding -->

		<?php
		/* Accessibility. Aria Label: Provides a label to differentiate multiple navigation landmarks
		 * hidden heading: provides navigational structure to site for scanning with screen reader
		 */
		?>

		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Menu', 'tinyframework' ); ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">

			<h2 class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'tinyframework' ); ?></h2>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'tinyframework' ); ?></button>

			<?php // Search form for mobile menu ?>

			<div class="search-box-wrapper search-container-mobile">
				<div class="search-box">
					<?php get_search_form(); ?>
				</div>
			</div>

			<!--<button class="go-to-top"><a href="#page"><span class="icon-webfont fa-chevron-circle-up" aria-hidden="true"></span></a></button>-->

			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'nav-menu',
				'depth'          => 4,
				) );
			?>

		</nav><!-- #site-navigation -->

		<!-- Custom Header - Start -->

		<?php // Tip06 - Custom headers for posts and pages
		$header_image = get_header_image();
		if ( function_exists( 'get_custom_header' ) ) {
			/* We need to figure out what the minimum width should be for our featured image
			 * This result would be the suggested width if the theme were to implement flexible widths
			 */
			$header_image_width = get_theme_support( 'custom-header', 'width' );
		}
		?>

		<?php
		/* The header image
		 *
		 * Check if this is a post or page, if it has a thumbnail, and if it's a big one
		 * You can also check if it's not password protected, just add this condition: && ! post_password_required()
		 */
		if ( is_singular() && has_post_thumbnail( $post->ID ) &&
				( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
				$image[1] >= $header_image_width ) :
			// Houston, we have a new header image!
			echo get_the_post_thumbnail( $post->ID, 'custom-header-image' );
		else :
			if ( function_exists( 'get_custom_header' ) ) {
				$header_image_width  = get_custom_header()->width;
				$header_image_height = get_custom_header()->height;
			}
		?>

			<?php
			// Check to see if the header image has been removed.
			if ( ! empty( $header_image ) ) : ?>

				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />

			<?php endif; // end check for removed header image ?>

		<?php endif; // end check for featured image or standard header ?>

		<!-- Custom Header - End -->

		<?php tha_header_bottom(); // custom action hook ?>

	</header><!-- .site-header -->

	<?php tha_header_after(); // custom action hook ?>

	<div id="content" class="site-content">