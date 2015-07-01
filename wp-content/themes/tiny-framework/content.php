<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.0
 */
?>

	<?php tha_entry_before(); // custom action hook ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

		<?php tha_entry_top(); // custom action hook ?>

		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>

		<header class="page-header">
			<h2 class="page-title"><?php esc_html_e( 'Featured article', 'tinyframework' ); ?></h2>
		</header><!-- .page-header -->

		<?php endif; ?>

		<header class="entry-header">

			<?php if ( is_single() ) : ?>

			<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>

			<?php // Tip26 - Print HTML bellow post title with meta information for the current post date/time and author ?>

			<div class="entry-meta">

				<?php
				// Functions located in: inc/template-tags.php
					tinyframework_entry_meta_top();
					tinyframework_edit_link();
				?>

			</div><!-- .entry-meta -->

			<?php else : ?>

			<h2 class="entry-title" itemprop="headline">

				<a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a>

				<?php if ( ! post_password_required() && get_comments_number() ) : ?>

					<span class="title-comment-meta"><?php comments_popup_link( '<span class="leave-reply">' . esc_html__( 'Leave a reply', 'tinyframework' ) . '</span>', esc_html_x( '1', 'comments number', 'tinyframework' ), esc_html_x( '%', 'comments number', 'tinyframework' ) ); ?>

				<?php endif; // have comments ?>

			</h2>

			<?php // Tip26b - Print HTML bellow post title with meta information (date/time and author) for the index/archive views. To show, uncomment CSS rules in style.css ?>

			<div class="entry-meta">

				<?php tinyframework_entry_meta_top(); // Function located in: inc/template-tags.php ?>

			</div><!-- .entry-meta -->

			<?php endif; // is_single() ?>

		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>

		<div class="entry-summary">

			<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

		<?php else : ?>

		<div class="entry-content" itemprop="articleBody">

			<?php
			// Functions located in: inc/template-tags.php
				tinyframework_post_content();
				tinyframework_post_pages_nav();
			?>

		</div><!-- .entry-content -->

		<?php endif; ?>

		<footer class="entry-meta">

			<?php
			// Functions located in: inc/template-tags.php
				tinyframework_entry_meta();
				tinyframework_edit_link();
			?>

			<?php
				// If a user has filled out their description, show a author bio on their entries.
				if ( is_single() && get_the_author_meta( 'description' ) ) :
					get_template_part( 'author-bio' );
				endif;
			?>

		</footer><!-- .entry-meta -->

		<?php tha_entry_bottom(); // custom action hook ?>

	</article><!-- #post -->

	<?php tha_entry_after(); // custom action hook ?>
