<?php
/**
 * A non-disruptive admin notice to inform users about additional resources.
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.5.6
 */

// Don't nag users who can't switch themes.
if ( ! is_admin() || ! current_user_can( 'switch_themes' ) )
	return;

function tinyframework_admin_notice() {
	if ( isset( $_GET['tinyframework-notice-dismiss'] ) )
		set_theme_mod( 'notice-dismiss', true );

	$dismiss = get_theme_mod( 'notice-dismiss', false );
	if ( $dismiss )
		return;
	?>
	<div class="updated tinyframework-notice">
		<p><?php printf( __( 'Thank you for using Tiny Framework! Please check out a valuable user guide: <a target="_blank" href="%s">How to use Tiny Framework and its child themes: a comprehensive guide</a>. Happy coding! <a href="%s">(hide this message)</a>', 'tinyframework' ), 'http://mtomas.com/389/tiny-forge-framework-child-themes-comprehensive-guide', esc_url( add_query_arg( 'tinyframework-notice-dismiss', 1 ) ) ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'tinyframework_admin_notice' );