<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Tiny_Framework
 * @since Tiny Framework 2.0.2
 */
?>

	<?php tha_entry_before(); // custom action hook ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

		<?php tha_entry_top(); // custom action hook ?>

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-summary">

			<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

		<?php if ( 'post' == get_post_type() ) : ?>

		<footer class="entry-meta">

			<?php
			// Functions located in: inc/template-tags.php
				tinyframework_entry_meta();
				tinyframework_edit_link();
			?>

		</footer><!-- .entry-meta -->

		<?php else : ?>

		<footer class="entry-meta">

			<?php tinyframework_edit_link(); // Function located in: inc/template-tags.php ?>

		</footer><!-- .entry-meta -->

		<?php endif; ?>

		<?php tha_entry_bottom(); // custom action hook ?>

	</article><!-- #post -->

	<?php tha_entry_after(); // custom action hook ?>
