<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package Tiny_Framework
 * @since Tiny Framework 1.0
 */
?>

	<?php tha_entry_before(); // custom action hook ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

		<?php tha_entry_top(); // custom action hook ?>

		<div class="aside">

			<header>
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
				else :
					the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>
			</header>

			<div class="entry-content" itemprop="articleBody">

				<?php tinyframework_post_content(); // Function located in: inc/template-tags.php ?>

			</div><!-- .entry-content -->

		</div><!-- .aside -->

		<footer class="entry-meta">

			<?php
			// Functions located in: inc/template-tags.php
				tinyframework_entry_meta();
				tinyframework_edit_link();
			?>

		</footer><!-- .entry-meta -->

		<?php tha_entry_bottom(); // custom action hook ?>

	</article><!-- #post -->

	<?php tha_entry_after(); // custom action hook ?>
