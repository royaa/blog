<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tinyframework_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.0
 */

/* If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php tha_comments_before(); // custom action hook ?>

<div id="comments" class="comments-area" itemscope itemtype="http://schema.org/UserComments">

	<?php
	// You can start editing here - including this comment!
	if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'tinyframework' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( array(
				'callback' => 'tinyframework_comment', // Function located in: inc/template-tags.php
				'style'    => 'ol',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php // Are there comments to navigate through
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tinyframework' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older comments', 'tinyframework' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer comments', 'tinyframework' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->

		<?php endif; // check for comment navigation ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tinyframework' ); ?></p>

		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->

<?php tha_comments_after(); // custom action hook ?>